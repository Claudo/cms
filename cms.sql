-- phpMyAdmin SQL Dump
-- version 3.5.8.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 10, 2013 at 03:56 PM
-- Server version: 5.5.31-0ubuntu0.13.04.1
-- PHP Version: 5.4.9-4ubuntu2

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cms`
--

-- --------------------------------------------------------

--
-- Table structure for table `albums`
--

CREATE TABLE IF NOT EXISTS `albums` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` tinytext COLLATE utf8_bin,
  `title` tinytext COLLATE utf8_bin,
  `description` text COLLATE utf8_bin,
  `header` tinytext COLLATE utf8_bin,
  `content` text COLLATE utf8_bin,
  `cover` tinytext COLLATE utf8_bin,
  `updated_at` date NOT NULL,
  `created_at` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=17 ;

--
-- Dumping data for table `albums`
--

INSERT INTO `albums` (`id`, `name`, `title`, `description`, `header`, `content`, `cover`, `updated_at`, `created_at`) VALUES
(10, 'alBOOM 2', 'sadsdsadaddasdsdadasdasd', 'asdsdassadasasddassaddsaddsasaddsasa', 'sdadasdasdas', 'asdasdasdasdddasdsdsd', '1370531910104_wp2.jpg', '2013-06-10', '2013-06-06'),
(14, 'альбом 1', 'титл', '', '', '', '1370590494615_wp3.jpg', '2013-06-07', '2013-06-06'),
(16, 'dssdfsdfsdfdsf', 'dsfsdfs', 'fsdfdsfsdfds', 'dsfsdfsdfsdfdsfs', '', '1370590821619_wp3.jpg', '2013-06-07', '2013-06-06');

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE IF NOT EXISTS `articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text,
  `description` text,
  `header` text,
  `content` text,
  `id_category` int(11) DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=53 ;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `title`, `description`, `header`, `content`, `id_category`, `updated_at`, `created_at`) VALUES
(2, 'title для этой статьи', 'Красивое и сочное описание', 'Заголовок статьи', '<p>контентконтентконтент</p>\n\n<p>&nbsp;</p>\n\n<p>&nbsp;</p>\n\n<p>&nbsp;</p>\n\n<p>контентммконтентконтент</p>\n\n<p>контентконтентконтент</p>\n\n<p>&nbsp;</p>\n\n<p>&nbsp;</p>\n\n<p>&nbsp;</p>\n\n<p>контентммконтентконтент</p>\n\n<p>контентконтентконтент</p>\n\n<p>&nbsp;</p>\n\n<p>&nbsp;</p>\n\n<p>&nbsp;</p>\n\n<p>контентммконтентконтент</p>\n\n<p>контентконтентконтент</p>\n\n<p>&nbsp;</p>\n\n<p>&nbsp;</p>\n\n<p>&nbsp;</p>\n\n<p>контентммконтентконтент</p>\n', 32, '2013-05-21', '2013-05-21'),
(3, '', '', 's', '<p>3</p>\n', 0, '2013-05-21', '2013-05-21'),
(8, 'sdf', 'sdf', 'asd', '<p>3sdf</p>\n', 0, '2013-05-21', '2013-05-21'),
(9, 'asdf', 'sadf', 'asdf', '<p>3asdf</p>\n', 0, '2013-05-21', '2013-05-21'),
(10, 'asdf', 'sadf', 'asdf', '<p>3asdf</p>\n', 0, '2013-05-21', '2013-05-21'),
(13, '2ывывф', '3ывфывфывфывф', '1кккккккккккк', '<p>4ыфвыфвыфвыфвыфвыв</p>\n\n<p>ыфвывывфывфывфыфв</p>\n\n<p>ыфвывфывфывфывфывфыфвыфвыфвыфв</p>\n\n<p>выффвы</p>\n', 21, '2013-06-04', '2013-05-22'),
(17, '2', '3', '1', '<p>4</p>\n', 21, '2013-05-22', '2013-05-22'),
(18, '', '', '1', '', 0, '2013-05-22', '2013-05-22'),
(19, '', '', '1', '', 28, '2013-05-22', '2013-05-22'),
(20, '', '', '1', '', 28, '2013-05-22', '2013-05-22'),
(21, '', '', '1', '<p>1</p>\n', 31, '2013-05-22', '2013-05-22'),
(22, '', '', '1', '<p>1</p>\n', 31, '2013-05-22', '2013-05-22'),
(23, '', '', '1', '<p>1</p>\n', 31, '2013-05-22', '2013-05-22'),
(24, 'asdf', 'asdf', 'asdf', '<p>asdf</p>\n', 0, '2013-05-22', '2013-05-22'),
(25, '2', '3', '1', '<p>4</p>\n', 0, '2013-05-22', '2013-05-22'),
(26, '', '', 'a', '', 0, '2013-05-22', '2013-05-22'),
(27, '', '', 's', '', 0, '2013-05-22', '2013-05-22'),
(28, '', '', 's', '', 0, '2013-05-22', '2013-05-22'),
(29, '', '', 's', '', 0, '2013-05-22', '2013-05-22'),
(30, '', '', 'd', '', 0, '2013-05-22', '2013-05-22'),
(31, '', '', 'ddd', '', 0, '2013-05-22', '2013-05-22'),
(32, '', '', 's', '', 0, '2013-05-22', '2013-05-22'),
(33, '', '', 'd', '', 0, '2013-05-22', '2013-05-22'),
(34, '', '', 's', '<p>s</p>\n', 0, '2013-05-22', '2013-05-22'),
(35, '', '', 'asdf', '<p>s</p>\n', 0, '2013-05-22', '2013-05-22'),
(36, '', '', 'sdf', '<p>s</p>\n', 0, '2013-05-22', '2013-05-22'),
(37, '', '', 'sdf', '<p>sfd</p>\n', 0, '2013-05-22', '2013-05-22'),
(38, '', '', 'asdf', '', 0, '2013-05-22', '2013-05-22'),
(39, '', '', 's', '', 0, '2013-05-22', '2013-05-22'),
(40, '2', '3', '1', '<p>4</p>\n', 28, '2013-05-23', '2013-05-23'),
(41, 'dfsdfsdsd', 'fdsfsfsdsfs', 'sfsdfs', '<p>fdsfsdfsdfs&nbsp;</p>\n\n<p>sdffsdfsd</p>\n\n<p>fsf</p>\n\n<p>sdfsd</p>\n\n<p>fsddfsdfsfsdfsfdsfds</p>\n', NULL, '2013-05-28', '2013-05-28'),
(42, 'Титл', 'Дескрипшн', 'Большая статья (заголовок)', '<ul>\n	<li>1 пакетик сухих дрожжей (7г) (для теста)</li>\n	<li>3 чашки (470 г) муки (для теста)</li>\n	<li>1 &frac12; ч. л. соли (для теста)</li>\n	<li>2 ст. л. сахара (для теста)</li>\n	<li>&frac12; чашки (125 мл) молока (для теста)</li>\n	<li>1 яйцо + 1 яичный белок (желток оставляем для смазки пирожков) (для теста)</li>\n	<li>&frac12; чашки масла (125 мл) (для теста)</li>\n	<li>3 ст. л. масла (для картофельной начинки)</li>\n	<li>1 небольшая луковица (измельчённая) (для картофельной начинки)</li>\n	<li>4 средних картофелины, сваренные и очищенные (для картофельной начинки)</li>\n	<li>1/3 чашки нарезанной свежей кинзы (кориандра) или петрушки или укропа (можно использовать несколько трав одновременно) (для картофельной начинки)</li>\n	<li>соль, перец по вкусу (для картофельной начинки)</li>\n	<li>3 ст. л. масла (для мясной начинки)</li>\n	<li>1 небольшая луковица (измельчённая) (для мясной начинки)</li>\n	<li>375 гр. говяжьего фарша (для мясной начинки)</li>\n	<li>соль, перец по вкусу (для мясной начинки)</li>\n	<li>1 яичный желток (для смазки)</li>\n</ul>\n\n<h2>Как приготовить пирожки с картошкой в духовке: пошаговая фото инструкция</h2>\n\n<p>&nbsp;</p>\n\n<ul>\n	<li>Растворяем сухие дрожжи в тёплой воде, оставляем на 5 минут постоять. В отдельной миске соединяем и хорошо размешиваем муку соль и сахар, и всыпаем понемногу эту смесь в дрожжевой раствор. Добавляем молоко, яйца и масло и замешиваем дрожжевое тесто для пирожков с картошкой. Смазав рабочую поверхность мукой, хорошо вымесите тесто в течении 5-6 минут, пока оно не станет однородным и эластичным.</li>\n	<br />\n	<li>Помещаем тесто в большую миску, накрываем полиэтиленовой плёнкой или кухонным полотенцем и оставляем в тёплом месте на полтора часа, чтобы оно подошло. Тесто должно увеличиться в объёме минимум в два раза, выглядеть вздувшимся и если ткнуть в него пальцем, быть мягким на ощупь.</li>\n	<br />\n	<li>Пока всходит тесто, готовим начинку. Для приготовления начинки из картошки для пирожков на небольшой сковородке разогреваем масло. Добавляем лук, и слегка обжариваем его (5-7 минут). Делаем пюре из отваренного и очищенного картофеля, в которое добавляем обжаренный лук, зелень, соль и перец. Хорошо всё перемешиваем.</li>\n	<br />\n	<li>Классическим рецептом являются печеные пирожки с картошкой, но начинку можно заменить по своему вкусу. Для приготовления мясной начинки разогреваем масло на небольшой сковородке. Обжариваем нарезанный лук до полупрозрачности. Добавляем мясо и жарим в течении 10 минут иногда помешивая. Добавляем соль и перец по вкусу. Мясная начинка готова.</li>\n	<br />\n	<li>Если есть желание, прожаренный с луком фарш можно дополнительно измельчить на кухонном комбайне. Ещё одним вариантом начинки для дрожжевых пирожков с картошкой может быть, например, измельчённый сыр фета, смешанный с петрушкой. Осторожно надавите на тесто, для того чтобы вышли газы. Тесто не должно быть липким. Разделите тесто для пирожков с картошкой в духовке на небольшие комочки, которых у вас должно получиться 22-25 штук.</li>\n	<br />\n	<li>При приготовлении пирожков с картошкой существует два способа формирования самого пирожка, выбирайте любой, который будет вам ближе. Метод первый, как сделать пирожки с картошкой: с помощью скалки раскатайте каждый шарик из текста так, чтобы получился кружок сантиментов 10 в диаметре.</li>\n</ul>\n', 21, '2013-05-30', '2013-05-30'),
(43, 'dasdasdasdadada', 'sadasdasdas', 'asdadas', '<p>ssadasdasdasas</p>\n', 21, '2013-05-31', '2013-05-31'),
(44, 'кцукц кцу цкцууук цук цкц', 'цукцукцкцкцкц', 'цукцкцкцукц', '<p>цукцукцукц &nbsp;цкц кцук цукцукцукцуккцу</p>\n\n<p>цуцукцукцуцу</p>\n\n<p>цкукцуцукук у к к цкцукцукцуцуукукукккккцукццупарпа</p>\n', 21, '2013-05-31', '2013-05-31'),
(45, 'куц', 'цуцуцуцкцкцу', 'укцукцукц', '<p>куцууцуцуцкцукцук к цк цук цукцукцкцкцкукцу</p>\n', 21, '2013-05-31', '2013-05-31'),
(46, 'кцукцукцкц', 'укцуцуцуцукцкцкцкцкцкц', 'кцукцукцукцукц', '', 21, '2013-05-31', '2013-05-31'),
(47, 'цкцукцкцкцкцкцкцу', 'кцкцукцкц', 'кцукцкцкцкц', '<p>цкцукцукцкцкцкцкцукцкц</p>\n', 21, '2013-05-31', '2013-05-31'),
(48, 'rwrrwrwrw', 'w', 'ewrwerwerweew', '<p>rwerwrwe r wr w rwer</p>\n\n<p>ewr&nbsp;</p>\n\n<p>we</p>\n\n<p>r w</p>\n\n<p>r wer</p>\n\n<p>&nbsp;wer wer wrwe rw</p>\n', 21, '2013-05-31', '2013-05-31'),
(49, 'werwerwerwerw', 'werwer', 'rwerwerwrrw', '<p>rwrwerwer &nbsp;wr wr w rwerwerwerwre rfdds df ss s</p>\n', 21, '2013-05-31', '2013-05-31'),
(50, 'hjhjkhjkgh', 'sdfghjkjjnbvcvx', 'ewerwrqcac', '<p>asdfghmnbvcxx nbvfddsfghmn bvbgh</p>\n', 21, '2013-05-31', '2013-05-31'),
(51, 'xvcbbbbnvsdsfg', 'sdfghjgfdscxvb', 'dsfghnmbvcxzcv', '<p>sdffbcxccx</p>\n', 21, '2013-05-31', '2013-05-31'),
(52, 'wewerwerwerwerwerwe', 'wewrwrw', 'rwewrwrwe', '', 21, '2013-05-31', '2013-05-31');

-- --------------------------------------------------------

--
-- Table structure for table `blocks`
--

CREATE TABLE IF NOT EXISTS `blocks` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `url` varchar(128) NOT NULL,
  `block` text NOT NULL,
  `updated_at` date NOT NULL,
  `created_at` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `blocks`
--

INSERT INTO `blocks` (`id`, `url`, `block`, `updated_at`, `created_at`) VALUES
(3, 'gogo.loco', '<p>first</p>\n', '2013-06-07', '2013-06-07'),
(4, 'gogo2.com', '<p>second</p>\n', '2013-06-07', '2013-06-07');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT NULL,
  `name_category` text,
  `updated_at` date NOT NULL,
  `created_at` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=37 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `parent_id`, `name_category`, `updated_at`, `created_at`) VALUES
(21, NULL, 'Категория', '2013-05-08', '2013-05-08'),
(22, NULL, 'Категория 2', '2013-05-08', '2013-05-08'),
(23, NULL, 'Еще одна категория', '2013-05-13', '2013-05-08'),
(28, 21, 'Подкатегория', '2013-05-08', '2013-05-08'),
(30, 21, 'Еще одна подкатегория', '2013-05-08', '2013-05-08'),
(31, 21, 'И еще одна подкатегория', '2013-05-08', '2013-05-08'),
(32, 31, 'Второй уровень вложенности', '2013-05-08', '2013-05-08'),
(34, 23, 'Ля ля ля1', '2013-05-13', '2013-05-13'),
(35, 23, 'Ля ля ля', '2013-05-13', '2013-05-13'),
(36, NULL, 'alea jacta est', '2013-05-28', '2013-05-28');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE IF NOT EXISTS `images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` tinytext COLLATE utf8_bin,
  `title` tinytext COLLATE utf8_bin,
  `description` text COLLATE utf8_bin,
  `header` tinytext COLLATE utf8_bin,
  `image` tinytext COLLATE utf8_bin,
  `preview` tinytext COLLATE utf8_bin,
  `content` text COLLATE utf8_bin,
  `id_album` int(11) DEFAULT NULL,
  `updated_at` date NOT NULL,
  `created_at` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=26 ;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `name`, `title`, `description`, `header`, `image`, `preview`, `content`, `id_album`, `updated_at`, `created_at`) VALUES
(18, 'eqeqeqwewq', '', '', '', '1370531435519_wp2.jpg', 'small_1370531435519_wp2.jpg', '', 10, '2013-06-06', '2013-06-06'),
(19, 'gdgdffgd', '', '', '', '1370531910104_wp2.jpg', 'small_1370531910104_wp2.jpg', '', 10, '2013-06-06', '2013-06-06'),
(20, 'fdgdgdfgdd', '', '', '', '1370531920653_wp4.jpg', 'small_1370531920653_wp4.jpg', '', 10, '2013-06-06', '2013-06-06'),
(21, 'adsdasasda', 'adsasdadasda', 'asdasdasdasda', 'adsdasdadasdsadasdd', '1370532305482_bg.jpg', 'small_1370532305482_bg.jpg', 'dasdadasdasdasdad', 10, '2013-06-06', '2013-06-06'),
(22, 'dffssdsfsdfsdfsdfdsd', 'dsfsdfsdfsdfdsdfs', 'fdsfsdfsdfs', 'sdfsdfsdfsdfsdfsdfdsf', '1370532324491_wp2.jpg', 'small_1370532324491_wp2.jpg', 'sdfsdfdfdsfsdfsdfsdfsfsdfss', 10, '2013-06-06', '2013-06-06'),
(24, 'sadasdadasdasdasdas', '', '', '', '1370590494615_wp3.jpg', 'small_1370590494615_wp3.jpg', '', 14, '2013-06-07', '2013-06-07'),
(25, 'ffdsdfsdfsfsfsdf', 'fsd', 'ddsfsdfdsfsfdsds', 'fsdfsdsfsd', '1370590821619_wp3.jpg', 'small_1370590821619_wp3.jpg', '', 16, '2013-06-07', '2013-06-07');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
