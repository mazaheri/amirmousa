<?php
/**
 * S-Prestige International — theme functions.
 *
 * @package S_Prestige
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'SPR_VERSION', '1.0.0' );

/**
 * Theme setup.
 */
function spr_setup() {
	load_theme_textdomain( 's-prestige', get_template_directory() . '/languages' );

	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ) );
	add_theme_support( 'responsive-embeds' );
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 60,
			'width'       => 200,
			'flex-height' => true,
			'flex-width'  => true,
		)
	);

	register_nav_menus(
		array(
			'primary' => __( 'Primary Menu', 's-prestige' ),
			'footer'  => __( 'Footer Menu', 's-prestige' ),
		)
	);
}
add_action( 'after_setup_theme', 'spr_setup' );

/**
 * Enqueue styles and scripts.
 */
function spr_enqueue_assets() {
	// Inter from Google Fonts (matches the prototype).
	wp_enqueue_style(
		'spr-inter',
		'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap',
		array(),
		null
	);

	// Consolidated component styles (tokens, classes, media queries).
	wp_enqueue_style(
		'spr-theme',
		get_template_directory_uri() . '/assets/css/theme.css',
		array( 'spr-inter' ),
		SPR_VERSION
	);

	// style.css last so future hand-overrides win the cascade.
	wp_enqueue_style(
		'spr-style',
		get_stylesheet_uri(),
		array( 'spr-theme' ),
		SPR_VERSION
	);

	// Front-end interactions (FAQ accordion, back-to-top).
	wp_enqueue_script(
		'spr-theme',
		get_template_directory_uri() . '/assets/js/theme.js',
		array(),
		SPR_VERSION,
		true
	);
}
add_action( 'wp_enqueue_scripts', 'spr_enqueue_assets' );

/**
 * Helpers, Customizer, and the Import & Sync admin page.
 */
require get_template_directory() . '/inc/helpers.php';
require get_template_directory() . '/inc/customizer.php';
if ( is_admin() ) {
	require get_template_directory() . '/inc/demo-importer.php';
}

/**
 * Small front-end touch-ups.
 */
remove_action( 'wp_head', 'wp_generator' );

/**
 * Allow webp/mp4 uploads through the importer's mime checks (Studio is permissive,
 * but be explicit so production cPanel hosts behave the same).
 */
function spr_mime_types( $mimes ) {
	$mimes['webp'] = 'image/webp';
	$mimes['mp4']  = 'video/mp4';
	return $mimes;
}
add_filter( 'upload_mimes', 'spr_mime_types' );
