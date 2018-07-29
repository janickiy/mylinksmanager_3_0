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
}