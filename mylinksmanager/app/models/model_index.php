<?php

/********************************************
 * My Links Manager 3.0.0 alfa
 * Copyright (c) 2011-2018 Alexander Yanitsky
 * Website: http://janicky.com
 * E-mail: janickiy@mail.ru
 * Skype: janickiy
 ********************************************/

defined('MYLINKSMANAGER') || exit('My Links Manager: access denied!');

class Model_index extends Model
{
    public function getCatalogList($id)
    {
        if (is_numeric($id)) {
            $query = "SELECT name,id FROM " . core::database()->getTableName('catalog') . " WHERE parent_id=" . $id . " ORDER BY name";
            $result = core::database()->querySQL($query);

            $arraycat = [];

            while($row = core::database()->getRow($result))
            {
                $arraycat[] = array($row['name'], $row['id']);
            }

            return $arraycat;
        }
    }
}