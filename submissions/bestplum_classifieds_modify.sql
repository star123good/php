CREATE DATABASE /*!32312 IF NOT EXISTS*/`bestplum_submissions` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `bestplum_submissions`;

CREATE TABLE `oc_t_campaign_customer` (
  `pk_i_id` int(10) UNSIGNED NOT NULL,
  `s_username` varchar(40) NOT NULL,
  `s_password` char(60) NOT NULL,
  `s_email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `oc_t_campaign_customer`
  ADD PRIMARY KEY (`pk_i_id`);
  
ALTER TABLE `oc_t_campaign_customer`
  MODIFY `pk_i_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
  
CREATE TABLE `oc_t_campaign_profile` (
  `pk_i_id` int(10) UNSIGNED NOT NULL,
  `fk_i_user_id` int(10) NOT NULL,
  `fk_i_cutomer_id` int(10) NOT NULL,
  `s_campaign_email` varchar(100) NOT NULL,
  `s_campaign_password` varchar(40) NOT NULL,
  `s_title` varchar(255) NOT NULL,
  `s_description` text NOT NULL,
  `s_website` varchar(100) NOT NULL,
  `s_keywords` varchar(255) NOT NULL,
  `s_facebook_page` varchar(100) NOT NULL,
  `s_affiliage_link` varchar(100) NOT NULL,
  `s_youtube_url` varchar(100) NOT NULL,
  `s_address` varchar(255) NOT NULL,
  `s_phone` varchar(100) NOT NULL,
  `s_city_area` varchar(255) NOT NULL,
  `s_category` varchar(255) NOT NULL,
  `s_image_1` varchar(255) NOT NULL,
  `s_image_2` varchar(255) NOT NULL,
  `s_image_3` varchar(255) NOT NULL,
  `s_number_ads` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `oc_t_campaign_profile`
  ADD PRIMARY KEY (`pk_i_id`);
  
ALTER TABLE `oc_t_campaign_profile`
  MODIFY `pk_i_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
  
CREATE TABLE `oc_t_campaign_url_list` (
  `pk_i_id` int(10) UNSIGNED NOT NULL,
  `s_login_url` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `oc_t_campaign_url_list`
  ADD PRIMARY KEY (`pk_i_id`);
  
ALTER TABLE `oc_t_campaign_url_list`
  MODIFY `pk_i_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;