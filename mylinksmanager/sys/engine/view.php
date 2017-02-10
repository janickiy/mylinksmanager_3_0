<?php

defined('GUESTBOOK') || exit('GUESTBOOK: access denied.');

class View
{
    public function generate($template_view, $data = null)
    {
        include core::pathTo('views', $template_view);
    }
}
