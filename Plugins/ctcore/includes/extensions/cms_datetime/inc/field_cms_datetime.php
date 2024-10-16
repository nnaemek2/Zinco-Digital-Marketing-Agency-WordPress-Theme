<?php
/**
 * @Template: field_cms_datetime.php
 * @since: 1.0.0
 * @author: CaseThemes
 * @descriptions:
 * @create: 23-Dec-17
 */

if (!defined('ABSPATH')) {
    exit;
}

if (!class_exists('ReduxFramework_cms_datetime')) {
    class ReduxFramework_cms_datetime
    {
        function __construct($field = array(), $value = '', $parent)
        {
            $this->parent = $parent;
            $this->field = $field;
            $this->value = $value;

            $this->extension_url = cms_redux_extensions()->extensions_url . 'cms_datetime/';
        }

        /**
         * Field Render Function.
         * Takes the vars and outputs the HTML for the field in the settings
         *
         * @since ReduxFramework 1.0.0
         */
        function render()
        {
            $qtip_title = isset($this->field['text_hint']['title']) ? 'qtip-title="' . $this->field['text_hint']['title'] . '" ' : '';
            $qtip_text = isset($this->field['text_hint']['content']) ? 'qtip-content="' . $this->field['text_hint']['content'] . '" ' : '';

            $readonly = (isset($this->field['readonly']) && $this->field['readonly']) ? ' readonly="readonly"' : '';
            $autocomplete = (isset($this->field['autocomplete']) && $this->field['autocomplete'] == false) ? ' autocomplete="off"' : '';
            $min = (isset($this->field['min'])) ? ' min="' . $this->field['min'] . '"' : '';
            $max = (isset($this->field['max'])) ? ' max="' . $this->field['max'] . '"' : '';
            $step = (isset($this->field['step'])) ? ' step="' . $this->field['step'] . '"' : '';

            $placeholder = (isset($this->field['placeholder']) && !is_array($this->field['placeholder'])) ? ' placeholder="' . esc_attr($this->field['placeholder']) . '" ' : '';
            echo '<input class="cms-datetime" ' . $min . $max . $step . $qtip_title . $qtip_text . 'type="text" id="' . $this->field['id'] . '" name="' . $this->field['name'] . $this->field['name_suffix'] . '" ' . $placeholder . 'value="' . esc_attr($this->value) . '" class="regular-text regular-number ' . $this->field['class'] . '"' . $readonly . $autocomplete . ' />';
        }

        public function enqueue()
        {
            wp_register_script('jquery-ui-timepicker-addon', 'https://cdnjs.cloudflare.com/ajax/libs/jquery-ui-timepicker-addon/1.6.3/jquery-ui-timepicker-addon.min.js', array('jquery'));
            wp_register_style('jquery-ui-timepicker-addon', 'https://cdnjs.cloudflare.com/ajax/libs/jquery-ui-timepicker-addon/1.6.3/jquery-ui-timepicker-addon.min.css', array());
            wp_register_style('jquery-ui-cms-datetime-css', CMS_ASSETS . 'extensions/css/jquery-ui.min.css');
            wp_register_script('jquery-ui-cms-datetime', CMS_ASSETS . 'extensions/js/jquery-ui.min.js', array('jquery'));

            wp_enqueue_script('jquery-ui-cms-datetime');
            wp_enqueue_script('jquery-ui-timepicker-addon');
            wp_enqueue_style('jquery-ui-timepicker-addon');
            wp_enqueue_style('jquery-ui-cms-datetime-css');

            if (!wp_script_is('cms-datetime-js')) {
                wp_enqueue_script(
                    'cms-datetime-js',
                    $this->extension_url . 'inc/field_cms_datetime.js',
                    array('jquery'),
                    time(),
                    true
                );
            }
        }
    }
}