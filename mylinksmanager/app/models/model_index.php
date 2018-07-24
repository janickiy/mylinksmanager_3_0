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
    /**
     * @param $id
     * @return array
     */
    public function getCatalogList($id)
    {
        if (is_numeric($id)) {
            $query = "SELECT c.name,c.id,c.image,COUNT(l.status) AS number_links FROM " . core::database()->getTableName('catalog') . " c LEFT JOIN  " . core::database()->getTableName('links') . " l ON c.id=l.cat_id AND l.status='show'
            WHERE c.parent_id=" . $id . " GROUP BY c.id ORDER BY c.name";

            $result = core::database()->querySQL($query);

            $arraycat = [];

            while($row = core::database()->getRow($result))
            {
                $arraycat[] = array($row['name'], $row['id'], $row['image'], $row['number_links']);
            }

            return $arraycat;
        }
    }

    /**
     * @param int $limit
     * @return mixed
     */
    public function getLastAddedLinks($limit = 10)
    {
        $query = "SELECT *, c.name AS catname, l.description AS description, l.keywords AS keywords, l.name AS name FROM " . core::database()->getTableName('links') . " l LEFT JOIN " . core::database()->getTableName('catalog') . " c ON l.cat_id=c.id
						WHERE l.status='show'
						ORDER BY l.created DESC
						LIMIT " . $limit;

        $result = core::database()->querySQL($query);
        return core::database()->getColumnArray($result);
    }

    /**
     * @param $link_id
     * @return mixed
     */
    public function countView($link_id)
    {
        if (is_numeric($link_id)) {
            $fields = [
                'views' => 'count + 1',
            ];

            return core::database()->update($fields, core::database()->getTableName('links'), "id=" . $link_id);
        }
    }
}