<?php

/********************************************
 * My Links Manager 3.0.0 alfa
 * Copyright (c) 2011-2017 Alexander Yanitsky
 * Website: http://janicky.com
 * E-mail: janickiy@mail.ru
 * Skype: janickiy
 ********************************************/

defined('MYLINKSMANAGER') || exit('My Links Manager: access denied!');

//include template
core::requireEx('libs', "html_template/SeparateTemplate.php");
$tpl = SeparateTemplate::instance()->loadSourceFromFile(core::getTemplate() . "help.tpl");

$tpl->assign('TITLE_PAGE', core::getLanguage('title_page', 'help_page'));
$tpl->assign('TITLE', core::getLanguage('title', 'help'));


$tpl->assign('HELP', core::getLanguage('str', 'help'));

$tpl->assign('STR_LOGO', core::getLanguage('str', 'logo'));
$tpl->assign('STR_AUTHOR',core::getLanguage('str', 'author'));

// display content
$tpl->display();