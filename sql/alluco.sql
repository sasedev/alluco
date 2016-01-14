DROP TABLE IF EXISTS `a_productpics`;

DROP TABLE IF EXISTS `a_productdocs`;

DROP TABLE IF EXISTS `a_products`;

DROP TABLE IF EXISTS `a_productgroups`;

DROP TABLE IF EXISTS `a_traces`;

DROP TABLE IF EXISTS `a_sitenews`;

DROP TABLE IF EXISTS `a_users_roles`;

DROP TABLE IF EXISTS `a_users`;

DROP TABLE IF EXISTS `a_contacts`;

DROP TABLE IF EXISTS `a_jobs`;

DROP TABLE IF EXISTS `a_role_parents`;

DROP TABLE IF EXISTS `a_roles`;

DROP TABLE IF EXISTS `a_langs`;

DROP TABLE IF EXISTS `a_banners`;

DROP TABLE IF EXISTS `a_staticpages`;

DROP TABLE IF EXISTS `a_constant_floats`;

DROP TABLE IF EXISTS `a_constant_ints`;

DROP TABLE IF EXISTS `a_constant_strs`;

DROP TABLE IF EXISTS `a_constant_floats`;

DROP TABLE IF EXISTS `a_constant_ints`;

DROP TABLE IF EXISTS `lexik_trans_unit_translations`;

DROP TABLE IF EXISTS `lexik_trans_unit`;

DROP TABLE IF EXISTS `lexik_translation_file`;

DROP TABLE IF EXISTS `acl_entries`;

DROP TABLE IF EXISTS `acl_object_identity_ancestors`;

DROP TABLE IF EXISTS `acl_object_identities`;

DROP TABLE IF EXISTS `acl_security_identities`;

DROP TABLE IF EXISTS `acl_classes`;


CREATE TABLE IF NOT EXISTS `acl_classes` (
  `id`                                                                integer unsigned auto_increment not null,
  `class_type` varchar(200) NOT NULL,
  CONSTRAINT `pk_acl_classes` PRIMARY KEY (`id`),
  CONSTRAINT `acl_classes_idx` UNIQUE KEY (`class_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



CREATE TABLE IF NOT EXISTS `acl_security_identities` (
  `id`                                                                integer unsigned auto_increment not null,
  `identifier` varchar(200) NOT NULL,
  `username` tinyint(1) NOT NULL,
  CONSTRAINT `pk_acl_security_identities` PRIMARY KEY (`id`),
  CONSTRAINT `acl_security_identities_idx` UNIQUE KEY (`identifier`,`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



CREATE TABLE IF NOT EXISTS `acl_object_identities` (
  `id`                                                                integer unsigned auto_increment not null,
  `parent_object_identity_id` integer unsigned DEFAULT NULL,
  `class_id` integer unsigned NOT NULL,
  `object_identifier` varchar(100) NOT NULL,
  `entries_inheriting` tinyint(1) NOT NULL,
  CONSTRAINT `pk_acl_object_identities` PRIMARY KEY (`id`),
  CONSTRAINT `acl_object_identities_idx` UNIQUE KEY (`object_identifier`,`class_id`),
  CONSTRAINT `fk_acl_object_identities_parent` FOREIGN KEY (`parent_object_identity_id`) REFERENCES `acl_object_identities` (`id`) ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



CREATE TABLE IF NOT EXISTS `acl_object_identity_ancestors` (
  `object_identity_id` integer unsigned NOT NULL,
  `ancestor_id` integer unsigned NOT NULL,
  CONSTRAINT `pk_acl_object_identity_ancestors` PRIMARY KEY (`object_identity_id`,`ancestor_id`),
  CONSTRAINT `fk_acl_object_identity_ancestors_object_identity` FOREIGN KEY (`object_identity_id`) REFERENCES `acl_object_identities` (`id`) ON UPDATE CASCADE ON DELETE CASCADE,
  CONSTRAINT `fk_acl_object_identity_ancestors_ancestor` FOREIGN KEY (`ancestor_id`) REFERENCES `acl_object_identities` (`id`) ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;  



CREATE TABLE IF NOT EXISTS `acl_entries` (
  `id`                                                                integer unsigned auto_increment not null,
  `class_id` integer unsigned NOT NULL,
  `object_identity_id` integer unsigned DEFAULT NULL,
  `security_identity_id` integer unsigned NOT NULL,
  `field_name` varchar(50) DEFAULT NULL,
  `ace_order` smallint(5) unsigned NOT NULL,
  `mask` integer NOT NULL,
  `granting` tinyint(1) NOT NULL,
  `granting_strategy` varchar(30) NOT NULL,
  `audit_success` tinyint(1) NOT NULL,
  `audit_failure` tinyint(1) NOT NULL,
  CONSTRAINT `pk_acl_entries` PRIMARY KEY (`id`),
  CONSTRAINT `acl_entries_idx` UNIQUE KEY (`class_id`,`object_identity_id`,`field_name`,`ace_order`),
  CONSTRAINT `fk_acl_entries_object_identity` FOREIGN KEY (`object_identity_id`) REFERENCES `acl_object_identities` (`id`) ON UPDATE CASCADE ON DELETE CASCADE,
  CONSTRAINT `fk_acl_entries_security_identity` FOREIGN KEY (`security_identity_id`) REFERENCES `acl_security_identities` (`id`) ON UPDATE CASCADE ON DELETE CASCADE,
  CONSTRAINT `fk_acl_entries_class` FOREIGN KEY (`class_id`) REFERENCES `acl_classes` (`id`) ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



CREATE TABLE IF NOT EXISTS `lexik_translation_file` (
  `id`                                                                integer unsigned auto_increment not null,
  `domain` varchar(255) NOT NULL,
  `locale` varchar(10) NOT NULL,
  `extention` varchar(10) NOT NULL,
  `path` varchar(255) NOT NULL,
  `hash` varchar(255) NOT NULL,
  CONSTRAINT `pk_lexik_translation_file` PRIMARY KEY (`id`),
  CONSTRAINT `hash_idx` UNIQUE KEY (`hash`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `lexik_trans_unit` (
  `id`                                                                integer unsigned auto_increment not null,
  `key_name` varchar(255) NOT NULL,
  `domain` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
    CONSTRAINT `pk_lexik_trans_unit` PRIMARY KEY (`id`),
  CONSTRAINT `key_domain_idx` UNIQUE KEY (`key_name`,`domain`)
) ENGINE=InnoDB DEFAULT CHARACTER SET=utf8;


CREATE TABLE IF NOT EXISTS `lexik_trans_unit_translations` (
  `id`                                                                integer unsigned auto_increment not null,
  `file_id` integer unsigned DEFAULT NULL,
  `trans_unit_id` integer unsigned DEFAULT NULL,
  `locale` varchar(10) NOT NULL,
  `content` longtext NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
    CONSTRAINT `pk_lexik_trans_unit_translations` PRIMARY KEY (`id`),
  CONSTRAINT `trans_unit_locale_idx` UNIQUE KEY (`trans_unit_id`,`locale`),
    CONSTRAINT `fk_lexik_trans_unit_translations_trans_unit` FOREIGN KEY (`trans_unit_id`) REFERENCES `lexik_trans_unit` (`id`) ON UPDATE CASCADE ON DELETE CASCADE,
    CONSTRAINT `fk_lexik_trans_unit_translations_file` FOREIGN KEY (`file_id`) REFERENCES `lexik_translation_file` (`id`) ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARACTER SET=utf8;

CREATE TABLE `a_constant_strs` (
    `id`                                                                integer unsigned auto_increment not null,
    `name`                                                              TEXT NOT NULL,
    `val`                                                               TEXT NOT NULL,
    `description`                                                       TEXT NULL,
    `dtcrea`                                                            datetime NULL,
    `dtupdate`                                                          datetime NULL,
    CONSTRAINT `pk_a_constant_strs` PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARACTER SET=utf8;
    
CREATE TABLE `a_constant_ints` (
    `id`                                                                integer unsigned auto_increment not null,
    `name`                                                              TEXT NOT NULL,
    `val`                                                               integer NOT NULL,
    `description`                                                       TEXT NULL,
    `dtcrea`                                                            datetime NULL,
    `dtupdate`                                                          datetime NULL,
    CONSTRAINT `pk_a_constant_ints` PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARACTER SET=utf8;
    
CREATE TABLE `a_constant_floats` (
    `id`                                                                integer unsigned auto_increment not null,
    `name`                                                              TEXT NOT NULL,
    `val`                                                               float NOT NULL,
    `description`                                                       TEXT NULL,
    `dtcrea`                                                            datetime NULL,
    `dtupdate`                                                          datetime NULL,
    CONSTRAINT `pk_a_constant_floats` PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARACTER SET=utf8;

CREATE TABLE `a_staticpages` (
    `id`                                                                integer unsigned auto_increment not null,
    `pageurl`                                                           VARCHAR(250)            NOT NULL,
    `htmltitle_fr`                                                         TEXT NULL,
    `metakeywords_fr`                                                      TEXT NULL,
    `metadescription_fr`                                                   TEXT NULL,
    `pagetitle_fr`                                                         TEXT NULL,
    `pagecontent_fr`                                                       TEXT NULL,
    `htmltitle_en`                                                         TEXT NULL,
    `metakeywords_en`                                                      TEXT NULL,
    `metadescription_en`                                                   TEXT NULL,
    `pagetitle_en`                                                         TEXT NULL,
    `pagecontent_en`                                                       TEXT NULL,
    `dtcrea`                                                            datetime NULL,
    `dtupdate`                                                          datetime NULL,
    CONSTRAINT `pk_a_staticpages` PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARACTER SET=utf8;

CREATE UNIQUE INDEX `a_staticpages_u1` ON `a_staticpages` (`pageurl`);

CREATE TABLE `a_banners` (
    `id`                                                                integer unsigned auto_increment not null,
    `filename`                                                          TEXT NOT NULL,
    `rank`                                                              integer NOT NULL DEFAULT 100,
    `title_fr`                                                             TEXT NULL,
    `alt_fr`                                                               TEXT NULL,
    `title_en`                                                             TEXT NULL,
    `alt_en`                                                               TEXT NULL,
    `dtcrea`                                                            datetime NULL,
    `dtupdate`                                                          datetime NULL,
    CONSTRAINT `pk_a_banners` PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARACTER SET=utf8;

CREATE TABLE `a_langs` (
    `id`                                                                integer unsigned auto_increment not null,
    `prefix`                                                            VARCHAR(15)     NOT NULL,
    `name`                                                              VARCHAR(200)            NOT NULL,
    `status`                                                            integer            NOT NULL DEFAULT 0,
    `direction`                                                         VARCHAR(5)            NOT NULL DEFAULT 'ltr',
    `dtcrea`                                                            datetime NULL,
    `dtupdate`                                                          datetime NULL,
    CONSTRAINT `pk_a_langs` PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARACTER SET=utf8;

CREATE TABLE `a_roles` (
    `id`                                                                integer unsigned auto_increment not null,
    `name`                                                              VARCHAR(250) NOT NULL,
    `description`                                                       TEXT NULL,
    `dtcrea`                                                            datetime NULL,
    `dtupdate`                                                          datetime NULL,
    CONSTRAINT `pk_a_roles` PRIMARY KEY (`id`),
  CONSTRAINT `roles_idx` UNIQUE KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARACTER SET=utf8;

CREATE UNIQUE INDEX `a_roles_u1` ON `a_roles` (`name`);

CREATE TABLE `a_role_parents` (
    `child`                                                             integer unsigned NOT NULL,
    `parent`                                                            integer unsigned NOT NULL,
    CONSTRAINT `pk_a_role_parents` PRIMARY KEY (`child`, `parent`),
    CONSTRAINT `fk_a_role_parents_child` FOREIGN KEY (`child`) REFERENCES `a_roles` (`id`) ON UPDATE CASCADE ON DELETE CASCADE,
    CONSTRAINT `fk_a_role_parents_parend` FOREIGN KEY (`parent`) REFERENCES `a_roles` (`id`) ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARACTER SET=utf8;

CREATE TABLE `a_jobs` (
    `id`                                                                integer unsigned auto_increment not null,
    `name_fr`                                                              VARCHAR(200)            NOT NULL,
    `name_en`                                                              VARCHAR(200)            NOT NULL,
    `status`                                                            integer            NOT NULL DEFAULT 0,
    `rank`                                                              integer NOT NULL DEFAULT 100,
    `dtcrea`                                                            datetime NULL,
    `dtupdate`                                                          datetime NULL,
    CONSTRAINT `pk_a_jobs` PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARACTER SET=utf8;

CREATE TABLE `a_contacts` (
    `id`                                                                integer unsigned auto_increment not null,
    `firstname`                                                         VARCHAR(70) NOT NULL,
    `lastname`                                                         VARCHAR(70) NOT NULL,
    `email`                                                         VARCHAR(250) NOT NULL,
    `phone`                                                             VARCHAR(30) NULL,
    `company`                                                           VARCHAR(250) NULL,
    `job_id`                                                            integer unsigned null,
    `subject`                                                           TEXT NULL,
    `msg`                                                               TEXT NULL,
    `dtcrea`                                                            datetime NULL,
    `dtupdate`                                                          datetime NULL,
    CONSTRAINT `pk_a_contacts` PRIMARY KEY (`id`),
    CONSTRAINT `fk_a_contacts_job` FOREIGN KEY (`job_id`) REFERENCES `a_jobs` (`id`) ON UPDATE CASCADE ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARACTER SET=utf8;

CREATE TABLE `a_users` (
    `id`                                                                integer unsigned auto_increment not null,
    `username`                                                          VARCHAR(75) NOT NULL,
    `email`                                                             VARCHAR(250) NULL,
    `clearpassword`                                                     VARCHAR(250) NULL,
    `passwd`                                                            VARCHAR(250) NULL,
    `salt`                                                              VARCHAR(250) NULL,
    `recoverycode`                                                      TEXT NULL,
    `recoveryexpiration`                                                datetime NULL,
    `lockout`                                                           integer NOT NULL DEFAULT 1,
    `logins`                                                            integer NOT NULL DEFAULT 0,
    `lastlogin`                                                         datetime NULL,
    `lastactivity`                                                      datetime NULL,
    `lastname`                                                          VARCHAR(75) NULL,
    `firstname`                                                         VARCHAR(75) NULL,
    `sexe`                                                              integer NULL,
    `birthday`                                                          DATE NULL,
    `strnum`                                                            VARCHAR(20) NULL,
    `address`                                                           TEXT NULL,
    `address2`                                                          TEXT NULL,
    `town`                                                              VARCHAR(100) NULL,
    `zipcode`                                                           VARCHAR(20) NULL,
    `country`                                                           VARCHAR(5) NULL,
    `fax`                                                               VARCHAR(30) NULL,
    `phone`                                                             VARCHAR(30) NULL,
    `mobile`                                                            VARCHAR(30) NULL,
    `company`                                                           VARCHAR(250) NULL,
    `fisc`                                                              VARCHAR(250) NULL,
    `usertype`                                                          integer not null default 1,
    `otherinfo`                                                         TEXT NULL,
    `avatar`                                                            TEXT NULL,
    `job_id`                                                            integer unsigned null,
    `lang_id`                                                           integer unsigned NULL,
    `dtcrea`                                                            datetime NULL,
    `dtupdate`                                                          datetime NULL,
    CONSTRAINT `pk_a_users` PRIMARY KEY (`id`),
    CONSTRAINT `fk_a_users_job` FOREIGN KEY (`job_id`) REFERENCES `a_jobs` (`id`) ON UPDATE CASCADE ON DELETE SET NULL,
    CONSTRAINT `fk_a_users_lang` FOREIGN KEY (`lang_id`) REFERENCES `a_langs` (`id`) ON UPDATE CASCADE ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARACTER SET=utf8;

CREATE TABLE `a_users_roles` (
    `user_id`                                                           integer unsigned NOT NULL,
    `role_id`                                                           integer unsigned NOT NULL,
    CONSTRAINT `pk_a_users_roles` PRIMARY KEY (`user_id`, `role_id`),
    CONSTRAINT `fk_a_users_roles_user` FOREIGN KEY (`user_id`) REFERENCES `a_users` (`id`) ON UPDATE CASCADE ON DELETE CASCADE,
    CONSTRAINT `fk_a_users_roles_role` FOREIGN KEY (`role_id`) REFERENCES `a_roles` (`id`) ON UPDATE CASCADE ON DELETE CASCADE
    
) ENGINE=InnoDB DEFAULT CHARACTER SET=utf8;

CREATE TABLE `a_sitenews` (
    `id`                                                                integer unsigned auto_increment not null,
    `pageurl`                                                           VARCHAR(250)            NOT NULL,
    `htmltitle_fr`                                                         TEXT NULL,
    `metakeywords_fr`                                                      TEXT NULL,
    `metadescription_fr`                                                   TEXT NULL,
    `pagetitle_fr`                                                         TEXT NULL,
    `pagecontent_fr`                                                       TEXT NULL,
    `thumbalt_fr`                                                          TEXT NULL,
    `thumbtitle_fr`                                                        TEXT NULL,
    `htmltitle_en`                                                         TEXT NULL,
    `metakeywords_en`                                                      TEXT NULL,
    `metadescription_en`                                                   TEXT NULL,
    `pagetitle_en`                                                         TEXT NULL,
    `pagecontent_en`                                                       TEXT NULL,
    `thumbalt_en`                                                          TEXT NULL,
    `thumbtitle_en`                                                          TEXT NULL,
    `thumb`                                                                TEXT NULL,
    `dtcrea`                                                            datetime NULL,
    `dtupdate`                                                          datetime NULL,
    CONSTRAINT `pk_a_sitenews` PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARACTER SET=utf8;

CREATE TABLE `a_traces` (
    `id`                                                                integer unsigned auto_increment not null,
    `action_type`                                                       integer NOT NULL DEFAULT 0,
    `action_entity`                                                     VARCHAR(100) NOT NULL,
    `action_id`                                                         VARCHAR(100) NULL,
    `user_id`                                                           integer NULL,
    `user_fullname`                                                     VARCHAR(250) NULL,
    `user_type`                                                         integer NOT NULL DEFAULT 0,
    `msg`                                                               TEXT NULL,
    `dtcrea`                                                            datetime NULL,
    `dtupdate`                                                          datetime NULL,
    CONSTRAINT `pk_a_traces` PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARACTER SET=utf8;

CREATE TABLE `a_productgroups` (
    `id`                                                                integer unsigned auto_increment not null,
    `pageurl`                                                              VARCHAR(250)            NOT NULL,
    `pageurl_full`                                                         TEXT            NOT NULL,
    `thumb`                                                             TEXT NULL,
    `name_fr`                                                              VARCHAR(250)            NOT NULL,
    `htmltitle_fr`                                                         TEXT NULL,
    `metakeywords_fr`                                                      TEXT NULL,
    `metadescription_fr`                                                   TEXT NULL,
    `pagetitle_fr`                                                         TEXT NULL,
    `pagedescription_fr`                                                   TEXT NULL,
    `thumbalt_fr`                                                          TEXT NULL,
    `thumbtitle_fr`                                                        TEXT NULL,
    `name_en`                                                              VARCHAR(250)            NOT NULL,
    `htmltitle_en`                                                         TEXT NULL,
    `metakeywords_en`                                                      TEXT NULL,
    `metadescription_en`                                                   TEXT NULL,
    `pagetitle_en`                                                         TEXT NULL,
    `pagedescription_en`                                                   TEXT NULL,
    `thumbalt_en`                                                          TEXT NULL,
    `thumbtitle_en`                                                        TEXT NULL,
    `rank`                                                              integer NOT NULL DEFAULT 100,
    `parent_id`                                                   integer unsigned NULL,
    `dtcrea`                                                            datetime NULL,
    `dtupdate`                                                          datetime NULL,
    CONSTRAINT `pk_a_productgroups` PRIMARY KEY (`id`),
    CONSTRAINT `pk_a_productgroups_parent` FOREIGN KEY (`parent_id`) REFERENCES `a_productgroups` (`id`) ON UPDATE CASCADE ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARACTER SET=utf8;

CREATE UNIQUE INDEX `a_productgroups_u1` ON `a_productgroups` (`pageurl`);

CREATE TABLE `a_products` (
    `id`                                                                integer unsigned auto_increment not null,
    `pageurl`                                                           VARCHAR(250)            NOT NULL,
    `thumb`                                                             TEXT NULL,
    `name_fr`                                                              VARCHAR(250)            NOT NULL,
    `htmltitle_fr`                                                         TEXT NULL,
    `metakeywords_fr`                                                      TEXT NULL,
    `metadescription_fr`                                                   TEXT NULL,
    `pagetitle_fr`                                                         TEXT NULL,
    `pagedescription_fr`                                                   TEXT NULL,
    `thumbalt_fr`                                                          TEXT NULL,
    `thumbtitle_fr`                                                        TEXT NULL,
    `name_en`                                                              VARCHAR(250)            NOT NULL,
    `htmltitle_en`                                                         TEXT NULL,
    `metakeywords_en`                                                      TEXT NULL,
    `metadescription_en`                                                   TEXT NULL,
    `pagetitle_en`                                                         TEXT NULL,
    `pagedescription_en`                                                   TEXT NULL,
    `thumbalt_en`                                                          TEXT NULL,
    `thumbtitle_en`                                                        TEXT NULL,
    `rank`                                                              integer NOT NULL DEFAULT 100,
    `productgroup_id`                                                   integer unsigned NOT NULL,
    `dtcrea`                                                            datetime NULL,
    `dtupdate`                                                          datetime NULL,
    CONSTRAINT `pk_a_products` PRIMARY KEY (`id`),
    CONSTRAINT `fk_a_products_productgroup` FOREIGN KEY (`productgroup_id`) REFERENCES `a_productgroups` (`id`) ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARACTER SET=utf8;

CREATE UNIQUE INDEX `a_products_u1` ON `a_products` (`pageurl`,`productgroup_id`);

CREATE TABLE `a_productdocs` (
    `id`                                                                integer unsigned auto_increment not null,
    `filename`                                                          TEXT NOT NULL,
    `filesize`                                                          integer NOT NULL DEFAULT 0,
    `filemimetype`                                                      TEXT NOT NULL,
    `fileoname`                                                         TEXT NOT NULL,
    `filemd5`                                                           TEXT NOT NULL,
    `filedesc`                                                          TEXT NULL,
    `filedls`                                                           integer NOT NULL DEFAULT 0,
    `rank`                                                              integer NOT NULL DEFAULT 100,
    `product_id`                                                        integer unsigned NOT NULL,
    `dtcrea`                                                            datetime NULL,
    `dtupdate`                                                          datetime NULL,
    CONSTRAINT `pk_a_productdocs` PRIMARY KEY (`id`),
    CONSTRAINT `fk_a_productdocs_product` FOREIGN KEY (`product_id`) REFERENCES `a_products` (`id`) ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARACTER SET=utf8;

CREATE TABLE `a_productpics` (
    `id`                                                                integer unsigned auto_increment not null,
    `filename`                                                          TEXT NOT NULL,
    `rank`                                                              integer NOT NULL DEFAULT 100,
    `title`                                                             TEXT NULL,
    `alt`                                                               TEXT NULL,
    `description`                                                       TEXT NULL,
    `product_id`                                                        integer unsigned NOT NULL,
    `dtcrea`                                                            datetime NULL,
    `dtupdate`                                                          datetime NULL,
    CONSTRAINT `pk_a_productpics` PRIMARY KEY (`id`),
    CONSTRAINT `fk_a_productpics_product` FOREIGN KEY (`product_id`) REFERENCES `a_products` (`id`) ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARACTER SET=utf8;

INSERT INTO `a_staticpages` (`pageurl`, `htmltitle_fr`, `metakeywords_fr`, `metadescription_fr`, `pagetitle_fr`, `pagecontent_fr`, `pagecontent_en`, `dtcrea`, `dtupdate`) VALUES
('/', 'Accueil', 'Alluco.com', 'Alluco.com', 'Bienvenue', '<p>Alluco se positionne sur le march&eacute; de l&rsquo;aluminium par des concepts innovants et s&rsquo;adaptant parfaitement aux exigences de l&rsquo;architecture contemporaine.</p><p>Par son choix diversifi&eacute; de produits, Alluco s&rsquo;associe &agrave; vos Projets et vous offre une solution en aluminium pertinente et compl&egrave;te r&eacute;pondant &agrave; 3 principes fondamentaux&nbsp;:</p><ol><li>Une Am&eacute;lioration de la performance &eacute;nerg&eacute;tique des b&acirc;timents&nbsp;: l&rsquo;Economie d&rsquo;&eacute;nergie,</li><li>Une habitation saine et confortable,</li><li>Un design splendide</li></ol><p>&nbsp;</p><p><br />La large gamme de produit d&rsquo;Alluco comprend&nbsp;:</p><ul><li>Des s&eacute;ries compl&egrave;tes de syst&egrave;mes de profil&eacute;s en aluminium&nbsp;: Coulissant, Oscillo-battant, Mur Rideaux&hellip;.</li><li>Des lames volet roulant extrud&eacute;es ou inject&eacute;es assurant votre s&eacute;curit&eacute;.</li><li>Les syst&egrave;mes de garde-corps des balcons, v&eacute;randas, et les escaliers con&ccedil;us par des profil&eacute;s en aluminium anodis&eacute;s aspect inox ou Vitr&eacute;s</li><li>Des syst&egrave;mes de protection solaire tel que Brises soleil fixes ou coulissantes pergolas, Screens, Camargue, vous permettant de profiter de votre espace ext&eacute;rieur &agrave; tout moment de l&rsquo;ann&eacute;e.</li></ul>', '<p>Avec un esprit innovateur, Alluco se spécialise et se positionne dans le confort de l’aluminium.</p><p>Depuis sa création, elle n’a cessé de développer sa gamme de produits en offrant des solutions en aluminium pertinentes et complètes et qui s’adaptent parfaitement aux spécificités architecturales contemporaines.</p><p>En effet, Alluco met à votre disposition des produits en aluminium de haute qualité (profilés, lames volet, Gardes corps, Protection solaire, Grilles de ventilation, Accessoires…) et qui répondent aux exigences d’efficacité énergétique, à la sécurité, au bien être et design innovant.</p>', NOW(), NOW()),
('/certificats', 'Certificats', NULL, NULL, 'Nos Certificats', '<div class="portfolio-page portfolio-2column"><ul id="portfolio-list" data-animated="fadeIn"><li><img src="/res/certificats/01.jpg"><a class="lightbox" href="/res/certificats/01.jpg"><i class="more">+</i></a></li><li><img src="/res/certificats/02.jpg"><a class="lightbox" href="/res/certificats/02.jpg"><i class="more">+</i></a></li><li><img src="/res/certificats/03.jpg"><a class="lightbox" href="/res/certificats/03.jpg"><i class="more">+</i></a></li><li><img src="/res/certificats/04.jpg"><a class="lightbox" href="/res/certificats/04.jpg"><i class="more">+</i></a></li></ul></div>', '<div class="portfolio-page portfolio-2column"><ul id="portfolio-list" data-animated="fadeIn"><li><img src="/res/certificats/01.jpg"><a class="lightbox" href="/res/certificats/01.jpg"><i class="more">+</i></a></li><li><img src="/res/certificats/02.jpg"><a class="lightbox" href="/res/certificats/02.jpg"><i class="more">+</i></a></li><li><img src="/res/certificats/03.jpg"><a class="lightbox" href="/res/certificats/03.jpg"><i class="more">+</i></a></li><li><img src="/res/certificats/04.jpg"><a class="lightbox" href="/res/certificats/04.jpg"><i class="more">+</i></a></li></ul></div>', NOW(), NOW()),
('/partenaires', 'Partenaires', NULL, NULL, 'Nos Partenaires', '<p><img src="/res/partenaires/01.jpg"></p><hr><p><img src="/res/partenaires/02.jpg"></p><hr><p><img src="/res/partenaires/03.jpg"></p><hr><p><img src="/res/partenaires/04.jpg"></p>', '<p><img src="/res/partenaires/01.jpg"></p><hr><p><img src="/res/partenaires/02.jpg"></p><hr><p><img src="/res/partenaires/03.jpg"></p><hr><p><img src="/res/partenaires/04.jpg"></p>', NOW(), NOW()),
('/contact', 'Contact', NULL, NULL, 'Contact', 'Contact', 'Contact', NOW(), NOW()),
('/sitemap', 'Plan du site', NULL, NULL, 'Plan du site', 'Plan du site', 'Plan du site', NOW(), NOW()),
('/news', 'Actualité', NULL, NULL, 'Actualité', 'Actualité', 'Actualité', NOW(), NOW()),
('/prods', 'Produits', NULL, NULL, 'Produits', 'Produits', 'Produits', NOW(), NOW()),
('/prodDocs', 'Téléchargement', NULL, NULL, 'Téléchargement', 'Téléchargement', 'Téléchargement', NOW(), NOW()),
('/login', 'Connexion', NULL, NULL, 'Connexion', 'Connexion', 'Connexion', NOW(), NOW()),
('/register', 'Inscription', NULL, NULL, 'Inscription', 'Inscription', 'Inscription', NOW(), NOW()),
('/myProfile', 'Mon Profile', NULL, NULL, 'Mon Profile', 'Mon Profile', 'Mon Profile', NOW(), NOW()),
('/lostPassword', 'Mot de passe perdu', NULL, NULL, 'Mot de passe perdu', 'Mot de passe perdu', 'Mot de passe perdu', NOW(), NOW());

INSERT INTO `a_banners` (`filename`, `rank`, `title_fr`, `alt_fr`, `dtcrea`, `dtupdate`) VALUES
('01.jpg', 100, 'Alluco', 'Alluco', NOW(), NOW()),
('02.jpg', 99, 'Alluco', 'Alluco', NOW(), NOW()),
('03.jpg', 98, 'Alluco', 'Alluco', NOW(), NOW()),
('04.jpg', 97, 'Alluco', 'Alluco', NOW(), NOW()),
('05.jpg', 96, 'Alluco', 'Alluco', NOW(), NOW()),
('06.jpg', 95, 'Alluco', 'Alluco', NOW(), NOW()),
('07.jpg', 94, 'Alluco', 'Alluco', NOW(), NOW()),
('08.jpg', 93, 'Alluco', 'Alluco', NOW(), NOW());

INSERT INTO `a_roles` (`name`, `description`, `dtcrea`, `dtupdate`) VALUES
('ROLE_USER', '<p>Utilisateur Simple</p>', NOW(), NOW()),
('ROLE_ADMIN', '<p>Administrateur</p>', NOW(), NOW()),
('ROLE_SUPERADMIN', '<p>SuperAdminsitrateur</p>', NOW(), NOW()),
('ROLE_SUPERSUPERADMIN', '<p>SuperSuperAdminsitrateur</p>', NOW(), NOW());

INSERT INTO `a_role_parents` (`child`, `parent`) VALUES
(2, 1),
(3, 2),
(4, 3);

INSERT INTO `a_langs` (`prefix`, `name`, `status`, `direction`, `dtcrea`, `dtupdate`) VALUES
('fr', 'Français', 1, 'ltr', NOW(), NOW()),
('en', 'English', 1, 'ltr', NOW(), NOW());

INSERT INTO `a_jobs` (`name_fr`, `name_en`, `status`, `dtcrea`, `dtupdate`) VALUES
('Autre', 'Other', 1, NOW(), NOW()),
('Architecte', 'Architect', 1, NOW(), NOW()),
('Comptoir', 'Comptoir', 1, NOW(), NOW()),
('Installateur', 'Installer', 1, NOW(), NOW()),
('Menuisier', 'Menuisier', 1, NOW(), NOW());

INSERT INTO `a_users` (`username`, `email`, `clearpassword`, `passwd`, `salt`, `lockout`, `logins`, `lastname`, `firstname`, `sexe`, `country`, `phone`, `mobile`, `avatar`, `lang_id`, `job_id`, `dtcrea`, `dtupdate`) VALUES
('seif', 'seif.salah@gmail.com', 'alphatester', 'nRlxfjNPJNwmLJ50/TmoZLBNQtSkgJfALg9KvVy3sSyd27gI46PLjw==', 'd373ec2ae8890256bb2471580087d373', 1, 0, 'Salah', 'Abdelkader Seifeddine', 3, 'CH', '+216.73465724', '+216.93969674', 'seif_553054d30c6eb.jpeg', 1, NULL, NOW(), NOW());

INSERT INTO `a_users_roles` (`user_id`, `role_id`) VALUES
(1, 4);

INSERT INTO `a_sitenews` (`pageurl`, `htmltitle_fr`, `metakeywords_fr`, `metadescription_fr`, `pagetitle_fr`, `pagecontent_fr`, `htmltitle_en`, `metakeywords_en`, `metadescription_en`, `pagetitle_en`, `pagecontent_en`, `thumb`,`dtcrea`, `dtupdate`) VALUES
('Salon_Medibat', 'Salon Medibat', 'Salon Medibat', 'Salon Medibat', 'Salon "Medibat"', '<p>Nous aurons tout le plaisir de vous accueillir sur notre stand <b><u>N°82 Hall 4</u></b> au Salon "<b>Medibat</b>" du 04 au 07 Mars pour découvrir nos nouveautés 2015.</p>', 'Salon Medibat', 'Salon Medibat', 'Salon Medibat', 'Salon "Medibat"', '<p>Nous aurons tout le plaisir de vous accueillir sur notre stand <b><u>N°82 Hall 4</u></b> au Salon "<b>Medibat</b>" du 04 au 07 Mars pour découvrir nos nouveautés 2015.</p>', '01.jpg', '2015-02-19 09:24:42', '2015-02-19 09:24:42');

INSERT INTO `a_productgroups` (`pageurl_full`, `pageurl`, `name_fr`, `htmltitle_fr`, `metakeywords_fr`, `metadescription_fr`, `pagetitle_fr`, `pagedescription_fr`, `name_en`, `htmltitle_en`, `metakeywords_en`, `metadescription_en`, `pagetitle_en`, `pagedescription_en`, `thumb`, `rank`, `dtcrea`, `dtupdate`, `parent_id`) VALUES
('Profiles_En_Alluminuim', 'Profiles_En_Alluminuim', 'Profilés en aluminium', 'Profilés en aluminium', 'Profilés en aluminium', 'Profilés en aluminium', 'Profilés en aluminium', 'Profilés en aluminium', 'Profilés en aluminium', 'Profilés en aluminium', 'Profilés en aluminium', 'Profilés en aluminium', 'Profilés en aluminium', 'Profilés en aluminium', '01.jpg', 100, NOW(), NOW(), NULL),
('Lames_Volet', 'Lames_Volet', 'Lames Volets', 'Lames Volets', 'Lames Volets', 'Lames Volets', 'Lames Volets', 'Lames Volets', 'Lames Volets', 'Lames Volets', 'Lames Volets', 'Lames Volets', 'Lames Volets', 'Lames Volets', '02.jpg', 99, NOW(), NOW(), NULL),
('Gardes_Corps', 'Gardes_Corps', 'Gardes Corps', 'Gardes Corps', 'Gardes Corps', 'Gardes Corps', 'Gardes Corps', 'Gardes Corps', 'Gardes Corps', 'Gardes Corps', 'Gardes Corps', 'Gardes Corps', 'Gardes Corps', 'Gardes Corps', '03.jpg', 98, NOW(), NOW(), NULL),
('Protection_Solaire', 'Protection_Solaire', 'Protection Solaire', 'Protection Solaire', 'Protection Solaire', 'Protection Solaire', 'Protection Solaire', 'Protection Solaire', 'Protection Solaire', 'Protection Solaire', 'Protection Solaire', 'Protection Solaire', 'Protection Solaire', 'Protection Solaire', '04.jpg', 97, NOW(), NOW(), NULL),
('Grilles_Ventilation', 'Grilles_Ventilation', 'Grilles de Ventilation', 'Grilles de Ventilation', 'Grilles de Ventilation', 'Grilles de Ventilation', 'Grilles de Ventilation', 'Grilles de Ventilation', 'Grilles de Ventilation', 'Grilles de Ventilation', 'Grilles de Ventilation', 'Grilles de Ventilation', 'Grilles de Ventilation', 'Grilles de Ventilation', '05.gif', 96, NOW(), NOW(), NULL),
('Systemes_Nice', 'Systemes_Nice', 'Systèmes Nice', 'Systèmes Nice', 'Systèmes Nice', 'Systèmes Nice', 'Systèmes Nice', 'Systèmes Nice', 'Systèmes Nice', 'Systèmes Nice', 'Systèmes Nice', 'Systèmes Nice', 'Systèmes Nice', 'Systèmes Nice', '06.jpg', 95, NOW(), NOW(), NULL),
('Protection_Solaire/Brise_Soleil', 'Brise_Soleil', 'Brise Soleil', 'Brise Soleil', 'Brise Soleil', 'Brise Soleil', 'Brise Soleil', 'Brise Soleil', 'Brise Soleil', 'Brise Soleil', 'Brise Soleil', 'Brise Soleil', 'Brise Soleil', 'Brise Soleil', '07.jpg', 95, NOW(), NOW(), 4),
('Systemes_Nice/Moteur_Nice', 'Moteur_Nice', 'Moteurs Nice ', 'Moteurs Nice', 'Moteurs Nice', 'Moteurs Nice', 'Moteurs Nice', 'Moteurs Nice', 'Moteurs Nice', 'Moteurs Nice', 'Moteurs Nice', 'Moteurs Nice', 'Systèmes Nice', 'Systèmes Nice', '08.jpg', 95, NOW(), NOW(), 6),
('Systemes_Nice/Emetteurs', 'Emetteurs', 'Emetteurs', 'Emetteurs', 'Emetteurs', 'Emetteurs', 'Emetteurs', 'Emetteurs', 'Emetteurs', 'Emetteurs', 'Emetteurs', 'Emetteurs', 'Emetteurs', 'Emetteurs', '09.jpg', 95, NOW(), NOW(), 6);

INSERT INTO `a_products` (`pageurl`, `name_fr`, `htmltitle_fr`, `metakeywords_fr`, `metadescription_fr`, `pagetitle_fr`, `pagedescription_fr`, `name_en`, `htmltitle_en`, `metakeywords_en`, `metadescription_en`, `pagetitle_en`, `pagedescription_en`, `rank`, `productgroup_id`, `dtcrea`, `dtupdate`) VALUES
('al_220', 'AL 220', 'AL 220', 'AL 220', 'AL 220', 'AL 220', 'AL 220', 'AL 220', 'AL 220', 'AL 220', 'AL 220', 'AL 220', 'AL 220', 100, 1, NOW(), NOW()),
('al_450', 'AL 450', 'AL 450', 'AL 450', 'AL 450', 'AL 450', 'AL 450', 'AL 450', 'AL 450', 'AL 450', 'AL 450', 'AL 450', 'AL 450', 99, 1, NOW(), NOW()),
('lm_55_silencieuse', 'LM 55 Silencieuse', 'LM 55 Silencieuse', 'LM 55 Silencieuse', 'LM 55 Silencieuse', 'LM 55 Silencieuse', 'LM 55 Silencieuse', 'LM 55 Silencieuse', 'LM 55 Silencieuse', 'LM 55 Silencieuse', 'LM 55 Silencieuse', 'LM 55 Silencieuse', 'LM 55 Silencieuse', 98, 2, NOW(), NOW()),
('lm_55_injectee', 'LM 55 Injectée', 'LM 55 Injectée', 'LM 55 Injectée', 'LM 55 Injectée', 'LM 55 Injectée', 'LM 55 Injectée', 'LM 55 Injectée', 'LM 55 Injectée', 'LM 55 Injectée', 'LM 55 Injectée', 'LM 55 Injectée', 'LM 55 Injectée', 97, 2, NOW(), NOW()),
('lm_60', 'LM 60', 'LM 60', 'LM 60', 'LM 60', 'LM 60', 'LM 60',  'LM 60', 'LM 60', 'LM 60', 'LM 60', 'LM 60', 'LM 60', 96, 2, NOW(), NOW()),
('lm_100', 'LM 100', 'LM 100', 'LM 100', 'LM 100', 'LM 100', 'LM 100', 'LM 100', 'LM 100', 'LM 100', 'LM 100', 'LM 100', 'LM 100', 95, 2, NOW(), NOW()),
('lm_757', 'LM 757', 'LM 757', 'LM 757', 'LM 757', 'LM 757', 'LM 757', 'LM 757', 'LM 757', 'LM 757', 'LM 757', 'LM 757', 'LM 757', 94, 2, NOW(), NOW()),
('f50', 'F50', 'F50', 'F50', 'F50', 'F50', 'F50','F50', 'F50', 'F50', 'F50', 'F50', 'F50', 93, 3, NOW(), NOW()),
('crystal_line', 'Crystal Line', 'Crystal Line', 'Crystal Line', 'Crystal Line', 'Crystal Line', 'Crystal Line', 'Crystal Line', 'Crystal Line', 'Crystal Line', 'Crystal Line', 'Crystal Line', 'Crystal Line', 92, 3, NOW(), NOW()),
('brise_soleil_lame_c', 'Lame C', 'Lame C', 'Lame C', 'Lame C', 'Lame C', 'Lame C', 'Lame C', 'Lame C', 'Lame C', 'Lame C', 'Lame C', 'Lame C', 91, 7, NOW(), NOW()),
('brise_soleil_lame_34z', 'Lame 34Z', 'Lame 34Z', 'Lame 34Z', 'Lame 34Z', 'Lame 34Z', 'Lame 34Z', 'Lame 34Z', 'Lame 34Z', 'Lame 34Z', 'Lame 34Z', 'Lame 34Z', 'Lame 34Z', 90, 7, NOW(), NOW()),
('brise_soleil_lame_65z', 'Lame 65Z', 'Lame 65Z', 'Lame 65Z', 'Lame 65Z', 'Lame 65Z', 'Lame 65Z', 'Lame 65Z', 'Lame 65Z', 'Lame 65Z', 'Lame 65Z', 'Lame 65Z', 'Lame 65Z', 89, 7, NOW(), NOW()),
('screen', 'Screen', 'Screen', 'Screen', 'Screen', 'Screen', 'Screen', 'Screen', 'Screen', 'Screen', 'Screen', 'Screen', 'Screen', 88, 4, NOW(), NOW()),
('toiture_terrasse', 'Toiture de Terrasse', 'Toiture de Terrasse', 'Toiture de Terrasse', 'Toiture de Terrasse', 'Toiture de Terrasse', 'Toiture de Terrasse', 'Toiture de Terrasse', 'Toiture de Terrasse', 'Toiture de Terrasse', 'Toiture de Terrasse', 'Toiture de Terrasse', 'Toiture de Terrasse', 87, 4, NOW(), NOW()),
('grille_a_poser_en_applique', 'Grille à poser en applique', 'Grille à poser en applique', 'Grille à poser en applique', 'Grille à poser en applique', 'Grille à poser en applique', 'Grille à poser en applique', 'Grille à poser en applique', 'Grille à poser en applique', 'Grille à poser en applique', 'Grille à poser en applique', 'Grille à poser en applique', 'Grille à poser en applique', 86, 5, NOW(), NOW()),
('grille_a_encastrer ', 'Grille à encastrer ', 'Grille à encastrer ', 'Grille à encastrer ', 'Grille à encastrer ', 'Grille à encastrer ', 'Grille à encastrer ', 'Grille à encastrer ', 'Grille à encastrer ', 'Grille à encastrer ', 'Grille à encastrer ', 'Grille à encastrer ', 'Grille à encastrer ', 85, 5, NOW(), NOW()),
('moteur_era_m', 'Moteur Era M', 'Moteur Era M', 'Moteur Era M', 'Moteur Era M', 'Moteur Era M', 'Moteur Era M', 'Moteur Era M', 'Moteur Era M', 'Moteur Era M', 'Moteur Era M', 'Moteur Era M', 'Moteur Era M', 84, 8, NOW(), NOW()),
('moteur_neo_l', 'Moteur Neo L', 'Moteur Neo L', 'Moteur Neo L', 'Moteur Neo L', 'Moteur Neo L', 'Moteur Neo L', 'Moteur Neo L', 'Moteur Neo L', 'Moteur Neo L', 'Moteur Neo L', 'Moteur Neo L', 'Moteur Neo L', 83, 8, NOW(), NOW()),
('era_p', 'Era P', 'Era P', 'Era P', 'Era P', 'Era P', 'Era P','Era P', 'Era P', 'Era P', 'Era P', 'Era P', 'Era P', 82, 9, NOW(), NOW()),
('era_miniway', 'Era MiniWay', 'Era MiniWay', 'Era MiniWay', 'Era MiniWay', 'Era MiniWay', 'Era MiniWay', 'Era MiniWay', 'Era MiniWay', 'Era MiniWay', 'Era MiniWay', 'Era MiniWay', 'Era MiniWay', 81, 9, NOW(), NOW());

