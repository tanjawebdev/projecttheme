<?php

/**
 * Enqueue the theme's directly editable CSS and JavaScript files.
 */
function projecttheme_enqueue_assets() {
	$theme_path = get_template_directory();
	$theme_uri  = get_template_directory_uri();

	$bootstrap_css = $theme_path . '/assets/css/bootstrap.min.css';
	$bootstrap_js  = $theme_path . '/assets/js/bootstrap.bundle.min.js';
	$theme_css     = $theme_path . '/assets/css/theme.css';
	$theme_js      = $theme_path . '/assets/js/main.js';
	$theme_styles  = glob( $theme_path . '/assets/css/*.css' );
	$theme_version = $theme_css && file_exists( $theme_css ) ? filemtime( $theme_css ) : null;

	if ( $theme_styles ) {
		$theme_version = max( array_map( 'filemtime', $theme_styles ) );
	}

	wp_enqueue_style(
		'projecttheme-bootstrap-style',
		$theme_uri . '/assets/css/bootstrap.min.css',
		array(),
		file_exists( $bootstrap_css ) ? filemtime( $bootstrap_css ) : null
	);

	wp_enqueue_style(
		'projecttheme-theme',
		$theme_uri . '/assets/css/theme.css',
		array( 'projecttheme-bootstrap-style' ),
		$theme_version
	);

	wp_enqueue_script(
		'projecttheme-bootstrap-script',
		$theme_uri . '/assets/js/bootstrap.bundle.min.js',
		array(),
		file_exists( $bootstrap_js ) ? filemtime( $bootstrap_js ) : null,
		true
	);

	wp_register_script(
		'projecttheme-main',
		$theme_uri . '/assets/js/main.js',
		array( 'projecttheme-bootstrap-script' ),
		file_exists( $theme_js ) ? filemtime( $theme_js ) : null,
		true
	);

	wp_localize_script(
		'projecttheme-main',
		'siteVars',
		array(
			// 'ajaxUrl' => admin_url( 'admin-ajax.php' ),
		)
	);

	wp_enqueue_script( 'projecttheme-main' );
}
add_action( 'wp_enqueue_scripts', 'projecttheme_enqueue_assets', 10 );

function projecttheme_main_script_as_module( $tag, $handle, $src ) {
	if ( 'projecttheme-main' !== $handle ) {
		return $tag;
	}

	return '<script type="module" src="' . esc_url( $src ) . '"></script>';
}
add_filter( 'script_loader_tag', 'projecttheme_main_script_as_module', 10, 3 );

function cleaning_wordpress() {
	// removing all WP css files enqueued by default
	wp_dequeue_style( 'wp-block-library' );
	wp_dequeue_style( 'wp-block-library-theme' );
	wp_dequeue_style( 'wc-block-style' );
	wp_dequeue_style( 'global-styles' );
	wp_dequeue_style( 'classic-theme-styles' );
}
add_action( 'wp_enqueue_scripts', 'cleaning_wordpress', 100 );
