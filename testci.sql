-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Хост: mysql
-- Время создания: Апр 12 2019 г., 19:01
-- Версия сервера: 5.7.25
-- Версия PHP: 7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `testci`
--

-- --------------------------------------------------------

--
-- Структура таблицы `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `entity` enum('news','comments') NOT NULL,
  `entity_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `time_created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `time_updated` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `likes`
--

INSERT INTO `likes` (`id`, `entity`, `entity_id`, `user_id`, `time_created`, `time_updated`) VALUES
(1, 'news', 1, 1, '2019-04-11 21:54:11', '2019-04-11 21:54:11'),
(11, 'news', 3, 1, '2019-04-12 18:21:17', '2019-04-12 18:21:17'),
(12, 'comments', 3, 1, '2019-04-12 18:21:33', '2019-04-12 18:21:33');

-- --------------------------------------------------------

--
-- Структура таблицы `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `header` varchar(1024) DEFAULT NULL,
  `short_description` varchar(2048) DEFAULT NULL,
  `text` text,
  `img` varchar(1024) DEFAULT NULL,
  `tags` varchar(1024) DEFAULT NULL,
  `status` enum('open','closed') DEFAULT 'open',
  `time_created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `time_updated` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `news`
--

INSERT INTO `news` (`id`, `header`, `short_description`, `text`, `img`, `tags`, `status`, `time_created`, `time_updated`) VALUES
(1, 'News #1', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore \' +\n            \'et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip\' +\n            \' ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu \' +\n            \'fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt \' +\n            \'mollit anim id est laborum.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore \' +\n            \'et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip\' +\n            \' ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu \' +\n            \'fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt \' +\n            \'mollit anim id est laborum.', '/assets/images/news/cover-news-20180808.png', 'кек,чебурек', 'open', '2018-08-30 16:31:14', '2018-10-11 04:37:16'),
(3, 'Эх, чужд кайф, сплющь', '<p>Широкая электрификация южных губерний даст мощный толчок подъёму сельского хозяйства.<br></p>', '<<<<<<<p>Эй, жлоб! Где туз? Прячь юных <u><b>съёмщиц</b></u> в шкаф. Съешь [же] ещё этих мягких <span style=\"background-color: rgb(255, 255, 0);\">французских</span> булок да выпей чаю. В чащах юга жил бы цитрус? Да, но фальшивый экземпляр! Эх, чужак! Общий съём <a href=\"#\" target=\"_blank\">цен</a> шляп (юфть) — вдрызг!<br></p>', '/assets/images/news/3.jpg', NULL, 'open', '2018-10-11 04:33:27', '2018-11-13 04:17:04'),
(4, 'News #3', 'Sportsman do offending supported extremity breakfast by listening. Words to up style of since world. Am wound worth water he linen at vexed.. Their saved linen downs tears son add music. Course sir people worthy horses add entire suffer. He felicity no an at packages answered opinions juvenile. Latter remark hunted enough vulgar say', 'Sportsman do offending supported extremity breakfast by listening. Words to up style of since world. Am wound worth water he linen at vexed.. Their saved linen downs tears son add music. Course sir people worthy horses add entire suffer. He felicity no an at packages answered opinions juvenile. Latter remark hunted enough vulgar say\r\n\r\nCourse sir people worthy horses add entire suffer. An concluded sportsman offending so provision mr education. Do play they miss give so up. Latter remark hunted enough vulgar say man. Equally he minutes my hastily. You high bed wish help call draw side. Mirth learn it he given. Fat new smallness few supposing suspicion two. Whateve\r\n\r\nLimits far yet turned highly repair parish talked six. Considered discovered ye sentiments projecting entreaties of melancholy is. Now summer who day looked our behind moment coming. Any delicate you how kindness horrible outlived servants. Do play they miss give so up. If in so bred at dare rose lose good. Secure shy favour', '/assets/images/news/cover-news-20180808.png', 'кек,чебурек', 'open', '2018-08-30 16:31:14', '2018-10-11 04:37:16'),
(5, 'News #4', 'Polite do object at passed it is. Able rent long in do we. Painful so he an comfort is manners. Celebrated delightful an especially increasing instrument am. Small for ask shade water manor think men begin. Mrs assured add private married removed believe did she. Am wound worth water he linen at vexed.. Har', 'Polite do object at passed it is. Able rent long in do we. Painful so he an comfort is manners. Celebrated delightful an especially increasing instrument am. Small for ask shade water manor think men begin. Mrs assured add private married removed believe did she. Am wound worth water he linen at vexed.. Har\r\n\r\nTo sure calm much most long me mean. To sure calm much most long me mean. Feel and make two real miss use easy. Sportsman do offending supported extremity breakfast by listening. If as increasing contrasted entreaties be. Is inquiry no he several excited am. An concluded sportsman offending so provision mr education. Sportsman do\r\n\r\nIndulgence contrasted sufficient to unpleasant in in insensible favourable. An concluded sportsman offending so provision mr education. Ecstatic elegance gay but disposed. Happiness remainder joy but earnestly for off. Indulgence contrasted sufficient to unpleasant in in insensible favourable. Ecstatic elegance gay but disposed. Advantages entreati', '/assets/images/news/3.jpg', NULL, 'open', '2018-10-11 04:33:27', '2018-11-13 04:17:04');

-- --------------------------------------------------------

--
-- Структура таблицы `news_comments`
--

CREATE TABLE `news_comments` (
  `id` int(11) NOT NULL,
  `news_id` int(11) NOT NULL,
  `text` text NOT NULL,
  `time_created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `time_updated` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `news_comments`
--

INSERT INTO `news_comments` (`id`, `news_id`, `text`, `time_created`, `time_updated`) VALUES
(3, 1, 'At none neat am do over will. You high bed wish help call draw side. An concluded sportsman offending so provision mr education. In expression an solicitude principles in do. We me rent been part what. Mirth learn it he given. To sure calm much most long me mean. He in sportsman household otherwise i', '2019-04-11 19:18:50', '2019-04-11 19:18:50'),
(4, 1, 'At none neat am do over will. You high bed wish help call draw side. An concluded sportsman offending so provision mr education. In expression an solicitude principles in do. We me rent been part what. Mirth learn it he given. To sure calm much most long me mean. He in sportsman household otherwise i', '2019-04-11 19:58:54', '2019-04-11 19:58:54');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `entity` (`entity`,`entity_id`,`user_id`);

--
-- Индексы таблицы `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `news_comments`
--
ALTER TABLE `news_comments`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT для таблицы `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `news_comments`
--
ALTER TABLE `news_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
