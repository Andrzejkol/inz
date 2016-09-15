<?php

defined('SYSPATH') OR die('No direct access allowed.');

$config['4dminix/boxes/'] = 'boxes/index';
$config['4dminix/boxes/([0-9]+)'] = 'boxes/list_boxes/$1';
$config['4dminix/boxes/add'] = 'boxes/add_boxes';
$config['4dminix/boxes/edit/([0-9]+)'] = 'boxes/edit/$1';
$config['4dminix/box/edit/([0-9]+)/([0-9]+)(/([0-9]+))?'] = 'boxes/editBox/$1/$2$3';
$config['4dminix/box/add/([0-9]+)(/([0-9]+))?'] = 'boxes/addBox/$1$2';
$config['4dminix/box/delete'] = 'boxes/deleteBox';
$config['4dminix/box/delete/([0-9]+)/([0-9]+)(/([0-9]+))?'] = 'boxes/deleteBox/$1/$2$3';
$config['4dminix/boxes/delete'] = 'boxes/delete';
$config['4dminix/boxes/delete/([0-9]+)'] = 'boxes/delete/$1';
$config['4dminix/boxes/elements-positions/([0-9]+)(/([0-9]+))?'] = 'boxes/change_elements_positions/$1$2';