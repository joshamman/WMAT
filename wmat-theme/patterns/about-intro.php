<?php
/**
 * Title: About intro
 * Slug: wmat/about-intro
 * Categories: wmat
 * Description: Two-column introduction to Amy with portrait and credentials.
 *
 * @package wmat
 */
?>
<!-- wp:group {"tagName":"section","metadata":{"name":"About"},"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|60"}}},"layout":{"type":"constrained","wideSize":"1180px"}} -->
<section class="wp-block-group alignfull" id="about" style="padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--60)"><!-- wp:columns {"align":"wide","verticalAlignment":"center","style":{"spacing":{"blockGap":{"left":"var:preset|spacing|60"}}}} -->
<div class="wp-block-columns alignwide are-vertically-aligned-center"><!-- wp:column {"verticalAlignment":"center","width":"42%"} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:42%"><!-- wp:image {"sizeSlug":"large","style":{"border":{"radius":"20px"}}} -->
<figure class="wp-block-image size-large has-custom-border"><img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/lake_michigan_hoffmaster_beach.jpg' ); ?>" alt="Lake Michigan shoreline at Hoffmaster" style="border-radius:20px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center","width":"58%"} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:58%"><!-- wp:paragraph {"textColor":"primary","style":{"typography":{"fontWeight":"700","letterSpacing":"0.1em","textTransform":"uppercase"}},"fontSize":"small"} -->
<p class="has-primary-color has-text-color has-small-font-size" style="font-weight:700;letter-spacing:0.1em;text-transform:uppercase">Meet your therapist</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2 class="wp-block-heading">Amy Rostollan-Hamman, ATR-BC</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"textColor":"muted","style":{"typography":{"fontSize":"clamp(1.0625rem, 1.6vw, 1.25rem)","lineHeight":"1.7"}}} -->
<p class="has-muted-color has-text-color" style="font-size:clamp(1.0625rem, 1.6vw, 1.25rem);line-height:1.7">Amy is a board-certified art therapist with over 15 years of clinical experience. She believes the creative process itself is healing — that the things we can't always say in words can be made, seen, and understood through art.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"textColor":"muted"} -->
<p class="has-muted-color has-text-color">Working from Michigan's art coast, she offers a warm, person-centered space for clients of all ages and all artistic abilities.</p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"style":{"spacing":{"margin":{"top":"var:preset|spacing|40"}}}} -->
<div class="wp-block-buttons" style="margin-top:var(--wp--preset--spacing--40)"><!-- wp:button {"className":"is-style-outline"} -->
<div class="wp-block-button is-style-outline"><a class="wp-block-button__link wp-element-button" href="/about">Read Amy's story</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></section>
<!-- /wp:group -->
