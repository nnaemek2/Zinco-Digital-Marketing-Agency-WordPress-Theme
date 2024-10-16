<?php
/**
 * @Template: field_cms_address_input.php
 * @since: 1.0.0
 * @author: CaseThemes
 * @descriptions:
 * @create: 17-Mar-18
 */

if (!defined('ABSPATH')) {
    exit;
}

if (!class_exists('ReduxFramework_cms_address_input')) {
    class ReduxFramework_cms_address_input
    {
        function __construct($field = array(), $value = '', $parent)
        {
            $this->parent = $parent;
            $this->field = $field;
            $this->value = $value;

            $this->extension_url = cms_redux_extensions()->extensions_url . 'cms_address_input/';
        }

        /**
         * Field Render Function.
         * Takes the vars and outputs the HTML for the field in the settings
         *
         * @since ReduxFramework 1.0.0
         */
        function render()
        {
            $readonly = (isset($this->field['readonly']) && $this->field['readonly']) ? ' readonly="readonly"' : '';
            $placeholder = (isset($this->field['placeholder']) && !is_array($this->field['placeholder'])) ? ' placeholder="' . esc_attr($this->field['placeholder']) . '" ' : '';
            echo '<input class="cms-address-input regular-text" type="text" id="' . $this->field['id'] . '" name="' . $this->field['name'] . $this->field['name_suffix'] . '" ' . $placeholder . 'value="' . esc_attr($this->value) . '" ' . $readonly . ' />';
        }

        public function enqueue()
        {
            if (!wp_script_is('cms_google_map_api')) {
                wp_enqueue_script('cms_google_map_api');
            }
            if (!wp_script_is('field_cms_address_input.js')) {
                wp_enqueue_script(
                    'field_cms_address_input.js',
                    $this->extension_url . 'inc/field_cms_address_input.js',
                    array('jquery'),
                    'all',
                    true
                );
            }
        }
    }
}