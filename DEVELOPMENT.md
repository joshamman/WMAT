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
> **not** sync across machines. Commit and push your working branch on the
> machine you're leaving, then `git fetch && git checkout <branch>` on the other.
> (As of this writing there's a full audit underway on branch
> `claude/eloquent-herschel-dea04a` with **uncommitted** changes — push it before
> switching machines, or those edits won't be on the laptop.)

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

- **Pages:** `.astro` files in `site/src/pages/` (home, about, services, contact,
  thanks, blog).
- **Blog posts:** add Markdown files to `site/src/content/blog/` (or use the
  Decap CMS at `/admin/` — see the deploy notes in `site/README.md`).
- **Images:** drop into `site/public/assets/images/`.

---

## 8. Deploy (summary)

It's a static site plus one PHP file. Build, then upload the **contents of
`site/dist/`** (which already includes `contact.php`) to a PHP-capable web root.
Full instructions — Apache vs nginx, the contact form, the blog CMS — are in
[`site/README.md`](site/README.md).
