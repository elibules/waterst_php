-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 22, 2022 at 09:24 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `waterst_db`
--
CREATE DATABASE IF NOT EXISTS `waterst_db` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `waterst_db`;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` tinyint(4) NOT NULL,
  `category_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`) VALUES
(1, 'Progressive Rock'),
(2, 'Rock'),
(3, 'Folk'),
(4, 'Country'),
(5, 'Psychedelic Rock'),
(6, 'Jam Band'),
(7, 'R&B'),
(8, 'Funk'),
(9, 'Folk Rock'),
(10, 'Ska');

-- --------------------------------------------------------

--
-- Table structure for table `formats`
--

CREATE TABLE `formats` (
  `format_id` tinyint(11) NOT NULL,
  `format_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `formats`
--

INSERT INTO `formats` (`format_id`, `format_name`) VALUES
(1, 'CD'),
(2, 'Vinyl');

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `item_id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `artist` varchar(50) NOT NULL,
  `release_date` date NOT NULL,
  `price` decimal(5,2) NOT NULL,
  `image` text NOT NULL,
  `quality_id` tinyint(4) NOT NULL,
  `format_id` tinyint(4) NOT NULL,
  `category_id` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`item_id`, `title`, `artist`, `release_date`, `price`, `image`, `quality_id`, `format_id`, `category_id`) VALUES
(1, 'Close to the Edge', 'Yes', '1972-09-13', '13.50', 'https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Ftse1.mm.bing.net%2Fth%3Fid%3DOIP.xiPKqx3I6GT4q72RzMFJpwHaHY%26pid%3DApi&f=1', 2, 2, 1),
(2, 'Led Zeppelin II', 'Led Zeppelin', '1969-10-22', '10.00', 'https://duckduckgo.com/i/2edc3476.jpg', 4, 1, 2),
(3, 'Axis: Bold as Love', 'Jimi Hendrix Experience', '1967-12-01', '16.80', 'https://duckduckgo.com/i/98615fd3.jpg', 3, 2, 5),
(4, 'Brothers', 'The Black Keys', '2010-05-18', '8.50', 'https://duckduckgo.com/i/a1edc5c1.jpg', 3, 1, 2),
(5, 'Oddments', 'King Gizzard and The Lizard Wizard', '2014-03-07', '26.50', 'https://duckduckgo.com/i/7b8129ac.jpg', 4, 2, 5),
(6, 'In the Court of the Crimson King', 'King Crimson', '1969-10-10', '9.00', 'https://duckduckgo.com/i/963a2d60.jpeg', 3, 1, 1),
(7, 'Europe \'72', 'Grateful Dead', '1972-11-01', '35.00', 'https://duckduckgo.com/i/f3ded03f.jpg', 3, 2, 6),
(8, 'American Beauty', 'Grateful Dead', '1970-11-01', '10.50', 'https://upload.wikimedia.org/wikipedia/en/6/6a/Grateful_Dead_-_American_Beauty.jpg', 3, 1, 6),
(9, 'Eat a Peach', 'Allman Brothers Band', '1972-02-12', '42.50', 'https://duckduckgo.com/i/62e5dba0.jpg', 4, 2, 6),
(10, 'Drunk', 'Thundercat', '2012-02-24', '12.50', 'https://duckduckgo.com/i/0b18ea09.jpg', 4, 1, 8),
(11, 'It Is What It Is', 'Thundercat', '2020-04-03', '30.00', 'https://duckduckgo.com/i/9e4e27bf.jpg', 4, 2, 8),
(12, 'Everybody Knows This is Nowhere', 'Neil Young', '1969-05-14', '18.95', 'https://duckduckgo.com/i/a89de311.jpg', 2, 2, 9);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `message_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `message_body` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`message_id`, `name`, `email`, `message_body`, `timestamp`) VALUES
(4, 'Test User', 'test@gmail.com', 'Just seeing if this works...', '2022-05-02 16:38:49'),
(5, 'Mr. Name', 'anotherTest@gmail.com', 'Making sure this works on web4.', '2022-05-02 17:54:20'),
(6, 'New Person', 'person@gmail.com', 'This works at school too, hopefully. ', '2022-05-02 19:39:23'),
(7, 'New Message', 'newEmail@email.com', 'New message goes here', '2022-05-02 20:05:25'),
(8, 'Elijah Bules', 'wyattstinks@gmail.com', 'the fucking point', '2022-05-24 15:34:55');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `order_info` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`order_info`)),
  `user_id` int(11) NOT NULL,
  `fulfilled` tinyint(1) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `order_info`, `user_id`, `fulfilled`, `date`) VALUES
(21, '{\n  \"id\": \"26D56239L1025981D\",\n  \"intent\": \"CAPTURE\",\n  \"status\": \"COMPLETED\",\n  \"purchase_units\": [\n    {\n      \"reference_id\": \"default\",\n      \"amount\": {\n        \"currency_code\": \"USD\",\n        \"value\": \"44.10\",\n        \"breakdown\": {\n          \"item_total\": {\n            \"currency_code\": \"USD\",\n            \"value\": \"44.10\"\n          },\n          \"shipping\": {\n            \"currency_code\": \"USD\",\n            \"value\": \"0.00\"\n          },\n          \"handling\": {\n            \"currency_code\": \"USD\",\n            \"value\": \"0.00\"\n          },\n          \"insurance\": {\n            \"currency_code\": \"USD\",\n            \"value\": \"0.00\"\n          },\n          \"shipping_discount\": {\n            \"currency_code\": \"USD\",\n            \"value\": \"0.00\"\n          }\n        }\n      },\n      \"payee\": {\n        \"email_address\": \"sb-mk2dc14304276@business.example.com\",\n        \"merchant_id\": \"ZFJZ9XGTAE7AS\"\n      },\n      \"description\": \"American Beauty\",\n      \"items\": [\n        {\n          \"name\": \"American Beauty\",\n          \"unit_amount\": {\n            \"currency_code\": \"USD\",\n            \"value\": \"10.50\"\n          },\n          \"tax\": {\n            \"currency_code\": \"USD\",\n            \"value\": \"0.00\"\n          },\n          \"quantity\": \"1\"\n        },\n        {\n          \"name\": \"Axis: Bold as Love\",\n          \"unit_amount\": {\n            \"currency_code\": \"USD\",\n            \"value\": \"16.80\"\n          },\n          \"tax\": {\n            \"currency_code\": \"USD\",\n            \"value\": \"0.00\"\n          },\n          \"quantity\": \"1\"\n        },\n        {\n          \"name\": \"Axis: Bold as Love\",\n          \"unit_amount\": {\n            \"currency_code\": \"USD\",\n            \"value\": \"16.80\"\n          },\n          \"tax\": {\n            \"currency_code\": \"USD\",\n            \"value\": \"0.00\"\n          },\n          \"quantity\": \"1\"\n        }\n      ],\n      \"shipping\": {\n        \"name\": {\n          \"full_name\": \"John Doe\"\n        },\n        \"address\": {\n          \"address_line_1\": \"1 Main St\",\n          \"admin_area_2\": \"San Jose\",\n          \"admin_area_1\": \"CA\",\n          \"postal_code\": \"95131\",\n          \"country_code\": \"US\"\n        }\n      },\n      \"payments\": {\n        \"captures\": [\n          {\n            \"id\": \"7CV95222SL8798057\",\n            \"status\": \"COMPLETED\",\n            \"amount\": {\n              \"currency_code\": \"USD\",\n              \"value\": \"44.10\"\n            },\n            \"final_capture\": true,\n            \"seller_protection\": {\n              \"status\": \"ELIGIBLE\",\n              \"dispute_categories\": [\n                \"ITEM_NOT_RECEIVED\",\n                \"UNAUTHORIZED_TRANSACTION\"\n              ]\n            },\n            \"create_time\": \"2022-05-02T14:19:55Z\",\n            \"update_time\": \"2022-05-02T14:19:55Z\"\n          }\n        ]\n      }\n    }\n  ],\n  \"payer\": {\n    \"name\": {\n      \"given_name\": \"John\",\n      \"surname\": \"Doe\"\n    },\n    \"email_address\": \"sb-lnc8315322996@personal.example.com\",\n    \"payer_id\": \"CTYQDGRP726LQ\",\n    \"address\": {\n      \"country_code\": \"US\"\n    }\n  },\n  \"create_time\": \"2022-05-02T14:19:05Z\",\n  \"update_time\": \"2022-05-02T14:19:55Z\",\n  \"links\": [\n    {\n      \"href\": \"https://api.sandbox.paypal.com/v2/checkout/orders/26D56239L1025981D\",\n      \"rel\": \"self\",\n      \"method\": \"GET\"\n    }\n  ]\n}', 4, 0, '2022-05-02 14:19:56'),
(24, '{\n  \"id\": \"7VB81124217307730\",\n  \"intent\": \"CAPTURE\",\n  \"status\": \"COMPLETED\",\n  \"purchase_units\": [\n    {\n      \"reference_id\": \"default\",\n      \"amount\": {\n        \"currency_code\": \"USD\",\n        \"value\": \"69.00\",\n        \"breakdown\": {\n          \"item_total\": {\n            \"currency_code\": \"USD\",\n            \"value\": \"69.00\"\n          },\n          \"shipping\": {\n            \"currency_code\": \"USD\",\n            \"value\": \"0.00\"\n          },\n          \"handling\": {\n            \"currency_code\": \"USD\",\n            \"value\": \"0.00\"\n          },\n          \"insurance\": {\n            \"currency_code\": \"USD\",\n            \"value\": \"0.00\"\n          },\n          \"shipping_discount\": {\n            \"currency_code\": \"USD\",\n            \"value\": \"0.00\"\n          }\n        }\n      },\n      \"payee\": {\n        \"email_address\": \"sb-mk2dc14304276@business.example.com\",\n        \"merchant_id\": \"ZFJZ9XGTAE7AS\"\n      },\n      \"description\": \"Oddments\",\n      \"items\": [\n        {\n          \"name\": \"Oddments\",\n          \"unit_amount\": {\n            \"currency_code\": \"USD\",\n            \"value\": \"26.50\"\n          },\n          \"tax\": {\n            \"currency_code\": \"USD\",\n            \"value\": \"0.00\"\n          },\n          \"quantity\": \"1\"\n        },\n        {\n          \"name\": \"Eat a Peach\",\n          \"unit_amount\": {\n            \"currency_code\": \"USD\",\n            \"value\": \"42.50\"\n          },\n          \"tax\": {\n            \"currency_code\": \"USD\",\n            \"value\": \"0.00\"\n          },\n          \"quantity\": \"1\"\n        }\n      ],\n      \"shipping\": {\n        \"name\": {\n          \"full_name\": \"John Doe\"\n        },\n        \"address\": {\n          \"address_line_1\": \"1 Main St\",\n          \"admin_area_2\": \"San Jose\",\n          \"admin_area_1\": \"CA\",\n          \"postal_code\": \"95131\",\n          \"country_code\": \"US\"\n        }\n      },\n      \"payments\": {\n        \"captures\": [\n          {\n            \"id\": \"2DA75575XD492013U\",\n            \"status\": \"COMPLETED\",\n            \"amount\": {\n              \"currency_code\": \"USD\",\n              \"value\": \"69.00\"\n            },\n            \"final_capture\": true,\n            \"seller_protection\": {\n              \"status\": \"ELIGIBLE\",\n              \"dispute_categories\": [\n                \"ITEM_NOT_RECEIVED\",\n                \"UNAUTHORIZED_TRANSACTION\"\n              ]\n            },\n            \"create_time\": \"2022-05-02T14:47:54Z\",\n            \"update_time\": \"2022-05-02T14:47:54Z\"\n          }\n        ]\n      }\n    }\n  ],\n  \"payer\": {\n    \"name\": {\n      \"given_name\": \"John\",\n      \"surname\": \"Doe\"\n    },\n    \"email_address\": \"sb-lnc8315322996@personal.example.com\",\n    \"payer_id\": \"CTYQDGRP726LQ\",\n    \"address\": {\n      \"country_code\": \"US\"\n    }\n  },\n  \"create_time\": \"2022-05-02T14:47:46Z\",\n  \"update_time\": \"2022-05-02T14:47:54Z\",\n  \"links\": [\n    {\n      \"href\": \"https://api.sandbox.paypal.com/v2/checkout/orders/7VB81124217307730\",\n      \"rel\": \"self\",\n      \"method\": \"GET\"\n    }\n  ]\n}', 4, 0, '2022-05-02 14:47:54');

-- --------------------------------------------------------

--
-- Table structure for table `qualities`
--

CREATE TABLE `qualities` (
  `quality_id` tinyint(4) NOT NULL,
  `quality_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `qualities`
--

INSERT INTO `qualities` (`quality_id`, `quality_name`) VALUES
(1, 'Poor'),
(2, 'Okay'),
(3, 'Great'),
(4, 'Perfect');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` text NOT NULL,
  `role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `full_name`, `email`, `password`, `role`) VALUES
(0, 'Guest', 'guest@guestEmail.xyz', '$2y$10$fVWul8Hl72U7rx5FIh49G.B2zRCwp1KLxOsOhgjkf838yF9GXgj.e', 0),
(4, 'Elijah Bules', 'elibules@gmail.com', '$2a$14$hCG/rQcSiOsDmRW9fwCh/eYn64guuEcSe81OVLg25NMOsRAn5W.Zm', 1),
(6, 'Test Account', 'test@email.com', '$2y$10$oi/o/MQIfJl.o5zcOGZvx.RtCgC8UQASzlEwprjyi96dKXW.LZ02a', 0),
(7, 'Test Account', 'email@email.com', '$2y$10$C7Qs/hgfNar5fzMybIxyT.9yps7.NSMmwQHW1Z/6upITNJucLZxFS', 0),
(8, 'ryan', 'ryantest@gmail.com', '$2y$10$TfFnTMtFGZq1C5wqd8lBZ.FHHVIy9g3ZDLLK8z0vw9cbYYOrN3vSi', 0),
(9, 'Julius Joiner', 'titanboy@sbcglobal.net', '$2y$10$V2wGEKeLDMiONyc3PhWdce3r5N1kM5Xi6Rk6aoeBh89gT0H34AoKG', 0),
(10, 'nat', 'nat@test.com', '$2y$10$dVNJMtvYmSe7Y89Mp5qoxud0/onHcAWsGYnLdPBTU9ibn66ESboXe', 0),
(11, 'Gaia Harshman', 'gaharsh@iu.edu', '$2y$10$CPDhyCx8zoXYMIRg2skMZOw149nqSiHO0Zy5aKbKHL0wSchf2.L8.', 0),
(12, 'daniel thang', 'danthang@iu.edu', '$2y$10$cS4H6Xd/n7tskBJOVhixvu6GsSMdoElCEFcP1QKPtCRPGbPhINCmi', 0),
(13, 'admin', 'admin@gmail.com', '$2y$10$hM0bLuY3TMBDMTbxtsJ7fOMIYyLmnSnzNS2bSbwPHgzobBsJNF1FK', 1),
(14, 'Test Name', 'testAccount@gmail.com', '$2y$10$Nqha1xJa3t.pCooYXwQMse8hji46RQAbQWeZvKJZoyfI9F/1nZe3W', 0),
(15, 'New Name', 'account@name.xyz', '$2y$10$KodmQag39o8FyRZ8vR8GpeStfDi4KRmzDfEpHhPnJSj/Mp2lSp4Xi', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `formats`
--
ALTER TABLE `formats`
  ADD PRIMARY KEY (`format_id`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`item_id`),
  ADD KEY `quality_id` (`quality_id`,`format_id`,`category_id`),
  ADD KEY `category_relationship` (`category_id`),
  ADD KEY `format_relationship` (`format_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`message_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_order` (`user_id`);

--
-- Indexes for table `qualities`
--
ALTER TABLE `qualities`
  ADD PRIMARY KEY (`quality_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `inventory`
--
ALTER TABLE `inventory`
  ADD CONSTRAINT `category_relationship` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `format_relationship` FOREIGN KEY (`format_id`) REFERENCES `formats` (`format_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `quality_relationship` FOREIGN KEY (`quality_id`) REFERENCES `qualities` (`quality_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `user_order` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE NO ACTION ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
