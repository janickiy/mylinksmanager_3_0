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

        $query = "SELECT * FROM  " . core::database()->getTableName('catalog') . "  WHERE parent_id=" . $parent_id;
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
    public static function ShowNumbersLinksSubCat($cat_id)
    {
        $cat_id = core::database()->escape($cat_id);

        $query = "SELECT * FROM " . core::database()->getTableName('links') . " WHERE cat_id = " . $cat_id . " AND status='show'";
        $result = core::database()->querySQL($query);

        return core::database()->getRecordCount($result);
    }

    /**
     * @param $status
     * @param $order
     * @param $offset
     * @param int $number
     * @return mixed
     */
    public function getLinksList($status,$order,$offset,$number=10)
    {
        if (is_numeric($offset) && is_numeric($number)) {
            $query = "SELECT *,c.name AS catname, l.description AS description, l.id AS id FROM " . core::database()->getTableName('links') . " l
                      LEFT JOIN " . core::database()->getTableName('catalog') . " c ON c.id = l.cat_id
                      WHERE l.status='" . $status ."'
                      ORDER BY " . $order . "
                      LIMIT " . $number . "
                      OFFSET " . $offset . "";

            $result = core::database()->querySQL($query);

            return core::database()->getColumnArray($result);
        }
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getLinkInfo($id) {
        if (is_numeric($id)) {
            $query = "SELECT *,l.name AS name, l.description AS description,c.name AS catname FROM " . core::database()->getTableName('links') . " l
            LEFT JOIN  " . core::database()->getTableName('catalog') . " c ON l.cat_id = c.id WHERE l.id=" . $id;
            $result = core::database()->querySQL($query);
            return core::database()->getRow($result);
        }
    }

    /**
     * @param $id
     * @param $status
     * @return mixed
     */
    public function changeStatusLink($id, $status)
    {
        if (is_numeric($id) && $status) {
            $query = "UPDATE " . core::database()->getTableName('links') . " SET status='" . $status . "' WHERE id=" . $id;
            return core::database()->querySQL($query);
        }
    }

    public function removeLink($id)
    {

    }
}

