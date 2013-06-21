CREATE TABLE `cars` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `model_id` int(11) unsigned NOT NULL,
  `production_year` year(4) DEFAULT NULL,
  `reg_number` varchar(7) DEFAULT NULL COMMENT 'Set to varchar 7 as old reg use less',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  CONSTRAINT `cars_FK_model_id` FOREIGN KEY (`id`) REFERENCES `models` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `makes` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `models` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `make_id` int(11) NOT NULL,
  `name` varchar(20) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  CONSTRAINT `models_FK_make_id` FOREIGN KEY (`id`) REFERENCES `makes` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
