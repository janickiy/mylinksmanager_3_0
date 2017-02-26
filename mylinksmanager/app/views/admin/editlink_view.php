<?php

/********************************************
 * My Links Manager 3.0.0 alfa
 * Copyright (c) 2011-2017 Alexander Yanitsky
 * Website: http://janicky.com
 * E-mail: janickiy@mail.ru
 * Skype: janickiy
 ********************************************/

defined('MYLINKSMANAGER') || exit('My Links Manager: access denied!');

Auth::authorization();

//include template
core::requireEx('libs', "html_template/SeparateTemplate.php");
$tpl = SeparateTemplate::instance()->loadSourceFromFile(core::getTemplate() . "admin/editlink.tpl");

$tpl->assign('TITLEPAGE', core::getLanguage('title', 'admin_page_editlink'));
$tpl->assign('TITLE', core::getLanguage('title', 'admin_editlink'));
$tpl->assign('HELP', core::getLanguage('info', 'admin_edotlink'));

//display content
$tpl->display();