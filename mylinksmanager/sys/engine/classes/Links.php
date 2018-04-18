<?php

/********************************************
 * My Links Manager 3.0.0 alfa
 * Copyright (c) 2011-2018 Alexander Yanitsky
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
    public static function CheckExistsLink($url)
    {
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
    public static function CheckWaitVerification($url)
    {
        if (!empty($url)) {
            $url = core::database()->escape($url);

            $query = "SELECT * FROM " . core::database()->getTableName('links') . " WHERE url RLIKE '^(www\\.)?" . $url . "$' AND status = 'new' OR
												url RLIKE '^(www\\.)?" . $url . "$' AND status = 'hide'";
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

        $query = "SELECT * FROM " . core::database()->getTableName('links') . " WHERE id = " . $parent_id . " AND status='show'";
        $result = core::database()->querySQL($query);

        $numberlinks = $numberlinks + core::database()->getRecordCount($result);

        $query = "SELECT * FROM  " . core::database()->getTableName('catalog') . "  WHERE parent_id=" . $parent_id;
        $result = core::database()->querySQL($query);

        if (core::database()->getRecordCount($result) > 0) {
            while ($row = core::database()->getRow($result)) {
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
    public static function getLinksList($status, $order, $offset, $number = 10)
    {
        if (is_numeric($offset) && is_numeric($number)) {
            $query = "SELECT *,c.name AS catname, l.description AS description, l.id AS id FROM " . core::database()->getTableName('links') . " l
                      LEFT JOIN " . core::database()->getTableName('catalog') . " c ON c.id = l.cat_id
                      WHERE l.status='" . $status . "'
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
    public static function getLinkInfo($id)
    {
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

    /**
     * @param $ParentID
     * @param $lvl
     * @return string
     */
    public static function ShowCatalogList($ParentID, $lvl)
    {
        global $lvl;
        global $option;
        $lvl++;

        $query = "SELECT * FROM " . core::database()->getTableName('catalog') . " WHERE parent_id='$ParentID'";
        $result = core::database()->querySQL($query);

        if (core::database()->getRecordCount($result) > 0) {

            while ($row = core::database()->getRow($result)) {
                $ID = $row["id_cat"];
                $selected = $_REQUEST['catalog_id'] == $row['id'] ? ' selected="selected"' : "";

                $query = "SELECT * FROM " . core::database()->getTableName('catalog') . " WHERE parent_id='$ID'";
                $result2 = core::database()->querySQL($query);

                $indent = '';

                for ($c = 1; $c < $lvl; $c++) $indent .= '-';

                if (core::database()->getRecordCount($result2) == 0)
                    $option .= "<option value=" . $row['id'] . " " . $selected . ">" . $indent . " " . $row["name"] . "</option>\r\n";
                else
                    $option .= "<option value=" . $row['id'] . " " . $selected . ">" . $indent . " " . $row["name"] . "</option>\r\n";

                self::ShowCatalogList($ID, $lvl);

                $lvl--;
            }
        }

        return $option;
    }

    /**
     * @param $ParentID
     * @param $lvl
     * @return string
     */
    public static function CatalogTree($ParentID, $lvl)
    {
        global $lvl;
        global $treelist;
        $lvl++;

        $query = "SELECT * FROM " . core::database()->getTableName('catalog') . " WHERE parent_id='$ParentID' ORDER BY name";
        $result = core::database()->querySQL($query);

        if (core::database()->getRecordCount($result) > 0) {

            if ($lvl == 1)
                $lf_menu = 'class="lf_menu"';
            else
                $lf_menu = '';

            $treelist .= "<ul $lf_menu>\n";

            while ($row = core::database()->getRow($result)) {

                $ID = $row["id"];

                if ($_GET['id'] == $ID)
                    $ul = "style=\"display: block;\"";
                else
                    $ul = "";

                if ($row['id_parent'] == 0) {
                    $div_class = "menu_1";
                    $name = '<span>' . $row["name"] . '</span> <a title="' . core::getLanguage('str', 'add_subcategory') . '" href="./?a=admin&t=addcategory&catalog_id=' . $row['id'] . '&parent_id=' . $row['id'] . '"><span class="fa fa-plus"></span> <a title="' . core::getLanguage('str', 'edit') . '" href="./?a=admin&t=editcategory&id=' . $row['id'] . '"><span class="fa fa-pencil"></span> <a title="' . core::getLanguage('str', 'remove') . '" href="./?a=admin&t=categories&action=remove&id=' . $row['id'] . '"><span class="fa fa-trash-o"></span></a>';
                } else {
                    if ($_GET['id'] == $ID)
                        $li = "class=\"active\"";
                    else
                        $li = '';
                    $div_class = "menu_1_1";
                    $name = '' . $row["name"] . ' <a title="' . core::getLanguage('str', 'add_subcategory') . '" href="./?a=admin&t=addcategory&catalog_id=' . $row['id'] . '&parent_id=' . $row['id'] . '"><span class="fa fa-plus"></span> <a title="' . core::getLanguage('str', 'edit') . '" href="./?a=admin&t=editcategory&id=' . $row['id'] . '"><span class="fa fa-pencil"></span> <a title="' . core::getLanguage('str', 'remove') . '" href="./?a=admin&t=categories&action=remove&id=' . $row['id'] . '"><span class="fa fa-trash-o"></span></a>';
                }

                $query = "SELECT * FROM " . core::database()->getTableName('catalog') . " WHERE parent_id='$ID'";
                $result2 = core::database()->querySQL($query);

                if (core::database()->getRecordCount($result2) > 0) {
                    $treelist .= "<li $li>\n";
                    $treelist .= "<div class=$div_class><div><div><div>$name</div></div></div></div>\n";
                } else {
                    if ($row['parent_id'] == 0) {
                        $div_class = "menu_2";
                    } else {
                        $div_class = "";
                    }

                    $treelist .= "<li $li>\n";
                    $treelist .= "<div class=$div_class><div ><div><div>$name</div></div></div></div>\n";
                }

                self::CatalogTree($ID, $lvl);
                $lvl--;
            }

            $treelist .= "</ul>\n";
        }

        return $treelist;

    }

    /**
     * @param $ParentID
     * @param $lvl
     * @return string
     */
    public static function ShowCategoryList($ParentID, $lvl)
    {
        global $lvl;
        global $option;
        $lvl++;

        $query = "SELECT * FROM " . core::database()->getTableName('catalog') . " WHERE parent_id='$ParentID'";
        $result = core::database()->querySQL($query);

        if (core::database()->getRecordCount($result) > 0) {
            while ($row = core::database()->getRow($result)) {
                $ID = $row["id"];

                $indent = '';
                for ($c = 1; $c < $lvl; $c++) $indent .= '-';

                $query = "SELECT * FROM " . core::database()->getTableName('catalog') . " WHERE parent_id=" . $row['id'] . " AND id=" . $_REQUEST['id'];
                $result2 = core::database()->querySQL($query);

                $selected = core::database()->getRecordCount($result2) > 0 ? ' selected="selected"' : "";

                if ($row['id'] != $_REQUEST['id']) $option .= "<option value=" . $row['id'] . " " . $selected . ">" . $indent . " " . $row["name"] . "</option>\r\n";

                self::ShowCategoryList($ID, $lvl);

                $lvl--;
            }
        }

        return $option;
    }

    /**
     * @param $cat_id
     * @param $limit
     * @return bool|string
     */
    public static function ShowSubCat($cat_id, $limit)
    {
        $sub_cat = '';

        $query = "SELECT * FROM " . core::database()->getTableName('catalog') . " WHERE parent_id=" . $cat_id . " ORDER BY name";
        $result = core::database()->querySQL($query);

        $i = 0;

        while ($row = core::database()->getRow($result)) {
            $i++;

            $sub_cat .= ', <a href="http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'] . '&id=' . $row['id'] . '">' . $row['name'] . '</a> <span>(' . self::ShowNumbersLinksSubCat($row['id']) . ')</span>';

            if ($limit == $i && $limit != 0) {
                $sub_cat .= ' ...';
                break;
            }
        }

        if (substr($sub_cat, 0, 1) == ",") $sub_cat = substr($sub_cat, 1);
        $sub_cat = trim($sub_cat);

        return $sub_cat;
    }

    /**
     * @param $ParentID
     * @param $topbar
     * @return array
     */
    public static function topbarmenu($ParentID, $topbar)
    {
        global $topbar;

        $query = "SELECT * FROM " . core::database()->getTableName('catalog') . " WHERE id='$ParentID'";
        $result = core::database()->querySQL($query);

        if (core::database()->getRecordCount($result) > 0) {
            $row = core::database()->getRow($result);

           $ID = $row["parent_id"];
           $topbar[] = [$row['id'], $row['name']];

           self::topbarmenu($ID, $topbar);
        }

        sort($topbar);
        return $topbar;
    }
}