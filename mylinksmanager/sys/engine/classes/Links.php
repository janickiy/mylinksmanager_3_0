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
    /**
     * @param $url
     * @return bool
     */
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

    /**
     * @param $url
     * @return bool
     */
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

    /**
     * @param string $status
     * @return mixed
     */
    public static function getTotalLinks($status = 'show')
    {
        $query = "SELECT * FROM  " . core::database()->getTableName('links') . " WHERE status = '" . $status . "'";
        $result = core::database()->querySQL($query);

        return core::database()->getRecordCount($result);
    }

    /**
     * @param $parent_id
     * @param $numberlinks
     * @return mixed
     */
    public static function ShowNumbersLinks($parent_id, $numberlinks)
    {
        $parent_id = core::database()->escape($parent_id);

        $query = "SELECT * FROM " . core::database()->getTableName('links') . " WHERE id_cat = " . $parent_id . " AND status='show'";
        $result = core::database()->querySQL($query);

        $numberlinks = $numberlinks + core::database()->getRecordCount($result);

        $query = "SELECT * FROM   " . core::database()->getTableName('catalog') . "  WHERE parent_id=" . $parent_id;
        $result = core::database()->querySQL($query);

        if (core::database()->getRecordCount($result) > 0) {
            while($row = core::database()->getRow($result))
            {
                $result2 = core::database()->querySQL("SELECT * FROM " . core::database()->getTableName('links') . " WHERE id = " . $row["id"] . " AND status = 'show'");
                $numberlinks = $numberlinks + core::database()->getRecordCount($result2);

                self::ShowNumbersLinks($row["id"], $numberlinks);
            }
        }

        return $numberlinks;
    }

    /**
     * @param $id_cat
     * @return mixed
     */
    public static function ShowNumbersLinksSubCat($id_cat)
    {
        $id_cat = core::database()->escape($id_cat);

        $query = "SELECT * FROM " . core::database()->getTableName('links') . " WHERE id_cat = " . $id_cat . " AND status='show'";
        $result = core::database()->querySQL($query);

        return core::database()->getRecordCount($result);
    }
}





