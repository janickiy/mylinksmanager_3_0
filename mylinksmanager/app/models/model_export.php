<?php

/********************************************
 * My Links Manager 3.0.0 alfa
 * Copyright (c) 2011-2018 Alexander Yanitsky
 * Website: http://janicky.com
 * E-mail: janickiy@mail.ru
 * Skype: janickiy
 ********************************************/

defined('MYLINKSMANAGER') || exit('My Links Manager: access denied!');

class Model_export extends Model
{
    public function getLinks()
    {
        $query = "SELECT * FROM " . core::database()->getTableName('links') . " WHERE status='show'";
        $result = core::database()->querySQL($query);
        return core::database()->getColumnArray($result);
    }
}