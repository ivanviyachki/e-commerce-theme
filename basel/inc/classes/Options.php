<?php if ( ! defined( 'BASEL_THEME_DIR' ) ) {
	exit( 'No direct script access allowed' );}

/**
 * Class to work with Theme Options
 * Will modify global $basel_options variable
 */
class BASEL_Options {

	public function __construct() {

		$options = get_option( 'basel_options' );

		if ( ! is_admin() ) {

			add_action( 'wp', array( $this, 'set_custom_meta_for_post' ), 10 );
			add_action( 'wp', array( $this, 'set_options_for_post' ), 20 );
			add_action( 'wp', array( $this, 'specific_options' ), 30 );
			add_action( 'wp', array( $this, 'specific_taxonomy_options' ), 40 );

		}
	}

    /**
     * Specific options
     *
     * @param string $slug
     */
	public function set_options_for_post( $slug = '' ) {
		global $basel_options;

		$custom_options = json_decode( get_post_meta( basel_page_ID(), '_basel_options', true ), true );

		if ( ! empty( $custom_options ) ) {
			$basel_options = wp_parse_args( $custom_options, $basel_options );
		}

		$basel_options = apply_filters( 'basel_global_options', $basel_options );

	}


	/**
	 * [set_custom_meta_for_post description]
	 */
	public function set_custom_meta_for_post( $slug = '' ) {
		global $xts_basel_options, $basel_transfer_options, $basel_prefix;
		if ( ! empty( $basel_transfer_options ) ) {
			foreach ( $basel_transfer_options as $field ) {
				$meta = get_post_meta( basel_page_ID(), $basel_prefix . $field, true );
				if ( isset( $xts_basel_options[ $field ] ) ) {
					$xts_basel_options[ $field ] = ( isset( $meta ) && $meta != '' && $meta != 'inherit' && $meta != 'default' ) ? $meta : $xts_basel_options[ $field ];
				}
			}
		}

	}


	/**
	 * Specific options dependencies
	 */
	public function specific_options( $slug = '' ) {
		global $xts_basel_options;

		$rules = basel_get_config( 'specific-options' );

		foreach ( $rules as $option => $rule ) {
			if ( ! empty( $rule['will-be'] ) && ! isset( $rule['if'] ) ) {
				$xts_basel_options[ $option ] = $rule['will-be'];
			} elseif ( isset( $xts_basel_options[ $rule['if'] ] ) && in_array( $xts_basel_options[ $rule['if'] ], $rule['in_array'] ) ) {
				$xts_basel_options[ $option ] = $rule['will-be'];
			}
		}

	}


	/**
	 * Specific options for taxonomies
	 */
	public function specific_taxonomy_options( $slug = '' ) {
		global $xts_basel_options;

		if ( is_category() ) {
			$option_key       = 'blog_design';
			$category         = get_query_var( 'cat' );
			$current_category = get_category( $category );
			// $current_category->term_id;
			$category_blog_design = get_term_meta( $current_category->term_id, '_basel_' . $option_key, true );

			if ( ! empty( $category_blog_design ) && $category_blog_design != 'inherit' ) {
				$xts_basel_options[ $option_key ] = $category_blog_design;
			}
		}

	}



	/**
	 * Get option from array $basel_options
	 *
	 * @param  String option slug
	 * @return String option value
	 */
	public function get_opt( $slug, $default ) {
		global $basel_options, $xts_basel_options;

		$opt = $default;

		if ( isset( $xts_basel_options[ $slug ] ) ) {
			$opt = $xts_basel_options[ $slug ];
			return $opt;
		}

		if ( isset( $basel_options[ $slug ] ) ) {
			$opt = $basel_options[ $slug ];
			return $opt;
		}

		return $opt;
	}
}

// **********************************************************************//
// ! Function to get option
// **********************************************************************//
if ( ! function_exists( 'basel_get_opt' ) ) {
	function basel_get_opt( $slug = '', $default = false ) {
		return BASEL_Registry::getInstance()->options->get_opt( $slug, $default );
	}
}


