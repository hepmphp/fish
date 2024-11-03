-- Adminer 4.8.1 MySQL 11.6.1-MariaDB-log dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP DATABASE IF EXISTS `fish_cms`;
CREATE DATABASE `fish_cms` /*!40100 DEFAULT CHARACTER SET utf8mb3 COLLATE utf8mb3_uca1400_ai_ci */;
USE `fish_cms`;

DROP TABLE IF EXISTS `cms_ad`;
CREATE TABLE `cms_ad` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '广告id',
  `block_id` int(11) NOT NULL DEFAULT 0 COMMENT '广告位置',
  `title` varchar(50) NOT NULL DEFAULT '' COMMENT '广告标题',
  `pic_url` varchar(255) NOT NULL DEFAULT '' COMMENT '图片链接',
  `link_address` varchar(512) NOT NULL DEFAULT '' COMMENT '广告地址',
  `addtime` int(11) unsigned NOT NULL DEFAULT 0 COMMENT '添加时间',
  `start_time` int(11) unsigned NOT NULL DEFAULT 0 COMMENT '开始时间',
  `end_time` int(11) unsigned NOT NULL DEFAULT 0 COMMENT '结束时间',
  `listorder` smallint(6) NOT NULL DEFAULT 0 COMMENT '排序',
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '状态|0:显示,1:不显示',
  `is_mobile` tinyint(4) NOT NULL DEFAULT 0 COMMENT '是否是m版',
  PRIMARY KEY (`id`),
  KEY `block_id` (`id`,`block_id`,`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_uca1400_ai_ci COMMENT='平台广告';

TRUNCATE `cms_ad`;

DROP TABLE IF EXISTS `cms_ad_block`;
CREATE TABLE `cms_ad_block` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `name` varchar(60) NOT NULL DEFAULT '' COMMENT '区块名称',
  `addtime` int(10) NOT NULL DEFAULT 0 COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci COMMENT='区块名称';

TRUNCATE `cms_ad_block`;

DROP TABLE IF EXISTS `cms_article`;
CREATE TABLE `cms_article` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `cate_id` int(10) unsigned NOT NULL DEFAULT 0 COMMENT '分类',
  `cate_bids` varchar(1024) NOT NULL DEFAULT '0' COMMENT '所有相关的分类',
  `cate_name` varchar(255) NOT NULL DEFAULT '' COMMENT '分类名称',
  `tag_ids` varchar(255) NOT NULL DEFAULT '0' COMMENT '标签id  ',
  `admin_id` int(10) unsigned NOT NULL DEFAULT 0 COMMENT '管理员id',
  `admin` varchar(255) NOT NULL DEFAULT '' COMMENT '用户名',
  `title` varchar(255) NOT NULL DEFAULT '' COMMENT '标题',
  `keywords` varchar(255) NOT NULL DEFAULT '' COMMENT '关键词',
  `media` varchar(255) NOT NULL DEFAULT '' COMMENT '来源',
  `author` varchar(255) NOT NULL DEFAULT '' COMMENT '作者',
  `description` varchar(255) NOT NULL DEFAULT '' COMMENT '描述',
  `content` longtext NOT NULL COMMENT '内容',
  `addtime` int(11) unsigned NOT NULL DEFAULT 0 COMMENT '添加时间',
  `update_time` int(11) unsigned NOT NULL DEFAULT 0 COMMENT '更新时间',
  `is_top` tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否置顶 0普通 1置顶 2头条',
  `list_image_url` varchar(255) NOT NULL DEFAULT '' COMMENT '列表显示图片',
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '状态 0正常 -1 删除',
  PRIMARY KEY (`id`),
  KEY `cate_id` (`id`,`cate_id`,`is_top`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_uca1400_ai_ci COMMENT='平台文章';

 
DROP TABLE IF EXISTS `cms_article_category`;
CREATE TABLE `cms_article_category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `name` varchar(30) NOT NULL DEFAULT '' COMMENT '名称',
  `parentid` int(10) unsigned NOT NULL DEFAULT 0 COMMENT '父id',
  `level` int(10) unsigned NOT NULL COMMENT '层级0,1,2',
  `description` varchar(50) NOT NULL DEFAULT '' COMMENT '描述',
  `status` tinyint(10) DEFAULT 0 COMMENT '状态|0:正常,-1:删除',
  `addtime` int(10) unsigned DEFAULT 0 COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_uca1400_ai_ci COMMENT='文章分类';

 

DROP TABLE IF EXISTS `cms_attach`;
CREATE TABLE `cms_attach` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `cate_id` int(11) NOT NULL DEFAULT 0 COMMENT '所属分类',
  `tag_ids` varchar(255) NOT NULL DEFAULT '0' COMMENT '标签id',
  `name` varchar(255) NOT NULL DEFAULT '' COMMENT '附件名称',
  `file` varchar(255) NOT NULL DEFAULT '' COMMENT '文件路径',
  `width` int(10) NOT NULL DEFAULT 0 COMMENT '宽度',
  `height` int(10) NOT NULL DEFAULT 0 COMMENT '高度',
  `ext` varchar(255) NOT NULL DEFAULT '' COMMENT '文件类型',
  `size` varchar(255) NOT NULL DEFAULT '' COMMENT '文件大小',
  `addtime` int(10) NOT NULL DEFAULT 0 COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_uca1400_ai_ci COMMENT='附件';

 

DROP TABLE IF EXISTS `cms_attach_cate`;
CREATE TABLE `cms_attach_cate` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `pid` int(10) NOT NULL DEFAULT 0 COMMENT '父类id',
  `name` varchar(255) NOT NULL DEFAULT '' COMMENT '附件分类名称',
  `addtime` int(10) NOT NULL DEFAULT 0 COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_uca1400_ai_ci COMMENT='附件分类';

 

DROP TABLE IF EXISTS `cms_banner`;
CREATE TABLE `cms_banner` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT '轮播图名称',
  `domain` varchar(255) NOT NULL DEFAULT '' COMMENT '域名',
  `image_url` varchar(512) NOT NULL DEFAULT '' COMMENT '图片地址',
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '状态|0:显示,-1:不显示',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_uca1400_ai_ci;

 

DROP TABLE IF EXISTS `cms_friend_link`;
CREATE TABLE `cms_friend_link` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT '链接名称',
  `link_address` varchar(255) NOT NULL DEFAULT '' COMMENT '链接地址',
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '状态|0:显示,1:不显示',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_uca1400_ai_ci;

 

DROP TABLE IF EXISTS `cms_tag`;
CREATE TABLE `cms_tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(60) CHARACTER SET utf8mb3 COLLATE utf8mb3_uca1400_ai_ci NOT NULL DEFAULT '' COMMENT '标签名称',
  `addtime` int(10) NOT NULL DEFAULT 0 COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci COMMENT='文章标签';

TRUNCATE `cms_tag`;
INSERT INTO `cms_tag` (`id`, `name`, `addtime`) VALUES
(1,	'神',	1729242937);

-- 2024-11-03 16:09:13
