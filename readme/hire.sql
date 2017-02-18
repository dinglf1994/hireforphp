-- phpMyAdmin SQL Dump
-- version 4.6.5.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 2017-02-18 17:57:20
-- 服务器版本： 5.7.17-0ubuntu0.16.04.1
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hire`
--

-- --------------------------------------------------------

--
-- 表的结构 `hire_ask_order`
--

CREATE TABLE `hire_ask_order` (
  `id` int(11) NOT NULL COMMENT '自增id',
  `number` int(11) NOT NULL COMMENT '订单编号',
  `quantity` int(11) DEFAULT NULL COMMENT '数量',
  `price` int(11) DEFAULT NULL COMMENT '价格',
  `create_time` datetime DEFAULT CURRENT_TIMESTAMP COMMENT '生成时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='卖单列表';

-- --------------------------------------------------------

--
-- 表的结构 `hire_bid_order`
--

CREATE TABLE `hire_bid_order` (
  `id` int(11) NOT NULL COMMENT '自增id',
  `number` int(11) NOT NULL COMMENT '订单编号',
  `quantity` int(11) DEFAULT NULL COMMENT '数量',
  `price` int(11) DEFAULT NULL COMMENT '价格',
  `create_time` datetime DEFAULT CURRENT_TIMESTAMP COMMENT '生成时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='买单列表';

-- --------------------------------------------------------

--
-- 表的结构 `hire_deal_info`
--

CREATE TABLE `hire_deal_info` (
  `id` int(11) NOT NULL COMMENT '自增id',
  `bid_number` int(11) NOT NULL COMMENT '买单编号',
  `ask_number` int(11) NOT NULL COMMENT '卖单编号',
  `deal_quantity` int(11) DEFAULT NULL COMMENT '成交数量',
  `deal_price` int(11) DEFAULT NULL COMMENT '成交价格',
  `create_time` datetime DEFAULT CURRENT_TIMESTAMP COMMENT '成交时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='消费记录';

-- --------------------------------------------------------

--
-- 表的结构 `hire_order`
--

CREATE TABLE `hire_order` (
  `number` int(11) NOT NULL COMMENT '订单编号',
  `type` enum('bid','ask') NOT NULL COMMENT '订单类型',
  `quantity` int(11) DEFAULT NULL COMMENT '数量',
  `price` int(11) DEFAULT NULL COMMENT '价格',
  `create_time` datetime DEFAULT CURRENT_TIMESTAMP COMMENT '生成时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='订单列表';

--
-- Indexes for dumped tables
--

--
-- Indexes for table `hire_ask_order`
--
ALTER TABLE `hire_ask_order`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `number` (`number`);

--
-- Indexes for table `hire_bid_order`
--
ALTER TABLE `hire_bid_order`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `number` (`number`);

--
-- Indexes for table `hire_deal_info`
--
ALTER TABLE `hire_deal_info`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `number` (`bid_number`,`ask_number`);

--
-- Indexes for table `hire_order`
--
ALTER TABLE `hire_order`
  ADD PRIMARY KEY (`number`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `hire_ask_order`
--
ALTER TABLE `hire_ask_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增id';
--
-- 使用表AUTO_INCREMENT `hire_bid_order`
--
ALTER TABLE `hire_bid_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增id';
--
-- 使用表AUTO_INCREMENT `hire_deal_info`
--
ALTER TABLE `hire_deal_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增id';
--
-- 使用表AUTO_INCREMENT `hire_order`
--
ALTER TABLE `hire_order`
  MODIFY `number` int(11) NOT NULL AUTO_INCREMENT COMMENT '订单编号';
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
