<?php

defined('GUESTBOOK') || exit('GUESTBOOK: access denied.');

class Controller
{
    public $model;
    public $view;

    function __construct()
    {
        $this->view = new View();
    }

    function action_index()
    {}
}
