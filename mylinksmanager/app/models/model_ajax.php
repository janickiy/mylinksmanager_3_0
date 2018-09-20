<?php

/********************************************
 * My Links Manager 3.0.2
 * Copyright (c) 2011-2018 Alexander Yanitsky
 * Website: http://janicky.com
 * E-mail: janickiy@mail.ru
 * Skype: janickiy
 ********************************************/

defined('MYLINKSMANAGER') || exit('My Links Manager: access denied!');

class Model_ajax extends Model
{
    /**
     * @param $path
     * @return bool
     */
    public function updateDB($path)
    {
        global $ConfigDB;

        $result = true;

        $sql = file_get_contents($path);
        $queries = explode(';', $sql);

        foreach ($queries as $query){
            $query = str_replace('%prefix%', $ConfigDB["prefix"], $query);
            $query = trim($query);

            if (empty($query)){
                continue;
            }

            if (!core::database()->querySQL($query)){
                $result = false;
                break;
            }
        }

        return $result;
    }

    /**
     * @return int|null
     */
    public function versionCodeDetect()
    {
        global $ConfigDB;

        $tables_list = [
            'aut',
            'catalog',
            'links',
            'settings'
        ];

        $tables = [];

        if ($res1 = core::database()->querySQL("SHOW TABLES FROM `" . $ConfigDB["name"] . "` LIKE '" . $ConfigDB["prefix"] . "%'")) {
            while ($row1 = core::database()->getRow($res1)){
                $res2 = core::database()->querySQL("DESCRIBE `".$row1[0]."`");
                $tables[substr($row1[0], strlen($ConfigDB["prefix"]))] = array();

                while($row2 = core::database()->getRow($res2)) {
                    $tables[substr($row1[0], strlen($ConfigDB["prefix"]))][] = $row2[0];
                }
            }
        }

        $exists_tables = [];

        foreach($tables_list as $table){
            if (isset($tables[$table])) {
                $exists_tables[] = $table;
            }
        }

        $version_code_detect = null;

        if ($exists_tables) {
            $version_code_detect = 30000;
        }

        return $version_code_detect;
    }

    /**
     * @param $path
     * @param null $getfile
     * @return bool
     */
    public function DownloadUpdate($path, $getfile = null)
    {
        $result = true;

        if ($getfile){
            $newUpdate = file_get_contents($getfile);
            if (!is_dir(SYS_ROOT . core::getPath('tmp'))) mkdir(SYS_ROOT . core::getPath('tmp'));

            $dlHandler = fopen($path, 'w');

            if (!fwrite($dlHandler, $newUpdate)) {
                $result = false;
            }

            fclose($dlHandler);
        }

        return $result;
    }
}