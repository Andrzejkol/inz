<?php
class error_404{
	public static function show_404()
	{
		$page = new Index_Controller();
		$page->show404();
	}
}

//Zamiana zdarzenia system.404
if (Kohana::config('config.display_errors') !== TRUE) {
    Event::replace('system.404', array('Kohana', 'show_404'), array('error_404', 'show_404'));
}
Event::add('system.ready', 'site_lang');
function site_lang()
{
    $a = explode(url::base(), $_SERVER['REQUEST_URI']);
    $b = array();
    if(!empty($a[1])) {
        $b = explode('/', $a[1]);
    }

    if(!empty($b[0]))
    {
        switch($b[0]) {
            case 'en':
                Kohana::config_set('locale.language', 'en_US');
				break;
			case 'ru':
				Kohana::config_set('locale.language', 'ru_RU');
				break;
			case 'de':
				Kohana::config_set('locale.language', 'de_DE');
				break;
            default:
                Kohana::config_set('locale.language', 'pl_PL');
				break;
        }
    } else {
        Kohana::config_set('locale.language', 'pl_PL');
    }
}