# West Michigan Art Therapy — WordPress Block Theme

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
- **Watercolor washes** — `.wmat-wash` blobs distorted by SVG turbulence filters
  (`#wc-edge` / `#wc-soft`, injected via `functions.php`); CSS in `style.css`,
  respects reduced-motion.
- **Wave divider** — layered lakeshore bands (in the footer + `wmat/wave-divider`).
- **Lucide icons** — inline stroke icons via the `wmat_icon()` helper in
  `functions.php` (no external requests).

## Theme structure (`wmat-theme/`)

```
wmat-theme/
├── theme.json          Design tokens + global styles (the system)
├── style.css           Theme header, DS tokens, component CSS, watercolor
├── functions.php       Enqueue, editor styles, pattern categories, SVG filters, wmat_icon()
├── templates/          front-page, page-about, page-services, page-contact,
│                       index, page, single, archive, 404, page-no-title
├── parts/              header (sticky/blur), footer (wave + navy)
├── patterns/           hero, home-what-is, home-services, home-testimonial,
│                       page-about, page-services, page-contact, cta-contact, wave-divider
├── styles/             alternate style variations (e.g. evening)
└── assets/
    ├── fonts/          self-hosted variable woff2 (Newsreader, Hanken Grotesk, Caveat)
    ├── js/             wmat.js (rotating hero taglines, progressive enhancement)
    └── images/         logo, lakeshore photo, portrait stand-in
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
1. **Home** — Settings → Reading → *A static page* → choose/create a page for the
   home (the `front-page.html` template renders the full home design automatically).
2. **About / Services / Contact** — create Pages with the slugs `about`,
   `services`, and `contact`. The matching `page-{slug}.html` templates apply the
   full page designs automatically — no manual layout needed.
3. **Menu** — Appearance → Editor → Navigation: add Home, About, Services, Contact.

The page designs are also available as insertable patterns (inserter → *Full
pages*) if you'd rather edit the content per-page in the block editor.

## Status

Full v2 design system implemented: lakeshore tokens, Newsreader/Hanken
Grotesk/Caveat fonts, watercolor + wave motifs, Lucide icons, and all four pages
(Home, About, Services, Contact) with real copy, pricing, FAQ, testimonial, and a
styled inquiry form (mailto fallback). Next: real logo + photography of Amy/the
studio, and wiring the contact form to a proper handler (form plugin).
