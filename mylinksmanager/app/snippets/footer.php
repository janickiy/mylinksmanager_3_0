<?php

/********************************************
 * My Links Manager 3.0.0 alfa
 * Copyright (c) 2011-2017 Alexander Yanitsky
 * Website: http://janicky.com
 * E-mail: janickiy@mail.ru
 * Skype: janickiy
 ********************************************/

defined('MYLINKSMANAGER') || exit('My Links Manager: access denied!');

$tpl->assign("TOTAL_LINKS", Links::getTotalLinks());
$tpl->assign('STR_LOGO', core::getLanguage('str', 'logo'));
$tpl->assign('STR_AUTHOR', core::getLanguage('str', 'author'));
$tpl->assign('STR_WEBSITE', core::getLanguage('str', 'website'));
$tpl->assign('STR_HELPPAGE', core::getLanguage('str', 'helppage'));


