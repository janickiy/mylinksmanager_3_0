<?php

/********************************************
 * My Links Manager 3.0.1 beta
 * Copyright (c) 2011-2018 Alexander Yanitsky
 * Website: http://janicky.com
 * E-mail: janickiy@mail.ru
 * Skype: janickiy
 ********************************************/

defined('MYLINKSMANAGER') || exit('My Links Manager: access denied!');

class Model_editcategory extends Model
{
    /**
     * @param $id
     * @return mixed
     */
    public function getCategoryRow($id)
    {
        if (is_numeric($id)) {
            $query = "SELECT * FROM " . core::database()->getTableName('catalog') . " WHERE id=" . $id;
            $result = core::database()->querySQL($query);
            return core::database()->getRow($result);
        }
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getTotal($id)
    {
        if (is_numeric($id)) {
            $query = "SELECT * FROM ".core::database()->getTableName('catalog')." WHERE id=" . $id;
            $result = core::database()->querySQL($query);
            return core::database()->getRecordCount($result);
        }
    }

    /**
     * @param $fields
     * @param $id
     */
    public function editCategory($fields, $id)
    {
        if (is_numeric($id)){
            return core::database()->update($fields, core::database()->getTableName('catalog'), "id=" . $id);
        }
    }
}