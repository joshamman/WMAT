# Contact form (self-hosted PHP)

The static site (in `site/`) ships a styled contact form on **`/contact`** that
POSTs to **`/contact.php`**. The handler emails Amy and redirects the visitor to
**`/thanks/`**. No plugin, no WordPress, no third-party form service.

> This replaces the old WordPress / Contact Form 7 setup, which was dropped when
> the site moved to a static Astro build. See `site/README.md` for the full
> deploy guide.

## How it works
- Form: `site/src/pages/contact.astro` — `method="POST"`, `action="/contact.php"`.
- Handler: `site/public/contact.php` — `public/` is copied verbatim into the
  build, so the handler lands at the site root as `/contact.php`.
- Success: the handler sends the email and issues a `303` redirect to `/thanks/`
  (`site/src/pages/thanks.astro`).
- Spam: a hidden honeypot field (`bot-field`) — if a bot fills it, the handler
  pretends success and redirects to `/thanks/` **without sending**.

## Requirements
The host must run **PHP** (Apache with PHP, or nginx + PHP-FPM). The rest of the
site is plain static HTML; PHP is only needed for this one file.

`npm run dev` can't execute PHP. To test the form locally, build first and serve
the output with PHP:

```bash
cd site
npm run build
php -S localhost:8000 -t dist     # then submit the form at /contact
```

## Configure delivery (IONOS — already set up)
`site/public/contact.php` is pre-configured for **IONOS SMTP**:

- **`$TO`** — `amy@westmichiganarttherapy.com` (forwards to Amy's Google inbox).
- **`$FROM`** — `joshua@hamman.org`. IONOS only lets the mailbox send as itself,
  so the From address must equal the authenticated account; the visitor's address
  is set as `Reply-To` automatically.
- **`$SMTP`** — `smtp.ionos.com:587` (STARTTLS), user `joshua@hamman.org`, via the
  bundled PHPMailer (`public/lib/PHPMailer/`, nothing to install).

The **only** value to add is the mailbox **password**, set in `contact.php`
**on the server** (never committed). Full notes: **[`site/SMTP-SETUP.md`](site/SMTP-SETUP.md)**.

That's it — submissions email Amy with the design intact.
