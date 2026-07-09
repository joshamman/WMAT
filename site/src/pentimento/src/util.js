/* pentimento · util — DOM + formatting helpers, uid, toast
   Extracted verbatim from the single-file MVP (see HANDOFF.md §5/§9). Behavior unchanged. */
'use strict';

/* ---------- utils ---------- */
const $ = (s, el=document) => el.querySelector(s);
const $$ = (s, el=document) => [...el.querySelectorAll(s)];
const uid = () => Date.now().toString(36) + Math.random().toString(36).slice(2,7);
const fmtT = ms => {
  ms = Math.max(0, ms|0);
  const s = Math.floor(ms/1000), m = Math.floor(s/60);
  return m + ':' + String(s%60).padStart(2,'0');
};
const fmtSec = ms => (ms/1000).toFixed(ms < 10000 ? 1 : 0) + 's';
const fmtDate = iso => {
  const d = new Date(iso);
  return d.toLocaleDateString(undefined,{month:'short',day:'numeric'}) + ' · ' +
         d.toLocaleTimeString(undefined,{hour:'numeric',minute:'2-digit'});
};
let toastTimer = null;
function toast(msg){
  const t = $('#toast'); t.textContent = msg; t.classList.add('on');
  clearTimeout(toastTimer); toastTimer = setTimeout(()=>t.classList.remove('on'), 2600);
}
