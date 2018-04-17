<?php

/********************************************
 * My Links Manager 3.0.0 alfa
 * Copyright (c) 2011-2018 Alexander Yanitsky
 * Website: http://janicky.com
 * E-mail: janickiy@mail.ru
 * Skype: janickiy
 ********************************************/

defined('MYLINKSMANAGER') || exit('My Links Manager: access denied!');

class Helper
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
     * @param $url
     * @return mixed
     */
    public static function convertUrl($url) {
        if (substr($url, 0, 7) == "http://") { $url = str_replace('http://', '', $url); }
        if (substr($url, 0, 4) == "www.") { $url = str_replace('www.', '', $url); }
        if (strpos($url, '/') > 0) list($url) = explode('/', $url);

        return $url;
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


    /**
     * @param $str
     * @return mixed|string
     */
    public static function cuttags($str)
    {
        $str = strip_tags($str, '<b><strong><i><u><del><strike><em><center><a><li><ol><ul><img>');
        $str = preg_replace("/class=(?:\"|')?[0-9a-z]+(?:\"|')?/i", '', $str);
        $str = preg_replace("/style=(?:\"|')?[0-9a-z]+(?:\"|')?/i", '', $str);

        return $str;
    }

    /**
     * @param $url
     * @return bool
     */
    public static function commonHost ($url)
    {
        if ($_SERVER["SERVER_ADDR"] == @gethostbyname($url))
            return true;
        else
            return false;
    }

    /**
     * @param $reciprocal_link
     * @param $url
     * @return bool
     */
    public static function nativeCheckLink ($reciprocal_link, $url)
    {
        if (substr($url, 0, 4) == "www.") $url = str_replace('www.','',$url);
        if (substr($reciprocal_link, 0, 4) == "www.") $reciprocal_link = str_replace('www.','',$reciprocal_link);
        $url = str_replace('.','\.',$url);

        if (preg_match("|^[-0-9a-z_^\.]*?($url)[-0-9a-z_^\.\/\?#&\+=%]*?$|i", $reciprocal_link)){
            return false;
        } else {
            return true;
        }
    }

    /**
     * @param $url
     * @return bool
     */
    public static function nativeCheckUrl ($url)
    {
        if($url == $_SERVER['SERVER_NAME'])
            return true;
        else
            return false;
    }

    /**
     * @param $url_link
     * @return bool
     */
    public static function checkGetParameter ($url_link)
    {
        $parse_url = @parse_url("http://".$url_link);

        if (stripos($parse_url['query'], $_SERVER['SERVER_NAME']))
            return true;
        else
            return false;
    }

    /**
     * @param $text
     * @return bool
     */
    public static function lengthDescription ($text)
    {
        $lendescript = strlen($text);
        $templen = 0;
        $temp = strtok($text, " ");

        if (strlen($text) > 60){
            while($templen < $lendescript){
                if (strlen($temp) > 60){
                    return true;
                    break;
                } else {
                    $templen = $templen + strlen($temp) + 1;
                }

                $temp = strtok(" ");
            }
        }
    }

    /**
     * @param $str
     * @param $min
     * @return bool
     */
    public static function lengthDescriptionLinkMin ($str, $min)
    {
        if (strlen($str) < $min)
            return true;
        else
            return false;
    }

    /**
     * @param $str
     * @param $max
     * @return bool
     */
    public static function lengthDescriptionLinkMax ($str, $max)
    {
        if (strlen($str) > $max)
            return true;
        else
            return false;
    }

    /**
     * @param $str
     * @param $min
     * @return bool
     */
    public static function lengthFullDescriptionMin ($str, $min)
    {
        if (strlen($str) < $min)
            return true;
        else
            return false;
    }

    /**
     * @param $str
     * @param $max
     * @return bool
     */
    public static function lengthFullDescriptionMax ($str, $max)
    {
        if (strlen($str) > $max)
            return true;
        else
            return false;
    }

    /**
     * @param $url_link
     * @return bool
     */
    public static function checkMeta ($url_link)
    {
        global $version;

        $line = "";
        $parse_url = @parse_url("http://" . $url_link);

        if(empty($parse_url['path']))
            $path = '/';
        else
            $path = str_replace($parse_url['host'], '', $url_link);

        $fp = @fsockopen($parse_url['host'], 80, $errno, $errstr, 30);

        if ($fp) {
            $headers = "GET ".$path." HTTP/1.1\r\n";
            $headers .= "Accept: image/gif, image/x-xbitmap, image/jpeg, image/pjpeg, */*\r\n";
            // $headers .= "User-Agent: My Links Manager bot (ver ".$version."; +http://janicky.com)\r\n";
            $headers .= "User-Agent: Mozilla/5.0 (compatible; MSIE 7.0; Windows NT 5.1; SV1)\r\n";
            // $headers .= "User-Agent: Mozilla/5.0 (compatible; YandexBot/3.0; +http://yandex.com/bots)\r\n";
            // $headers .= "User-Agent: Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)\r\n";
            $headers .= "Host: ".$parse_url['host']."\r\n";
            $headers .= "Connection: Close\r\n\r\n";

            fwrite($fp, $headers);

            while (!feof($fp))
            {
                $line .= fgets($fp, 1024);
            }

            fclose($fp);
        }

        if (preg_match('/<META([^>]*)\s+CONTENT=(?:")?NOINDEX(?:")?([^>]*)>.*<\/head>/siU', $line))
            return true;
        else
            return false;
    }

    /**
     * @param $url_link
     * @return bool
     */
    public static function checkRobots ($url_link)
    {
        global $version;

        $line = "";
        $pr_url_link = "http://" . $url_link;
        $path = @parse_url($pr_url_link);
        $fp = @fsockopen($path['host'], 80, $errno, $errstr, 30);

        if ($fp) {
            $headers = "GET /robots.txt HTTP/1.1\r\n";
            $headers .= "Accept: image/gif, image/x-xbitmap, image/jpeg, image/pjpeg, */*\r\n";
            // $headers .= "User-Agent: My Links Manager bot (ver ".$version."; +http://janicky.com)\r\n";
            $headers .= "User-Agent: Mozilla/5.0 (compatible; MSIE 7.0; Windows NT 5.1; SV1)\r\n";
            // $headers .= "User-Agent: Yandex/1.01.001 (compatible; Win 16; I)\r\n";
            // $headers .= "User-Agent: Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)\r\n";
            $headers .= "Host: ".$path['host']."\r\n";
            $headers .= "Connection: Close\r\n\r\n";

            fwrite($fp, $headers);

            while (!feof($fp))
            {
                $line .= fgets($fp, 1024);
            }

            fclose($fp);
        }

        $array_row = preg_split("/disallow\:/i", $line);

        for($i=0; $i<count($array_row); $i++)
        {
            $array_row[$i] = trim($array_row[$i]);

            if ($array_row[$i] == "/") {
                return true;
                break;
            } else {
                $array_row[$i] = str_replace('/', '\/', $array_row[$i]);
                $array_row[$i] = str_replace('?', '\?', $array_row[$i]);
                $array_row[$i] = str_replace('.', '\.', $array_row[$i]);

                if ((preg_match("/^".$array_row[$i]."([a-zA-Z0-9-_=&\?\.\/]*)$/sU", $path[path]."/") || preg_match("/^".$array_row[$i]."([a-zA-Z0-9-_=&\?\.\/]*)$/sU", $path[path])) && !empty($array_row[$i])) {
                    return true;
                    break;
                }
            }
        }
    }

    /**
     * @param $url_link
     * @param $limit
     * @return bool
     */
    public static function countLink ($url_link, $limit)
    {
        global $version;

        $line = "";
        $parse_url = @parse_url("http://" . $url_link);

        if (empty($parse_url['path']))
            $path = '/';
        else
            $path = str_replace($parse_url['host'], '', $url_link);

        $host = $parse_url['host'];
        $fp = @fsockopen($host, 80, $errno, $errstr, 30);

        if ($fp) {
            $headers = "GET ".$path." HTTP/1.1\r\n";
            $headers .= "Accept: image/gif, image/x-xbitmap, image/jpeg, image/pjpeg, */*\r\n";
            // $headers .= "User-Agent: My Links Manager (ver ".$version."; +http://janicky.com)\r\n";
            $headers .= "User-Agent: Mozilla/5.0 (compatible; MSIE 7.0; Windows NT 5.1; SV1)\r\n";
            // $headers .= "User-Agent: Mozilla/5.0 (compatible; YandexBot/3.0; +http://yandex.com/bots)\r\n";
            // $headers .= "User-Agent: Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)\r\n";
            $headers .= "Host: ".$host."\r\n";
            $headers .= "Connection: Close\r\n\r\n";

            fwrite($fp, $headers);

            while (!feof($fp))
            {
                $line .= fgets($fp, 1024);
            }

            fclose($fp);
        }

        $host = str_replace('.','\.',$host);
        $line = preg_replace("/<A\s*([^>]*)\s+HREF=(?:\"|')?http:\/\/(?:www\.)?($host)[^>]*>([^>]*)<\/A>/siU", '', $line);

        preg_match_all('/<A\s*([^>]*)\s+HREF=(?:"|\')?http:\/\/[-0-9a-z_\.]+\.\w{2,6}[:0-9]*[^>]*>([^>]*)<\/A>/siU', $line, $anchors);

        if ($limit < count($anchors[1]))
            return true;
        else
            return false;
    }

    /**
     * @param $htmlcode_link
     * @return bool
     */
    public static function checkMultiLink ($htmlcode_link)
    {
        preg_match_all('/(<A[^>]*\s+HREF=(?:"|\')?http:\/\/[^>]*>[^>]*<\/A>)/siU', $htmlcode_link, $anchors);

        if (count($anchors[1]) > 1)
            return true;
        else
            return false;
    }

    /**
     * @param $htmlcode_link
     * @param $url
     * @return bool
     */
    public static function checkMultiLinkNative ($htmlcode_link, $url)
    {
        preg_match_all('/(<A[^>]*\s+HREF=(?:"|\')?http:\/\/[^>]*>[^>]*<\/A>)/siU', $htmlcode_link, $anchors);

        if (count($anchors[1]) > 1){
            if ((substr($url, 0, 4)) == "www.") { $url = str_replace('www.','',$url); }

            $url = str_replace(".", "\.", $url);

            preg_match_all("/(<A[^>]*\s+HREF=(?:'|\")?http:\/\/(?:www\.)?($url)[^>]*>[^>]*<\/A>)/siU", $htmlcode_link, $anchors2);

            if (count($anchors2[1]) != count($anchors[1]))
                return true;
            else
                return false;
        }
    }

    /**
     * @param $url_link
     * @param $url
     * @return bool
     */
    public static function checkUrlLink ($url_link,$url)
    {
        global $version;

        $line = "";
        $parse_url = @parse_url("http://" . $url_link);

        if (empty($parse_url['path']))
            $path = '/';
        else
            $path = str_replace($parse_url['host'], '', $url_link);

        if ($parse_url['host']) {
            $fp = @fsockopen($parse_url['host'], 80, $errno, $errstr, 30);

            if ($fp) {
                $headers = "GET ".$path." HTTP/1.1\r\n";
                $headers .= "Accept: image/gif, image/x-xbitmap, image/jpeg, image/pjpeg, */*\r\n";
                // $headers .= "Referer: $host\r\n";
                // $headers .= "User-Agent: My Links Manager (ver ".$version."; +http://janicky.com)\r\n";
                $headers .= "User-Agent: Mozilla/5.0 (compatible; MSIE 7.0; Windows NT 5.1; SV1)\r\n";
                // $headers .= "User-Agent: Mozilla/5.0 (compatible; YandexBot/3.0; +http://yandex.com/bots)\r\n";
                // $headers .= "User-Agent: Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)\r\n";
                $headers .= "Host: ".$parse_url['host']."\r\n";
                $headers .= "Connection: Close\r\n\r\n";

                fwrite($fp, $headers);

                while (!feof($fp))
                {
                    $line .= fgets($fp, 1024);
                }

                fclose($fp);
            }

            $line = preg_replace("/<!--(.*)--\s*>/siU", '', $line);
            $line = preg_replace("/<noindex>(.*)<\/noindex>/siU", '', $line);
            $line = preg_replace("/<script[^>]*>(.*)<\/script>/siU", '', $line);
            $line = preg_replace("/<style[^>]*>(.*)<\/style>/siU", '', $line);
            $src_url = $url;
            $src_url = str_replace('/', '\/', $src_url);
            $src_url = str_replace(".", "\.", $src_url);

            if (!preg_match("/<a([^>]*)\s+href=(?:\"|')?http:\/\/(?:www\.)?".$src_url."/siU", $line))
                return true;
            else
                return false;
        }
    }

    /**
     * @param $htmlcode_banner
     * @return bool
     */
    public static function checkHtmlcodeBanner ($htmlcode_banner)
    {
        if (!preg_match('/^<A([^>]*)\s+HREF=(?:"|\')?HTTP:\/\/[^>]*>\s*<\s*IMG[^>]*\s+SRC=(?:"|\')?HTTP:\/\/[^>]*><\/A>$/siU', $htmlcode_banner))
            return true;
        else
            return false;
    }

    /**
     * @param $htmlcode_banner
     * @return bool
     */
    public static function checkSizeBanner ($htmlcode_banner)
    {
        if (!preg_match('/\s+width=(?:"|\')?88(?:"|\')?(\s+|>)/siU', $htmlcode_banner) || !preg_match('/\s+height=(?:"|\')?31(?:"|\')?(\s+|>)/i', $htmlcode_banner))
            return true;
        else
            return false;
    }

    /**
     * @param $htmlcode_banner
     * @return bool
     */
    public static function checkTypeImageBanner ($htmlcode_banner)
    {
        if (!preg_match('/\s+src=(?:"|\')?HTTP:\/\/.*\.(?:gif|jpg|jpeg|png)(?:"|\')?/i', $htmlcode_banner))
            return true;
        else
            return false;
    }

    /**
     * @param $str
     * @param $limit
     * @return bool
     */
    public static function lengthHtmlcode ($str, $limit)
    {
        if (strlen($str) > $limit){
            return true;
        } else {
            return false;
        }
    }

    /**
     * @param $links
     * @param $subject
     */
    public static function sendMailAdd($links, $subject)
    {
        global $settings;

        $date = date("d.m.Y г. G:i");
        $url = $links['url'];

        $message = $settings['template_mail_2'];
        $message = str_replace("{[HTTP_HOST]}", $_SERVER['SERVER_NAME'], $message);
        $message = str_replace("{[URL]}", $url, $message);
        $message = str_replace("{[DATE]}", $date, $message);

        $fromname = "administrator ".$_SERVER['SERVER_NAME']."";
        $fromname_encoded = base64_encode($fromname);
        $fromname_packed = "=?utf-8?B?".$fromname_encoded."?=";
        $fromaddr = $settings['email'];

        $headers = "MIME-Version: 1.0\n";
        $headers .= "From: ".$fromname_packed." <".$fromaddr.">\n";
        $headers .= "Content-type: text/plain; charset=utf-8\n";
        $headers .= "Content-Transfer-Encoding: 8bit\r\n";

        @mail($links['email'], $subject, $message, $headers);

    }

    /**
     * @param $links
     * @param $subject
     */
    public static function sendMailNoAdd($links, $subject)
    {
        global $settings;

        $date = date("d.m.Y г. G:i");
        $url = $links['url'];

        $message = $settings['template_mail_7'];
        $message = str_replace("{[HTTP_HOST]}", $_SERVER['SERVER_NAME'], $message);
        $message = str_replace("{[URL]}", $url, $message);
        $message = str_replace("{[DATE]}", $date, $message);

        $fromname = "administrator ".$_SERVER['SERVER_NAME']."";
        $fromname_encoded = base64_encode($fromname);
        $fromname_packed = "=?utf-8?B?".$fromname_encoded."?=";
        $fromaddr = $settings['email'];

        $headers = "MIME-Version: 1.0\n";
        $headers .= "From: ".$fromname_packed." <".$fromaddr.">\n";
        $headers .= "Content-type: text/plain; charset=utf-8\n";
        $headers .= "Content-Transfer-Encoding: 8bit\r\n";

        @mail($links['email'], $subject, $message, $headers);
    }

    /**
     * @param $links
     * @param $url_link_edit
     * @param $subject
     */
    public static function sendmail_hide_link ($links, $url_link_edit, $subject)
    {
        global $settings;

        $date = date("d.m.Y г. G:i");
        $url = $links['url'];
        $url_link = $links['reciprocal_link'];
        $date_limit = $settings['check_interval'];

        $message = $settings['template_mail_3'];
        $message = str_replace("{[HTTP_HOST]}", $_SERVER['SERVER_NAME'], $message);
        $message = str_replace("{[URL]}", $url, $message);
        $message = str_replace("{[URL_LINK]}", $url_link, $message);
        $message = str_replace("{[DATE_LIMIT]}", $date_limit, $message);
        $message = str_replace("{[URL_EDIT]}", $url_link_edit, $message);
        $message = str_replace("{[DATE]}", $date, $message);

        $fromname = "administrator ".$_SERVER['SERVER_NAME']."";
        $fromname_encoded = base64_encode($fromname);
        $fromname_packed = "=?utf-8?B?".$fromname_encoded."?=";
        $fromaddr = $settings['email'];

        $headers = "MIME-Version: 1.0\n";
        $headers .= "From: ".$fromname_packed." <".$fromaddr.">\n";
        $headers .= "Content-type: text/plain; charset=utf-8\n";
        $headers .= "Content-Transfer-Encoding: 8bit\r\n";

        @mail($links['email'], $subject, $message, $headers);

    }

    /**
     * @param $links
     * @param $reason
     * @param $subject
     */
    public static function sendmail_hide_link2($links, $reason, $subject)
    {
        global $settings;

        $date = date("d.m.Y г. G:i");
        $url = $links['url'];
        $date_limit = $settings['check_interval'];

        $message = $settings['template_mail_4'];
        $message = str_replace("{[HTTP_HOST]}", $_SERVER['SERVER_NAME'], $message);
        $message = str_replace("{[URL]}", $url, $message);
        $message = str_replace("{[REASON]}", $reason, $message);
        $message = str_replace("{[DATE_LIMIT]}", $date_limit, $message);
        $message = str_replace("{[DATE]}", $date, $message);

        $fromname = "administrator ".$_SERVER['SERVER_NAME']."";
        $fromname_encoded = base64_encode($fromname);
        $fromname_packed = "=?utf-8?B?".$fromname_encoded."?=";
        $fromaddr = $settings['admin_email'];

        $headers = "MIME-Version: 1.0\n";
        $headers .= "From: ".$fromname_packed." <".$fromaddr.">\n";
        $headers .= "Content-type: text/plain; charset=utf-8\n";
        $headers .= "Content-Transfer-Encoding: 8bit\r\n";

        @mail($links['email'], $subject, $message, $headers);
    }

    /**
     * @param $links
     * @param $subject
     */
    public static function sendmail_del_link($links, $subject)
    {
        global $settings;

        $date = date("d.m.Y г. G:i");
        $url = $links['url'];
        $date_limit = $settings['check_interval'];

        $message = $settings['template_mail_6'];
        $message = str_replace("{[HTTP_HOST]}", $_SERVER['SERVER_NAME'], $message);
        $message = str_replace("{[URL]}", $url, $message);
        $message = str_replace("{[DATE]}", $date, $message);

        $fromname = "adminisrator ".$_SERVER['SERVER_NAME']."";
        $fromname_encoded = base64_encode($fromname);
        $fromname_packed = "=?utf-8?B?".$fromname_encoded."?=";
        $fromaddr = $settings['email'];

        $headers = "MIME-Version: 1.0\n";
        $headers .= "From: ".$fromname_packed." <".$fromaddr.">\n";
        $headers .= "Content-type: text/plain; charset=utf-8\n";
        $headers .= "Content-Transfer-Encoding: 8bit\r\n";

        @mail($links['email'], $subject, $message, $headers);
    }

    /**
     * @param $url
     * @return bool|int
     */
    public static function cy_yandex($url)
    {
        $str = @file("http://bar-navig.yandex.ru/u?ver=2&show=32&url=".$url);

        if ($str == false) {
            $cy = false;
        } else {
            $result = preg_match("/value=\"(.\d*)\"/", join("",$str), $tic);

            if($result < 1)
                $cy = 0;
            else
                $cy = $tic[1];
        }

        return $cy;
    }

    /**
     * @param $q
     * @param string $host
     * @param null $context
     * @return int|string
     */
    public static function pr_google($q, $host='toolbarqueries.google.com', $context=NULL)
    {
        $seed = "Mining PageRank is AGAINST GOOGLE'S TERMS OF SERVICE. Yes, I'm talking to you, scammer.";
        $result = 0x01020345;
        $len = strlen($q);

        for ($i=0; $i<$len; $i++) {
            $result ^= ord($seed{$i%strlen($seed)}) ^ ord($q{$i});
            $result = (($result >> 23) & 0x1ff) | $result << 9;
        }

        $ch = sprintf('8%x', $result);
        $url = 'http://%s/tbr?client=navclient-auto&ch=%s&features=Rank&q=info:%s';
        $url = sprintf($url,$host,$ch,$q);
        @$pr = file_get_contents($url, false, $context);
        return $pr?substr(strrchr($pr, ':'), 1):0;
    }

    /**
     * @param $data
     * @param $w
     * @param $h
     * @param $image_mime
     * @return string
     */
    public static function image_convert($data, $w, $h, $image_mime) {
        $image = imagecreatefromstring($data);
        $result = imagecreatetruecolor($w, $h);
        imagecopyresized($result, $image, 0, 0, 0, 0, $w, $h, imagesx($image), imagesy($image));
        ob_start();

        if ($image_mime == 'image/png'){
            imagepng($result, NULL, 100);
        } elseif ($image_mime == 'image/jpeg'){
            imagejpeg($result, NULL, 100);
        } else {
            imagegif($result);
        }

        $contents = ob_get_contents();
        ob_end_clean();
        imagedestroy($result);
        imagedestroy($image);
        return $contents;
    }


}