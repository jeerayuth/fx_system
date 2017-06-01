/*
Navicat MySQL Data Transfer

Source Server         : SERVER_MASTER
Source Server Version : 50532
Source Host           : 192.168.1.253:3306
Source Database       : hos

Target Server Type    : MYSQL
Target Server Version : 50532
File Encoding         : 65001

Date: 2017-04-21 09:57:32
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `lamaereports`
-- ----------------------------
DROP TABLE IF EXISTS `lamaereports`;
CREATE TABLE `lamaereports` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lamaedepartment_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `form` varchar(255) NOT NULL,
  `pointer` varchar(255) NOT NULL,
  `created` date NOT NULL,
  `status` enum('enable','disable') DEFAULT NULL,
  `controller` varchar(255) NOT NULL,
  `details` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=337 DEFAULT CHARSET=tis620;

-- ----------------------------
-- Records of lamaereports
-- ----------------------------
INSERT INTO lamaereports VALUES ('4', '2', 'รายงานผู้ป่วยนอกที่มารับบริการด้วย Diag หลัก  J440 - J449', 'form1', 'report_opd_diag_between_j440_and_j449', '2013-11-21', '', '', null);
INSERT INTO lamaereports VALUES ('3', '8', 'รายงานมูลค่าการใช้ยาปฏิชีวนะ', 'form1', 'report1', '2016-08-08', 'enable', 'pharmacy', null);
INSERT INTO lamaereports VALUES ('5', '2', 'รายงานผู้ป่วยนอกที่มารับบริการด้วย Diag หลัก  J450 - J459', 'form1', 'report_opd_diag_between_j450_and_j459', '2013-11-21', '', '', null);
INSERT INTO lamaereports VALUES ('6', '4', 'รายงานจำนวนคนไข้ความดัน ที่ได้รับการตรวจน้ำตาล (FBS)', 'form1', 'report6', '2016-06-14', 'disable', 'ht', '');
INSERT INTO lamaereports VALUES ('7', '3', 'รายงานคนไข้ทะเบียนเบาหวานแยกตามสถานบริการ', 'form2', 'report1', '2016-04-27', 'enable', 'dm', null);
INSERT INTO lamaereports VALUES ('8', '3', 'รายงานจำนวนคนไข้คลินิกเบาหวานได้รับการคัดกรองการสูบบุหรี่-ดื่มสุรา', 'form3', 'report3', '2016-05-23', 'enable', 'dm', '');
INSERT INTO lamaereports VALUES ('9', '3', 'รายงานจำนวนคนไข้คลินิกเบาหวาน(มีความดันร่วม) ได้รับการคัดกรองการสูบบุหรี่', 'form1', 'report_dm_with_ht_screen_smoking', '2013-11-22', '', '', null);
INSERT INTO lamaereports VALUES ('10', '4', 'รายงานจำนวนคนไข้คลินิกความดันโลหิตสูง ได้รับการคัดกรองการสูบบุหรี่-ดื่มสุรา', 'form1', 'report3', '2016-06-09', 'enable', 'ht', '');
INSERT INTO lamaereports VALUES ('11', '3', 'รายงานจำนวนคนไข้คลินิคเบาหวาน(ไม่มีความดันร่วม) ได้รับการคัดกรองการดื่มสุรา', 'form1', 'report_dm_only_screen_drinking', '2013-11-22', '', '', null);
INSERT INTO lamaereports VALUES ('12', '3', 'รายงานจำนวนคนไข้คลินิคเบาหวาน(มีความดันร่วม) ได้รับการคัดกรองการดื่มสุรา', 'form1', 'report_dm_with_ht_screen_drinking', '2013-11-22', '', '', null);
INSERT INTO lamaereports VALUES ('13', '4', 'รายงานจำนวนคนไข้คลินิคความดันโลหิตสูง(ไม่มีเบาหวานร่วม) ได้รับการคัดกรองการดื่มสุรา', 'form1', 'report_ht_only_screen_drinking', '2013-11-22', '', '', null);
INSERT INTO lamaereports VALUES ('14', '3', 'รายงานจำนวนคนไข้คลินิกเบาหวาน ได้รับการคัดกรองภาวะโรคซึมเศร้า', 'form3', 'report4', '2016-05-27', 'enable', 'dm', '');
INSERT INTO lamaereports VALUES ('15', '3', 'รายงานจำนวนคนไข้คลินิคเบาหวาน(มีความดันร่วม) ได้รับการคัดกรองภาวะโรคซึมเศร้า', 'form1', 'report_dm_with_ht_screen_depression', '2013-11-22', '', '', null);
INSERT INTO lamaereports VALUES ('16', '4', 'รายงานจำนวนคนไข้คลินิกความดันโลหิตสูง ได้รับการคัดกรองภาวะโรคซึมเศร้า', 'form1', 'report4', '2016-06-09', 'enable', 'ht', '');
INSERT INTO lamaereports VALUES ('17', '5', 'รายงานจำนวนคนไข้คลินิกถุงลมโป่งพอง  ได้รับการคัดกรองการสูบบุหรี่-ดื่มสุรา', 'form1', 'report3', '2016-06-15', 'enable', 'copd', '');
INSERT INTO lamaereports VALUES ('18', '6', 'รายงานจำนวนคนไข้คลินิกหอบหืด ได้รับการคัดกรองการสูบบุหรี่-ดื่มสุรา', 'form1', 'report3', '2016-06-17', 'enable', 'asthma', '');
INSERT INTO lamaereports VALUES ('19', '5', 'รายงานจำนวนคนไข้คลินิค COPD  ได้รับการคัดกรองการดื่มสุรา', 'form1', 'report_copd_screen_drinking', '2013-11-22', '', '', null);
INSERT INTO lamaereports VALUES ('20', '6', 'รายงานทะเบียนผู้ป่วยคลินิก Asthma', 'form5', 'report1', '2016-06-17', 'disable', 'asthma', '');
INSERT INTO lamaereports VALUES ('21', '9', 'รายงานกลุ่มเสียงที่ต้องคัดกรองโรคเบาหวาน ความดัน อายุ  15 - 34 ปี', 'form1', 'report_screen_dm_ht_15_34', '2013-11-30', '', '', null);
INSERT INTO lamaereports VALUES ('22', '9', 'รายงานคนไข้ทะเบียนความดันโลหิตสูงแยกตามหมู่บ้าน', 'form2', 'report_ht_register_group_by_village', '2013-12-02', '', '', null);
INSERT INTO lamaereports VALUES ('23', '9', 'รายงานกลุ่มเสียงที่ต้องคัดกรองโรคเบาหวาน ความดัน อายุ  35 - 59 ปี', 'form1', 'report_screen_dm_ht_35_59', '2013-12-02', '', '', null);
INSERT INTO lamaereports VALUES ('24', '9', 'รายงานกลุ่มเสียงที่ต้องคัดกรองโรคเบาหวาน ความดัน อายุ  60  ปี ขึ้นไป', 'form1', 'report_screen_dm_ht_60_year', '2013-12-02', '', '', null);
INSERT INTO lamaereports VALUES ('25', '3', 'รายงานจำนวนคนไข้คลินิคเบาหวานที่มีผลการตรวจ HbA1C มากกว่าหรือเท่ากับ 10', 'form1', 'report_dm_hba1c_min_10', '2013-12-06', '', '', null);
INSERT INTO lamaereports VALUES ('26', '3', 'รายงานคนไข้คลินิคเบาหวาน(ไม่มีความดันร่วม) ตรวจแลป GFR', 'form1', 'report_dm_only_screen_lab_gfr', '2013-12-12', '', '', null);
INSERT INTO lamaereports VALUES ('27', '10', 'รายงานผู้ป่วยใน รง.505', 'form1', 'report1', '2016-10-03', 'enable', 'ward', null);
INSERT INTO lamaereports VALUES ('28', '3', 'รายงานคนไข้คลินิคเบาหวาน(มีความดันร่วม) ตรวจแลป GFR', 'form1', 'report_dm_with_ht_screen_lab_gfr', '2013-12-13', '', '', null);
INSERT INTO lamaereports VALUES ('29', '4', 'รายงานคนไข้คลินิกความดันโลหิตสูง ได้รับการตรวจแลปชนิดต่างๆ', 'form6', 'report5', '2016-06-14', 'enable', 'ht', '');
INSERT INTO lamaereports VALUES ('30', '7', 'รายงานผู้ป่วยที่มารับบริการที่ห้องฉุกเฉิน', 'form1', 'report5', '2016-09-27', 'enable', 'emergen', null);
INSERT INTO lamaereports VALUES ('31', '5', 'รายงานจำนวนคนไข้ถุงลมโป่งพอง ได้รับการบริการที่ห้องฉุกเฉิน (ER)', 'form1', 'report4', '2016-06-15', 'enable', 'copd', '');
INSERT INTO lamaereports VALUES ('32', '5', 'รายงานจำนวนคนไข้คลินิกถุงลมโป่งพอง ได้รับการ Admit', 'form1', 'report5', '2016-06-15', 'enable', 'copd', '');
INSERT INTO lamaereports VALUES ('33', '3', 'รายงานคนไข้ทะเบียนเบาหวานที่มีความดันโลหิตร่วมด้วย', 'form2', 'report3', '2016-04-22', 'disable', 'dm', null);
INSERT INTO lamaereports VALUES ('34', '4', 'รายงานทะเบียนคนไข้คลินิกความดันโลหิตสูงแยกตามสถานบริการ', 'form5', 'report1', '2016-06-09', 'enable', 'ht', '');
INSERT INTO lamaereports VALUES ('35', '7', 'รายงานคนไข้ Re-Visit น้อยกว่าหรือเท่ากับ 48 ชั่วโมง ที่ ER', 'form1', 'report_er_revisit_48_hour', '2014-01-15', '', '', null);
INSERT INTO lamaereports VALUES ('36', '9', 'รายงานประชากรแยกตามกลุ่มอายุ/เพศ รายหมู่บ้าน', 'form4', 'report_person_group_by_village', '2014-01-16', '', '', null);
INSERT INTO lamaereports VALUES ('37', '9', 'รายงานประชากรที่อายุมากกว่า 100ปี ขึ้นไป', 'form2', 'report_person_age_more_100_year', '2014-01-16', '', '', null);
INSERT INTO lamaereports VALUES ('38', '9', 'รายงานเด็กอายุ 0-6ปี เขตรับผิดชอบ ที่ได้รับวัคซีนชนิดต่างๆ', 'form2', 'report_person_0_6_vaccine_list', '2014-01-16', '', '', null);
INSERT INTO lamaereports VALUES ('39', '6', 'รายงานจำนวนคนไข้คลินิกหอบหืด ได้รับการบริการที่ห้องฉุกเฉิน', 'form1', 'report4', '2016-06-17', 'enable', 'asthma', '');
INSERT INTO lamaereports VALUES ('40', '6', 'รายงานจำนวนคนไข้คลินิกหอบหืด Re-Admit ภายใน 28 วัน', 'form1', 'report8', '2016-06-20', 'enable', 'asthma', '');
INSERT INTO lamaereports VALUES ('41', '6', 'รายงานจำนวนคนไข้คลินิกหอบหืด Re-Visit ภายใน 48 ชั่วโมง ที่ OPD', 'form1', 'report6', '2016-06-20', 'enable', 'asthma', '');
INSERT INTO lamaereports VALUES ('42', '6', 'รายงานจำนวนคนไข้คลินิกหอบหืด Re-Visit ภายใน 48 ชั่วโมง ที่ ER', 'form1', 'report7', '2016-06-20', 'enable', 'asthma', '');
INSERT INTO lamaereports VALUES ('101', '5', 'รายงานจำนวนคนไข้คลินิกถุงลมโป่งพอง Re-Visit ภายใน 48 ชั่วโมง ที่ OPD', 'form1', 'report6', '2016-06-15', 'enable', 'copd', '');
INSERT INTO lamaereports VALUES ('102', '5', 'รายงานจำนวนคนไข้คลินิกถุงลมโป่งพอง Re-Visit ภายใน 48 ชั่วโมง ที่ ER', 'form1', 'report7', '2016-06-15', 'enable', 'copd', '');
INSERT INTO lamaereports VALUES ('103', '9', 'รายงานภาวโภชนาการเด็ก อายุ 0-6 ปี เฉพาะคนไทย', 'form1', 'report_person_0_6_nutrition_list', '2014-01-24', '', '', null);
INSERT INTO lamaereports VALUES ('104', '11', 'รายงานสรุปหัตถการแพทย์แผนไทย', 'form1', 'report1', '2016-11-09', 'enable', 'ttm', null);
INSERT INTO lamaereports VALUES ('105', '7', 'รายงาน Head Injury (ER)', 'form1', 'report_er_head_injury', '2014-02-10', '', '', null);
INSERT INTO lamaereports VALUES ('106', '1', 'รายงานผู้มารับบริการแยกตาม Diage V01 ถึง Y98', 'form1', 'report_drug_visit_v01y98', '2014-02-26', '', '', null);
INSERT INTO lamaereports VALUES ('107', '1', 'รายงานผู้มารับบริการแยกตาม Diage A00  ถึง A69', 'form1', 'report_drug_visit_A00A69', '2014-02-26', '', '', null);
INSERT INTO lamaereports VALUES ('108', '1', 'รายงานผู้มารับบริการแยกตาม Diage J069', 'form1', 'report_drug_visit_J069', '2014-02-26', '', '', null);
INSERT INTO lamaereports VALUES ('109', '1', 'รายงานผู้มารับบริการแยกตาม Diage A099', 'form1', 'report_drug_visit_A099', '2014-02-26', '', '', null);
INSERT INTO lamaereports VALUES ('110', '1', 'รายงานผู้มารับบริการแยกตาม Diage K529', 'form1', 'report_drug_visit_K529', '2014-02-26', '', '', null);
INSERT INTO lamaereports VALUES ('111', '8', 'รายงานผู้มารับบริการแยกตามกลุ่มรหัสวินิจฉัยโรค  และมีการสั่งใช้ยา Antibiotic', 'form8', 'report2', '2016-08-09', 'enable', 'pharmacy', null);
INSERT INTO lamaereports VALUES ('112', '8', 'รายงานผู้มารับบริการแยกตาม Diage A00  ถึง A69 และมีการสั่งใช้ยา Antibiotic', 'form1', 'report_drug_visit_A00A69_antibiotic', '2014-02-26', '', '', null);
INSERT INTO lamaereports VALUES ('113', '8', 'รายงานผู้มารับบริการแยกตาม Diage J069 และมีการสั่งใช้ยา Antibiotic', 'form1', 'report_drug_visit_J069_antibiotic', '2014-02-26', '', '', null);
INSERT INTO lamaereports VALUES ('114', '8', 'รายงานผู้มารับบริการแยกตาม Diage A099 และมีการสั่งใช้ยา Antibiotic', 'form1', 'report_drug_visit_A099_antibiotic', '2014-02-26', '', '', null);
INSERT INTO lamaereports VALUES ('115', '8', 'รายงานผู้มารับบริการแยกตาม Diage K529 และมีการสั่งใช้ยา Antibiotic', 'form1', 'report_drug_visit_K529_antibiotic', '2014-02-26', '', '', null);
INSERT INTO lamaereports VALUES ('116', '9', 'รายงานรายชื่อคนไข้กลุ่มเสี่ยงที่ต้องคัดกรองโรคเบาหวาน ความดัน อายุ 15 - 34 ปี มีค่า BPS ระหว่าง 121 ถึง 139 และ BPD <= 89 (สีเขียวอ่อน)', 'form1', 'report_screen_dm_ht_15_34_bp_1_list', '2014-03-04', '', '', null);
INSERT INTO lamaereports VALUES ('117', '9', 'รายงานรายชื่อคนไข้กลุ่มเสี่ยงที่ต้องคัดกรองโรคเบาหวาน ความดัน อายุ 35 - 59 ปี มีค่า BPS ระหว่าง 121 ถึง 139 และ BPD <= 89 (สีเขียวอ่อน)', 'form1', 'report_screen_dm_ht_35_59_bp_1_list', '2014-03-05', '', '', null);
INSERT INTO lamaereports VALUES ('118', '9', 'รายงานรายชื่อคนไข้กลุ่มเสี่ยงที่ต้องคัดกรองโรคเบาหวาน ความดัน อายุ 60ปีขึ้นไป มีค่า BPS ระหว่าง 121 ถึง 139 และ BPD <= 89 (สีเขียวอ่อน)', 'form1', 'report_screen_dm_ht_60_year_bp_1_list', '2014-03-05', '', '', null);
INSERT INTO lamaereports VALUES ('119', '9', 'รายงานรายชื่อคนไข้กลุ่มเสี่ยงที่ต้องคัดกรองโรคเบาหวาน ความดัน อายุ 15 - 34 ปี มีค่า BPS <= 120 และ ค่า BPD  อยู่ระหว่าง 81-89 (สีเขียวอ่อน)', 'form1', 'report_screen_dm_ht_15_34_bp_2_list', '2014-03-05', '', '', null);
INSERT INTO lamaereports VALUES ('120', '9', 'รายงานรายชื่อคนไข้กลุ่มเสี่ยงที่ต้องคัดกรองโรคเบาหวาน ความดัน อายุ 35 - 59 ปี มีค่า BPS <= 120 และ ค่า BPD  อยู่ระหว่าง 81-89 (สีเขียวอ่อน)', 'form1', 'report_screen_dm_ht_35_59_bp_2_list', '2014-03-05', '', '', null);
INSERT INTO lamaereports VALUES ('121', '9', 'รายงานรายชื่อคนไข้กลุ่มเสี่ยงที่ต้องคัดกรองโรคเบาหวาน ความดัน อายุ 60 ปีขึ้นไป มีค่า BPS <= 120 และ ค่า BPD  อยู่ระหว่าง 81-89 (สีเขียวอ่อน)', 'form1', 'report_screen_dm_ht_60_year_bp_2_list', '2014-03-05', '', '', null);
INSERT INTO lamaereports VALUES ('122', '9', 'รายงานรายชื่อคนไข้กลุ่มเสี่ยงที่ต้องคัดกรองโรคเบาหวาน ความดัน อายุ 15 - 34 ปี มีค่า DTX ระหว่าง 100 ถึง 125 (สีเขียวอ่อน)', 'form1', 'report_screen_dm_ht_15_34_dtx_1_list', '2014-03-05', '', '', null);
INSERT INTO lamaereports VALUES ('123', '9', 'รายงานรายชื่อคนไข้กลุ่มเสี่ยงที่ต้องคัดกรองโรคเบาหวาน ความดัน อายุ 35 - 59 ปี มีค่า DTX ระหว่าง 100 ถึง 125 (สีเขียวอ่อน)', 'form1', 'report_screen_dm_ht_35_59_dtx_1_list', '2014-03-05', '', '', null);
INSERT INTO lamaereports VALUES ('124', '9', 'รายงานรายชื่อคนไข้กลุ่มเสี่ยงที่ต้องคัดกรองโรคเบาหวาน ความดัน อายุ 60 ปีขึ้นไป มีค่า DTX ระหว่าง 100 ถึง 125 (สีเขียวอ่อน)', 'form1', 'report_screen_dm_ht_60_year_dtx_1_list', '2014-03-05', '', '', null);
INSERT INTO lamaereports VALUES ('137', '1', 'รายงานอาการคล้ายไข้หวัดใหญ่ (ILI)', 'form1', 'report_count_visit_by_date', '2014-04-25', '', '', null);
INSERT INTO lamaereports VALUES ('125', '9', 'รายงานรายชื่อคนไข้กลุ่มเสี่ยงที่ต้องคัดกรองโรคเบาหวาน ความดัน อายุ 15 - 34 ปี มีค่า DTX  > 126 (สีเขียวเข้ม)', 'form1', 'report_screen_dm_ht_15_34_dtx_2_list', '2014-03-05', '', '', null);
INSERT INTO lamaereports VALUES ('126', '9', 'รายงานรายชื่อคนไข้กลุ่มเสี่ยงที่ต้องคัดกรองโรคเบาหวาน ความดัน อายุ 35 - 59 ปี มีค่า DTX  > 126 (สีเขียวเข้ม)', 'form1', 'report_screen_dm_ht_35_59_dtx_2_list', '2014-03-05', '', '', null);
INSERT INTO lamaereports VALUES ('127', '9', 'รายงานรายชื่อคนไข้กลุ่มเสี่ยงที่ต้องคัดกรองโรคเบาหวาน ความดัน อายุ 60 ปีขึ้นไป มีค่า DTX  > 126 (สีเขียวเข้ม)', 'form1', 'report_screen_dm_ht_60_year_dtx_2_list', '2014-03-05', '', '', null);
INSERT INTO lamaereports VALUES ('128', '9', 'รายงานรายชื่อคนไข้กลุ่มเสี่ยงที่ต้องคัดกรองโรคเบาหวาน ความดัน อายุ 15 - 34 ปี มีค่า BPS >= 140  และ BPD >= 90  (สีเขียวเข้ม)', 'form1', 'report_screen_dm_ht_15_34_bp_3_list', '2014-03-05', '', '', null);
INSERT INTO lamaereports VALUES ('129', '9', 'รายงานรายชื่อคนไข้กลุ่มเสี่ยงที่ต้องคัดกรองโรคเบาหวาน ความดัน อายุ 35 - 59 ปี มีค่า BPS >= 140  และ BPD >= 90  (สีเขียวเข้ม)', 'form1', 'report_screen_dm_ht_35_59_bp_3_list', '2014-03-05', '', '', null);
INSERT INTO lamaereports VALUES ('130', '9', 'รายงานรายชื่อคนไข้กลุ่มเสี่ยงที่ต้องคัดกรองโรคเบาหวาน ความดัน อายุ 60 ปีขึ้นไป มีค่า BPS >= 140  และ BPD >= 90  (สีเขียวเข้ม)', 'form1', 'report_screen_dm_ht_60_year_bp_3_list', '2014-03-05', '', '', null);
INSERT INTO lamaereports VALUES ('131', '9', 'รายงานรายชื่อคนไข้กลุ่มเสี่ยงที่ต้องคัดกรองโรคเบาหวาน ความดัน อายุ 15 - 34 ปี มีค่า BPS >= 140  และ BPD < 90  (สีเขียวเข้ม)', 'form1', 'report_screen_dm_ht_15_34_bp_4_list', '2014-03-05', '', '', null);
INSERT INTO lamaereports VALUES ('132', '9', 'รายงานรายชื่อคนไข้กลุ่มเสี่ยงที่ต้องคัดกรองโรคเบาหวาน ความดัน อายุ 35 - 59 ปี มีค่า BPS >= 140  และ BPD < 90  (สีเขียวเข้ม)', 'form1', 'report_screen_dm_ht_35_59_bp_4_list', '2014-03-05', '', '', null);
INSERT INTO lamaereports VALUES ('133', '9', 'รายงานรายชื่อคนไข้กลุ่มเสี่ยงที่ต้องคัดกรองโรคเบาหวาน ความดัน อายุ 60 ปีขึ้นไป มีค่า BPS >= 140  และ BPD < 90  (สีเขียวเข้ม)', 'form1', 'report_screen_dm_ht_60_year_bp_4_list', '2014-03-05', '', '', null);
INSERT INTO lamaereports VALUES ('134', '9', 'รายงานรายชื่อคนไข้กลุ่มเสี่ยงที่ต้องคัดกรองโรคเบาหวาน ความดัน อายุ 15 - 34 ปี มีค่า BPS <= 140  และ BPD >= 90  (สีเขียวเข้ม)', 'form1', 'report_screen_dm_ht_15_34_bp_5_list', '2014-03-05', '', '', null);
INSERT INTO lamaereports VALUES ('135', '9', 'รายงานรายชื่อคนไข้กลุ่มเสี่ยงที่ต้องคัดกรองโรคเบาหวาน ความดัน อายุ 35 - 59 ปี มีค่า BPS <= 140  และ BPD >= 90  (สีเขียวเข้ม)', 'form1', 'report_screen_dm_ht_35_59_bp_5_list', '2014-03-05', '', '', null);
INSERT INTO lamaereports VALUES ('136', '9', 'รายงานรายชื่อคนไข้กลุ่มเสี่ยงที่ต้องคัดกรองโรคเบาหวาน ความดัน อายุ 60 ปีขึ้นไป มีค่า BPS <= 140  และ BPD >= 90  (สีเขียวเข้ม)', 'form1', 'report_screen_dm_ht_60_year_bp_5_list', '2014-03-05', '', '', null);
INSERT INTO lamaereports VALUES ('138', '3', 'รายงานจำนวนคนไข้คลินิคเบาหวาน(ไม่มีความดันร่วม) ที่มีผลการตรวจ HbA1C น้อยกว่าหรือเท่ากับ 7', 'form1', 'report_dm_only_hba1c_min_7', '2014-05-08', '', '', null);
INSERT INTO lamaereports VALUES ('139', '3', 'รายงานจำนวนคนไข้คลินิคเบาหวาน(มีความดันร่วม) ที่มีผลการตรวจ HbA1C น้อยกว่าหรือเท่ากับ 7', 'form1', 'report_dm_with_ht_hba1c_min_7', '2014-05-08', '', '', null);
INSERT INTO lamaereports VALUES ('140', '3', 'รายงานจำนวนคนไข้คลินิคเบาหวาน(ไม่มีความดันร่วม) ที่ได้รับการตรวจ Urine Protein', 'form1', 'report_dm_only_urine_protein', '2014-05-08', '', '', null);
INSERT INTO lamaereports VALUES ('141', '3', 'รายงานจำนวนคนไข้คลินิคเบาหวาน(มีความดันร่วม) ที่ได้รับการตรวจ Urine Protein', 'form1', 'report_dm_with_ht_urine_protein', '2014-05-08', '', '', null);
INSERT INTO lamaereports VALUES ('142', '4', 'รายงานจำนวนคนไข้คลินิคความดัน(ไม่มีเบาหวานร่วม) ที่ได้รับการตรวจ Urine Protein', 'form1', 'report_ht_only_urine_protein', '2014-05-08', '', '', null);
INSERT INTO lamaereports VALUES ('143', '3', 'รายงานจำนวนคนไข้คลินิกเบาหวานที่ได้รับการตรวจตา', 'form3', 'report5', '2016-05-31', 'enable', 'dm', '');
INSERT INTO lamaereports VALUES ('144', '3', 'รายงานจำนวนคนไข้คลินิคเบาหวาน(มีความดันร่วม) ที่ได้รับการตรวจตา', 'form1', 'report_dm_with_ht_screen_eye', '2014-05-08', '', '', null);
INSERT INTO lamaereports VALUES ('145', '3', 'รายงานจำนวนคนไข้คลินิกเบาหวานที่ได้รับการตรวจเท้า', 'form3', 'report6', '2016-05-31', 'enable', 'dm', '');
INSERT INTO lamaereports VALUES ('146', '3', 'รายงานจำนวนคนไข้คลินิคเบาหวาน(มีความดันร่วม) ที่ได้รับการตรวจเท้า', 'form1', 'report_dm_with_ht_screen_foot', '2014-05-08', '', '', null);
INSERT INTO lamaereports VALUES ('147', '3', 'รายงานวิเคราะห์จำนวนคนไข้คลินิกเบาหวานได้รับการตรวจแลปชนิดต่างๆ', 'form4', 'report7', '2016-05-31', 'enable', 'dm', '');
INSERT INTO lamaereports VALUES ('148', '3', 'รายงานจำนวนคนไข้คลินิคเบาหวาน(มีความดันร่วม) ได้รับการตรวจ HbA1C', 'form1', 'report_dm_with_ht_hba1c', '2014-05-08', '', '', null);
INSERT INTO lamaereports VALUES ('149', '7', 'รายงานคนไข้จมน้ำทั้งหมด', 'form1', 'report_er_all_get_drowned', '2014-05-12', '', '', null);
INSERT INTO lamaereports VALUES ('150', '7', 'รายงานคนไข้จมน้ำเฉพาะที่มารับบริการที่ ER', 'form1', 'report_er_get_drowned', '2014-05-12', '', '', null);
INSERT INTO lamaereports VALUES ('151', '3', 'รายงานคนไข้คลินิคเบาหวาน(ไม่มีความดันร่วม) มีผล Microalbumin มากกว่าหรือเท่ากับ 20', 'form1', 'report_dm_only_microalbumin_max_20', '2014-05-12', '', '', null);
INSERT INTO lamaereports VALUES ('152', '3', 'รายงานคนไข้คลินิคเบาหวาน(มีความดันร่วม) มีผล Microalbumin มากกว่าหรือเท่ากับ 20', 'form1', 'report_dm_with_ht_microalbumin_max_20', '2014-05-12', '', '', null);
INSERT INTO lamaereports VALUES ('153', '3', 'รายงานจำนวนครั้งคนไข้คลินิกเบาหวานที่มี Diag Hypoglycemia และได้รับการ Admit', 'form3', 'report8', '2016-06-02', 'enable', 'dm', '');
INSERT INTO lamaereports VALUES ('154', '3', 'รายงานจำนวนคนไข้คลินิคเบาหวาน(มีความดันร่วม) Hypoglycemia', 'form1', 'report_dm_with_ht_hypoglycemia', '2014-05-30', '', '', null);
INSERT INTO lamaereports VALUES ('155', '3', 'รายงานจำนวนครั้งคนไข้คลินิกเบาหวาน ที่มี Diag Hyperglycemia และได้รับการ Admit', 'form3', 'report9', '2016-06-02', 'enable', 'dm', '');
INSERT INTO lamaereports VALUES ('156', '3', 'รายงานจำนวนคนไข้คลินิคเบาหวาน(มีความดันร่วม) Hyperglycemia', 'form1', 'report_dm_with_ht_hyperglycemia', '2014-05-30', '', '', null);
INSERT INTO lamaereports VALUES ('157', '5', 'รายงานจำนวนคนไข้ COPD ได้รับการเป่า PEFR', 'form1', 'report_copd_screen_pefr', '2014-06-03', '', '', null);
INSERT INTO lamaereports VALUES ('158', '6', 'รายงานจำนวนคนไข้ Asthma ได้รับการเป่า PEFR', 'form1', 'report_asthma_screen_pefr', '2014-06-03', '', '', null);
INSERT INTO lamaereports VALUES ('159', '1', 'รายงานจำนวนการให้บริการคนไข้แยกตามแผนกหลัก', 'form1', 'report_count_visit_by_main_dep', '2014-06-12', '', '', null);
INSERT INTO lamaereports VALUES ('160', '1', 'รายงานสรุปการรับบริการคนไข้ OPD แยกรายเดือน', 'form1', 'report1', '2016-09-21', 'enable', 'medical', null);
INSERT INTO lamaereports VALUES ('161', '1', 'รายงานสรุปการรับบริการคนไข้ทั้ง Ward แยกรายเดือน', 'form1', 'report2', '2016-09-21', 'enable', 'medical', null);
INSERT INTO lamaereports VALUES ('162', '1', 'รายงานทะเบียนผู้เสียชีวิต', 'form1', 'report3', '2015-09-21', 'enable', 'medical', null);
INSERT INTO lamaereports VALUES ('163', '5', 'รายงานคนไข้ COPD ได้รับบริการที่ ER (ตรวจสอบการใส่ท่อหลอดลมคอ)', 'form1', 'report_copd_er_service_tube_code_224', '2014-07-09', '', '', null);
INSERT INTO lamaereports VALUES ('164', '6', 'รายงานคนไข้ Asthma ได้รับบริการที่ ER (ตรวจสอบการใส่ท่อหลอดลมคอ)', 'form1', 'report_asthma_er_service_tube_code_224', '2014-07-09', '', '', null);
INSERT INTO lamaereports VALUES ('165', '4', 'รายงานจำนวนคนไข้ความดันได้รับการตรวจ Lipid Profile', 'form1', 'report_ht_screen_lab_code_lipid_Profile', '2014-07-17', '', '', null);
INSERT INTO lamaereports VALUES ('166', '3', 'รายงานจำนวนคนไข้เบาหวาน(ไม่มีความดันร่วม) ได้รับการตรวจ Lipid Profile', 'form1', 'report_dm_only_screen_lab_code_lipid_Profile', '2014-07-17', '', '', null);
INSERT INTO lamaereports VALUES ('167', '3', 'รายงานจำนวนคนไข้เบาหวาน(มีความดันร่วม) ได้รับการตรวจ Lipid Profile', 'form1', 'report_dm_with_ht_screen_lab_code_lipid_Profile', '2014-07-17', '', '', null);
INSERT INTO lamaereports VALUES ('168', '3', 'รายงานจำนวนคนไข้เบาหวาน CKD Diag N181 - N185', 'form3', 'report10', '2016-06-02', 'enable', 'dm', '');
INSERT INTO lamaereports VALUES ('169', '3', 'รายงานจำนวนคนไข้เบาหวาน(มีความดันร่วม) CKD Diag N170-N19', 'form1', 'report_dm_with_ht_ckd', '2014-07-29', '', '', null);
INSERT INTO lamaereports VALUES ('170', '4', 'รายงานจำนวนคนไข้ความดัน CKD Diag N181 - N185', 'form1', 'report6', '2016-06-14', 'enable', 'ht', '');
INSERT INTO lamaereports VALUES ('171', '3', 'รายงานจำนวนคนไข้เบาหวาน + โรคหัวใจ', 'form2', 'report11', '2016-06-03', 'enable', 'dm', '');
INSERT INTO lamaereports VALUES ('172', '3', 'รายงานจำนวนคนไข้เบาหวาน(มีความดันร่วม) + โรคหัวใจ', 'form2', 'report_dm_with_ht_stroke', '2014-07-29', '', '', null);
INSERT INTO lamaereports VALUES ('173', '4', 'รายงานจำนวนคนไข้ความดัน + โรคหัวใจ', 'form5', 'report7', '2016-06-14', 'enable', 'ht', '');
INSERT INTO lamaereports VALUES ('174', '3', 'รายงานจำนวนคนไข้เบาหวาน +  หลอดเลือดสมอง', 'form2', 'report12', '2016-06-03', 'enable', 'dm', '');
INSERT INTO lamaereports VALUES ('175', '3', 'รายงานจำนวนคนไข้เบาหวาน(มีความดันร่วม) +  หลอดเลือดสมอง', 'form2', 'report_dm_with_ht_mi_chf', '2014-07-29', '', '', null);
INSERT INTO lamaereports VALUES ('176', '4', 'รายงานจำนวนคนไข้ความดัน + หลอดเลือดสมอง', 'form5', 'report8', '2016-06-14', 'enable', 'ht', '');
INSERT INTO lamaereports VALUES ('177', '8', 'รายงาน High  Alert Drug', 'form1', 'report4', '2016-08-09', 'enable', 'pharmacy', null);
INSERT INTO lamaereports VALUES ('178', '1', 'รายงานการรับบัตรตรวจโรค OPD Card', 'form1', 'report_receive_opd_card', '2014-09-03', '', '', null);
INSERT INTO lamaereports VALUES ('179', '10', 'รายงานสรุปจำนวนผู้ป่วย IPD Dischare แยกตามวิธีการจำหน่าย', 'form1', 'report_count_discharge_ipd_dchtype', '2014-09-08', '', '', null);
INSERT INTO lamaereports VALUES ('180', '7', 'รายงานคนไข้ Re-Visit น้อยกว่า 48 ชั่วโมงที่ ER  ตัดคนไข้นัดและตัด Diagหลักที่เป็นฉีดยาทำแผล', 'form1', 'report_er_revisit_48_hour_ovstist_01', '2014-09-12', '', '', null);
INSERT INTO lamaereports VALUES ('181', '2', 'รายงานคนไข้ Re-Visit น้อยกว่า 48 ชั่วโมงที่ OPD  ตัดคนไข้นัดและตัด Diagหลักที่เป็นฉีดยาทำแผล', 'form1', 'report_opd_revisit_48_hour_ovstist_01', '2014-09-12', '', '', null);
INSERT INTO lamaereports VALUES ('182', '3', 'รายงานทะเบียนคนไข้เบาหวานรายใหม่ (เงื่อนไขตามวันที่ลงทะเบียน)', 'form3', 'report13', '2016-06-03', 'enable', 'dm', '');
INSERT INTO lamaereports VALUES ('183', '3', 'รายงานทะเบียนคนไข้เบาหวานรายใหม่(มีความดันร่วม)', 'form1', 'report_dm_with_ht_register_new', '2014-09-19', 'disable', '', null);
INSERT INTO lamaereports VALUES ('184', '4', 'รายงานทะเบียนคนไข้ความดันรายใหม่ (ตามวันที่ลงทะเบียน)', 'form1', 'report9', '2016-06-14', 'enable', 'ht', '');
INSERT INTO lamaereports VALUES ('185', '10', 'รายงานคนไข้ IPD ที่มี Diag A419', 'form1', 'report_ipd_diag_A419', '2014-10-10', '', '', null);
INSERT INTO lamaereports VALUES ('186', '1', 'รายงานผู้ป่วย Admit ที่ IPD ทั้งหมด', 'form1', 'report_ipd_admit', '2014-10-10', '', '', null);
INSERT INTO lamaereports VALUES ('187', '13', 'รายงานผู้ป่วย OPD Discharge', 'form1', 'report_dch_physic', '2014-10-15', '', '', null);
INSERT INTO lamaereports VALUES ('188', '12', 'จำนวนคนไข้ DM WITH HTได้รับการตรวจสุขภาพช่องปาก', 'form1', 'report_dent_0001', '2014-10-17', '', '', null);
INSERT INTO lamaereports VALUES ('189', '1', 'รายงานตรวจสอบ RW ที่มีค่าว่าง (ค่า Null)', 'form1', 'report4', '2016-09-21', 'enable', 'medical', null);
INSERT INTO lamaereports VALUES ('190', '1', 'รายงานการตรวจสอบเวชระเบียนผู้ป่วยนอก', 'form1', 'report5', '2016-09-21', 'enable', 'medical', null);
INSERT INTO lamaereports VALUES ('191', '7', 'รายงานอันดับโรคที่พบบ่อยที่ห้องอุบัติเหตุฉุกเฉิน', 'form1', 'report6', '2016-09-27', 'enable', 'emergen', null);
INSERT INTO lamaereports VALUES ('192', '7', 'รายงานสรุปยอดผู้รับบริการ แยกตามประเภทคลินิค', 'form1', 'report_er_spclty', '2014-12-18', '', '', null);
INSERT INTO lamaereports VALUES ('193', '10', 'รายงานสรุปจำนวนวันนอนเฉพาะ (VIP 2-6) ผู้ป่วยใน', 'form1', 'report_count_visit_ipd_only', '2015-01-14', '', '', null);
INSERT INTO lamaereports VALUES ('194', '3', 'รายงานผู้ป่วยเบาหวานที่มีค่าน้ำตาล (FBS,DTX) 70 -140', 'form1', 'report_dm_fbs', '2015-05-20', '', '', null);
INSERT INTO lamaereports VALUES ('195', '3', 'รายงานผู้ป่วยเบาหวานที่มีค่าน้ำตาล (FBS,DTX) ระหว่าง 141 - 180', 'form1', 'report_dm_fbs141-180', '2015-05-20', '', '', null);
INSERT INTO lamaereports VALUES ('196', '3', 'รายงานผู้ป่วยเบาหวานที่มีค่าน้ำตาล(FBS,DTX) มากกว่าหรือเท่ากับ 181 ขึ้นไป', 'form1', 'report_dm_fbs_181up', '2015-05-20', '', '', null);
INSERT INTO lamaereports VALUES ('197', '3', 'รายงานผู้ป่วยเบาหวานที่มีค่าน้ำตาล (FBS,DTX) น้อยกว่า 70', 'form1', 'report_dm_fbs_min_70', '2015-05-20', '', '', null);
INSERT INTO lamaereports VALUES ('198', '4', 'รายงานผู้ป่วยความดันที่มีค่า bps ระหว่าง 90 - 139', 'form1', 'report_ht_bps_90-139', '2015-05-20', '', '', null);
INSERT INTO lamaereports VALUES ('199', '4', 'รายงานผู้ป่วยความดันที่มีค่า bps ระหว่าง 140 - 179', 'form1', 'report_ht_bps_140-179', '2015-05-20', '', '', null);
INSERT INTO lamaereports VALUES ('200', '4', 'รายงานผู้ป่วยความดันที่มีค่า bps 180 ขึ้นไป', 'form1', 'report_ht_bps_180up', '2015-05-20', '', '', null);
INSERT INTO lamaereports VALUES ('201', '4', 'รายงานผู้ป่วยความดันที่มีค่า bps ต่ำกว่า 90', 'form1', 'report_ht_bps_min_90', '2015-05-20', '', '', null);
INSERT INTO lamaereports VALUES ('202', '6', 'รายงานคนไข้ทะเบียนคลินิกหอบหืด', 'form5', 'report1', '2016-06-17', 'enable', 'asthma', '');
INSERT INTO lamaereports VALUES ('203', '5', 'รายงานคนไข้ทะเบียนคลินิกถุงลมโป่งพอง', 'form5', 'report1', '2015-05-25', 'enable', 'copd', '');
INSERT INTO lamaereports VALUES ('204', '8', 'รายงานมูลค่าการใช้ยาแพทย์แผนไทย(ตามราคาทุน)', 'form1', 'report_ttm_cost_price', '2015-05-27', '', '', null);
INSERT INTO lamaereports VALUES ('205', '8', 'รายงานมูลค่าการใช้ยาแพทย์แผนไทย(ตามราคาขาย)', 'form1', 'report_ttm_sale_price', '2015-05-27', '', '', null);
INSERT INTO lamaereports VALUES ('206', '8', 'รายงานจำนวน visit ที่มีการสั่งใช้ยาแพทย์แผนไทย', 'form1', 'report_ttm_count_visit', '2015-05-27', '', '', null);
INSERT INTO lamaereports VALUES ('207', '8', 'รายงานจำนวน admit ที่มีการสั่งใช้ยาแพทย์แผนไทย', 'form1', 'report_ttm_count_admit', '2015-05-27', '', '', null);
INSERT INTO lamaereports VALUES ('208', '8', 'รายงานมูลค่าการใช้ยาทั้งหมดของ รพ.ละแม (ตามราคาทุน)', 'form1', 'report_hospital_cost_price', '2015-05-27', '', '', null);
INSERT INTO lamaereports VALUES ('209', '8', 'รายงานมูลค่าการใช้ยาทั้งหมดของ รพ.ละแม (ตามราคาขาย)', 'form1', 'report_hospital_sale_price', '2015-05-27', '', '', null);
INSERT INTO lamaereports VALUES ('210', '12', 'รายการการส่งต่อ (Refer) โดยห้องฟัน', 'form1', 'report_dent_refer', '2015-07-06', '', '', null);
INSERT INTO lamaereports VALUES ('211', '3', 'รายงานคนไข้เบาหวาน(DM ONLY) ที่มีค่า CVD เท่ากับ 4', 'form1', 'report_dm_only_cvd4', '2015-07-06', '', '', null);
INSERT INTO lamaereports VALUES ('212', '3', 'รายงานคนไข้เบาหวาน(DM ONLY) ที่มีค่า CVD เท่ากับ 5', 'form1', 'report_dm_only_cvd5', '2015-07-06', '', '', null);
INSERT INTO lamaereports VALUES ('213', '3', 'รายงานคนไข้เบาหวาน(DM WITH HT) ที่มีค่า CVD เท่ากับ 4', 'form1', 'report_dm_with_ht_cvd4', '2015-07-06', '', '', null);
INSERT INTO lamaereports VALUES ('214', '3', 'รายงานคนไข้เบาหวาน(DM WITH HT) ที่มีค่า CVD เท่ากับ 5', 'form1', 'report_dm_with_ht_cvd5', '2015-07-06', '', '', null);
INSERT INTO lamaereports VALUES ('215', '4', 'รายงานคนไข้ความดัน(HT ONLY) ที่มีค่า CVD เท่ากับ 4', 'form1', 'report_ht_only_cvd4', '2015-07-06', '', '', null);
INSERT INTO lamaereports VALUES ('216', '4', 'รายงานคนไข้ความดัน(HT ONLY) ที่มีค่า CVD เท่ากับ 5', 'form1', 'report_ht_only_cvd5', '2015-07-06', '', '', null);
INSERT INTO lamaereports VALUES ('217', '5', 'รายงานจำนวนคนไข้คลินิกถุงลมโป่งพอง แยกกลุ่มผู้ป่วยตาม Gold 11', 'form7', 'report8', '2016-06-17', 'enable', 'copd', '');
INSERT INTO lamaereports VALUES ('218', '5', 'รายงานจำนวนคนไข้ COPD สถานะติดตามการรักษา แยกกลุ่มผู้ป่วยตาม Gold 11 State B', 'form1', 'report_copd_gold_B', '2015-07-14', '', '', null);
INSERT INTO lamaereports VALUES ('219', '5', 'รายงานจำนวนคนไข้ COPD สถานะติดตามการรักษา แยกกลุ่มผู้ป่วยตาม Gold 11 State C', 'form1', 'report_copd_gold_C', '2015-07-14', '', '', null);
INSERT INTO lamaereports VALUES ('220', '5', 'รายงานจำนวนคนไข้ COPD สถานะติดตามการรักษา แยกกลุ่มผู้ป่วยตาม Gold 11 State D', 'form1', 'report_copd_gold_D', '2015-07-14', '', '', null);
INSERT INTO lamaereports VALUES ('221', '1', 'รายงานผู้ป่วย IPD ที่ไม่ยังได้ลงผลวินิจฉัยหลัก', 'form1', 'report_ipd_no_pdx', '2016-01-15', '', '', null);
INSERT INTO lamaereports VALUES ('222', '6', 'รายงานจำนวนคนไข้หอบหืด ได้รับการ Admit', 'form1', 'report5', '2016-06-20', 'enable', 'asthma', '');
INSERT INTO lamaereports VALUES ('252', '13', 'รายงานจำนวนหัตถการงานกายภาพบำบัด', 'form1', 'report1', '2016-10-07', 'enable', 'physic', null);
INSERT INTO lamaereports VALUES ('253', '7', 'รายงานจ่ายยานอกเวลาที่ห้องอุบัติเหตุฉุกเฉิน', 'form9', 'report7', '2016-10-12', 'enable', 'emergen', null);
INSERT INTO lamaereports VALUES ('257', '13', 'รายงานสรุปจำนวนการรับบริการงานกายภาพบำบัดแยกตามสิทธิ์การรักษา', 'form1', 'report2', '2016-10-13', 'enable', 'physic', null);
INSERT INTO lamaereports VALUES ('254', '7', 'รายงานจ่ายยานอกเวลา(16.00น.-07.59น.)ที่ห้องอุบัติเหตุฉุกเฉิน (เฉพาะวันหยุดราชการ)', 'form1', 'report8', '2016-10-10', 'disable', 'emergen', null);
INSERT INTO lamaereports VALUES ('246', '8', 'รายงานจ่ายยานอกเวลา 16.01น.-07.59น. (รวมวันหยุดราชการ)', 'form1', 'report7', '2016-10-06', 'enable', 'pharmacy', null);
INSERT INTO lamaereports VALUES ('247', '14', 'รายงานคนไข้ที่ใช้สิทธิ์ อปท.เข้าโครงการจ่ายตรง (ผู้ป่วยนอก)', 'form1', 'report13', '2016-10-07', 'enable', 'claim', null);
INSERT INTO lamaereports VALUES ('244', '10', 'รายงานคนไข้ IPD RE-ADMIT ภายใน 28 วัน ด้วยโรคเดิม', 'form1', 'report2', '2016-10-06', 'enable', 'ward', null);
INSERT INTO lamaereports VALUES ('245', '10', 'รายงานอันดับโรคคนไข้ IPD RE-ADMIT ภายใน 28 วัน ด้วยโรคเดิม(กราฟ)', 'form1', 'report3', '2016-10-06', 'enable', 'ward', null);
INSERT INTO lamaereports VALUES ('243', '14', 'รายงานคนไข้ที่ใช้สิทธิ์โครงการจ่ายตรง (ผู้ป่วยนอก)', 'form1', 'report12', '2016-10-05', 'enable', 'claim', null);
INSERT INTO lamaereports VALUES ('250', '14', 'รายงานตรวจสอบข้อมูลประกันสังคมผู้ป่วยนอก (ที่ยังไม่ลง diag หลัก)', 'form1', 'report16', '2016-10-07', 'enable', 'claim', null);
INSERT INTO lamaereports VALUES ('242', '14', 'รายงานสิทธิ์บัตรประกันสุขภาพถ้วนหน้า(UC) มีท,ไม่มีท เขตรอยต่อ (ผลวินิจฉัย E100 - E119,I10)', 'form1', 'report11', '2016-10-05', 'enable', 'claim', null);
INSERT INTO lamaereports VALUES ('240', '14', 'รายงานประกันสังคม ANC ผู้ป่วยนอก', 'form1', 'report9', '2016-10-05', 'enable', 'claim', null);
INSERT INTO lamaereports VALUES ('241', '14', 'รายงานสิทธิ์บัตรประกันสุขภาพถ้วนหน้า(UC) มีท,ไม่มีท เขตรอยต่อ', 'form1', 'report10', '2016-10-05', 'enable', 'claim', null);
INSERT INTO lamaereports VALUES ('239', '14', 'รายงานประกันสังคมทันตกรรม', 'form1', 'report8', '2016-10-05', 'enable', 'claim', null);
INSERT INTO lamaereports VALUES ('237', '14', 'รายงานประกันสังคมผู้ป่วยนอก สุราษฎร์ธานี', 'form1', 'report6', '2016-10-04', 'enable', 'claim', null);
INSERT INTO lamaereports VALUES ('238', '14', 'รายงานประกันสังคมชุมพร เรื้อรัง', 'form1', 'report7', '2016-10-04', 'enable', 'claim', null);
INSERT INTO lamaereports VALUES ('235', '14', 'รายงานประกันสังคมผู้ป่วยใน', 'form1', 'report5', '2016-10-04', 'enable', 'claim', null);
INSERT INTO lamaereports VALUES ('229', '4', 'รายงานจำนวนคนไข้ความดัน CVD RISK', 'form1', 'report10', '2016-08-17', 'enable', 'ht', null);
INSERT INTO lamaereports VALUES ('230', '8', 'รายงาน 100 อันดับมูลค่าการใช้ยาตามราคาทุน', 'form1', 'report6', '2016-08-23', 'enable', 'pharmacy', null);
INSERT INTO lamaereports VALUES ('231', '14', 'รายงานจำนวนคนไข้จ่ายค่าธรรมเนียม 30 บาท(เฉพาะสิทธิ์ 89,52,56)', 'form1', 'report1', '2016-10-03', 'enable', 'claim', null);
INSERT INTO lamaereports VALUES ('232', '14', 'จำนวนคนไข้ตามสิทธิ์ UC ทั้งหมด', 'form1', 'report2', '2016-10-03', 'enable', 'claim', null);
INSERT INTO lamaereports VALUES ('233', '14', 'รายงานพม่า (ที่มีรหัสวินิจฉัยหลักเป็น Z008,Z000)', 'form1', 'report3', '2016-10-04', 'enable', 'claim', null);
INSERT INTO lamaereports VALUES ('234', '14', 'รายงานประกันสังคมผู้ป่วยนอก', 'form1', 'report4', '2016-10-04', 'enable', 'claim', null);
INSERT INTO lamaereports VALUES ('228', '3', 'รายงานจำนวนคนไข้เบาหวาน CVD RISK', 'form3', 'report14', '2016-08-17', 'enable', 'dm', null);
INSERT INTO lamaereports VALUES ('251', '14', 'รายงานตรวจสอบสิทธิ์บัตรประกันสุขภาพถ้วนหน้า(UC) มีท,ไม่มีท เขตรอยต่อ (ที่ยังไม่ได้ลง diag)', 'form1', 'report17', '2016-10-07', 'enable', 'claim', null);
INSERT INTO lamaereports VALUES ('248', '14', 'รายงาน คนไข้ ที่ใช้สิทธิ์ โครงการจ่ายตรง (ผู้ป่วยใน)', 'form1', 'report14', '2016-10-07', 'enable', 'claim', null);
INSERT INTO lamaereports VALUES ('249', '14', 'รายงาน E-Claim ผู้ป่วยนอก  สิทธิ์ 56(UC นอกเขตต่างจังหวัดไม่มีท),57(UC ท นอกเขตต่างจังหวัดมี ท)', 'form1', 'report15', '2016-10-07', 'enable', 'claim', null);
INSERT INTO lamaereports VALUES ('226', '8', 'รายงานผลการใช้ยาปฏิชีวนะ ในผู้ป่วยติดเชื้อดื้อยา', 'form1', 'report5', '2016-08-15', 'enable', 'pharmacy', null);
INSERT INTO lamaereports VALUES ('227', '7', 'รายงานป้องกันและแก้ไขปัญหาอุบัติเหตุทางถนน', 'form1', 'report4', '2016-08-17', 'enable', 'emergen', null);
INSERT INTO lamaereports VALUES ('223', '7', 'รายงานจำนวนครั้งการสั่งใช้ยา TRCS', 'form1', 'report1', '2016-06-22', 'enable', 'emergen', '');
INSERT INTO lamaereports VALUES ('224', '7', 'รายงานจำนวนครั้งการสั่งใช้ยา PCEC', 'form1', 'report2', '2016-06-22', 'enable', 'emergen', '');
INSERT INTO lamaereports VALUES ('225', '7', 'รายงานจำนวนครั้งการสั่งใช้ยา TETANUS', 'form1', 'report3', '2016-06-22', 'enable', 'emergen', '');
INSERT INTO lamaereports VALUES ('256', '1', 'รายงานตรวจสอบคนไข้นอกเขต รพ.ละแม แต่ลง Typearea เป็นคนในเขต', 'form5', 'report6', '2016-10-11', 'enable', 'medical', null);
INSERT INTO lamaereports VALUES ('258', '9', 'รายงานสรุปหญิงตามช่วงอายุ ในเขตรับผิดชอบ', 'form11', 'report1', '2016-10-13', 'enable', 'pcu', null);
INSERT INTO lamaereports VALUES ('259', '9', 'รายงานสรุปประชากรอายุ >=35 ปี ในเขตรับผิดชอบ', 'form5', 'report3', '2016-10-13', 'enable', 'pcu', null);
INSERT INTO lamaereports VALUES ('260', '7', 'รายงานสรุปอันดับโรคส่ง Refer ที่ห้องอุบัติเหตุฉุกเฉิน', 'form10', 'report9', '2016-10-21', 'enable', 'emergen', null);
INSERT INTO lamaereports VALUES ('261', '10', 'รายงานสรุปอันดับโรคส่ง Refer ที่ตึกผู้ป่วยใน', 'form10', 'report4', '2016-10-21', 'enable', 'ward', null);
INSERT INTO lamaereports VALUES ('262', '1', 'รายงานตรวจสอบ => คนไข้ 1 CID แต่มีหลาย HN', 'form5', 'report7', '2016-10-26', 'enable', 'medical', null);
INSERT INTO lamaereports VALUES ('263', '9', 'รายงานตรวจสอบ => ผู้ป่วยที่อยู่ใน เวชระเบียน Patient แต่ไม่มีในบัญชี 1 Person', 'form5', 'report5', '2016-10-26', 'enable', 'pcu', null);
INSERT INTO lamaereports VALUES ('264', '9', 'รายงานตรวจสอบ => ในบัญชี1 Type(1,2) แต่ในเวชระเบียนลงที่อยู่นอกเขต', 'form5', 'report6', '2016-10-27', 'enable', 'pcu', null);
INSERT INTO lamaereports VALUES ('265', '9', 'รายงานตรวจสอบ => ผู้ป่วย TypeAreaในบัญชี 1 เป็นค่าว่าง', 'form5', 'report7', '2016-10-27', 'enable', 'pcu', null);
INSERT INTO lamaereports VALUES ('266', '9', 'รายงานตรวจสอบ => สถานะในครอบครัว 1 = เจ้าบ้าน  , 2 = ผู้อาศัย ในบัญชี 1 ว่าง', 'form5', 'report8', '2016-10-27', 'enable', 'pcu', null);
INSERT INTO lamaereports VALUES ('267', '9', 'รายงานตรวจสอบ => การศึกษาว่าง ในบัญชี 1 เป็นค่าว่าง', 'form5', 'report9', '2016-10-27', 'enable', 'pcu', null);
INSERT INTO lamaereports VALUES ('268', '9', 'รายงานตรวจสอบ => การศึกษา อายุ 6-12 ปี ไม่ใช่ชั้นประถม ในบัญชี 1 มีผลกับ HDC', 'form5', 'report10', '2016-10-27', 'enable', 'pcu', null);
INSERT INTO lamaereports VALUES ('269', '9', 'รายงานตรวจสอบ => อาชีพว่าง ในบัญชี 1 เป็นค่าว่าง', 'form5', 'report11', '2016-10-27', 'enable', 'pcu', null);
INSERT INTO lamaereports VALUES ('270', '9', 'รายงานตรวจสอบ => คำนำหน้าชื่อว่าง ในบัญชี 1 เป็นค่าว่าง', 'form5', 'report12', '2016-10-27', 'enable', 'pcu', null);
INSERT INTO lamaereports VALUES ('271', '1', 'รายงานตรวจสอบ => คำนำหน้ากับเพศ ไม่สัมพันธ์กัน', 'form5', 'report8', '2016-10-27', 'enable', 'medical', null);
INSERT INTO lamaereports VALUES ('272', '14', 'รายงานคนไข้ที่มีการบันทึก Typearea เป็น Type3 ในฝั่งข้อมูลประชากร(Person)', 'form5', 'report18', '2016-10-27', 'enable', 'claim', null);
INSERT INTO lamaereports VALUES ('273', '9', 'รายงานตรวจสอบ => สิทธิการรักษา ไม่มีใน pttype ในบัญชี 1 ทำให้ส่งออกไม่ได้', 'form5', 'report13', '2016-10-27', 'enable', 'pcu', null);
INSERT INTO lamaereports VALUES ('274', '7', 'รายงานผู้รับบริการหัตถการ เย็บแผลทั่วไป,excission,off norplant,ฝัง norplant,stitch off (ตัดไหม)', 'form1', 'report10', '2016-11-08', 'enable', 'emergen', null);
INSERT INTO lamaereports VALUES ('275', '3', 'รายงานตรวจสอบการคัดกรองคนไข้ที่มี BPS >= 180 (แบบสรุป)', 'form3', 'report15', '2016-11-08', 'enable', 'dm', null);
INSERT INTO lamaereports VALUES ('276', '3', 'รายงานคนไข้คลินิกเบาหวาน (สถานะติดตามการรักษา) ประวัติการคัดกรอง BP', 'form3', 'report16', '2016-11-08', 'enable', 'dm', null);
INSERT INTO lamaereports VALUES ('277', '4', 'รายงานตรวจสอบการคัดกรองคนไข้ที่มี BPS >= 180 (แบบสรุป)', 'form1', 'report12', '2016-11-08', 'enable', 'ht', null);
INSERT INTO lamaereports VALUES ('278', '4', 'รายงานคนไข้คลินิกความดัน (สถานะติดตามการรักษา) ประวัติการคัดกรอง BP', 'form1', 'report13', '2016-11-08', 'enable', 'ht', null);
INSERT INTO lamaereports VALUES ('279', '3', 'รายงานคนไข้ตรวจแลป FBS,DTX มากกว่าหรือเท่ากับ 180 ขึ้นไป', 'form3', 'report17', '2016-11-08', 'enable', 'dm', null);
INSERT INTO lamaereports VALUES ('280', '11', 'รายงานผู้มารับบริการแพทย์แผนไทย (รายครั้ง)', 'form1', 'report2', '2016-11-09', 'enable', 'ttm', null);
INSERT INTO lamaereports VALUES ('281', '11', 'รายงานผู้มารับบริการที่มีการสั่งยาแพทย์แผนไทยแต่ไม่ได้ไปรับบริการที่แพทย์แผนไทย', 'form1', 'report3', '2016-11-09', 'enable', 'ttm', null);
INSERT INTO lamaereports VALUES ('282', '8', 'รายงานจำนวน visit ที่จ่ายยานอกเวลา 16.01น.-07.59น. (รวมวันหยุดราชการ)', 'form1', 'report8', '2016-11-09', 'enable', 'pharmacy', null);
INSERT INTO lamaereports VALUES ('283', '7', 'รายงานตรวจแลป Hemoculture', 'form1', 'report11', '2016-11-10', 'enable', 'emergen', null);
INSERT INTO lamaereports VALUES ('284', '8', 'รายงานสรุปจำนวนผู้มารับบริการแยกตามกลุ่มรหัสวินิจฉัยโรค', 'form8', 'report9', '2016-11-11', 'enable', 'pharmacy', null);
INSERT INTO lamaereports VALUES ('285', '9', 'รายงานตรวจสอบ => สิทธิการรักษา ในบัญชี 1 ว่าง', 'form5', 'report14', '2016-11-14', 'enable', 'pcu', null);
INSERT INTO lamaereports VALUES ('286', '9', 'รายงานตรวจสอบ => มีสัญชาติไทย แต่เลขที่บัตรประชาชน ขึ้นต้นด้วย 0 Type 1 , 3', 'form5', 'report15', '2016-11-14', 'enable', 'pcu', null);
INSERT INTO lamaereports VALUES ('287', '9', 'รายงานตรวจสอบ => คนที่มีบ้านเลขที่บ้าน แต่ไม่มีหลังคาเรือนในระบบ', 'form5', 'report16', '2016-11-14', 'enable', 'pcu', null);
INSERT INTO lamaereports VALUES ('288', '9', 'รายงานตรวจสอบ => คนต่างด้าว ไม่ลงประเภทคนต่างด้าวในบัญชี1', 'form5', 'report17', '2016-11-14', 'enable', 'pcu', null);
INSERT INTO lamaereports VALUES ('289', '9', 'รายงานตรวจสอบ => ลงติ๊กเสียชีวิตแล้ว ในบัญชี 1 แต่สถานะยังไม่จำหน่าย', 'form5', 'report18', '2016-11-14', 'enable', 'pcu', null);
INSERT INTO lamaereports VALUES ('290', '9', 'รายงานตรวจสอบ => ลงติ๊กเสียชีวิตแล้ว ในบัญชี 1 แต่สถานะยังมีชีวิตอยู่', 'form5', 'report19', '2016-11-15', 'enable', 'pcu', null);
INSERT INTO lamaereports VALUES ('291', '7', 'รายงานผู้ป่วยนอกทั้งหมด RE-VISIT ภายใน 48 ชั่วโมง', 'form1', 'report10', '2016-11-15', 'disable', 'emergen', null);
INSERT INTO lamaereports VALUES ('292', '8', 'รายงานจำนวน visit ที่ได้รับยา Glibenclamide', 'form1', 'report10', '2016-11-16', 'enable', 'pharmacy', null);
INSERT INTO lamaereports VALUES ('293', '8', 'รายงานจำนวน visit ที่ได้รับยา METFORMIN', 'form1', 'report11', '2016-11-16', 'enable', 'pharmacy', null);
INSERT INTO lamaereports VALUES ('294', '8', 'รายงานจำนวน visit ที่ได้รับยา Diclofenac,Mefenamic,Ibuprofen', 'form1', 'report12', '2016-11-16', 'enable', 'pharmacy', null);
INSERT INTO lamaereports VALUES ('295', '8', 'รายงานจำนวน visit ที่ได้รับยา Diclofenac,Mefenamic,Ibuprofen ร่วมกัน', 'form1', 'report13', '2016-11-17', 'enable', 'pharmacy', null);
INSERT INTO lamaereports VALUES ('296', '8', 'รายงานจำนวนคนที่ได้รับยาในกลุ่มยาที่กำหนด', 'form1', 'report14', '2016-11-17', 'enable', 'pharmacy', null);
INSERT INTO lamaereports VALUES ('297', '7', 'รายงานคนไข้ diag head injury รับบริการที่งานอุบัติเหตุฉุกเฉิน', 'form1', 'report13', '2016-11-18', 'enable', 'emergen', null);
INSERT INTO lamaereports VALUES ('298', '3', 'รายงานจำนวนคนไข้คลินิกเบาหวาน ได้รับการ admit', 'form3', 'report18', '2016-11-23', 'disable', 'dm', null);
INSERT INTO lamaereports VALUES ('299', '9', 'รายงานอาการคล้ายไข้หวัดใหญ่ (ILI)', 'form1', 'report20', '2016-11-24', 'enable', 'pcu', null);
INSERT INTO lamaereports VALUES ('300', '9', 'รายงานตรวจสอบ => สถานะสมณะ แต่คำนำหน้าไม่ใช่ สมณะ', 'form5', 'report21', '2016-12-08', 'enable', 'pcu', null);
INSERT INTO lamaereports VALUES ('301', '9', 'รายงานตรวจสอบ => คำนำหน้าเป็นพระ แต่สถานะไม่ใช่สมณะ', 'form5', 'report22', '2016-12-08', 'enable', 'pcu', null);
INSERT INTO lamaereports VALUES ('302', '9', 'รายงานตรวจสอบ => ตรวจสอบสถานะเป็นพระ แต่ อายุ ไม่ถึง 20 ปี', 'form5', 'report23', '2016-12-08', 'enable', 'pcu', null);
INSERT INTO lamaereports VALUES ('303', '1', 'รายงานตรวจสอบ => ยืม-คืน Chart ผู้ป่วยใน', 'form1', 'report9', '2016-12-08', 'enable', 'medical', null);
INSERT INTO lamaereports VALUES ('304', '10', 'รายงานผู้ป่วย admit ความดันโลหิตสูง', 'form1', 'report5', '2016-12-15', 'enable', 'ward', null);
INSERT INTO lamaereports VALUES ('305', '10', 'รายงานผู้ป่วย admit sepsis', 'form1', 'report6', '2016-12-15', 'enable', 'ward', null);
INSERT INTO lamaereports VALUES ('306', '15', 'รายงานจำนวนครั้งคัดกรองวัณโรค', 'form1', 'report1', '2016-12-27', 'enable', 'tb', null);
INSERT INTO lamaereports VALUES ('307', '16', 'รายงานจำนวนครั้งหญิงตั้งครรภ์ ได้รับยา Triferdine', 'form1', 'report1', '2016-12-27', 'enable', 'anc', null);
INSERT INTO lamaereports VALUES ('308', '16', 'รายงานจำนวนครั้งหญิงตั้งครรภ์ ที่มีผลแลป hematocrit < 33%', 'form1', 'report2', '2016-12-27', 'enable', 'anc', null);
INSERT INTO lamaereports VALUES ('309', '16', 'รายงานหญิงตั้งครรภ์ทุกรายได้รับการคัดกรองภาวะเสี่ยงและพบภาวะเสี่ยง', 'form1', 'report3', '2016-12-27', 'enable', 'anc', null);
INSERT INTO lamaereports VALUES ('310', '16', 'รายงานจำนวนครั้งหญิงตั้งครรภ์ ได้รับการตรวจแลป hematocrit,vdrl,anti-hiv,HBsAg,OF,DCIP', 'form1', 'report4', '2016-12-28', 'enable', 'anc', null);
INSERT INTO lamaereports VALUES ('311', '17', 'รายงานผู้ป่วยค้างชำระ', 'form1', 'report1', '2017-01-25', 'enable', 'account', null);
INSERT INTO lamaereports VALUES ('312', '9', 'รายงานสรุปผลการคัดกรองโรคเรื้อรังในชุมชนรับผิดชอบ', 'form12', 'report24', '2017-01-25', 'enable', 'pcu', null);
INSERT INTO lamaereports VALUES ('313', '18', 'รายงานผู้ป่วยที่มีรหัสวินิจฉัย B24', 'form1', 'report1', '2017-01-31', 'enable', 'arv', null);
INSERT INTO lamaereports VALUES ('314', '1', 'รายงานผู้มารับบริการ(OPD) แยกตามสิทธิ์การรักษา', 'form13', 'report11', '2017-01-31', 'enable', 'medical', null);
INSERT INTO lamaereports VALUES ('315', '14', 'รายงานผู้ป่วย OPD ในเขตตำบลละแม (หมู่1-7,9,10,12,14) มีรหัสวินิจฉัยหลัก เป็น z515', 'form1', 'report19', '2017-01-31', 'enable', 'claim', null);
INSERT INTO lamaereports VALUES ('316', '3', 'รายงานจำนวนคนไข้คลินิคเบาหวาน  (สถานะติดตามการรักษา)  คัดกรอง ส่วนสูง/รอบเอว', 'form3', 'report19', '2017-02-08', 'enable', 'dm', null);
INSERT INTO lamaereports VALUES ('317', '3', 'รายงานจำนวนคนไข้คลินิคเบาหวาน ได้รับการ admit', 'form1', 'report20', '2017-02-09', 'enable', 'dm', '1.คนไข้ที่อยู่ในทะเบียนคลินิกเบาหวาน, 2.ได้รับการวินิจฉัย e110-e119, 3. ได้รับการ admit');
INSERT INTO lamaereports VALUES ('319', '3', 'รายงานจำนวนคนไข้คลินิคเบาหวาน (สถานะติดตามการรักษา) ผลตรวจแลป DTX,Glucose ล่าสุด', 'form3', 'report21', '2017-02-14', 'enable', 'dm', null);
INSERT INTO lamaereports VALUES ('318', '4', 'รายงานจำนวนคนไข้คลินิคความดัน (สถานะติดตามการรักษา)  คัดกรอง ส่วนสูง/รอบเอว', 'form1', 'report14', '2017-02-10', 'enable', 'ht', null);
INSERT INTO lamaereports VALUES ('320', '7', 'รายงานจำนวนคนไข้ Admit diag head injury', 'form1', 'report14', '2017-02-17', 'enable', 'emergen', null);
INSERT INTO lamaereports VALUES ('321', '7', 'รายงานคนไข้ผู้ป่วยนอกทั้งหมด diag head injury', 'form1', 'report15', '2017-02-17', 'enable', 'emergen', null);
INSERT INTO lamaereports VALUES ('322', '7', 'รายงานคนไข้ผู้ป่วยนอกทั้งหมด diag head injury Re-visit ภายใน 48 ชั่วโมง', 'form1', 'report16', '2017-02-17', 'enable', 'emergen', null);
INSERT INTO lamaereports VALUES ('323', '11', 'รายงานมูลค่าการสั่งใช้ยาแพทย์แผนไทยทั้งหมดแยกตามรายการยาแพทย์แผนไทย', 'form1', 'report4', '2017-02-20', 'enable', 'ttm', null);
INSERT INTO lamaereports VALUES ('324', '11', 'รายงานมูลค่าการสั่งใช้ยาแพทย์แผนไทยทั้งหมดแยกตามแพทย์ผู้สั่ง', 'form1', 'report5', '2017-02-20', 'enable', 'ttm', null);
INSERT INTO lamaereports VALUES ('325', '11', 'รายงานมูลค่าการสั่งใช้ยาแพทย์แผนไทยทั้งหมดแยกตามสิทธิ์การรักษา', 'form1', 'report6', '2017-02-20', 'enable', 'ttm', null);
INSERT INTO lamaereports VALUES ('326', '3', 'รายงานจำนวนคนไข้คลินิคเบาหวาน (สถานะติดตามการรักษา) มีผลตรวจแลป LDL น้อยกว่า 100 ครั้งล่าสุด', 'form3', 'report22', '2017-02-22', 'enable', 'dm', null);
INSERT INTO lamaereports VALUES ('327', '4', 'รายงานจำนวนคนไข้คลินิคความดัน (สถานะติดตามการรักษา) มีผลตรวจแลป LDL น้อยกว่า 100 ครั้งล่าสุด', 'form1', 'report15', '2017-02-22', 'enable', 'ht', null);
INSERT INTO lamaereports VALUES ('328', '9', 'รายงานสรุปประชากรในเขตรับผิดชอบ แบ่งตามอายุ, เทศบาล/อบต.', 'form14', 'report26', '2017-02-24', 'enable', 'pcu', null);
INSERT INTO lamaereports VALUES ('329', '7', 'รายงานจำนวนครั้ง CPR ที่ห้องอุบัติเหตุฉุกเฉิน', 'form1', 'report17', '2017-02-28', 'enable', 'emergen', null);
INSERT INTO lamaereports VALUES ('330', '19', 'รายงานจำนวนครั้งการรายงานผล x-ray นอกเวลาราชการ', 'form1', 'report1', '2017-03-02', 'enable', 'xray', null);
INSERT INTO lamaereports VALUES ('331', '8', 'รายงานการสั่งใช้ยานอกเวลาทุกจุดบริการ (ไม่รวมวันหยุดราชการและวันนักขัตฤกษ์)', 'form15', 'report15', '2017-03-09', 'enable', 'pharmacy', null);
INSERT INTO lamaereports VALUES ('332', '8', 'รายงานจำนวน visit คนไข้สั่งใช้ยาทุกจุดบริการ  (ไม่รวมวันหยุดราชการและวันนักขัตฤกษ์)', 'form15', 'report16', '2017-03-09', 'enable', 'pharmacy', null);
INSERT INTO lamaereports VALUES ('333', '7', 'รายงานจำนวนครั้งผู้รับบริการในกลุ่มผู้ป่วยกระดูกหักที่ห้องอุบัติเหตุฉุกเฉิน (แบบ Close)', 'form1', 'report18', '2017-03-16', 'enable', 'emergen', null);
INSERT INTO lamaereports VALUES ('334', '7', 'รายงานจำนวนครั้งผู้รับบริการในกลุ่มผู้ป่วยกระดูกหักที่ห้องอุบัติเหตุฉุกเฉิน (แบบ Open)', 'form1', 'report20', '2017-03-17', 'enable', 'emergen', null);
INSERT INTO lamaereports VALUES ('335', '8', 'รายงานมูลค่าการใช้ยาทั้งหมด', 'form1', 'report17', '2017-04-05', 'enable', 'pharmacy', null);
INSERT INTO lamaereports VALUES ('336', '9', 'รายงานผู้มารับบริการ(เฉพาะสัญชาติไทย)ตามช่วงเวลาที่มารับบริการ opd ที่ไม่มีชื่ออยู่ในบัญชี 1(อ้างอิงจาก cid)', 'form1', 'report29', '2017-04-21', 'enable', 'pcu', null);
