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
$tpl = SeparateTemplate::instance()->loadSourceFromFile(core::getTemplate() . "admin/index.tpl");

$tpl->assign('TITLEPAGE', core::getLanguage('title', 'admin_page_index'));
$tpl->assign('TITLE', core::getLanguage('title', 'admin_index'));
$tpl->assign('HELP', core::getLanguage('info', 'admin_index'));

include_once core::pathTo('extra', 'top.php');

//menu
include_once core::pathTo('extra', 'menu.php');

if (Core_Array::getGet('id')) {
    $blockInfoLink = $tpl->fetch('info_link');

    $blockCheckLink->assign('STR_BACK', core::getLanguage('str', 'back'));
    $link_info = Links::getLinkInfo(Core_Array::getGet('id'));
    $htmlcode_banner = !empty($link_info['htmlcode_banner']) ? $link_info['htmlcode_banner'] : '<a href="http://' . $link_info['url'] . '"><img border="0" width="88" height="31" src="./templates/images/noimage.gif"></a>';
    $blockCheckLink->assign('HTMLCODE_BANNER', $htmlcode_banner);
    $blockCheckLink->assign('DESCRIPTION', nl2br($link_info['description']));
    $blockCheckLink->assign('ID', $link_info['id']);
    $blockCheckLink->assign('STR_NAME_OF_WEBSITE', core::getLanguage('str', 'name_of_website'));
    $blockCheckLink->assign('STR_DESCRIPTION_OF_WEBSITE', core::getLanguage('str', 'description_of_website'));
    $blockCheckLink->assign('STR_CATEGORY', core::getLanguage('str', 'category'));
    $blockCheckLink->assign('STR_RECIP_URL_LINK', core::getLanguage('str', 'recip_url_link'));
    $blockCheckLink->assign('STR_ADDED', core::getLanguage('str', 'added'));
    $blockCheckLink->assign('BUTTON_ADD', core::getLanguage('button', 'add'));
    $blockCheckLink->assign('BUTTON_DELETE', core::getLanguage('button', 'delete'));
    $blockCheckLink->assign('BUTTON_TO_BLACKLIST', core::getLanguage('button', 'add_to_blacklist'));
    $blockCheckLink->assign('ACTION', $_SERVER['REQUEST_URI']);
    $blockCheckLink->assign('SHOW_CY', core::getSetting('show_cy'));
    $blockCheckLink->assign('SHOW_PR', core::getSetting('show_pr'));
    $blockCheckLink->assign('URL', $link_info['url']);
    $blockCheckLink->assign('NAME', $link_info['name']);
    $blockCheckLink->assign('RECIPROCAL_LINK', $link_info['reciprocal_link']);
    $blockCheckLink->assign('CATEGORY_NAME', $link_info['catname']);
    $blockCheckLink->assign('TIME', $link_info['time']);

    $tpl->assign('info_link', $blockInfoLink);
} else {
    $blockNewLinks = $tpl->fetch('new_links');

    $arrs = Links::getLinksList('new','l.id',0,10);

    if ($arrs) {
        foreach($arrs as $row) {
            $blockRow = $blockNewLinks->fetch('links_row');
            $blockRow->assign('ID', $row['id']);
            $blockRow->assign('URL', $row['url']);
            $blockRow->assign('NAME', $row['name']);
            $blockRow->assign('DESCRIPTION', $row['description']);
            $blockRow->assign('TIME', core::getSetting('language') == 'ru' ? date("d.m.Y", strtotime($row['time'])) : date("Y.m.d", strtotime($row['time'])));
            $blockRow->assign('CATEGORY', $row['catname']);
            $blockRow->assign('EMAIL', $row['email']);

            $htmlcode_banner = !empty($row['htmlcode_banner']) ? $row['htmlcode_banner'] : '<a href="http://' . $row['url'] . '" target=_blank><img border="0" width="88" height="31" src="./templates/images/noimage.gif"></a>';

            $blockRow->assign('HTMLCODE_BANNER', $htmlcode_banner);
            $blockRow->assign('SHOW_PR',  core::getSetting('show_cy'));
            $blockRow->assign('SHOW_CY', core::getSetting('show_pr'));
            $blockRow->assign('STR_ADDED', core::getLanguage('str', 'added'));
            $blockRow->assign('STR_CATEGORY', core::getLanguage('str', 'category'));
            $blockRow->assign('STR_EMAIL', core::getLanguage('str', 'email'));
            $blockRow->assign('BUTTON_HANDCHECK', core::getLanguage('button', 'handcheck'));
            $blockRow->assign('BUTTON_AUTOCHECK', core::getLanguage('button', 'autocheck'));

            $blockNewLinks->assign('links_row', $blockRow);
        }

    } else {

    }

    $tpl->assign('new_links', $blockNewLinks);
}







//footer
include_once core::pathTo('extra', 'footer.php');

//display content
$tpl->display();