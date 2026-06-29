# West Michigan Art Therapy — WordPress Block Theme

A custom WordPress **block theme** (full-site editing) and design system for
[westmichiganarttherapy.com](https://westmichiganarttherapy.com) — the practice
of **Amy Rostollan-Hamman, ATR-BC**, on Michigan's art coast.

The look is a warm **Lake Michigan dune-coast** world: lake teal & blue, sun
gold, driftwood, beach grass, and sand — built so structure/design lives in
code while content (blog posts, page copy) is edited in the WordPress editor.

## The design system

Everything visual is defined as tokens in **`theme.json`**:

- **Color** — `base`, `surface`, `contrast`, `primary` (teal), `secondary`
  (blue), `navy`, `accent` (gold), `ochre`, `sage`, `muted`, plus
  `shoreline` / `sunrise` / `dune-fade` gradients.
- **Typography** — *Fraunces* (display) + *Mulish* (body), self-hosted variable
  fonts in `assets/fonts/`, with a fluid type scale.
- **Spacing** — a fluid `clamp()`-based scale (`20`–`70`).
- **Shadows, borders, layout widths** — all preset.

Change a token in `theme.json` and it cascades through every template, pattern,
and the editor UI Amy uses.

## Structure

```
.
├── theme.json          Design tokens + global styles (the system)
├── style.css           Theme header + minimal global CSS
├── functions.php       Enqueue, editor styles, pattern category
├── templates/          front-page, index, page, single, archive, 404, page-no-title
├── parts/              header, footer
├── patterns/           hero, services, about-intro, cta-contact
├── styles/             alternate style variations (e.g. evening)
├── assets/
│   ├── fonts/          self-hosted variable woff2
│   └── images/         logo + web-ready imagery
└── brand-source/       Illustrator originals & concepts (gitignored, local only)
```

## Local development

This repo *is* the theme. Symlink (or copy) it into a WordPress install:

```bash
ln -s "/Volumes/Work Drive/Sites/WestMichiganArtTherapy" \
  /path/to/wordpress/wp-content/themes/wmat
```

Then in **wp-admin → Appearance → Themes**, activate *West Michigan Art Therapy*.
Set the home page under **Settings → Reading → A static page** (or the
`front-page.html` template applies automatically once a front page is set).

## Status

Foundation scaffold complete: design tokens, base templates, header/footer,
and four section patterns. Next: real logo export, page content, and a contact
form. See project notes for the roadmap.
