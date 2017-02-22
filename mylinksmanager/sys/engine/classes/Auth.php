<?php

/********************************************
 * My Links Manager 3.0.0 alfa
 * Copyright (c) 2011-2017 Alexander Yanitsky
 * Website: http://janicky.com
 * E-mail: janickiy@mail.ru
 * Skype: janickiy
 ********************************************/

defined('MYLINKSMANAGER') || exit('My Links Manager: access denied!');

class Auth
{
    public static function authorization()
    {
        core::session()->start();

        if (core::session()->issetName('sess_admin') === false) {
            core::session()->set('sess_admin', null);
        }

        $query = "SELECT * FROM " . core::database()->getTableName('aut');
        $result = core::database()->querySQL($query);
        $row = core::database()->getRow($result);

        if (Core_Array::getPost('admin_submit')){
            if (core::session()->get('sess_admin') != "ok") $sess_pass = md5(trim(Core_Array::getPost('password')));
            if ($sess_pass === $row['password']){
                core::session()->set('sess_admin', "ok");
				core::session()->commit();
				unset($_POST);
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
				unset($_POST);
				core::session()->commit();
                exit();
            }
        } else {
            if (core::session()->get('sess_admin') != "ok") {
                // require temlate class
                core::requireEx('libs', "html_template/SeparateTemplate.php");

                $tpl = SeparateTemplate::instance()->loadSourceFromFile(core::getTemplate() . "authorization.tpl");
                $tpl->assign('TITLE', 'Авторизация');
				
				$tpl->assign('TITLE_ADMIN_AREA', 'Панель администрирования My Links Manager');
				$tpl->assign('STR_LOGIN', 'Авторизуйтесь!');
				$tpl->assign('STR_YOUR_PASSWORD', 'Введите пароль');
				$tpl->assign('BUTTON_LOGIN', 'Войти');

				unset($_POST);
				core::session()->commit();
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