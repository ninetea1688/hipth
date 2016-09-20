/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : test

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2016-09-20 12:04:08
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `view_pt_log`
-- ----------------------------
DROP TABLE IF EXISTS `view_pt_log`;
CREATE TABLE `view_pt_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `viewdate` datetime NOT NULL,
  `vn` int(11) NOT NULL,
  `user_addr` varchar(50) NOT NULL,
  `user_agent` text NOT NULL,
  `user_mac` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of view_pt_log
-- ----------------------------
