<?php

/********************************************
 * My Links Manager 3.0.0 alfa
 * Copyright (c) 2011-2017 Alexander Yanitsky
 * Website: http://janicky.com
 * E-mail: janickiy@mail.ru
 * Skype: janickiy
 ********************************************/

defined('MYLINKSMANAGER') || exit('My Links Manager: access denied!');

Auth::authorization();

//include template
core::requireEx('libs', "html_template/SeparateTemplate.php");
$tpl = SeparateTemplate::instance()->loadSourceFromFile(core::getTemplate() . "admin/blacklist.tpl");

$tpl->assign('TITLE_PAGE', core::getLanguage('title', 'admin_page_design'));
$tpl->assign('TITLE', core::getLanguage('title', 'admin_design'));

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

                $success = MSG_CHANGES_ADDED;
            } else {
                $error = preg_replace('%FILE%','style.css', MSG_ERROR_FAILED_ADD_CHANGES_DESIGN);
            }

            break;

        case 'header':

            $header = stripslashes(Core_Array::getPost('header'));
            $header = preg_replace('/<\?(php)?/i', '', $header);
            $header = preg_replace('/\?>/i', '', $header);
            $header = preg_replace("|\[(\w+)\]|sU", "\${\\1}", $header);

            // Add the changes in file header.tpl
            if ($fd = fopen("templates/header.tpl", "w")){

                fputs($fd, $header);
                fclose($fd);

                $success = MSG_CHANGES_ADDED;
            } else {
                $error = preg_replace('%FILE%', 'header.tpl', MSG_ERROR_FAILED_ADD_CHANGES_DESIGN);
            }

            break;

        case 'index':
            $links = stripslashes(Core_Array::getPost('links'));
            $links = preg_replace('/<\?(php)?/i', '', $links);
            $links = preg_replace('/\?>/i', '', $links);
            $links = preg_replace("|\[(\w+)\]|sU", "\${\\1}", $links);

            // Add changes in file index.tpl
            if ($fd = fopen("templates/index.tpl", "w")) {
                fputs($fd, $links);
                fclose($fd);

                $success = core::getLanguage('msg', 'changes_added');

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
            if ($fd = fopen("templates/add_url.tpl", "w")) {
                fputs($fd, $add_url);
                fclose($fd);

                $success = core::getLanguage('msg', 'changes_added');

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
            if ($fd = fopen("templates/footer.tpl", "w")) {
                fputs($fd, $footer);
                fclose($fd);

                $success = core::getLanguage('msg', 'changes_added');

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


//display content
$tpl->display();