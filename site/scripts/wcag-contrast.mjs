#!/usr/bin/env node
/**
 * Deterministic WCAG 2.1 contrast checker for the WMAT palette.
 *
 * Maintains an explicit manifest of the foreground/background color pairs the
 * site actually uses, computes the contrast ratio for each, and fails (exit 1)
 * if any pair is below its WCAG AA threshold. Run before publishing:
 *
 *   node scripts/wcag-contrast.mjs
 *   npm run check:contrast
 *
 * AA thresholds: 4.5:1 normal text, 3:1 large text (>=24px, or >=18.66px bold)
 * and UI components / graphical objects.
 */

const hexToRgb = (h) => {
  const s = h.replace('#', '');
  const n = s.length === 3 ? s.split('').map((c) => c + c).join('') : s;
  return [0, 2, 4].map((i) => parseInt(n.slice(i, i + 2), 16));
};
const lin = (c) => {
  const s = c / 255;
  return s <= 0.04045 ? s / 12.92 : Math.pow((s + 0.055) / 1.055, 2.4);
};
const lum = (hex) => {
  const [r, g, b] = hexToRgb(hex).map(lin);
  return 0.2126 * r + 0.7152 * g + 0.0722 * b;
};
const ratio = (fg, bg) => {
  const a = lum(fg), b = lum(bg);
  return (Math.max(a, b) + 0.05) / (Math.min(a, b) + 0.05);
};

// --- Palette ---------------------------------------------------------------
const C = {
  cream50: '#FCF8F0', cream100: '#F6EFDF',
  ink900: '#20303A', ink700: '#3A4954', ink500: '#586771', ink400: '#768089',
  teal600: '#266F70', teal700: '#1E5859', teal500: '#2F8889',
  navy900: '#142F49', navy800: '#1B3D5C',
  gold400: '#E8B33D', gold300: '#F2C84B', gold600: '#A9781C',
  sky300: '#8FC6DE', sky500: '#3E8AB1',
  sage600: '#66723A', clay600: '#8B5E34', clay700: '#6E4824',
  white: '#FFFFFF',
};

// --- Pairs the site uses. type: 'text' (4.5) | 'large' (3) | 'ui' (3) -------
const PAIRS = [
  ['Body text',                 C.ink700,  C.cream50, 'text'],
  ['Strong/heading ink',        C.ink900,  C.cream50, 'text'],
  ['Muted text',                C.ink500,  C.cream50, 'text'],
  ['Eyebrow (teal on cream)',   C.teal600, C.cream50, 'text'],
  ['Link (teal on cream)',      C.teal600, C.cream50, 'text'],
  ['Body on sunken surface',    C.ink700,  C.cream100, 'text'],
  ['Eyebrow on sunken',         C.teal600, C.cream100, 'text'],

  ['Primary button text',       C.cream50, C.teal600, 'text'],
  ['Primary button (hover)',    C.cream50, C.teal700, 'text'],
  ['Outline button label',      C.teal700, C.cream50, 'text'],
  ['Gold button text (ink)',    C.ink900,  C.gold400, 'text'],
  ['"Begin" CTA (j-cta)',       C.cream50, C.teal600, 'text'],

  ['Footer text on navy',       C.cream50, C.navy900, 'text'],
  ['Footer label (sky on navy)', C.sky300, C.navy900, 'text'],
  ['Hero/closing "ink" accent', C.gold300, C.navy900, 'large'],
  ['Region pill text',          C.navy800, C.cream50, 'text'],
  ['"Most popular"/tag (ink on gold)', C.ink900, C.gold300, 'text'],
  ['Service price (navy)',      C.navy900, C.white,   'text'],
  ['Card text (muted on white)', C.ink500, C.white,   'text'],
  ['FAQ summary',               C.ink900,  C.white,   'text'],
];

const need = (t) => (t === 'text' ? 4.5 : 3.0);
let failed = 0;
console.log('\n  WCAG AA contrast check\n  ' + '-'.repeat(58));
for (const [name, fg, bg, type] of PAIRS) {
  const r = ratio(fg, bg);
  const min = need(type);
  const ok = r >= min;
  if (!ok) failed++;
  const tag = ok ? 'PASS' : 'FAIL';
  console.log(
    `  ${ok ? '✓' : '✗'} ${tag}  ${r.toFixed(2)}:1  (need ${min})  ${name}` +
    (ok ? '' : `  [${fg} on ${bg}]`)
  );
}
console.log('  ' + '-'.repeat(58));
if (failed) {
  console.error(`\n  ✗ ${failed} contrast pair(s) below WCAG AA. Fix before publishing.\n`);
  process.exit(1);
}
console.log('\n  ✓ All color pairs pass WCAG AA.\n');
