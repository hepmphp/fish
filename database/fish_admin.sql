-- Adminer 4.8.1 MySQL 11.6.1-MariaDB-log dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP DATABASE IF EXISTS `fish_admin`;
CREATE DATABASE `fish_admin` /*!40100 DEFAULT CHARACTER SET utf8mb3 COLLATE utf8mb3_uca1400_ai_ci */;
USE `fish_admin`;

DROP TABLE IF EXISTS `admin_group`;
CREATE TABLE `admin_group` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '' COMMENT '分组名称',
  `comment` varchar(255) NOT NULL DEFAULT '' COMMENT '分组说明',
  `mids` text DEFAULT NULL COMMENT '用户组权限id',
  `allow_mutil_login` tinyint(4) NOT NULL DEFAULT 1 COMMENT '允许多人登录 0否 1是',
  `addtime` int(10) NOT NULL DEFAULT 0 COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_uca1400_ai_ci COMMENT='用户分组';

TRUNCATE `admin_group`;
INSERT INTO `admin_group` (`id`, `name`, `comment`, `mids`, `allow_mutil_login`, `addtime`) VALUES
(1,	'超级管理员',	'超级管理员',	'1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,67,68,70,71,22,23,24,25,26,27,62,63,64,28,29,30,31,32,33,34,35,36,38,39,40,41,37,42,43,44,45,46,51,47,48,49,50,52,54,55,56,57,53,58,59,60,61,72,73,74,75,76,77,66,65',	1,	0),
(2,	'运营人员(查询)',	'运营人员(查询)',	'1,5,6,7,8,9,10,11',	1,	1510747472),
(3,	'运营人员(查询+充值)',	'运营人员(查询+充值)',	'7,11,10,9,8',	1,	1510748173),
(4,	'运营人员(查询+充值)',	'运营人员(查询+充值)',	'7,11,10,9,8,1,6,5,4,3,2',	1,	1510748299),
(5,	'查询+游戏服',	'查询+游戏服',	'7,11,10,9,8,1,6,5,4,3,2',	1,	1510748371),
(6,	'外联11',	'外联113',	'1,4,5,6,7,8,9,10,11,13,14,19,20',	1,	1510748387),
(7,	'分组测试',	'123456',	'',	1,	1511182035),
(8,	'sogou',	'sogou',	'1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,25,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52,53,54,55,56,57,58,59,60,61,62,63,64,65,66,67,68,69,70,71,72,74,75,76,77,78,79,93,94,95,96,97,98,99,100,101,110,111',	1,	1512972626),
(9,	'客服',	'客服',	'21,23,49,50,54,55,57,61,62,63,64,65,66,67,68,69,70,71,72,74,75,76,77,78,79,93,94,95,96,97,98,99,100,101,126,127,128,129,130,131,136,138,139,140,141,143',	1,	1513301166),
(10,	'测试分组',	'分组测试',	'init',	1,	0),
(11,	'外联',	'外联',	'init',	1,	0),
(12,	'测试分组',	'分组测试测试',	'init',	1,	0),
(13,	'测试分组1',	'分组测试的',	'24,73,80,81,82,83,84,85,86,87,88,89,90,91,92,102,103,104,105,106,107,108,109,112,113,114,115,118,119,120,121,122,134,135,154,155,156,157,158,159,160,161,162,163,164,165,166,167,168,169,170,182,183,184,185,203,204,205,206,207',	1,	0),
(14,	'神',	'鱼神',	'1,2,3,4,5,6,7,8,9,10,11',	1,	1729606608);

DROP TABLE IF EXISTS `admin_log`;
CREATE TABLE `admin_log` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL DEFAULT 0 COMMENT '用户id',
  `platform_id` int(10) NOT NULL DEFAULT 0 COMMENT '平台id',
  `username` varchar(50) NOT NULL DEFAULT '' COMMENT '用户名',
  `ip` varchar(16) NOT NULL DEFAULT '' COMMENT 'ip地址',
  `m` varchar(50) NOT NULL DEFAULT '' COMMENT '控制器',
  `a` varchar(50) NOT NULL DEFAULT '' COMMENT '方法',
  `addtime` int(10) unsigned NOT NULL DEFAULT 0 COMMENT '添加时间',
  `log_type` tinyint(3) NOT NULL DEFAULT 1 COMMENT '日志类型 1添加2修改3删除4登录成功5登录失败',
  `info` text NOT NULL DEFAULT '' COMMENT '操作说明',
  `status` tinyint(3) NOT NULL DEFAULT 0 COMMENT '登录状态 1成功0失败',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_uca1400_ai_ci COMMENT='管理员操作日志';

TRUNCATE `admin_log`;

DROP TABLE IF EXISTS `admin_menu`;
CREATE TABLE `admin_menu` (
  `id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `parentid` int(6) unsigned DEFAULT 0 COMMENT '菜单上一级id',
  `top_menu_id` int(11) unsigned DEFAULT 0,
  `model` varchar(255) DEFAULT '0' COMMENT '控制器',
  `action` varchar(255) DEFAULT '0' COMMENT '方法',
  `data` char(50) DEFAULT '0' COMMENT '业务数据',
  `status` tinyint(1) DEFAULT 0 COMMENT '菜单状态 -1 隐藏  0正常',
  `name` varchar(50) DEFAULT '0' COMMENT '菜单名称',
  `remark` varchar(255) DEFAULT '0' COMMENT '备注',
  `listorder` smallint(6) unsigned DEFAULT 0 COMMENT '排序ID',
  `level` tinyint(4) DEFAULT 0 COMMENT '菜单级别 0 1 2 3 4 依次递增',
  PRIMARY KEY (`id`),
  KEY `status` (`status`),
  KEY `parentid` (`parentid`),
  KEY `model` (`model`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_uca1400_ai_ci COMMENT='后台菜单';

TRUNCATE `admin_menu`;
INSERT INTO `admin_menu` (`id`, `parentid`, `top_menu_id`, `model`, `action`, `data`, `status`, `name`, `remark`, `listorder`, `level`) VALUES
(1,	0,	1,	'admin/user',	'welcome',	'1',	0,	'系统设置',	'一级菜单',	0,	0),
(2,	1,	1,	'admin/menu',	'index',	'',	0,	'菜单列表',	'',	0,	1),
(3,	2,	1,	'admin/menu',	'create',	'',	0,	'菜单添加',	'',	0,	2),
(4,	2,	1,	'admin/menu',	'update',	'',	0,	'菜单修改',	'',	0,	2),
(5,	2,	1,	'admin/menu',	'delete',	'',	0,	'菜单删除',	'',	0,	2),
(6,	2,	1,	'admin/menu',	'index',	'',	0,	'菜单列表',	'',	0,	2),
(7,	2,	1,	'admin/menu',	'ajax_get_config_menu',	'',	0,	'获取菜单',	'',	0,	2),
(8,	1,	0,	'admin/group',	'index',	'',	0,	'用户组',	'',	0,	1),
(9,	8,	1,	'admin/group',	'index',	'',	0,	'用户组列表',	'',	0,	2),
(10,	8,	1,	'admin/group',	'create',	'',	0,	'用户组添加',	'',	0,	2),
(11,	8,	1,	'admin/group',	'update',	'',	0,	'用户组修改',	'',	0,	2),
(12,	8,	1,	'admin/group',	'delete',	'',	0,	'用户组删除',	'',	0,	2),
(13,	8,	1,	'admin/group',	'edit_permission',	'',	0,	'编辑权限',	'',	0,	2),
(14,	8,	1,	'admin/group',	'menu',	'',	0,	'获取菜单',	'',	0,	2),
(15,	1,	0,	'admin/user',	'index',	'',	0,	'用户管理',	'',	0,	1),
(16,	15,	1,	'admin/user',	'index',	'',	0,	'用户列表',	'',	0,	2),
(17,	15,	1,	'admin/user',	'create',	'',	0,	'用户添加',	'',	0,	2),
(18,	15,	1,	'admin/user',	'update',	'',	0,	'用户修改',	'',	0,	2),
(19,	15,	1,	'admin/user',	'delete',	'',	0,	'用户删除',	'',	0,	2),
(20,	15,	1,	'admin/user',	'edit_password',	'',	0,	'修改密码',	'',	0,	2),
(21,	15,	1,	'admin/user',	'edit_permission',	'',	0,	'权限修改',	'',	0,	2),
(22,	0,	22,	'tool/developer',	'index',	'',	0,	'开发工具',	'',	100,	0),
(23,	22,	23,	'tool/developer',	'index',	'',	0,	'开发工具',	'',	0,	1),
(24,	23,	24,	'tool/developer',	'index',	'',	0,	'开发者中心',	'',	0,	2),
(25,	23,	25,	'tool/developer',	'preview',	'',	0,	'预览preview',	'',	0,	2),
(26,	23,	26,	'tool/developer',	'create_js',	'',	0,	'生成js',	'',	0,	2),
(27,	23,	27,	'tool/developer',	'create_list',	'',	0,	'生成列表',	'',	0,	2),
(28,	0,	28,	'cms/article',	'index',	'',	0,	'CMS',	'cms',	1,	0),
(29,	28,	0,	'cms/attach',	'index',	'',	0,	'附件管理',	'0',	1,	1),
(30,	29,	28,	'cms/attach',	'index',	'',	0,	'附件列表',	'备注',	0,	2),
(31,	29,	28,	'cms/attach',	'add',	'',	0,	'附件添加',	'附件',	0,	2),
(32,	29,	28,	'cms/attach/cate',	'index',	'0',	0,	'附件分类管理',	'cms',	0,	2),
(33,	32,	28,	'cms/attach/cate',	'add',	'',	0,	'添加',	'附件分类',	0,	3),
(34,	32,	28,	'cms/attach/cate',	'search',	'',	0,	'附件下拉搜索',	'',	0,	3),
(35,	28,	0,	'cms/ad',	'index',	'',	0,	'广告管理',	'cms',	100,	1),
(36,	35,	28,	'cms/ad',	'index',	'',	0,	'广告管理',	'cms',	0,	2),
(37,	35,	28,	'cms/ad/block',	'index',	'',	0,	'广告区块',	'cms',	0,	2),
(38,	36,	28,	'cms/ad',	'index',	'',	0,	'广告列表',	'cms',	0,	3),
(39,	36,	28,	'cms/ad',	'create',	'',	0,	'广告添加',	'cms',	0,	3),
(40,	36,	28,	'cms/ad',	'update',	'',	0,	'广告修改',	'cms',	0,	3),
(41,	36,	28,	'cms/ad',	'delete',	'',	0,	'广告删除',	'cms',	0,	3),
(42,	37,	28,	'cms/ad/block',	'index',	'',	0,	'区块列表',	'cms',	0,	3),
(43,	37,	28,	'cms/ad/block',	'create',	'',	0,	'区块添加',	'cms',	0,	3),
(44,	37,	28,	'cms/ad/block',	'update',	'',	0,	'区块修改',	'cms',	0,	3),
(45,	37,	28,	'cms/ad/block',	'delete',	'',	0,	'区块删除',	'cms',	0,	3),
(46,	28,	0,	'cms/article',	'index',	'',	0,	'资讯管理',	'cms',	0,	1),
(47,	46,	28,	'cms/article',	'index',	'',	0,	'资讯列表',	'cms',	0,	2),
(48,	46,	28,	'cms/article',	'create',	'',	0,	'资讯添加',	'cms',	0,	2),
(49,	46,	28,	'cms/article',	'update',	'',	0,	'资讯修改',	'cms',	0,	2),
(50,	46,	28,	'cms/article',	'delete',	'',	0,	'资讯删除',	'cms',	0,	2),
(52,	28,	0,	'cms/article_category',	'index',	'',	0,	'分类管理',	'cms',	2,	1),
(53,	46,	28,	'cms/tag',	'index',	'',	0,	'标签管理',	'cms',	0,	2),
(54,	52,	54,	'cms/article_category',	'index',	'',	0,	'分类列表',	'cms',	0,	2),
(55,	52,	28,	'cms/article_category',	'create',	'',	0,	'分类添加',	'cms',	0,	2),
(56,	52,	28,	'cms/article_category',	'update',	'',	0,	'分类修改',	'cms',	0,	2),
(57,	52,	28,	'cms/article_category',	'delete',	'',	0,	'分类删除',	'cms',	0,	2),
(58,	53,	28,	'cms/tag',	'index',	'',	0,	'标签列表',	'cms',	0,	3),
(59,	53,	28,	'cms/tag',	'create',	'',	0,	'标签添加',	'cms',	0,	3),
(60,	53,	28,	'cms/tag',	'update',	'',	0,	'标签修改',	'cms',	0,	3),
(61,	53,	28,	'cms/tag',	'delete',	'',	0,	'标签删除',	'cms',	0,	3),
(62,	22,	0,	'admin/developer',	'index',	'a=1&b=2',	0,	'生成数据',	'a=1&b=2',	0,	1),
(63,	62,	22,	'admin/developer',	'create',	'a=1&b=2',	0,	'生成数据添加',	'',	0,	2),
(64,	62,	22,	'admin/developer',	'update',	'a=1&b=2',	0,	'生成数据修改',	'',	0,	2),
(65,	66,	22,	'admin/developer',	'index',	'a=1&b=2',	0,	'测试菜单~',	'a=1&b=2',	0,	2),
(66,	23,	66,	'tool/test',	'index',	'a=1&b=2',	0,	'测试菜单列表',	'a=1&b=2',	0,	2),
(67,	1,	0,	'admin/user',	'welcome',	'0',	0,	'欢迎页0',	'',	0,	1),
(68,	67,	0,	'admin/user',	'welcome',	'0',	0,	'欢迎页:)',	'0',	0,	2),
(70,	67,	0,	'fish/log',	'index',	'0',	0,	'日志查看',	'0',	0,	2),
(71,	67,	0,	'admin/log',	'index',	'0',	0,	'数据日志查看',	'0',	0,	2),
(72,	28,	0,	'cms/friend',	'index',	'',	0,	'友情链接管理',	'',	4,	1),
(73,	72,	1,	'cms/friend',	'index',	'',	0,	'链接管理',	'',	0,	2),
(75,	72,	1,	'cms/friend',	'create',	'',	0,	'链接添加',	'',	0,	2),
(76,	72,	1,	'cms/friend',	'update',	'',	0,	'链接修改',	'',	0,	2),
(77,	72,	1,	'cms/friend',	'delete',	'',	0,	'链接删除',	'',	0,	2),
(78,	28,	0,	'cms/banner',	'index',	'',	0,	'banner管理',	'',	3,	1),
(79,	78,	28,	'cms/banner',	'index',	'',	0,	'banner管理',	'',	0,	2),
(80,	78,	28,	'cms/banner',	'create',	'',	0,	'banner添加',	'',	0,	2),
(81,	78,	28,	'cms/banner',	'update',	'',	0,	'banner修改',	'',	0,	2),
(82,	78,	28,	'cms/banner',	'delete',	'',	0,	'banner删除',	'',	0,	2),
(83,	23,	83,	'tool/developer',	'create_controller',	'',	0,	'生成控制器',	'',	0,	2),
(84,	23,	84,	'tool/developer',	'create_model',	'',	0,	'生成模型',	'',	0,	2),
(85,	23,	85,	'admin/developer',	'test',	'',	0,	'测试',	'',	0,	2),
(86,	23,	86,	'test',	'index',	'',	0,	'测试',	'',	0,	2),
(87,	23,	87,	'admin/developer',	'test',	'',	0,	'测试',	'',	0,	2),
(89,	22,	NULL,	'tool/file',	'index',	'0',	0,	'代码查看',	'0',	0,	1),
(90,	89,	NULL,	'tool/file',	'index',	'0',	0,	'代码查看',	'0',	0,	2),
(91,	22,	NULL,	'tool/mysql',	'index',	'0',	0,	'数据库查询',	'',	0,	1),
(92,	91,	NULL,	'tool/mysql',	'index',	'',	0,	'数据库查询',	'',	0,	2),
(93,	22,	NULL,	'tool/log',	'index',	'0',	0,	'日志查看',	'0',	0,	1),
(94,	93,	NULL,	'tool/log',	'index',	'',	0,	'日志列表',	'',	0,	2),
(95,	22,	NULL,	'tool/redis',	'index',	'',	0,	'缓存管理',	'',	0,	1),
(96,	95,	NULL,	'tool/redis',	'index',	'',	0,	'缓存列表',	'',	0,	2),
(97,	0,	97,	'bbs/cate_list',	'index',	'',	0,	'论坛管理',	'',	0,	0),
(98,	97,	98,	'bbs/cate_list',	'index',	'',	0,	'帖子管理',	'',	0,	1),
(99,	98,	99,	'bbs/cate_list',	'index',	'',	0,	'帖子列表',	'',	0,	2),
(100,	98,	100,	'bbs/cate_list',	'create',	'',	0,	'添加帖子',	'',	0,	2),
(101,	98,	101,	'bbs/cate_list',	'update',	'',	0,	'修改帖子',	'',	0,	2),
(102,	98,	102,	'bbs/cate_list',	'delete',	'',	0,	'删除帖子',	'',	0,	2),
(103,	97,	NULL,	'bbs/forum',	'index',	'',	0,	'论坛分类',	'',	0,	1),
(104,	103,	NULL,	'bbs/forum',	'index',	'',	0,	'分类列表',	'',	0,	2),
(105,	103,	NULL,	'bbs/forum',	'create',	'',	0,	'添加分类',	'',	0,	2),
(106,	103,	NULL,	'bbs/forum',	'update',	'',	0,	'修改分类',	'',	0,	2),
(107,	103,	NULL,	'bbs/forum',	'delete',	'',	0,	'删除分类',	'',	0,	2),
(108,	97,	108,	'bbs/bbs_user',	'index',	'',	0,	'用户管理',	'',	0,	1),
(109,	108,	109,	'bbs/bbs_user',	'index',	'0',	0,	'用户列表',	'0',	0,	2),
(110,	108,	110,	'bbs/bbs_user',	'create',	'0',	0,	'用户添加',	'0',	1,	2),
(111,	108,	111,	'bbs/bbs_user',	'update',	'0',	0,	'用户修改',	'0',	2,	2),
(112,	108,	112,	'bbs/bbs_user',	'delete',	'0',	0,	'用户删除',	'0',	3,	2),
(113,	28,	113,	'cms/file',	'index',	'',	0,	'文件管理',	'',	0,	1),
(114,	113,	28,	'cms/file',	'index',	'',	0,	'文件列表',	'',	0,	2),
(115,	113,	28,	'cms/file',	'create',	'',	0,	'文件添加',	'',	0,	2),
(116,	113,	28,	'cms/file',	'update',	'',	0,	'文件修改',	'',	0,	2),
(117,	113,	28,	'cms/file',	'delete',	'',	0,	'文件删除',	'',	0,	2),
(118,	28,	118,	'cms/folder',	'index',	'',	0,	'文件夹管理',	'',	0,	1),
(119,	118,	119,	'cms/floder',	'create',	'0',	0,	'目录添加',	'0',	1,	2),
(120,	118,	120,	'cms/floder',	'update',	'0',	0,	'目录修改',	'0',	2,	2),
(121,	118,	121,	'cms/folder',	'delete',	'0',	0,	'目录删除',	'0',	3,	2),
(122,	118,	122,	'cms/folder',	'index',	'0',	0,	'文件夹管理',	'0',	0,	2),
(126,	113,	28,	'cms/file',	'folder',	'',	0,	'文件目录',	'',	0,	2),
(127,	113,	113,	'cms/file',	'detail',	'',	0,	'文件详情',	'',	0,	2);

DROP TABLE IF EXISTS `admin_user`;
CREATE TABLE `admin_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(64) NOT NULL COMMENT '用户名',
  `realname` varchar(255) NOT NULL DEFAULT '' COMMENT '真实姓名',
  `email` varchar(255) NOT NULL DEFAULT '' COMMENT '电子邮箱',
  `password` varchar(32) NOT NULL COMMENT '密码',
  `salt` varchar(6) NOT NULL COMMENT '密码盐',
  `create_time` int(11) unsigned NOT NULL DEFAULT 0 COMMENT '创建时间',
  `update_time` int(11) unsigned NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '状态|0:正常,1:删除',
  `mids` text NOT NULL COMMENT '用户菜单权限',
  `platform_id` int(10) NOT NULL DEFAULT 0 COMMENT '平台id',
  `group_id` int(10) NOT NULL DEFAULT 0 COMMENT '分组id',
  `last_session_id` varchar(32) NOT NULL DEFAULT '' COMMENT '上一次登录的session_id',
  `last_login_time` int(10) unsigned NOT NULL DEFAULT 0 COMMENT '最后登录时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_uca1400_ai_ci COMMENT='后台用户表';

TRUNCATE `admin_user`;
INSERT INTO `admin_user` (`id`, `username`, `realname`, `email`, `password`, `salt`, `create_time`, `update_time`, `status`, `mids`, `platform_id`, `group_id`, `last_session_id`, `last_login_time`) VALUES
(1,	'sysadmin',	'系统管理',	'',	'3885662a78b79c45ade750345fe0b679',	'i4BeVr',	1479393090,	1730384493,	0,	'1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,67,68,22,23,24,25,26,27,62,63,64,28,29,30,31,32,33,34,35,36,38,39,40,41,37,42,43,44,45,46,51,47,48,49,50,52,54,55,56,57,53,58,59,60,61,66,65',	1000,	1,	'7hj9dfbac0k219gn9djaulaim9',	1729602375),
(2,	'test',	'test',	'',	'c51f62115947f3689e5f440819ae7032',	'v6KJ4v',	1510814911,	1730509891,	0,	'1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52,53,54,55,56,57,58,59,60,61',	61000,	1,	'emklcqulrtkgk1266soo8m07s2',	1513322025),
(3,	'xhd',	'xhd',	'',	'b8dd2d160aac9e9da4add8b4143b0d9a',	'BSmWrr',	1511182801,	0,	0,	'1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52,53,54,55,56,57,58,59,60,61',	1,	1,	'ta9asqvhjv9d5a7eg64i7m4i62',	1515205636),
(4,	'wenbin',	'wenbin',	'',	'4173033fd3a048645eff75ee6f00a5f6',	'z4TGpO',	1511837805,	0,	0,	'1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52,53,54,55,56,57,58,59,60,61',	0,	1,	'fonqs26aiifh1hv4fap9rqlu87',	1511847554),
(5,	'hy',	'煌业',	'',	'2d4fbd0e5de3383dce284a4daa37f870',	'eFz1AS',	1512023369,	0,	0,	'1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52,53,54,55,56,57,58,59,60,61',	0,	1,	'j6o9paooko4b5k6anushgsfsp3',	1512026218),
(6,	'sgcs01',	'搜狗',	'',	'ea873c023d1fc817ba62998d138ae60b',	'qSH8x8',	1512972690,	0,	0,	'1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,25,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52,53,54,55,56,57,58,59,60,61,62,63,64,65,66,67,68,69,70,71,72,74,75,76,77,78,79,93,94,95,96,97,98,99,100,101,110,111',	61001,	8,	'o122mo5bu0gao5m9432nidgs82',	1512973328),
(7,	'sgcs02',	'搜狗2',	'',	'60ab9bf435858eef829dc1d800632a47',	'hTJl7h',	1512972818,	0,	0,	'1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,25,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52,53,54,55,56,57,58,59,60,61,62,63,64,65,66,67,68,69,70,71,72,74,75,76,77,78,79,93,94,95,96,97,98,99,100,101,110,111',	1,	8,	'sqmpe54vq5c46hmves1u6rhb24',	1512976570),
(8,	'sgcs03',	'sgcs03',	'',	'262c4136ba79f25b1fded92521036a50',	'h4GNFW',	1512977468,	0,	0,	'1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,25,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52,53,54,55,56,57,58,59,60,61,62,63,64,65,66,67,68,69,70,71,72,74,75,76,77,78,79,93,94,95,96,97,98,99,100,101,110,111',	0,	8,	'',	0),
(9,	'sgcs04',	'sgcs04',	'',	'042199e9ed782d37b7a5d95a45e7bd8c',	'4cIthv',	1513300705,	0,	0,	'',	0,	8,	'',	0),
(11,	'sgcs5',	'sgcs5',	'',	'dd8a512d181c3096f63a3a31ec1b6c4a',	'Lxg5f2',	1513300990,	1730389254,	0,	'1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,25,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52,53,54,55,56,57,58,59,60,61,62,63,64,65,66,67,68,69,70,71,72,74,75,76,77,78,79,93,94,95,96,97,98,99,100,101,110,111',	0,	8,	'',	0),
(12,	'sgcs6',	'sgcs6',	'',	'79f45218475d8569e2ff404500906bb8',	'SV0N4r',	1513301078,	0,	0,	'1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,25,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52,53,54,55,56,57,58,59,60,61,62,63,64,65,66,67,68,69,70,71,72,74,75,76,77,78,79,93,94,95,96,97,98,99,100,101,110,111',	61000,	8,	'',	0),
(13,	'kf01',	'kf01',	'',	'a7bf4f47674dd67890d31f750c8e186f',	'BTmlXi',	1513301818,	0,	0,	'21,23,49,50,54,55,57,61,62,63,64,65,66,67,68,69,70,71,72,74,75,76,77,78,79,93,94,95,96,97,98,99,100,101,126,127,128,129,130,131,136,138,139,140,141,143',	61000,	9,	'lond7eengs1s9673d8m5vc7qv5',	1513303206),
(14,	'kfcs02',	'客服测试',	'',	'887c8173d7a5aa94961f68042c2dbec5',	'HWLdG2',	1513303636,	0,	0,	'21,23,45,46,49,50,54,61,62,69,70',	61000,	9,	'44o9rg009hnp1pqre84iqr5vt4',	1513303728),
(15,	'37wankf',	'37玩客服',	'',	'ab6563cd13838180d697989aa74eab34',	'xm8XYx',	1514253266,	0,	0,	'21,23,49,50,54,55,57,61,62,63,64,65,66,67,68,69,70,71,72,74,75,76,77,78,79,93,94,95,96,97,98,99,100,101,126,127,128,129,130,131,136,138,139,140,141,143',	61000,	9,	'3g7trif0qu2g3rjulbesebdst6',	1514255623),
(16,	'test201801',	'test201801',	'',	'3fc4c7da26591658aedd935684f82da8',	'yJKwOy',	1515578711,	0,	0,	'1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52,53,54,55,56,57,58,59,60,61',	61000,	1,	'',	0),
(17,	'test201801',	'test201801',	'',	'be5e214206d7c34589524ca824a397b6',	'X0eLAL',	1515578975,	0,	0,	'1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52,53,54,55,56,57,58,59,60,61',	61000,	1,	'',	0),
(18,	'test201801',	'test20180',	'',	'',	'cQgx5D',	1515579064,	0,	0,	'1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52,53,54,55,56,57,58,59,60,61',	61000,	1,	'',	0),
(20,	'hepm',	'hepm',	'',	'f2160f0825c0a19f406941d818f141a3',	'oA862F',	1729344040,	1731074934,	0,	'1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,67,68,70,71,22,23,24,25,26,27,66,65,83,84,85,86,87,62,63,64,89,90,91,92,93,94,95,96,28,29,30,31,32,33,34,35,36,38,39,40,41,37,42,43,44,45,46,47,48,49,50,53,58,59,60,61,52,54,55,56,57,72,73,75,76,77,78,79,80,81,82,113,114,115,116,117,126,127,118,119,120,121,122,97,98,99,100,101,102,103,104,105,106,107,108,109,110,111,112',	0,	0,	'hm79q4a3eplp0bm50n8q5q7vbo',	1731166544),
(21,	'root',	'root',	'',	'30b37d634a6eb95bd32b885bfd46a7c0',	'BxBaZd',	1729782466,	0,	0,	'1',	0,	1,	'',	0),
(22,	'fishpm',	'fishpm',	'',	'd8afc59991b441aef2321ff5664f63e4',	'K2xYVk',	1730299517,	1730302445,	0,	'1,67,68',	0,	1,	'f0nks4vau20f5gvqkm4e7rblgb',	1730306418),
(23,	'zs',	'zs',	'',	'1f84fe923d84205563e27928963f6d06',	'l1GEaY',	1730509912,	0,	0,	'1',	0,	1,	'',	0),
(24,	'fish',	'fish',	'',	'1404ca529988a3c300f4911310dc0455',	'Lpqv1F',	1730596383,	1730599077,	0,	'1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,67,68,70,71,22,23,24,25,26,27,62,63,64,28,29,30,31,32,33,34,35,36,38,39,40,41,37,42,43,44,45,46,51,47,48,49,50,52,54,55,56,57,53,58,59,60,61,72,73,74,75,76,77,66,65',	0,	1,	'u8p8mjdfnsf6hkprnjd2mmuuhd',	1730604097),
(25,	'test5',	'test5',	'',	'91f4df0a35e1d1ab0ea24f5a2c153827',	'NhM6XD',	1730596948,	0,	0,	'2,3,4,5,6,7,9,10,11,12,13,14,16,17,18,19,20,21,68,70,71,24,25,26,27,62,63,64,28,29,30,31,32,33,34,35,36,38,39,40,41,37,42,43,44,45,46,51,47,48,49,50,52,54,55,56,57,53,58,59,60,61,72,73,74,75,76,77,66',	0,	1,	'',	0);

DROP TABLE IF EXISTS `platform`;
CREATE TABLE `platform` (
  `id` varchar(20) NOT NULL DEFAULT '' COMMENT '平台id',
  `sign` varchar(20) NOT NULL DEFAULT '' COMMENT '标识',
  `name` varchar(20) NOT NULL DEFAULT '' COMMENT '平台名称',
  `ip_list` varchar(10000) NOT NULL DEFAULT '' COMMENT 'ip列表 用,分隔',
  `domain` varchar(255) NOT NULL DEFAULT '' COMMENT '域名'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_uca1400_ai_ci COMMENT='平台';

TRUNCATE `platform`;
INSERT INTO `platform` (`id`, `sign`, `name`, `ip_list`, `domain`) VALUES
('61001',	'youwo',	'游喔',	'',	''),
('1000',	'全部平台',	'全部平台',	'',	''),
('61000',	'sogou',	'搜狗',	'',	'');

-- 2024-11-09 16:09:35
