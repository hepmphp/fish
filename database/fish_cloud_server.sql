-- Adminer 4.8.1 MySQL 8.0.34 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `cs_mail_server`;
CREATE TABLE `cs_mail_server` (
  `id` int NOT NULL AUTO_INCREMENT COMMENT 'id',
  `stmp_server` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '' COMMENT 'stmp邮箱主机地址',
  `imap_server` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '' COMMENT 'imap服务器地址',
  `stmp_port` int NOT NULL DEFAULT '25' COMMENT 'smtp端口号',
  `imap_port` int NOT NULL DEFAULT '993' COMMENT 'imap端口号',
  `username` varchar(255) NOT NULL DEFAULT 'root' COMMENT '账号',
  `password` varchar(255) NOT NULL DEFAULT '0' COMMENT '密码',
  `addtime` int NOT NULL DEFAULT '0' COMMENT '添加时间',
  `deltime` int NOT NULL DEFAULT '0' COMMENT '删除时间',
  `status` int NOT NULL DEFAULT '0' COMMENT '状态|0:正常,-1:删除',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='邮件服务器管理';

INSERT INTO `cs_mail_server` (`id`, `stmp_server`, `imap_server`, `stmp_port`, `imap_port`, `username`, `password`, `addtime`, `deltime`, `status`) VALUES
(1,	'smtp.139.com',	'{imap.139.com:993/imap/ssl}',	25,	993,	'15060779893@139.com',	'84874f770303ac0a7400',	0,	1732886742,	0),
(2,	'smtp.qq.com',	'{imap.qq.com:993/imap/ssl}',	25,	993,	'sh_run@qq.com',	'uczftfiyzjkxbjgg',	1732888556,	0,	0),
(3,	'smtp.126.com',	'{imap.126.com:993/imap/ssl}',	25,	993,	'hepanming007@126.com',	'YUwY4yHTeGG6hUYK',	1732892024,	0,	0),
(4,	'smtp.aliyun.com',	'{imap.aliyum.com:993/imap/ssl}',	25,	993,	'15060779893@aliyun.com',	'He199033028',	1732894082,	0,	0),
(5,	'smtp.sohu.com',	'{imap.sohu.com:993/imap/ssl}',	25,	993,	'15060779893@sohu.com',	'XPBQY45NC1KWUS',	1732894430,	0,	0);

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

INSERT INTO `cs_server_manager` (`id`, `host`, `port`, `username`, `password`, `expire_time`, `addtime`, `deltime`, `status`) VALUES
(1,	'203.57.225.216',	22,	'root',	'He@199033028',	1767110400,	1732447927,	0,	0),
(2,	'121.4.70.60',	22,	'root',	'He@199033028',	1501430400,	1732449170,	0,	0);

-- 2024-11-29 15:35:18
