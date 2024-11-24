-- Adminer 4.8.1 MySQL 8.0.34 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP DATABASE IF EXISTS `fish_cloud_server`;
CREATE DATABASE `fish_cloud_server` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `fish_cloud_server`;

DROP TABLE IF EXISTS `cs_server_manager`;
CREATE TABLE `cs_server_manager` (
  `id` int NOT NULL AUTO_INCREMENT COMMENT 'id',
  `host` varchar(255) NOT NULL DEFAULT '' COMMENT '主机',
  `port` int NOT NULL DEFAULT '22' COMMENT '端口号',
  `username` varchar(255) NOT NULL DEFAULT 'root' COMMENT '账号',
  `password` varchar(255) NOT NULL DEFAULT '0' COMMENT '密码',
  `expire_time` int NOT NULL DEFAULT '0' COMMENT '账号过期时间',
  `addtime` int NOT NULL DEFAULT '0' COMMENT '添加时间',
  `deltime` int NOT NULL DEFAULT '0' COMMENT '删除时间',
  `status` int NOT NULL DEFAULT '0' COMMENT '状态|0:正常,-1:删除',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='服务器管理';

TRUNCATE `cs_server_manager`;
INSERT INTO `cs_server_manager` (`id`, `host`, `port`, `username`, `password`, `expire_time`, `addtime`, `deltime`, `status`) VALUES
(1,	'203.57.225.216',	22,	'root',	'He@199033028',	1767110400,	1732447927,	0,	0),
(2,	'121.4.70.60',	22,	'root',	'He@199033028',	1501430400,	1732449170,	0,	0);

-- 2024-11-24 19:03:34
