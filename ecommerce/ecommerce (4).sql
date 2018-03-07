-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 07, 2018 at 07:20 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE IF NOT EXISTS `brand` (
  `brand_id` int(11) NOT NULL AUTO_INCREMENT,
  `brand_name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`brand_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`brand_id`, `brand_name`) VALUES
(9, 'PANTERA'),
(10, 'EKV'),
(11, 'OBOJENI PROGRAM'),
(12, 'MADBALL'),
(13, 'THE DOORS'),
(14, 'BOB MARLEY'),
(15, 'ALANIES MORISSETTE'),
(16, 'METALLICA'),
(17, 'SLAYER'),
(18, 'DARKWOOD DUB'),
(19, 'SEX PISTOLS'),
(20, 'PEKINSKA PATKA'),
(21, 'KUD');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `cat_id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`cat_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cat_id`, `cat_name`) VALUES
(12, 'METAL'),
(13, 'ROK'),
(14, 'POP'),
(16, 'REGE'),
(17, 'HARD CORE'),
(18, 'PUNK');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `comm_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `pro_id` int(11) DEFAULT NULL,
  `txt` text,
  `realdate` datetime DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`comm_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=442 ;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comm_id`, `user_id`, `pro_id`, `txt`, `realdate`, `parent_id`) VALUES
(439, 16, 23, 'kbjiugbiukj', '2018-03-03 08:46:03', NULL),
(440, 49, 22, 'METAL!!!', '2018-03-07 07:41:41', NULL),
(441, 51, 22, 'WALK, 5 MINUTES ALONE....', '2018-03-07 07:43:08', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_user`
--

CREATE TABLE IF NOT EXISTS `order_user` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `pro_id` int(11) DEFAULT NULL,
  `q` int(11) DEFAULT NULL,
  `realdate` datetime DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=103 ;

--
-- Dumping data for table `order_user`
--

INSERT INTO `order_user` (`order_id`, `user_id`, `pro_id`, `q`, `realdate`, `status`) VALUES
(88, 49, 22, 1, '2018-03-05 07:59:31', 1),
(89, 51, 23, 2, '2018-03-05 08:04:59', 1),
(90, 51, 22, 1, '2018-03-05 08:04:59', NULL),
(91, 53, 24, 1, '2018-03-05 08:07:27', NULL),
(92, 53, 23, 1, '2018-03-05 08:07:27', NULL),
(93, 53, 26, 1, '2018-03-05 08:07:27', 1),
(94, 55, 22, 1, '2018-03-05 08:09:53', 1),
(95, 55, 29, 1, '2018-03-05 08:09:53', 1),
(96, 57, 23, 2, '2018-03-05 08:14:11', NULL),
(97, 57, 25, 1, '2018-03-05 08:14:11', NULL),
(98, 57, 32, 1, '2018-03-05 08:14:11', NULL),
(99, 49, 24, 1, '2018-03-07 07:34:40', 1),
(100, 49, 27, 1, '2018-03-07 07:34:40', NULL),
(101, 49, 27, 1, '2018-03-07 07:37:23', NULL),
(102, 49, 30, 1, '2018-03-07 07:37:23', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `pro_id` int(11) NOT NULL AUTO_INCREMENT,
  `pro_name` varchar(100) DEFAULT NULL,
  `pro_price` int(11) DEFAULT NULL,
  `pro_body` text,
  `cat_id` int(11) DEFAULT NULL,
  `brand_id` int(11) DEFAULT NULL,
  `pro_img` text,
  PRIMARY KEY (`pro_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=34 ;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`pro_id`, `pro_name`, `pro_price`, `pro_body`, `cat_id`, `brand_id`, `pro_img`) VALUES
(22, 'PANTERA', 800, 'ALBUM<br>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed porta nisi ut erat consectetur laoreet. Phasellus leo turpis, scelerisque at tempus quis, rhoncus ac tellus.<br>\r\nO BENDU<br>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed porta nisi ut erat consectetur laoreet. Phasellus leo turpis, scelerisque at tempus quis, rhoncus ac tellus.\r\nVIDEO<br><a href="https://www.youtube.com/results?search_query=PANTERA">VIDEO</a>', 12, 9, 'pantera.jpg'),
(23, 'EKATARINA VELIKA', 650, 'ALBUM<br>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed porta nisi ut erat consectetur laoreet. Phasellus leo turpis, scelerisque at tempus quis, rhoncus ac tellus.<br>\r O BENDU<br>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed porta nisi ut erat consectetur laoreet. Phasellus leo turpis, scelerisque at tempus quis, rhoncus ac tellus.<br>\r VIDEO<br>\r <a href="https://www.youtube.com/results?search_query=EKV">VIDEO</a>', 13, 10, 'ekv.jpg'),
(24, 'MADBALL', 600, 'ALBUM<br>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed porta nisi ut erat consectetur laoreet. Phasellus leo turpis, scelerisque at tempus quis, rhoncus ac tellus.<br>\r O BENDU<br>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed porta nisi ut erat consectetur laoreet. Phasellus leo turpis, scelerisque at tempus quis, rhoncus ac tellus.\r <br>VIDEO<br><a href="https://www.youtube.com/results?search_query=madball">VIDEO</a>', 17, 12, 'downloa.jpg'),
(25, 'ALANIS MORISSETTE', 700, 'ALBUM<br>rem ipsum dolor sit amet, consectetur adipiscing elit. Sed porta nisi ut erat consectetur laoreet. Phasellus leo turpis, scelerisque at tempus quis, rhoncus ac tellus.<br>\r\nO BENDU<br>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed porta nisi ut erat consectetur laoreet. Phasellus leo turpis, scelerisque at tempus quis, rhoncus ac tellus.<br>\r\nVIDEO<<br><a href="https://www.youtube.com/results?search_query=alanis+morissette">VIDEO</a>', 14, 15, 'alanis.jpg'),
(26, 'THE DOORS', 400, 'ALBUM<br>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed porta nisi ut erat consectetur laoreet. Phasellus leo turpis, scelerisque at tempus quis, rhoncus ac tellus.<br>\r O BENDU<br>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed porta nisi ut erat consectetur laoreet. Phasellus leo turpis, scelerisque at tempus quis, rhoncus ac tellus.<br>\r VIDEO<br><a href="https://www.youtube.com/results?search_query=the+doors">VIDEO</a>', 13, 13, 'doors.jpg'),
(27, 'BOB MARLEY', 400, 'ALBUM<br>rem ipsum dolor sit amet, consectetur adipiscing elit. Sed porta nisi ut erat consectetur laoreet. Phasellus leo turpis, scelerisque at tempus quis, rhoncus ac tellus.<br>\r\n O BENDU<br>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed porta nisi ut erat consectetur laoreet. Phasellus leo turpis, scelerisque at tempus quis, rhoncus ac tellus.<br>\r\n VIDEO<<br><a href=https://www.youtube.com/results?search_query=bob+marley">VIDEO</a>', 16, 14, 'bob.jpg'),
(28, 'METALLICA', 600, 'ALBUM<br>orem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s<br>O BENDU<br>orem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s<br>VIDEO<br><a href="https://www.youtube.com/results?search_query=metallica">VIDEO</a>', 12, 16, 'metallica.jpg'),
(29, 'SLAYER', 300, 'ALBUM<br>orem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s<br>O BENDU<br>orem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s<br>VIDEO<br><a href="https://www.youtube.com/results?search_query=SLAYER">VIDEO</a>', 12, 17, 'slayer.jpg'),
(30, 'DARKWOOD DUB', 830, 'ALBUM<br>orem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s<br>O BENDU<br>orem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s<br>VIDEO<br><a href="https://www.youtube.com/results?search_query=darkwood+dub">VIDEO</a>', 13, 18, 'd.jpg'),
(31, 'SEX PISTOLS', 525, 'ALBUM<br>amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam <br>O BENDU<br>amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam <br>VIDEO<a href="https://www.youtube.com/results?search_query=swx+pistols">VIDEO</a>', 18, 19, 'sex.jpg'),
(32, 'KUD IDIOTI', 500, 'ALBUM<br>amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam <br>O BENDU<br>amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam <br>VIDEO<br><a href="https://www.youtube.com/results?search_query=kud+idijoti+"></a>', 18, 21, 'kud.jpg'),
(33, 'PEKINSKA PATKA', 500, 'ALBUM<br>amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam <br>O BENDU<br>amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam <br>VIDEO<br><a href="https://www.youtube.com/results?search_query=pekkisnka+patka"></a>', 18, 20, 'patka.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `sold_product`
--

CREATE TABLE IF NOT EXISTS `sold_product` (
  `sold_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `pro_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `realdate` datetime DEFAULT NULL,
  PRIMARY KEY (`sold_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `sold_product`
--

INSERT INTO `sold_product` (`sold_id`, `user_id`, `pro_id`, `quantity`, `realdate`) VALUES
(4, 49, 22, 1, '2018-03-05 07:59:31'),
(5, 51, 23, 2, '2018-03-05 08:04:59'),
(6, 51, 22, 1, '2018-03-05 08:04:59'),
(7, 53, 24, 1, '2018-03-05 08:07:27'),
(8, 53, 23, 1, '2018-03-05 08:07:27'),
(9, 53, 26, 1, '2018-03-05 08:07:27'),
(10, 55, 22, 1, '2018-03-05 08:09:53'),
(11, 55, 29, 1, '2018-03-05 08:09:53'),
(12, 57, 23, 2, '2018-03-05 08:14:11'),
(13, 57, 25, 1, '2018-03-05 08:14:11'),
(14, 57, 32, 1, '2018-03-05 08:14:11'),
(15, 49, 24, 1, '2018-03-07 07:34:40'),
(16, 49, 27, 1, '2018-03-07 07:34:40'),
(17, 49, 27, 1, '2018-03-07 07:37:23'),
(18, 49, 30, 1, '2018-03-07 07:37:23');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(100) DEFAULT NULL,
  `user_email` varchar(100) DEFAULT NULL,
  `user_pass` varchar(100) DEFAULT NULL,
  `cat_uset` int(11) DEFAULT NULL,
  `user_img` text,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=63 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_email`, `user_pass`, `cat_uset`, `user_img`) VALUES
(13, 'admin', 'zdravkovic.slavisa89@gmail.com', '123', 1, 'a.jpg'),
(49, 'nikola', 'n@gmail.com', '123', NULL, 'n.jpg'),
(51, 'Ena', 'e@gmail.com', 'ena1', NULL, 'i.png'),
(53, 'Tea', 't@gmail.com', '333', NULL, 'p.jpg'),
(55, 'Dzo', 'dz@gmail.com', 'dzoi', NULL, 'p1.jpg'),
(57, 'Luna', 'l@gmail.com', 'lija', NULL, 'p3.jpg'),
(59, 'Jovana', 'j@gmail.com', 'joki', NULL, 'p4.jpg'),
(61, 'Gospodin', 'g@gmail.com', 'mini', NULL, 'p2.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `user_cart`
--

CREATE TABLE IF NOT EXISTS `user_cart` (
  `cart_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `pro_id` int(11) DEFAULT NULL,
  `q` int(11) DEFAULT NULL,
  PRIMARY KEY (`cart_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=180 ;

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE IF NOT EXISTS `user_info` (
  `info_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `p_code` int(11) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `mobile` int(11) DEFAULT NULL,
  PRIMARY KEY (`info_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`info_id`, `user_id`, `address`, `city`, `p_code`, `state`, `mobile`) VALUES
(3, 16, 'Luja Adamica 14/5', 'Beograd', 11000, 'Srbija', 632211334),
(8, 18, 'Karaburma, Salvadora Aljendea 16', 'Beograd', 11000, 'Srbija', 12345),
(11, 13, 'Luja Adamica 14/5', 'Beograd', 11000, 'Srbija', 2147483647),
(12, 49, 'Karaburma, Salvadora Aljendea 16', 'Beograd', 11000, 'Srbija', 5678),
(13, 51, 'Miloja RadosavljeviÄ‡a 6', 'Kragujevac', 34000, 'Srbija', 22223424),
(14, 53, 'Kneza Milosa 11', 'Beograd', 11000, 'Srbija', 98645),
(15, 55, 'Jovana Caksiranovica 19', 'Negotin', 19300, 'Srbija', 8954336),
(16, 57, 'Jovana Deroka 32', 'Kraljevo', 36000, 'Srbija', 458563);

-- --------------------------------------------------------

--
-- Table structure for table `user_wish`
--

CREATE TABLE IF NOT EXISTS `user_wish` (
  `wish_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `pro_id` int(11) DEFAULT NULL,
  `q` int(11) DEFAULT NULL,
  PRIMARY KEY (`wish_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
