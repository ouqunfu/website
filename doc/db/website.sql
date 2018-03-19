/*
Navicat MySQL Data Transfer

Source Server         : local-pubtower-mysql
Source Server Version : 50634
Source Host           : 192.168.139.129:3306
Source Database       : website

Target Server Type    : MYSQL
Target Server Version : 50634
File Encoding         : 65001

Date: 2018-03-19 14:58:48
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for ws_commentmeta
-- ----------------------------
DROP TABLE IF EXISTS `ws_commentmeta`;
CREATE TABLE `ws_commentmeta` (
  `meta_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `comment_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `meta_key` varchar(255) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `meta_value` longtext COLLATE utf8mb4_unicode_520_ci,
  PRIMARY KEY (`meta_id`),
  KEY `comment_id` (`comment_id`),
  KEY `meta_key` (`meta_key`(191))
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- ----------------------------
-- Records of ws_commentmeta
-- ----------------------------

-- ----------------------------
-- Table structure for ws_comments
-- ----------------------------
DROP TABLE IF EXISTS `ws_comments`;
CREATE TABLE `ws_comments` (
  `comment_ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `comment_post_ID` bigint(20) unsigned NOT NULL DEFAULT '0',
  `comment_author` tinytext COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `comment_author_email` varchar(100) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `comment_author_url` varchar(200) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `comment_author_IP` varchar(100) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `comment_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `comment_date_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `comment_content` text COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `comment_karma` int(11) NOT NULL DEFAULT '0',
  `comment_approved` varchar(20) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '1',
  `comment_agent` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `comment_type` varchar(20) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `comment_parent` bigint(20) unsigned NOT NULL DEFAULT '0',
  `user_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`comment_ID`),
  KEY `comment_post_ID` (`comment_post_ID`),
  KEY `comment_approved_date_gmt` (`comment_approved`,`comment_date_gmt`),
  KEY `comment_date_gmt` (`comment_date_gmt`),
  KEY `comment_parent` (`comment_parent`),
  KEY `comment_author_email` (`comment_author_email`(10))
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- ----------------------------
-- Records of ws_comments
-- ----------------------------

-- ----------------------------
-- Table structure for ws_functions
-- ----------------------------
DROP TABLE IF EXISTS `ws_functions`;
CREATE TABLE `ws_functions` (
  `function_id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `function_name` varchar(50) NOT NULL COMMENT '菜单名称',
  `module` varchar(50) NOT NULL COMMENT '应用模块名',
  `controller` varchar(50) NOT NULL COMMENT '应用控制器名称',
  `action` varchar(50) NOT NULL COMMENT '应用操作名称',
  `status` enum('active','paused') NOT NULL DEFAULT 'active' COMMENT '状态 启用or禁用',
  `list_order` smallint(6) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  PRIMARY KEY (`function_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='功能表';

-- ----------------------------
-- Records of ws_functions
-- ----------------------------

-- ----------------------------
-- Table structure for ws_links
-- ----------------------------
DROP TABLE IF EXISTS `ws_links`;
CREATE TABLE `ws_links` (
  `link_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `link_url` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `link_name` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `link_image` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `link_target` varchar(25) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `link_description` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `link_visible` varchar(20) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT 'Y',
  `link_owner` bigint(20) unsigned NOT NULL DEFAULT '1',
  `link_rating` int(11) NOT NULL DEFAULT '0',
  `link_updated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `link_rel` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `link_notes` mediumtext COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `link_rss` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`link_id`),
  KEY `link_visible` (`link_visible`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- ----------------------------
-- Records of ws_links
-- ----------------------------

-- ----------------------------
-- Table structure for ws_log
-- ----------------------------
DROP TABLE IF EXISTS `ws_log`;
CREATE TABLE `ws_log` (
  `log_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `log_type` varchar(60) DEFAULT NULL,
  `request_method` varchar(30) DEFAULT NULL,
  `action_function` varchar(96) DEFAULT NULL,
  `action_param` text,
  `action_ip` varchar(120) DEFAULT NULL,
  `action_device` varchar(600) DEFAULT NULL,
  `user_id` int(6) DEFAULT NULL,
  `user_name` varchar(60) DEFAULT NULL,
  `create_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`log_id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ws_log
-- ----------------------------
INSERT INTO `ws_log` VALUES ('1', 'sys/User', 'POST', 'edit', '{\"group_id\":\"\",\"remark\":\"yiming001\",\"id\":\"16\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36', '16', '001@qq.com', '1495541888');
INSERT INTO `ws_log` VALUES ('2', 'sys/User', 'POST', 'edit', '{\"remark\":\"YMM001\",\"id\":\"16\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36', '16', '001@qq.com', '1495542115');
INSERT INTO `ws_log` VALUES ('3', 'sys/User', 'POST', 'create', '{\"user_name\":\"002@qq.com\",\"email\":\"002@qq.com\",\"login_passwd\":\"002\",\"remark\":\"YMM002\",\"status\":\"pending\",\"group_id\":\"3\",\"group_name\":\"g5\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36', '16', '001@qq.com', '1495542164');
INSERT INTO `ws_log` VALUES ('4', 'sys/User', 'POST', 'create', '{\"user_name\":\"003@qq.com\",\"email\":\"003@qq.com\",\"login_passwd\":\"003\",\"remark\":\"YMM003\",\"status\":\"paused\",\"group_id\":\"12\",\"group_name\":\"cvb\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36', '16', '001@qq.com', '1495542194');
INSERT INTO `ws_log` VALUES ('5', null, null, null, null, null, null, null, null, null);
INSERT INTO `ws_log` VALUES ('6', null, null, null, null, null, null, null, null, null);
INSERT INTO `ws_log` VALUES ('7', null, null, null, null, null, null, null, null, null);
INSERT INTO `ws_log` VALUES ('8', 'app-backend/log/list', 'GET', 'list', '[]', '192.168.139.1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.104 Safari/537.36 Core/1.53.4295.400 QQBrowser/9.7.12661.400', null, null, '1515377974');
INSERT INTO `ws_log` VALUES ('9', 'app-backend/log/list', 'GET', 'list', '[]', '192.168.139.1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.104 Safari/537.36 Core/1.53.4295.400 QQBrowser/9.7.12661.400', null, null, '1515378000');
INSERT INTO `ws_log` VALUES ('10', 'app-backend/log/list', 'GET', 'list', '[]', '192.168.139.1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.104 Safari/537.36 Core/1.53.4295.400 QQBrowser/9.7.12661.400', null, null, '1515378233');
INSERT INTO `ws_log` VALUES ('11', 'app-backend/log/list', 'GET', 'list', '[]', '192.168.139.1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.104 Safari/537.36 Core/1.53.4295.400 QQBrowser/9.7.12661.400', null, null, '1515378249');
INSERT INTO `ws_log` VALUES ('12', 'app-backend/log/list', 'GET', 'list', '[]', '192.168.139.1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.104 Safari/537.36 Core/1.53.4295.400 QQBrowser/9.7.12661.400', null, null, '1515379968');
INSERT INTO `ws_log` VALUES ('13', 'app-backend/log/list', 'GET', 'list', '[]', '192.168.139.1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.104 Safari/537.36 Core/1.53.4295.400 QQBrowser/9.7.12661.400', null, null, '1515379983');
INSERT INTO `ws_log` VALUES ('14', 'app-backend/log/list', 'GET', 'list', '[]', '192.168.139.1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.104 Safari/537.36 Core/1.53.4295.400 QQBrowser/9.7.12661.400', null, null, '1515380066');
INSERT INTO `ws_log` VALUES ('15', 'app-backend/log/list', 'GET', 'list', '[]', '192.168.139.1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.104 Safari/537.36 Core/1.53.4295.400 QQBrowser/9.7.12661.400', null, null, '1515380375');
INSERT INTO `ws_log` VALUES ('16', 'app-backend/log/list', 'GET', 'list', '[]', '192.168.139.1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.104 Safari/537.36 Core/1.53.4295.400 QQBrowser/9.7.12661.400', null, null, '1515380595');
INSERT INTO `ws_log` VALUES ('17', 'app-backend/log/list', 'GET', 'list', '[]', '192.168.139.1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.104 Safari/537.36 Core/1.53.4295.400 QQBrowser/9.7.12661.400', null, null, '1515380996');

-- ----------------------------
-- Table structure for ws_options
-- ----------------------------
DROP TABLE IF EXISTS `ws_options`;
CREATE TABLE `ws_options` (
  `option_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `option_name` varchar(191) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `option_value` longtext COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `autoload` varchar(20) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT 'yes',
  PRIMARY KEY (`option_id`),
  UNIQUE KEY `option_name` (`option_name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- ----------------------------
-- Records of ws_options
-- ----------------------------

-- ----------------------------
-- Table structure for ws_postmeta
-- ----------------------------
DROP TABLE IF EXISTS `ws_postmeta`;
CREATE TABLE `ws_postmeta` (
  `meta_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `post_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `meta_key` varchar(255) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `meta_value` longtext COLLATE utf8mb4_unicode_520_ci,
  PRIMARY KEY (`meta_id`),
  KEY `post_id` (`post_id`),
  KEY `meta_key` (`meta_key`(191))
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- ----------------------------
-- Records of ws_postmeta
-- ----------------------------

-- ----------------------------
-- Table structure for ws_posts
-- ----------------------------
DROP TABLE IF EXISTS `ws_posts`;
CREATE TABLE `ws_posts` (
  `ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `post_author` bigint(20) unsigned NOT NULL DEFAULT '0',
  `post_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_date_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_content` longtext COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `post_title` text COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `post_excerpt` text COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `post_status` varchar(20) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT 'publish',
  `comment_status` varchar(20) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT 'open',
  `ping_status` varchar(20) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT 'open',
  `post_password` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `post_name` varchar(200) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `to_ping` text COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `pinged` text COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `post_modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_modified_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_content_filtered` longtext COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `post_parent` bigint(20) unsigned NOT NULL DEFAULT '0',
  `guid` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `menu_order` int(11) NOT NULL DEFAULT '0',
  `post_type` varchar(20) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT 'post',
  `post_mime_type` varchar(100) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `comment_count` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`),
  KEY `post_name` (`post_name`(191)),
  KEY `type_status_date` (`post_type`,`post_status`,`post_date`,`ID`),
  KEY `post_parent` (`post_parent`),
  KEY `post_author` (`post_author`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- ----------------------------
-- Records of ws_posts
-- ----------------------------

-- ----------------------------
-- Table structure for ws_role
-- ----------------------------
DROP TABLE IF EXISTS `ws_role`;
CREATE TABLE `ws_role` (
  `role_id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `role_name` varchar(100) NOT NULL COMMENT '角色名称',
  `role_rule` varchar(1000) DEFAULT NULL COMMENT '角色拥有的function_id，多个使用英文“,”隔开',
  `status` enum('active','paused') NOT NULL DEFAULT 'paused' COMMENT '状态 启用or禁用',
  `list_order` smallint(6) unsigned DEFAULT '0' COMMENT '排序',
  PRIMARY KEY (`role_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='角色表';

-- ----------------------------
-- Records of ws_role
-- ----------------------------

-- ----------------------------
-- Table structure for ws_term_relationships
-- ----------------------------
DROP TABLE IF EXISTS `ws_term_relationships`;
CREATE TABLE `ws_term_relationships` (
  `object_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `term_taxonomy_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `term_order` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`object_id`,`term_taxonomy_id`),
  KEY `term_taxonomy_id` (`term_taxonomy_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- ----------------------------
-- Records of ws_term_relationships
-- ----------------------------

-- ----------------------------
-- Table structure for ws_term_taxonomy
-- ----------------------------
DROP TABLE IF EXISTS `ws_term_taxonomy`;
CREATE TABLE `ws_term_taxonomy` (
  `term_taxonomy_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `term_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `taxonomy` varchar(32) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `description` longtext COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `parent` bigint(20) unsigned NOT NULL DEFAULT '0',
  `count` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`term_taxonomy_id`),
  UNIQUE KEY `term_id_taxonomy` (`term_id`,`taxonomy`),
  KEY `taxonomy` (`taxonomy`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- ----------------------------
-- Records of ws_term_taxonomy
-- ----------------------------

-- ----------------------------
-- Table structure for ws_termmeta
-- ----------------------------
DROP TABLE IF EXISTS `ws_termmeta`;
CREATE TABLE `ws_termmeta` (
  `meta_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `term_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `meta_key` varchar(255) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `meta_value` longtext COLLATE utf8mb4_unicode_520_ci,
  PRIMARY KEY (`meta_id`),
  KEY `term_id` (`term_id`),
  KEY `meta_key` (`meta_key`(191))
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- ----------------------------
-- Records of ws_termmeta
-- ----------------------------

-- ----------------------------
-- Table structure for ws_terms
-- ----------------------------
DROP TABLE IF EXISTS `ws_terms`;
CREATE TABLE `ws_terms` (
  `term_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `slug` varchar(200) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `term_group` bigint(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`term_id`),
  KEY `slug` (`slug`(191)),
  KEY `name` (`name`(191))
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- ----------------------------
-- Records of ws_terms
-- ----------------------------

-- ----------------------------
-- Table structure for ws_usermeta
-- ----------------------------
DROP TABLE IF EXISTS `ws_usermeta`;
CREATE TABLE `ws_usermeta` (
  `umeta_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `meta_key` varchar(255) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `meta_value` longtext COLLATE utf8mb4_unicode_520_ci,
  PRIMARY KEY (`umeta_id`),
  KEY `user_id` (`user_id`),
  KEY `meta_key` (`meta_key`(191))
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- ----------------------------
-- Records of ws_usermeta
-- ----------------------------

-- ----------------------------
-- Table structure for ws_users
-- ----------------------------
DROP TABLE IF EXISTS `ws_users`;
CREATE TABLE `ws_users` (
  `ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_login` varchar(60) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `user_pass` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `user_login_salt` varchar(50) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `user_nicename` varchar(50) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `user_email` varchar(100) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `user_url` varchar(100) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `user_created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user_activation_key` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `user_status` enum('active','paused') COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT 'paused',
  `display_name` varchar(250) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `last_login_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `last_login_ip` varchar(250) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `last_login_ua` varchar(500) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `role_id` smallint(6) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `user_login_key` (`user_login`),
  KEY `user_nicename` (`user_nicename`),
  KEY `user_email` (`user_email`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- ----------------------------
-- Records of ws_users
-- ----------------------------
INSERT INTO `ws_users` VALUES ('1', 'admin', '10adc648ef6b79574c716ab73ee19a7b40599', 'JBqvbuQl4HPaMI', 'admin', 'jeffrey@ws.com', '', '2018-03-19 14:50:30', '', 'active', 'admin', '2018-03-19 14:54:42', '192.168.139.1', 'PostmanRuntime/6.2.5', '1');
