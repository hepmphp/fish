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
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `group_id` int unsigned NOT NULL DEFAULT '0' COMMENT '分组id',
  `member_id` int unsigned NOT NULL DEFAULT '0' COMMENT '好友id',
  `nickname` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '好友昵称',
  `create_time` int unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `delete_time` int unsigned NOT NULL DEFAULT '0' COMMENT '删除时间',
  `status` int NOT NULL DEFAULT '0' COMMENT '状态|0:正常,-1:删除',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC COMMENT='会员分组下的好友列表';

TRUNCATE `chat_friend`;

DROP TABLE IF EXISTS `chat_friend_group`;
CREATE TABLE `chat_friend_group` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `member_id` int unsigned NOT NULL DEFAULT '0' COMMENT '会员id',
  `group_name` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '分组名称',
  `weight` tinyint NOT NULL DEFAULT '0' COMMENT '好友分组排序 越小越前',
  `create_time` int NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int NOT NULL DEFAULT '0' COMMENT '更新时间',
  `delete_time` int NOT NULL DEFAULT '0' COMMENT '删除时间',
  `status` int NOT NULL DEFAULT '0' COMMENT '状态|0:正常,-1:删除',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC COMMENT='会员好友分组表';

TRUNCATE `chat_friend_group`;

DROP TABLE IF EXISTS `chat_group`;
CREATE TABLE `chat_group` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `account` varchar(20) COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '群号',
  `group_name` varchar(60) COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '群名称',
  `avatar` varchar(128) COLLATE utf8mb4_general_ci NOT NULL DEFAULT '/static/images/pkq.png' COMMENT '群头像',
  `belong` int unsigned NOT NULL DEFAULT '0' COMMENT '群主',
  `description` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '描述',
  `status` int NOT NULL DEFAULT '0' COMMENT '状态|0:正常,-1:全体禁言',
  `create_time` int unsigned NOT NULL DEFAULT '0' COMMENT '添加时间',
  `update_time` int unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `delete_time` int unsigned NOT NULL DEFAULT '0' COMMENT '删除时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC COMMENT='聊天群表';

TRUNCATE `chat_group`;

DROP TABLE IF EXISTS `chat_group_member`;
CREATE TABLE `chat_group_member` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `group_id` int unsigned NOT NULL DEFAULT '0' COMMENT '群ID',
  `member_id` int unsigned NOT NULL DEFAULT '0' COMMENT '用户ID',
  `addtime` int unsigned NOT NULL DEFAULT '0' COMMENT '加群时间',
  `type` tinyint unsigned NOT NULL DEFAULT '1' COMMENT '用户类型|0:群主,1:会员',
  `forbidden_speech_time` int unsigned NOT NULL DEFAULT '0' COMMENT '禁言到某个时间',
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

DROP TABLE IF EXISTS `chat_msgbox`;
CREATE TABLE `chat_msgbox` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `from_id` int unsigned NOT NULL DEFAULT '0' COMMENT '消息发送者id',
  `to_id` int unsigned NOT NULL DEFAULT '0' COMMENT '消息接收者id',
  `from_username` varchar(32) COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '消息发送者',
  `to_username` varchar(32) COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '消息接收者',
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

DROP TABLE IF EXISTS `chat_record`;
CREATE TABLE `chat_record` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `from_id` int unsigned NOT NULL DEFAULT '0' COMMENT '发送者id',
  `to_id` int unsigned NOT NULL DEFAULT '0' COMMENT '接收者id',
  `from_username` varchar(255) COLLATE utf8mb4_general_ci NOT NULL DEFAULT '0' COMMENT '消息发送者id',
  `to_username` varchar(255) COLLATE utf8mb4_general_ci NOT NULL DEFAULT '0' COMMENT '消息接收者id',
  `content` text COLLATE utf8mb4_general_ci NOT NULL COMMENT '发送内容',
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

-- 2024-11-11 17:46:37
