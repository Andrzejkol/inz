-- Adminer 4.2.2 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `popup`;
CREATE TABLE `popup` (
  `id_popup` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL COMMENT 'wyświetlane userowi',
  `button_text` varchar(255) NOT NULL COMMENT 'tekst na bocznym buttonie',
  `content` text NOT NULL,
  `link` varchar(255) DEFAULT NULL,
  `type_id` tinyint(4) NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0/1',
  `date_start` timestamp NULL DEFAULT NULL,
  `date_end` timestamp NULL DEFAULT NULL,
  `count_click` int(11) DEFAULT NULL,
  `count_view` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_popup`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `popup_type`;
CREATE TABLE `popup_type` (
  `id_type` int(11) NOT NULL AUTO_INCREMENT,
  `type_title` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  PRIMARY KEY (`id_type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `popup_type` (`id_type`, `type_title`, `position`) VALUES
(1,	'Popup',	'popup');

-- 2015-12-15 12:07:37
