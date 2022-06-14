-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2022-06-14 11:05:16
-- 伺服器版本： 10.4.22-MariaDB
-- PHP 版本： 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫: `poll`
--

-- --------------------------------------------------------

--
-- 資料表結構 `answer`
--

CREATE TABLE `answer` (
  `aid` int(100) NOT NULL,
  `content` varchar(255) NOT NULL,
  `eid` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `answer`
--

INSERT INTO `answer` (`aid`, `content`, `eid`) VALUES
(1, 'yes', 5),
(2, 'no', 5),
(3, 'not sure', 5),
(4, 'no comment', 5),
(5, 'yes', 7),
(6, 'no', 7),
(7, 'not sure', 7),
(8, 'no comment', 7),
(9, 'yes', 10),
(10, 'no', 10),
(11, 'not sure', 10),
(12, 'no comment', 10),
(13, 'yes', 13),
(14, 'no', 13),
(15, 'not sure', 13),
(16, 'no comment', 13),
(17, 'html', 14),
(18, 'php', 14),
(19, 'css', 14),
(20, 'javascript', 14),
(21, 'test21', 22),
(22, 'test21', 22),
(23, 'test21', 22),
(24, 'testans', 22),
(25, 'yes', 26),
(26, 'no', 26),
(27, 'half', 26),
(28, 'no comment', 26),
(37, 'yes', 29),
(38, 'no', 29),
(39, 'half', 29),
(40, 'no commend', 29);

-- --------------------------------------------------------

--
-- 資料表結構 `events`
--

CREATE TABLE `events` (
  `eid` int(100) NOT NULL,
  `title` varchar(255) NOT NULL,
  `question` varchar(255) NOT NULL,
  `uid` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `events`
--

INSERT INTO `events` (`eid`, `title`, `question`, `uid`) VALUES
(5, 'EIE3117', 'Do you like this course?', 3),
(7, 'html', 'Do you like to use html to build website?', 1),
(10, 'css', 'is css important for web design?', 2),
(13, 'php', 'is php powerful to connect between database and website?', 4),
(14, 'web design', 'what is the hard thing to design the website?', 4),
(16, 'demo', 'demo question', 9),
(17, 'deomo', 'qewrqew', 9),
(21, 'ftest 1', 'hello question', 15),
(22, 'suc title1', 'sucquesion', 15),
(23, 'testa', 'qa', 15),
(26, 'test4ans', 'insert 4 answer?', 11),
(29, 'final4ans', 'final4 display', 11);

-- --------------------------------------------------------

--
-- 資料表結構 `record`
--

CREATE TABLE `record` (
  `rid` int(100) NOT NULL,
  `eid` int(100) NOT NULL,
  `aid` int(100) NOT NULL,
  `uid` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `record`
--

INSERT INTO `record` (`rid`, `eid`, `aid`, `uid`) VALUES
(1, 7, 6, 3),
(2, 5, 1, 2),
(3, 5, 2, 1),
(5, 7, 5, 1),
(7, 5, 3, 4),
(8, 7, 8, 1),
(9, 10, 9, 1),
(10, 13, 13, 1),
(11, 10, 10, 3),
(12, 13, 14, 2),
(13, 10, 11, 4),
(14, 13, 15, 3),
(16, 14, 18, 11),
(17, 13, 13, 11),
(18, 10, 12, 11),
(19, 13, 14, 8),
(20, 14, 19, 8),
(21, 10, 9, 8),
(23, 5, 1, 11),
(24, 7, 6, 15),
(25, 16, 16, 11),
(26, 5, 3, 15);

-- --------------------------------------------------------

--
-- 資料表結構 `user`
--

CREATE TABLE `user` (
  `uid` int(100) NOT NULL,
  `username` varchar(255) NOT NULL,
  `nickname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(100) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `user`
--

INSERT INTO `user` (`uid`, `username`, `nickname`, `email`, `password`, `image`) VALUES
(1, 'alexnnoo', 'amty', 'al@gmail.com', '$2y$10$hgjfhgjfhgjfgjfuk,iugj7CtXc.5G90rUSt7T4PfOKUqxE4wx2QSEQgNDa', 'C:\\database\\picture\\cat.jpg'),
(2, 'bob ho', 'bob', 'bob@gmail.com', '$2y$10$gregsdfgsqhjgfdhdgfhsgdhdgfhdnz7CtXc.5G90rUSt7T4PfOKUqxE4wx2QSEQgNDa', 'C:\\database\\picture\\dog.jpg'),
(3, 'cindy_iq', 'cindy', 'cinasdy@gmail.com', '$2y$10$7312aI9q.jfr4tnz7CtXc.5G90rUSt7T4PfOKUqxE4wx2QSEQgNDa', 'C:\\database\\picture\\cow.jpg'),
(4, 'david_boss', 'david', 'dad@gmail.com', '$2y$10$76849aI9q.jj4Jnz7CtXc.5G90rUSt7T4PfOKhtrE4wx2QSEQgNDa', 'C:\\database\\picture\\people.jpg'),
(6, '21038665d', 'apolyu', 'polyu@gmail.com', '$2y$10$76849aI9q.jj4Jnz7Cgfhddgfh0rUSt7T4PfOKhtrE4wx2QSEQgNDa', ''),
(7, 'mui', 'mui', 'asd@gmail.com', '$2y$10$VRS1TYlS3DNW27P8YyCL9eolYAZuQPixVafi36ro8tAU8TecGk9q2', 'C:\\database\\picture\\coco.jpg'),
(8, 'alex', 'abc', 'asdgr@gmail.com', '$2y$10$CFxPd56aAKNgk2bB8ec/VubCe3V4K9A9SENH0I48B3OOqTgagIMbG', 'C:\\database\\picture\\kill.jpg'),
(9, 'lexmtya', 'alex123', 'sae@gmail.com', '$2y$10$.rdw2ISSTQwXKRb2pM8loemCvF2SyulLFUyYdC0mWqb6clOV58jiy', ''),
(11, 'alexmty', 'apolyu', 'anm@gmail.com', '$2y$10$05neDNmXBfh64wY.QfP4bOhF.Ufy8RkuPUxqS6BGQvMIWWRPX5YxC', 'upload/1650312743-gta3.png'),
(12, 'alexpic', 'alexpic', 'alexpic@gmail.com', '$2y$10$T21h5UZ/GTOmFba75DskBOFVfpmEuMjeW6PJt5umCjeUFOT7B20M2', 'elden ring wallpaper2.jpg'),
(13, 'testinput', 'testinput', 'testinput@gmail.com', '$2y$10$taT1dH1DTnJplRzpHnLxU.MHKStjgMNB2VWlYoeo8lXk.kPeJaYGi', 'elden ring wallpaper2.jpg'),
(14, 'img', 'img', 'img@gmail.com', '$2y$10$RgZKl.z.11VtiYfifJdy.uazNEjuAlcFa7YhnyJpNdHZGhwlV8dca', 'elden-ring-wallpaper.jpg'),
(15, 'uploadimg', 'uploadimg', 'uploadimg@gmail.com', '$2y$10$FqkPM0BmXHi7Lp8U6AkRuOq5TwVIOSXFOAo33k.0F1zsiSCM0jyGW', 'upload/1650221191-cat.jpg'),
(16, 'fun', 'fun', 'fun@gmail.com', '$2y$10$pBTP2RYIdQoTLoYQ/ex2leXdHbjVPYbtE6cC81.L15Tb8umSZzK1G', 'upload/1650223886-a2time.png');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `answer`
--
ALTER TABLE `answer`
  ADD PRIMARY KEY (`aid`);

--
-- 資料表索引 `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`eid`);

--
-- 資料表索引 `record`
--
ALTER TABLE `record`
  ADD PRIMARY KEY (`rid`);

--
-- 資料表索引 `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`uid`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `answer`
--
ALTER TABLE `answer`
  MODIFY `aid` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `events`
--
ALTER TABLE `events`
  MODIFY `eid` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `record`
--
ALTER TABLE `record`
  MODIFY `rid` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `user`
--
ALTER TABLE `user`
  MODIFY `uid` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
