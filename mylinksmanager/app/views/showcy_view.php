<?php

/********************************************
 * My Links Manager 3.0.0 alfa
 * Copyright (c) 2011-2018 Alexander Yanitsky
 * Website: http://janicky.com
 * E-mail: janickiy@mail.ru
 * Skype: janickiy
 ********************************************/

defined('MYLINKSMANAGER') || exit('My Links Manager: access denied!');

//include template
core::requireEx('libs', "html_template/SeparateTemplate.php");
$tpl = SeparateTemplate::instance()->loadSourceFromFile(core::getTemplate() . core::getSetting('controller') . ".tpl");

$url = "http://" . $_GET['url'];
$cy = Mlm::cy_yandex($url);

$tpl->assign('STR_CY_YANDEX', core::getLanguage('str', 'cy_yandex'));
$tpl->assign('PR', $cy);

// display content
$tpl->display();