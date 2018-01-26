/*
Navicat MySQL Data Transfer

Source Server         : Local
Source Server Version : 50539
Source Host           : localhost:3306
Source Database       : c0apps

Target Server Type    : MYSQL
Target Server Version : 50539
File Encoding         : 65001

Date: 2018-01-26 07:59:21
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for authorities
-- ----------------------------
DROP TABLE IF EXISTS `authorities`;
CREATE TABLE `authorities` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `name_auth` varchar(1024) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of authorities
-- ----------------------------
INSERT INTO `authorities` VALUES ('1', 'Administrators');
INSERT INTO `authorities` VALUES ('2', 'Admin');
INSERT INTO `authorities` VALUES ('3', 'Kế toán');
INSERT INTO `authorities` VALUES ('4', 'Nhân viên tư vấn');
INSERT INTO `authorities` VALUES ('5', 'Kho');

-- ----------------------------
-- Table structure for customer
-- ----------------------------
DROP TABLE IF EXISTS `customer`;
CREATE TABLE `customer` (
  `id` bigint(255) NOT NULL AUTO_INCREMENT,
  `code` varchar(1024) COLLATE utf8_unicode_ci DEFAULT NULL,
  `full_name` varchar(1024) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(1024) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ngay_sinh` date DEFAULT NULL,
  `dia_chi` varchar(1024) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dien_thoai` varchar(1024) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dien_thoai_2` varchar(1024) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hinh_anh` varchar(1024) COLLATE utf8_unicode_ci DEFAULT NULL,
  `passport_id` varchar(1024) COLLATE utf8_unicode_ci DEFAULT NULL,
  `note` text COLLATE utf8_unicode_ci,
  `supervisor` bigint(255) NOT NULL,
  `cmd` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_staff` (`supervisor`) USING BTREE,
  CONSTRAINT `customer_ibfk_1` FOREIGN KEY (`supervisor`) REFERENCES `staff` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of customer
-- ----------------------------
INSERT INTO `customer` VALUES ('1', 'KHPQA01', 'Trần văn bình', 'lebinh@gmail.com', '0000-00-00', 'Phu Dong Thien Vuong - Thành phố đà nẵng', '0932337133', '', null, '09323371222', '<p>Kh&aacute;ch h&agrave;ng tiềm năng, bệnh gan</p>\r\n', '14', '1000');
INSERT INTO `customer` VALUES ('2', 'KHPQA02', 'Lê Ngọc hân', 'han@gmail.com', '0000-00-00', 'Hoàng Mai - Hà Nội', '0932337133', '04232337133', null, '04232337133', '<p>Bện vi&ecirc;m phổi cấp t&iacute;nh.&nbsp;</p>\r\n', '14', '1000');
INSERT INTO `customer` VALUES ('3', 'KHPQA03', 'Trần Hoài Nam', 'hoainam@gmail.com', '1973-01-25', 'Hồng La - Lào cai', '0932337122', '0932337122', null, '0932337122', '<p>Đau Khớp g&oacute;i li&ecirc;n ho&agrave;n</p>', '18', '1000');
INSERT INTO `customer` VALUES ('4', 'KHPAQ04', 'Han Desk', 'handeskdotvn@gmail.com', null, 'Hai ba trung ha noi', '0932337133', null, null, null, 'Ghi chú', '14', null);

-- ----------------------------
-- Table structure for email_sending
-- ----------------------------
DROP TABLE IF EXISTS `email_sending`;
CREATE TABLE `email_sending` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `staff` int(255) NOT NULL,
  `title` varchar(1024) COLLATE utf8_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8_unicode_ci,
  `email` varchar(1024) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of email_sending
-- ----------------------------
INSERT INTO `email_sending` VALUES ('1', '1', 'Chúc mừngsss', 'Như vậy nhé em', 'handeskim@gmail.com', '1');

-- ----------------------------
-- Table structure for generic
-- ----------------------------
DROP TABLE IF EXISTS `generic`;
CREATE TABLE `generic` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `smtp_host` varchar(1024) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `smtp_pass` varchar(255) DEFAULT NULL,
  `smtp_user` varchar(255) DEFAULT NULL,
  `smtp_port` varchar(255) DEFAULT NULL,
  `smtp_crypto` varchar(255) DEFAULT NULL,
  `company_invoice` text,
  `mail_from` varchar(1024) DEFAULT NULL,
  `sms_key` varchar(1024) DEFAULT NULL,
  `sms_secret` varchar(1024) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of generic
-- ----------------------------
INSERT INTO `generic` VALUES ('1', 'smtp.gmail.com', 'LoveYou1324', 'info.vnphones@gmail.com', '587', 'tls', '<p><span style=\"font-family: &quot;Helvetica Neue&quot;, Helvetica, Helvetica, Arial, sans-serif; font-size: medium;\">C&ocirc;ng ty cổ phần PQA .</span><br style=\"box-sizing: border-box; font-family: &quot;Helvetica Neue&quot;, Helvetica, Helvetica, Arial, sans-serif; font-size: medium;\" />\n<span style=\"font-family: &quot;Helvetica Neue&quot;, Helvetica, Helvetica, Arial, sans-serif; font-size: medium;\">Số 123 Ho&agrave;ng Hoa Th&aacute;m - Q.Ng&ocirc; Quyền</span><br style=\"box-sizing: border-box; font-family: &quot;Helvetica Neue&quot;, Helvetica, Helvetica, Arial, sans-serif; font-size: medium;\" />\n<span style=\"font-family: &quot;Helvetica Neue&quot;, Helvetica, Helvetica, Arial, sans-serif; font-size: medium;\">TP.Đ&agrave; Nẵng, Việt Nam 20000</span></p>', 'info@gmail.com', '48EA461F9C9B6DACDD6F4FA6D8B7CD', '127FC81BE4486525D7290B27E31B6D');

-- ----------------------------
-- Table structure for generic_pharma
-- ----------------------------
DROP TABLE IF EXISTS `generic_pharma`;
CREATE TABLE `generic_pharma` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `name_generic_pharma` varchar(1024) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of generic_pharma
-- ----------------------------
INSERT INTO `generic_pharma` VALUES ('1', 'vỉ');
INSERT INTO `generic_pharma` VALUES ('2', 'lọ');
INSERT INTO `generic_pharma` VALUES ('3', 'hộp');

-- ----------------------------
-- Table structure for notification
-- ----------------------------
DROP TABLE IF EXISTS `notification`;
CREATE TABLE `notification` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `title` varchar(1024) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `staff` bigint(255) NOT NULL,
  `authorities` int(255) DEFAULT NULL,
  `links` varchar(1024) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `times` datetime NOT NULL,
  `status` int(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_notifacations_staff` (`staff`) USING BTREE,
  CONSTRAINT `notification_ibfk_1` FOREIGN KEY (`staff`) REFERENCES `staff` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of notification
-- ----------------------------
INSERT INTO `notification` VALUES ('2', 'Sale has Reject: 1111111111111111111', '14', '4', '1111111111111111111', '2018-01-24 00:00:00', '2');

-- ----------------------------
-- Table structure for orders
-- ----------------------------
DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `code_products` int(255) NOT NULL,
  `code_orders` varchar(1024) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `type_post` int(255) NOT NULL,
  `type_orders` int(255) DEFAULT NULL,
  `code_staff` varchar(1024) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `code_customner` varchar(1024) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `quantily` varchar(1024) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `price` varchar(1024) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `manuals` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `note` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `total_price` int(244) NOT NULL,
  `discounts` int(255) DEFAULT NULL,
  `date_order` datetime DEFAULT NULL,
  `date_confim` datetime DEFAULT NULL,
  `date_send` datetime DEFAULT NULL,
  `email` varchar(1024) DEFAULT NULL,
  `full_name` varchar(1024) DEFAULT NULL,
  `dia_chi` varchar(1024) DEFAULT NULL,
  `dien_thoai` varchar(1024) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_status_oders` (`type_orders`) USING BTREE,
  KEY `fk_type_post` (`type_post`) USING BTREE,
  KEY `fk_products` (`code_products`) USING BTREE,
  CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`code_products`) REFERENCES `products` (`id`),
  CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`type_orders`) REFERENCES `type_oders` (`id`),
  CONSTRAINT `orders_ibfk_3` FOREIGN KEY (`type_post`) REFERENCES `type_post` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of orders
-- ----------------------------
INSERT INTO `orders` VALUES ('1', '2', '1111111111111111111', '1', '6', '14', 'KHPQA03', '0', '60000', '<p>Nội dung Hướng dẫn sử dụng</p>\r\n', '<p>Ghi ch&uacute;</p>\r\n', '0', '1', '2018-01-24 06:58:26', '2018-01-26 02:06:29', '2018-01-26 02:06:29', 'hoainam@gmail.com', 'Trần Hoài Nam', 'Hồng La - Lào cai', '0932337122');
INSERT INTO `orders` VALUES ('2', '1', '1111111111111111111', '1', '6', '14', 'KHPQA03', '0', '1200000', '<p>Nội dung Hướng dẫn sử dụng</p>\r\n', '<p>Ghi ch&uacute;</p>\r\n', '0', '1', '2018-01-24 06:58:27', '2018-01-26 02:06:29', '2018-01-26 02:06:29', 'hoainam@gmail.com', 'Trần Hoài Nam', 'Hồng La - Lào cai', '0932337122');

-- ----------------------------
-- Table structure for products
-- ----------------------------
DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `code_products` varchar(1024) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `name_products` varchar(1024) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `label_products` varchar(1024) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `quantily` int(255) NOT NULL,
  `images` varchar(1024) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `price` int(255) NOT NULL,
  `manuals` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `note` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `types` int(11) NOT NULL,
  `generic` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_types` (`types`) USING BTREE,
  CONSTRAINT `products_ibfk_1` FOREIGN KEY (`types`) REFERENCES `types_pharma` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of products
-- ----------------------------
INSERT INTO `products` VALUES ('1', 'CN001', 'CHỨC NĂNG GAN BẢO NGUYÊN', 'CN001', '0', 'v7utj90m5dcokskoss.png', '1200000', '<h4 class=\"pro_title\" style=\"box-sizing: border-box; font-family: Roboto, sans-serif; font-weight: bold; line-height: 27px; color: rgb(255, 255, 255); margin-top: 10px; margin-bottom: 10px; font-size: 18px; background: rgb(0, 164, 185); height: 27px; position: relative; display: inline-block; clear: left; text-align: justify;\">Th&agrave;nh phần</h4>\n\n<p style=\"box-sizing: border-box; margin: 0px 0px 10px; font-family: Roboto, sans-serif; font-size: 14px; text-align: justify;\"><span style=\"box-sizing: border-box; font-weight: 700;\">1. Th&agrave;nh phần cho 1 vi&ecirc;n :</span></p>\n\n<p style=\"box-sizing: border-box; margin: 0px 0px 10px; font-family: Roboto, sans-serif; font-size: 14px; text-align: justify;\">&bull; Cardus marianus:...........120mg</p>\n\n<p style=\"box-sizing: border-box; margin: 0px 0px 10px; font-family: Roboto, sans-serif; font-size: 14px; text-align: justify;\">&bull; Cao actiso:.......................100mg</p>\n\n<p style=\"box-sizing: border-box; margin: 0px 0px 10px; font-family: Roboto, sans-serif; font-size: 14px; text-align: justify;\">&bull; Cao Bồ c&ocirc;ng anh:............80mg</p>\n\n<p style=\"box-sizing: border-box; margin: 0px 0px 10px; font-family: Roboto, sans-serif; font-size: 14px; text-align: justify;\">&bull; Cao Bồ bồ:......................60mg</p>\n\n<p style=\"box-sizing: border-box; margin: 0px 0px 10px; font-family: Roboto, sans-serif; font-size: 14px; text-align: justify;\">&bull; Tinh chất C&aacute;t căn:............50mg</p>\n\n<p style=\"box-sizing: border-box; margin: 0px 0px 10px; font-family: Roboto, sans-serif; font-size: 14px; text-align: justify;\">&bull; B&igrave;m b&igrave;m:............................20 mg</p>\n\n<p style=\"box-sizing: border-box; margin: 0px 0px 10px; font-family: Roboto, sans-serif; font-size: 14px; text-align: justify;\"><span style=\"box-sizing: border-box; font-weight: 700;\">2.&nbsp;T&aacute; dược vừa đủ &mdash; 1 vi&ecirc;n.</span></p>\n\n<h4 class=\"pro_title\" style=\"box-sizing: border-box; font-family: Roboto, sans-serif; font-weight: bold; line-height: 27px; color: rgb(255, 255, 255); margin-top: 10px; margin-bottom: 10px; font-size: 18px; background: rgb(0, 164, 185); height: 27px; position: relative; display: inline-block; clear: left; text-align: justify;\">C&ocirc;ng dụng</h4>\n\n<p style=\"box-sizing: border-box; margin: 0px 0px 10px; font-family: Roboto, sans-serif; font-size: 14px; text-align: justify;\">- Gi&uacute;p bổ gan, bảo vệ gan, hạ men gan, tăng cường chức năng chuyển h&oacute;a ở gan.</p>\n\n<p style=\"box-sizing: border-box; margin: 0px 0px 10px; font-family: Roboto, sans-serif; font-size: 14px; text-align: justify;\">- Gi&uacute;p bảo vệ v&agrave; phục hồi tế b&agrave;o gan.</p>\n\n<p style=\"box-sizing: border-box; margin: 0px 0px 10px; font-family: Roboto, sans-serif; font-size: 14px; text-align: justify;\">- Gi&uacute;p giảm dấu hiệu đau tức hạ sườn phải, mệt mỏi, v&agrave;ng da, n&oacute;ng trong người, kh&ocirc; miệng, đắng miệng, ăn kh&ocirc;ng ngon ở bệnh nh&acirc;n vi&ecirc;m gan.</p>\n\n<p style=\"box-sizing: border-box; margin: 0px 0px 10px; font-family: Roboto, sans-serif; font-size: 14px; text-align: justify;\">- Gi&uacute;p giải độc gan do d&ugrave;ng nhiều bia rượu v&agrave; sử dụng thuốc chuyển h&oacute;a qua gan như: kh&aacute;ng sinh, thuốc lao&hellip;</p>\n\n<p style=\"box-sizing: border-box; margin: 0px 0px 10px; font-family: Roboto, sans-serif; font-size: 14px; text-align: justify;\">- Tăng cường chuyển ho&aacute; gi&uacute;p nhuận gan, lợi mật, ăn uống ngon miệng. Hỗ trợ điều trị gan yếu, rối loạn chức năng gan do vi&ecirc;m gan cấp v&agrave; m&atilde;n t&iacute;nh (vi&ecirc;m gan B), xơ gan, gan nhiễm mỡ dẫn đến dị ứng, mẩn ngứa, mề đay, v&agrave;ng da, xơ vữa động mạch, mỡ trong m&aacute;u cao.</p>\n\n<h4 class=\"pro_title\" style=\"box-sizing: border-box; font-family: Roboto, sans-serif; font-weight: bold; line-height: 27px; color: rgb(255, 255, 255); margin-top: 10px; margin-bottom: 10px; font-size: 18px; background: rgb(0, 164, 185); height: 27px; position: relative; display: inline-block; clear: left; text-align: justify;\">Đối tượng sử dụng</h4>\n\n<p style=\"box-sizing: border-box; margin: 0px 0px 10px; font-family: Roboto, sans-serif; font-size: 14px; text-align: justify;\">- Người men gan cao, chức năng gan suy giảm hoặc rối loạn chức năng gan.</p>\n\n<p style=\"box-sizing: border-box; margin: 0px 0px 10px; font-family: Roboto, sans-serif; font-size: 14px; text-align: justify;\">- Người thường xuy&ecirc;n ăn nhậu v&agrave; d&ugrave;ng nhiều bia rượu, n&oacute;ng trong người.</p>\n\n<p style=\"box-sizing: border-box; margin: 0px 0px 10px; font-family: Roboto, sans-serif; font-size: 14px; text-align: justify;\">- Người d&ugrave;ng thuốc chuyển h&oacute;a qua gan như: kh&aacute;ng sinh, sulfamid, thuốc chống nấm, thuốc lao, thuốc ung thư, xạ trị&hellip;</p>\n\n<p style=\"box-sizing: border-box; margin: 0px 0px 10px; font-family: Roboto, sans-serif; font-size: 14px; text-align: justify;\">- Người chức năng chuyển ho&aacute; k&eacute;m, mệt mỏi, ch&aacute;n ăn, ăn uống kh&ocirc;ng ti&ecirc;u, b&iacute; đại tiểu tiện, t&aacute;o b&oacute;n, rối loạn ti&ecirc;u h&oacute;a.</p>\n\n<p style=\"box-sizing: border-box; margin: 0px 0px 10px; font-family: Roboto, sans-serif; font-size: 14px; text-align: justify;\">- Người gan yếu, xơ gan, vi&ecirc;m gan cấp v&agrave; m&atilde;n t&iacute;nh (vi&ecirc;m gan B), gan nhiễm mỡ, mụn nhọt, dị ứng, mẩn ngứa, mề đay, v&agrave;ng da, xơ vữa động mạch, mỡ trong m&aacute;u cao.</p>\n\n<h4 class=\"pro_title\" style=\"box-sizing: border-box; font-family: Roboto, sans-serif; font-weight: bold; line-height: 27px; color: rgb(255, 255, 255); margin-top: 10px; margin-bottom: 10px; font-size: 18px; background: rgb(0, 164, 185); height: 27px; position: relative; display: inline-block; clear: left; text-align: justify;\">C&aacute;ch d&ugrave;ng</h4>\n\n<p style=\"box-sizing: border-box; margin: 0px 0px 10px; font-family: Roboto, sans-serif; font-size: 14px; text-align: justify;\">- Uống sau khi ăn , uống với nước s&ocirc;i để nguội.</p>\n\n<p style=\"box-sizing: border-box; margin: 0px 0px 10px; font-family: Roboto, sans-serif; font-size: 14px; text-align: justify;\">- Tuần đầu ti&ecirc;n d&ugrave;ng ng&agrave;y 3 lần, mỗi lần 2 vi&ecirc;n. C&aacute;c tuần tiếp theo ng&agrave;y d&ugrave;ng 2 lần, mỗi lần 2 vi&ecirc;n. D&ugrave;ng tối thiểu trong v&ograve;ng 3 th&aacute;ng.</p>', '', '2', '3');
INSERT INTO `products` VALUES ('2', 'CN002', 'ĐẠI TRÀNG BẢO NGUYÊN', 'CN0002 ĐẠI TRÀNG BẢO NGUYÊN', '0', 'f4k99iu19qg4gwsssg.png', '60000', '<h4 class=\"pro_title\" style=\"box-sizing: border-box; font-family: Roboto, sans-serif; font-weight: bold; line-height: 27px; color: rgb(255, 255, 255); margin-top: 10px; margin-bottom: 10px; font-size: 18px; background: rgb(0, 164, 185); height: 27px; position: relative; display: inline-block; clear: left; text-align: justify;\">Th&agrave;nh phần</h4>\n\n<p style=\"box-sizing: border-box; margin: 0px 0px 10px; font-family: Roboto, sans-serif; font-size: 14px; text-align: justify;\">► Trong mỗi vi&ecirc;n nang c&oacute; chứa:<br style=\"box-sizing: border-box;\" />\n&bull; Kha tử ........................&nbsp;200 mg<br style=\"box-sizing: border-box;\" />\n&bull; Mộc hương .................&nbsp;100 mg<br style=\"box-sizing: border-box;\" />\n&bull; Ho&agrave;ng li&ecirc;n ...................&nbsp;50 mg<br style=\"box-sizing: border-box;\" />\n&bull; Cam thảo ......................&nbsp;25 mg<br style=\"box-sizing: border-box;\" />\n&bull; Bạch truật .....................&nbsp;10 mg<br style=\"box-sizing: border-box;\" />\n&bull; Cao mộc hoa trắng ....&nbsp;100 mg<br style=\"box-sizing: border-box;\" />\n► T&aacute; dược vừa đủ 1 vi&ecirc;n.</p>\n\n<h4 class=\"pro_title\" style=\"box-sizing: border-box; font-family: Roboto, sans-serif; font-weight: bold; line-height: 27px; color: rgb(255, 255, 255); margin-top: 10px; margin-bottom: 10px; font-size: 18px; background: rgb(0, 164, 185); height: 27px; position: relative; display: inline-block; clear: left; text-align: justify;\">C&ocirc;ng dụng</h4>\n\n<p style=\"box-sizing: border-box; margin: 0px 0px 10px; font-family: Roboto, sans-serif; font-size: 14px; text-align: justify;\"><span style=\"box-sizing: border-box; font-weight: 700;\">Hỗ trợ điều trị:</span></p>\n\n<p style=\"box-sizing: border-box; margin: 0px 0px 10px; font-family: Roboto, sans-serif; font-size: 14px; text-align: justify;\"><em style=\"box-sizing: border-box;\">- Vi&ecirc;m đại tr&agrave;ng cấp v&agrave; m&atilde;n t&iacute;nh</em></p>\n\n<p style=\"box-sizing: border-box; margin: 0px 0px 10px; font-family: Roboto, sans-serif; font-size: 14px; text-align: justify;\"><em style=\"box-sizing: border-box;\">- Vi&ecirc;m đại tr&agrave;ng co thắt</em></p>\n\n<p style=\"box-sizing: border-box; margin: 0px 0px 10px; font-family: Roboto, sans-serif; font-size: 14px; text-align: justify;\"><em style=\"box-sizing: border-box;\">- Đau bụng, đầy hơi, ăn uống kh&oacute; ti&ecirc;u, đi ngo&agrave;i ph&acirc;n sống, ỉa chảy, kiết lỵ, rối loạn chức năng đại tr&agrave;ng.</em></p>\n\n<h4 class=\"pro_title\" style=\"box-sizing: border-box; font-family: Roboto, sans-serif; font-weight: bold; line-height: 27px; color: rgb(255, 255, 255); margin-top: 10px; margin-bottom: 10px; font-size: 18px; background: rgb(0, 164, 185); height: 27px; position: relative; display: inline-block; clear: left; text-align: justify;\">Đối tượng sử dụng</h4>\n\n<p style=\"box-sizing: border-box; margin: 0px 0px 10px; font-family: Roboto, sans-serif; font-size: 14px; text-align: justify;\"><span style=\"box-sizing: border-box; font-weight: 700;\">Đại tr&agrave;ng Bảo Nguy&ecirc;n</span>&nbsp;d&ugrave;ng cho những người bị:</p>\n\n<ul style=\"box-sizing: border-box; margin: 0px; padding-right: 0px; padding-left: 0px; font-family: Roboto, sans-serif; font-size: 14px; text-align: justify;\">\n	<li style=\"box-sizing: border-box; list-style: none;\">Vi&ecirc;m đại tr&agrave;ng cấp v&agrave; m&atilde;n t&iacute;nh,</li>\n	<li style=\"box-sizing: border-box; list-style: none;\">Vi&ecirc;m đại tr&agrave;ng co thắt do cả a-mip g&acirc;y ra với c&aacute;c triệu chứng đau quặn bụng , đầy bụng, m&oacute;t rặn, sống ph&acirc;n, kiết lỵ.</li>\n	<li style=\"box-sizing: border-box; list-style: none;\">Người đau bụng đầy hơi, ăn uống kh&oacute; ti&ecirc;u, đi ngo&agrave;i ph&acirc;n sống, ỉa chảy, kiết lỵ, rối loạn chức năng đại tr&agrave;ng.</li>\n</ul>\n\n<h4 class=\"pro_title\" style=\"box-sizing: border-box; font-family: Roboto, sans-serif; font-weight: bold; line-height: 27px; color: rgb(255, 255, 255); margin-top: 10px; margin-bottom: 10px; font-size: 18px; background: rgb(0, 164, 185); height: 27px; position: relative; display: inline-block; clear: left; text-align: justify;\">C&aacute;ch d&ugrave;ng</h4>\n\n<p style=\"box-sizing: border-box; margin: 0px 0px 10px; font-family: Roboto, sans-serif; font-size: 14px; text-align: justify;\">Người lớn 2-3 vi&ecirc;n/ ng&agrave;y x 2 lần/ng&agrave;y<br style=\"box-sizing: border-box;\" />\nTrẻ em tr&ecirc;n 8 tuổi : 1 vi&ecirc;n/lần x 2lần/ng&agrave;y<br style=\"box-sizing: border-box;\" />\nHỗ trợ vi&ecirc;m đại tr&agrave;ng cấp v&agrave; m&atilde;n t&iacute;nh d&ugrave;ng li&ecirc;n tục mỗi đợt từ 10-20 ng&agrave;y</p>\n\n<p style=\"box-sizing: border-box; margin: 0px 0px 10px; font-family: Roboto, sans-serif; font-size: 14px; text-align: justify;\"><em style=\"box-sizing: border-box;\"><span style=\"box-sizing: border-box; font-weight: 700;\">Ch&uacute; &yacute;</span>:&nbsp;Kh&ocirc;ng d&ugrave;ng cho phụ nữ c&oacute; thai</em></p>\n\n<h4 class=\"pro_title\" style=\"box-sizing: border-box; font-family: Roboto, sans-serif; font-weight: bold; line-height: 27px; color: rgb(255, 255, 255); margin-top: 10px; margin-bottom: 10px; font-size: 18px; background: rgb(0, 164, 185); height: 27px; position: relative; display: inline-block; clear: left; text-align: justify;\">Ưu điểm</h4>\n\n<p style=\"box-sizing: border-box; margin: 0px 0px 10px; font-family: Roboto, sans-serif; font-size: 14px; text-align: justify;\"><span style=\"box-sizing: border-box; font-weight: 700;\">Kha tử:</span>&nbsp;C&oacute; chứa 20-40% ta-nin, d&ugrave;ng chữa ỉa lỏng l&acirc;u ng&agrave;y, lỵ kinh ni&ecirc;n, l&ograve;i dom.</p>\n\n<p style=\"box-sizing: border-box; margin: 0px 0px 10px; font-family: Roboto, sans-serif; font-size: 14px; text-align: justify;\"><span style=\"box-sizing: border-box; font-weight: 700;\">Mộc hương:</span>&nbsp;C&oacute; chứa tinh dầu, chất nhựa, inulin&hellip;c&oacute; t&aacute;c dụng kiện tỳ h&ograve;a vị , điều kh&iacute; chỉ thống, chữa ngực bụng đầy chướng, đau,tả lỵ,n&ocirc;n mửa, lỵ cấp hậu trọng.</p>\n\n<p style=\"box-sizing: border-box; margin: 0px 0px 10px; font-family: Roboto, sans-serif; font-size: 14px; text-align: justify;\"><span style=\"box-sizing: border-box; font-weight: 700;\">Ho&agrave;ng li&ecirc;n:</span>&nbsp;Chứa 3-4% berberin d&ugrave;ng chữa đi lỵ, ăn uống kh&ocirc;ng ti&ecirc;u.</p>\n\n<p style=\"box-sizing: border-box; margin: 0px 0px 10px; font-family: Roboto, sans-serif; font-size: 14px; text-align: justify;\"><span style=\"box-sizing: border-box; font-weight: 700;\">Cam thảo:</span>&nbsp;C&oacute; t&aacute;c dụng bổ tỳ vị giải độc điều h&ograve;a c&aacute;c vị thuốc.</p>\n\n<p style=\"box-sizing: border-box; margin: 0px 0px 10px; font-family: Roboto, sans-serif; font-size: 14px; text-align: justify;\"><span style=\"box-sizing: border-box; font-weight: 700;\">Bạch truật:</span>&nbsp;C&oacute; chứa tinh dầu, c&oacute; t&aacute;c dụng bổ tỳ h&ograve;a vị h&oacute;a thấp chỉ tả (cầm đi ngo&agrave;i) chữa vi&ecirc;m ruột m&atilde;n t&iacute;nh.</p>\n\n<p style=\"box-sizing: border-box; margin: 0px 0px 10px; font-family: Roboto, sans-serif; font-size: 14px; text-align: justify;\"><span style=\"box-sizing: border-box; font-weight: 700;\">Mộc hoa trắng:</span>&nbsp;C&oacute; chứa Alcaloid d&ugrave;ng chữa lỵ a-mip</p>', '', '2', '1');
INSERT INTO `products` VALUES ('3', 'CN003', 'Prenatal - Bổ sung vitamin cho bà bầu', 'Prenatal 002', '88', '2smt6we0olq804408k.jpg', '800000', '<div style=\"margin: 0px; padding: 0px; box-sizing: border-box; color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif;\">\n<h2 class=\"textdetailhead\" id=\"thanh-phan\" style=\"margin: 5px; padding: 0px; box-sizing: border-box; font-weight: bold; font-size: 11.8pt; font-family: Roboto, &quot;Times New Roman&quot;; color: maroon; width: 210px; text-align: justify;\" thanh-phan=\"\">Th&agrave;nh phần:</h2>\n\n<div style=\"margin: 0px; padding: 0px 0px 0px 60px; box-sizing: border-box;\"><span class=\"textdetaildrgI\" style=\"margin: 5px 1px; padding: 0px; box-sizing: border-box; font-family: Roboto, &quot;Times New Roman&quot;, Arial; font-size: 12px;\">Vitamin A 300mcg/vi&ecirc;n (1014 IU),&nbsp;<br style=\"margin: 0px; padding: 0px; box-sizing: border-box;\" />\nBeta Caroten 1500mcg/vi&ecirc;n (2500 IU)&nbsp;<br style=\"margin: 0px; padding: 0px; box-sizing: border-box;\" />\nVitamin E (d-alpha tocopheryl acetate) 13,5mg (30 IU)&nbsp;<br style=\"margin: 0px; padding: 0px; box-sizing: border-box;\" />\nVitamin D3(Chlecalciferol) 10 mcg (400 IU)&nbsp;<br style=\"margin: 0px; padding: 0px; box-sizing: border-box;\" />\nVitamin C (acid ascorbic) 85 mg&nbsp;<br style=\"margin: 0px; padding: 0px; box-sizing: border-box;\" />\nFolic acid 1mg, Vitamin B1 (Thiamine nitrate) 1,4mg&nbsp;<br style=\"margin: 0px; padding: 0px; box-sizing: border-box;\" />\nVitamin B2 (Riboflavin) 1,4 mg&nbsp;<br style=\"margin: 0px; padding: 0px; box-sizing: border-box;\" />\nVitamin B3 (Niacinamide) 18 mg&nbsp;<br style=\"margin: 0px; padding: 0px; box-sizing: border-box;\" />\nViatmin B6 (Pyridoxine Hydrochloride) 1,9 mg&nbsp;<br style=\"margin: 0px; padding: 0px; box-sizing: border-box;\" />\nVitamin B12 (Cyanocobalamin) 2,6mcg&nbsp;<br style=\"margin: 0px; padding: 0px; box-sizing: border-box;\" />\nBiotin 30mcg&nbsp;<br style=\"margin: 0px; padding: 0px; box-sizing: border-box;\" />\nVitamin B5 (Calcium Pantothenate) 6mg&nbsp;<br style=\"margin: 0px; padding: 0px; box-sizing: border-box;\" />\nCalcium (carbonat) 250mg&nbsp;<br style=\"margin: 0px; padding: 0px; box-sizing: border-box;\" />\nMagnesium (oxide) 50mg&nbsp;<br style=\"margin: 0px; padding: 0px; box-sizing: border-box;\" />\nIon (Ferrous Fumarate) 27mg&nbsp;<br style=\"margin: 0px; padding: 0px; box-sizing: border-box;\" />\nZinc (oxide) 7,5mg&nbsp;<br style=\"margin: 0px; padding: 0px; box-sizing: border-box;\" />\nMangane sulfate 2mg&nbsp;<br style=\"margin: 0px; padding: 0px; box-sizing: border-box;\" />\nCopper (sulfate) 1mg&nbsp;<br style=\"margin: 0px; padding: 0px; box-sizing: border-box;\" />\nIodine (Kali iodine) 220 mcg&nbsp;<br style=\"margin: 0px; padding: 0px; box-sizing: border-box;\" />\nChromium chloride 30mcg&nbsp;<br style=\"margin: 0px; padding: 0px; box-sizing: border-box;\" />\nMolybdenum (Natri molybdate) 50mcg&nbsp;<br style=\"margin: 0px; padding: 0px; box-sizing: border-box;\" />\nSelenium (** chelate) 30 mcg</span></div>\n</div>\n\n<div class=\"tbldrg_dt2\" style=\"margin: 0px; padding: 0px; box-sizing: border-box; color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif;\">\n<div style=\"margin: 0px; padding: 0px; box-sizing: border-box;\">\n<h2 class=\"textdetailhead\" id=\"chi-dinh\" style=\"margin: 5px; padding: 0px; box-sizing: border-box; font-weight: bold; font-size: 11.8pt; font-family: Roboto, &quot;Times New Roman&quot;; color: maroon; width: 210px; text-align: justify;\">C&ocirc;ng dụng</h2>\n\n<div style=\"margin: 0px; padding: 0px; box-sizing: border-box; float: right;\"><img border=\"0\" id=\"Indicationbb\" src=\"https://www.thuocbietduoc.com.vn/interface/BtMinus.gif\" style=\"margin: 0px; padding: 0px; box-sizing: border-box; border: 0px; vertical-align: middle;\" /></div>\n</div>\n\n<div class=\"textdetaildrg1\" id=\"IndicationbbPlus\" style=\"margin: 2px 2px 2px 5px; padding: 0px; box-sizing: border-box; font-family: Roboto, &quot;Times New Roman&quot;; font-size: 12pt; text-align: justify; line-height: 20px;\">- Prenatal với sự phối hợp của 23 vitamin, kho&aacute;ng chất v&agrave; c&aacute;c nguy&ecirc;n tố vi lượng cần thiết gi&uacute;p:<br style=\"margin: 0px; padding: 0px; box-sizing: border-box;\" />\n- Bổ sung vitamin, kho&aacute;ng chất thiết yếu, bồi bổ sức khoẻ v&agrave; c&acirc;n bằng dinh dưỡng cho c&aacute;c b&agrave; mẹ giai đoạn trước, trong khi mang thai v&agrave; sau sinh, gi&uacute;p mẹ v&agrave; b&eacute; khỏe mạnh.<br style=\"margin: 0px; padding: 0px; box-sizing: border-box;\" />\n- Giảm khả năng mắc c&aacute;c bệnh chậm ph&aacute;t triển tr&iacute; n&atilde;o v&agrave; c&aacute;c dị tật bẩm sinh cho thai nhi.<br style=\"margin: 0px; padding: 0px; box-sizing: border-box;\" />\n<br style=\"margin: 0px; padding: 0px; box-sizing: border-box;\" />\nĐối tượng sử dụng: D&ugrave;ng cho người chuẩn bị mang thai, đang mang thai v&agrave; sau khi sinh.<br style=\"margin: 0px; padding: 0px; box-sizing: border-box;\" />\n<br style=\"margin: 0px; padding: 0px; box-sizing: border-box;\" />\nVitamin b&agrave; bầu, bổ sung vitamin v&agrave; kho&aacute;ng chất cần thiết cho phụ nữ mang thai</div>\n\n<div style=\"margin: 0px; padding: 0px; box-sizing: border-box;\">\n<h3 class=\"textdetailhead\" id=\"cach-dung\" style=\"margin: 5px; padding: 0px; box-sizing: border-box; font-size: 11.8pt; font-weight: bold; font-family: Roboto, &quot;Times New Roman&quot;; color: maroon; width: 210px; text-align: justify;\">Liều lượng - C&aacute;ch d&ugrave;ng</h3>\n\n<div style=\"margin: 0px; padding: 0px; box-sizing: border-box; float: right;\"><img border=\"0\" id=\"Dossuuu\" src=\"https://www.thuocbietduoc.com.vn/interface/BtMinus.gif\" style=\"margin: 0px; padding: 0px; box-sizing: border-box; border: 0px; vertical-align: middle;\" /></div>\n</div>\n\n<div class=\"textdetaildrg1\" id=\"DossuuuPlus\" style=\"margin: 2px 2px 2px 5px; padding: 0px; box-sizing: border-box; font-family: Roboto, &quot;Times New Roman&quot;; font-size: 12pt; text-align: justify; line-height: 20px;\">C&aacute;ch d&ugrave;ng: Người lớn uống 1vi&ecirc;n /ng&agrave;y sau khi ăn.<br style=\"margin: 0px; padding: 0px; box-sizing: border-box;\" />\n<br style=\"margin: 0px; padding: 0px; box-sizing: border-box;\" />\nCh&uacute; &yacute;:<br style=\"margin: 0px; padding: 0px; box-sizing: border-box;\" />\n<br style=\"margin: 0px; padding: 0px; box-sizing: border-box;\" />\nSản phẩm n&agrave;y kh&ocirc;ng phải l&agrave; thuốc, kh&ocirc;ng c&oacute; t&aacute;c dụng thay thế thuốc chữa bệnh.<br style=\"margin: 0px; padding: 0px; box-sizing: border-box;\" />\n<br style=\"margin: 0px; padding: 0px; box-sizing: border-box;\" />\nChỉ d&ugrave;ng cho người lớn. Lượng sắt trong lọ c&oacute; thể g&acirc;y ảnh hưởng nghi&ecirc;m trọng đến sức khỏe của trẻ.&nbsp;<br style=\"margin: 0px; padding: 0px; box-sizing: border-box;\" />\n&nbsp;</div>\n\n<div style=\"margin: 0px; padding: 0px; box-sizing: border-box;\">\n<h3 class=\"textdetailhead\" id=\"bao-quan\" style=\"margin: 5px; padding: 0px; box-sizing: border-box; font-size: 11.8pt; font-weight: bold; font-family: Roboto, &quot;Times New Roman&quot;; color: maroon; width: 210px; text-align: justify;\">Bảo quản:</h3>\n\n<div style=\"margin: 0px; padding: 0px; box-sizing: border-box; float: right;\"><img border=\"0\" id=\"Dossuuu11\" src=\"https://www.thuocbietduoc.com.vn/interface/BtMinus.gif\" style=\"margin: 0px; padding: 0px; box-sizing: border-box; border: 0px; vertical-align: middle;\" /></div>\n</div>\n\n<div class=\"textdetaildrg1\" id=\"Dossuuu11Plus\" style=\"margin: 2px 2px 2px 5px; padding: 0px; box-sizing: border-box; font-family: Roboto, &quot;Times New Roman&quot;; font-size: 12pt; text-align: justify; line-height: 20px;\">Bảo quản nơi kh&ocirc; r&aacute;o, tho&aacute;ng m&aacute;t, nhiệt độ dưới 30&deg;C. Để xa tầm tay trẻ em</div>\n</div>', '', '2', '2');
INSERT INTO `products` VALUES ('4', 'VNA-1758-04', 'HepaThin  Viên nang', 'HepaThin 250mg', '0', 'oa7gpzghzmogwoww4c.jpg', '53000', '<div style=\"margin: 0px; padding: 0px; box-sizing: border-box; color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif;\">\n<h2 class=\"textdetailhead\" id=\"thanh-phan\" style=\"margin: 5px; padding: 0px; box-sizing: border-box; font-weight: bold; font-size: 11.8pt; font-family: Roboto, &quot;Times New Roman&quot;; color: maroon; width: 210px; text-align: justify;\" thanh-phan=\"\">Th&agrave;nh phần:</h2>\n\n<div style=\"margin: 0px; padding: 0px 0px 0px 60px; box-sizing: border-box;\"><span class=\"textdetaildrgI\" style=\"margin: 5px 1px; padding: 0px; box-sizing: border-box; font-family: Roboto, &quot;Times New Roman&quot;, Arial; font-size: 12px;\"><a class=\"texttplink\" href=\"https://www.thuocbietduoc.com.vn/thuoc-goc-668/methionine.aspx\" style=\"margin: 0px; padding: 0px; box-sizing: border-box; outline: none; font-size: 12pt; font-family: Roboto, Tahoma, Arial; color: rgb(51, 102, 153); font-weight: bold; text-align: justify;\" title=\"Thuốc gốc Methionine\">Methionine</a></span></div>\n</div>\n\n<div class=\"textdetailhead\" style=\"margin: 5px; padding: 0px; box-sizing: border-box; font-family: Roboto, &quot;Times New Roman&quot;; color: maroon; font-size: 11.8pt; font-weight: bold; width: 210px; text-align: justify;\">H&agrave;m lượng:</div>\n\n<div class=\"textdetaildrgI\" style=\"margin: 5px 1px; padding: 0px 0px 0px 60px; box-sizing: border-box; font-family: Roboto, &quot;Times New Roman&quot;, Arial; font-size: 12px; color: rgb(0, 0, 0);\">250mg</div>\n\n<div class=\"tbldrg_dt2\" style=\"margin: 0px; padding: 0px; box-sizing: border-box; color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif;\">\n<div style=\"margin: 0px; padding: 0px; box-sizing: border-box;\">\n<h2 class=\"textdetailhead\" id=\"chi-dinh\" style=\"margin: 5px; padding: 0px; box-sizing: border-box; font-weight: bold; font-size: 11.8pt; font-family: Roboto, &quot;Times New Roman&quot;; color: maroon; width: 210px; text-align: justify;\">Chỉ định:</h2>\n\n<div style=\"margin: 0px; padding: 0px; box-sizing: border-box; float: right;\"><img border=\"0\" id=\"Indicationbb\" src=\"https://www.thuocbietduoc.com.vn/interface/BtMinus.gif\" style=\"margin: 0px; padding: 0px; box-sizing: border-box; border: 0px; vertical-align: middle;\" /></div>\n</div>\n\n<div class=\"textdetaildrg1\" id=\"IndicationbbPlus\" style=\"margin: 2px 2px 2px 5px; padding: 0px; box-sizing: border-box; font-family: Roboto, &quot;Times New Roman&quot;; font-size: 12pt; text-align: justify; line-height: 20px;\">Chủ yếu d&ugrave;ng điều trị qu&aacute; liều Paracetamol khi kh&ocirc;ng c&oacute; acetylcystein. Ngo&agrave;i ra c&ograve;n d&ugrave;ng để toan h&oacute;a nước tiểu, vi&ecirc;m gan do nhiễm độc, nhiễm độc thai ngh&eacute;n, c&aacute;c chứng thiếu m&aacute;u, c&aacute;c chứng ban, vi&ecirc;m gan do virus, xơ gan, trị c&aacute;c chứng v&agrave;ng da.</div>\n\n<div style=\"margin: 0px; padding: 0px; box-sizing: border-box;\">\n<h3 class=\"textdetailhead\" id=\"chong-chi-dinh\" style=\"margin: 5px; padding: 0px; box-sizing: border-box; font-size: 11.8pt; font-weight: bold; font-family: Roboto, &quot;Times New Roman&quot;; color: maroon; width: 210px; text-align: justify;\">Chống chỉ định:</h3>\n\n<div style=\"margin: 0px; padding: 0px; box-sizing: border-box; float: right;\"><img border=\"0\" id=\"AntiComcc\" src=\"https://www.thuocbietduoc.com.vn/interface/BtMinus.gif\" style=\"margin: 0px; padding: 0px; box-sizing: border-box; border: 0px; vertical-align: middle;\" /></div>\n</div>\n\n<div class=\"textdetaildrg1\" id=\"AntiComccPlus\" style=\"margin: 2px 2px 2px 5px; padding: 0px; box-sizing: border-box; font-family: Roboto, &quot;Times New Roman&quot;; font-size: 12pt; text-align: justify; line-height: 20px;\">Người bệnh bị nhiễm toan. Tổn thương gan nặng.</div>\n\n<div style=\"margin: 0px; padding: 0px; box-sizing: border-box;\">\n<h3 class=\"textdetailhead\" id=\"tuong-tac-thuoc\" style=\"margin: 5px; padding: 0px; box-sizing: border-box; font-size: 11.8pt; font-weight: bold; font-family: Roboto, &quot;Times New Roman&quot;; color: maroon; width: 210px; text-align: justify;\">Tương t&aacute;c thuốc:</h3>\n\n<div style=\"margin: 0px; padding: 0px; box-sizing: border-box; float: right;\"><img border=\"0\" id=\"Ttdd\" src=\"https://www.thuocbietduoc.com.vn/interface/BtMinus.gif\" style=\"margin: 0px; padding: 0px; box-sizing: border-box; border: 0px; vertical-align: middle;\" /></div>\n</div>\n\n<div class=\"textdetaildrg1\" id=\"TtddPlus\" style=\"margin: 2px 2px 2px 5px; padding: 0px; box-sizing: border-box; font-family: Roboto, &quot;Times New Roman&quot;; font-size: 12pt; text-align: justify; line-height: 20px;\">Methionin c&oacute; thể l&agrave;m giảm t&aacute;c dụng của levodopa.</div>\n\n<div style=\"margin: 0px; padding: 0px; box-sizing: border-box;\">\n<h3 class=\"textdetailhead\" id=\"tac-dung-phu\" style=\"margin: 5px; padding: 0px; box-sizing: border-box; font-size: 11.8pt; font-weight: bold; font-family: Roboto, &quot;Times New Roman&quot;; color: maroon; width: 210px; text-align: justify;\">T&aacute;c dụng phụ:</h3>\n\n<div style=\"margin: 0px; padding: 0px; box-sizing: border-box; float: right;\"><img border=\"0\" id=\"tdnnnn\" src=\"https://www.thuocbietduoc.com.vn/interface/BtMinus.gif\" style=\"margin: 0px; padding: 0px; box-sizing: border-box; border: 0px; vertical-align: middle;\" /></div>\n</div>\n\n<div class=\"textdetaildrg1\" id=\"tdnnnnPlus\" style=\"margin: 2px 2px 2px 5px; padding: 0px; box-sizing: border-box; font-family: Roboto, &quot;Times New Roman&quot;; font-size: 12pt; text-align: justify; line-height: 20px;\">Buồn n&ocirc;n, n&ocirc;n, ngủ g&agrave;, dễ bị k&iacute;ch th&iacute;ch. Nhiễm toan chuyển h&oacute;a v&agrave; tăng nitơ huyết ở người bị suy thận.</div>\n\n<div style=\"margin: 0px; padding: 0px; box-sizing: border-box;\">\n<h3 class=\"textdetailhead\" id=\"de-phong\" style=\"margin: 5px; padding: 0px; box-sizing: border-box; font-size: 11.8pt; font-weight: bold; font-family: Roboto, &quot;Times New Roman&quot;; color: maroon; width: 210px; text-align: justify;\">Ch&uacute; &yacute; đề ph&ograve;ng:</h3>\n\n<div style=\"margin: 0px; padding: 0px; box-sizing: border-box; float: right;\"><img border=\"0\" id=\"dpnnnn\" src=\"https://www.thuocbietduoc.com.vn/interface/BtMinus.gif\" style=\"margin: 0px; padding: 0px; box-sizing: border-box; border: 0px; vertical-align: middle;\" /></div>\n</div>\n\n<div class=\"textdetaildrg1\" id=\"dpnnnnPlus\" style=\"margin: 2px 2px 2px 5px; padding: 0px; box-sizing: border-box; font-family: Roboto, &quot;Times New Roman&quot;; font-size: 12pt; text-align: justify; line-height: 20px;\">Bệnh gan nặng.</div>\n\n<div style=\"margin: 0px; padding: 0px; box-sizing: border-box;\">\n<h3 class=\"textdetailhead\" id=\"cach-dung\" style=\"margin: 5px; padding: 0px; box-sizing: border-box; font-size: 11.8pt; font-weight: bold; font-family: Roboto, &quot;Times New Roman&quot;; color: maroon; width: 210px; text-align: justify;\">Liều lượng - C&aacute;ch d&ugrave;ng</h3>\n\n<div style=\"margin: 0px; padding: 0px; box-sizing: border-box; float: right;\"><img border=\"0\" id=\"Dossuuu\" src=\"https://www.thuocbietduoc.com.vn/interface/BtMinus.gif\" style=\"margin: 0px; padding: 0px; box-sizing: border-box; border: 0px; vertical-align: middle;\" /></div>\n</div>\n\n<div class=\"textdetaildrg1\" id=\"DossuuuPlus\" style=\"margin: 2px 2px 2px 5px; padding: 0px; box-sizing: border-box; font-family: Roboto, &quot;Times New Roman&quot;; font-size: 12pt; text-align: justify; line-height: 20px;\">- Qu&aacute; liều paracetamol liều uống ban đầu 2,5 g, tiếp theo cứ c&aacute;ch 4 giờ lại uống 2,5 g, như vậy 3 lần, t&ugrave;y theo nồng độ paracetamol trong huyết tương. Cần tiến h&agrave;nh điều trị chậm nhất l&agrave; 10 đến 12 giờ sau khi uống paracetamol.&nbsp;<br style=\"margin: 0px; padding: 0px; box-sizing: border-box;\" />\n- C&aacute;c chỉ định kh&aacute;c:&nbsp;<br style=\"margin: 0px; padding: 0px; box-sizing: border-box;\" />\n+ Người lớn: 4-8 vi&ecirc;n/ng&agrave;y.&nbsp;<br style=\"margin: 0px; padding: 0px; box-sizing: border-box;\" />\n+ Trẻ em: 2-4 vi&ecirc;n/ng&agrave;y.</div>\n</div>', '', '1', '2');
INSERT INTO `products` VALUES ('5', 'VNB-0925-03', 'Acyclovir 200mg', 'Acyclovir 200mg Viên nén', '229', 'cm8zphdtbhkogs4c40.jpg', '23000', '<div style=\"margin: 0px; padding: 0px; box-sizing: border-box; color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif;\"><span align=\"left\" class=\"textdetailhead\" style=\"margin: 5px; padding: 0px; box-sizing: border-box; font-family: Roboto, &quot;Times New Roman&quot;; color: maroon; font-size: 11.8pt; font-weight: bold; width: 210px; text-align: justify;\">Nh&oacute;m sản phẩm:</span><span itemprop=\"\" style=\"margin: 0px; padding: 0px; box-sizing: border-box;\">&nbsp;<a class=\"textdetaillink\" href=\"https://www.thuocbietduoc.com.vn/nhom-thuoc-6-5/chong-nhiem-khuan-ks-trung.aspx\" style=\"margin: 5px 1px; padding: 0px; box-sizing: border-box; text-decoration-line: none; outline: none; font-size: 14px; font-family: Roboto, Tahoma, Arial; color: rgb(51, 102, 153); font-weight: bold; text-align: justify;\" title=\"Chống nhiễm khuẩn, KS trùng\">Thuốc trị k&yacute; sinh tr&ugrave;ng, chống nhiễm khuẩn</a></span></div>\n\n<div style=\"margin: 0px; padding: 0px; box-sizing: border-box; color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif;\">\n<h2 class=\"textdetailhead\" id=\"thanh-phan\" style=\"margin: 5px; padding: 0px; box-sizing: border-box; font-weight: bold; font-size: 11.8pt; font-family: Roboto, &quot;Times New Roman&quot;; color: maroon; width: 210px; text-align: justify;\" thanh-phan=\"\">Th&agrave;nh phần:</h2>\n\n<div style=\"margin: 0px; padding: 0px 0px 0px 60px; box-sizing: border-box;\"><span class=\"textdetaildrgI\" style=\"margin: 5px 1px; padding: 0px; box-sizing: border-box; font-family: Roboto, &quot;Times New Roman&quot;, Arial; font-size: 12px;\"><a class=\"texttplink\" href=\"https://www.thuocbietduoc.com.vn/thuoc-goc-11/acyclovir.aspx\" style=\"margin: 0px; padding: 0px; box-sizing: border-box; outline: none; font-size: 12pt; font-family: Roboto, Tahoma, Arial; color: rgb(51, 102, 153); font-weight: bold; text-align: justify;\" title=\"Thuốc gốc Acyclovir\">Acyclovir</a></span></div>\n</div>\n\n<div class=\"textdetailhead\" style=\"margin: 5px; padding: 0px; box-sizing: border-box; font-family: Roboto, &quot;Times New Roman&quot;; color: maroon; font-size: 11.8pt; font-weight: bold; width: 210px; text-align: justify;\">H&agrave;m lượng:</div>\n\n<div class=\"textdetaildrgI\" style=\"margin: 5px 1px; padding: 0px 0px 0px 60px; box-sizing: border-box; font-family: Roboto, &quot;Times New Roman&quot;, Arial; font-size: 12px; color: rgb(0, 0, 0);\">200mg</div>\n\n<div class=\"tbldrg_dt2\" style=\"margin: 0px; padding: 0px; box-sizing: border-box; color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif;\">\n<div style=\"margin: 0px; padding: 0px; box-sizing: border-box;\">\n<h2 class=\"textdetailhead\" id=\"chi-dinh\" style=\"margin: 5px; padding: 0px; box-sizing: border-box; font-weight: bold; font-size: 11.8pt; font-family: Roboto, &quot;Times New Roman&quot;; color: maroon; width: 210px; text-align: justify;\">Chỉ định:</h2>\n\n<div style=\"margin: 0px; padding: 0px; box-sizing: border-box; float: right;\"><img border=\"0\" id=\"Indicationbb\" src=\"https://www.thuocbietduoc.com.vn/interface/BtMinus.gif\" style=\"margin: 0px; padding: 0px; box-sizing: border-box; border: 0px; vertical-align: middle;\" /></div>\n</div>\n\n<div class=\"textdetaildrg1\" id=\"IndicationbbPlus\" style=\"margin: 2px 2px 2px 5px; padding: 0px; box-sizing: border-box; font-family: Roboto, &quot;Times New Roman&quot;; font-size: 12pt; text-align: justify; line-height: 20px;\">Nhiễm Herpes simplex, Ph&ograve;ng ngừa t&aacute;i nhiễm Herpes sinh dục &amp; c&aacute;c dạng nặng, Suy giảm miễn dịch</div>\n\n<div style=\"margin: 0px; padding: 0px; box-sizing: border-box;\">\n<h3 class=\"textdetailhead\" id=\"chong-chi-dinh\" style=\"margin: 5px; padding: 0px; box-sizing: border-box; font-size: 11.8pt; font-weight: bold; font-family: Roboto, &quot;Times New Roman&quot;; color: maroon; width: 210px; text-align: justify;\">Chống chỉ định:</h3>\n\n<div style=\"margin: 0px; padding: 0px; box-sizing: border-box; float: right;\"><img border=\"0\" id=\"AntiComcc\" src=\"https://www.thuocbietduoc.com.vn/interface/BtMinus.gif\" style=\"margin: 0px; padding: 0px; box-sizing: border-box; border: 0px; vertical-align: middle;\" /></div>\n</div>\n\n<div class=\"textdetaildrg1\" id=\"AntiComccPlus\" style=\"margin: 2px 2px 2px 5px; padding: 0px; box-sizing: border-box; font-family: Roboto, &quot;Times New Roman&quot;; font-size: 12pt; text-align: justify; line-height: 20px;\">Qu&aacute; mẫn với thuốc, người suy thận hay v&ocirc; niệu, phụ nữ c&oacute; thai, cho con b&uacute;.</div>\n\n<div style=\"margin: 0px; padding: 0px; box-sizing: border-box;\">\n<h3 class=\"textdetailhead\" id=\"tuong-tac-thuoc\" style=\"margin: 5px; padding: 0px; box-sizing: border-box; font-size: 11.8pt; font-weight: bold; font-family: Roboto, &quot;Times New Roman&quot;; color: maroon; width: 210px; text-align: justify;\">Tương t&aacute;c thuốc:</h3>\n\n<div style=\"margin: 0px; padding: 0px; box-sizing: border-box; float: right;\"><img border=\"0\" id=\"Ttdd\" src=\"https://www.thuocbietduoc.com.vn/interface/BtMinus.gif\" style=\"margin: 0px; padding: 0px; box-sizing: border-box; border: 0px; vertical-align: middle;\" /></div>\n</div>\n\n<div class=\"textdetaildrg1\" id=\"TtddPlus\" style=\"margin: 2px 2px 2px 5px; padding: 0px; box-sizing: border-box; font-family: Roboto, &quot;Times New Roman&quot;; font-size: 12pt; text-align: justify; line-height: 20px;\">Probenecid.</div>\n\n<div style=\"margin: 0px; padding: 0px; box-sizing: border-box;\">\n<h3 class=\"textdetailhead\" id=\"tac-dung-phu\" style=\"margin: 5px; padding: 0px; box-sizing: border-box; font-size: 11.8pt; font-weight: bold; font-family: Roboto, &quot;Times New Roman&quot;; color: maroon; width: 210px; text-align: justify;\">T&aacute;c dụng phụ:</h3>\n\n<div style=\"margin: 0px; padding: 0px; box-sizing: border-box; float: right;\"><img border=\"0\" id=\"tdnnnn\" src=\"https://www.thuocbietduoc.com.vn/interface/BtMinus.gif\" style=\"margin: 0px; padding: 0px; box-sizing: border-box; border: 0px; vertical-align: middle;\" /></div>\n</div>\n\n<div class=\"textdetaildrg1\" id=\"tdnnnnPlus\" style=\"margin: 2px 2px 2px 5px; padding: 0px; box-sizing: border-box; font-family: Roboto, &quot;Times New Roman&quot;; font-size: 12pt; text-align: justify; line-height: 20px;\">Rối loạn ti&ecirc;u ho&aacute;, nổi mẩn, ch&oacute;ng mặt, l&uacute; lẫn, ảo gi&aacute;c &amp; ngầy ngật.</div>\n\n<div style=\"margin: 0px; padding: 0px; box-sizing: border-box;\">\n<h3 class=\"textdetailhead\" id=\"de-phong\" style=\"margin: 5px; padding: 0px; box-sizing: border-box; font-size: 11.8pt; font-weight: bold; font-family: Roboto, &quot;Times New Roman&quot;; color: maroon; width: 210px; text-align: justify;\">Ch&uacute; &yacute; đề ph&ograve;ng:</h3>\n\n<div style=\"margin: 0px; padding: 0px; box-sizing: border-box; float: right;\"><img border=\"0\" id=\"dpnnnn\" src=\"https://www.thuocbietduoc.com.vn/interface/BtMinus.gif\" style=\"margin: 0px; padding: 0px; box-sizing: border-box; border: 0px; vertical-align: middle;\" /></div>\n</div>\n\n<div class=\"textdetaildrg1\" id=\"dpnnnnPlus\" style=\"margin: 2px 2px 2px 5px; padding: 0px; box-sizing: border-box; font-family: Roboto, &quot;Times New Roman&quot;; font-size: 12pt; text-align: justify; line-height: 20px;\">Kh&ocirc;ng b&ocirc;i kem v&agrave;o mắt, miệng &amp; &acirc;m đạo, thận trọng khi b&ocirc;i ở v&ugrave;ng sinh dục hay hậu m&ocirc;n.</div>\n\n<div style=\"margin: 0px; padding: 0px; box-sizing: border-box;\">\n<h3 class=\"textdetailhead\" id=\"cach-dung\" style=\"margin: 5px; padding: 0px; box-sizing: border-box; font-size: 11.8pt; font-weight: bold; font-family: Roboto, &quot;Times New Roman&quot;; color: maroon; width: 210px; text-align: justify;\">Liều lượng - C&aacute;ch d&ugrave;ng</h3>\n\n<div style=\"margin: 0px; padding: 0px; box-sizing: border-box; float: right;\"><img border=\"0\" id=\"Dossuuu\" src=\"https://www.thuocbietduoc.com.vn/interface/BtMinus.gif\" style=\"margin: 0px; padding: 0px; box-sizing: border-box; border: 0px; vertical-align: middle;\" /></div>\n</div>\n\n<div class=\"textdetaildrg1\" id=\"DossuuuPlus\" style=\"margin: 2px 2px 2px 5px; padding: 0px; box-sizing: border-box; font-family: Roboto, &quot;Times New Roman&quot;; font-size: 12pt; text-align: justify; line-height: 20px;\">- Người lớn Nhiễm Herpes simplex 200 mg x 5 lần/ng&agrave;y x 5 ng&agrave;y.&nbsp;<br style=\"margin: 0px; padding: 0px; box-sizing: border-box;\" />\n- Ph&ograve;ng ngừa t&aacute;i nhiễm Herpes sinh dục &amp; c&aacute;c dạng nặng 200 mg x 4 lần/ng&agrave;y, hoặc 200 mg x 3 lần/ng&agrave;y hoặc 200 mg x 2 lần/ng&agrave;y.&nbsp;<br style=\"margin: 0px; padding: 0px; box-sizing: border-box;\" />\n- Nhiễm Zona 800 mg x 5 lần/ng&agrave;y.&nbsp;<br style=\"margin: 0px; padding: 0px; box-sizing: border-box;\" />\n- Ph&ograve;ng ngừa t&aacute;i nhiễm Zona 400 mg x 4 lần/ng&agrave;y.&nbsp;<br style=\"margin: 0px; padding: 0px; box-sizing: border-box;\" />\n- Suy giảm miễn dịch 200 mg x 4 lần/ng&agrave;y.&nbsp;<br style=\"margin: 0px; padding: 0px; box-sizing: border-box;\" />\n- Suy giảm miễn dịch nặng 400 mg x 4 lần/ng&agrave;y.&nbsp;<br style=\"margin: 0px; padding: 0px; box-sizing: border-box;\" />\n- Trẻ &gt; 2 tuổi d&ugrave;ng liều người lớn, trẻ &lt; 2 tuổi nửa liều người lớn. Bệnh nh&acirc;n Suy thận: giảm liều.</div>\n</div>', '', '1', '1');
INSERT INTO `products` VALUES ('6', 'VNB-3157-05', 'Bivinadol 500mg', 'Bivinadol 500mg viên nén', '58', 'j5a9qml882oks04so.jpg', '15000', '<div style=\"margin: 0px; padding: 0px; box-sizing: border-box; color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif;\"><span align=\"left\" class=\"textdetailhead\" style=\"margin: 5px; padding: 0px; box-sizing: border-box; font-family: Roboto, &quot;Times New Roman&quot;; color: maroon; font-size: 11.8pt; font-weight: bold; width: 210px; text-align: justify;\">Nh&oacute;m sản phẩm:</span><span itemprop=\"\" style=\"margin: 0px; padding: 0px; box-sizing: border-box;\">&nbsp;<a class=\"textdetaillink\" href=\"https://www.thuocbietduoc.com.vn/nhom-thuoc-2-1/giam-dau-ha-sot-chong-viem.aspx\" style=\"margin: 5px 1px; padding: 0px; box-sizing: border-box; text-decoration-line: none; outline: none; font-size: 14px; font-family: Roboto, Tahoma, Arial; color: rgb(51, 102, 153); font-weight: bold; text-align: justify;\" title=\"Giảm đau, hạ sốt, chống viêm\">Thuốc giảm đau, hạ sốt, Nh&oacute;m chống vi&ecirc;m kh&ocirc;ng Steroid, Thuốc điều trị G&uacute;t v&agrave; c&aacute;c bệnh xương khớp</a></span></div>\n\n<div style=\"margin: 0px; padding: 0px; box-sizing: border-box; color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif;\">\n<h2 class=\"textdetailhead\" id=\"thanh-phan\" style=\"margin: 5px; padding: 0px; box-sizing: border-box; font-weight: bold; font-size: 11.8pt; font-family: Roboto, &quot;Times New Roman&quot;; color: maroon; width: 210px; text-align: justify;\" thanh-phan=\"\">Th&agrave;nh phần:</h2>\n\n<div style=\"margin: 0px; padding: 0px 0px 0px 60px; box-sizing: border-box;\"><span class=\"textdetaildrgI\" style=\"margin: 5px 1px; padding: 0px; box-sizing: border-box; font-family: Roboto, &quot;Times New Roman&quot;, Arial; font-size: 12px;\"><a class=\"texttplink\" href=\"https://www.thuocbietduoc.com.vn/thuoc-goc-898/acetaminophen.aspx\" style=\"margin: 0px; padding: 0px; box-sizing: border-box; outline: none; font-size: 12pt; font-family: Roboto, Tahoma, Arial; color: rgb(51, 102, 153); font-weight: bold; text-align: justify;\" title=\"Thuốc gốc Acetaminophen\">Acetaminophen</a></span></div>\n</div>\n\n<div class=\"textdetailhead\" style=\"margin: 5px; padding: 0px; box-sizing: border-box; font-family: Roboto, &quot;Times New Roman&quot;; color: maroon; font-size: 11.8pt; font-weight: bold; width: 210px; text-align: justify;\">H&agrave;m lượng:</div>\n\n<div class=\"textdetaildrgI\" style=\"margin: 5px 1px; padding: 0px 0px 0px 60px; box-sizing: border-box; font-family: Roboto, &quot;Times New Roman&quot;, Arial; font-size: 12px; color: rgb(0, 0, 0);\">500mg</div>\n\n<div class=\"tbldrg_dt2\" style=\"margin: 0px; padding: 0px; box-sizing: border-box; color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif;\">\n<div style=\"margin: 0px; padding: 0px; box-sizing: border-box;\">\n<h2 class=\"textdetailhead\" id=\"chi-dinh\" style=\"margin: 5px; padding: 0px; box-sizing: border-box; font-weight: bold; font-size: 11.8pt; font-family: Roboto, &quot;Times New Roman&quot;; color: maroon; width: 210px; text-align: justify;\">Chỉ định:</h2>\n\n<div style=\"margin: 0px; padding: 0px; box-sizing: border-box; float: right;\"><img border=\"0\" id=\"Indicationbb\" src=\"https://www.thuocbietduoc.com.vn/interface/BtMinus.gif\" style=\"margin: 0px; padding: 0px; box-sizing: border-box; border: 0px; vertical-align: middle;\" /></div>\n</div>\n\n<div class=\"textdetaildrg1\" id=\"IndicationbbPlus\" style=\"margin: 2px 2px 2px 5px; padding: 0px; box-sizing: border-box; font-family: Roboto, &quot;Times New Roman&quot;; font-size: 12pt; text-align: justify; line-height: 20px;\">Giảm đau nhanh c&aacute;c triệu chứng sốt, đau nhức v&agrave; kh&oacute; chịu như nhức đầu, đau tai, đau răng, đau nhức do cảm c&uacute;m.</div>\n\n<div style=\"margin: 0px; padding: 0px; box-sizing: border-box;\">\n<h3 class=\"textdetailhead\" id=\"chong-chi-dinh\" style=\"margin: 5px; padding: 0px; box-sizing: border-box; font-size: 11.8pt; font-weight: bold; font-family: Roboto, &quot;Times New Roman&quot;; color: maroon; width: 210px; text-align: justify;\">Chống chỉ định:</h3>\n\n<div style=\"margin: 0px; padding: 0px; box-sizing: border-box; float: right;\"><img border=\"0\" id=\"AntiComcc\" src=\"https://www.thuocbietduoc.com.vn/interface/BtMinus.gif\" style=\"margin: 0px; padding: 0px; box-sizing: border-box; border: 0px; vertical-align: middle;\" /></div>\n</div>\n\n<div class=\"textdetaildrg1\" id=\"AntiComccPlus\" style=\"margin: 2px 2px 2px 5px; padding: 0px; box-sizing: border-box; font-family: Roboto, &quot;Times New Roman&quot;; font-size: 12pt; text-align: justify; line-height: 20px;\">Qu&aacute; mẫn với Acetaminophen. Trường hợp thiểu năng tế b&agrave;o gan.</div>\n\n<div style=\"margin: 0px; padding: 0px; box-sizing: border-box;\">\n<h3 class=\"textdetailhead\" id=\"tuong-tac-thuoc\" style=\"margin: 5px; padding: 0px; box-sizing: border-box; font-size: 11.8pt; font-weight: bold; font-family: Roboto, &quot;Times New Roman&quot;; color: maroon; width: 210px; text-align: justify;\">Tương t&aacute;c thuốc:</h3>\n\n<div style=\"margin: 0px; padding: 0px; box-sizing: border-box; float: right;\"><img border=\"0\" id=\"Ttdd\" src=\"https://www.thuocbietduoc.com.vn/interface/BtMinus.gif\" style=\"margin: 0px; padding: 0px; box-sizing: border-box; border: 0px; vertical-align: middle;\" /></div>\n</div>\n\n<div class=\"textdetaildrg1\" id=\"TtddPlus\" style=\"margin: 2px 2px 2px 5px; padding: 0px; box-sizing: border-box; font-family: Roboto, &quot;Times New Roman&quot;; font-size: 12pt; text-align: justify; line-height: 20px;\">Tr&aacute;nh uống rượu khi d&ugrave;ng thuốc.</div>\n\n<div style=\"margin: 0px; padding: 0px; box-sizing: border-box;\">\n<h3 class=\"textdetailhead\" id=\"tac-dung-phu\" style=\"margin: 5px; padding: 0px; box-sizing: border-box; font-size: 11.8pt; font-weight: bold; font-family: Roboto, &quot;Times New Roman&quot;; color: maroon; width: 210px; text-align: justify;\">T&aacute;c dụng phụ:</h3>\n\n<div style=\"margin: 0px; padding: 0px; box-sizing: border-box; float: right;\"><img border=\"0\" id=\"tdnnnn\" src=\"https://www.thuocbietduoc.com.vn/interface/BtMinus.gif\" style=\"margin: 0px; padding: 0px; box-sizing: border-box; border: 0px; vertical-align: middle;\" /></div>\n</div>\n\n<div class=\"textdetaildrg1\" id=\"tdnnnnPlus\" style=\"margin: 2px 2px 2px 5px; padding: 0px; box-sizing: border-box; font-family: Roboto, &quot;Times New Roman&quot;; font-size: 12pt; text-align: justify; line-height: 20px;\">- Vi&ecirc;m tụy, ban da, ban đỏ, m&agrave;y đay, v&agrave; phản ứng dị ứng kh&aacute;c thỉnh thoảng c&oacute; xẩy ra.&nbsp;<br style=\"margin: 0px; padding: 0px; box-sizing: border-box;\" />\n- Khi c&oacute; phản ứng dị ứng th&igrave; phải ngưng thuốc.</div>\n\n<div style=\"margin: 0px; padding: 0px; box-sizing: border-box;\">\n<h3 class=\"textdetailhead\" id=\"de-phong\" style=\"margin: 5px; padding: 0px; box-sizing: border-box; font-size: 11.8pt; font-weight: bold; font-family: Roboto, &quot;Times New Roman&quot;; color: maroon; width: 210px; text-align: justify;\">Ch&uacute; &yacute; đề ph&ograve;ng:</h3>\n\n<div style=\"margin: 0px; padding: 0px; box-sizing: border-box; float: right;\"><img border=\"0\" id=\"dpnnnn\" src=\"https://www.thuocbietduoc.com.vn/interface/BtMinus.gif\" style=\"margin: 0px; padding: 0px; box-sizing: border-box; border: 0px; vertical-align: middle;\" /></div>\n</div>\n\n<div class=\"textdetaildrg1\" id=\"dpnnnnPlus\" style=\"margin: 2px 2px 2px 5px; padding: 0px; box-sizing: border-box; font-family: Roboto, &quot;Times New Roman&quot;; font-size: 12pt; text-align: justify; line-height: 20px;\">- Trường hợp suy thận trầm trọng, khoảng c&aacute;ch giữa c&aacute;c lần d&ugrave;ng thuốc phải l&acirc;u hơn (6 đến 8 giờ).&nbsp;<br style=\"margin: 0px; padding: 0px; box-sizing: border-box;\" />\n- Thận trọng khi d&ugrave;ng thuốc k&eacute;o d&agrave;i, nhất l&agrave; trong những trường hợp bệnh nh&acirc;n bị suy thận hay suy gan, d&ugrave;ng qu&aacute; liều tối đa được khuyến c&aacute;o.</div>\n\n<div style=\"margin: 0px; padding: 0px; box-sizing: border-box;\">\n<h3 class=\"textdetailhead\" id=\"cach-dung\" style=\"margin: 5px; padding: 0px; box-sizing: border-box; font-size: 11.8pt; font-weight: bold; font-family: Roboto, &quot;Times New Roman&quot;; color: maroon; width: 210px; text-align: justify;\">Liều lượng - C&aacute;ch d&ugrave;ng</h3>\n\n<div style=\"margin: 0px; padding: 0px; box-sizing: border-box; float: right;\"><img border=\"0\" id=\"Dossuuu\" src=\"https://www.thuocbietduoc.com.vn/interface/BtMinus.gif\" style=\"margin: 0px; padding: 0px; box-sizing: border-box; border: 0px; vertical-align: middle;\" /></div>\n</div>\n\n<div class=\"textdetaildrg1\" id=\"DossuuuPlus\" style=\"margin: 2px 2px 2px 5px; padding: 0px; box-sizing: border-box; font-family: Roboto, &quot;Times New Roman&quot;; font-size: 12pt; text-align: justify; line-height: 20px;\">C&aacute;c lần d&ugrave;ng thuốc n&ecirc;n c&aacute;ch nhau &iacute;t nhất 4 giờ. Ng&agrave;y kh&ocirc;ng qu&aacute; 8 vi&ecirc;n.&nbsp;<br style=\"margin: 0px; padding: 0px; box-sizing: border-box;\" />\nQU&Aacute; LIỀU&nbsp;<br style=\"margin: 0px; padding: 0px; box-sizing: border-box;\" />\n- Triệu chứng: buồn n&ocirc;n, &oacute;i mửa, ch&aacute;n ăn, xanh xao, đau bụng.&nbsp;<br style=\"margin: 0px; padding: 0px; box-sizing: border-box;\" />\nD&ugrave;ng liều qu&aacute; cao tr&ecirc;n 10 g ở người lớn v&agrave; tr&ecirc;n 150 mg/kg ở trẻ em c&oacute; thể g&acirc;y ph&acirc;n hủy tế b&agrave;o gan đưa đến hoại tử ho&agrave;n to&agrave;n v&agrave; kh&ocirc;ng hồi phục, nhiễm toan chuyển h&oacute;a, bệnh l&yacute; n&atilde;o dẫn đến h&ocirc;n m&ecirc; hoặc tử vong.&nbsp;<br style=\"margin: 0px; padding: 0px; box-sizing: border-box;\" />\n- Xử tr&iacute; cấp cứu:&nbsp;<br style=\"margin: 0px; padding: 0px; box-sizing: border-box;\" />\n+ Chuyển ngay đến bệnh viện.&nbsp;<br style=\"margin: 0px; padding: 0px; box-sizing: border-box;\" />\n+ Rửa dạ d&agrave;y để loại trừ ngay thuốc đ&atilde; uống.&nbsp;<br style=\"margin: 0px; padding: 0px; box-sizing: border-box;\" />\n+ D&ugrave;ng c&agrave;ng sớm c&agrave;ng tốt chất giải độc N- acetylcysteine uống hoặc ti&ecirc;m tĩnh mạch.</div>\n\n<div style=\"margin: 0px; padding: 0px; box-sizing: border-box;\">\n<h3 class=\"textdetailhead\" id=\"bao-quan\" style=\"margin: 5px; padding: 0px; box-sizing: border-box; font-size: 11.8pt; font-weight: bold; font-family: Roboto, &quot;Times New Roman&quot;; color: maroon; width: 210px; text-align: justify;\">Bảo quản:</h3>\n\n<div style=\"margin: 0px; padding: 0px; box-sizing: border-box; float: right;\"><img border=\"0\" id=\"Dossuuu11\" src=\"https://www.thuocbietduoc.com.vn/interface/BtMinus.gif\" style=\"margin: 0px; padding: 0px; box-sizing: border-box; border: 0px; vertical-align: middle;\" /></div>\n</div>\n\n<div class=\"textdetaildrg1\" id=\"Dossuuu11Plus\" style=\"margin: 2px 2px 2px 5px; padding: 0px; box-sizing: border-box; font-family: Roboto, &quot;Times New Roman&quot;; font-size: 12pt; text-align: justify; line-height: 20px;\">Nhiệt độ ph&ograve;ng</div>\n</div>', '', '1', '1');

-- ----------------------------
-- Table structure for scheduling_callback
-- ----------------------------
DROP TABLE IF EXISTS `scheduling_callback`;
CREATE TABLE `scheduling_callback` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `code_staff` varchar(1024) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `code_customer` varchar(1024) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `scheduling` date NOT NULL,
  `note` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `status` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of scheduling_callback
-- ----------------------------
INSERT INTO `scheduling_callback` VALUES ('16', '14', 'KHPQA01', '2018-01-24', '<p>Ghi ch&uacute;</p>\r\n', '1');
INSERT INTO `scheduling_callback` VALUES ('17', '14', 'KHPQA01', '2018-01-31', '<p>Ghi ch&uacute;</p>', '2');
INSERT INTO `scheduling_callback` VALUES ('18', '14', 'KHPQA01', '1970-01-01', '<p>Ghi ch&uacute;</p>', '2');
INSERT INTO `scheduling_callback` VALUES ('19', '14', 'KHPQA02', '2018-01-31', '<p>Oke nhắc t&ocirc;i sau 30 ng&agrave;y&nbsp;</p>\r\n', '1');

-- ----------------------------
-- Table structure for sms_sending
-- ----------------------------
DROP TABLE IF EXISTS `sms_sending`;
CREATE TABLE `sms_sending` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `staff` int(255) NOT NULL,
  `title` varchar(1024) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(1024) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of sms_sending
-- ----------------------------
INSERT INTO `sms_sending` VALUES ('1', '1', 'CHUC MUNG NAM MOI', '0932337122', '5');
INSERT INTO `sms_sending` VALUES ('2', '14', 'CHUC MUNG NAM MOI', '0932337122', '5');
INSERT INTO `sms_sending` VALUES ('3', '14', 'CHUC MUNG NAM MOI', '0915130268', '5');
INSERT INTO `sms_sending` VALUES ('4', '14', 'CHUC MUNG NAM MOI', '01227912633', '5');
INSERT INTO `sms_sending` VALUES ('5', '14', 'CHUC MUNG NAM MOI', '01642661182', '5');

-- ----------------------------
-- Table structure for staff
-- ----------------------------
DROP TABLE IF EXISTS `staff`;
CREATE TABLE `staff` (
  `id` bigint(255) NOT NULL AUTO_INCREMENT,
  `code` varchar(1024) COLLATE utf8_unicode_ci DEFAULT NULL,
  `full_name` varchar(1024) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(1024) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(1024) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ngay_sinh` date DEFAULT NULL,
  `dia_chi` varchar(1024) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dien_thoai` varchar(1024) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hinh_anh` varchar(1024) COLLATE utf8_unicode_ci DEFAULT NULL,
  `passport_id` varchar(1024) COLLATE utf8_unicode_ci DEFAULT NULL,
  `authorities` int(255) DEFAULT NULL,
  `status` int(255) DEFAULT NULL,
  `discount` tinyint(1) DEFAULT NULL,
  `cmd` varchar(244) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sendmail` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_status` (`status`) USING BTREE,
  KEY `fk_auth` (`authorities`) USING BTREE,
  CONSTRAINT `staff_ibfk_1` FOREIGN KEY (`authorities`) REFERENCES `authorities` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `staff_ibfk_2` FOREIGN KEY (`status`) REFERENCES `status` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of staff
-- ----------------------------
INSERT INTO `staff` VALUES ('2', 'PQA001', 'Han Desk Kim', 'handeskdotvn@gmail.com', '2f6d228b27cb84e9fb4ac4e0ba393c8b', '1989-11-19', '445 Đội Cấn - Hai Bà Trưng - Hà Nội', '093-233-7122', 'g6xbwsv0ikg08gw.jpg', '097-323-1212', '1', '1', '0', null, '1');
INSERT INTO `staff` VALUES ('14', 'PQA014', 'Awata Urara', 'AwataUrara@gmail.com', '25d55ad283aa400af464c76d713c07ad', '0000-00-00', 'Fukasawa Sayoko', '0900000000', '47oj0b6bjdmooc.jpg', '0900000000', '4', '1', '1', '1000', '1');
INSERT INTO `staff` VALUES ('15', 'PQA015', 'Nathan Kelly', 'Nathan.Kelly@thefortressgroup.co.uk', '25d55ad283aa400af464c76d713c07ad', '0000-00-00', '4th Floor, Exchange House 54-62 Athol Street Douglas Isle of Man', '01624 683000', '65tq0tjpva80okw.jpg', '01624 683000', '3', '1', '0', '1000', '1');
INSERT INTO `staff` VALUES ('16', 'PQA016', 'Song Hee Kim', 'songheek@marshall.usc.edu', '25d55ad283aa400af464c76d713c07ad', '1987-04-01', 'Bridge Hall 307A, 3670 Trousdale Parkway, Los Angeles, CA 90089', '(213) 821-4189', 'j88a5uhv0yog4s.jpg', '213-821-4189', '5', '1', '0', '1000', '1');
INSERT INTO `staff` VALUES ('17', 'PQA017', 'Lê Quỳnh Anh', 'lequynh213@gmail.com', '25d55ad283aa400af464c76d713c07ad', '0000-00-00', 'hàng ngang - hà nội', '0932337133', 'default.jpg', '0932337133', '4', '1', '0', '1000', '1');
INSERT INTO `staff` VALUES ('18', 'PQA018', 'Lê Phương Thúy', 'phuongthuy@gmail.com', '25d55ad283aa400af464c76d713c07ad', '0000-00-00', 'Hàng bài - Hà Nội', '0932337122', null, '0900000000', '4', '1', '1', '1000', '1');
INSERT INTO `staff` VALUES ('19', 'PQA019', 'Hoàng vân', 'hoanvan@gmail.com', '2f6d228b27cb84e9fb4ac4e0ba393c8b', '0000-00-00', '442 Doi Can', '0932338888', 'mpn46n2qt40kso.jpg', '0932338888', '4', '1', '1', '1000', '1');

-- ----------------------------
-- Table structure for status
-- ----------------------------
DROP TABLE IF EXISTS `status`;
CREATE TABLE `status` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `name_status` varchar(1024) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of status
-- ----------------------------
INSERT INTO `status` VALUES ('1', 'active');
INSERT INTO `status` VALUES ('2', 'deactive');

-- ----------------------------
-- Table structure for status_callback
-- ----------------------------
DROP TABLE IF EXISTS `status_callback`;
CREATE TABLE `status_callback` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `name_status` varchar(1024) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of status_callback
-- ----------------------------
INSERT INTO `status_callback` VALUES ('1', 'Hoạt động Gọi lại');
INSERT INTO `status_callback` VALUES ('2', 'Đóng lịch');
INSERT INTO `status_callback` VALUES ('3', 'Chưa gọi');

-- ----------------------------
-- Table structure for status_email
-- ----------------------------
DROP TABLE IF EXISTS `status_email`;
CREATE TABLE `status_email` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `name_status` varchar(1024) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of status_email
-- ----------------------------
INSERT INTO `status_email` VALUES ('1', 'chờ gửi');
INSERT INTO `status_email` VALUES ('2', 'lỗi gửi');
INSERT INTO `status_email` VALUES ('3', 'gửi thành công');
INSERT INTO `status_email` VALUES ('4', 'hủy gửi');

-- ----------------------------
-- Table structure for types_pharma
-- ----------------------------
DROP TABLE IF EXISTS `types_pharma`;
CREATE TABLE `types_pharma` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `name_types_pharma` varchar(1024) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of types_pharma
-- ----------------------------
INSERT INTO `types_pharma` VALUES ('1', 'Thuốc điều trị');
INSERT INTO `types_pharma` VALUES ('2', 'Thực phẩm chức năng');

-- ----------------------------
-- Table structure for type_oders
-- ----------------------------
DROP TABLE IF EXISTS `type_oders`;
CREATE TABLE `type_oders` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `name_oders` varchar(1024) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of type_oders
-- ----------------------------
INSERT INTO `type_oders` VALUES ('1', 'initializing orders');
INSERT INTO `type_oders` VALUES ('2', 'Chờ kế toán kiểm duyệt');
INSERT INTO `type_oders` VALUES ('3', 'Chờ  Kho xác nhận và đóng gói');
INSERT INTO `type_oders` VALUES ('4', 'Đã đóng gói và gửi');
INSERT INTO `type_oders` VALUES ('5', 'Successful delivery');
INSERT INTO `type_oders` VALUES ('6', 'Hủy đơn hàng');
INSERT INTO `type_oders` VALUES ('7', 'Kế toán hủy');
INSERT INTO `type_oders` VALUES ('8', 'Kho hủy');
INSERT INTO `type_oders` VALUES ('9', 'Delivery canceled');

-- ----------------------------
-- Table structure for type_post
-- ----------------------------
DROP TABLE IF EXISTS `type_post`;
CREATE TABLE `type_post` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `name_type_orders` varchar(1024) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `url_check_orders` varchar(1024) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of type_post
-- ----------------------------
INSERT INTO `type_post` VALUES ('1', 'VNPT POST', 'http://www.vnpost.vn/en-us/dinh-vi/buu-pham?key=');
INSERT INTO `type_post` VALUES ('2', 'VIETTEL POST', 'https://www.viettelpost.com.vn/Tracking?KEY=');
