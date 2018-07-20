<?php

/********************************************
 * My Links Manager 3.0.0 alfa
 * Copyright (c) 2011-2018 Alexander Yanitsky
 * Website: http://janicky.com
 * E-mail: janickiy@mail.ru
 * Skype: janickiy
 ********************************************/

defined('MYLINKSMANAGER') || exit('My Links Manager: access denied!');

class Category
{
    /**
     * @param $ParentID
     * @param $lvl
     * @return string
     */
    public static function ShowTree($parent_id, $lvl)
    {
        global $lvl;
        $lvl++;
        global $option;

        $parent_id = core::database()->escape($parent_id);

        $query = "SELECT `id`,`parent_id`,`name` FROM " . core::database()->getTableName('catalog') . "  WHERE parent_id=" . $parent_id;
        $result = core::database()->querySQL($query);

        if (core::database()->getRecordCount($result) > 0){
            while($row = core::database()->getRow($result))
            {
                $query = "SELECT * FROM  " . core::database()->getTableName('catalog') . " WHERE parent_id=" . $row["id"];
                $result2 = core::database()->querySQL($query);

                $indent = '';
                for($c = 1; $c < $lvl; $c++) $indent .= '-';

                if (core::database()->getRecordCount($result2) > 0)
                    $option .= "<option value=" . $row['id'] . " style=\"font-weight: bold; color: graytext;\" disabled=\"disabled\">" . $indent . " " . $row["name"] . "</option>\r\n";
                else
                    $option .= "<option value=" . $row['id'] . " " . ($_POST['cat_id'] == $row['id'] ? ' selected="selected"' : "") . ">" . $indent . " " . $row["name"] . "</option>\r\n";

                self::ShowTree($row["id"], $lvl);
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
    public static function ShowCatalogList($parent_id, $lvl)
    {
        global $lvl;
        $lvl++;
        global $option;

        $parent_id = core::database()->escape($parent_id);

        $query = "SELECT `id`,`parent_id`,`name` FROM " . core::database()->getTableName('catalog') . " WHERE parent_id=" . $parent_id;
        $result = core::database()->querySQL($query);

        if (core::database()->getRecordCount($result) > 0){
            while($row = core::database()->getRow($result))
            {
                $query = "SELECT * FROM " . core::database()->getTableName('catalog') . " WHERE parent_id=" . $row["id"];
                $result2 = core::database()->querySQL($query);

                $indent = '';
                for($c = 1; $c < $lvl; $c++) $indent .= '-';

                if (core::database()->getRecordCount($result2) == 0)
                    $option .= "<option value=" . $row['id'] . " " . ($_REQUEST['id_catalog'] == $row['id'] ? ' selected="selected"' : "") . ">" . $indent . " " . $row["name"] . "</option>\r\n";
                else
                    $option .= "<option value=" . $row['id'] . " " . ($_REQUEST['id_catalog'] == $row['id'] ? ' selected="selected"' : "") . ">" . $indent . " " . $row["name"] . "</option>\r\n";

                self::ShowCatalogList($row["id"], $lvl);
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
        $cat_id = core::database()->escape($cat_id);

        $query = "SELECT `id`,`parent_id`,`name` FROM " . core::database()->getTableName('catalog') . " WHERE parent_id=" . $cat_id . " ORDER BY name";
        $result = core::database()->querySQL($query);

        $i = 0;

        while($row = core::database()->getRow($result))
        {
            $i++;
            $sub_cat .= ', <a href="' . $_SERVER['REQUEST_URI'] . '&cat_id=' . $row['id'] . '">' . $row['name'] . '</a> <span>(' . Links::ShowNumbersLinksSubCat($row['id']) . ')</span>';

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
     * @param $parent_id
     * @param $topbar
     * @return array
     */
    public static function topbarmenu($parent_id, $topbar)
    {
        global $topbar;

        $parent_id = intval($parent_id);

        $query = "SELECT `id`,`parent_id` FROM " . core::database()->getTableName('catalog') . " WHERE id=" . $parent_id;
        $result = core::database()->querySQL($query);

        if (core::database()->getRecordCount($result) > 0){
            $row = core::database()->getRow($result);
            $topbar[] = array($row['cat_id'], $row['name']);

            self::topbarmenu($row["parent_id"], $topbar);
        }

        sort($topbar);
        return $topbar;
    }

    /**
     * @param $parent_id
     * @param $lvl
     * @return string
     */
    public static function CatalogTree($parent_id, $lvl)
    {
        global $lvl;
        $lvl++;
        global $treelist;

        $parent_id = core::database()->escape($parent_id);

        $query = "SELECT `id`,`parent_id`,`name` FROM " . core::database()->getTableName('catalog') . " WHERE parent_id=" . $parent_id . " ORDER BY name";
        $result = core::database()->querySQL($query);

        if (core::database()->getRecordCount($result) > 0){
            if ($lvl == 1)
                $lf_menu = 'class="lf_menu"';
            else
                $lf_menu = '';

            $treelist .= "<ul ". $lf_menu . ">\n";

            while($row = core::database()->getRow($result))
            {
                $ID = $row["id"];

                if ($_GET['cat_id'] == $ID)
                    $ul = "style=\"display: block;\"";
                else
                    $ul = "";

                if ($row['parent_id'] == 0) {
                    $div_class = "menu_1";
                    $name = '<span>' . $row["name"] . '</span> <a title="' . core::getLanguage('str', 'add_subcategory') . '" href="./?a=admin&t=addcategory&id_catalog='.$row['id'].'&id_parent=' . $row['id'] . '"><img border="0" src="/templates/images/add.gif"></a> <a title="' . core::getLanguage('str', 'remove') . '" href="./?a=admin&t=editcategory&id_cat=' . $row['id'] . '"><img border=0 src="/templates/images/edit.gif"></a> <a title="' . core::getLanguage('str', 'remove') . '" href="./?a=admin&t=delcategory&id_cat=' . $row['id'] . '"><img border="0" src="/templates/images/del.gif"></a>';
                } else {
                    if ($_GET['id'] == $ID)
                        $li="class=\"active\"";
                    else
                        $li='';
                    $div_class = "menu_1_1";
                    $name = '' . $row["name"] . ' <a title="' . core::getLanguage('str', 'add_subcategory') . '" href="./?a=admin&t=addcategory&id_catalog=' . $row['id'] . '&id_parent=' . $row['id'] . '"><img border="0" src="images/add.gif"></a> <a title="' . core::getLanguage('str', 'edit') . '" href="./?a=admin&editcategory&id_cat=' . $row['id'] . '"><img border="0" src="/templates/images/edit.gif"></a> <a title="' . core::getLanguage('str', 'remove') . '" href="./?a=admin&t=delcategory&id_cat=' . $row['id'] . '"><img border="0" src="/templates/images/del.gif"></a>';
                }

                $query = "SELECT * FROM " . core::database()->getTableName('catalog') . " WHERE parent_id=" . $ID;
                $result2 = core::database()->querySQL($query);

                if (core::database()->getRecordCount($result2) > 0) {
                    $treelist .= "<li " . $li . ">\n";
                    $treelist .="<div class=" . $div_class . "><div><div><div>" . $name . "</div></div></div></div>\n";
                } else {
                    if ($row['id_parent'] == 0) {
                        $div_class = "menu_2";
                    } else {
                        $div_class = "";
                    }
                    $treelist .= "<li " . $li . ">\n";
                    $treelist .= "<div class=" . $div_class . "><div ><div><div>" . $name . "</div></div></div></div>\n";
                }

                self::CatalogTree($ID, $lvl);
                $lvl--;
            }
            $treelist .= "</ul>\n";
        }

        return $treelist;
    }

    /**
     * @param $parent_id
     * @param $lvl
     * @return string
     */
    public static function ShowCategoryList($parent_id, $lvl)
    {
        global $lvl;
        $lvl++;
        global $option;
        $parent_id = core::database()->escape($parent_id);

        $query = "SELECT `id`,`id_parent`,`name`  FROM " . core::database()->getTableName('catalog') . " WHERE parent_id=" . $parent_id;
        $result = core::database()->querySQL($query);

        if (core::database()->getRecordCount($result) > 0){
            while($row = core::database()->getRow($result))
            {
                $ID = $row["id"];

                $indent = '';
                for($c = 1; $c < $lvl; $c++) $indent .= '-';

                $query = "SELECT * FROM " . core::database()->getTableName('catalog') . " WHERE parent_id=" . $row['id'] . " AND id=" . $_REQUEST['id_cat'];
                $result2 = core::database()->querySQL($query);

                if ($row['id'] != $_REQUEST['id_cat']) $option .= "<option value=" . $row['id'] . " " . (core::database()->getRecordCount($result2) > 0 ? ' selected="selected"' : "") . ">" . $indent . " " . $row["name"] . "</option>\r\n";

                self::ShowCategoryList($ID, $lvl);
                $lvl--;
            }
        }

        return $option;
    }
}