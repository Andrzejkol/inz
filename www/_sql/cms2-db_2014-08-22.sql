-- phpMyAdmin SQL Dump
-- version 3.4.7.1
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306

-- Generation Time: Aug 22, 2014 at 10:03 AM
-- Server version: 5.5.18
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cms2`
--

-- --------------------------------------------------------

--
-- Table structure for table `acl_permissions`
--

CREATE TABLE `acl_permissions` (
  `id_permission` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `resource` varchar(255) NOT NULL,
  `privilege` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_permission`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=163 ;

--
-- Dumping data for table `acl_permissions`
--

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

-- --------------------------------------------------------

--
-- Table structure for table `acl_roles`
--

CREATE TABLE `acl_roles` (
  `id_role` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `parent_role_id` int(10) unsigned DEFAULT NULL,
  `date_added` bigint(20) unsigned NOT NULL,
  `status` enum('Y','N') DEFAULT 'Y',
  `acl` text NOT NULL,
  PRIMARY KEY (`id_role`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=42 ;

--
-- Dumping data for table `acl_roles`
--

INSERT INTO `acl_roles` (`id_role`, `name`, `description`, `parent_role_id`, `date_added`, `status`, `acl`) VALUES
(13, 'administrator', '', 13, 1270017733, 'Y', '''O:8:\\"Zend_Acl\\":6:{s:16:\\"\\0*\\0_roleRegistry\\";O:22:\\"Zend_Acl_Role_Registry\\":1:{s:9:\\"\\0*\\0_roles\\";a:1:{s:13:\\"administrator\\";a:3:{s:8:\\"instance\\";O:13:\\"Zend_Acl_Role\\":1:{s:10:\\"\\0*\\0_roleId\\";s:13:\\"administrator\\";}s:7:\\"parents\\";a:0:{}s:8:\\"children\\";a:0:{}}}}s:13:\\"\\0*\\0_resources\\";a:0:{}s:17:\\"\\0*\\0_isAllowedRole\\";N;s:21:\\"\\0*\\0_isAllowedResource\\";N;s:22:\\"\\0*\\0_isAllowedPrivilege\\";N;s:9:\\"\\0*\\0_rules\\";a:2:{s:12:\\"allResources\\";a:2:{s:8:\\"allRoles\\";a:2:{s:13:\\"allPrivileges\\";a:2:{s:4:\\"type\\";s:9:\\"TYPE_DENY\\";s:6:\\"assert\\";N;}s:13:\\"byPrivilegeId\\";a:0:{}}s:8:\\"byRoleId\\";a:1:{s:13:\\"administrator\\";a:2:{s:13:\\"byPrivilegeId\\";a:0:{}s:13:\\"allPrivileges\\";a:2:{s:4:\\"type\\";s:10:\\"TYPE_ALLOW\\";s:6:\\"assert\\";N;}}}}s:12:\\"byResourceId\\";a:0:{}}}'''),
(39, 'demo', '', 13, 1358253023, 'Y', '');

-- --------------------------------------------------------

--
-- Table structure for table `acl_roles_permissions`
--

CREATE TABLE `acl_roles_permissions` (
  `role_id` int(10) unsigned NOT NULL,
  `permission_id` int(10) unsigned NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `acl_roles_permissions`
--

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

-- --------------------------------------------------------

--
-- Table structure for table `acl_users`
--

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=31 ;

--
-- Dumping data for table `acl_users`
--

INSERT INTO `acl_users` (`id_user`, `email`, `first_name`, `last_name`, `username`, `password`, `date_added`, `last_login_date`, `logged_times`, `acl`, `role_id`, `status`, `verify_string`, `verified`, `image_id`) VALUES
(16, 'olicom@olicom.pl', 'Admin', 'Olicom', '', '*F2651DAB851BC94D1C6E3F08C9C68E89C0AF4484', '1270034596', '1406797676', 128, NULL, 13, 'Y', NULL, NULL, 6),
(19, 'demo@demo.pl', 'Admin', 'Demo', '', '*AB505E4F9AC59C3C8B6D4B859D1818F53DD82E6C', '1358253160', '1406031624', 17, NULL, 39, 'Y', NULL, NULL, NULL),
(27, 'kamil@olicom.pl', 'test', 'test', '', '*94BDCEBE19083CE2A1F959FD02F964C7AF4CFC29', '1387104785', '', 0, NULL, 13, 'Y', NULL, NULL, 5),
(28, 'dedra@dedra.info', 'dedra', 'dedra', '', '*0B8FBE81AAC86DB0F1037709C42E75660D4728CA', '1388742169', '1388742229', 2, NULL, 41, 'Y', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `acl_users_images`
--

CREATE TABLE `acl_users_images` (
  `id_image` int(11) NOT NULL AUTO_INCREMENT,
  `filename` varchar(255) NOT NULL,
  `realfilename` varchar(255) NOT NULL,
  `mainimage` tinyint(1) unsigned NOT NULL,
  `alt` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_image`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `acl_users_images`
--

INSERT INTO `acl_users_images` (`id_image`, `filename`, `realfilename`, `mainimage`, `alt`) VALUES
(5, '1387104785152ad8a1192ada415543402.jpg', 'good_job.jpg', 0, ''),
(6, '1387107810152ad95e2c5333398476443.png', 'olicom-logo-140.png', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `boxes`
--

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=14 ;

--
-- Dumping data for table `boxes`
--

INSERT INTO `boxes` (`id_boxes`, `name`, `title`, `contents`, `link`, `active`, `position`, `lang`, `filename`, `boxes_set_id`) VALUES
(13, 't1', 't1', '', 'http://google.pl', 1, NULL, 'pl_PL', '1404993573153be802586b05594204476.jpg', 14),
(11, 'asd', 'asd', '', 'asdasd', 1, NULL, 'pl_PL', NULL, 6),
(12, 'adsad', 'asdads', '', '', 1, NULL, 'pl_PL', NULL, 13);

-- --------------------------------------------------------

--
-- Table structure for table `boxes_set`
--

CREATE TABLE `boxes_set` (
  `id_boxes_set` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT 'pl_PL',
  `description` text,
  `element_id` int(11) NOT NULL,
  `show_title` enum('N','Y') NOT NULL DEFAULT 'Y',
  PRIMARY KEY (`id_boxes_set`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `boxes_set`
--

INSERT INTO `boxes_set` (`id_boxes_set`, `name`, `description`, `element_id`, `show_title`) VALUES
(14, 'boksy', 'test', 59, 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `configuration`
--

CREATE TABLE `configuration` (
  `id_configuration` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(255) NOT NULL DEFAULT '',
  `value` text NOT NULL,
  `name` varchar(255) NOT NULL,
  `desc` varchar(255) NOT NULL DEFAULT '',
  `group` varchar(255) NOT NULL DEFAULT '',
  `type` varchar(64) NOT NULL DEFAULT 'text',
  PRIMARY KEY (`id_configuration`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `configuration`
--

INSERT INTO `configuration` (`id_configuration`, `key`, `value`, `name`, `desc`, `group`, `type`) VALUES
(1, 'administrator_email', 'demo@olicom.pl', 'Email', 'Adres z którego wysyłane są emaile z systemu', '', 'text'),
(2, 'administrator_name', 'Admin', 'Nazwa', 'Pole "Od" w wysyłanych e-mailach z systemu', '', 'text'),
(3, 'sending_email', 'demo@olicom.pl', 'Newsletter email', 'Adres z którego wysyłane są emaile newslettera', '', 'text'),
(4, 'sending_name', 'Newsletter', 'Newsletter nazwa', 'Pole "Od" w wysyłanych e-mailach newslettera', '', 'text'),
(5, 'google_tracking_code', '', 'Google Analytics', 'Kod do statystyk (UA-xxxxxxxxx-xx)', '', 'text'),
(6, 'page_name', 'OliShop', 'Nazwa strony', 'Używana w mailach', '', 'text'),
(7, 'page_domain', 'olishop.olicom.com.pl', 'Domena', 'Domena używama m.in. w mailach', '', 'text'),
(8, 'firm_address', '<strong>nazwa firmy</strong><br/>\r\nul. Ulica 22<br/>\r\n11-222 Poznań<br/><br/>\r\nmobile:<br/>\r\n+48 555 444 222<br/>\r\n+48 33 444 55 66<br/>\r\nemail: <a href="mailto:demo@olicom.pl">demo@olicom.pl</a>', 'Adres firmy', 'Używany w mailach.', '', 'textarea');

-- --------------------------------------------------------

--
-- Table structure for table `contact_forms`
--

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `contact_forms`
--

INSERT INTO `contact_forms` (`id_contact_form`, `element_id`, `title`, `language`, `sender_email`, `receiver_email`, `has_captcha`, `show_title`) VALUES
(3, 23, 'Formularz kontaktowy', 'pl_PL', 'pawel@olicom.pl', 'hubert@olicom.pl', 'Y', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `contact_forms_log`
--

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `contact_forms_log`
--

INSERT INTO `contact_forms_log` (`id_contact_form_log`, `ip_address`, `date_sent`, `email`, `name`, `phone`, `message`, `topic`) VALUES
(1, '::1', 1389619744, 'pawel@olicom.org.pl', 'Akcesoria', 'dsa', 'dsa', 'test'),
(2, '127.0.0.1', 1392213439, 'hubert@olicom.pl', 'Hubert', '333444555', 'Test formularza', 'test formularza'),
(3, '127.0.0.1', 1402407552, 'hubert@olicom.pl', 'Hubert', '555666777', 'teswt', 'test'),
(4, '127.0.0.1', 1402408451, 'hubert@olicom.pl', 'Hubert', '555666777', 'test', 'Test'),
(5, '127.0.0.1', 1402475221, 'filip@olicom.pl', 'Hubert', '555666777', 'test', 'test'),
(6, '127.0.0.1', 1402475583, 'filip@olicom.pl', 'Hubert', '555666777', 'testttttt', 'Testttttt');

-- --------------------------------------------------------

--
-- Table structure for table `dict_states`
--

CREATE TABLE `dict_states` (
  `id_states_dict` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `state_name` varchar(128) NOT NULL,
  PRIMARY KEY (`id_states_dict`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `dict_states`
--

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

-- --------------------------------------------------------

--
-- Table structure for table `dotpay_logs`
--

CREATE TABLE `dotpay_logs` (
  `id_dotpay_log` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `log_desc` text,
  `log_time` datetime DEFAULT NULL,
  `t_id` varchar(255) NOT NULL,
  `info` text,
  PRIMARY KEY (`id_dotpay_log`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `elements`
--

CREATE TABLE `elements` (
  `id_element` int(11) NOT NULL AUTO_INCREMENT,
  `type` enum('polls','page_content','news','contact_form','galleries','boxes') DEFAULT NULL,
  `date_added` bigint(20) unsigned NOT NULL,
  `modified_date` bigint(20) unsigned DEFAULT NULL,
  `lang` char(5) NOT NULL,
  `available` tinyint(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_element`,`lang`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=66 ;

--
-- Dumping data for table `elements`
--

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

-- --------------------------------------------------------

--
-- Table structure for table `galleries`
--

CREATE TABLE `galleries` (
  `id_gallery` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT 'pl_PL',
  `description` text,
  `element_id` int(11) NOT NULL,
  `show_title` enum('N','Y') NOT NULL DEFAULT 'Y',
  PRIMARY KEY (`id_gallery`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `galleries`
--

INSERT INTO `galleries` (`id_gallery`, `name`, `description`, `element_id`, `show_title`) VALUES
(8, 'Galeria', '', 43, 'Y'),
(10, 'Test Galerii', '', 64, 'Y'),
(11, 'Gal22', 'asasdsd', 65, 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `galleries_images`
--

CREATE TABLE `galleries_images` (
  `id_galleries_images` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `image_id` int(10) unsigned NOT NULL,
  `gallery_id` int(10) unsigned NOT NULL,
  `alt` varchar(255) DEFAULT NULL,
  `lang` char(5) NOT NULL,
  PRIMARY KEY (`id_galleries_images`,`lang`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=52 ;

--
-- Dumping data for table `galleries_images`
--

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

-- --------------------------------------------------------

--
-- Table structure for table `gallery_images`
--

CREATE TABLE `gallery_images` (
  `id_image` int(11) NOT NULL AUTO_INCREMENT,
  `filename` varchar(255) NOT NULL,
  `realfilename` varchar(255) NOT NULL,
  `mainimage` tinyint(1) unsigned NOT NULL,
  `position` int(5) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_image`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=52 ;

--
-- Dumping data for table `gallery_images`
--

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

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id_image` int(11) NOT NULL AUTO_INCREMENT,
  `filename` varchar(255) NOT NULL,
  `realfilename` varchar(255) NOT NULL,
  `mainimage` tinyint(1) unsigned NOT NULL,
  `alt` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_image`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id_image`, `filename`, `realfilename`, `mainimage`, `alt`) VALUES
(9, '1403077593153a143d9a6304108755628.jpg', 'presta123.jpg', 0, 'SKLEPY INTERNETOWE Oparte na PrestaShop'),
(10, '1403077846153a144d68751d077247374.jpg', 'promocja.jpg', 0, 'Promocja');

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id_language` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(5) NOT NULL,
  `description` varchar(64) NOT NULL,
  `flag` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`id_language`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id_language`, `name`, `description`, `flag`) VALUES
(1, 'pl_PL', 'polish', 'pl.png');

-- --------------------------------------------------------

--
-- Table structure for table `medias`
--

CREATE TABLE `medias` (
  `id_media` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `file_name` varchar(255) NOT NULL,
  `mime_type_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id_media`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `medias`
--

INSERT INTO `medias` (`id_media`, `file_name`, `mime_type_id`) VALUES
(1, '1-lktextpage.jpg', 1),
(2, '2-lkcontact.jpg', 1),
(4, '4-2014-06-05131809.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `medias_mime_types`
--

CREATE TABLE `medias_mime_types` (
  `id_mime_type` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `mime_type` varchar(128) NOT NULL,
  `type` varchar(255) NOT NULL,
  PRIMARY KEY (`id_mime_type`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `medias_mime_types`
--

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

-- --------------------------------------------------------

--
-- Table structure for table `medias_product`
--

CREATE TABLE `medias_product` (
  `product_id` int(11) NOT NULL,
  `media_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id_news` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `lang` char(5) NOT NULL DEFAULT 'pl_PL',
  `short_description` varchar(255) NOT NULL,
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
  PRIMARY KEY (`id_news`,`lang`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id_news`, `title`, `lang`, `short_description`, `description`, `date_added`, `modified_date`, `available`, `news_start_date`, `news_end_date`, `position`, `meta_title`, `meta_description`, `meta_keywords`, `url`) VALUES
(9, 'Sklepy internetowe oparte na PrestaShop', 'pl_PL', '<h3>PROFESJONALNE<br />SKLEPY INTERNETOWE</h3>\r\n<p>Oparte na&nbsp;<strong>PrestaShop</strong></p>', '<h2>DLACZEGO WARTO?<br /><br /></h2>\r\n<ul>\r\n<li>Atrakcyjna i przejrzysta szata graficzna do wyboru</li>\r\n<li>Płatności online</li>\r\n<li>Wygodny i łatwy w obsłudze panel administracyjny</li>\r\n<li>Kompleksowe zarządzanie produktem i magazynem</li>\r\n</ul>\r\n<ul>\r\n<li>Wersja mobilna</li>\r\n<li>Możliwość&nbsp;zakładania&nbsp;kont&nbsp;pracownikom i nadawania uprawnień</li>\r\n<li>Własny adres www i poczta e-mail</li>\r\n<li>Atrakcyjna cena od 2499 zł</li>\r\n<li>Domena i hosting&nbsp;<strong>gratis!</strong></li>\r\n</ul>', 1403077591, NULL, 1, 0, 0, NULL, '', '', '', ''),
(10, 'Promocja', 'pl_PL', '<h3>PROFESJONALNE<br />STRONY<br />INTERNETOWE&nbsp;</h3>\r\n<p>W cenie&nbsp;<strong>699 zł</strong>.</p>', '<h2>CO OFERUJEMY</h2>\r\n<ul>\r\n<li>Prosty w obsłudze panel do samodzielnej edycji treści strony</li>\r\n<li>Wersja mobilna strony</li>\r\n<li>Możliwość dodania nieograniczonej ilości zdjęć</li>\r\n</ul>\r\n<ul>\r\n<li>Własny adres www i poczta e-mail</li>\r\n<li>Darmowa domena i hosting</li>\r\n<li>Brak ukrytych opłat</li>\r\n<li>Czytelna mapa dojazdu na stronie.</li>\r\n</ul>', 1403077844, 1403782587, 1, 0, 0, NULL, '', '', '', ''),
(12, 'Aktualność testowa', 'pl_PL', '<p>asdasdas</p>', '<p>asasadsdasdas</p>', 1406800418, NULL, 1, 0, 0, NULL, 'aasddsasd', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `newsletters`
--

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `newsletters`
--

INSERT INTO `newsletters` (`id_newsletter`, `language`, `title`, `content`, `date_added`, `date_sent`, `interval`, `bulk`) VALUES
(1, 'pl_PL', 'Newsletter 1', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla tortor libero, dapibus in lobortis eget, sollicitudin vel quam. Phasellus neque nisl, posuere bibendum pretium eu, elementum a nunc. Phasellus varius fermentum consequat. Donec rutrum turpis at mi accumsan rhoncus. Curabitur aliquet arcu in eros pulvinar in pellentesque sapien volutpat. Donec id nibh id ligula mattis condimentum. In in eros eros, vel porttitor diam. Vestibulum ornare ornare dui sit amet rhoncus. Proin at porta diam. Morbi porta imperdiet metus, sit amet vestibulum leo luctus id. Aliquam posuere justo non felis facilisis vel vehicula purus aliquam. Cras mi neque, lobortis adipiscing laoreet quis, dapibus a mi. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Ut pellentesque, nisi vitae congue egestas, sem mi cursus odio, et consequat massa ligula ac dolor. Cras ultricies odio sit amet mi pulvinar sit amet pulvinar orci malesuada. Cras tellus eros, condimentum id hendrerit ac, aliquam a tellus. Nullam elementum placerat dictum. Duis sodales gravida eros, ac iaculis sem pulvinar ut. Cras mattis, leo varius dapibus varius, ipsum justo feugiat nibh, ut imperdiet est dolor ac nibh. Duis et consequat lectus.</p>\r\n<p>Nam ut placerat nibh. Morbi volutpat volutpat elit, ut aliquam odio ornare vel. Aliquam quis erat libero. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. In ac lacus faucibus mi facilisis tempus quis in eros. Praesent sodales fringilla nisl nec tincidunt. Vivamus tristique massa nunc, in eleifend tortor. Quisque adipiscing urna ac erat lacinia fringilla auctor dolor facilisis. Vivamus posuere eleifend ante non pulvinar. Suspendisse enim metus, dapibus ac porttitor vitae, iaculis id sem.</p>\r\n<p>Fusce sodales cursus consequat. Integer congue faucibus orci non tincidunt. In hac habitasse platea dictumst. Sed viverra lacus sit amet nisl imperdiet eget auctor mi lacinia. Quisque odio felis, porta non fringilla eget, sodales ac neque. Etiam tincidunt volutpat libero vel vehicula. Morbi eget leo id orci porttitor rutrum. Sed sollicitudin, elit a posuere tempor, risus est aliquet quam, sit amet molestie massa lorem vel mauris. Cras pulvinar malesuada iaculis. Donec aliquet lacus vel nunc gravida consequat. In in metus dui. Ut enim sapien, lobortis id sagittis eu, viverra ac purus.</p>', 1311941964, 1311942063, 60000, 20),
(2, 'pl_PL', 'TEST', '<p>Lorem ipsum....</p>', 1384560957, 1403783056, 60000, 20);

-- --------------------------------------------------------

--
-- Table structure for table `newsletters_attachments`
--

CREATE TABLE `newsletters_attachments` (
  `newsletter_id` int(10) unsigned NOT NULL,
  `attachment` varchar(255) CHARACTER SET utf8 NOT NULL,
  `position` int(10) unsigned NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `newsletters_newsletter_groups`
--

CREATE TABLE `newsletters_newsletter_groups` (
  `newsletter_id` int(10) unsigned NOT NULL,
  `newsletter_group_id` int(10) unsigned NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `newsletters_newsletter_groups`
--

INSERT INTO `newsletters_newsletter_groups` (`newsletter_id`, `newsletter_group_id`) VALUES
(1, 1),
(2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `newsletter_emails`
--

CREATE TABLE `newsletter_emails` (
  `id_email` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `email` varchar(255) NOT NULL,
  `verify_string` varchar(128) DEFAULT NULL,
  `verified` tinyint(1) unsigned DEFAULT NULL,
  `newsletter_email_active` enum('N','Y') NOT NULL DEFAULT 'Y',
  PRIMARY KEY (`id_email`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `newsletter_emails`
--

INSERT INTO `newsletter_emails` (`id_email`, `name`, `email`, `verify_string`, `verified`, `newsletter_email_active`) VALUES
(1, 'Tomasz Drgas', 'tomek@olicom.pl', '6ebkorl4', 1, 'Y'),
(4, '', 'kamil@olicom.pl', 'yp542ioy', 0, 'Y'),
(6, 'Hubert', 'hubert@olicom.pl', 'cjngkq60', 1, 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `newsletter_email_groups`
--

CREATE TABLE `newsletter_email_groups` (
  `newsletter_group_id` int(10) unsigned NOT NULL,
  `newsletter_email_id` int(10) unsigned NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `newsletter_email_groups`
--

INSERT INTO `newsletter_email_groups` (`newsletter_group_id`, `newsletter_email_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 6),
(2, 6);

-- --------------------------------------------------------

--
-- Table structure for table `newsletter_email_send`
--

CREATE TABLE `newsletter_email_send` (
  `newsletter_id` int(10) unsigned NOT NULL,
  `email_id` int(10) unsigned NOT NULL,
  `send_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `newsletter_groups`
--

CREATE TABLE `newsletter_groups` (
  `id_newsletter_group` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `default_group` tinyint(4) NOT NULL DEFAULT '0',
  `lang` varchar(5) NOT NULL DEFAULT 'pl_PL',
  PRIMARY KEY (`id_newsletter_group`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `newsletter_groups`
--

INSERT INTO `newsletter_groups` (`id_newsletter_group`, `name`, `description`, `default_group`, `lang`) VALUES
(1, 'Grupa domyślna PL', 'Domyslna grupa dla osób zapisanych do newslettera z polskiej wersji językowej witryny.', 1, 'pl_PL'),
(2, 'Nowa grupa', 'Opis grupy\r\n', 0, 'pl_PL');

-- --------------------------------------------------------

--
-- Table structure for table `newsletter_images`
--

CREATE TABLE `newsletter_images` (
  `id_image` int(11) NOT NULL AUTO_INCREMENT,
  `filename` varchar(255) NOT NULL,
  `newsletter_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id_image`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `news_categories`
--

CREATE TABLE `news_categories` (
  `id_news_category` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `news_category_name` varchar(255) NOT NULL,
  `element_id` int(11) NOT NULL,
  `show_title` enum('N','Y') NOT NULL DEFAULT 'Y',
  `comments` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '0 - wylaczone, 1 - wlaczone',
  PRIMARY KEY (`id_news_category`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `news_categories`
--

INSERT INTO `news_categories` (`id_news_category`, `news_category_name`, `element_id`, `show_title`, `comments`) VALUES
(3, 'Aktualności', 31, 'Y', 1);

-- --------------------------------------------------------

--
-- Table structure for table `news_comments`
--

CREATE TABLE `news_comments` (
  `id_news_comment` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `comment` text NOT NULL,
  `news_id` int(10) unsigned NOT NULL,
  `nick` varchar(50) NOT NULL,
  `client_ip` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_news_comment`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `news_comments`
--

INSERT INTO `news_comments` (`id_news_comment`, `comment`, `news_id`, `nick`, `client_ip`) VALUES
(1, 'test', 1, 'testtt', '127.0.0.1');

-- --------------------------------------------------------

--
-- Table structure for table `news_elements`
--

CREATE TABLE `news_elements` (
  `id_news_elements` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `news_id` int(11) unsigned NOT NULL,
  `element_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id_news_elements`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `news_images`
--

CREATE TABLE `news_images` (
  `news_id` int(10) unsigned NOT NULL,
  `images_id` int(10) unsigned NOT NULL,
  `id_news_images` int(10) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id_news_images`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `news_images`
--

INSERT INTO `news_images` (`news_id`, `images_id`, `id_news_images`) VALUES
(9, 9, 9),
(10, 10, 10);

-- --------------------------------------------------------

--
-- Table structure for table `news_to_categories`
--

CREATE TABLE `news_to_categories` (
  `id_news_to_categories` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `news_id` int(11) unsigned NOT NULL,
  `news_category_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id_news_to_categories`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=36 ;

--
-- Dumping data for table `news_to_categories`
--

INSERT INTO `news_to_categories` (`id_news_to_categories`, `news_id`, `news_category_id`) VALUES
(21, 9, 3),
(26, 10, 3),
(27, 12, 3);

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

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
  PRIMARY KEY (`id_page`,`lang`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=32 ;

--
-- Dumping data for table `pages`
--

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

-- --------------------------------------------------------

--
-- Table structure for table `pages_elements`
--

CREATE TABLE `pages_elements` (
  `page_id` int(11) NOT NULL,
  `element_id` int(11) NOT NULL,
  `id_pages_elements` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `element_order` int(11) DEFAULT NULL,
  `element_type` enum('footer','header','content','right','left') DEFAULT NULL,
  `position` enum('center','right','left') DEFAULT NULL,
  PRIMARY KEY (`id_pages_elements`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=114 ;

--
-- Dumping data for table `pages_elements`
--

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

-- --------------------------------------------------------

--
-- Table structure for table `pages_languages`
--

CREATE TABLE `pages_languages` (
  `page_id` int(11) NOT NULL,
  `language_id` varchar(45) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `page_content`
--

CREATE TABLE `page_content` (
  `id_page_content` int(11) NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `content` text NOT NULL,
  `element_id` int(11) DEFAULT NULL,
  `show_title` enum('N','Y') NOT NULL DEFAULT 'Y',
  PRIMARY KEY (`id_page_content`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `page_content`
--

INSERT INTO `page_content` (`id_page_content`, `title`, `content`, `element_id`, `show_title`) VALUES
(14, 'O firmie', '<p>Ut semper nunc risus, quis fringilla est interdum sit amet? Etiam eget odio vel nisi vulputate imperdiet. Maecenas a ligula non est consequat suscipit sit amet vitae dui. Ut ullamcorper quam nec justo sodales sodales. Phasellus at vestibulum felis. In ornare velit odio, nec ultricies diam congue et. Nunc gravida quis quam sed ultricies. Donec a sapien nec urna iaculis mollis vel nec diam. In posuere consequat ipsum vitae dapibus. Curabitur in leo vel dui rhoncus malesuada! Sed sit amet vehicula dui. Pellentesque vitae facilisis libero. Ut et orci nec diam luctus varius. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Duis tortor erat, lobortis mattis lectus nec, tincidunt pretium diam. Suspendisse vel lobortis enim.</p>\r\n<p>&nbsp;</p>\r\n<p>Donec nec lobortis orci, a elementum risus. Donec dapibus nulla quis aliquet pulvinar. Ut mattis mi nibh, vel faucibus risus lobortis at. Phasellus rutrum sit amet nulla sed pharetra. Maecenas in purus at urna rutrum ultrices eu eu justo! Morbi sodales ligula sit amet augue ultricies vestibulum. Etiam quam mi, facilisis iaculis fringilla ac, faucibus at tortor. Integer sed dolor non arcu tempus dapibus vitae at ipsum. Praesent ultrices tincidunt lorem vel adipiscing. Proin mi lectus, id mi ac, semper eleifend neque. Ut dui leo, rutrum ac volutpat sed, lobortis in tortor. Suspendisse potenti.</p>\r\n<p>&nbsp;</p>\r\n<p>Integer at luctus nulla. Donec vel urna vitae enim tempus hendrerit! Fusce orci tortor, mattis eu vulputate sed, luctus sed purus. Quisque iaculis libero in ante mattis, id auctor augue adipiscing. Nulla fringilla imperdiet sapien. Proin at feugiat erat. Pellentesque facilisis fermentum massa. Vivamus lobortis arcu in orci facilisis ornare? Integer placerat, turpis et molestie vulputate, sem nibh mattis leo, vitae eleifend enim tortor sit amet ligula! Nam eu diam urna? Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Duis tortor turpis, consectetur tempus sodales ut, congue ac ligula. Vestibulum iaculis tortor lobortis sapien cursus congue. Donec vitae sem nunc. In vulputate facilisis nisi, ac hendrerit ipsum molestie eu. Pellentesque tempus enim vitae dui ultrices, in gravida massa dapibus.</p>\r\n<p>&nbsp;</p>\r\n<p>Vestibulum eu varius tortor. Integer tempor et lectus eu sollicitudin? Suspendisse vel augue ornare, viverra sapien ut, euismod tortor. Donec accumsan rutrum faucibus. Nulla venenatis arcu sit amet neque bibendum congue. Donec vestibulum risus diam, tristique varius nisl rutrum ut. Phasellus gravida odio quis tempus blandit! Duis at molestie libero. Pellentesque vel sapien felis. Fusce euismod ornare blandit. Maecenas in pharetra ligula. Suspendisse ac purus lectus. Nulla commodo quam sit amet lectus hendrerit ultricies. Etiam ornare convallis egestas.</p>\r\n<p>Pellentesque eget urna purus. Ut ullamcorper sit amet nisi eget semper. Donec ut magna nisi. Aenean a placerat arcu. Morbi placerat dui ac nunc tincidunt, in suscipit velit dapibus. Phasellus vel adipiscing mi, non eleifend tellus. Duis in mauris blandit, convallis dui et, pulvinar augue. Curabitur elementum hendrerit massa, ut consectetur justo? Sed eu sollicitudin neque, ut aliquet sapien.</p>\r\n<p>&nbsp;</p>\r\n<p>Praesent ullamcorper elit fringilla ligula malesuada tempor. Cras interdum gravida diam; quis convallis turpis. Donec porta aliquet odio in vestibulum. Morbi vitae magna metus? Aliquam posuere diam quis mollis mollis. Etiam sit amet luctus dui. Vivamus eget congue sem.</p>\r\n<p>&nbsp;</p>\r\n<p>Mauris ut tincidunt ante, vel rutrum tortor? Sed id quam orci. Pellentesque interdum, mauris non consequat sollicitudin, est urna faucibus tortor, sed mollis lacus lacus et elit. Nunc elementum lorem dui; quis blandit libero tincidunt quis. Fusce sed euismod leo, sit amet convallis magna. Sed ac massa sed dolor commodo tristique. Cras ullamcorper facilisis diam, ut aliquam sem. Nulla molestie in ligula vel dapibus? Suspendisse potenti. Donec convallis gravida nibh, vitae congue libero ultrices imperdiet. Nam congue sollicitudin congue. Curabitur volutpat elit convallis orci rhoncus, sed lacinia tellus pharetra. In hac habitasse platea dictumst.</p>', 24, 'N'),
(15, 'Sposoby i koszty dostawy', '', 26, 'Y'),
(16, 'About Us', '<p>Under construction</p>', 27, 'Y'),
(17, 'Über uns', '<p><span id="result_box" class="short_text" lang="de"><span class="hps">im Bau</span></span></p>', 28, 'Y'),
(23, 'Regulamin', '<p>Nam suscipit semper erat, sed tincidunt lectus. Nunc commodo elementum tincidunt. Aliquam et lectus tristique, dignissim urna sed, ullamcorper felis. Proin sodales congue sagittis. Phasellus vitae suscipit mi! Fusce vitae adipiscing nunc. Cras non quam hendrerit, consequat ante sit amet, adipiscing metus. Nam nisi leo, consectetur quis nisi id, convallis tincidunt nulla? Duis elementum ante tortor, non sagittis ligula pretium laoreet. Aliquam pharetra commodo mi a luctus.</p>\r\n<p>Quisque vitae nisi vitae enim convallis faucibus. Nullam nisl augue, sodales ut diam in, condimentum suscipit diam. Cras a porta felis. Nulla egestas vehicula elit, sit amet laoreet tortor. Duis metus libero, euismod ac pharetra id, hendrerit quis leo. Nullam vulputate in lorem ut pharetra. Nulla in viverra enim. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Nam interdum augue at arcu placerat, ut laoreet dui volutpat.</p>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent venenatis, nisl sit amet consequat lacinia, lectus elit euismod justo, sit amet porttitor est orci ac nisl. In elementum enim eu nulla porttitor, et feugiat nulla pulvinar. Aliquam pulvinar enim vel leo volutpat lobortis. Nulla a quam eu sapien scelerisque condimentum in a nisi? Nullam in consectetur quam. Sed quis metus ac libero rutrum mattis mollis vel eros. Maecenas eu metus massa. Nulla vitae rhoncus justo, non dapibus est. Vivamus et consequat nisi. Sed sed scelerisque mi, ac fermentum sem. Vestibulum vel lectus non eros adipiscing commodo id vel lectus. Praesent eget lectus mollis metus dictum sagittis. In egestas nec mi quis convallis. Pellentesque vehicula, turpis nec iaculis hendrerit, sapien sem convallis augue; at tristique lorem felis nec nisl. Aliquam commodo eros volutpat lacus consequat, sit amet vestibulum nulla eleifend.</p>\r\n<p>Aliquam ut purus vel nulla interdum fermentum! In posuere, dolor ut vulputate adipiscing, erat neque mollis velit, sed ornare sapien augue nec elit. Suspendisse metus odio, aliquam sit amet sem ut, varius fringilla dui. Integer porta mi id blandit lobortis! Pellentesque auctor libero elit; nec molestie massa aliquet sit amet. Fusce non fringilla erat, a rutrum nunc. Nam eget semper metus, sed sodales purus. Nunc pretium nisl at lectus sagittis, non tristique lorem porttitor! Nulla facilisi. Vivamus pharetra non mi sit amet eleifend. Pellentesque urna neque, dapibus sed porta a, consequat sed velit. Vivamus iaculis tellus sed ipsum congue, eget tempor magna elementum. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Sed vel convallis tortor, at ultricies velit! Aliquam vulputate consectetur iaculis. Vivamus interdum ornare mattis.</p>', 41, 'Y'),
(24, 'Polityka prywatności', '<p>Praesent vel aliquet justo? Nulla id condimentum lacus; malesuada lacinia sem. Sed vitae nibh sed risus laoreet aliquam at sed felis. Etiam sapien nisl, elementum eu tellus at, gravida egestas nulla. Praesent at fermentum erat. Nam pretium ipsum vel lacus mattis ornare. Proin quis gravida nisl. Ut erat neque, lacinia eu libero quis, convallis dapibus ante. In mattis velit sit amet tortor consectetur, ut viverra enim sodales. Suspendisse potenti. Curabitur congue adipiscing commodo.</p>\r\n<p>Morbi dolor lacus, condimentum ut elementum aliquet, venenatis non risus. Integer vel augue a nisi blandit aliquet. Sed faucibus euismod eleifend. Sed vestibulum tincidunt venenatis. Suspendisse varius, ante eget varius auctor; sapien justo gravida lacus, dictum semper dolor massa nec diam. Vestibulum euismod a ante sed dignissim. Integer convallis tellus at urna tempus commodo. Nulla facilisi. In dictum velit nec tellus lobortis, vel tincidunt lectus faucibus. Morbi in ultrices leo. Aliquam interdum neque ultricies enim auctor, vitae pulvinar mauris ullamcorper. Sed sit amet lorem quis eros congue pharetra ac eu nibh. Aliquam sagittis quis nibh sit amet dignissim. Curabitur suscipit risus vestibulum orci facilisis, id suscipit nunc vehicula. Mauris quam odio, vestibulum at erat vitae, consequat semper nisl.</p>\r\n<p>Duis odio augue, aliquam vel pellentesque vel, facilisis vel nisl. In ullamcorper, velit et elementum dictum, eros enim dictum dui, a elementum lectus lorem eget ante. Donec sagittis, arcu sit amet sollicitudin lacinia, quam elit semper lorem, ut aliquam lacus orci vel ante. Nunc in congue quam, eu egestas dui. Integer nec ante et metus hendrerit fringilla at ac sapien. Cras orci erat; convallis eu eros sed, egestas vestibulum est? Proin blandit vel urna sed viverra. Donec facilisis turpis sed fringilla mollis. Etiam sed diam sit amet mi porta tristique. Ut gravida neque in vehicula bibendum.</p>\r\n<p>Nunc auctor vulputate mollis. Nullam pulvinar sodales dolor, vitae pulvinar dui tincidunt rhoncus. Aliquam eget diam quis erat luctus euismod rhoncus eu justo. Fusce nisi libero; iaculis sed viverra eget, ullamcorper a lacus. Donec euismod mauris at dictum mollis. Vestibulum sed risus eleifend, luctus tellus volutpat, egestas nulla. Vestibulum placerat pellentesque purus, non gravida mi dictum a. Vestibulum sed nulla velit.</p>', 42, 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `partners`
--

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

-- --------------------------------------------------------

--
-- Table structure for table `polls_answers`
--

CREATE TABLE `polls_answers` (
  `id_answer` int(11) NOT NULL AUTO_INCREMENT,
  `question_id` int(11) NOT NULL,
  `language` char(20) DEFAULT 'pl_PL',
  `answer` varchar(255) NOT NULL,
  `votes` int(11) DEFAULT '0',
  PRIMARY KEY (`id_answer`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `polls_answers`
--

INSERT INTO `polls_answers` (`id_answer`, `question_id`, `language`, `answer`, `votes`) VALUES
(1, 1, 'pl_PL', 'Tak', 3),
(2, 1, 'pl_PL', 'Nie', 0),
(3, 1, 'pl_PL', 'Nie wiem', 1),
(4, 2, 'pl_PL', 'asd', 0),
(5, 2, 'pl_PL', 'asd', 0),
(12, 4, 'pl_PL', 'fadsads', 0),
(11, 4, 'pl_PL', 'sfasdasd', 0),
(9, 5, 'pl_PL', 'asdasd', 0);

-- --------------------------------------------------------

--
-- Table structure for table `polls_categories`
--

CREATE TABLE `polls_categories` (
  `id_poll_category` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) NOT NULL,
  `element_id` int(11) NOT NULL,
  PRIMARY KEY (`id_poll_category`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `polls_categories`
--

INSERT INTO `polls_categories` (`id_poll_category`, `category_name`, `element_id`) VALUES
(4, 'asdadsdas', 58),
(5, 'fghgfhgf', 60);

-- --------------------------------------------------------

--
-- Table structure for table `polls_questions`
--

CREATE TABLE `polls_questions` (
  `id_question` int(11) NOT NULL AUTO_INCREMENT,
  `question` varchar(255) NOT NULL,
  `language` char(5) NOT NULL DEFAULT 'pl_PL',
  `date_added` bigint(20) NOT NULL,
  `start_date` int(10) unsigned DEFAULT NULL,
  `end_date` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id_question`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `polls_questions`
--

INSERT INTO `polls_questions` (`id_question`, `question`, `language`, `date_added`, `start_date`, `end_date`) VALUES
(1, 'Czy podoba Ci się ta strona?', 'pl_PL', 1311943290, NULL, NULL),
(2, 'asd', 'pl_PL', 1403690114, NULL, NULL),
(4, 'sffasdasd', 'pl_PL', 1403701698, 0, 0),
(5, 'asdasd', 'pl_PL', 1403701760, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `polls_questions_to_categories`
--

CREATE TABLE `polls_questions_to_categories` (
  `id_poll_question_to_categories` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `poll_category_id` int(11) NOT NULL,
  `poll_question_id` int(11) NOT NULL,
  `active` enum('N','Y') DEFAULT 'N',
  PRIMARY KEY (`id_poll_question_to_categories`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `polls_questions_to_categories`
--

INSERT INTO `polls_questions_to_categories` (`id_poll_question_to_categories`, `poll_category_id`, `poll_question_id`, `active`) VALUES
(1, 1, 1, 'Y'),
(2, 2, 2, 'Y'),
(4, 4, 4, 'Y'),
(5, 4, 5, 'N');

-- --------------------------------------------------------

--
-- Table structure for table `polls_voters`
--

CREATE TABLE `polls_voters` (
  `question_id` int(10) unsigned NOT NULL,
  `answer_id` int(10) unsigned NOT NULL,
  `ip` char(15) NOT NULL,
  `mac` char(32) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `polls_voters`
--

INSERT INTO `polls_voters` (`question_id`, `answer_id`, `ip`, `mac`) VALUES
(1, 1, '127.0.0.1', ''),
(1, 1, '192.168.16.78', ''),
(1, 3, '192.168.16.77', ''),
(1, 1, '::1', '');

-- --------------------------------------------------------

--
-- Table structure for table `shop_attributes`
--

CREATE TABLE `shop_attributes` (
  `id_attribute` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `position` int(10) unsigned NOT NULL,
  `active` enum('Y','N') CHARACTER SET latin1 NOT NULL DEFAULT 'Y',
  PRIMARY KEY (`id_attribute`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `shop_attributes`
--

INSERT INTO `shop_attributes` (`id_attribute`, `position`, `active`) VALUES
(7, 0, 'Y'),
(4, 0, 'Y'),
(8, 0, 'N');

-- --------------------------------------------------------

--
-- Table structure for table `shop_attributes_description`
--

CREATE TABLE `shop_attributes_description` (
  `attribute_id` int(10) unsigned NOT NULL,
  `attribute_name` varchar(128) NOT NULL,
  `attribute_language` char(5) NOT NULL DEFAULT 'pl_PL'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `shop_attributes_description`
--

INSERT INTO `shop_attributes_description` (`attribute_id`, `attribute_name`, `attribute_language`) VALUES
(7, 'Rozmiar', 'pl_PL'),
(4, 'Kolor', 'pl_PL'),
(8, 'test', 'pl_PL');

-- --------------------------------------------------------

--
-- Table structure for table `shop_attributes_values`
--

CREATE TABLE `shop_attributes_values` (
  `id_attribute_value` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `attribute_id` int(10) unsigned NOT NULL,
  `position` int(10) unsigned NOT NULL,
  `default` enum('N','Y') CHARACTER SET latin1 NOT NULL DEFAULT 'N',
  `active` enum('Y','N') CHARACTER SET latin1 NOT NULL DEFAULT 'Y',
  PRIMARY KEY (`id_attribute_value`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=46 ;

--
-- Dumping data for table `shop_attributes_values`
--

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

-- --------------------------------------------------------

--
-- Table structure for table `shop_attributes_values_additional`
--

CREATE TABLE `shop_attributes_values_additional` (
  `attribute_value_id` int(10) NOT NULL,
  `attribute_color` varchar(255) NOT NULL,
  `attribute_pattern` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `shop_attributes_values_additional`
--

INSERT INTO `shop_attributes_values_additional` (`attribute_value_id`, `attribute_color`, `attribute_pattern`) VALUES
(11, '0313FF', ''),
(10, 'FF0A0A', ''),
(12, '000000', ''),
(26, '33FF47', ''),
(25, 'FF14D8', ''),
(37, 'FFFFFF', ''),
(32, 'FFFFFF', '');

-- --------------------------------------------------------

--
-- Table structure for table `shop_attributes_values_description`
--

CREATE TABLE `shop_attributes_values_description` (
  `attribute_value_id` int(10) unsigned NOT NULL,
  `attribute_value` varchar(255) NOT NULL,
  `attribute_value_language` char(5) NOT NULL DEFAULT 'pl_PL'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `shop_attributes_values_description`
--

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

-- --------------------------------------------------------

--
-- Table structure for table `shop_categories`
--

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=42 ;

--
-- Dumping data for table `shop_categories`
--

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

-- --------------------------------------------------------

--
-- Table structure for table `shop_categories_description`
--

CREATE TABLE `shop_categories_description` (
  `category_id` int(10) unsigned NOT NULL,
  `category_name` varchar(128) NOT NULL,
  `category_language` char(5) NOT NULL DEFAULT 'pl_PL'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `shop_categories_description`
--

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

-- --------------------------------------------------------

--
-- Table structure for table `shop_configuration`
--

CREATE TABLE `shop_configuration` (
  `id_configuration` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(255) NOT NULL DEFAULT '',
  `value` text NOT NULL,
  `name` varchar(255) NOT NULL,
  `desc` varchar(255) NOT NULL DEFAULT '',
  `group` varchar(255) NOT NULL DEFAULT '',
  `type` varchar(64) NOT NULL DEFAULT 'text',
  PRIMARY KEY (`id_configuration`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `shop_configuration`
--

INSERT INTO `shop_configuration` (`id_configuration`, `key`, `value`, `name`, `desc`, `group`, `type`) VALUES
(1, 'product_stock', '0', 'Stany magazynowe', 'Ogólne stany magazynowe dla produktu', '', 'integer'),
(2, 'rebates_codes', '1', 'Kody rabatowe', 'Kody rabatowe', '', 'integer');

-- --------------------------------------------------------

--
-- Table structure for table `shop_currencies`
--

CREATE TABLE `shop_currencies` (
  `id_currency` int(11) NOT NULL AUTO_INCREMENT,
  `currency_name` varchar(255) NOT NULL,
  `currency_code` varchar(255) NOT NULL,
  `currency_unit` int(11) DEFAULT NULL,
  `currency_factor` decimal(10,4) NOT NULL,
  `currency_active` enum('Y','N') NOT NULL DEFAULT 'Y',
  `currency_default` enum('Y','N') NOT NULL DEFAULT 'N',
  KEY `id_currency` (`id_currency`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `shop_currencies`
--

INSERT INTO `shop_currencies` (`id_currency`, `currency_name`, `currency_code`, `currency_unit`, `currency_factor`, `currency_active`, `currency_default`) VALUES
(14, 'Frank szwajcarski', 'CHF', NULL, '3.4000', 'Y', 'N'),
(1, 'Polski złoty', 'zł', 1, '1.0000', 'Y', 'Y'),
(15, 'Euro', 'EUR', NULL, '4.1000', 'N', 'N');

-- --------------------------------------------------------

--
-- Table structure for table `shop_customers`
--

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=37 ;

--
-- Dumping data for table `shop_customers`
--

INSERT INTO `shop_customers` (`id_customer`, `gender`, `customer_password`, `customer_email`, `customer_first_name`, `customer_last_name`, `customer_company_name`, `customer_nip`, `customer_city`, `customer_zip`, `customer_address`, `customer_state`, `customer_country`, `customer_www`, `customer_phoneno`, `customer_faxno`, `customer_mobileno`, `delivery_email`, `delivery_first_name`, `delivery_last_name`, `delivery_company_name`, `delivery_nip`, `delivery_city`, `delivery_zip`, `delivery_address`, `delivery_state`, `delivery_country`, `delivery_www`, `delivery_phoneno`, `delivery_faxno`, `delivery_mobileno`, `invoice_email`, `invoice_first_name`, `invoice_last_name`, `invoice_company_name`, `invoice_nip`, `invoice_city`, `invoice_zip`, `invoice_address`, `invoice_state`, `invoice_country`, `invoice_www`, `invoice_phoneno`, `invoice_faxno`, `invoice_mobileno`, `customer_rebate`, `verify_string`, `verified`, `points`, `active`, `accept_terms`, `accept_terms2`, `accept_terms3`) VALUES
(29, NULL, '*1F2D53ED0D19B9DADF2B8EE3E99C7A0B3BBDFFE6', 'hubert@olicom.pl', 'test', 'testt', '', '', 'Poznań', '60-160', 'test 5', '', 'Polska', '', '555666777', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 10, 'f81e9a851ace2154ebfe015200eaba4b', 'N', NULL, 'Y', 1, 1, 0),
(36, NULL, '*E19D4321AFDAB58F6358C8EE71B76679FF67E675', 'pawel@olicom.pl', 'Paweł', 'Mor', NULL, NULL, 'Posen', '12-365', 'testowa 3', NULL, '', NULL, '123456798', NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '9689b56028a4b4ebb3915bf889bf306e', 'Y', NULL, 'Y', 1, 1, 0),
(34, NULL, '*AA1420F182E88B9E5F874F6FBE7459291E8F4601', 'hubert@olicom.pl', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 20, '8699e3e8200ef1edac7db009206d5515', 'Y', NULL, 'Y', 1, 1, 0),
(35, NULL, '*FFA6AC286C830AB2E26889515200CB5CF549F373', 'artur@olicom.org.pl', 'Artur', 'Oli', NULL, NULL, '', '', '', NULL, '', NULL, '', NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '9c3ab4b1ca72cf94231c6634290392d4', 'Y', NULL, 'Y', 1, 1, 0),
(32, NULL, '*AA1420F182E88B9E5F874F6FBE7459291E8F4601', 'hubert@olicom.org.pl', 'Hubert', 'kkkk', '', '', 'test', '44-444', 'Kmicica 1', '', 'pl', '', '333444555', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 'a197f8e0348b7dcd3b535abffab3f9bc', 'N', NULL, 'Y', 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `shop_customers_clipboard`
--

CREATE TABLE `shop_customers_clipboard` (
  `id_clipboard` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `customer_id` int(10) unsigned NOT NULL,
  `product_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id_clipboard`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `shop_customers_subscriptions`
--

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `shop_delivery_ranges`
--

CREATE TABLE `shop_delivery_ranges` (
  `id_shop_delivery_ranges` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `range_from` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT 'zawarta',
  `range_to` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT 'niezawarta',
  `delivery_price` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `delivery_type_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id_shop_delivery_ranges`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `shop_delivery_ranges`
--

INSERT INTO `shop_delivery_ranges` (`id_shop_delivery_ranges`, `range_from`, `range_to`, `delivery_price`, `delivery_type_id`) VALUES
(1, '1.00', '99999999.00', '25.00', 5),
(2, '1.00', '99999999.00', '7.00', 6),
(3, '1.00', '10000.00', '15.00', 7);

-- --------------------------------------------------------

--
-- Table structure for table `shop_delivery_types`
--

CREATE TABLE `shop_delivery_types` (
  `id_delivery_type` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `active` enum('Y','N') DEFAULT 'Y',
  `cash_on_delivery` tinyint(4) NOT NULL DEFAULT '0' COMMENT '1 za pobraniem',
  PRIMARY KEY (`id_delivery_type`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `shop_delivery_types`
--

INSERT INTO `shop_delivery_types` (`id_delivery_type`, `active`, `cash_on_delivery`) VALUES
(5, 'Y', 0),
(6, 'Y', 0),
(7, 'Y', 0),
(10, 'N', 0);

-- --------------------------------------------------------

--
-- Table structure for table `shop_delivery_types_description`
--

CREATE TABLE `shop_delivery_types_description` (
  `delivery_type_id` int(10) unsigned NOT NULL,
  `delivery_type` varchar(255) NOT NULL,
  `delivery_type_language` char(5) DEFAULT 'pl_PL'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `shop_delivery_types_description`
--

INSERT INTO `shop_delivery_types_description` (`delivery_type_id`, `delivery_type`, `delivery_type_language`) VALUES
(5, 'Kurier', 'pl_PL'),
(6, 'Poczta Polska', 'pl_PL'),
(7, 'carrier', 'en_US'),
(10, 'ghjfd', 'pl_PL');

-- --------------------------------------------------------

--
-- Table structure for table `shop_favourites_customers_products`
--

CREATE TABLE `shop_favourites_customers_products` (
  `customer_id` int(10) unsigned NOT NULL,
  `product_id` int(10) unsigned NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `shop_measurement_units`
--

CREATE TABLE `shop_measurement_units` (
  `id_measurement_unit` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `active` enum('Y','N') NOT NULL DEFAULT 'Y',
  PRIMARY KEY (`id_measurement_unit`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `shop_measurement_units_description`
--

CREATE TABLE `shop_measurement_units_description` (
  `measurement_unit_id` int(10) unsigned NOT NULL,
  `measurement_language` char(5) NOT NULL,
  `measurement_name` varchar(128) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `shop_orders`
--

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
  PRIMARY KEY (`id_order`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED AUTO_INCREMENT=94 ;

--
-- Dumping data for table `shop_orders`
--

INSERT INTO `shop_orders` (`id_order`, `order_number`, `current_number`, `current_number_year`, `current_number_month`, `current_number_day`, `client_id`, `order_date`, `status_id`, `payment_type`, `payment_cost`, `clients_note`, `products_cost`, `delivery_type`, `delivery_cost`, `additional_cost`, `order_cost`, `invoice`, `confirmation`, `confirmation_date`, `paid`, `closed`, `client_ip`, `seller_note`, `customer_note`, `confirm_email`, `confirm_string`, `confirmed`, `session_id`, `lang`, `p24_return_status`, `p24_order_id`, `delivery_comments`, `currency`, `factor`, `rebate_code`, `rebate_value`, `rebate_cost`, `customer_rebate`) VALUES
(26, '1/2013/12/16', 1, 2013, 12, 16, 0, '1387200954', 1, 0, 0.00, '', 99.00, 5, 25.00, 0.00, 124.00, 'N', 'N', NULL, 'N', 'N', '::1', NULL, '', 'pawel@olicom.pl', 'c80f1af2556f2ab93dd4d92d19f6a56b', 'N', '', 'pl_PL', '', '', NULL, 'PLN', '1.0000', NULL, NULL, NULL, NULL),
(27, '2/2013/12/16', 2, 2013, 12, 16, 0, '1387201244', 1, 0, 0.00, '', 99.00, 5, 25.00, 0.00, 124.00, 'N', 'N', NULL, 'N', 'N', '::1', NULL, '', 'pawel@olicom.pl', 'b84aad097718321b8760a91a697c8b99', 'N', '27|1387201479', 'pl_PL', '', '', NULL, 'PLN', '1.0000', NULL, NULL, NULL, NULL),
(28, '1/2013/12/23', 1, 2013, 12, 23, 28, '1387794300', 1, 0, 0.00, '', 66.00, 5, 25.00, 0.00, 91.00, 'N', 'N', NULL, 'N', 'N', '::1', NULL, 'test', 'pawel@olicom.org.pl', 'e941747d4edbf58f9e9bff0b5dcd0fb2', 'N', '', 'pl_PL', '', '', NULL, 'PLN', '1.0000', NULL, NULL, NULL, NULL),
(29, '2/2013/12/23', 2, 2013, 12, 23, 0, '1387794486', 1, 0, 0.00, '', 66.00, 5, 25.00, 0.00, 91.00, 'N', 'N', NULL, 'N', 'N', '::1', NULL, 'test', 'pawel@olicom.org.pl', '025ea6a4239f19598df93d9f63612286', 'N', '', 'pl_PL', '', '', NULL, 'PLN', '1.0000', NULL, NULL, NULL, NULL),
(30, '3/2013/12/23', 3, 2013, 12, 23, 0, '1387794569', 1, 0, 0.00, '', 66.00, 5, 25.00, 0.00, 91.00, 'N', 'N', NULL, 'N', 'N', '::1', NULL, 'test', 'pawel@olicom.org.pl', '504a9bde2a9d401e8e10e938cd53a49e', 'N', '', 'pl_PL', '', '', NULL, 'PLN', '1.0000', NULL, NULL, NULL, NULL),
(31, '4/2013/12/23', 4, 2013, 12, 23, 0, '1387794636', 1, 0, 0.00, '', 66.00, 5, 25.00, 0.00, 91.00, 'N', 'N', NULL, 'N', 'N', '::1', NULL, 'test', 'pawel@olicom.org.pl', '249544f7cd747ee8818d8aef2cfb27dc', 'N', '', 'pl_PL', '', '', NULL, 'PLN', '1.0000', NULL, NULL, NULL, NULL),
(32, '5/2013/12/23', 5, 2013, 12, 23, 0, '1387794772', 1, 0, 0.00, '', 66.00, 5, 25.00, 0.00, 91.00, 'N', 'N', NULL, 'N', 'N', '::1', NULL, 'test', 'pawel@olicom.org.pl', '87fcb89534e4cd878286eae200d1c61b', 'N', '', 'pl_PL', '', '', NULL, 'PLN', '1.0000', NULL, NULL, NULL, NULL),
(33, '6/2013/12/23', 6, 2013, 12, 23, 0, '1387794784', 1, 0, 0.00, '', 66.00, 5, 25.00, 0.00, 91.00, 'N', 'N', NULL, 'N', 'N', '::1', NULL, 'test', 'pawel@olicom.org.pl', 'e0995a785029b339f413465e15d02abe', 'N', '', 'pl_PL', '', '', NULL, 'PLN', '1.0000', NULL, NULL, NULL, NULL),
(34, '7/2013/12/23', 7, 2013, 12, 23, 0, '1387794924', 1, 0, 0.00, '', 66.00, 5, 25.00, 0.00, 91.00, 'N', 'N', NULL, 'N', 'N', '::1', NULL, 'test', 'pawel@olicom.org.pl', 'ed75c8d681aa3cc529314ed28df2ae06', 'N', '', 'pl_PL', '', '', NULL, 'PLN', '1.0000', NULL, NULL, NULL, NULL),
(35, '8/2013/12/23', 8, 2013, 12, 23, 0, '1387794957', 1, 0, 0.00, '', 66.00, 5, 25.00, 0.00, 91.00, 'N', 'N', NULL, 'N', 'N', '::1', NULL, 'test', 'pawel@olicom.org.pl', '2ccefae3867c31cf96b990341a476250', 'N', '', 'pl_PL', '', '', NULL, 'PLN', '1.0000', NULL, NULL, NULL, NULL),
(36, '9/2013/12/23', 9, 2013, 12, 23, 0, '1387794974', 1, 0, 0.00, '', 66.00, 5, 25.00, 0.00, 91.00, 'N', 'N', NULL, 'N', 'N', '::1', NULL, 'test', 'pawel@olicom.org.pl', '262da1cde03baa759ee81afd664315f4', 'N', '', 'pl_PL', '', '', NULL, 'PLN', '1.0000', NULL, NULL, NULL, NULL),
(37, '10/2013/12/23', 10, 2013, 12, 23, 0, '1387795031', 1, 0, 0.00, '', 66.00, 5, 25.00, 0.00, 91.00, 'N', 'N', NULL, 'N', 'N', '::1', NULL, 'test', 'pawel@olicom.org.pl', 'bdf80c55f9ed3e43eedaa24684f20c3d', 'N', '', 'pl_PL', '', '', NULL, 'PLN', '1.0000', NULL, NULL, NULL, NULL),
(38, '11/2013/12/23', 11, 2013, 12, 23, 0, '1387795060', 1, 0, 0.00, '', 66.00, 5, 25.00, 0.00, 91.00, 'N', 'N', NULL, 'N', 'N', '::1', NULL, 'test', 'pawel@olicom.org.pl', 'b7193ec402c12ca1e95cf0522f824f4d', 'N', '', 'pl_PL', '', '', NULL, 'PLN', '1.0000', NULL, NULL, NULL, NULL),
(39, '12/2013/12/23', 12, 2013, 12, 23, 0, '1387795088', 1, 0, 0.00, '', 99.00, 6, 7.00, 0.00, 106.00, 'N', 'N', NULL, 'N', 'N', '::1', NULL, '', 'pawel@olicom.org.pl', '1f13fc08b66428d90c10e8c3204305d1', 'N', '', 'pl_PL', '', '', NULL, 'PLN', '1.0000', NULL, NULL, NULL, NULL),
(40, '13/2013/12/23', 13, 2013, 12, 23, 0, '1387795158', 1, 0, 0.00, '', 99.00, 6, 7.00, 0.00, 106.00, 'N', 'N', NULL, 'N', 'N', '::1', NULL, '', 'pawel@olicom.org.pl', '4337098eace64659124f12fdddc36b9e', 'N', '', 'pl_PL', '', '', NULL, 'PLN', '1.0000', NULL, NULL, NULL, NULL),
(41, '14/2013/12/23', 14, 2013, 12, 23, 0, '1387795288', 1, 0, 0.00, '', 99.00, 6, 7.00, 0.00, 106.00, 'N', 'N', NULL, 'N', 'N', '::1', NULL, '', 'pawel@olicom.pl', 'aabe05316268a688173c3e5c016c598c', 'N', '', 'pl_PL', '', '', NULL, 'PLN', '1.0000', NULL, NULL, NULL, NULL),
(42, '15/2013/12/23', 15, 2013, 12, 23, 0, '1387795427', 1, 0, 0.00, '', 99.00, 6, 7.00, 0.00, 106.00, 'N', 'N', NULL, 'N', 'N', '::1', NULL, '', 'pawel@olicom.pl', '2d95e8b57a1deeb63d9aca4434a58e5e', 'N', '42|1387799541', 'pl_PL', '', '', NULL, 'PLN', '1.0000', NULL, NULL, NULL, NULL),
(43, '1/2014/01/03', 1, 2014, 1, 3, 0, '1388749967', 1, 0, 0.00, '', 120.00, 6, 7.00, 0.00, 127.00, 'N', 'N', NULL, 'N', 'N', '::1', NULL, '', 'pawel@olicom.pl', '746a537e490412459386f09ffb8cfcad', 'N', '', 'pl_PL', '', '', NULL, 'PLN', '1.0000', NULL, NULL, NULL, NULL),
(44, '2/2014/01/03', 2, 2014, 1, 3, 0, '1388750139', 1, 0, 0.00, '', 120.00, 6, 7.00, 0.00, 127.00, 'N', 'N', NULL, 'N', 'N', '::1', NULL, '', 'pawel@olicom.pl', '5cf12c423ec8ec26531374ac067f11f2', 'N', '44|1388750149', 'pl_PL', '', '', NULL, 'PLN', '1.0000', NULL, NULL, NULL, NULL),
(45, '1/2014/01/07', 1, 2014, 1, 7, 0, '1389101062', 1, 0, 0.00, '', 600.00, 6, 7.00, 0.00, 607.00, 'N', 'N', NULL, 'N', 'N', '::1', NULL, '', 'pawel@olicom.org.pl', 'dd954ba123c9d1658cace8df98b71163', 'N', '45|1389101078', 'pl_PL', '', '', NULL, 'PLN', '1.0000', NULL, NULL, NULL, NULL),
(46, '1/2014/01/08', 1, 2014, 1, 8, 27, '1389174835', 1, 0, 0.00, '', 144.00, 6, 7.00, 0.00, 151.00, 'N', 'N', NULL, 'N', 'N', '::1', NULL, '', 'pawel@olicom.org.pl', '3d9193c6c3a9214efb273ecc6ef17744', 'N', '46|1389174848', 'pl_PL', '', '', NULL, 'PLN', '1.0000', NULL, NULL, NULL, NULL),
(47, '2/2014/01/08', 2, 2014, 1, 8, 27, '1389176386', 1, 0, 0.00, '', 33.00, 6, 7.00, 0.00, 40.00, 'N', 'N', NULL, 'N', 'N', '::1', NULL, '', 'pawel@olicom.org.pl', 'e5d798de863bac20d2ab0a9d28ad03c7', 'N', '47|1389178249', 'pl_PL', '', '', NULL, 'PLN', '1.0000', NULL, NULL, NULL, NULL),
(48, '1/2014/01/20', 1, 2014, 1, 20, 0, '1390223248', 1, 0, 0.00, '', 10.00, 6, 7.00, 0.00, 17.00, 'N', 'N', NULL, 'N', 'N', '::1', NULL, 'eee tam', 'pawel@olicom.pl', '596a5dd51d147e4cb5780ea9bcfb392e', 'N', '48|1390224001', 'pl_PL', '', '', NULL, 'PLN', '1.0000', NULL, NULL, NULL, NULL),
(49, '2/2014/01/20', 2, 2014, 1, 20, 0, '1390224262', 1, 0, 0.00, '', 10.00, 7, 15.00, 0.00, 25.00, 'N', 'N', NULL, 'N', 'N', '::1', NULL, 'testtesttest', 'pawel@olicom.pl', '4766af11e31eef87b0471324c74354c7', 'N', '49|1390224413', 'en_US', '', '', NULL, 'PLN', '1.0000', NULL, NULL, NULL, NULL),
(50, '1/2014/01/23', 1, 2014, 1, 23, 0, '1390476647', 1, 0, 0.00, '', 20.00, 5, 25.00, 0.00, 45.00, 'N', 'N', NULL, 'N', 'N', '::1', NULL, '', 'pawel@olicom.org.pl', '8638c0bc61a90220dc8097fbae500182', 'N', '50|1390477106', 'pl_PL', '', '', NULL, 'PLN', '1.0000', NULL, NULL, NULL, NULL),
(51, '2/2014/01/23', 2, 2014, 1, 23, 0, '1390478017', 1, 0, 0.00, '', 10.00, 7, 15.00, 0.00, 25.00, 'N', 'N', NULL, 'N', 'N', '::1', NULL, '', 'pawel@olicom.pl', '02dfe2e3e024698d9bcade4be4e6c9ea', 'N', '51|1390478025', 'en_US', '', '', NULL, 'EUR', '4.0000', NULL, NULL, NULL, NULL),
(52, '3/2014/01/23', 3, 2014, 1, 23, 0, '1390479815', 1, 0, 0.00, '', 10.00, 6, 7.00, 0.00, 17.00, 'N', 'N', NULL, 'N', 'N', '::1', NULL, '', 'pawel@olicom.pl', '1d51838202c589c692c262f6940ef82f', 'N', '52|1390481086', 'pl_PL', '', '', NULL, 'EUR', '4.1669', NULL, NULL, NULL, NULL),
(53, '1/2014/01/30', 1, 2014, 1, 30, 0, '1391083951', 1, 0, 0.00, '', 180.00, 6, 7.00, 0.00, 187.00, 'N', 'N', NULL, 'N', 'N', '::1', NULL, 'test', 'pawel@olicom.pl', '5bdae14dc9dade67b129e78eed82dc58', 'N', '53|1391096004', 'pl_PL', '', '', NULL, 'PLN', '1.0000', NULL, NULL, NULL, NULL),
(54, '2/2014/01/30', 2, 2014, 1, 30, 31, '1391089670', 1, 0, 0.00, '', 330.00, 5, 25.00, 0.00, 355.00, 'N', 'N', NULL, 'N', 'N', '127.0.0.1', NULL, 'test', 'hubert@olicom.pl', '7fc62cd6873757fb571479c7160b31c4', 'N', '54|1391089677', 'pl_PL', '', '', NULL, 'PLN', '1.0000', NULL, NULL, NULL, NULL),
(55, '1/2014/01/31', 1, 2014, 1, 31, 0, '1391174286', 1, 0, 0.00, '', 44.00, 5, 25.00, 0.00, 69.00, 'N', 'N', NULL, 'N', 'N', '::1', NULL, '', 'pawel@olicom.pl', '0a07e740445adfef0de5a6406483871b', 'N', '55|1391175194', 'pl_PL', '', '', NULL, 'PLN', '1.0000', NULL, NULL, NULL, NULL),
(56, '2/2014/01/31', 2, 2014, 1, 31, 0, '1391176994', 1, 0, 0.00, '', 704.00, 5, 25.00, 0.00, 729.00, 'N', 'N', NULL, 'N', 'N', '::1', NULL, '', 'pawel@olicom.org.pl', '85b946e63d7e3933988eb8fb52d84ba2', 'N', '56|1391177007', 'pl_PL', '', '', NULL, 'PLN', '1.0000', NULL, NULL, NULL, NULL),
(57, '1/2014/02/05', 1, 2014, 2, 5, 0, '1391605837', 1, 0, 0.00, '', 374.00, 6, 7.00, 0.00, 381.00, 'N', 'N', NULL, 'N', 'N', '127.0.0.1', NULL, 'uytut', 'hubert@olicom.pl', '72536650eea1e16492d3507744d5d0f6', 'N', '57|1391605843', 'pl_PL', '', '', NULL, 'PLN', '1.0000', NULL, NULL, NULL, NULL),
(58, '1/2014/02/07', 1, 2014, 2, 7, 0, '1391761516', 1, 0, 0.00, '', 330.00, 5, 25.00, 0.00, 355.00, 'N', 'N', NULL, 'N', 'N', '127.0.0.1', NULL, 'test', 'hubert@olicom.org.pl', 'c8840d7dbad08152889802cc37375f41', 'N', '58|1391761522', 'pl_PL', '', '', NULL, 'zł', '1.0000', NULL, NULL, NULL, NULL),
(59, '2/2014/02/07', 2, 2014, 2, 7, 31, '1391769910', 1, 0, 0.00, '', 55.00, 5, 25.00, 0.00, 80.00, 'N', 'N', NULL, 'N', 'N', '127.0.0.1', NULL, '', 'hubert@olicom.pl', '314b2dfa344bb8d51a985a10d9a4e20f', 'N', '59|1391769916', 'pl_PL', '', '', NULL, 'zł', '1.0000', NULL, NULL, NULL, NULL),
(60, '1/2014/02/10', 1, 2014, 2, 10, 31, '1392029555', 1, 0, 0.00, '', 1760.00, 6, 7.00, 0.00, 1767.00, 'N', 'N', NULL, 'N', 'N', '127.0.0.1', NULL, 'jnjknjk', 'hubert@olicom.pl', 'dae9efbfb0d9437a1971f760020f7484', 'N', '60|1392029562', 'pl_PL', '', '', NULL, 'zł', '1.0000', NULL, NULL, NULL, NULL),
(61, '2/2014/02/10', 2, 2014, 2, 10, 31, '1392033227', 1, 1, 0.00, '', 44.00, 5, 25.00, 0.00, 69.00, 'N', 'N', NULL, 'N', 'N', '127.0.0.1', NULL, 'test', 'hubert@olicom.pl', '6401fbb8d4dd86b3d9fee090495c3070', 'N', '61|1392033233', 'pl_PL', '', '', NULL, 'zł', '1.0000', NULL, NULL, NULL, NULL),
(62, '3/2014/02/10', 3, 2014, 2, 10, 31, '1392034146', 1, 1, 0.00, '', 44.00, 5, 25.00, 0.00, 69.00, 'N', 'N', NULL, 'N', 'N', '127.0.0.1', NULL, 'fhn', 'hubert@olicom.pl', '45985b88974b9da1c5fcccb958373972', 'N', '62|1392041631', 'pl_PL', '', '', NULL, 'zł', '1.0000', NULL, NULL, NULL, NULL),
(63, '4/2014/02/10', 4, 2014, 2, 10, 31, '1392037756', 1, 3, 0.00, '', 660.00, 6, 7.00, 0.00, 667.00, 'N', 'N', NULL, 'N', 'N', '127.0.0.1', NULL, 'bfg', 'hubert@olicom.pl', 'b7ac1de951edcbeb8d2714b2231e1bd7', 'N', '63|1392041682', 'pl_PL', '', '', NULL, 'zł', '1.0000', NULL, NULL, NULL, NULL),
(64, '1/2014/02/11', 1, 2014, 2, 11, 0, '1392103933', 1, 1, 0.00, '', 44.00, 6, 7.00, 0.00, 51.00, 'N', 'N', NULL, 'N', 'N', '127.0.0.1', NULL, 'test', 'hubert@olicom.pl', 'aba8c096f0dc1066dc25350ebde12bba', 'N', '64|1392103939', 'pl_PL', '', '', NULL, 'zł', '1.0000', NULL, NULL, NULL, NULL),
(65, '2/2014/02/11', 2, 2014, 2, 11, 0, '1392104532', 1, 2, 0.00, '', 44.00, 5, 25.00, 0.00, 69.00, 'N', 'N', NULL, 'N', 'N', '127.0.0.1', NULL, 'test', 'asd-zyg@wp.pl', '595eb590ea9ac0ba41d92b5617589653', 'N', '65|1392104537', 'pl_PL', '', '', NULL, 'zł', '1.0000', NULL, NULL, NULL, NULL),
(66, '3/2014/02/11', 3, 2014, 2, 11, 0, '1392104928', 1, 1, 0.00, '', 44.00, 6, 7.00, 0.00, 51.00, 'N', 'N', NULL, 'N', 'N', '127.0.0.1', NULL, 'test', 'asd-zyg@wp.pl', 'd1a4ec177fa244926b0e531d362c0f96', 'N', '66|1392104933', 'pl_PL', '', '', NULL, 'zł', '1.0000', NULL, NULL, NULL, NULL),
(67, '4/2014/02/11', 4, 2014, 2, 11, 0, '1392105108', 1, 1, 0.00, '', 44.00, 6, 7.00, 0.00, 51.00, 'N', 'N', NULL, 'N', 'N', '127.0.0.1', NULL, 'test', 'asd-zyg@wp.pl', '76e80ca619723a771ced1eed1aedf370', 'N', '67|1392105113', 'pl_PL', '', '', NULL, 'zł', '1.0000', NULL, NULL, NULL, NULL),
(68, '5/2014/02/11', 5, 2014, 2, 11, 0, '1392105258', 1, 1, 0.00, '', 44.00, 6, 7.00, 0.00, 51.00, 'N', 'N', NULL, 'N', 'N', '127.0.0.1', NULL, 'test', 'asd-zyg@wp.pl', '2007d768c9c782b2596d804bed8d7fcb', 'N', '68|1392105273', 'pl_PL', '', '', NULL, 'zł', '1.0000', NULL, NULL, NULL, NULL),
(69, '1/2014/02/14', 1, 2014, 2, 14, 0, '1392367521', 3, 1, 0.00, '', 44.00, 5, 25.00, 0.00, 69.00, 'N', 'N', NULL, 'Y', 'N', '127.0.0.1', NULL, 'test', 'hubert@olicom.pl', '4d63453c7ad465e94daae46bd5494981', 'N', '69|1392367526', 'pl_PL', '', '', '', 'zł', '1.0000', NULL, NULL, NULL, NULL),
(70, '1/2014/02/19', 1, 2014, 2, 19, 0, '1392813401', 1, 1, 0.00, '', 330.00, 5, 25.00, 0.00, 355.00, 'N', 'N', NULL, 'N', 'N', '::1', NULL, '', 'pawel@olicom.org.pl', '996ab42252c5936464f32f667ac9a782', 'N', '70|1392813412', 'pl_PL', '', '', NULL, 'zł', '1.0000', NULL, NULL, NULL, NULL),
(71, '1/2014/02/20', 1, 2014, 2, 20, 0, '1392888520', 1, 1, 0.00, '', 132.00, 5, 25.00, 0.00, 157.00, 'N', 'N', NULL, 'N', 'N', '::1', NULL, 'test', 'pawel@olicom.org.pl', 'ace289ed16c2cd37b46078a47b33d4ce', 'N', '71|1392888530', 'pl_PL', '', '', NULL, 'zł', '1.0000', NULL, NULL, NULL, NULL),
(72, '2/2014/02/20', 2, 2014, 2, 20, 33, '1392904845', 1, 1, 0.00, '', 44.00, 6, 7.00, 0.00, 51.00, 'N', 'N', NULL, 'Y', 'N', '::1', NULL, '', 'pawel@olicom.org.pl', 'af062f47396362025b4c92e6f09f0eb5', 'N', '72|1392904952', 'pl_PL', '', '', '', 'zł', '1.0000', NULL, NULL, NULL, NULL),
(73, '1/2014/03/17', 1, 2014, 3, 17, 0, '1395064098', 1, 3, 0.00, '', 0.00, 5, 25.00, 0.00, 0.00, 'N', 'N', NULL, 'N', 'N', '127.0.0.1', NULL, 'test', 'hubert@olicom.pl', 'e41d8256ececf1d897689a5b84d94522', 'N', '73|1395064235', 'pl_PL', '', '', NULL, 'zł', '1.0000', 'code-1', 10, NULL, NULL),
(74, '2/2014/03/17', 2, 2014, 3, 17, 0, '1395064493', 1, 3, 0.00, '', 49.50, 5, 25.00, 0.00, 74.50, 'N', 'N', NULL, 'N', 'N', '127.0.0.1', NULL, '', 'hubert@olicom.pl', '1998bff449b29bcf67ed778b06bc5685', 'N', '74|1395064499', 'pl_PL', '', '', NULL, 'zł', '1.0000', 'code-1', 10, NULL, NULL),
(75, '3/2014/03/17', 3, 2014, 3, 17, 0, '1395065283', 1, 3, 0.00, '', 49.50, 5, 25.00, 0.00, 74.50, 'N', 'N', NULL, 'N', 'N', '127.0.0.1', NULL, '', 'hubert@olicom.pl', '51ee257b091e1f12bac9b196d2de3d8e', 'N', '75|1395065288', 'pl_PL', '', '', NULL, 'zł', '1.0000', 'code-1', 10, NULL, NULL),
(76, '4/2014/03/17', 4, 2014, 3, 17, 0, '1395065741', 1, 3, 0.00, '', 49.50, 5, 25.00, 0.00, 74.50, 'N', 'N', NULL, 'N', 'N', '127.0.0.1', NULL, '', 'hubert@olicom.pl', 'f130eafef5084215d353581b5e3aa8a5', 'N', '76|1395065745', 'pl_PL', '', '', NULL, 'zł', '1.0000', 'code-1', 10, NULL, NULL),
(77, '5/2014/03/17', 5, 2014, 3, 17, 0, '1395065865', 1, 3, 0.00, '', 49.50, 5, 25.00, 0.00, 74.50, 'N', 'N', NULL, 'N', 'N', '127.0.0.1', NULL, '', 'hubert@olicom.pl', 'e644a6071fcffcb498b8c6b4f4e5f46d', 'N', '77|1395065886', 'pl_PL', '', '', NULL, 'zł', '1.0000', 'code-1', 10, NULL, NULL),
(78, '6/2014/03/17', 6, 2014, 3, 17, 0, '1395066744', 1, 2, 0.00, '', 242.00, 5, 25.00, 0.00, 267.00, 'N', 'N', NULL, 'N', 'N', '127.0.0.1', NULL, '', 'hubert@olicom.pl', '26436086a205b28afb1222989dd317e6', 'N', '78|1395066750', 'pl_PL', '', '', NULL, 'zł', '1.0000', 'code-1', 10, NULL, NULL),
(79, '7/2014/03/17', 7, 2014, 3, 17, 0, '1395066890', 1, 3, 0.00, '', 83.60, 5, 25.00, 0.00, 108.60, 'N', 'N', NULL, 'N', 'N', '127.0.0.1', NULL, '', 'hubert@olicom.pl', 'e98782af718a639517aa25d0ef8fb4f0', 'N', '79|1395066894', 'pl_PL', '', '', NULL, 'zł', '1.0000', 'code-1', 10, NULL, NULL),
(80, '1/2014/03/25', 1, 2014, 3, 25, 0, '1395747670', 1, 1, 0.00, '', 55.00, 6, 7.00, 0.00, 62.00, 'N', 'N', NULL, 'N', 'N', '127.0.0.1', NULL, 'test', 'hubert@olicom.pl', '6ff22a94a49873093a82a17d991e28eb', 'N', '80|1395747680', 'pl_PL', '', '', NULL, 'zł', '1.0000', NULL, NULL, NULL, NULL),
(81, '2/2014/03/25', 2, 2014, 3, 25, 0, '1395748153', 1, 1, 0.00, '', 44.00, 6, 7.00, 0.00, 51.00, 'N', 'N', NULL, 'N', 'N', '127.0.0.1', NULL, 'test', 'hubert@olicom.pl', '6d669f853a77a61c897b444bf920fbe2', 'N', '81|1395748277', 'pl_PL', '', '', NULL, 'zł', '1.0000', NULL, NULL, NULL, NULL),
(82, '3/2014/03/25', 3, 2014, 3, 25, 0, '1395748323', 1, 1, 0.00, '', 44.00, 6, 7.00, 0.00, 51.00, 'N', 'N', NULL, 'N', 'N', '127.0.0.1', NULL, '', 'hubert@olicom.pl', '2499ed17dd68c2029fabee956568d733', 'N', '', 'pl_PL', '', '', NULL, 'zł', '1.0000', NULL, NULL, NULL, NULL),
(83, '4/2014/03/25', 4, 2014, 3, 25, 0, '1395748397', 1, 1, 0.00, '', 44.00, 6, 7.00, 0.00, 51.00, 'N', 'N', NULL, 'N', 'N', '127.0.0.1', NULL, '', 'hubert@olicom.pl', 'c4a3a5180b4c58e2d25e0098accf1265', 'N', '', 'pl_PL', '', '', NULL, 'zł', '1.0000', NULL, NULL, NULL, NULL),
(84, '5/2014/03/25', 5, 2014, 3, 25, 0, '1395748418', 1, 1, 0.00, '', 44.00, 6, 7.00, 0.00, 51.00, 'N', 'N', NULL, 'N', 'N', '127.0.0.1', NULL, '', 'hubert@olicom.pl', '66d09ee94f87171272f897df82d25cf9', 'N', '', 'pl_PL', '', '', NULL, 'zł', '1.0000', NULL, NULL, NULL, NULL),
(85, '6/2014/03/25', 6, 2014, 3, 25, 0, '1395748449', 1, 1, 0.00, '', 44.00, 6, 7.00, 0.00, 51.00, 'N', 'N', NULL, 'N', 'N', '127.0.0.1', NULL, '', 'hubert@olicom.pl', '02968a8351e9c450857884d139659a65', 'N', '', 'pl_PL', '', '', NULL, 'zł', '1.0000', NULL, NULL, NULL, NULL),
(86, '7/2014/03/25', 7, 2014, 3, 25, 0, '1395748520', 1, 1, 0.00, '', 44.00, 6, 7.00, 0.00, 51.00, 'N', 'N', NULL, 'N', 'N', '127.0.0.1', NULL, '', 'hubert@olicom.pl', 'af32c8651af00e6d4002ea045360200d', 'N', '86|1395748553', 'pl_PL', '', '', NULL, 'zł', '1.0000', NULL, NULL, NULL, NULL),
(87, '8/2014/03/25', 8, 2014, 3, 25, 0, '1395748587', 1, 1, 0.00, '', 44.00, 6, 7.00, 0.00, 51.00, 'N', 'N', NULL, 'N', 'N', '127.0.0.1', NULL, '', 'hubert@olicom.pl', 'cea91ee190372e11a6448702424aa5ad', 'N', '87|1395748594', 'pl_PL', '', '', NULL, 'zł', '1.0000', NULL, NULL, NULL, NULL),
(88, '1/2014/04/15', 1, 2014, 4, 15, 0, '1397553811', 1, 1, 0.00, '', 156.60, 6, 7.00, 0.00, 163.60, 'N', 'N', NULL, 'N', 'N', '127.0.0.1', NULL, 'test', 'hubert@olicom.pl', '62778b79cc1796225019162ec8cdac8f', 'N', '88|1397553995', 'pl_PL', '', '', NULL, 'zł', '1.0000', 'fanbiały', 10, '17.40', NULL),
(89, '1/2014/04/22', 1, 2014, 4, 22, 34, '1398153200', 1, 2, 0.00, '', 49.00, 6, 7.00, 0.00, 56.00, 'N', 'N', NULL, 'N', 'N', '127.0.0.1', NULL, 'test', 'hubert@olicom.pl', 'f0aa7c6f3b7d38bb88233036d13bb439', 'N', '89|1398153204', 'pl_PL', '', '', NULL, 'zł', '1.0000', 'fanbiały', 50, '16.00', NULL),
(90, '1/2014/07/22', 1, 2014, 7, 22, 0, '1406021176', 1, 3, 0.00, '', 200.00, 6, 7.00, 0.00, 207.00, 'N', 'N', NULL, 'N', 'N', '::1', NULL, 'oolicom', 'pawel@olicom.pl', '3d45588c825374d8d7c1e44c386fb003', 'N', '90|1406021194', 'pl_PL', '', '', NULL, 'zł', '1.0000', NULL, NULL, '0.00', NULL),
(91, '2/2014/07/22', 2, 2014, 7, 22, 36, '1406022071', 1, 3, 0.00, '', 19.99, 5, 25.00, 0.00, 44.99, 'N', 'N', NULL, 'N', 'N', '::1', NULL, 'oolicom', 'pawel@olicom.pl', '41b6924355b4b7d73d28d5ca008fa636', 'N', '91|1406022089', 'pl_PL', '', '', NULL, 'zł', '1.0000', NULL, NULL, '0.00', NULL),
(92, '3/2014/07/22', 3, 2014, 7, 22, 0, '1406022987', 1, 3, 0.00, '', 39.90, 5, 25.00, 0.00, 64.90, 'N', 'N', NULL, 'N', 'N', '::1', NULL, '', 'pawel@olicom.pl', '771f92ffd4f5a8b052b0b5b5a8e024ab', 'N', '92|1406025447', 'pl_PL', '', '', NULL, 'zł', '1.0000', NULL, NULL, '0.00', NULL),
(93, '4/2014/07/22', 4, 2014, 7, 22, 0, '1406025669', 1, 3, 0.00, '', 39.90, 6, 7.00, 0.00, 46.90, 'N', 'N', NULL, 'N', 'N', '::1', NULL, '', 'pawel@olicom.pl', '5d292dbbbe53ae26a2247a9fb99c20d8', 'N', '93|1406026009', 'pl_PL', '', '', NULL, 'zł', '1.0000', NULL, NULL, '0.00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `shop_orders_customers`
--

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

--
-- Dumping data for table `shop_orders_customers`
--

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
(93, 0, 'pawel@olicom.pl', 'Paweł', 'Mor', NULL, NULL, 'Posen', '12-365', 'testowa 3', NULL, '', NULL, '123456798', NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'N', 'N', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `shop_orders_products`
--

CREATE TABLE `shop_orders_products` (
  `order_id` int(11) unsigned NOT NULL,
  `product_id` int(11) unsigned NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_attributes` varchar(255) NOT NULL,
  `product_count` int(4) unsigned NOT NULL,
  `product_price` decimal(10,2) NOT NULL,
  `product_rebate` int(10) unsigned NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `shop_orders_products`
--

INSERT INTO `shop_orders_products` (`order_id`, `product_id`, `product_name`, `product_attributes`, `product_count`, `product_price`, `product_rebate`) VALUES
(27, 87, '', '', 3, '33.00', 0),
(28, 87, '', '', 2, '33.00', 0),
(29, 87, '', '', 2, '33.00', 0),
(30, 87, '', '', 2, '33.00', 0),
(31, 87, '', '', 2, '33.00', 0),
(32, 87, '', '', 2, '33.00', 0),
(33, 87, '', '', 2, '33.00', 0),
(34, 87, '', '', 2, '33.00', 0),
(35, 87, '', '', 2, '33.00', 0),
(36, 87, '', '', 2, '33.00', 0),
(37, 87, '', '', 2, '33.00', 0),
(38, 87, '', '', 2, '33.00', 0),
(39, 87, '', '', 3, '33.00', 0),
(40, 87, '', '', 3, '33.00', 0),
(41, 87, '', '', 3, '33.00', 0),
(42, 87, '', '', 3, '33.00', 0),
(43, 91, '', '3:niebieski', 1, '120.00', 0),
(44, 91, '', '3:niebieski', 1, '120.00', 0),
(45, 91, '', '3:Czarnuszy;4:Słomki niebieskie', 2, '120.00', 0),
(45, 91, '', '3:Zielony;4:Różowy', 3, '120.00', 0),
(46, 88, '', '', 1, '144.00', 0),
(47, 87, '', '', 1, '33.00', 0),
(48, 96, '', '', 1, '10.00', 0),
(49, 96, '', '', 1, '10.00', 0),
(50, 97, '', '', 2, '10.00', 0),
(51, 96, '', '', 1, '10.00', 0),
(52, 97, '', '', 1, '10.00', 0),
(53, 96, '', '', 18, '10.00', 0),
(54, 103, '', '', 1, '330.00', 0),
(55, 102, '', '', 1, '44.00', 0),
(56, 103, '', '', 2, '330.00', 0),
(56, 102, '', '', 1, '44.00', 0),
(57, 101, '', '', 6, '55.00', 0),
(57, 102, '', '', 1, '44.00', 0),
(58, 103, '', '', 1, '330.00', 0),
(59, 101, '', '', 1, '55.00', 0),
(60, 101, '', '', 32, '55.00', 0),
(61, 99, '', '', 1, '44.00', 0),
(62, 99, '', '', 1, '44.00', 0),
(63, 103, '', '', 2, '330.00', 0),
(64, 102, '', '', 1, '44.00', 0),
(65, 99, '', '', 1, '44.00', 0),
(66, 99, '', '', 1, '44.00', 0),
(67, 99, '', '', 1, '44.00', 0),
(68, 99, '', '', 1, '44.00', 0),
(69, 102, '', '', 1, '44.00', 0),
(70, 103, '', '', 1, '330.00', 0),
(71, 102, '', '', 3, '44.00', 0),
(72, 104, '', '', 1, '44.00', 0),
(73, 107, '', '', 10, '44.00', 10),
(73, 98, '', '3:Czerwony', 2, '44.00', 0),
(73, 108, '', '', 3, '55.00', 10),
(74, 108, '', '', 1, '55.00', 10),
(75, 108, '', '', 1, '55.00', 10),
(76, 108, '', '', 1, '55.00', 10),
(77, 108, '', '', 1, '55.00', 10),
(78, 107, '', '', 5, '44.00', 10),
(78, 98, '', '3:Czarnuszy', 1, '44.00', 0),
(79, 107, '', '', 1, '44.00', 10),
(79, 98, '', '3:Czerwony', 1, '44.00', 0),
(80, 108, '', '', 1, '55.00', 0),
(81, 102, '', '', 1, '44.00', 0),
(82, 102, '', '', 1, '44.00', 0),
(83, 102, '', '', 1, '44.00', 0),
(84, 102, '', '', 1, '44.00', 0),
(85, 102, '', '', 1, '44.00', 0),
(86, 102, '', '', 1, '44.00', 0),
(87, 102, '', '', 1, '44.00', 0),
(88, 102, '', '', 1, '44.00', 10),
(88, 105, '', '', 1, '10.00', 10),
(88, 106, '', '', 1, '120.00', 10),
(89, 105, '', '', 1, '10.00', 50),
(89, 108, '', '', 1, '55.00', 20),
(90, 126, '', '', 1, '200.00', 0),
(91, 123, '', '', 1, '19.99', 0),
(92, 125, '', '', 1, '39.90', 0),
(93, 125, '', '4:Różowy', 1, '39.90', 0);

-- --------------------------------------------------------

--
-- Table structure for table `shop_orders_statuses`
--

CREATE TABLE `shop_orders_statuses` (
  `id_order_status` int(11) NOT NULL AUTO_INCREMENT,
  `order_status_name` varchar(128) NOT NULL,
  `language` char(5) DEFAULT 'pl_PL',
  PRIMARY KEY (`id_order_status`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `shop_orders_statuses`
--

INSERT INTO `shop_orders_statuses` (`id_order_status`, `order_status_name`, `language`) VALUES
(1, 'nowe', 'pl_PL'),
(2, 'zapłacono', 'pl_PL'),
(3, 'w realizacji', 'pl_PL'),
(4, 'zrealizowano', 'pl_PL'),
(5, 'zamknięte', 'pl_PL');

-- --------------------------------------------------------

--
-- Table structure for table `shop_parameters`
--

CREATE TABLE `shop_parameters` (
  `id_parameter` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `active` enum('Y','N') NOT NULL DEFAULT 'Y',
  `position` int(10) unsigned NOT NULL,
  `show_on_list` enum('N','Y') DEFAULT 'N',
  `filter` enum('N','Y') DEFAULT 'N',
  `type` enum('product','category') DEFAULT 'product',
  PRIMARY KEY (`id_parameter`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

-- --------------------------------------------------------

--
-- Table structure for table `shop_parameters_description`
--

CREATE TABLE `shop_parameters_description` (
  `parameter_id` int(10) unsigned NOT NULL,
  `parameter_name` varchar(255) NOT NULL,
  `parameter_language` char(5) DEFAULT 'pl_PL'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `shop_parameters_to_categories`
--

CREATE TABLE `shop_parameters_to_categories` (
  `parameter_id` int(10) unsigned NOT NULL,
  `category_id` int(10) unsigned NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `shop_parameters_values`
--

CREATE TABLE `shop_parameters_values` (
  `id_parameter_value` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parameter_id` int(10) unsigned NOT NULL,
  `parameter_value` varchar(255) NOT NULL,
  `active` enum('Y','N') DEFAULT 'Y',
  PRIMARY KEY (`id_parameter_value`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

-- --------------------------------------------------------

--
-- Table structure for table `shop_payment_types`
--

CREATE TABLE `shop_payment_types` (
  `id_payment_type` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `active` enum('Y','N') NOT NULL DEFAULT 'Y',
  `payment_cost` double(10,2) DEFAULT NULL,
  `payment_type_method` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`id_payment_type`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `shop_payment_types`
--

INSERT INTO `shop_payment_types` (`id_payment_type`, `active`, `payment_cost`, `payment_type_method`) VALUES
(1, 'Y', 0.00, NULL),
(2, 'Y', 0.00, 'dotpay'),
(3, 'Y', 0.00, 'dotpay');

-- --------------------------------------------------------

--
-- Table structure for table `shop_payment_types_description`
--

CREATE TABLE `shop_payment_types_description` (
  `payment_type_id` int(10) unsigned NOT NULL,
  `payment_type_name` varchar(255) NOT NULL,
  `payment_type_language` char(5) DEFAULT 'pl_PL',
  `payment_type_info` text
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `shop_payment_types_description`
--

INSERT INTO `shop_payment_types_description` (`payment_type_id`, `payment_type_name`, `payment_type_language`, `payment_type_info`) VALUES
(1, 'Przelew na konto', 'pl_PL', 'PL  00 0000 0000 0000 0000 0000 0000<br/>Numer SWIFT banku: AAAAAAAA  -  jeśli płatność jest dokonywana z zagranicy<br/><br/>twoja firma<br/>ul. Ulica 1<br/>00-000 Miasto<br/><br/><strong>W tytule proszę wpisać numer zamówienia, oraz swoje imię i nazwisko.</strong>'),
(2, 'Karta kredytowa', 'pl_PL', NULL),
(3, 'Dotpay', 'pl_PL', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `shop_producers`
--

CREATE TABLE `shop_producers` (
  `id_producer` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `producer_name` varchar(255) NOT NULL,
  `producer_logo` varchar(255) DEFAULT NULL,
  `position` int(10) NOT NULL DEFAULT '0',
  `active` enum('Y','N') CHARACTER SET latin1 DEFAULT 'Y',
  `rebate` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id_producer`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `shop_producers`
--

INSERT INTO `shop_producers` (`id_producer`, `producer_name`, `producer_logo`, `position`, `active`, `rebate`) VALUES
(11, 'Olicom', 'olicom-logo.png', 1, 'Y', NULL),
(13, 'asds', NULL, 0, 'Y', NULL),
(16, 'gbfc', NULL, 0, 'N', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `shop_products`
--

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
  `roof_angle` double(10,2) unsigned DEFAULT NULL,
  `roof_surface` double(10,2) unsigned DEFAULT NULL,
  `minimum_plot_width` double(10,2) unsigned DEFAULT NULL,
  `minimum_plot_length` double(10,2) unsigned DEFAULT NULL,
  `estimated_calculation` int(11) DEFAULT NULL,
  `allegro_template` text,
  `product_position` int(10) NOT NULL DEFAULT '0',
  `product_allow_rabate` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '1 - zezwalaj na rabat, 0 - nie zezwalaj',
  `product_stock` int(10) unsigned DEFAULT '1',
  PRIMARY KEY (`id_product`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=130 ;

--
-- Dumping data for table `shop_products`
--

INSERT INTO `shop_products` (`id_product`, `price`, `net_price`, `tax_id`, `promotion_price`, `times_viewed`, `ask_for_price`, `code`, `active`, `recommend`, `quantity`, `quantity_tracking`, `date_added`, `date_modified`, `date_expire`, `ean`, `parameter_category_id`, `hide_price`, `measure_unit_id`, `producer_id`, `product_status_id`, `preparation`, `premiere_date`, `promotion_date_start`, `promotion_date_end`, `new`, `bestseller`, `old_price`, `constant_discount`, `rebate_group_id`, `max_rebate`, `loyality_points`, `product_of_the_day_date`, `sale`, `sale_date_start`, `sale_date_end`, `allow_voting`, `allow_comments`, `free_delivery`, `additional_delivery_cost`, `netto_surface`, `homestead_surface`, `volume`, `estimate`, `height`, `project_price`, `usable_surface`, `roof_angle`, `roof_surface`, `minimum_plot_width`, `minimum_plot_length`, `estimated_calculation`, `allegro_template`, `product_position`, `product_allow_rabate`, `product_stock`) VALUES
(121, '350.00', '1.00', NULL, NULL, NULL, 'N', '', 'Y', 'N', 0, 'N', '1402656180', NULL, NULL, NULL, NULL, 'N', NULL, 11, 1, 'N', NULL, NULL, NULL, 'N', 'N', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'N', 'N', 'N', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(123, '19.99', '3.61', 0, NULL, NULL, 'N', '', 'Y', 'N', 0, 'N', '1402656817', '1402656842', '', '', NULL, 'N', NULL, 11, 1, 'N', NULL, NULL, NULL, 'N', 'N', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'N', 'N', 'N', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(120, '190.00', '361.00', NULL, NULL, NULL, 'N', '', 'Y', 'N', 0, 'N', '1402655638', '1402656210', NULL, NULL, NULL, 'N', NULL, 11, 1, 'N', NULL, NULL, NULL, 'N', 'N', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'N', 'N', 'N', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(114, '1200.00', '14.00', NULL, NULL, NULL, 'N', '', 'Y', 'N', 0, 'N', '1402653096', '1402653128', NULL, NULL, NULL, 'N', NULL, 11, 1, 'N', NULL, NULL, NULL, 'Y', 'N', 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'N', 'N', 'N', 0.00, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(115, '500.00', '2.00', NULL, NULL, NULL, 'N', '', 'Y', 'N', 0, 'N', '1402653316', '1402653407', NULL, NULL, NULL, 'N', NULL, 11, 1, 'N', NULL, NULL, NULL, 'N', 'N', 700.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'N', 'N', 'N', 0.00, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, 0),
(116, '999.00', '9.00', 0, NULL, NULL, 'N', '', 'N', 'N', 0, 'N', '1402653604', '1406206146', '', '', NULL, 'N', NULL, 11, 1, 'N', NULL, NULL, NULL, 'Y', 'N', 1300.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'N', 'N', 'N', 0.00, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, 0),
(117, '1000.00', '10.00', NULL, NULL, NULL, 'N', '', 'Y', 'N', 0, 'N', '1402653916', '1402653947', NULL, NULL, NULL, 'N', NULL, 11, 1, 'N', NULL, NULL, NULL, 'Y', 'N', 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'N', 'N', 'N', 0.00, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(118, '100.00', '100.00', NULL, NULL, NULL, 'N', '', 'Y', 'N', 0, 'N', '1402654161', '1402654178', NULL, NULL, NULL, 'N', NULL, 11, 1, 'N', NULL, NULL, NULL, 'N', 'N', 200.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'N', 'N', 'N', 0.00, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, 0),
(111, '2500.00', '62.00', NULL, NULL, NULL, 'N', '', 'Y', 'N', 0, 'N', '1402650673', NULL, NULL, NULL, NULL, 'N', NULL, 11, 1, 'N', NULL, NULL, NULL, 'N', 'N', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'N', 'N', 'N', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(112, '500.00', '2.00', NULL, NULL, NULL, 'N', '', 'Y', 'N', 0, 'N', '1402650900', NULL, NULL, NULL, NULL, 'N', NULL, 11, 1, 'N', NULL, NULL, NULL, 'N', 'N', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'N', 'N', 'N', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(113, '1500.00', '22.00', NULL, NULL, NULL, 'N', '', 'Y', 'N', 0, 'N', '1402652938', NULL, NULL, NULL, NULL, 'N', NULL, 11, 1, 'N', NULL, NULL, NULL, 'N', 'N', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'N', 'N', 'N', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(110, '600.00', '3.00', NULL, NULL, NULL, 'N', '', 'Y', 'N', 0, 'N', '1402650517', NULL, NULL, NULL, NULL, 'N', NULL, 11, 1, 'N', NULL, NULL, NULL, 'N', 'N', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'N', 'N', 'N', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(109, '1500.00', '22.00', NULL, NULL, NULL, 'N', '', 'Y', 'N', 0, 'N', '1402650404', NULL, NULL, NULL, NULL, 'N', NULL, 11, 1, 'N', NULL, NULL, NULL, 'N', 'N', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'N', 'N', 'N', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(122, '500.00', '2.00', NULL, NULL, NULL, 'N', '', 'Y', 'N', 0, 'N', '1402656319', NULL, NULL, NULL, NULL, 'N', NULL, 11, 1, 'N', NULL, NULL, NULL, 'N', 'N', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'N', 'N', 'N', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(124, '14.90', '2.22', NULL, NULL, NULL, 'N', '', 'Y', 'N', 0, 'N', '1402656915', NULL, NULL, NULL, NULL, 'N', NULL, 11, 1, 'N', NULL, NULL, NULL, 'N', 'N', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'N', 'N', 'N', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(125, '39.90', '15.92', NULL, NULL, NULL, 'N', '', 'Y', 'N', 0, 'N', '1402656989', '1406025636', NULL, NULL, NULL, 'N', NULL, 11, 1, 'N', NULL, NULL, NULL, 'N', 'N', 49.90, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'N', 'N', 'N', 0.00, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, 0),
(126, '200.00', '400.00', NULL, NULL, NULL, 'N', '', 'Y', 'N', 0, 'N', '1402657270', NULL, NULL, NULL, NULL, 'N', NULL, 11, 1, 'N', NULL, NULL, NULL, 'N', 'N', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'N', 'N', 'N', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(127, '2500.00', '62.00', NULL, NULL, NULL, 'N', '', 'Y', 'N', 0, 'N', '1402657489', '1402657510', NULL, NULL, NULL, 'N', NULL, 11, 1, 'N', NULL, NULL, NULL, 'Y', 'N', 3000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'N', 'N', 'N', 0.00, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, 0),
(129, '15129.00', '0.01', 23, NULL, NULL, 'N', '12', 'Y', 'N', 0, 'N', '1406789908', '1406790645', '', '', NULL, 'N', NULL, 13, 1, 'N', NULL, NULL, NULL, 'N', 'N', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'N', 'N', 'N', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 2);

-- --------------------------------------------------------

--
-- Table structure for table `shop_products_attachments`
--

CREATE TABLE `shop_products_attachments` (
  `id_attachment` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int(10) unsigned NOT NULL,
  `filename` varchar(255) CHARACTER SET utf8 NOT NULL,
  `real_filename` varchar(255) CHARACTER SET utf8 NOT NULL,
  `filesize` int(10) unsigned DEFAULT NULL,
  `file_description` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id_attachment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `shop_products_attributes`
--

CREATE TABLE `shop_products_attributes` (
  `product_id` int(10) unsigned NOT NULL,
  `attribute_id` int(11) NOT NULL,
  `attribute_value_id` int(11) NOT NULL,
  `price` double unsigned DEFAULT NULL,
  `default_value` enum('N','Y') DEFAULT 'N',
  `quantity` int(10) unsigned DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shop_products_attributes`
--

INSERT INTO `shop_products_attributes` (`product_id`, `attribute_id`, `attribute_value_id`, `price`, `default_value`, `quantity`) VALUES
(125, 7, 39, NULL, 'N', NULL),
(125, 4, 25, NULL, 'N', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `shop_products_comments`
--

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `shop_products_description`
--

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=218 ;

--
-- Dumping data for table `shop_products_description`
--

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

-- --------------------------------------------------------

--
-- Table structure for table `shop_products_files`
--

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `shop_products_images`
--

CREATE TABLE `shop_products_images` (
  `id_image` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `variant_id` int(11) DEFAULT NULL,
  `filename` varchar(255) NOT NULL,
  `realfilename` varchar(255) NOT NULL,
  `mainimage` enum('Y','N') NOT NULL DEFAULT 'Y',
  PRIMARY KEY (`id_image`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=169 ;

--
-- Dumping data for table `shop_products_images`
--

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

-- --------------------------------------------------------

--
-- Table structure for table `shop_products_medias`
--

CREATE TABLE `shop_products_medias` (
  `product_id` int(11) NOT NULL,
  `media_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `shop_products_medias`
--

INSERT INTO `shop_products_medias` (`product_id`, `media_id`) VALUES
(1, 14),
(1, 12),
(1, 10);

-- --------------------------------------------------------

--
-- Table structure for table `shop_products_parameters`
--

CREATE TABLE `shop_products_parameters` (
  `product_id` int(10) unsigned DEFAULT NULL,
  `parameter_id` int(10) unsigned DEFAULT NULL,
  `parameter_value_id` int(10) unsigned DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `shop_products_project_gallery`
--

CREATE TABLE `shop_products_project_gallery` (
  `id_project_gallery` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int(10) unsigned NOT NULL,
  `file_name` varchar(256) DEFAULT NULL,
  `real_file_name` varchar(256) DEFAULT NULL,
  `project_description` varchar(256) DEFAULT NULL,
  `position` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id_project_gallery`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `shop_products_statuses`
--

CREATE TABLE `shop_products_statuses` (
  `id_product_status` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `allow_buy` enum('Y','N') CHARACTER SET latin1 NOT NULL DEFAULT 'Y',
  `active` enum('Y','N') NOT NULL DEFAULT 'Y',
  PRIMARY KEY (`id_product_status`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `shop_products_statuses`
--

INSERT INTO `shop_products_statuses` (`id_product_status`, `allow_buy`, `active`) VALUES
(1, 'Y', 'Y'),
(2, 'N', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `shop_products_statuses_description`
--

CREATE TABLE `shop_products_statuses_description` (
  `product_status_id` int(11) unsigned NOT NULL,
  `product_status_name` varchar(255) NOT NULL,
  `product_status_language` char(5) NOT NULL DEFAULT 'pl_PL'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `shop_products_statuses_description`
--

INSERT INTO `shop_products_statuses_description` (`product_status_id`, `product_status_name`, `product_status_language`) VALUES
(1, 'Dostępny', 'pl_PL'),
(2, 'Dostępny wkrótce', 'pl_PL');

-- --------------------------------------------------------

--
-- Table structure for table `shop_products_tags`
--

CREATE TABLE `shop_products_tags` (
  `product_id` int(10) unsigned NOT NULL,
  `tag_dict_id` int(10) unsigned NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `shop_products_tags_dict`
--

CREATE TABLE `shop_products_tags_dict` (
  `id_tag_dict` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `word` varchar(255) NOT NULL,
  PRIMARY KEY (`id_tag_dict`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `shop_products_to_categories`
--

CREATE TABLE `shop_products_to_categories` (
  `product_id` int(10) unsigned NOT NULL,
  `category_id` int(10) unsigned NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `shop_products_to_categories`
--

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

-- --------------------------------------------------------

--
-- Table structure for table `shop_products_to_news`
--

CREATE TABLE `shop_products_to_news` (
  `product_id` int(11) NOT NULL,
  `news_id` int(11) NOT NULL,
  KEY `product_id` (`product_id`,`news_id`),
  KEY `news_id` (`news_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `shop_products_variants`
--

CREATE TABLE `shop_products_variants` (
  `id_variant` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int(10) unsigned NOT NULL,
  `variant_name` varchar(256) NOT NULL,
  `usable_surface` double(10,2) DEFAULT NULL,
  `net_surface` double(10,2) DEFAULT NULL,
  `building_area` double(10,2) DEFAULT NULL,
  `roof_angle` double(10,2) DEFAULT NULL,
  `variant_price` double(10,2) DEFAULT NULL,
  `variant_file` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`id_variant`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `shop_product_parameters`
--

CREATE TABLE `shop_product_parameters` (
  `id_product_to_parameter` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int(10) unsigned NOT NULL,
  `parameter_id` int(10) unsigned NOT NULL,
  `value` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`id_product_to_parameter`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `shop_product_to_variant`
--

CREATE TABLE `shop_product_to_variant` (
  `product_id` int(10) unsigned NOT NULL,
  `variant_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `quantity` int(10) unsigned NOT NULL DEFAULT '0',
  `variant_values` text NOT NULL,
  PRIMARY KEY (`variant_id`),
  UNIQUE KEY `variant_id` (`variant_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=31 ;

--
-- Dumping data for table `shop_product_to_variant`
--

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

-- --------------------------------------------------------

--
-- Table structure for table `shop_questions`
--

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `shop_questions`
--

INSERT INTO `shop_questions` (`id_question`, `name`, `email`, `phone`, `product_info`, `product_id`, `date`, `message`, `responsed`) VALUES
(1, 'aaa', 'hubert@olicom.pl', '5555555', 'test', 11, '2014-02-04', 'test', 'N'),
(2, 'bgbg', 'hubert@olicom.pl', '5555555', 'asdf', 12, '2014-02-04', 'asdtest', 'Y'),
(3, 'yyggf', 'hubert@olicom.pl', '5555555', 'hjgjfgfh', 12, '2014-02-04', 'mnmftghgf', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `shop_rebates_codes`
--

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `shop_rebates_codes`
--

INSERT INTO `shop_rebates_codes` (`id_rebate_code`, `rebate_code`, `active`, `rebate`, `rebate_start`, `rebate_end`, `rebate_add`, `rebate_modify`) VALUES
(1, 'fanbiały', 1, 50, '2014-07-01 00:00:00', '2014-07-31 00:00:00', '0000-00-00 00:00:00', '2014-07-22 11:53:34'),
(2, 'test5', 1, 5, '2014-04-03 00:00:00', '2014-04-09 00:00:00', '2014-04-11 10:05:59', '2014-04-11 11:24:15'),
(3, 'fanbiały', 0, 5, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2014-04-14 08:42:31', NULL),
(4, 'fanbiały', 0, 5, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2014-04-14 08:46:58', NULL),
(5, 'wiosna', 1, 20, '2014-05-10 00:00:00', '2014-06-19 00:00:00', '2014-06-12 07:53:31', '2014-06-12 07:53:52');

-- --------------------------------------------------------

--
-- Table structure for table `shop_rebates_codes_to_products`
--

CREATE TABLE `shop_rebates_codes_to_products` (
  `product_id` int(10) unsigned NOT NULL,
  `rebate_code_id` int(10) unsigned NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `shop_rebates_codes_to_products`
--

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

-- --------------------------------------------------------

--
-- Table structure for table `shop_rebates_groups`
--

CREATE TABLE `shop_rebates_groups` (
  `id_rebate_group` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `group_name` varchar(128) NOT NULL,
  `rebate` int(10) unsigned NOT NULL,
  `active` enum('Y','N') CHARACTER SET latin1 NOT NULL DEFAULT 'Y',
  PRIMARY KEY (`id_rebate_group`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `shop_rebates_groups`
--

INSERT INTO `shop_rebates_groups` (`id_rebate_group`, `group_name`, `rebate`, `active`) VALUES
(1, 'test', 5, 'Y'),
(3, 'hgffg', 14, 'N'),
(4, 'kjhg', 65, 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `shop_related_products`
--

CREATE TABLE `shop_related_products` (
  `product_id` int(10) unsigned NOT NULL,
  `related_product_id` int(10) unsigned NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `shop_search`
--

CREATE TABLE `shop_search` (
  `id_search` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int(10) unsigned NOT NULL,
  `typ_zabudowy` enum('garaz','blizniak','z_poddaszem','pietrowy','parterowy') DEFAULT NULL,
  `kominek` tinyint(3) unsigned DEFAULT NULL,
  `garaz` tinyint(3) unsigned DEFAULT NULL,
  `piwnica` tinyint(3) unsigned DEFAULT NULL,
  `estimated_build_price` enum('501<','401-500','301-400','200-300') DEFAULT NULL,
  `usearea` int(10) unsigned DEFAULT NULL,
  `buildarea` int(10) unsigned DEFAULT NULL,
  `roof_angle` int(11) DEFAULT NULL,
  `min_field_width` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id_search`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `shop_subscriptions_logs`
--

CREATE TABLE `shop_subscriptions_logs` (
  `id_shop_subscriptions_log` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `customer_id` int(10) NOT NULL,
  `request` text,
  `response` text,
  PRIMARY KEY (`id_shop_subscriptions_log`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `shop_taxes`
--

CREATE TABLE `shop_taxes` (
  `id_tax` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tax_name` varchar(255) NOT NULL,
  `tax_value` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id_tax`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `shop_taxes`
--

INSERT INTO `shop_taxes` (`id_tax`, `tax_name`, `tax_value`) VALUES
(8, 'Stawka II', 23),
(7, 'Stawka I', 8);

-- --------------------------------------------------------

--
-- Table structure for table `slider_elements`
--

CREATE TABLE `slider_elements` (
  `id_slider_element` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `slider_type_id` tinyint(2) unsigned NOT NULL,
  `slider_element_id` int(10) NOT NULL,
  `slider_element_position` int(3) unsigned NOT NULL DEFAULT '0',
  `available` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id_slider_element`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=36 ;

--
-- Dumping data for table `slider_elements`
--

INSERT INTO `slider_elements` (`id_slider_element`, `slider_type_id`, `slider_element_id`, `slider_element_position`, `available`) VALUES
(30, 3, 25, 2, 1),
(29, 3, 24, 1, 1),
(31, 3, 26, 3, 1),
(34, 1, 10, 4, NULL),
(35, 2, 1, 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `slider_images`
--

CREATE TABLE `slider_images` (
  `id_slider_image` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `alt` varchar(255) DEFAULT NULL,
  `link` text,
  `lang` char(5) NOT NULL DEFAULT 'pl_PL',
  `slider_element_id` int(11) NOT NULL,
  PRIMARY KEY (`id_slider_image`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `slider_images`
--

INSERT INTO `slider_images` (`id_slider_image`, `title`, `filename`, `alt`, `link`, `lang`, `slider_element_id`) VALUES
(24, 'Strony internetowe', '14026447421539aa906dd49a737084033.jpg', 'Strony internetowe', NULL, 'pl_PL', 0),
(25, 'CMS', '14026451071539aaa73bb18e078219472.jpg', 'CMS', '', 'pl_PL', 0),
(26, 'Portfolio', '14026451471539aaa9b3e667129621092.jpg', 'Portfolio', NULL, 'pl_PL', 0);

-- --------------------------------------------------------

--
-- Table structure for table `slider_news`
--

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `slider_news`
--

INSERT INTO `slider_news` (`slider_news_id`, `title`, `description`, `short_description`, `filename`, `alt`, `link`, `slider_element_id`, `lang`) VALUES
(1, 'test', 'opis testu', 'tester', '1406028647153ce4b670919e896511337.jpg', 'test1', NULL, 0, 'pl_PL');

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id_tag` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `element_id` int(11) unsigned NOT NULL,
  `dictionary_tag_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id_tag`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tags_dictionary`
--

CREATE TABLE `tags_dictionary` (
  `id_tag_dictionary` int(11) NOT NULL AUTO_INCREMENT,
  `word` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`id_tag_dictionary`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
