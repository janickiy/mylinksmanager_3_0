<?php

/********************************************
 * My Links Manager 3.0.0 alfa
 * Copyright (c) 2011-2018 Alexander Yanitsky
 * Website: http://janicky.com
 * E-mail: janickiy@mail.ru
 * Skype: janickiy
 ********************************************/

defined('MYLINKSMANAGER') || exit('My Links Manager: access denied!');
define('GOOGLE_MAGIC', 0xE6359A60);

//include template
core::requireEx('libs', "html_template/SeparateTemplate.php");
$tpl = SeparateTemplate::instance()->loadSourceFromFile(core::getTemplate() . core::getSetting('controller') . ".tpl");

$url = "http://" . $_GET['url'];
$pr = Mlm::pr_google($url);

$tpl->assign('STR_PR_GOOGLE', core::getLanguage('str', 'pr_google'));
$tpl->assign('PR', $pr);

// display content
$tpl->display();