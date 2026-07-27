#!/usr/bin/env node
/**
 * Rasterize the site logo (public/assets/images/logo.svg) into the favicon set.
 * Outputs are committed — nothing here runs at build time.
 *
 *   npm run make:icons
 *
 * Produces:
 *   public/favicon.ico              (16 + 32 + 48 multi-size)
 *   public/apple-touch-icon.png     (180×180, flattened on cream — iOS dislikes transparency)
 *   public/assets/images/icon-192.png, icon-512.png (web manifest)
 */
import { readFile, writeFile } from 'node:fs/promises';
import path from 'node:path';
import { fileURLToPath } from 'node:url';
import sharp from 'sharp';
import pngToIco from 'png-to-ico';

const siteRoot = path.dirname(path.dirname(fileURLToPath(import.meta.url)));
const pub = (...p) => path.join(siteRoot, 'public', ...p);

const svg = await readFile(pub('assets', 'images', 'logo.svg'));
const SVG_SIZE = 120; // logo.svg viewBox is 120×120

// Render the SVG at an exact pixel size (density scales the 72dpi default).
function renderPng(size, { background } = {}) {
  let img = sharp(svg, { density: (72 * size) / SVG_SIZE }).resize(size, size);
  if (background) img = img.flatten({ background });
  return img.png().toBuffer();
}

const icoSizes = await Promise.all([16, 32, 48].map((s) => renderPng(s)));
await writeFile(pub('favicon.ico'), await pngToIco(icoSizes));

await writeFile(pub('apple-touch-icon.png'), await renderPng(180, { background: '#FCF8F0' }));
await writeFile(pub('assets', 'images', 'icon-192.png'), await renderPng(192));
await writeFile(pub('assets', 'images', 'icon-512.png'), await renderPng(512));

console.log('✓ favicon.ico (16/32/48), apple-touch-icon.png (180), icon-192.png, icon-512.png');
