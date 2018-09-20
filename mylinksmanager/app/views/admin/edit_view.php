<?php

/********************************************
 * My Links Manager 3.0.2
 * Copyright (c) 2011-2018 Alexander Yanitsky
 * Website: http://janicky.com
 * E-mail: janickiy@mail.ru
 * Skype: janickiy
 ********************************************/

defined('MYLINKSMANAGER') || exit('My Links Manager: access denied!');

Auth::authorization();

//include template
core::requireEx('libs', "html_template/SeparateTemplate.php");
$tpl = SeparateTemplate::instance()->loadSourceFromFile(core::getTemplate() . "admin/edit.tpl");

$tpl->assign('TITLEPAGE', core::getLanguage('title_page', 'admin_page_edit'));
$tpl->assign('TITLE', core::getLanguage('title', 'admin_edit'));
$tpl->assign('HELP', core::getLanguage('info', 'admin_edit'));

//display content
$tpl->display();