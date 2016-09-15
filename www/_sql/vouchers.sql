/*
MySQL Data Transfer
Source Host: localhost
Source Database: bodychief_sklep
Target Host: localhost
Target Database: bodychief_sklep
Date: 2015-12-07 15:07:59
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for vouchers
-- ----------------------------
DROP TABLE IF EXISTS `vouchers`;
CREATE TABLE `vouchers` (
  `id_voucher` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `voucher_code` varchar(32) NOT NULL,
  `voucher_status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '0-nieaktywny, 1 - można użyć, 2 - użyty',
  `voucher_create` datetime NOT NULL,
  `voucher_modify` datetime DEFAULT NULL,
  `voucher_used` datetime DEFAULT NULL,
  `voucher_value` double(10,2) unsigned NOT NULL,
  PRIMARY KEY (`id_voucher`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;


