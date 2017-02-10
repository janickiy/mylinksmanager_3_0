<?php

/********************************************
 * My Links Manager 3.0.0 alfa
 * Copyright (c) 2011-2017 Alexander Yanitsky
 * Website: http://janicky.com
 * E-mail: janickiy@mail.ru
 * Skype: janickiy
 ********************************************/

defined('MYLINKSMANAGER') || exit('My Links Manager: access denied!');

class Controller_index extends Controller
{
	function __construct()
	{
		$this->model = new Model_index();
		$this->view = new View();
	}

	public function action_index()
	{	
		$this->view->generate('index_view.php', $this->model);
	}
	
	public function action_admin()
	{	
		$this->view->generate('admin/index_view.php', $this->model);
	}
}