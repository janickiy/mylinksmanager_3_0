<?php

/********************************************
 * My Links Manager 3.0.0 alfa
 * Copyright (c) 2011-2018 Alexander Yanitsky
 * Website: http://janicky.com
 * E-mail: janickiy@mail.ru
 * Skype: janickiy
 ********************************************/

defined('MYLINKSMANAGER') || exit('My Links Manager: access denied!');

class Controller_check_links extends Controller
{
	function __construct()
	{
		$this->model = new Model_check_links();
		$this->view = new View();
	}

	public function action_admin()
	{	
		$this->view->generate('admin/check_links_view.php', $this->model);
	}
}