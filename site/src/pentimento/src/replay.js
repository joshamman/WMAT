/* pentimento · replay — review engine: replay, scrubber, notes, tooltips (§5.2)
   Extracted verbatim from the single-file MVP (see HANDOFF.md §5/§9). Behavior unchanged. */
'use strict';

/* ============================================================
   REVIEW — the light table. Replay, scrubber, notes.
   ============================================================ */
const R = { s:null, A:null, T:0, playing:false, speed:1, lastT:-1,
            ctx:null, k:1, raf:0, wall:0, tAtWall:0 };
const SPEEDS = [1,4,16];
const ICON_PLAY  = '<svg width="20" height="20" viewBox="0 0 20 20"><path d="M6 4.2v11.6L16 10 6 4.2Z" fill="currentColor"/></svg>';
const ICON_PAUSE = '<svg width="20" height="20" viewBox="0 0 20 20"><path d="M5.5 4h3v12h-3zM11.5 4h3v12h-3z" fill="currentColor"/></svg>';

async function openReview(id){
  const s = await store.get(K_S(id));
  if (!s){ toast('Session not found on this device.'); return; }
  R.s = s; R.A = analyze(s);
  R.T = 0; R.playing = false; R.speed = 1; R.lastT = -1;

  $('#rev-code').textContent = s.code;
  const pen = s.hasPen ? 'Pencil' : 'finger';
  $('#rev-sub').textContent = fmtDate(s.startedAt) + ' · ' + fmtT(s.durationMs) +
    ' · ' + s.strokes.length + ' strokes · ' + pen + ' input';

  show('scr-review');
  fitStage();
  buildScrub();
  renderStats();
  renderCharts();
  renderNotes();
  updateTransport();
  seek(0);
}

function fitStage(){
  const s = R.s;
  const wrap = $('.stage-wrap');
  const maxW = Math.min(940, (wrap.clientWidth||window.innerWidth) - 40);
  const maxH = Math.max(240, window.innerHeight*0.55);
  R.k = Math.min(maxW/s.w, maxH/s.h);
  const c = $('#stage'), dpr = Math.min(window.devicePixelRatio||1, 3);
  const cw = Math.round(s.w*R.k), ch = Math.round(s.h*R.k);
  c.width = cw*dpr; c.height = ch*dpr;
  c.style.width = cw+'px'; c.style.height = ch+'px';
  R.ctx = c.getContext('2d');
  R.ctx.setTransform(dpr*R.k,0,0,dpr*R.k,0,0);
  R.ctx.lineCap='round'; R.ctx.lineJoin='round';
}

/* ---------- replay engine ---------- */
function clearStage(){
  const ctx = R.ctx;
  ctx.save(); ctx.setTransform(1,0,0,1,0,0);
  ctx.clearRect(0,0,ctx.canvas.width,ctx.canvas.height); ctx.restore();
}
function fullRender(T){
  clearStage();
  for (const st of R.s.strokes){
    if (st.t0 > T) continue;
    if (st.un != null && st.un <= T) continue;
    drawStrokeOn(R.ctx, st, T);
  }
}
function drawStrokeRange(st, fromT, toT){
  const pts = st.pts;
  let start = 0;
  while (start < pts.length && pts[start][2] <= fromT) start++;
  if (start === 0){
    if (pts.length && pts[0][2] <= toT){
      drawDotOn(R.ctx, st, pts[0][0], pts[0][1], pts[0][3]);
      start = 1;
    } else return;
  }
  for (let i=start; i<pts.length; i++){
    if (pts[i][2] > toT) break;
    drawSegOn(R.ctx, st, pts[i-1][0],pts[i-1][1], pts[i][0],pts[i][1], pts[i][3]);
  }
}
function renderAt(T){
  if (T < R.lastT || R.s.strokes.some(st => st.un != null && st.un > R.lastT && st.un <= T)){
    fullRender(T);
  } else {
    for (const st of R.s.strokes){
      if (st.t1 <= R.lastT && st.pts[st.pts.length-1][2] <= R.lastT) continue;
      if (st.t0 > T) break;
      if (st.un != null && st.un <= T) continue;
      drawStrokeRange(st, R.lastT, T);
    }
  }
  R.lastT = T;
  moveHead(T);
  $('#clock').textContent = fmtT(T) + ' / ' + fmtT(R.s.durationMs);
  $('#note-at').textContent = fmtT(T);
}
function seek(T){
  R.T = Math.max(0, Math.min(T, R.s.durationMs));
  R.tAtWall = R.T; R.wall = performance.now();
  renderAt(R.T);
}
function tick(){
  if (!R.playing) return;
  const T = R.tAtWall + (performance.now()-R.wall)*R.speed;
  if (T >= R.s.durationMs){
    R.T = R.s.durationMs; renderAt(R.T);
    R.playing = false; updateTransport(); return;
  }
  R.T = T; renderAt(T);
  R.raf = requestAnimationFrame(tick);
}
function updateTransport(){
  $('#btn-play').innerHTML = R.playing ? ICON_PAUSE : ICON_PLAY;
  $('#btn-play').setAttribute('aria-label', R.playing ? 'Pause' : 'Play');
  $('#btn-speed').textContent = R.speed + '×';
}
$('#btn-play').addEventListener('click', ()=>{
  if (R.playing){ R.playing = false; cancelAnimationFrame(R.raf); }
  else {
    if (R.T >= R.s.durationMs) seek(0);
    R.tAtWall = R.T; R.wall = performance.now();
    R.playing = true; R.raf = requestAnimationFrame(tick);
  }
  updateTransport();
});
$('#btn-speed').addEventListener('click', ()=>{
  R.speed = SPEEDS[(SPEEDS.indexOf(R.speed)+1) % SPEEDS.length];
  R.tAtWall = R.T; R.wall = performance.now();
  updateTransport();
});

/* ---------- the scrubber: the session laid on a light table ---------- */
const SCRUB_H = 64;
function bindScrubOnce(){
  if (R._scrubBound) return;
  R._scrubBound = true;
  const el = $('#scrub');
  let scrubbing = false;
  const toT = ev => {
    const r = el.getBoundingClientRect();
    const px = Math.max(0, Math.min(ev.clientX - r.left, r.width));
    return px / Math.max(1, r.width) * Math.max(1, R.s ? R.s.durationMs : 1);
  };
  el.addEventListener('pointerdown', ev=>{
    if (!R.s) return;
    scrubbing = true; try{ el.setPointerCapture(ev.pointerId); }catch(_){}
    R.playing = false; cancelAnimationFrame(R.raf); updateTransport();
    seek(toT(ev));
  });
  el.addEventListener('pointermove', ev=>{ if (scrubbing) seek(toT(ev)); });
  const stop = ()=> scrubbing = false;
  el.addEventListener('pointerup', stop);
  el.addEventListener('pointercancel', stop);
}
function buildScrub(){
  bindScrubOnce();
  if (typeof d3 === 'undefined'){ R._scrubW = ($('#scrub-wrap').clientWidth||600) - 40; return; }
  const svg = d3.select('#scrub');
  svg.selectAll('*').remove();
  const W = Math.max(280, ($('#scrub-wrap').clientWidth||600) - 40);
  svg.attr('viewBox', `0 0 ${W} ${SCRUB_H}`).attr('height', SCRUB_H).attr('width','100%');
  const s = R.s, dur = Math.max(1, s.durationMs);
  const x = t => t/dur*W;

  // pause bands (>=2s of silence) — ochre
  for (const g of R.A.pauses){
    svg.append('rect').attr('x', x(g.t0)).attr('y', 0)
      .attr('width', Math.max(1.5, x(g.t1)-x(g.t0))).attr('height', SCRUB_H)
      .attr('fill', 'var(--ochre)').attr('opacity', 0.22);
  }
  // ink bands — each stroke's lifetime, stacked opacity
  for (const st of s.strokes){
    svg.append('rect').attr('x', x(st.t0)).attr('y', 14)
      .attr('width', Math.max(1.2, x(st.t1)-x(st.t0))).attr('height', SCRUB_H-28)
      .attr('rx', 1.5)
      .attr('fill', st.tool==='eraser' ? 'var(--graphite)' : 'var(--ink)')
      .attr('opacity', st.un!=null ? 0.16 : 0.5);
    if (st.un != null){
      svg.append('line').attr('x1', x(st.un)).attr('x2', x(st.un))
        .attr('y1', SCRUB_H-11).attr('y2', SCRUB_H-3)
        .attr('stroke','var(--ochre)').attr('stroke-width',2);
    }
  }
  // note pins
  svg.append('g').attr('id','pins');
  drawPins(svg, x);
  // playhead
  const head = svg.append('g').attr('id','head');
  head.append('line').attr('y1',0).attr('y2',SCRUB_H)
    .attr('stroke','var(--viridian)').attr('stroke-width',2);
  head.append('circle').attr('cy',SCRUB_H/2).attr('r',7)
    .attr('fill','var(--viridian)').attr('stroke','var(--paper)').attr('stroke-width',2);
  R._scrubW = W;
}
function drawPins(svg, x){
  const g = svg.select('#pins'); g.selectAll('*').remove();
  hideNoteTip();
  for (const n of R.s.notes||[]){
    const pin = g.append('g').style('cursor','pointer');
    pin.append('circle').attr('cx', x(n.t)).attr('cy', 7).attr('r', 14)
      .attr('fill','transparent');                       // generous touch target
    pin.append('circle').attr('cx', x(n.t)).attr('cy', 7).attr('r', 4.5)
      .attr('fill','var(--viridian)').attr('stroke','var(--paper)').attr('stroke-width',1.5);
    const el = pin.node();
    el.addEventListener('pointerenter', ()=>{ if (!R._tipPinned) showNoteTip(n, el); });
    el.addEventListener('pointerleave', ()=>{ if (!R._tipPinned) hideNoteTip(); });
    el.addEventListener('pointerdown', e=>{
      e.stopPropagation(); e.preventDefault();
      R.playing = false; cancelAnimationFrame(R.raf); updateTransport();
      seek(n.t);
      showNoteTip(n, el);
      R._tipPinned = true;
    });
  }
}
function showNoteTip(n, pinEl){
  const tip = $('#note-tip'), wrap = $('#scrub-wrap');
  tip.querySelector('.tt-time').textContent = fmtT(n.t);
  tip.querySelector('.tt-text').textContent = n.text;
  tip.style.display = 'block';
  tip.style.visibility = 'hidden';
  const wr = wrap.getBoundingClientRect();
  const pr = pinEl.getBoundingClientRect();
  const sc = $('#scrub').getBoundingClientRect();
  const px = pr.left + pr.width/2 - wr.left;           // pin center, wrap coords
  const tw = tip.offsetWidth;
  const left = Math.max(6, Math.min(px - tw/2, wr.width - tw - 6));
  tip.style.left = left + 'px';
  tip.style.top = (sc.bottom - wr.top + 9) + 'px';     // below the scrubber
  tip.querySelector('.tt-caret').style.left =
    Math.max(8, Math.min(px - left - 5, tw - 18)) + 'px';
  tip.style.visibility = 'visible';
}
function hideNoteTip(){
  R._tipPinned = false;
  const tip = $('#note-tip'); if (tip) tip.style.display = 'none';
}
document.addEventListener('pointerdown', e=>{
  if (e.target.closest && e.target.closest('#pins')) return;
  hideNoteTip();
});
function moveHead(T){
  if (typeof d3 === 'undefined') return;
  const W = R._scrubW || 600;
  const px = T/Math.max(1,R.s.durationMs)*W;
  d3.select('#scrub #head').attr('transform', `translate(${px},0)`);
}

/* ---------- notes ---------- */
function renderNotes(){
  const list = $('#note-list'); list.innerHTML = '';
  const notes = [...(R.s.notes||[])].sort((a,b)=>a.t-b.t);
  for (const n of notes){
    const div = document.createElement('div');
    div.className = 'note-item';
    const jump = document.createElement('button'); jump.className='t'; jump.textContent = fmtT(n.t);
    jump.addEventListener('click', ()=>{ seek(n.t); window.scrollTo({top:0,behavior:'smooth'}); });
    const body = document.createElement('div'); body.textContent = n.text; body.style.fontSize='14.5px';
    const del = document.createElement('button'); del.className='x'; del.textContent='remove';
    del.addEventListener('click', async ()=>{
      R.s.notes = R.s.notes.filter(m=>m!==n);
      await store.set(K_S(R.s.id), R.s);
      renderNotes(); buildScrub(); moveHead(R.T);
    });
    div.append(jump, body, del); list.appendChild(div);
  }
}
async function addNote(){
  const inp = $('#note-text');
  const text = inp.value.trim(); if (!text) return;
  R.s.notes = R.s.notes || [];
  R.s.notes.push({ t: Math.round(R.T), text, at: new Date().toISOString() });
  inp.value = '';
  await store.set(K_S(R.s.id), R.s);
  renderNotes(); buildScrub(); moveHead(R.T);
  toast('Note pinned at ' + fmtT(R.T));
}
$('#btn-note').addEventListener('click', addNote);
$('#note-text').addEventListener('keydown', e=>{ if (e.key==='Enter') addNote(); });

/* ---------- header actions ---------- */
$('#btn-back').addEventListener('click', ()=>{
  R.playing = false; cancelAnimationFrame(R.raf);
  hideNoteTip();
  renderHome(); show('scr-home');
});
$('#btn-export').addEventListener('click', ()=>{
  const blob = new Blob([JSON.stringify(R.s)], {type:'application/json'});
  const a = document.createElement('a');
  a.href = URL.createObjectURL(blob);
  a.download = (R.s.code||'session') + '.pentimento.json';
  document.body.appendChild(a); a.click(); a.remove();
  setTimeout(()=>URL.revokeObjectURL(a.href), 4000);
});
$('#btn-delete').addEventListener('click', async ()=>{
  if (!confirm('Delete session ' + R.s.code + ' from this device? Export first if you want to keep it.')) return;
  await store.del(K_S(R.s.id));
  App.idx = App.idx.filter(x=>x.id!==R.s.id);
  await saveIndex();
  renderHome(); show('scr-home');
  toast('Deleted.');
});
