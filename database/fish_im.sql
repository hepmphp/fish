-- Adminer 4.8.1 MySQL 8.0.34 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP DATABASE IF EXISTS `fish_im`;
CREATE DATABASE `fish_im` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `fish_im`;

DROP TABLE IF EXISTS `chat_friend`;
CREATE TABLE `chat_friend` (
  `id` int unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `group_id` int unsigned NOT NULL DEFAULT '0' COMMENT '分组id',
  `member_id` int unsigned NOT NULL DEFAULT '0' COMMENT '会员id',
  `member_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '会员名',
  `friend_id` int unsigned NOT NULL DEFAULT '0' COMMENT '好友id',
  `friend_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '好友名称',
  `create_time` int unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `delete_time` int unsigned NOT NULL DEFAULT '0' COMMENT '删除时间',
  `status` int NOT NULL DEFAULT '0' COMMENT '状态|0:正常,-1:删除',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC COMMENT='会员分组下的好友列表';

TRUNCATE `chat_friend`;
INSERT INTO `chat_friend` (`id`, `group_id`, `member_id`, `member_name`, `friend_id`, `friend_name`, `create_time`, `update_time`, `delete_time`, `status`) VALUES
(1,	0,	1,	'hepm',	4,	'lgt',	1733412491,	0,	0,	0),
(2,	0,	1,	'hepm',	4,	'lgt',	1733412549,	0,	0,	0),
(3,	6,	1,	'hepm',	4,	'lgt',	1733412604,	0,	0,	0),
(4,	6,	1,	'hepm',	4,	'lgt',	1733412763,	0,	0,	0),
(5,	6,	1,	'hepm',	4,	'lgt',	1733412796,	0,	0,	0),
(6,	6,	1,	'hepm',	4,	'lgt',	1733412827,	0,	0,	0),
(7,	6,	1,	'hepm',	4,	'lgt',	1733412854,	0,	0,	0),
(8,	6,	1,	'hepm',	4,	'lgt',	1733412887,	0,	0,	0),
(9,	6,	1,	'hepm',	4,	'lgt',	1733412915,	0,	0,	0),
(10,	6,	1,	'hepm',	4,	'lgt',	1733412944,	0,	0,	0),
(11,	6,	1,	'hepm',	4,	'lgt',	1733412974,	0,	0,	0),
(12,	6,	1,	'hepm',	4,	'lgt',	1733412998,	0,	0,	0),
(13,	6,	1,	'hepm',	4,	'lgt',	1733413028,	0,	0,	0),
(14,	6,	1,	'hepm',	4,	'lgt',	1733413054,	0,	0,	0),
(15,	6,	1,	'hepm',	4,	'lgt',	1733413350,	0,	0,	0);

DROP TABLE IF EXISTS `chat_friend_group`;
CREATE TABLE `chat_friend_group` (
  `id` int unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `member_id` int unsigned NOT NULL DEFAULT '0' COMMENT '会员id',
  `group_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '分组名称',
  `sign` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '签名',
  `weight` tinyint NOT NULL DEFAULT '0' COMMENT '好友分组排序 越小越前',
  `create_time` int NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int NOT NULL DEFAULT '0' COMMENT '更新时间',
  `delete_time` int NOT NULL DEFAULT '0' COMMENT '删除时间',
  `status` int NOT NULL DEFAULT '0' COMMENT '状态|0:正常,-1:删除',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC COMMENT='会员好友分组表';

TRUNCATE `chat_friend_group`;
INSERT INTO `chat_friend_group` (`id`, `member_id`, `group_name`, `sign`, `weight`, `create_time`, `update_time`, `delete_time`, `status`) VALUES
(1,	0,	'小鱼二手电脑',	'',	0,	1733395611,	0,	0,	-1),
(2,	0,	'小鱼之家',	'',	0,	1733395650,	0,	0,	0),
(3,	0,	'北京地铁',	'',	0,	1733395669,	0,	0,	0),
(4,	0,	'法外狂徒',	'',	0,	1733395989,	0,	0,	0),
(5,	0,	'奋斗比',	'',	0,	1733396201,	0,	0,	0),
(6,	0,	'北京',	'',	0,	1733398269,	0,	0,	0),
(7,	0,	'上海',	'',	0,	1733398332,	0,	0,	0),
(8,	0,	'上海',	'',	0,	1733398403,	0,	0,	0),
(9,	0,	'小鱼',	'',	0,	1733398431,	0,	0,	0);

DROP TABLE IF EXISTS `chat_group`;
CREATE TABLE `chat_group` (
  `id` int unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `account` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '群号',
  `group_name` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '群名称',
  `avatar` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '/static/images/pkq.png' COMMENT '群头像',
  `belong` varchar(255) COLLATE utf8mb4_general_ci NOT NULL DEFAULT '0' COMMENT '群主',
  `belong_id` int unsigned NOT NULL DEFAULT '0' COMMENT '群主id',
  `description` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '描述',
  `status` int NOT NULL DEFAULT '0' COMMENT '状态|0:正常,-1:全体禁言',
  `create_time` int unsigned NOT NULL DEFAULT '0' COMMENT '添加时间',
  `update_time` int unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `delete_time` int unsigned NOT NULL DEFAULT '0' COMMENT '删除时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC COMMENT='聊天群表';

TRUNCATE `chat_group`;
INSERT INTO `chat_group` (`id`, `account`, `group_name`, `avatar`, `belong`, `belong_id`, `description`, `status`, `create_time`, `update_time`, `delete_time`) VALUES
(1,	'动车动词',	'动车动词',	'/static/images/pkq.png',	'0',	0,	'动车动词',	0,	0,	0,	0),
(2,	'北京地铁',	'北京地铁',	'/static/images/pkq.png',	'北京地铁',	0,	'北京地铁',	-1,	0,	0,	0),
(3,	'小鱼二手111',	'小鱼二手111',	'/2024/12/05/1ed126e82ab2f78845685cb2cf6830b0.jpg',	'小鱼',	0,	'小鱼二手111',	0,	0,	0,	0),
(4,	'高中',	'高中',	'/2024/12/05/0f1e872ce4c6a6c24fa80853d11610cd.jpg',	'fish',	0,	'高中',	0,	0,	0,	0),
(5,	'大学',	'大学',	'/2024/12/05/34bf68f727b668683d784a12ab5c69e7.jpg',	'小鱼',	0,	'大学',	0,	0,	0,	0),
(6,	'饭醉团伙',	'饭醉团伙',	'/2024/12/05/5cc5d891042c235c003fc4cecba2d5ec.jpg',	'小鱼',	0,	'饭醉团伙',	0,	0,	0,	0);

DROP TABLE IF EXISTS `chat_group_member`;
CREATE TABLE `chat_group_member` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `group_id` int unsigned NOT NULL DEFAULT '0' COMMENT '群ID',
  `member_id` int unsigned NOT NULL DEFAULT '0' COMMENT '用户ID',
  `avatar` varchar(255) COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '用户头像',
  `addtime` int unsigned NOT NULL DEFAULT '0' COMMENT '加群时间',
  `type` tinyint unsigned NOT NULL DEFAULT '1' COMMENT '用户类型|0:群主,1:会员',
  `forbidden_speech_time` int unsigned NOT NULL DEFAULT '0' COMMENT '禁言到某个时间',
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '用户名',
  `sign` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '签名',
  `nickname` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '群员的群昵称',
  `status` tinyint NOT NULL DEFAULT '0' COMMENT '状态|0:正常,-1:群黑名单',
  `create_time` int unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `delete_time` int unsigned NOT NULL DEFAULT '0' COMMENT '删除时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC COMMENT='群员表';

TRUNCATE `chat_group_member`;

DROP TABLE IF EXISTS `chat_member`;
CREATE TABLE `chat_member` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `socket_id` int unsigned NOT NULL DEFAULT '0' COMMENT 'socket连接id',
  `username` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '账号',
  `password` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '密码',
  `salt` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '密码盐',
  `nickname` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '匿名' COMMENT '昵称',
  `avatar` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '/static/images/pkq.png' COMMENT '头像',
  `signature` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '签名',
  `status` tinyint NOT NULL DEFAULT '1' COMMENT '在线状态|0:在线,1:下线,2:隐身,-1:删除',
  `delete_status` tinyint NOT NULL COMMENT '状态|0:正常,-1:删除',
  `login_time` int unsigned NOT NULL DEFAULT '0' COMMENT '上次登录时间',
  `create_time` int unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int unsigned DEFAULT '0' COMMENT '修改时间',
  `delete_time` int unsigned DEFAULT '0' COMMENT '删除时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC COMMENT='会员表';

TRUNCATE `chat_member`;
INSERT INTO `chat_member` (`id`, `socket_id`, `username`, `password`, `salt`, `nickname`, `avatar`, `signature`, `status`, `delete_status`, `login_time`, `create_time`, `update_time`, `delete_time`) VALUES
(1,	8,	'hepm',	'ae7f3b2aa2da8ab21fc52f97b0c960e5',	'mAgSCL',	'hepm',	'/2024/12/05/f0ae2f70ff77720b457a4e8e54858901.jpg',	'',	0,	0,	0,	1733361750,	1733362749,	0),
(2,	9,	'fish',	'aaa455c43c74542c3de43bc53ca64025',	'jek6rO',	'fish',	'/2024/12/05/6754a011395cffd2a0ff2e872f394bc1.jpg',	'',	0,	0,	0,	1733362767,	0,	0),
(3,	0,	'pink',	'8ce40e40da8f3f4c5612e67356e5c621',	'SZzI6C',	'pink',	'/2024/12/05/f942f64553eef272e28f6fec8af8c1aa.jpg',	'',	0,	0,	0,	1733362799,	0,	0),
(4,	0,	'lgt',	'c005d444425342597089c48cc31d42c8',	'qdtHea',	'老骨头啊',	'/2024/12/05/f0ae2f70ff77720b457a4e8e54858901.jpg',	'',	0,	0,	0,	1733411492,	0,	0);

DROP TABLE IF EXISTS `chat_msgbox`;
CREATE TABLE `chat_msgbox` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `from_id` int unsigned NOT NULL DEFAULT '0' COMMENT '消息发送者id',
  `to_id` int unsigned NOT NULL DEFAULT '0' COMMENT '消息接收者id',
  `from_username` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '消息发送者',
  `to_username` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '消息接收者',
  `type` tinyint unsigned NOT NULL DEFAULT '0' COMMENT '消息类型|0:请求添加用户,1:系统消息(加好友) ,2:请求加群,3:系统消息(加群)',
  `status` tinyint unsigned NOT NULL DEFAULT '0' COMMENT '状态|0:待处理,1:同意,2:拒绝,3:无须处理',
  `remark` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT '' COMMENT '附加消息',
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '信息备注',
  `friend_group_id` int DEFAULT '0' COMMENT '好友分组ID',
  `group_id` int DEFAULT '0' COMMENT '群ID',
  `send_time` int unsigned NOT NULL DEFAULT '0' COMMENT '发送消息时间',
  `read_time` int unsigned DEFAULT '0' COMMENT '读消息时间',
  `create_time` int unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int unsigned DEFAULT '0' COMMENT '修改时间',
  `delete_time` int unsigned DEFAULT '0' COMMENT '删除时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC COMMENT='消息表';

TRUNCATE `chat_msgbox`;
INSERT INTO `chat_msgbox` (`id`, `from_id`, `to_id`, `from_username`, `to_username`, `type`, `status`, `remark`, `content`, `friend_group_id`, `group_id`, `send_time`, `read_time`, `create_time`, `update_time`, `delete_time`) VALUES
(1,	1,	4,	'hepm',	'用户6011',	0,	1,	'宇宙之神小明的请求',	'',	0,	2,	1733407061,	1733413350,	1733407061,	1733413350,	0),
(2,	1,	1,	'hepm',	'用户6011',	0,	0,	'111',	'',	0,	8,	1733407115,	0,	1733407115,	0,	0),
(3,	1,	2,	'hepm',	'fish',	0,	0,	'11111',	'',	0,	6,	1733407261,	0,	1733407261,	0,	0),
(4,	1,	2,	'hepm',	'fish',	0,	0,	'1111',	'',	0,	4,	1733407321,	0,	1733407321,	0,	0),
(5,	1,	2,	'hepm',	'fish',	0,	0,	'1111',	'',	0,	6,	1733407421,	0,	1733407421,	0,	0),
(6,	1,	2,	'hepm',	'fish',	0,	0,	'啊啊',	'',	0,	2,	1733407478,	0,	1733407478,	0,	0),
(7,	1,	2,	'hepm',	'fish',	0,	0,	'啊啊',	'',	0,	2,	1733407491,	0,	1733407491,	0,	0),
(8,	1,	2,	'hepm',	'fish',	0,	0,	'啊啊啊啊',	'',	0,	5,	1733407516,	0,	1733407516,	0,	0),
(9,	1,	2,	'hepm',	'fish',	0,	0,	'啊啊啊啊',	'',	0,	5,	1733407566,	0,	1733407566,	0,	0),
(10,	1,	2,	'hepm',	'fish',	0,	0,	'啊啊啊啊',	'',	0,	5,	1733407581,	0,	1733407581,	0,	0),
(11,	1,	2,	'hepm',	'fish',	0,	0,	'1111111111111',	'',	0,	8,	1733407629,	0,	1733407629,	0,	0),
(12,	1,	2,	'hepm',	'fish',	0,	0,	'1111111111111',	'',	0,	8,	1733407634,	0,	1733407634,	0,	0),
(13,	1,	2,	'hepm',	'fish',	0,	0,	'1111111111111111',	'',	0,	8,	1733407643,	0,	1733407643,	0,	0),
(14,	1,	2,	'hepm',	'fish',	0,	0,	'11111',	'',	0,	7,	1733407718,	0,	1733407718,	0,	0),
(15,	1,	2,	'hepm',	'fish',	0,	0,	'ddddddddddddddd',	'',	0,	7,	1733408508,	0,	1733408508,	0,	0),
(16,	1,	4,	'hepm',	'lgt',	0,	0,	'1111',	'',	0,	6,	1733411648,	0,	1733411648,	0,	0),
(17,	1,	4,	'hepm',	'lgt',	0,	0,	'',	'',	0,	1,	1733413381,	0,	1733413381,	0,	0),
(18,	1,	4,	'hepm',	'lgt',	0,	0,	'',	'',	0,	1,	1733413393,	0,	1733413393,	0,	0);

DROP TABLE IF EXISTS `chat_record`;
CREATE TABLE `chat_record` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `from_id` int unsigned NOT NULL DEFAULT '0' COMMENT '发送者id',
  `to_id` int unsigned NOT NULL DEFAULT '0' COMMENT '接收者id',
  `from_username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '0' COMMENT '消息发送者id',
  `to_username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '0' COMMENT '消息接收者id',
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '发送内容',
  `type` tinyint unsigned NOT NULL DEFAULT '0' COMMENT '聊天类型',
  `send_time` int unsigned NOT NULL DEFAULT '0' COMMENT '发送时间',
  `create_time` int unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `delete_time` int unsigned NOT NULL DEFAULT '0' COMMENT '删除时间',
  `status` tinyint NOT NULL DEFAULT '0' COMMENT '状态|0:正常,-1:删除',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `send` (`from_id`) USING BTREE,
  KEY `receive` (`to_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC COMMENT='聊天记录表';

TRUNCATE `chat_record`;
INSERT INTO `chat_record` (`id`, `from_id`, `to_id`, `from_username`, `to_username`, `content`, `type`, `send_time`, `create_time`, `update_time`, `delete_time`, `status`) VALUES
(1,	1,	2,	'hepm',	'fish',	'很好很强大2024-11-10 22:29:49',	1,	1733362864,	1733362864,	0,	0,	0),
(2,	2,	1,	'fish',	'hepm',	'很好很强大2024-11-10 22:29:49',	1,	1733362875,	1733362875,	0,	0,	0),
(3,	1,	2,	'hepm',	'fish',	'很好很强大2024-11-10 22:29:49',	1,	1733362884,	1733362884,	0,	0,	0),
(4,	2,	1,	'fish',	'hepm',	'很好很强大2024-11-10 22:29:49',	1,	1733362892,	1733362892,	0,	0,	0),
(5,	1,	2,	'hepm',	'fish',	'很好很强大2024-11-10 22:29:49',	1,	1733362932,	1733362932,	0,	0,	0),
(6,	2,	1,	'fish',	'hepm',	'很好很强大2024-11-10 22:29:49',	1,	1733362940,	1733362940,	0,	0,	0),
(7,	1,	2,	'hepm',	'fish',	'很好很强大2024-11-10 22:29:49',	1,	1733362954,	1733362954,	0,	0,	0),
(8,	2,	1,	'fish',	'hepm',	'很好很强大2024-11-10 22:29:49',	1,	1733363051,	1733363051,	0,	0,	0),
(9,	1,	2,	'hepm',	'fish',	'很好很强大2024-11-10 22:29:49',	1,	1733363059,	1733363059,	0,	0,	0),
(10,	1,	2,	'hepm',	'fish',	'很好很强大2024-11-10 22:29:49',	1,	1733363091,	1733363091,	0,	0,	0),
(11,	2,	1,	'fish',	'hepm',	'很好很强大2024-11-10 22:29:49',	1,	1733363097,	1733363097,	0,	0,	0),
(12,	1,	2,	'hepm',	'fish',	'很好很强大2024-11-10 22:29:49',	1,	1733363135,	1733363135,	0,	0,	0),
(13,	2,	1,	'fish',	'hepm',	'很好很强大2024-11-10 22:29:49',	1,	1733363139,	1733363139,	0,	0,	0),
(14,	2,	1,	'fish',	'hepm',	'很好很强大2024-11-10 22:29:49',	1,	1733363174,	1733363174,	0,	0,	0),
(15,	1,	2,	'hepm',	'fish',	'很好很强大2024-11-10 22:29:49',	1,	1733363231,	1733363231,	0,	0,	0),
(16,	2,	1,	'fish',	'hepm',	'很好很强大2024-11-10 22:29:49',	1,	1733363236,	1733363236,	0,	0,	0),
(17,	1,	2,	'hepm',	'fish',	'很好很强大2024-11-10 22:29:49',	1,	1733363268,	1733363268,	0,	0,	0),
(18,	2,	1,	'fish',	'hepm',	'很好很强大2024-11-10 22:29:49',	1,	1733363276,	1733363276,	0,	0,	0),
(19,	2,	1,	'fish',	'hepm',	'很好很强大2024-11-10 22:29:49',	1,	1733363280,	1733363280,	0,	0,	0),
(20,	2,	1,	'fish',	'hepm',	'很好很强大2024-11-10 22:29:49',	1,	1733363324,	1733363324,	0,	0,	0),
(21,	2,	1,	'fish',	'hepm',	'很好很强大2024-11-10 22:29:49',	1,	1733363331,	1733363331,	0,	0,	0),
(22,	1,	2,	'hepm',	'fish',	'很好很强大2024-11-10 22:29:49',	1,	1733363358,	1733363358,	0,	0,	0),
(23,	2,	1,	'fish',	'hepm',	'很好很强大2024-11-10 22:29:49',	1,	1733363831,	1733363831,	0,	0,	0),
(24,	1,	2,	'hepm',	'fish',	'很好很强大2024-11-10 22:29:49',	1,	1733363881,	1733363881,	0,	0,	0),
(25,	2,	1,	'fish',	'hepm',	'很好很强大2024-11-10 22:29:49',	1,	1733363902,	1733363902,	0,	0,	0),
(26,	1,	2,	'hepm',	'fish',	'很好很强大2024-11-10 22:29:49',	1,	1733363917,	1733363917,	0,	0,	0),
(27,	1,	2,	'hepm',	'fish',	'很好很强大2024-11-10 22:29:49',	1,	1733363941,	1733363941,	0,	0,	0),
(28,	1,	2,	'hepm',	'fish',	'很好很强大2024-11-10 22:29:49',	1,	1733364067,	1733364067,	0,	0,	0),
(29,	2,	1,	'fish',	'hepm',	'很好很强大2024-11-10 22:29:49',	1,	1733364214,	1733364214,	0,	0,	0),
(30,	2,	1,	'fish',	'hepm',	'face[疑问] ',	1,	1733364352,	1733364352,	0,	0,	0),
(31,	1,	2,	'hepm',	'fish',	'face[猪头] ',	1,	1733364358,	1733364358,	0,	0,	0),
(32,	2,	1,	'fish',	'hepm',	'face[哼] ',	1,	1733364365,	1733364365,	0,	0,	0),
(33,	1,	2,	'hepm',	'fish',	'1111',	1,	1733364699,	1733364699,	0,	0,	0),
(34,	2,	1,	'fish',	'hepm',	'face[抱抱] ',	1,	1733364706,	1733364706,	0,	0,	0),
(35,	2,	1,	'fish',	'hepm',	'我是鱼 啊',	1,	1733364732,	1733364732,	0,	0,	0),
(36,	2,	1,	'fish',	'hepm',	'111',	1,	1733364789,	1733364789,	0,	0,	0),
(37,	2,	1,	'fish',	'hepm',	'我是鱼啊 小明',	1,	1733364799,	1733364799,	0,	0,	0),
(38,	1,	2,	'hepm',	'fish',	'我是周身',	1,	1733364829,	1733364829,	0,	0,	0),
(39,	2,	1,	'fish',	'hepm',	'钉钉',	1,	1733364835,	1733364835,	0,	0,	0),
(40,	2,	1,	'fish',	'hepm',	'我是鱼',	1,	1733364861,	1733364861,	0,	0,	0),
(41,	1,	2,	'hepm',	'fish',	'我是宇宙之神',	1,	1733365016,	1733365016,	0,	0,	0),
(42,	2,	1,	'fish',	'hepm',	'我是鱼啊',	1,	1733365021,	1733365021,	0,	0,	0),
(43,	2,	1,	'fish',	'hepm',	'啊啊啊',	1,	1733365131,	1733365131,	0,	0,	0),
(44,	2,	1,	'fish',	'hepm',	'1',	1,	1733365163,	1733365163,	0,	0,	0),
(45,	1,	2,	'hepm',	'fish',	'2',	1,	1733365177,	1733365177,	0,	0,	0),
(46,	2,	1,	'fish',	'hepm',	'1',	1,	1733365182,	1733365182,	0,	0,	0),
(47,	2,	1,	'fish',	'hepm',	'我是鱼啊宇宙之神',	1,	1733365519,	1733365519,	0,	0,	0),
(48,	2,	1,	'fish',	'hepm',	'我是鱼啊宇宙之神',	1,	1733365681,	1733365681,	0,	0,	0),
(49,	1,	2,	'hepm',	'fish',	'face[熊猫] ',	1,	1733365687,	1733365687,	0,	0,	0),
(50,	2,	1,	'fish',	'hepm',	'我是鱼啊宇宙之神',	1,	1733365690,	1733365690,	0,	0,	0),
(51,	2,	1,	'fish',	'hepm',	'我是鱼啊宇宙之神啊小明',	1,	1733366016,	1733366016,	0,	0,	0),
(52,	1,	2,	'hepm',	'fish',	'face[哼] ',	1,	1733366022,	1733366022,	0,	0,	0),
(53,	2,	1,	'fish',	'hepm',	'我是鱼啊宇宙之神啊小明',	1,	1733366029,	1733366029,	0,	0,	0),
(54,	2,	1,	'fish',	'hepm',	'我是鱼啊宇宙之神啊小明',	1,	1733366480,	1733366480,	0,	0,	0),
(55,	1,	2,	'hepm',	'fish',	'face[色] ',	1,	1733366488,	1733366488,	0,	0,	0),
(56,	2,	1,	'fish',	'hepm',	'我是鱼啊宇宙之神啊小明',	1,	1733366492,	1733366492,	0,	0,	0),
(57,	1,	2,	'hepm',	'fish',	'face[色] ',	1,	1733366541,	1733366541,	0,	0,	0),
(58,	2,	1,	'fish',	'hepm',	'1111111111111',	1,	1733366550,	1733366550,	0,	0,	0),
(59,	1,	2,	'hepm',	'fish',	'a ',	1,	1733366568,	1733366568,	0,	0,	0),
(60,	1,	2,	'hepm',	'fish',	'face[猪头] ',	1,	1733366654,	1733366654,	0,	0,	0),
(61,	2,	1,	'fish',	'hepm',	'我是鱼啊宇宙之神啊小明',	1,	1733366665,	1733366665,	0,	0,	0),
(62,	1,	2,	'hepm',	'fish',	'face[色]  我是宇宙之神啊 fish',	1,	1733366681,	1733366681,	0,	0,	0),
(63,	1,	1,	'hepm',	'hepm',	'face[馋嘴] ',	1,	1733366710,	1733366710,	0,	0,	0),
(64,	2,	1,	'fish',	'hepm',	'我是鱼啊宇宙之神啊小明',	1,	1733366726,	1733366726,	0,	0,	0),
(65,	2,	1,	'fish',	'hepm',	'我是鱼啊宇宙之神啊小明',	1,	1733366740,	1733366740,	0,	0,	0),
(66,	2,	1,	'fish',	'hepm',	'我是鱼啊宇宙之神啊小明',	1,	1733366759,	1733366759,	0,	0,	0),
(67,	1,	2,	'hepm',	'fish',	'[色] 我是宇宙之神啊 fish\n',	1,	1733366772,	1733366772,	0,	0,	0),
(68,	2,	1,	'fish',	'hepm',	'111',	1,	1733366779,	1733366779,	0,	0,	0),
(69,	2,	1,	'fish',	'hepm',	'很好 明天见',	1,	1733366788,	1733366788,	0,	0,	0),
(70,	1,	2,	'hepm',	'fish',	'face[嘻嘻] face[嘻嘻] 我是宇宙之神啊 fish\n',	1,	1733366903,	1733366903,	0,	0,	0),
(71,	2,	1,	'fish',	'hepm',	'我是鱼啊宇宙之神啊小明',	1,	1733366918,	1733366918,	0,	0,	0),
(72,	1,	2,	'hepm',	'fish',	'我是宇宙之神啊 小鱼',	1,	1733366931,	1733366931,	0,	0,	0),
(73,	1,	2,	'hepm',	'fish',	'我是宇宙之神啊 小鱼\n',	1,	1733367439,	1733367439,	0,	0,	0),
(74,	1,	1,	'hepm',	'hepm',	'face[嘻嘻] ',	1,	1733367453,	1733367453,	0,	0,	0),
(75,	1,	2,	'hepm',	'fish',	'我是宇宙之神啊 小鱼\n',	1,	1733367460,	1733367460,	0,	0,	0),
(76,	1,	2,	'hepm',	'fish',	'1111',	1,	1733367499,	1733367499,	0,	0,	0),
(77,	1,	1,	'hepm',	'hepm',	'11111',	1,	1733367505,	1733367505,	0,	0,	0),
(78,	1,	2,	'hepm',	'fish',	'dddd',	1,	1733367536,	1733367536,	0,	0,	0),
(79,	1,	1,	'hepm',	'hepm',	'aaa',	1,	1733367543,	1733367543,	0,	0,	0),
(80,	1,	2,	'hepm',	'fish',	'dddd',	1,	1733367550,	1733367550,	0,	0,	0),
(81,	1,	2,	'hepm',	'fish',	'1111',	1,	1733367559,	1733367559,	0,	0,	0),
(82,	1,	1,	'hepm',	'hepm',	'a',	1,	1733367603,	1733367603,	0,	0,	0),
(83,	1,	2,	'hepm',	'fish',	'a',	1,	1733367607,	1733367607,	0,	0,	0),
(84,	1,	2,	'hepm',	'fish',	'd ',	1,	1733367610,	1733367610,	0,	0,	0),
(85,	1,	1,	'hepm',	'hepm',	'aaaa',	1,	1733367616,	1733367616,	0,	0,	0),
(86,	1,	1,	'hepm',	'hepm',	'aa',	1,	1733367655,	1733367655,	0,	0,	0),
(87,	1,	1,	'hepm',	'hepm',	'a',	1,	1733367684,	1733367684,	0,	0,	0),
(88,	1,	1,	'hepm',	'hepm',	'a',	1,	1733367695,	1733367695,	0,	0,	0),
(89,	1,	2,	'hepm',	'fish',	'aa',	1,	1733367701,	1733367701,	0,	0,	0),
(90,	1,	1,	'hepm',	'hepm',	'aaa',	1,	1733367707,	1733367707,	0,	0,	0),
(91,	1,	1,	'hepm',	'hepm',	'aaa',	1,	1733367731,	1733367731,	0,	0,	0),
(92,	1,	2,	'hepm',	'fish',	'aaaa',	1,	1733367735,	1733367735,	0,	0,	0),
(93,	1,	1,	'hepm',	'hepm',	'111',	1,	1733367743,	1733367743,	0,	0,	0),
(94,	1,	1,	'hepm',	'hepm',	'aaa',	1,	1733367795,	1733367795,	0,	0,	0),
(95,	1,	1,	'hepm',	'hepm',	'1111',	1,	1733367803,	1733367803,	0,	0,	0),
(96,	1,	2,	'hepm',	'fish',	'aaa',	1,	1733367809,	1733367809,	0,	0,	0),
(97,	1,	1,	'hepm',	'hepm',	'11',	1,	1733367823,	1733367823,	0,	0,	0),
(98,	1,	1,	'hepm',	'hepm',	'1',	1,	1733367830,	1733367830,	0,	0,	0),
(99,	1,	2,	'hepm',	'fish',	'1',	1,	1733367851,	1733367851,	0,	0,	0),
(100,	1,	1,	'hepm',	'hepm',	'111',	1,	1733367863,	1733367863,	0,	0,	0),
(101,	1,	1,	'hepm',	'hepm',	'1',	1,	1733367884,	1733367884,	0,	0,	0),
(102,	1,	1,	'hepm',	'hepm',	'1',	1,	1733367942,	1733367942,	0,	0,	0),
(103,	1,	1,	'hepm',	'hepm',	'1',	1,	1733367964,	1733367964,	0,	0,	0),
(104,	1,	1,	'hepm',	'hepm',	'1',	1,	1733368053,	1733368053,	0,	0,	0),
(105,	1,	2,	'hepm',	'fish',	'1',	1,	1733368129,	1733368129,	0,	0,	0),
(106,	2,	1,	'fish',	'hepm',	'我是鱼啊 宇宙之神',	1,	1733368420,	1733368420,	0,	0,	0),
(107,	1,	2,	'hepm',	'fish',	'我是小明',	1,	1733368433,	1733368433,	0,	0,	0),
(108,	2,	1,	'fish',	'hepm',	'我是宇宙之神',	1,	1733368443,	1733368443,	0,	0,	0),
(109,	1,	2,	'hepm',	'fish',	'你大爷的 还挺牛啊',	1,	1733368458,	1733368458,	0,	0,	0),
(110,	2,	1,	'fish',	'hepm',	'face[奥特曼] ',	1,	1733368465,	1733368465,	0,	0,	0),
(111,	1,	2,	'hepm',	'fish',	'face[嘻嘻] ',	1,	1733368472,	1733368472,	0,	0,	0),
(112,	1,	2,	'hepm',	'fish',	'1',	1,	1733385370,	1733385370,	0,	0,	0),
(113,	1,	1,	'hepm',	'hepm',	'1',	1,	1733385376,	1733385376,	0,	0,	0),
(114,	1,	2,	'hepm',	'fish',	'111',	1,	1733385379,	1733385379,	0,	0,	0),
(115,	1,	2,	'hepm',	'fish',	'1',	1,	1733385387,	1733385387,	0,	0,	0),
(116,	1,	1,	'hepm',	'hepm',	'1111',	1,	1733385391,	1733385391,	0,	0,	0),
(117,	2,	1,	'fish',	'hepm',	'111',	1,	1733385406,	1733385406,	0,	0,	0),
(118,	1,	2,	'hepm',	'fish',	'11',	1,	1733385411,	1733385411,	0,	0,	0),
(119,	2,	1,	'fish',	'hepm',	'dddd',	1,	1733385416,	1733385416,	0,	0,	0),
(120,	2,	1,	'fish',	'hepm',	'1111',	1,	1733385442,	1733385442,	0,	0,	0),
(121,	2,	1,	'fish',	'hepm',	'ddd',	1,	1733385466,	1733385466,	0,	0,	0),
(122,	1,	2,	'hepm',	'fish',	'dddddddddddd',	1,	1733385472,	1733385472,	0,	0,	0),
(123,	2,	1,	'fish',	'hepm',	'dddd',	1,	1733385476,	1733385476,	0,	0,	0),
(124,	1,	2,	'hepm',	'fish',	'dddd',	1,	1733385481,	1733385481,	0,	0,	0),
(125,	2,	1,	'fish',	'hepm',	'aaa',	1,	1733385490,	1733385490,	0,	0,	0),
(126,	1,	2,	'hepm',	'fish',	'aaaa',	1,	1733385501,	1733385501,	0,	0,	0),
(127,	1,	2,	'hepm',	'fish',	'1111',	1,	1733385573,	1733385573,	0,	0,	0),
(128,	2,	2,	'fish',	'fish',	'1111',	1,	1733385579,	1733385579,	0,	0,	0),
(129,	2,	1,	'fish',	'hepm',	'我是鱼啊 好久不见',	1,	1733385588,	1733385588,	0,	0,	0),
(130,	2,	1,	'fish',	'hepm',	'1',	1,	1733385642,	1733385642,	0,	0,	0),
(131,	1,	2,	'hepm',	'fish',	'1',	1,	1733385651,	1733385651,	0,	0,	0),
(132,	2,	1,	'fish',	'hepm',	'ddd',	1,	1733385659,	1733385659,	0,	0,	0),
(133,	1,	2,	'hepm',	'fish',	'111',	1,	1733385691,	1733385691,	0,	0,	0),
(134,	2,	1,	'fish',	'hepm',	'dd',	1,	1733385695,	1733385695,	0,	0,	0),
(135,	2,	1,	'fish',	'hepm',	'ddddd',	1,	1733385701,	1733385701,	0,	0,	0),
(136,	1,	2,	'hepm',	'fish',	'',	0,	1733407421,	1733407421,	0,	0,	0),
(137,	1,	2,	'hepm',	'fish',	'',	0,	1733407478,	1733407478,	0,	0,	0),
(138,	2,	1,	'fish',	'hepm',	'111',	1,	1733407486,	1733407486,	0,	0,	0),
(139,	1,	2,	'hepm',	'fish',	'',	0,	1733407492,	1733407492,	0,	0,	0),
(140,	1,	2,	'hepm',	'fish',	'11111',	1,	1733407504,	1733407504,	0,	0,	0),
(141,	2,	1,	'fish',	'hepm',	'1111',	1,	1733407508,	1733407508,	0,	0,	0),
(142,	1,	2,	'hepm',	'fish',	'',	0,	1733407516,	1733407516,	0,	0,	0),
(143,	1,	2,	'hepm',	'fish',	'',	0,	1733407566,	1733407566,	0,	0,	0),
(144,	1,	2,	'hepm',	'fish',	'',	0,	1733407581,	1733407581,	0,	0,	0),
(145,	1,	2,	'hepm',	'fish',	'',	0,	1733407629,	1733407629,	0,	0,	0),
(146,	1,	2,	'hepm',	'fish',	'',	0,	1733407634,	1733407634,	0,	0,	0),
(147,	1,	2,	'hepm',	'fish',	'',	0,	1733407644,	1733407644,	0,	0,	0),
(148,	1,	2,	'hepm',	'fish',	'',	0,	1733407718,	1733407718,	0,	0,	0),
(149,	2,	1,	'fish',	'hepm',	'22222',	1,	1733408441,	1733408441,	0,	0,	0),
(150,	1,	1,	'hepm',	'hepm',	'111111',	1,	1733408445,	1733408445,	0,	0,	0),
(151,	2,	1,	'fish',	'hepm',	'111111',	1,	1733408453,	1733408453,	0,	0,	0),
(152,	1,	1,	'hepm',	'hepm',	'2222222',	1,	1733408460,	1733408460,	0,	0,	0),
(153,	1,	2,	'hepm',	'fish',	'1t2',	1,	1733408482,	1733408482,	0,	0,	0),
(154,	2,	1,	'fish',	'hepm',	'2t1',	1,	1733408491,	1733408491,	0,	0,	0),
(155,	1,	2,	'hepm',	'fish',	'1-2',	1,	1733408496,	1733408496,	0,	0,	0),
(156,	2,	1,	'fish',	'hepm',	'2-1',	1,	1733408500,	1733408500,	0,	0,	0),
(157,	1,	2,	'hepm',	'fish',	'',	0,	1733408508,	1733408508,	0,	0,	0),
(158,	1,	4,	'hepm',	'lgt',	'',	0,	1733411648,	1733411648,	0,	0,	0),
(159,	1,	4,	'hepm',	'lgt',	'',	0,	1733413381,	1733413381,	0,	0,	0),
(160,	1,	4,	'hepm',	'lgt',	'',	0,	1733413393,	1733413393,	0,	0,	0);

DROP TABLE IF EXISTS `chat_skin`;
CREATE TABLE `chat_skin` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `member_id` int unsigned NOT NULL COMMENT '会员id',
  `filename` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '皮肤文件名',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_time` timestamp NULL DEFAULT NULL,
  `delete_time` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC COMMENT='皮肤表';

TRUNCATE `chat_skin`;

-- 2024-12-05 15:43:59
