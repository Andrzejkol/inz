<?php

defined('SYSPATH') OR die('No direct access allowed.');

$config['4dminix/slider'] = 'admin_slider/index';
$config['4dminix/slider/dodaj'] = 'admin_slider/add';
$config['4dminix/slider/edytuj/([0-9]+)'] = 'admin_slider/edit/$1';
$config['4dminix/slider/usun/([0-9]+)'] = 'admin_slider/delete/$1';
$config['4dminix/slider/pozycje_elementow'] = 'admin_slider/change_elements_positions';