<?php
/**
 * West Michigan Art Therapy — theme functions.
 *
 * Block theme: most configuration lives in theme.json. This file handles the
 * few things PHP still owns — enqueuing the global stylesheet, editor styles,
 * and registering a pattern category for our custom block patterns.
 *
 * @package wmat
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // No direct access.
}

if ( ! function_exists( 'wmat_setup' ) ) {
	/**
	 * Theme setup.
	 */
	function wmat_setup() {
		// Make the editor use our front-end stylesheet too.
		add_editor_style( 'style.css' );

		// Enable responsive embeds and HTML5 markup niceties.
		add_theme_support( 'responsive-embeds' );
		add_theme_support( 'editor-styles' );
		add_theme_support( 'html5', array( 'style', 'script', 'navigation-widgets' ) );

		// Translations.
		load_theme_textdomain( 'wmat', get_template_directory() . '/languages' );
	}
}
add_action( 'after_setup_theme', 'wmat_setup' );

if ( ! function_exists( 'wmat_enqueue_assets' ) ) {
	/**
	 * Enqueue the global stylesheet on the front end.
	 *
	 * Block themes do not load style.css automatically, so we enqueue it here.
	 */
	function wmat_enqueue_assets() {
		wp_enqueue_style(
			'wmat-style',
			get_stylesheet_uri(),
			array(),
			wp_get_theme()->get( 'Version' )
		);
	}
}
add_action( 'wp_enqueue_scripts', 'wmat_enqueue_assets' );

if ( ! function_exists( 'wmat_register_pattern_category' ) ) {
	/**
	 * Register a dedicated category so our patterns are grouped in the inserter.
	 */
	function wmat_register_pattern_category() {
		register_block_pattern_category(
			'wmat',
			array(
				'label'       => __( 'West Michigan Art Therapy', 'wmat' ),
				'description' => __( 'Reusable sections for the WMAT site.', 'wmat' ),
			)
		);
	}
}
add_action( 'init', 'wmat_register_pattern_category' );
