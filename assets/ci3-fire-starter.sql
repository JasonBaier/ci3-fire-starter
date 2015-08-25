-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 25, 2015 at 05:22 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ci3-fire-starter`
--

-- --------------------------------------------------------

--
-- Table structure for table `captcha`
--

DROP TABLE IF EXISTS `captcha`;
CREATE TABLE IF NOT EXISTS `captcha` (
  `captcha_id` bigint(13) unsigned NOT NULL AUTO_INCREMENT,
  `captcha_time` int(10) unsigned NOT NULL,
  `ip_address` varchar(16) NOT NULL DEFAULT '0',
  `word` varchar(20) NOT NULL,
  PRIMARY KEY (`captcha_id`),
  KEY `word` (`word`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `emails`
--

DROP TABLE IF EXISTS `emails`;
CREATE TABLE IF NOT EXISTS `emails` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  `email` varchar(256) NOT NULL,
  `title` varchar(128) NOT NULL,
  `message` text NOT NULL,
  `created` datetime NOT NULL,
  `read` datetime DEFAULT NULL,
  `read_by` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`),
  KEY `title` (`title`),
  KEY `created` (`created`),
  KEY `read` (`read`),
  KEY `read_by` (`read_by`),
  KEY `email` (`email`(78))
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `emails`
--

INSERT INTO `emails` (`id`, `name`, `email`, `title`, `message`, `created`, `read`, `read_by`) VALUES
(1, 'John Doe', 'john@doe.com', 'Test Message', 'This is only a test message. Notice that once you''ve read it, the button changes from blue to grey, indicating that it has been reviewed.', '2013-01-01 00:00:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `input_type` enum('input','textarea','radio','dropdown','timezones') CHARACTER SET latin1 NOT NULL,
  `options` text COMMENT 'Use for radio and dropdown: key|value on each line',
  `is_numeric` enum('0','1') NOT NULL DEFAULT '0' COMMENT 'forces numeric keypad on mobile devices',
  `show_editor` enum('0','1') NOT NULL DEFAULT '0',
  `input_size` enum('large','medium','small') DEFAULT NULL,
  `help_text` varchar(256) DEFAULT NULL,
  `validation` varchar(128) NOT NULL,
  `sort_order` tinyint(3) unsigned NOT NULL,
  `label` varchar(128) NOT NULL,
  `value` text,
  `last_update` datetime DEFAULT NULL,
  `updated_by` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  KEY `updated_by` (`updated_by`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `name`, `input_type`, `options`, `is_numeric`, `show_editor`, `input_size`, `help_text`, `validation`, `sort_order`, `label`, `value`, `last_update`, `updated_by`) VALUES
(1, 'site_name', 'input', NULL, '0', '0', 'large', NULL, 'required|trim|min_length[3]|max_length[128]', 10, 'Site Name', 'CI3 Fire Starter', '2015-08-25 08:19:33', 1),
(2, 'per_page_limit', 'dropdown', '10|10\r\n25|25\r\n50|50\r\n75|75\r\n100|100', '1', '0', 'small', NULL, 'required|trim|numeric', 50, 'Items Per Page', '10', '2015-08-25 08:19:33', 1),
(3, 'meta_keywords', 'input', NULL, '0', '0', 'large', 'Comma-seperated list of site keywords', 'trim', 20, 'Meta Keywords', 'these, are, keywords', '2015-08-25 08:19:33', 1),
(4, 'meta_description', 'textarea', NULL, '0', '0', 'large', 'Short description describing your site.', 'trim', 30, 'Meta Description', 'This is the site description.', '2015-08-25 08:19:33', 1),
(5, 'site_email', 'input', NULL, '0', '0', 'medium', 'Email address all emails will be sent from.', 'required|trim|valid_email', 40, 'Site Email', 'youremail@yourdomain.com', '2015-08-25 08:19:33', 1),
(6, 'timezones', 'timezones', NULL, '0', '0', 'medium', NULL, 'required|trim', 60, 'Timezone', 'UTC', '2015-08-25 08:19:33', 1),
(7, 'welcome_message', 'textarea', NULL, '0', '1', 'large', 'Message to display on home page.', 'trim', 70, 'Welcome Message', '<p><img src="data:image/png;base64,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" data-filename="ci3-fire-starter.png" style="line-height: 1.42857143; width: 74.4px; height: 96px; float: left;"><br></p><p>This content is being generated <em style="color: rgb(41, 82, 24); background-color: rgb(255, 239, 198);">dynamically</em>. <strong>This text is<span> editable</span> in the admin settings.</strong></p><p></p>', '2015-08-25 08:19:33', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `password` char(128) NOT NULL,
  `salt` char(128) NOT NULL,
  `first_name` varchar(32) NOT NULL,
  `last_name` varchar(32) NOT NULL,
  `email` varchar(256) NOT NULL,
  `is_admin` enum('0','1') NOT NULL DEFAULT '0',
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `deleted` enum('0','1') NOT NULL DEFAULT '0',
  `validation_code` varchar(50) DEFAULT NULL COMMENT 'Temporary code for opt-in registration',
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `salt`, `first_name`, `last_name`, `email`, `is_admin`, `status`, `deleted`, `validation_code`, `created`, `updated`) VALUES
(1, 'admin', 'ce516f215aa468c376736c9013e8b663f7b3c06226a87739bc6b32882f9278349a721ea725a156eecf9e3c1868904a77e4d42c783e0287a0909a8bbb97e1525f', '66cb0ab1d9efe250b46e28ecb45eb33b3609f1efda37547409a113a2b84c3f94b6a0e738acc391e2dfa718676aa55adead05fcb12d2e32aee379e190511a3252', 'Site', 'Administrator', 'admin@admin.com', '1', '1', '0', NULL, '2013-01-01 00:00:00', '2013-01-01 00:00:00'),
(2, 'johndoe', '4e8ece39c9905fe6989022a7747d2c67d90582cdf483d762905f026b3f2328dbc019acf59f77a57472228933c33429de859210a3c6b2976234501462994cf73c', 'a876126be616f492fa9ff8fb554eadffb8e43ed9faef8e1070c2508d76c57b1613899ceb97972f7959c4c05617ce36e25ba63787a8bd3f183680863c687a7c12', 'John', 'Doe', 'john@doe.com', '0', '1', '0', NULL, '2013-01-01 00:00:00', '2013-01-01 00:00:00');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
