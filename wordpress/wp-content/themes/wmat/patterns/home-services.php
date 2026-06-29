<?php
/**
 * Title: Home — Services teaser
 * Slug: wmat/home-services
 * Categories: wmat
 * Description: Three service cards (Individual, Group, Workshops) on a sunken band.
 *
 * @package wmat
 */
?>
<!-- wp:group {"tagName":"section","align":"full","backgroundColor":"surface","style":{"spacing":{"padding":{"top":"clamp(48px,7vw,80px)","bottom":"clamp(48px,7vw,80px)"}}},"layout":{"type":"constrained","contentSize":"1080px"}} -->
<section class="wp-block-group alignfull has-surface-background-color has-background" style="padding-top:clamp(48px,7vw,80px);padding-bottom:clamp(48px,7vw,80px)"><!-- wp:group {"layout":{"type":"constrained","contentSize":"620px"},"style":{"spacing":{"margin":{"bottom":"40px"}}}} -->
<div class="wp-block-group" style="margin-bottom:40px"><!-- wp:paragraph {"align":"center","className":"wmat-eyebrow","textColor":"primary","style":{"spacing":{"margin":{"bottom":"10px"}}}} -->
<p class="has-text-align-center wmat-eyebrow has-primary-color has-text-color" style="margin-bottom:10px">Services</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"textAlign":"center","level":2} -->
<h2 class="wp-block-heading has-text-align-center">Ways we can work together</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","className":"wmat-lead","style":{"spacing":{"margin":{"top":"12px"}}}} -->
<p class="has-text-align-center wmat-lead" style="margin-top:12px">Choose the setting that fits — every option is available virtually or in person.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:html -->
<div class="wmat-grid wmat-grid-3" style="gap:20px">
	<div class="wmat-service-card">
		<span class="wmat-chip is-teal"><?php echo wmat_icon( 'user' ); ?></span>
		<h3>Individual Sessions</h3>
		<p class="wmat-blurb">One-on-one art therapy designed around your unique goals.</p>
		<ul class="wmat-features">
			<li><?php echo wmat_icon( 'check', 2.4 ); ?>45–60 minutes</li>
			<li><?php echo wmat_icon( 'check', 2.4 ); ?>Personalized materials</li>
		</ul>
		<div class="wmat-card-foot">
			<div class="wmat-price"><b>$100</b><span>/ session</span></div>
			<a class="wmat-btn is-outline" href="/services">Learn more <?php echo wmat_icon( 'arrow-right', 2.2 ); ?></a>
		</div>
	</div>
	<div class="wmat-service-card is-featured">
		<span class="wmat-popular">Most Popular</span>
		<span class="wmat-chip is-gold"><?php echo wmat_icon( 'users' ); ?></span>
		<h3>Group Sessions</h3>
		<p class="wmat-blurb">Collective creativity and shared healing in a small, supportive group.</p>
		<ul class="wmat-features">
			<li><?php echo wmat_icon( 'check', 2.4 ); ?>90 minutes</li>
			<li><?php echo wmat_icon( 'check', 2.4 ); ?>Themed &amp; structured</li>
		</ul>
		<div class="wmat-card-foot">
			<div class="wmat-price"><b>$150</b><span>/ session</span></div>
			<a class="wmat-btn is-primary" href="/services">Learn more <?php echo wmat_icon( 'arrow-right', 2.2 ); ?></a>
		</div>
	</div>
	<div class="wmat-service-card">
		<span class="wmat-chip is-sage"><?php echo wmat_icon( 'presentation' ); ?></span>
		<h3>Workshops</h3>
		<p class="wmat-blurb">Immersive art therapy experiences for teams and organizations.</p>
		<ul class="wmat-features">
			<li><?php echo wmat_icon( 'check', 2.4 ); ?>Single or multi-day</li>
			<li><?php echo wmat_icon( 'check', 2.4 ); ?>Fully customized</li>
		</ul>
		<div class="wmat-card-foot">
			<div class="wmat-price"><b>$200+</b><span>varies</span></div>
			<a class="wmat-btn is-outline" href="/services">Learn more <?php echo wmat_icon( 'arrow-right', 2.2 ); ?></a>
		</div>
	</div>
</div>
<!-- /wp:html --></section>
<!-- /wp:group -->
