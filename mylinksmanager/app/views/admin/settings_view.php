<?php

/********************************************
 * My Links Manager 3.0.0 alfa
 * Copyright (c) 2011-2017 Alexander Yanitsky
 * Website: http://janicky.com
 * E-mail: janickiy@mail.ru
 * Skype: janickiy
 ********************************************/

defined('MYLINKSMANAGER') || exit('My Links Manager: access denied!');

Auth::authorization();

//include template
core::requireEx('libs', "html_template/SeparateTemplate.php");
$tpl = SeparateTemplate::instance()->loadSourceFromFile(core::getTemplate() . "admin/settings.tpl");

$tpl->assign('TITLE_PAGE', core::getLanguage('title', 'admin_page_settings'));
$tpl->assign('TITLE', core::getLanguage('title', 'admin_settings'));
$tpl->assign('HELP', core::getLanguage('info', 'admin_settings'));

include_once core::pathTo('extra', 'top.php');

//menu
include_once core::pathTo('extra', 'menu.php');

//footer
include_once core::pathTo('extra', 'footer.php');

if (empty(core::getSetting('url'))){
    if (substr($_SERVER['SERVER_NAME'],0,4) == "www.") {
        $settings['url'] = substr($_SERVER["SERVER_NAME"],4);
    } else {
        $settings['url'] = $_SERVER['SERVER_NAME'];
    }
}

$language_ru = core::getSetting('language') == "ru" ? 'selected="selected"' : '';
$language_en = core::getSetting('language') == "en" ? 'selected="selected"' : '';
$order_views1 = core::getSetting('order_views') == 1 ? 'checked="checked"' : '';
$order_views2 = core::getSetting('order_views') == 2 ? 'checked="checked"' : '';
$order_links1 = core::getSetting('order_links') == 1 ? 'checked="checked"' : '';
$order_links2 = core::getSetting('order_links') == 2 ? 'checked="checked"' : '';
$show_cy = core::getSetting('show_cy') == "yes" ? 'checked="checked"' : '';
$show_pr = core::getSetting('show_pr') == "yes" ? 'checked="checked"' : '';
$static1 = core::getSetting('static') == 1 ? 'checked="checked"' : '';
$static2 = core::getSetting('static') == 2 ? 'checked="checked"' : '';
$request_captcha = core::getSetting('request_captcha') == "yes" ? 'checked="checked"' : '';
$new_links_notification = core::getSetting('new_links_notification') == "yes" ? 'checked="checked"' : '';
$add_links_without_check = core::getSetting('add_links_without_check') == "yes" ? 'checked="checked"' : '';
$check_links = core::getSetting('check_links') == "yes" ? '' : '';
$many_link = core::getSetting('many_link') == "yes" ? 'checked="checked"' : "";
$common_host = core::getSetting('common_host') == "yes" ? 'checked="checked"' : "";
$query_check = core::getSetting('query_check') == "yes" ? 'checked="checked"' : "";
$no_add_link = core::getSetting('no_add_link') == "yes" ? 'checked="checked"' : "";
$black = core::getSetting('black') == "yes" ? 'checked="checked"' : "";
$send_mail = core::getSetting('send_mail') == "yes" ? 'checked="checked"' : "";

//form
$tpl->assign("STR_INTERFACE_SETTINGS", core::getLanguage('str', 'interface_settings'));
$tpl->assign("STR_LANGUAGE", core::getLanguage('str', 'language'));
$tpl->assign("STR_LANG_RU", core::getLanguage('str', 'lang_ru'));
$tpl->assign("STR_LANG_EN", core::getLanguage('str', 'lang_en'));
$tpl->assign("STR_ALL_NUMBER_LINKS", core::getLanguage('str', 'all_number_links'));
$tpl->assign("STR_ALL_NUMBER_NEW", core::getLanguage('str', 'all_number_new'));
$tpl->assign("STR_COLUMNS_NUMBER", core::getLanguage('str', 'columns_number'));
$tpl->assign("STR_ORDER_VIEWS", core::getLanguage('str', 'order_views'));
$tpl->assign("STR_BY_DATE", core::getLanguage('str', 'by_date'));
$tpl->assign("STR_BY_NUMBER", core::getLanguage('str', 'by_number'));
$tpl->assign("STR_ORDER_LINKS", core::getLanguage('str', 'order_links'));
$tpl->assign("STR_BY_INCREACE", core::getLanguage('str', 'by_increace'));
$tpl->assign("STR_BY_DECREASE", core::getLanguage('str', 'by_decrease'));
$tpl->assign("STR_SHOW_CY", core::getLanguage('str', 'show_cy'));
$tpl->assign("STR_SHOW_PR", core::getLanguage('str', 'show_pr'));
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
$tpl->assign("STR_COMMON_HOST", core::getLanguage('str', 'str_common_host'));
$tpl->assign("STR_CHECK_GET_PARAMETER", core::getLanguage('str', 'check_get_parameter'));
$tpl->assign("STR_LIMIT_RECIPROCAL_LINKS", core::getLanguage('str', 'limit_reciprocal_links'));
$tpl->assign("STR_ADD_TO_BLACKLIST", core::getLanguage('str', 'add_to_blacklist'));
$tpl->assign("STR_NEW_LINKS_NOTIFICATION", core::getLanguage('str', 'new_links_notification'));
$tpl->assign("BUTTON_SAVE", core::getLanguage('button', 'save'));
$tpl->assign("BUTTON_BY_DEFAULT", core::getLanguage('button', 'by_default'));


//display content
$tpl->display();