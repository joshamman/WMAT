# Pentimento

An art-therapy **process** recorder. It records the entire act of drawing as a
timestamped event stream, then lets a credentialed therapist replay it, scrub it,
annotate it, and read metrics off it. The finished picture is the least interesting
output; the **how** and **when** of its making is the product.

Vanilla HTML/CSS/JS. One dependency (d3, self-hosted). No build required to run, no
server, no backend. See `HANDOFF.md` for the full brief and `CLAUDE.md` for the
intentional-decision + clinical guardrails.

## Run it

- **Desktop:** open **`index.html`** in any modern browser — no server needed.
- **iPad / iPhone:** open in Safari → Share → **Add to Home Screen** → launches
  full-screen like a native app.
- `pentimento.html` is a single-file build of the same thing (handy to email around).

Storage auto-detects its environment: `window.storage` inside a Claude artifact,
`localStorage` as a standalone file. Export / Import JSON is the bridge between copies.

## Develop

Source of truth is `index.html` + the `src/*.js` modules. They load as plain
`<script>` tags (classic scripts sharing one global scope), which is what lets the app
run over `file://` — **do not** convert them to ES modules (ES modules and `fetch()`
are blocked on `file://`). **Load order matters:** util first, `app.js` (which runs
`boot()`) last.

Regenerate the single-file build after editing `src/*`:

```
node build.mjs        # index.html + src/*.js  ->  pentimento.html
```

## Test

`test/smoke.html` is the regression net (HANDOFF §1.3). It drives the real app through
the actual user path and asserts: replay reaches 100%, stat cards populate, all five
charts render, and the note tooltip opens.

```
node test/server.mjs                      # serves the folder on http://localhost:8123
# then open http://localhost:8123/        (== /test/smoke.html) — green banner = pass
```

It runs against `index.html` by default; append `?target=pentimento.html` to test the
built file. (Serve over http — `file://` blocks `fetch()` and the sample load.) Inside
Claude Code you can instead run the **`pentimento-static`** launch config and read the
smoke result from the preview.

Regenerate the test fixture with `node test/make-sample.mjs` (writes
`samples/sample.json` — a deterministic Pencil session with pauses, an undo, an eraser
stroke, three colors, and two notes so every assertion has something to render).

## Layout

```
index.html          # markup + CSS; loads src/*.js (runnable dev entry & build template)
pentimento.html     # single-file build output (node build.mjs) — do not hand-edit
build.mjs           # inlines src/*.js into pentimento.html (the @@APP_JS@@ concat)
src/
  util.js           # DOM + formatting helpers, uid, toast   (load first)
  storage.js        # storage adapter (window.storage | localStorage), K_IDX, K_S
  canvas.js         # the ONE shared render primitive — drawStrokeOn & friends. Never fork.
  analyze.js        # analyze(session) -> pure process metrics
  charts.js         # stat cards + the five d3 charts
  draw.js           # live recording: pointer handling, tray, undo, thumbnail
  replay.js         # review engine: replay, scrubber, notes, tooltips
  home.js           # session library + import/export
  app.js            # state, router, resize, boot()           (load last)
vendor/d3.min.js    # self-hosted d3 v7.8.5 (charts degrade gracefully if missing)
samples/sample.json # recorded session fixture for tests/demo
test/
  smoke.html        # browser smoke test (the regression net)
  server.mjs        # zero-dep static server for running the test
  make-sample.mjs   # regenerates samples/sample.json
CLAUDE.md           # intentional decisions (§6) + clinical guardrails (§8)
HANDOFF.md          # full project brief
```

> This project currently lives inside the West Michigan Art Therapy site repo at
> `site/src/pentimento/`. It is self-contained — when it's ready to become its own
> repo, lift this folder out and `git init` it.
