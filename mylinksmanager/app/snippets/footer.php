<?php

/********************************************
 * My Links Manager 3.0.2
 * Copyright (c) 2011-2018 Alexander Yanitsky
 * Website: http://janicky.com
 * E-mail: janickiy@mail.ru
 * Skype: janickiy
 ********************************************/

defined('MYLINKSMANAGER') || exit('My Links Manager: access denied!');

$tpl->assign('VERSION', VERSION);
$tpl->assign('STR_LINKS_IN_CATALOG', core::getLanguage('str', 'links_in_catalog'));
$tpl->assign("TOTAL_LINKS", Links::getTotalLinks());
$tpl->assign('STR_LOGO', core::getLanguage('str', 'logo'));
$tpl->assign('STR_AUTHOR', core::getLanguage('str', 'author'));
$tpl->assign('STR_WEBSITE', core::getLanguage('str', 'website'));
$tpl->assign('STR_HELPPAGE', core::getLanguage('str', 'helppage'));