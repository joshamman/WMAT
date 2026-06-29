/* ============================================================
   WMAT "A Visual Journey", scroll, parallax, reveals & paint.
   Vanilla. No deps.
   ============================================================ */
(function () {
  document.documentElement.classList.add('js');
  var reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  /* ---------- Sticky header state ---------- */
  var header = document.querySelector('.j-header');
  function onScrollHeader() {
    if (!header) return;
    header.classList.toggle('scrolled', window.scrollY > 40);
  }

  /* ---------- Parallax (transform by scroll) ---------- */
  var parallax = Array.prototype.slice.call(document.querySelectorAll('[data-speed]'));
  function applyParallax() {
    if (reduce) return;
    var vh = window.innerHeight;
    for (var i = 0; i < parallax.length; i++) {
      var el = parallax[i];
      var speed = parseFloat(el.getAttribute('data-speed')) || 0;
      var rect = el.getBoundingClientRect();
      var center = rect.top + rect.height / 2;
      var delta = (center - vh / 2);
      el.style.transform = 'translate3d(0,' + (-delta * speed).toFixed(1) + 'px,0)';
    }
  }

  var ticking = false;
  function onScroll() {
    if (ticking) return;
    ticking = true;
    requestAnimationFrame(function () {
      onScrollHeader();
      applyParallax();
      drawPath();
      ticking = false;
    });
  }
  window.addEventListener('scroll', onScroll, { passive: true });
  window.addEventListener('resize', function () { applyParallax(); sizeCanvas(); });

  /* ---------- Reveal on enter ---------- */
  var revealEls = document.querySelectorAll('[data-reveal]');
  if ('IntersectionObserver' in window) {
    var io = new IntersectionObserver(function (entries) {
      entries.forEach(function (e) {
        if (e.isIntersecting) { e.target.classList.add('in'); io.unobserve(e.target); }
      });
    }, { threshold: 0.12, rootMargin: '0px 0px -8% 0px' });
    revealEls.forEach(function (el) { io.observe(el); });
  } else {
    revealEls.forEach(function (el) { el.classList.add('in'); });
  }

  /* ---------- Journey meandering path "draw" on scroll ---------- */
  var pathEl = document.getElementById('journey-path');
  var pathLen = 0;
  if (pathEl) { pathLen = pathEl.getTotalLength(); pathEl.style.strokeDasharray = pathLen; pathEl.style.strokeDashoffset = pathLen; }
  function drawPath() {
    if (!pathEl) return;
    var section = document.getElementById('journey');
    if (!section) return;
    var rect = section.getBoundingClientRect();
    var vh = window.innerHeight;
    // progress: 0 when section top hits 70% of viewport, 1 near bottom
    var total = rect.height + vh * 0.4;
    var seen = (vh * 0.7 - rect.top);
    var p = Math.max(0, Math.min(1, seen / total));
    pathEl.style.strokeDashoffset = (pathLen * (1 - p)).toFixed(1);
  }

  /* ---------- "Make a mark" paint canvas ---------- */
  var stage = document.getElementById('mark-stage');
  var canvas = document.getElementById('mark-canvas');
  var hint = document.getElementById('mark-hint');
  var clearBtn = document.getElementById('mark-clear');
  var ctx = canvas ? canvas.getContext('2d') : null;
  var dpr = Math.min(window.devicePixelRatio || 1, 2);

  var palette = ['#266F70', '#2F8889', '#5DA8CC', '#142F49', '#E8B33D', '#7E8B4A', '#A66E3D', '#3FA0A1'];

  // Two layers: a "dry paper" stain canvas (offscreen) that accumulates faint
  // settled pigment, plus active blooms that spread + fade each frame on top.
  var stain = document.createElement('canvas');
  var sctx = stain.getContext('2d');
  var blooms = [];
  var rafOn = false, lastFrame = 0, painted = false, painting = false;
  var curColor = palette[0], lastSeed = null;

  function sizeCanvas() {
    if (!canvas || !stage) return;
    var r = stage.getBoundingClientRect();
    var w = Math.max(1, Math.round(r.width * dpr));
    var h = Math.max(1, Math.round(r.height * dpr));
    var keep = null;
    if (stain.width) {
      keep = document.createElement('canvas');
      keep.width = stain.width; keep.height = stain.height;
      keep.getContext('2d').drawImage(stain, 0, 0);
    }
    canvas.width = w; canvas.height = h;
    stain.width = w; stain.height = h;
    if (keep) sctx.drawImage(keep, 0, 0, w, h);
    composite();
  }

  function easeOut(t) { return 1 - Math.pow(1 - t, 2.2); }

  // Draw one bloom at progress p (0..1): radius grows, pigment fades as the
  // water carries it outward, wet-on-wet diffusion.
  function drawBloom(c, b, p) {
    var radius = b.r0 + (b.r1 - b.r0) * easeOut(p);
    var alpha = b.a0 * (1 - (b.fade != null ? b.fade : 0.8) * p);
    if (alpha <= 0.002) return;
    var g = c.createRadialGradient(b.x, b.y, 0, b.x, b.y, radius);
    g.addColorStop(0, b.color);
    g.addColorStop(0.25, b.color);
    g.addColorStop(0.62, b.color);
    g.addColorStop(1, 'rgba(255,255,255,0)');
    c.globalCompositeOperation = 'multiply';
    c.globalAlpha = alpha;
    c.fillStyle = g;
    c.beginPath(); c.arc(b.x, b.y, radius, 0, Math.PI * 2); c.fill();
    // granulation specks ride the spreading wet edge
    for (var i = 0; i < b.specks.length; i++) {
      var s = b.specks[i];
      c.globalAlpha = alpha * 0.55;
      c.beginPath();
      c.arc(b.x + Math.cos(s.a) * radius * s.d, b.y + Math.sin(s.a) * radius * s.d, radius * s.r, 0, Math.PI * 2);
      c.fill();
    }
    c.globalAlpha = 1;
    c.globalCompositeOperation = 'source-over';
  }

  function composite() {
    if (!ctx) return;
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    ctx.drawImage(stain, 0, 0);
  }

  function frame(now) {
    if (!lastFrame) lastFrame = now;
    var dt = Math.min(48, now - lastFrame); lastFrame = now;
    composite();
    for (var i = blooms.length - 1; i >= 0; i--) {
      var b = blooms[i];
      b.t += dt;
      var p = Math.min(1, b.t / b.life);
      drawBloom(ctx, b, p);
      if (p >= 1) { drawBloom(sctx, b, 1); blooms.splice(i, 1); }  // pigment dries into the paper
    }
    if (blooms.length) { requestAnimationFrame(frame); }
    else { rafOn = false; lastFrame = 0; composite(); }
  }
  function runLoop() { if (!rafOn) { rafOn = true; lastFrame = 0; requestAnimationFrame(frame); } }

  function pos(e) {
    var r = canvas.getBoundingClientRect();
    var cx = (e.touches ? e.touches[0].clientX : e.clientX) - r.left;
    var cy = (e.touches ? e.touches[0].clientY : e.clientY) - r.top;
    return { x: cx * dpr, y: cy * dpr };
  }

  var lastMoveTime = 0, holdLevel = 0, holdAnchor = null, holdInterval = null;

  function makeBloom(x, y, o) {
    if (!painted) { painted = true; if (hint) { hint.classList.add('gone'); hint.style.opacity = '0'; } }
    var specks = [];
    for (var i = 0; i < o.speckCount; i++) specks.push({ a: Math.random() * Math.PI * 2, d: 0.55 + Math.random() * 0.5, r: 0.05 + Math.random() * 0.08 });
    blooms.push({ x: x, y: y, color: curColor, r0: o.r0, r1: o.r1, t: 0, life: o.life, a0: o.a0, fade: o.fade, specks: specks });
    runLoop();
  }

  // A controlled brush mark (while the pointer moves): tight, and it keeps most
  // of its pigment as it settles, so strokes stay visible.
  function controlledSeed(x, y) {
    var base = Math.min(canvas.width, canvas.height) * 0.05;
    makeBloom(x, y, {
      r0: base * (0.45 + Math.random() * 0.2),
      r1: base * (1.25 + Math.random() * 0.5),
      life: 750 + Math.random() * 450,
      a0: 0.2 + Math.random() * 0.05,
      fade: 0.28,
      speckCount: 2
    });
  }

  // A wet bleed: ONLY while the pointer is held still. Pigment spreads outward
  // and lightens like water on soaked paper, growing the longer you linger.
  function wetSeed(p, level) {
    var base = Math.min(canvas.width, canvas.height) * 0.05;
    makeBloom(p.x, p.y, {
      r0: base * 0.5,
      r1: base * Math.min(5, 1.8 + level * 0.7),
      life: 1700 + Math.random() * 900,
      a0: 0.12 + Math.random() * 0.03,
      fade: 0.78,
      speckCount: 5
    });
  }

  function paintMove(p) {
    var base = Math.min(canvas.width, canvas.height) * 0.05;
    var gap = base * 0.7;
    lastMoveTime = performance.now();
    holdLevel = 0; holdAnchor = p;
    if (lastSeed) {
      var dx = p.x - lastSeed.x, dy = p.y - lastSeed.y;
      var dist = Math.hypot(dx, dy);
      if (dist < gap) return;
      var steps = Math.floor(dist / gap);
      for (var i = 1; i <= steps; i++) {
        var t = i / steps;
        if (Math.random() < 0.35) curColor = palette[Math.floor(Math.random() * palette.length)];
        controlledSeed(lastSeed.x + dx * t, lastSeed.y + dy * t);
      }
    }
    lastSeed = p;
  }

  function holdTick() {
    if (!painting || !holdAnchor) return;
    if (performance.now() - lastMoveTime > 150) { holdLevel++; wetSeed(holdAnchor, holdLevel); }
  }

  function startPaint(e) {
    painting = true; lastSeed = null; holdLevel = 0;
    curColor = palette[Math.floor(Math.random() * palette.length)];
    var p = pos(e); controlledSeed(p.x, p.y); lastSeed = p; holdAnchor = p;
    lastMoveTime = performance.now();
    if (!holdInterval) holdInterval = setInterval(holdTick, 120);
    e.preventDefault();
  }
  function movePaint(e) { if (!painting) return; paintMove(pos(e)); e.preventDefault(); }
  function endPaint() { painting = false; lastSeed = null; holdAnchor = null; holdLevel = 0; if (holdInterval) { clearInterval(holdInterval); holdInterval = null; } }

  if (stage && ctx) {
    sizeCanvas();
    stage.addEventListener('mousedown', startPaint);
    window.addEventListener('mousemove', movePaint, { passive: false });
    window.addEventListener('mouseup', endPaint);
    stage.addEventListener('touchstart', startPaint, { passive: false });
    stage.addEventListener('touchmove', movePaint, { passive: false });
    stage.addEventListener('touchend', endPaint);
    if (clearBtn) clearBtn.addEventListener('click', function () {
      blooms.length = 0;
      sctx.clearRect(0, 0, stain.width, stain.height);
      composite();
      painted = false; if (hint) { hint.classList.remove('gone'); hint.style.opacity = ''; }
    });
  }

  // initial paint
  onScrollHeader(); applyParallax(); drawPath();
})();
