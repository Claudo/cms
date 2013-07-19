-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Июл 19 2013 г., 15:52
-- Версия сервера: 5.5.31
-- Версия PHP: 5.3.10-1ubuntu3.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `cms`
--

-- --------------------------------------------------------

--
-- Структура таблицы `albums`
--

CREATE TABLE IF NOT EXISTS `albums` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` tinytext CHARACTER SET utf8 COLLATE utf8_bin,
  `title` tinytext CHARACTER SET utf8 COLLATE utf8_bin,
  `description` text CHARACTER SET utf8 COLLATE utf8_bin,
  `header` tinytext CHARACTER SET utf8 COLLATE utf8_bin,
  `content` text CHARACTER SET utf8 COLLATE utf8_bin,
  `cover` tinytext CHARACTER SET utf8 COLLATE utf8_bin,
  `updated_at` date NOT NULL,
  `created_at` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `articles`
--

CREATE TABLE IF NOT EXISTS `articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text,
  `description` text,
  `header` text,
  `content` text,
  `id_category` int(11) DEFAULT NULL,
  `img_preview` blob NOT NULL,
  `updated_at` date DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=109 ;

--
-- Дамп данных таблицы `articles`
--

INSERT INTO `articles` (`id`, `title`, `description`, `header`, `content`, `id_category`, `img_preview`, `updated_at`, `created_at`) VALUES
(2, 'title для этой статьи', 'Красивое и сочное описание', 'Заголовок статьи', '<p>контентконтентконтент</p>\n\n<p>&nbsp;</p>\n\n<p>&nbsp;</p>\n\n<p>&nbsp;</p>\n\n<p>контентммконтентконтент</p>\n\n<p>контентконтентконтент</p>\n\n<p>&nbsp;</p>\n\n<p>&nbsp;</p>\n\n<p>&nbsp;</p>\n\n<p>контентммконтентконтент</p>\n\n<p>контентконтентконтент</p>\n\n<p>&nbsp;</p>\n\n<p>&nbsp;</p>\n\n<p>&nbsp;</p>\n\n<p>контентммконтентконтент</p>\n\n<p>контентконтентконтент</p>\n\n<p>&nbsp;</p>\n\n<p>&nbsp;</p>\n\n<p>&nbsp;</p>\n\n<p>контентммконтентконтент</p>\n', 32, '', '2013-05-21', '2013-05-21'),
(3, '', '', 's', '<p>3</p>\n', 0, '', '2013-05-21', '2013-05-21'),
(8, 'sdf', 'sdf', 'asd', '<p>3sdf</p>\n', 0, '', '2013-05-21', '2013-05-21'),
(9, 'asdf', 'sadf', 'asdf', '<p>3asdf</p>\n', 0, '', '2013-05-21', '2013-05-21'),
(10, 'asdf', 'sadf', 'asdf', '<p>3asdf</p>\n', 0, '', '2013-05-21', '2013-05-21'),
(13, '2ывывф', '3ывфывфывфывф', '1кккккккккккк', '<p>4ыфвыфвыфвыфвыфвыв</p>\n\n<p>ыфвывывфывфывфыфв</p>\n\n<p>ыфвывфывфывфывфывфыфвыфвыфвыфв</p>\n\n<p>выффвы</p>\n', 21, '', '2013-06-04', '2013-05-22'),
(17, '2', '3', '1', '<p>4</p>\n', 21, '', '2013-05-22', '2013-05-22'),
(18, '', '', '1', '', 0, '', '2013-05-22', '2013-05-22'),
(19, '', '', '1', '', 28, '', '2013-05-22', '2013-05-22'),
(20, '', '', '1', '', 28, '', '2013-05-22', '2013-05-22'),
(21, '', '', '1', '<p>1</p>\n', 31, '', '2013-05-22', '2013-05-22'),
(22, '', '', '1', '<p>1</p>\n', 31, '', '2013-05-22', '2013-05-22'),
(23, '', '', '1', '<p>1</p>\r\n', 31, 0xffd8ffe000104a46494600010100000100010000fffe003e43524541544f523a2067642d6a7065672076312e3020287573696e6720494a47204a50454720763830292c2064656661756c74207175616c6974790affdb004300080606070605080707070909080a0c140d0c0b0b0c1912130f141d1a1f1e1d1a1c1c20242e2720222c231c1c2837292c30313434341f27393d38323c2e333432ffdb0043010909090c0b0c180d0d1832211c213232323232323232323232323232323232323232323232323232323232323232323232323232323232323232323232323232ffc0001108004d006403012200021101031101ffc4001f0000010501010101010100000000000000000102030405060708090a0bffc400b5100002010303020403050504040000017d01020300041105122131410613516107227114328191a1082342b1c11552d1f02433627282090a161718191a25262728292a3435363738393a434445464748494a535455565758595a636465666768696a737475767778797a838485868788898a92939495969798999aa2a3a4a5a6a7a8a9aab2b3b4b5b6b7b8b9bac2c3c4c5c6c7c8c9cad2d3d4d5d6d7d8d9dae1e2e3e4e5e6e7e8e9eaf1f2f3f4f5f6f7f8f9faffc4001f0100030101010101010101010000000000000102030405060708090a0bffc400b51100020102040403040705040400010277000102031104052131061241510761711322328108144291a1b1c109233352f0156272d10a162434e125f11718191a262728292a35363738393a434445464748494a535455565758595a636465666768696a737475767778797a82838485868788898a92939495969798999aa2a3a4a5a6a7a8a9aab2b3b4b5b6b7b8b9bac2c3c4c5c6c7c8c9cad2d3d4d5d6d7d8d9dae2e3e4e5e6e7e8e9eaf2f3f4f5f6f7f8f9faffda000c03010002110311003f00eb628f8c53f4e42a6443d8d65784751fed2d295647dd3c1f239ee7d0fe55bb6e9b2f1c13d79a69dd5c13bab905d5b9b5985f44a7038914771eb5af0149a25914e430c8ac7bed6b475cdb4faac11b30e81b3c7e15c8cfaf4697261b1d42658533b5c057070473c1ce39fd295edb0eccf4c094fd99af39b5f1a5ec0a7324774146edbb4a311f43c7e19a864f8a9a92b4823d011953a9337ff5bf4aab824d9e99e5d529507da1cf702bce13e334b1cc3ed1a2a18fb849b0c3f435bba5fc46d0759ba11133dac92602f9c9c127dc67f5c5170b337ef34d8aef4f65954127906b16c3c3f751292f74fb73f28f415d43dc5b3c4a23b88997d55c115347e548b88dd5f1d769cd1caaf725a47392e99394216720d729a9a6b3a5dc79a733c44e38af499621e959f736e2442ac3229b8dc4d1c536bf0c5b56646572324628abba969114d765b60e8074a2b3b485ef181e06bf16fe2716e7e54bc84ae3d5d791fa66b4bc41e3bb8d1b55914582c91a1da370dbb87d777f4ae274ebe6b6d46ca6071e44eaf9039c679fd2bd935ed2e1beb12e96b6d24e7ee99932b9f7c5453d9a6461aa7344f9f75dd61b55d4a4b98e236d1b9ff54ac485aa4b753420324d9f519e6bd8c7c28b016d737fa85e0693cb670b1461234e3ae075c7a6457934ba5e21dfe5b64b00ac1b23e95add1d495ca92ea97331f2a13b59b258e78faff3a853539a06564bb998a1ce76fcb9fcff00a56dd878645cdbc9279a77818000e9f8f7acf9b48d634d596178a3f2981059c0600631919e86ab4ea166598752b5bfde6e5824db7201c00f9ef9f5ab767258594ad25d4a0a05c6d0c54fb631deb3b4ff000e4f7f241005daacc4798d81f5ce4f0056bf8c3c033f86adeceed264bab29c03ba2943638f5f438383d2b2f690e6e5bea69c92e5b8d3e2accd249046e23dbb4c864cb7d4e3a669f6fe2d31dca1324b1a01b5993ef63ebd6b16cf4d7bc8267b6b778d1000fbf04aaf18c9c0ee2aacb67708fb4a71ea39ad1f998f31f42f833c57a66b5a7ada417170f710ae58dcb06661ebbbbfe3cd743301b49af0bf08698a15ded752686e9b1b57a135e8515c78834b8916e905cc67a95ea2a154e863ed137a1ba60f318b7bd14905f47242ac41527a834555cd0e5bc41e048ee63373a58f2e453b9a1cfde1ed5df801ec97fdd155a2356cc91c76f2492b2a468a59998e0000724d16d6e4c29c60db8adccff115f5b5af84eecdc4a104d198132d8dccc3000ff3d8d7944d109e116f1b65065ba63271d7b71fe7d6a1f1178ac788f578d2324585b6e36f19ff00968791b8fb9c703afe3d6bd9ea1b2ec857c337236b74e3821ba13e9d3b8fa25257b1d0a365736749b2786159260c62c9dadd327dbfcfad4fbaca6c412b448d29088b23719f7c54897b03da4464b88599430f27d3df04e79f71dbf3a7771466612795b81e739271d875e9d0feb5728a6b41c27cb2bd8589268efd6d6eb49b9b780138915c48ae3182481ce0e7debb1f155bdb8f0ee90b246bf36e455030a46063fae3eb58fa2ea0915d2a4c43dbb9c3b39cec3ebf4fe95a5e25bcb7d464b6b54977456ab8124632858e0939fa71f8579f0a2dd5bcba7dc7656ab0705ca73496034ed3a58636c46f9c46c3d7ae3fc2b2e6f046a9b7cd58f82338ef5d65b5bdbca563925dd820800fbf7fc7f2eb5bd7d7d7365090f0165c6320576548ab6a7955e319ad4f268b47d52c2e23b98e162d13678aeee4f18ac714066521b1f30f435a70deda4f68ea8ca24c1241eb9af2bd52e9bedd3249d439c563ac36672463ec767a33d213c436170a24de0668af2c8da465ca49819a2abda9a7b53dee16ae13e2bf89fec3a5c5a25bb7efeec6f9b07a460f03f123f207d6bab8afe04650d2004f4af00f126ad3ebde20bbbe9c11b9c845feea8e00fcab73ad10db5c6f27080f18391dbfc7fc2b4e105f23706503e7c7381ea7db27deb3ad86db64552b92c490c7aff9e6b5acb319531961229e63e7818e769fe99e6b2695ce88b762fd9cdf66625c80ac4067e83b7f10e9e9f88aebec66105ba4126312101c7cbf29fa6707a74041f638c0e4a259259415dc1b18009e1877032307af6fa63bd76be19d2e6d5446be5661cf61f2e3b654f51d3ee9f97b7a5694ef7d089dada969ec6dd5649e357ef802363bbaf52149ebedf95548a37b7cbda12792a54a8c127a28e7249f4fc4e319ae8f59b4b66d3240aa582311b8846e01c7f1023ea79c73c570d35da4502ac254b03ca46b9c8e33d71c73c9c01e98ce6b493b111d4d4875d582781d542a971e61dd91cfa7f8fd3ad74e75fd3aea7584caa491d09af35bad36fef3499b58de668d25c4a54b1207f7b9e7f1a6d8adadcdcc51cb3b42e3a37bd734a72b98576e12b23d0353d1eda5469a2f91fd57bd705e20f0cde0ff00494f986326bb681aea088432b8922ecfeb52dc3ab4454f4db8a6e2a44b829c6ccf1fb7826746c03c31145756b6d0a3ca06397268acb90ca387d0e9f5ad4974cd02f2f02af991c644648fe23c0fd4d785a924b3724ff5af4af1edd48be1e8e31c092619fc01af39c7fa379993cb631d8574b677246ef87aca39eca49e760aa091f39c2b707f8bb1e4f5e0d5b810880928ce89f2bb40c241839e71938ff3d33577c290f991416f0cd35bc927ca6589c0ea5ba82391c74ad98f49826ba985e626bb8c809751af94ddfa85e0f4ebd6938df62e2ec64592b73244e1971cb2b607e8320fb1c8f435d3e85a8fd8c16023dd9caee5c1638ce78e18f7ced27e95cd596b11de6a4ba78b796291884f396e0e076fbb8feb5a5a3da4b2d85ddd09d638e10db9234c17c67be70338ea066945d9e812d51d16ada929b531aa30604ba05665233c91818e473d46703eef35c3dedd199cc09313216c804363f05009fc4e3e95d3cffe9de1e8af65246e0ceb1285288338da3209eddf39ac3ba82eed4dac42ee378ae1c058ded9088c9efc8e7afb55547dc50d0e8bc3d2be9852ce49913cecab032e37b608c29c6491e8075ebd0d727ad848dede78b237a027ea3bd6fd9b3e9dabdbb4253cd8c482598c637c8107453d107d07e7543c6d121d5cdb443cb8e39240075e8c456738fb88e6c4ae646e693a84979a65b7984ee1c55ad4662206553cb715ccf876fe495840c06d886062b4ee2e5daf5633f740cd28bd0715a22cc3636e912865cb7734545e7b7a51577451ffd9, '2013-06-20', '2013-05-22'),
(24, 'asdf', 'asdf', 'asdf', '<p>asdf</p>\n', 0, '', '2013-05-22', '2013-05-22'),
(25, '2', '3', '1', '<p>4</p>\n', 0, '', '2013-05-22', '2013-05-22'),
(26, '', '', 'a', '', 0, '', '2013-05-22', '2013-05-22'),
(27, '', '', 's', '', 0, '', '2013-05-22', '2013-05-22'),
(28, '', '', 's', '', 0, '', '2013-05-22', '2013-05-22'),
(29, '', '', 's', '', 0, '', '2013-05-22', '2013-05-22'),
(30, '', '', 'd', '', 0, '', '2013-05-22', '2013-05-22'),
(31, '', '', 'ddd', '', 0, '', '2013-05-22', '2013-05-22'),
(32, '', '', 's', '', 0, '', '2013-05-22', '2013-05-22'),
(33, '', '', 'd', '', 0, '', '2013-05-22', '2013-05-22'),
(34, '', '', 's', '<p>s</p>\n', 0, '', '2013-05-22', '2013-05-22'),
(35, '', '', 'asdf', '<p>s</p>\n', 0, '', '2013-05-22', '2013-05-22'),
(36, '', '', 'sdf', '<p>s</p>\n', 0, '', '2013-05-22', '2013-05-22'),
(37, '', '', 'sdf', '<p>sfd</p>\n', 0, '', '2013-05-22', '2013-05-22'),
(38, '', '', 'asdf', '', 0, '', '2013-05-22', '2013-05-22'),
(39, '', '', 's', '', 0, '', '2013-05-22', '2013-05-22'),
(40, '2', '3', '1', '<p>4</p>\n', 28, '', '2013-05-23', '2013-05-23'),
(41, 'dfsdfsdsd', 'fdsfsfsdsfs', 'sfsdfs', '<p>fdsfsdfsdfs&nbsp;</p>\n\n<p>sdffsdfsd</p>\n\n<p>fsf</p>\n\n<p>sdfsd</p>\n\n<p>fsddfsdfsfsdfsfdsfds</p>\n', NULL, '', '2013-05-28', '2013-05-28'),
(42, 'Титл', 'Дескрипшн', 'Большая статья (заголовок)', '<ul>\n	<li>1 пакетик сухих дрожжей (7г) (для теста)</li>\n	<li>3 чашки (470 г) муки (для теста)</li>\n	<li>1 &frac12; ч. л. соли (для теста)</li>\n	<li>2 ст. л. сахара (для теста)</li>\n	<li>&frac12; чашки (125 мл) молока (для теста)</li>\n	<li>1 яйцо + 1 яичный белок (желток оставляем для смазки пирожков) (для теста)</li>\n	<li>&frac12; чашки масла (125 мл) (для теста)</li>\n	<li>3 ст. л. масла (для картофельной начинки)</li>\n	<li>1 небольшая луковица (измельчённая) (для картофельной начинки)</li>\n	<li>4 средних картофелины, сваренные и очищенные (для картофельной начинки)</li>\n	<li>1/3 чашки нарезанной свежей кинзы (кориандра) или петрушки или укропа (можно использовать несколько трав одновременно) (для картофельной начинки)</li>\n	<li>соль, перец по вкусу (для картофельной начинки)</li>\n	<li>3 ст. л. масла (для мясной начинки)</li>\n	<li>1 небольшая луковица (измельчённая) (для мясной начинки)</li>\n	<li>375 гр. говяжьего фарша (для мясной начинки)</li>\n	<li>соль, перец по вкусу (для мясной начинки)</li>\n	<li>1 яичный желток (для смазки)</li>\n</ul>\n\n<h2>Как приготовить пирожки с картошкой в духовке: пошаговая фото инструкция</h2>\n\n<p>&nbsp;</p>\n\n<ul>\n	<li>Растворяем сухие дрожжи в тёплой воде, оставляем на 5 минут постоять. В отдельной миске соединяем и хорошо размешиваем муку соль и сахар, и всыпаем понемногу эту смесь в дрожжевой раствор. Добавляем молоко, яйца и масло и замешиваем дрожжевое тесто для пирожков с картошкой. Смазав рабочую поверхность мукой, хорошо вымесите тесто в течении 5-6 минут, пока оно не станет однородным и эластичным.</li>\n	<br />\n	<li>Помещаем тесто в большую миску, накрываем полиэтиленовой плёнкой или кухонным полотенцем и оставляем в тёплом месте на полтора часа, чтобы оно подошло. Тесто должно увеличиться в объёме минимум в два раза, выглядеть вздувшимся и если ткнуть в него пальцем, быть мягким на ощупь.</li>\n	<br />\n	<li>Пока всходит тесто, готовим начинку. Для приготовления начинки из картошки для пирожков на небольшой сковородке разогреваем масло. Добавляем лук, и слегка обжариваем его (5-7 минут). Делаем пюре из отваренного и очищенного картофеля, в которое добавляем обжаренный лук, зелень, соль и перец. Хорошо всё перемешиваем.</li>\n	<br />\n	<li>Классическим рецептом являются печеные пирожки с картошкой, но начинку можно заменить по своему вкусу. Для приготовления мясной начинки разогреваем масло на небольшой сковородке. Обжариваем нарезанный лук до полупрозрачности. Добавляем мясо и жарим в течении 10 минут иногда помешивая. Добавляем соль и перец по вкусу. Мясная начинка готова.</li>\n	<br />\n	<li>Если есть желание, прожаренный с луком фарш можно дополнительно измельчить на кухонном комбайне. Ещё одним вариантом начинки для дрожжевых пирожков с картошкой может быть, например, измельчённый сыр фета, смешанный с петрушкой. Осторожно надавите на тесто, для того чтобы вышли газы. Тесто не должно быть липким. Разделите тесто для пирожков с картошкой в духовке на небольшие комочки, которых у вас должно получиться 22-25 штук.</li>\n	<br />\n	<li>При приготовлении пирожков с картошкой существует два способа формирования самого пирожка, выбирайте любой, который будет вам ближе. Метод первый, как сделать пирожки с картошкой: с помощью скалки раскатайте каждый шарик из текста так, чтобы получился кружок сантиментов 10 в диаметре.</li>\n</ul>\n', 21, '', '2013-05-30', '2013-05-30'),
(48, 'rwrrwrwrw', 'w', 'ewrwerwerweew', '<p>rwerwrwe r wr w rwer</p>\n\n<p>ewr&nbsp;</p>\n\n<p>we</p>\n\n<p>r w</p>\n\n<p>r wer</p>\n\n<p>&nbsp;wer wer wrwe rw</p>\n', 21, '', '2013-05-31', '2013-05-31'),
(49, 'werwerwerwerw', 'werwer', 'rwerwerwrrw', '<p>rwrwerwer &nbsp;wr wr w rwerwerwerwre rfdds df ss s</p>\n', 21, '', '2013-05-31', '2013-05-31'),
(52, 'wewerwerwerwerwerwe', 'wewrwrw', 'rwewrwrwe', '<p>ququ</p>\r\n', 21, 0xffd8ffe000104a46494600010100000100010000fffe003e43524541544f523a2067642d6a7065672076312e3020287573696e6720494a47204a50454720763830292c2064656661756c74207175616c6974790affdb004300080606070605080707070909080a0c140d0c0b0b0c1912130f141d1a1f1e1d1a1c1c20242e2720222c231c1c2837292c30313434341f27393d38323c2e333432ffdb0043010909090c0b0c180d0d1832211c213232323232323232323232323232323232323232323232323232323232323232323232323232323232323232323232323232ffc00011080064004203012200021101031101ffc4001f0000010501010101010100000000000000000102030405060708090a0bffc400b5100002010303020403050504040000017d01020300041105122131410613516107227114328191a1082342b1c11552d1f02433627282090a161718191a25262728292a3435363738393a434445464748494a535455565758595a636465666768696a737475767778797a838485868788898a92939495969798999aa2a3a4a5a6a7a8a9aab2b3b4b5b6b7b8b9bac2c3c4c5c6c7c8c9cad2d3d4d5d6d7d8d9dae1e2e3e4e5e6e7e8e9eaf1f2f3f4f5f6f7f8f9faffc4001f0100030101010101010101010000000000000102030405060708090a0bffc400b51100020102040403040705040400010277000102031104052131061241510761711322328108144291a1b1c109233352f0156272d10a162434e125f11718191a262728292a35363738393a434445464748494a535455565758595a636465666768696a737475767778797a82838485868788898a92939495969798999aa2a3a4a5a6a7a8a9aab2b3b4b5b6b7b8b9bac2c3c4c5c6c7c8c9cad2d3d4d5d6d7d8d9dae2e3e4e5e6e7e8e9eaf2f3f4f5f6f7f8f9faffda000c03010002110311003f00f6462771e4d2027d4d2b7de349de800f9bd4d2127d4d389a6d003727d4d71ff103c60de15d1d1adc2b5f5c315855b9000eac47b71f9d7606bc4fc76e75cf1ec96ca7747671ac4076c91b98fea07e1401a7e03f8957babeaa9a4eafb1a5941f2a751b4961ce08e9d3a631fad7a63b1c7535f34484e91e27b3b8898a88e64707d3041afa509ca020d003779f5345368a00e6f4ff008b5e1ebdb930dc79f64dbb01a55ca1fc4671f8d77114d1cf12cb13abc6c32aca7208f635f35e95676da8192338f3013c93d2ba05bcf11782ace65b1b965b2947dd65dca84ff1283d0fb743401edb79a9d8e9e9baf2ee08076f31c2e7f3ae62f7e25f872d1ca2cf2ce47fcf24e3f338af0f96eee2e1de79e76bbba94f2ecf93f893d2aba43296cbc8bb7ae1083fad007be58fc43f0edf9082f3c873d16652bfaf4fd6bc9acf5cb69fc69ad4934815a7791a038c82777033f415ce95f2d49538faf26b3e597cb9036e3bb3c377a00d8d44dbdfdd874529b41383d3a57bcf87ef12fbc37a7dc249bc340996f52060fea0d7ceb657c2cc4b334465e0f438c67d7dabda7e1a19bfe10b81a48cc68f2c8d1293fc24f6f6ce6803aecd14dcd1401e13af68771e16f165dd9a4bba3077a303c943c8cfbd6f45aba6afe1abdb46256e1a3dc588f4c62b0353d5bfb53c597f7f30f32292e4e0138f914e00cfd3151df1b227ec766920695ffd6123181c9c0ea3d28039b8f3196727e5ed9ea4537ed729cede70738cf4ab3776e7cf7555e10e319c7e26a99865cb323ae17d01feb40152e2f25790ef63927a5384b23040803023a1f5a89ade49e62c9ce0f24f6ab496f25b012827cbcf04734016add584841dc180f98638c7f857d0be13bdb5bcf0ad81b5c2a470ac4507f0b28008af9f6d678c07662ceed8193ce00e82bbbf851ad137135948df2cea6451e8ca79fd0fe9401eb9bc7ad1516ee3ad1401f39de4e90385032598e6b62daded7ca2761f3c2128c3b1ef58808bbd68c417710e48c7b735a76ae61b981c10139460dd08a0065c3a318e59f1e5c980474cfb7f3a82fda19649655959fe5c0e028002e074f4007e54fd5ad99adbc870327e78d81e0f27ff00af5970ab9b301f25892181fe5400cd3812ccc10b6412aa31d7b707f0ab4599d159c85568f0c846486f6aaf6a1a39b71e0e6a595da69d9226d800e4f52d40159d1a160dc7b1e95ade1fd50e85aa417d12065490ee4f50461bf9d6634a49f2a6607d1854ac8a00418dc7ae2803e8686ed678239a320a48a194fa823228af0f83c4daa416f1c31dd9091a0551e800c0a2802b5a46f69ac5d34b095962ca3ab7556dd8fcf8356ee13cc6c0e1979db9e87ad4515c899aeafeed8fefe5691881d4e4ff005aa4daa42db892a589ea0d003a3d455a55b6982b20e377a535bc8966c4327cddc743c564dccf2ee2f1b0c375c0a8e3b8598aa491e187f129c5006c4a155b731ce3b018cd528e60b23337cd213f757a0a89ee06362b37b93cd45e73ee1b54e0776a009ef2e154ae40dc7f847a509290339e73926a8b16794c923003d0538dc32a8289c7406802f7cc79e28a8435d1518231fe7da8a00ebb56f0e6a1a0c31da6b16e2212e4a38704707d477e6b94bdd3bc89328c5a3232adeb5f4f78e61b43e11d51ef630f1242cc38c90dfc247be715f34dc1b991608e4564dfcaae31c7ad0067c16d3cf32c30fcecdd05318496ed965233ea319ad0b08675bf88c703cbfbc0a51064b7a8fd6bdeb4ef861a4bc4af736ece4f277d007cf56ba88b69c486da19b1c8126719fc08a9acacee759bb2910442c72598e156be926f869e1cc0c58a8c7a535fe1e6931afee2d8023a0cd007ce3af68eba2ea22d85c0b8fddab97030327b52e9713deca96b6e81a7918045f535d87897e1af8abfb5aea64d31ae217726230b06f973c0c6720e31584de03f14dacb130d16fd589e19232769edc8e9401b5ff0806b67f8adff00efe9ff00e268a74765f13523555b5be2aa00059549c7be68a00fa6d94127359b71a169375389ae34cb39a5fefc902b37e645145005b8ad20b75db0c491afa22803f4a795145140015029a451450034a8c544e0628a280230063a51451401ffd9, '2013-06-20', '2013-05-31'),
(53, 'dfg', 'dfgdfgdfgd', 'dfgd', '<p>retrw</p>\n', 22, '', '2013-06-20', '2013-06-20'),
(54, 'opop', 'tete', 'ququ', '<p>tutu</p>\n', 28, '', '2013-06-20', '2013-06-20'),
(59, 'тайт13', 'деск13', 'Заг13', '<p>конт13</p>\r\n', 21, 0xffd8ffe000104a46494600010100000100010000fffe003e43524541544f523a2067642d6a7065672076312e3020287573696e6720494a47204a50454720763830292c2064656661756c74207175616c6974790affdb004300080606070605080707070909080a0c140d0c0b0b0c1912130f141d1a1f1e1d1a1c1c20242e2720222c231c1c2837292c30313434341f27393d38323c2e333432ffdb0043010909090c0b0c180d0d1832211c213232323232323232323232323232323232323232323232323232323232323232323232323232323232323232323232323232ffc00011080052006403012200021101031101ffc4001f0000010501010101010100000000000000000102030405060708090a0bffc400b5100002010303020403050504040000017d01020300041105122131410613516107227114328191a1082342b1c11552d1f02433627282090a161718191a25262728292a3435363738393a434445464748494a535455565758595a636465666768696a737475767778797a838485868788898a92939495969798999aa2a3a4a5a6a7a8a9aab2b3b4b5b6b7b8b9bac2c3c4c5c6c7c8c9cad2d3d4d5d6d7d8d9dae1e2e3e4e5e6e7e8e9eaf1f2f3f4f5f6f7f8f9faffc4001f0100030101010101010101010000000000000102030405060708090a0bffc400b51100020102040403040705040400010277000102031104052131061241510761711322328108144291a1b1c109233352f0156272d10a162434e125f11718191a262728292a35363738393a434445464748494a535455565758595a636465666768696a737475767778797a82838485868788898a92939495969798999aa2a3a4a5a6a7a8a9aab2b3b4b5b6b7b8b9bac2c3c4c5c6c7c8c9cad2d3d4d5d6d7d8d9dae2e3e4e5e6e7e8e9eaf2f3f4f5f6f7f8f9faffda000c03010002110311003f00f3dba46046240a8319182c0803b566cf768a44c819c019392071ec3bd66ea225b5bc92069e4ca1e3271918fa9fe756ecf4fb8d46ea0b3d3a1f3249885e7b1380739ec09eb5c90a365bdc772582ea5b81e6b958e15524e3b9a65eeb526c511920903243718edfd6b6cf807c43fdb7fd808a8c422cc64670a81338ddefc8c719ad6b8f851717f631cda7cf1b7957124332b1c1915085dcbc75cabf0481c8fc745455eed0b98e00ea9284db11c1e72c4f51e957f4cbc792e36482796e5b1d38c01df9aee3fe1504860b264073f7e7323056c71f2e01233c9efdbad64df78325b7d4d2d6c2265bc9ae3646199808d029390c71d7dc76ea6aa74e36b0277342da4f2d23771e6330e21dd80bee73c1e7152b6a4801762163e146c61823d49faf1c7a5645d69daa59ddada5cdb90f1ae19010720f4e475fa7a5529da62c5ae217036e40008dc074fcbfcf5af35e19df52ae6e4ba92aae66b746e31c9e4f4f4edc66a4b6d5dad222b68fe545228deb19da79f527f9d72e86e2525b27e63f3090918fc339cd5db6cc6db49241186c2803e807d73f8d37494506e6d3ea26f118dbdcbbcf8dd86c1ea79fc6b9fbcd6bcbb8c4b282c1b76003cfa669f6a2e6de70de5ef7638d88a71f53fa5624b63ab5e4af6b0c6d239663b02807e51cfd78e6b4a3865777d82e6d45a9ddcc9bd32067a02303d8515ccc116b91214821bada0f2110b007d38a2b77855d120e62e2cd1dc413cb3b6f77640a0f6fff00555ed026b8d3eed6fada16568fe60e14801464e79e393fc8552d4ecdedb57291a383bf68d80f273fc3eb5aed1ce6067697c948d032a9ce36f407a639ed552765a0347651f8ceeee7574d6628154ad81b7c119cb160ff009f1fad49a4f8ea4b0d222b4050329667948eec4b1f6ce49ac0b599a2f0de9e11cc925e3491c4edc60b305249f619ae645f1b89a58e2b48c4811836e5ce40e2b35ed277d59528a491dddff8d6eafa7648aecc8abc151d33d79e2abdbea267d2aee7277a89550b16241e39faf38fcab8e55b2302aa447fd5167fef1391c03f867e86a19261f6558ede3962f3148652f856fe9d7f5151f574faebe628bb1d758f88c41a97996e91493702405776efa9f4ff000fa569eb3e221a818e69608e29109e1060b640073ebd07e55e5eb1de69f3472aab44c1b2013d715a50daea3a9ea2acf3b46f29dbb55380338ab749c5594ac894ae74f6b7f10b9bddd1c6a9298db0231c05500e0e38cf7c633516a30d8bea3642d9228a394b33e096e83afcc48ee3f2aa525bc8ba6d9a2ca824c4bbddfef120e47ebc7e554504f25ca492386891090f18208c8efe9f4a8e595ee994d58f52d13c47a469805bfd99635c6d0e0ee247bf000c9ec315b1abb683aeda88a5bf8a3954968a54936bc6d8c647e7d2bc84595c19c6fb87408712a30ea475038ad36b0b6934980c97f32dcc7705983459cc7fdde0fa007f3ad215271566d325c7a9b761368f0c0d1cb6912c81cef6462aae7fbc01538cfd68aa6aba53ee6b5174899e43e1893ebcd153ed67fcdfd7dc68a116b632f52f076b13eadf6c8a390c77170155bcb6c46400493c74ada83c2daf3e95f62179034172aa8010e3e73c8c657bff002aebeebc592995632d22c36ea7ccc1efcbe7df0b8fcaa14f16c3ab5ec5f639242f0ecd8d27f0903191cf19e7a0ef4dd4b5913739a1e19b98a2d3904b6cb1698f299b2ff282c4ed1923afd7b8aab6be0df12c1a8dc486e6d2677525b6af50c0807381c1c8fcebb087538ade0bdb69da5db78c6672df323b0c93dfdb3f857412788ed2d05bc0979beec4302946043952370f9bbf079fa9f5a884da577fd6a5395cf2583c21a95ac173e6c769bde1214ab82002d19395ebd1bd3b8aa2de18d427646b76b4f33e491594288b69e0638e72d91f857b5b6bd0c6b208a23b56dcaa3632149db9181d071d6a5b7d4f4c83469ee64221105bc313610900072547bf3f966abdb2dd7f561791e337be16d4de0d3e599e068e20eb23ef1b54967e73ec3fcf14cd37c35ac5b5d5b4d335bf910c8a0b6fc1001c30e9ecdfad7abea7e22b6b6b97b396772cae232a01e4b296e83ebfcab6f47d4d75b474b8dd0e070adf231e00ff001e9ea2a94efa0ba9e2bad7873509ec621885675690ec465019b83c6719ebce3d69aba4de597d934e6b784cb3bb657232c8324679f7c0f5c57a16a5e36b6d12f5e01235dcc38fbd8c7e3cfe42b3b4af13c5ac78a219b688ef1936c7234bc2639efd3bd4395bdd1f3eb7395bdd1afbedb74a218de491cfeef7aeece4e38ce739edd6a38f43bdb991e431c729cef6459d3a7fdf55e9fade8f2699abc5ad59c171777371743e58fb65724927803a8e6b265be8f45d6e59120f26ecfee9ca6d246e0c486038e833f88a514f5b83672da6d86db661e573bce4060d83e9914577ba72cf7b68b7960d0ac339dfc9032dd0ff002c7e1454ba4bb9ac6a595ac79678ab56985e4fa70da11244915c7a6c1c7e66a9787ae921d6e19a6bb5895013b9ba138e9587ad6a8754d524bc08d1070a36eecf4007f4aa19fa9fc4d6dcbd4e3e6d4f56d563d31f47b379efc4506e3b25da5b7f5ed58fa76bf7177e208a28e455865748ced1f7954601e79e950f8876af80b4262a0e0af047fb26b93b3bf96cafa2bc8557cc89b728238fca871d46dea7712f8aae6db577b39e65fb2413b4782b921437ff005a923f1edc471dd5b0585e19980c9183b41c8fcfe95c25d5cc9757735cc8009267676c74c9393fceb7bc253787239ee3fe122899d30be4e37f5e73f77f0eb59ba3160a6cf4a85aceef4eb6d6afe32cf2943b9705892405e7f2ab37de22b3d0bccb968d59dce220dd9863a7e153adc688de1b824811bec0c6316ea54823e6017dfae2bccbc7faa4536b82ce00de4c11aee56ff9e872491f815aaf6692b44b726b53716e742bc566962890b1e49201fae734d8ac34c8275b8b2bb916788ee56ddb803efc579dac80f51c7b0ad1d3efbc99c3c92b00a463af4fc2b9254271d63262534f747d0d16b767a859d8df472de3433de88e24494a7cc142e1867eee4138ae3bc6b69a5cbe25964b41716fa82ca0cf264b2c9950385e838358da0eb376358d2c99a2fecd138660ef809fed73c0ad6d7f5a48fc517f240629d1d86c60d91d074229fb694a2aeedafa9a369a3a0d29a1d334ab6b4b791a28a34e131bb04924f279ea4d15422bb75b788b28dcc818807a134575bb770523e7b0e55be5c7d4539653dc0cfd6acc7a06af203b747d409070dfe8cfc1fcaa61e1dd67183a35f9ff00b757ff000ae868e7b162ff00c45717fa2da69b2c51ac56e414752727008e7f3acc0fd8638ebcd5e1e1bd671ff206beff00c057ff000a72f86f5aeda2df67febd5ffc2a6c81ea67f9a3d4734e05981209c0eb815a7ff08f6ba130348d4777722d9ffc2a5b5d235d80e1f45be9531ca9b671fd2a5ad344163d1b5cc43f072ce58999275b6b73953839dca73fad7936dbcbe99e56324b211f33b3649c71d49af57d5d6eae7e1c2d845a7ddfda0450a88beccfb86181c74ec057096fa1eb21028d1b522c7b790db4fe952db4b445c96a613da5dabed3192719e39a8be756c11823f0aebbfb2fc408cb8d12e80c6369b7723f953c786f599637ce8d22a9e4ee81cb0fa7150aa4baa1729cb4577736ac19640b9e71d6afd9ebb7525ec313cb9df228000c77a7c9e1fd603944d22f4ae71bbecaff00e1500d0f5b49959347be0c872ac2d5f823f0abf67196ad0599ece23668a2db8c0403ad15e56f3f8e6420f91ab8006005b665e3f05a2af90bb9f4b69d696ec7512d6f113fda131e5075f979ad7b48214042448a38e8a07734515d022ec0aaa1b000cfa0a9a8a2800a28a2800a28a2800a28a2800a28a2800a28a2803fffd9, '2013-06-20', '2013-06-20'),
(65, 'asdasda', 'sadadasda', 'sdfsdfs', '<p>sdasdasd</p>\r\n', 28, '', '2013-06-20', '2013-06-20'),
(66, NULL, NULL, NULL, NULL, NULL, '', '2013-06-20', '2013-06-20'),
(67, 'asda', 'asdasdas', 'asda', '<p><em>sdasdasda</em></p>\r\n', 21, '', '2013-06-20', '2013-06-20'),
(68, 'asda', 'asda', 'dasda', '<p>asd</p>\r\n', 31, '', '2013-06-20', '2013-06-20'),
(69, 'sad', 'asd', 'asdsa', '<p>asdasd</p>\r\n', 21, '', '2013-06-20', '2013-06-20'),
(70, 'sad', 'asd', 'asdsa', '<p>asdasd</p>\r\n', 21, '', '2013-06-20', '2013-06-20'),
(71, 'sad', 'asd', 'asdsa', '<p>asdasd</p>\r\n', 21, '', '2013-06-20', '2013-06-20'),
(72, 'sad', 'asd', 'asdsa', '<p>asdasd</p>\r\n', 21, '', '2013-06-20', '2013-06-20'),
(73, 'dsfs', 'sdfsdf', 'asdasd', '<p>sdfsfsd</p>\r\n', 21, '', '2013-06-20', '2013-06-20'),
(79, 'title', 'opop', 'examp', '<p>erw</p>\r\n', 21, '', '2013-06-21', '2013-06-21'),
(80, 'title', 'opop', 'examp', '<p>erw</p>\r\n', 21, '', '2013-06-21', '2013-06-21'),
(81, 'title', 'opop', 'examp', '<p>erw</p>\r\n', 21, '', '2013-06-21', '2013-06-21'),
(82, 'title', 'opop', 'examp', '<p>erw</p>\r\n', 21, '', '2013-06-21', '2013-06-21'),
(106, 'edwe', 'edwedw', 'ququ2', '<p>wedwdwe</p>\r\n', 21, '', '2013-06-21', '2013-06-21'),
(107, 'sadas', 'sadadas', 'ququ3', '<p>sadadasd</p>\r\n', 21, '', '2013-06-21', '2013-06-21'),
(108, 'sadas', 'sadadas', 'Маленький принц', '<p><em><strong>The Little Prince</strong></em>&nbsp;(<a href="http://en.wikipedia.org/wiki/French_language">French</a>:&nbsp;<em><strong>Le Petit Prince</strong></em>;&nbsp;<small><a href="http://en.wikipedia.org/wiki/French_language">French</a>&nbsp;pronunciation:&nbsp;​</small><a href="http://en.wikipedia.org/wiki/Help:IPA_for_French">[lə.pə.ti&#39;pʁɛ̃s]</a>), first published in 1943, is a&nbsp;<a href="http://en.wikipedia.org/wiki/Novella">novella</a>&nbsp;and the most famous work of the French aristocrat, writer, poet and pioneering aviator&nbsp;<a href="http://en.wikipedia.org/wiki/Antoine_de_Saint-Exup%C3%A9ry">Antoine de Saint-Exup&eacute;ry</a>&nbsp;(1900&ndash;1944).</p>\r\n\r\n<p>The novella is both the most read and most translated book in the French language, and was voted the best book of the 20th century in France. Translated into more than 250 languages and dialects, as well as braille,<a href="http://en.wikipedia.org/wiki/The_Little_Prince#cite_note-NYTimes-2005.04.03-5">[3]</a><a href="http://en.wikipedia.org/wiki/The_Little_Prince#cite_note-Peak-2011.03-6">[4]</a>&nbsp;and selling over a million copies per year with sales totalling more than 140 million copies worldwide, it has become&nbsp;<a href="http://en.wikipedia.org/wiki/List_of_best-selling_books">one of the best-selling books</a>&nbsp;ever published.<a href="http://en.wikipedia.org/wiki/The_Little_Prince#cite_note-TimesTribune-2012.05.03-7">[5]</a><a href="http://en.wikipedia.org/wiki/The_Little_Prince#cite_note-NYTimes-2000.05.09-8">[6]</a><a href="http://en.wikipedia.org/wiki/The_Little_Prince#cite_note-Goding-1972-9">[7]</a><a href="http://en.wikipedia.org/wiki/The_Little_Prince#cite_note-11">[Note 3]</a></p>\r\n\r\n<p>Saint-Exup&eacute;ry, a laureate of several of France&#39;s highest literary awards and a reserve military pilot at the start of the&nbsp;<a href="http://en.wikipedia.org/wiki/Second_World_War">Second World War</a>, wrote and illustrated the manuscript while exiled in the United States after the&nbsp;<a href="http://en.wikipedia.org/wiki/Battle_of_France">Fall of France</a>. He had travelled there on a personal mission to persuade its government to quickly enter the war against&nbsp;<a href="http://en.wikipedia.org/wiki/Nazi_Germany">Nazi Germany</a>. In the midst of personal upheavals and failing health he produced almost half of the writings he would be remembered for, including a tender tale of loneliness, friendship, love and loss, in the form of a young prince fallen to Earth.<a href="http://en.wikipedia.org/wiki/The_Little_Prince#cite_note-NYTimes-1993.05.30-12">[9]</a></p>\r\n\r\n<p>An earlier memoir by the author recounted his aviation experiences in&nbsp;<a href="http://en.wikipedia.org/wiki/Tarfaya">Tarfaya</a>&nbsp;a small town in the&nbsp;<a href="http://en.wikipedia.org/wiki/Sahara">Sahara</a>&nbsp;and he is thought to have drawn on those same experiences for use as plot elements in&nbsp;<em>The Little Prince</em>. Since first being published the novella has been adapted to various media over the decades, including&nbsp;<a href="http://en.wikipedia.org/wiki/Audio_recording">audio recordings</a>,&nbsp;<a href="http://en.wikipedia.org/wiki/Theatre">stage</a>,&nbsp;<a href="http://en.wikipedia.org/wiki/Movie_theater">screen</a>,&nbsp;<a href="http://en.wikipedia.org/wiki/Ballet">ballet</a>, and&nbsp;<a href="http://en.wikipedia.org/wiki/Opera">operatic</a>&nbsp;works.<a href="http://en.wikipedia.org/wiki/The_Little_Prince#cite_note-NYTimes-2005.04.03-5">[3]</a><a href="http://en.wikipedia.org/wiki/The_Little_Prince#cite_note-Statesman-2010.01.14-13">[10]</a><a href="http://en.wikipedia.org/wiki/The_Little_Prince#cite_note-MumbaiTheatreGuide-14">[11]</a></p>\r\n', 21, 0xffd8ffe000104a46494600010100000100010000fffe003e43524541544f523a2067642d6a7065672076312e3020287573696e6720494a47204a50454720763830292c2064656661756c74207175616c6974790affdb004300080606070605080707070909080a0c140d0c0b0b0c1912130f141d1a1f1e1d1a1c1c20242e2720222c231c1c2837292c30313434341f27393d38323c2e333432ffdb0043010909090c0b0c180d0d1832211c213232323232323232323232323232323232323232323232323232323232323232323232323232323232323232323232323232ffc0001108004d006403012200021101031101ffc4001f0000010501010101010100000000000000000102030405060708090a0bffc400b5100002010303020403050504040000017d01020300041105122131410613516107227114328191a1082342b1c11552d1f02433627282090a161718191a25262728292a3435363738393a434445464748494a535455565758595a636465666768696a737475767778797a838485868788898a92939495969798999aa2a3a4a5a6a7a8a9aab2b3b4b5b6b7b8b9bac2c3c4c5c6c7c8c9cad2d3d4d5d6d7d8d9dae1e2e3e4e5e6e7e8e9eaf1f2f3f4f5f6f7f8f9faffc4001f0100030101010101010101010000000000000102030405060708090a0bffc400b51100020102040403040705040400010277000102031104052131061241510761711322328108144291a1b1c109233352f0156272d10a162434e125f11718191a262728292a35363738393a434445464748494a535455565758595a636465666768696a737475767778797a82838485868788898a92939495969798999aa2a3a4a5a6a7a8a9aab2b3b4b5b6b7b8b9bac2c3c4c5c6c7c8c9cad2d3d4d5d6d7d8d9dae2e3e4e5e6e7e8e9eaf2f3f4f5f6f7f8f9faffda000c03010002110311003f00eb628f8c53f4e42a6443d8d65784751fed2d295647dd3c1f239ee7d0fe55bb6e9b2f1c13d79a69dd5c13bab905d5b9b5985f44a7038914771eb5af0149a25914e430c8ac7bed6b475cdb4faac11b30e81b3c7e15c8cfaf4697261b1d42658533b5c057070473c1ce39fd295edb0eccf4c094fd99af39b5f1a5ec0a7324774146edbb4a311f43c7e19a864f8a9a92b4823d011953a9337ff5bf4aab824d9e99e5d529507da1cf702bce13e334b1cc3ed1a2a18fb849b0c3f435bba5fc46d0759ba11133dac92602f9c9c127dc67f5c5170b337ef34d8aef4f65954127906b16c3c3f751292f74fb73f28f415d43dc5b3c4a23b88997d55c115347e548b88dd5f1d769cd1caaf725a47392e99394216720d729a9a6b3a5dc79a733c44e38af499621e959f736e2442ac3229b8dc4d1c536bf0c5b56646572324628abba969114d765b60e8074a2b3b485ef181e06bf16fe2716e7e54bc84ae3d5d791fa66b4bc41e3bb8d1b55914582c91a1da370dbb87d777f4ae274ebe6b6d46ca6071e44eaf9039c679fd2bd935ed2e1beb12e96b6d24e7ee99932b9f7c5453d9a6461aa7344f9f75dd61b55d4a4b98e236d1b9ff54ac485aa4b753420324d9f519e6bd8c7c28b016d737fa85e0693cb670b1461234e3ae075c7a6457934ba5e21dfe5b64b00ac1b23e95add1d495ca92ea97331f2a13b59b258e78faff3a853539a06564bb998a1ce76fcb9fcff00a56dd878645cdbc9279a77818000e9f8f7acf9b48d634d596178a3f2981059c0600631919e86ab4ea166598752b5bfde6e5824db7201c00f9ef9f5ab767258594ad25d4a0a05c6d0c54fb631deb3b4ff000e4f7f241005daacc4798d81f5ce4f0056bf8c3c033f86adeceed264bab29c03ba2943638f5f438383d2b2f690e6e5bea69c92e5b8d3e2accd249046e23dbb4c864cb7d4e3a669f6fe2d31dca1324b1a01b5993ef63ebd6b16cf4d7bc8267b6b778d1000fbf04aaf18c9c0ee2aacb67708fb4a71ea39ad1f998f31f42f833c57a66b5a7ada417170f710ae58dcb06661ebbbbfe3cd743301b49af0bf08698a15ded752686e9b1b57a135e8515c78834b8916e905cc67a95ea2a154e863ed137a1ba60f318b7bd14905f47242ac41527a834555cd0e5bc41e048ee63373a58f2e453b9a1cfde1ed5df801ec97fdd155a2356cc91c76f2492b2a468a59998e0000724d16d6e4c29c60db8adccff115f5b5af84eecdc4a104d198132d8dccc3000ff3d8d7944d109e116f1b65065ba63271d7b71fe7d6a1f1178ac788f578d2324585b6e36f19ff00968791b8fb9c703afe3d6bd9ea1b2ec857c337236b74e3821ba13e9d3b8fa25257b1d0a365736749b2786159260c62c9dadd327dbfcfad4fbaca6c412b448d29088b23719f7c54897b03da4464b88599430f27d3df04e79f71dbf3a7771466612795b81e739271d875e9d0feb5728a6b41c27cb2bd8589268efd6d6eb49b9b780138915c48ae3182481ce0e7debb1f155bdb8f0ee90b246bf36e455030a46063fae3eb58fa2ea0915d2a4c43dbb9c3b39cec3ebf4fe95a5e25bcb7d464b6b54977456ab8124632858e0939fa71f8579f0a2dd5bcba7dc7656ab0705ca73496034ed3a58636c46f9c46c3d7ae3fc2b2e6f046a9b7cd58f82338ef5d65b5bdbca563925dd820800fbf7fc7f2eb5bd7d7d7365090f0165c6320576548ab6a7955e319ad4f268b47d52c2e23b98e162d13678aeee4f18ac714066521b1f30f435a70deda4f68ea8ca24c1241eb9af2bd52e9bedd3249d439c563ac36672463ec767a33d213c436170a24de0668af2c8da465ca49819a2abda9a7b53dee16ae13e2bf89fec3a5c5a25bb7efeec6f9b07a460f03f123f207d6bab8afe04650d2004f4af00f126ad3ebde20bbbe9c11b9c845feea8e00fcab73ad10db5c6f27080f18391dbfc7fc2b4e105f23706503e7c7381ea7db27deb3ad86db64552b92c490c7aff9e6b5acb319531961229e63e7818e769fe99e6b2695ce88b762fd9cdf66625c80ac4067e83b7f10e9e9f88aebec66105ba4126312101c7cbf29fa6707a74041f638c0e4a259259415dc1b18009e1877032307af6fa63bd76be19d2e6d5446be5661cf61f2e3b654f51d3ee9f97b7a5694ef7d089dada969ec6dd5649e357ef802363bbaf52149ebedf95548a37b7cbda12792a54a8c127a28e7249f4fc4e319ae8f59b4b66d3240aa582311b8846e01c7f1023ea79c73c570d35da4502ac254b03ca46b9c8e33d71c73c9c01e98ce6b493b111d4d4875d582781d542a971e61dd91cfa7f8fd3ad74e75fd3aea7584caa491d09af35bad36fef3499b58de668d25c4a54b1207f7b9e7f1a6d8adadcdcc51cb3b42e3a37bd734a72b98576e12b23d0353d1eda5469a2f91fd57bd705e20f0cde0ff00494f986326bb681aea088432b8922ecfeb52dc3ab4454f4db8a6e2a44b829c6ccf1fb7826746c03c31145756b6d0a3ca06397268acb90ca387d0e9f5ad4974cd02f2f02af991c644648fe23c0fd4d785a924b3724ff5af4af1edd48be1e8e31c092619fc01af39c7fa379993cb631d8574b677246ef87aca39eca49e760aa091f39c2b707f8bb1e4f5e0d5b810880928ce89f2bb40c241839e71938ff3d33577c290f991416f0cd35bc927ca6589c0ea5ba82391c74ad98f49826ba985e626bb8c809751af94ddfa85e0f4ebd6938df62e2ec64592b73244e1971cb2b607e8320fb1c8f435d3e85a8fd8c16023dd9caee5c1638ce78e18f7ced27e95cd596b11de6a4ba78b796291884f396e0e076fbb8feb5a5a3da4b2d85ddd09d638e10db9234c17c67be70338ea066945d9e812d51d16ada929b531aa30604ba05665233c91818e473d46703eef35c3dedd199cc09313216c804363f05009fc4e3e95d3cffe9de1e8af65246e0ceb1285288338da3209eddf39ac3ba82eed4dac42ee378ae1c058ded9088c9efc8e7afb55547dc50d0e8bc3d2be9852ce49913cecab032e37b608c29c6491e8075ebd0d727ad848dede78b237a027ea3bd6fd9b3e9dabdbb4253cd8c482598c637c8107453d107d07e7543c6d121d5cdb443cb8e39240075e8c456738fb88e6c4ae646e693a84979a65b7984ee1c55ad4662206553cb715ccf876fe495840c06d886062b4ee2e5daf5633f740cd28bd0715a22cc3636e912865cb7734545e7b7a51577451ffd9, '2013-07-01', '2013-06-21');

-- --------------------------------------------------------

--
-- Структура таблицы `articles_tags`
--

CREATE TABLE IF NOT EXISTS `articles_tags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tags_id` int(11) NOT NULL,
  `articles_id` int(11) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `articles_tags`
--

INSERT INTO `articles_tags` (`id`, `tags_id`, `articles_id`, `created_at`, `updated_at`) VALUES
(1, 11, 108, '2013-06-25', '2013-06-25'),
(2, 17, 108, '2013-06-25', '2013-06-25'),
(3, 18, 65, '2013-07-03', '2013-07-03');

-- --------------------------------------------------------

--
-- Структура таблицы `blocks`
--

CREATE TABLE IF NOT EXISTS `blocks` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `url` varchar(128) NOT NULL,
  `block` text NOT NULL,
  `updated_at` date NOT NULL,
  `created_at` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=87 ;

--
-- Дамп данных таблицы `blocks`
--

INSERT INTO `blocks` (`id`, `url`, `block`, `updated_at`, `created_at`) VALUES
(84, 'hehe', '<p>hoho</p>\n', '2013-06-11', '2013-06-11'),
(85, 'oe', '<p>oeoe</p>\n', '2013-06-11', '2013-06-11'),
(86, 'qu', '<p>rere</p>\n', '2013-06-11', '2013-06-11');

-- --------------------------------------------------------

--
-- Структура таблицы `catalog_images`
--

CREATE TABLE IF NOT EXISTS `catalog_images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_product` int(20) NOT NULL,
  `id_image` int(20) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=8 ;

--
-- Дамп данных таблицы `catalog_images`
--

INSERT INTO `catalog_images` (`id`, `id_product`, `id_image`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2013-07-18', '2013-07-18'),
(2, 2, 2, '2013-07-18', '2013-07-18'),
(3, 3, 3, '2013-07-18', '2013-07-18'),
(4, 4, 4, '2013-07-18', '2013-07-18'),
(5, 5, 5, '2013-07-18', '2013-07-18'),
(6, 6, 6, '2013-07-18', '2013-07-18'),
(7, 7, 7, '2013-07-19', '2013-07-19');

-- --------------------------------------------------------

--
-- Структура таблицы `catalog_options`
--

CREATE TABLE IF NOT EXISTS `catalog_options` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `option_name` tinytext,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Дамп данных таблицы `catalog_options`
--

INSERT INTO `catalog_options` (`id`, `option_name`, `created_at`, `updated_at`) VALUES
(1, 'Opt1', '2013-07-18', '2013-07-18'),
(2, 'Opt2', '2013-07-18', '2013-07-18'),
(3, '', '2013-07-18', '2013-07-18'),
(4, 'Opt12', '2013-07-18', '2013-07-18'),
(5, 'OpTion_Index', '2013-07-18', '2013-07-18'),
(6, 'eteterte', '2013-07-18', '2013-07-18');

-- --------------------------------------------------------

--
-- Структура таблицы `catalog_options_values`
--

CREATE TABLE IF NOT EXISTS `catalog_options_values` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_product` int(11) DEFAULT NULL,
  `id_option` int(11) DEFAULT NULL,
  `value` text,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Дамп данных таблицы `catalog_options_values`
--

INSERT INTO `catalog_options_values` (`id`, `id_product`, `id_option`, `value`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Val1', '2013-07-18', '2013-07-18'),
(2, 1, 2, 'Val2', '2013-07-18', '2013-07-18'),
(3, 2, 1, 'Value2', '2013-07-18', '2013-07-18'),
(4, 2, 3, '', '2013-07-18', '2013-07-18'),
(5, 3, 4, '123', '2013-07-18', '2013-07-18'),
(6, 5, 5, 'OptionValue', '2013-07-18', '2013-07-18'),
(7, 6, 6, 'retertertertert', '2013-07-18', '2013-07-18');

-- --------------------------------------------------------

--
-- Структура таблицы `catalog_products`
--

CREATE TABLE IF NOT EXISTS `catalog_products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` tinytext,
  `title` tinytext,
  `description` text,
  `content` text,
  `price` int(11) DEFAULT NULL,
  `id_category` int(11) DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Дамп данных таблицы `catalog_products`
--

INSERT INTO `catalog_products` (`id`, `name`, `title`, `description`, `content`, `price`, `id_category`, `created_at`, `updated_at`) VALUES
(1, 'produkt_1', 'tit', 'desc', 'Opisanie TexT TexT TexT TexT TexT TexT TexT TexT TexT TexT TexT TexT ', 1000000, 45, '2013-07-18', '2013-07-18'),
(2, 'Product2', 'tit', 'desc', 'Opisanie TexT TexT TexT TexT TexT TexT TexT TexT TexT TexT TexT TexT ', 125000000, 45, '2013-07-18', '2013-07-18'),
(3, 'Product3', 'TitL', 'DesC', 'Opisanie TexT TexT TexT TexT TexT TexT TexT TexT TexT TexT TexT TexT  123', 180000, 45, '2013-07-18', '2013-07-18'),
(4, 'Product4', 'qqqwww', 'wwwqqq', 'ConTeNT ConTeNT ConTeNT ConTeNT ConTeNT', 0, 45, '2013-07-18', '2013-07-18'),
(5, 'Product5', 'Tit', 'Desc', 'Cont', 105555, 45, '2013-07-18', '2013-07-19'),
(6, 'prod1', 'ertete', 'ertertertr', 'ertete', 12333, 44, '2013-07-18', '2013-07-18'),
(7, 'Prod 12223', 'Tit', 'DesC', 'Content', 123333, 36, '2013-07-19', '2013-07-19');

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT NULL,
  `name_category` text,
  `for_unit` int(10) NOT NULL DEFAULT '1',
  `updated_at` date NOT NULL,
  `created_at` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=123 ;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`id`, `parent_id`, `name_category`, `for_unit`, `updated_at`, `created_at`) VALUES
(21, NULL, 'Категория1', 1, '2013-07-12', '2013-05-08'),
(22, NULL, 'Категория 2', 1, '2013-05-08', '2013-05-08'),
(28, 21, 'Подкатегория', 1, '2013-05-08', '2013-05-08'),
(30, 21, 'Еще одна подкатегория', 1, '2013-05-08', '2013-05-08'),
(31, 21, 'И еще одна подкатегория', 1, '2013-05-08', '2013-05-08'),
(32, 31, 'Второй уровень вложенности', 1, '2013-05-08', '2013-05-08'),
(34, 23, 'Ля ля ля1', 1, '2013-05-13', '2013-05-13'),
(35, 23, 'Ля ля ля', 1, '2013-05-13', '2013-05-13'),
(36, NULL, 'alea jacta est1', 2, '2013-07-12', '2013-05-28'),
(43, NULL, 'TmpCat', 2, '2013-07-12', '2013-07-12'),
(45, NULL, 'Каталог Прикольных Товаров', 2, '2013-07-18', '2013-07-18');

-- --------------------------------------------------------

--
-- Структура таблицы `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `articles_id` int(11) NOT NULL,
  `name` tinytext NOT NULL,
  `email` tinytext NOT NULL,
  `text` text NOT NULL,
  `check` int(1) NOT NULL,
  `updated_at` date NOT NULL,
  `created_at` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Дамп данных таблицы `comments`
--

INSERT INTO `comments` (`id`, `articles_id`, `name`, `email`, `text`, `check`, `updated_at`, `created_at`) VALUES
(1, 108, 'Oleg', 'o.nagovsky@gmail.com', 'oeoe', 0, '2013-06-25', '2013-06-25'),
(2, 108, 'asd', 'asd', 'asdasdasd', 0, '2013-06-26', '2013-06-26'),
(3, 108, 'Oleole', 'o.nagovsky@gmail.com', 'dsfsdf', 0, '2013-06-26', '2013-06-26'),
(4, 108, 'qwedqwd', 'dwqd', 'qwdqwd', 0, '2013-06-26', '2013-06-26'),
(5, 108, 'dasda', 'o.nagovsky@gmail.com', 'dasda', 0, '2013-07-03', '2013-06-26');

-- --------------------------------------------------------

--
-- Структура таблицы `images`
--

CREATE TABLE IF NOT EXISTS `images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` tinytext CHARACTER SET utf8 COLLATE utf8_bin,
  `title` tinytext CHARACTER SET utf8 COLLATE utf8_bin,
  `description` text CHARACTER SET utf8 COLLATE utf8_bin,
  `header` tinytext CHARACTER SET utf8 COLLATE utf8_bin,
  `image` tinytext CHARACTER SET utf8 COLLATE utf8_bin,
  `preview` tinytext CHARACTER SET utf8 COLLATE utf8_bin,
  `content` text CHARACTER SET utf8 COLLATE utf8_bin,
  `id_album` int(11) DEFAULT NULL,
  `updated_at` date NOT NULL,
  `created_at` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Дамп данных таблицы `images`
--

INSERT INTO `images` (`id`, `name`, `title`, `description`, `header`, `image`, `preview`, `content`, `id_album`, `updated_at`, `created_at`) VALUES
(1, NULL, NULL, NULL, NULL, '137414291653_ava.png', 'small_137414291653_ava.png', NULL, NULL, '2013-07-18', '2013-07-18'),
(2, NULL, NULL, NULL, NULL, '1374142985579_wp4.jpg', 'small_1374142985579_wp4.jpg', NULL, NULL, '2013-07-18', '2013-07-18'),
(3, NULL, NULL, NULL, NULL, '1374143103249_wp9.jpg', 'small_1374143103249_wp9.jpg', NULL, NULL, '2013-07-18', '2013-07-18'),
(4, NULL, NULL, NULL, NULL, '1374143144413_Wallpapers-of-Warhammer-40000-Dark-Millennium-Online.jpg', 'small_1374143144413_Wallpapers-of-Warhammer-40000-Dark-Millennium-Online.jpg', NULL, NULL, '2013-07-18', '2013-07-18'),
(5, NULL, NULL, NULL, NULL, '1374143204854_Ubuntu_wallpaper.jpg', 'small_1374143204854_Ubuntu_wallpaper.jpg', NULL, NULL, '2013-07-18', '2013-07-18'),
(6, NULL, NULL, NULL, NULL, '1374151194978_wp3.jpg', 'small_1374151194978_wp3.jpg', NULL, NULL, '2013-07-18', '2013-07-18'),
(7, NULL, NULL, NULL, NULL, '1374229705293_wp1.png', 'small_1374229705293_wp1.png', NULL, NULL, '2013-07-19', '2013-07-19');

-- --------------------------------------------------------

--
-- Структура таблицы `tags`
--

CREATE TABLE IF NOT EXISTS `tags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` tinytext NOT NULL,
  `updated_at` date NOT NULL,
  `created_at` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- Дамп данных таблицы `tags`
--

INSERT INTO `tags` (`id`, `title`, `updated_at`, `created_at`) VALUES
(10, 'ququ', '2013-06-21', '2013-06-21'),
(11, 'gav gav', '2013-06-21', '2013-06-21'),
(12, 'my', '2013-06-21', '2013-06-21'),
(13, 'tre', '2013-06-24', '2013-06-24'),
(14, 'op', '2013-06-24', '2013-06-24'),
(15, 'теги', '2013-06-24', '2013-06-24'),
(16, 'myau', '2013-06-24', '2013-06-24'),
(17, 'pes', '2013-06-25', '2013-06-25'),
(18, 'rere', '2013-07-03', '2013-07-03');

-- --------------------------------------------------------

--
-- Структура таблицы `units`
--

CREATE TABLE IF NOT EXISTS `units` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `units`
--

INSERT INTO `units` (`id`, `name`) VALUES
(1, 'categories'),
(2, 'catalog'),
(3, 'gallery');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL,
  `email` tinytext NOT NULL,
  `password` tinytext NOT NULL,
  `updated_at` date NOT NULL,
  `created_at` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `updated_at`, `created_at`) VALUES
(1, 'admin', '$2a$08$zFx3OPldDQe90d7440Fc8euKGVBeHWbVcYoK9bL8gF8G/nQs6UeOy', '2013-07-03', '2013-07-03');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
