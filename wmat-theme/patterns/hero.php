<?php
/**
 * Title: Hero (watercolor)
 * Slug: wmat/hero
 * Categories: wmat, featured
 * Description: Light watercolor hero — drifting washes behind an eyebrow, display headline, and calls to action.
 *
 * @package wmat
 */
?>
<!-- wp:group {"tagName":"section","className":"wmat-canvas","align":"full","backgroundColor":"base","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"}},"dimensions":{"minHeight":"80vh"}},"layout":{"type":"constrained","contentSize":"780px","justifyContent":"center"}} -->
<section class="wp-block-group alignfull wmat-canvas has-base-background-color has-background" style="min-height:80vh;padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)"><!-- wp:html -->
<div class="wmat-wash is-drift" style="width:46vw;height:46vw;left:-10vw;top:4vh;background:radial-gradient(circle at 40% 40%, var(--wp--preset--color--primary), transparent 68%);opacity:.30" aria-hidden="true"></div>
<div class="wmat-wash is-soft is-drift" style="width:40vw;height:40vw;left:34vw;top:-12vh;background:radial-gradient(circle, var(--wp--preset--color--secondary), transparent 70%);opacity:.32" aria-hidden="true"></div>
<div class="wmat-wash is-drift-rev" style="width:42vw;height:42vw;right:-12vw;bottom:-10vh;background:radial-gradient(circle, var(--wp--preset--color--accent), transparent 66%);opacity:.26" aria-hidden="true"></div>
<div class="wmat-wash is-tear is-drift-rev" style="width:22vw;height:22vw;right:14vw;top:6vh;background:radial-gradient(circle, var(--wp--preset--color--sage), transparent 70%);opacity:.30" aria-hidden="true"></div>
<!-- /wp:html -->

<!-- wp:paragraph {"align":"center","className":"wmat-eyebrow","textColor":"primary","style":{"spacing":{"margin":{"bottom":"var:preset|spacing|30"}}}} -->
<p class="has-text-align-center wmat-eyebrow has-primary-color has-text-color" style="margin-bottom:var(--wp--preset--spacing--30)">West Michigan Art Therapy</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"textAlign":"center","level":1,"style":{"typography":{"fontWeight":"500"}}} -->
<h1 class="wp-block-heading has-text-align-center" style="font-weight:500">Heal through creativity.</h1>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","className":"wmat-hand","textColor":"ochre","style":{"typography":{"fontSize":"clamp(1.75rem, 4vw, 2.75rem)"},"spacing":{"margin":{"top":"var:preset|spacing|20"}}}} -->
<p class="has-text-align-center wmat-hand has-ochre-color has-text-color" style="margin-top:var(--wp--preset--spacing--20);font-size:clamp(1.75rem, 4vw, 2.75rem)">where art meets wellness</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"align":"center","textColor":"muted","style":{"typography":{"fontSize":"clamp(1.0625rem, 1.8vw, 1.3rem)","lineHeight":"1.6"},"spacing":{"margin":{"top":"var:preset|spacing|40"}}}} -->
<p class="has-text-align-center has-muted-color has-text-color" style="margin-top:var(--wp--preset--spacing--40);font-size:clamp(1.0625rem, 1.8vw, 1.3rem);line-height:1.6">Board-certified art therapy for all ages on Michigan's art coast. A calm, person-centered space to explore, process, and transform your story through making art.</p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"},"style":{"spacing":{"margin":{"top":"var:preset|spacing|50"},"blockGap":"var:preset|spacing|30"}}} -->
<div class="wp-block-buttons" style="margin-top:var(--wp--preset--spacing--50)"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="#contact">Book a consultation</a></div>
<!-- /wp:button -->

<!-- wp:button {"className":"is-style-outline"} -->
<div class="wp-block-button is-style-outline"><a class="wp-block-button__link wp-element-button" href="#services">Explore services</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></section>
<!-- /wp:group -->
