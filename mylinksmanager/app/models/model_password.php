﻿<?php

/********************************************
 * My Links Manager 3.0.2
 * Copyright (c) 2011-2018 Alexander Yanitsky
 * Website: http://janicky.com
 * E-mail: janickiy@mail.ru
 * Skype: janickiy
 ********************************************/

defined('MYLINKSMANAGER') || exit('My Links Manager: access denied!');

class Model_password extends Model
{
    public function changePassword($password) {
        $password = md5(trim($password));

        $update = "UPDATE " . core::database()->getTableName('aut') . " SET password='" . $password . "'";
        return core::database()->querySQL($update);
    }
}