<?php

function projecttheme_tinymce_buttons( $buttons ) {
	if ( ! in_array( 'styleselect', $buttons, true ) ) {
		$buttons[] = 'styleselect';
	}

	return $buttons;
}
add_filter( 'mce_buttons_2', 'projecttheme_tinymce_buttons' );

function projecttheme_tinymce_formats( $init ) {
	$style_formats = array(
		array(
			'title'    => __( 'Button primär', 'textdomaintomodify' ),
			'selector' => 'a',
			'classes'  => 'btn btn-primary',
		),
		array(
			'title'    => __( 'Button sekundär', 'textdomaintomodify' ),
			'selector' => 'a',
			'classes'  => 'btn btn-secondary',
		),
	);

	$init['style_formats']       = wp_json_encode( $style_formats );
	$init['style_formats_merge'] = true;

	return $init;
}
add_filter( 'tiny_mce_before_init', 'projecttheme_tinymce_formats' );

function projecttheme_add_editor_styles() {
	add_editor_style( 'assets/css/bootstrap.min.css' );
	add_editor_style( 'assets/css/theme.css' );
}
add_action( 'after_setup_theme', 'projecttheme_add_editor_styles', 20 );
