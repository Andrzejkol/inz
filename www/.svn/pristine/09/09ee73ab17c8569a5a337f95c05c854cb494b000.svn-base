<?php defined('SYSPATH') OR die('No direct access allowed.');
//Newsletter
$db = new Database();
$languages = $db->from(table::LANGUAGES)->get();
if (!empty($languages) && $languages->count() > 0) {
//	Założenia: polski język jest domyślny
	foreach ($languages as $language) {
		if ($language->name === 'pl_PL') {
			$lang = '';
		} else {
			$lang = $language->name{0} . $language->name{1} . '/';			
		}
		$config[$lang . 'podglad_newsletter/([0-9]+)'] = 'newsletters/newsletter_preview/$1';
	}
}

$config['4dminix/dodaj_newsletter'] = 'newsletters/newsletter_add';
$config['4dminix/edytuj_newsletter/([0-9]+)'] = 'newsletters/newsletter_edit/$1';
$config['4dminix/usun_newsletter(/([0-9]+))?'] = 'newsletters/newsletter_delete$1';
$config['4dminix/newslettery'] = 'newsletters/index';
$config['4dminix/newsletter_grupy'] = 'newsletters/newsletter_groups';
$config['4dminix/newsletter_dodaj_grupe'] = 'newsletters/newsletter_group_add';
$config['4dminix/newsletter_edytuj_grupe/([0-9]+)'] = 'newsletters/newsletter_group_edit/$1';
$config['4dminix/newsletter_usun_grupe(/([0-9]+))?'] = 'newsletters/newsletter_group_delete$1';
$config['4dminix/emaile'] = 'newsletters/newsletter_emails';
$config['4dminix/dodaj_email'] = 'newsletters/newsletter_email_add';
$config['4dminix/edytuj_email/([0-9]+)'] = 'newsletters/newsletter_email_edit/$1';
$config['4dminix/usun_email(/([0-9]+))?'] = 'newsletters/newsletter_email_delete$1';
$config['4dminix/wyslij_newsletter/([0-9]+)'] = 'newsletters/newsletter_send/$1';
$config['4dminix/eksport_cvs'] = 'newsletters/export_to_csv';
