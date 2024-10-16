<?php
/**
 *
 * Plugin Name: CTCore
 * Plugin URI: http://casethemes.net/plugins/ctcore
 * Description: This plugin is package compilation some addons, which is developed by CaseThemes for Visual Comporser plugin.
 * Version: 1.0.9
 * Author: CaseThemes
 * Author URI: http://casethemes.net
 * Text Domain: ctcore
 */
define('CMS_NAME', 'ctcore');
define('CMS_DIR', plugin_dir_path(__FILE__));
define('CMS_URL', plugin_dir_url(__FILE__));
define('CMS_LIBRARIES', CMS_DIR . "libraries" . DIRECTORY_SEPARATOR);
define('CMS_LANGUAGES', CMS_DIR . "languages" . DIRECTORY_SEPARATOR);
define('CMS_TEMPLATES', CMS_DIR . "templates" . DIRECTORY_SEPARATOR);
define('CMS_INCLUDES', CMS_DIR . "includes" . DIRECTORY_SEPARATOR);

define('CMS_ASSETS', CMS_URL . "assets/");
define('CMS_CSS', CMS_URL . "assets/css/");
define('CMS_JS', CMS_URL . "assets/js/");
define('CMS_IMAGES', CMS_URL . "assets/images/");
define('CMS_TEXT_DOMAIN', 'ctcore');

if(file_exists(WP_PLUGIN_DIR . '/redux-framework/redux-framework.php')){
    $default_headers = array(
        'Name'        => 'Plugin Name',
        'PluginURI'   => 'Plugin URI',
        'Version'     => 'Version',
        'Description' => 'Description',
        'Author'      => 'Author',
        'AuthorURI'   => 'Author URI',
        'TextDomain'  => 'Text Domain',
        'DomainPath'  => 'Domain Path',
        'Network'     => 'Network',
        'RequiresWP'  => 'Requires at least',
        'RequiresPHP' => 'Requires PHP',
        // Site Wide Only is deprecated in favor of Network.
        '_sitewide'   => 'Site Wide Only',
    );
    $reduxFrameworkData = get_file_data( WP_PLUGIN_DIR . '/redux-framework/redux-framework.php', $default_headers, 'plugin' );
    if(!class_exists('ReduxFrameworkInstances') && version_compare( $reduxFrameworkData['Version'], '4.0.0', '>=' )){
        require_once CMS_DIR . 'includes/redux/class-ReduxFrameworkInstances.php';
    }
}

/**
 * Require functions on plugin
 */
require_once CMS_INCLUDES . "functions.php";
require_once CMS_INCLUDES . "cms-template-functions.php";
//new CaseThemeCore();

/**
 * CaseThemeCore Class
 *
 */
class CaseThemeCore
{
    /**
     * Core singleton class
     *
     * @var self - pattern realization
     * @access private
     */
    private static $_instance;

    public $file;

    /**
     * Store plugin paths
     *
     * @since 1.0
     * @access private
     * @var array
     */
    private $paths = array();

    public $post_metabox = null;

    protected $post_format_metabox = null;

    protected $taxonomy_meta = null;

    protected $user_meta = null;

    public function __construct()
    {
        $dir = untrailingslashit(plugin_dir_path(__FILE__));
        $url = untrailingslashit(plugin_dir_url(__FILE__));
        $this->file = __FILE__;
        $this->set_paths(array(
            'APP_DIR' => $dir,
            'APP_URL' => $url
        ));
        self::includes();

        /**
         * Init function, which is run on site init and plugin loaded
         */
        add_action('init', array($this, 'cmsInit'),2);
        add_action('plugins_loaded', array($this, 'cmsActionInit'));
        register_activation_hook(__FILE__, array($this, 'activation_hook'));

        if (!class_exists('EFramework_enqueue_scripts')) {
            require_once $this->path('APP_DIR', 'includes/class-enqueue-scripts.php');
        }

        if (!class_exists('EFramework_CPT_Register')) {
            require_once CMS_INCLUDES . 'class-cpt-register.php';
            EFramework_CPT_Register::get_instance();
        }

        if (!class_exists('EFramework_CTax_Register')) {
            require_once CMS_INCLUDES . 'class-ctax-register.php';
            EFramework_CTax_Register::get_instance();
        }

        if (!class_exists('EFramework_MegaMenu_Register')) {
            require_once CMS_INCLUDES . 'mega-menu/class-megamenu.php';
            EFramework_MegaMenu_Register::get_instance();
        }


        if (!class_exists('EFramework_menu_handle')) {
            require_once CMS_INCLUDES . 'class-menu-hanlde.php';
        }

        /**
         * Enqueue Scripts on plugin
         */
        add_action('wp_enqueue_scripts', array($this, 'cms_register_style'));
        add_action('wp_enqueue_scripts', array($this, 'cms_register_script'));
        add_action('admin_enqueue_scripts', array($this, 'cms_admin_script'));

        /**
         * Visual Composer action
         */
        add_action('vc_before_init', array($this, 'cmsShortcodeRegister'));
        add_action('vc_after_init', array($this, 'cmsShortcodeAddParams'), 11);

        /**
         * widget text apply shortcode
         */
        add_filter('widget_text', 'do_shortcode');
    }

    function cmsActionInit()
    {
        global $wp_filesystem;
        // Localization
        load_plugin_textdomain(CMS_NAME, false, CMS_LANGUAGES);

        /* Add WP_Filesystem. */
        if (!class_exists('WP_Filesystem')) {
            require_once(ABSPATH . 'wp-admin/includes/file.php');
            WP_Filesystem();
        }
    }

    function cmsInit()
    {
        if (apply_filters('cms_scssc_on', false)) {
            // scss compiler library
            if (!class_exists('scssc')) {
                require_once CMS_LIBRARIES . 'scss.inc.php';
            }
        }

        if (apply_filters('cms_crop_images', false)) {
	        cms_crop_images();
        }

        if (!class_exists('ReduxFramework')) {
            add_action('admin_notices', array($this, 'redux_framework_notice'));
        } else {
            // Late at 30 to be sure that other extensions available via same hook.
            // Eg: Load extensions at 29 or lower.
//            add_action("redux/extensions/before", array($this, 'redux_extensions'), 30);
            if (!class_exists('CMS_Redux_Extensions')) {
                require_once $this->path('APP_DIR', 'includes/class-redux-extensions.php');
            }
            if (!class_exists('CMS_Post_Metabox')) {
                require_once $this->path('APP_DIR', 'includes/class-post-metabox.php');

                if (empty($this->post_metabox)) {
                    $this->post_metabox = new CMS_Post_Metabox();
                }
            }
            if (!class_exists('CMS_Taxonomy_Meta')) {
                require_once $this->path('APP_DIR', 'includes/class-taxonomy-meta.php');

                if (empty($this->taxonomy_meta)) {
                    $this->taxonomy_meta = new CMS_Taxonomy_Meta();
                }
            }
        }
    }

    function cmsShortcodeRegister()
    {
        //Load required libararies
        require_once CMS_INCLUDES . 'cms_shortcodes.php';
    }

    function cmsShortcodeAddParams()
    {
        $extra_params_folder = get_template_directory() . '/vc_params';
        $files = cmsFileScanDirectory($extra_params_folder, '/cms_.*\.php/');
        if (!empty($files)) {
            foreach ($files as $file) {
                if (WPBMap::exists($file->name)) {
                    if (isset($params)) {
                        unset($params);
                    }
                    include $file->uri;
                    if (isset($params) && is_array($params)) {
                        foreach ($params as $param) {
                            if (is_array($param)) {
                                $param['group'] = __('Template', CMS_NAME);
                                $param['edit_field_class'] = isset($param['edit_field_class']) ? $param['edit_field_class'] . ' cms_custom_param vc_col-sm-12 vc_column' : 'cms_custom_param vc_col-sm-12 vc_column';
                                $param['class'] = 'cms-extra-param';
                                if (isset($param['template']) && !empty($param['template'])) {
                                    if (!is_array($param['template'])) {
                                        $param['template'] = array($param['template']);
                                    }
                                    $param['dependency'] = array("element" => "cms_template", "value" => $param['template']);

                                }
                                vc_add_param($file->name, $param);
                            }
                        }
                    }
                }
            }
        }
    }

    /**
     * Function register stylesheet on plugin
     */
    function cms_register_style()
    {
        wp_enqueue_style('cms-plugin-stylesheet', CMS_CSS . 'cms-style.css');
        wp_enqueue_style('owl-carousel', CMS_CSS . 'owl.carousel.min.css');
    }

    /**
     * Function register script on plugin
     */
    function cms_register_script()
    {
        wp_register_script('modernizr', CMS_JS . 'modernizr.min.js', array('jquery'));
        wp_register_script('waypoints', CMS_JS . 'waypoints.min.js', array('jquery'));
        wp_register_script('owl-carousel', CMS_JS . 'owl.carousel.min.js', array('jquery'));
    }

    /**
     * Function register admin on plugin
     */
    function cms_admin_script()
    {
        wp_enqueue_style('admin-style', CMS_CSS . 'admin.css', array(), '1.0.0');
        wp_enqueue_style('font-awesome', CMS_CSS . 'font-awesome.min.css', array(), 'all');
    }

    /**
     * Setter for paths
     *
     * @since  1.0
     * @access protected
     *
     * @param array $paths
     */
    protected function set_paths($paths = array())
    {
        $this->paths = $paths;
    }

    /**
     * Gets absolute path for file/directory in filesystem.
     *
     * @since  1.0
     * @access public
     *
     * @param string $name - name of path path
     * @param string $file - file name or directory inside path
     *
     * @return string
     */
    function path($name, $file = '')
    {
        return $this->paths[$name] . (strlen($file) > 0 ? '/' . preg_replace('/^\//', '', $file) : '');
    }

    /**
     * Get url for asset files
     *
     * @since  1.0
     * @access public
     *
     * @param  string $file - filename
     * @return string
     */
    function get_url($file = '')
    {
        return esc_url($this->path('APP_URL', $file));
    }

    /**
     * Get template file full path
     * @param  string $file
     * @param  string $default
     * @return string
     */
    function get_template($file, $default)
    {
        $path = locate_template($file);
        if ($path) {
            return $path;
        }
        return $default;
    }

    function is_min()
    {
        $dev_mode = defined('WP_DEBUG') && WP_DEBUG;
        if ($dev_mode) {
            return '';
        } else {
            return '.min';
        }
    }


    /**
     * Redux Framework notices
     *
     * @since 1.0
     * @access public
     */
    function redux_framework_notice()
    {
        $plugin_name = '<strong>' . esc_html__("CTCore", CMS_TEXT_DOMAIN) . '</strong>';
        $redux_name = '<strong>' . esc_html__("Redux Framework", CMS_TEXT_DOMAIN) . '</strong>';

        echo '<div class="notice notice-warning is-dismissible">';
        echo '<p>';
        printf(
            esc_html__('%1$s require %2$s installed and activated. Please active %3$s plugin', CMS_TEXT_DOMAIN),
            $plugin_name,
            $redux_name,
            $redux_name
        );
        echo '</p>';
        printf('<button type="button" class="notice-dismiss"><span class="screen-reader-text">%s</span></button>', esc_html__('Dismiss this notice.', CMS_TEXT_DOMAIN));
        echo '</div>';
    }


    /**
     * Action handle when active plugin
     *
     * Check Redux framework active
     */
    function activation_hook()
    {
        if (is_admin()) {
            if (!is_plugin_active('redux-framework/redux-framework.php')) {
                deactivate_plugins(plugin_basename(__FILE__));

                $plugin_name = '<strong>' . esc_html__("CTCore", CMS_TEXT_DOMAIN) . '</strong>';
                $redux_name = '<strong>' . esc_html__("Redux Framework", CMS_TEXT_DOMAIN) . '</strong>';
                ob_start();

                printf(
                    esc_html__('%1$s requires %2$s installed and activated. Currently it is either not installed or installed but not activated. Please follow these steps to get %1$s up and working:', CMS_TEXT_DOMAIN),
                    $plugin_name,
                    $redux_name
                );

                printf(
                    "<br/><br/>1. " . esc_html__('Go to %1$s to check if %2$s is installed. If it is, activate it then activate %3$s.', CMS_TEXT_DOMAIN),
                    sprintf('<strong><a href="%1$s">%2$s</a></strong>', esc_url(admin_url('plugins.php')), esc_html__('Plugins/Installed Plugins', CMS_TEXT_DOMAIN)),
                    $redux_name,
                    $plugin_name
                );

                printf(
                    "<br/><br/>2. " . esc_html__('If %1$s is not installed, go to %2$s, search for %1$s, install and activate %1$s, then activate %3$s.', CMS_TEXT_DOMAIN),
                    $redux_name,
                    sprintf('<strong><a href="%1$s">%2$s</a></strong>', esc_url(admin_url('plugin-install.php?s=Redux+Framework&tab=search&type=term')), esc_html__('Plugins/Add New')),
                    $plugin_name
                );

                $message = ob_get_clean();

                wp_die($message, esc_html__('Plugin Activation Error', CMS_TEXT_DOMAIN), array('back_link' => true));
            }
        }
    }


    /**
     * Load our ReduxFramework extensions
     *
     * @since 1.0
     * @param  ReduxFramework $redux
     */
    function redux_extensions($redux)
    {
        if (!class_exists('CMS_Redux_Extensions')) {
            require_once $this->path('APP_DIR', 'includes/class-redux-extensions.php');
        }
        if (!class_exists('CMS_Post_Metabox')) {
            require_once $this->path('APP_DIR', 'includes/class-post-metabox.php');

            if (empty($this->post_metabox)) {
                $this->post_metabox = new CMS_Post_Metabox($redux);
            }
        }
        if (!class_exists('CMS_Taxonomy_Meta')) {
            require_once $this->path('APP_DIR', 'includes/class-taxonomy-meta.php');

            if (empty($this->taxonomy_meta)) {
                $this->taxonomy_meta = new CMS_Taxonomy_Meta($redux);
            }
        }

//        if (!class_exists('CMS_User_Meta')) {
//            require_once $this->path('APP_DIR', 'includes/class-user-meta.php');
//
//            if (empty($this->user_meta)) {
//                $this->user_meta = new CMS_User_Meta($redux);
//            }
//        }
    }

    private function includes()
    {
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


/**
 * Get instance of CaseThemeCore
 *
 * @since  1.0
 * @return CaseThemeCore instance
 */
function casethemescore()
{
    return CaseThemeCore::get_instance();
}

$GLOBALS['casethemescore'] = casethemescore();

?>