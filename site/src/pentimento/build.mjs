#!/usr/bin/env node
/* pentimento build — produce a fully self-contained single file from index.html.
 *
 * index.html is the source of truth (runnable directly over file:// in dev, but it
 * loads src/*.js and vendor/d3.min.js as separate files). This step inlines ALL of
 * them — every module AND d3 — into one HTML file with zero external references, so
 * it can be deployed by uploading a single file. Reproduces the original @@APP_JS@@
 * concat model; no dependencies, no bundler — just fs + string replace (HANDOFF §1.4,
 * §9.1). Run:  node build.mjs
 *
 * Outputs (identical bytes):
 *   pentimento.html    — single self-contained file (local use / email / AirDrop)
 *   deploy/index.html  — the same, named for drop-in deploy (upload THIS, not the dev index.html)
 *   (deploy/ — not dist/, which is Astro's ignored build dir in this repo)
 */
import { readFileSync, writeFileSync, mkdirSync } from 'node:fs';
import { fileURLToPath } from 'node:url';
import { dirname, join } from 'node:path';

const ROOT = dirname(fileURLToPath(import.meta.url));
const index = readFileSync(join(ROOT, 'index.html'), 'utf8');

// neutralise any literal </script> inside inlined JS so it can't close the tag early
const esc = (s) => s.replace(/<\/script>/gi, '<\\/script>');

// 1) inline the app modules where the @@APP_JS@@ marker block sits
const START = '<!-- @@APP_JS@@';
const END = '<!-- /@@APP_JS@@ -->';
const a = index.indexOf(START);
const b = index.indexOf(END);
if (a === -1 || b === -1) {
  console.error('build: could not find @@APP_JS@@ markers in index.html'); process.exit(1);
}
const block = index.slice(a, b + END.length);
// Drive module order from index.html itself so there is one source of truth.
const files = [...block.matchAll(/<script src="\.\/(src\/[^"]+)"><\/script>/g)].map((m) => m[1]);
if (!files.length) { console.error('build: no src/*.js <script> tags found'); process.exit(1); }
const js = files.map((f) => readFileSync(join(ROOT, f), 'utf8').replace(/\s*$/, '')).join('\n\n');
let out = index.slice(0, a) + '<script>\n' + esc(js) + '\n</script>' + index.slice(b + END.length);

// 2) inline d3 so the file has no external dependency at all
const D3_TAG = '<script src="./vendor/d3.min.js"></script>';
if (out.includes(D3_TAG)) {
  const d3 = readFileSync(join(ROOT, 'vendor/d3.min.js'), 'utf8').replace(/\s*$/, '');
  // function replacer: inserts the source literally (d3's minified `$` sequences must
  // NOT be interpreted as String.replace special patterns like $& / $1)
  out = out.replace(D3_TAG, () => '<script>\n' + esc(d3) + '\n</script>');
} else {
  console.warn('build: WARNING — d3 <script src> tag not found; output may not be self-contained');
}

// 3) write both the root single file and the deploy-named copy
writeFileSync(join(ROOT, 'pentimento.html'), out);
mkdirSync(join(ROOT, 'deploy'), { recursive: true });
writeFileSync(join(ROOT, 'deploy', 'index.html'), out);

const kb = Math.round(Buffer.byteLength(out) / 1024);
console.log(`build: pentimento.html + deploy/index.html <- index.html + ${files.length} modules + d3 (self-contained, ${kb} KB)`);
