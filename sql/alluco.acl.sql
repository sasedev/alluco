DROP TABLE IF EXISTS `acl_entries`;

DROP TABLE IF EXISTS `acl_object_identity_ancestors`;

DROP TABLE IF EXISTS `acl_object_identities`;

DROP TABLE IF EXISTS `acl_security_identities`;

DROP TABLE IF EXISTS `acl_classes`;





CREATE TABLE IF NOT EXISTS `acl_classes` (
    `id`                                                                    integer unsigned auto_increment not null,
    `class_type`                                                            varchar(200) NOT NULL,
    CONSTRAINT `pk_acl_classes` PRIMARY KEY (`id`),
    CONSTRAINT `acl_classes_idx` UNIQUE KEY (`class_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



CREATE TABLE IF NOT EXISTS `acl_security_identities` (
    `id`                                                                    integer unsigned auto_increment not null,
    `identifier`                                                            varchar(200) NOT NULL,
    `username`                                                              tinyint(1) NOT NULL,
    CONSTRAINT `pk_acl_security_identities` PRIMARY KEY (`id`),
    CONSTRAINT `acl_security_identities_idx` UNIQUE KEY (`identifier`,`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



CREATE TABLE IF NOT EXISTS `acl_object_identities` (
    `id`                                                                    integer unsigned auto_increment not null,
    `parent_object_identity_id`                                             integer unsigned DEFAULT NULL,
    `class_id`                                                              integer unsigned NOT NULL,
    `object_identifier`                                                     varchar(100) NOT NULL,
    `entries_inheriting`                                                    tinyint(1) NOT NULL,
    CONSTRAINT `pk_acl_object_identities` PRIMARY KEY (`id`),
    CONSTRAINT `acl_object_identities_idx` UNIQUE KEY (`object_identifier`,`class_id`),
    CONSTRAINT `fk_acl_object_identities_parent` FOREIGN KEY (`parent_object_identity_id`) REFERENCES `acl_object_identities` (`id`) ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



CREATE TABLE IF NOT EXISTS `acl_object_identity_ancestors` (
    `object_identity_id`                                                    integer unsigned NOT NULL,
    `ancestor_id`                                                           integer unsigned NOT NULL,
    CONSTRAINT `pk_acl_object_identity_ancestors` PRIMARY KEY (`object_identity_id`,`ancestor_id`),
    CONSTRAINT `fk_acl_object_identity_ancestors_object_identity` FOREIGN KEY (`object_identity_id`) REFERENCES `acl_object_identities` (`id`) ON UPDATE CASCADE ON DELETE CASCADE,
    CONSTRAINT `fk_acl_object_identity_ancestors_ancestor` FOREIGN KEY (`ancestor_id`) REFERENCES `acl_object_identities` (`id`) ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;  



CREATE TABLE IF NOT EXISTS `acl_entries` (
    `id`                                                                    integer unsigned auto_increment not null,
    `class_id`                                                              integer unsigned NOT NULL,
    `object_identity_id`                                                    integer unsigned DEFAULT NULL,
    `security_identity_id`                                                  integer unsigned NOT NULL,
    `field_name`                                                            varchar(50) DEFAULT NULL,
    `ace_order`                                                             smallint(5) unsigned NOT NULL,
    `mask`                                                                  integer NOT NULL,
    `granting`                                                              tinyint(1) NOT NULL,
    `granting_strategy`                                                     varchar(30) NOT NULL,
    `audit_success`                                                         tinyint(1) NOT NULL,
    `audit_failure`                                                         tinyint(1) NOT NULL,
    CONSTRAINT `pk_acl_entries` PRIMARY KEY (`id`),
    CONSTRAINT `acl_entries_idx` UNIQUE KEY (`class_id`,`object_identity_id`,`field_name`,`ace_order`),
    CONSTRAINT `fk_acl_entries_object_identity` FOREIGN KEY (`object_identity_id`) REFERENCES `acl_object_identities` (`id`) ON UPDATE CASCADE ON DELETE CASCADE,
    CONSTRAINT `fk_acl_entries_security_identity` FOREIGN KEY (`security_identity_id`) REFERENCES `acl_security_identities` (`id`) ON UPDATE CASCADE ON DELETE CASCADE,
    CONSTRAINT `fk_acl_entries_class` FOREIGN KEY (`class_id`) REFERENCES `acl_classes` (`id`) ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

