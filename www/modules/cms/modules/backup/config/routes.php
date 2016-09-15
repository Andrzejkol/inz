<?php

defined('SYSPATH') OR die('No direct access allowed.');

$config['4dminix/backup/'] = 'backup/index';
$config['4dminix/backup/restore/([0-9]+)'] = 'backup/restore/$1';
$config['4dminix/backup/add'] = 'backup/add_backup';
$config['4dminix/backup/delete/([0-9]+)'] = 'backup/delete/$1';