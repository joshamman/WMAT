# Development setup — West Michigan Art Therapy

How to get the site running locally on a fresh machine (e.g. picking the project
up on a laptop). This is the onboarding entry point; for the project layout and
deploy details see [`site/README.md`](site/README.md).

> **Where the project lives:** the active site is the static Astro project in
> [`site/`](site/). The top-level `wordpress/` and `wmat-theme/` folders are the
> **old WordPress build, now retired** — ignore them for day-to-day work.

---

## 1. Prerequisites

| Tool | Version | Needed for | Notes |
|------|---------|-----------|-------|
| **Node.js** | 22.x (tested on 22.17.0) | everything | includes `npm` |
| **Git** | any recent | clone / branches | |
| **PHP** | 8.x | *only* testing the contact form | not needed for normal dev |

On macOS the easiest installs:

```bash
# Node — via nvm (recommended) or Homebrew
brew install node          # or: nvm install 22 && nvm use 22

# PHP — only if you want to test the contact form locally
brew install php
```

Verify:

```bash
node -v    # v22.x
npm -v
php -v     # optional
```

---

## 2. Get the code

```bash
git clone https://github.com/joshamman/WMAT.git
cd WMAT
```

> **Picking up in-progress work from another machine:** uncommitted changes do
> **not** sync across machines. Commit and push on the machine you're leaving,
> then `git pull` on the other. Active work is on `main`.

`node_modules/`, `dist/`, and `.astro/` are git-ignored, so a fresh clone always
needs `npm install` (next step).

---

## 3. Run it locally

```bash
cd site
npm install        # first time, or after pulling dependency changes
npm run dev        # http://localhost:4321
```

Edit files under `site/src/` and the dev server hot-reloads.

---

## 4. Build & preview the production output

```bash
cd site
npm run build      # outputs the static site to site/dist/
npm run preview    # serves the built site to check it before deploy
```

---

## 5. Test the contact form (PHP)

The contact form POSTs to `/contact.php`, a PHP handler. **`npm run dev` cannot
run PHP**, so the form only works against a PHP-capable server. To test locally,
build first and serve `dist/` with PHP's built-in server:

```bash
cd site
npm run build
php -S localhost:8000 -t dist     # then open http://localhost:8000/contact
```

A successful submit redirects to `/thanks/`. For real email delivery you must
fill in SMTP credentials — see [`site/SMTP-SETUP.md`](site/SMTP-SETUP.md). Without
them the handler falls back to PHP `mail()`, which usually won't send from a
local machine (that's expected locally).

---

## 6. Other useful commands

```bash
cd site
npm run check          # WCAG colour-contrast check (scripts/wcag-contrast.mjs)
```

---

## 7. Editing content

The marketing site is a **single page** (`site/src/pages/index.astro`) plus
Contact, Blog, Thanks, and 404.

- **Pages / copy & layout:** `.astro` files in `site/src/pages/`. Most content is
  on the home one-pager (`index.astro`).
- **Blog posts:** add Markdown files to `site/src/content/blog/` (frontmatter:
  `title`, `date`, `excerpt`, `image`, `imageAlt`, `draft`), rebuild, re-upload.
  No admin UI — posts are managed in code.
- **Images:** drop into `site/public/assets/images/` (remember `alt` text).

---

## 8. Deploy (summary)

It's a static site plus one PHP file. Build, then upload the **contents of
`site/dist/`** (which already includes `contact.php` + `lib/PHPMailer/`) to a
PHP-capable web root, and set the email password on the server
([`site/SMTP-SETUP.md`](site/SMTP-SETUP.md)). Full instructions — Apache vs
nginx, the contact form, SEO — are in [`site/README.md`](site/README.md).
