<?php
/**
 * Created by PhpStorm.
 * User: Quan
 * Date: 11/22/2017
 * Time: 9:21 AM
 */
if (!defined('ABSPATH')) {
    exit;
}

if (!class_exists('ReduxFramework_cms_select_file')) {
    class ReduxFramework_cms_select_file
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

            $this->extension_url = cms_redux_extensions()->extensions_url . 'cms_select_file/';
        }

        /**
         * Field Render Function.
         * Takes the vars and outputs the HTML for the field in the settings
         *
         * @since ReduxFramework 1.0.0
         */
        function render()
        {
            $attachment_icon = '';
            $att_title = '';
            if (!empty($this->value)) {
                $att_title = get_the_title($this->value);
                $attachment_icon = '<img src="'.home_url('/wp-includes/images/media/document.png').'" title="'.$att_title.'" alt="'.$att_title.'">';
            }
            ?>
            <div class="rc-select-file">
                <div class="rc-select-file-info">
                    <div class="rc-select-file-icon"><?php echo !empty($attachment_icon) ? $attachment_icon : "" ?></div>
                    <span class="rc-select-file-title"><?php echo !empty($att_title) ? $att_title : "" ?></span>
                </div>
                <div class="rc-select-file-action">
                    <?php
                    if(!empty($this->field['download']) && $this->field['download'] === true && !empty($this->value)){
                        ?>
                        <a href="<?php echo wp_get_attachment_url($this->value) ?>" target="_blank"><span class="button"><?php echo !empty($this->field['button_download'])?$this->field['button_download']:'Download' ?></span></a>
                        <?php
                    }
                    ?>
                    <span class="button select_file_upload"><?php echo $this->field['button_upload'] ?></span>
                    <span class="button select_file_remove"><?php echo $this->field['button_remove'] ?></span>
                    <input class="select-file-id" type="hidden" id="<?php echo $this->field['id'] ?>"
                           name="<?php echo $this->field['name'] ?>" value="<?php echo $this->value ?>">
                </div>
            </div>
            <?php
        }

        public function enqueue()
        {
            wp_enqueue_media();
            if (!wp_script_is('cms-select-file-js')) {
                wp_enqueue_script(
                    'cms-select-file-js',
	                $this->extension_url . 'inc/field_cms_select_file.js',
                    array('jquery'),
                    'all',
                    true
                );
            }
        }
    }
}