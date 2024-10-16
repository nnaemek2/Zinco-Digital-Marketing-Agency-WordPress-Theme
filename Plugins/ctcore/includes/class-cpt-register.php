<?php
/**
 * Custom post types register.
 * @since   1.0
 * @author CaseThemes
 *
 */

class EFramework_CPT_Register
{
    /**
     * Core singleton class
     *
     * @var self - pattern realization
     * @access private
     */
    private static $_instance;

    /**
     * Store supported post types in an array
     * @var array
     * @access private
     */
    private $post_types = array();

    /**
     * Constructor
     *
     * @access private
     */
    private function __construct()
    {
        add_action('init', array($this, 'init'), 0);
    }

    function init()
    {
        $this->post_types = apply_filters('cms_extra_post_types', array(
            'portfolio' => array()
        ));
        $this->post_types['portfolio'] = array_merge(
            array(
                'status'     => true,
                'item_name'  => __('Portfolio', CMS_TEXT_DOMAIN),
                'items_name' => __('Portfolios', CMS_TEXT_DOMAIN),
                'args'       => array(),
                'labels'     => array(
                    'singular_name' => __('Portfolio', CMS_TEXT_DOMAIN),
                    'add_new'       => _x('Add New', 'add new on admin panel', CMS_TEXT_DOMAIN),
                )
            ), $this->post_types['portfolio']
        );
        foreach ($this->post_types as $key => $cms_post_type) {
            if ($cms_post_type['status'] === true):
                $cms_post_type_args = !empty($cms_post_type['args']) ? $cms_post_type['args'] : array();
                $cms_post_type_labels = !empty($cms_post_type['labels']) ? $cms_post_type['labels'] : array();
                $args = array_merge(array(
                    'labels'              => array_merge(array(
                        'name'                  => $cms_post_type['item_name'],
                        'singular_name'         => $cms_post_type['item_name'],
                        'add_new'               => _x('Add New', 'add new on admin panel', CMS_TEXT_DOMAIN),
                        'add_new_item'          => __('Add New', CMS_TEXT_DOMAIN) . ' ' . $cms_post_type['item_name'],
                        'edit_item'             => __('Edit', CMS_TEXT_DOMAIN) . ' ' . $cms_post_type['item_name'],
                        'new_item'              => __('New', CMS_TEXT_DOMAIN) . ' ' . $cms_post_type['item_name'],
                        'view_item'             => __('View', CMS_TEXT_DOMAIN) . ' ' . $cms_post_type['item_name'],
                        'view_items'            => __('View', CMS_TEXT_DOMAIN) . ' ' . $cms_post_type['items_name'],
                        'search_items'          => __('Search', CMS_TEXT_DOMAIN) . ' ' . $cms_post_type['items_name'],
                        'not_found'             => __('No', CMS_TEXT_DOMAIN) . ' ' . $cms_post_type['items_name'] . ' ' . __('Found', CMS_TEXT_DOMAIN),
                        'not_found_in_trash'    => __('No', CMS_TEXT_DOMAIN) . ' ' . $cms_post_type['items_name'] . ' ' . __('Found in Trash', CMS_TEXT_DOMAIN),
                        'parent_item_colon'     => __('Parent', CMS_TEXT_DOMAIN) . ' ' . $cms_post_type['item_name'] . ':',
                        'all_items'             => __('All', CMS_TEXT_DOMAIN) . ' ' . $cms_post_type['items_name'],
                        'archives'              => $cms_post_type['item_name'] . ' ' . __('Archives', CMS_TEXT_DOMAIN),
                        'attributes'            => $cms_post_type['item_name'] . ' ' . __('Entry Attributes', CMS_TEXT_DOMAIN),
                        'uploaded_to_this_item' => __('Uploaded to this', CMS_TEXT_DOMAIN) . ' ' . $cms_post_type['item_name'],
                        'menu_name'             => $cms_post_type['item_name'],
                        'filter_items_list'     => __('Filter', CMS_TEXT_DOMAIN) . ' ' . $cms_post_type['item_name'] . ' ' . __('list', CMS_TEXT_DOMAIN),
                        'items_list_navigation' => $cms_post_type['item_name'] . ' ' . __('list navigation', CMS_TEXT_DOMAIN),
                        'items_list'            => $cms_post_type['item_name'] . ' ' . __('list', CMS_TEXT_DOMAIN),
                        'name_admin_bar'        => $cms_post_type['item_name']
                    ), $cms_post_type_labels),
                    'hierarchical'        => false,
                    'description'         => '',
                    'public'              => true,
                    'show_ui'             => true,
                    'show_in_menu'        => true,
                    'show_in_admin_bar'   => true,
                    'menu_position'       => null,
                    'menu_icon'           => 'dashicons-portfolio',
                    'show_in_nav_menus'   => true,
                    'publicly_queryable'  => true,
                    'exclude_from_search' => false,
                    'has_archive'         => true,
                    'query_var'           => true,
                    'can_export'          => true,
                    'capability_type'     => 'post',
                    'supports'            => array(
                        'title',
                        'editor',
                        'thumbnail',
                        'excerpt',
                        'revisions'
                    )
                ), $cms_post_type_args);
                register_post_type($key, $args);
                flush_rewrite_rules();
            endif;
        }
    }

    /**
     * Registers portfolio post type, this function should be called in an init hook function.
     * @uses $wp_post_types Inserts new post type object into the list
     *
     * @access protected
     */
    protected function type_portfolio_register()
    {

//        $portfolio_slug = function_exists('abtheme_get_opt') ? abtheme_get_opt('portfolio_slug', 'portfolio') : 'portfolio';
//        $args = apply_filters('casethemescore_portfolio_post_type_args', array(
//            'labels'              => array(
//                'name'                  => __('Portfolio', CMS_TEXT_DOMAIN),
//                'singular_name'         => __('Portfolio Entry', CMS_TEXT_DOMAIN),
//                'add_new'               => _x('Add New', 'add new on admin panel', CMS_TEXT_DOMAIN),
//                'add_new_item'          => __('Add New Portfolio Entry', CMS_TEXT_DOMAIN),
//                'edit_item'             => __('Edit Portfolio Entry', CMS_TEXT_DOMAIN),
//                'new_item'              => __('New Portfolio Entry', CMS_TEXT_DOMAIN),
//                'view_item'             => __('View Portfolio Entry', CMS_TEXT_DOMAIN),
//                'view_items'            => __('View Portfolio Entries', CMS_TEXT_DOMAIN),
//                'search_items'          => __('Search Portfolio Entries', CMS_TEXT_DOMAIN),
//                'not_found'             => __('No Portfolio Entries Found', CMS_TEXT_DOMAIN),
//                'not_found_in_trash'    => __('No Portfolio Entries Found in Trash', CMS_TEXT_DOMAIN),
//                'parent_item_colon'     => __('Parent Portfolio Entry:', CMS_TEXT_DOMAIN),
//                'all_items'             => __('All Entries', CMS_TEXT_DOMAIN),
//                'archives'              => __('Portfolio Archives', CMS_TEXT_DOMAIN),
//                'attributes'            => __('Portfolio Entry Attributes', CMS_TEXT_DOMAIN),
//                'insert_into_item'      => __('Insert into Portfolio Entry', CMS_TEXT_DOMAIN),
//                'uploaded_to_this_item' => __('Uploaded to this Portfolio Entry', CMS_TEXT_DOMAIN),
//                'menu_name'             => __('Portfolio', CMS_TEXT_DOMAIN),
//                'filter_items_list'     => __('Filter portfolio list', CMS_TEXT_DOMAIN),
//                'items_list_navigation' => __('Portfolio list navigation', CMS_TEXT_DOMAIN),
//                'items_list'            => __('Portfolio list', CMS_TEXT_DOMAIN),
//                'name_admin_bar'        => _x('Portfolio', 'add new on admin bar', CMS_TEXT_DOMAIN)
//            ),
//            'hierarchical'        => false,
//            'description'         => '',
//            'taxonomies'          => array('portfolio_category'),
//            'public'              => true,
//            'show_ui'             => true,
//            'show_in_menu'        => true,
//            'show_in_admin_bar'   => true,
//            'menu_position'       => null,
//            'menu_icon'           => 'dashicons-portfolio',
//            'show_in_nav_menus'   => true,
//            'publicly_queryable'  => true,
//            'exclude_from_search' => false,
//            'has_archive'         => true,
//            'query_var'           => true,
//            'can_export'          => true,
//            'rewrite'             => array(
//                'slug'       => $portfolio_slug,
//                'with_front' => false,
//                'pages'      => true
//            ),
//            'capability_type'     => 'post',
//            'supports'            => array(
//                'title',
//                'editor',
//                'thumbnail',
//                'excerpt',
//                'revisions'
//            )
//        ));
    }

    /**
     * Get instance of the class
     *
     * @access public
     * @return object this
     */
    public static function get_instance()
    {
        if (!(self::$_instance instanceof self)) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }
}