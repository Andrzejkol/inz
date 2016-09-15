CREATE TABLE `slider_news` (
	`slider_news_id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	`news_title` INT(255) NOT NULL,
	`news_description` TEXT NOT NULL,
	`news_short_description` TEXT NULL,
	`filename` VARCHAR(50) NULL DEFAULT NULL,
	`alt` VARCHAR(100) NULL DEFAULT NULL,
	PRIMARY KEY (`slider_news_id`)
)
COLLATE='utf8_general_ci'
ENGINE=InnoDB;
