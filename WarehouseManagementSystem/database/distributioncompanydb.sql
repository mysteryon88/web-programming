-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Май 11 2023 г., 22:58
-- Версия сервера: 5.7.33-log
-- Версия PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `distributioncompanydb`
--
CREATE DATABASE IF NOT EXISTS `distributioncompanydb` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `distributioncompanydb`;

-- --------------------------------------------------------

--
-- Структура таблицы `audit_log`
--

CREATE TABLE `audit_log` (
  `id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `action` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `table_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `record_id` int(11) NOT NULL,
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `audit_log`
--

INSERT INTO `audit_log` (`id`, `employee_id`, `action`, `table_name`, `record_id`, `timestamp`) VALUES
(1, 1, 'INSERT', 'suppliers', 1, '2023-05-10 22:35:14'),
(2, 1, 'UPDATE', 'suppliers', 1, '2023-05-10 22:39:46'),
(3, 9, 'INSERT', 'suppliers', 2, '2023-05-11 01:27:39'),
(4, 9, 'INSERT', 'products', 1, '2023-05-11 01:33:50'),
(5, 9, 'INSERT', 'products', 2, '2023-05-11 01:34:18'),
(6, 9, 'UPDATE', 'products', 2, '2023-05-11 01:34:28'),
(7, 3, 'UPDATE', 'products', 2, '2023-05-11 01:41:27'),
(8, 1, 'UPDATE', 'products', 2, '2023-05-11 01:41:33'),
(9, 9, 'UPDATE', 'products', 1, '2023-05-11 01:41:42'),
(10, 1, 'DELETE', 'products', 2, '2023-05-11 01:51:44'),
(11, 9, 'DELETE', 'products', 1, '2023-05-11 01:52:46'),
(12, 9, 'INSERT', 'products', 3, '2023-05-11 01:53:04'),
(13, 9, 'INSERT', 'products', 4, '2023-05-11 01:53:10'),
(14, 1, 'UPDATE', 'products', 4, '2023-05-11 01:53:41'),
(15, 1, 'UPDATE', 'products', 3, '2023-05-11 01:53:44'),
(16, 1, 'DELETE', 'products', 3, '2023-05-11 01:54:27'),
(17, 9, 'UPDATE', 'products', 4, '2023-05-11 01:55:39'),
(18, 9, 'DELETE', 'products', 4, '2023-05-11 01:55:39'),
(19, 9, 'INSERT', 'products', 5, '2023-05-11 01:56:19'),
(20, 1, 'UPDATE', 'products', 5, '2023-05-11 01:56:30'),
(21, 9, 'UPDATE', 'products', 5, '2023-05-11 01:56:42'),
(22, 9, 'INSERT', 'products', 6, '2023-05-11 02:07:28'),
(23, 9, 'UPDATE', 'products', 5, '2023-05-11 02:16:54'),
(24, 2, 'INSERT', 'clients', 1, '2023-05-11 02:21:01'),
(25, 2, 'INSERT', 'clients', 2, '2023-05-11 02:21:33'),
(26, 1, 'INSERT', 'clients', 3, '2023-05-11 02:21:33'),
(27, 3, 'INSERT', 'clients', 4, '2023-05-11 02:21:33'),
(28, 8, 'INSERT', 'clients', 5, '2023-05-11 02:21:33'),
(29, 3, 'INSERT', 'clients', 6, '2023-05-11 02:21:52'),
(30, 9, 'UPDATE', 'suppliers', 2, '2023-05-11 03:01:21'),
(31, 9, 'UPDATE', 'suppliers', 2, '2023-05-11 03:01:27'),
(32, 1, 'UPDATE', 'suppliers', 1, '2023-05-11 03:01:29'),
(33, 9, 'UPDATE', 'products', 5, '2023-05-11 03:15:20'),
(34, 9, 'UPDATE', 'products', 5, '2023-05-11 03:15:23'),
(35, 2, 'UPDATE', 'orders', 1, '2023-05-11 03:37:02'),
(36, 2, 'UPDATE', 'orders', 1, '2023-05-11 03:37:51'),
(37, 2, 'UPDATE', 'orders', 1, '2023-05-11 03:56:03'),
(38, 1, 'UPDATE', 'orders', 2, '2023-05-11 04:21:39'),
(39, 1, 'UPDATE', 'orders', 2, '2023-05-11 04:21:47'),
(40, 1, 'UPDATE', 'orders', 3, '2023-05-11 04:27:43'),
(41, 1, 'UPDATE', 'orders', 3, '2023-05-11 04:27:56'),
(42, 1, 'UPDATE', 'orders', 3, '2023-05-11 04:29:02'),
(43, 1, 'UPDATE', 'orders', 2, '2023-05-11 04:29:05'),
(44, 1, 'UPDATE', 'orders', 3, '2023-05-11 04:29:07'),
(45, 2, 'UPDATE', 'orders', 1, '2023-05-11 04:29:12'),
(46, 1, 'UPDATE', 'orders', 2, '2023-05-11 04:29:23'),
(47, 1, 'UPDATE', 'orders', 3, '2023-05-11 04:29:26'),
(48, 2, 'UPDATE', 'orders', 1, '2023-05-11 04:29:28'),
(49, 1, 'UPDATE', 'orders', 2, '2023-05-11 04:30:31'),
(50, 1, 'UPDATE', 'orders', 4, '2023-05-11 04:30:35'),
(51, 1, 'UPDATE', 'orders', 2, '2023-05-11 04:31:45'),
(52, 2, 'UPDATE', 'orders', 1, '2023-05-11 04:31:49'),
(53, 1, 'UPDATE', 'orders', 2, '2023-05-11 04:31:57'),
(54, 1, 'UPDATE', 'orders', 3, '2023-05-11 04:31:57'),
(55, 1, 'UPDATE', 'orders', 3, '2023-05-11 04:33:02'),
(56, 1, 'UPDATE', 'orders', 2, '2023-05-11 04:33:05'),
(57, 1, 'UPDATE', 'orders', 2, '2023-05-11 04:33:15'),
(58, 1, 'UPDATE', 'orders', 3, '2023-05-11 04:33:15'),
(59, 1, 'UPDATE', 'orders', 3, '2023-05-11 04:34:04'),
(60, 1, 'UPDATE', 'orders', 2, '2023-05-11 04:34:07'),
(61, 1, 'UPDATE', 'orders', 2, '2023-05-11 04:34:15'),
(62, 1, 'UPDATE', 'orders', 3, '2023-05-11 04:34:15'),
(63, 1, 'UPDATE', 'orders', 4, '2023-05-11 04:36:03'),
(64, 1, 'UPDATE', 'orders', 2, '2023-05-11 04:37:04'),
(65, 1, 'UPDATE', 'orders', 3, '2023-05-11 04:37:06'),
(66, 1, 'UPDATE', 'orders', 4, '2023-05-11 04:37:09'),
(67, 1, 'UPDATE', 'orders', 2, '2023-05-11 04:37:19'),
(68, 1, 'UPDATE', 'orders', 3, '2023-05-11 04:38:40'),
(69, 1, 'UPDATE', 'orders', 4, '2023-05-11 04:39:23'),
(70, 1, 'UPDATE', 'orders', 3, '2023-05-11 04:39:42'),
(71, 1, 'UPDATE', 'orders', 2, '2023-05-11 04:39:45'),
(72, 1, 'UPDATE', 'orders', 2, '2023-05-11 18:31:53'),
(73, 9, 'INSERT', 'suppliers', 3, '2023-05-11 19:37:13'),
(74, 9, 'INSERT', 'products', 7, '2023-05-11 19:39:45');

-- --------------------------------------------------------

--
-- Структура таблицы `clients`
--

CREATE TABLE `clients` (
  `ClientID` int(11) NOT NULL,
  `ClientName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ContactInfo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `employee_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `clients`
--

INSERT INTO `clients` (`ClientID`, `ClientName`, `ContactInfo`, `employee_id`) VALUES
(1, 'Григорий', 'Инфо', 2),
(2, 'Григорий', 'Инфо', 2),
(3, 'Николай', 'Инфо', 1),
(4, 'Сергей', 'Инфо', 3),
(5, 'Ульяна', 'Инфо', 8),
(6, 'Ольга', 'Инфо', 3);

--
-- Триггеры `clients`
--
DELIMITER $$
CREATE TRIGGER `clients_delete_audit_log` AFTER DELETE ON `clients` FOR EACH ROW BEGIN
    INSERT INTO audit_log (employee_id, action, table_name, record_id)
    VALUES (OLD.employee_id, 'DELETE', 'clients', OLD.ClientID);
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `clients_insert_audit_log` AFTER INSERT ON `clients` FOR EACH ROW BEGIN
    INSERT INTO audit_log (employee_id, action, table_name, record_id)
    VALUES (NEW.employee_id, 'INSERT', 'clients', NEW.ClientID);
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `clients_update_audit_log` AFTER UPDATE ON `clients` FOR EACH ROW BEGIN
    INSERT INTO audit_log (employee_id, action, table_name, record_id)
    VALUES (NEW.employee_id, 'UPDATE', 'clients', NEW.ClientID);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Структура таблицы `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `name` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL,
  `login` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `employees`
--

INSERT INTO `employees` (`id`, `name`, `login`, `password`) VALUES
(1, 'Василий', 'vasia', '12345678'),
(2, 'Илья', 'ilia', '12345'),
(3, 'Илья', '123', '$2y$10$AOP6K23D7pw0NSKdsuGZjemW.Msja/acCu/htdff32fVn02VaAkCi'),
(8, 'asd', 'asd', '$2y$10$yQyHIa0NYNAzZgGpY8slguG41UGY.uIE5wiF.w2UmWKxGuXxbkplS'),
(9, 'qwe', 'qwe', '$2y$10$57tTaUHM361JC4yceo/JYONzNytNrtUL.hyXWGlpgUxldM628S36O');

-- --------------------------------------------------------

--
-- Структура таблицы `orderdetails`
--

CREATE TABLE `orderdetails` (
  `OrderDetailID` int(11) NOT NULL,
  `OrderID` int(11) DEFAULT NULL,
  `ProductID` int(11) DEFAULT NULL,
  `Quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `orderdetails`
--

INSERT INTO `orderdetails` (`OrderDetailID`, `OrderID`, `ProductID`, `Quantity`) VALUES
(1, 1, 6, 10),
(2, 2, 6, 5),
(3, 3, 6, 7),
(4, 4, 6, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `OrderID` int(11) NOT NULL,
  `ClientID` int(11) DEFAULT NULL,
  `OrderDate` date NOT NULL,
  `StatusID` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`OrderID`, `ClientID`, `OrderDate`, `StatusID`, `employee_id`) VALUES
(1, 2, '2023-05-09', 10, 2),
(2, 5, '2023-05-09', 10, 1),
(3, 4, '2023-05-10', 9, 1),
(4, 3, '2023-05-11', 10, 1);

--
-- Триггеры `orders`
--
DELIMITER $$
CREATE TRIGGER `orders_delete_audit_log` AFTER DELETE ON `orders` FOR EACH ROW BEGIN
    INSERT INTO audit_log (employee_id, action, table_name, record_id)
    VALUES (OLD.employee_id, 'DELETE', 'orders', OLD.OrderID);
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `orders_insert_audit_log` AFTER INSERT ON `orders` FOR EACH ROW BEGIN
    INSERT INTO audit_log (employee_id, action, table_name, record_id)
    VALUES (NEW.employee_id, 'INSERT', 'orders', NEW.OrderID);
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `orders_update_audit_log` AFTER UPDATE ON `orders` FOR EACH ROW BEGIN
    INSERT INTO audit_log (employee_id, action, table_name, record_id)
    VALUES (NEW.employee_id, 'UPDATE', 'orders', NEW.OrderID);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE `products` (
  `ProductID` int(11) NOT NULL,
  `ProductName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Price` decimal(10,2) NOT NULL,
  `SupplierID` int(11) DEFAULT NULL,
  `employee_id` int(11) NOT NULL,
  `ProductImage` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`ProductID`, `ProductName`, `Price`, `SupplierID`, `employee_id`, `ProductImage`) VALUES
(5, 'Футболка', '100.00', 2, 9, 'img/XmYeP2y4b9w.jpg'),
(6, 'Футболка', '123.00', 1, 9, 'img/XmYeP2y4b9w.jpg'),
(7, 'Колбаса', '102.00', 3, 9, 'img/kolbasa.png');

--
-- Триггеры `products`
--
DELIMITER $$
CREATE TRIGGER `products_delete_audit_log` AFTER DELETE ON `products` FOR EACH ROW BEGIN
    INSERT INTO audit_log (employee_id, action, table_name, record_id)
    VALUES (OLD.employee_id, 'DELETE', 'products', OLD.ProductID);
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `products_insert_audit_log` AFTER INSERT ON `products` FOR EACH ROW BEGIN
    INSERT INTO audit_log (employee_id, action, table_name, record_id)
    VALUES (NEW.employee_id, 'INSERT', 'products', NEW.ProductID);
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `products_update_audit_log` AFTER UPDATE ON `products` FOR EACH ROW BEGIN
    INSERT INTO audit_log (employee_id, action, table_name, record_id)
    VALUES (NEW.employee_id, 'UPDATE', 'products', NEW.ProductID);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Структура таблицы `reports`
--

CREATE TABLE `reports` (
  `ReportID` int(11) NOT NULL,
  `ReportType` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `GeneratedDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `shipments`
--

CREATE TABLE `shipments` (
  `ShipmentID` int(11) NOT NULL,
  `OrderID` int(11) DEFAULT NULL,
  `ShipmentDate` datetime NOT NULL,
  `StatusID` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `shipments`
--

INSERT INTO `shipments` (`ShipmentID`, `OrderID`, `ShipmentDate`, `StatusID`, `employee_id`) VALUES
(1, 1, '2023-05-11 00:00:00', 1, 4),
(3, 1, '2023-05-11 07:16:08', 6, 3),
(4, 1, '2023-05-11 07:21:06', 5, 9),
(5, 4, '2023-05-11 07:39:23', 1, 9),
(6, 1, '2023-05-11 07:47:35', 9, 9),
(7, 4, '2023-05-11 07:58:42', 5, 9),
(8, 4, '2023-05-11 07:58:58', 6, 9),
(9, 2, '2023-05-11 21:31:53', 1, 9),
(10, 4, '2023-05-11 21:32:28', 7, 9);

-- --------------------------------------------------------

--
-- Структура таблицы `statuses`
--

CREATE TABLE `statuses` (
  `StatusID` int(11) NOT NULL,
  `Status` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `statuses`
--

INSERT INTO `statuses` (`StatusID`, `Status`) VALUES
(1, 'Новая заявка'),
(2, 'Ожидает оплаты'),
(3, 'Оплачено'),
(4, 'Отменено'),
(5, 'Отправлено'),
(6, 'В пути'),
(7, 'Доставлено'),
(8, 'Возвращено'),
(9, 'Завершено'),
(10, 'На отгрузке');

-- --------------------------------------------------------

--
-- Структура таблицы `suppliers`
--

CREATE TABLE `suppliers` (
  `SupplierID` int(11) NOT NULL,
  `SupplierName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ContactInfo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `employee_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `suppliers`
--

INSERT INTO `suppliers` (`SupplierID`, `SupplierName`, `ContactInfo`, `employee_id`) VALUES
(1, 'H&M', 'Инфо', 1),
(2, 'Bershka', 'Инфо', 9),
(3, 'ООО \"Продуктовый мир\"', '+7 123-456-7890', 9);

--
-- Триггеры `suppliers`
--
DELIMITER $$
CREATE TRIGGER `suppliers_delete_audit_log` AFTER DELETE ON `suppliers` FOR EACH ROW BEGIN
    INSERT INTO audit_log (employee_id, action, table_name, record_id)
    VALUES (OLD.employee_id, 'DELETE', 'suppliers', OLD.SupplierID);
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `suppliers_insert_audit_log` AFTER INSERT ON `suppliers` FOR EACH ROW BEGIN
    INSERT INTO audit_log (employee_id, action, table_name, record_id)
    VALUES (NEW.employee_id, 'INSERT', 'suppliers', NEW.SupplierID);
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `suppliers_update_audit_log` AFTER UPDATE ON `suppliers` FOR EACH ROW BEGIN
    INSERT INTO audit_log (employee_id, action, table_name, record_id)
    VALUES (NEW.employee_id, 'UPDATE', 'suppliers', NEW.SupplierID);
END
$$
DELIMITER ;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `audit_log`
--
ALTER TABLE `audit_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employee_id` (`employee_id`);

--
-- Индексы таблицы `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`ClientID`),
  ADD KEY `employee_id` (`employee_id`);

--
-- Индексы таблицы `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login` (`login`);

--
-- Индексы таблицы `orderdetails`
--
ALTER TABLE `orderdetails`
  ADD PRIMARY KEY (`OrderDetailID`),
  ADD KEY `OrderID` (`OrderID`),
  ADD KEY `ProductID` (`ProductID`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`OrderID`),
  ADD KEY `ClientID` (`ClientID`),
  ADD KEY `orders_ibfk_2` (`StatusID`),
  ADD KEY `orders_ibfk_3` (`employee_id`);

--
-- Индексы таблицы `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`ProductID`),
  ADD KEY `employee_id` (`employee_id`),
  ADD KEY `products_ibfk_2` (`SupplierID`);

--
-- Индексы таблицы `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`ReportID`);

--
-- Индексы таблицы `shipments`
--
ALTER TABLE `shipments`
  ADD PRIMARY KEY (`ShipmentID`),
  ADD KEY `OrderID` (`OrderID`),
  ADD KEY `shipments_ibfk_2` (`StatusID`);

--
-- Индексы таблицы `statuses`
--
ALTER TABLE `statuses`
  ADD PRIMARY KEY (`StatusID`);

--
-- Индексы таблицы `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`SupplierID`),
  ADD KEY `employee_id` (`employee_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `audit_log`
--
ALTER TABLE `audit_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT для таблицы `clients`
--
ALTER TABLE `clients`
  MODIFY `ClientID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблицы `orderdetails`
--
ALTER TABLE `orderdetails`
  MODIFY `OrderDetailID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `OrderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `ProductID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `reports`
--
ALTER TABLE `reports`
  MODIFY `ReportID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `shipments`
--
ALTER TABLE `shipments`
  MODIFY `ShipmentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `statuses`
--
ALTER TABLE `statuses`
  MODIFY `StatusID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `SupplierID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `audit_log`
--
ALTER TABLE `audit_log`
  ADD CONSTRAINT `audit_log_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`);

--
-- Ограничения внешнего ключа таблицы `clients`
--
ALTER TABLE `clients`
  ADD CONSTRAINT `clients_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`);

--
-- Ограничения внешнего ключа таблицы `orderdetails`
--
ALTER TABLE `orderdetails`
  ADD CONSTRAINT `orderdetails_ibfk_1` FOREIGN KEY (`OrderID`) REFERENCES `orders` (`OrderID`),
  ADD CONSTRAINT `orderdetails_ibfk_2` FOREIGN KEY (`ProductID`) REFERENCES `products` (`ProductID`);

--
-- Ограничения внешнего ключа таблицы `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`ClientID`) REFERENCES `clients` (`ClientID`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`StatusID`) REFERENCES `statuses` (`StatusID`),
  ADD CONSTRAINT `orders_ibfk_3` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`);

--
-- Ограничения внешнего ключа таблицы `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`),
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`SupplierID`) REFERENCES `suppliers` (`SupplierID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `shipments`
--
ALTER TABLE `shipments`
  ADD CONSTRAINT `shipments_ibfk_1` FOREIGN KEY (`OrderID`) REFERENCES `orders` (`OrderID`),
  ADD CONSTRAINT `shipments_ibfk_2` FOREIGN KEY (`StatusID`) REFERENCES `statuses` (`StatusID`);

--
-- Ограничения внешнего ключа таблицы `suppliers`
--
ALTER TABLE `suppliers`
  ADD CONSTRAINT `suppliers_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
