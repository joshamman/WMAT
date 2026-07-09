/* pentimento · storage — adapter (window.storage | localStorage) + keys
   Extracted verbatim from the single-file MVP (see HANDOFF.md §5/§9). Behavior unchanged. */
'use strict';

/* ---------- storage adapter (artifact window.storage OR localStorage) ---------- */
const hasWS = typeof window.storage === 'object' && window.storage && typeof window.storage.get === 'function';
const store = {
  async get(k){
    if (hasWS){
      try { const r = await window.storage.get(k); return r && r.value != null ? JSON.parse(r.value) : null; }
      catch(e){ return null; }
    }
    try { const v = localStorage.getItem(k); return v == null ? null : JSON.parse(v); }
    catch(e){ return null; }
  },
  async set(k, v){
    const s = JSON.stringify(v);
    if (s.length > 4.6e6) toast('Warning: session is very large — export it to be safe.');
    if (hasWS){
      try { const r = await window.storage.set(k, s); if (!r) toast('Save may have failed.'); return; }
      catch(e){ toast('Save failed (storage limit?) — use Export.'); return; }
    }
    try { localStorage.setItem(k, s); }
    catch(e){ toast('Save failed — device storage is full. Export your sessions.'); }
  },
  async del(k){
    if (hasWS){ try { await window.storage.delete(k); } catch(e){} return; }
    try { localStorage.removeItem(k); } catch(e){}
  }
};
const K_IDX = 'pentimento-index';
const K_S = id => 'pentimento-session-' + id;
