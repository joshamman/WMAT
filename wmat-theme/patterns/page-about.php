<?php
/**
 * Title: Page — About
 * Slug: wmat/page-about
 * Categories: wmat, page
 * Description: Full About page — Amy's bio with years badge, the approach values, and the region served.
 *
 * @package wmat
 */
?>
<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"clamp(44px,6vw,80px)","bottom":"clamp(44px,6vw,80px)"}}},"layout":{"type":"constrained","contentSize":"1000px"}} -->
<section class="wp-block-group alignfull" style="padding-top:clamp(44px,6vw,80px);padding-bottom:clamp(44px,6vw,80px)"><!-- wp:group {"className":"wmat-split is-4060","layout":{"type":"default"}} -->
<div class="wp-block-group wmat-split is-4060"><!-- wp:html -->
<div class="wmat-portrait">
	<div class="wmat-portrait-img">
		<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/portrait-placeholder.jpg' ); ?>" alt="Amy Rostollan-Hamman" />
	</div>
	<div class="wmat-years"><b>15+</b><span>years of practice</span></div>
</div>
<!-- /wp:html -->

<!-- wp:group {"layout":{"type":"constrained","justifyContent":"left"}} -->
<div class="wp-block-group"><!-- wp:html -->
<span class="wmat-badge">ATR-BC · Board-Certified Art Therapist</span>
<!-- /wp:html -->

<!-- wp:paragraph {"className":"wmat-eyebrow","textColor":"primary","style":{"spacing":{"margin":{"top":"18px","bottom":"10px"}}}} -->
<p class="wmat-eyebrow has-primary-color has-text-color" style="margin-top:18px;margin-bottom:10px">About</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":1} -->
<h1 class="wp-block-heading">Meet Amy Rostollan-Hamman</h1>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"wmat-lead","style":{"spacing":{"margin":{"top":"14px"}}}} -->
<p class="wmat-lead" style="margin-top:14px">Amy is a Board-Certified Art Therapist with over 15 years of experience helping individuals of all ages find healing through creative expression. With a warm, person-centered approach, she guides clients facing all kinds of challenges to discover the transformative power of art therapy in their own unique journeys.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"typography":{"lineHeight":"1.7"},"spacing":{"margin":{"top":"16px"}}},"textColor":"muted"} -->
<p class="has-muted-color has-text-color" style="margin-top:16px;line-height:1.7">She practices along Michigan's “art coast” — a region renowned for its creative spirit — and believes that healing and artistic expression belong side by side.</p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"style":{"spacing":{"margin":{"top":"26px"}}}} -->
<div class="wp-block-buttons" style="margin-top:26px"><!-- wp:button {"backgroundColor":"primary","textColor":"base"} -->
<div class="wp-block-button"><a class="wp-block-button__link has-base-color has-primary-background-color has-text-color has-background wp-element-button" href="/contact">Work with Amy</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></section>
<!-- /wp:group -->

<!-- wp:group {"tagName":"section","align":"full","backgroundColor":"surface","style":{"spacing":{"padding":{"top":"clamp(40px,6vw,72px)","bottom":"clamp(40px,6vw,72px)"}}},"layout":{"type":"constrained","contentSize":"1000px"}} -->
<section class="wp-block-group alignfull has-surface-background-color has-background" style="padding-top:clamp(40px,6vw,72px);padding-bottom:clamp(40px,6vw,72px)"><!-- wp:group {"layout":{"type":"constrained","contentSize":"620px"},"style":{"spacing":{"margin":{"bottom":"36px"}}}} -->
<div class="wp-block-group" style="margin-bottom:36px"><!-- wp:paragraph {"align":"center","className":"wmat-eyebrow","textColor":"primary","style":{"spacing":{"margin":{"bottom":"10px"}}}} -->
<p class="has-text-align-center wmat-eyebrow has-primary-color has-text-color" style="margin-bottom:10px">The approach</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"textAlign":"center","level":2} -->
<h2 class="wp-block-heading has-text-align-center">What guides our work together</h2>
<!-- /wp:heading --></div>
<!-- /wp:group -->

<!-- wp:html -->
<div class="wmat-grid wmat-grid-3" style="gap:20px">
	<div class="wmat-value-card">
		<span class="wmat-chip is-sage"><?php echo wmat_icon( 'heart-handshake' ); ?></span>
		<div class="wmat-card-title" style="font-size:19px;margin-top:14px">Person-centered</div>
		<p class="wmat-card-text" style="font-size:14px;color:var(--text-body)">You set the direction. Every session follows your goals, your comfort, and your pace.</p>
	</div>
	<div class="wmat-value-card">
		<span class="wmat-chip is-sage"><?php echo wmat_icon( 'shield-check' ); ?></span>
		<div class="wmat-card-title" style="font-size:19px;margin-top:14px">Safe &amp; confidential</div>
		<p class="wmat-card-text" style="font-size:14px;color:var(--text-body)">A grounded, non-judgmental space where it's okay to not have the words yet.</p>
	</div>
	<div class="wmat-value-card">
		<span class="wmat-chip is-sage"><?php echo wmat_icon( 'sprout' ); ?></span>
		<div class="wmat-card-title" style="font-size:19px;margin-top:14px">Strengths-based</div>
		<p class="wmat-card-text" style="font-size:14px;color:var(--text-body)">We build on what's already within you, using creativity as a path toward growth.</p>
	</div>
</div>
<!-- /wp:html --></section>
<!-- /wp:group -->

<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"clamp(44px,6vw,72px)","bottom":"clamp(44px,6vw,72px)"}}},"layout":{"type":"constrained","contentSize":"900px"}} -->
<section class="wp-block-group alignfull" style="padding-top:clamp(44px,6vw,72px);padding-bottom:clamp(44px,6vw,72px)"><!-- wp:paragraph {"align":"center","className":"wmat-eyebrow","textColor":"primary","style":{"spacing":{"margin":{"bottom":"10px"}}}} -->
<p class="has-text-align-center wmat-eyebrow has-primary-color has-text-color" style="margin-bottom:10px">Where we serve</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"textAlign":"center","level":2} -->
<h2 class="wp-block-heading has-text-align-center">Rooted on the lakeshore</h2>
<!-- /wp:heading -->

<!-- wp:html -->
<div class="wmat-pills" style="margin-top:22px">
	<span class="wmat-pill"><?php echo wmat_icon( 'map-pin', 2 ); ?>West Olive</span>
	<span class="wmat-pill"><?php echo wmat_icon( 'map-pin', 2 ); ?>Grand Rapids</span>
	<span class="wmat-pill"><?php echo wmat_icon( 'map-pin', 2 ); ?>Holland</span>
	<span class="wmat-pill"><?php echo wmat_icon( 'map-pin', 2 ); ?>Grand Haven</span>
	<span class="wmat-pill"><?php echo wmat_icon( 'map-pin', 2 ); ?>Saugatuck</span>
	<span class="wmat-pill"><?php echo wmat_icon( 'map-pin', 2 ); ?>Spring Lake</span>
</div>
<!-- /wp:html --></section>
<!-- /wp:group -->
