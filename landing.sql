-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mer. 26 fév. 2020 à 13:24
-- Version du serveur :  5.7.26
-- Version de PHP :  7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `landing`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_880E0D76E7927C74` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`id`, `email`, `roles`, `password`) VALUES
(1, 'admin@demo.com', '[\"ROLE_ADMIN\", \"ROLE_TRAFIC\", \"ROLE_LEAD\"]', '$2y$13$5e3G6lI.3cv1auEM59D98Oy/p6nIl/ol.4ZTYvKhnKG/VCsoVdBnC'),
(3, 'sam@bzez.dev', '[\"ROLE_TRAFIC\"]', '$2y$13$t7Ak21Q.D3./eIP81H8btuVfHmG6I2H2LHRg37HHFvOXhs.MSL1Ly');

-- --------------------------------------------------------

--
-- Structure de la table `lead`
--

DROP TABLE IF EXISTS `lead`;
CREATE TABLE IF NOT EXISTS `lead` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adresse` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code_postal` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ville` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `register_at` datetime NOT NULL,
  `is_from_id` int(11) NOT NULL,
  `custom_fields` json DEFAULT NULL,
  `exported` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_289161CB6EF25FC3` (`is_from_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `lead`
--

INSERT INTO `lead` (`id`, `nom`, `prenom`, `adresse`, `code_postal`, `ville`, `email`, `telephone`, `register_at`, `is_from_id`, `custom_fields`, `exported`) VALUES
(3, 'BZEZ', 'Sam', '10 rue de la bas', '54000', 'NANCY', 'sam@bzez.dev', '0102030405', '2020-02-19 16:03:12', 2, 'null', 0),
(4, 'bhghfgdsh', 'gshsdh', 'sdhsdhsdh', '54200', 'sdhsdfh', 'ghsdfghsh@hshdh.hy', '1002050405', '2020-02-20 10:16:32', -1, 'null', 1),
(7, 'test', 'test', 'teteteteteteteetete', '10101', 'dffs', 'sam@dferfr.fr', '0102030405', '2020-02-20 12:57:27', 2, '[{\"logement\": \"Appart\"}, {\"chauffage\": \"Gaz\"}]', 0),
(8, 'TEST', 'TEST', 'TESTETfzfgqsdgqshgqshg', '12154', 'frfrf', 'frrfr@fr.fr', '0205040608', '2020-02-21 12:52:51', -1, '[{\"logement\": \"Maison\"}, {\"chauffage\": \"Gaz\"}]', 0),
(9, 'gdshsdhsdh', 'sdhsdhsdhs', 'dhsdhsdfhsdfhsdh', '54200', 'rffrfrfrf', 'tgtgtg@frfr.fr', '0102030501', '2020-02-21 13:02:17', -1, '[{\"logement\": \"Maison\"}, {\"chauffage\": \"Gaz\"}]', 0),
(10, 'test', 'test', 'testttttttt', '01023', 'dedededed', 'test@test.fr', '0102030405', '2020-02-25 14:31:42', -1, NULL, 0),
(11, 'test', 'sfgsdqhgdqsfhdfh', 'dqfhqdfhsdghsdfghsdfghsdfhsdfghsd', '01025', 'dedededed', 'test@test.fr', '0102030405', '2020-02-25 14:37:53', -1, NULL, 0),
(12, 'testfhsdhsdfhsd', 'hsdfhsdhsdhsdhs', 'dhsdhsdfhsdfhsdfhdsfhsdh', '12345', 'gdsfghqgfqsgqsg', 'qsfgqsfgfqd@fgtgtg.fr', '0102030405', '2020-02-25 14:51:18', -1, NULL, 0),
(13, 'fsgsqfgqdg', 'qsgqsgqsgq', 'sgqsgqsgqegqs', '54698', '0gqsfgqsgqs', 'gtgt@gtgt.fr', '0102030405', '2020-02-25 14:54:12', -1, NULL, 0),
(14, 'gsfdfdhg', 'qsfdhqdfhsdfhsd', 'hfsdhdsfhsdhsdfhsdfhd', '87546', 'dzgqdfhgsdfh', 'frfr@fr.fr', '0102030405', '2020-02-25 14:55:17', -1, '[{\"logement\": \"maison\"}, {\"statut\": \"Proprietaire\"}]', 0),
(15, 'srurjufgj', 'gfdsjdfgjdfgjfdg', 'jdfgjdfgjfdgjdfgjdfgj', '02036', 'jdfgjfdjfdj', 'gtgt@frfr.fr', '0102030405', '2020-02-25 16:04:55', 4, '[{\"logement\": \"Appartement\"}, {\"statut\": \"Proprietaire\"}, {\"chauffage\": \"Electrique\"}, {\"facture\": \"Moins de 1400€\"}, {\"situation\": \"Actif\"}]', 0),
(16, 'chaudier', 'dzgqsgq', 'testttttttt', '01023', 'dedededed', 'gqfdgdfg@frfr.fr', '0102030405', '2020-02-26 11:45:46', 4, '[{\"chauffage\": \"Fioul\"}, {\"logement\": \"Maison\"}]', 0);

-- --------------------------------------------------------

--
-- Structure de la table `migration_versions`
--

DROP TABLE IF EXISTS `migration_versions`;
CREATE TABLE IF NOT EXISTS `migration_versions` (
  `version` varchar(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `executed_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migration_versions`
--

INSERT INTO `migration_versions` (`version`, `executed_at`) VALUES
('20200218163624', '2020-02-18 16:36:48'),
('20200218165053', '2020-02-18 16:51:17'),
('20200219125824', '2020-02-19 12:58:40'),
('20200219135335', '2020-02-19 13:53:38'),
('20200219135545', '2020-02-19 13:55:47'),
('20200219155305', '2020-02-19 15:53:13'),
('20200220084357', '2020-02-20 08:44:01'),
('20200220123420', '2020-02-20 12:34:26'),
('20200220143721', '2020-02-20 14:37:24');

-- --------------------------------------------------------

--
-- Structure de la table `page`
--

DROP TABLE IF EXISTS `page`;
CREATE TABLE IF NOT EXISTS `page` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_indexed` tinyint(1) DEFAULT NULL,
  `is_followed` tinyint(1) DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `keywords` longtext COLLATE utf8mb4_unicode_ci,
  `favicon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `custom_color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `base` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `page`
--

INSERT INTO `page` (`id`, `nom`, `title`, `content`, `is_indexed`, `is_followed`, `description`, `keywords`, `favicon`, `logo`, `custom_color`, `base`) VALUES
(-1, 'default', 'landing', '<p>&nbsp;<br></p>', 1, 1, 'Descrition de la page....', 'text,super,mega test,ultra test', NULL, NULL, '', 0),
(2, 'pap', 'Ma pompe a chaleur gratuite', '<div class=\"row align-items-center\">\r\n        <div class=\"col-2 d-none d-md-inline-block col-md-2 text-center rounded border pt-3 pb-3\">\r\n            <span class=\"h2 mb-0 pb-0 text-custom\">1337</span> <br>\r\n            <span>partages</span>\r\n            <button class=\"btn btn-sm btn-primary mt-2 w-100\"><i class=\"fab fa-facebook-f\"></i> FACEBOOK</button>\r\n            <button class=\"btn btn-sm btn-primary mt-2 w-100\"><i class=\"fab fa-twitter\"></i> TWITTER</button>\r\n        </div>\r\n\r\n        <div class=\"col-12 col-md-10 text-black-50\">\r\n            <h1 class=\"h2\"> Une simple recherche sur internet pour en terminer avec mes factures de chauffage facilement\r\n                !</h1>\r\n            <div class=\"row align-items-center\">\r\n                <div class=\"col-xs pl-3\">\r\n                    <i class=\"far fa-newspaper fa-2x text-custom\"></i></div>\r\n                <div class=\"col\">Posté le 18.02.2020</div>\r\n            </div>\r\n        </div>\r\n    </div>\r\n\r\n    <div class=\"row\">\r\n        <div class=\"col-12\">\r\n            <hr style=\"opacity: .5\">\r\n            <p class=\"h5 text-black-50 text-sm-justify text-md-left\">Si comme moi (et de nombreux français), vous êtes proprietaires et vous pensez\r\n                que vos factures de\r\n                chauffage sont trop chères, alors cet article peut vous intéresser.\r\n                <br>\r\n                <br>\r\n                Pour éviter de se retrouver comme chaque année avec des factures d’énergies délirantes, j’ai cherché sur\r\n                internet une solution alternative.\r\n                <br>\r\n                <br>\r\n                Après plusieurs heures de recherches, tous les experts du secteur s’accordent à dire que la pompe à\r\n                chaleur est l’option la plus rentable et viable. Rentabilisée en moins de 5 ans, la pompe à chaleur\r\n                abaisse drastiquement vos factures de chauffage (de -50% à -75%) pour une utilisation sans retenu. <br>\r\n                <br>\r\n                <b class=\"text-custom\"><strong>Dans mon cas, ce serait un gain approx. de 2000€ par an ! Trop beau pour\r\n                        être vrai… ?</strong></b></p>\r\n        </div>\r\n    </div>\r\n    <div class=\"row bg-light rounded mt-5 mb-5\">\r\n        <div class=\"col-12 p-5\">\r\n            <p class=\"h5 text-black pt-3\">\r\n                <i class=\"fas fa-quote-right fa-flip-horizontal text-custom\"></i> La Pompe à chaleur dans le top 3 des\r\n                installations favorites des Français ayant changé leur système de chauffage ces 3 dernières années. <i class=\"fas fa-quote-right text-custom\"></i>\r\n            </p>\r\n        </div>\r\n    </div>\r\n\r\n    <div class=\"row text-center p-0 p-md-5\">\r\n        <div class=\"col-12 mb-3\">\r\n            <h3 class=\"text-custom text-center\"><i class=\"fas fa-info-circle d-none d-md-inline\"></i> UNE CHAUDIERE PERFORMANTE COMMENT CA MARCHE ?</h3>\r\n        </div>\r\n        <div class=\"col-12 col-md-4\">\r\n            <i class=\"fas fa-hard-hat text-custom fa-4x mb-3\"></i> <br>\r\n                <b><strong>VISITE TECHNIQUE GRATUITE</strong></b>\r\n        </div>\r\n        <div class=\"col-12 col-md-4\">\r\n            <i class=\"fas fa-fire text-custom fa-4x mb-3\"></i> <br>\r\n                <b><strong>CHAUDIERE GRATUITE</strong></b>\r\n        </div>\r\n        <div class=\"col-12 col-md-4\">\r\n            <i class=\"fas fa-tools text-custom fa-4x mb-3\"></i> <br>\r\n                <b><strong>INSTALLATION GRATUITE</strong></b>\r\n        </div>\r\n    </div>\r\n\r\n\r\n    <div class=\"row\">\r\n        <div class=\"col-12 col-md-8\">\r\n            <hr style=\"opacity: .5\">\r\n            <p class=\"h5 text-black-50\">\r\n                Mais pourquoi les français sont-ils aussi enthousiastes pour un dispositif comme la PAC ?\r\n                <br>\r\n                <br>\r\n                La réponse se trouve dans les <b> €€€</b> : l’Etat met la main au portefeuille pour vous aider financer\r\n                jusqu’à 90% du projet. J’ai fait la simulation et c’est bon, je suis éligible comme la majorité des\r\n                français.\r\n                <br>\r\n                <br>\r\n                Heureusement qu’il y a les aides financières proposées par l’Etat, ça m’a beaucoup aidé à prendre la\r\n                décision finale. En effet, si comme moi vous êtes éligibles, vous obtiendrez jusqu’à 90% du financement.\r\n                <br>\r\n                <br>\r\n                Plus de confort et un gain immédiat de plusieurs milliers d’euros sur mes factures de chauffage, je ne\r\n                regrette pas d’avoir creusé sur le sujet.\r\n                <br>\r\n                <br>\r\n                Merci le gouvernement et merci internet !\r\n                <br>\r\n                <br>\r\n                A bon entendeur.\r\n                <br>\r\n                <br>\r\n                Sam\r\n            </p>\r\n        </div>\r\n        <div class=\"col-12 col-md-4 p-3 text-center\">\r\n            <img class=\"rounded shadow\" src=\"//energi.es/img/pompe-a-chaleur-air-eau-min.png\" alt=\"Pome à chaleur à air et a eau\" width=\"100%\">\r\n            <button class=\"btn bg-custom text-black mt-3 w-100 text-white\">MA POMPE A CHALEUR GRATUITE !</button>\r\n            <h4 class=\"text-custom text-center mt-3\"><i class=\"fas fa-info-circle d-none d-md-inline\"></i> POURQUOI C\'EST GRATUIT ?</h4>\r\n            <span class=\"text-black-50\">grace à</span>\r\n            <img src=\"//energi.es/img/tecv.png\" alt=\"La transition énergetique pour la croissance verte\" class=\"rounded border\">\r\n        </div>\r\n    </div>\r\n\r\n    <div class=\"row rounded bg-light p-0 pt-5 pb-5 p-md-5 mt-5 mb-5\">\r\n        <div class=\"col-12\">\r\n            <h3 class=\"text-custom\"><i class=\"fas fa-info-circle d-none d-md-inline d-none d-md-inline\"></i> ET SINON QUELS SONT LES AVANTAGES DE LA POMPE À\r\n                CHALEUR ?</h3>\r\n            <p class=\"h5 text-black-50\">\r\n                Une <b><strong>facture de chauffage réduite jusqu’à 70%</strong></b>, les nouvelles pompes à chaleur\r\n                présentent des coefficients de performance (COP) très élevés ce qui vous offre un rendement maximal.\r\n                <br><br>\r\n                Un confort d’utilisation car elles permettent de <b><strong>chauffer l’hiver mais aussi de climatiser\r\n                        l’été</strong></b>. Cela permet une température stable dans toute la maison tout au long de\r\n                l’année.\r\n                <br><br>\r\n                Un comportement responsable grâce à une énergie propre qui <b><strong>ne produit aucun déchet, ni\r\n                        odeur</strong></b>. L’énergie émise est puisée dans l’air extérieur, une ressource gratuite et\r\n                inépuisable.\r\n                <br><br>\r\n                Les dernières innovations, et plus particulièrement les systèmes intelligents intégrés permettent de\r\n                programmer et piloter à distance votre pompe à chaleur. Vous pouvez <b><strong>choisir la température en\r\n                        fonction de l’utilisation des pièces</strong></b> de votre logement.\r\n            </p>\r\n        </div>\r\n    </div>\r\n\r\n    <div class=\"row mt-5 mb-5\">\r\n        <div class=\"col-12\">\r\n            <h3 class=\"text-custom text-uppercase\"><i class=\"fas fa-question-circle d-none d-md-inline\"></i> MAIS Pourquoi bénéficier d\'une\r\n                <b><strong>Pompe à Chaleur ?</strong></b></h3>\r\n            <p class=\"h5 text-black-50\">\r\n                Le principe de la pompe à chaleur est d\'extraire de l\'énergie à l\'extérieur de l\'habitation pour\r\n                l\'injecter à l\'intérieur par le biais d\'un radiateur, d\'un plancher chauffant ou d\'un ventilo-convecteur\r\n                en fonction du type d\'installation choisi.\r\n                <br><br>\r\n                <b><strong>Une pompe à chaleur est un moyen de chauffage qui se substitue par exemple à la chaudière à\r\n                        fioul, gaz ou à vos convecteurs électriques</strong></b>\r\n                <br><br>\r\n                Grâce à ce dispositif, votre chauffage devient <b><strong>éco-financé</strong></b> et vous <b><strong>maitrisez\r\n                        vos factures</strong></b>.\r\n                <br><br>\r\n                Lorsque un artisan intervient pour réaliser l\'installation chez vous, il s\'occupe de toutes les\r\n                démarches administratives (longues et complexes) pour vous permettre d\'obtenir le maximum d\'aides\r\n                possibles.\r\n            </p>\r\n\r\n            <button class=\"btn mt-3 w-100 bg-custom text-white\">Profitez-en en moins de 30 secondes. C\'est facile,\r\n                rapide et sans engagement !\r\n            </button>\r\n        </div>\r\n    </div>\r\n    <hr>\r\n    <div class=\"row mt-5 mb-5\">\r\n        <div class=\"col-12\">\r\n            <h3 class=\"text-custom text-uppercase\"><i class=\"fas fa-comments\"></i> ILS L\'ONT ADOPTé</h3>\r\n            <p class=\"h5 text-black-50\">\r\n                Vous hésitez encore ? Voici les derniers avis au sujet des pompes à chaleur... .\r\n            </p>\r\n            <div class=\"row\">\r\n                <div class=\"col-12 col-md-4\">\r\n                    <div class=\"col-12 bg-light rounded p-3 text-center mb-3\">\r\n                        <img src=\"//energi.es/img/avis-01.png\" alt=\"Proprietaire d\'une pompe a chaleur\" class=\"rounded-circle shadow\" width=\"75\">\r\n                        <br>\r\n                        <p class=\"h5 mt-3 text-custom\">Cyril</p>\r\n                        <p class=\"small text-black-50\">38ans, Maxéville</p>\r\n                        <p class=\"h5 font-italic text-black-50\">\r\n                            Depuis mon installation d\'une pompe à chaleur, j\'ai fait des <b><strong>économies de plus de\r\n                                    70%</strong></b> sur ma facture !\r\n                        </p>\r\n                    </div>\r\n                </div>\r\n                <div class=\"col-12 col-md-4\">\r\n                    <div class=\"col-12 bg-light rounded p-3 text-center mb-3\">\r\n                        <img src=\"//energi.es/img/avis-01.png\" alt=\"Proprietaire d\'une pompe a chaleur\" class=\"rounded-circle shadow\" width=\"75\">\r\n                        <br>\r\n                        <p class=\"h5 mt-3 text-custom\">Cyril</p>\r\n                        <p class=\"small text-black-50\">38ans, Maxéville</p>\r\n                        <p class=\"h5 font-italic text-black-50\">\r\n                            Depuis mon installation d\'une pompe à chaleur, j\'ai fait des <b><strong>économies de plus de\r\n                                    70%</strong></b> sur ma facture !\r\n                        </p>\r\n                    </div>\r\n                </div>\r\n                <div class=\"col-12 col-md-4\">\r\n                    <div class=\"col-12 bg-light rounded p-3 text-center\">\r\n                        <img src=\"//energi.es/img/avis-01.png\" alt=\"Proprietaire d\'une pompe a chaleur\" class=\"rounded-circle shadow\" width=\"75\">\r\n                        <br>\r\n                        <p class=\"h5 mt-3 text-custom\">Cyril</p>\r\n                        <p class=\"small text-black-50\">38ans, Maxéville</p>\r\n                        <p class=\"h5 font-italic text-black-50\">\r\n                            Depuis mon installation d\'une pompe à chaleur, j\'ai fait des <b><strong>économies de plus de\r\n                                    70%</strong></b> sur ma facture !\r\n                        </p>\r\n                    </div>\r\n                </div>\r\n                <div class=\"col-12 mt-5\">\r\n                    <p class=\"text-center text-uppercase text-custom\">\r\n                        <b>avis des internautes (1337)</b> <br>\r\n                        <img src=\"//energi.es/img/avis-internautes.png\" alt=\"\">\r\n                    </p>\r\n                </div>\r\n            </div>\r\n        </div>\r\n    </div>\r\n    <div class=\"row rounded bg-light p-0 pt-5 pb-5 p-md-5 mt-5 mb-5 align-items-center\">\r\n        <div class=\"col-12 col-md-6 mt-3\">\r\n            <h3 class=\"text-custom text-uppercase\"><i class=\"fas fa-info-circle d-none d-md-inline\"></i> Les pompes à chaleur éligibles</h3>\r\n            <p><b><strong>Pompe à chaleur air-eau</strong></b> : se raccorde au système de chauffage central de l’habitation et produit l’eau\r\n                chaude sanitaire. La chaleur est répandue dans le logement via un plancher chauffant ou des radiateurs\r\n                basse température.\r\n                <br>\r\n                <br>\r\n            </p><hr>\r\n                <br>\r\n                <b><strong>Pompe a chaleur air-air</strong></b> : assure la fraîcheur de l’intérieur en été et la chaleur en hiver. Elle ne\r\n                nécessite que peu d’entretien et ne necessite pas de radiateur pour diffuser la chaleur.<p></p>\r\n        </div>\r\n        <div class=\"col-12 col-md-6 mt-3\">\r\n            <img src=\"//energi.es/img/comment-fonctionne-les-pompes-a-chaleur.jpg\" alt=\"Comment fonctionne les pompes à chaleur ?\" class=\"rounded shadow-sm\" width=\"100%\">\r\n        </div>\r\n    </div>\r\n\r\n    <div class=\"row text-center p-5\">\r\n        <div class=\"col-12 mb-3\">\r\n            <h3 class=\"text-custom text-center\"><i class=\"fas fa-info-circle d-none d-md-inline\"></i> FAITES DES ÉCONOMIES !</h3>\r\n        </div>\r\n        <div class=\"col-12 col-md-4\">\r\n            <i class=\"fab fa-creative-commons-nc-eu fa-4x mb-3 text-custom\"></i> <br>\r\n           <b><strong>DES ÉCONOMIES DURABLES</strong></b> <br>\r\n           <span class=\"text-black-50\">Une facture de chauffage en baisse</span>\r\n        </div>\r\n        <div class=\"col-12 col-md-4\">\r\n            <i class=\"fas fa-globe-europe fa-4x mb-3 text-custom\"></i> <br>\r\n            <b><strong>UN LOGEMENT VALORISÉ</strong></b> <br>\r\n            <span class=\"text-black-50\">Plus de valeur sur le marché immobilier !</span>\r\n        </div>\r\n        <div class=\"col-12 col-md-4\">\r\n            <i class=\"fas fa-igloo fa-4x mb-3 text-custom\"></i> <br>\r\n            <b><strong>PLUS DE CONFORT</strong></b> <br>\r\n            <span class=\"text-black-50\">Toute la famille passe l\'hiver au chaud !</span>\r\n        </div>\r\n    </div>', 0, 0, 'dfsghsdfh', 'fhfhfh,hfhfh,fhfhfh', '98e34b2fbaf93510738fe4465fa8248f_400x400-5e4fb1cbc6320.png', '50bestfacebooklogoiconsgiftransparentpngimages35-5e4fb1cbc5832.png', NULL, 0),
(3, 'testt', 'test', 're', 1, 0, 'test', 'text,super,mega test,ultra test', NULL, '50bestfacebooklogoiconsgiftransparentpngimages35-5e4fae59f23d0.png', NULL, 0),
(4, 'testt-copie', 'test', '<div class=\"container-fluid\">\r\n            <div class=\"row p-3 p-lg-5\">\r\n                <div class=\"col-12 col-lg-6 bg-light p-1 p-md-5\">\r\n                    <div class=\"col-12 p-5 p-md-0\">\r\n                        <h4 class=\"text-custom font-weight-bold\">Pourquoi c’est gratuit ?</h4>\r\n                        <h3 class=\"text-uppercase text-warning\"> Grâce à Ma Prime Renov\' !</h3>\r\n                        <p class=\"text-black-50 h5 mb-3\">\r\n                            Depuis 2019, le ministère de la Transition Écologique et Solidaire a mis à disposition des\r\n                            ménages la\r\n                            Prime à la conversion chaudière ou autrement appelée « Coup de Pouce chauffage ».\r\n                            <br>\r\n                            <br>\r\n                            Selon vos revenus, vous pouvez bénéficier d’une aide financière pour vos projets d’économies\r\n                            d’énergie.\r\n                            Grâce à cette aide financière et en tant que signataire de la charte, HELLIO installe chez vous\r\n                            votre\r\n                            nouvelle chaudière gaz ou chaudière biomasse à très haut rendement.\r\n                        </p>\r\n                        <div class=\"row align-items-center\">\r\n                            <div class=\"col-12 col-md-6 text-center text-md-left mb-3 mb-mb-0\">\r\n                                <button class=\"btn btn-lg bg-custom text-white\">J\'en profite</button>\r\n                            </div>\r\n                            <div class=\"col-12 col-md-6 text-center text-md-right\">\r\n                                <img src=\"/img/tecv.png\" alt=\"\" style=\"max-width: 100%\" class=\"rounded border\" height=\"75px\">\r\n                            </div>\r\n                        </div>\r\n                    </div>\r\n                </div>\r\n                <div class=\"col-12 col-lg-6 p-0 m-0 mt-4 mt-lg-0\">\r\n                    <img src=\"/img/video-serigne.jpg\" alt=\"\" width=\"100%\">\r\n                </div>\r\n            </div>\r\n\r\n            <div class=\"row pt-5\">\r\n                <div class=\"col-12 p-3\">\r\n                    <h5 class=\"h2 text-uppercase text-warning text-center font-weight-bold\">Mais comment ça marche\r\n                        ?</h5>\r\n                </div>\r\n            </div>\r\n\r\n            <div class=\"row p-3 p-lg-5\">\r\n                <div class=\"col-12 col-lg-4 p-3 p-md-5 text-center\">\r\n                    <i class=\"fas fa-desktop text-warning fa-4x\"></i>\r\n                    <br>\r\n                    <p class=\"text-primary mt-3 h4\">Etape 1</p>\r\n                    <br>\r\n                    <p class=\"text-black-50 mt-3 h4\">Inscrivez-vous en ligne <br>\r\n                        dès maintenant. <br>\r\n                        Ça ne prend qu’une minute !</p>\r\n                </div>\r\n                <div class=\"col-12 col-lg-4 p-5 text-center\">\r\n                    <i class=\"fas fa-hard-hat text-warning fa-4x\"></i>\r\n                    <br>\r\n                    <p class=\"text-primary mt-3 h4\">Etape 1</p>\r\n                    <br>\r\n                    <p class=\"text-black-50 mt-3 h4\">Inscrivez-vous en ligne <br>\r\n                        dès maintenant. <br>\r\n                        Ça ne prend qu’une minute !</p>\r\n                </div>\r\n                <div class=\"col-12 col-lg-4 p-5 text-center\">\r\n                    <i class=\"fas fa-burn text-warning fa-4x\"></i>\r\n                    <br>\r\n                    <p class=\"text-primary mt-3 h4\">Etape 1</p>\r\n                    <br>\r\n                    <p class=\"text-black-50 mt-3 h4\">Inscrivez-vous en ligne <br>\r\n                        dès maintenant. <br>\r\n                        Ça ne prend qu’une minute !</p>\r\n                </div>\r\n            </div>\r\n\r\n            <div class=\"row align-items-center bg-light m-lg-4\">\r\n                <div class=\"col-12 col-lg-6 p-1 p-md-5\">\r\n                   <div class=\"col-12 p-5\">\r\n                       <h3 class=\"text-uppercase text-warning\">Votre nouvelle chaudière gaz</h3>\r\n                       <ul class=\"list-unstyled h5 mt-3 mt-md-5 text-black-50\">\r\n                           <li class=\"mb-3\"><i class=\"fas fa-star text-warning\"></i> Chaudière gaz condensation à très\r\n                               haute performance énergétique\r\n                           </li>\r\n                           <li class=\"mb-3\"><i class=\"fas fa-star text-warning\"></i> Installateurs qualifiés RGE</li>\r\n                           <li class=\"mb-3\"><i class=\"fas fa-star text-warning\"></i> Rendement saisonnier supérieur à 92 %\r\n                           </li>\r\n                           <li class=\"mb-3\"><i class=\"fas fa-star text-warning\"></i> Classe d’efficacité énergétique A</li>\r\n                           <li class=\"mb-3\"><i class=\"fas fa-star text-warning\"></i> Chaudière de 24 kW assurant le\r\n                               chauffage et l’eau chaude sanitaire\r\n                           </li>\r\n                           <li><i class=\"fas fa-star text-warning\"></i> Modulation de la puissance permettant de chauffer\r\n                               de manière économique\r\n                           </li>\r\n                       </ul>\r\n                   </div>\r\n                </div>\r\n                <div class=\"col-12 col-lg-6 p-1 p-md-5\">\r\n                    <div class=\"row align-items-center pr-5 pr-md-0 text-center\">\r\n                        <div class=\"col-6\">\r\n                            <img src=\"/img/chaudiere-daikin.png\" alt=\"Chaudiere\" height=\"400px\">\r\n                        </div>\r\n                        <div class=\"col-6\">\r\n                            <span class=\"display-1 text-warning font-weight-bold\" style=\"font-size:11em;text-shadow: 3px 1px 2px rgba(0, 0, 0, 0.3);\">0<small class=\"display-4\">€*</small></span>\r\n                            <br>\r\n                            <button class=\"btn btn-lg bg-custom text-white\">J\'en profite</button>\r\n                        </div>\r\n                    </div>\r\n                </div>\r\n            </div>\r\n            <div class=\"row pt-5\">\r\n                <div class=\"col-12 p-3 text-center\">\r\n                    <p class=\"text-black-50 font-weight-bold\">Votre chaudière gratuite</p>\r\n                    <h5 class=\"h2 text-uppercase text-warning text-center font-weight-bold\">EXPERTS EN REMPLACEMENT DE CHAUDIÈRES !</h5>\r\n                </div>\r\n            </div>\r\n            <div class=\"row ml-lg-2 mr-lg-2 mt-lg-5 mb-lg-5\">\r\n                <div class=\"col-12 col-lg-3 p-0\">\r\n                    <div class=\"col-12\">\r\n                        <img src=\"/img/video-alain.jpg\" alt=\"Vidéo alain\" width=\"100%\">\r\n                        <p class=\"text-primary mt-3 h4 mb-0\">Alain L.</p> <br>\r\n                        <p class=\"text-black-50 h4\">Client SimulationEnergie.fr</p>\r\n                    </div>\r\n                </div>\r\n                <div class=\"col-12 col-lg-3 p-0\">\r\n                    <div class=\"col-12\">\r\n                        <img src=\"/img/video-alain.jpg\" alt=\"Vidéo alain\" width=\"100%\">\r\n                        <p class=\"text-primary mt-3 h4 mb-0\">Alain L.</p> <br>\r\n                        <p class=\"text-black-50 h4\">Client SimulationEnergie.fr</p>\r\n                    </div>\r\n                </div>\r\n                <div class=\"col-12 col-lg-3 p-0\">\r\n                    <div class=\"col-12\">\r\n                        <img src=\"/img/video-alain.jpg\" alt=\"Vidéo alain\" width=\"100%\">\r\n                        <p class=\"text-primary mt-3 h4 mb-0\">Alain L.</p> <br>\r\n                        <p class=\"text-black-50 h4\">Client SimulationEnergie.fr</p>\r\n                    </div>\r\n                </div>\r\n                <div class=\"col-12 col-lg-3 p-0\">\r\n                    <div class=\"col-12\">\r\n                        <img src=\"/img/video-alain.jpg\" alt=\"Vidéo alain\" width=\"100%\">\r\n                        <p class=\"text-primary mt-3 h4 mb-0\">Alain L.</p> <br>\r\n                        <p class=\"text-black-50 h4\">Client SimulationEnergie.fr</p>\r\n                    </div>\r\n                </div>\r\n            </div>\r\n\r\n\r\n            <div class=\"row align-items-center bg-light m-2 m-lg-4 p-5\">\r\n                <div class=\"col-12  text-center\">\r\n                    <h4 class=\"text-warning text-uppercase font-weight-bold\">Pourquoi changer votre chaudière gaz ?</h4>\r\n                </div>\r\n                <div class=\"col-12 col-lg-4 p-3 p-md-5 text-center\">\r\n                    <i class=\"fab fa-creative-commons-nc-eu text-custom fa-4x\"></i>\r\n                    <br>\r\n                    <p class=\"text-warning mt-3 h4\">CHAUFFAGE ÉCONOMIQUE</p>\r\n                    <br>\r\n                    <p class=\"text-black-50 h5\">Jusqu’à 25% d’économies chaque mois\r\n                        par rapport à votre ancienne chaudière</p>\r\n                </div>\r\n                <div class=\"col-12 col-lg-4 p-3 p-md-5 text-center\">\r\n                    <i class=\"fab fa-cloudscale text-custom fa-4x\"></i>\r\n                    <br>\r\n                    <p class=\"text-warning mt-3 h4\">PRENEZ LA MAIN SUR VOTRE CONSOMMATION</p>\r\n                    <br>\r\n                    <p class=\"text-black-50 h5\">Thermostat d’ambiance pour piloter votre confort et garder le contrôle sur vos factures</p>\r\n                </div>\r\n                <div class=\"col-12 col-lg-4 p-3 p-md-5 text-center\">\r\n                    <i class=\"fas fa-home text-custom fa-4x\"></i>\r\n                    <br>\r\n                    <p class=\"text-warning mt-3 h4\">VALORISEZ VOTRE PATRIMOINE</p>\r\n                    <br>\r\n                    <p class=\"text-black-50 h5\">Un équipement de chauffage neuf,\r\n                        économe et design : un critère recherché</p>\r\n                </div>\r\n                <div class=\"col-12 col-lg-4 p-3 p-md-5 text-center\">\r\n                    <i class=\"fas fa-bolt text-custom fa-4x\"></i>\r\n                    <br>\r\n                    <p class=\"text-warning mt-3 h4\">ÉNERGIE ÉCONOME, AU COÛT ENCADRÉ</p>\r\n                    <br>\r\n                    <p class=\"text-black-50 h5\">Une énergie plus économe que l’électricité\r\n                        ou le fioul. Prix encadrés par l’État\r\n                    </p>\r\n                </div>\r\n                <div class=\"col-12 col-lg-4 p-3 p-md-5 text-center\">\r\n                    <i class=\"fas fa-eye text-custom fa-4x\"></i>\r\n                    <br>\r\n                    <p class=\"text-warning mt-3 h4\">DESIGN MODERNE</p>\r\n                    <br>\r\n                    <p class=\"text-black-50 h5\">Une ligne moderne qui s’intégrera\r\n                        parfaitement à votre intérieur</p>\r\n                </div>\r\n                <div class=\"col-12 col-lg-4 p-3 p-md-5 text-center\">\r\n                    <i class=\"fas fa-globe-europe text-custom fa-4x\"></i>\r\n                    <br>\r\n                    <p class=\"text-warning mt-3 h4\">BON POUR LE CLIMAT</p>\r\n                    <br>\r\n                    <p class=\"text-black-50 h5\">Une combustion qui libère moins de CO2 :\r\n                        réchauffez chez vous, pas le climat !</p>\r\n                </div>\r\n                <div class=\"col-12 text-center\">\r\n                    <button class=\"btn btn-lg bg-custom text-white\">J\'en profite</button>\r\n                </div>\r\n            </div>\r\n\r\n            <div class=\"row pt-5\">\r\n                <div class=\"col-12 p-3 text-center\">\r\n                    <p class=\"text-black-50 font-weight-bold\">Nos offres gratuite</p>\r\n                    <h5 class=\"h2 text-uppercase text-warning text-center font-weight-bold\">VOUS FAIRE ÉCONOMISER, DEPUIS DES ANNÉES :</h5>\r\n                    <h5 class=\"text-black-50\">En 2016, nous réduisions votre facture d’éclairage grâce à Mes Ampoules Gratuites. <br>\r\n                        Depuis 2017, nous optimisons l’isolation de votre maison grâce à Mes Combles Gratuits, Isoler Mon Plancher et Mon Calorifugeage Gratuit.\r\n                        <br>\r\n                        Nous avons enrichi notre savoir-faire : une expertise des solutions gratuites clés-en-main, pensées pour vous.</h5>\r\n                </div>\r\n            </div>\r\n            <div class=\"row p-lg-4\">\r\n                    <div class=\"col-12 col-lg-4\">\r\n                        <div class=\"col-12 bg-custom p-2 rounded text-center\">\r\n                            <img src=\"/img/simulation-energier-logo.png\" alt=\"Logo simulation-energie.fr\" style=\"max-width: 300px\" width=\"50%\">\r\n                            <div class=\"col-12 bg-white rounded mt-3 p-3\">\r\n                                <h5 class=\"text-custom p-0 m-0\">\r\n                                    4M de maisons équipées\r\n                                </h5>\r\n                            </div>\r\n                        </div>\r\n                    </div>\r\n                    <div class=\"col-12 col-lg-4 mt-3 mt-lg-0\">\r\n                        <div class=\"col-12 bg-custom p-2 rounded text-center\">\r\n                            <img src=\"/img/simulation-energier-logo.png\" alt=\"Logo simulation-energie.fr\" style=\"max-width: 300px\" width=\"50%\">\r\n                            <div class=\"col-12 bg-white rounded mt-3 p-3\">\r\n                                <h5 class=\"text-custom p-0 m-0\">\r\n                                    4M de maisons équipées\r\n                                </h5>\r\n                            </div>\r\n                        </div>\r\n                    </div>\r\n                    <div class=\"col-12 col-lg-4 mt-3 mt-lg-0\">\r\n                        <div class=\"col-12 bg-custom p-2 rounded text-center\">\r\n                            <img src=\"/img/simulation-energier-logo.png\" alt=\"Logo simulation-energie.fr\" style=\"max-width: 300px\" width=\"50%\">\r\n                            <div class=\"col-12 bg-white rounded mt-3 p-3\">\r\n                                <h5 class=\"text-custom p-0 m-0\">\r\n                                    4M de maisons équipées\r\n                                </h5>\r\n                            </div>\r\n                        </div>\r\n                    </div>\r\n                <div class=\"col-12 text-center p-5\">\r\n                    <button class=\"btn btn-lg bg-custom text-white\">J\'en profite</button>\r\n                </div>\r\n            </div>\r\n\r\n\r\n            <div class=\"row align-items-center bg-light m-2 m-lg-4 p-5 text-center\">\r\n                <div class=\"col-12\">\r\n                    <i class=\"fas fa-headset text-custom fa-4x\"></i>\r\n                </div>\r\n                <div class=\"col-12 mt-3\">\r\n                    <p class=\"h5 text-uppercase text-warning\">\r\n                        UNE QUESTION ? <br>\r\n                        CONTACTEZ-NOUS PAR TÉLÉPHONE OU PAR MAIL</p>\r\n                </div>\r\n                <div class=\"col-12 mt-3\">\r\n                    <p class=\"h5 text-custom\">\r\n                       TEL: 0 800 800 800 <br>\r\n                        MAIL: <a href=\"mailto:contact@simulation-energie.fr\">contact@simulation-energie.fr</a></p>\r\n                </div>\r\n                <div class=\"col-12 mt-5\">\r\n                    <img src=\"/img/simulation-energie-logo-black.png\" alt=\"Logo simulation-energie.fr\" style=\"max-width: 200px;opacity: .5\" width=\"50%\">\r\n                </div>\r\n            </div>\r\n\r\n        </div>', 1, 0, NULL, NULL, NULL, NULL, 'rgba(0, 104, 255, 1.0)', 2);

-- --------------------------------------------------------

--
-- Structure de la table `simulator`
--

DROP TABLE IF EXISTS `simulator`;
CREATE TABLE IF NOT EXISTS `simulator` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `page_id` int(11) DEFAULT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_81C34CA7C4663E4` (`page_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `tag`
--

DROP TABLE IF EXISTS `tag`;
CREATE TABLE IF NOT EXISTS `tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `page_id` int(11) DEFAULT NULL,
  `position` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `libelle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_389B783C4663E4` (`page_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `tag`
--

INSERT INTO `tag` (`id`, `page_id`, `position`, `content`, `libelle`) VALUES
(1, 2, 'bodyend', '<script>alert(\'gtag\')</script>', '');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `lead`
--
ALTER TABLE `lead`
  ADD CONSTRAINT `FK_289161CB6EF25FC3` FOREIGN KEY (`is_from_id`) REFERENCES `page` (`id`);

--
-- Contraintes pour la table `simulator`
--
ALTER TABLE `simulator`
  ADD CONSTRAINT `FK_81C34CA7C4663E4` FOREIGN KEY (`page_id`) REFERENCES `page` (`id`);

--
-- Contraintes pour la table `tag`
--
ALTER TABLE `tag`
  ADD CONSTRAINT `FK_389B783C4663E4` FOREIGN KEY (`page_id`) REFERENCES `page` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
