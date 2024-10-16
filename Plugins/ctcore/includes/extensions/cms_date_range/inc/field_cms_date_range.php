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

if (!class_exists('ReduxFramework_cms_date_range')) {
    class ReduxFramework_cms_date_range
    {

        /**
         * Field Constructor.
         * Required - must call the parent constructor, then assign field and value to vars, and obviously call the render field function
         *
         * @since ReduxFramework 1.0.0
         */
        function __construct($field = array(), $value = '', $parent)
        {
            $this->parent = $parent;
            $this->field = $field;
            $this->value = $value;

            $this->extension_url = cms_redux_extensions()->extensions_url . 'cms_date_range/';
        }

        /**
         * Field Render Function.
         * Takes the vars and outputs the HTML for the field in the settings
         *
         * @since ReduxFramework 1.0.0
         */
        function render()
        {
            $range = isset($this->field['range']) ? $this->field['range'] : true;
            if ($range === true) {
                $start_date = !empty($this->value[$this->field['from']['name']]) ? esc_attr($this->value[$this->field['from']['name']]) : "";
                $end_date = !empty($this->value[$this->field['to']['name']]) ? esc_attr($this->value[$this->field['to']['name']]) : "";
                echo '<label for="' . $this->field['id'] . '-from">' . $this->field['from']['label'] . '</label>';
                echo '<input class="cms-datetime-range-from" ' . 'type="text" id="' . $this->field['id'] . '-from" name="' . $this->field['name'] . '[' . $this->field['from']['name'] . ']"' . ' value="' . esc_attr($start_date) . '" />';

                echo '<label for="' . $this->field['id'] . '-to">' . $this->field['to']['label'] . '</label>';
                echo '<input class="cms-datetime-range-to" ' . 'type="text"' . 'id="' . $this->field['id'] . '-to" name="' . $this->field['name'] . '[' . $this->field['to']['name'] . ']' . '" ' . ' value="' . esc_attr($end_date) . '" />';
            } else {
                echo '<input class="cms-date" ' . 'type="text" id="' . $this->field['id'] . '" name="' . $this->field['name'] . '"' . ' value="' . esc_attr($this->value) . '" />';
            }
        }

        public function enqueue()
        {
            wp_register_style('jquery-ui-date-range-css', CMS_ASSETS . 'extensions/css/jquery-ui.min.css');
            wp_register_script('jquery-ui-js', CMS_ASSETS . 'extensions/js/jquery-ui.min.js', array('jquery'));

            wp_enqueue_script('jquery-ui-js');
            wp_enqueue_style('jquery-ui-date-range-css');

            if (!wp_script_is('cms-date-range-js')) {
                wp_enqueue_script(
                    'cms-date-range-js',
                    $this->extension_url . 'inc/field_cms_date_range' . Redux_Functions::isMin() . '.js',
                    array('jquery'),
                    time(),
                    true
                );
            }
        }
    }
}