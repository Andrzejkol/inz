<?php

$lang = array(
        'titles' => array(
            'orders_index' => 'Lista zamówień - 4dminix CMS by Olicom',
            'order_edit' => 'Edytuj zamówienie - 4dminix CMS by Olicom',
        ),
        'order_value'=>'Wartość zamówienia:',
        'transport_type'=>'Rodzaj transportu:',
        'transport_cost'=> 'Koszt transportu:',
        'payment_type'=> 'Forma płatności:',
        'order_total_cost' => 'Do zapłaty:',
        'name'=>'Imię i nazwisko:',
        'street'=>'Ulica:',
        'city'=>'Miejscowość:',
        'e-mail'=>'E-mail:',
        'phone'=>'Telefon:',
        
        'order_and_pay'=>'Zamawiam i płacę',
        'paid' => 'Zapłacone',
        'edit' => 'Edytuj',
        'client_note' => 'Informacja od klienta',
        'edit_order' => 'Edycja zamówienia',
        'selected' => 'Zaznaczone',
        'add_order' => 'Dodaj zamówienie',
        'order_number' => 'Numer zamówienia',
        'order_date' => 'Data zamówienia',
        'order_cost' => 'Koszt',
        'order_status' => 'Status',
		'order_status1' => 'Nowe',
		'order_status2' => 'Zapłacone',
		'order_status3' => 'W realizacji',
		'order_status4' => 'Wysłano',
		'order_status5' => 'Zamknięte',
		'total_price'=> 'Całkowita cena',
		'unit_price'=>'Cena za sztukę',
		'product_name' => 'Nazwa produktu',
		'customer_details'=> 'Dane klienta',
		'mail'=>'E-mail',
		'comments_edit'=>'Uwagi: ',
        'payment' => 'Płatność',
        'actions' => 'Opcje',
        'delete' => 'Usuń',
        'paid_Y' => 'Zapłacono',
        'paid_N' => 'Niezapłacono',
        'paid_' => 'Brak informacji',
        'no_orders' => 'Brak zamówień',
        'back' => 'Wróć',
        'check' => 'wybierz',
        'save_changes' => 'Zapisz zmiany',
        'status_has_been_changed_successfully' => 'Status został zmieniony.',
        'cannot_update_status' => 'Nie można uaktualnić statusu zamówienia.',
        'order_details' => 'Szczegóły zamówienia',
        'products_cost' => 'Wartość produktów',
        'delivery_cost' => 'Koszt przesyłki',
        'additional_cost' => 'Dodatkowe koszty',
        'invoice' => 'Faktura',
        'Y' => 'Tak',
        'N' => 'Nie',
        'payment_type' => 'Płatność',
        'confirm_date' => 'Data potwierdzenia',
        'order_products_details' => 'Zamówione produkty',
        'order_summary_ok' => 'Zamówienie zostało zrealizowane. Na podany przez Ciebie adres został wysłany e-mail z podsumowaniem.',
        'order_summary_error' => 'Wystąpiły problemy podczas realizacji zamówienia.',
        'delete_title' => 'Czy na pewno chcesz usunąć zamówienie?',
        'not_your_order' => 'Nie masz dostępu do tego zamówienia.',
        'customer_note'=> 'Uwagi do zamówienia',
        'payment_cost' => 'Koszt płatności',
        'delivery_type' => 'Sposób dostawy',
		'transaction_history' =>'Historia transakcji',
		'transaction_detail' =>'Szczegóły transakcji',
        'order_deleted_success' => 'Usunięto zamówienie',
        'validation' => array(
                'following_errors' => 'Wystąpiły następujące błędy',
                'error_parameter_name_empty' => 'Musisz podać <strong>nazwę parametru</strong>.',
                'error_parameter_values_empty' => 'Musisz podać <strong>wartość parametru</strong>.',
                'error_delivery_empty' => 'Musisz wybrać <strong>sposób dostawy</strong>',
                'error_payment_empty' => 'Musisz wybrać <strong>sposób płatności</strong>',
                'error_product_empty' => 'Musisz wybrać przynajmniej <strong>jeden produkt</strong>.',
                'error_product_more_than_99' => 'Maksymalnie można zamówić <strong>99 sztuk</strong> produktu.',
                'validate_step_one_error' => 'Wystąpił błąd podczas walidacji koszyka.',
                'error_customer_first_name_empty' => 'Musisz podać <strong>Imię</strong>',
                'error_customer_last_name_empty' => 'Musisz podać <strong>Nazwisko</strong>',
                'error_customer_email_empty' => 'Musisz podać adres <strong>E-mail</strong>',
                'error_customer_email_format' => 'Nieprawidłowy format adresu <strong>E-mail</strong>',
                'error_customer_city_empty' => 'Musisz podać <strong>Miasto</strong>',
                'error_customer_zip_empty' => 'Musisz podać <strong>Kod pocztowy</strong>',
                'error_customer_address_empty' => 'Musisz podać <strong>Adres</strong>',
                'error_customer_phoneno_empty' => 'Musisz podać <strong>Nr telefonu</strong>',
                'error_customer_phoneno' => 'Nr telefonu może składać się tylko z cyfr, -, + i spacji.',
                'error_customer_phoneno_too_short' => 'Nr telefonu musi składać się co najmniej z 9 znaków.',
                'error_customer_phoneno_too_long' => 'Nr telefonu musi składać się co najwyżej z 18 znaków.',
                'error_delivery_first_name_empty'=> '<strong>Imię</strong> w adresie dostawy nie może być puste.',
                'error_delivery_last_name_empty'=> '<strong>Nazwisko</strong> w adresie dostawy nie może być puste.',
                'error_delivery_email_empty'=> '<strong>Email</strong> w adresie dostawy nie może być pusty.',
                'error_delivery_email_format' => 'Nieprawidłowy format adresu <strong>E-mail</strong> dla adresu dostawy.',
                'error_delivery_city_empty' => '<strong>Miasto</strong> w adresie dostawy nie może być puste.',
                'error_delivery_zip_empty' => '<strong>Kod pocztowy</strong> w adresie dostawy nie może być pusty.',
                'error_delivery_address_empty' => '<strong>Adres</strong> w adresie dostawy nie może być pusty.',
                'error_delivery_country_empty' => '<strong>Kraj</strong> w adresie dostawy nie może być pusty.',
                'error_delivery_phoneno_empty' => '<strong>Numer telefonu</strong> w adresie dostawy nie może być pusty.',
                'error_delivery_phoneno_too_short' => 'Nr telefonu musi składać się co najmniej z 9 znaków.',
                'error_customer_phoneno_too_long' => 'Nr telefonu musi składać się co najwyżej z 18 znaków.',
                'error_delivery_nip_empty' => '<strong>NIP</strong> w adresie dostawy nie może być pusty.',
                'error_delivery_company_name_empty' => '<strong>Nazwa firmy</strong> w adresie dostawy nie może być pusta.',
                'error_invoice_first_name_empty' => '<strong>Imię</strong> w danych do faktury nie może być puste.',
                'error_invoice_last_name_empty' => '<strong>Nazwisko</strong> w danych do faktury nie może być puste.',
                'error_invoice_email_empty' => '<strong>Email</strong> w danych do faktury nie może być pusty.',
                'error_invoice_city_empty' => '<strong>Miasto</strong> w danych do faktury nie może być puste.',
                'error_invoice_zip_empty' => '<strong>Kod pocztowy</strong> w danych do faktury nie może być puste.',
                'error_invoice_address_empty' => '<strong>Adres</strong> w danych do faktury nie może być pusty.',
                'error_invoice_country_empty' => '<strong>Kraj</strong> w danych do faktury nie może być pusty.',
                'error_invoice_nip_empty' => '<strong>NIP</strong> w danych do faktury nie może być pusty.',
                'error_invoice_company_name_empty' => '<strong>Nazwa firmy</strong> w danych do faktury nie może być pusta.',
				'error_password'=>'<strong>Hasła</strong> muszą być takie same i nie mogą być puste.',
        ),

        'comments' => array(
                'active' => 'Tylko aktywne atrybuty mogą być przydzielane do produktów.',
                'producer_name' => 'Nazwa producenta. Pole wymagane.',
        ),
        'your_cart_is_empty_please_back_to_the_shop' => 'Twój koszyk jest pusty.',
        'filters' => 'Filtry',
        'date_order_from' => 'Data zamówienia (początek)',
        'date_order_to' => 'Data zamówienia (koniec)',
        'goto_shop' => 'Przejdź do sklepu',
        'order_confirmed' => 'Dziękujemy za potwierdzenie zamówienia!',
        'order_confirm_info' => 'Zamówienie zostało potwierdzone. Zostaniesz powiadomiony w momencie wysłania przesyłki.',
        'cant_confirm_order' => 'Przepraszamy, ale nie można potwierdzić zamówienia.',
        'payment_order_title' => 'Zamówienie numer',
        'ERR_STATUS_NO_OR_WRONG_POS_ID' => 'Brak lub błędna wartość parametru POS ID',
        'ERR_STATUS_NO_SESS_ID' => 'Brak parametru session id',
        'ERR_STATUS_NO_TS' => 'Brak parametru ts',
        'ERR_STATUS_NO_OR_WRONG_SIG' => 'Brak lub błędna wartość parametru sig',
        'ERR_STATUS_NO_DESC' => 'Brak parametru desc',
        'ERR_STATUS_NO_CLIENT_IP' => 'Brak parametru client ip',
        'ERR_STATUS_NO_FIRST_NAME' => 'Brak parametru ﬁrst name',
        'ERR_STATUS_NO_LAST_NAME' => 'Brak parametru last name',
        'ERR_STATUS_NO_STREET' => 'Brak parametru street',
        'ERR_STATUS_NO_CITY' => 'Brak parametru city',
        'ERR_STATUS_NO_POST_CODE' => 'Brak parametru post code',
        'ERR_STATUS_NO_AMOUNT' => 'Brak parametru amount',
        'ERR_STATUS_WRONG_ACC_NO' => 'Błędny numer konta bankowego',
        'ERR_STATUS_NO_EMAIL' => 'Brak parametru email',
        'ERR_STATUS_NO_PHONE_NO' => 'Brak numeru telefonu',
        'ERR_STATUS_OTHER_ERR' => 'Inny chwilowy błąd',
        'ERR_STATUS_OTHER_DB_ERR' => 'Inny chwilowy błąd bazy danych',
        'ERR_STATUS_POS_BLOCKED' => 'POS o podanym identyﬁkatorze jest zablokowany',
        'ERR_STATUS_WRONG_PAY_TYPE' => 'Niedozwolona wartość pay type dla danego POS ID',
        'ERR_STATUS_PAY_TYPE_BLOCKED' => 'Podana metoda płatności (wartość pay type) jest chwilowo zablokowana dla danego pos id,np.przerwa konserwacyjna bramki płatniczej',
        'ERR_STATUS_PAY_AMOUNT_LT_MIN' => 'Kwota transakcji mniejsza od wartości minimalnej',
        'ERR_STATUS_PAY_AMOUNT_GT_MAX' => 'Kwota transakcji większa od wartości maksymalnej',
        'ERR_STATUS_TOO_MUCH_TRANSACTION_PER_CLIENT' => 'Przekroczona wartość wszystkich transakcji dla jednego klienta w ostatnim przedziale czasowym',
        'ERR_STATUS_NEED_EXPRESS_PAYMENT' => 'POS działa w wariancie Express Payment lecz nie nastąpiła aktywacja tego wariantu współpracy (czekamy na zgodę działu obsługi klienta)',
        'ERR_STATUS_WRONG_POS_ID_OR_POS_AUTH_KEY' => 'Błędny numer pos id lub pos auth key',
        'ERR_STATUS_TRANSACT_DOES_NOT_EXISTS' => 'Transakcja nie istnieje',
        'ERR_STATUS_NO_AUTHORIZATION' => 'Brak autoryzacji dla danej transakcji',
        'ERR_STATUS_TRANSACTION_STARTED_EARLIER' => 'Transakcja rozpoczęta wcześniej',
        'ERR_STATUS_AUTHORIZATION_HAS_BEEN_MADE' => 'Autoryzacja do transakcji była już przeprowadzana',
        'ERR_STATUS_TRANSACTION_CANCELLED' => 'Transakcja anulowana wcześniej',
        'ERR_STATUS_TRANSACTION_GET_OVER_TO_GET_EARLIER' => 'Transakcja przekazana do odbioru wcześniej',
        'ERR_STATUS_TRANSACTION_GETTED_OVER' => 'Transakcja już odebrana',
        'ERR_STATUS_RETURNING_COSTS_TO_CLIENT' => 'Błąd podczas zwrotu środkó w do klienta',
        'ERR_STATUS_WRONG_STATE' => 'Błędny stan transakcji, np. nie można uznać transakcji kilka razy lub inny, prosimy o kontakt',
        'ERR_STATUS_CRITICAL' => 'Inny błąd krytyczny - prosimy o kontakt',
        'transaction_success' => 'Transakcja przebiegła pomyślnie.',
        'transaction_error' => 'Wystąpiły problemy podczas realizowania płatności.',
        'invoice_details' => 'Szczegóły faktury',
        'first_name' => 'Imię',
        'last_name' => 'Nazwisko',
        'company_name' => 'Nazwa firmy',
        'nip' => 'NIP',
        'city' => 'Miasto',
        'zip' => 'Kod pocztowy',
        'address' => 'Adres',
        'state' => 'Województwo',
        'country' => 'Kraj',
        'phone_no' => 'Telefon',
        'email' => 'E-mail',
        'customer_details' => 'Dane klienta',
        'delivery_details' => 'Inny adres wysyłki',
        'change_state' => 'Zmień status zamówienia',
        'order_status_details' => 'Szczegóły statusu zamówienia',
        'paid_status_details' => 'Szczegóły płatności',
        'current_status' => 'Bieżący status zamówienia',
        'prepay_details' => 'Dane związane z płatnością przelewem.',
        'change_paid_state' => 'Zmień status płatności',
    
    
    'summary' => array(
        'summary' => 'Podsumowanie Twojego zamówienia',
        'payment' => 'Płatność',
        'orderno' => 'Numer zamówienia',
        'orderdate' => 'Data zamówienia',
        'clientdetails' => 'Dane klienta',
        'deliveryaddress' => 'Adres dostawy',
        'delivery' => 'Sposób dostawy',
        'deliverycost' => 'Koszt dostawy',
        'delivery' => 'Sposób dostawy',
        'totalcost' => 'Razem za zakupy',
        'overalcost' => 'Kwota do zapłaty',
        'invoicedetails' => 'Dane do faktury',
        'orderdetails' => 'Zawartość zamówienia',
        'rebate' => 'Rabat',
        'rebatecost' => 'Kwota po rabacie',
    ),
    'email' => array(
        'to' => 'Do',
        'hello' => 'Witaj!',
        'orderstatus' => 'Aktualny status Twojego zamówienia',
        'prodname' => 'Nazwa prod.',
        'quantity' => 'Ilość',
        'price' => 'Cena',
        'total' => 'Razem',
        'link_to_order' => 'Podgląd zamówienia',
    ),
);