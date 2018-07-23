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
$tpl = SeparateTemplate::instance()->loadSourceFromFile(core::getTemplate() . "admin/editlink.tpl");

$tpl->assign('TITLEPAGE', core::getLanguage('title', 'admin_page_addlink'));
$tpl->assign('TITLE', core::getLanguage('title', 'admin_addlink'));

$errors = [];

if (Core_Array::getRequest('action')){
    $name = stripslashes(htmlspecialchars(trim(Core_Array::getPost('name'))));
    $url = strtolower(trim(Core_Array::getPost('url')));
    $reciprocal_link =  strtolower(trim(Core_Array::getPost('reciprocal_link')));
    $email = strtolower(trim(Core_Array::getPost('email')));
    $description = stripslashes(htmlspecialchars(trim(Core_Array::getPost('description'))));
    $full_description = stripslashes(htmlspecialchars(trim(Core_Array::getPost('full_description'))));
    $keywords = htmlspecialchars(trim(Core_Array::getPost('keywords')));
    $htmlcode_banner = stripslashes(trim(Core_Array::getPost('htmlcode_banner')));
    $cat_id = Core_Array::getPost('cat_id');

    // Cut out http:// from url of site
    if (!empty($url)){
        if (substr($url, 0, 7) == "http://") $url = str_replace('http://', '', $url);
        if (strpos($url, '/') > 0) list($url) = explode('/', $url);
    }

    // Cut out http:// from url address of reciprocal link
    if (!empty($reciprocal_link)){
        if (substr(strtolower($reciprocal_link), 0, 7) == "http://") $reciprocal_link = str_replace('http://', '', $reciprocal_link);
    }

    // Cut out all unnecessary tags and javascripts from HTML code of banner
    $htmlcode_banner  = Helper::cuttags($htmlcode_banner);

    // Check catalogue already has adding link, if it has then print error
    if (!empty($url)) {
        $src_url = $url;

        if(substr($url, 0, 4) == "www.") $src_url = str_replace('www.', '', $src_url);
        $src_url = str_replace('.', '\\.', $src_url);

        if (Links::CheckWaitVerification($src_url)) {
            $errors[] = core::getLanguage('error', 'wait_verification');
        }

        if (Links::CheckExistsLink($src_url)) {
            $errors[] = core::getLanguage('error', 'already_exists');
        }
    }

    // Check category is chosen, if not then print error
    if ($cat_id == 0){
        $errors[] = core::getLanguage('error', 'choose_category');
    }

    // Check the url on valid
    if (!empty($url) && Helper::checkUrl($url)){
        $errors[] = core::getLanguage('error', 'wrong_url');
    }

    // Check on, whether the adding site on the same hosting as catalogue is located
    if ((!empty($url) && core::getSetting('common_host') == "yes") && Helper::commonHost($url)) {
        $errors[] = core::getLanguage('error', 'same_hosting');
    }

    // Check email on valid
    if (!empty($email) && Helper::checkEmail($email)){
        $errors[] = core::getLanguage('error', 'wrong_email');
    }

    // Check brief description of site on spaces
    if (!empty($description) && Helper::lengthDescription($description)){
        $error[] = core::getLanguage('error', 'short_desc_without_spaces');
    }

    // Check full description of site on a quantity of characters
    if (!empty($full_description) && Helper::lengthDescription($full_description)){
        $errors[] = core::getLanguage('error', 'full_desc_without_spaces');
    }

    // Check HTML code of banner on valid
    if (!empty($htmlcode_banner)){
        // check htmlcode of banner
        if (Helper::checkHtmlcodeBanner($htmlcode_banner)) {
            $errors[] = core::getLanguage('error', 'wrong_html_banner');
        } else {
            // check image size of banner
            if (Helper::checkSizeBanner($htmlcode_banner)) {
                $errors[] = core::getLanguage('error', 'size_banner');
            }
        }
    }

    // Check all required fields is filled
    // Check site name, if its value is empty print error
    if (empty($name)){
        $errors[] = core::getLanguage('error' , 'nofill_name');
    }

    // Check site address, if its value is empty print error
    if (empty($url)){
        $errors[] = core::getLanguage('error' , 'nofill_url');
    }

    // Check reciprocal link, if its value is empty print error
    if (empty($description)){
        $errors[] = core::getLanguage('error' , 'nofill_briefdesc');
    }

    // Check email, if its value is empty print error
    if (empty($full_description)){
        $errors[] = core::getLanguage('error' , 'nofill_fulldesc');
    }

    if (empty($errors)) {
        $fields = [];
        $fields['name'] = $name;
        $fields['url'] = $url;
        $fields['reciprocal_link'] = $reciprocal_link;
        $fields['email'] = $email;
        $fields['keywords'] = $keywords;
        $fields['description'] = $description;
        $fields['full_description'] = $full_description;
        $fields['htmlcode_banner'] = $fields;
        $fields['cat_id'] = $cat_id;
        $fields['token'] = Helper::getRandomCode();
        $fields['check_link'] = Core_Array::getPost('check_link') ? 'yes':'no';

        if ($data->editLink($fields, Core_Array::getPost('id'))) {
            unset($_POST);
            $success_msg = core::getLanguage('msg', 'link_added');
        }
    }
}

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

if (isset($success_msg)) $tpl->assign('MSG_ALERT', $success_msg);


include_once core::pathTo('extra', 'top.php');

// menu
include_once core::pathTo('extra', 'menu.php');

//form
$tpl->assign('STR_REQUIRED_FIELDS', core::getLanguage('str', 'required_fields'));
$tpl->assign('STR_CATEGORY', core::getLanguage('str', 'category'));
$tpl->assign('STR_CHOOSE_CATEGORY', core::getLanguage('str', 'choose_category'));
$tpl->assign('STR_WEBSITE_NAME', core::getLanguage('str', 'website_name'));
$tpl->assign('STR_URL', core::getLanguage('str', 'url'));
$tpl->assign('STR_ADDRESS_OF_RECIP_LINK_PAGE', core::getLanguage('str', 'address_of_recip_link_page'));
$tpl->assign('STR_EMAIL', core::getLanguage('str', 'email'));
$tpl->assign('STR_ONLY_TEXT_NOT_HTML', core::getLanguage('str', 'only_text_not_html'));
$tpl->assign('STR_KEYWORDS', core::getLanguage('str', 'keywords'));
$tpl->assign('STR_LIST_SEPARATED_BY_COMMAS', core::getLanguage('str', 'list_separated_by_commas'));
$tpl->assign('STR_BRIEF_DESCRIPTION', core::getLanguage('str', 'brief_description'));
$tpl->assign('STR_TO_CHECK_THIS_LINK', core::getLanguage('str', 'to_check_this_link'));
$tpl->assign('STR_FULL_DESCRIPTION', core::getLanguage('str', 'full_description'));
$tpl->assign('STR_HTML_CODE_OF_BANNER', core::getLanguage('str', 'html_code_of_banner'));
$tpl->assign('BUTTON', core::getLanguage('button', 'add'));

$row = $data->getLink(Core_Array::getRequest('id'));

$_POST['cat_id'] = Core_Array::getPost('cat_id') ?  $_POST['cat_id'] : $row['cat_id'];

//value
$tpl->assign('HIDDEN_FIELD','');
$tpl->assign('ACTION', $_SERVER['REQUEST_URI']);
$tpl->assign('OPTION', Category::ShowTree(0, 0));
$tpl->assign('NAME', Core_Array::getPost('name') ? $_POST['name'] : $row['name']);
$tpl->assign('URL', Core_Array::getPost('url') ? $_POST['url'] : $row['url']);
$tpl->assign('RECIPROCAL_LINK', Core_Array::getPost('reciprocal_link') ? $_POST['reciprocal_link'] : $row['reciprocal_link']);
$tpl->assign('EMAIL', Core_Array::getPost('email') ? $_POST['email'] : $row['email']);
$tpl->assign('KEYWORDS', Core_Array::getPost('keywords') ? $_POST['keywords'] : $row['keywords']);
$tpl->assign('DESCRIPTION', Core_Array::getPost('description') ? $_POST['description'] : $row['description']);
$tpl->assign('FULL_DESCRIPTION', Core_Array::getPost('full_description') ? $_POST['full_description'] : $row['full_description']);
$tpl->assign('FULL_DESCRIPTION', Core_Array::getPost('htmlcode_banner') ? $_POST['htmlcode_banner'] : $row['htmlcode_banner']);
$tpl->assign('CAT_ID', $_POST['cat_id']);
$tpl->assign('CHECK_LINK', Core_Array::getPost('check_link') ?  $_POST['check_link'] : $row['check_link']);

//footer
include_once core::pathTo('extra', 'footer.php');

//display content
$tpl->display();