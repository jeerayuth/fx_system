/*
Navicat MySQL Data Transfer

Source Server         : SERVER_MASTER
Source Server Version : 50532
Source Host           : 192.168.1.253:3306
Source Database       : hos

Target Server Type    : MYSQL
Target Server Version : 50532
File Encoding         : 65001

Date: 2016-08-23 10:23:11
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
) ENGINE=MyISAM AUTO_INCREMENT=230 DEFAULT CHARSET=tis620;

-- ----------------------------
-- Records of lamaereports
-- ----------------------------
INSERT INTO lamaereports VALUES ('4', '2', 'รายงานผู้ป่วยนอกที่มารับบริการด้วย Diag หลัก  J440 - J449', 'form1', 'report_opd_diag_between_j440_and_j449', '2013-11-21', '', '', null);
INSERT INTO lamaereports VALUES ('3', '8', 'รายงานมูลค่าการใช้ยาปฏิชีวนะ', 'form1', 'report1', '2016-08-08', 'enable', 'pharmacy', null);
INSERT INTO lamaereports VALUES ('5', '2', 'รายงานผู้ป่วยนอกที่มารับบริการด้วย Diag หลัก  J450 - J459', 'form1', 'report_opd_diag_between_j450_and_j459', '2013-11-21', '', '', null);
INSERT INTO lamaereports VALUES ('6', '4', 'รายงานจำนวนคนไข้ความดัน ที่ได้รับการตรวจน้ำตาล (FBS)', 'form1', 'report6', '2016-06-14', 'disable', 'ht', '');
INSERT INTO lamaereports VALUES ('7', '3', 'รายงานคนไข้ทะเบียนเบาหวาน', 'form2', 'report1', '2016-04-27', 'enable', 'dm', null);
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
INSERT INTO lamaereports VALUES ('27', '10', 'รายงานการสั่งแลปจากผู้ป่วยใน', 'form3', 'report_ipd_lab_order', '2013-12-13', '', '', null);
INSERT INTO lamaereports VALUES ('28', '3', 'รายงานคนไข้คลินิคเบาหวาน(มีความดันร่วม) ตรวจแลป GFR', 'form1', 'report_dm_with_ht_screen_lab_gfr', '2013-12-13', '', '', null);
INSERT INTO lamaereports VALUES ('29', '4', 'รายงานคนไข้คลินิกความดันโลหิตสูง ได้รับการตรวจแลปชนิดต่างๆ', 'form6', 'report5', '2016-06-14', 'enable', 'ht', '');
INSERT INTO lamaereports VALUES ('30', '7', 'รายงานผู้ป่วยที่มารับบริการที่ห้องฉุกเฉิน (ER)', 'form1', 'report_er_service', '2013-12-19', '', '', null);
INSERT INTO lamaereports VALUES ('31', '5', 'รายงานจำนวนคนไข้ถุงลมโป่งพอง ได้รับการบริการที่ห้องฉุกเฉิน (ER)', 'form1', 'report4', '2016-06-15', 'enable', 'copd', '');
INSERT INTO lamaereports VALUES ('32', '5', 'รายงานจำนวนคนไข้คลินิกถุงลมโป่งพอง ได้รับการ Admit', 'form1', 'report5', '2016-06-15', 'enable', 'copd', '');
INSERT INTO lamaereports VALUES ('33', '3', 'รายงานคนไข้ทะเบียนเบาหวานที่มีความดันโลหิตร่วมด้วย', 'form2', 'report3', '2016-04-22', 'disable', 'dm', null);
INSERT INTO lamaereports VALUES ('34', '4', 'รายงานทะเบียนคนไข้คลินิกความดันโลหิตสูง', 'form5', 'report1', '2016-06-09', 'enable', 'ht', '');
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
INSERT INTO lamaereports VALUES ('104', '11', 'รายงานสรุปหัตถการแพทย์แผนไทย ตามสิทธิ์การรักษา', 'form1', 'report_ttm_opitemrec', '2014-01-29', '', '', null);
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
INSERT INTO lamaereports VALUES ('160', '1', 'รายงานสรุปการรับบริการคนไข้ OPD แยกรายเดือน', 'form1', 'report_count_visit_opd', '2014-06-13', '', '', null);
INSERT INTO lamaereports VALUES ('161', '1', 'รายงานสรุปการรับบริการคนไข้ทั้ง Ward แยกรายเดือน', 'form1', 'report_count_visit_ipd', '2014-06-13', '', '', null);
INSERT INTO lamaereports VALUES ('162', '1', 'รายงานทะเบียนผู้เสียชีวิต', 'form1', 'report_death', '2014-06-18', '', '', null);
INSERT INTO lamaereports VALUES ('163', '5', 'รายงานคนไข้ COPD ได้รับบริการที่ ER (ตรวจสอบการใส่ท่อหลอดลมคอ)', 'form1', 'report_copd_er_service_tube_code_224', '2014-07-09', '', '', null);
INSERT INTO lamaereports VALUES ('164', '6', 'รายงานคนไข้ Asthma ได้รับบริการที่ ER (ตรวจสอบการใส่ท่อหลอดลมคอ)', 'form1', 'report_asthma_er_service_tube_code_224', '2014-07-09', '', '', null);
INSERT INTO lamaereports VALUES ('165', '4', 'รายงานจำนวนคนไข้ความดันได้รับการตรวจ Lipid Profile', 'form1', 'report_ht_screen_lab_code_lipid_Profile', '2014-07-17', '', '', null);
INSERT INTO lamaereports VALUES ('166', '3', 'รายงานจำนวนคนไข้เบาหวาน(ไม่มีความดันร่วม) ได้รับการตรวจ Lipid Profile', 'form1', 'report_dm_only_screen_lab_code_lipid_Profile', '2014-07-17', '', '', null);
INSERT INTO lamaereports VALUES ('167', '3', 'รายงานจำนวนคนไข้เบาหวาน(มีความดันร่วม) ได้รับการตรวจ Lipid Profile', 'form1', 'report_dm_with_ht_screen_lab_code_lipid_Profile', '2014-07-17', '', '', null);
INSERT INTO lamaereports VALUES ('168', '3', 'รายงานจำนวนคนไข้เบาหวาน CKD Diag N181 - N185', 'form3', 'report10', '2016-06-02', 'enable', 'dm', '');
INSERT INTO lamaereports VALUES ('169', '3', 'รายงานจำนวนคนไข้เบาหวาน(มีความดันร่วม) CKD Diag N170-N19', 'form1', 'report_dm_with_ht_ckd', '2014-07-29', '', '', null);
INSERT INTO lamaereports VALUES ('170', '4', 'รายงานจำนวนคนไข้ความดัน CKD Diag N170-N19', 'form1', 'report6', '2016-06-14', 'enable', 'ht', '');
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
INSERT INTO lamaereports VALUES ('189', '1', 'รายงานตรวจสอบ RW ที่มีค่าว่าง (ค่า Null)', 'form1', 'report_count_rw_null', '2014-10-27', '', '', null);
INSERT INTO lamaereports VALUES ('190', '1', 'รายงานการตรวจสอบเวชระเบียนผู้ป่วยนอก(OPD CARD)เบื้องต้น', 'form1', 'report_count_complete_folder', '2014-10-27', '', '', null);
INSERT INTO lamaereports VALUES ('191', '7', 'รายงานสรุปยอดผู้รับบริการแยกประเภทตามความฉุกเฉิน', 'form1', 'report_er_pt_type', '2014-12-18', '', '', null);
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
INSERT INTO lamaereports VALUES ('229', '4', 'รายงานจำนวนคนไข้ความดัน CVD RISK', 'form1', 'report10', '2016-08-17', 'enable', 'ht', null);
INSERT INTO lamaereports VALUES ('228', '3', 'รายงานจำนวนคนไข้เบาหวาน CVD RISK', 'form3', 'report14', '2016-08-17', 'enable', 'dm', null);
INSERT INTO lamaereports VALUES ('226', '8', 'รายงานผลการใช้ยาปฏิชีวนะ ในผู้ป่วยติดเชื้อดื้อยา', 'form1', 'report5', '2016-08-15', 'enable', 'pharmacy', null);
INSERT INTO lamaereports VALUES ('227', '7', 'รายงานป้องกันและแก้ไขปัญหาอุบัติเหตุทางถนน', 'form1', 'report4', '2016-08-17', 'enable', 'emergen', null);
INSERT INTO lamaereports VALUES ('223', '7', 'รายงานจำนวนครั้งการสั่งใช้ยา TRCS', 'form1', 'report1', '2016-06-22', 'enable', 'emergen', '');
INSERT INTO lamaereports VALUES ('224', '7', 'รายงานจำนวนครั้งการสั่งใช้ยา PCEC', 'form1', 'report2', '2016-06-22', 'enable', 'emergen', '');
INSERT INTO lamaereports VALUES ('225', '7', 'รายงานจำนวนครั้งการสั่งใช้ยา TETANUS', 'form1', 'report3', '2016-06-22', 'enable', 'emergen', '');
