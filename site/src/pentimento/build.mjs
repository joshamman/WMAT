#!/usr/bin/env node
/* pentimento build — inline the src/* modules into a single-file pentimento.html.
 *
 * index.html is the source of truth (runnable directly over file:// in dev). This
 * step reproduces the original @@APP_JS@@ concat model: it swaps the block of
 * <script src="./src/*.js"> tags for one inline <script> with every module
 * concatenated in the SAME order. No dependencies, no bundler — just fs + string
 * replace (HANDOFF §1.4, §9.1). Run:  node build.mjs
 */
import { readFileSync, writeFileSync } from 'node:fs';
import { fileURLToPath } from 'node:url';
import { dirname, join } from 'node:path';

const ROOT = dirname(fileURLToPath(import.meta.url));
const index = readFileSync(join(ROOT, 'index.html'), 'utf8');

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
const inlined = '<script>\n' + js + '\n</script>';
const out = index.slice(0, a) + inlined + index.slice(b + END.length);

writeFileSync(join(ROOT, 'pentimento.html'), out);
console.log(`build: pentimento.html <- index.html + ${files.length} modules (${files.join(', ')})`);
