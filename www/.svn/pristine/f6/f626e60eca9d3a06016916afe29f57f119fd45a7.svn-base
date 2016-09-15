-- Adminer 4.1.0 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `acl_permissions`;
CREATE TABLE `acl_permissions` (
  `id_permission` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `resource` varchar(255) NOT NULL,
  `privilege` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_permission`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `acl_permissions` (`id_permission`, `name`, `resource`, `privilege`, `description`) VALUES
(2,	'users_add',	'users',	'add',	'Dodawanie użytkowników'),
(3,	'users_edit',	'users',	'edit',	'Edycja użytkowników'),
(4,	'users_delete',	'users',	'delete',	'Usuwanie użytkowników'),
(5,	'roles_index',	'roles',	'index',	'Lista ról'),
(6,	'roles_add',	'roles',	'add',	'Dodawanie ról'),
(7,	'roles_edit',	'roles',	'edit',	'Edycja ról'),
(8,	'roles_delete',	'roles',	'delete',	'Usuwanie ról'),
(9,	'permissions_index',	'permissions',	'index',	'Lista uprawnień'),
(10,	'permissions_add',	'permissions',	'add',	'Dodawanie uprawnień'),
(11,	'permissions_edit',	'permissions',	'edit',	'Edycja uprawnień'),
(12,	'permissions_delete',	'permissions',	'delete',	'Usuwanie uprawnień'),
(13,	'permissions_manage',	'permissions',	'manage',	'Zarządzanie uprawnieniami'),
(14,	'newsletters_index',	'newsletters',	'index',	'Lista newsletterów'),
(15,	'newsletters_add',	'newsletters',	'add',	'Dodawanie newsletterów'),
(16,	'newsletters_edit',	'newsletters',	'edit',	'Edycja newsletterów'),
(17,	'newsletters_delete',	'newsletters',	'delete',	'Usuwanie newsletterów'),
(18,	'newsletters_send',	'newsletters',	'send',	'Wysyłanie newsletterów'),
(19,	'newsletters_group_add',	'newsletters',	'group_add',	'Dodawanie grup newsletterów'),
(20,	'newsletters_group_edit',	'newsletters',	'group_edit',	'Edycja grup newsletterów'),
(21,	'newsletters_group_delete',	'newsletters',	'group_delete',	'Usuwanie grup newsletterów'),
(22,	'newsletters_email_add',	'newsletters',	'email_add',	'Dodawanie emaili do newsletterów'),
(23,	'newsletters_email_edit',	'newsletters',	'email_edit',	'Edycja emaili do newsletterów'),
(24,	'newsletters_email_delete',	'newsletters',	'email_delete',	'Usuwanie emaili do newsletterów'),
(25,	'news_index',	'news',	'index',	'Lista aktualności'),
(26,	'news_add',	'news',	'add',	'Dodawanie aktualności'),
(27,	'news_edit',	'news',	'edit',	'Edycja aktualności'),
(28,	'news_delete',	'news',	'delete',	'Usuwanie aktualności'),
(29,	'pages_index',	'pages',	'index',	'Lista stron'),
(30,	'pages_add',	'pages',	'add',	'Dodawanie stron'),
(31,	'pages_edit',	'pages',	'edit',	'Edycja stron'),
(32,	'pages_delete',	'pages',	'delete',	'Usuwanie stron'),
(41,	'galleries_index',	'galleries',	'index',	'Lista galerii'),
(42,	'galleries_add',	'galleries',	'add',	'Dodawanie galerii'),
(43,	'galleries_edit',	'galleries',	'edit',	'Edycja galerii'),
(44,	'galleries_delete',	'galleries',	'delete',	'Usuwanie galerii'),
(45,	'galleries_delete_photo',	'galleries',	'delete_photo',	'Usuwanie zdjęć z galerii'),
(46,	'galleries_add_photo',	'galleries',	'add_photo',	'Dodawanie zdjęc do galerii'),
(50,	'newsletters_groups_index',	'newsletters',	'groups_index',	'Lista grup newsletterów'),
(51,	'newsletters_emails_index',	'newsletters',	'emails_index',	'Lista emaili newsletterów'),
(52,	'elements_index',	'elements',	'index',	'Lista elementów'),
(53,	'elements_add',	'elements',	'add',	'Dodawanie elementów'),
(54,	'elements_edit',	'elements',	'edit',	'Edycja elementów'),
(55,	'elements_delete',	'elements',	'delete',	'Usuwanie elementów'),
(56,	'page_content_index',	'page_content',	'index',	'Lista treści na stronach'),
(57,	'page_content_add',	'page_content',	'add',	'Dodawanie treści na stronach'),
(58,	'page_content_edit',	'page_content',	'edit',	'Edycja treści na stronach'),
(59,	'page_content_delete',	'page_content',	'delete',	'Usuwanie treści stron'),
(60,	'pages_edit_content',	'pages',	'edit_content',	'Edycja zawartości strony'),
(61,	'medias_index',	'medias',	'index',	'Lista mediów'),
(62,	'medias_add',	'medias',	'add',	'Dodawanie mediów'),
(63,	'medias_delete',	'medias',	'delete',	'Usuwanie mediów'),
(64,	'configurations_index',	'configurations',	'index',	'Ustawienia aplikacji'),
(65,	'polls_index',	'polls',	'index',	'Lista sond'),
(66,	'polls_add',	'polls',	'add',	'Dodawanie sond'),
(67,	'polls_edit',	'polls',	'edit',	'Edycja sond'),
(68,	'polls_delete',	'polls',	'delete',	'Usuwanie sond'),
(93,	'news_categories_index',	'news_categories',	'index',	'Lista kategorii aktualności'),
(94,	'news_categories_add',	'news_categories',	'add',	'Dodawanie kategorii aktualności'),
(95,	'news_categories_edit',	'news_categories',	'edit',	'Edycja kategorii aktualności'),
(96,	'polls_categories_add',	'polls_categories',	'add',	'Dodawanie kategorii sond'),
(97,	'polls_categories_edit',	'polls_categories',	'edit',	'Edycja kategorii sond'),
(98,	'polls_categories_index',	'polls_categories',	'index',	'Lista kategorii sond'),
(103,	'news_categories_delete',	'news_categories',	'delete',	'Usuwanie kategorii aktualności'),
(108,	'polls_categories_delete',	'polls_categories',	'delete',	'Usuwanie kategorii sond'),
(109,	'contact_forms_index',	'contact_forms',	'index',	'Lista formularzy kontaktowych'),
(110,	'contact_forms_add',	'contact_forms',	'add',	'Dodawanie formularzy kontaktowych'),
(111,	'contact_forms_edit',	'contact_forms',	'edit',	'Edycja formularzy kontaktowych'),
(112,	'contact_forms_delete',	'contact_forms',	'delete',	'Usuwanie formularzy kontaktowych'),
(113,	'boxes_index',	'boxes',	'index',	'Lista boksów'),
(114,	'boxes_add',	'boxes',	'add',	'Dodawanie boksów'),
(115,	'boxes_edit',	'boxes',	'edit',	'Edycja boksów'),
(116,	'boxes_delete',	'boxes',	'delete',	'Usuwanie boksów'),
(117,	'galleries_element_position',	'galleries',	'element_position',	'Zmiana kolejności obrazów w galerii'),
(118,	'slider_index',	'slider',	'index',	'Lista elementów slidera'),
(119,	'slider_add',	'slider',	'add',	'Dodawanie elementów slidera'),
(120,	'slider_edit',	'slider',	'edit',	'Edycja elementów slidera'),
(121,	'slider_delete',	'slider',	'delete',	'Usuwanie elementów slidera'),
(122,	'slider_element_position',	'slider',	'element_position',	'Zmiana kolejności elementów slidera'),
(124,	'galleries_update_image',	'galleries',	'update_image',	'Zmiana opisu (alt) zdjęcia'),
(33,	'products_categories_index',	'products_categories',	'index',	'Lista kategorii produktów'),
(34,	'products_categories_add',	'products_categories',	'add',	'Dodawanie kategorii produktów'),
(35,	'products_categories_edit',	'products_categories',	'edit',	'Edycja kategorii produktów'),
(36,	'products_categories_delete',	'products_categories',	'delete',	'Usuwanie kategorii produktów'),
(37,	'products_index',	'products',	'index',	'Lista produktów'),
(38,	'products_add',	'products',	'add',	'Dodawanie produktów'),
(39,	'products_edit',	'products',	'edit',	'Edycja produktów'),
(40,	'products_delete',	'products',	'delete',	'Usuwanie produktów'),
(47,	'reports_index',	'reports',	'index',	'Lista raportów'),
(48,	'reports_view',	'reports',	'view',	'Podgląd raportu'),
(49,	'reports_delete',	'reports',	'delete',	'Usuwanie raportów'),
(69,	'orders_index',	'orders',	'index',	'Lista zamówień'),
(70,	'orders_edit',	'orders',	'edit',	'Edycja zamówienia'),
(71,	'orders_view',	'orders',	'view',	'Podgląd zamówienia'),
(72,	'orders_delete',	'orders',	'delete',	'Usuwanie zamówień'),
(73,	'attributes_index',	'attributes',	'index',	'Lista atrybutów'),
(74,	'attributes_add',	'attributes',	'add',	'Dodawanie atrybutów'),
(75,	'attributes_edit',	'attributes',	'edit',	'Edycja atrybutów'),
(76,	'attributes_delete',	'attributes',	'delete',	'Usuwanie atrybutów'),
(77,	'parameters_index',	'parameters',	'index',	'Lista parametrów'),
(78,	'parameters_add',	'parameters',	'add',	'Dodawanie parametrów'),
(79,	'parameters_edit',	'parameters',	'edit',	'Edycja parametrów'),
(80,	'parameters_delete',	'parameters',	'delete',	'Usuwanie parametrów'),
(81,	'producers_index',	'producers',	'index',	'Lista producentów'),
(82,	'producers_add',	'producers',	'add',	'Dodawanie producentów'),
(83,	'producers_edit',	'producers',	'edit',	'Edycja producentów'),
(84,	'producers_delete',	'producers',	'delete',	'Usuwanie producentów'),
(85,	'rebates_groups_index',	'rebates_groups',	'index',	'Lista grup rabatowych'),
(86,	'rebates_groups_add',	'rebates_groups',	'add',	'Dodawanie grup rabatowych'),
(87,	'rebates_groups_edit',	'rebates_groups',	'edit',	'Edycja grup rabatowych'),
(88,	'rebates_groups_delete',	'rebates_groups',	'delete',	'Usuwanie grup rabatowych'),
(89,	'products_statuses_index',	'products_statuses',	'index',	'Lista statusów produktów'),
(90,	'products_statuses_add',	'products_statuses',	'add',	'Dodawanie statusów produktów'),
(91,	'products_statuses_edit',	'products_statuses',	'edit',	'Edycja statusów produktów'),
(92,	'products_statuses_delete',	'products_statuses',	'delete',	'usuwanie statusów produktów'),
(99,	'attributes_values_index',	'attributes_values',	'indes',	'Lista wartości atrybutu'),
(100,	'attributes_values_add',	'attributes_values',	'add',	'Dodawanie wartości atrybutu'),
(101,	'attributes_values_edit',	'attributes_values',	'edit',	'Edycja wartości atrybutu'),
(102,	'attributes_values_delete',	'attributes_values',	'delete',	'Usuwanie wartości atrybutu'),
(104,	'taxes_index',	'taxes',	'index',	'Lista wartości VAT'),
(105,	'taxes_add',	'taxes',	'add',	'Dodawanie wartości VAT'),
(106,	'taxes_edit',	'taxes',	'edit',	'Edytowanie wartości VAT'),
(107,	'taxes_delete',	'taxes',	'delete',	'Usuwanie wartości VAT'),
(125,	'customers_index',	'customers',	'index',	'Lista klientów'),
(126,	'customers_add',	'customers',	'add',	'Dodawanie klientów'),
(127,	'customers_edit',	'customers',	'edit',	'Edycja klientów'),
(128,	'customers_delete',	'customers',	'delete',	'Usuwanie klientów'),
(129,	'delivery_types_index',	'delivery_types',	'index',	'Lista rodzajów dostaw'),
(130,	'delivery_types_add',	'delivery_types',	'add',	'Dodawanie rodzaju dostawy'),
(131,	'delivery_types_edit',	'delivery_types',	'edit',	'Edycja rodzaju dostawy'),
(132,	'delivery_types_delete',	'delivery_types',	'delete',	'Usuwanie rodzaju dostawy'),
(133,	'payment_types_index',	'payment_types',	'index',	'Lista rodzajów płatności'),
(134,	'payment_types_add',	'payment_types',	'add',	'Dodawanie rodzajów płatności'),
(135,	'payment_types_edit',	'payment_types',	'edit',	'Edycja rodzajów płatności'),
(136,	'payment_types_delete',	'payment_types',	'delete',	'Usuwanie rodzajów płatności'),
(137,	'orders_add',	'orders',	'add',	'Dodawanie zamówień'),
(138,	'questions_index',	'questions',	'index',	'Lista zapytań od klientów'),
(139,	'questions_preview',	'questions',	'preview',	'Podgląd szczegółów zapytań od klientów'),
(140,	'questions_delete',	'questions',	'delete',	'Usuwanie zapytań od klientów'),
(141,	'banners_delete',	'banners',	'delete',	'Usuwanie bannerów'),
(142,	'banners_edit',	'banners',	'edit',	'Edycja bannerów'),
(143,	'banners_add',	'banners',	'add',	'Dodawanie bannerów'),
(144,	'banners_index',	'banners',	'index',	'Lista bannerów'),
(145,	'shop_index',	'shop',	'index',	'Sklep'),
(146,	'pages_settings_edit',	'pages',	'settings_edit',	'Edycja ustawień strony'),
(147,	'currencies_index',	'currencies',	'index',	'Waluty'),
(148,	'currencies_add',	'currencies',	'add',	'Edycja waluty'),
(149,	'currencies_edit',	'currencies',	'edit',	'Edycja waluty'),
(150,	'currencies_delete',	'currencies',	'delete',	'Usuwanie waluty'),
(151,	'partners_index',	'partners',	'index',	'Lista partnerów'),
(152,	'partners_add',	'partners',	'add',	'Dodawanie partnerów'),
(153,	'partners_edit',	'partners',	'edit',	'Edycja partnera'),
(154,	'partners_delete',	'partners',	'delete',	'Usuwanie partnera'),
(155,	'rebates_codes_index',	'rebates_codes',	'index',	'Lista kodów rabatowych'),
(156,	'rebates_codes_add',	'rebates_codes',	'add',	'Dodawanie kodów rabatowych'),
(157,	'rebates_codes_edit',	'rebates_codes',	'edit',	'Edycja kodów rabatowych'),
(158,	'rebates_codes_delete',	'rebates_codes',	'delete',	'Usuwanie kodów rabatowych'),
(159,	'slider_elements_news_all',	'slider_elements',	'news_all',	'Aktualność na sliderze (pełny dostęp)'),
(160,	'slider_elements_news_for_slider_all',	'slider_elements',	'news_for_slider_all',	'Aktualność dla slidera (pełny dostęp)'),
(161,	'slider_elements_image_all',	'slider_elements',	'image_all',	'Zdjęcie na slider'),
(162,	'variants',	'variants',	'all',	'Warianty produktów (pełne uprawnienia)'),
(163,	'backup_index',	'backup',	'index',	'Lista backupów'),
(164,	'backup_restore',	'backup',	'restore',	'Przywracanie backupu'),
(165,	'backup_add_backup',	'backup',	'add_backup',	'Tworzenie backupu'),
(166,	'backup_delete',	'backup',	'delete',	'Usuwanie backupu'),
(167,	'backup_index',	'backup',	'index',	'Lista backupów'),
(168,	'backup_restore',	'backup',	'restore',	'Przywracanie backupu'),
(169,	'backup_add_backup',	'backup',	'add_backup',	'Tworzenie backupu'),
(170,	'backup_delete',	'backup',	'delete',	'Usuwanie backupu');

DROP TABLE IF EXISTS `acl_roles`;
CREATE TABLE `acl_roles` (
  `id_role` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `parent_role_id` int(10) unsigned DEFAULT NULL,
  `date_added` bigint(20) unsigned NOT NULL,
  `status` enum('Y','N') DEFAULT 'Y',
  `acl` text NOT NULL,
  PRIMARY KEY (`id_role`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `acl_roles` (`id_role`, `name`, `description`, `parent_role_id`, `date_added`, `status`, `acl`) VALUES
(13,	'administrator',	'',	13,	1270017733,	'Y',	'\'O:8:\\\"Zend_Acl\\\":6:{s:16:\\\"\\0*\\0_roleRegistry\\\";O:22:\\\"Zend_Acl_Role_Registry\\\":1:{s:9:\\\"\\0*\\0_roles\\\";a:1:{s:13:\\\"administrator\\\";a:3:{s:8:\\\"instance\\\";O:13:\\\"Zend_Acl_Role\\\":1:{s:10:\\\"\\0*\\0_roleId\\\";s:13:\\\"administrator\\\";}s:7:\\\"parents\\\";a:0:{}s:8:\\\"children\\\";a:0:{}}}}s:13:\\\"\\0*\\0_resources\\\";a:0:{}s:17:\\\"\\0*\\0_isAllowedRole\\\";N;s:21:\\\"\\0*\\0_isAllowedResource\\\";N;s:22:\\\"\\0*\\0_isAllowedPrivilege\\\";N;s:9:\\\"\\0*\\0_rules\\\";a:2:{s:12:\\\"allResources\\\";a:2:{s:8:\\\"allRoles\\\";a:2:{s:13:\\\"allPrivileges\\\";a:2:{s:4:\\\"type\\\";s:9:\\\"TYPE_DENY\\\";s:6:\\\"assert\\\";N;}s:13:\\\"byPrivilegeId\\\";a:0:{}}s:8:\\\"byRoleId\\\";a:1:{s:13:\\\"administrator\\\";a:2:{s:13:\\\"byPrivilegeId\\\";a:0:{}s:13:\\\"allPrivileges\\\";a:2:{s:4:\\\"type\\\";s:10:\\\"TYPE_ALLOW\\\";s:6:\\\"assert\\\";N;}}}}s:12:\\\"byResourceId\\\";a:0:{}}}\''),
(39,	'demo',	'',	13,	1358253023,	'Y',	'');

DROP TABLE IF EXISTS `acl_roles_permissions`;
CREATE TABLE `acl_roles_permissions` (
  `role_id` int(10) unsigned NOT NULL,
  `permission_id` int(10) unsigned NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `acl_roles_permissions` (`role_id`, `permission_id`) VALUES
(13,	1),
(13,	107),
(13,	106),
(13,	105),
(13,	104),
(13,	49),
(13,	48),
(13,	47),
(13,	88),
(13,	87),
(13,	86),
(13,	85),
(13,	92),
(13,	91),
(13,	90),
(13,	89),
(13,	36),
(13,	35),
(13,	34),
(13,	33),
(13,	40),
(13,	39),
(13,	38),
(13,	37),
(13,	84),
(13,	83),
(13,	82),
(13,	81),
(13,	3),
(13,	2),
(13,	8),
(13,	7),
(13,	6),
(13,	5),
(13,	108),
(13,	98),
(13,	97),
(13,	96),
(13,	68),
(13,	67),
(13,	120),
(13,	119),
(13,	118),
(13,	117),
(13,	80),
(13,	79),
(13,	78),
(13,	77),
(13,	122),
(13,	0),
(13,	66),
(13,	65),
(13,	13),
(13,	12),
(13,	11),
(13,	10),
(13,	9),
(13,	56),
(13,	72),
(13,	71),
(13,	70),
(13,	69),
(13,	60),
(13,	32),
(13,	31),
(13,	30),
(13,	29),
(13,	95),
(13,	94),
(13,	93),
(13,	51),
(13,	50),
(13,	24),
(13,	23),
(13,	22),
(13,	21),
(13,	20),
(13,	19),
(13,	18),
(13,	17),
(13,	16),
(13,	15),
(13,	14),
(13,	28),
(13,	27),
(13,	26),
(13,	25),
(13,	63),
(13,	62),
(13,	61),
(13,	46),
(13,	45),
(13,	0),
(13,	44),
(13,	43),
(13,	42),
(13,	116),
(13,	115),
(13,	114),
(13,	113),
(13,	41),
(13,	55),
(13,	54),
(13,	53),
(13,	52),
(13,	102),
(13,	101),
(13,	100),
(13,	99),
(13,	76),
(13,	75),
(13,	74),
(13,	73),
(13,	112),
(13,	123),
(13,	124),
(39,	118),
(39,	31),
(39,	122),
(39,	121),
(39,	120),
(39,	56),
(39,	29),
(39,	119),
(39,	58),
(39,	60),
(39,	124),
(13,	111),
(13,	110),
(13,	109),
(13,	64),
(39,	41),
(39,	117),
(39,	46),
(39,	45),
(13,	4),
(13,	57),
(13,	58),
(13,	59),
(39,	161),
(39,	28),
(39,	26),
(39,	44),
(39,	55),
(39,	54),
(39,	53),
(39,	52),
(39,	111),
(39,	64),
(39,	116),
(39,	115),
(39,	114),
(39,	113),
(39,	88),
(39,	87),
(39,	86),
(39,	85),
(39,	83),
(39,	81),
(39,	135),
(39,	133),
(39,	95),
(39,	93),
(39,	27),
(39,	25),
(39,	109),
(39,	99),
(39,	100),
(39,	101),
(39,	102),
(39,	125),
(39,	126),
(39,	127),
(39,	128),
(39,	129),
(39,	43),
(39,	131),
(39,	42),
(39,	37),
(39,	38),
(39,	39),
(39,	40),
(39,	33),
(39,	34),
(39,	35),
(39,	36),
(39,	89),
(39,	90),
(39,	91),
(39,	92),
(39,	145),
(39,	69),
(39,	70),
(39,	71),
(39,	72),
(39,	137);

DROP TABLE IF EXISTS `acl_users`;
CREATE TABLE `acl_users` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `first_name` varchar(100) DEFAULT '',
  `last_name` varchar(100) DEFAULT NULL,
  `username` varchar(64) DEFAULT '',
  `password` varchar(64) NOT NULL,
  `date_added` char(20) NOT NULL,
  `last_login_date` char(20) NOT NULL,
  `logged_times` int(10) unsigned NOT NULL,
  `acl` text,
  `role_id` int(11) NOT NULL,
  `status` enum('Y','N') DEFAULT 'N',
  `verify_string` varchar(255) DEFAULT NULL,
  `verified` tinyint(4) DEFAULT NULL,
  `image_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `acl_users` (`id_user`, `email`, `first_name`, `last_name`, `username`, `password`, `date_added`, `last_login_date`, `logged_times`, `acl`, `role_id`, `status`, `verify_string`, `verified`, `image_id`) VALUES
(16,	'olicom@olicom.pl',	'Admin',	'Olicom',	'',	'*F2651DAB851BC94D1C6E3F08C9C68E89C0AF4484',	'1270034596',	'1451551864',	183,	NULL,	13,	'Y',	NULL,	NULL,	6),
(19,	'demo@demo.pl',	'Admin',	'Demo',	'',	'*AB505E4F9AC59C3C8B6D4B859D1818F53DD82E6C',	'1358253160',	'1406031624',	17,	NULL,	39,	'Y',	NULL,	NULL,	NULL),
(27,	'hubert@olicom.pl',	'test',	'test',	'',	'*32A0D6E18BB87F5C807AAC3CF34D9DBF0DE35277',	'1387104785',	'',	0,	NULL,	13,	'Y',	'35b80e17d736cfc1f9ce95252833e046',	NULL,	5),
(28,	'dedra@dedra.info',	'dedra',	'dedra',	'',	'*0B8FBE81AAC86DB0F1037709C42E75660D4728CA',	'1388742169',	'1388742229',	2,	NULL,	41,	'Y',	NULL,	NULL,	NULL);

DROP TABLE IF EXISTS `acl_users_images`;
CREATE TABLE `acl_users_images` (
  `id_image` int(11) NOT NULL AUTO_INCREMENT,
  `filename` varchar(255) NOT NULL,
  `realfilename` varchar(255) NOT NULL,
  `mainimage` tinyint(1) unsigned NOT NULL,
  `alt` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_image`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `acl_users_images` (`id_image`, `filename`, `realfilename`, `mainimage`, `alt`) VALUES
(5,	'1387104785152ad8a1192ada415543402.jpg',	'good_job.jpg',	0,	''),
(6,	'1387107810152ad95e2c5333398476443.png',	'olicom-logo-140.png',	0,	'');

DROP TABLE IF EXISTS `backups`;
CREATE TABLE `backups` (
  `backup_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `description` varchar(250) NOT NULL,
  `state` tinyint(1) NOT NULL,
  `backup_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `file` varchar(50) DEFAULT NULL,
  `dirs` varchar(500) DEFAULT NULL,
  `db` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`backup_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `backups` (`backup_id`, `name`, `description`, `state`, `backup_date`, `file`, `dirs`, `db`) VALUES
(3,	'test',	'sthdfghdfg',	1,	'2015-04-20 07:42:13',	'backups/backup_20150417165141.zip',	'application;modules;css;js',	NULL),
(7,	'test555',	'sdhdrghdfghdfh',	0,	'2015-04-20 07:30:58',	'backups/backup_20150420093045.zip',	'application;modules;css;js',	NULL),
(8,	'Auto Restore Backup',	'Backup wykonany automatycznie przy przywracaniu innego backupu.',	0,	'2015-04-20 07:33:53',	'backups/backup_20150420093348.zip',	'application;modules;css;js',	NULL),
(9,	'Auto Restore Backup',	'Backup wykonany automatycznie przy przywracaniu innego backupu.',	0,	'2015-04-20 07:39:46',	'backups/backup_20150420093940.zip',	'application;modules;css;js',	NULL),
(15,	'tesjhfjg',	'drjhfdjg',	0,	'2015-11-23 10:37:54',	'backups/backup_20151123113754.zip',	'css',	NULL),
(16,	'dfghdfgh',	'dfghdfgh',	0,	'2015-11-23 10:43:40',	'backups/backup_20151123114337.zip',	'css',	'backups/backup_20151123114338.sql'),
(14,	'gdfgsd',	'fvbsdvbxcvb',	0,	'2015-04-28 06:44:12',	'backups/backup_20150428084411.zip',	'css',	'backups/backup_20150428084412.sql');

DROP TABLE IF EXISTS `boxes`;
CREATE TABLE `boxes` (
  `id_boxes` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) COLLATE utf8_polish_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_polish_ci NOT NULL DEFAULT '',
  `contents` text COLLATE utf8_polish_ci NOT NULL,
  `link` varchar(255) COLLATE utf8_polish_ci NOT NULL DEFAULT '',
  `active` tinyint(4) NOT NULL DEFAULT '1',
  `position` int(11) DEFAULT NULL,
  `lang` char(5) COLLATE utf8_polish_ci DEFAULT NULL,
  `filename` text COLLATE utf8_polish_ci,
  `boxes_set_id` int(10) DEFAULT NULL,
  PRIMARY KEY (`id_boxes`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

INSERT INTO `boxes` (`id_boxes`, `name`, `title`, `contents`, `link`, `active`, `position`, `lang`, `filename`, `boxes_set_id`) VALUES
(18,	'kontaktde',	'Kontakt',	'',	'de/kontakt',	1,	NULL,	'de_DE',	'1451560495156850e2fad0ff664501031.jpg',	3),
(13,	'cennik',	'Cennik',	'',	'cennik',	1,	NULL,	'pl_PL',	'14512960851568105559efe8354021627.jpg',	1),
(14,	'rezerwacje',	'Rezerwacje',	'',	'rezerwacje',	1,	NULL,	'pl_PL',	'14512961331568105856e96e614010700.jpg',	1),
(15,	'kontakt',	'Kontakt',	'',	'kontakt',	1,	NULL,	'pl_PL',	'1451296152156810598d5665087650290.jpg',	1),
(16,	'preise',	'Preise',	'',	'de/preise',	1,	NULL,	'de_DE',	'14515593981568509e6ea047072272914.jpg',	3),
(17,	'reservierung',	'Reservierung',	'',	'de/reservierung',	1,	NULL,	'de_DE',	'1451559496156850a4842acd397071415.jpg',	3),
(19,	'price_list',	'Price list',	'',	'en/price-list',	1,	NULL,	'en_US',	'1451560550156850e6694703983991033.jpg',	2),
(20,	'reservation',	'Reservation',	'',	'en/reservation',	1,	NULL,	'en_US',	'1451560641156850ec1c1e6a263704892.jpg',	2),
(21,	'contact',	'Contact',	'',	'en/contact',	1,	NULL,	'en_US',	'1451560614156850ea687a8d976148614.jpg',	2);

DROP TABLE IF EXISTS `boxes_set`;
CREATE TABLE `boxes_set` (
  `id_boxes_set` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT 'pl_PL',
  `description` text,
  `element_id` int(11) NOT NULL,
  `show_title` enum('N','Y') NOT NULL DEFAULT 'Y',
  PRIMARY KEY (`id_boxes_set`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `boxes_set` (`id_boxes_set`, `name`, `description`, `element_id`, `show_title`) VALUES
(1,	'Boxy główna',	'',	95,	'Y'),
(2,	'Main Boxes',	'',	123,	'Y'),
(3,	'DE Boxes',	'',	124,	'Y');

DROP TABLE IF EXISTS `configuration`;
CREATE TABLE `configuration` (
  `id_configuration` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(255) NOT NULL DEFAULT '',
  `value` text NOT NULL,
  `name` varchar(255) NOT NULL,
  `desc` varchar(255) NOT NULL DEFAULT '',
  `group` varchar(255) NOT NULL DEFAULT '',
  `type` varchar(64) NOT NULL DEFAULT 'text',
  PRIMARY KEY (`id_configuration`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `configuration` (`id_configuration`, `key`, `value`, `name`, `desc`, `group`, `type`) VALUES
(1,	'administrator_email',	'noreplycms@olicom.pl',	'Email',	'Adres z którego wysyłane są emaile z systemu',	'',	'text'),
(2,	'administrator_name',	'Admin',	'Nazwa',	'Pole \"Od\" w wysyłanych e-mailach z systemu',	'',	'text'),
(3,	'sending_email',	'noreplycms@olicom.pl',	'Newsletter email',	'Adres z którego wysyłane są emaile newslettera',	'',	'text'),
(4,	'sending_name',	'Newsletter',	'Newsletter nazwa',	'Pole \"Od\" w wysyłanych e-mailach newslettera',	'',	'text'),
(5,	'google_tracking_code',	'',	'Google Analytics',	'Kod do statystyk (UA-xxxxxxxxx-xx)',	'',	'text'),
(6,	'page_name',	'Olishop',	'Nazwa strony',	'Używana w mailach',	'',	'text'),
(7,	'page_domain',	'olishop.olicom.com.pl',	'Domena',	'Domena używama m.in. w mailach',	'',	'text'),
(8,	'firm_address',	'<p><strong>nazwa firmy</strong><br /> ul. Ulica 22<br /> 11-222 Poznań<br /><br /> mobile:<br /> +48 555 444 222<br /> +48 33 444 55 66<br /> email: <a href=\"mailto:demo@olicom.pl\">demo@olicom.pl</a></p>',	'Adres firmy',	'Używany w mailach.',	'',	'textarea'),
(12,	'facebook_page_link',	'',	'Link do strony na Facebook',	'Po wprowadzeniu pojawi się Like Box',	'',	'text'),
(11,	'logo',	'files/users/small/logo.jpg',	'logo',	'',	'',	'image');

DROP TABLE IF EXISTS `contact_forms`;
CREATE TABLE `contact_forms` (
  `id_contact_form` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `element_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `language` char(5) NOT NULL DEFAULT 'pl_PL',
  `sender_email` varchar(255) DEFAULT NULL,
  `receiver_email` varchar(255) DEFAULT NULL,
  `has_captcha` enum('N','Y') NOT NULL DEFAULT 'Y',
  `show_title` enum('N','Y') NOT NULL DEFAULT 'Y',
  PRIMARY KEY (`id_contact_form`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `contact_forms` (`id_contact_form`, `element_id`, `title`, `language`, `sender_email`, `receiver_email`, `has_captcha`, `show_title`) VALUES
(9,	84,	'Formularz',	'pl_PL',	'noreplycms@olicom.pl',	'andrzej@olicom.pl',	'N',	'N'),
(10,	103,	'Formularz Rezerwacji',	'pl_PL',	'noreplycms@olicom.pl',	'andrzej@olicom.pl',	'N',	'N'),
(11,	125,	'Formularz DE',	'de_DE',	'noreplycms@olicom.pl',	'andrzej@olicom.pl',	'N',	'N'),
(12,	126,	'Formularz EN',	'en_US',	'noreplycms@olicom.pl',	'andrzej@olicom.pl',	'N',	'N'),
(13,	127,	'Reservierung',	'de_DE',	'noreplycms@olicom.pl',	'andrzej@olicom.pl',	'N',	'N'),
(14,	128,	'Reservation',	'en_US',	'noreplycms@olicom.pl',	'andrzej@olicom.pl',	'N',	'N');

DROP TABLE IF EXISTS `contact_forms_log`;
CREATE TABLE `contact_forms_log` (
  `id_contact_form_log` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(15) NOT NULL,
  `date_sent` int(10) NOT NULL,
  `email` varchar(60) NOT NULL,
  `name` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `message` text NOT NULL,
  `topic` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`id_contact_form_log`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `contact_forms_log` (`id_contact_form_log`, `ip_address`, `date_sent`, `email`, `name`, `phone`, `message`, `topic`) VALUES
(1,	'::1',	1389619744,	'pawel@olicom.org.pl',	'Akcesoria',	'dsa',	'dsa',	'test'),
(2,	'127.0.0.1',	1392213439,	'hubert@olicom.pl',	'Hubert',	'333444555',	'Test formularza',	'test formularza'),
(3,	'127.0.0.1',	1402407552,	'hubert@olicom.pl',	'Hubert',	'555666777',	'teswt',	'test'),
(4,	'127.0.0.1',	1402408451,	'hubert@olicom.pl',	'Hubert',	'555666777',	'test',	'Test'),
(5,	'127.0.0.1',	1402475221,	'filip@olicom.pl',	'Hubert',	'555666777',	'test',	'test'),
(6,	'127.0.0.1',	1402475583,	'filip@olicom.pl',	'Hubert',	'555666777',	'testttttt',	'Testttttt'),
(7,	'::1',	1444983173,	'andrzej@olicom.pl',	'111111',	'123123',	'sdasda',	'asda'),
(8,	'::1',	1444991672,	'andrzej@olicom.pl',	'111111',	'123123',	'sdasda',	'asda'),
(9,	'::1',	1444992758,	'andrzej@olicom.pl',	'111111',	'123123',	'sdasda',	'asda'),
(10,	'::1',	1444992851,	'andrzej@olicom.pl',	'111111',	'123123',	'sdasda',	'asda'),
(11,	'::1',	1444992945,	'andrzej@olicom.pl',	'111111',	'123123',	'sdasda',	'asda'),
(12,	'::1',	1444993586,	'andrzej@olicom.pl',	'111111',	'123123',	'sdasda',	'asda'),
(13,	'::1',	1444993857,	'andrzej@olicom.pl',	'111111',	'123123',	'sdasda',	'asda'),
(14,	'::1',	1444993962,	'andrzej@olicom.pl',	'111111',	'123123',	'sdasda',	'asda'),
(15,	'::1',	1444994913,	'andrzej@olicom.pl',	'45654',	'123123',	'3123',	'21312'),
(16,	'::1',	1444995408,	'olicom@olicom.pl',	'Andrzej Kołbuc',	'741258963',	'123',	'TEST'),
(17,	'::1',	1444996140,	'olicom@olicom.pl',	'Andrzej Kołbuc',	'741258963',	'123',	'TEST'),
(18,	'::1',	1445261914,	'andrzej@olicom.pl',	'Andrzej Kołbuc',	'741258963',	'aaa',	'aaa'),
(19,	'::1',	1445262117,	'andrzej@olicom.pl',	'Andrzej Kołbuc',	'741258963',	'aaa',	'aaa'),
(20,	'::1',	1446116885,	'olicom@olicom.pl',	'Andrzej Kołbuc',	'741258963',	'asdas',	'TEST'),
(21,	'::1',	1446117204,	'hubert@olicom.pl',	'hubert test',	'123456789',	'test',	'Test');

DROP TABLE IF EXISTS `dict_states`;
CREATE TABLE `dict_states` (
  `id_states_dict` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `state_name` varchar(128) NOT NULL,
  PRIMARY KEY (`id_states_dict`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `dict_states` (`id_states_dict`, `state_name`) VALUES
(1,	'Dolnośląskie'),
(2,	'Kujawsko-pomorskie'),
(3,	'Lubelskie'),
(4,	'Lubuskie'),
(5,	'Łódzkie'),
(6,	'Małopolskie'),
(7,	'Mazowieckie'),
(8,	'Opolskie'),
(9,	'Podlaskie'),
(10,	'Podkarpackie'),
(11,	'Pomorskie'),
(12,	'Śląskie'),
(13,	'Świętokrzyskie'),
(14,	'Warmińsko-mazurskie'),
(15,	'Wielkopolskie'),
(16,	'Zachodniopomorskie');

DROP TABLE IF EXISTS `dotpay_logs`;
CREATE TABLE `dotpay_logs` (
  `id_dotpay_log` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `log_desc` text,
  `log_time` datetime DEFAULT NULL,
  `t_id` varchar(255) NOT NULL,
  `info` text,
  PRIMARY KEY (`id_dotpay_log`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `elements`;
CREATE TABLE `elements` (
  `id_element` int(11) NOT NULL AUTO_INCREMENT,
  `type` enum('polls','page_content','news','contact_form','galleries','boxes') DEFAULT NULL,
  `date_added` bigint(20) unsigned NOT NULL,
  `modified_date` bigint(20) unsigned DEFAULT NULL,
  `lang` char(5) NOT NULL,
  `available` tinyint(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_element`,`lang`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `elements` (`id_element`, `type`, `date_added`, `modified_date`, `lang`, `available`) VALUES
(84,	'contact_form',	1446030553,	1447664533,	'pl_PL',	1),
(91,	'page_content',	1451292095,	NULL,	'pl_PL',	1),
(27,	'page_content',	1389873612,	NULL,	'en_US',	1),
(28,	'page_content',	1389873896,	NULL,	'de_DE',	1),
(90,	'page_content',	1451292082,	NULL,	'pl_PL',	1),
(89,	'page_content',	1451292064,	NULL,	'pl_PL',	1),
(82,	'page_content',	1445507715,	NULL,	'pl_PL',	1),
(92,	'page_content',	1451292110,	NULL,	'pl_PL',	1),
(93,	'page_content',	1451292135,	NULL,	'pl_PL',	1),
(94,	'page_content',	1451292150,	NULL,	'pl_PL',	1),
(95,	'boxes',	1451296062,	NULL,	'pl_PL',	1),
(96,	'page_content',	1451296825,	NULL,	'pl_PL',	1),
(97,	'page_content',	1451297008,	NULL,	'pl_PL',	1),
(98,	'galleries',	1451297034,	NULL,	'pl_PL',	1),
(99,	'news',	1451312422,	NULL,	'pl_PL',	1),
(100,	'page_content',	1451312471,	NULL,	'pl_PL',	1),
(101,	'news',	1451313803,	NULL,	'pl_PL',	1),
(103,	'contact_form',	1451383379,	1451474864,	'pl_PL',	1),
(104,	'page_content',	1451552195,	NULL,	'de_DE',	1),
(105,	'page_content',	1451552794,	NULL,	'de_DE',	1),
(106,	'news',	1451553099,	NULL,	'de_DE',	1),
(107,	'page_content',	1451553159,	NULL,	'de_DE',	1),
(108,	'page_content',	1451553348,	NULL,	'de_DE',	1),
(109,	'page_content',	1451553459,	NULL,	'de_DE',	1),
(110,	'page_content',	1451553627,	NULL,	'de_DE',	1),
(111,	'page_content',	1451553662,	NULL,	'de_DE',	1),
(112,	'page_content',	1451553710,	NULL,	'en_US',	1),
(113,	'news',	1451553796,	NULL,	'en_US',	1),
(114,	'page_content',	1451553839,	NULL,	'en_US',	1),
(115,	'page_content',	1451553956,	NULL,	'en_US',	1),
(116,	'page_content',	1451554033,	NULL,	'en_US',	1),
(117,	'page_content',	1451554063,	NULL,	'en_US',	1),
(118,	'news',	1451556034,	NULL,	'de_DE',	1),
(119,	'page_content',	1451558724,	NULL,	'pl_PL',	1),
(120,	'news',	1451558846,	NULL,	'en_US',	1),
(121,	'page_content',	1451559169,	NULL,	'pl_PL',	1),
(122,	'page_content',	1451559189,	NULL,	'pl_PL',	1),
(123,	'boxes',	1451559273,	NULL,	'en_US',	1),
(124,	'boxes',	1451559328,	1451559807,	'de_DE',	1),
(125,	'contact_form',	1451561521,	1451562061,	'de_DE',	1),
(126,	'contact_form',	1451561550,	1451562069,	'en_US',	1),
(127,	'contact_form',	1451561596,	1451562090,	'de_DE',	1),
(128,	'contact_form',	1451561616,	1451562083,	'en_US',	1),
(129,	'page_content',	1451563096,	NULL,	'pl_PL',	1),
(130,	'page_content',	1451563169,	NULL,	'en_US',	1);

DROP TABLE IF EXISTS `galleries`;
CREATE TABLE `galleries` (
  `id_gallery` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT 'pl_PL',
  `description` text,
  `element_id` int(11) NOT NULL,
  `show_title` enum('N','Y') NOT NULL DEFAULT 'Y',
  PRIMARY KEY (`id_gallery`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `galleries` (`id_gallery`, `name`, `description`, `element_id`, `show_title`) VALUES
(1,	'Galeria front',	'',	98,	'Y');

DROP TABLE IF EXISTS `galleries_images`;
CREATE TABLE `galleries_images` (
  `id_galleries_images` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `image_id` int(10) unsigned NOT NULL,
  `gallery_id` int(10) unsigned NOT NULL,
  `alt` varchar(255) DEFAULT NULL,
  `lang` char(5) NOT NULL,
  PRIMARY KEY (`id_galleries_images`,`lang`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `galleries_images` (`id_galleries_images`, `image_id`, `gallery_id`, `alt`, `lang`) VALUES
(7,	7,	1,	'',	''),
(8,	8,	1,	'',	''),
(9,	9,	1,	'',	''),
(10,	10,	1,	'',	''),
(11,	11,	1,	'',	''),
(12,	12,	1,	'',	'');

DROP TABLE IF EXISTS `gallery_images`;
CREATE TABLE `gallery_images` (
  `id_image` int(11) NOT NULL AUTO_INCREMENT,
  `filename` varchar(255) NOT NULL,
  `realfilename` varchar(255) NOT NULL,
  `mainimage` tinyint(1) unsigned NOT NULL,
  `position` int(5) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_image`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `gallery_images` (`id_image`, `filename`, `realfilename`, `mainimage`, `position`) VALUES
(7,	'1451298342156810e26dad5b884181597.jpg',	'gal1.jpg',	0,	0),
(8,	'1451298342156810e26ea377445913092.jpg',	'gal2.jpg',	0,	1),
(9,	'1451298342156810e26f10d8789941768.jpg',	'gal3.jpg',	0,	2),
(10,	'1451298343156810e2703fe2605558280.jpg',	'gal4.jpg',	0,	3),
(11,	'1451298356156810e34b6a6b066036431.jpg',	'gal1.jpg',	0,	4),
(12,	'1451298356156810e34c6857553509094.jpg',	'gal2.jpg',	0,	5);

DROP TABLE IF EXISTS `images`;
CREATE TABLE `images` (
  `id_image` int(11) NOT NULL AUTO_INCREMENT,
  `filename` varchar(255) NOT NULL,
  `realfilename` varchar(255) NOT NULL,
  `mainimage` tinyint(1) unsigned NOT NULL,
  `alt` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_image`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `images` (`id_image`, `filename`, `realfilename`, `mainimage`, `alt`) VALUES
(13,	'1435651389155924d3dc8277152214947.jpg',	'vscandual3.jpg',	0,	'3232'),
(14,	'1435651401155924d49e1544276812399.jpg',	'vscanduala.jpg',	0,	'3232'),
(19,	'1435655072155925ba07bc53864064994.jpg',	'vscandual2.jpg',	0,	''),
(18,	'1435654971155925b3b794aa800454874.jpg',	'vscandual2.jpg',	0,	''),
(20,	'1435655378155925cd25f79b609344426.jpg',	'vscandual3.jpg',	0,	''),
(21,	'1435655389155925cdd1cea8474540984.jpg',	'vscanduala.jpg',	0,	''),
(22,	'1435655392155925ce0c60d2934912948.jpg',	'vscandual2.jpg',	0,	''),
(23,	'1435655475155925d33e80df120316728.jpg',	'101547f1ad53f3c7475.JPG',	0,	''),
(24,	'1435655477155925d35b2052607831521.jpg',	'50proc.jpg',	0,	''),
(25,	'1435655479155925d37eec07982980911.jpg',	'10450ec1303ec3adDSC01747.JPG',	0,	''),
(26,	'1435655595155925daba6839187433232.jpg',	'vscandual2.jpg',	0,	''),
(31,	'1435655772155925e5cd0862376053992.jpg',	'vscandual3.jpg',	0,	''),
(30,	'1435655764155925e5436356043196401.jpg',	'vscandual2.jpg',	0,	'');

DROP TABLE IF EXISTS `languages`;
CREATE TABLE `languages` (
  `id_language` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(5) NOT NULL,
  `description` varchar(64) NOT NULL,
  `flag` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`id_language`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `languages` (`id_language`, `name`, `description`, `flag`) VALUES
(1,	'pl_PL',	'polish',	'pl.png'),
(2,	'de_DE',	'german',	'de.png'),
(3,	'en_US',	'english',	'en.png');

DROP TABLE IF EXISTS `medias`;
CREATE TABLE `medias` (
  `id_media` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `file_name` varchar(255) NOT NULL,
  `mime_type_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id_media`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `medias` (`id_media`, `file_name`, `mime_type_id`) VALUES
(1,	'1-lktextpage.jpg',	1),
(2,	'2-lkcontact.jpg',	1),
(4,	'4-2014-06-05131809.jpg',	1);

DROP TABLE IF EXISTS `medias_mime_types`;
CREATE TABLE `medias_mime_types` (
  `id_mime_type` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `mime_type` varchar(128) NOT NULL,
  `type` varchar(255) NOT NULL,
  PRIMARY KEY (`id_mime_type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `medias_mime_types` (`id_mime_type`, `mime_type`, `type`) VALUES
(1,	'image/jpeg',	'images'),
(2,	'image/png',	'images'),
(3,	'image/gif',	'images'),
(4,	'text/plain',	'others'),
(5,	'application/octet-stream',	'others'),
(6,	'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',	'others'),
(7,	'application/pdf',	'others'),
(8,	'application/zip',	'others'),
(9,	'video/mpeg',	'others'),
(10,	'application/msword',	'others');

DROP TABLE IF EXISTS `medias_product`;
CREATE TABLE `medias_product` (
  `product_id` int(11) NOT NULL,
  `media_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `news`;
CREATE TABLE `news` (
  `id_news` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `lang` char(5) NOT NULL DEFAULT 'pl_PL',
  `short_description` text NOT NULL,
  `description` text NOT NULL,
  `date_added` bigint(20) unsigned NOT NULL,
  `modified_date` bigint(20) unsigned DEFAULT NULL,
  `available` tinyint(1) unsigned NOT NULL,
  `news_start_date` bigint(20) unsigned DEFAULT '0',
  `news_end_date` bigint(20) unsigned DEFAULT '0',
  `position` int(11) DEFAULT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` varchar(255) DEFAULT NULL,
  `meta_keywords` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `mainphotoname` varchar(255) NOT NULL,
  `mainfilename` varchar(255) NOT NULL,
  PRIMARY KEY (`id_news`,`lang`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `news` (`id_news`, `title`, `lang`, `short_description`, `description`, `date_added`, `modified_date`, `available`, `news_start_date`, `news_end_date`, `position`, `meta_title`, `meta_description`, `meta_keywords`, `url`, `mainphotoname`, `mainfilename`) VALUES
(1,	'Pokój 1 osobowy',	'pl_PL',	'<p>Cena 249,00 PLN</p>',	'<p>To przestronny pok&oacute;j z szerokim wygodnym ł&oacute;żkiem.</p>\r\n<p>W komfortowych kamienych łazienkach odnajdą Państwo kosmetyki renomowanej firmy Pascal Morabito Paris.</p>\r\n<p>Pokoje wyposażone są w telewizory plazmowe z telewizją satelitarną.</p>\r\n<p>W pokojach dostępny jest internet WI-FI, indywidualnie sterowana klimatyzacja oraz dla gości biznesowych wygodne miejsce do pracy.</p>\r\n<p>&nbsp;</p>',	1451314747,	NULL,	1,	0,	0,	NULL,	'',	'',	'',	'',	'pokoj1.jpg',	'1451314748156814e3c44321413078753.jpg'),
(2,	'Pokój 2 osobowy',	'pl_PL',	'<p>Cena: 319,00 PLN</p>',	'<p>Oferujemy Państwu komfortowe pokoje 2 - osobowe z ł&oacute;żkiem małżeńskim lub dwoma pojedynczymi ł&oacute;żkami.</p>\r\n<p>W pokojach odnajdą Państwo ekskluzywne, kamienne łazienki, a w nich kosmetyki renomowanej firmy Pascal Morabito Paris; miękką hipoalergiczną wykładzinę oraz nowoczesne meble Wenge.</p>\r\n<p>Pokoje standardowo wyposażone są w telewizję satelitarną, klimatyzację oraz internet Wi-FI.</p>\r\n<p>Na Państwa życzenie istnieje możliwość dostawki dla dzieci do 16 roku życia.</p>',	1451314978,	NULL,	1,	0,	0,	NULL,	'',	'',	'',	'',	'pokoj2.jpg',	'1451314979156814f2359fa2066848153.jpg'),
(3,	'Pokój DE LUX',	'pl_PL',	'<p>Cena: 399,00 PLN</p>',	'<p>Dla najbardziej wymagających gości mamy do dyspozycji pok&oacute;j DE LUX. To przestronny pok&oacute;j dzienny z kącikiem wypoczynkowym, biurkiem i panoramicznym oknem oraz oddzielną sypialnią z łożem małżeńskim.</p>\r\n<p>W dużej, kamiennej łazience odnajdą Państwo wygodną wannę oraz markowe kosmetyki firmy Pascal Morabito Paris.</p>\r\n<p>Pok&oacute;j wyposażony jest w szereg technologicznych udogodnień: indywidualnie sterowaną klimatyzację, telewizor plazmowy oraz bezpłatny, szybki internet WI-FI.</p>\r\n<p>Nasz pok&oacute;j DE LUX to luksus na kt&oacute;ry możesz sobie pozwolić.</p>',	1451257200,	1451315336,	1,	0,	0,	NULL,	'',	'',	'',	'',	'pokoj3.jpg',	'1451315184156814ff082321297197467.jpg'),
(4,	'Das Einzelzimmer',	'de_DE',	'<p>Preise: 219,00PLN</p>',	'<p>Unsere ger&auml;umigen Einzelzimmer bieten Ihnen ein breites und bequemes Bett, Satelitenfernsehen auf modermen Flachbildschirmen, kostenfreies W-LAN, regulierbare Klimaanlage und Annehmlichkeiten f&uuml;r unsere Gesch&auml;ftsreisende.</p>\r\n<p>Im komfortablen Badezimmer mit Stediboden finden Sie endle Toilettenartikel der renommierten Firma Pascal Morabito Paris.</p>',	1451516400,	1451565332,	1,	0,	0,	NULL,	'',	'',	'',	'',	'pokoj1.jpg',	'145155619315684fd6106ffd710358416.jpg'),
(5,	'Das Doppelzimmer',	'de_DE',	'<p>Preise: 319,00PLN</p>',	'<p>Wir stellen Ihnen unsere Doppelzimmer mit einem Doppelbett oder zwei separaten Einzelbetten zur Verf&uuml;gung. Alle B&ouml;den in den Doppelzimmer sind mit angenchmen, hypoallergenen Teppichb&ouml;den bedeckt und mit modemen Wenge-M&ouml;beln ausgestattet.</p>\r\n<p>In unseren Doppelzimmer bieten wir standardm&auml;&szlig;ig Satelitenfernsehen auf modermen Flachbildschirmen, regulierbare Klimaanlage und kostenfreies W-LAN. Im exklusiven Badezimmer mit Steinboden finden Sie edle Toilettenartikel der ronommierten Firma Pascal Morabito Paris.</p>\r\n<p>Ein Zusatzbett f&uuml;r Kinder unter dem 16 Lebensjahr ist auf Kundenwunsch m&ouml;glich.</p>',	1451516400,	1451565363,	1,	0,	0,	NULL,	'',	'',	'',	'',	'pokoj2.jpg',	'145155633615684fdf060a5e435677052.jpg'),
(6,	'Das De Lux Zimmer',	'de_DE',	'<p>Preise: 399,00PLN</p>',	'<p>Wem Einzel- und Doppelzimmer nicht gen&uuml;gen, der kann in einem De Lux- Zimmer die Nacht verbringen. Das De Lux- Zimmer besteht aus einem gro&szlig;z&uuml;gigen Wohnzimmer mit einem sch&ouml;nen Sitzbereich, einem Schreibtisch, einem Panoramafenster und aus einem separaten Schlafzimmer mit gro&szlig;em Doppelbett.</p>\r\n<p>Im exklusiven Badezimmer mit Steinboden finden Sie eine komfortable Badewanne und edle Toitlttenartikel von Pascal Morabito Paris. Das De Lux- Zimmer bietet jeden modermen Komfort: individuell regelbare Klimaalage, Satellitenfernschen auf modermem Flachbildschirm, kostenfreies Highspeed W-LAN.</p>\r\n<p>Unser De Lux-Zimmer ist ein Luxus, den Sie sich leisten k&ouml;nnen.</p>',	1451516400,	1451565307,	1,	0,	0,	NULL,	'',	'',	'',	'',	'pokoj3.jpg',	'145155646115684fe6d6dfda221080319.jpg'),
(7,	'Single room',	'en_US',	'<p>Price: 249,00 PLN</p>',	'<p>This is a spacious room with a large, comfortable bed. In each room there is a posh, stone bathroom with Pascal Morabito Paris cosmetics.</p>\r\n<p>The rooms are equipped with plasma, satellite televison, air conditioning with individual control and internet wi-fi. For our business guestes there is comfortable place to work in each room.</p>',	1451558944,	NULL,	1,	0,	0,	NULL,	'',	'',	'',	'',	'pokoj1.jpg',	'145155894415685082087c0d100993874.jpg'),
(8,	'Double room',	'en_US',	'<p>Price: 319,00PLN</p>',	'<p>We would like to offer comfortable double rooms with double bed or two single beds. In each room there is a posh, stone bathroom with Pascal Morabito Paris cosmetics, soft hypoallergic fitted carpet and trendy Wenge furniture.</p>\r\n<p>The is satellite television, air-conditioning and wi-fi in each room.</p>\r\n<p>We can also provide an extra child bed for childeren under 16 years old.</p>',	1451558983,	NULL,	1,	0,	0,	NULL,	'',	'',	'',	'',	'pokoj2.jpg',	'1451558983156850847807c2750263658.jpg'),
(9,	'DE LUX room',	'en_US',	'<p>Price: 399,00PLN</p>',	'<p>For the most demanding guests we have a De Lux room. It is a spacious living room with a &lsquo;&rsquo;rest comer&rsquo;&rsquo;, a desk, panoramic window and a separate bedroom with double bed.</p>\r\n<p>In a big stone bathroom there is a comfortable bath and Pascal Morabito Paris cosmetics. There are many technical facilities like: air conditioning with individual control, plasma television, quick internet wi-fi (free of charge).</p>\r\n<p>Our De Lux room is a luxury room you can afford.</p>',	1451516400,	1451559094,	1,	0,	0,	NULL,	'',	'',	'',	'',	'pokoj3.jpg',	'14515590941568508b687c5d419192118.jpg');

DROP TABLE IF EXISTS `newsletters`;
CREATE TABLE `newsletters` (
  `id_newsletter` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `language` char(5) NOT NULL DEFAULT 'pl_PL',
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `date_added` bigint(20) unsigned NOT NULL,
  `date_sent` bigint(20) unsigned DEFAULT NULL,
  `interval` int(11) NOT NULL,
  `bulk` int(11) NOT NULL,
  PRIMARY KEY (`id_newsletter`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `newsletters` (`id_newsletter`, `language`, `title`, `content`, `date_added`, `date_sent`, `interval`, `bulk`) VALUES
(2,	'pl_PL',	'Mobile mailing',	' ',	1384560957,	1444997258,	60000,	20);

DROP TABLE IF EXISTS `newsletters_attachments`;
CREATE TABLE `newsletters_attachments` (
  `newsletter_id` int(10) unsigned NOT NULL,
  `attachment` varchar(255) CHARACTER SET utf8 NOT NULL,
  `position` int(10) unsigned NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `newsletters_newsletter_groups`;
CREATE TABLE `newsletters_newsletter_groups` (
  `newsletter_id` int(10) unsigned NOT NULL,
  `newsletter_group_id` int(10) unsigned NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `newsletters_newsletter_groups` (`newsletter_id`, `newsletter_group_id`) VALUES
(2,	1);

DROP TABLE IF EXISTS `newsletter_emails`;
CREATE TABLE `newsletter_emails` (
  `id_email` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `email` varchar(255) NOT NULL,
  `verify_string` varchar(128) DEFAULT NULL,
  `verified` tinyint(1) unsigned DEFAULT NULL,
  `newsletter_email_active` enum('N','Y') NOT NULL DEFAULT 'Y',
  PRIMARY KEY (`id_email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `newsletter_emails` (`id_email`, `name`, `email`, `verify_string`, `verified`, `newsletter_email_active`) VALUES
(7,	'Andrzej Kołbuc',	'andrzej@olicom.pl',	'af60urau',	1,	'Y');

DROP TABLE IF EXISTS `newsletter_email_groups`;
CREATE TABLE `newsletter_email_groups` (
  `newsletter_group_id` int(10) unsigned NOT NULL,
  `newsletter_email_id` int(10) unsigned NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `newsletter_email_groups` (`newsletter_group_id`, `newsletter_email_id`) VALUES
(1,	2),
(1,	3),
(1,	7);

DROP TABLE IF EXISTS `newsletter_email_send`;
CREATE TABLE `newsletter_email_send` (
  `newsletter_id` int(10) unsigned NOT NULL,
  `email_id` int(10) unsigned NOT NULL,
  `send_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `newsletter_email_send` (`newsletter_id`, `email_id`, `send_date`) VALUES
(2,	7,	'2015-10-16 14:06:38');

DROP TABLE IF EXISTS `newsletter_groups`;
CREATE TABLE `newsletter_groups` (
  `id_newsletter_group` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `default_group` tinyint(4) NOT NULL DEFAULT '0',
  `lang` varchar(5) NOT NULL DEFAULT 'pl_PL',
  PRIMARY KEY (`id_newsletter_group`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `newsletter_groups` (`id_newsletter_group`, `name`, `description`, `default_group`, `lang`) VALUES
(1,	'Grupa domyślna PL',	'Domyslna grupa dla osób zapisanych do newslettera z polskiej wersji językowej witryny.',	1,	'pl_PL'),
(2,	'Nowa grupa',	'Opis grupy\r\n',	0,	'pl_PL');

DROP TABLE IF EXISTS `newsletter_images`;
CREATE TABLE `newsletter_images` (
  `id_image` int(11) NOT NULL AUTO_INCREMENT,
  `filename` varchar(255) NOT NULL,
  `newsletter_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id_image`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `news_categories`;
CREATE TABLE `news_categories` (
  `id_news_category` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_news_subcategory` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '0 -> brak kategorii nadrzednej',
  `news_category_name` varchar(255) NOT NULL,
  `element_id` int(11) NOT NULL,
  `show_title` enum('N','Y') NOT NULL DEFAULT 'Y',
  `comments` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '0 - wylaczone, 1 - wlaczone',
  `visible` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '0 - wylaczone, 1 - wlaczone',
  PRIMARY KEY (`id_news_category`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `news_categories` (`id_news_category`, `id_news_subcategory`, `news_category_name`, `element_id`, `show_title`, `comments`, `visible`) VALUES
(1,	0,	'Pokoje',	101,	'Y',	0,	1),
(2,	0,	'Zimmer',	118,	'Y',	0,	1),
(3,	0,	'Rooms',	120,	'Y',	0,	1);

DROP TABLE IF EXISTS `news_comments`;
CREATE TABLE `news_comments` (
  `id_news_comment` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `comment` text NOT NULL,
  `news_id` int(10) unsigned NOT NULL,
  `nick` varchar(50) NOT NULL,
  `client_ip` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_news_comment`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `news_comments` (`id_news_comment`, `comment`, `news_id`, `nick`, `client_ip`) VALUES
(1,	'test',	1,	'testtt',	'127.0.0.1');

DROP TABLE IF EXISTS `news_elements`;
CREATE TABLE `news_elements` (
  `id_news_elements` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `news_id` int(11) unsigned NOT NULL,
  `element_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id_news_elements`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `news_images`;
CREATE TABLE `news_images` (
  `news_id` int(10) unsigned NOT NULL,
  `images_id` int(10) unsigned NOT NULL,
  `id_news_images` int(10) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id_news_images`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `news_to_categories`;
CREATE TABLE `news_to_categories` (
  `id_news_to_categories` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `news_id` int(11) unsigned NOT NULL,
  `news_category_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id_news_to_categories`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `news_to_categories` (`id_news_to_categories`, `news_id`, `news_category_id`) VALUES
(1,	1,	1),
(2,	2,	1),
(4,	3,	1),
(14,	4,	2),
(15,	5,	2),
(13,	6,	2),
(9,	7,	3),
(10,	8,	3),
(12,	9,	3);

DROP TABLE IF EXISTS `pages`;
CREATE TABLE `pages` (
  `id_page` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name_page` varchar(255) NOT NULL DEFAULT '',
  `url` varchar(255) NOT NULL DEFAULT '',
  `lang` char(5) NOT NULL DEFAULT 'pl_PL',
  `parent_id` int(10) unsigned NOT NULL,
  `date_added` bigint(20) unsigned NOT NULL,
  `modified_date` bigint(20) unsigned DEFAULT NULL,
  `available` enum('N','Y') NOT NULL DEFAULT 'Y',
  `meta_keywords` text,
  `meta_description` text,
  `meta_author` varchar(255) DEFAULT NULL,
  `meta_generator` varchar(255) DEFAULT NULL,
  `meta_robots` varchar(128) DEFAULT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `page_position` int(10) unsigned DEFAULT '0',
  `show_in_menu` int(10) unsigned DEFAULT '1',
  `homepage` tinyint(1) NOT NULL DEFAULT '0',
  `page_type` varchar(128) NOT NULL DEFAULT 'cms',
  `menu_link_off` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1 - link wylaczony, 0 - link wlaczony',
  `filename` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_page`,`lang`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `pages` (`id_page`, `name_page`, `url`, `lang`, `parent_id`, `date_added`, `modified_date`, `available`, `meta_keywords`, `meta_description`, `meta_author`, `meta_generator`, `meta_robots`, `meta_title`, `page_position`, `show_in_menu`, `homepage`, `page_type`, `menu_link_off`, `filename`) VALUES
(1,	'Strona Główna',	'home',	'pl_PL',	0,	1311939206,	1445322449,	'Y',	'',	'',	NULL,	NULL,	NULL,	'Home',	100,	1,	1,	'cms',	0,	NULL),
(52,	'Hotel',	'hotel',	'pl_PL',	0,	1451292064,	1451380191,	'Y',	'',	'',	NULL,	NULL,	NULL,	'',	95,	1,	0,	'cms',	1,	NULL),
(53,	'Cennik',	'cennik',	'pl_PL',	0,	1451292082,	0,	'Y',	'',	'',	NULL,	NULL,	NULL,	'',	90,	1,	0,	'cms',	0,	NULL),
(51,	'Kontakt',	'kontakt',	'pl_PL',	0,	1445322407,	1451292178,	'Y',	'',	'',	NULL,	NULL,	NULL,	'',	60,	1,	0,	'cms',	0,	NULL),
(54,	'Restauracja',	'http://www.jas.pl/commhotel/restauracja/',	'pl_PL',	0,	1451292095,	1451309238,	'Y',	'',	'',	NULL,	NULL,	NULL,	'',	85,	1,	0,	'link',	0,	NULL),
(55,	'Ogród',	'ogrod',	'pl_PL',	0,	1451292110,	0,	'Y',	'',	'',	NULL,	NULL,	NULL,	'',	80,	1,	0,	'cms',	0,	NULL),
(56,	'Rezerwacje',	'rezerwacje',	'pl_PL',	0,	1451292135,	0,	'Y',	'',	'',	NULL,	NULL,	NULL,	'',	75,	1,	0,	'cms',	0,	NULL),
(57,	'Promocje',	'promocje',	'pl_PL',	0,	1451292150,	0,	'Y',	'',	'',	NULL,	NULL,	NULL,	'',	70,	1,	0,	'cms',	0,	NULL),
(58,	'Pokoje',	'pokoje',	'pl_PL',	52,	1451312422,	0,	'Y',	'',	'',	NULL,	NULL,	NULL,	'',	0,	1,	0,	'cms',	0,	NULL),
(59,	'Sala klubowa',	'sala-klubowa',	'pl_PL',	52,	1451312471,	0,	'Y',	'',	'',	NULL,	NULL,	NULL,	'',	0,	1,	0,	'cms',	0,	NULL),
(60,	'Haupseite',	'de',	'de_DE',	0,	1451552194,	1451554967,	'Y',	'',	'',	NULL,	NULL,	NULL,	'',	100,	1,	1,	'cms',	0,	NULL),
(61,	'Das Hotel',	'das-hotel',	'de_DE',	0,	1451552794,	1451554989,	'Y',	'',	'',	NULL,	NULL,	NULL,	'',	95,	1,	0,	'cms',	0,	NULL),
(62,	'Zimmer',	'zimmer',	'de_DE',	61,	1451553099,	0,	'Y',	'',	'',	NULL,	NULL,	NULL,	'',	0,	1,	0,	'cms',	0,	NULL),
(63,	'Der Unterhaltungraum',	'der-unterhaltungraum',	'de_DE',	61,	1451553159,	0,	'Y',	'',	'',	NULL,	NULL,	NULL,	'',	0,	1,	0,	'cms',	0,	NULL),
(64,	'Preise',	'preise',	'de_DE',	0,	1451553348,	0,	'Y',	'',	'',	NULL,	NULL,	NULL,	'',	90,	1,	0,	'cms',	0,	NULL),
(65,	'Restaurant',	'httpwwwjasplcommhotelrestauracja',	'de_DE',	0,	1451553406,	1451555015,	'Y',	'',	'',	NULL,	NULL,	NULL,	'',	85,	1,	0,	'cms',	1,	NULL),
(66,	'Der Garten',	'der-garten',	'de_DE',	0,	1451553459,	0,	'Y',	'',	'',	NULL,	NULL,	NULL,	'',	80,	1,	0,	'cms',	0,	NULL),
(67,	'Reservierung',	'reservierung',	'de_DE',	0,	1451553530,	0,	'Y',	'',	'',	NULL,	NULL,	NULL,	'',	75,	1,	0,	'cms',	0,	NULL),
(68,	'Promotions',	'promotions',	'de_DE',	0,	1451553627,	0,	'Y',	'',	'',	NULL,	NULL,	NULL,	'',	70,	1,	0,	'cms',	0,	NULL),
(69,	'Kontakt',	'kontakt-69',	'de_DE',	0,	1451553661,	0,	'Y',	'',	'',	NULL,	NULL,	NULL,	'',	65,	1,	0,	'cms',	0,	NULL),
(70,	'Main page',	'en',	'en_US',	0,	1451553710,	1451554930,	'Y',	'',	'',	NULL,	NULL,	NULL,	'',	100,	1,	1,	'cms',	0,	NULL),
(71,	'Hotel',	'hotel-71',	'en_US',	0,	1451553731,	0,	'Y',	'',	'',	NULL,	NULL,	NULL,	'',	95,	1,	0,	'cms',	1,	NULL),
(72,	'Rooms',	'rooms',	'en_US',	71,	1451553796,	0,	'Y',	'',	'',	NULL,	NULL,	NULL,	'',	0,	1,	0,	'cms',	0,	NULL),
(73,	'Billard room',	'billard-room',	'en_US',	71,	1451553839,	0,	'Y',	'',	'',	NULL,	NULL,	NULL,	'',	0,	1,	0,	'cms',	0,	NULL),
(74,	'Restaurant',	'httpwwwjasplcommhotelrestauracja-74',	'en_US',	0,	1451553911,	0,	'Y',	'',	'',	NULL,	NULL,	NULL,	'',	85,	1,	0,	'cms',	1,	NULL),
(75,	'Garden',	'garden',	'en_US',	0,	1451553956,	0,	'Y',	'',	'',	NULL,	NULL,	NULL,	'',	80,	1,	0,	'cms',	0,	NULL),
(76,	'Reservation',	'reservation',	'en_US',	0,	1451554009,	0,	'Y',	'',	'',	NULL,	NULL,	NULL,	'',	75,	1,	0,	'cms',	0,	NULL),
(77,	'Promotions',	'promotions-77',	'en_US',	0,	1451554033,	0,	'Y',	'',	'',	NULL,	NULL,	NULL,	'',	70,	1,	0,	'cms',	0,	NULL),
(78,	'Contact',	'contact',	'en_US',	0,	1451554063,	0,	'Y',	'',	'',	NULL,	NULL,	NULL,	'',	65,	1,	0,	'cms',	0,	NULL),
(79,	'Price list',	'price-list',	'en_US',	0,	1451555092,	0,	'Y',	'',	'',	NULL,	NULL,	NULL,	'',	90,	1,	0,	'cms',	0,	NULL);

DROP TABLE IF EXISTS `pages_elements`;
CREATE TABLE `pages_elements` (
  `page_id` int(11) NOT NULL,
  `element_id` int(11) NOT NULL,
  `id_pages_elements` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `element_order` int(11) DEFAULT NULL,
  `element_type` enum('footer','header','content','right','left') DEFAULT NULL,
  `position` enum('center','right','left') DEFAULT NULL,
  PRIMARY KEY (`id_pages_elements`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `pages_elements` (`page_id`, `element_id`, `id_pages_elements`, `element_order`, `element_type`, `position`) VALUES
(21,	27,	37,	NULL,	NULL,	NULL),
(53,	90,	148,	NULL,	NULL,	NULL),
(23,	28,	38,	NULL,	NULL,	NULL),
(52,	89,	147,	NULL,	NULL,	NULL),
(54,	91,	149,	NULL,	NULL,	NULL),
(51,	82,	137,	NULL,	NULL,	NULL),
(51,	84,	146,	NULL,	NULL,	NULL),
(55,	92,	150,	NULL,	NULL,	NULL),
(56,	93,	151,	NULL,	NULL,	NULL),
(57,	94,	152,	NULL,	NULL,	NULL),
(1,	95,	153,	NULL,	NULL,	NULL),
(1,	96,	154,	NULL,	NULL,	NULL),
(1,	97,	155,	NULL,	NULL,	NULL),
(1,	98,	156,	NULL,	NULL,	NULL),
(58,	99,	157,	NULL,	NULL,	NULL),
(59,	100,	158,	NULL,	NULL,	NULL),
(58,	101,	159,	NULL,	NULL,	NULL),
(56,	103,	163,	NULL,	NULL,	NULL),
(60,	104,	164,	NULL,	NULL,	NULL),
(61,	105,	165,	NULL,	NULL,	NULL),
(62,	106,	166,	NULL,	NULL,	NULL),
(63,	107,	167,	NULL,	NULL,	NULL),
(64,	108,	168,	NULL,	NULL,	NULL),
(66,	109,	169,	NULL,	NULL,	NULL),
(68,	110,	170,	NULL,	NULL,	NULL),
(69,	111,	171,	NULL,	NULL,	NULL),
(70,	112,	172,	NULL,	NULL,	NULL),
(72,	113,	173,	NULL,	NULL,	NULL),
(73,	114,	174,	NULL,	NULL,	NULL),
(75,	115,	175,	NULL,	NULL,	NULL),
(77,	116,	176,	NULL,	NULL,	NULL),
(78,	117,	177,	NULL,	NULL,	NULL),
(62,	118,	178,	NULL,	NULL,	NULL),
(79,	119,	179,	NULL,	NULL,	NULL),
(72,	120,	180,	NULL,	NULL,	NULL),
(60,	121,	181,	NULL,	NULL,	NULL),
(70,	122,	182,	NULL,	NULL,	NULL),
(70,	123,	183,	NULL,	NULL,	NULL),
(60,	124,	186,	NULL,	NULL,	NULL),
(69,	125,	194,	NULL,	NULL,	NULL),
(78,	126,	195,	NULL,	NULL,	NULL),
(67,	127,	197,	NULL,	NULL,	NULL),
(76,	128,	196,	NULL,	NULL,	NULL),
(67,	129,	198,	NULL,	NULL,	NULL),
(76,	130,	199,	NULL,	NULL,	NULL);

DROP TABLE IF EXISTS `pages_languages`;
CREATE TABLE `pages_languages` (
  `page_id` int(11) NOT NULL,
  `language_id` varchar(45) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `page_content`;
CREATE TABLE `page_content` (
  `id_page_content` int(11) NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `content` text NOT NULL,
  `element_id` int(11) DEFAULT NULL,
  `show_title` enum('N','Y') NOT NULL DEFAULT 'Y',
  PRIMARY KEY (`id_page_content`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `page_content` (`id_page_content`, `title`, `content`, `element_id`, `show_title`) VALUES
(16,	'About Us',	'<p>Under construction</p>',	27,	'Y'),
(17,	'Über uns',	'<p><span id=\"result_box\" class=\"short_text\" lang=\"de\"><span class=\"hps\">im Bau</span></span></p>',	28,	'Y'),
(35,	'Kontakt',	'<p><span style=\"color: #947953;\"><strong>Comm Hotel</strong></span></p>\r\n<p>ul. Bukowska 348/350</p>\r\n<p>60-189 Poznań</p>\r\n<p>&nbsp;</p>\r\n<p>tel: +48 61 868 24 00</p>\r\n<p>tel: +48 61 868&nbsp;10 60</p>\r\n<p>tel: +48&nbsp;501 166 200</p>\r\n<p>fax:&nbsp;+48 61 624&nbsp;11&nbsp;00</p>\r\n<p>&nbsp;</p>\r\n<p>email: <a href=\"mailto:comm@comm-hotel.pl\" rel=\"prettyPhoto\">comm@comm-hotel.pl</a></p>',	82,	'N'),
(39,	'Hotel',	'<p>Comm hotel położony jest &nbsp;zaledwie 100m od Portu&nbsp;Lotniczego Ławica tworząc idealne położenie niezależnie od tego czy przybędziecie Państwo do naszego czarującego miasta samolotem, pociągiem czy samochodem. Dotarcie do portu lotniczego to jedynie dwie minuty przyjemnego spaceru, a dojazd do centrum miasta oraz Międzynarodowych Targ&oacute;w Poznańskich nie zajmie Państwu więcej niż 15 minut.</p>\r\n<p>Nasze pokoje gościnne są specjalnie zaprojektowane, odnajdą tu Państwo najbardziej ekskluzywne połączenie designu, funcjonalności i najnowszej technologii.</p>\r\n<p>Nasz hotel słynie z wyśmienitej kuchni, kt&oacute;ra sprosta nawet najbardziej wymagającym smakoszom.</p>\r\n<p>Zapraszamy na wykwintny bufet śniadaniowy, kt&oacute;ry jest gwarancją dnia pełnego sukces&oacute;w. Oferujemy szeroką gamę r&oacute;żnorodnych dań: świeże owoce i warzywa, najwyższej jakości wędliny i sery. Potrawy gorące takie jak: jajka przyrządzone na spos&oacute;b jaki najbardziej Państwo lubią, omlety z ciekawymi dodatkami, gorące kiełbaski lub plastry wędzonego łososia, a wszystko to dopełnia wyśmienity sok wyciekany na oczach gości ze świeżych hiszpańskich pomarańczy lub gorąca kawa, kt&oacute;ej aromat już o poranku uniosi się w całym hotelu.</p>\r\n<p>Profesjonalny serwis oraz niespotykana, rodzinna atmosfera sprawią, że niezależne od celu podr&oacute;ży pobyt w naszyzm hotelu stanie się niezapomniany.</p>\r\n<p>Zapraszamy serdecznie!</p>',	89,	'Y'),
(40,	'Cennik',	'<table style=\"height: 98px;\" width=\"436\">\r\n<tbody>\r\n<tr>\r\n<td colspan=\"4\"><strong>Pokoje</strong></td>\r\n</tr>\r\n<tr>\r\n<td style=\"height: 10px;\">&nbsp;</td>\r\n<td style=\"height: 10px; text-align: center;\">&nbsp;</td>\r\n<td style=\"height: 10px; text-align: center;\">Targi I</td>\r\n<td style=\"height: 10px; text-align: center;\">Targi II</td>\r\n</tr>\r\n<tr>\r\n<td style=\"height: 10px;\">Pok&oacute;j 1 - osobowy</td>\r\n<td style=\"height: 10px; text-align: center;\">249,00 PLN</td>\r\n<td style=\"height: 10px; text-align: center;\">279,00 PLN</td>\r\n<td style=\"height: 10px; text-align: center;\">319,00 PLN</td>\r\n</tr>\r\n<tr>\r\n<td style=\"height: 10px;\">Pok&oacute;j 2&nbsp;- osobowy</td>\r\n<td style=\"height: 10px; text-align: center;\">319,00 PLN</td>\r\n<td style=\"height: 10px; text-align: center;\">339,00 PLN</td>\r\n<td style=\"height: 10px; text-align: center;\">369,00 PLN</td>\r\n</tr>\r\n<tr>\r\n<td style=\"height: 10px;\">Pok&oacute;j&nbsp;<strong>DE LUX</strong></td>\r\n<td style=\"height: 10px; text-align: center;\">399,00 PLN</td>\r\n<td style=\"height: 10px; text-align: center;\">419,00 PLN</td>\r\n<td style=\"height: 10px; text-align: center;\">449,00 PLN</td>\r\n</tr>\r\n<tr>\r\n<td colspan=\"4\">\r\n<p>&nbsp;</p>\r\n<p>Śniadanie 36 PLN</p>\r\n<p>Dostawka 50 PLN (dotyczy dzieci do 16 roku życia)</p>\r\n<p>Wynajem salki kominkowej na wyłączność 50 PLN/h</p>\r\n<p>&nbsp; serwis kawowy 32 PLN/os</p>\r\n<p>Profesjonalna sala konferencyjna 50 PLN/h</p>\r\n<p>&nbsp; serwis kawowy 32 PLN/os</p>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<table style=\"height: 36px;\" width=\"440\">\r\n<tbody>\r\n<tr>\r\n<td style=\"height: 12px;\">\r\n<p>&nbsp;</p>\r\n<p>Targi I</p>\r\n<p>Tour Salon, Poleko</p>\r\n<p>&nbsp;</p>\r\n</td>\r\n<td style=\"height: 12px;\">\r\n<p>&nbsp;</p>\r\n<p>Targi II</p>\r\n<p>Polagra, Budma, CEDE</p>\r\n<p>&nbsp;</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td style=\"height: 12px;\">\r\n<p>Ceny zawierają podatek VAT.</p>\r\n<p>Bezpłatny Internet WI-FI.</p>\r\n<p>Wszystkie pokoje są klimatyzowane.</p>\r\n</td>\r\n<td style=\"height: 12px;\">&nbsp;<img style=\"display: block; margin-left: auto; margin-right: auto;\" src=\"http://localhost/commhotel/files/medias/image/visa.png\" alt=\"\" width=\"61\" height=\"79\" /></td>\r\n</tr>\r\n</tbody>\r\n</table>',	90,	'Y'),
(41,	'Restauracja',	'',	91,	'Y'),
(42,	'Ogród',	'<p>Nasz ogr&oacute;d to idealne miejsce, by w ciepły letni dzień odpocząć w cieniu parasola, z dala od zgiełku miasta a łonie natury, wsłuchując się jedynie w przyjemny szuk wody oraz śpiew ptak&oacute;w.</p>\r\n<p>W otoczeniu zieleni i zapachu kwiat&oacute;w mogą Państwo rozkoszować się chłodnym odświeżającym drinkiem lub jeśli tylko pogoda na to pozwoli na Państwa życzenie w ogrodzie zaserwujemy śniadanie, lunch lub kolacje.</p>\r\n<p>To także idealne miejsce, by przy świetle lampion&oacute;w i butelelce dobrego wina spędzić letni wiecz&oacute;r.</p>',	92,	'Y'),
(43,	'Rezerwacje',	'',	93,	'Y'),
(44,	'Promocje',	'',	94,	'Y'),
(45,	'O nas',	'<p>Comm hotel położony jest &nbsp;zaledwie 100m od Portu&nbsp;Lotniczego Ławica tworząc idealne położenie niezależnie od tego czy przybędziecie Państwo do naszego czarującego miasta samolotem, pociągiem czy samochodem. Dotarcie do portu lotniczego to jedynie dwie minuty przyjemnego spaceru, a dojazd do centrum miasta oraz Międzynarodowych Targ&oacute;w Poznańskich nie zajmie Państwu więcej niż 15 minut.</p>\r\n<p>Nasze pokoje gościnne są specjalnie zaprojektowane, odnajdą tu Państwo najbardziej ekskluzywne połączenie designu, funcjonalności i najnowszej technologii.</p>\r\n<p>Nasz hotel słynie z wyśmienitej kuchni, kt&oacute;ra sprosta nawet najbardziej wymagającym smakoszom.</p>\r\n<p>Zapraszamy na wykwintny bufet śniadaniowy, kt&oacute;ry jest gwarancją dnia pełnego sukces&oacute;w. Oferujemy szeroką gamę r&oacute;żnorodnych dań: świeże owoce i warzywa, najwyższej jakości wędliny i sery. Potrawy gorące takie jak: jajka przyrządzone na spos&oacute;b jaki najbardziej Państwo lubią, omlety z ciekawymi dodatkami, gorące kiełbaski lub plastry wędzonego łososia, a wszystko to dopełnia wyśmienity sok wyciekany na oczach gości ze świeżych hiszpańskich pomarańczy lub gorąca kawa, kt&oacute;ej aromat już o poranku uniosi się w całym hotelu.</p>\r\n<p>Profesjonalny serwis oraz niespotykana, rodzinna atmosfera sprawią, że niezależne od celu podr&oacute;ży pobyt w naszyzm hotelu stanie się niezapomniany.</p>\r\n<p>Zapraszamy serdecznie!</p>',	96,	'Y'),
(46,	'Kontakt',	'<p><span style=\"color: #947953;\"><strong>Comm Hotel</strong></span></p>\r\n<p>ul. Bukowska 348/350</p>\r\n<p>60-189 Poznań</p>\r\n<p>&nbsp;</p>\r\n<p>tel: +48 61 868 24 00</p>\r\n<p>tel: +48 61 868&nbsp;10 60</p>\r\n<p>tel: +48&nbsp;501 166 200</p>\r\n<p>fax:&nbsp;+48 61 624&nbsp;11&nbsp;00</p>\r\n<p>&nbsp;</p>\r\n<p>email: <a href=\"mailto:comm@comm-hotel.pl\" rel=\"prettyPhoto\">comm@comm-hotel.pl</a></p>',	97,	'Y'),
(47,	'Sala klubowa',	'<p>Stworzona z myślą by umilić Państwu czas sala klubowa wyposażona jest w profesjonalny st&oacute;ł bilardowy, dart, &nbsp;telewizor plazmowy oraz wygodne fotele.</p>\r\n<p>To idealne miejsce, by zrelaksować się po lub przed podr&oacute;żą. Zlokalizowana na uboczu zapewnia prywatność a płonący kominek tworzy niezapomniany klimat.</p>\r\n<p>&nbsp;</p>\r\n<p>Obsługa chętnie poda Państwu drinka lub aromatyczne cygaro, sala jest bowiem przystosowana dla os&oacute;b palących.</p>',	100,	'Y'),
(48,	'Uber uns',	'<p>Die unmittelbar N&auml;he des Comm-Hotels vor Flughafen Poznań-Ławica (nur 100 Meter) gew&auml;hrleistet unseren G&auml;sten eine optimale Lage- unabh&auml;ngig davon, ob Sie mit dem Flugzeug, mit dem Zug oder mit dem Auto unsere bezaubernde Stadt anreisen. Den Flughafen Poznań-Ławica errichen Sie zu Fu&szlig; in nur zwei Minuten, das Stadtzentrum und die Posener Messe (MTO) errichen Sie in weniger als 15 Minuten. Die Inneneirnrichtung unserer Zimmer wurde speziell gestaltet, damit Sie hier eine exklusive Mischung aus Design, Funktionalit&auml;t und allerneuster Technologie finden.</p>\r\n<p>Genie&szlig;en Sie unser vorz&uuml;gliches Fr&uuml;hst&uuml;cksbuffet-es garantiert Ihnen einen erfolgreichen Tag! Wie bieten ein Vielfalt von verschiedenen Speisen: friches Obst und Gem&uuml;se, Aufschnitt und K&auml;sesorten von h&ouml;chster Qualit&auml;t. Warme Speisen wie Eier, die f&uuml;r unsere G&auml;ste auf beliebiqe Art und Weise aubereitet werden, Omelette mit phantasievollen Zutaten, warme W&uuml;rstchen oder ger&auml;ucherte Scheiben vom Lachs. Ein frisch gepresster Orangensaft oder eine Tasse hei&szlig;en Kaffees, dessen aromatischer Duft sich gegen Morgen im ganzen Hotel verbreitet, runden das k&ouml;stliche Fr&uuml;hst&uuml;ck ab.</p>\r\n<p>Kank unserem professionellen Service und dem einmaligen famili&auml;ren Ambiente wird der Aufenthalt in unserem Hotel, unabh&auml;ngig von Ihrem Reiseziel, zum unvergesslichen Erlebnis.</p>',	104,	'Y'),
(49,	'Das Hotel',	'',	105,	'Y'),
(50,	'Der Unterhaltungraum',	'<p>Damit unsere G&auml;ste sich nach oder von der Reise entspannen k&ouml;nnen, stellen wir Ihnen einen abseits gelegenen Unterhaltungsraum zur Verf&uuml;gung.</p>\r\n<p>Sie k&ouml;nnen sich hier in einen bequemen Sessel zur&uuml;cklehnen und eine aromatische Zigarre in Brand stecken oder einfach vor dem Kamin sitzen und Ihren Drink genie&szlig;en. Das Hotel macht seinen G&auml;sten einen professionellen Billardtisch, Darts, Satellitenfernsehen auf modernem Flaschbilschirm und bequeme Sessel verf&uuml;gbar.</p>\r\n<p>Unser Unterhaltunsraum als ein idealer Ort f &uuml;r enspannte Stunden am Abend sorgt es f&uuml;r das Wohlbefinden unserer G&auml;ste und das Kaminfeuer schafft eine einmaliege Atmosph&auml;re.</p>',	107,	'Y'),
(51,	'Preise',	'<table style=\"height: 98px;\" width=\"436\">\r\n<tbody>\r\n<tr>\r\n<td colspan=\"4\"><strong>Zimmer</strong></td>\r\n</tr>\r\n<tr>\r\n<td style=\"height: 10px;\">&nbsp;</td>\r\n<td style=\"height: 10px; text-align: center;\">&nbsp;</td>\r\n<td style=\"height: 10px; text-align: center;\">Messe I</td>\r\n<td style=\"height: 10px; text-align: center;\">Messe II</td>\r\n</tr>\r\n<tr>\r\n<td style=\"height: 10px;\">Das Einzelzimmer</td>\r\n<td style=\"height: 10px; text-align: center;\">249,00 PLN</td>\r\n<td style=\"height: 10px; text-align: center;\">279,00 PLN</td>\r\n<td style=\"height: 10px; text-align: center;\">319,00 PLN</td>\r\n</tr>\r\n<tr>\r\n<td style=\"height: 10px;\">Das Doppelzimmer</td>\r\n<td style=\"height: 10px; text-align: center;\">319,00 PLN</td>\r\n<td style=\"height: 10px; text-align: center;\">339,00 PLN</td>\r\n<td style=\"height: 10px; text-align: center;\">369,00 PLN</td>\r\n</tr>\r\n<tr>\r\n<td style=\"height: 10px;\">Das DE LUX-Zimmer</td>\r\n<td style=\"height: 10px; text-align: center;\">399,00 PLN</td>\r\n<td style=\"height: 10px; text-align: center;\">419,00 PLN</td>\r\n<td style=\"height: 10px; text-align: center;\">449,00 PLN</td>\r\n</tr>\r\n<tr>\r\n<td colspan=\"4\">\r\n<p>&nbsp;</p>\r\n<p>Das Fr&uuml;hst&uuml;ck 36 PLN</p>\r\n<p>Zustellbett 50 PLN (nur f&uuml;r Kinder&nbsp; unter 16 Ledensjahr)</p>\r\n<p>Rent exklusive Kamin salle 50 PLN/h</p>\r\n<p>&nbsp; coffie service 32 PLN/person</p>\r\n<p>Profesional Konfferenc salle 50 PLN/h</p>\r\n<p>&nbsp; coffie service 32 PLN/person</p>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<table style=\"height: 36px;\" width=\"440\">\r\n<tbody>\r\n<tr>\r\n<td style=\"height: 12px;\">\r\n<p>&nbsp;</p>\r\n<p>Messe I</p>\r\n<p>Tour Salon, Poleko</p>\r\n<p>&nbsp;</p>\r\n</td>\r\n<td style=\"height: 12px;\">\r\n<p>&nbsp;</p>\r\n<p>Messe II</p>\r\n<p>Polagra, Budma, CEDE</p>\r\n<p>&nbsp;</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td style=\"height: 12px;\">\r\n<p>Alle Preise inkl. MwSt.</p>\r\n<p>Kostenfreies W-Lan.</p>\r\n<p>Alle Zimmer klimatisiert.</p>\r\n</td>\r\n<td style=\"height: 12px;\">&nbsp;<img style=\"display: block; margin-left: auto; margin-right: auto;\" src=\"http://localhost/commhotel/files/medias/image/visa.png\" alt=\"\" width=\"61\" height=\"79\" /></td>\r\n</tr>\r\n</tbody>\r\n</table>',	108,	'Y'),
(52,	'Der Garten',	'<p>Unser Garten ist eine kleine gr&uuml;ne Oase inmitten der Stadt, wo man an einem sch&ouml;nen Sommertag mit der Natur Kontakt haben kann. Das beruhigende Rauschen des Wasser, das Gezwitscher der V&ouml;gel und duftende Blumen- hier l&auml;sst am besten entspannen. Sie k&ouml;nnen in unserem.</p>\r\n<p>Garten einen erfrischenden Drink genie&szlig;en aber auch, bei sch&ouml;nem Watter, fr&uuml;hst&uuml;cken, sich einen Lunch oder ein Abendessen servieren lassen.</p>\r\n<p>Unser Garten regt zum angenegmen und ruhigen Berbrineg der Freizeit im Freien an. Beleuchtet von Garten laternen, mit einem Glas Wein, werden Sie bestimmt eine sch&ouml;ne Zeit verbringen.</p>',	109,	'Y'),
(53,	'Promotions',	'',	110,	'Y'),
(54,	'Kontakt',	'<p><span style=\"color: #947953;\"><strong>Comm Hotel</strong></span></p>\r\n<p>ul. Bukowska 348/350</p>\r\n<p>60-189 Poznań</p>\r\n<p>&nbsp;</p>\r\n<p>tel: +48 61 868 24 00</p>\r\n<p>tel: +48 61 868&nbsp;10 60</p>\r\n<p>tel: +48&nbsp;501 166 200</p>\r\n<p>fax:&nbsp;+48 61 624&nbsp;11&nbsp;00</p>\r\n<p>&nbsp;</p>\r\n<p>email: <a href=\"mailto:comm@comm-hotel.pl\" rel=\"prettyPhoto\">comm@comm-hotel.pl</a></p>',	111,	'N'),
(55,	'Main page',	'<p>Comm Hotel is located merely 100 meters from Ławica Airport, so it makes an ideal location, irrespective of how do you come to our charming city- by plane, by train or by car. It takes about two minutes of nice walk to reach the airport and the way to the city center or Poznań International Fair will not take more than 15 minutes.</p>\r\n<p>The hotel rooms are specially and uniquely designed, we combine posh design, functionality with latest technology.</p>\r\n<p>Our well-known restaurant serves delicious food and will satisfy even the most demanding gourments.</p>\r\n<p>You are welcome for a tasty breakfast buffet, which will guarantee you a successful day. A wide variety of cold and hot dishes is being served for breakfast: fresh fruit and vegetables, high quality meat and cheese cold cuts, eggs prepared as you wish, omelette variation, sausages, slices of smoked salmon, and eventually fresh pressed orange juice or aromatic coffee you can taste and smell every morning.</p>\r\n<p>Professional service and extraordinary family atmosphere will make the stay in our hotel unforgettable memory.</p>\r\n<p>You are more than welcome!</p>',	112,	'Y'),
(56,	'Billard room',	'<p>Created to make your time even more enjoyable club room is equipped with professional pool table, darts, plasma TV and comfortable armchairs.</p>\r\n<p>It is and ideal place to relax after of before travel. Located aside ensures privacy and burning fireplace creates an unforgettable atmosphere.</p>\r\n<p>Bartender would be happy to serve you a drink or aromatic cigar in the hall. In Billard room smoking is allowed.</p>',	114,	'Y'),
(57,	'Garden',	'<p>Our garden is the perfect place to relax in the shadow of umbrella, in a warm, summer day. Situated away from the hustle and bustle of the city, close to nature, where you can hear only the pleasant sound of running water and singing birds.</p>\r\n<p>Surrounded by greenery and fragrance of flowers you can enjoy a cool refreshing drink, or if the weather allows, on your request, in the garden, we will serve breakfast, lunch or dinner.</p>\r\n<p>It&rsquo;s also the perfect place to spend summer evening in the light of lanterns and a bottle of good wine.</p>',	115,	'Y'),
(58,	'Promotions',	'',	116,	'Y'),
(59,	'Contact',	'<p><span style=\"color: #947953;\"><strong>Comm Hotel</strong></span></p>\r\n<p>ul. Bukowska 348/350</p>\r\n<p>60-189 Poznań</p>\r\n<p>&nbsp;</p>\r\n<p>tel: +48 61 868 24 00</p>\r\n<p>tel: +48 61 868&nbsp;10 60</p>\r\n<p>tel: +48&nbsp;501 166 200</p>\r\n<p>fax:&nbsp;+48 61 624&nbsp;11&nbsp;00</p>\r\n<p>&nbsp;</p>\r\n<p>email: <a href=\"mailto:comm@comm-hotel.pl\" rel=\"prettyPhoto\">comm@comm-hotel.pl</a></p>',	117,	'N'),
(60,	'Price list',	'<table style=\"height: 98px;\" width=\"436\">\r\n<tbody>\r\n<tr>\r\n<td colspan=\"4\"><strong>Pokoje</strong></td>\r\n</tr>\r\n<tr>\r\n<td style=\"height: 10px;\">&nbsp;</td>\r\n<td style=\"height: 10px; text-align: center;\">&nbsp;</td>\r\n<td style=\"height: 10px; text-align: center;\">Targi I</td>\r\n<td style=\"height: 10px; text-align: center;\">Targi II</td>\r\n</tr>\r\n<tr>\r\n<td style=\"height: 10px;\">Single room</td>\r\n<td style=\"height: 10px; text-align: center;\">249,00 PLN</td>\r\n<td style=\"height: 10px; text-align: center;\">279,00 PLN</td>\r\n<td style=\"height: 10px; text-align: center;\">319,00 PLN</td>\r\n</tr>\r\n<tr>\r\n<td style=\"height: 10px;\">Double room</td>\r\n<td style=\"height: 10px; text-align: center;\">319,00 PLN</td>\r\n<td style=\"height: 10px; text-align: center;\">339,00 PLN</td>\r\n<td style=\"height: 10px; text-align: center;\">369,00 PLN</td>\r\n</tr>\r\n<tr>\r\n<td style=\"height: 10px;\">DE LUX room</td>\r\n<td style=\"height: 10px; text-align: center;\">399,00 PLN</td>\r\n<td style=\"height: 10px; text-align: center;\">419,00 PLN</td>\r\n<td style=\"height: 10px; text-align: center;\">449,00 PLN</td>\r\n</tr>\r\n<tr>\r\n<td colspan=\"4\">\r\n<p>&nbsp;</p>\r\n<p>Breakfast&nbsp;36 PLN</p>\r\n<p>Denture 50 PLN (for children up to 16 years old)</p>\r\n<p>Rent exclusive fireplace salle 50 PLN/h</p>\r\n<p>&nbsp; &nbsp;coffie service 32 PLN/person</p>\r\n<p>Professional Konfferenc room 50 PLN/h</p>\r\n<p>&nbsp; &nbsp;coffie service 32PLN/person</p>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<table style=\"height: 36px;\" width=\"440\">\r\n<tbody>\r\n<tr>\r\n<td style=\"height: 12px;\">\r\n<p>&nbsp;</p>\r\n<p>Fair rates I</p>\r\n<p>Tour Salon, Poleko</p>\r\n<p>&nbsp;</p>\r\n</td>\r\n<td style=\"height: 12px;\">\r\n<p>&nbsp;</p>\r\n<p>Fair rates II</p>\r\n<p>Polagra, Budma, CEDE</p>\r\n<p>&nbsp;</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td style=\"height: 12px;\">\r\n<p>The price includes:</p>\r\n<ul>\r\n<li>- VAT</li>\r\n<li>- free access to internet WI-FI</li>\r\n<li>- all rooms are equipped with air- conditioning.</li>\r\n</ul>\r\n</td>\r\n<td style=\"height: 12px;\">&nbsp;<img style=\"display: block; margin-left: auto; margin-right: auto;\" src=\"http://localhost/commhotel/files/medias/image/visa.png\" alt=\"\" width=\"61\" height=\"79\" /></td>\r\n</tr>\r\n</tbody>\r\n</table>',	119,	'Y'),
(61,	'Kontakt',	'<p><span style=\"color: #947953;\"><strong>Comm Hotel</strong></span></p>\r\n<p>ul. Bukowska 348/350</p>\r\n<p>60-189 Poznań</p>\r\n<p>&nbsp;</p>\r\n<p>tel: +48 61 868 24 00</p>\r\n<p>tel: +48 61 868&nbsp;10 60</p>\r\n<p>tel: +48&nbsp;501 166 200</p>\r\n<p>fax:&nbsp;+48 61 624&nbsp;11&nbsp;00</p>\r\n<p>&nbsp;</p>\r\n<p>email: <a href=\"mailto:comm@comm-hotel.pl\" rel=\"prettyPhoto\">comm@comm-hotel.pl</a></p>',	121,	'Y'),
(62,	'Contact',	'<p><span style=\"color: #947953;\"><strong>Comm Hotel</strong></span></p>\r\n<p>ul. Bukowska 348/350</p>\r\n<p>60-189 Poznań</p>\r\n<p>&nbsp;</p>\r\n<p>tel: +48 61 868 24 00</p>\r\n<p>tel: +48 61 868&nbsp;10 60</p>\r\n<p>tel: +48&nbsp;501 166 200</p>\r\n<p>fax:&nbsp;+48 61 624&nbsp;11&nbsp;00</p>\r\n<p>&nbsp;</p>\r\n<p>email: <a href=\"mailto:comm@comm-hotel.pl\" rel=\"prettyPhoto\">comm@comm-hotel.pl</a></p>',	122,	'Y'),
(63,	'Reservierung',	'<p>&nbsp;&nbsp;</p>',	129,	'Y'),
(64,	'Reservation',	'<p>&nbsp;&nbsp;</p>',	130,	'Y');

DROP TABLE IF EXISTS `partners`;
CREATE TABLE `partners` (
  `id_partner` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `description` text NOT NULL,
  `photo` varchar(255) NOT NULL,
  `date_added` int(20) NOT NULL,
  `modified_date` int(20) DEFAULT NULL,
  `available` enum('N','Y') NOT NULL DEFAULT 'Y',
  `web_address` varchar(255) NOT NULL,
  PRIMARY KEY (`id_partner`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `polls_answers`;
CREATE TABLE `polls_answers` (
  `id_answer` int(11) NOT NULL AUTO_INCREMENT,
  `question_id` int(11) NOT NULL,
  `language` char(20) DEFAULT 'pl_PL',
  `answer` varchar(255) NOT NULL,
  `votes` int(11) DEFAULT '0',
  PRIMARY KEY (`id_answer`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `polls_answers` (`id_answer`, `question_id`, `language`, `answer`, `votes`) VALUES
(1,	1,	'pl_PL',	'Tak',	3),
(2,	1,	'pl_PL',	'Nie',	0),
(3,	1,	'pl_PL',	'Nie wiem',	1),
(4,	2,	'pl_PL',	'asd',	0),
(5,	2,	'pl_PL',	'asd',	0),
(12,	4,	'pl_PL',	'fadsads',	0),
(11,	4,	'pl_PL',	'sfasdasd',	0),
(9,	5,	'pl_PL',	'asdasd',	0);

DROP TABLE IF EXISTS `polls_categories`;
CREATE TABLE `polls_categories` (
  `id_poll_category` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) NOT NULL,
  `element_id` int(11) NOT NULL,
  PRIMARY KEY (`id_poll_category`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `polls_questions`;
CREATE TABLE `polls_questions` (
  `id_question` int(11) NOT NULL AUTO_INCREMENT,
  `question` varchar(255) NOT NULL,
  `language` char(5) NOT NULL DEFAULT 'pl_PL',
  `date_added` bigint(20) NOT NULL,
  `start_date` int(10) unsigned DEFAULT NULL,
  `end_date` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id_question`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `polls_questions` (`id_question`, `question`, `language`, `date_added`, `start_date`, `end_date`) VALUES
(1,	'Czy podoba Ci się ta strona?',	'pl_PL',	1311943290,	NULL,	NULL),
(2,	'asd',	'pl_PL',	1403690114,	NULL,	NULL),
(4,	'sffasdasd',	'pl_PL',	1403701698,	0,	0),
(5,	'asdasd',	'pl_PL',	1403701760,	NULL,	NULL);

DROP TABLE IF EXISTS `polls_questions_to_categories`;
CREATE TABLE `polls_questions_to_categories` (
  `id_poll_question_to_categories` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `poll_category_id` int(11) NOT NULL,
  `poll_question_id` int(11) NOT NULL,
  `active` enum('N','Y') DEFAULT 'N',
  PRIMARY KEY (`id_poll_question_to_categories`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `polls_questions_to_categories` (`id_poll_question_to_categories`, `poll_category_id`, `poll_question_id`, `active`) VALUES
(1,	1,	1,	'Y'),
(2,	2,	2,	'Y'),
(4,	4,	4,	'Y'),
(5,	4,	5,	'N');

DROP TABLE IF EXISTS `polls_voters`;
CREATE TABLE `polls_voters` (
  `question_id` int(10) unsigned NOT NULL,
  `answer_id` int(10) unsigned NOT NULL,
  `ip` char(15) NOT NULL,
  `mac` char(32) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `polls_voters` (`question_id`, `answer_id`, `ip`, `mac`) VALUES
(1,	1,	'127.0.0.1',	''),
(1,	1,	'192.168.16.78',	''),
(1,	3,	'192.168.16.77',	''),
(1,	1,	'::1',	'');

DROP TABLE IF EXISTS `shop_attributes`;
CREATE TABLE `shop_attributes` (
  `id_attribute` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `position` int(10) unsigned NOT NULL,
  `active` enum('Y','N') CHARACTER SET latin1 NOT NULL DEFAULT 'Y',
  PRIMARY KEY (`id_attribute`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `shop_attributes` (`id_attribute`, `position`, `active`) VALUES
(7,	0,	'Y'),
(4,	0,	'Y'),
(8,	0,	'N');

DROP TABLE IF EXISTS `shop_attributes_description`;
CREATE TABLE `shop_attributes_description` (
  `attribute_id` int(10) unsigned NOT NULL,
  `attribute_name` varchar(128) NOT NULL,
  `attribute_language` char(5) NOT NULL DEFAULT 'pl_PL'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `shop_attributes_description` (`attribute_id`, `attribute_name`, `attribute_language`) VALUES
(7,	'Rozmiar',	'pl_PL'),
(4,	'Kolor',	'pl_PL'),
(8,	'test',	'pl_PL');

DROP TABLE IF EXISTS `shop_attributes_values`;
CREATE TABLE `shop_attributes_values` (
  `id_attribute_value` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `attribute_id` int(10) unsigned NOT NULL,
  `position` int(10) unsigned NOT NULL,
  `default` enum('N','Y') CHARACTER SET latin1 NOT NULL DEFAULT 'N',
  `active` enum('Y','N') CHARACTER SET latin1 NOT NULL DEFAULT 'Y',
  PRIMARY KEY (`id_attribute_value`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `shop_attributes_values` (`id_attribute_value`, `attribute_id`, `position`, `default`, `active`) VALUES
(10,	3,	0,	'N',	'Y'),
(11,	3,	0,	'N',	'Y'),
(12,	3,	0,	'N',	'Y'),
(13,	3,	0,	'N',	'Y'),
(14,	3,	0,	'N',	'Y'),
(15,	3,	0,	'N',	'Y'),
(16,	3,	0,	'N',	'Y'),
(17,	3,	0,	'N',	'Y'),
(18,	3,	0,	'N',	'N'),
(19,	3,	0,	'N',	'N'),
(20,	3,	0,	'N',	'N'),
(29,	5,	0,	'N',	'Y'),
(30,	5,	0,	'N',	'Y'),
(26,	4,	0,	'Y',	'Y'),
(25,	4,	0,	'N',	'Y'),
(31,	5,	0,	'N',	'Y'),
(32,	6,	0,	'Y',	'Y'),
(33,	6,	0,	'N',	'Y'),
(38,	7,	0,	'N',	'Y'),
(35,	6,	0,	'N',	'Y'),
(36,	6,	0,	'N',	'Y'),
(37,	6,	0,	'N',	'Y'),
(39,	7,	0,	'N',	'Y'),
(40,	7,	0,	'N',	'Y'),
(41,	7,	0,	'N',	'Y'),
(42,	8,	0,	'N',	'Y'),
(43,	8,	0,	'N',	'Y'),
(44,	8,	0,	'N',	'Y');

DROP TABLE IF EXISTS `shop_attributes_values_additional`;
CREATE TABLE `shop_attributes_values_additional` (
  `attribute_value_id` int(10) NOT NULL,
  `attribute_color` varchar(255) NOT NULL,
  `attribute_pattern` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `shop_attributes_values_additional` (`attribute_value_id`, `attribute_color`, `attribute_pattern`) VALUES
(11,	'0313FF',	''),
(10,	'FF0A0A',	''),
(12,	'000000',	''),
(26,	'33FF47',	''),
(25,	'FF14D8',	''),
(37,	'FFFFFF',	''),
(32,	'FFFFFF',	'');

DROP TABLE IF EXISTS `shop_attributes_values_description`;
CREATE TABLE `shop_attributes_values_description` (
  `attribute_value_id` int(10) unsigned NOT NULL,
  `attribute_value` varchar(255) NOT NULL,
  `attribute_value_language` char(5) NOT NULL DEFAULT 'pl_PL'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `shop_attributes_values_description` (`attribute_value_id`, `attribute_value`, `attribute_value_language`) VALUES
(10,	'Czerwony',	'pl_PL'),
(11,	'niebieski',	'pl_PL'),
(12,	'Czarnuszy',	'pl_PL'),
(20,	'Zielony',	'pl_PL'),
(26,	'Słomki niebieskie',	'pl_PL'),
(25,	'Różowy',	'pl_PL'),
(27,	'Niga black',	'pl_PL'),
(28,	'Snowflake white',	'pl_PL'),
(10,	'Indian red',	'en_US'),
(29,	'S',	'pl_PL'),
(30,	'L',	'pl_PL'),
(31,	'XL',	'pl_PL'),
(32,	'1',	'pl_PL'),
(33,	'2',	'pl_PL'),
(38,	'XL',	'pl_PL'),
(35,	'4',	'pl_PL'),
(36,	'5',	'pl_PL'),
(37,	'XL',	'pl_PL'),
(39,	'L',	'pl_PL'),
(40,	'M',	'pl_PL'),
(41,	'S',	'pl_PL'),
(42,	'a',	'pl_PL'),
(43,	'b',	'pl_PL'),
(44,	'c',	'pl_PL');

DROP TABLE IF EXISTS `shop_categories`;
CREATE TABLE `shop_categories` (
  `id_category` int(10) NOT NULL AUTO_INCREMENT,
  `parent_category_id` int(10) DEFAULT NULL,
  `level` int(10) unsigned DEFAULT NULL,
  `image_filename` varchar(128) DEFAULT NULL,
  `image_filename_hover` varchar(128) DEFAULT NULL,
  `banner` varchar(128) DEFAULT NULL,
  `position` int(10) NOT NULL DEFAULT '0',
  `active` enum('Y','N') DEFAULT 'Y',
  PRIMARY KEY (`id_category`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `shop_categories` (`id_category`, `parent_category_id`, `level`, `image_filename`, `image_filename_hover`, `banner`, `position`, `active`) VALUES
(42,	0,	1,	NULL,	NULL,	NULL,	0,	'Y'),
(43,	0,	1,	NULL,	NULL,	NULL,	0,	'Y'),
(44,	42,	2,	NULL,	NULL,	NULL,	0,	'Y');

DROP TABLE IF EXISTS `shop_categories_description`;
CREATE TABLE `shop_categories_description` (
  `category_id` int(10) unsigned NOT NULL,
  `category_name` varchar(128) NOT NULL,
  `category_language` char(5) NOT NULL DEFAULT 'pl_PL'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `shop_categories_description` (`category_id`, `category_name`, `category_language`) VALUES
(43,	'test2',	'pl_PL'),
(44,	'podkategoria',	'pl_PL'),
(42,	'test',	'pl_PL');

DROP TABLE IF EXISTS `shop_configuration`;
CREATE TABLE `shop_configuration` (
  `id_configuration` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(255) NOT NULL DEFAULT '',
  `value` text NOT NULL,
  `name` varchar(255) NOT NULL,
  `desc` varchar(255) NOT NULL DEFAULT '',
  `group` varchar(255) NOT NULL DEFAULT '',
  `type` varchar(64) NOT NULL DEFAULT 'text',
  PRIMARY KEY (`id_configuration`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `shop_configuration` (`id_configuration`, `key`, `value`, `name`, `desc`, `group`, `type`) VALUES
(7,	'voucher',	'1',	'Możliwość dodania produktu vouchera',	'',	'',	'integer'),
(2,	'rebates_codes',	'1',	'Kody rabatowe',	'Kody rabatowe',	'',	'integer'),
(3,	'one_step_order',	'0',	'Zamówienie na jednym kroku',	'0 - cztero krokowy, 1 - dwu krokowy',	'',	'integer'),
(4,	'product_like',	'0',	'Przycisk Lubię to na produktach',	'',	'',	'integer'),
(5,	'ask_for_product',	'1',	'Możliwość zapytania o produkt',	'',	'',	'integer'),
(6,	'no_cart_var',	'1',	'Brak przycisku koszyka gdy varianty',	'Na liście produktów nie jest wyświetlany przycisk dodaj do koszyka gdy produkt ma varianty',	'',	'integer');

DROP TABLE IF EXISTS `shop_currencies`;
CREATE TABLE `shop_currencies` (
  `id_currency` int(11) NOT NULL AUTO_INCREMENT,
  `currency_name` varchar(255) NOT NULL,
  `currency_code` varchar(255) NOT NULL,
  `currency_unit` int(11) DEFAULT NULL,
  `currency_factor` decimal(10,4) NOT NULL,
  `currency_active` enum('Y','N') NOT NULL DEFAULT 'Y',
  `currency_default` enum('Y','N') NOT NULL DEFAULT 'N',
  KEY `id_currency` (`id_currency`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `shop_currencies` (`id_currency`, `currency_name`, `currency_code`, `currency_unit`, `currency_factor`, `currency_active`, `currency_default`) VALUES
(1,	'Polski złoty',	'zł',	1,	1.0000,	'Y',	'Y');

DROP TABLE IF EXISTS `shop_customers`;
CREATE TABLE `shop_customers` (
  `id_customer` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `gender` enum('F','M') DEFAULT NULL,
  `customer_password` varchar(128) DEFAULT NULL,
  `customer_email` varchar(128) NOT NULL,
  `customer_first_name` varchar(128) NOT NULL,
  `customer_last_name` varchar(128) NOT NULL,
  `customer_company_name` varchar(255) DEFAULT NULL,
  `customer_nip` char(24) DEFAULT NULL,
  `customer_city` varchar(128) DEFAULT NULL,
  `customer_zip` char(6) DEFAULT NULL,
  `customer_address` varchar(255) DEFAULT NULL,
  `customer_state` varchar(255) DEFAULT NULL,
  `customer_country` varchar(255) DEFAULT NULL,
  `customer_www` varchar(255) DEFAULT NULL,
  `customer_phoneno` varchar(64) DEFAULT NULL,
  `customer_faxno` varchar(64) DEFAULT NULL,
  `customer_mobileno` varchar(64) DEFAULT NULL,
  `customer_type` varchar(64) DEFAULT NULL,
  `delivery_email` varchar(128) NOT NULL,
  `delivery_first_name` varchar(128) NOT NULL,
  `delivery_last_name` varchar(128) NOT NULL,
  `delivery_company_name` varchar(255) DEFAULT NULL,
  `delivery_nip` char(24) DEFAULT NULL,
  `delivery_city` varchar(128) DEFAULT NULL,
  `delivery_zip` char(6) DEFAULT NULL,
  `delivery_address` varchar(255) DEFAULT NULL,
  `delivery_state` varchar(255) DEFAULT NULL,
  `delivery_country` varchar(255) DEFAULT NULL,
  `delivery_www` varchar(255) DEFAULT NULL,
  `delivery_phoneno` varchar(64) DEFAULT NULL,
  `delivery_faxno` varchar(64) DEFAULT NULL,
  `delivery_mobileno` varchar(64) DEFAULT NULL,
  `invoice_email` varchar(128) NOT NULL,
  `invoice_first_name` varchar(128) NOT NULL,
  `invoice_last_name` varchar(128) NOT NULL,
  `invoice_company_name` varchar(255) DEFAULT NULL,
  `invoice_nip` char(24) DEFAULT NULL,
  `invoice_city` varchar(128) DEFAULT NULL,
  `invoice_zip` char(6) DEFAULT NULL,
  `invoice_address` varchar(255) DEFAULT NULL,
  `invoice_state` varchar(255) DEFAULT NULL,
  `invoice_country` varchar(255) DEFAULT NULL,
  `invoice_www` varchar(255) DEFAULT NULL,
  `invoice_phoneno` varchar(64) DEFAULT NULL,
  `invoice_faxno` varchar(64) DEFAULT NULL,
  `invoice_mobileno` varchar(64) DEFAULT NULL,
  `customer_rebate` int(10) unsigned DEFAULT '0',
  `verify_string` varchar(128) DEFAULT NULL,
  `verified` enum('N','Y') NOT NULL DEFAULT 'N',
  `points` int(10) unsigned DEFAULT NULL,
  `active` enum('N','Y') DEFAULT 'Y',
  `accept_terms` tinyint(4) NOT NULL DEFAULT '0',
  `accept_terms2` tinyint(4) NOT NULL DEFAULT '0',
  `accept_terms3` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_customer`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `shop_customers` (`id_customer`, `gender`, `customer_password`, `customer_email`, `customer_first_name`, `customer_last_name`, `customer_company_name`, `customer_nip`, `customer_city`, `customer_zip`, `customer_address`, `customer_state`, `customer_country`, `customer_www`, `customer_phoneno`, `customer_faxno`, `customer_mobileno`, `customer_type`, `delivery_email`, `delivery_first_name`, `delivery_last_name`, `delivery_company_name`, `delivery_nip`, `delivery_city`, `delivery_zip`, `delivery_address`, `delivery_state`, `delivery_country`, `delivery_www`, `delivery_phoneno`, `delivery_faxno`, `delivery_mobileno`, `invoice_email`, `invoice_first_name`, `invoice_last_name`, `invoice_company_name`, `invoice_nip`, `invoice_city`, `invoice_zip`, `invoice_address`, `invoice_state`, `invoice_country`, `invoice_www`, `invoice_phoneno`, `invoice_faxno`, `invoice_mobileno`, `customer_rebate`, `verify_string`, `verified`, `points`, `active`, `accept_terms`, `accept_terms2`, `accept_terms3`) VALUES
(29,	NULL,	'*F2651DAB851BC94D1C6E3F08C9C68E89C0AF4484',	'hubert@olicom.pl',	'test',	'testt',	'',	'',	'Poznań',	'60-160',	'test 5',	'',	'Polska',	'',	'555666777',	'',	'',	'1',	'',	'',	'',	'',	'',	'',	'',	'',	'',	'',	'',	'',	'',	'',	'',	'',	'',	'',	'',	'',	'',	'',	'',	'',	'',	'',	'',	'',	10,	'f81e9a851ace2154ebfe015200eaba4b',	'N',	NULL,	'Y',	1,	1,	0),
(37,	NULL,	'*AA1420F182E88B9E5F874F6FBE7459291E8F4601',	'andrzej@olicom.pl',	'Andrzej',	'Kołbuc',	NULL,	NULL,	'Poznań',	'68-685',	'cicha 1/s',	NULL,	'Polska',	NULL,	'790509605',	NULL,	NULL,	'1',	'',	'',	'',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'',	'',	'',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	0,	'e02ffe2ce989c35447fcac862f13d1c3',	'Y',	NULL,	'Y',	1,	1,	0);

DROP TABLE IF EXISTS `shop_customers_clipboard`;
CREATE TABLE `shop_customers_clipboard` (
  `id_clipboard` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `customer_id` int(10) unsigned NOT NULL,
  `product_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id_clipboard`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `shop_customers_subscriptions`;
CREATE TABLE `shop_customers_subscriptions` (
  `id_shop_customers_subscription` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `customer_id` int(255) DEFAULT NULL,
  `subscription_id` int(64) DEFAULT NULL,
  `subscription_added` int(64) DEFAULT NULL,
  `start_time` int(64) DEFAULT NULL,
  `subscription_duration` int(64) DEFAULT NULL,
  `end_time` int(64) DEFAULT NULL,
  `active` enum('N','Y') DEFAULT 'Y',
  `confirmed` enum('N','Y') DEFAULT 'N',
  `token` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`id_shop_customers_subscription`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `shop_delivery_ranges`;
CREATE TABLE `shop_delivery_ranges` (
  `id_shop_delivery_ranges` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `range_from` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT 'zawarta',
  `range_to` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT 'niezawarta',
  `delivery_price` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `delivery_type_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id_shop_delivery_ranges`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `shop_delivery_ranges` (`id_shop_delivery_ranges`, `range_from`, `range_to`, `delivery_price`, `delivery_type_id`) VALUES
(1,	1.00,	99999999.00,	25.00,	5),
(2,	1.00,	99999999.00,	7.00,	6),
(3,	1.00,	10000.00,	15.00,	7);

DROP TABLE IF EXISTS `shop_delivery_types`;
CREATE TABLE `shop_delivery_types` (
  `id_delivery_type` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `active` enum('Y','N') DEFAULT 'Y',
  `cash_on_delivery` tinyint(4) NOT NULL DEFAULT '0' COMMENT '1 za pobraniem',
  PRIMARY KEY (`id_delivery_type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `shop_delivery_types` (`id_delivery_type`, `active`, `cash_on_delivery`) VALUES
(5,	'Y',	0),
(6,	'Y',	0),
(7,	'Y',	0),
(10,	'N',	0);

DROP TABLE IF EXISTS `shop_delivery_types_description`;
CREATE TABLE `shop_delivery_types_description` (
  `delivery_type_id` int(10) unsigned NOT NULL,
  `delivery_type` varchar(255) NOT NULL,
  `delivery_type_language` char(5) DEFAULT 'pl_PL'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `shop_delivery_types_description` (`delivery_type_id`, `delivery_type`, `delivery_type_language`) VALUES
(5,	'Kurier',	'pl_PL'),
(6,	'Poczta Polska',	'pl_PL'),
(7,	'carrier',	'en_US'),
(10,	'ghjfd',	'pl_PL');

DROP TABLE IF EXISTS `shop_favourites_customers_products`;
CREATE TABLE `shop_favourites_customers_products` (
  `customer_id` int(10) unsigned NOT NULL,
  `product_id` int(10) unsigned NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `shop_measurement_units`;
CREATE TABLE `shop_measurement_units` (
  `id_measurement_unit` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `active` enum('Y','N') NOT NULL DEFAULT 'Y',
  PRIMARY KEY (`id_measurement_unit`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `shop_measurement_units_description`;
CREATE TABLE `shop_measurement_units_description` (
  `measurement_unit_id` int(10) unsigned NOT NULL,
  `measurement_language` char(5) NOT NULL,
  `measurement_name` varchar(128) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `shop_orders`;
CREATE TABLE `shop_orders` (
  `id_order` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `order_number` varchar(64) DEFAULT NULL,
  `current_number` int(11) DEFAULT NULL,
  `current_number_year` int(11) DEFAULT NULL,
  `current_number_month` int(11) DEFAULT NULL,
  `current_number_day` int(11) DEFAULT NULL,
  `client_id` int(10) unsigned NOT NULL,
  `order_date` char(20) NOT NULL,
  `status_id` int(10) unsigned NOT NULL,
  `payment_type` int(11) NOT NULL,
  `payment_cost` double(10,2) DEFAULT '0.00',
  `clients_note` text NOT NULL,
  `products_cost` double(10,2) unsigned NOT NULL DEFAULT '0.00',
  `delivery_type` int(10) unsigned DEFAULT NULL,
  `delivery_cost` double(10,2) DEFAULT '0.00',
  `additional_cost` double(10,2) unsigned DEFAULT '0.00',
  `order_cost` double(10,2) unsigned NOT NULL DEFAULT '0.00',
  `invoice` enum('N','Y') DEFAULT 'N',
  `confirmation` enum('N','Y') DEFAULT 'N',
  `confirmation_date` char(20) DEFAULT NULL,
  `paid` enum('N','Y') DEFAULT 'N',
  `closed` enum('N','Y') DEFAULT 'N',
  `client_ip` char(15) DEFAULT NULL,
  `seller_note` text,
  `customer_note` text,
  `confirm_email` varchar(128) DEFAULT NULL,
  `confirm_string` varchar(64) DEFAULT NULL,
  `confirmed` enum('N','Y') DEFAULT 'N',
  `session_id` char(64) NOT NULL,
  `lang` char(5) NOT NULL DEFAULT 'pl_PL',
  `p24_return_status` varchar(128) DEFAULT '',
  `p24_order_id` varchar(10) DEFAULT '',
  `delivery_comments` varchar(255) DEFAULT NULL,
  `currency` varchar(255) NOT NULL DEFAULT 'PLN',
  `factor` decimal(10,4) NOT NULL,
  `rebate_code` varchar(255) DEFAULT NULL,
  `rebate_value` int(4) unsigned DEFAULT NULL,
  `rebate_cost` decimal(10,2) unsigned DEFAULT NULL,
  `customer_rebate` int(10) unsigned DEFAULT NULL,
  `protection` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id_order`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED;

INSERT INTO `shop_orders` (`id_order`, `order_number`, `current_number`, `current_number_year`, `current_number_month`, `current_number_day`, `client_id`, `order_date`, `status_id`, `payment_type`, `payment_cost`, `clients_note`, `products_cost`, `delivery_type`, `delivery_cost`, `additional_cost`, `order_cost`, `invoice`, `confirmation`, `confirmation_date`, `paid`, `closed`, `client_ip`, `seller_note`, `customer_note`, `confirm_email`, `confirm_string`, `confirmed`, `session_id`, `lang`, `p24_return_status`, `p24_order_id`, `delivery_comments`, `currency`, `factor`, `rebate_code`, `rebate_value`, `rebate_cost`, `customer_rebate`, `protection`) VALUES
(116,	'1/2015/11/09',	1,	2015,	11,	9,	0,	'1447069218',	1,	1,	0.00,	'',	123.00,	6,	7.00,	0.00,	130.00,	'N',	'N',	NULL,	'N',	'N',	'::1',	NULL,	'sdsd',	'andrzej@olicom.pl',	'b454449511184c3ac3dca6e9644e3440',	'N',	'',	'pl_PL',	'',	'',	NULL,	'zł',	1.0000,	NULL,	NULL,	0.00,	NULL,	'0'),
(117,	'2/2015/11/09',	2,	2015,	11,	9,	0,	'1447069555',	1,	1,	0.00,	'',	123.00,	6,	7.00,	0.00,	130.00,	'N',	'N',	NULL,	'N',	'N',	'::1',	NULL,	'12312',	'andrzej@olicom.pl',	'58205413adc08cb2fa9b95073c01a72b',	'N',	'117|1447069556',	'pl_PL',	'',	'',	NULL,	'zł',	1.0000,	NULL,	NULL,	0.00,	NULL,	'0'),
(118,	'3/2015/11/09',	3,	2015,	11,	9,	37,	'1447070374',	1,	1,	0.00,	'',	4492.00,	6,	7.00,	0.00,	4499.00,	'N',	'N',	NULL,	'N',	'N',	'::1',	NULL,	'1212',	'andrzej@olicom.pl',	'9c9b352d8093d23797b4893fc5fac786',	'N',	'118|1447070375',	'pl_PL',	'',	'',	'asdasdas',	'zł',	1.0000,	NULL,	NULL,	0.00,	NULL,	'0'),
(119,	'1/2015/11/10',	1,	2015,	11,	10,	37,	'1447139704',	1,	9,	5.00,	'',	1000.00,	6,	7.00,	0.00,	1007.00,	'N',	'N',	NULL,	'N',	'N',	'::1',	NULL,	'',	'andrzej@olicom.pl',	'88a0021d9a1d4fea402cca158e36d496',	'N',	'119|1447139705',	'pl_PL',	'',	'',	NULL,	'zł',	1.0000,	NULL,	NULL,	0.00,	NULL,	'0'),
(120,	'2/2015/11/10',	2,	2015,	11,	10,	37,	'1447140057',	1,	9,	5.00,	'',	123.00,	6,	7.00,	0.00,	130.00,	'N',	'N',	NULL,	'N',	'N',	'::1',	NULL,	'',	'andrzej@olicom.pl',	'cbd03a087402feef425fa4877ad22d64',	'N',	'120|1447140063',	'pl_PL',	'',	'',	NULL,	'zł',	1.0000,	NULL,	NULL,	0.00,	NULL,	'0'),
(121,	'3/2015/11/10',	3,	2015,	11,	10,	37,	'1447140320',	1,	9,	5.00,	'',	500.00,	6,	7.00,	0.00,	507.00,	'N',	'N',	NULL,	'N',	'N',	'::1',	NULL,	'',	'andrzej@olicom.pl',	'133c4d40e81dc063cb89021953088e60',	'N',	'121|1447140335',	'pl_PL',	'',	'',	NULL,	'zł',	1.0000,	NULL,	NULL,	0.00,	NULL,	'0'),
(122,	'4/2015/11/10',	4,	2015,	11,	10,	37,	'1447140363',	1,	9,	5.00,	'',	111.00,	6,	7.00,	0.00,	118.00,	'N',	'N',	NULL,	'N',	'N',	'::1',	NULL,	'',	'andrzej@olicom.pl',	'6b0b4227beb30ac706be02236fc3ccfa',	'N',	'122|1447140364',	'pl_PL',	'',	'',	NULL,	'zł',	1.0000,	NULL,	NULL,	0.00,	NULL,	'0'),
(123,	'5/2015/11/10',	5,	2015,	11,	10,	0,	'1447144321',	1,	9,	5.00,	'',	500.00,	6,	7.00,	0.00,	507.00,	'N',	'N',	NULL,	'N',	'N',	'::1',	NULL,	'',	'przemek@olicom.pl',	'0b69d28f45ec13ea76129556685ee330',	'N',	'123|1447144323',	'pl_PL',	'',	'',	NULL,	'zł',	1.0000,	NULL,	NULL,	0.00,	NULL,	NULL),
(124,	'6/2015/11/10',	6,	2015,	11,	10,	0,	'1447149182',	1,	3,	0.00,	'',	111.00,	6,	7.00,	0.00,	118.00,	'N',	'N',	NULL,	'N',	'N',	'::1',	NULL,	'',	'przemek@olicom.pl',	'b4bc967590dc2ed322c5e769ca6cdbb3',	'N',	'124|1447149299',	'pl_PL',	'',	'',	NULL,	'zł',	1.0000,	NULL,	NULL,	0.00,	NULL,	NULL),
(125,	'7/2015/11/10',	7,	2015,	11,	10,	0,	'1447149408',	1,	8,	0.00,	'',	123.00,	5,	25.00,	0.00,	148.00,	'N',	'N',	NULL,	'N',	'N',	'::1',	NULL,	'',	'przemek@olicom.pl',	'5283c4048135d7c3f4d3bf24a209f162',	'N',	'125|1447160003',	'pl_PL',	'',	'',	NULL,	'zł',	1.0000,	NULL,	NULL,	0.00,	NULL,	NULL),
(126,	'1/2015/12/08',	1,	2015,	12,	8,	0,	'1449563175',	2,	1,	0.00,	'',	500.00,	6,	7.00,	0.00,	507.00,	'N',	'N',	NULL,	'N',	'N',	'::1',	NULL,	'',	'hubert@olicom.pl',	'd21bae081806d8ca5f1b2952c938616b',	'N',	'126|1449564140',	'pl_PL',	'',	'',	'',	'zł',	1.0000,	NULL,	NULL,	0.00,	NULL,	'0'),
(127,	'2/2015/12/08',	2,	2015,	12,	8,	0,	'1449564269',	2,	9,	5.00,	'',	500.00,	6,	7.00,	0.00,	507.00,	'N',	'N',	NULL,	'N',	'N',	'::1',	NULL,	'',	'hubert@olicom.pl',	'4f34d88c7e2b0d2c24578694b63a4c1a',	'N',	'127|1449564271',	'pl_PL',	'',	'',	'',	'zł',	1.0000,	NULL,	NULL,	0.00,	NULL,	'0'),
(128,	'3/2015/12/08',	3,	2015,	12,	8,	0,	'1449564610',	2,	9,	5.00,	'',	500.00,	6,	7.00,	0.00,	507.00,	'N',	'N',	NULL,	'N',	'N',	'::1',	NULL,	'',	'hubert@olicom.pl',	'9bb3181218073ae35dab8eec60305ee1',	'N',	'128|1449564611',	'pl_PL',	'',	'',	'',	'zł',	1.0000,	NULL,	NULL,	0.00,	NULL,	'0'),
(129,	'4/2015/12/08',	4,	2015,	12,	8,	0,	'1449564662',	1,	9,	5.00,	'',	500.00,	6,	7.00,	0.00,	507.00,	'N',	'N',	NULL,	'N',	'N',	'::1',	NULL,	'',	'hubert@olicom.pl',	'f351ab7ca2d5658697cfa34fc83d2df8',	'N',	'',	'pl_PL',	'',	'',	NULL,	'zł',	1.0000,	NULL,	NULL,	0.00,	NULL,	'0'),
(130,	'5/2015/12/08',	5,	2015,	12,	8,	0,	'1449566214',	1,	9,	5.00,	'',	500.00,	6,	7.00,	0.00,	507.00,	'N',	'N',	NULL,	'N',	'N',	'::1',	NULL,	'',	'hubert@olicom.pl',	'c7421df13b9dfb284ce4b29632d1d55e',	'N',	'',	'pl_PL',	'',	'',	NULL,	'zł',	1.0000,	NULL,	NULL,	0.00,	NULL,	'0'),
(131,	'6/2015/12/08',	6,	2015,	12,	8,	0,	'1449566240',	1,	9,	5.00,	'',	500.00,	6,	7.00,	0.00,	507.00,	'N',	'N',	NULL,	'N',	'N',	'::1',	NULL,	'',	'hubert@olicom.pl',	'20a1aa8d2724182770d1d8f8ad62b639',	'N',	'',	'pl_PL',	'',	'',	NULL,	'zł',	1.0000,	NULL,	NULL,	0.00,	NULL,	'0'),
(132,	'7/2015/12/08',	7,	2015,	12,	8,	0,	'1449566264',	2,	9,	5.00,	'',	500.00,	6,	7.00,	0.00,	507.00,	'N',	'N',	NULL,	'N',	'N',	'::1',	NULL,	'',	'hubert@olicom.pl',	'2d965116d50d59339a2f8387b3b18893',	'N',	'132|1449566355',	'pl_PL',	'',	'',	'',	'zł',	1.0000,	NULL,	NULL,	0.00,	NULL,	'0'),
(133,	'8/2015/12/08',	8,	2015,	12,	8,	0,	'1449573997',	1,	9,	5.00,	'',	500.00,	6,	7.00,	0.00,	507.00,	'N',	'N',	NULL,	'N',	'N',	'::1',	NULL,	'',	'hubert@olicom.pl',	'd4daf98185ec9e533b726d00b6bb8ca5',	'N',	'',	'pl_PL',	'',	'',	NULL,	'zł',	1.0000,	NULL,	NULL,	0.00,	NULL,	'0'),
(134,	'9/2015/12/08',	9,	2015,	12,	8,	0,	'1449574369',	1,	9,	5.00,	'',	500.00,	6,	7.00,	0.00,	507.00,	'N',	'N',	NULL,	'N',	'N',	'::1',	NULL,	'',	'hubert@olicom.pl',	'1c74934c9c4c598de7b31f5b88b64bea',	'N',	'134|1449574370',	'pl_PL',	'',	'',	NULL,	'zł',	1.0000,	NULL,	NULL,	0.00,	NULL,	'0'),
(135,	'10/2015/12/08',	10,	2015,	12,	8,	0,	'1449574524',	2,	1,	0.00,	'',	1000.00,	6,	7.00,	0.00,	1007.00,	'N',	'N',	NULL,	'N',	'N',	'::1',	NULL,	'',	'hubert@olicom.pl',	'2edcc657f5bb431ef5da3a997c02d726',	'N',	'135|1449574554',	'pl_PL',	'',	'',	'',	'zł',	1.0000,	NULL,	NULL,	0.00,	NULL,	'0');

DROP TABLE IF EXISTS `shop_orders_customers`;
CREATE TABLE `shop_orders_customers` (
  `order_id` int(10) unsigned NOT NULL,
  `customer_id` int(10) unsigned NOT NULL,
  `customer_email` varchar(128) NOT NULL,
  `customer_first_name` varchar(128) NOT NULL,
  `customer_last_name` varchar(128) NOT NULL,
  `customer_company_name` varchar(255) DEFAULT NULL,
  `customer_nip` char(32) DEFAULT NULL,
  `customer_city` varchar(128) DEFAULT NULL,
  `customer_zip` char(6) DEFAULT NULL,
  `customer_address` varchar(255) DEFAULT NULL,
  `customer_state` varchar(255) DEFAULT NULL,
  `customer_country` varchar(255) DEFAULT NULL,
  `customer_www` varchar(255) DEFAULT NULL,
  `customer_phoneno` varchar(64) DEFAULT NULL,
  `customer_faxno` varchar(64) DEFAULT NULL,
  `customer_mobileno` varchar(64) DEFAULT NULL,
  `customer_type` smallint(6) DEFAULT NULL,
  `delivery_email` varchar(128) NOT NULL,
  `delivery_first_name` varchar(128) NOT NULL,
  `delivery_last_name` varchar(128) NOT NULL,
  `delivery_company_name` varchar(255) DEFAULT NULL,
  `delivery_nip` char(32) DEFAULT NULL,
  `delivery_city` varchar(128) DEFAULT NULL,
  `delivery_zip` char(6) DEFAULT NULL,
  `delivery_address` varchar(255) DEFAULT NULL,
  `delivery_state` varchar(255) DEFAULT NULL,
  `delivery_country` varchar(255) DEFAULT NULL,
  `delivery_www` varchar(255) DEFAULT NULL,
  `delivery_phoneno` varchar(64) DEFAULT NULL,
  `delivery_faxno` varchar(64) DEFAULT NULL,
  `delivery_mobileno` varchar(64) DEFAULT NULL,
  `invoice_email` varchar(128) NOT NULL,
  `invoice_first_name` varchar(128) NOT NULL,
  `invoice_last_name` varchar(128) NOT NULL,
  `invoice_company_name` varchar(255) DEFAULT NULL,
  `invoice_nip` char(32) DEFAULT NULL,
  `invoice_city` varchar(128) DEFAULT NULL,
  `invoice_zip` char(6) DEFAULT NULL,
  `invoice_address` varchar(255) DEFAULT NULL,
  `invoice_state` varchar(255) DEFAULT NULL,
  `invoice_country` varchar(255) DEFAULT NULL,
  `invoice_www` varchar(255) DEFAULT NULL,
  `invoice_phoneno` varchar(64) DEFAULT NULL,
  `invoice_faxno` varchar(64) DEFAULT NULL,
  `invoice_mobileno` varchar(64) DEFAULT NULL,
  `invoice` enum('N','Y') DEFAULT 'N',
  `delivery` enum('N','Y') DEFAULT 'N',
  `accept_terms` tinyint(4) NOT NULL DEFAULT '0',
  `accept_terms2` tinyint(4) NOT NULL DEFAULT '0',
  `accept_terms3` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `shop_orders_customers` (`order_id`, `customer_id`, `customer_email`, `customer_first_name`, `customer_last_name`, `customer_company_name`, `customer_nip`, `customer_city`, `customer_zip`, `customer_address`, `customer_state`, `customer_country`, `customer_www`, `customer_phoneno`, `customer_faxno`, `customer_mobileno`, `customer_type`, `delivery_email`, `delivery_first_name`, `delivery_last_name`, `delivery_company_name`, `delivery_nip`, `delivery_city`, `delivery_zip`, `delivery_address`, `delivery_state`, `delivery_country`, `delivery_www`, `delivery_phoneno`, `delivery_faxno`, `delivery_mobileno`, `invoice_email`, `invoice_first_name`, `invoice_last_name`, `invoice_company_name`, `invoice_nip`, `invoice_city`, `invoice_zip`, `invoice_address`, `invoice_state`, `invoice_country`, `invoice_www`, `invoice_phoneno`, `invoice_faxno`, `invoice_mobileno`, `invoice`, `delivery`, `accept_terms`, `accept_terms2`, `accept_terms3`) VALUES
(135,	0,	'hubert@olicom.pl',	'hubert',	'test',	NULL,	NULL,	'Poznań',	'60-161',	'adres 55',	NULL,	'Polska',	NULL,	'123456789',	NULL,	NULL,	0,	'',	'',	'',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'',	'',	'',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'N',	'N',	0,	0,	0),
(134,	0,	'hubert@olicom.pl',	'hubert',	'test',	NULL,	NULL,	'Poznań',	'60-161',	'adres 55',	NULL,	'Polska',	NULL,	'123456789',	NULL,	NULL,	0,	'',	'',	'',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'',	'',	'',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'N',	'N',	0,	0,	0),
(133,	0,	'hubert@olicom.pl',	'hubert',	'test',	NULL,	NULL,	'Poznań',	'60-161',	'adres 55',	NULL,	'Polska',	NULL,	'123456789',	NULL,	NULL,	0,	'',	'',	'',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'',	'',	'',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'N',	'N',	0,	0,	0),
(132,	0,	'hubert@olicom.pl',	'hubert',	'test',	NULL,	NULL,	'Poznań',	'60-161',	'adres 55',	NULL,	'Polska',	NULL,	'123456789',	NULL,	NULL,	0,	'',	'',	'',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'',	'',	'',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'N',	'N',	0,	0,	0),
(131,	0,	'hubert@olicom.pl',	'hubert',	'test',	NULL,	NULL,	'Poznań',	'60-161',	'adres 55',	NULL,	'Polska',	NULL,	'123456789',	NULL,	NULL,	0,	'',	'',	'',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'',	'',	'',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'N',	'N',	0,	0,	0),
(130,	0,	'hubert@olicom.pl',	'hubert',	'test',	NULL,	NULL,	'Poznań',	'60-161',	'adres 55',	NULL,	'Polska',	NULL,	'123456789',	NULL,	NULL,	0,	'',	'',	'',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'',	'',	'',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'N',	'N',	0,	0,	0),
(129,	0,	'hubert@olicom.pl',	'hubert',	'test',	NULL,	NULL,	'Poznań',	'60-161',	'adres 55',	NULL,	'Polska',	NULL,	'123456789',	NULL,	NULL,	0,	'',	'',	'',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'',	'',	'',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'N',	'N',	0,	0,	0),
(128,	0,	'hubert@olicom.pl',	'hubert',	'test',	NULL,	NULL,	'Poznań',	'60-161',	'adres 55',	NULL,	'Polska',	NULL,	'123456789',	NULL,	NULL,	0,	'',	'',	'',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'',	'',	'',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'N',	'N',	0,	0,	0),
(127,	0,	'hubert@olicom.pl',	'hubert',	'test',	NULL,	NULL,	'Poznań',	'60-161',	'adres 55',	NULL,	'Polska',	NULL,	'123456789',	NULL,	NULL,	0,	'',	'',	'',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'',	'',	'',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'N',	'N',	0,	0,	0),
(126,	0,	'hubert@olicom.pl',	'hubert',	'test',	NULL,	NULL,	'Poznań',	'60-161',	'adres 55',	NULL,	'Polska',	NULL,	'123456789',	NULL,	NULL,	0,	'',	'',	'',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'',	'',	'',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'N',	'N',	0,	0,	0),
(125,	0,	'przemek@olicom.pl',	'testolicom',	'testolicom',	NULL,	NULL,	'testolicom',	'55555',	'sukmjnhbgvfcdasxsfv',	NULL,	'Polska',	NULL,	'555555555',	NULL,	NULL,	NULL,	'',	'',	'',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'',	'',	'',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'N',	'N',	0,	0,	0),
(124,	0,	'przemek@olicom.pl',	'testolicom',	'testolicom',	NULL,	NULL,	'testolicom',	'55555',	'sukmjnhbgvfcdasxsfv',	NULL,	'Polska',	NULL,	'555555555',	NULL,	NULL,	NULL,	'',	'',	'',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'',	'',	'',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'N',	'N',	0,	0,	0),
(123,	0,	'przemek@olicom.pl',	'testolicom',	'testolicom',	NULL,	NULL,	'testolicom',	'55555',	'aosdgyifsygfv',	NULL,	'Polska',	NULL,	'555555555',	NULL,	NULL,	NULL,	'',	'',	'',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'',	'',	'',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'N',	'N',	0,	0,	0),
(122,	37,	'andrzej@olicom.pl',	'Andrzej',	'qwerty',	NULL,	NULL,	'Poznań',	'68-685',	'cicha 1/s',	NULL,	'Polska',	NULL,	'123454321',	NULL,	NULL,	1,	'',	'',	'',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'',	'',	'',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'N',	'N',	0,	0,	0),
(121,	37,	'andrzej@olicom.pl',	'Andrzej',	'qwerty',	NULL,	NULL,	'Poznań',	'68-685',	'cicha 1/s',	NULL,	'Polska',	NULL,	'123454321',	NULL,	NULL,	1,	'',	'',	'',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'',	'',	'',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'N',	'N',	0,	0,	0),
(120,	37,	'andrzej@olicom.pl',	'Andrzej',	'qwerty',	NULL,	NULL,	'Poznań',	'68-685',	'cicha 1/s',	NULL,	'Polska',	NULL,	'123454321',	NULL,	NULL,	1,	'',	'',	'',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'',	'',	'',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'N',	'N',	0,	0,	0),
(119,	37,	'andrzej@olicom.pl',	'Andrzej',	'qwerty',	NULL,	NULL,	'Poznań',	'68-685',	'cicha 1/s',	NULL,	'Polska',	NULL,	'123412345',	NULL,	NULL,	1,	'',	'',	'',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'',	'',	'',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'N',	'N',	0,	0,	0),
(118,	37,	'andrzej@olicom.pl',	'Andrzej',	'qwerty',	NULL,	NULL,	'Poznań',	'68-685',	'cicha 1/s',	NULL,	'Polska',	NULL,	'123454321',	NULL,	NULL,	1,	'',	'',	'',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'',	'',	'',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'N',	'N',	0,	0,	0),
(117,	0,	'andrzej@olicom.pl',	'Andrzej',	'Kołbuc',	NULL,	NULL,	'12123',	'12312',	'123',	NULL,	'1231231',	NULL,	'123123123',	NULL,	NULL,	0,	'',	'',	'',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'',	'',	'',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'N',	'N',	0,	0,	0);

DROP TABLE IF EXISTS `shop_orders_products`;
CREATE TABLE `shop_orders_products` (
  `order_product_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` int(11) unsigned NOT NULL,
  `product_id` int(11) unsigned NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_attributes` varchar(255) NOT NULL,
  `product_variant_id` int(10) unsigned NOT NULL,
  `product_count` int(4) unsigned NOT NULL,
  `product_price` decimal(10,2) NOT NULL,
  `product_rebate` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`order_product_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `shop_orders_products` (`order_product_id`, `order_id`, `product_id`, `product_name`, `product_attributes`, `product_variant_id`, `product_count`, `product_price`, `product_rebate`) VALUES
(1,	117,	133,	'',	'',	0,	1,	123.00,	0),
(2,	118,	130,	'',	'',	0,	4,	1123.00,	0),
(3,	119,	132,	'',	'',	0,	2,	500.00,	0),
(4,	120,	133,	'',	'',	0,	1,	123.00,	0),
(5,	121,	132,	'',	'',	0,	1,	500.00,	0),
(6,	122,	131,	'',	'',	0,	1,	111.00,	0),
(7,	123,	132,	'',	'',	0,	1,	500.00,	0),
(8,	124,	131,	'',	'',	0,	1,	111.00,	0),
(9,	125,	133,	'',	'',	0,	1,	123.00,	0),
(10,	126,	132,	'',	'',	0,	1,	500.00,	0),
(11,	127,	132,	'',	'',	0,	1,	500.00,	0),
(12,	128,	132,	'',	'',	0,	1,	500.00,	0),
(13,	132,	132,	'',	'',	0,	1,	500.00,	0),
(14,	134,	132,	'',	'',	0,	1,	500.00,	0),
(15,	135,	132,	'',	'',	0,	2,	500.00,	0);

DROP TABLE IF EXISTS `shop_orders_statuses`;
CREATE TABLE `shop_orders_statuses` (
  `id_order_status` int(11) NOT NULL AUTO_INCREMENT,
  `order_status_name` varchar(128) NOT NULL,
  `language` char(5) DEFAULT 'pl_PL',
  PRIMARY KEY (`id_order_status`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `shop_orders_statuses` (`id_order_status`, `order_status_name`, `language`) VALUES
(1,	'nowe',	'pl_PL'),
(2,	'zapłacono',	'pl_PL'),
(3,	'w realizacji',	'pl_PL'),
(4,	'zrealizowano',	'pl_PL'),
(5,	'zamknięte',	'pl_PL');

DROP TABLE IF EXISTS `shop_parameters`;
CREATE TABLE `shop_parameters` (
  `id_parameter` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `active` enum('Y','N') NOT NULL DEFAULT 'Y',
  `position` int(10) unsigned NOT NULL,
  `show_on_list` enum('N','Y') DEFAULT 'N',
  `filter` enum('N','Y') DEFAULT 'N',
  `type` enum('product','category') DEFAULT 'product',
  PRIMARY KEY (`id_parameter`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `shop_parameters` (`id_parameter`, `active`, `position`, `show_on_list`, `filter`, `type`) VALUES
(10,	'Y',	0,	'N',	'N',	'category'),
(9,	'Y',	0,	'N',	'N',	'product'),
(8,	'Y',	0,	'N',	'N',	'product'),
(11,	'Y',	0,	'N',	'N',	'category');

DROP TABLE IF EXISTS `shop_parameters_description`;
CREATE TABLE `shop_parameters_description` (
  `parameter_id` int(10) unsigned NOT NULL,
  `parameter_name` varchar(255) NOT NULL,
  `parameter_language` char(5) DEFAULT 'pl_PL'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `shop_parameters_description` (`parameter_id`, `parameter_name`, `parameter_language`) VALUES
(9,	'System',	'pl_PL'),
(8,	'Rozdzielczość',	'pl_PL'),
(10,	'Aparat',	'pl_PL'),
(11,	'Pamięć',	'pl_PL');

DROP TABLE IF EXISTS `shop_parameters_to_categories`;
CREATE TABLE `shop_parameters_to_categories` (
  `parameter_id` int(10) unsigned NOT NULL,
  `category_id` int(10) unsigned NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `shop_parameters_to_categories` (`parameter_id`, `category_id`) VALUES
(9,	42),
(8,	43),
(8,	42),
(9,	43),
(10,	43),
(10,	42),
(11,	43),
(11,	42);

DROP TABLE IF EXISTS `shop_parameters_values`;
CREATE TABLE `shop_parameters_values` (
  `id_parameter_value` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parameter_id` int(10) unsigned NOT NULL,
  `parameter_value` varchar(255) NOT NULL,
  `active` enum('Y','N') DEFAULT 'Y',
  PRIMARY KEY (`id_parameter_value`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `shop_parameters_values` (`id_parameter_value`, `parameter_id`, `parameter_value`, `active`) VALUES
(16,	10,	'',	'Y'),
(15,	9,	'',	'Y'),
(14,	8,	'',	'Y'),
(17,	11,	'',	'Y');

DROP TABLE IF EXISTS `shop_payment_types`;
CREATE TABLE `shop_payment_types` (
  `id_payment_type` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `active` enum('Y','N') NOT NULL DEFAULT 'Y',
  `payment_cost` double(10,2) DEFAULT NULL,
  `payment_type_method` varchar(32) DEFAULT NULL,
  `auth_login` varchar(32) DEFAULT NULL,
  `auth_code` varchar(32) DEFAULT NULL,
  `auth_url` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_payment_type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `shop_payment_types` (`id_payment_type`, `active`, `payment_cost`, `payment_type_method`, `auth_login`, `auth_code`, `auth_url`) VALUES
(1,	'Y',	0.00,	NULL,	NULL,	NULL,	NULL),
(8,	'Y',	0.00,	'dotpay',	'728221',	'JORzQxD9XbfDxk1cectzJujOa6WSivu2',	'https://ssl.dotpay.pl/test_payment'),
(3,	'Y',	0.00,	'dotpay',	'fhjdhjdg',	'84651651',	'https://ssl.dotpay.pl'),
(7,	'N',	0.00,	'',	NULL,	NULL,	NULL),
(9,	'Y',	5.00,	'',	NULL,	NULL,	NULL);

DROP TABLE IF EXISTS `shop_payment_types_description`;
CREATE TABLE `shop_payment_types_description` (
  `payment_type_id` int(10) unsigned NOT NULL,
  `payment_type_name` varchar(255) NOT NULL,
  `payment_type_language` char(5) DEFAULT 'pl_PL',
  `payment_type_info` text
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `shop_payment_types_description` (`payment_type_id`, `payment_type_name`, `payment_type_language`, `payment_type_info`) VALUES
(1,	'Przelew na konto',	'pl_PL',	'PL  00 0000 0000 0000 0000 0000 0000<br/>Numer SWIFT banku: AAAAAAAA  -  jeśli płatność jest dokonywana z zagranicy<br/><br/>twoja firma<br/>ul. Ulica 1<br/>00-000 Miasto<br/><br/><strong>W tytule proszę wpisać numer zamówienia, oraz swoje imię i nazwisko.</strong>'),
(8,	'dotpay test',	'pl_PL',	NULL),
(3,	'Dotpay',	'pl_PL',	NULL),
(7,	'aaa',	'pl_PL',	'<p>PL 00 4444 5555 5555 6666 6666 8888<br />Numer SWIFT banku: AAAAAAAA - jeśli płatność jest dokonywana z zagranicy<br /><br />twoja firma<br />ul. Ulica 1<br />00-000 Miasto<br /><br /><strong>W tytule proszę wpisać numer zam&oacute;wienia, oraz swoje imię i nazwisko.</strong></p>'),
(9,	'wrtsxdfvc',	'pl_PL',	'<p>etgsdbxfvf</p>\r\n<p>snhv&nbsp;</p>\r\n<p>35yh1n+65</p>\r\n<p>d65hn41</p>\r\n<p>6351</p>\r\n<p>d6f5n41m</p>\r\n<p>c6v5n1m</p>\r\n<p>6g5h14</p>');

DROP TABLE IF EXISTS `shop_producers`;
CREATE TABLE `shop_producers` (
  `id_producer` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `producer_name` varchar(255) NOT NULL,
  `producer_logo` varchar(255) DEFAULT NULL,
  `position` int(10) NOT NULL DEFAULT '0',
  `active` enum('Y','N') CHARACTER SET latin1 DEFAULT 'Y',
  `rebate` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id_producer`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `shop_producers` (`id_producer`, `producer_name`, `producer_logo`, `position`, `active`, `rebate`) VALUES
(11,	'Olicom',	'olicom-logo.png',	1,	'Y',	NULL);

DROP TABLE IF EXISTS `shop_products`;
CREATE TABLE `shop_products` (
  `id_product` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `price` decimal(10,2) NOT NULL,
  `net_price` decimal(10,2) NOT NULL,
  `tax_id` int(11) DEFAULT NULL,
  `promotion_price` decimal(10,2) DEFAULT NULL,
  `times_viewed` int(10) unsigned DEFAULT NULL,
  `ask_for_price` enum('N','Y') DEFAULT 'N',
  `code` varchar(128) DEFAULT NULL,
  `active` enum('Y','N') DEFAULT 'Y',
  `recommend` enum('N','Y') NOT NULL DEFAULT 'N',
  `quantity` int(10) unsigned NOT NULL,
  `quantity_tracking` enum('N','Y') DEFAULT 'N',
  `date_added` char(20) NOT NULL,
  `date_modified` char(20) DEFAULT NULL,
  `date_expire` char(20) DEFAULT NULL,
  `ean` char(32) DEFAULT NULL,
  `parameter_category_id` int(10) unsigned DEFAULT NULL,
  `hide_price` enum('N','Y') DEFAULT 'N',
  `measure_unit_id` int(10) DEFAULT NULL,
  `producer_id` int(10) unsigned DEFAULT NULL,
  `product_status_id` int(11) unsigned DEFAULT NULL,
  `preparation` enum('N','Y') DEFAULT 'N',
  `premiere_date` char(20) DEFAULT NULL,
  `promotion_date_start` char(20) DEFAULT NULL,
  `promotion_date_end` char(20) DEFAULT NULL,
  `new` enum('N','Y') DEFAULT 'N',
  `bestseller` enum('N','Y') DEFAULT 'N',
  `old_price` double(10,2) DEFAULT NULL,
  `constant_discount` int(10) unsigned DEFAULT NULL,
  `rebate_group_id` int(11) unsigned DEFAULT NULL,
  `max_rebate` int(10) unsigned DEFAULT NULL,
  `loyality_points` int(10) unsigned DEFAULT NULL,
  `product_of_the_day_date` char(20) DEFAULT NULL,
  `sale` double(10,2) DEFAULT NULL,
  `sale_date_start` char(20) DEFAULT NULL,
  `sale_date_end` char(20) DEFAULT NULL,
  `allow_voting` enum('N','Y') DEFAULT 'N',
  `allow_comments` enum('N','Y') DEFAULT 'N',
  `free_delivery` enum('N','Y') DEFAULT 'N',
  `additional_delivery_cost` double(10,2) unsigned DEFAULT NULL,
  `netto_surface` double(10,2) unsigned DEFAULT NULL,
  `homestead_surface` double(10,2) unsigned DEFAULT NULL,
  `volume` double(10,2) unsigned DEFAULT NULL,
  `estimate` text,
  `height` double(10,2) unsigned DEFAULT NULL,
  `project_price` int(11) NOT NULL,
  `usable_surface` double(10,2) unsigned DEFAULT NULL,
  `estimated_calculation` int(11) DEFAULT NULL,
  `allegro_template` text,
  `product_position` int(10) NOT NULL DEFAULT '0',
  `product_allow_rabate` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '1 - zezwalaj na rabat, 0 - nie zezwalaj',
  `product_stock` int(10) unsigned DEFAULT '1',
  `voucher` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_product`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `shop_products_attachments`;
CREATE TABLE `shop_products_attachments` (
  `id_attachment` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int(10) unsigned NOT NULL,
  `filename` varchar(255) CHARACTER SET utf8 NOT NULL,
  `real_filename` varchar(255) CHARACTER SET utf8 NOT NULL,
  `filesize` int(10) unsigned DEFAULT NULL,
  `file_description` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id_attachment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `shop_products_attributes`;
CREATE TABLE `shop_products_attributes` (
  `product_id` int(10) unsigned NOT NULL,
  `attribute_id` int(11) NOT NULL,
  `attribute_value_id` int(11) NOT NULL,
  `price` double unsigned DEFAULT NULL,
  `default_value` enum('N','Y') DEFAULT 'N',
  `quantity` int(10) unsigned DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `shop_products_comments`;
CREATE TABLE `shop_products_comments` (
  `id_product_comment` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int(10) unsigned NOT NULL,
  `active` enum('Y','N') DEFAULT 'Y',
  `parent_product_comment_id` int(10) unsigned DEFAULT NULL,
  `date_added` bigint(20) unsigned DEFAULT NULL,
  `nick` varchar(64) NOT NULL,
  `content` text NOT NULL,
  `ip` char(15) DEFAULT NULL,
  `email` varchar(128) DEFAULT NULL,
  `www` varchar(256) DEFAULT NULL,
  `content_hash` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`id_product_comment`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `shop_products_description`;
CREATE TABLE `shop_products_description` (
  `id_product_description` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int(10) unsigned NOT NULL,
  `product_language` char(5) NOT NULL DEFAULT 'pl_PL',
  `product_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_polish_ci DEFAULT NULL,
  `product_description` text NOT NULL,
  `product_short_description` text NOT NULL,
  `product_guarantee` text CHARACTER SET utf8 COLLATE utf8_polish_ci,
  `meta_title` varchar(256) DEFAULT NULL,
  `meta_description` varchar(256) DEFAULT NULL,
  `meta_keywords` varchar(256) DEFAULT NULL,
  `product_media` text,
  PRIMARY KEY (`id_product_description`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `shop_products_files`;
CREATE TABLE `shop_products_files` (
  `id_product_file` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int(10) unsigned NOT NULL,
  `file_name` varchar(256) NOT NULL,
  `real_file_name` varchar(256) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `description` varchar(256) DEFAULT NULL,
  `is_active` tinyint(1) unsigned DEFAULT NULL,
  PRIMARY KEY (`id_product_file`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `shop_products_images`;
CREATE TABLE `shop_products_images` (
  `id_image` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `variant_id` int(11) DEFAULT NULL,
  `filename` varchar(255) NOT NULL,
  `realfilename` varchar(255) NOT NULL,
  `mainimage` enum('Y','N') NOT NULL DEFAULT 'Y',
  PRIMARY KEY (`id_image`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `shop_products_parameters`;
CREATE TABLE `shop_products_parameters` (
  `product_id` int(10) unsigned DEFAULT NULL,
  `parameter_id` int(10) unsigned DEFAULT NULL,
  `parameter_value_id` int(10) unsigned DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `shop_products_project_gallery`;
CREATE TABLE `shop_products_project_gallery` (
  `id_project_gallery` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int(10) unsigned NOT NULL,
  `file_name` varchar(256) DEFAULT NULL,
  `real_file_name` varchar(256) DEFAULT NULL,
  `project_description` varchar(256) DEFAULT NULL,
  `position` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id_project_gallery`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `shop_products_statuses`;
CREATE TABLE `shop_products_statuses` (
  `id_product_status` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `allow_buy` enum('Y','N') CHARACTER SET latin1 NOT NULL DEFAULT 'Y',
  `active` enum('Y','N') NOT NULL DEFAULT 'Y',
  PRIMARY KEY (`id_product_status`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `shop_products_statuses` (`id_product_status`, `allow_buy`, `active`) VALUES
(1,	'Y',	'Y'),
(2,	'N',	'Y');

DROP TABLE IF EXISTS `shop_products_statuses_description`;
CREATE TABLE `shop_products_statuses_description` (
  `product_status_id` int(11) unsigned NOT NULL,
  `product_status_name` varchar(255) NOT NULL,
  `product_status_language` char(5) NOT NULL DEFAULT 'pl_PL'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `shop_products_statuses_description` (`product_status_id`, `product_status_name`, `product_status_language`) VALUES
(1,	'Dostępny',	'pl_PL'),
(2,	'Dostępny wkrótce',	'pl_PL');

DROP TABLE IF EXISTS `shop_products_tags`;
CREATE TABLE `shop_products_tags` (
  `product_id` int(10) unsigned NOT NULL,
  `tag_dict_id` int(10) unsigned NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `shop_products_tags_dict`;
CREATE TABLE `shop_products_tags_dict` (
  `id_tag_dict` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `word` varchar(255) NOT NULL,
  PRIMARY KEY (`id_tag_dict`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `shop_products_to_categories`;
CREATE TABLE `shop_products_to_categories` (
  `product_id` int(10) unsigned NOT NULL,
  `category_id` int(10) unsigned NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `shop_products_to_news`;
CREATE TABLE `shop_products_to_news` (
  `product_id` int(11) NOT NULL,
  `news_id` int(11) NOT NULL,
  KEY `product_id` (`product_id`,`news_id`),
  KEY `news_id` (`news_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `shop_product_parameters`;
CREATE TABLE `shop_product_parameters` (
  `id_product_to_parameter` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int(10) unsigned NOT NULL,
  `parameter_id` int(10) unsigned NOT NULL,
  `value` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`id_product_to_parameter`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `shop_product_parameters` (`id_product_to_parameter`, `product_id`, `parameter_id`, `value`) VALUES
(9,	132,	8,	'16x16'),
(8,	132,	9,	'trumeusz'),
(7,	132,	10,	'brak'),
(10,	132,	11,	'100 Kb'),
(17,	130,	8,	'1000x500'),
(16,	130,	9,	'Android'),
(15,	130,	10,	'Jest na wypasie'),
(18,	130,	11,	'8 Gb');

DROP TABLE IF EXISTS `shop_product_to_variant`;
CREATE TABLE `shop_product_to_variant` (
  `product_id` int(10) unsigned NOT NULL,
  `variant_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `quantity` int(10) unsigned NOT NULL DEFAULT '0',
  `variant_values` text NOT NULL,
  PRIMARY KEY (`variant_id`),
  UNIQUE KEY `variant_id` (`variant_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `shop_product_to_variant` (`product_id`, `variant_id`, `quantity`, `variant_values`) VALUES
(132,	32,	10,	'a:2:{i:7;s:2:\"40\";i:4;s:2:\"25\";}'),
(102,	22,	5,	'a:1:{i:4;s:2:\"26\";}'),
(102,	23,	7,	'a:1:{i:4;s:2:\"25\";}'),
(103,	24,	5,	'a:1:{i:4;s:2:\"26\";}'),
(103,	25,	7,	'a:1:{i:4;s:2:\"25\";}'),
(128,	26,	5,	'a:2:{i:7;s:7:\"wybierz\";i:4;s:2:\"25\";}'),
(128,	27,	4,	'a:1:{i:7;s:2:\"40\";}'),
(128,	28,	7,	'a:2:{i:7;s:2:\"38\";i:4;s:2:\"25\";}'),
(128,	29,	7,	'a:2:{i:7;s:2:\"38\";i:4;s:2:\"25\";}'),
(125,	30,	1,	'a:2:{i:7;s:2:\"39\";i:4;s:2:\"25\";}'),
(132,	31,	10,	'a:2:{i:7;s:2:\"41\";i:4;s:2:\"25\";}'),
(132,	37,	9,	'a:2:{i:7;s:2:\"40\";i:4;s:2:\"26\";}'),
(132,	36,	10,	'a:2:{i:7;s:2:\"41\";i:4;s:2:\"26\";}'),
(132,	41,	0,	'a:2:{i:7;s:2:\"39\";i:4;s:2:\"26\";}'),
(132,	40,	6,	'a:2:{i:7;s:2:\"39\";i:4;s:2:\"25\";}'),
(133,	42,	5,	'a:2:{i:7;s:2:\"41\";i:4;s:2:\"25\";}');

DROP TABLE IF EXISTS `shop_questions`;
CREATE TABLE `shop_questions` (
  `id_question` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(128) NOT NULL,
  `phone` varchar(32) NOT NULL,
  `product_info` varchar(255) DEFAULT NULL,
  `product_id` int(10) unsigned DEFAULT NULL,
  `date` char(20) DEFAULT NULL,
  `message` varchar(255) DEFAULT NULL,
  `responsed` enum('N','Y') DEFAULT 'N',
  PRIMARY KEY (`id_question`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `shop_questions` (`id_question`, `name`, `email`, `phone`, `product_info`, `product_id`, `date`, `message`, `responsed`) VALUES
(1,	'aaa',	'hubert@olicom.pl',	'5555555',	'test',	11,	'2014-02-04',	'test',	'N'),
(2,	'bgbg',	'hubert@olicom.pl',	'5555555',	'asdf',	12,	'2014-02-04',	'asdtest',	'Y'),
(3,	'yyggf',	'hubert@olicom.pl',	'5555555',	'hjgjfgfh',	12,	'2014-02-04',	'mnmftghgf',	'Y');

DROP TABLE IF EXISTS `shop_rebates_codes`;
CREATE TABLE `shop_rebates_codes` (
  `id_rebate_code` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `rebate_code` varchar(255) NOT NULL,
  `active` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '1- aktywny, 0 - nieaktywny',
  `rebate` int(10) unsigned NOT NULL,
  `rebate_start` datetime DEFAULT NULL,
  `rebate_end` datetime DEFAULT NULL,
  `rebate_add` datetime NOT NULL,
  `rebate_modify` datetime DEFAULT NULL,
  PRIMARY KEY (`id_rebate_code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `shop_rebates_codes` (`id_rebate_code`, `rebate_code`, `active`, `rebate`, `rebate_start`, `rebate_end`, `rebate_add`, `rebate_modify`) VALUES
(1,	'fanbiały',	1,	50,	'2014-07-01 00:00:00',	'2014-07-31 00:00:00',	'0000-00-00 00:00:00',	'2014-07-22 11:53:34'),
(2,	'test5',	1,	5,	'2014-04-03 00:00:00',	'2014-04-09 00:00:00',	'2014-04-11 10:05:59',	'2014-04-11 11:24:15'),
(3,	'fanbiały',	0,	5,	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'2014-04-14 08:42:31',	NULL),
(4,	'fanbiały',	0,	5,	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'2014-04-14 08:46:58',	NULL),
(5,	'wiosna',	1,	20,	'2014-05-10 00:00:00',	'2014-06-19 00:00:00',	'2014-06-12 07:53:31',	'2014-06-12 07:53:52');

DROP TABLE IF EXISTS `shop_rebates_codes_to_products`;
CREATE TABLE `shop_rebates_codes_to_products` (
  `product_id` int(10) unsigned NOT NULL,
  `rebate_code_id` int(10) unsigned NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `shop_rebates_codes_to_products` (`product_id`, `rebate_code_id`) VALUES
(102,	4),
(103,	4),
(96,	4),
(105,	4),
(106,	4),
(124,	12),
(125,	12),
(115,	12),
(116,	12),
(108,	5),
(107,	5),
(104,	5),
(98,	5),
(97,	5),
(100,	5),
(99,	5),
(101,	5),
(106,	5),
(105,	5),
(96,	5),
(103,	5),
(102,	5),
(124,	14),
(125,	14),
(115,	14),
(116,	14),
(124,	13),
(125,	13),
(115,	13),
(116,	13);

DROP TABLE IF EXISTS `shop_rebates_groups`;
CREATE TABLE `shop_rebates_groups` (
  `id_rebate_group` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `group_name` varchar(128) NOT NULL,
  `rebate` int(10) unsigned NOT NULL,
  `active` enum('Y','N') CHARACTER SET latin1 NOT NULL DEFAULT 'Y',
  PRIMARY KEY (`id_rebate_group`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `shop_rebates_groups` (`id_rebate_group`, `group_name`, `rebate`, `active`) VALUES
(1,	'test',	5,	'Y'),
(3,	'hgffg',	14,	'N'),
(4,	'kjhg',	65,	'Y');

DROP TABLE IF EXISTS `shop_related_products`;
CREATE TABLE `shop_related_products` (
  `product_id` int(10) unsigned NOT NULL,
  `related_product_id` int(10) unsigned NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `shop_subscriptions_logs`;
CREATE TABLE `shop_subscriptions_logs` (
  `id_shop_subscriptions_log` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `customer_id` int(10) NOT NULL,
  `request` text,
  `response` text,
  PRIMARY KEY (`id_shop_subscriptions_log`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `shop_taxes`;
CREATE TABLE `shop_taxes` (
  `id_tax` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tax_name` varchar(255) NOT NULL,
  `tax_value` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id_tax`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `shop_taxes` (`id_tax`, `tax_name`, `tax_value`) VALUES
(8,	'Stawka II',	23),
(7,	'Stawka I',	8);

DROP TABLE IF EXISTS `slider_elements`;
CREATE TABLE `slider_elements` (
  `id_slider_element` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `slider_type_id` tinyint(2) unsigned NOT NULL,
  `slider_element_id` int(10) NOT NULL,
  `slider_element_position` int(3) unsigned NOT NULL DEFAULT '0',
  `available` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id_slider_element`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `slider_elements` (`id_slider_element`, `slider_type_id`, `slider_element_id`, `slider_element_position`, `available`) VALUES
(60,	3,	1,	1,	1),
(61,	3,	2,	2,	1);

DROP TABLE IF EXISTS `slider_images`;
CREATE TABLE `slider_images` (
  `id_slider_image` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `alt` varchar(255) DEFAULT NULL,
  `link` text,
  `lang` char(5) NOT NULL DEFAULT 'pl_PL',
  `slider_element_id` int(11) NOT NULL,
  PRIMARY KEY (`id_slider_image`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `slider_images` (`id_slider_image`, `title`, `filename`, `alt`, `link`, `lang`, `slider_element_id`) VALUES
(1,	'1',	'145129460115680ff896a9ae784839531.jpg',	'1',	NULL,	'pl_PL',	0),
(2,	'2',	'1451297090156810942686be024999278.jpg',	'2',	NULL,	'pl_PL',	0);

DROP TABLE IF EXISTS `slider_news`;
CREATE TABLE `slider_news` (
  `slider_news_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text,
  `short_description` text,
  `filename` varchar(50) DEFAULT NULL,
  `alt` varchar(100) DEFAULT NULL,
  `link` text,
  `slider_element_id` int(11) NOT NULL,
  `lang` char(5) NOT NULL DEFAULT 'pl_PL',
  PRIMARY KEY (`slider_news_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `tags`;
CREATE TABLE `tags` (
  `id_tag` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `element_id` int(11) unsigned NOT NULL,
  `dictionary_tag_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id_tag`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `tags_dictionary`;
CREATE TABLE `tags_dictionary` (
  `id_tag_dictionary` int(11) NOT NULL AUTO_INCREMENT,
  `word` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`id_tag_dictionary`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `vouchers`;
CREATE TABLE `vouchers` (
  `id_voucher` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `voucher_code` varchar(32) NOT NULL,
  `voucher_status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '0-nieaktywny, 1 - można użyć, 2 - użyty',
  `voucher_create` datetime NOT NULL,
  `voucher_modify` datetime DEFAULT NULL,
  `voucher_used` datetime DEFAULT NULL,
  `voucher_value` double(10,2) unsigned NOT NULL,
  `order_product_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id_voucher`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `vouchers` (`id_voucher`, `voucher_code`, `voucher_status`, `voucher_create`, `voucher_modify`, `voucher_used`, `voucher_value`, `order_product_id`) VALUES
(1,	'fdsfdsdsf',	0,	'2015-12-07 15:25:12',	'2015-12-07 15:25:17',	NULL,	333.00,	NULL),
(3,	'fdsfd-sdsf',	1,	'2015-12-08 12:23:19',	NULL,	NULL,	33.00,	NULL),
(4,	'BET1-BMWS-81B3-N9B3',	1,	'2015-12-08 12:25:55',	'2015-12-08 12:26:04',	NULL,	121.00,	NULL),
(5,	'CZ3R-1W5W-34QZ-QNQ8',	0,	'2015-12-08 12:26:38',	NULL,	NULL,	500.00,	NULL),
(6,	'MRXW-XBI8-C676-729B',	0,	'2015-12-08 12:32:49',	NULL,	NULL,	500.00,	14),
(7,	'OHA0-50M6-K2GH-5H3B',	1,	'2015-12-08 12:35:25',	NULL,	NULL,	500.00,	15),
(8,	'APKH-KFS2-CNOR-S6QB',	1,	'2015-12-08 12:35:25',	NULL,	NULL,	500.00,	15);

-- 2016-01-03 21:09:35
