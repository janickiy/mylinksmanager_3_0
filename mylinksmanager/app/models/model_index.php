<?php

/********************************************
 * My Links Manager 3.0.0 alfa
 * Copyright (c) 2011-2018 Alexander Yanitsky
 * Website: http://janicky.com
 * E-mail: janickiy@mail.ru
 * Skype: janickiy
 ********************************************/

defined('MYLINKSMANAGER') || exit('My Links Manager: access denied!');

class Model_index extends Model
{
    /**
     * @param $id
     * @return array
     */
    public function getCatalogList($id)
    {
        if (is_numeric($id)) {
            $query = "SELECT c.name,c.id,c.image,COUNT(l.status) AS number_links FROM " . core::database()->getTableName('catalog') . " c LEFT JOIN  " . core::database()->getTableName('links') . " l ON c.id=l.cat_id AND l.status='show'
            WHERE c.parent_id=" . $id . " GROUP BY c.id ORDER BY c.name";

            $result = core::database()->querySQL($query);

            $arraycat = [];

            while($row = core::database()->getRow($result))
            {
                $arraycat[] = array($row['name'], $row['id'], $row['image'], $row['number_links']);
            }

            return $arraycat;
        }
    }

    /**
     * @param $page
     * @param $pnumber
     * @return mixed
     */
    public function getLinks($page, $pnumber)
    {
        core::database()->tablename = core::database()->getTableName('links') . " l LEFT JOIN " . core::database()->getTableName('catalog') . " c ON c.id=l.cat_id";

        $logstr = Core_Array::getRequest('logic');
        $search = core::database()->escape(Core_Array::getRequest('search'));
        $category = core::database()->escape(Core_Array::getRequest('catalog_id'));

        if ($search) {
            $_search = $search;
            $temp = strtok($_search, " ");
            $temp = "%" . $temp . "%";
            $logstr = $logstr ? "AND" : "OR";
            $tmp = null;
            $is_query = null;

            while ($temp) {
                if ($is_query)
                    $tmp .= " $logstr (l.name LIKE '" . $temp . "' OR l.email LIKE '" . $temp . "' OR l.url LIKE '" . $temp . "' OR l.reciprocal_link LIKE '" . $temp . "' OR l.keywords LIKE '" . $temp . "' OR l.description LIKE '" . $temp . "' OR l.full_description LIKE '" . $temp . "') ";
                else
                    $tmp .= "(l.name LIKE '" . $temp . "' OR l.email LIKE '" . $temp . "' OR l.url LIKE '" . $temp . "' OR l.reciprocal_link LIKE '" . $temp . "' OR l.keywords LIKE '" . $temp . "' OR l.description LIKE '" . $temp . "' OR l.full_description LIKE '" . $temp . "') ";

                $is_query = true;
                $temp = strtok(" ");
            }

            core::database()->parameters = "l.*, c.name AS category";
            core::database()->where = "WHERE " . ($category ? "(l.status='show' AND l.id_cat=$category)" : "l.status='show'") . "  " . ((!empty($tmp)) ? 'AND' : '') . " " . $tmp . "";
            core::database()->group = "GROUP BY l.id";
            core::database()->order = "ORDER BY l.name";
        } else {
            core::database()->parameters = "l.*, c.name AS category";
            core::database()->where = "WHERE " . ($category ? "(l.status='show' AND l.id_cat=$category)" : "l.status='show'") . "";
            core::database()->order = "ORDER BY l.id DESC";
        }

        core::database()->pnumber = $pnumber;
        core::database()->page = $page;

        return core::database()->get_page();
    }

    /**
     * @return int
     */
    public function getTotal()
    {
        core::database()->tablename = core::database()->getTableName('links') . " l LEFT JOIN " . core::database()->getTableName('catalog') . " c ON l.cat_id=c.id";

        $number = intval((core::database()->get_total() - 1) / core::database()->pnumber) + 1;

        return $number;
    }

    /**
     * @return mixed
     */
    public function getPageNumber()
    {
        return core::database()->page;
    }

    /**
     * @param $link_id
     * @return mixed
     */
    public function countView($link_id)
    {
        if (is_numeric($link_id)) {
            $fields = [
                'views' => 'count + 1',
            ];

            return core::database()->update($fields, core::database()->getTableName('links'), "id=" . $link_id);
        }
    }
}