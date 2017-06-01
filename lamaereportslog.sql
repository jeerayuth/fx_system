/*
Navicat MySQL Data Transfer

Source Server         : SERVER_MASTER
Source Server Version : 50532
Source Host           : 192.168.1.253:3306
Source Database       : hos

Target Server Type    : MYSQL
Target Server Version : 50532
File Encoding         : 65001

Date: 2017-02-28 14:07:23
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `lamaereportslog`
-- ----------------------------
DROP TABLE IF EXISTS `lamaereportslog`;
CREATE TABLE `lamaereportslog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `controller` varchar(100) NOT NULL,
  `report` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `viewlog` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=706 DEFAULT CHARSET=tis620;

-- ----------------------------
-- Records of lamaereportslog
-- ----------------------------
INSERT INTO lamaereportslog VALUES ('1', 'medical', 'report9', 'natty', '2017-02-03 10:53:51');
INSERT INTO lamaereportslog VALUES ('2', 'medical', 'report10', 'natty', '2017-02-03 10:53:58');
INSERT INTO lamaereportslog VALUES ('3', 'medical', 'report9', 'natty', '2017-02-03 10:57:55');
INSERT INTO lamaereportslog VALUES ('4', 'medical', 'report10', 'natty', '2017-02-03 10:57:59');
INSERT INTO lamaereportslog VALUES ('5', 'medical', 'report9', 'natty', '2017-02-03 10:59:11');
INSERT INTO lamaereportslog VALUES ('6', 'medical', 'report10', 'natty', '2017-02-03 10:59:18');
INSERT INTO lamaereportslog VALUES ('53', 'pcu', 'report1', 'นิธิกานต์', '2017-02-06 13:14:56');
INSERT INTO lamaereportslog VALUES ('52', 'pcu', 'report2', 'นิธิกานต์', '2017-02-06 13:05:54');
INSERT INTO lamaereportslog VALUES ('51', 'pcu', 'report1', 'นิธิกานต์', '2017-02-06 13:05:50');
INSERT INTO lamaereportslog VALUES ('50', 'pcu', 'report2', 'นิธิกานต์', '2017-02-06 12:50:05');
INSERT INTO lamaereportslog VALUES ('48', 'arv', 'report1', 'จิราวรรณ', '2017-02-06 08:54:45');
INSERT INTO lamaereportslog VALUES ('49', 'pcu', 'report1', 'นิธิกานต์', '2017-02-06 12:50:01');
INSERT INTO lamaereportslog VALUES ('46', 'pcu', 'report1', 'siro', '2017-02-06 08:47:36');
INSERT INTO lamaereportslog VALUES ('45', 'pcu', 'report2', 'siro', '2017-02-06 08:47:28');
INSERT INTO lamaereportslog VALUES ('44', 'pcu', 'report1', 'siro', '2017-02-06 08:47:22');
INSERT INTO lamaereportslog VALUES ('43', 'arv', 'report1', 'จิราวรรณ', '2017-02-06 08:44:04');
INSERT INTO lamaereportslog VALUES ('42', 'medical', 'report10', 'natty', '2017-02-03 15:56:02');
INSERT INTO lamaereportslog VALUES ('21', 'medical', 'report10', 'natty', '2017-02-03 11:22:34');
INSERT INTO lamaereportslog VALUES ('20', 'medical', 'report9', 'natty', '2017-02-03 11:22:31');
INSERT INTO lamaereportslog VALUES ('41', 'medical', 'report10', 'natty', '2017-02-03 15:47:38');
INSERT INTO lamaereportslog VALUES ('40', 'medical', 'report9', 'natty', '2017-02-03 15:47:35');
INSERT INTO lamaereportslog VALUES ('39', 'medical', 'report10', 'natty', '2017-02-03 15:46:01');
INSERT INTO lamaereportslog VALUES ('38', 'medical', 'report9', 'natty', '2017-02-03 15:45:51');
INSERT INTO lamaereportslog VALUES ('37', 'tb', 'report1', 'arrawan', '2017-02-03 12:40:24');
INSERT INTO lamaereportslog VALUES ('54', 'pcu', 'report2', 'นิธิกานต์', '2017-02-06 13:15:01');
INSERT INTO lamaereportslog VALUES ('55', 'pcu', 'report20', 'นิธิกานต์', '2017-02-06 14:36:30');
INSERT INTO lamaereportslog VALUES ('56', 'pcu', 'report20', 'นิธิกานต์', '2017-02-06 14:36:46');
INSERT INTO lamaereportslog VALUES ('57', 'pcu', 'report20', 'นิธิกานต์', '2017-02-06 14:39:14');
INSERT INTO lamaereportslog VALUES ('61', 'account', 'report1', 'lukkana', '2017-02-08 09:50:00');
INSERT INTO lamaereportslog VALUES ('60', 'account', 'report1', 'lukkana', '2017-02-08 09:45:42');
INSERT INTO lamaereportslog VALUES ('62', 'account', 'report1', 'lukkana', '2017-02-08 09:54:00');
INSERT INTO lamaereportslog VALUES ('63', 'account', 'report1', 'lukkana', '2017-02-08 09:56:18');
INSERT INTO lamaereportslog VALUES ('64', 'account', 'report1', 'lukkana', '2017-02-08 09:58:53');
INSERT INTO lamaereportslog VALUES ('65', 'claim', 'report3', 'lukkana', '2017-02-08 10:02:20');
INSERT INTO lamaereportslog VALUES ('66', 'claim', 'report3', 'lukkana', '2017-02-08 10:20:11');
INSERT INTO lamaereportslog VALUES ('67', 'claim', 'report3', 'lukkana', '2017-02-08 10:31:23');
INSERT INTO lamaereportslog VALUES ('68', 'claim', 'report3', 'lukkana', '2017-02-08 10:38:48');
INSERT INTO lamaereportslog VALUES ('69', 'arv', 'report1', 'จิราวรรณ', '2017-02-08 11:15:23');
INSERT INTO lamaereportslog VALUES ('70', 'arv', 'report1', 'จิราวรรณ', '2017-02-08 11:19:09');
INSERT INTO lamaereportslog VALUES ('342', 'dm', 'report21', 'อัมพิกา', '2017-02-21 14:03:01');
INSERT INTO lamaereportslog VALUES ('280', 'claim', 'report5', 'riam', '2017-02-20 10:04:35');
INSERT INTO lamaereportslog VALUES ('340', 'claim', 'report10', 'natty', '2017-02-21 13:57:11');
INSERT INTO lamaereportslog VALUES ('339', 'claim', 'report11', 'natty', '2017-02-21 13:54:56');
INSERT INTO lamaereportslog VALUES ('508', 'pcu', 'report25', 'นิธิกานต์', '2017-02-23 15:39:17');
INSERT INTO lamaereportslog VALUES ('337', 'medical', 'report1', 'ปวิมล', '2017-02-20 18:42:46');
INSERT INTO lamaereportslog VALUES ('272', 'ttm', 'report2', 'ttm', '2017-02-20 09:13:19');
INSERT INTO lamaereportslog VALUES ('271', 'ttm', 'report2', 'ttm', '2017-02-20 09:13:16');
INSERT INTO lamaereportslog VALUES ('270', 'ttm', 'report2', 'ttm', '2017-02-20 09:12:53');
INSERT INTO lamaereportslog VALUES ('269', 'ttm', 'report2', 'ttm', '2017-02-20 09:12:43');
INSERT INTO lamaereportslog VALUES ('268', 'ttm', 'report3', 'ttm', '2017-02-20 09:11:24');
INSERT INTO lamaereportslog VALUES ('507', 'pcu', 'report25', 'นิธิกานต์', '2017-02-23 15:38:41');
INSERT INTO lamaereportslog VALUES ('266', 'ttm', 'report3', 'ttm', '2017-02-20 09:08:49');
INSERT INTO lamaereportslog VALUES ('264', 'claim', 'report12', 'TU', '2017-02-20 09:03:21');
INSERT INTO lamaereportslog VALUES ('92', 'claim', 'report3', 'lukkana', '2017-02-08 15:37:57');
INSERT INTO lamaereportslog VALUES ('93', 'claim', 'report3', 'lukkana', '2017-02-08 15:38:17');
INSERT INTO lamaereportslog VALUES ('265', 'ttm', 'report3', 'ttm', '2017-02-20 09:07:33');
INSERT INTO lamaereportslog VALUES ('263', 'ttm', 'report3', 'ttm', '2017-02-20 08:53:04');
INSERT INTO lamaereportslog VALUES ('262', 'claim', 'report15', 'TU', '2017-02-20 08:45:14');
INSERT INTO lamaereportslog VALUES ('261', 'dm', 'report20', 'อัมพิกา', '2017-02-17 14:52:46');
INSERT INTO lamaereportslog VALUES ('260', 'dm', 'report20', 'อัมพิกา', '2017-02-17 14:40:00');
INSERT INTO lamaereportslog VALUES ('259', 'dm', 'report21', 'อัมพิกา', '2017-02-17 14:34:06');
INSERT INTO lamaereportslog VALUES ('258', 'dm', 'report21', 'อัมพิกา', '2017-02-17 14:32:11');
INSERT INTO lamaereportslog VALUES ('257', 'dm', 'report21', 'อัมพิกา', '2017-02-17 14:28:09');
INSERT INTO lamaereportslog VALUES ('256', 'pcu', 'report20', 'นิธิกานต์', '2017-02-17 13:42:11');
INSERT INTO lamaereportslog VALUES ('255', 'pcu', 'report20', 'นิธิกานต์', '2017-02-17 13:42:01');
INSERT INTO lamaereportslog VALUES ('112', 'ward', 'report5', 'อัมพิกา', '2017-02-09 11:19:53');
INSERT INTO lamaereportslog VALUES ('254', 'account', 'report1', 'lukkana', '2017-02-17 11:31:00');
INSERT INTO lamaereportslog VALUES ('253', 'account', 'report1', 'lukkana', '2017-02-17 11:30:33');
INSERT INTO lamaereportslog VALUES ('252', 'account', 'report1', 'lukkana', '2017-02-17 11:30:29');
INSERT INTO lamaereportslog VALUES ('251', 'account', 'report1', 'lukkana', '2017-02-17 11:29:29');
INSERT INTO lamaereportslog VALUES ('233', 'claim', 'report12', 'TU', '2017-02-16 13:11:37');
INSERT INTO lamaereportslog VALUES ('232', 'claim', 'report15', 'TU', '2017-02-16 09:10:45');
INSERT INTO lamaereportslog VALUES ('231', 'claim', 'report12', 'TU', '2017-02-16 09:05:06');
INSERT INTO lamaereportslog VALUES ('230', 'claim', 'report13', 'TU', '2017-02-16 09:01:43');
INSERT INTO lamaereportslog VALUES ('225', 'medical', 'report5', 'ศุภนารี', '2017-02-15 09:34:04');
INSERT INTO lamaereportslog VALUES ('224', 'medical', 'report5', 'ศุภนารี', '2017-02-15 09:32:13');
INSERT INTO lamaereportslog VALUES ('223', 'medical', 'report5', 'ศุภนารี', '2017-02-15 09:31:38');
INSERT INTO lamaereportslog VALUES ('222', 'medical', 'report11', 'ศุภนารี', '2017-02-15 09:28:56');
INSERT INTO lamaereportslog VALUES ('221', 'medical', 'report11', 'ศุภนารี', '2017-02-15 09:27:13');
INSERT INTO lamaereportslog VALUES ('136', 'dm', 'report20', 'อัมพิกา', '2017-02-09 13:55:07');
INSERT INTO lamaereportslog VALUES ('220', 'medical', 'report11', 'ศุภนารี', '2017-02-15 09:26:07');
INSERT INTO lamaereportslog VALUES ('219', 'medical', 'report11', 'ศุภนารี', '2017-02-15 09:24:54');
INSERT INTO lamaereportslog VALUES ('218', 'medical', 'report11', 'ศุภนารี', '2017-02-15 09:23:41');
INSERT INTO lamaereportslog VALUES ('144', 'ht', 'report12', 'อัมพิกา', '2017-02-09 14:34:55');
INSERT INTO lamaereportslog VALUES ('145', 'dm', 'report15', 'อัมพิกา', '2017-02-09 14:35:53');
INSERT INTO lamaereportslog VALUES ('217', 'medical', 'report11', 'ศุภนารี', '2017-02-15 09:23:26');
INSERT INTO lamaereportslog VALUES ('216', 'claim', 'report7', 'riam', '2017-02-15 09:23:11');
INSERT INTO lamaereportslog VALUES ('149', 'dm', 'report16', 'อัมพิกา', '2017-02-09 14:37:39');
INSERT INTO lamaereportslog VALUES ('215', 'medical', 'report11', 'ศุภนารี', '2017-02-15 09:22:28');
INSERT INTO lamaereportslog VALUES ('202', 'claim', 'report6', 'riam', '2017-02-14 11:46:55');
INSERT INTO lamaereportslog VALUES ('214', 'medical', 'report11', 'ศุภนารี', '2017-02-15 09:22:15');
INSERT INTO lamaereportslog VALUES ('155', 'pcu', 'report1', 'นิธิกานต์', '2017-02-09 15:35:51');
INSERT INTO lamaereportslog VALUES ('156', 'pcu', 'report2', 'นิธิกานต์', '2017-02-09 15:35:57');
INSERT INTO lamaereportslog VALUES ('157', 'dm', 'report20', 'อัมพิกา', '2017-02-09 15:44:57');
INSERT INTO lamaereportslog VALUES ('158', 'pcu', 'report1', 'นิธิกานต์', '2017-02-09 15:46:29');
INSERT INTO lamaereportslog VALUES ('159', 'dm', 'report20', 'อัมพิกา', '2017-02-09 15:52:32');
INSERT INTO lamaereportslog VALUES ('160', 'dm', 'report20', 'อัมพิกา', '2017-02-09 15:55:07');
INSERT INTO lamaereportslog VALUES ('213', 'medical', 'report11', 'ศุภนารี', '2017-02-15 09:21:06');
INSERT INTO lamaereportslog VALUES ('212', 'medical', 'report11', 'ศุภนารี', '2017-02-15 09:20:21');
INSERT INTO lamaereportslog VALUES ('211', 'medical', 'report11', 'ศุภนารี', '2017-02-15 09:19:51');
INSERT INTO lamaereportslog VALUES ('210', 'medical', 'report11', 'ศุภนารี', '2017-02-15 09:18:48');
INSERT INTO lamaereportslog VALUES ('209', 'medical', 'report11', 'ศุภนารี', '2017-02-15 09:15:25');
INSERT INTO lamaereportslog VALUES ('208', 'medical', 'report11', 'ศุภนารี', '2017-02-15 09:15:03');
INSERT INTO lamaereportslog VALUES ('207', 'pcu', 'report24', 'นิธิกานต์', '2017-02-14 15:48:02');
INSERT INTO lamaereportslog VALUES ('206', 'pcu', 'report25', 'นิธิกานต์', '2017-02-14 15:42:36');
INSERT INTO lamaereportslog VALUES ('205', 'pcu', 'report24', 'นิธิกานต์', '2017-02-14 15:42:11');
INSERT INTO lamaereportslog VALUES ('204', 'pcu', 'report3', 'นิธิกานต์', '2017-02-14 15:41:02');
INSERT INTO lamaereportslog VALUES ('335', 'ttm', 'report5', 'ttm', '2017-02-20 15:40:39');
INSERT INTO lamaereportslog VALUES ('284', 'claim', 'report5', 'riam', '2017-02-20 10:13:17');
INSERT INTO lamaereportslog VALUES ('334', 'ttm', 'report5', 'ttm', '2017-02-20 15:39:40');
INSERT INTO lamaereportslog VALUES ('333', 'ttm', 'report5', 'ttm', '2017-02-20 15:39:23');
INSERT INTO lamaereportslog VALUES ('506', 'pcu', 'report24', 'นิธิกานต์', '2017-02-23 15:38:28');
INSERT INTO lamaereportslog VALUES ('319', 'dm', 'report6', 'อัมพิกา', '2017-02-20 14:27:51');
INSERT INTO lamaereportslog VALUES ('318', 'dm', 'report6', 'อัมพิกา', '2017-02-20 14:20:18');
INSERT INTO lamaereportslog VALUES ('486', 'pcu', 'report25', 'นิธิกานต์', '2017-02-23 14:42:00');
INSERT INTO lamaereportslog VALUES ('485', 'pcu', 'report25', 'นิธิกานต์', '2017-02-23 14:35:33');
INSERT INTO lamaereportslog VALUES ('484', 'pcu', 'report25', 'นิธิกานต์', '2017-02-23 14:34:17');
INSERT INTO lamaereportslog VALUES ('483', 'pcu', 'report25', 'นิธิกานต์', '2017-02-23 14:17:09');
INSERT INTO lamaereportslog VALUES ('482', 'pcu', 'report25', 'นิธิกานต์', '2017-02-23 14:12:53');
INSERT INTO lamaereportslog VALUES ('481', 'pcu', 'report25', 'นิธิกานต์', '2017-02-23 14:11:12');
INSERT INTO lamaereportslog VALUES ('480', 'pcu', 'report25', 'นิธิกานต์', '2017-02-23 13:47:07');
INSERT INTO lamaereportslog VALUES ('479', 'pcu', 'report25', 'นิธิกานต์', '2017-02-23 13:44:55');
INSERT INTO lamaereportslog VALUES ('478', 'pcu', 'report25', 'นิธิกานต์', '2017-02-23 13:41:22');
INSERT INTO lamaereportslog VALUES ('361', 'dm', 'report21', 'อัมพิกา', '2017-02-21 15:43:53');
INSERT INTO lamaereportslog VALUES ('362', 'dm', 'report19', 'อัมพิกา', '2017-02-21 15:44:59');
INSERT INTO lamaereportslog VALUES ('477', 'pcu', 'report25', 'นิธิกานต์', '2017-02-23 13:25:48');
INSERT INTO lamaereportslog VALUES ('476', 'pcu', 'report24', 'นิธิกานต์', '2017-02-23 13:25:29');
INSERT INTO lamaereportslog VALUES ('366', 'ttm', 'report4', 'ttm', '2017-02-21 16:58:43');
INSERT INTO lamaereportslog VALUES ('367', 'ttm', 'report5', 'ttm', '2017-02-21 21:11:00');
INSERT INTO lamaereportslog VALUES ('466', 'medical', 'report10', 'sao', '2017-02-23 08:59:58');
INSERT INTO lamaereportslog VALUES ('465', 'medical', 'report9', 'sao', '2017-02-23 08:59:53');
INSERT INTO lamaereportslog VALUES ('464', 'medical', 'report9', 'sao', '2017-02-23 08:59:44');
INSERT INTO lamaereportslog VALUES ('463', 'medical', 'report3', 'sao', '2017-02-23 08:59:04');
INSERT INTO lamaereportslog VALUES ('462', 'pcu', 'report25', 'นิธิกานต์', '2017-02-23 08:45:26');
INSERT INTO lamaereportslog VALUES ('461', 'pcu', 'report25', 'นิธิกานต์', '2017-02-23 08:41:30');
INSERT INTO lamaereportslog VALUES ('387', 'pcu', 'report1', 'sao', '2017-02-22 11:46:16');
INSERT INTO lamaereportslog VALUES ('388', 'pcu', 'report3', 'sao', '2017-02-22 11:46:28');
INSERT INTO lamaereportslog VALUES ('389', 'pcu', 'report5', 'sao', '2017-02-22 11:47:14');
INSERT INTO lamaereportslog VALUES ('390', 'pcu', 'report6', 'sao', '2017-02-22 11:48:05');
INSERT INTO lamaereportslog VALUES ('391', 'pcu', 'report7', 'sao', '2017-02-22 11:48:27');
INSERT INTO lamaereportslog VALUES ('392', 'pcu', 'report8', 'sao', '2017-02-22 11:49:00');
INSERT INTO lamaereportslog VALUES ('393', 'pcu', 'report9', 'sao', '2017-02-22 11:49:21');
INSERT INTO lamaereportslog VALUES ('394', 'pcu', 'report10', 'sao', '2017-02-22 11:49:42');
INSERT INTO lamaereportslog VALUES ('395', 'pcu', 'report11', 'sao', '2017-02-22 11:50:03');
INSERT INTO lamaereportslog VALUES ('396', 'pcu', 'report12', 'sao', '2017-02-22 11:50:19');
INSERT INTO lamaereportslog VALUES ('397', 'pcu', 'report13', 'sao', '2017-02-22 11:50:32');
INSERT INTO lamaereportslog VALUES ('398', 'pcu', 'report14', 'sao', '2017-02-22 11:50:58');
INSERT INTO lamaereportslog VALUES ('399', 'pcu', 'report15', 'sao', '2017-02-22 11:51:16');
INSERT INTO lamaereportslog VALUES ('400', 'pcu', 'report16', 'sao', '2017-02-22 11:51:28');
INSERT INTO lamaereportslog VALUES ('401', 'pcu', 'report15', 'sao', '2017-02-22 11:51:44');
INSERT INTO lamaereportslog VALUES ('402', 'pcu', 'report17', 'sao', '2017-02-22 11:51:57');
INSERT INTO lamaereportslog VALUES ('403', 'pcu', 'report18', 'sao', '2017-02-22 11:52:20');
INSERT INTO lamaereportslog VALUES ('404', 'pcu', 'report19', 'sao', '2017-02-22 11:52:38');
INSERT INTO lamaereportslog VALUES ('405', 'pcu', 'report21', 'sao', '2017-02-22 11:53:03');
INSERT INTO lamaereportslog VALUES ('406', 'pcu', 'report23', 'sao', '2017-02-22 11:53:15');
INSERT INTO lamaereportslog VALUES ('460', 'pcu', 'report24', 'นิธิกานต์', '2017-02-23 08:39:59');
INSERT INTO lamaereportslog VALUES ('408', 'pcu', 'report23', 'sao', '2017-02-22 11:53:33');
INSERT INTO lamaereportslog VALUES ('409', 'pcu', 'report22', 'sao', '2017-02-22 11:53:52');
INSERT INTO lamaereportslog VALUES ('410', 'pcu', 'report24', 'sao', '2017-02-22 11:54:22');
INSERT INTO lamaereportslog VALUES ('411', 'pcu', 'report25', 'sao', '2017-02-22 11:54:31');
INSERT INTO lamaereportslog VALUES ('412', 'pcu', 'report23', 'sao', '2017-02-22 11:56:11');
INSERT INTO lamaereportslog VALUES ('459', 'pcu', 'report14', 'sao', '2017-02-22 14:18:25');
INSERT INTO lamaereportslog VALUES ('414', 'pcu', 'report23', 'sao', '2017-02-22 11:57:24');
INSERT INTO lamaereportslog VALUES ('415', 'pcu', 'report16', 'sao', '2017-02-22 11:57:44');
INSERT INTO lamaereportslog VALUES ('458', 'pcu', 'report8', 'sao', '2017-02-22 14:17:49');
INSERT INTO lamaereportslog VALUES ('457', 'pcu', 'report8', 'sao', '2017-02-22 14:16:54');
INSERT INTO lamaereportslog VALUES ('456', 'pcu', 'report9', 'sao', '2017-02-22 14:16:41');
INSERT INTO lamaereportslog VALUES ('455', 'pcu', 'report9', 'sao', '2017-02-22 14:11:24');
INSERT INTO lamaereportslog VALUES ('454', 'pcu', 'report7', 'sao', '2017-02-22 14:11:02');
INSERT INTO lamaereportslog VALUES ('435', 'pcu', 'report7', 'sao', '2017-02-22 13:38:17');
INSERT INTO lamaereportslog VALUES ('422', 'emergen', 'report9', 'ka', '2017-02-22 12:44:55');
INSERT INTO lamaereportslog VALUES ('423', 'emergen', 'report9', 'ka', '2017-02-22 12:48:28');
INSERT INTO lamaereportslog VALUES ('424', 'emergen', 'report9', 'ka', '2017-02-22 12:49:53');
INSERT INTO lamaereportslog VALUES ('425', 'emergen', 'report9', 'ka', '2017-02-22 12:51:13');
INSERT INTO lamaereportslog VALUES ('426', 'emergen', 'report9', 'ka', '2017-02-22 12:52:37');
INSERT INTO lamaereportslog VALUES ('434', 'pcu', 'report19', 'sao', '2017-02-22 13:32:23');
INSERT INTO lamaereportslog VALUES ('428', 'pcu', 'report16', 'sao', '2017-02-22 12:58:31');
INSERT INTO lamaereportslog VALUES ('429', 'pcu', 'report15', 'sao', '2017-02-22 12:58:44');
INSERT INTO lamaereportslog VALUES ('433', 'pcu', 'report18', 'sao', '2017-02-22 13:32:08');
INSERT INTO lamaereportslog VALUES ('431', 'pcu', 'report13', 'sao', '2017-02-22 13:03:19');
INSERT INTO lamaereportslog VALUES ('432', 'pcu', 'report18', 'sao', '2017-02-22 13:19:26');
INSERT INTO lamaereportslog VALUES ('511', 'pcu', 'report24', 'นิธิกานต์', '2017-02-24 11:02:17');
INSERT INTO lamaereportslog VALUES ('512', 'pcu', 'report25', 'นิธิกานต์', '2017-02-24 11:06:34');
INSERT INTO lamaereportslog VALUES ('513', 'pcu', 'report25', 'นิธิกานต์', '2017-02-24 11:10:53');
INSERT INTO lamaereportslog VALUES ('514', 'pcu', 'report25', 'นิธิกานต์', '2017-02-24 11:15:42');
INSERT INTO lamaereportslog VALUES ('515', 'pcu', 'report25', 'นิธิกานต์', '2017-02-24 11:19:24');
INSERT INTO lamaereportslog VALUES ('521', 'pcu', 'report3', 'นิธิกานต์', '2017-02-24 13:04:25');
INSERT INTO lamaereportslog VALUES ('522', 'pcu', 'report4', 'นิธิกานต์', '2017-02-24 13:06:25');
INSERT INTO lamaereportslog VALUES ('523', 'pcu', 'report3', 'นิธิกานต์', '2017-02-24 13:10:38');
INSERT INTO lamaereportslog VALUES ('524', 'pcu', 'report4', 'นิธิกานต์', '2017-02-24 13:10:57');
INSERT INTO lamaereportslog VALUES ('525', 'pcu', 'report3', 'นิธิกานต์', '2017-02-24 13:15:17');
INSERT INTO lamaereportslog VALUES ('526', 'pcu', 'report4', 'นิธิกานต์', '2017-02-24 13:15:20');
INSERT INTO lamaereportslog VALUES ('527', 'pcu', 'report3', 'นิธิกานต์', '2017-02-24 13:29:51');
INSERT INTO lamaereportslog VALUES ('528', 'dm', 'report13', 'นิธิกานต์', '2017-02-24 13:30:58');
INSERT INTO lamaereportslog VALUES ('529', 'dm', 'report1', 'นิธิกานต์', '2017-02-24 13:33:21');
INSERT INTO lamaereportslog VALUES ('530', 'dm', 'report2', 'นิธิกานต์', '2017-02-24 13:33:27');
INSERT INTO lamaereportslog VALUES ('531', 'dm', 'report1', 'sao', '2017-02-24 13:36:44');
INSERT INTO lamaereportslog VALUES ('532', 'dm', 'report2', 'sao', '2017-02-24 13:36:50');
INSERT INTO lamaereportslog VALUES ('533', 'dm', 'report2', 'sao', '2017-02-24 13:38:33');
INSERT INTO lamaereportslog VALUES ('534', 'ht', 'report9', 'sao', '2017-02-24 13:48:44');
INSERT INTO lamaereportslog VALUES ('535', 'ht', 'report9', 'sao', '2017-02-24 13:49:06');
INSERT INTO lamaereportslog VALUES ('536', 'dm', 'report1', 'sao', '2017-02-24 13:51:04');
INSERT INTO lamaereportslog VALUES ('537', 'dm', 'report2', 'sao', '2017-02-24 13:51:20');
INSERT INTO lamaereportslog VALUES ('538', 'ht', 'report9', 'sao', '2017-02-24 13:56:36');
INSERT INTO lamaereportslog VALUES ('539', 'ht', 'report9', 'sao', '2017-02-24 13:56:57');
INSERT INTO lamaereportslog VALUES ('541', 'pcu', 'report14', 'sao', '2017-02-24 14:08:10');
INSERT INTO lamaereportslog VALUES ('543', 'pcu', 'report14', 'sao', '2017-02-24 14:14:47');
INSERT INTO lamaereportslog VALUES ('544', 'pcu', 'report6', 'sao', '2017-02-24 14:15:06');
INSERT INTO lamaereportslog VALUES ('690', 'account', 'report1', 'lukkana', '2017-02-28 12:01:53');
INSERT INTO lamaereportslog VALUES ('577', 'pcu', 'report6', 'sao', '2017-02-24 14:42:23');
INSERT INTO lamaereportslog VALUES ('579', 'pcu', 'report5', 'sao', '2017-02-24 14:42:38');
INSERT INTO lamaereportslog VALUES ('689', 'account', 'report1', 'lukkana', '2017-02-28 11:59:35');
INSERT INTO lamaereportslog VALUES ('688', 'account', 'report1', 'lukkana', '2017-02-28 11:57:21');
INSERT INTO lamaereportslog VALUES ('687', 'account', 'report1', 'lukkana', '2017-02-28 11:51:01');
INSERT INTO lamaereportslog VALUES ('686', 'account', 'report1', 'lukkana', '2017-02-28 11:45:23');
INSERT INTO lamaereportslog VALUES ('685', 'account', 'report1', 'lukkana', '2017-02-28 11:44:55');
INSERT INTO lamaereportslog VALUES ('684', 'account', 'report1', 'lukkana', '2017-02-28 11:42:58');
INSERT INTO lamaereportslog VALUES ('677', 'pcu', 'report20', 'นิธิกานต์', '2017-02-27 16:09:58');
INSERT INTO lamaereportslog VALUES ('676', 'pcu', 'report5', 'sao', '2017-02-27 11:36:28');
INSERT INTO lamaereportslog VALUES ('675', 'medical', 'report10', 'natty', '2017-02-27 10:46:20');
INSERT INTO lamaereportslog VALUES ('674', 'medical', 'report10', 'natty', '2017-02-27 10:46:01');
INSERT INTO lamaereportslog VALUES ('673', 'medical', 'report9', 'natty', '2017-02-27 10:45:57');
INSERT INTO lamaereportslog VALUES ('672', 'medical', 'report10', 'natty', '2017-02-27 10:45:33');
INSERT INTO lamaereportslog VALUES ('671', 'medical', 'report10', 'natty', '2017-02-27 10:45:21');
INSERT INTO lamaereportslog VALUES ('670', 'medical', 'report9', 'natty', '2017-02-27 10:45:14');
INSERT INTO lamaereportslog VALUES ('669', 'medical', 'report10', 'natty', '2017-02-27 10:41:14');
INSERT INTO lamaereportslog VALUES ('668', 'medical', 'report10', 'natty', '2017-02-27 10:40:48');
INSERT INTO lamaereportslog VALUES ('617', 'ht', 'report1', 'อัมพิกา', '2017-02-24 14:53:59');
INSERT INTO lamaereportslog VALUES ('618', 'ht', 'report2', 'อัมพิกา', '2017-02-24 14:54:14');
INSERT INTO lamaereportslog VALUES ('619', 'ht', 'report1', 'อัมพิกา', '2017-02-24 14:54:51');
INSERT INTO lamaereportslog VALUES ('620', 'ht', 'report2', 'อัมพิกา', '2017-02-24 14:55:12');
INSERT INTO lamaereportslog VALUES ('621', 'dm', 'report13', 'อัมพิกา', '2017-02-24 14:55:58');
INSERT INTO lamaereportslog VALUES ('622', 'dm', 'report13', 'อัมพิกา', '2017-02-24 14:57:13');
INSERT INTO lamaereportslog VALUES ('623', 'dm', 'report13', 'อัมพิกา', '2017-02-24 14:58:28');
INSERT INTO lamaereportslog VALUES ('667', 'medical', 'report9', 'natty', '2017-02-27 10:40:03');
INSERT INTO lamaereportslog VALUES ('666', 'medical', 'report11', 'ศุภนารี', '2017-02-24 16:29:23');
INSERT INTO lamaereportslog VALUES ('665', 'medical', 'report11', 'ศุภนารี', '2017-02-24 16:26:21');
INSERT INTO lamaereportslog VALUES ('664', 'medical', 'report11', 'ศุภนารี', '2017-02-24 16:25:05');
INSERT INTO lamaereportslog VALUES ('663', 'medical', 'report11', 'ศุภนารี', '2017-02-24 16:24:05');
INSERT INTO lamaereportslog VALUES ('662', 'medical', 'report11', 'ศุภนารี', '2017-02-24 16:22:35');
INSERT INTO lamaereportslog VALUES ('661', 'medical', 'report11', 'ศุภนารี', '2017-02-24 16:21:41');
INSERT INTO lamaereportslog VALUES ('660', 'medical', 'report11', 'ศุภนารี', '2017-02-24 16:21:24');
INSERT INTO lamaereportslog VALUES ('659', 'medical', 'report11', 'ศุภนารี', '2017-02-24 16:20:29');
INSERT INTO lamaereportslog VALUES ('658', 'medical', 'report11', 'ศุภนารี', '2017-02-24 16:19:32');
INSERT INTO lamaereportslog VALUES ('657', 'medical', 'report11', 'ศุภนารี', '2017-02-24 16:13:11');
INSERT INTO lamaereportslog VALUES ('705', 'emergen', 'report17', 'admin', '2017-02-28 13:45:01');
INSERT INTO lamaereportslog VALUES ('704', 'pcu', 'report20', 'siro', '2017-02-28 13:43:10');
INSERT INTO lamaereportslog VALUES ('703', 'pcu', 'report20', 'siro', '2017-02-28 13:39:39');
INSERT INTO lamaereportslog VALUES ('702', 'emergen', 'report17', 'ka', '2017-02-28 13:37:43');
INSERT INTO lamaereportslog VALUES ('701', 'emergen', 'report17', 'ka', '2017-02-28 13:37:10');
