/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50547
Source Host           : localhost:3306
Source Database       : mc

Target Server Type    : MYSQL
Target Server Version : 50547
File Encoding         : 65001

Date: 2018-07-03 16:40:38
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for mc_config
-- ----------------------------
DROP TABLE IF EXISTS `mc_config`;
CREATE TABLE `mc_config` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `config_title` varchar(50) NOT NULL DEFAULT '' COMMENT '配置标题',
  `config_name` varchar(50) NOT NULL DEFAULT '' COMMENT '配置变量名称',
  `config_content` text NOT NULL COMMENT '配置内容',
  `config_order` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `config_tips` varchar(255) NOT NULL DEFAULT '' COMMENT '描述',
  `field_type` varchar(50) NOT NULL DEFAULT '' COMMENT '字段类型',
  `field_value` varchar(255) NOT NULL DEFAULT '' COMMENT '字段值',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COMMENT='网站配置';

-- ----------------------------
-- Records of mc_config
-- ----------------------------
INSERT INTO `mc_config` VALUES ('1', '网站标题', 'web_title', '萌宠之家', '1', '网站的显示标题，用于seo优化', 'input', '');
INSERT INTO `mc_config` VALUES ('3', '网站简介', 'web_description', '萌宠之家', '10', '网站主要业务的介绍1', 'input', '');
INSERT INTO `mc_config` VALUES ('6', '网站关键词', 'web_keywords', '萌宠之家', '0', '网站关键词，请用半角逗号(,)分隔多个关键字', 'textarea', '');
INSERT INTO `mc_config` VALUES ('5', '网站状态', 'web_status', '1', '5', '网站的打开关闭控制', 'radio', '0|关闭,1|开启');
INSERT INTO `mc_config` VALUES ('12', '使用条款', 'clause', '本站允许访问者查看其上的材料，但只能用于个人的、非商业用途，且不侵犯本站资料的任何著作权及其他合法权利。\r\n\r\n免责声明与责任限制 \r\n您使用本站不构成您与本站所有者的合同，本站内容只作为邀约邀请，而不是对您的邀约；本站也没有任何担保（包括但不限于针对特定目的的适用性和不侵犯知识产权等方面）。 如果您不理解邀约邀请的含义和后果，请在请教他人后使用。 \r\n在任何情况下，无论是根据合同或侵权行为抑或其它任何法律理论，也无论本站是否被告知有此类损害的可能性，本站及其与本站有合作的任何其它第三方均不对由于本站、链接到本站点的任何其他站点或者包含在任何或所有此类站点中的信息或服务的使用、无法使用或使用结果而造成的任何损害负责，包括但不限于直接的和/或间接的利润损失、数据损毁、精神损害等。\r\n\r\n本站力求给您提供安全、通畅的访问和其他服务，但由于Internet线路、垃圾邮件、黑客入侵或其他不可抗力等原因直接给您造成了损害，本站不负任何责任。\r\n\r\n注册用户应在线提交问题后，应在此后登陆会员区查看问题的处理结果，因各个邮件服务器反垃圾策略不同可能导致您不能完全依赖电子邮件获得本站的信息反馈。\r\n\r\n本站中指向其他第三方站点的链接\r\n\r\n本站某些内容指向其他第三方站点的链接仅仅为访问者方便。如果您使用这些链接，您将离开此本站。您通过由本站而链接到的第三方站点，您应自行承担可能的风险，本站不保证第三方站点的安全性。\r\n\r\n与本站进行链接\r\n\r\n您可以创建从自己拥有的站点或其它站点到本站的链接，但您不得使用包括但不限于隐藏本站域名、URL地址、改变本文本结构等任何技术的、非技术的手段使访问本站的访问者误认为您是本站所搭载内容的所有人；不得用与本站的链接为自己进行增加访问量、丰富内容、搜索引擎排名等任何营利；不得复制本站的内容；不得断章取义地链接某一内容，不得对本站内容进行虚假的陈述；不得侵犯本站的商标或标识。', '0', '网站注册使用条款', 'textarea', '');

-- ----------------------------
-- Table structure for mc_imgs
-- ----------------------------
DROP TABLE IF EXISTS `mc_imgs`;
CREATE TABLE `mc_imgs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(30) NOT NULL,
  `img` varchar(255) NOT NULL COMMENT '图片地址',
  `view` int(10) unsigned NOT NULL DEFAULT '0',
  `type` tinyint(255) NOT NULL DEFAULT '0' COMMENT '类型',
  `user_id` int(11) NOT NULL COMMENT '发布人id',
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of mc_imgs
-- ----------------------------

-- ----------------------------
-- Table structure for mc_mail_log
-- ----------------------------
DROP TABLE IF EXISTS `mc_mail_log`;
CREATE TABLE `mc_mail_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL DEFAULT '' COMMENT '邮箱',
  `activationcode` varchar(255) NOT NULL DEFAULT '' COMMENT '验证码',
  `create_time` varchar(255) NOT NULL DEFAULT '' COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of mc_mail_log
-- ----------------------------
INSERT INTO `mc_mail_log` VALUES ('2', '419091561@qq.com', '8d8128c4e26be0957a8bb8c08b82617b', '1529572811');

-- ----------------------------
-- Table structure for mc_menu
-- ----------------------------
DROP TABLE IF EXISTS `mc_menu`;
CREATE TABLE `mc_menu` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(60) NOT NULL DEFAULT '' COMMENT '菜单名',
  `order` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `href` varchar(255) NOT NULL DEFAULT '' COMMENT '地址',
  `pid` int(10) unsigned NOT NULL DEFAULT '0',
  `icon` varchar(100) NOT NULL DEFAULT '' COMMENT 'css样式',
  `bind_permission` int(10) unsigned NOT NULL COMMENT '绑定权限',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=57 DEFAULT CHARSET=utf8 COMMENT='后台菜单';

-- ----------------------------
-- Records of mc_menu
-- ----------------------------
INSERT INTO `mc_menu` VALUES ('1', '文章管理', '3', '', '0', 'fa-book', '0');
INSERT INTO `mc_menu` VALUES ('2', '权限管理', '2', '', '0', 'fa-lock', '0');
INSERT INTO `mc_menu` VALUES ('3', '系统设置', '1', '', '0', 'fa-cog', '0');
INSERT INTO `mc_menu` VALUES ('4', '广告管理', '3', '', '0', 'fa-image', '0');
INSERT INTO `mc_menu` VALUES ('5', '文章列表', '0', 'news', '1', 'fa-list-ul', '4');
INSERT INTO `mc_menu` VALUES ('6', '文章分类', '0', 'ArtCate', '1', 'fa-list-alt', '5');
INSERT INTO `mc_menu` VALUES ('7', '管理员列表', '0', 'power/list', '2', 'fa-list-ul', '12');
INSERT INTO `mc_menu` VALUES ('8', '角色管理', '1', 'power/role', '2', 'fa-male', '16');
INSERT INTO `mc_menu` VALUES ('10', '网站配置', '0', 'config', '3', 'fa-cubes', '20');
INSERT INTO `mc_menu` VALUES ('11', '自定义导航', '0', 'nav', '3', 'fa-navicon', '24');
INSERT INTO `mc_menu` VALUES ('12', '友情链接', '0', 'link', '3', 'fa-share-square-o', '28');
INSERT INTO `mc_menu` VALUES ('13', '广告列表', '2', 'ad', '4', 'fa-list', '32');
INSERT INTO `mc_menu` VALUES ('14', '广告位置', '1', 'ad_position', '4', 'fa-globe', '36');
INSERT INTO `mc_menu` VALUES ('15', '菜单管理', '0', 'menu', '3', 'fa-building-o', '40');
INSERT INTO `mc_menu` VALUES ('30', '会员管理', '0', '', '0', '&#xe613', '0');
INSERT INTO `mc_menu` VALUES ('31', '会员列表', '0', 'user', '30', 'fa-user', '64');
INSERT INTO `mc_menu` VALUES ('32', '订单管理', '0', '', '0', 'fa-building-o', '0');
INSERT INTO `mc_menu` VALUES ('53', '新的文章', '50', '', '1', '', '0');
INSERT INTO `mc_menu` VALUES ('34', '充值提现申请', '2', 'user_account', '30', 'fa-money', '72');
INSERT INTO `mc_menu` VALUES ('35', '会员等级', '4', 'user_rank', '30', 'fa-level-up', '75');
INSERT INTO `mc_menu` VALUES ('36', '轮播图列表', '0', 'banner', '3', ' fa-image', '84');
INSERT INTO `mc_menu` VALUES ('37', '积分商品', '0', 'exchange', '23', 'fa-list', '88');
INSERT INTO `mc_menu` VALUES ('38', '积分商品订单', '2', 'exchange_order', '32', 'fa-list', '92');
INSERT INTO `mc_menu` VALUES ('39', '投诉咨询管理', '0', '', '0', 'fa-graduation-cap', '0');
INSERT INTO `mc_menu` VALUES ('40', '咨询列表', '0', 'ask', '39', 'fa-list', '96');
INSERT INTO `mc_menu` VALUES ('41', '建议列表', '0', 'advise', '39', 'fa-list', '100');
INSERT INTO `mc_menu` VALUES ('42', '投诉列表', '0', 'complaint', '39', 'fa-list', '104');
INSERT INTO `mc_menu` VALUES ('43', '异常申请列表', '4', 'application', '30', 'fa-list', '108');
INSERT INTO `mc_menu` VALUES ('44', '报表统计', '0', '', '0', ' fa-bar-chart-o', '0');
INSERT INTO `mc_menu` VALUES ('45', '订单统计', '0', 'order_stats', '44', ' fa-table', '112');
INSERT INTO `mc_menu` VALUES ('46', '销售概况', '0', 'sale_general', '44', 'fa-list-alt', '113');
INSERT INTO `mc_menu` VALUES ('47', '销售明细', '0', 'sale_list', '44', ' fa-list-ul', '114');
INSERT INTO `mc_menu` VALUES ('48', '点卡管理', '0', '', '0', 'fa-keyboard-o', '0');
INSERT INTO `mc_menu` VALUES ('49', '点卡设置', '0', 'dk_config', '48', 'fa-cog', '115');
INSERT INTO `mc_menu` VALUES ('50', '充值订单', '0', 'dk_list', '48', 'fa-list', '116');
INSERT INTO `mc_menu` VALUES ('51', '点卡游戏列表', '0', 'dk_game_list', '48', 'fa-list', '117');
INSERT INTO `mc_menu` VALUES ('52', '日志记录', '0', 'log-viewer', '2', 'fa-list', '41');
INSERT INTO `mc_menu` VALUES ('54', '新的文章1', '50', '1', '1', '', '0');
INSERT INTO `mc_menu` VALUES ('55', '新的文章2', '50', '2', '1', '', '0');
INSERT INTO `mc_menu` VALUES ('56', '萌宠图集', '50', 'img', '0', 'fa-image', '0');

-- ----------------------------
-- Table structure for mc_migrations
-- ----------------------------
DROP TABLE IF EXISTS `mc_migrations`;
CREATE TABLE `mc_migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of mc_migrations
-- ----------------------------
INSERT INTO `mc_migrations` VALUES ('2014_10_12_000000_create_users_table', '1');
INSERT INTO `mc_migrations` VALUES ('2014_10_12_100000_create_password_resets_table', '1');
INSERT INTO `mc_migrations` VALUES ('2015_01_15_105324_create_roles_table', '1');
INSERT INTO `mc_migrations` VALUES ('2015_01_15_114412_create_role_user_table', '1');
INSERT INTO `mc_migrations` VALUES ('2015_01_26_115212_create_permissions_table', '1');
INSERT INTO `mc_migrations` VALUES ('2015_01_26_115523_create_permission_role_table', '1');
INSERT INTO `mc_migrations` VALUES ('2015_02_09_132439_create_permission_user_table', '1');

-- ----------------------------
-- Table structure for mc_nav
-- ----------------------------
DROP TABLE IF EXISTS `mc_nav`;
CREATE TABLE `mc_nav` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nav_name` varchar(50) NOT NULL DEFAULT '' COMMENT '导航名',
  `nav_order` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `nav_url` varchar(255) NOT NULL DEFAULT '' COMMENT '链接地址',
  `nav_wz` varchar(10) NOT NULL DEFAULT '' COMMENT '导航位置，1顶部，2主导航，3尾部',
  `is_show` varchar(10) NOT NULL DEFAULT '1' COMMENT '1显示，0不显示',
  `p_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '上级id',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COMMENT='前台导航';

-- ----------------------------
-- Records of mc_nav
-- ----------------------------
INSERT INTO `mc_nav` VALUES ('1', '发现萌宠', '50', 'sdf', '1', '1', '0');
INSERT INTO `mc_nav` VALUES ('2', '人气排行', '50', 'php', '1', '1', '1');
INSERT INTO `mc_nav` VALUES ('3', '萌宠趣闻', '50', 'cc', '1', '1', '0');
INSERT INTO `mc_nav` VALUES ('4', '萌宠专题', '50', '123', '1', '1', '0');
INSERT INTO `mc_nav` VALUES ('6', '最新发布', '50', 'cc', '1', '1', '1');

-- ----------------------------
-- Table structure for mc_password_resets
-- ----------------------------
DROP TABLE IF EXISTS `mc_password_resets`;
CREATE TABLE `mc_password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='//密码重置表';

-- ----------------------------
-- Records of mc_password_resets
-- ----------------------------

-- ----------------------------
-- Table structure for mc_permissions
-- ----------------------------
DROP TABLE IF EXISTS `mc_permissions`;
CREATE TABLE `mc_permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `model` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `pid` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_slug_unique` (`slug`)
) ENGINE=MyISAM AUTO_INCREMENT=118 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='//权限';

-- ----------------------------
-- Records of mc_permissions
-- ----------------------------
INSERT INTO `mc_permissions` VALUES ('1', 'Create news', 'create.news', '新增文章', '文章管理', '2016-08-10 10:43:59', '2016-08-10 10:43:59', '4');
INSERT INTO `mc_permissions` VALUES ('2', 'Delete news', 'delete.news', '删除文章', '文章管理', '2016-08-10 10:43:59', '2016-08-10 10:43:59', '4');
INSERT INTO `mc_permissions` VALUES ('3', 'Edit news', 'edit.news', '修改文章', '文章管理', '2016-08-10 14:05:50', '2016-08-10 14:05:52', '4');
INSERT INTO `mc_permissions` VALUES ('4', 'List news', 'list.news', '文章列表', '文章管理', '2016-08-10 14:07:44', '2016-08-10 14:07:46', '0');
INSERT INTO `mc_permissions` VALUES ('5', 'List artCate', 'list.artCate', '文章分类列表', '文章管理', '2016-08-10 14:08:59', '2016-08-10 14:09:01', '0');
INSERT INTO `mc_permissions` VALUES ('6', 'Create artCate', 'create.artCate', '新增文章分类', '文章管理', '2016-08-10 14:09:44', '2016-08-10 14:09:46', '5');
INSERT INTO `mc_permissions` VALUES ('7', 'Delete artCate', 'delete.artCate', '删除文章分类', '文章管理', '2016-08-10 14:10:22', '2016-08-10 14:10:24', '5');
INSERT INTO `mc_permissions` VALUES ('8', 'Edit artCate', 'edit.artCate', '修改文章分类', '文章管理', '2016-08-10 14:10:55', '2016-08-10 14:10:57', '5');
INSERT INTO `mc_permissions` VALUES ('9', 'Create admin', 'create.admin', '新增管理员', '权限管理', '2016-08-10 14:18:34', '2016-08-10 14:18:34', '12');
INSERT INTO `mc_permissions` VALUES ('10', 'Delete admin', 'delete.admin', '删除管理员', '权限管理', '2016-08-10 14:18:34', '2016-08-10 14:18:34', '12');
INSERT INTO `mc_permissions` VALUES ('11', 'Edit admin', 'edit.admin', '修改管理员', '权限管理', '2016-08-10 14:18:34', '2016-08-10 14:18:34', '12');
INSERT INTO `mc_permissions` VALUES ('12', 'List admin', 'list.admin', '管理员列表', '权限管理', '2016-08-10 14:18:34', '2016-08-10 14:18:34', '0');
INSERT INTO `mc_permissions` VALUES ('13', 'Create role', 'create.role', '新增角色', '权限管理', '2016-08-10 14:18:34', '2016-08-10 14:18:34', '16');
INSERT INTO `mc_permissions` VALUES ('14', 'Delete role', 'delete.role', '删除角色', '权限管理', '2016-08-10 14:18:34', '2016-08-10 14:18:34', '16');
INSERT INTO `mc_permissions` VALUES ('15', 'Edit role', 'edit.role', '修改角色', '权限管理', '2016-08-10 14:18:34', '2016-08-10 14:18:34', '16');
INSERT INTO `mc_permissions` VALUES ('16', 'List role', 'list.role', '角色列表', '权限管理', '2016-08-10 14:18:34', '2016-08-10 14:18:34', '0');
INSERT INTO `mc_permissions` VALUES ('17', 'Create config', 'create.config', '新增配置', '系统设置', '2016-08-10 14:21:14', '2016-08-10 14:21:14', '20');
INSERT INTO `mc_permissions` VALUES ('18', 'Delete config', 'delete.config', '删除配置', '系统设置', '2016-08-10 14:21:14', '2016-08-10 14:21:14', '20');
INSERT INTO `mc_permissions` VALUES ('19', 'Edit config', 'edit.config', '修改配置', '系统设置', '2016-08-10 14:21:14', '2016-08-10 14:21:14', '20');
INSERT INTO `mc_permissions` VALUES ('20', 'List config', 'list.config', '网站配置列表', '系统设置', '2016-08-10 14:21:14', '2016-08-10 14:21:14', '0');
INSERT INTO `mc_permissions` VALUES ('21', 'Create nav', 'create.nav', '新增自定义导航', '系统设置', '2016-08-10 14:21:14', '2016-08-10 14:21:14', '24');
INSERT INTO `mc_permissions` VALUES ('22', 'Delete nav', 'delete.nav', '删除自定义导航', '系统设置', '2016-08-10 14:21:14', '2016-08-10 14:21:14', '24');
INSERT INTO `mc_permissions` VALUES ('23', 'Edit nav', 'edit.nav', '修改自定义导航', '系统设置', '2016-08-10 14:21:14', '2016-08-10 14:21:14', '24');
INSERT INTO `mc_permissions` VALUES ('24', 'List nav', 'list.nav', '自定义导航列表', '系统设置', '2016-08-10 14:21:14', '2016-08-10 14:21:14', '0');
INSERT INTO `mc_permissions` VALUES ('25', 'Create link', 'create.link', '新增友情链接', '系统设置', '2016-08-10 14:22:39', '2016-08-10 14:22:39', '28');
INSERT INTO `mc_permissions` VALUES ('26', 'Delete link', 'delete.link', '删除友情链接', '系统设置', '2016-08-10 14:22:39', '2016-08-10 14:22:39', '28');
INSERT INTO `mc_permissions` VALUES ('27', 'Edit link', 'edit.link', '修改友情链接', '系统设置', '2016-08-10 14:22:39', '2016-08-10 14:22:39', '28');
INSERT INTO `mc_permissions` VALUES ('28', 'List link', 'list.link', '友情链接列表', '系统设置', '2016-08-10 14:22:39', '2016-08-10 14:22:39', '0');
INSERT INTO `mc_permissions` VALUES ('29', 'Create ad', 'create.ad', '新增广告', '广告管理', '2016-08-10 14:56:40', '2016-08-10 14:56:40', '32');
INSERT INTO `mc_permissions` VALUES ('30', 'Delete ad', 'delete.ad', '删除广告', '广告管理', '2016-08-10 14:56:40', '2016-08-10 14:56:40', '32');
INSERT INTO `mc_permissions` VALUES ('31', 'Edit ad', 'edit.ad', '修改广告', '广告管理', '2016-08-10 14:56:40', '2016-08-10 14:56:40', '32');
INSERT INTO `mc_permissions` VALUES ('32', 'List ad', 'list.ad', '广告列表', '广告管理', '2016-08-10 14:56:40', '2016-08-10 14:56:40', '0');
INSERT INTO `mc_permissions` VALUES ('33', 'Create adPosition', 'create.adposition', '新增广告位置', '广告管理', '2016-08-10 14:57:43', '2016-08-10 14:57:43', '36');
INSERT INTO `mc_permissions` VALUES ('34', 'Delete adPosition', 'delete.adposition', '删除广告位置', '广告管理', '2016-08-10 14:57:43', '2016-08-10 14:57:43', '36');
INSERT INTO `mc_permissions` VALUES ('35', 'Edit adPosition', 'edit.adposition', '修改广告位置', '广告管理', '2016-08-10 14:57:43', '2016-08-10 14:57:43', '36');
INSERT INTO `mc_permissions` VALUES ('36', 'List adPosition', 'list.adposition', '广告位置列表', '广告管理', '2016-08-10 14:57:43', '2016-08-10 14:57:43', '0');
INSERT INTO `mc_permissions` VALUES ('37', 'Create menu', 'create.menu', '创建菜单', '系统设置', '2016-08-11 10:35:13', '2016-08-11 10:35:17', '40');
INSERT INTO `mc_permissions` VALUES ('38', 'Delete menu', 'delete.menu', '删除菜单', '系统设置', '2016-08-11 10:35:49', '2016-08-11 10:35:52', '40');
INSERT INTO `mc_permissions` VALUES ('39', 'Edit menu', 'edit.menu', '修改菜单', '系统设置', '2016-08-11 10:36:22', '2016-08-11 10:36:24', '40');
INSERT INTO `mc_permissions` VALUES ('40', 'List menu', 'list.menu', '菜单列表', '系统设置', '2016-08-11 10:37:21', '2016-08-11 10:37:23', '0');
INSERT INTO `mc_permissions` VALUES ('41', 'List log', 'list.log', '日志列表', '权限管理', '2016-08-12 14:58:03', '2016-08-12 14:58:05', '0');
INSERT INTO `mc_permissions` VALUES ('64', 'List user', 'list.user', '会员列表', '用户管理', '2016-09-01 14:10:37', '2016-09-01 14:10:39', '0');
INSERT INTO `mc_permissions` VALUES ('65', 'Detele user', 'delete.user', '删除会员', '用户管理', '2016-09-01 14:11:04', '2016-09-01 14:11:06', '64');
INSERT INTO `mc_permissions` VALUES ('66', 'Create user', 'create.user', '新增会员', '用户管理', '2016-09-01 14:11:36', '2016-09-01 14:11:38', '64');
INSERT INTO `mc_permissions` VALUES ('67', 'Edit user', 'edit.user', '修改会员', '用户管理', '2016-09-01 14:12:04', '2016-09-01 14:12:06', '64');
INSERT INTO `mc_permissions` VALUES ('68', 'List account', 'list.account', '账目明细', '用户管理', '2016-09-06 10:18:27', '2016-09-06 10:18:30', '64');
INSERT INTO `mc_permissions` VALUES ('69', 'Create account', 'create.account', '调节账户', '用户管理', '2016-09-06 10:19:19', '2016-09-06 10:19:22', '64');
INSERT INTO `mc_permissions` VALUES ('75', 'List user_rank', 'list.user_rank', '会员等级列表', '用户管理', '2016-09-07 16:46:45', '2016-09-07 16:46:47', '0');
INSERT INTO `mc_permissions` VALUES ('76', 'Create user_rank', 'create.user_rank', '创建会员等级', '用户管理', '2016-09-07 16:47:31', '2016-09-07 16:47:33', '75');
INSERT INTO `mc_permissions` VALUES ('77', 'Edit user_rank', 'edit.user_rank', '修改会员等级', '用户管理', '2016-09-07 16:48:10', '2016-09-07 16:48:12', '75');
INSERT INTO `mc_permissions` VALUES ('78', 'Delete user_rank', 'delete.user_rank', '删除会员等级', '用户管理', '2016-09-07 16:48:54', '2016-09-07 16:48:56', '75');

-- ----------------------------
-- Table structure for mc_permission_role
-- ----------------------------
DROP TABLE IF EXISTS `mc_permission_role`;
CREATE TABLE `mc_permission_role` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `permission_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `permission_role_permission_id_index` (`permission_id`),
  KEY `permission_role_role_id_index` (`role_id`)
) ENGINE=MyISAM AUTO_INCREMENT=233 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='//权限角色';

-- ----------------------------
-- Records of mc_permission_role
-- ----------------------------
INSERT INTO `mc_permission_role` VALUES ('1', '1', '1', '2016-08-10 10:43:59', '2016-08-10 10:43:59');
INSERT INTO `mc_permission_role` VALUES ('2', '2', '1', '2016-08-10 10:44:39', '2016-08-10 10:44:42');
INSERT INTO `mc_permission_role` VALUES ('4', '3', '1', '2016-08-10 14:25:25', '2016-08-10 14:25:25');
INSERT INTO `mc_permission_role` VALUES ('5', '4', '1', '2016-08-10 14:25:25', '2016-08-10 14:25:25');
INSERT INTO `mc_permission_role` VALUES ('6', '5', '1', '2016-08-10 14:25:25', '2016-08-10 14:25:25');
INSERT INTO `mc_permission_role` VALUES ('7', '6', '1', '2016-08-10 14:25:25', '2016-08-10 14:25:25');
INSERT INTO `mc_permission_role` VALUES ('8', '7', '1', '2016-08-10 14:25:25', '2016-08-10 14:25:25');
INSERT INTO `mc_permission_role` VALUES ('9', '8', '1', '2016-08-10 14:25:25', '2016-08-10 14:25:25');
INSERT INTO `mc_permission_role` VALUES ('10', '9', '1', '2016-08-10 14:25:25', '2016-08-10 14:25:25');
INSERT INTO `mc_permission_role` VALUES ('11', '10', '1', '2016-08-10 14:25:25', '2016-08-10 14:25:25');
INSERT INTO `mc_permission_role` VALUES ('12', '11', '1', '2016-08-10 14:25:25', '2016-08-10 14:25:25');
INSERT INTO `mc_permission_role` VALUES ('13', '12', '1', '2016-08-10 14:25:25', '2016-08-10 14:25:25');
INSERT INTO `mc_permission_role` VALUES ('14', '13', '1', '2016-08-10 14:25:25', '2016-08-10 14:25:25');
INSERT INTO `mc_permission_role` VALUES ('15', '14', '1', '2016-08-10 14:25:25', '2016-08-10 14:25:25');
INSERT INTO `mc_permission_role` VALUES ('16', '15', '1', '2016-08-10 14:25:25', '2016-08-10 14:25:25');
INSERT INTO `mc_permission_role` VALUES ('17', '16', '1', '2016-08-10 14:25:25', '2016-08-10 14:25:25');
INSERT INTO `mc_permission_role` VALUES ('18', '17', '1', '2016-08-10 14:25:25', '2016-08-10 14:25:25');
INSERT INTO `mc_permission_role` VALUES ('19', '18', '1', '2016-08-10 14:25:25', '2016-08-10 14:25:25');
INSERT INTO `mc_permission_role` VALUES ('20', '19', '1', '2016-08-10 14:25:25', '2016-08-10 14:25:25');
INSERT INTO `mc_permission_role` VALUES ('21', '20', '1', '2016-08-10 14:25:25', '2016-08-10 14:25:25');
INSERT INTO `mc_permission_role` VALUES ('22', '21', '1', '2016-08-10 14:25:25', '2016-08-10 14:25:25');
INSERT INTO `mc_permission_role` VALUES ('23', '22', '1', '2016-08-10 14:25:25', '2016-08-10 14:25:25');
INSERT INTO `mc_permission_role` VALUES ('24', '23', '1', '2016-08-10 14:25:25', '2016-08-10 14:25:25');
INSERT INTO `mc_permission_role` VALUES ('25', '24', '1', '2016-08-10 14:25:25', '2016-08-10 14:25:25');
INSERT INTO `mc_permission_role` VALUES ('26', '25', '1', '2016-08-10 14:25:25', '2016-08-10 14:25:25');
INSERT INTO `mc_permission_role` VALUES ('27', '26', '1', '2016-08-10 14:25:25', '2016-08-10 14:25:25');
INSERT INTO `mc_permission_role` VALUES ('28', '27', '1', '2016-08-10 14:25:25', '2016-08-10 14:25:25');
INSERT INTO `mc_permission_role` VALUES ('29', '28', '1', '2016-08-10 14:25:25', '2016-08-10 14:25:25');
INSERT INTO `mc_permission_role` VALUES ('30', '29', '1', '2016-08-10 14:59:26', '2016-08-10 14:59:26');
INSERT INTO `mc_permission_role` VALUES ('31', '30', '1', '2016-08-10 14:59:26', '2016-08-10 14:59:26');
INSERT INTO `mc_permission_role` VALUES ('32', '31', '1', '2016-08-10 14:59:26', '2016-08-10 14:59:26');
INSERT INTO `mc_permission_role` VALUES ('33', '32', '1', '2016-08-10 14:59:26', '2016-08-10 14:59:26');
INSERT INTO `mc_permission_role` VALUES ('34', '33', '1', '2016-08-10 14:59:26', '2016-08-10 14:59:26');
INSERT INTO `mc_permission_role` VALUES ('35', '34', '1', '2016-08-10 14:59:26', '2016-08-10 14:59:26');
INSERT INTO `mc_permission_role` VALUES ('36', '35', '1', '2016-08-10 14:59:26', '2016-08-10 14:59:26');
INSERT INTO `mc_permission_role` VALUES ('37', '36', '1', '2016-08-10 14:59:26', '2016-08-10 14:59:26');
INSERT INTO `mc_permission_role` VALUES ('40', '37', '1', '2016-08-11 10:38:18', '2016-08-11 10:38:20');
INSERT INTO `mc_permission_role` VALUES ('41', '38', '1', '2016-08-11 10:38:27', '2016-08-11 10:38:30');
INSERT INTO `mc_permission_role` VALUES ('42', '39', '1', '2016-08-11 10:38:38', '2016-08-11 10:38:40');
INSERT INTO `mc_permission_role` VALUES ('43', '40', '1', '2016-08-11 10:38:50', '2016-08-11 10:38:52');
INSERT INTO `mc_permission_role` VALUES ('82', '41', '1', '2016-08-12 15:01:58', '2016-08-12 15:02:00');
INSERT INTO `mc_permission_role` VALUES ('160', '12', '2', null, null);
INSERT INTO `mc_permission_role` VALUES ('222', '35', '2', '2017-12-22 11:47:18', '2017-12-22 11:47:18');
INSERT INTO `mc_permission_role` VALUES ('221', '34', '2', '2017-12-22 11:47:18', '2017-12-22 11:47:18');
INSERT INTO `mc_permission_role` VALUES ('220', '33', '2', '2017-12-22 11:47:18', '2017-12-22 11:47:18');
INSERT INTO `mc_permission_role` VALUES ('219', '36', '2', '2017-12-22 11:47:18', '2017-12-22 11:47:18');
INSERT INTO `mc_permission_role` VALUES ('218', '31', '2', '2017-12-22 11:47:18', '2017-12-22 11:47:18');
INSERT INTO `mc_permission_role` VALUES ('217', '30', '2', '2017-12-22 11:47:18', '2017-12-22 11:47:18');
INSERT INTO `mc_permission_role` VALUES ('216', '29', '2', '2017-12-22 11:47:18', '2017-12-22 11:47:18');
INSERT INTO `mc_permission_role` VALUES ('215', '32', '2', '2017-12-22 11:47:18', '2017-12-22 11:47:18');
INSERT INTO `mc_permission_role` VALUES ('214', '8', '2', '2017-12-22 11:45:34', '2017-12-22 11:45:34');
INSERT INTO `mc_permission_role` VALUES ('213', '7', '2', '2017-12-22 11:45:34', '2017-12-22 11:45:34');
INSERT INTO `mc_permission_role` VALUES ('212', '6', '2', '2017-12-22 11:45:34', '2017-12-22 11:45:34');
INSERT INTO `mc_permission_role` VALUES ('211', '5', '2', '2017-12-22 11:45:34', '2017-12-22 11:45:34');
INSERT INTO `mc_permission_role` VALUES ('210', '3', '2', '2017-12-22 11:45:34', '2017-12-22 11:45:34');
INSERT INTO `mc_permission_role` VALUES ('209', '2', '2', '2017-12-22 11:45:34', '2017-12-22 11:45:34');
INSERT INTO `mc_permission_role` VALUES ('208', '1', '2', '2017-12-22 11:45:34', '2017-12-22 11:45:34');
INSERT INTO `mc_permission_role` VALUES ('207', '4', '2', '2017-12-22 11:45:34', '2017-12-22 11:45:34');
INSERT INTO `mc_permission_role` VALUES ('106', '64', '1', '2016-09-01 14:13:10', '2016-09-01 14:13:12');
INSERT INTO `mc_permission_role` VALUES ('107', '65', '1', '2016-09-01 14:13:17', '2016-09-01 14:13:19');
INSERT INTO `mc_permission_role` VALUES ('108', '66', '1', '2016-09-01 14:13:25', '2016-09-01 14:13:27');
INSERT INTO `mc_permission_role` VALUES ('109', '67', '1', '2016-09-01 14:13:32', '2016-09-01 14:13:34');
INSERT INTO `mc_permission_role` VALUES ('110', '68', '1', '2016-09-06 10:19:52', '2016-09-06 10:19:54');
INSERT INTO `mc_permission_role` VALUES ('111', '69', '1', '2016-09-06 10:20:03', '2016-09-06 10:20:05');
INSERT INTO `mc_permission_role` VALUES ('112', '70', '1', '2016-09-06 11:03:19', '2016-09-06 11:03:22');
INSERT INTO `mc_permission_role` VALUES ('113', '71', '1', '2016-09-06 11:03:29', '2016-09-06 11:03:32');
INSERT INTO `mc_permission_role` VALUES ('114', '72', '1', '2016-09-07 14:18:41', '2016-09-07 14:18:43');
INSERT INTO `mc_permission_role` VALUES ('115', '73', '1', '2016-09-07 14:18:57', '2016-09-07 14:19:05');
INSERT INTO `mc_permission_role` VALUES ('116', '74', '1', '2016-09-07 14:19:12', '2016-09-07 14:19:14');
INSERT INTO `mc_permission_role` VALUES ('117', '75', '1', '2016-09-07 16:49:19', '2016-09-07 16:49:21');
INSERT INTO `mc_permission_role` VALUES ('118', '76', '1', '2016-09-07 16:49:28', '2016-09-07 16:49:31');
INSERT INTO `mc_permission_role` VALUES ('119', '77', '1', '2016-09-07 16:49:37', '2016-09-07 16:49:39');
INSERT INTO `mc_permission_role` VALUES ('120', '78', '1', '2016-09-07 16:49:45', '2016-09-07 16:49:47');

-- ----------------------------
-- Table structure for mc_permission_user
-- ----------------------------
DROP TABLE IF EXISTS `mc_permission_user`;
CREATE TABLE `mc_permission_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `permission_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `permission_user_permission_id_index` (`permission_id`),
  KEY `permission_user_user_id_index` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='//权限用户';

-- ----------------------------
-- Records of mc_permission_user
-- ----------------------------

-- ----------------------------
-- Table structure for mc_roles
-- ----------------------------
DROP TABLE IF EXISTS `mc_roles`;
CREATE TABLE `mc_roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `level` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_slug_unique` (`slug`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='//角色';

-- ----------------------------
-- Records of mc_roles
-- ----------------------------
INSERT INTO `mc_roles` VALUES ('1', 'admin', 'admin', '系统管理员', '6', '2017-11-27 11:04:12', '2017-11-27 11:04:15');
INSERT INTO `mc_roles` VALUES ('2', 'manager', 'manager', '网站管理', '5', '2017-11-27 17:02:08', '2017-11-27 17:02:10');

-- ----------------------------
-- Table structure for mc_role_user
-- ----------------------------
DROP TABLE IF EXISTS `mc_role_user`;
CREATE TABLE `mc_role_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `role_user_role_id_index` (`role_id`),
  KEY `role_user_user_id_index` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='//角色用户';

-- ----------------------------
-- Records of mc_role_user
-- ----------------------------
INSERT INTO `mc_role_user` VALUES ('1', '1', '1', '2017-11-27 11:09:12', '2017-11-27 11:09:14');
INSERT INTO `mc_role_user` VALUES ('2', '2', '2', '2017-11-27 17:18:51', '2017-11-27 17:18:54');
INSERT INTO `mc_role_user` VALUES ('8', '2', '9', '2018-05-11 10:56:47', '2018-05-11 10:56:47');

-- ----------------------------
-- Table structure for mc_tag
-- ----------------------------
DROP TABLE IF EXISTS `mc_tag`;
CREATE TABLE `mc_tag` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tag` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of mc_tag
-- ----------------------------

-- ----------------------------
-- Table structure for mc_users
-- ----------------------------
DROP TABLE IF EXISTS `mc_users`;
CREATE TABLE `mc_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '用户名',
  `nickname` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT '' COMMENT '邮箱',
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '密码',
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '记住我字段',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_admin` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '是否后台管理,0不是，1是',
  `is_check_email` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '0没验证，1验证',
  `qq` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT 'QQ',
  `head_img` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '头像',
  `online_status` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '在线状态，0没在线，1在线',
  `integral` varchar(255) COLLATE utf8_unicode_ci DEFAULT '0' COMMENT '积分',
  `telphone` varchar(255) COLLATE utf8_unicode_ci DEFAULT '' COMMENT '手机',
  `is_check_phone` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '0没验证，1验证',
  `sex` tinyint(3) unsigned NOT NULL DEFAULT '2' COMMENT '性别，0男，1女，2保密',
  `reg_time` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '注册时间',
  `last_login` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '上次登录时间',
  `last_ip` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '上次登录ip',
  `status` tinyint(3) NOT NULL DEFAULT '0' COMMENT '0帐号正常，1封闭',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='用户表';

-- ----------------------------
-- Records of mc_users
-- ----------------------------
INSERT INTO `mc_users` VALUES ('1', 'admin', null, '1111111@qq.com', 'eyJpdiI6IlRWYng5U09cL09UZm42ZXQ5cW5OQTlBPT0iLCJ2YWx1ZSI6ImZZVE9nT2dDY0hUTVlyYW5MSzBheVE9PSIsIm1hYyI6IjgxM2U0Yjk3ODkwY2M2NGYzNTE2OTcxNDJhNTExNWY4ZGE0YWYxM2MwMWQ0ZTI1NWQyYjBjNzc3NTRjMGUzNjQifQ==', null, '2017-11-24 12:00:30', '2018-06-11 15:35:27', '1', '0', '', '', '0', '0', '', '0', '2', '', '1528702527', '127.0.0.1', '0');
INSERT INTO `mc_users` VALUES ('2', 'admin1', null, '66666@qq.com', 'eyJpdiI6IjRRNDlYUUpla2pRMkU4RHE3U2wwaEE9PSIsInZhbHVlIjoiYmFWODNLK3FNVFBBM2VCQ2RiRFZCUT09IiwibWFjIjoiY2VhMWUyMTdjYzFkMjY1NTIwNWJhNjkyNjMxNjEwMDhmMTUyYWE5MmI2NzBlMDg5MjRmN2RlYTc2OGEzMjAxYyJ9', null, '2017-11-27 17:02:37', '2018-01-29 10:36:13', '1', '0', '', '', '0', '0', '', '0', '2', '', '1517193373', '127.0.0.1', '0');
INSERT INTO `mc_users` VALUES ('8', 'lirn123', 'lirn', '56464@qq.com', '$2y$10$lGZEHB5MRFk.y38rBZsrc.1I0MvVnt7Pw184s7WJrcz5s1RgBA48O', null, '2018-03-09 15:13:31', '2018-03-09 15:13:31', '0', '0', '464647971', '/uploads/180309/1803093861.jpg', '0', '0', '18536954121', '0', '2', '1520579611', '1520579611', '', '0');
INSERT INTO `mc_users` VALUES ('9', 'admin2', null, 'admin2@qq.com', 'eyJpdiI6IkVLanlmVE9kOENIbmt4eXFJTnZSTWc9PSIsInZhbHVlIjoiWkVXS0NVSHpoSlkwVXNuNVBFWXlLQT09IiwibWFjIjoiM2E3ZTExMTg5YjA3ZGFkNDk2MmE2YThmMTJiMzc3NmUyOTkzYmQ0NjAzNGEwZDg2NGQ1MmUwNjhmYTQ0YjU5NCJ9', null, '2018-05-11 10:56:47', '2018-05-11 10:57:05', '1', '0', '', '', '0', '0', '', '0', '2', '', '1526007425', '127.0.0.1', '0');
INSERT INTO `mc_users` VALUES ('10', '419091561@qq.com', null, '419091561@qq.com', '$2y$10$AACuJON1VLSzTwRarpaeQezCqP7PGTUazMYunVLLfeI1cKPMOmY8C', 'zyBG1qRc5l0AImfhNLAhOns8NDTboz1dWI759aoxrqotIMLXiHbk7fMcUAGA', '2018-06-13 17:42:55', '2018-06-21 17:21:49', '0', '0', '', '', '0', '0', '', '0', '2', '1528882975', '1528882975', '', '0');
