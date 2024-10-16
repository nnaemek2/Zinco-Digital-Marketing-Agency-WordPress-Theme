<?php
/**
 * Mega menu register
 *
 * @since   1.0
 * @author CaseThemes
 *
 */
if (!defined('ABSPATH')) {
    die();
}
require_once(CMS_INCLUDES . 'mega-menu/class-megamenu-walker.php');

class EFramework_MegaMenu_Register
{
    /**
     * Core singleton class
     *
     * @var self - pattern realization
     * @access private
     */
    private static $_instance;

    private $enable_megamenu;


    /**
     * Constructor
     *
     * @access private
     */
    function __construct()
    {
        add_action('admin_enqueue_scripts', array($this, 'cms_enqueue_style'));
        add_action('init', array($this, 'init'), 0);

        // Custom Fields - Add
        add_filter('wp_setup_nav_menu_item', array($this, 'setup_nav_menu_item'));

        // Custom Fields - Save
        add_action('wp_update_nav_menu_item', array($this, 'update_nav_menu_item'), 100, 3);

        // Custom Walker - Edit
        add_filter('wp_edit_nav_menu_walker', array($this, 'edit_nav_menu_walker'), 100, 2);

        add_action('init', array($this, 'register_mega_menu_type'));
    }

    function register_mega_menu_type()
    {
        unregister_nav_menu('key');
    }

    function init()
    {
        $this->enable_megamenu = apply_filters('cms_enable_megamenu', false);
        if ($this->enable_megamenu   === true) {
            $labels = array(
                'name'                  => _x('Mega Menus', 'Post Type General Name', CMS_TEXT_DOMAIN),
                'singular_name'         => _x('Mega Menu', 'Post Type Singular Name', CMS_TEXT_DOMAIN),
                'menu_name'             => __('Mega Menus', CMS_TEXT_DOMAIN),
                'name_admin_bar'        => __('Mega Menus', CMS_TEXT_DOMAIN),
                'archives'              => __('Item Archives', CMS_TEXT_DOMAIN),
                'parent_item_colon'     => __('Parent Item:', CMS_TEXT_DOMAIN),
                'all_items'             => __('All Items', CMS_TEXT_DOMAIN),
                'add_new_item'          => __('Add New Mega Menu', CMS_TEXT_DOMAIN),
                'add_new'               => __('Add New', CMS_TEXT_DOMAIN),
                'new_item'              => __('New Mega Menu', CMS_TEXT_DOMAIN),
                'edit_item'             => __('Edit Mega Menu', CMS_TEXT_DOMAIN),
                'update_item'           => __('Update Mega Menu', CMS_TEXT_DOMAIN),
                'view_item'             => __('View Mega Menu', CMS_TEXT_DOMAIN),
                'search_items'          => __('Search Mega Menu', CMS_TEXT_DOMAIN),
                'not_found'             => __('Not found', CMS_TEXT_DOMAIN),
                'not_found_in_trash'    => __('Not found in Trash', CMS_TEXT_DOMAIN),
                'featured_image'        => __('Featured Image', CMS_TEXT_DOMAIN),
                'set_featured_image'    => __('Set featured image', CMS_TEXT_DOMAIN),
                'remove_featured_image' => __('Remove featured image', CMS_TEXT_DOMAIN),
                'use_featured_image'    => __('Use as featured image', CMS_TEXT_DOMAIN),
                'insert_into_item'      => __('Insert into item', CMS_TEXT_DOMAIN),
                'uploaded_to_this_item' => __('Uploaded to this item', CMS_TEXT_DOMAIN),
                'items_list'            => __('Items list', CMS_TEXT_DOMAIN),
                'items_list_navigation' => __('Items list navigation', CMS_TEXT_DOMAIN),
                'filter_items_list'     => __('Filter items list', CMS_TEXT_DOMAIN),
            );
            $args = array(
                'label'               => __('Mega Menu', CMS_TEXT_DOMAIN),
                'labels'              => $labels,
                'supports'            => array('title', 'editor', 'revisions',),
                'hierarchical'        => false,
                'public'              => true,
                'show_ui'             => true,
                'show_in_menu'        => true,
                'menu_position'       => 25,
                'menu_icon'           => 'dashicons-align-center',
                'show_in_admin_bar'   => true,
                'show_in_nav_menus'   => false,
                'can_export'          => true,
                'has_archive'         => false,
                'exclude_from_search' => true,
                'publicly_queryable'  => false,
                'rewrite'             => false,
                'capability_type'     => 'page',
            );
            register_post_type('cms-mega-menu', $args);

        }
    }


    // Custom Fields - Add
    function setup_nav_menu_item($menu_item)
    {

        $menu_item->cms_megaprofile = get_post_meta($menu_item->ID, '_menu_item_cms_megaprofile', true);
        $menu_item->cms_icon = get_post_meta($menu_item->ID, '_menu_item_cms_icon', true);
        $menu_item->cms_onepage = get_post_meta($menu_item->ID, '_menu_item_cms_onepage', true);
        return $menu_item;
    }

    // Custom Fields - Save
    function update_nav_menu_item($menu_id, $menu_item_db_id, $menu_item_data)
    {

        if (isset($_REQUEST['menu-item-cms-megaprofile'][$menu_item_db_id])) {
            update_post_meta($menu_item_db_id, '_menu_item_cms_megaprofile', $_REQUEST['menu-item-cms-megaprofile'][$menu_item_db_id]);
        }
        if (isset($_REQUEST['menu-item-cms-icon'][$menu_item_db_id])) {
            update_post_meta($menu_item_db_id, '_menu_item_cms_icon', $_REQUEST['menu-item-cms-icon'][$menu_item_db_id]);
        }

        if (isset($_REQUEST['menu-item-cms-onepage'][$menu_item_db_id])) {
            update_post_meta($menu_item_db_id, '_menu_item_cms_onepage', $_REQUEST['menu-item-cms-onepage'][$menu_item_db_id]);
        }
    }

    // Custom Backend Walker - Edit
    function edit_nav_menu_walker($walker, $menu_id)
    {
        if (!class_exists('EFramework_Mega_Menu_Edit_Walker')) {
            require_once(CMS_INCLUDES . 'mega-menu/class-mega-menu-edit.php');
        }

        return 'EFramework_Mega_Menu_Edit_Walker';
    }

    function cms_enqueue_style()
    {
        wp_enqueue_style('jquery.fonticonpicker.min.css', CMS_CSS . 'iconpicker/css/jquery.fonticonpicker.min.css', array(), 'all');
        wp_enqueue_style('jquery.fonticonpicker.grey.min.css', CMS_CSS . 'iconpicker/themes/grey-theme/jquery.fonticonpicker.grey.min.css', array(), 'all');
        wp_enqueue_script('jquery.fonticonpicker.js', CMS_CSS . 'iconpicker/jquery.fonticonpicker.js', array('jquery'));
        wp_enqueue_script('', CMS_CSS . 'iconpicker/cms-iconpicker.js');
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