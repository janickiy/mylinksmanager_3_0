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

include_once core::pathTo('extra', 'admin/top.php');

//menu
include_once core::pathTo('extra', 'admin/menu.php');

$errors = [];

if (Core_Array::getRequest('action') != '') {
    switch ($_POST['event']) {
        // Add link
        case 'add':
            $fields = ['status' => 'show'];
            $result = $data->updateStatus($fields, Core_Array::getPost('id'));

            if ($result) {
                $links = $data->getLinkInfo(Core_Array::getPost('id'));

                // Notify the user about his link was added
                Helper::sendMailAdd($links, core::getLanguage('str', 'subject_add'));

                $success = core::getLanguage('msg', 'link_added');
                $_POST['action'] = '';
            } else {
                $errors[] = core::getLanguage('error', 'web_apps_error');
            }

            break;

        // Remove link
        case 'delete':

            $result = $data->removeLink(Core_Array::getPost('id'));

            if ($result) {
                $success = core::getLanguage('msg', 'link_removed');
                $_POST['action'] = '';
            } else {
                $errors[] = core::getLanguage('error', 'web_apps_error');
            }

            break;

        // Add link to black list
        case 'black':

            $fields = [
                'status' => 'black',
                'time' => date("Y-m-d H:i:s"),
                'reason' => core::getLanguage('msg', 'reason_admin'),
            ];

            $result = $data->updateStatus($fields, Core_Array::getPost('id'));

            if ($result) {
                $success = core::getLanguage('msg', 'link_added_to_blacklist');
                $_POST['action'] = '';
            } else {
                $errors[] = core::getLanguage('error', 'web_apps_error');
            }

            break;

        case 'check_hand':

            $tpl->assign('TITLEPAGE', TITLEADMIN_PAGE_CHECK_LINKS);
            $tpl->assign('TITLE', TITLEADMIN_CHECK_LINKS);

            $links = Links::getLinkInfo(Core_Array::getPost('id'));

            if (!empty($links['htmlcode_banner']))
                $htmlcode_banner = $links['htmlcode_banner'];
            else
                $htmlcode_banner = '<a href="http://' . $links['url'] . '"><img border="0" width="88" height="31" src="./images/noimage.gif"></a>';

            $links['description'] = nl2br($links['description']);

            $blockCheckLink = $tpl->fetch('CHECK_LINK');
            $blockCheckLink->assign("RETURN_BACK", STR_GO_BACK);
            $blockCheckLink->assign("STR_RECIPROCAL_LINK", STR_RECIPROCAL_LINK);
            $blockCheckLink->assign("STR_CATEGORY", STR_CATEGORY);
            $blockCheckLink->assign("STR_ADDED", STR_ADDED);
            $blockCheckLink->assign("HTMLCODE_BANNER", $htmlcode_banner);
            $blockCheckLink->assign("NAME", $links['name']);
            $blockCheckLink->assign("URL", $links['url']);
            $blockCheckLink->assign("CATNAME", $links['catname']);
            $blockCheckLink->assign("TIME", $links['time']);
            $blockCheckLink->assign("ACTION", $_SERVER['PHP_SELF']);
            $blockCheckLink->assign("ID_LINK", $links['id_link']);
            $blockCheckLink->assign("DESCRIPTION", $links['description']);
            $blockCheckLink->assign("RECIPROCAL_LINK", $links['reciprocal_link']);
            $blockCheckLink->assign('SHOW_PR', $settings['show_pr']);
            $blockCheckLink->assign('SHOW_CY', $settings['show_cy']);
            $blockCheckLink->assign('BUTTON_ADD', BUTTON_ADD);
            $blockCheckLink->assign('BUTTON_DELETE', BUTTON_DELETE);
            $blockCheckLink->assign('BUTTON_TO_BLACKLIST', BUTTON_TO_BLACKLIST);

            $tpl->assign('CHECK_LINK', $blockCheckLink);

            break;

        case 'check_aut':

            $links = $data->getLinkInfo(Core_Array::getPost('id'));

            if (Helper::checkUrlLink($links['reciprocal_link'], core::getSetting('url'))) {
                if ($links['status'] == "hide") {
                    if (core::getSetting('add_to_blacklist') == "yes") {
                        $fields = [
                            'status' => 'black',
                            'time_check' => date("Y-m-d H:i:s"),
                            'reason' => core::getLanguage('msg', 'reason_absense_reciprocal'),
                        ];

                        $result = $data->updateStatus($fields, $links['id']);

                    } else {
                        $result = $data->removeLink($links['id']);
                    }

                    if ($result) {
                        // Notify the user about his link was removed
                        Helper::sendmail_del_link($links, core::getLanguage('str', 'subject_del'));

                        $success = core::getLanguage('msg', 'check_is_completed');
                        $_POST['action'] = '';

                    } else {
                        $errors[] = core::getLanguage('error', 'web_apps_error');
                    }
                } else {

                    $fields = [
                        'status' => 'hide',
                        'time_check' => date("Y-m-d H:i:s"),
                        'reason' => core::getLanguage('msg', 'reason_absense_reciprocal'),
                    ];

                    $result = $data->updateStatus($fields, $links['id']);

                    if ($result) {
                        // Notify the user about his link was hidded
                        $nscript = strpos($_SERVER['REQUEST_URI'], "admin");
                        $root = substr($_SERVER['REQUEST_URI'], 0, $nscript);
                        $url_link_edit = "" . $_SERVER['SERVER_NAME'] . $root . "edit.php?id=" . $links['id_link'] . "&token=" . $links['token'] . "";

                        Helper::sendmail_hide_link($links, $url_link_edit, core::getLanguage('str', 'subject_hide'));

                        $success = core::getLanguage('msg', 'check_is_completed');;
                        $_POST['action'] = '';

                    } else {
                        $errors[] = core::getLanguage('error', 'web_apps_error');
                    }
                }
            } else {
                // Check on, whether the page of answer link is closed for index
                if (check_meta($links['reciprocal_link'])) {
                    if ($links['status'] == "hide") {
                        if ($settings['add_to_blacklist'] == "yes") {

                            $fields = [
                                'status' => 'black',
                                'time' => date("Y-m-d H:i:s"),
                                'reason' => core::getLanguage('msg', 'reason_closed_for_index_meta'),
                            ];

                        } else {
                            $query = "DELETE FROM " . DB_LINKS . " WHERE id_link = " . $links['id_link'];
                        }

                        if ($dbh->query($query)) {
                            // Notify the user about his link was removed
                            sendmail_del_link($links, STR_SUBJECT_DEL);

                            $success = MSG_CHECK_IS_COMPLETED;
                            $_POST['action'] = '';

                        } else {
                            throw new ExceptionMySQL($dbh->error, $query, "Error executing SQL query!");
                        }
                    } else {
                        $query = "UPDATE " . DB_LINKS . " SET status = 'hide',time_check = NOW(), reason = '" . REASON_CLOSED_FOR_INDEX_META . "' WHERE id_link = " . $links['id_link'];

                        if ($dbh->query($query)) {
                            // Notify the user about his link was hidded
                            sendmail_hide_link2($links, MSG_CLOSED_FOR_INDEX_META, STR_SUBJECT_HIDE);

                            $success = MSG_CHECK_IS_COMPLETED;
                            $_POST['action'] = '';

                        } else {
                            throw new ExceptionMySQL($dbh->error, $query, "Error executing SQL query!");
                        }
                    }
                } else {
                    // Check on, whether the directory is closed for index
                    if (check_robots($links['reciprocal_link'])) {
                        if ($links['status'] == "hide") {
                            if ($settings['add_to_blacklist'] == "yes") {
                                $query = "UPDATE " . DB_LINKS . " SET status = 'black', time = NOW(), reason = '" . REASON_CLOSED_FOR_INDEX_ROBOT . "' WHERE id_link = " . $links['id_link'];
                            } else {
                                $query = "DELETE FROM " . DB_LINKS . " WHERE id_link = " . $links['id_link'];
                            }

                            if ($dbh->query($query)) {
                                // Notify the user about his link was removed
                                sendmail_del_link($links, STR_SUBJECT_DEL);

                                $success = MSG_CHECK_IS_COMPLETED;
                                $_POST['action'] = '';

                            } else {
                                throw new ExceptionMySQL($dbh->error, $query, "Error executing SQL query!");
                            }
                        } else {
                            $query = "UPDATE " . DB_LINKS . " SET status = 'hide', time_check = NOW(), reason = '" . REASON_CLOSED_FOR_INDEX_ROBOT . "' WHERE id_link = " . $links['id_link'];

                            if ($dbh->query($query)) {
                                // Notify the user about his link was hidded
                                sendmail_hide_link2($links, MSG_CLOSED_FOR_INDEX_ROBOT, STR_SUBJECT_HIDE);

                                $success = MSG_CHECK_IS_COMPLETED;
                                $_POST['action'] = '';

                            } else {
                                throw new ExceptionMySQL($dbh->error, $query, "Error executing SQL query!");
                            }
                        }
                    } else {
                        if ($links['status'] == "hide") {
                            $query = "UPDATE " . DB_LINKS . " SET status = 'show', time_check = NOW(), reason = '', number_check = 0 WHERE id_link = " . $links['id_link'];

                            if ($dbh->query($query)) {
                                // Notify the user about his link was restored
                                sendMailAdd($links, STR_SUBJECT_ADD);

                                $success = MSG_CHECK_IS_COMPLETED;
                                $_POST['action'] = '';

                            } else {
                                throw new ExceptionMySQL($dbh->error, $query, "Error executing SQL query!");
                            }
                        }

                        if ($links['status'] == "show") {
                            $query = "UPDATE " . DB_LINKS . " SET time_check = NOW(), number_check = 0 WHERE id_link = " . $links['id_link'];

                            if ($dbh->query($query)) {
                                $success = MSG_CHECK_IS_COMPLETED;
                                $_POST['action'] = '';
                            } else {
                                throw new ExceptionMySQL($dbh->error, $query, "Error executing SQL query!");
                            }
                        }
                    }
                }
            }

            break;

        case check_all_aut:

            $tpl->assign('TITLEPAGE', TITLEADMIN_PAGE_CHECK_LINKS);
            $tpl->assign('TITLE', TITLEADMIN_CHECK_LINKS);

            $tpl->assign('HELP', INFO_CHECK_CHECK_LINKS);

            $add = 0;
            $del = 0;
            $hide = 0;

            // Check all hidded link
            $query = "SELECT * FROM " . DB_LINKS . " WHERE status = 'hide'";
            $result = $dbh->query($query);

            if (!$result) {
                throw new ExceptionMySQL($dbh->error, $query, "Error executing SQL query!");
            }

            while ($links = $result->fetch_array()) {
                $date_check = strtotime($links['time_check']);
                $interval_check = ceil((time() - $date_check) / 3600 / 24);

                if ($links['check_link'] == "yes" AND $interval_check > $settings['check_interval'] AND $interval_check != 1) {
                    if (check_url_link($links['reciprocal_link'], $settings['url'])) {
                        if ($settings['add_to_blacklist'] == "yes") {
                            $query = "UPDATE " . DB_LINKS . " SET status = 'black', time = NOW(), reason = '" . REASON_ABSENSE_RECIPROCAL . "' WHERE id_link = " . $links['id_link'];
                        } else {
                            $query = "DELETE FROM " . DB_LINKS . " WHERE id_link = " . $links['id_link'];
                        }

                        if ($dbh->query($query)) {
                            // Notify the user about his link was removed
                            sendmail_del_link($links, STR_SUBJECT_DEL);

                            // Count a quantity of the links which was removed
                            $del = $del + 1;
                        }
                    } else {

                        // Check on, whether the page of answer link for index by metatag <meta name=robot>
                        if (check_meta($links['reciprocal_link'])) {
                            if ($settings['add_to_blacklist'] == "yes") {
                                $query = "UPDATE " . DB_LINKS . " SET status = 'black', time = NOW(), reason = '" . REASON_CLOSED_FOR_INDEX_META . "' WHERE id_link = " . $links['id_link'];
                            } else {
                                $query = "DELETE FROM " . DB_LINKS . " WHERE id_link = " . $links['id_link'];
                            }

                            if ($dbh->query($query)) {
                                // Notify the user about his link was removed
                                sendmail_del_link($links, STR_SUBJECT_DEL);

                                // Count a quantity of the links which was removed
                                $del = $del + 1;
                            }
                        } else {
                            // Check on, whether the directory with answer link is closed for index
                            if (check_robots($links['reciprocal_link'])) {
                                if ($settings['add_to_blacklist'] == "yes") {
                                    $query = "UPDATE " . DB_LINKS . " SET status = 'black', time = NOW(), reason = '" . REASON_CLOSED_FOR_INDEX_ROBOT . "' WHERE id_link = " . $links['id_link'];
                                } else {
                                    $query = "DELETE FROM " . DB_LINKS . " WHERE id_link = " . $links['id_link'];
                                }

                                if ($dbh->query($query)) {
                                    // Notify the user about his link was removed
                                    sendmail_del_link($links, STR_SUBJECT_DEL);

                                    // Count a quantity of the links which was removed
                                    $del = $del + 1;
                                }
                            } else {
                                $update = "UPDATE " . DB_LINKS . " SET status = 'show', time_check = NOW(), reason = '', number_check = 0 WHERE id_link = " . $links['id_link'];

                                if ($dbh->query($update)) {
                                    // Notify the user about his link was restored
                                    sendMailAdd($links, STR_SUBJECT_ADD);

                                    // Count a quantity of the links which was added
                                    $add = $add + 1;
                                }
                            }
                        }
                    }
                }

                $result->close();
            }

            // Check all other links
            $query = "SELECT * FROM " . DB_LINKS . " WHERE status = 'show'";
            $result = $dbh->query($query);

            if (!$result) {
                throw new ExceptionMySQL($dbh->error, $query, "Error executing SQL query!");
            }

            while ($links = $result->fetch_array()) {
                $date_check = strtotime($links['time_check']);
                $interval_check = ceil((time() - $date_check) / 3600 / 24);

                if ($links['check_link'] == "yes" AND $interval_check > $settings['check_interval'] AND $interval_check != 1) {
                    if (check_url_link($links['reciprocal_link'], $settings['url'])) {
                        if ($links['number_check'] == $settings['number_check']) {
                            // Form SQL-query to hide link
                            $update = "UPDATE " . DB_LINKS . " SET status = 'hide', time_check = NOW(), reason = '" . REASON_ABSENSE_RECIPROCAL . "' WHERE id_link = " . $links['id_link'];

                            if ($dbh->query($update)) {
                                // Notify the user about his link was hidded
                                $nscript = strpos($_SERVER['REQUEST_URI'], "admin");
                                $root = substr($_SERVER['REQUEST_URI'], 0, $nscript);
                                $url_link_edit = "" . $_SERVER['SERVER_NAME'] . $root . "edit.php?id=" . $links['id_link'] . "&token=" . $links['token'] . "";

                                sendmail_hide_link($links, $url_link_edit, STR_SUBJECT_HIDE);

                                // Count a quantity of the links which was hidded
                                $hide = $hide + 1;
                            }
                        } else {
                            $update = "UPDATE " . DB_LINKS . " SET time_check = NOW(), number_check = number_check + 1 WHERE id_link = " . $links['id_link'];
                            $dbh->query($update);
                        }
                    } else {
                        // Check the page of answer link on index
                        if (check_meta($links['reciprocal_link'])) {
                            if ($links['number_check'] == $settings['number_check']) {
                                // Form SQL-query to hide link
                                $update = "UPDATE " . DB_LINKS . " SET status = 'hide', time_check = NOW(), reason = '" . REASON_CLOSED_FOR_INDEX_ROBOT . "' WHERE id_link = " . $links['id_link'];

                                if ($dbh->query($update)) {
                                    // Notify the user about the link was hidded

                                    sendmail_hide_link2($links, MSG_CLOSED_FOR_INDEX_ROBOT, STR_SUBJECT_HIDE);

                                    // Count a quantity of the links which was hidded
                                    $hide = $hide + 1;
                                }
                            } else {
                                $update = "UPDATE " . DB_LINKS . " SET time_check = NOW(), number_check = number_check + 1 WHERE id_link = " . $links['id_link'];
                                $dbh->query($update);
                            }
                        } else {
                            // Check the directory is closed for index
                            if (check_robots($links['reciprocal_link'])) {
                                if ($links['number_check'] == $settings['number_check']) {
                                    // Form SQL-query to hide link
                                    $update = "UPDATE " . DB_LINKS . " SET status = 'hide', time_check = NOW(), reason = '" . REASON_CLOSED_FOR_INDEX_ROBOT . "' WHERE id_link = " . $links['id_link'];

                                    if ($dbh->query($update)) {
                                        // Notify the user about his link was hidded
                                        $reason = MSG_CLOSED_FOR_INDEX_ROBOT;

                                        sendmail_hide_link2($links, $reason, STR_SUBJECT_HIDE);

                                        // Count a quantity of the links which was hidded
                                        $hide = $hide + 1;
                                    }
                                } else {
                                    $update = "UPDATE " . DB_LINKS . " SET time_check = NOW(), number_check = number_check + 1 WHERE id_link = " . $links['id_link'];
                                    $dbh->query($update);
                                }
                            } else {
                                $update = "UPDATE " . DB_LINKS . " SET time_check = NOW(), reason = '', number_check = 0 WHERE id_link = " . $links['id_link'];
                                $dbh->query($update);
                            }
                        }
                    }
                }
            }

            $result->close();

            //alert
            if (!empty($success)) {
                $tpl->assign('MSG_ALERT', MSG_CHECK_IS_COMPLETED);
            }

            $blockStatistics = $tpl->fetch('STATISTICS');
            $blockStatistics->assign('STR_GO_BACK', STR_GO_BACK);
            $blockStatistics->assign('STR_REMOVED_LINKS', STR_RESULT_REMOVED_LINKS);
            $blockStatistics->assign('STR_RESULT_HIDDED_LINKS', STR_RESULT_HIDDED_LINKS);
            $blockStatistics->assign('STR_RESULT_ADDED_LINKS', STR_RESULT_ADDED_LINKS);
            $blockStatistics->assign('HIDE', $hide);
            $blockStatistics->assign('ADD', $add);
            $blockStatistics->assign('DEL', $del);
            $tpl->assign('STATISTICS', $blockStatistics);

            break;

    }
}


if (Core_Array::getRequest('action') == '') {
    $blockLinksList = $tpl->fetch('LINKS_LIST');
    $blockLinksList->assign('ACTION', $_SERVER['REQUEST_URI']);
    $blockLinksList->assign('BUTTON_CHECK_ALL_LINKS_AUTOMATICALLY', core::getLanguage('button', 'check_all_links_automatically'));

    $cat_id = Core_Array::getGet('id') ? $_GET['id'] : 0;


    $arraycat = $data->getArraycat($cat_id);


    $total = count($arraycat);
    $number = (int)($total / core::getSetting('columns_number'));


    // echo  $number;

    if ((float)($total / core::getSetting('columns_number')) - $number != 0) $number++;

    $rowPrintCat = $blockLinksList->fetch('PRINT_CAT');

    $arr = [];

    // Form an array
    for ($i = 0; $i < $number; $i++) {
        for ($j = 0; $j < core::getSetting('columns_number'); $j++) {
            $arr[$i][$j] = $arraycat[$j * $number + $i];
        }
    }

    for ($i = 0; $i < $number; $i++) {
        $rowBlockCat = $rowPrintCat->fetch('ROW_CAT');

        for ($j = 0; $j < core::getSetting('columns_number'); $j++) {

            $rowBlockFolder = $rowBlockCat->fetch('ROW_FOLDER');

            if ($arr[$i][$j][0] && !empty($arr[$i][$j][0])) {
                $rowBlockFolder->assign('FOLDER_LINK', "http://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'] . "&id=" . $arr[$i][$j][1]);

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


    $tpl->assign('LINKS_LIST', $blockLinksList);

    if (Core_Array::getGet('id')) {
        $arraypathway = [];
        $arraypathway = Links::topbarmenu(Core_Array::getGet('id'), '');
        $pathway = '<a href="./?a=admin&check_links">    ' . core::getLanguage('str', 'home') . '</a> ';

        for ($i = 0; $i < count($arraypathway); $i++) {
            $pathway .= '» <a href="http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'] . '&id=' . $arraypathway[$i][0] . '">' . $arraypathway[$i][1] . '</a>';
        }

        $blockLinksList->assign('TOPBARMENU', $pathway);

        $blockLinksList->assign('ID_CAT', $_GET['id']);
        $blockLinksList->assign('CATEGORY_NAME', $data->getCatalogById(Core_Array::getGet('id')));
        $blockLinksList->assign('RETURN_URL', './?a=admin&t=check_links');
        $blockLinksList->assign('STR_LINKS_WAITING_CHECKS', core::getLanguage('str', 'links_waiting_checks'));

        $pnumber = core::getSetting('all_number_links');

        $arrs = $data->getLinksByCatId(Core_Array::getGet('id'), Core_Array::getRequest('page'), $pnumber);

        foreach ($arrs as $row) {
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
            $rowBlock->assign('STR_ADDED', core::getLanguage('str', 'added'));
            $rowBlock->assign('TIME', $row['time']);
            $rowBlock->assign('ID_LINK', $row['id_link']);
            $rowBlock->assign('STR_NUMBER_OF_CLICKS', core::getLanguage('str', 'number_of_clicks'));
            $rowBlock->assign('COUNT', $row['count']);


            if ($row['check_link'] == "yes" OR !empty($row['reciprocal_link'])) {

                $BUTTON1 = $rowBlock->fetch('BUTTON1');
                $BUTTON1->assign('ACTION1', $_SERVER['PHP_SELF']);
                $BUTTON1->assign('STR_BUTTON1', core::getLanguage('button', 'handcheck'));
                $BUTTON1->assign('ID_LINK1', $row['id']);
                $rowBlock->assign('BUTTON1', $BUTTON1);
            }

            if (!empty($row['reciprocal_link'])) {
                $BUTTON2 = $rowBlock->fetch('BUTTON2');
                $BUTTON2->assign('ACTION2', $_SERVER['PHP_SELF']);
                $BUTTON2->assign('ID_LINK2', $row['id']);
                $BUTTON2->assign('STR_BUTTON2', core::getLanguage('button', 'autocheck'));
                $BUTTON2->assign('INTERVAL_CHECK', $interval_check);
                $rowBlock->assign('BUTTON2', $BUTTON2);
            }

            $blockLinksList->assign('ROW_LINKS', $rowBlock);
        }

        $number = $data->getTotal();
        $page = $data->getPageNumber();

        if ($page != 1) {
            $pervpage = '<a href="./?a=admin&check_links&id=' . $_GET['id'] . '&page=1">&lt;&lt;</a>';
            $perv = '<a href="./?a=admin&check_links&id=' . $_GET['id'] . '&page=' . ($page - 1) . '">&lt;</a>';
        }

        if ($page != $number) {
            $nextpage = '<a href="./?a=admin&check_links&id=' . $_GET['id'] . '&page=' . ($page + 1) . '">&gt;</a>';
            $next = '<a href="./?a=admin&check_links&id=' . $_GET['id'] . '&page=' . $number . '">&gt;&gt;</a>';
        }

        if ($page - 2 > 0) $page2left = '<a href=./?a=admin&check_links&id=' . $_GET['id'] . '&page=' . ($page - 2) . '">...' . ($page - 2) . '</a>';
        if ($page - 1 > 0) $page1left = '<a href="./?a=admin&check_links&id=' . $_GET['id'] . '&page=' . ($page - 1) . '">' . ($page - 1) . '</a>';
        if ($page + 2 <= $number) $page2right = '<a href="./?a=admin&check_links&id=' . $_GET['id'] . '&page=' . ($page + 2) . '">' . ($page + 2) . '...</a>';
        if ($page + 1 <= $number) $page1right = '<a href="./?a=admin&check_links&id=' . $_GET['id'] . '&page=' . ($page + 1) . '">' . ($page + 1) . '</a>';

        if ($number > 1) {
            $paginationBlock = $blockLinksList->fetch('pagination');
            $paginationBlock->assign('CURRENT_PAGE', '<a>' . $page . '</a>');
            $paginationBlock->assign('STR_PAGES', core::getLanguage('str', 'pages'));
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
        $blockLinksList->assign('STR_LINKS_FOR_CHECK', core::getLanguage('str', 'links_for_check'));

        $arrs = $data->getHiddenLinks();


        foreach ($arr as $row) {
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
            $rowBlock->assign('STR_ADDED', core::getLanguage('str', 'added'));
            $rowBlock->assign('TIME', $row['time']);
            $rowBlock->assign('ID_LINK', $row['id']);
            $rowBlock->assign('STR_NUMBER_OF_CLICKS', core::getLanguage('str', 'number_of_clicks'));
            $rowBlock->assign('COUNT', $row['count']);

            if ($row['check_link'] == "yes" OR !empty($row['reciprocal_link'])) {
                $BUTTON1 = $rowBlock->fetch('BUTTON1');
                $BUTTON1->assign('ACTION1', $_SERVER['PHP_SELF']);
                $BUTTON1->assign('STR_BUTTON1', core::getLanguage('button', 'handcheck'));
                $BUTTON1->assign('ID_LINK1', $row['id']);
                $rowBlock->assign('BUTTON1', $BUTTON1);
            }

            if (!empty($row['reciprocal_link'])) {
                $BUTTON2 = $rowBlock->fetch('BUTTON2');
                $BUTTON2->assign('ACTION2', $_SERVER['PHP_SELF']);
                $BUTTON2->assign('ID_LINK2', $row['id']);
                $BUTTON2->assign('MSG_ALERT_WAS_CHECKED', MSG_ALERT_WAS_CHECKED);

                if ($interval_check == 1) $BUTTON2->assign('ALERT', 'show');

                $BUTTON2->assign('STR_BUTTON2', core::getLanguage('button', 'autocheck'));
                $BUTTON2->assign('INTERVAL_CHECK', $interval_check);
                $rowBlock->assign('BUTTON2', $BUTTON2);
            }

            $blockLinksList->assign('ROW_LINKS', $rowBlock);
        }

    }


}

//footer
include_once core::pathTo('extra', 'admin/footer.php');

//display content
$tpl->display();