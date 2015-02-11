/*
SQLyog Enterprise - MySQL GUI v8.12 
MySQL - 5.6.20 : Database - appointments
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

USE `appointments`;

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `first` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `last` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `subscription_id` int(10) unsigned DEFAULT '0',
  `is_active` tinyint(4) NOT NULL DEFAULT '1',
  `remember_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_username_unique` (`username`),
  KEY `users_subscription_id_foreign` (`subscription_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`first`,`last`,`email`,`username`,`password`,`subscription_id`,`is_active`,`remember_token`,`deleted_at`,`created_at`,`updated_at`) values (1,'Admin','User','admin1@gmail.com','admin','$2y$10$23StJqeHJLLSQ9..c0CSTOdc9cixJW0DQmfXQ.WEaDa/75r.rKMU6',0,1,'qAqcd8sL8Wn88ceznCXedCR83maRuDFeclR2CK86GVkL21FlJxdon9VMAMS4',NULL,'2014-12-31 18:28:15','2015-01-22 08:22:54'),(2,'Admin 2','User','admin2@gmail.com','admin2','$2y$10$HUv4fNkVppDpkE8s0i2fBeFoWO65TgvOABRrhYcc/3BoMopC6xjIG',1,1,'HgqnSKWm5hF5pbCavhlAQtn9oV1zQzvw6JmOaxQEUnrpfj1p8gic0cMIGWym',NULL,'2014-12-31 18:28:15','2015-01-22 08:22:33');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
