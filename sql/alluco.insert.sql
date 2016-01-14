INSERT INTO `a_langs` (`locale`, `status`, `created_at`, `updated_at`) VALUES
('fr', 1, NOW(), NOW()),
('en', 1, NOW(), NOW());

INSERT INTO `a_jobs` (`name`, `status`, `created_at`, `updated_at`) VALUES
('Autre', 1, NOW(), NOW()),
('Architecte', 1, NOW(), NOW()),
('Comptoir', 1, NOW(), NOW()),
('Installateur', 1, NOW(), NOW()),
('Menuisier', 1, NOW(), NOW());

INSERT INTO `a_job_i18ns` (`lang_id`, `job_id`, `name`, `created_at`, `updated_at`) VALUES
(1, 1, 'Autre', NOW(), NOW()),
(2, 1, 'Other', NOW(), NOW()),
(1, 2, 'Architecte', NOW(), NOW()),
(2, 2, 'Architect', NOW(), NOW()),
(1, 3, 'Comptoir', NOW(), NOW()),
(2, 3, 'Comptoir', NOW(), NOW()),
(1, 4, 'Installateur', NOW(), NOW()),
(2, 4, 'Installer', NOW(), NOW()),
(1, 5, 'Menuisier', NOW(), NOW()),
(2, 5, 'Menuisier', NOW(), NOW());

INSERT INTO `a_roles` (`name`, `description`, `created_at`, `updated_at`) VALUES
('ROLE_USER', '<p>Utilisateur Simple</p>', NOW(), NOW()),
('ROLE_ADMIN', '<p>Administrateur</p>', NOW(), NOW()),
('ROLE_SUPERADMIN', '<p>SuperAdminsitrateur</p>', NOW(), NOW()),
('ROLE_SUPERSUPERADMIN', '<p>SuperSuperAdminsitrateur</p>', NOW(), NOW());

INSERT INTO `a_role_parents` (`child`, `parent`) VALUES
(2, 1),
(3, 2),
(4, 3);

INSERT INTO `a_users` (`username`, `email`, `clearpassword`, `passwd`, `salt`, `lockout`, `logins`, `lastname`, `firstname`, `sexe`, `country`, `phone`, `mobile`, `avatar`, `lang_id`, `job_id`, `created_at`, `updated_at`) VALUES
('seif', 'seif.salah@gmail.com', 'alphatester', 'nRlxfjNPJNwmLJ50/TmoZLBNQtSkgJfALg9KvVy3sSyd27gI46PLjw==', 'd373ec2ae8890256bb2471580087d373', 1, 0, 'Salah', 'Abdelkader Seifeddine', 3, 'CH', '+216.73465724', '+216.93969674', 'seif_553054d30c6eb.jpeg', 1, NULL, NOW(), NOW());

INSERT INTO `a_users_roles` (`user_id`, `role_id`) VALUES
(1, 4);


INSERT INTO `a_staticpages` (`pageurl`, `metatitle`, `metakeywords`, `metadescription`, `pagetitle`, `breadcrumb`, `pagecontent`, `created_at`, `updated_at`) VALUES
('/', 'Accueil', 'Alluco.com', 'Alluco.com', 'Bienvenue', 'Accueil', '<p>Alluco se positionne sur le march&eacute; de l&rsquo;aluminium par des concepts innovants et s&rsquo;adaptant parfaitement aux exigences de l&rsquo;architecture contemporaine.</p><p>Par son choix diversifi&eacute; de produits, Alluco s&rsquo;associe &agrave; vos Projets et vous offre une solution en aluminium pertinente et compl&egrave;te r&eacute;pondant &agrave; 3 principes fondamentaux&nbsp;:</p><ol><li>Une Am&eacute;lioration de la performance &eacute;nerg&eacute;tique des b&acirc;timents&nbsp;: l&rsquo;Economie d&rsquo;&eacute;nergie,</li><li>Une habitation saine et confortable,</li><li>Un design splendide</li></ol><p>&nbsp;</p><p><br />La large gamme de produit d&rsquo;Alluco comprend&nbsp;:</p><ul><li>Des s&eacute;ries compl&egrave;tes de syst&egrave;mes de profil&eacute;s en aluminium&nbsp;: Coulissant, Oscillo-battant, Mur Rideaux&hellip;.</li><li>Des lames volet roulant extrud&eacute;es ou inject&eacute;es assurant votre s&eacute;curit&eacute;.</li><li>Les syst&egrave;mes de garde-corps des balcons, v&eacute;randas, et les escaliers con&ccedil;us par des profil&eacute;s en aluminium anodis&eacute;s aspect inox ou Vitr&eacute;s</li><li>Des syst&egrave;mes de protection solaire tel que Brises soleil fixes ou coulissantes pergolas, Screens, Camargue, vous permettant de profiter de votre espace ext&eacute;rieur &agrave; tout moment de l&rsquo;ann&eacute;e.</li></ul>', NOW(), NOW()),
('/certificats', 'Certificats', NULL, NULL, 'Nos Certificats', 'Nos Certificats', '<div class="portfolio-page portfolio-2column"><ul id="portfolio-list" data-animated="fadeIn"><li><img src="/res/certificats/01.jpg"><a class="lightbox" href="/res/certificats/01.jpg"><i class="more">+</i></a></li><li><img src="/res/certificats/02.jpg"><a class="lightbox" href="/res/certificats/02.jpg"><i class="more">+</i></a></li><li><img src="/res/certificats/03.jpg"><a class="lightbox" href="/res/certificats/03.jpg"><i class="more">+</i></a></li><li><img src="/res/certificats/04.jpg"><a class="lightbox" href="/res/certificats/04.jpg"><i class="more">+</i></a></li></ul></div>', NOW(), NOW()),
('/partenaires', 'Partenaires', NULL, NULL, 'Nos Partenaires', 'Nos Partenaires', '<p><img src="/res/partenaires/01.jpg"></p><hr><p><img src="/res/partenaires/02.jpg"></p><hr><p><img src="/res/partenaires/03.jpg"></p><hr><p><img src="/res/partenaires/04.jpg"></p>', NOW(), NOW()),
('/contact', 'Contact', NULL, NULL, 'Contact', 'Contact', 'Contact', NOW(), NOW()),
('/sitemap', 'Plan du site', NULL, NULL, 'Plan du site', 'Plan du site', 'Plan du site', NOW(), NOW()),
('/news', 'Actualité', NULL, NULL, 'Actualité', 'Actualité', 'Actualité', NOW(), NOW()),
('/prods', 'Produits', NULL, NULL, 'Produits', 'Produits', 'Produits', NOW(), NOW()),
('/docs', 'Téléchargement', NULL, NULL, 'Téléchargement', 'Téléchargement', 'Téléchargement', NOW(), NOW()),
('/login', 'Connexion', NULL, NULL, 'Connexion', 'Connexion', 'Connexion', NOW(), NOW()),
('/register', 'Inscription', NULL, NULL, 'Inscription', 'Inscription', 'Inscription', NOW(), NOW()),
('/myProfile', 'Mon Profile', NULL, NULL, 'Mon Profile', 'Mon Profile', 'Mon Profile', NOW(), NOW()),
('/lostPassword', 'Mot de passe perdu', NULL, NULL, 'Mot de passe perdu', 'Mot de passe perdu', 'Mot de passe perdu', NOW(), NOW()),
('/search', 'Recherche', NULL, NULL, 'Recherche', 'Recherche', 'Recherche', NOW(), NOW()),
('/quotations', 'Devis en ligne', NULL, NULL, 'Devis en ligne', 'Devis en ligne', 'Devis en ligne', NOW(), NOW()),
('/quotation/F50_Accord_L', 'F50-Accord_FormL', NULL, NULL, 'F50-Accord_FormL', 'F50-Accord_FormL', 'F50-Accord_FormL', NOW(), NOW()),
('/quotation/F50_Accord_U', 'F50-Accord_FormU', NULL, NULL, 'F50-Accord_FormU', 'F50-Accord_FormU', 'F50-Accord_FormU', NOW(), NOW()),
('/quotation/F50_Accord_line', 'F50-Accord_FormLinéaire', NULL, NULL, 'F50-Accord_FormLinéaire', 'F50-Accord_FormLinéaire', 'F50-Accord_FormLinéaire', NOW(), NOW()),
('/quotation/F50_Horizon_L', 'F50-Horizon_FormL', NULL, NULL, 'F50-Horizon_FormL', 'F50-Horizon_FormL', 'F50-Horizon_FormL', NOW(), NOW()),
('/quotation/F50_Horizon_U', 'F50-Horizon_FormU', NULL, NULL, 'F50-Horizon_FormU', 'F50-Horizon_FormU', 'F50-Horizon_FormU', NOW(), NOW()),
('/quotation/F50_Horizon_line', 'F50-Horizon_FormLinéaire', NULL, NULL, 'F50-Horizon_FormLinéaire', 'F50-Horizon_FormLinéaire', 'F50-Horizon_FormLinéaire', NOW(), NOW()),
('/quotation/F50_Horizon_Quattro_L', 'F50-Horizon_Quattro_FormL', NULL, NULL, 'F50-Horizon_Quattro_FormL', 'F50-Horizon_Quattro_FormL', 'F50-Horizon_Quattro_FormL', NOW(), NOW()),
('/quotation/F50_Horizon_Quattro_U', 'F50-Horizon_Quattro_FormU', NULL, NULL, 'F50-Horizon_Quattro_FormU', 'F50-Horizon_Quattro_FormU', 'F50-Horizon_Quattro_FormU', NOW(), NOW()),
('/quotation/F50_Horizon_Quattro_line', 'F50-Horizon_Quattro_FormLinéaire', NULL, NULL, 'F50-Horizon_Quattro_FormLinéaire', 'F50-Horizon_Quattro_FormLinéaire', 'F50-Horizon_Quattro_FormLinéaire', NOW(), NOW()),
('/quotation/F50_Square_L', 'F50-Square_FormL', NULL, NULL, 'F50-Square_FormL', 'F50-Square_FormL', 'F50-Square_FormL', NOW(), NOW()),
('/quotation/F50_Square_U', 'F50-Square_FormU', NULL, NULL, 'F50-Square_FormUL', 'F50-Square_FormU', 'F50-Square_FormU', NOW(), NOW()),
('/quotation/F50_Square_line', 'F50-Square_FormLinéaire', NULL, NULL, 'F50-Square_FormLinéaire', 'F50-Square_FormLinéaire', 'F50-Square_FormLinéaire', NOW(), NOW()),
('/quotation/F50_Quattro_L', 'F50-Quattro_FormL', NULL, NULL, 'F50-Quattro_FormL', 'F50-Quattro_FormL', 'F50-Quattro_FormL', NOW(), NOW()),
('/quotation/F50_Quattro_U', 'F50-Quattro_FormU', NULL, NULL, 'F50-Quattro_FormU', 'F50-Quattro_FormU', 'F50-Quattro_FormU', NOW(), NOW()),
('/quotation/F50_Quattro_line', 'F50-Quattro_FormLinéaire', NULL, NULL, 'F50-Quattro_FormLinéaire', 'F50-Quattro_FormLinéaire', 'F50-Quattro_FormLinéaire', NOW(), NOW()),
('/quotation/Crystal_line_A', 'Crystal_line_A', NULL, NULL, 'Crystal_line_A', 'Crystal_line_A', 'Crystal_line_A', NOW(), NOW()),
('/quotation/Crystal_line_B', 'Crystal_line_B', NULL, NULL, 'Crystal_line_B', 'Crystal_line_B', 'Crystal_line_B', NOW(), NOW()),
('/quotation/Crystal_line_D', 'Crystal_line_D', NULL, NULL, 'Crystal_line_D', 'Crystal_line_D', 'Crystal_line_D', NOW(), NOW()),
('/quotation/Crystal_line_C2U', 'Crystal_line_C2U', NULL, NULL, 'Crystal_line_C2U', 'Crystal_line_C2U', 'Crystal_line_C2U', NOW(), NOW()),
('/quotation/Grid_applique', 'Grille en applique', NULL, NULL, 'Grille en applique', 'Grille en applique', 'Grille en applique', NOW(), NOW()),
('/quotation/Grid_exterior_recessed', 'Grille extérieure encastrée', NULL, NULL, 'Grille extérieure encastrée', 'Grille extérieure encastrée', 'Grille extérieure encastrée', NOW(), NOW());


INSERT INTO `a_staticpage_i18ns` (`lang_id`, `staticpage_id`, `metatitle`, `metakeywords`, `metadescription`, `pagetitle`, `breadcrumb`, `pagecontent`, `created_at`, `updated_at`) VALUES
(1, 1, 'Accueil', 'Alluco.com', 'Alluco.com', 'Bienvenue', 'Accueil', '<p>Alluco se positionne sur le march&eacute; de l&rsquo;aluminium par des concepts innovants et s&rsquo;adaptant parfaitement aux exigences de l&rsquo;architecture contemporaine.</p><p>Par son choix diversifi&eacute; de produits, Alluco s&rsquo;associe &agrave; vos Projets et vous offre une solution en aluminium pertinente et compl&egrave;te r&eacute;pondant &agrave; 3 principes fondamentaux&nbsp;:</p><ol><li>Une Am&eacute;lioration de la performance &eacute;nerg&eacute;tique des b&acirc;timents&nbsp;: l&rsquo;Economie d&rsquo;&eacute;nergie,</li><li>Une habitation saine et confortable,</li><li>Un design splendide</li></ol><p>&nbsp;</p><p><br />La large gamme de produit d&rsquo;Alluco comprend&nbsp;:</p><ul><li>Des s&eacute;ries compl&egrave;tes de syst&egrave;mes de profil&eacute;s en aluminium&nbsp;: Coulissant, Oscillo-battant, Mur Rideaux&hellip;.</li><li>Des lames volet roulant extrud&eacute;es ou inject&eacute;es assurant votre s&eacute;curit&eacute;.</li><li>Les syst&egrave;mes de garde-corps des balcons, v&eacute;randas, et les escaliers con&ccedil;us par des profil&eacute;s en aluminium anodis&eacute;s aspect inox ou Vitr&eacute;s</li><li>Des syst&egrave;mes de protection solaire tel que Brises soleil fixes ou coulissantes pergolas, Screens, Camargue, vous permettant de profiter de votre espace ext&eacute;rieur &agrave; tout moment de l&rsquo;ann&eacute;e.</li></ul>', NOW(), NOW()),
(2, 1, 'Accueil', 'Alluco.com', 'Alluco.com', 'Bienvenue', 'Accueil', '<p>Avec un esprit innovateur, Alluco se spécialise et se positionne dans le confort de l’aluminium.</p><p>Depuis sa création, elle n’a cessé de développer sa gamme de produits en offrant des solutions en aluminium pertinentes et complètes et qui s’adaptent parfaitement aux spécificités architecturales contemporaines.</p><p>En effet, Alluco met à votre disposition des produits en aluminium de haute qualité (profilés, lames volet, Gardes corps, Protection solaire, Grilles de ventilation, Accessoires…) et qui répondent aux exigences d’efficacité énergétique, à la sécurité, au bien être et design innovant.</p>', NOW(), NOW()),
(1, 2, 'Certificats', NULL, NULL, 'Nos Certificats', 'Nos Certificats', '<div class="portfolio-page portfolio-2column"><ul id="portfolio-list" data-animated="fadeIn"><li><img src="/res/certificats/01.jpg"><a class="lightbox" href="/res/certificats/01.jpg"><i class="more">+</i></a></li><li><img src="/res/certificats/02.jpg"><a class="lightbox" href="/res/certificats/02.jpg"><i class="more">+</i></a></li><li><img src="/res/certificats/03.jpg"><a class="lightbox" href="/res/certificats/03.jpg"><i class="more">+</i></a></li><li><img src="/res/certificats/04.jpg"><a class="lightbox" href="/res/certificats/04.jpg"><i class="more">+</i></a></li></ul></div>', NOW(), NOW()),
(2, 2, 'Certificats', NULL, NULL, 'Nos Certificats', 'Nos Certificats', '<div class="portfolio-page portfolio-2column"><ul id="portfolio-list" data-animated="fadeIn"><li><img src="/res/certificats/01.jpg"><a class="lightbox" href="/res/certificats/01.jpg"><i class="more">+</i></a></li><li><img src="/res/certificats/02.jpg"><a class="lightbox" href="/res/certificats/02.jpg"><i class="more">+</i></a></li><li><img src="/res/certificats/03.jpg"><a class="lightbox" href="/res/certificats/03.jpg"><i class="more">+</i></a></li><li><img src="/res/certificats/04.jpg"><a class="lightbox" href="/res/certificats/04.jpg"><i class="more">+</i></a></li></ul></div>', NOW(), NOW()),
(1, 3, 'Partenaires', NULL, NULL, 'Nos Partenaires', 'Nos Partenaires', '<p><img src="/res/partenaires/01.jpg"></p><hr><p><img src="/res/partenaires/02.jpg"></p><hr><p><img src="/res/partenaires/03.jpg"></p><hr><p><img src="/res/partenaires/04.jpg"></p>', NOW(), NOW()),
(2, 3, 'Partenaires', NULL, NULL, 'Nos Partenaires', 'Nos Partenaires', '<p><img src="/res/partenaires/01.jpg"></p><hr><p><img src="/res/partenaires/02.jpg"></p><hr><p><img src="/res/partenaires/03.jpg"></p><hr><p><img src="/res/partenaires/04.jpg"></p>', NOW(), NOW()),
(1, 4, 'Contact', NULL, NULL, 'Contact', 'Contact', 'Contact', NOW(), NOW()),
(2, 4, 'Contact', NULL, NULL, 'Contact', 'Contact', 'Contact', NOW(), NOW()),
(1, 5, 'Plan du site', NULL, NULL, 'Plan du site', 'Plan du site', 'Plan du site', NOW(), NOW()),
(2, 5, 'Plan du site', NULL, NULL, 'Plan du site', 'Plan du site', 'Plan du site', NOW(), NOW()),
(1, 6, 'Actualité', NULL, NULL, 'Actualité', 'Actualité', 'Actualité', NOW(), NOW()),
(2, 6, 'Actualité', NULL, NULL, 'Actualité', 'Actualité', 'Actualité', NOW(), NOW()),
(1, 7, 'Produits', NULL, NULL, 'Produits', 'Produits', 'Produits', NOW(), NOW()),
(2, 7, 'Produits', NULL, NULL, 'Produits', 'Produits', 'Produits', NOW(), NOW()),
(1, 8, 'Téléchargement', NULL, NULL, 'Téléchargement', 'Téléchargement', 'Téléchargement', NOW(), NOW()),
(2, 8, 'Téléchargement', NULL, NULL, 'Téléchargement', 'Téléchargement', 'Téléchargement', NOW(), NOW()),
(1, 9, 'Connexion', NULL, NULL, 'Connexion', 'Connexion', 'Connexion', NOW(), NOW()),
(2, 9, 'Connexion', NULL, NULL, 'Connexion', 'Connexion', 'Connexion', NOW(), NOW()),
(1, 10, 'Inscription', NULL, NULL, 'Inscription', 'Inscription', 'Inscription', NOW(), NOW()),
(2, 10, 'Inscription', NULL, NULL, 'Inscription', 'Inscription', 'Inscription', NOW(), NOW()),
(1, 11, 'Mon Profile', NULL, NULL, 'Mon Profile', 'Mon Profile', 'Mon Profile', NOW(), NOW()),
(2, 11, 'Mon Profile', NULL, NULL, 'Mon Profile', 'Mon Profile', 'Mon Profile', NOW(), NOW()),
(1, 12, 'Mot de passe perdu', NULL, NULL, 'Mot de passe perdu', 'Mot de passe perdu', 'Mot de passe perdu', NOW(), NOW()),
(2, 12, 'Mot de passe perdu', NULL, NULL, 'Mot de passe perdu', 'Mot de passe perdu', 'Mot de passe perdu', NOW(), NOW()),
(1, 13, 'Recherche', NULL, NULL, 'Recherche', 'Recherche', 'Recherche', NOW(), NOW()),
(2, 13, 'Recherche', NULL, NULL, 'Recherche', 'Recherche', 'Recherche', NOW(), NOW()),
(1, 14, 'Devis en ligne', NULL, NULL, 'Devis en ligne', 'Devis en ligne', 'Devis en ligne', NOW(), NOW()),
(2, 14, 'Devis en ligne', NULL, NULL, 'Devis en ligne', 'Devis en ligne', 'Devis en ligne', NOW(), NOW()),
(1, 15, 'F50-Accord_FormL', NULL, NULL, 'F50-Accord_FormL', 'F50-Accord_FormL', 'F50-Accord_FormL', NOW(), NOW()),
(2, 15, 'F50-Accord_FormL', NULL, NULL, 'F50-Accord_FormL', 'F50-Accord_FormL', 'F50-Accord_FormL', NOW(), NOW()),
(1, 16, 'F50-Accord_FormU', NULL, NULL, 'F50-Accord_FormU', 'F50-Accord_FormU', 'F50-Accord_FormU', NOW(), NOW()),
(2, 16, 'F50-Accord_FormU', NULL, NULL, 'F50-Accord_FormU', 'F50-Accord_FormU', 'F50-Accord_FormU', NOW(), NOW()),
(1, 17, 'F50-Accord_FormLinéaire', NULL, NULL, 'F50-Accord_FormLinéaire', 'F50-Accord_FormLinéaire', 'F50-Accord_FormLinéaire', NOW(), NOW()),
(2, 17, 'F50-Accord_FormLinéaire', NULL, NULL, 'F50-Accord_FormLinéaire', 'F50-Accord_FormLinéaire', 'F50-Accord_FormLinéaire', NOW(), NOW()),
(1, 18, 'F50-Horizon_FormL', NULL, NULL, 'F50-Horizon_FormL', 'F50-Horizon_FormL', 'F50-Horizon_FormL', NOW(), NOW()),
(2, 18, 'F50-Horizon_FormL', NULL, NULL, 'F50-Horizon_FormL', 'F50-Horizon_FormL', 'F50-Horizon_FormL', NOW(), NOW()),
(1, 19, 'F50-Horizon_FormU', NULL, NULL, 'F50-Horizon_FormU', 'F50-Horizon_FormU', 'F50-Horizon_FormU', NOW(), NOW()),
(2, 19, 'F50-Horizon_FormU', NULL, NULL, 'F50-Horizon_FormU', 'F50-Horizon_FormU', 'F50-Horizon_FormU', NOW(), NOW()),
(1, 20, 'F50-Horizon_FormLinéaire', NULL, NULL, 'F50-Horizon_FormLinéaire', 'F50-Horizon_FormLinéaire', 'F50-Horizon_FormLinéaire', NOW(), NOW()),
(2, 20, 'F50-Horizon_FormLinéaire', NULL, NULL, 'F50-Horizon_FormLinéaire', 'F50-Horizon_FormLinéaire', 'F50-Horizon_FormLinéaire', NOW(), NOW()),
(1, 21, 'F50-Horizon_Quattro_FormL', NULL, NULL, 'F50-Horizon_Quattro_FormL', 'F50-Horizon_Quattro_FormL', 'F50-Horizon_Quattro_FormL', NOW(), NOW()),
(2, 21, 'F50-Horizon_Quattro_FormL', NULL, NULL, 'F50-Horizon_Quattro_FormL', 'F50-Horizon_Quattro_FormL', 'F50-Horizon_Quattro_FormL', NOW(), NOW()),
(1, 22, 'F50-Horizon_Quattro_FormU', NULL, NULL, 'F50-Horizon_Quattro_FormU', 'F50-Horizon_Quattro_FormU', 'F50-Horizon_Quattro_FormU', NOW(), NOW()),
(2, 22, 'F50-Horizon_Quattro_FormU', NULL, NULL, 'F50-Horizon_Quattro_FormU', 'F50-Horizon_Quattro_FormU', 'F50-Horizon_Quattro_FormU', NOW(), NOW()),
(1, 23, 'F50-Horizon_Quattro_FormLinéaire', NULL, NULL, 'F50-Horizon_Quattro_FormLinéaire', 'F50-Horizon_Quattro_FormLinéaire', 'F50-Horizon_Quattro_FormLinéaire', NOW(), NOW()),
(2, 23, 'F50-Horizon_Quattro_FormLinéaire', NULL, NULL, 'F50-Horizon_Quattro_FormLinéaire', 'F50-Horizon_Quattro_FormLinéaire', 'F50-Horizon_Quattro_FormLinéaire', NOW(), NOW()),
(1, 24, 'F50-Square_FormL', NULL, NULL, 'F50-Square_FormL', 'F50-Square_FormL', 'F50-Square_FormL', NOW(), NOW()),
(2, 24, 'F50-Square_FormL', NULL, NULL, 'F50-Square_FormL', 'F50-Square_FormL', 'F50-Square_FormL', NOW(), NOW()),
(1, 25, 'F50-Square_FormU', NULL, NULL, 'F50-Square_FormUL', 'F50-Square_FormU', 'F50-Square_FormU', NOW(), NOW()),
(2, 25, 'F50-Square_FormU', NULL, NULL, 'F50-Square_FormUL', 'F50-Square_FormU', 'F50-Square_FormU', NOW(), NOW()),
(1, 26, 'F50-Square_FormLinéaire', NULL, NULL, 'F50-Square_FormLinéaire', 'F50-Square_FormLinéaire', 'F50-Square_FormLinéaire', NOW(), NOW()),
(2, 26, 'F50-Square_FormLinéaire', NULL, NULL, 'F50-Square_FormLinéaire', 'F50-Square_FormLinéaire', 'F50-Square_FormLinéaire', NOW(), NOW()),
(1, 27, 'F50-Quattro_FormL', NULL, NULL, 'F50-Quattro_FormL', 'F50-Quattro_FormL', 'F50-Quattro_FormL', NOW(), NOW()),
(2, 27, 'F50-Quattro_FormL', NULL, NULL, 'F50-Quattro_FormL', 'F50-Quattro_FormL', 'F50-Quattro_FormL', NOW(), NOW()),
(1, 28, 'F50-Quattro_FormU', NULL, NULL, 'F50-Quattro_FormU', 'F50-Quattro_FormU', 'F50-Quattro_FormU', NOW(), NOW()),
(2, 28, 'F50-Quattro_FormU', NULL, NULL, 'F50-Quattro_FormU', 'F50-Quattro_FormU', 'F50-Quattro_FormU', NOW(), NOW()),
(1, 29, 'F50-Quattro_FormLinéaire', NULL, NULL, 'F50-Quattro_FormLinéaire', 'F50-Quattro_FormLinéaire', 'F50-Quattro_FormLinéaire', NOW(), NOW()),
(2, 29, 'F50-Quattro_FormLinéaire', NULL, NULL, 'F50-Quattro_FormLinéaire', 'F50-Quattro_FormLinéaire', 'F50-Quattro_FormLinéaire', NOW(), NOW()),
(1, 30, 'Crystal_line_A', NULL, NULL, 'Crystal_line_A', 'Crystal_line_A', 'Crystal_line_A', NOW(), NOW()),
(2, 30, 'Crystal_line_A', NULL, NULL, 'Crystal_line_A', 'Crystal_line_A', 'Crystal_line_A', NOW(), NOW()),
(1, 31, 'Crystal_line_B', NULL, NULL, 'Crystal_line_B', 'Crystal_line_B', 'Crystal_line_B', NOW(), NOW()),
(2, 31, 'Crystal_line_B', NULL, NULL, 'Crystal_line_B', 'Crystal_line_B', 'Crystal_line_B', NOW(), NOW()),
(1, 32, 'Crystal_line_D', NULL, NULL, 'Crystal_line_D', 'Crystal_line_D', 'Crystal_line_D', NOW(), NOW()),
(2, 32, 'Crystal_line_D', NULL, NULL, 'Crystal_line_D', 'Crystal_line_D', 'Crystal_line_D', NOW(), NOW()),
(1, 33, 'Crystal_line_C2U', NULL, NULL, 'Crystal_line_C2U', 'Crystal_line_C2U', 'Crystal_line_C2U', NOW(), NOW()),
(2, 33, 'Crystal_line_C2U', NULL, NULL, 'Crystal_line_C2U', 'Crystal_line_C2U', 'Crystal_line_C2U', NOW(), NOW()),
(1, 34, 'Grille en applique', NULL, NULL, 'Grille en applique', 'Grille en applique', 'Grille en applique', NOW(), NOW()),
(2, 34, 'Grille en applique', NULL, NULL, 'Grille en applique', 'Grille en applique', 'Grille en applique', NOW(), NOW()),
(1, 35, 'Grille extérieure encastrée', NULL, NULL, 'Grille extérieure encastrée', 'Grille extérieure encastrée', 'Grille extérieure encastrée', NOW(), NOW()),
(2, 35, 'Grille extérieure encastrée', NULL, NULL, 'Grille extérieure encastrée', 'Grille extérieure encastrée', 'Grille extérieure encastrée', NOW(), NOW());

INSERT INTO `a_banners` (`filename`, `rank`, `title`, `alt`, `created_at`, `updated_at`) VALUES
('01.jpg', 100, 'Alluco', 'Alluco', NOW(), NOW()),
('02.jpg', 99, 'Alluco', 'Alluco', NOW(), NOW()),
('03.jpg', 98, 'Alluco', 'Alluco', NOW(), NOW()),
('04.jpg', 97, 'Alluco', 'Alluco', NOW(), NOW()),
('05.jpg', 96, 'Alluco', 'Alluco', NOW(), NOW()),
('06.jpg', 95, 'Alluco', 'Alluco', NOW(), NOW()),
('07.jpg', 94, 'Alluco', 'Alluco', NOW(), NOW()),
('08.jpg', 93, 'Alluco', 'Alluco', NOW(), NOW());


INSERT INTO `a_banner_i18ns` (`lang_id`, `banner_id`, `title`, `alt`, `created_at`, `updated_at`) VALUES
(1, 1, 'Alluco', 'Alluco', NOW(), NOW()),
(2, 1, 'Alluco', 'Alluco', NOW(), NOW()),
(1, 2, 'Alluco', 'Alluco', NOW(), NOW()),
(2, 2, 'Alluco', 'Alluco', NOW(), NOW()),
(1, 3, 'Alluco', 'Alluco', NOW(), NOW()),
(2, 3, 'Alluco', 'Alluco', NOW(), NOW()),
(1, 4, 'Alluco', 'Alluco', NOW(), NOW()),
(2, 4, 'Alluco', 'Alluco', NOW(), NOW()),
(1, 5, 'Alluco', 'Alluco', NOW(), NOW()),
(2, 5, 'Alluco', 'Alluco', NOW(), NOW()),
(1, 6, 'Alluco', 'Alluco', NOW(), NOW()),
(2, 6, 'Alluco', 'Alluco', NOW(), NOW()),
(1, 7, 'Alluco', 'Alluco', NOW(), NOW()),
(2, 7, 'Alluco', 'Alluco', NOW(), NOW()),
(1, 8, 'Alluco', 'Alluco', NOW(), NOW()),
(2, 8, 'Alluco', 'Alluco', NOW(), NOW());


INSERT INTO `a_sitenews` (`pageurl`, `metatitle`, `metakeywords`, `metadescription`, `pagetitle`, `breadcrumb`, `pagecontent`, `thumb_alt`, `thumb_title`, `thumb`,`created_at`, `updated_at`) VALUES
('Salon_Medibat', 'Salon Medibat', 'Salon Medibat', 'Salon Medibat', 'Salon "Medibat"', 'Salon "Medibat"', '<p>Nous aurons tout le plaisir de vous accueillir sur notre stand <b><u>N°82 Hall 4</u></b> au Salon "<b>Medibat</b>" du 04 au 07 Mars pour découvrir nos nouveautés 2015.</p>', 'Salon Medibat', 'Salon Medibat', '01.jpg', '2015-02-19 09:24:42', '2015-02-19 09:24:42');

INSERT INTO `a_sitenew_i18ns` (`lang_id`, `sitenew_id`, `metatitle`, `metakeywords`, `metadescription`, `pagetitle`, `breadcrumb`, `pagecontent`, `thumb_alt`, `thumb_title`,`created_at`, `updated_at`) VALUES
(1, 1, 'Salon Medibat', 'Salon Medibat', 'Salon Medibat', 'Salon "Medibat"', 'Salon "Medibat"', '<p>Nous aurons tout le plaisir de vous accueillir sur notre stand <b><u>N°82 Hall 4</u></b> au Salon "<b>Medibat</b>" du 04 au 07 Mars pour découvrir nos nouveautés 2015.</p>', 'Salon Medibat', 'Salon Medibat', '2015-02-19 09:24:42', '2015-02-19 09:24:42'),
(2, 1, 'Salon Medibat', 'Salon Medibat', 'Salon Medibat', 'Salon "Medibat"', 'Salon "Medibat"', '<p>Nous aurons tout le plaisir de vous accueillir sur notre stand <b><u>N°82 Hall 4</u></b> au Salon "<b>Medibat</b>" du 04 au 07 Mars pour découvrir nos nouveautés 2015.</p>', 'Salon Medibat', 'Salon Medibat', '2015-02-19 09:24:42', '2015-02-19 09:24:42');


INSERT INTO `a_products` (`pageurl_full`, `pageurl`, `name`, `metatitle`, `metakeywords`, `metadescription`, `pagetitle`, `breadcrumb`, `pagecontent`, `thumb_alt`, `thumb_title`, `thumb`, `rank`, `created_at`, `updated_at`, `product_id`) VALUES
('Profiles_En_Alluminuim', 'Profiles_En_Alluminuim', 'Profilés en aluminium', 'Profilés en aluminium', 'Profilés en aluminium', 'Profilés en aluminium', 'Profilés en aluminium', 'Profilés en aluminium', 'Profilés en aluminium', 'Profilés en aluminium', 'Profilés en aluminium', '01.jpg', 100, NOW(), NOW(), NULL),
('Lames_Volet', 'Lames_Volet', 'Lames Volets', 'Lames Volets', 'Lames Volets', 'Lames Volets', 'Lames Volets', 'Lames Volets', 'Lames Volets', 'Lames Volets', 'Lames Volets', '02.jpg', 99, NOW(), NOW(), NULL),
('Gardes_Corps', 'Gardes_Corps', 'Gardes Corps', 'Gardes Corps', 'Gardes Corps', 'Gardes Corps', 'Gardes Corps', 'Gardes Corps', 'Gardes Corps', 'Gardes Corps', 'Gardes Corps', '03.jpg', 98, NOW(), NOW(), NULL),
('Protection_Solaire', 'Protection_Solaire', 'Protection Solaire', 'Protection Solaire', 'Protection Solaire', 'Protection Solaire', 'Protection Solaire', 'Protection Solaire', 'Protection Solaire', 'Protection Solaire', 'Protection Solaire', '04.jpg', 97, NOW(), NOW(), NULL),
('Grilles_Ventilation', 'Grilles_Ventilation', 'Grilles de Ventilation', 'Grilles de Ventilation', 'Grilles de Ventilation', 'Grilles de Ventilation', 'Grilles de Ventilation', 'Grilles de Ventilation', 'Grilles de Ventilation', 'Grilles de Ventilation', 'Grilles de Ventilation', '05.gif', 96, NOW(), NOW(), NULL),
('Systemes_Nice', 'Systemes_Nice', 'Systèmes Nice', 'Systèmes Nice', 'Systèmes Nice', 'Systèmes Nice', 'Systèmes Nice', 'Systèmes Nice', 'Systèmes Nice', 'Systèmes Nice', 'Systèmes Nice', '06.jpg', 95, NOW(), NOW(), NULL),
('Protection_Solaire/Brise_Soleil', 'Brise_Soleil', 'Brise Soleil', 'Brise Soleil', 'Brise Soleil', 'Brise Soleil', 'Brise Soleil', 'Brise Soleil', 'Brise Soleil', 'Brise Soleil', 'Brise Soleil', '07.jpg', 95, NOW(), NOW(), 4),
('Systemes_Nice/Moteur_Nice', 'Moteur_Nice', 'Moteurs Nice ', 'Moteurs Nice', 'Moteurs Nice', 'Moteurs Nice', 'Moteurs Nice', 'Moteurs Nice', 'Moteurs Nice', 'Moteurs Nice', 'Moteurs Nice', '08.jpg', 95, NOW(), NOW(), 6),
('Systemes_Nice/Emetteurs', 'Emetteurs', 'Emetteurs', 'Emetteurs', 'Emetteurs', 'Emetteurs', 'Emetteurs', 'Emetteurs', 'Emetteurs', 'Emetteurs', 'Emetteurs', '09.jpg', 95, NOW(), NOW(), 6);

INSERT INTO `a_products` (`pageurl`, `name`, `metatitle`, `metakeywords`, `metadescription`, `pagetitle`, `pagecontent`, `name_en`, `metatitle_en`, `metakeywords_en`, `metadescription_en`, `pagetitle_en`, `pagecontent_en`, `rank`, `productgroup_id`, `created_at`, `updated_at`) VALUES
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

