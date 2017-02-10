<?php

/********************************************
 * My Links Manager 3.0.0 alfa
 * Copyright (c) 2011-2017 Alexander Yanitsky
 * Website: http://janicky.com
 * E-mail: janickiy@mail.ru
 * Skype: janickiy
 ********************************************/

defined('MYLINKSMANAGER') || exit('My Links Manager: access denied!');

class core
{
    protected static $_init = NULL;
    protected static $paths = array(); 
    protected static $mainConfig = NULL;
    public static $db = NULL;
    public static $tpl = NULL;
    public static $path = NULL;

    /**
     * Check if self::init() has been called
     *
     * @return boolean
     */

    static public function isInit()
    {
        return self::$_init;
    }

    /**
     * Initialization
     *
     * @return boolean
     */

    static public function init($paths)
    {
        if (self::isInit())
            return TRUE;
        self::$paths = $paths;
        self::$path = str_replace("//", "/", "/" . trim(str_replace(chr(92), "/", substr(SYS_ROOT, strlen($_SERVER["DOCUMENT_ROOT"]))), "/") . "/");
        self::_loadEngines();        
		self::$_init = TRUE;
    }

    /**
     * Create class $className
     *
     * @param string $className
     *            class name
     * @return mixed
     */

    static public function factory($className)
    {
        return new $className();
    }

    static public function database()
    {
        return self::$db;
    }

    /**
     * AUTOLOAD modules
     */

    static protected function _loadEngines()
    {
        require_once 'folders.php';
        $folders = array(
            self::$paths['engine']
        );
        $autoload = array_reverse(folders::scan($folders, 'php', TRUE));
        foreach ($autoload as $lib) {
            if (is_file($lib))
                require_once $lib;
        }
    }

    static public function getTemplate()
    {
        return self::$tpl;
    }

    /**
     * @param $tpl
     */
    static public function setTemplate($tpl)
    {
        self::$tpl = SYS_ROOT . self::$paths['templates'] . DIRECTORY_SEPARATOR . $tpl;
    }

    /**
     * @param $engine
     * @param $data
     * @return string
     */
    static public function pathTo($engine, $data)
    {
        return SYS_ROOT . self::$paths[$engine] . DIRECTORY_SEPARATOR . $data;
    }

    /**
     * @param $engine
     * @param $name
     * @return bool
     */
    static public function requireEx($engine, $name)
    {
        $file = SYS_ROOT . self::$paths[$engine] . DIRECTORY_SEPARATOR . $name;
        if (file_exists($file)) {
            require_once $file;
            return true;
        } else
            return false;
    }

    /**
     * @param $engine
     * @param $name
     * @return bool
     */
	static public function includeEx($engine, $name)
    {
        $file = SYS_ROOT . self::$paths[$engine] . DIRECTORY_SEPARATOR . $name;
        if (file_exists($file)) {
            include_once $file;
            return true;
        } else
            return false;
    }

    /**
     * @param $path
     * @return mixed
     */
    static public function getPath($path)
    {
        return self::$paths[$path];
    }

}