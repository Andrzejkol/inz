<?php defined('SYSPATH') OR die('No direct access allowed.');
//elements
$config['4dminix/dodaj_element/([a-zA-Z_]+)'] = 'elements/add_elements/$1';
$config['4dminix/edytuj_element/([0-9]+)'] = 'elements/edit_elements/$1';
$config['4dminix/usun_element/([0-9]+)'] = 'elements/delete_elements/$1';
$config['4dminix/elementy'] = 'elements/list_elements';
$config['4dminix/elementy/([0-9]+)'] = 'elements/list_elements/$1';

?>
