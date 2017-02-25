<?php

/********************************************
 * My Links Manager 3.0.0 alfa
 * Copyright (c) 2011-2017 Alexander Yanitsky
 * Website: http://janicky.com
 * E-mail: janickiy@mail.ru
 * Skype: janickiy
 ********************************************/

defined('MYLINKSMANAGER') || exit('My Links Manager: access denied!');

class Links
{
    public static function CheckExistsLink ($url) {
        if (!empty($url)) {
            $url = core::database()->escape($url);
            $query = "SELECT * FROM  " . core::database()->getTableName('links') . "  WHERE url RLIKE '^(www\\.)?" . $url . "$' AND status = 'show' OR
													url RLIKE '^(www\\.)?" . $url . "$' AND status = 'black'";
            $result = core::database()->querySQL($query);

            if (core::database()->getRecordCount($result) == 0)
                return false;
            else
                return true;
        }
    }

    public static function CheckWaitVerification ($url) {
        if (!empty($url)) {
            $url = core::database()->escape($url);

            $query = "SELECT * FROM " . core::database()->getTableName('links') . " WHERE url RLIKE '^(www\\.)?" . $url . "$' AND status = 'new' OR
												url RLIKE '^(www\\.)?". $url . "$' AND status = 'hide'";
            $result = core::database()->querySQL($query);

            if (core::database()->getRecordCount($result) == 0)
                return false;
            else
                return true;
        }
    }

    public static function getTotalLinks($status = 'show')
    {
        $query = "SELECT * FROM  " . core::database()->getTableName('links') . " WHERE status = '" . $status . "'";
        $result = core::database()->querySQL($query);

        return core::database()->getRecordCount($result);
    }
}





