# Contact form — SMTP credentials (fill in on deploy)

The contact handler (`public/contact.php` → published as `/contact.php`) emails
Amy's inquiries via **IONOS SMTP**, authenticated as `joshua@hamman.org` (the one
mailbox on the server). It's pre-configured except the **password**, which must be
added on the server only.

> ⚠️ This file is a **note only** — it lives outside `public/`, so it is *not*
> uploaded with the site. Never put the real password in a file under `public/`
> in git. Set it directly in `public/contact.php` **on the server** after upload.

## How it routes

- **Send (SMTP):** `smtp.ionos.com:587` (STARTTLS), auth as `joshua@hamman.org`.
- **From:** `joshua@hamman.org` — IONOS only lets the mailbox send as **itself**,
  so the From address must be this. Display name shows "West Michigan Art Therapy
  (website)". IONOS signs it with hamman.org SPF/DKIM, so it passes auth.
- **To:** `amy@westmichiganarttherapy.com` → forwards to Amy's Google inbox.
- **Reply-To:** the website visitor's email — so Amy just hits Reply to answer.

## What to fill in

Only the password. In `public/contact.php` on the server, set:

```php
$SMTP = array(
    'host'   => 'smtp.ionos.com',
    'port'   => 587,
    'user'   => 'joshua@hamman.org',
    'pass'   => 'YOUR_IONOS_MAILBOX_PASSWORD',   // <-- set on the server only
    'secure' => 'tls',
);
```

(If port 587 is blocked, use `'port' => 465` with `'secure' => 'ssl'`.)

## Test after configuring

Submit the live `/contact` form once after uploading — a success redirects to
`/thanks/`; a failure shows a "couldn't be sent — email Amy directly" message.
Check Amy's Gmail (and Spam the first time). Locally you can also test with PHP:

```bash
cd site && npm run build
php -S localhost:8000 -t dist     # then submit /contact
```

## Optional: keep a copy for yourself

To also receive each inquiry at `joshua@hamman.org`, add a CC in `contact.php`
inside the SMTP block, after `$mail->addAddress($TO);`:

```php
$mail->addCC('joshua@hamman.org');
```
