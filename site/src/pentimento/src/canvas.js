/* pentimento · canvas — the ONE shared render primitive (§5.1, §9.2). Never fork.
   Extracted verbatim from the single-file MVP (see HANDOFF.md §5/§9). Behavior unchanged. */
'use strict';

/* segment drawing — the ONE function used by live + replay + thumbs,
   so what the therapist replays is exactly what the client saw. */
function segWidth(st, p){
  return st.pt==='pen' ? st.size*(0.35 + p*1.3) : st.size;
}
function drawSegOn(ctx, st, x0,y0, x1,y1, p){
  ctx.globalCompositeOperation = st.tool==='eraser' ? 'destination-out' : 'source-over';
  ctx.strokeStyle = st.color;
  ctx.lineWidth = st.tool==='eraser' ? st.size*3 : segWidth(st, p);
  ctx.beginPath(); ctx.moveTo(x0,y0); ctx.lineTo(x1,y1); ctx.stroke();
}
function drawDotOn(ctx, st, x,y,p){
  ctx.globalCompositeOperation = st.tool==='eraser' ? 'destination-out' : 'source-over';
  ctx.fillStyle = st.color;
  const r = (st.tool==='eraser' ? st.size*3 : segWidth(st,p))/2;
  ctx.beginPath(); ctx.arc(x,y,r,0,Math.PI*2); ctx.fill();
}
function drawStrokeOn(ctx, st, uptoT){
  const pts = st.pts; if (!pts.length) return;
  const lim = uptoT==null ? Infinity : uptoT;
  if (pts.length===1 || pts[1][2] > lim){ if (pts[0][2]<=lim) drawDotOn(ctx,st,pts[0][0],pts[0][1],pts[0][3]); return; }
  for (let i=1;i<pts.length;i++){
    if (pts[i][2] > lim) break;
    drawSegOn(ctx, st, pts[i-1][0],pts[i-1][1], pts[i][0],pts[i][1], pts[i][3]);
  }
}
