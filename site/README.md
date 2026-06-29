# West Michigan Art Therapy — static site

A fast, static site (Astro) for [westmichiganarttherapy.com](https://westmichiganarttherapy.com).
No WordPress, no database, no maintenance. Matches the design system exactly.

- **Home** — the immersive "Visual Journey" (parallax washes, the watercolor
  paint canvas, the journey path, dusk closing).
- **About / Services / Contact** — the full designed pages.
- **Blog** — Markdown posts, editable by Amy via a simple admin (Decap CMS).
- **Contact form** — emails Amy via Netlify Forms (no plugin).

## Run it locally

```bash
cd site
npm install
npm run dev      # http://localhost:4321
```

`npm run build` outputs the static site to `dist/`. `npm run preview` serves the built site.

## Project layout

```
site/
├── src/
│   ├── pages/        index (immersive home), about, services, contact, thanks,
│   │                 blog/index, blog/[...slug]
│   ├── layouts/      BaseLayout, PageLayout
│   ├── components/   Header, Footer, Icon
│   ├── content/blog/ Markdown blog posts
│   └── styles/       global.css, journey.css (immersive home only)
└── public/
    ├── admin/        Decap CMS (config.yml + index.html)
    └── assets/       fonts, images, js (journey.js, wmat.js), uploads
```

## Deploy (Netlify — free)

1. Push this repo to GitHub (already at `joshamman/WMAT`).
2. Netlify → **Add new site → Import from GitHub** → pick the repo.
   - **Base directory:** `site`
   - **Build command:** `npm run build`
   - **Publish directory:** `site/dist`
   (These are also in `netlify.toml`.)
3. Deploy. You get a `*.netlify.app` URL immediately.
4. **Custom domain:** Netlify → Domain settings → add `westmichiganarttherapy.com`,
   then point DNS at Netlify. (Do this once you're happy with the preview.)

### Contact form → Amy's inbox
Netlify auto-detects the form on `/contact`. In Netlify → **Forms → Form
notifications → Add email notification** → send to `amy@westmichiganarttherapy.com`.
Submissions also show in the Netlify dashboard. (Add reCAPTCHA there if spam appears.)

### Blog CMS for Amy (Decap + Netlify Identity)
1. Netlify → **Integrations/Identity → Enable Identity**.
2. Identity → **Registration: Invite only**; under **Services → Git Gateway → Enable**.
3. Identity → **Invite users** → invite `amy@…`. She gets an email, sets a password.
4. She logs in at **`/admin/`** to write/publish posts — no code. Posts commit to the
   repo and the site rebuilds automatically.

## Editing content yourself
- Pages: edit the `.astro` files in `src/pages/`.
- Blog posts: add Markdown files to `src/content/blog/` (or use `/admin/`).
- Real photos: drop them in `public/assets/images/` and swap the `mark-*` /
  `portrait-placeholder` stand-ins for real photos of Amy, the studio, and artwork.
