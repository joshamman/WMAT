# Pentimento — Claude Code Handoff

**Project:** An art-therapy *process* recorder. It records the entire act of drawing as a timestamped event stream, then lets a credentialed therapist replay it, scrub it, annotate it, and read metrics off it. The finished picture is the least interesting output; the **how** and **when** of its making is the product.

**Status:** Working single-file MVP (`pentimento.html`, ~50 KB, no build, no server). Built and tested by the product owner (Josh) and his wife Amy, a board-certified art therapist. Ready to graduate from a one-file prototype into a real repo.

> **Update — 2026-07-09:** §1 below is **done**. The monolith is split into `index.html` + `src/*.js` (plain classic scripts, still `file://`-runnable — *not* ES modules), a zero-dependency `node build.mjs` regenerates the single-file `pentimento.html`, d3 is self-hosted under `vendor/`, and `test/smoke.html` passes. Behavior was verified identical to the original (line-level code diff + smoke test on both the modular and built versions). See `README.md` and `CLAUDE.md`.

**Owner profile:** Josh is the product owner and does not write code day-to-day. Give him concrete, numbered, important-first summaries. He decides product direction; you implement. Amy is the clinical authority — any question about clinical meaning, scoring, or workflow is her call, not yours.

---

## 1. Do these first (the actual handoff task)

> **✅ Completed 2026-07-09** — repo split, `CLAUDE.md`, and the smoke test are all done and verified. Items below are kept for the record.

1. **Split the monolith into a repo** without changing behavior. The current file is `shell.html` (markup + CSS) with `app.js` concatenated in via a `@@APP_JS@@` token at build time. Reproduce that as a clean project (see §9). First commit must render and behave *identically* to the current `pentimento.html`.
2. **Add a `CLAUDE.md`** at repo root containing the "intentional decisions" list (§6) and the clinical guardrails (§8) so future sessions don't undo deliberate choices.
3. **Write a smoke test** that loads a bundled sample session JSON and asserts: replay reaches 100%, stat cards populate, all five charts render, note tooltip opens. This is the regression net before any refactor.
4. **Do NOT** introduce a framework, backend, bundler, or dependency in the first pass. The app is deliberately vanilla + one CDN dependency (d3). Migration triggers are in §7 — respect them.

---

## 2. What is already built

Three screens, one data model, zero accounts.

1. **Home** — session library (cards with thumbnails), New Session (client-code prompt, never a name), Import/Export JSON.
2. **Draw** — full-screen paper sheet; 8 colors, 3 brush sizes, eraser, undo. Recording is automatic and invisible to the client. Apple Pencil pressure + tilt captured via Pointer Events; coalesced events grab the full Pencil sample rate. Palm rejection: once a Pencil draws, touch input is ignored for that session.
3. **Review** — the therapist's light table:
   - Replay at 1× / 4× / 16×, timeline scrubber, tap-to-seek.
   - Scrubber encodes: ink bands (drawing), ochre bands (silence ≥ 2s), green pins (notes), ochre ticks (undos).
   - Note pins have hover + tap tooltips; tap also pauses and seeks to that moment.
   - 8 stat cards; the three "hot" (ochre) ones are pauses/tempo — Amy's #1-ranked signal.
   - Five d3 charts: drawing tempo, pause map, Pencil pressure (auto-hidden for finger sessions), canvas coverage over time, stroke sequence/color strip.
   - Timestamped therapist notes; Export JSON; Delete.

**Storage adapter** auto-detects environment: uses `window.storage` inside a Claude artifact, `localStorage` when opened as a standalone file. Same API either way.

---

## 3. How to run it right now

1. It's a single static HTML file. Open `pentimento.html` in any modern browser — no server needed.
2. On iPad/iPhone: open in Safari → Share → **Add to Home Screen** → launches full-screen like a native app.
3. **d3 v7** loads from `cdnjs.cloudflare.com`. Offline, replay still works but charts degrade gracefully to a "charts unavailable" card. If you self-host d3 during the split, keep that fallback.
4. The artifact copy and any downloaded copy keep **separate** libraries (different storage backends). Export/Import JSON is the only bridge. Preserve this until there's a real backend.

---

## 4. The data model (this is the contract — treat as sacred)

Everything derives from timestamped points. Get this right and the rest follows. All times are **milliseconds from session start** (`performance.now()` at `t0`), not wall-clock.

**Session** (one per drawing; stored at key `pentimento-session-<id>`):
```js
{
  v: 1,                      // schema version — bump on any breaking change
  id: "<uid>",               // internal id
  code: "S-0709-A",          // client CODE, never a name (privacy)
  startedAt: "<ISO string>", // wall-clock start, for display/sorting only
  w: 820, h: 1180,           // canvas CSS px at session start (locked; see §7.2)
  hasPen: false,             // true once any Pencil point recorded
  durationMs: 0,             // total session length
  thumb: "data:image/jpeg;base64,...", // 320px preview
  strokes: [ /* Stroke */ ],
  notes:   [ /* Note */ ]
}
```

**Stroke** (one per pen-down → pen-up):
```js
{
  i: "<uid>",
  t0: 1234, t1: 5678,        // first/last point time (ms)
  tool: "brush" | "eraser",
  color: "#1A1A1A",
  size: 9,                   // base width in CSS px
  pt: "pen" | "touch" | "mouse",   // input type (drives pressure width)
  un: null | 8000,           // UNDO timestamp. null = still present.
                             //   Undo is an EVENT, not a deletion (see §6.3)
  pts: [ [x, y, t, pressure], ... ]  // the event stream. pressure 0..1
}
```

**Note** (therapist annotation, pinned to a moment):
```js
{ t: 4200, text: "42s pause before starting the figure", at: "<ISO>" }
```

**Index entry** (lightweight list at key `pentimento-index`, an array):
```js
{ id, code, startedAt, durationMs, nStrokes, thumb }
```

**Storage keys:** `pentimento-index` (array of the above) and `pentimento-session-<id>` (one full session each). Defined once as `K_IDX` and `K_S(id)` — don't scatter string literals.

---

## 5. Architecture & the render pipeline

1. **One draw function, three consumers.** `drawStrokeOn(ctx, stroke, uptoT)` renders a stroke (optionally only up to time `uptoT`). It is the single source of truth for the live canvas, the replay stage, AND the thumbnail. This guarantees what the therapist replays is pixel-consistent with what the client drew. **Never fork this.**
2. **Replay is incremental.** `renderAt(T)` only draws *new* segments since the last frame; it falls back to a full re-render (`fullRender`) only when seeking backward or when an undo crosses the playhead. This is why scrubbing is smooth on long sessions. Keep the fast path.
3. **Analytics** live in `analyze(session)` → returns `{ dur, pauses, activeMs, firstMark, longest, bins, binMs, pbins, cov, colors, undos, hasPressure }`. Pure function of the session; no DOM. All charts read from its output. Add new metrics here, not inside chart functions.
4. **Charts** are `chartTempo / chartPauses / chartPressure / chartCoverage / chartSequence`, each self-contained, each reading `R.A` (the analysis) and `R.s` (the session). Pressure chart no-ops when `hasPressure` is false.
5. **State objects:** `App` (index/library), `D` (live drawing), `R` (review/replay). Global-ish by design for a single-file app; when you modularize, keep them as clearly-scoped singletons, not React state — see §7.

---

## 6. Decisions that LOOK like bugs but are intentional

Do not "fix" these without Josh's sign-off. Put this list in `CLAUDE.md`.

1. **Client codes, never names.** Every session is keyed to a code (e.g. `S-0709-A`). This is a privacy control, not a placeholder. Do not add a "client name" field.
2. **Palm rejection disables touch after Pencil use.** Once `hasPen` is true, finger input is ignored for that session. Intended — prevents palm marks. Not a bug.
3. **Undo is an event, not a deletion.** Undone strokes stay in the data with an `un` timestamp and replay shows them appear then vanish. This is clinically meaningful (hesitation, self-correction). Never hard-delete on undo.
4. **Canvas size locks at session start.** Rotating the device letterboxes rather than reflowing. Reflowing would corrupt recorded coordinates. See §7.2 for the proper fix.
5. **Pauses ≥ 2 s are first-class.** The 2-second threshold and the ochre color for silence are deliberate — pauses/tempo are Amy's top-ranked signal. Keep silence visually prominent.
6. **No hover-only affordances.** Every hover tooltip also has a tap trigger (no hover on touch). Maintain this dual-trigger rule for anything new.
7. **Selection/callout blocking on the draw surface.** `user-select`, `-webkit-touch-callout`, and `selectstart` are suppressed on the canvas so finger-drawing doesn't trigger iOS copy/lookup. Note text and inputs remain selectable on purpose.

---

## 7. Known limitations & migration triggers

Honest tech debt. Each has a "fix when" trigger so you don't over-engineer the MVP.

1. **~5 MB per-session ceiling.** Both `localStorage` and `window.storage` cap per key. Dense 20-min Pencil sessions approach it. **Fix when:** first real multi-session clinical use → move to IndexedDB (local) and/or a backend (§8). Point thinning already runs; don't remove it.
2. **Viewport-locked dimensions.** A phone-drawn session replays small on iPad. **Fix when:** you add a backend — store logical drawing coordinates + aspect ratio and scale on replay, rather than raw device px.
3. **Coverage ignores erasing.** The canvas-coverage metric doesn't subtract erased area. Documented in the chart's own caption. **Fix when:** Amy says coverage accuracy matters clinically.
4. **Thumbnails bloat the index.** Base64 JPEGs live inside the index array. Fine at small scale. **Fix when:** library exceeds ~50 sessions → move thumbs to their own keys or generate on demand.
5. **No auth / no consent capture / no audit log.** Local-only, single-therapist. **Fix when:** hosting for anyone beyond Josh & Amy → this is a hard gate, see §8.
6. **Framework migration trigger:** stay vanilla until you need (a) multi-device sync, (b) real auth, or (c) shared state across views that's painful to manage by hand. At that point the recommended path is a small backend + keep the canvas/replay engine as framework-agnostic vanilla modules (they're performance-sensitive and don't want a virtual DOM in the hot path).

---

## 8. Clinical & compliance guardrails (non-negotiable)

Amy is the clinical decision-maker. These are guardrails, not features to optimize away.

1. **PHI boundary.** Josh + Amy testing with their own drawings = no protected health information, no exposure. The moment a real client's session is recorded, it becomes part of the clinical record.
2. **Hosting for other therapists makes you a HIPAA Business Associate.** That triggers: signed Business Associate Agreements (BAAs), encryption at rest and in transit, access logging, and consent capture. Do not ship a hosted multi-tenant version without these. Flag it to Josh before building anything that stores another clinician's client data off-device.
3. **Access is therapists-only.** The intended eventual gate is credential verification against the Art Therapy Credentials Board (ATCB) registry. Until that exists, the app must not present itself as approved for clinical use with real clients beyond the owners' own testing.
4. **Data minimization by default.** Codes not names, local-first, therapist-held exports. Any new feature that widens data collection needs an explicit reason and Josh's sign-off.

---

## 9. Suggested repo structure

Keep the split boring and buildable. One option:

```
pentimento/
  index.html            # markup + CSS (formerly shell.html, minus the @@token)
  src/
    storage.js          # store adapter (window.storage | localStorage), K_IDX, K_S
    model.js            # uid, session/stroke/note factories, schema version
    draw.js             # live recording: pointer handling, drawStrokeOn, tray, undo
    replay.js           # review engine: renderAt, seek, tick, scrubber, tooltips
    analyze.js          # analyze(session) — pure metrics
    charts.js           # the five d3 charts
    home.js             # library, import/export
    app.js              # boot + router (show/screen switching)
  vendor/d3.min.js      # self-hosted, with graceful-degradation fallback kept
  samples/sample.json   # one recorded session for tests/demo
  test/smoke.test.js
  CLAUDE.md             # §6 + §8 pasted in
  HANDOFF.md            # this file
```

1. Preserve the single-file *output* as a build artifact if convenient (concat step), but develop in modules.
2. `drawStrokeOn` and the point schema must be importable by both `draw.js` and `replay.js` — put the shared render primitive somewhere both can reach (e.g. a `canvas.js`).
3. Don't add TypeScript in pass one unless Josh asks; if you do, start with the data-model types in §4 since that's the contract most worth typing.

---

## 10. Prioritized backlog (Josh & Amy to confirm order)

**v0.2 — make it clinically citable**
1. **FEATS proxy scores.** Formal Elements Art Therapy Scale — the validated 14-element system Amy already uses. Auto-compute proxies from the event stream: implied energy (stroke count/length), space (% canvas used), color prominence, line quality. This is the bridge from "neat replay" to data her peers respect. Amy defines acceptable proxies.
2. **Cross-session comparison.** Same client code, week over week, same metrics on shared axes. The outcome-tracking story art therapy has never had.
3. **Standardized task mode.** Optional fixed prompt (e.g. PPAT — Person Picking an Apple from a Tree) so sessions are comparable across clients and time.

**v0.3 — make it safe to share**
4. IndexedDB migration (lifts the 5 MB ceiling).
5. Consent capture + audit log scaffolding.
6. Backend + auth spike (this is where framework/migration questions get answered).

**Later**
7. ATCB credential gating.
8. Live remote sessions — stream stroke events to the therapist's screen in real time (the recording format already supports this; it's a transport problem).

---

## 11. Glossary

- **Event stream** — the ordered list of `[x, y, t, pressure]` points; the raw material everything derives from.
- **FEATS** — Formal Elements Art Therapy Scale; validated rating system, 14 elements.
- **PPAT** — Person Picking an Apple from a Tree; standard drawing task FEATS is scored on.
- **ATCB** — Art Therapy Credentials Board; the registry for credential verification.
- **PHI** — Protected Health Information (HIPAA).
- **BAA** — Business Associate Agreement (HIPAA contract required when handling another entity's PHI).
- **Pentimento** — a painting term: visible traces of earlier work an artist changed. The app makes those traces the point.

---

*First task recap: reproduce current behavior in the repo structure (§9), add `CLAUDE.md` from §6 + §8, write the smoke test (§1.3), change nothing about the data model (§4) or the intentional decisions (§6) without Josh's sign-off.*
