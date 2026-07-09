/* pentimento · app — state, router, resize, boot (loads last: boot() runs here)
   Extracted verbatim from the single-file MVP (see HANDOFF.md §5/§9). Behavior unchanged. */
'use strict';

/* ---------- app state ---------- */
const App = { idx: [], cur: null, dirty: false, autosave: null };

async function loadIndex(){ App.idx = (await store.get(K_IDX)) || []; }
async function saveIndex(){ await store.set(K_IDX, App.idx); }

/* ---------- router ---------- */
function show(id){
  $$('.screen').forEach(s => s.classList.toggle('on', s.id === id));
  window.scrollTo(0,0);
}

/* ---------- resize / boot ---------- */
let rsz = null;
window.addEventListener('resize', ()=>{
  clearTimeout(rsz);
  rsz = setTimeout(()=>{
    if ($('#scr-review').classList.contains('on') && R.s){
      fitStage(); buildScrub(); renderCharts();
      R.lastT = -1; renderAt(R.T);
    }
  }, 220);
});

(async function boot(){
  bindDraw();
  await loadIndex();
  renderHome();
})();
