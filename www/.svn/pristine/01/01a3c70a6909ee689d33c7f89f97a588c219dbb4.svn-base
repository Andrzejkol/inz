/*
MySQL Data Transfer
Source Host: localhost
Source Database: cms2
Target Host: localhost
Target Database: cms2
Date: 2015-10-07 16:09:21
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
) ENGINE=MyISAM AUTO_INCREMENT=171 DEFAULT CHARSET=utf8;

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
-- Table structure for backups
-- ----------------------------
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
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

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
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

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
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

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
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

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
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

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
) ENGINE=MyISAM AUTO_INCREMENT=81 DEFAULT CHARSET=utf8;

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
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

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
) ENGINE=MyISAM AUTO_INCREMENT=56 DEFAULT CHARSET=utf8;

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
) ENGINE=MyISAM AUTO_INCREMENT=56 DEFAULT CHARSET=utf8;

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
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;

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
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

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
  `mainphotoname` varchar(255) NOT NULL,
  `mainfilename` varchar(255) NOT NULL,
  PRIMARY KEY (`id_news`,`lang`)
) ENGINE=MyISAM AUTO_INCREMENT=34 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for news_categories
-- ----------------------------
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
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

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
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

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
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for news_to_categories
-- ----------------------------
DROP TABLE IF EXISTS `news_to_categories`;
CREATE TABLE `news_to_categories` (
  `id_news_to_categories` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `news_id` int(11) unsigned NOT NULL,
  `news_category_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id_news_to_categories`)
) ENGINE=MyISAM AUTO_INCREMENT=51 DEFAULT CHARSET=utf8;

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
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

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
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

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
) ENGINE=MyISAM AUTO_INCREMENT=35 DEFAULT CHARSET=utf8;

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
  `filename` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_page`,`lang`)
) ENGINE=MyISAM AUTO_INCREMENT=48 DEFAULT CHARSET=utf8;

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
) ENGINE=MyISAM AUTO_INCREMENT=135 DEFAULT CHARSET=utf8;

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
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

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
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for polls_categories
-- ----------------------------
DROP TABLE IF EXISTS `polls_categories`;
CREATE TABLE `polls_categories` (
  `id_poll_category` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) NOT NULL,
  `element_id` int(11) NOT NULL,
  PRIMARY KEY (`id_poll_category`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

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
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

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
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

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
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

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
) ENGINE=MyISAM AUTO_INCREMENT=46 DEFAULT CHARSET=utf8;

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
) ENGINE=MyISAM AUTO_INCREMENT=42 DEFAULT CHARSET=utf8;

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
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

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
) ENGINE=MyISAM AUTO_INCREMENT=37 DEFAULT CHARSET=utf8;

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
) ENGINE=MyISAM AUTO_INCREMENT=95 DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED;

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
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

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
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

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
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

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
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

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
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;

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
) ENGINE=MyISAM AUTO_INCREMENT=130 DEFAULT CHARSET=utf8;

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
) ENGINE=MyISAM AUTO_INCREMENT=218 DEFAULT CHARSET=utf8;

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
) ENGINE=MyISAM AUTO_INCREMENT=169 DEFAULT CHARSET=utf8;

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
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

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
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

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
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

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
) ENGINE=MyISAM AUTO_INCREMENT=56 DEFAULT CHARSET=utf8;

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
) ENGINE=MyISAM AUTO_INCREMENT=41 DEFAULT CHARSET=utf8;

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
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

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
INSERT INTO `acl_permissions` VALUES ('163', 'backup_index', 'backup', 'index', 'Lista backupów');
INSERT INTO `acl_permissions` VALUES ('164', 'backup_restore', 'backup', 'restore', 'Przywracanie backupu');
INSERT INTO `acl_permissions` VALUES ('165', 'backup_add_backup', 'backup', 'add_backup', 'Tworzenie backupu');
INSERT INTO `acl_permissions` VALUES ('166', 'backup_delete', 'backup', 'delete', 'Usuwanie backupu');
INSERT INTO `acl_permissions` VALUES ('167', 'backup_index', 'backup', 'index', 'Lista backupów');
INSERT INTO `acl_permissions` VALUES ('168', 'backup_restore', 'backup', 'restore', 'Przywracanie backupu');
INSERT INTO `acl_permissions` VALUES ('169', 'backup_add_backup', 'backup', 'add_backup', 'Tworzenie backupu');
INSERT INTO `acl_permissions` VALUES ('170', 'backup_delete', 'backup', 'delete', 'Usuwanie backupu');
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
INSERT INTO `acl_users` VALUES ('16', 'olicom@olicom.pl', 'Admin', 'Olicom', '', '*F2651DAB851BC94D1C6E3F08C9C68E89C0AF4484', '1270034596', '1444197794', '156', null, '13', 'Y', null, null, '6');
INSERT INTO `acl_users` VALUES ('19', 'demo@demo.pl', 'Admin', 'Demo', '', '*AB505E4F9AC59C3C8B6D4B859D1818F53DD82E6C', '1358253160', '1406031624', '17', null, '39', 'Y', null, null, null);
INSERT INTO `acl_users` VALUES ('27', 'hubert@olicom.pl', 'test', 'test', '', '*32A0D6E18BB87F5C807AAC3CF34D9DBF0DE35277', '1387104785', '', '0', null, '13', 'Y', '35b80e17d736cfc1f9ce95252833e046', null, '5');
INSERT INTO `acl_users` VALUES ('28', 'dedra@dedra.info', 'dedra', 'dedra', '', '*0B8FBE81AAC86DB0F1037709C42E75660D4728CA', '1388742169', '1388742229', '2', null, '41', 'Y', null, null, null);
INSERT INTO `acl_users_images` VALUES ('5', '1387104785152ad8a1192ada415543402.jpg', 'good_job.jpg', '0', '');
INSERT INTO `acl_users_images` VALUES ('6', '1387107810152ad95e2c5333398476443.png', 'olicom-logo-140.png', '0', '');
INSERT INTO `backups` VALUES ('3', 'test', 'sthdfghdfg', '1', '2015-04-20 09:42:13', 'backups/backup_20150417165141.zip', 'application;modules;css;js', null);
INSERT INTO `backups` VALUES ('7', 'test555', 'sdhdrghdfghdfh', '0', '2015-04-20 09:30:58', 'backups/backup_20150420093045.zip', 'application;modules;css;js', null);
INSERT INTO `backups` VALUES ('8', 'Auto Restore Backup', 'Backup wykonany automatycznie przy przywracaniu innego backupu.', '0', '2015-04-20 09:33:53', 'backups/backup_20150420093348.zip', 'application;modules;css;js', null);
INSERT INTO `backups` VALUES ('9', 'Auto Restore Backup', 'Backup wykonany automatycznie przy przywracaniu innego backupu.', '0', '2015-04-20 09:39:46', 'backups/backup_20150420093940.zip', 'application;modules;css;js', null);
INSERT INTO `backups` VALUES ('14', 'gdfgsd', 'fvbsdvbxcvb', '0', '2015-04-28 08:44:12', 'backups/backup_20150428084411.zip', 'css', 'backups/backup_20150428084412.sql');
INSERT INTO `boxes` VALUES ('11', 'asd', 'asd', '', 'asdasd', '1', null, 'pl_PL', null, '6');
INSERT INTO `boxes` VALUES ('12', 'adsad', 'asdads', '', '', '1', null, 'pl_PL', null, '13');
INSERT INTO `configuration` VALUES ('1', 'administrator_email', 'demo@olicom.pl', 'Email', 'Adres z którego wysyłane są emaile z systemu', '', 'text');
INSERT INTO `configuration` VALUES ('2', 'administrator_name', 'Admin', 'Nazwa', 'Pole \"Od\" w wysyłanych e-mailach z systemu', '', 'text');
INSERT INTO `configuration` VALUES ('3', 'sending_email', 'demo@olicom.pl', 'Newsletter email', 'Adres z którego wysyłane są emaile newslettera', '', 'text');
INSERT INTO `configuration` VALUES ('4', 'sending_name', 'Newsletter', 'Newsletter nazwa', 'Pole \"Od\" w wysyłanych e-mailach newslettera', '', 'text');
INSERT INTO `configuration` VALUES ('5', 'google_tracking_code', '', 'Google Analytics', 'Kod do statystyk (UA-xxxxxxxxx-xx)', '', 'text');
INSERT INTO `configuration` VALUES ('6', 'page_name', 'Olishop', 'Nazwa strony', 'Używana w mailach', '', 'text');
INSERT INTO `configuration` VALUES ('7', 'page_domain', 'olishop.olicom.com.pl', 'Domena', 'Domena używama m.in. w mailach', '', 'text');
INSERT INTO `configuration` VALUES ('8', 'firm_address', '<p><strong>nazwa firmy</strong><br /> ul. Ulica 22<br /> 11-222 Poznań<br /><br /> mobile:<br /> +48 555 444 222<br /> +48 33 444 55 66<br /> email: <a href=\"mailto:demo@olicom.pl\">demo@olicom.pl</a></p>', 'Adres firmy', 'Używany w mailach.', '', 'textarea');
INSERT INTO `contact_forms` VALUES ('6', '80', 'test', 'pl_PL', 'hubert@olicom.pl', 'hubert@olicom.pl', 'N', 'Y');
INSERT INTO `contact_forms_log` VALUES ('1', '::1', '1389619744', 'pawel@olicom.org.pl', 'Akcesoria', 'dsa', 'dsa', 'test');
INSERT INTO `contact_forms_log` VALUES ('2', '127.0.0.1', '1392213439', 'hubert@olicom.pl', 'Hubert', '333444555', 'Test formularza', 'test formularza');
INSERT INTO `contact_forms_log` VALUES ('3', '127.0.0.1', '1402407552', 'hubert@olicom.pl', 'Hubert', '555666777', 'teswt', 'test');
INSERT INTO `contact_forms_log` VALUES ('4', '127.0.0.1', '1402408451', 'hubert@olicom.pl', 'Hubert', '555666777', 'test', 'Test');
INSERT INTO `contact_forms_log` VALUES ('5', '127.0.0.1', '1402475221', 'filip@olicom.pl', 'Hubert', '555666777', 'test', 'test');
INSERT INTO `contact_forms_log` VALUES ('6', '127.0.0.1', '1402475583', 'filip@olicom.pl', 'Hubert', '555666777', 'testttttt', 'Testttttt');
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
INSERT INTO `elements` VALUES ('58', 'polls', '1403701643', null, 'pl_PL', '1');
INSERT INTO `elements` VALUES ('74', 'page_content', '1435584918', null, 'pl_PL', '1');
INSERT INTO `elements` VALUES ('64', 'galleries', '1406803685', null, 'pl_PL', '1');
INSERT INTO `elements` VALUES ('27', 'page_content', '1389873612', null, 'en_US', '1');
INSERT INTO `elements` VALUES ('75', 'news', '1435644172', null, 'pl_PL', '1');
INSERT INTO `elements` VALUES ('77', 'news', '1435644907', null, 'pl_PL', '1');
INSERT INTO `elements` VALUES ('28', 'page_content', '1389873896', null, 'de_DE', '1');
INSERT INTO `elements` VALUES ('79', 'news', '1435645514', null, 'pl_PL', '1');
INSERT INTO `elements` VALUES ('76', 'news', '1435644234', null, 'pl_PL', '1');
INSERT INTO `elements` VALUES ('31', 'news', '1401094898', '1435657982', 'pl_PL', '1');
INSERT INTO `elements` VALUES ('80', 'contact_form', '1435906895', '1435909466', 'pl_PL', '1');
INSERT INTO `elements` VALUES ('43', 'galleries', '1403603700', null, 'pl_PL', '1');
INSERT INTO `elements` VALUES ('78', 'news', '1435645021', null, 'pl_PL', '1');
INSERT INTO `elements` VALUES ('60', 'polls', '1406279299', null, 'en_US', '1');
INSERT INTO `galleries` VALUES ('8', 'Galeria', '', '43', 'Y');
INSERT INTO `galleries` VALUES ('10', 'Test Galerii', '', '64', 'Y');
INSERT INTO `galleries_images` VALUES ('55', '55', '10', '', '');
INSERT INTO `galleries_images` VALUES ('37', '37', '8', '', '');
INSERT INTO `galleries_images` VALUES ('43', '43', '10', '1', '');
INSERT INTO `galleries_images` VALUES ('34', '34', '8', '', '');
INSERT INTO `galleries_images` VALUES ('35', '35', '8', '', '');
INSERT INTO `galleries_images` VALUES ('36', '36', '8', '', '');
INSERT INTO `galleries_images` VALUES ('39', '39', '8', '', '');
INSERT INTO `galleries_images` VALUES ('54', '54', '10', '', '');
INSERT INTO `galleries_images` VALUES ('48', '48', '10', '', '');
INSERT INTO `galleries_images` VALUES ('49', '49', '10', '', '');
INSERT INTO `galleries_images` VALUES ('53', '53', '10', '', '');
INSERT INTO `galleries_images` VALUES ('52', '52', '10', '', '');
INSERT INTO `gallery_images` VALUES ('49', '1406809616153da3610da544202134174.jpg', 'slogan3.jpg', '0', '3');
INSERT INTO `gallery_images` VALUES ('43', '1406803788153da1f4c3953c004720381.jpg', 'slogan4.jpg', '0', '1');
INSERT INTO `gallery_images` VALUES ('34', '1403771263153abd97f3cc83728653350.png', 'adwords.png', '0', '1');
INSERT INTO `gallery_images` VALUES ('35', '1403771267153abd9837ed92772976768.png', 'aktualizacjawww.png', '0', '2');
INSERT INTO `gallery_images` VALUES ('36', '1403771271153abd987427bc855951406.png', 'appfb.png', '0', '3');
INSERT INTO `gallery_images` VALUES ('37', '1403771276153abd98c12a11050945749.png', 'appwww.png', '0', '4');
INSERT INTO `gallery_images` VALUES ('54', '143394154415578362886b19391291907.png', '13662670961516f94d8ed7a9297190869.png', '0', '6');
INSERT INTO `gallery_images` VALUES ('39', '1403771280153abd990e45de409496393.png', 'autyd.png', '0', '6');
INSERT INTO `gallery_images` VALUES ('53', '14339414491557835c92649b037438738.jpg', '136560057215165693c9ec4a943971284.jpg', '0', '5');
INSERT INTO `gallery_images` VALUES ('48', '1406806299153da291bb1b09958477581.jpg', 'logo.jpg', '0', '2');
INSERT INTO `gallery_images` VALUES ('52', '14339414471557835c79bb4d472187801.png', '13662670961516f94d8ed7a9297190869.png', '0', '4');
INSERT INTO `gallery_images` VALUES ('55', '1433941545155783629de912216269953.jpg', '136560057215165693c9ec4a943971284.jpg', '0', '7');
INSERT INTO `images` VALUES ('9', '1403077593153a143d9a6304108755628.jpg', 'presta123.jpg', '0', 'SKLEPY INTERNETOWE Oparte na PrestaShop');
INSERT INTO `images` VALUES ('10', '1403077846153a144d68751d077247374.jpg', 'promocja.jpg', '0', 'Promocja');
INSERT INTO `images` VALUES ('11', '14356458931559237c5ed21e663486243.jpg', '104547f05f35feb7L492.jpg', '0', 'aaaa');
INSERT INTO `images` VALUES ('12', '1435651380155924d341788c288814850.jpg', 'vscandual2.jpg', '0', '3232');
INSERT INTO `images` VALUES ('13', '1435651389155924d3dc8277152214947.jpg', 'vscandual3.jpg', '0', '3232');
INSERT INTO `images` VALUES ('14', '1435651401155924d49e1544276812399.jpg', 'vscanduala.jpg', '0', '3232');
INSERT INTO `images` VALUES ('19', '1435655072155925ba07bc53864064994.jpg', 'vscandual2.jpg', '0', '');
INSERT INTO `images` VALUES ('18', '1435654971155925b3b794aa800454874.jpg', 'vscandual2.jpg', '0', '');
INSERT INTO `images` VALUES ('20', '1435655378155925cd25f79b609344426.jpg', 'vscandual3.jpg', '0', '');
INSERT INTO `images` VALUES ('21', '1435655389155925cdd1cea8474540984.jpg', 'vscanduala.jpg', '0', '');
INSERT INTO `images` VALUES ('22', '1435655392155925ce0c60d2934912948.jpg', 'vscandual2.jpg', '0', '');
INSERT INTO `images` VALUES ('23', '1435655475155925d33e80df120316728.jpg', '101547f1ad53f3c7475.JPG', '0', '');
INSERT INTO `images` VALUES ('24', '1435655477155925d35b2052607831521.jpg', '50proc.jpg', '0', '');
INSERT INTO `images` VALUES ('25', '1435655479155925d37eec07982980911.jpg', '10450ec1303ec3adDSC01747.JPG', '0', '');
INSERT INTO `images` VALUES ('26', '1435655595155925daba6839187433232.jpg', 'vscandual2.jpg', '0', '');
INSERT INTO `images` VALUES ('31', '1435655772155925e5cd0862376053992.jpg', 'vscandual3.jpg', '0', '');
INSERT INTO `images` VALUES ('32', '1435655784155925e68d3740819567746.jpg', 'vscanduala.jpg', '0', '');
INSERT INTO `images` VALUES ('30', '1435655764155925e5436356043196401.jpg', 'vscandual2.jpg', '0', '');
INSERT INTO `languages` VALUES ('1', 'pl_PL', 'polish', 'pl.png');
INSERT INTO `medias` VALUES ('1', '1-lktextpage.jpg', '1');
INSERT INTO `medias` VALUES ('2', '2-lkcontact.jpg', '1');
INSERT INTO `medias` VALUES ('4', '4-2014-06-05131809.jpg', '1');
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
INSERT INTO `news` VALUES ('9', 'Sklepy internetowe oparte na PrestaShop', 'pl_PL', '<h3>PROFESJONALNE<br />SKLEPY INTERNETOWE</h3>\r\n<p>Oparte na&nbsp;<strong>PrestaShop</strong></p>', '<h2>DLACZEGO WARTO?<br /><br /></h2>\r\n<ul>\r\n<li>Atrakcyjna i przejrzysta szata graficzna do wyboru</li>\r\n<li>Płatności online</li>\r\n<li>Wygodny i łatwy w obsłudze panel administracyjny</li>\r\n<li>Kompleksowe zarządzanie produktem i magazynem</li>\r\n</ul>\r\n<ul>\r\n<li>Wersja mobilna</li>\r\n<li>Możliwość&nbsp;zakładania&nbsp;kont&nbsp;pracownikom i nadawania uprawnień</li>\r\n<li>Własny adres www i poczta e-mail</li>\r\n<li>Atrakcyjna cena od 2499 zł</li>\r\n<li>Domena i hosting&nbsp;<strong>gratis!</strong></li>\r\n</ul>', '1403077591', null, '1', '0', '0', null, '', '', '', '', '', '');
INSERT INTO `news` VALUES ('10', 'Promocja', 'pl_PL', '<h3>PROFESJONALNE<br />STRONY<br />INTERNETOWE&nbsp;</h3>\r\n<p>W cenie&nbsp;<strong>699 zł</strong>.</p>', '<h2>CO OFERUJEMY</h2>\r\n<ul>\r\n<li>Prosty w obsłudze panel do samodzielnej edycji treści strony</li>\r\n<li>Wersja mobilna strony</li>\r\n<li>Możliwość dodania nieograniczonej ilości zdjęć</li>\r\n</ul>\r\n<ul>\r\n<li>Własny adres www i poczta e-mail</li>\r\n<li>Darmowa domena i hosting</li>\r\n<li>Brak ukrytych opłat</li>\r\n<li>Czytelna mapa dojazdu na stronie.</li>\r\n</ul>', '1403077844', '1403782587', '1', '0', '0', null, '', '', '', '', '', '');
INSERT INTO `news` VALUES ('12', 'Aktualność testowa', 'pl_PL', '<p>asdasdas</p>', '<p>asasadsdasdas</p>', '1406800418', null, '1', '0', '0', null, 'aasddsasd', '', '', '', '', '');
INSERT INTO `news` VALUES ('15', 'aaaaa', 'pl_PL', '<p>aaa</p>', '<p>aaa</p>', '1435645893', null, '1', '0', '0', null, '', '', '', '', '', '');
INSERT INTO `news` VALUES ('16', '333', 'pl_PL', '', '<p>333</p>', '1435648362', null, '1', '0', '0', null, '', '', '', '', '', '');
INSERT INTO `news` VALUES ('17', 'a333', 'pl_PL', '', '<p>333</p>', '1435648492', null, '1', '0', '0', null, '', '', '', '', '', '');
INSERT INTO `news` VALUES ('18', 'a333', 'pl_PL', '', '<p>333</p>', '1435648966', null, '1', '0', '0', null, '', '', '', '', '', '');
INSERT INTO `news` VALUES ('19', '323232', 'pl_PL', '<p>321312</p>', '<p>123123</p>', '1435648994', null, '1', '0', '0', null, '', '', '', '', '', '');
INSERT INTO `news` VALUES ('20', '323232', 'pl_PL', '<p>321312</p>', '<p>123123</p>', '1435649149', null, '1', '0', '0', null, '', '', '', '', '', '');
INSERT INTO `news` VALUES ('21', '323232', 'pl_PL', '<p>321312</p>', '<p>123123</p>', '1435649355', null, '1', '0', '0', null, '', '', '', '', '', '');
INSERT INTO `news` VALUES ('22', '323232', 'pl_PL', '<p>321312</p>', '<p>123123</p>', '1435650866', null, '1', '0', '0', null, '', '', '', '', '', '');
INSERT INTO `news` VALUES ('23', '323232', 'pl_PL', '<p>321312</p>', '<p>123123</p>', '1435650924', null, '1', '0', '0', null, '', '', '', '', '', '');
INSERT INTO `news` VALUES ('24', '323232', 'pl_PL', '<p>321312</p>', '<p>123123</p>', '1435650944', null, '1', '0', '0', null, '', '', '', '', '', '');
INSERT INTO `news` VALUES ('25', '323232', 'pl_PL', '<p>321312</p>', '<p>123123</p>', '1435650979', null, '1', '0', '0', null, '', '', '', '', '', '');
INSERT INTO `news` VALUES ('26', '323232', 'pl_PL', '<p>321312</p>', '<p>123123</p>', '1435650987', null, '1', '0', '0', null, '', '', '', '', '', '');
INSERT INTO `news` VALUES ('27', '323232', 'pl_PL', '<p>321312</p>', '<p>123123</p>', '1435651199', null, '1', '0', '0', null, '', '', '', '', '', '');
INSERT INTO `news` VALUES ('28', '323232', 'pl_PL', '<p>321312</p>', '<p>123123</p>', '1435651270', null, '1', '0', '0', null, '', '', '', '', '', '');
INSERT INTO `news` VALUES ('29', '323232', 'pl_PL', '<p>321312</p>', '<p>123123</p>', '1435651313', null, '1', '0', '0', null, '', '', '', '', '', '');
INSERT INTO `news` VALUES ('30', '323232', 'pl_PL', '<p>321312</p>', '<p>123123</p>', '1435651330', null, '1', '0', '0', null, '', '', '', '', '', '');
INSERT INTO `news` VALUES ('31', '323232', 'pl_PL', '<p>321312</p>', '<p>123123</p>', '1435651379', null, '1', '0', '0', null, '', '', '', '', '', '');
INSERT INTO `news` VALUES ('32', '3 zdięcia', 'pl_PL', '', '<p>3</p>', '1435615200', '1435655763', '1', '0', '0', null, '', '', '', '', '', '');
INSERT INTO `news` VALUES ('33', '1fot2', 'pl_PL', '', '<p>aaaa</p>', '1435615200', '1435657903', '1', '0', '0', null, '', '', '', '', 'CYMES PREMIUM czarny bez.png', '14356579041559266b004636579570350.png');
INSERT INTO `news_categories` VALUES ('3', '0', 'Aktualności', '31', 'Y', '0', '1');
INSERT INTO `news_categories` VALUES ('4', '0', 'aa', '75', 'Y', '0', '1');
INSERT INTO `news_categories` VALUES ('5', '0', '222', '76', 'Y', '0', '1');
INSERT INTO `news_categories` VALUES ('6', '0', 'akt2', '77', 'Y', '0', '1');
INSERT INTO `news_categories` VALUES ('7', '0', 'aa2', '78', 'Y', '0', '1');
INSERT INTO `news_categories` VALUES ('8', '3', 'dasdas2', '79', 'Y', '0', '1');
INSERT INTO `news_comments` VALUES ('1', 'test', '1', 'testtt', '127.0.0.1');
INSERT INTO `news_images` VALUES ('9', '9', '9');
INSERT INTO `news_images` VALUES ('10', '10', '10');
INSERT INTO `news_images` VALUES ('15', '11', '11');
INSERT INTO `news_images` VALUES ('31', '12', '12');
INSERT INTO `news_images` VALUES ('31', '13', '13');
INSERT INTO `news_images` VALUES ('31', '14', '14');
INSERT INTO `news_images` VALUES ('32', '32', '23');
INSERT INTO `news_images` VALUES ('32', '31', '22');
INSERT INTO `news_images` VALUES ('32', '30', '21');
INSERT INTO `news_to_categories` VALUES ('21', '9', '3');
INSERT INTO `news_to_categories` VALUES ('26', '10', '3');
INSERT INTO `news_to_categories` VALUES ('27', '12', '3');
INSERT INTO `news_to_categories` VALUES ('37', '16', '3');
INSERT INTO `news_to_categories` VALUES ('36', '15', '8');
INSERT INTO `news_to_categories` VALUES ('38', '17', '3');
INSERT INTO `news_to_categories` VALUES ('39', '31', '5');
INSERT INTO `news_to_categories` VALUES ('46', '32', '4');
INSERT INTO `news_to_categories` VALUES ('50', '33', '3');
INSERT INTO `newsletter_email_groups` VALUES ('1', '1');
INSERT INTO `newsletter_email_groups` VALUES ('1', '2');
INSERT INTO `newsletter_email_groups` VALUES ('1', '3');
INSERT INTO `newsletter_email_groups` VALUES ('1', '4');
INSERT INTO `newsletter_email_groups` VALUES ('1', '6');
INSERT INTO `newsletter_email_groups` VALUES ('2', '6');
INSERT INTO `newsletter_emails` VALUES ('1', 'Tomasz Drgas', 'tomek@olicom.pl', '6ebkorl4', '1', 'Y');
INSERT INTO `newsletter_emails` VALUES ('4', '', 'kamil@olicom.pl', 'yp542ioy', '0', 'Y');
INSERT INTO `newsletter_emails` VALUES ('6', 'Hubert', 'hubert@olicom.pl', 'cjngkq60', '1', 'Y');
INSERT INTO `newsletter_groups` VALUES ('1', 'Grupa domyślna PL', 'Domyslna grupa dla osób zapisanych do newslettera z polskiej wersji językowej witryny.', '1', 'pl_PL');
INSERT INTO `newsletter_groups` VALUES ('2', 'Nowa grupa', 'Opis grupy\r\n', '0', 'pl_PL');
INSERT INTO `newsletters` VALUES ('1', 'pl_PL', 'Newsletter 1', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla tortor libero, dapibus in lobortis eget, sollicitudin vel quam. Phasellus neque nisl, posuere bibendum pretium eu, elementum a nunc. Phasellus varius fermentum consequat. Donec rutrum turpis at mi accumsan rhoncus. Curabitur aliquet arcu in eros pulvinar in pellentesque sapien volutpat. Donec id nibh id ligula mattis condimentum. In in eros eros, vel porttitor diam. Vestibulum ornare ornare dui sit amet rhoncus. Proin at porta diam. Morbi porta imperdiet metus, sit amet vestibulum leo luctus id. Aliquam posuere justo non felis facilisis vel vehicula purus aliquam. Cras mi neque, lobortis adipiscing laoreet quis, dapibus a mi. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Ut pellentesque, nisi vitae congue egestas, sem mi cursus odio, et consequat massa ligula ac dolor. Cras ultricies odio sit amet mi pulvinar sit amet pulvinar orci malesuada. Cras tellus eros, condimentum id hendrerit ac, aliquam a tellus. Nullam elementum placerat dictum. Duis sodales gravida eros, ac iaculis sem pulvinar ut. Cras mattis, leo varius dapibus varius, ipsum justo feugiat nibh, ut imperdiet est dolor ac nibh. Duis et consequat lectus.</p>\r\n<p>Nam ut placerat nibh. Morbi volutpat volutpat elit, ut aliquam odio ornare vel. Aliquam quis erat libero. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. In ac lacus faucibus mi facilisis tempus quis in eros. Praesent sodales fringilla nisl nec tincidunt. Vivamus tristique massa nunc, in eleifend tortor. Quisque adipiscing urna ac erat lacinia fringilla auctor dolor facilisis. Vivamus posuere eleifend ante non pulvinar. Suspendisse enim metus, dapibus ac porttitor vitae, iaculis id sem.</p>\r\n<p>Fusce sodales cursus consequat. Integer congue faucibus orci non tincidunt. In hac habitasse platea dictumst. Sed viverra lacus sit amet nisl imperdiet eget auctor mi lacinia. Quisque odio felis, porta non fringilla eget, sodales ac neque. Etiam tincidunt volutpat libero vel vehicula. Morbi eget leo id orci porttitor rutrum. Sed sollicitudin, elit a posuere tempor, risus est aliquet quam, sit amet molestie massa lorem vel mauris. Cras pulvinar malesuada iaculis. Donec aliquet lacus vel nunc gravida consequat. In in metus dui. Ut enim sapien, lobortis id sagittis eu, viverra ac purus.</p>', '1311941964', '1311942063', '60000', '20');
INSERT INTO `newsletters` VALUES ('2', 'pl_PL', 'TEST', '<p>Lorem ipsum....</p>', '1384560957', '1403783056', '60000', '20');
INSERT INTO `newsletters_newsletter_groups` VALUES ('1', '1');
INSERT INTO `newsletters_newsletter_groups` VALUES ('2', '1');
INSERT INTO `page_content` VALUES ('16', 'About Us', '<p>Under construction</p>', '27', 'Y');
INSERT INTO `page_content` VALUES ('17', 'Über uns', '<p><span id=\"result_box\" class=\"short_text\" lang=\"de\"><span class=\"hps\">im Bau</span></span></p>', '28', 'Y');
INSERT INTO `page_content` VALUES ('34', 'strona2', '', '74', 'Y');
INSERT INTO `pages` VALUES ('1', 'Home', 'home', 'pl_PL', '0', '1311939206', '1440576078', 'Y', '', '', null, null, null, 'Home', '100', '0', '1', 'cms', '0', null);
INSERT INTO `pages` VALUES ('20', 'Home', '', 'en_US', '0', '1389873515', '1389873526', 'Y', '', '', null, null, null, '', '100', '1', '1', 'shop', '0', null);
INSERT INTO `pages` VALUES ('21', 'About Us', 'about-us', 'en_US', '0', '1389873612', '1389873673', 'Y', '', '', null, null, null, '', '0', '1', '0', 'cms', '0', null);
INSERT INTO `pages` VALUES ('22', 'Haus', 'haus', 'de_DE', '0', '1389873820', '1389873836', 'Y', '', '', null, null, null, '', '100', '1', '1', 'shop', '0', null);
INSERT INTO `pages` VALUES ('23', 'Über uns', 'ber-uns', 'de_DE', '0', '1389873896', '1389873942', 'Y', '', '', null, null, null, '', '0', '1', '0', 'cms', '0', null);
INSERT INTO `pages` VALUES ('24', 'Offer', 'offer', 'en_US', '0', '1389873974', '1389873990', 'Y', '', '', null, null, null, '', '80', '1', '0', 'shop', '0', null);
INSERT INTO `pages` VALUES ('25', 'Angebot', 'angebot', 'de_DE', '0', '1389874010', '1389874020', 'Y', '', '', null, null, null, '', '80', '1', '0', 'shop', '0', null);
INSERT INTO `pages` VALUES ('46', 'strona2', 'strona2', 'pl_PL', '0', '1435584918', '1435927129', 'Y', '', '', null, null, null, 'strona z zdjeciem', '0', '1', '0', 'link', '0', 'calapolskaczytadzieciom.jpg');
INSERT INTO `pages` VALUES ('47', 'Oferta', 'oferta', 'pl_PL', '0', '1436532910', '0', 'Y', '', '', null, null, null, '', '0', '1', '0', 'cms', '0', null);
INSERT INTO `pages_elements` VALUES ('21', '27', '37', null, null, null);
INSERT INTO `pages_elements` VALUES ('1', '80', '134', null, null, null);
INSERT INTO `pages_elements` VALUES ('46', '74', '123', null, null, null);
INSERT INTO `pages_elements` VALUES ('23', '28', '38', null, null, null);
INSERT INTO `pages_elements` VALUES ('1', '31', '129', null, null, null);
INSERT INTO `pages_elements` VALUES ('1', '76', '125', null, null, null);
INSERT INTO `pages_elements` VALUES ('1', '79', '128', null, null, null);
INSERT INTO `pages_elements` VALUES ('1', '77', '126', null, null, null);
INSERT INTO `pages_elements` VALUES ('1', '78', '127', null, null, null);
INSERT INTO `pages_elements` VALUES ('1', '60', '95', null, null, null);
INSERT INTO `pages_elements` VALUES ('1', '75', '124', null, null, null);
INSERT INTO `polls_answers` VALUES ('1', '1', 'pl_PL', 'Tak', '3');
INSERT INTO `polls_answers` VALUES ('2', '1', 'pl_PL', 'Nie', '0');
INSERT INTO `polls_answers` VALUES ('3', '1', 'pl_PL', 'Nie wiem', '1');
INSERT INTO `polls_answers` VALUES ('4', '2', 'pl_PL', 'asd', '0');
INSERT INTO `polls_answers` VALUES ('5', '2', 'pl_PL', 'asd', '0');
INSERT INTO `polls_answers` VALUES ('12', '4', 'pl_PL', 'fadsads', '0');
INSERT INTO `polls_answers` VALUES ('11', '4', 'pl_PL', 'sfasdasd', '0');
INSERT INTO `polls_answers` VALUES ('9', '5', 'pl_PL', 'asdasd', '0');
INSERT INTO `polls_categories` VALUES ('4', 'asdadsdas', '58');
INSERT INTO `polls_categories` VALUES ('5', 'fghgfhgf', '60');
INSERT INTO `polls_questions` VALUES ('1', 'Czy podoba Ci się ta strona?', 'pl_PL', '1311943290', null, null);
INSERT INTO `polls_questions` VALUES ('2', 'asd', 'pl_PL', '1403690114', null, null);
INSERT INTO `polls_questions` VALUES ('4', 'sffasdasd', 'pl_PL', '1403701698', '0', '0');
INSERT INTO `polls_questions` VALUES ('5', 'asdasd', 'pl_PL', '1403701760', null, null);
INSERT INTO `polls_questions_to_categories` VALUES ('1', '1', '1', 'Y');
INSERT INTO `polls_questions_to_categories` VALUES ('2', '2', '2', 'Y');
INSERT INTO `polls_questions_to_categories` VALUES ('4', '4', '4', 'Y');
INSERT INTO `polls_questions_to_categories` VALUES ('5', '4', '5', 'N');
INSERT INTO `polls_voters` VALUES ('1', '1', '127.0.0.1', '');
INSERT INTO `polls_voters` VALUES ('1', '1', '192.168.16.78', '');
INSERT INTO `polls_voters` VALUES ('1', '3', '192.168.16.77', '');
INSERT INTO `polls_voters` VALUES ('1', '1', '::1', '');
INSERT INTO `shop_attributes` VALUES ('7', '0', 'Y');
INSERT INTO `shop_attributes` VALUES ('4', '0', 'Y');
INSERT INTO `shop_attributes` VALUES ('8', '0', 'N');
INSERT INTO `shop_attributes_description` VALUES ('7', 'Rozmiar', 'pl_PL');
INSERT INTO `shop_attributes_description` VALUES ('4', 'Kolor', 'pl_PL');
INSERT INTO `shop_attributes_description` VALUES ('8', 'test', 'pl_PL');
INSERT INTO `shop_attributes_values` VALUES ('10', '3', '0', 'N', 'Y');
INSERT INTO `shop_attributes_values` VALUES ('11', '3', '0', 'N', 'Y');
INSERT INTO `shop_attributes_values` VALUES ('12', '3', '0', 'N', 'Y');
INSERT INTO `shop_attributes_values` VALUES ('13', '3', '0', 'N', 'Y');
INSERT INTO `shop_attributes_values` VALUES ('14', '3', '0', 'N', 'Y');
INSERT INTO `shop_attributes_values` VALUES ('15', '3', '0', 'N', 'Y');
INSERT INTO `shop_attributes_values` VALUES ('16', '3', '0', 'N', 'Y');
INSERT INTO `shop_attributes_values` VALUES ('17', '3', '0', 'N', 'Y');
INSERT INTO `shop_attributes_values` VALUES ('18', '3', '0', 'N', 'N');
INSERT INTO `shop_attributes_values` VALUES ('19', '3', '0', 'N', 'N');
INSERT INTO `shop_attributes_values` VALUES ('20', '3', '0', 'N', 'N');
INSERT INTO `shop_attributes_values` VALUES ('29', '5', '0', 'N', 'Y');
INSERT INTO `shop_attributes_values` VALUES ('30', '5', '0', 'N', 'Y');
INSERT INTO `shop_attributes_values` VALUES ('26', '4', '0', 'Y', 'Y');
INSERT INTO `shop_attributes_values` VALUES ('25', '4', '0', 'N', 'Y');
INSERT INTO `shop_attributes_values` VALUES ('31', '5', '0', 'N', 'Y');
INSERT INTO `shop_attributes_values` VALUES ('32', '6', '0', 'Y', 'Y');
INSERT INTO `shop_attributes_values` VALUES ('33', '6', '0', 'N', 'Y');
INSERT INTO `shop_attributes_values` VALUES ('38', '7', '0', 'N', 'Y');
INSERT INTO `shop_attributes_values` VALUES ('35', '6', '0', 'N', 'Y');
INSERT INTO `shop_attributes_values` VALUES ('36', '6', '0', 'N', 'Y');
INSERT INTO `shop_attributes_values` VALUES ('37', '6', '0', 'N', 'Y');
INSERT INTO `shop_attributes_values` VALUES ('39', '7', '0', 'N', 'Y');
INSERT INTO `shop_attributes_values` VALUES ('40', '7', '0', 'N', 'Y');
INSERT INTO `shop_attributes_values` VALUES ('41', '7', '0', 'N', 'Y');
INSERT INTO `shop_attributes_values` VALUES ('42', '8', '0', 'N', 'Y');
INSERT INTO `shop_attributes_values` VALUES ('43', '8', '0', 'N', 'Y');
INSERT INTO `shop_attributes_values` VALUES ('44', '8', '0', 'N', 'Y');
INSERT INTO `shop_attributes_values_additional` VALUES ('11', '0313FF', '');
INSERT INTO `shop_attributes_values_additional` VALUES ('10', 'FF0A0A', '');
INSERT INTO `shop_attributes_values_additional` VALUES ('12', '000000', '');
INSERT INTO `shop_attributes_values_additional` VALUES ('26', '33FF47', '');
INSERT INTO `shop_attributes_values_additional` VALUES ('25', 'FF14D8', '');
INSERT INTO `shop_attributes_values_additional` VALUES ('37', 'FFFFFF', '');
INSERT INTO `shop_attributes_values_additional` VALUES ('32', 'FFFFFF', '');
INSERT INTO `shop_attributes_values_description` VALUES ('10', 'Czerwony', 'pl_PL');
INSERT INTO `shop_attributes_values_description` VALUES ('11', 'niebieski', 'pl_PL');
INSERT INTO `shop_attributes_values_description` VALUES ('12', 'Czarnuszy', 'pl_PL');
INSERT INTO `shop_attributes_values_description` VALUES ('20', 'Zielony', 'pl_PL');
INSERT INTO `shop_attributes_values_description` VALUES ('26', 'Słomki niebieskie', 'pl_PL');
INSERT INTO `shop_attributes_values_description` VALUES ('25', 'Różowy', 'pl_PL');
INSERT INTO `shop_attributes_values_description` VALUES ('27', 'Niga black', 'pl_PL');
INSERT INTO `shop_attributes_values_description` VALUES ('28', 'Snowflake white', 'pl_PL');
INSERT INTO `shop_attributes_values_description` VALUES ('10', 'Indian red', 'en_US');
INSERT INTO `shop_attributes_values_description` VALUES ('29', 'S', 'pl_PL');
INSERT INTO `shop_attributes_values_description` VALUES ('30', 'L', 'pl_PL');
INSERT INTO `shop_attributes_values_description` VALUES ('31', 'XL', 'pl_PL');
INSERT INTO `shop_attributes_values_description` VALUES ('32', '1', 'pl_PL');
INSERT INTO `shop_attributes_values_description` VALUES ('33', '2', 'pl_PL');
INSERT INTO `shop_attributes_values_description` VALUES ('38', 'XL', 'pl_PL');
INSERT INTO `shop_attributes_values_description` VALUES ('35', '4', 'pl_PL');
INSERT INTO `shop_attributes_values_description` VALUES ('36', '5', 'pl_PL');
INSERT INTO `shop_attributes_values_description` VALUES ('37', 'XL', 'pl_PL');
INSERT INTO `shop_attributes_values_description` VALUES ('39', 'L', 'pl_PL');
INSERT INTO `shop_attributes_values_description` VALUES ('40', 'M', 'pl_PL');
INSERT INTO `shop_attributes_values_description` VALUES ('41', 'S', 'pl_PL');
INSERT INTO `shop_attributes_values_description` VALUES ('42', 'a', 'pl_PL');
INSERT INTO `shop_attributes_values_description` VALUES ('43', 'b', 'pl_PL');
INSERT INTO `shop_attributes_values_description` VALUES ('44', 'c', 'pl_PL');
INSERT INTO `shop_configuration` VALUES ('1', 'product_stock', '0', 'Stany magazynowe', 'Ogólne stany magazynowe dla produktu', '', 'integer');
INSERT INTO `shop_configuration` VALUES ('2', 'rebates_codes', '1', 'Kody rabatowe', 'Kody rabatowe', '', 'integer');
INSERT INTO `shop_currencies` VALUES ('14', 'Frank szwajcarski', 'CHF', null, '3.4000', 'Y', 'N');
INSERT INTO `shop_currencies` VALUES ('1', 'Polski złoty', 'zł', '1', '1.0000', 'Y', 'Y');
INSERT INTO `shop_currencies` VALUES ('15', 'Euro', 'EUR', null, '4.1000', 'N', 'N');
INSERT INTO `shop_customers` VALUES ('29', null, '*1F2D53ED0D19B9DADF2B8EE3E99C7A0B3BBDFFE6', 'hubert@olicom.pl', 'test', 'testt', '', '', 'Poznań', '60-160', 'test 5', '', 'Polska', '', '555666777', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '10', 'f81e9a851ace2154ebfe015200eaba4b', 'N', null, 'Y', '1', '1', '0');
INSERT INTO `shop_customers` VALUES ('36', null, '*E19D4321AFDAB58F6358C8EE71B76679FF67E675', 'pawel@olicom.pl', 'Paweł', 'Mor', null, null, 'Posen', '12-365', 'testowa 3', null, '', null, '123456798', null, null, '', '', '', null, null, null, null, null, null, null, null, null, null, null, '', '', '', null, null, null, null, null, null, null, null, null, null, null, '0', '9689b56028a4b4ebb3915bf889bf306e', 'Y', null, 'Y', '1', '1', '0');
INSERT INTO `shop_customers` VALUES ('34', null, '*AA1420F182E88B9E5F874F6FBE7459291E8F4601', 'hubert@olicom.pl', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '20', '8699e3e8200ef1edac7db009206d5515', 'Y', null, 'Y', '1', '1', '0');
INSERT INTO `shop_customers` VALUES ('35', null, '*FFA6AC286C830AB2E26889515200CB5CF549F373', 'artur@olicom.org.pl', 'Artur', 'Oli', null, null, '', '', '', null, '', null, '', null, null, '', '', '', null, null, null, null, null, null, null, null, null, null, null, '', '', '', null, null, null, null, null, null, null, null, null, null, null, '0', '9c3ab4b1ca72cf94231c6634290392d4', 'Y', null, 'Y', '1', '1', '0');
INSERT INTO `shop_customers` VALUES ('32', null, '*AA1420F182E88B9E5F874F6FBE7459291E8F4601', 'hubert@olicom.org.pl', 'Hubert', 'kkkk', '', '', 'test', '44-444', 'Kmicica 1', '', 'pl', '', '333444555', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0', 'a197f8e0348b7dcd3b535abffab3f9bc', 'N', null, 'Y', '1', '1', '0');
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
INSERT INTO `shop_orders` VALUES ('26', '1/2013/12/16', '1', '2013', '12', '16', '0', '1387200954', '1', '0', '0.00', '', '99.00', '5', '25.00', '0.00', '124.00', 'N', 'N', null, 'N', 'N', '::1', null, '', 'pawel@olicom.pl', 'c80f1af2556f2ab93dd4d92d19f6a56b', 'N', '', 'pl_PL', '', '', null, 'PLN', '1.0000', null, null, null, null);
INSERT INTO `shop_orders` VALUES ('27', '2/2013/12/16', '2', '2013', '12', '16', '0', '1387201244', '1', '0', '0.00', '', '99.00', '5', '25.00', '0.00', '124.00', 'N', 'N', null, 'N', 'N', '::1', null, '', 'pawel@olicom.pl', 'b84aad097718321b8760a91a697c8b99', 'N', '27|1387201479', 'pl_PL', '', '', null, 'PLN', '1.0000', null, null, null, null);
INSERT INTO `shop_orders` VALUES ('28', '1/2013/12/23', '1', '2013', '12', '23', '28', '1387794300', '1', '0', '0.00', '', '66.00', '5', '25.00', '0.00', '91.00', 'N', 'N', null, 'N', 'N', '::1', null, 'test', 'pawel@olicom.org.pl', 'e941747d4edbf58f9e9bff0b5dcd0fb2', 'N', '', 'pl_PL', '', '', null, 'PLN', '1.0000', null, null, null, null);
INSERT INTO `shop_orders` VALUES ('29', '2/2013/12/23', '2', '2013', '12', '23', '0', '1387794486', '1', '0', '0.00', '', '66.00', '5', '25.00', '0.00', '91.00', 'N', 'N', null, 'N', 'N', '::1', null, 'test', 'pawel@olicom.org.pl', '025ea6a4239f19598df93d9f63612286', 'N', '', 'pl_PL', '', '', null, 'PLN', '1.0000', null, null, null, null);
INSERT INTO `shop_orders` VALUES ('30', '3/2013/12/23', '3', '2013', '12', '23', '0', '1387794569', '1', '0', '0.00', '', '66.00', '5', '25.00', '0.00', '91.00', 'N', 'N', null, 'N', 'N', '::1', null, 'test', 'pawel@olicom.org.pl', '504a9bde2a9d401e8e10e938cd53a49e', 'N', '', 'pl_PL', '', '', null, 'PLN', '1.0000', null, null, null, null);
INSERT INTO `shop_orders` VALUES ('31', '4/2013/12/23', '4', '2013', '12', '23', '0', '1387794636', '1', '0', '0.00', '', '66.00', '5', '25.00', '0.00', '91.00', 'N', 'N', null, 'N', 'N', '::1', null, 'test', 'pawel@olicom.org.pl', '249544f7cd747ee8818d8aef2cfb27dc', 'N', '', 'pl_PL', '', '', null, 'PLN', '1.0000', null, null, null, null);
INSERT INTO `shop_orders` VALUES ('32', '5/2013/12/23', '5', '2013', '12', '23', '0', '1387794772', '1', '0', '0.00', '', '66.00', '5', '25.00', '0.00', '91.00', 'N', 'N', null, 'N', 'N', '::1', null, 'test', 'pawel@olicom.org.pl', '87fcb89534e4cd878286eae200d1c61b', 'N', '', 'pl_PL', '', '', null, 'PLN', '1.0000', null, null, null, null);
INSERT INTO `shop_orders` VALUES ('33', '6/2013/12/23', '6', '2013', '12', '23', '0', '1387794784', '1', '0', '0.00', '', '66.00', '5', '25.00', '0.00', '91.00', 'N', 'N', null, 'N', 'N', '::1', null, 'test', 'pawel@olicom.org.pl', 'e0995a785029b339f413465e15d02abe', 'N', '', 'pl_PL', '', '', null, 'PLN', '1.0000', null, null, null, null);
INSERT INTO `shop_orders` VALUES ('34', '7/2013/12/23', '7', '2013', '12', '23', '0', '1387794924', '1', '0', '0.00', '', '66.00', '5', '25.00', '0.00', '91.00', 'N', 'N', null, 'N', 'N', '::1', null, 'test', 'pawel@olicom.org.pl', 'ed75c8d681aa3cc529314ed28df2ae06', 'N', '', 'pl_PL', '', '', null, 'PLN', '1.0000', null, null, null, null);
INSERT INTO `shop_orders` VALUES ('35', '8/2013/12/23', '8', '2013', '12', '23', '0', '1387794957', '1', '0', '0.00', '', '66.00', '5', '25.00', '0.00', '91.00', 'N', 'N', null, 'N', 'N', '::1', null, 'test', 'pawel@olicom.org.pl', '2ccefae3867c31cf96b990341a476250', 'N', '', 'pl_PL', '', '', null, 'PLN', '1.0000', null, null, null, null);
INSERT INTO `shop_orders` VALUES ('36', '9/2013/12/23', '9', '2013', '12', '23', '0', '1387794974', '1', '0', '0.00', '', '66.00', '5', '25.00', '0.00', '91.00', 'N', 'N', null, 'N', 'N', '::1', null, 'test', 'pawel@olicom.org.pl', '262da1cde03baa759ee81afd664315f4', 'N', '', 'pl_PL', '', '', null, 'PLN', '1.0000', null, null, null, null);
INSERT INTO `shop_orders` VALUES ('37', '10/2013/12/23', '10', '2013', '12', '23', '0', '1387795031', '1', '0', '0.00', '', '66.00', '5', '25.00', '0.00', '91.00', 'N', 'N', null, 'N', 'N', '::1', null, 'test', 'pawel@olicom.org.pl', 'bdf80c55f9ed3e43eedaa24684f20c3d', 'N', '', 'pl_PL', '', '', null, 'PLN', '1.0000', null, null, null, null);
INSERT INTO `shop_orders` VALUES ('38', '11/2013/12/23', '11', '2013', '12', '23', '0', '1387795060', '1', '0', '0.00', '', '66.00', '5', '25.00', '0.00', '91.00', 'N', 'N', null, 'N', 'N', '::1', null, 'test', 'pawel@olicom.org.pl', 'b7193ec402c12ca1e95cf0522f824f4d', 'N', '', 'pl_PL', '', '', null, 'PLN', '1.0000', null, null, null, null);
INSERT INTO `shop_orders` VALUES ('39', '12/2013/12/23', '12', '2013', '12', '23', '0', '1387795088', '1', '0', '0.00', '', '99.00', '6', '7.00', '0.00', '106.00', 'N', 'N', null, 'N', 'N', '::1', null, '', 'pawel@olicom.org.pl', '1f13fc08b66428d90c10e8c3204305d1', 'N', '', 'pl_PL', '', '', null, 'PLN', '1.0000', null, null, null, null);
INSERT INTO `shop_orders` VALUES ('40', '13/2013/12/23', '13', '2013', '12', '23', '0', '1387795158', '1', '0', '0.00', '', '99.00', '6', '7.00', '0.00', '106.00', 'N', 'N', null, 'N', 'N', '::1', null, '', 'pawel@olicom.org.pl', '4337098eace64659124f12fdddc36b9e', 'N', '', 'pl_PL', '', '', null, 'PLN', '1.0000', null, null, null, null);
INSERT INTO `shop_orders` VALUES ('41', '14/2013/12/23', '14', '2013', '12', '23', '0', '1387795288', '1', '0', '0.00', '', '99.00', '6', '7.00', '0.00', '106.00', 'N', 'N', null, 'N', 'N', '::1', null, '', 'pawel@olicom.pl', 'aabe05316268a688173c3e5c016c598c', 'N', '', 'pl_PL', '', '', null, 'PLN', '1.0000', null, null, null, null);
INSERT INTO `shop_orders` VALUES ('42', '15/2013/12/23', '15', '2013', '12', '23', '0', '1387795427', '1', '0', '0.00', '', '99.00', '6', '7.00', '0.00', '106.00', 'N', 'N', null, 'N', 'N', '::1', null, '', 'pawel@olicom.pl', '2d95e8b57a1deeb63d9aca4434a58e5e', 'N', '42|1387799541', 'pl_PL', '', '', null, 'PLN', '1.0000', null, null, null, null);
INSERT INTO `shop_orders` VALUES ('43', '1/2014/01/03', '1', '2014', '1', '3', '0', '1388749967', '1', '0', '0.00', '', '120.00', '6', '7.00', '0.00', '127.00', 'N', 'N', null, 'N', 'N', '::1', null, '', 'pawel@olicom.pl', '746a537e490412459386f09ffb8cfcad', 'N', '', 'pl_PL', '', '', null, 'PLN', '1.0000', null, null, null, null);
INSERT INTO `shop_orders` VALUES ('44', '2/2014/01/03', '2', '2014', '1', '3', '0', '1388750139', '1', '0', '0.00', '', '120.00', '6', '7.00', '0.00', '127.00', 'N', 'N', null, 'N', 'N', '::1', null, '', 'pawel@olicom.pl', '5cf12c423ec8ec26531374ac067f11f2', 'N', '44|1388750149', 'pl_PL', '', '', null, 'PLN', '1.0000', null, null, null, null);
INSERT INTO `shop_orders` VALUES ('45', '1/2014/01/07', '1', '2014', '1', '7', '0', '1389101062', '1', '0', '0.00', '', '600.00', '6', '7.00', '0.00', '607.00', 'N', 'N', null, 'N', 'N', '::1', null, '', 'pawel@olicom.org.pl', 'dd954ba123c9d1658cace8df98b71163', 'N', '45|1389101078', 'pl_PL', '', '', null, 'PLN', '1.0000', null, null, null, null);
INSERT INTO `shop_orders` VALUES ('46', '1/2014/01/08', '1', '2014', '1', '8', '27', '1389174835', '1', '0', '0.00', '', '144.00', '6', '7.00', '0.00', '151.00', 'N', 'N', null, 'N', 'N', '::1', null, '', 'pawel@olicom.org.pl', '3d9193c6c3a9214efb273ecc6ef17744', 'N', '46|1389174848', 'pl_PL', '', '', null, 'PLN', '1.0000', null, null, null, null);
INSERT INTO `shop_orders` VALUES ('47', '2/2014/01/08', '2', '2014', '1', '8', '27', '1389176386', '1', '0', '0.00', '', '33.00', '6', '7.00', '0.00', '40.00', 'N', 'N', null, 'N', 'N', '::1', null, '', 'pawel@olicom.org.pl', 'e5d798de863bac20d2ab0a9d28ad03c7', 'N', '47|1389178249', 'pl_PL', '', '', null, 'PLN', '1.0000', null, null, null, null);
INSERT INTO `shop_orders` VALUES ('48', '1/2014/01/20', '1', '2014', '1', '20', '0', '1390223248', '1', '0', '0.00', '', '10.00', '6', '7.00', '0.00', '17.00', 'N', 'N', null, 'N', 'N', '::1', null, 'eee tam', 'pawel@olicom.pl', '596a5dd51d147e4cb5780ea9bcfb392e', 'N', '48|1390224001', 'pl_PL', '', '', null, 'PLN', '1.0000', null, null, null, null);
INSERT INTO `shop_orders` VALUES ('49', '2/2014/01/20', '2', '2014', '1', '20', '0', '1390224262', '1', '0', '0.00', '', '10.00', '7', '15.00', '0.00', '25.00', 'N', 'N', null, 'N', 'N', '::1', null, 'testtesttest', 'pawel@olicom.pl', '4766af11e31eef87b0471324c74354c7', 'N', '49|1390224413', 'en_US', '', '', null, 'PLN', '1.0000', null, null, null, null);
INSERT INTO `shop_orders` VALUES ('50', '1/2014/01/23', '1', '2014', '1', '23', '0', '1390476647', '1', '0', '0.00', '', '20.00', '5', '25.00', '0.00', '45.00', 'N', 'N', null, 'N', 'N', '::1', null, '', 'pawel@olicom.org.pl', '8638c0bc61a90220dc8097fbae500182', 'N', '50|1390477106', 'pl_PL', '', '', null, 'PLN', '1.0000', null, null, null, null);
INSERT INTO `shop_orders` VALUES ('51', '2/2014/01/23', '2', '2014', '1', '23', '0', '1390478017', '1', '0', '0.00', '', '10.00', '7', '15.00', '0.00', '25.00', 'N', 'N', null, 'N', 'N', '::1', null, '', 'pawel@olicom.pl', '02dfe2e3e024698d9bcade4be4e6c9ea', 'N', '51|1390478025', 'en_US', '', '', null, 'EUR', '4.0000', null, null, null, null);
INSERT INTO `shop_orders` VALUES ('52', '3/2014/01/23', '3', '2014', '1', '23', '0', '1390479815', '1', '0', '0.00', '', '10.00', '6', '7.00', '0.00', '17.00', 'N', 'N', null, 'N', 'N', '::1', null, '', 'pawel@olicom.pl', '1d51838202c589c692c262f6940ef82f', 'N', '52|1390481086', 'pl_PL', '', '', null, 'EUR', '4.1669', null, null, null, null);
INSERT INTO `shop_orders` VALUES ('53', '1/2014/01/30', '1', '2014', '1', '30', '0', '1391083951', '1', '0', '0.00', '', '180.00', '6', '7.00', '0.00', '187.00', 'N', 'N', null, 'N', 'N', '::1', null, 'test', 'pawel@olicom.pl', '5bdae14dc9dade67b129e78eed82dc58', 'N', '53|1391096004', 'pl_PL', '', '', null, 'PLN', '1.0000', null, null, null, null);
INSERT INTO `shop_orders` VALUES ('54', '2/2014/01/30', '2', '2014', '1', '30', '31', '1391089670', '1', '0', '0.00', '', '330.00', '5', '25.00', '0.00', '355.00', 'N', 'N', null, 'N', 'N', '127.0.0.1', null, 'test', 'hubert@olicom.pl', '7fc62cd6873757fb571479c7160b31c4', 'N', '54|1391089677', 'pl_PL', '', '', null, 'PLN', '1.0000', null, null, null, null);
INSERT INTO `shop_orders` VALUES ('55', '1/2014/01/31', '1', '2014', '1', '31', '0', '1391174286', '1', '0', '0.00', '', '44.00', '5', '25.00', '0.00', '69.00', 'N', 'N', null, 'N', 'N', '::1', null, '', 'pawel@olicom.pl', '0a07e740445adfef0de5a6406483871b', 'N', '55|1391175194', 'pl_PL', '', '', null, 'PLN', '1.0000', null, null, null, null);
INSERT INTO `shop_orders` VALUES ('56', '2/2014/01/31', '2', '2014', '1', '31', '0', '1391176994', '1', '0', '0.00', '', '704.00', '5', '25.00', '0.00', '729.00', 'N', 'N', null, 'N', 'N', '::1', null, '', 'pawel@olicom.org.pl', '85b946e63d7e3933988eb8fb52d84ba2', 'N', '56|1391177007', 'pl_PL', '', '', null, 'PLN', '1.0000', null, null, null, null);
INSERT INTO `shop_orders` VALUES ('57', '1/2014/02/05', '1', '2014', '2', '5', '0', '1391605837', '1', '0', '0.00', '', '374.00', '6', '7.00', '0.00', '381.00', 'N', 'N', null, 'N', 'N', '127.0.0.1', null, 'uytut', 'hubert@olicom.pl', '72536650eea1e16492d3507744d5d0f6', 'N', '57|1391605843', 'pl_PL', '', '', null, 'PLN', '1.0000', null, null, null, null);
INSERT INTO `shop_orders` VALUES ('58', '1/2014/02/07', '1', '2014', '2', '7', '0', '1391761516', '1', '0', '0.00', '', '330.00', '5', '25.00', '0.00', '355.00', 'N', 'N', null, 'N', 'N', '127.0.0.1', null, 'test', 'hubert@olicom.org.pl', 'c8840d7dbad08152889802cc37375f41', 'N', '58|1391761522', 'pl_PL', '', '', null, 'zł', '1.0000', null, null, null, null);
INSERT INTO `shop_orders` VALUES ('59', '2/2014/02/07', '2', '2014', '2', '7', '31', '1391769910', '1', '0', '0.00', '', '55.00', '5', '25.00', '0.00', '80.00', 'N', 'N', null, 'N', 'N', '127.0.0.1', null, '', 'hubert@olicom.pl', '314b2dfa344bb8d51a985a10d9a4e20f', 'N', '59|1391769916', 'pl_PL', '', '', null, 'zł', '1.0000', null, null, null, null);
INSERT INTO `shop_orders` VALUES ('60', '1/2014/02/10', '1', '2014', '2', '10', '31', '1392029555', '1', '0', '0.00', '', '1760.00', '6', '7.00', '0.00', '1767.00', 'N', 'N', null, 'N', 'N', '127.0.0.1', null, 'jnjknjk', 'hubert@olicom.pl', 'dae9efbfb0d9437a1971f760020f7484', 'N', '60|1392029562', 'pl_PL', '', '', null, 'zł', '1.0000', null, null, null, null);
INSERT INTO `shop_orders` VALUES ('61', '2/2014/02/10', '2', '2014', '2', '10', '31', '1392033227', '1', '1', '0.00', '', '44.00', '5', '25.00', '0.00', '69.00', 'N', 'N', null, 'N', 'N', '127.0.0.1', null, 'test', 'hubert@olicom.pl', '6401fbb8d4dd86b3d9fee090495c3070', 'N', '61|1392033233', 'pl_PL', '', '', null, 'zł', '1.0000', null, null, null, null);
INSERT INTO `shop_orders` VALUES ('62', '3/2014/02/10', '3', '2014', '2', '10', '31', '1392034146', '1', '1', '0.00', '', '44.00', '5', '25.00', '0.00', '69.00', 'N', 'N', null, 'N', 'N', '127.0.0.1', null, 'fhn', 'hubert@olicom.pl', '45985b88974b9da1c5fcccb958373972', 'N', '62|1392041631', 'pl_PL', '', '', null, 'zł', '1.0000', null, null, null, null);
INSERT INTO `shop_orders` VALUES ('63', '4/2014/02/10', '4', '2014', '2', '10', '31', '1392037756', '1', '3', '0.00', '', '660.00', '6', '7.00', '0.00', '667.00', 'N', 'N', null, 'N', 'N', '127.0.0.1', null, 'bfg', 'hubert@olicom.pl', 'b7ac1de951edcbeb8d2714b2231e1bd7', 'N', '63|1392041682', 'pl_PL', '', '', null, 'zł', '1.0000', null, null, null, null);
INSERT INTO `shop_orders` VALUES ('64', '1/2014/02/11', '1', '2014', '2', '11', '0', '1392103933', '1', '1', '0.00', '', '44.00', '6', '7.00', '0.00', '51.00', 'N', 'N', null, 'N', 'N', '127.0.0.1', null, 'test', 'hubert@olicom.pl', 'aba8c096f0dc1066dc25350ebde12bba', 'N', '64|1392103939', 'pl_PL', '', '', null, 'zł', '1.0000', null, null, null, null);
INSERT INTO `shop_orders` VALUES ('65', '2/2014/02/11', '2', '2014', '2', '11', '0', '1392104532', '1', '2', '0.00', '', '44.00', '5', '25.00', '0.00', '69.00', 'N', 'N', null, 'N', 'N', '127.0.0.1', null, 'test', 'asd-zyg@wp.pl', '595eb590ea9ac0ba41d92b5617589653', 'N', '65|1392104537', 'pl_PL', '', '', null, 'zł', '1.0000', null, null, null, null);
INSERT INTO `shop_orders` VALUES ('66', '3/2014/02/11', '3', '2014', '2', '11', '0', '1392104928', '1', '1', '0.00', '', '44.00', '6', '7.00', '0.00', '51.00', 'N', 'N', null, 'N', 'N', '127.0.0.1', null, 'test', 'asd-zyg@wp.pl', 'd1a4ec177fa244926b0e531d362c0f96', 'N', '66|1392104933', 'pl_PL', '', '', null, 'zł', '1.0000', null, null, null, null);
INSERT INTO `shop_orders` VALUES ('67', '4/2014/02/11', '4', '2014', '2', '11', '0', '1392105108', '1', '1', '0.00', '', '44.00', '6', '7.00', '0.00', '51.00', 'N', 'N', null, 'N', 'N', '127.0.0.1', null, 'test', 'asd-zyg@wp.pl', '76e80ca619723a771ced1eed1aedf370', 'N', '67|1392105113', 'pl_PL', '', '', null, 'zł', '1.0000', null, null, null, null);
INSERT INTO `shop_orders` VALUES ('68', '5/2014/02/11', '5', '2014', '2', '11', '0', '1392105258', '1', '1', '0.00', '', '44.00', '6', '7.00', '0.00', '51.00', 'N', 'N', null, 'N', 'N', '127.0.0.1', null, 'test', 'asd-zyg@wp.pl', '2007d768c9c782b2596d804bed8d7fcb', 'N', '68|1392105273', 'pl_PL', '', '', null, 'zł', '1.0000', null, null, null, null);
INSERT INTO `shop_orders` VALUES ('69', '1/2014/02/14', '1', '2014', '2', '14', '0', '1392367521', '3', '1', '0.00', '', '44.00', '5', '25.00', '0.00', '69.00', 'N', 'N', null, 'Y', 'N', '127.0.0.1', null, 'test', 'hubert@olicom.pl', '4d63453c7ad465e94daae46bd5494981', 'N', '69|1392367526', 'pl_PL', '', '', '', 'zł', '1.0000', null, null, null, null);
INSERT INTO `shop_orders` VALUES ('70', '1/2014/02/19', '1', '2014', '2', '19', '0', '1392813401', '1', '1', '0.00', '', '330.00', '5', '25.00', '0.00', '355.00', 'N', 'N', null, 'N', 'N', '::1', null, '', 'pawel@olicom.org.pl', '996ab42252c5936464f32f667ac9a782', 'N', '70|1392813412', 'pl_PL', '', '', null, 'zł', '1.0000', null, null, null, null);
INSERT INTO `shop_orders` VALUES ('71', '1/2014/02/20', '1', '2014', '2', '20', '0', '1392888520', '1', '1', '0.00', '', '132.00', '5', '25.00', '0.00', '157.00', 'N', 'N', null, 'N', 'N', '::1', null, 'test', 'pawel@olicom.org.pl', 'ace289ed16c2cd37b46078a47b33d4ce', 'N', '71|1392888530', 'pl_PL', '', '', null, 'zł', '1.0000', null, null, null, null);
INSERT INTO `shop_orders` VALUES ('72', '2/2014/02/20', '2', '2014', '2', '20', '33', '1392904845', '1', '1', '0.00', '', '44.00', '6', '7.00', '0.00', '51.00', 'N', 'N', null, 'Y', 'N', '::1', null, '', 'pawel@olicom.org.pl', 'af062f47396362025b4c92e6f09f0eb5', 'N', '72|1392904952', 'pl_PL', '', '', '', 'zł', '1.0000', null, null, null, null);
INSERT INTO `shop_orders` VALUES ('73', '1/2014/03/17', '1', '2014', '3', '17', '0', '1395064098', '1', '3', '0.00', '', '0.00', '5', '25.00', '0.00', '0.00', 'N', 'N', null, 'N', 'N', '127.0.0.1', null, 'test', 'hubert@olicom.pl', 'e41d8256ececf1d897689a5b84d94522', 'N', '73|1395064235', 'pl_PL', '', '', null, 'zł', '1.0000', 'code-1', '10', null, null);
INSERT INTO `shop_orders` VALUES ('74', '2/2014/03/17', '2', '2014', '3', '17', '0', '1395064493', '1', '3', '0.00', '', '49.50', '5', '25.00', '0.00', '74.50', 'N', 'N', null, 'N', 'N', '127.0.0.1', null, '', 'hubert@olicom.pl', '1998bff449b29bcf67ed778b06bc5685', 'N', '74|1395064499', 'pl_PL', '', '', null, 'zł', '1.0000', 'code-1', '10', null, null);
INSERT INTO `shop_orders` VALUES ('75', '3/2014/03/17', '3', '2014', '3', '17', '0', '1395065283', '1', '3', '0.00', '', '49.50', '5', '25.00', '0.00', '74.50', 'N', 'N', null, 'N', 'N', '127.0.0.1', null, '', 'hubert@olicom.pl', '51ee257b091e1f12bac9b196d2de3d8e', 'N', '75|1395065288', 'pl_PL', '', '', null, 'zł', '1.0000', 'code-1', '10', null, null);
INSERT INTO `shop_orders` VALUES ('76', '4/2014/03/17', '4', '2014', '3', '17', '0', '1395065741', '1', '3', '0.00', '', '49.50', '5', '25.00', '0.00', '74.50', 'N', 'N', null, 'N', 'N', '127.0.0.1', null, '', 'hubert@olicom.pl', 'f130eafef5084215d353581b5e3aa8a5', 'N', '76|1395065745', 'pl_PL', '', '', null, 'zł', '1.0000', 'code-1', '10', null, null);
INSERT INTO `shop_orders` VALUES ('77', '5/2014/03/17', '5', '2014', '3', '17', '0', '1395065865', '1', '3', '0.00', '', '49.50', '5', '25.00', '0.00', '74.50', 'N', 'N', null, 'N', 'N', '127.0.0.1', null, '', 'hubert@olicom.pl', 'e644a6071fcffcb498b8c6b4f4e5f46d', 'N', '77|1395065886', 'pl_PL', '', '', null, 'zł', '1.0000', 'code-1', '10', null, null);
INSERT INTO `shop_orders` VALUES ('78', '6/2014/03/17', '6', '2014', '3', '17', '0', '1395066744', '1', '2', '0.00', '', '242.00', '5', '25.00', '0.00', '267.00', 'N', 'N', null, 'N', 'N', '127.0.0.1', null, '', 'hubert@olicom.pl', '26436086a205b28afb1222989dd317e6', 'N', '78|1395066750', 'pl_PL', '', '', null, 'zł', '1.0000', 'code-1', '10', null, null);
INSERT INTO `shop_orders` VALUES ('79', '7/2014/03/17', '7', '2014', '3', '17', '0', '1395066890', '1', '3', '0.00', '', '83.60', '5', '25.00', '0.00', '108.60', 'N', 'N', null, 'N', 'N', '127.0.0.1', null, '', 'hubert@olicom.pl', 'e98782af718a639517aa25d0ef8fb4f0', 'N', '79|1395066894', 'pl_PL', '', '', null, 'zł', '1.0000', 'code-1', '10', null, null);
INSERT INTO `shop_orders` VALUES ('80', '1/2014/03/25', '1', '2014', '3', '25', '0', '1395747670', '1', '1', '0.00', '', '55.00', '6', '7.00', '0.00', '62.00', 'N', 'N', null, 'N', 'N', '127.0.0.1', null, 'test', 'hubert@olicom.pl', '6ff22a94a49873093a82a17d991e28eb', 'N', '80|1395747680', 'pl_PL', '', '', null, 'zł', '1.0000', null, null, null, null);
INSERT INTO `shop_orders` VALUES ('81', '2/2014/03/25', '2', '2014', '3', '25', '0', '1395748153', '1', '1', '0.00', '', '44.00', '6', '7.00', '0.00', '51.00', 'N', 'N', null, 'N', 'N', '127.0.0.1', null, 'test', 'hubert@olicom.pl', '6d669f853a77a61c897b444bf920fbe2', 'N', '81|1395748277', 'pl_PL', '', '', null, 'zł', '1.0000', null, null, null, null);
INSERT INTO `shop_orders` VALUES ('82', '3/2014/03/25', '3', '2014', '3', '25', '0', '1395748323', '1', '1', '0.00', '', '44.00', '6', '7.00', '0.00', '51.00', 'N', 'N', null, 'N', 'N', '127.0.0.1', null, '', 'hubert@olicom.pl', '2499ed17dd68c2029fabee956568d733', 'N', '', 'pl_PL', '', '', null, 'zł', '1.0000', null, null, null, null);
INSERT INTO `shop_orders` VALUES ('83', '4/2014/03/25', '4', '2014', '3', '25', '0', '1395748397', '1', '1', '0.00', '', '44.00', '6', '7.00', '0.00', '51.00', 'N', 'N', null, 'N', 'N', '127.0.0.1', null, '', 'hubert@olicom.pl', 'c4a3a5180b4c58e2d25e0098accf1265', 'N', '', 'pl_PL', '', '', null, 'zł', '1.0000', null, null, null, null);
INSERT INTO `shop_orders` VALUES ('84', '5/2014/03/25', '5', '2014', '3', '25', '0', '1395748418', '1', '1', '0.00', '', '44.00', '6', '7.00', '0.00', '51.00', 'N', 'N', null, 'N', 'N', '127.0.0.1', null, '', 'hubert@olicom.pl', '66d09ee94f87171272f897df82d25cf9', 'N', '', 'pl_PL', '', '', null, 'zł', '1.0000', null, null, null, null);
INSERT INTO `shop_orders` VALUES ('85', '6/2014/03/25', '6', '2014', '3', '25', '0', '1395748449', '1', '1', '0.00', '', '44.00', '6', '7.00', '0.00', '51.00', 'N', 'N', null, 'N', 'N', '127.0.0.1', null, '', 'hubert@olicom.pl', '02968a8351e9c450857884d139659a65', 'N', '', 'pl_PL', '', '', null, 'zł', '1.0000', null, null, null, null);
INSERT INTO `shop_orders` VALUES ('86', '7/2014/03/25', '7', '2014', '3', '25', '0', '1395748520', '1', '1', '0.00', '', '44.00', '6', '7.00', '0.00', '51.00', 'N', 'N', null, 'N', 'N', '127.0.0.1', null, '', 'hubert@olicom.pl', 'af32c8651af00e6d4002ea045360200d', 'N', '86|1395748553', 'pl_PL', '', '', null, 'zł', '1.0000', null, null, null, null);
INSERT INTO `shop_orders` VALUES ('87', '8/2014/03/25', '8', '2014', '3', '25', '0', '1395748587', '1', '1', '0.00', '', '44.00', '6', '7.00', '0.00', '51.00', 'N', 'N', null, 'N', 'N', '127.0.0.1', null, '', 'hubert@olicom.pl', 'cea91ee190372e11a6448702424aa5ad', 'N', '87|1395748594', 'pl_PL', '', '', null, 'zł', '1.0000', null, null, null, null);
INSERT INTO `shop_orders` VALUES ('88', '1/2014/04/15', '1', '2014', '4', '15', '0', '1397553811', '1', '1', '0.00', '', '156.60', '6', '7.00', '0.00', '163.60', 'N', 'N', null, 'N', 'N', '127.0.0.1', null, 'test', 'hubert@olicom.pl', '62778b79cc1796225019162ec8cdac8f', 'N', '88|1397553995', 'pl_PL', '', '', null, 'zł', '1.0000', 'fanbiały', '10', '17.40', null);
INSERT INTO `shop_orders` VALUES ('89', '1/2014/04/22', '1', '2014', '4', '22', '34', '1398153200', '1', '2', '0.00', '', '49.00', '6', '7.00', '0.00', '56.00', 'N', 'N', null, 'N', 'N', '127.0.0.1', null, 'test', 'hubert@olicom.pl', 'f0aa7c6f3b7d38bb88233036d13bb439', 'N', '89|1398153204', 'pl_PL', '', '', null, 'zł', '1.0000', 'fanbiały', '50', '16.00', null);
INSERT INTO `shop_orders` VALUES ('90', '1/2014/07/22', '1', '2014', '7', '22', '0', '1406021176', '1', '3', '0.00', '', '200.00', '6', '7.00', '0.00', '207.00', 'N', 'N', null, 'N', 'N', '::1', null, 'oolicom', 'pawel@olicom.pl', '3d45588c825374d8d7c1e44c386fb003', 'N', '90|1406021194', 'pl_PL', '', '', null, 'zł', '1.0000', null, null, '0.00', null);
INSERT INTO `shop_orders` VALUES ('91', '2/2014/07/22', '2', '2014', '7', '22', '36', '1406022071', '1', '3', '0.00', '', '19.99', '5', '25.00', '0.00', '44.99', 'N', 'N', null, 'N', 'N', '::1', null, 'oolicom', 'pawel@olicom.pl', '41b6924355b4b7d73d28d5ca008fa636', 'N', '91|1406022089', 'pl_PL', '', '', null, 'zł', '1.0000', null, null, '0.00', null);
INSERT INTO `shop_orders` VALUES ('92', '3/2014/07/22', '3', '2014', '7', '22', '0', '1406022987', '1', '3', '0.00', '', '39.90', '5', '25.00', '0.00', '64.90', 'N', 'N', null, 'N', 'N', '::1', null, '', 'pawel@olicom.pl', '771f92ffd4f5a8b052b0b5b5a8e024ab', 'N', '92|1406025447', 'pl_PL', '', '', null, 'zł', '1.0000', null, null, '0.00', null);
INSERT INTO `shop_orders` VALUES ('93', '4/2014/07/22', '4', '2014', '7', '22', '0', '1406025669', '1', '3', '0.00', '', '39.90', '6', '7.00', '0.00', '46.90', 'N', 'N', null, 'N', 'N', '::1', null, '', 'pawel@olicom.pl', '5d292dbbbe53ae26a2247a9fb99c20d8', 'N', '93|1406026009', 'pl_PL', '', '', null, 'zł', '1.0000', null, null, '0.00', null);
INSERT INTO `shop_orders` VALUES ('94', '1/2015/03/20', '1', '2015', '3', '20', '0', '1426856072', '1', '2', '0.00', '', '200.00', '5', '25.00', '0.00', '225.00', 'N', 'N', null, 'N', 'N', '::1', null, '', 'hubert@olicom.pl', 'e5c4ae42eaa28e98ff348b92e3a6e0ae', 'N', '94|1426856083', 'pl_PL', '', '', null, 'zł', '1.0000', null, null, '0.00', null);
INSERT INTO `shop_orders_customers` VALUES ('27', '0', 'pawel@olicom.pl', 'Paweł', 'Mor', null, null, 'Posen', '12-365', 'testowa 3', null, '', null, '123654789', null, null, '', '', '', null, null, null, null, null, null, null, null, null, null, null, '', '', '', null, null, null, null, null, null, null, null, null, null, null, 'N', 'N', '0', '0', '0');
INSERT INTO `shop_orders_customers` VALUES ('28', '28', 'pawel@olicom.org.pl', 'Paweł', 'Mor', null, null, 'Posen', '12-365', 'testowa 3', null, '', null, '123654789', null, null, '', '', '', null, null, null, null, null, null, null, null, null, null, null, '', '', '', null, null, null, null, null, null, null, null, null, null, null, 'N', 'N', '0', '0', '0');
INSERT INTO `shop_orders_customers` VALUES ('29', '0', 'pawel@olicom.org.pl', 'Paweł', 'Mor', null, null, 'Posen', '12-365', 'testowa 3', null, '', null, '123654789', null, null, '', '', '', null, null, null, null, null, null, null, null, null, null, null, '', '', '', null, null, null, null, null, null, null, null, null, null, null, 'N', 'N', '0', '0', '0');
INSERT INTO `shop_orders_customers` VALUES ('30', '0', 'pawel@olicom.org.pl', 'Paweł', 'Mor', null, null, 'Posen', '12-365', 'testowa 3', null, '', null, '123654789', null, null, '', '', '', null, null, null, null, null, null, null, null, null, null, null, '', '', '', null, null, null, null, null, null, null, null, null, null, null, 'N', 'N', '0', '0', '0');
INSERT INTO `shop_orders_customers` VALUES ('31', '0', 'pawel@olicom.org.pl', 'Paweł', 'Mor', null, null, 'Posen', '12-365', 'testowa 3', null, '', null, '123654789', null, null, '', '', '', null, null, null, null, null, null, null, null, null, null, null, '', '', '', null, null, null, null, null, null, null, null, null, null, null, 'N', 'N', '0', '0', '0');
INSERT INTO `shop_orders_customers` VALUES ('32', '0', 'pawel@olicom.org.pl', 'Paweł', 'Mor', null, null, 'Posen', '12-365', 'testowa 3', null, '', null, '123654789', null, null, '', '', '', null, null, null, null, null, null, null, null, null, null, null, '', '', '', null, null, null, null, null, null, null, null, null, null, null, 'N', 'N', '0', '0', '0');
INSERT INTO `shop_orders_customers` VALUES ('33', '0', 'pawel@olicom.org.pl', 'Paweł', 'Mor', null, null, 'Posen', '12-365', 'testowa 3', null, '', null, '123654789', null, null, '', '', '', null, null, null, null, null, null, null, null, null, null, null, '', '', '', null, null, null, null, null, null, null, null, null, null, null, 'N', 'N', '0', '0', '0');
INSERT INTO `shop_orders_customers` VALUES ('34', '0', 'pawel@olicom.org.pl', 'Paweł', 'Mor', null, null, 'Posen', '12-365', 'testowa 3', null, '', null, '123654789', null, null, '', '', '', null, null, null, null, null, null, null, null, null, null, null, '', '', '', null, null, null, null, null, null, null, null, null, null, null, 'N', 'N', '0', '0', '0');
INSERT INTO `shop_orders_customers` VALUES ('35', '0', 'pawel@olicom.org.pl', 'Paweł', 'Mor', null, null, 'Posen', '12-365', 'testowa 3', null, '', null, '123654789', null, null, '', '', '', null, null, null, null, null, null, null, null, null, null, null, '', '', '', null, null, null, null, null, null, null, null, null, null, null, 'N', 'N', '0', '0', '0');
INSERT INTO `shop_orders_customers` VALUES ('36', '0', 'pawel@olicom.org.pl', 'Paweł', 'Mor', null, null, 'Posen', '12-365', 'testowa 3', null, '', null, '123654789', null, null, '', '', '', null, null, null, null, null, null, null, null, null, null, null, '', '', '', null, null, null, null, null, null, null, null, null, null, null, 'N', 'N', '0', '0', '0');
INSERT INTO `shop_orders_customers` VALUES ('37', '0', 'pawel@olicom.org.pl', 'Paweł', 'Mor', null, null, 'Posen', '12-365', 'testowa 3', null, '', null, '123654789', null, null, '', '', '', null, null, null, null, null, null, null, null, null, null, null, '', '', '', null, null, null, null, null, null, null, null, null, null, null, 'N', 'N', '0', '0', '0');
INSERT INTO `shop_orders_customers` VALUES ('38', '0', 'pawel@olicom.org.pl', 'Paweł', 'Mor', null, null, 'Posen', '12-365', 'testowa 3', null, '', null, '123654789', null, null, '', '', '', null, null, null, null, null, null, null, null, null, null, null, '', '', '', null, null, null, null, null, null, null, null, null, null, null, 'N', 'N', '0', '0', '0');
INSERT INTO `shop_orders_customers` VALUES ('39', '0', 'pawel@olicom.org.pl', 'Paweł', 'Mor', null, null, 'Posen', '12-365', 'testowa 3', null, '', null, '123654789', null, null, '', '', '', null, null, null, null, null, null, null, null, null, null, null, '', '', '', null, null, null, null, null, null, null, null, null, null, null, 'N', 'N', '0', '0', '0');
INSERT INTO `shop_orders_customers` VALUES ('40', '0', 'pawel@olicom.org.pl', 'Paweł', 'Mor', null, null, 'Posen', '12-365', 'testowa 3', null, '', null, '123654789', null, null, '', '', '', null, null, null, null, null, null, null, null, null, null, null, '', '', '', null, null, null, null, null, null, null, null, null, null, null, 'N', 'N', '0', '0', '0');
INSERT INTO `shop_orders_customers` VALUES ('41', '0', 'pawel@olicom.pl', 'Paweł', 'Mor', null, null, 'Posen', '12-365', 'testowa 3', null, '', null, '123654789', null, null, '', '', '', null, null, null, null, null, null, null, null, null, null, null, '', '', '', null, null, null, null, null, null, null, null, null, null, null, 'N', 'N', '0', '0', '0');
INSERT INTO `shop_orders_customers` VALUES ('42', '0', 'pawel@olicom.pl', 'Paweł', 'Mor', null, null, 'Posen', '12-365', 'testowa 3', null, '', null, '123654789', null, null, '', '', '', null, null, null, null, null, null, null, null, null, null, null, '', '', '', null, null, null, null, null, null, null, null, null, null, null, 'N', 'N', '0', '0', '0');
INSERT INTO `shop_orders_customers` VALUES ('43', '0', 'pawel@olicom.pl', 'Paweł', 'Mor', null, null, 'Posen', '12-365', 'testowa 3', null, '', null, '123654789', null, null, '', '', '', null, null, null, null, null, null, null, null, null, null, null, '', '', '', null, null, null, null, null, null, null, null, null, null, null, 'N', 'N', '0', '0', '0');
INSERT INTO `shop_orders_customers` VALUES ('44', '0', 'pawel@olicom.pl', 'Paweł', 'Mor', null, null, 'Posen', '12-365', 'testowa 3', null, '', null, '123654789', null, null, '', '', '', null, null, null, null, null, null, null, null, null, null, null, '', '', '', null, null, null, null, null, null, null, null, null, null, null, 'N', 'N', '0', '0', '0');
INSERT INTO `shop_orders_customers` VALUES ('45', '0', 'pawel@olicom.org.pl', 'Paweł', 'Mor', null, null, 'Posen', '12-365', 'testowa 3', null, '', null, '123654789', null, null, '', '', '', null, null, null, null, null, null, null, null, null, null, null, '', '', '', null, null, null, null, null, null, null, null, null, null, null, 'N', 'N', '0', '0', '0');
INSERT INTO `shop_orders_customers` VALUES ('46', '27', 'pawel@olicom.org.pl', 'Paweł', 'Mor', null, null, 'Posen', '12-365', 'testowa 3', null, '', null, '123654789', null, null, '', '', '', null, null, null, null, null, null, null, null, null, null, null, '', '', '', null, null, null, null, null, null, null, null, null, null, null, 'N', 'N', '0', '0', '0');
INSERT INTO `shop_orders_customers` VALUES ('47', '27', 'pawel@olicom.org.pl', 'Paweł', 'Mor', null, null, 'Posen', '12-365', 'testowa 3', null, '', null, '123654789', null, null, '', '', '', null, null, null, null, null, null, null, null, null, null, null, '', '', '', null, null, null, null, null, null, null, null, null, null, null, 'N', 'N', '0', '0', '0');
INSERT INTO `shop_orders_customers` VALUES ('48', '0', 'pawel@olicom.pl', 'Paweł', 'Mor', null, null, 'Posen', '12-365', 'testowa 3', null, 'Polen', null, '123654789', null, null, 'pawel@olicom.pl', 'Paweł', 'Mor', 'Company', null, 'Warsaw', '11-789', 'Bronx 1', null, 'zambezi', null, '1234556767', null, null, '', 'Lol', 'Test', 'Rowo', '1236647984654', 'Gibraltar', '77-896', 'Test', null, 'Whoho', null, null, null, null, 'Y', 'Y', '0', '0', '0');
INSERT INTO `shop_orders_customers` VALUES ('49', '0', 'pawel@olicom.pl', 'test', 'test', null, null, 'test', '12-365', 'test', null, 'test', null, '123654789', null, null, 'pawel@olicom.pl', 'test', 'test', 'test', null, 'test', '11-888', 'test', null, 'test', null, '32165468496', null, null, '', 'test', 'test', 'test', '12365748451', 'test', '11-888', 'test', null, 'test', null, null, null, null, 'Y', 'Y', '0', '0', '0');
INSERT INTO `shop_orders_customers` VALUES ('50', '0', 'pawel@olicom.org.pl', 'Paweł', 'Mor', null, null, 'Posen', '12-365', 'testowa 3', null, '', null, '123654789', null, null, '', '', '', null, null, null, null, null, null, null, null, null, null, null, '', '', '', null, null, null, null, null, null, null, null, null, null, null, 'N', 'N', '0', '0', '0');
INSERT INTO `shop_orders_customers` VALUES ('51', '0', 'pawel@olicom.pl', 'Paweł', 'Mor', null, null, 'Posen', '12-365', 'testowa 3', null, '', null, '123654789', null, null, '', '', '', null, null, null, null, null, null, null, null, null, null, null, '', '', '', null, null, null, null, null, null, null, null, null, null, null, 'N', 'N', '0', '0', '0');
INSERT INTO `shop_orders_customers` VALUES ('52', '0', 'pawel@olicom.pl', 'Paweł', 'Mor', null, null, 'Posen', '12-365', 'testowa 3', null, '', null, '123654789', null, null, '', '', '', null, null, null, null, null, null, null, null, null, null, null, '', '', '', null, null, null, null, null, null, null, null, null, null, null, 'N', 'N', '0', '0', '0');
INSERT INTO `shop_orders_customers` VALUES ('53', '0', 'pawel@olicom.pl', 'Paweł', 'Moro', null, null, 'Posen', '12-365', 'testowa 3', null, '', null, '123654789', null, null, '', '', '', null, null, null, null, null, null, null, null, null, null, null, '', '', '', null, null, null, null, null, null, null, null, null, null, null, 'N', 'N', '0', '0', '0');
INSERT INTO `shop_orders_customers` VALUES ('54', '31', 'hubert@olicom.pl', 'Hubert', 'test', null, null, 'test', '44-444', 'Kmicica 1', null, 'Polska', null, '333444555', null, null, '', '', '', null, null, null, null, null, null, null, null, null, null, null, '', '', '', null, null, null, null, null, null, null, null, null, null, null, 'N', 'N', '0', '0', '0');
INSERT INTO `shop_orders_customers` VALUES ('55', '0', 'pawel@olicom.pl', 'Paweł', 'Mor', null, null, 'Posen', '12-365', 'testowa 3', null, '', null, '123654789', null, null, '', '', '', null, null, null, null, null, null, null, null, null, null, null, '', '', '', null, null, null, null, null, null, null, null, null, null, null, 'N', 'N', '0', '0', '0');
INSERT INTO `shop_orders_customers` VALUES ('56', '0', 'pawel@olicom.org.pl', 'Paweł', 'Mor', null, null, 'Posen', '12-365', 'testowa 3', null, '', null, '123654789', null, null, '', '', '', null, null, null, null, null, null, null, null, null, null, null, '', '', '', null, null, null, null, null, null, null, null, null, null, null, 'N', 'N', '0', '0', '0');
INSERT INTO `shop_orders_customers` VALUES ('57', '0', 'hubert@olicom.pl', 'Hubert', 'kkkk', null, null, 'test', '44-444', 'Kmicica 1', null, 'hubert@olicom.pl', null, '333444555', null, null, '', '', '', null, null, null, null, null, null, null, null, null, null, null, '', '', '', null, null, null, null, null, null, null, null, null, null, null, 'N', 'N', '0', '0', '0');
INSERT INTO `shop_orders_customers` VALUES ('58', '0', 'hubert@olicom.org.pl', 'Hubert', 'kkkk', null, null, 'test', '44-444', 'Kmicica 1', null, 'pljh', null, '333444555', null, null, '', '', '', null, null, null, null, null, null, null, null, null, null, null, '', '', '', null, null, null, null, null, null, null, null, null, null, null, 'N', 'N', '0', '0', '0');
INSERT INTO `shop_orders_customers` VALUES ('59', '31', 'hubert@olicom.pl', 'Hubert', 'test', null, null, 'test', '44-444', 'Kmicica 1', null, 'Polska', null, '333444555', null, null, '', '', '', null, null, null, null, null, null, null, null, null, null, null, '', '', '', null, null, null, null, null, null, null, null, null, null, null, 'N', 'N', '0', '0', '0');
INSERT INTO `shop_orders_customers` VALUES ('60', '31', 'hubert@olicom.pl', 'Hubert', 'test', null, null, 'test', '44-444', 'Kmicica 1', null, 'Polska', null, '333444555', null, null, '', '', '', null, null, null, null, null, null, null, null, null, null, null, '', '', '', null, null, null, null, null, null, null, null, null, null, null, 'N', 'N', '0', '0', '0');
INSERT INTO `shop_orders_customers` VALUES ('61', '31', 'hubert@olicom.pl', 'Hubert', 'test', null, null, 'test', '44-444', 'Kmicica 1', null, 'Polska', null, '333444555', null, null, '', '', '', null, null, null, null, null, null, null, null, null, null, null, '', '', '', null, null, null, null, null, null, null, null, null, null, null, 'N', 'N', '0', '0', '0');
INSERT INTO `shop_orders_customers` VALUES ('62', '31', 'hubert@olicom.pl', 'Hubert', 'test', null, null, 'test', '44-444', 'Kmicica 1', null, 'Polska', null, '333444555', null, null, '', '', '', null, null, null, null, null, null, null, null, null, null, null, '', '', '', null, null, null, null, null, null, null, null, null, null, null, 'N', 'N', '0', '0', '0');
INSERT INTO `shop_orders_customers` VALUES ('63', '31', 'hubert@olicom.pl', 'Hubert', 'test', null, null, 'test', '44-444', 'Kmicica 1', null, 'Polska', null, '333444555', null, null, '', '', '', null, null, null, null, null, null, null, null, null, null, null, '', '', '', null, null, null, null, null, null, null, null, null, null, null, 'N', 'N', '0', '0', '0');
INSERT INTO `shop_orders_customers` VALUES ('64', '0', 'hubert@olicom.pl', 'Hubert', 'kkkk', null, null, 'test', '44-444', 'Kmicica 1', null, 'hubert@olicom.pl', null, '555666777', null, null, '', '', '', null, null, null, null, null, null, null, null, null, null, null, '', '', '', null, null, null, null, null, null, null, null, null, null, null, 'N', 'N', '0', '0', '0');
INSERT INTO `shop_orders_customers` VALUES ('65', '0', 'asd-zyg@wp.pl', 'Hubert', 'kkkk', null, null, 'Poznań', '44-444', 'Kmicica 1', null, 'hubert@olicom.pl', null, '333444555', null, null, '', '', '', null, null, null, null, null, null, null, null, null, null, null, '', '', '', null, null, null, null, null, null, null, null, null, null, null, 'N', 'N', '0', '0', '0');
INSERT INTO `shop_orders_customers` VALUES ('66', '0', 'asd-zyg@wp.pl', 'Hubert', 'test', null, null, 'test', '44-444', 'Kmicica 1', null, 'polska', null, '333444555', null, null, '', '', '', null, null, null, null, null, null, null, null, null, null, null, '', '', '', null, null, null, null, null, null, null, null, null, null, null, 'N', 'N', '0', '0', '0');
INSERT INTO `shop_orders_customers` VALUES ('67', '0', 'asd-zyg@wp.pl', 'Testowy', 'test', null, null, 'test', '44-444', 'Kmicica 1', null, 'test', null, '333444555', null, null, '', '', '', null, null, null, null, null, null, null, null, null, null, null, '', '', '', null, null, null, null, null, null, null, null, null, null, null, 'N', 'N', '0', '0', '0');
INSERT INTO `shop_orders_customers` VALUES ('68', '0', 'asd-zyg@wp.pl', 'Hubert', 'test', null, null, 'test', '44-444', 'Kmicica 1', null, 'hubert@olicom.pl', null, '333444555', null, null, '', '', '', null, null, null, null, null, null, null, null, null, null, null, '', '', '', null, null, null, null, null, null, null, null, null, null, null, 'N', 'N', '0', '0', '0');
INSERT INTO `shop_orders_customers` VALUES ('69', '0', 'hubert@olicom.pl', 'Hubert', 'kkkk', null, null, 'test', '44-444', 'Kmicica 1', null, 'Polska', null, '333444555', null, null, '', '', '', null, null, null, null, null, null, null, null, null, null, null, '', '', '', null, null, null, null, null, null, null, null, null, null, null, 'N', 'N', '0', '0', '0');
INSERT INTO `shop_orders_customers` VALUES ('70', '0', 'pawel@olicom.org.pl', 'Paweł', 'Mor', null, null, 'Posen', '12-365', 'testowa 3', null, '', null, '123654789', null, null, '', '', '', null, null, null, null, null, null, null, null, null, null, null, '', '', '', null, null, null, null, null, null, null, null, null, null, null, 'N', 'N', '0', '0', '0');
INSERT INTO `shop_orders_customers` VALUES ('71', '0', 'pawel@olicom.org.pl', 'Paweł', 'Mor', null, null, 'Posen', '12-365', 'testowa 3', null, '', null, '123654789', null, null, '', '', '', null, null, null, null, null, null, null, null, null, null, null, '', '', '', null, null, null, null, null, null, null, null, null, null, null, 'N', 'N', '0', '0', '0');
INSERT INTO `shop_orders_customers` VALUES ('72', '33', 'pawel@olicom.org.pl', 'Paweł', 'Mor', null, null, 'Posen', '12-365', 'testowa 3', null, '', null, '123654789', null, null, '', '', '', null, null, null, null, null, null, null, null, null, null, null, '', '', '', null, null, null, null, null, null, null, null, null, null, null, 'N', 'N', '0', '0', '0');
INSERT INTO `shop_orders_customers` VALUES ('73', '0', 'hubert@olicom.pl', 'Hubert', 'test', null, null, 'Poznań', '44-444', 'Kmicica 1', null, 'hubert@olicom.pl', null, '333444555', null, null, '', '', '', null, null, null, null, null, null, null, null, null, null, null, '', '', '', null, null, null, null, null, null, null, null, null, null, null, 'N', 'N', '0', '0', '0');
INSERT INTO `shop_orders_customers` VALUES ('74', '0', 'hubert@olicom.pl', 'Hubert', 'test', null, null, 'test', '44-444', 'Kmicica 1', null, 'hubert@olicom.pl', null, '333444555', null, null, '', '', '', null, null, null, null, null, null, null, null, null, null, null, '', '', '', null, null, null, null, null, null, null, null, null, null, null, 'N', 'N', '0', '0', '0');
INSERT INTO `shop_orders_customers` VALUES ('75', '0', 'hubert@olicom.pl', 'Hubert', 'kkkk', null, null, 'Poznań', '44-444', 'Kmicica 1', null, 'hubert@olicom.pl', null, '333444555', null, null, '', '', '', null, null, null, null, null, null, null, null, null, null, null, '', '', '', null, null, null, null, null, null, null, null, null, null, null, 'N', 'N', '0', '0', '0');
INSERT INTO `shop_orders_customers` VALUES ('76', '0', 'hubert@olicom.pl', 'Hubert', 'test', null, null, 'test', '44-444', 'Kmicica 1', null, 'hubert@olicom.pl', null, '333444555', null, null, '', '', '', null, null, null, null, null, null, null, null, null, null, null, '', '', '', null, null, null, null, null, null, null, null, null, null, null, 'N', 'N', '0', '0', '0');
INSERT INTO `shop_orders_customers` VALUES ('77', '0', 'hubert@olicom.pl', 'Testowy', 'test', null, null, 'test', '44-444', 'Kmicica 1', null, 'hubert@olicom.pl', null, '333444555', null, null, '', '', '', null, null, null, null, null, null, null, null, null, null, null, '', '', '', null, null, null, null, null, null, null, null, null, null, null, 'N', 'N', '0', '0', '0');
INSERT INTO `shop_orders_customers` VALUES ('78', '0', 'hubert@olicom.pl', 'Hubert', 'kkkk', null, null, 'test', '44-444', 'Kmicica 1', null, 'hubert@olicom.pl', null, '333444555', null, null, '', '', '', null, null, null, null, null, null, null, null, null, null, null, '', '', '', null, null, null, null, null, null, null, null, null, null, null, 'N', 'N', '0', '0', '0');
INSERT INTO `shop_orders_customers` VALUES ('79', '0', 'hubert@olicom.pl', 'Hubert', 'kkkk', null, null, 'Poznań', '60-160', 'Kmicica 1', null, 'hubert@olicom.pl', null, '333444555', null, null, '', '', '', null, null, null, null, null, null, null, null, null, null, null, '', '', '', null, null, null, null, null, null, null, null, null, null, null, 'N', 'N', '0', '0', '0');
INSERT INTO `shop_orders_customers` VALUES ('80', '0', 'hubert@olicom.pl', 'Hubert', 'kkkk', null, null, 'test', '44-444', 'Kmicica 1', null, 'pol', null, '333444555', null, null, '', '', '', null, null, null, null, null, null, null, null, null, null, null, '', '', '', null, null, null, null, null, null, null, null, null, null, null, 'N', 'N', '0', '0', '0');
INSERT INTO `shop_orders_customers` VALUES ('81', '0', 'hubert@olicom.pl', 'Hubert', 'test', null, null, 'test', '44-444', 'Kmicica 1', null, 'hubert@olicom.pl', null, '333444555', null, null, '', '', '', null, null, null, null, null, null, null, null, null, null, null, '', '', '', null, null, null, null, null, null, null, null, null, null, null, 'N', 'N', '0', '0', '0');
INSERT INTO `shop_orders_customers` VALUES ('82', '0', 'hubert@olicom.pl', 'Hubert', 'kkkk', null, null, 'test', '44-444', 'Kmicica 1', null, 'hubert@olicom.pl', null, '333444555', null, null, '', '', '', null, null, null, null, null, null, null, null, null, null, null, '', '', '', null, null, null, null, null, null, null, null, null, null, null, 'N', 'N', '0', '0', '0');
INSERT INTO `shop_orders_customers` VALUES ('83', '0', 'hubert@olicom.pl', 'Hubert', 'kkkk', null, null, 'test', '44-444', 'Kmicica 1', null, 'hubert@olicom.pl', null, '333444555', null, null, '', '', '', null, null, null, null, null, null, null, null, null, null, null, '', '', '', null, null, null, null, null, null, null, null, null, null, null, 'N', 'N', '0', '0', '0');
INSERT INTO `shop_orders_customers` VALUES ('84', '0', 'hubert@olicom.pl', 'Hubert', 'kkkk', null, null, 'test', '44-444', 'Kmicica 1', null, 'hubert@olicom.pl', null, '333444555', null, null, '', '', '', null, null, null, null, null, null, null, null, null, null, null, '', '', '', null, null, null, null, null, null, null, null, null, null, null, 'N', 'N', '0', '0', '0');
INSERT INTO `shop_orders_customers` VALUES ('85', '0', 'hubert@olicom.pl', 'Hubert', 'kkkk', null, null, 'test', '44-444', 'Kmicica 1', null, 'hubert@olicom.pl', null, '333444555', null, null, '', '', '', null, null, null, null, null, null, null, null, null, null, null, '', '', '', null, null, null, null, null, null, null, null, null, null, null, 'N', 'N', '0', '0', '0');
INSERT INTO `shop_orders_customers` VALUES ('86', '0', 'hubert@olicom.pl', 'Hubert', 'kkkk', null, null, 'test', '44-444', 'Kmicica 1', null, 'hubert@olicom.pl', null, '333444555', null, null, '', '', '', null, null, null, null, null, null, null, null, null, null, null, '', '', '', null, null, null, null, null, null, null, null, null, null, null, 'N', 'N', '0', '0', '0');
INSERT INTO `shop_orders_customers` VALUES ('87', '0', 'hubert@olicom.pl', 'Hubert', 'kkkk', null, null, 'Poznań', '44-444', 'Kmicica 1', null, 'hubert@olicom.pl', null, '333444555', null, null, '', '', '', null, null, null, null, null, null, null, null, null, null, null, '', '', '', null, null, null, null, null, null, null, null, null, null, null, 'N', 'N', '0', '0', '0');
INSERT INTO `shop_orders_customers` VALUES ('88', '0', 'hubert@olicom.pl', 'Hubert', 'kkkk', null, null, 'Poznań', '60-160', 'Kmicica 1', null, 'hh', null, '333444555', null, null, '', '', '', null, null, null, null, null, null, null, null, null, null, null, '', '', '', null, null, null, null, null, null, null, null, null, null, null, 'N', 'N', '0', '0', '0');
INSERT INTO `shop_orders_customers` VALUES ('89', '34', 'hubert@olicom.pl', 'hubert', 'kkkk', null, null, 'poznan', '55-666', 'adres 2', null, 'polska', null, '555666444', null, null, '', '', '', null, null, null, null, null, null, null, null, null, null, null, '', '', '', null, null, null, null, null, null, null, null, null, null, null, 'N', 'N', '0', '0', '0');
INSERT INTO `shop_orders_customers` VALUES ('90', '0', 'pawel@olicom.pl', 'test', 'test', null, null, 'Posen', '12-365', 'testowa 3', null, '', null, '123456798', null, null, '', '', '', null, null, null, null, null, null, null, null, null, null, null, '', '', '', null, null, null, null, null, null, null, null, null, null, null, 'N', 'N', '0', '0', '0');
INSERT INTO `shop_orders_customers` VALUES ('91', '36', 'pawel@olicom.pl', 'Paweł', 'Mor', null, null, 'Posen', '12-365', 'testowa 3', null, '', null, '123456798', null, null, '', '', '', null, null, null, null, null, null, null, null, null, null, null, '', '', '', null, null, null, null, null, null, null, null, null, null, null, 'N', 'N', '0', '0', '0');
INSERT INTO `shop_orders_customers` VALUES ('92', '0', 'pawel@olicom.pl', 'Paweł', 'Mor', null, null, 'Posen', '12-365', 'testowa 3', null, '', null, '123456798', null, null, '', '', '', null, null, null, null, null, null, null, null, null, null, null, '', '', '', null, null, null, null, null, null, null, null, null, null, null, 'N', 'N', '0', '0', '0');
INSERT INTO `shop_orders_customers` VALUES ('93', '0', 'pawel@olicom.pl', 'Paweł', 'Mor', null, null, 'Posen', '12-365', 'testowa 3', null, '', null, '123456798', null, null, '', '', '', null, null, null, null, null, null, null, null, null, null, null, '', '', '', null, null, null, null, null, null, null, null, null, null, null, 'N', 'N', '0', '0', '0');
INSERT INTO `shop_orders_customers` VALUES ('94', '0', 'hubert@olicom.pl', 'Marcin', 'Marciniak', null, null, 'Swarzędz', '55-555', 'test', null, '', null, '321 321 321', null, null, '', '', '', null, null, null, null, null, null, null, null, null, null, null, '', '', '', null, null, null, null, null, null, null, null, null, null, null, 'N', 'N', '0', '0', '0');
INSERT INTO `shop_orders_products` VALUES ('27', '87', '', '', '3', '33.00', '0');
INSERT INTO `shop_orders_products` VALUES ('28', '87', '', '', '2', '33.00', '0');
INSERT INTO `shop_orders_products` VALUES ('29', '87', '', '', '2', '33.00', '0');
INSERT INTO `shop_orders_products` VALUES ('30', '87', '', '', '2', '33.00', '0');
INSERT INTO `shop_orders_products` VALUES ('31', '87', '', '', '2', '33.00', '0');
INSERT INTO `shop_orders_products` VALUES ('32', '87', '', '', '2', '33.00', '0');
INSERT INTO `shop_orders_products` VALUES ('33', '87', '', '', '2', '33.00', '0');
INSERT INTO `shop_orders_products` VALUES ('34', '87', '', '', '2', '33.00', '0');
INSERT INTO `shop_orders_products` VALUES ('35', '87', '', '', '2', '33.00', '0');
INSERT INTO `shop_orders_products` VALUES ('36', '87', '', '', '2', '33.00', '0');
INSERT INTO `shop_orders_products` VALUES ('37', '87', '', '', '2', '33.00', '0');
INSERT INTO `shop_orders_products` VALUES ('38', '87', '', '', '2', '33.00', '0');
INSERT INTO `shop_orders_products` VALUES ('39', '87', '', '', '3', '33.00', '0');
INSERT INTO `shop_orders_products` VALUES ('40', '87', '', '', '3', '33.00', '0');
INSERT INTO `shop_orders_products` VALUES ('41', '87', '', '', '3', '33.00', '0');
INSERT INTO `shop_orders_products` VALUES ('42', '87', '', '', '3', '33.00', '0');
INSERT INTO `shop_orders_products` VALUES ('43', '91', '', '3:niebieski', '1', '120.00', '0');
INSERT INTO `shop_orders_products` VALUES ('44', '91', '', '3:niebieski', '1', '120.00', '0');
INSERT INTO `shop_orders_products` VALUES ('45', '91', '', '3:Czarnuszy;4:Słomki niebieskie', '2', '120.00', '0');
INSERT INTO `shop_orders_products` VALUES ('45', '91', '', '3:Zielony;4:Różowy', '3', '120.00', '0');
INSERT INTO `shop_orders_products` VALUES ('46', '88', '', '', '1', '144.00', '0');
INSERT INTO `shop_orders_products` VALUES ('47', '87', '', '', '1', '33.00', '0');
INSERT INTO `shop_orders_products` VALUES ('48', '96', '', '', '1', '10.00', '0');
INSERT INTO `shop_orders_products` VALUES ('49', '96', '', '', '1', '10.00', '0');
INSERT INTO `shop_orders_products` VALUES ('50', '97', '', '', '2', '10.00', '0');
INSERT INTO `shop_orders_products` VALUES ('51', '96', '', '', '1', '10.00', '0');
INSERT INTO `shop_orders_products` VALUES ('52', '97', '', '', '1', '10.00', '0');
INSERT INTO `shop_orders_products` VALUES ('53', '96', '', '', '18', '10.00', '0');
INSERT INTO `shop_orders_products` VALUES ('54', '103', '', '', '1', '330.00', '0');
INSERT INTO `shop_orders_products` VALUES ('55', '102', '', '', '1', '44.00', '0');
INSERT INTO `shop_orders_products` VALUES ('56', '103', '', '', '2', '330.00', '0');
INSERT INTO `shop_orders_products` VALUES ('56', '102', '', '', '1', '44.00', '0');
INSERT INTO `shop_orders_products` VALUES ('57', '101', '', '', '6', '55.00', '0');
INSERT INTO `shop_orders_products` VALUES ('57', '102', '', '', '1', '44.00', '0');
INSERT INTO `shop_orders_products` VALUES ('58', '103', '', '', '1', '330.00', '0');
INSERT INTO `shop_orders_products` VALUES ('59', '101', '', '', '1', '55.00', '0');
INSERT INTO `shop_orders_products` VALUES ('60', '101', '', '', '32', '55.00', '0');
INSERT INTO `shop_orders_products` VALUES ('61', '99', '', '', '1', '44.00', '0');
INSERT INTO `shop_orders_products` VALUES ('62', '99', '', '', '1', '44.00', '0');
INSERT INTO `shop_orders_products` VALUES ('63', '103', '', '', '2', '330.00', '0');
INSERT INTO `shop_orders_products` VALUES ('64', '102', '', '', '1', '44.00', '0');
INSERT INTO `shop_orders_products` VALUES ('65', '99', '', '', '1', '44.00', '0');
INSERT INTO `shop_orders_products` VALUES ('66', '99', '', '', '1', '44.00', '0');
INSERT INTO `shop_orders_products` VALUES ('67', '99', '', '', '1', '44.00', '0');
INSERT INTO `shop_orders_products` VALUES ('68', '99', '', '', '1', '44.00', '0');
INSERT INTO `shop_orders_products` VALUES ('69', '102', '', '', '1', '44.00', '0');
INSERT INTO `shop_orders_products` VALUES ('70', '103', '', '', '1', '330.00', '0');
INSERT INTO `shop_orders_products` VALUES ('71', '102', '', '', '3', '44.00', '0');
INSERT INTO `shop_orders_products` VALUES ('72', '104', '', '', '1', '44.00', '0');
INSERT INTO `shop_orders_products` VALUES ('73', '107', '', '', '10', '44.00', '10');
INSERT INTO `shop_orders_products` VALUES ('73', '98', '', '3:Czerwony', '2', '44.00', '0');
INSERT INTO `shop_orders_products` VALUES ('73', '108', '', '', '3', '55.00', '10');
INSERT INTO `shop_orders_products` VALUES ('74', '108', '', '', '1', '55.00', '10');
INSERT INTO `shop_orders_products` VALUES ('75', '108', '', '', '1', '55.00', '10');
INSERT INTO `shop_orders_products` VALUES ('76', '108', '', '', '1', '55.00', '10');
INSERT INTO `shop_orders_products` VALUES ('77', '108', '', '', '1', '55.00', '10');
INSERT INTO `shop_orders_products` VALUES ('78', '107', '', '', '5', '44.00', '10');
INSERT INTO `shop_orders_products` VALUES ('78', '98', '', '3:Czarnuszy', '1', '44.00', '0');
INSERT INTO `shop_orders_products` VALUES ('79', '107', '', '', '1', '44.00', '10');
INSERT INTO `shop_orders_products` VALUES ('79', '98', '', '3:Czerwony', '1', '44.00', '0');
INSERT INTO `shop_orders_products` VALUES ('80', '108', '', '', '1', '55.00', '0');
INSERT INTO `shop_orders_products` VALUES ('81', '102', '', '', '1', '44.00', '0');
INSERT INTO `shop_orders_products` VALUES ('82', '102', '', '', '1', '44.00', '0');
INSERT INTO `shop_orders_products` VALUES ('83', '102', '', '', '1', '44.00', '0');
INSERT INTO `shop_orders_products` VALUES ('84', '102', '', '', '1', '44.00', '0');
INSERT INTO `shop_orders_products` VALUES ('85', '102', '', '', '1', '44.00', '0');
INSERT INTO `shop_orders_products` VALUES ('86', '102', '', '', '1', '44.00', '0');
INSERT INTO `shop_orders_products` VALUES ('87', '102', '', '', '1', '44.00', '0');
INSERT INTO `shop_orders_products` VALUES ('88', '102', '', '', '1', '44.00', '10');
INSERT INTO `shop_orders_products` VALUES ('88', '105', '', '', '1', '10.00', '10');
INSERT INTO `shop_orders_products` VALUES ('88', '106', '', '', '1', '120.00', '10');
INSERT INTO `shop_orders_products` VALUES ('89', '105', '', '', '1', '10.00', '50');
INSERT INTO `shop_orders_products` VALUES ('89', '108', '', '', '1', '55.00', '20');
INSERT INTO `shop_orders_products` VALUES ('90', '126', '', '', '1', '200.00', '0');
INSERT INTO `shop_orders_products` VALUES ('91', '123', '', '', '1', '19.99', '0');
INSERT INTO `shop_orders_products` VALUES ('92', '125', '', '', '1', '39.90', '0');
INSERT INTO `shop_orders_products` VALUES ('93', '125', '', '4:Różowy', '1', '39.90', '0');
INSERT INTO `shop_orders_products` VALUES ('94', '126', '', '', '1', '200.00', '0');
INSERT INTO `shop_orders_statuses` VALUES ('1', 'nowe', 'pl_PL');
INSERT INTO `shop_orders_statuses` VALUES ('2', 'zapłacono', 'pl_PL');
INSERT INTO `shop_orders_statuses` VALUES ('3', 'w realizacji', 'pl_PL');
INSERT INTO `shop_orders_statuses` VALUES ('4', 'zrealizowano', 'pl_PL');
INSERT INTO `shop_orders_statuses` VALUES ('5', 'zamknięte', 'pl_PL');
INSERT INTO `shop_payment_types` VALUES ('1', 'Y', '0.00', null);
INSERT INTO `shop_payment_types` VALUES ('2', 'Y', '0.00', 'dotpay');
INSERT INTO `shop_payment_types` VALUES ('3', 'Y', '0.00', 'dotpay');
INSERT INTO `shop_payment_types_description` VALUES ('1', 'Przelew na konto', 'pl_PL', 'PL  00 0000 0000 0000 0000 0000 0000<br/>Numer SWIFT banku: AAAAAAAA  -  jeśli płatność jest dokonywana z zagranicy<br/><br/>twoja firma<br/>ul. Ulica 1<br/>00-000 Miasto<br/><br/><strong>W tytule proszę wpisać numer zamówienia, oraz swoje imię i nazwisko.</strong>');
INSERT INTO `shop_payment_types_description` VALUES ('2', 'Karta kredytowa', 'pl_PL', null);
INSERT INTO `shop_payment_types_description` VALUES ('3', 'Dotpay', 'pl_PL', null);
INSERT INTO `shop_producers` VALUES ('11', 'Olicom', 'olicom-logo.png', '1', 'Y', null);
INSERT INTO `shop_producers` VALUES ('13', 'asds', null, '0', 'Y', null);
INSERT INTO `shop_producers` VALUES ('16', 'gbfc', null, '0', 'N', null);
INSERT INTO `shop_product_to_variant` VALUES ('102', '22', '5', 'a:1:{i:4;s:2:\"26\";}');
INSERT INTO `shop_product_to_variant` VALUES ('102', '23', '7', 'a:1:{i:4;s:2:\"25\";}');
INSERT INTO `shop_product_to_variant` VALUES ('103', '24', '5', 'a:1:{i:4;s:2:\"26\";}');
INSERT INTO `shop_product_to_variant` VALUES ('103', '25', '7', 'a:1:{i:4;s:2:\"25\";}');
INSERT INTO `shop_product_to_variant` VALUES ('128', '26', '5', 'a:2:{i:7;s:7:\"wybierz\";i:4;s:2:\"25\";}');
INSERT INTO `shop_product_to_variant` VALUES ('128', '27', '4', 'a:1:{i:7;s:2:\"40\";}');
INSERT INTO `shop_product_to_variant` VALUES ('128', '28', '7', 'a:2:{i:7;s:2:\"38\";i:4;s:2:\"25\";}');
INSERT INTO `shop_product_to_variant` VALUES ('128', '29', '7', 'a:2:{i:7;s:2:\"38\";i:4;s:2:\"25\";}');
INSERT INTO `shop_product_to_variant` VALUES ('125', '30', '1', 'a:2:{i:7;s:2:\"39\";i:4;s:2:\"25\";}');
INSERT INTO `shop_products_medias` VALUES ('1', '14');
INSERT INTO `shop_products_medias` VALUES ('1', '12');
INSERT INTO `shop_products_medias` VALUES ('1', '10');
INSERT INTO `shop_products_statuses` VALUES ('1', 'Y', 'Y');
INSERT INTO `shop_products_statuses` VALUES ('2', 'N', 'Y');
INSERT INTO `shop_products_statuses_description` VALUES ('1', 'Dostępny', 'pl_PL');
INSERT INTO `shop_products_statuses_description` VALUES ('2', 'Dostępny wkrótce', 'pl_PL');
INSERT INTO `shop_questions` VALUES ('1', 'aaa', 'hubert@olicom.pl', '5555555', 'test', '11', '2014-02-04', 'test', 'N');
INSERT INTO `shop_questions` VALUES ('2', 'bgbg', 'hubert@olicom.pl', '5555555', 'asdf', '12', '2014-02-04', 'asdtest', 'Y');
INSERT INTO `shop_questions` VALUES ('3', 'yyggf', 'hubert@olicom.pl', '5555555', 'hjgjfgfh', '12', '2014-02-04', 'mnmftghgf', 'Y');
INSERT INTO `shop_rebates_codes` VALUES ('1', 'fanbiały', '1', '50', '2014-07-01 00:00:00', '2014-07-31 00:00:00', '0000-00-00 00:00:00', '2014-07-22 11:53:34');
INSERT INTO `shop_rebates_codes` VALUES ('2', 'test5', '1', '5', '2014-04-03 00:00:00', '2014-04-09 00:00:00', '2014-04-11 10:05:59', '2014-04-11 11:24:15');
INSERT INTO `shop_rebates_codes` VALUES ('3', 'fanbiały', '0', '5', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2014-04-14 08:42:31', null);
INSERT INTO `shop_rebates_codes` VALUES ('4', 'fanbiały', '0', '5', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2014-04-14 08:46:58', null);
INSERT INTO `shop_rebates_codes` VALUES ('5', 'wiosna', '1', '20', '2014-05-10 00:00:00', '2014-06-19 00:00:00', '2014-06-12 07:53:31', '2014-06-12 07:53:52');
INSERT INTO `shop_rebates_codes_to_products` VALUES ('102', '4');
INSERT INTO `shop_rebates_codes_to_products` VALUES ('103', '4');
INSERT INTO `shop_rebates_codes_to_products` VALUES ('96', '4');
INSERT INTO `shop_rebates_codes_to_products` VALUES ('105', '4');
INSERT INTO `shop_rebates_codes_to_products` VALUES ('106', '4');
INSERT INTO `shop_rebates_codes_to_products` VALUES ('124', '12');
INSERT INTO `shop_rebates_codes_to_products` VALUES ('125', '12');
INSERT INTO `shop_rebates_codes_to_products` VALUES ('115', '12');
INSERT INTO `shop_rebates_codes_to_products` VALUES ('116', '12');
INSERT INTO `shop_rebates_codes_to_products` VALUES ('108', '5');
INSERT INTO `shop_rebates_codes_to_products` VALUES ('107', '5');
INSERT INTO `shop_rebates_codes_to_products` VALUES ('104', '5');
INSERT INTO `shop_rebates_codes_to_products` VALUES ('98', '5');
INSERT INTO `shop_rebates_codes_to_products` VALUES ('97', '5');
INSERT INTO `shop_rebates_codes_to_products` VALUES ('100', '5');
INSERT INTO `shop_rebates_codes_to_products` VALUES ('99', '5');
INSERT INTO `shop_rebates_codes_to_products` VALUES ('101', '5');
INSERT INTO `shop_rebates_codes_to_products` VALUES ('106', '5');
INSERT INTO `shop_rebates_codes_to_products` VALUES ('105', '5');
INSERT INTO `shop_rebates_codes_to_products` VALUES ('96', '5');
INSERT INTO `shop_rebates_codes_to_products` VALUES ('103', '5');
INSERT INTO `shop_rebates_codes_to_products` VALUES ('102', '5');
INSERT INTO `shop_rebates_codes_to_products` VALUES ('124', '14');
INSERT INTO `shop_rebates_codes_to_products` VALUES ('125', '14');
INSERT INTO `shop_rebates_codes_to_products` VALUES ('115', '14');
INSERT INTO `shop_rebates_codes_to_products` VALUES ('116', '14');
INSERT INTO `shop_rebates_codes_to_products` VALUES ('124', '13');
INSERT INTO `shop_rebates_codes_to_products` VALUES ('125', '13');
INSERT INTO `shop_rebates_codes_to_products` VALUES ('115', '13');
INSERT INTO `shop_rebates_codes_to_products` VALUES ('116', '13');
INSERT INTO `shop_rebates_groups` VALUES ('1', 'test', '5', 'Y');
INSERT INTO `shop_rebates_groups` VALUES ('3', 'hgffg', '14', 'N');
INSERT INTO `shop_rebates_groups` VALUES ('4', 'kjhg', '65', 'Y');
INSERT INTO `shop_taxes` VALUES ('8', 'Stawka II', '23');
INSERT INTO `shop_taxes` VALUES ('7', 'Stawka I', '8');
INSERT INTO `slider_elements` VALUES ('55', '3', '40', '2', '1');
INSERT INTO `slider_images` VALUES ('40', 'Pogoda', '143090904815549f07810cbf225904649.jpg', null, null, 'pl_PL', '0');
