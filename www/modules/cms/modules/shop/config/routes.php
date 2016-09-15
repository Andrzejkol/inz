<?php defined('SYSPATH') OR die('No direct access allowed.');

// PRODUKTY - ADMIN
$config['4dminix/produkty'] = 'admin_products/index';
$config['4dminix/dodaj_produkt'] = 'admin_products/add';
$config['4dminix/edytuj_produkt/([0-9]+)'] = 'admin_products/edit/$1';
$config['4dminix/usun_produkt/([0-9]+)'] = 'admin_products/delete/$1';
$config['4dminix/usun_wariant/([0-9]+)/([0-9]+)'] = 'admin_products/delete_variant/$1/$2';
$config['4dminix/usun_wariant2/([0-9]+)'] = 'admin_products/delete_variant_letters/$1';
// PRODUKTY - APP
$config['produkty_z_tagiem/([0-9]+)'] = 'app_tags/listing/$1';
$config[Kohana::lang('links.lang').'kategoria/([a-zA-Z0-9-]+)/([0-9]+)'] = 'app_products/listing/$2/$1';
//$config['promocje'] = 'app_products/promotions';
$config['nowosci'] = 'app_products/last_add';
//@TODO po co to jest w routes? links.recommended
//$config[Kohana::lang('links.lang').Kohana::lang('links.recommended')] = 'app_products/recommended';
//$config[Kohana::lang('links.recommended')] = 'app_products/recommended';
$config[Kohana::lang('links.lang').'produkt/([0-9]+)/([a-zA-Z0-9-]+)'] = 'app_products/product_details/$1/$2';
//$config[Kohana::lang('links.lang').Kohana::lang('links.calculator').'/([0-9]+)/([a-zA-Z0-9-]+)'] = 'app_products_calc/product_details/$1/$2';
//$config[Kohana::lang('links.lang').'calc/([0-9]+)/([a-zA-Z0-9-]+)'] = 'app_products_calc/product_details/$1/$2';
//$config[Kohana::lang('links.lang').'make_product/([0-9]+)'] = 'app_products_calc/make_product/$1';
$config[Kohana::lang('links.lang').'get_letters_price/([0-9]+)'] = 'app_products_calc/get_letters_price/$1';

$config[Kohana::lang('links.lang').'producent/([0-9]+)/([a-zA-Z0-9-]+)'] = 'app_products/listing_for_producer/$1/$2';
$config['szukaj(/([a-z])+/([0-9]+))?'] = 'app_products/search_products$1$2';
$config['dodaj_do_ulubionych/([0-9]+)'] = 'app_products/add_to_fav/$1';
$config['4dminix/pobierz_wartosci_parametru'] = 'products_ajax/get_parameter_values';
$config['4dminix/pobierz_wartosci_atrybutu'] = 'products_ajax/get_attribute_values';
$config['4dminix/generuj_szablon_allegro/([0-9]+)'] = 'admin_products/generate_allegro_template/$1';
$config[Kohana::lang('links.lang').'wyniki-wyszukiwania(.*)'] = 'app_products/search_results$1';
//$config['projekty_z_tagiem/([0-9]+)'] = 'app_products/products_with_tags/$1';

// KATEGORIE PRODUKTÓW
$config['4dminix/kategorie_produktow'] = 'admin_products_categories/index';
$config['4dminix/kategorie_produktow/([0-9]+)'] = 'admin_products_categories/index/$1';
$config['4dminix/dodaj_kategorie_produktu'] = 'admin_products_categories/add';
$config['4dminix/dodaj_kategorie_glowna'] = 'admin_products_categories/add_parent_category';
$config['4dminix/edytuj_kategorie_produktu/([0-9]+)'] = 'admin_products_categories/edit/$1';
$config['4dminix/edytuj_kategorie_glowna_produktu/([0-9]+)'] = 'admin_products_categories/edit_parent/$1';
$config['4dminix/usun_kategorie_produktu/([0-9]+)'] = 'admin_products_categories/delete/$1';
$config['4dminix/zmien_status_kategorii/([0-9]+)'] = 'admin_products_categories/change_category_status/$1';
$config['4dminix/zmien_pozycje_kategorii'] = 'admin_products_categories/change_elements_positions';

// KATEGORIE PRODUKTÓW - APP


// ZAMOWIENIA - ADMIN
$config['4dminix/zamowienia'] = 'admin_orders/index';
$config['4dminix/edytuj_zamowienie/([0-9]+)'] = 'admin_orders/edit/$1';
$config['4dminix/usun_zamowienie(/([0-9]+))?'] = 'admin_orders/delete$1';

// ZAMOWIENIA - APP
$config[Kohana::lang('links.lang').'zamowienie/usun/([0-9]+)'] = 'app_orders/remove_product/$1';
$config[Kohana::lang('links.lang').'zamowienie/przelicz'] = 'app_orders/recount';
$config[Kohana::lang('links.lang').'zamowienie/koszyk(/[0-9]+)?'] = 'app_orders/order$1';
$config[Kohana::lang('links.lang').'zamowienie/adres_dostawy'] = 'app_orders/order_step_two';
//$config['zamowienie/podsumowanie'] = 'app_orders/order_step_three';
$config[Kohana::lang('links.lang').'zamowienie/zakonczenie(/[a-z]+)?'] = 'app_orders/order_step_four$1';
$config[Kohana::lang('links.lang').'zamowienie/podsumowanie-zamowienia'] = 'app_orders/orderConfirm';
$config[Kohana::lang('links.lang').'zamowienie/potwierdzenie'] = 'app_orders/confirm_order';
$config[Kohana::lang('links.lang').'zamowienie/podsumowanie'] = 'app_orders/orderSummary';
$config[Kohana::lang('links.lang').'zamowienie/zaplacono_sukces'] = 'app_orders/afterPayOK';
$config[Kohana::lang('links.lang').'zamowienie/zaplacono_blad'] = 'app_orders/afterPayERR';

// KLIENCI - ADMIN
$config['4dminix/klienci'] = 'admin_customers/index';
$config['4dminix/edytuj_klienta/([0-9]+)'] = 'admin_customers/edit/$1';
$config['4dminix/usun_klienta(/([0-9]+))?'] = 'admin_customers/delete$1';
$config['4dminix/weryfikuj/([0-9]+)'] = 'admin_customers/verify/$1';
// KLIENCI - APP
$config[Kohana::lang('links.lang').'rejestracja'] = 'app_customers/create_account';
//$config['en/register'] = 'app_customers/create_account';
$config[Kohana::lang('links.lang').'logowanie'] = 'app_customers/login';
//$config['en/login'] = 'app_customers/login';
$config[Kohana::lang('links.lang').'wyloguj'] = 'app_customers/logout';
$config[Kohana::lang('links.lang').'przypomnij_haslo'] = 'app_customers/recover_password';
//$config['en/recover_password'] = 'app_customers/recover_password';
$config[Kohana::lang('links.lang').'twoje_konto'] = 'app_customers/your_account';
//$config['en/twoje_konto'] = 'app_customers/your_account';
$config[Kohana::lang('links.lang').'historia_transakcji'] = 'app_customers/orders_history';
//$config['en/historia_transakcji'] = 'app_customers/orders_history';
$config[Kohana::lang('links.lang').'szczegoly_zamowienia/([0-9]+)'] = 'app_customers/order_details/$1';
$config[Kohana::lang('links.lang').'edycja_danych'] = 'app_customers/edit_account';
$config[Kohana::lang('links.lang').'zmien_haslo'] = 'app_customers/change_password';
$config['ulubione'] = 'app_customers/favourite';
$config[Kohana::lang('links.lang').'usun_konto'] = 'app_customers/delete_account';
$config[Kohana::lang('links.lang').'usun_konto/wyloguj'] = 'app_customers/delete_account_logout';
$config['usun_z_ulubionych/([0-9]+)'] = 'app_customers/delete_from_favourite/$1';
$config['dodaj_do_schowka/([0-9]+)'] = 'app_customers/add_to_clipboard/$1';
$config['usun_ze_schowka/([0-9]+)'] = 'app_customers/remove_from_clipboard/$1';
$config['schowek'] = 'app_customers/show_clipboard';
$config['wyczysc_schowek'] = 'app_customers/clear_clipboard';
$config['twoje_abonamenty'] = 'app_customers/your_subscriptions';
$config[Kohana::lang('links.lang').'potwierdzenie_rejestracji'] = 'app_customers/confirm_registration';



// ATRYBUTY
$config['4dminix/atrybuty'] = 'admin_attributes/index';
$config['4dminix/dodaj_atrybut'] = 'admin_attributes/add';
$config['4dminix/edytuj_atrybut/([0-9]+)'] = 'admin_attributes/edit/$1';
$config['4dminix/usun_atrybut/([0-9]+)'] = 'admin_attributes/delete/$1';
$config['4dminix/dodaj_wartosc_atrybutu/([0-9]+)'] = 'admin_attributes/add_value/$1';
$config['4dminix/edytuj_wartosc_atrybutu/([0-9]+)/([a-z]{2}_[A-Z]{2})'] = 'admin_attributes/edit_value/$1/$2';
$config['4dminix/usun_wartosc_atrybutu/([0-9]+)/([0-9]+)'] = 'admin_attributes/delete_value/$1/$2';

// PARAMETRY
$config['4dminix/parametry'] = 'admin_parameters/index';
$config['4dminix/dodaj_parametr'] = 'admin_parameters/add';
$config['4dminix/edytuj_parametr/([0-9]+)'] = 'admin_parameters/edit/$1';
$config['4dminix/usun_parametr/([0-9]+)'] = 'admin_parameters/delete/$1';
$config['4dminix/dodaj_wartosc_parametru'] = 'admin_parameters/add';
$config['4dminix/edytuj_wartosc_parametru/([0-9]+)/([a-z]{2}_[A-Z]{2})'] = 'admin_parameters/edit_value/$1/$2';
$config['4dminix/usun_wartosc_parametru/([0-9]+)/([a-z]{2}_[A-Z]{2})'] = 'admin_parameters/delete_value/$1/$2';

// PRODUCENCI - ADMIN
$config['4dminix/producenci'] = 'admin_producers/index';
$config['4dminix/dodaj_producenta'] = 'admin_producers/add';
$config['4dminix/edytuj_producenta/([0-9]+)'] = 'admin_producers/edit/$1';
$config['4dminix/usun_producenta/([0-9]+)'] = 'admin_producers/delete/$1';
$config['4dminix/zmien_pozycje_producentow'] = 'admin_producers/change_elements_positions';

// vouchery
$config['4dminix/vouchery'] = 'admin_vouchers/index';
$config['4dminix/dodaj_voucher'] = 'admin_vouchers/add';
$config['4dminix/edytuj_voucher/([0-9]+)'] = 'admin_vouchers/edit/$1';
$config['4dminix/usun_voucher/([0-9]+)'] = 'admin_vouchers/delete/$1';

// KODY RABATOWE
$config['4dminix/kody_rabatowe'] = 'admin_rebates_codes/index';
$config['4dminix/dodaj_kod_rabatowy'] = 'admin_rebates_codes/add';
$config['4dminix/edytuj_kod_rabatowy/([0-9]+)'] = 'admin_rebates_codes/edit/$1';
$config['4dminix/usun_kod_rabatowy/([0-9]+)'] = 'admin_rebates_codes/delete/$1';

// GRUPY RABATOWE
$config['4dminix/grupy_rabatowe'] = 'admin_rebates_groups/index';
$config['4dminix/dodaj_grupe_rabatowa'] = 'admin_rebates_groups/add';
$config['4dminix/edytuj_grupe_rabatowa/([0-9]+)'] = 'admin_rebates_groups/edit/$1';
$config['4dminix/usun_grupe_rabatowa/([0-9]+)'] = 'admin_rebates_groups/delete/$1';

// STATUSY PRODUKTÓW
$config['4dminix/statusy_produktow'] = 'admin_products_statuses/index';
$config['4dminix/dodaj_status_produktu'] = 'admin_products_statuses/add';
$config['4dminix/edytuj_status_produktu/([0-9]+)'] = 'admin_products_statuses/edit/$1';
$config['4dminix/usun_status_produktu/([0-9]+)'] = 'admin_products_statuses/delete/$1';


// STAWKI VAT
$config['4dminix/stawki_vat'] = 'admin_taxes/index';
$config['4dminix/dodaj_stawke_vat'] = 'admin_taxes/add';
$config['4dminix/edytuj_stawke_vat/([0-9]+)'] = 'admin_taxes/edit/$1';
$config['4dminix/usun_stawke_vat/([0-9]+)'] = 'admin_taxes/delete/$1';

// WALUTY
$config['4dminix/waluty'] = 'admin_currencies/index';
$config['4dminix/dodaj_walute'] = 'admin_currencies/add';
$config['4dminix/edytuj_walute/([0-9]+)'] = 'admin_currencies/edit/$1';
$config['4dminix/usun_walute/([0-9]+)'] = 'admin_currencies/delete/$1';

// TYPY DOSTAW
$config['4dminix/typy_dostaw'] = 'admin_delivery_types/index';
$config['4dminix/dodaj_typ_dostawy'] = 'admin_delivery_types/add';
$config['4dminix/edytuj_typ_dostawy/([0-9]+)'] = 'admin_delivery_types/edit/$1';
$config['4dminix/usun_typ_dostawy/([0-9]+)'] = 'admin_delivery_types/delete/$1';
$config['4dminix/przedzial-usun/([0-9]+)/([0-9]+)'] = 'admin_delivery_types/delete_range/$1/$2';

// TYPY PŁATNOŚCI
$config['4dminix/typy_platnosci'] = 'admin_payment_types/index';
$config['4dminix/dodaj_typ_platnosci'] = 'admin_payment_types/add';
$config['4dminix/edytuj_typ_platnosci/([0-9]+)'] = 'admin_payment_types/edit/$1';
$config['4dminix/usun_typ_platnosci/([0-9]+)'] = 'admin_payment_types/delete/$1';

// zapytania klientów
$config['4dminix/zapytania_klientow'] = 'admin_questions/index';
$config['4dminix/usun_zapytanie/([0-9]+)'] = 'admin_questions/delete/$1';
$config['4dminix/podglad_zapytania/([0-9]+)'] = 'admin_questions/preview/$1';

// Materiały
$config['4dminix/materialy'] = 'admin_materials/index';
$config['4dminix/edytuj_material/([0-9]+)'] = 'admin_materials/edit/$1';

// Jakosc druku
$config['4dminix/jakoscdruku'] = 'admin_printquality/index';
$config['4dminix/edytuj_jakoscdruku/([0-9]+)'] = 'admin_printquality/edit/$1';

// dodatki
$config['4dminix/dodatki'] = 'admin_additions/index';
$config['4dminix/edytuj_dodatek/([0-9]+)'] = 'admin_additions/edit/$1';







//echo '<pre>';
//var_dump($config);
//echo '</pre>';