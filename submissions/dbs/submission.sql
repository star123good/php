/*
SQLyog Community Edition- MySQL GUI v8.05 
MySQL - 5.5.5-10.1.38-MariaDB : Database - bestplum_submissions
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

CREATE DATABASE /*!32312 IF NOT EXISTS*/`bestplum_submissions` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `bestplum_submissions`;

/*Table structure for table `oc_t_campaign_admin` */

DROP TABLE IF EXISTS `oc_t_campaign_admin`;

CREATE TABLE `oc_t_campaign_admin` (
  `pk_i_id` int(11) NOT NULL AUTO_INCREMENT,
  `s_password` varchar(255) DEFAULT NULL,
  `s_email` varchar(255) DEFAULT NULL,
  `s_email_password` varchar(255) DEFAULT NULL,
  `s_email_server` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`pk_i_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `oc_t_campaign_admin` */

insert  into `oc_t_campaign_admin`(`pk_i_id`,`s_password`,`s_email`,`s_email_password`,`s_email_server`) values (1,'qazik,123edc963mbc#&~pl,mat','Ernie72Shaw9@realreply.com','classifieds100','mail.realreply.com');

/*Table structure for table `oc_t_campaign_customer` */

DROP TABLE IF EXISTS `oc_t_campaign_customer`;

CREATE TABLE `oc_t_campaign_customer` (
  `pk_i_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `s_username` varchar(40) NOT NULL,
  `s_password` char(60) NOT NULL,
  `s_email` varchar(100) DEFAULT NULL,
  `s_flag_adminer` enum('Y','N') NOT NULL DEFAULT 'N',
  `s_flag_verify` enum('Y','N') NOT NULL DEFAULT 'N',
  `s_verify_code` varchar(50) DEFAULT NULL,
  `s_created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`pk_i_id`)
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8;

/*Data for the table `oc_t_campaign_customer` */

insert  into `oc_t_campaign_customer`(`pk_i_id`,`s_username`,`s_password`,`s_email`,`s_flag_adminer`,`s_flag_verify`,`s_verify_code`,`s_created_at`) values (51,'a','123456','admin','N','N','33a38a25ff6c22efb36392070a64614d','2019-06-19 13:20:41'),(52,'Matt','test','info@slimuniverse.com','N','N','58f82925499c49c1be46efa9d99210b3','2019-06-19 13:23:42'),(53,'Matt','test','info@quickregister.net','Y','N','02f828cfb2094dd4d5f724d9bdc42b3d','2019-06-19 13:29:21'),(54,'Matt','test','claire@slimuniverse.com','N','N','34fd644a0f81cf9511a256c68608663f','2019-06-19 13:41:49'),(55,'John','test','john@realreply.com','N','N','0c9f766c3bcbadcc422f154a64900a58','2019-06-19 13:59:04'),(56,'Ernie','classifieds100','Ernie72Shaw9@realreply.com','N','N','311292e5b272103937751fc89b8eea60','2019-06-19 14:05:59'),(57,'Claire','test','claire@slimuniverse.com','Y','N','c3fa1fa7ceeb0ad20c7f007be91d8319','2019-06-20 11:40:16'),(58,'Test 10','classifieds100','test10@realreply.com','N','Y','c97ee3c7f4da24a1678748dbf2c66f95','2019-06-22 09:14:53');

/*Table structure for table `oc_t_campaign_profile` */

DROP TABLE IF EXISTS `oc_t_campaign_profile`;

CREATE TABLE `oc_t_campaign_profile` (
  `pk_i_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fk_i_user_id` int(10) NOT NULL,
  `fk_i_customer_id` int(10) NOT NULL,
  `s_campaign_email` varchar(100) NOT NULL,
  `s_campaign_password` varchar(40) NOT NULL,
  `s_title` varchar(255) NOT NULL,
  `s_description` text NOT NULL,
  `s_html_description` enum('Y','N') NOT NULL DEFAULT 'N',
  `s_website` varchar(100) NOT NULL,
  `s_keywords` varchar(255) NOT NULL,
  `s_facebook_page` varchar(100) NOT NULL,
  `s_affiliage_link` varchar(100) NOT NULL,
  `s_youtube_url` varchar(100) NOT NULL,
  `s_address` varchar(255) NOT NULL,
  `s_phone` varchar(100) NOT NULL,
  `s_city_area` varchar(255) NOT NULL,
  `s_category` varchar(255) NOT NULL,
  `s_image_path` varchar(255) NOT NULL,
  `s_image_1` varchar(255) NOT NULL,
  `s_image_2` varchar(255) NOT NULL,
  `s_image_3` varchar(255) NOT NULL,
  `s_number_ads` int(10) NOT NULL,
  PRIMARY KEY (`pk_i_id`)
) ENGINE=InnoDB AUTO_INCREMENT=103 DEFAULT CHARSET=utf8;

/*Data for the table `oc_t_campaign_profile` */

insert  into `oc_t_campaign_profile`(`pk_i_id`,`fk_i_user_id`,`fk_i_customer_id`,`s_campaign_email`,`s_campaign_password`,`s_title`,`s_description`,`s_html_description`,`s_website`,`s_keywords`,`s_facebook_page`,`s_affiliage_link`,`s_youtube_url`,`s_address`,`s_phone`,`s_city_area`,`s_category`,`s_image_path`,`s_image_1`,`s_image_2`,`s_image_3`,`s_number_ads`) values (54,0,56,'Ernie72Shaw9@realreply.com','classifieds100','Please your ad on our high traffic site for free','																		123132\r\n15213\r\n12131231																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																				Please your ad on our high traffic site for free visit www.freeglobalclassifiedads.com																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																','N','http://www.freeglobalclassifiedads.com	','free advertising','www.freeglobalclassifiedads.com	','www.freeglobalclassifiedads.com	','https://youtu.be/ot_AvKX4Imw','1314','5555555555','Los Angeles','102','','','','',0),(99,0,58,'test10@realreply.com','classifieds100','Give Away Our Free Ebook and Earn Unlimited $98.50 Commissions','																																																																																																																																																																																																																																																																																																																																																																																																																																																									Give Away Our Free Ebook and Earn Unlimited $98.50 Commissions. Visit. https://www.classifiedsubmissions.com/freeebook2																																																																																																																																																																																																																																																																																																																																																																																																																									','N','https://www.classifiedsubmissions.com/freeebook2','free ebook','https://www.facebook.com/quickregisterseo','https://www.classifiedsubmissions.com/freeebook2','https://youtu.be/ot_AvKX4Imw','','','','102','','','','',1),(101,0,57,'claire@slimuniverse.com','test','tsdfsdf','	dfsds																','N','sdfsd','fsdfs','dfsfd','sdfsdfs','','','','','20','','','','',0),(102,0,57,'pangtest@realreply.com','pangtest','asdasdfasdf','																			sdasdfa																																','N','sdfasdf','asdfa','dsfasdf','','','','','','1','','','','',0);

/*Table structure for table `oc_t_campaign_register` */

DROP TABLE IF EXISTS `oc_t_campaign_register`;

CREATE TABLE `oc_t_campaign_register` (
  `pk_i_id` int(11) NOT NULL AUTO_INCREMENT,
  `s_customer_id` int(11) NOT NULL,
  `s_site_id` int(11) NOT NULL,
  `s_registered` enum('Y','N') NOT NULL DEFAULT 'N',
  `s_confirm` enum('Y','N') NOT NULL DEFAULT 'N',
  `s_register_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`pk_i_id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

/*Data for the table `oc_t_campaign_register` */

/*Table structure for table `oc_t_campaign_submit` */

DROP TABLE IF EXISTS `oc_t_campaign_submit`;

CREATE TABLE `oc_t_campaign_submit` (
  `pk_i_id` int(11) NOT NULL AUTO_INCREMENT,
  `s_customer_id` int(11) DEFAULT NULL,
  `s_profile_id` int(11) DEFAULT NULL,
  `s_site_id` int(11) DEFAULT NULL,
  `s_city_id` int(11) DEFAULT NULL,
  `s_submit_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`pk_i_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

/*Data for the table `oc_t_campaign_submit` */

/*Table structure for table `oc_t_campaign_url_list` */

DROP TABLE IF EXISTS `oc_t_campaign_url_list`;

CREATE TABLE `oc_t_campaign_url_list` (
  `pk_i_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `s_web_url` varchar(100) NOT NULL,
  `s_login_url` varchar(100) DEFAULT NULL,
  `s_default_url` varchar(100) DEFAULT NULL,
  `s_create_url` varchar(100) DEFAULT NULL,
  `s_register_url` varchar(150) DEFAULT NULL,
  `s_flag_enable` enum('Y','N') NOT NULL DEFAULT 'Y',
  PRIMARY KEY (`pk_i_id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8;

/*Data for the table `oc_t_campaign_url_list` */

insert  into `oc_t_campaign_url_list`(`pk_i_id`,`s_web_url`,`s_login_url`,`s_default_url`,`s_create_url`,`s_register_url`,`s_flag_enable`) values (1,'http://www.bestplumberfortlauderdale.com/classifieds/','http://www.bestplumberfortlauderdale.com/classifieds/user/login','http://www.bestplumberfortlauderdale.com/classifieds/index.php','http://www.bestplumberfortlauderdale.com/classifieds/item/new','http://www.bestplumberfortlauderdale.com/classifieds/index.php?page=private_register&action=private_register','Y'),(2,'http://www.freeglobalclassifiedads.com/','http://www.freeglobalclassifiedads.com/user/login','http://www.freeglobalclassifiedads.com/index.php','http://www.freeglobalclassifiedads.com/item/new','http://www.freeglobalclassifiedads.com/index.php?page=private_register&action=private_register','Y'),(3,'http://www.usafreeclassifieds.org/classifieds/','http://www.usafreeclassifieds.org/classifieds/user/login','http://www.usafreeclassifieds.org/classifieds/index.php','http://www.usafreeclassifieds.org/classifieds/item/new','http://www.usafreeclassifieds.org/classifieds/index.php?page=private_register&action=private_register','Y'),(4,'http://www.bestinjurylawyerusa.com/classifieds/','http://www.bestinjurylawyerusa.com/classifieds/user/login','http://www.bestinjurylawyerusa.com/classifieds/index.php','http://www.bestinjurylawyerusa.com/classifieds/item/new','http://www.bestinjurylawyerusa.com/classifieds/index.php?page=private_register&action=private_register','Y'),(5,'http://www.leadclub.net/classifieds/','http://www.leadclub.net/classifieds/user/login','http://www.leadclub.net/classifieds/index.php','http://www.leadclub.net/classifieds/item/new','http://www.leadclub.net/classifieds/index.php?page=private_register&action=private_register','Y'),(6,'http://www.quickregister.us/classifieds/','http://www.quickregister.us/classifieds/user/login','http://www.quickregister.us/classifieds/index.php','http://www.quickregister.us/classifieds/item/new','http://www.quickregister.us/classifieds/index.php?page=private_register&action=private_register','Y'),(7,'http://www.articledude.com/classifieds/','http://www.articledude.com/classifieds/user/login','http://www.articledude.com/classifieds/index.php','http://www.articledude.com/classifieds/item/new','http://www.articledude.com/classifieds/index.php?page=private_register&action=private_register','Y'),(8,'http://www.quickregister.info/classifieds/','http://www.quickregister.info/classifieds/user/login','http://www.quickregister.info/classifieds/index.php','http://www.quickregister.info/classifieds/item/new','http://www.quickregister.info/classifieds/index.php?page=private_register&action=private_register','Y'),(9,'http://www.classifiedadsubmissionservice.com/classifieds/','http://www.classifiedadsubmissionservice.com/classifieds/user/login','http://www.classifiedadsubmissionservice.com/classifieds/index.php','http://www.classifiedadsubmissionservice.com/classifieds/item/new','http://www.classifiedadsubmissionservice.com/classifieds/index.php?page=private_register&action=private_register','Y'),(10,'http://www.interleads.net/classifieds/','http://www.interleads.net/classifieds/user/login','http://www.interleads.net/classifieds/index.php','http://www.interleads.net/classifieds/item/new','http://www.interleads.net/classifieds/index.php?page=private_register&action=private_register','Y'),(11,'http://www.quickregisterhosting.com/classifieds/','http://www.quickregisterhosting.com/classifieds/user/login','http://www.quickregisterhosting.com/classifieds/index.php','http://www.quickregisterhosting.com/classifieds/item/new','http://www.quickregisterhosting.com/classifieds/index.php?page=private_register&action=private_register','Y'),(12,'http://targetedtraffic.freeglobalclassifiedads.com/','http://targetedtraffic.freeglobalclassifiedads.com/user/login','http://targetedtraffic.freeglobalclassifiedads.com/index.php','http://targetedtraffic.freeglobalclassifiedads.com/item/new','http://targetedtraffic.freeglobalclassifiedads.com/index.php?page=private_register&action=private_register','Y'),(13,'http://freeleads.freeglobalclassifiedads.com/','http://freeleads.freeglobalclassifiedads.com/user/login','http://freeleads.freeglobalclassifiedads.com/index.php','http://freeleads.freeglobalclassifiedads.com/item/new','http://freeleads.freeglobalclassifiedads.com/index.php?page=private_register&action=private_register','Y'),(14,'http://craigslistalternative.freeglobalclassifiedads.com/','http://craigslistalternative.freeglobalclassifiedads.com/user/login','http://craigslistalternative.freeglobalclassifiedads.com/index.php','http://craigslistalternative.freeglobalclassifiedads.com/item/new','http://craigslistalternative.freeglobalclassifiedads.com/index.php?page=private_register&action=private_register','Y'),(15,'http://affiliatemarketing.freeglobalclassifiedads.com/','http://affiliatemarketing.freeglobalclassifiedads.com/user/login','http://affiliatemarketing.freeglobalclassifiedads.com/index.php','http://affiliatemarketing.freeglobalclassifiedads.com/item/new','http://affiliatemarketing.freeglobalclassifiedads.com/index.php?page=private_register&action=private_register','Y'),(16,'http://adsglobe.freeglobalclassifiedads.com/','http://adsglobe.freeglobalclassifiedads.com/user/login','http://adsglobe.freeglobalclassifiedads.com/index.php','http://adsglobe.freeglobalclassifiedads.com/item/new','http://adsglobe.freeglobalclassifiedads.com/index.php?page=private_register&action=private_register','Y'),(17,'http://adlandpro.freeglobalclassifiedads.com/','http://adlandpro.freeglobalclassifiedads.com/user/login','http://adlandpro.freeglobalclassifiedads.com/index.php','http://adlandpro.freeglobalclassifiedads.com/item/new','http://adlandpro.freeglobalclassifiedads.com/index.php?page=private_register&action=private_register','Y'),(18,'http://adpost.freeglobalclassifiedads.com/','http://adpost.freeglobalclassifiedads.com/user/login','http://adpost.freeglobalclassifiedads.com/index.php','http://adpost.freeglobalclassifiedads.com/item/new','http://adpost.freeglobalclassifiedads.com/index.php?page=private_register&action=private_register','Y'),(19,'http://bizopp.freeglobalclassifiedads.com/','http://bizopp.freeglobalclassifiedads.com/user/login','http://bizopp.freeglobalclassifiedads.com/index.php','http://bizopp.freeglobalclassifiedads.com/item/new','http://bizopp.freeglobalclassifiedads.com/index.php?page=private_register&action=private_register','Y'),(20,'http://businessopportunity.freeglobalclassifiedads.com/','http://businessopportunity.freeglobalclassifiedads.com/user/login','http://businessopportunity.freeglobalclassifiedads.com/index.php','http://businessopportunity.freeglobalclassifiedads.com/item/new','http://businessopportunity.freeglobalclassifiedads.com/index.php?page=private_register&action=private_register','Y'),(21,'http://cheapwebsitetraffic.freeglobalclassifiedads.com/','http://cheapwebsitetraffic.freeglobalclassifiedads.com/user/login','http://cheapwebsitetraffic.freeglobalclassifiedads.com/index.php','http://cheapwebsitetraffic.freeglobalclassifiedads.com/item/new','http://cheapwebsitetraffic.freeglobalclassifiedads.com/index.php?page=private_register&action=private_register','Y'),(22,'http://claz.freeglobalclassifiedads.com/','http://claz.freeglobalclassifiedads.com/user/login','http://claz.freeglobalclassifiedads.com/index.php','http://claz.freeglobalclassifiedads.com/item/new','http://claz.freeglobalclassifiedads.com/index.php?page=private_register&action=private_register','Y'),(23,'http://freeadvertising.freeglobalclassifiedads.com/','http://freeadvertising.freeglobalclassifiedads.com/user/login','http://freeadvertising.freeglobalclassifiedads.com/index.php','http://freeadvertising.freeglobalclassifiedads.com/item/new','http://freeadvertising.freeglobalclassifiedads.com/index.php?page=private_register&action=private_register','Y'),(24,'http://freebusinessadvertising.freeglobalclassifiedads.com/','http://freebusinessadvertising.freeglobalclassifiedads.com/user/login','http://freebusinessadvertising.freeglobalclassifiedads.com/index.php','http://freebusinessadvertising.freeglobalclassifiedads.com/item/new','http://freebusinessadvertising.freeglobalclassifiedads.com/index.php?page=private_register&action=private_register','Y'),(25,'http://freeonlineadvertising.freeglobalclassifiedads.com/','http://freeonlineadvertising.freeglobalclassifiedads.com/user/login','http://freeonlineadvertising.freeglobalclassifiedads.com/index.php','http://freeonlineadvertising.freeglobalclassifiedads.com/item/new','http://freeonlineadvertising.freeglobalclassifiedads.com/index.php?page=private_register&action=private_register','Y'),(26,'http://gumtree.freeglobalclassifiedads.com/','http://gumtree.freeglobalclassifiedads.com/user/login','http://gumtree.freeglobalclassifiedads.com/index.php','http://gumtree.freeglobalclassifiedads.com/item/new','http://gumtree.freeglobalclassifiedads.com/index.php?page=private_register&action=private_register','Y'),(27,'http://getfreeads.freeglobalclassifiedads.com/','http://getfreeads.freeglobalclassifiedads.com/user/login','http://getfreeads.freeglobalclassifiedads.com/index.php','http://getfreeads.freeglobalclassifiedads.com/item/new','http://getfreeads.freeglobalclassifiedads.com/index.php?page=private_register&action=private_register','Y'),(28,'http://freetraffic.freeglobalclassifiedads.com/','http://freetraffic.freeglobalclassifiedads.com/user/login','http://freetraffic.freeglobalclassifiedads.com/index.php','http://freetraffic.freeglobalclassifiedads.com/item/new','http://freetraffic.freeglobalclassifiedads.com/index.php?page=private_register&action=private_register','Y'),(29,'http://locanto.freeglobalclassifiedads.com/','http://locanto.freeglobalclassifiedads.com/user/login','http://locanto.freeglobalclassifiedads.com/index.php','http://locanto.freeglobalclassifiedads.com/item/new','http://locanto.freeglobalclassifiedads.com/index.php?page=private_register&action=private_register','Y'),(30,'http://homebiz.freeglobalclassifiedads.com/','http://homebiz.freeglobalclassifiedads.com/user/login','http://homebiz.freeglobalclassifiedads.com/index.php','http://homebiz.freeglobalclassifiedads.com/item/new','http://homebiz.freeglobalclassifiedads.com/index.php?page=private_register&action=private_register','Y'),(31,'http://olx.freeglobalclassifiedads.com/','http://olx.freeglobalclassifiedads.com/user/login','http://olx.freeglobalclassifiedads.com/index.php','http://olx.freeglobalclassifiedads.com/item/new','http://olx.freeglobalclassifiedads.com/index.php?page=private_register&action=private_register','Y'),(32,'http://freeonlineclassifieds.freeglobalclassifiedads.com/','http://freeonlineclassifieds.freeglobalclassifiedads.com/user/login','http://freeonlineclassifieds.freeglobalclassifiedads.com/index.php','http://freeonlineclassifieds.freeglobalclassifiedads.com/item/new','http://freeonlineclassifieds.freeglobalclassifiedads.com/index.php?page=private_register&action=private_register','Y'),(34,'http://oodle.freeglobalclassifiedads.com/','http://oodle.freeglobalclassifiedads.com/user/login','http://oodle.freeglobalclassifiedads.com/index.php','http://oodle.freeglobalclassifiedads.com/item/new','http://oodle.freeglobalclassifiedads.com/index.php?page=private_register&action=private_register','Y'),(35,'http://pennysaver.freeglobalclassifiedads.com/','http://pennysaver.freeglobalclassifiedads.com/user/login','http://pennysaver.freeglobalclassifiedads.com/index.php','http://pennysaver.freeglobalclassifiedads.com/item/new','http://pennysaver.freeglobalclassifiedads.com/index.php?page=private_register&action=private_register','Y'),(36,'http://recycler.freeglobalclassifiedads.com/','http://recycler.freeglobalclassifiedads.com/user/login','http://recycler.freeglobalclassifiedads.com/index.php','http://recycler.freeglobalclassifiedads.com/item/new','http://recycler.freeglobalclassifiedads.com/index.php?page=private_register&action=private_register','Y');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
