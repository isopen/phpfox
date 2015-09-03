-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Сен 03 2015 г., 04:05
-- Версия сервера: 5.6.17
-- Версия PHP: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `phpfox`
--

-- --------------------------------------------------------

--
-- Структура таблицы `phpfox_reviews`
--

CREATE TABLE IF NOT EXISTS `phpfox_reviews` (
  `reviews_id` int(11) NOT NULL AUTO_INCREMENT,
  `reviews_user` int(11) NOT NULL,
  `reviews_text` text NOT NULL,
  `reviews_date` int(11) NOT NULL,
  PRIMARY KEY (`reviews_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=33 ;

--
-- Дамп данных таблицы `phpfox_reviews`
--

INSERT INTO `phpfox_reviews` (`reviews_id`, `reviews_user`, `reviews_text`, `reviews_date`) VALUES
(1, 1, 'Ð¾Ñ‹Ð²Ð°Ð´Ð»Ð¾Ð°Ñ‹Ð²Ð´Ð»Ñ‹Ð²Ð°Ð¾', 1441208842),
(2, 1, 'Ð»Ð°Ð²Ñ‹Ð¾Ð»Ð´Ð°Ð²Ð¾Ð°Ñ‹Ð²Ð´Ð»Ð°Ñ‹Ð²Ð¾Ð´Ð»Ð°Ñ‹Ð²Ð¾Ð°Ñ‹Ð²Ð´Ð»Ð°Ñ‹Ð¾Ð²Ð´Ð»Ð°Ñ‹Ð²Ð¾Ñ‹Ð²Ð°Ð´Ð»Ð¾Ñ‹Ð°Ð²Ð´Ð°Ñ‹Ð²Ð»Ð¾Ð°Ñ‹Ð²Ð´Ð»Ñ‹Ð²Ð°Ð¾Ð´Ð°Ñ‹Ð²Ð»Ð¾Ñ‹Ð²Ð°Ð´Ð»Ñ‹Ð°Ð²Ð¾Ñ‹Ð°Ð²Ð´Ð»Ñ‹Ð°Ð²Ð¾Ð´Ð»Ñ‹Ð°Ð²Ð¾Ð°Ñ‹Ð²Ð´Ð»Ñ‹Ð²Ð°Ð¾Ð´Ñ‹Ð°Ð²Ð»Ð¾Ñ‹Ð°Ð²Ð´Ð»Ñ‹Ð°Ð²Ð¾Ð´Ð»Ñ‹Ð²Ð°Ð¾Ñ‹Ð°Ð²Ð´Ð»Ñ‹Ð°Ð²Ð¾Ñ‹Ð´Ð°Ð²Ð»Ð¾Ñ‹Ð°Ð²Ð´Ð»Ñ‹Ð°Ð²Ð¾Ð´Ð°Ñ‹Ð²Ð»Ð¾Ñ‹Ð°Ð²Ð´Ð»Ñ‹Ð°Ð²Ð¾Ð´Ñ‹Ð°Ð²Ð»Ð¾Ð°Ð²Ñ‹Ð´Ð»Ñ‹Ð²Ð°Ð¾Ð´Ñ‹Ð°Ð²Ð¾Ñ‹Ð´Ð²Ð°Ð¾Ñ‹Ð°Ð²Ð´Ð»Ð°Ð²Ñ‹Ð¾Ð´Ñ‹Ð°Ð²Ð»Ð¾Ñ‹Ð°Ð²Ð´Ð»Ñ‹Ð°Ð¾Ð´Ñ‹Ð°Ð²Ð¾Ñ‹Ð°Ð²Ð»Ñ‹Ð°Ð²Ð¾Ñ‹Ð´Ð²Ð»Ð¾', 1441208903),
(3, 1, 'Ð»Ð¾Ð´Ð»Ð¾Ð´Ð»Ð¾Ð´Ð»Ð¾Ð´Ð»Ð¾Ð´Ð»Ð¾Ð´Ð»Ð¾Ð´Ð»Ð¾Ð´Ð»Ð¾Ð´Ð»Ð¾Ð´Ð»Ð¾Ð´Ð»Ð¾Ð´Ð»Ð¾Ð´Ð»Ð¾Ð´Ð»Ð¾Ð´Ð»Ð¾Ð´Ð»Ð¾Ð´Ð»Ð¾Ð´Ð»Ð¾Ð´Ð»Ð¾Ð´Ð»Ð¾Ð´Ð»Ð¾Ð´Ð»Ð¾Ð´Ð»Ð¾Ð´Ð»Ð¾Ð´Ð»Ð¾Ð´Ð»Ð¾', 1441209103),
(4, 1, 'jkdfsjldfskjfdslkfdsjldfskjdfslksdjflsdfkjsdflksdfjlskdfjlsdfkjdsflksdfjlsdfkjsdflksdfjlsdfk', 1441210381),
(5, 1, 'dsffdsfsd', 1441211044),
(6, 1, 'dsffdsfds', 1441211129),
(7, 1, 'dsfdfs', 1441212416),
(8, 1, 'Ð²Ñ‹Ñ„Ñ‹Ð²Ñ„Ñ‹Ñ„Ð²Ñ‹Ñ„Ð²Ñ‹Ñ„Ð²', 1441212542),
(9, 1, 'kjlkjlkjljlkjlkjljlkjlkjdlkjfdlksfdjlfksdjsdlfkdjfslkdfjdlfskdfsjlskfdjsdflkjsdflksdfjfsdklsdfjsdlfkjdfslfdksjlsfdkjfsdlksdfjlsdfkjsdflkfdjlfsdkjsdflksfdjlksfdjfsldkjsfdlkfsdjlsdfkjsfdlkfjlfsdkjsfdlkfsdjlsfdkjsfdlksdfjlfsdkjsfdkldfsjlsdfkjsdflksdfjlsfdkjsfdlksfdjlsdfkjsdflksdfj', 1441212655),
(10, 1, 'dlsfkjsdlksfdjsdfksdfjlskfdjsfdlksfdjlsdfkjsdflksfdjsfdlksjfdlskfdjsfdlksdfjlsdfkjsdflksjdlsdjsfdlkjsfdlfsdkjsfdlksjljsfdlsjfdlsfdjsfdlkjsfdlsfdjsdkjsfdlsdkjlsdfkjsdlksdjlfdskjsdflksdjlsfdjsdflkdsjlsfdjsdflksdjflskdfj', 1441212688),
(11, 1, 'Ð»Ð°Ð¾Ð²Ð»Ð´Ð²Ð°Ñ‹Ð°Ñ‹Ð²Ð´Ð»Ð°Ð²Ñ‹', 1441213205),
(12, 1, 'Ñ‘12Ñ‘1', 1441213259),
(13, 1, '8798798', 1441213276),
(14, 1, 'jhkjhkjhkjhkjhkjhkjhkjhkjhkhkjhkjhkjkk', 1441213746),
(15, 1, 'jkhkjhkjhkj', 1441213786),
(16, 1, 'kjkhkjhkjhkjhkj', 1441214161),
(17, 1, 'dsfdssdffsd', 1441214447),
(18, 1, 'dsfsdfdfsdfsfsd', 1441214501),
(19, 1, 'ewrrwererewrewrew', 1441214806),
(20, 1, 'dfsfdsfsd', 1441214896),
(21, 1, 'dfsfdsfsd', 1441214900),
(22, 1, 'dfsfdsfsd', 1441214902),
(23, 1, 'fsfdsfsdfsd', 1441214954),
(24, 1, 'fdsdfsdsffsdsdfsdffsdsdfsdfsdsdffds', 1441214975),
(25, 1, 'jhkjhkjhkjhkjhkjhkjhjhkjhkjhkjhkjhkjhkjhkhkjhkj', 1441215243),
(26, 1, 'fwerewwerrewerrwewerwerwewerewerwer', 1441215332),
(27, 1, 'dfsfdsfdsfsd', 1441215608),
(28, 1, 'fd;ldsf;lfdslkfsdjdsflkjdfslksdfjlkdfsjldsfkjsdflkdsfjldskfjdfslkjdfslksdfjldsfkjsdflkjsdflsdfkjsdflkjdslksdfjlfsdkjdflskjdfslkdfsjldfskjdfslkdsjflksdf', 1441217525),
(29, 1, 'jkjlkjlkjlkjlkjlkjlk', 1441218017),
(30, 1, 'kdsjfslk', 1441218242),
(31, 3, 'sklfdfsdkjdfslksdfjldskfjlfdkjdfslkdfsjlkdfsjldfskjsfldkjdfslksdjlkjldfsjdsflkjdsflkd', 1441218320),
(32, 1, 'kjhkjhkjhkjhkhk', 1441223190);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
