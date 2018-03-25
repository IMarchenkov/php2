-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Мар 25 2018 г., 13:06
-- Версия сервера: 5.6.38
-- Версия PHP: 7.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `mi_db`
--

-- --------------------------------------------------------

--
-- Структура таблицы `BASKET`
--

CREATE TABLE `BASKET` (
  `id` int(11) NOT NULL,
  `basket_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `quantity` int(5) NOT NULL,
  `DATE` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `BASKET`
--

INSERT INTO `BASKET` (`id`, `basket_id`, `user_id`, `item_id`, `quantity`, `DATE`) VALUES
(3, 264791, 3, 7, 1, '2018-03-25 01:23:59'),
(4, 264791, 3, 8, 1, '2018-03-25 01:24:04'),
(5, 780459, 3, 6, 1, '2018-03-25 01:49:38'),
(6, 483004, 3, 6, 4, '2018-03-25 01:56:18'),
(7, 483004, 3, 7, 1, '2018-03-25 01:56:18'),
(8, 471065, 3, 6, 1, '2018-03-25 02:03:51'),
(9, 471065, 3, 7, 1, '2018-03-25 02:03:51'),
(10, 196205, 3, 5, 1, '2018-03-25 02:07:11'),
(11, 196205, 3, 7, 1, '2018-03-25 02:07:11'),
(12, 646375, 3, 6, 1, '2018-03-25 02:12:10'),
(13, 646375, 3, 7, 1, '2018-03-25 02:12:10'),
(14, 739687, 3, 6, 2, '2018-03-25 02:15:16'),
(15, 739687, 3, 7, 2, '2018-03-25 02:15:16'),
(16, 341834, 3, 7, 1, '2018-03-25 02:17:01'),
(17, 341834, 3, 6, 1, '2018-03-25 02:17:10'),
(18, 688153, 3, 6, 1, '2018-03-25 02:18:42'),
(19, 688153, 3, 7, 1, '2018-03-25 02:18:42'),
(20, 834561, 3, 6, 2, '2018-03-25 02:21:27'),
(21, 834561, 3, 7, 1, '2018-03-25 02:22:18'),
(22, 540722, 3, 6, 2, '2018-03-25 10:53:01'),
(23, 540722, 3, 7, 1, '2018-03-25 10:53:01'),
(24, 673713, 3, 7, 2, '2018-03-25 11:03:23'),
(25, 673713, 3, 5, 1, '2018-03-25 11:03:23'),
(26, 673713, 3, 10, 1, '2018-03-25 11:03:23'),
(27, 114899, 4, 5, 1, '2018-03-25 11:05:18'),
(28, 114899, 4, 6, 1, '2018-03-25 11:05:18'),
(29, 114899, 4, 7, 1, '2018-03-25 11:05:18'),
(30, 114899, 4, 8, 1, '2018-03-25 11:05:18'),
(31, 624432, 4, 6, 1, '2018-03-25 11:06:30'),
(32, 624432, 4, 7, 1, '2018-03-25 11:06:30'),
(33, 624432, 4, 8, 1, '2018-03-25 11:06:30'),
(34, 703534, 4, 11, 2, '2018-03-25 11:08:25'),
(35, 703534, 4, 12, 1, '2018-03-25 11:08:25'),
(36, 997455, 4, 9, 1, '2018-03-25 11:10:32'),
(37, 997455, 4, 11, 1, '2018-03-25 11:10:32'),
(38, 997455, 4, 12, 1, '2018-03-25 11:10:32');

-- --------------------------------------------------------

--
-- Структура таблицы `CALLBACK`
--

CREATE TABLE `CALLBACK` (
  `id` int(11) NOT NULL,
  `USER` varchar(50) NOT NULL,
  `TEXT` text NOT NULL,
  `DATA` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `CALLBACK`
--

INSERT INTO `CALLBACK` (`id`, `USER`, `TEXT`, `DATA`) VALUES
(3, 'user', 'yo!', '2018-02-10 15:55:53'),
(4, 'user', 'yo!', '2018-02-10 16:03:32'),
(6, 'user', 'Hello World!', '2018-02-10 16:04:10'),
(8, 'user', 'привет!', '2018-02-10 16:12:47'),
(9, 'user', 'чо как?!', '2018-02-10 16:13:27'),
(10, 'user', 'так норм!', '2018-02-10 16:14:03'),
(11, 'user', 'ваще отлично', '2018-02-10 16:25:09');

-- --------------------------------------------------------

--
-- Структура таблицы `CATEGORIES`
--

CREATE TABLE `CATEGORIES` (
  `id` int(11) NOT NULL,
  `NAME` varchar(255) NOT NULL,
  `CODE` varchar(255) NOT NULL,
  `PARENT_CATEGORY` int(11) DEFAULT NULL,
  `DESCRIPTION` text,
  `IS_SHOW` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `CATEGORIES`
--

INSERT INTO `CATEGORIES` (`id`, `NAME`, `CODE`, `PARENT_CATEGORY`, `DESCRIPTION`, `IS_SHOW`) VALUES
(1, 'Главная', 'main', NULL, 'Главная страница', 1),
(3, 'Каталог', 'catalog', NULL, 'Каталог товаров', 1),
(5, 'Контакты', 'contacts', NULL, 'Наши контакты', 0),
(7, 'Галерея', 'gallery', NULL, 'Галерея фотографий', 1),
(8, 'Заказы', 'orders', NULL, 'Все заказы', 0),
(9, 'Изображение', 'image', NULL, 'Страница изображения', 0),
(10, 'Товар', 'item', NULL, 'Отдельная страница товара', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `CONTENT`
--

CREATE TABLE `CONTENT` (
  `id` int(11) NOT NULL,
  `NAME` varchar(255) NOT NULL,
  `CODE` varchar(255) NOT NULL,
  `DESCRIPTION` text,
  `OWNER_ID` int(11) NOT NULL,
  `TEMPLATE` varchar(255) NOT NULL,
  `SORT` int(11) NOT NULL DEFAULT '500',
  `PLACEHOLDER_ID` varchar(255) DEFAULT NULL,
  `CONTENT_TABLE` varchar(255) NOT NULL,
  `CONTENT_FILTER` varchar(255) NOT NULL,
  `CONTENT_SORT` varchar(255) NOT NULL,
  `CONTENT_LIMIT` varchar(255) NOT NULL,
  `DETAIL_LINK` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `CONTENT`
--

INSERT INTO `CONTENT` (`id`, `NAME`, `CODE`, `DESCRIPTION`, `OWNER_ID`, `TEMPLATE`, `SORT`, `PLACEHOLDER_ID`, `CONTENT_TABLE`, `CONTENT_FILTER`, `CONTENT_SORT`, `CONTENT_LIMIT`, `DETAIL_LINK`) VALUES
(1, 'Новые шмотки', 'FEATURED_ITEMS', 'Shop for items based on what we featured in this week', 1, 'featured_items', 500, NULL, 'items', '(ACTIVE, Y)', '(DATE_CREATE, DESC)', '(0,8)', ''),
(2, 'Галерея', 'gallery', 'Галерея фотографий', 7, 'gallery', 500, NULL, 'images', '(IS_GALLERY,1)', '(VIEW,DESC)', '', 'image'),
(3, 'Отзывы', 'callback', 'Отзывы посетителей', 5, 'callback', 500, NULL, 'callback', '', '(DATA,DESC)', '', ''),
(4, 'Каталог', 'catalog', 'Все предметы каталога', 3, 'full_catalog', 500, NULL, 'items', '(ACTIVE, Y)', '', '(0,4)', 'item'),
(5, 'Заказы', 'orders', 'Ваши заказы', 8, 'orders', 500, NULL, 'ORDERS', '', '', '', ''),
(6, 'Доставка', 'delivery', 'Варианты доставки', 8, 'delivery', 500, NULL, 'DELIVERY', '', '', '', ''),
(7, 'Оплата', 'payment', 'Варианты оплаты', 8, 'payment', 500, NULL, 'PAYMENT', '', '', '', ''),
(8, 'Крупное изображение', 'image', 'Отдельное изображение', 9, 'image', 500, NULL, 'IMAGES', 'detail', '', '', ''),
(9, 'Отдельный товар', 'item', 'Отдельный товар', 10, 'detail', 500, NULL, 'ITEMS', 'detail', '', '', '');

-- --------------------------------------------------------

--
-- Структура таблицы `DELIVERY`
--

CREATE TABLE `DELIVERY` (
  `id` int(11) NOT NULL,
  `NAME` varchar(255) NOT NULL,
  `DESCRIPTION` text,
  `PRICE` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `DELIVERY`
--

INSERT INTO `DELIVERY` (`id`, `NAME`, `DESCRIPTION`, `PRICE`) VALUES
(1, 'Самовывоз', 'Самовывоз со склада', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `IMAGES`
--

CREATE TABLE `IMAGES` (
  `id` int(11) NOT NULL,
  `NAME` text NOT NULL,
  `PATH` varchar(255) NOT NULL,
  `SIZE` int(11) NOT NULL,
  `VIEW` int(11) NOT NULL DEFAULT '0',
  `RATING` int(11) NOT NULL DEFAULT '0',
  `IS_GALLERY` tinyint(1) NOT NULL DEFAULT '0',
  `DATE_CREATE` datetime NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  `user` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `IMAGES`
--

INSERT INTO `IMAGES` (`id`, `NAME`, `PATH`, `SIZE`, `VIEW`, `RATING`, `IS_GALLERY`, `DATE_CREATE`, `user`) VALUES
(25, 'spark', 'images/spark_1517164164.png', 319391, 5, 0, 1, '2018-03-01 00:14:26', 'admin'),
(26, 'mavic', 'images/mavic_1517164183.jpg', 38880, 3, 0, 1, '2018-03-01 00:01:14', 'admin'),
(27, 'phantom', 'images/phantom_1517164190.jpg', 36415, 9, 0, 1, '2018-02-26 23:06:38', 'admin'),
(28, 'Inspire', 'images/Inspire_1517164200.png', 411416, 14, 0, 1, '2018-02-25 14:12:54', 'admin'),
(29, 'goggles', 'images/goggles_1517164212.png', 395694, 6, 0, 1, '2018-03-01 00:04:58', 'admin'),
(30, 'osmo', 'images/osmo_1517164218.jpg', 46381, 1, 0, 1, '2018-01-28 21:30:27', 'admin'),
(31, 'ronin', 'images/ronin_1517164224.png', 302366, 0, 0, 1, '0000-00-00 00:00:00', 'admin'),
(32, 'layer-2', 'images/layer-2_1517864409.png', 113632, 0, 0, 0, '2018-02-06 00:02:37', 'admin'),
(33, 'layer-3', 'images/layer-3.png', 93728, 0, 0, 0, '2018-02-06 00:06:42', 'admin'),
(34, 'layer-4', 'images/layer-4.png', 95372, 0, 0, 0, '2018-02-06 00:06:48', 'admin'),
(35, 'layer-5', 'images/layer-5.png', 107641, 0, 0, 0, '2018-02-06 00:06:53', 'admin'),
(36, 'layer-6', 'images/layer-6.png', 95795, 0, 0, 0, '2018-02-06 00:06:57', 'admin'),
(37, 'layer-7', 'images/layer-7.png', 65085, 0, 0, 0, '2018-02-06 00:07:02', 'admin'),
(38, 'layer-8', 'images/layer-8.png', 63522, 0, 0, 0, '2018-02-06 00:07:07', 'admin'),
(39, 'layer-9', 'images/layer-9.png', 68453, 0, 0, 0, '2018-02-06 00:07:13', 'admin'),
(40, 'layer-30', 'images/layer-30.png', 577902, 0, 0, 0, '2018-02-24 23:19:25', 'admin'),
(41, 'kotik', 'images/kotik_1519670617.jpg', 142587, 1, 0, 1, '2018-02-26 23:06:44', ''),
(42, 'kotik2', 'images/kotik2_1519847413.jpg', 12007, 0, 0, 1, '0000-00-00 00:00:00', ''),
(43, 'kotik3', 'images/kotik3_1519853297.jpg', 23608, 0, 0, 1, '0000-00-00 00:00:00', '');

-- --------------------------------------------------------

--
-- Структура таблицы `ITEMS`
--

CREATE TABLE `ITEMS` (
  `id` int(11) NOT NULL,
  `NAME` varchar(255) NOT NULL,
  `CODE` varchar(255) NOT NULL,
  `SORT` int(11) NOT NULL DEFAULT '500',
  `CATEGORY` int(11) DEFAULT NULL,
  `IMAGES` varchar(255) NOT NULL,
  `HOT_DEAL` int(11) DEFAULT NULL,
  `PRICE` decimal(10,2) NOT NULL DEFAULT '0.00',
  `RATING` decimal(2,1) NOT NULL DEFAULT '0.0',
  `OFFER` int(11) DEFAULT NULL,
  `DATE_CREATE` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ACTIVE` varchar(255) NOT NULL DEFAULT 'Y'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `ITEMS`
--

INSERT INTO `ITEMS` (`id`, `NAME`, `CODE`, `SORT`, `CATEGORY`, `IMAGES`, `HOT_DEAL`, `PRICE`, `RATING`, `OFFER`, `DATE_CREATE`, `ACTIVE`) VALUES
(5, 'Новый Товар', 'item_1', 500, 3, '32', NULL, '52.00', '5.0', NULL, '2018-02-06 00:07:29', 'Y'),
(6, 'Новый Товар', 'item_2', 500, 3, '33', NULL, '52.00', '4.5', NULL, '2018-02-06 00:07:35', 'Y'),
(7, 'Новый Товар', 'item_3', 500, 3, '34', NULL, '52.00', '3.5', NULL, '2018-02-06 00:07:39', 'Y'),
(8, 'Новый Товар', 'item_4', 500, 3, '35', NULL, '52.00', '3.0', NULL, '2018-02-06 00:07:43', 'Y'),
(9, 'Новый Товар', 'item_5', 500, 3, '36', NULL, '52.00', '2.5', NULL, '2018-02-06 00:07:49', 'Y'),
(10, 'Новый Товар', 'item_6', 500, 3, '37', NULL, '52.00', '2.0', NULL, '2018-02-06 00:07:53', 'Y'),
(11, 'Новый Товар', 'item_7', 500, 3, '38', NULL, '52.00', '1.5', NULL, '2018-02-06 00:07:57', 'Y'),
(12, 'Новый Товар', 'item_8', 500, 3, '39', NULL, '52.00', '0.0', NULL, '2018-02-06 00:08:01', 'Y');

-- --------------------------------------------------------

--
-- Структура таблицы `ORDERS`
--

CREATE TABLE `ORDERS` (
  `id` int(11) NOT NULL,
  `basket_id` int(11) NOT NULL,
  `payment_id` int(11) NOT NULL,
  `delivery_id` int(11) NOT NULL,
  `DATE` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_id` int(11) NOT NULL,
  `sum_price` int(11) DEFAULT '0',
  `status_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `ORDERS`
--

INSERT INTO `ORDERS` (`id`, `basket_id`, `payment_id`, `delivery_id`, `DATE`, `user_id`, `sum_price`, `status_id`) VALUES
(8, 834561, 1, 1, '2018-03-25 12:48:55', 3, 156, 1),
(9, 540722, 1, 1, '2018-03-25 10:53:01', 3, 156, 0),
(10, 673713, 1, 1, '2018-03-25 11:03:23', 3, 208, 0),
(11, 114899, 1, 1, '2018-03-25 11:05:18', 4, 208, 0),
(12, 624432, 1, 1, '2018-03-25 11:06:30', 4, 156, 0),
(13, 703534, 1, 1, '2018-03-25 11:08:25', 4, 156, 0),
(14, 997455, 1, 1, '2018-03-25 11:10:32', 4, 156, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `ORDER_STATUS`
--

CREATE TABLE `ORDER_STATUS` (
  `id` int(11) NOT NULL,
  `name` varchar(55) DEFAULT NULL,
  `description` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `ORDER_STATUS`
--

INSERT INTO `ORDER_STATUS` (`id`, `name`, `description`) VALUES
(1, 'Заказ принят', 'Заказ принят'),
(2, 'Заказ оплачен', 'Заказ оплачен'),
(3, 'Заказ отменен', 'Заказ отменен');

-- --------------------------------------------------------

--
-- Структура таблицы `PAYMENT`
--

CREATE TABLE `PAYMENT` (
  `id` int(11) NOT NULL,
  `NAME` varchar(255) NOT NULL,
  `DESCRIPTION` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `PAYMENT`
--

INSERT INTO `PAYMENT` (`id`, `NAME`, `DESCRIPTION`) VALUES
(1, 'Наличные', 'Оплата наличными при получение товара.');

-- --------------------------------------------------------

--
-- Структура таблицы `Users`
--

CREATE TABLE `Users` (
  `id_user` int(11) NOT NULL,
  `login` varchar(50) NOT NULL,
  `pass` varchar(500) NOT NULL,
  `role` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `Users`
--

INSERT INTO `Users` (`id_user`, `login`, `pass`, `role`) VALUES
(2, 'admin', '$2y$10$N9Sb5bvUPPkK7wxTi78Lp.qloB4l4eE26U.apxaTHRmS2WhlRdOCG', 'admin'),
(3, 'user', '$2y$10$mBPas3uNzVeY0AYq4MWu7es7BfLAmI6j4r8fjmkaNRGeupNax69ZO', 'user'),
(4, 'newbie', '$2y$10$s4slOxsEH1/YBMRMaOPL0.umzEIiuRFvFhASewEVL3Fon0kcKLI3C', 'user');

-- --------------------------------------------------------

--
-- Структура таблицы `users_auth`
--

CREATE TABLE `users_auth` (
  `id_user` int(11) NOT NULL,
  `id_user_session` int(11) NOT NULL,
  `hash_cookie` varchar(500) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `prim` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users_auth`
--

INSERT INTO `users_auth` (`id_user`, `id_user_session`, `hash_cookie`, `date`, `prim`) VALUES
(2, 7, '20089060498486', '2018-03-06 00:41:37', '123456789'),
(2, 8, '66049564783478', '2018-03-18 18:56:42', '123456789'),
(3, 10, '1.3402378365503E+14', '2018-03-18 19:15:09', '123456789'),
(4, 12, '1.2921821077601E+14', '2018-03-18 20:52:43', '123456789'),
(2, 14, '1.2157052204957E+14', '2018-03-24 20:59:57', '123456789'),
(2, 16, '1.4057029581595E+14', '2018-03-24 21:35:02', '123456789'),
(2, 17, '1.1584828597276E+14', '2018-03-24 21:35:26', '123456789'),
(2, 18, '54318723106435', '2018-03-24 21:35:36', '123456789'),
(2, 19, '46779151172968', '2018-03-24 21:37:00', '123456789'),
(3, 23, '1.0664756203824E+14', '2018-03-25 00:41:45', '123456789'),
(3, 24, '1.0165564054152E+14', '2018-03-25 00:42:06', '123456789'),
(3, 26, '1.0569331739287E+14', '2018-03-25 00:42:43', '123456789'),
(3, 29, '1.0934929693758E+14', '2018-03-25 01:54:24', '123456789'),
(2, 33, '78096614437194', '2018-03-25 11:11:15', '123456789'),
(2, 34, '1.356695314038E+14', '2018-03-25 11:12:33', '123456789'),
(2, 35, '1.0617079889768E+14', '2018-03-25 11:13:28', '123456789'),
(2, 36, '1.4379835731807E+14', '2018-03-25 11:13:57', '123456789'),
(2, 37, '40691275464011', '2018-03-25 11:15:19', '123456789'),
(2, 38, '1.3571977240875E+14', '2018-03-25 11:15:34', '123456789'),
(2, 39, '92663362506342', '2018-03-25 11:15:46', '123456789'),
(2, 40, '1.2704333443078E+14', '2018-03-25 12:13:12', '123456789'),
(2, 41, '1.4321730191336E+14', '2018-03-25 12:13:22', '123456789'),
(2, 42, '19910401253161', '2018-03-25 12:13:33', '123456789');

-- --------------------------------------------------------

--
-- Структура таблицы `VISITED_PAGES`
--

CREATE TABLE `VISITED_PAGES` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `link` varchar(255) NOT NULL,
  `DATE_CREATE` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `BASKET`
--
ALTER TABLE `BASKET`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `CALLBACK`
--
ALTER TABLE `CALLBACK`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `CATEGORIES`
--
ALTER TABLE `CATEGORIES`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `CONTENT`
--
ALTER TABLE `CONTENT`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `DELIVERY`
--
ALTER TABLE `DELIVERY`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `IMAGES`
--
ALTER TABLE `IMAGES`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `ITEMS`
--
ALTER TABLE `ITEMS`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `ORDERS`
--
ALTER TABLE `ORDERS`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `ORDER_STATUS`
--
ALTER TABLE `ORDER_STATUS`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `PAYMENT`
--
ALTER TABLE `PAYMENT`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`id_user`);

--
-- Индексы таблицы `users_auth`
--
ALTER TABLE `users_auth`
  ADD PRIMARY KEY (`id_user_session`),
  ADD KEY `id_user` (`id_user`);

--
-- Индексы таблицы `VISITED_PAGES`
--
ALTER TABLE `VISITED_PAGES`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `BASKET`
--
ALTER TABLE `BASKET`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT для таблицы `CALLBACK`
--
ALTER TABLE `CALLBACK`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT для таблицы `CATEGORIES`
--
ALTER TABLE `CATEGORIES`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `CONTENT`
--
ALTER TABLE `CONTENT`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблицы `DELIVERY`
--
ALTER TABLE `DELIVERY`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `IMAGES`
--
ALTER TABLE `IMAGES`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT для таблицы `ITEMS`
--
ALTER TABLE `ITEMS`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT для таблицы `ORDERS`
--
ALTER TABLE `ORDERS`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT для таблицы `ORDER_STATUS`
--
ALTER TABLE `ORDER_STATUS`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `PAYMENT`
--
ALTER TABLE `PAYMENT`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `Users`
--
ALTER TABLE `Users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `users_auth`
--
ALTER TABLE `users_auth`
  MODIFY `id_user_session` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
