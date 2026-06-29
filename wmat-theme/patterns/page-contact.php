<?php
/**
 * Title: Page — Contact
 * Slug: wmat/page-contact
 * Categories: wmat, page
 * Description: Full Contact page — heading and contact details beside a styled inquiry form.
 *
 * @package wmat
 */
?>
<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"clamp(44px,6vw,80px)","bottom":"clamp(44px,6vw,80px)"}}},"layout":{"type":"constrained","contentSize":"1000px"}} -->
<section class="wp-block-group alignfull" style="padding-top:clamp(44px,6vw,80px);padding-bottom:clamp(44px,6vw,80px)"><!-- wp:html -->
<div class="wmat-split is-top" style="grid-template-columns:0.9fr 1.1fr">
	<div>
		<p class="wmat-eyebrow" style="color:var(--teal-600);margin:0 0 10px">Contact</p>
		<h1 style="margin:0;font-family:var(--font-display);font-size:clamp(2rem,4vw,2.875rem);font-weight:600;letter-spacing:-0.02em;line-height:1.12;color:var(--ink-900)">Let's begin a conversation</h1>
		<p class="wmat-lead" style="margin-top:14px">Ready to start, or just have questions? Send a note and Amy will respond promptly to talk through services, pricing, or logistics.</p>
		<div class="wmat-contact-rows" style="margin-top:28px">
			<div class="wmat-contact-row">
				<span class="wmat-chip is-sm is-teal"><?php echo wmat_icon( 'mail' ); ?></span>
				<div><div class="l">Email</div><div class="v"><a href="mailto:amy@westmichiganarttherapy.com" style="color:inherit;text-decoration:none">amy@westmichiganarttherapy.com</a></div></div>
			</div>
			<div class="wmat-contact-row">
				<span class="wmat-chip is-sm is-teal"><?php echo wmat_icon( 'map-pin' ); ?></span>
				<div><div class="l">Studio</div><div class="v">West Olive, Michigan</div></div>
			</div>
			<div class="wmat-contact-row">
				<span class="wmat-chip is-sm is-teal"><?php echo wmat_icon( 'clock' ); ?></span>
				<div><div class="l">Response</div><div class="v">All inquiries answered promptly</div></div>
			</div>
		</div>
	</div>

	<div class="wmat-form-card">
		<form class="wmat-form" action="mailto:amy@westmichiganarttherapy.com" method="post" enctype="text/plain">
			<div class="wmat-form-row">
				<div class="wmat-field"><label for="wmat-name">Your name</label><input id="wmat-name" name="Name" type="text" placeholder="First and last" required></div>
				<div class="wmat-field"><label for="wmat-email">Email</label><input id="wmat-email" name="Email" type="email" placeholder="you@email.com" required></div>
			</div>
			<div class="wmat-field">
				<label for="wmat-interest">I'm interested in…</label>
				<select id="wmat-interest" name="Interested in">
					<option value="" selected>Choose a service</option>
					<option>Individual Sessions</option>
					<option>Group Sessions</option>
					<option>Workshops</option>
					<option>Online Supervision</option>
					<option>Educational Presentations</option>
					<option>Not sure yet</option>
				</select>
			</div>
			<div class="wmat-field">
				<label for="wmat-message">Your message</label>
				<textarea id="wmat-message" name="Message" rows="4" maxlength="180" placeholder="Tell me a little about what you're looking for…"></textarea>
			</div>
			<label class="wmat-check"><input type="checkbox" name="Sliding scale" value="yes"> I'd like to hear about sliding-scale options</label>
			<button class="wmat-btn is-primary is-lg is-full" type="submit">Send Message <?php echo wmat_icon( 'send', 2.2 ); ?></button>
			<p style="font-family:var(--font-body);font-size:12px;color:var(--text-subtle);text-align:center;margin:0">Submitting opens your email app. Prefer to write directly? <a href="mailto:amy@westmichiganarttherapy.com">amy@westmichiganarttherapy.com</a></p>
		</form>
	</div>
</div>
<!-- /wp:html --></section>
<!-- /wp:group -->
