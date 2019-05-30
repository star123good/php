CREATE TABLE /*TABLE_PREFIX*/t_reminder (
  `s_slug` varchar(100) NOT NULL DEFAULT '',
  `i_days` int(6) NOT NULL,
  `b_enabled` tinyint(1) NOT NULL DEFAULT '0',
  `s_body_content` text NOT NULL,
  `s_subject` varchar(255) NOT NULL DEFAULT '',
  `dt_last_check` datetime DEFAULT NULL,
  `dt_created` datetime DEFAULT NULL,
  PRIMARY KEY (`s_slug`,`i_days`),
  KEY `b_enabled` (`b_enabled`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;