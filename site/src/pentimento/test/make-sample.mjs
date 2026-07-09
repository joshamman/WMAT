#!/usr/bin/env node
/* Regenerate samples/sample.json — a deterministic recorded session used by the
 * smoke test and as a demo import. It is a Pencil session (pressure present) that
 * deliberately contains: 3 pauses >= 2s, one undone stroke, an eraser stroke, three
 * colors, and two pinned notes — so every stat, all five charts, and the note
 * tooltip have something to render. Schema is HANDOFF §4 (times = ms from t0).
 * Run:  node test/make-sample.mjs
 */
import { writeFileSync } from 'node:fs';
import { fileURLToPath } from 'node:url';
import { dirname, join } from 'node:path';

const r1 = (n) => Math.round(n * 10) / 10;     // coords: 1 decimal (matches ptFrom)
const r2 = (n) => Math.round(n * 100) / 100;   // pressure: 2 decimals

// Sample a stroke's event stream along a straight path, ~16ms/point, gentle pressure.
function stroke({ i, t0, t1, color, tool = 'brush', pt = 'pen', size = 9, un = null,
                  from, to, press = 0.5 }) {
  const pts = [];
  const steps = Math.max(1, Math.round((t1 - t0) / 16));
  for (let k = 0; k <= steps; k++) {
    const f = k / steps;
    const t = Math.round(t0 + (t1 - t0) * f);
    const x = r1(from[0] + (to[0] - from[0]) * f);
    const y = r1(from[1] + (to[1] - from[1]) * f);
    const p = pt === 'pen' ? r2(Math.max(0.05, Math.min(1, press + 0.18 * Math.sin(f * Math.PI)))) : 0;
    pts.push([x, y, t, p]);
  }
  return { i, t0: pts[0][2], t1: pts[pts.length - 1][2], tool, color, size, pt, un, pts };
}

const AT = '2026-07-09T15:00:00.000Z';
const strokes = [
  stroke({ i: 'a', t0: 800,   t1: 1800,  color: '#1A1A1A', from: [280, 300], to: [300, 760], press: 0.52 }),
  stroke({ i: 'b', t0: 4300,  t1: 5600,  color: '#C7362B', from: [300, 540], to: [620, 520], press: 0.61 }),
  stroke({ i: 'c', t0: 5800,  t1: 6300,  color: '#1A1A1A', from: [360, 360], to: [400, 420], press: 0.40, un: 8000 }),
  stroke({ i: 'd', t0: 8700,  t1: 10200, color: '#3E7C4F', from: [300, 300], to: [640, 780], press: 0.55 }),
  stroke({ i: 'e', t0: 10500, t1: 11000, color: '#1A1A1A', tool: 'eraser', from: [610, 520], to: [560, 520] }),
];
const notes = [
  { t: 4300, text: '2.5s pause, then commits to the red horizontal.', at: AT },
  { t: 8000, text: 'Undoes the small black mark — first visible self-correction.', at: AT },
];

const session = {
  v: 1, id: 'sample-0709-a', code: 'S-0709-A', startedAt: AT,
  w: 820, h: 1180, hasPen: true, durationMs: 13500, thumb: '',
  strokes, notes,
};

const OUT = join(dirname(fileURLToPath(import.meta.url)), '..', 'samples', 'sample.json');
writeFileSync(OUT, JSON.stringify(session, null, 0) + '\n');
console.log(`wrote ${OUT}: ${strokes.length} strokes, ${notes.length} notes, dur ${session.durationMs}ms`);
