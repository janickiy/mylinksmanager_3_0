<?php

/********************************************
 * My Links Manager 3.0.0 alfa
 * Copyright (c) 2011-2017 Alexander Yanitsky
 * Website: http://janicky.com
 * E-mail: janickiy@mail.ru
 * Skype: janickiy
 ********************************************/

class Auth
{
    public static function authorization()
    {
        session_start();

        if (!isset($_SESSION['sess_admin'])) {
            $_SESSION['sess_admin'] = '';
        }

        $query = "SELECT * FROM " . core::database()->getTableName('aut');
        $result = core::database()->querySQL($query);
        $row = core::database()->getRow($result);

        if (Core_Array::getPost('admin_submit')){
            if ($_SESSION['sess_admin'] != "ok") $sess_pass = md5(trim(Core_Array::getPost('password')));
            if ($sess_pass === $row['password']){
                $_SESSION['sess_admin'] = "ok";
            } else {
                echo '<!DOCTYPE html>
				<html>
				<head>
				<title>Неверные данные авторизации!</title>
				<meta http-equiv="content-type" content="text/html; charset=utf-8">
				</head>
				<body>
				<script type="text/javascript">
				window.alert(\'Извините, но Вы не прошли авторизацию.\nДоступ закрыт!\');
				window.location.href=\'' . $_SERVER['REQUEST_URI'] . '\';
				</script>
				</body>
				</html>';
                exit();
            }
        } else {
            if ($_SESSION['sess_admin'] != "ok") {
                // require temlate class
                core::requireEx('libs', "html_template/SeparateTemplate.php");

                $tpl = SeparateTemplate::instance()->loadSourceFromFile(core::getTemplate() . "authorization.tpl");
                $tpl->assign('TITLE', 'Авторизация');


                // display content
                $tpl->display();
                exit();
            }
        }
    }

    public static function getCurrentHash()
    {
        $query = "SELECT * FROM " . core::database()->getTableName('aut');
        $result = core::database()->querySQL($query);
        $row = core::database()->getRow($result);

        return $row['password'];
    }
}