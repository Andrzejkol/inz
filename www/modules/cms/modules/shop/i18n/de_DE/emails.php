<?php

defined('SYSPATH') OR die('No direct access allowed.');
$lang = array(
//        'register' => array(
//                'title' => 'Witamy w sklepie albathyment.com.pl/',
//                'message' => '
//        Serdecznie witamy w gronie naszych klientów.<br/><br/>
//
//        Podczas rejestracji podałeś następujące dane:<br/>
//        E-mail: %s<br/>
//        Hasło: %s<br/>
//        Prosimy o zachowanie tych danych w bezpiecznym miejscu.<br/><br/>
//
//        Imię: %s<br/>
//        Nazwisko: %s<br/>
//        Firma: %s<br/>
//<br/>
//        Jeśli dane są niepoprawne, prosimy o naniesienie zmian w panelu zarządzania kontem.
//        Możesz tego dokonać po zalogowaniu się do sklepu na stronie albathyment.com.pl//login.php i wybraniu opcji edycji danych konta.<br/>
//        W razie dodatkowych pytań jesteśmy do Twojej dyspozycji od poniedziałku do piątku w godzinach 8-16<br/>
//        tel. 061 656 95 40<br/>
//        e-mail: …………………<br/>
//<br/>
//        ------------------------------<br/>
//        Dziękujemy za okazane zaufanie<br/>
//        Dołożymy wszelkich starań, abyś był zadowolony z zakupów w naszym sklepie.<br/>
//<br/>
//        Zespół albathyment.com.pl<br/>
//<br/>
//<br/>
//        ------------------------- (stopka – linki do strony sklepu)
//        o albathyment.com.pl | oferta | regulamin | logowanie |
//
//        ',
//        ),

	'new_customer_registered' => array(
		'title' => 'Nowy użytkownik zarejestrował się w '.$_SERVER['HTTP_HOST'].'',
		'message' => ''
	),
    'password_recover' => array(
        'title' => 'Przypomnienie hasła '.$_SERVER['HTTP_HOST'].' ',
        'message' => '
        Witaj <br/>
        <br/>
        Podczas rejestracji podałeś następujący e-mail: %s <br/>
        Do Twojego konta zostało wygenerowane nowe hasło: %s <br/>
        <br/>
        W razie dodatkowych pytań jesteśmy do Twojej dyspozycji od poniedziałku do piątku w godzinach 8-16<br/>
        tel. 061 656 95 40 <br/>
        e-mail: …………………<br/>
        <br/>
        ------------------------------<br/>
        Dziękujemy za okazane zaufanie<br/>
        Dołożymy wszelkich starań, abyś był zadowolony z zakupów w naszym sklepie.<br/>
        <br/>
        Zespół '.$_SERVER['HTTP_HOST'].'<br/>
        <br/>
        ------------------------- <br/>
        <a href="http://' . $_SERVER['HTTP_HOST'] . url::base() . 'regulamin#info">o '.$_SERVER['HTTP_HOST'].'</a> | <a href="http://' . $_SERVER['HTTP_HOST'] . url::base() . 'oferta">oferta | <a href="http://' . $_SERVER['HTTP_HOST'] . url::base() . 'regulamin">regulamin</a> | <a href="http://' . $_SERVER['HTTP_HOST'] . url::base() . 'logowanie">logowanie</a> <br/>

        '
    ),
    'register' => array(
        'title' => 'Witamy w '.$_SERVER['HTTP_HOST'].'',
        'message' => '
            Do: %s<br />
            <br />
            Serdecznie witamy w gronie naszych klientów.<br />
            <br />
            Podczas rejestracji podałeś następujące dane:<br />
            Login: %s<br />
            Hasło: %s<br />
            Prosimy o zachowanie tych danych w bezpiecznym miejscu.<br /><br />
			Aby potwierdzić rejestrację i tym samym aktywować konto należy przekleić poniższy link do przeglądarki internetowej:</br />
			http://' . $_SERVER['HTTP_HOST'] . url::base() . 'potwierdzenie_rejestracji?verify_string=%s
            <br /><br />
            Celem usprawnienia korzystania z witryny w przyszłości, prosimy o uzupełnienie danych w panelu zarządzania kontem. Możesz tego dokonać po zalogowaniu się i wybraniu opcji edycji danych konta.<br />
            <br />
            W razie dodatkowych pytań jesteśmy do Twojej dyspozycji od poniedziałku do piątku w godzinach 8-16.<br />
            tel. 606-96-88-11<br />
			tel. (061) 222-33-55<br />
			fax. (061) 222-47-24<br />
			<br />
            e-mail: '.config::getConfig('administrator_email').'<br />
            <br />
            ------------------------------<br />
            Dziękujemy za okazane zaufanie<br />
            Dołożymy wszelkich starań, abyś był zadowolony z funkcji oferowanych w naszym serwisie.<br />
            <br />
            Zespół '.$_SERVER['HTTP_HOST'].'<br />
            <br />
            <br />
            -------------------------<br />
            <a href="http://' . $_SERVER['HTTP_HOST'] . url::base() . 'logowanie">logowanie</a> <br/>
        ',
    ),
    'delete_account' => array(
        'title' => 'Wyrejestrowanie ze sklepu '.$_SERVER['HTTP_HOST'].'',
        'message' => '
            Do %<br />
            <br />
            Witaj<br />
            <br />
            Otrzymałeś tego maila ponieważ zaznaczyłeś opcję wyrejestrowania z serwisu '.$_SERVER['HTTP_HOST'].'. Aby potwierdzić usunięcie konta kliknij poniższy link:
            <br />
            %s<br />
            <br />
            W razie dodatkowych pytań jesteśmy do Twojej dyspozycji od poniedziałku do piątku w godzinach 8-16<br />
            tel. 606-96-88-11<br />
			tel. (061) 222-33-55<br />
			fax. (061) 222-47-24<br />
            e-mail: '.config::getConfig('administrator_email').'<br />
            <br />
            ------------------------------<br />
            Zespół '.$_SERVER['HTTP_HOST'].'<br />
            <br />
            -------------------------<br />
            <a href="http://' . $_SERVER['HTTP_HOST'] . url::base() . 'regulamin#info">o '.$_SERVER['HTTP_HOST'].'</a> | <a href="http://' . $_SERVER['HTTP_HOST'] . url::base() . 'oferta">oferta | <a href="http://' . $_SERVER['HTTP_HOST'] . url::base() . 'regulamin">regulamin</a> | <a href="http://' . $_SERVER['HTTP_HOST'] . url::base() . 'logowanie">logowanie</a> <br/>
        '
    ),
    'change_state_new' => array(
        'title' => 'Dziękujemy za dokonanie zakupu. Przyjęcie zamówienia nr %s',
        'message' => ''
    ),
    'change_state_zaplacono' => array(
        'title' => 'Dziękujemy za wpłatę',
        'message' => ''
    ),
    'change_state_oczekuje_na_potwierdzenie' => array(
        'title' => 'Potwierdzenie zamówienia nr %s',
        'message' => ''
    ),
    'change_state_w_realizacji' => array(
        'title' => 'Zamówienie nr %s w realizacji',
        'message' => ''
    ),
    'change_state_zrealizowano' => array(
        'title' => 'Zrealizowano zamówienie nr %s',
        'message' => ''
    ),
    'change_state_zrealizowano_odbior_osobisty' => array(
        'title' => 'Zamówienie nr %s jest gotowe do obioru.',
        'message' => ''
    ),
    'change_state_zrealizowano_wysylka' => array(
        'title' => 'Zamówienie nr %s zostało wysłane.',
        'message' => ''
    ),
    'change_state_zamkniete' => array(
        'title' => 'Zamknięto zamówienie nr %s',
        'message' => ''
    ),
    'change_state_wyslano' => array(
        'title' => 'Zmiana statusu zamówienia %s',
        'message' => '
            Do %s<br />
            <br />
            Witaj<br />
            <br />
            Aktualny status zamówienia to: WYSŁANO<br />
            <br />
            Numer zamówienia: %s<br />
            Data zamówienia: %s<br />
            <br />
            Dane klienta:<br />
            %s<br />
            <br />
            Adres dostawy:<br />
            %s<br />
            <br />
            Płatność i dostawa:<br />
            Sposób płatności: [zapłacono/pobranie]<br />
            Sposób dostawy: %s<br />
            ------------------------------------------------------------------------------<br />
            Zawartość zamówienia:<br />
            %s<br />
            <br />
            Wartość brutto: %s<br />
            ------------------------------------------------------------------------------<br />
            Razem za zakupy: %s<br />
            Koszt dostawy: %s<br />
            Razem do zapłaty: %s<br />
            <br />
            W razie dodatkowych pytań jesteśmy do Twojej dyspozycji od poniedziałku do piątku w godzinach 8-16<br />
            tel. 606-96-88-11<br />
			tel. (061) 222-33-55<br />
			fax. (061) 222-47-24<br />
            e-mail: '.config::getConfig('administrator_email').'<br />
            <br />
            --<br />
            Dziękujemy za okazane zaufanie,<br />
            Zespół '.$_SERVER['HTTP_HOST'].'<br />
            <br />
            Aktualny status zamówienia możesz obejrzeć również w historii Twoich zamówień.<br />
            Jeżeli masz dodatkowe pytania dotyczące zamówienia, prosimy przygotować do kontaktu z nami (e-mail lub telefon) numer swojego zamówienia.<br />
            ------------------------- <br />

            <a href="http://' . $_SERVER['HTTP_HOST'] . url::base() . 'regulamin#info">o '.$_SERVER['HTTP_HOST'].'</a> | <a href="http://' . $_SERVER['HTTP_HOST'] . url::base() . 'oferta">oferta | <a href="http://' . $_SERVER['HTTP_HOST'] . url::base() . 'regulamin">regulamin</a> | <a href="http://' . $_SERVER['HTTP_HOST'] . url::base() . 'logowanie">logowanie</a> <br/>
        '),
    'change_state_gotowe_do_odbioru' => array(
        'title' => 'Zmiana statusu zamówienia %s',
        'message' => '
            Do %s<br />
            <br />
            Witaj<br />
            <br />
            Aktualny status zamówienia to: GOTOWE DO ODBIORU<br />
            <br />
            Dane zamówienia:%s<br />
            Numer zamówienia:%s<br />
            Data zamówienia:s%<br />
            Zamówiony towar czeka na odbiór w siedzibie sklepu – Poznań, ul. Sarmacka 7 od poniedziałku do piątku w godzinach od 8 do 16.<br />
            Pamiętaj, jeśli zamówiłeś towary roślinne wskazany jest ich jak najszybszy odbiór.<br />
            <br />
            W razie dodatkowych pytań jesteśmy do Twojej dyspozycji od poniedziałku do piątku w godzinach 8-16<br />
            tel. 606-96-88-11<br />
			tel. (061) 222-33-55<br />
			fax. (061) 222-47-24<br />
            e-mail: '.config::getConfig('administrator_email').'<br />
            <br />
            --<br />
            Dziękujemy za okazane zaufanie,<br />
            Zespół '.$_SERVER['HTTP_HOST'].'<br />
            <br />
            Aktualny status zamówienia możesz obejrzeć również w historii Twoich zamówień.<br />
            Jeżeli masz dodatkowe pytania dotyczące zamówienia, prosimy przygotować do kontaktu z nami (e-mail lub telefon) numer swojego zamówienia.<br />
            ------------------------- <br />
            <a href="http://' . $_SERVER['HTTP_HOST'] . url::base() . 'regulamin#info">o '.$_SERVER['HTTP_HOST'].'</a> | <a href="http://' . $_SERVER['HTTP_HOST'] . url::base() . 'oferta">oferta | <a href="http://' . $_SERVER['HTTP_HOST'] . url::base() . 'regulamin">regulamin</a> | <a href="http://' . $_SERVER['HTTP_HOST'] . url::base() . 'logowanie">logowanie</a> <br/>
        '
    )
);
?>