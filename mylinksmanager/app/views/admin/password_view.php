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
$tpl = SeparateTemplate::instance()->loadSourceFromFile(core::getTemplate() . "admin/password.tpl");

$tpl->assign('TITLEPAGE', core::getLanguage('title', 'admin_page_password'));
$tpl->assign('TITLE', core::getLanguage('title', 'admin_password'));
$tpl->assign('HELP', core::getLanguage('info', 'admin_password'));

$errors = Array();

if (Core_Array::getRequest('action')) {
    $current_password = trim(Core_Array::getRequest('current_password'));
    $password = trim(Core_Array::getRequest('password'));
    $password_again = trim(Core_Array::getRequest('password_again'));

    if (empty($current_password)){
        $errors[] = core::getLanguage('error', 'fill_current_password');
    }

    if (empty($password)){
        $errors[] = core::getLanguage('error', 'fill_password');
    }

    if (empty($password_again)){
        $errors[] = core::getLanguage('error', 'fill_again_password');
    }

    if (!empty($password) && !empty($password_again) && $password != $password_again){
        $errors[] = core::getLanguage('error', 'passwords_dont_match');
    }

    if (!empty($current_password)){
        if (Auth::getCurrentHash() != md5($current_password)){
            $errors[] = core::getLanguage('error', 'wrong_password');
        }
    }

    if (empty($errors)){

        if ($data->changePassword($password)) {
            $success_msg = core::getLanguage('msg', 'password_changed');
        } else {
            $errors[] = core::getLanguage('error', 'change_password');
        }
    }
}

include_once core::pathTo('extra', 'admin/top.php');

//menu
include_once core::pathTo('extra', 'admin/menu.php');

//form
$tpl->assign('ACTION', $_SERVER['REQUEST_URI']);
$tpl->assign('STR_CURRENT_PASSWORD', core::getLanguage('str', 'current_password') );
$tpl->assign('STR_NEW_PASSWORD', core::getLanguage('str', 'new_password'));
$tpl->assign('STR_NEW_PASSWORD_AGAIN', core::getLanguage('str', 'new_password_again'));
$tpl->assign('BUTTON_SAVE', core::getLanguage('button', 'save') );

// Report an errors
if (!empty($errors)) {
    $errorBlock = $tpl->fetch('show_errors');
    $errorBlock->assign('STR_IDENTIFIED_FOLLOWING_ERRORS', core::getLanguage('str', 'identified_following_errors'));

    foreach($errors as $row) {
        $rowBlock = $errorBlock->fetch('row');
        $rowBlock->assign('ERROR', $row);
        $errorBlock->assign('row', $rowBlock);
    }

    $tpl->assign('show_errors', $errorBlock);
}

if (isset($success_msg)) {
    $tpl->assign('MSG_ALERT', $success_msg);
}

//footer
include_once core::pathTo('extra', 'admin/footer.php');

//display content
$tpl->display();