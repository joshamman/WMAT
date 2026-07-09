/* pentimento · charts — stat cards + the five d3 charts (§5.4)
   Extracted verbatim from the single-file MVP (see HANDOFF.md §5/§9). Behavior unchanged. */
'use strict';

/* ---------- stat cards ---------- */
function renderStats(){
  const A = R.A, s = R.s;
  R.s.durationMs = A.dur;
  const cards = [
    {v: fmtT(A.dur), l:'Total time'},
    {v: Math.round(A.activeMs/A.dur*100) + '%', l:'Active drawing', em: fmtT(A.activeMs)},
    {v: fmtSec(A.firstMark), l:'Time to first mark', hot:true},
    {v: A.longest ? fmtSec(A.longest) : '—', l:'Longest pause', hot:true},
    {v: A.pauses.length, l:'Pauses ≥ 2s', hot:true},
    {v: s.strokes.length, l:'Strokes'},
    {v: A.colors.length, l:'Colors used'},
    {v: A.undos, l:'Undos'}
  ];
  $('#stats').innerHTML = cards.map(c =>
    `<div class="stat${c.hot?' hot':''}"><div class="v">${c.v}${c.em?` <em>${c.em}</em>`:''}</div><div class="l">${c.l}</div></div>`
  ).join('');
}

/* ---------- charts ---------- */
const CM = {l:40, r:14, t:10, b:24};
function chartShell(parent, title, note, h){
  const div = document.createElement('div');
  div.className = 'chart';
  div.innerHTML = `<h3>${title}</h3>` + (note?`<div class="note">${note}</div>`:'');
  parent.appendChild(div);
  const w = Math.max(300, div.clientWidth - 32);
  const svg = d3.select(div).append('svg').attr('viewBox',`0 0 ${w} ${h}`);
  return {svg, w, h, div};
}
function styleAxis(g){
  g.selectAll('text').attr('font-family','var(--mono)').attr('font-size',10).attr('fill','var(--graphite)');
  g.selectAll('line').attr('stroke','var(--line)');
  g.select('.domain').attr('stroke','var(--line)');
}
function xTime(w, dur){ return d3.scaleLinear().domain([0,dur]).range([CM.l, w-CM.r]); }
function axisX(svg, x, h){
  const g = svg.append('g').attr('transform',`translate(0,${h-CM.b})`)
    .call(d3.axisBottom(x).ticks(6).tickFormat(fmtT).tickSize(4));
  styleAxis(g);
}
function pauseBands(svg, x, h){
  for (const p of R.A.pauses){
    svg.append('rect').attr('x',x(p.t0)).attr('y',CM.t)
      .attr('width',Math.max(1,x(p.t1)-x(p.t0))).attr('height',h-CM.t-CM.b)
      .attr('fill','var(--ochre)').attr('opacity',.14);
  }
}

function chartTempo(parent){
  const A = R.A;
  const {svg,w,h} = chartShell(parent,'Drawing tempo','Hand motion (recorded points per second). Ochre bands are silence ≥ 2s.',150);
  const x = xTime(w, A.dur);
  const y = d3.scaleLinear().domain([0, Math.max(1, d3.max(A.bins,d=>d.v)*1.1)]).range([h-CM.b, CM.t]);
  pauseBands(svg,x,h);
  const area = d3.area().x(d=>x(d.t)).y0(y(0)).y1(d=>y(d.v)).curve(d3.curveMonotoneX);
  svg.append('path').datum(A.bins).attr('d',area).attr('fill','var(--ink)').attr('opacity',.85);
  axisX(svg,x,h);
  const gy = svg.append('g').attr('transform',`translate(${CM.l},0)`)
    .call(d3.axisLeft(y).ticks(3).tickSize(3));
  styleAxis(gy);
}

function chartPauses(parent){
  const A = R.A;
  const {svg,w,h,div} = chartShell(parent,'Pause map','Every silence of 2s or longer — when it happened and how long it lasted.',140);
  if (!A.pauses.length){
    d3.select(div).append('div').attr('class','note').style('padding','14px 0').text('No pauses of 2 seconds or longer — continuous drawing throughout.');
    svg.remove(); return;
  }
  const x = xTime(w, A.dur);
  const y = d3.scaleLinear().domain([0, Math.max(4, d3.max(A.pauses,d=>d.d/1000)*1.15)]).range([h-CM.b, CM.t]);
  for (const p of A.pauses){
    const cx = x((p.t0+p.t1)/2);
    svg.append('line').attr('x1',cx).attr('x2',cx).attr('y1',y(0)).attr('y2',y(p.d/1000))
      .attr('stroke','var(--ochre)').attr('stroke-width',2);
    svg.append('circle').attr('cx',cx).attr('cy',y(p.d/1000)).attr('r',5)
      .attr('fill','var(--ochre)');
    svg.append('text').attr('x',cx).attr('y',y(p.d/1000)-9).attr('text-anchor','middle')
      .attr('font-family','var(--mono)').attr('font-size',10).attr('fill','var(--graphite)')
      .text(fmtSec(p.d));
  }
  axisX(svg,x,h);
  const gy = svg.append('g').attr('transform',`translate(${CM.l},0)`).call(d3.axisLeft(y).ticks(3).tickSize(3).tickFormat(d=>d+'s'));
  styleAxis(gy);
}

function chartPressure(parent){
  const A = R.A;
  if (!A.hasPressure) return;
  const {svg,w,h} = chartShell(parent,'Pencil pressure','How hard they pressed (0–1). Band is the range within each moment; line is the average.',150);
  const x = xTime(w, A.dur);
  const y = d3.scaleLinear().domain([0,1]).range([h-CM.b, CM.t]);
  pauseBands(svg,x,h);
  const band = d3.area().x(d=>x(d.t)).y0(d=>y(d.min)).y1(d=>y(d.max)).curve(d3.curveMonotoneX);
  svg.append('path').datum(A.pbins).attr('d',band).attr('fill','var(--viridian)').attr('opacity',.18);
  const line = d3.line().x(d=>x(d.t)).y(d=>y(d.mean)).curve(d3.curveMonotoneX);
  svg.append('path').datum(A.pbins).attr('d',line).attr('fill','none').attr('stroke','var(--viridian)').attr('stroke-width',2);
  axisX(svg,x,h);
  const gy = svg.append('g').attr('transform',`translate(${CM.l},0)`).call(d3.axisLeft(y).ticks(3).tickSize(3));
  styleAxis(gy);
}

function chartCoverage(parent){
  const A = R.A;
  const {svg,w,h} = chartShell(parent,'Canvas coverage','How much of the sheet had been touched, over time (approximate; erasing not subtracted).',140);
  const x = xTime(w, A.dur);
  const maxPct = Math.max(5, d3.max(A.cov,d=>d.pct)*1.2);
  const y = d3.scaleLinear().domain([0, Math.min(100,maxPct)]).range([h-CM.b, CM.t]);
  pauseBands(svg,x,h);
  const line = d3.line().x(d=>x(d.t)).y(d=>y(d.pct)).curve(d3.curveMonotoneX);
  svg.append('path').datum(A.cov).attr('d',line).attr('fill','none').attr('stroke','var(--ink)').attr('stroke-width',2);
  axisX(svg,x,h);
  const gy = svg.append('g').attr('transform',`translate(${CM.l},0)`).call(d3.axisLeft(y).ticks(3).tickSize(3).tickFormat(d=>d+'%'));
  styleAxis(gy);
}

function chartSequence(parent){
  const A = R.A, s = R.s;
  const {svg,w,h} = chartShell(parent,'Stroke sequence & color','Each bar is one stroke, in its color, when it happened. Faded = later undone (ochre tick marks the undo).',72);
  const x = xTime(w, A.dur);
  const y0 = CM.t, bh = h-CM.b-CM.t;
  for (const st of s.strokes){
    svg.append('rect').attr('x',x(st.t0)).attr('y',y0)
      .attr('width',Math.max(1.5, x(st.t1)-x(st.t0))).attr('height',bh).attr('rx',1.5)
      .attr('fill', st.tool==='eraser' ? '#B9BEB4' : st.color)
      .attr('opacity', st.un!=null ? .25 : .92);
    if (st.un!=null){
      svg.append('line').attr('x1',x(st.un)).attr('x2',x(st.un)).attr('y1',y0).attr('y2',y0+bh)
        .attr('stroke','var(--ochre)').attr('stroke-width',2);
    }
  }
  axisX(svg,x,h);
}

function renderCharts(){
  const parent = $('#charts'); parent.innerHTML = '';
  if (typeof d3 === 'undefined'){
    parent.innerHTML = '<div class="chart"><h3>Charts unavailable</h3><div class="note">d3 could not load (offline?). Replay still works; reconnect to see the dashboard.</div></div>';
    return;
  }
  chartTempo(parent);
  chartPauses(parent);
  chartPressure(parent);
  chartCoverage(parent);
  chartSequence(parent);
}
