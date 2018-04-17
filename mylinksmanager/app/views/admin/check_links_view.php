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
$tpl = SeparateTemplate::instance()->loadSourceFromFile(core::getTemplate() . "admin/check_links.tpl");

$tpl->assign('TITLEPAGE', core::getLanguage('title', 'admin_page_check_links'));
$tpl->assign('TITLE', core::getLanguage('title', 'admin_check_links'));
$tpl->assign('HELP', core::getLanguage('info', 'admin_check_links'));

include_once core::pathTo('extra', 'top.php');

//menu
include_once core::pathTo('extra', 'menu.php');


if (Core_Array::getRequest('action') == '') {
    $blockLinksList = $tpl->fetch('LINKS_LIST');
    $blockLinksList->assign('ACTION', $_SERVER['PHP_SELF']);
    $blockLinksList->assign('BUTTON_CHECK_ALL_LINKS_AUTOMATICALLY', BUTTON_CHECK_ALL_LINKS_AUTOMATICALLY);

    $id = Core_Array::getRequest('id') ? $_GET['id'] : 0;

    $arraycat = $data->getArraycat($id);

    $total = count($arraycat);
    $number = (int)($total / core::getSetting('columns_number'));

    if ((float)($total / core::getSetting('columns_number')) - $number != 0) $number++;

    $rowPrintCat = $blockLinksList->fetch('PRINT_CAT');

    // Form an array
    for ($i = 0; $i < $number; $i++) {
        for ($j = 0; $j < $settings['columns_number']; $j++) {
            $arr[$i][$j] = $arraycat[$j * $number + $i];
        }
    }

    for ($i = 0; $i < $number; $i++) {
        $rowBlockCat = $rowPrintCat->fetch('ROW_CAT');

        for ($j = 0; $j < core::getSetting('columns_number'); $j++) {

            $rowBlockFolder = $rowBlockCat->fetch('ROW_FOLDER');

            if ($arr[$i][$j][0]) {
                $rowBlockFolder->assign('FOLDER_LINK', "http://" . $_SERVER['SERVER_NAME'] . $_SERVER['PHP_SELF'] . "?id=" . $arr[$i][$j][1]);

                $columns_number = (int)(100 / core::getSetting('columns_number'));
                $rowBlockFolder->assign('COLUMNS_NUMBER', $columns_number);
                $rowBlockFolder->assign('FOLDER_LINK_NAME', $arr[$i][$j][0]);
                $rowBlockFolder->assign('NUMBERSLINKS', Links::ShowNumbersLinks($arr[$i][$j][1], 0));
                $rowBlockFolder->assign('SHOWSUBCAT', Links::ShowSubCat($arr[$i][$j][1], 0));
            }

            $rowBlockCat->assign('ROW_FOLDER', $rowBlockFolder);
        }

        $rowPrintCat->assign('ROW_CAT', $rowBlockCat);
    }

    $blockLinksList->assign('PRINT_CAT', $rowPrintCat);

    if (Core_Array::getRequest('id')) {
        $arraypathway = [];
        $arraypathway = Links::topbarmenu(Core_Array::getGet('id'), '');
        $pathway = '<a href="./?a=admin&check_links">    ' . core::getLanguage('str', 'home') . '</a> ';

        for ($i = 0; $i < count($arraypathway); $i++) {
            $pathway .= '» <a href="http://' . $_SERVER['SERVER_NAME'] . $_SERVER['PHP_SELF'] . '?id_cat=' . $arraypathway[$i][0] . '">' . $arraypathway[$i][1] . '</a>';
        }

        $blockLinksList->assign('TOPBARMENU', $pathway);
    }

    if (Core_Array::getGet('id')) {

        $catname = $data->getCatalogById(Core_Array::getGet('id'));



        $blockLinksList->assign('ID', Core_Array::getGet('id'));
        $blockLinksList->assign('CATEGORY_NAME', $catname['name']);
        $blockLinksList->assign('RETURN_URL', './?a=admin&check_links');
        $blockLinksList->assign('STR_LINKS_WAITING_CHECKS', STR_LINKS_WAITING_CHECKS);


        $arr = $data->getLinksByCatId(Core_Array::getGet('cat_id'), Core_Array::getRequest('page'), $pnumber);

        if ($arr) {
            $number = $data->getTotal();
            $page = $data->getPageNumber();
        }



        if (!$result) {
            throw new ExceptionMySQL($dbh->error, $query, "Error executing SQL query!");
        }

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_array()) {
                $date_check = strtotime($row['time_check']);
                $interval_check = ceil((time() - $date_check) / 3600 / 24);

                if (!empty($row['htmlcode_banner']))
                    $htmlcode_banner = $row['htmlcode_banner'];
                else
                    $htmlcode_banner = '<a href="http://' . $row['url'] . '" target=_blank><img border="0" width="88" height="31" src="./images/noimage.gif"></a>';

                $rowBlock = $blockLinksList->fetch('ROW_LINKS');
                $rowBlock->assign('HTMLCODE_BANNER', $htmlcode_banner);
                $rowBlock->assign('URL', $row['url']);
                $rowBlock->assign('NAME', $row['name']);
                $rowBlock->assign('DESCRIPTION', $row['description']);
                $rowBlock->assign('STR_ADDED', STR_ADDED);
                $rowBlock->assign('TIME', $row['time']);
                $rowBlock->assign('ID_LINK', $row['id_link']);
                $rowBlock->assign('STR_NUMBER_OF_CLICKS', STR_NUMBER_OF_CLICKS);
                $rowBlock->assign('COUNT', $row['count']);

                $rowBlock->assign('SHOW_PR', $settings['show_pr']);
                $rowBlock->assign('SHOW_CY', $settings['show_cy']);

                if ($row['check_link'] == "yes" OR !empty($row['reciprocal_link'])) {

                    $BUTTON1 = $rowBlock->fetch('BUTTON1');
                    $BUTTON1->assign('ACTION1', $_SERVER['PHP_SELF']);
                    $BUTTON1->assign('STR_BUTTON1', BUTTON_HANDCHECK);
                    $BUTTON1->assign('ID_LINK1', $row['id_link']);
                    $rowBlock->assign('BUTTON1', $BUTTON1);
                }

                if (!empty($row['reciprocal_link'])) {
                    $BUTTON2 = $rowBlock->fetch('BUTTON2');
                    $BUTTON2->assign('ACTION2', $_SERVER['PHP_SELF']);
                    $BUTTON2->assign('ID_LINK2', $row['id_link']);
                    $BUTTON2->assign('STR_BUTTON2', BUTTON_AUTOCHECK);
                    $BUTTON2->assign('INTERVAL_CHECK', $interval_check);
                    $rowBlock->assign('BUTTON2', $BUTTON2);
                }

                $blockLinksList->assign('ROW_LINKS', $rowBlock);
            }

        } else $blockLinksList->assign('MSG_NOTLINKS', MSG_NOTLINKS);

        // Count a quantity of the links
        $query = "SELECT COUNT(*) FROM " . DB_LINKS . " WHERE id_cat = " . $_GET['id_cat'] . " AND status = 'show'";
        $result = $dbh->query($query);

        if (!$result) throw new ExceptionMySQL($dbh->error, $query, "Error executing SQL query!");

        $total = $result->fetch_assoc();

        // Clear the descriptor
        $result->close();

        $number = intval(($total['COUNT(*)'] - 1) / $all_number_links) + 1;

        if ($page != 1) {
            $pervpage = '<a href="' . $_SERVER['PHP_SELF'] . '?page=1' . ($_GET['id_cat'] ? '&id_cat=' . $_GET['id_cat'] . '' : '') . '">&lt;&lt;</a>';
            $perv = '<a href="' . $_SERVER['PHP_SELF'] . '?page=' . ($page - 1) . '' . ($_GET['id_cat'] ? '&id_cat=' . $_GET['id_cat'] . '' : '') . '">&lt;</a>';
        }

        if ($page != $number) {
            $nextpage = '<a href="' . $_SERVER['PHP_SELF'] . '?page=' . ($page + 1) . '' . ($_GET['id_cat'] ? '&id_cat=' . $_GET['id_cat'] . '' : '') . '">&gt;</a>';
            $next = '<a href="' . $_SERVER['PHP_SELF'] . '?page=' . $number . '' . ($_GET['id_cat'] ? '&id_cat=' . $_GET['id_cat'] . '' : '') . '">&gt;&gt;</a>';
        }

        if ($page - 2 > 0) $page2left = '<a href="' . $_SERVER['PHP_SELF'] . '?page=' . ($page - 2) . '' . ($_GET['id_cat'] ? '&id_cat=' . $_GET['id_cat'] . '' : '') . '">...' . ($page - 2) . '</a>';
        if ($page - 1 > 0) $page1left = '<a href="' . $_SERVER['PHP_SELF'] . '?page=' . ($page - 1) . '' . ($_GET['id_cat'] ? '&id_cat=' . $_GET['id_cat'] . '' : '') . '">' . ($page - 1) . '</a>';
        if ($page + 2 <= $number) $page2right = '<a href="' . $_SERVER['PHP_SELF'] . '?page=' . ($page + 2) . '' . ($_GET['id_cat'] ? '&id_cat=' . $_GET['id_cat'] . '' : '') . '">' . ($page + 2) . '...</a>';
        if ($page + 1 <= $number) $page1right = '<a href="' . $_SERVER['PHP_SELF'] . '?page=' . ($page + 1) . '' . ($_GET['id_cat'] ? '&id_cat=' . $_GET['id_cat'] . '' : '') . '">' . ($page + 1) . '</a>';

        if ($number > 1) {
            $paginationBlock = $blockLinksList->fetch('pagination');
            $paginationBlock->assign('CURRENT_PAGE', '<a>' . $page . '</a>');
            $paginationBlock->assign('STR_PAGES', STR_PAGES);
            $paginationBlock->assign('PAGE1RIGHT', $page1right);
            $paginationBlock->assign('PAGE2RIGHT', $page2right);

            $paginationBlock->assign('PAGE1LEFT', $page1left);
            $paginationBlock->assign('PAGE2LEFT', $page2left);

            $paginationBlock->assign('PERVPAGE', $pervpage);
            $paginationBlock->assign('NEXTPAGE', $nextpage);

            $paginationBlock->assign('PERV', $perv);
            $paginationBlock->assign('NEXT', $next);

            $blockLinksList->assign('pagination', $paginationBlock);
        }
    } else {
        $blockLinksList->assign('STR_LINKS_FOR_CHECK', STR_LINKS_FOR_CHECK);

        $query = "SELECT * FROM " . DB_LINKS . " WHERE status = 'hide' ORDER BY time DESC";
        $result = $dbh->query($query);

        if (!$result) {
            throw new ExceptionMySQL($dbh->error, $query, "Error executing SQL query!");
        }

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_array()) {
                if (!empty($row['htmlcode_banner']))
                    $htmlcode_banner = $row['htmlcode_banner'];
                else
                    $htmlcode_banner = '<a href="http://' . $row['url'] . '" target=_blank><img border="0" width="88" height="31" src="./images/noimage.gif"></a>';

                $date_check = strtotime($row['time_check']);
                $interval_check = ceil((time() - $date_check) / 3600 / 24);

                $rowBlock = $blockLinksList->fetch('ROW_LINKS');
                $rowBlock->assign('MSG_ALERT_WAS_CHECKED', MSG_ALERT_WAS_CHECKED);

                $rowBlock->assign('HTMLCODE_BANNER', $htmlcode_banner);
                $rowBlock->assign('URL', $row['url']);
                $rowBlock->assign('NAME', $row['name']);
                $rowBlock->assign('DESCRIPTION', $row['description']);
                $rowBlock->assign('STR_ADDED', STR_ADDED);
                $rowBlock->assign('TIME', $row['time']);
                $rowBlock->assign('ID_LINK', $row['id_link']);
                $rowBlock->assign('STR_NUMBER_OF_CLICKS', STR_NUMBER_OF_CLICKS);
                $rowBlock->assign('COUNT', $row['count']);
                $rowBlock->assign('SHOW_PR', $settings['show_pr']);
                $rowBlock->assign('SHOW_CY', $settings['show_cy']);

                if ($row['check_link'] == "yes" OR !empty($row['reciprocal_link'])) {
                    $BUTTON1 = $rowBlock->fetch('BUTTON1');
                    $BUTTON1->assign('ACTION1', $_SERVER['PHP_SELF']);
                    $BUTTON1->assign('STR_BUTTON1', BUTTON_HANDCHECK);
                    $BUTTON1->assign('ID_LINK1', $row['id_link']);
                    $rowBlock->assign('BUTTON1', $BUTTON1);
                }

                if (!empty($row['reciprocal_link'])) {
                    $BUTTON2 = $rowBlock->fetch('BUTTON2');
                    $BUTTON2->assign('ACTION2', $_SERVER['PHP_SELF']);
                    $BUTTON2->assign('ID_LINK2', $row['id_link']);
                    $BUTTON2->assign('MSG_ALERT_WAS_CHECKED', MSG_ALERT_WAS_CHECKED);

                    if ($interval_check == 1) $BUTTON2->assign('ALERT', 'show');

                    $BUTTON2->assign('STR_BUTTON2', BUTTON_AUTOCHECK);
                    $BUTTON2->assign('INTERVAL_CHECK', $interval_check);
                    $rowBlock->assign('BUTTON2', $BUTTON2);
                }

                $blockLinksList->assign('ROW_LINKS', $rowBlock);
            }

        } else $blockLinksList->assign('MSG_NOTLINKS', MSG_NOTLINKS);

        $result->close();
    }

    // Count a quantity of the links
    $query = "SELECT COUNT(*) FROM " . DB_LINKS . " WHERE status = 'hide'";
    $result = $dbh->query($query);

    if (!$result) throw new ExceptionMySQL($dbh->error, $query, "Error executing SQL query!");

    $total = $result->fetch_assoc();

    // Clear the descriptor
    $result->close();

    $number = intval(($total['COUNT(*)'] - 1) / $all_number_links) + 1;

    if ($page != 1) {
        $pervpage = '<a href="' . $_SERVER['PHP_SELF'] . '?page=1">&lt;&lt;</a>';
        $perv = '<a href="' . $_SERVER['PHP_SELF'] . '?page=' . ($page - 1) . '">&lt;</a>';
    }

    if ($page != $number) {
        $nextpage = '<a href="' . $_SERVER['PHP_SELF'] . '?page=' . ($page + 1) . '">&gt;</a>';
        $next = '<a href="' . $_SERVER['PHP_SELF'] . '?page=' . $number . '">&gt;&gt;</a>';
    }

    if ($page - 2 > 0) $page2left = '<a href="' . $_SERVER['PHP_SELF'] . '?page=' . ($page - 2) . '">...' . ($page - 2) . '</a>';
    if ($page - 1 > 0) $page1left = '<a href="' . $_SERVER['PHP_SELF'] . '?page=' . ($page - 1) . '">' . ($page - 1) . '</a>';
    if ($page + 2 <= $number) $page2right = '<a href="' . $_SERVER['PHP_SELF'] . '?page=' . ($page + 2) . '">' . ($page + 2) . '...</a>';
    if ($page + 1 <= $number) $page1right = '<a href="' . $_SERVER['PHP_SELF'] . '?page=' . ($page + 1) . '">' . ($page + 1) . '</a>';

    if ($number > 1) {
        $paginationBlock = $blockLinksList->fetch('pagination');
        $paginationBlock->assign('CURRENT_PAGE', '<a>' . $page . '</a>');
        $paginationBlock->assign('STR_PAGES', STR_PAGES);
        $paginationBlock->assign('PAGE1RIGHT', $page1right);
        $paginationBlock->assign('PAGE2RIGHT', $page2right);

        $paginationBlock->assign('PAGE1LEFT', $page1left);
        $paginationBlock->assign('PAGE2LEFT', $page2left);

        $paginationBlock->assign('PERVPAGE', $pervpage);
        $paginationBlock->assign('NEXTPAGE', $nextpage);

        $paginationBlock->assign('PERV', $perv);
        $paginationBlock->assign('NEXT', $next);

        $blockLinksList->assign('pagination', $paginationBlock);
    }

    $tpl->assign('LINKS_LIST', $blockLinksList);
}

//footer
include_once core::pathTo('extra', 'footer.php');

//display content
$tpl->display();