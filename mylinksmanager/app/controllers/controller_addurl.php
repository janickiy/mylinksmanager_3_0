<?php

/********************************************
 * My Links Manager 3.0.1 beta
 * Copyright (c) 2011-2018 Alexander Yanitsky
 * Website: http://janicky.com
 * E-mail: janickiy@mail.ru
 * Skype: janickiy
 ********************************************/

defined('MYLINKSMANAGER') || exit('My Links Manager: access denied!');

class Controller_addurl extends Controller
{
	function __construct()
	{
		$this->model = new Model_addurl();
		$this->view = new View();
	}

	public function action_index()
	{	
		$this->view->generate('addurl_view.php', $this->model);
	}
}