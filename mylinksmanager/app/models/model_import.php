<?php

/********************************************
 * My Links Manager 3.0.2
 * Copyright (c) 2011-2018 Alexander Yanitsky
 * Website: http://janicky.com
 * E-mail: janickiy@mail.ru
 * Skype: janickiy
 ********************************************/

defined('MYLINKSMANAGER') || exit('My Links Manager: access denied!');

class Model_import extends Model
{
    public function importFromExcel()
    {
        core::requireEx('libs', "PHPExcel/PHPExcel/IOFactory.php");

        $count = 0;

        if ($_FILES['file']['tmp_name']) {

            $objPHPExcel = PHPExcel_IOFactory::load($_FILES['file']['tmp_name']);
            $sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);

            foreach($sheetData as $d) {
                $name = trim($d['A']);
                $url = trim($d['B']);
                $reciprocal_link = trim($d['C']);
                $email = trim($d['D']);
                $keywords = trim($d['E']);
                $description = trim($d['F']);
                $full_description = trim($d['G']);
                $htmlcode_banner = trim($d['H']);
                $categories = trim($d['I']);

                $arr = explode('/', trim($categories));
                $n_arr = [];

                $parent_id = 0;

                for($i = 0; $i < count($arr); $i++) {
                    $parent_id = $this->importCategory(trim($arr[$i]), $parent_id);
                    $n_arr[$i] = ['name' => $arr[$i], 'id' => $parent_id];
                }

                $category = array_pop($n_arr);

                if ($name && $url && $description && $full_description) {
                    // Cut out http:// from url of site
                    if (!empty($url)){
                        if (substr($url, 0, 7) == "http://") $url = str_replace('http://', '', $url);
                        if (substr($url, 0, 8) == "https://") $url = str_replace('https://', '', $url);
                        if (strpos($url, '/') > 0) list($url) = explode('/', $url);
                    }

                    // Cut out http:// from url address of reciprocal link
                    if (!empty($reciprocal_link)){
                        if (substr(strtolower($reciprocal_link), 0, 7) == "http://") $reciprocal_link = str_replace('http://', '', $reciprocal_link);
                        if (substr(strtolower($reciprocal_link), 0, 8) == "https://") $reciprocal_link = str_replace('https://', '', $reciprocal_link);
                    }

                    $src_url = $url;

                    if (substr($url, 0, 4) == "www.") $src_url = str_replace('www.', '', $src_url);
                    $src_url = str_replace('.', '\\.', $src_url);

                    $query = "SELECT * FROM  " . core::database()->getTableName('links') . "  WHERE url RLIKE '^(www\\.)?" . $src_url . "$'";
                    $result = core::database()->querySQL($query);

                    if (core::database()->getRecordCount($result) == 0) {
                        $fields = [
                            'id' => 0,
                            'name' => $name,
                            'url'  => $url,
                            'reciprocal_link' => $reciprocal_link,
                            'email'   => $email,
                            'created' => date("Y-m-d H:i:s"),
                            'time_check'  => '0000-00-00 00:00:00',
                            'keywords'    => $keywords,
                            'description' => $description,
                            'full_description' => $full_description,
                            'htmlcode_banner'  => $htmlcode_banner,
                            'cat_id' => $category['id'],
                            'status' => 'show',
                            'token'  => Helper::getRandomCode(),
                            'check_link' => 'yes',
                        ];

                        $insert_id = core::database()->insert($fields, core::database()->getTableName('links'));

                        if ($insert_id) $count++;
                    }
                }
            }
        }

        return $count;
    }

    /**
     * @param $name
     * @param int $parent_id
     * @return mixed
     */
    public function importCategory($name, $parent_id = 0)
    {
        if (!empty($name) && is_numeric($parent_id)) {
            $query = "SELECT `id` FROM " . core::database()->getTableName('catalog') . " WHERE name LIKE '" . $name ."' AND parent_id=" . $parent_id;
            $result = core::database()->querySQL($query);

            if (core::database()->getRecordCount($result) > 0) {
                $row = core::database()->getRow($result);
                return $row['id'];
            } else {
                if ($name) {
                    $fields = [
                        'id' => 0,
                        'name' => $name,
                        'parent_id' => $parent_id,
                    ];

                    return core::database()->insert($fields, core::database()->getTableName('catalog'));
                }
            }
        }
    }
}