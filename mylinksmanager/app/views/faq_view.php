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
$tpl = SeparateTemplate::instance()->loadSourceFromFile(core::getTemplate() . "faq.tpl");

$tpl->assign('TITLE_PAGE', core::getLanguage('title_page', 'faq'));
$tpl->assign('TITLE', core::getLanguage('title', 'faq'));

$tpl->assign('FAQ', core::getLanguage('str', 'faq'));

$tpl->assign('STR_LOGO', STR_LOGO);
$tpl->assign('STR_AUTHOR', STR_AUTHOR);

// display content
$tpl->display();