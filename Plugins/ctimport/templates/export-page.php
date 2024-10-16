<?php
/**
 * @since: 1.0.0
 * @author: CaseThemes
 * @create: 16-Nov-17
 */
?>
<div class="swa-export-demos">
    <h3><?php echo esc_html__('Export', SWA_TEXT_DOMAIN) ?></h3>
    <form method="post" class="swa-export-contents">
        <div class="swa-export-name">
            <input required='' type="text" id="swa-ie-id" name="swa-ie-id" placeholder='<?php echo esc_html__('Name', SWA_TEXT_DOMAIN) ?>'>
        </div>
        <div class="swa-export-link">
            <input required='' type="text" id="swa-ie-link" name="swa-ie-link" placeholder='<?php echo esc_html__('Demo Link', SWA_TEXT_DOMAIN) ?>'>
        </div>
        <div class="swa-export-options">
            <h4><?php echo esc_html__('Select data:', SWA_TEXT_DOMAIN) ?></h4>
            <div class="swa-export-list-opt">
                <div class="swa-checkbox-wrap">
                    <div class="swa-checkbox">
                        <input id="swa-ie-data-media" name="swa-ie-data-type[]" type="checkbox" value="attachment" checked="checked">
                        <span></span>
                        <label for="swa-ie-data-media"><?php esc_html_e('Media', SWA_TEXT_DOMAIN); ?></label>
                    </div>
                </div>
                <div class="swa-checkbox-wrap">
                    <div class="swa-checkbox">
                        <input id="swa-ie-data-widget" name="swa-ie-data-type[]" type="checkbox" value="widgets"
                               checked="checked">
                        <span></span>
                        <label for="swa-ie-data-widget"><?php esc_html_e('Widgets', SWA_TEXT_DOMAIN); ?></label>
                    </div>
                </div>
                <div class="swa-checkbox-wrap">
                    <div class="swa-checkbox">
                        <input id="swa-ie-data-setting" name="swa-ie-data-type[]" type="checkbox" value="options"
                               checked="checked">
                        <span></span>
                        <label for="swa-ie-data-setting"><?php esc_html_e('WP Settings', SWA_TEXT_DOMAIN); ?></label>
                    </div>
                </div>
                <?php if (class_exists('ReduxFramework')): ?>
                    <div class="swa-checkbox-wrap">
                        <div class="swa-checkbox">
                            <input id="swa-ie-data-option" name="swa-ie-data-type[]" type="checkbox" value="settings"
                                   checked="checked">
                            <span></span>
                            <label for="swa-ie-data-option"><?php esc_html_e('Theme Options', SWA_TEXT_DOMAIN); ?></label>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if (function_exists('cptui_get_post_type_data')): ?>
                    <div class="swa-checkbox-wrap">
                        <div class="swa-checkbox">
                            <input id="swa-ie-data-posttype" name="swa-ie-data-type[]" type="checkbox" value="ctp_ui"
                                   checked="checked">
                            <span></span>
                            <label for="swa-ie-data-posttype"><?php esc_html_e('Post Type', SWA_TEXT_DOMAIN); ?></label>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="swa-checkbox-wrap">
                    <div class="swa-checkbox">
                        <input id="swa-ie-data-content" name="swa-ie-data-type[]" type="checkbox" value="content"
                               checked="checked">
                        <span></span>
                        <label for="swa-ie-data-content"><?php esc_html_e('Content', SWA_TEXT_DOMAIN); ?></label>
                    </div>
                </div>
                <?php if (class_exists('RevSlider')): ?>
                    <div class="swa-checkbox-wrap">
                        <div class="swa-checkbox">
                            <input id="swa-ie-data-rev" name="swa-ie-data-type[]" type="checkbox" value="revslider"
                                   checked="checked">
                            <span></span>
                            <label for="swa-ie-data-rev"><?php esc_html_e('Slider Revolution', SWA_TEXT_DOMAIN); ?></label>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <div class="swa-export-btn">
            <input type="hidden" name="action" value="swa-export">
            <button type="submit"
                    class="button button-primary create-demo"><?php esc_html_e('Create Demo', SWA_TEXT_DOMAIN); ?></button>
            <button type="submit" class="button button-primary download-demo" name="swa-ie-download"
                    value="swa"><?php esc_html_e('Download All Demos', SWA_TEXT_DOMAIN); ?></button>
        </div>
    </form>
</div>
