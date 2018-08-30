<?php

/********************************************
 * My Links Manager 3.0.1 beta
 * Copyright (c) 2011-2018 Alexander Yanitsky
 * Website: http://janicky.com
 * E-mail: janickiy@mail.ru
 * Skype: janickiy
 ********************************************/

defined('MYLINKSMANAGER') || exit('My Links Manager: access denied!');

class Model_settings extends Model
{
    public function updateSettings($fields)
    {
        if (core::database()->update($fields, core::database()->getTableName('settings'), ''))
            return true;
        else
            return false;
    }
}