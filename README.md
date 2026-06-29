> **⚡ This project is now a static site (Astro) in [`site/`](site/).**
> WordPress was dropped in favor of a fast, zero-maintenance static site that
> matches the design exactly, emails Amy via Netlify Forms, and lets Amy publish
> blog posts via a simple CMS. See **[`site/README.md`](site/README.md)** to run
> and deploy. The WordPress theme below (`wmat-theme/`) is kept for reference only.

---

# West Michigan Art Therapy — WordPress Block Theme (legacy)

A custom WordPress **block theme** (full-site editing) and design system for
[westmichiganarttherapy.com](https://westmichiganarttherapy.com) — the practice
of **Amy Rostollan-Hamman, ATR-BC**, on Michigan's art coast.

The look is a warm **Lake Michigan lakeshore** world: lake teal & navy, a single
sun-gold accent, sage/pine, sand & clay, on cream — with a signature
**watercolor wash** motif and layered **wave** bands. Structure/design lives in
code; content (blog posts, page copy) is edited in the WordPress editor.

## Repository layout

The theme lives in its own folder so the repo can also hold design source and
notes. **`wmat-theme/` is the only thing WordPress needs.**

```
.
├── wmat-theme/          ← the WordPress theme (upload THIS folder)
└── brand-source/        Illustrator originals, design-system export (gitignored)
```

## The design system

Everything visual is defined as tokens in **`wmat-theme/theme.json`**:

- **Color** — `base`/`surface` (cream), `contrast` (ink), `primary`/`primary-dark`
  (teal), `secondary` (sky blue), `navy`, `accent` (gold), `ochre` (clay),
  `sage`, `pine`, `sand`, `muted` — plus `shoreline` / `sunrise` / `dune-fade`
  gradients.
- **Typography** — *Newsreader* (display serif), *Hanken Grotesk* (body sans),
  *Caveat* (hand accent) — self-hosted variable woff2 in `assets/fonts/`,
  fluid type scale.
- **Spacing / shadows / borders / layout widths** — all preset (warm
  navy-tinted shadows, soft radii).

Change a token and it cascades through every template, pattern, and the editor
UI Amy uses.

### Signature motifs
- **Immersive homepage** — `front-page.html` renders the "Visual Journey":
  full-bleed parallax hero, drifting watercolor washes, an **interactive paint
  canvas** ("make a mark"), a journey path that draws as you scroll, a painted
  services collage, and a dusk closing. Engine: `assets/css/journey.css` +
  `assets/js/journey.js` (vanilla, parallax + reveals + canvas), loaded only on
  the front page. Respects `prefers-reduced-motion`.
- **Watercolor washes** — soft blobs distorted by SVG turbulence filters
  (`#wc-edge` / `#wc-soft`, injected via `functions.php`).
- **Wave divider** — layered lakeshore bands (in the footer + `wmat/wave-divider`).
- **Lucide icons** — inline stroke icons via the `wmat_icon()` helper (no external
  requests).

## Theme structure (`wmat-theme/`)

```
wmat-theme/
├── theme.json          Design tokens + global styles (the system)
├── style.css           Theme header, DS tokens, component CSS, watercolor
├── functions.php       Enqueue, editor styles, pattern categories, SVG filters, wmat_icon()
├── templates/          front-page (immersive home), page-about, page-services,
│                       page-contact, index, page, single, archive, 404, page-no-title
├── parts/              header (sticky/blur), footer (wave + navy)
├── patterns/           home-immersive, page-about, page-services, page-contact,
│                       cta-contact, wave-divider (+ standalone home sections)
├── styles/             alternate style variations (e.g. evening)
└── assets/
    ├── fonts/          self-hosted variable woff2 (Newsreader, Hanken Grotesk, Caveat)
    ├── css/            journey.css (immersive homepage)
    ├── js/             journey.js (parallax/paint), wmat.js
    └── images/         logo, lakeshore photo, artwork stand-ins
```

## Install

Upload **`wmat-theme/`** to `wp-content/themes/` (SFTP), or symlink it for local
dev:

```bash
ln -s "/Volumes/Work Drive/Sites/WestMichiganArtTherapy/wmat-theme" \
  /path/to/wordpress/wp-content/themes/wmat
```

Then **wp-admin → Appearance → Themes** → activate *West Michigan Art Therapy*.

### Getting the full design live

The designs render **automatically** — no pattern-hunting required.

1. **Homepage** — the immersive "Visual Journey" home shows at the site root as
   soon as the theme is active (it's built into `front-page.html`). If you want a
   blog list too, set Settings → Reading → a *Posts page*.
2. **About / Services / Contact** — just create three Pages with the slugs
   `about`, `services`, `contact`. The `page-{slug}.html` templates apply the full
   designs automatically.
3. **Contact form** — see [CONTACT-FORM.md](CONTACT-FORM.md) to wire Contact Form 7.

To **edit copy/layout**, use the Site Editor (Appearance → Editor → Templates /
Patterns) — the block-theme way. Individual section patterns are also in the
inserter under *West Michigan Art Therapy* and *Full pages* if you want to
reassemble pages by hand.

## Status

Full v2 design implemented and **turnkey** — designs render automatically (no
manual pattern insertion). Immersive scrollytelling homepage (parallax, paint
canvas, journey path) plus About / Services / Contact with real copy, pricing,
FAQ, testimonial, and a Contact Form 7-ready inquiry form. Lakeshore tokens,
Newsreader/Hanken Grotesk/Caveat fonts, watercolor + wave motifs.

Next: real logo + photography of Amy/the studio (artwork stand-ins are in place),
and finishing the CF7 setup.
