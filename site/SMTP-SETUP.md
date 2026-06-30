# Contact form — SMTP credentials (fill in on deploy)

The contact handler (`public/contact.php` → published as `/contact.php`) sends
Amy's inquiry emails. Out of the box the `$SMTP` block is **blank**, so it falls
back to PHP `mail()` — which shared hosts often block or route to spam. For
reliable delivery, fill in the mailbox's SMTP credentials.

> ⚠️ This file is a **note only** — it lives outside `public/`, so it is *not*
> uploaded with the site. Do **not** put real passwords in a file under
> `public/` (that folder is served on the web). Edit the values directly in
> `public/contact.php` on the server, or keep the filled-in copy somewhere
> private. Never commit real credentials to git.

## What to fill in

Edit the `$SMTP` array near the top of `public/contact.php`:

```php
$SMTP = array(
    'host'   => 'mail.westmichiganarttherapy.com',   // mailbox SMTP host
    'port'   => 587,                                 // 587 = TLS, 465 = SSL
    'user'   => 'amy@westmichiganarttherapy.com',    // mailbox username
    'pass'   => 'REPLACE_WITH_MAILBOX_PASSWORD',     // mailbox password
    'secure' => 'tls',                               // 'tls' for 587, 'ssl' for 465
);
```

Get `host` / `port` / `user` / `pass` from the email host (the same SMTP details
you'd use to set up the mailbox in an email client). Leave `host` as `''` to keep
using PHP `mail()` instead.

While you're there, confirm the addresses at the top of the file:

- `$TO`   = `amy@westmichiganarttherapy.com`  (where inquiries are delivered)
- `$FROM` = `no-reply@westmichiganarttherapy.com`  (must be on your domain so it
  passes SPF/DMARC; the visitor's address is set as `Reply-To` automatically)

## Test after configuring

```bash
cd site
npm run build
php -S localhost:8000 -t dist     # submit /contact, confirm it lands on /thanks/
```

(or just submit the live form once after uploading). A successful submit
redirects to `/thanks/`; a failed send shows a "couldn't be sent — email Amy
directly" message.
