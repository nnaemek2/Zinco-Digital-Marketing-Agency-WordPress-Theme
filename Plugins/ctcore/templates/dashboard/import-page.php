<?php
/**
 * @Template: Import demo page
 * @version: 1.0.0
 * @author: CaseThemes
 * @descriptions: Display for import demo page in Dashboard framework
 */
?>
<div class="wrap">
    <div class="abcore-dashboard">
        <header class="abcore-dashboard-header">
            <div class="abcore-dashboard-title">
                <h1><?php echo esc_attr($this->theme_name) ?></h1>
            </div>
        </header>
        <div class="abcore-import-demos">
            <h2><?php echo esc_html__('Import Demos', CMS_TEXT_DOMAIN) ?></h2>
        </div>
        <?php
        if (!empty($export_mode)) {
            get_template_part('core/templates/dashboard/export-page.php');
        }
        ?>
    </div>
</div>
