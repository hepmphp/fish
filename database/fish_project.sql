-- Adminer 4.8.1 MySQL 8.0.34 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP DATABASE IF EXISTS `fish_project`;
CREATE DATABASE `fish_project` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `fish_project`;

DROP TABLE IF EXISTS `pj_bug`;
CREATE TABLE `pj_bug` (
  `id` int NOT NULL AUTO_INCREMENT COMMENT 'id',
  `project_id` int NOT NULL DEFAULT '0' COMMENT '项目id',
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '' COMMENT '标题',
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci COMMENT 'bug内容',
  `task_color` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '184E97' COMMENT 'bug颜色',
  `descption` varchar(255) NOT NULL DEFAULT '' COMMENT '描述',
  `priority` tinyint NOT NULL DEFAULT '0' COMMENT '优先级|0:高,1:一般,2:低,3:较低',
  `status` tinyint NOT NULL DEFAULT '1' COMMENT '状态|-1:已删除,1:新增,2:等待审核,3:开启的,4:已完成,5:已关闭',
  `bug_level` tinyint NOT NULL DEFAULT '1' COMMENT 'bug级别|1:1级,2:2级,3:3级,4:4级,5:5级,6:6级',
  `admin_id` int NOT NULL DEFAULT '0' COMMENT '管理员id',
  `admin_user` varchar(255) NOT NULL DEFAULT '' COMMENT '管理员',
  `owner_user_id` int NOT NULL DEFAULT '0' COMMENT '指派的用户id',
  `owner_user` varchar(255) NOT NULL DEFAULT '' COMMENT '指派的用户',
  `hours` int NOT NULL DEFAULT '10' COMMENT '计划工时',
  `start_date` int unsigned NOT NULL DEFAULT '0' COMMENT '开始日期',
  `end_date` int unsigned NOT NULL DEFAULT '0' COMMENT '截止日期',
  `addtime` int unsigned NOT NULL DEFAULT '0' COMMENT '添加时间',
  `updatetime` int unsigned NOT NULL DEFAULT '0' COMMENT '修改时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='bug';

TRUNCATE `pj_bug`;
INSERT INTO `pj_bug` (`id`, `project_id`, `title`, `content`, `task_color`, `descption`, `priority`, `status`, `bug_level`, `admin_id`, `admin_user`, `owner_user_id`, `owner_user`, `hours`, `start_date`, `end_date`, `addtime`, `updatetime`) VALUES
(1,	1,	'IM聊天系统bug-不能发送图片',	'<p>IM聊天系统bug-不能发送图片</p><p><span style=\"background-color: rgb(255, 192, 0);\">IM聊天系统bug-不能发送图片</span></p><p><span style=\"background-color: rgb(255, 192, 0);\">IM聊天系统bug-不能发送图片</span></p><p><span style=\"background-color: rgb(255, 192, 0);\"><span style=\"text-wrap: wrap; background-color: rgb(255, 192, 0);\">IM聊天系统bug-不能发送图片</span></span></p>',	'skyblue',	'IM聊天系统',	3,	1,	7,	20,	'hepm',	24,	'fish',	2,	1732204800,	1732204800,	0,	1732269290);

DROP TABLE IF EXISTS `pj_project`;
CREATE TABLE `pj_project` (
  `id` int NOT NULL AUTO_INCREMENT COMMENT 'id',
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '' COMMENT '标题',
  `descption` varchar(255) NOT NULL DEFAULT '' COMMENT '描述',
  `priority` tinyint NOT NULL DEFAULT '0' COMMENT '优先级|0:高,1:一般,2:低,3:较低',
  `status` tinyint NOT NULL DEFAULT '1' COMMENT '状态|-1:删除,1:新增,2:等待审核,3:开启的,4:已完成',
  `admin_id` int NOT NULL DEFAULT '0' COMMENT '管理员id',
  `admin_user` varchar(255) NOT NULL DEFAULT '' COMMENT '管理员',
  `owner_user_id` int NOT NULL DEFAULT '0' COMMENT '指派的用户id',
  `owner_user` varchar(255) NOT NULL DEFAULT '' COMMENT '指派的用户',
  `hours` int NOT NULL DEFAULT '10' COMMENT '计划工时',
  `start_date` int unsigned NOT NULL DEFAULT '0' COMMENT '开始日期',
  `end_date` int unsigned NOT NULL DEFAULT '0' COMMENT '截止日期',
  `addtime` int unsigned NOT NULL DEFAULT '0' COMMENT '添加时间',
  `updatetime` int unsigned NOT NULL DEFAULT '0' COMMENT '修改时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='项目';

TRUNCATE `pj_project`;
INSERT INTO `pj_project` (`id`, `title`, `descption`, `priority`, `status`, `admin_id`, `admin_user`, `owner_user_id`, `owner_user`, `hours`, `start_date`, `end_date`, `addtime`, `updatetime`) VALUES
(1,	'IM聊天系统',	'IM聊天系统',	0,	4,	20,	'hepm',	24,	'fish',	600,	1732204800,	1734710400,	0,	1732266375);

DROP TABLE IF EXISTS `pj_task`;
CREATE TABLE `pj_task` (
  `id` int NOT NULL AUTO_INCREMENT COMMENT 'id',
  `project_id` int NOT NULL DEFAULT '0' COMMENT '项目id',
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '' COMMENT '标题',
  `content` text COMMENT '任务内容',
  `task_color` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '184E97' COMMENT '任务颜色',
  `descption` varchar(255) NOT NULL DEFAULT '' COMMENT '描述',
  `priority` tinyint NOT NULL DEFAULT '0' COMMENT '优先级|0:高,1:一般,2:低,3:较低',
  `status` tinyint NOT NULL DEFAULT '1' COMMENT '状态|-1:已删除,1:新增,2:等待审核,3:开启的,4:已完成,5:已关闭',
  `admin_id` int NOT NULL DEFAULT '0' COMMENT '管理员id',
  `admin_user` varchar(255) NOT NULL DEFAULT '' COMMENT '管理员',
  `owner_user_id` int NOT NULL DEFAULT '0' COMMENT '指派的用户id',
  `owner_user` varchar(255) NOT NULL DEFAULT '' COMMENT '指派的用户',
  `hours` int NOT NULL DEFAULT '10' COMMENT '计划工时',
  `start_date` int unsigned NOT NULL DEFAULT '0' COMMENT '开始日期',
  `end_date` int unsigned NOT NULL DEFAULT '0' COMMENT '截止日期',
  `addtime` int unsigned NOT NULL DEFAULT '0' COMMENT '添加时间',
  `updatetime` int unsigned NOT NULL DEFAULT '0' COMMENT '修改时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='任务';

TRUNCATE `pj_task`;
INSERT INTO `pj_task` (`id`, `project_id`, `title`, `content`, `task_color`, `descption`, `priority`, `status`, `admin_id`, `admin_user`, `owner_user_id`, `owner_user`, `hours`, `start_date`, `end_date`, `addtime`, `updatetime`) VALUES
(1,	1,	'IM聊天系统',	'<p>IM聊天系统</p><p><br></p><p>IM聊天系统</p><p>IM聊天系统IM聊天系统</p>',	'#FF0000',	'',	0,	1,	20,	'hepm',	21,	'root',	600,	1729526400,	1734796800,	1732250270,	1732253072),
(2,	1,	'聊天系统群聊',	'<p>聊天系统群聊聊天系统群聊</p>',	'#FF0000',	'',	0,	1,	20,	'hepm',	24,	'fish',	600,	1732204800,	1732550400,	1732256469,	1732257943),
(3,	1,	'im系统组播',	'<p>im系统组播</p><p>im系统组播</p><p>im系统组播</p>',	'#00FF00',	'',	0,	3,	20,	'hepm',	24,	'fish',	200,	1732204800,	1732291200,	1732257980,	1732269165);

-- 2024-11-22 11:12:17
