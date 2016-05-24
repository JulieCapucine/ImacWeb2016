-- Adminer 4.2.4 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `COMMENTS`;
CREATE TABLE `COMMENTS` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `content` text COLLATE utf8_bin NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `author` varchar(255) COLLATE utf8_bin NOT NULL,
  `id_answer` int(10) unsigned DEFAULT NULL,
  `id_post` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_post` (`id_post`),
  KEY `id_answer` (`id_answer`),
  CONSTRAINT `COMMENTS_ibfk_1` FOREIGN KEY (`id_post`) REFERENCES `POSTS` (`id`),
  CONSTRAINT `COMMENTS_ibfk_2` FOREIGN KEY (`id_answer`) REFERENCES `COMMENTS` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;


DROP TABLE IF EXISTS `POSTS`;
CREATE TABLE `POSTS` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_bin NOT NULL,
  `content` text COLLATE utf8_bin NOT NULL,
  `image` varchar(255) COLLATE utf8_bin NOT NULL,
  `date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `id_subject` int(10) unsigned NOT NULL,
  `author` varchar(255) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_subject` (`id_subject`),
  CONSTRAINT `POSTS_ibfk_1` FOREIGN KEY (`id_subject`) REFERENCES `SUBJECT` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;


DROP TABLE IF EXISTS `SUBJECT`;
CREATE TABLE `SUBJECT` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `SUBJECT` (`id`, `title`) VALUES
(1,	'GoT Spoliers'),
(2,	'Moi je donne des idees');

DROP TABLE IF EXISTS `TAG`;
CREATE TABLE `TAG` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `TAGGE`;
CREATE TABLE `TAGGE` (
  `id_post` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_tag` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id_post`,`id_tag`),
  KEY `id_tag` (`id_tag`),
  KEY `id_post` (`id_post`),
  CONSTRAINT `TAGGE_ibfk_1` FOREIGN KEY (`id_post`) REFERENCES `POSTS` (`id`),
  CONSTRAINT `TAGGE_ibfk_2` FOREIGN KEY (`id_tag`) REFERENCES `TAG` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;


-- 2016-05-24 08:14:00
