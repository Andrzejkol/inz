<?php defined('SYSPATH') OR die('No direct access allowed.');

$lang = array(
	'admin_header_slider' => 'Slider',
    'admin_slider_index_site_title' => 'Lista elementów slidera',
    'admin_slider_add_site_title' => 'Dodaj element slidera',
	'admin_slider_edit_site_title' => 'Edytuj element slidera',
	'admin_slider_elements_positions_site_title' => 'Zmiana kolejności elementów',

	'add_slider_element' => 'Dodaj element slidera',
	'edit_slider_element' => 'Edytuj element slidera',
	'delete_slider_element' => 'Usuń element slidera',

	'form_news_title' => 'Aktualność',
	'form_slider_news_title' => 'Aktualność dla slidera',
	'form_slider_image_title' => 'Zdjęcie',
	'active' => 'Aktywny',
	'news_title' => 'Tytuł aktualności',
	'save' => 'Zapisz',
	'save_back' => 'Zapisz i wróć',
	'selected' => 'Zaznaczone',
	'delete' => 'Usuń',
	'delete_info' => 'Czy chcesz usunąć ten element slidera?',
	'photo' => 'Zdjęcie',
	'no_photo' => 'Brak zdjęcia',
	'change_elements_positions' => 'Zmień pozycje elementów',
	'elements_positions_info' => 'Ustaw elementy w rządanej kolejności przeciągając je w górę lub w dół za pomocą lewego przycisku myszki.<br />Elementy znajdujące się najwyżej zostaną wyświetlone jako pierwsze na stronie WWW.',
	'submit' => 'Zapisz',
	'cancel_and_go_back' => 'Anuluj i wróć',
	'cancel' => 'Anuluj',
	'max_elements_number_exceeded' => '<div class="error">Przekroczono maksymalną liczbą elementów slidera, który wynosi ' . slider_helper::SLIDER_MAX_ELEMENTS . ' elementów. Aby dodać nowy element musisz usunąć jeden z istniejących.</div>',

	'add_photo' => 'Dodaj zdjecie',
	'add_photo_alt' => 'Opis zdjęcia',
	'title' => 'Tytuł',
	'short_description' => 'Krótki opis',
	'description' => 'Opis',
	'back' => 'Wróć',
	'choose_image' => 'Wybierz zdjęcie',
	'link' => 'Link',
        'language' => 'Język',
	'following_errors' => 'Wystąpiły następujące błędy:<br /><ul>%s</ul>',
	'single_error' => '<li>%s</li>',
	'single_field_error_empty' => 'Pole <strong>%s</strong> nie może być puste!',
	'single_field_error_invalid' => 'Pole <strong>%s</strong> posiada nieprawidłową wartość!',
	'read_all' => 'Zobacz więcej',
	'slider_news_image_info' => 'Dla najlepszego efektu należy wgrać wykadrowane zdjęcie o wymiarach ' . slider_helper::SLIDER_IMAGE_MEDIUM_WIDTH . 'px x ' . slider_helper::SLIDER_IMAGE_MEDIUM_HEIGHT . 'px (szer. x wys.).',
	'link_info' => 'Podaj pełen adres strony z <strong>http://</strong>, np. http://olicom.com.pl',
	'slider_image_info' => 'Dla najlepszego efektu należy wgrać wykadrowane zdjęcie o wymiarach ' . slider_helper::SLIDER_IMAGE_WIDTH . 'px x ' . slider_helper::SLIDER_IMAGE_HEIGHT . 'px (szer. x wys.).',
	'news_title_info' => 'W powyższej liście prezentowane są tylko aktualności, które mają status "Aktywna" oraz nie są aktualnie wyświetlane w sliderze.<br />Jeśli aktualność zostanie usunięta lub jej status zostanie zmieniony na "Nieaktywna" zostanie ona automatycznie usunięta ze slidera.',

	'no_slider_elements' => 'Brak elementów slidera',
	'no_news_to_add' => 'Brak aktualności, które można umieścić w sliderze.',

	'success' => array(
		'get_all' => 'Pomyślnie pobrano elementy dla slidera.',
		'get_news_titles' => 'Pomyślnie pobrano tytuły aktualności.',
		'validate_add' => 'Pomyślnie dodano element slidera.',
		'validate_add_news' => 'Pomyślnie przeprowadzono walidację dodawania elementu jako aktualność.',
		'validate_add_slider_news' => 'Pomyślnie przeprowadzono walidację dodawania elementu jako aktualności dla slidera.',
		'insert' => 'Pomyślnie dodano element do slidera.',
		'add_image' => 'Pomyślnie dodano zdjęcie do slidera.',
		'add_news' => 'Pomyślnie przypisano aktualność do slidera.',
		'add_slider_news' => 'Pomyślnie dodano aktualność dla slidera.',
		'get_element_details' => 'Pomyślnie pobrano szczegóły elementu slidera.',
		'get_element' => 'Pomyślnie pobrano element slidera.',
		'delete' => 'Pomyślnie usunięto element slidera.',
		'update_elements_positions' => 'Pomyślnie uaktualniono pozycje elementów.',
		'batch_delete' => 'Pomyślnie usunięto elemnt(y) slidera.',
		'check_news' => 'Pomyślnie sprawdzono dostępność newsów slidera.',
	),
	'error' => array(
		'get_all' => 'Wystąpił błąd podczas pobierania elementów dla slidera.',
		'get_news_titles' => 'Wystąpił błąd podczas pobierania tytułów aktualności.',
		'validate_add' => 'Wystąpił błąd podczas walidacji dodawania elementu dla slidera.',
		'validate_add_news' => 'Wystąpił błąd podczas przeprowadzania walidacji dodawania elementu jako aktualności.',
		'validate_add_slider_news' => 'Wystąpił błąd podczas przeprowadzania walidacji dodawania elementu jako aktualności dla slidera.',
		'insert' => 'Wystąpił błąd podczas dodawania elementu do slidera.',
		'add_image' => 'Wystąpił błąd podczas dodawania zdjęcia do slidera.',
		'add_news' => 'Wystąpił błąd podczas przypisywania aktualności do slidera.',
		'add_slider_news' => 'Wystąpił błąd podczas dodawania aktualności dla slidera.',
		'get_element_details' => 'Wystąpił błąd podczas pobierania szczegółów elementu slidera.',
		'get_element' => 'Wystąpił błąd podczas pobierania elementu slidera.',
		'delete' => 'Wystąpił błąd podczas usuwania elementu slidera.',
		'update_elements_positions' => 'Wystąpił błąd podczas uaktualniania pozycji elementów.',
		'batch_delete' => 'Wystąpił błąd podczas usuwania elemntu(ów) slidera.',
		'check_news' => 'Wystąpił błąd podczas sprawdzania dostępności newsów slidera.',
	),
	'validation' => array(
		'type_id_empty' => 'Nie wybrano typu elementu!',
		'slider_news_no_photo' => 'Nie wybrano zdjęcia dla aktualności dla slidera!',
		'slider_image_no_photo' => 'Nie wybrano zdjęcia dla slidera!',
		'slider_invalid_photo_mime' => 'Wybrany plik nie jest prawidłowy. Obsługiwane typy to: ' . implode(', ', slider_helper::$aValidImageMimes),
	),
);
?>
