<?php 
	$wp_customize->add_panel( 'wpdevart_astrostar_blog_archive_search_panel', 
	array(
		'title'	=> esc_html__('Blog/Archive/Search','astrostar'),			
		'description'	=> esc_html__('Blog/Archive/Search pages settings','astrostar'),		
		'priority'		=> 27
	) 
	);

	##################------ Blog/Archive Page ------##################

	$wp_customize->add_section('wpdevart_astrostar_blog_section',array(
		'title'	=> esc_html__('Blog/Archive Page','astrostar'),
		'priority'		=> null,
		'panel'         => 'wpdevart_astrostar_blog_archive_search_panel'
	));
	$wp_customize->add_setting('wpdevart_astrostar_archive_banner_width',array(
		'default'	=> esc_html('narrow'),
		'sanitize_callback'	=> 'wpdevart_astrostar_text_sanitization'	
	));
	$wp_customize->add_control('wpdevart_astrostar_archive_banner_width',array(
			'label'	=> esc_html__('Blog/Archive banner width','astrostar'),
			'section'	=> 'wpdevart_astrostar_blog_section',
			'setting'	=> 'wpdevart_astrostar_archive_banner_width',
			'type' => 'select',
			'choices' => array(
				'narrow' => esc_html__('Narrow','astrostar'),
				'wide' => esc_html__('Wide','astrostar')
				)
	));	
	$wp_customize->add_setting('wpdevart_astrostar_archive_banner_title_alignment',array(
		'default'	=> esc_html('center'),
		'sanitize_callback'	=> 'wpdevart_astrostar_text_sanitization'	
	));
	$wp_customize->add_control('wpdevart_astrostar_archive_banner_title_alignment',array(
			'label'	=> esc_html__('Blog/Archive title alignment','astrostar'),
			'section'	=> 'wpdevart_astrostar_blog_section',
			'setting'	=> 'wpdevart_astrostar_archive_banner_title_alignment',
			'type' => 'select',
			'choices' => array(
				'left' => esc_html__('Left','astrostar'),
				'center' => esc_html__('Center','astrostar'),
				'right' => esc_html__('Right','astrostar')
				)
	));	
	$wp_customize->add_setting('wpdevart_astrostar_archive_banner_bg_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_astrostar_archive_banner_bg_color', esc_html('#070506')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_astrostar_archive_banner_bg_color', array(
        'label' => esc_html__('Blog/Archive banner background color','astrostar'),
        'section' => 'wpdevart_astrostar_blog_section',
        'settings' => 'wpdevart_astrostar_archive_banner_bg_color'
    )));
	$wp_customize->add_setting('wpdevart_astrostar_archive_banner_bg_gradient_type',array(
		'default'	=> esc_html('to right'),
		'sanitize_callback'	=> 'wpdevart_astrostar_text_sanitization'	
	));
	$wp_customize->add_control('wpdevart_astrostar_archive_banner_bg_gradient_type',array(
			'label'	=> esc_html__('Archive pages banner gradient type','astrostar'),
			'section'	=> 'wpdevart_astrostar_blog_section',
			'setting'	=> 'wpdevart_astrostar_archive_banner_bg_gradient_type',
			'type' => 'select',
			'choices' => array(
				'to right' => esc_html__('To right','astrostar'),
				'to left' => esc_html__('To left','astrostar'),
				'to bottom' => esc_html__('To bottom','astrostar'),
				'to top' => esc_html__('To top','astrostar'),
				'to bottom right' => esc_html__('To bottom right','astrostar'),
				'to bottom left' => esc_html__('To bottom left','astrostar'),
				'to top right' => esc_html__('To top right','astrostar'),
				'to top left' => esc_html__('To top left','astrostar'),
				)
	));	
	$wp_customize->add_setting('wpdevart_astrostar_archive_banner_bg_gradient_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_astrostar_archive_banner_bg_gradient_color', esc_html('#070506')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_astrostar_archive_banner_bg_gradient_color', array(
        'label' => esc_html__('Archive pages banner gradient color','astrostar'),
        'section' => 'wpdevart_astrostar_blog_section',
        'settings' => 'wpdevart_astrostar_archive_banner_bg_gradient_color'
    )));
	$wp_customize->add_setting('wpdevart_astrostar_archive_banner_title_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_astrostar_archive_banner_title_color', esc_html('#ca9d75')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_astrostar_archive_banner_title_color', array(
        'label' => esc_html__('Blog/Archive title color','astrostar'),
        'section' => 'wpdevart_astrostar_blog_section',
        'settings' => 'wpdevart_astrostar_archive_banner_title_color'
    )));
    $wp_customize->add_setting( 'wpdevart_astrostar_blog_archive_page_layout',
	array(
		'default' => esc_html('sidebarright'),
		'transport' => 'refresh',
		'sanitize_callback' => 'wpdevart_astrostar_text_sanitization'
	)
	);
	$wp_customize->add_control( new Wpdevart_Image_Radio_Button_Custom_Control( $wp_customize, 'wpdevart_astrostar_blog_archive_page_layout',
	array(
		'label' => esc_html__( 'Blog/Archive Page Layout', 'astrostar' ),
		'description' => esc_html__( 'Choose the blog/archive page layout.', 'astrostar' ),
		'section' => 'wpdevart_astrostar_blog_section',
		'choices' => array(
		'sidebarleft' => array(
			'image' => trailingslashit( get_template_directory_uri() ) . 'images/sidebar-left.png',
			'name' => esc_html__( 'Left Sidebar', 'astrostar' )
		),
		'sidebarnone' => array(
			'image' => trailingslashit( get_template_directory_uri() ) . 'images/sidebar-none.png',
			'name' => esc_html__( 'No Sidebar', 'astrostar' )
		),
		'sidebarright' => array(
			'image' => trailingslashit( get_template_directory_uri() ) . 'images/sidebar-right.png',
			'name' => esc_html__( 'Right Sidebar', 'astrostar' )
		)
		)
	)
	) );

	##################------ Search Page ------##################

	$wp_customize->add_section('wpdevart_astrostar_search_page_section',array(
		'title'	=> esc_html__('Search Page','astrostar'),					
		'priority'		=> null,
		'panel'         => 'wpdevart_astrostar_blog_archive_search_panel'
	));


	$wp_customize->add_setting('wpdevart_astrostar_search_banner_width',array(
		'default'	=> esc_html('narrow'),
		'sanitize_callback'	=> 'wpdevart_astrostar_text_sanitization'	
	));
	$wp_customize->add_control('wpdevart_astrostar_search_banner_width',array(
			'label'	=> esc_html__('Search page banner width','astrostar'),
			'section'	=> 'wpdevart_astrostar_search_page_section',
			'setting'	=> 'wpdevart_astrostar_search_banner_width',
			'type' => 'select',
			'choices' => array(
				'narrow' => esc_html__('Narrow','astrostar'),
				'wide' => esc_html__('Wide','astrostar')
				)
	));
	$wp_customize->add_setting('wpdevart_astrostar_search_banner_title_alignment',array(
		'default'	=> esc_html('center'),
		'sanitize_callback'	=> 'wpdevart_astrostar_text_sanitization'	
	));
	$wp_customize->add_control('wpdevart_astrostar_search_banner_title_alignment',array(
			'label'	=> esc_html__('Search page title alignment','astrostar'),
			'section'	=> 'wpdevart_astrostar_search_page_section',
			'setting'	=> 'wpdevart_astrostar_search_banner_title_alignment',
			'type' => 'select',
			'choices' => array(
				'left' => esc_html__('Left','astrostar'),
				'center' => esc_html__('Center','astrostar'),
				'right' => esc_html__('Right','astrostar')
				)
	));
	$wp_customize->add_setting('wpdevart_astrostar_search_banner_bg_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_astrostar_search_banner_bg_color', esc_html('#070506')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_astrostar_search_banner_bg_color', array(
		'label' => esc_html__('Search page banner background color','astrostar'),
		'section' => 'wpdevart_astrostar_search_page_section',
		'settings' => 'wpdevart_astrostar_search_banner_bg_color'
	)));
	$wp_customize->add_setting('wpdevart_astrostar_search_banner_bg_gradient_type',array(
		'default'	=> esc_html('to right'),
		'sanitize_callback'	=> 'wpdevart_astrostar_text_sanitization'	
	));
	$wp_customize->add_control('wpdevart_astrostar_search_banner_bg_gradient_type',array(
			'label'	=> esc_html__('Search page banner gradient type','astrostar'),
			'section'	=> 'wpdevart_astrostar_search_page_section',
			'setting'	=> 'wpdevart_astrostar_search_banner_bg_gradient_type',
			'type' => 'select',
			'choices' => array(
				'to right' => esc_html__('To right','astrostar'),
				'to left' => esc_html__('To left','astrostar'),
				'to bottom' => esc_html__('To bottom','astrostar'),
				'to top' => esc_html__('To top','astrostar'),
				'to bottom right' => esc_html__('To bottom right','astrostar'),
				'to bottom left' => esc_html__('To bottom left','astrostar'),
				'to top right' => esc_html__('To top right','astrostar'),
				'to top left' => esc_html__('To top left','astrostar'),
				)
	));	
	$wp_customize->add_setting('wpdevart_astrostar_search_banner_bg_gradient_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_astrostar_search_banner_bg_gradient_color', esc_html('#070506')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_astrostar_search_banner_bg_gradient_color', array(
        'label' => esc_html__('Search page banner gradient color','astrostar'),
        'section' => 'wpdevart_astrostar_search_page_section',
        'settings' => 'wpdevart_astrostar_search_banner_bg_gradient_color'
    )));
	$wp_customize->add_setting('wpdevart_astrostar_search_banner_title_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_astrostar_search_banner_title_color', esc_html('#ca9d75')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_astrostar_search_banner_title_color', array(
		'label' => esc_html__('Search page title color','astrostar'),
		'section' => 'wpdevart_astrostar_search_page_section',
		'settings' => 'wpdevart_astrostar_search_banner_title_color'
	)));	
	$wp_customize->add_setting( 'wpdevart_astrostar_search_page_layout',
	array(
		'default' => esc_html('sidebarright'),
		'transport' => 'refresh',
		'sanitize_callback' => 'wpdevart_astrostar_text_sanitization'
	)
	);
	$wp_customize->add_control( new Wpdevart_Image_Radio_Button_Custom_Control( $wp_customize, 'wpdevart_astrostar_search_page_layout',
	array(
		'label' => esc_html__( 'Search Page Layout', 'astrostar' ),
		'description' => esc_html__( 'Choose the search page layout.', 'astrostar' ),
		'section' => 'wpdevart_astrostar_search_page_section',
		'choices' => array(
		'sidebarleft' => array(
			'image' => trailingslashit( get_template_directory_uri() ) . 'images/sidebar-left.png',
			'name' => esc_html__( 'Left Sidebar', 'astrostar' )
		),
		'sidebarnone' => array(
			'image' => trailingslashit( get_template_directory_uri() ) . 'images/sidebar-none.png',
			'name' => esc_html__( 'No Sidebar', 'astrostar' )
		),
		'sidebarright' => array(
			'image' => trailingslashit( get_template_directory_uri() ) . 'images/sidebar-right.png',
			'name' => esc_html__( 'Right Sidebar', 'astrostar' )
		)
		)
	)
	) );
	$wp_customize->add_setting('wpdevart_astrostar_search_page_button_style',array(
		'default'	=> esc_html('wpdevart_astrostar_primary_button_slide primary_btn_slide_right'),
		'sanitize_callback'	=> 'wpdevart_astrostar_text_sanitization'	
	));
	$wp_customize->add_control('wpdevart_astrostar_search_page_button_style',array(
			'label'	=> esc_html__('Search button color','astrostar'),
			'section'	=> 'wpdevart_astrostar_search_page_section',
			'setting'	=> 'wpdevart_astrostar_search_page_button_style',
			'type' => 'select',
			'choices' => array(
				'wpdevart_astrostar_primary_button_slide primary_btn_slide_right' => esc_html__('Custom Primary', 'astrostar'),
				'wpdevart_astrostar_secondary_button_slide secondary_btn_slide_right' => esc_html__('Custom Secondary', 'astrostar'),
				'wpdevart_astrostar_first_button_slide first_btn_slide_right' => esc_html__('WpDevArt Color', 'astrostar'),
				'wpdevart_astrostar_second_button_slide second_btn_slide_right' => esc_html__('Grapefruit Red', 'astrostar'),
				'wpdevart_astrostar_third_button_slide third_btn_slide_right' => esc_html__('Blue', 'astrostar'),
				'wpdevart_astrostar_fourth_button_slide fourth_btn_slide_right' => esc_html__('Dark', 'astrostar'),
				'wpdevart_astrostar_fifth_button_slide fifth_btn_slide_right' => esc_html__('Green', 'astrostar'),
				'wpdevart_astrostar_sixth_button_slide sixth_btn_slide_right' => esc_html__('Yellow', 'astrostar'),
				'wpdevart_astrostar_seventh_button_slide seventh_btn_slide_right' => esc_html__('Custom Green', 'astrostar'),
				'wpdevart_astrostar_eighth_button_slide eighth_btn_slide_right' => esc_html__('White', 'astrostar'),
				)
	));

	##################------ General ------##################
	
	$wp_customize->add_section('wpdevart_astrostar_blog_archive_search_general_section',array(
		'title'	=> esc_html__('General','astrostar'),
		'description'	=> esc_html__('This is the global options page for the Blog/Archive/Search posts lists.','astrostar'),
		'priority'		=> null,
		'panel'         => 'wpdevart_astrostar_blog_archive_search_panel'
	));
	$wp_customize->add_setting('wpdevart_astrostar_blog_settings_posts_list_bg_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_astrostar_blog_settings_posts_list_bg_color', esc_html('#070506')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_astrostar_blog_settings_posts_list_bg_color', array(
        'label' => esc_html__('Summary/Post/Page block background color','astrostar'),
        'section' => 'wpdevart_astrostar_blog_archive_search_general_section',
        'settings' => 'wpdevart_astrostar_blog_settings_posts_list_bg_color'
    )));
	$wp_customize->add_setting( 'wpdevart_astrostar_blog_archive_display_default_featured_image',
    array(
       'default' => esc_html(''),
       'transport' => 'refresh',
       'sanitize_callback' => 'wpdevart_astrostar_switch_sanitization'
    )
    );
    $wp_customize->add_control( new Wpdevart_Toggle_Switch_Custom_control( $wp_customize, 'wpdevart_astrostar_blog_archive_display_default_featured_image',
        array(
        'label' => esc_html__( 'Enable Default Featured Image', 'astrostar' ),
		'description' => esc_html__( 'Display the default featured image for posts that do not have a selected featured image.', 'astrostar' ),
        'section' => 'wpdevart_astrostar_blog_archive_search_general_section'
        )
    ) );
	$wp_customize->add_setting( 'wpdevart_astrostar_blog_settings_title_font_size',
    array(
       'default' => esc_html('22'),
       'sanitize_callback' => 'wpdevart_astrostar_sanitize_integer'
		)
	);
	$wp_customize->add_control( new Wpdevart_Slider_Custom_Control( $wp_customize, 'wpdevart_astrostar_blog_settings_title_font_size',
		array(
		'label' => esc_html__( 'Title font-size (px)', 'astrostar' ),
		'section' => 'wpdevart_astrostar_blog_archive_search_general_section',
		'input_attrs' => array(
			'min' => esc_html('15'),
			'max' => esc_html('50'),
			'step' => esc_html('1'),
		),
		)
	) );
	$wp_customize->add_setting('wpdevart_astrostar_blog_settings_title_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_astrostar_blog_settings_title_color', esc_html('#ca9d75')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_astrostar_blog_settings_title_color', array(
        'label' => esc_html__('Title color','astrostar'),
        'section' => 'wpdevart_astrostar_blog_archive_search_general_section',
        'settings' => 'wpdevart_astrostar_blog_settings_title_color'
    )));
	$wp_customize->add_setting('wpdevart_astrostar_blog_settings_title_hover_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_astrostar_blog_settings_title_hover_color', esc_html('#ffffff')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_astrostar_blog_settings_title_hover_color', array(
        'label' => esc_html__('Title hover color','astrostar'),
        'section' => 'wpdevart_astrostar_blog_archive_search_general_section',
        'settings' => 'wpdevart_astrostar_blog_settings_title_hover_color'
    )));
	$wp_customize->add_setting('wpdevart_astrostar_blog_settings_title_border_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_astrostar_blog_settings_title_border_color', esc_html('#433e37')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_astrostar_blog_settings_title_border_color', array(
        'label' => esc_html__('Title border color','astrostar'),
        'section' => 'wpdevart_astrostar_blog_archive_search_general_section',
        'settings' => 'wpdevart_astrostar_blog_settings_title_border_color'
    )));
	$wp_customize->add_setting( 'wpdevart_astrostar_blog_settings_metas_font_size',
    array(
       'default' => esc_html('12'),
       'sanitize_callback' => 'wpdevart_astrostar_sanitize_integer'
		)
	);
	$wp_customize->add_control( new Wpdevart_Slider_Custom_Control( $wp_customize, 'wpdevart_astrostar_blog_settings_metas_font_size',
		array(
		'label' => esc_html__( 'Entry metas font-size (px)', 'astrostar' ),
		'section' => 'wpdevart_astrostar_blog_archive_search_general_section',
		'input_attrs' => array(
			'min' => esc_html('10'),
			'max' => esc_html('30'),
			'step' => esc_html('1'),
		),
		)
	) );
	$wp_customize->add_setting('wpdevart_astrostar_blog_settings_metas_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_astrostar_blog_settings_metas_color', esc_html('#ffffff')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_astrostar_blog_settings_metas_color', array(
        'label' => esc_html__('Color of the metas','astrostar'),
        'section' => 'wpdevart_astrostar_blog_archive_search_general_section',
        'settings' => 'wpdevart_astrostar_blog_settings_metas_color'
    )));
	$wp_customize->add_setting('wpdevart_astrostar_blog_settings_metas_hover_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_astrostar_blog_settings_metas_hover_color', esc_html('#ca9d75')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_astrostar_blog_settings_metas_hover_color', array(
        'label' => esc_html__('Entry metas hover color','astrostar'),
        'section' => 'wpdevart_astrostar_blog_archive_search_general_section',
        'settings' => 'wpdevart_astrostar_blog_settings_metas_hover_color'
    )));
	$wp_customize->add_setting('wpdevart_astrostar_blog_settings_meta_icons_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_astrostar_blog_settings_meta_icons_color', esc_html('#ca9d75')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_astrostar_blog_settings_meta_icons_color', array(
        'label' => esc_html__('Icons color of the metas','astrostar'),
        'section' => 'wpdevart_astrostar_blog_archive_search_general_section',
        'settings' => 'wpdevart_astrostar_blog_settings_meta_icons_color'
    )));
	$wp_customize->add_setting( 'wpdevart_astrostar_blog_settings_content_text_font_size',
    array(
       'default' => esc_html('15'),
       'sanitize_callback' => 'wpdevart_astrostar_sanitize_integer'
		)
	);
	$wp_customize->add_control( new Wpdevart_Slider_Custom_Control( $wp_customize, 'wpdevart_astrostar_blog_settings_content_text_font_size',
		array(
		'label' => esc_html__( 'Content font-size (px)', 'astrostar' ),
		'section' => 'wpdevart_astrostar_blog_archive_search_general_section',
		'input_attrs' => array(
			'min' => esc_html('10'),
			'max' => esc_html('40'),
			'step' => esc_html('1'),
		),
		)
	) );
	$wp_customize->add_setting('wpdevart_astrostar_blog_settings_content_text_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_astrostar_blog_settings_content_text_color', esc_html('#c3beb6')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_astrostar_blog_settings_content_text_color', array(
        'label' => esc_html__('Content text color','astrostar'),
        'section' => 'wpdevart_astrostar_blog_archive_search_general_section',
        'settings' => 'wpdevart_astrostar_blog_settings_content_text_color'
    )));
	$wp_customize->add_setting( 'wpdevart_astrostar_blog_settings_category_text_font_size',
    array(
       'default' => esc_html('13'),
       'sanitize_callback' => 'wpdevart_astrostar_sanitize_integer'
		)
	);
	$wp_customize->add_control( new Wpdevart_Slider_Custom_Control( $wp_customize, 'wpdevart_astrostar_blog_settings_category_text_font_size',
		array(
		'label' => esc_html__( 'Category font-size (px)', 'astrostar' ),
		'section' => 'wpdevart_astrostar_blog_archive_search_general_section',
		'input_attrs' => array(
			'min' => esc_html('10'),
			'max' => esc_html('40'),
			'step' => esc_html('1'),
		),
		)
	) );
	$wp_customize->add_setting('wpdevart_astrostar_blog_settings_category_bg_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_astrostar_blog_settings_category_bg_color', esc_html('#070506')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_astrostar_blog_settings_category_bg_color', array(
        'label' => esc_html__('Categories background color','astrostar'),
        'section' => 'wpdevart_astrostar_blog_archive_search_general_section',
        'settings' => 'wpdevart_astrostar_blog_settings_category_bg_color'
    )));
	$wp_customize->add_setting('wpdevart_astrostar_blog_settings_category_border_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_astrostar_blog_settings_category_border_color', esc_html('#ca9d75')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_astrostar_blog_settings_category_border_color', array(
        'label' => esc_html__('Categories border color','astrostar'),
        'section' => 'wpdevart_astrostar_blog_archive_search_general_section',
        'settings' => 'wpdevart_astrostar_blog_settings_category_border_color'
    )));	
	$wp_customize->add_setting('wpdevart_astrostar_blog_settings_category_text_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_astrostar_blog_settings_category_text_color', esc_html('#ca9d75')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_astrostar_blog_settings_category_text_color', array(
        'label' => esc_html__('Categories text color','astrostar'),
        'section' => 'wpdevart_astrostar_blog_archive_search_general_section',
        'settings' => 'wpdevart_astrostar_blog_settings_category_text_color'
    )));	
	$wp_customize->add_setting('wpdevart_astrostar_blog_settings_category_bg_hover_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_astrostar_blog_settings_category_bg_hover_color', esc_html('#070506')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_astrostar_blog_settings_category_bg_hover_color', array(
        'label' => esc_html__('Categories background hover color','astrostar'),
        'section' => 'wpdevart_astrostar_blog_archive_search_general_section',
        'settings' => 'wpdevart_astrostar_blog_settings_category_bg_hover_color'
    )));
	$wp_customize->add_setting('wpdevart_astrostar_blog_settings_category_border_hover_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_astrostar_blog_settings_category_border_hover_color', esc_html('#ffffff')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_astrostar_blog_settings_category_border_hover_color', array(
        'label' => esc_html__('Categories border hover color','astrostar'),
        'section' => 'wpdevart_astrostar_blog_archive_search_general_section',
        'settings' => 'wpdevart_astrostar_blog_settings_category_border_hover_color'
    )));
	$wp_customize->add_setting('wpdevart_astrostar_blog_settings_category_text_hover_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_astrostar_blog_settings_category_text_hover_color', esc_html('#ffffff')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_astrostar_blog_settings_category_text_hover_color', array(
        'label' => esc_html__('Categories text hover color','astrostar'),
        'section' => 'wpdevart_astrostar_blog_archive_search_general_section',
        'settings' => 'wpdevart_astrostar_blog_settings_category_text_hover_color'
    )));

	##################------ Pagination ------##################

	$wp_customize->add_section('wpdevart_astrostar_pagination_settings',array(
		'title'	=> esc_html__('Pagination','astrostar'),					
		'priority'		=> null,
		'panel'         => 'wpdevart_astrostar_blog_archive_search_panel'
	));

	$wp_customize->add_setting('wpdevart_astrostar_pagination_buttons_bg_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_astrostar_pagination_buttons_bg_color', esc_html('#2d2d3c')),
		'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_astrostar_pagination_buttons_bg_color', array(
        'label' => esc_html__('Buttons background color','astrostar'),
        'section' => 'wpdevart_astrostar_pagination_settings',
        'settings' => 'wpdevart_astrostar_pagination_buttons_bg_color'
    )));
	$wp_customize->add_setting('wpdevart_astrostar_pagination_buttons_border_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_astrostar_pagination_buttons_border_color', esc_html('#2d2d3c')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_astrostar_pagination_buttons_border_color', array(
        'label' => esc_html__('Buttons border color','astrostar'),
        'section' => 'wpdevart_astrostar_pagination_settings',
        'settings' => 'wpdevart_astrostar_pagination_buttons_border_color'
    )));
	$wp_customize->add_setting('wpdevart_astrostar_pagination_buttons_link_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_astrostar_pagination_buttons_link_color', esc_html('#ca9d75')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_astrostar_pagination_buttons_link_color', array(
        'label' => esc_html__('Text color of active buttons','astrostar'),
        'section' => 'wpdevart_astrostar_pagination_settings',
        'settings' => 'wpdevart_astrostar_pagination_buttons_link_color'
    )));
	$wp_customize->add_setting('wpdevart_astrostar_pagination_buttons_text_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_astrostar_pagination_buttons_text_color', esc_html('#c9b29f')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_astrostar_pagination_buttons_text_color', array(
        'label' => esc_html__('Text color of inactive buttons','astrostar'),
        'section' => 'wpdevart_astrostar_pagination_settings',
        'settings' => 'wpdevart_astrostar_pagination_buttons_text_color'
    )));
	$wp_customize->add_setting('wpdevart_astrostar_pagination_buttons_bg_hover_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_astrostar_pagination_buttons_bg_hover_color', esc_html('#070506')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_astrostar_pagination_buttons_bg_hover_color', array(
        'label' => esc_html__('Buttons background hover color','astrostar'),
        'section' => 'wpdevart_astrostar_pagination_settings',
        'settings' => 'wpdevart_astrostar_pagination_buttons_bg_hover_color'
    )));
	$wp_customize->add_setting('wpdevart_astrostar_pagination_buttons_border_hover_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_astrostar_pagination_buttons_border_hover_color', esc_html('#2d2d3c')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_astrostar_pagination_buttons_border_hover_color', array(
        'label' => esc_html__('Buttons border hover color','astrostar'),
        'section' => 'wpdevart_astrostar_pagination_settings',
        'settings' => 'wpdevart_astrostar_pagination_buttons_border_hover_color'
    )));
	$wp_customize->add_setting('wpdevart_astrostar_pagination_buttons_link_hover_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_astrostar_pagination_buttons_link_hover_color', esc_html('#ffffff')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_astrostar_pagination_buttons_link_hover_color', array(
        'label' => esc_html__('Text color of active buttons on hover','astrostar'),
        'section' => 'wpdevart_astrostar_pagination_settings',
        'settings' => 'wpdevart_astrostar_pagination_buttons_link_hover_color'
    )));
	$wp_customize->add_setting('wpdevart_astrostar_pagination_buttons_text_hover_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_astrostar_pagination_buttons_text_hover_color', esc_html('#c9b29f')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_astrostar_pagination_buttons_text_hover_color', array(
        'label' => esc_html__('Text color of inactive buttons on hover','astrostar'),
        'section' => 'wpdevart_astrostar_pagination_settings',
        'settings' => 'wpdevart_astrostar_pagination_buttons_text_hover_color'
    )));