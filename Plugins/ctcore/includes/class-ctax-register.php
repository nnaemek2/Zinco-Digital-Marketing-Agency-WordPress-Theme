<?php
/**
 * Custom taxonomies register
 *
 * @package CTFramework
 * @since   1.0
 */

class EFramework_CTax_Register
{
    /**
     * Core singleton class
     *
     * @var self - pattern realization
     * @access private
     */
    private static $_instance;

    /**
     * Store supported taxonomies in an array
     * @var array
     * @access private
     */
    private $taxonomies = array();

    /**
     * Constructor
     *
     * @access private
     */
    function __construct()
    {
        add_action('init', array($this, 'init'), 0);
    }

    /**
     * init hook - 0
     */
    function init()
    {
        $this->taxonomies = apply_filters('cms_extra_taxonomies', array(
            'portfolio-category' => array(
                'status'     => true,
                'post_type'  => array('portfolio'),
                'taxonomy'   => esc_html__('Portfolio Category', CMS_TEXT_DOMAIN),
                'taxonomies' => esc_html__('Portfolio Categories', CMS_TEXT_DOMAIN),
                'args'       => array(),
                'labels'     => array()
            ),
        ));
        foreach ($this->taxonomies as $key => $cms_taxonomy) {
            if ($cms_taxonomy['status'] === true) {
                $categories = array_merge(array(
                    'hierarchical'  => true,
                    'show_ui'      => true,
                    'labels'        => array_merge(array(
                        'name'              => $cms_taxonomy['taxonomies'],
                        'singular_name'     => $cms_taxonomy['taxonomy'],
                        'edit_item'         => esc_html__('Edit', CMS_TEXT_DOMAIN) . ' ' . $cms_taxonomy['taxonomy'],
                        'update_item'       => esc_html__('Update', CMS_TEXT_DOMAIN) . ' ' . $cms_taxonomy['taxonomy'],
                        'add_new_item'      => esc_html__('Add New', CMS_TEXT_DOMAIN) . ' ' . $cms_taxonomy['taxonomy'],
                        'new_item_name'     => esc_html__('New Type', CMS_TEXT_DOMAIN) . ' ' . $cms_taxonomy['taxonomy'],
                        'all_items'         => esc_html__('All', CMS_TEXT_DOMAIN) . ' ' . $cms_taxonomy['taxonomies'],
                        'search_items'      => esc_html__('Search', CMS_TEXT_DOMAIN) . ' ' . $cms_taxonomy['taxonomy'],
                        'parent_item'       => esc_html__('Parent', CMS_TEXT_DOMAIN) . ' ' . $cms_taxonomy['taxonomy'],
                        'parent_item_colon' => esc_html__('Parent', CMS_TEXT_DOMAIN) . ' ' . $cms_taxonomy['taxonomy'] . ':',
                    ), $cms_taxonomy['labels']),
                    'show_in_menu'  => true,
                    'rewrite'      => array(
                        'slug' => $key
                    )
                ), $cms_taxonomy['args']);

                register_taxonomy($key, $cms_taxonomy['post_type'], $categories);
            }
        }

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