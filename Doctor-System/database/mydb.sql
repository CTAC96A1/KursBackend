-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3380
-- Время создания: Дек 28 2022 г., 18:02
-- Версия сервера: 8.0.30
-- Версия PHP: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `mydb`
--

-- --------------------------------------------------------

--
-- Структура таблицы `appointment`
--

CREATE TABLE `appointment` (
  `Id` int NOT NULL,
  `patientIc` bigint NOT NULL,
  `scheduleId` int NOT NULL,
  `status` varchar(30) NOT NULL DEFAULT 'В процессе'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `appointment`
--

INSERT INTO `appointment` (`Id`, `patientIc`, `scheduleId`, `status`) VALUES
(1, 10, 1, 'Завершено');

-- --------------------------------------------------------

--
-- Структура таблицы `doctor`
--

CREATE TABLE `doctor` (
  `doctorId` int NOT NULL,
  `icDoctor` bigint NOT NULL,
  `password` varchar(30) NOT NULL,
  `Name` varchar(30) NOT NULL,
  `Famil` varchar(30) NOT NULL,
  `Address` varchar(100) NOT NULL,
  `Phone` varchar(15) DEFAULT NULL,
  `Email` varchar(45) DEFAULT NULL,
  `DR` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `doctor`
--

INSERT INTO `doctor` (`doctorId`, `icDoctor`, `password`, `Name`, `Famil`, `Address`, `Phone`, `Email`, `DR`) VALUES
(1, 123456789, '123', 'Иванs', 'Ивановs', 'Каширское шоссе, дом 37 кабинет 6s', '93856412361s', 'Iv@gmail.comыs', '1989-07-18'),
(2, 123456788, '12345', 'Петр', 'Петров', 'Улица кошкина', '9872631426', 'Pt@mail.ru', '1977-11-07');

-- --------------------------------------------------------

--
-- Структура таблицы `doctorschedule`
--

CREATE TABLE `doctorschedule` (
  `scheduleId` int NOT NULL,
  `doctorIc` bigint NOT NULL,
  `Date` date NOT NULL,
  `Day` varchar(15) NOT NULL,
  `Time` time NOT NULL,
  `End` time NOT NULL,
  `Avaible` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `doctorschedule`
--

INSERT INTO `doctorschedule` (`scheduleId`, `doctorIc`, `Date`, `Day`, `Time`, `End`, `Avaible`) VALUES
(1, 123456789, '2022-12-13', 'Воскрес', '09:00:00', '10:00:00', 'Недоступно'),
(2, 123456788, '2022-12-13', 'Воскрес', '12:00:00', '13:00:00', 'Доступно'),
(4, 123456789, '2022-12-16', 'Понедельник', '03:20:00', '05:17:00', 'Недоступно'),
(5, 123456789, '2022-12-16', 'Понедельник', '02:00:00', '03:00:00', 'Доступно');

-- --------------------------------------------------------

--
-- Структура таблицы `patient`
--

CREATE TABLE `patient` (
  `icPatient` bigint NOT NULL,
  `password` varchar(30) NOT NULL,
  `Name` varchar(30) NOT NULL,
  `Famil` varchar(30) NOT NULL,
  `DR` date NOT NULL,
  `Gender` varchar(10) NOT NULL,
  `Address` varchar(100) DEFAULT NULL,
  `Phone` varchar(15) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `patient`
--

INSERT INTO `patient` (`icPatient`, `password`, `Name`, `Famil`, `DR`, `Gender`, `Address`, `Phone`, `Email`) VALUES
(1, '1', '12', '2', '1948-02-02', 'Мужчина', '2', '2', '2'),
(10, '123', 'Алексей', 'Алексеев', '1991-05-04', 'Мужчина', 'Москва', '9163456889', 'Al@mail.ru');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `Id_UNIQUE` (`Id`),
  ADD UNIQUE KEY `patientIc_UNIQUE` (`patientIc`),
  ADD UNIQUE KEY `scheduleId_UNIQUE` (`scheduleId`);

--
-- Индексы таблицы `doctor`
--
ALTER TABLE `doctor`
  ADD PRIMARY KEY (`doctorId`,`icDoctor`),
  ADD UNIQUE KEY `icDoctor_UNIQUE` (`icDoctor`),
  ADD UNIQUE KEY `doctorId_UNIQUE` (`doctorId`);

--
-- Индексы таблицы `doctorschedule`
--
ALTER TABLE `doctorschedule`
  ADD PRIMARY KEY (`scheduleId`,`doctorIc`),
  ADD UNIQUE KEY `scheduleId_UNIQUE` (`scheduleId`),
  ADD KEY `doctorId` (`doctorIc`);

--
-- Индексы таблицы `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`icPatient`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `appointment`
--
ALTER TABLE `appointment`
  MODIFY `Id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `doctor`
--
ALTER TABLE `doctor`
  MODIFY `doctorId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `doctorschedule`
--
ALTER TABLE `doctorschedule`
  MODIFY `scheduleId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `appointment`
--
ALTER TABLE `appointment`
  ADD CONSTRAINT `PatientIc` FOREIGN KEY (`patientIc`) REFERENCES `patient` (`icPatient`),
  ADD CONSTRAINT `ScheduleId` FOREIGN KEY (`scheduleId`) REFERENCES `doctorschedule` (`scheduleId`);

--
-- Ограничения внешнего ключа таблицы `doctorschedule`
--
ALTER TABLE `doctorschedule`
  ADD CONSTRAINT `doctorId` FOREIGN KEY (`doctorIc`) REFERENCES `doctor` (`icDoctor`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
