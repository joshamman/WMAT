<?php

    $wp_customize->register_section_type( 'Wpdevart_Premium_Features_List' );


	##################------ Premium Features Sections ------##################

	$wp_customize->add_section(
		new Wpdevart_Premium_Features_List(
			$wp_customize,
			'wpdevart_astrostar_theme_general_features',
			array(
				'title'         => esc_html__( 'Even More Options in the Premium Version!', 'astrostar' ),
                'upsell_link'  => apply_filters( 'parent_wpdevart_astrostar_premium_features_url', esc_url('https://wpdevart.com/astrostar-wordpress-astrology-theme')),
				'premium_features_list' => array(
					esc_html__( '+40 Other Popular Fonts', 'astrostar' ),
					esc_html__( 'Wide and Full-Width Layouts', 'astrostar' ),
					esc_html__( 'Preloader', 'astrostar' ),
                    esc_html__( 'Button Animation', 'astrostar' ),
                    esc_html__( '+6 Beautiful Patterns', 'astrostar' ),
					esc_html__( 'Customizable Search Overlay', 'astrostar' ),
					esc_html__( 'Back To Top Button', 'astrostar' ),
					esc_html__( '... and Other Premium Features', 'astrostar' ),
				),
				'panel'         => 'wpdevart_astrostar_general_settings_panel',
				'priority'      => 7777,
			)
		)
	);

	$wp_customize->add_section(
		new Wpdevart_Premium_Features_List(
			$wp_customize,
			'wpdevart_astrostar_theme_header_features',
			array(
				'title'         => esc_html__( 'Even More Options in the Premium Version!', 'astrostar' ),
                'upsell_link'  => apply_filters( 'parent_wpdevart_astrostar_premium_features_url', esc_url('https://wpdevart.com/astrostar-wordpress-astrology-theme')),
				'premium_features_list' => array(
					esc_html__( 'Sticky Header Feature', 'astrostar' ),
					esc_html__( 'Sticky Header Feature for Mobile', 'astrostar' ),
                    esc_html__( 'Logo Animations', 'astrostar' ),
					esc_html__( 'Search Button Animations', 'astrostar' ),
                    esc_html__( 'Woo Cart Animations', 'astrostar' ),
					esc_html__( 'Wide and Full-Width Layouts', 'astrostar' ),
					esc_html__( '... and Other Premium Features', 'astrostar' ),
				),
				'panel'         => 'wpdevart_astrostar_header_panel',
				'priority'      => 7777,
			)
		)
	);

	$wp_customize->add_section(
		new Wpdevart_Premium_Features_List(
			$wp_customize,
			'wpdevart_astrostar_theme_single_post_page_features',
			array(
				'title'         => esc_html__( 'Even More Options in the Premium Version!', 'astrostar' ),
                'upsell_link'  => apply_filters( 'parent_wpdevart_astrostar_premium_features_url', esc_url('https://wpdevart.com/astrostar-wordpress-astrology-theme')),
				'premium_features_list' => array(
					esc_html__( '+6 Beautiful Patterns', 'astrostar' ),
                    esc_html__( 'Post/Page Title Animations', 'astrostar' ),
					esc_html__( 'Post/Page Banner Animations', 'astrostar' ),
                    esc_html__( '4 Animated Banner Elements', 'astrostar' ),
					esc_html__( 'Animated Elements Colors', 'astrostar' ),
					esc_html__( 'Wide and Full-Width Layouts', 'astrostar' ),
					esc_html__( '... and Other Premium Features', 'astrostar' ),
				),
				'panel'         => 'wpdevart_astrostar_single_post_page_panel',
				'priority'      => 7777,
			)
		)
	);

	$wp_customize->add_section(
		new Wpdevart_Premium_Features_List(
			$wp_customize,
			'wpdevart_astrostar_theme_blog_archive_search_features',
			array(
				'title'         => esc_html__( 'Even More Options in the Premium Version!', 'astrostar' ),
                'upsell_link'  => apply_filters( 'parent_wpdevart_astrostar_premium_features_url', esc_url('https://wpdevart.com/astrostar-wordpress-astrology-theme')),
				'premium_features_list' => array(
					esc_html__( 'Images Hover Effects', 'astrostar' ),
					esc_html__( 'Archive/Search Page Title Animations', 'astrostar' ),
                    esc_html__( 'Archive/Search Page Banner Animations', 'astrostar' ),
					esc_html__( '4 Animated Elements', 'astrostar' ),
                    esc_html__( 'Animated Elements Colors', 'astrostar' ),
					esc_html__( 'Wide and Full-Width Layouts', 'astrostar' ),
					esc_html__( '... and Other Premium Features', 'astrostar' ),
				),
				'panel'         => 'wpdevart_astrostar_blog_archive_search_panel',
				'priority'      => 7777,
			)
		)
	);

    $wp_customize->add_section(
		new Wpdevart_Premium_Features_List(
			$wp_customize,
			'wpdevart_astrostar_theme_custom_homepage_features',
			array(
				'title'         => esc_html__( 'Even More Options in the Premium Version!', 'astrostar' ),
                'upsell_link'  => apply_filters( 'parent_wpdevart_astrostar_premium_features_url', esc_url('https://wpdevart.com/astrostar-wordpress-astrology-theme')),
				'premium_features_list' => array(
                    esc_html__( '+4 Beautiful Banner Themes', 'astrostar' ),
                    esc_html__( 'Homepage Sections Positions', 'astrostar' ),
					esc_html__( 'WooCommerce Section', 'astrostar' ),
					esc_html__( 'Sales Section', 'astrostar' ),
                    esc_html__( 'Benefits of Ordering Section', 'astrostar' ),
                    esc_html__( 'Shop by Brand Section', 'astrostar' ),
                    esc_html__( 'Shop by Category Section', 'astrostar' ),
					esc_html__( 'Achievements Section', 'astrostar' ),
					esc_html__( 'Advantages Section', 'astrostar' ),
					esc_html__( 'Services Section', 'astrostar' ),
					esc_html__( 'Sections Description Color', 'astrostar' ),
					esc_html__( 'Sections Title Lines Color', 'astrostar' ),
					esc_html__( 'Wide and Full-Width Layouts', 'astrostar' ),
					esc_html__( '... and Other Premium Features', 'astrostar' ),
				),
				'panel'         => 'wpdevart_astrostar_custom_homepage_panel',
				'priority'      => 7777,
			)
		)
	);

	$wp_customize->add_section(
		new Wpdevart_Premium_Features_List(
			$wp_customize,
			'wpdevart_astrostar_theme_woo_features',
			array(
				'title'         => esc_html__( 'Even More Options in the Premium Version!', 'astrostar' ),
                'upsell_link'  => apply_filters( 'parent_wpdevart_astrostar_premium_features_url', esc_url('https://wpdevart.com/astrostar-wordpress-astrology-theme')),
				'premium_features_list' => array(
                    esc_html__( 'WooCommerce Search Bar Section', 'astrostar' ),
                    esc_html__( 'Customizable Category List and Search Bar', 'astrostar' ),
					esc_html__( 'WooCommerce Shop/Category Structure', 'astrostar' ),
					esc_html__( 'WooCommerce Premium Sections', 'astrostar' ),
					esc_html__( 'WooCommerce Breadcrumbs', 'astrostar' ),
					esc_html__( 'WooCommerce Header Cart Design', 'astrostar' ),
                    esc_html__( 'WooCommerce Button Animation', 'astrostar' ),
					esc_html__( 'WooCommerce Sidebar Options', 'astrostar' ),
					esc_html__( 'Wide and Full-Width Layouts', 'astrostar' ),
					esc_html__( '... and Other Premium Features', 'astrostar' ),
				),
				'panel'         => 'wpdevart_astrostar_woocommerce_settings_panel',
				'priority'      => 7777,
			)
		)
	);
        
    ##################------ Premium Features Controls------##################

    $wp_customize->add_setting( 'wpdevart_astrostar_logo_settings_premium_features',
    array(
        'sanitize_callback' => 'wpdevart_astrostar_text_sanitization',
    )
    );
    $wp_customize->add_control( new Wpdevart_Premium_Features_Control_List( $wp_customize, 'wpdevart_astrostar_logo_settings_premium_features',
    array(
        'label' => esc_html__( 'More Features in the Premium Version!', 'astrostar' ),
        'section' => 'title_tagline',
        'priority' => 50,
        'choices' => array(
            'feature1' => array(
                'name' => esc_html__( 'Logo Animation', 'astrostar' )
            ),
            'feature2' => array(
                'name' => esc_html__( 'Text Logo Font-size', 'astrostar' )
            ),
            'feature3' => array(
                'name' => esc_html__( 'Text Logo Font Weight', 'astrostar' )
            ),
            'feature4' => array(
                'name' => esc_html__( 'Site Description Color', 'astrostar' )
            ),
            'feature5' => array(
                'name' => esc_html__( 'Site Description Font-size', 'astrostar' )
            ),
            'feature6' => array(
                'name' => esc_html__( '... and Other Premium Features', 'astrostar' )
            ),
        )
    )
    ) );

    $wp_customize->add_setting( 'wpdevart_astrostar_font_settings_premium_features',
    array(
        'sanitize_callback' => 'wpdevart_astrostar_text_sanitization'
    )
    );
    $wp_customize->add_control( new Wpdevart_Premium_Features_Control_List( $wp_customize, 'wpdevart_astrostar_font_settings_premium_features',
    array(
        'label' => esc_html__( 'More Features in the Premium Version!', 'astrostar' ),
        'section' => 'wpdevart_astrostar_fonts_section',
        'priority' => 777,
        'choices' => array(
            'feature1' => array(
                'name' => esc_html__( '+40 Other Popular Fonts', 'astrostar' )
            ),
            'feature2' => array(
                'name' => esc_html__( '... and Other Premium Features', 'astrostar' )
            ),
        )
    )
    ) );

    $wp_customize->add_setting( 'wpdevart_astrostar_primary_button_settings_premium_features',
    array(
        'sanitize_callback' => 'wpdevart_astrostar_text_sanitization'
    )
    );
    $wp_customize->add_control( new Wpdevart_Premium_Features_Control_List( $wp_customize, 'wpdevart_astrostar_primary_button_settings_premium_features',
    array(
        'label' => esc_html__( 'More Features in the Premium Version!', 'astrostar' ),
        'section' => 'wpdevart_astrostar_primary_button_settings',
        'priority' => 777,
        'choices' => array(
            'feature1' => array(
                'name' => esc_html__( 'Button Animation', 'astrostar' )
            ),
            'feature2' => array(
                'name' => esc_html__( '... and Other Premium Features', 'astrostar' )
            ),
        )
    )
    ) );

    $wp_customize->add_setting( 'wpdevart_astrostar_header_general_settings_premium_features',
    array(
        'sanitize_callback' => 'wpdevart_astrostar_text_sanitization'
    )
    );
    $wp_customize->add_control( new Wpdevart_Premium_Features_Control_List( $wp_customize, 'wpdevart_astrostar_header_general_settings_premium_features',
    array(
        'label' => esc_html__( 'More Features in the Premium Version!', 'astrostar' ),
        'section' => 'wpdevart_astrostar_header_section',
        'priority' => 777,
        'choices' => array(
            'feature1' => array(
                'name' => esc_html__( 'Sticky Header Feature', 'astrostar' )
            ),
            'feature2' => array(
                'name' => esc_html__( 'Sticky Header Feature for Mobile', 'astrostar' )
            ),
            'feature3' => array(
                'name' => esc_html__( 'Animations for Header Elements', 'astrostar' )
            ),
            'feature4' => array(
                'name' => esc_html__( '... and Other Premium Features', 'astrostar' )
            ),
        )
    )
    ) );

    $wp_customize->add_setting( 'wpdevart_astrostar_top_header_settings_premium_features',
    array(
        'sanitize_callback' => 'wpdevart_astrostar_text_sanitization'
    )
    );
    $wp_customize->add_control( new Wpdevart_Premium_Features_Control_List( $wp_customize, 'wpdevart_astrostar_top_header_settings_premium_features',
    array(
        'label' => esc_html__( 'More Features in the Premium Version!', 'astrostar' ),
        'section' => 'wpdevart_astrostar_top_header_section',
        'priority' => 777,
        'choices' => array(
            'feature1' => array(
                'name' => esc_html__( 'Address Section', 'astrostar' )
            ),
            'feature2' => array(
                'name' => esc_html__( 'Phone/Email/Address Icon Color', 'astrostar' )
            ),
            'feature3' => array(
                'name' => esc_html__( 'Animations for Top Header Elements', 'astrostar' )
            ),
            'feature4' => array(
                'name' => esc_html__( '... and Other Premium Features', 'astrostar' )
            ),
        )
    )
    ) );
    
    $wp_customize->add_setting( 'wpdevart_astrostar_header_menu_search_settings_premium_features',
    array(
        'sanitize_callback' => 'wpdevart_astrostar_text_sanitization'
    )
    );
    $wp_customize->add_control( new Wpdevart_Premium_Features_Control_List( $wp_customize, 'wpdevart_astrostar_header_menu_search_settings_premium_features',
    array(
        'label' => esc_html__( 'More Features in the Premium Version!', 'astrostar' ),
        'section' => 'wpdevart_astrostar_header_menu_search_section',
        'priority' => 777,
        'choices' => array(
            'feature1' => array(
                'name' => esc_html__( 'Search Button Animations', 'astrostar' )
            ),
            'feature2' => array(
                'name' => esc_html__( '... and Other Premium Features', 'astrostar' )
            ),
        )
    )
    ) );

	if ( class_exists( 'WooCommerce' ) ) {
    $wp_customize->add_setting( 'wpdevart_astrostar_woo_primary_button_settings_premium_features',
    array(
        'sanitize_callback' => 'wpdevart_astrostar_text_sanitization'
    )
    );
    $wp_customize->add_control( new Wpdevart_Premium_Features_Control_List( $wp_customize, 'wpdevart_astrostar_woo_primary_button_settings_premium_features',
    array(
        'label' => esc_html__( 'More Features in the Premium Version!', 'astrostar' ),
        'section' => 'woocommerce_primary_button_colors_section',
        'priority' => 777,
        'choices' => array(
            'feature1' => array(
                'name' => esc_html__( 'WooCommerce Button Animation', 'astrostar' )
            ),
            'feature2' => array(
                'name' => esc_html__( '... and Other Premium Features', 'astrostar' )
            ),
        )
    )
    ) );
    };

    $wp_customize->add_setting( 'wpdevart_astrostar_single_post_settings_premium_features',
    array(
        'sanitize_callback' => 'wpdevart_astrostar_text_sanitization'
    )
    );
    $wp_customize->add_control( new Wpdevart_Premium_Features_Control_List( $wp_customize, 'wpdevart_astrostar_single_post_settings_premium_features',
    array(
        'label' => esc_html__( 'More Features in the Premium Version!', 'astrostar' ),
        'section' => 'wpdevart_astrostar_single_post_section',
        'priority' => 777,
        'choices' => array(
            'feature1' => array(
                'name' => esc_html__( '+6 Beautiful Patterns', 'astrostar' )
            ),
            'feature2' => array(
                'name' => esc_html__( 'Title Animations', 'astrostar' )
            ),
            'feature3' => array(
                'name' => esc_html__( 'Banner Animations', 'astrostar' )
            ),
            'feature4' => array(
                'name' => esc_html__( '4 Animated Elements', 'astrostar' )
            ),
            'feature5' => array(
                'name' => esc_html__( 'Animated Elements Colors', 'astrostar' )
            ),
            'feature6' => array(
                'name' => esc_html__( '... and Other Premium Features', 'astrostar' )
            ),
        )
    )
    ) );
    $wp_customize->add_setting( 'wpdevart_astrostar_single_page_settings_premium_features',
    array(
        'sanitize_callback' => 'wpdevart_astrostar_text_sanitization'
    )
    );
    $wp_customize->add_control( new Wpdevart_Premium_Features_Control_List( $wp_customize, 'wpdevart_astrostar_single_page_settings_premium_features',
    array(
        'label' => esc_html__( 'More Features in the Premium Version!', 'astrostar' ),
        'section' => 'wpdevart_astrostar_single_page_section',
        'priority' => 777,
        'choices' => array(
            'feature1' => array(
                'name' => esc_html__( '+6 Beautiful Patterns', 'astrostar' )
            ),
            'feature2' => array(
                'name' => esc_html__( 'Title Animations', 'astrostar' )
            ),
            'feature3' => array(
                'name' => esc_html__( 'Banner Animations', 'astrostar' )
            ),
            'feature4' => array(
                'name' => esc_html__( '4 Animated Elements', 'astrostar' )
            ),
            'feature5' => array(
                'name' => esc_html__( 'Animated Elements Colors', 'astrostar' )
            ),
            'feature6' => array(
                'name' => esc_html__( '... and Other Premium Features', 'astrostar' )
            ),
        )
    )
    ) );

    $wp_customize->add_setting( 'wpdevart_astrostar_blog_archive_page_settings_premium_features',
    array(
        'sanitize_callback' => 'wpdevart_astrostar_text_sanitization'
    )
    );
    $wp_customize->add_control( new Wpdevart_Premium_Features_Control_List( $wp_customize, 'wpdevart_astrostar_blog_archive_page_settings_premium_features',
    array(
        'label' => esc_html__( 'More Features in the Premium Version!', 'astrostar' ),
        'section' => 'wpdevart_astrostar_blog_section',
        'priority' => 777,
        'choices' => array(
            'feature1' => array(
                'name' => esc_html__( 'Title Animations', 'astrostar' )
            ),
            'feature2' => array(
                'name' => esc_html__( 'Banner Animations', 'astrostar' )
            ),
            'feature3' => array(
                'name' => esc_html__( '4 Animated Elements', 'astrostar' )
            ),
            'feature4' => array(
                'name' => esc_html__( 'Animated Elements Colors', 'astrostar' )
            ),
            'feature5' => array(
                'name' => esc_html__( '... and Other Premium Features', 'astrostar' )
            ),
        )
    )
    ) );
    $wp_customize->add_setting( 'wpdevart_astrostar_search_page_settings_premium_features',
    array(
        'sanitize_callback' => 'wpdevart_astrostar_text_sanitization'
    )
    );
    $wp_customize->add_control( new Wpdevart_Premium_Features_Control_List( $wp_customize, 'wpdevart_astrostar_search_page_settings_premium_features',
    array(
        'label' => esc_html__( 'More Features in the Premium Version!', 'astrostar' ),
        'section' => 'wpdevart_astrostar_search_page_section',
        'priority' => 777,
        'choices' => array(
            'feature1' => array(
                'name' => esc_html__( 'Title Animations', 'astrostar' )
            ),
            'feature2' => array(
                'name' => esc_html__( 'Banner Animations', 'astrostar' )
            ),
            'feature3' => array(
                'name' => esc_html__( '4 Animated Elements', 'astrostar' )
            ),
            'feature4' => array(
                'name' => esc_html__( 'Animated Elements Colors', 'astrostar' )
            ),
            'feature5' => array(
                'name' => esc_html__( '... and Other Premium Features', 'astrostar' )
            ),
        )
    )
    ) );
    $wp_customize->add_setting( 'wpdevart_astrostar_blog_settings_premium_features',
    array(
        'sanitize_callback' => 'wpdevart_astrostar_text_sanitization'
    )
    );
    $wp_customize->add_control( new Wpdevart_Premium_Features_Control_List( $wp_customize, 'wpdevart_astrostar_blog_settings_premium_features',
    array(
        'label' => esc_html__( 'More Features in the Premium Version!', 'astrostar' ),
        'section' => 'wpdevart_astrostar_blog_archive_search_general_section',
        'priority' => 777,
        'choices' => array(
            'feature1' => array(
                'name' => esc_html__( 'Images Hover Effects', 'astrostar' )
            ),
            'feature2' => array(
                'name' => esc_html__( 'Ordering of Metas', 'astrostar' )
            ),
            'feature3' => array(
                'name' => esc_html__( '... and Other Premium Features', 'astrostar' )
            ),
        )
    )
    ) );
    $wp_customize->add_setting( 'wpdevart_astrostar_custom_homepage_banner_premium_features',
    array(
        'sanitize_callback' => 'wpdevart_astrostar_text_sanitization'
    )
    );
    $wp_customize->add_control( new Wpdevart_Premium_Features_Control_List( $wp_customize, 'wpdevart_astrostar_custom_homepage_banner_premium_features',
    array(
        'label' => esc_html__( 'More Features in the Premium Version!', 'astrostar' ),
        'section' => 'wpdevart_astrostar_custom_homepage_banner_section',
        'priority' => 777,
        'choices' => array(
            'feature1' => array(
                'name' => esc_html__( '+4 Beautiful Banner Themes', 'astrostar' )
            ),
            'feature2' => array(
                'name' => esc_html__( '... and Other Premium Features', 'astrostar' )
            ),
        )
    )
    ) );
    $wp_customize->add_setting( 'wpdevart_astrostar_custom_homepage_general_premium_features',
    array(
        'sanitize_callback' => 'wpdevart_astrostar_text_sanitization'
    )
    );
    $wp_customize->add_control( new Wpdevart_Premium_Features_Control_List( $wp_customize, 'wpdevart_astrostar_custom_homepage_general_premium_features',
    array(
        'label' => esc_html__( 'More Features in the Premium Version!', 'astrostar' ),
        'section' => 'wpdevart_astrostar_custom_homepage_general_section',
        'priority' => 777,
        'choices' => array(
            'feature1' => array(
                'name' => esc_html__( 'Ordering of Sections', 'astrostar' )
            ),
            'feature2' => array(
                'name' => esc_html__( 'Sections Description Color', 'astrostar' )
            ),
            'feature3' => array(
                'name' => esc_html__( 'Sections Title Lines Color', 'astrostar' )
            ),
            'feature4' => array(
                'name' => esc_html__( '... and Other Premium Features', 'astrostar' )
            ),
        )
    )
    ) );
    $wp_customize->add_setting( 'wpdevart_astrostar_footer_premium_features',
    array(
        'sanitize_callback' => 'wpdevart_astrostar_text_sanitization'
    )
    );
    $wp_customize->add_control( new Wpdevart_Premium_Features_Control_List( $wp_customize, 'wpdevart_astrostar_footer_premium_features',
    array(
        'label' => esc_html__( 'More Features in the Premium Version!', 'astrostar' ),
        'section' => 'wpdevart_astrostar_footer_section',
        'priority' => 777,
        'choices' => array(
            'feature1' => array(
                'name' => esc_html__( '+4 Beautiful Footer Themes', 'astrostar' )
            ),
            'feature2' => array(
                'name' => esc_html__( 'Copyright Section Image', 'astrostar' )
            ),
            'feature3' => array(
                'name' => esc_html__( '... and Other Premium Features', 'astrostar' )
            ),
        )
    )
    ) );