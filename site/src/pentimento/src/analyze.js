/* pentimento · analyze — pure process metrics, pauses first (§5.3)
   Extracted verbatim from the single-file MVP (see HANDOFF.md §5/§9). Behavior unchanged. */
'use strict';

/* ============================================================
   ANALYTICS + CHARTS — pauses first (they ranked #1).
   ============================================================ */
function analyze(s){
  const strokes = s.strokes || [];
  let dur = s.durationMs || 0;
  for (const st of strokes) dur = Math.max(dur, st.t1||0, st.un||0);
  dur = Math.max(dur, 1);

  // idle intervals >= 2s across the whole session (incl. before first mark, after last)
  const pauses = [];
  let cursor = 0;
  for (const st of strokes){
    if (st.t0 - cursor >= 2000) pauses.push({t0:cursor, t1:st.t0, d:st.t0-cursor});
    cursor = Math.max(cursor, st.t1);
  }
  if (dur - cursor >= 2000) pauses.push({t0:cursor, t1:dur, d:dur-cursor});

  const activeMs = strokes.reduce((a,st)=> a + Math.max(1, st.t1-st.t0), 0);
  const firstMark = strokes.length ? strokes[0].t0 : dur;
  const longest = pauses.reduce((a,p)=> Math.max(a,p.d), 0);

  // bins
  const binMs = Math.max(1000, Math.ceil(dur/80/500)*500);
  const nb = Math.ceil(dur/binMs);
  const rate = new Array(nb).fill(0);
  const pr = Array.from({length:nb}, ()=>null); // pressure {sum,n,min,max}
  for (const st of strokes){
    const isPen = st.pt === 'pen';
    for (const p of st.pts){
      const b = Math.min(nb-1, Math.floor(p[2]/binMs));
      rate[b]++;
      if (isPen){
        if (!pr[b]) pr[b] = {sum:0,n:0,min:1,max:0};
        pr[b].sum += p[3]; pr[b].n++;
        pr[b].min = Math.min(pr[b].min, p[3]); pr[b].max = Math.max(pr[b].max, p[3]);
      }
    }
  }
  const bins = rate.map((c,i)=> ({t: i*binMs + binMs/2, v: c/(binMs/1000)}));
  const pbins = pr.map((o,i)=> o && o.n ? {t:i*binMs+binMs/2, mean:o.sum/o.n, min:o.min, max:o.max} : null)
                  .filter(Boolean);

  // canvas coverage over time (approx.; ignores erasing)
  const GW = 96, GH = Math.max(8, Math.min(160, Math.round(GW*s.h/Math.max(1,s.w))));
  const grid = new Uint8Array(GW*GH);
  let covered = 0; const total = GW*GH;
  const cov = [{t:0, pct:0}];
  let edge = binMs;
  for (const st of strokes){
    if (st.tool === 'eraser') continue;
    for (const p of st.pts){
      while (p[2] > edge){ cov.push({t:edge, pct:covered/total*100}); edge += binMs; }
      const gx = Math.max(0, Math.min(GW-1, Math.floor(p[0]/s.w*GW)));
      const gy = Math.max(0, Math.min(GH-1, Math.floor(p[1]/s.h*GH)));
      const gi = gy*GW+gx;
      if (!grid[gi]){ grid[gi]=1; covered++; }
    }
  }
  cov.push({t:dur, pct:covered/total*100});

  const colors = new Set(strokes.filter(st=>st.tool!=='eraser').map(st=>st.color));
  const undos = strokes.filter(st=>st.un!=null).length;

  return { dur, pauses, activeMs, firstMark, longest, bins, binMs, pbins,
           cov, colors:[...colors], undos,
           hasPressure: pbins.length > 0 };
}
