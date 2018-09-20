<?php

/********************************************
 * My Links Manager 3.0.2
 * Copyright (c) 2011-2018 Alexander Yanitsky
 * Website: http://janicky.com
 * E-mail: janickiy@mail.ru
 * Skype: janickiy
 ********************************************/

defined('MYLINKSMANAGER') || exit('My Links Manager: access denied!');

class Model_edit extends Model
{
    /**
     * @param $id
     * @param $token
     * @return bool
     */
    public function checkKey($id, $token)
    {
        $check = false;

        if (is_numeric($id) && $token) {
            $token = core::database()->escape($token);
            $query = "SELECT * FROM " . core::database()->getTableName('links') . " WHERE id= " . $id . " AND token='" . $token . "'";
            $result = core::database()->querySQL($query);

            if (core::database()->getRecordCount($result) > 0) $check = true;
        }

        return $check;
    }

    /**
     * @param $fields
     * @param $id
     * @return mixed
     */
    public function editLink($fields,$id)
    {
        if (is_numeric($id)) {
            return core::database()->update($fields, core::database()->getTableName('links'), "id=" . $id);
        }
    }
}