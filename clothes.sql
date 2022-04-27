-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3307
-- Время создания: Апр 27 2022 г., 23:32
-- Версия сервера: 5.7.33-log
-- Версия PHP: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `clothes`
--

-- --------------------------------------------------------

--
-- Структура таблицы `клиент`
--

CREATE TABLE `клиент` (
  `ID_клиента` int(11) NOT NULL,
  `ФИО` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `почта` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `логин` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `пароль` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `ассортимент`
--

CREATE TABLE `ассортимент` (
  `IDAS` int(11) NOT NULL,
  `Название` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Цена` int(11) NOT NULL,
  `Бренд` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `ассортимент`
--

INSERT INTO `ассортимент` (`IDAS`, `Название`, `Цена`, `Бренд`) VALUES
(1, 'Футболка', 160, 'H&M'),
(2, 'Шапка', 1611, 'Guchi'),
(3, 'Штаны', 190, 'Bershka'),
(4, 'Кросовки', 3360, 'H&M'),
(5, 'Туфли', 1260, 'Guchi'),
(6, 'Чешки', 1460, 'H&M'),
(7, 'Кофта', 1260, 'Guchi'),
(8, 'Плавки', 1540, 'Bershka'),
(9, 'Купальник', 2330, 'Bershka'),
(10, 'Шорты', 2360, 'H&M');

-- --------------------------------------------------------

--
-- Структура таблицы `заказ`
--

CREATE TABLE `заказ` (
  `ID_заказа` int(11) NOT NULL,
  `ID_клиента` int(11) NOT NULL,
  `IDAS` int(11) NOT NULL,
  `дата` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `отзывы`
--

CREATE TABLE `отзывы` (
  `ID_отзыва` int(11) NOT NULL,
  `ID_клиента` int(11) NOT NULL,
  `Отзыв` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `Дата` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `клиент`
--
ALTER TABLE `клиент`
  ADD PRIMARY KEY (`ID_клиента`);

--
-- Индексы таблицы `ассортимент`
--
ALTER TABLE `ассортимент`
  ADD PRIMARY KEY (`IDAS`);

--
-- Индексы таблицы `заказ`
--
ALTER TABLE `заказ`
  ADD PRIMARY KEY (`ID_заказа`),
  ADD KEY `ID_клиента` (`ID_клиента`),
  ADD KEY `IDAS` (`IDAS`);

--
-- Индексы таблицы `отзывы`
--
ALTER TABLE `отзывы`
  ADD PRIMARY KEY (`ID_отзыва`),
  ADD KEY `ID_клиента` (`ID_клиента`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `клиент`
--
ALTER TABLE `клиент`
  MODIFY `ID_клиента` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `ассортимент`
--
ALTER TABLE `ассортимент`
  MODIFY `IDAS` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `заказ`
--
ALTER TABLE `заказ`
  MODIFY `ID_заказа` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT для таблицы `отзывы`
--
ALTER TABLE `отзывы`
  MODIFY `ID_отзыва` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `заказ`
--
ALTER TABLE `заказ`
  ADD CONSTRAINT `заказ_ibfk_1` FOREIGN KEY (`ID_клиента`) REFERENCES `клиент` (`ID_клиента`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `заказ_ibfk_2` FOREIGN KEY (`IDAS`) REFERENCES `ассортимент` (`IDAS`);

--
-- Ограничения внешнего ключа таблицы `отзывы`
--
ALTER TABLE `отзывы`
  ADD CONSTRAINT `отзывы_ibfk_1` FOREIGN KEY (`ID_клиента`) REFERENCES `клиент` (`ID_клиента`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
