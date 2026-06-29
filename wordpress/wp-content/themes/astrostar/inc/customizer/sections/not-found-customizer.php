<?php
    $wp_customize->add_section('wpdevart_astrostar_not_found_section',array(
		'title'	=> esc_html__('404 Page','astrostar'),					
		'priority'		=> 31
	));
	$wp_customize->add_setting('wpdevart_astrostar_not_found_page_bg_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_astrostar_not_found_page_bg_color', esc_html('#070506')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_astrostar_not_found_page_bg_color', array(
        'label' => esc_html__('404 Page background color','astrostar'),
        'section' => 'wpdevart_astrostar_not_found_section',
        'settings' => 'wpdevart_astrostar_not_found_page_bg_color'
    )));
	$wp_customize->add_setting('wpdevart_astrostar_not_found_image',array(
		'default'	=> esc_url(get_theme_file_uri('/images/wpdevart-default-404.png')),
		'sanitize_callback'	=> 'wpdevart_astrostar_url_sanitization'
	));
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'wpdevart_astrostar_not_found_image', array(
        'label' => esc_html__('404 page Image','astrostar'),
		'description' => esc_html__( 'Recommended image size ~1080*550', 'astrostar' ),
        'section' => 'wpdevart_astrostar_not_found_section',
        'settings' => 'wpdevart_astrostar_not_found_image',
        'button_labels' => array(
                    'select' =>  esc_html__('Select Image', 'astrostar'),
                    'remove' =>  esc_html__('Remove Image', 'astrostar'),
                    'change' =>  esc_html__('Change Image', 'astrostar'),
                    )
    )));
	$wp_customize->add_setting('wpdevart_astrostar_not_found_page_title',array(
		'default'	=> esc_html('Oops! Page Not Found'),
		'sanitize_callback'	=> 'wpdevart_astrostar_text_sanitization'	
	));
    $wp_customize->add_control( new WP_Customize_Control(
        $wp_customize,
        'wpdevart_astrostar_not_found_page_title',
            array(
                'label'    => esc_html__('404 page title','astrostar'),
                'section'  => 'wpdevart_astrostar_not_found_section',
                'settings' => 'wpdevart_astrostar_not_found_page_title',
                'type'     => 'text'
            )
        )
    );
	$wp_customize->add_setting('wpdevart_astrostar_not_found_page_description',array(
		'default'	=> esc_html('The page or URL you are trying to access was not found. Use the homepage link below to navigate to the homepage. You can also use the search function.'),
		'sanitize_callback'	=> 'wpdevart_astrostar_text_sanitization'	
	));
	$wp_customize->add_control('wpdevart_astrostar_not_found_page_description',array(
			'label'	=> esc_html__('404 page description','astrostar'),
			'section'	=> 'wpdevart_astrostar_not_found_section',
			'setting'	=> 'wpdevart_astrostar_not_found_page_description'
	));	
	$wp_customize->add_setting('wpdevart_astrostar_not_found_page_button_text',array(
		'default'	=> esc_html('Back to Homepage'),
		'sanitize_callback'	=> 'wpdevart_astrostar_text_sanitization'	
	));
	$wp_customize->add_control('wpdevart_astrostar_not_found_page_button_text',array(
			'label'	=> esc_html__('404 page button text','astrostar'),
			'section'	=> 'wpdevart_astrostar_not_found_section',
			'setting'	=> 'wpdevart_astrostar_not_found_page_button_text'
	));	
	$wp_customize->add_setting('wpdevart_astrostar_not_found_page_button_url',array(
		'default'	=> esc_url(get_home_url()),
		'sanitize_callback'	=> 'wpdevart_astrostar_url_sanitization'	
	));
	$wp_customize->add_control('wpdevart_astrostar_not_found_page_button_url',array(
			'label'	=> esc_html__('404 page button URL','astrostar'),
			'section'	=> 'wpdevart_astrostar_not_found_section',
			'setting'	=> 'wpdevart_astrostar_not_found_page_button_url'
	));	
	$wp_customize->add_setting('wpdevart_astrostar_not_found_page_button_style',array(
		'default'	=> esc_html('wpdevart_astrostar_primary_button_slide primary_btn_slide_right'),
		'sanitize_callback'	=> 'wpdevart_astrostar_text_sanitization'	
	));
	$wp_customize->add_control('wpdevart_astrostar_not_found_page_button_style',array(
			'label'	=> esc_html__('Back to Homepage button color','astrostar'),
			'section'	=> 'wpdevart_astrostar_not_found_section',
			'setting'	=> 'wpdevart_astrostar_not_found_page_button_style',
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