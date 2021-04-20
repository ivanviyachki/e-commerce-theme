<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

class WGS_WooCommerce
{
    /** @var null| WGS_WooCommerce */
    protected static $instance = null;

    public function __construct()
    {
        add_action('woocommerce_after_shop_loop', array( $this, 'output_shortcode_after_main_loop' ) );

        //add_action('woocommerce_product_meta_start', array( $this, 'output_shortcode_after_add' ) );
    }

    /**
     * Returns class instance
     *
     * @return WGS_WooCommerce|null
     */
    public static function getInstance()
    {
        if ( self::$instance == null ) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * Function out after main loop
     *
     * @param $fields
     *
     */
    public function output_shortcode_after_main_loop()
    {
        echo do_shortcode( '[html_block id="18468"]' );
    }

    /**
     * Function out custom buttons
     *
     * @param $fields
     *
     */
    public function output_shortcode_after_add()
    {
        echo do_shortcode( '[html_block id="18499"]' );
    }
}

$wgs_woocommerce = WGS_WooCommerce::getInstance();