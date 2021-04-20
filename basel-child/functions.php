<?php

add_action( 'wp_enqueue_scripts', 'basel_child_enqueue_styles', 1000 );

function basel_child_enqueue_styles() {
	$version = basel_get_theme_info( 'Version' );
	
	if( basel_get_opt( 'minified_css' ) ) {
		wp_enqueue_style( 'basel-style', get_template_directory_uri() . '/style.min.css', array('bootstrap'), $version );
	} else {
		wp_enqueue_style( 'basel-style', get_template_directory_uri() . '/style.css', array('bootstrap'), $version );
	}
	
    wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css', array('bootstrap'), $version );

    wp_enqueue_style('custom-css', get_stylesheet_directory_uri() . '/assets/css/theme.min.css' );
}


/**
 * Include file with overwritten function for child theme
 */
include( get_stylesheet_directory() . '/include/functions-overwriting.php');

/**
 * Class responsible for Global settings
 */
require get_stylesheet_directory() . '/classes/class-global-settings.php';

/**
 * Class responsible for WooCommerce functions
 */
require get_stylesheet_directory() . '/classes/class-woocommerce.php';