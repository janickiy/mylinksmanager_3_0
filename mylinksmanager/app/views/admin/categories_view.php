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
$tpl = SeparateTemplate::instance()->loadSourceFromFile(core::getTemplate() . "admin/categories.tpl");

$tpl->assign('TITLEPAGE', core::getLanguage('title', 'admin_page_categories'));
$tpl->assign('TITLE', core::getLanguage('title', 'admin_categories'));

include_once core::pathTo('extra', 'top.php');

//menu
include_once core::pathTo('extra', 'menu.php');

$tpl->assign('STR_ADD_CATEGORY', core::getLanguage('str', 'add_category'));
$tpl->assign('CATALOGTREE', Links::CatalogTree(0, 0));

//footer
include_once core::pathTo('extra', 'footer.php');

//display content
$tpl->display();