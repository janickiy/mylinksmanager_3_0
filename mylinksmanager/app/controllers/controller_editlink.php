<?php

/********************************************
 * My Links Manager 3.0.1 alfa
 * Copyright (c) 2011-2018 Alexander Yanitsky
 * Website: http://janicky.com
 * E-mail: janickiy@mail.ru
 * Skype: janickiy
 ********************************************/

defined('MYLINKSMANAGER') || exit('My Links Manager: access denied!');

class Controller_editlink extends Controller
{
	function __construct()
	{
		$this->model = new Model_editlink();
		$this->view = new View();
	}

	public function action_admin()
	{	
		$this->view->generate('admin/editlink_view.php', $this->model);
	}
}