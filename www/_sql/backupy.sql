

INSERT INTO `cms2`.`acl_permissions` (`name`, `resource`, `privilege`, `description`) 
VALUES ('backup_index', 'backup', 'index', 'Lista backupów');
INSERT INTO `cms2`.`acl_permissions` (`name`, `resource`, `privilege`, `description`) 
VALUES ('backup_restore', 'backup', 'restore', 'Przywracanie backupu');
INSERT INTO `cms2`.`acl_permissions` (`name`, `resource`, `privilege`, `description`) 
VALUES ('backup_add_backup', 'backup', 'add_backup', 'Tworzenie backupu');
INSERT INTO `cms2`.`acl_permissions` (`name`, `resource`, `privilege`, `description`) 
VALUES ('backup_delete', 'backup', 'delete', 'Usuwanie backupu');


CREATE TABLE `backups` (
	`backup_id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(50) NOT NULL,
	`description` VARCHAR(250) NOT NULL,
	`state` TINYINT(1) NOT NULL,
	`backup_date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	`file` VARCHAR(50) NULL DEFAULT NULL,
	`dirs` VARCHAR(500) NULL DEFAULT NULL,
	PRIMARY KEY (`backup_id`)
)
COLLATE='utf8_general_ci'
ENGINE=MyISAM
AUTO_INCREMENT=7
;


