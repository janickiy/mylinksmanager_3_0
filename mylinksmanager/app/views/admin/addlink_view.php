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
$tpl = SeparateTemplate::instance()->loadSourceFromFile(core::getTemplate() . "admin/addlink.tpl");

$tpl->assign('TITLE_PAGE', core::getLanguage('title_page', 'admin_addlink'));
$tpl->assign('TITLE', core::getLanguage('title_page', 'admin_addlink'));

$errors = array();

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
    $htmlcode_banner  = Mlm::cuttags($htmlcode_banner);

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
    if (!empty($url) && Mlm::checkUrl($url)){
        $errors[] = core::getLanguage('error', 'wrong_url');
    }

    // Check on, whether the adding site on the same hosting as catalogue is located
    if ((!empty($url) && core::getSetting('common_host') == "yes") && Mlm::commonHost($url)) {
        $errors[] = core::getLanguage('error', 'same_hosting');
    }

    // Check email on valid
    if (!empty($email) && Mlm::checkEmail($email)){
        $errors[] = core::getLanguage('error', 'wrong_email');
    }

    // Check brief description of site on spaces
    if (!empty($description) && Mlm::lengthDescription($description)){
        $error[] = core::getLanguage('error', 'short_desc_without_spaces');
    }

    // Check full description of site on a quantity of characters
    if (!empty($full_description) && Mlm::lengthFullDescription($full_description)){
        $errors[] = core::getLanguage('error', 'full_desc_without_spaces');
    }

    // Check HTML code of banner on valid
    if (!empty($htmlcode_banner)){
        // check htmlcode of banner
        if (Mlm::checkHtmlcodeBanner($htmlcode_banner)) {
            $errors[] = core::getLanguage('error', 'wrong_html_banner');
        } else {
            // check image size of banner
            if (Mlm::checkSizeBanner($htmlcode_banner)) {
                $errors[] = core::getLanguage('error', 'size_banner');
            }

            // check image type of banner
            if (Mlm::checkTypeImageBanner($htmlcode_banner)) {
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
        $fields = array();
        $fields['id'] = 0;
        $fields['name'] = $name;
        $fields['url'] = $url;
        $fields['reciprocal_link'] = $reciprocal_link;
        $fields['time'] = date("Y-m-d H:i:s");
        $fields['time_check'] = '0000-00-00 00:00:00';
        $fields['email'] = $email;
        $fields['keywords'] = $keywords;
        $fields['description'] = $description;
        $fields['full_description'] = $full_description;
        $fields['htmlcode_banner'] = $fields;
        $fields['cat_id'] = $cat_id;
        $fields['status'] = 'show';
        $fields['token'] = Mlm::getRandomCode();
        $fields['check_link'] = Core_Array::getPost('check_link') ? 'yes':'no';
        $fields['count'] = 0;
        $fields['number_check' = 0;


        $data->addLink($fields);
    }



}


//display content
$tpl->display();