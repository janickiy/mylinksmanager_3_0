<?php

/********************************************
 * My Links Manager 3.0.2
 * Copyright (c) 2011-2018 Alexander Yanitsky
 * Website: http://janicky.com
 * E-mail: janickiy@mail.ru
 * Skype: janickiy
 ********************************************/

defined('MYLINKSMANAGER') || exit('My Links Manager: access denied!');

class Model_addcategory extends Model
{
    /**
     * @param $fields
     * @return mixed
     */
    public function addCategory($fields)
    {
        return core::database()->insert($fields, core::database()->getTableName('catalog'));
    }
}