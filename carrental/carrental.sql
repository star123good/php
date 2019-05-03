/*
SQLyog Community Edition- MySQL GUI v8.05 
MySQL - 5.5.5-10.1.34-MariaDB : Database - carrental
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

CREATE DATABASE /*!32312 IF NOT EXISTS*/`carrental` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `carrental`;

/*Table structure for table `admin` */

DROP TABLE IF EXISTS `admin`;

CREATE TABLE `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `UserName` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `updationDate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `admin` */

insert  into `admin`(`id`,`UserName`,`Password`,`updationDate`) values (1,'admin','21232f297a57a5a743894a0e4a801fc3','2018-12-13 11:52:34');

/*Table structure for table `bookings` */

DROP TABLE IF EXISTS `bookings`;

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstName` varchar(99) DEFAULT NULL,
  `LastName` varchar(99) DEFAULT NULL,
  `email` varchar(99) DEFAULT NULL,
  `telefoni` varchar(99) DEFAULT NULL,
  `frena` varchar(99) DEFAULT NULL,
  `frena2` varchar(99) DEFAULT NULL,
  `car` varchar(99) DEFAULT NULL,
  `extras` varchar(99) DEFAULT NULL,
  `loc1` varchar(99) DEFAULT NULL,
  `loc2` varchar(99) DEFAULT NULL,
  `date1` varchar(99) DEFAULT NULL,
  `date2` varchar(99) DEFAULT NULL,
  `time1` varchar(99) DEFAULT NULL,
  `time2` varchar(99) DEFAULT NULL,
  `mes` varchar(999) DEFAULT NULL,
  `carprice` varchar(99) DEFAULT NULL,
  `extraprice` varchar(99) DEFAULT NULL,
  `total` varchar(99) DEFAULT NULL,
  `locfee` varchar(99) DEFAULT NULL,
  `requestDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=212 DEFAULT CHARSET=utf8;

/*Data for the table `bookings` */

insert  into `bookings`(`id`,`firstName`,`LastName`,`email`,`telefoni`,`frena`,`frena2`,`car`,`extras`,`loc1`,`loc2`,`date1`,`date2`,`time1`,`time2`,`mes`,`carprice`,`extraprice`,`total`,`locfee`,`requestDate`,`Status`) values (211,'vitali','kartsivadz','amazonariee@gmail.com','111111111111','','','Toyota Camry  or similar','GPS','Tbilisi International Airport (meet & greet service)','Downtown office | (Radisson Blu Iveria hotel)','04/01/2019','04/16/2019','08:00','09:00','','496.5','70','666.5','100','2019-03-16 09:24:11',NULL),(210,'vitali','kartsivadz','test@gmail.com','111111111111','','','Renault logan  or similar','Full Insurance Child seatGPS','Batumi International Airport (meet & greet service)','Downtown office | (Radisson Blu Iveria hotel)','04/02/2019','04/04/2019','09:00','09:00','','57.6','90','159.6','12','2019-03-16 09:21:03',NULL),(209,'vitali','kartsivadz','test@gmail.com','111111111111','','','Renault logan  or similar','Full Insurance ','Downtown office | (Radisson Blu Iveria hotel)','Downtown office | (Radisson Blu Iveria hotel)','04/04/2019','05/01/2019','09:00','09:00','','553.5','140','693.5','0','2019-03-16 09:19:53',NULL),(208,'aaaaaaaa','aaaaaaaaaa','test@gmail.com','111111111111','','','Renault logan  or similar','Full Insurance ','Batumi International Airport (meet & greet service)','Kutaisi International Airport (meet & greet service)','03/16/2019','04/06/2019','09:00','24:00','','451','140','603','12','2019-03-16 09:03:21',NULL),(207,'vitali','kartsivadze','test@gmail.com','111111111111','','','Renault logan  or similar','Full Insurance ','Batumi International Airport (meet & greet service)','Kutaisi International Airport (meet & greet service)','03/16/2019','04/06/2019','09:00','24:00','','451','140','603','12','2019-03-16 09:02:48',NULL),(206,'vitali','kartsivadz','test@gmail.com','111111111111','','','Renault logan  or similar','Full Insurance ','Batumi International Airport (meet & greet service)','Kutaisi International Airport (meet & greet service)','03/16/2019','04/06/2019','09:00','24:00','','451','140','603','12','2019-03-16 08:35:54',NULL),(205,'vitali','kartsivadz','test@gmail.com','111111111111','','','Renault logan  or similar','Full Insurance ','Batumi International Airport (meet & greet service)','Kutaisi International Airport (meet & greet service)','03/16/2019','04/06/2019','09:00','24:00','','430.5','140','582.5','12','2019-03-16 08:32:35',NULL),(203,'vitali','kartsivadz','beqachagalidze@gmail.com','111111111111','','','Renault logan  or similar','Full Insurance ',NULL,NULL,NULL,NULL,NULL,NULL,'','161.7','140','301.7','0','2019-03-16 08:23:14',NULL),(204,'zzzzzzzzzzzzz','zzzzzzzzzzzzzz','amazonariee@gmail.com','591','','','Renault logan  or similar','Full Insurance ','Batumi International Airport (meet & greet service)','Kutaisi International Airport (meet & greet service)','03/16/2019','04/06/2019','09:00','24:00','','430.5','140','582.5','12','2019-03-16 08:29:23',NULL),(201,'vitali','kartsivadz','amazonariee@gmail.com','111111111111','','','Renault logan  or similar','Full Insurance ',NULL,NULL,NULL,NULL,NULL,NULL,'','430.5','140','582.5','12','2019-03-16 08:17:56',NULL),(202,'vitali','kartsivadz','amazonariee@gmail.com','111111111111','','','Renault logan  or similar','',NULL,NULL,NULL,NULL,NULL,NULL,'','574','0','574','0','2019-03-16 08:21:14',NULL),(199,'vitali','kartsivadz','amazonariee@gmail.com','111111111111','','','Renault logan  or similar','Full Insurance ',NULL,NULL,NULL,NULL,NULL,NULL,'','451','140','603','12','2019-03-16 08:12:14',NULL),(200,'vitali','kartsivadz','nairasharashidze@mail.ru','111','','','Renault logan  or similar','Full Insurance ',NULL,NULL,NULL,NULL,NULL,NULL,'','533','140','685','12','2019-03-16 08:14:37',NULL),(197,'vitali','kartsivadz','test@gmail.com','111111111111','','','Renault logan  or similar','Full Insurance ',NULL,NULL,NULL,NULL,NULL,NULL,'','451','140','591','0','2019-03-16 08:09:13',NULL),(198,'vitali','kartsivadz','test@gmail.com','111111111111','','','Renault logan  or similar','Full Insurance ',NULL,NULL,NULL,NULL,NULL,NULL,'','451','140','591','0','2019-03-16 08:11:22',NULL),(195,'igi','kartsivadz','chanchura123@bk.ru','111111111111','','','Renault logan  or similar','Child seat',NULL,NULL,NULL,NULL,NULL,NULL,'','594.5','105','699.5','0','2019-03-16 07:53:16',NULL),(196,'vitali','kartsivadz','amazonariee@gmail.com','111111111111','','','Renault logan  or similar','Full Insurance ',NULL,NULL,NULL,NULL,NULL,NULL,'','430.5','140','582.5','12','2019-03-16 08:02:59',NULL),(194,'33','33','test@gmail.com','33','','','Renault logan  or similar','Full Insurance ',NULL,NULL,NULL,NULL,NULL,NULL,'','430.5','140','582.5','12','2019-03-16 07:46:29',NULL),(193,'11','22','test@gmail.com','111111111111','','','Renault logan  or similar','Full Insurance ','Batumi International Airport (meet & greet service)','Kutaisi International Airport (meet & greet service)','03/16/2019','04/06/2019','09:00','24:00','','451','140','603','12','2019-03-16 07:44:42',NULL),(191,'qqqqqqqqqqqqqqqqqq','kartsivadze','amazonariee@gmail.com','111','','','Renault logan  or similar','Full Insurance ',NULL,NULL,NULL,NULL,NULL,NULL,'','430.5','140','582.5','12','2019-03-16 07:28:36',NULL),(192,'vitali','kartsivadze','nairasharashidze@mail.ru','591','','','Renault logan  or similar','Full Insurance ',NULL,NULL,NULL,NULL,NULL,NULL,'','430.5','140','582.5','12','2019-03-16 07:41:13',NULL),(190,'vitali','kartsivadz','test@gmail.com','111111111111','','','Renault logan  or similar','Full Insurance ','Batumi International Airport (meet & greet service)','Kutaisi International Airport (meet & greet service)','03/16/2019','04/06/2019','09:00','24:00','','451','140','603','12','2019-03-16 07:26:52',NULL),(189,'igi','kartsivadz','beqachagalidze@gmail.com','111111111111','','','Renault logan  or similar','GPS','Kutaisi International Airport (meet & greet service)','Downtown office | (Radisson Blu Iveria hotel)','04/02/2019','04/12/2019','09:00','09:00','','205','70','288','13','2019-03-16 07:08:08',NULL),(188,'vitali','kartsivadz','test@gmail.com','111111111111','','','Renault logan  or similar','WIFI Internet ','Downtown office | (Radisson Blu Iveria hotel)','Downtown office | (Radisson Blu Iveria hotel)','04/03/2019','05/01/2019','09:00','09:00','','574','70','644','0','2019-03-16 06:47:13',1);

/*Table structure for table `currencies` */

DROP TABLE IF EXISTS `currencies`;

CREATE TABLE `currencies` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `USD` float NOT NULL,
  `EUR` float NOT NULL,
  `GEL` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `currencies` */

insert  into `currencies`(`id`,`USD`,`EUR`,`GEL`) values (1,1,1.4,100);

/*Table structure for table `extras` */

DROP TABLE IF EXISTS `extras`;

CREATE TABLE `extras` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `price` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

/*Data for the table `extras` */

insert  into `extras`(`id`,`name`,`price`) values (1,'Full Insurance ',20),(2,'Child seat',15),(3,'GPS',10),(4,'WIFI Internet ',10);

/*Table structure for table `groups` */

DROP TABLE IF EXISTS `groups`;

CREATE TABLE `groups` (
  `idd` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `price1` double NOT NULL,
  `price2` double NOT NULL,
  `price3` double NOT NULL,
  `price4` double NOT NULL,
  `price5` double NOT NULL,
  `stopSale` int(11) NOT NULL,
  `stopSaleFrom` varchar(99) DEFAULT NULL,
  `stopSaleTo` varchar(99) DEFAULT NULL,
  `test` varchar(8999) NOT NULL,
  `tt` varchar(111) NOT NULL,
  PRIMARY KEY (`idd`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

/*Data for the table `groups` */

insert  into `groups`(`idd`,`name`,`price1`,`price2`,`price3`,`price4`,`price5`,`stopSale`,`stopSaleFrom`,`stopSaleTo`,`test`,`tt`) values (1,'Renault logan  or similar',28.8,28.1,25.6,23.1,20.5,1,'','','4',''),(2,'Toyota Corrola  or similar',40,39,35.5,32,28.5,0,'02/26/2019','03/26/2019','11','11'),(3,'Toyota Camry  or similar',48.8,45.3,41.2,37.1,33.1,0,NULL,NULL,'',''),(4,'Renault Duster or similar ',64.4,57.4,52.7,47.4,42.7,0,NULL,NULL,'',''),(5,'Toyota Rav 4 or similar',74.4,71.2,66.3,60.3,56.1,0,'22 February 2019','1 march 2019','1',''),(6,'Toyota Prado or similar',122.7,110.8,100.8,94.2,90.2,0,'03/01/2019','03/06/2019','',''),(7,'Hyundai H1  or similar',120.9,116.8,100.8,91,80.6,0,NULL,NULL,'',''),(8,'Toyota Land Cruiser 200 or Similar',171.78,155.12,141.12,131.88,90.2,0,'2019-04-01','2019-04-30','										2019-04-012019-04-30\r\n										','');

/*Table structure for table `languages` */

DROP TABLE IF EXISTS `languages`;

CREATE TABLE `languages` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `english` text NOT NULL,
  `georgian` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8;

/*Data for the table `languages` */

insert  into `languages`(`id`,`english`,`georgian`) values (1,'Home','მთავარი'),(2,'current','ნაკადი'),(3,'Vehicle Guide','ავტომობილი გზამკვლევი'),(4,'Product and Servises','ნაკეთობა და სამსახური'),(5,'Short Term Rentals','გაქირავება ვადა გაქირავება '),(6,'Long Term Rentals','გრძელი ვადა გაქირავება'),(7,'Corporate Rentals','კორპორაცია გაქირავება '),(8,'Chauffeur Service','მძღოლი სამსახური'),(9,'Transfer Service','გადარიცხვა სამსახური'),(10,'About Us','შესახებ ჩვენ '),(11,'FAQ',''),(12,'Contact Us','საკონტაქტო ჩვენ '),(13,'Language','ენა'),(14,'English','ინგლისური'),(15,'Georgian','ქართული'),(16,'Currency','ვალუტა '),(17,'USD','აშშ დოლარი'),(18,'EUR','ევრო'),(19,'GEL','ლარი'),(20,'Welcome to <span>our website</span>','მიღება კენ <span>ჩვენი ნახვა</span>'),(21,'Support','მხარდაჭერა'),(22,'We provide',''),(23,'Vehicle','ავტომობილი'),(24,'we offer all types of car groups',''),(25,'experience','გამოცდილება'),(26,'years of experiencebr',''),(27,'extras','დამატებითი'),(28,'popular extra services available',''),(29,'Site Menu','საიტი მენიუ'),(30,'Get in Touch','მიღება ში შეხება'),(31,'All Rights Reserved | Super Car Rent','ყველა უფლებები დაცულია | სუპერ ავტომობილი ქირა'),(32,'Make Your Rent','კეთება კეთება ქირა'),(33,'Pick Up Location','მოწყვეტა ზე ადგილმდებარეობა'),(34,'Drop Off Location','წვეთება დან ადგილმდებარეობა'),(35,'Date','თარიღი'),(36,'Time','მხარდაჭერა'),(37,'From','დან'),(38,'To','კენ'),(39,'Find','პოვნა');

/*Table structure for table `locations` */

DROP TABLE IF EXISTS `locations`;

CREATE TABLE `locations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `location` text NOT NULL,
  `locationFee` double DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

/*Data for the table `locations` */

insert  into `locations`(`id`,`location`,`locationFee`) values (1,'Downtown office | (Radisson Blu Iveria hotel)',0),(7,'Batumi International Airport (meet & greet service)',12),(2,'Tbilisi International Airport (meet & greet service)',100),(8,'Kutaisi International Airport (meet & greet service)',13);

/*Table structure for table `tblbooking` */

DROP TABLE IF EXISTS `tblbooking`;

CREATE TABLE `tblbooking` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userEmail` varchar(100) DEFAULT NULL,
  `VehicleId` int(11) DEFAULT NULL,
  `FromDate` varchar(20) DEFAULT NULL,
  `ToDate` varchar(20) DEFAULT NULL,
  `message` varchar(255) DEFAULT NULL,
  `Status` int(11) DEFAULT NULL,
  `PostingDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

/*Data for the table `tblbooking` */

insert  into `tblbooking`(`id`,`userEmail`,`VehicleId`,`FromDate`,`ToDate`,`message`,`Status`,`PostingDate`) values (1,'test@gmail.com',2,'22/06/2017','25/06/2017','Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco',1,'2017-06-19 16:15:43'),(2,'test@gmail.com',3,'30/06/2017','02/07/2017','Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco',2,'2017-06-26 16:15:43'),(3,'test@gmail.com',4,'02/07/2017','07/07/2017','Lorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ',0,'2017-06-26 17:10:06'),(4,'ww@gmail.com',2,'25/12/2018','26/12/2018','ewre',1,'2018-12-22 03:01:02'),(5,'usertest@gmail.com',1,'25/12/2018','26/12/2018','eqeqe',0,'2019-01-13 01:51:25'),(6,'usertest@gmail.com',1,'25/12/2018','26/12/2018','wqe',0,'2019-01-13 01:53:46'),(7,'usertest@gmail.com',1,'25/12/2018','26/12/2018','rqwrqwr',0,'2019-01-13 02:29:03'),(8,'usertest@gmail.com',5,'25/12/2018','26/12/2018','aa',0,'2019-01-15 02:02:31'),(9,'usertest@gmail.com',2,'25/12/2018','26/12/2018','123',0,'2019-01-15 10:51:53');

/*Table structure for table `tblcontactusinfo` */

DROP TABLE IF EXISTS `tblcontactusinfo`;

CREATE TABLE `tblcontactusinfo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Address` tinytext,
  `EmailId` varchar(255) DEFAULT NULL,
  `ContactNo` varchar(1111) DEFAULT NULL,
  `workingHours` text NOT NULL,
  `intro` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `tblcontactusinfo` */

insert  into `tblcontactusinfo`(`id`,`Address`,`EmailId`,`ContactNo`,`workingHours`,`intro`) values (1,'misamarti','info@supercarrent.ge','+995 599 188 481','mon-fri 9:00-21:00','Get Lost With Us in Georgia');

/*Table structure for table `tblcontactusquery` */

DROP TABLE IF EXISTS `tblcontactusquery`;

CREATE TABLE `tblcontactusquery` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `EmailId` varchar(120) DEFAULT NULL,
  `ContactNumber` char(11) DEFAULT NULL,
  `Message` longtext,
  `PostingDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

/*Data for the table `tblcontactusquery` */

insert  into `tblcontactusquery`(`id`,`name`,`EmailId`,`ContactNumber`,`Message`,`PostingDate`,`status`) values (1,'Anuj Kumar','webhostingamigo@gmail.com','2147483647','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum','2017-06-18 06:03:07',1),(2,'gfds','nairasharashidze@mail.ru','11111111111','dddd','2018-12-22 03:11:19',1),(3,'d','nairasharashidze@mail.ru','555555555','qeqw qeqw qe q wq eq eq','2019-01-11 11:26:52',1),(4,'1111','1111@gmail.com','s1111','1111','2019-01-11 11:36:36',NULL),(5,'da','adf@sd.ss','adsd','asda','2019-01-11 11:38:04',NULL),(6,'22222222222222','222@2222.com','2222','2222','2019-01-11 11:39:30',NULL),(7,'da','adf@sd.ss','adsd','asda','2019-01-11 11:40:27',NULL),(8,'sadas','nnngu@2222.com','wqeqwe','qweqw','2019-01-11 11:40:45',NULL),(9,'qweqwe','vi.kartsivadze@Gmail.com','qweqwe','qweqwe','2019-01-11 11:46:13',NULL),(10,'3333333333','nairasharashidze@mail.ru','33333333','33333333333','2019-01-11 12:20:52',NULL),(11,'4444444444','nairasharashidze@mail.ru','4444444444','44444444444444','2019-01-11 14:49:06',NULL),(12,'555555555','test@gmail.com','555555555','5555555','2019-01-11 14:51:30',NULL),(13,'qqqqqqqqqqqqqqqqq','vi.kartsivadze@Gmail.com','qqqqqqqqqq','qqqqqqqqqqqq','2019-01-11 16:05:22',NULL),(14,'','','qqq','ee','2019-01-11 16:07:35',NULL),(15,'','','eqweqwe','weqwe','2019-01-11 16:07:45',NULL),(16,'w','vi.kartsivadze@Gmail.com','www','wwww','2019-01-11 16:23:15',NULL),(17,'w','vi.kartsivadze@Gmail.com','ww','w','2019-01-11 16:24:35',NULL),(18,'q','vi.kartsivadze@Gmail.com','qqqqqqq','qqqqqqq','2019-01-11 16:33:15',NULL),(19,'qwe','vi.kartsivadze@Gmail.com','qwe','qwe','2019-01-11 16:34:12',NULL),(20,'dwqwd','vi.kartsivadze@Gmail.com','qwe','qwe','2019-01-11 16:41:22',NULL),(21,'qe','vi.kartsivadze@Gmail.com','qw','qw','2019-01-11 16:42:43',NULL),(22,'qwe','vi.kartsivadze@Gmail.com','qwe','qe','2019-01-11 16:43:31',NULL),(23,'w','vi.kartsivadze@Gmail.com','w','w','2019-01-12 07:53:27',NULL),(24,'sadas','nairasharashidze@mail.ru','eqw','eqw','2019-01-12 12:41:33',NULL);

/*Table structure for table `tblpages` */

DROP TABLE IF EXISTS `tblpages`;

CREATE TABLE `tblpages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `PageName` varchar(255) DEFAULT NULL,
  `type` varchar(255) NOT NULL DEFAULT '',
  `detail` longtext NOT NULL,
  `PageName_georgian` varchar(255) NOT NULL,
  `type_georgian` varchar(255) NOT NULL DEFAULT '',
  `detail_georgian` longtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

/*Data for the table `tblpages` */

insert  into `tblpages`(`id`,`PageName`,`type`,`detail`,`PageName_georgian`,`type_georgian`,`detail_georgian`) values (1,'Terms and Conditions','terms','<div><span style=\"font-weight: bold;\">The qualification of the driver</span></div><div>All the drivers must be at least 21 years old and must have an experience of driving a car for at least 1 year. The driver must have valid driving license and passport. International driving license is required only in case the national driving licenses are not valid in Georgia or not given in Latin letters.</div><div><br></div><div>Driver\'s license issued in countries that have signed the Vienna Convention are valid In the Georgia.</div><div><br></div><div><span style=\"font-weight: bold;\">Reservations</span></div><div>You can rent a car online through our web-page, by phone, e-mail or by visiting our office (Super Car Rent Address: .... ).</div><div><br></div><div>Renting is held only by a certain category of cars. We can’t guarantee a specific model, but we try to consider your preference when booking.</div><div><br></div><div>Working days and hours of Super Car Rent in Georgia</div><div>Monday - Friday 09:30 - 18:30</div><div>Saturday 10:00 - 15:00</div><div>Sunday - Closed</div><div><br></div><div>The minimum term of car reservations is 24 hours. There are no maximum terms of reservations. The 24 hour term begins when the customer signs the Rental Agreement and receives the car.</div><div><br></div><div><span style=\"font-weight: bold;\">Prices</span></div><div>The prices of car renting include: taxes, technical service, standard package of insurance. The renting price can include additional services as well.</div><div><br></div><div><span style=\"font-weight: bold;\">Options of payment</span></div><div>Super Car Rent accepts all the main types of credit cards: VISA, Eurocard/Mastercard as well as cash payments.</div><div>Payments through bank transfers are possible in the presence of the Chief Manager’s approval. The payments have to be made in GEL with the official rates set by the Central Bank of Georgia on the next day after the return of the vehicle. The exchange rate may be different from the rate that was set by the bank tenant.</div><div><br></div><div><span style=\"font-weight: bold;\">Acceptance and delivery of the vehicle</span></div><div>All the cars are given to the customers in the clean form, with full tank of petrol and have to be returned clean and with the full tank of petrol.</div><div>In case the car is returned not in the clean form, there is an additional fee of 22 GEL.</div><div>In case the tank of the returned car is not full. There is an additional fee of 3.0 GEL per liter.</div><div><br></div><div>Please note that this is not a fuel selling.</div><div><br></div><div>Super Car Rent has 1 office for cars acceptance and delivery:</div><div>- Head office – Address</div><div>- \"Tbilisi\" International airport - MEET AND GREET SERVICE</div><div><br></div><div>All the clients, who are renting and handing over the cars at the airport, must book the cars in advance.</div><div>The clients, who purchase or hand the cars over the airport, pay a fee for the rental point in the amount of 45 GEL.</div><div><br></div><div><span style=\"font-weight: bold;\">Insurance packages</span></div><div>Super Car Rent provides two types of insurance: standard package and full package.</div><div><br></div><div>The standard insurance package is included in the rental price. This package includes: insurance in case of an accident, insurance for theft, insurance of the passenger, compulsory third part insurance.</div><div><br></div><div>With standard insurance package, there is a deposit of 800 GEL. This sum is the amount of maximum liability and presents the maximum risk of the tenant.</div><div>The deposit will be returned in case the car was returned to the company in the same condition as when it was given to the tenant.</div><div>The full insurance package includes standard insurance, but in this case sum of not covered liability is equal to zero.</div><div><br></div><div>In the case of full insurance package there is an additional charge of 40 GEL per day. The maximum amount of additional charge is 400 GEL per rental during the whole term of rent.</div><div>This sum is non-refundable payment.</div><div><br></div><div>All the types of insurance are considered valid if:</div><div>- The name of the driver is set in the contract of Super Car Rent,</div><div>- The driver at the time of the accident is not under the influence of alcohol and drugs,</div><div>- If there is an act of the police and the security act.</div><div><br></div><div><span style=\"font-weight: bold;\">Restrictions while driving</span></div><div>The car can be driven on the territory of Georgia, Armenia, Azerbaijan and Turkey. A special permission of the employee of Super Car Rent is necessary for driving the car on the territory of Armenia, Azerbaijan and Turkey. Such service must be required in advance.</div><div><span style=\"font-size: 1em;\">&nbsp;</span><br></div><div><span style=\"font-weight: bold;\">Validity of the Conditions</span></div><div>A) Super Car Rent reserves the right of changing the Conditions unilaterally and without prior notice.</div><div>B) Breach of any of the paragraphs in the Conditions will not void the Agreement and will not free Super Car Rent or the Renter from fulfilling their obligations according to rest of the Conditions.</div><div>C) Any dispute between Super Car Rent and the Renter will be settled between the parties. If a settlement cannot be reached, the dispute will be settled by the Judiciary of the Republic of Georgia and according to the legislation of the Republic of Georgia.</div>										\r\n										','','',''),(22,'Services','services','serv','','',''),(2,'Privacy Policy','privacy','<span style=\"color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\">At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat</span>','','',''),(3,'About Us ','aboutus','										<span style=\"color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; text-align: justify;\">At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat</span>\r\n										','','',''),(11,'FAQ','faq','<div class=\"tourmaster-page-content\">\r\n\r\n\r\n\r\n      <div class=\"according\">\r\n      <br><h5 class=\"according_title\">\r\n        <div class=\"plus\">\r\n          <span class=\"wn\"></span>\r\n          <span class=\"wh\"></span>\r\n        </div>\r\n        <span class=\"te\">\r\n          How to book a car?        </span>\r\n      </h5>\r\n      <div class=\"according_content\">\r\n        <p>To make a reservation you can book it online through our easy to book system. Alternatively you can contact our reservation department, send us an email with your request or just visit our downtown location.</p>\r\n      </div>\r\n    </div>\r\n      <div class=\"according\">\r\n      <br><h5 class=\"according_title\">\r\n        <div class=\"plus\">\r\n          <span class=\"wn\"></span>\r\n          <span class=\"wh\"></span>\r\n        </div>\r\n        <span class=\"te\">\r\n          What documents do I need to rent a car?        </span>\r\n      </h5>\r\n      <div class=\"according_content\">\r\n        <p>Car renting requires a valid passport and driving license with a term of validity of at least one year. The driving license information must be written in Latin letters.</p>\r\n      </div>\r\n    </div>\r\n      <div class=\"according\">\r\n      <br><h5 class=\"according_title\">\r\n        <div class=\"plus\">\r\n          <span class=\"wn\"></span>\r\n          <span class=\"wh\"></span>\r\n        </div>\r\n        <span class=\"te\">\r\n          Can I reserve a specific (concrete) model of car?        </span>\r\n      </h5>\r\n      <div class=\"according_content\">\r\n        <p>Reservations are only for certain categories of vehicle and not on the specific model. However, we try to take into consideration your preferences.</p>\r\n      </div>\r\n    </div>\r\n      <div class=\"according\">\r\n      <br><h5 class=\"according_title\">\r\n        <div class=\"plus\">\r\n          <span class=\"wn\"></span>\r\n          <span class=\"wh\"></span>\r\n        </div>\r\n        <span class=\"te\">\r\n          Are there any logos or advertising signs on your cars?        </span>\r\n      </h5>\r\n      <div class=\"according_content\">\r\n        <p>No, there are no logos or advertising signs on the cars.</p>\r\n      </div>\r\n    </div>\r\n      <div class=\"according\">\r\n      <br><h5 class=\"according_title\">\r\n        <div class=\"plus\">\r\n          <span class=\"wn\"></span>\r\n          <span class=\"wh\"></span>\r\n        </div>\r\n        <span class=\"te\">\r\n          What is the minimum age of the driver?        </span>\r\n      </h5>\r\n      <div class=\"according_content\">\r\n        <p>The driver should be 23 years old or older, with minimum 2 years of driving experience to be able to rent Super Car Rent car.</p>\r\n      </div>\r\n    </div>\r\n      <div class=\"according\">\r\n      <br><h5 class=\"according_title\">\r\n        <div class=\"plus\">\r\n          <span class=\"wn\"></span>\r\n          <span class=\"wh\"></span>\r\n        </div>\r\n        <span class=\"te\">\r\n          What are the possible forms of payment?        </span>\r\n      </h5>\r\n      <div class=\"according_content\">\r\n        <p>You can pay with credit cards (VISA, Eurocard/Mastercard), cash or bank transfer.</p>\r\n      </div>\r\n    </div>\r\n      <div class=\"according\">\r\n      <br><h5 class=\"according_title\">\r\n        <div class=\"plus\">\r\n          <span class=\"wn\"></span>\r\n          <span class=\"wh\"></span>\r\n        </div>\r\n        <span class=\"te\">\r\n          Do I need to provide the number of my credit card in advance or to prepay?        </span>\r\n      </h5>\r\n      <div class=\"according_content\">\r\n        <p>Yes, the credit card number must be provided in case the car is booked at the airport.</p>\r\n      </div>\r\n    </div>\r\n      <div class=\"according\">\r\n      <br><h5 class=\"according_title\">\r\n        <div class=\"plus\">\r\n          <span class=\"wn\"></span>\r\n          <span class=\"wh\"></span>\r\n        </div>\r\n        <span class=\"te\">\r\n          How can I change the booking that is already confirmed?        </span>\r\n      </h5>\r\n      <div class=\"according_content\">\r\n        <p>There are variety of ways how to modify the already confirmed booking. You can modify it by visiting www.supercarrent.ge/modify/ edit field and do the changes.<br>\r\nOtherwise you can simply change your booking by contacting our agent through e-mail or on the phone.</p>\r\n      </div>\r\n    </div>\r\n      <div class=\"according\">\r\n      <br><h5 class=\"according_title\">\r\n        <div class=\"plus\">\r\n          <span class=\"wn\"></span>\r\n          <span class=\"wh\"></span>\r\n        </div>\r\n        <span class=\"te\">\r\n          Will I have an unlimited mileage when renting a car from Super Car Rent?        </span>\r\n      </h5>\r\n      <div class=\"according_content\">\r\n        <p>Yes, You will have an unlimited mileage while renting a car from Super Car Rent.</p>\r\n      </div>\r\n    </div>\r\n      <div class=\"according\">\r\n      <br><h5 class=\"according_title\">\r\n        <div class=\"plus\">\r\n          <span class=\"wn\"></span>\r\n          <span class=\"wh\"></span>\r\n        </div>\r\n        <span class=\"te\">\r\n          What additional services do you provide?        </span>\r\n      </h5>\r\n      <div class=\"according_content\">\r\n        <p>Our additional services include: Short Term Rentals, Long Term Rentals, Corporate Rentals, Chauffeur Service, Transfer Service, Extra Services &amp; Equipment.</p>\r\n      </div>\r\n    </div>\r\n      <div class=\"according\">\r\n      <br><h5 class=\"according_title\">\r\n        <div class=\"plus\">\r\n          <span class=\"wn\"></span>\r\n          <span class=\"wh\"></span>\r\n        </div>\r\n        <span class=\"te\">\r\n          How can I book additional services?        </span>\r\n      </h5>\r\n      <div class=\"according_content\">\r\n        <p>You can book additional services online through our web-page, by phone, e-mail or by visiting our office (Address).</p>\r\n      </div>\r\n    </div>\r\n      <div class=\"according\">\r\n      <br><h5 class=\"according_title\">\r\n        <div class=\"plus\">\r\n          <span class=\"wn\"></span>\r\n          <span class=\"wh\"></span>\r\n        </div>\r\n        <span class=\"te\">\r\n          If I have booked a car at the airport, how can I meet an employer of Super Car Rent?        </span>\r\n      </h5>\r\n      <div class=\"according_content\">\r\n        <p>After the baggage claim and the exit to the Arrivals Hall, an employee of Super Car Rent will be waiting for You with a sign with your name.</p>\r\n      </div>\r\n    </div>\r\n      <div class=\"according\">\r\n      <br><h5 class=\"according_title\">\r\n        <div class=\"plus\">\r\n          <span class=\"wn\"></span>\r\n          <span class=\"wh\"></span>\r\n        </div>\r\n        <span class=\"te\">\r\n          What shall I do if the car has to be taken up at the airport and the flight was delayed?        </span>\r\n      </h5>\r\n      <div class=\"according_content\">\r\n        <p>If the flight number is set in the reservation, You will not have to tell us about the delay of your flight. Our employee will be informed beforehand and comes at the airport by the time of your arrival.</p>\r\n      </div>\r\n    </div>\r\n      <div class=\"according\">\r\n      <br><h5 class=\"according_title\">\r\n        <div class=\"plus\">\r\n          <span class=\"wn\"></span>\r\n          <span class=\"wh\"></span>\r\n        </div>\r\n        <span class=\"te\">\r\n          Can I drive the car outside the borders of Georgia?        </span>\r\n      </h5>\r\n      <div class=\"according_content\">\r\n        <p>Yes, You can drive the car outside the borders of Georgia. It’s necessary to warn the employees of Super Car Rent about that in advance and get a corresponding resolution.</p>\r\n      </div>\r\n    </div>\r\n      <div class=\"according\">\r\n      <br><h5 class=\"according_title\">\r\n        <div class=\"plus\">\r\n          <span class=\"wn\"></span>\r\n          <span class=\"wh\"></span>\r\n        </div>\r\n        <span class=\"te\">\r\n          What types of insurances do You offer?        </span>\r\n      </h5>\r\n      <div class=\"according_content\">\r\n        <p>Here we have good news for you. Only Super Car Rent offers two types of insurance.<br>\r\n1. Standard Insurance which covers CDW, TP, WL. In this case a customer is financially responsible for maxium 400 USD for any kind of damages.<br>\r\n2. Super Cover. Buying super cover a customer relieves him/her from any kind of financial responsibilities in case of accidents. The only thing he/she needs to do is to stay within the frames of the contract.</p>\r\n      </div>\r\n    </div>\r\n      <div class=\"according\">\r\n      <br><h5 class=\"according_title\">\r\n        <div class=\"plus\">\r\n          <span class=\"wn\"></span>\r\n          <span class=\"wh\"></span>\r\n        </div>\r\n        <span class=\"te\">\r\n          What should be done in case of an accident?        </span>\r\n      </h5>\r\n      <div class=\"according_content\">\r\n        <p>In case of an accident it\'s necessary to stop the car and inform the insurance company and road police about the accident, then call the employees of Super Car Rent.<br>\r\nAll necessary contact information will be passed to the tenant when receiving the car. All the necessary contact information are generally provided at the moment of rental.</p>\r\n      </div>\r\n    </div>\r\n      <div class=\"according\">\r\n      <br><h5 class=\"according_title\">\r\n        <div class=\"plus\">\r\n          <span class=\"wn\"></span>\r\n          <span class=\"wh\"></span>\r\n        </div>\r\n        <span class=\"te\">\r\n          What should be done if the car is broken?        </span>\r\n      </h5>\r\n      <div class=\"according_content\">\r\n        <p>In case of the car damage, You will need to contact our Technical group for further instructions.</p>\r\n      </div>\r\n    </div>\r\n      <div class=\"according\">\r\n      <br><h5 class=\"according_title\">\r\n        <div class=\"plus\">\r\n          <span class=\"wn\"></span>\r\n          <span class=\"wh\"></span>\r\n        </div>\r\n        <span class=\"te\">\r\n          Is it possible to pick up a car at one rental point and hand it over at another point?        </span>\r\n      </h5>\r\n      <div class=\"according_content\">\r\n        <p>Yes, it\'s possible, but in that case there can be some charges depending on the car rental and delivery place.</p>\r\n      </div>\r\n    </div>\r\n      <div class=\"according\">\r\n      <br><h5 class=\"according_title\">\r\n        <div class=\"plus\">\r\n          <span class=\"wn\"></span>\r\n          <span class=\"wh\"></span>\r\n        </div>\r\n        <span class=\"te\">\r\n          In which form should the car be handed?        </span>\r\n      </h5>\r\n      <div class=\"according_content\">\r\n        <p>The car must be clean and with a full tank of petrol.</p>\r\n      </div>\r\n    </div>\r\n      <div class=\"according\">\r\n      <br><h5 class=\"according_title\">\r\n        <div class=\"plus\">\r\n          <span class=\"wn\"></span>\r\n          <span class=\"wh\"></span>\r\n        </div>\r\n        <span class=\"te\">\r\n          Will additional charges be incurred in case the delivery of the car is delayed?        </span>\r\n      </h5>\r\n      <div class=\"according_content\">\r\n        <p>In case the delivery of the car is delayed until 2 hours, there is an additional fee- 21 GEL per hour. In case the delivery of the car is delayed for more than 2 hours, there is an additional fee for a day.<br>\r\nIn case the delivery of the car is delayed for more than 3 hours, there is an additional fee for a day</p>\r\n      </div>\r\n    </div>\r\n      <div class=\"according\">\r\n      <br><h5 class=\"according_title\">\r\n        <div class=\"plus\">\r\n          <span class=\"wn\"></span>\r\n          <span class=\"wh\"></span>\r\n        </div>\r\n        <span class=\"te\">\r\n          When will I be refunded the money, blocked on the card as a security deposit?        </span>\r\n      </h5>\r\n      <div class=\"according_content\">\r\n        <p>The period of repayment depends on the client’s bank, so we cannot determine the exact date of return. However, the repayment period of the blocked money is approximately from 10-14 banking days.</p>\r\n      </div>\r\n    </div>\r\n      <div class=\"according\">\r\n      <br><h5 class=\"according_title\">\r\n        <div class=\"plus\">\r\n          <span class=\"wn\"></span>\r\n          <span class=\"wh\"></span>\r\n        </div>\r\n        <span class=\"te\">\r\n          What if I have another questions?        </span>\r\n      </h5>\r\n      <div class=\"according_content\">\r\n        <p>If you have another questions, you can write to our e-mail  or call us on the phone </p>\r\n      </div>\r\n    </div>\r\n  \r\n    </div>','','',''),(23,'Short Term Rentals','str','<div>“Super Car Rent” company is providing for its customers affordable packages for short term car rentals in Georgia. Specialized solutions are intended to suit the needs of business partners and individuals.</div><div><br></div><div>The Duration of your car rental in Georgia</div><div>Short Terms car rentals are considered to be from 1 to 30 days rentals. However, you can still extend the duration of your car rental after the expiring date. For exploring our late model cars available for hiring check our vehicle guide. For renting a car for more that 30 days you can check our long term car rental service with suitable packages.</div><div><br></div><div>This product is defined for those who plan to visit Georgia for some short period and need to rent a car. With us Car Hire in Georgia is not a hassle. You can choose your desired car from the big range of vehicles both on the web site and visiting our downtown location where our company representatives will guide you to the best solutions.</div><div><br></div><div>Why to choose short term car rental?</div><div>Short term car rental service is a perfect solution for those who are planning a short trip and want to manage to discover Georgia. Car hire in Tbilisi is affordable, petrol is cheap, people are hospitable.</div><div><br></div><div>There are three International Airport in Georgia – Tbilisi International Airport, Batumi International Airport and Kutaisi International Airport. For those who want to rent a car from the airport we offer Meet and Greet Service 24/7.&nbsp; We have special benefits for the night time pick-ups at the airport offering free transfer to find the way to the hotel in Goergia.</div><div><br></div><div>Where to get the car?</div><div>Basically the most of the rentals are served at our Tbilisi downtown location which is located at (address). You can easily find us or follow our location visiting our contact page.</div><div><br></div><div>We take care of our customers replacement by meeting all types of requirements. Our cars are always available for your short term hire as a flexible alternative. We differ every customer’s needs and prioritize each of them.</div><div><br></div><div>Short Term car rental in Tbilisi is a good solution to discover Georgia. In recent decades personal transportation has become more important, as having your own car means freedom and independence. So while being in Georgia you can rent Super Car Rent cars to maintain your regular day pace.</div><div><br></div><div>Our customers, both international and local ones get Georgian hospitable service. They are provided with the best car renting terms; get to choose cars from the widest vehicle fleet of new car models in Georgian market.</div><div><br></div><div>For a short term rental you get:</div><div><br></div><div>– Newest fleet</div><div>– Wide choice of vehicle models</div><div>– Unlimited mileage</div><div>– 24/7 technical assistance</div><div>– Full maintenance services</div><div>– CDW, TP, PAI, TPI included</div><div><br></div><div>And at last you get your independence with the freedom of going wherever you need whenever you will be ready.</div>','','',''),(24,'Long Time Rentals','ltr','<div>In order to provide ideal solutions for our customers “Super Car Rent” is offering long term car rental in Georgia. When using long term car rentals packages you always have a chance to make good savings. As longer you rent a car, as more benefits you will have.</div><div><br></div><div>We are striving to be a reliable and good rent a car partner for both our leisure travelers and for corporate partners. Our staff has customized different car rental packages to meet everybody’s satisfaction.</div><div><br></div><div>Just select any car from the wide range of the fleet we offer and save more with long term car rentals. In case you have some specific car rental requirements such as not everyday rentals, long term car rental with a driver service or whatever you always have the chance to negotiate it with us and get customized offer.</div><div><br></div><div>Basically long term car rental in Georgia is considered to be more than 11 months. If you are planning your long business trip you should always take into consideration the country peculiarities, cost savings, additional benefits that you will get when renting with Super Car Rent. Moreover depending on the rental duration you can choose new car models from the market. All the terms and prices are subject for discussion.</div><div><br></div><div>When using our Long Term Rental package, you will benefit from:</div><div>Negotiable price</div><div>Vehicle Regular Check – up</div><div>Possibility to put your company logo</div><div>Insurance cases management</div><div>Free replacement service</div><div>Free parking within Tbilisi</div><div>Consider what you need for before choosing the right car rental package.</div><div><br></div><div>In case you are interested in our long term car rental service you can contact our support team to reveal the most flexible, cost effective and convenient package for you.[:ru]Since long ago transportation has always been convenient for managing our day time. It helps to deal with both, personal and work related stuff. Living gets easier as less time is wasted on reaching destinations. If you are staying in Georgia and you need to solve your transportation issues Hertz Georgia offers special rates and conditions for multi months rentals:</div><div><br></div><div>– Affordable multi month rates</div><div>– Wide choice of vehicle models</div><div>– Budget planning</div><div>– Unlimited mileage</div><div>– 24/7 technical assistance</div><div>– Full maintenance services</div><div>– Full insurance package</div><div>– CDW, TP, PAI, TPI included</div><div><br></div><div>Mainly you get opportunity to manage your own time precisely based on your wish.</div>										\r\n										','','',''),(25,'Corporate Rentals','cr','<div>If you are a business traveler looking for a reliable and cost efficient car rental partner in Georgia, then you are right at the place. Super Car Rent corporate programs provide our business customers with a variety of value-oriented packages to meet their requirements.</div><div><br></div><div>Our corporate rental packages</div><div>Our car rental company in Georgia has developed corporate packages with specific prices and conditions intended not only for small and mid-sized businesses but also for big corporations. It is a good practice for business travelers to reduce costs during their stay in Tbilisi. Corporate rental service is a beneficial solution for the companies who are looking for reliable car rental supplier.</div><div><br></div><div>Corporate rental service is a beneficial solution when renting a car in Tbilisi with fixed rates to help you to plan your budget and be organized.</div><div><br></div><div>Low rates, personalized customer service are always guaranteed.</div><div><br></div><div>Let our experience turn into your advantage.</div><div><br></div><div>Whether it is a long term rental or short term rental, transfer service or chauffeur service you will always get a tailor made offer.</div><div><br></div><div>Benefit from many attractive corporate car rental offers when renting a car in Tbilisi for organizing corporate events, planning to travel for work or making transportations of clients.</div><div>When offering corporate car rentals in Georgia we are building relationship and supporting to satisfy all types of customers. We offer cheap car rental deals or discounted car rentals in different packages.</div><div><br></div><div>Apart of all the rental benefits you will also get:</div><div>Discounts are always available for corporate customers</div><div>Free upgrade for every 3rd reservation (subject of availability)</div><div>Free Parking within Tbilisi</div><div>If you have some specific requirements or need some logistic support during your stay in Georgia, we always welcome you to our office to find the best possible solution for you.</div><div><br></div><div>Do not miss the chance to drive first class vehicles with the best possible prices and get dedicated customer service available 24/7. Super Car Rent always has a special approach to corporate clients. Super Car Rent collaborates with more than one both, local and foreign companies. Regardless of how many cars and for how long you will need, we are always ready to provide you with comfortable transportation. For corporate clients we have special price offers on business class cars and on fuel-efficient vehicles. With an individual approach it is possible to offer flexible prices best suited to your company. By choosing our company you are guaranteed to get the best service at the best prices. pace.</div><div><br></div><div>We offer short-term rental, long-term lease, operating lease, driver services, transfers both local and international, rent Accessories (GPS, wi fi, baby seat.)</div><div><br></div><div>Super Car Rent Leasing and its Benefits</div><div>Super Car Rent Leasing is an economic solution to providing your company a car fleet at competitive monthly rates. Whether it is two, twenty vehicles or more, Super Car Rent operating lease offers you flexibility on when and for how long you want to rent.</div><div><br></div><div>– Improved cash flow and budget planning</div><div>– No registration as a fixed asset in company’s balance sheet</div><div>– Tax optimization</div><div>– Reduction of administration costs</div><div>– Reduction of maintenance expenses</div><div>– Reduction of time</div><div>– Regular car maintenance service</div><div>– 24-hours roadside assistance service</div><div>– Full technical support</div><div>– Fixed monthly rates</div><div>– Flexibility in selection of vehicle brands and models</div><div>– Simplified fleet renewal</div><div>– Quality and reliability</div><div><br></div><div>Generally Price Includes</div><div><br></div><div>– Collision/Damage Waiver</div><div>– Personal accident assurance</div><div>– Theft protection</div><div>– Accident management</div><div>– Maintenance and all kind of repair works within the contracted mileage</div><div>– Annual technical inspection</div><div>– Regular technical check-ups</div><div>– Twice a year season tires replacement and storage of tires at the Super Car Rent ‘ facilities</div><div>– Allowance to print logos on the cars</div><div>– VAT.</div>										\r\n										','','',''),(26,'Chauffeur Service','cs','<div>If you like to enjoy the view from the back seat of a comfortable vehicle with a Super Car Rent you can easily free yourself from the responsibility of driving in a new country taking the service of a Chauffeur Drive – a warm smiled, uniformed chauffeur, on-time arrivals, business and friendly approach, feeling of safety and comfort will surround you during all your trip.</div><div><br></div><div>For Business and Leisure Travelers</div><div>Super Car Rent with a Driver Service is defined both for our corporate customers and leisure travelers.</div><div><br></div><div>For those who are traveling on leisure we offer wide range of vehicles depending on their itinerary. You are always welcome to discuss your preferences, requirements and itinerary with our operational team. We will also be in your assistance in terms of the tour logistic support. Using our car rental with a driver service you get not only driver but also a reliable friend who guides you to your desired destinations.</div><div><br></div><div>For the business travelers renting a car with a Chauffeur Drive we offer corporate rental packages. Understanding the value of your time we will help you to manage your business agenda in a timely manner.&nbsp; During the drive in a business class car you will enjoy a high speed Wi Fi service sending and receiving your e-mails or following the news.</div><div><br></div><div>You can use Super Car Rent for the Chauffeur Service both daily and hourly. Hourly rent will cost less than a full day rental.</div><div><br></div><div>Benefits you get when renting a car with a chauffeur service:</div><div>Professional and experienced chauffeurs who are well-used to the area.</div><div>Quickness and responsibility which benefit your time-accuracy.</div><div>English and Russian Speaking Drivers will be at your disposal with any enquiry (other languages speaking drivers can also be assigned upon request).</div><div>An exceptional eye to every detail to the clients need.</div><div>Just give the direction to the driver and rest your mind when renting a car as our drivers well know how to deliver you to the specific location with hidden corners of the city.</div><div>Terms and Conditions</div><div>This service is not bookable online. To book a Chauffeur Drive Service you can contact us.&nbsp;&nbsp;</div><div>Driver’s working hours are from 10:00 to 19:00 (subject for discussion)</div><div>In case of overnights the driver’s accommodation and meal will be cared by the customer.</div><div>Of course we understand the importance of reliability and safe deliveries of car rental company, so our mission is always to give the best experience to our welcomed guest! The benefit of a rented car is that it is always ready in the event of an emergency.</div><div><br></div><div>You can book one way rental both on line or just contacting directly to our reservation department&nbsp;</div><div><br></div><div>&nbsp;</div>										\r\n										','','',''),(28,'Transfer Service','ts','<div>Cars are important because they provide a common means of transportation, whether it is a longer commute to work or a shorter trip to run errands around town. At Super Car Rent there are many different kinds of cars including luxury, family-oriented, small and large cars.</div><div><br></div><div>Do you want to get from the airport or office, fast and worry free to the meeting place? Why not to relax after tiresome day or flight and let our professional chauffeur take you to your destination.&nbsp; No more worries about traffic or parking, you are free to read your briefing papers, focus on the important matters and arrive at your destination relaxed and on-time.</div><div><br></div><div>Benefits:</div><div>– Our professional English-speaking and courteous chauffeur will meet and escort you to the car.</div><div>– The fleet is new and well equipped.</div><div>– We arrange transfers to/from any location.</div><div>– Transfers to outside Georgia.</div><div><br></div><div>Booking is quick and simple.&nbsp; Please book 24 hours in advance prior to pick-up date.&nbsp;</div><div>&nbsp;</div>','','','');

/*Table structure for table `tblsubscribers` */

DROP TABLE IF EXISTS `tblsubscribers`;

CREATE TABLE `tblsubscribers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `SubscriberEmail` varchar(120) DEFAULT NULL,
  `PostingDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `tblsubscribers` */

insert  into `tblsubscribers`(`id`,`SubscriberEmail`,`PostingDate`) values (2,'saxeligvar@gmail.com','2018-12-20 04:39:47');

/*Table structure for table `tbltestimonial` */

DROP TABLE IF EXISTS `tbltestimonial`;

CREATE TABLE `tbltestimonial` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `UserEmail` varchar(100) NOT NULL,
  `Testimonial` mediumtext NOT NULL,
  `PostingDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `tbltestimonial` */

insert  into `tbltestimonial`(`id`,`UserEmail`,`Testimonial`,`PostingDate`,`status`) values (1,'test@gmail.com','Test Test','2017-06-18 03:44:31',1),(2,'test@gmail.com','\nLorem ipsum dolor sit amet, consectetuer adipiscing elit. Nam nibh. Nunc varius facilis','2017-06-18 03:46:05',1),(3,'test@gmail.com','adfrtgyhtujikouyt\r\nwe\r\nf\r\nwef\r\nwef','2018-12-13 12:23:06',1),(4,'saxeli@gmail.com','eqw qw eqwe \r\neq\r\neqwe\r\nqw','2018-12-13 12:27:12',1);

/*Table structure for table `tblusers` */

DROP TABLE IF EXISTS `tblusers`;

CREATE TABLE `tblusers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `FullName` varchar(120) DEFAULT NULL,
  `EmailId` varchar(100) DEFAULT NULL,
  `Password` varchar(100) DEFAULT NULL,
  `ContactNo` char(11) DEFAULT NULL,
  `dob` varchar(100) DEFAULT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `City` varchar(100) DEFAULT NULL,
  `Country` varchar(100) DEFAULT NULL,
  `RegDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `tblusers` */

insert  into `tblusers`(`id`,`FullName`,`EmailId`,`Password`,`ContactNo`,`dob`,`Address`,`City`,`Country`,`RegDate`,`UpdationDate`) values (1,'John Doe','demo@gmail.com','827ccb0eea8a706c4c34a16891f84e7b','2147483647',NULL,NULL,NULL,NULL,'2017-06-17 15:59:27','2018-12-13 12:25:40'),(2,'saxeli gvari','saxeli@gmail.com','827ccb0eea8a706c4c34a16891f84e7b','8285703354',NULL,NULL,NULL,NULL,'2017-06-17 16:00:49','2018-12-13 12:26:18'),(3,'sadas','saxesli@gmail.com','ee11cbb19052e40b07aac0ca060c23ee','66846',NULL,NULL,NULL,NULL,'2018-12-20 10:27:48',NULL),(4,'d','ww@gmail.com','ad57484016654da87125db86f4227ea3','5`',NULL,NULL,NULL,NULL,'2018-12-22 03:00:00',NULL),(5,'ddd','saxsssesli@gmail.com','03c7c0ace395d80182db07ae2c30f034','32',NULL,NULL,NULL,NULL,'2018-12-22 03:02:59',NULL),(6,'qq','usertest@gmail.com','21232f297a57a5a743894a0e4a801fc3','11',NULL,NULL,NULL,NULL,'2019-01-13 01:49:54',NULL),(7,'qew','saxwwwesli@gmail.com','81dc9bdb52d04dc20036dbd8313ed055','qwe',NULL,NULL,NULL,NULL,'2019-01-13 03:19:10',NULL);

/*Table structure for table `tblvehicles` */

DROP TABLE IF EXISTS `tblvehicles`;

CREATE TABLE `tblvehicles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `VehiclesTitle` varchar(150) DEFAULT NULL,
  `VehiclesBrand` int(11) DEFAULT NULL,
  `VehiclesOverview` longtext,
  `FuelType` varchar(100) DEFAULT NULL,
  `SeatingCapacity` int(11) DEFAULT NULL,
  `Vimage1` varchar(120) DEFAULT NULL,
  `Vimage2` varchar(120) DEFAULT NULL,
  `Vimage3` varchar(120) DEFAULT NULL,
  `Vimage4` varchar(120) DEFAULT NULL,
  `Vimage5` varchar(120) DEFAULT NULL,
  `RegDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `wva` varchar(999) NOT NULL,
  `transmission` varchar(999) NOT NULL,
  `smSuit` varchar(11) NOT NULL,
  `bgSuit` varchar(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

/*Data for the table `tblvehicles` */

insert  into `tblvehicles`(`id`,`VehiclesTitle`,`VehiclesBrand`,`VehiclesOverview`,`FuelType`,`SeatingCapacity`,`Vimage1`,`Vimage2`,`Vimage3`,`Vimage4`,`Vimage5`,`RegDate`,`UpdationDate`,`wva`,`transmission`,`smSuit`,`bgSuit`) values (3,'camry',3,' ','Petrol',5,'K0000295926.jpg','K0000295926.jpg','K0000295926.jpg','K0000295926.jpg','','2019-01-21 07:43:25',NULL,'12','Auto','3','1'),(13,'logan',1,' ','Petrol',5,'Renault logan  or similar.jpg','Renault logan  or similar.jpg','Renault logan or similar.jpg','Renault logan  or similar.jpg','','2019-01-22 13:09:30',NULL,'7','manual','2','1'),(14,'corola',2,' ','petrol',5,'toyota-vios-2017-trd-sportivo-26.jpg','toyota-vios-2017-trd-sportivo-26.jpg','toyota-vios-2017-trd-sportivo-26.jpg','toyota-vios-2017-trd-sportivo-26.jpg','','2019-01-22 13:10:19',NULL,'10','Auto','2','1'),(15,'duster',4,' ','Petrol',5,'thEE6PZS2T.jpg','thEE6PZS2T.jpg','thEE6PZS2T.jpg','thEE6PZS2T.jpg','','2019-01-22 13:10:46',NULL,'11','Manual','3','2'),(16,'rav4',5,'','petrol',5,'cab60tos111b0101.webp','cab60tos111b0101.webp','cab60tos111b0101.webp','cab60tos111b0101.webp','','2019-01-22 13:12:32',NULL,'13','Auto','3','2'),(17,'prado',6,' ','petrol',7,'45 angle view Toyota Land Cruiser Prado GX 2017.jpg','45 angle view Toyota Land Cruiser Prado GX 2017.jpg','45 angle view Toyota Land Cruiser Prado GX 2017.jpg','45 angle view Toyota Land Cruiser Prado GX 2017.jpg','','2019-01-22 13:12:59',NULL,'13','Auto','4','1'),(18,'h1',7,' ','Diesel',8,'mobile_listing_main_2598.jpg','mobile_listing_main_2598.jpg','mobile_listing_main_2598.jpg','mobile_listing_main_2598.jpg','','2019-01-22 13:14:23',NULL,'13','manual','3','1'),(22,'land cruiser 200',8,' ','Petrol',7,'c_h_6.jpg','','','','','2019-02-17 14:42:44',NULL,'13','Auto','3','1');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
