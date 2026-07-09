/* pentimento · storage — adapter (backend API | window.storage | localStorage) + keys
   Originally extracted from the single-file MVP; extended with an OPT-IN backend mode
   for Phase A cross-device sync (HANDOFF §7.6 / §10 v0.3). Default behaviour — when no
   backend is configured — is UNCHANGED: localStorage standalone, or window.storage
   inside a Claude artifact. */
'use strict';

/* ---------- storage adapter ----------
   Three modes, picked per call:
     1. backend      — when window.PENTIMENTO_BACKEND = { url, token } is set (see the
                       config block in index.html). Reads/writes a tiny key/value API so
                       sessions sync across devices; mirrors every write to localStorage
                       as an offline cache so a failed or offline write never loses data.
     2. window.storage — inside a Claude artifact.
     3. localStorage   — standalone file / normal host with no backend configured.

   ⚠ PHASE A ONLY. The backend is for Josh + Amy's OWN test sessions. The shared token
   lives in the page source, so it is a soft gate, NOT real security — do NOT put real
   client PHI behind it. Real accounts / consent / audit (Phase B, HANDOFF §8) come
   first before any real client data is stored. */
const hasWS = typeof window.storage === 'object' && window.storage && typeof window.storage.get === 'function';

// read config lazily so it can be set any time before first use (and is easy to test)
const backend = () => {
  const b = window.PENTIMENTO_BACKEND;
  return (b && typeof b === 'object' && b.url) ? b : null;
};
const apiFetch = (b, k, opts) =>
  fetch(b.url + (b.url.includes('?') ? '&' : '?') + 'key=' + encodeURIComponent(k),
    Object.assign({ headers: { 'X-Pentimento-Token': b.token || '', 'Content-Type': 'application/json' } }, opts));

const store = {
  async get(k){
    const b = backend();
    if (b){
      try {
        const r = await apiFetch(b, k);
        if (r.status === 404) return null;
        if (!r.ok) throw new Error('GET ' + r.status);
        const txt = await r.text();
        try { if (txt) localStorage.setItem(k, txt); } catch(e){}   // refresh offline cache
        return txt ? JSON.parse(txt) : null;
      } catch(e){
        try { const c = localStorage.getItem(k); return c == null ? null : JSON.parse(c); }  // offline fallback
        catch(_){ return null; }
      }
    }
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
    const b = backend();
    if (b){
      try { localStorage.setItem(k, s); } catch(e){}              // mirror locally first — never lose data
      try {
        const r = await apiFetch(b, k, { method: 'PUT', body: s });
        if (!r.ok) throw new Error('PUT ' + r.status);
      } catch(e){ toast('Saved on this device — sync to the server failed (offline?).'); }
      return;
    }
    if (hasWS){
      try { const r = await window.storage.set(k, s); if (!r) toast('Save may have failed.'); return; }
      catch(e){ toast('Save failed (storage limit?) — use Export.'); return; }
    }
    try { localStorage.setItem(k, s); }
    catch(e){ toast('Save failed — device storage is full. Export your sessions.'); }
  },
  async del(k){
    const b = backend();
    if (b){
      try { localStorage.removeItem(k); } catch(e){}
      try { const r = await apiFetch(b, k, { method: 'DELETE' }); if (!r.ok) throw 0; }
      catch(e){ toast('Removed here — server delete failed (offline?).'); }
      return;
    }
    if (hasWS){ try { await window.storage.delete(k); } catch(e){} return; }
    try { localStorage.removeItem(k); } catch(e){}
  }
};
const K_IDX = 'pentimento-index';
const K_S = id => 'pentimento-session-' + id;
