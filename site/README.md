# West Michigan Art Therapy — static site

A fast, static site (Astro) for [westmichiganarttherapy.com](https://westmichiganarttherapy.com) —
the practice of **Amy Rostollan-Hamman, ATR-BC**. No WordPress, no database, no
maintenance. WCAG 2.1 AA, SEO-ready, and it matches the design exactly.

## Pages
- **Home** (`/`) — a single immersive "Visual Journey" one-pager: hero, an
  interactive watercolor paint canvas, *what art therapy is*, the journey
  (arrive → explore → express → grow), *who Amy helps* (incl. hospice &
  juvenile-justice work, all ages), the approach, services & pricing, payment +
  FAQ, *meet Amy*, regions served, and a dusk closing. Nav is in-page anchors.
- **Contact** (`/contact`) — details + a form that emails Amy (→ `/thanks/`).
- **Blog** (`/blog`) — Markdown posts.
- Plus a branded **404** and a **thanks** page.

## Run it locally

```bash
cd site
npm install
npm run dev        # http://localhost:4321
npm run build      # static output to dist/
npm run preview    # serve the built site
npm run check      # WCAG colour-contrast gate (scripts/wcag-contrast.mjs)
```

## Project layout

```
site/
├── astro.config.mjs   site URL + sitemap integration
├── src/
│   ├── pages/         index (immersive home), contact, thanks, 404,
│   │                  blog/index, blog/[...slug]
│   ├── layouts/       BaseLayout (head, GA, JSON-LD, SEO), PageLayout (chrome)
│   ├── components/    Header, Footer, Icon
│   ├── content/blog/  Markdown blog posts  (+ content.config.ts schema)
│   └── styles/        global.css, journey.css (immersive home only)
├── public/
│   ├── contact.php    PHP form handler (published at /contact.php)
│   ├── lib/PHPMailer/ bundled mailer for SMTP
│   ├── robots.txt
│   └── assets/        fonts, images, js (journey.js, wmat.js)
└── scripts/
    └── wcag-contrast.mjs   AA contrast gate (npm run check)
```

## Accessibility (WCAG 2.1 AA)
- `npm run check` runs **two** gates: `wcag-contrast.mjs` (intended color pairs)
  and, after a build, `wcag-rendered.mjs` (resolves the actual CSS cascade for key
  interactive elements — catches specificity overrides like an ancestor
  `.j-nav a` recoloring the `.j-cta` label). The `wcag-auditor` agent
  (`.claude/agents/`) does a broader pre-publish review.
- Built in: visible focus, skip links, real landmarks, required-field semantics,
  reduced-motion handling, decorative paint canvas, ≥24px targets.

## Deploy to your own server

Static files + one PHP file. No Node needed on the server (only PHP).

```bash
cd site && npm run build
```

Upload the **contents of `site/dist/`** to your web root (e.g. `public_html`).
It already includes `contact.php`, `lib/PHPMailer/`, `robots.txt`, and
`sitemap-index.xml`.

- **Apache:** works as-is (pretty URLs are folders with `index.html`).
- **nginx:** ensure PHP-FPM handles `.php`, and add `index index.html;` +
  `try_files $uri $uri/ =404;`.

### Contact form → Amy's inbox (IONOS SMTP)
The form POSTs to **`/contact.php`**, which sends via **IONOS** (`smtp.ionos.com`,
authenticated as `joshua@hamman.org`) to `amy@westmichiganarttherapy.com` (which
forwards to her Google inbox), with the visitor's address as **Reply-To**.
Everything is pre-filled **except the password**, which you set on the server
only — see **[`SMTP-SETUP.md`](SMTP-SETUP.md)**. (Never commit the password.)

### Blog
Add a Markdown file to `src/content/blog/` (frontmatter: `title`, `date`,
`excerpt`, `image`, `imageAlt`, `draft`), rebuild, and re-upload. There is no
admin UI — posts are managed in code.

## SEO
`sitemap-index.xml` + `robots.txt`, canonical + Open Graph tags, `LocalBusiness`/
`Person` JSON-LD (ATR-BC via the Art Therapy Credentials Board), and Google
Analytics (G-R0JV4T0QSJ) — all wired in `BaseLayout.astro` / `astro.config.mjs`.

## Editing content / brand
- **Copy & layout:** the `.astro` files in `src/pages/` (home is `index.astro`).
- **Photos:** drop into `public/assets/images/`. Amy's photo is
  `amy-pittsburgh.jpg`; the journey/hero art and the logo are still brand
  stand-ins (`mark-*.jpg`, `logo.svg`) — swap in the real logo and photography
  when ready (update each image's `alt` text too).
