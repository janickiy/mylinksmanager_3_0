<?php

/********************************************
 * My Links Manager 3.0.0 alfa
 * Copyright (c) 2011-2018 Alexander Yanitsky
 * Website: http://janicky.com
 * E-mail: janickiy@mail.ru
 * Skype: janickiy
 ********************************************/

defined('MYLINKSMANAGER') || exit('My Links Manager: access denied!');

//include template
core::requireEx('libs', "html_template/SeparateTemplate.php");
$tpl = SeparateTemplate::instance()->loadSourceFromFile(core::getTemplate() . core::getSetting('controller') . ".tpl");

$tpl->assign('TITLE_PAGE', core::getLanguage('title', 'page_index'));
$tpl->assign('TITLE', core::getLanguage('title', 'title'));


//searchform
$tpl->assign('STR_KEYWORDS_SEARCHFORM', core::getLanguage('str', 'keywords_searchform'));
$tpl->assign('STR_KEYWORDS', core::getLanguage('str', 'keywords'));
$tpl->assign('STR_SEARCH_IN_CATALOG_SEARCHFORM', core::getLanguage('str', 'search_in_catalog_searchform'));
$tpl->assign('STR_IT_DOESNT_MATTER_SEARCHFORM', core::getLanguage('str', 'it_doesnt_matter_searchform'));
$tpl->assign('STR_AT_LEAST_ONCE', core::getLanguage('str', 'at_least_once'));
$tpl->assign('STR_MEETING_OF_KEYWORDS_SEARCHFORM', core::getLanguage('str', 'meeting_of_keywords_searchform'));
$tpl->assign('STR_ALL_WORDS_TOGETHER', core::getLanguage('str', 'all_words_together'));
$tpl->assign('BUTTON_FIND', core::getLanguage('button', 'find'));


$tpl->assign('ACTION', $_SERVER['REQUEST_URI']);
$tpl->assign('SEARCH', urldecode($_GET['search']));
$tpl->assign('ID_CATALOG', $_GET['id_catalog']);
$tpl->assign('LOGIC', $_GET['logic']);
$tpl->assign('OPTION', Links::ShowCatalogList(0, 0));

$id = $_GET['id'] ? $_GET['id'] : 0;

$arraycat = $data->getCatalogList($id);

$total = count($arraycat);

$number = (int)($total / core::getSetting('columns_number'));

if ((float)($total / core::getSetting('columns_number')) - $number != 0) $number++;

// Form an array
for($i = 0; $i < $number; $i++){
    for($j = 0; $j < core::getSetting('columns_number'); $j++){
        $arr[$i][$j] = $arraycat[$j * $number + $i];
    }
}

$rowPrintCat = $tpl->fetch('PRINT_CAT');

for($i = 0; $i < $number; $i++){

    $rowBlockCat = $rowPrintCat->fetch('ROW_CAT');

    for($j = 0; $j < core::getSetting('columns_number'); $j++){

        $rowBlockFolder = $rowBlockCat->fetch('ROW_FOLDER');

        if ($arr[$i][$j][0]){
                $rowBlockFolder->assign('FOLDER_LINK', "http://" . $_SERVER['SERVER_NAME'] . $_SERVER['PHP_SELF']."?id=".$arr[$i][$j][1]);

            $query = "SELECT * FROM ".DB_CATALOG." WHERE image != '' and id_cat = ".$arr[$i][$j][1];
            $result = $dbh->query($query);

            if(!$result) { throw new ExceptionMySQL($dbh->error, $query, "Error executing SQL query!"); }

            if($result->num_rows > 0)
                $rowBlockFolder->assign('IMAGEFOLDER', "img.php?id_cat=".$arr[$i][$j][1]);
            else
                $rowBlockFolder->assign('IMAGEFOLDER', 'images/folder.gif');

            $columns_number = (int)(100 / $settings['columns_number']);
            $rowBlockFolder->assign('COLUMNS_NUMBER', $columns_number);
            $rowBlockFolder->assign('FOLDER_LINK_NAME', $arr[$i][$j][0]);
            $rowBlockFolder->assign('NUMBERSLINKS', ShowNumbersLinks($arr[$i][$j][1],0));
            $rowBlockFolder->assign('SHOWSUBCAT', ShowSubCat($arr[$i][$j][1],$settings['static'],5));

            $rowBlockCat->assign('ROW_FOLDER', $rowBlockFolder);

            $result->close();
        }
    }

    $rowPrintCat->assign('ROW_CAT', $rowBlockCat);
}

$tpl->assign('PRINT_CAT', $rowPrintCat);

var_dump($arr);



// display content
$tpl->display();