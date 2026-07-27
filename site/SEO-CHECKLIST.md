# SEO Checklist — West Michigan Art Therapy

The site itself now ships everything on-page: sitemap (`/sitemap-index.xml`),
`robots.txt` welcoming search + AI crawlers, `llms.txt`, RSS (`/rss.xml`),
LocalBusiness/Person/FAQ/BlogPosting/Service structured data, city landing
pages (`/art-therapy-*`), branded social card, favicons, and an `.htaccess`
with canonical redirects. What remains is **off-site** — accounts and listings
only Josh/Amy can create. Work top to bottom; the first three items matter most.

**NAP rule (use everywhere, exactly):**
> **West Michigan Art Therapy** · West Olive, MI · amy@westmichiganarttherapy.com · westmichiganarttherapy.com

No street address and no phone anywhere, ever (privacy decision). Consistency
of that exact name/city/email across every listing is what local search
rewards.

---

## 1. Google Search Console  *(~15 min, do first)*

1. Go to [search.google.com/search-console](https://search.google.com/search-console) with the practice's Google account.
2. Add property → **Domain** (`westmichiganarttherapy.com`) → verify via the **DNS TXT record** in the IONOS control panel (Domains → DNS). This covers www/non-www/http/https all at once.
   - Alternative: **URL-prefix** property + HTML-file verification — download the `googleXXXX.html` file and commit it to `site/public/` so every rebuild keeps it. DNS is still preferred.
3. Once verified: **Sitemaps → add `https://westmichiganarttherapy.com/sitemap-index.xml`**.
4. **URL Inspection** → request indexing for:
   - `/` and `/service-areas/`
   - each `/art-therapy-*/` page (5 of them)
5. After ~2 weeks, check **Pages** (indexing report): the city pages should appear; `/thanks/` should show as "excluded by noindex" — that's correct.
6. Settings → Associations → link the **GA4 property** (G-R0JV4T0QSJ).

## 2. Google Business Profile  *(~30 min — the single biggest local-ranking lever)*

Create at [business.google.com](https://business.google.com) as a **service-area business** so the home address stays private:

1. Business name: **West Michigan Art Therapy** (exactly — no keywords bolted on; Google suspends profiles for that).
2. Category: **Art therapist** (primary). Secondary if offered: *Mental health service*.
3. When asked "Do you want to add a location customers can visit?" → **No**. Enter the real address only for the verification mail-out if required — it will not be shown.
4. Service areas: West Olive, Grand Rapids, Holland, Muskegon, Norton Shores, Grand Haven, Spring Lake, Ferrysburg, Saugatuck, Douglas (you can also add Ottawa/Kent/Muskegon/Allegan counties).
5. Website: `https://westmichiganarttherapy.com` · Appointment link: `https://westmichiganarttherapy.com/contact/`.
6. Phone: leave empty (allowed) — contact stays email/form.
7. Services: add the five (Individual Sessions, Group Sessions, Workshops, Online Supervision, Presentations) with the site's prices.
8. Photos: upload the logo, the social card (`/assets/images/og-default.png`), Amy's photo, and later real studio/artwork photos — profiles with photos rank and convert better.
9. Complete verification (video or postcard). Then keep it alive: an occasional "update" post (a blog post link works) every month or two.

## 3. Bing Webmaster Tools + Bing Places  *(~10 min — also feeds Copilot & DuckDuckGo)*

1. [bing.com/webmasters](https://www.bing.com/webmasters) → **Import from Google Search Console** (one click after #1).
2. Confirm the sitemap imported; if not, submit `sitemap-index.xml`.
3. [bingplaces.com](https://www.bingplaces.com) → **Import from Google Business Profile** (after #2 is verified).

## 4. Directories & professional locators  *(~1–2 hrs total, spread it out)*

Same NAP everywhere; link to the site; skip anything that demands a street address be published.

| Directory | Why | Notes |
|---|---|---|
| **Psychology Today** | The dominant therapist search | Paid (~$30/mo) but usually worth it for one client. Profile city: West Olive; add telehealth-statewide. |
| **TherapyDen** | Free, growing | Free listing, inclusive filters. |
| **ATCB "Find a Credentialed Art Therapist"** ([atcb.org](https://www.atcb.org/)) | THE credential authority for ATR-BC | Make sure Amy's listing is current + links to the site. |
| **AATA Art Therapist Locator** ([arttherapy.org](https://arttherapy.org/)) | National association locator | Member benefit. |
| **Michigan Association of Art Therapy** ([michiganarttherapy.org](https://www.michiganarttherapy.org/)) | State association | Member listing with a link — also a rare, high-relevance backlink. |
| **Harbor Hospice** | Amy already appears in their art-therapy program | Ask them to link "Amy Rostollan-Hamman, West Michigan Art Therapy" to the site — a genuinely earned local backlink. |
| Facebook & LinkedIn profiles | Already linked from the site | Set city fields to West Olive, MI; add the website URL everywhere a link is allowed. |

## 5. First-deploy server checks  *(one time, right after uploading this build)*

1. **Before uploading:** check whether the webroot already has a hand-managed `.htaccess`. If yes, **merge** the rules from `site/public/.htaccess` into it instead of overwriting. If the IONOS panel already forces HTTPS, that's fine — the rules coexist.
2. Upload the **entire contents of `site/dist/`** — including the hidden `.htaccess` file (enable "show hidden files" in your SFTP client) — plus the usual `contact.php` + `lib/`.
3. Verify redirects and files:
   ```bash
   curl -sI http://www.westmichiganarttherapy.com/ | grep -i '^location'
   # expect: https://westmichiganarttherapy.com/
   curl -s https://westmichiganarttherapy.com/robots.txt | head -3
   curl -s https://westmichiganarttherapy.com/llms.txt | head -5
   curl -sI https://westmichiganarttherapy.com/rss.xml | head -1
   curl -sI https://westmichiganarttherapy.com/nope-404 | head -1   # expect 404
   ```
4. Structured data: run `https://westmichiganarttherapy.com/`, one `/art-therapy-*/` page, and one blog post through the [Rich Results Test](https://search.google.com/test/rich-results) and [validator.schema.org](https://validator.schema.org/).
5. Social cards: paste the home URL into the [Facebook Sharing Debugger](https://developers.facebook.com/tools/debug/) and [LinkedIn Post Inspector](https://www.linkedin.com/post-inspector/) — both also force a fresh scrape of the new card.

## 6. Ongoing (low effort, high compounding value)

- **Blog once in a while** — city- and specialty-relevant posts ("What a first art therapy session in Holland looks like", hospice/legacy stories like the Harbor piece) are the best long-term fuel; the RSS feed + BlogPosting schema are already wired.
- Check Search Console monthly: which queries show impressions, which city pages rank.
- When real studio/artwork photos exist, swap the remaining stand-in art (`mark-*.jpg`) — authentic photos help E-E-A-T and GBP.
- Note: FAQ rich results in Google are limited to gov/health authorities these days — our FAQPage markup is there for AI assistants and answer engines, so don't expect FAQ stars in classic search.
- GA4 runs without a cookie/consent banner. Fine for now; if traffic grows or compliance questions come up, revisit.
