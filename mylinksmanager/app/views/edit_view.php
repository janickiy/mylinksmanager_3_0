<?php

/********************************************
 * My Links Manager 3.0.1 beta
 * Copyright (c) 2011-2018 Alexander Yanitsky
 * Website: http://janicky.com
 * E-mail: janickiy@mail.ru
 * Skype: janickiy
 ********************************************/

defined('MYLINKSMANAGER') || exit('My Links Manager: access denied!');

//include template
core::requireEx('libs', "html_template/SeparateTemplate.php");
$tpl = SeparateTemplate::instance()->loadSourceFromFile(core::getTemplate() . core::getSetting('controller') . ".tpl");

if ($data->checkKey(Core_Array::getRequest('id'), Core_Array::getRequest('token'))) {
    throw new Exception(core::getLanguage('error', 'token'));
}

$errors = [];

if (Core_Array::getRequest('action')) {

    $reciprocal_link = trim(Core_Array::getPost('reciprocal_link'));
    $url = trim(Core_Array::getPost('url'));
    $id = Core_Array::getPost('id');
    $token = Core_Array::getPost('token');

    // Cut http:// from the url of site
    if (!empty($reciprocal_link)) {
        if ((substr($reciprocal_link, 0, 7)) == "http://") {
            $reciprocal_link = str_replace('http://', '', $reciprocal_link);
        }
        if ((substr($reciprocal_link, 0, 8)) == "https://") {
            $reciprocal_link = str_replace('https://', '', $reciprocal_link);
        }
    }

    // If $settings['check_links'] == yes,
    // then find the link on our site. If there is non any link on our site print error
    if ((!empty($reciprocal_link) && core::setSetting('check_links') == "yes") && Helper::checkUrlLink($reciprocal_link)) {
        $errors[] = core::getLanguage('error', 'not_reciprocal_link');
    }

    // Check url address of reciprocal link, if it has url address of catalogue in arg=value then print error
    if ((!empty($reciprocal_link) && core::setSetting('check_get_parameter') == "yes") && Helper::checkGetParameter($reciprocal_link)) {
        $errors[] = core::getLanguage('error', 'arg_value');
    }

    // Verify domen of reciprocal link and of catalogue
    if (!empty($reciprocal_link) && Helper::nativeCheckLink($reciprocal_link, $url)) {
        $errors[] = core::getLanguage('error', 'verify_domen');
    }

    // Check value of reciprocal_link, if empty then print error
    if (empty($reciprocal_link)) {
        $errors[] = core::getLanguage('error', 'nofill_reciprocal_link');
    }
    // Form the SQL query on edit if not any errors
    if (count($errors) == 0) {

        $fields = [
            'reciprocal_link' => $reciprocal_link,
            'status' => 'show',
            'number_check' => 0,
            'time_check' => date("Y-m-d H:i:s"),
            'reason' => '',
        ];

        if ($data->editLink($fields, Core_Array::getPost('id'))) {
            $success = core::getLanguage('msg', '');
            exit;
        } else $errors[] = core::getLanguage('error', 'web_apps_error');
    }
}


$row = Links::getLinkInfo(Core_Array::getRequest('id'));

$tpl->assign('TITLE_PAGE', core::getLanguage('title', 'page_addurl'));
$tpl->assign('TITLE_', core::getLanguage('title', 'page_addurl'));

$tpl->assign('ACTION', $_SERVER['REQUEST_URI']);
$tpl->assign('STR_RECIPROCAL_LINK', core::getLanguage('str','reciprocal_link'));
$tpl->assign('RECIPROCAL_LINK', Core_Array::getPost('reciprocal_link') ? $_POST['reciprocal_link'] : $row['reciprocal_link']);
$tpl->assign('TOKEN', Core_Array::getRequest('token') ? $_POST['token'] : $row['token']);
$tpl->assign('URL', Core_Array::getPost('url') ? $_POST['url'] : $row['url']);
$tpl->assign('ID', Core_Array::getRequest('id') ? $_REQUEST['id'] : $row['id']);
$tpl->assign('BUTTON_EDIT', core::getLanguage('button', 'edit'));

if (count($errors) > 0) {
    $errorBlock = $tpl->fetch('show_errors');
    $errorBlock->assign('STR_IDENTIFIED_FOLLOWING_ERRORS', core::getLanguage('str', 'identified_following_errors'));

    foreach ($errors as $error) {
        $rowBlock = $errorBlock->fetch('errors');
        $rowBlock->assign('ERROR', $error);
        $errorBlock->assign('errors', $rowBlock);
    }

    $tpl->assign('show_errors', $errorBlock);
}

include_once core::pathTo('extra', 'footer.php');

// display content
$tpl->display();