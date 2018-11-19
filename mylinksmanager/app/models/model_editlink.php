<?php

/********************************************
 * My Links Manager 3.0.2
 * Copyright (c) 2011-2018 Alexander Yanitsky
 * Website: http://janicky.com
 * E-mail: janickiy@mail.ru
 * Skype: janickiy
 ********************************************/

defined('MYLINKSMANAGER') || exit('My Links Manager: access denied!');

class Model_editlink extends Model
{
    /**
     * @param $id
     * @return mixed
     */
    public function getLink($id)
    {
        if (is_numeric($id)) {
            $query = "SELECT * FROM " . core::database()->getTableName('links') . " WHERE id=" . $id;
            $result = core::database()->querySQL($query);
            return core::database()->getRow($result);
        }
    }

    /**
     * @param $fields
     * @param $id
     * @return mixed
     */
    public function editLink($fields, $id)
    {
        if (is_numeric($id)){
            return core::database()->update($fields, core::database()->getTableName('links'), "id=" . $id);
        }
    }
}