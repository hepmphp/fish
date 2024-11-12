-- Adminer 4.8.1 MySQL 11.6.1-MariaDB-log dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP DATABASE IF EXISTS `fish_cms`;
CREATE DATABASE `fish_cms`;
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
) ENGINE=InnoDB  COMMENT='平台广告';

TRUNCATE `cms_ad`;

DROP TABLE IF EXISTS `cms_ad_block`;
CREATE TABLE `cms_ad_block` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `name` varchar(60) NOT NULL DEFAULT '' COMMENT '区块名称',
  `addtime` int(10) NOT NULL DEFAULT 0 COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB COMMENT='区块名称';

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
) ENGINE=InnoDB  COMMENT='平台文章';

TRUNCATE `cms_article`;

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
) ENGINE=InnoDB  COMMENT='文章分类';

TRUNCATE `cms_article_category`;
INSERT INTO `cms_article_category` (`id`, `name`, `parentid`, `level`, `description`, `status`, `addtime`) VALUES
(1,	'高层',	0,	0,	'高层',	0,	0),
(2,	'权威发布',	0,	0,	'权威发布',	0,	0),
(5,	'军委办公厅',	2,	1,	'军委办公厅',	0,	0),
(6,	'军委联合参谋部',	2,	1,	'军委联合参谋部',	0,	0),
(7,	'军委政治工作部',	2,	1,	'军委政治工作部',	0,	1730556724),
(8,	'军委后勤保障部',	2,	1,	'军委后勤保障部',	0,	1730556724),
(9,	'军委装备发展部',	2,	1,	'军委装备发展部',	0,	1730556724),
(10,	'军委训练管理部',	2,	1,	'军委训练管理部',	0,	1730556724),
(11,	'军委政法委员会',	2,	1,	'军委政法委员会',	0,	1730556724),
(12,	'军委科学技术委员会',	2,	1,	'军委科学技术委员会',	0,	1730556724),
(13,	'军委战略规划办公室',	2,	1,	'军委战略规划办公室',	-1,	1730556724),
(14,	'军委改革和编制办公室',	2,	1,	'军委改革和编制办公室',	0,	1730556724),
(15,	'军委国际军事合作办公室',	2,	1,	'军委国际军事合作办公室',	0,	1730556724),
(16,	'新闻发言人',	0,	0,	'新闻发言人',	0,	1730557778),
(17,	'发言人简介',	16,	1,	'发言人简介',	0,	1730557801),
(18,	'发言人谈话和答记者问',	16,	1,	'发言人谈话和答记者问',	0,	1730557801),
(19,	'发言人谈话和答记者问',	16,	1,	'发言人谈话和答记者问',	0,	1730557801),
(20,	'月中新闻发布',	16,	1,	'月中新闻发布',	0,	1730557801),
(21,	'例行记者会',	16,	1,	'例行记者会',	0,	1730557801),
(22,	'专题记者会',	16,	1,	'专题记者会',	0,	1730557801),
(23,	'例行记者会专题',	16,	1,	'例行记者会专题',	0,	1730557801),
(24,	'军事外交',	0,	0,	'军事外交',	0,	1730558281),
(25,	'来访',	24,	1,	'来访',	0,	1730557801),
(26,	'出访',	24,	1,	'出访',	0,	1730557801),
(27,	'交流',	24,	1,	'交流',	0,	1730557801),
(28,	'留学',	24,	1,	'留学',	0,	1730557801),
(29,	'武装力量',	0,	0,	'武装力量',	0,	1730558358),
(30,	'东部战区',	29,	1,	'东部战区',	0,	1730557801),
(31,	'南部战区',	29,	1,	'南部战区',	0,	1730557801),
(32,	'西部战区',	29,	1,	'西部战区',	0,	1730557801),
(33,	'北部战区',	29,	1,	'北部战区',	0,	1730557801),
(34,	'中部战区',	29,	1,	'中部战区',	0,	1730557801),
(35,	'陆军',	29,	1,	'陆军',	0,	1730557801),
(36,	'海军',	29,	1,	'海军',	0,	1730557801),
(37,	'空军',	29,	1,	'空军',	0,	1730557801),
(38,	'火箭军',	29,	1,	'火箭军',	0,	1730557801),
(39,	'武警',	29,	1,	'武警',	0,	1730557801),
(40,	'民兵预备役',	29,	1,	'民兵预备役',	0,	1730557801),
(41,	'军事行动',	0,	0,	'军事行动',	0,	1730558641),
(42,	'联演',	41,	1,	'联演',	0,	1730557801),
(43,	'维和',	41,	1,	'维和',	0,	1730557801),
(44,	'反恐',	41,	1,	'反恐',	0,	1730557801),
(45,	'救援',	41,	1,	'救援',	0,	1730557801),
(46,	'护航',	41,	1,	'护航',	0,	1730557801),
(47,	'国防服务',	0,	0,	'国防服务',	0,	1730558908),
(48,	'入伍',	47,	1,	'入伍',	0,	1730557801),
(49,	'招生',	47,	1,	'招生',	0,	1730557801),
(50,	'招飞',	47,	1,	'招飞',	0,	1730557801),
(51,	'招聘',	47,	1,	'招聘',	0,	1730557801),
(52,	'军属',	47,	1,	'军属',	0,	1730557801),
(53,	'卫生',	47,	1,	'卫生',	0,	1730557801),
(54,	'法规文献',	0,	0,	'法规文献',	0,	1730558990),
(55,	'法律法规',	54,	1,	'法律法规',	0,	1730557801),
(56,	'白皮书',	54,	1,	'白皮书',	0,	1730557801),
(57,	'文件',	54,	1,	'文件',	0,	1730557801),
(58,	'司法解释',	54,	1,	'司法解释',	0,	1730557801),
(59,	'出版物',	54,	1,	'出版物',	0,	1730557801),
(60,	'国防动员',	0,	0,	'国防动员',	0,	1730559082),
(61,	'武装动员',	60,	1,	'武装动员',	0,	1730557801),
(62,	'政治动员',	60,	1,	'政治动员',	0,	1730557801),
(63,	'经济动员',	60,	1,	'经济动员',	0,	1730557801),
(64,	'交通动员',	60,	1,	'交通动员',	0,	1730557801),
(65,	'人民防空',	60,	1,	'人民防空',	0,	1730557801),
(66,	'国防教育',	0,	0,	'国防教育',	0,	1730559162),
(67,	'重要活动',	66,	1,	'重要活动',	0,	1730557801),
(68,	'先进典型',	66,	1,	'先进典型',	0,	1730557801),
(69,	'军事院校',	66,	1,	'军事院校',	0,	1730557801),
(70,	'军史',	66,	1,	'军史',	0,	1730557801),
(71,	'军队媒体',	0,	0,	'军队媒体',	0,	1730559230),
(72,	'中国军网',	71,	1,	'中国军网',	0,	1730557801),
(73,	'军队人才网',	71,	1,	'军队人才网',	0,	1730557801),
(74,	'中国军视网',	71,	1,	'中国军视网',	0,	1730557801),
(75,	'解放军报',	71,	1,	'解放军报',	0,	1730557801),
(76,	'中国国防报',	71,	1,	'中国国防报',	0,	1730557801),
(77,	'中国民兵',	71,	1,	'中国民兵',	0,	1730557801),
(78,	'解放军画报',	71,	1,	'解放军画报',	0,	1730557801),
(79,	'国防教育',	71,	1,	'国防教育',	0,	1730557801),
(80,	'学习强军',	0,	0,	'学习强军',	0,	1730559393);

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
) ENGINE=InnoDB  COMMENT='附件';

TRUNCATE `cms_attach`;
INSERT INTO `cms_attach` (`id`, `cate_id`, `tag_ids`, `name`, `file`, `width`, `height`, `ext`, `size`, `addtime`) VALUES
(64,	0,	'0',	'喜欢你2.png',	'uploads/20180513/0327ec84ce95520c1b0e5e00b4e5c148.png',	1785,	2525,	'png',	'195864',	1526179030),
(65,	0,	'0',	'遥望1.png',	'uploads/20180513/a1f67ce4e19332bae0ff5b038866e82d.png',	2380,	3366,	'png',	'141074',	1526179030),
(66,	0,	'0',	'遥望1.png',	'uploads/20180513/05e6fe817362a741e6ab46e765a89b9c.png',	2380,	3366,	'png',	'141074',	1526179155),
(67,	0,	'0',	'喜欢你2.png',	'uploads/20180513/7da14e0c014683a3529d383bc00a9991.png',	1785,	2525,	'png',	'195864',	1526179155),
(68,	0,	'流行, 民谣',	'遥望1.png',	'uploads/20180513/2e59eb8e987e55cdc1da09a0e0a33c3c.png',	2380,	3366,	'png',	'141074',	1526180515),
(69,	0,	'1,3',	'遥望1.png',	'uploads/20180513/8f54a59206f9c1673ad37781ebab7fa2.png',	2380,	3366,	'png',	'141074',	1526180823),
(70,	0,	'1,2,3',	'喜欢你.png',	'uploads/20180515/579a0bec3c606beff4ae70e118b2cf7b.png',	1785,	2525,	'png',	'209770',	1526402533),
(71,	0,	'1,2,3',	'喜欢你2.png',	'uploads/20180515/2122f5b9f5ddb4d8e4ddd44cb7473c7b.png',	1785,	2525,	'png',	'195864',	1526402543),
(72,	0,	'1,2,3',	'遥望1.png',	'uploads/20180515/aa88133707ad9b068e632c2ffe97df0b.png',	2380,	3366,	'png',	'141074',	1526402543),
(73,	0,	'1,2,3',	'喜欢你.png',	'uploads/20180515/df833b1e6f42d535501a0ff0b6a08994.png',	1785,	2525,	'png',	'209770',	1526402543),
(74,	0,	'0',	'u=32528942,2886003757&fm=253&fmt=auto&app=138&f=JPEG.webp',	'uploads/undefined/20241018/65dd030653b7fbd39a7143c804023af2.webp',	300,	300,	'webp',	'8996',	1729242667),
(75,	0,	'0',	'16pic_2006245_b.jpg',	'uploads/20241018/15051ade3d068107fb6887eec139bd2d.jpg',	1024,	951,	'jpg',	'144225',	1729243004),
(76,	0,	'0',	'16pic_2006245_b.jpg',	'uploads/20241018/c7fd040dd03cb0e9e2b3a1c370095006.jpg',	1024,	951,	'jpg',	'144225',	1729243313),
(77,	0,	'0',	'16pic_2006245_b.jpg',	'uploads/20241018/11a6c15124b6f5042c6f67187e02736d.jpg',	1024,	951,	'jpg',	'144225',	1729243649),
(78,	0,	'0',	'16pic_2006245_b.jpg',	'uploads/20241018/4d5ea99f7c45c8f584e9a3f4df0df45c.jpg',	1024,	951,	'jpg',	'144225',	1729243721),
(79,	0,	'0',	'xm2024.jpg',	'uploads/20241018/010965ee42c364bd1c6eb11df1639fbf.jpg',	2424,	3196,	'jpg',	'894681',	1729243725),
(80,	0,	'0',	'16pic_2006245_b.jpg',	'uploads/20241018/61f6b3562a3d0d5f874f172eef128097.jpg',	1024,	951,	'jpg',	'144225',	1729243778),
(81,	0,	'0',	'16pic_2006245_b.jpg',	'uploads/20241018/f68deecbb8faedd91c5df76b92163d55.jpg',	1024,	951,	'jpg',	'144225',	1729244134),
(82,	0,	'0',	'16pic_2006245_b.jpg',	'uploads/20241018/acfad2350ebbfe1c2e6d760f93056254.jpg',	1024,	951,	'jpg',	'144225',	1729244142);

DROP TABLE IF EXISTS `cms_attach_cate`;
CREATE TABLE `cms_attach_cate` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `pid` int(10) NOT NULL DEFAULT 0 COMMENT '父类id',
  `name` varchar(255) NOT NULL DEFAULT '' COMMENT '附件分类名称',
  `addtime` int(10) NOT NULL DEFAULT 0 COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  COMMENT='附件分类';

TRUNCATE `cms_attach_cate`;
INSERT INTO `cms_attach_cate` (`id`, `pid`, `name`, `addtime`) VALUES
(1,	0,	'摇滚',	1525878527),
(2,	0,	'流行',	1525878531),
(3,	0,	' 民谣',	1525878544);

DROP TABLE IF EXISTS `cms_banner`;
CREATE TABLE `cms_banner` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT '轮播图名称',
  `domain` varchar(255) NOT NULL DEFAULT '' COMMENT '域名',
  `image_url` varchar(512) NOT NULL DEFAULT '' COMMENT '图片地址',
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '状态|0:显示,-1:不显示',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  COMMENT='banner表';

TRUNCATE `cms_banner`;
INSERT INTO `cms_banner` (`id`, `name`, `domain`, `image_url`, `status`) VALUES
(1,	'飞机',	'飞机',	'2024/11/07/f3ccdd27d2000e3f9255a7e3e2c48800.jpg',	0),
(2,	'坦克',	'坦克',	'2024/11/07/156005c5baf40ff51a327f1c34f2975b.jpg',	0),
(3,	'大炮',	'大炮',	'2024/11/07/032b2cc936860b03048302d991c3498f.jpg',	0),
(4,	'轮船',	'127.0.0.1',	'http://127.0.0.1:2222/ckfinder/files/%E5%9B%BD%E9%98%B2%E9%83%A8%E7%BD%91%E7%AB%99/banner/3.jpg',	-1),
(5,	'森林',	'127.0.0.1',	'http://127.0.0.1:2222/ckfinder/files/%E5%9B%BD%E9%98%B2%E9%83%A8%E7%BD%91%E7%AB%99/banner/5.jpg',	-1),
(6,	'飞机',	'飞机',	'2024/11/07/18279c8980eb69e79935ea6b3c194eb1.jpg',	0),
(7,	'森林',	'森林',	'2024/11/07/795b194b7396faf1f339bd4fbe116a3b.jpg',	-1),
(8,	'飞机',	'飞机',	'2024/11/07/07242425d4802b199553608a82fb99b0.jpg',	0),
(9,	'飞机',	'飞机',	'2024/11/07/f3ccdd27d2000e3f9255a7e3e2c48800.jpg',	0),
(10,	'飞机',	'飞机',	'2024/11/07/156005c5baf40ff51a327f1c34f2975b.jpg',	0),
(11,	'飞机',	'飞机',	'2024/11/07/799bad5a3b514f096e69bbc4a7896cd9.jpg',	0),
(12,	'森林',	'森林',	'2024/11/07/d0096ec6c83575373e3a21d129ff8fef.jpg',	-1),
(13,	'飞机',	'飞机',	'2024/11/07/d0096ec6c83575373e3a21d129ff8fef.jpg',	0);

DROP TABLE IF EXISTS `cms_file`;
CREATE TABLE `cms_file` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT 0 COMMENT '用户id',
  `folder_id` int(11) NOT NULL DEFAULT 0 COMMENT '所属分类',
  `folder_parentid` int(11) NOT NULL DEFAULT 0 COMMENT '分类父id',
  `folder_name` varchar(255) NOT NULL DEFAULT '' COMMENT '分类名称',
  `width` int(10) NOT NULL DEFAULT 0 COMMENT '宽度',
  `height` int(10) NOT NULL DEFAULT 0 COMMENT '高度',
  `name` varchar(255) NOT NULL DEFAULT '' COMMENT '文件名称',
  `file` varchar(255) NOT NULL DEFAULT '' COMMENT '文件路径',
  `ext` varchar(255) NOT NULL DEFAULT '' COMMENT '文件类型',
  `size` varchar(255) NOT NULL DEFAULT '' COMMENT '文件大小',
  `addtime` int(10) NOT NULL DEFAULT 0 COMMENT '添加时间',
  `status` int(10) NOT NULL DEFAULT 0 COMMENT '状态|0:正常,-1:删除',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  COMMENT='文件';

TRUNCATE `cms_file`;

DROP TABLE IF EXISTS `cms_folder`;
CREATE TABLE `cms_folder` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT '目录名称',
  `parentid` int(10) NOT NULL DEFAULT 0 COMMENT '父类id',
  `addtime` int(10) NOT NULL DEFAULT 0 COMMENT '添加时间',
  `user_id` int(10) NOT NULL DEFAULT 0 COMMENT '管理员id',
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '状态|0:正常,-1:',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  COMMENT='目录';

TRUNCATE `cms_folder`;

DROP TABLE IF EXISTS `cms_friend_link`;
CREATE TABLE `cms_friend_link` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT '链接名称',
  `link_address` varchar(255) NOT NULL DEFAULT '' COMMENT '链接地址',
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '状态|0:显示,1:不显示',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  COMMENT='友情链接';

TRUNCATE `cms_friend_link`;
INSERT INTO `cms_friend_link` (`id`, `name`, `link_address`, `status`) VALUES
(1,	'中国军网',	'http://www.81.cn',	0),
(2,	'军队人才网',	'http://81rc.81.cn/',	0),
(3,	'全国征兵网',	'http://www.gfbzb.gov.cn/',	0),
(4,	'新华网',	'http://www.xinhuanet.com/',	0),
(5,	'人民网',	'http://www.people.com.cn/',	0),
(6,	'央视网',	'http://www.cctv.com/',	0),
(7,	'中新网',	'http://www.chinanews.com/',	0),
(8,	'央广网',	'http://www.cnr.cn/',	0),
(9,	'光明网',	'http://www.gmw.cn/',	0),
(10,	'中国政府网',	'http://www.gov.cn/',	0),
(11,	'外交部',	'https://www.mfa.gov.cn/',	0),
(12,	'国新办',	'http://www.scio.gov.cn/',	0),
(13,	'国台办',	'http://www.gwytb.gov.cn/',	-1);

DROP TABLE IF EXISTS `cms_tag`;
CREATE TABLE `cms_tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(60)  NOT NULL DEFAULT '' COMMENT '标签名称',
  `addtime` int(10) NOT NULL DEFAULT 0 COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  COMMENT='文章标签';

TRUNCATE `cms_tag`;
INSERT INTO `cms_tag` (`id`, `name`, `addtime`) VALUES
(1,	'神',	1729242937);

-- 2024-11-09 16:10:02
