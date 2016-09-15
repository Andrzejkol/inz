/*
MySQL Data Transfer
Source Host: localhost
Source Database: kolekcjon
Target Host: localhost
Target Database: kolekcjon
Date: 2014-11-06 12:58:43
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for acl_permissions
-- ----------------------------
DROP TABLE IF EXISTS `acl_permissions`;
CREATE TABLE `acl_permissions` (
  `id_permission` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `resource` varchar(255) NOT NULL,
  `privilege` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_permission`)
) ENGINE=MyISAM AUTO_INCREMENT=163 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for acl_roles
-- ----------------------------
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
) ENGINE=MyISAM AUTO_INCREMENT=42 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for acl_roles_permissions
-- ----------------------------
DROP TABLE IF EXISTS `acl_roles_permissions`;
CREATE TABLE `acl_roles_permissions` (
  `role_id` int(10) unsigned NOT NULL,
  `permission_id` int(10) unsigned NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for acl_users
-- ----------------------------
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
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for acl_users_images
-- ----------------------------
DROP TABLE IF EXISTS `acl_users_images`;
CREATE TABLE `acl_users_images` (
  `id_image` int(11) NOT NULL AUTO_INCREMENT,
  `filename` varchar(255) NOT NULL,
  `realfilename` varchar(255) NOT NULL,
  `mainimage` tinyint(1) unsigned NOT NULL,
  `alt` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_image`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for boxes
-- ----------------------------
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

-- ----------------------------
-- Table structure for boxes_set
-- ----------------------------
DROP TABLE IF EXISTS `boxes_set`;
CREATE TABLE `boxes_set` (
  `id_boxes_set` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT 'pl_PL',
  `description` text,
  `element_id` int(11) NOT NULL,
  `show_title` enum('N','Y') NOT NULL DEFAULT 'Y',
  PRIMARY KEY (`id_boxes_set`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for configuration
-- ----------------------------
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
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for contact_forms
-- ----------------------------
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

-- ----------------------------
-- Table structure for contact_forms_log
-- ----------------------------
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

-- ----------------------------
-- Table structure for dict_states
-- ----------------------------
DROP TABLE IF EXISTS `dict_states`;
CREATE TABLE `dict_states` (
  `id_states_dict` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `state_name` varchar(128) NOT NULL,
  PRIMARY KEY (`id_states_dict`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for dotpay_logs
-- ----------------------------
DROP TABLE IF EXISTS `dotpay_logs`;
CREATE TABLE `dotpay_logs` (
  `id_dotpay_log` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `log_desc` text,
  `log_time` datetime DEFAULT NULL,
  `t_id` varchar(255) NOT NULL,
  `info` text,
  PRIMARY KEY (`id_dotpay_log`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for elements
-- ----------------------------
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

-- ----------------------------
-- Table structure for galleries
-- ----------------------------
DROP TABLE IF EXISTS `galleries`;
CREATE TABLE `galleries` (
  `id_gallery` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT 'pl_PL',
  `description` text,
  `element_id` int(11) NOT NULL,
  `show_title` enum('N','Y') NOT NULL DEFAULT 'Y',
  PRIMARY KEY (`id_gallery`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for galleries_images
-- ----------------------------
DROP TABLE IF EXISTS `galleries_images`;
CREATE TABLE `galleries_images` (
  `id_galleries_images` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `image_id` int(10) unsigned NOT NULL,
  `gallery_id` int(10) unsigned NOT NULL,
  `alt` varchar(255) DEFAULT NULL,
  `lang` char(5) NOT NULL,
  PRIMARY KEY (`id_galleries_images`,`lang`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for gallery_images
-- ----------------------------
DROP TABLE IF EXISTS `gallery_images`;
CREATE TABLE `gallery_images` (
  `id_image` int(11) NOT NULL AUTO_INCREMENT,
  `filename` varchar(255) NOT NULL,
  `realfilename` varchar(255) NOT NULL,
  `mainimage` tinyint(1) unsigned NOT NULL,
  `position` int(5) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_image`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for images
-- ----------------------------
DROP TABLE IF EXISTS `images`;
CREATE TABLE `images` (
  `id_image` int(11) NOT NULL AUTO_INCREMENT,
  `filename` varchar(255) NOT NULL,
  `realfilename` varchar(255) NOT NULL,
  `mainimage` tinyint(1) unsigned NOT NULL,
  `alt` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_image`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for languages
-- ----------------------------
DROP TABLE IF EXISTS `languages`;
CREATE TABLE `languages` (
  `id_language` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(5) NOT NULL,
  `description` varchar(64) NOT NULL,
  `flag` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`id_language`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for medias
-- ----------------------------
DROP TABLE IF EXISTS `medias`;
CREATE TABLE `medias` (
  `id_media` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `file_name` varchar(255) NOT NULL,
  `mime_type_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id_media`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for medias_mime_types
-- ----------------------------
DROP TABLE IF EXISTS `medias_mime_types`;
CREATE TABLE `medias_mime_types` (
  `id_mime_type` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `mime_type` varchar(128) NOT NULL,
  `type` varchar(255) NOT NULL,
  PRIMARY KEY (`id_mime_type`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for medias_product
-- ----------------------------
DROP TABLE IF EXISTS `medias_product`;
CREATE TABLE `medias_product` (
  `product_id` int(11) NOT NULL,
  `media_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for news
-- ----------------------------
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
  PRIMARY KEY (`id_news`,`lang`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for news_categories
-- ----------------------------
DROP TABLE IF EXISTS `news_categories`;
CREATE TABLE `news_categories` (
  `id_news_category` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `news_category_name` varchar(255) NOT NULL,
  `element_id` int(11) NOT NULL,
  `show_title` enum('N','Y') NOT NULL DEFAULT 'Y',
  `comments` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '0 - wylaczone, 1 - wlaczone',
  PRIMARY KEY (`id_news_category`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for news_comments
-- ----------------------------
DROP TABLE IF EXISTS `news_comments`;
CREATE TABLE `news_comments` (
  `id_news_comment` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `comment` text NOT NULL,
  `news_id` int(10) unsigned NOT NULL,
  `nick` varchar(50) NOT NULL,
  `client_ip` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_news_comment`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for news_elements
-- ----------------------------
DROP TABLE IF EXISTS `news_elements`;
CREATE TABLE `news_elements` (
  `id_news_elements` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `news_id` int(11) unsigned NOT NULL,
  `element_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id_news_elements`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for news_images
-- ----------------------------
DROP TABLE IF EXISTS `news_images`;
CREATE TABLE `news_images` (
  `news_id` int(10) unsigned NOT NULL,
  `images_id` int(10) unsigned NOT NULL,
  `id_news_images` int(10) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id_news_images`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for news_to_categories
-- ----------------------------
DROP TABLE IF EXISTS `news_to_categories`;
CREATE TABLE `news_to_categories` (
  `id_news_to_categories` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `news_id` int(11) unsigned NOT NULL,
  `news_category_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id_news_to_categories`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for newsletter_email_groups
-- ----------------------------
DROP TABLE IF EXISTS `newsletter_email_groups`;
CREATE TABLE `newsletter_email_groups` (
  `newsletter_group_id` int(10) unsigned NOT NULL,
  `newsletter_email_id` int(10) unsigned NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for newsletter_email_send
-- ----------------------------
DROP TABLE IF EXISTS `newsletter_email_send`;
CREATE TABLE `newsletter_email_send` (
  `newsletter_id` int(10) unsigned NOT NULL,
  `email_id` int(10) unsigned NOT NULL,
  `send_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for newsletter_emails
-- ----------------------------
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

-- ----------------------------
-- Table structure for newsletter_groups
-- ----------------------------
DROP TABLE IF EXISTS `newsletter_groups`;
CREATE TABLE `newsletter_groups` (
  `id_newsletter_group` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `default_group` tinyint(4) NOT NULL DEFAULT '0',
  `lang` varchar(5) NOT NULL DEFAULT 'pl_PL',
  PRIMARY KEY (`id_newsletter_group`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for newsletter_images
-- ----------------------------
DROP TABLE IF EXISTS `newsletter_images`;
CREATE TABLE `newsletter_images` (
  `id_image` int(11) NOT NULL AUTO_INCREMENT,
  `filename` varchar(255) NOT NULL,
  `newsletter_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id_image`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for newsletters
-- ----------------------------
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

-- ----------------------------
-- Table structure for newsletters_attachments
-- ----------------------------
DROP TABLE IF EXISTS `newsletters_attachments`;
CREATE TABLE `newsletters_attachments` (
  `newsletter_id` int(10) unsigned NOT NULL,
  `attachment` varchar(255) CHARACTER SET utf8 NOT NULL,
  `position` int(10) unsigned NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for newsletters_newsletter_groups
-- ----------------------------
DROP TABLE IF EXISTS `newsletters_newsletter_groups`;
CREATE TABLE `newsletters_newsletter_groups` (
  `newsletter_id` int(10) unsigned NOT NULL,
  `newsletter_group_id` int(10) unsigned NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for page_content
-- ----------------------------
DROP TABLE IF EXISTS `page_content`;
CREATE TABLE `page_content` (
  `id_page_content` int(11) NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `content` text NOT NULL,
  `element_id` int(11) DEFAULT NULL,
  `show_title` enum('N','Y') NOT NULL DEFAULT 'Y',
  PRIMARY KEY (`id_page_content`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for pages
-- ----------------------------
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
  PRIMARY KEY (`id_page`,`lang`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for pages_elements
-- ----------------------------
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

-- ----------------------------
-- Table structure for pages_languages
-- ----------------------------
DROP TABLE IF EXISTS `pages_languages`;
CREATE TABLE `pages_languages` (
  `page_id` int(11) NOT NULL,
  `language_id` varchar(45) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for partners
-- ----------------------------
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

-- ----------------------------
-- Table structure for polls_answers
-- ----------------------------
DROP TABLE IF EXISTS `polls_answers`;
CREATE TABLE `polls_answers` (
  `id_answer` int(11) NOT NULL AUTO_INCREMENT,
  `question_id` int(11) NOT NULL,
  `language` char(20) DEFAULT 'pl_PL',
  `answer` varchar(255) NOT NULL,
  `votes` int(11) DEFAULT '0',
  PRIMARY KEY (`id_answer`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for polls_categories
-- ----------------------------
DROP TABLE IF EXISTS `polls_categories`;
CREATE TABLE `polls_categories` (
  `id_poll_category` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) NOT NULL,
  `element_id` int(11) NOT NULL,
  PRIMARY KEY (`id_poll_category`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for polls_questions
-- ----------------------------
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

-- ----------------------------
-- Table structure for polls_questions_to_categories
-- ----------------------------
DROP TABLE IF EXISTS `polls_questions_to_categories`;
CREATE TABLE `polls_questions_to_categories` (
  `id_poll_question_to_categories` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `poll_category_id` int(11) NOT NULL,
  `poll_question_id` int(11) NOT NULL,
  `active` enum('N','Y') DEFAULT 'N',
  PRIMARY KEY (`id_poll_question_to_categories`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for polls_voters
-- ----------------------------
DROP TABLE IF EXISTS `polls_voters`;
CREATE TABLE `polls_voters` (
  `question_id` int(10) unsigned NOT NULL,
  `answer_id` int(10) unsigned NOT NULL,
  `ip` char(15) NOT NULL,
  `mac` char(32) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for shop_attributes
-- ----------------------------
DROP TABLE IF EXISTS `shop_attributes`;
CREATE TABLE `shop_attributes` (
  `id_attribute` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `position` int(10) unsigned NOT NULL,
  `active` enum('Y','N') CHARACTER SET latin1 NOT NULL DEFAULT 'Y',
  PRIMARY KEY (`id_attribute`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for shop_attributes_description
-- ----------------------------
DROP TABLE IF EXISTS `shop_attributes_description`;
CREATE TABLE `shop_attributes_description` (
  `attribute_id` int(10) unsigned NOT NULL,
  `attribute_name` varchar(128) NOT NULL,
  `attribute_language` char(5) NOT NULL DEFAULT 'pl_PL'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for shop_attributes_values
-- ----------------------------
DROP TABLE IF EXISTS `shop_attributes_values`;
CREATE TABLE `shop_attributes_values` (
  `id_attribute_value` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `attribute_id` int(10) unsigned NOT NULL,
  `position` int(10) unsigned NOT NULL,
  `default` enum('N','Y') CHARACTER SET latin1 NOT NULL DEFAULT 'N',
  `active` enum('Y','N') CHARACTER SET latin1 NOT NULL DEFAULT 'Y',
  PRIMARY KEY (`id_attribute_value`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for shop_attributes_values_additional
-- ----------------------------
DROP TABLE IF EXISTS `shop_attributes_values_additional`;
CREATE TABLE `shop_attributes_values_additional` (
  `attribute_value_id` int(10) NOT NULL,
  `attribute_color` varchar(255) NOT NULL,
  `attribute_pattern` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for shop_attributes_values_description
-- ----------------------------
DROP TABLE IF EXISTS `shop_attributes_values_description`;
CREATE TABLE `shop_attributes_values_description` (
  `attribute_value_id` int(10) unsigned NOT NULL,
  `attribute_value` varchar(255) NOT NULL,
  `attribute_value_language` char(5) NOT NULL DEFAULT 'pl_PL'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for shop_categories
-- ----------------------------
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

-- ----------------------------
-- Table structure for shop_categories_description
-- ----------------------------
DROP TABLE IF EXISTS `shop_categories_description`;
CREATE TABLE `shop_categories_description` (
  `category_id` int(10) unsigned NOT NULL,
  `category_name` varchar(128) NOT NULL,
  `category_language` char(5) NOT NULL DEFAULT 'pl_PL'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for shop_configuration
-- ----------------------------
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
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for shop_currencies
-- ----------------------------
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

-- ----------------------------
-- Table structure for shop_customers
-- ----------------------------
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

-- ----------------------------
-- Table structure for shop_customers_clipboard
-- ----------------------------
DROP TABLE IF EXISTS `shop_customers_clipboard`;
CREATE TABLE `shop_customers_clipboard` (
  `id_clipboard` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `customer_id` int(10) unsigned NOT NULL,
  `product_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id_clipboard`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for shop_customers_subscriptions
-- ----------------------------
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

-- ----------------------------
-- Table structure for shop_delivery_ranges
-- ----------------------------
DROP TABLE IF EXISTS `shop_delivery_ranges`;
CREATE TABLE `shop_delivery_ranges` (
  `id_shop_delivery_ranges` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `range_from` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT 'zawarta',
  `range_to` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT 'niezawarta',
  `delivery_price` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `delivery_type_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id_shop_delivery_ranges`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for shop_delivery_types
-- ----------------------------
DROP TABLE IF EXISTS `shop_delivery_types`;
CREATE TABLE `shop_delivery_types` (
  `id_delivery_type` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `active` enum('Y','N') DEFAULT 'Y',
  `cash_on_delivery` tinyint(4) NOT NULL DEFAULT '0' COMMENT '1 za pobraniem',
  PRIMARY KEY (`id_delivery_type`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for shop_delivery_types_description
-- ----------------------------
DROP TABLE IF EXISTS `shop_delivery_types_description`;
CREATE TABLE `shop_delivery_types_description` (
  `delivery_type_id` int(10) unsigned NOT NULL,
  `delivery_type` varchar(255) NOT NULL,
  `delivery_type_language` char(5) DEFAULT 'pl_PL'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for shop_favourites_customers_products
-- ----------------------------
DROP TABLE IF EXISTS `shop_favourites_customers_products`;
CREATE TABLE `shop_favourites_customers_products` (
  `customer_id` int(10) unsigned NOT NULL,
  `product_id` int(10) unsigned NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for shop_measurement_units
-- ----------------------------
DROP TABLE IF EXISTS `shop_measurement_units`;
CREATE TABLE `shop_measurement_units` (
  `id_measurement_unit` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `active` enum('Y','N') NOT NULL DEFAULT 'Y',
  PRIMARY KEY (`id_measurement_unit`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for shop_measurement_units_description
-- ----------------------------
DROP TABLE IF EXISTS `shop_measurement_units_description`;
CREATE TABLE `shop_measurement_units_description` (
  `measurement_unit_id` int(10) unsigned NOT NULL,
  `measurement_language` char(5) NOT NULL,
  `measurement_name` varchar(128) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for shop_orders
-- ----------------------------
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
  PRIMARY KEY (`id_order`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED;

-- ----------------------------
-- Table structure for shop_orders_customers
-- ----------------------------
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

-- ----------------------------
-- Table structure for shop_orders_products
-- ----------------------------
DROP TABLE IF EXISTS `shop_orders_products`;
CREATE TABLE `shop_orders_products` (
  `order_id` int(11) unsigned NOT NULL,
  `product_id` int(11) unsigned NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_attributes` varchar(255) NOT NULL,
  `product_count` int(4) unsigned NOT NULL,
  `product_price` decimal(10,2) NOT NULL,
  `product_rebate` int(10) unsigned NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for shop_orders_statuses
-- ----------------------------
DROP TABLE IF EXISTS `shop_orders_statuses`;
CREATE TABLE `shop_orders_statuses` (
  `id_order_status` int(11) NOT NULL AUTO_INCREMENT,
  `order_status_name` varchar(128) NOT NULL,
  `language` char(5) DEFAULT 'pl_PL',
  PRIMARY KEY (`id_order_status`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for shop_parameters
-- ----------------------------
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

-- ----------------------------
-- Table structure for shop_parameters_description
-- ----------------------------
DROP TABLE IF EXISTS `shop_parameters_description`;
CREATE TABLE `shop_parameters_description` (
  `parameter_id` int(10) unsigned NOT NULL,
  `parameter_name` varchar(255) NOT NULL,
  `parameter_language` char(5) DEFAULT 'pl_PL'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for shop_parameters_to_categories
-- ----------------------------
DROP TABLE IF EXISTS `shop_parameters_to_categories`;
CREATE TABLE `shop_parameters_to_categories` (
  `parameter_id` int(10) unsigned NOT NULL,
  `category_id` int(10) unsigned NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for shop_parameters_values
-- ----------------------------
DROP TABLE IF EXISTS `shop_parameters_values`;
CREATE TABLE `shop_parameters_values` (
  `id_parameter_value` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parameter_id` int(10) unsigned NOT NULL,
  `parameter_value` varchar(255) NOT NULL,
  `active` enum('Y','N') DEFAULT 'Y',
  PRIMARY KEY (`id_parameter_value`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for shop_payment_types
-- ----------------------------
DROP TABLE IF EXISTS `shop_payment_types`;
CREATE TABLE `shop_payment_types` (
  `id_payment_type` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `active` enum('Y','N') NOT NULL DEFAULT 'Y',
  `payment_cost` double(10,2) DEFAULT NULL,
  `payment_type_method` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`id_payment_type`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for shop_payment_types_description
-- ----------------------------
DROP TABLE IF EXISTS `shop_payment_types_description`;
CREATE TABLE `shop_payment_types_description` (
  `payment_type_id` int(10) unsigned NOT NULL,
  `payment_type_name` varchar(255) NOT NULL,
  `payment_type_language` char(5) DEFAULT 'pl_PL',
  `payment_type_info` text
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for shop_producers
-- ----------------------------
DROP TABLE IF EXISTS `shop_producers`;
CREATE TABLE `shop_producers` (
  `id_producer` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `producer_name` varchar(255) NOT NULL,
  `producer_logo` varchar(255) DEFAULT NULL,
  `position` int(10) NOT NULL DEFAULT '0',
  `active` enum('Y','N') CHARACTER SET latin1 DEFAULT 'Y',
  `rebate` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id_producer`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for shop_product_parameters
-- ----------------------------
DROP TABLE IF EXISTS `shop_product_parameters`;
CREATE TABLE `shop_product_parameters` (
  `id_product_to_parameter` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int(10) unsigned NOT NULL,
  `parameter_id` int(10) unsigned NOT NULL,
  `value` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`id_product_to_parameter`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for shop_product_to_variant
-- ----------------------------
DROP TABLE IF EXISTS `shop_product_to_variant`;
CREATE TABLE `shop_product_to_variant` (
  `product_id` int(10) unsigned NOT NULL,
  `variant_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `quantity` int(10) unsigned NOT NULL DEFAULT '0',
  `variant_values` text NOT NULL,
  PRIMARY KEY (`variant_id`),
  UNIQUE KEY `variant_id` (`variant_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for shop_products
-- ----------------------------
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for shop_products_attachments
-- ----------------------------
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

-- ----------------------------
-- Table structure for shop_products_attributes
-- ----------------------------
DROP TABLE IF EXISTS `shop_products_attributes`;
CREATE TABLE `shop_products_attributes` (
  `product_id` int(10) unsigned NOT NULL,
  `attribute_id` int(11) NOT NULL,
  `attribute_value_id` int(11) NOT NULL,
  `price` double unsigned DEFAULT NULL,
  `default_value` enum('N','Y') DEFAULT 'N',
  `quantity` int(10) unsigned DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for shop_products_comments
-- ----------------------------
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

-- ----------------------------
-- Table structure for shop_products_description
-- ----------------------------
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

-- ----------------------------
-- Table structure for shop_products_files
-- ----------------------------
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

-- ----------------------------
-- Table structure for shop_products_images
-- ----------------------------
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

-- ----------------------------
-- Table structure for shop_products_medias
-- ----------------------------
DROP TABLE IF EXISTS `shop_products_medias`;
CREATE TABLE `shop_products_medias` (
  `product_id` int(11) NOT NULL,
  `media_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for shop_products_parameters
-- ----------------------------
DROP TABLE IF EXISTS `shop_products_parameters`;
CREATE TABLE `shop_products_parameters` (
  `product_id` int(10) unsigned DEFAULT NULL,
  `parameter_id` int(10) unsigned DEFAULT NULL,
  `parameter_value_id` int(10) unsigned DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for shop_products_project_gallery
-- ----------------------------
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

-- ----------------------------
-- Table structure for shop_products_statuses
-- ----------------------------
DROP TABLE IF EXISTS `shop_products_statuses`;
CREATE TABLE `shop_products_statuses` (
  `id_product_status` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `allow_buy` enum('Y','N') CHARACTER SET latin1 NOT NULL DEFAULT 'Y',
  `active` enum('Y','N') NOT NULL DEFAULT 'Y',
  PRIMARY KEY (`id_product_status`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for shop_products_statuses_description
-- ----------------------------
DROP TABLE IF EXISTS `shop_products_statuses_description`;
CREATE TABLE `shop_products_statuses_description` (
  `product_status_id` int(11) unsigned NOT NULL,
  `product_status_name` varchar(255) NOT NULL,
  `product_status_language` char(5) NOT NULL DEFAULT 'pl_PL'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for shop_products_tags
-- ----------------------------
DROP TABLE IF EXISTS `shop_products_tags`;
CREATE TABLE `shop_products_tags` (
  `product_id` int(10) unsigned NOT NULL,
  `tag_dict_id` int(10) unsigned NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for shop_products_tags_dict
-- ----------------------------
DROP TABLE IF EXISTS `shop_products_tags_dict`;
CREATE TABLE `shop_products_tags_dict` (
  `id_tag_dict` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `word` varchar(255) NOT NULL,
  PRIMARY KEY (`id_tag_dict`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for shop_products_to_categories
-- ----------------------------
DROP TABLE IF EXISTS `shop_products_to_categories`;
CREATE TABLE `shop_products_to_categories` (
  `product_id` int(10) unsigned NOT NULL,
  `category_id` int(10) unsigned NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for shop_products_to_news
-- ----------------------------
DROP TABLE IF EXISTS `shop_products_to_news`;
CREATE TABLE `shop_products_to_news` (
  `product_id` int(11) NOT NULL,
  `news_id` int(11) NOT NULL,
  KEY `product_id` (`product_id`,`news_id`),
  KEY `news_id` (`news_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for shop_products_variants
-- ----------------------------
DROP TABLE IF EXISTS `shop_products_variants`;
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for shop_questions
-- ----------------------------
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

-- ----------------------------
-- Table structure for shop_rebates_codes
-- ----------------------------
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

-- ----------------------------
-- Table structure for shop_rebates_codes_to_products
-- ----------------------------
DROP TABLE IF EXISTS `shop_rebates_codes_to_products`;
CREATE TABLE `shop_rebates_codes_to_products` (
  `product_id` int(10) unsigned NOT NULL,
  `rebate_code_id` int(10) unsigned NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for shop_rebates_groups
-- ----------------------------
DROP TABLE IF EXISTS `shop_rebates_groups`;
CREATE TABLE `shop_rebates_groups` (
  `id_rebate_group` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `group_name` varchar(128) NOT NULL,
  `rebate` int(10) unsigned NOT NULL,
  `active` enum('Y','N') CHARACTER SET latin1 NOT NULL DEFAULT 'Y',
  PRIMARY KEY (`id_rebate_group`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for shop_related_products
-- ----------------------------
DROP TABLE IF EXISTS `shop_related_products`;
CREATE TABLE `shop_related_products` (
  `product_id` int(10) unsigned NOT NULL,
  `related_product_id` int(10) unsigned NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for shop_search
-- ----------------------------
DROP TABLE IF EXISTS `shop_search`;
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for shop_subscriptions_logs
-- ----------------------------
DROP TABLE IF EXISTS `shop_subscriptions_logs`;
CREATE TABLE `shop_subscriptions_logs` (
  `id_shop_subscriptions_log` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `customer_id` int(10) NOT NULL,
  `request` text,
  `response` text,
  PRIMARY KEY (`id_shop_subscriptions_log`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for shop_taxes
-- ----------------------------
DROP TABLE IF EXISTS `shop_taxes`;
CREATE TABLE `shop_taxes` (
  `id_tax` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tax_name` varchar(255) NOT NULL,
  `tax_value` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id_tax`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for slider_elements
-- ----------------------------
DROP TABLE IF EXISTS `slider_elements`;
CREATE TABLE `slider_elements` (
  `id_slider_element` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `slider_type_id` tinyint(2) unsigned NOT NULL,
  `slider_element_id` int(10) NOT NULL,
  `slider_element_position` int(3) unsigned NOT NULL DEFAULT '0',
  `available` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id_slider_element`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for slider_images
-- ----------------------------
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

-- ----------------------------
-- Table structure for slider_news
-- ----------------------------
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

-- ----------------------------
-- Table structure for tags
-- ----------------------------
DROP TABLE IF EXISTS `tags`;
CREATE TABLE `tags` (
  `id_tag` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `element_id` int(11) unsigned NOT NULL,
  `dictionary_tag_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id_tag`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for tags_dictionary
-- ----------------------------
DROP TABLE IF EXISTS `tags_dictionary`;
CREATE TABLE `tags_dictionary` (
  `id_tag_dictionary` int(11) NOT NULL AUTO_INCREMENT,
  `word` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`id_tag_dictionary`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records 
-- ----------------------------
INSERT INTO `acl_permissions` VALUES ('2', 'users_add', 'users', 'add', 'Dodawanie użytkowników');
INSERT INTO `acl_permissions` VALUES ('3', 'users_edit', 'users', 'edit', 'Edycja użytkowników');
INSERT INTO `acl_permissions` VALUES ('4', 'users_delete', 'users', 'delete', 'Usuwanie użytkowników');
INSERT INTO `acl_permissions` VALUES ('5', 'roles_index', 'roles', 'index', 'Lista ról');
INSERT INTO `acl_permissions` VALUES ('6', 'roles_add', 'roles', 'add', 'Dodawanie ról');
INSERT INTO `acl_permissions` VALUES ('7', 'roles_edit', 'roles', 'edit', 'Edycja ról');
INSERT INTO `acl_permissions` VALUES ('8', 'roles_delete', 'roles', 'delete', 'Usuwanie ról');
INSERT INTO `acl_permissions` VALUES ('9', 'permissions_index', 'permissions', 'index', 'Lista uprawnień');
INSERT INTO `acl_permissions` VALUES ('10', 'permissions_add', 'permissions', 'add', 'Dodawanie uprawnień');
INSERT INTO `acl_permissions` VALUES ('11', 'permissions_edit', 'permissions', 'edit', 'Edycja uprawnień');
INSERT INTO `acl_permissions` VALUES ('12', 'permissions_delete', 'permissions', 'delete', 'Usuwanie uprawnień');
INSERT INTO `acl_permissions` VALUES ('13', 'permissions_manage', 'permissions', 'manage', 'Zarządzanie uprawnieniami');
INSERT INTO `acl_permissions` VALUES ('14', 'newsletters_index', 'newsletters', 'index', 'Lista newsletterów');
INSERT INTO `acl_permissions` VALUES ('15', 'newsletters_add', 'newsletters', 'add', 'Dodawanie newsletterów');
INSERT INTO `acl_permissions` VALUES ('16', 'newsletters_edit', 'newsletters', 'edit', 'Edycja newsletterów');
INSERT INTO `acl_permissions` VALUES ('17', 'newsletters_delete', 'newsletters', 'delete', 'Usuwanie newsletterów');
INSERT INTO `acl_permissions` VALUES ('18', 'newsletters_send', 'newsletters', 'send', 'Wysyłanie newsletterów');
INSERT INTO `acl_permissions` VALUES ('19', 'newsletters_group_add', 'newsletters', 'group_add', 'Dodawanie grup newsletterów');
INSERT INTO `acl_permissions` VALUES ('20', 'newsletters_group_edit', 'newsletters', 'group_edit', 'Edycja grup newsletterów');
INSERT INTO `acl_permissions` VALUES ('21', 'newsletters_group_delete', 'newsletters', 'group_delete', 'Usuwanie grup newsletterów');
INSERT INTO `acl_permissions` VALUES ('22', 'newsletters_email_add', 'newsletters', 'email_add', 'Dodawanie emaili do newsletterów');
INSERT INTO `acl_permissions` VALUES ('23', 'newsletters_email_edit', 'newsletters', 'email_edit', 'Edycja emaili do newsletterów');
INSERT INTO `acl_permissions` VALUES ('24', 'newsletters_email_delete', 'newsletters', 'email_delete', 'Usuwanie emaili do newsletterów');
INSERT INTO `acl_permissions` VALUES ('25', 'news_index', 'news', 'index', 'Lista aktualności');
INSERT INTO `acl_permissions` VALUES ('26', 'news_add', 'news', 'add', 'Dodawanie aktualności');
INSERT INTO `acl_permissions` VALUES ('27', 'news_edit', 'news', 'edit', 'Edycja aktualności');
INSERT INTO `acl_permissions` VALUES ('28', 'news_delete', 'news', 'delete', 'Usuwanie aktualności');
INSERT INTO `acl_permissions` VALUES ('29', 'pages_index', 'pages', 'index', 'Lista stron');
INSERT INTO `acl_permissions` VALUES ('30', 'pages_add', 'pages', 'add', 'Dodawanie stron');
INSERT INTO `acl_permissions` VALUES ('31', 'pages_edit', 'pages', 'edit', 'Edycja stron');
INSERT INTO `acl_permissions` VALUES ('32', 'pages_delete', 'pages', 'delete', 'Usuwanie stron');
INSERT INTO `acl_permissions` VALUES ('41', 'galleries_index', 'galleries', 'index', 'Lista galerii');
INSERT INTO `acl_permissions` VALUES ('42', 'galleries_add', 'galleries', 'add', 'Dodawanie galerii');
INSERT INTO `acl_permissions` VALUES ('43', 'galleries_edit', 'galleries', 'edit', 'Edycja galerii');
INSERT INTO `acl_permissions` VALUES ('44', 'galleries_delete', 'galleries', 'delete', 'Usuwanie galerii');
INSERT INTO `acl_permissions` VALUES ('45', 'galleries_delete_photo', 'galleries', 'delete_photo', 'Usuwanie zdjęć z galerii');
INSERT INTO `acl_permissions` VALUES ('46', 'galleries_add_photo', 'galleries', 'add_photo', 'Dodawanie zdjęc do galerii');
INSERT INTO `acl_permissions` VALUES ('50', 'newsletters_groups_index', 'newsletters', 'groups_index', 'Lista grup newsletterów');
INSERT INTO `acl_permissions` VALUES ('51', 'newsletters_emails_index', 'newsletters', 'emails_index', 'Lista emaili newsletterów');
INSERT INTO `acl_permissions` VALUES ('52', 'elements_index', 'elements', 'index', 'Lista elementów');
INSERT INTO `acl_permissions` VALUES ('53', 'elements_add', 'elements', 'add', 'Dodawanie elementów');
INSERT INTO `acl_permissions` VALUES ('54', 'elements_edit', 'elements', 'edit', 'Edycja elementów');
INSERT INTO `acl_permissions` VALUES ('55', 'elements_delete', 'elements', 'delete', 'Usuwanie elementów');
INSERT INTO `acl_permissions` VALUES ('56', 'page_content_index', 'page_content', 'index', 'Lista treści na stronach');
INSERT INTO `acl_permissions` VALUES ('57', 'page_content_add', 'page_content', 'add', 'Dodawanie treści na stronach');
INSERT INTO `acl_permissions` VALUES ('58', 'page_content_edit', 'page_content', 'edit', 'Edycja treści na stronach');
INSERT INTO `acl_permissions` VALUES ('59', 'page_content_delete', 'page_content', 'delete', 'Usuwanie treści stron');
INSERT INTO `acl_permissions` VALUES ('60', 'pages_edit_content', 'pages', 'edit_content', 'Edycja zawartości strony');
INSERT INTO `acl_permissions` VALUES ('61', 'medias_index', 'medias', 'index', 'Lista mediów');
INSERT INTO `acl_permissions` VALUES ('62', 'medias_add', 'medias', 'add', 'Dodawanie mediów');
INSERT INTO `acl_permissions` VALUES ('63', 'medias_delete', 'medias', 'delete', 'Usuwanie mediów');
INSERT INTO `acl_permissions` VALUES ('64', 'configurations_index', 'configurations', 'index', 'Ustawienia aplikacji');
INSERT INTO `acl_permissions` VALUES ('65', 'polls_index', 'polls', 'index', 'Lista sond');
INSERT INTO `acl_permissions` VALUES ('66', 'polls_add', 'polls', 'add', 'Dodawanie sond');
INSERT INTO `acl_permissions` VALUES ('67', 'polls_edit', 'polls', 'edit', 'Edycja sond');
INSERT INTO `acl_permissions` VALUES ('68', 'polls_delete', 'polls', 'delete', 'Usuwanie sond');
INSERT INTO `acl_permissions` VALUES ('93', 'news_categories_index', 'news_categories', 'index', 'Lista kategorii aktualności');
INSERT INTO `acl_permissions` VALUES ('94', 'news_categories_add', 'news_categories', 'add', 'Dodawanie kategorii aktualności');
INSERT INTO `acl_permissions` VALUES ('95', 'news_categories_edit', 'news_categories', 'edit', 'Edycja kategorii aktualności');
INSERT INTO `acl_permissions` VALUES ('96', 'polls_categories_add', 'polls_categories', 'add', 'Dodawanie kategorii sond');
INSERT INTO `acl_permissions` VALUES ('97', 'polls_categories_edit', 'polls_categories', 'edit', 'Edycja kategorii sond');
INSERT INTO `acl_permissions` VALUES ('98', 'polls_categories_index', 'polls_categories', 'index', 'Lista kategorii sond');
INSERT INTO `acl_permissions` VALUES ('103', 'news_categories_delete', 'news_categories', 'delete', 'Usuwanie kategorii aktualności');
INSERT INTO `acl_permissions` VALUES ('108', 'polls_categories_delete', 'polls_categories', 'delete', 'Usuwanie kategorii sond');
INSERT INTO `acl_permissions` VALUES ('109', 'contact_forms_index', 'contact_forms', 'index', 'Lista formularzy kontaktowych');
INSERT INTO `acl_permissions` VALUES ('110', 'contact_forms_add', 'contact_forms', 'add', 'Dodawanie formularzy kontaktowych');
INSERT INTO `acl_permissions` VALUES ('111', 'contact_forms_edit', 'contact_forms', 'edit', 'Edycja formularzy kontaktowych');
INSERT INTO `acl_permissions` VALUES ('112', 'contact_forms_delete', 'contact_forms', 'delete', 'Usuwanie formularzy kontaktowych');
INSERT INTO `acl_permissions` VALUES ('113', 'boxes_index', 'boxes', 'index', 'Lista boksów');
INSERT INTO `acl_permissions` VALUES ('114', 'boxes_add', 'boxes', 'add', 'Dodawanie boksów');
INSERT INTO `acl_permissions` VALUES ('115', 'boxes_edit', 'boxes', 'edit', 'Edycja boksów');
INSERT INTO `acl_permissions` VALUES ('116', 'boxes_delete', 'boxes', 'delete', 'Usuwanie boksów');
INSERT INTO `acl_permissions` VALUES ('117', 'galleries_element_position', 'galleries', 'element_position', 'Zmiana kolejności obrazów w galerii');
INSERT INTO `acl_permissions` VALUES ('118', 'slider_index', 'slider', 'index', 'Lista elementów slidera');
INSERT INTO `acl_permissions` VALUES ('119', 'slider_add', 'slider', 'add', 'Dodawanie elementów slidera');
INSERT INTO `acl_permissions` VALUES ('120', 'slider_edit', 'slider', 'edit', 'Edycja elementów slidera');
INSERT INTO `acl_permissions` VALUES ('121', 'slider_delete', 'slider', 'delete', 'Usuwanie elementów slidera');
INSERT INTO `acl_permissions` VALUES ('122', 'slider_element_position', 'slider', 'element_position', 'Zmiana kolejności elementów slidera');
INSERT INTO `acl_permissions` VALUES ('124', 'galleries_update_image', 'galleries', 'update_image', 'Zmiana opisu (alt) zdjęcia');
INSERT INTO `acl_permissions` VALUES ('33', 'products_categories_index', 'products_categories', 'index', 'Lista kategorii produktów');
INSERT INTO `acl_permissions` VALUES ('34', 'products_categories_add', 'products_categories', 'add', 'Dodawanie kategorii produktów');
INSERT INTO `acl_permissions` VALUES ('35', 'products_categories_edit', 'products_categories', 'edit', 'Edycja kategorii produktów');
INSERT INTO `acl_permissions` VALUES ('36', 'products_categories_delete', 'products_categories', 'delete', 'Usuwanie kategorii produktów');
INSERT INTO `acl_permissions` VALUES ('37', 'products_index', 'products', 'index', 'Lista produktów');
INSERT INTO `acl_permissions` VALUES ('38', 'products_add', 'products', 'add', 'Dodawanie produktów');
INSERT INTO `acl_permissions` VALUES ('39', 'products_edit', 'products', 'edit', 'Edycja produktów');
INSERT INTO `acl_permissions` VALUES ('40', 'products_delete', 'products', 'delete', 'Usuwanie produktów');
INSERT INTO `acl_permissions` VALUES ('47', 'reports_index', 'reports', 'index', 'Lista raportów');
INSERT INTO `acl_permissions` VALUES ('48', 'reports_view', 'reports', 'view', 'Podgląd raportu');
INSERT INTO `acl_permissions` VALUES ('49', 'reports_delete', 'reports', 'delete', 'Usuwanie raportów');
INSERT INTO `acl_permissions` VALUES ('69', 'orders_index', 'orders', 'index', 'Lista zamówień');
INSERT INTO `acl_permissions` VALUES ('70', 'orders_edit', 'orders', 'edit', 'Edycja zamówienia');
INSERT INTO `acl_permissions` VALUES ('71', 'orders_view', 'orders', 'view', 'Podgląd zamówienia');
INSERT INTO `acl_permissions` VALUES ('72', 'orders_delete', 'orders', 'delete', 'Usuwanie zamówień');
INSERT INTO `acl_permissions` VALUES ('73', 'attributes_index', 'attributes', 'index', 'Lista atrybutów');
INSERT INTO `acl_permissions` VALUES ('74', 'attributes_add', 'attributes', 'add', 'Dodawanie atrybutów');
INSERT INTO `acl_permissions` VALUES ('75', 'attributes_edit', 'attributes', 'edit', 'Edycja atrybutów');
INSERT INTO `acl_permissions` VALUES ('76', 'attributes_delete', 'attributes', 'delete', 'Usuwanie atrybutów');
INSERT INTO `acl_permissions` VALUES ('77', 'parameters_index', 'parameters', 'index', 'Lista parametrów');
INSERT INTO `acl_permissions` VALUES ('78', 'parameters_add', 'parameters', 'add', 'Dodawanie parametrów');
INSERT INTO `acl_permissions` VALUES ('79', 'parameters_edit', 'parameters', 'edit', 'Edycja parametrów');
INSERT INTO `acl_permissions` VALUES ('80', 'parameters_delete', 'parameters', 'delete', 'Usuwanie parametrów');
INSERT INTO `acl_permissions` VALUES ('81', 'producers_index', 'producers', 'index', 'Lista producentów');
INSERT INTO `acl_permissions` VALUES ('82', 'producers_add', 'producers', 'add', 'Dodawanie producentów');
INSERT INTO `acl_permissions` VALUES ('83', 'producers_edit', 'producers', 'edit', 'Edycja producentów');
INSERT INTO `acl_permissions` VALUES ('84', 'producers_delete', 'producers', 'delete', 'Usuwanie producentów');
INSERT INTO `acl_permissions` VALUES ('85', 'rebates_groups_index', 'rebates_groups', 'index', 'Lista grup rabatowych');
INSERT INTO `acl_permissions` VALUES ('86', 'rebates_groups_add', 'rebates_groups', 'add', 'Dodawanie grup rabatowych');
INSERT INTO `acl_permissions` VALUES ('87', 'rebates_groups_edit', 'rebates_groups', 'edit', 'Edycja grup rabatowych');
INSERT INTO `acl_permissions` VALUES ('88', 'rebates_groups_delete', 'rebates_groups', 'delete', 'Usuwanie grup rabatowych');
INSERT INTO `acl_permissions` VALUES ('89', 'products_statuses_index', 'products_statuses', 'index', 'Lista statusów produktów');
INSERT INTO `acl_permissions` VALUES ('90', 'products_statuses_add', 'products_statuses', 'add', 'Dodawanie statusów produktów');
INSERT INTO `acl_permissions` VALUES ('91', 'products_statuses_edit', 'products_statuses', 'edit', 'Edycja statusów produktów');
INSERT INTO `acl_permissions` VALUES ('92', 'products_statuses_delete', 'products_statuses', 'delete', 'usuwanie statusów produktów');
INSERT INTO `acl_permissions` VALUES ('99', 'attributes_values_index', 'attributes_values', 'indes', 'Lista wartości atrybutu');
INSERT INTO `acl_permissions` VALUES ('100', 'attributes_values_add', 'attributes_values', 'add', 'Dodawanie wartości atrybutu');
INSERT INTO `acl_permissions` VALUES ('101', 'attributes_values_edit', 'attributes_values', 'edit', 'Edycja wartości atrybutu');
INSERT INTO `acl_permissions` VALUES ('102', 'attributes_values_delete', 'attributes_values', 'delete', 'Usuwanie wartości atrybutu');
INSERT INTO `acl_permissions` VALUES ('104', 'taxes_index', 'taxes', 'index', 'Lista wartości VAT');
INSERT INTO `acl_permissions` VALUES ('105', 'taxes_add', 'taxes', 'add', 'Dodawanie wartości VAT');
INSERT INTO `acl_permissions` VALUES ('106', 'taxes_edit', 'taxes', 'edit', 'Edytowanie wartości VAT');
INSERT INTO `acl_permissions` VALUES ('107', 'taxes_delete', 'taxes', 'delete', 'Usuwanie wartości VAT');
INSERT INTO `acl_permissions` VALUES ('125', 'customers_index', 'customers', 'index', 'Lista klientów');
INSERT INTO `acl_permissions` VALUES ('126', 'customers_add', 'customers', 'add', 'Dodawanie klientów');
INSERT INTO `acl_permissions` VALUES ('127', 'customers_edit', 'customers', 'edit', 'Edycja klientów');
INSERT INTO `acl_permissions` VALUES ('128', 'customers_delete', 'customers', 'delete', 'Usuwanie klientów');
INSERT INTO `acl_permissions` VALUES ('129', 'delivery_types_index', 'delivery_types', 'index', 'Lista rodzajów dostaw');
INSERT INTO `acl_permissions` VALUES ('130', 'delivery_types_add', 'delivery_types', 'add', 'Dodawanie rodzaju dostawy');
INSERT INTO `acl_permissions` VALUES ('131', 'delivery_types_edit', 'delivery_types', 'edit', 'Edycja rodzaju dostawy');
INSERT INTO `acl_permissions` VALUES ('132', 'delivery_types_delete', 'delivery_types', 'delete', 'Usuwanie rodzaju dostawy');
INSERT INTO `acl_permissions` VALUES ('133', 'payment_types_index', 'payment_types', 'index', 'Lista rodzajów płatności');
INSERT INTO `acl_permissions` VALUES ('134', 'payment_types_add', 'payment_types', 'add', 'Dodawanie rodzajów płatności');
INSERT INTO `acl_permissions` VALUES ('135', 'payment_types_edit', 'payment_types', 'edit', 'Edycja rodzajów płatności');
INSERT INTO `acl_permissions` VALUES ('136', 'payment_types_delete', 'payment_types', 'delete', 'Usuwanie rodzajów płatności');
INSERT INTO `acl_permissions` VALUES ('137', 'orders_add', 'orders', 'add', 'Dodawanie zamówień');
INSERT INTO `acl_permissions` VALUES ('138', 'questions_index', 'questions', 'index', 'Lista zapytań od klientów');
INSERT INTO `acl_permissions` VALUES ('139', 'questions_preview', 'questions', 'preview', 'Podgląd szczegółów zapytań od klientów');
INSERT INTO `acl_permissions` VALUES ('140', 'questions_delete', 'questions', 'delete', 'Usuwanie zapytań od klientów');
INSERT INTO `acl_permissions` VALUES ('141', 'banners_delete', 'banners', 'delete', 'Usuwanie bannerów');
INSERT INTO `acl_permissions` VALUES ('142', 'banners_edit', 'banners', 'edit', 'Edycja bannerów');
INSERT INTO `acl_permissions` VALUES ('143', 'banners_add', 'banners', 'add', 'Dodawanie bannerów');
INSERT INTO `acl_permissions` VALUES ('144', 'banners_index', 'banners', 'index', 'Lista bannerów');
INSERT INTO `acl_permissions` VALUES ('145', 'shop_index', 'shop', 'index', 'Sklep');
INSERT INTO `acl_permissions` VALUES ('146', 'pages_settings_edit', 'pages', 'settings_edit', 'Edycja ustawień strony');
INSERT INTO `acl_permissions` VALUES ('147', 'currencies_index', 'currencies', 'index', 'Waluty');
INSERT INTO `acl_permissions` VALUES ('148', 'currencies_add', 'currencies', 'add', 'Edycja waluty');
INSERT INTO `acl_permissions` VALUES ('149', 'currencies_edit', 'currencies', 'edit', 'Edycja waluty');
INSERT INTO `acl_permissions` VALUES ('150', 'currencies_delete', 'currencies', 'delete', 'Usuwanie waluty');
INSERT INTO `acl_permissions` VALUES ('151', 'partners_index', 'partners', 'index', 'Lista partnerów');
INSERT INTO `acl_permissions` VALUES ('152', 'partners_add', 'partners', 'add', 'Dodawanie partnerów');
INSERT INTO `acl_permissions` VALUES ('153', 'partners_edit', 'partners', 'edit', 'Edycja partnera');
INSERT INTO `acl_permissions` VALUES ('154', 'partners_delete', 'partners', 'delete', 'Usuwanie partnera');
INSERT INTO `acl_permissions` VALUES ('155', 'rebates_codes_index', 'rebates_codes', 'index', 'Lista kodów rabatowych');
INSERT INTO `acl_permissions` VALUES ('156', 'rebates_codes_add', 'rebates_codes', 'add', 'Dodawanie kodów rabatowych');
INSERT INTO `acl_permissions` VALUES ('157', 'rebates_codes_edit', 'rebates_codes', 'edit', 'Edycja kodów rabatowych');
INSERT INTO `acl_permissions` VALUES ('158', 'rebates_codes_delete', 'rebates_codes', 'delete', 'Usuwanie kodów rabatowych');
INSERT INTO `acl_permissions` VALUES ('159', 'slider_elements_news_all', 'slider_elements', 'news_all', 'Aktualność na sliderze (pełny dostęp)');
INSERT INTO `acl_permissions` VALUES ('160', 'slider_elements_news_for_slider_all', 'slider_elements', 'news_for_slider_all', 'Aktualność dla slidera (pełny dostęp)');
INSERT INTO `acl_permissions` VALUES ('161', 'slider_elements_image_all', 'slider_elements', 'image_all', 'Zdjęcie na slider');
INSERT INTO `acl_permissions` VALUES ('162', 'variants', 'variants', 'all', 'Warianty produktów (pełne uprawnienia)');
INSERT INTO `acl_roles` VALUES ('13', 'administrator', '', '13', '1270017733', 'Y', '\'O:8:\\\"Zend_Acl\\\":6:{s:16:\\\"\\0*\\0_roleRegistry\\\";O:22:\\\"Zend_Acl_Role_Registry\\\":1:{s:9:\\\"\\0*\\0_roles\\\";a:1:{s:13:\\\"administrator\\\";a:3:{s:8:\\\"instance\\\";O:13:\\\"Zend_Acl_Role\\\":1:{s:10:\\\"\\0*\\0_roleId\\\";s:13:\\\"administrator\\\";}s:7:\\\"parents\\\";a:0:{}s:8:\\\"children\\\";a:0:{}}}}s:13:\\\"\\0*\\0_resources\\\";a:0:{}s:17:\\\"\\0*\\0_isAllowedRole\\\";N;s:21:\\\"\\0*\\0_isAllowedResource\\\";N;s:22:\\\"\\0*\\0_isAllowedPrivilege\\\";N;s:9:\\\"\\0*\\0_rules\\\";a:2:{s:12:\\\"allResources\\\";a:2:{s:8:\\\"allRoles\\\";a:2:{s:13:\\\"allPrivileges\\\";a:2:{s:4:\\\"type\\\";s:9:\\\"TYPE_DENY\\\";s:6:\\\"assert\\\";N;}s:13:\\\"byPrivilegeId\\\";a:0:{}}s:8:\\\"byRoleId\\\";a:1:{s:13:\\\"administrator\\\";a:2:{s:13:\\\"byPrivilegeId\\\";a:0:{}s:13:\\\"allPrivileges\\\";a:2:{s:4:\\\"type\\\";s:10:\\\"TYPE_ALLOW\\\";s:6:\\\"assert\\\";N;}}}}s:12:\\\"byResourceId\\\";a:0:{}}}\'');
INSERT INTO `acl_roles` VALUES ('39', 'demo', '', '13', '1358253023', 'Y', '');
INSERT INTO `acl_roles_permissions` VALUES ('13', '1');
INSERT INTO `acl_roles_permissions` VALUES ('13', '107');
INSERT INTO `acl_roles_permissions` VALUES ('13', '106');
INSERT INTO `acl_roles_permissions` VALUES ('13', '105');
INSERT INTO `acl_roles_permissions` VALUES ('13', '104');
INSERT INTO `acl_roles_permissions` VALUES ('13', '49');
INSERT INTO `acl_roles_permissions` VALUES ('13', '48');
INSERT INTO `acl_roles_permissions` VALUES ('13', '47');
INSERT INTO `acl_roles_permissions` VALUES ('13', '88');
INSERT INTO `acl_roles_permissions` VALUES ('13', '87');
INSERT INTO `acl_roles_permissions` VALUES ('13', '86');
INSERT INTO `acl_roles_permissions` VALUES ('13', '85');
INSERT INTO `acl_roles_permissions` VALUES ('13', '92');
INSERT INTO `acl_roles_permissions` VALUES ('13', '91');
INSERT INTO `acl_roles_permissions` VALUES ('13', '90');
INSERT INTO `acl_roles_permissions` VALUES ('13', '89');
INSERT INTO `acl_roles_permissions` VALUES ('13', '36');
INSERT INTO `acl_roles_permissions` VALUES ('13', '35');
INSERT INTO `acl_roles_permissions` VALUES ('13', '34');
INSERT INTO `acl_roles_permissions` VALUES ('13', '33');
INSERT INTO `acl_roles_permissions` VALUES ('13', '40');
INSERT INTO `acl_roles_permissions` VALUES ('13', '39');
INSERT INTO `acl_roles_permissions` VALUES ('13', '38');
INSERT INTO `acl_roles_permissions` VALUES ('13', '37');
INSERT INTO `acl_roles_permissions` VALUES ('13', '84');
INSERT INTO `acl_roles_permissions` VALUES ('13', '83');
INSERT INTO `acl_roles_permissions` VALUES ('13', '82');
INSERT INTO `acl_roles_permissions` VALUES ('13', '81');
INSERT INTO `acl_roles_permissions` VALUES ('13', '3');
INSERT INTO `acl_roles_permissions` VALUES ('13', '2');
INSERT INTO `acl_roles_permissions` VALUES ('13', '8');
INSERT INTO `acl_roles_permissions` VALUES ('13', '7');
INSERT INTO `acl_roles_permissions` VALUES ('13', '6');
INSERT INTO `acl_roles_permissions` VALUES ('13', '5');
INSERT INTO `acl_roles_permissions` VALUES ('13', '108');
INSERT INTO `acl_roles_permissions` VALUES ('13', '98');
INSERT INTO `acl_roles_permissions` VALUES ('13', '97');
INSERT INTO `acl_roles_permissions` VALUES ('13', '96');
INSERT INTO `acl_roles_permissions` VALUES ('13', '68');
INSERT INTO `acl_roles_permissions` VALUES ('13', '67');
INSERT INTO `acl_roles_permissions` VALUES ('13', '120');
INSERT INTO `acl_roles_permissions` VALUES ('13', '119');
INSERT INTO `acl_roles_permissions` VALUES ('13', '118');
INSERT INTO `acl_roles_permissions` VALUES ('13', '117');
INSERT INTO `acl_roles_permissions` VALUES ('13', '80');
INSERT INTO `acl_roles_permissions` VALUES ('13', '79');
INSERT INTO `acl_roles_permissions` VALUES ('13', '78');
INSERT INTO `acl_roles_permissions` VALUES ('13', '77');
INSERT INTO `acl_roles_permissions` VALUES ('13', '122');
INSERT INTO `acl_roles_permissions` VALUES ('13', '0');
INSERT INTO `acl_roles_permissions` VALUES ('13', '66');
INSERT INTO `acl_roles_permissions` VALUES ('13', '65');
INSERT INTO `acl_roles_permissions` VALUES ('13', '13');
INSERT INTO `acl_roles_permissions` VALUES ('13', '12');
INSERT INTO `acl_roles_permissions` VALUES ('13', '11');
INSERT INTO `acl_roles_permissions` VALUES ('13', '10');
INSERT INTO `acl_roles_permissions` VALUES ('13', '9');
INSERT INTO `acl_roles_permissions` VALUES ('13', '56');
INSERT INTO `acl_roles_permissions` VALUES ('13', '72');
INSERT INTO `acl_roles_permissions` VALUES ('13', '71');
INSERT INTO `acl_roles_permissions` VALUES ('13', '70');
INSERT INTO `acl_roles_permissions` VALUES ('13', '69');
INSERT INTO `acl_roles_permissions` VALUES ('13', '60');
INSERT INTO `acl_roles_permissions` VALUES ('13', '32');
INSERT INTO `acl_roles_permissions` VALUES ('13', '31');
INSERT INTO `acl_roles_permissions` VALUES ('13', '30');
INSERT INTO `acl_roles_permissions` VALUES ('13', '29');
INSERT INTO `acl_roles_permissions` VALUES ('13', '95');
INSERT INTO `acl_roles_permissions` VALUES ('13', '94');
INSERT INTO `acl_roles_permissions` VALUES ('13', '93');
INSERT INTO `acl_roles_permissions` VALUES ('13', '51');
INSERT INTO `acl_roles_permissions` VALUES ('13', '50');
INSERT INTO `acl_roles_permissions` VALUES ('13', '24');
INSERT INTO `acl_roles_permissions` VALUES ('13', '23');
INSERT INTO `acl_roles_permissions` VALUES ('13', '22');
INSERT INTO `acl_roles_permissions` VALUES ('13', '21');
INSERT INTO `acl_roles_permissions` VALUES ('13', '20');
INSERT INTO `acl_roles_permissions` VALUES ('13', '19');
INSERT INTO `acl_roles_permissions` VALUES ('13', '18');
INSERT INTO `acl_roles_permissions` VALUES ('13', '17');
INSERT INTO `acl_roles_permissions` VALUES ('13', '16');
INSERT INTO `acl_roles_permissions` VALUES ('13', '15');
INSERT INTO `acl_roles_permissions` VALUES ('13', '14');
INSERT INTO `acl_roles_permissions` VALUES ('13', '28');
INSERT INTO `acl_roles_permissions` VALUES ('13', '27');
INSERT INTO `acl_roles_permissions` VALUES ('13', '26');
INSERT INTO `acl_roles_permissions` VALUES ('13', '25');
INSERT INTO `acl_roles_permissions` VALUES ('13', '63');
INSERT INTO `acl_roles_permissions` VALUES ('13', '62');
INSERT INTO `acl_roles_permissions` VALUES ('13', '61');
INSERT INTO `acl_roles_permissions` VALUES ('13', '46');
INSERT INTO `acl_roles_permissions` VALUES ('13', '45');
INSERT INTO `acl_roles_permissions` VALUES ('13', '0');
INSERT INTO `acl_roles_permissions` VALUES ('13', '44');
INSERT INTO `acl_roles_permissions` VALUES ('13', '43');
INSERT INTO `acl_roles_permissions` VALUES ('13', '42');
INSERT INTO `acl_roles_permissions` VALUES ('13', '116');
INSERT INTO `acl_roles_permissions` VALUES ('13', '115');
INSERT INTO `acl_roles_permissions` VALUES ('13', '114');
INSERT INTO `acl_roles_permissions` VALUES ('13', '113');
INSERT INTO `acl_roles_permissions` VALUES ('13', '41');
INSERT INTO `acl_roles_permissions` VALUES ('13', '55');
INSERT INTO `acl_roles_permissions` VALUES ('13', '54');
INSERT INTO `acl_roles_permissions` VALUES ('13', '53');
INSERT INTO `acl_roles_permissions` VALUES ('13', '52');
INSERT INTO `acl_roles_permissions` VALUES ('13', '102');
INSERT INTO `acl_roles_permissions` VALUES ('13', '101');
INSERT INTO `acl_roles_permissions` VALUES ('13', '100');
INSERT INTO `acl_roles_permissions` VALUES ('13', '99');
INSERT INTO `acl_roles_permissions` VALUES ('13', '76');
INSERT INTO `acl_roles_permissions` VALUES ('13', '75');
INSERT INTO `acl_roles_permissions` VALUES ('13', '74');
INSERT INTO `acl_roles_permissions` VALUES ('13', '73');
INSERT INTO `acl_roles_permissions` VALUES ('13', '112');
INSERT INTO `acl_roles_permissions` VALUES ('13', '123');
INSERT INTO `acl_roles_permissions` VALUES ('13', '124');
INSERT INTO `acl_roles_permissions` VALUES ('39', '118');
INSERT INTO `acl_roles_permissions` VALUES ('39', '31');
INSERT INTO `acl_roles_permissions` VALUES ('39', '122');
INSERT INTO `acl_roles_permissions` VALUES ('39', '121');
INSERT INTO `acl_roles_permissions` VALUES ('39', '120');
INSERT INTO `acl_roles_permissions` VALUES ('39', '56');
INSERT INTO `acl_roles_permissions` VALUES ('39', '29');
INSERT INTO `acl_roles_permissions` VALUES ('39', '119');
INSERT INTO `acl_roles_permissions` VALUES ('39', '58');
INSERT INTO `acl_roles_permissions` VALUES ('39', '60');
INSERT INTO `acl_roles_permissions` VALUES ('39', '124');
INSERT INTO `acl_roles_permissions` VALUES ('13', '111');
INSERT INTO `acl_roles_permissions` VALUES ('13', '110');
INSERT INTO `acl_roles_permissions` VALUES ('13', '109');
INSERT INTO `acl_roles_permissions` VALUES ('13', '64');
INSERT INTO `acl_roles_permissions` VALUES ('39', '41');
INSERT INTO `acl_roles_permissions` VALUES ('39', '117');
INSERT INTO `acl_roles_permissions` VALUES ('39', '46');
INSERT INTO `acl_roles_permissions` VALUES ('39', '45');
INSERT INTO `acl_roles_permissions` VALUES ('13', '4');
INSERT INTO `acl_roles_permissions` VALUES ('13', '57');
INSERT INTO `acl_roles_permissions` VALUES ('13', '58');
INSERT INTO `acl_roles_permissions` VALUES ('13', '59');
INSERT INTO `acl_roles_permissions` VALUES ('39', '161');
INSERT INTO `acl_roles_permissions` VALUES ('39', '28');
INSERT INTO `acl_roles_permissions` VALUES ('39', '26');
INSERT INTO `acl_roles_permissions` VALUES ('39', '44');
INSERT INTO `acl_roles_permissions` VALUES ('39', '55');
INSERT INTO `acl_roles_permissions` VALUES ('39', '54');
INSERT INTO `acl_roles_permissions` VALUES ('39', '53');
INSERT INTO `acl_roles_permissions` VALUES ('39', '52');
INSERT INTO `acl_roles_permissions` VALUES ('39', '111');
INSERT INTO `acl_roles_permissions` VALUES ('39', '64');
INSERT INTO `acl_roles_permissions` VALUES ('39', '116');
INSERT INTO `acl_roles_permissions` VALUES ('39', '115');
INSERT INTO `acl_roles_permissions` VALUES ('39', '114');
INSERT INTO `acl_roles_permissions` VALUES ('39', '113');
INSERT INTO `acl_roles_permissions` VALUES ('39', '88');
INSERT INTO `acl_roles_permissions` VALUES ('39', '87');
INSERT INTO `acl_roles_permissions` VALUES ('39', '86');
INSERT INTO `acl_roles_permissions` VALUES ('39', '85');
INSERT INTO `acl_roles_permissions` VALUES ('39', '83');
INSERT INTO `acl_roles_permissions` VALUES ('39', '81');
INSERT INTO `acl_roles_permissions` VALUES ('39', '135');
INSERT INTO `acl_roles_permissions` VALUES ('39', '133');
INSERT INTO `acl_roles_permissions` VALUES ('39', '95');
INSERT INTO `acl_roles_permissions` VALUES ('39', '93');
INSERT INTO `acl_roles_permissions` VALUES ('39', '27');
INSERT INTO `acl_roles_permissions` VALUES ('39', '25');
INSERT INTO `acl_roles_permissions` VALUES ('39', '109');
INSERT INTO `acl_roles_permissions` VALUES ('39', '99');
INSERT INTO `acl_roles_permissions` VALUES ('39', '100');
INSERT INTO `acl_roles_permissions` VALUES ('39', '101');
INSERT INTO `acl_roles_permissions` VALUES ('39', '102');
INSERT INTO `acl_roles_permissions` VALUES ('39', '125');
INSERT INTO `acl_roles_permissions` VALUES ('39', '126');
INSERT INTO `acl_roles_permissions` VALUES ('39', '127');
INSERT INTO `acl_roles_permissions` VALUES ('39', '128');
INSERT INTO `acl_roles_permissions` VALUES ('39', '129');
INSERT INTO `acl_roles_permissions` VALUES ('39', '43');
INSERT INTO `acl_roles_permissions` VALUES ('39', '131');
INSERT INTO `acl_roles_permissions` VALUES ('39', '42');
INSERT INTO `acl_roles_permissions` VALUES ('39', '37');
INSERT INTO `acl_roles_permissions` VALUES ('39', '38');
INSERT INTO `acl_roles_permissions` VALUES ('39', '39');
INSERT INTO `acl_roles_permissions` VALUES ('39', '40');
INSERT INTO `acl_roles_permissions` VALUES ('39', '33');
INSERT INTO `acl_roles_permissions` VALUES ('39', '34');
INSERT INTO `acl_roles_permissions` VALUES ('39', '35');
INSERT INTO `acl_roles_permissions` VALUES ('39', '36');
INSERT INTO `acl_roles_permissions` VALUES ('39', '89');
INSERT INTO `acl_roles_permissions` VALUES ('39', '90');
INSERT INTO `acl_roles_permissions` VALUES ('39', '91');
INSERT INTO `acl_roles_permissions` VALUES ('39', '92');
INSERT INTO `acl_roles_permissions` VALUES ('39', '145');
INSERT INTO `acl_roles_permissions` VALUES ('39', '69');
INSERT INTO `acl_roles_permissions` VALUES ('39', '70');
INSERT INTO `acl_roles_permissions` VALUES ('39', '71');
INSERT INTO `acl_roles_permissions` VALUES ('39', '72');
INSERT INTO `acl_roles_permissions` VALUES ('39', '137');
INSERT INTO `acl_users` VALUES ('16', 'olicom@olicom.pl', 'Admin', 'Olicom', '', '*F2651DAB851BC94D1C6E3F08C9C68E89C0AF4484', '1270034596', '1406797676', '128', null, '13', 'Y', null, null, '6');
INSERT INTO `acl_users` VALUES ('19', 'demo@demo.pl', 'Admin', 'Demo', '', '*AB505E4F9AC59C3C8B6D4B859D1818F53DD82E6C', '1358253160', '1406031624', '17', null, '39', 'Y', null, null, null);
INSERT INTO `acl_users` VALUES ('27', 'kamil@olicom.pl', 'test', 'test', '', '*94BDCEBE19083CE2A1F959FD02F964C7AF4CFC29', '1387104785', '', '0', null, '13', 'Y', null, null, '5');
INSERT INTO `acl_users` VALUES ('28', 'dedra@dedra.info', 'dedra', 'dedra', '', '*0B8FBE81AAC86DB0F1037709C42E75660D4728CA', '1388742169', '1388742229', '2', null, '41', 'Y', null, null, null);
INSERT INTO `acl_users_images` VALUES ('5', '1387104785152ad8a1192ada415543402.jpg', 'good_job.jpg', '0', '');
INSERT INTO `acl_users_images` VALUES ('6', '1387107810152ad95e2c5333398476443.png', 'olicom-logo-140.png', '0', '');
INSERT INTO `configuration` VALUES ('1', 'administrator_email', 'demo@olicom.pl', 'Email', 'Adres z którego wysyłane są emaile z systemu', '', 'text');
INSERT INTO `configuration` VALUES ('2', 'administrator_name', 'Admin', 'Nazwa', 'Pole \"Od\" w wysyłanych e-mailach z systemu', '', 'text');
INSERT INTO `configuration` VALUES ('3', 'sending_email', 'demo@olicom.pl', 'Newsletter email', 'Adres z którego wysyłane są emaile newslettera', '', 'text');
INSERT INTO `configuration` VALUES ('4', 'sending_name', 'Newsletter', 'Newsletter nazwa', 'Pole \"Od\" w wysyłanych e-mailach newslettera', '', 'text');
INSERT INTO `configuration` VALUES ('5', 'google_tracking_code', '', 'Google Analytics', 'Kod do statystyk (UA-xxxxxxxxx-xx)', '', 'text');
INSERT INTO `configuration` VALUES ('6', 'page_name', 'OliShop', 'Nazwa strony', 'Używana w mailach', '', 'text');
INSERT INTO `configuration` VALUES ('7', 'page_domain', 'olishop.olicom.com.pl', 'Domena', 'Domena używama m.in. w mailach', '', 'text');
INSERT INTO `configuration` VALUES ('8', 'firm_address', '<strong>nazwa firmy</strong><br/>\r\nul. Ulica 22<br/>\r\n11-222 Poznań<br/><br/>\r\nmobile:<br/>\r\n+48 555 444 222<br/>\r\n+48 33 444 55 66<br/>\r\nemail: <a href=\"mailto:demo@olicom.pl\">demo@olicom.pl</a>', 'Adres firmy', 'Używany w mailach.', '', 'textarea');
INSERT INTO `dict_states` VALUES ('1', 'Dolnośląskie');
INSERT INTO `dict_states` VALUES ('2', 'Kujawsko-pomorskie');
INSERT INTO `dict_states` VALUES ('3', 'Lubelskie');
INSERT INTO `dict_states` VALUES ('4', 'Lubuskie');
INSERT INTO `dict_states` VALUES ('5', 'Łódzkie');
INSERT INTO `dict_states` VALUES ('6', 'Małopolskie');
INSERT INTO `dict_states` VALUES ('7', 'Mazowieckie');
INSERT INTO `dict_states` VALUES ('8', 'Opolskie');
INSERT INTO `dict_states` VALUES ('9', 'Podlaskie');
INSERT INTO `dict_states` VALUES ('10', 'Podkarpackie');
INSERT INTO `dict_states` VALUES ('11', 'Pomorskie');
INSERT INTO `dict_states` VALUES ('12', 'Śląskie');
INSERT INTO `dict_states` VALUES ('13', 'Świętokrzyskie');
INSERT INTO `dict_states` VALUES ('14', 'Warmińsko-mazurskie');
INSERT INTO `dict_states` VALUES ('15', 'Wielkopolskie');
INSERT INTO `dict_states` VALUES ('16', 'Zachodniopomorskie');
INSERT INTO `languages` VALUES ('1', 'pl_PL', 'polish', 'pl.png');
INSERT INTO `medias_mime_types` VALUES ('1', 'image/jpeg', 'images');
INSERT INTO `medias_mime_types` VALUES ('2', 'image/png', 'images');
INSERT INTO `medias_mime_types` VALUES ('3', 'image/gif', 'images');
INSERT INTO `medias_mime_types` VALUES ('4', 'text/plain', 'others');
INSERT INTO `medias_mime_types` VALUES ('5', 'application/octet-stream', 'others');
INSERT INTO `medias_mime_types` VALUES ('6', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'others');
INSERT INTO `medias_mime_types` VALUES ('7', 'application/pdf', 'others');
INSERT INTO `medias_mime_types` VALUES ('8', 'application/zip', 'others');
INSERT INTO `medias_mime_types` VALUES ('9', 'video/mpeg', 'others');
INSERT INTO `medias_mime_types` VALUES ('10', 'application/msword', 'others');
INSERT INTO `newsletter_groups` VALUES ('1', 'Grupa domyślna PL', 'Domyslna grupa dla osób zapisanych do newslettera z polskiej wersji językowej witryny.', '1', 'pl_PL');
INSERT INTO `newsletter_groups` VALUES ('2', 'Nowa grupa', 'Opis grupy\r\n', '0', 'pl_PL');
INSERT INTO `shop_configuration` VALUES ('1', 'product_stock', '0', 'Stany magazynowe', 'Ogólne stany magazynowe dla produktu', '', 'integer');
INSERT INTO `shop_configuration` VALUES ('2', 'rebates_codes', '1', 'Kody rabatowe', 'Kody rabatowe', '', 'integer');
INSERT INTO `shop_delivery_ranges` VALUES ('1', '1.00', '99999999.00', '25.00', '5');
INSERT INTO `shop_delivery_ranges` VALUES ('2', '1.00', '99999999.00', '7.00', '6');
INSERT INTO `shop_delivery_ranges` VALUES ('3', '1.00', '10000.00', '15.00', '7');
INSERT INTO `shop_delivery_types` VALUES ('5', 'Y', '0');
INSERT INTO `shop_delivery_types` VALUES ('6', 'Y', '0');
INSERT INTO `shop_delivery_types` VALUES ('7', 'Y', '0');
INSERT INTO `shop_delivery_types` VALUES ('10', 'N', '0');
INSERT INTO `shop_delivery_types_description` VALUES ('5', 'Kurier', 'pl_PL');
INSERT INTO `shop_delivery_types_description` VALUES ('6', 'Poczta Polska', 'pl_PL');
INSERT INTO `shop_delivery_types_description` VALUES ('7', 'carrier', 'en_US');
INSERT INTO `shop_delivery_types_description` VALUES ('10', 'ghjfd', 'pl_PL');
INSERT INTO `shop_payment_types` VALUES ('1', 'Y', '0.00', null);
INSERT INTO `shop_payment_types` VALUES ('2', 'Y', '0.00', 'dotpay');
INSERT INTO `shop_payment_types` VALUES ('3', 'Y', '0.00', 'dotpay');
INSERT INTO `shop_payment_types_description` VALUES ('1', 'Przelew na konto', 'pl_PL', 'PL  00 0000 0000 0000 0000 0000 0000<br/>Numer SWIFT banku: AAAAAAAA  -  jeśli płatność jest dokonywana z zagranicy<br/><br/>twoja firma<br/>ul. Ulica 1<br/>00-000 Miasto<br/><br/><strong>W tytule proszę wpisać numer zamówienia, oraz swoje imię i nazwisko.</strong>');
INSERT INTO `shop_payment_types_description` VALUES ('2', 'Karta kredytowa', 'pl_PL', null);
INSERT INTO `shop_payment_types_description` VALUES ('3', 'Dotpay', 'pl_PL', null);
INSERT INTO `shop_producers` VALUES ('11', 'Olicom', 'olicom-logo.png', '1', 'Y', null);
INSERT INTO `shop_producers` VALUES ('13', 'asds', null, '0', 'Y', null);
INSERT INTO `shop_producers` VALUES ('16', 'gbfc', null, '0', 'N', null);
INSERT INTO `shop_products_statuses` VALUES ('1', 'Y', 'Y');
INSERT INTO `shop_products_statuses` VALUES ('2', 'N', 'Y');
INSERT INTO `shop_products_statuses_description` VALUES ('1', 'Dostępny', 'pl_PL');
INSERT INTO `shop_products_statuses_description` VALUES ('2', 'Dostępny wkrótce', 'pl_PL');
INSERT INTO `shop_taxes` VALUES ('8', 'Stawka II', '23');
INSERT INTO `shop_taxes` VALUES ('7', 'Stawka I', '8');
