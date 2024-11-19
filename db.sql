-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           8.0.30 - MySQL Community Server - GPL
-- SE du serveur:                Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Listage de la structure de la base pour sgi-db-anp
DROP DATABASE IF EXISTS `sgi-db-anp`;
CREATE DATABASE IF NOT EXISTS `sgi-db-anp` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `sgi-db-anp`;

-- Listage de la structure de table sgi-db-anp. chrono_ins
DROP TABLE IF EXISTS `chrono_ins`;
CREATE TABLE IF NOT EXISTS `chrono_ins` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `numero` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `num_debut` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `num_fin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `statut` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `numero` (`numero`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table sgi-db-anp.chrono_ins : ~5 rows (environ)
DELETE FROM `chrono_ins`;
INSERT INTO `chrono_ins` (`id`, `numero`, `num_debut`, `num_fin`, `statut`) VALUES
	(1, '001', '001', '010', 0),
	(3, '022', '1200', NULL, 1),
	(4, '05-2024', '1025', NULL, 1),
	(6, '06-2024', '4025', NULL, 1),
	(9, '07-2024', '6025', NULL, 1);

-- Listage de la structure de table sgi-db-anp. chrono_outs
DROP TABLE IF EXISTS `chrono_outs`;
CREATE TABLE IF NOT EXISTS `chrono_outs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `numero` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `num_debut` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `num_fin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `statut` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table sgi-db-anp.chrono_outs : ~3 rows (environ)
DELETE FROM `chrono_outs`;
INSERT INTO `chrono_outs` (`id`, `numero`, `num_debut`, `num_fin`, `statut`) VALUES
	(1, '001', '1023', '2006', 0),
	(2, '002', '1023', '2006', 0),
	(3, '002-2024', '1023', NULL, 1);

-- Listage de la structure de table sgi-db-anp. directions
DROP TABLE IF EXISTS `directions`;
CREATE TABLE IF NOT EXISTS `directions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sigle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table sgi-db-anp.directions : ~8 rows (environ)
DELETE FROM `directions`;
INSERT INTO `directions` (`id`, `name`, `sigle`, `created_at`, `updated_at`) VALUES
	(1, 'Présidence', 'PR', '2024-09-05 11:01:42', '2024-09-11 10:29:14'),
	(2, 'Secrétariat général', 'SG', '2024-09-11 10:29:46', '2024-09-11 10:29:46'),
	(3, 'Agence comptable', 'AC', '2024-09-11 10:30:15', '2024-09-11 10:30:15'),
	(4, 'Direction administrative et financière', 'DAF', '2024-09-11 10:30:53', '2024-09-11 10:30:53'),
	(5, 'Direction de la presse, de la production et de l\'information numérique', 'DPPIN', '2024-09-11 10:32:44', '2024-09-11 10:32:44'),
	(6, 'Direction de la documentation, de la publication et de l\'archivage numérique', 'DDPAN', '2024-09-11 10:33:53', '2024-09-11 10:33:53'),
	(7, 'Direction des études et des affaires juridiques', 'DEAJ', '2024-09-11 10:34:47', '2024-09-11 10:34:47'),
	(8, 'Direction de la communication et des relations extérieures', 'DCRE', '2024-09-11 10:35:58', '2024-09-11 10:35:58');

-- Listage de la structure de table sgi-db-anp. failed_jobs
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table sgi-db-anp.failed_jobs : ~0 rows (environ)
DELETE FROM `failed_jobs`;

-- Listage de la structure de table sgi-db-anp. imputations
DROP TABLE IF EXISTS `imputations`;
CREATE TABLE IF NOT EXISTS `imputations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name_agent` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_reception` datetime DEFAULT NULL,
  `letter_id` bigint unsigned NOT NULL,
  `direction_id` bigint unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `imputations_letter_id_foreign` (`letter_id`),
  KEY `imputations_direction_id_foreign` (`direction_id`),
  CONSTRAINT `imputations_direction_id_foreign` FOREIGN KEY (`direction_id`) REFERENCES `directions` (`id`),
  CONSTRAINT `imputations_letter_id_foreign` FOREIGN KEY (`letter_id`) REFERENCES `letters_ins` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table sgi-db-anp.imputations : ~2 rows (environ)
DELETE FROM `imputations`;
INSERT INTO `imputations` (`id`, `name_agent`, `date_reception`, `letter_id`, `direction_id`) VALUES
	(1, NULL, NULL, 1, 8),
	(2, NULL, NULL, 2, 8);

-- Listage de la structure de table sgi-db-anp. letters_ins
DROP TABLE IF EXISTS `letters_ins`;
CREATE TABLE IF NOT EXISTS `letters_ins` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `files` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `attachment` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'NON',
  `date_add` datetime NOT NULL,
  `date_number_correspond` date DEFAULT NULL,
  `expeditor` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `object` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code_instruction` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `etat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `chrono_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `delete_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `letters_ins_chrono_id_foreign` (`chrono_id`),
  KEY `letters_ins_user_id_foreign` (`user_id`),
  CONSTRAINT `letters_ins_chrono_id_foreign` FOREIGN KEY (`chrono_id`) REFERENCES `chrono_ins` (`id`),
  CONSTRAINT `letters_ins_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table sgi-db-anp.letters_ins : ~2 rows (environ)
DELETE FROM `letters_ins`;
INSERT INTO `letters_ins` (`id`, `files`, `attachment`, `date_add`, `date_number_correspond`, `expeditor`, `object`, `number`, `code_instruction`, `etat`, `status`, `chrono_id`, `user_id`, `created_at`, `updated_at`, `delete_at`) VALUES
	(1, 'courriers-arrive/05-2024/Invitaion-PRIMATURE_du_2024-11-12.pdf', 'NON', '2024-11-13 00:00:00', NULL, 'PRIMATURE', 'Invitaion', '056', 'diffuser', NULL, 'public', 4, 12, '2024-11-13 12:26:25', '2024-11-13 14:50:09', NULL),
	(2, 'courriers-arrive/06-2024/Invitation-HACA_du_2024-11-12.pdf', 'NON', '2024-11-12 00:00:00', NULL, 'HACA', 'Invitation', '215', NULL, NULL, 'public', 6, 13, '2024-11-13 15:19:56', '2024-11-13 15:19:56', NULL);

-- Listage de la structure de table sgi-db-anp. letters_outs
DROP TABLE IF EXISTS `letters_outs`;
CREATE TABLE IF NOT EXISTS `letters_outs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `files` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_send` datetime NOT NULL,
  `date_number_correspond` date DEFAULT NULL,
  `sender` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `object` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_reception` datetime DEFAULT NULL,
  `observation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `etat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `chrono_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `delete_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `letters_outs_chrono_id_foreign` (`chrono_id`),
  KEY `letters_outs_user_id_foreign` (`user_id`),
  CONSTRAINT `letters_outs_chrono_id_foreign` FOREIGN KEY (`chrono_id`) REFERENCES `chrono_outs` (`id`),
  CONSTRAINT `letters_outs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table sgi-db-anp.letters_outs : ~1 rows (environ)
DELETE FROM `letters_outs`;
INSERT INTO `letters_outs` (`id`, `files`, `date_send`, `date_number_correspond`, `sender`, `object`, `number`, `date_reception`, `observation`, `etat`, `status`, `chrono_id`, `user_id`, `delete_at`, `created_at`, `updated_at`) VALUES
	(1, 'courriers-depart/INVITATION-David_du_2024-10-28.pdf', '2024-10-28 00:00:00', NULL, 'David', 'INVITATION', '001', NULL, NULL, 'close', 'public', 2, 12, NULL, '2024-10-29 12:12:39', '2024-10-29 12:12:39');

-- Listage de la structure de table sgi-db-anp. migrations
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table sgi-db-anp.migrations : ~14 rows (environ)
DELETE FROM `migrations`;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_roles_table', 1),
	(2, '2014_10_12_100000_create_password_resets_table', 1),
	(3, '2019_08_19_000000_create_failed_jobs_table', 1),
	(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
	(5, '2024_06_25_110132_create_directions_table', 1),
	(6, '2024_06_25_112819_create_users_table', 1),
	(7, '2024_07_16_154644_create_chrono_ins_table', 1),
	(8, '2024_07_29_115748_create_chrono_outs_table', 1),
	(9, '2024_08_13_110445_create_letters_ins_table', 1),
	(10, '2024_08_21_095226_create_type_instructions_table', 1),
	(11, '2024_09_05_104311_create_imputations_table', 2),
	(12, '2024_10_08_103129_create_user_histories_table', 3),
	(13, '2024_10_15_122132_create_notifications_table', 4),
	(14, '2024_10_29_093809_create_letters_outs_table', 5);

-- Listage de la structure de table sgi-db-anp. notifications
DROP TABLE IF EXISTS `notifications`;
CREATE TABLE IF NOT EXISTS `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint unsigned NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table sgi-db-anp.notifications : ~11 rows (environ)
DELETE FROM `notifications`;
INSERT INTO `notifications` (`id`, `type`, `notifiable_type`, `notifiable_id`, `data`, `read_at`, `created_at`, `updated_at`) VALUES
	('2f672702-421c-46e5-bffc-860b36bffdbe', 'App\\Notifications\\CourrierNonReponduNotification', 'App\\Models\\User', 9, '{"letter_id":2,"titre":"Courrier non r\\u00e9pondu #CERAP","message":"Le courrier avec l\'objet << Invitation au vendredi du CERAP >> n\'a pas re\\u00e7u de r\\u00e9ponse dans les 48 heures. Direction concern\\u00e9 (DPPIN)"}', NULL, '2024-10-21 13:27:01', '2024-10-21 13:27:01'),
	('5e546578-f85b-4ee8-93b0-e631063a5c94', 'App\\Notifications\\CourrierNonReponduNotification', 'App\\Models\\User', 10, '{"letter_id":2,"titre":"Courrier non r\\u00e9pondu #CERAP","message":"Le courrier avec l\'objet << Invitation au vendredi du CERAP >> n\'a pas re\\u00e7u de r\\u00e9ponse dans les 48 heures. Direction concern\\u00e9 (DPPIN)"}', NULL, '2024-10-21 13:45:02', '2024-10-21 13:45:02'),
	('5f47b5d2-8018-47ec-bcf1-5db0f79b7a55', 'App\\Notifications\\CourrierNonReponduNotification', 'App\\Models\\User', 5, '{"letter_id":2,"titre":"Courrier non r\\u00e9pondu #CERAP","message":"Le courrier avec l\'objet << Invitation au vendredi du CERAP >> n\'a pas re\\u00e7u de r\\u00e9ponse dans les 48 heures. Direction concern\\u00e9 (DPPIN)"}', NULL, '2024-10-21 13:05:00', '2024-10-21 13:05:00'),
	('69684c2d-9b8f-45d2-ad9c-b3245dab4eba', 'App\\Notifications\\CourrierNonReponduNotification', 'App\\Models\\User', 12, '{"letter_id":2,"titre":"Courrier non r\\u00e9pondu #CERAP","message":"Le courrier avec l\'objet << Invitation au vendredi du CERAP >> n\'a pas re\\u00e7u de r\\u00e9ponse dans les 48 heures. Direction concern\\u00e9 (DPPIN)"}', '2024-11-06 10:38:27', '2024-10-19 14:53:01', '2024-11-06 10:38:27'),
	('71178a0d-a14b-4d12-adff-6d023dec7ca8', 'App\\Notifications\\CourrierNonReponduNotification', 'App\\Models\\User', 12, '{"letter_id":2,"titre":"Courrier date19 non r\\u00e9pondu #CERAP","message":"Le courrier avec l\'objet << Invitation au vendredi du CERAP >> n\'a pas re\\u00e7u de r\\u00e9ponse dans les 48 heures. Direction concern\\u00e9 (DPPIN)"}', '2024-11-06 12:11:20', '2024-11-06 11:24:12', '2024-11-06 12:11:20'),
	('7941de0e-2739-4ffe-915e-b3686c83c053', 'App\\Notifications\\CourrierNonReponduNotification', 'App\\Models\\User', 7, '{"letter_id":2,"titre":"Courrier non r\\u00e9pondu #CERAP","message":"Le courrier avec l\'objet << Invitation au vendredi du CERAP >> n\'a pas re\\u00e7u de r\\u00e9ponse dans les 48 heures. Direction concern\\u00e9 (DPPIN)"}', NULL, '2024-10-21 13:22:00', '2024-10-21 13:22:00'),
	('7c197afc-bf3c-4f04-acb5-3f6674cfc727', 'App\\Notifications\\CourrierNonReponduNotification', 'App\\Models\\User', 6, '{"letter_id":2,"titre":"Courrier non r\\u00e9pondu #CERAP","message":"Le courrier avec l\'objet << Invitation au vendredi du CERAP >> n\'a pas re\\u00e7u de r\\u00e9ponse dans les 48 heures. Direction concern\\u00e9 (DPPIN)"}', NULL, '2024-10-21 13:18:01', '2024-10-21 13:18:01'),
	('84a03b38-7dbd-4d45-b1e3-79705a3f3ed9', 'App\\Notifications\\CourrierNonReponduNotification', 'App\\Models\\User', 4, '{"letter_id":2,"titre":"Courrier non r\\u00e9pondu #CERAP","message":"Le courrier avec l\'objet << Invitation au vendredi du CERAP >> n\'a pas re\\u00e7u de r\\u00e9ponse dans les 48 heures. Direction concern\\u00e9 (DPPIN)"}', NULL, '2024-10-21 13:04:00', '2024-10-21 13:04:00'),
	('a9163fc6-ace7-4767-9eb3-1ee0bf8b02f7', 'App\\Notifications\\CourrierNonReponduNotification', 'App\\Models\\User', 1, '{"letter_id":2,"titre":"Courrier non r\\u00e9pondu #CERAP","message":"Le courrier avec l\'objet << Invitation au vendredi du CERAP >> n\'a pas re\\u00e7u de r\\u00e9ponse dans les 48 heures. Direction concern\\u00e9 (DPPIN)"}', NULL, '2024-10-21 11:43:00', '2024-10-21 11:43:00'),
	('ad6d1e03-963c-4161-a4d3-e54b9acb8aff', 'App\\Notifications\\CourrierNonReponduNotification', 'App\\Models\\User', 2, '{"letter_id":2,"titre":"Courrier non r\\u00e9pondu #CERAP","message":"Le courrier avec l\'objet << Invitation au vendredi du CERAP >> n\'a pas re\\u00e7u de r\\u00e9ponse dans les 48 heures. Direction concern\\u00e9 (DPPIN)"}', NULL, '2024-10-21 12:57:00', '2024-10-21 12:57:00'),
	('f22f3d97-40a4-4550-9e81-f6a311cd919b', 'App\\Notifications\\CourrierNonReponduNotification', 'App\\Models\\User', 3, '{"letter_id":2,"titre":"Courrier non r\\u00e9pondu #CERAP","message":"Le courrier avec l\'objet << Invitation au vendredi du CERAP >> n\'a pas re\\u00e7u de r\\u00e9ponse dans les 48 heures. Direction concern\\u00e9 (DPPIN)"}', NULL, '2024-10-21 13:03:01', '2024-10-21 13:03:01');

-- Listage de la structure de table sgi-db-anp. password_resets
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table sgi-db-anp.password_resets : ~0 rows (environ)
DELETE FROM `password_resets`;

-- Listage de la structure de table sgi-db-anp. personal_access_tokens
DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table sgi-db-anp.personal_access_tokens : ~0 rows (environ)
DELETE FROM `personal_access_tokens`;

-- Listage de la structure de table sgi-db-anp. roles
DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table sgi-db-anp.roles : ~4 rows (environ)
DELETE FROM `roles`;
INSERT INTO `roles` (`id`, `name`) VALUES
	(1, 'Administrateur'),
	(2, 'Assistante SG'),
	(3, 'Assistante PR'),
	(4, 'Agent Courrier');

-- Listage de la structure de table sgi-db-anp. type_instructions
DROP TABLE IF EXISTS `type_instructions`;
CREATE TABLE IF NOT EXISTS `type_instructions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table sgi-db-anp.type_instructions : ~8 rows (environ)
DELETE FROM `type_instructions`;
INSERT INTO `type_instructions` (`id`, `code`, `name`) VALUES
	(1, 'suite-a-donner', 'Suite à donner'),
	(2, 'allocution-préparer', 'Allocution à préparer'),
	(3, 'm-en-parler', 'M\'en parler'),
	(4, 'pour-suivi', 'Pour suivi'),
	(5, 'diffuser', 'A diffuser'),
	(6, 'me-voir', 'Me voir'),
	(7, 'repondre', 'Réponse à rédiger'),
	(8, 'classer', 'A classer');

-- Listage de la structure de table sgi-db-anp. users
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `full_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `statut` tinyint(1) NOT NULL DEFAULT '1',
  `letter_option` tinyint DEFAULT '0',
  `last_login_at` datetime DEFAULT NULL,
  `last_login_ip` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`username`) USING BTREE,
  KEY `users_role_id_foreign` (`role_id`),
  CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table sgi-db-anp.users : ~3 rows (environ)
DELETE FROM `users`;
INSERT INTO `users` (`id`, `full_name`, `username`, `email_verified_at`, `password`, `statut`, `letter_option`, `last_login_at`, `last_login_ip`, `role_id`, `created_at`, `updated_at`) VALUES
	(1, 'Alla Wilfried', 'wilfriedala94@gmail.com', NULL, '$2y$10$dbwPUqcLwto9eMGSrXum7uruOOhbbnlARBAgh9GOwwaI/dFurjtB.', 1, NULL, NULL, NULL, 1, '2024-10-03 11:09:09', '2024-10-21 15:37:35'),
	(12, 'Test User', 'test@anp.local', NULL, '$2y$10$/Ztgk2d/KtTo.IpN405BB.p5GFrBJqct2a.2PwW8Jz9EY8.rmBzBu', 1, NULL, NULL, NULL, 1, '2024-10-21 14:52:40', '2024-10-21 14:52:40'),
	(13, 'Athangba', 'assistante@anp.local', NULL, '$2y$10$O/i0woWTtkfDzD/.I.ERguoxcRTzg4d.Q/yzpCjPlVVoHq1EARhRC', 1, 0, NULL, NULL, 3, '2024-11-07 10:34:46', '2024-11-18 12:32:43');

-- Listage de la structure de table sgi-db-anp. user_histories
DROP TABLE IF EXISTS `user_histories`;
CREATE TABLE IF NOT EXISTS `user_histories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `names` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `operations` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_histories_user_id_foreign` (`user_id`),
  CONSTRAINT `user_histories_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=137 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table sgi-db-anp.user_histories : ~136 rows (environ)
DELETE FROM `user_histories`;
INSERT INTO `user_histories` (`id`, `names`, `operations`, `user_id`, `created_at`, `updated_at`) VALUES
	(1, 'Alla Wilfried', 'Connexion utilisateur', 1, '2024-10-08 12:01:01', '2024-10-08 12:01:01'),
	(2, 'Alla Wilfried', 'Connexion utilisateur', 1, '2024-10-08 12:01:27', '2024-10-08 12:01:27'),
	(3, 'Alla Wilfried', 'Connexion utilisateur', 1, '2024-10-08 12:16:30', '2024-10-08 12:16:30'),
	(4, 'Alla Wilfried', 'Connexion utilisateur', 1, '2024-10-15 09:01:59', '2024-10-15 09:01:59'),
	(5, 'Alla Wilfried', 'Connexion utilisateur', 1, '2024-10-15 14:28:36', '2024-10-15 14:28:36'),
	(6, 'Alla Wilfried', 'Connexion utilisateur', 1, '2024-10-16 11:38:18', '2024-10-16 11:38:18'),
	(7, 'Alla Wilfried', 'Connexion utilisateur', 1, '2024-10-16 14:31:49', '2024-10-16 14:31:49'),
	(8, 'Alla Wilfried', 'Connexion utilisateur', 1, '2024-10-21 10:39:32', '2024-10-21 10:39:32'),
	(9, 'Alla Wilfried', 'Enregistrement Utilisateur ==> Test User', 1, '2024-10-21 12:56:48', '2024-10-21 12:56:48'),
	(10, 'Alla Wilfried', 'Suppression compte utilisateur ==> Test User', 1, '2024-10-21 13:02:34', '2024-10-21 13:02:34'),
	(11, 'Alla Wilfried', 'Enregistrement Utilisateur ==> Test User', 1, '2024-10-21 13:02:44', '2024-10-21 13:02:44'),
	(12, 'Alla Wilfried', 'Suppression compte utilisateur ==> Test User', 1, '2024-10-21 13:03:26', '2024-10-21 13:03:26'),
	(13, 'Alla Wilfried', 'Enregistrement Utilisateur ==> Test User', 1, '2024-10-21 13:03:37', '2024-10-21 13:03:37'),
	(14, 'Alla Wilfried', 'Suppression compte utilisateur ==> Test User', 1, '2024-10-21 13:04:29', '2024-10-21 13:04:29'),
	(15, 'Alla Wilfried', 'Enregistrement Utilisateur ==> Test User', 1, '2024-10-21 13:04:42', '2024-10-21 13:04:42'),
	(16, 'Alla Wilfried', 'Suppression compte utilisateur ==> Test User', 1, '2024-10-21 13:12:01', '2024-10-21 13:12:01'),
	(17, 'Alla Wilfried', 'Enregistrement Utilisateur ==> Test User', 1, '2024-10-21 13:17:36', '2024-10-21 13:17:36'),
	(18, 'Alla Wilfried', 'Suppression compte utilisateur ==> Test User', 1, '2024-10-21 13:21:46', '2024-10-21 13:21:46'),
	(19, 'Alla Wilfried', 'Enregistrement Utilisateur ==> Test User', 1, '2024-10-21 13:21:55', '2024-10-21 13:21:55'),
	(20, 'Alla Wilfried', 'Suppression compte utilisateur ==> Test User', 1, '2024-10-21 13:22:54', '2024-10-21 13:22:54'),
	(21, 'Alla Wilfried', 'Enregistrement Utilisateur ==> Test User', 1, '2024-10-21 13:23:03', '2024-10-21 13:23:03'),
	(22, 'Alla Wilfried', 'Suppression compte utilisateur ==> Test User', 1, '2024-10-21 13:23:24', '2024-10-21 13:23:24'),
	(23, 'Alla Wilfried', 'Enregistrement Utilisateur ==> Test User', 1, '2024-10-21 13:26:10', '2024-10-21 13:26:10'),
	(24, 'Alla Wilfried', 'Suppression compte utilisateur ==> Test User', 1, '2024-10-21 13:43:58', '2024-10-21 13:43:58'),
	(25, 'Alla Wilfried', 'Enregistrement Utilisateur ==> Test User', 1, '2024-10-21 13:44:09', '2024-10-21 13:44:09'),
	(26, 'Alla Wilfried', 'Suppression compte utilisateur ==> Test User', 1, '2024-10-21 14:47:12', '2024-10-21 14:47:12'),
	(27, 'Alla Wilfried', 'Enregistrement Utilisateur ==> Test User', 1, '2024-10-21 14:51:57', '2024-10-21 14:51:57'),
	(28, 'Alla Wilfried', 'Suppression compte utilisateur ==> Test User', 1, '2024-10-21 14:52:11', '2024-10-21 14:52:11'),
	(29, 'Alla Wilfried', 'Enregistrement Utilisateur ==> Test User', 1, '2024-10-21 14:52:40', '2024-10-21 14:52:40'),
	(30, 'Test User', 'Connexion utilisateur', 12, '2024-10-21 14:54:03', '2024-10-21 14:54:03'),
	(31, 'Test User', 'Connexion utilisateur', 12, '2024-10-21 14:54:29', '2024-10-21 14:54:29'),
	(32, 'Test User', 'Modification Utilisateur ==> Alla Wilfried1', 12, '2024-10-21 15:07:48', '2024-10-21 15:07:48'),
	(33, 'Test User', 'Désactivation de compte utilisateur #ID ==> 1', 12, '2024-10-21 15:18:01', '2024-10-21 15:18:01'),
	(34, 'Test User', 'Activation de compte utilisateur #ID ==> 1', 12, '2024-10-21 15:37:11', '2024-10-21 15:37:11'),
	(35, 'Test User', 'Modification Utilisateur ==> Alla Wilfried', 12, '2024-10-21 15:37:35', '2024-10-21 15:37:35'),
	(36, 'Alla Wilfried', 'Connexion utilisateur', 1, '2024-10-21 15:37:50', '2024-10-21 15:37:50'),
	(37, 'Alla Wilfried', 'Réinitialisation mot de passe utilisateur #ID ==> 12', 1, '2024-10-21 15:40:33', '2024-10-21 15:40:33'),
	(38, 'Test User', 'Connexion utilisateur', 12, '2024-10-21 15:41:02', '2024-10-21 15:41:02'),
	(39, 'Test User', 'Connexion utilisateur', 12, '2024-10-23 12:05:25', '2024-10-23 12:05:25'),
	(40, 'Test User', 'Connexion utilisateur', 12, '2024-10-23 14:38:20', '2024-10-23 14:38:20'),
	(41, 'Test User', 'Connexion utilisateur', 12, '2024-10-29 09:07:48', '2024-10-29 09:07:48'),
	(42, 'Test User', 'Connexion utilisateur', 12, '2024-10-29 14:48:37', '2024-10-29 14:48:37'),
	(43, 'Test User', 'Connexion utilisateur', 12, '2024-11-05 09:25:28', '2024-11-05 09:25:28'),
	(44, 'Test User', 'Enregistrement courrier arrivé N° ==> 125', 12, '2024-11-05 09:28:57', '2024-11-05 09:28:57'),
	(45, 'Test User', 'Connexion utilisateur', 12, '2024-11-05 15:13:15', '2024-11-05 15:13:15'),
	(46, 'Test User', 'Mise en corbeille courrier arrivé N° ==> 3', 12, '2024-11-05 15:44:13', '2024-11-05 15:44:13'),
	(47, 'Test User', 'Connexion utilisateur', 12, '2024-11-06 09:00:03', '2024-11-06 09:00:03'),
	(48, 'Test User', 'Connexion utilisateur', 12, '2024-11-06 15:00:43', '2024-11-06 15:00:43'),
	(49, 'Test User', 'Connexion utilisateur', 12, '2024-11-07 10:33:39', '2024-11-07 10:33:39'),
	(50, 'Test User', 'Enregistrement Utilisateur ==> Athangba', 12, '2024-11-07 10:34:46', '2024-11-07 10:34:46'),
	(51, 'Athangba', 'Connexion utilisateur', 13, '2024-11-07 10:35:25', '2024-11-07 10:35:25'),
	(52, 'Athangba', 'Connexion utilisateur', 13, '2024-11-07 14:33:34', '2024-11-07 14:33:34'),
	(53, 'Athangba', 'Déconnexion utilisateur', 13, '2024-11-07 15:44:01', '2024-11-07 15:44:01'),
	(54, 'Athangba', 'Connexion utilisateur', 13, '2024-11-07 15:44:05', '2024-11-07 15:44:05'),
	(55, 'Athangba', 'Déconnexion utilisateur', 13, '2024-11-07 15:44:42', '2024-11-07 15:44:42'),
	(56, 'Athangba', 'Connexion utilisateur', 13, '2024-11-07 15:44:45', '2024-11-07 15:44:45'),
	(57, 'Athangba', 'Déconnexion utilisateur', 13, '2024-11-07 16:29:15', '2024-11-07 16:29:15'),
	(58, 'Athangba', 'Connexion utilisateur', 13, '2024-11-11 08:54:54', '2024-11-11 08:54:54'),
	(59, 'Athangba', 'Déconnexion utilisateur', 13, '2024-11-11 09:35:54', '2024-11-11 09:35:54'),
	(60, 'Athangba', 'Connexion utilisateur', 13, '2024-11-11 09:36:10', '2024-11-11 09:36:10'),
	(61, 'Athangba', 'Déconnexion utilisateur', 13, '2024-11-11 09:46:11', '2024-11-11 09:46:11'),
	(62, 'Athangba', 'Connexion utilisateur', 13, '2024-11-11 09:46:14', '2024-11-11 09:46:14'),
	(63, 'Athangba', 'Déconnexion utilisateur', 13, '2024-11-11 09:47:14', '2024-11-11 09:47:14'),
	(64, 'Athangba', 'Connexion utilisateur', 13, '2024-11-11 16:10:16', '2024-11-11 16:10:16'),
	(65, 'Athangba', 'Déconnexion utilisateur', 13, '2024-11-11 16:10:37', '2024-11-11 16:10:37'),
	(66, 'Athangba', 'Connexion utilisateur', 13, '2024-11-11 16:11:17', '2024-11-11 16:11:17'),
	(67, 'Athangba', 'Déconnexion utilisateur', 13, '2024-11-11 16:24:02', '2024-11-11 16:24:02'),
	(68, 'Athangba', 'Connexion utilisateur', 13, '2024-11-11 16:24:10', '2024-11-11 16:24:10'),
	(69, 'Athangba', 'Déconnexion utilisateur', 13, '2024-11-11 16:26:41', '2024-11-11 16:26:41'),
	(70, 'Athangba', 'Connexion utilisateur', 13, '2024-11-12 09:15:13', '2024-11-12 09:15:13'),
	(71, 'Athangba', 'Connexion utilisateur', 13, '2024-11-12 09:19:19', '2024-11-12 09:19:19'),
	(72, 'Athangba', 'Déconnexion utilisateur', 13, '2024-11-12 09:26:34', '2024-11-12 09:26:34'),
	(73, 'Athangba', 'Connexion utilisateur', 13, '2024-11-12 09:26:48', '2024-11-12 09:26:48'),
	(74, 'Athangba', 'Déconnexion utilisateur', 13, '2024-11-12 09:30:50', '2024-11-12 09:30:50'),
	(75, 'Test User', 'Connexion utilisateur', 12, '2024-11-13 09:38:50', '2024-11-13 09:38:50'),
	(76, 'Test User', 'Création du chrono N° ==> 05/2024', 12, '2024-11-13 10:03:58', '2024-11-13 10:03:58'),
	(77, 'Test User', 'Connexion utilisateur', 12, '2024-11-13 10:49:29', '2024-11-13 10:49:29'),
	(78, 'Test User', 'Enregistrement courrier arrivé N° ==> 2035', 12, '2024-11-13 11:43:12', '2024-11-13 11:43:12'),
	(79, 'Test User', 'Enregistrement courrier arrivé N° ==> 2035', 12, '2024-11-13 11:52:57', '2024-11-13 11:52:57'),
	(80, 'Test User', 'Enregistrement courrier arrivé N° ==> 2035', 12, '2024-11-13 12:26:25', '2024-11-13 12:26:25'),
	(81, 'Test User', 'Déconnexion utilisateur', 12, '2024-11-13 13:32:18', '2024-11-13 13:32:18'),
	(82, 'Athangba', 'Connexion utilisateur', 13, '2024-11-13 13:32:24', '2024-11-13 13:32:24'),
	(83, 'Athangba', 'Déconnexion utilisateur', 13, '2024-11-13 13:32:47', '2024-11-13 13:32:47'),
	(84, 'Athangba', 'Connexion utilisateur', 13, '2024-11-13 13:33:08', '2024-11-13 13:33:08'),
	(85, 'Athangba', 'Création du chrono N° ==> 05-2024', 13, '2024-11-13 13:59:50', '2024-11-13 13:59:50'),
	(86, 'Athangba', 'Création du chrono N° ==> 06-2024', 13, '2024-11-13 14:02:09', '2024-11-13 14:02:09'),
	(87, 'Athangba', 'Création du chrono N° ==> 07-2024', 13, '2024-11-13 14:25:29', '2024-11-13 14:25:29'),
	(88, 'Athangba', 'Modification courrier arrivé N° ==> 05-2024', 13, '2024-11-13 14:47:48', '2024-11-13 14:47:48'),
	(89, 'Athangba', 'Modification courrier arrivé N° ==> 05-2024', 13, '2024-11-13 14:50:09', '2024-11-13 14:50:09'),
	(90, 'Athangba', 'Modification imputation courrier arrivé ID ==> 05-2024', 13, '2024-11-13 14:55:28', '2024-11-13 14:55:28'),
	(91, 'Athangba', 'Enregistrement courrier arrivé N° ==> 215', 13, '2024-11-13 15:19:56', '2024-11-13 15:19:56'),
	(92, 'Athangba', 'Classification courrier arrivé ID ==> 056', 13, '2024-11-13 15:49:06', '2024-11-13 15:49:06'),
	(93, 'Athangba', 'Déconnexion utilisateur', 13, '2024-11-13 15:52:51', '2024-11-13 15:52:51'),
	(94, 'Athangba', 'Connexion utilisateur', 13, '2024-11-13 15:53:03', '2024-11-13 15:53:03'),
	(95, 'Athangba', 'Déconnexion utilisateur', 13, '2024-11-13 16:05:43', '2024-11-13 16:05:43'),
	(96, 'Athangba', 'Connexion utilisateur', 13, '2024-11-13 16:05:56', '2024-11-13 16:05:56'),
	(97, 'Athangba', 'Création du chrono départ N° ==> 002-2024', 13, '2024-11-13 16:25:56', '2024-11-13 16:25:56'),
	(98, 'Athangba', 'Fermeture du chrono départ N° ==> 002-2024', 13, '2024-11-13 16:26:54', '2024-11-13 16:26:54'),
	(99, 'Athangba', 'Connexion utilisateur', 13, '2024-11-14 14:34:09', '2024-11-14 14:34:09'),
	(100, 'Athangba', 'Classification courrier départ ID ==> 001', 13, '2024-11-14 15:44:48', '2024-11-14 15:44:48'),
	(101, 'Athangba', 'Déconnexion utilisateur', 13, '2024-11-14 16:02:20', '2024-11-14 16:02:20'),
	(102, 'Test User', 'Connexion utilisateur', 12, '2024-11-14 16:02:26', '2024-11-14 16:02:26'),
	(103, 'Test User', 'Déconnexion utilisateur', 12, '2024-11-14 16:30:19', '2024-11-14 16:30:19'),
	(104, 'Test User', 'Connexion utilisateur', 12, '2024-11-18 10:48:13', '2024-11-18 10:48:13'),
	(105, 'Test User', 'Déconnexion utilisateur', 12, '2024-11-18 11:22:35', '2024-11-18 11:22:35'),
	(106, 'Athangba', 'Connexion utilisateur', 13, '2024-11-18 11:22:39', '2024-11-18 11:22:39'),
	(107, 'Athangba', 'Déconnexion utilisateur', 13, '2024-11-18 11:29:40', '2024-11-18 11:29:40'),
	(108, 'Test User', 'Connexion utilisateur', 12, '2024-11-18 11:29:44', '2024-11-18 11:29:44'),
	(109, 'Test User', 'Déconnexion utilisateur', 12, '2024-11-18 11:55:59', '2024-11-18 11:55:59'),
	(110, 'Athangba', 'Connexion utilisateur', 13, '2024-11-18 11:56:04', '2024-11-18 11:56:04'),
	(111, 'Athangba', 'Déconnexion utilisateur', 13, '2024-11-18 12:03:23', '2024-11-18 12:03:23'),
	(112, 'Athangba', 'Connexion utilisateur', 13, '2024-11-18 12:03:28', '2024-11-18 12:03:28'),
	(113, 'Athangba', 'Déconnexion utilisateur', 13, '2024-11-18 12:03:50', '2024-11-18 12:03:50'),
	(114, 'Test User', 'Connexion utilisateur', 12, '2024-11-18 12:04:00', '2024-11-18 12:04:00'),
	(115, 'Test User', 'Déconnexion utilisateur', 12, '2024-11-18 12:07:10', '2024-11-18 12:07:10'),
	(116, 'Athangba', 'Connexion utilisateur', 13, '2024-11-18 12:07:15', '2024-11-18 12:07:15'),
	(117, 'Athangba', 'Déconnexion utilisateur', 13, '2024-11-18 12:23:50', '2024-11-18 12:23:50'),
	(118, 'Test User', 'Connexion utilisateur', 12, '2024-11-18 12:24:02', '2024-11-18 12:24:02'),
	(119, 'Test User', 'Modification Utilisateur ==> Athangba', 12, '2024-11-18 12:31:54', '2024-11-18 12:31:54'),
	(120, 'Test User', 'Modification Utilisateur ==> Athangba', 12, '2024-11-18 12:32:24', '2024-11-18 12:32:24'),
	(121, 'Test User', 'Modification Utilisateur ==> Athangba', 12, '2024-11-18 12:32:43', '2024-11-18 12:32:43'),
	(122, 'Test User', 'Déconnexion utilisateur', 12, '2024-11-18 12:32:52', '2024-11-18 12:32:52'),
	(123, 'Athangba', 'Connexion utilisateur', 13, '2024-11-18 12:32:56', '2024-11-18 12:32:56'),
	(124, 'Athangba', 'Déconnexion utilisateur', 13, '2024-11-18 12:36:11', '2024-11-18 12:36:11'),
	(125, 'Athangba', 'Connexion utilisateur', 13, '2024-11-18 14:59:48', '2024-11-18 14:59:48'),
	(126, 'Athangba', 'Déconnexion utilisateur', 13, '2024-11-18 15:40:12', '2024-11-18 15:40:12'),
	(127, 'Athangba', 'Connexion utilisateur', 13, '2024-11-18 15:40:27', '2024-11-18 15:40:27'),
	(128, 'Athangba', 'Déconnexion utilisateur', 13, '2024-11-18 15:41:54', '2024-11-18 15:41:54'),
	(129, 'Athangba', 'Connexion utilisateur', 13, '2024-11-18 15:42:03', '2024-11-18 15:42:03'),
	(130, 'Athangba', 'Déconnexion utilisateur', 13, '2024-11-18 15:43:38', '2024-11-18 15:43:38'),
	(131, 'Test User', 'Connexion utilisateur', 12, '2024-11-18 15:48:58', '2024-11-18 15:48:58'),
	(132, 'Test User', 'Imputation courrier arrivé ID ==> 215', 12, '2024-11-18 16:05:28', '2024-11-18 16:05:28'),
	(133, 'Test User', 'Imputation courrier arrivé ID ==> 215', 12, '2024-11-18 16:09:18', '2024-11-18 16:09:18'),
	(134, 'Test User', 'Déconnexion utilisateur', 12, '2024-11-18 16:26:42', '2024-11-18 16:26:42'),
	(135, 'Test User', 'Connexion utilisateur', 12, '2024-11-19 10:11:10', '2024-11-19 10:11:10'),
	(136, 'Test User', 'Déconnexion utilisateur', 12, '2024-11-19 11:59:18', '2024-11-19 11:59:18');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
