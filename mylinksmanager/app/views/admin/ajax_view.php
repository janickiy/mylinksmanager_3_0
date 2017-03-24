<?php

/********************************************
 * My Links Manager 3.0.0 alfa
 * Copyright (c) 2011-2017 Alexander Yanitsky
 * Website: http://janicky.com
 * E-mail: janickiy@mail.ru
 * Skype: janickiy
 ********************************************/

defined('MYLINKSMANAGER') || exit('My Links Manager: access denied!');

switch (Core_Array::getGet('action'))
{
    case 'alert_update':


        break;

    case 'get_black_list':

        $number = isset($_REQUEST['number']) && is_numeric($_REQUEST['number']) ? $_REQUEST['number'] : exit();
        $offset = isset($_REQUEST['offset']) && is_numeric($_REQUEST['offset']) ? $_REQUEST['offset'] : exit();

        $arrs = Links::getLinksList('black','desc',$offset,$number);

        if (is_array($arrs)) {
            foreach($arrs as $row) {
                $rows[] = [




                    "id" => $row['id'],
                    "description" => $row['description'],
                    "banner" => $row['htmlcode_banner'],
                    "name" => $row['name'],
                    "url" => $row['url'],
                    "email" => $row['email'],
                    "catname" => $row['catname'],
                    "reason" => $row['reason'],
                    "time" => $row['time'],
                ];
            }

            if (isset($rows)) {
                $content = '{"item":' . json_encode($rows) . '}';
                Pnl::showJSONContent($content);
            }
        }

        break;
}