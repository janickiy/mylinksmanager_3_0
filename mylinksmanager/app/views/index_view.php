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

$tpl->assign('TITLE_PAGE', core::getLanguage('title', 'page_index'));
$tpl->assign('TITLE', core::getLanguage('title', 'title'));


//searchform
$tpl->assign('STR_KEYWORDS_SEARCHFORM', core::getLanguage('str', 'keywords_searchform'));
$tpl->assign('STR_KEYWORDS', core::getLanguage('str', 'keywords'));
$tpl->assign('STR_SEARCH_IN_CATALOG_SEARCHFORM', core::getLanguage('str', 'search_in_catalog_searchform'));
$tpl->assign('STR_IT_DOESNT_MATTER_SEARCHFORM', core::getLanguage('str', 'it_doesnt_matter_searchform'));
$tpl->assign('STR_AT_LEAST_ONCE', core::getLanguage('str', 'at_least_once'));
$tpl->assign('STR_MEETING_OF_KEYWORDS_SEARCHFORM', core::getLanguage('str', 'meeting_of_keywords_searchform'));
$tpl->assign('STR_ALL_WORDS_TOGETHER', core::getLanguage('str', 'all_words_together'));
$tpl->assign('BUTTON_FIND', core::getLanguage('button', 'find'));


$tpl->assign('ACTION', $_SERVER['REQUEST_URI']);
$tpl->assign('SEARCH', urldecode($_GET['search']));
$tpl->assign('ID_CATALOG', $_GET['id_catalog']);
$tpl->assign('LOGIC', $_GET['logic']);
$tpl->assign('OPTION', Links::ShowCatalogList(0, 0));



// display content
$tpl->display();