<?php

/********************************************
 * My Links Manager 3.0.1 beta
 * Copyright (c) 2011-2018 Alexander Yanitsky
 * Website: http://janicky.com
 * E-mail: janickiy@mail.ru
 * Skype: janickiy
 ********************************************/

defined('MYLINKSMANAGER') || exit('My Links Manager: access denied!');

Auth::authorization();

//include template
core::requireEx('libs', "html_template/SeparateTemplate.php");
$tpl = SeparateTemplate::instance()->loadSourceFromFile(core::getTemplate() . "admin/settings.tpl");

$tpl->assign('TITLEPAGE', core::getLanguage('title', 'admin_page_settings'));
$tpl->assign('TITLE', core::getLanguage('title', 'admin_settings'));
$tpl->assign('HELP', core::getLanguage('info', 'admin_settings'));


if (Core_Array::getRequest('action')){
    $fields = [];

    $fields['language']  = Core_Array::getPost('language');
    $fields['all_number_links'] = (int)trim(Core_Array::getPost('all_number_links'));
    $fields['all_number_new'] = (int)trim(Core_Array::getPost('all_number_new'));
    $fields['columns_number'] = (int)trim(Core_Array::getPost('columns_number'));
    $fields['number_chars_description_min'] = (int)trim(Core_Array::getPost('number_chars_description_min'));
    $fields['number_chars_description_max'] = (int)trim(Core_Array::getPost('number_chars_description_max'));
    $fields['number_chars_fulldescription_min'] = (int)trim(Core_Array::getPost('number_chars_fulldescription_min'));
    $fields['number_chars_fulldescription_max'] = (int)trim(Core_Array::getPost('number_chars_fulldescription_max'));
    $fields['number_html_chars'] = (int)trim(Core_Array::getPost('number_html_chars'));
    $fields['url'] = Helper::convertUrl(trim(strtolower(Core_Array::getPost('url'))));
    $fields['email'] = trim(Core_Array::getPost('email'));
    $fields['new_links_notification'] = Core_Array::getPost('new_links_notification') == "on" ? "yes" : "no";
    $fields['rules'] = trim(Core_Array::getPost('rules'));
    $fields['htmlcode_site1'] = trim(Core_Array::getPost('htmlcode_site1'));
    $fields['htmlcode_site2'] = trim(Core_Array::getPost('htmlcode_site2'));
    $fields['htmlcode_site3'] = trim(Core_Array::getPost('htmlcode_site3'));
    $fields['htmlcode_banner1'] = trim(Core_Array::getPost('htmlcode_banner1'));
    $fields['htmlcode_banner2'] = trim(Core_Array::getPost('htmlcode_banner2'));
    $fields['htmlcode_banner3'] = trim(Core_Array::getPost('htmlcode_banner3'));
    $fields['template_mail_1'] = trim(Core_Array::getPost('template_mail_1'));
    $fields['template_mail_2'] = trim(Core_Array::getPost('template_mail_2'));
    $fields['template_mail_3'] = trim(Core_Array::getPost('template_mail_3'));
    $fields['template_mail_4'] = trim(Core_Array::getPost('template_mail_4'));
    $fields['template_mail_5'] = trim(Core_Array::getPost('template_mail_5'));
    $fields['template_mail_6'] = trim(Core_Array::getPost('template_mail_6'));
    $fields['template_mail_7'] = trim(Core_Array::getPost('template_mail_7'));
    $fields['from_add_message'] = trim(Core_Array::getPost('from_add_message'));
    $fields['add_links_without_check'] = Core_Array::getPost('add_links_without_check') == "on" ? "yes" : "no";
    $fields['check_links'] = Core_Array::getPost('check_links') == "on" ? "yes" : "no";
    $fields['limit_reciprocal_links'] = Core_Array::getPost('limit_reciprocal_links') == "on" ? "yes" : "no";
    $fields['number_reciprocal_links_limit'] = (int)trim(Core_Array::getPost('number_reciprocal_links_limit'));
    $fields['common_host'] = Core_Array::getPost('common_host') == "on" ? "yes" : "no";
    $fields['check_get_parameter'] = Core_Array::getPost('check_get_parameter') == "on" ? "yes" : "no";
    $fields['add_to_blacklist'] = Core_Array::getPost('add_to_blacklist') == "on" ? "yes" : "no";
    $fields['check_interval'] = (int)trim(Core_Array::getPost('check_interval'));
    $fields['number_check'] = (int)trim(Core_Array::getPost('number_check'));
    $fields['request_captcha'] = Core_Array::getPost('request_captcha') == "on" ? "yes" : "no";
    $fields['check_url'] = Core_Array::getPost('check_url') == "on" ? "yes" : "no";

    if ($data->updateSettings($fields))
        $success = core::getLanguage('msg', 'changes_added');
    else
        $errors[] = core::getLanguage('error', 'web_apps_error');

	header('Location: ' . Helper::url('./?a=admin&t=settings'));
	exit;
}

include_once core::pathTo('extra', 'admin/top.php');

//menu
include_once core::pathTo('extra', 'admin/menu.php');

//footer
include_once core::pathTo('extra', 'admin/footer.php');

//form
$tpl->assign("STR_INTERFACE_SETTINGS", core::getLanguage('str', 'interface_settings'));
$tpl->assign("STR_LANGUAGE", core::getLanguage('str', 'language'));
$tpl->assign("STR_LANG_RU", core::getLanguage('str', 'lang_ru'));
$tpl->assign("STR_LANG_EN", core::getLanguage('str', 'lang_en'));
$tpl->assign("STR_ALL_NUMBER_LINKS", core::getLanguage('str', 'all_number_links'));
$tpl->assign("STR_ALL_NUMBER_NEW", core::getLanguage('str', 'all_number_new'));
$tpl->assign("STR_COLUMNS_NUMBER", core::getLanguage('str', 'columns_number'));
$tpl->assign("STR_BY_DATE", core::getLanguage('str', 'by_date'));
$tpl->assign("STR_BY_NUMBER", core::getLanguage('str', 'by_number'));
$tpl->assign("STR_BY_INCREACE", core::getLanguage('str', 'by_increace'));
$tpl->assign("STR_BY_DECREASE", core::getLanguage('str', 'by_decrease'));
$tpl->assign("STR_CATALOG_URL", core::getLanguage('str', 'catalog_url'));
$tpl->assign("STR_ADMIN_EMAIL", core::getLanguage('str', 'admin_email'));
$tpl->assign("STR_CATALOG_RULE", core::getLanguage('str', 'catalog_rule'));
$tpl->assign("STR_FROM_ADD_MESSAGE", core::getLanguage('str', 'from_add_message'));
$tpl->assign("STR_MSG_FOR_USER_AFTER_ADDITION", core::getLanguage('str', 'msg_for_user_after_addition'));
$tpl->assign("STR_HTMLCODE_SITE1", core::getLanguage('str', 'htmlcode_site1'));
$tpl->assign("STR_HTMLCODE_SITE2", core::getLanguage('str', 'htmlcode_site2'));
$tpl->assign("STR_HTMLCODE_SITE3", core::getLanguage('str', 'htmlcode_site3'));
$tpl->assign("STR_HTMLCODE_BANNER1", core::getLanguage('str', 'htmlcode_banner1'));
$tpl->assign("STR_HTMLCODE_BANNER2", core::getLanguage('str', 'htmlcode_banner2'));
$tpl->assign("STR_HTMLCODE_BANNER3", core::getLanguage('str', 'htmlcode_banner3'));
$tpl->assign("STR_LETTERS_TEMPLATES", core::getLanguage('str', 'letters_templates'));
$tpl->assign("STR_EMAIL_FOR_USER_ADD_MODER", core::getLanguage('str', 'email_for_user_add_moder'));
$tpl->assign("STR_EMAIL_FOR_USER_ADD_CATALOG", core::getLanguage('str', 'email_for_user_add_catalog'));
$tpl->assign("STR_EMAIL_FOR_USER_HIDE_ABSENSE", core::getLanguage('str', 'email_for_user_hide_absense'));
$tpl->assign("STR_EMAIL_FOR_USER_HIDE_PROHIB", core::getLanguage('str', 'email_for_user_hide_prohib'));
$tpl->assign("STR_EMAIL_FOR_USER_PASSED", core::getLanguage('str', 'email_for_user_passed'));
$tpl->assign("STR_EMAIL_FOR_USER_REMOVE", core::getLanguage('str', 'email_for_user_remove'));
$tpl->assign("STR_EMAIL_FOR_USER_ADD_NEW", core::getLanguage('str', 'email_for_user_add_new'));
$tpl->assign("STR_CATALOG_SETTINGS", core::getLanguage('str', 'catalog_settings'));
$tpl->assign("STR_CHECK_INTERVAL", core::getLanguage('str', 'check_interval'));
$tpl->assign("STR_NUMBER_CHECK", core::getLanguage('str', 'number_check'));
$tpl->assign("STR_NUMBER_CHARS_DESCRIPTION", core::getLanguage('str', 'number_chars_description'));
$tpl->assign("STR_NUMBER_CHARS_FULLDESCRIPTION", core::getLanguage('str', 'number_chars_fulldescription'));
$tpl->assign("STR_NUMBER_HTML_CHARS", core::getLanguage('str', 'number_html_chars'));
$tpl->assign("STR_REQUEST_CAPTCHA", core::getLanguage('str', 'request_captcha'));
$tpl->assign("STR_ADD_LINKS_WITHOUT_CHECK", core::getLanguage('str', 'add_links_without_check'));
$tpl->assign("STR_CHECK_LINKS", core::getLanguage('str', 'check_links'));
$tpl->assign("STR_COMMON_HOST", core::getLanguage('str', 'common_host'));
$tpl->assign("STR_CHECK_GET_PARAMETER", core::getLanguage('str', 'check_get_parameter'));
$tpl->assign("STR_LIMIT_RECIPROCAL_LINKS", core::getLanguage('str', 'limit_reciprocal_links'));
$tpl->assign("STR_ADD_TO_BLACKLIST", core::getLanguage('str', 'add_to_blacklist'));
$tpl->assign("STR_NEW_LINKS_NOTIFICATION", core::getLanguage('str', 'new_links_notification'));
$tpl->assign("BUTTON_SAVE", core::getLanguage('button', 'save'));
$tpl->assign("BUTTON_BY_DEFAULT", core::getLanguage('button', 'by_default'));

if (empty(core::getSetting('url'))){
    if (substr($_SERVER['SERVER_NAME'],0,4) == "www.") { $url = substr($_SERVER["SERVER_NAME"],4); }
    else { $url = $_SERVER['SERVER_NAME']; }
} else {
    $url = core::getSetting('url');
}

//value
$tpl->assign("ACTION", $_SERVER['REQUEST_URI']);
$tpl->assign("LANGUAGE_OPTION", core::getSetting('language'));
$tpl->assign("ORDER_VIEWS", core::getSetting('order_views'));
$tpl->assign("ORDER_LINKS", core::getSetting('order_links'));
$tpl->assign("ALL_NUMBER_LINK", core::getSetting('all_number_links'));
$tpl->assign("ALL_NUMBER_NEW", core::getSetting('all_number_new'));
$tpl->assign("COLUMNS_NUMBER", core::getSetting('columns_number'));
$tpl->assign("URL", $url);
$tpl->assign("EMAIL", core::getSetting('email'));
$tpl->assign("RULES", core::getSetting('rules'));
$tpl->assign("FROM_ADD_MESSAGE", core::getSetting('from_add_message'));
$tpl->assign("HTMLCODE_SITE1", core::getSetting('htmlcode_site1'));
$tpl->assign("HTMLCODE_SITE2", core::getSetting('htmlcode_site2'));
$tpl->assign("HTMLCODE_SITE3", core::getSetting('htmlcode_site3'));
$tpl->assign("HTMLCODE_BANNER1", core::getSetting('htmlcode_banner1'));
$tpl->assign("HTMLCODE_BANNER2", core::getSetting('htmlcode_banner2'));
$tpl->assign("HTMLCODE_BANNER3", core::getSetting('htmlcode_banner3'));
$tpl->assign("TEMPLATE_MAIL_1", core::getSetting('template_mail_1'));
$tpl->assign("TEMPLATE_MAIL_2", core::getSetting('template_mail_2'));
$tpl->assign("TEMPLATE_MAIL_3", core::getSetting('template_mail_3'));
$tpl->assign("TEMPLATE_MAIL_4", core::getSetting('template_mail_4'));
$tpl->assign("TEMPLATE_MAIL_5", core::getSetting('template_mail_5'));
$tpl->assign("TEMPLATE_MAIL_6", core::getSetting('template_mail_6'));
$tpl->assign("TEMPLATE_MAIL_7", core::getSetting('template_mail_7'));
$tpl->assign("CHECK_INTERVAL", core::getSetting('check_interval'));
$tpl->assign("NUMBER_CHECK", core::getSetting('number_check'));
$tpl->assign("NUMBER_CHARS_DESCRIPTION_MIN", core::getSetting('number_chars_description_min'));
$tpl->assign("NUMBER_CHARS_DESCRIPTION_MAX", core::getSetting('number_chars_description_max'));
$tpl->assign("NUMBER_CHARS_FULLDESCRIPTION_MIN", core::getSetting('number_chars_fulldescription_min'));
$tpl->assign("NUMBER_CHARS_FULLDESCRIPTION_MAX", core::getSetting('number_chars_fulldescription_max'));
$tpl->assign("NUMBER_HTML_CHARS", core::getSetting('number_html_chars'));
$tpl->assign("REQUEST_CAPTCHA", core::getSetting('request_captcha'));
$tpl->assign("ADD_LINKS_WITHOUT_CHECK", core::getSetting('add_links_without_check'));
$tpl->assign("CHECK_LINKS", core::getSetting('check_links'));
$tpl->assign("COMMON_HOST", core::getSetting('common_host'));
$tpl->assign("CHECK_GET_PARAMETER", core::getSetting('check_get_parameter'));
$tpl->assign("NUMBER_RECIPROCAL_LINKS_LIMIT", core::getSetting('number_reciprocal_links_limit'));
$tpl->assign("LIMIT_RECIPROCAL_LINKS", core::getSetting('limit_reciprocal_links'));
$tpl->assign("ADD_TO_BLACKLIST", core::getSetting('add_to_blacklist'));
$tpl->assign("NEW_LINKS_NOTIFICATION", core::getSetting('new_links_notification'));

//display content
$tpl->display();