<?php

/********************************************
 * My Links Manager 3.0.0 alfa
 * Copyright (c) 2011-2018 Alexander Yanitsky
 * Website: http://janicky.com
 * E-mail: janickiy@mail.ru
 * Skype: janickiy
 ********************************************/

defined('MYLINKSMANAGER') || exit('My Links Manager: access denied!');

class Model_categories extends Model
{
    /**
     * @param $id
     *
     */
    public function delCategory($id)
    {
        if (is_numeric($id)) {
            $query = "SELECT * FROM " . core::database()->getTableName('catalog') . " WHERE parent_id = " . $id;
            $result = core::database()->querySQL($query);

            while ($row = core::database()->getRow($result)) {
                $result = core::database()->delete(core::database()->getTableName('links'), "cat_id=" . $id, '');

                if ($result) $this->delCategory($row['id']);
            }

            $result = core::database()->delete(core::database()->getTableName('catalog'), "id=" . $id, '');

            if ($result) $this->delCategory($_GET['id_cat']);
        }
    }
}