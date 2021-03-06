<?php

/********************************************
 * My Links Manager 3.0.2
 * Copyright (c) 2011-2018 Alexander Yanitsky
 * Website: http://janicky.com
 * E-mail: janickiy@mail.ru
 * Skype: janickiy
 ********************************************/

defined('MYLINKSMANAGER') || exit('My Links Manager: access denied!');

switch (Core_Array::getGet('action'))
{
    case 'alert_update':

        $update = new Update(core::getSetting("language"), VERSION);

        if ($update->checkNewVersion()) {
            $update_warning = str_replace('%SCRIPTNAME%', core::getLanguage('str', 'script_name'), core::getLanguage('str', 'update_warning'));
            $update_warning = str_replace('%VERSION%', $update->getVersion(), $update_warning);
            $update_warning = str_replace('%CREATED%', $update->getCreated(), $update_warning);
            $update_warning = str_replace('%DOWNLOADLINK%', $update->getDownloadLink(), $update_warning);
            $update_warning = str_replace('%MESSAGE%', $update->getMessage(), $update_warning);
            $content = array("msg" => $update_warning);

            Helper::showJSONContent(json_encode($content));
        }

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
                    "created" => $row['created'],
                ];
            }

            if (isset($rows)) {
                $content = '{"item":' . json_encode($rows) . '}';
                Pnl::showJSONContent($content);
            }
        }

        break;

    case 'check_add_link':

        $url = Core_Array::getRequest('url');

        if (substr($url, 0, 4) == "www.") { $url = str_replace('www.','',$url); }
        if (substr($url, 0, 7) == "http://") { $url = str_replace('http://','',$url); }
        if (substr($url, 0, 8) == "https://") { $url = str_replace('https://','',$url); }
        if (strpos($url,'/')>0) list($url) = explode('/',$url);

        $src_url = str_replace('.','\\.',$url);

        if (Links::CheckWaitVerification($src_url)) {
            echo core::getLanguage('error', 'wait_verification');
        }

        if (Links::CheckExistsLink($src_url)) {
            echo core::getLanguage('error', 'already_exists');
        }

        // Check url on valid
        if (Helper::checkUrl($url)){
            echo core::getLanguage('error', 'wrong_url');
        }

        if (Helper::nativeCheckUrl($_POST["url"])){
           echo core::getLanguage('error', 'not_your_site');
        }

        break;

    case 'start_update':

        $path = SYS_ROOT . 'tmp/update.zip';
        $update = new Update(core::getSetting("language"), VERSION);
        $newversion = $update->getVersion();
        $content = [];

        if (Core_Array::getRequest('p') == 'start') {
            if ($data->DownloadUpdate($path, $update->getUpdate())){
                $content['status'] = core::getLanguage('str', 'download_completed');
                $content['result'] = 'yes';
            } else {
                $content['status'] = core::getLanguage('error', 'failed_to_update');
                $content['result'] = 'no';
            }
        }

        if (Core_Array::getRequest('p') == 'update_files') {
            $destination = SYS_ROOT;

            $zip = new ZipArchive;
            if ($zip->open($path) === TRUE) {

                if (is_writeable($destination)) {
                    $zip->extractTo($destination);
                    $zip->close();
                    $content['status'] = core::getLanguage('msg', 'files_unzipped_successfully');
                    $content['result'] = 'yes';
                } else {
                    $content['status'] = core::getLanguage('msg', 'directory_not_writeable');
                    $content['result'] = 'no';
                }
            } else {
                $content['status'] = core::getLanguage('msg', 'cannot_read_zip_archive');
                $content['result'] = 'no';
            }
        }

        if (Core_Array::getRequest('p') == 'update_bd') {

            $current_version_code = Helper::getCurrentVersionCode(VERSION);
            $version_code_detect = $data->versionCodeDetect();

            $result = false;

            if ($version_code_detect < $current_version_code) {
                if ($version_code_detect == 50000) {
                    $path_update = 'tmp/update_3_0_' . core::getSetting('language') . '.sql';
                }

                if (is_file($path_update)) {
                    if ($data->updateDB($path_update)) {
                        $result = true;
                    }
                }
            } else {
                $result = true;
            }

            if ($result === true) {
                $content['status'] = core::getLanguage('msg', 'update_completed');
                $content['result'] = 'yes';
            } else {
                $content['status'] = core::getLanguage('error', 'failed_to_update');
                $content['result'] = 'no';
            }
        }

        Helper::showJSONContent(json_encode($content));

        break;
}