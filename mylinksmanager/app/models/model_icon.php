<?php

/********************************************
 * My Links Manager 3.0.0 alfa
 * Copyright (c) 2011-2018 Alexander Yanitsky
 * Website: http://janicky.com
 * E-mail: janickiy@mail.ru
 * Skype: janickiy
 ********************************************/

defined('MYLINKSMANAGER') || exit('My Links Manager: access denied!');

class Model_icon extends Model
{
    /**
     * @param $cat_id
     * @return mixed
     */
    public function getIcon($cat_id)
    {
        if (is_numeric($cat_id)) {
            $query = "SELECT * FROM " . core::database()->getTableName('catalog') . " WHERE id=" . $cat_id;
            $result = core::database()->querySQL($query);

            return core::database()->getRow($result);
        }
    }
}