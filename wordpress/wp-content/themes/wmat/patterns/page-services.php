<?php
/**
 * Title: Page — Services
 * Slug: wmat/page-services
 * Categories: wmat, page
 * Description: Full Services page — five offerings with pricing, a help card, payment callouts, and an FAQ.
 *
 * @package wmat
 */
?>
<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"clamp(44px,6vw,76px)","bottom":"24px"}}},"layout":{"type":"constrained","contentSize":"760px"}} -->
<section class="wp-block-group alignfull" style="padding-top:clamp(44px,6vw,76px);padding-bottom:24px"><!-- wp:paragraph {"align":"center","className":"wmat-eyebrow","textColor":"primary","style":{"spacing":{"margin":{"bottom":"10px"}}}} -->
<p class="has-text-align-center wmat-eyebrow has-primary-color has-text-color" style="margin-bottom:10px">Services</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"textAlign":"center","level":1} -->
<h1 class="wp-block-heading has-text-align-center">Art therapy on the West Michigan coast</h1>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","className":"wmat-lead","style":{"spacing":{"margin":{"top":"14px"}}}} -->
<p class="has-text-align-center wmat-lead" style="margin-top:14px">Every option below is offered virtually or in person, and shaped around what you need. Reach out any time to talk through the right fit.</p>
<!-- /wp:paragraph --></section>
<!-- /wp:group -->

<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"12px","bottom":"clamp(40px,6vw,72px)"}}},"layout":{"type":"constrained","contentSize":"1080px"}} -->
<section class="wp-block-group alignfull" style="padding-top:12px;padding-bottom:clamp(40px,6vw,72px)"><!-- wp:html -->
<div class="wmat-grid wmat-grid-auto" style="gap:20px">
	<div class="wmat-service-card">
		<span class="wmat-chip is-teal"><?php echo wmat_icon( 'user' ); ?></span>
		<h3>Individual Sessions</h3>
		<p class="wmat-blurb">Transform your journey through one-on-one art therapy, available virtually and in-person. A safe space for exploration and growth.</p>
		<ul class="wmat-features">
			<li><?php echo wmat_icon( 'check', 2.4 ); ?>45–60 minute sessions</li>
			<li><?php echo wmat_icon( 'check', 2.4 ); ?>Personalized approach &amp; materials</li>
			<li><?php echo wmat_icon( 'check', 2.4 ); ?>Flexible scheduling options</li>
		</ul>
		<div class="wmat-card-foot">
			<div class="wmat-price"><b>$100</b><span>per session</span></div>
			<a class="wmat-btn is-outline" href="/contact">Inquire <?php echo wmat_icon( 'arrow-right', 2.2 ); ?></a>
		</div>
	</div>
	<div class="wmat-service-card is-featured">
		<span class="wmat-popular">Most Popular</span>
		<span class="wmat-chip is-gold"><?php echo wmat_icon( 'users' ); ?></span>
		<h3>Group Sessions</h3>
		<p class="wmat-blurb">Experience the power of collective creativity and shared healing — themed for stress, grief support, or personal growth.</p>
		<ul class="wmat-features">
			<li><?php echo wmat_icon( 'check', 2.4 ); ?>90-minute sessions</li>
			<li><?php echo wmat_icon( 'check', 2.4 ); ?>Small group settings</li>
			<li><?php echo wmat_icon( 'check', 2.4 ); ?>Structured creative activities</li>
		</ul>
		<div class="wmat-card-foot">
			<div class="wmat-price"><b>$150</b><span>per session</span></div>
			<a class="wmat-btn is-primary" href="/contact">Inquire <?php echo wmat_icon( 'arrow-right', 2.2 ); ?></a>
		</div>
	</div>
	<div class="wmat-service-card">
		<span class="wmat-chip is-sage"><?php echo wmat_icon( 'presentation' ); ?></span>
		<h3>Workshops</h3>
		<p class="wmat-blurb">Immersive experiences for organizations, teams, or special interest groups exploring art therapy techniques in depth.</p>
		<ul class="wmat-features">
			<li><?php echo wmat_icon( 'check', 2.4 ); ?>Team-building opportunities</li>
			<li><?php echo wmat_icon( 'check', 2.4 ); ?>Comprehensive programming</li>
			<li><?php echo wmat_icon( 'check', 2.4 ); ?>Customized to group needs</li>
		</ul>
		<div class="wmat-card-foot">
			<div class="wmat-price"><b>$200–350</b><span>varies</span></div>
			<a class="wmat-btn is-outline" href="/contact">Inquire <?php echo wmat_icon( 'arrow-right', 2.2 ); ?></a>
		</div>
	</div>
	<div class="wmat-service-card">
		<span class="wmat-chip is-sky"><?php echo wmat_icon( 'graduation-cap' ); ?></span>
		<h3>Online Supervision</h3>
		<p class="wmat-blurb">Supporting the next generation of art therapists with professional supervision toward ATR credentials.</p>
		<ul class="wmat-features">
			<li><?php echo wmat_icon( 'check', 2.4 ); ?>Online or within 15 mi of West Olive</li>
			<li><?php echo wmat_icon( 'check', 2.4 ); ?>Professional development</li>
			<li><?php echo wmat_icon( 'check', 2.4 ); ?>Clinical case consultation</li>
		</ul>
		<div class="wmat-card-foot">
			<div class="wmat-price"><b>$75</b><span>per hour</span></div>
			<a class="wmat-btn is-outline" href="/contact">Inquire <?php echo wmat_icon( 'arrow-right', 2.2 ); ?></a>
		</div>
	</div>
	<div class="wmat-service-card">
		<span class="wmat-chip is-clay"><?php echo wmat_icon( 'mic' ); ?></span>
		<h3>Educational Presentations</h3>
		<p class="wmat-blurb">Informative sessions helping organizations understand the benefits and applications of art therapy.</p>
		<ul class="wmat-features">
			<li><?php echo wmat_icon( 'check', 2.4 ); ?>Customized content</li>
			<li><?php echo wmat_icon( 'check', 2.4 ); ?>Evidence-based information</li>
			<li><?php echo wmat_icon( 'check', 2.4 ); ?>Interactive components</li>
		</ul>
		<div class="wmat-card-foot">
			<div class="wmat-price"><b>$150–200</b></div>
			<a class="wmat-btn is-outline" href="/contact">Inquire <?php echo wmat_icon( 'arrow-right', 2.2 ); ?></a>
		</div>
	</div>
	<div class="wmat-help-card">
		<span class="wmat-chip" style="background:var(--gold-300);color:var(--ink-900);width:48px;height:48px;font-size:24px"><?php echo wmat_icon( 'sparkles' ); ?></span>
		<div class="wmat-card-title" style="font-size:20px">Not sure where to start?</div>
		<p class="wmat-card-text" style="font-size:14px;color:var(--text-body)">That's completely normal. Send a note and we'll find the right kind of session together.</p>
		<a class="wmat-btn is-primary" href="/contact" style="align-self:flex-start">Contact Amy</a>
	</div>
</div>
<!-- /wp:html --></section>
<!-- /wp:group -->

<!-- wp:group {"tagName":"section","align":"full","backgroundColor":"surface","style":{"spacing":{"padding":{"top":"clamp(40px,6vw,72px)","bottom":"clamp(40px,6vw,72px)"}}},"layout":{"type":"constrained","contentSize":"1000px"}} -->
<section class="wp-block-group alignfull has-surface-background-color has-background" style="padding-top:clamp(40px,6vw,72px);padding-bottom:clamp(40px,6vw,72px)"><!-- wp:html -->
<div class="wmat-split is-top" style="grid-template-columns:1fr 1.2fr">
	<div style="display:flex;flex-direction:column;gap:16px">
		<div>
			<p class="wmat-eyebrow" style="color:var(--teal-600);margin:0 0 8px">Payment</p>
			<h2 style="margin:0;font-family:var(--font-display);font-size:clamp(1.5rem,3vw,2rem);font-weight:600;color:var(--ink-900)">Simple &amp; flexible</h2>
		</div>
		<div class="wmat-callout is-note">
			<?php echo wmat_icon( 'sparkles' ); ?>
			<div><span class="wmat-callout-title">Sliding scale available</span><span class="wmat-callout-body">Flexible pricing is offered for individual sessions — just ask.</span></div>
		</div>
		<div class="wmat-callout is-info">
			<?php echo wmat_icon( 'info' ); ?>
			<div><span class="wmat-callout-title">Payment methods</span><span class="wmat-callout-body">Cash, check, and PayPal are welcome. Insurance is not currently accepted.</span></div>
		</div>
		<p style="font-family:var(--font-body);font-size:13px;line-height:1.6;color:var(--text-muted);margin:0">Location and material requirements may affect final pricing. Reach out with any questions about fees or arrangements.</p>
	</div>
	<div style="display:flex;flex-direction:column;gap:16px">
		<div>
			<p class="wmat-eyebrow" style="color:var(--teal-600);margin:0 0 8px">Good to know</p>
			<h2 style="margin:0;font-family:var(--font-display);font-size:clamp(1.5rem,3vw,2rem);font-weight:600;color:var(--ink-900)">Common questions</h2>
		</div>
		<div class="wmat-faq">
			<details open>
				<summary>Do I need to be "good at art"?</summary>
				<div class="wmat-faq-body">Not at all. Art therapy is about the process of making, not the finished piece. No experience is needed — only a willingness to show up.</div>
			</details>
			<details>
				<summary>Are sessions virtual or in person?</summary>
				<div class="wmat-faq-body">Both are available. We'll choose whatever feels most comfortable and effective for you, and can switch as needed.</div>
			</details>
			<details>
				<summary>What happens in a first session?</summary>
				<div class="wmat-faq-body">We talk about what brought you in, get comfortable with the materials, and begin gently. There's no pressure to create anything in particular.</div>
			</details>
			<details>
				<summary>Who do you work with?</summary>
				<div class="wmat-faq-body">Individuals of all ages — children, teens, and adults — as well as groups and organizations across the greater Grand Rapids, Holland, and Grand Haven areas.</div>
			</details>
		</div>
	</div>
</div>
<!-- /wp:html --></section>
<!-- /wp:group -->
