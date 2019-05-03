-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Creato il: Mag 02, 2019 alle 23:50
-- Versione del server: 5.7.26-0ubuntu0.16.04.1
-- Versione PHP: 7.1.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `x`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `easyex_eactivity`
--

CREATE TABLE `easyex_eactivity` (
  `id` int(11) NOT NULL,
  `exchange_id` varchar(255) DEFAULT NULL,
  `activity_id` int(11) DEFAULT NULL,
  `additional_information` varchar(255) DEFAULT NULL,
  `time` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `easyex_eactivity`
--

INSERT INTO `easyex_eactivity` (`id`, `exchange_id`, `activity_id`, `additional_information`, `time`) VALUES
(1, 'C13C675E76FFFB571009', 1, NULL, 1540917279),
(2, '696C719A1687CA376193', 1, NULL, 1540917282),
(3, 'C13C675E76FFFB571009', 2, 'ssassda', 1540917683),
(4, 'C13C675E76FFFB571009', 7, '', 1540918610),
(5, '696C719A1687CA376193', 7, '', 1540918629),
(6, 'A60DE36913C9E88950B8', 1, NULL, 1540928296),
(7, 'A60DE36913C9E88950B8', 7, '', 1540933203);

-- --------------------------------------------------------

--
-- Struttura della tabella `easyex_edata`
--

CREATE TABLE `easyex_edata` (
  `id` int(11) NOT NULL,
  `exchange_id` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `value` varchar(255) DEFAULT NULL,
  `num` varchar(255) DEFAULT NULL,
  `time` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struttura della tabella `easyex_exchanges`
--

CREATE TABLE `easyex_exchanges` (
  `id` int(11) NOT NULL,
  `uid` int(11) DEFAULT NULL,
  `gateway_send` int(11) DEFAULT NULL,
  `gateway_receive` int(11) DEFAULT NULL,
  `amount_send` varchar(255) DEFAULT NULL,
  `amount_receive` varchar(255) DEFAULT NULL,
  `rate_from` varchar(255) DEFAULT NULL,
  `rate_to` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created` int(11) NOT NULL DEFAULT '0',
  `updated` int(11) NOT NULL DEFAULT '0',
  `expired` int(11) NOT NULL DEFAULT '0',
  `u_field_1` varchar(255) DEFAULT NULL,
  `u_field_2` varchar(255) DEFAULT NULL,
  `u_field_3` varchar(255) DEFAULT NULL,
  `u_field_4` varchar(255) DEFAULT NULL,
  `u_field_5` varchar(255) DEFAULT NULL,
  `u_field_6` varchar(255) DEFAULT NULL,
  `u_field_7` varchar(255) DEFAULT NULL,
  `u_field_8` varchar(255) DEFAULT NULL,
  `u_field_9` varchar(255) DEFAULT NULL,
  `u_field_10` varchar(255) DEFAULT NULL,
  `ip` varchar(255) DEFAULT NULL,
  `transaction_id` text,
  `exchange_id` varchar(255) DEFAULT NULL,
  `processed_by` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `easyex_exchanges`
--

INSERT INTO `easyex_exchanges` (`id`, `uid`, `gateway_send`, `gateway_receive`, `amount_send`, `amount_receive`, `rate_from`, `rate_to`, `status`, `created`, `updated`, `expired`, `u_field_1`, `u_field_2`, `u_field_3`, `u_field_4`, `u_field_5`, `u_field_6`, `u_field_7`, `u_field_8`, `u_field_9`, `u_field_10`, `ip`, `transaction_id`, `exchange_id`, `processed_by`) VALUES
(1, 2, 1, 2, '6105.81', '1', '6105.81', '1', 6, 1540917279, 1540918610, 0, 'e9ef3c7a53@mailox.biz', '1Kdoi8HnFoh1Lh1doZeS6eg4HjyxXwUZWN', '', '', '', '', '', '', '', '', '188.114.102.6', 'ssassda', 'C13C675E76FFFB571009', NULL),
(2, 2, 1, 2, '6105.81', '1', '6105.81', '1', 6, 1540917282, 1540918629, 0, 'e9ef3c7a53@mailox.biz', '1Kdoi8HnFoh1Lh1doZeS6eg4HjyxXwUZWN', '', '', '', '', '', '', '', '', '188.114.102.6', NULL, '696C719A1687CA376193', NULL),
(3, 2, 2, 1, '1', '4999.37', '1', '4999.37', 6, 1540928296, 1540933203, 0, 'e9ef3c7a53@mailox.biz', 'dffsfdsfs', 'fdsfsd', 'fsdfsdf', 'fsdfdsf', '', '', '', '', '', '188.114.102.6', NULL, 'A60DE36913C9E88950B8', NULL);

-- --------------------------------------------------------

--
-- Struttura della tabella `easyex_faq`
--

CREATE TABLE `easyex_faq` (
  `id` int(11) NOT NULL,
  `question` varchar(255) DEFAULT NULL,
  `answer` text,
  `created` int(11) DEFAULT NULL,
  `updated` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `easyex_faq`
--

INSERT INTO `easyex_faq` (`id`, `question`, `answer`, `created`, `updated`) VALUES
(1, 'Cos&#039;è il bitcoin?', 'il bitcoin è bello :)', 1540933835, NULL),
(2, 'xvxdsvxc', 'vxcvxcv', 1552584167, NULL);

-- --------------------------------------------------------

--
-- Struttura della tabella `easyex_feedbacks`
--

CREATE TABLE `easyex_feedbacks` (
  `id` int(11) NOT NULL,
  `uid` int(11) DEFAULT NULL,
  `type` int(11) DEFAULT NULL,
  `exchange_id` int(11) DEFAULT NULL,
  `exchange_from` varchar(255) DEFAULT NULL,
  `exchange_to` varchar(255) DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `ip` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `time` int(11) DEFAULT NULL,
  `content` text
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struttura della tabella `easyex_gateways`
--

CREATE TABLE `easyex_gateways` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `currency` varchar(255) DEFAULT NULL,
  `reserve` varchar(255) DEFAULT NULL,
  `min_amount` varchar(255) DEFAULT NULL,
  `max_amount` varchar(255) DEFAULT NULL,
  `exchange_type` int(11) DEFAULT NULL,
  `include_fee` int(11) DEFAULT NULL,
  `extra_fee` varchar(255) DEFAULT NULL,
  `fee` varchar(255) DEFAULT NULL,
  `allow_send` int(11) DEFAULT NULL,
  `allow_receive` int(11) DEFAULT NULL,
  `default_send` int(11) DEFAULT NULL,
  `default_receive` int(11) DEFAULT NULL,
  `allow_payouts` int(11) DEFAULT NULL,
  `a_field_1` varchar(255) DEFAULT NULL,
  `a_field_2` varchar(255) DEFAULT NULL,
  `a_field_3` varchar(255) DEFAULT NULL,
  `a_field_4` varchar(255) DEFAULT NULL,
  `a_field_5` varchar(255) DEFAULT NULL,
  `a_field_6` varchar(255) DEFAULT NULL,
  `a_field_7` varchar(255) DEFAULT NULL,
  `a_field_8` varchar(255) DEFAULT NULL,
  `a_field_9` varchar(255) DEFAULT NULL,
  `a_field_10` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `external_gateway` int(11) NOT NULL DEFAULT '0',
  `external_icon` text,
  `require_login` int(11) NOT NULL DEFAULT '0',
  `require_email_verify` int(11) NOT NULL DEFAULT '0',
  `require_mobile_verify` int(11) NOT NULL DEFAULT '0',
  `require_document_verify` int(11) NOT NULL DEFAULT '0',
  `is_crypto` int(11) NOT NULL DEFAULT '0',
  `merchant_source` varchar(255) DEFAULT NULL,
  `additional_information` text
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `easyex_gateways`
--

INSERT INTO `easyex_gateways` (`id`, `name`, `currency`, `reserve`, `min_amount`, `max_amount`, `exchange_type`, `include_fee`, `extra_fee`, `fee`, `allow_send`, `allow_receive`, `default_send`, `default_receive`, `allow_payouts`, `a_field_1`, `a_field_2`, `a_field_3`, `a_field_4`, `a_field_5`, `a_field_6`, `a_field_7`, `a_field_8`, `a_field_9`, `a_field_10`, `status`, `external_gateway`, `external_icon`, `require_login`, `require_email_verify`, `require_mobile_verify`, `require_document_verify`, `is_crypto`, `merchant_source`, `additional_information`) VALUES
(1, 'Bank SEPA', 'EUR', '200000000000000', '20', '50000', 3, 1, '1', '-10', 1, 0, 0, 0, NULL, 'poste', 'carlito', 'rizzitu', 'nessuna', '', '', '', '', '', '', 1, 1, 'uploads/1540907488_icon.png', 1, 1, 1, 1, 0, NULL, 'The process will end from the moment the credit will be credited to our bank account, typically it will take between 24/48 working hours (excluding Saturday and Sunday)'),
(2, 'Bitcoin', 'BTC', '998', '0.003', '5', 4, 0, '', '-10', 1, 0, 0, 0, NULL, '3e089aab0574c00ad154e699fea8fe2d', '31031325225', '1', '', '', NULL, NULL, NULL, NULL, NULL, 1, 0, NULL, 1, 1, 1, 1, 1, 'coinpayments.net', 'Actually exchange process takes from 10 up to 30 minutes.v'),
(3, 'Ether', 'ETH', '998', '0.1', '500', 4, 0, '', '-10', 1, 0, 0, 0, NULL, '3e089aab0574c00ad154e699fea8fe2d', '31031325225', '1', '', '', NULL, NULL, NULL, NULL, NULL, 1, 0, NULL, 1, 1, 1, 1, 1, 'coinpayments.net', 'Actually exchange process takes from 10 up to 30 minutes.'),
(4, 'Litecoin', 'LTC', '1000', '0.1', '1000', 4, 0, '', '-10', 1, 0, 0, 0, NULL, '3e089aab0574c00ad154e699fea8fe2d', '31031325225', '1', '', '', NULL, NULL, NULL, NULL, NULL, 1, 0, NULL, 1, 1, 1, 1, 1, 'coinpayments.net', 'Actually exchange process takes from 10 up to 30 minutes.'),
(5, 'Bitcoin Cash', 'BCH', '1000', '0.05', '1000', 4, 0, '', '-10', 1, 0, 0, 0, NULL, '3e089aab0574c00ad154e699fea8fe2d', '31031325225', '1', '', '', NULL, NULL, NULL, NULL, NULL, 1, 0, NULL, 1, 1, 1, 1, 1, 'coinpayments.net', 'Actually exchange process takes from 10 up to 30 minutes.'),
(6, 'Dash', 'DASH', '1000', '0.1', '1000', 4, 0, '', '-10', 1, 0, 0, 0, NULL, '3e089aab0574c00ad154e699fea8fe2d', '31031325225', '1', '', '', NULL, NULL, NULL, NULL, NULL, 1, 0, NULL, 1, 1, 1, 1, 1, 'coinpayments.net', 'Actually exchange process takes from 10 up to 30 minutes.'),
(7, 'Monero', 'XMR', '10000', '0.2', '10000', 4, 0, '', '-10', 1, 0, 0, 0, NULL, '3e089aab0574c00ad154e699fea8fe2d', '31031325225', '1', '', '', NULL, NULL, NULL, NULL, NULL, 1, 0, NULL, 1, 1, 1, 1, 1, 'coinpayments.net', 'Actually exchange process takes from 10 up to 30 minutes.'),
(8, 'Dogecoin', 'DOGE', '1000000000000000000', '6666', '1000000000000000000', 4, 0, '', '-20', 1, 0, 0, 0, NULL, '3e089aab0574c00ad154e699fea8fe2d', '31031325225', '1', '', '', NULL, NULL, NULL, NULL, NULL, 1, 0, NULL, 1, 1, 1, 1, 1, 'coinpayments.net', 'Actually exchange process takes from 10 up to 30 minutes.'),
(10, 'NEM', 'XEM', '10000000000000', '285', '10000000000000', 4, 0, '', '-10', 1, 0, 0, 0, NULL, '3e089aab0574c00ad154e699fea8fe2d', '31031325225', '1', '', '', NULL, NULL, NULL, NULL, NULL, 1, 0, NULL, 1, 1, 1, 1, 1, 'coinpayments.net', 'Actually exchange process takes from 10 up to 30 minutes.'),
(11, 'NEO', 'NEO', '10000', '2', '10000', 4, 0, '', '-10', 1, 0, 0, 0, NULL, '3e089aab0574c00ad154e699fea8fe2d', '31031325225', '1', '', '', NULL, NULL, NULL, NULL, NULL, 1, 0, NULL, 1, 1, 1, 1, 1, 'coinpayments.net', 'Actually exchange process takes from 10 up to 30 minutes.'),
(12, 'VERGE', 'XVG', '100000000000', '2000', '100000000000', 4, 0, '', '-10', 1, 0, 0, 0, NULL, '3e089aab0574c00ad154e699fea8fe2d', '31031325225', '1', '', '', NULL, NULL, NULL, NULL, NULL, 1, 0, NULL, 1, 1, 1, 1, 1, 'coinpayments.net', 'Actually exchange process takes from 10 up to 30 minutes.'),
(13, 'ZCash', 'ZEC', '122', '1', '1220', 4, 0, '', '-10', 1, 0, 0, 0, NULL, '3e089aab0574c00ad154e699fea8fe2d', '31031325225', '1', '', '', NULL, NULL, NULL, NULL, NULL, 1, 0, NULL, 1, 1, 1, 1, 1, 'coinpayments.net', 'Actually exchange process takes from 10 up to 30 minutes.');

-- --------------------------------------------------------

--
-- Struttura della tabella `easyex_gateways_directions`
--

CREATE TABLE `easyex_gateways_directions` (
  `id` int(11) NOT NULL,
  `gateway_id` int(11) DEFAULT NULL,
  `directions` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `easyex_gateways_directions`
--

INSERT INTO `easyex_gateways_directions` (`id`, `gateway_id`, `directions`) VALUES
(1, 1, '2,3,4,5,6,7,8,10,11,12,13'),
(2, 2, '1,3,4,5,6,7,8,10,11,12,13'),
(3, 3, '1,2,4,5,6,7,8,10,11,12,13'),
(4, 4, '1,2,3,5,6,7,8,10,11,12,13'),
(5, 5, '1,2,3,4,6,7,8,10,11,12,13'),
(6, 6, '1,2,3,4,5,7,8,10,11,12,13'),
(7, 7, '1,2,3,4,5,6,8,10,11,12,13'),
(8, 8, '1,2,3,4,5,6,7,10,11,12,13'),
(10, 10, '1,2,3,4,5,6,7,8,11,12,13'),
(11, 11, '1,2,3,4,5,6,7,8,10,12,13'),
(12, 12, '1,2,3,4,5,6,7,8,10,11,13'),
(13, 13, '1,2,3,4,5,6,7,8,10,11,12');

-- --------------------------------------------------------

--
-- Struttura della tabella `easyex_gateways_fields`
--

CREATE TABLE `easyex_gateways_fields` (
  `id` int(11) NOT NULL,
  `gateway_id` int(11) DEFAULT NULL,
  `field_name` varchar(255) DEFAULT NULL,
  `field_number` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `easyex_gateways_fields`
--

INSERT INTO `easyex_gateways_fields` (`id`, `gateway_id`, `field_name`, `field_number`) VALUES
(1, 1, 'Bank name', 1),
(2, 1, 'nome', 2),
(3, 1, 'cognome', 3),
(4, 1, 'via', 4);

-- --------------------------------------------------------

--
-- Struttura della tabella `easyex_pages`
--

CREATE TABLE `easyex_pages` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `prefix` varchar(255) DEFAULT NULL,
  `content` text,
  `created` int(11) DEFAULT NULL,
  `updated` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `easyex_pages`
--

INSERT INTO `easyex_pages` (`id`, `title`, `prefix`, `content`, `created`, `updated`) VALUES
(1, 'Terms and Conditions', 'terms-and-conditions', '<h5><span style=\"font-family: Verdana;\"><font size=\"3\"><span style=\"font-weight: bold;\">Introduction</span></font></span></h5><div style=\"margin-left: 40px;\"><h5><span style=\"font-family: Verdana;\">These terms and conditions apply between you, the User of this Website (including any sub-domains, unless expressly excluded by their own terms and conditions), and CryptoLocalATM, the owner and operator of this Website. Please read these terms and conditions carefully, as they affect your legal rights. Your agreement to comply with and be bound by these terms and conditions is deemed to occur upon your first use of the Website. If you do not agree to be bound by these terms and conditions, you should stop using the Website immediately.</span></h5></div><div style=\"margin-left: 40px;\"><h5><span style=\"font-family: Verdana;\">In these terms and conditions, <span style=\"font-weight: bold;\">User </span>or <span style=\"font-weight: bold;\">Users </span>means any third party that accesses the Website and is not either (i) employed by CryptoLocalATM and acting in the course of their employment or (ii) engaged as a consultant or otherwise providing services to CryptoLocalATM and accessing the Website in connection with the provision of such services.</span></h5></div><div style=\"margin-left: 40px;\"><h5><span style=\"font-family: Verdana;\">You must be at least 18 years of age to use this Website. By using the Website and agreeing to these terms and conditions, you represent and warrant that you are at least 18 years of age.</span></h5></div><h5><span style=\"font-family: Verdana;\"></span></h5><h5><span style=\"font-family: Verdana;\">&nbsp;</span></h5><h5><span style=\"font-family: Verdana;\"></span></h5><h5><span style=\"font-family: Verdana;\"><font size=\"4\"><span style=\"font-weight: bold;\">Intellectual property and acceptable use</span></font></span></h5><div style=\"margin-left: 40px;\"><h5><span style=\"font-family: Verdana;\">1. All Content included on the Website, unless uploaded by Users, is the property of CryptoLocalATM, our affiliates or other relevant third parties. In these terms and conditions, Content means any text, graphics, images, audio, video, software, data compilations, page layout, underlying code and software and any other form of information capable of being stored in a computer that appears on or forms part of this Website, including any such content uploaded by Users. By continuing to use the Website you acknowledge that such Content is protected by copyright, trademarks, database rights and other intellectual property rights. Nothing on this site shall be construed as granting, by implication, estoppel, or otherwise, any license or right to use any trademark, logo or service mark displayed on the site without the owner’s prior written permission</span></h5></div><div style=\"margin-left: 40px;\"><h5><span style=\"font-family: Verdana;\"><br></span></h5></div><div style=\"margin-left: 40px;\"><h5><span style=\"font-family: Verdana;\">2. You may, for your own personal, non-commercial use only, do the following:</span></h5></div><div style=\"margin-left: 40px;\"><h5><span style=\"font-family: Verdana;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 1. retrieve, display and view the Content on a computer screen</span></h5></div><div style=\"margin-left: 40px;\"><h5><span style=\"font-family: Verdana;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 2. download and store the Content in electronic form on a disk (but not on any server or other storage device connected to a network)</span></h5></div><div style=\"margin-left: 40px;\"><h5><span style=\"font-family: Verdana;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 3. print one copy of the Content</span></h5></div><div style=\"margin-left: 40px;\"><h5><span style=\"font-family: Verdana;\"> 3. You must not otherwise reproduce, modify, copy, distribute or use for commercial purposes any Content without the written permission of CryptoLocalATM.</span></h5></div><h5><span style=\"font-family: Verdana;\"></span></h5><h5><span style=\"font-family: Verdana;\">&nbsp;</span></h5><h5><span style=\"font-family: Verdana;\"></span></h5><h5><span style=\"font-family: Verdana;\"><font size=\"3\"><span style=\"font-weight: bold;\">Prohibited use<br></span></font></span></h5><h5><span style=\"font-family: Verdana;\">You may not use the Website for any of the following purposes:</span></h5><div style=\"margin-left: 40px;\"><h5><span style=\"font-family: Verdana;\">1. in any way which causes, or may cause, damage to the Website or interferes with any other person’s use or enjoyment of the Website;</span></h5></div><div style=\"margin-left: 40px;\"><h5><span style=\"font-family: Verdana;\">2. in any way which is harmful, unlawful, illegal, abusive, harassing, threatening or otherwise objectionable or in breach of any applicable law, regulation, governmental order;</span></h5></div><div style=\"margin-left: 40px;\"><h5><span style=\"font-family: Verdana;\">3. making, transmitting or storing electronic copies of Content protected by copyright without the permission of the owner.</span></h5></div><h5><span style=\"font-family: Verdana;\"></span></h5><h5><span style=\"font-family: Verdana;\">&nbsp;</span></h5><h5><span style=\"font-family: Verdana;\"></span></h5><h5><span style=\"font-family: Verdana;\"><font size=\"3\"><span style=\"font-weight: bold;\">Registration</span></font></span></h5><h5 style=\"margin-left: 40px;\"><span style=\"font-family: Verdana;\">1. You must ensure that the details provided by you on registration or at any time are correct and complete.</span></h5><div style=\"margin-left: 40px;\"><h5><span style=\"font-family: Verdana;\">2. You must inform us immediately of any changes to the information that you provide when registering by updating your personal details to ensure we can communicate with you effectively.</span></h5></div><div style=\"margin-left: 40px;\"><h5><span style=\"font-family: Verdana;\">3. We may suspend or cancel your registration with immediate effect for any reasonable purposes or if you breach these terms and conditions.</span></h5></div><div style=\"margin-left: 40px;\"><h5><span style=\"font-family: Verdana;\">4. You may cancel your registration at any time by informing us in writing to the address at the end of these terms and conditions. If you do so, you must immediately stop using the Website. Cancellation or suspension of your registration does not affect any statutory rights.</span></h5></div><h5><span style=\"font-family: Verdana;\"></span></h5><h5><span style=\"font-family: Verdana;\">&nbsp;</span></h5><h5><span style=\"font-family: Verdana;\"></span></h5><h5><span style=\"font-family: Verdana;\"><font size=\"3\"><span style=\"font-weight: bold;\">Privacy Policy<br></span></font></span></h5><div style=\"margin-left: 40px;\"><h5><span style=\"font-family: Verdana;\">Use of the Website is also governed by our Privacy Policy, which is incorporated into these terms and conditions by this reference. To view the Privacy Policy, please click on the following: https://cryptolocalatm.com/privacy-policy/ .</span></h5></div><h5><span style=\"font-family: Verdana;\"></span></h5><h5><span style=\"font-family: Verdana;\">&nbsp;</span></h5><h5><span style=\"font-family: Verdana;\"></span></h5><h5><span style=\"font-family: Verdana;\"><font size=\"3\"><span style=\"font-weight: bold;\">Avaialability of the Website and disclaimers<br></span></font></span></h5><h5 style=\"margin-left: 40px;\"><span style=\"font-family: Verdana;\">1. Any online facilities, tools, services or information that CryptoLocalATM makes available through the Website (the Service) is provided “as is” and on an “as available” basis. We give no warranty that the Service will be free of defects and/or faults. To the maximum extent permitted by the law, we provide no warranties (express or implied) of fitness for a particular purpose, accuracy of information, compatibility and satisfactory quality. CryptoLocalATM is under no obligation to update information on the Website.</span></h5><div style=\"margin-left: 40px;\"><h5><span style=\"font-family: Verdana;\">2. Whilst CryptoLocalATM uses reasonable endeavours to ensure that the Website is secure and free of errors, viruses and other malware, we give no warranty or guaranty in that regard and all Users take responsibility for their own security, that of their personal details and their computers.</span></h5></div><div style=\"margin-left: 40px;\"><h5><span style=\"font-family: Verdana;\">3. CryptoLocalATM accepts no liability for any disruption or non-availability of the Website.</span></h5></div><div style=\"margin-left: 40px;\"><h5><span style=\"font-family: Verdana;\">4. CryptoLocalATM reserves the right to alter, suspend or discontinue any part (or the whole of) the Website including, but not limited to, any products and/or services available. These terms and conditions shall continue to apply to any modified version of the Website unless it is expressly stated otherwise.</span></h5></div><h5><span style=\"font-family: Verdana;\"></span></h5><h5><span style=\"font-family: Verdana;\">&nbsp;</span></h5><h5><span style=\"font-family: Verdana;\"></span></h5><h5><span style=\"font-family: Verdana;\"><font size=\"3\"><span style=\"font-weight: bold;\">Limitation of liability<br></span></font></span></h5><h5 style=\"margin-left: 40px;\"><span style=\"font-family: Verdana;\">1. Nothing in these terms and conditions will: (a) limit or exclude our or your liability for death or personal injury resulting from our or your negligence, as applicable; (b) limit or exclude our or your liability for fraud or fraudulent misrepresentation; or (c) limit or exclude any of our or your liabilities in any way that is not permitted under applicable law.</span></h5><div style=\"margin-left: 40px;\"><h5><span style=\"font-family: Verdana;\">2. We will not be liable to you in respect of any losses arising out of events beyond our reasonable control.</span></h5></div><div style=\"margin-left: 40px;\"><h5><span style=\"font-family: Verdana;\">3. To the maximum extent permitted by law, CryptoLocalATM accepts no liability for any of the following:</span></h5></div><div style=\"margin-left: 80px;\"><h5><span style=\"font-family: Verdana;\">1. any business losses, such as loss of profits, income, revenue, anticipated savings, business, contracts, goodwill or commercial opportunities;</span></h5></div><div style=\"margin-left: 80px;\"><h5><span style=\"font-family: Verdana;\">2. loss or corruption of any data, database or software;</span></h5></div><div style=\"margin-left: 80px;\"><h5><span style=\"font-family: Verdana;\">3. any special, indirect or consequential loss or damage.</span></h5></div><h5><span style=\"font-family: Verdana;\"></span></h5><h5><span style=\"font-family: Verdana;\">&nbsp;</span></h5><h5><span style=\"font-family: Verdana;\"><font size=\"3\"><span style=\"font-weight: bold;\">General</span></font></span></h5><div style=\"margin-left: 40px;\"><h5><span style=\"font-family: Verdana;\">1. You may not transfer any of your rights under these terms and conditions to any other person. We may transfer our rights under these terms and conditions where we reasonably believe your rights will not be affected.</span></h5></div><div style=\"margin-left: 40px;\"><h5><span style=\"font-family: Verdana;\">2. These terms and conditions may be varied by us from time to time. Such revised terms will apply to the Website from the date of publication. Users should check the terms and conditions regularly to ensure familiarity with the then current version.</span></h5></div><div style=\"margin-left: 40px;\"><h5><span style=\"font-family: Verdana;\">3. These terms and conditions together with the Privacy Policy contain the whole agreement between the parties relating to its subject matter and supersede all prior discussions, arrangements or agreements that might have taken place in relation to the terms and conditions.</span></h5></div><div style=\"margin-left: 40px;\"><h5><span style=\"font-family: Verdana;\">4. The Contracts (Rights of Third Parties) Act 1999 shall not apply to these terms and conditions and no third party will have any right to enforce or rely on any provision of these terms and conditions.</span></h5></div><div style=\"margin-left: 40px;\"><h5><span style=\"font-family: Verdana;\">5. If any court or competent authority finds that any provision of these terms and conditions (or part of any provision) is invalid, illegal or unenforceable, that provision or part-provision will, to the extent required, be deemed to be deleted, and the validity and enforceability of the other provisions of these terms and conditions will not be affected.</span></h5></div><div style=\"margin-left: 40px;\"><h5><span style=\"font-family: Verdana;\">6. Unless otherwise agreed, no delay, act or omission by a party in exercising any right or remedy will be deemed a waiver of that, or any other, right or remedy.</span></h5></div><div style=\"margin-left: 40px;\"><h5><span style=\"font-family: Verdana;\">7. These terms and conditions will be governed by and interpreted according to English law. All disputes arising under these terms and conditions will be subject to the exclusive jurisdiction of the English courts.</span></h5></div><h5><span style=\"font-family: Verdana;\"></span></h5><h5><span style=\"font-family: Verdana;\">&nbsp;</span></h5><h5><span style=\"font-family: Verdana;\"></span></h5><h5><span style=\"font-family: Verdana;\"><font size=\"3\"><span style=\"font-weight: bold;\">CryptoLocalATM Details<br></span></font></span></h5><h5 style=\"margin-left: 40px;\"><span style=\"font-family: Verdana;\">CryproLocalATM is a trademark of CRYPTO LOCAL SOLUTION LTD is a company incorporated in Sofia with registered number VAT ID BG205537102 – whose registered address is Bul. Nikola Petkov 52 and it operates the Website https://cryptolocalatm.com. You can contact CRYPTO LOCAL SOLUTION LTD by email on support@cryptolocalatm.com.</span></h5><h3><span style=\"font-family: Verdana;\"></span></h3><h3><span style=\"font-family: Verdana;\"></span></h3>', NULL, 1552576285),
(2, 'Privacy Policy', 'privacy-policy', '<h5><span style=\"font-family: Verdana;\">Effective date: March 01, 2019</span></h5><h5><span style=\"font-family: Verdana;\">CryptoLocalATM (“us”, “we”, or “our”) operates the https://cryptolocalatm.com website (the “Service”).</span></h5><h5><span style=\"font-family: Verdana;\">This page informs you of our policies regarding the collection, use, and disclosure of personal data when you use our Service and the choices you have associated with that data.</span></h5><h5><span style=\"font-family: Verdana;\">We use your data to provide and improve the Service. By using the Service, you agree to the collection and use of information in accordance with this policy. Unless otherwise defined in this Privacy Policy, terms used in this Privacy Policy have the same meanings as in our Terms and Conditions, accessible from https://cryptolocalatm.com</span></h5><h5><span style=\"font-family: Verdana;\"></span></h5><h5><span style=\"font-family: Verdana;\">&nbsp;</span></h5><h4><span style=\"font-family: Verdana;\"><span style=\"font-weight: bold;\">– Definitions –</span></span></h4><h5 style=\"margin-left: 40px;\"><span style=\"font-family: Verdana;\"><span style=\"font-weight: bold;\">Personal Data</span></span></h5><h5 style=\"margin-left: 80px;\"><span style=\"font-family: Verdana;\">Personal Data means data about a living individual who can be identified from those data (or from those and other information either in our possession or likely to come into our possession).</span></h5><h5><span style=\"font-family: Verdana;\"></span></h5><h5 style=\"margin-left: 40px;\"><span style=\"font-family: Verdana;\"><span style=\"font-weight: bold;\">Usage Data</span></span></h5><h5 style=\"margin-left: 80px;\"><span style=\"font-family: Verdana;\">Usage Data is data collected automatically either generated by the use of the Service or from the Service infrastructure itself (for example, the duration of a page visit).</span></h5><h5><span style=\"font-family: Verdana;\"></span></h5><h5 style=\"margin-left: 40px;\"><span style=\"font-family: Verdana;\"><span style=\"font-weight: bold;\">Cookies</span></span></h5><h5 style=\"margin-left: 80px;\"><span style=\"font-family: Verdana;\">Cookies are small pieces of data stored on a User’s device.</span></h5><h5><span style=\"font-family: Verdana;\"></span></h5><h5 style=\"margin-left: 40px;\"><span style=\"font-family: Verdana;\"><span style=\"font-weight: bold;\">Data Controller</span></span></h5><h5 style=\"margin-left: 80px;\"><span style=\"font-family: Verdana;\">Data Controller means a person who (either alone or jointly or in common with other persons) determines the purposes for which and the manner in which any personal data are, or are to be, processed.</span></h5><h5 style=\"margin-left: 80px;\"><span style=\"font-family: Verdana;\">For the purpose of this Privacy Policy, we are a Data Controller of your data.</span></h5><h5><span style=\"font-family: Verdana;\"></span></h5><h5 style=\"margin-left: 40px;\"><span style=\"font-family: Verdana;\"><span style=\"font-weight: bold;\">Data Processor (or Service Providers)</span></span></h5><h5 style=\"margin-left: 80px;\"><span style=\"font-family: Verdana;\">Data Processor (or Service Provider) means any person (other than an employee of the Data Controller) who processes the data on behalf of the Data Controller.</span></h5><h5 style=\"margin-left: 80px;\"><span style=\"font-family: Verdana;\">We may use the services of various Service Providers in order to process your data more effectively.</span></h5><h5><span style=\"font-family: Verdana;\"></span></h5><h5 style=\"margin-left: 40px;\"><span style=\"font-family: Verdana;\"><span style=\"font-weight: bold;\">Data Subject</span></span></h5><h5 style=\"margin-left: 80px;\"><span style=\"font-family: Verdana;\">Data Subject is any living individual who is the subject of Personal Data.</span></h5><h5><span style=\"font-family: Verdana;\"></span></h5><h5 style=\"margin-left: 40px;\"><span style=\"font-family: Verdana;\"><span style=\"font-weight: bold;\">User</span></span></h5><h5 style=\"margin-left: 80px;\"><span style=\"font-family: Verdana;\">The User is the individual using our Service. The User corresponds to the Data Subject, who is the subject of Personal Data.</span></h5><h5><span style=\"font-family: Verdana;\"></span></h5><h5 style=\"margin-left: 40px;\"><span style=\"font-family: Verdana;\"><span style=\"font-weight: bold;\">Information Collection And Use</span></span></h5><h5 style=\"margin-left: 80px;\"><span style=\"font-family: Verdana;\">We collect several different types of information for various purposes to provide and improve our Service to you.</span></h5><h5><span style=\"font-family: Verdana;\"></span></h5><div><h5><span style=\"font-family: Verdana;\"><br></span></h5></div><div><h5><span style=\"font-family: Verdana;\"><br></span></h5></div><h4><span style=\"font-family: Verdana;\"><span style=\"font-weight: bold;\">– Types of Data Collected –</span></span></h4><h5 style=\"margin-left: 40px;\"><span style=\"font-family: Verdana;\"><span style=\"font-weight: bold;\">Personal Data</span></span></h5><h5 style=\"margin-left: 80px;\"><span style=\"font-family: Verdana;\">While using our Service, we may ask you to provide us with certain personally identifiable information that can be used to contact or identify you (“Personal Data”). Personally identifiable information may include, but is not limited to:</span></h5><h5><span style=\"font-family: Verdana;\"></span></h5><h5 style=\"margin-left: 120px;\"><span style=\"font-family: Verdana;\">- Email address</span></h5><h5 style=\"margin-left: 120px;\"><span style=\"font-family: Verdana;\">- First name and last name</span></h5><h5 style=\"margin-left: 120px;\"><span style=\"font-family: Verdana;\">- Phone number</span></h5><h5 style=\"margin-left: 120px;\"><span style=\"font-family: Verdana;\">&nbsp;- Address, State, Province, ZIP/Postal code, City</span></h5><h5 style=\"margin-left: 120px;\"><span style=\"font-family: Verdana;\">- Cookies and Usage Data</span></h5><h5><span style=\"font-family: Verdana;\"></span></h5><h5 style=\"margin-left: 80px;\"><span style=\"font-family: Verdana;\">We may use your Personal Data to contact you with newsletters, marketing or promotional materials and other information that may be of interest to you. You may opt out of receiving any, or all, of these communications from us by contacting us.</span></h5><h5><span style=\"font-family: Verdana;\"></span></h5><h5 style=\"margin-left: 40px;\"><span style=\"font-family: Verdana;\"><span style=\"font-weight: bold;\">Usage Data</span></span></h5><h5 style=\"margin-left: 80px;\"><span style=\"font-family: Verdana;\">We may also collect information how the Service is accessed and used (“Usage Data”). This Usage Data may include information such as your computer’s Internet Protocol address (e.g. IP address), browser type, browser version, the pages of our Service that you visit, the time and date of your visit, the time spent on those pages, unique device identifiers and other diagnostic data.</span></h5><h5><span style=\"font-family: Verdana;\"></span></h5><h5 style=\"margin-left: 40px;\"><span style=\"font-family: Verdana;\"><span style=\"font-weight: bold;\">Location Data</span></span></h5><h5 style=\"margin-left: 80px;\"><span style=\"font-family: Verdana;\">We may use and store information about your location if you give us permission to do so (“Location Data”). We use this data to provide features of our Service, to improve and customize our Service.</span></h5><h5 style=\"margin-left: 80px;\"><span style=\"font-family: Verdana;\">You can enable or disable location services when you use our Service at any time, through your device settings.</span></h5><h5><span style=\"font-family: Verdana;\"></span></h5><h5 style=\"margin-left: 40px;\"><span style=\"font-family: Verdana;\"><span style=\"font-weight: bold;\">Tracking Cookies Data</span></span></h5><h5 style=\"margin-left: 80px;\"><span style=\"font-family: Verdana;\">We use cookies and similar tracking technologies to track the activity on our Service and hold certain information.</span></h5><h5 style=\"margin-left: 80px;\"><span style=\"font-family: Verdana;\">Cookies are files with small amount of data which may include an anonymous unique identifier. Cookies are sent to your browser from a website and stored on your device. Tracking technologies also used are beacons, tags, and scripts to collect and track information and to improve and analyze our Service.</span></h5><h5 style=\"margin-left: 80px;\"><span style=\"font-family: Verdana;\">You can instruct your browser to refuse all cookies or to indicate when a cookie is being sent. However, if you do not accept cookies, you may not be able to use some portions of our Service.</span></h5><h5 style=\"margin-left: 80px;\"><span style=\"font-family: Verdana;\">Examples of Cookies we use:</span></h5><h5><span style=\"font-family: Verdana;\"></span></h5><h5 style=\"margin-left: 120px;\"><span style=\"font-family: Verdana;\">- Session Cookies. We use Session Cookies to operate our Service.</span></h5><h5 style=\"margin-left: 120px;\"><span style=\"font-family: Verdana;\">- Preference Cookies. We use Preference Cookies to remember your preferences and various settings.</span></h5><h5 style=\"margin-left: 120px;\"><span style=\"font-family: Verdana;\">- Security Cookies. We use Security Cookies for security purposes.</span></h5><h5><span style=\"font-family: Verdana;\">&nbsp;</span></h5><h5 style=\"margin-left: 40px;\"><span style=\"font-family: Verdana;\"><span style=\"font-weight: bold;\">Use of Data</span></span></h5><h5 style=\"margin-left: 80px;\"><span style=\"font-family: Verdana;\">CryptoLocalATM uses the collected data for various purposes:</span></h5><h5 style=\"margin-left: 80px;\"><span style=\"font-family: Verdana;\"></span></h5><h5 style=\"margin-left: 120px;\"><span style=\"font-family: Verdana;\">- To provide and maintain our Service</span></h5><h5 style=\"margin-left: 120px;\"><span style=\"font-family: Verdana;\">- To notify you about changes to our Service</span></h5><h5 style=\"margin-left: 120px;\"><span style=\"font-family: Verdana;\">- To allow you to participate in interactive features of our Service when you choose to do so</span></h5><h5 style=\"margin-left: 120px;\"><span style=\"font-family: Verdana;\">- To provide customer support</span></h5><h5 style=\"margin-left: 120px;\"><span style=\"font-family: Verdana;\">- To gather analysis or valuable information so that we can improve our Service</span></h5><h5 style=\"margin-left: 120px;\"><span style=\"font-family: Verdana;\">- To monitor the usage of our Service</span></h5><h5 style=\"margin-left: 120px;\"><span style=\"font-family: Verdana;\">- To detect, prevent and address technical issues</span></h5><h5 style=\"margin-left: 120px;\"><span style=\"font-family: Verdana;\">- To provide you with news, special offers and general information about other goods, services and events which we offer that are similar to those that you have already purchased or enquired about unless you have opted not to receive such information</span></h5><h5><span style=\"font-family: Verdana;\"></span></h5><h5 style=\"margin-left: 40px;\"><span style=\"font-family: Verdana;\"><span style=\"font-weight: bold;\">Retention of Data</span></span></h5><h5 style=\"margin-left: 80px;\"><span style=\"font-family: Verdana;\">CryptoLocalATM will retain your Personal Data only for as long as is necessary for the purposes set out in this Privacy Policy. We will retain and use your Personal Data to the extent necessary to comply with our legal obligations (for example, if we are required to retain your data to comply with applicable laws), resolve disputes, and enforce our legal agreements and policies.</span></h5><h5 style=\"margin-left: 80px;\"><span style=\"font-family: Verdana;\">CryptoLocalATM will also retain Usage Data for internal analysis purposes. Usage Data is generally retained for a shorter period of time, except when this data is used to strengthen the security or to improve the functionality of our Service, or we are legally obligated to retain this data for longer time periods.</span></h5><h5><span style=\"font-family: Verdana;\"></span></h5><h5 style=\"margin-left: 40px;\"><span style=\"font-family: Verdana;\"><span style=\"font-weight: bold;\">Transfer Of Data</span></span></h5><h5 style=\"margin-left: 80px;\"><span style=\"font-family: Verdana;\">Your information, including Personal Data, may be transferred to — and maintained on — computers located outside of your state, province, country or other governmental jurisdiction where the data protection laws may differ than those from your jurisdiction.</span></h5><h5 style=\"margin-left: 80px;\"><span style=\"font-family: Verdana;\">If you are located outside United Kingdom and choose to provide information to us, please note that we transfer the data, including Personal Data, to United Kingdom and process it there.</span></h5><h5 style=\"margin-left: 80px;\"><span style=\"font-family: Verdana;\">Your consent to this Privacy Policy followed by your submission of such information represents your agreement to that transfer.</span></h5><h5 style=\"margin-left: 80px;\"><span style=\"font-family: Verdana;\">CryptoLocalATM will take all steps reasonably necessary to ensure that your data is treated securely and in accordance with this Privacy Policy and no transfer of your Personal Data will take place to an organization or a country unless there are adequate controls in place including the security of your data and other personal information.</span></h5><h5><span style=\"font-family: Verdana;\"></span></h5><div><h5><span style=\"font-family: Verdana;\"><br></span></h5></div><div><h5><span style=\"font-family: Verdana;\"><br></span></h5></div><h4><span style=\"font-family: Verdana;\"><span style=\"font-weight: bold;\">– Disclosure Of Data –</span></span></h4><h5 style=\"margin-left: 40px;\"><span style=\"font-family: Verdana;\"><span style=\"font-weight: bold;\">Disclosure for Law Enforcement</span></span></h5><h5 style=\"margin-left: 80px;\"><span style=\"font-family: Verdana;\">Under certain circumstances, CryptoLocalATM may be required to disclose your Personal Data if required to do so by law or in response to valid requests by public authorities (e.g. a court or a government agency).</span></h5><h5><span style=\"font-family: Verdana;\"></span></h5><h5 style=\"margin-left: 40px;\"><span style=\"font-family: Verdana;\"><span style=\"font-weight: bold;\">Legal Requirements</span></span></h5><h5 style=\"margin-left: 80px;\"><span style=\"font-family: Verdana;\">CryptoLocalATM may disclose your Personal Data in the good faith belief that such action is necessary to:</span></h5><h5 style=\"margin-left: 120px;\"><span style=\"font-family: Verdana;\">- To comply with a legal obligation</span></h5><h5 style=\"margin-left: 120px;\"><span style=\"font-family: Verdana;\">- To protect and defend the rights or property of CryptoLocalATM</span></h5><h5 style=\"margin-left: 120px;\"><span style=\"font-family: Verdana;\">- To prevent or investigate possible wrongdoing in connection with the Service</span></h5><h5 style=\"margin-left: 120px;\"><span style=\"font-family: Verdana;\">- To protect the personal safety of users of the Service or the public</span></h5><h5 style=\"margin-left: 120px;\"><span style=\"font-family: Verdana;\">- To protect against legal liability</span></h5><h5><span style=\"font-family: Verdana;\"></span></h5><h5 style=\"margin-left: 40px;\"><span style=\"font-family: Verdana;\"><span style=\"font-weight: bold;\">Security Of Data</span></span></h5><h5 style=\"margin-left: 80px;\"><span style=\"font-family: Verdana;\">The security of your data is important to us, but remember that no method of transmission over the Internet, or method of electronic storage is 100% secure. While we strive to use commercially acceptable means to protect your Personal Data, we cannot guarantee its absolute security.</span></h5><h5><span style=\"font-family: Verdana;\"></span></h5><h5 style=\"margin-left: 40px;\"><span style=\"font-family: Verdana;\"><span style=\"font-weight: bold;\">Your Rights</span></span></h5><h5 style=\"margin-left: 80px;\"><span style=\"font-family: Verdana;\">CryptoLocalATM aims to take reasonable steps to allow you to correct, amend, delete, or limit the use of your Personal Data.</span></h5><h5 style=\"margin-left: 80px;\"><span style=\"font-family: Verdana;\">Whenever made possible, you can update your Personal Data directly within your account settings section. If you are unable to change your Personal Data, please contact us to make the required changes.</span></h5><h5 style=\"margin-left: 80px;\"><span style=\"font-family: Verdana;\">If you wish to be informed what Personal Data we hold about you and if you want it to be removed from our systems, please contact us.</span></h5><h5 style=\"margin-left: 80px;\"><span style=\"font-family: Verdana;\">In certain circumstances, you have the right:</span></h5><div style=\"margin-left: 120px;\"><h5><span style=\"font-family: Verdana;\"><span style=\"font-weight: bold;\">- </span>To access and receive a copy of the Personal Data we hold about you</span></h5></div><h5 style=\"margin-left: 120px;\"><span style=\"font-family: Verdana;\">- To rectify any Personal Data held about you that is inaccurate</span></h5><h5 style=\"margin-left: 120px;\"><span style=\"font-family: Verdana;\">- To request the deletion of Personal Data held about you</span></h5><h5><span style=\"font-family: Verdana;\"></span></h5><h5 style=\"margin-left: 80px;\"><span style=\"font-family: Verdana;\">You have the right to data portability for the information you provide to CryptoLocalATM. You can request to obtain a copy of your Personal Data in a commonly used electronic format so that you can manage and move it.</span></h5><h5 style=\"margin-left: 80px;\"><span style=\"font-family: Verdana;\">Please note that we may ask you to verify your identity before responding to such requests.</span></h5><h5><span style=\"font-family: Verdana;\"></span></h5><h5 style=\"margin-left: 40px;\"><span style=\"font-family: Verdana;\"><span style=\"font-weight: bold;\">Service Providers</span></span></h5><h5 style=\"margin-left: 80px;\"><span style=\"font-family: Verdana;\">We may employ third party companies and individuals to facilitate our Service (“Service Providers”), to provide the Service on our behalf, to perform Service-related services or to assist us in analyzing how our Service is used.</span></h5><h5 style=\"margin-left: 80px;\"><span style=\"font-family: Verdana;\">These third parties have access to your Personal Data only to perform these tasks on our behalf and are obligated not to disclose or use it for any other purpose.</span></h5><h5><span style=\"font-family: Verdana;\"></span></h5><h5 style=\"margin-left: 40px;\"><span style=\"font-family: Verdana;\"><span style=\"font-weight: bold;\">Analytics</span></span></h5><h5 style=\"margin-left: 80px;\"><span style=\"font-family: Verdana;\">We may use third-party Service Providers to monitor and analyze the use of our Service.</span></h5><h5><span style=\"font-family: Verdana;\">&nbsp;</span></h5><h5 style=\"margin-left: 40px;\"><span style=\"font-family: Verdana;\"><span style=\"font-weight: bold;\">Google Analytics</span></span></h5><h5 style=\"margin-left: 80px;\"><span style=\"font-family: Verdana;\">Google Analytics is a web analytics service offered by Google that tracks and reports website traffic. Google uses the data collected to track and monitor the use of our Service. This data is shared with other Google services. Google may use the collected data to contextualize and personalize the ads of its own advertising network.</span></h5><h5 style=\"margin-left: 80px;\"><span style=\"font-family: Verdana;\">You can opt-out of having made your activity on the Service available to Google Analytics by installing the Google Analytics opt-out browser add-on. The add-on prevents the Google Analytics JavaScript (ga.js, analytics.js, and dc.js) from sharing information with Google Analytics about visits activity.</span></h5><h5 style=\"margin-left: 80px;\"><span style=\"font-family: Verdana;\">For more information on the privacy practices of Google, please visit the Google Privacy Terms web page: http://www.google.com/intl/en/policies/privacy/</span></h5><h5><span style=\"font-family: Verdana;\"></span></h5><h5 style=\"margin-left: 40px;\"><span style=\"font-family: Verdana;\"><span style=\"font-weight: bold;\">Links To Other Sites</span></span></h5><h5 style=\"margin-left: 80px;\"><span style=\"font-family: Verdana;\">Our Service may contain links to other sites that are not operated by us. If you click on a third party link, you will be directed to that third party’s site. We strongly advise you to review the Privacy Policy of every site you visit.</span></h5><h5 style=\"margin-left: 80px;\"><span style=\"font-family: Verdana;\">We have no control over and assume no responsibility for the content, privacy policies or practices of any third party sites or services.</span></h5><h5><span style=\"font-family: Verdana;\">&nbsp;</span></h5><h5 style=\"margin-left: 40px;\"><span style=\"font-family: Verdana;\"><span style=\"font-weight: bold;\">Children’s Privacy</span></span></h5><h5 style=\"margin-left: 80px;\"><span style=\"font-family: Verdana;\">Our Service does not address anyone under the age of 18 (“Children”).</span></h5><h5 style=\"margin-left: 80px;\"><span style=\"font-family: Verdana;\">We do not knowingly collect personally identifiable information from anyone under the age of 18. If you are a parent or guardian and you are aware that your Children has provided us with Personal Data, please contact us. If we become aware that we have collected Personal Data from children without verification of parental consent, we take steps to remove that information from our servers.</span></h5><h5><span style=\"font-family: Verdana;\"></span></h5><h5 style=\"margin-left: 40px;\"><span style=\"font-family: Verdana;\"><span style=\"font-weight: bold;\">Changes To This Privacy Policy</span></span></h5><h5 style=\"margin-left: 80px;\"><span style=\"font-family: Verdana;\">We may update our Privacy Policy from time to time. We will notify you of any changes by posting the new Privacy Policy on this page.</span></h5><h5 style=\"margin-left: 80px;\"><span style=\"font-family: Verdana;\">We will let you know via email and/or a prominent notice on our Service, prior to the change becoming effective and update the “effective date” at the top of this Privacy Policy.</span></h5><h5 style=\"margin-left: 80px;\"><span style=\"font-family: Verdana;\">You are advised to review this Privacy Policy periodically for any changes. Changes to this Privacy Policy are effective when they are posted on this page.</span></h5><h5><span style=\"font-family: Verdana;\"></span></h5><h5 style=\"margin-left: 40px;\"><span style=\"font-family: Verdana;\"><span style=\"font-weight: bold;\">Questions or Comments?</span></span></h5><h5 style=\"margin-left: 80px;\"><span style=\"font-family: Verdana;\">If you have questions or comments about our Privacy Policy, send an email to (support@cryptolocalatm.com)</span></h5><h5><span style=\"font-family: Verdana;\"></span></h5>', NULL, 1552583890),
(3, 'About', 'about', 'Edit from WebAdmin.', NULL, 1540920343),
(6, 'AML Policy', 'aml-policy', '<h4><span style=\"font-family: Verdana;\"><span style=\"font-weight: bold;\">CryproLocalATM AML/CTF Statement</span></span></h4><h5 style=\"margin-left: 40px;\"><span style=\"font-family: Verdana;\">Our AML program is designed to prevent the Bitcoin ATM from being used to facilitate money laundering and the financing of terrorist activities.</span></h5><h5 style=\"margin-left: 40px;\"><span style=\"font-family: Verdana;\">Our AML program incorporates policies, procedures, and internal controls designed to prevent and detect money laundering.</span></h5><h5 style=\"margin-left: 40px;\"><span style=\"font-family: Verdana;\">CryptoLocalATM has a designated a compliance officer. Who is responsible for and tasked with day-to-day compliance.</span></h5><h5 style=\"margin-left: 40px;\"><span style=\"font-family: Verdana;\">Our AML program is available for ongoing, targeted compliance training.</span></h5><h5 style=\"margin-left: 40px;\"><span style=\"font-family: Verdana;\">Our AML program is subjected to an independent audit at least annually.</span></h5><h5 style=\"margin-left: 40px;\"><span style=\"font-family: Verdana;\">CryptoLocalATM will Report and store certain customer and transaction records, as required.</span></h5><h5 style=\"margin-left: 40px;\"><span style=\"font-family: Verdana;\">CryptoLocalATM will use the CDD process to collect pertinent information of the customer’s profile and evaluated for any potential money laundering or terrorist financing red flags.</span></h5><h5 style=\"margin-left: 40px;\"><span style=\"font-family: Verdana;\">CryptoLocalATM will independently verify the information collected. These are legal documents that are issued by the government or an independent reputable agency.</span></h5><h5 style=\"margin-left: 40px;\"><span style=\"font-family: Verdana;\">Our compliance officer will then perform a check on a name-screening database or an internal blacklist to determine if a customer poses a risk to the financial institution.</span></h5><h5 style=\"margin-left: 40px;\"><span style=\"font-family: Verdana;\">CryptoLocalATM will evaluate the customer on its risk it presents and proposes to the company on the decision of establishing business relationship with the customer. Decisions may involve understanding the circumstances of the clients.</span></h5><h5><span style=\"font-family: Verdana;\"><br>&nbsp;</span></h5><h4><span style=\"font-family: Verdana;\"><span style=\"font-weight: bold;\">Enhanced Customer Due Diligence (ECDD)</span></span></h4><h5 style=\"margin-left: 40px;\"><span style=\"font-family: Verdana;\">If client has be evaluated to be at a heightened risk to the company. CryptoLocalATM will begin the process of conducting ECDD obtain senior management approval before establishing a relationship, and take reasonable measures to establish the source of wealth and the source of funds. Examples of higher risk customers/transactions include but not limited to:</span></h5><h5 style=\"margin-left: 80px;\"><span style=\"font-family: Verdana;\">- Politically Exposed Person (PEP)</span></h5><h5 style=\"margin-left: 80px;\"><span style=\"font-family: Verdana;\">- Customer who are positively identified to have adverse profiles on watchlists</span></h5><h5 style=\"margin-left: 80px;\"><span style=\"font-family: Verdana;\">- Terrorists</span></h5><h5 style=\"margin-left: 80px;\"><span style=\"font-family: Verdana;\">- Non-face to face account opening</span></h5><h5 style=\"margin-left: 80px;\"><span style=\"font-family: Verdana;\">- Correspondent Accounts</span></h5><h5 style=\"margin-left: 80px;\"><span style=\"font-family: Verdana;\">- Customers located in high-risk location</span></h5><h5><br><span style=\"font-family: Verdana;\"></span></h5><div><br></div><h4><span style=\"font-family: Verdana;\"><span style=\"font-weight: bold;\">Record Keeping</span></span></h4><h5 style=\"margin-left: 40px;\"><span style=\"font-family: Verdana;\">Record keeping helps CryptoLocalATM understands the company over the entire relationship with the customer. Record keeping helps the company deal with its reporting obligation in submitting documents to the local financial intelligence unit for suspicions on money laundering or terrorist financing.</span></h5><h5 style=\"margin-left: 40px;\"><span style=\"font-family: Verdana;\">Any activity determined suspicious by CryptoLocalATM , will resort in the customer being blocked and will no longer be permitted to engage in any transactions via CryptoLocalATM Bitcoin ATM’S. Therefore, an SAR will be filed and reported to the relevant authoritative department.</span></h5>', 1552559796, 1552583086),
(7, 'FEE', 'fee', 'feee', 1552571848, NULL),
(8, 'Cookies Policy', 'cookies-policy', '<h4><span style=\"font-family: Verdana;\"><span style=\"font-weight: bold;\">Introduction</span></span></h4><div style=\"margin-left: 40px;\"><h5><span style=\"font-family: Verdana;\">This Cookie Policy relates to the use of our website. It effectively informs you what cookies are and how our website uses cookies to enhance your user experience.</span></h5></div><h5><span style=\"font-family: Verdana;\"><br>&nbsp;</span></h5><h4><span style=\"font-family: Verdana;\"><span style=\"font-weight: bold;\">Use of Cookies</span></span></h4><div style=\"margin-left: 40px;\"><h5><span style=\"font-family: Verdana;\">Cookies are small files installed on your computer’s hard drive that assist our website in identifying your computer as you view different pages on our websites.</span></h5></div><h5 style=\"margin-left: 40px;\"><span style=\"font-family: Verdana;\">These cookies will enable the website to store your preferences for the purpose of presenting content, options and functions that are specific to you. Cookies also enable us to see information on how many people use the website and which pages they frequent.</span></h5><h5><span style=\"font-family: Verdana;\"><br>&nbsp;</span></h5><h4><span style=\"font-family: Verdana;\"><span style=\"font-weight: bold;\">We may use cookies to;</span></span></h4><div style=\"margin-left: 40px;\"><h5><span style=\"font-family: Verdana;\">a) Analyse our website traffic using analytic package. This will help us to improve our website structure, design, content and functions’</span></h5><h5><span style=\"font-family: Verdana;\">b) Identify whether you are signed in to our website.</span></h5><h5><span style=\"font-family: Verdana;\">c) Test content on our website;</span></h5><h5><span style=\"font-family: Verdana;\">d) To store information about your preferences;</span></h5><h5><span style=\"font-family: Verdana;\">e) To recognise when you return to our website</span></h5><h5><span style=\"font-family: Verdana;\">Cookies will not provide us access to your computer or any of your information other than that which you choose to share with us.</span></h5></div><h5><span style=\"font-family: Verdana;\"><br>&nbsp;</span></h5><h4><span style=\"font-family: Verdana;\"><span style=\"font-weight: bold;\">Use of Widgets</span></span></h4><div style=\"margin-left: 40px;\"><h5><span style=\"font-family: Verdana;\">To enhance your user experience on our website, we may employ the use of small widgets instead of pop-ups. You may see a small box in the top right-hand corner asking if you want to accept cookies. If you do not see it, you may have already consented from a previous visit. If you click on the Yes button, the widget will disappear and you will not see it again.</span></h5></div><h5><span style=\"font-family: Verdana;\"><br>&nbsp;</span></h5><h4><span style=\"font-family: Verdana;\"><span style=\"font-weight: bold;\">Controlling Cookies</span></span></h4><div style=\"margin-left: 40px;\"><h5><span style=\"font-family: Verdana;\">You can use your browser’s cookie settings to determine how our website uses cookies and if you do not want our website to store cookies on your computer, you should set your web browser to refuse cookies. Doing this, however, may affect how our website functions and some content and pages may become unavailable to you.</span></h5></div><div style=\"margin-left: 40px;\"><h5><span style=\"font-family: Verdana;\">By continuing to use this website without adjusting your browser’s cookie settings, you agree that we can place these cookies on your device.</span></h5></div><h5><span style=\"font-family: Verdana;\"><br>&nbsp;</span></h5><h4><span style=\"font-family: Verdana;\"><span style=\"font-weight: bold;\">Security of Information and data</span></span></h4><div style=\"margin-left: 40px;\"><h5><span style=\"font-family: Verdana;\">We will always hold your information and data securely to prevent unauthorised disclosure and access. For that purpose, we have implemented strong physical and electronic security safeguards in Accordance to the Data Protection Act 1998.</span></h5></div><h5><span style=\"font-family: Verdana;\"><br>&nbsp;</span></h5><h4><span style=\"font-family: Verdana;\"><span style=\"font-weight: bold;\">Links from Our Site</span></span></h4><div style=\"margin-left: 40px;\"><h5><span style=\"font-family: Verdana;\">Our website may contain links to other websites. Please note that we have no control over websites outside our domain. If you provide information to a website to which we link, we are not responsible for its protection and privacy. You will be responsible for reading the site’s data protection and privacy policies in full.</span></h5></div><div style=\"margin-left: 40px;\"><h5><span style=\"font-family: Verdana;\">Also, note that other cookies may be placed by third party service providers. Cookies are used on this website for the following third party services; Google Analytics, Facebook like button and twitter follow button[ Some of these services may be used to track your behaviour on other websites and we have no control over this. It is your responsibility to review third party cookie policy before using any of the third party provider features.</span></h5></div><h5><span style=\"font-family: Verdana;\"><br>&nbsp;</span></h5><h4><span style=\"font-family: Verdana;\"><span style=\"font-weight: bold;\">Application of this Cookie Policy</span></span></h4><div style=\"margin-left: 40px;\"><h5><span style=\"font-family: Verdana;\">This Cookie Policy applies to all websites we host and does not apply to any other third party websites we may link to.</span></h5></div>', 1552574128, 1552576698);

-- --------------------------------------------------------

--
-- Struttura della tabella `easyex_posts`
--

CREATE TABLE `easyex_posts` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `short_content` text,
  `content` text,
  `author` varchar(255) DEFAULT NULL,
  `created` int(11) DEFAULT NULL,
  `updated` int(11) DEFAULT NULL,
  `views` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `easyex_posts`
--

INSERT INTO `easyex_posts` (`id`, `title`, `short_content`, `content`, `author`, `created`, `updated`, `views`) VALUES
(2, 'NUOVO', 'SHORT', 'CONTENT', 'AUTOR', 1541096016, NULL, 118);

-- --------------------------------------------------------

--
-- Struttura della tabella `easyex_rates`
--

CREATE TABLE `easyex_rates` (
  `id` int(11) NOT NULL,
  `gateway_from` int(11) DEFAULT NULL,
  `gateway_to` int(11) DEFAULT NULL,
  `rate_from` varchar(255) DEFAULT NULL,
  `rate_to` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struttura della tabella `easyex_settings`
--

CREATE TABLE `easyex_settings` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `keywords` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `infoemail` varchar(255) DEFAULT NULL,
  `supportemail` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `referral_comission` varchar(255) DEFAULT NULL,
  `wallet_comission` varchar(255) DEFAULT NULL,
  `login_to_exchange` int(11) DEFAULT NULL,
  `document_verification` int(11) DEFAULT NULL,
  `email_verification` int(11) DEFAULT NULL,
  `phone_verification` int(11) DEFAULT NULL,
  `recaptcha_verification` int(11) DEFAULT NULL,
  `discount_system` int(11) DEFAULT NULL,
  `nexmo_api_key` varchar(255) DEFAULT NULL,
  `nexmo_api_secret` varchar(255) DEFAULT NULL,
  `worktime_from` varchar(255) DEFAULT NULL,
  `worktime_to` varchar(255) DEFAULT NULL,
  `worktime_gmt` varchar(255) DEFAULT NULL,
  `default_language` varchar(255) DEFAULT NULL,
  `default_template` varchar(255) DEFAULT NULL,
  `logo` text,
  `logo_style` text,
  `operator_status` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `easyex_settings`
--

INSERT INTO `easyex_settings` (`id`, `title`, `description`, `keywords`, `name`, `infoemail`, `supportemail`, `url`, `referral_comission`, `wallet_comission`, `login_to_exchange`, `document_verification`, `email_verification`, `phone_verification`, `recaptcha_verification`, `discount_system`, `nexmo_api_key`, `nexmo_api_secret`, `worktime_from`, `worktime_to`, `worktime_gmt`, `default_language`, `default_template`, `logo`, `logo_style`, `operator_status`) VALUES
(1, 'CryptoLocalX', 'Official exchange owner CryptoLocalATM', 'bitcoin\r\nethereum\r\nlitecoin\r\ndash\r\nmonero\r\ndash\r\nitalia\r\nbuy bitcoin italy\r\nbancomat bitcoin\r\natm bitcoin italia\r\ncomprare online bitcoin', 'CryptoLocalX', 'support@cryptolocalatm.com', 'support@cryptolocalatm.com', 'https://x.cryptolocalatm.com/', NULL, NULL, NULL, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'English', 'EasyExchanger', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struttura della tabella `easyex_sms_codes`
--

CREATE TABLE `easyex_sms_codes` (
  `id` int(11) NOT NULL,
  `uid` int(11) DEFAULT NULL,
  `sms_code` varchar(255) DEFAULT NULL,
  `verified` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struttura della tabella `easyex_transactions`
--

CREATE TABLE `easyex_transactions` (
  `id` int(11) NOT NULL,
  `uid` int(11) DEFAULT NULL,
  `exchange_id` varchar(255) DEFAULT NULL,
  `transaction_id` text,
  `status` int(11) DEFAULT NULL,
  `gateway` varchar(255) DEFAULT NULL,
  `amount` varchar(255) DEFAULT NULL,
  `currency` varchar(255) DEFAULT NULL,
  `time` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struttura della tabella `easyex_users`
--

CREATE TABLE `easyex_users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `password_recovery` text,
  `email_verified` int(11) DEFAULT NULL,
  `email_hash` text,
  `email` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `ip` varchar(255) DEFAULT NULL,
  `last_login` int(11) DEFAULT NULL,
  `signup_time` int(11) DEFAULT NULL,
  `document_verified` int(11) DEFAULT NULL,
  `document_1` text,
  `document_2` text,
  `mobile_verified` int(11) DEFAULT NULL,
  `mobile_number` text
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `easyex_users`
--

INSERT INTO `easyex_users` (`id`, `firstname`, `lastname`, `username`, `password`, `password_recovery`, `email_verified`, `email_hash`, `email`, `status`, `ip`, `last_login`, `signup_time`, `document_verified`, `document_1`, `document_2`, `mobile_verified`, `mobile_number`) VALUES
(1, NULL, NULL, 'DGY39ju', 'fe84f1c8b926e6167ee5498416f8b4b8', NULL, NULL, NULL, 'support@cryptolocalatm.com', 666, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 'test', 'test', 'test', '25f9e794323b453885f5181f1b624d0b', NULL, 0, 'c3b3a7c2a4b0f8db562a17ced7a58df2', 'e9ef3c7a53@mailox.biz', 3, '82.102.21.68', NULL, 1540915044, 0, '', '', 0, '');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `easyex_eactivity`
--
ALTER TABLE `easyex_eactivity`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `easyex_edata`
--
ALTER TABLE `easyex_edata`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `easyex_exchanges`
--
ALTER TABLE `easyex_exchanges`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `easyex_faq`
--
ALTER TABLE `easyex_faq`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `easyex_feedbacks`
--
ALTER TABLE `easyex_feedbacks`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `easyex_gateways`
--
ALTER TABLE `easyex_gateways`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `easyex_gateways_directions`
--
ALTER TABLE `easyex_gateways_directions`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `easyex_gateways_fields`
--
ALTER TABLE `easyex_gateways_fields`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `easyex_pages`
--
ALTER TABLE `easyex_pages`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `easyex_posts`
--
ALTER TABLE `easyex_posts`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `easyex_rates`
--
ALTER TABLE `easyex_rates`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `easyex_settings`
--
ALTER TABLE `easyex_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `easyex_sms_codes`
--
ALTER TABLE `easyex_sms_codes`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `easyex_transactions`
--
ALTER TABLE `easyex_transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `easyex_users`
--
ALTER TABLE `easyex_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `easyex_eactivity`
--
ALTER TABLE `easyex_eactivity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT per la tabella `easyex_edata`
--
ALTER TABLE `easyex_edata`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `easyex_exchanges`
--
ALTER TABLE `easyex_exchanges`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT per la tabella `easyex_faq`
--
ALTER TABLE `easyex_faq`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT per la tabella `easyex_feedbacks`
--
ALTER TABLE `easyex_feedbacks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `easyex_gateways`
--
ALTER TABLE `easyex_gateways`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT per la tabella `easyex_gateways_directions`
--
ALTER TABLE `easyex_gateways_directions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT per la tabella `easyex_gateways_fields`
--
ALTER TABLE `easyex_gateways_fields`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT per la tabella `easyex_pages`
--
ALTER TABLE `easyex_pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT per la tabella `easyex_posts`
--
ALTER TABLE `easyex_posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT per la tabella `easyex_rates`
--
ALTER TABLE `easyex_rates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT per la tabella `easyex_settings`
--
ALTER TABLE `easyex_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT per la tabella `easyex_sms_codes`
--
ALTER TABLE `easyex_sms_codes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `easyex_transactions`
--
ALTER TABLE `easyex_transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `easyex_users`
--
ALTER TABLE `easyex_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
