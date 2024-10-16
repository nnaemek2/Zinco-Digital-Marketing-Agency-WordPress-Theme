<?php
/**
 * @Template: Import demo page
 * @version: 1.0.0
 * @author: CaseThemes
 * @descriptions: Display for import demo page in Dashboard framework
 */

$demo_list = swa_ie()->get_all_demo_folder();
$current_demo_installed = get_option('ct_ie_demo_installed', '');
$path = swa_ie()->theme_dir;
$url = swa_ie()->theme_url;

$_search = array('M','G','K','m','g','k');
$memory_limit = (int)str_replace($_search, [], ini_get("memory_limit"));
$max_time = (int)ini_get("max_execution_time");
$post_max_size = (int)str_replace($_search, [], ini_get('post_max_size'));
$php_ver = PHP_VERSION;
$_notice = ($memory_limit < 128 || $max_time < 60 || $post_max_size < 32) ? 'swa-ie-warning' : 'swa-ie-good';

?>
<div class="wrap">
    <div class="swa-ie-dashboard">
        <div class="swa-field-info <?php echo esc_attr($_notice); ?>">
            <table class="swa-server-info">
                <tr>
                    <th><?php esc_html_e('PHP Version:', SWA_TEXT_DOMAIN); ?></th>
                    <td><i class="dashicons dashicons-yes" style="color: #31f531"></i></td>
                    <td style="color: #0d880b"><?php echo esc_html($php_ver); ?></td>
                </tr>
                <tr>
                    <th><?php esc_html_e('Memory Limit:', SWA_TEXT_DOMAIN) ?></th>
                    <?php if($memory_limit >= 128): ?>
                        <td><i class="dashicons dashicons-yes" style="color: #31f531"></i></td>
                        <td style="color: #0d880b"><?php echo sprintf(esc_html__('Currently: %s (Mb)', ''), $memory_limit); ?></td>
                    <?php else: ?>
                        <td><i class="dashicons dashicons-no" style="color: red"></i></td>
                        <td style="color: red"><?php echo sprintf(esc_html__('Currently: %s (the minimum required 128M)', ''), $memory_limit); ?></td>
                    <?php endif; ?>
                </tr>
                <tr>
                    <th><?php esc_html_e('Max. Execution Time:', SWA_TEXT_DOMAIN) ?></th>
                    <?php if($max_time >= 60): ?>
                        <td><i class="dashicons dashicons-yes" style="color: #31f531"></i></td>
                        <td style="color: #0d880b"><?php echo sprintf(esc_html__('Currently: %s (s)', ''), $max_time); ?></td>
                    <?php else: ?>
                        <td><i class="dashicons dashicons-no" style="color: red"></i></td>
                        <td style="color: red"><?php echo sprintf(esc_html__('Currently: %ss (the minimum required 60s)', ''), $max_time); ?></td>
                    <?php endif; ?>
                </tr>
                <tr>
                    <th><?php esc_html_e('Max. Post Size:', SWA_TEXT_DOMAIN) ?></th>
                    <?php if($post_max_size >= 32): ?>
                        <td><i class="dashicons dashicons-yes" style="color: #31f531"></i></td>
                        <td style="color: #0d880b"><?php echo sprintf(esc_html__('Currently: %s (Mb)', ''), $post_max_size); ?></td>
                    <?php else: ?>
                        <td><i class="dashicons dashicons-no" style="color: red"></i></td>
                        <td style="color: red"><?php echo sprintf(esc_html__('Currently: %s (the minimum required 32M)', ''), $post_max_size); ?></td>
                    <?php endif; ?>
                </tr>
            </table>
            </p>
        </div>
        
        <div class="swa-import-demos">
            <div class="swa-import-contains">
                <?php
                if (!empty($demo_list)):
                    foreach ($demo_list as $demo):
                        $file_demo_info = $path . $demo . '/demo-info.json';
                        $demo_installed = $current_demo_installed === $demo ? true : false;
                        if (file_exists($file_demo_info)):
                            $info_demo = json_decode(file_get_contents($file_demo_info), true);
                            ?>
                            <form method="post" class="swa-ie-demo-item" data-demo="demo-<?php echo $demo ?>"
                                  id="demo-<?php echo $demo ?>">
                                <div class="swa-ie-item-inner">
                                    <div class="swa-ie-image">
                                        <img src="<?php echo $url . $demo . '/screenshot.png' ?>" alt="">
                                        <a class="swa-ie-preview" href="<?php echo esc_attr($info_demo['link']) ?>"
                                           target="_blank">
                                            <span><?php esc_html_e('View Demo', SWA_TEXT_DOMAIN) ?></span>
                                        </a>
                                    </div>
                                    <div class="swa-ie-meta">
                                        <h4 class="swa-ie-demo-title"><?php echo esc_attr($info_demo['name']) ?></h4>
                                        <input type="hidden" name="swa-ie-id" value="<?php echo esc_attr($demo) ?>">
                                        <input type="hidden" name="action" value="swa-import">
                                        <?php if($demo_installed === false) : ?>
                                            <button class="swa-import-btn swa-import-submit button button-primary" name="swa-import-submit" value="<?php echo base64_encode($demo) ?>"><?php echo esc_html__('Import Demo', SWA_TEXT_DOMAIN); ?></button>
                                        <?php endif; ?>
                                    </div>
                                    <div class="swa-loading" style="display: none">
                                        <span class="swa-pinner"><span class="fa fa-spinner fa-spin"></span></span>
                                    </div>
                                </div>
                            </form>
                        <?php
                        endif;
                    endforeach;
                else:
                    ?>
                    <div class="swa-ie-demo-empty">
                        <span class="dashicons dashicons-warning"></span>
                        <h4 class="swa-ie-notice-empty"><?php echo esc_html__('Demos data is empty') ?></h4>
                    </div>
                <?php
                endif;
                ?>
            </div>
        </div>
        <?php
        if (!empty($export_mode)) {
            include_once swa_ie()->plugin_dir . 'templates/export-page.php';
        }
        ?>
    </div>
</div>
