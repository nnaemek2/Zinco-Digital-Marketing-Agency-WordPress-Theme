<?php
/**
 * Created by PhpStorm.
 * User: CaseThemes Team
 * Date: 8/13/2016
 * Time: 10:29 AM
 */
function swa_git_shell(){

    if(!swa_git_exists()) return;

    $log = shell_exec('cd '.get_template_directory().' && git reset --hard origin/master 2>&1; git pull 2>&1; git add --all 2>&1; git commit -m Demo 2>&1; git push 2>&1');
    global $import_result;
    $import_result[] = esc_html__('Git sync successfully!', SWA_TEXT_DOMAIN);

}

function swa_git_exists(){
    $git = get_template_directory() . '/.git';

    if(!is_dir($git)) return false;

    return true;
}