/*
SQLyog Ultimate v13.0.1 (64 bit)
MySQL - 5.7.36-0ubuntu0.18.04.1 : Database - login
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`login` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci */;

USE `login`;

/*Table structure for table `employees` */

DROP TABLE IF EXISTS `employees`;

CREATE TABLE `employees` (
  `sno` int(11) NOT NULL AUTO_INCREMENT,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Employee name',
  `f_name` text COLLATE utf8mb4_unicode_ci COMMENT 'Father name of the employee',
  `cnic` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'CNIC number of the employee',
  `cell_no` varchar(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'cell number of the employee/',
  `email` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `photo` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`sno`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `employees` */

insert  into `employees`(`sno`,`name`,`f_name`,`cnic`,`cell_no`,`email`,`address`,`photo`) values 
(1,'Shah Hussain','Illahi Bakhsh','15602-0262719-9','03466008855','shahhussain305@gmail.com',NULL,NULL),
(2,'User One','Test User','41243-234234-3','03139419449','shahhussain.ms@gmail.com',NULL,NULL);

/*Table structure for table `login` */

DROP TABLE IF EXISTS `login`;

CREATE TABLE `login` (
  `sno` int(11) NOT NULL AUTO_INCREMENT,
  `userid` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `userkey` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` int(11) NOT NULL COMMENT '1= null user, 2= Admin, 3=institution branch, 4=HVC branch, 5=Civil Revision Branch, 6=writ petition branch, 7=criminal appeal branch, 8=civil appeal branch, 9=copying branch, 10=record room, 11=store, 12=library, 13=PA to AR, 14=bar room, 15=information kiosk, 16=care taker, 17=administration branch',
  `emp_sno` int(11) DEFAULT NULL COMMENT 'from employee table sno to make relationship',
  `user_status` tinyint(1) DEFAULT '0' COMMENT '0=unlocked 1 = locked or Blocked',
  PRIMARY KEY (`sno`)
) ENGINE=InnoDB AUTO_INCREMENT=128 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `login` */

insert  into `login`(`sno`,`userid`,`userkey`,`role`,`emp_sno`,`user_status`) values 
(126,'shahhussain305@gmail.com','$2y$10$JLAkrfPFZ53QdWn58EAn6eIRWDjkZG0t6jbJOTomYRTrwaxColx32',3,1,1),
(127,'shahhussain.ms@gmail.com','$2y$10$JLAkrfPFZ53QdWn58EAn6eIRWDjkZG0t6jbJOTomYRTrwaxColx32',2,2,1);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
