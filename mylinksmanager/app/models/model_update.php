<?php

/********************************************
 * My Links Manager 3.0.0 alfa
 * Copyright (c) 2011-2018 Alexander Yanitsky
 * Website: http://janicky.com
 * E-mail: janickiy@mail.ru
 * Skype: janickiy
 ********************************************/

defined('MYLINKSMANAGER') || exit('My Links Manager: access denied!');

class Model_update extends Model
{
    /**
     * @param $version
     * @return mixed
     */
    public function getVersionCode($version)
    {
        preg_match("/(\d+)\.(\d+)\./", $version, $out);
        $code = ($out[1] * 10000 + $out[2] * 100);

        return $code;
    }
}