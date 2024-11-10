-- Adminer 4.8.1 MySQL 11.6.1-MariaDB-log dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP DATABASE IF EXISTS `fish_bbs`;
CREATE DATABASE `fish_bbs`;
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
) ENGINE=InnoDB  COMMENT='附件表';

TRUNCATE `bbs_attachs`;

DROP TABLE IF EXISTS `bbs_forum`;
CREATE TABLE `bbs_forum` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `parentid` smallint(5) unsigned NOT NULL DEFAULT 0 COMMENT '父id',
  `level` int(10) unsigned NOT NULL DEFAULT 0 COMMENT '层级',
  `name` varchar(255) NOT NULL DEFAULT '' COMMENT '名称',
  `logo` varchar(255) NOT NULL DEFAULT '0' COMMENT '图标',
  `created_time` int(10) unsigned NOT NULL DEFAULT 0 COMMENT '创建时间',
  `status` int(10) NOT NULL DEFAULT 0 COMMENT '状态|0:正常,-1:隐藏',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  COMMENT='版块基本信息表';

TRUNCATE `bbs_forum`;
INSERT INTO `bbs_forum` (`id`, `parentid`, `level`, `name`, `logo`, `created_time`, `status`) VALUES
(1,	2,	0,	'哲学1001',	'/2024/11/09/128669b21cf45a7fb84c001dd34f49d8.jpg',	1730824582,	0),
(2,	0,	0,	'哲学12',	'/2024/11/09/2fc30b834379e7cde1af4a5107a50fe9.png',	1730824681,	0),
(3,	2,	0,	'技术',	'/2024/11/09/18279c8980eb69e79935ea6b3c194eb1.jpg',	1730824806,	0),
(4,	0,	0,	'心理学',	'2024/11/07/156606b2cff93dcad343affcb36f5e0a.jpg',	1730825043,	0),
(5,	0,	0,	'社会学',	'2024/11/07/04465f3b024f2d18abb1c720a5e294b8.jpg',	1730825058,	0),
(6,	1,	1,	'网络1234',	'2024/11/07/0209922e777a0fd279f7bb6126d40fbb.jpg',	1730903515,	0),
(7,	0,	0,	'神学',	'2024/11/07/d4aa6b695e87396b36210c964a16298e.jpg',	1730914523,	0),
(8,	0,	0,	'精神学',	'2024/11/07/f0ae2f70ff77720b457a4e8e54858901.jpg',	1730914529,	0),
(9,	0,	0,	'哲学',	'2024/11/07/27a5665cc123a8d02a98ba0b290e9f4e.jpg',	1730914533,	0),
(10,	0,	0,	'语言学',	'2024/11/07/9bdefc4b60e1be6c4b0ff1979c46dd69.jpg',	1730914538,	0),
(11,	0,	0,	'数学',	'2024/11/07/5cc5d891042c235c003fc4cecba2d5ec.jpg',	1730914543,	0),
(12,	4,	0,	'逻辑学',	'/2024/11/09/11ab6232008b0e65fe9d632ca88e6001.jpg',	1730914547,	0);

DROP TABLE IF EXISTS `bbs_posts`;
CREATE TABLE `bbs_posts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `stamp` varchar(255) NOT NULL DEFAULT '' COMMENT '帖子鉴定',
  `fid` smallint(5) unsigned NOT NULL DEFAULT 0 COMMENT '板块id',
  `forum_name` varchar(255) NOT NULL DEFAULT '' COMMENT '板块名称',
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
  `total_reply` int(10) unsigned NOT NULL DEFAULT 0 COMMENT '帖子回复数',
  `status` int(10) NOT NULL DEFAULT 0 COMMENT '帖子状态|0:正常,-1:删除',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  COMMENT='帖子表';

TRUNCATE `bbs_posts`;

DROP TABLE IF EXISTS `bbs_user`;
CREATE TABLE `bbs_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户ID',
  `username` varchar(15) NOT NULL DEFAULT '' COMMENT '用户名字',
  `email` varchar(40) NOT NULL DEFAULT '' COMMENT 'Email地址',
  `password` varchar(32) NOT NULL DEFAULT '' COMMENT '随机密码',
  `salt` varchar(32) NOT NULL DEFAULT '' COMMENT '密码盐',
  `status` int(10) unsigned NOT NULL DEFAULT 0 COMMENT '状态|1:正常,-1:删除',
  `avator` varchar(255) NOT NULL DEFAULT '' COMMENT '用户头像',
  `group_id` int(10) unsigned NOT NULL DEFAULT 0 COMMENT '当前用户组ID',
  `addtime` int(10) unsigned NOT NULL DEFAULT 0 COMMENT '注册时间',
  `update_time` int(10) unsigned NOT NULL DEFAULT 0 COMMENT '修改时间',
  `last_login_time` int(10) unsigned NOT NULL DEFAULT 0 COMMENT '最近一次登录时间',
  `groups` varchar(255) NOT NULL DEFAULT '' COMMENT '用户附加组的ID缓存字段',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB ;

TRUNCATE `bbs_user`;
INSERT INTO `bbs_user` (`id`, `username`, `email`, `password`, `salt`, `status`, `avator`, `group_id`, `addtime`, `update_time`, `last_login_time`, `groups`) VALUES
(1,	'hepm007',	'306863208@qq.com',	'd5a9e0122a669a09725895bc801f60df',	'KOq74X',	0,	'10161.jpg',	1,	1730897050,	1731162498,	0,	'fish'),
(2,	'hepm',	'306863208@qq.com',	'4228d55c923152e5fd57a5473957a8b8',	'R2JLDX',	0,	'10188.jpg',	1,	1730897195,	1730899926,	0,	'fish'),
(3,	'fish',	'fish@qq.com',	'2e3e8649084a0c970f4395007c3c3435',	'7ZjQ73',	0,	'10003.jpg',	1,	1730897383,	0,	0,	'fish');

-- 2024-11-09 16:09:47
