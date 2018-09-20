<?php

/********************************************
 * My Links Manager 3.0.2
 * Copyright (c) 2011-2018 Alexander Yanitsky
 * Website: http://janicky.com
 * E-mail: janickiy@mail.ru
 * Skype: janickiy
 ********************************************/

defined('MYLINKSMANAGER') || exit('My Links Manager: access denied!');

Auth::authorization();

//include template
core::requireEx('libs', "html_template/SeparateTemplate.php");
$tpl = SeparateTemplate::instance()->loadSourceFromFile(core::getTemplate() . "admin/addcategory.tpl");

$tpl->assign('TITLEPAGE', core::getLanguage('title', 'admin_pape_addcategory'));
$tpl->assign('TITLE', core::getLanguage('title', 'admin_addcategory'));
$tpl->assign('HELP', core::getLanguage('info', 'admin_addcategory'));

$errors = [];

if (Core_Array::getRequest('action')) {
    $name = trim(Core_Array::getRequest('name'));
    $description = trim(Core_Array::getRequest('description'));
    $keywords = trim(Core_Array::getRequest('keywords'));
    $parent_id = Core_Array::getRequest('parent_id');

    if (empty($name)) $errors[] = core::getLanguage('error', 'fill_cat_name');

    if (!empty($_FILES["image"]["name"])){
        $size = filesize ($_FILES['image']['tmp_name']);

        if ($size / 1024 > 100){
            $errors[] = str_replace('%LIMIT%','100',core::getLanguage('error', 'filesize'));
        }
    }

    if (empty($errors)) {

        if (!empty($_FILES['image']['tmp_name'])){
            $ext = strrchr($_FILES["image"]["name"], ".");

            if (preg_match('/\.(jpg|jpeg|png|gif)$/i', $ext)){
                $tmp = $_FILES['image']['tmp_name'];
                $original = file_get_contents($tmp);
                $image_mime = $_FILES["image"]["type"];
                $image = Helper::image_convert($original, 80, 80, $image_mime);
            }
        }

        $fields = [
            'id' => 0,
            'name' => $name,
            'description' => $description,
            'keywords' => $keywords,
            'image' => isset($image) ? $image : '',
            'image_mime' => isset($image_mime) ? $image_mime : '',
            'parent_id' => $parent_id,
        ];

        if ($data->addCategory($fields)) {
            header("Location: " . Helper::url("./?a=admin&t=categories&parent=" . $parent_id));
            exit;
        } else {
            $errors[] =  core::getLanguage('error', 'web_apps_error');
        }
    }
}

include_once core::pathTo('extra', 'admin/top.php');

//menu
include_once core::pathTo('extra', 'admin/menu.php');

//FORM
$tpl->assign('STR_REQUIRED_FIELDS', core::getLanguage('str', 'required_fields'));
$tpl->assign('STR_GO_BACK', core::getLanguage('str', 'go_back'));
$tpl->assign('STR_NO', core::getLanguage('str', 'no'));
$tpl->assign('STR_CATEGORY_NAME', core::getLanguage('str', 'category_name'));
$tpl->assign('STR_CATEGORY_DESCRIPTION', core::getLanguage('str', 'category_description'));
$tpl->assign('STR_CATEGORY_KEYWORDS', core::getLanguage('str', 'category_keywords'));
$tpl->assign('STR_CATEGORY', core::getLanguage('str', 'category'));
$tpl->assign('STR_CATEGORY_IMAGE', core::getLanguage('str', 'category_image'));
$tpl->assign('STR_REMOVE_PIC', core::getLanguage('str', 'remove_pic'));
$tpl->assign('BUTTON', core::getLanguage('button', 'add'));

//value
$tpl->assign('ACTION', $_SERVER['REQUEST_URI']);
$tpl->assign('NAME', Core_Array::getRequest('name'));
$tpl->assign('DESCRIPTION', Core_Array::getRequest('description'));
$tpl->assign('KEYWORDS', Core_Array::getRequest('keywords'));
$tpl->assign('FREEZ', 'yes');
$tpl->assign('ID_PARENT', Core_Array::getRequest('Core_Array::getRequest'));

//footer
include_once core::pathTo('extra', 'admin/footer.php');

//display content
$tpl->display();