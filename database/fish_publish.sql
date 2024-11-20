-- Adminer 4.8.1 MySQL 8.0.34 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP DATABASE IF EXISTS `fish_publish`;
CREATE DATABASE `fish_publish` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `fish_publish`;

DROP TABLE IF EXISTS `pub_project`;
CREATE TABLE `pub_project` (
  `id` int NOT NULL AUTO_INCREMENT,
  `admin_id` int NOT NULL DEFAULT '0' COMMENT '管理员id',
  `name` varchar(60) NOT NULL DEFAULT '' COMMENT '项目名称',
  `type` tinyint NOT NULL DEFAULT '1' COMMENT '类型|1:测试,2:仿真,3:线上',
  `status` tinyint NOT NULL DEFAULT '0' COMMENT '状态|0:正常,1:删除',
  `repo_type` tinyint NOT NULL DEFAULT '0' COMMENT '仓库类型',
  `repo_url` varchar(255) NOT NULL DEFAULT '' COMMENT '仓库地址',
  `repo_username` varchar(60) NOT NULL DEFAULT '' COMMENT '仓库用户名',
  `repo_password` varchar(60) NOT NULL DEFAULT '' COMMENT '仓库密码',
  `rsync_local_www` varchar(255) NOT NULL DEFAULT '' COMMENT '本地路径',
  `rsync_remote_www` varchar(255) NOT NULL DEFAULT '' COMMENT '远程路径',
  `rsync_back_www` varchar(255) NOT NULL DEFAULT '' COMMENT '本地备份路径',
  `rsync_user` varchar(255) NOT NULL DEFAULT '' COMMENT '同步账号',
  `rsync_remote_hosts` varchar(255) NOT NULL DEFAULT '' COMMENT '同步的主机ip地址',
  `rsync_exclude` varchar(255) NOT NULL DEFAULT '' COMMENT '排除选项',
  `before_deploy` text COMMENT '部署前执行的操作',
  `after_deploy` text COMMENT '部署后执行的操作',
  `audit` tinyint DEFAULT '0' COMMENT '是否开启审核',
  `keep_version_num` int NOT NULL DEFAULT '5' COMMENT '保留的版本数',
  `addtime` int NOT NULL DEFAULT '0' COMMENT '添加时间',
  `edittime` int NOT NULL DEFAULT '0' COMMENT '修改时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COMMENT='项目名称';


DROP TABLE IF EXISTS `pub_project_member`;
CREATE TABLE `pub_project_member` (
  `id` int NOT NULL AUTO_INCREMENT,
  `admin_id` int NOT NULL DEFAULT '0' COMMENT '管理员id',
  `username` varchar(60) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT '' COMMENT '管理员名称',
  `project_id` int NOT NULL DEFAULT '0' COMMENT '项目id',
  `project_name` varchar(60) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT '' COMMENT '项目名称',
  `addtime` int NOT NULL DEFAULT '0' COMMENT '添加时间',
  `status` tinyint NOT NULL DEFAULT '0' COMMENT '状态|0:正常,-1:删除',
  PRIMARY KEY (`id`),
  UNIQUE KEY `project_id` (`project_id`,`admin_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COMMENT='项目成员';


DROP TABLE IF EXISTS `pub_publish_task`;
CREATE TABLE `pub_publish_task` (
  `id` int NOT NULL AUTO_INCREMENT COMMENT '主键',
  `admin_id` int NOT NULL DEFAULT '0' COMMENT '申请人员id',
  `deploy_admin_id` int NOT NULL DEFAULT '0' COMMENT '发布人员id',
  `project_id` int NOT NULL COMMENT '项目id',
  `project_name` varchar(255) NOT NULL DEFAULT '' COMMENT '项目名称',
  `file_list` text NOT NULL COMMENT '文件列表',
  `status` tinyint NOT NULL DEFAULT '1' COMMENT '发布状态|0:成功,1:待同步,2:同步失败,3:还原中,4:还原成功,5:还原失败',
  `rsync_log` text COMMENT 'rsync同步日志',
  `rsync_log_file` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT '' COMMENT 'rsync日志文件',
  `comment` varchar(255) NOT NULL DEFAULT '' COMMENT '发布备注',
  `rollback_comment` varchar(255) NOT NULL DEFAULT '' COMMENT '还原备注',
  `addtime` int unsigned NOT NULL DEFAULT '0' COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COMMENT='发布记录';

TRUNCATE `pub_publish_task`;
INSERT INTO `pub_publish_task` (`id`, `admin_id`, `deploy_admin_id`, `project_id`, `project_name`, `file_list`, `status`, `rsync_log`, `rsync_log_file`, `comment`, `rollback_comment`, `addtime`) VALUES
(1,	0,	20,	5,	'php-fish',	'*',	0,	'rsync -avH --port=873 --progress --delete --exclude-from=/data/logs/rsync/fish/rsync_exclude_from.txt --log-file=/data/logs/rsync/rsync_log_file.txt /data/www/git/fish rsync@121.4.70.60::git --password-file=/data/logs/rsync/passwd_rsync.txt',	'/data/logs/rsync/rsync_log_file.txt',	'第一版本',	'',	0),
(2,	20,	20,	6,	'beyond',	'*',	0,	'rsync -avH --port=873 --progress --delete --exclude-from=/data/logs/rsync/beyond/rsync_exclude_from.txt --log-file=/data/logs/rsync/rsync_log_file.txt /data/www/git/beyond rsync@121.4.70.60::git --password-file=/data/logs/rsync/passwd_rsync.txt',	'/data/logs/rsync/rsync_log_file.txt',	'beyond第一版本发布1983',	'',	0);

-- 2024-11-20 11:41:36
