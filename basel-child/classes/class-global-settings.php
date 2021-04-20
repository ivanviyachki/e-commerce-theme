<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

class WGS_Global_Settings
{
    /** @var null|WGS_Global_Settings */
    protected static $instance = null;

    public function __construct()
    {
        add_filter('comment_form_default_fields', array( $this, 'unset_url_field' ) );

        add_filter( 'comment_form_fields', array( $this , 'comment_field_change' ) );
    }

    /**
     * Returns class instance
     *
     * @return WGS_Global_Settings|null
     */
    public static function getInstance()
    {
        if ( self::$instance == null ) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * Function unset comment site URL
     *
     * @param $fields
     *
     * @return array
     */
    public function unset_url_field( $fields )
    {
        if( isset( $fields['url'] ) )
        {
            unset( $fields['url'] );
        }

        return $fields;
    }

    /**
     * Function move comment filed in bottom
     *
     * @return array
     */
    public function comment_field_change( $old_fields )
    {
        $fields['author'] = '<p class="comment-form-author"><label for="author">Вашето име<span class="required">*</span></label> <input id="author" name="author" type="text" value="" size="30" maxlength="245" required="required" /></p>';
        $fields['email'] = '<p class="comment-form-email"><label for="email">Имейл адрес<span class="required">*</span></label> <input id="email" name="email" type="text" value="" size="30" maxlength="100" aria-describedby="email-notes" required="required" /></p>';
        $fields['comment'] = $old_fields['comment'];
        $fields['cookies'] = '<p class="comment-form-cookies-consent"><input id="wp-comment-cookies-consent" name="wp-comment-cookies-consent" type="checkbox" value="yes" /> <label for="wp-comment-cookies-consent">Публикувайки мнение в блога на Arreda, вие приемате условията за използване на сайта и потвърждавате, че сте запознати с Правилата за ползване на сайта на Arreda.bg</label></p>';

        return $fields;
    }
}

$wgs_acf_options = WGS_Global_Settings::getInstance();