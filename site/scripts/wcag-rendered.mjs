#!/usr/bin/env node
/**
 * Rendered-cascade contrast guard.
 *
 * The pair check (wcag-contrast.mjs) verifies the colors we *intend* to use.
 * This check verifies the colors that actually *win the CSS cascade* for key
 * interactive elements — catching specificity bugs like an ancestor
 * `.j-nav a { color: gray }` overriding `.j-cta { color: cream }` (which made
 * the home "Begin"/"Contact" button render gray-on-green at rest).
 *
 * Reads the COMPILED CSS in dist/, so run after a build:
 *   npm run build && node scripts/wcag-rendered.mjs
 *
 * Each ELEMENT lists the selectors that match it (rest state only) — keep this in
 * sync if you add interactive elements. Fails (exit 1) below the AA threshold.
 */
import fs from 'node:fs';
import path from 'node:path';

const DIST = 'dist/_astro';
if (!fs.existsSync(DIST)) {
  console.error('\n  No dist/ build found. Run `npm run build` first.\n');
  process.exit(1);
}
const css = fs.readdirSync(DIST).filter((f) => f.endsWith('.css'))
  .map((f) => fs.readFileSync(path.join(DIST, f), 'utf8')).join('\n');

const vars = {};
for (const m of css.matchAll(/(--[a-z0-9-]+):\s*([^;]+);/g)) vars[m[1].trim()] = m[2].trim();
const resolve = (v) => { let g = 0; while (v && v.includes('var(') && g++ < 6) v = v.replace(/var\(\s*(--[a-z0-9-]+)\s*(?:,\s*([^)]+))?\)/g, (_, n, f) => vars[n] || f || ''); return v.trim(); };
const spec = (sel) => { const a = (sel.match(/#/g) || []).length, b = (sel.match(/\.|\[|:(?!:)/g) || []).length, c = (sel.match(/(^|[\s>+~])[a-z]/gi) || []).length; return a * 100 + b * 10 + c; };

// Each element: the set of rest-state selectors (from our CSS) that match it.
const ELEMENTS = [
  { name: 'Home header CTA (.j-cta)', match: new Set(['a', '.j-cta', '.j-nav a', '.j-nav a.j-cta', 'a.j-cta', '.j-header .j-cta']) },
  { name: 'Nav link (.j-nav a)', match: new Set(['a', '.j-nav a']) },
];

const h2r = (h) => { h = h.replace('#', ''); if (h.length === 3) h = h.split('').map((c) => c + c).join(''); return [0, 2, 4].map((i) => parseInt(h.slice(i, i + 2), 16)); };
const lin = (c) => { c /= 255; return c <= 0.04045 ? c / 12.92 : Math.pow((c + 0.055) / 1.055, 2.4); };
const L = (h) => { const [r, g, b] = h2r(h).map(lin); return 0.2126 * r + 0.7152 * g + 0.0722 * b; };
const ratio = (a, b) => { const x = L(a), y = L(b); return (Math.max(x, y) + 0.05) / (Math.min(x, y) + 0.05); };

const rules = [...css.matchAll(/([^{}]+)\{([^}]*)\}/g)].flatMap((m) =>
  m[1].split(',').map((sel) => ({ sel: sel.trim(), body: m[2] })));

function win(el, prop) {
  let best = null, bestS = -1;
  for (const { sel, body } of rules) {
    if (/:hover|:focus|:active|:visited|::/.test(sel)) continue;
    if (!el.match.has(sel)) continue;
    const re = new RegExp('(?:^|;)\\s*' + prop + '\\s*:\\s*([^;]+)', 'i');
    const mm = body.match(re);
    const s = spec(sel);
    if (mm && s >= bestS) { bestS = s; best = mm[1].trim(); }
  }
  return best ? resolve(best) : null;
}

let failed = 0;
console.log('\n  WCAG rendered-cascade check (compiled CSS)\n  ' + '-'.repeat(54));
for (const el of ELEMENTS) {
  const fg = win(el, 'color');
  const bg = win(el, 'background(?:-color)?');
  if (!fg || !bg || !/^#[0-9a-f]{3,6}$/i.test(fg) || !/^#[0-9a-f]{3,6}$/i.test(bg)) {
    console.log(`  ?  ${el.name}: color=${fg} bg=${bg} (skipped — non-hex or unresolved)`);
    continue;
  }
  const r = ratio(fg, bg), ok = r >= 4.5;
  if (!ok) failed++;
  console.log(`  ${ok ? '✓' : '✗'} ${ok ? 'PASS' : 'FAIL'}  ${r.toFixed(2)}:1  ${el.name}  [${fg} on ${bg}]`);
}
console.log('  ' + '-'.repeat(54));
if (failed) { console.error(`\n  ✗ ${failed} element(s) render below AA. Check CSS specificity.\n`); process.exit(1); }
console.log('\n  ✓ Key interactive elements render at AA or better.\n');
