<?php

/********************************************
 * My Links Manager 3.0.0 alfa
 * Copyright (c) 2011-2018 Alexander Yanitsky
 * Website: http://janicky.com
 * E-mail: janickiy@mail.ru
 * Skype: janickiy
 ********************************************/

defined('MYLINKSMANAGER') || exit('My Links Manager: access denied!');

class Model_check_links extends Model
{
    /**
     * @param $id
     * @return array
     */
    public function getArraycat($id)
    {
        if (is_numeric($id)) {
            $query = "SELECT * FROM " . core::database()->getTableName('catalog') . " WHERE id=" . $id . " ORDER BY name";
            $result = core::database()->querySQL($query);

            $arraycat = [];

            while($row = core::database()->getRow($result))
            {
                $arraycat[] = [$row['name'], $row['id']];
            }

            return $arraycat;
        }
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getCatalogById($id)
    {
        if (is_numeric($id)) {
            $query = "SELECT name FROM " . core::database()->getTableName('catalog') . " WHERE id = " . $id;
            $result = core::database()->querySQL($query);
            return core::database()->getRecordCount($result);
        }
    }

    /**
     * @param $cat_id
     * @param $page
     * @param $pnumber
     * @return mixed
     */
    public function getLinksByCatId($cat_id, $page, $pnumber)
    {
        if (is_numeric($cat_id)) {
            core::database()->tablename = "" . core::database()->getTableName('links') . " l LEFT JOIN " . core::database()->getTableName('catalog') . " c ON l.cat_id=c.id";
            core::database()->parameters = "*, c.name AS catname, l.name AS name, l.description AS description";
            core::database()->where = "WHERE  l.cat_id = " . $cat_id . " AND status = 'show'";
            core::database()->order = "ORDER BY l.time";
            core::database()->pnumber = $pnumber;
            core::database()->page = $page;
            return core::database()->get_page();
        }
    }

    public function getTotal()
    {
        core::database()->tablename = core::database()->getTableName('links') . " l LEFT JOIN " . core::database()->getTableName('catalog') . " c ON l.cat_id=c.id";

        $number = intval((core::database()->get_total() - 1) / core::database()->pnumber) + 1;

        return $number;
    }

    public function getPageNumber()
    {
        return core::database()->page;
    }

}