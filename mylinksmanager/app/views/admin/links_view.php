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

if (Core_Array::getRequest('remove') && is_numeric($_REQUEST['remove'])) {
    if ($data->removeLink($_REQUEST['remove']))
        $success_alert = core::getLanguage('msg', 'selected_links_deleted');
    else
        $errors[] =   core::getLanguage('error', 'web_apps_error');

}

$errors = [];

if (Core_Array::getRequest('action')) {
    switch($_REQUEST['action']) {
        case 1:
            if ($data->updateLinks( Core_Array::getRequest('activate'), 'show')) {
                $success_alert = core::getLanguage('msg', 'selected_links_added');
            } else {
                $errors[] = core::getLanguage('error', 'web_apps_error');
            }

            break;

        case 2:
            if ($data->updateLinks(Core_Array::getRequest('activate'), 'black')) {
                $success_alert = core::getLanguage('msg', 'selected_links_black');
            } else {
                $errors[] = core::getLanguage('error', 'web_apps_error');
            }

            break;

        case 3:
            if ($data->checkLinks( Core_Array::getRequest('activate'))) {
                $success_alert =  core::getLanguage('msg', 'selected_links_ckecked');
            } else {
                $errors[] =  core::getLanguage('error', 'web_apps_error');
            }

            break;

        case 4:
            if ($data->deleteLinks( Core_Array::getRequest('activate'))) {
                $success_alert =  core::getLanguage('msg', 'selected_links_deleted');
            } else {
                $errors[] =  core::getLanguage('error', 'web_apps_error');
            }

            break;
    }
}

//include template
core::requireEx('libs', "html_template/SeparateTemplate.php");
$tpl = SeparateTemplate::instance()->loadSourceFromFile(core::getTemplate() . "admin/links.tpl");


$tpl->assign('TITLEPAGE', core::getLanguage('title', 'admin_page_links'));
$tpl->assign('TITLE', core::getLanguage('title', 'admin_links'));
$tpl->assign('HELP', core::getLanguage('info', 'admin_links'));

include_once core::pathTo('extra', 'top.php');

$order = [
    'id'  => "id",
    'name'  => "name",
    'email' => "email",
    'url' => "url",
    'category' => "cat_id",
    'views' => "views",
    'status' => "status",
    'created' => "created"
];

$strtmp = "name";
$sort = '';

foreach($order as $parametr => $field) {
    if (isset($_GET[$parametr])) {
        if ($_GET[$parametr] == "up"){
            $_GET[$parametr] = "down";
            $strtmp = $field;
            $sort = "&" . $parametr  . "=up";
        } else {
            $_GET[$parametr] = "up";
            $strtmp = $field . " DESC";
            $sort = "&" . $parametr . "=down";
        }
    }
}

//pagination
if (isset($_COOKIE['pnumber_links']))
    $pnumber = (int)$_COOKIE['pnumber_links'];
else
    $pnumber = 5;

$search = Core_Array::getRequest('search');

//form
$tpl->assign('FORM_SEARCH_NAME', core::getLanguage('str', 'search_name'));
$tpl->assign('BUTTON_FIND',  core::getLanguage('button', 'find'));
$tpl->assign('ACTION', $_SERVER['REQUEST_URI']);

$arrs = $data->getLinksArray(Core_Array::getRequest('page'), $pnumber, $strtmp);

if ($arrs) {
    $rowBlock = $tpl->fetch('row');

    $rowBlock->assign('STR_NAME', core::getLanguage('str', 'name'));
    $rowBlock->assign('STR_EMAIL', core::getLanguage('str', 'email'));
    $rowBlock->assign('STR_URL', core::getLanguage('str', 'url'));
    $rowBlock->assign('STR_DESCRIPTION', core::getLanguage('str', 'description'));
    $rowBlock->assign('STR_CATEGORY', core::getLanguage('str', 'category'));
    $rowBlock->assign('STR_VIEWS', core::getLanguage('str', 'views'));
    $rowBlock->assign('STR_CREATED', core::getLanguage('str', 'created'));
    $rowBlock->assign('STR_STATUS', core::getLanguage('str', 'status'));
    $rowBlock->assign('STR_ACTION', core::getLanguage('str', 'action'));
    $rowBlock->assign('SEARCH', $search);

    $rowBlock->assign('GET_ID', $_GET['id']);
    $rowBlock->assign('GET_NAME', $_GET['name']);
    $rowBlock->assign('GET_EMAIL', $_GET['email']);
    $rowBlock->assign('GET_CATEGORY', $_GET['category']);
    $rowBlock->assign('GET_URL', $_GET['url']);
    $rowBlock->assign('GET_VIEWS', $_GET['views']);
    $rowBlock->assign('GET_CREATED', $_GET['created']);
    $rowBlock->assign('GET_CREATED', $_GET['created']);

    $number = $data->getTotal();
    $page = $data->getPageNumber();

    if (empty($search)){
        if ($page != 1) {
            $pervpage = '<a href="./?a=admin&t=links&page=1' . $sort . '">&lt;&lt;</a>';
            $perv = '<a href="./?a=admin&t=links&page=' . ($page - 1) . '' . $sort . '">&lt;</a>';
        }

        if ($page != $number) {
            $nextpage = '<a href="./?a=admin&t=links&page=' . ($page + 1) . '' . $sort . '">&gt;</a>';
            $next = '<a href="./?a=admin&t=links&page=' . $number . '' . $sort . '">&gt;&gt;</a>';
        }

        if ($page - 2 > 0) $page2left = '<a href="./?a=admin&t=links&page=' . ($page - 2) .'' . $sort . '">...'.($page - 2) . '</a>';
        if ($page - 1 > 0) $page1left = '<a href="./?a=admin&t=links&page=' . ($page - 1) . '' . $sort . '">'.($page - 1) . '</a>';
        if ($page + 2 <= $number) $page2right = '<a href="./?a=admin&t=links&page=' . ($page + 2) . '' . $sort . '">' . ($page + 2) . '...</a>';
        if ($page + 1 <= $number) $page1right = '<a href="./?a=admin&t=links&page=' . ($page + 1) . '' . $sort . '">' . ($page + 1) . '</a>';
    } else {
        if ($page != 1) {
            $pervpage = '<a href="./?a=admin&t=links&search=' . urlencode($search) . '&page=1' . $sort . '">&lt;&lt;</a>';
            $perv = '<a href="./?a=admin&t=links&search=' . urlencode($search) . '&page=' . ($page - 1) . '' . $sort . '">&lt;</a>';
        }

        if ($page != $number) {
            $nextpage = '<a href="./?a=admin&t=links&search=' . urlencode($search).'&page=' . ($page + 1) . '' . $sort . '">&gt;</a>';
            $next = '<a href="./?a=admin&t=links&search=' . urlencode($search) . '&page=' . $number . '' . $sort . '">&gt;&gt;</a>';
        }

        if ($page - 2 > 0) $page2left = '<a href="./?a=admin&t=links&search=' . urlencode($search) . '&page=' . ($page - 2) . '' . $sort . '">...' . ($page - 2) . '</a>';
        if ($page - 1 > 0) $page1left = '<a href="./?a=admin&t=links&search=' . urlencode($search) . '&page=' . ($page - 1) . '' . $sort . '">' . ($page - 1).'</a>';
        if ($page + 2 <= $number) $page2right = '<a href="./?a=admin&t=links&search=' . urlencode($search) . '&page=' . ($page + 2) . '' . $sort . '">' . ($page + 2) . '...</a>';
        if ($page + 1 <= $number) $page1right = '<a href="./?a=admin&t=links&search=' . urlencode($search) . '&page=' . ($page + 1) . '' . $sort . '">' . ($page + 1) . '</a>';
    }

    if ($page > 1)
        $pagenav = "&page=" . $page . "";
    else
        $pagenav = '';

    $rowBlock->assign('PAGENAV', $pagenav);

    foreach ($arrs as $row) {
        $columnBlock = $rowBlock->fetch('column');
        $columnBlock->assign('ID', $row['id']);
        $columnBlock->assign('NAME', $row['name']);
        $columnBlock->assign('DESCRIPTION', $row['description']);
        $columnBlock->assign('EMAIL', $row['email']);
        $columnBlock->assign('STATUS', str_replace($row['status'], core::getLanguage('status', $row['status']), $row['status']));
        $columnBlock->assign('URL', $row['url']);
        $columnBlock->assign('CATEGORY', $row['category']);
        $columnBlock->assign('VIEWS', $row['views']);

        $columnBlock->assign('CREATED', $row['created']);
        $columnBlock->assign('STR_EDIT', core::getLanguage('str', 'edit'));
        $columnBlock->assign('STR_REMOVE', core::getLanguage('str', 'remove'));
        $rowBlock->assign('column', $columnBlock);
    }

    $rowBlock->assign('STR_PNUMBER',  core::getLanguage('str', 'pnumber'));
    $rowBlock->assign('PNUMBER', isset($pnumber) ? $pnumber : '');

    if ($number > 1) {
        $paginationBlock = $rowBlock->fetch('pagination');

        $paginationBlock->assign('CURRENT_PAGE', '<a>' . $page . '</a>');
        $paginationBlock->assign('STR_PAGES', core::getLanguage('str', 'pages'));

        $paginationBlock->assign('PAGE1RIGHT', isset($page1right) ? $page1right : '');
        $paginationBlock->assign('PAGE2RIGHT', isset( $page2right) ?  $page2right : '');

        $paginationBlock->assign('PAGE1LEFT', isset($page1left) ? $page1left : '');
        $paginationBlock->assign('PAGE2LEFT', isset($page2left) ? $page2left : '');

        $paginationBlock->assign('PERVPAGE', isset($pervpage) ? $pervpage : '');
        $paginationBlock->assign('NEXTPAGE', isset($nextpage) ? $nextpage : '');

        $paginationBlock->assign('PERV', isset($perv) ? $perv : '');
        $paginationBlock->assign('NEXT', isset($next) ? $next : '');

        if ($search) $paginationBlock->assign('SEARCH', urlencode($search));

        $rowBlock->assign('pagination', $paginationBlock);
    }

    $rowBlock->assign('STR_CHECK', core::getLanguage('str', 'check'));
    $rowBlock->assign('STR_SHOW', core::getLanguage('str', 'show'));
    $rowBlock->assign('STR_BLACK', core::getLanguage('str', 'black'));
    $rowBlock->assign('STR_REMOVE', core::getLanguage('str', 'remove'));
    $rowBlock->assign('STR_APPLY', core::getLanguage('str', 'apply'));

    $tpl->assign('row', $rowBlock);

} else {
    if (!empty($search)) {
        $notfoundBlock = $tpl->fetch('notfound');
        $notfoundBlock->assign('MSG_NOTFOUND',   core::getLanguage('msg', 'notfound'));
        $tpl->assign('notfound', $notfoundBlock);
    } else {
        $tpl->assign('EMPTY_LIST', core::getLanguage('str', 'empty'));
    }
}

$tpl->assign('STR_IMPORT_LINKS', core::getLanguage('str', 'import_links'));
$tpl->assign('STR_EXPORT_LINKS', core::getLanguage('str', 'export_links'));

if ($search) {
    $tpl->assign('SEARCH', urlencode($search));
    $tpl->assign('FORM_SEARCH', $search);
}

// menu
include_once core::pathTo('extra', 'admin/menu.php');

//footer
include_once core::pathTo('extra', 'admin/footer.php');

//display content
$tpl->display();