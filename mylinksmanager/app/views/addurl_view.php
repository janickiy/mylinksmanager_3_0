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

$tpl->assign('TITLE_PAGE', core::getLanguage('title', 'page_addurl'));
$tpl->assign('TITLE', core::getLanguage('title', 'addurl'));


$tpl->assign('STR_GO_TO_CATALOG', core::getLanguage('str','go_to_catalog'));
$tpl->assign('STR_HTMLCODE_BANNER', core::getLanguage('str','htmlcode_banner'));

$tpl->assign('ALERT_INITIAALIZATION_ERROR_INTERFACE', core::getLanguage('error','alert_initiaalization_error_interface'));

//form
$tpl->assign('ACTION', $_SERVER['PHP_SELF']);
$tpl->assign('STR_REQUIRED_FIELD', core::getLanguage('str','required_field'));
$tpl->assign('STR_CHOOSE_YOUR_CATEGORY', core::getLanguage('str','choose_your_category'));
$tpl->assign('STR_CHOOSE_CATEGORY', core::getLanguage('str','choose_category'));
$tpl->assign('STR_FORM_NAME', core::getLanguage('str','form_name'));
$tpl->assign('STR_FORM_URL', core::getLanguage('str','form_url'));
$tpl->assign('STR_FORM_EMAIL', core::getLanguage('str','form_email'));
$tpl->assign('STR_FORM_KEYWORDS', core::getLanguage('str','form_keywords'));
$tpl->assign('STR_SEPARATED_BY_COMMAS', core::getLanguage('str','separated_by_commas'));
$tpl->assign('STR_FORM_DESCRIPTION', core::getLanguage('','form_description'));
$tpl->assign('STR_ONLY_TEXT_NOT_HTMLCODE', core::getLanguage('str','only_text_not_htmlcode'));




$tpl->assign('STR_FROM', core::getLanguage('str','from'));
$tpl->assign('STR_TO', core::getLanguage('str','to'));
$tpl->assign('STR_IF_ANY', core::getLanguage('str','if_any'));
$tpl->assign('STR_NO_MORE', core::getLanguage('str','no_more'));
$tpl->assign('STR_CHARACTERS', core::getLanguage('str','characters'));
$tpl->assign("STR_FORM_FULL_DESCRIPTION", core::getLanguage('str','form_full_description'));
$tpl->assign("STR_LEFT", core::getLanguage('str','left'));
$tpl->assign("STR_FROM_TOTAL", core::getLanguage('str','from_total'));
$tpl->assign("STR_HTML_CODE_BANNER", core::getLanguage('str','html_code_banner'));
$tpl->assign("BUTTON_ADD", core::getLanguage('button','add'));
$tpl->assign("BUTTON_RESET", core::getLanguage('button','reset'));
$tpl->assign("STR_SCRIPT_LINK_CATALOG", core::getLanguage('str','script_link_catalog'));

$tpl->assign('GO_BACK', core::getLanguage('str', 'go_back'));



// display content
$tpl->display();