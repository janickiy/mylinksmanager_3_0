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

if (Core_Array::getRequest('action')) {
    $ext = 'xls';
    $filename = 'export' . date("d_m_Y") . '.xls';

    core::requireEx('libs', "PHPExcel/PHPExcel.php");

    $arr = $data->getLinks();

    $pExcel = core::factory('PHPExcel');
    $pExcel->setActiveSheetIndex(0);
    $aSheet = $pExcel->getActiveSheet();
    $aSheet->setTitle(core::getLanguage('str', 'links_db'));

    $i = 0;

    foreach ($arr as $row) {
        $i++;
        $category = Category::getCategoryById($row['cat_id']);
        $arraypathway = Category::topbarMenu($category['parent_id'], '');
        $category_name = [];
        $category_name[] = $category['name'];

        for ($n = 0; $n < count($arraypathway); $n++) {
            $category_name[] = $arraypathway[$n][1];
        }
        $aSheet->setCellValue('A' . $i, $row['name']);
        $aSheet->setCellValue('B' . $i, $row['url']);
        $aSheet->setCellValue('C' . $i, $row['reciprocal_link']);
        $aSheet->setCellValue('D' . $i, $row['email']);
        $aSheet->setCellValue('E' . $i, $row['keyword']);
        $aSheet->setCellValue('F' . $i, $row['description']);
        $aSheet->setCellValue('G' . $i, $row['full_description']);

        $aSheet->setCellValue('I' . $i, implode("/", $category_name));
    }

    $aSheet->getColumnDimension('F')->setWidth(30);
    $aSheet->getColumnDimension('G')->setWidth(30);
    $aSheet->getColumnDimension('H')->setWidth(30);
    $aSheet->getColumnDimension('I')->setWidth(30);

    core::requireEx('libs', "PHPExcel/PHPExcel/Writer/Excel5.php");

    $objWriter = new PHPExcel_Writer_Excel5($pExcel);

    ob_start();
    $objWriter->save('php://output');
    $contents = ob_get_contents();
    ob_end_clean();

    header('Content-Type: ' . Helper::get_mime_type($ext));
    header('Content-Disposition: attachment; filename=' . $filename);
    header('Cache-Control: max-age=0');
    echo $contents;
    exit;
}

//include template
core::requireEx('libs', "html_template/SeparateTemplate.php");
$tpl = SeparateTemplate::instance()->loadSourceFromFile(core::getTemplate() . "admin/export.tpl");

include_once core::pathTo('extra', 'admin/top.php');

//menu
include_once core::pathTo('extra', 'admin/menu.php');

//form
$tpl->assign('ACTION', $_SERVER['REQUEST_URI']);
$tpl->assign('BUTTON_APPLY', core::getLanguage('button', 'export'));

//footer
include_once core::pathTo('extra', 'admin/footer.php');

//display content
$tpl->display();