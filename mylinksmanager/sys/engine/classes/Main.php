<?php

/********************************************
 * My Links Manager 3.0.0 alfa
 * Copyright (c) 2011-2017 Alexander Yanitsky
 * Website: http://janicky.com
 * E-mail: janickiy@mail.ru
 * Skype: janickiy
 ********************************************/

class Mlm
{
    /**
     * @return array|false|string
     */
    public static function getIP()
    {
        if (getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"), "unknown"))
            $ip = getenv("HTTP_CLIENT_IP");
        elseif (getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"), "unknown"))
            $ip = getenv("HTTP_X_FORWARDED_FOR");
        elseif (getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"), "unknown"))
            $ip = getenv("REMOTE_ADDR");
        elseif (!empty($_SERVER['REMOTE_ADDR']) && strcasecmp($_SERVER['REMOTE_ADDR'], "unknown"))
            $ip = $_SERVER['REMOTE_ADDR'];
        else
            $ip = "unknown";

        return ($ip);
    }

    /**
     * @param $email
     * @return bool
     */
    public static function checkEmail($email)
    {
        if (preg_match("/^([a-z0-9_\.\-]{1,20})@([a-z0-9\.\-]{1,20})\.([a-z]{2,6})$/i", $email))
            return false;
        else
            return true;
    }

    /**
     * @param $url
     * @return bool
     */
    public static function checkUrl($url)
    {
        if (!preg_match("/^(?:http\:\/\/)?[-0-9a-z_\.]+\.([a-z]{2,6})$/i", $url)){
            return false;
        } else {
            return true;
        }
    }

    /**
     * @return string
     */
    public static function root() {
        if (dirname($_SERVER['SCRIPT_NAME']) == '/' | dirname($_SERVER['SCRIPT_NAME']) == '\\')
            return '/';
        else
            return dirname($_SERVER['SCRIPT_NAME']) . '/';
    }

    /**
     * @param $type
     * @return string
     */
    public static function getRandomCode ($type)
    {
        $maxcount = 8;
        $rand37 = "0123456789QWERTYUIOPASDFGHJKLZXCVBNM";
        $str_len = strlen($rand37) - 1;
        srand((double)microtime()*1000000);
        $RandCode = "";
        for($count = 0; $count < $maxcount; $count++)
            $RandCode .= substr($rand37, rand(1, $str_len), 1);

        if ($type == 'demo')
            $RandCode = 'T' . $RandCode;
        elseif ($type == 'single')
            $RandCode = 'H' . $RandCode;
        elseif ($type == 'multi')
            $RandCode = 'K' . $RandCode;

        return $RandCode;
    }

    /**
     * @param $content
     */
    public static function showJSONContent($content) {
        header('Cache-Control: no-store, no-cache, must-revalidate');
        header('Content-Type: application/json');
        echo $content;
        exit();
    }
}