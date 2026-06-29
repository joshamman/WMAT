<?php

##################------ Pro Button Section ------##################
	$wp_customize->register_section_type( 'wpdevart_astrostar_Section_Premium' );

	$wp_customize->add_section(
		new wpdevart_astrostar_Section_Premium(
			$wp_customize,
			'theme_upsell',
			array(
				'title'    => esc_html__('AstroStar','astrostar'),
				'pro_text' => esc_html__('Premium','astrostar'),
				'pro_url'  => apply_filters( 'parent_wpdevart_astrostar_premium_features_url', esc_url('https://wpdevart.com/astrostar-wordpress-astrology-theme')),
				'priority'  => 10,
			)
		)
	);