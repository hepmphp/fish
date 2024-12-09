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
(15,	6,	1,	'hepm',	4,	'lgt',	1733413350,	0,	0,	0),
(16,	5,	1,	'hepm',	0,	'0',	1733422975,	0,	0,	0),
(17,	5,	1,	'hepm',	0,	'0',	1733442235,	0,	0,	0),
(18,	5,	1,	'hepm',	0,	'0',	1733442245,	0,	0,	0),
(19,	2,	1,	'hepm',	0,	'用户6011',	1733446075,	0,	0,	0),
(20,	2,	1,	'hepm',	0,	'用户6011',	1733446078,	0,	0,	0),
(21,	2,	1,	'hepm',	0,	'用户6011',	1733446116,	0,	0,	0),
(22,	2,	1,	'hepm',	0,	'用户6011',	1733446170,	0,	0,	0),
(23,	2,	1,	'hepm',	0,	'用户6011',	1733446200,	0,	0,	0),
(24,	2,	1,	'hepm',	0,	'用户6011',	1733446215,	0,	0,	0),
(25,	2,	1,	'hepm',	0,	'用户6011',	1733446230,	0,	0,	0),
(26,	2,	1,	'hepm',	0,	'用户6011',	1733446255,	0,	0,	0),
(27,	2,	1,	'hepm',	0,	'用户6011',	1733446278,	0,	0,	0),
(28,	2,	1,	'hepm',	0,	'用户6011',	1733446404,	0,	0,	0),
(29,	2,	1,	'hepm',	0,	'用户6011',	1733446409,	0,	0,	0),
(30,	8,	1,	'hepm',	1,	'用户6011',	1733446447,	0,	0,	0),
(31,	6,	1,	'hepm',	2,	'fish',	1733446466,	0,	0,	0),
(32,	8,	1,	'hepm',	1,	'用户6011',	1733446564,	0,	0,	0),
(33,	8,	1,	'hepm',	1,	'用户6011',	1733446610,	0,	0,	0),
(34,	8,	1,	'hepm',	1,	'用户6011',	1733446702,	0,	0,	0),
(35,	2,	1,	'hepm',	2,	'fish',	1733617827,	0,	0,	0),
(36,	2,	1,	'hepm',	2,	'fish',	1733619491,	0,	0,	0),
(37,	2,	1,	'hepm',	2,	'fish',	1733619491,	0,	0,	0),
(38,	2,	1,	'hepm',	2,	'fish',	1733619491,	0,	0,	0),
(39,	2,	1,	'hepm',	2,	'fish',	1733619491,	0,	0,	0),
(40,	2,	1,	'hepm',	4,	'老骨头啊',	1733638293,	0,	0,	0),
(41,	2,	1,	'hepm',	4,	'老骨头啊',	1733638316,	0,	0,	0),
(42,	2,	1,	'hepm',	2,	'fish',	1733642111,	0,	0,	0),
(43,	2,	1,	'hepm',	4,	'老骨头啊',	1733642116,	0,	0,	0),
(44,	2,	1,	'hepm',	3,	'pink',	1733642120,	0,	0,	0),
(45,	2,	1,	'hepm',	3,	'pink',	1733642125,	0,	0,	0),
(46,	2,	1,	'hepm',	2,	'fish',	1733718592,	0,	0,	0);

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
(1,	'饭醉团伙	',	'饭醉团伙',	'/2024/12/05/5cc5d891042c235c003fc4cecba2d5ec.jpg	',	'0',	1,	'动车动词',	0,	0,	0,	0),
(2,	'北京地铁',	'北京地铁',	'/static/images/pkq.png',	'北京地铁',	1,	'北京地铁',	-1,	0,	0,	0),
(3,	'小鱼二手111',	'小鱼二手111',	'/2024/12/05/1ed126e82ab2f78845685cb2cf6830b0.jpg',	'小鱼',	1,	'小鱼二手111',	0,	0,	0,	0),
(4,	'高中',	'高中',	'/2024/12/05/0f1e872ce4c6a6c24fa80853d11610cd.jpg',	'fish',	1,	'高中',	0,	0,	0,	0),
(5,	'大学',	'大学',	'/2024/12/05/34bf68f727b668683d784a12ab5c69e7.jpg',	'小鱼',	1,	'大学',	0,	0,	0,	0),
(6,	'饭醉团伙',	'饭醉团伙',	'/2024/12/09/4683778b82b37b60d96fad7a63f5b6bb.jpg',	'小鱼',	1,	'饭醉团伙',	0,	0,	0,	0),
(7,	'何氏军团',	'何氏军团',	'/2024/12/09/0209922e777a0fd279f7bb6126d40fbb.jpg',	'何氏军团',	0,	'何氏军团',	0,	0,	0,	0);

DROP TABLE IF EXISTS `chat_group_member`;
CREATE TABLE `chat_group_member` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `group_id` int unsigned NOT NULL DEFAULT '0' COMMENT '群ID',
  `member_id` int unsigned NOT NULL DEFAULT '0' COMMENT '用户ID',
  `avatar` varchar(255) COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '用户头像',
  `type` tinyint unsigned NOT NULL DEFAULT '1' COMMENT '用户类型|0:群主,1:会员',
  `forbidden_speech_time` int unsigned NOT NULL DEFAULT '0' COMMENT '禁言到某个时间',
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '用户名',
  `sign` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '签名',
  `nickname` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '群员的群昵称',
  `status` tinyint NOT NULL DEFAULT '0' COMMENT '状态|0:正常,-1:群黑名单',
  `create_time` int unsigned NOT NULL DEFAULT '0' COMMENT '加群时间',
  `update_time` int unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `delete_time` int unsigned NOT NULL DEFAULT '0' COMMENT '删除时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC COMMENT='群员表';

TRUNCATE `chat_group_member`;
INSERT INTO `chat_group_member` (`id`, `group_id`, `member_id`, `avatar`, `type`, `forbidden_speech_time`, `username`, `sign`, `nickname`, `status`, `create_time`, `update_time`, `delete_time`) VALUES
(45,	6,	1,	'',	0,	0,	'hepm',	'',	'',	0,	1733639179,	0,	0),
(46,	6,	1,	'',	0,	0,	'hepm',	'',	'',	0,	1733639208,	0,	0),
(47,	6,	2,	'',	1,	0,	'fish',	'',	'',	0,	1733642820,	0,	0),
(48,	6,	1,	'',	0,	0,	'hepm',	'',	'',	0,	1733642823,	0,	0),
(49,	6,	3,	'',	1,	0,	'pink',	'',	'',	0,	1733646475,	0,	0),
(50,	6,	0,	'',	1,	0,	'0',	'',	'',	0,	1733722037,	0,	0);

DROP TABLE IF EXISTS `chat_member`;
CREATE TABLE `chat_member` (
  `id` int unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `socket_id` int unsigned NOT NULL DEFAULT '0' COMMENT 'socket连接id',
  `username` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '账号',
  `password` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '密码',
  `salt` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '密码盐',
  `nickname` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '匿名' COMMENT '昵称',
  `avatar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '/static/images/pkq.png' COMMENT '头像',
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
(1,	33,	'hepm',	'ae7f3b2aa2da8ab21fc52f97b0c960e5',	'mAgSCL',	'hepm',	'/2024/12/05/f0ae2f70ff77720b457a4e8e54858901.jpg',	'',	0,	0,	0,	1733361750,	1733362749,	0),
(2,	16,	'fish',	'aaa455c43c74542c3de43bc53ca64025',	'jek6rO',	'fish',	'/2024/12/05/6754a011395cffd2a0ff2e872f394bc1.jpg',	'',	0,	0,	0,	1733362767,	0,	0),
(3,	0,	'pink',	'8ce40e40da8f3f4c5612e67356e5c621',	'SZzI6C',	'pink',	'/2024/12/05/f942f64553eef272e28f6fec8af8c1aa.jpg',	'',	0,	0,	0,	1733362799,	0,	0),
(4,	0,	'lgt',	'c005d444425342597089c48cc31d42c8',	'qdtHea',	'老骨头啊',	'/2024/12/05/f0ae2f70ff77720b457a4e8e54858901.jpg',	'',	0,	0,	0,	1733411492,	0,	0);

DROP TABLE IF EXISTS `chat_msgbox`;
CREATE TABLE `chat_msgbox` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `avatar` varchar(255) COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '用户头像',
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
INSERT INTO `chat_msgbox` (`id`, `avatar`, `from_id`, `to_id`, `from_username`, `to_username`, `type`, `status`, `remark`, `content`, `friend_group_id`, `group_id`, `send_time`, `read_time`, `create_time`, `update_time`, `delete_time`) VALUES
(77,	'',	1,	2,	'hepm',	'fish',	0,	1,	'',	'',	0,	2,	1733642067,	1733718592,	1733642067,	1733718592,	0),
(78,	'',	1,	4,	'hepm',	'老骨头啊',	0,	1,	'111',	'',	0,	2,	1733642072,	1733642116,	1733642072,	1733642116,	0),
(79,	'',	1,	3,	'hepm',	'pink',	0,	1,	'111',	'',	0,	2,	1733642077,	1733642125,	1733642077,	1733642125,	0),
(80,	'',	1,	4,	'hepm',	'老骨头啊',	0,	0,	'41111',	'',	0,	2,	1733642358,	0,	1733642358,	0,	0),
(81,	'',	1,	3,	'hepm',	'pink',	0,	0,	'11111111111111',	'',	0,	3,	1733642364,	0,	1733642364,	0,	0),
(82,	'',	1,	2,	'hepm',	'fish',	0,	1,	'000000000000000000000',	'',	0,	2,	1733642368,	1733718592,	1733642368,	1733718592,	0),
(83,	'',	1,	0,	'hepm',	'0',	2,	1,	'111',	'',	0,	6,	1733642484,	1733642823,	1733642484,	1733642823,	0),
(84,	'',	2,	0,	'fish',	'0',	2,	1,	'1111',	'',	0,	6,	1733642495,	1733642820,	1733642495,	1733642820,	0),
(85,	'',	3,	0,	'pink',	'0',	2,	1,	'0000',	'',	0,	6,	1733646465,	1733646475,	1733646465,	1733646475,	0),
(86,	'',	0,	2,	'0',	'fish',	3,	1,	'邀请加入群,群号：6',	'邀请加入群,群号：6',	0,	6,	1733720591,	1733722037,	1733720591,	1733722037,	0),
(87,	'/2024/12/05/6754a011395cffd2a0ff2e872f394bc1.jpg',	0,	2,	'0',	'fish',	3,	1,	'邀请加入群,群号：6',	'邀请加入群,群号：6',	0,	6,	1733721012,	1733722037,	1733721012,	1733722037,	0),
(88,	'/2024/12/05/6754a011395cffd2a0ff2e872f394bc1.jpg',	0,	2,	'0',	'fish',	3,	1,	'邀请加入群,群号：6',	'邀请加入群,群号：6',	0,	6,	1733721082,	1733722037,	1733721082,	1733722037,	0),
(89,	'/2024/12/05/6754a011395cffd2a0ff2e872f394bc1.jpg',	0,	2,	'0',	'fish',	3,	1,	'邀请加入群,群号：6',	'邀请加入群,群号：6',	0,	6,	1733721144,	1733722037,	1733721144,	1733722037,	0),
(90,	'/2024/12/05/6754a011395cffd2a0ff2e872f394bc1.jpg',	0,	2,	'0',	'fish',	3,	1,	'邀请加入群,群号：6',	'邀请加入群,群号：6',	0,	6,	1733721151,	1733722037,	1733721151,	1733722037,	0),
(91,	'/2024/12/05/6754a011395cffd2a0ff2e872f394bc1.jpg',	0,	2,	'0',	'fish',	3,	1,	'邀请加入群,群号：6',	'邀请加入群,群号：6',	0,	6,	1733721214,	1733722037,	1733721214,	1733722037,	0),
(92,	'/2024/12/05/6754a011395cffd2a0ff2e872f394bc1.jpg',	0,	2,	'0',	'fish',	3,	1,	'邀请加入群,群号：6',	'邀请加入群,群号：6',	0,	6,	1733721406,	1733722037,	1733721406,	1733722037,	0),
(93,	'/2024/12/05/6754a011395cffd2a0ff2e872f394bc1.jpg',	0,	2,	'0',	'fish',	3,	1,	'邀请加入群,群号：6',	'邀请加入群,群号：6',	0,	6,	1733722033,	1733722037,	1733722033,	1733722037,	0);

DROP TABLE IF EXISTS `chat_record`;
CREATE TABLE `chat_record` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `avatar` varchar(255) COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '聊天头像',
  `group_id` int unsigned NOT NULL DEFAULT '0' COMMENT '群id',
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

-- 2024-12-09 11:37:36
