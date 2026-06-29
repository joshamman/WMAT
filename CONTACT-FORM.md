# Contact form (Contact Form 7)

The Contact page pattern ships with a **styled static form** that falls back to
`mailto:` — so the page works with no plugin. To capture submissions properly,
use **Contact Form 7** (free). The theme already includes CSS that styles CF7's
output to match the design.

## 1. Install & create the form
1. Plugins → Add New → install & activate **Contact Form 7**.
2. Contact → Add New. In the **Form** tab, replace the contents with:

```
<div class="wmat-form-row">
	<label class="wmat-field">Your name
		[text* your-name placeholder "First and last"]</label>
	<label class="wmat-field">Email
		[email* your-email placeholder "you@email.com"]</label>
</div>
<label class="wmat-field">I'm interested in…
	[select your-interest "Choose a service" "Individual Sessions" "Group Sessions" "Workshops" "Online Supervision" "Educational Presentations" "Not sure yet"]</label>
<label class="wmat-field">Your message
	[textarea your-message maxlength:180 placeholder "Tell me a little about what you're looking for…"]</label>
<label class="wmat-check">[checkbox sliding-scale "I'd like to hear about sliding-scale options"]</label>
[submit "Send Message"]
```

## 2. Mail tab
- **To:** `amy@westmichiganarttherapy.com`
- **From:** `[_site_admin_email]` (or a no-reply at your domain — using the
  visitor's address as From often fails SPF/DMARC)
- **Subject:** `New inquiry from [your-name] — westmichiganarttherapy.com`
- **Reply-To:** `[your-email]`  ← add this so replies go to the visitor
- **Message body:**
  ```
  Name: [your-name]
  Email: [your-email]
  Interested in: [your-interest]
  Sliding scale: [sliding-scale]

  [your-message]
  ```

Save. Copy the shortcode CF7 gives you, e.g. `[contact-form-7 id="123" title="Contact"]`.

## 3. Put it on the Contact page
Edit the Contact page (where you inserted the *Page — Contact* pattern):
1. In the right-hand form card, delete the static **Custom HTML** form.
2. Add a **Shortcode** block in its place and paste — **adding `html_class`**:
   ```
   [contact-form-7 id="123" html_class="wmat-form"]
   ```
   The `html_class="wmat-form"` is what makes CF7 inherit the theme's form styling.

That's it — submissions now email Amy, with the design intact.

## Notes
- For spam protection, add CF7's free **reCAPTCHA** or **Akismet** integration.
- Deliverability: if emails don't arrive, install an SMTP plugin (e.g. WP Mail
  SMTP) — shared hosts often block PHP `mail()`.
- Prefer a block-native form instead? Kadence Blocks or WPForms Lite both have a
  form block; tell me and I'll adapt the pattern.
