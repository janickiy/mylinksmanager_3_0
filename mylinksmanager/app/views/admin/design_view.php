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
$tpl = SeparateTemplate::instance()->loadSourceFromFile(core::getTemplate() . "admin/design.tpl");

$tpl->assign('TITLEPAGE', core::getLanguage('title', 'admin_page_design'));
$tpl->assign('TITLE', core::getLanguage('title', 'admin_design'));
$tpl->assign('HELP', core::getLanguage('info', 'admin_design'));

if (Core_Array::getRequest('action')) {
    switch (Core_Array::getRequest('action'))
    {
        case 'style':

            $style = stripslashes(Core_Array::getPost('style'));
            $style = preg_replace('/<\?(php)?/i', '', $style);
            $style = preg_replace('/\?>/i', '', $style);

            // Add changes in file style.css
            if ($fd = fopen("templates/styles/style.css", "w")) {
                fputs($fd, $style);
                fclose($fd);

                $success_msg = core::getLanguage('msg', 'changes_added');
            } else {
                $error = preg_replace('%FILE%','index.tpl', core::getLanguage('error', 'failed_add_changes_design'));
            }

            break;

        case 'header':

            $header = stripslashes(Core_Array::getPost('header'));
            $header = preg_replace('/<\?(php)?/i', '', $header);
            $header = preg_replace('/\?>/i', '', $header);
            $header = preg_replace("|\[(\w+)\]|sU", "\${\\1}", $header);

            // Add the changes in file header.tpl
            if ($fd = fopen("templates/assets/header.tpl", "w")){

                fputs($fd, $header);
                fclose($fd);

                $success_msg = core::getLanguage('msg', 'changes_added');
            } else {
                $error = preg_replace('%FILE%','index.tpl', core::getLanguage('error', 'failed_add_changes_design'));
            }

            break;

        case 'index':
            $links = stripslashes(Core_Array::getPost('links'));
            $links = preg_replace('/<\?(php)?/i', '', $links);
            $links = preg_replace('/\?>/i', '', $links);
            $links = preg_replace("|\[(\w+)\]|sU", "\${\\1}", $links);

            // Add changes in file index.tpl
            if ($fd = fopen("templates/assets/index.tpl", "w")) {
                fputs($fd, $links);
                fclose($fd);

                $success_msg = core::getLanguage('msg', 'changes_added');

            } else {
                $error = preg_replace('%FILE%','index.tpl', core::getLanguage('error', 'failed_add_changes_design'));
            }

            break;

        case 'add_url':

            $add_url = stripslashes(Core_Array::getPost('add_url'));
            $add_url = preg_replace('/<\?(php)?/i', '', $add_url);
            $add_url = preg_replace('/\?>/i', '', $add_url);
            $add_url = preg_replace("|\[(\w+)\]|sU", "\${\\1}", $add_url);

            // Add changes in file link.html
            if ($fd = fopen("templates/assets/add_url.tpl", "w")) {
                fputs($fd, $add_url);
                fclose($fd);

                $success_msg = core::getLanguage('msg', 'changes_added');

            } else {
                $error = preg_replace('%FILE%','index.tpl', core::getLanguage('error', 'failed_add_changes_design'));
            }

            break;

        case 'footer':

            $footer = stripslashes(Core_Array::getPost('footer'));
            $footer = preg_replace('/<\?(php)?/i', '', $footer);
            $footer = preg_replace('/\?>/i', '', $footer);
            $footer = preg_replace("|\[(\w+)\]|sU", "\${\\1}", $footer);

            // Add changes in file footer.html
            if ($fd = fopen("templates/assets/footer.tpl", "w")) {
                fputs($fd, $footer);
                fclose($fd);

                $success_msg = core::getLanguage('msg', 'changes_added');

            } else {
                $error = preg_replace('%FILE%','index.tpl', core::getLanguage('error', 'failed_add_changes_design'));
            }

            break;

        default:

            header("Location: ./?a=admin&t=design");
            exit;

            break;
    }
}

include_once core::pathTo('extra', 'top.php');

//menu
include_once core::pathTo('extra', 'menu.php');

if (isset($error)) $tpl->assign('ERROR_ALERT', $error);
if (isset($success_msg)) $tpl->assign('MSG_ALERT', $success_msg);

// Read the contents of file of style.css in the buffer
$fd = @fopen("templates/styles/style.css", "r");
$bufer1 = @fread($fd, filesize("templates/styles/style.css"));
fclose($fd);

// Read the contents of file of top.html in the buffer
$fd = @fopen("templates/assets/header.tpl", "r");
$bufer2 = @fread($fd, filesize("templates/assets/header.tpl"));
fclose($fd);

$bufer2 = preg_replace('/\${(\w+)}/sU', "[\\1]", $bufer2);

// Read the contents of file of bottom.html in the buffer
$fd = @fopen("templates/assets/footer.tpl", "r");
$bufer3 = @fread($fd, filesize("templates/assets/footer.tpl"));
fclose($fd);

$bufer3 = preg_replace('/\${(\w+)}/sU', "[\\1]", $bufer3);

// Read the contents of file of index.tpl in the buffer
$fd = @fopen("templates/assets/index.tpl", "r");
$bufer4 = @fread($fd, filesize("templates/assets/index.tpl"));
fclose($fd);

$bufer4 = preg_replace('/\${(\w+)}/sU', "[\\1]", $bufer4);

// Read the contents of file of add_url.tpl in the buffer
$fd = @fopen("templates/assets/add_url.tpl", "r");
$bufer5 = @fread($fd, filesize("templates/assets/add_url.tpl"));
fclose($fd);

$bufer5 = preg_replace('/\${(\w+)}/sU', "[\\1]", $bufer5);

$bufer1 = htmlspecialchars($bufer1);
$bufer2 = htmlspecialchars($bufer2);
$bufer3 = htmlspecialchars($bufer3);
$bufer4 = htmlspecialchars($bufer4);
$bufer5 = htmlspecialchars($bufer5);

//form
$tpl->assign('ACTION', $_SERVER['REQUEST_URI']);
$tpl->assign('STR_FILE', core::getLanguage('str', 'file'));
$tpl->assign('BUFER1', $bufer1);
$tpl->assign('BUFER2', $bufer2);
$tpl->assign('BUFER3', $bufer3);
$tpl->assign('BUFER4', $bufer4);
$tpl->assign('BUFER5', $bufer5);
$tpl->assign('BUTTON_SAVE_CHANGES_IN', core::getLanguage('button', 'save_changes_in'));

//footer
include_once core::pathTo('extra', 'footer.php');

//display content
$tpl->display();