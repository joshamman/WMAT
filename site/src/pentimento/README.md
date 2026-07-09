# Pentimento

An art-therapy **process** recorder. It records the entire act of drawing as a
timestamped event stream, then lets a credentialed therapist replay it, scrub it,
annotate it, and read metrics off it. The finished picture is the least interesting
output; the **how** and **when** of its making is the product.

Vanilla HTML/CSS/JS. One dependency (d3, self-hosted). No build required to run, no
server, no backend. See `HANDOFF.md` for the full brief and `CLAUDE.md` for the
intentional-decision + clinical guardrails.

## Run it

There are two ways to open the app, and it matters which file you use:

- **The whole folder together** — open **`index.html`**. It loads `src/*.js` and
  `vendor/d3.min.js` from alongside it, so those folders must be present. Works by
  double-clicking (over `file://`) or when the folder is served. Best for development.
- **One self-contained file** — open **`pentimento.html`** (or `deploy/index.html`).
  Everything, including d3, is inlined into that single file — no other files needed.
  Best for AirDrop to the iPad, email, or **deploying** (see below).

On **iPad / iPhone**: open in Safari → Share → **Add to Home Screen** → launches
full-screen like a native app.

Storage auto-detects its environment: `window.storage` inside a Claude artifact,
`localStorage` as a standalone file. Export / Import JSON is the bridge between copies.

## Deploy

**Upload `deploy/index.html`** — that one file *is* the whole app (code + d3 inlined),
so it works on its own. Rebuild it with `node build.mjs` after any change to `src/*`.

⚠️ **Do not upload the top-level `index.html` by itself.** That one is the *dev* entry:
it references `src/*.js` and `vendor/d3.min.js`, so on its own (with those folders
missing) it loads nothing and the page is blank. Either deploy `deploy/index.html`, or
upload the entire folder so the `src/` and `vendor/` files travel with it.

## Develop

Source of truth is `index.html` + the `src/*.js` modules. They load as plain
`<script>` tags (classic scripts sharing one global scope), which is what lets the app
run over `file://` — **do not** convert them to ES modules (ES modules and `fetch()`
are blocked on `file://`). **Load order matters:** util first, `app.js` (which runs
`boot()`) last.

Regenerate the self-contained build after editing `src/*`:

```
node build.mjs        # index.html + src/*.js + vendor/d3  ->  pentimento.html AND deploy/index.html
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
index.html          # DEV entry — markup + CSS; loads src/*.js + vendor/d3 (needs the folder)
deploy/index.html   # DEPLOY this — self-contained single file (app + d3 inlined). Generated.
pentimento.html     # same self-contained build, at the root (local use / email). Generated.
build.mjs           # inlines src/*.js AND vendor/d3 -> pentimento.html + deploy/index.html
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
