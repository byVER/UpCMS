SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
-----------------------------------
SET time_zone = "+00:00";
-----------------------------------
/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

-----------------------------------
CREATE TABLE IF NOT EXISTS `antispam` (
  `id` int(11) NOT NULL,
  `news` varchar(244) NOT NULL,
  `besedka` varchar(244) NOT NULL,
  `forum_theme` varchar(255) NOT NULL,
  `forum_msg` varchar(255) NOT NULL,
  `message` varchar(244) NOT NULL,
  `room_chat` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
-----------------------------------
CREATE TABLE IF NOT EXISTS `ban_list` (
  `id` int(250) NOT NULL AUTO_INCREMENT,
  `id_user` int(250) NOT NULL,
  `id_adm` int(250) NOT NULL,
  `time` int(250) NOT NULL,
  `text` varchar(9999) NOT NULL DEFAULT 'Причина не заполнена',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
-----------------------------------
CREATE TABLE IF NOT EXISTS `besedka` (
  `id` int(250) NOT NULL AUTO_INCREMENT,
  `id_user` int(250) NOT NULL,
  `text` varchar(9999) NOT NULL,
  `time` int(250) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
-----------------------------------
CREATE TABLE IF NOT EXISTS `forum_msg` (
  `id` int(250) NOT NULL AUTO_INCREMENT,
  `id_user` int(250) NOT NULL,
  `time` int(250) NOT NULL,
  `id_theme` int(250) NOT NULL,
  `text` varchar(10000) NOT NULL,
  `file` varchar(999) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
-----------------------------------
CREATE TABLE IF NOT EXISTS `forum_podrazdel` (
  `id` int(250) NOT NULL AUTO_INCREMENT,
  `id_razdel` int(250) NOT NULL,
  `name` varchar(1000) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
-----------------------------------
CREATE TABLE IF NOT EXISTS `forum_razdel` (
  `id` int(250) NOT NULL AUTO_INCREMENT,
  `name` varchar(1000) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
-----------------------------------
CREATE TABLE IF NOT EXISTS `forum_theme` (
  `id` int(250) NOT NULL AUTO_INCREMENT,
  `id_podraz` int(250) NOT NULL,
  `up` int(250) NOT NULL,
  `name` varchar(1000) NOT NULL,
  `id_user` int(250) NOT NULL,
  `text` varchar(9000) NOT NULL,
  `time` int(250) NOT NULL,
  `status` enum('open','closed') NOT NULL DEFAULT 'open',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
-----------------------------------
CREATE TABLE IF NOT EXISTS `journal` (
  `id` int(250) NOT NULL AUTO_INCREMENT,
  `text` varchar(9500) NOT NULL,
  `time` int(250) NOT NULL,
  `read` enum('0','1') NOT NULL DEFAULT '0',
  `id_user` int(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
-----------------------------------
CREATE TABLE IF NOT EXISTS `komm_news` (
  `id` int(250) NOT NULL AUTO_INCREMENT,
  `id_news` int(250) NOT NULL,
  `id_author` int(250) NOT NULL,
  `text` varchar(9999) NOT NULL,
  `time` int(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
-----------------------------------
CREATE TABLE IF NOT EXISTS `log_auth` (
  `id` int(250) NOT NULL AUTO_INCREMENT,
  `id_user` int(250) NOT NULL,
  `time` int(250) NOT NULL,
  `ip` varchar(250) NOT NULL,
  `type` enum('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
-----------------------------------
CREATE TABLE IF NOT EXISTS `message` (
  `id` int(250) NOT NULL AUTO_INCREMENT,
  `kto` varchar(244) NOT NULL,
  `komy` varchar(244) NOT NULL,
  `text` varchar(9999) NOT NULL,
  `time` varchar(244) NOT NULL,
  `readlen` varchar(1) NOT NULL,
  `file` varchar(999) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
-----------------------------------
CREATE TABLE IF NOT EXISTS `message_c` (
  `id` int(250) NOT NULL AUTO_INCREMENT,
  `kto` varchar(244) NOT NULL,
  `kogo` varchar(244) NOT NULL,
  `time` varchar(244) NOT NULL,
  `ignor` varchar(1) NOT NULL,
  `posl_time` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
-----------------------------------
CREATE TABLE IF NOT EXISTS `msg_chat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(250) NOT NULL,
  `id_room` int(250) NOT NULL,
  `text` varchar(2500) NOT NULL,
  `time` int(250) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
-----------------------------------
CREATE TABLE IF NOT EXISTS `news` (
  `id` int(250) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `text` varchar(9999) NOT NULL,
  `author` int(250) NOT NULL,
  `time_new` int(250) NOT NULL,
  `time` int(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
-----------------------------------
CREATE TABLE IF NOT EXISTS `obmen_file` (
  `id` int(250) NOT NULL AUTO_INCREMENT,
  `id_raz` int(250) NOT NULL,
  `id_user` int(250) NOT NULL,
  `down` varchar(9999) NOT NULL,
  `downs` int(250) NOT NULL DEFAULT '0',
  `name` varchar(1000) NOT NULL,
  `text` varchar(9999) NOT NULL,
  `time` int(250) NOT NULL,
  `format` varchar(250) NOT NULL DEFAULT '.png',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
-----------------------------------
CREATE TABLE IF NOT EXISTS `obmen_komm` (
  `id` int(250) NOT NULL AUTO_INCREMENT,
  `id_user` int(250) NOT NULL,
  `id_obmen` int(250) NOT NULL,
  `text` varchar(9999) NOT NULL,
  `time` int(250) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
-----------------------------------
CREATE TABLE IF NOT EXISTS `obmen_raz` (
  `id` int(250) NOT NULL AUTO_INCREMENT,
  `name` varchar(1000) NOT NULL,
  `info` varchar(9999) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
-----------------------------------
CREATE TABLE IF NOT EXISTS `room_chat` (
  `id` int(250) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `info` varchar(400) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
-----------------------------------
CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(250) NOT NULL AUTO_INCREMENT,
  `reg_on` enum('0','1') NOT NULL DEFAULT '1',
  `aut_ban_time` int(250) NOT NULL DEFAULT '60',
  `index_forum` int(2) NOT NULL DEFAULT '5',
  `money_chat` int(250) NOT NULL DEFAULT '1',
  `money_besedka` int(250) NOT NULL DEFAULT '1',
  `money_f_them` int(250) NOT NULL DEFAULT '3',
  `money_f_msg` int(250) NOT NULL DEFAULT '1',
  `edit_nick` int(250) NOT NULL DEFAULT '100',
  `rules` varchar(10000) NOT NULL DEFAULT 'Правила пока не заполнялись :(',
  `time` int(250) NOT NULL,
  `edit_color` int(250) NOT NULL DEFAULT '100',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
-----------------------------------
CREATE TABLE IF NOT EXISTS `smiles` (
  `id` int(24) NOT NULL AUTO_INCREMENT,
  `name` varchar(99) NOT NULL,
  `img` varchar(99) NOT NULL,
	PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
-----------------------------------
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(250) NOT NULL AUTO_INCREMENT,
  `login` varchar(50) NOT NULL,
  `pass` varchar(80) NOT NULL,
  `pol` enum('1','2') NOT NULL DEFAULT '1',
  `data_reg` int(250) NOT NULL DEFAULT '1',
  `admin_level` enum('0','1','2','3','4') NOT NULL DEFAULT '0',
  `up_time` int(250) NOT NULL DEFAULT '0',
  `money` int(250) NOT NULL DEFAULT '0',
  `ip` varchar(50) NOT NULL,
  `avatar` varchar(1000) NOT NULL DEFAULT '/user/avatar/no_avatar.png',
  `status` varchar(250) NOT NULL DEFAULT 'Нет статуса',
  `colornick` varchar(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-----------------------------------
INSERT INTO `antispam` (`id`, `news`, `besedka`, `forum_theme`, `forum_msg`, `message`, `room_chat`) VALUES ('1', '60', '60', '180', '60', '20', '60');
-----------------------------------
INSERT INTO `settings` (`id`, `reg_on`, `aut_ban_time`, `index_forum`, `money_chat`, `money_besedka`, `money_f_them`, `money_f_msg`, `edit_nick`, `rules`, `edit_color`) VALUES (NULL, '1', '60', '5', '1', '1', '3', '1', '100', 'Правила пока не заполнялись :(', '100');