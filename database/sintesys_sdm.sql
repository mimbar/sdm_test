/*
 Navicat Premium Data Transfer

 Source Server         : Hura Hura
 Source Server Type    : MariaDB
 Source Server Version : 50560
 Source Host           : localhost:3232
 Source Schema         : sintesys_sdm

 Target Server Type    : MariaDB
 Target Server Version : 50560
 File Encoding         : 65001

 Date: 02/08/2019 18:20:46
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for menus
-- ----------------------------
DROP TABLE IF EXISTS `menus`;
CREATE TABLE `menus` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parentsID` int(11) NOT NULL,
  `order` int(11) NOT NULL DEFAULT '1',
  `modules` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of menus
-- ----------------------------
BEGIN;
INSERT INTO `menus` VALUES (1, 'Beranda', 'auth.logout', 'icon-home4', 0, 1, '', '2019-07-30 10:50:42', '2019-07-30 10:50:44');
INSERT INTO `menus` VALUES (2, 'ACL', '#', 'icon-gear', 0, 2, '', NULL, NULL);
INSERT INTO `menus` VALUES (3, 'Pengguna', 'kitchen.users.read', 'icon-users4', 2, 1, '', '2019-07-30 11:41:26', '2019-07-30 11:41:26');
INSERT INTO `menus` VALUES (4, 'Roles', 'kitchen.roles.read', 'fa fa-wrench', 2, 1, '', NULL, NULL);
INSERT INTO `menus` VALUES (5, 'Permissions', 'kitchen.permissions.read', 'fa fa-rocket', 2, 1, '', NULL, NULL);
INSERT INTO `menus` VALUES (6, 'Assign', 'kitchen.assign.read', 'fa fa-code-branch', 2, 1, '', NULL, NULL);
COMMIT;

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of migrations
-- ----------------------------
BEGIN;
INSERT INTO `migrations` VALUES (1, '2014_10_12_000000_create_users_table', 1);
INSERT INTO `migrations` VALUES (2, '2014_10_12_100000_create_password_resets_table', 1);
INSERT INTO `migrations` VALUES (3, '2019_07_29_073706_laratrust_setup_tables', 1);
INSERT INTO `migrations` VALUES (4, '2019_07_30_032838_create_menus_table', 2);
INSERT INTO `migrations` VALUES (5, '2019_08_02_105413_update_users_table', 3);
COMMIT;

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Table structure for permission_role
-- ----------------------------
DROP TABLE IF EXISTS `permission_role`;
CREATE TABLE `permission_role` (
  `permission_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `permission_role_role_id_foreign` (`role_id`),
  CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of permission_role
-- ----------------------------
BEGIN;
INSERT INTO `permission_role` VALUES (1, 1);
INSERT INTO `permission_role` VALUES (1, 2);
INSERT INTO `permission_role` VALUES (2, 1);
INSERT INTO `permission_role` VALUES (2, 2);
INSERT INTO `permission_role` VALUES (3, 1);
INSERT INTO `permission_role` VALUES (3, 2);
INSERT INTO `permission_role` VALUES (4, 1);
INSERT INTO `permission_role` VALUES (4, 2);
INSERT INTO `permission_role` VALUES (5, 1);
INSERT INTO `permission_role` VALUES (6, 1);
INSERT INTO `permission_role` VALUES (7, 1);
INSERT INTO `permission_role` VALUES (8, 1);
INSERT INTO `permission_role` VALUES (9, 1);
INSERT INTO `permission_role` VALUES (10, 1);
INSERT INTO `permission_role` VALUES (11, 1);
INSERT INTO `permission_role` VALUES (12, 1);
INSERT INTO `permission_role` VALUES (13, 1);
INSERT INTO `permission_role` VALUES (14, 1);
INSERT INTO `permission_role` VALUES (15, 1);
INSERT INTO `permission_role` VALUES (16, 1);
INSERT INTO `permission_role` VALUES (17, 1);
INSERT INTO `permission_role` VALUES (17, 2);
INSERT INTO `permission_role` VALUES (17, 3);
INSERT INTO `permission_role` VALUES (18, 1);
INSERT INTO `permission_role` VALUES (18, 2);
INSERT INTO `permission_role` VALUES (18, 3);
COMMIT;

-- ----------------------------
-- Table structure for permission_user
-- ----------------------------
DROP TABLE IF EXISTS `permission_user`;
CREATE TABLE `permission_user` (
  `permission_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `user_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`user_id`,`permission_id`,`user_type`),
  KEY `permission_user_permission_id_foreign` (`permission_id`),
  CONSTRAINT `permission_user_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Table structure for permissions
-- ----------------------------
DROP TABLE IF EXISTS `permissions`;
CREATE TABLE `permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of permissions
-- ----------------------------
BEGIN;
INSERT INTO `permissions` VALUES (1, 'users.create', 'Users Create', 'Users Create', '2019-08-01 04:35:15', '2019-08-01 04:35:15');
INSERT INTO `permissions` VALUES (2, 'users.read', 'Users Read', 'Users Read', '2019-08-01 04:35:15', '2019-08-01 04:35:15');
INSERT INTO `permissions` VALUES (3, 'users.update', 'Users Update', 'Users Update', '2019-08-01 04:35:15', '2019-08-01 04:35:15');
INSERT INTO `permissions` VALUES (4, 'users.delete', 'Users Delete', 'Users Delete', '2019-08-01 04:35:15', '2019-08-01 04:35:15');
INSERT INTO `permissions` VALUES (5, 'roles.create', 'Roles Create', 'Roles Create', '2019-08-01 04:35:15', '2019-08-01 04:35:15');
INSERT INTO `permissions` VALUES (6, 'roles.read', 'Roles Read', 'Roles Read', '2019-08-01 04:35:16', '2019-08-01 04:35:16');
INSERT INTO `permissions` VALUES (7, 'roles.update', 'Roles Update', 'Roles Update', '2019-08-01 04:35:16', '2019-08-01 04:35:16');
INSERT INTO `permissions` VALUES (8, 'roles.delete', 'Roles Delete', 'Roles Delete', '2019-08-01 04:35:16', '2019-08-01 04:35:16');
INSERT INTO `permissions` VALUES (9, 'permissions.create', 'Permissions Create', 'Permissions Create', '2019-08-01 04:35:16', '2019-08-01 04:35:16');
INSERT INTO `permissions` VALUES (10, 'permissions.read', 'Permissions Read', 'Permissions Read', '2019-08-01 04:35:16', '2019-08-01 04:35:16');
INSERT INTO `permissions` VALUES (11, 'permissions.update', 'Permissions Update', 'Permissions Update', '2019-08-01 04:35:16', '2019-08-01 04:35:16');
INSERT INTO `permissions` VALUES (12, 'permissions.delete', 'Permissions Delete', 'Permissions Delete', '2019-08-01 04:35:16', '2019-08-01 04:35:16');
INSERT INTO `permissions` VALUES (13, 'assign.create', 'Assign Create', 'Assign Create', '2019-08-01 04:35:16', '2019-08-01 04:35:16');
INSERT INTO `permissions` VALUES (14, 'assign.read', 'Assign Read', 'Assign Read', '2019-08-01 04:35:16', '2019-08-01 04:35:16');
INSERT INTO `permissions` VALUES (15, 'assign.update', 'Assign Update', 'Assign Update', '2019-08-01 04:35:16', '2019-08-01 04:35:16');
INSERT INTO `permissions` VALUES (16, 'assign.delete', 'Assign Delete', 'Assign Delete', '2019-08-01 04:35:16', '2019-08-01 04:35:16');
INSERT INTO `permissions` VALUES (17, 'profile.read', 'Profile Read', 'Profile Read', '2019-08-01 04:35:16', '2019-08-01 04:35:16');
INSERT INTO `permissions` VALUES (18, 'profile.update', 'Profile Update', 'Profile Update', '2019-08-01 04:35:16', '2019-08-01 04:35:16');
COMMIT;

-- ----------------------------
-- Table structure for role_user
-- ----------------------------
DROP TABLE IF EXISTS `role_user`;
CREATE TABLE `role_user` (
  `role_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `user_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`user_id`,`role_id`,`user_type`),
  KEY `role_user_role_id_foreign` (`role_id`),
  CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of role_user
-- ----------------------------
BEGIN;
INSERT INTO `role_user` VALUES (1, 1, 'App\\User');
INSERT INTO `role_user` VALUES (2, 2, 'App\\User');
INSERT INTO `role_user` VALUES (3, 3, 'App\\User');
INSERT INTO `role_user` VALUES (2, 4, 'Modules\\Users\\Entities\\User');
INSERT INTO `role_user` VALUES (3, 5, 'Modules\\Users\\Entities\\User');
INSERT INTO `role_user` VALUES (1, 6, 'Modules\\Users\\Entities\\User');
COMMIT;

-- ----------------------------
-- Table structure for roles
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of roles
-- ----------------------------
BEGIN;
INSERT INTO `roles` VALUES (1, 'ironman', 'Ironman', 'Ironman', '2019-08-01 04:35:15', '2019-08-01 04:35:15');
INSERT INTO `roles` VALUES (2, 'administrator', 'Administrator', 'Administrator', '2019-08-01 04:35:16', '2019-08-01 04:35:16');
INSERT INTO `roles` VALUES (3, 'user', 'User', 'User', '2019-08-01 04:35:16', '2019-08-01 04:35:16');
COMMIT;

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '$2y$10$Pt8AUS8kW.p8zvSvXzJnOOWEznHx.34u4h13zmqfzYalBLjA5DQ1C',
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '1',
  `clean` tinyint(4) NOT NULL DEFAULT '1',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_username_unique` (`username`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of users
-- ----------------------------
BEGIN;
INSERT INTO `users` VALUES (1, 'ironman', 'ironman@unsil.ac.id', '$2y$10$gnyOu9ZtV8ODJZFCkoP.y.iX8wcmYJSjr.Js6bLAcpr4xe.6TSzyq', 'Ironman', 1, 1, NULL, '2019-08-01 04:35:16', '2019-08-01 04:35:16', NULL);
INSERT INTO `users` VALUES (2, 'administrator', 'administrator@unsil.ac.id', '$2y$10$HzvZdgJ2RAkLh8re/P2VMOefYbAGBPeSwZkiPFviyZp7PGqeUu/FG', 'Administrator', 1, 1, NULL, '2019-08-01 04:35:16', '2019-08-01 04:35:16', NULL);
INSERT INTO `users` VALUES (3, 'user', 'user@unsil.ac.id', '$2y$10$0qzJkCJY0.BIS/QlcmwFAOJ8pFzL3qWY5JmFWtDxCzzKIo6hcyPla', 'User', 1, 1, NULL, '2019-08-01 04:35:16', '2019-08-01 04:35:16', NULL);
INSERT INTO `users` VALUES (4, 'dede', 'dede@unsil.ac.id', '$2y$10$37q0NXESny/TAelbAa3chufTv0S9.YpREOE42J9HmGEZ0YLdh0i6a', 'Dede Gunawanssss', 1, 1, NULL, '2019-08-02 09:57:28', '2019-08-02 10:44:29', NULL);
INSERT INTO `users` VALUES (5, 'dharmo', 'rfk@unsil.ac.id', '$2y$10$sCVmHNwO9lvH9qI.gWR4geisNdkJbYfDQb7wSFT5D59riflN2fdg2', 'dharmo insanis', 1, 1, NULL, '2019-08-02 10:02:01', '2019-08-02 10:44:41', NULL);
INSERT INTO `users` VALUES (6, 'adikhairul', 'adikhairul@unsil.ac.id', '$2y$10$a1gL7P1RtiWg62bSlX.0a.ivl0NnIRn3xHDLmvK0N4Pn23JDU6se.', 'Adi Khairulsss', 0, 0, NULL, '2019-08-02 10:02:35', '2019-08-02 11:18:05', NULL);
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
