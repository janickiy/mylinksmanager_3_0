<?php

/********************************************
 * My Links Manager 3.0.0 alfa
 * Copyright (c) 2011-2018 Alexander Yanitsky
 * Website: http://janicky.com
 * E-mail: janickiy@mail.ru
 * Skype: janickiy
 ********************************************/

defined('MYLINKSMANAGER') || exit('My Links Manager: access denied!');

Auth::authorization();

$update = new Update(core::getSetting('language'), VERSION);
$newversion = $update->getVersion();
$currentversion = VERSION;

//include template
core::requireEx('libs', "html_template/SeparateTemplate.php");
$tpl = SeparateTemplate::instance()->loadSourceFromFile(core::getTemplate() . "admin/update.tpl");

$tpl->assign('TITLEPAGE', core::getLanguage('title', 'admin_page_update'));
$tpl->assign('TITLE', core::getLanguage('title', 'admin_update'));
$tpl->assign('HELP', core::getLanguage('info', 'admin_update'));

include_once core::pathTo('extra', 'admin/top.php');

if ($update->checkNewVersion() && $update->checkTree()){
    $button_update = core::getLanguage('button', 'update');
    $button_update = str_replace('%NEW_VERSION%', $newversion, $button_update);
    $button_update = str_replace('%SCRIPT_NAME%', core::getLanguage('script', 'name'), $button_update);
    $tpl->assign('BUTTON_UPDATE', $button_update);
} else {
    $no_updates = core::getLanguage('msg', 'no_updates');
    $no_updates = str_replace('%SCRIPT_NAME%', core::getLanguage('script', 'name'), $no_updates);
    $no_updates = str_replace('%NEW_VERSION%', VERSION, $no_updates);
    $tpl->assign('MSG_NO_UPDATES', $no_updates);
}

//menu
include_once core::pathTo('extra', 'admin/menu.php');

//footer
include_once core::pathTo('extra', 'admin/footer.php');

//display content
$tpl->display();