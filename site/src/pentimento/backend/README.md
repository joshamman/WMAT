# Pentimento sync backend (Phase A)

A tiny PHP + MySQL key/value store so Pentimento can sync **your and Amy's own test
sessions** across devices, reusing the existing host (the PHP that runs the contact form)
and the legacy WordPress MySQL database. No new hosting, no new cost.

> ⚠ **Phase A only — no real client data.** The app sends a single shared token that is
> visible in its page source, so this is a *soft gate*, not real security. It's fine for
> your own practice drawings (not PHI, per HANDOFF §8.1). Storing an actual client's
> session here would be PHI and is **not allowed** until Phase B (per-therapist accounts,
> consent capture, audit logging, encryption at rest, and a signed BAA — HANDOFF §8).

## What's here

- `schema.sql` — one table (`pentimento_kv`) to create in the WordPress DB.
- `api.php` — the endpoint: `GET/PUT/DELETE api.php?key=<k>` with an `X-Pentimento-Token` header.
- `config.sample.php` — copy to `config.php` (git-ignored) and fill in DB creds + token.

## Set it up (once)

1. **Create the table** in the legacy WordPress database:
   ```
   mysql -u YOUR_DB_USER -p YOUR_WP_DB_NAME < schema.sql
   ```
2. **Configure**: `cp config.sample.php config.php`, then edit `config.php` with the WP
   DB credentials (from that site's `wp-config.php`) and a long random `AUTH_TOKEN`
   (e.g. `openssl rand -hex 24`).
3. **Upload** `api.php` and `config.php` to the host, e.g. into a `pentimento-api/` folder,
   so it's reachable at `https://YOUR-HOST/pentimento-api/api.php`. Must be served over
   **https**.
4. **Point the app at it**: in `index.html`, set
   ```js
   window.PENTIMENTO_BACKEND = { url: "https://YOUR-HOST/pentimento-api/api.php", token: "the-same-AUTH_TOKEN" };
   ```
   Deploy the app folder. Do the same on Amy's device/copy and you're synced.

Leaving `window.PENTIMENTO_BACKEND = null` keeps the app local-only (localStorage) exactly
as before — the backend is entirely opt-in.

## How it behaves

- The app writes to the server **and** mirrors to this device's localStorage, so an offline
  or failed save never loses data; reads fall back to that local cache when offline.
- Conflict handling is **last-write-wins** per key (fine for two people not editing the same
  session at the same instant). No real-time merge — that's out of scope for Phase A.

## Security notes (read before going further)

- The token is a shared soft gate over https — it stops casual/anonymous access, nothing more.
- `config.php` holds DB credentials: keep it out of git (it's in `.gitignore`) and make sure
  the host won't serve it as text.
- Do **not** widen this to real clients or other therapists without the Phase B work.
