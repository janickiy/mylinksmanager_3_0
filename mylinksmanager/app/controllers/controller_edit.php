<?php

/********************************************
 * My Links Manager 3.0.2
 * Copyright (c) 2011-2018 Alexander Yanitsky
 * Website: http://janicky.com
 * E-mail: janickiy@mail.ru
 * Skype: janickiy
 ********************************************/

defined('MYLINKSMANAGER') || exit('My Links Manager: access denied!');

class Controller_edit extends Controller
{
	function __construct()
	{
		$this->model = new Model_edit();
		$this->view = new View();
	}

	function action_index()
	{
		$this->view->generate('edit_view.php',$this->model);
	}
}