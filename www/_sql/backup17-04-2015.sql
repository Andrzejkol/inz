-- --------------------------------------------------------
-- Host:                         pawel
-- Wersja serwera:               5.5.18 - MySQL Community Server (GPL)
-- Serwer OS:                    Win32
-- HeidiSQL Wersja:              9.1.0.4867
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
-- Zrzucanie danych dla tabeli cms2.acl_permissions: 160 rows
DELETE FROM `acl_permissions`;
/*!40000 ALTER TABLE `acl_permissions` DISABLE KEYS */;
INSERT INTO `acl_permissions` (`id_permission`, `name`, `resource`, `privilege`, `description`) VALUES
	(2, 'users_add', 'users', 'add', 'Dodawanie użytkowników'),
	(3, 'users_edit', 'users', 'edit', 'Edycja użytkowników'),
	(4, 'users_delete', 'users', 'delete', 'Usuwanie użytkowników'),
	(5, 'roles_index', 'roles', 'index', 'Lista ról'),
	(6, 'roles_add', 'roles', 'add', 'Dodawanie ról'),
	(7, 'roles_edit', 'roles', 'edit', 'Edycja ról'),
	(8, 'roles_delete', 'roles', 'delete', 'Usuwanie ról'),
	(9, 'permissions_index', 'permissions', 'index', 'Lista uprawnień'),
	(10, 'permissions_add', 'permissions', 'add', 'Dodawanie uprawnień'),
	(11, 'permissions_edit', 'permissions', 'edit', 'Edycja uprawnień'),
	(12, 'permissions_delete', 'permissions', 'delete', 'Usuwanie uprawnień'),
	(13, 'permissions_manage', 'permissions', 'manage', 'Zarządzanie uprawnieniami'),
	(14, 'newsletters_index', 'newsletters', 'index', 'Lista newsletterów'),
	(15, 'newsletters_add', 'newsletters', 'add', 'Dodawanie newsletterów'),
	(16, 'newsletters_edit', 'newsletters', 'edit', 'Edycja newsletterów'),
	(17, 'newsletters_delete', 'newsletters', 'delete', 'Usuwanie newsletterów'),
	(18, 'newsletters_send', 'newsletters', 'send', 'Wysyłanie newsletterów'),
	(19, 'newsletters_group_add', 'newsletters', 'group_add', 'Dodawanie grup newsletterów'),
	(20, 'newsletters_group_edit', 'newsletters', 'group_edit', 'Edycja grup newsletterów'),
	(21, 'newsletters_group_delete', 'newsletters', 'group_delete', 'Usuwanie grup newsletterów'),
	(22, 'newsletters_email_add', 'newsletters', 'email_add', 'Dodawanie emaili do newsletterów'),
	(23, 'newsletters_email_edit', 'newsletters', 'email_edit', 'Edycja emaili do newsletterów'),
	(24, 'newsletters_email_delete', 'newsletters', 'email_delete', 'Usuwanie emaili do newsletterów'),
	(25, 'news_index', 'news', 'index', 'Lista aktualności'),
	(26, 'news_add', 'news', 'add', 'Dodawanie aktualności'),
	(27, 'news_edit', 'news', 'edit', 'Edycja aktualności'),
	(28, 'news_delete', 'news', 'delete', 'Usuwanie aktualności'),
	(29, 'pages_index', 'pages', 'index', 'Lista stron'),
	(30, 'pages_add', 'pages', 'add', 'Dodawanie stron'),
	(31, 'pages_edit', 'pages', 'edit', 'Edycja stron'),
	(32, 'pages_delete', 'pages', 'delete', 'Usuwanie stron'),
	(41, 'galleries_index', 'galleries', 'index', 'Lista galerii'),
	(42, 'galleries_add', 'galleries', 'add', 'Dodawanie galerii'),
	(43, 'galleries_edit', 'galleries', 'edit', 'Edycja galerii'),
	(44, 'galleries_delete', 'galleries', 'delete', 'Usuwanie galerii'),
	(45, 'galleries_delete_photo', 'galleries', 'delete_photo', 'Usuwanie zdjęć z galerii'),
	(46, 'galleries_add_photo', 'galleries', 'add_photo', 'Dodawanie zdjęc do galerii'),
	(50, 'newsletters_groups_index', 'newsletters', 'groups_index', 'Lista grup newsletterów'),
	(51, 'newsletters_emails_index', 'newsletters', 'emails_index', 'Lista emaili newsletterów'),
	(52, 'elements_index', 'elements', 'index', 'Lista elementów'),
	(53, 'elements_add', 'elements', 'add', 'Dodawanie elementów'),
	(54, 'elements_edit', 'elements', 'edit', 'Edycja elementów'),
	(55, 'elements_delete', 'elements', 'delete', 'Usuwanie elementów'),
	(56, 'page_content_index', 'page_content', 'index', 'Lista treści na stronach'),
	(57, 'page_content_add', 'page_content', 'add', 'Dodawanie treści na stronach'),
	(58, 'page_content_edit', 'page_content', 'edit', 'Edycja treści na stronach'),
	(59, 'page_content_delete', 'page_content', 'delete', 'Usuwanie treści stron'),
	(60, 'pages_edit_content', 'pages', 'edit_content', 'Edycja zawartości strony'),
	(61, 'medias_index', 'medias', 'index', 'Lista mediów'),
	(62, 'medias_add', 'medias', 'add', 'Dodawanie mediów'),
	(63, 'medias_delete', 'medias', 'delete', 'Usuwanie mediów'),
	(64, 'configurations_index', 'configurations', 'index', 'Ustawienia aplikacji'),
	(65, 'polls_index', 'polls', 'index', 'Lista sond'),
	(66, 'polls_add', 'polls', 'add', 'Dodawanie sond'),
	(67, 'polls_edit', 'polls', 'edit', 'Edycja sond'),
	(68, 'polls_delete', 'polls', 'delete', 'Usuwanie sond'),
	(93, 'news_categories_index', 'news_categories', 'index', 'Lista kategorii aktualności'),
	(94, 'news_categories_add', 'news_categories', 'add', 'Dodawanie kategorii aktualności'),
	(95, 'news_categories_edit', 'news_categories', 'edit', 'Edycja kategorii aktualności'),
	(96, 'polls_categories_add', 'polls_categories', 'add', 'Dodawanie kategorii sond'),
	(97, 'polls_categories_edit', 'polls_categories', 'edit', 'Edycja kategorii sond'),
	(98, 'polls_categories_index', 'polls_categories', 'index', 'Lista kategorii sond'),
	(103, 'news_categories_delete', 'news_categories', 'delete', 'Usuwanie kategorii aktualności'),
	(108, 'polls_categories_delete', 'polls_categories', 'delete', 'Usuwanie kategorii sond'),
	(109, 'contact_forms_index', 'contact_forms', 'index', 'Lista formularzy kontaktowych'),
	(110, 'contact_forms_add', 'contact_forms', 'add', 'Dodawanie formularzy kontaktowych'),
	(111, 'contact_forms_edit', 'contact_forms', 'edit', 'Edycja formularzy kontaktowych'),
	(112, 'contact_forms_delete', 'contact_forms', 'delete', 'Usuwanie formularzy kontaktowych'),
	(113, 'boxes_index', 'boxes', 'index', 'Lista boksów'),
	(114, 'boxes_add', 'boxes', 'add', 'Dodawanie boksów'),
	(115, 'boxes_edit', 'boxes', 'edit', 'Edycja boksów'),
	(116, 'boxes_delete', 'boxes', 'delete', 'Usuwanie boksów'),
	(117, 'galleries_element_position', 'galleries', 'element_position', 'Zmiana kolejności obrazów w galerii'),
	(118, 'slider_index', 'slider', 'index', 'Lista elementów slidera'),
	(119, 'slider_add', 'slider', 'add', 'Dodawanie elementów slidera'),
	(120, 'slider_edit', 'slider', 'edit', 'Edycja elementów slidera'),
	(121, 'slider_delete', 'slider', 'delete', 'Usuwanie elementów slidera'),
	(122, 'slider_element_position', 'slider', 'element_position', 'Zmiana kolejności elementów slidera'),
	(124, 'galleries_update_image', 'galleries', 'update_image', 'Zmiana opisu (alt) zdjęcia'),
	(33, 'products_categories_index', 'products_categories', 'index', 'Lista kategorii produktów'),
	(34, 'products_categories_add', 'products_categories', 'add', 'Dodawanie kategorii produktów'),
	(35, 'products_categories_edit', 'products_categories', 'edit', 'Edycja kategorii produktów'),
	(36, 'products_categories_delete', 'products_categories', 'delete', 'Usuwanie kategorii produktów'),
	(37, 'products_index', 'products', 'index', 'Lista produktów'),
	(38, 'products_add', 'products', 'add', 'Dodawanie produktów'),
	(39, 'products_edit', 'products', 'edit', 'Edycja produktów'),
	(40, 'products_delete', 'products', 'delete', 'Usuwanie produktów'),
	(47, 'reports_index', 'reports', 'index', 'Lista raportów'),
	(48, 'reports_view', 'reports', 'view', 'Podgląd raportu'),
	(49, 'reports_delete', 'reports', 'delete', 'Usuwanie raportów'),
	(69, 'orders_index', 'orders', 'index', 'Lista zamówień'),
	(70, 'orders_edit', 'orders', 'edit', 'Edycja zamówienia'),
	(71, 'orders_view', 'orders', 'view', 'Podgląd zamówienia'),
	(72, 'orders_delete', 'orders', 'delete', 'Usuwanie zamówień'),
	(73, 'attributes_index', 'attributes', 'index', 'Lista atrybutów'),
	(74, 'attributes_add', 'attributes', 'add', 'Dodawanie atrybutów'),
	(75, 'attributes_edit', 'attributes', 'edit', 'Edycja atrybutów'),
	(76, 'attributes_delete', 'attributes', 'delete', 'Usuwanie atrybutów'),
	(77, 'parameters_index', 'parameters', 'index', 'Lista parametrów'),
	(78, 'parameters_add', 'parameters', 'add', 'Dodawanie parametrów'),
	(79, 'parameters_edit', 'parameters', 'edit', 'Edycja parametrów'),
	(80, 'parameters_delete', 'parameters', 'delete', 'Usuwanie parametrów'),
	(81, 'producers_index', 'producers', 'index', 'Lista producentów'),
	(82, 'producers_add', 'producers', 'add', 'Dodawanie producentów'),
	(83, 'producers_edit', 'producers', 'edit', 'Edycja producentów'),
	(84, 'producers_delete', 'producers', 'delete', 'Usuwanie producentów'),
	(85, 'rebates_groups_index', 'rebates_groups', 'index', 'Lista grup rabatowych'),
	(86, 'rebates_groups_add', 'rebates_groups', 'add', 'Dodawanie grup rabatowych'),
	(87, 'rebates_groups_edit', 'rebates_groups', 'edit', 'Edycja grup rabatowych'),
	(88, 'rebates_groups_delete', 'rebates_groups', 'delete', 'Usuwanie grup rabatowych'),
	(89, 'products_statuses_index', 'products_statuses', 'index', 'Lista statusów produktów'),
	(90, 'products_statuses_add', 'products_statuses', 'add', 'Dodawanie statusów produktów'),
	(91, 'products_statuses_edit', 'products_statuses', 'edit', 'Edycja statusów produktów'),
	(92, 'products_statuses_delete', 'products_statuses', 'delete', 'usuwanie statusów produktów'),
	(99, 'attributes_values_index', 'attributes_values', 'indes', 'Lista wartości atrybutu'),
	(100, 'attributes_values_add', 'attributes_values', 'add', 'Dodawanie wartości atrybutu'),
	(101, 'attributes_values_edit', 'attributes_values', 'edit', 'Edycja wartości atrybutu'),
	(102, 'attributes_values_delete', 'attributes_values', 'delete', 'Usuwanie wartości atrybutu'),
	(104, 'taxes_index', 'taxes', 'index', 'Lista wartości VAT'),
	(105, 'taxes_add', 'taxes', 'add', 'Dodawanie wartości VAT'),
	(106, 'taxes_edit', 'taxes', 'edit', 'Edytowanie wartości VAT'),
	(107, 'taxes_delete', 'taxes', 'delete', 'Usuwanie wartości VAT'),
	(125, 'customers_index', 'customers', 'index', 'Lista klientów'),
	(126, 'customers_add', 'customers', 'add', 'Dodawanie klientów'),
	(127, 'customers_edit', 'customers', 'edit', 'Edycja klientów'),
	(128, 'customers_delete', 'customers', 'delete', 'Usuwanie klientów'),
	(129, 'delivery_types_index', 'delivery_types', 'index', 'Lista rodzajów dostaw'),
	(130, 'delivery_types_add', 'delivery_types', 'add', 'Dodawanie rodzaju dostawy'),
	(131, 'delivery_types_edit', 'delivery_types', 'edit', 'Edycja rodzaju dostawy'),
	(132, 'delivery_types_delete', 'delivery_types', 'delete', 'Usuwanie rodzaju dostawy'),
	(133, 'payment_types_index', 'payment_types', 'index', 'Lista rodzajów płatności'),
	(134, 'payment_types_add', 'payment_types', 'add', 'Dodawanie rodzajów płatności'),
	(135, 'payment_types_edit', 'payment_types', 'edit', 'Edycja rodzajów płatności'),
	(136, 'payment_types_delete', 'payment_types', 'delete', 'Usuwanie rodzajów płatności'),
	(137, 'orders_add', 'orders', 'add', 'Dodawanie zamówień'),
	(138, 'questions_index', 'questions', 'index', 'Lista zapytań od klientów'),
	(139, 'questions_preview', 'questions', 'preview', 'Podgląd szczegółów zapytań od klientów'),
	(140, 'questions_delete', 'questions', 'delete', 'Usuwanie zapytań od klientów'),
	(141, 'banners_delete', 'banners', 'delete', 'Usuwanie bannerów'),
	(142, 'banners_edit', 'banners', 'edit', 'Edycja bannerów'),
	(143, 'banners_add', 'banners', 'add', 'Dodawanie bannerów'),
	(144, 'banners_index', 'banners', 'index', 'Lista bannerów'),
	(145, 'shop_index', 'shop', 'index', 'Sklep'),
	(146, 'pages_settings_edit', 'pages', 'settings_edit', 'Edycja ustawień strony'),
	(147, 'currencies_index', 'currencies', 'index', 'Waluty'),
	(148, 'currencies_add', 'currencies', 'add', 'Edycja waluty'),
	(149, 'currencies_edit', 'currencies', 'edit', 'Edycja waluty'),
	(150, 'currencies_delete', 'currencies', 'delete', 'Usuwanie waluty'),
	(151, 'partners_index', 'partners', 'index', 'Lista partnerów'),
	(152, 'partners_add', 'partners', 'add', 'Dodawanie partnerów'),
	(153, 'partners_edit', 'partners', 'edit', 'Edycja partnera'),
	(154, 'partners_delete', 'partners', 'delete', 'Usuwanie partnera'),
	(155, 'rebates_codes_index', 'rebates_codes', 'index', 'Lista kodów rabatowych'),
	(156, 'rebates_codes_add', 'rebates_codes', 'add', 'Dodawanie kodów rabatowych'),
	(157, 'rebates_codes_edit', 'rebates_codes', 'edit', 'Edycja kodów rabatowych'),
	(158, 'rebates_codes_delete', 'rebates_codes', 'delete', 'Usuwanie kodów rabatowych'),
	(159, 'slider_elements_news_all', 'slider_elements', 'news_all', 'Aktualność na sliderze (pełny dostęp)'),
	(160, 'slider_elements_news_for_slider_all', 'slider_elements', 'news_for_slider_all', 'Aktualność dla slidera (pełny dostęp)'),
	(161, 'slider_elements_image_all', 'slider_elements', 'image_all', 'Zdjęcie na slider'),
	(162, 'variants', 'variants', 'all', 'Warianty produktów (pełne uprawnienia)');
/*!40000 ALTER TABLE `acl_permissions` ENABLE KEYS */;

-- Zrzucanie danych dla tabeli cms2.acl_roles: 2 rows
DELETE FROM `acl_roles`;
/*!40000 ALTER TABLE `acl_roles` DISABLE KEYS */;
INSERT INTO `acl_roles` (`id_role`, `name`, `description`, `parent_role_id`, `date_added`, `status`, `acl`) VALUES
	(13, 'administrator', '', 13, 1270017733, 'Y', '\'O:8:\\"Zend_Acl\\":6:{s:16:\\"\\0*\\0_roleRegistry\\";O:22:\\"Zend_Acl_Role_Registry\\":1:{s:9:\\"\\0*\\0_roles\\";a:1:{s:13:\\"administrator\\";a:3:{s:8:\\"instance\\";O:13:\\"Zend_Acl_Role\\":1:{s:10:\\"\\0*\\0_roleId\\";s:13:\\"administrator\\";}s:7:\\"parents\\";a:0:{}s:8:\\"children\\";a:0:{}}}}s:13:\\"\\0*\\0_resources\\";a:0:{}s:17:\\"\\0*\\0_isAllowedRole\\";N;s:21:\\"\\0*\\0_isAllowedResource\\";N;s:22:\\"\\0*\\0_isAllowedPrivilege\\";N;s:9:\\"\\0*\\0_rules\\";a:2:{s:12:\\"allResources\\";a:2:{s:8:\\"allRoles\\";a:2:{s:13:\\"allPrivileges\\";a:2:{s:4:\\"type\\";s:9:\\"TYPE_DENY\\";s:6:\\"assert\\";N;}s:13:\\"byPrivilegeId\\";a:0:{}}s:8:\\"byRoleId\\";a:1:{s:13:\\"administrator\\";a:2:{s:13:\\"byPrivilegeId\\";a:0:{}s:13:\\"allPrivileges\\";a:2:{s:4:\\"type\\";s:10:\\"TYPE_ALLOW\\";s:6:\\"assert\\";N;}}}}s:12:\\"byResourceId\\";a:0:{}}}\''),
	(39, 'demo', '', 13, 1358253023, 'Y', '');
/*!40000 ALTER TABLE `acl_roles` ENABLE KEYS */;

-- Zrzucanie danych dla tabeli cms2.acl_roles_permissions: 196 rows
DELETE FROM `acl_roles_permissions`;
/*!40000 ALTER TABLE `acl_roles_permissions` DISABLE KEYS */;
INSERT INTO `acl_roles_permissions` (`role_id`, `permission_id`) VALUES
	(13, 1),
	(13, 107),
	(13, 106),
	(13, 105),
	(13, 104),
	(13, 49),
	(13, 48),
	(13, 47),
	(13, 88),
	(13, 87),
	(13, 86),
	(13, 85),
	(13, 92),
	(13, 91),
	(13, 90),
	(13, 89),
	(13, 36),
	(13, 35),
	(13, 34),
	(13, 33),
	(13, 40),
	(13, 39),
	(13, 38),
	(13, 37),
	(13, 84),
	(13, 83),
	(13, 82),
	(13, 81),
	(13, 3),
	(13, 2),
	(13, 8),
	(13, 7),
	(13, 6),
	(13, 5),
	(13, 108),
	(13, 98),
	(13, 97),
	(13, 96),
	(13, 68),
	(13, 67),
	(13, 120),
	(13, 119),
	(13, 118),
	(13, 117),
	(13, 80),
	(13, 79),
	(13, 78),
	(13, 77),
	(13, 122),
	(13, 0),
	(13, 66),
	(13, 65),
	(13, 13),
	(13, 12),
	(13, 11),
	(13, 10),
	(13, 9),
	(13, 56),
	(13, 72),
	(13, 71),
	(13, 70),
	(13, 69),
	(13, 60),
	(13, 32),
	(13, 31),
	(13, 30),
	(13, 29),
	(13, 95),
	(13, 94),
	(13, 93),
	(13, 51),
	(13, 50),
	(13, 24),
	(13, 23),
	(13, 22),
	(13, 21),
	(13, 20),
	(13, 19),
	(13, 18),
	(13, 17),
	(13, 16),
	(13, 15),
	(13, 14),
	(13, 28),
	(13, 27),
	(13, 26),
	(13, 25),
	(13, 63),
	(13, 62),
	(13, 61),
	(13, 46),
	(13, 45),
	(13, 0),
	(13, 44),
	(13, 43),
	(13, 42),
	(13, 116),
	(13, 115),
	(13, 114),
	(13, 113),
	(13, 41),
	(13, 55),
	(13, 54),
	(13, 53),
	(13, 52),
	(13, 102),
	(13, 101),
	(13, 100),
	(13, 99),
	(13, 76),
	(13, 75),
	(13, 74),
	(13, 73),
	(13, 112),
	(13, 123),
	(13, 124),
	(39, 118),
	(39, 31),
	(39, 122),
	(39, 121),
	(39, 120),
	(39, 56),
	(39, 29),
	(39, 119),
	(39, 58),
	(39, 60),
	(39, 124),
	(13, 111),
	(13, 110),
	(13, 109),
	(13, 64),
	(39, 41),
	(39, 117),
	(39, 46),
	(39, 45),
	(13, 4),
	(13, 57),
	(13, 58),
	(13, 59),
	(39, 161),
	(39, 28),
	(39, 26),
	(39, 44),
	(39, 55),
	(39, 54),
	(39, 53),
	(39, 52),
	(39, 111),
	(39, 64),
	(39, 116),
	(39, 115),
	(39, 114),
	(39, 113),
	(39, 88),
	(39, 87),
	(39, 86),
	(39, 85),
	(39, 83),
	(39, 81),
	(39, 135),
	(39, 133),
	(39, 95),
	(39, 93),
	(39, 27),
	(39, 25),
	(39, 109),
	(39, 99),
	(39, 100),
	(39, 101),
	(39, 102),
	(39, 125),
	(39, 126),
	(39, 127),
	(39, 128),
	(39, 129),
	(39, 43),
	(39, 131),
	(39, 42),
	(39, 37),
	(39, 38),
	(39, 39),
	(39, 40),
	(39, 33),
	(39, 34),
	(39, 35),
	(39, 36),
	(39, 89),
	(39, 90),
	(39, 91),
	(39, 92),
	(39, 145),
	(39, 69),
	(39, 70),
	(39, 71),
	(39, 72),
	(39, 137);
/*!40000 ALTER TABLE `acl_roles_permissions` ENABLE KEYS */;

-- Zrzucanie danych dla tabeli cms2.acl_users: 4 rows
DELETE FROM `acl_users`;
/*!40000 ALTER TABLE `acl_users` DISABLE KEYS */;
INSERT INTO `acl_users` (`id_user`, `email`, `first_name`, `last_name`, `username`, `password`, `date_added`, `last_login_date`, `logged_times`, `acl`, `role_id`, `status`, `verify_string`, `verified`, `image_id`) VALUES
	(16, 'olicom@olicom.pl', 'Admin', 'Olicom', '', '*F2651DAB851BC94D1C6E3F08C9C68E89C0AF4484', '1270034596', '1429253334', 136, NULL, 13, 'Y', NULL, NULL, 6),
	(19, 'demo@demo.pl', 'Admin', 'Demo', '', '*AB505E4F9AC59C3C8B6D4B859D1818F53DD82E6C', '1358253160', '1406031624', 17, NULL, 39, 'Y', NULL, NULL, NULL),
	(27, 'hubert@olicom.pl', 'test', 'test', '', '*32A0D6E18BB87F5C807AAC3CF34D9DBF0DE35277', '1387104785', '', 0, NULL, 13, 'Y', '35b80e17d736cfc1f9ce95252833e046', NULL, 5),
	(28, 'dedra@dedra.info', 'dedra', 'dedra', '', '*0B8FBE81AAC86DB0F1037709C42E75660D4728CA', '1388742169', '1388742229', 2, NULL, 41, 'Y', NULL, NULL, NULL);
/*!40000 ALTER TABLE `acl_users` ENABLE KEYS */;

-- Zrzucanie danych dla tabeli cms2.acl_users_images: 2 rows
DELETE FROM `acl_users_images`;
/*!40000 ALTER TABLE `acl_users_images` DISABLE KEYS */;
INSERT INTO `acl_users_images` (`id_image`, `filename`, `realfilename`, `mainimage`, `alt`) VALUES
	(5, '1387104785152ad8a1192ada415543402.jpg', 'good_job.jpg', 0, ''),
	(6, '1387107810152ad95e2c5333398476443.png', 'olicom-logo-140.png', 0, '');
/*!40000 ALTER TABLE `acl_users_images` ENABLE KEYS */;

-- Zrzucanie danych dla tabeli cms2.boxes: 3 rows
DELETE FROM `boxes`;
/*!40000 ALTER TABLE `boxes` DISABLE KEYS */;
INSERT INTO `boxes` (`id_boxes`, `name`, `title`, `contents`, `link`, `active`, `position`, `lang`, `filename`, `boxes_set_id`) VALUES
	(13, 't1', 't1', '', 'http://google.pl', 1, NULL, 'pl_PL', '1404993573153be802586b05594204476.jpg', 14),
	(11, 'asd', 'asd', '', 'asdasd', 1, NULL, 'pl_PL', NULL, 6),
	(12, 'adsad', 'asdads', '', '', 1, NULL, 'pl_PL', NULL, 13);
/*!40000 ALTER TABLE `boxes` ENABLE KEYS */;

-- Zrzucanie danych dla tabeli cms2.boxes_set: 1 rows
DELETE FROM `boxes_set`;
/*!40000 ALTER TABLE `boxes_set` DISABLE KEYS */;
INSERT INTO `boxes_set` (`id_boxes_set`, `name`, `description`, `element_id`, `show_title`) VALUES
	(14, 'boksy', 'test', 59, 'Y');
/*!40000 ALTER TABLE `boxes_set` ENABLE KEYS */;

-- Zrzucanie danych dla tabeli cms2.configuration: 8 rows
DELETE FROM `configuration`;
/*!40000 ALTER TABLE `configuration` DISABLE KEYS */;
INSERT INTO `configuration` (`id_configuration`, `key`, `value`, `name`, `desc`, `group`, `type`) VALUES
	(1, 'administrator_email', 'demo@olicom.pl', 'Email', 'Adres z którego wysyłane są emaile z systemu', '', 'text'),
	(2, 'administrator_name', 'Admin', 'Nazwa', 'Pole "Od" w wysyłanych e-mailach z systemu', '', 'text'),
	(3, 'sending_email', 'demo@olicom.pl', 'Newsletter email', 'Adres z którego wysyłane są emaile newslettera', '', 'text'),
	(4, 'sending_name', 'Newsletter', 'Newsletter nazwa', 'Pole "Od" w wysyłanych e-mailach newslettera', '', 'text'),
	(5, 'google_tracking_code', '', 'Google Analytics', 'Kod do statystyk (UA-xxxxxxxxx-xx)', '', 'text'),
	(6, 'page_name', 'Trzy korony', 'Nazwa strony', 'Używana w mailach', '', 'text'),
	(7, 'page_domain', 'olishop.olicom.com.pl', 'Domena', 'Domena używama m.in. w mailach', '', 'text'),
	(8, 'firm_address', '<strong>nazwa firmy</strong><br/>\r\nul. Ulica 22<br/>\r\n11-222 Poznań<br/><br/>\r\nmobile:<br/>\r\n+48 555 444 222<br/>\r\n+48 33 444 55 66<br/>\r\nemail: <a href="mailto:demo@olicom.pl">demo@olicom.pl</a>', 'Adres firmy', 'Używany w mailach.', '', 'textarea');
/*!40000 ALTER TABLE `configuration` ENABLE KEYS */;

-- Zrzucanie danych dla tabeli cms2.contact_forms: 1 rows
DELETE FROM `contact_forms`;
/*!40000 ALTER TABLE `contact_forms` DISABLE KEYS */;
INSERT INTO `contact_forms` (`id_contact_form`, `element_id`, `title`, `language`, `sender_email`, `receiver_email`, `has_captcha`, `show_title`) VALUES
	(3, 23, 'Formularz kontaktowy', 'pl_PL', 'pawel@olicom.pl', 'hubert@olicom.pl', 'Y', 'Y');
/*!40000 ALTER TABLE `contact_forms` ENABLE KEYS */;

-- Zrzucanie danych dla tabeli cms2.contact_forms_log: 6 rows
DELETE FROM `contact_forms_log`;
/*!40000 ALTER TABLE `contact_forms_log` DISABLE KEYS */;
INSERT INTO `contact_forms_log` (`id_contact_form_log`, `ip_address`, `date_sent`, `email`, `name`, `phone`, `message`, `topic`) VALUES
	(1, '::1', 1389619744, 'pawel@olicom.org.pl', 'Akcesoria', 'dsa', 'dsa', 'test'),
	(2, '127.0.0.1', 1392213439, 'hubert@olicom.pl', 'Hubert', '333444555', 'Test formularza', 'test formularza'),
	(3, '127.0.0.1', 1402407552, 'hubert@olicom.pl', 'Hubert', '555666777', 'teswt', 'test'),
	(4, '127.0.0.1', 1402408451, 'hubert@olicom.pl', 'Hubert', '555666777', 'test', 'Test'),
	(5, '127.0.0.1', 1402475221, 'filip@olicom.pl', 'Hubert', '555666777', 'test', 'test'),
	(6, '127.0.0.1', 1402475583, 'filip@olicom.pl', 'Hubert', '555666777', 'testttttt', 'Testttttt');
/*!40000 ALTER TABLE `contact_forms_log` ENABLE KEYS */;

-- Zrzucanie danych dla tabeli cms2.dict_states: 16 rows
DELETE FROM `dict_states`;
/*!40000 ALTER TABLE `dict_states` DISABLE KEYS */;
INSERT INTO `dict_states` (`id_states_dict`, `state_name`) VALUES
	(1, 'Dolnośląskie'),
	(2, 'Kujawsko-pomorskie'),
	(3, 'Lubelskie'),
	(4, 'Lubuskie'),
	(5, 'Łódzkie'),
	(6, 'Małopolskie'),
	(7, 'Mazowieckie'),
	(8, 'Opolskie'),
	(9, 'Podlaskie'),
	(10, 'Podkarpackie'),
	(11, 'Pomorskie'),
	(12, 'Śląskie'),
	(13, 'Świętokrzyskie'),
	(14, 'Warmińsko-mazurskie'),
	(15, 'Wielkopolskie'),
	(16, 'Zachodniopomorskie');
/*!40000 ALTER TABLE `dict_states` ENABLE KEYS */;

-- Zrzucanie danych dla tabeli cms2.dotpay_logs: 0 rows
DELETE FROM `dotpay_logs`;
/*!40000 ALTER TABLE `dotpay_logs` DISABLE KEYS */;
/*!40000 ALTER TABLE `dotpay_logs` ENABLE KEYS */;

-- Zrzucanie danych dla tabeli cms2.elements: 14 rows
DELETE FROM `elements`;
/*!40000 ALTER TABLE `elements` DISABLE KEYS */;
INSERT INTO `elements` (`id_element`, `type`, `date_added`, `modified_date`, `lang`, `available`) VALUES
	(58, 'polls', 1403701643, NULL, 'pl_PL', 1),
	(23, 'contact_form', 1387373524, 1402475608, 'pl_PL', 1),
	(64, 'galleries', 1406803685, NULL, 'pl_PL', 1),
	(27, 'page_content', 1389873612, NULL, 'en_US', 1),
	(24, 'page_content', 1387377484, 1403704718, 'pl_PL', 1),
	(26, 'page_content', 1389188412, NULL, 'pl_PL', 1),
	(28, 'page_content', 1389873896, NULL, 'de_DE', 1),
	(65, 'galleries', 1406803718, NULL, 'pl_PL', 1),
	(41, 'page_content', 1402995210, NULL, 'pl_PL', 1),
	(31, 'news', 1401094898, 1403773630, 'pl_PL', 1),
	(59, 'boxes', 1404993549, NULL, 'pl_PL', 1),
	(43, 'galleries', 1403603700, NULL, 'pl_PL', 1),
	(42, 'page_content', 1402995230, NULL, 'pl_PL', 1),
	(60, 'polls', 1406279299, NULL, 'en_US', 1);
/*!40000 ALTER TABLE `elements` ENABLE KEYS */;

-- Zrzucanie danych dla tabeli cms2.galleries: 3 rows
DELETE FROM `galleries`;
/*!40000 ALTER TABLE `galleries` DISABLE KEYS */;
INSERT INTO `galleries` (`id_gallery`, `name`, `description`, `element_id`, `show_title`) VALUES
	(8, 'Galeria', '', 43, 'Y'),
	(10, 'Test Galerii', '', 64, 'Y'),
	(11, 'Gal22', 'asasdsd', 65, 'Y');
/*!40000 ALTER TABLE `galleries` ENABLE KEYS */;

-- Zrzucanie danych dla tabeli cms2.galleries_images: 12 rows
DELETE FROM `galleries_images`;
/*!40000 ALTER TABLE `galleries_images` DISABLE KEYS */;
INSERT INTO `galleries_images` (`id_galleries_images`, `image_id`, `gallery_id`, `alt`, `lang`) VALUES
	(44, 44, 11, '', ''),
	(37, 37, 8, '', ''),
	(43, 43, 10, '1', ''),
	(34, 34, 8, '', ''),
	(35, 35, 8, '', ''),
	(36, 36, 8, '', ''),
	(39, 39, 8, '', ''),
	(46, 46, 11, '', ''),
	(48, 48, 10, '', ''),
	(49, 49, 10, '', ''),
	(50, 50, 11, '', ''),
	(51, 51, 11, '', '');
/*!40000 ALTER TABLE `galleries_images` ENABLE KEYS */;

-- Zrzucanie danych dla tabeli cms2.gallery_images: 12 rows
DELETE FROM `gallery_images`;
/*!40000 ALTER TABLE `gallery_images` DISABLE KEYS */;
INSERT INTO `gallery_images` (`id_image`, `filename`, `realfilename`, `mainimage`, `position`) VALUES
	(50, '1406809630153da361e742b7153501608.jpg', 'slogan2.jpg', 0, 2),
	(49, '1406809616153da3610da544202134174.jpg', 'slogan3.jpg', 0, 3),
	(43, '1406803788153da1f4c3953c004720381.jpg', 'slogan4.jpg', 0, 1),
	(34, '1403771263153abd97f3cc83728653350.png', 'adwords.png', 0, 1),
	(35, '1403771267153abd9837ed92772976768.png', 'aktualizacjawww.png', 0, 2),
	(36, '1403771271153abd987427bc855951406.png', 'appfb.png', 0, 3),
	(37, '1403771276153abd98c12a11050945749.png', 'appwww.png', 0, 4),
	(44, '1406803832153da1f78b8959062999944.jpg', 'logo.jpg', 0, 0),
	(39, '1403771280153abd990e45de409496393.png', 'autyd.png', 0, 6),
	(46, '1406804017153da203137690546375021.jpg', 'slogan1.jpg', 0, 1),
	(48, '1406806299153da291bb1b09958477581.jpg', 'logo.jpg', 0, 2),
	(51, '1406814216153da480811903449861219.jpg', 'slogan2.jpg', 0, 3);
/*!40000 ALTER TABLE `gallery_images` ENABLE KEYS */;

-- Zrzucanie danych dla tabeli cms2.images: 2 rows
DELETE FROM `images`;
/*!40000 ALTER TABLE `images` DISABLE KEYS */;
INSERT INTO `images` (`id_image`, `filename`, `realfilename`, `mainimage`, `alt`) VALUES
	(9, '1403077593153a143d9a6304108755628.jpg', 'presta123.jpg', 0, 'SKLEPY INTERNETOWE Oparte na PrestaShop'),
	(10, '1403077846153a144d68751d077247374.jpg', 'promocja.jpg', 0, 'Promocja');
/*!40000 ALTER TABLE `images` ENABLE KEYS */;

-- Zrzucanie danych dla tabeli cms2.languages: 1 rows
DELETE FROM `languages`;
/*!40000 ALTER TABLE `languages` DISABLE KEYS */;
INSERT INTO `languages` (`id_language`, `name`, `description`, `flag`) VALUES
	(1, 'pl_PL', 'polish', 'pl.png');
/*!40000 ALTER TABLE `languages` ENABLE KEYS */;

-- Zrzucanie danych dla tabeli cms2.medias: 3 rows
DELETE FROM `medias`;
/*!40000 ALTER TABLE `medias` DISABLE KEYS */;
INSERT INTO `medias` (`id_media`, `file_name`, `mime_type_id`) VALUES
	(1, '1-lktextpage.jpg', 1),
	(2, '2-lkcontact.jpg', 1),
	(4, '4-2014-06-05131809.jpg', 1);
/*!40000 ALTER TABLE `medias` ENABLE KEYS */;

-- Zrzucanie danych dla tabeli cms2.medias_mime_types: 10 rows
DELETE FROM `medias_mime_types`;
/*!40000 ALTER TABLE `medias_mime_types` DISABLE KEYS */;
INSERT INTO `medias_mime_types` (`id_mime_type`, `mime_type`, `type`) VALUES
	(1, 'image/jpeg', 'images'),
	(2, 'image/png', 'images'),
	(3, 'image/gif', 'images'),
	(4, 'text/plain', 'others'),
	(5, 'application/octet-stream', 'others'),
	(6, 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'others'),
	(7, 'application/pdf', 'others'),
	(8, 'application/zip', 'others'),
	(9, 'video/mpeg', 'others'),
	(10, 'application/msword', 'others');
/*!40000 ALTER TABLE `medias_mime_types` ENABLE KEYS */;

-- Zrzucanie danych dla tabeli cms2.medias_product: 0 rows
DELETE FROM `medias_product`;
/*!40000 ALTER TABLE `medias_product` DISABLE KEYS */;
/*!40000 ALTER TABLE `medias_product` ENABLE KEYS */;

-- Zrzucanie danych dla tabeli cms2.news: 3 rows
DELETE FROM `news`;
/*!40000 ALTER TABLE `news` DISABLE KEYS */;
INSERT INTO `news` (`id_news`, `title`, `lang`, `short_description`, `description`, `date_added`, `modified_date`, `available`, `news_start_date`, `news_end_date`, `position`, `meta_title`, `meta_description`, `meta_keywords`, `url`) VALUES
	(9, 'Sklepy internetowe oparte na PrestaShop', 'pl_PL', '<h3>PROFESJONALNE<br />SKLEPY INTERNETOWE</h3>\r\n<p>Oparte na&nbsp;<strong>PrestaShop</strong></p>', '<h2>DLACZEGO WARTO?<br /><br /></h2>\r\n<ul>\r\n<li>Atrakcyjna i przejrzysta szata graficzna do wyboru</li>\r\n<li>Płatności online</li>\r\n<li>Wygodny i łatwy w obsłudze panel administracyjny</li>\r\n<li>Kompleksowe zarządzanie produktem i magazynem</li>\r\n</ul>\r\n<ul>\r\n<li>Wersja mobilna</li>\r\n<li>Możliwość&nbsp;zakładania&nbsp;kont&nbsp;pracownikom i nadawania uprawnień</li>\r\n<li>Własny adres www i poczta e-mail</li>\r\n<li>Atrakcyjna cena od 2499 zł</li>\r\n<li>Domena i hosting&nbsp;<strong>gratis!</strong></li>\r\n</ul>', 1403077591, NULL, 1, 0, 0, NULL, '', '', '', ''),
	(10, 'Promocja', 'pl_PL', '<h3>PROFESJONALNE<br />STRONY<br />INTERNETOWE&nbsp;</h3>\r\n<p>W cenie&nbsp;<strong>699 zł</strong>.</p>', '<h2>CO OFERUJEMY</h2>\r\n<ul>\r\n<li>Prosty w obsłudze panel do samodzielnej edycji treści strony</li>\r\n<li>Wersja mobilna strony</li>\r\n<li>Możliwość dodania nieograniczonej ilości zdjęć</li>\r\n</ul>\r\n<ul>\r\n<li>Własny adres www i poczta e-mail</li>\r\n<li>Darmowa domena i hosting</li>\r\n<li>Brak ukrytych opłat</li>\r\n<li>Czytelna mapa dojazdu na stronie.</li>\r\n</ul>', 1403077844, 1403782587, 1, 0, 0, NULL, '', '', '', ''),
	(12, 'Aktualność testowa', 'pl_PL', '<p>asdasdas</p>', '<p>asasadsdasdas</p>', 1406800418, NULL, 1, 0, 0, NULL, 'aasddsasd', '', '', '');
/*!40000 ALTER TABLE `news` ENABLE KEYS */;

-- Zrzucanie danych dla tabeli cms2.newsletters: 2 rows
DELETE FROM `newsletters`;
/*!40000 ALTER TABLE `newsletters` DISABLE KEYS */;
INSERT INTO `newsletters` (`id_newsletter`, `language`, `title`, `content`, `date_added`, `date_sent`, `interval`, `bulk`) VALUES
	(1, 'pl_PL', 'Newsletter 1', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla tortor libero, dapibus in lobortis eget, sollicitudin vel quam. Phasellus neque nisl, posuere bibendum pretium eu, elementum a nunc. Phasellus varius fermentum consequat. Donec rutrum turpis at mi accumsan rhoncus. Curabitur aliquet arcu in eros pulvinar in pellentesque sapien volutpat. Donec id nibh id ligula mattis condimentum. In in eros eros, vel porttitor diam. Vestibulum ornare ornare dui sit amet rhoncus. Proin at porta diam. Morbi porta imperdiet metus, sit amet vestibulum leo luctus id. Aliquam posuere justo non felis facilisis vel vehicula purus aliquam. Cras mi neque, lobortis adipiscing laoreet quis, dapibus a mi. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Ut pellentesque, nisi vitae congue egestas, sem mi cursus odio, et consequat massa ligula ac dolor. Cras ultricies odio sit amet mi pulvinar sit amet pulvinar orci malesuada. Cras tellus eros, condimentum id hendrerit ac, aliquam a tellus. Nullam elementum placerat dictum. Duis sodales gravida eros, ac iaculis sem pulvinar ut. Cras mattis, leo varius dapibus varius, ipsum justo feugiat nibh, ut imperdiet est dolor ac nibh. Duis et consequat lectus.</p>\r\n<p>Nam ut placerat nibh. Morbi volutpat volutpat elit, ut aliquam odio ornare vel. Aliquam quis erat libero. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. In ac lacus faucibus mi facilisis tempus quis in eros. Praesent sodales fringilla nisl nec tincidunt. Vivamus tristique massa nunc, in eleifend tortor. Quisque adipiscing urna ac erat lacinia fringilla auctor dolor facilisis. Vivamus posuere eleifend ante non pulvinar. Suspendisse enim metus, dapibus ac porttitor vitae, iaculis id sem.</p>\r\n<p>Fusce sodales cursus consequat. Integer congue faucibus orci non tincidunt. In hac habitasse platea dictumst. Sed viverra lacus sit amet nisl imperdiet eget auctor mi lacinia. Quisque odio felis, porta non fringilla eget, sodales ac neque. Etiam tincidunt volutpat libero vel vehicula. Morbi eget leo id orci porttitor rutrum. Sed sollicitudin, elit a posuere tempor, risus est aliquet quam, sit amet molestie massa lorem vel mauris. Cras pulvinar malesuada iaculis. Donec aliquet lacus vel nunc gravida consequat. In in metus dui. Ut enim sapien, lobortis id sagittis eu, viverra ac purus.</p>', 1311941964, 1311942063, 60000, 20),
	(2, 'pl_PL', 'TEST', '<p>Lorem ipsum....</p>', 1384560957, 1403783056, 60000, 20);
/*!40000 ALTER TABLE `newsletters` ENABLE KEYS */;

-- Zrzucanie danych dla tabeli cms2.newsletters_attachments: 0 rows
DELETE FROM `newsletters_attachments`;
/*!40000 ALTER TABLE `newsletters_attachments` DISABLE KEYS */;
/*!40000 ALTER TABLE `newsletters_attachments` ENABLE KEYS */;

-- Zrzucanie danych dla tabeli cms2.newsletters_newsletter_groups: 2 rows
DELETE FROM `newsletters_newsletter_groups`;
/*!40000 ALTER TABLE `newsletters_newsletter_groups` DISABLE KEYS */;
INSERT INTO `newsletters_newsletter_groups` (`newsletter_id`, `newsletter_group_id`) VALUES
	(1, 1),
	(2, 1);
/*!40000 ALTER TABLE `newsletters_newsletter_groups` ENABLE KEYS */;

-- Zrzucanie danych dla tabeli cms2.newsletter_emails: 3 rows
DELETE FROM `newsletter_emails`;
/*!40000 ALTER TABLE `newsletter_emails` DISABLE KEYS */;
INSERT INTO `newsletter_emails` (`id_email`, `name`, `email`, `verify_string`, `verified`, `newsletter_email_active`) VALUES
	(1, 'Tomasz Drgas', 'tomek@olicom.pl', '6ebkorl4', 1, 'Y'),
	(4, '', 'kamil@olicom.pl', 'yp542ioy', 0, 'Y'),
	(6, 'Hubert', 'hubert@olicom.pl', 'cjngkq60', 1, 'Y');
/*!40000 ALTER TABLE `newsletter_emails` ENABLE KEYS */;

-- Zrzucanie danych dla tabeli cms2.newsletter_email_groups: 6 rows
DELETE FROM `newsletter_email_groups`;
/*!40000 ALTER TABLE `newsletter_email_groups` DISABLE KEYS */;
INSERT INTO `newsletter_email_groups` (`newsletter_group_id`, `newsletter_email_id`) VALUES
	(1, 1),
	(1, 2),
	(1, 3),
	(1, 4),
	(1, 6),
	(2, 6);
/*!40000 ALTER TABLE `newsletter_email_groups` ENABLE KEYS */;

-- Zrzucanie danych dla tabeli cms2.newsletter_email_send: ~0 rows (około)
DELETE FROM `newsletter_email_send`;
/*!40000 ALTER TABLE `newsletter_email_send` DISABLE KEYS */;
/*!40000 ALTER TABLE `newsletter_email_send` ENABLE KEYS */;

-- Zrzucanie danych dla tabeli cms2.newsletter_groups: 2 rows
DELETE FROM `newsletter_groups`;
/*!40000 ALTER TABLE `newsletter_groups` DISABLE KEYS */;
INSERT INTO `newsletter_groups` (`id_newsletter_group`, `name`, `description`, `default_group`, `lang`) VALUES
	(1, 'Grupa domyślna PL', 'Domyslna grupa dla osób zapisanych do newslettera z polskiej wersji językowej witryny.', 1, 'pl_PL'),
	(2, 'Nowa grupa', 'Opis grupy\r\n', 0, 'pl_PL');
/*!40000 ALTER TABLE `newsletter_groups` ENABLE KEYS */;

-- Zrzucanie danych dla tabeli cms2.newsletter_images: 0 rows
DELETE FROM `newsletter_images`;
/*!40000 ALTER TABLE `newsletter_images` DISABLE KEYS */;
/*!40000 ALTER TABLE `newsletter_images` ENABLE KEYS */;

-- Zrzucanie danych dla tabeli cms2.news_categories: 1 rows
DELETE FROM `news_categories`;
/*!40000 ALTER TABLE `news_categories` DISABLE KEYS */;
INSERT INTO `news_categories` (`id_news_category`, `news_category_name`, `element_id`, `show_title`, `comments`) VALUES
	(3, 'Aktualności', 31, 'Y', 1);
/*!40000 ALTER TABLE `news_categories` ENABLE KEYS */;

-- Zrzucanie danych dla tabeli cms2.news_comments: 1 rows
DELETE FROM `news_comments`;
/*!40000 ALTER TABLE `news_comments` DISABLE KEYS */;
INSERT INTO `news_comments` (`id_news_comment`, `comment`, `news_id`, `nick`, `client_ip`) VALUES
	(1, 'test', 1, 'testtt', '127.0.0.1');
/*!40000 ALTER TABLE `news_comments` ENABLE KEYS */;

-- Zrzucanie danych dla tabeli cms2.news_elements: 0 rows
DELETE FROM `news_elements`;
/*!40000 ALTER TABLE `news_elements` DISABLE KEYS */;
/*!40000 ALTER TABLE `news_elements` ENABLE KEYS */;

-- Zrzucanie danych dla tabeli cms2.news_images: 2 rows
DELETE FROM `news_images`;
/*!40000 ALTER TABLE `news_images` DISABLE KEYS */;
INSERT INTO `news_images` (`news_id`, `images_id`, `id_news_images`) VALUES
	(9, 9, 9),
	(10, 10, 10);
/*!40000 ALTER TABLE `news_images` ENABLE KEYS */;

-- Zrzucanie danych dla tabeli cms2.news_to_categories: 3 rows
DELETE FROM `news_to_categories`;
/*!40000 ALTER TABLE `news_to_categories` DISABLE KEYS */;
INSERT INTO `news_to_categories` (`id_news_to_categories`, `news_id`, `news_category_id`) VALUES
	(21, 9, 3),
	(26, 10, 3),
	(27, 12, 3);
/*!40000 ALTER TABLE `news_to_categories` ENABLE KEYS */;

-- Zrzucanie danych dla tabeli cms2.pages: 17 rows
DELETE FROM `pages`;
/*!40000 ALTER TABLE `pages` DISABLE KEYS */;
INSERT INTO `pages` (`id_page`, `name_page`, `url`, `lang`, `parent_id`, `date_added`, `modified_date`, `available`, `meta_keywords`, `meta_description`, `meta_author`, `meta_generator`, `meta_robots`, `meta_title`, `page_position`, `show_in_menu`, `homepage`, `page_type`, `menu_link_off`) VALUES
	(1, 'Home', '', 'pl_PL', 0, 1311939206, 1387277811, 'Y', '', '', NULL, NULL, NULL, 'Home', 100, 1, 1, 'shop', 0),
	(18, 'Kontakt', 'kontakt', 'pl_PL', 0, 1387277791, 0, 'Y', '', '', NULL, NULL, NULL, '', 0, 1, 0, 'cms', 0),
	(2, 'O firmie', 'o-firmie', 'pl_PL', 0, 1311939266, 1387277824, 'Y', '', '', NULL, NULL, NULL, '', 90, 1, 0, 'cms', 0),
	(29, 'Regulamin', 'regulamin', 'pl_PL', 0, 1402995210, 0, 'Y', '', '', NULL, NULL, NULL, '', 0, 0, 0, 'cms', 0),
	(17, 'Sklep', 'sklep', 'pl_PL', 0, 1386927187, 1387277834, 'Y', '', '', NULL, NULL, NULL, '', 80, 1, 0, 'shop', 0),
	(19, 'Sposoby i koszty dostawy', 'sposoby-i-koszty-dostawy', 'pl_PL', 0, 1389188412, 1389188450, 'Y', '', '', NULL, NULL, NULL, '', 0, 0, 0, 'cms', 0),
	(20, 'Home', '', 'en_US', 0, 1389873515, 1389873526, 'Y', '', '', NULL, NULL, NULL, '', 100, 1, 1, 'shop', 0),
	(21, 'About Us', 'about-us', 'en_US', 0, 1389873612, 1389873673, 'Y', '', '', NULL, NULL, NULL, '', 0, 1, 0, 'cms', 0),
	(22, 'Haus', 'haus', 'de_DE', 0, 1389873820, 1389873836, 'Y', '', '', NULL, NULL, NULL, '', 100, 1, 1, 'shop', 0),
	(23, 'Über uns', 'ber-uns', 'de_DE', 0, 1389873896, 1389873942, 'Y', '', '', NULL, NULL, NULL, '', 0, 1, 0, 'cms', 0),
	(24, 'Offer', 'offer', 'en_US', 0, 1389873974, 1389873990, 'Y', '', '', NULL, NULL, NULL, '', 80, 1, 0, 'shop', 0),
	(25, 'Angebot', 'angebot', 'de_DE', 0, 1389874010, 1389874020, 'Y', '', '', NULL, NULL, NULL, '', 80, 1, 0, 'shop', 0),
	(26, 'Nowości', 'nowosci', 'pl_PL', 0, 1393411558, 1393412231, 'Y', '', '', NULL, NULL, NULL, '', 77, 1, 0, 'cms', 0),
	(27, 'Promocje', 'promocje', 'pl_PL', 0, 1393411574, 1393412071, 'Y', '', '', NULL, NULL, NULL, '', 75, 1, 0, 'cms', 0),
	(28, 'Aktualności', 'aktualnosci', 'pl_PL', 0, 1401094898, 0, 'Y', '', '', NULL, NULL, NULL, '', 0, 1, 0, 'cms', 0),
	(30, 'Polityka prywatności', 'polityka-prywatnosci', 'pl_PL', 0, 1402995230, 0, 'Y', '', '', NULL, NULL, NULL, '', 0, 0, 0, 'cms', 0),
	(31, 'Test Galerii', 'test-galerii', 'pl_PL', 0, 1406803685, 0, 'Y', 'adads', 'asd', NULL, NULL, NULL, 'asdasd', 0, 1, 0, 'cms', 0);
/*!40000 ALTER TABLE `pages` ENABLE KEYS */;

-- Zrzucanie danych dla tabeli cms2.pages_elements: 14 rows
DELETE FROM `pages_elements`;
/*!40000 ALTER TABLE `pages_elements` DISABLE KEYS */;
INSERT INTO `pages_elements` (`page_id`, `element_id`, `id_pages_elements`, `element_order`, `element_type`, `position`) VALUES
	(2, 24, 92, NULL, NULL, NULL),
	(21, 27, 37, NULL, NULL, NULL),
	(18, 23, 48, NULL, NULL, NULL),
	(19, 26, 36, NULL, NULL, NULL),
	(23, 28, 38, NULL, NULL, NULL),
	(29, 41, 71, NULL, NULL, NULL),
	(28, 31, 93, NULL, NULL, NULL),
	(1, 59, 94, NULL, NULL, NULL),
	(31, 65, 113, NULL, NULL, NULL),
	(31, 64, 112, NULL, NULL, NULL),
	(1, 60, 95, NULL, NULL, NULL),
	(2, 43, 74, NULL, NULL, NULL),
	(30, 42, 72, NULL, NULL, NULL),
	(2, 58, 89, NULL, NULL, NULL);
/*!40000 ALTER TABLE `pages_elements` ENABLE KEYS */;

-- Zrzucanie danych dla tabeli cms2.pages_languages: 0 rows
DELETE FROM `pages_languages`;
/*!40000 ALTER TABLE `pages_languages` DISABLE KEYS */;
/*!40000 ALTER TABLE `pages_languages` ENABLE KEYS */;

-- Zrzucanie danych dla tabeli cms2.page_content: 6 rows
DELETE FROM `page_content`;
/*!40000 ALTER TABLE `page_content` DISABLE KEYS */;
INSERT INTO `page_content` (`id_page_content`, `title`, `content`, `element_id`, `show_title`) VALUES
	(14, 'O firmie', '<p>Ut semper nunc risus, quis fringilla est interdum sit amet? Etiam eget odio vel nisi vulputate imperdiet. Maecenas a ligula non est consequat suscipit sit amet vitae dui. Ut ullamcorper quam nec justo sodales sodales. Phasellus at vestibulum felis. In ornare velit odio, nec ultricies diam congue et. Nunc gravida quis quam sed ultricies. Donec a sapien nec urna iaculis mollis vel nec diam. In posuere consequat ipsum vitae dapibus. Curabitur in leo vel dui rhoncus malesuada! Sed sit amet vehicula dui. Pellentesque vitae facilisis libero. Ut et orci nec diam luctus varius. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Duis tortor erat, lobortis mattis lectus nec, tincidunt pretium diam. Suspendisse vel lobortis enim.</p>\r\n<p>&nbsp;</p>\r\n<p>Donec nec lobortis orci, a elementum risus. Donec dapibus nulla quis aliquet pulvinar. Ut mattis mi nibh, vel faucibus risus lobortis at. Phasellus rutrum sit amet nulla sed pharetra. Maecenas in purus at urna rutrum ultrices eu eu justo! Morbi sodales ligula sit amet augue ultricies vestibulum. Etiam quam mi, facilisis iaculis fringilla ac, faucibus at tortor. Integer sed dolor non arcu tempus dapibus vitae at ipsum. Praesent ultrices tincidunt lorem vel adipiscing. Proin mi lectus, id mi ac, semper eleifend neque. Ut dui leo, rutrum ac volutpat sed, lobortis in tortor. Suspendisse potenti.</p>\r\n<p>&nbsp;</p>\r\n<p>Integer at luctus nulla. Donec vel urna vitae enim tempus hendrerit! Fusce orci tortor, mattis eu vulputate sed, luctus sed purus. Quisque iaculis libero in ante mattis, id auctor augue adipiscing. Nulla fringilla imperdiet sapien. Proin at feugiat erat. Pellentesque facilisis fermentum massa. Vivamus lobortis arcu in orci facilisis ornare? Integer placerat, turpis et molestie vulputate, sem nibh mattis leo, vitae eleifend enim tortor sit amet ligula! Nam eu diam urna? Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Duis tortor turpis, consectetur tempus sodales ut, congue ac ligula. Vestibulum iaculis tortor lobortis sapien cursus congue. Donec vitae sem nunc. In vulputate facilisis nisi, ac hendrerit ipsum molestie eu. Pellentesque tempus enim vitae dui ultrices, in gravida massa dapibus.</p>\r\n<p>&nbsp;</p>\r\n<p>Vestibulum eu varius tortor. Integer tempor et lectus eu sollicitudin? Suspendisse vel augue ornare, viverra sapien ut, euismod tortor. Donec accumsan rutrum faucibus. Nulla venenatis arcu sit amet neque bibendum congue. Donec vestibulum risus diam, tristique varius nisl rutrum ut. Phasellus gravida odio quis tempus blandit! Duis at molestie libero. Pellentesque vel sapien felis. Fusce euismod ornare blandit. Maecenas in pharetra ligula. Suspendisse ac purus lectus. Nulla commodo quam sit amet lectus hendrerit ultricies. Etiam ornare convallis egestas.</p>\r\n<p>Pellentesque eget urna purus. Ut ullamcorper sit amet nisi eget semper. Donec ut magna nisi. Aenean a placerat arcu. Morbi placerat dui ac nunc tincidunt, in suscipit velit dapibus. Phasellus vel adipiscing mi, non eleifend tellus. Duis in mauris blandit, convallis dui et, pulvinar augue. Curabitur elementum hendrerit massa, ut consectetur justo? Sed eu sollicitudin neque, ut aliquet sapien.</p>\r\n<p>&nbsp;</p>\r\n<p>Praesent ullamcorper elit fringilla ligula malesuada tempor. Cras interdum gravida diam; quis convallis turpis. Donec porta aliquet odio in vestibulum. Morbi vitae magna metus? Aliquam posuere diam quis mollis mollis. Etiam sit amet luctus dui. Vivamus eget congue sem.</p>\r\n<p>&nbsp;</p>\r\n<p>Mauris ut tincidunt ante, vel rutrum tortor? Sed id quam orci. Pellentesque interdum, mauris non consequat sollicitudin, est urna faucibus tortor, sed mollis lacus lacus et elit. Nunc elementum lorem dui; quis blandit libero tincidunt quis. Fusce sed euismod leo, sit amet convallis magna. Sed ac massa sed dolor commodo tristique. Cras ullamcorper facilisis diam, ut aliquam sem. Nulla molestie in ligula vel dapibus? Suspendisse potenti. Donec convallis gravida nibh, vitae congue libero ultrices imperdiet. Nam congue sollicitudin congue. Curabitur volutpat elit convallis orci rhoncus, sed lacinia tellus pharetra. In hac habitasse platea dictumst.</p>', 24, 'N'),
	(15, 'Sposoby i koszty dostawy', '', 26, 'Y'),
	(16, 'About Us', '<p>Under construction</p>', 27, 'Y'),
	(17, 'Über uns', '<p><span id="result_box" class="short_text" lang="de"><span class="hps">im Bau</span></span></p>', 28, 'Y'),
	(23, 'Regulamin', '<p>Nam suscipit semper erat, sed tincidunt lectus. Nunc commodo elementum tincidunt. Aliquam et lectus tristique, dignissim urna sed, ullamcorper felis. Proin sodales congue sagittis. Phasellus vitae suscipit mi! Fusce vitae adipiscing nunc. Cras non quam hendrerit, consequat ante sit amet, adipiscing metus. Nam nisi leo, consectetur quis nisi id, convallis tincidunt nulla? Duis elementum ante tortor, non sagittis ligula pretium laoreet. Aliquam pharetra commodo mi a luctus.</p>\r\n<p>Quisque vitae nisi vitae enim convallis faucibus. Nullam nisl augue, sodales ut diam in, condimentum suscipit diam. Cras a porta felis. Nulla egestas vehicula elit, sit amet laoreet tortor. Duis metus libero, euismod ac pharetra id, hendrerit quis leo. Nullam vulputate in lorem ut pharetra. Nulla in viverra enim. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Nam interdum augue at arcu placerat, ut laoreet dui volutpat.</p>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent venenatis, nisl sit amet consequat lacinia, lectus elit euismod justo, sit amet porttitor est orci ac nisl. In elementum enim eu nulla porttitor, et feugiat nulla pulvinar. Aliquam pulvinar enim vel leo volutpat lobortis. Nulla a quam eu sapien scelerisque condimentum in a nisi? Nullam in consectetur quam. Sed quis metus ac libero rutrum mattis mollis vel eros. Maecenas eu metus massa. Nulla vitae rhoncus justo, non dapibus est. Vivamus et consequat nisi. Sed sed scelerisque mi, ac fermentum sem. Vestibulum vel lectus non eros adipiscing commodo id vel lectus. Praesent eget lectus mollis metus dictum sagittis. In egestas nec mi quis convallis. Pellentesque vehicula, turpis nec iaculis hendrerit, sapien sem convallis augue; at tristique lorem felis nec nisl. Aliquam commodo eros volutpat lacus consequat, sit amet vestibulum nulla eleifend.</p>\r\n<p>Aliquam ut purus vel nulla interdum fermentum! In posuere, dolor ut vulputate adipiscing, erat neque mollis velit, sed ornare sapien augue nec elit. Suspendisse metus odio, aliquam sit amet sem ut, varius fringilla dui. Integer porta mi id blandit lobortis! Pellentesque auctor libero elit; nec molestie massa aliquet sit amet. Fusce non fringilla erat, a rutrum nunc. Nam eget semper metus, sed sodales purus. Nunc pretium nisl at lectus sagittis, non tristique lorem porttitor! Nulla facilisi. Vivamus pharetra non mi sit amet eleifend. Pellentesque urna neque, dapibus sed porta a, consequat sed velit. Vivamus iaculis tellus sed ipsum congue, eget tempor magna elementum. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Sed vel convallis tortor, at ultricies velit! Aliquam vulputate consectetur iaculis. Vivamus interdum ornare mattis.</p>', 41, 'Y'),
	(24, 'Polityka prywatności', '<p>Praesent vel aliquet justo? Nulla id condimentum lacus; malesuada lacinia sem. Sed vitae nibh sed risus laoreet aliquam at sed felis. Etiam sapien nisl, elementum eu tellus at, gravida egestas nulla. Praesent at fermentum erat. Nam pretium ipsum vel lacus mattis ornare. Proin quis gravida nisl. Ut erat neque, lacinia eu libero quis, convallis dapibus ante. In mattis velit sit amet tortor consectetur, ut viverra enim sodales. Suspendisse potenti. Curabitur congue adipiscing commodo.</p>\r\n<p>Morbi dolor lacus, condimentum ut elementum aliquet, venenatis non risus. Integer vel augue a nisi blandit aliquet. Sed faucibus euismod eleifend. Sed vestibulum tincidunt venenatis. Suspendisse varius, ante eget varius auctor; sapien justo gravida lacus, dictum semper dolor massa nec diam. Vestibulum euismod a ante sed dignissim. Integer convallis tellus at urna tempus commodo. Nulla facilisi. In dictum velit nec tellus lobortis, vel tincidunt lectus faucibus. Morbi in ultrices leo. Aliquam interdum neque ultricies enim auctor, vitae pulvinar mauris ullamcorper. Sed sit amet lorem quis eros congue pharetra ac eu nibh. Aliquam sagittis quis nibh sit amet dignissim. Curabitur suscipit risus vestibulum orci facilisis, id suscipit nunc vehicula. Mauris quam odio, vestibulum at erat vitae, consequat semper nisl.</p>\r\n<p>Duis odio augue, aliquam vel pellentesque vel, facilisis vel nisl. In ullamcorper, velit et elementum dictum, eros enim dictum dui, a elementum lectus lorem eget ante. Donec sagittis, arcu sit amet sollicitudin lacinia, quam elit semper lorem, ut aliquam lacus orci vel ante. Nunc in congue quam, eu egestas dui. Integer nec ante et metus hendrerit fringilla at ac sapien. Cras orci erat; convallis eu eros sed, egestas vestibulum est? Proin blandit vel urna sed viverra. Donec facilisis turpis sed fringilla mollis. Etiam sed diam sit amet mi porta tristique. Ut gravida neque in vehicula bibendum.</p>\r\n<p>Nunc auctor vulputate mollis. Nullam pulvinar sodales dolor, vitae pulvinar dui tincidunt rhoncus. Aliquam eget diam quis erat luctus euismod rhoncus eu justo. Fusce nisi libero; iaculis sed viverra eget, ullamcorper a lacus. Donec euismod mauris at dictum mollis. Vestibulum sed risus eleifend, luctus tellus volutpat, egestas nulla. Vestibulum placerat pellentesque purus, non gravida mi dictum a. Vestibulum sed nulla velit.</p>', 42, 'Y');
/*!40000 ALTER TABLE `page_content` ENABLE KEYS */;

-- Zrzucanie danych dla tabeli cms2.partners: 0 rows
DELETE FROM `partners`;
/*!40000 ALTER TABLE `partners` DISABLE KEYS */;
/*!40000 ALTER TABLE `partners` ENABLE KEYS */;

-- Zrzucanie danych dla tabeli cms2.polls_answers: 8 rows
DELETE FROM `polls_answers`;
/*!40000 ALTER TABLE `polls_answers` DISABLE KEYS */;
INSERT INTO `polls_answers` (`id_answer`, `question_id`, `language`, `answer`, `votes`) VALUES
	(1, 1, 'pl_PL', 'Tak', 3),
	(2, 1, 'pl_PL', 'Nie', 0),
	(3, 1, 'pl_PL', 'Nie wiem', 1),
	(4, 2, 'pl_PL', 'asd', 0),
	(5, 2, 'pl_PL', 'asd', 0),
	(12, 4, 'pl_PL', 'fadsads', 0),
	(11, 4, 'pl_PL', 'sfasdasd', 0),
	(9, 5, 'pl_PL', 'asdasd', 0);
/*!40000 ALTER TABLE `polls_answers` ENABLE KEYS */;

-- Zrzucanie danych dla tabeli cms2.polls_categories: 2 rows
DELETE FROM `polls_categories`;
/*!40000 ALTER TABLE `polls_categories` DISABLE KEYS */;
INSERT INTO `polls_categories` (`id_poll_category`, `category_name`, `element_id`) VALUES
	(4, 'asdadsdas', 58),
	(5, 'fghgfhgf', 60);
/*!40000 ALTER TABLE `polls_categories` ENABLE KEYS */;

-- Zrzucanie danych dla tabeli cms2.polls_questions: 4 rows
DELETE FROM `polls_questions`;
/*!40000 ALTER TABLE `polls_questions` DISABLE KEYS */;
INSERT INTO `polls_questions` (`id_question`, `question`, `language`, `date_added`, `start_date`, `end_date`) VALUES
	(1, 'Czy podoba Ci się ta strona?', 'pl_PL', 1311943290, NULL, NULL),
	(2, 'asd', 'pl_PL', 1403690114, NULL, NULL),
	(4, 'sffasdasd', 'pl_PL', 1403701698, 0, 0),
	(5, 'asdasd', 'pl_PL', 1403701760, NULL, NULL);
/*!40000 ALTER TABLE `polls_questions` ENABLE KEYS */;

-- Zrzucanie danych dla tabeli cms2.polls_questions_to_categories: 4 rows
DELETE FROM `polls_questions_to_categories`;
/*!40000 ALTER TABLE `polls_questions_to_categories` DISABLE KEYS */;
INSERT INTO `polls_questions_to_categories` (`id_poll_question_to_categories`, `poll_category_id`, `poll_question_id`, `active`) VALUES
	(1, 1, 1, 'Y'),
	(2, 2, 2, 'Y'),
	(4, 4, 4, 'Y'),
	(5, 4, 5, 'N');
/*!40000 ALTER TABLE `polls_questions_to_categories` ENABLE KEYS */;

-- Zrzucanie danych dla tabeli cms2.polls_voters: 4 rows
DELETE FROM `polls_voters`;
/*!40000 ALTER TABLE `polls_voters` DISABLE KEYS */;
INSERT INTO `polls_voters` (`question_id`, `answer_id`, `ip`, `mac`) VALUES
	(1, 1, '127.0.0.1', ''),
	(1, 1, '192.168.16.78', ''),
	(1, 3, '192.168.16.77', ''),
	(1, 1, '::1', '');
/*!40000 ALTER TABLE `polls_voters` ENABLE KEYS */;

-- Zrzucanie danych dla tabeli cms2.shop_attributes: 3 rows
DELETE FROM `shop_attributes`;
/*!40000 ALTER TABLE `shop_attributes` DISABLE KEYS */;
INSERT INTO `shop_attributes` (`id_attribute`, `position`, `active`) VALUES
	(7, 0, 'Y'),
	(4, 0, 'Y'),
	(8, 0, 'N');
/*!40000 ALTER TABLE `shop_attributes` ENABLE KEYS */;

-- Zrzucanie danych dla tabeli cms2.shop_attributes_description: 3 rows
DELETE FROM `shop_attributes_description`;
/*!40000 ALTER TABLE `shop_attributes_description` DISABLE KEYS */;
INSERT INTO `shop_attributes_description` (`attribute_id`, `attribute_name`, `attribute_language`) VALUES
	(7, 'Rozmiar', 'pl_PL'),
	(4, 'Kolor', 'pl_PL'),
	(8, 'test', 'pl_PL');
/*!40000 ALTER TABLE `shop_attributes_description` ENABLE KEYS */;

-- Zrzucanie danych dla tabeli cms2.shop_attributes_values: 28 rows
DELETE FROM `shop_attributes_values`;
/*!40000 ALTER TABLE `shop_attributes_values` DISABLE KEYS */;
INSERT INTO `shop_attributes_values` (`id_attribute_value`, `attribute_id`, `position`, `default`, `active`) VALUES
	(10, 3, 0, 'N', 'Y'),
	(11, 3, 0, 'N', 'Y'),
	(12, 3, 0, 'N', 'Y'),
	(13, 3, 0, 'N', 'Y'),
	(14, 3, 0, 'N', 'Y'),
	(15, 3, 0, 'N', 'Y'),
	(16, 3, 0, 'N', 'Y'),
	(17, 3, 0, 'N', 'Y'),
	(18, 3, 0, 'N', 'N'),
	(19, 3, 0, 'N', 'N'),
	(20, 3, 0, 'N', 'N'),
	(29, 5, 0, 'N', 'Y'),
	(30, 5, 0, 'N', 'Y'),
	(26, 4, 0, 'Y', 'Y'),
	(25, 4, 0, 'N', 'Y'),
	(31, 5, 0, 'N', 'Y'),
	(32, 6, 0, 'Y', 'Y'),
	(33, 6, 0, 'N', 'Y'),
	(38, 7, 0, 'N', 'Y'),
	(35, 6, 0, 'N', 'Y'),
	(36, 6, 0, 'N', 'Y'),
	(37, 6, 0, 'N', 'Y'),
	(39, 7, 0, 'N', 'Y'),
	(40, 7, 0, 'N', 'Y'),
	(41, 7, 0, 'N', 'Y'),
	(42, 8, 0, 'N', 'Y'),
	(43, 8, 0, 'N', 'Y'),
	(44, 8, 0, 'N', 'Y');
/*!40000 ALTER TABLE `shop_attributes_values` ENABLE KEYS */;

-- Zrzucanie danych dla tabeli cms2.shop_attributes_values_additional: 7 rows
DELETE FROM `shop_attributes_values_additional`;
/*!40000 ALTER TABLE `shop_attributes_values_additional` DISABLE KEYS */;
INSERT INTO `shop_attributes_values_additional` (`attribute_value_id`, `attribute_color`, `attribute_pattern`) VALUES
	(11, '0313FF', ''),
	(10, 'FF0A0A', ''),
	(12, '000000', ''),
	(26, '33FF47', ''),
	(25, 'FF14D8', ''),
	(37, 'FFFFFF', ''),
	(32, 'FFFFFF', '');
/*!40000 ALTER TABLE `shop_attributes_values_additional` ENABLE KEYS */;

-- Zrzucanie danych dla tabeli cms2.shop_attributes_values_description: 24 rows
DELETE FROM `shop_attributes_values_description`;
/*!40000 ALTER TABLE `shop_attributes_values_description` DISABLE KEYS */;
INSERT INTO `shop_attributes_values_description` (`attribute_value_id`, `attribute_value`, `attribute_value_language`) VALUES
	(10, 'Czerwony', 'pl_PL'),
	(11, 'niebieski', 'pl_PL'),
	(12, 'Czarnuszy', 'pl_PL'),
	(20, 'Zielony', 'pl_PL'),
	(26, 'Słomki niebieskie', 'pl_PL'),
	(25, 'Różowy', 'pl_PL'),
	(27, 'Niga black', 'pl_PL'),
	(28, 'Snowflake white', 'pl_PL'),
	(10, 'Indian red', 'en_US'),
	(29, 'S', 'pl_PL'),
	(30, 'L', 'pl_PL'),
	(31, 'XL', 'pl_PL'),
	(32, '1', 'pl_PL'),
	(33, '2', 'pl_PL'),
	(38, 'XL', 'pl_PL'),
	(35, '4', 'pl_PL'),
	(36, '5', 'pl_PL'),
	(37, 'XL', 'pl_PL'),
	(39, 'L', 'pl_PL'),
	(40, 'M', 'pl_PL'),
	(41, 'S', 'pl_PL'),
	(42, 'a', 'pl_PL'),
	(43, 'b', 'pl_PL'),
	(44, 'c', 'pl_PL');
/*!40000 ALTER TABLE `shop_attributes_values_description` ENABLE KEYS */;

-- Zrzucanie danych dla tabeli cms2.shop_categories: 9 rows
DELETE FROM `shop_categories`;
/*!40000 ALTER TABLE `shop_categories` DISABLE KEYS */;
INSERT INTO `shop_categories` (`id_category`, `parent_category_id`, `level`, `image_filename`, `image_filename_hover`, `banner`, `position`, `active`) VALUES
	(37, 0, 1, '14029179781539ed45ac1f56250771743.png', NULL, NULL, 0, 'Y'),
	(38, 0, 1, NULL, NULL, NULL, 0, 'Y'),
	(39, 0, 1, NULL, NULL, NULL, 0, 'Y'),
	(29, 0, 1, '14026455681539aac4088cbc269334438.jpg', NULL, '', 4, 'Y'),
	(30, 0, 1, '14026476611539ab46d253d4056774519.jpg', NULL, '', 3, 'Y'),
	(34, 0, 1, '14026455201539aac10ade50055865228.jpg', '', '', 5, 'Y'),
	(35, 0, 1, '14026477481539ab4c41db0c269756478.jpg', NULL, '14026477481539ab4c47e73a469559571.jpg', 2, 'Y'),
	(40, 0, 1, '14029180311539ed48fc6dec104339422.png', NULL, NULL, 0, 'Y'),
	(41, 0, 1, '14029179531539ed4411e97a171838401.png', NULL, NULL, 0, 'Y');
/*!40000 ALTER TABLE `shop_categories` ENABLE KEYS */;

-- Zrzucanie danych dla tabeli cms2.shop_categories_description: 10 rows
DELETE FROM `shop_categories_description`;
/*!40000 ALTER TABLE `shop_categories_description` DISABLE KEYS */;
INSERT INTO `shop_categories_description` (`category_id`, `category_name`, `category_language`) VALUES
	(29, 'Poligrafia', 'pl_PL'),
	(30, 'Prestashop', 'pl_PL'),
	(30, 'Test 3 en', 'en_US'),
	(38, 'Hosting', 'pl_PL'),
	(37, 'Strony WWW', 'pl_PL'),
	(34, 'Logotypy', 'pl_PL'),
	(35, 'Wordpress', 'pl_PL'),
	(39, 'Domeny', 'pl_PL'),
	(40, 'Sklepy Internetowe', 'pl_PL'),
	(41, 'Reklama', 'pl_PL');
/*!40000 ALTER TABLE `shop_categories_description` ENABLE KEYS */;

-- Zrzucanie danych dla tabeli cms2.shop_configuration: 2 rows
DELETE FROM `shop_configuration`;
/*!40000 ALTER TABLE `shop_configuration` DISABLE KEYS */;
INSERT INTO `shop_configuration` (`id_configuration`, `key`, `value`, `name`, `desc`, `group`, `type`) VALUES
	(1, 'product_stock', '0', 'Stany magazynowe', 'Ogólne stany magazynowe dla produktu', '', 'integer'),
	(2, 'rebates_codes', '1', 'Kody rabatowe', 'Kody rabatowe', '', 'integer');
/*!40000 ALTER TABLE `shop_configuration` ENABLE KEYS */;

-- Zrzucanie danych dla tabeli cms2.shop_currencies: 3 rows
DELETE FROM `shop_currencies`;
/*!40000 ALTER TABLE `shop_currencies` DISABLE KEYS */;
INSERT INTO `shop_currencies` (`id_currency`, `currency_name`, `currency_code`, `currency_unit`, `currency_factor`, `currency_active`, `currency_default`) VALUES
	(14, 'Frank szwajcarski', 'CHF', NULL, 3.4000, 'Y', 'N'),
	(1, 'Polski złoty', 'zł', 1, 1.0000, 'Y', 'Y'),
	(15, 'Euro', 'EUR', NULL, 4.1000, 'N', 'N');
/*!40000 ALTER TABLE `shop_currencies` ENABLE KEYS */;

-- Zrzucanie danych dla tabeli cms2.shop_customers: 5 rows
DELETE FROM `shop_customers`;
/*!40000 ALTER TABLE `shop_customers` DISABLE KEYS */;
INSERT INTO `shop_customers` (`id_customer`, `gender`, `customer_password`, `customer_email`, `customer_first_name`, `customer_last_name`, `customer_company_name`, `customer_nip`, `customer_city`, `customer_zip`, `customer_address`, `customer_state`, `customer_country`, `customer_www`, `customer_phoneno`, `customer_faxno`, `customer_mobileno`, `delivery_email`, `delivery_first_name`, `delivery_last_name`, `delivery_company_name`, `delivery_nip`, `delivery_city`, `delivery_zip`, `delivery_address`, `delivery_state`, `delivery_country`, `delivery_www`, `delivery_phoneno`, `delivery_faxno`, `delivery_mobileno`, `invoice_email`, `invoice_first_name`, `invoice_last_name`, `invoice_company_name`, `invoice_nip`, `invoice_city`, `invoice_zip`, `invoice_address`, `invoice_state`, `invoice_country`, `invoice_www`, `invoice_phoneno`, `invoice_faxno`, `invoice_mobileno`, `customer_rebate`, `verify_string`, `verified`, `points`, `active`, `accept_terms`, `accept_terms2`, `accept_terms3`) VALUES
	(29, NULL, '*1F2D53ED0D19B9DADF2B8EE3E99C7A0B3BBDFFE6', 'hubert@olicom.pl', 'test', 'testt', '', '', 'Poznań', '60-160', 'test 5', '', 'Polska', '', '555666777', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 10, 'f81e9a851ace2154ebfe015200eaba4b', 'N', NULL, 'Y', 1, 1, 0),
	(36, NULL, '*E19D4321AFDAB58F6358C8EE71B76679FF67E675', 'pawel@olicom.pl', 'Paweł', 'Mor', NULL, NULL, 'Posen', '12-365', 'testowa 3', NULL, '', NULL, '123456798', NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '9689b56028a4b4ebb3915bf889bf306e', 'Y', NULL, 'Y', 1, 1, 0),
	(34, NULL, '*AA1420F182E88B9E5F874F6FBE7459291E8F4601', 'hubert@olicom.pl', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 20, '8699e3e8200ef1edac7db009206d5515', 'Y', NULL, 'Y', 1, 1, 0),
	(35, NULL, '*FFA6AC286C830AB2E26889515200CB5CF549F373', 'artur@olicom.org.pl', 'Artur', 'Oli', NULL, NULL, '', '', '', NULL, '', NULL, '', NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '9c3ab4b1ca72cf94231c6634290392d4', 'Y', NULL, 'Y', 1, 1, 0),
	(32, NULL, '*AA1420F182E88B9E5F874F6FBE7459291E8F4601', 'hubert@olicom.org.pl', 'Hubert', 'kkkk', '', '', 'test', '44-444', 'Kmicica 1', '', 'pl', '', '333444555', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 'a197f8e0348b7dcd3b535abffab3f9bc', 'N', NULL, 'Y', 1, 1, 0);
/*!40000 ALTER TABLE `shop_customers` ENABLE KEYS */;

-- Zrzucanie danych dla tabeli cms2.shop_customers_clipboard: 0 rows
DELETE FROM `shop_customers_clipboard`;
/*!40000 ALTER TABLE `shop_customers_clipboard` DISABLE KEYS */;
/*!40000 ALTER TABLE `shop_customers_clipboard` ENABLE KEYS */;

-- Zrzucanie danych dla tabeli cms2.shop_customers_subscriptions: 0 rows
DELETE FROM `shop_customers_subscriptions`;
/*!40000 ALTER TABLE `shop_customers_subscriptions` DISABLE KEYS */;
/*!40000 ALTER TABLE `shop_customers_subscriptions` ENABLE KEYS */;

-- Zrzucanie danych dla tabeli cms2.shop_delivery_ranges: 3 rows
DELETE FROM `shop_delivery_ranges`;
/*!40000 ALTER TABLE `shop_delivery_ranges` DISABLE KEYS */;
INSERT INTO `shop_delivery_ranges` (`id_shop_delivery_ranges`, `range_from`, `range_to`, `delivery_price`, `delivery_type_id`) VALUES
	(1, 1.00, 99999999.00, 25.00, 5),
	(2, 1.00, 99999999.00, 7.00, 6),
	(3, 1.00, 10000.00, 15.00, 7);
/*!40000 ALTER TABLE `shop_delivery_ranges` ENABLE KEYS */;

-- Zrzucanie danych dla tabeli cms2.shop_delivery_types: 4 rows
DELETE FROM `shop_delivery_types`;
/*!40000 ALTER TABLE `shop_delivery_types` DISABLE KEYS */;
INSERT INTO `shop_delivery_types` (`id_delivery_type`, `active`, `cash_on_delivery`) VALUES
	(5, 'Y', 0),
	(6, 'Y', 0),
	(7, 'Y', 0),
	(10, 'N', 0);
/*!40000 ALTER TABLE `shop_delivery_types` ENABLE KEYS */;

-- Zrzucanie danych dla tabeli cms2.shop_delivery_types_description: 4 rows
DELETE FROM `shop_delivery_types_description`;
/*!40000 ALTER TABLE `shop_delivery_types_description` DISABLE KEYS */;
INSERT INTO `shop_delivery_types_description` (`delivery_type_id`, `delivery_type`, `delivery_type_language`) VALUES
	(5, 'Kurier', 'pl_PL'),
	(6, 'Poczta Polska', 'pl_PL'),
	(7, 'carrier', 'en_US'),
	(10, 'ghjfd', 'pl_PL');
/*!40000 ALTER TABLE `shop_delivery_types_description` ENABLE KEYS */;

-- Zrzucanie danych dla tabeli cms2.shop_favourites_customers_products: 0 rows
DELETE FROM `shop_favourites_customers_products`;
/*!40000 ALTER TABLE `shop_favourites_customers_products` DISABLE KEYS */;
/*!40000 ALTER TABLE `shop_favourites_customers_products` ENABLE KEYS */;

-- Zrzucanie danych dla tabeli cms2.shop_measurement_units: 0 rows
DELETE FROM `shop_measurement_units`;
/*!40000 ALTER TABLE `shop_measurement_units` DISABLE KEYS */;
/*!40000 ALTER TABLE `shop_measurement_units` ENABLE KEYS */;

-- Zrzucanie danych dla tabeli cms2.shop_measurement_units_description: 0 rows
DELETE FROM `shop_measurement_units_description`;
/*!40000 ALTER TABLE `shop_measurement_units_description` DISABLE KEYS */;
/*!40000 ALTER TABLE `shop_measurement_units_description` ENABLE KEYS */;

-- Zrzucanie danych dla tabeli cms2.shop_orders: 69 rows
DELETE FROM `shop_orders`;
/*!40000 ALTER TABLE `shop_orders` DISABLE KEYS */;
INSERT INTO `shop_orders` (`id_order`, `order_number`, `current_number`, `current_number_year`, `current_number_month`, `current_number_day`, `client_id`, `order_date`, `status_id`, `payment_type`, `payment_cost`, `clients_note`, `products_cost`, `delivery_type`, `delivery_cost`, `additional_cost`, `order_cost`, `invoice`, `confirmation`, `confirmation_date`, `paid`, `closed`, `client_ip`, `seller_note`, `customer_note`, `confirm_email`, `confirm_string`, `confirmed`, `session_id`, `lang`, `p24_return_status`, `p24_order_id`, `delivery_comments`, `currency`, `factor`, `rebate_code`, `rebate_value`, `rebate_cost`, `customer_rebate`) VALUES
	(26, '1/2013/12/16', 1, 2013, 12, 16, 0, '1387200954', 1, 0, 0.00, '', 99.00, 5, 25.00, 0.00, 124.00, 'N', 'N', NULL, 'N', 'N', '::1', NULL, '', 'pawel@olicom.pl', 'c80f1af2556f2ab93dd4d92d19f6a56b', 'N', '', 'pl_PL', '', '', NULL, 'PLN', 1.0000, NULL, NULL, NULL, NULL),
	(27, '2/2013/12/16', 2, 2013, 12, 16, 0, '1387201244', 1, 0, 0.00, '', 99.00, 5, 25.00, 0.00, 124.00, 'N', 'N', NULL, 'N', 'N', '::1', NULL, '', 'pawel@olicom.pl', 'b84aad097718321b8760a91a697c8b99', 'N', '27|1387201479', 'pl_PL', '', '', NULL, 'PLN', 1.0000, NULL, NULL, NULL, NULL),
	(28, '1/2013/12/23', 1, 2013, 12, 23, 28, '1387794300', 1, 0, 0.00, '', 66.00, 5, 25.00, 0.00, 91.00, 'N', 'N', NULL, 'N', 'N', '::1', NULL, 'test', 'pawel@olicom.org.pl', 'e941747d4edbf58f9e9bff0b5dcd0fb2', 'N', '', 'pl_PL', '', '', NULL, 'PLN', 1.0000, NULL, NULL, NULL, NULL),
	(29, '2/2013/12/23', 2, 2013, 12, 23, 0, '1387794486', 1, 0, 0.00, '', 66.00, 5, 25.00, 0.00, 91.00, 'N', 'N', NULL, 'N', 'N', '::1', NULL, 'test', 'pawel@olicom.org.pl', '025ea6a4239f19598df93d9f63612286', 'N', '', 'pl_PL', '', '', NULL, 'PLN', 1.0000, NULL, NULL, NULL, NULL),
	(30, '3/2013/12/23', 3, 2013, 12, 23, 0, '1387794569', 1, 0, 0.00, '', 66.00, 5, 25.00, 0.00, 91.00, 'N', 'N', NULL, 'N', 'N', '::1', NULL, 'test', 'pawel@olicom.org.pl', '504a9bde2a9d401e8e10e938cd53a49e', 'N', '', 'pl_PL', '', '', NULL, 'PLN', 1.0000, NULL, NULL, NULL, NULL),
	(31, '4/2013/12/23', 4, 2013, 12, 23, 0, '1387794636', 1, 0, 0.00, '', 66.00, 5, 25.00, 0.00, 91.00, 'N', 'N', NULL, 'N', 'N', '::1', NULL, 'test', 'pawel@olicom.org.pl', '249544f7cd747ee8818d8aef2cfb27dc', 'N', '', 'pl_PL', '', '', NULL, 'PLN', 1.0000, NULL, NULL, NULL, NULL),
	(32, '5/2013/12/23', 5, 2013, 12, 23, 0, '1387794772', 1, 0, 0.00, '', 66.00, 5, 25.00, 0.00, 91.00, 'N', 'N', NULL, 'N', 'N', '::1', NULL, 'test', 'pawel@olicom.org.pl', '87fcb89534e4cd878286eae200d1c61b', 'N', '', 'pl_PL', '', '', NULL, 'PLN', 1.0000, NULL, NULL, NULL, NULL),
	(33, '6/2013/12/23', 6, 2013, 12, 23, 0, '1387794784', 1, 0, 0.00, '', 66.00, 5, 25.00, 0.00, 91.00, 'N', 'N', NULL, 'N', 'N', '::1', NULL, 'test', 'pawel@olicom.org.pl', 'e0995a785029b339f413465e15d02abe', 'N', '', 'pl_PL', '', '', NULL, 'PLN', 1.0000, NULL, NULL, NULL, NULL),
	(34, '7/2013/12/23', 7, 2013, 12, 23, 0, '1387794924', 1, 0, 0.00, '', 66.00, 5, 25.00, 0.00, 91.00, 'N', 'N', NULL, 'N', 'N', '::1', NULL, 'test', 'pawel@olicom.org.pl', 'ed75c8d681aa3cc529314ed28df2ae06', 'N', '', 'pl_PL', '', '', NULL, 'PLN', 1.0000, NULL, NULL, NULL, NULL),
	(35, '8/2013/12/23', 8, 2013, 12, 23, 0, '1387794957', 1, 0, 0.00, '', 66.00, 5, 25.00, 0.00, 91.00, 'N', 'N', NULL, 'N', 'N', '::1', NULL, 'test', 'pawel@olicom.org.pl', '2ccefae3867c31cf96b990341a476250', 'N', '', 'pl_PL', '', '', NULL, 'PLN', 1.0000, NULL, NULL, NULL, NULL),
	(36, '9/2013/12/23', 9, 2013, 12, 23, 0, '1387794974', 1, 0, 0.00, '', 66.00, 5, 25.00, 0.00, 91.00, 'N', 'N', NULL, 'N', 'N', '::1', NULL, 'test', 'pawel@olicom.org.pl', '262da1cde03baa759ee81afd664315f4', 'N', '', 'pl_PL', '', '', NULL, 'PLN', 1.0000, NULL, NULL, NULL, NULL),
	(37, '10/2013/12/23', 10, 2013, 12, 23, 0, '1387795031', 1, 0, 0.00, '', 66.00, 5, 25.00, 0.00, 91.00, 'N', 'N', NULL, 'N', 'N', '::1', NULL, 'test', 'pawel@olicom.org.pl', 'bdf80c55f9ed3e43eedaa24684f20c3d', 'N', '', 'pl_PL', '', '', NULL, 'PLN', 1.0000, NULL, NULL, NULL, NULL),
	(38, '11/2013/12/23', 11, 2013, 12, 23, 0, '1387795060', 1, 0, 0.00, '', 66.00, 5, 25.00, 0.00, 91.00, 'N', 'N', NULL, 'N', 'N', '::1', NULL, 'test', 'pawel@olicom.org.pl', 'b7193ec402c12ca1e95cf0522f824f4d', 'N', '', 'pl_PL', '', '', NULL, 'PLN', 1.0000, NULL, NULL, NULL, NULL),
	(39, '12/2013/12/23', 12, 2013, 12, 23, 0, '1387795088', 1, 0, 0.00, '', 99.00, 6, 7.00, 0.00, 106.00, 'N', 'N', NULL, 'N', 'N', '::1', NULL, '', 'pawel@olicom.org.pl', '1f13fc08b66428d90c10e8c3204305d1', 'N', '', 'pl_PL', '', '', NULL, 'PLN', 1.0000, NULL, NULL, NULL, NULL),
	(40, '13/2013/12/23', 13, 2013, 12, 23, 0, '1387795158', 1, 0, 0.00, '', 99.00, 6, 7.00, 0.00, 106.00, 'N', 'N', NULL, 'N', 'N', '::1', NULL, '', 'pawel@olicom.org.pl', '4337098eace64659124f12fdddc36b9e', 'N', '', 'pl_PL', '', '', NULL, 'PLN', 1.0000, NULL, NULL, NULL, NULL),
	(41, '14/2013/12/23', 14, 2013, 12, 23, 0, '1387795288', 1, 0, 0.00, '', 99.00, 6, 7.00, 0.00, 106.00, 'N', 'N', NULL, 'N', 'N', '::1', NULL, '', 'pawel@olicom.pl', 'aabe05316268a688173c3e5c016c598c', 'N', '', 'pl_PL', '', '', NULL, 'PLN', 1.0000, NULL, NULL, NULL, NULL),
	(42, '15/2013/12/23', 15, 2013, 12, 23, 0, '1387795427', 1, 0, 0.00, '', 99.00, 6, 7.00, 0.00, 106.00, 'N', 'N', NULL, 'N', 'N', '::1', NULL, '', 'pawel@olicom.pl', '2d95e8b57a1deeb63d9aca4434a58e5e', 'N', '42|1387799541', 'pl_PL', '', '', NULL, 'PLN', 1.0000, NULL, NULL, NULL, NULL),
	(43, '1/2014/01/03', 1, 2014, 1, 3, 0, '1388749967', 1, 0, 0.00, '', 120.00, 6, 7.00, 0.00, 127.00, 'N', 'N', NULL, 'N', 'N', '::1', NULL, '', 'pawel@olicom.pl', '746a537e490412459386f09ffb8cfcad', 'N', '', 'pl_PL', '', '', NULL, 'PLN', 1.0000, NULL, NULL, NULL, NULL),
	(44, '2/2014/01/03', 2, 2014, 1, 3, 0, '1388750139', 1, 0, 0.00, '', 120.00, 6, 7.00, 0.00, 127.00, 'N', 'N', NULL, 'N', 'N', '::1', NULL, '', 'pawel@olicom.pl', '5cf12c423ec8ec26531374ac067f11f2', 'N', '44|1388750149', 'pl_PL', '', '', NULL, 'PLN', 1.0000, NULL, NULL, NULL, NULL),
	(45, '1/2014/01/07', 1, 2014, 1, 7, 0, '1389101062', 1, 0, 0.00, '', 600.00, 6, 7.00, 0.00, 607.00, 'N', 'N', NULL, 'N', 'N', '::1', NULL, '', 'pawel@olicom.org.pl', 'dd954ba123c9d1658cace8df98b71163', 'N', '45|1389101078', 'pl_PL', '', '', NULL, 'PLN', 1.0000, NULL, NULL, NULL, NULL),
	(46, '1/2014/01/08', 1, 2014, 1, 8, 27, '1389174835', 1, 0, 0.00, '', 144.00, 6, 7.00, 0.00, 151.00, 'N', 'N', NULL, 'N', 'N', '::1', NULL, '', 'pawel@olicom.org.pl', '3d9193c6c3a9214efb273ecc6ef17744', 'N', '46|1389174848', 'pl_PL', '', '', NULL, 'PLN', 1.0000, NULL, NULL, NULL, NULL),
	(47, '2/2014/01/08', 2, 2014, 1, 8, 27, '1389176386', 1, 0, 0.00, '', 33.00, 6, 7.00, 0.00, 40.00, 'N', 'N', NULL, 'N', 'N', '::1', NULL, '', 'pawel@olicom.org.pl', 'e5d798de863bac20d2ab0a9d28ad03c7', 'N', '47|1389178249', 'pl_PL', '', '', NULL, 'PLN', 1.0000, NULL, NULL, NULL, NULL),
	(48, '1/2014/01/20', 1, 2014, 1, 20, 0, '1390223248', 1, 0, 0.00, '', 10.00, 6, 7.00, 0.00, 17.00, 'N', 'N', NULL, 'N', 'N', '::1', NULL, 'eee tam', 'pawel@olicom.pl', '596a5dd51d147e4cb5780ea9bcfb392e', 'N', '48|1390224001', 'pl_PL', '', '', NULL, 'PLN', 1.0000, NULL, NULL, NULL, NULL),
	(49, '2/2014/01/20', 2, 2014, 1, 20, 0, '1390224262', 1, 0, 0.00, '', 10.00, 7, 15.00, 0.00, 25.00, 'N', 'N', NULL, 'N', 'N', '::1', NULL, 'testtesttest', 'pawel@olicom.pl', '4766af11e31eef87b0471324c74354c7', 'N', '49|1390224413', 'en_US', '', '', NULL, 'PLN', 1.0000, NULL, NULL, NULL, NULL),
	(50, '1/2014/01/23', 1, 2014, 1, 23, 0, '1390476647', 1, 0, 0.00, '', 20.00, 5, 25.00, 0.00, 45.00, 'N', 'N', NULL, 'N', 'N', '::1', NULL, '', 'pawel@olicom.org.pl', '8638c0bc61a90220dc8097fbae500182', 'N', '50|1390477106', 'pl_PL', '', '', NULL, 'PLN', 1.0000, NULL, NULL, NULL, NULL),
	(51, '2/2014/01/23', 2, 2014, 1, 23, 0, '1390478017', 1, 0, 0.00, '', 10.00, 7, 15.00, 0.00, 25.00, 'N', 'N', NULL, 'N', 'N', '::1', NULL, '', 'pawel@olicom.pl', '02dfe2e3e024698d9bcade4be4e6c9ea', 'N', '51|1390478025', 'en_US', '', '', NULL, 'EUR', 4.0000, NULL, NULL, NULL, NULL),
	(52, '3/2014/01/23', 3, 2014, 1, 23, 0, '1390479815', 1, 0, 0.00, '', 10.00, 6, 7.00, 0.00, 17.00, 'N', 'N', NULL, 'N', 'N', '::1', NULL, '', 'pawel@olicom.pl', '1d51838202c589c692c262f6940ef82f', 'N', '52|1390481086', 'pl_PL', '', '', NULL, 'EUR', 4.1669, NULL, NULL, NULL, NULL),
	(53, '1/2014/01/30', 1, 2014, 1, 30, 0, '1391083951', 1, 0, 0.00, '', 180.00, 6, 7.00, 0.00, 187.00, 'N', 'N', NULL, 'N', 'N', '::1', NULL, 'test', 'pawel@olicom.pl', '5bdae14dc9dade67b129e78eed82dc58', 'N', '53|1391096004', 'pl_PL', '', '', NULL, 'PLN', 1.0000, NULL, NULL, NULL, NULL),
	(54, '2/2014/01/30', 2, 2014, 1, 30, 31, '1391089670', 1, 0, 0.00, '', 330.00, 5, 25.00, 0.00, 355.00, 'N', 'N', NULL, 'N', 'N', '127.0.0.1', NULL, 'test', 'hubert@olicom.pl', '7fc62cd6873757fb571479c7160b31c4', 'N', '54|1391089677', 'pl_PL', '', '', NULL, 'PLN', 1.0000, NULL, NULL, NULL, NULL),
	(55, '1/2014/01/31', 1, 2014, 1, 31, 0, '1391174286', 1, 0, 0.00, '', 44.00, 5, 25.00, 0.00, 69.00, 'N', 'N', NULL, 'N', 'N', '::1', NULL, '', 'pawel@olicom.pl', '0a07e740445adfef0de5a6406483871b', 'N', '55|1391175194', 'pl_PL', '', '', NULL, 'PLN', 1.0000, NULL, NULL, NULL, NULL),
	(56, '2/2014/01/31', 2, 2014, 1, 31, 0, '1391176994', 1, 0, 0.00, '', 704.00, 5, 25.00, 0.00, 729.00, 'N', 'N', NULL, 'N', 'N', '::1', NULL, '', 'pawel@olicom.org.pl', '85b946e63d7e3933988eb8fb52d84ba2', 'N', '56|1391177007', 'pl_PL', '', '', NULL, 'PLN', 1.0000, NULL, NULL, NULL, NULL),
	(57, '1/2014/02/05', 1, 2014, 2, 5, 0, '1391605837', 1, 0, 0.00, '', 374.00, 6, 7.00, 0.00, 381.00, 'N', 'N', NULL, 'N', 'N', '127.0.0.1', NULL, 'uytut', 'hubert@olicom.pl', '72536650eea1e16492d3507744d5d0f6', 'N', '57|1391605843', 'pl_PL', '', '', NULL, 'PLN', 1.0000, NULL, NULL, NULL, NULL),
	(58, '1/2014/02/07', 1, 2014, 2, 7, 0, '1391761516', 1, 0, 0.00, '', 330.00, 5, 25.00, 0.00, 355.00, 'N', 'N', NULL, 'N', 'N', '127.0.0.1', NULL, 'test', 'hubert@olicom.org.pl', 'c8840d7dbad08152889802cc37375f41', 'N', '58|1391761522', 'pl_PL', '', '', NULL, 'zł', 1.0000, NULL, NULL, NULL, NULL),
	(59, '2/2014/02/07', 2, 2014, 2, 7, 31, '1391769910', 1, 0, 0.00, '', 55.00, 5, 25.00, 0.00, 80.00, 'N', 'N', NULL, 'N', 'N', '127.0.0.1', NULL, '', 'hubert@olicom.pl', '314b2dfa344bb8d51a985a10d9a4e20f', 'N', '59|1391769916', 'pl_PL', '', '', NULL, 'zł', 1.0000, NULL, NULL, NULL, NULL),
	(60, '1/2014/02/10', 1, 2014, 2, 10, 31, '1392029555', 1, 0, 0.00, '', 1760.00, 6, 7.00, 0.00, 1767.00, 'N', 'N', NULL, 'N', 'N', '127.0.0.1', NULL, 'jnjknjk', 'hubert@olicom.pl', 'dae9efbfb0d9437a1971f760020f7484', 'N', '60|1392029562', 'pl_PL', '', '', NULL, 'zł', 1.0000, NULL, NULL, NULL, NULL),
	(61, '2/2014/02/10', 2, 2014, 2, 10, 31, '1392033227', 1, 1, 0.00, '', 44.00, 5, 25.00, 0.00, 69.00, 'N', 'N', NULL, 'N', 'N', '127.0.0.1', NULL, 'test', 'hubert@olicom.pl', '6401fbb8d4dd86b3d9fee090495c3070', 'N', '61|1392033233', 'pl_PL', '', '', NULL, 'zł', 1.0000, NULL, NULL, NULL, NULL),
	(62, '3/2014/02/10', 3, 2014, 2, 10, 31, '1392034146', 1, 1, 0.00, '', 44.00, 5, 25.00, 0.00, 69.00, 'N', 'N', NULL, 'N', 'N', '127.0.0.1', NULL, 'fhn', 'hubert@olicom.pl', '45985b88974b9da1c5fcccb958373972', 'N', '62|1392041631', 'pl_PL', '', '', NULL, 'zł', 1.0000, NULL, NULL, NULL, NULL),
	(63, '4/2014/02/10', 4, 2014, 2, 10, 31, '1392037756', 1, 3, 0.00, '', 660.00, 6, 7.00, 0.00, 667.00, 'N', 'N', NULL, 'N', 'N', '127.0.0.1', NULL, 'bfg', 'hubert@olicom.pl', 'b7ac1de951edcbeb8d2714b2231e1bd7', 'N', '63|1392041682', 'pl_PL', '', '', NULL, 'zł', 1.0000, NULL, NULL, NULL, NULL),
	(64, '1/2014/02/11', 1, 2014, 2, 11, 0, '1392103933', 1, 1, 0.00, '', 44.00, 6, 7.00, 0.00, 51.00, 'N', 'N', NULL, 'N', 'N', '127.0.0.1', NULL, 'test', 'hubert@olicom.pl', 'aba8c096f0dc1066dc25350ebde12bba', 'N', '64|1392103939', 'pl_PL', '', '', NULL, 'zł', 1.0000, NULL, NULL, NULL, NULL),
	(65, '2/2014/02/11', 2, 2014, 2, 11, 0, '1392104532', 1, 2, 0.00, '', 44.00, 5, 25.00, 0.00, 69.00, 'N', 'N', NULL, 'N', 'N', '127.0.0.1', NULL, 'test', 'asd-zyg@wp.pl', '595eb590ea9ac0ba41d92b5617589653', 'N', '65|1392104537', 'pl_PL', '', '', NULL, 'zł', 1.0000, NULL, NULL, NULL, NULL),
	(66, '3/2014/02/11', 3, 2014, 2, 11, 0, '1392104928', 1, 1, 0.00, '', 44.00, 6, 7.00, 0.00, 51.00, 'N', 'N', NULL, 'N', 'N', '127.0.0.1', NULL, 'test', 'asd-zyg@wp.pl', 'd1a4ec177fa244926b0e531d362c0f96', 'N', '66|1392104933', 'pl_PL', '', '', NULL, 'zł', 1.0000, NULL, NULL, NULL, NULL),
	(67, '4/2014/02/11', 4, 2014, 2, 11, 0, '1392105108', 1, 1, 0.00, '', 44.00, 6, 7.00, 0.00, 51.00, 'N', 'N', NULL, 'N', 'N', '127.0.0.1', NULL, 'test', 'asd-zyg@wp.pl', '76e80ca619723a771ced1eed1aedf370', 'N', '67|1392105113', 'pl_PL', '', '', NULL, 'zł', 1.0000, NULL, NULL, NULL, NULL),
	(68, '5/2014/02/11', 5, 2014, 2, 11, 0, '1392105258', 1, 1, 0.00, '', 44.00, 6, 7.00, 0.00, 51.00, 'N', 'N', NULL, 'N', 'N', '127.0.0.1', NULL, 'test', 'asd-zyg@wp.pl', '2007d768c9c782b2596d804bed8d7fcb', 'N', '68|1392105273', 'pl_PL', '', '', NULL, 'zł', 1.0000, NULL, NULL, NULL, NULL),
	(69, '1/2014/02/14', 1, 2014, 2, 14, 0, '1392367521', 3, 1, 0.00, '', 44.00, 5, 25.00, 0.00, 69.00, 'N', 'N', NULL, 'Y', 'N', '127.0.0.1', NULL, 'test', 'hubert@olicom.pl', '4d63453c7ad465e94daae46bd5494981', 'N', '69|1392367526', 'pl_PL', '', '', '', 'zł', 1.0000, NULL, NULL, NULL, NULL),
	(70, '1/2014/02/19', 1, 2014, 2, 19, 0, '1392813401', 1, 1, 0.00, '', 330.00, 5, 25.00, 0.00, 355.00, 'N', 'N', NULL, 'N', 'N', '::1', NULL, '', 'pawel@olicom.org.pl', '996ab42252c5936464f32f667ac9a782', 'N', '70|1392813412', 'pl_PL', '', '', NULL, 'zł', 1.0000, NULL, NULL, NULL, NULL),
	(71, '1/2014/02/20', 1, 2014, 2, 20, 0, '1392888520', 1, 1, 0.00, '', 132.00, 5, 25.00, 0.00, 157.00, 'N', 'N', NULL, 'N', 'N', '::1', NULL, 'test', 'pawel@olicom.org.pl', 'ace289ed16c2cd37b46078a47b33d4ce', 'N', '71|1392888530', 'pl_PL', '', '', NULL, 'zł', 1.0000, NULL, NULL, NULL, NULL),
	(72, '2/2014/02/20', 2, 2014, 2, 20, 33, '1392904845', 1, 1, 0.00, '', 44.00, 6, 7.00, 0.00, 51.00, 'N', 'N', NULL, 'Y', 'N', '::1', NULL, '', 'pawel@olicom.org.pl', 'af062f47396362025b4c92e6f09f0eb5', 'N', '72|1392904952', 'pl_PL', '', '', '', 'zł', 1.0000, NULL, NULL, NULL, NULL),
	(73, '1/2014/03/17', 1, 2014, 3, 17, 0, '1395064098', 1, 3, 0.00, '', 0.00, 5, 25.00, 0.00, 0.00, 'N', 'N', NULL, 'N', 'N', '127.0.0.1', NULL, 'test', 'hubert@olicom.pl', 'e41d8256ececf1d897689a5b84d94522', 'N', '73|1395064235', 'pl_PL', '', '', NULL, 'zł', 1.0000, 'code-1', 10, NULL, NULL),
	(74, '2/2014/03/17', 2, 2014, 3, 17, 0, '1395064493', 1, 3, 0.00, '', 49.50, 5, 25.00, 0.00, 74.50, 'N', 'N', NULL, 'N', 'N', '127.0.0.1', NULL, '', 'hubert@olicom.pl', '1998bff449b29bcf67ed778b06bc5685', 'N', '74|1395064499', 'pl_PL', '', '', NULL, 'zł', 1.0000, 'code-1', 10, NULL, NULL),
	(75, '3/2014/03/17', 3, 2014, 3, 17, 0, '1395065283', 1, 3, 0.00, '', 49.50, 5, 25.00, 0.00, 74.50, 'N', 'N', NULL, 'N', 'N', '127.0.0.1', NULL, '', 'hubert@olicom.pl', '51ee257b091e1f12bac9b196d2de3d8e', 'N', '75|1395065288', 'pl_PL', '', '', NULL, 'zł', 1.0000, 'code-1', 10, NULL, NULL),
	(76, '4/2014/03/17', 4, 2014, 3, 17, 0, '1395065741', 1, 3, 0.00, '', 49.50, 5, 25.00, 0.00, 74.50, 'N', 'N', NULL, 'N', 'N', '127.0.0.1', NULL, '', 'hubert@olicom.pl', 'f130eafef5084215d353581b5e3aa8a5', 'N', '76|1395065745', 'pl_PL', '', '', NULL, 'zł', 1.0000, 'code-1', 10, NULL, NULL),
	(77, '5/2014/03/17', 5, 2014, 3, 17, 0, '1395065865', 1, 3, 0.00, '', 49.50, 5, 25.00, 0.00, 74.50, 'N', 'N', NULL, 'N', 'N', '127.0.0.1', NULL, '', 'hubert@olicom.pl', 'e644a6071fcffcb498b8c6b4f4e5f46d', 'N', '77|1395065886', 'pl_PL', '', '', NULL, 'zł', 1.0000, 'code-1', 10, NULL, NULL),
	(78, '6/2014/03/17', 6, 2014, 3, 17, 0, '1395066744', 1, 2, 0.00, '', 242.00, 5, 25.00, 0.00, 267.00, 'N', 'N', NULL, 'N', 'N', '127.0.0.1', NULL, '', 'hubert@olicom.pl', '26436086a205b28afb1222989dd317e6', 'N', '78|1395066750', 'pl_PL', '', '', NULL, 'zł', 1.0000, 'code-1', 10, NULL, NULL),
	(79, '7/2014/03/17', 7, 2014, 3, 17, 0, '1395066890', 1, 3, 0.00, '', 83.60, 5, 25.00, 0.00, 108.60, 'N', 'N', NULL, 'N', 'N', '127.0.0.1', NULL, '', 'hubert@olicom.pl', 'e98782af718a639517aa25d0ef8fb4f0', 'N', '79|1395066894', 'pl_PL', '', '', NULL, 'zł', 1.0000, 'code-1', 10, NULL, NULL),
	(80, '1/2014/03/25', 1, 2014, 3, 25, 0, '1395747670', 1, 1, 0.00, '', 55.00, 6, 7.00, 0.00, 62.00, 'N', 'N', NULL, 'N', 'N', '127.0.0.1', NULL, 'test', 'hubert@olicom.pl', '6ff22a94a49873093a82a17d991e28eb', 'N', '80|1395747680', 'pl_PL', '', '', NULL, 'zł', 1.0000, NULL, NULL, NULL, NULL),
	(81, '2/2014/03/25', 2, 2014, 3, 25, 0, '1395748153', 1, 1, 0.00, '', 44.00, 6, 7.00, 0.00, 51.00, 'N', 'N', NULL, 'N', 'N', '127.0.0.1', NULL, 'test', 'hubert@olicom.pl', '6d669f853a77a61c897b444bf920fbe2', 'N', '81|1395748277', 'pl_PL', '', '', NULL, 'zł', 1.0000, NULL, NULL, NULL, NULL),
	(82, '3/2014/03/25', 3, 2014, 3, 25, 0, '1395748323', 1, 1, 0.00, '', 44.00, 6, 7.00, 0.00, 51.00, 'N', 'N', NULL, 'N', 'N', '127.0.0.1', NULL, '', 'hubert@olicom.pl', '2499ed17dd68c2029fabee956568d733', 'N', '', 'pl_PL', '', '', NULL, 'zł', 1.0000, NULL, NULL, NULL, NULL),
	(83, '4/2014/03/25', 4, 2014, 3, 25, 0, '1395748397', 1, 1, 0.00, '', 44.00, 6, 7.00, 0.00, 51.00, 'N', 'N', NULL, 'N', 'N', '127.0.0.1', NULL, '', 'hubert@olicom.pl', 'c4a3a5180b4c58e2d25e0098accf1265', 'N', '', 'pl_PL', '', '', NULL, 'zł', 1.0000, NULL, NULL, NULL, NULL),
	(84, '5/2014/03/25', 5, 2014, 3, 25, 0, '1395748418', 1, 1, 0.00, '', 44.00, 6, 7.00, 0.00, 51.00, 'N', 'N', NULL, 'N', 'N', '127.0.0.1', NULL, '', 'hubert@olicom.pl', '66d09ee94f87171272f897df82d25cf9', 'N', '', 'pl_PL', '', '', NULL, 'zł', 1.0000, NULL, NULL, NULL, NULL),
	(85, '6/2014/03/25', 6, 2014, 3, 25, 0, '1395748449', 1, 1, 0.00, '', 44.00, 6, 7.00, 0.00, 51.00, 'N', 'N', NULL, 'N', 'N', '127.0.0.1', NULL, '', 'hubert@olicom.pl', '02968a8351e9c450857884d139659a65', 'N', '', 'pl_PL', '', '', NULL, 'zł', 1.0000, NULL, NULL, NULL, NULL),
	(86, '7/2014/03/25', 7, 2014, 3, 25, 0, '1395748520', 1, 1, 0.00, '', 44.00, 6, 7.00, 0.00, 51.00, 'N', 'N', NULL, 'N', 'N', '127.0.0.1', NULL, '', 'hubert@olicom.pl', 'af32c8651af00e6d4002ea045360200d', 'N', '86|1395748553', 'pl_PL', '', '', NULL, 'zł', 1.0000, NULL, NULL, NULL, NULL),
	(87, '8/2014/03/25', 8, 2014, 3, 25, 0, '1395748587', 1, 1, 0.00, '', 44.00, 6, 7.00, 0.00, 51.00, 'N', 'N', NULL, 'N', 'N', '127.0.0.1', NULL, '', 'hubert@olicom.pl', 'cea91ee190372e11a6448702424aa5ad', 'N', '87|1395748594', 'pl_PL', '', '', NULL, 'zł', 1.0000, NULL, NULL, NULL, NULL),
	(88, '1/2014/04/15', 1, 2014, 4, 15, 0, '1397553811', 1, 1, 0.00, '', 156.60, 6, 7.00, 0.00, 163.60, 'N', 'N', NULL, 'N', 'N', '127.0.0.1', NULL, 'test', 'hubert@olicom.pl', '62778b79cc1796225019162ec8cdac8f', 'N', '88|1397553995', 'pl_PL', '', '', NULL, 'zł', 1.0000, 'fanbiały', 10, 17.40, NULL),
	(89, '1/2014/04/22', 1, 2014, 4, 22, 34, '1398153200', 1, 2, 0.00, '', 49.00, 6, 7.00, 0.00, 56.00, 'N', 'N', NULL, 'N', 'N', '127.0.0.1', NULL, 'test', 'hubert@olicom.pl', 'f0aa7c6f3b7d38bb88233036d13bb439', 'N', '89|1398153204', 'pl_PL', '', '', NULL, 'zł', 1.0000, 'fanbiały', 50, 16.00, NULL),
	(90, '1/2014/07/22', 1, 2014, 7, 22, 0, '1406021176', 1, 3, 0.00, '', 200.00, 6, 7.00, 0.00, 207.00, 'N', 'N', NULL, 'N', 'N', '::1', NULL, 'oolicom', 'pawel@olicom.pl', '3d45588c825374d8d7c1e44c386fb003', 'N', '90|1406021194', 'pl_PL', '', '', NULL, 'zł', 1.0000, NULL, NULL, 0.00, NULL),
	(91, '2/2014/07/22', 2, 2014, 7, 22, 36, '1406022071', 1, 3, 0.00, '', 19.99, 5, 25.00, 0.00, 44.99, 'N', 'N', NULL, 'N', 'N', '::1', NULL, 'oolicom', 'pawel@olicom.pl', '41b6924355b4b7d73d28d5ca008fa636', 'N', '91|1406022089', 'pl_PL', '', '', NULL, 'zł', 1.0000, NULL, NULL, 0.00, NULL),
	(92, '3/2014/07/22', 3, 2014, 7, 22, 0, '1406022987', 1, 3, 0.00, '', 39.90, 5, 25.00, 0.00, 64.90, 'N', 'N', NULL, 'N', 'N', '::1', NULL, '', 'pawel@olicom.pl', '771f92ffd4f5a8b052b0b5b5a8e024ab', 'N', '92|1406025447', 'pl_PL', '', '', NULL, 'zł', 1.0000, NULL, NULL, 0.00, NULL),
	(93, '4/2014/07/22', 4, 2014, 7, 22, 0, '1406025669', 1, 3, 0.00, '', 39.90, 6, 7.00, 0.00, 46.90, 'N', 'N', NULL, 'N', 'N', '::1', NULL, '', 'pawel@olicom.pl', '5d292dbbbe53ae26a2247a9fb99c20d8', 'N', '93|1406026009', 'pl_PL', '', '', NULL, 'zł', 1.0000, NULL, NULL, 0.00, NULL),
	(94, '1/2015/03/20', 1, 2015, 3, 20, 0, '1426856072', 1, 2, 0.00, '', 200.00, 5, 25.00, 0.00, 225.00, 'N', 'N', NULL, 'N', 'N', '::1', NULL, '', 'hubert@olicom.pl', 'e5c4ae42eaa28e98ff348b92e3a6e0ae', 'N', '94|1426856083', 'pl_PL', '', '', NULL, 'zł', 1.0000, NULL, NULL, 0.00, NULL);
/*!40000 ALTER TABLE `shop_orders` ENABLE KEYS */;

-- Zrzucanie danych dla tabeli cms2.shop_orders_customers: 68 rows
DELETE FROM `shop_orders_customers`;
/*!40000 ALTER TABLE `shop_orders_customers` DISABLE KEYS */;
INSERT INTO `shop_orders_customers` (`order_id`, `customer_id`, `customer_email`, `customer_first_name`, `customer_last_name`, `customer_company_name`, `customer_nip`, `customer_city`, `customer_zip`, `customer_address`, `customer_state`, `customer_country`, `customer_www`, `customer_phoneno`, `customer_faxno`, `customer_mobileno`, `delivery_email`, `delivery_first_name`, `delivery_last_name`, `delivery_company_name`, `delivery_nip`, `delivery_city`, `delivery_zip`, `delivery_address`, `delivery_state`, `delivery_country`, `delivery_www`, `delivery_phoneno`, `delivery_faxno`, `delivery_mobileno`, `invoice_email`, `invoice_first_name`, `invoice_last_name`, `invoice_company_name`, `invoice_nip`, `invoice_city`, `invoice_zip`, `invoice_address`, `invoice_state`, `invoice_country`, `invoice_www`, `invoice_phoneno`, `invoice_faxno`, `invoice_mobileno`, `invoice`, `delivery`, `accept_terms`, `accept_terms2`, `accept_terms3`) VALUES
	(27, 0, 'pawel@olicom.pl', 'Paweł', 'Mor', NULL, NULL, 'Posen', '12-365', 'testowa 3', NULL, '', NULL, '123654789', NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'N', 'N', 0, 0, 0),
	(28, 28, 'pawel@olicom.org.pl', 'Paweł', 'Mor', NULL, NULL, 'Posen', '12-365', 'testowa 3', NULL, '', NULL, '123654789', NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'N', 'N', 0, 0, 0),
	(29, 0, 'pawel@olicom.org.pl', 'Paweł', 'Mor', NULL, NULL, 'Posen', '12-365', 'testowa 3', NULL, '', NULL, '123654789', NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'N', 'N', 0, 0, 0),
	(30, 0, 'pawel@olicom.org.pl', 'Paweł', 'Mor', NULL, NULL, 'Posen', '12-365', 'testowa 3', NULL, '', NULL, '123654789', NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'N', 'N', 0, 0, 0),
	(31, 0, 'pawel@olicom.org.pl', 'Paweł', 'Mor', NULL, NULL, 'Posen', '12-365', 'testowa 3', NULL, '', NULL, '123654789', NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'N', 'N', 0, 0, 0),
	(32, 0, 'pawel@olicom.org.pl', 'Paweł', 'Mor', NULL, NULL, 'Posen', '12-365', 'testowa 3', NULL, '', NULL, '123654789', NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'N', 'N', 0, 0, 0),
	(33, 0, 'pawel@olicom.org.pl', 'Paweł', 'Mor', NULL, NULL, 'Posen', '12-365', 'testowa 3', NULL, '', NULL, '123654789', NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'N', 'N', 0, 0, 0),
	(34, 0, 'pawel@olicom.org.pl', 'Paweł', 'Mor', NULL, NULL, 'Posen', '12-365', 'testowa 3', NULL, '', NULL, '123654789', NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'N', 'N', 0, 0, 0),
	(35, 0, 'pawel@olicom.org.pl', 'Paweł', 'Mor', NULL, NULL, 'Posen', '12-365', 'testowa 3', NULL, '', NULL, '123654789', NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'N', 'N', 0, 0, 0),
	(36, 0, 'pawel@olicom.org.pl', 'Paweł', 'Mor', NULL, NULL, 'Posen', '12-365', 'testowa 3', NULL, '', NULL, '123654789', NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'N', 'N', 0, 0, 0),
	(37, 0, 'pawel@olicom.org.pl', 'Paweł', 'Mor', NULL, NULL, 'Posen', '12-365', 'testowa 3', NULL, '', NULL, '123654789', NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'N', 'N', 0, 0, 0),
	(38, 0, 'pawel@olicom.org.pl', 'Paweł', 'Mor', NULL, NULL, 'Posen', '12-365', 'testowa 3', NULL, '', NULL, '123654789', NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'N', 'N', 0, 0, 0),
	(39, 0, 'pawel@olicom.org.pl', 'Paweł', 'Mor', NULL, NULL, 'Posen', '12-365', 'testowa 3', NULL, '', NULL, '123654789', NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'N', 'N', 0, 0, 0),
	(40, 0, 'pawel@olicom.org.pl', 'Paweł', 'Mor', NULL, NULL, 'Posen', '12-365', 'testowa 3', NULL, '', NULL, '123654789', NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'N', 'N', 0, 0, 0),
	(41, 0, 'pawel@olicom.pl', 'Paweł', 'Mor', NULL, NULL, 'Posen', '12-365', 'testowa 3', NULL, '', NULL, '123654789', NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'N', 'N', 0, 0, 0),
	(42, 0, 'pawel@olicom.pl', 'Paweł', 'Mor', NULL, NULL, 'Posen', '12-365', 'testowa 3', NULL, '', NULL, '123654789', NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'N', 'N', 0, 0, 0),
	(43, 0, 'pawel@olicom.pl', 'Paweł', 'Mor', NULL, NULL, 'Posen', '12-365', 'testowa 3', NULL, '', NULL, '123654789', NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'N', 'N', 0, 0, 0),
	(44, 0, 'pawel@olicom.pl', 'Paweł', 'Mor', NULL, NULL, 'Posen', '12-365', 'testowa 3', NULL, '', NULL, '123654789', NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'N', 'N', 0, 0, 0),
	(45, 0, 'pawel@olicom.org.pl', 'Paweł', 'Mor', NULL, NULL, 'Posen', '12-365', 'testowa 3', NULL, '', NULL, '123654789', NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'N', 'N', 0, 0, 0),
	(46, 27, 'pawel@olicom.org.pl', 'Paweł', 'Mor', NULL, NULL, 'Posen', '12-365', 'testowa 3', NULL, '', NULL, '123654789', NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'N', 'N', 0, 0, 0),
	(47, 27, 'pawel@olicom.org.pl', 'Paweł', 'Mor', NULL, NULL, 'Posen', '12-365', 'testowa 3', NULL, '', NULL, '123654789', NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'N', 'N', 0, 0, 0),
	(48, 0, 'pawel@olicom.pl', 'Paweł', 'Mor', NULL, NULL, 'Posen', '12-365', 'testowa 3', NULL, 'Polen', NULL, '123654789', NULL, NULL, 'pawel@olicom.pl', 'Paweł', 'Mor', 'Company', NULL, 'Warsaw', '11-789', 'Bronx 1', NULL, 'zambezi', NULL, '1234556767', NULL, NULL, '', 'Lol', 'Test', 'Rowo', '1236647984654', 'Gibraltar', '77-896', 'Test', NULL, 'Whoho', NULL, NULL, NULL, NULL, 'Y', 'Y', 0, 0, 0),
	(49, 0, 'pawel@olicom.pl', 'test', 'test', NULL, NULL, 'test', '12-365', 'test', NULL, 'test', NULL, '123654789', NULL, NULL, 'pawel@olicom.pl', 'test', 'test', 'test', NULL, 'test', '11-888', 'test', NULL, 'test', NULL, '32165468496', NULL, NULL, '', 'test', 'test', 'test', '12365748451', 'test', '11-888', 'test', NULL, 'test', NULL, NULL, NULL, NULL, 'Y', 'Y', 0, 0, 0),
	(50, 0, 'pawel@olicom.org.pl', 'Paweł', 'Mor', NULL, NULL, 'Posen', '12-365', 'testowa 3', NULL, '', NULL, '123654789', NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'N', 'N', 0, 0, 0),
	(51, 0, 'pawel@olicom.pl', 'Paweł', 'Mor', NULL, NULL, 'Posen', '12-365', 'testowa 3', NULL, '', NULL, '123654789', NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'N', 'N', 0, 0, 0),
	(52, 0, 'pawel@olicom.pl', 'Paweł', 'Mor', NULL, NULL, 'Posen', '12-365', 'testowa 3', NULL, '', NULL, '123654789', NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'N', 'N', 0, 0, 0),
	(53, 0, 'pawel@olicom.pl', 'Paweł', 'Moro', NULL, NULL, 'Posen', '12-365', 'testowa 3', NULL, '', NULL, '123654789', NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'N', 'N', 0, 0, 0),
	(54, 31, 'hubert@olicom.pl', 'Hubert', 'test', NULL, NULL, 'test', '44-444', 'Kmicica 1', NULL, 'Polska', NULL, '333444555', NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'N', 'N', 0, 0, 0),
	(55, 0, 'pawel@olicom.pl', 'Paweł', 'Mor', NULL, NULL, 'Posen', '12-365', 'testowa 3', NULL, '', NULL, '123654789', NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'N', 'N', 0, 0, 0),
	(56, 0, 'pawel@olicom.org.pl', 'Paweł', 'Mor', NULL, NULL, 'Posen', '12-365', 'testowa 3', NULL, '', NULL, '123654789', NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'N', 'N', 0, 0, 0),
	(57, 0, 'hubert@olicom.pl', 'Hubert', 'kkkk', NULL, NULL, 'test', '44-444', 'Kmicica 1', NULL, 'hubert@olicom.pl', NULL, '333444555', NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'N', 'N', 0, 0, 0),
	(58, 0, 'hubert@olicom.org.pl', 'Hubert', 'kkkk', NULL, NULL, 'test', '44-444', 'Kmicica 1', NULL, 'pljh', NULL, '333444555', NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'N', 'N', 0, 0, 0),
	(59, 31, 'hubert@olicom.pl', 'Hubert', 'test', NULL, NULL, 'test', '44-444', 'Kmicica 1', NULL, 'Polska', NULL, '333444555', NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'N', 'N', 0, 0, 0),
	(60, 31, 'hubert@olicom.pl', 'Hubert', 'test', NULL, NULL, 'test', '44-444', 'Kmicica 1', NULL, 'Polska', NULL, '333444555', NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'N', 'N', 0, 0, 0),
	(61, 31, 'hubert@olicom.pl', 'Hubert', 'test', NULL, NULL, 'test', '44-444', 'Kmicica 1', NULL, 'Polska', NULL, '333444555', NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'N', 'N', 0, 0, 0),
	(62, 31, 'hubert@olicom.pl', 'Hubert', 'test', NULL, NULL, 'test', '44-444', 'Kmicica 1', NULL, 'Polska', NULL, '333444555', NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'N', 'N', 0, 0, 0),
	(63, 31, 'hubert@olicom.pl', 'Hubert', 'test', NULL, NULL, 'test', '44-444', 'Kmicica 1', NULL, 'Polska', NULL, '333444555', NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'N', 'N', 0, 0, 0),
	(64, 0, 'hubert@olicom.pl', 'Hubert', 'kkkk', NULL, NULL, 'test', '44-444', 'Kmicica 1', NULL, 'hubert@olicom.pl', NULL, '555666777', NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'N', 'N', 0, 0, 0),
	(65, 0, 'asd-zyg@wp.pl', 'Hubert', 'kkkk', NULL, NULL, 'Poznań', '44-444', 'Kmicica 1', NULL, 'hubert@olicom.pl', NULL, '333444555', NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'N', 'N', 0, 0, 0),
	(66, 0, 'asd-zyg@wp.pl', 'Hubert', 'test', NULL, NULL, 'test', '44-444', 'Kmicica 1', NULL, 'polska', NULL, '333444555', NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'N', 'N', 0, 0, 0),
	(67, 0, 'asd-zyg@wp.pl', 'Testowy', 'test', NULL, NULL, 'test', '44-444', 'Kmicica 1', NULL, 'test', NULL, '333444555', NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'N', 'N', 0, 0, 0),
	(68, 0, 'asd-zyg@wp.pl', 'Hubert', 'test', NULL, NULL, 'test', '44-444', 'Kmicica 1', NULL, 'hubert@olicom.pl', NULL, '333444555', NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'N', 'N', 0, 0, 0),
	(69, 0, 'hubert@olicom.pl', 'Hubert', 'kkkk', NULL, NULL, 'test', '44-444', 'Kmicica 1', NULL, 'Polska', NULL, '333444555', NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'N', 'N', 0, 0, 0),
	(70, 0, 'pawel@olicom.org.pl', 'Paweł', 'Mor', NULL, NULL, 'Posen', '12-365', 'testowa 3', NULL, '', NULL, '123654789', NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'N', 'N', 0, 0, 0),
	(71, 0, 'pawel@olicom.org.pl', 'Paweł', 'Mor', NULL, NULL, 'Posen', '12-365', 'testowa 3', NULL, '', NULL, '123654789', NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'N', 'N', 0, 0, 0),
	(72, 33, 'pawel@olicom.org.pl', 'Paweł', 'Mor', NULL, NULL, 'Posen', '12-365', 'testowa 3', NULL, '', NULL, '123654789', NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'N', 'N', 0, 0, 0),
	(73, 0, 'hubert@olicom.pl', 'Hubert', 'test', NULL, NULL, 'Poznań', '44-444', 'Kmicica 1', NULL, 'hubert@olicom.pl', NULL, '333444555', NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'N', 'N', 0, 0, 0),
	(74, 0, 'hubert@olicom.pl', 'Hubert', 'test', NULL, NULL, 'test', '44-444', 'Kmicica 1', NULL, 'hubert@olicom.pl', NULL, '333444555', NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'N', 'N', 0, 0, 0),
	(75, 0, 'hubert@olicom.pl', 'Hubert', 'kkkk', NULL, NULL, 'Poznań', '44-444', 'Kmicica 1', NULL, 'hubert@olicom.pl', NULL, '333444555', NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'N', 'N', 0, 0, 0),
	(76, 0, 'hubert@olicom.pl', 'Hubert', 'test', NULL, NULL, 'test', '44-444', 'Kmicica 1', NULL, 'hubert@olicom.pl', NULL, '333444555', NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'N', 'N', 0, 0, 0),
	(77, 0, 'hubert@olicom.pl', 'Testowy', 'test', NULL, NULL, 'test', '44-444', 'Kmicica 1', NULL, 'hubert@olicom.pl', NULL, '333444555', NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'N', 'N', 0, 0, 0),
	(78, 0, 'hubert@olicom.pl', 'Hubert', 'kkkk', NULL, NULL, 'test', '44-444', 'Kmicica 1', NULL, 'hubert@olicom.pl', NULL, '333444555', NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'N', 'N', 0, 0, 0),
	(79, 0, 'hubert@olicom.pl', 'Hubert', 'kkkk', NULL, NULL, 'Poznań', '60-160', 'Kmicica 1', NULL, 'hubert@olicom.pl', NULL, '333444555', NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'N', 'N', 0, 0, 0),
	(80, 0, 'hubert@olicom.pl', 'Hubert', 'kkkk', NULL, NULL, 'test', '44-444', 'Kmicica 1', NULL, 'pol', NULL, '333444555', NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'N', 'N', 0, 0, 0),
	(81, 0, 'hubert@olicom.pl', 'Hubert', 'test', NULL, NULL, 'test', '44-444', 'Kmicica 1', NULL, 'hubert@olicom.pl', NULL, '333444555', NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'N', 'N', 0, 0, 0),
	(82, 0, 'hubert@olicom.pl', 'Hubert', 'kkkk', NULL, NULL, 'test', '44-444', 'Kmicica 1', NULL, 'hubert@olicom.pl', NULL, '333444555', NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'N', 'N', 0, 0, 0),
	(83, 0, 'hubert@olicom.pl', 'Hubert', 'kkkk', NULL, NULL, 'test', '44-444', 'Kmicica 1', NULL, 'hubert@olicom.pl', NULL, '333444555', NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'N', 'N', 0, 0, 0),
	(84, 0, 'hubert@olicom.pl', 'Hubert', 'kkkk', NULL, NULL, 'test', '44-444', 'Kmicica 1', NULL, 'hubert@olicom.pl', NULL, '333444555', NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'N', 'N', 0, 0, 0),
	(85, 0, 'hubert@olicom.pl', 'Hubert', 'kkkk', NULL, NULL, 'test', '44-444', 'Kmicica 1', NULL, 'hubert@olicom.pl', NULL, '333444555', NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'N', 'N', 0, 0, 0),
	(86, 0, 'hubert@olicom.pl', 'Hubert', 'kkkk', NULL, NULL, 'test', '44-444', 'Kmicica 1', NULL, 'hubert@olicom.pl', NULL, '333444555', NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'N', 'N', 0, 0, 0),
	(87, 0, 'hubert@olicom.pl', 'Hubert', 'kkkk', NULL, NULL, 'Poznań', '44-444', 'Kmicica 1', NULL, 'hubert@olicom.pl', NULL, '333444555', NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'N', 'N', 0, 0, 0),
	(88, 0, 'hubert@olicom.pl', 'Hubert', 'kkkk', NULL, NULL, 'Poznań', '60-160', 'Kmicica 1', NULL, 'hh', NULL, '333444555', NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'N', 'N', 0, 0, 0),
	(89, 34, 'hubert@olicom.pl', 'hubert', 'kkkk', NULL, NULL, 'poznan', '55-666', 'adres 2', NULL, 'polska', NULL, '555666444', NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'N', 'N', 0, 0, 0),
	(90, 0, 'pawel@olicom.pl', 'test', 'test', NULL, NULL, 'Posen', '12-365', 'testowa 3', NULL, '', NULL, '123456798', NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'N', 'N', 0, 0, 0),
	(91, 36, 'pawel@olicom.pl', 'Paweł', 'Mor', NULL, NULL, 'Posen', '12-365', 'testowa 3', NULL, '', NULL, '123456798', NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'N', 'N', 0, 0, 0),
	(92, 0, 'pawel@olicom.pl', 'Paweł', 'Mor', NULL, NULL, 'Posen', '12-365', 'testowa 3', NULL, '', NULL, '123456798', NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'N', 'N', 0, 0, 0),
	(93, 0, 'pawel@olicom.pl', 'Paweł', 'Mor', NULL, NULL, 'Posen', '12-365', 'testowa 3', NULL, '', NULL, '123456798', NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'N', 'N', 0, 0, 0),
	(94, 0, 'hubert@olicom.pl', 'Marcin', 'Marciniak', NULL, NULL, 'Swarzędz', '55-555', 'test', NULL, '', NULL, '321 321 321', NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'N', 'N', 0, 0, 0);
/*!40000 ALTER TABLE `shop_orders_customers` ENABLE KEYS */;

-- Zrzucanie danych dla tabeli cms2.shop_orders_products: 78 rows
DELETE FROM `shop_orders_products`;
/*!40000 ALTER TABLE `shop_orders_products` DISABLE KEYS */;
INSERT INTO `shop_orders_products` (`order_id`, `product_id`, `product_name`, `product_attributes`, `product_count`, `product_price`, `product_rebate`) VALUES
	(27, 87, '', '', 3, 33.00, 0),
	(28, 87, '', '', 2, 33.00, 0),
	(29, 87, '', '', 2, 33.00, 0),
	(30, 87, '', '', 2, 33.00, 0),
	(31, 87, '', '', 2, 33.00, 0),
	(32, 87, '', '', 2, 33.00, 0),
	(33, 87, '', '', 2, 33.00, 0),
	(34, 87, '', '', 2, 33.00, 0),
	(35, 87, '', '', 2, 33.00, 0),
	(36, 87, '', '', 2, 33.00, 0),
	(37, 87, '', '', 2, 33.00, 0),
	(38, 87, '', '', 2, 33.00, 0),
	(39, 87, '', '', 3, 33.00, 0),
	(40, 87, '', '', 3, 33.00, 0),
	(41, 87, '', '', 3, 33.00, 0),
	(42, 87, '', '', 3, 33.00, 0),
	(43, 91, '', '3:niebieski', 1, 120.00, 0),
	(44, 91, '', '3:niebieski', 1, 120.00, 0),
	(45, 91, '', '3:Czarnuszy;4:Słomki niebieskie', 2, 120.00, 0),
	(45, 91, '', '3:Zielony;4:Różowy', 3, 120.00, 0),
	(46, 88, '', '', 1, 144.00, 0),
	(47, 87, '', '', 1, 33.00, 0),
	(48, 96, '', '', 1, 10.00, 0),
	(49, 96, '', '', 1, 10.00, 0),
	(50, 97, '', '', 2, 10.00, 0),
	(51, 96, '', '', 1, 10.00, 0),
	(52, 97, '', '', 1, 10.00, 0),
	(53, 96, '', '', 18, 10.00, 0),
	(54, 103, '', '', 1, 330.00, 0),
	(55, 102, '', '', 1, 44.00, 0),
	(56, 103, '', '', 2, 330.00, 0),
	(56, 102, '', '', 1, 44.00, 0),
	(57, 101, '', '', 6, 55.00, 0),
	(57, 102, '', '', 1, 44.00, 0),
	(58, 103, '', '', 1, 330.00, 0),
	(59, 101, '', '', 1, 55.00, 0),
	(60, 101, '', '', 32, 55.00, 0),
	(61, 99, '', '', 1, 44.00, 0),
	(62, 99, '', '', 1, 44.00, 0),
	(63, 103, '', '', 2, 330.00, 0),
	(64, 102, '', '', 1, 44.00, 0),
	(65, 99, '', '', 1, 44.00, 0),
	(66, 99, '', '', 1, 44.00, 0),
	(67, 99, '', '', 1, 44.00, 0),
	(68, 99, '', '', 1, 44.00, 0),
	(69, 102, '', '', 1, 44.00, 0),
	(70, 103, '', '', 1, 330.00, 0),
	(71, 102, '', '', 3, 44.00, 0),
	(72, 104, '', '', 1, 44.00, 0),
	(73, 107, '', '', 10, 44.00, 10),
	(73, 98, '', '3:Czerwony', 2, 44.00, 0),
	(73, 108, '', '', 3, 55.00, 10),
	(74, 108, '', '', 1, 55.00, 10),
	(75, 108, '', '', 1, 55.00, 10),
	(76, 108, '', '', 1, 55.00, 10),
	(77, 108, '', '', 1, 55.00, 10),
	(78, 107, '', '', 5, 44.00, 10),
	(78, 98, '', '3:Czarnuszy', 1, 44.00, 0),
	(79, 107, '', '', 1, 44.00, 10),
	(79, 98, '', '3:Czerwony', 1, 44.00, 0),
	(80, 108, '', '', 1, 55.00, 0),
	(81, 102, '', '', 1, 44.00, 0),
	(82, 102, '', '', 1, 44.00, 0),
	(83, 102, '', '', 1, 44.00, 0),
	(84, 102, '', '', 1, 44.00, 0),
	(85, 102, '', '', 1, 44.00, 0),
	(86, 102, '', '', 1, 44.00, 0),
	(87, 102, '', '', 1, 44.00, 0),
	(88, 102, '', '', 1, 44.00, 10),
	(88, 105, '', '', 1, 10.00, 10),
	(88, 106, '', '', 1, 120.00, 10),
	(89, 105, '', '', 1, 10.00, 50),
	(89, 108, '', '', 1, 55.00, 20),
	(90, 126, '', '', 1, 200.00, 0),
	(91, 123, '', '', 1, 19.99, 0),
	(92, 125, '', '', 1, 39.90, 0),
	(93, 125, '', '4:Różowy', 1, 39.90, 0),
	(94, 126, '', '', 1, 200.00, 0);
/*!40000 ALTER TABLE `shop_orders_products` ENABLE KEYS */;

-- Zrzucanie danych dla tabeli cms2.shop_orders_statuses: 5 rows
DELETE FROM `shop_orders_statuses`;
/*!40000 ALTER TABLE `shop_orders_statuses` DISABLE KEYS */;
INSERT INTO `shop_orders_statuses` (`id_order_status`, `order_status_name`, `language`) VALUES
	(1, 'nowe', 'pl_PL'),
	(2, 'zapłacono', 'pl_PL'),
	(3, 'w realizacji', 'pl_PL'),
	(4, 'zrealizowano', 'pl_PL'),
	(5, 'zamknięte', 'pl_PL');
/*!40000 ALTER TABLE `shop_orders_statuses` ENABLE KEYS */;

-- Zrzucanie danych dla tabeli cms2.shop_parameters: 0 rows
DELETE FROM `shop_parameters`;
/*!40000 ALTER TABLE `shop_parameters` DISABLE KEYS */;
/*!40000 ALTER TABLE `shop_parameters` ENABLE KEYS */;

-- Zrzucanie danych dla tabeli cms2.shop_parameters_description: 0 rows
DELETE FROM `shop_parameters_description`;
/*!40000 ALTER TABLE `shop_parameters_description` DISABLE KEYS */;
/*!40000 ALTER TABLE `shop_parameters_description` ENABLE KEYS */;

-- Zrzucanie danych dla tabeli cms2.shop_parameters_to_categories: 0 rows
DELETE FROM `shop_parameters_to_categories`;
/*!40000 ALTER TABLE `shop_parameters_to_categories` DISABLE KEYS */;
/*!40000 ALTER TABLE `shop_parameters_to_categories` ENABLE KEYS */;

-- Zrzucanie danych dla tabeli cms2.shop_parameters_values: 0 rows
DELETE FROM `shop_parameters_values`;
/*!40000 ALTER TABLE `shop_parameters_values` DISABLE KEYS */;
/*!40000 ALTER TABLE `shop_parameters_values` ENABLE KEYS */;

-- Zrzucanie danych dla tabeli cms2.shop_payment_types: 3 rows
DELETE FROM `shop_payment_types`;
/*!40000 ALTER TABLE `shop_payment_types` DISABLE KEYS */;
INSERT INTO `shop_payment_types` (`id_payment_type`, `active`, `payment_cost`, `payment_type_method`) VALUES
	(1, 'Y', 0.00, NULL),
	(2, 'Y', 0.00, 'dotpay'),
	(3, 'Y', 0.00, 'dotpay');
/*!40000 ALTER TABLE `shop_payment_types` ENABLE KEYS */;

-- Zrzucanie danych dla tabeli cms2.shop_payment_types_description: 3 rows
DELETE FROM `shop_payment_types_description`;
/*!40000 ALTER TABLE `shop_payment_types_description` DISABLE KEYS */;
INSERT INTO `shop_payment_types_description` (`payment_type_id`, `payment_type_name`, `payment_type_language`, `payment_type_info`) VALUES
	(1, 'Przelew na konto', 'pl_PL', 'PL  00 0000 0000 0000 0000 0000 0000<br/>Numer SWIFT banku: AAAAAAAA  -  jeśli płatność jest dokonywana z zagranicy<br/><br/>twoja firma<br/>ul. Ulica 1<br/>00-000 Miasto<br/><br/><strong>W tytule proszę wpisać numer zamówienia, oraz swoje imię i nazwisko.</strong>'),
	(2, 'Karta kredytowa', 'pl_PL', NULL),
	(3, 'Dotpay', 'pl_PL', NULL);
/*!40000 ALTER TABLE `shop_payment_types_description` ENABLE KEYS */;

-- Zrzucanie danych dla tabeli cms2.shop_producers: 3 rows
DELETE FROM `shop_producers`;
/*!40000 ALTER TABLE `shop_producers` DISABLE KEYS */;
INSERT INTO `shop_producers` (`id_producer`, `producer_name`, `producer_logo`, `position`, `active`, `rebate`) VALUES
	(11, 'Olicom', 'olicom-logo.png', 1, 'Y', NULL),
	(13, 'asds', NULL, 0, 'Y', NULL),
	(16, 'gbfc', NULL, 0, 'N', NULL);
/*!40000 ALTER TABLE `shop_producers` ENABLE KEYS */;

-- Zrzucanie danych dla tabeli cms2.shop_products: 19 rows
DELETE FROM `shop_products`;
/*!40000 ALTER TABLE `shop_products` DISABLE KEYS */;
INSERT INTO `shop_products` (`id_product`, `price`, `net_price`, `tax_id`, `promotion_price`, `times_viewed`, `ask_for_price`, `code`, `active`, `recommend`, `quantity`, `quantity_tracking`, `date_added`, `date_modified`, `date_expire`, `ean`, `parameter_category_id`, `hide_price`, `measure_unit_id`, `producer_id`, `product_status_id`, `preparation`, `premiere_date`, `promotion_date_start`, `promotion_date_end`, `new`, `bestseller`, `old_price`, `constant_discount`, `rebate_group_id`, `max_rebate`, `loyality_points`, `product_of_the_day_date`, `sale`, `sale_date_start`, `sale_date_end`, `allow_voting`, `allow_comments`, `free_delivery`, `additional_delivery_cost`, `netto_surface`, `homestead_surface`, `volume`, `estimate`, `height`, `project_price`, `usable_surface`, `roof_angle`, `roof_surface`, `minimum_plot_width`, `minimum_plot_length`, `estimated_calculation`, `allegro_template`, `product_position`, `product_allow_rabate`, `product_stock`) VALUES
	(121, 350.00, 1.00, NULL, NULL, NULL, 'N', '', 'Y', 'N', 0, 'N', '1402656180', NULL, NULL, NULL, NULL, 'N', NULL, 11, 1, 'N', NULL, NULL, NULL, 'N', 'N', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'N', 'N', 'N', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
	(123, 19.99, 3.61, 0, NULL, NULL, 'N', '', 'Y', 'N', 0, 'N', '1402656817', '1402656842', '', '', NULL, 'N', NULL, 11, 1, 'N', NULL, NULL, NULL, 'N', 'N', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'N', 'N', 'N', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
	(120, 190.00, 361.00, NULL, NULL, NULL, 'N', '', 'Y', 'N', 0, 'N', '1402655638', '1402656210', NULL, NULL, NULL, 'N', NULL, 11, 1, 'N', NULL, NULL, NULL, 'N', 'N', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'N', 'N', 'N', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
	(114, 1200.00, 14.00, NULL, NULL, NULL, 'N', '', 'Y', 'N', 0, 'N', '1402653096', '1402653128', NULL, NULL, NULL, 'N', NULL, 11, 1, 'N', NULL, NULL, NULL, 'Y', 'N', 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'N', 'N', 'N', 0.00, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
	(115, 500.00, 2.00, NULL, NULL, NULL, 'N', '', 'Y', 'N', 0, 'N', '1402653316', '1402653407', NULL, NULL, NULL, 'N', NULL, 11, 1, 'N', NULL, NULL, NULL, 'N', 'N', 700.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'N', 'N', 'N', 0.00, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, 0),
	(116, 999.00, 9.00, 0, NULL, NULL, 'N', '', 'N', 'N', 0, 'N', '1402653604', '1406206146', '', '', NULL, 'N', NULL, 11, 1, 'N', NULL, NULL, NULL, 'Y', 'N', 1300.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'N', 'N', 'N', 0.00, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, 0),
	(117, 1000.00, 10.00, NULL, NULL, NULL, 'N', '', 'Y', 'N', 0, 'N', '1402653916', '1402653947', NULL, NULL, NULL, 'N', NULL, 11, 1, 'N', NULL, NULL, NULL, 'Y', 'N', 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'N', 'N', 'N', 0.00, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
	(118, 100.00, 100.00, NULL, NULL, NULL, 'N', '', 'Y', 'N', 0, 'N', '1402654161', '1402654178', NULL, NULL, NULL, 'N', NULL, 11, 1, 'N', NULL, NULL, NULL, 'N', 'N', 200.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'N', 'N', 'N', 0.00, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, 0),
	(111, 2500.00, 62.00, NULL, NULL, NULL, 'N', '', 'Y', 'N', 0, 'N', '1402650673', NULL, NULL, NULL, NULL, 'N', NULL, 11, 1, 'N', NULL, NULL, NULL, 'N', 'N', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'N', 'N', 'N', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
	(112, 500.00, 2.00, NULL, NULL, NULL, 'N', '', 'Y', 'N', 0, 'N', '1402650900', NULL, NULL, NULL, NULL, 'N', NULL, 11, 1, 'N', NULL, NULL, NULL, 'N', 'N', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'N', 'N', 'N', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
	(113, 1500.00, 22.00, NULL, NULL, NULL, 'N', '', 'Y', 'N', 0, 'N', '1402652938', NULL, NULL, NULL, NULL, 'N', NULL, 11, 1, 'N', NULL, NULL, NULL, 'N', 'N', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'N', 'N', 'N', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
	(110, 600.00, 3.00, NULL, NULL, NULL, 'N', '', 'Y', 'N', 0, 'N', '1402650517', NULL, NULL, NULL, NULL, 'N', NULL, 11, 1, 'N', NULL, NULL, NULL, 'N', 'N', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'N', 'N', 'N', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
	(109, 1500.00, 22.00, NULL, NULL, NULL, 'N', '', 'Y', 'N', 0, 'N', '1402650404', NULL, NULL, NULL, NULL, 'N', NULL, 11, 1, 'N', NULL, NULL, NULL, 'N', 'N', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'N', 'N', 'N', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
	(122, 500.00, 2.00, NULL, NULL, NULL, 'N', '', 'Y', 'N', 0, 'N', '1402656319', NULL, NULL, NULL, NULL, 'N', NULL, 11, 1, 'N', NULL, NULL, NULL, 'N', 'N', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'N', 'N', 'N', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
	(124, 14.90, 2.22, NULL, NULL, NULL, 'N', '', 'Y', 'N', 0, 'N', '1402656915', NULL, NULL, NULL, NULL, 'N', NULL, 11, 1, 'N', NULL, NULL, NULL, 'N', 'N', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'N', 'N', 'N', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
	(125, 39.90, 15.92, NULL, NULL, NULL, 'N', '', 'Y', 'N', 0, 'N', '1402656989', '1406025636', NULL, NULL, NULL, 'N', NULL, 11, 1, 'N', NULL, NULL, NULL, 'N', 'N', 49.90, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'N', 'N', 'N', 0.00, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, 0),
	(126, 200.00, 400.00, NULL, NULL, NULL, 'N', '', 'Y', 'N', 0, 'N', '1402657270', NULL, NULL, NULL, NULL, 'N', NULL, 11, 1, 'N', NULL, NULL, NULL, 'N', 'N', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'N', 'N', 'N', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
	(127, 2500.00, 62.00, NULL, NULL, NULL, 'N', '', 'Y', 'N', 0, 'N', '1402657489', '1402657510', NULL, NULL, NULL, 'N', NULL, 11, 1, 'N', NULL, NULL, NULL, 'Y', 'N', 3000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'N', 'N', 'N', 0.00, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, 0),
	(129, 15129.00, 0.01, 23, NULL, NULL, 'N', '12', 'Y', 'N', 0, 'N', '1406789908', '1406790645', '', '', NULL, 'N', NULL, 13, 1, 'N', NULL, NULL, NULL, 'N', 'N', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'N', 'N', 'N', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 2);
/*!40000 ALTER TABLE `shop_products` ENABLE KEYS */;

-- Zrzucanie danych dla tabeli cms2.shop_products_attachments: 0 rows
DELETE FROM `shop_products_attachments`;
/*!40000 ALTER TABLE `shop_products_attachments` DISABLE KEYS */;
/*!40000 ALTER TABLE `shop_products_attachments` ENABLE KEYS */;

-- Zrzucanie danych dla tabeli cms2.shop_products_attributes: 2 rows
DELETE FROM `shop_products_attributes`;
/*!40000 ALTER TABLE `shop_products_attributes` DISABLE KEYS */;
INSERT INTO `shop_products_attributes` (`product_id`, `attribute_id`, `attribute_value_id`, `price`, `default_value`, `quantity`) VALUES
	(125, 7, 39, NULL, 'N', NULL),
	(125, 4, 25, NULL, 'N', NULL);
/*!40000 ALTER TABLE `shop_products_attributes` ENABLE KEYS */;

-- Zrzucanie danych dla tabeli cms2.shop_products_comments: 0 rows
DELETE FROM `shop_products_comments`;
/*!40000 ALTER TABLE `shop_products_comments` DISABLE KEYS */;
/*!40000 ALTER TABLE `shop_products_comments` ENABLE KEYS */;

-- Zrzucanie danych dla tabeli cms2.shop_products_description: 19 rows
DELETE FROM `shop_products_description`;
/*!40000 ALTER TABLE `shop_products_description` DISABLE KEYS */;
INSERT INTO `shop_products_description` (`id_product_description`, `product_id`, `product_language`, `product_name`, `product_description`, `product_short_description`, `product_guarantee`, `meta_title`, `meta_description`, `meta_keywords`, `product_media`) VALUES
	(198, 110, 'pl_PL', 'Wizytówki', '<p>Wykonujemy wizyt&oacute;wki wg własnego projektu, jak r&oacute;wnież na podstawie materiał&oacute;w dostarczonych od klienta. Zar&oacute;wno jednostronne i dwustronne mogą byś zadrukowane na papierze offsetowym (220-300g), kredowym (220-350g) lub na tworzywie sztucznym. Wymiary oraz orientacja użytku dowolna &ndash; wg ustaleń, lub wg standard&oacute;w. Ponadto proponujemy szereg dodatkowych uszlachetnień takich jak, suchy tłok (hot stamping), złocenie, perforacje, bigowanie (w przypadku wizyt&oacute;wek łamanych), lakiery wybi&oacute;rcze, lakiery hybrydowe, brokat, foliowanie, inne.</p>\r\n<p>&nbsp;</p>\r\n<p>Jeśli korzystacie z naszej oferty internetowej , zapraszamy do wypełnienia&nbsp;<span class="form_open"><strong>formularza kontaktowego</strong></span>, prosimy o wypełnienie p&oacute;l telefon oraz email. Po otrzymaniu informacji nasz pracownik skontaktuje się z klientem w celu dokonania dalszych ustaleń.</p>', '', '', NULL, NULL, NULL, ''),
	(197, 109, 'pl_PL', 'Strona na Wordpress', '<p>Utworzone strony www w tym systemia mają panel administracyjny tak zaprojektowany by był użyteczny i prosty w obsłudze.</p>\r\n<p>Strony www oparte o Wordpress posiadają wiele funkcji administracyjnych, kt&oacute;re dodatkowo możemy jeszcze rozszerzyć poprzez wgranie odpowiednich wtyczek.</p>', '', '', NULL, NULL, NULL, ''),
	(199, 111, 'pl_PL', 'Sklep na Prestashop', '<ul>\r\n<li>Atrakcyjna i przejrzysta szata graficzna do wyboru</li>\r\n<li>Płatności online</li>\r\n<li>Wygodny i łatwy w obsłudze panel administracyjny</li>\r\n<li>Kompleksowe zarządzanie produktem i magazynem</li>\r\n</ul>\r\n<ul>\r\n<li>Wersja mobilna</li>\r\n<li>Możliwość&nbsp;zakładania&nbsp;kont&nbsp;pracownikom i nadawania uprawnień</li>\r\n<li>Własny adres www i poczta e-mail</li>\r\n<li>Atrakcyjna cena od 2499 zł</li>\r\n<li>Domena i hosting&nbsp;<strong>gratis!</strong></li>\r\n</ul>', '', '', NULL, NULL, NULL, ''),
	(200, 112, 'pl_PL', 'Logotyp', '<p><strong>Ustalenia:&nbsp;</strong><br />1. Zakresu branżowego dla znaku graficznego&nbsp;<br />2. Preferencje kolorystyczne (narzuca klient lub my proponujemy)&nbsp;<br />3. Forma graficzna&nbsp;<br />4. Por&oacute;wnanie konkurencji&nbsp;<br />5. Wycena produktu<br /><br /><strong>Projekt:</strong>&nbsp;<br />1. Projektujemy logotyp zgodnie z ustaleniami.&nbsp;<br />2. Przesyłamy do Państwa projekt logotypu.&nbsp;<br />3. Po uwzględnieniu sugestii i uwag z Państwa strony dokonujemy zmian.&nbsp;<br />4. Akceptacja projektu.<br /><br /><strong>Etap techniczny:</strong>&nbsp;<br />1. Przygotowanie logotypu w wersjach:</p>\r\n<div>- Pantone,&nbsp;<br />- CMYK,&nbsp;<br />- RGB,&nbsp;<br />- Grayscale,<br />- B&amp;W (1bit).</div>\r\n<p>2. Wymiarowanie znaku graficznego&nbsp;<br />3. Opis kolorystyki<br /><br /><strong>Wysyłka:</strong>&nbsp;<br />1. Dostarczamy do Państwa materiał w dowolny uzgodniony spos&oacute;b (poczta elektroniczna, serwer FTP, nośnik cyfrowy (CD, DVD, USB)&nbsp;<br />2. Materiał przygotowany w wymienionych wersjach kolorystycznych przesyłamy do Państwa w formie wektorowej: EPS (Endual Postscript), PDF oraz wersji bitmapowej TIFF, JPG, PSD (transparent background)</p>', '', '', NULL, NULL, NULL, ''),
	(201, 113, 'pl_PL', 'Strony na facebooku', '<p><strong>Budujemy silne wizerunkowo, skuteczne fan page&rsquo;e.</strong><br />Gwarantujemy, że prowadzone przez nas profile wyraźnie wyr&oacute;żniają się z zalewu standardowych podstron Facebooka. Skutecznie nawiązujemy kontakt z użytkownikami, aktywizujemy ich, ale r&oacute;wnież moderujemy ich interakcję.</p>', '', '', NULL, NULL, NULL, ''),
	(202, 114, 'pl_PL', 'Strony mobilne', '<p>Olicom tworzy mobilne wersje stron internetowych, perfekcyjnie dostosowane do wyświetlania w telefonach kom&oacute;rkowych. Dzięki nam właściciel każdej kom&oacute;rki z dostępem do internetu będzie m&oacute;gł bezproblemowo, szybko i tanio (nie płacąc wiele za transfer danych swojemu operatorowi) uzyskać dostęp do Państwa oferty, kiedykolwiek, jakkolwiek i gdziekolwiek będzie się znajdował.</p>', '', '', NULL, NULL, NULL, ''),
	(203, 115, 'pl_PL', 'Audyt Usability', '<p style="text-align: left;"><span style="font-size: 14px;">Audyt usability to inaczej ocena strony czy spełnia te wszystkie w/w funkcje. Sporządzenie audytu strony, portalu czy sklepu internetowego ma na celu wyłonienie wszelkich możliwych błęd&oacute;w. <br /></span></p>\r\n<p style="text-align: left;"><span style="font-size: 14px;">&nbsp;</span></p>\r\n<p style="text-align: left;"><span style="font-size: 14px;">Oferujemy wykonanie audytu usability i opisania wszystkich błęd&oacute;w możliwością ich naprawy. Na podstawie opisu znalezionych błęd&oacute;w proponujemy poprawę funkcjonalności serwisu lub całkowitą przebudowę.</span></p>', '', '', NULL, NULL, NULL, ''),
	(204, 116, 'pl_PL', 'Aktualizacja stron WWW', '<p>Postęp technologiczny sprawia, że strony internetowe bardzo się zmieniają, gł&oacute;wnie pod względem technologicznym, ale i r&oacute;wnież pod względem usability. Dlatego czynniki te powinny być dostosowane do obecnie obowiązujących trend&oacute;w.</p>\r\n<p>&nbsp;</p>\r\n<p>Aktualizacja jest r&oacute;wnież związana z treścią znajdująca się na stronie internetowtej, aby była ona dobrą wizyt&oacute;wką firmy, oferta w niej prezentowana powinna być aktualna. Oferujemy aktualizacje strony www kt&oacute;ra może przebiegać cyklicznie lub jednorazowo.</p>', '', '', NULL, NULL, NULL, ''),
	(205, 117, 'pl_PL', 'Kampanie reklamowe', '<p>Oferta Olicomu to świadome i skuteczne zarządzanie reklamą internetową. Płynnie poruszamy się po zakamarkach sieci i doskonale wiemy, kt&oacute;re źr&oacute;dła uruchomić, aby sprowadzić na stronę ruch dobrze wyselekcjonowanych odbiorc&oacute;w.&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>W kampaniach łączymy działania reklamowe na Facebooku, Google AdWords oraz w tematycznych sieciach reklam (np. AdTaily, BusinessClick, Adkontekst), dobierając media do potrzeb. Przykładowo: pozycjonowanie stron najlepiej wspiera reklama kontekstowa (AdWords), a budowanie społeczności - boksy reklamowe Facebooka.</p>', '', '', NULL, NULL, NULL, ''),
	(206, 118, 'pl_PL', 'Pozycjonowanie', '<p>Usługa polegająca na stałej pracy nad pozycją Państwa strony w wyszukiwarkach internetowych. Jej efektem ma być wysoka pozycja w wyszukiwarkach i zwiększenie ruchu na stronie.</p>', '', '', NULL, NULL, NULL, ''),
	(211, 123, 'pl_PL', 'Domeny *.PL', '<p>Umożliwiamy zarowno rejestrację jak i p&oacute;źniejsze przedłużenie ważności domeny.</p>', '', '', NULL, NULL, NULL, ''),
	(212, 124, 'pl_PL', 'Domeny *.COM.PL', '<p>Umożliwiamy zarowno rejestrację jak i p&oacute;źniejsze przedłużenie ważności domeny.</p>', '', '', NULL, NULL, NULL, ''),
	(208, 120, 'pl_PL', 'Hosting Standard', '<ul>\r\n<li>Wsp&oacute;łpracujemy z firmą Beyond, właścicielem najnowocześniejszej serwerowni w Polsce.</li>\r\n<li>Zapewniamy:</li>\r\n<li>Bezpieczeństwo,</li>\r\n<li>Profesjonalną obsługę,</li>\r\n<li>Nieograniczonaą ilość kont e-mailowych,</li>\r\n<li>Szybkie łącza,</li>\r\n<li>Niezawodność.</li>\r\n</ul>', '<table>\r\n<tbody>\r\n<tr class="border-bottom">\r\n<td style="width: 300px;">Pojemność serwera</td>\r\n<td style="width: 133px; text-align: right;">2 GB</td>\r\n<td style="width: 133px; text-align: right;">&nbsp;</td>\r\n<td style="width: 133px; text-align: right;">&nbsp;</td>\r\n</tr>\r\n<tr class="border-bottom">\r\n<td style="width: 300px;">Roczny pakiet ruchu z/do sieci Internet</td>\r\n<td style="width: 133px; text-align: right;">100 GB</td>\r\n<td style="width: 133px; text-align: right;">&nbsp;</td>\r\n<td style="width: 133px; text-align: right;">&nbsp;</td>\r\n</tr>\r\n<tr class="border-bottom">\r\n<td style="width: 300px;">Konta email</td>\r\n<td style="width: 133px; text-align: right;">b.o.</td>\r\n<td style="width: 133px; text-align: right;">&nbsp;</td>\r\n<td style="width: 133px; text-align: right;">&nbsp;</td>\r\n</tr>\r\n<tr class="border-bottom">\r\n<td style="width: 300px;">Bazy MySQL/InnoDB</td>\r\n<td style="width: 133px; text-align: right;">1</td>\r\n<td style="width: 133px; text-align: right;">&nbsp;</td>\r\n<td style="width: 133px; text-align: right;">&nbsp;</td>\r\n</tr>\r\n<tr class="border-bottom">\r\n<td style="width: 300px;">Konto na serwerze FTP</td>\r\n<td style="width: 133px; text-align: right;"><img src="http://olicom.com.pl/files/medias/image/tick.png" alt="" width="16" height="16" /></td>\r\n<td style="width: 133px; text-align: right;">&nbsp;</td>\r\n<td style="width: 133px; text-align: right;">&nbsp;</td>\r\n</tr>\r\n<tr class="border-bottom2">\r\n<td style="width: 300px;">Abonament roczny</td>\r\n<td style="width: 133px; text-align: right;"><strong><span style="color: #f31a68;">190 zł</span></strong> (netto)</td>\r\n<td style="width: 133px; text-align: right;">&nbsp;</td>\r\n<td style="width: 133px; text-align: right;">&nbsp;</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<p>&nbsp;</p>', '', NULL, NULL, NULL, ''),
	(209, 121, 'pl_PL', 'Hosting Biznes', '<p>&nbsp;&nbsp;&nbsp; Wsp&oacute;łpracujemy z firmą Beyond, właścicielem najnowocześniejszej serwerowni w Polsce.<br />&nbsp;&nbsp;&nbsp; Zapewniamy:<br />&nbsp;&nbsp;&nbsp; Bezpieczeństwo,<br />&nbsp;&nbsp;&nbsp; Profesjonalną obsługę,<br />&nbsp;&nbsp;&nbsp; Nieograniczonaą ilość kont e-mailowych,<br />&nbsp;&nbsp;&nbsp; Szybkie łącza,<br />&nbsp;&nbsp;&nbsp; Niezawodność.</p>', '<table>\r\n<tbody>\r\n<tr class="border-bottom">\r\n<td style="width: 300px;">Pojemność serwera</td>\r\n<td style="width: 133px; text-align: right;">&nbsp;</td>\r\n<td style="width: 133px; text-align: right;">5 GB</td>\r\n<td style="width: 133px; text-align: right;">&nbsp;</td>\r\n</tr>\r\n<tr class="border-bottom">\r\n<td style="width: 300px;">Roczny pakiet ruchu z/do sieci Internet</td>\r\n<td style="width: 133px; text-align: right;">&nbsp;</td>\r\n<td style="width: 133px; text-align: right;">300 GB</td>\r\n<td style="width: 133px; text-align: right;">&nbsp;</td>\r\n</tr>\r\n<tr class="border-bottom">\r\n<td style="width: 300px;">Konta email</td>\r\n<td style="width: 133px; text-align: right;">&nbsp;</td>\r\n<td style="width: 133px; text-align: right;">b.o.</td>\r\n<td style="width: 133px; text-align: right;">&nbsp;</td>\r\n</tr>\r\n<tr class="border-bottom">\r\n<td style="width: 300px;">Bazy MySQL/InnoDB</td>\r\n<td style="width: 133px; text-align: right;">&nbsp;</td>\r\n<td style="width: 133px; text-align: right;">5</td>\r\n<td style="width: 133px; text-align: right;">&nbsp;</td>\r\n</tr>\r\n<tr class="border-bottom">\r\n<td style="width: 300px;">Konto na serwerze FTP</td>\r\n<td style="width: 133px; text-align: right;">&nbsp;</td>\r\n<td style="width: 133px; text-align: right;"><img src="http://olicom.com.pl/files/medias/image/tick.png" alt="" width="16" height="16" /></td>\r\n<td style="width: 133px; text-align: right;">&nbsp;</td>\r\n</tr>\r\n<tr class="border-bottom2">\r\n<td style="width: 300px;">Abonament roczny</td>\r\n<td style="width: 133px; text-align: right;">&nbsp;</td>\r\n<td style="width: 133px; text-align: right;"><strong><span style="color: #f31a68;">350 zł</span></strong> (netto)</td>\r\n<td style="width: 133px; text-align: right;">&nbsp;</td>\r\n</tr>\r\n</tbody>\r\n</table>', '', NULL, NULL, NULL, ''),
	(210, 122, 'pl_PL', 'Hosting Pro', '<p>&nbsp;&nbsp;&nbsp; Wsp&oacute;łpracujemy z firmą Beyond, właścicielem najnowocześniejszej serwerowni w Polsce.<br />&nbsp;&nbsp;&nbsp; Zapewniamy:<br />&nbsp;&nbsp;&nbsp; Bezpieczeństwo,<br />&nbsp;&nbsp;&nbsp; Profesjonalną obsługę,<br />&nbsp;&nbsp;&nbsp; Nieograniczonaą ilość kont e-mailowych,<br />&nbsp;&nbsp;&nbsp; Szybkie łącza,<br />&nbsp;&nbsp;&nbsp; Niezawodność.</p>', '<table>\r\n<tbody>\r\n<tr class="border-bottom">\r\n<td style="width: 300px;">Pojemność serwera</td>\r\n<td style="width: 133px; text-align: right;">&nbsp;</td>\r\n<td style="width: 133px; text-align: right;">&nbsp;</td>\r\n<td style="width: 133px; text-align: right;">10 GB</td>\r\n</tr>\r\n<tr class="border-bottom">\r\n<td style="width: 300px;">Roczny pakiet ruchu z/do sieci Internet</td>\r\n<td style="width: 133px; text-align: right;">&nbsp;</td>\r\n<td style="width: 133px; text-align: right;">&nbsp;</td>\r\n<td style="width: 133px; text-align: right;">600 GB</td>\r\n</tr>\r\n<tr class="border-bottom">\r\n<td style="width: 300px;">Konta email</td>\r\n<td style="width: 133px; text-align: right;">&nbsp;</td>\r\n<td style="width: 133px; text-align: right;">&nbsp;</td>\r\n<td style="width: 133px; text-align: right;">b.o.</td>\r\n</tr>\r\n<tr class="border-bottom">\r\n<td style="width: 300px;">Bazy MySQL/InnoDB</td>\r\n<td style="width: 133px; text-align: right;">&nbsp;</td>\r\n<td style="width: 133px; text-align: right;">&nbsp;</td>\r\n<td style="width: 133px; text-align: right;">10</td>\r\n</tr>\r\n<tr class="border-bottom">\r\n<td style="width: 300px;">Konto na serwerze FTP</td>\r\n<td style="width: 133px; text-align: right;">&nbsp;</td>\r\n<td style="width: 133px; text-align: right;">&nbsp;</td>\r\n<td style="width: 133px; text-align: right;"><img src="http://olicom.com.pl/files/medias/image/tick.png" alt="" width="16" height="16" /></td>\r\n</tr>\r\n<tr class="border-bottom2">\r\n<td style="width: 300px;">Abonament roczny</td>\r\n<td style="width: 133px; text-align: right;">&nbsp;</td>\r\n<td style="width: 133px; text-align: right;">&nbsp;</td>\r\n<td style="width: 133px; text-align: right;"><span style="color: #f31a68;"><strong>500 zł</strong></span> (netto)</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<p>&nbsp;</p>', '', NULL, NULL, NULL, ''),
	(213, 125, 'pl_PL', 'Domeny *.COM, *.NET, *.ORG, *.EU', '<p>Umożliwiamy zarowno rejestrację jak i p&oacute;źniejsze przedłużenie ważności domeny.</p>', '', '', NULL, NULL, NULL, ''),
	(214, 126, 'pl_PL', 'Papier firmowy', '<p>Wykonujemy papier firmowy wg własnego projektu, jak r&oacute;wnież na podstawie materiał&oacute;w dostarczonych od klienta. Aby ułatwić możliwość swobodnego pisania odręcznego, maszynowego, jak i swobodny przelot przez drukarkę, wydruk proponujemy na papierze offsetowym w zakresie gramatury 90-160g. Ponadto proponujemy szereg dodatkowych uszlachetnień takich jak, suchy tłok (hot stamping), złocenie, perforacje, lakiery wybi&oacute;rcze, lakiery hybrydowe, brokat, inne.</p>', '', '', NULL, NULL, NULL, ''),
	(215, 127, 'pl_PL', 'Indywidualny sklep Internetowy', '<p>Tworząc sklep internetowy możemy Państwu zaproponować gotowe rozwiązania dostępne na rynku, bądź też stworzyć sklep na zam&oacute;wienie. Dostosowując go do indywidualnych potrzeb i wymagań klienta, możemy zapewnić nie tylko niepowtarzalność sklepu, ale także całkowite dostosowanie systemu do konkretnych wymog&oacute;w Klienta oraz specyfiki oferowanych przez Niego towar&oacute;w.</p>', '', '', NULL, NULL, NULL, ''),
	(217, 129, 'pl_PL', 'Testowy', '<p>asdasdda</p>', '<p>dsasdasd</p>', '', NULL, NULL, NULL, '');
/*!40000 ALTER TABLE `shop_products_description` ENABLE KEYS */;

-- Zrzucanie danych dla tabeli cms2.shop_products_files: 0 rows
DELETE FROM `shop_products_files`;
/*!40000 ALTER TABLE `shop_products_files` DISABLE KEYS */;
/*!40000 ALTER TABLE `shop_products_files` ENABLE KEYS */;

-- Zrzucanie danych dla tabeli cms2.shop_products_images: 18 rows
DELETE FROM `shop_products_images`;
/*!40000 ALTER TABLE `shop_products_images` DISABLE KEYS */;
INSERT INTO `shop_products_images` (`id_image`, `product_id`, `variant_id`, `filename`, `realfilename`, `mainimage`) VALUES
	(156, 117, NULL, '14026539161539accdcb29a8901828783.png', 'olicom_kampanie_reklamowe.png', 'Y'),
	(157, 118, NULL, '14026541621539acdd204c41294653040.png', 'olicom_pozycjonowanie.png', 'Y'),
	(163, 123, NULL, '14026568171539ad831de494100709316.png', 'olicom_domeny_pl.png', 'Y'),
	(161, 120, NULL, '14026562101539ad5d2d7595532561641.png', 'olicom_hosting_standard.png', 'Y'),
	(160, 121, NULL, '14026561801539ad5b4d65e3058910779.png', 'olicom_hosting_biznes.png', 'Y'),
	(162, 122, NULL, '14026563191539ad63fa3658789875286.png', 'olicom_hosting_pro.png', 'Y'),
	(164, 124, NULL, '14026569151539ad893bff00837044040.png', 'olicom_domeny_com_pl.png', 'Y'),
	(155, 116, NULL, '14026536051539acba54bba1214066516.png', 'olicom_aktualizacja_www.png', 'Y'),
	(154, 115, NULL, '14026533161539aca84965f7419342601.png', 'olicom_audyt_usability.png', 'Y'),
	(152, 113, NULL, '14026529391539ac90b65b1e777725609.png', 'olicom_facebook.png', 'Y'),
	(153, 114, NULL, '14026530961539ac9a8a710e012379454.png', 'olicom_mobilne.png', 'Y'),
	(151, 112, NULL, '14026509041539ac118c0f6f197725938.png', 'miodmalina-logo1401110692.png', 'Y'),
	(148, 109, NULL, '14026504061539abf26e6df1576054132.png', 'wp.png', 'Y'),
	(149, 110, NULL, '14026505211539abf99e8595521056744.png', 'at1375184492.png', 'Y'),
	(150, 111, NULL, '14026506751539ac033c9075199438488.png', 'urzadzenia.png', 'Y'),
	(166, 126, NULL, '14026572701539ad9f6b5dfc855583707.png', 'olicom_papier_firmowy.png', 'Y'),
	(165, 125, NULL, '14026569901539ad8de135a6543646817.png', 'olicom_domeny_inne.png', 'Y'),
	(167, 127, NULL, '14026574901539adad24d4bc400124829.png', 'olicom_sklep_internetowy.png', 'Y');
/*!40000 ALTER TABLE `shop_products_images` ENABLE KEYS */;

-- Zrzucanie danych dla tabeli cms2.shop_products_medias: 3 rows
DELETE FROM `shop_products_medias`;
/*!40000 ALTER TABLE `shop_products_medias` DISABLE KEYS */;
INSERT INTO `shop_products_medias` (`product_id`, `media_id`) VALUES
	(1, 14),
	(1, 12),
	(1, 10);
/*!40000 ALTER TABLE `shop_products_medias` ENABLE KEYS */;

-- Zrzucanie danych dla tabeli cms2.shop_products_parameters: 0 rows
DELETE FROM `shop_products_parameters`;
/*!40000 ALTER TABLE `shop_products_parameters` DISABLE KEYS */;
/*!40000 ALTER TABLE `shop_products_parameters` ENABLE KEYS */;

-- Zrzucanie danych dla tabeli cms2.shop_products_project_gallery: 0 rows
DELETE FROM `shop_products_project_gallery`;
/*!40000 ALTER TABLE `shop_products_project_gallery` DISABLE KEYS */;
/*!40000 ALTER TABLE `shop_products_project_gallery` ENABLE KEYS */;

-- Zrzucanie danych dla tabeli cms2.shop_products_statuses: 2 rows
DELETE FROM `shop_products_statuses`;
/*!40000 ALTER TABLE `shop_products_statuses` DISABLE KEYS */;
INSERT INTO `shop_products_statuses` (`id_product_status`, `allow_buy`, `active`) VALUES
	(1, 'Y', 'Y'),
	(2, 'N', 'Y');
/*!40000 ALTER TABLE `shop_products_statuses` ENABLE KEYS */;

-- Zrzucanie danych dla tabeli cms2.shop_products_statuses_description: 2 rows
DELETE FROM `shop_products_statuses_description`;
/*!40000 ALTER TABLE `shop_products_statuses_description` DISABLE KEYS */;
INSERT INTO `shop_products_statuses_description` (`product_status_id`, `product_status_name`, `product_status_language`) VALUES
	(1, 'Dostępny', 'pl_PL'),
	(2, 'Dostępny wkrótce', 'pl_PL');
/*!40000 ALTER TABLE `shop_products_statuses_description` ENABLE KEYS */;

-- Zrzucanie danych dla tabeli cms2.shop_products_tags: 0 rows
DELETE FROM `shop_products_tags`;
/*!40000 ALTER TABLE `shop_products_tags` DISABLE KEYS */;
/*!40000 ALTER TABLE `shop_products_tags` ENABLE KEYS */;

-- Zrzucanie danych dla tabeli cms2.shop_products_tags_dict: 0 rows
DELETE FROM `shop_products_tags_dict`;
/*!40000 ALTER TABLE `shop_products_tags_dict` DISABLE KEYS */;
/*!40000 ALTER TABLE `shop_products_tags_dict` ENABLE KEYS */;

-- Zrzucanie danych dla tabeli cms2.shop_products_to_categories: 19 rows
DELETE FROM `shop_products_to_categories`;
/*!40000 ALTER TABLE `shop_products_to_categories` DISABLE KEYS */;
INSERT INTO `shop_products_to_categories` (`product_id`, `category_id`) VALUES
	(117, 41),
	(113, 37),
	(112, 34),
	(115, 37),
	(114, 37),
	(121, 38),
	(122, 38),
	(116, 37),
	(120, 38),
	(111, 30),
	(123, 39),
	(118, 41),
	(110, 29),
	(109, 35),
	(124, 39),
	(125, 39),
	(126, 29),
	(127, 40),
	(129, 39);
/*!40000 ALTER TABLE `shop_products_to_categories` ENABLE KEYS */;

-- Zrzucanie danych dla tabeli cms2.shop_products_to_news: 0 rows
DELETE FROM `shop_products_to_news`;
/*!40000 ALTER TABLE `shop_products_to_news` DISABLE KEYS */;
/*!40000 ALTER TABLE `shop_products_to_news` ENABLE KEYS */;

-- Zrzucanie danych dla tabeli cms2.shop_products_variants: 0 rows
DELETE FROM `shop_products_variants`;
/*!40000 ALTER TABLE `shop_products_variants` DISABLE KEYS */;
/*!40000 ALTER TABLE `shop_products_variants` ENABLE KEYS */;

-- Zrzucanie danych dla tabeli cms2.shop_product_parameters: 0 rows
DELETE FROM `shop_product_parameters`;
/*!40000 ALTER TABLE `shop_product_parameters` DISABLE KEYS */;
/*!40000 ALTER TABLE `shop_product_parameters` ENABLE KEYS */;

-- Zrzucanie danych dla tabeli cms2.shop_product_to_variant: 9 rows
DELETE FROM `shop_product_to_variant`;
/*!40000 ALTER TABLE `shop_product_to_variant` DISABLE KEYS */;
INSERT INTO `shop_product_to_variant` (`product_id`, `variant_id`, `quantity`, `variant_values`) VALUES
	(102, 22, 5, 'a:1:{i:4;s:2:"26";}'),
	(102, 23, 7, 'a:1:{i:4;s:2:"25";}'),
	(103, 24, 5, 'a:1:{i:4;s:2:"26";}'),
	(103, 25, 7, 'a:1:{i:4;s:2:"25";}'),
	(128, 26, 5, 'a:2:{i:7;s:7:"wybierz";i:4;s:2:"25";}'),
	(128, 27, 4, 'a:1:{i:7;s:2:"40";}'),
	(128, 28, 7, 'a:2:{i:7;s:2:"38";i:4;s:2:"25";}'),
	(128, 29, 7, 'a:2:{i:7;s:2:"38";i:4;s:2:"25";}'),
	(125, 30, 1, 'a:2:{i:7;s:2:"39";i:4;s:2:"25";}');
/*!40000 ALTER TABLE `shop_product_to_variant` ENABLE KEYS */;

-- Zrzucanie danych dla tabeli cms2.shop_questions: 3 rows
DELETE FROM `shop_questions`;
/*!40000 ALTER TABLE `shop_questions` DISABLE KEYS */;
INSERT INTO `shop_questions` (`id_question`, `name`, `email`, `phone`, `product_info`, `product_id`, `date`, `message`, `responsed`) VALUES
	(1, 'aaa', 'hubert@olicom.pl', '5555555', 'test', 11, '2014-02-04', 'test', 'N'),
	(2, 'bgbg', 'hubert@olicom.pl', '5555555', 'asdf', 12, '2014-02-04', 'asdtest', 'Y'),
	(3, 'yyggf', 'hubert@olicom.pl', '5555555', 'hjgjfgfh', 12, '2014-02-04', 'mnmftghgf', 'Y');
/*!40000 ALTER TABLE `shop_questions` ENABLE KEYS */;

-- Zrzucanie danych dla tabeli cms2.shop_rebates_codes: 5 rows
DELETE FROM `shop_rebates_codes`;
/*!40000 ALTER TABLE `shop_rebates_codes` DISABLE KEYS */;
INSERT INTO `shop_rebates_codes` (`id_rebate_code`, `rebate_code`, `active`, `rebate`, `rebate_start`, `rebate_end`, `rebate_add`, `rebate_modify`) VALUES
	(1, 'fanbiały', 1, 50, '2014-07-01 00:00:00', '2014-07-31 00:00:00', '0000-00-00 00:00:00', '2014-07-22 11:53:34'),
	(2, 'test5', 1, 5, '2014-04-03 00:00:00', '2014-04-09 00:00:00', '2014-04-11 10:05:59', '2014-04-11 11:24:15'),
	(3, 'fanbiały', 0, 5, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2014-04-14 08:42:31', NULL),
	(4, 'fanbiały', 0, 5, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2014-04-14 08:46:58', NULL),
	(5, 'wiosna', 1, 20, '2014-05-10 00:00:00', '2014-06-19 00:00:00', '2014-06-12 07:53:31', '2014-06-12 07:53:52');
/*!40000 ALTER TABLE `shop_rebates_codes` ENABLE KEYS */;

-- Zrzucanie danych dla tabeli cms2.shop_rebates_codes_to_products: 30 rows
DELETE FROM `shop_rebates_codes_to_products`;
/*!40000 ALTER TABLE `shop_rebates_codes_to_products` DISABLE KEYS */;
INSERT INTO `shop_rebates_codes_to_products` (`product_id`, `rebate_code_id`) VALUES
	(102, 4),
	(103, 4),
	(96, 4),
	(105, 4),
	(106, 4),
	(124, 12),
	(125, 12),
	(115, 12),
	(116, 12),
	(108, 5),
	(107, 5),
	(104, 5),
	(98, 5),
	(97, 5),
	(100, 5),
	(99, 5),
	(101, 5),
	(106, 5),
	(105, 5),
	(96, 5),
	(103, 5),
	(102, 5),
	(124, 14),
	(125, 14),
	(115, 14),
	(116, 14),
	(124, 13),
	(125, 13),
	(115, 13),
	(116, 13);
/*!40000 ALTER TABLE `shop_rebates_codes_to_products` ENABLE KEYS */;

-- Zrzucanie danych dla tabeli cms2.shop_rebates_groups: 3 rows
DELETE FROM `shop_rebates_groups`;
/*!40000 ALTER TABLE `shop_rebates_groups` DISABLE KEYS */;
INSERT INTO `shop_rebates_groups` (`id_rebate_group`, `group_name`, `rebate`, `active`) VALUES
	(1, 'test', 5, 'Y'),
	(3, 'hgffg', 14, 'N'),
	(4, 'kjhg', 65, 'Y');
/*!40000 ALTER TABLE `shop_rebates_groups` ENABLE KEYS */;

-- Zrzucanie danych dla tabeli cms2.shop_related_products: 0 rows
DELETE FROM `shop_related_products`;
/*!40000 ALTER TABLE `shop_related_products` DISABLE KEYS */;
/*!40000 ALTER TABLE `shop_related_products` ENABLE KEYS */;

-- Zrzucanie danych dla tabeli cms2.shop_search: 0 rows
DELETE FROM `shop_search`;
/*!40000 ALTER TABLE `shop_search` DISABLE KEYS */;
/*!40000 ALTER TABLE `shop_search` ENABLE KEYS */;

-- Zrzucanie danych dla tabeli cms2.shop_subscriptions_logs: 0 rows
DELETE FROM `shop_subscriptions_logs`;
/*!40000 ALTER TABLE `shop_subscriptions_logs` DISABLE KEYS */;
/*!40000 ALTER TABLE `shop_subscriptions_logs` ENABLE KEYS */;

-- Zrzucanie danych dla tabeli cms2.shop_taxes: 2 rows
DELETE FROM `shop_taxes`;
/*!40000 ALTER TABLE `shop_taxes` DISABLE KEYS */;
INSERT INTO `shop_taxes` (`id_tax`, `tax_name`, `tax_value`) VALUES
	(8, 'Stawka II', 23),
	(7, 'Stawka I', 8);
/*!40000 ALTER TABLE `shop_taxes` ENABLE KEYS */;

-- Zrzucanie danych dla tabeli cms2.slider_elements: 10 rows
DELETE FROM `slider_elements`;
/*!40000 ALTER TABLE `slider_elements` DISABLE KEYS */;
INSERT INTO `slider_elements` (`id_slider_element`, `slider_type_id`, `slider_element_id`, `slider_element_position`, `available`) VALUES
	(37, 3, 30, 8, 0),
	(36, 3, 29, 9, 0),
	(38, 3, 31, 1, 1),
	(39, 3, 32, 4, 0),
	(40, 3, 33, 2, 0),
	(41, 3, 34, 6, 0),
	(46, 2, 5, 10, NULL),
	(43, 2, 2, 5, NULL),
	(44, 2, 3, 3, NULL),
	(45, 2, 4, 7, NULL);
/*!40000 ALTER TABLE `slider_elements` ENABLE KEYS */;

-- Zrzucanie danych dla tabeli cms2.slider_images: 6 rows
DELETE FROM `slider_images`;
/*!40000 ALTER TABLE `slider_images` DISABLE KEYS */;
INSERT INTO `slider_images` (`id_slider_image`, `title`, `filename`, `alt`, `link`, `lang`, `slider_element_id`) VALUES
	(29, '1', '14290129161552d01b47f158801427877.jpg', '1', NULL, 'pl_PL', 0),
	(30, '2', '14290129401552d01ccb788c079636519.jpg', '2', NULL, 'pl_PL', 0),
	(31, '3', '14290129771552d01f1164f1373659088.jpg', '3', NULL, 'pl_PL', 0),
	(32, '4', '14290130001552d02085ff2f614989981.jpg', '4', NULL, 'pl_PL', 0),
	(33, '5', '14290130151552d021798ab4890257207.jpg', '5', NULL, 'pl_PL', 0),
	(34, '6', '14290882121552e27d4bf743719073155.jpg', '6', '', 'pl_PL', 0);
/*!40000 ALTER TABLE `slider_images` ENABLE KEYS */;

-- Zrzucanie danych dla tabeli cms2.slider_news: 4 rows
DELETE FROM `slider_news`;
/*!40000 ALTER TABLE `slider_news` DISABLE KEYS */;
INSERT INTO `slider_news` (`slider_news_id`, `title`, `description`, `short_description`, `filename`, `alt`, `link`, `slider_element_id`, `lang`) VALUES
	(2, '1 123123123 123123 12 12e3 12', NULL, '11 23edf sdf sadfasdf asdf sdfsfas dfsdf', '14290832071552e1447a1f06577383931.jpg', '1', '', 0, 'pl_PL'),
	(3, '3', 'Zdjecie nr 2 w sliderze', '3', '14290832671552e1483a82b9580884984.jpg', '3', NULL, 0, 'pl_PL'),
	(4, 'Aliquam elementum aenean dignissim mattis ac adipiscing.', 'Aliquam elementum aenean dignissim mattis ac adipiscing.Aliquam elementum aenean dignissim mattis ac adipiscing.', 'Aliquam elementum aenean dignissim mattis ac adipiscing.', '14290856551552e1dd7eb9c5542192610.jpg', '2', NULL, 0, 'pl_PL'),
	(5, '1', '111', '111', '14290905431552e30efa3280053181318.jpg', '11', NULL, 0, 'pl_PL');
/*!40000 ALTER TABLE `slider_news` ENABLE KEYS */;

-- Zrzucanie danych dla tabeli cms2.tags: 0 rows
DELETE FROM `tags`;
/*!40000 ALTER TABLE `tags` DISABLE KEYS */;
/*!40000 ALTER TABLE `tags` ENABLE KEYS */;

-- Zrzucanie danych dla tabeli cms2.tags_dictionary: 0 rows
DELETE FROM `tags_dictionary`;
/*!40000 ALTER TABLE `tags_dictionary` DISABLE KEYS */;
/*!40000 ALTER TABLE `tags_dictionary` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
