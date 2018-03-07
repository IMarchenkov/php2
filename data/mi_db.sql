-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Фев 25 2018 г., 00:28
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
  `DATA` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `BASKET`
--

INSERT INTO `BASKET` (`id`, `basket_id`, `user_id`, `item_id`, `quantity`, `DATA`) VALUES
(1, 788568115, 0, 10, 1, '2018-02-12 00:21:47'),
(2, 417422485, 0, 10, 1, '2018-02-12 00:21:48'),
(3, 543188476, 0, 9, 1, '2018-02-12 00:21:49'),
(4, 272457885, 0, 9, 1, '2018-02-12 00:21:49'),
(5, 498831176, 0, 11, 1, '2018-02-12 00:21:57'),
(6, 315661621, 0, 11, 1, '2018-02-12 00:21:58'),
(7, 377597045, 0, 10, 1, '2018-02-12 00:21:59'),
(8, 952648925, 0, 11, 1, '2018-02-12 00:22:04'),
(9, 697299194, 0, 11, 1, '2018-02-12 00:22:26'),
(10, 407122802, 0, 11, 1, '2018-02-12 00:22:27'),
(11, 675820922, 0, 11, 1, '2018-02-12 00:22:29'),
(12, 263586425, 0, 9, 1, '2018-02-12 00:22:34'),
(13, 176986694, 0, 10, 1, '2018-02-12 00:22:38'),
(14, 730560302, 0, 10, 1, '2018-02-12 00:22:51'),
(15, 730560302, 0, 7, 1, '2018-02-12 00:24:13'),
(16, 883407592, 0, 11, 2, '2018-02-12 00:27:20'),
(17, 883407592, 0, 10, 1, '2018-02-12 00:27:21'),
(18, 576037597, 0, 12, 2, '2018-02-12 00:28:49'),
(19, 576037597, 0, 11, 1, '2018-02-12 00:28:50'),
(20, 576037597, 0, 10, 1, '2018-02-12 00:31:53');

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
(5, 'Контакты', 'contacts', NULL, 'Наши контакты', 1),
(7, 'Галерея', 'gallery', NULL, 'Галерея фотографий', 1),
(8, 'Заказы', 'orders', NULL, 'Все заказы', 1),
(9, 'Изображение', 'image', NULL, 'Страница изображения', 0);

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
(4, 'Каталог', 'full_catalog', 'Все предметы каталога', 3, 'full_catalog', 500, NULL, 'items', '(ACTIVE, Y)', '', '', ''),
(5, 'Заказы', 'orders', 'Ваши заказы', 8, 'orders', 500, NULL, 'ORDERS', '', '', '', ''),
(6, 'Доставка', 'delivery', 'Варианты доставки', 8, 'delivery', 500, NULL, 'DELIVERY', '', '', '', ''),
(7, 'Оплата', 'payment', 'Варианты оплаты', 8, 'payment', 500, NULL, 'PAYMENT', '', '', '', ''),
(8, 'Крупное изображение', 'image', 'Отдельное изображение', 9, 'image', 500, NULL, 'IMAGES', 'detail', '', '', '');

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
(25, 'spark', 'images/spark_1517164164.png', 319391, 2, 0, 1, '2018-02-24 23:18:41', 'admin'),
(26, 'mavic', 'images/mavic_1517164183.jpg', 38880, 2, 0, 1, '2018-02-24 23:11:17', 'admin'),
(27, 'phantom', 'images/phantom_1517164190.jpg', 36415, 7, 0, 1, '2018-02-24 23:18:36', 'admin'),
(28, 'Inspire', 'images/Inspire_1517164200.png', 411416, 7, 0, 1, '2018-02-24 23:36:54', 'admin'),
(29, 'goggles', 'images/goggles_1517164212.png', 395694, 3, 0, 1, '2018-02-25 00:20:55', 'admin'),
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
(40, 'layer-30', 'images/layer-30.png', 577902, 0, 0, 0, '2018-02-24 23:19:25', 'admin');

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
  `STATUS` varchar(255) DEFAULT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `ORDERS`
--

INSERT INTO `ORDERS` (`id`, `basket_id`, `payment_id`, `delivery_id`, `DATE`, `STATUS`, `user_id`) VALUES
(1, 0, 1, 1, '2018-02-12 00:24:28', 'Оформлен', 0);

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
  `prim` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `Users`
--

INSERT INTO `Users` (`id_user`, `login`, `pass`, `prim`) VALUES
(2, 'admin', '$2y$10$N9Sb5bvUPPkK7wxTi78Lp.qloB4l4eE26U.apxaTHRmS2WhlRdOCG', ''),
(3, 'user', '$2y$10$mBPas3uNzVeY0AYq4MWu7es7BfLAmI6j4r8fjmkaNRGeupNax69ZO', '');

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
(3, 97, '1518258496.6547283406082', '2018-02-10 13:28:16', '123456789'),
(3, 102, '1518293327.4981161097059', '2018-02-10 23:08:47', '123456789'),
(3, 103, '1518293914.8465518694099', '2018-02-10 23:18:34', '123456789'),
(3, 105, '1518294353.0304442018643', '2018-02-10 23:25:53', '123456789'),
(3, 106, '1518374413.31811305611618', '2018-02-11 21:40:13', '123456789'),
(3, 107, '1518374432.50031117357105', '2018-02-11 21:40:32', '123456789'),
(3, 108, '1518376194.72281185758521', '2018-02-11 22:09:54', '123456789'),
(3, 109, '1518376212.5111995817068', '2018-02-11 22:10:12', '123456789'),
(3, 111, '1518377656.669493992472', '2018-02-11 22:34:16', '123456789'),
(3, 112, '1518377664.29781304888643', '2018-02-11 22:34:24', '123456789'),
(3, 113, '1518377805.4358661521717', '2018-02-11 22:36:45', '123456789'),
(3, 114, '1518377828.8487748961460', '2018-02-11 22:37:08', '123456789'),
(3, 119, '1518382645.6264544359692', '2018-02-11 23:57:25', '123456789'),
(3, 120, '1518384670.8335551268114', '2018-02-12 00:31:10', '123456789'),
(3, 121, '1518384680.9499926130364', '2018-02-12 00:31:20', '123456789');

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
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `BASKET`
--
ALTER TABLE `BASKET`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT для таблицы `CALLBACK`
--
ALTER TABLE `CALLBACK`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT для таблицы `CATEGORIES`
--
ALTER TABLE `CATEGORIES`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблицы `CONTENT`
--
ALTER TABLE `CONTENT`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `DELIVERY`
--
ALTER TABLE `DELIVERY`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `IMAGES`
--
ALTER TABLE `IMAGES`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT для таблицы `ITEMS`
--
ALTER TABLE `ITEMS`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT для таблицы `ORDERS`
--
ALTER TABLE `ORDERS`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `PAYMENT`
--
ALTER TABLE `PAYMENT`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `Users`
--
ALTER TABLE `Users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `users_auth`
--
ALTER TABLE `users_auth`
  MODIFY `id_user_session` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
