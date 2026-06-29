<?php get_header(); if ( class_exists( 'WooCommerce' ) ) { ?>
    <div class="wpdevart-woo-container">
        <?php if ( is_shop() || is_product_category() || is_product_tag() ) { ?>
						
			<div class="<?php if (empty(get_theme_mod( 'wpdevart_astrostar_shop_cat_page_banner_gradient_color' ))) 
				{ echo esc_attr( 'wpdevart-woo-banner__bg' ); } 
					else { echo esc_attr('wpdevart-woo-banner__bg-gradient'); } ?>">
				<div class="wpdevart-container-woo-title">
					<div class="wpdevart-woo-title-breadcrumb"> <?php
						if ( is_shop() ) { ?><h1><?php $title = get_the_title( get_option( 'woocommerce_shop_page_id' ) ); echo esc_html($title); ?></h1><?php }
						if ( is_product_category() || is_product_tag()) { ?><h1><?php single_term_title(); ?></h1><?php }; ?>
					</div>
				</div>
			</div>
			
			<?php if ((get_theme_mod( 'wpdevart_astrostar_hide_woo_by_category_section_shop' ) == '1') && (is_shop())) {
					get_template_part( 'template-parts/partials/woo/wpdevart-woo-shop-by-category' );
				};
				if ((get_theme_mod( 'wpdevart_astrostar_hide_woo_by_category_section_category' ) == '1') && ( is_product_category() || is_product_tag())) {
					get_template_part( 'template-parts/partials/woo/wpdevart-woo-shop-by-category' );
			}; ?>
			
			<div class="wpdevart-main-woo-container <?php if (( get_theme_mod( 'wpdevart_astrostar_woocommerce_shop_category_layout' ) != 'sidebarnone' ) && ( get_theme_mod( 'wpdevart_astrostar_woocommerce_shop_category_layout' ) == 'sidebarleft' ))
													{ echo esc_attr('wpdevart-woo-container-with-sidebar wpdevart-woo-main-content-sidebarleft'); } 
														else if (( get_theme_mod( 'wpdevart_astrostar_woocommerce_shop_category_layout' ) != 'sidebarnone' ) && ( get_theme_mod( 'wpdevart_astrostar_woocommerce_shop_category_layout' ) != 'sidebarleft' )) 
															{ echo esc_attr('wpdevart-woo-container-with-sidebar'); } 
																?> wpdevart-woo-main-content" id="content_navigator">
				<div role="main" class="<?php  if ( get_theme_mod( 'wpdevart_astrostar_woocommerce_shop_category_layout' ) == 'sidebarnone' ) { echo esc_attr('wpdevart-woo-product-list-full-width'); } else { echo esc_attr('wpdevart-woo-product-list-with-sidebar'); } ?>">
					<div class="wpdevart-woocommerce">
						<?php if ( !empty(woocommerce_content()) ) { woocommerce_content(); } ?>
					</div>
				</div>
					<?php  if   ( get_theme_mod( 'wpdevart_astrostar_woocommerce_shop_category_layout' ) != 'sidebarnone' )
									{ get_template_part( 'template-parts/sidebar/sidebar-woo-wpdevart' ); } ?>
			</div>

		<?php } ?>
		
        <?php if ( is_product() ) { ?>
            <div class="wpdevart-main-woo-container <?php if (( get_theme_mod( 'wpdevart_astrostar_woocommerce_product_pages_layout' ) != 'sidebarnone' ) && ( get_theme_mod( 'wpdevart_astrostar_woocommerce_product_pages_layout' ) == 'sidebarleft' ))
                                                    { echo esc_attr('wpdevart-woo-container-with-sidebar wpdevart-woo-main-content-sidebarleft'); } 
                                                        else if (( get_theme_mod( 'wpdevart_astrostar_woocommerce_product_pages_layout' ) != 'sidebarnone' ) && ( get_theme_mod( 'wpdevart_astrostar_woocommerce_product_pages_layout' ) != 'sidebarleft' )) 
                                                            { echo esc_attr('wpdevart-woo-container-with-sidebar'); } 
                                                                ?> wpdevart-woo-main-content" id="content_navigator">
                <div role="main" class="<?php  if ( get_theme_mod( 'wpdevart_astrostar_woocommerce_product_pages_layout' ) == 'sidebarnone' ) { echo esc_attr('wpdevart-woo-product-list-full-width'); } else { echo esc_attr('wpdevart-woo-product-list-with-sidebar'); } ?>">
                    <div class="wpdevart-woocommerce">
						<?php if ( !empty(woocommerce_content()) ) { woocommerce_content(); } ?>
                    </div>
                </div>
                    <?php  if   ( get_theme_mod( 'wpdevart_astrostar_woocommerce_product_pages_layout' ) != 'sidebarnone' )
                                    { get_template_part( 'template-parts/sidebar/sidebar-woo-wpdevart' ); } ?>
            </div>
        <?php } ?>

    </div>
<?php } get_footer(); ?>