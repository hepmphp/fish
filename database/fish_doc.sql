-- Adminer 4.8.1 MySQL 8.0.34 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP DATABASE IF EXISTS `fish_doc`;
CREATE DATABASE `fish_doc` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `fish_doc`;

DROP TABLE IF EXISTS `doc_file`;
CREATE TABLE `doc_file` (
  `id` int NOT NULL AUTO_INCREMENT COMMENT 'id',
  `user_id` int NOT NULL DEFAULT '0' COMMENT '用户id',
  `folder_id` int NOT NULL DEFAULT '0' COMMENT '所属分类',
  `folder_parentid` int NOT NULL DEFAULT '0' COMMENT '分类父id',
  `folder_name` varchar(255) NOT NULL DEFAULT '' COMMENT '分类名称',
  `width` int NOT NULL DEFAULT '0' COMMENT '宽度',
  `height` int NOT NULL DEFAULT '0' COMMENT '高度',
  `name` varchar(255) NOT NULL DEFAULT '' COMMENT '文件名称',
  `file` varchar(255) NOT NULL DEFAULT '' COMMENT '文件路径',
  `ext` varchar(255) NOT NULL DEFAULT '' COMMENT '文件类型',
  `size` varchar(255) NOT NULL DEFAULT '' COMMENT '文件大小',
  `addtime` int NOT NULL DEFAULT '0' COMMENT '添加时间',
  `status` int NOT NULL DEFAULT '0' COMMENT '状态|0:正常,-1:删除',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='文件';

INSERT INTO `doc_file` (`id`, `user_id`, `folder_id`, `folder_parentid`, `folder_name`, `width`, `height`, `name`, `file`, `ext`, `size`, `addtime`, `status`) VALUES
(1,	1,	1,	0,	'shop',	0,	0,	'5ff73a39db3d28e012243966cdcd2e65.pdf',	'/2024/12/02/5ff73a39db3d28e012243966cdcd2e65.pdf',	'pdf',	'486.2 KB',	1733145392,	0),
(2,	1,	1,	0,	'shop',	0,	0,	'55756f58cba30adb884d3ab07ac3f1ab.pdf',	'/2024/12/02/55756f58cba30adb884d3ab07ac3f1ab.pdf',	'pdf',	'441.01 KB',	1733145392,	0),
(3,	1,	1,	0,	'shop',	0,	0,	'5ff73a39db3d28e012243966cdcd2e65.pdf',	'/2024/12/02/5ff73a39db3d28e012243966cdcd2e65.pdf',	'pdf',	'486.2 KB',	1733145424,	0),
(4,	1,	1,	0,	'shop',	0,	0,	'628d5c5db9b7fd606448e676178693b6.pdf',	'/2024/12/02/628d5c5db9b7fd606448e676178693b6.pdf',	'pdf',	'3.81 MB',	1733146518,	0),
(5,	1,	1,	0,	'shop',	0,	0,	'3dda736410c4d6e30767aeab6bb4b119.pdf',	'/2024/12/02/3dda736410c4d6e30767aeab6bb4b119.pdf',	'pdf',	'1.05 MB',	1733146582,	0),
(6,	1,	1,	0,	'shop',	0,	0,	'a36b467025450dc54d80ff09316e8fe7.pdf',	'/2024/12/02/a36b467025450dc54d80ff09316e8fe7.pdf',	'pdf',	'2.16 MB',	1733146583,	0),
(7,	1,	1,	0,	'shop',	0,	0,	'060e7df0def18a0db6efad0c382f5a4d.pdf',	'/2024/12/02/060e7df0def18a0db6efad0c382f5a4d.pdf',	'pdf',	'278.92 KB',	1733146583,	0),
(8,	1,	1,	0,	'shop',	0,	0,	'221ea6e7eace19e82d8a2af041a22f91.pdf',	'/2024/12/02/221ea6e7eace19e82d8a2af041a22f91.pdf',	'pdf',	'1.29 MB',	1733146584,	0),
(9,	1,	1,	0,	'shop',	0,	0,	'53827cec4975d87ad22b4a2f0934e3ea.pdf',	'/2024/12/02/53827cec4975d87ad22b4a2f0934e3ea.pdf',	'pdf',	'1.9 MB',	1733146624,	0),
(10,	1,	1,	0,	'shop',	0,	0,	'f96f61b88fd71bc10bdc90826131c067.pdf',	'/2024/12/02/f96f61b88fd71bc10bdc90826131c067.pdf',	'pdf',	'931.55 KB',	1733146644,	0),
(11,	1,	1,	0,	'shop',	0,	0,	'0b59ebaef50896bca7aff11bc24344b4.pdf',	'/2024/12/02/0b59ebaef50896bca7aff11bc24344b4.pdf',	'pdf',	'2.25 MB',	1733146644,	0),
(12,	1,	1,	0,	'shop',	0,	0,	'3302a6febcce76d4124f6e046d4d8719.pdf',	'/2024/12/02/3302a6febcce76d4124f6e046d4d8719.pdf',	'pdf',	'2.95 MB',	1733146644,	0),
(13,	1,	0,	0,	'',	0,	0,	'YII框架源码分析(百度PHP大牛创作-原版-无广告无水印).pdf',	'/2024/12/02/f96f61b88fd71bc10bdc90826131c067.pdf',	'pdf',	'931.55 KB',	1733150031,	0),
(14,	1,	0,	0,	'',	0,	0,	'PHP调试技术手册.pdf',	'/2024/12/02/53827cec4975d87ad22b4a2f0934e3ea.pdf',	'pdf',	'1.9 MB',	1733150061,	0),
(15,	1,	0,	0,	'',	0,	0,	'1.docx',	'/2024/12/02/973c39f2e72ae54091ce3fe407339f90.docx',	'docx',	'2.45 MB',	1733151174,	0),
(16,	1,	0,	0,	'',	0,	0,	'1.doc',	'/2024/12/02/e0c7dac697141a8d3de8c9695c04ee99.doc',	'doc',	'3.55 MB',	1733153860,	0),
(17,	1,	0,	0,	'',	0,	0,	'1.docx',	'/2024/12/02/973c39f2e72ae54091ce3fe407339f90.docx',	'docx',	'2.45 MB',	1733153874,	0),
(18,	1,	0,	0,	'',	0,	0,	'job.xls',	'/2024/12/03/c1de194ca5dc364f7e0be2b9874c7e3b.xls',	'xls',	'57.62 KB',	1733163808,	0),
(19,	1,	0,	0,	'',	0,	0,	'测试.xlsx',	'/2024/12/03/0a140033c440278b257ed6d00c11a33f.xlsx',	'xlsx',	'10.67 KB',	1733163861,	0),
(20,	1,	0,	0,	'',	0,	0,	'问题驱动-架构设.ppt',	'/2024/12/03/59b29293d270132fd3e2f8780d275324.ppt',	'ppt',	'782.5 KB',	1733166796,	0),
(21,	1,	0,	0,	'',	0,	0,	'问题驱动-架构设.ppt',	'/2024/12/03/59b29293d270132fd3e2f8780d275324.ppt',	'ppt',	'782.5 KB',	1733166806,	0),
(22,	1,	0,	0,	'',	0,	0,	'git_practice.pptx',	'/2024/12/03/9601325a6d4dddee134e59408f7a0d27.pptx',	'pptx',	'724.91 KB',	1733166864,	0),
(23,	1,	0,	0,	'',	0,	0,	'php_profile_and_monitor.pptx',	'/2024/12/03/de858244d280f3738bbc3cd8e9c760c4.pptx',	'pptx',	'3.9 MB',	1733166864,	0),
(24,	1,	0,	0,	'',	0,	0,	'失声孩童创意短片_爱给网_aigei_com.mp4',	'/2024/12/03/9fed07e45cd2e519298538919bbf93c3.mp4',	'mp4',	'6.99 MB',	1733167910,	0),
(25,	1,	0,	0,	'',	0,	0,	'雪铁龙汽车创意短片_爱给网_aigei_com.mp4',	'/2024/12/03/9d959efbdcaefdbf3cb3af715506de7f.mp4',	'mp4',	'6.18 MB',	1733167910,	0),
(26,	1,	0,	0,	'',	0,	0,	'总统牌黄油创意短片七_爱给网_aigei_com.mp4',	'/2024/12/03/0e5a7ef7380a806a44fbac79d01644a4.mp4',	'mp4',	'3.15 MB',	1733167910,	0),
(27,	1,	0,	0,	'',	0,	0,	'beyond-无尽空虚.mp3',	'/2024/12/03/98d7f207e6d20bfea260edf226797c96.mp3',	'mp3',	'4.26 MB',	1733168936,	0),
(28,	1,	0,	0,	'',	0,	0,	'beyond-情人.mp3',	'/2024/12/03/181fc44fe58f0d56a10041f0d5398b9a.mp3',	'mp3',	'4.84 MB',	1733179127,	0),
(29,	1,	0,	0,	'',	0,	0,	'排序.doc',	'/2024/12/04/3fd0d73e0c7bfe010fbe33270e6c4519.doc',	'doc',	'45 KB',	1733248314,	0),
(30,	1,	0,	0,	'',	0,	0,	'第5章树和二叉树--1.ppt',	'/2024/12/04/f21a016c04ced4795206cf3277add7a3.ppt',	'ppt',	'711 KB',	1733248314,	0),
(31,	1,	0,	0,	'',	0,	0,	'第1章绪论.ppt',	'/2024/12/04/522099e3d0c9bd3b7452ef96240c43a5.ppt',	'ppt',	'537.5 KB',	1733248643,	0),
(32,	1,	0,	0,	'',	0,	0,	'job.xls',	'/2024/12/04/c1de194ca5dc364f7e0be2b9874c7e3b.xls',	'xls',	'57.62 KB',	1733248769,	0),
(33,	1,	0,	0,	'',	0,	0,	'test.xlsx',	'/2024/12/04/9d8cafe26c4fbf7d98153b972097a9dc.xlsx',	'xlsx',	'11.64 KB',	1733248998,	0),
(34,	1,	0,	0,	'',	0,	0,	'test.xlsx',	'/2024/12/04/9d8cafe26c4fbf7d98153b972097a9dc.xlsx',	'xlsx',	'10.9 KB',	1733249265,	0);

DROP TABLE IF EXISTS `doc_folder`;
CREATE TABLE `doc_folder` (
  `id` int NOT NULL AUTO_INCREMENT COMMENT 'id',
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT '目录名称',
  `parentid` int NOT NULL DEFAULT '0' COMMENT '父类id',
  `addtime` int NOT NULL DEFAULT '0' COMMENT '添加时间',
  `user_id` int NOT NULL DEFAULT '0' COMMENT '管理员id',
  `status` tinyint NOT NULL DEFAULT '0' COMMENT '状态|0:正常,-1:',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='目录';

INSERT INTO `doc_folder` (`id`, `name`, `parentid`, `addtime`, `user_id`, `status`) VALUES
(1,	'shop',	0,	0,	20,	0),
(2,	'商品',	0,	0,	20,	0),
(3,	'鞋子',	0,	0,	20,	0),
(4,	'test',	0,	1733117086,	0,	0),
(5,	'tset',	0,	1733117353,	0,	0),
(6,	'zoo111',	1,	1733117377,	0,	-1),
(7,	'egg',	1,	1733117388,	0,	0);

DROP TABLE IF EXISTS `doc_tree_node`;
CREATE TABLE `doc_tree_node` (
  `id` int unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `parentid` int unsigned NOT NULL DEFAULT '0' COMMENT '父id',
  `parent_name` varchar(255) NOT NULL DEFAULT '' COMMENT '父级名称',
  `level` int unsigned NOT NULL DEFAULT '0' COMMENT '层级',
  `name` varchar(255) NOT NULL DEFAULT '' COMMENT '名称',
  `logo` varchar(255) NOT NULL DEFAULT '0' COMMENT '图标',
  `created_time` int unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `status` int NOT NULL DEFAULT '0' COMMENT '状态|0:正常,-1:隐藏',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='树形结构结点表';

INSERT INTO `doc_tree_node` (`id`, `parentid`, `parent_name`, `level`, `name`, `logo`, `created_time`, `status`) VALUES
(1,	0,	'作为一级菜单',	0,	'一级1',	'0',	1733327612,	0),
(2,	0,	'作为一级菜单',	0,	'一级2',	'0',	1733327636,	0),
(3,	0,	'作为一级菜单',	0,	'一级3',	'0',	1733327694,	0),
(4,	0,	'作为一级菜单',	0,	'一级4',	'0',	1733327766,	0),
(5,	1,	'一级1',	0,	'一级1-1',	'0',	1733327781,	0),
(6,	1,	'一级1',	0,	'一级1-2',	'0',	1733327793,	0),
(7,	5,	' ├ 一级1-1',	0,	'一级1-1-11',	'/2024/12/05/f0ae2f70ff77720b457a4e8e54858901.jpg',	1733327810,	0);

DROP TABLE IF EXISTS `doc_user`;
CREATE TABLE `doc_user` (
  `id` int unsigned NOT NULL AUTO_INCREMENT COMMENT '用户ID',
  `username` varchar(15) NOT NULL DEFAULT '' COMMENT '用户名字',
  `email` varchar(40) NOT NULL DEFAULT '' COMMENT 'Email地址',
  `password` varchar(32) NOT NULL DEFAULT '' COMMENT '随机密码',
  `salt` varchar(32) NOT NULL DEFAULT '' COMMENT '密码盐',
  `status` int unsigned NOT NULL DEFAULT '0' COMMENT '状态|1:正常,-1:删除',
  `avator` varchar(255) NOT NULL DEFAULT '' COMMENT '用户头像',
  `addtime` int unsigned NOT NULL DEFAULT '0' COMMENT '注册时间',
  `update_time` int unsigned NOT NULL DEFAULT '0' COMMENT '修改时间',
  `last_login_time` int unsigned NOT NULL DEFAULT '0' COMMENT '最近一次登录时间',
  `ding_staus` tinyint unsigned NOT NULL DEFAULT '0' COMMENT '钉钉激活状态|0:未激活,1:已激活',
  `ding_nick` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '' COMMENT '钉钉昵称',
  `email_status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '邮箱激活状态|1:已激活,0:未激活',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `doc_user` (`id`, `username`, `email`, `password`, `salt`, `status`, `avator`, `addtime`, `update_time`, `last_login_time`, `ding_staus`, `ding_nick`, `email_status`) VALUES
(2,	'hepm',	'306863208@qq.com',	'c5b8db931b6b4507809794b654d6be57',	'jOxHfZ',	0,	'',	1733243412,	1733251126,	0,	1,	'何盼明',	0);

DROP TABLE IF EXISTS `doc_user_structure`;
CREATE TABLE `doc_user_structure` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT '0' COMMENT '菜单名称',
  `tree_node_id` int DEFAULT '0' COMMENT '树形结构id',
  `tree_node_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT '' COMMENT '树形结构名称',
  `avator` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT '' COMMENT '头像',
  `parentid` int unsigned DEFAULT '0' COMMENT '菜单上一级id',
  `parent_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT '' COMMENT '父菜单名称',
  `status` tinyint(1) DEFAULT '0' COMMENT '菜单状态| -1:隐藏,0:正常',
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT '0' COMMENT '备注',
  `level` tinyint DEFAULT '0' COMMENT '菜单级别 0 1 2 3 4 依次递增',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='后台菜单';

INSERT INTO `doc_user_structure` (`id`, `name`, `tree_node_id`, `tree_node_name`, `avator`, `parentid`, `parent_name`, `status`, `title`, `level`) VALUES
(1,	'一级1',	0,	'',	'/2024/12/04/f0ae2f70ff77720b457a4e8e54858901.jpg',	0,	'',	0,	'一级1',	0),
(2,	'二级111111',	0,	'',	'/2024/12/04/f0ae2f70ff77720b457a4e8e54858901.jpg',	1,	'一级1',	0,	'二级1',	1),
(3,	'二级2',	0,	'',	'/2024/12/04/f957a5a737c6a5759829c7d39d4788b2.jpg',	1,	'一级1',	0,	'二级2',	1),
(4,	'三级1',	0,	'',	'/2024/12/04/c8e0b3c2318f3037237d8591ba003cc8.jpg',	2,	' ├ 二级1',	0,	'三级1',	2),
(5,	'三级1-1',	0,	'',	'/2024/12/04/5cc5d891042c235c003fc4cecba2d5ec.jpg',	2,	' ├ 二级1',	0,	'三级1-1',	2),
(6,	'三级2',	0,	'',	'/2024/12/04/ad728b1ffc91c57c1276fc09ee98bbeb.jpg',	3,	' └ 二级2',	0,	'三级2',	2),
(7,	'三级2-1',	0,	'',	'/2024/12/04/70d0cd8da1178553ef7de39ffe0c1c32.jpg',	3,	' └ 二级2',	0,	'三级2-1',	2),
(8,	'四级1-2-3',	0,	'',	'/2024/12/04/74e6eb187cf18be88634201f2e1062c7.jpg',	4,	' │ ├ 三级1',	0,	'0',	3),
(9,	'五级1',	0,	'',	'/2024/12/04/89267d9922d4f7559cca6e198baf67dd.jpg',	9,	' │ │ ├ 四级2-23',	0,	'0',	4),
(10,	'四级3',	0,	'',	'/2024/12/04/ab890a5ac6e6006216f7105fbd20e7ad.jpg',	4,	' │ ├ 三级1',	0,	'0',	3),
(11,	'五级1',	0,	'',	'/2024/12/04/f957a5a737c6a5759829c7d39d4788b2.jpg',	10,	' │ │ └ 四级3',	0,	'五级1',	4),
(12,	'五级2',	0,	'',	'/2024/12/04/c8e0b3c2318f3037237d8591ba003cc8.jpg',	10,	' │ │ └ 四级3',	-1,	'五级2',	4),
(13,	'六级1',	0,	'',	'http://127.0.0.1//upload//2024/12/04/35b5f32fac0d85e36e685f4812a24472.jpg',	13,	' │ │   └ 六级1',	0,	'0',	5),
(14,	'二级3',	0,	'',	'/2024/12/04/d4aa6b695e87396b36210c964a16298e.jpg',	1,	'一级1',	0,	'0',	1),
(15,	'一级1',	0,	'',	'/2024/12/05/f0ae2f70ff77720b457a4e8e54858901.jpg',	5,	' ├ 一级1-1',	0,	'0',	0);

-- 2024-12-04 16:46:21
