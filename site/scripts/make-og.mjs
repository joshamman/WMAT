#!/usr/bin/env node
/**
 * Generate the default Open Graph / social card (1200×630) at
 * public/assets/images/og-default.png. The output is committed — nothing here
 * runs at build time.
 *
 *   npm run make:og
 *
 * Text is converted to outlined glyph paths via fontkit from the self-hosted
 * variable fonts, so rasterization never depends on system fonts or
 * librsvg's @font-face support.
 */
import { writeFile } from 'node:fs/promises';
import path from 'node:path';
import { fileURLToPath } from 'node:url';
import sharp from 'sharp';
import * as fontkit from 'fontkit';

const siteRoot = path.dirname(path.dirname(fileURLToPath(import.meta.url)));
const pub = (...p) => path.join(siteRoot, 'public', ...p);

const W = 1200;
const H = 630;

// Brand tokens (see src/styles/global.css)
const CREAM = '#FCF8F0';
const NAVY = '#142F49';
const TEAL = '#266F70';
const TEAL_DEEP = '#1E5859';
const GOLD = '#E8B33D';
const SAGE = '#7E8B4A';
const SKY = '#8FC6DE';
const INK_700 = '#3A4954';

// NOTE: fontkit's getVariation() returns a broken instance for these WOFF2
// variable fonts (missing head/cmap), so we render at the default weight (400)
// and thicken with a subtle same-color stroke where extra presence is needed.
const loadFont = (file) => fontkit.openSync(pub('assets', 'fonts', file));

const newsreader = loadFont('newsreader-variable.woff2');
const hanken = loadFont('hanken-grotesk-variable.woff2');

/** Lay out one line of text as outlined SVG <path> elements. */
function textPaths(font, text, fontSize, { letterSpacing = 0 } = {}) {
  const scale = fontSize / font.unitsPerEm;
  const run = font.layout(text);
  let x = 0;
  const parts = [];
  run.glyphs.forEach((glyph, i) => {
    const pos = run.positions[i];
    const d = glyph.path.toSVG();
    if (d) {
      const gx = (x + pos.xOffset * scale).toFixed(2);
      const gy = (-pos.yOffset * scale).toFixed(2);
      const s = scale.toFixed(6);
      parts.push(`<path transform="translate(${gx} ${gy}) scale(${s} -${s})" d="${d}"/>`);
    }
    x += pos.xAdvance * scale + letterSpacing;
  });
  if (run.glyphs.length > 0) x -= letterSpacing;
  return { svg: parts.join(''), width: x };
}

/** A line of outlined text centered at (cx, baselineY). */
function centeredLine(font, text, fontSize, cx, baselineY, fill, opts = {}) {
  const { svg, width } = textPaths(font, text, fontSize, opts);
  const tx = (cx - width / 2).toFixed(2);
  // A hairline same-color stroke fakes a heavier weight (getVariation is broken, see above).
  const stroke = opts.embolden ? ` stroke="${fill}" stroke-width="${opts.embolden}"` : '';
  return `<g fill="${fill}"${stroke} transform="translate(${tx} ${baselineY})">${svg}</g>`;
}

// Layered wave bands along the bottom — same motif as the footer's WaveDivider
// (paths adapted from src/components/Footer.astro, viewBox 0 0 1440 90).
const waves = `
  <g transform="translate(0 528) scale(${(W / 1440).toFixed(4)} 1.1334)">
    <path d="M0,30 C240,66 480,6 720,30 C960,54 1200,12 1440,36 L1440,90 L0,90 Z" fill="${SKY}" opacity="0.55"/>
    <path d="M0,48 C260,78 520,22 760,48 C1000,74 1220,34 1440,56 L1440,90 L0,90 Z" fill="${TEAL}" opacity="0.85"/>
    <path d="M0,66 C300,90 560,48 820,66 C1080,84 1240,58 1440,72 L1440,90 L0,90 Z" fill="${NAVY}"/>
  </g>`;

const svg = `<svg xmlns="http://www.w3.org/2000/svg" width="${W}" height="${H}" viewBox="0 0 ${W} ${H}">
  <defs>
    <radialGradient id="gTeal"><stop offset="0" stop-color="${TEAL}" stop-opacity="0.20"/><stop offset="1" stop-color="${TEAL}" stop-opacity="0"/></radialGradient>
    <radialGradient id="gGold"><stop offset="0" stop-color="${GOLD}" stop-opacity="0.34"/><stop offset="1" stop-color="${GOLD}" stop-opacity="0"/></radialGradient>
    <radialGradient id="gSage"><stop offset="0" stop-color="${SAGE}" stop-opacity="0.18"/><stop offset="1" stop-color="${SAGE}" stop-opacity="0"/></radialGradient>
    <radialGradient id="gSky"><stop offset="0" stop-color="${SKY}" stop-opacity="0.22"/><stop offset="1" stop-color="${SKY}" stop-opacity="0"/></radialGradient>
  </defs>

  <rect width="${W}" height="${H}" fill="${CREAM}"/>

  <!-- soft watercolor washes -->
  <circle cx="130" cy="110" r="300" fill="url(#gTeal)"/>
  <circle cx="1040" cy="130" r="270" fill="url(#gGold)"/>
  <circle cx="180" cy="520" r="240" fill="url(#gSage)"/>
  <circle cx="1080" cy="470" r="230" fill="url(#gSky)"/>

  <!-- gold sun, echoing the logo -->
  <circle cx="1032" cy="128" r="40" fill="${GOLD}" opacity="0.92"/>
  <circle cx="1032" cy="128" r="58" fill="none" stroke="${GOLD}" stroke-opacity="0.45" stroke-width="3"/>

  ${centeredLine(hanken, 'WEST MICHIGAN ART THERAPY', 32, W / 2, 215, TEAL_DEEP, { letterSpacing: 9, embolden: 1.1 })}
  ${centeredLine(newsreader, 'Heal through creativity', 104, W / 2, 342, NAVY, { embolden: 1.4 })}
  ${centeredLine(hanken, 'Amy Rostollan-Hamman, ATR-BC   ·   West Olive, Michigan', 31, W / 2, 418, INK_700)}

  ${waves}
</svg>`;

await sharp(Buffer.from(svg)).png().toFile(pub('assets', 'images', 'og-default.png'));
console.log('✓ og-default.png (1200×630)');
