<?php

/********************************************
 * My Links Manager 3.0.1 beta 
 * Copyright (c) 2011-2018 Alexander Yanitsky
 * Website: http://janicky.com
 * E-mail: janickiy@mail.ru
 * Skype: janickiy
 ********************************************/

defined('MYLINKSMANAGER') || exit('My Links Manager: access denied!');

class ExceptionSQL extends Exception
{
	protected $sql_error;
	protected $sql_query;

	public function __construct($sql_error, $sql_query, $message)
	{
		$this->sql_error = $sql_error;
		$this->sql_query = $sql_query;

		parent::__construct($message);
	}

	public function getSQLError()
	{
		return $this->sql_error;
	}

	public function getSQLQuery()
	{
		return $this->sql_query;
	}
}