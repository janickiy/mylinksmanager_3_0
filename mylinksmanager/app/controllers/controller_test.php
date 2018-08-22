<?php

/********************************************
 * My Links Manager 3.0.0 alfa
 * Copyright (c) 2011-2018 Alexander Yanitsky
 * Website: http://janicky.com
 * E-mail: janickiy@mail.ru
 * Skype: janickiy
 ********************************************/

defined('MYLINKSMANAGER') || exit('My Links Manager: access denied!');

class Controller_test extends Controller
{
	function __construct()
	{
		$this->model = new Model_test();
		$this->view = new View();
	}

	function action_index()
	{
		$this->view->generate('test_view.php',$this->model);
	}
}