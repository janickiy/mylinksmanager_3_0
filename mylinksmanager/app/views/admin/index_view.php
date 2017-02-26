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
$tpl = SeparateTemplate::instance()->loadSourceFromFile(core::getTemplate() . "admin/index.tpl");

$tpl->assign('TITLEPAGE', core::getLanguage('title', 'admin_page_index'));
$tpl->assign('TITLE', core::getLanguage('title', 'admin_index'));
$tpl->assign('HELP', core::getLanguage('info', 'admin_index'));

include_once core::pathTo('extra', 'top.php');

//menu
include_once core::pathTo('extra', 'menu.php');

// Read the contents of file of style.css in the buffer
$fd = @fopen("templates/styles/style.css", "r");
$bufer1 = @fread($fd, filesize("templates/styles/style.css"));
fclose($fd);

// Read the contents of file of top.html in the buffer
$fd = @fopen("../templates/header.tpl", "r");
$bufer2 = @fread($fd, filesize("../templates/header.tpl"));
fclose($fd);

$bufer2 = preg_replace('/\${(\w+)}/sU', "[\\1]", $bufer2);

// Read the contents of file of bottom.html in the buffer
$fd = @fopen("../templates/footer.tpl", "r");
$bufer3 = @fread($fd, filesize("../templates/footer.tpl"));
fclose($fd);

$bufer3 = preg_replace('/\${(\w+)}/sU', "[\\1]", $bufer3);

// Read the contents of file of index.tpl in the buffer
$fd = @fopen("../templates/index.tpl", "r");
$bufer4 = @fread($fd, filesize("../templates/index.tpl"));
fclose($fd);

$bufer4 = preg_replace('/\${(\w+)}/sU', "[\\1]", $bufer4);

// Read the contents of file of add_url.tpl in the buffer
$fd = @fopen("../templates/add_url.tpl", "r");
$bufer5 = @fread($fd, filesize("../templates/add_url.tpl"));
fclose($fd);

$bufer5 = preg_replace('/\${(\w+)}/sU', "[\\1]", $bufer5);





//footer
include_once core::pathTo('extra', 'footer.php');

//display content
$tpl->display();