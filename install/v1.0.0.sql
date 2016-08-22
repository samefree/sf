-- phpMyAdmin SQL Dump
-- version 3.3.10.5
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2016 �?08 �?22 �?10:03
-- 服务器版本: 5.6.11
-- PHP 版本: 5.5.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `sf`
--

-- --------------------------------------------------------

--
-- 表的结构 `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `admin__id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `admin__account` varchar(60) NOT NULL DEFAULT '',
  `admin__password` varchar(64) NOT NULL DEFAULT '',
  `admin__email` varchar(100) NOT NULL DEFAULT '',
  `admin__sort` int(11) NOT NULL DEFAULT '0',
  `admin__post_time` datetime NOT NULL,
  `admin__modified_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `admin__status` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`admin__id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='后台管理员表' AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `admin`
--

INSERT INTO `admin` (`admin__id`, `admin__account`, `admin__password`, `admin__email`, `admin__sort`, `admin__post_time`, `admin__modified_time`, `admin__status`) VALUES
(1, 'admin', 'd0c935a9aa33c372ced6659d17518289:97', '83398609@qq.com', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1);
