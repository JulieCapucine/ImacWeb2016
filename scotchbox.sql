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

INSERT INTO `COMMENTS` (`id`, `content`, `date`, `author`, `id_answer`, `id_post`) VALUES
(1,	'Les barbies c\'est trop genial! On peut les demembrer !!!!!! :D',	'2016-05-24 08:07:59',	'le_nainfant',	NULL,	2),
(2,	'Moi, je prefere les decapitations!',	'2016-05-24 08:08:08',	'Grrrrr_leVieux',	1,	2),
(3,	'J\'ai jamais aime barbie elle pue !!! lol',	'2016-05-24 08:08:14',	'tonPere',	NULL,	2),
(4,	'Je savais paaaas :O\r\n#IKnowNothing',	'2016-05-23 13:33:02',	'JonSnow',	NULL,	1);

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

INSERT INTO `POSTS` (`id`, `title`, `content`, `image`, `date`, `id_subject`, `author`) VALUES
(1,	'Episode 5, Season 5',	'Jon Snow dies.',	'http://www.thewrap.com/wp-content/uploads/2016/04/hbo-game-of-thrones-jon-snow.jpeg',	'2016-05-23 13:22:48',	1,	'VanessaTaMere'),
(2,	'Barbie Girl Power',	'bla blaaaaaaaaaaaaa blaaa unicorn',	'https://s3-eu-west-1.amazonaws.com/spiked-online.com/images/barbie.jpg',	'0000-00-00 00:00:00',	2,	'theBestSinger');

DROP TABLE IF EXISTS `SUBJECT`;
CREATE TABLE `SUBJECT` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `title` (`title`)
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

INSERT INTO `TAG` (`id`, `name`) VALUES
(1,	'Chanson'),
(3,	'LOL'),
(2,	'Spoilers');

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

INSERT INTO `TAGGE` (`id_post`, `id_tag`) VALUES
(1,	1),
(1,	2);

-- 2016-05-24 08:25:43
