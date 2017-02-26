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

$tpl->assign('TITLEPAGE', core::getLanguage('title', 'admin_page_blacklist'));
$tpl->assign('TITLE', core::getLanguage('title', 'admin_blacklist'));
$tpl->assign('HELP', core::getLanguage('info', 'admin_blacklist'));

$errors = array();

if (Core_Array::getRequest('action')){



    // Remove links
    if (Core_Array::getRequest('event') == "delete"){

        $link_id = Core_Array::getPost('link_id');
        if ($data->removeLink($link_id)) {
           // $success = MSG_LINK_REMOVED;
        } else {

        }
    }

    if (Core_Array::getRequest('event') == "restore"){
        $link_id = Core_Array::getPost('link_id');

        if($data->restoreLink($link_id)){
           // $success = MSG_LINK_RESTORED;
        }
        else { throw new ExceptionMySQL($dbh->error,$update,"Error executing SQL query!"); }
    }

}

if (isset($success_msg)) $tpl->assign('MSG_ALERT', $success_msg);

include_once core::pathTo('extra', 'top.php');

// menu
include_once core::pathTo('extra', 'menu.php');


//footer
include_once core::pathTo('extra', 'footer.php');

//display content
$tpl->display();