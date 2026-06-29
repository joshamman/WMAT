<?php
/**
 * Title: Home hero (split)
 * Slug: wmat/hero
 * Categories: wmat, featured
 * Description: Split hero — rotating taglines, intro, CTAs on the left; lakeshore photo with hand accent on the right.
 *
 * @package wmat
 */
?>
<!-- wp:group {"align":"full","className":"wmat-hero-grid","style":{"spacing":{"padding":{"top":"0","bottom":"0"}}},"layout":{"type":"default"}} -->
<div class="wp-block-group alignfull wmat-hero-grid"><!-- wp:group {"style":{"spacing":{"padding":{"top":"clamp(40px,6vw,88px)","bottom":"clamp(40px,6vw,88px)","left":"clamp(24px,5vw,64px)","right":"clamp(24px,5vw,64px)"}}},"layout":{"type":"constrained","contentSize":"560px","justifyContent":"left"}} -->
<div class="wp-block-group" style="padding-top:clamp(40px,6vw,88px);padding-right:clamp(24px,5vw,64px);padding-bottom:clamp(40px,6vw,88px);padding-left:clamp(24px,5vw,64px)"><!-- wp:html -->
<span class="wmat-badge"><?php echo wmat_icon( 'map-pin', 2.2 ); ?>West Olive · Michigan's Art Coast</span>
<h1 class="wmat-tagline" data-taglines='["Heal Through Creativity","Transform Your Story with Art","Where Art Meets Wellness"]' style="font-family:var(--font-display);font-size:clamp(40px,6vw,72px);font-weight:600;line-height:1.02;letter-spacing:-0.025em;color:var(--ink-900);margin:22px 0 8px"><span class="wmat-tagline-text">Heal Through Creativity</span></h1>
<!-- /wp:html -->

<!-- wp:paragraph {"className":"wmat-lead","style":{"spacing":{"margin":{"top":"12px","bottom":"32px"}}}} -->
<p class="wmat-lead" style="margin-top:12px;margin-bottom:32px">Professional art therapy for individuals of all ages — a calm, person-centered space to explore, heal, and grow through creative expression.</p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"style":{"spacing":{"blockGap":"12px"}}} -->
<div class="wp-block-buttons"><!-- wp:button {"backgroundColor":"primary","textColor":"base"} -->
<div class="wp-block-button"><a class="wp-block-button__link has-base-color has-primary-background-color has-text-color has-background wp-element-button" href="/services">Explore Services</a></div>
<!-- /wp:button -->

<!-- wp:button {"className":"is-style-outline"} -->
<div class="wp-block-button is-style-outline"><a class="wp-block-button__link wp-element-button" href="/about">Meet Amy</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group -->

<!-- wp:html -->
<div class="wmat-hero-media">
	<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/lake_michigan_hoffmaster_beach.jpg' ); ?>" alt="Lake Michigan shoreline" loading="eager" />
	<span class="wmat-hero-hand">begin where you are</span>
</div>
<!-- /wp:html --></div>
<!-- /wp:group -->
