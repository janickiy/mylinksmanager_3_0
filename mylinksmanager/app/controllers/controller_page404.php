<?php

/********************************************
 * My Links Manager 3.0.0 alfa
 * Copyright (c) 2011-2017 Alexander Yanitsky
 * Website: http://janicky.com
 * E-mail: janickiy@mail.ru
 * Skype: janickiy
 ********************************************/

defined('MYLINKSMANAGER') || exit('My Links Manager: access denied!');

class Controller_page404 extends Controller
{
	function __construct()
	{
		$this->model = new Model_page404();
		$this->view = new View();
	}

	public function action_page404()
	{	
		$this->view->generate('page404_view.php', $this->model);
	}
}