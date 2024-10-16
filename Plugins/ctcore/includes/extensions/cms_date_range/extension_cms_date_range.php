<?php
/**
 * @Template: extension_cms_datetime.php
 * @since: 1.0.0
 * @author: CaseThemes
 * @descriptions:
 * @create: 23-Dec-17
 */

if (!defined('ABSPATH')) {
    exit;
}

if (!class_exists('CMS_Redux_Extensions_cms_date_range')) {

    class CMS_Redux_Extensions_cms_date_range
    {

        protected $parent;
        public $extension_url;
        public $extension_dir;
        public static $theInstance;
        public static $version = "1.0.0";
        public $is_field = false;
        public $field_name;

        public function __construct($parent)
        {
            $this->parent = $parent;
            $this->field_name = 'cms_date_range';

            self::$theInstance = $this;

            $this->is_field = Redux_Helpers::is_field_in_use($parent, $this->field_name);

            add_filter('redux/' . $this->parent->args['opt_name'] . '/field/class/' . $this->field_name, array(
                $this,
                'overload_field_path'
            ));
        }

        public function overload_field_path($field)
        {
            return dirname(__FILE__) . '/inc/field_' . $this->field_name . '.php';
        }
    }
}
