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
$tpl = SeparateTemplate::instance()->loadSourceFromFile(core::getTemplate() . "admin/import.tpl");

$errors = [];

if (Core_Array::getRequest('action')) {
    if ($_FILES['file']['tmp_name']) {
        $ext = pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);

        if ($ext == 'xls' || $ext == 'xlsx') {
            $result = $data->importFromExcel();
        }

        if (!$result) $errors[] = core::getLanguage('error', 'no_import');

    } else $errors[] = core::getLanguage('error', 'no_import_file');
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

if (isset($result)){
    $tpl->assign('MSG_ALERT', str_replace('%COUNT%', $result, core::getLanguage('msg', 'imported_links')));
}

include_once core::pathTo('extra', 'admin/top.php');

//menu
include_once core::pathTo('extra', 'admin/menu.php');

//form
$tpl->assign('BUTTON_ADD',  core::getLanguage('button', 'add'));
$tpl->assign('ACTION', $_SERVER['REQUEST_URI']);
$tpl->assign('STR_DATABASE_FILE',  core::getLanguage('str', 'database_file'));

//footer
include_once core::pathTo('extra', 'admin/footer.php');

//display content
$tpl->display();