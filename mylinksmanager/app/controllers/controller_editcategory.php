<?php

/********************************************
 * My Links Manager 3.0.2
 * Copyright (c) 2011-2018 Alexander Yanitsky
 * Website: http://janicky.com
 * E-mail: janickiy@mail.ru
 * Skype: janickiy
 ********************************************/

defined('MYLINKSMANAGER') || exit('My Links Manager: access denied!');

class Controller_editcategory extends Controller
{
	function __construct()
	{
		$this->model = new Model_editcategory();
		$this->view = new View();
	}

	public function action_admin()
	{	
		$this->view->generate('admin/editcategory_view.php', $this->model);
	}
}