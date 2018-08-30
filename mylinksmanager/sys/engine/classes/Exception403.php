<?php

/********************************************
 * My Links Manager 3.0.1 beta 
 * Copyright (c) 2011-2018 Alexander Yanitsky
 * Website: http://janicky.com
 * E-mail: janickiy@mail.ru
 * Skype: janickiy
 ********************************************/

defined('MYLINKSMANAGER') || exit('My Links Manager: access denied!');

class Exception403 extends Exception
{
	public function __construct($message)
	{
		parent::__construct($message);
	}
}