-- phpMyAdmin SQL Dump
-- version 4.0.5
-- http://www.phpmyadmin.net
--
-- 主機: localhost:3306
-- 產生日期: 2014 �?07 ??09 ??00:31
-- 伺服器版本: 5.6.13
-- PHP 版本: 5.5.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 資料庫: `jumbotex`
--

-- --------------------------------------------------------

--
-- 表的結構 `acct`
--

CREATE TABLE IF NOT EXISTS `acct` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `dte` date NOT NULL,
  `cate` text NOT NULL,
  `content` text NOT NULL,
  `amt` int(10) NOT NULL,
  `uid` int(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的結構 `album`
--

CREATE TABLE IF NOT EXISTS `album` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `content` text NOT NULL,
  `img` text,
  `uid` int(5) NOT NULL,
  `dte` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的結構 `album_img`
--

CREATE TABLE IF NOT EXISTS `album_img` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `aid` int(10) NOT NULL,
  `img` text NOT NULL,
  `thumb` text NOT NULL,
  `content` text,
  `dte` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `aid` (`aid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的結構 `cart_cate`
--

CREATE TABLE IF NOT EXISTS `cart_cate` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `content` text NOT NULL,
  `count` int(3) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的結構 `cart_product`
--

CREATE TABLE IF NOT EXISTS `cart_product` (
  `id` varchar(10) NOT NULL,
  `cid` int(5) NOT NULL,
  `title` text NOT NULL,
  `content` text NOT NULL,
  `qty` int(10) NOT NULL,
  `price` int(10) NOT NULL,
  `cost` int(10) NOT NULL,
  `start_dte` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `end_dte` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `cid` (`cid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的結構 `cart_product_det`
--

CREATE TABLE IF NOT EXISTS `cart_product_det` (
  `id` varchar(10) NOT NULL,
  `size` text,
  `weight` text,
  `unit` text,
  `img1` text,
  `img2` text,
  `img3` text,
  `hot` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的結構 `cart_sale`
--

CREATE TABLE IF NOT EXISTS `cart_sale` (
  `id` int(7) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `uid` int(5) unsigned zerofill NOT NULL,
  `start_dte` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `remit_dte` datetime DEFAULT NULL,
  `end_dte` date DEFAULT NULL,
  `freight` int(4) NOT NULL,
  `remit_name` varchar(10) DEFAULT NULL,
  `remit_acc` int(5) DEFAULT NULL,
  `addr` text,
  `status` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的結構 `cart_sale_det`
--

CREATE TABLE IF NOT EXISTS `cart_sale_det` (
  `sid` int(7) unsigned zerofill NOT NULL,
  `pid` varchar(10) NOT NULL,
  `qty` int(10) NOT NULL,
  `price` int(10) NOT NULL,
  `cost` int(10) NOT NULL,
  PRIMARY KEY (`sid`,`pid`),
  KEY `pid` (`pid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的結構 `message`
--

CREATE TABLE IF NOT EXISTS `message` (
  `messageid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `send` int(10) NOT NULL,
  `receive` text NOT NULL,
  `title` text NOT NULL,
  `message` text NOT NULL,
  `posttime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `isread` text NOT NULL,
  PRIMARY KEY (`messageid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的結構 `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `cate` varchar(20) NOT NULL,
  `title` text NOT NULL,
  `content` text NOT NULL,
  `uid` int(5) NOT NULL,
  `ip` varchar(40) NOT NULL,
  `upd_dte` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的結構 `page`
--

CREATE TABLE IF NOT EXISTS `page` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `content` text,
  `url` text,
  `uid` int(5) NOT NULL,
  `display` int(1) NOT NULL DEFAULT '1',
  `upd_dte` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `lft` int(11) NOT NULL,
  `rgt` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- 轉存資料表中的資料 `page`
--

INSERT INTO `page` (`id`, `name`, `content`, `url`, `uid`, `display`, `upd_dte`, `lft`, `rgt`) VALUES
(1, '首頁', NULL, NULL, 1, 1, '2014-07-08 06:17:34', 0, 9),
(2, '活動', '', '', 1, 0, '2014-07-08 06:17:34', 7, 8),
(3, '公司簡介', '<p>歷史 | 領域 | 產品</p>\r\n\r\n<p>testtesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttest</p>\r\n\r\n<p>testtesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttest</p>\r\n\r\n<p>testtesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttest</p>\r\n', '', 1, 0, '2014-07-08 06:19:48', 5, 6),
(4, '產品', '', '', 1, 0, '2014-07-08 02:40:42', 3, 4),
(5, '聯絡我們', '            <div class="row">\n                <div class="col-xs-12 section_header">\n                    <h1>聯絡 | Contact</h1>\n                </div>\n                <div class="col-md-6 col-md-offset-3 col-md-offset-3">\n                    <p>這裡放入說明。</p>\n                </div>\n                <div id="templatemo_contact_map_wapper">\n                    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d58430.872593818385!2d120.552989!3d23.749892!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x346ec9bfda08a969%3A0x139057ea7e7d825d!2zNjQw5Y-w54Gj6Zuy5p6X57ij5paX5YWt5biC56u55ZyN6Lev!5e0!3m2!1szh-TW!2sus!4v1404756953144" width="600" height="450" frameborder="0" style="border:0"></iframe>\n                </div>\n\n            </div>', '', 1, 0, '2014-07-08 06:09:08', 1, 2);

-- --------------------------------------------------------

--
-- 表的結構 `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(5) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `username` varchar(64) NOT NULL,
  `password` varchar(32) NOT NULL,
  `identifier` varchar(32) DEFAULT NULL,
  `token` varchar(32) DEFAULT NULL,
  `timeout` int(10) DEFAULT NULL,
  `name` varchar(20) DEFAULT NULL,
  `gender` varchar(2) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `address` text,
  `tel` varchar(10) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `ip` varchar(16) NOT NULL,
  `reg_dte` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `type` int(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `username` (`username`),
  KEY `username_2` (`username`),
  KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 轉存資料表中的資料 `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `identifier`, `token`, `timeout`, `name`, `gender`, `birthday`, `address`, `tel`, `email`, `ip`, `reg_dte`, `type`) VALUES
(00001, 'admin', 'e7cdc446356dee07b8c5a0921de12ce3', NULL, NULL, NULL, '管理員', 'M', '2014-07-15', '台北', '0900000000', 'admin@admin.admin', '127.0.0.1', '2014-07-08 02:04:00', 99);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
