<?php

defined('MYLINKSMANAGER') || exit('My Links Manager: access denied!');

class View
{
    public function generate($template_view, $data = null)
    {
        include core::pathTo('views', $template_view);
    }
}
