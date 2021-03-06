<?php

/********************************************
 * My Links Manager 3.0.1 beta
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
    public static function convertUrl($url)
    {
        if (substr($url, 0, 7) == "http://") {
            $url = str_replace('http://', '', $url);
        }
        if (substr($url, 0, 4) == "www.") {
            $url = str_replace('www.', '', $url);
        }
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
        if (preg_match("/^(?:http\:\/\/)?[-0-9a-z_\.]+\.([a-z]{2,6})$/i", $url)) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * @return string
     */
    public static function root()
    {
        if (dirname($_SERVER['SCRIPT_NAME']) == '/' | dirname($_SERVER['SCRIPT_NAME']) == '\\')
            return '/';
        else
            return dirname($_SERVER['SCRIPT_NAME']) . '/';
    }

    /**
     * @param $type
     * @return string
     */
    public static function getRandomCode()
    {
        return md5(mt_rand(1, 90000) . 'FwQy23');
    }

    /**
     * @param $content
     */
    public static function showJSONContent($content)
    {
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
    public static function commonHost($url)
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
    public static function nativeCheckLink($reciprocal_link, $url)
    {
        if (substr($url, 0, 4) == "www.") $url = str_replace('www.', '', $url);
        if (substr($reciprocal_link, 0, 4) == "www.") $reciprocal_link = str_replace('www.', '', $reciprocal_link);
        $url = str_replace('.', '\.', $url);

        if (preg_match("|^[-0-9a-z_^\.]*?($url)[-0-9a-z_^\.\/\?#&\+=%]*?$|i", $reciprocal_link)) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * @param $url
     * @return bool
     */
    public static function nativeCheckUrl($url)
    {
        if ($url == $_SERVER['SERVER_NAME'])
            return true;
        else
            return false;
    }

    /**
     * @param $url_link
     * @return bool
     */
    public static function checkGetParameter($url_link)
    {
        $parse_url = @parse_url("http://" . $url_link);

        if (stripos($parse_url['query'], $_SERVER['SERVER_NAME']))
            return true;
        else
            return false;
    }

    /**
     * @param $text
     * @return bool
     */
    public static function lengthDescription($text)
    {
        $lendescript = mb_strlen($text);
        $templen = 0;
        $temp = strtok($text, " ");

        if (mb_strlen($text) > 60) {
            while ($templen < $lendescript) {
                if (mb_strlen($temp) > 60) {
                    return true;
                    break;
                } else {
                    $templen = $templen + mb_strlen($temp) + 1;
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
    public static function lengthDescriptionLinkMin($str, $min)
    {
        if (mb_strlen($str) < $min)
            return true;
        else
            return false;
    }

    /**
     * @param $str
     * @param $max
     * @return bool
     */
    public static function lengthDescriptionLinkMax($str, $max)
    {
        if (mb_strlen($str) > $max)
            return true;
        else
            return false;
    }

    /**
     * @param $str
     * @param $min
     * @return bool
     */
    public static function lengthFullDescriptionMin($str, $min)
    {
        if (mb_strlen($str) < $min)
            return true;
        else
            return false;
    }

    /**
     * @param $str
     * @param $max
     * @return bool
     */
    public static function lengthFullDescriptionMax($str, $max)
    {
        if (mb_strlen($str) > $max)
            return true;
        else
            return false;
    }

    /**
     * @param $url_link
     * @return bool
     */
    public static function checkMeta($url_link)
    {
        if (substr($url_link, 0, 7) == "http://" or substr($url_link, 0, 8) == "https://")
            $url_page = $url_link;
        else
            $url_page = "http://" . $url_link;

        $ch = curl_init($url_page);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:61.0) Gecko/20100101 Firefox/61.0');
        // curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)');
        // curl_setopt($ch, CURLOPT_USERAGENT, Mozilla/5.0 (compatible; YandexBot/3.0; +http://yandex.com/bots)');
        curl_setopt($ch, CURLOPT_REFERER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 20);
        $data = curl_exec($ch);
        curl_close($ch);

        if (preg_match('/<META([^>]*)\s+CONTENT=(?:")?NOINDEX(?:")?([^>]*)>.*<\/head>/siU', $data))
            return true;
        else
            return false;
    }

    /**
     * @param $url_link
     * @return bool
     */
    public static function checkRobots($url_link)
    {
        if (substr($url_link, 0, 7) == "http://" or substr($url_link, 0, 8) == "https://")
            $url_page = $url_link;
        else
            $url_page = "http://" . $url_link . "/robots.txt";

        $path = @parse_url($url_page);

        $ch = curl_init($url_page);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:61.0) Gecko/20100101 Firefox/61.0');
        // curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)');
        // curl_setopt($ch, CURLOPT_USERAGENT, Mozilla/5.0 (compatible; YandexBot/3.0; +http://yandex.com/bots)');
        curl_setopt($ch, CURLOPT_REFERER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 20);
        $data = curl_exec($ch);
        curl_close($ch);


        $array_row = preg_split("/disallow\:/i", $data);

        for ($i = 0; $i < count($array_row); $i++) {
            $array_row[$i] = trim($array_row[$i]);

            if ($array_row[$i] == "/") {
                return true;
                break;
            } else {
                $array_row[$i] = str_replace('/', '\/', $array_row[$i]);
                $array_row[$i] = str_replace('?', '\?', $array_row[$i]);
                $array_row[$i] = str_replace('.', '\.', $array_row[$i]);

                if ((preg_match("/^" . $array_row[$i] . "([a-zA-Z0-9-_=&\?\.\/]*)$/sU", $path['path'] . "/") || preg_match("/^" . $array_row[$i] . "([a-zA-Z0-9-_=&\?\.\/]*)$/sU", $path['path'])) && !empty($array_row[$i])) {
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
    public static function countLinks($url_link, $limit)
    {
        $parse_url = @parse_url("http://" . $url_link);

        if (empty($parse_url['path']))
            $path = '/';
        else
            $path = str_replace($parse_url['host'], '', $url_link);

        $host = $parse_url['host'];

        $ch = curl_init("http://" . $url_link);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:61.0) Gecko/20100101 Firefox/61.0');
        // curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)');
        // curl_setopt($ch, CURLOPT_USERAGENT, Mozilla/5.0 (compatible; YandexBot/3.0; +http://yandex.com/bots)');
        curl_setopt($ch, CURLOPT_REFERER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 20);
        $data = curl_exec($ch);
        curl_close($ch);

        $host = str_replace('.', '\.', $host);
        $data = preg_replace("/<A\s*([^>]*)\s+HREF=(?:\"|')?http:\/\/(?:www\.)?($host)[^>]*>([^>]*)<\/A>/siU", '', $data);

        preg_match_all('/<A\s*([^>]*)\s+HREF=(?:"|\')?http:\/\/[-0-9a-z_\.]+\.\w{2,6}[:0-9]*[^>]*>([^>]*)<\/A>/siU', $data, $anchors);

        if ($limit < count($anchors[1]))
            return true;
        else
            return false;
    }

    /**
     * @param $htmlcode_link
     * @return bool
     */
    public static function checkMultiLink($htmlcode_link)
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
    public static function checkMultiLinkNative($htmlcode_link, $url)
    {
        preg_match_all('/(<A[^>]*\s+HREF=(?:"|\')?http:\/\/[^>]*>[^>]*<\/A>)/siU', $htmlcode_link, $anchors);

        if (count($anchors[1]) > 1) {
            if ((substr($url, 0, 4)) == "www.") {
                $url = str_replace('www.', '', $url);
            }

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
    public static function checkUrlLink($url_link, $url)
    {
        if (substr($url, 0, 7) == "http://" or substr($url, 0, 8) == "https://")
            $url_page = $url_link;
        else
            $url_page = "http://" . $url_link;

        $ch = curl_init($url_page);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:61.0) Gecko/20100101 Firefox/61.0');
        // curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)');
        // curl_setopt($ch, CURLOPT_USERAGENT, Mozilla/5.0 (compatible; YandexBot/3.0; +http://yandex.com/bots)');
        curl_setopt($ch, CURLOPT_REFERER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 20);
        $data = curl_exec($ch);
        curl_close($ch);

        $data = preg_replace("/<!--(.*)--\s*>/siU", '', $data);
        $data = preg_replace("/<noindex>(.*)<\/noindex>/siU", '', $data);
        $data = preg_replace("/<script[^>]*>(.*)<\/script>/siU", '', $data);
        $data = preg_replace("/<style[^>]*>(.*)<\/style>/siU", '', $data);
        $src_url = $url;
        $src_url = str_replace('/', '\/', $src_url);
        $src_url = str_replace(".", "\.", $src_url);

        if (!preg_match("/<a([^>]*)\s+href=(?:\"|')?http:\/\/(?:www\.)?" . $src_url . "/siU", $data))
            return true;
        else
            return false;

    }

    /**
     * @param $htmlcode_banner
     * @return bool
     */
    public
    static function checkHtmlcodeBanner($htmlcode_banner)
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
    public
    static function checkSizeBanner($htmlcode_banner)
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
    public
    static function checkTypeImageBanner($htmlcode_banner)
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
    public static function lengthHtmlcode($str, $limit)
    {
        if (strlen($str) > $limit) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @param $links
     * @param $subject
     */
    public static function sendMailAdd($link, $subject)
    {
        $message = core::getSetting('template_mail_2');
        $message = str_replace("{[HTTP_HOST]}", $_SERVER['SERVER_NAME'], $message);
        $message = str_replace("{[URL]}", $link['url'], $message);
        $message = str_replace("{[DATE]}", date("d.m.Y г. G:i"), $message);

        core::requireEx('libs', "PHPMailer/class.phpmailer.php");

        $m = new PHPMailer();
        $m->IsMail();
        $m->CharSet = 'utf-8';
        $m->Subject = $subject;
        $m->FromName = "administrator " . $_SERVER['SERVER_NAME'];
        $m->From = core::getSetting('email') ? core::getSetting('email') : "noreply@" . $_SERVER['SERVER_NAME'];
        $m->isHTML(false);
        $m->AddAddress($link['email']);
        $m->Body = $message;
        $m->Send();
    }

    /**
     * @param $links
     * @param $subject
     */
    public static function sendMailNoAdd($link, $subject)
    {
        $message = core::getSetting('template_mail_7');
        $message = str_replace("{[HTTP_HOST]}", $_SERVER['SERVER_NAME'], $message);
        $message = str_replace("{[URL]}", $link['url'], $message);
        $message = str_replace("{[DATE]}", date("d.m.Y г. G:i"), $message);

        core::requireEx('libs', "PHPMailer/class.phpmailer.php");

        $m = new PHPMailer();
        $m->IsMail();
        $m->CharSet = 'utf-8';
        $m->Subject = $subject;
        $m->FromName = "administrator " . $_SERVER['SERVER_NAME'];
        $m->From = core::getSetting('email') ? core::getSetting('email') : "noreply@" . $_SERVER['SERVER_NAME'];
        $m->isHTML(false);
        $m->AddAddress($link['email']);
        $m->Body = $message;
        $m->Send();
    }

    /**
     * @param $links
     * @param $url_link_edit
     * @param $subject
     */
    public static function sendmail_hide_link($link, $url_link_edit, $subject)
    {
        $message = core::getSetting('template_mail_3');
        $message = str_replace("{[HTTP_HOST]}", $_SERVER['SERVER_NAME'], $message);
        $message = str_replace("{[URL]}", $link['url'], $message);
        $message = str_replace("{[URL_LINK]}", $link['reciprocal_link'], $message);
        $message = str_replace("{[DATE_LIMIT]}", core::getSetting('check_interval'), $message);
        $message = str_replace("{[URL_EDIT]}", $url_link_edit, $message);
        $message = str_replace("{[DATE]}", date("d.m.Y г. G:i"), $message);

        core::requireEx('libs', "PHPMailer/class.phpmailer.php");

        $m = new PHPMailer();
        $m->IsMail();
        $m->CharSet = 'utf-8';
        $m->Subject = $subject;
        $m->FromName = "administrator " . $_SERVER['SERVER_NAME'];
        $m->From = core::getSetting('email') ? core::getSetting('email') : "noreply@" . $_SERVER['SERVER_NAME'];
        $m->isHTML(false);
        $m->AddAddress($link['email']);
        $m->Body = $message;
        $m->Send();
    }

    /**
     * @param $links
     * @param $reason
     * @param $subject
     */
    public static function sendmail_hide_link2($link, $reason, $subject)
    {
        $message = core::getSetting('template_mail_4');
        $message = str_replace("{[HTTP_HOST]}", $_SERVER['SERVER_NAME'], $message);
        $message = str_replace("{[URL]}", $link['url'], $message);
        $message = str_replace("{[REASON]}", $reason, $message);
        $message = str_replace("{[DATE_LIMIT]}", core::getSetting('check_interval'), $message);
        $message = str_replace("{[DATE]}", date("d.m.Y г. G:i"), $message);

        core::requireEx('libs', "PHPMailer/class.phpmailer.php");

        $m = new PHPMailer();
        $m->IsMail();
        $m->CharSet = 'utf-8';
        $m->Subject = $subject;
        $m->FromName = "administrator " . $_SERVER['SERVER_NAME'];
        $m->From = core::getSetting('email') ? core::getSetting('email') : "noreply@" . $_SERVER['SERVER_NAME'];
        $m->isHTML(false);
        $m->AddAddress($link['email']);
        $m->Body = $message;
        $m->Send();
    }

    /**
     * @param $links
     * @param $subject
     */
    public static function sendmail_del_link($link, $subject)
    {
        $message = core::getSetting('template_mail_6');
        $message = str_replace("{[HTTP_HOST]}", $_SERVER['SERVER_NAME'], $message);
        $message = str_replace("{[URL]}", $link['url'], $message);
        $message = str_replace("{[DATE]}", date("d.m.Y г. G:i"), $message);

        core::requireEx('libs', "PHPMailer/class.phpmailer.php");

        $m = new PHPMailer();
        $m->IsMail();
        $m->CharSet = 'utf-8';
        $m->Subject = $subject;
        $m->FromName = "administrator " . $_SERVER['SERVER_NAME'];
        $m->From = core::getSetting('email') ? core::getSetting('email') : "noreply@" . $_SERVER['SERVER_NAME'];
        $m->isHTML(false);
        $m->AddAddress($link['email']);
        $m->Body = $message;
        $m->Send();
    }

    /**
     * @param $q
     * @param string $host
     * @param null $context
     * @return int|string
     */
    public static function pr_google($q, $host = 'toolbarqueries.google.com', $context = NULL)
    {
        $seed = "Mining PageRank is AGAINST GOOGLE'S TERMS OF SERVICE. Yes, I'm talking to you, scammer.";
        $result = 0x01020345;
        $len = strlen($q);

        for ($i = 0; $i < $len; $i++) {
            $result ^= ord($seed{$i % strlen($seed)}) ^ ord($q{$i});
            $result = (($result >> 23) & 0x1ff) | $result << 9;
        }

        $ch = sprintf('8%x', $result);
        $url = 'http://%s/tbr?client=navclient-auto&ch=%s&features=Rank&q=info:%s';
        $url = sprintf($url, $host, $ch, $q);
        @$pr = file_get_contents($url, false, $context);
        return $pr ? substr(strrchr($pr, ':'), 1) : 0;
    }

    /**
     * @param $data
     * @param $w
     * @param $h
     * @param $image_mime
     * @return string
     */
    public static function image_convert($data, $w, $h, $image_mime)
    {
        $image = imagecreatefromstring($data);
        $result = imagecreatetruecolor($w, $h);
        imagecopyresized($result, $image, 0, 0, 0, 0, $w, $h, imagesx($image), imagesy($image));
        ob_start();

        if ($image_mime == 'image/png') {
            imagepng($result, NULL, 100);
        } elseif ($image_mime == 'image/jpeg') {
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

    /**
     * @param $ext
     * @return string
     */
    public static function get_mime_type($ext)
    {
        $mimetypes = Array(
            "123" => "application/vnd.lotus-1-2-3",
            "3ds" => "image/x-3ds",
            "669" => "audio/x-mod",
            "a" => "application/x-archive",
            "abw" => "application/x-abiword",
            "ac3" => "audio/ac3",
            "adb" => "text/x-adasrc",
            "ads" => "text/x-adasrc",
            "afm" => "application/x-font-afm",
            "ag" => "image/x-applix-graphics",
            "ai" => "application/illustrator",
            "aif" => "audio/x-aiff",
            "aifc" => "audio/x-aiff",
            "aiff" => "audio/x-aiff",
            "al" => "application/x-perl",
            "arj" => "application/x-arj",
            "as" => "application/x-applix-spreadsheet",
            "asc" => "text/plain",
            "asf" => "video/x-ms-asf",
            "asp" => "application/x-asp",
            "asx" => "video/x-ms-asf",
            "au" => "audio/basic",
            "avi" => "video/x-msvideo",
            "aw" => "application/x-applix-word",
            "bak" => "application/x-trash",
            "bcpio" => "application/x-bcpio",
            "bdf" => "application/x-font-bdf",
            "bib" => "text/x-bibtex",
            "bin" => "application/octet-stream",
            "blend" => "application/x-blender",
            "blender" => "application/x-blender",
            "bmp" => "image/bmp",
            "bz" => "application/x-bzip",
            "bz2" => "application/x-bzip",
            "c" => "text/x-csrc",
            "c++" => "text/x-c++src",
            "cc" => "text/x-c++src",
            "cdf" => "application/x-netcdf",
            "cdr" => "application/vnd.corel-draw",
            "cer" => "application/x-x509-ca-cert",
            "cert" => "application/x-x509-ca-cert",
            "cgi" => "application/x-cgi",
            "cgm" => "image/cgm",
            "chrt" => "application/x-kchart",
            "class" => "application/x-java",
            "cls" => "text/x-tex",
            "cpio" => "application/x-cpio",
            "cpp" => "text/x-c++src",
            "crt" => "application/x-x509-ca-cert",
            "cs" => "text/x-csharp",
            "csh" => "application/x-shellscript",
            "css" => "text/css",
            "cssl" => "text/css",
            "csv" => "text/x-comma-separated-values",
            "cur" => "image/x-win-bitmap",
            "cxx" => "text/x-c++src",
            "dat" => "video/mpeg",
            "dbf" => "application/x-dbase",
            "dc" => "application/x-dc-rom",
            "dcl" => "text/x-dcl",
            "dcm" => "image/x-dcm",
            "deb" => "application/x-deb",
            "der" => "application/x-x509-ca-cert",
            "desktop" => "application/x-desktop",
            "dia" => "application/x-dia-diagram",
            "diff" => "text/x-patch",
            "djv" => "image/vnd.djvu",
            "djvu" => "image/vnd.djvu",
            "doc" => "application/vnd.ms-word",
            "dsl" => "text/x-dsl",
            "dtd" => "text/x-dtd",
            "dvi" => "application/x-dvi",
            "dwg" => "image/vnd.dwg",
            "dxf" => "image/vnd.dxf",
            "egon" => "application/x-egon",
            "el" => "text/x-emacs-lisp",
            "eps" => "image/x-eps",
            "epsf" => "image/x-eps",
            "epsi" => "image/x-eps",
            "etheme" => "application/x-e-theme",
            "etx" => "text/x-setext",
            "exe" => "application/x-ms-dos-executable",
            "ez" => "application/andrew-inset",
            "f" => "text/x-fortran",
            "fig" => "image/x-xfig",
            "fits" => "image/x-fits",
            "flac" => "audio/x-flac",
            "flc" => "video/x-flic",
            "fli" => "video/x-flic",
            "flw" => "application/x-kivio",
            "fo" => "text/x-xslfo",
            "g3" => "image/fax-g3",
            "gb" => "application/x-gameboy-rom",
            "gcrd" => "text/x-vcard",
            "gen" => "application/x-genesis-rom",
            "gg" => "application/x-sms-rom",
            "gif" => "image/gif",
            "glade" => "application/x-glade",
            "gmo" => "application/x-gettext-translation",
            "gnc" => "application/x-gnucash",
            "gnucash" => "application/x-gnucash",
            "gnumeric" => "application/x-gnumeric",
            "gra" => "application/x-graphite",
            "gsf" => "application/x-font-type1",
            "gtar" => "application/x-gtar",
            "gz" => "application/x-gzip",
            "h" => "text/x-chdr",
            "h++" => "text/x-chdr",
            "hdf" => "application/x-hdf",
            "hh" => "text/x-c++hdr",
            "hp" => "text/x-chdr",
            "hpgl" => "application/vnd.hp-hpgl",
            "hs" => "text/x-haskell",
            "htm" => "text/html",
            "html" => "text/html",
            "icb" => "image/x-icb",
            "ico" => "image/x-ico",
            "ics" => "text/calendar",
            "idl" => "text/x-idl",
            "ief" => "image/ief",
            "iff" => "image/x-iff",
            "ilbm" => "image/x-ilbm",
            "iso" => "application/x-cd-image",
            "it" => "audio/x-it",
            "jar" => "application/x-jar",
            "java" => "text/x-java",
            "jng" => "image/x-jng",
            "jp2" => "image/jpeg2000",
            "jpe" => "image/jpeg",
            "jpeg" => "image/jpeg",
            "jpg" => "image/jpeg",
            "jpr" => "application/x-jbuilder-project",
            "jpx" => "application/x-jbuilder-project",
            "js" => "application/x-javascript",
            "karbon" => "application/x-karbon",
            "kdelnk" => "application/x-desktop",
            "kfo" => "application/x-kformula",
            "kil" => "application/x-killustrator",
            "kon" => "application/x-kontour",
            "kpm" => "application/x-kpovmodeler",
            "kpr" => "application/x-kpresenter",
            "kpt" => "application/x-kpresenter",
            "kra" => "application/x-krita",
            "ksp" => "application/x-kspread",
            "kud" => "application/x-kugar",
            "kwd" => "application/x-kword",
            "kwt" => "application/x-kword",
            "la" => "application/x-shared-library-la",
            "lha" => "application/x-lha",
            "lhs" => "text/x-literate-haskell",
            "lhz" => "application/x-lhz",
            "log" => "text/x-log",
            "ltx" => "text/x-tex",
            "lwo" => "image/x-lwo",
            "lwob" => "image/x-lwo",
            "lws" => "image/x-lws",
            "lyx" => "application/x-lyx",
            "lzh" => "application/x-lha",
            "lzo" => "application/x-lzop",
            "m" => "text/x-objcsrc",
            "m15" => "audio/x-mod",
            "m3u" => "audio/x-mpegurl",
            "man" => "application/x-troff-man",
            "md" => "application/x-genesis-rom",
            "me" => "text/x-troff-me",
            "mgp" => "application/x-magicpoint",
            "mid" => "audio/midi",
            "midi" => "audio/midi",
            "mif" => "application/x-mif",
            "mkv" => "application/x-matroska",
            "mm" => "text/x-troff-mm",
            "mml" => "text/mathml",
            "mng" => "video/x-mng",
            "moc" => "text/x-moc",
            "mod" => "audio/x-mod",
            "moov" => "video/quicktime",
            "mov" => "video/quicktime",
            "movie" => "video/x-sgi-movie",
            "mp2" => "video/mpeg",
            "mp3" => "audio/x-mp3",
            "mpe" => "video/mpeg",
            "mpeg" => "video/mpeg",
            "mpg" => "video/mpeg",
            "ms" => "text/x-troff-ms",
            "msod" => "image/x-msod",
            "msx" => "application/x-msx-rom",
            "mtm" => "audio/x-mod",
            "n64" => "application/x-n64-rom",
            "nc" => "application/x-netcdf",
            "nes" => "application/x-nes-rom",
            "nsv" => "video/x-nsv",
            "o" => "application/x-object",
            "obj" => "application/x-tgif",
            "oda" => "application/oda",
            "ogg" => "application/ogg",
            "old" => "application/x-trash",
            "oleo" => "application/x-oleo",
            "p" => "text/x-pascal",
            "p12" => "application/x-pkcs12",
            "p7s" => "application/pkcs7-signature",
            "pas" => "text/x-pascal",
            "patch" => "text/x-patch",
            "pbm" => "image/x-portable-bitmap",
            "pcd" => "image/x-photo-cd",
            "pcf" => "application/x-font-pcf",
            "pcl" => "application/vnd.hp-pcl",
            "pdb" => "application/vnd.palm",
            "pdf" => "application/pdf",
            "pem" => "application/x-x509-ca-cert",
            "perl" => "application/x-perl",
            "pfa" => "application/x-font-type1",
            "pfb" => "application/x-font-type1",
            "pfx" => "application/x-pkcs12",
            "pgm" => "image/x-portable-graymap",
            "pgn" => "application/x-chess-pgn",
            "pgp" => "application/pgp",
            "php" => "application/x-php",
            "php3" => "application/x-php",
            "php4" => "application/x-php",
            "pict" => "image/x-pict",
            "pict1" => "image/x-pict",
            "pict2" => "image/x-pict",
            "pl" => "application/x-perl",
            "pls" => "audio/x-scpls",
            "pm" => "application/x-perl",
            "png" => "image/png",
            "pnm" => "image/x-portable-anymap",
            "po" => "text/x-gettext-translation",
            "pot" => "text/x-gettext-translation-template",
            "ppm" => "image/x-portable-pixmap",
            "pps" => "application/vnd.ms-powerpoint",
            "ppt" => "application/vnd.ms-powerpoint",
            "ppz" => "application/vnd.ms-powerpoint",
            "ps" => "application/postscript",
            "psd" => "image/x-psd",
            "psf" => "application/x-font-linux-psf",
            "psid" => "audio/prs.sid",
            "pw" => "application/x-pw",
            "py" => "application/x-python",
            "pyc" => "application/x-python-bytecode",
            "pyo" => "application/x-python-bytecode",
            "qif" => "application/x-qw",
            "qt" => "video/quicktime",
            "qtvr" => "video/quicktime",
            "ra" => "audio/x-pn-realaudio",
            "ram" => "audio/x-pn-realaudio",
            "rar" => "application/x-rar",
            "ras" => "image/x-cmu-raster",
            "rdf" => "text/rdf",
            "rej" => "application/x-reject",
            "rgb" => "image/x-rgb",
            "rle" => "image/rle",
            "rm" => "audio/x-pn-realaudio",
            "roff" => "application/x-troff",
            "rpm" => "application/x-rpm",
            "rss" => "text/rss",
            "rtf" => "application/rtf",
            "rtx" => "text/richtext",
            "s3m" => "audio/x-s3m",
            "sam" => "application/x-amipro",
            "scm" => "text/x-scheme",
            "sda" => "application/vnd.stardivision.draw",
            "sdc" => "application/vnd.stardivision.calc",
            "sdd" => "application/vnd.stardivision.impress",
            "sdp" => "application/vnd.stardivision.impress",
            "sds" => "application/vnd.stardivision.chart",
            "sdw" => "application/vnd.stardivision.writer",
            "sgi" => "image/x-sgi",
            "sgl" => "application/vnd.stardivision.writer",
            "sgm" => "text/sgml",
            "sgml" => "text/sgml",
            "sh" => "application/x-shellscript",
            "shar" => "application/x-shar",
            "siag" => "application/x-siag",
            "sid" => "audio/prs.sid",
            "sik" => "application/x-trash",
            "slk" => "text/spreadsheet",
            "smd" => "application/vnd.stardivision.mail",
            "smf" => "application/vnd.stardivision.math",
            "smi" => "application/smil",
            "smil" => "application/smil",
            "sml" => "application/smil",
            "sms" => "application/x-sms-rom",
            "snd" => "audio/basic",
            "so" => "application/x-sharedlib",
            "spd" => "application/x-font-speedo",
            "sql" => "text/x-sql",
            "src" => "application/x-wais-source",
            "stc" => "application/vnd.sun.xml.calc.template",
            "std" => "application/vnd.sun.xml.draw.template",
            "sti" => "application/vnd.sun.xml.impress.template",
            "stm" => "audio/x-stm",
            "stw" => "application/vnd.sun.xml.writer.template",
            "sty" => "text/x-tex",
            "sun" => "image/x-sun-raster",
            "sv4cpio" => "application/x-sv4cpio",
            "sv4crc" => "application/x-sv4crc",
            "svg" => "image/svg+xml",
            "swf" => "application/x-shockwave-flash",
            "sxc" => "application/vnd.sun.xml.calc",
            "sxd" => "application/vnd.sun.xml.draw",
            "sxg" => "application/vnd.sun.xml.writer.global",
            "sxi" => "application/vnd.sun.xml.impress",
            "sxm" => "application/vnd.sun.xml.math",
            "sxw" => "application/vnd.sun.xml.writer",
            "sylk" => "text/spreadsheet",
            "t" => "application/x-troff",
            "tar" => "application/x-tar",
            "tcl" => "text/x-tcl",
            "tcpalette" => "application/x-terminal-color-palette",
            "tex" => "text/x-tex",
            "texi" => "text/x-texinfo",
            "texinfo" => "text/x-texinfo",
            "tga" => "image/x-tga",
            "tgz" => "application/x-compressed-tar",
            "theme" => "application/x-theme",
            "tif" => "image/tiff",
            "tiff" => "image/tiff",
            "tk" => "text/x-tcl",
            "torrent" => "application/x-bittorrent",
            "tr" => "application/x-troff",
            "ts" => "application/x-linguist",
            "tsv" => "text/tab-separated-values",
            "ttf" => "application/x-font-ttf",
            "txt" => "text/plain",
            "tzo" => "application/x-tzo",
            "ui" => "application/x-designer",
            "uil" => "text/x-uil",
            "ult" => "audio/x-mod",
            "uni" => "audio/x-mod",
            "uri" => "text/x-uri",
            "url" => "text/x-uri",
            "ustar" => "application/x-ustar",
            "vcf" => "text/x-vcalendar",
            "vcs" => "text/x-vcalendar",
            "vct" => "text/x-vcard",
            "vob" => "video/mpeg",
            "voc" => "audio/x-voc",
            "vor" => "application/vnd.stardivision.writer",
            "vpp" => "application/x-extension-vpp",
            "wav" => "audio/x-wav",
            "wb1" => "application/x-quattropro",
            "wb2" => "application/x-quattropro",
            "wb3" => "application/x-quattropro",
            "wk1" => "application/vnd.lotus-1-2-3",
            "wk3" => "application/vnd.lotus-1-2-3",
            "wk4" => "application/vnd.lotus-1-2-3",
            "wks" => "application/vnd.lotus-1-2-3",
            "wmf" => "image/x-wmf",
            "wml" => "text/vnd.wap.wml",
            "wmv" => "video/x-ms-wmv",
            "wpd" => "application/vnd.wordperfect",
            "wpg" => "application/x-wpg",
            "wri" => "application/x-mswrite",
            "wrl" => "model/vrml",
            "xac" => "application/x-gnucash",
            "xbel" => "application/x-xbel",
            "xbm" => "image/x-xbitmap",
            "xcf" => "image/x-xcf",
            "xhtml" => "application/xhtml+xml",
            "xi" => "audio/x-xi",
            "xla" => "application/vnd.ms-excel",
            "xlc" => "application/vnd.ms-excel",
            "xld" => "application/vnd.ms-excel",
            "xll" => "application/vnd.ms-excel",
            "xlm" => "application/vnd.ms-excel",
            "xls" => "application/vnd.ms-excel",
            "xlt" => "application/vnd.ms-excel",
            "xlw" => "application/vnd.ms-excel",
            "xm" => "audio/x-xm",
            "xmi" => "text/x-xmi",
            "xml" => "text/xml",
            "xpm" => "image/x-xpixmap",
            "xsl" => "text/x-xslt",
            "xslfo" => "text/x-xslfo",
            "xslt" => "text/x-xslt",
            "xwd" => "image/x-xwindowdump",
            "z" => "application/x-compress",
            "zabw" => "application/x-abiword",
            "zip" => "application/zip",
            "zoo" => "application/x-zoo"
        );

        $ext = trim(strtolower($ext));

        if ($ext != '' && isset($mimetypes[$ext])) {
            return $mimetypes[$ext];
        } else {
            return "application/force-download";
        }
    }

    /**
     * @param $url
     * @return mixed
     */
    public static function url($url)
    {
        if (SLUG == 1) {
            $url = preg_replace('/\?a=(\w+)&t=(\w+)/', '${1}/${2}', $url);
            $url = preg_replace('/\?a=(\w+)/', '${1}', $url);
            $url = preg_replace('/\?t=(\w+)/', '${1}', $url);
            $url = str_replace("./", '', $url);

            return self::root() . $url;
        } else
            return self::root() . $url;
    }

    /**
     * @param $version
     * @return mixed
     */
    public function getCurrentVersionCode($version)
    {
        preg_match("/(\d+)\.(\d+)\./", $version, $out);
        $current_version_code = ($out[1] * 10000 + $out[2] * 100);

        return $current_version_code;
    }
}