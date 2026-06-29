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

## Deploy to your own server

It's a static site — build it and upload the files. No Node needed on the server
(only PHP, for the contact form).

```bash
cd site
npm install
npm run build      # outputs everything to site/dist/
```

Upload the **contents of `site/dist/`** to your web root (e.g. `/var/www/html`
or `public_html`). That folder already includes `contact.php`. Done.

- **Apache:** works as-is (pretty URLs are real folders with `index.html`).
- **nginx:** add `index index.html;` and `try_files $uri $uri/ =404;` for the
  location block; make sure PHP-FPM handles `.php`.

### Contact form → Amy's inbox (PHP, self-hosted)
The form on `/contact` POSTs to **`/contact.php`**, which emails
`amy@westmichiganarttherapy.com` and redirects to `/thanks/`. Settings (recipient,
From address) are at the top of `public/contact.php`.

- The `From` address should be on your domain (`no-reply@westmichiganarttherapy.com`)
  so it isn't rejected.
- If `mail()` is unreliable on your server, switch to **SMTP** (PHPMailer with your
  mailbox credentials) — there's a note at the bottom of `contact.php`.
- Local `npm run dev` can't run PHP; test the form on the server, or run the built
  site with `php -S localhost:8000 -t dist`.

### Blog CMS for Amy
The `/admin/` (Decap CMS) was set up for Netlify's free login. **On your own server
that auth isn't available**, so the blog can be managed one of these ways — tell me
which and I'll wire it:
- **Josh adds posts** — drop Markdown files in `src/content/blog/`, rebuild, upload. Simplest.
- **GitHub-based CMS** — Amy logs in to `/admin/` with a GitHub account (needs a small
  OAuth helper). Self-service, a little setup.

## Editing content yourself
- Pages: edit the `.astro` files in `src/pages/`.
- Blog posts: add Markdown files to `src/content/blog/` (or use `/admin/`).
- Real photos: drop them in `public/assets/images/` and swap the `mark-*` /
  `portrait-placeholder` stand-ins for real photos of Amy, the studio, and artwork.
