<?php

/********************************************
 * My Links Manager 3.0.0 alfa
 * Copyright (c) 2011-2018 Alexander Yanitsky
 * Website: http://janicky.com
 * E-mail: janickiy@mail.ru
 * Skype: janickiy
 ********************************************/

defined('MYLINKSMANAGER') || exit('My Links Manager: access denied!');


$row = $data->getIcon(Core_Array::getGet('id'));


$image = imagecreatefromstring($row['image']) or die('Can\'t load image.');

header("Content-Type: " . $row['image_mime']);
imagejpeg($image);
imagedestroy($image);