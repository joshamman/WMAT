<?php 
	$wp_customize->add_panel( 'wpdevart_astrostar_general_settings_panel', 
    array(
		'title'	=> esc_html__('General','astrostar'),			
        'description'	=> esc_html__('General Settings','astrostar'),		
		'priority'		=> 21
    ) 
	);

	##################------ Fonts ------##################

	$wp_customize->add_section('wpdevart_astrostar_fonts_section',array(
		'title'	=> esc_html__('Fonts','astrostar'),					
		'priority'		=> null,
		'panel'         => 'wpdevart_astrostar_general_settings_panel'
	));
		
	$wp_customize->add_setting('wpdevart_astrostar_global_fonts',array(
		'default'	=> esc_html('Alegreya'),
		'sanitize_callback'	=> 'wpdevart_astrostar_text_sanitization'	
	));
  
	$wp_customize->add_control('wpdevart_astrostar_global_fonts',array(
			'label'	=> esc_html__('Select the font','astrostar'),
			'section'	=> 'wpdevart_astrostar_fonts_section',
			'setting'	=> 'wpdevart_astrostar_global_fonts',
			'type' => 'select',
			'choices' => array(
				'Roboto' => esc_html__('Roboto', 'astrostar'),
				'Poppins' => esc_html__('Poppins', 'astrostar'),
				'Open Sans' => esc_html__('Open Sans', 'astrostar'),
				'Alegreya' => esc_html__('Alegreya', 'astrostar'),
				'Alegreya Sans' => esc_html__('Alegreya Sans', 'astrostar'),
				'Lato' => esc_html__('Lato', 'astrostar'),
				'Montserrat' => esc_html__('Montserrat', 'astrostar'),
				'Oswald' => esc_html__('Oswald', 'astrostar'),
				'Raleway' => esc_html__('Raleway', 'astrostar'),
				'Inknut Antiqua' => esc_html__('Inknut Antiqua', 'astrostar'),
				)
	));

    ##################------ Primary Button ------##################

	$wp_customize->add_section('wpdevart_astrostar_primary_button_settings',array(
		'title'	=> esc_html__('Primary Button','astrostar'),
		'priority'		=> null,
		'panel'         => 'wpdevart_astrostar_general_settings_panel'
	));
	$wp_customize->add_setting('wpdevart_astrostar_primary_button_bg_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_astrostar_primary_button_bg_color', esc_html('#070506')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_astrostar_primary_button_bg_color', array(
        'label' => esc_html__('Primary button background color','astrostar'),
        'section' => 'wpdevart_astrostar_primary_button_settings',
        'settings' => 'wpdevart_astrostar_primary_button_bg_color'
    )));
	$wp_customize->add_setting('wpdevart_astrostar_primary_button_border_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_astrostar_primary_button_border_color', esc_html('#ca9d75')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_astrostar_primary_button_border_color', array(
        'label' => esc_html__('Primary button border color','astrostar'),
        'section' => 'wpdevart_astrostar_primary_button_settings',
        'settings' => 'wpdevart_astrostar_primary_button_border_color'
    )));
	$wp_customize->add_setting('wpdevart_astrostar_primary_button_link_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_astrostar_primary_button_link_color', esc_html('#ca9d75')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_astrostar_primary_button_link_color', array(
        'label' => esc_html__('Primary button text color','astrostar'),
        'section' => 'wpdevart_astrostar_primary_button_settings',
        'settings' => 'wpdevart_astrostar_primary_button_link_color'
    )));
	$wp_customize->add_setting('wpdevart_astrostar_primary_button_bg_hover_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_astrostar_primary_button_bg_hover_color', esc_html('#070506')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_astrostar_primary_button_bg_hover_color', array(
        'label' => esc_html__('Primary button background hover color','astrostar'),
        'section' => 'wpdevart_astrostar_primary_button_settings',
        'settings' => 'wpdevart_astrostar_primary_button_bg_hover_color'
    )));
	$wp_customize->add_setting('wpdevart_astrostar_primary_button_border_hover_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_astrostar_primary_button_border_hover_color', esc_html('#ffffff')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_astrostar_primary_button_border_hover_color', array(
        'label' => esc_html__('Primary button border hover color','astrostar'),
        'section' => 'wpdevart_astrostar_primary_button_settings',
        'settings' => 'wpdevart_astrostar_primary_button_border_hover_color'
    )));
	$wp_customize->add_setting('wpdevart_astrostar_primary_button_link_hover_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_astrostar_primary_button_link_hover_color', esc_html('#ffffff')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_astrostar_primary_button_link_hover_color', array(
        'label' => esc_html__('Primary button text hover color','astrostar'),
        'section' => 'wpdevart_astrostar_primary_button_settings',
        'settings' => 'wpdevart_astrostar_primary_button_link_hover_color'
    )));

    ##################------ Colors ------##################

	$wp_customize->add_section('wpdevart_astrostar_main_colors_settings',array(
		'title'	=> esc_html__('Colors','astrostar'),					
		'priority'		=> null,
		'panel'         => 'wpdevart_astrostar_general_settings_panel'
	));
	$wp_customize->add_setting('wpdevart_astrostar_main_container_bg_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_astrostar_main_container_bg_color', esc_html('#070506')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_astrostar_main_container_bg_color', array(
        'label' => esc_html__('Main container background color','astrostar'),
        'section' => 'wpdevart_astrostar_main_colors_settings',
        'settings' => 'wpdevart_astrostar_main_container_bg_color'
    )));
	
	$wp_customize->add_setting('wpdevart_astrostar_main_container_heading_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_astrostar_main_container_heading_color', esc_html('#ca9d75')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_astrostar_main_container_heading_color', array(
        'label' => esc_html__('Main container heading color','astrostar'),
        'section' => 'wpdevart_astrostar_main_colors_settings',
        'settings' => 'wpdevart_astrostar_main_container_heading_color'
    )));
	$wp_customize->add_setting('wpdevart_astrostar_main_container_text_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_astrostar_main_container_text_color', esc_html('#c3beb6')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_astrostar_main_container_text_color', array(
        'label' => esc_html__('Main container text color','astrostar'),
        'section' => 'wpdevart_astrostar_main_colors_settings',
        'settings' => 'wpdevart_astrostar_main_container_text_color'
    )));
	$wp_customize->add_setting('wpdevart_astrostar_main_container_link_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_astrostar_main_container_link_color', esc_html('#ca9d75')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_astrostar_main_container_link_color', array(
        'label' => esc_html__('Main container link color','astrostar'),
        'section' => 'wpdevart_astrostar_main_colors_settings',
        'settings' => 'wpdevart_astrostar_main_container_link_color'
    )));
	$wp_customize->add_setting('wpdevart_astrostar_main_container_link_hover_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_astrostar_main_container_link_hover_color', esc_html('#ffffff')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_astrostar_main_container_link_hover_color', array(
        'label' => esc_html__('Main container link hover color','astrostar'),
        'section' => 'wpdevart_astrostar_main_colors_settings',
        'settings' => 'wpdevart_astrostar_main_container_link_hover_color'
    )));

	##################------ Sidebar Colors ------##################

	$wp_customize->add_section('wpdevart_astrostar_sidebar_colors_settings',array(
		'title'	=> esc_html__('Sidebar Colors','astrostar'),					
		'priority'		=> null,
		'panel'         => 'wpdevart_astrostar_general_settings_panel'
	));
	$wp_customize->add_setting('wpdevart_astrostar_main_container_sidebar_bg_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_astrostar_main_container_sidebar_bg_color', esc_html('#070506')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_astrostar_main_container_sidebar_bg_color', array(
		'label' => esc_html__('Widgets background color','astrostar'),
		'section' => 'wpdevart_astrostar_sidebar_colors_settings',
		'settings' => 'wpdevart_astrostar_main_container_sidebar_bg_color'
	)));
	$wp_customize->add_setting('wpdevart_astrostar_main_container_sidebar_shadow_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_astrostar_main_container_sidebar_shadow_color', esc_html('#423223')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_astrostar_main_container_sidebar_shadow_color', array(
		'label' => esc_html__('Widgets shadow color','astrostar'),
		'section' => 'wpdevart_astrostar_sidebar_colors_settings',
		'settings' => 'wpdevart_astrostar_main_container_sidebar_shadow_color'
	)));
	$wp_customize->add_setting('wpdevart_astrostar_main_container_sidebar_heading_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_astrostar_main_container_sidebar_heading_color', esc_html('#ca9d75')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_astrostar_main_container_sidebar_heading_color', array(
		'label' => esc_html__('Sidebar headings color','astrostar'),
		'section' => 'wpdevart_astrostar_sidebar_colors_settings',
		'settings' => 'wpdevart_astrostar_main_container_sidebar_heading_color'
	)));
	$wp_customize->add_setting('wpdevart_astrostar_main_container_sidebar_text_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_astrostar_main_container_sidebar_text_color', esc_html('#c3beb6')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_astrostar_main_container_sidebar_text_color', array(
		'label' => esc_html__('Sidebar text color','astrostar'),
		'section' => 'wpdevart_astrostar_sidebar_colors_settings',
		'settings' => 'wpdevart_astrostar_main_container_sidebar_text_color'
	)));
	$wp_customize->add_setting('wpdevart_astrostar_main_container_sidebar_link_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_astrostar_main_container_sidebar_link_color', esc_html('#ffffff')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_astrostar_main_container_sidebar_link_color', array(
		'label' => esc_html__('Sidebar link color','astrostar'),
		'section' => 'wpdevart_astrostar_sidebar_colors_settings',
		'settings' => 'wpdevart_astrostar_main_container_sidebar_link_color'
	)));
	$wp_customize->add_setting('wpdevart_astrostar_main_container_sidebar_link_hover_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_astrostar_main_container_sidebar_link_hover_color', esc_html('#ca9d75')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_astrostar_main_container_sidebar_link_hover_color', array(
		'label' => esc_html__('Sidebar link hover color','astrostar'),
		'section' => 'wpdevart_astrostar_sidebar_colors_settings',
		'settings' => 'wpdevart_astrostar_main_container_sidebar_link_hover_color'
	)));

	##################------ Typography ------##################

	$wp_customize->add_section('wpdevart_astrostar_text_link_typography_settings',array(
		'title'	=> esc_html__('Typography','astrostar'),					
		'priority'		=> null,
		'panel'         => 'wpdevart_astrostar_general_settings_panel'
	));

    $wp_customize->add_setting( 'wpdevart_astrostar_main_container_text_font_size',
    array(
       'default' => esc_html('17'),
       'sanitize_callback' => 'wpdevart_astrostar_sanitize_integer'
		)
	);
	$wp_customize->add_control( new Wpdevart_Slider_Custom_Control( $wp_customize, 'wpdevart_astrostar_main_container_text_font_size',
		array(
		'label' => esc_html__( 'Main container text font-size (px)', 'astrostar' ),
		'section' => 'wpdevart_astrostar_text_link_typography_settings',
		'input_attrs' => array(
			'min' => esc_html('10'),
			'max' => esc_html('40'),
			'step' => esc_html('1'),
		),
		)
	) );
    $wp_customize->add_setting( 'wpdevart_astrostar_main_container_link_font_size',
    array(
       'default' => esc_html('17'),
       'sanitize_callback' => 'wpdevart_astrostar_sanitize_integer'
		)
	);
	$wp_customize->add_control( new Wpdevart_Slider_Custom_Control( $wp_customize, 'wpdevart_astrostar_main_container_link_font_size',
		array(
		'label' => esc_html__( 'Main container link font-size (px)', 'astrostar' ),
		'section' => 'wpdevart_astrostar_text_link_typography_settings',
		'input_attrs' => array(
			'min' => esc_html('10'),
			'max' => esc_html('40'),
			'step' => esc_html('1'),
		),
		)
	) );
	$wp_customize->add_setting('wpdevart_astrostar_main_container_link_font_weight',array(
		'default'	=> esc_html('400'),
		'sanitize_callback'	=> 'wpdevart_astrostar_text_sanitization'	
	));
	$wp_customize->add_control('wpdevart_astrostar_main_container_link_font_weight',array(
			'label'	=> esc_html__('Link font weight','astrostar'),
			'section'	=> 'wpdevart_astrostar_text_link_typography_settings',
			'setting'	=> 'wpdevart_astrostar_main_container_link_font_weight',
			'type' => 'select',
			'choices' => array(
				'100' => esc_html__('Thin 100','astrostar'),
				'400' => esc_html__('Normal 400','astrostar'),
				'600' => esc_html__('Semi-Bold 600','astrostar'),
				'800' => esc_html__('Extra-Bold 800','astrostar'),
				)
	));	
	$wp_customize->add_setting('wpdevart_astrostar_main_container_link_font_style',array(
		'default'	=> esc_html('normal'),
		'sanitize_callback'	=> 'wpdevart_astrostar_text_sanitization'
	));
	$wp_customize->add_control('wpdevart_astrostar_main_container_link_font_style',array(
			'label'	=> esc_html__('Link font style','astrostar'),
			'section'	=> 'wpdevart_astrostar_text_link_typography_settings',
			'setting'	=> 'wpdevart_astrostar_main_container_link_font_style',
			'type' => 'select',
			'choices' => array(
				'normal' => esc_html__('Normal','astrostar'),
				'italic' => esc_html__('Italic','astrostar'),
				)
	));	

	##################------ Typography H1 ------##################

	$wp_customize->add_section('wpdevart_astrostar_text_h1_h2_h3_h4_h5_h6_typography_settings',array(
		'title'	=> esc_html__('Typography H1, H2, H3, H4, H5, H6','astrostar'),					
		'priority'		=> null,
		'panel'         => 'wpdevart_astrostar_general_settings_panel'
	));

    $wp_customize->add_setting( 'wpdevart_astrostar_main_container_heading_h1_font_size',
    array(
       'default' => esc_html('40'),
       'sanitize_callback' => 'wpdevart_astrostar_sanitize_integer'
		)
	);
	$wp_customize->add_control( new Wpdevart_Slider_Custom_Control( $wp_customize, 'wpdevart_astrostar_main_container_heading_h1_font_size',
		array(
		'label' => esc_html__( 'Heading H1 font-size (px)', 'astrostar' ),
		'section' => 'wpdevart_astrostar_text_h1_h2_h3_h4_h5_h6_typography_settings',
		'input_attrs' => array(
			'min' => esc_html('25'),
			'max' => esc_html('70'),
			'step' => esc_html('1'),
		),
		)
	) );
	$wp_customize->add_setting('wpdevart_astrostar_main_container_heading_h1_font_weight',array(
		'default'	=> esc_html('400'),
		'sanitize_callback'	=> 'wpdevart_astrostar_text_sanitization'	
	));
	$wp_customize->add_control('wpdevart_astrostar_main_container_heading_h1_font_weight',array(
			'label'	=> esc_html__('Heading H1 font weight','astrostar'),
			'section'	=> 'wpdevart_astrostar_text_h1_h2_h3_h4_h5_h6_typography_settings',
			'setting'	=> 'wpdevart_astrostar_main_container_heading_h1_font_weight',
			'type' => 'select',
			'choices' => array(
				'100' => esc_html__('Thin 100','astrostar'),
				'400' => esc_html__('Normal 400','astrostar'),
				'600' => esc_html__('Semi-Bold 600','astrostar'),
				'800' => esc_html__('Extra-Bold 800','astrostar'),
				)
	));	
	$wp_customize->add_setting('wpdevart_astrostar_main_container_heading_h1_font_style',array(
		'default'	=> esc_html('normal'),
		'sanitize_callback'	=> 'wpdevart_astrostar_text_sanitization'
	));
	$wp_customize->add_control('wpdevart_astrostar_main_container_heading_h1_font_style',array(
			'label'	=> esc_html__('Heading H1 font style','astrostar'),
			'section'	=> 'wpdevart_astrostar_text_h1_h2_h3_h4_h5_h6_typography_settings',
			'setting'	=> 'wpdevart_astrostar_main_container_heading_h1_font_style',
			'type' => 'select',
			'choices' => array(
				'normal' => esc_html__('Normal','astrostar'),
				'italic' => esc_html__('Italic','astrostar'),
				)
	));	
	$wp_customize->add_setting('wpdevart_astrostar_main_container_heading_h1_font_transform',array(
		'default'	=> esc_html('uppercase'),
		'sanitize_callback'	=> 'wpdevart_astrostar_text_sanitization'
	));
	$wp_customize->add_control('wpdevart_astrostar_main_container_heading_h1_font_transform',array(
			'label'	=> esc_html__('Heading H1 font transform','astrostar'),
			'section'	=> 'wpdevart_astrostar_text_h1_h2_h3_h4_h5_h6_typography_settings',
			'setting'	=> 'wpdevart_astrostar_main_container_heading_h1_font_transform',
			'type' => 'select',
			'choices' => array(
				'none' => esc_html__('None','astrostar'),
				'capitalize' => esc_html__('Capitalize','astrostar'),
				'uppercase' => esc_html__('Uppercase','astrostar'),
				'lowercase' => esc_html__('Lowercase','astrostar'),
				)
	));	
	$wp_customize->add_setting('wpdevart_astrostar_main_container_heading_h1_font_decoration',array(
		'default'	=> esc_html('none'),
		'sanitize_callback'	=> 'wpdevart_astrostar_text_sanitization'
	));
	$wp_customize->add_control('wpdevart_astrostar_main_container_heading_h1_font_decoration',array(
			'label'	=> esc_html__('Heading H1 font decoration','astrostar'),
			'section'	=> 'wpdevart_astrostar_text_h1_h2_h3_h4_h5_h6_typography_settings',
			'setting'	=> 'wpdevart_astrostar_main_container_heading_h1_font_decoration',
			'type' => 'select',
			'choices' => array(
				'none' => esc_html__('None','astrostar'),
				'underline' => esc_html__('Underline','astrostar'),
				'line-through' => esc_html__('Line-through','astrostar'),
				'overline' => esc_html__('Overline','astrostar'),
				)
	));	

	##################------ Typography H2 ------##################

    $wp_customize->add_setting( 'wpdevart_astrostar_main_container_heading_h2_font_size',
    array(
       'default' => esc_html('28'),
       'sanitize_callback' => 'wpdevart_astrostar_sanitize_integer'
		)
	);
	$wp_customize->add_control( new Wpdevart_Slider_Custom_Control( $wp_customize, 'wpdevart_astrostar_main_container_heading_h2_font_size',
		array(
		'label' => esc_html__( 'Heading H2 font-size (px)', 'astrostar' ),
		'section' => 'wpdevart_astrostar_text_h1_h2_h3_h4_h5_h6_typography_settings',
		'input_attrs' => array(
			'min' => esc_html('20'),
			'max' => esc_html('65'),
			'step' => esc_html('1'),
		),
		)
	) );
	$wp_customize->add_setting('wpdevart_astrostar_main_container_heading_h2_font_weight',array(
		'default'	=> esc_html('400'),
		'sanitize_callback'	=> 'wpdevart_astrostar_text_sanitization'	
	));
	$wp_customize->add_control('wpdevart_astrostar_main_container_heading_h2_font_weight',array(
			'label'	=> esc_html__('Heading H2 font weight','astrostar'),
			'section'	=> 'wpdevart_astrostar_text_h1_h2_h3_h4_h5_h6_typography_settings',
			'setting'	=> 'wpdevart_astrostar_main_container_heading_h2_font_weight',
			'type' => 'select',
			'choices' => array(
				'100' => esc_html__('Thin 100','astrostar'),
				'400' => esc_html__('Normal 400','astrostar'),
				'600' => esc_html__('Semi-Bold 600','astrostar'),
				'800' => esc_html__('Extra-Bold 800','astrostar'),
				)
	));	
	$wp_customize->add_setting('wpdevart_astrostar_main_container_heading_h2_font_style',array(
		'default'	=> esc_html('normal'),
		'sanitize_callback'	=> 'wpdevart_astrostar_text_sanitization'
	));
	$wp_customize->add_control('wpdevart_astrostar_main_container_heading_h2_font_style',array(
			'label'	=> esc_html__('Heading H2 font style','astrostar'),
			'section'	=> 'wpdevart_astrostar_text_h1_h2_h3_h4_h5_h6_typography_settings',
			'setting'	=> 'wpdevart_astrostar_main_container_heading_h2_font_style',
			'type' => 'select',
			'choices' => array(
				'normal' => esc_html__('Normal','astrostar'),
				'italic' => esc_html__('Italic','astrostar'),
				)
	));	
	$wp_customize->add_setting('wpdevart_astrostar_main_container_heading_h2_font_transform',array(
		'default'	=> esc_html('uppercase'),
		'sanitize_callback'	=> 'wpdevart_astrostar_text_sanitization'
	));
	$wp_customize->add_control('wpdevart_astrostar_main_container_heading_h2_font_transform',array(
			'label'	=> esc_html__('Heading H2 font transform','astrostar'),
			'section'	=> 'wpdevart_astrostar_text_h1_h2_h3_h4_h5_h6_typography_settings',
			'setting'	=> 'wpdevart_astrostar_main_container_heading_h2_font_transform',
			'type' => 'select',
			'choices' => array(
				'none' => esc_html__('None','astrostar'),
				'capitalize' => esc_html__('Capitalize','astrostar'),
				'uppercase' => esc_html__('Uppercase','astrostar'),
				'lowercase' => esc_html__('Lowercase','astrostar'),
				)
	));	
	$wp_customize->add_setting('wpdevart_astrostar_main_container_heading_h2_font_decoration',array(
		'default'	=> esc_html('none'),
		'sanitize_callback'	=> 'wpdevart_astrostar_text_sanitization'
	));
	$wp_customize->add_control('wpdevart_astrostar_main_container_heading_h2_font_decoration',array(
			'label'	=> esc_html__('Heading H2 font decoration','astrostar'),
			'section'	=> 'wpdevart_astrostar_text_h1_h2_h3_h4_h5_h6_typography_settings',
			'setting'	=> 'wpdevart_astrostar_main_container_heading_h2_font_decoration',
			'type' => 'select',
			'choices' => array(
				'none' => esc_html__('None','astrostar'),
				'underline' => esc_html__('Underline','astrostar'),
				'line-through' => esc_html__('Line-through','astrostar'),
				'overline' => esc_html__('Overline','astrostar'),
				)
	));	

	##################------ Typography H3 ------##################

    $wp_customize->add_setting( 'wpdevart_astrostar_main_container_heading_h3_font_size',
    array(
       'default' => esc_html('24'),
       'sanitize_callback' => 'wpdevart_astrostar_sanitize_integer'
		)
	);
	$wp_customize->add_control( new Wpdevart_Slider_Custom_Control( $wp_customize, 'wpdevart_astrostar_main_container_heading_h3_font_size',
		array(
		'label' => esc_html__( 'Heading H3 font-size (px)', 'astrostar' ),
		'section' => 'wpdevart_astrostar_text_h1_h2_h3_h4_h5_h6_typography_settings',
		'input_attrs' => array(
			'min' => esc_html('20'),
			'max' => esc_html('65'),
			'step' => esc_html('1'),
		),
		)
	) );
	$wp_customize->add_setting('wpdevart_astrostar_main_container_heading_h3_font_weight',array(
		'default'	=> esc_html('400'),
		'sanitize_callback'	=> 'wpdevart_astrostar_text_sanitization'	
	));
	$wp_customize->add_control('wpdevart_astrostar_main_container_heading_h3_font_weight',array(
			'label'	=> esc_html__('Heading H3 font weight','astrostar'),
			'section'	=> 'wpdevart_astrostar_text_h1_h2_h3_h4_h5_h6_typography_settings',
			'setting'	=> 'wpdevart_astrostar_main_container_heading_h3_font_weight',
			'type' => 'select',
			'choices' => array(
				'100' => esc_html__('Thin 100','astrostar'),
				'400' => esc_html__('Normal 400','astrostar'),
				'600' => esc_html__('Semi-Bold 600','astrostar'),
				'800' => esc_html__('Extra-Bold 800','astrostar'),
				)
	));	
	$wp_customize->add_setting('wpdevart_astrostar_main_container_heading_h3_font_style',array(
		'default'	=> esc_html('normal'),
		'sanitize_callback'	=> 'wpdevart_astrostar_text_sanitization'
	));
	$wp_customize->add_control('wpdevart_astrostar_main_container_heading_h3_font_style',array(
			'label'	=> esc_html__('Heading H3 font style','astrostar'),
			'section'	=> 'wpdevart_astrostar_text_h1_h2_h3_h4_h5_h6_typography_settings',
			'setting'	=> 'wpdevart_astrostar_main_container_heading_h3_font_style',
			'type' => 'select',
			'choices' => array(
				'normal' => esc_html__('Normal','astrostar'),
				'italic' => esc_html__('Italic','astrostar'),
				)
	));	
	$wp_customize->add_setting('wpdevart_astrostar_main_container_heading_h3_font_transform',array(
		'default'	=> esc_html('uppercase'),
		'sanitize_callback'	=> 'wpdevart_astrostar_text_sanitization'
	));
	$wp_customize->add_control('wpdevart_astrostar_main_container_heading_h3_font_transform',array(
			'label'	=> esc_html__('Heading H3 font transform','astrostar'),
			'section'	=> 'wpdevart_astrostar_text_h1_h2_h3_h4_h5_h6_typography_settings',
			'setting'	=> 'wpdevart_astrostar_main_container_heading_h3_font_transform',
			'type' => 'select',
			'choices' => array(
				'none' => esc_html__('None','astrostar'),
				'capitalize' => esc_html__('Capitalize','astrostar'),
				'uppercase' => esc_html__('Uppercase','astrostar'),
				'lowercase' => esc_html__('Lowercase','astrostar'),
				)
	));	
	$wp_customize->add_setting('wpdevart_astrostar_main_container_heading_h3_font_decoration',array(
		'default'	=> esc_html('none'),
		'sanitize_callback'	=> 'wpdevart_astrostar_text_sanitization'
	));
	$wp_customize->add_control('wpdevart_astrostar_main_container_heading_h3_font_decoration',array(
			'label'	=> esc_html__('Heading H3 font decoration','astrostar'),
			'section'	=> 'wpdevart_astrostar_text_h1_h2_h3_h4_h5_h6_typography_settings',
			'setting'	=> 'wpdevart_astrostar_main_container_heading_h3_font_decoration',
			'type' => 'select',
			'choices' => array(
				'none' => esc_html__('None','astrostar'),
				'underline' => esc_html__('Underline','astrostar'),
				'line-through' => esc_html__('Line-through','astrostar'),
				'overline' => esc_html__('Overline','astrostar'),
				)
	));	

	##################------ Typography H4 ------##################

    $wp_customize->add_setting( 'wpdevart_astrostar_main_container_heading_h4_font_size',
    array(
       'default' => esc_html('23'),
       'sanitize_callback' => 'wpdevart_astrostar_sanitize_integer'
		)
	);
	$wp_customize->add_control( new Wpdevart_Slider_Custom_Control( $wp_customize, 'wpdevart_astrostar_main_container_heading_h4_font_size',
		array(
		'label' => esc_html__( 'Heading H4 font-size (px)', 'astrostar' ),
		'section' => 'wpdevart_astrostar_text_h1_h2_h3_h4_h5_h6_typography_settings',
		'input_attrs' => array(
			'min' => esc_html('15'),
			'max' => esc_html('60'),
			'step' => esc_html('1'),
		),
		)
	) );
	$wp_customize->add_setting('wpdevart_astrostar_main_container_heading_h4_font_weight',array(
		'default'	=> esc_html('400'),
		'sanitize_callback'	=> 'wpdevart_astrostar_text_sanitization'	
	));
	$wp_customize->add_control('wpdevart_astrostar_main_container_heading_h4_font_weight',array(
			'label'	=> esc_html__('Heading H4 font weight','astrostar'),
			'section'	=> 'wpdevart_astrostar_text_h1_h2_h3_h4_h5_h6_typography_settings',
			'setting'	=> 'wpdevart_astrostar_main_container_heading_h4_font_weight',
			'type' => 'select',
			'choices' => array(
				'100' => esc_html__('Thin 100','astrostar'),
				'400' => esc_html__('Normal 400','astrostar'),
				'600' => esc_html__('Semi-Bold 600','astrostar'),
				'800' => esc_html__('Extra-Bold 800','astrostar'),
				)
	));	
	$wp_customize->add_setting('wpdevart_astrostar_main_container_heading_h4_font_style',array(
		'default'	=> esc_html('normal'),
		'sanitize_callback'	=> 'wpdevart_astrostar_text_sanitization'
	));
	$wp_customize->add_control('wpdevart_astrostar_main_container_heading_h4_font_style',array(
			'label'	=> esc_html__('Heading H4 font style','astrostar'),
			'section'	=> 'wpdevart_astrostar_text_h1_h2_h3_h4_h5_h6_typography_settings',
			'setting'	=> 'wpdevart_astrostar_main_container_heading_h4_font_style',
			'type' => 'select',
			'choices' => array(
				'normal' => esc_html__('Normal','astrostar'),
				'italic' => esc_html__('Italic','astrostar'),
				)
	));	
	$wp_customize->add_setting('wpdevart_astrostar_main_container_heading_h4_font_transform',array(
		'default'	=> esc_html('uppercase'),
		'sanitize_callback'	=> 'wpdevart_astrostar_text_sanitization'
	));
	$wp_customize->add_control('wpdevart_astrostar_main_container_heading_h4_font_transform',array(
			'label'	=> esc_html__('Heading H4 font transform','astrostar'),
			'section'	=> 'wpdevart_astrostar_text_h1_h2_h3_h4_h5_h6_typography_settings',
			'setting'	=> 'wpdevart_astrostar_main_container_heading_h4_font_transform',
			'type' => 'select',
			'choices' => array(
				'none' => esc_html__('None','astrostar'),
				'capitalize' => esc_html__('Capitalize','astrostar'),
				'uppercase' => esc_html__('Uppercase','astrostar'),
				'lowercase' => esc_html__('Lowercase','astrostar'),
				)
	));	
	$wp_customize->add_setting('wpdevart_astrostar_main_container_heading_h4_font_decoration',array(
		'default'	=> esc_html('none'),
		'sanitize_callback'	=> 'wpdevart_astrostar_text_sanitization'
	));
	$wp_customize->add_control('wpdevart_astrostar_main_container_heading_h4_font_decoration',array(
			'label'	=> esc_html__('Heading H4 font decoration','astrostar'),
			'section'	=> 'wpdevart_astrostar_text_h1_h2_h3_h4_h5_h6_typography_settings',
			'setting'	=> 'wpdevart_astrostar_main_container_heading_h4_font_decoration',
			'type' => 'select',
			'choices' => array(
				'none' => esc_html__('None','astrostar'),
				'underline' => esc_html__('Underline','astrostar'),
				'line-through' => esc_html__('Line-through','astrostar'),
				'overline' => esc_html__('Overline','astrostar'),
				)
	));	

	##################------ Typography H5 ------##################

    $wp_customize->add_setting( 'wpdevart_astrostar_main_container_heading_h5_font_size',
    array(
       'default' => esc_html('22'),
       'sanitize_callback' => 'wpdevart_astrostar_sanitize_integer'
		)
	);
	$wp_customize->add_control( new Wpdevart_Slider_Custom_Control( $wp_customize, 'wpdevart_astrostar_main_container_heading_h5_font_size',
		array(
		'label' => esc_html__( 'Heading H5 font-size (px)', 'astrostar' ),
		'section' => 'wpdevart_astrostar_text_h1_h2_h3_h4_h5_h6_typography_settings',
		'input_attrs' => array(
			'min' => esc_html('15'),
			'max' => esc_html('60'),
			'step' => esc_html('1'),
		),
		)
	) );
	$wp_customize->add_setting('wpdevart_astrostar_main_container_heading_h5_font_weight',array(
		'default'	=> esc_html('400'),
		'sanitize_callback'	=> 'wpdevart_astrostar_text_sanitization'	
	));
	$wp_customize->add_control('wpdevart_astrostar_main_container_heading_h5_font_weight',array(
			'label'	=> esc_html__('Heading H5 font weight','astrostar'),
			'section'	=> 'wpdevart_astrostar_text_h1_h2_h3_h4_h5_h6_typography_settings',
			'setting'	=> 'wpdevart_astrostar_main_container_heading_h5_font_weight',
			'type' => 'select',
			'choices' => array(
				'100' => esc_html__('Thin 100','astrostar'),
				'400' => esc_html__('Normal 400','astrostar'),
				'600' => esc_html__('Semi-Bold 600','astrostar'),
				'800' => esc_html__('Extra-Bold 800','astrostar'),
				)
	));	
	$wp_customize->add_setting('wpdevart_astrostar_main_container_heading_h5_font_style',array(
		'default'	=> esc_html('normal'),
		'sanitize_callback'	=> 'wpdevart_astrostar_text_sanitization'
	));
	$wp_customize->add_control('wpdevart_astrostar_main_container_heading_h5_font_style',array(
			'label'	=> esc_html__('Heading H5 font style','astrostar'),
			'section'	=> 'wpdevart_astrostar_text_h1_h2_h3_h4_h5_h6_typography_settings',
			'setting'	=> 'wpdevart_astrostar_main_container_heading_h5_font_style',
			'type' => 'select',
			'choices' => array(
				'normal' => esc_html__('Normal','astrostar'),
				'italic' => esc_html__('Italic','astrostar'),
				)
	));	
	$wp_customize->add_setting('wpdevart_astrostar_main_container_heading_h5_font_transform',array(
		'default'	=> esc_html('uppercase'),
		'sanitize_callback'	=> 'wpdevart_astrostar_text_sanitization'
	));
	$wp_customize->add_control('wpdevart_astrostar_main_container_heading_h5_font_transform',array(
			'label'	=> esc_html__('Heading H5 font transform','astrostar'),
			'section'	=> 'wpdevart_astrostar_text_h1_h2_h3_h4_h5_h6_typography_settings',
			'setting'	=> 'wpdevart_astrostar_main_container_heading_h5_font_transform',
			'type' => 'select',
			'choices' => array(
				'none' => esc_html__('None','astrostar'),
				'capitalize' => esc_html__('Capitalize','astrostar'),
				'uppercase' => esc_html__('Uppercase','astrostar'),
				'lowercase' => esc_html__('Lowercase','astrostar'),
				)
	));	
	$wp_customize->add_setting('wpdevart_astrostar_main_container_heading_h5_font_decoration',array(
		'default'	=> esc_html('none'),
		'sanitize_callback'	=> 'wpdevart_astrostar_text_sanitization'
	));
	$wp_customize->add_control('wpdevart_astrostar_main_container_heading_h5_font_decoration',array(
			'label'	=> esc_html__('Heading H5 font decoration','astrostar'),
			'section'	=> 'wpdevart_astrostar_text_h1_h2_h3_h4_h5_h6_typography_settings',
			'setting'	=> 'wpdevart_astrostar_main_container_heading_h5_font_decoration',
			'type' => 'select',
			'choices' => array(
				'none' => esc_html__('None','astrostar'),
				'underline' => esc_html__('Underline','astrostar'),
				'line-through' => esc_html__('Line-through','astrostar'),
				'overline' => esc_html__('Overline','astrostar'),
				)
	));	

	##################------ Typography H6 ------##################

    $wp_customize->add_setting( 'wpdevart_astrostar_main_container_heading_h6_font_size',
    array(
       'default' => esc_html('20'),
       'sanitize_callback' => 'wpdevart_astrostar_sanitize_integer'
		)
	);
	$wp_customize->add_control( new Wpdevart_Slider_Custom_Control( $wp_customize, 'wpdevart_astrostar_main_container_heading_h6_font_size',
		array(
		'label' => esc_html__( 'Heading H6 font-size (px)', 'astrostar' ),
		'section' => 'wpdevart_astrostar_text_h1_h2_h3_h4_h5_h6_typography_settings',
		'input_attrs' => array(
			'min' => esc_html('15'),
			'max' => esc_html('60'),
			'step' => esc_html('1'),
		),
		)
	) );
	$wp_customize->add_setting('wpdevart_astrostar_main_container_heading_h6_font_weight',array(
		'default'	=> esc_html('400'),
		'sanitize_callback'	=> 'wpdevart_astrostar_text_sanitization'	
	));
	$wp_customize->add_control('wpdevart_astrostar_main_container_heading_h6_font_weight',array(
			'label'	=> esc_html__('Heading H6 font weight','astrostar'),
			'section'	=> 'wpdevart_astrostar_text_h1_h2_h3_h4_h5_h6_typography_settings',
			'setting'	=> 'wpdevart_astrostar_main_container_heading_h6_font_weight',
			'type' => 'select',
			'choices' => array(
				'100' => esc_html__('Thin 100','astrostar'),
				'400' => esc_html__('Normal 400','astrostar'),
				'600' => esc_html__('Semi-Bold 600','astrostar'),
				'800' => esc_html__('Extra-Bold 800','astrostar'),
				)
	));	
	$wp_customize->add_setting('wpdevart_astrostar_main_container_heading_h6_font_style',array(
		'default'	=> esc_html('normal'),
		'sanitize_callback'	=> 'wpdevart_astrostar_text_sanitization'
	));
	$wp_customize->add_control('wpdevart_astrostar_main_container_heading_h6_font_style',array(
			'label'	=> esc_html__('Heading H6 font style','astrostar'),
			'section'	=> 'wpdevart_astrostar_text_h1_h2_h3_h4_h5_h6_typography_settings',
			'setting'	=> 'wpdevart_astrostar_main_container_heading_h6_font_style',
			'type' => 'select',
			'choices' => array(
				'normal' => esc_html__('Normal','astrostar'),
				'italic' => esc_html__('Italic','astrostar'),
				)
	));	
	$wp_customize->add_setting('wpdevart_astrostar_main_container_heading_h6_font_transform',array(
		'default'	=> esc_html('uppercase'),
		'sanitize_callback'	=> 'wpdevart_astrostar_text_sanitization'
	));
	$wp_customize->add_control('wpdevart_astrostar_main_container_heading_h6_font_transform',array(
			'label'	=> esc_html__('Heading H6 font transform','astrostar'),
			'section'	=> 'wpdevart_astrostar_text_h1_h2_h3_h4_h5_h6_typography_settings',
			'setting'	=> 'wpdevart_astrostar_main_container_heading_h6_font_transform',
			'type' => 'select',
			'choices' => array(
				'none' => esc_html__('None','astrostar'),
				'capitalize' => esc_html__('Capitalize','astrostar'),
				'uppercase' => esc_html__('Uppercase','astrostar'),
				'lowercase' => esc_html__('Lowercase','astrostar'),
				)
	));	
	$wp_customize->add_setting('wpdevart_astrostar_main_container_heading_h6_font_decoration',array(
		'default'	=> esc_html('none'),
		'sanitize_callback'	=> 'wpdevart_astrostar_text_sanitization'
	));
	$wp_customize->add_control('wpdevart_astrostar_main_container_heading_h6_font_decoration',array(
			'label'	=> esc_html__('Heading H6 font decoration','astrostar'),
			'section'	=> 'wpdevart_astrostar_text_h1_h2_h3_h4_h5_h6_typography_settings',
			'setting'	=> 'wpdevart_astrostar_main_container_heading_h6_font_decoration',
			'type' => 'select',
			'choices' => array(
				'none' => esc_html__('None','astrostar'),
				'underline' => esc_html__('Underline','astrostar'),
				'line-through' => esc_html__('Line-through','astrostar'),
				'overline' => esc_html__('Overline','astrostar'),
				)
	));