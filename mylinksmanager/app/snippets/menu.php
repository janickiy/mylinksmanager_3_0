<?php

/********************************************
 * My Links Manager 3.0.0 alfa
 * Copyright (c) 2011-2018 Alexander Yanitsky
 * Website: http://janicky.com
 * E-mail: janickiy@mail.ru
 * Skype: janickiy
 ********************************************/

defined('MYLINKSMANAGER') || exit('My Links Manager: access denied!');

$tpl->assign('ACTIVE_MENU', Core_Array::getGet('t'));

$tpl->assign('MENU_INDEX_TITLE', core::getLanguage('menu', 'index_title'));
$tpl->assign('MENU_INDEX', core::getLanguage('menu', 'index'));

$tpl->assign('MENU_ADDURL_TITLE', core::getLanguage('menu', 'addurl_title'));
$tpl->assign('MENU_ADDURL', core::getLanguage('menu', 'addurl'));




$tpl->assign('MENU_CATEGORIES_TITLE}', core::getLanguage('menu', 'categories_title'));
$tpl->assign('MENU_CATEGORIES', core::getLanguage('menu', 'categories'));



$tpl->assign('MENU_CHECK_TITLE', core::getLanguage('menu', 'check_title'));
$tpl->assign('MENU_CHECK', core::getLanguage('menu', 'check'));

$tpl->assign('MENU_EDIT_TITLE', core::getLanguage('menu', 'edit_title'));
$tpl->assign('MENU_EDIT', core::getLanguage('menu', 'edit'));

$tpl->assign('MENU_SETTINGS_TITLE', core::getLanguage('menu', 'settings_title'));
$tpl->assign('MENU_SETTINGS', core::getLanguage('menu', 'settings'));

$tpl->assign('MENU_BLACK_TITLE', core::getLanguage('menu', 'black_title'));
$tpl->assign('MENU_BLACK', core::getLanguage('menu', 'black'));

$tpl->assign('MENU_PASSWORD_TITLE', core::getLanguage('menu', 'password_title'));
$tpl->assign('MENU_PASSWORD', core::getLanguage('menu', 'password'));

