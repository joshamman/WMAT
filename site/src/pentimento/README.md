# Pentimento

An art-therapy **process** recorder. It records the entire act of drawing as a
timestamped event stream, then lets a credentialed therapist replay it, scrub it,
annotate it, and read metrics off it. The finished picture is the least interesting
output; the **how** and **when** of its making is the product.

Plain HTML / CSS / JS — no build step, no bundler, no backend. One dependency (d3),
self-hosted in `vendor/`. See `HANDOFF.md` for the full brief and `CLAUDE.md` for the
intentional-decision + clinical guardrails.

## Run it

Open **`index.html`** in any modern browser. It loads `styles.css`, `src/*.js`, and
`vendor/d3.min.js` from alongside it, so **keep the folder together** — the app is the
folder, not a single file. Works by double-clicking (over `file://`) or when served.

On **iPad / iPhone**: open in Safari → Share → **Add to Home Screen** → launches
full-screen like a native app.

Storage auto-detects its environment: `window.storage` inside a Claude artifact,
`localStorage` as a standalone file. Export / Import JSON is the bridge between copies.

## Deploy

**Upload the whole folder** and point the browser at `index.html`. There's no build:
the files you edit are the files you ship. The only thing that must travel together is
the folder — `index.html` plus `styles.css`, `src/`, and `vendor/`.

⚠️ Uploading `index.html` **by itself** gives a blank page — it needs its sibling files
(`styles.css`, `src/*.js`, `vendor/d3.min.js`). Always upload the folder.

## Sync across devices (optional · Phase A)

By default the app stores sessions in the browser's `localStorage` — one device, no
sync. To sync **your and Amy's own test sessions** across devices, there's an opt-in
backend: a tiny PHP + MySQL key/value API you host on the existing site (reuses the
legacy WordPress DB — no new cost). Setup is in **[`backend/README.md`](backend/README.md)**;
turn it on by setting `window.PENTIMENTO_BACKEND = { url, token }` in `index.html`.

> ⚠️ **Phase A only — no real client data.** The token lives in the page source (soft
> gate, not real security). Storing an actual client's session would be PHI and needs
> Phase B first (accounts, consent, audit, encryption, signed BAA — see `CLAUDE.md` §8).

## Develop

The files are the source of truth — edit them directly, reload the browser, done.

- **`index.html`** — markup only.
- **`styles.css`** — all styles.
- **`src/*.js`** — the app, split by concern (see Layout). They load as plain `<script>`
  tags that share one global scope, which is what lets the app run over `file://` —
  **do not** convert them to ES modules (ES modules and `fetch()` are blocked on
  `file://`). **Load order matters:** util first, `app.js` (which runs `boot()`) last.
- **`vendor/d3.min.js`** — self-hosted d3 v7.8.5; charts degrade gracefully if it's missing.

## Test

`test/smoke.html` is the regression net (HANDOFF §1.3). It drives the real app through
the actual user path and asserts: replay reaches 100%, stat cards populate, all five
charts render, and the note tooltip opens.

```
node test/server.mjs                      # serves the folder on http://localhost:8123
# then open http://localhost:8123/        (== /test/smoke.html) — green banner = pass
```

Serve over http — `file://` blocks the `fetch()` of the sample. Inside Claude Code you
can instead run the **`pentimento-static`** launch config and read the smoke result from
the preview.

Regenerate the test fixture with `node test/make-sample.mjs` (writes
`samples/sample.json` — a deterministic Pencil session with pauses, an undo, an eraser
stroke, three colors, and two notes so every assertion has something to render).

## Layout

```
index.html          # markup (loads styles.css + src/*.js + vendor/d3); PENTIMENTO_BACKEND config block
styles.css          # all styles
src/
  util.js           # DOM + formatting helpers, uid, toast   (load first)
  storage.js        # storage adapter (backend API | window.storage | localStorage), K_IDX, K_S
  canvas.js         # the ONE shared render primitive — drawStrokeOn & friends. Never fork.
  analyze.js        # analyze(session) -> pure process metrics
  charts.js         # stat cards + the five d3 charts
  draw.js           # live recording: pointer handling, tray, undo, thumbnail
  replay.js         # review engine: replay, scrubber, notes, tooltips
  home.js           # session library + import/export
  app.js            # state, router, resize, boot()           (load last)
vendor/d3.min.js    # self-hosted d3 v7.8.5 (charts degrade gracefully if missing)
backend/            # OPT-IN Phase A sync (see backend/README.md)
  api.php           #   tiny PHP key/value endpoint over the existing MySQL DB
  schema.sql        #   the one table to create
  config.sample.php #   copy to config.php (git-ignored) with DB creds + token
samples/sample.json # recorded session fixture for tests/demo
test/
  smoke.html        # browser smoke test (the regression net)
  server.mjs        # zero-dep static server + in-memory /kv mock (mirrors api.php)
  make-sample.mjs   # regenerates samples/sample.json
CLAUDE.md           # intentional decisions (§6) + clinical guardrails (§8)
HANDOFF.md          # full project brief
```

> This project currently lives inside the West Michigan Art Therapy site repo at
> `site/src/pentimento/`. It is self-contained — when it's ready to become its own
> repo, lift this folder out and `git init` it.
