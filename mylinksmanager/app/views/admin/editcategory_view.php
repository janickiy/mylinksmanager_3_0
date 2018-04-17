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
$tpl = SeparateTemplate::instance()->loadSourceFromFile(core::getTemplate() . "admin/editcategory.tpl");

$tpl->assign('TITLEPAGE', core::getLanguage('title', 'admin_page_editcategory'));
$tpl->assign('TITLE', core::getLanguage('title', 'admin_editcategory'));
$tpl->assign('HELP', core::getLanguage('info', 'admin_help'));


$errors = [];

if (Core_Array::getRequest('action')) {
    $name = trim(Core_Array::getRequest('name'));
    $description = trim(Core_Array::getRequest('description'));
    $keywords = trim(Core_Array::getRequest('keywords'));

    // Check whether is exist name of catalog
    if (empty($name)) $errors[] = core::getLanguage('error', 'fill_cat_name');

    if (!empty($_FILES["image"]["name"])) {
        $size = filesize($_FILES['image']['tmp_name']);

        if ($size / 1024 > 100) {
            $errors[] = str_replace('%LIMIT%', '100', core::getLanguage('error', 'filesize'));
        }
    }

    // Form SQL-query to edit data
    if (empty($errors)) {

        $new_id_cat = Core_Array::getPost('new_id_cat') == 0 ? 0 : Core_Array::getPost('new_id_cat');

        if (empty($_FILES['image']['tmp_name'])) {
            $ext = strrchr($_FILES["image"]["name"], ".");

            if (preg_match('/\.(jpg|jpeg|png|gif)$/i', $ext)) {
                $tmp = $_FILES['image']['tmp_name'];
                $original = file_get_contents($tmp);
                $image_mime = $_FILES["image"]["type"];
                $image = Helper::image_convert($original, 80, 80, $image_mime);
            }
        }

        $fields = [
            'name' => $name,
            'description' => $description,
            'keywords' => $keywords,
            'image' => isset($image) ? $image : '',
            'image_mime' => isset($image_mime) ? $image_mime : '',
            'parent_id' => $new_id_cat,
        ];

        if ($data->editCategory($fields, Core_Array::getPost('id'))) {
            header("Location: ./?a=admin&t=categories");
            exit;
        } else  $errors[] = core::getLanguage('error', 'web_apps_error');
    }
}

include_once core::pathTo('extra', 'top.php');

//menu
include_once core::pathTo('extra', 'menu.php');

$row = $data->getCategoryRow(Core_Array::getRequest('id'));

//form
$tpl->assign('STR_REQUIRED_FIELDS', core::getLanguage('str', 'required_fields'));
$tpl->assign('STR_GO_BACK', core::getLanguage('str', 'go_back'));
$tpl->assign('STR_NO', core::getLanguage('str', 'no'));
$tpl->assign('STR_CATEGORY_NAME', core::getLanguage('str', 'category_name'));
$tpl->assign('STR_CATEGORY_DESCRIPTION', core::getLanguage('str', 'category_description'));
$tpl->assign('STR_CATEGORY_KEYWORDS', core::getLanguage('str', 'category_keywords'));
$tpl->assign('STR_CATEGORY', core::getLanguage('str', 'category'));
$tpl->assign('STR_CATEGORY_IMAGE', core::getLanguage('str', 'category_image'));
$tpl->assign('STR_REMOVE_PIC', core::getLanguage('str', 'remove_pic'));
$tpl->assign('BUTTON', core::getLanguage('button', 'edit'));

//value
$tpl->assign('PHP_SELF', $_SERVER['REQUEST_URI']);
$tpl->assign('NAME', Core_Array::getPost('name') ? $_POST['name'] : $row['name']);
$tpl->assign('DESCRIPTION', Core_Array::getPost('description') ? $_POST['description'] : $row['description']);
$tpl->assign('KEYWORDS', Core_Array::getPost('keywords') ? $_POST['keywords'] : $row['keywords']);
$tpl->assign('PARENT_ID', Core_Array::getPost('parent_id') ? $_POST['parent_id'] : $row['parent_id']);
$tpl->assign('ID', $row['id']);

if ($data->getTotal(Core_Array::getRequest('id'))) {
    $tpl->assign('OPTION', Links::ShowCategoryList(0, 0, Core_Array::getRequest('id')));
}

//footer
include_once core::pathTo('extra', 'footer.php');

//display content
$tpl->display();