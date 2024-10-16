<?php
/**
 * Breadcrumb class for the theme.
 * 
 * @package Zinco
 */

if ( ! defined( 'ABSPATH' ) )
{
    die();
}

class CMS_Breadcrumb
{
    /**
     * Array of breadcrumb entries. Each one contains title, url, text
     *
     * @since 1.0
     * @access protected
     * @var array
     */
    protected $entries = array();

    /**
     * Agruments for breadcrumbs
     *
     * @since 1.0
     * @access protected
     * @var array
     */
    protected $args;

    /**
     * Constructor
     *
     * @param  array $args {
     *     @var string $home_label            - If set to false then the home link won't show up. Default: 'Home'
     *     @var string $404_label             - 404 label. Default: 'Not Found'
     *     @var string $search_results_label  - Search results label. Default: 'Search Results'
     *     @var int    $entry_max_length      - If set to 0 then there's no limit. Default: 3
     *     @var string $entry_max_length_type - Accepts either 'words' or 'letters'. Default: 'words'
     *     @var string $more_indicator        - If the entry words/letters is larger than length, then this will show up.
     *                                          Default to ... ( &hellip; )
     * }
     */
    function __construct( $args = array() )
    {
        $page_on_front = get_option( 'page_on_front' );
        if($page_on_front) {
            $home_label = get_the_title( $page_on_front );
        } else {
            $home_label = esc_html__( 'Home', 'zinco' );
        }
        $args = wp_parse_args( $args, array(
            'home_label'            => $home_label,
            '404_label'             => esc_html__( 'Not Found', 'zinco' ),
            'search_results_label'  => esc_html__( 'Search Results', 'zinco' ),
            'entry_max_length'      => 100,
            'entry_max_length_type' => 'words',
            'more_indicator'        => '&hellip;'
        ) );

        if ( 'false' === $args['home_label'] || false === $args['home_label'] || empty( $args['home_label'] ) )
        {
            $args['home_label'] = false;
        }

        $args['entry_max_length'] = absint( $args['entry_max_length'] );
        if ( 'words' !== $args['entry_max_length_type'] && 'letters' !== $args['entry_max_length_type'] )
        {
            $args['entry_max_length_type'] = 'words';
        }

        $args['more_indicator'] = esc_html( $args['more_indicator'] );

        $this->args = $args;
        $this->generate();
    }

    /**
     * Get entries of the breadcrumb
     *
     * @since 1.0
     * @access public
     * @return array
     */
    function get_entries()
    {
        return $this->entries;
    }


    /**
     * Add an entry to breadcrumbs array
     *
     * @since 1.0
     * @access public
     *
     * @param string $label Breadcrumb entry label.
     * @param string $url   Breadcrumb entry link.
     */
    function add_entry( $label, $url = '' )
    {
        $entry = array(
            'label' => $label,
            'url'   => $url
        );

        if ( $this->args['entry_max_length'] > 0 )
        {
            switch ( $this->args['entry_max_length_type'] )
            {
                case 'letters':
                    if ( strlen( $label ) <= $this->args['entry_max_length'] )
                    {
                        $entry['label'] = $label;
                    }
                    else
                    {
                        $txt = trim( substr( $label, 0, $this->args['entry_max_length'] ) ) . $this->args['more_indicator'];
                        $entry['label'] = $txt;
                    }
                    break;
                
                default:
                    $entry['label'] = wp_trim_words( $label, $this->args['entry_max_length'], $this->args['more_indicator'] );
                    break;
            }
        }

        $this->entries[] = $entry;
    }


    /**
     * Generate breadcrumbs array
     * @return array
     */
    function generate()
    {
        $conditions = array(
            'is_home',
            'is_404',
            'is_attachment',
            'is_single',
            'is_page',
            'is_post_type_archive',
            'is_category',
            'is_tag',
            'is_author',
            'is_date',
            'is_tax',
            'is_search'
        );

        // Front Page
        if ( is_front_page() ) return array();

        if ( $this->args['home_label'] )
        {
            $this->add_entry( $this->args['home_label'], home_url( '/' ) );
        }

        if ( get_option( 'page_for_posts' ) )
        {
            $post_id = get_option( 'page_for_posts' );

            if ( is_home() || is_category() || is_tag() || is_singular( 'post' ) )
            {
                $this->add_entry( get_the_title( $post_id ), get_permalink( $post_id ) );
            }
        }

        foreach ( $conditions as $condition )
        {
            if ( call_user_func( $condition ) )
            {
                call_user_func( array( $this, 'add' . substr( $condition, 2 ) . '_entry' ) );
                if ( is_paged() )
                {
                    $this->add_paged_entry();
                }
                break;
            }
        }

        // Remove link from Last entry
        $entries_count = count( $this->entries );

        if ( $entries_count >= 1 )
        {
            $this->entries[ $entries_count - 1 ]['url'] = '';
        }
    }


    /**
     * Post index. Currently do nothing
     * 
     * @since 1.0
     * @access public
     */
    function add_home_entry() {}


    /**
     * 404
     *
     * @since 1.0
     * @access public
     */
    function add_404_entry()
    {
        $this->add_entry( $this->args['404_label'] );
    }


    /**
     * Attachment
     *
     * @since 1.0
     * @access public
     */
    function add_attachment_entry()
    {
        global $post;
        $this->add_single_ancestor_entry( $post );
    }


    /**
     * Single
     *
     * @since 1.0
     * @access public
     */
    function add_single_entry()
    {
        global $post;
        $this->add_single_ancestor_entry( $post );
    }


    /**
     * Page
     *
     * @since 1.0
     * @access public
     */
    function add_page_entry( $page_id = 0 )
    {
        if ( $page_id )
        {
            $post = get_post( $page_id );
        }
        else
        {
            global $post;
        }

        $page_ancestors_trail = array();
        $page_parent = $post->post_parent;
        $page_as_front = get_option( 'page_on_front' );

        while ( $page_parent )
        {
            if ( $page_as_front != $page_parent )
            {
                $page_obj = get_post( $page_parent );

                if ( ! empty( $page_obj ) )
                {
                    $page_ancestors_trail[] = array( 'label' => get_the_title( $page_obj->ID ), 'url' => get_permalink( $page_obj->ID ) );
                }
            }

            $page_parent = empty( $page_obj ) ? null : $page_obj->post_parent;
        }

        $page_ancestors_trail = array_reverse( $page_ancestors_trail );
        foreach ( $page_ancestors_trail as $key => $page_ancestor )
        {
            $this->add_entry( $page_ancestor['label'], $page_ancestor['url'] );
        }
        $this->add_entry( get_the_title( $page_id ), get_permalink( $page_id ) );
    }


    /**
     * Post type archive
     *
     * @since 1.0
     * @access public
     */
    function add_post_type_archive_entry()
    {
        $post_type = get_post_type_object( get_post_type() );

        if ( $post_type )
        {
            $this->add_entry( $post_type->labels->name, get_post_type_archive_link( get_post_type() ) );
        }
    }


    /**
     * Category
     *
     * @since 1.0
     * @access public
     */
    function add_category_entry()
    {
        $this->add_category_ancestor_entry();
    }


    /**
     * Tag
     *
     * @since 1.0
     * @access public
     */
    function add_tag_entry()
    {
        $queried_object = $GLOBALS['wp_query']->get_queried_object();
        $this->add_entry(
            esc_html__( 'Tag:', 'zinco' ).' '.single_tag_title( '', false ) ).' '.get_tag_link( $queried_object->term_id
        );
    }


    /**
     * Author
     *
     * @since 1.0
     * @access public
     */
    function add_author_entry()
    {
        global $author;
        $userdata = get_userdata( $author );
        $this->add_entry(
            esc_html__( 'Author:', 'zinco' ).' '.$userdata->display_name
        );
    }


    /**
     * Date
     *
     * @since 1.0
     * @access public
     */
    function add_date_entry()
    {
        if ( is_year() || is_month() || is_day() )
        {
            $this->add_entry(
                get_the_time( 'Y' ),
                get_year_link( get_the_time( 'Y' ) )
            );
        }
        if ( is_month() || is_day() )
        {
            $this->add_entry(
                get_the_time( 'F' ),
                get_month_link( get_the_time( 'Y' ), get_the_time( 'm' ) )
            );
        }
        if ( is_day() )
        {
            $this->add_entry(
                get_the_time( 'd' )
            );
        }
    }


    /**
     * Taxonomy
     *
     * @since 1.0
     * @access public
     */
    function add_tax_entry()
    {
        $this_term = $GLOBALS['wp_query']->get_queried_object();
        $taxonomy = get_taxonomy( $this_term->taxonomy );
        $entries = array(
            array(
                'label' => $taxonomy->labels->name
            )
        );

        if ( is_taxonomy_hierarchical( $this_term->taxonomy ) )
        {
            $term_ancestors = array_reverse( get_ancestors( $this_term->term_id, $this_term->taxonomy ) );

            foreach ( $term_ancestors as $key => $term_parent )
            {
                $term_parent = get_term( $term_parent, $this_term->taxonomy );
                $entries[] = array(
                    'label' => $term_parent->name,
                    'url'   => get_term_link( $term_parent )
                );
            }
        }

        $entries[] = array(
            'label' => $this_term->name,
            'url'   => get_term_link( $this_term )
        );

        /**
         * Filter taxonomy entries
         *
         * @since 1.1
         * @var array  $entries   Each entry needs to be an array with 'label' and 'url' keys.
         * @var object $this_term Current taxonomy term object
         */
        $entries = apply_filters( 'zinco_breadcrumb_taxonomy', $entries, $this_term );

        foreach ( $entries as $entry )
        {
            if ( ! is_array( $entry ) || empty( $entry['label'] ) )
            {
                continue;
            }

            if ( ! isset( $entry['url'] ) )
            {
                $entry['url'] = '';
            }

            $this->add_entry( $entry['label'], $entry['url'] );
        }
    }


    /**
     * Paged
     *
     * @since 1.0
     * @access public
     */
    function add_paged_entry()
    {
        $page = (int)get_query_var( 'paged' );

        if ( ! $page )
        {
            $page = (int)get_query_var( 'page' );
        }

        if ( $page > 1 )
        {
            $this->add_entry(
                apply_filters( 'zinco_breadcrumb_paged', sprintf( 'Page %s', $page ) ),
                ''
            );
        }
    }


    /**
     * Search
     *
     * @since 1.0
     * @access public
     */
    function add_search_entry()
    {
        $this->add_entry( $this->args['search_results_label'] );
    }


    /**
     * Produce category hierarchical and add to breadcumbs
     *
     * @since 1.0
     * @access public
     * @param integer $cat_obj Current category object. Blank means we are viewing category, and the last breadcrumb entry should not have link.
     */
    function add_category_ancestor_entry( $cat_obj = null )
    {
 
        if ( is_null( $cat_obj ) )
        {
            $cat_obj = get_category( $GLOBALS['wp_query']->get_queried_object() );
        }
        $cat_ancestors = array_reverse( get_ancestors( $cat_obj->term_id, 'category' ) );
        foreach ( $cat_ancestors as $key => $cat_parent )
        {
            $this->add_entry( get_cat_name( $cat_parent ), get_category_link( $cat_parent ) );
        }

        $this->add_entry( get_cat_name( $cat_obj->term_id ), get_category_link( $cat_obj->term_id ) );
    }


    /**
     * Breadcrumb for single post
     *
     * @since 1.0
     * @access public
     * 
     * @param  integer $post_id   Post id, default empty (inside loop)
     * @param  string  $permalink Permalink
     */
    function add_single_ancestor_entry( $post )
    {
        if ( ! is_a( $post, 'WP_Post' ) )
        {
            global $post;
        }

        $post_type = get_post_type( $post );

        if ( 'post' === $post_type )
        {
            $cat_obj = current( get_the_category( $post ) );

            if ( $cat_obj )
            {
                $this->add_category_ancestor_entry( $cat_obj );
                $this->add_entry( get_the_title( $post ), get_permalink( $post->ID ) );
            }

            return;
        }

        /**
         * Single ancestor for custom post types
         */
        $post_object = get_post_type_object( $post_type );
        $entries     = array();

        if ( $post_object )
        {
            $post_type_archive_link = $post_object->has_archive ? get_post_type_archive_link( get_post_type() ) : '';
            $entries[] = array(
                'label' => $post_object->labels->name,
                'url'   => $post_type_archive_link
            );
        }

        $entries[] = array(
            'label' => get_the_title(),
            'url'   => ''
        );

        /**
         * Filter entries for single custom post type
         *
         * @since 1.1
         * @var array  $entries Each entry needs to be an array with 'label' and 'url' keys.
         * @var object $post    Current post object
         */
        $entries = apply_filters( 'zinco_breadcrumb_single', $entries, $post );

        foreach ( $entries as $entry )
        {
            if ( ! is_array( $entry ) || empty( $entry['label'] ) )
            {
                continue;
            }

            if ( ! isset( $entry['url'] ) )
            {
                $entry['url'] = '';
            }

            $this->add_entry( $entry['label'], $entry['url'] );
        }
    }
}
