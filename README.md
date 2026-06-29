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
  (`#wc-edge` / `#wc-soft`, injected via `functions.php`) for a bleeding, painted
  edge. Used in the hero. CSS lives in `style.css`; respects reduced-motion.
- **Wave divider** — the `wmat/wave-divider` pattern; layered lakeshore bands.

## Theme structure (`wmat-theme/`)

```
wmat-theme/
├── theme.json          Design tokens + global styles (the system)
├── style.css           Theme header, brand utilities, watercolor CSS
├── functions.php       Enqueue, editor styles, pattern category, SVG filters
├── templates/          front-page, index, page, single, archive, 404, page-no-title
├── parts/              header, footer
├── patterns/           hero, services, about-intro, cta-contact, wave-divider
├── styles/             alternate style variations (e.g. evening)
└── assets/
    ├── fonts/          self-hosted variable woff2
    └── images/         logo + web-ready imagery
```

## Install

Upload **`wmat-theme/`** to `wp-content/themes/` (SFTP), or symlink it for local
dev:

```bash
ln -s "/Volumes/Work Drive/Sites/WestMichiganArtTherapy/wmat-theme" \
  /path/to/wordpress/wp-content/themes/wmat
```

Then **wp-admin → Appearance → Themes** → activate *West Michigan Art Therapy*.
Set the home page under **Settings → Reading → A static page** so
`front-page.html` applies, and build a menu under **Appearance → Editor →
Navigation**.

## Status

Foundation + design-system alignment complete: tokens, fonts, and the watercolor
hero now match the v1 design-system export. Next: real logo, full page content,
contact form, and (optionally) the immersive scrollytelling homepage.
