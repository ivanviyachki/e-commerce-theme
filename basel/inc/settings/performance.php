<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Direct access not allowed.
}

use XTS\Options;

/**
 * Performance.
 */
Options::add_section(
	array(
		'id'       => 'performance',
		'name'     => esc_html__( 'Performance', 'basel' ),
		'priority' => 150,
		'icon'     => 'dashicons dashicons-performance',
	)
);

Options::add_field(
	array(
		'id'          => 'minified_css',
		'name'        => esc_html__( 'Include minified CSS', 'basel' ),
		'description' => esc_html__( 'Minified version of style.css file will be loaded (style.min.css)', 'basel' ),
		'type'        => 'switcher',
		'section'     => 'performance',
		'default'     => '1',
		'priority'    => 10,
	)
);

Options::add_field(
	array(
		'id'          => 'minified_js',
		'name'        => esc_html__( 'Include minified JS', 'basel' ),
		'description' => esc_html__( 'Minified version of functions.js file will be loaded', 'basel' ),
		'type'        => 'switcher',
		'section'     => 'performance',
		'default'     => '1',
		'priority'    => 20,
	)
);

Options::add_field(
	array(
		'id'          => 'combined_js',
		'name'        => esc_html__( 'Combine JS files', 'basel' ),
		'description' => esc_html__( 'Combine all third party libraries and theme functions into one JS file (theme.min.js)', 'basel' ),
		'type'        => 'switcher',
		'section'     => 'performance',
		'default'     => false,
		'priority'    => 30,
	)
);

Options::add_field(
	array(
		'id'          => 'google_font_display',
		'name'        => esc_html__( '"font-display" for Google Fonts', 'basel' ),
		'description' => 'You can specify "font-display" property for fonts loaded from Google. Read more information <a href="https://developers.google.com/web/updates/2016/02/font-display">here</a>',
		'type'        => 'select',
		'section'     => 'performance',
		'default'     => 'disable',
		'options'     => array(
			'disable'  => array(
				'name'  => esc_html__( 'Disable', 'basel' ),
				'value' => 'disable',
			),
			'block' => array(
				'name'  => esc_html__( 'Block', 'basel' ),
				'value' => 'block',
			),
			'swap' => array(
				'name'  => esc_html__( 'Swap', 'basel' ),
				'value' => 'swap',
			),
			'fallback' => array(
				'name'  => esc_html__( 'Fallback', 'basel' ),
				'value' => 'fallback',
			),
			'optional' => array(
				'name'  => esc_html__( 'Optional', 'basel' ),
				'value' => 'optional',
			),
		),
		'priority'    => 42,
	)
);

Options::add_field(
	array(
		'id'          => 'icons_font_display',
		'name'        => esc_html__( '"font-display" for icon fonts (not recommended)', 'basel' ),
		'description' => 'You can specify "font-display" property for fonts used for icons in our theme including Font Awesome. Read more information <a href="https://developers.google.com/web/updates/2016/02/font-display">here</a>',
		'type'        => 'select',
		'section'     => 'performance',
		'default'     => 'disable',
		'options'     => array(
			'disable'  => array(
				'name'  => esc_html__( 'Disable', 'basel' ),
				'value' => 'disable',
			),
			'block' => array(
				'name'  => esc_html__( 'Block', 'basel' ),
				'value' => 'block',
			),
			'swap' => array(
				'name'  => esc_html__( 'Swap', 'basel' ),
				'value' => 'swap',
			),
			'fallback' => array(
				'name'  => esc_html__( 'Fallback', 'basel' ),
				'value' => 'fallback',
			),
			'optional' => array(
				'name'  => esc_html__( 'Optional', 'basel' ),
				'value' => 'optional',
			),
		),
		'priority'    => 43,
	)
);

Options::add_field(
	array(
		'id'          => 'disable_gutenberg_css',
		'name'        => esc_html__( 'Disable Gutenberg styles', 'basel' ),
		'description' => esc_html__( 'If you are not using Gutenberg elements you will not need these files to be loaded.', 'basel' ),
		'type'        => 'switcher',
		'section'     => 'performance',
		'default'     => false,
		'priority'    => 45,
	)
);

Options::add_field(
	array(
		'id'          => 'lazy_loading',
		'name'        => esc_html__( 'Lazy loading for images', 'basel' ),
		'description' => esc_html__( 'Enable this option to optimize your images loading on the website. They will be loaded only when user will scroll the page.', 'basel' ),
		'group'       => esc_html__( 'Lazy loading options', 'basel' ),
		'type'        => 'switcher',
		'section'     => 'performance',
		'default'     => false,
		'priority'    => 50,
	)
);

Options::add_field(
	array(
		'id'          => 'lazy_loading_offset',
		'name'        => esc_html__( 'Offset', 'basel' ),
		'description' => esc_html__( 'Start load images X pixels before the page is scrolled to the item', 'basel' ),
		'group'       => esc_html__( 'Lazy loading options', 'basel' ),
		'type'        => 'range',
		'section'     => 'performance',
		'default'     => 0,
		'min'         => 0,
		'step'        => 10,
		'max'         => 1000,
		'priority'    => 60,
	)
);

Options::add_field(
	array(
		'id'          => 'lazy_effect',
		'name'        => esc_html__( 'Appearance effect', 'basel' ),
		'description' => esc_html__( 'When enabled, your images will be replaced with their blurred small previews. And when the visitor will scroll the page to that image, it will be replaced with an original image.', 'basel' ),
		'group'       => esc_html__( 'Lazy loading options', 'basel' ),
		'type'        => 'buttons',
		'section'     => 'performance',
		'default'     => 'fade',
		'options'     => array(
			'fade' => array(
				'name'  => esc_html__( 'Fade', 'basel' ),
				'value' => 'fade',
			),
			'blur' => array(
				'name'  => esc_html__( 'Blur', 'basel' ),
				'value' => 'blur',
			),
			'none' => array(
				'name'  => esc_html__( 'None', 'basel' ),
				'value' => 'none',
			),
		),
		'priority'    => 70,
	)
);

Options::add_field(
	array(
		'id'          => 'lazy_generate_previews',
		'name'        => esc_html__( 'Generate previews', 'basel' ),
		'description' => esc_html__( 'Create placeholders previews as miniatures from the original images.', 'basel' ),
		'group'       => esc_html__( 'Lazy loading options', 'basel' ),
		'type'        => 'switcher',
		'section'     => 'performance',
		'default'     => '1',
		'priority'    => 80,
	)
);

Options::add_field(
	array(
		'id'          => 'lazy_base_64',
		'name'        => esc_html__( 'Base 64 encode for placeholders', 'basel' ),
		'description' => esc_html__( 'This option allows you to decrease a number of HTTP requests replacing images with base 64 encoded sources.', 'basel' ),
		'group'       => esc_html__( 'Lazy loading options', 'basel' ),
		'type'        => 'switcher',
		'section'     => 'performance',
		'default'     => '1',
		'priority'    => 90,
	)
);

Options::add_field(
	array(
		'id'          => 'lazy_proprtion_size',
		'name'        => esc_html__( 'Proportional placeholders size', 'basel' ),
		'description' => esc_html__( 'Will generate proportional image size for the placeholder based on original image size.', 'basel' ),
		'group'       => esc_html__( 'Lazy loading options', 'basel' ),
		'type'        => 'switcher',
		'section'     => 'performance',
		'default'     => '1',
		'priority'    => 100,
	)
);

Options::add_field(
	array(
		'id'          => 'lazy_custom_placeholder',
		'name'        => esc_html__( 'Upload custom placeholder image', 'basel' ),
		'description' => esc_html__( 'Add your custom image placeholder that will be used before the original image will be loaded.', 'basel' ),
		'group'       => esc_html__( 'Lazy loading options', 'basel' ),
		'type'        => 'upload',
		'section'     => 'performance',
		'priority'    => 110,
	)
);
