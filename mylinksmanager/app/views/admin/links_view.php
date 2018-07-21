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
$tpl = SeparateTemplate::instance()->loadSourceFromFile(core::getTemplate() . "admin/links.tpl");

$tpl->assign('TITLEPAGE', core::getLanguage('title', 'admin_page_links'));
$tpl->assign('TITLE', core::getLanguage('title', 'admin_links'));
$tpl->assign('HELP', core::getLanguage('info', 'admin_links'));


include_once core::pathTo('extra', 'top.php');

$order = [
    'name'  => "name",
    'email' => "email",

];

$strtmp = "name";
$sort = '';

foreach($order as $parametr => $field) {
    if (isset($_GET[$parametr])) {
        if ($_GET[$parametr] == "up"){
            $_GET[$parametr] = "down";
            $strtmp = $field;
            $sort = "&" . $field . "=up";
            $thclass[$parametr] = 'headerSortUp';
        } else {
            $_GET[$parametr] = "up";
            $strtmp = $field . " DESC";
            $sort = "&" . $field . "=down";
            $thclass[$parametr] = 'headerSortDown';
        }
    } else {
        $_GET[$parametr] = "up";
        $thclass[$parametr] = 'headerUnSort';
    }
}

//pagination
if (isset($_COOKIE['pnumber_subscribers']))
    $pnumber = (int)$_COOKIE['pnumber_subscribers'];
else
    $pnumber = 20;


$arrs = $data->getLinksArray($strtmp, $search, Core_Array::getRequest('category'), Core_Array::getRequest('page'), $pnumber);

if ($arrs) {
    foreach ($arrs as $row) {
        $columnBlock = $rowBlock->fetch('column');

        $rowBlock->assign('column', $columnBlock);
    }
} else {
    if (!empty($search)) {
        $notfoundBlock = $tpl->fetch('notfound');
        $notfoundBlock->assign('MSG_NOTFOUND',   core::getLanguage('msg', 'notfound'));
        $tpl->assign('notfound', $notfoundBlock);
    } else {
        $tpl->assign('EMPTY_LIST', core::getLanguage('str', 'empty'));
    }
}

$tpl->assign('STR_NAME', core::getLanguage('str', 'name'));
$tpl->assign('STR_EMAIL', core::getLanguage('str', 'email'));
$tpl->assign('STR_DESCRIPTION', core::getLanguage('str', 'description'));
$tpl->assign('STR_CATEGORY', core::getLanguage('str', 'category'));
$tpl->assign('STR_VIEWS', core::getLanguage('str', 'views'));
$tpl->assign('STR_CREATED', core::getLanguage('str', 'created'));
$tpl->assign('STR_ACTION', core::getLanguage('str', 'action'));

// menu
include_once core::pathTo('extra', 'menu.php');


//footer
include_once core::pathTo('extra', 'footer.php');


//display content
$tpl->display();