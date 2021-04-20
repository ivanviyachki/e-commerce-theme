<?php if ( ! defined( 'BASEL_THEME_DIR' ) ) {
	exit( 'No direct script access allowed' );
}
use XTS\Options;

/**
 * General
 */
Options::add_section(
	array(
		'id'       => 'page_title_section',
		'name'     => esc_html__( 'Page title', 'basel' ),
		'priority' => 30,
		'icon'     => 'dashicons dashicons-schedule',
	)
);

Options::add_field(
	array(
		'id'          => 'page-title-design',
		'name'        => esc_html__( 'Page title design', 'basel' ),
		'description' => esc_html__( 'Select page title section design or disable it completely on all pages.', 'basel' ),
		'type'        => 'buttons',
		'section'     => 'page_title_section',
		'options'     => array(
			'default'  => array(
				'name'  => esc_html__( 'Default', 'basel' ),
				'value' => 'default',
			),
			'centered' => array(
				'name'  => esc_html__( 'Centered', 'basel' ),
				'value' => 'centered',
			),
			'disable'  => array(
				'name'  => esc_html__( 'Disable', 'basel' ),
				'value' => 'disable',
			),
		),
		'default'     => 'centered',
		'tags'        => 'page heading title design',
		'priority'    => 10,
	)
);

Options::add_field(
	array(
		'id'          => 'breadcrumbs',
		'section'     => 'page_title_section',
		'name'        => esc_html__( 'Show breadcrumbs', 'basel' ),
		'description' => esc_html__( 'Displays a full chain of links to the current page.', 'basel' ),
		'type'        => 'switcher',
		'default'     => '1',
		'priority'    => 20,
	)
);

Options::add_field(
	array(
		'id'          => 'yoast_shop_breadcrumbs',
		'section'     => 'page_title_section',
		'name'        => esc_html__( 'Yoast breadcrumbs for shop', 'basel' ),
		'description' => esc_html__( 'Requires Yoast SEO plugin to be installed. Replaces standard WooCommerce breadcrumbs with custom that come with the plugin. You need to enable and configure it in Dashboard -> SEO -> Search Appearance -> Breadcrumbs.', 'basel' ),
		'type'        => 'switcher',
		'default'     => false,
		'priority'    => 30,
	)
);

Options::add_field(
	array(
		'id'          => 'yoast_pages_breadcrumbs',
		'section'     => 'page_title_section',
		'name'        => esc_html__( 'Yoast breadcrumbs for pages', 'basel' ),
		'description' => esc_html__( 'Requires Yoast SEO plugin to be installed. Replaces standard WooCommerce breadcrumbs with custom that come with the plugin. You need to enable and configure it in Dashboard -> SEO -> Search Appearance -> Breadcrumbs.', 'basel' ),
		'type'        => 'switcher',
		'default'     => false,
		'priority'    => 40,
	)
);

Options::add_field(
	array(
		'id'          => 'title-background',
		'name'        => esc_html__( 'Pages title background', 'basel' ),
		'description' => esc_html__( 'Set background image or color, that will be used as a default for all page titles, shop page and blog.', 'basel' ),
		'type'        => 'background',
		'default'     => array(
			'color'    => '#212121',
			'position' => 'center center',
			'size'     => 'cover',
		),
		'section'     => 'page_title_section',
		'selector'    => '.page-title-default',
		'tags'        => 'page title color page title background',
		'priority'    => 50,
	)
);

Options::add_field(
	array(
		'id'          => 'page-title-size',
		'name'        => esc_html__( 'Page title size' ),
		'description' => esc_html__( 'You can set different sizes for your pages titles', 'basel' ),
		'type'        => 'buttons',
		'section'     => 'page_title_section',
		'options'     => array(
			'default' => array(
				'name'  => esc_html__( 'Default', 'basel' ),
				'value' => 'default',
			),
			'small'   => array(
				'name'  => esc_html__( 'Small', 'basel' ),
				'value' => 'small',
			),
			'large'   => array(
				'name'  => esc_html__( 'Large', 'basel' ),
				'value' => 'large',
			),
		),
		'default'     => 'small',
		'tags'        => 'page heading title size breadcrumbs size',
		'priority'    => 60,
	)
);

Options::add_field(
	array(
		'id'          => 'page-title-color',
		'name'        => esc_html__( 'Text color for page title', 'basel' ),
		'description' => esc_html__( 'You can set different colors depending on it\'s background. May be light or dark', 'basel' ),
		'type'        => 'buttons',
		'section'     => 'page_title_section',
		'options'     => array(
			'default' => array(
				'name'  => esc_html__( 'Default', 'basel' ),
				'value' => 'default',
			),
			'light'   => array(
				'name'  => esc_html__( 'Light', 'basel' ),
				'value' => 'light',
			),
			'dark'    => array(
				'name'  => esc_html__( 'Dark', 'basel' ),
				'value' => 'dark',
			),
		),
		'default'     => 'light',
		'priority'    => 70,
	)
);




