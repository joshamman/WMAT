/* pentimento · draw — live recording: pointer handling, tray, undo, thumbnail (§2, §5)
   Extracted verbatim from the single-file MVP (see HANDOFF.md §5/§9). Behavior unchanged. */
'use strict';

/* ============================================================
   DRAW — the client screen. A sheet of paper; recording is
   automatic. Every point carries x, y, time, pressure.
   ============================================================ */
const COLORS = ['#1A1A1A','#C7362B','#DE7B26','#D9B23A','#3E7C4F','#2D5FA8','#6B4FA0','#7A4A2A'];
const SIZES = [4, 9, 16];

const D = {   // live drawing state
  session:null, ctx:null, t0:0,
  color:COLORS[0], size:SIZES[1], tool:'brush',
  activeId:null, penUsed:false, stroke:null, lastPt:null
};

function nowT(){ return Math.round(performance.now() - D.t0); }

function buildTray(){
  const tray = $('#tray'); tray.innerHTML = '';
  COLORS.forEach(c=>{
    const b = document.createElement('button');
    b.className = 'swatch'; b.style.background = c;
    b.setAttribute('aria-label','color');
    b.addEventListener('click', ()=>{ D.color=c; D.tool='brush'; refreshTray(); });
    b.dataset.c = c; tray.appendChild(b);
  });
  tray.insertAdjacentHTML('beforeend','<span class="sep"></span>');
  SIZES.forEach(sz=>{
    const b = document.createElement('button');
    b.className = 'sizedot'; b.dataset.s = sz;
    b.innerHTML = `<i style="width:${sz+4}px;height:${sz+4}px"></i>`;
    b.addEventListener('click', ()=>{ D.size=sz; refreshTray(); });
    tray.appendChild(b);
  });
  tray.insertAdjacentHTML('beforeend','<span class="sep"></span>');
  const er = document.createElement('button');
  er.className='tool'; er.id='t-eraser'; er.title='Eraser';
  er.innerHTML = '<svg width="20" height="20" viewBox="0 0 20 20" fill="none"><path d="M11.5 3.5 16.5 8.5 9 16H5.5L3.5 14 11.5 3.5Z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/><path d="M4 17.5h12" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>';
  er.addEventListener('click', ()=>{ D.tool = D.tool==='eraser' ? 'brush' : 'eraser'; refreshTray(); });
  tray.appendChild(er);
  const un = document.createElement('button');
  un.className='tool'; un.title='Undo';
  un.innerHTML = '<svg width="20" height="20" viewBox="0 0 20 20" fill="none"><path d="M7.5 4 3.5 8l4 4" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/><path d="M3.5 8h8a5 5 0 0 1 0 10H8" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>';
  un.addEventListener('click', doUndo);
  tray.appendChild(un);
  refreshTray();
}
function refreshTray(){
  $$('.swatch').forEach(b => b.classList.toggle('sel', b.dataset.c===D.color && D.tool==='brush'));
  $$('.sizedot').forEach(b => b.classList.toggle('sel', +b.dataset.s===D.size));
  $('#t-eraser').classList.toggle('sel', D.tool==='eraser');
}

function startSession(code){
  const w = document.documentElement.clientWidth;
  const h = document.documentElement.clientHeight;
  D.session = { v:1, id:uid(), code, startedAt:new Date().toISOString(),
                w, h, strokes:[], notes:[], hasPen:false, durationMs:0, thumb:'' };
  D.t0 = performance.now();
  D.penUsed = false; D.activeId = null; D.stroke = null;
  D.tool='brush'; D.color=COLORS[0]; D.size=SIZES[1];

  const c = $('#sheet'), dpr = Math.min(window.devicePixelRatio||1, 3);
  c.width = w*dpr; c.height = h*dpr;
  c.style.width = w+'px'; c.style.height = h+'px';
  D.ctx = c.getContext('2d');
  D.ctx.setTransform(dpr,0,0,dpr,0,0);
  D.ctx.lineCap='round'; D.ctx.lineJoin='round';
  D.ctx.clearRect(0,0,w,h);

  $('#chip-code').textContent = code;
  buildTray();
  show('scr-draw');
  App.dirty = false;
  clearInterval(App.autosave);
  App.autosave = setInterval(()=>{ if (App.dirty && D.session){ persistCurrent(false); App.dirty=false; } }, 10000);
}

async function persistCurrent(final){
  const s = D.session; if (!s) return;
  s.durationMs = nowT();
  if (final){
    s.thumb = makeThumb(s);
    const i = App.idx.findIndex(x=>x.id===s.id);
    if (i>=0) App.idx[i] = indexEntry(s); else App.idx.push(indexEntry(s));
    await saveIndex();
  } else if (!App.idx.some(x=>x.id===s.id)){
    App.idx.push(indexEntry(s)); await saveIndex();
  }
  await store.set(K_S(s.id), s);
}

function redrawLive(){
  const s = D.session, ctx = D.ctx;
  ctx.save(); ctx.setTransform(1,0,0,1,0,0);
  ctx.clearRect(0,0,ctx.canvas.width,ctx.canvas.height); ctx.restore();
  for (const st of s.strokes) if (st.un==null) drawStrokeOn(ctx, st, null);
}

function doUndo(){
  const s = D.session;
  for (let i=s.strokes.length-1;i>=0;i--){
    if (s.strokes[i].un==null){ s.strokes[i].un = nowT(); redrawLive(); App.dirty=true; return; }
  }
}

/* pointer handling with palm rejection:
   once a Pencil has drawn in this session, touches are ignored. */
function acceptPointer(e){
  if (D.activeId != null && e.pointerId !== D.activeId) return false;
  if (e.pointerType === 'touch' && D.penUsed) return false;
  return true;
}
function ptFrom(e, rect){
  const x = Math.round((e.clientX-rect.left)*10)/10;
  const y = Math.round((e.clientY-rect.top)*10)/10;
  const p = Math.round((e.pressure||0)*100)/100;
  return [x,y,nowT(),p];
}
function bindDraw(){
  const c = $('#sheet');
  c.addEventListener('pointerdown', e=>{
    if (D.session==null) return;
    if (e.pointerType==='pen'){ D.penUsed = true; D.session.hasPen = true; }
    if (!acceptPointer(e) || D.activeId!=null) return;
    e.preventDefault();
    D.activeId = e.pointerId;
    try{ c.setPointerCapture(e.pointerId); }catch(_){}
    const rect = c.getBoundingClientRect();
    const pt = ptFrom(e, rect);
    D.stroke = { i:uid(), t0:pt[2], t1:pt[2], tool:D.tool, color:D.color, size:D.size,
                 pt:e.pointerType, un:null, pts:[pt] };
    D.lastPt = pt;
    drawDotOn(D.ctx, D.stroke, pt[0], pt[1], pt[3]);
  });
  c.addEventListener('pointermove', e=>{
    if (D.stroke==null || e.pointerId!==D.activeId) return;
    e.preventDefault();
    const rect = c.getBoundingClientRect();
    const evs = (e.getCoalescedEvents && e.getCoalescedEvents().length) ? e.getCoalescedEvents() : [e];
    for (const ev of evs){
      const pt = ptFrom(ev, rect);
      const lp = D.lastPt;
      const dx = pt[0]-lp[0], dy = pt[1]-lp[1];
      if ((pt[2]-lp[2]) < 8 && (dx*dx+dy*dy) < 0.25) continue;  // thinning
      drawSegOn(D.ctx, D.stroke, lp[0],lp[1], pt[0],pt[1], pt[3]);
      D.stroke.pts.push(pt); D.lastPt = pt;
    }
  });
  const end = e=>{
    if (D.stroke==null || e.pointerId!==D.activeId) return;
    const rect = c.getBoundingClientRect();
    const pt = ptFrom(e, rect);
    if (pt[2] > D.lastPt[2]){
      drawSegOn(D.ctx, D.stroke, D.lastPt[0],D.lastPt[1], pt[0],pt[1], pt[3]);
      D.stroke.pts.push(pt);
    }
    D.stroke.t1 = D.stroke.pts[D.stroke.pts.length-1][2];
    D.session.strokes.push(D.stroke);
    D.stroke = null; D.activeId = null; D.lastPt = null;
    App.dirty = true;
  };
  c.addEventListener('pointerup', end);
  c.addEventListener('pointercancel', end);
  c.addEventListener('contextmenu', e=>e.preventDefault());
  c.addEventListener('selectstart', e=>e.preventDefault());
  document.addEventListener('selectstart', e=>{
    if ($('#scr-draw').classList.contains('on')) e.preventDefault();
  });
  document.addEventListener('gesturestart', e=>{ if ($('#scr-draw').classList.contains('on')) e.preventDefault(); });
}

function makeThumb(s){
  try{
    const W = 320, k = W/s.w, H = Math.max(1, Math.round(s.h*k));
    const c = document.createElement('canvas'); c.width=W; c.height=H;
    const ctx = c.getContext('2d');
    ctx.fillStyle = '#FFFFFF'; ctx.fillRect(0,0,W,H);
    ctx.scale(k,k); ctx.lineCap='round'; ctx.lineJoin='round';
    for (const st of s.strokes) if (st.un==null) drawStrokeOn(ctx, st, null);
    return c.toDataURL('image/jpeg', 0.72);
  }catch(e){ return ''; }
}

$('#btn-done').addEventListener('click', async ()=>{
  if (!D.session) return;
  const s = D.session;
  clearInterval(App.autosave);
  await persistCurrent(true);
  const id = s.id;
  D.session = null;
  renderHome();
  if (s.strokes.length) openReview(id);
  else { toast('Empty session saved.'); show('scr-home'); }
});
