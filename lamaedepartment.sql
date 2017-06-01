/*
Navicat MySQL Data Transfer

Source Server         : SERVER_MASTER
Source Server Version : 50532
Source Host           : 192.168.1.253:3306
Source Database       : hos

Target Server Type    : MYSQL
Target Server Version : 50532
File Encoding         : 65001

Date: 2016-11-09 13:21:44
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `lamaedepartment`
-- ----------------------------
DROP TABLE IF EXISTS `lamaedepartment`;
CREATE TABLE `lamaedepartment` (
  `id` int(13) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=tis620;

-- ----------------------------
-- Records of lamaedepartment
-- ----------------------------
INSERT INTO lamaedepartment VALUES ('1', 'เวชระเบียน');
INSERT INTO lamaedepartment VALUES ('2', '??');
INSERT INTO lamaedepartment VALUES ('3', 'คลินิกเบาหวาน');
INSERT INTO lamaedepartment VALUES ('4', 'คลินิกความดันโลหิตสูง');
INSERT INTO lamaedepartment VALUES ('5', 'คลินิกถุงลมโป่งพอง');
INSERT INTO lamaedepartment VALUES ('6', 'คลินิกหอบหืด');
INSERT INTO lamaedepartment VALUES ('7', 'อุบัติเหตุฉุกเฉิน');
INSERT INTO lamaedepartment VALUES ('8', 'เภสัชกรรม');
INSERT INTO lamaedepartment VALUES ('9', 'เวชปฏิบัติครอบครัว');
INSERT INTO lamaedepartment VALUES ('10', 'ผู้ป่วยใน');
INSERT INTO lamaedepartment VALUES ('11', 'แพทย์แผนไทย');
INSERT INTO lamaedepartment VALUES ('12', '??');
INSERT INTO lamaedepartment VALUES ('13', 'กายภาพบำบัด');
INSERT INTO lamaedepartment VALUES ('14', 'ประกันสุขภาพ');
