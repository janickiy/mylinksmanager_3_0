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
$tpl = SeparateTemplate::instance()->loadSourceFromFile(core::getTemplate() . "admin/index.tpl");

$tpl->assign('TITLEPAGE', core::getLanguage('title', 'admin_page_index'));
$tpl->assign('TITLE', core::getLanguage('title', 'admin_index'));
$tpl->assign('HELP', core::getLanguage('info', 'admin_index'));

if (Core_Array::getPost('action')) {

    $errors = [];

    switch (Core_Array::getPost('event')) {
        case 'add':

            if (Links::changeStatusLink(Core_Array::getPost('id'), 'show')) {
                Helper::sendMailAdd($link, core::getLanguage('str', 'subject_add'));

                header("Location: ./?a=admin");
                exit;

            } else {
                $errors = core::getLanguage('error', 'web_apps_error');
            }

            break;

        // Remove link
        case 'delete':

            $link = Links::getLinkInfo(Core_Array::getPost('id'));

            if (core::database()->delete(core::database()->getTableName('links'), "id=" . Core_Array::getPost('id'), '')) {
                Helper::sendMailNoAdd($link, core::getLanguage('str', 'subject_noadd'));

                header("Location: ./?a=admin");
                exit;
            } else $errors = core::getLanguage('error', 'web_apps_error');

            break;

        // Add link to black list
        case 'black':

            if (Links::changeStatusLink(Core_Array::getPost('id'), 'show')) {
                $link = Links::getLinkInfo(Core_Array::getPost('id'));
                Helper::sendMailNoAdd($link, core::getLanguage('str', 'subject_noadd'));
                $success = core::getLanguage('msg', 'link_added_to_blacklist');

                header("Location: ./?a=admin");
                exit;

            } else {
                $errors = core::getLanguage('error', 'web_apps_error');
            }

        // Automatic check the link
        case 'auto_check':

            if (!empty(core::getSetting('url'))) {
                // Check is exist answer link on page with address $_POST['url_link']
                if (Helper::checkUrlLink(Core_Array::getPost('reciprocal_link'), Core_Array::getPost('url'))) {
                    // Add the link if it is
                    if (Links::changeStatusLink(Core_Array::getPost('id'), 'show')) {
                        // Send email to the user about the link was added
                        $link = Links::getLinkInfo(Core_Array::getPost('id'));

                        Helper::sendMailAdd($link, core::getLanguage('str', 'subject_add'));

                        header("Location: ./?a=admin");
                        exit;

                    } else core::getLanguage('error', 'web_apps_error');
                } else {
                    // Remove the link or add to black list if it is not
                    if (core::getSetting('add_to_blacklist') == "yes") {
                        $result = Links::changeStatusLink(Core_Array::getPost('id'), 'black', core::getSetting('msg', 'reason_absense_reciprocal'));
                    } else {
                        $result = core::database()->delete(core::database()->getTableName('links'), "id=" . Core_Array::getPost('id'), '');
                    }

                    if ($result) {
                        header("Location: ./?a=admin");
                        exit;
                    } else core::getLanguage('error', 'web_apps_error');
                }
            }

            break;
    }
}


include_once core::pathTo('extra', 'admin/top.php');

//menu
include_once core::pathTo('extra', 'admin/menu.php');

if (Core_Array::getGet('id')) {
    $blockInfoLink = $tpl->fetch('info_link');

    $blockInfoLink->assign('STR_BACK', core::getLanguage('str', 'back'));
    $link_info = Links::getLinkInfo(Core_Array::getGet('id'));
    $htmlcode_banner = !empty($link_info['htmlcode_banner']) ? $link_info['htmlcode_banner'] : '<a href="http://' . $link_info['url'] . '"><img border="0" width="88" height="31" src="./templates/images/noimage.gif"></a>';
    $blockInfoLink->assign('HTMLCODE_BANNER', $htmlcode_banner);
    $blockInfoLink->assign('DESCRIPTION', nl2br($link_info['description']));
    $blockInfoLink->assign('ID', $link_info['id']);
    $blockInfoLink->assign('STR_NAME_OF_WEBSITE', core::getLanguage('str', 'name_of_website'));
    $blockInfoLink->assign('STR_DESCRIPTION_OF_WEBSITE', core::getLanguage('str', 'description_of_website'));
    $blockInfoLink->assign('STR_CATEGORY', core::getLanguage('str', 'category'));
    $blockInfoLink->assign('STR_RECIP_URL_LINK', core::getLanguage('str', 'recip_url_link'));
    $blockInfoLink->assign('STR_ADDED', core::getLanguage('str', 'added'));
    $blockInfoLink->assign('BUTTON_ADD', core::getLanguage('button', 'add'));
    $blockInfoLink->assign('BUTTON_DELETE', core::getLanguage('button', 'remove'));
    $blockInfoLink->assign('BUTTON_TO_BLACKLIST', core::getLanguage('button', 'add_to_blacklist'));
    $blockInfoLink->assign('ACTION', $_SERVER['REQUEST_URI']);
    $blockInfoLink->assign('SHOW_CY', core::getSetting('show_cy'));
    $blockInfoLink->assign('SHOW_PR', core::getSetting('show_pr'));
    $blockInfoLink->assign('URL', $link_info['url']);
    $blockInfoLink->assign('NAME', $link_info['name']);
    $blockInfoLink->assign('RECIPROCAL_LINK', $link_info['reciprocal_link']);
    $blockInfoLink->assign('CATEGORY_NAME', $link_info['catname']);
    $blockInfoLink->assign('TIME', core::getSetting('language') == 'ru' ? date("d.m.Y", strtotime($link_info['time'])) : date("Y.m.d", strtotime($link_info['time'])));

    $tpl->assign('info_link', $blockInfoLink);
} else {
    $blockNewLinks = $tpl->fetch('new_links');

    $arrs = Links::getLinksList('new', 'l.id', 10, 0);

    if ($arrs) {
        foreach ($arrs as $row) {
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
            $blockRow->assign('SHOW_PR', core::getSetting('show_cy'));
            $blockRow->assign('SHOW_CY', core::getSetting('show_pr'));
            $blockRow->assign('STR_ADDED', core::getLanguage('str', 'added'));
            $blockRow->assign('STR_CATEGORY', core::getLanguage('str', 'category'));
            $blockRow->assign('STR_EMAIL', core::getLanguage('str', 'email'));
            $blockRow->assign('BUTTON_HANDCHECK', core::getLanguage('button', 'handcheck'));
            $blockRow->assign('BUTTON_AUTOCHECK', core::getLanguage('button', 'autocheck'));

            $blockNewLinks->assign('links_row', $blockRow);
        }

    } else {
        $blockNewLinks->assign('NOT_NEW_LINKS', core::getLanguage('str', 'not_new_links'));
    }

    $tpl->assign('new_links', $blockNewLinks);
}

//footer
include_once core::pathTo('extra', 'admin/footer.php');

//display content
$tpl->display();