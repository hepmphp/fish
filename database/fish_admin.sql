-- Adminer 4.8.1 MySQL 8.0.34 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP DATABASE IF EXISTS `fish_admin`;
CREATE DATABASE `fish_admin` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `fish_admin`;

DROP TABLE IF EXISTS `admin_group`;
CREATE TABLE `admin_group` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '' COMMENT '分组名称',
  `comment` varchar(255) NOT NULL DEFAULT '' COMMENT '分组说明',
  `mids` text COMMENT '用户组权限id',
  `allow_mutil_login` tinyint NOT NULL DEFAULT '1' COMMENT '允许多人登录 0否 1是',
  `addtime` int NOT NULL DEFAULT '0' COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='用户分组';

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
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL DEFAULT '0' COMMENT '用户id',
  `platform_id` int NOT NULL DEFAULT '0' COMMENT '平台id',
  `username` varchar(50) NOT NULL DEFAULT '' COMMENT '用户名',
  `ip` varchar(16) NOT NULL DEFAULT '' COMMENT 'ip地址',
  `m` varchar(50) NOT NULL DEFAULT '' COMMENT '控制器',
  `a` varchar(50) NOT NULL DEFAULT '' COMMENT '方法',
  `addtime` int unsigned NOT NULL DEFAULT '0' COMMENT '添加时间',
  `log_type` tinyint NOT NULL DEFAULT '1' COMMENT '日志类型 1添加2修改3删除4登录成功5登录失败',
  `info` text NOT NULL COMMENT '操作说明',
  `status` tinyint NOT NULL DEFAULT '0' COMMENT '登录状态 1成功0失败',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='管理员操作日志';

TRUNCATE `admin_log`;

DROP TABLE IF EXISTS `admin_menu`;
CREATE TABLE `admin_menu` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `parentid` int unsigned DEFAULT '0' COMMENT '菜单上一级id',
  `top_menu_id` int unsigned DEFAULT '0',
  `model` varchar(255) DEFAULT '0' COMMENT '控制器',
  `action` varchar(255) DEFAULT '0' COMMENT '方法',
  `data` char(50) DEFAULT '0' COMMENT '业务数据',
  `status` tinyint(1) DEFAULT '0' COMMENT '菜单状态 -1 隐藏  0正常',
  `name` varchar(50) DEFAULT '0' COMMENT '菜单名称',
  `remark` varchar(255) DEFAULT '0' COMMENT '备注',
  `listorder` smallint unsigned DEFAULT '0' COMMENT '排序ID',
  `level` tinyint DEFAULT '0' COMMENT '菜单级别 0 1 2 3 4 依次递增',
  PRIMARY KEY (`id`),
  KEY `status` (`status`),
  KEY `parentid` (`parentid`),
  KEY `model` (`model`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='后台菜单';

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
(127,	113,	113,	'cms/file',	'detail',	'',	0,	'文件详情',	'',	0,	2),
(128,	0,	128,	'im/member',	'index',	'',	0,	'聊天后台',	'',	0,	0),
(129,	128,	129,	'im/member',	'index',	'',	0,	'用户管理',	'',	0,	1),
(130,	129,	0,	'im/member',	'index',	'0',	0,	'用户列表',	'0',	0,	2),
(131,	129,	0,	'im/member',	'create',	'0',	0,	'用户添加',	'0',	1,	2),
(132,	129,	0,	'im/member',	'update',	'0',	0,	'用户修改',	'0',	2,	2),
(133,	129,	0,	'im/member',	'delete',	'0',	0,	'用户删除',	'0',	3,	2),
(134,	128,	NULL,	'im/group',	'index',	'',	0,	'聊天群管理',	'',	0,	1),
(135,	134,	0,	'im/group',	'index',	'0',	0,	'聊天群列表',	'0',	0,	2),
(136,	134,	0,	'im/group',	'create',	'0',	0,	'聊天群添加',	'0',	1,	2),
(137,	134,	0,	'im/group',	'update',	'0',	0,	'聊天群修改',	'0',	2,	2),
(138,	134,	0,	'im/group',	'delete',	'0',	0,	'聊天群删除',	'0',	3,	2),
(139,	128,	NULL,	'im/group_member',	'index',	'',	0,	'群员管理',	'',	0,	1),
(140,	139,	0,	'im/group_member',	'index',	'0',	0,	'群员列表',	'0',	0,	2),
(141,	139,	0,	'im/group_member',	'create',	'0',	0,	'群员添加',	'0',	1,	2),
(142,	139,	0,	'im/group_member',	'update',	'0',	0,	'群员修改',	'0',	2,	2),
(143,	139,	0,	'im/group_member',	'delete',	'0',	0,	'群员删除',	'0',	3,	2),
(144,	128,	NULL,	'im/friend',	'index',	'',	0,	'好友列表',	'',	0,	1),
(145,	144,	0,	'im/friend',	'index',	'0',	0,	'好友列表',	'0',	0,	2),
(146,	144,	0,	'im/friend',	'create',	'0',	0,	'好友添加',	'0',	1,	2),
(147,	144,	0,	'im/friend',	'update',	'0',	0,	'好友修改',	'0',	2,	2),
(148,	144,	0,	'im/friend',	'delete',	'0',	0,	'好友删除',	'0',	3,	2),
(149,	128,	NULL,	'im/friend_group',	'index',	'',	0,	'好友分组',	'',	0,	1),
(150,	149,	0,	'im/friend_group',	'index',	'0',	0,	'好友分组列表',	'0',	0,	2),
(151,	149,	0,	'im/friend_group',	'create',	'0',	0,	'好友分组添加',	'0',	1,	2),
(152,	149,	0,	'im/friend_group',	'update',	'0',	0,	'好友分组修改',	'0',	2,	2),
(153,	149,	0,	'im/friend_group',	'delete',	'0',	0,	'好友分组删除',	'0',	3,	2),
(154,	128,	NULL,	'im/record',	'index',	'',	0,	'聊天记录管理',	'',	0,	1),
(155,	154,	0,	'im/record',	'index',	'0',	0,	'聊天记录列表',	'0',	0,	2),
(156,	154,	0,	'im/record',	'create',	'0',	0,	'聊天记录添加',	'0',	1,	2),
(157,	154,	0,	'im/record',	'update',	'0',	0,	'聊天记录修改',	'0',	2,	2),
(158,	154,	0,	'im/record',	'delete',	'0',	0,	'聊天记录删除',	'0',	3,	2),
(159,	128,	NULL,	'im/msgbox',	'index',	'',	0,	'消息',	'',	0,	1),
(160,	159,	0,	'im/msgbox',	'index',	'0',	0,	'消息列表',	'0',	0,	2),
(161,	159,	0,	'im/msgbox',	'create',	'0',	0,	'消息添加',	'0',	1,	2),
(162,	159,	0,	'im/msgbox',	'update',	'0',	0,	'消息修改',	'0',	2,	2),
(163,	159,	0,	'im/msgbox',	'delete',	'0',	0,	'消息删除',	'0',	3,	2),
(164,	0,	164,	'publish/project',	'index',	'',	0,	'发布系统',	'',	0,	0),
(165,	164,	165,	'publish/project',	'index',	'',	0,	'项目列表',	'',	0,	1),
(166,	165,	NULL,	'publish/project',	'index',	'',	0,	'项目列表',	'',	0,	2),
(167,	165,	NULL,	'publish/project',	'create',	'',	0,	'项目添加',	'',	0,	2),
(168,	165,	165,	'publish/project',	'update',	'',	0,	'项目修改',	'',	0,	2),
(169,	165,	165,	'publish/project',	'delete',	'',	0,	'项目删除',	'',	0,	2),
(170,	164,	170,	'publish/task',	'index',	'',	0,	'任务管理',	'',	0,	1),
(171,	170,	171,	'publish/task',	'index',	'',	0,	'任务列表',	'',	0,	2),
(172,	170,	172,	'publish/task',	'create',	'',	0,	'任务申请',	'',	0,	2),
(173,	170,	170,	'publish/task',	'publish',	'',	0,	'任务发布',	'',	0,	2),
(174,	170,	170,	'publish/task',	'rollback',	'',	0,	'任务回滚',	'',	0,	2),
(175,	164,	NULL,	'publish/project_member',	'index',	'',	0,	'项目用户',	'',	0,	1),
(176,	175,	176,	'publish/project_member',	'index',	'',	0,	'项目用户列表',	'',	0,	2),
(177,	175,	177,	'publish/project_member	',	'create',	'',	0,	'项目用户添加',	'',	0,	2),
(178,	175,	178,	'publish/project_member',	'update',	'',	0,	'项目用户修改',	'',	0,	2),
(179,	175,	NULL,	'publish/project_member',	'delete',	'',	0,	'项目用户删除',	'',	0,	2),
(180,	28,	28,	'cms/collect',	'index',	'',	0,	'采集管理',	'',	0,	1),
(181,	180,	28,	'cms/collect',	'index',	'',	0,	'采集列表',	'',	0,	2),
(182,	180,	28,	'cms/collect',	'create',	'',	0,	'采集添加',	'',	0,	2),
(183,	180,	28,	'cms/collect',	'update',	'',	0,	'采集修改',	'',	0,	2),
(184,	180,	28,	'cms/collect',	'delete',	'',	0,	'采集删除',	'',	0,	2),
(185,	0,	185,	'project/statics',	'index',	'',	0,	'项目管理',	'',	0,	0),
(186,	185,	186,	'project/project',	'index',	'',	0,	'项目管理',	'',	1,	1),
(187,	185,	187,	'project/bug',	'index',	'',	0,	'bug管理',	'',	2,	1),
(188,	185,	188,	'project/task',	'index',	'',	0,	'任务管理',	'',	3,	1),
(189,	186,	0,	'project/project',	'index',	'0',	0,	'项目列表',	'0',	0,	2),
(190,	186,	0,	'project/project',	'create',	'0',	0,	'项目添加',	'0',	1,	2),
(191,	186,	0,	'project/project',	'update',	'0',	0,	'项目修改',	'0',	2,	2),
(192,	186,	0,	'project/project',	'delete',	'0',	0,	'项目删除',	'0',	3,	2),
(193,	188,	0,	'project/task',	'index',	'0',	0,	'任务列表',	'0',	0,	2),
(194,	188,	0,	'project/task',	'create',	'0',	0,	'任务添加',	'0',	1,	2),
(195,	188,	0,	'project/task',	'update',	'0',	0,	'任务修改',	'0',	2,	2),
(196,	188,	0,	'project/task',	'delete',	'0',	0,	'任务删除',	'0',	3,	2),
(197,	187,	0,	'project/bug',	'index',	'0',	0,	'bug列表',	'0',	0,	2),
(198,	187,	0,	'project/bug',	'create',	'0',	0,	'bug添加',	'0',	1,	2),
(199,	187,	0,	'project/bug',	'update',	'0',	0,	'bug修改',	'0',	2,	2),
(200,	187,	0,	'project/bug',	'delete',	'0',	0,	'bug删除',	'0',	3,	2),
(201,	185,	185,	'project/statics',	'index',	'',	0,	'项目统计',	'',	0,	1),
(202,	201,	185,	'project/statics',	'index',	'',	0,	'项目统计',	'',	0,	2),
(203,	0,	NULL,	'cloud/server_manager',	'index',	'',	0,	'云服务器管理',	'',	0,	0),
(204,	203,	NULL,	'cloud/server_manager',	'index',	'',	0,	'云服务器列表',	'',	0,	1),
(205,	204,	NULL,	'cloud/server_manager',	'index',	'',	0,	'云服务器列表',	'',	0,	2),
(206,	204,	NULL,	'cloud/server_manager',	'create',	'',	0,	'云服务器新增',	'',	0,	2),
(207,	204,	NULL,	'cloud/server_manager',	'update',	'',	0,	'云服务器修改',	'',	0,	2),
(208,	204,	NULL,	'cloud/server_manager',	'delete',	'',	0,	'云服务器删除',	'',	0,	2),
(209,	204,	NULL,	'cloud/server_manager',	'mysql',	'',	0,	'数据库管理',	'',	0,	2);

DROP TABLE IF EXISTS `admin_user`;
CREATE TABLE `admin_user` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(64) NOT NULL COMMENT '用户名',
  `realname` varchar(255) NOT NULL DEFAULT '' COMMENT '真实姓名',
  `email` varchar(255) NOT NULL DEFAULT '' COMMENT '电子邮箱',
  `password` varchar(32) NOT NULL COMMENT '密码',
  `salt` varchar(6) NOT NULL COMMENT '密码盐',
  `create_time` int unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int unsigned NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态|0:正常,1:删除',
  `mids` text NOT NULL COMMENT '用户菜单权限',
  `platform_id` int NOT NULL DEFAULT '0' COMMENT '平台id',
  `group_id` int NOT NULL DEFAULT '0' COMMENT '分组id',
  `admin_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '/admin/user/welcome?iframe=0' COMMENT '用户默认进入的页面',
  `last_session_id` varchar(32) NOT NULL DEFAULT '' COMMENT '上一次登录的session_id',
  `last_login_time` int unsigned NOT NULL DEFAULT '0' COMMENT '最后登录时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='后台用户表';

TRUNCATE `admin_user`;
INSERT INTO `admin_user` (`id`, `username`, `realname`, `email`, `password`, `salt`, `create_time`, `update_time`, `status`, `mids`, `platform_id`, `group_id`, `admin_url`, `last_session_id`, `last_login_time`) VALUES
(1,	'sysadmin',	'系统管理',	'',	'3885662a78b79c45ade750345fe0b679',	'i4BeVr',	1479393090,	1730384493,	0,	'1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,67,68,22,23,24,25,26,27,62,63,64,28,29,30,31,32,33,34,35,36,38,39,40,41,37,42,43,44,45,46,51,47,48,49,50,52,54,55,56,57,53,58,59,60,61,66,65',	1000,	1,	'/admin/user/welcome?iframe=0',	'7hj9dfbac0k219gn9djaulaim9',	1729602375),
(2,	'test',	'test',	'',	'c51f62115947f3689e5f440819ae7032',	'v6KJ4v',	1510814911,	1730509891,	0,	'1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52,53,54,55,56,57,58,59,60,61',	61000,	1,	'/admin/user/welcome?iframe=0',	'emklcqulrtkgk1266soo8m07s2',	1513322025),
(3,	'xhd',	'xhd',	'',	'b8dd2d160aac9e9da4add8b4143b0d9a',	'BSmWrr',	1511182801,	0,	0,	'1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52,53,54,55,56,57,58,59,60,61',	1,	1,	'/admin/user/welcome?iframe=0',	'ta9asqvhjv9d5a7eg64i7m4i62',	1515205636),
(4,	'wenbin',	'wenbin',	'',	'4173033fd3a048645eff75ee6f00a5f6',	'z4TGpO',	1511837805,	0,	0,	'1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52,53,54,55,56,57,58,59,60,61',	0,	1,	'/admin/user/welcome?iframe=0',	'fonqs26aiifh1hv4fap9rqlu87',	1511847554),
(5,	'hy',	'煌业',	'',	'2d4fbd0e5de3383dce284a4daa37f870',	'eFz1AS',	1512023369,	0,	0,	'1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52,53,54,55,56,57,58,59,60,61',	0,	1,	'/admin/user/welcome?iframe=0',	'j6o9paooko4b5k6anushgsfsp3',	1512026218),
(6,	'sgcs01',	'搜狗',	'',	'ea873c023d1fc817ba62998d138ae60b',	'qSH8x8',	1512972690,	0,	0,	'1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,25,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52,53,54,55,56,57,58,59,60,61,62,63,64,65,66,67,68,69,70,71,72,74,75,76,77,78,79,93,94,95,96,97,98,99,100,101,110,111',	61001,	8,	'/admin/user/welcome?iframe=0',	'o122mo5bu0gao5m9432nidgs82',	1512973328),
(7,	'sgcs02',	'搜狗2',	'',	'60ab9bf435858eef829dc1d800632a47',	'hTJl7h',	1512972818,	0,	0,	'1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,25,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52,53,54,55,56,57,58,59,60,61,62,63,64,65,66,67,68,69,70,71,72,74,75,76,77,78,79,93,94,95,96,97,98,99,100,101,110,111',	1,	8,	'/admin/user/welcome?iframe=0',	'sqmpe54vq5c46hmves1u6rhb24',	1512976570),
(8,	'sgcs03',	'sgcs03',	'',	'262c4136ba79f25b1fded92521036a50',	'h4GNFW',	1512977468,	0,	0,	'1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,25,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52,53,54,55,56,57,58,59,60,61,62,63,64,65,66,67,68,69,70,71,72,74,75,76,77,78,79,93,94,95,96,97,98,99,100,101,110,111',	0,	8,	'/admin/user/welcome?iframe=0',	'',	0),
(9,	'sgcs04',	'sgcs04',	'',	'042199e9ed782d37b7a5d95a45e7bd8c',	'4cIthv',	1513300705,	0,	0,	'',	0,	8,	'/admin/user/welcome?iframe=0',	'',	0),
(11,	'sgcs5',	'sgcs5',	'',	'dd8a512d181c3096f63a3a31ec1b6c4a',	'Lxg5f2',	1513300990,	1730389254,	0,	'1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,25,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52,53,54,55,56,57,58,59,60,61,62,63,64,65,66,67,68,69,70,71,72,74,75,76,77,78,79,93,94,95,96,97,98,99,100,101,110,111',	0,	8,	'/admin/user/welcome?iframe=0',	'',	0),
(12,	'sgcs6',	'sgcs6',	'',	'79f45218475d8569e2ff404500906bb8',	'SV0N4r',	1513301078,	0,	0,	'1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,25,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52,53,54,55,56,57,58,59,60,61,62,63,64,65,66,67,68,69,70,71,72,74,75,76,77,78,79,93,94,95,96,97,98,99,100,101,110,111',	61000,	8,	'/admin/user/welcome?iframe=0',	'',	0),
(13,	'kf01',	'kf01',	'',	'a7bf4f47674dd67890d31f750c8e186f',	'BTmlXi',	1513301818,	0,	0,	'21,23,49,50,54,55,57,61,62,63,64,65,66,67,68,69,70,71,72,74,75,76,77,78,79,93,94,95,96,97,98,99,100,101,126,127,128,129,130,131,136,138,139,140,141,143',	61000,	9,	'/admin/user/welcome?iframe=0',	'lond7eengs1s9673d8m5vc7qv5',	1513303206),
(14,	'kfcs02',	'客服测试',	'',	'887c8173d7a5aa94961f68042c2dbec5',	'HWLdG2',	1513303636,	0,	0,	'21,23,45,46,49,50,54,61,62,69,70',	61000,	9,	'/admin/user/welcome?iframe=0',	'44o9rg009hnp1pqre84iqr5vt4',	1513303728),
(15,	'37wankf',	'37玩客服',	'',	'ab6563cd13838180d697989aa74eab34',	'xm8XYx',	1514253266,	0,	0,	'21,23,49,50,54,55,57,61,62,63,64,65,66,67,68,69,70,71,72,74,75,76,77,78,79,93,94,95,96,97,98,99,100,101,126,127,128,129,130,131,136,138,139,140,141,143',	61000,	9,	'/admin/user/welcome?iframe=0',	'3g7trif0qu2g3rjulbesebdst6',	1514255623),
(16,	'test201801',	'test201801',	'',	'3fc4c7da26591658aedd935684f82da8',	'yJKwOy',	1515578711,	0,	0,	'1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52,53,54,55,56,57,58,59,60,61',	61000,	1,	'/admin/user/welcome?iframe=0',	'',	0),
(17,	'test201801',	'test201801',	'',	'be5e214206d7c34589524ca824a397b6',	'X0eLAL',	1515578975,	0,	0,	'1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52,53,54,55,56,57,58,59,60,61',	61000,	1,	'/admin/user/welcome?iframe=0',	'',	0),
(18,	'test201801',	'test20180',	'',	'',	'cQgx5D',	1515579064,	0,	0,	'1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52,53,54,55,56,57,58,59,60,61',	61000,	1,	'/admin/user/welcome?iframe=0',	'',	0),
(20,	'hepm',	'hepm',	'',	'f2160f0825c0a19f406941d818f141a3',	'oA862F',	1729344040,	1732472304,	0,	'1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,67,68,70,71,22,23,24,25,26,27,66,65,83,84,85,86,87,62,63,64,89,90,91,92,93,94,95,96,28,29,30,31,32,33,34,35,36,38,39,40,41,37,42,43,44,45,46,47,48,49,50,53,58,59,60,61,52,54,55,56,57,72,73,75,76,77,78,79,80,81,82,113,114,115,116,117,126,127,118,119,120,121,122,97,98,99,100,101,102,103,104,105,106,107,108,109,110,111,112,128,129,130,131,132,133,134,135,136,137,138,139,140,141,142,143,144,145,146,147,148,149,150,151,152,153,154,155,156,157,158,159,160,161,162,163,164,165,166,167,168,169,170,171,172,173,174,175,176,177,178,179,185,186,189,190,191,192,187,197,198,199,200,188,193,194,195,196,201,202,203,204,205,206,207,208,209',	0,	0,	'/admin/user/welcome?iframe=0',	's1p1nu5k71trhgi0rmle0a8hhb',	1732472313),
(21,	'root',	'root',	'',	'30b37d634a6eb95bd32b885bfd46a7c0',	'BxBaZd',	1729782466,	0,	0,	'1',	0,	1,	'/admin/user/welcome?iframe=0',	'',	0),
(22,	'fishpm',	'fishpm',	'',	'd8afc59991b441aef2321ff5664f63e4',	'K2xYVk',	1730299517,	1730302445,	0,	'1,67,68',	0,	1,	'/admin/user/welcome?iframe=0',	'f0nks4vau20f5gvqkm4e7rblgb',	1730306418),
(23,	'zs',	'zs',	'',	'1f84fe923d84205563e27928963f6d06',	'l1GEaY',	1730509912,	0,	0,	'1',	0,	1,	'/admin/user/welcome?iframe=0',	'',	0),
(24,	'fish',	'fish',	'',	'1404ca529988a3c300f4911310dc0455',	'Lpqv1F',	1730596383,	1730599077,	0,	'1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,67,68,70,71,22,23,24,25,26,27,62,63,64,28,29,30,31,32,33,34,35,36,38,39,40,41,37,42,43,44,45,46,51,47,48,49,50,52,54,55,56,57,53,58,59,60,61,72,73,74,75,76,77,66,65',	0,	1,	'/admin/user/welcome?iframe=0',	'u8p8mjdfnsf6hkprnjd2mmuuhd',	1730604097),
(25,	'test5',	'test5',	'',	'91f4df0a35e1d1ab0ea24f5a2c153827',	'NhM6XD',	1730596948,	0,	0,	'2,3,4,5,6,7,9,10,11,12,13,14,16,17,18,19,20,21,68,70,71,24,25,26,27,62,63,64,28,29,30,31,32,33,34,35,36,38,39,40,41,37,42,43,44,45,46,51,47,48,49,50,52,54,55,56,57,53,58,59,60,61,72,73,74,75,76,77,66',	0,	1,	'/admin/user/welcome?iframe=0',	'',	0),
(26,	'git-fish',	'git-fish',	'',	'943fa4e65255a874d99ca17b115964b5',	'cBatvt',	1732101453,	1732102503,	0,	'164,170,172',	0,	1,	'/publish/project/index?iframe=0',	'd6fgll5ceuanua5mqvtpijm0at',	1732102520),
(27,	'git-beyond',	'git-beyond',	'',	'040bb3e75ead4244bb97153f5898defc',	'nCNeIF',	1732101469,	1732102572,	0,	'164,170,172',	0,	1,	'/publish/task/index?iframe=0',	'g87alkd8j9cnpdd1jsuj6bgj7d',	1732102586),
(28,	'bug',	'bug',	'',	'ac61bacd40362da1434d8fdd4a1b268c',	'hfyd5o',	1732254086,	1732254287,	0,	'185,186,189,190,191,192,187,197,198,199,200,188,193,194,195,196',	0,	10,	'/project/project/index?iframe=0',	'dtpnptmksb2oa6dkuoiman747g',	1732254303);

DROP TABLE IF EXISTS `platform`;
CREATE TABLE `platform` (
  `id` varchar(20) NOT NULL DEFAULT '' COMMENT '平台id',
  `sign` varchar(20) NOT NULL DEFAULT '' COMMENT '标识',
  `name` varchar(20) NOT NULL DEFAULT '' COMMENT '平台名称',
  `ip_list` varchar(10000) NOT NULL DEFAULT '' COMMENT 'ip列表 用,分隔',
  `domain` varchar(255) NOT NULL DEFAULT '' COMMENT '域名'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='平台';

TRUNCATE `platform`;
INSERT INTO `platform` (`id`, `sign`, `name`, `ip_list`, `domain`) VALUES
('61001',	'youwo',	'游喔',	'',	''),
('1000',	'全部平台',	'全部平台',	'',	''),
('61000',	'sogou',	'搜狗',	'',	'');

-- 2024-11-24 19:02:45
