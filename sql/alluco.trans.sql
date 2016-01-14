DROP TABLE IF EXISTS `lexik_trans_unit_translations`;

DROP TABLE IF EXISTS `lexik_trans_unit`;

DROP TABLE IF EXISTS `lexik_translation_file`;





CREATE TABLE IF NOT EXISTS `lexik_translation_file` (
    `id`                                                                    integer unsigned auto_increment not null,
    `domain`                                                                varchar(255) NOT NULL,
    `locale`                                                                varchar(10) NOT NULL,
    `extention`                                                             varchar(10) NOT NULL,
    `path`                                                                  varchar(255) NOT NULL,
    `hash`                                                                  varchar(255) NOT NULL,
    CONSTRAINT `pk_lexik_translation_file` PRIMARY KEY (`id`),
    CONSTRAINT `hash_idx` UNIQUE KEY (`hash`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `lexik_trans_unit` (
    `id`                                                                    integer unsigned auto_increment not null,
    `key_name`                                                              varchar(255) NOT NULL,
    `domain`                                                                varchar(255) NOT NULL,
    `created_at`                                                            datetime DEFAULT NULL,
    `updated_at`                                                            datetime DEFAULT NULL,
    CONSTRAINT `pk_lexik_trans_unit` PRIMARY KEY (`id`),
    CONSTRAINT `key_domain_idx` UNIQUE KEY (`key_name`,`domain`)
) ENGINE=InnoDB DEFAULT CHARACTER SET=utf8;


CREATE TABLE IF NOT EXISTS `lexik_trans_unit_translations` (
    `id`                                                                    integer unsigned auto_increment not null,
    `file_id`                                                               integer unsigned DEFAULT NULL,
    `trans_unit_id`                                                         integer unsigned DEFAULT NULL,
    `locale`                                                                varchar(10) NOT NULL,
    `content`                                                               longtext NOT NULL,
    `created_at`                                                            datetime DEFAULT NULL,
    `updated_at`                                                            datetime DEFAULT NULL,
    CONSTRAINT `pk_lexik_trans_unit_translations` PRIMARY KEY (`id`),
    CONSTRAINT `trans_unit_locale_idx` UNIQUE KEY (`trans_unit_id`,`locale`),
    CONSTRAINT `fk_lexik_trans_unit_translations_trans_unit` FOREIGN KEY (`trans_unit_id`) REFERENCES `lexik_trans_unit` (`id`) ON UPDATE CASCADE ON DELETE CASCADE,
    CONSTRAINT `fk_lexik_trans_unit_translations_file` FOREIGN KEY (`file_id`) REFERENCES `lexik_translation_file` (`id`) ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARACTER SET=utf8;

