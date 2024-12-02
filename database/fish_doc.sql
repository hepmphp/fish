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

TRUNCATE `doc_file`;
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
(19,	1,	0,	0,	'',	0,	0,	'测试.xlsx',	'/2024/12/03/0a140033c440278b257ed6d00c11a33f.xlsx',	'xlsx',	'10.67 KB',	1733163861,	0);

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

TRUNCATE `doc_folder`;
INSERT INTO `doc_folder` (`id`, `name`, `parentid`, `addtime`, `user_id`, `status`) VALUES
(1,	'shop',	0,	0,	20,	0),
(2,	'商品',	0,	0,	20,	0),
(3,	'鞋子',	0,	0,	20,	0),
(4,	'test',	0,	1733117086,	0,	0),
(5,	'tset',	0,	1733117353,	0,	0),
(6,	'zoo111',	1,	1733117377,	0,	-1),
(7,	'egg',	1,	1733117388,	0,	0);

-- 2024-12-02 18:44:06
