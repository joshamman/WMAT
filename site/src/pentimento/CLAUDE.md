# Pentimento — guardrails for future sessions

An art-therapy **process** recorder: it records the whole act of drawing as a
timestamped event stream, then lets a credentialed therapist replay, scrub,
annotate, and read metrics off it. The finished picture is the least interesting
output; the **how** and **when** of its making is the product.

`HANDOFF.md` is the full brief (architecture, data model, backlog). **This file is
the short list of things you must not quietly undo.** Josh is the product owner and
does not write code day-to-day — give him concrete, numbered, important-first
summaries; he decides product direction, you implement. **Amy** (board-certified art
therapist) is the clinical authority — any question about clinical meaning, scoring,
or workflow is her call, not yours.

## Prime directive
Do not "fix" anything in the two lists below without Josh's sign-off, and do not
change the data model (HANDOFF §4) or these decisions on your own initiative. Several
of them look like bugs and are not.

---

## Decisions that LOOK like bugs but are intentional (HANDOFF §6)

1. **Client codes, never names.** Every session is keyed to a code (e.g. `S-0709-A`).
   This is a privacy control, not a placeholder. Do not add a "client name" field.
2. **Palm rejection disables touch after Pencil use.** Once `hasPen` is true, finger
   input is ignored for that session. Intended — prevents palm marks. Not a bug.
3. **Undo is an event, not a deletion.** Undone strokes stay in the data with an `un`
   timestamp and replay shows them appear then vanish. This is clinically meaningful
   (hesitation, self-correction). Never hard-delete on undo.
4. **Canvas size locks at session start.** Rotating the device letterboxes rather than
   reflowing. Reflowing would corrupt recorded coordinates. See HANDOFF §7.2 for the
   proper fix (store logical coords + aspect ratio; scale on replay).
5. **Pauses ≥ 2 s are first-class.** The 2-second threshold and the ochre color for
   silence are deliberate — pauses/tempo are Amy's top-ranked signal. Keep silence
   visually prominent.
6. **No hover-only affordances.** Every hover tooltip also has a tap trigger (no hover
   on touch). Maintain this dual-trigger rule for anything new.
7. **Selection/callout blocking on the draw surface.** `user-select`,
   `-webkit-touch-callout`, and `selectstart` are suppressed on the canvas so
   finger-drawing doesn't trigger iOS copy/lookup. Note text and inputs remain
   selectable on purpose.

---

## Clinical & compliance guardrails — non-negotiable (HANDOFF §8)

Amy is the clinical decision-maker. These are guardrails, not features to optimize away.

1. **PHI boundary.** Josh + Amy testing with their own drawings = no protected health
   information, no exposure. The moment a real client's session is recorded, it becomes
   part of the clinical record.
2. **Hosting for other therapists makes you a HIPAA Business Associate.** That triggers:
   signed Business Associate Agreements (BAAs), encryption at rest and in transit,
   access logging, and consent capture. Do not ship a hosted multi-tenant version
   without these. Flag it to Josh before building anything that stores another
   clinician's client data off-device.
3. **Access is therapists-only.** The intended eventual gate is credential verification
   against the Art Therapy Credentials Board (ATCB) registry. Until that exists, the app
   must not present itself as approved for clinical use with real clients beyond the
   owners' own testing.
4. **Data minimization by default.** Codes not names, local-first, therapist-held
   exports. Any new feature that widens data collection needs an explicit reason and
   Josh's sign-off.

---

## How the code is wired (so you don't break the split)

- **Vanilla on purpose.** No framework, no backend, no bundler. One dependency: **d3**
  (self-hosted at `vendor/d3.min.js`), loaded with a graceful "charts unavailable"
  fallback if it's missing. Do not add dependencies in this pass — migration triggers
  are HANDOFF §7 (stay vanilla until you need multi-device sync, real auth, or shared
  cross-view state that's painful by hand).
- **No build step — the files are the app.** `index.html` (markup) + `styles.css` +
  `src/*.js` + `vendor/d3.min.js` are edited and shipped as-is. There is deliberately no
  bundler and no single-file build; deploy by uploading the **whole folder**. (`index.html`
  alone is blank — it needs its siblings.)
- **`index.html` runs directly over `file://`** (double-click, or Safari → Add to Home
  Screen). It loads `styles.css` and `src/*.js` as plain, classic tags — **not** ES modules
  — because ES modules and `fetch()` are blocked on `file://`. The scripts share one global
  scope; **load order matters** (util first, `app.js`/`boot()` last).
- **`src/canvas.js` is the ONE shared render primitive** (`drawStrokeOn` & friends), used
  by live drawing, replay, and thumbnails so what the therapist replays is pixel-identical
  to what the client drew. **Never fork it** (HANDOFF §5.1).
- **`src/analyze.js` is a pure function** of the session (no DOM). Add new metrics there,
  not inside chart functions.
- **Regression net:** `test/smoke.html` (run via `node test/server.mjs`). Run it before
  and after any refactor — it asserts replay reaches 100%, stats populate, all five
  charts render, and the note tooltip opens.
