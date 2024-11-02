-- Adminer 4.8.1 MySQL 11.6.1-MariaDB-log dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP DATABASE IF EXISTS `fish_bbs`;
CREATE DATABASE `fish_bbs` /*!40100 DEFAULT CHARACTER SET utf8mb3 COLLATE utf8mb3_uca1400_ai_ci */;
USE `fish_bbs`;

DROP TABLE IF EXISTS `bbs_attachs`;
CREATE TABLE `bbs_attachs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '附件id',
  `name` varchar(80) NOT NULL DEFAULT '' COMMENT '文件名',
  `type` varchar(15) NOT NULL DEFAULT '' COMMENT '文件类型',
  `size` int(10) unsigned NOT NULL DEFAULT 0 COMMENT '文件大小',
  `path` varchar(80) NOT NULL DEFAULT '' COMMENT '存储路径',
  `created_userid` int(10) unsigned NOT NULL DEFAULT 0 COMMENT '上传人用户id',
  `created_time` int(10) unsigned NOT NULL DEFAULT 0 COMMENT '上传时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_uca1400_ai_ci COMMENT='附件表';


DROP TABLE IF EXISTS `bbs_forum`;
CREATE TABLE `bbs_forum` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `parentid` smallint(5) unsigned NOT NULL DEFAULT 0 COMMENT '父id',
  `level` int(10) unsigned NOT NULL DEFAULT 0 COMMENT '层级',
  `name` varchar(255) NOT NULL DEFAULT '' COMMENT '名称',
  `logo` varchar(100) NOT NULL DEFAULT '' COMMENT '图标',
  `created_time` int(10) unsigned NOT NULL DEFAULT 0 COMMENT '创建时间',
  `status` int(10) NOT NULL COMMENT '状态|0:正常,-1:隐藏',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_uca1400_ai_ci COMMENT='版块基本信息表';


DROP TABLE IF EXISTS `bbs_posts`;
CREATE TABLE `bbs_posts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `fid` smallint(5) unsigned NOT NULL DEFAULT 0 COMMENT '板块id',
  `pid` int(10) unsigned NOT NULL DEFAULT 0 COMMENT '父id',
  `subject` varchar(100) NOT NULL DEFAULT '' COMMENT '主题',
  `content` text DEFAULT NULL COMMENT '内容',
  `created_time` int(10) unsigned NOT NULL DEFAULT 0 COMMENT '发帖时间',
  `user_id` int(10) unsigned NOT NULL DEFAULT 0 COMMENT '用户id',
  `username` varchar(15) NOT NULL DEFAULT '' COMMENT '用户名',
  `ip` varchar(40) NOT NULL DEFAULT '' COMMENT '用户ip',
  `modified_time` int(10) unsigned NOT NULL DEFAULT 0 COMMENT '修改帖子时间',
  `modified_username` varchar(15) NOT NULL DEFAULT '' COMMENT '修改帖子的用户',
  `modified_userid` int(10) unsigned NOT NULL DEFAULT 0 COMMENT '修改贴子的用户id',
  `modified_ip` varchar(40) NOT NULL DEFAULT '' COMMENT '修改帖子的ip',
  `total_reply` int(10) unsigned NOT NULL COMMENT '帖子回复数',
  `status` int(10) NOT NULL COMMENT '帖子状态|0:正常,-1:删除',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_uca1400_ai_ci COMMENT='帖子表';


DROP TABLE IF EXISTS `bbs_user`;
CREATE TABLE `bbs_user` (
  `id` int(10) unsigned NOT NULL DEFAULT 0 COMMENT '用户ID',
  `username` varchar(15) NOT NULL DEFAULT '' COMMENT '用户名字',
  `email` varchar(40) NOT NULL DEFAULT '' COMMENT 'Email地址',
  `password` char(32) NOT NULL DEFAULT '' COMMENT '随机密码',
  `status` smallint(6) unsigned NOT NULL DEFAULT 0 COMMENT '状态',
  `groupid` mediumint(8) unsigned NOT NULL DEFAULT 0 COMMENT '当前用户组ID',
  `regdate` int(10) unsigned NOT NULL DEFAULT 0 COMMENT '注册时间',
  `groups` varchar(255) NOT NULL DEFAULT '' COMMENT '用户附加组的ID缓存字段',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_uca1400_ai_ci COMMENT='用户基本表';


-- 2024-11-02 01:13:16
