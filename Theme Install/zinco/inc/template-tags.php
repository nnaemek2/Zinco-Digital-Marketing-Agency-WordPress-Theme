<?php
/**
 * Custom template tags for this theme.
 *
 * @package Zinco
 */

/**
 * Header layout
 **/
function zinco_page_loading()
{
    $page_loading =zinco_get_opt( 'show_page_loading', false );
    $loading_type =zinco_get_opt( 'loading_type', 'style1');
    if($page_loading) { ?>
        <div id="ct-loadding" class="ct-loader <?php echo esc_attr($loading_type); ?>">
            <?php switch ( $loading_type )
            {
                case 'style2': ?>
                    <div class="ct-spinner2"></div>
                    <?php break;

                case 'style3': ?>
                    <div class="ct-spinner3">
                      <div class="double-bounce1"></div>
                      <div class="double-bounce2"></div>
                    </div>
                    <?php break;

                case 'style4': ?>
                    <div class="ct-spinner4">
                      <div class="rect1"></div>
                      <div class="rect2"></div>
                      <div class="rect3"></div>
                      <div class="rect4"></div>
                      <div class="rect5"></div>
                    </div>
                    <?php break;

                case 'style5': ?>
                    <div class="ct-spinner5">
                      <div class="bounce1"></div>
                      <div class="bounce2"></div>
                      <div class="bounce3"></div>
                    </div>
                    <?php break;

                case 'style6': ?>
                    <div class="ct-cube-grid">
                      <div class="ct-cube ct-cube1"></div>
                      <div class="ct-cube ct-cube2"></div>
                      <div class="ct-cube ct-cube3"></div>
                      <div class="ct-cube ct-cube4"></div>
                      <div class="ct-cube ct-cube5"></div>
                      <div class="ct-cube ct-cube6"></div>
                      <div class="ct-cube ct-cube7"></div>
                      <div class="ct-cube ct-cube8"></div>
                      <div class="ct-cube ct-cube9"></div>
                    </div>
                    <?php break;

                case 'style7': ?>
                    <div class="ct-folding-cube">
                      <div class="ct-cube1 ct-cube"></div>
                      <div class="ct-cube2 ct-cube"></div>
                      <div class="ct-cube4 ct-cube"></div>
                      <div class="ct-cube3 ct-cube"></div>
                    </div>
                    <?php break;

                case 'style8': ?>
                    <div class="ct-loading-stairs">
                        <div class="loader-bar"></div>
                        <div class="loader-bar"></div>
                        <div class="loader-bar"></div>
                        <div class="loader-bar"></div>
                        <div class="loader-bar"></div>
                        <div class="loader-ball"></div>
                    </div>
                    <?php break;

                default: ?>
                    <div class="loading-spin">
                        <div class="spinner">
                            <div class="right-side"><div class="bar"></div></div>
                            <div class="left-side"><div class="bar"></div></div>
                        </div>
                        <div class="spinner color-2" style="">
                            <div class="right-side"><div class="bar"></div></div>
                            <div class="left-side"><div class="bar"></div></div>
                        </div>
                    </div>
                    <?php break;
            } ?>
        </div>
    <?php }
}

/**
 * Header layout
 **/
function zinco_header_layout()
{
    $header_layout =zinco_get_opt( 'header_layout', '1' );
    $custom_header =zinco_get_page_opt( 'custom_header', '0' );

    if ( is_page() && $custom_header == '1' )
    {
        $page_header_layout =zinco_get_page_opt('header_layout');
        $header_layout = $page_header_layout;
        if($header_layout == '0') {
            return;
        }
    }

    get_template_part( 'template-parts/header-layout', $header_layout );
}

/**
 * Page title layout
 **/
function zinco_footer()
{
    $footer_layout =zinco_get_opt( 'footer_layout', '1' );
    $custom_footer =zinco_get_page_opt('custom_footer', 'false');
    $footer_layout_page =zinco_get_page_opt('footer_layout');
    if($custom_footer) {
        $footer_layout = $footer_layout_page;
    }
    get_template_part( 'template-parts/footer-layout', $footer_layout );
}

/**
 * Set primary content class based on sidebar position
 * 
 * @param  string $sidebar_pos
 * @param  string $extra_class
 */
function zinco_primary_class( $sidebar_pos, $extra_class = '' )
{
    if ( class_exists( 'WooCommerce' ) && (is_product_category()) || class_exists( 'WooCommerce' ) && (is_shop()) ) :
        $sidebar_load = 'sidebar-shop';
    elseif (is_page()) :
        $sidebar_load = 'sidebar-page';
    else :
        $sidebar_load = 'sidebar-blog';
    endif;

    if ( is_active_sidebar( $sidebar_load ) ) {
        $class = array( trim( $extra_class ) );
        switch ( $sidebar_pos )
        {
            case 'left':
                $class[] = 'content-has-sidebar float-right col-xl-8 col-lg-8 col-md-12 col-sm-12';
                break;

            case 'right':
                $class[] = 'content-has-sidebar float-left col-xl-8 col-lg-8 col-md-12 col-sm-12';
                break;

            default:
                $class[] = 'content-full-width col-12';
                break;
        }

        $class = implode( ' ', array_filter( $class ) );

        if ( $class )
        {
            echo ' class="' . esc_html($class) . '"';
        }
    } else {
        echo ' class="content-area col-12"'; 
    }
}

/**
 * Set secondary content class based on sidebar position
 * 
 * @param  string $sidebar_pos
 * @param  string $extra_class
 */
function zinco_secondary_class( $sidebar_pos, $extra_class = '' )
{
    if ( class_exists( 'WooCommerce' ) && (is_product_category()) ) :
        $sidebar_load = 'sidebar-shop';
    elseif (is_page()) :
        $sidebar_load = 'sidebar-page';
    else :
        $sidebar_load = 'sidebar-blog';
    endif;

    if ( is_active_sidebar( $sidebar_load ) ) {
        $class = array(trim($extra_class));
        switch ($sidebar_pos) {
            case 'left':
                $class[] = 'widget-has-sidebar sidebar-fixed col-xl-4 col-lg-4 col-md-12 col-sm-12';
                break;

            case 'right':
                $class[] = 'widget-has-sidebar sidebar-fixed col-xl-4 col-lg-4 col-md-12 col-sm-12';
                break;

            default:
                break;
        }

        $class = implode(' ', array_filter($class));

        if ($class) {
            echo ' class="' . esc_html($class) . '"';
        }
    }
}


/**
 * Prints HTML for breadcrumbs.
 */
function zinco_breadcrumb()
{
    if ( ! class_exists( 'CMS_Breadcrumb' ) )
    {
        return;
    }

    $breadcrumb = new CMS_Breadcrumb();
    $entries = $breadcrumb->get_entries();

    if ( empty( $entries ) )
    {
        return;
    }

    ob_start();

    foreach ( $entries as $entry )
    {
        $entry = wp_parse_args( $entry, array(
            'label' => '',
            'url'   => ''
        ) );

        if ( empty( $entry['label'] ) )
        {
            continue;
        }

        echo '<li>';

        if ( ! empty( $entry['url'] ) )
        {
            printf(
                '<a class="breadcrumb-entry" href="%1$s">%2$s</a>',
                esc_url( $entry['url'] ),
                esc_attr( $entry['label'] )
            );
        }
        else
        {
            printf( '<span class="breadcrumb-entry" >%s</span>', esc_html( $entry['label'] ) );
        }

        echo '</li>';
    }

    $output = ob_get_clean();

    if ( $output )
    {
        printf( '<ul class="ct-breadcrumb">%s</ul>', wp_kses_post($output));
    }
}


function zinco_entry_link_pages()
{
    wp_link_pages( array(
        'before'      => '<div class="page-links">',
        'after'       => '</div>',
        'link_before' => '<span>',
        'link_after'  => '</span>',
    ) );
}


if ( ! function_exists( 'zinco_entry_excerpt' ) ) :
    /**
     * Print post excerpt based on length.
     *
     * @param  integer $length
     */
    function zinco_entry_excerpt( $length = 55 )
    {
        $cms_the_excerpt = get_the_excerpt();
        if(!empty($cms_the_excerpt)) {
            echo esc_html($cms_the_excerpt);
        } else {
            echo wp_kses_post(zinco_get_the_excerpt( $length ));
        }
    }
endif;

/**
 * Prints post edit link when applicable
 */
function zinco_entry_edit_link()
{
    edit_post_link(
        sprintf(
            wp_kses(
                /* translators: %s: Name of current post. Only visible to screen readers */
                esc_attr__( 'Edit', 'zinco' ),
                array(
                    'span' => array(
                        'class' => array(),
                    ),
                )
            ),
            get_the_title()
        ),
        '<div class="entry-edit-link"><i class="fa fa-edit"></i>',
        '</div>'
    );
}


/**
 * Prints posts pagination based on query
 *
 * @param  WP_Query $query     Custom query, if left blank, this will use global query ( current query )
 * @return void
 */
function zinco_posts_pagination( $query = null )
{
    $classes = array();

    if ( empty( $query ) )
    {
        $query = $GLOBALS['wp_query'];
    }

    if ( empty( $query->max_num_pages ) || ! is_numeric( $query->max_num_pages ) || $query->max_num_pages < 2 )
    {
        return;
    }

    $paged = get_query_var( 'paged' );

    if ( ! $paged && is_front_page() && ! is_home() )
    {
        $paged = get_query_var( 'page' );
    }

    $paged = $paged ? intval( $paged ) : 1;

    $pagenum_link = html_entity_decode( get_pagenum_link() );
    $query_args   = array();
    $url_parts    = explode( '?', $pagenum_link );

    if ( isset( $url_parts[1] ) )
    {
        wp_parse_str( $url_parts[1], $query_args );
    }

    $pagenum_link = remove_query_arg( array_keys( $query_args ), $pagenum_link );
    $pagenum_link = trailingslashit( $pagenum_link ) . '%_%';

    $html_prev = '<i class="fa fa-angle-left"></i>';
    $html_next = '<i class="fa fa-angle-right"></i>';
    $links = paginate_links( array(
        'base'     => $pagenum_link,
        'total'    => $query->max_num_pages,
        'current'  => $paged,
        'mid_size' => 1,
        'add_args' => array_map( 'urlencode', $query_args ),
        'prev_text' => $html_prev,
        'next_text' => $html_next,
    ) );

    $template = '
    <nav class="navigation posts-pagination">
        <div class="posts-page-links">%2$s</div>
    </nav>';

    if ( $links )
    {
        printf(
            wp_kses_post($template),
            esc_attr__( 'Navigation', 'zinco' ),
            wp_kses_post($links)
        );
    }
}

/**
 * Prints archive meta on blog
 */
if ( ! function_exists( 'zinco_archive_meta' ) ) :
    function zinco_archive_meta() {
        $archive_author_on =zinco_get_opt( 'archive_author_on', true );
        $archive_categories_on =zinco_get_opt( 'archive_categories_on', false );
        $archive_comments_on =zinco_get_opt( 'archive_comments_on', true );
        $archive_date_on =zinco_get_opt( 'archive_date_on', true );
        if($archive_author_on || $archive_comments_on || $archive_categories_on) : ?>
            <ul class="entry-meta">
                <?php if($archive_date_on) : ?>
                    <li><i class="fal fac-calendar-alt"></i><?php echo get_the_date(); ?></li>
                <?php endif; ?>
                <?php if($archive_author_on) : ?>
                    <li class="item-author">
                        <i class="far fac-user"></i><?php echo esc_html__( 'By', 'zinco' ) ?>
                        <?php the_author_posts_link(); ?>
                    </li>
                <?php endif; ?>
                <?php if($archive_comments_on) : ?>
                    <li>
                        <i class="far fac-comments"></i><a href="<?php the_permalink(); ?>"><?php echo comments_number(esc_attr__('No Comments', 'zinco'),esc_attr__('1 Comment', 'zinco'),esc_attr__('% Comments', 'zinco')); ?></a>
                    </li>
                <?php endif; ?>
                <?php if($archive_categories_on) : ?>
                    <li class="item-category"><i class="fa fa-folder-o"></i><?php the_terms( get_the_ID(), 'category', '', ', ' ); ?></li>
                <?php endif; ?>
            </ul>
    <?php endif; }
endif;

/**
 * Prints post meta on blog
 */
if ( ! function_exists( 'zinco_post_meta' ) ) :
    function zinco_post_meta() {
        $post_author_on =zinco_get_opt( 'post_author_on', true );
        $post_categories_on =zinco_get_opt( 'post_categories_on', false );
        $post_comments_on =zinco_get_opt( 'post_comments_on', true );
        $post_date_on =zinco_get_opt( 'post_date_on', true );
        if($post_author_on || $post_categories_on || $post_comments_on || $post_date_on) : ?>
            <ul class="entry-meta">
                <?php if($post_date_on) : ?>
                    <li><i class="fal fac-calendar-alt"></i><?php echo get_the_date(); ?></li>
                <?php endif; ?>
                <?php if($post_author_on) : ?>
                    <li class="item-author">
                        <i class="far fac-user"></i><?php echo esc_html__( 'By', 'zinco' ) ?>
                        <?php the_author_posts_link(); ?>
                    </li>
                <?php endif; ?>
                <?php if($post_comments_on) : ?>
                    <li>
                        <i class="far fac-comments"></i><a href="<?php the_permalink(); ?>"><?php echo comments_number(esc_attr__('No Comments', 'zinco'),esc_attr__('1 Comment', 'zinco'),esc_attr__('% Comments', 'zinco')); ?></a>
                    </li>
                <?php endif; ?>
                <?php if($post_categories_on) : ?>
                    <li class="item-category"><i class="fa fa-folder-o"></i><?php the_terms( get_the_ID(), 'category', '', ', ' ); ?></li>
                <?php endif; ?>
                <?php if(is_sticky()) { ?>
                    <li><?php echo esc_html__('Sticky', 'zinco'); ?></li>
                <?php } ?>
            </ul>
    <?php endif; }
endif;

/**
 * Prints tag list
 */
if ( ! function_exists( 'zinco_entry_tagged_in' ) ) :
    /**
     * Prints HTML with meta information for the current post-date/time.
     */
    function zinco_entry_tagged_in()
    {
        $tags_list = get_the_tag_list( '<label class="label">'.esc_attr__('Releted Tags:', 'zinco').'</label>', ', ' );
        if ( $tags_list )
        {
            echo '<div class="entry-tags">';
            printf('%2$s', '', $tags_list);
            echo '</div>';
        }
    }
endif;

/**
 * List socials share for post.
 */
function zinco_socials_share_default() { ?>
    <div class="entry-social">
        <label class="label"><?php echo esc_html__('Share:', 'zinco'); ?></label>
        <a class="fb-social" title="<?php echo esc_attr__('Facebook', 'zinco'); ?>" target="_blank" href="https://www.facebook.com/sharer.php?u=<?php echo urlencode(get_permalink($post->ID)); ?>&t=<?php echo urlencode($post->post_title); ?>"><i class="zmdi zmdi-facebook"></i></a>
        <a class="tw-social" title="<?php echo esc_attr__('Twitter', 'zinco'); ?>" target="_blank" href="http://twitter.com/share?url=<?php the_permalink(); ?>"><i class="zmdi zmdi-twitter"></i></a>
        <a class="g-social" title="<?php echo esc_attr__('Google Plus', 'zinco'); ?>" target="_blank" href="http://plus.google.com/share?url=<?php the_permalink(); ?>"><i class="zmdi zmdi-google-plus"></i></a>
        <a class="pin-social" title="<?php echo esc_attr__('Pinterest', 'zinco'); ?>" target="_blank" href="http://pinterest.com/pin/create/button/?url=<?php echo esc_url(the_post_thumbnail_url( 'full' )); ?>&media=&description=<?php the_title(); ?>"><i class="zmdi zmdi-pinterest"></i></a>
        <a class="email-social" title="<?php echo esc_attr__('Email', 'zinco'); ?>" href="mailto:contact@example.com?subject=<?php the_title(); ?>&body=Check out this site <?php the_permalink(); ?>"><i class="zmdi zmdi-email"></i></a>
    </div>
    <?php
}

function zinco_socials_share_archive() { ?>
    <ul>
        <li><a class="fb-social" title="<?php echo esc_attr__('Facebook', 'zinco'); ?>" target="_blank" href="http://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>"><i class="zmdi zmdi-facebook"></i></a></li>
        <li><a class="tw-social" title="<?php echo esc_attr__('Twitter', 'zinco'); ?>" target="_blank" href="http://twitter.com/share?url=<?php the_permalink(); ?>"><i class="zmdi zmdi-twitter"></i></a></li>
        <li><a class="g-social" title="<?php echo esc_attr__('Google Plus', 'zinco'); ?>" target="_blank" href="http://plus.google.com/share?url=<?php the_permalink(); ?>"><i class="zmdi zmdi-google-plus"></i></a></li>
    </ul>
    <?php
}

function zinco_socials_share_portfolio() { ?>
    <a class="fb-social" title="<?php echo esc_attr__('Facebook', 'zinco'); ?>" target="_blank" href="http://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>"><i class="zmdi zmdi-facebook"></i></a>
    <a class="tw-social" title="<?php echo esc_attr__('Twitter', 'zinco'); ?>" target="_blank" href="http://twitter.com/share?url=<?php the_permalink(); ?>"><i class="zmdi zmdi-twitter"></i></a>
    <a class="g-social" title="<?php echo esc_attr__('Google Plus', 'zinco'); ?>" target="_blank" href="http://plus.google.com/share?url=<?php the_permalink(); ?>"><i class="zmdi zmdi-google-plus"></i></a>
    <a class="pin-social" title="<?php echo esc_attr__('Pinterest', 'zinco'); ?>" target="_blank" href="http://pinterest.com/pin/create/button/?url=<?php echo esc_url(the_post_thumbnail_url( 'full' )); ?>&media=&description=<?php the_title(); ?>"><i class="zmdi zmdi-pinterest"></i></a>
    <?php
}

/**
 * Footer Top
 */
function zinco_footer_top() {
    $footer_top_column =zinco_get_opt( 'footer_top_column' );
    $_class = "";

    switch ($footer_top_column){
        case '2':
            $_class = 'col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-12';
            break;
        case '3':
            $_class = 'col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12';
            break;
        case '4':
            $_class = 'col-xl-3 col-lg-3 col-md-6 col-sm-6 col-xs-12';
            break;
    }

    for($i = 1 ; $i <= $footer_top_column ; $i++){
        if ( is_active_sidebar( 'sidebar-footer-' . $i ) ){
            echo '<div class="ct-footer-item ' . esc_html($_class) . '">'; ?>
                <?php dynamic_sidebar( 'sidebar-footer-' . $i );
            echo "</div>";
        }
    }
}

/**
* Display navigation to next/previous post when applicable.
*/
function zinco_post_nav_default() {
    global $post;
    $previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
    $next     = get_adjacent_post( false, '', false );

    if ( ! $next && ! $previous )
        return;
    ?>
    <?php
    $next_post = get_next_post();
    $previous_post = get_previous_post();
    $page_for_posts = get_option( 'page_for_posts' );
    if( !empty($next_post) || !empty($previous_post) ) { ?>
        <div class="nav-links">
            <?php if ( is_a( $previous_post , 'WP_Post' ) && get_the_title( $previous_post->ID ) != '') { ?>
                <div class="nav-link-prev">
                    <div class="nav-inner">
                        <h3><a  href="<?php echo esc_url(get_permalink( $previous_post->ID )); ?>"><?php echo get_the_title( $previous_post->ID ); ?></a></h3>
                        <span><?php echo esc_html_e('Prev Post', 'zinco') ?></span>
                    </div>
                </div>
            <?php } ?>
            <?php if($page_for_posts != '0') : ?>
                <div class="nav-archive"><a href="<?php echo get_permalink($page_for_posts); ?>"><i class="fal fac-th"></i></a></div>
            <?php endif; ?>
            <?php if ( is_a( $next_post , 'WP_Post' ) && get_the_title( $next_post->ID ) != '') { ?>
                <div class="nav-link-next">
                    <div class="nav-inner">
                        <h3><a href="<?php echo esc_url(get_permalink( $next_post->ID )); ?>"><?php echo get_the_title( $next_post->ID ); ?></a></h3>
                        <span><?php echo esc_html_e('Next Post', 'zinco') ?></span>
                    </div>
                </div>
            <?php } ?>
        </div><!-- .nav-links -->
    <?php }
}

/**
 * Related Post
 */
function zinco_related_post()
{
    global $post;
    $current_id = $post->ID;
    $posttags = get_the_category($post->ID);
    if (empty($posttags)) return;

    $tags = array();

    foreach ($posttags as $tag) {

        $tags[] = $tag->term_id;
    }
    $post_number = '6';
    $query_similar = new WP_Query(array('posts_per_page' => $post_number, 'post_type' => 'post', 'post_status' => 'publish', 'category__in' => $tags));
    $post_related_post =zinco_get_opt( 'post_related_post', false );
    if (is_rtl()) {
        $carousel_rtl = 'true';
    } else {
        $carousel_rtl = 'false';
    }
    if ($post_related_post && count($query_similar->posts) > 1) {
        wp_enqueue_script( 'owl-carousel' );
        wp_enqueue_script( 'zinco-carousel' );
        ?>
        <div class="ct-related-post-wrap">
            <div class="ct-related-post">
                <h3 class="section-title"><?php echo esc_html__('Releted Post', 'zinco'); ?></h3>
                <div class="owl-carousel" data-item-xs="1" data-item-sm="2" data-item-md="2" data-item-lg="2" data-item-xl="2" data-margin="30" data-loop="false" data-autoplay="true" data-autoplaytimeout="10000" data-smartspeed="500" data-center="false" data-arrows="false" data-bullets="false" data-stagepadding="0" data-stagepadding-lg="0" data-stagepadding-xl="0" data-rtl="<?php echo esc_attr( $carousel_rtl ); ?>">
                    <?php foreach ($query_similar->posts as $post):
                        $thumbnail_url = '';
                        if (has_post_thumbnail(get_the_ID()) && wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), false)) :
                            $thumbnail_url = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'zinco-medium', false);
                        endif;
                        if ($post->ID !== $current_id) : ?>
                            <div class="ct-carousel-item">
                                <?php if (has_post_thumbnail(get_the_ID()) && wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), false)) : ?>
                                    <div class="item-featured">
                                        <a href="<?php echo esc_url( get_permalink()); ?>" ><img src="<?php echo esc_url($thumbnail_url[0]); ?>" alt="<?php the_title_attribute(); ?>" /></a>
                                    </div>
                                <?php endif; ?>
                                <div class="item-holder">
                                    <h3 class="item-title">
                                        <a href="<?php echo esc_url(get_permalink( $post->ID )); ?>"><?php echo esc_attr(get_the_title($post->ID)); ?></a>
                                    </h3>
                                    <div class="item-content">
                                        <?php echo wp_trim_words( $post->post_excerpt, $num_words = 12, $more = null ); ?>
                                    </div>
                                </div>
                            </div>
                        <?php endif;
                    endforeach; ?>
                </div>
            </div>
        </div>
    <?php }

    wp_reset_postdata();
}

/**
 * Header Search Mobile
 */
function zinco_header_mobile_search()
{
    $search_field_placeholder =zinco_get_opt( 'search_field_placeholder' );
    $search_on_mobile =zinco_get_opt( 'search_on_mobile', false );
    if($search_on_mobile) : ?>
    <div class="header-mobile-search">
        <form role="search" method="get" action="<?php echo esc_url(home_url( '/' )); ?>">
            <input type="text" placeholder="<?php if(!empty($search_field_placeholder)) { echo esc_attr( $search_field_placeholder ); } else { esc_attr_e('Search Keywords...', 'zinco'); } ?>" name="s" class="search-field" />
            <button type="submit" class="search-submit"><i class="fa fa-search"></i></button>
        </form>
    </div>
<?php endif; }

/**
 * Header Search Popup
 */
function zinco_popup_search()
{ 
    $search_on =zinco_get_opt( 'search_on', false );
    $search_field_placeholder =zinco_get_opt( 'search_field_placeholder' );
    if($search_on) : ?>
        <div class="ct-modal ct-search-popup">
            <div class="ct-close"></div>
            <div class="ct-modal-content">
                <form role="search" method="get" action="<?php echo esc_url(home_url( '/' )); ?>">
                    <input type="text" placeholder="<?php if(!empty($search_field_placeholder)) { echo esc_attr( $search_field_placeholder ); } else { esc_attr_e('Search Keywords...', 'zinco'); } ?>" name="s" class="search-field" />
                    <button type="submit" class="search-submit"><i class="fa fa-search"></i></button>
                </form>
                <div class="esc-search"><?php echo esc_html__( 'Press ESC key to close search', 'zinco' ) ?></div>
            </div>
        </div>
    <?php endif; ?>
<?php }

/**
 * Header Hidden Sidebar
 */
function zinco_hidden_sidebar()
{ 
    $hidden_sidebar_on =zinco_get_opt( 'hidden_sidebar_on', false );
    if($hidden_sidebar_on && is_active_sidebar( 'sidebar-hidden' )) : ?>
        <div class="ct-hidden-sidebar">
            <div class="ct-close"></div>
            <div class="ct-hidden-sidebar-inner">
                <?php dynamic_sidebar('sidebar-hidden'); ?>
            </div>
        </div>
    <?php endif; ?>
<?php }
/**
 * Page title layout
 **/
function zinco_page_title_layout()
{
    get_template_part( 'template-parts/page-title', '' );
}

/**
 * Social Top Bar
 */
function zinco_topbar_social_icon() {
    $social_facebook_url =zinco_get_opt( 'social_facebook_url' );
    $social_twitter_url =zinco_get_opt( 'social_twitter_url' );
    $social_inkedin_url =zinco_get_opt( 'social_inkedin_url' );
    $social_instagram_url =zinco_get_opt( 'social_instagram_url' );
    $social_google_url =zinco_get_opt( 'social_google_url' );
    $social_skype_url =zinco_get_opt( 'social_skype_url' );
    $social_pinterest_url =zinco_get_opt( 'social_pinterest_url' );
    $social_vimeo_url =zinco_get_opt( 'social_vimeo_url' );
    $social_youtube_url =zinco_get_opt( 'social_youtube_url' );
    $social_yelp_url =zinco_get_opt( 'social_yelp_url' );
    $social_tumblr_url =zinco_get_opt( 'social_tumblr_url' );
    $social_tripadvisor_url =zinco_get_opt( 'social_tripadvisor_url' );

    if(!empty($social_facebook_url)) :
        echo '<a href="'.esc_url($social_facebook_url).'" target="_blank"><i class="fa fa-facebook"></i></a>';
    endif;
    if(!empty($social_twitter_url)) :
        echo '<a href="'.esc_url($social_twitter_url).'" target="_blank"><i class="fa fa-twitter"></i></a>';
    endif;
    if(!empty($social_inkedin_url)) :
        echo '<a href="'.esc_url($social_inkedin_url).'" target="_blank"><i class="fa fa-linkedin"></i></a>';
    endif;
    if(!empty($social_instagram_url)) :
        echo '<a href="'.esc_url($social_instagram_url).'" target="_blank"><i class="fa fa-instagram"></i></a>';
    endif;
    if(!empty($social_google_url)) :
        echo '<a href="'.esc_url($social_google_url).'" target="_blank"><i class="fa fa-google-plus"></i></a>';
    endif;
    if(!empty($social_skype_url)) :
        echo '<a href="'.esc_url($social_skype_url).'" target="_blank"><i class="fa fa-skype"></i></a>';
    endif;
    if(!empty($social_pinterest_url)) :
        echo '<a href="'.esc_url($social_pinterest_url).'" target="_blank"><i class="fa fa-pinterest"></i></a>';
    endif;
    if(!empty($social_vimeo_url)) :
        echo '<a href="'.esc_url($social_vimeo_url).'" target="_blank"><i class="fa fa-vimeo"></i></a>';
    endif;
    if(!empty($social_youtube_url)) :
        echo '<a href="'.esc_url($social_youtube_url).'" target="_blank"><i class="fa fa-youtube"></i></a>';
    endif;
    if(!empty($social_yelp_url)) :
        echo '<a href="'.esc_url($social_yelp_url).'" target="_blank"><i class="fa fa-yelp"></i></a>';
    endif;
    if(!empty($social_tumblr_url)) :
        echo '<a href="'.esc_url($social_tumblr_url).'" target="_blank"><i class="fa fa-tumblr"></i></a>';
    endif;
    if(!empty($social_tripadvisor_url)) :
        echo '<a href="'.esc_url($social_tripadvisor_url).'" target="_blank"><i class="fa fa-tripadvisor"></i></a>';
    endif;
}

/**
 * Social Footer
 */
function zinco_footer_social_icon() {
    $social_facebook_url =zinco_get_opt( 'social_facebook_url' );
    $social_twitter_url =zinco_get_opt( 'social_twitter_url' );
    $social_inkedin_url =zinco_get_opt( 'social_inkedin_url' );
    $social_instagram_url =zinco_get_opt( 'social_instagram_url' );
    $social_google_url =zinco_get_opt( 'social_google_url' );
    $social_skype_url =zinco_get_opt( 'social_skype_url' );
    $social_pinterest_url =zinco_get_opt( 'social_pinterest_url' );
    $social_vimeo_url =zinco_get_opt( 'social_vimeo_url' );
    $social_youtube_url =zinco_get_opt( 'social_youtube_url' );
    $social_yelp_url =zinco_get_opt( 'social_yelp_url' );
    $social_tumblr_url =zinco_get_opt( 'social_tumblr_url' );
    $social_tripadvisor_url =zinco_get_opt( 'social_tripadvisor_url' );

    if(!empty($social_facebook_url)) :
        echo '<a href="'.esc_url($social_facebook_url).'" target="_blank"><i class="fa fa-facebook"></i></a>';
    endif;
    if(!empty($social_twitter_url)) :
        echo '<a href="'.esc_url($social_twitter_url).'" target="_blank"><i class="fa fa-twitter"></i></a>';
    endif;
    if(!empty($social_inkedin_url)) :
        echo '<a href="'.esc_url($social_inkedin_url).'" target="_blank"><i class="fa fa-linkedin"></i></a>';
    endif;
    if(!empty($social_instagram_url)) :
        echo '<a href="'.esc_url($social_instagram_url).'" target="_blank"><i class="fa fa-instagram"></i></a>';
    endif;
    if(!empty($social_google_url)) :
        echo '<a href="'.esc_url($social_google_url).'" target="_blank"><i class="fa fa-google-plus"></i></a>';
    endif;
    if(!empty($social_skype_url)) :
        echo '<a href="'.esc_url($social_skype_url).'" target="_blank"><i class="fa fa-skype"></i></a>';
    endif;
    if(!empty($social_pinterest_url)) :
        echo '<a href="'.esc_url($social_pinterest_url).'" target="_blank"><i class="fa fa-pinterest"></i></a>';
    endif;
    if(!empty($social_vimeo_url)) :
        echo '<a href="'.esc_url($social_vimeo_url).'" target="_blank"><i class="fa fa-vimeo"></i></a>';
    endif;
    if(!empty($social_youtube_url)) :
        echo '<a href="'.esc_url($social_youtube_url).'" target="_blank"><i class="fa fa-youtube"></i></a>';
    endif;
    if(!empty($social_yelp_url)) :
        echo '<a href="'.esc_url($social_yelp_url).'" target="_blank"><i class="fa fa-yelp"></i></a>';
    endif;
    if(!empty($social_tumblr_url)) :
        echo '<a href="'.esc_url($social_tumblr_url).'" target="_blank"><i class="fa fa-tumblr"></i></a>';
    endif;
    if(!empty($social_tripadvisor_url)) :
        echo '<a href="'.esc_url($social_tripadvisor_url).'" target="_blank"><i class="fa fa-tripadvisor"></i></a>';
    endif;
}

/**
 * Social Page
 */
function zinco_page_social_icon() {
    $social_facebook_url =zinco_get_page_opt( 'social_facebook_url' );
    $social_twitter_url =zinco_get_page_opt( 'social_twitter_url' );
    $social_inkedin_url =zinco_get_page_opt( 'social_inkedin_url' );
    $social_instagram_url =zinco_get_page_opt( 'social_instagram_url' );
    $social_google_url =zinco_get_page_opt( 'social_google_url' );
    $social_skype_url =zinco_get_page_opt( 'social_skype_url' );
    $social_pinterest_url =zinco_get_page_opt( 'social_pinterest_url' );
    $social_vimeo_url =zinco_get_page_opt( 'social_vimeo_url' );
    $social_youtube_url =zinco_get_page_opt( 'social_youtube_url' );
    $social_yelp_url =zinco_get_page_opt( 'social_yelp_url' );
    $social_tumblr_url =zinco_get_page_opt( 'social_tumblr_url' );
    $social_tripadvisor_url =zinco_get_page_opt( 'social_tripadvisor_url' );

    if(!empty($social_facebook_url)) :
        echo '<a href="'.esc_url($social_facebook_url).'" target="_blank"><i class="fa fa-facebook"></i></a>';
    endif;
    if(!empty($social_twitter_url)) :
        echo '<a href="'.esc_url($social_twitter_url).'" target="_blank"><i class="fa fa-twitter"></i></a>';
    endif;
    if(!empty($social_inkedin_url)) :
        echo '<a href="'.esc_url($social_inkedin_url).'" target="_blank"><i class="fa fa-linkedin"></i></a>';
    endif;
    if(!empty($social_instagram_url)) :
        echo '<a href="'.esc_url($social_instagram_url).'" target="_blank"><i class="fa fa-instagram"></i></a>';
    endif;
    if(!empty($social_google_url)) :
        echo '<a href="'.esc_url($social_google_url).'" target="_blank"><i class="fa fa-google-plus"></i></a>';
    endif;
    if(!empty($social_skype_url)) :
        echo '<a href="'.esc_url($social_skype_url).'" target="_blank"><i class="fa fa-skype"></i></a>';
    endif;
    if(!empty($social_pinterest_url)) :
        echo '<a href="'.esc_url($social_pinterest_url).'" target="_blank"><i class="fa fa-pinterest"></i></a>';
    endif;
    if(!empty($social_vimeo_url)) :
        echo '<a href="'.esc_url($social_vimeo_url).'" target="_blank"><i class="fa fa-vimeo"></i></a>';
    endif;
    if(!empty($social_youtube_url)) :
        echo '<a href="'.esc_url($social_youtube_url).'" target="_blank"><i class="fa fa-youtube"></i></a>';
    endif;
    if(!empty($social_yelp_url)) :
        echo '<a href="'.esc_url($social_yelp_url).'" target="_blank"><i class="fa fa-yelp"></i></a>';
    endif;
    if(!empty($social_tumblr_url)) :
        echo '<a href="'.esc_url($social_tumblr_url).'" target="_blank"><i class="fa fa-tumblr"></i></a>';
    endif;
    if(!empty($social_tripadvisor_url)) :
        echo '<a href="'.esc_url($social_tripadvisor_url).'" target="_blank"><i class="fa fa-tripadvisor"></i></a>';
    endif;
}

/**
 * User custom fields.
 */
add_action( 'show_user_profile', 'zinco_user_fields' );
add_action( 'edit_user_profile', 'zinco_user_fields' );
function zinco_user_fields($user){

    $user_facebook = get_user_meta($user->ID, 'user_facebook', true);
    $user_twitter = get_user_meta($user->ID, 'user_twitter', true);
    $user_linkedin = get_user_meta($user->ID, 'user_linkedin', true);
    $user_skype = get_user_meta($user->ID, 'user_skype', true);
    $user_google = get_user_meta($user->ID, 'user_google', true);
    $user_youtube = get_user_meta($user->ID, 'user_youtube', true);
    $user_vimeo = get_user_meta($user->ID, 'user_vimeo', true);
    $user_tumblr = get_user_meta($user->ID, 'user_tumblr', true);
    $user_rss = get_user_meta($user->ID, 'user_rss', true);
    $user_pinterest = get_user_meta($user->ID, 'user_pinterest', true);
    $user_instagram = get_user_meta($user->ID, 'user_instagram', true);
    $user_yelp = get_user_meta($user->ID, 'user_yelp', true);

    ?>
    <h3><?php esc_html_e('Social', 'zinco'); ?></h3>
    <table class="form-table">
        <tr>
            <th><label for="user_facebook"><?php esc_html_e('Facebook', 'zinco'); ?></label></th>
            <td>
                <input id="user_facebook" name="user_facebook" type="text" value="<?php echo esc_attr(isset($user_facebook) ? $user_facebook : ''); ?>" />
            </td>
        </tr>
        <tr>
            <th><label for="user_twitter"><?php esc_html_e('Twitter', 'zinco'); ?></label></th>
            <td>
                <input id="user_twitter" name="user_twitter" type="text" value="<?php echo esc_attr(isset($user_twitter) ? $user_twitter : ''); ?>" />
            </td>
        </tr>
        <tr>
            <th><label for="user_linkedin"><?php esc_html_e('Linkedin', 'zinco'); ?></label></th>
            <td>
                <input id="user_linkedin" name="user_linkedin" type="text" value="<?php echo esc_attr(isset($user_linkedin) ? $user_linkedin : ''); ?>" />
            </td>
        </tr>
        <tr>
            <th><label for="user_skype"><?php esc_html_e('Skype', 'zinco'); ?></label></th>
            <td>
                <input id="user_skype" name="user_skype" type="text" value="<?php echo esc_attr(isset($user_skype) ? $user_skype : ''); ?>" />
            </td>
        </tr>
        <tr>
            <th><label for="user_google"><?php esc_html_e('Google', 'zinco'); ?></label></th>
            <td>
                <input id="user_google" name="user_google" type="text" value="<?php echo esc_attr(isset($user_google) ? $user_google : ''); ?>" />
            </td>
        </tr>
        <tr>
            <th><label for="user_youtube"><?php esc_html_e('Youtube', 'zinco'); ?></label></th>
            <td>
                <input id="user_youtube" name="user_youtube" type="text" value="<?php echo esc_attr(isset($user_youtube) ? $user_youtube : ''); ?>" />
            </td>
        </tr>
        <tr>
            <th><label for="user_vimeo"><?php esc_html_e('Vimeo', 'zinco'); ?></label></th>
            <td>
                <input id="user_vimeo" name="user_vimeo" type="text" value="<?php echo esc_attr(isset($user_vimeo) ? $user_vimeo : ''); ?>" />
            </td>
        </tr>
        <tr>
            <th><label for="user_tumblr"><?php esc_html_e('Tumblr', 'zinco'); ?></label></th>
            <td>
                <input id="user_tumblr" name="user_tumblr" type="text" value="<?php echo esc_attr(isset($user_tumblr) ? $user_tumblr : ''); ?>" />
            </td>
        </tr>
        <tr>
            <th><label for="user_rss"><?php esc_html_e('Rss', 'zinco'); ?></label></th>
            <td>
                <input id="user_rss" name="user_rss" type="text" value="<?php echo esc_attr(isset($user_rss) ? $user_rss : ''); ?>" />
            </td>
        </tr>
        <tr>
            <th><label for="user_pinterest"><?php esc_html_e('Pinterest', 'zinco'); ?></label></th>
            <td>
                <input id="user_pinterest" name="user_pinterest" type="text" value="<?php echo esc_attr(isset($user_pinterest) ? $user_pinterest : ''); ?>" />
            </td>
        </tr>
        <tr>
            <th><label for="user_instagram"><?php esc_html_e('Instagram', 'zinco'); ?></label></th>
            <td>
                <input id="user_instagram" name="user_instagram" type="text" value="<?php echo esc_attr(isset($user_instagram) ? $user_instagram : ''); ?>" />
            </td>
        </tr>
        <tr>
            <th><label for="user_yelp"><?php esc_html_e('Yelp', 'zinco'); ?></label></th>
            <td>
                <input id="user_yelp" name="user_yelp" type="text" value="<?php echo esc_attr(isset($user_yelp) ? $user_yelp : ''); ?>" />
            </td>
        </tr>
    </table>
    <?php
}

/**
 * Save user custom fields.
 */
add_action( 'personal_options_update', 'zinco_save_user_custom_fields' );
add_action( 'edit_user_profile_update', 'zinco_save_user_custom_fields' );
function zinco_save_user_custom_fields( $user_id )
{
    if ( !current_user_can( 'edit_user', $user_id ) )
        return false;

    if(isset($_POST['user_facebook']))
        update_user_meta( $user_id, 'user_facebook', $_POST['user_facebook'] );
    if(isset($_POST['user_twitter']))
        update_user_meta( $user_id, 'user_twitter', $_POST['user_twitter'] );
    if(isset($_POST['user_linkedin']))
        update_user_meta( $user_id, 'user_linkedin', $_POST['user_linkedin'] );
    if(isset($_POST['user_skype']))
        update_user_meta( $user_id, 'user_skype', $_POST['user_skype'] );
    if(isset($_POST['user_google']))
        update_user_meta( $user_id, 'user_google', $_POST['user_google'] );
    if(isset($_POST['user_youtube']))
        update_user_meta( $user_id, 'user_youtube', $_POST['user_youtube'] );
    if(isset($_POST['user_vimeo']))
        update_user_meta( $user_id, 'user_vimeo', $_POST['user_vimeo'] );
    if(isset($_POST['user_tumblr']))
        update_user_meta( $user_id, 'user_tumblr', $_POST['user_tumblr'] );
    if(isset($_POST['user_rss']))
        update_user_meta( $user_id, 'user_rss', $_POST['user_rss'] );
    if(isset($_POST['user_pinterest']))
        update_user_meta( $user_id, 'user_pinterest', $_POST['user_pinterest'] );
    if(isset($_POST['user_instagram']))
        update_user_meta( $user_id, 'user_instagram', $_POST['user_instagram'] );
    if(isset($_POST['user_yelp']))
        update_user_meta( $user_id, 'user_yelp', $_POST['user_yelp'] );
}
/* Author Social */
function zinco_get_user_social() {

    $user_facebook = get_user_meta(get_the_author_meta( 'ID' ), 'user_facebook', true);
    $user_twitter = get_user_meta(get_the_author_meta( 'ID' ), 'user_twitter', true);
    $user_linkedin = get_user_meta(get_the_author_meta( 'ID' ), 'user_linkedin', true);
    $user_skype = get_user_meta(get_the_author_meta( 'ID' ), 'user_skype', true);
    $user_google = get_user_meta(get_the_author_meta( 'ID' ), 'user_google', true);
    $user_youtube = get_user_meta(get_the_author_meta( 'ID' ), 'user_youtube', true);
    $user_vimeo = get_user_meta(get_the_author_meta( 'ID' ), 'user_vimeo', true);
    $user_tumblr = get_user_meta(get_the_author_meta( 'ID' ), 'user_tumblr', true);
    $user_rss = get_user_meta(get_the_author_meta( 'ID' ), 'user_rss', true);
    $user_pinterest = get_user_meta(get_the_author_meta( 'ID' ), 'user_pinterest', true);
    $user_instagram = get_user_meta(get_the_author_meta( 'ID' ), 'user_instagram', true);
    $user_yelp = get_user_meta(get_the_author_meta( 'ID' ), 'user_yelp', true);

    ?>
    <ul class="user-social el-social">
        <?php if(!empty($user_facebook)) { ?>
            <li><a href="<?php echo esc_url($user_facebook); ?>"><i class="fa fa-facebook"></i></a></li>
       <?php } ?>
        <?php if(!empty($user_twitter)) { ?>
            <li><a href="<?php echo esc_url($user_twitter); ?>"><i class="fa fa-twitter"></i></a></li>
        <?php } ?>
        <?php if(!empty($user_linkedin)) { ?>
            <li><a href="<?php echo esc_url($user_linkedin); ?>"><i class="fa fa-linkedin"></i></a></li>
        <?php } ?>
        <?php if(!empty($user_rss)) { ?>
            <li><a href="<?php echo esc_url($user_rss); ?>"><i class="fa fa-rss"></i></a></li>
        <?php } ?>
        <?php if(!empty($user_instagram)) { ?>
            <li><a href="<?php echo esc_url($user_instagram); ?>"><i class="fa fa-instagram"></i></a></li> 
        <?php } ?>
        <?php if(!empty($user_google)) { ?>
            <li><a href="<?php echo esc_url($user_google); ?>"><i class="fa fa-google-plus"></i></a></li>  
        <?php } ?>
        <?php if(!empty($user_skype)) { ?> 
            <li><a href="<?php echo esc_url($user_skype); ?>"><i class="fa fa-skype"></i></a></li>   
        <?php } ?>
        <?php if(!empty($user_pinterest)) { ?>
            <li><a href="<?php echo esc_url($user_pinterest); ?>"><i class="fa fa-pinterest"></i></a></li>  
        <?php } ?>
        <?php if(!empty($user_vimeo)) { ?> 
            <li><a href="<?php echo esc_url($user_vimeo); ?>"><i class="fa fa-vimeo"></i></a></li>  
        <?php } ?>
        <?php if(!empty($user_youtube)) { ?>
            <li><a href="<?php echo esc_url($user_youtube); ?>"><i class="fa fa-youtube"></i></a></li> 
        <?php } ?> 
        <?php if(!empty($user_yelp)) { ?> 
            <li><a href="<?php echo esc_url($user_yelp); ?>"><i class="fa fa-yelp"></i></a></li>
        <?php } ?>
        <?php if(!empty($user_tumblr)) { ?>
            <li><a href="<?php echo esc_url($user_tumblr); ?>"><i class="fa fa-tumblr"></i></a></li>  
        <?php } ?>

    </ul> <?php  
}