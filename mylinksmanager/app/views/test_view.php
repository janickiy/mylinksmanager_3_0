<?php

/********************************************
 * My Links Manager 3.0.2
 * Copyright (c) 2011-2018 Alexander Yanitsky
 * Website: http://janicky.com
 * E-mail: janickiy@mail.ru
 * Skype: janickiy
 ********************************************/

defined('MYLINKSMANAGER') || exit('My Links Manager: access denied!');


$reciprocal_link = 'demo.janicky.com/link.html';

var_dump(Helper::checkUrlLink($reciprocal_link, core::getSetting('url')));

//Links::changeStatusLink(1, 'show');
Links::changeStatusLink(1, 'black', core::getLanguage('msg', 'reason_absense_reciprocal'));