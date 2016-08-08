-- phpMyAdmin SQL Dump
-- version 4.0.10.6
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3307
-- Время создания: Июл 19 2015 г., 13:35
-- Версия сервера: 5.5.41-log
-- Версия PHP: 5.3.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `library`
--
CREATE DATABASE IF NOT EXISTS `library` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `library`;

-- --------------------------------------------------------

--
-- Структура таблицы `T_authors`
--

DROP TABLE IF EXISTS `T_authors`;
CREATE TABLE IF NOT EXISTS `T_authors` (
  `aID` int(32) NOT NULL AUTO_INCREMENT,
  `aFIO` varchar(255) NOT NULL,
  PRIMARY KEY (`aID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Дамп данных таблицы `T_authors`
--

INSERT INTO `T_authors` (`aID`, `aFIO`) VALUES
(2, 'Пушкин'),
(9, 'Чехов А. П.'),
(10, 'Дуров'),
(11, 'Гоголь'),
(12, 'Сорокин Ю. С.');

-- --------------------------------------------------------

--
-- Структура таблицы `T_books`
--

DROP TABLE IF EXISTS `T_books`;
CREATE TABLE IF NOT EXISTS `T_books` (
  `bID` int(32) NOT NULL AUTO_INCREMENT,
  `aID` int(32) DEFAULT NULL,
  `catID` int(32) DEFAULT NULL,
  `bName` varchar(1000) NOT NULL,
  `year` int(10) DEFAULT NULL,
  `file` varchar(255) DEFAULT NULL,
  `source` varchar(1000) DEFAULT NULL,
  `cover` varchar(255) NOT NULL DEFAULT 'covers/default.jpg',
  PRIMARY KEY (`bID`),
  KEY `t_books_ibfk_1` (`aID`),
  KEY `t_books_ibfk_2` (`catID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=51 ;

--
-- Дамп данных таблицы `T_books`
--

INSERT INTO `T_books` (`bID`, `aID`, `catID`, `bName`, `year`, `file`, `source`, `cover`) VALUES
(21, 9, 12, 'Толстый и тонкий', 1891, '', '', 'covers/default.jpg'),
(23, 9, 12, 'Вишневый сад', 1903, '', 'http://www.ilibrary.ru/text/472/index.html', 'covers/default.jpg'),
(26, 10, NULL, 'ВКа', 2000, '', 'https://vk.com/rock__alex__hunter', 'covers/default.jpg'),
(40, 2, 5, 'Тюльпаны желтые', 1733, 'files/3ccfa6e8acd46080072e9bba9a4a97de.docx', '', 'covers/0d0dd45e1110bd0b8b290e8f7361dc2a.jpg'),
(42, 11, 12, 'Мертвые души', 1851, 'files/61214008f57524dce6b9d39d2c9c636c.docx', '', 'covers/1a771e3b7d26dabc57b4113c69ba1268.jpg'),
(43, 12, 12, 'Полет феникса', 2012, 'files/eb07408567b8d3fd0cd95e453786363c.docx', 'http://www.samlib.ru/s/sorokin_j_s/phenix.shtml', 'covers/c2a4dd7fb0d2f45a6da23926ffaaf37a.jpg'),
(46, 9, 12, 'Человек в футляре', 1898, NULL, 'http://www.ilibrary.ru/text/438/index.html', 'covers/default.jpg'),
(47, 9, 12, 'Хамелеон', 2015, NULL, 'http://www.ilibrary.ru/text/463/index.html', 'covers/default.jpg'),
(48, 9, 12, 'На охоте', 1884, NULL, 'http://www.ilibrary.ru/text/1349/index.html', 'covers/default.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `T_categories`
--

DROP TABLE IF EXISTS `T_categories`;
CREATE TABLE IF NOT EXISTS `T_categories` (
  `catID` int(32) NOT NULL AUTO_INCREMENT,
  `catName` varchar(255) NOT NULL,
  PRIMARY KEY (`catID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Дамп данных таблицы `T_categories`
--

INSERT INTO `T_categories` (`catID`, `catName`) VALUES
(4, 'Сказка'),
(5, 'Стихи'),
(6, 'Поэма'),
(9, 'Роман'),
(12, 'Рассказ');

-- --------------------------------------------------------

--
-- Структура таблицы `T_comments`
--

DROP TABLE IF EXISTS `T_comments`;
CREATE TABLE IF NOT EXISTS `T_comments` (
  `cID` int(32) NOT NULL AUTO_INCREMENT,
  `bID` int(32) NOT NULL,
  `uID` int(32) NOT NULL,
  `cText` mediumtext NOT NULL,
  PRIMARY KEY (`cID`),
  KEY `t_comments_ibfk_1` (`bID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Дамп данных таблицы `T_comments`
--

INSERT INTO `T_comments` (`cID`, `bID`, `uID`, `cText`) VALUES
(1, 23, 7, 'ыыы'),
(2, 23, 7, 'ыыы'),
(3, 23, 7, 'ыыы'),
(4, 26, 7, 'ыыы'),
(5, 26, 7, 'сыфсыс ыав ававыаыва ыва ыававыавыа  выавыавыаывавыа ыва вы аыв а ыва ыв а вы а а выа ыв а ыва вы а ыва вы авы а ыва вы авы авы а выа ыыыыыыыыыыыыыыыыыы ыа вы авы а ываааааы а выа ыв аыввввввввв ыа ыва ыв авы а ыва'),
(6, 26, 7, 'сыфсыс ыав ававыаыва ыва ыававыавыа  выавыавыаывавыа ыва вы аыв а ыва ыв а вы а а выа ыв а ыва вы а ыва вы авы а ыва вы авы авы а выа ыыыыыыыыыыыыыыыыыы ыа вы авы а ываааааы а выа ыв аыввввввввв ыа ыва ыв авы а ыва'),
(7, 26, 7, 'сыфсыс ыав ававыаыва ыва ыававыавыа  выавыавыаывавыа ыва вы аыв а ыва ыв а вы а а выа ыв а ыва вы а ыва вы авы а ыва вы авы авы а выа ыыыыыыыыыыыыыыыыыы ыа вы авы а ываааааы а выа ыв аыввввввввв ыа ыва ыв авы а ыва'),
(8, 43, 7, 'Норм, че..'),
(9, 42, 7, 'Так себе'),
(12, 47, 8, 'qwer\r\n');

-- --------------------------------------------------------

--
-- Структура таблицы `T_marks`
--

DROP TABLE IF EXISTS `T_marks`;
CREATE TABLE IF NOT EXISTS `T_marks` (
  `bID` int(32) NOT NULL,
  `cCount` int(32) NOT NULL,
  `mark` float NOT NULL,
  PRIMARY KEY (`bID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `T_marks`
--

INSERT INTO `T_marks` (`bID`, `cCount`, `mark`) VALUES
(23, 1, 4),
(26, 1, 4),
(40, 2, 3),
(42, 2, 3.5),
(43, 3, 4.66667),
(46, 1, 4),
(47, 2, 3.5),
(48, 3, 5);

-- --------------------------------------------------------

--
-- Структура таблицы `T_rated`
--

DROP TABLE IF EXISTS `T_rated`;
CREATE TABLE IF NOT EXISTS `T_rated` (
  `rID` int(32) NOT NULL AUTO_INCREMENT,
  `uID` int(32) NOT NULL,
  `bID` int(32) NOT NULL,
  `mark` int(1) NOT NULL,
  PRIMARY KEY (`rID`),
  UNIQUE KEY `uID` (`uID`,`bID`),
  UNIQUE KEY `uID_2` (`uID`,`bID`),
  KEY `t_rated_con` (`bID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- Дамп данных таблицы `T_rated`
--

INSERT INTO `T_rated` (`rID`, `uID`, `bID`, `mark`) VALUES
(4, 2, 43, 5),
(5, 1, 43, 5),
(6, 2, 42, 4),
(7, 2, 40, 1),
(8, 2, 23, 4),
(9, 7, 26, 4),
(10, 7, 43, 4),
(11, 7, 42, 3),
(12, 7, 40, 5),
(13, 7, 48, 5),
(14, 7, 47, 3),
(15, 7, 46, 4),
(16, 2, 48, 5),
(17, 8, 48, 5),
(18, 8, 47, 4);

-- --------------------------------------------------------

--
-- Структура таблицы `T_users`
--

DROP TABLE IF EXISTS `T_users`;
CREATE TABLE IF NOT EXISTS `T_users` (
  `uID` int(32) NOT NULL AUTO_INCREMENT,
  `uRole` int(2) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`uID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Дамп данных таблицы `T_users`
--

INSERT INTO `T_users` (`uID`, `uRole`, `username`, `password`) VALUES
(2, 2, 'ad@min', 'KKbPJPnPfkg5Pemngu+4aFSxpOIP+C+BAgHz5EzmuZYTGWcl2QrRv7BY3u9ljSUGlkRVNV93K0cloTR0yxfHUA=='),
(7, 1, 'ss@ss', 'xcibYHBgzmonkq2Vpv/9p44RmJlZ3yF2fUVPfTT8DthwPiQ0cKPunSLu+4opFF+5NoluoO7P/P75WQdleAsnkA=='),
(8, 1, 'new@user', '69WTkQxB/ZOUyF3pne7ZOCn5qVgT5NE3Lmdq8BkevJE/0Aq+lMMngBj4CQ2rDA3oqSk83txDhyjpGC3j95ng5g==');

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `T_books`
--
ALTER TABLE `T_books`
  ADD CONSTRAINT `t_books_ibfk_1` FOREIGN KEY (`aID`) REFERENCES `T_authors` (`aID`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `t_books_ibfk_2` FOREIGN KEY (`catID`) REFERENCES `T_categories` (`catID`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Ограничения внешнего ключа таблицы `T_comments`
--
ALTER TABLE `T_comments`
  ADD CONSTRAINT `t_comments_ibfk_1` FOREIGN KEY (`bID`) REFERENCES `T_books` (`bID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `T_marks`
--
ALTER TABLE `T_marks`
  ADD CONSTRAINT `t_marks_ibfk_1` FOREIGN KEY (`bID`) REFERENCES `T_books` (`bID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `T_rated`
--
ALTER TABLE `T_rated`
  ADD CONSTRAINT `t_rated_con` FOREIGN KEY (`bID`) REFERENCES `T_books` (`bID`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
