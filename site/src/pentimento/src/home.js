/* pentimento · home — session library + import/export
   Extracted verbatim from the single-file MVP (see HANDOFF.md §5/§9). Behavior unchanged. */
'use strict';

/* ---------- HOME ---------- */
function renderHome(){
  const list = $('#session-list'), empty = $('#empty');
  list.innerHTML = '';
  const items = [...App.idx].sort((a,b)=> (b.startedAt||'').localeCompare(a.startedAt||''));
  empty.style.display = items.length ? 'none' : 'block';
  for (const it of items){
    const b = document.createElement('button');
    b.className = 'card';
    const th = (it.thumb||'').startsWith('data:image') ? it.thumb : '';
    b.innerHTML = `<div class="thumb" style="background-image:url('${th}')"></div>
      <div class="meta"><div class="code"></div>
      <div class="sub">${fmtDate(it.startedAt)} · ${fmtT(it.durationMs||0)} · ${it.nStrokes||0} strokes</div></div>`;
    b.querySelector('.code').textContent = it.code;
    b.addEventListener('click', ()=> openReview(it.id));
    list.appendChild(b);
  }
}

function defaultCode(){
  const d = new Date();
  const mmdd = String(d.getMonth()+1).padStart(2,'0') + String(d.getDate()).padStart(2,'0');
  const todays = App.idx.filter(s => (s.code||'').includes('-'+mmdd+'-')).length;
  return 'S-' + mmdd + '-' + String.fromCharCode(65 + (todays % 26));
}

$('#btn-new').addEventListener('click', ()=>{
  $('#inp-code').value = '';
  $('#inp-code').placeholder = defaultCode();
  $('#modal').classList.add('on');
});
$('#btn-cancel').addEventListener('click', ()=> $('#modal').classList.remove('on'));
$('#btn-start').addEventListener('click', ()=>{
  const code = $('#inp-code').value.trim() || defaultCode();
  $('#modal').classList.remove('on');
  startSession(code);
});

/* import / export */
$('#btn-import').addEventListener('click', ()=> $('#file-import').click());
$('#file-import').addEventListener('change', async e => {
  const f = e.target.files[0]; e.target.value = '';
  if (!f) return;
  try {
    const s = JSON.parse(await f.text());
    if (!s || !Array.isArray(s.strokes)) throw 0;
    if (!s.id || App.idx.some(x=>x.id===s.id)) s.id = uid();
    await store.set(K_S(s.id), s);
    App.idx.push(indexEntry(s));
    await saveIndex(); renderHome();
    toast('Imported ' + s.code);
  } catch(err){ toast('That file isn’t a Pentimento session.'); }
});

function indexEntry(s){
  return { id:s.id, code:s.code, startedAt:s.startedAt, durationMs:s.durationMs||0,
           nStrokes:(s.strokes||[]).length, thumb:s.thumb||'' };
}
