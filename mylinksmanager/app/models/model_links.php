<?php

/********************************************
 * My Links Manager 3.0.0 alfa
 * Copyright (c) 2011-2018 Alexander Yanitsky
 * Website: http://janicky.com
 * E-mail: janickiy@mail.ru
 * Skype: janickiy
 ********************************************/

defined('MYLINKSMANAGER') || exit('My Links Manager: access denied!');

class Model_links extends Model
{
    public function getLinksArray($strtmp, $search, $category, $page, $pnumber)
    {
        core::database()->tablename = core::database()->getTableName('links') . " l LEFT JOIN " . core::database()->getTableName('catalog') . " c ON c.id=l.cat_id";

        if ($search) {
            $_search = core::database()->escape($search);

            $temp = strtok($_search, " ");
            $temp = "%" . $temp . "%";
            $logstr = "or";
            $tmpl = null;
            $is_query = null;

            while ($temp) {
                if ($is_query)
                    $tmpl .= " $logstr (l.name LIKE '" . $temp . "' OR l.email LIKE '" . $temp . "' OR l.url LIKE '" . $temp . "' OR l.reciprocal_link LIKE '" . $temp . "' OR l.keywords LIKE '" . $temp . "' OR l.description LIKE '" . $temp . "' OR l.full_description LIKE '" . $temp . "') ";
                else
                    $tmpl .= "(l.name LIKE '" . $temp . "' OR l.email LIKE '" . $temp . "' OR l.url LIKE '" . $temp . "' OR l.reciprocal_link LIKE '" . $temp . "' OR l.keywords LIKE '" . $temp . "' OR l.description LIKE '" . $temp . "' OR l.full_description LIKE '" . $temp . "') ";

                $is_query = true;
                $temp = strtok(" ");
            }

            core::database()->parameters = "l.*, c.name AS category";
            core::database()->where = "WHERE " . $tmpl . "";
            core::database()->group = "GROUP BY l.id";
            core::database()->order = "ORDER BY l.name";
        } elseif (is_numeric($category)) {
            core::database()->tablename = core::database()->getTableName('links') . " l LEFT JOIN " . core::database()->getTableName('catalog') . " c ON c.id=l.cat_id";
            $_where = (isset($category) && $category > 0) ? "c.cat_id=" . $category . " " : "1";
            core::database()->parameters = "*,c.name AS category";
            core::database()->where = "WHERE " . $_where . " ";
            core::database()->order = "ORDER BY l.name";
        } else {
            core::database()->parameters = "l.*, c.name AS category";
            core::database()->order = "ORDER BY l." . $strtmp . "";
        }

        core::database()->pnumber = $pnumber;
        core::database()->page = $page;

        return core::database()->get_page();
    }

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
}