<?php

/********************************************
 * My Links Manager 3.0.0 alfa
 * Copyright (c) 2011-2018 Alexander Yanitsky
 * Website: http://janicky.com
 * E-mail: janickiy@mail.ru
 * Skype: janickiy
 ********************************************/

defined('MYLINKSMANAGER') || exit('My Links Manager: access denied!');




if ($_GET['id']){
    $arraypathway = [];
    $arraypathway = Category::topbarMenu($_GET['id'],'');

    $pathway = '<a href="index.php">' . core::getLanguage('str', 'home'). '</a> ';

    for($i = 0; $i < count($arraypathway); $i++)
    {
        if ($arraypathway[$i][0] == $_GET['id']) {
            $pathway .= '» ' . $arraypathway[$i][1];
        } else {
            $pathway .= '» <a href="http://' . $_SERVER['SERVER_NAME'] . $_SERVER['PHP_SELF'] . '?id=' . $arraypathway[$i][0] . '">' . $arraypathway[$i][1] . '</a>';
        }
    }
}

if (!empty($_GET['link_id'])){

    // include template
    core::requireEx('libs', "html_template/SeparateTemplate.php");

    $tpl = SeparateTemplate::instance()->loadSourceFromFile(core::getTemplate() . "info.tpl");

    $link = Links::getLinkInfo($_GET['link_id']);

    if (!$link) {
        throw new Exception404("Not found");
    }

    $description = $link['description'];
    $keywords = $link['keywords'];
    $title = $link['name'];

    //header
    $tpl->assign('METATITLE', $title);
    $tpl->assign('METADESCRIPTION', $description);
    $tpl->assign('METAKEYWORDS', $keywords);
    $tpl->assign('VERSION', $version);

    $link_go_back = "http://" . $_SERVER['SERVER_NAME'] . $_SERVER['PHP_SELF']."?id=" . $link['id'];

    $url_to_site = "" . $_SERVER['PHP_SELF']."link_id=" . $link['id']."&url=" . $link['url']."";
    $link['full_description'] = preg_replace("/\\r\\n/s","<br />", $link['full_description']);

    $tpl->assign('CATNAME', $link['catname']);
    $tpl->assign('URL_TO_SITE', $url_to_site);
    $tpl->assign('GO_BACK', $link_go_back);

    $tpl->assign('URL', $link['url']);
    $tpl->assign('NAME', $link['name']);
    $tpl->assign('FULL_DESCRIPTION', $link['full_description']);

    $tpl->assign('STR_GO_TO_WEBSITE', core::getLanguage('str', 'go_to_website'));
    $tpl->assign('STR_GO_BACK', core::getLanguage('str','go_back'));

    /*
    $query = "SELECT COUNT(*) FROM ".DB_LINKS." WHERE status = 'show'";
    $result = $dbh->query($query);

    if(!$result) throw new ExceptionMySQL($dbh->error,$query,"Error executing SQL query!");

    $total = $result->fetch_assoc();



    if($total['COUNT(*)'] > 3){
        $tpl->assign('INT', 'show');
    }

    if ($_GET['url']){
        // If there is a URL then count one click
        $update = "UPDATE ".DB_LINKS." SET count = count + 1 WHERE id_link = ".$_GET['id_link'];

        if ($dbh->query($update)){
            // Make a redirect
            $tpl->assign('REDIRECT_URL', $links['url']);
        }
    }
    */

    $tpl->assign('STR_LOGO', STR_LOGO);
    $tpl->assign('STR_AUTHOR', STR_AUTHOR);



} else {

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

                if ($arr[$i][$j][2] != '') {
                    $rowBlockFolder->assign('IMAGEFOLDER', './?t=pic&id=' . $arr[$i][$j][1]);
                } else {
                    $rowBlockFolder->assign('IMAGEFOLDER', './templates/assets/images/folder.gif');
                }

                $columns_number = (int)(100 / $settings['columns_number']);
                $rowBlockFolder->assign('COLUMNS_NUMBER', $columns_number);
                $rowBlockFolder->assign('FOLDER_LINK_NAME', $arr[$i][$j][0]);
                $rowBlockFolder->assign('NUMBERSLINKS', $arr[$i][$j][3]);
                $rowBlockCat->assign('ROW_FOLDER', $rowBlockFolder);
            }
        }

        $rowPrintCat->assign('ROW_CAT', $rowBlockCat);
    }

    $tpl->assign('PRINT_CAT', $rowPrintCat);
    $tpl->assign('TOPBARMENU', $pathway);
    $tpl->assign('SUBCATALOG',  core::getLanguage('str', 'new_links'));


    $tpl->assign('STR_ADD_URL', core::getLanguage('str','add_url'));


    $links = $data->getLastAddedLinks(5);

    foreach ($links as $link) {
        if ($_GET['page'])
            $read_more = "http://" . $_SERVER['SERVER_NAME'] . $_SERVER['PHP_SELF'] . "?link_id=" . $link['id'] . "&page=" . $_GET['page'];
        else
            $read_more = "http://" . $_SERVER['SERVER_NAME'] . $_SERVER['PHP_SELF'] . "?link_id=" . $link['id'];

        if (!empty($link['htmlcode_banner']))
            $htmlcode_banner = $link['htmlcode_banner'];
        else
            $htmlcode_banner = '<a href=http://' . $link['url'] . ' target=_blank><img border="0" width="88" height="31" src="./templates/assets/images/noimage.gif"></a>';

        $link['description'] = nl2br($link['description']);

        $rowBlock = $tpl->fetch('ROW_LINKS');

        $rowBlock->assign('STR_ADDED', core::getLanguage('str', 'added'));
        $rowBlock->assign('STR_CATEGORY', core::getLanguage('str','category'));
        $rowBlock->assign('STR_NUMBER_OF_CLICKS', core::getLanguage('str', 'number_of_clicks'));
        $rowBlock->assign('STR_READ_MORE', core::getLanguage('str', 'read_more'));

        $rowBlock->assign('URL', $link['url']);
        $rowBlock->assign('NAME', $link['name']);
        $rowBlock->assign('DESCRIPTION', $link['description']);
        $rowBlock->assign('READ_MORE', $read_more);
        $rowBlock->assign('HTMLCODE_BANNER', $htmlcode_banner);
        $rowBlock->assign('TIME', $link['created']);
        $rowBlock->assign('CATEGORY', $link['catname']);
        $rowBlock->assign('NUMBER_OF_CLICKS', $link['views']);

        $tpl->assign('ROW_LINKS', $rowBlock);
    }
}




// display content
$tpl->display();