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

//include template
core::requireEx('libs', "html_template/SeparateTemplate.php");
$tpl = SeparateTemplate::instance()->loadSourceFromFile(core::getTemplate() . "admin/check_links.tpl");

$tpl->assign('TITLEPAGE', core::getLanguage('title', 'admin_page_check_links'));
$tpl->assign('TITLE', core::getLanguage('title', 'admin_check_links'));
$tpl->assign('HELP', core::getLanguage('info', 'admin_check_links'));


//display content
$tpl->display();