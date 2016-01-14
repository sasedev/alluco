

CREATE TABLE `a_constant_strs` (
    `id`                                                                    integer unsigned auto_increment not null,
    `name`                                                                  text NOT NULL,
    `val`                                                                   text NOT NULL,
    `description`                                                           text NULL,
    `created_at`                                                            datetime NULL,
    `updated_at`                                                            datetime NULL,
    CONSTRAINT `pk_a_constant_strs` PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARACTER SET=utf8;
    
CREATE TABLE `a_constant_ints` (
    `id`                                                                    integer unsigned auto_increment not null,
    `name`                                                                  text NOT NULL,
    `val`                                                                   integer NOT NULL,
    `description`                                                           text NULL,
    `created_at`                                                            datetime NULL,
    `updated_at`                                                            datetime NULL,
    CONSTRAINT `pk_a_constant_ints` PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARACTER SET=utf8;
    
CREATE TABLE `a_constant_floats` (
    `id`                                                                    integer unsigned auto_increment not null,
    `name`                                                                  text NOT NULL,
    `val`                                                                   float NOT NULL,
    `description`                                                           text NULL,
    `created_at`                                                            datetime NULL,
    `updated_at`                                                            datetime NULL,
    CONSTRAINT `pk_a_constant_floats` PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARACTER SET=utf8;

CREATE TABLE `a_langs` (
    `id`                                                                    integer unsigned auto_increment not null,
    `locale`                                                                text NOT NULL,
    `status`                                                                integer NOT NULL DEFAULT 1,
    `created_at`                                                            datetime NULL,
    `updated_at`                                                            datetime NULL,
    CONSTRAINT `pk_a_langs` PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARACTER SET=utf8;

CREATE TABLE `a_jobs` (
    `id`                                                                    integer unsigned auto_increment not null,
    `name`                                                                  text NOT NULL,
    `status`                                                                integer NOT NULL DEFAULT 1,
    `rank`                                                                  integer NOT NULL DEFAULT 100,
    `created_at`                                                            datetime NULL,
    `updated_at`                                                            datetime NULL,
    CONSTRAINT `pk_a_jobs` PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARACTER SET=utf8;

CREATE TABLE `a_job_i18ns` (
    `lang_id`                                                               integer unsigned NOT null,
    `job_id`                                                                integer unsigned NOT null,
    `name`                                                                  text NOT NULL,
    `created_at`                                                            datetime NULL,
    `updated_at`                                                            datetime NULL,
    CONSTRAINT `pk_a_job_i18ns` PRIMARY KEY (`lang_id`, `job_id`),
    CONSTRAINT `fk_a_job_i18ns_lang` FOREIGN KEY (`lang_id`) REFERENCES `a_langs` (`id`) ON UPDATE CASCADE ON DELETE CASCADE,
    CONSTRAINT `fk_a_job_i18ns_job` FOREIGN KEY (`job_id`) REFERENCES `a_jobs` (`id`) ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARACTER SET=utf8;

CREATE TABLE `a_roles` (
    `id`                                                                    integer unsigned auto_increment not null,
    `name`                                                                  text NOT NULL,
    `description`                                                           text NULL,
    `created_at`                                                            datetime NULL,
    `updated_at`                                                            datetime NULL,
    CONSTRAINT `pk_a_roles` PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARACTER SET=utf8;

CREATE TABLE `a_role_parents` (
    `child`                                                                 integer unsigned NOT NULL,
    `parent`                                                                integer unsigned NOT NULL,
    CONSTRAINT `pk_a_role_parents` PRIMARY KEY (`child`, `parent`),
    CONSTRAINT `fk_a_role_parents_child` FOREIGN KEY (`child`) REFERENCES `a_roles` (`id`) ON UPDATE CASCADE ON DELETE CASCADE,
    CONSTRAINT `fk_a_role_parents_parend` FOREIGN KEY (`parent`) REFERENCES `a_roles` (`id`) ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARACTER SET=utf8;

CREATE TABLE `a_users` (
    `id`                                                                    integer unsigned auto_increment not null,
    `username`                                                              text NOT NULL,
    `email`                                                                 text NULL,
    `clearpassword`                                                         text NULL,
    `passwd`                                                                text NULL,
    `salt`                                                                  text NULL,
    `recoverycode`                                                          text NULL,
    `recoveryexpiration`                                                    datetime NULL,
    `lockout`                                                               integer NOT NULL DEFAULT 1,
    `logins`                                                                integer NOT NULL DEFAULT 0,
    `lastlogin`                                                             datetime NULL,
    `lastactivity`                                                          datetime NULL,
    `lastname`                                                              text NULL,
    `firstname`                                                             text NULL,
    `sexe`                                                                  integer NULL,
    `birthday`                                                              date NULL,
    `strnum`                                                                text NULL,
    `address`                                                               text NULL,
    `address2`                                                              text NULL,
    `town`                                                                  text NULL,
    `zipcode`                                                               text NULL,
    `country`                                                               text NULL,
    `fax`                                                                   text NULL,
    `phone`                                                                 text NULL,
    `mobile`                                                                text NULL,
    `company`                                                               text NULL,
    `fisc`                                                                  text NULL,
    `usertype`                                                              integer not null default 1,
    `otherinfo`                                                             text NULL,
    `avatar`                                                                text NULL,
    `job_id`                                                                integer unsigned null,
    `lang_id`                                                               integer unsigned NULL,
    `created_at`                                                            datetime NULL,
    `updated_at`                                                            datetime NULL,
    CONSTRAINT `pk_a_users` PRIMARY KEY (`id`),
    CONSTRAINT `fk_a_users_job` FOREIGN KEY (`job_id`) REFERENCES `a_jobs` (`id`) ON UPDATE CASCADE ON DELETE SET NULL,
    CONSTRAINT `fk_a_users_lang` FOREIGN KEY (`lang_id`) REFERENCES `a_langs` (`id`) ON UPDATE CASCADE ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARACTER SET=utf8;

CREATE TABLE `a_users_roles` (
    `user_id`                                                               integer unsigned NOT NULL,
    `role_id`                                                               integer unsigned NOT NULL,
    CONSTRAINT `pk_a_users_roles` PRIMARY KEY (`user_id`, `role_id`),
    CONSTRAINT `fk_a_users_roles_user` FOREIGN KEY (`user_id`) REFERENCES `a_users` (`id`) ON UPDATE CASCADE ON DELETE CASCADE,
    CONSTRAINT `fk_a_users_roles_role` FOREIGN KEY (`role_id`) REFERENCES `a_roles` (`id`) ON UPDATE CASCADE ON DELETE CASCADE
    
) ENGINE=InnoDB DEFAULT CHARACTER SET=utf8;

CREATE TABLE `a_user_quotations` (
    `id`                                                                    integer unsigned auto_increment not null,
    `quotation`                                                             text NOT NULL,
    `json_values`                                                           text NOT NULL,
    `user_id`                                                               integer unsigned NOT NULL,
    `created_at`                                                            datetime NULL,
    `updated_at`                                                            datetime NULL,
    CONSTRAINT `pk_a_user_quotations` PRIMARY KEY (`id`),
    CONSTRAINT `fk_a_user_quotations_user` FOREIGN KEY (`user_id`) REFERENCES `a_users` (`id`) ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARACTER SET=utf8;

CREATE TABLE `a_user_quotation_answers` (
    `id`                                                                    integer unsigned auto_increment not null,
    `filename`                                                              text NOT NULL,
    `filemimetype`                                                          text NOT NULL,
    `filemd5`                                                               text NOT NULL,
    `filesize`                                                              integer NOT NULL DEFAULT 0,
    `fileoname`                                                             text NOT NULL,
    `filedls`                                                               integer NOT NULL DEFAULT 0,
    `comment`                                                               text NULL,
    `quotation_id`                                                          integer unsigned NOT NULL,
    `created_at`                                                            datetime NULL,
    `updated_at`                                                            datetime NULL,
    CONSTRAINT `pk_a_user_quotation_answers` PRIMARY KEY (`id`),
    CONSTRAINT `fk_a_user_quotation_answers_quotation` FOREIGN KEY (`quotation_id`) REFERENCES `a_user_quotations` (`id`) ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARACTER SET=utf8;

CREATE TABLE `a_banners` (
    `id`                                                                    integer unsigned auto_increment not null,
    `status`                                                                integer NOT NULL DEFAULT 1,
    `filename`                                                              text NOT NULL,
    `rank`                                                                  integer NOT NULL DEFAULT 100,
    `title`                                                                 text NULL,
    `alt`                                                                   text NULL,
    `created_at`                                                            datetime NULL,
    `updated_at`                                                            datetime NULL,
    CONSTRAINT `pk_a_banners` PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARACTER SET=utf8;

CREATE TABLE `a_banner_i18ns` (
    `lang_id`                                                               integer unsigned NOT null,
    `banner_id`                                                             integer unsigned NOT null,
    `title`                                                                 text NULL,
    `alt`                                                                   text NULL,
    `created_at`                                                            datetime NULL,
    `updated_at`                                                            datetime NULL,
    CONSTRAINT `pk_a_banner_i18ns` PRIMARY KEY (`lang_id`, `banner_id`),
    CONSTRAINT `fk_a_banner_i18ns_lang` FOREIGN KEY (`lang_id`) REFERENCES `a_langs` (`id`) ON UPDATE CASCADE ON DELETE CASCADE,
    CONSTRAINT `fk_a_banner_i18ns_banner` FOREIGN KEY (`banner_id`) REFERENCES `a_banners` (`id`) ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARACTER SET=utf8;

CREATE TABLE `a_certifs` (
    `id`                                                                    integer unsigned auto_increment not null,
    `status`                                                                integer NOT NULL DEFAULT 1,
    `filename`                                                              text NOT NULL,
    `rank`                                                                  integer NOT NULL DEFAULT 100,
    `title`                                                                 text NULL,
    `created_at`                                                            datetime NULL,
    `updated_at`                                                            datetime NULL,
    CONSTRAINT `pk_a_certifs` PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARACTER SET=utf8;

CREATE TABLE `a_certif_i18ns` (
    `lang_id`                                                               integer unsigned NOT null,
    `certif_id`                                                             integer unsigned NOT null,
    `title`                                                                 text NULL,
    `created_at`                                                            datetime NULL,
    `updated_at`                                                            datetime NULL,
    CONSTRAINT `pk_a_certif_i18ns` PRIMARY KEY (`lang_id`, `certif_id`),
    CONSTRAINT `fk_a_certif_i18ns_lang` FOREIGN KEY (`lang_id`) REFERENCES `a_langs` (`id`) ON UPDATE CASCADE ON DELETE CASCADE,
    CONSTRAINT `fk_a_certif_i18ns_certif` FOREIGN KEY (`certif_id`) REFERENCES `a_certifs` (`id`) ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARACTER SET=utf8;

CREATE TABLE `a_staticpages` (
    `id`                                                                    integer unsigned auto_increment not null,
    `pageurl`                                                               text NOT NULL,
    `metatitle`                                                             text NULL,
    `metakeywords`                                                          text NULL,
    `metadescription`                                                       text NULL,
    `pagetitle`                                                             text NULL,
    `breadcrumb`                                                            text NULL,
    `pagecontent`                                                           text NULL,
    `created_at`                                                            datetime NULL,
    `updated_at`                                                            datetime NULL,
    CONSTRAINT `pk_a_staticpages` PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARACTER SET=utf8;

CREATE TABLE `a_staticpage_i18ns` (
    `lang_id`                                                               integer unsigned NOT null,
    `staticpage_id`                                                         integer unsigned NOT null,
    `metatitle`                                                             text NULL,
    `metakeywords`                                                          text NULL,
    `metadescription`                                                       text NULL,
    `pagetitle`                                                             text NULL,
    `breadcrumb`                                                            text NULL,
    `pagecontent`                                                           text NULL,
    `created_at`                                                            datetime NULL,
    `updated_at`                                                            datetime NULL,
    CONSTRAINT `pk_a_staticpage_i18ns` PRIMARY KEY (`lang_id`, `staticpage_id`),
    CONSTRAINT `fk_a_staticpage_i18ns_lang` FOREIGN KEY (`lang_id`) REFERENCES `a_langs` (`id`) ON UPDATE CASCADE ON DELETE CASCADE,
    CONSTRAINT `fk_a_staticpage_i18ns_staticpage` FOREIGN KEY (`staticpage_id`) REFERENCES `a_staticpages` (`id`) ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARACTER SET=utf8;

CREATE TABLE `a_sitenews` (
    `id`                                                                    integer unsigned auto_increment not null,
    `pageurl`                                                               text NOT NULL,
    `thumb`                                                                 text NULL,
    `metatitle`                                                             text NULL,
    `metakeywords`                                                          text NULL,
    `metadescription`                                                       text NULL,
    `pagetitle`                                                             text NULL,
    `breadcrumb`                                                            text NULL,
    `pagecontent`                                                           text NULL,
    `thumb_alt`                                                             text NULL,
    `thumb_title`                                                           text NULL,
    `created_at`                                                            datetime NULL,
    `updated_at`                                                            datetime NULL,
    CONSTRAINT `pk_a_sitenews` PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARACTER SET=utf8;

CREATE TABLE `a_sitenew_i18ns` (
    `lang_id`                                                               integer unsigned NOT null,
    `sitenew_id`                                                            integer unsigned NOT null,
    `metatitle`                                                             text NULL,
    `metakeywords`                                                          text NULL,
    `metadescription`                                                       text NULL,
    `pagetitle`                                                             text NULL,
    `breadcrumb`                                                            text NULL,
    `pagecontent`                                                           text NULL,
    `thumb_alt`                                                             text NULL,
    `thumb_title`                                                           text NULL,
    `created_at`                                                            datetime NULL,
    `updated_at`                                                            datetime NULL,
    CONSTRAINT `pk_a_sitenew_i18ns` PRIMARY KEY (`lang_id`, `sitenew_id`),
    CONSTRAINT `fk_a_sitenew_i18ns_lang` FOREIGN KEY (`lang_id`) REFERENCES `a_langs` (`id`) ON UPDATE CASCADE ON DELETE CASCADE,
    CONSTRAINT `fk_a_sitenew_i18ns_sitenew` FOREIGN KEY (`sitenew_id`) REFERENCES `a_sitenews` (`id`) ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARACTER SET=utf8;

CREATE TABLE `a_products` (
    `id`                                                                    integer unsigned auto_increment not null,
    `pageurl`                                                               text NOT NULL,
    `pageurl_full`                                                          text NOT NULL,
    `name`                                                                  text NOT NULL,
    `metatitle`                                                             text NULL,
    `metakeywords`                                                          text NULL,
    `metadescription`                                                       text NULL,
    `pagetitle`                                                             text NULL,
    `breadcrumb`                                                            text NULL,
    `pagecontent`                                                           text NULL,
    `thumb_alt`                                                             text NULL,
    `thumb_title`                                                           text NULL,
    `thumb`                                                                 text NULL,
    `rank`                                                                  integer NOT NULL DEFAULT 100,
    `product_id`                                                            integer unsigned NULL,
    `created_at`                                                            datetime NULL,
    `updated_at`                                                            datetime NULL,
    CONSTRAINT `pk_a_products` PRIMARY KEY (`id`),
    CONSTRAINT `pk_a_products_product` FOREIGN KEY (`product_id`) REFERENCES `a_products` (`id`) ON UPDATE CASCADE ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARACTER SET=utf8;

CREATE TABLE `a_product_associates` (
    `child`                                                                 integer unsigned NOT NULL,
    `parent`                                                                integer unsigned NOT NULL,
    CONSTRAINT `pk_a_product_associates` PRIMARY KEY (`child`, `parent`),
    CONSTRAINT `fk_a_product_associates_child` FOREIGN KEY (`child`) REFERENCES `a_products` (`id`) ON UPDATE CASCADE ON DELETE CASCADE,
    CONSTRAINT `fk_a_product_associates_parent` FOREIGN KEY (`parent`) REFERENCES `a_products` (`id`) ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARACTER SET=utf8;

CREATE TABLE `a_product_i18ns` (
    `lang_id`                                                               integer unsigned NOT null,
    `product_id`                                                            integer unsigned NOT null,
    `name`                                                                  text NOT NULL,
    `metatitle`                                                             text NULL,
    `metakeywords`                                                          text NULL,
    `metadescription`                                                       text NULL,
    `pagetitle`                                                             text NULL,
    `breadcrumb`                                                            text NULL,
    `pagecontent`                                                           text NULL,
    `thumb_alt`                                                             text NULL,
    `thumb_title`                                                           text NULL,
    `created_at`                                                            datetime NULL,
    `updated_at`                                                            datetime NULL,
    CONSTRAINT `pk_a_product_i18ns` PRIMARY KEY (`lang_id`, `product_id`),
    CONSTRAINT `fk_a_product_i18ns_lang` FOREIGN KEY (`lang_id`) REFERENCES `a_langs` (`id`) ON UPDATE CASCADE ON DELETE CASCADE,
    CONSTRAINT `fk_a_product_i18ns_product` FOREIGN KEY (`product_id`) REFERENCES `a_products` (`id`) ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARACTER SET=utf8;

CREATE TABLE `a_productpics` (
    `id`                                                                    integer unsigned auto_increment not null,
    `filename`                                                              text NOT NULL,
    `rank`                                                                  integer NOT NULL DEFAULT 100,
    `title`                                                                 text NULL,
    `alt`                                                                   text NULL,
    `product_id`                                                            integer unsigned NOT NULL,
    `created_at`                                                            datetime NULL,
    `updated_at`                                                            datetime NULL,
    CONSTRAINT `pk_a_productpics` PRIMARY KEY (`id`),
    CONSTRAINT `fk_a_productpics_product` FOREIGN KEY (`product_id`) REFERENCES `a_products` (`id`) ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARACTER SET=utf8;

CREATE TABLE `a_productpic_i18ns` (
    `lang_id`                                                               integer unsigned NOT null,
    `productpic_id`                                                         integer unsigned NOT null,
    `title`                                                                 text NULL,
    `alt`                                                                   text NULL,
    `created_at`                                                            datetime NULL,
    `updated_at`                                                            datetime NULL,
    CONSTRAINT `pk_a_productpic_i18ns` PRIMARY KEY (`lang_id`, `productpic_id`),
    CONSTRAINT `fk_a_productpic_i18ns_lang` FOREIGN KEY (`lang_id`) REFERENCES `a_langs` (`id`) ON UPDATE CASCADE ON DELETE CASCADE,
    CONSTRAINT `fk_a_productpic_i18ns_productpic` FOREIGN KEY (`productpic_id`) REFERENCES `a_productpics` (`id`) ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARACTER SET=utf8;

CREATE TABLE `a_productdocs` (
    `id`                                                                    integer unsigned auto_increment not null,
    `filename`                                                              text NOT NULL,
    `filemimetype`                                                          text NOT NULL,
    `filemd5`                                                               text NOT NULL,
    `filesize`                                                              integer NOT NULL DEFAULT 0,
    `fileoname`                                                             text NOT NULL,
    `filedls`                                                               integer NOT NULL DEFAULT 0,
    `rank`                                                                  integer NOT NULL DEFAULT 100,
    `title`                                                                 text NULL,
    `product_id`                                                            integer unsigned NOT NULL,
    `created_at`                                                            datetime NULL,
    `updated_at`                                                            datetime NULL,
    CONSTRAINT `pk_a_productdocs` PRIMARY KEY (`id`),
    CONSTRAINT `fk_a_productdocs_product` FOREIGN KEY (`product_id`) REFERENCES `a_products` (`id`) ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARACTER SET=utf8;

CREATE TABLE `a_productdoc_i18ns` (
    `lang_id`                                                               integer unsigned NOT null,
    `productdoc_id`                                                         integer unsigned NOT null,
    `title`                                                                 text NULL,
    `created_at`                                                            datetime NULL,
    `updated_at`                                                            datetime NULL,
    CONSTRAINT `pk_a_productdoc_i18ns` PRIMARY KEY (`lang_id`, `productdoc_id`),
    CONSTRAINT `fk_a_productdoc_i18ns_lang` FOREIGN KEY (`lang_id`) REFERENCES `a_langs` (`id`) ON UPDATE CASCADE ON DELETE CASCADE,
    CONSTRAINT `fk_a_productdoc_i18ns_productdoc` FOREIGN KEY (`productdoc_id`) REFERENCES `a_productdocs` (`id`) ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARACTER SET=utf8;

CREATE TABLE `a_contacts` (
    `id`                                                                    integer unsigned auto_increment not null,
    `firstname`                                                             text NOT NULL,
    `lastname`                                                              text NOT NULL,
    `email`                                                                 text NOT NULL,
    `phone`                                                                 text NULL,
    `company`                                                               text NULL,
    `job_id`                                                                integer unsigned null,
    `subject`                                                               text NULL,
    `msg`                                                                   text NULL,
    `created_at`                                                            datetime NULL,
    `updated_at`                                                            datetime NULL,
    CONSTRAINT `pk_a_contacts` PRIMARY KEY (`id`),
    CONSTRAINT `fk_a_contacts_job` FOREIGN KEY (`job_id`) REFERENCES `a_jobs` (`id`) ON UPDATE CASCADE ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARACTER SET=utf8;
