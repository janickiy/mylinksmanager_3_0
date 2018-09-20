<?php

/********************************************
 * My Links Manager 3.0.2
 * Copyright (c) 2011-2018 Alexander Yanitsky
 * Website: http://janicky.com
 * E-mail: janickiy@mail.ru
 * Skype: janickiy
 ********************************************/

defined('MYLINKSMANAGER') || exit('My Links Manager: access denied!');

class Model_links extends Model
{
    /**
     * @param $strtmp
     * @param $search
     * @param $category
     * @param $page
     * @param $pnumber
     * @return mixed
     */
    public function getLinksArray($page, $pnumber, $strtmp)
    {
        core::database()->tablename = core::database()->getTableName('links') . " l LEFT JOIN " . core::database()->getTableName('catalog') . " c ON c.id=l.cat_id";

        $search = trim(urldecode(Core_Array::getRequest('search')));
        $category = core::database()->escape(Core_Array::getRequest('category'));

        if ($search) {
            $_search = core::database()->escape($search);
            $temp = strtok($_search, " ");
            $temp = "%" . $temp . "%";
            $logstr = "or";
            $tmpl = null;
            $is_query = null;

            while ($temp) {
                if ($is_query)
                    $tmpl .= " $logstr (l.name LIKE '" . $temp . "' OR l.email LIKE '" . $temp . "' OR l.url LIKE '" . $temp . "' OR l.reciprocal_link LIKE '" . $temp . "' OR l.keywords LIKE '" . $temp . "' OR l.description LIKE '" . $temp . "' OR l.full_description LIKE '" . $temp . "') ";
                else
                    $tmpl .= "(l.name LIKE '" . $temp . "' OR l.email LIKE '" . $temp . "' OR l.url LIKE '" . $temp . "' OR l.reciprocal_link LIKE '" . $temp . "' OR l.keywords LIKE '" . $temp . "' OR l.description LIKE '" . $temp . "' OR l.full_description LIKE '" . $temp . "') ";

                $is_query = true;
                $temp = strtok(" ");
            }

            core::database()->parameters = "l.*, c.name AS category";
            core::database()->where = "WHERE " . $tmpl . "";
            core::database()->group = "GROUP BY l.id";
            core::database()->order = "ORDER BY l.name";
        } elseif (is_numeric($category)) {
            core::database()->tablename = core::database()->getTableName('links') . " l LEFT JOIN " . core::database()->getTableName('catalog') . " c ON c.id=l.cat_id";
            $_where = (isset($category) && $category > 0) ? "c.cat_id=" . $category . " " : "1";
            core::database()->parameters = "*,c.name AS category";
            core::database()->where = "WHERE " . $_where . " ";
            core::database()->order = "ORDER BY l.name";
        } else {
            core::database()->parameters = "l.*, c.name AS category";
            core::database()->order = "ORDER BY l." . $strtmp . "";
        }

        core::database()->pnumber = $pnumber;
        core::database()->page = $page;

        return core::database()->get_page();
    }

    /**
     * @return int
     */
    public function getTotal()
    {
        core::database()->tablename = core::database()->getTableName('links') . " l LEFT JOIN " . core::database()->getTableName('catalog') . " c ON l.cat_id=c.id";
        $number = intval((core::database()->get_total() - 1) / core::database()->pnumber) + 1;

        return $number;
    }

    /**
     * @return mixed
     */
    public function getPageNumber()
    {
        return core::database()->page;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function removeLink($id)
    {
        if (is_numeric($id)) {
            return core::database()->delete(core::database()->getTableName('links'), "id=" . $id);
        }
    }

    /**
     * @param $activate
     * @param string $action
     * @return mixed
     */
    public function updateLinks($activate, $action = 'show')
    {
        $temp = [];
        $fields = [];

        foreach ($activate as $id) {
            if (is_numeric($id))
                $temp[] = $id;
        }

        $fields['status'] = ($action == 'show') ? 'show' : 'black';
        $where = "id IN (" . implode(",", $temp) . ")";
        $table = core::database()->getTableName('links');
        $result = core::database()->update($fields, $table, $where);
        unset($temp);

        return $result;
    }

    /**
     * @param $activate
     * @return mixed
     */
    public function deleteLinks($activate)
    {
        $temp = [];

        foreach ($activate as $id) {
            if (is_numeric($id)) {
                $temp[] = $id;
            }
        }

        return core::database()->delete(core::database()->getTableName('links'), "id IN (" . implode(",", $temp) . ")");

    }

    public function checkLinks($activate)
    {
        $temp = [];

        foreach ($activate as $id) {
            if (is_numeric($id)) {
                $temp[] = $id;
            }
        }

        $result = core::database()->delete(core::database()->getTableName('links'), "id IN (" . implode(",", $temp) . ")");

        while ($row = core::database()->getRow($result)) {

            if ( Helper::checkUrlLink($row['reciprocal_link'], core::getSetting('url'))) {
                if ($row['status'] == "hide"){
                    if (core::getSetting('add_to_blacklist') == "yes") {

                        $fields = [
                            "status" => 'black',
                            "time_check" => date("Y-m-d H:i:s"),
                            "reason" => core::getLanguage('msg','reason_absense_reciprocal'),
                        ];

                        $result = core::database()->update($fields, core::database()->getTableName('links'), "id=" . $row['id']);
                    }
                    else{
                        $result = core::database()->delete(core::database()->getTableName('links'), "id=" . $row['id'], '');
                    }

                    if ($result){

                        // Notify the user about his link was removed
                        Helper::sendmail_del_link($row, core::getLanguage('str','subject_del'));

                    }
                } else {
                    // Check on, whether the page of answer link for index by metatag <meta name=robot>
                    if (Helper::checkMeta($row['reciprocal_link'])) {
                        if (core::getSetting('add_to_blacklist') == "yes"){

                            $fields = [
                                "status" => 'black',
                                "time_check" => date("Y-m-d H:i:s"),
                                "reason" => core::getLanguage('msg','reason_closed_for_index_meta'),
                            ];

                            $result = core::database()->update($fields, core::database()->getTableName('links'), "id=" . $row['id']);
                        }
                        else{
                            $result = core::database()->delete(core::database()->getTableName('links'), "id=" . $row['id'], '');
                        }

                        if ($result) {
                            // Notify the user about his link was removed
                            Helper::sendmail_del_link($row, core::getLanguage('str', 'subject_del'));
                        }
                    } else {
                        // Check on, whether the directory with answer link is closed for index
                        if (Helper::check_robots($row['reciprocal_link'])){
                            if (core::getSetting('add_to_blacklist') == "yes") {
                            $fields = [
                                "status" => 'black',
                                "time_check" => date("Y-m-d H:i:s"),
                                "reason" => core::getLanguage('msg','reason_closed_for_index_robot'),
                            ];

                            $result = core::database()->update($fields, core::database()->getTableName('links'), "id=" . $row['id']);

                            }  else{
                                $result = core::database()->delete(core::database()->getTableName('links'), "id=" . $row['id'], '');
                            }

                            if ($result){
                                // Notify the user about his link was removed
                                Helper::sendmail_del_link($row, STR_SUBJECT_DEL);
                            }
                        } else {
                           $fields = [
                                "status" => 'show',
                                "time_check" => date("Y-m-d H:i:s"),
                                "reason" => '',
                                "number_check" => 0,
                            ];

                            $result = core::database()->update($fields, core::database()->getTableName('links'), "id=" . $row['id']);

                            if ($result){
                                // Notify the user about his link was restored
                                Helper::sendMailAdd($row, core::getLanguage('str','link_added'));
                            }
                        }
                    }
                }
            }
        }

        return true;
    }
}