<?php

/********************************************
 * My Links Manager 3.0.0 alfa
 * Copyright (c) 2011-2017 Alexander Yanitsky
 * Website: http://janicky.com
 * E-mail: janickiy@mail.ru
 * Skype: janickiy
 ********************************************/

defined('MYLINKSMANAGER') || exit('My Links Manager: access denied!');

Error_Reporting(1); // set error reporting level

define("DEBUG", 1);

define('VERSION', '3.0.0 alfa');

$cmspaths = ['core' => 'sys/core',
             'engine' => 'sys/engine', // Engines AUTOLOAD folder
             'config' => 'config', // Config
             'templates' => 'templates', // templates
             'controllers' => 'app/controllers', // controllers
             'libs' => 'vendor', // libraries
             'models' => 'app/models',
             'views' => 'app/views',
             'extra' => 'app/snippets',
             'tmp' => 'tmp'
             ];

require_once SYS_ROOT . $cmspaths['config'] . '/config_db.php';
require_once SYS_ROOT . $cmspaths['core'] . '/core.php';
core::init($cmspaths);
core::$db = new DB($ConfigDB);
core::$session = new Session();

// get settings
if (!is_array(core::getSetting())) {
    $query = "SELECT * FROM " . core::database()->getTableName('settings');
    $result = core::database()->querySQL($query);
    core::addSetting(core::database()->getRow($result));
}

// get language
$lang_file = core::pathTo('templates', 'language/');
$lang_file .= ((core::getSetting("language")) ? core::getSetting("language") . ".php" : "en.php");

if (file_exists($lang_file)) {
    include $lang_file;
    core::addLanguage($language);
} else {
    exit('ERROR: Language file can not load!');
}

core::setTemplate("assets/");