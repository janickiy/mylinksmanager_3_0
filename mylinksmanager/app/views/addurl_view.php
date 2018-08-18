<?php

/********************************************
 * My Links Manager 3.0.0 alfa
 * Copyright (c) 2011-2018 Alexander Yanitsky
 * Website: http://janicky.com
 * E-mail: janickiy@mail.ru
 * Skype: janickiy
 ********************************************/

defined('MYLINKSMANAGER') || exit('My Links Manager: access denied!');

session_start();
$_SESSION = [];

include("captcha.php");

core::requireEx('libs', "PHPMailer/class.phpmailer.php");

$_SESSION['captcha'] = simple_php_captcha();

//include template
core::requireEx('libs', "html_template/SeparateTemplate.php");
$tpl = SeparateTemplate::instance()->loadSourceFromFile(core::getTemplate() . core::getSetting('controller') . ".tpl");

$tpl->assign('IMAGE_SRC', $_SESSION['captcha']['image_src']);

$errors = [];

if (Core_Array::getRequest('action')) {
    $name = stripslashes(htmlspecialchars(trim(Core_Array::getPost('name'))));
    $email = stripslashes(htmlspecialchars(trim(Core_Array::getPost('email'))));
    $keywords = strtolower(htmlspecialchars(trim(Core_Array::getPost('keywords'))));
    $url = strtolower(trim(Core_Array::getPost('url')));
    $reciprocal_link = trim(Core_Array::getPost('reciprocal_link'));
    $description = stripslashes(htmlspecialchars(trim(Core_Array::getPost('description'))));
    $full_description = stripslashes(htmlspecialchars(trim(Core_Array::getPost('full_description'))));
    $htmlcode_banner = trim(Core_Array::getPost('htmlcode_banner'));
    $securitycode = trim(Core_Array::getPost('securitycode'));
    $cat_id = Core_Array::getPost('cat_id');

    // Cut out http:// from url of site
    if (!empty($url)){
        if (substr($url, 0, 7) == "http://") $url = str_replace('http://', '', $url);
        if (substr($url, 0, 8) == "https://") $url = str_replace('https://', '', $url);
        if (strpos($url, '/') > 0) list($url) = explode('/', $url);
    }

    // Cut out http:// from url address of reciprocal link
    if (!empty($reciprocal_link)){
        if (substr(strtolower($reciprocal_link), 0, 7) == "http://") $reciprocal_link = str_replace('http://', '', $reciprocal_link);
        if (substr(strtolower($reciprocal_link), 0, 8) == "https://") $reciprocal_link = str_replace('https://', '', $reciprocal_link);
    }

    // Cut out all unnecessary tags and javascript from HTML code of banner
    $htmlcode_banner  = Helper::cuttags($htmlcode_banner);

    // Check category is chosen, if not then print error
    if ($cat_id == 0){
        $errors[] = core::getLanguage('error', 'choose_category');
    }

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

    // Check on, whether the adding site on the same hosting as catalogue is located
    if (!empty($url) && core::getSetting('common_host') == "yes"){
        if (Helper::commonHost($url)) {
            $errors[] = core::getLanguage('error','same_hosting');
        }
    }

    // Check on, whether the url address of reciprocal link has the url address of catalogue in arg=value
    if ((!empty($reciprocal_link) && core::getSetting('check_get_parameter') == "yes") && Helper::checkGetParameter($reciprocal_link)) {
        $errors[] = core::getLanguage('error','arg_value');
    }

    // Verify domen of reciprocal link and of catalogue
    if ((!empty($reciprocal_link) && core::getSetting('check_links') == "yes") && Helper::nativeCheckLink($reciprocal_link,$url)) {
        $errors[] = core::getLanguage('error','verify_domen');
    }

    // Check the email on valid
    if (!empty($email) && Helper::checkEmail($email)) {
        $errors[]= core::getLanguage('error','wrong_email');
    }

    // Check the url address on valid
    if (!empty($url) && Helper::checkUrl($url)) {

        $errors[]= core::getLanguage('error','wrong_url');

        if (Helper::nativeCheckUrl($url)){
            $errors[] = core::getLanguage('error','not_your_site');
        }
    }

    // Check brief description of site on spaces
    if (!empty($description) && Helper::lengthDescription($description)) {
        $errors[] = core::getLanguage('error','short_desc_without_spaces');
    }

    // Count the number of characters of full description, if it more than a limit then print error
    if (!empty($full_description) && Helper::lengthDescription($full_description)){
        $errors[] = core::getLanguage('error','full_desc_spaces');
    }

    // Check min and max number of characters in brief description
    if (!empty($description) && Helper::lengthDescriptionLinkMin($description,core::getSetting('number_chars_description_min'))) {
        $errors[] = str_replace('%NUMBER_CHARS_DESCRIPTION_MIN%', core::getSetting('number_chars_description_min'), core::getLanguage('error','short_desc_min_char'));

        if (Helper::lengthDescriptionLinkMax($description,core::getSetting('number_chars_description_max'))) {
            $errors[] = str_replace('%NUMBER_CHARS_DESCRIPTION_MAX%', core::getSetting('number_chars_description_max'), core::getLanguage('error','short_desc_max_char'));
        }
    }

    // Check min and max number of characters in full description
    if (!empty($full_description)){

        if (Helper::lengthFullDescriptionMin($full_description, core::getSetting('number_chars_fulldescription_min'))) {
            $errors[] = str_replace('%NUMBER_CHARS_FULLDESCRIPTION_MIN%', core::getSetting('number_chars_fulldescription_min'), core::getLanguage('str','full_desc_min_char'));
        }

        if (Helper::lengthFullDescriptionMax($full_description, core::getSetting('number_chars_fulldescription_max'))) {
            $errors[] = str_replace('%NUMBER_CHARS_FULLDESCRIPTION_MAX%', core::getSetting('number_chars_fulldescription_max'), core::getLanguage('full_desc_max_char'));
        }
    }

    // Count the number of characters in HTML code of banner, if it more than a limit then print error
    if (!empty($htmlcode_banner) && Helper::lengthHtmlcode($htmlcode_banner, core::getSetting('number_html_chars'))) {
        $errors[] = str_replace('%NUMBER_HTML_CHARS%', core::getSetting('number_html_chars'), core::getLanguage('error','html_banner_limit'));
    }

    // if $settings['robot'] == yes then check on,
    // whether there's a prohibition on index of a reciprocal link by meta tag <meta name=robot>
    if (!empty($reciprocal_link) && core::getSetting('check_links') == "yes") {

        if (Helper::checkMeta($reciprocal_link)){
            $errors[] = core::getLanguage('error','close_index_tags');
        }

        // check a directory if it is closed for index then print error
        if (Helper::checkRobots($reciprocal_link)) {
            $errors[] = core::getLanguage('error','close_index_dir');
        }

        // if $settings['no_add_link'] == yes, check the number of links on the page of a reciprocal link
        // if the number of links is more than $settings['no_link'] print the notice
        if ((core::getSetting('limit_reciprocal_links') == "yes" && !empty($url)) && Helper::countLinks($reciprocal_link, core::getSetting('limit_reciprocal_link'))) {
            $errors[] = str_replace('%NUMBER_RECIPROCAL_LINKS_LIMIT%', core::getSetting('limit_reciprocal_link'), core::getLanguage('error', 'number_url'));
        }
    }

// If $settings['check_links'] == yes, then check
    // the find a reciprocal link on our site
    if (!empty($reciprocal_link) && core::getSetting('check_links') == "yes") {
        if (Helper::checkMultiLinkNative($reciprocal_link,core::getSetting('url'))) {
            $errors[] = core::getLanguage('error','not_reciprocal_link');
        }
    }

    // Check HTML code of banner on valid
    if (!empty($htmlcode_banner)){
        // check htmlcode of banner
        if (Helper::checkHtmlcodeBanner($htmlcode_banner)) {
            $errors[] = core::getLanguage('error','wrong_html_banner');
        } else {
            // check image size of banner
            if (Helper::checkSizeBanner($htmlcode_banner)) {
                $errors[] = core::getLanguage('error','size_banner');
            }

            // check image type of banner
            if (Helper::checkTypeImageBanner($htmlcode_banner)) {
                $errors[] = core::getLanguage('error','type_banner');
            }
        }
    }

    // Check all required fields is filled
    // Check site name, if its value is empty print error
    if (empty($name)) {
        $errors[] = core::getLanguage('error','nofill_name');
    }

    // Check site address, if its value is empty print error
    if (empty($url)) {
        $errors[] = core::getLanguage('error','nofill_url');
    }

    // Check reciprocal link, if its value is empty print error
    if (core::getSetting('check_links') == "yes" && empty($reciprocal_link)) {
        $errors[] = core::getLanguage('error','nofill_reciprocal_link');
    }

    // Check email, if its value is empty print error
    if (empty($email)) {
        $errors[] = core::getLanguage('error','nofill_email');
    }

    // Check description of link, if its value is empty print error
    if (empty($description)) {
        $errors[] = core::getLanguage('error', 'nofill_briefdesc');
    }

    // Check full description of link, if its value is empty print error
    if (empty($full_description)){
        $errors[] = core::getLanguage('error','nofill_fulldesc');
    }

    // Check CAPTCHA, if its value is empty print error
    if (empty($securitycode) && core::getSetting('request_captcha') == "yes"){
        $errors[] = core::getLanguage('error', 'not_filled_captcha');
    }

    // Add the link if there are not any errors
    if (empty($errors)) {
        $fields = [
            'id' => 0,
            'name' => $name,
            'url' => $url,
            'reciprocal_link' => $reciprocal_link,
            'created' => date("Y-m-d H:i:s"),
            'time_check' => '0000-00-00 00:00:00',
            'email' => $email,
            'keywords' => $keywords,
            'description' => $description,
            'full_description' => $full_description,
            'htmlcode_banner' => $htmlcode_banner,
            'cat_id' => $cat_id,
            'status' => core::getSetting('add_links_without_check') == "yes" ? 'show' : 'new',
            'token' => Helper::getRandomCode(),
            'check_link' => 'yes',
        ];

        $insert_id = $data->addLink($fields);

        if ($insert_id) {
            unset($_POST);

            $adr = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['PHP_SELF'] . '?link_id='. $insert_id;
            $msgUser = core::getSetting('template_mail_1');
            $msgUser = str_replace("{[HTTP_HOST]}", $_SERVER['SERVER_NAME'], $msgUser);
            $msgUser = str_replace("{[ADRESS]}", $adr, $msgUser);
            $msgUser = str_replace("{[NAME]}", Core_Array::getPost('name'), $msgUser);
            $msgUser = str_replace("{[EMAIL]}", Core_Array::getPost('email'), $msgUser);
            $msgUser = str_replace("{[URL]}", Core_Array::getPost('url'), $msgUser);
            $msgUser = str_replace("{[DESCRIPTION]}", Core_Array::getPost('description'), $msgUser);
            $msgUser = str_replace("{[DATE]}", date("d.m.Y г. G:i:s"), $msgUser);

            if (core::getSetting('add_links_without_check') == 'no') {
                $m = new PHPMailer();
                $m->IsMail();
                $m->CharSet = 'utf-8';
                $m->Subject = core::getLanguage('str','subject_wait');
                $m->FromName = $_SERVER['SERVER_NAME'];
                $m->From = core::getSetting('email') ? core::getSetting('email') : "noreply@" . $_SERVER['SERVER_NAME'];
                $m->isHTML(false);
                $m->AddAddress($email);
                $m->Body = $msgUser;
                $m->Send();
            }

            // Notify admin of catalogue about a new link
            if ( core::getSetting('new_links_notification') == "yes" &&  core::getSetting('email') != ''){
                $msgAdmin = core::getSetting('template_mail_5');
                $msgAdmin = str_replace("{[HTTP_HOST]}", $_SERVER['SERVER_NAME'], $msgAdmin);
                $msgAdmin = str_replace("{[NAME]}", Core_Array::getPost('name'), $msgAdmin);
                $msgAdmin = str_replace("{[EMAIL]}", Core_Array::getPost('email'), $msgAdmin);
                $msgAdmin = str_replace("{[URL]}", Core_Array::getPost('url'), $msgAdmin);
                $msgAdmin = str_replace("{[DESCRIPTION]}", Core_Array::getPost('description'), $msgAdmin);
                $msgAdmin = str_replace("{[DATE]}", $date, $msgAdmin);

                $m = new PHPMailer();
                $m->IsMail();
                $m->CharSet = 'utf-8';
                $m->Subject = core::getLanguage('str','subject_newlink');
                $m->FromName = $_SERVER['SERVER_NAME'];
                $m->From = core::getSetting('email');
                $m->isHTML(false);
                $m->AddAddress(core::getSetting('email'));
                $m->Body = $msgAdmin;
                $m->Send();
            }
        }
    }
}

$tpl->assign('TITLE_PAGE', core::getLanguage('title', 'page_addurl'));
$tpl->assign('TITLE', core::getLanguage('title', 'addurl'));

$tpl->assign('STR_GO_TO_CATALOG', core::getLanguage('str','go_to_catalog'));
$tpl->assign('STR_HTMLCODE_BANNER', core::getLanguage('str','htmlcode_banner'));

$tpl->assign('ALERT_INITIAALIZATION_ERROR_INTERFACE', core::getLanguage('error','alert_initiaalization_error_interface'));

//form
$tpl->assign('ACTION', $_SERVER['REQUEST_URI']);
$tpl->assign('STR_REQUIRED_FIELD', core::getLanguage('str','required_field'));
$tpl->assign('STR_CHOOSE_YOUR_CATEGORY', core::getLanguage('str','choose_your_category'));
$tpl->assign('STR_CHOOSE_CATEGORY', core::getLanguage('str','choose_category'));
$tpl->assign('STR_FORM_NAME', core::getLanguage('str','form_name'));
$tpl->assign('STR_FORM_URL', core::getLanguage('str','form_url'));
$tpl->assign('STR_FORM_EMAIL', core::getLanguage('str','form_email'));
$tpl->assign('STR_FORM_KEYWORDS', core::getLanguage('str','form_keywords'));
$tpl->assign('STR_SEPARATED_BY_COMMAS', core::getLanguage('str','separated_by_commas'));
$tpl->assign('STR_FORM_DESCRIPTION', core::getLanguage('str','form_description'));
$tpl->assign('STR_ONLY_TEXT_NOT_HTMLCODE', core::getLanguage('str','only_text_not_htmlcode'));
$tpl->assign('STR_FORM_SECURITYCODE', core::getLanguage('str','form_securitycode'));
$tpl->assign('STR_SECURITYCODE', core::getLanguage('str','securitycode'));
$tpl->assign("OPTION", Category::ShowTree(0,0));
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
$tpl->assign('STR_RULES', core::getLanguage('str','rules'));
$tpl->assign('STR_HTML_CODE_OF_LINK_FOR_THIS', core::getLanguage('str','html_code_of_link_for_this'));
$tpl->assign('STR_HTML_CODE_OF_BANNER_FOR_THIS', core::getLanguage('str','html_code_of_banner_for_this'));
$tpl->assign('STR_FORM_RECIPROCAL_LINK', core::getLanguage('str','form_reciprocal_link'));

//value
$tpl->assign('NAME',Core_Array::getPost('name'));
$tpl->assign('URL',Core_Array::getPost('url'));
$tpl->assign('RECIPROCAL_LINK',Core_Array::getPost('reciprocal_link'));
$tpl->assign('EMAIL',Core_Array::getPost('email'));
$tpl->assign('KEYWORDS',Core_Array::getPost('keywords'));
$tpl->assign('DESCRIPTION',Core_Array::getPost('description'));
$tpl->assign('FULL_DESCRIPTION',Core_Array::getPost('full_description'));
$tpl->assign('HTMLCODE_BANNER',Core_Array::getPost('htmlcode_banner'));

$tpl->assign('NUMBER_CHARS_DESCRIPTION_MIN', core::getSetting('number_chars_description_min'));
$tpl->assign('NUMBER_CHARS_FULLDESCRIPTION_MIN', core::getSetting('number_chars_fulldescription_min'));
$tpl->assign('NUMBER_CHARS_DESCRIPTION_MAX', core::getSetting('number_chars_description_max'));
$tpl->assign('NUMBER_CHARS_FULLDESCRIPTION_MAX', core::getSetting('number_chars_fulldescription_max'));
$tpl->assign('NUMBER_HTML_CHARS', core::getSetting('number_html_chars'));
$tpl->assign('SECURITYCODE', core::getSetting('request_captcha'));

$tpl->assign('HTMLCODE_SITE1', str_replace("'","`", core::getSetting('htmlcode_site1')));
$tpl->assign('HTMLCODE_SITE2', str_replace("'","`", core::getSetting('htmlcode_site2')));
$tpl->assign('HTMLCODE_SITE3', str_replace("'","`", core::getSetting('htmlcode_site3')));

$tpl->assign('HTMLCODE_BANNER1', core::getSetting('htmlcode_banner1'));
$tpl->assign('HTMLCODE_BANNER2', core::getSetting('htmlcode_banner2'));
$tpl->assign('HTMLCODE_BANNER3', core::getSetting('htmlcode_banner3'));

$tpl->assign('RULES', str_replace("'","`", core::getSetting('rules')));

$tpl->assign('CHECK_URL', core::getSetting('check_links'));

if (count($errors) > 0){
    $errorBlock = $tpl->fetch('show_errors');
    $errorBlock->assign('STR_IDENTIFIED_FOLLOWING_ERRORS', core::getLanguage('str','identified_following_errors'));

    foreach ($errors as $error){
        $rowBlock = $errorBlock->fetch('errors');
        $rowBlock->assign('ERROR', $error);
        $errorBlock->assign('errors', $rowBlock);
    }

    $tpl->assign('show_errors', $errorBlock);
}

include_once core::pathTo('extra', 'footer.php');

// display content
$tpl->display();