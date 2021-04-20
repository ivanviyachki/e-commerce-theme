<?php
if( ! function_exists( 'basel_page_title' ) ) {

    add_action( 'basel_after_header', 'basel_page_title', 10 );

    function basel_page_title() {
        global $wp_query, $post;

        // Remove page title for dokan store list page

        if( function_exists( 'dokan_is_store_page' )  && dokan_is_store_page() ) {
            return '';
        }

        $page_id = 0;

        $disable     = false;
        $page_title  = true;
        $breadcrumbs = basel_get_opt( 'breadcrumbs' );

        $image = '';

        $style = '';

        $page_for_posts    = get_option( 'page_for_posts' );
        $page_for_shop     = get_option( 'woocommerce_shop_page_id' );
        $page_for_projects = basel_tpl2id( 'portfolio.php' );

        $title_class = 'page-title-';

        $title_color = $title_type = $title_size = 'default';

        // Get default styles from Options Panel
        $title_design = basel_get_opt( 'page-title-design' );

        $title_size = basel_get_opt( 'page-title-size' );

        $title_color = basel_get_opt( 'page-title-color' );

        $shop_title = basel_get_opt( 'shop_title' );

        $shop_categories = basel_get_opt( 'shop_categories' );

        $single_post_design = basel_get_opt( 'single_post_design' );

        // Set here page ID. Will be used to get custom value from metabox of specific PAGE | BLOG PAGE | SHOP PAGE.
        $page_id = basel_page_ID();


        if( $page_id != 0 ) {
            // Get meta value for specific page id
            $disable = get_post_meta( $page_id, '_basel_title_off', true );

            $image = get_post_meta( $page_id, '_basel_title_image', true );

            $custom_title_color = get_post_meta( $page_id, '_basel_title_color', true );
            $custom_title_bg_color = get_post_meta( $page_id, '_basel_title_bg_color', true );


            if( $image != '' ) {
                $style .= "background-image: url(" . $image . ");";
            }

            if( $custom_title_bg_color != '' ) {
                $style .= "background-color: " . $custom_title_bg_color . ";";
            }

            if( $custom_title_color != '' && $custom_title_color != 'default' ) {
                $title_color = $custom_title_color;
            }
        }

        if( $title_design == 'disable' ) $page_title = false;

        if( ! $page_title && ! $breadcrumbs ) $disable = true;

        if ( is_single() && $single_post_design == 'large_image' ) $disable = false;

        if( $disable ) return;

        $title_class .= $title_type;
        $title_class .= ' title-size-'  . $title_size;
        $title_class .= ' title-design-' . $title_design;

        if ( $single_post_design == 'large_image' && is_single() ) {
            $title_class .= ' color-scheme-light';
        }else{
            $title_class .= ' color-scheme-' . $title_color;
        }

        if ( $single_post_design == 'large_image' && is_singular( 'post' ) ) {
            $image_url = get_the_post_thumbnail_url( $page_id );
            if ( $image_url && ! $style ) $style .= "background-image: url(" . $image_url . ");";
            $title_class .= ' post-title-large-image';

            ?>
            <div class="page-title <?php echo esc_attr( $title_class ); ?>" style="<?php echo esc_attr( $style ); ?>">
                <div class="container">
                    <header class="entry-header">
                        <?php if ( get_the_category_list( ', ' ) ): ?>
                            <div class="meta-post-categories"><?php echo get_the_category_list( ', ' ); ?></div>
                        <?php endif ?>

                        <h1 class="entry-title"><?php the_title(); ?></h1>

                        <div class="entry-meta basel-entry-meta">
                            <?php basel_post_meta(array(
                                'labels' => 1,
                                'author' => 1,
                                'author_ava' => 1,
                                'date' => 1,
                                'edit' => 0,
                                'comments' => 1,
                                'short_labels' => 0
                            )); ?>
                        </div>
                    </header>
                </div>
            </div>
            <?php
            return;
        }

        // Heading for pages
        if( is_singular( 'page' ) && ( ! $page_for_posts || ! is_page( $page_for_posts ) ) ):
            $title = get_the_title();

            ?>

            <div class="single-breadcrumbs-wrapper">
                <div class="container">
                    <?php basel_current_breadcrumbs( 'shop' ); ?>
                    <?php if ( ! basel_get_opt( 'hide_products_nav' ) ): ?>
                        <?php basel_products_nav(); ?>
                    <?php endif ?>
                </div>
            </div>
            <div class="page-title <?php echo esc_attr( $title_class ); ?>" style="<?php echo esc_attr( $style ); ?>">
                <div class="container">
                    <header class="entry-header">
                        <?php if( $page_title ): ?><h1 class="entry-title"><?php echo esc_html( $title ); ?></h1><?php endif; ?>
                    </header><!-- .entry-header -->
                </div>
            </div>
            <?php
            return;
        endif;


        // Heading for blog and archives
        if( is_singular( 'post' ) || basel_is_blog_archive() ):

            $title = ( ! empty( $page_for_posts ) ) ? get_the_title( $page_for_posts ) : esc_html__( 'Blog', 'basel' );

            if( is_tag() ) {
                $title = esc_html__( 'Tag Archives: ', 'basel')  . single_tag_title( '', false ) ;
            }

            if( is_category() ) {
                $title = '<span>' . single_cat_title( '', false ) . '</span>'; //esc_html__( 'Category Archives: ', 'basel') .
            }

            if( is_date() ) {
                if ( is_day() ) :
                    $title = esc_html__( 'Daily Archives: ', 'basel') . get_the_date();
                elseif ( is_month() ) :
                    $title = esc_html__( 'Monthly Archives: ', 'basel') . get_the_date( _x( 'F Y', 'monthly archives date format', 'basel' ) );
                elseif ( is_year() ) :
                    $title = esc_html__( 'Yearly Archives: ', 'basel') . get_the_date( _x( 'Y', 'yearly archives date format', 'basel' ) );
                else :
                    $title = esc_html__( 'Archives', 'basel' );
                endif;
            }

            if ( is_author() ) {
                /*
                 * Queue the first post, that way we know what author
                 * we're dealing with (if that is the case).
                 *
                 * We reset this later so we can run the loop
                 * properly with a call to rewind_posts().
                 */
                the_post();

                $title = esc_html__( 'Posts by ', 'basel' ) . '<span class="vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '" title="' . esc_attr( get_the_author() ) . '" rel="me">' . get_the_author() . '</a></span>';

                /*
                 * Since we called the_post() above, we need to
                 * rewind the loop back to the beginning that way
                 * we can run the loop properly, in full.
                 */
                rewind_posts();
            }

            if( is_search() ) {
                $title = esc_html__( 'Search Results for: ', 'basel' ) . get_search_query();
            }

            ?>
            <div class="single-breadcrumbs-wrapper">
                <div class="container">
                    <?php basel_current_breadcrumbs( 'shop' ); ?>
                    <?php if ( ! basel_get_opt( 'hide_products_nav' ) ): ?>
                        <?php basel_products_nav(); ?>
                    <?php endif ?>
                </div>
            </div>

            <div class="page-title <?php echo esc_attr( $title_class ); ?> title-blog" style="<?php echo esc_attr( $style ); ?>">
                <div class="container">
                    <header class="entry-header">
                        <?php if( $page_title ): ?><h3 class="entry-title"><?php echo wp_kses( $title, basel_get_allowed_html() ); ?></h3><?php endif; ?>
                        <?php if( $breadcrumbs ) basel_current_breadcrumbs( 'pages' ); ?>
                    </header><!-- .entry-header -->
                </div>
            </div>
            <?php
            return;
        endif;

        // Heading for portfolio
        if( is_post_type_archive( 'portfolio' ) || is_singular( 'portfolio' ) || is_tax( 'project-cat' ) ):

            if ( basel_get_opt( 'single_portfolio_title_in_page_title' ) && is_singular( 'portfolio' ) ) {
                $title = get_the_title();
            } else {
                $title = get_the_title( $page_for_projects );
            }

            if( is_tax( 'project-cat' ) ) {
                $title = single_term_title( '', false );
            }

            ?>
            <div class="single-breadcrumbs-wrapper">
                <div class="container">
                    <?php basel_current_breadcrumbs( 'shop' ); ?>
                    <?php if ( ! basel_get_opt( 'hide_products_nav' ) ): ?>
                        <?php basel_products_nav(); ?>
                    <?php endif ?>
                </div>
            </div>

            <div class="page-title <?php echo esc_attr( $title_class ); ?> title-blog" style="<?php echo esc_attr( $style ); ?>">
                <div class="container">
                    <header class="entry-header">
                        <?php if( $page_title ): ?><h1 class="entry-title"><?php echo wp_kses( $title, basel_get_allowed_html() ); ?></h1><?php endif; ?>
                        <?php if( $breadcrumbs ) basel_current_breadcrumbs( 'pages' ); ?>
                    </header><!-- .entry-header -->
                </div>
            </div>
            <?php
            return;
        endif;

        // Page heading for shop page
        if( basel_woocommerce_installed() && ( is_shop() || is_product_category() || is_product_tag() || is_singular( "product" ) || basel_is_product_attribute_archieve() )
            && ( $shop_categories || $shop_title )
        ):

            if( is_product_category() ) {

                $cat = $wp_query->get_queried_object();

                $cat_image = basel_get_category_page_title_image( $cat );

                if( $cat_image != '') {
                    $style = "background-image: url(" . $cat_image . ")";
                }
            }

            if( ! $shop_title ) {
                $title_class .= ' without-title';
            }

            ?>
            <?php if ( apply_filters( 'woocommerce_show_page_title', true ) && ! is_singular( "product" ) ) : ?>
            <div class="page-title <?php echo esc_attr( $title_class ); ?> title-shop" style="<?php echo esc_attr( $style ); ?>">
                <div class="container">
                    <div class="nav-shop">

                        <?php if ( is_product_category() || is_product_tag() ): ?>
                            <?php basel_back_btn(); ?>
                        <?php endif ?>

                        <?php if ( $shop_title ): ?>
                            <h1 class="entry-title"><?php woocommerce_page_title(); ?></h1>
                        <?php endif ?>

                        <?php if( ! is_singular( "product" ) && $shop_categories ) basel_product_categories_nav(); ?>

                    </div>
                </div>
            </div>
        <?php endif; ?>

            <?php

            return;
        endif;
    }
}