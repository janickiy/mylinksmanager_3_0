<?php

/********************************************
 * My Links Manager 3.0.0 alfa
 * Copyright (c) 2011-2017 Alexander Yanitsky
 * Website: http://janicky.com
 * E-mail: janickiy@mail.ru
 * Skype: janickiy
 ********************************************/

defined('MYLINKSMANAGER') || exit('My Links Manager: access denied!');

// require temlate class
core::requireEx('libs', "html_template/SeparateTemplate.php");
$tpl = SeparateTemplate::instance()->loadSourceFromFile(core::getTemplate() . core::getSetting('controller') . ".tpl");

$tpl->assign('TITLE_PAGE', core::getLanguage('title_page', 'edit_account'));
$tpl->assign('TITLE', core::getLanguage('title', 'edit_account'));

include_once core::pathTo('extra', 'top.php');

// footer
include_once core::pathTo('extra', 'footer.php');

// display content
$tpl->display();