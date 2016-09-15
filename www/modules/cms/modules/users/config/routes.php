<?php defined('SYSPATH') OR die('No direct access allowed.');
//Users and Roles
$config['4dminix/uzytkownicy'] = 'users/index';
$config['4dminix/dodaj_uzytkownika'] = 'users/user_add';
$config['4dminix/edytuj_uzytkownika/([0-9]+)'] = 'users/user_edit/$1';
$config['4dminix/usun_uzytkownika(/([0-9]+))?'] = 'users/user_delete$1';
$config['4dminix/role'] = 'users/roles_index';
$config['4dminix/dodaj_role'] = 'users/role_add';
$config['4dminix/edytuj_role/([0-9]+)'] = 'users/role_edit/$1';
$config['4dminix/usun_role/([0-9]+)'] = 'users/role_delete/$1';
$config['4dminix/wyloguj'] = 'users/admin_logout';
$config['4dminix/brak_dostepu'] = 'users/no_access';
$config['4dminix/brak_uprawnien'] = 'users/no_access';
$config['4dminix/admin_logowanie'] = 'users/admin_login';
$config['4dminix/przypomnij_haslo'] = 'users/recover_password';
