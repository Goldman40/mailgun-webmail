SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `mail_in`;
CREATE TABLE `mail_in` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `recipient` varchar(255) NOT NULL,
  `sender` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `from_` varchar(255) NOT NULL,
  `when_` datetime NOT NULL,
  `content` text NOT NULL,
  `folder` int(11) NOT NULL DEFAULT '0',
  `read` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `mail_out`;
CREATE TABLE `mail_out` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `from_` varchar(255) NOT NULL,
  `recipient` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `content` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `when_` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `mail_user`;
CREATE TABLE `mail_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `session` varchar(255) NOT NULL,
  `allow_manage` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;