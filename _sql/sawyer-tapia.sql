-- phpMyAdmin SQL Dump
-- version 3.2.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 31, 2011 at 06:28 PM
-- Server version: 5.1.44
-- PHP Version: 5.3.2

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sawyer-tapia`
--

-- --------------------------------------------------------

--
-- Table structure for table `attachments`
--

CREATE TABLE `attachments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `type` varchar(255) DEFAULT NULL,
  `size` int(10) DEFAULT NULL,
  `filesize` varchar(255) DEFAULT NULL,
  `ext` varchar(255) DEFAULT NULL,
  `group` varchar(255) DEFAULT NULL,
  `width` int(10) DEFAULT NULL,
  `height` int(10) DEFAULT NULL,
  `path` varchar(255) DEFAULT NULL,
  `path_small` varchar(255) DEFAULT NULL,
  `path_med` varchar(255) DEFAULT NULL,
  `source_url` varchar(255) DEFAULT NULL,
  `uploaded` datetime DEFAULT NULL,
  `user_id` int(10) DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `rating` decimal(3,1) unsigned DEFAULT '0.0',
  `votes` int(11) unsigned DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=142 ;

--
-- Dumping data for table `attachments`
--

INSERT INTO `attachments` VALUES(1, '1_home-hands.jpg', '', 'image/jpeg', 120394, '118 KB', 'jpg', 'image', 485, 600, '/media/static/img/sources/1_home-hands.jpg', '/media/filter/img/sml/sources/1_home-hands_small.jpg', '/media/filter/img/med/sources/1_home-hands_med.jpg', NULL, '2011-07-05 19:56:50', NULL, '2011-07-05 19:56:50', '2011-07-05 19:56:50', 0.0, 0);
INSERT INTO `attachments` VALUES(2, 'Screen_shot_2011-06-17_at_4.46.35_PM.jpg', '', 'image/jpeg', 57929, '57 KB', 'jpg', 'image', 651, 428, '/media/static/img/sources/Screen_shot_2011-06-17_at_4.46.35_PM.jpg', '/media/filter/img/sml/sources/Screen_shot_2011-06-17_at_4.46.35_PM_small.jpg', '/media/filter/img/med/sources/Screen_shot_2011-06-17_at_4.46.35_PM_med.jpg', NULL, '2011-07-05 19:57:34', NULL, '2011-07-05 19:57:34', '2011-07-05 19:57:34', 0.0, 0);
INSERT INTO `attachments` VALUES(3, 'Screen_shot_2011-06-23_at_10.50.25_PM.jpg', '', 'image/jpeg', 10764, '11 KB', 'jpg', 'image', 235, 117, '/media/static/img/sources/Screen_shot_2011-06-23_at_10.50.25_PM.jpg', '/media/filter/img/sml/sources/Screen_shot_2011-06-23_at_10.50.25_PM_small.jpg', '/media/filter/img/med/sources/Screen_shot_2011-06-23_at_10.50.25_PM_med.jpg', NULL, '2011-07-05 20:00:47', NULL, '2011-07-05 20:00:48', '2011-07-05 20:00:48', 0.0, 0);
INSERT INTO `attachments` VALUES(4, 'Screen_shot_2011-06-24_at_2.26.00_PM.jpg', '', 'image/jpeg', 8996, '9 KB', 'jpg', 'image', 134, 47, '/media/static/img/sources/Screen_shot_2011-06-24_at_2.26.00_PM.jpg', '/media/filter/img/sml/sources/Screen_shot_2011-06-24_at_2.26.00_PM_small.jpg', '/media/filter/img/med/sources/Screen_shot_2011-06-24_at_2.26.00_PM_med.jpg', NULL, '2011-07-05 20:04:09', NULL, '2011-07-05 20:04:09', '2011-07-05 20:04:09', 0.0, 0);
INSERT INTO `attachments` VALUES(5, 'Screen_shot_2011-06-24_at_2.30.49_PM.jpg', '', 'image/jpeg', 15427, '15 KB', 'jpg', 'image', 332, 111, '/media/static/img/sources/Screen_shot_2011-06-24_at_2.30.49_PM.jpg', '/media/filter/img/sml/sources/Screen_shot_2011-06-24_at_2.30.49_PM_small.jpg', '/media/filter/img/med/sources/Screen_shot_2011-06-24_at_2.30.49_PM_med.jpg', NULL, '2011-07-05 20:05:52', NULL, '2011-07-05 20:05:52', '2011-07-05 20:05:52', 0.0, 0);
INSERT INTO `attachments` VALUES(6, 'cabo.jpg', '', 'image/jpeg', 2047225, '2 MB', 'jpg', 'image', 2048, 1536, '/media/static/img/sources/cabo.jpg', '/media/filter/img/sml/sources/cabo_small.jpg', '/media/filter/img/med/sources/cabo_med.jpg', NULL, '2011-07-05 21:02:08', NULL, '2011-07-05 21:02:09', '2011-07-05 21:02:09', 0.0, 0);
INSERT INTO `attachments` VALUES(7, 'Kate.JPG.jpg', '', 'image/jpeg', 564505, '551 KB', 'jpg', 'image', 1600, 1200, '/media/static/img/clients/Kate.JPG.jpg', '/media/filter/img/sml/clients/Kate.JPG_small.jpg', '/media/filter/img/med/clients/Kate.JPG_med.jpg', NULL, '2011-07-05 21:14:22', NULL, '2011-07-05 21:14:23', '2011-07-05 21:14:23', 0.0, 0);
INSERT INTO `attachments` VALUES(11, 'cabo.jpg', '', 'image/jpeg', 2047225, '2 MB', 'jpg', 'image', 2048, 1536, '/media/static/img/sources/cabo.jpg', '/media/filter/img/sml/sources/cabo_small.jpg', '/media/filter/img/med/sources/cabo_med.jpg', NULL, '2011-07-06 12:26:26', NULL, '2011-07-06 12:26:26', '2011-07-06 12:26:26', 0.0, 0);
INSERT INTO `attachments` VALUES(10, 'cabo.jpg', '', 'image/jpeg', 2047225, '2 MB', 'jpg', 'image', 2048, 1536, '/media/static/img/sources/cabo.jpg', '/media/filter/img/sml/sources/cabo_small.jpg', '/media/filter/img/med/sources/cabo_med.jpg', NULL, '2011-07-06 12:25:14', NULL, '2011-07-06 12:25:15', '2011-07-06 12:25:15', 0.0, 0);
INSERT INTO `attachments` VALUES(12, 'cabo_watercolor.png', '', 'image/png', 455461, '445 KB', 'png', 'image', 600, 427, '/media/static/img/sources/cabo_watercolor.png', '/media/filter/img/sml/sources/cabo_watercolor_small.png', '/media/filter/img/med/sources/cabo_watercolor_med.png', NULL, '2011-07-06 12:29:35', NULL, '2011-07-06 12:29:35', '2011-07-06 12:29:35', 0.0, 0);
INSERT INTO `attachments` VALUES(13, 'de_Corato_DeepSea.jpg', '', 'image/jpeg', 196608, '192 KB', 'jpg', 'image', 460, 460, '/media/static/img/sources/de_Corato_DeepSea.jpg', '/media/filter/img/sml/sources/de_Corato_DeepSea_small.jpg', '/media/filter/img/med/sources/de_Corato_DeepSea_med.jpg', NULL, '2011-07-06 12:32:51', NULL, '2011-07-06 12:32:51', '2011-07-06 12:32:51', 0.0, 0);
INSERT INTO `attachments` VALUES(14, 'josh-peskowitz-db2.jpg', '', 'image/jpeg', 192030, '188 KB', 'jpg', 'image', 480, 640, '/media/static/img/contractors/josh-peskowitz-db2.jpg', '/media/filter/img/sml/contractors/josh-peskowitz-db2_small.jpg', '/media/filter/img/med/contractors/josh-peskowitz-db2_med.jpg', NULL, '2011-07-06 17:42:42', NULL, '2011-07-06 17:42:42', '2011-07-06 17:42:42', 0.0, 0);
INSERT INTO `attachments` VALUES(16, 'beach-house-inn.jpg', '', 'image/jpeg', 42179, '41 KB', 'jpg', 'image', 550, 412, '/media/static/img/houses/beach-house-inn.jpg', '/media/filter/img/sml/houses/beach-house-inn_small.jpg', '/media/filter/img/med/houses/beach-house-inn_med.jpg', NULL, '2011-07-06 23:46:34', NULL, '2011-07-06 23:46:34', '2011-07-06 23:46:34', 0.0, 0);
INSERT INTO `attachments` VALUES(17, 'kellie_anderson.jpg', '', 'image/jpeg', 45393, '44 KB', 'jpg', 'image', 702, 250, '/media/static/img/sources/kellie_anderson.jpg', '/media/filter/img/sml/sources/kellie_anderson_small.jpg', '/media/filter/img/med/sources/kellie_anderson_med.jpg', NULL, '2011-07-07 23:18:47', NULL, '2011-07-07 23:18:47', '2011-07-07 23:18:47', 0.0, 0);
INSERT INTO `attachments` VALUES(18, '04tubosingle_rect540.jpg', '', 'image/jpeg', NULL, '131 KB', 'jpg', 'image', 359, 540, '/media/static/img/inspirations/04tubosingle_rect540.jpg', '/media/filter/img/sml/inspirations/04tubosingle_rect540_small.jpg', '/media/filter/img/med/inspirations/04tubosingle_rect540_med.jpg', NULL, '2011-07-09 03:34:28', NULL, '2011-07-09 03:34:28', '2011-07-09 03:34:28', 0.0, 0);
INSERT INTO `attachments` VALUES(19, '02tuborow_rect540.jpg', '', 'image/jpeg', NULL, '51 KB', 'jpg', 'image', 540, 359, '/media/static/img/inspirations/02tuborow_rect540.jpg', '/media/filter/img/sml/inspirations/02tuborow_rect540_small.jpg', '/media/filter/img/med/inspirations/02tuborow_rect540_med.jpg', NULL, '2011-07-09 23:09:20', NULL, '2011-07-09 23:09:20', '2011-07-09 23:09:20', 0.0, 0);
INSERT INTO `attachments` VALUES(20, 'Modern-Home-Design-11.jpg', '', 'image/jpeg', NULL, '97 KB', 'jpg', 'image', 448, 543, '/media/static/img/inspirations/Modern-Home-Design-11.jpg', '/media/filter/img/sml/inspirations/Modern-Home-Design-11_small.jpg', '/media/filter/img/med/inspirations/Modern-Home-Design-11_med.jpg', NULL, '2011-07-09 23:20:35', NULL, '2011-07-09 23:20:35', '2011-07-09 23:20:35', 0.0, 0);
INSERT INTO `attachments` VALUES(21, 'modern-home-in-fitzroy-melbourne.jpg', '', 'image/jpeg', 31702, '31 KB', 'jpg', 'image', 490, 371, '/media/static/img/inspirations/modern-home-in-fitzroy-melbourne.jpg', '/media/filter/img/sml/inspirations/modern-home-in-fitzroy-melbourne_small.jpg', '/media/filter/img/med/inspirations/modern-home-in-fitzroy-melbourne_med.jpg', NULL, '2011-07-09 23:21:16', NULL, '2011-07-09 23:21:16', '2011-07-09 23:21:16', 0.0, 0);
INSERT INTO `attachments` VALUES(22, 'DSC05487.JPG.jpg', '', 'image/jpeg', NULL, '18 KB', 'jpg', 'image', 300, 400, '/media/static/img/sources/DSC05487.JPG.jpg', '/media/filter/img/sml/sources/DSC05487.JPG_small.jpg', '/media/filter/img/med/sources/DSC05487.JPG_med.jpg', NULL, '2011-07-10 00:10:09', NULL, '2011-07-10 00:10:09', '2011-07-10 00:10:09', 0.0, 0);
INSERT INTO `attachments` VALUES(23, 'dicapri.jpg', '', 'image/jpeg', 47309, '46 KB', 'jpg', 'image', 513, 514, '/media/static/img/sources/dicapri.jpg', '/media/filter/img/sml/sources/dicapri_small.jpg', '/media/filter/img/med/sources/dicapri_med.jpg', NULL, '2011-07-10 14:31:02', NULL, '2011-07-10 14:31:02', '2011-07-10 14:31:02', 0.0, 0);
INSERT INTO `attachments` VALUES(33, 'dsc05489_jpg1-ghwtepa-1310336938.jpg', '', 'image/jpeg', NULL, '20 KB', 'jpg', 'image', 300, 400, '/media/static/img/sources/dsc05489_jpg1-ghwtepa-1310336938.jpg', '/media/filter/img/sml/sources/dsc05489_jpg1-ghwtepa-1310336938_small.jpg', '/media/filter/img/med/sources/dsc05489_jpg1-ghwtepa-1310336938_med.jpg', NULL, '2011-07-10 15:28:58', NULL, '2011-07-10 15:28:58', '2011-07-10 15:28:58', 0.0, 0);
INSERT INTO `attachments` VALUES(34, 'x.jpg', '', 'image/jpeg', NULL, '81 KB', 'jpg', 'image', 768, 768, '/media/static/img/sources/x.jpg', '/media/filter/img/sml/sources/x_small.jpg', '/media/filter/img/med/sources/x_med.jpg', NULL, '2011-07-10 15:31:37', NULL, '2011-07-10 15:31:37', '2011-07-10 15:31:37', 0.0, 0);
INSERT INTO `attachments` VALUES(35, 'x-gxjjeyp-1310337133.jpg', '', 'image/jpeg', NULL, '68 KB', 'jpg', 'image', 768, 768, '/media/static/img/sources/x-gxjjeyp-1310337133.jpg', '/media/filter/img/sml/sources/x-gxjjeyp-1310337133_small.jpg', '/media/filter/img/med/sources/x-gxjjeyp-1310337133_med.jpg', NULL, '2011-07-10 15:32:13', NULL, '2011-07-10 15:32:13', '2011-07-10 15:32:13', 0.0, 0);
INSERT INTO `attachments` VALUES(37, 'french_patio_charis_main-nlgqfnl-1310338950.jpg', '', 'image/jpeg', NULL, '111 KB', 'jpg', 'image', 768, 768, '/media/static/img/sources/french_patio_charis_main-nlgqfnl-1310338950.jpg', '/media/filter/img/sml/sources/french_patio_charis_main-nlgqfnl-1310338950_small.jpg', '/media/filter/img/med/sources/french_patio_charis_main-nlgqfnl-1310338950_med.jpg', NULL, '2011-07-10 16:02:30', NULL, '2011-07-10 16:02:30', '2011-07-10 16:02:30', 0.0, 0);
INSERT INTO `attachments` VALUES(123, 'Hardwoods-Flooring.jpg', '', 'image/jpeg', NULL, '13 KB', 'jpg', 'image', 322, 318, '/media/static/img/products/Hardwoods-Flooring.jpg', '/media/filter/img/sml/products/Hardwoods-Flooring_small.jpg', '/media/filter/img/med/products/Hardwoods-Flooring_med.jpg', '', '2011-07-14 02:26:07', NULL, '2011-07-14 02:26:07', '2011-07-14 02:26:07', 0.0, 0);
INSERT INTO `attachments` VALUES(47, 'baas_clay_lounge_310.jpg', 'Test', 'image/jpeg', NULL, '35 KB', 'jpg', 'image', 310, 310, '/media/static/img/sources/baas_clay_lounge_310.jpg', '/media/filter/img/sml/sources/baas_clay_lounge_310_small.jpg', '/media/filter/img/med/sources/baas_clay_lounge_310_med.jpg', NULL, '2011-07-11 00:02:41', NULL, '2011-07-11 00:02:41', '2011-07-11 00:02:41', 0.0, 0);
INSERT INTO `attachments` VALUES(54, '091002icebucket.jpg', 'Mr. Beaton Yellow Pattern', 'image/jpeg', NULL, '53 KB', 'jpg', 'image', 594, 444, '/media/static/img/products/091002icebucket.jpg', '/media/filter/img/sml/products/091002icebucket_small.jpg', '/media/filter/img/med/products/091002icebucket_med.jpg', NULL, '2011-07-11 18:14:26', NULL, '2011-07-11 18:14:26', '2011-07-11 18:14:26', 0.0, 0);
INSERT INTO `attachments` VALUES(55, 'led-lighted-ice-bucket.jpg', '', 'image/jpeg', NULL, '17 KB', 'jpg', 'image', 316, 479, '/media/static/img/products/led-lighted-ice-bucket.jpg', '/media/filter/img/sml/products/led-lighted-ice-bucket_small.jpg', '/media/filter/img/med/products/led-lighted-ice-bucket_med.jpg', NULL, '2011-07-11 18:16:21', NULL, '2011-07-11 18:16:21', '2011-07-11 18:16:21', 0.0, 0);
INSERT INTO `attachments` VALUES(56, 'icebucketssav.jpg', '', 'image/jpeg', NULL, '13 KB', 'jpg', 'image', 290, 290, '/media/static/img/products/icebucketssav.jpg', '/media/filter/img/sml/products/icebucketssav_small.jpg', '/media/filter/img/med/products/icebucketssav_med.jpg', NULL, '2011-07-11 18:18:46', NULL, '2011-07-11 18:18:46', '2011-07-11 18:18:46', 0.0, 0);
INSERT INTO `attachments` VALUES(57, 'icebucket.jpg', '', 'image/jpeg', NULL, '17 KB', 'jpg', 'image', 290, 290, '/media/static/img/products/icebucket.jpg', '/media/filter/img/sml/products/icebucket_small.jpg', '/media/filter/img/med/products/icebucket_med.jpg', NULL, '2011-07-11 18:26:41', NULL, '2011-07-11 18:26:42', '2011-07-11 18:26:42', 0.0, 0);
INSERT INTO `attachments` VALUES(58, '091002icebucket1.jpg', '', 'image/jpeg', NULL, '53 KB', 'jpg', 'image', 594, 444, '/media/static/img/products/091002icebucket1.jpg', '/media/filter/img/sml/products/091002icebucket1_small.jpg', '/media/filter/img/med/products/091002icebucket1_med.jpg', NULL, '2011-07-11 18:30:47', NULL, '2011-07-11 18:30:47', '2011-07-11 18:30:47', 0.0, 0);
INSERT INTO `attachments` VALUES(66, 'ptls02-k.jpg', 'Crappy Lamp', 'image/jpeg', 58482, '57 KB', 'jpg', 'image', 1024, 1024, '/media/static/img/sources/ptls02-k.jpg', '/media/filter/img/sml/sources/ptls02-k_small.jpg', '/media/filter/img/med/sources/ptls02-k_med.jpg', NULL, '2011-07-12 17:29:48', NULL, '2011-07-12 17:29:48', '2011-07-12 17:29:48', 0.0, 0);
INSERT INTO `attachments` VALUES(69, 'ib-wi10-00538.jpg', 'Again', 'image/jpeg', NULL, '100 KB', 'jpg', 'image', 640, 640, '/media/static/img/products/ib-wi10-00538.jpg', '/media/filter/img/sml/products/ib-wi10-00538_small.jpg', '/media/filter/img/med/products/ib-wi10-00538_med.jpg', 'http://iomoi.stores.yahoo.net/ib-wi10-005.html', '2011-07-12 19:42:27', NULL, '2011-07-12 19:42:27', '2011-07-12 19:42:27', 0.0, 0);
INSERT INTO `attachments` VALUES(70, '091002icebucket2.jpg', 'Another one', 'image/jpeg', NULL, '53 KB', 'jpg', 'image', 594, 444, '/media/static/img/products/091002icebucket2.jpg', '/media/filter/img/sml/products/091002icebucket2_small.jpg', '/media/filter/img/med/products/091002icebucket2_med.jpg', 'http://iomoi.stores.yahoo.net/ib-wi10-005.html', '2011-07-12 19:43:20', NULL, '2011-07-12 19:43:20', '2011-07-12 19:43:20', 0.0, 0);
INSERT INTO `attachments` VALUES(86, 'dicapri-gvmoavt-1310532837.jpg', 'Some Thing', 'image/jpeg', 47309, '46 KB', 'jpg', 'image', 513, 514, '/media/static/img/products/dicapri-gvmoavt-1310532837.jpg', '/media/filter/img/sml/products/dicapri-gvmoavt-1310532837_small.jpg', '/media/filter/img/med/products/dicapri-gvmoavt-1310532837_med.jpg', 'something.com', '2011-07-12 21:53:57', NULL, '2011-07-12 21:53:57', '2011-07-12 21:53:57', 0.0, 0);
INSERT INTO `attachments` VALUES(87, 'lamp4.jpeg', 'Something else', 'image/jpeg', 4237, '4 KB', 'jpeg', 'image', 104, 330, '/media/static/img/products/lamp4.jpeg', '/media/filter/img/sml/products/lamp4_small.jpeg', '/media/filter/img/med/products/lamp4_med.jpeg', 'somethingelse.com', '2011-07-12 21:54:47', NULL, '2011-07-12 21:54:47', '2011-07-12 21:54:47', 0.0, 0);
INSERT INTO `attachments` VALUES(88, 'iomoi_2161_502694413.jpg', 'something url', 'image/jpeg', NULL, '165 KB', 'jpg', 'image', 753, 559, '/media/static/img/products/iomoi_2161_502694413.jpg', '/media/filter/img/sml/products/iomoi_2161_502694413_small.jpg', '/media/filter/img/med/products/iomoi_2161_502694413_med.jpg', 'http://iomoi.stores.yahoo.net/section-deskaccessories.html', '2011-07-12 21:55:20', NULL, '2011-07-12 21:55:20', '2011-07-12 21:55:20', 0.0, 0);
INSERT INTO `attachments` VALUES(89, 'french_candleholder5.jpg', '', 'image/jpeg', 82699, '81 KB', 'jpg', 'image', 768, 768, '/media/static/img/products/french_candleholder5.jpg', '/media/filter/img/sml/products/french_candleholder5_small.jpg', '/media/filter/img/med/products/french_candleholder5_med.jpg', 'somewhere.com', '2011-07-12 21:56:25', NULL, '2011-07-12 21:56:25', '2011-07-12 21:56:25', 0.0, 0);
INSERT INTO `attachments` VALUES(90, 'jenn-air_drawer_refrigerator.png', 'Testing Add', 'image/png', 148988, '145 KB', 'png', 'image', 550, 550, '/media/static/img/products/jenn-air_drawer_refrigerator.png', '/media/filter/img/sml/products/jenn-air_drawer_refrigerator_small.png', '/media/filter/img/med/products/jenn-air_drawer_refrigerator_med.png', 'something.com', '2011-07-12 22:09:34', NULL, '2011-07-12 22:09:34', '2011-07-12 22:09:34', 0.0, 0);
INSERT INTO `attachments` VALUES(91, 'parlourchairboldf11-xxfabeg-1310533908.jpg', '', 'image/jpeg', 34112, '33 KB', 'jpg', 'image', 400, 400, '/media/static/img/products/parlourchairboldf11-xxfabeg-1310533908.jpg', '/media/filter/img/sml/products/parlourchairboldf11-xxfabeg-1310533908_small.jpg', '/media/filter/img/med/products/parlourchairboldf11-xxfabeg-1310533908_med.jpg', '', '2011-07-12 22:11:47', NULL, '2011-07-12 22:11:48', '2011-07-12 22:11:48', 0.0, 0);
INSERT INTO `attachments` VALUES(92, 'iomoi_2161_21176915.jpg', '', 'image/jpeg', NULL, '378 KB', 'jpg', 'image', 800, 800, '/media/static/img/products/iomoi_2161_21176915.jpg', '/media/filter/img/sml/products/iomoi_2161_21176915_small.jpg', '/media/filter/img/med/products/iomoi_2161_21176915_med.jpg', '', '2011-07-12 22:12:11', NULL, '2011-07-12 22:12:11', '2011-07-12 22:12:11', 0.0, 0);
INSERT INTO `attachments` VALUES(93, 'sahara_multi_color_terracotta_purple_yel.jpg', '', 'image/jpeg', NULL, '224 KB', 'jpg', 'image', 524, 465, '/media/static/img/products/sahara_multi_color_terracotta_purple_yel.jpg', '/media/filter/img/sml/products/sahara_multi_color_terracotta_purple_yel_small.jpg', '/media/filter/img/med/products/sahara_multi_color_terracotta_purple_yel_med.jpg', '', '2011-07-12 22:33:08', NULL, '2011-07-12 22:33:08', '2011-07-12 22:33:08', 0.0, 0);
INSERT INTO `attachments` VALUES(94, 'sahara_multi_color_terracotta_purple_yel-bviqjjy-1310535363.jpg', '', 'image/jpeg', NULL, '224 KB', 'jpg', 'image', 524, 465, '/media/static/img/products/sahara_multi_color_terracotta_purple_yel-bviqjjy-1310535363.jpg', '/media/filter/img/sml/products/sahara_multi_color_terracotta_purple_yel-bviqjjy-1310535363_small.jpg', '/media/filter/img/med/products/sahara_multi_color_terracotta_purple_yel-bviqjjy-1310535363_med.jpg', '', '2011-07-12 22:36:03', NULL, '2011-07-12 22:36:03', '2011-07-12 22:36:03', 0.0, 0);
INSERT INTO `attachments` VALUES(95, 'sahara_multi_color_terracotta_purple_yel-wmrxheo-1310535502.jpg', '', 'image/jpeg', NULL, '224 KB', 'jpg', 'image', 524, 465, '/media/static/img/products/sahara_multi_color_terracotta_purple_yel-wmrxheo-1310535502.jpg', '/media/filter/img/sml/products/sahara_multi_color_terracotta_purple_yel-wmrxheo-1310535502_small.jpg', '/media/filter/img/med/products/sahara_multi_color_terracotta_purple_yel-wmrxheo-1310535502_med.jpg', '', '2011-07-12 22:38:22', NULL, '2011-07-12 22:38:22', '2011-07-12 22:38:22', 0.0, 0);
INSERT INTO `attachments` VALUES(98, 'sahara_multi_color_terracotta_purple_yel-vyjfuxv-1310536514.jpg', '', 'image/jpeg', NULL, '224 KB', 'jpg', 'image', 524, 465, '/media/static/img/Products/sahara_multi_color_terracotta_purple_yel-vyjfuxv-1310536514.jpg', '/media/filter/img/sml/Products/sahara_multi_color_terracotta_purple_yel-vyjfuxv-1310536514_small.jpg', '/media/filter/img/med/Products/sahara_multi_color_terracotta_purple_yel-vyjfuxv-1310536514_med.jpg', '', '2011-07-12 22:55:14', NULL, '2011-07-12 22:55:14', '2011-07-12 22:55:14', 0.0, 0);
INSERT INTO `attachments` VALUES(105, 'french_candleholder-zdhkjlm-1310539626.jpg', 'Testing Add', 'image/jpeg', 82699, '81 KB', 'jpg', 'image', 768, 768, '/media/static/img/Sources/french_candleholder-zdhkjlm-1310539626.jpg', '/media/filter/img/sml/Sources/french_candleholder-zdhkjlm-1310539626_small.jpg', '/media/filter/img/med/Sources/french_candleholder-zdhkjlm-1310539626_med.jpg', '', '2011-07-12 23:47:06', NULL, '2011-07-12 23:47:06', '2011-07-12 23:47:06', 0.0, 0);
INSERT INTO `attachments` VALUES(106, 'na_seersuckerm.jpg', 'Seersucker napkin', 'image/jpeg', NULL, '161 KB', 'jpg', 'image', 530, 530, '/media/static/img/sources/na_seersuckerm.jpg', '/media/filter/img/sml/sources/na_seersuckerm_small.jpg', '/media/filter/img/med/sources/na_seersuckerm_med.jpg', 'http://www.kimseybert.com/detail.htm?Spring_2011=&params=1,40', '2011-07-13 00:00:30', NULL, '2011-07-13 00:00:30', '2011-07-13 00:00:30', 0.0, 0);
INSERT INTO `attachments` VALUES(107, 'na_seersuckerm-qehdcfd-1310540564.jpg', 'Seersucker napkin', 'image/jpeg', NULL, '161 KB', 'jpg', 'image', 530, 530, '/media/static/img/sources/na_seersuckerm-qehdcfd-1310540564.jpg', '/media/filter/img/sml/sources/na_seersuckerm-qehdcfd-1310540564_small.jpg', '/media/filter/img/med/sources/na_seersuckerm-qehdcfd-1310540564_med.jpg', 'http://www.kimseybert.com/detail.htm?Spring_2011=&params=1,40', '2011-07-13 00:02:44', NULL, '2011-07-13 00:02:44', '2011-07-13 00:02:44', 0.0, 0);
INSERT INTO `attachments` VALUES(108, 'na_seersuckerm-kdwxyot-1310540643.jpg', 'Seersucker napkin', 'image/jpeg', NULL, '161 KB', 'jpg', 'image', 530, 530, '/media/static/img/sources/na_seersuckerm-kdwxyot-1310540643.jpg', '/media/filter/img/sml/sources/na_seersuckerm-kdwxyot-1310540643_small.jpg', '/media/filter/img/med/sources/na_seersuckerm-kdwxyot-1310540643_med.jpg', 'http://www.kimseybert.com/detail.htm?Spring_2011=&params=1,40', '2011-07-13 00:04:02', NULL, '2011-07-13 00:04:03', '2011-07-13 00:04:03', 0.0, 0);
INSERT INTO `attachments` VALUES(109, 'ba_mastabam.jpg', 'Mastabam', 'image/jpeg', NULL, '150 KB', 'jpg', 'image', 530, 530, '/media/static/img/sources/ba_mastabam.jpg', '/media/filter/img/sml/sources/ba_mastabam_small.jpg', '/media/filter/img/med/sources/ba_mastabam_med.jpg', 'http://www.kimseybert.com/detail.htm?collection=Spring_2011&params=1,42', '2011-07-13 00:06:49', NULL, '2011-07-13 00:06:49', '2011-07-13 00:06:49', 0.0, 0);
INSERT INTO `attachments` VALUES(112, 'co_mastabam.jpg', 'Boxes', 'image/jpeg', NULL, '106 KB', 'jpg', 'image', 530, 530, '/media/static/img/sources/co_mastabam.jpg', '/media/filter/img/sml/sources/co_mastabam_small.jpg', '/media/filter/img/med/sources/co_mastabam_med.jpg', '', '2011-07-13 00:15:13', NULL, '2011-07-13 00:15:14', '2011-07-13 00:15:14', 0.0, 0);
INSERT INTO `attachments` VALUES(113, 'gl_crocom.jpg', 'Mouth blown glasses', 'image/jpeg', NULL, '44 KB', 'jpg', 'image', 530, 530, '/media/static/img/sources/gl_crocom.jpg', '/media/filter/img/sml/sources/gl_crocom_small.jpg', '/media/filter/img/med/sources/gl_crocom_med.jpg', 'http://www.kimseybert.com/detail.htm?collection=Spring_2011&params=1,44', '2011-07-13 00:18:39', NULL, '2011-07-13 00:18:39', '2011-07-13 00:18:39', 0.0, 0);
INSERT INTO `attachments` VALUES(114, '6511m.jpg', 'Oval Napkin Ring', 'image/jpeg', NULL, '39 KB', 'jpg', 'image', 530, 530, '/media/static/img/sources/6511m.jpg', '/media/filter/img/sml/sources/6511m_small.jpg', '/media/filter/img/med/sources/6511m_med.jpg', 'http://www.kimseybert.com/detail.htm?Napkin_Rings=Oval_Bead_Burst_Napkin_Ring&params=5,7', '2011-07-13 00:26:51', NULL, '2011-07-13 00:26:51', '2011-07-13 00:26:51', 0.0, 0);
INSERT INTO `attachments` VALUES(116, 'nr6595m.jpg', 'Beat Knot Bracelet', 'image/jpeg', NULL, '177 KB', 'jpg', 'image', 530, 530, '/media/static/img/sources/nr6595m.jpg', '/media/filter/img/sml/sources/nr6595m_small.jpg', '/media/filter/img/med/sources/nr6595m_med.jpg', 'http://www.kimseybert.com/detail.htm?collection=Napkin_Rings&params=5,8', '2011-07-13 00:28:48', NULL, '2011-07-13 00:28:48', '2011-07-13 00:28:48', 0.0, 0);
INSERT INTO `attachments` VALUES(141, 'f_217542.jpg', '', 'image/jpeg', NULL, '48 KB', 'jpg', 'image', 281, 320, '/media/static/img/sources/f_217542.jpg', '/media/filter/img/sml/sources/f_217542_small.jpg', '/media/filter/img/med/sources/f_217542_med.jpg', '', '2011-07-31 05:36:45', NULL, '2011-07-31 05:36:45', '2011-07-31 05:36:45', 0.0, 0);
INSERT INTO `attachments` VALUES(120, 'NR5933m.jpg', 'Jewel cuff napkin ring', 'image/jpeg', NULL, '25 KB', 'jpg', 'image', 530, 530, '/media/static/img/sources/NR5933m.jpg', '/media/filter/img/sml/sources/NR5933m_small.jpg', '/media/filter/img/med/sources/NR5933m_med.jpg', 'http://www.kimseybert.com/detail.htm?collection=Napkin_Rings&params=5,9', '2011-07-13 00:41:16', NULL, '2011-07-13 00:41:16', '2011-07-13 00:41:16', 0.0, 0);
INSERT INTO `attachments` VALUES(124, 'casa-midy-orange-bucket.jpg', 'Leather handled ice bucket', 'image/jpeg', NULL, '71 KB', 'jpg', 'image', 475, 709, '/media/static/img/products/casa-midy-orange-bucket.jpg', '/media/filter/img/sml/products/casa-midy-orange-bucket_small.jpg', '/media/filter/img/med/products/casa-midy-orange-bucket_med.jpg', 'http://remodelista.com/posts/accessories-leather-handled-bucket-from-casamidy', '2011-07-15 15:12:10', NULL, '2011-07-15 15:12:11', '2011-07-15 15:12:11', 0.0, 0);
INSERT INTO `attachments` VALUES(125, 'Screen_shot_2011-07-17_at_12.17.30_PM.jpg', '', 'image/jpeg', 26707, '26 KB', 'jpg', 'image', 302, 407, '/media/static/img/products/Screen_shot_2011-07-17_at_12.17.30_PM.jpg', '/media/filter/img/sml/products/Screen_shot_2011-07-17_at_12.17.30_PM_small.jpg', '/media/filter/img/med/products/Screen_shot_2011-07-17_at_12.17.30_PM_med.jpg', 'http://www.jonathanadler.com/Beaded-548/?cat=', '2011-07-17 12:17:53', NULL, '2011-07-17 12:17:53', '2011-07-17 12:17:53', 0.0, 0);
INSERT INTO `attachments` VALUES(126, 'Screen_shot_2011-07-17_at_12.17.30_PM1.jpg', '', 'image/jpeg', 26707, '26 KB', 'jpg', 'image', 302, 407, '/media/static/img/products/Screen_shot_2011-07-17_at_12.17.30_PM1.jpg', '/media/filter/img/sml/products/Screen_shot_2011-07-17_at_12.17.30_PM1_small.jpg', '/media/filter/img/med/products/Screen_shot_2011-07-17_at_12.17.30_PM1_med.jpg', 'http://www.jonathanadler.com/Beaded-548/?cat=', '2011-07-17 12:18:09', NULL, '2011-07-17 12:18:09', '2011-07-17 12:18:09', 0.0, 0);
INSERT INTO `attachments` VALUES(127, 'Screen_shot_2011-07-17_at_12.17.30_PM2.jpg', '', 'image/jpeg', 26707, '26 KB', 'jpg', 'image', 302, 407, '/media/static/img/products/Screen_shot_2011-07-17_at_12.17.30_PM2.jpg', '/media/filter/img/sml/products/Screen_shot_2011-07-17_at_12.17.30_PM2_small.jpg', '/media/filter/img/med/products/Screen_shot_2011-07-17_at_12.17.30_PM2_med.jpg', 'http://www.jonathanadler.com/Beaded-548/?cat=', '2011-07-17 12:18:38', NULL, '2011-07-17 12:18:38', '2011-07-17 12:18:38', 0.0, 0);
INSERT INTO `attachments` VALUES(128, 'Screen_shot_2011-07-17_at_12.19.47_PM.jpg', '', 'image/jpeg', 55679, '54 KB', 'jpg', 'image', 438, 371, '/media/static/img/products/Screen_shot_2011-07-17_at_12.19.47_PM.jpg', '/media/filter/img/sml/products/Screen_shot_2011-07-17_at_12.19.47_PM_small.jpg', '/media/filter/img/med/products/Screen_shot_2011-07-17_at_12.19.47_PM_med.jpg', '', '2011-07-17 12:20:03', NULL, '2011-07-17 12:20:03', '2011-07-17 12:20:03', 0.0, 0);
INSERT INTO `attachments` VALUES(129, 'Screen_shot_2011-07-17_at_12.19.47_PM1.jpg', '', 'image/jpeg', 55679, '54 KB', 'jpg', 'image', 438, 371, '/media/static/img/products/Screen_shot_2011-07-17_at_12.19.47_PM1.jpg', '/media/filter/img/sml/products/Screen_shot_2011-07-17_at_12.19.47_PM1_small.jpg', '/media/filter/img/med/products/Screen_shot_2011-07-17_at_12.19.47_PM1_med.jpg', '', '2011-07-17 12:20:34', NULL, '2011-07-17 12:20:34', '2011-07-17 12:20:34', 0.0, 0);
INSERT INTO `attachments` VALUES(130, 'Screen_shot_2011-07-17_at_12.19.47_PM2.jpg', '', 'image/jpeg', 55679, '54 KB', 'jpg', 'image', 438, 371, '/media/static/img/products/Screen_shot_2011-07-17_at_12.19.47_PM2.jpg', '/media/filter/img/sml/products/Screen_shot_2011-07-17_at_12.19.47_PM2_small.jpg', '/media/filter/img/med/products/Screen_shot_2011-07-17_at_12.19.47_PM2_med.jpg', '', '2011-07-17 12:25:10', NULL, '2011-07-17 12:25:10', '2011-07-17 12:25:10', 0.0, 0);
INSERT INTO `attachments` VALUES(131, 'Screen_shot_2011-07-17_at_12.19.47_PM3.jpg', '', 'image/jpeg', 55679, '54 KB', 'jpg', 'image', 438, 371, '/media/static/img/products/Screen_shot_2011-07-17_at_12.19.47_PM3.jpg', '/media/filter/img/sml/products/Screen_shot_2011-07-17_at_12.19.47_PM3_small.jpg', '/media/filter/img/med/products/Screen_shot_2011-07-17_at_12.19.47_PM3_med.jpg', '', '2011-07-17 12:25:24', NULL, '2011-07-17 12:25:24', '2011-07-17 12:25:24', 0.0, 0);
INSERT INTO `attachments` VALUES(132, '4910508437_6119b7dcc3_o.jpg', '', 'image/jpeg', NULL, '51 KB', 'jpg', 'image', 528, 351, '/media/static/img/sources/4910508437_6119b7dcc3_o.jpg', '/media/filter/img/sml/sources/4910508437_6119b7dcc3_o_small.jpg', '/media/filter/img/med/sources/4910508437_6119b7dcc3_o_med.jpg', '', '2011-07-17 16:57:37', NULL, '2011-07-17 16:57:37', '2011-07-17 16:57:37', 0.0, 0);
INSERT INTO `attachments` VALUES(133, '4910508437_6119b7dcc3_o1.jpg', '', 'image/jpeg', NULL, '51 KB', 'jpg', 'image', 528, 351, '/media/static/img/sources/4910508437_6119b7dcc3_o1.jpg', '/media/filter/img/sml/sources/4910508437_6119b7dcc3_o1_small.jpg', '/media/filter/img/med/sources/4910508437_6119b7dcc3_o1_med.jpg', '', '2011-07-17 16:58:20', NULL, '2011-07-17 16:58:20', '2011-07-17 16:58:20', 0.0, 0);
INSERT INTO `attachments` VALUES(134, '1960STWINDINERSTOOLS_tn.jpg', '1970s black metal bubble chair', 'image/jpeg', NULL, '38 KB', 'jpg', 'image', 150, 150, '/media/static/img/products/1960STWINDINERSTOOLS_tn.jpg', '/media/filter/img/sml/products/1960STWINDINERSTOOLS_tn_small.jpg', '/media/filter/img/med/products/1960STWINDINERSTOOLS_tn_med.jpg', '', '2011-07-17 22:20:52', NULL, '2011-07-17 22:20:52', '2011-07-17 22:20:52', 0.0, 0);
INSERT INTO `attachments` VALUES(138, 'logo01.gif', '', 'image/gif', NULL, '5 KB', 'gif', 'image', 147, 109, '/media/static/img/sources/logo01.gif', '/media/filter/img/sml/sources/logo01_small.gif', '/media/filter/img/med/sources/logo01_med.gif', '', '2011-07-29 23:03:02', NULL, '2011-07-29 23:03:02', '2011-07-29 23:03:02', 0.0, 0);
INSERT INTO `attachments` VALUES(139, 'Screen_shot_2011-07-30_at_3.42.51_AM.jpg', '', 'image/jpeg', 36093, '35 KB', 'jpg', 'image', 493, 536, '/media/static/img/products/Screen_shot_2011-07-30_at_3.42.51_AM.jpg', '/media/filter/img/sml/products/Screen_shot_2011-07-30_at_3.42.51_AM_small.jpg', '/media/filter/img/med/products/Screen_shot_2011-07-30_at_3.42.51_AM_med.jpg', 'http://www.dwr.com/product/era-round-arm-with-cane.do', '2011-07-30 03:43:34', NULL, '2011-07-30 03:43:34', '2011-07-30 03:43:34', 0.0, 0);
INSERT INTO `attachments` VALUES(137, 'f_21754.jpg', '', 'image/jpeg', NULL, '48 KB', 'jpg', 'image', 281, 320, '/media/static/img/sources/f_21754.jpg', '/media/filter/img/sml/sources/f_21754_small.jpg', '/media/filter/img/med/sources/f_21754_med.jpg', '', '2011-07-29 22:41:46', NULL, '2011-07-29 22:41:46', '2011-07-29 22:41:46', 0.0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `attachments_clients`
--

CREATE TABLE `attachments_clients` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `client_id` int(10) NOT NULL,
  `attachment_id` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `attachments_clients`
--

INSERT INTO `attachments_clients` VALUES(1, 1, 7);

-- --------------------------------------------------------

--
-- Table structure for table `attachments_contractors`
--

CREATE TABLE `attachments_contractors` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `contractor_id` int(10) NOT NULL,
  `attachment_id` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `attachments_contractors`
--

INSERT INTO `attachments_contractors` VALUES(1, 3, 14);

-- --------------------------------------------------------

--
-- Table structure for table `attachments_houses`
--

CREATE TABLE `attachments_houses` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `house_id` int(10) NOT NULL,
  `attachment_id` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `attachments_houses`
--

INSERT INTO `attachments_houses` VALUES(1, 1, 16);

-- --------------------------------------------------------

--
-- Table structure for table `attachments_inspirations`
--

CREATE TABLE `attachments_inspirations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `inspiration_id` int(10) NOT NULL,
  `attachment_id` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `attachments_inspirations`
--

INSERT INTO `attachments_inspirations` VALUES(3, 1, 18);
INSERT INTO `attachments_inspirations` VALUES(5, 1, 20);
INSERT INTO `attachments_inspirations` VALUES(6, 1, 21);

-- --------------------------------------------------------

--
-- Table structure for table `attachments_products`
--

CREATE TABLE `attachments_products` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `attachment_id` int(10) NOT NULL,
  `product_id` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=117 ;

--
-- Dumping data for table `attachments_products`
--

INSERT INTO `attachments_products` VALUES(111, 131, 50);
INSERT INTO `attachments_products` VALUES(106, 126, 45);
INSERT INTO `attachments_products` VALUES(103, 123, 42);
INSERT INTO `attachments_products` VALUES(113, 139, 52);

-- --------------------------------------------------------

--
-- Table structure for table `attachments_sources`
--

CREATE TABLE `attachments_sources` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `source_id` int(10) NOT NULL,
  `attachment_id` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=145 ;

--
-- Dumping data for table `attachments_sources`
--

INSERT INTO `attachments_sources` VALUES(97, 5, 133);
INSERT INTO `attachments_sources` VALUES(96, 5, 13);
INSERT INTO `attachments_sources` VALUES(95, 5, 12);
INSERT INTO `attachments_sources` VALUES(94, 5, 11);
INSERT INTO `attachments_sources` VALUES(93, 5, 10);
INSERT INTO `attachments_sources` VALUES(92, 5, 5);
INSERT INTO `attachments_sources` VALUES(91, 5, 4);
INSERT INTO `attachments_sources` VALUES(90, 5, 3);
INSERT INTO `attachments_sources` VALUES(89, 5, 2);
INSERT INTO `attachments_sources` VALUES(88, 5, 1);
INSERT INTO `attachments_sources` VALUES(14, 3, 17);
INSERT INTO `attachments_sources` VALUES(120, 16, 22);
INSERT INTO `attachments_sources` VALUES(119, 16, 23);
INSERT INTO `attachments_sources` VALUES(118, 16, 33);
INSERT INTO `attachments_sources` VALUES(117, 16, 34);
INSERT INTO `attachments_sources` VALUES(116, 16, 35);
INSERT INTO `attachments_sources` VALUES(115, 16, 37);
INSERT INTO `attachments_sources` VALUES(86, 36, 120);
INSERT INTO `attachments_sources` VALUES(82, 36, 116);
INSERT INTO `attachments_sources` VALUES(144, 2, 141);
INSERT INTO `attachments_sources` VALUES(80, 36, 114);
INSERT INTO `attachments_sources` VALUES(64, 33, 66);
INSERT INTO `attachments_sources` VALUES(74, 36, 108);
INSERT INTO `attachments_sources` VALUES(79, 36, 113);
INSERT INTO `attachments_sources` VALUES(78, 36, 112);
INSERT INTO `attachments_sources` VALUES(75, 36, 109);

-- --------------------------------------------------------

--
-- Table structure for table `attachment_tags`
--

CREATE TABLE `attachment_tags` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `attachment_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `x1` int(11) DEFAULT NULL,
  `y1` int(11) DEFAULT NULL,
  `x2` int(11) DEFAULT NULL,
  `y2` int(11) DEFAULT NULL,
  `width` int(11) DEFAULT NULL,
  `height` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `attachment_tags`
--

INSERT INTO `attachment_tags` VALUES(2, 92, 'My other tag', 289, 388, 351, 450, 62, 62);
INSERT INTO `attachment_tags` VALUES(8, 92, 'My Tag', 209, 176, 366, 295, 157, 119);

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` longtext,
  `address1` varchar(255) DEFAULT NULL,
  `address2` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `zip` varchar(255) DEFAULT NULL,
  `country_id` int(10) unsigned DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `fax` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `job_title` varchar(255) DEFAULT NULL,
  `total_children` int(10) DEFAULT NULL,
  `salary_range` varchar(255) DEFAULT NULL,
  `style_description` longtext,
  `personal_description` longtext,
  `favorite_colors` varchar(255) DEFAULT NULL,
  `favorite_patterns` varchar(255) DEFAULT NULL,
  `favorite_designers` varchar(255) DEFAULT NULL,
  `user_id` int(10) DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `rating` decimal(3,1) unsigned DEFAULT '0.0',
  `votes` int(11) unsigned DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`,`slug`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` VALUES(1, 'Kate Tapia', 'kate-tapia', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using ''Content here, content here'', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for ''lorem ipsum'' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', '2207 Northeast Broadway Street', '', 'Portland', 'OR', '97210', 237, '(503) 493-7332', '(503) 493-7332', 'http://kate.com', '', 0, '', '', '', 'red, purple, yellow', 'ikat', '', NULL, '2011-07-05 21:14:23', '2011-07-08 00:43:28', 0.0, 0);
INSERT INTO `clients` VALUES(11, 'Test Client 2', 'test-client-2', 'Some description', '', '', '', '', NULL, 24, '', '', 'http://somewhere.com', '', NULL, NULL, '', '', '', '', '', NULL, '2011-07-14 02:12:59', '2011-07-14 02:17:03', 0.0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `collections`
--

CREATE TABLE `collections` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` mediumtext,
  `credit` varchar(255) DEFAULT NULL,
  `user_id` int(10) DEFAULT NULL,
  `total_products` int(10) DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `rating` decimal(3,1) unsigned DEFAULT '0.0',
  `votes` int(11) unsigned DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `collections`
--

INSERT INTO `collections` VALUES(1, 'The Bucket List', '', '', '', 1, 1, '2011-07-11 16:17:22', '2011-07-31 18:08:09', 4.0, 1);
INSERT INTO `collections` VALUES(2, 'Some New Collection', '', '', 'Rob', 1, 3, '2011-07-14 02:59:15', '2011-07-31 18:27:27', 0.0, 0);
INSERT INTO `collections` VALUES(3, 'Testing collections', '', '', 'Rob Sawyer', 1, 1, '2011-07-29 17:27:37', '2011-07-31 04:19:58', 3.0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `collections_products`
--

CREATE TABLE `collections_products` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `collection_id` int(10) NOT NULL,
  `product_id` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=135 ;

--
-- Dumping data for table `collections_products`
--

INSERT INTO `collections_products` VALUES(77, 3, 52);
INSERT INTO `collections_products` VALUES(134, 2, 42);
INSERT INTO `collections_products` VALUES(58, 1, 42);
INSERT INTO `collections_products` VALUES(133, 2, 45);
INSERT INTO `collections_products` VALUES(132, 2, 50);

-- --------------------------------------------------------

--
-- Table structure for table `contractors`
--

CREATE TABLE `contractors` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `contractor_specialty_id` int(10) unsigned DEFAULT NULL,
  `slug` varchar(255) NOT NULL,
  `description` longtext,
  `address1` varchar(255) DEFAULT NULL,
  `address2` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `zip` varchar(255) DEFAULT NULL,
  `country_id` int(10) unsigned DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `fax` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `user_id` int(10) DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `rating` decimal(3,1) unsigned DEFAULT '0.0',
  `votes` int(11) unsigned DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`,`slug`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `contractors`
--

INSERT INTO `contractors` VALUES(3, 'Painting Hanger', 9, 'painting-hanger', 'Yep this person hangs paintings.', '', '', 'Selma', 'AL.', '97210', 237, '(504) 556-1100', 'hanger@hangers.com', '', 'http://painterville.com', NULL, '2011-07-06 17:42:42', '2011-07-10 00:33:57', 0.0, 0);
INSERT INTO `contractors` VALUES(4, 'Kate Tapia', 10, 'kate-tapia', '', '', '', 'Portland', 'OR.', '97210', 237, '', 'ketapia@gmail.com', '', 'http://www.test.com', NULL, '2011-07-06 23:22:18', '2011-07-10 00:37:11', 0.0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `contractors_sources`
--

CREATE TABLE `contractors_sources` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `source_id` int(10) NOT NULL,
  `contractor_id` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `contractors_sources`
--

INSERT INTO `contractors_sources` VALUES(23, 5, 3);
INSERT INTO `contractors_sources` VALUES(21, 1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `contractor_specialties`
--

CREATE TABLE `contractor_specialties` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `user_id` int(10) DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `contractor_specialties`
--

INSERT INTO `contractor_specialties` VALUES(1, 'Flooring', 'flooring', NULL, '2011-07-07 23:33:37', '2011-07-07 23:33:37');
INSERT INTO `contractor_specialties` VALUES(2, 'Fencing', 'fencing', NULL, '2011-07-07 23:35:47', '2011-07-07 23:35:47');
INSERT INTO `contractor_specialties` VALUES(3, 'Plumbing', 'plumbing', NULL, '2011-07-08 00:09:50', '2011-07-08 00:09:50');
INSERT INTO `contractor_specialties` VALUES(4, 'Structural', 'structural', NULL, '2011-07-08 00:09:55', '2011-07-08 00:09:55');
INSERT INTO `contractor_specialties` VALUES(5, 'Electrical', 'electrical', NULL, '2011-07-08 00:15:56', '2011-07-08 00:15:56');
INSERT INTO `contractor_specialties` VALUES(6, 'Tile', 'tile', NULL, '2011-07-08 00:16:30', '2011-07-08 00:16:30');
INSERT INTO `contractor_specialties` VALUES(7, 'Exterior Siding', 'exterior-siding', NULL, '2011-07-08 00:17:08', '2011-07-08 00:17:08');
INSERT INTO `contractor_specialties` VALUES(8, 'Roofing', 'roofing', NULL, '2011-07-08 00:17:12', '2011-07-08 00:17:12');
INSERT INTO `contractor_specialties` VALUES(9, 'Painting', 'painting', NULL, '2011-07-08 00:35:48', '2011-07-08 00:35:48');
INSERT INTO `contractor_specialties` VALUES(10, 'General', 'general', NULL, '2011-07-10 00:36:51', '2011-07-10 00:36:51');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=253 ;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` VALUES(1, 'Afghanistan');
INSERT INTO `countries` VALUES(2, 'Albania');
INSERT INTO `countries` VALUES(3, 'Algeria');
INSERT INTO `countries` VALUES(4, 'American Samoa');
INSERT INTO `countries` VALUES(5, 'Andorra');
INSERT INTO `countries` VALUES(6, 'Angola');
INSERT INTO `countries` VALUES(7, 'Anguilla');
INSERT INTO `countries` VALUES(8, 'Antarctica');
INSERT INTO `countries` VALUES(9, 'Antigua and Barbuda');
INSERT INTO `countries` VALUES(10, 'Argentina');
INSERT INTO `countries` VALUES(11, 'Armenia');
INSERT INTO `countries` VALUES(12, 'Armenia');
INSERT INTO `countries` VALUES(13, 'Aruba');
INSERT INTO `countries` VALUES(14, 'Australia');
INSERT INTO `countries` VALUES(15, 'Austria');
INSERT INTO `countries` VALUES(16, 'Azerbaijan');
INSERT INTO `countries` VALUES(17, 'Azerbaijan');
INSERT INTO `countries` VALUES(18, 'Bahamas');
INSERT INTO `countries` VALUES(19, 'Bahrain');
INSERT INTO `countries` VALUES(20, 'Bangladesh');
INSERT INTO `countries` VALUES(21, 'Barbados');
INSERT INTO `countries` VALUES(22, 'Belarus');
INSERT INTO `countries` VALUES(23, 'Belgium');
INSERT INTO `countries` VALUES(24, 'Belize');
INSERT INTO `countries` VALUES(25, 'Benin');
INSERT INTO `countries` VALUES(26, 'Bermuda');
INSERT INTO `countries` VALUES(27, 'Bhutan');
INSERT INTO `countries` VALUES(28, 'Bolivia');
INSERT INTO `countries` VALUES(29, 'Bosnia and Herzegovina');
INSERT INTO `countries` VALUES(30, 'Botswana');
INSERT INTO `countries` VALUES(31, 'Bouvet Island');
INSERT INTO `countries` VALUES(32, 'Brazil');
INSERT INTO `countries` VALUES(33, 'British Indian Ocean Territory');
INSERT INTO `countries` VALUES(34, 'Brunei Darussalam');
INSERT INTO `countries` VALUES(35, 'Bulgaria');
INSERT INTO `countries` VALUES(36, 'Burkina Faso');
INSERT INTO `countries` VALUES(37, 'Burundi');
INSERT INTO `countries` VALUES(38, 'Cambodia');
INSERT INTO `countries` VALUES(39, 'Cameroon');
INSERT INTO `countries` VALUES(40, 'Canada');
INSERT INTO `countries` VALUES(41, 'Cape Verde');
INSERT INTO `countries` VALUES(42, 'Cayman Islands');
INSERT INTO `countries` VALUES(43, 'Central African Republic');
INSERT INTO `countries` VALUES(44, 'Chad');
INSERT INTO `countries` VALUES(45, 'Chile');
INSERT INTO `countries` VALUES(46, 'China');
INSERT INTO `countries` VALUES(47, 'Christmas Island');
INSERT INTO `countries` VALUES(48, 'Cocos (Keeling) Islands');
INSERT INTO `countries` VALUES(49, 'Colombia');
INSERT INTO `countries` VALUES(50, 'Comoros');
INSERT INTO `countries` VALUES(51, 'Congo');
INSERT INTO `countries` VALUES(52, 'Congo, The Democratic Republic of The');
INSERT INTO `countries` VALUES(53, 'Cook Islands');
INSERT INTO `countries` VALUES(54, 'Costa Rica');
INSERT INTO `countries` VALUES(55, 'Cote D''ivoire');
INSERT INTO `countries` VALUES(56, 'Croatia');
INSERT INTO `countries` VALUES(57, 'Cuba');
INSERT INTO `countries` VALUES(58, 'Cyprus');
INSERT INTO `countries` VALUES(59, 'Cyprus');
INSERT INTO `countries` VALUES(60, 'Czech Republic');
INSERT INTO `countries` VALUES(61, 'Denmark');
INSERT INTO `countries` VALUES(62, 'Djibouti');
INSERT INTO `countries` VALUES(63, 'Dominica');
INSERT INTO `countries` VALUES(64, 'Dominican Republic');
INSERT INTO `countries` VALUES(65, 'Easter Island');
INSERT INTO `countries` VALUES(66, 'Ecuador');
INSERT INTO `countries` VALUES(67, 'Egypt');
INSERT INTO `countries` VALUES(68, 'El Salvador');
INSERT INTO `countries` VALUES(69, 'Equatorial Guinea');
INSERT INTO `countries` VALUES(70, 'Eritrea');
INSERT INTO `countries` VALUES(71, 'Estonia');
INSERT INTO `countries` VALUES(72, 'Ethiopia');
INSERT INTO `countries` VALUES(73, 'Falkland Islands (Malvinas)');
INSERT INTO `countries` VALUES(74, 'Faroe Islands');
INSERT INTO `countries` VALUES(75, 'Fiji');
INSERT INTO `countries` VALUES(76, 'Finland');
INSERT INTO `countries` VALUES(77, 'France');
INSERT INTO `countries` VALUES(78, 'French Guiana');
INSERT INTO `countries` VALUES(79, 'French Polynesia');
INSERT INTO `countries` VALUES(80, 'French Southern Territories');
INSERT INTO `countries` VALUES(81, 'Gabon');
INSERT INTO `countries` VALUES(82, 'Gambia');
INSERT INTO `countries` VALUES(83, 'Georgia');
INSERT INTO `countries` VALUES(84, 'Georgia');
INSERT INTO `countries` VALUES(85, 'Germany');
INSERT INTO `countries` VALUES(86, 'Ghana');
INSERT INTO `countries` VALUES(87, 'Gibraltar');
INSERT INTO `countries` VALUES(88, 'Greece');
INSERT INTO `countries` VALUES(89, 'Greenland');
INSERT INTO `countries` VALUES(90, 'Greenland');
INSERT INTO `countries` VALUES(91, 'Grenada');
INSERT INTO `countries` VALUES(92, 'Guadeloupe');
INSERT INTO `countries` VALUES(93, 'Guam');
INSERT INTO `countries` VALUES(94, 'Guatemala');
INSERT INTO `countries` VALUES(95, 'Guinea');
INSERT INTO `countries` VALUES(96, 'Guinea-bissau');
INSERT INTO `countries` VALUES(97, 'Guyana');
INSERT INTO `countries` VALUES(98, 'Haiti');
INSERT INTO `countries` VALUES(99, 'Heard Island and Mcdonald Islands');
INSERT INTO `countries` VALUES(100, 'Honduras');
INSERT INTO `countries` VALUES(101, 'Hong Kong');
INSERT INTO `countries` VALUES(102, 'Hungary');
INSERT INTO `countries` VALUES(103, 'Iceland');
INSERT INTO `countries` VALUES(104, 'India');
INSERT INTO `countries` VALUES(105, 'Indonesia');
INSERT INTO `countries` VALUES(106, 'Indonesia');
INSERT INTO `countries` VALUES(107, 'Iran');
INSERT INTO `countries` VALUES(108, 'Iraq');
INSERT INTO `countries` VALUES(109, 'Ireland');
INSERT INTO `countries` VALUES(110, 'Israel');
INSERT INTO `countries` VALUES(111, 'Italy');
INSERT INTO `countries` VALUES(112, 'Jamaica');
INSERT INTO `countries` VALUES(113, 'Japan');
INSERT INTO `countries` VALUES(114, 'Jordan');
INSERT INTO `countries` VALUES(115, 'Kazakhstan');
INSERT INTO `countries` VALUES(116, 'Kazakhstan');
INSERT INTO `countries` VALUES(117, 'Kenya');
INSERT INTO `countries` VALUES(118, 'Kiribati');
INSERT INTO `countries` VALUES(119, 'Korea, North');
INSERT INTO `countries` VALUES(120, 'Korea, South');
INSERT INTO `countries` VALUES(121, 'Kosovo');
INSERT INTO `countries` VALUES(122, 'Kuwait');
INSERT INTO `countries` VALUES(123, 'Kyrgyzstan');
INSERT INTO `countries` VALUES(124, 'Laos');
INSERT INTO `countries` VALUES(125, 'Latvia');
INSERT INTO `countries` VALUES(126, 'Lebanon');
INSERT INTO `countries` VALUES(127, 'Lesotho');
INSERT INTO `countries` VALUES(128, 'Liberia');
INSERT INTO `countries` VALUES(129, 'Libyan Arab Jamahiriya');
INSERT INTO `countries` VALUES(130, 'Liechtenstein');
INSERT INTO `countries` VALUES(131, 'Lithuania');
INSERT INTO `countries` VALUES(132, 'Luxembourg');
INSERT INTO `countries` VALUES(133, 'Macau');
INSERT INTO `countries` VALUES(134, 'Macedonia');
INSERT INTO `countries` VALUES(135, 'Madagascar');
INSERT INTO `countries` VALUES(136, 'Malawi');
INSERT INTO `countries` VALUES(137, 'Malaysia');
INSERT INTO `countries` VALUES(138, 'Maldives');
INSERT INTO `countries` VALUES(139, 'Mali');
INSERT INTO `countries` VALUES(140, 'Malta');
INSERT INTO `countries` VALUES(141, 'Marshall Islands');
INSERT INTO `countries` VALUES(142, 'Martinique');
INSERT INTO `countries` VALUES(143, 'Mauritania');
INSERT INTO `countries` VALUES(144, 'Mauritius');
INSERT INTO `countries` VALUES(145, 'Mayotte');
INSERT INTO `countries` VALUES(146, 'Mexico');
INSERT INTO `countries` VALUES(147, 'Micronesia, Federated States of');
INSERT INTO `countries` VALUES(148, 'Moldova, Republic of');
INSERT INTO `countries` VALUES(149, 'Monaco');
INSERT INTO `countries` VALUES(150, 'Mongolia');
INSERT INTO `countries` VALUES(151, 'Montenegro');
INSERT INTO `countries` VALUES(152, 'Montserrat');
INSERT INTO `countries` VALUES(153, 'Morocco');
INSERT INTO `countries` VALUES(154, 'Mozambique');
INSERT INTO `countries` VALUES(155, 'Myanmar');
INSERT INTO `countries` VALUES(156, 'Namibia');
INSERT INTO `countries` VALUES(157, 'Nauru');
INSERT INTO `countries` VALUES(158, 'Nepal');
INSERT INTO `countries` VALUES(159, 'Netherlands');
INSERT INTO `countries` VALUES(160, 'Netherlands Antilles');
INSERT INTO `countries` VALUES(161, 'New Caledonia');
INSERT INTO `countries` VALUES(162, 'New Zealand');
INSERT INTO `countries` VALUES(163, 'Nicaragua');
INSERT INTO `countries` VALUES(164, 'Niger');
INSERT INTO `countries` VALUES(165, 'Nigeria');
INSERT INTO `countries` VALUES(166, 'Niue');
INSERT INTO `countries` VALUES(167, 'Norfolk Island');
INSERT INTO `countries` VALUES(168, 'Northern Mariana Islands');
INSERT INTO `countries` VALUES(169, 'Norway');
INSERT INTO `countries` VALUES(170, 'Oman');
INSERT INTO `countries` VALUES(171, 'Pakistan');
INSERT INTO `countries` VALUES(172, 'Palau');
INSERT INTO `countries` VALUES(173, 'Palestinian Territory');
INSERT INTO `countries` VALUES(174, 'Panama');
INSERT INTO `countries` VALUES(175, 'Papua New Guinea');
INSERT INTO `countries` VALUES(176, 'Paraguay');
INSERT INTO `countries` VALUES(177, 'Peru');
INSERT INTO `countries` VALUES(178, 'Philippines');
INSERT INTO `countries` VALUES(179, 'Pitcairn');
INSERT INTO `countries` VALUES(180, 'Poland');
INSERT INTO `countries` VALUES(181, 'Portugal');
INSERT INTO `countries` VALUES(182, 'Puerto Rico');
INSERT INTO `countries` VALUES(183, 'Qatar');
INSERT INTO `countries` VALUES(184, 'Reunion');
INSERT INTO `countries` VALUES(185, 'Romania');
INSERT INTO `countries` VALUES(186, 'Russia');
INSERT INTO `countries` VALUES(187, 'Russia');
INSERT INTO `countries` VALUES(188, 'Rwanda');
INSERT INTO `countries` VALUES(189, 'Saint Helena');
INSERT INTO `countries` VALUES(190, 'Saint Kitts and Nevis');
INSERT INTO `countries` VALUES(191, 'Saint Lucia');
INSERT INTO `countries` VALUES(192, 'Saint Pierre and Miquelon');
INSERT INTO `countries` VALUES(193, 'Saint Vincent and The Grenadines');
INSERT INTO `countries` VALUES(194, 'Samoa');
INSERT INTO `countries` VALUES(195, 'San Marino');
INSERT INTO `countries` VALUES(196, 'Sao Tome and Principe');
INSERT INTO `countries` VALUES(197, 'Saudi Arabia');
INSERT INTO `countries` VALUES(198, 'Senegal');
INSERT INTO `countries` VALUES(199, 'Serbia and Montenegro');
INSERT INTO `countries` VALUES(200, 'Seychelles');
INSERT INTO `countries` VALUES(201, 'Sierra Leone');
INSERT INTO `countries` VALUES(202, 'Singapore');
INSERT INTO `countries` VALUES(203, 'Slovakia');
INSERT INTO `countries` VALUES(204, 'Slovenia');
INSERT INTO `countries` VALUES(205, 'Solomon Islands');
INSERT INTO `countries` VALUES(206, 'Somalia');
INSERT INTO `countries` VALUES(207, 'South Africa');
INSERT INTO `countries` VALUES(208, 'South Georgia and The South Sandwich Islands');
INSERT INTO `countries` VALUES(209, 'Spain');
INSERT INTO `countries` VALUES(210, 'Sri Lanka');
INSERT INTO `countries` VALUES(211, 'Sudan');
INSERT INTO `countries` VALUES(212, 'Suriname');
INSERT INTO `countries` VALUES(213, 'Svalbard and Jan Mayen');
INSERT INTO `countries` VALUES(214, 'Swaziland');
INSERT INTO `countries` VALUES(215, 'Sweden');
INSERT INTO `countries` VALUES(216, 'Switzerland');
INSERT INTO `countries` VALUES(217, 'Syria');
INSERT INTO `countries` VALUES(218, 'Taiwan');
INSERT INTO `countries` VALUES(219, 'Tajikistan');
INSERT INTO `countries` VALUES(220, 'Tanzania, United Republic of');
INSERT INTO `countries` VALUES(221, 'Thailand');
INSERT INTO `countries` VALUES(222, 'Timor-leste');
INSERT INTO `countries` VALUES(223, 'Togo');
INSERT INTO `countries` VALUES(224, 'Tokelau');
INSERT INTO `countries` VALUES(225, 'Tonga');
INSERT INTO `countries` VALUES(226, 'Trinidad and Tobago');
INSERT INTO `countries` VALUES(227, 'Tunisia');
INSERT INTO `countries` VALUES(228, 'Turkey');
INSERT INTO `countries` VALUES(229, 'Turkey');
INSERT INTO `countries` VALUES(230, 'Turkmenistan');
INSERT INTO `countries` VALUES(231, 'Turks and Caicos Islands');
INSERT INTO `countries` VALUES(232, 'Tuvalu');
INSERT INTO `countries` VALUES(233, 'Uganda');
INSERT INTO `countries` VALUES(234, 'Ukraine');
INSERT INTO `countries` VALUES(235, 'United Arab Emirates');
INSERT INTO `countries` VALUES(236, 'United Kingdom');
INSERT INTO `countries` VALUES(237, 'United States');
INSERT INTO `countries` VALUES(238, 'United States Minor Outlying Islands');
INSERT INTO `countries` VALUES(239, 'Uruguay');
INSERT INTO `countries` VALUES(240, 'Uzbekistan');
INSERT INTO `countries` VALUES(241, 'Vanuatu');
INSERT INTO `countries` VALUES(242, 'Vatican City');
INSERT INTO `countries` VALUES(243, 'Venezuela');
INSERT INTO `countries` VALUES(244, 'Vietnam');
INSERT INTO `countries` VALUES(245, 'Virgin Islands, British');
INSERT INTO `countries` VALUES(246, 'Virgin Islands, U.S.');
INSERT INTO `countries` VALUES(247, 'Wallis and Futuna');
INSERT INTO `countries` VALUES(248, 'Western Sahara');
INSERT INTO `countries` VALUES(249, 'Yemen');
INSERT INTO `countries` VALUES(250, 'Yemen');
INSERT INTO `countries` VALUES(251, 'Zambia');
INSERT INTO `countries` VALUES(252, 'Zimbabwe');

-- --------------------------------------------------------

--
-- Table structure for table `forum_access`
--

CREATE TABLE `forum_access` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `access_level_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `access_level_id` (`access_level_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Users with certain access' AUTO_INCREMENT=2 ;

--
-- Dumping data for table `forum_access`
--

INSERT INTO `forum_access` VALUES(1, 4, 1, '2011-07-29 14:42:20');

-- --------------------------------------------------------

--
-- Table structure for table `forum_access_levels`
--

CREATE TABLE `forum_access_levels` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(30) NOT NULL,
  `level` int(11) NOT NULL,
  `is_admin` smallint(6) NOT NULL DEFAULT '0',
  `is_super` smallint(6) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Access levels for users' AUTO_INCREMENT=5 ;

--
-- Dumping data for table `forum_access_levels`
--

INSERT INTO `forum_access_levels` VALUES(1, 'Member', 1, 0, 0);
INSERT INTO `forum_access_levels` VALUES(2, 'Moderator', 4, 0, 0);
INSERT INTO `forum_access_levels` VALUES(3, 'Super Moderator', 7, 0, 1);
INSERT INTO `forum_access_levels` VALUES(4, 'Administrator', 10, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `forum_forums`
--

CREATE TABLE `forum_forums` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `access_level_id` smallint(6) NOT NULL DEFAULT '0',
  `title` varchar(50) NOT NULL,
  `slug` varchar(60) NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '0',
  `orderNo` smallint(6) NOT NULL DEFAULT '0',
  `accessView` smallint(6) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `access_level_id` (`access_level_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Containing forums' AUTO_INCREMENT=3 ;

--
-- Dumping data for table `forum_forums`
--

INSERT INTO `forum_forums` VALUES(2, 0, 'The Source Forum', 'the-source-forum', 0, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `forum_forum_categories`
--

CREATE TABLE `forum_forum_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `forum_id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `access_level_id` smallint(6) NOT NULL DEFAULT '0',
  `title` varchar(50) NOT NULL,
  `slug` varchar(60) NOT NULL,
  `description` varchar(255) NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '0',
  `orderNo` smallint(6) NOT NULL DEFAULT '0',
  `topic_count` int(11) NOT NULL DEFAULT '0',
  `post_count` int(11) NOT NULL DEFAULT '0',
  `accessRead` smallint(6) NOT NULL DEFAULT '0',
  `accessPost` smallint(6) NOT NULL DEFAULT '1',
  `accessReply` smallint(6) NOT NULL DEFAULT '1',
  `accessPoll` smallint(6) NOT NULL DEFAULT '1',
  `settingPostCount` smallint(6) NOT NULL DEFAULT '1',
  `settingAutoLock` smallint(6) NOT NULL DEFAULT '1',
  `lastTopic_id` int(11) NOT NULL DEFAULT '0',
  `lastPost_id` int(11) NOT NULL DEFAULT '0',
  `lastUser_id` int(11) NOT NULL DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `lastTopic_id` (`lastTopic_id`),
  KEY `lastPost_id` (`lastPost_id`),
  KEY `lastUser_id` (`lastUser_id`),
  KEY `forum_id` (`forum_id`),
  KEY `parent_id` (`parent_id`),
  KEY `access_level_id` (`access_level_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Forum categories to post topics to' AUTO_INCREMENT=3 ;

--
-- Dumping data for table `forum_forum_categories`
--

INSERT INTO `forum_forum_categories` VALUES(1, 2, 0, 0, 'General Discussion', 'general-discussion', 'This is a forum category, which is a child of the forum. You can add, edit or delete these categories by visiting the administration panel, but first you would need to give a user admin rights.', 0, 1, 1, 1, 0, 1, 1, 1, 0, 0, 1, 1, 1, '2011-07-29 14:36:34', '2011-07-29 15:07:22');
INSERT INTO `forum_forum_categories` VALUES(2, 2, 0, 0, 'Competitions', 'competitions', 'This category contains competitions.', 0, 2, 1, 1, 0, 7, 1, 10, 1, 0, 2, 2, 1, '2011-07-30 03:57:22', '2011-07-30 03:59:51');

-- --------------------------------------------------------

--
-- Table structure for table `forum_moderators`
--

CREATE TABLE `forum_moderators` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `forum_category_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `forum_category_id` (`forum_category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Moderators to forums' AUTO_INCREMENT=1 ;

--
-- Dumping data for table `forum_moderators`
--


-- --------------------------------------------------------

--
-- Table structure for table `forum_polls`
--

CREATE TABLE `forum_polls` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `topic_id` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `expires` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `topic_id` (`topic_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Polls attached to topics' AUTO_INCREMENT=1 ;

--
-- Dumping data for table `forum_polls`
--


-- --------------------------------------------------------

--
-- Table structure for table `forum_poll_options`
--

CREATE TABLE `forum_poll_options` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `poll_id` int(11) NOT NULL,
  `option` varchar(100) NOT NULL,
  `vote_count` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `poll_id` (`poll_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Options/Questions for a poll' AUTO_INCREMENT=1 ;

--
-- Dumping data for table `forum_poll_options`
--


-- --------------------------------------------------------

--
-- Table structure for table `forum_poll_votes`
--

CREATE TABLE `forum_poll_votes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `poll_id` int(11) NOT NULL,
  `poll_option_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `poll_id` (`poll_id`),
  KEY `poll_option_id` (`poll_option_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Votes for polls' AUTO_INCREMENT=1 ;

--
-- Dumping data for table `forum_poll_votes`
--


-- --------------------------------------------------------

--
-- Table structure for table `forum_posts`
--

CREATE TABLE `forum_posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `topic_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `userIP` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `topic_id` (`topic_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Posts to topics' AUTO_INCREMENT=3 ;

--
-- Dumping data for table `forum_posts`
--

INSERT INTO `forum_posts` VALUES(1, 1, 1, '127.0.0.1', 'Hi, I''m Rob.\r\n\r\nI''m running this ship and I want to know who''s onboard. Introduce yourself.', '2011-07-29 15:07:21', '2011-07-29 15:07:21');
INSERT INTO `forum_posts` VALUES(2, 2, 1, '127.0.0.1', 'Once you find the products that you like, [url=/admin/products/add]add them[/url] to the system and then to a [url=/collections]collection[/url] and share it.', '2011-07-30 03:59:51', '2011-07-30 03:59:51');

-- --------------------------------------------------------

--
-- Table structure for table `forum_reported`
--

CREATE TABLE `forum_reported` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(11) NOT NULL,
  `itemType` varchar(15) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `item_id` (`item_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Reported topics, posts, users, etc' AUTO_INCREMENT=1 ;

--
-- Dumping data for table `forum_reported`
--


-- --------------------------------------------------------

--
-- Table structure for table `forum_topics`
--

CREATE TABLE `forum_topics` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `forum_category_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `slug` varchar(110) NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '0',
  `type` smallint(6) NOT NULL DEFAULT '0',
  `post_count` int(11) NOT NULL DEFAULT '0',
  `view_count` int(11) NOT NULL DEFAULT '0',
  `firstPost_id` int(11) NOT NULL,
  `lastPost_id` int(11) NOT NULL,
  `lastUser_id` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `firstPost_id` (`firstPost_id`),
  KEY `lastPost_id` (`lastPost_id`),
  KEY `lastUser_id` (`lastUser_id`),
  KEY `forum_category_id` (`forum_category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Discussion topics' AUTO_INCREMENT=3 ;

--
-- Dumping data for table `forum_topics`
--

INSERT INTO `forum_topics` VALUES(1, 1, 1, 'Hi Everyone, Introduce Yourself.', 'hi-everyone-introduce-yourself', 0, 1, 1, 10, 1, 1, 1, '2011-07-29 15:07:21', '2011-07-29 15:07:21');
INSERT INTO `forum_topics` VALUES(2, 2, 1, 'What are some of your favorite pieces from DWR?', 'what-are-some-of-your-favorite-pieces-from-dwr', 0, 0, 1, 69, 2, 2, 1, '2011-07-30 03:59:51', '2011-07-30 03:59:51');

-- --------------------------------------------------------

--
-- Table structure for table `houses`
--

CREATE TABLE `houses` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `client_id` int(10) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` longtext,
  `address1` varchar(255) DEFAULT NULL,
  `address2` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `zip` varchar(255) DEFAULT NULL,
  `country_id` int(10) unsigned DEFAULT NULL,
  `bedrooms` int(10) DEFAULT NULL,
  `bathrooms` int(10) DEFAULT NULL,
  `amenities` longtext,
  `phone` varchar(255) DEFAULT NULL,
  `more_details` longtext,
  `square_footage` varchar(255) DEFAULT NULL,
  `user_id` int(10) DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `rating` decimal(3,1) unsigned DEFAULT '0.0',
  `votes` int(11) unsigned DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `houses`
--

INSERT INTO `houses` VALUES(1, 1, 'Kate''s Beach House', '', '', '', 'Cannon Beach', 'OR.', '97210', 237, 4, 2, '', '(503) 227-5041', '', '60,000', NULL, '2011-07-05 21:30:37', '2011-07-06 23:50:35', 0.0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `inspirations`
--

CREATE TABLE `inspirations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `designer` varchar(255) DEFAULT NULL,
  `source_url` varchar(255) NOT NULL,
  `address1` varchar(255) DEFAULT NULL,
  `address2` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `zip` varchar(255) DEFAULT NULL,
  `country_id` int(10) DEFAULT NULL,
  `user_id` int(10) DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `rating` decimal(3,1) unsigned DEFAULT '0.0',
  `votes` int(11) unsigned DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `inspirations`
--

INSERT INTO `inspirations` VALUES(1, 'TuboHotel: Totally Tubular Tepoztlán', 'The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.', 'Martyn Lawrence-Bullard', 'http://www.apartmenttherapy.com/dc/architecture/tubohotel-totally-tubular-tepoztlan-150895?utm_source=feedburner&utm_medium=feed&utm_campaign=Feed%3A+apartmenttherapy%2Fmain+%28Main%29&utm_content=Google+Reader', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2011-07-09 03:34:28', '2011-07-17 02:48:12', 0.0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `inspirations_products`
--

CREATE TABLE `inspirations_products` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `inspiration_id` int(10) NOT NULL,
  `product_id` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=179 ;

--
-- Dumping data for table `inspirations_products`
--

INSERT INTO `inspirations_products` VALUES(126, 2, 52);
INSERT INTO `inspirations_products` VALUES(178, 1, 52);
INSERT INTO `inspirations_products` VALUES(176, 1, 45);
INSERT INTO `inspirations_products` VALUES(148, 3, 52);
INSERT INTO `inspirations_products` VALUES(149, 3, 42);
INSERT INTO `inspirations_products` VALUES(150, 3, 45);

-- --------------------------------------------------------

--
-- Table structure for table `inspirations_sources`
--

CREATE TABLE `inspirations_sources` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `inspiration_id` int(10) NOT NULL,
  `source_id` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `inspirations_sources`
--


-- --------------------------------------------------------

--
-- Table structure for table `inspiration_photo_tags`
--

CREATE TABLE `inspiration_photo_tags` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `inspiration_id` int(11) NOT NULL,
  `attachment_id` int(10) DEFAULT NULL,
  `model` int(10) NOT NULL COMMENT 'The item type added to the photo tag.',
  `model_id` int(10) NOT NULL COMMENT 'The item id added to the photo tag.',
  `name` varchar(255) NOT NULL,
  `x1` int(11) DEFAULT NULL,
  `y1` int(11) DEFAULT NULL,
  `x2` int(11) DEFAULT NULL,
  `y2` int(11) DEFAULT NULL,
  `width` int(11) DEFAULT NULL,
  `height` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=155 ;

--
-- Dumping data for table `inspiration_photo_tags`
--

INSERT INTO `inspiration_photo_tags` VALUES(146, 1, 18, 0, 0, 'Some product', 73, 77, 204, 179, 131, 102);
INSERT INTO `inspiration_photo_tags` VALUES(148, 1, 18, 0, 0, 'Some product', 107, 209, 293, 327, 186, 118);
INSERT INTO `inspiration_photo_tags` VALUES(154, 1, 18, 0, 0, 'Beaded', 189, 33, 322, 146, 133, 113);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `product_category_id` int(10) NOT NULL,
  `description` mediumtext,
  `designer` varchar(255) DEFAULT NULL,
  `slug` varchar(255) NOT NULL,
  `source_url` varchar(255) DEFAULT NULL,
  `purchase_url` varchar(255) DEFAULT NULL,
  `source_id` int(10) DEFAULT NULL,
  `price` varchar(255) DEFAULT NULL,
  `user_id` int(10) DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `rating` decimal(3,1) unsigned DEFAULT '0.0',
  `votes` int(11) unsigned DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=61 ;

--
-- Dumping data for table `products`
--

INSERT INTO `products` VALUES(42, 'Some product', 4, '', '', 'some-product', '', '', 8, NULL, NULL, '2011-07-14 02:26:07', '2011-07-14 02:26:07', 0.0, 0);
INSERT INTO `products` VALUES(45, 'Beaded', 1, '', '', 'beaded', '', '', 5, NULL, 1, '2011-07-17 12:18:09', '2011-07-17 12:18:09', 0.0, 0);
INSERT INTO `products` VALUES(50, 'Hashish candle', 1, '', '', 'hashish-candle', '', '', NULL, NULL, 1, '2011-07-17 12:25:24', '2011-07-17 12:25:24', 0.0, 0);
INSERT INTO `products` VALUES(52, 'My Product', 2, '', 'Someone Special', 'my-product', '', 'http://www.dwr.com/product/era-round-arm-with-cane.do', 2, NULL, 1, '2011-07-30 03:43:34', '2011-07-30 03:43:34', 0.0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `product_categories`
--

CREATE TABLE `product_categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `user_id` int(10) DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `product_categories`
--

INSERT INTO `product_categories` VALUES(1, 'accessory', NULL, '2011-07-13 15:01:42', '2011-07-13 15:01:42');
INSERT INTO `product_categories` VALUES(2, 'art or antique', NULL, '2011-07-13 15:03:16', '2011-07-13 15:03:16');
INSERT INTO `product_categories` VALUES(3, 'building product', NULL, '2011-07-13 15:03:21', '2011-07-13 15:03:21');
INSERT INTO `product_categories` VALUES(4, 'flooring', NULL, '2011-07-13 15:03:27', '2011-07-13 15:03:27');
INSERT INTO `product_categories` VALUES(5, 'furniture', NULL, '2011-07-13 15:03:30', '2011-07-13 15:03:30');
INSERT INTO `product_categories` VALUES(6, 'kitchen or bath', NULL, '2011-07-13 15:03:35', '2011-07-13 15:03:35');
INSERT INTO `product_categories` VALUES(7, 'lighting', NULL, '2011-07-13 15:03:38', '2011-07-13 15:03:38');
INSERT INTO `product_categories` VALUES(8, 'ceiling fixture', NULL, '2011-07-13 15:03:42', '2011-07-13 15:03:42');
INSERT INTO `product_categories` VALUES(9, 'exterior lighting', NULL, '2011-07-13 15:03:47', '2011-07-13 15:03:47');
INSERT INTO `product_categories` VALUES(10, 'fixture/lamp', NULL, '2011-07-13 15:03:52', '2011-07-13 15:03:52');
INSERT INTO `product_categories` VALUES(11, 'lamp', NULL, '2011-07-13 15:03:56', '2011-07-13 15:03:56');
INSERT INTO `product_categories` VALUES(12, 'lighting accessory', NULL, '2011-07-13 15:04:00', '2011-07-13 15:04:00');
INSERT INTO `product_categories` VALUES(13, 'special purpose lighting', NULL, '2011-07-13 15:04:04', '2011-07-13 15:04:04');
INSERT INTO `product_categories` VALUES(14, 'wall fixture', NULL, '2011-07-13 15:04:08', '2011-07-13 15:04:08');
INSERT INTO `product_categories` VALUES(15, 'textile', NULL, '2011-07-13 15:04:11', '2011-07-13 15:04:11');
INSERT INTO `product_categories` VALUES(16, 'wallcovering or finish', NULL, '2011-07-13 15:04:27', '2011-07-13 15:04:27');
INSERT INTO `product_categories` VALUES(17, 'window treatment', NULL, '2011-07-13 15:04:31', '2011-07-13 15:04:31');
INSERT INTO `product_categories` VALUES(18, 'craftsmen, service or consultant', NULL, '2011-07-13 15:04:36', '2011-07-13 15:04:36');

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` char(36) NOT NULL DEFAULT '',
  `model_id` char(36) NOT NULL DEFAULT '',
  `model` varchar(100) NOT NULL DEFAULT '',
  `rating` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `name` varchar(100) DEFAULT '',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `rating` (`model_id`,`model`,`rating`,`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `ratings`
--

INSERT INTO `ratings` VALUES(2, '4e1fe75e-f760-4a5d-835e-3d3c8bbe252e', '1', 'Inspiration', 2, 'inspiration', '2011-07-15 00:52:32', '2011-07-15 00:52:32');
INSERT INTO `ratings` VALUES(4, '4e1fe75e-f760-4a5d-835e-3d3c8bbe252e', '33', 'Source', 3, 'source', '2011-07-15 01:12:49', '2011-07-15 01:12:49');
INSERT INTO `ratings` VALUES(5, '4e1fe75e-f760-4a5d-835e-3d3c8bbe252e', '1', 'Collection', 4, 'collection', '2011-07-15 01:17:38', '2011-07-15 01:17:38');
INSERT INTO `ratings` VALUES(8, '4e332b33-6748-4148-ae5a-41618bbe252e', '3', 'Collection', 3, 'collection', '2011-07-29 17:28:47', '2011-07-30 03:53:26');
INSERT INTO `ratings` VALUES(9, '', '', '', 0, '', '2011-07-31 01:52:15', '2011-07-31 01:52:15');
INSERT INTO `ratings` VALUES(10, '', '', '', 0, '', '2011-07-31 01:53:29', '2011-07-31 01:53:29');
INSERT INTO `ratings` VALUES(11, '', '', '', 0, '', '2011-07-31 02:02:15', '2011-07-31 02:02:15');
INSERT INTO `ratings` VALUES(12, '', '', '', 0, '', '2011-07-31 02:03:45', '2011-07-31 02:03:45');
INSERT INTO `ratings` VALUES(13, '', '', '', 0, '', '2011-07-31 02:07:53', '2011-07-31 02:07:53');

-- --------------------------------------------------------

--
-- Table structure for table `schema_migrations`
--

CREATE TABLE `schema_migrations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `version` int(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `schema_migrations`
--

INSERT INTO `schema_migrations` VALUES(1, 1, 'migrations', '2011-07-19 20:27:40');
INSERT INTO `schema_migrations` VALUES(2, 1, 'comments', '2011-07-19 20:27:40');

-- --------------------------------------------------------

--
-- Table structure for table `sources`
--

CREATE TABLE `sources` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `source_category_id` int(10) unsigned DEFAULT NULL,
  `description` longtext,
  `address1` varchar(255) DEFAULT NULL,
  `address2` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `zip` varchar(255) DEFAULT NULL,
  `country_id` int(10) unsigned DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `fax` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `user_id` int(10) DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `rating` decimal(3,1) unsigned DEFAULT '0.0',
  `votes` int(11) unsigned DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`,`slug`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=44 ;

--
-- Dumping data for table `sources`
--

INSERT INTO `sources` VALUES(1, 'Another Source', 'another-source', 0, '', '', '', 'Portland', 'OR', '97210', 237, '', NULL, '', '', NULL, '2011-07-05 13:53:49', '2011-07-06 23:20:52', 0.0, 0);
INSERT INTO `sources` VALUES(2, 'DWR', 'dwr', 4, '', '', '', '', '', '', 237, '', '', '', '', 1, '2011-07-05 13:55:01', '2011-07-31 05:36:45', 0.0, 0);
INSERT INTO `sources` VALUES(3, 'Kellie Anderson', 'kellie-anderson', 0, '', '', '', '', '', NULL, 237, '', 'kelli@kellianderson.com', '', 'http://kellianderson.com/', NULL, '2011-07-05 15:21:26', '2011-07-05 15:21:26', 0.0, 0);
INSERT INTO `sources` VALUES(8, 'Simple Source', 'simple-source', 0, '', '', '', '', '', NULL, NULL, '', '', '', '', NULL, '2011-07-06 23:02:06', '2011-07-06 23:02:06', 0.0, 0);
INSERT INTO `sources` VALUES(5, 'Judy Kaufmann', 'judy-kaufmann', 12, 'The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.', '10001 Test Lane', 'Apt #2', 'Portland', 'OR.', '97210', 237, '(504) 220-2000', 'judy@kaufmann.com', '(504) 220-2100', 'http://www.kaufmannillustration.com/', 1, '2011-07-05 15:38:59', '2011-07-17 16:58:20', 0.0, 0);
INSERT INTO `sources` VALUES(16, 'The End Of History Shop', 'the-end-of-history-shop', 15, '', '548 1/2 Hudson St.', '', 'Manhattan', 'NY', NULL, 237, '(212) 647-7598', 'HistoryGlass@gmail.com', '', 'http://theendofhistoryshop.blogspot.com/', NULL, '2011-07-10 00:09:20', '2011-07-10 02:38:45', 0.0, 0);
INSERT INTO `sources` VALUES(17, 'Another Test', 'another-test', NULL, '', '', '', '', '', NULL, NULL, '', '', '', '', NULL, '2011-07-10 17:33:34', '2011-07-10 17:33:34', 0.0, 0);
INSERT INTO `sources` VALUES(33, 'Lamps Plus', 'lamps-plus', 9, '', '', '', '', '', NULL, NULL, '', '', '', 'http://www.lampsplus.com/', NULL, '2011-07-11 17:09:29', '2011-07-15 01:12:49', 3.0, 1);
INSERT INTO `sources` VALUES(36, 'Kim Seybert', 'kim-seybert', 10, '', '', '', '', '', NULL, NULL, '', '', '', 'http://www.kimseybert.com/', NULL, '2011-07-13 00:04:03', '2011-07-13 00:04:03', 0.0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `source_categories`
--

CREATE TABLE `source_categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `user_id` int(10) DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `source_categories`
--

INSERT INTO `source_categories` VALUES(1, 'Accessories', 'accessories', NULL, '2011-07-10 02:09:09', '2011-07-10 02:09:09');
INSERT INTO `source_categories` VALUES(2, 'Art/Antiques', 'art-antiques', NULL, '2011-07-10 02:09:29', '2011-07-10 02:09:29');
INSERT INTO `source_categories` VALUES(3, 'Bed/Bath Linens', 'bed-bath-linens', NULL, '2011-07-10 02:09:53', '2011-07-10 02:09:53');
INSERT INTO `source_categories` VALUES(4, 'Emporium', 'emporium', NULL, '2011-07-10 02:09:58', '2011-07-10 02:09:58');
INSERT INTO `source_categories` VALUES(5, 'Floor Coverings', 'floor-coverings', NULL, '2011-07-10 02:10:18', '2011-07-10 02:10:18');
INSERT INTO `source_categories` VALUES(6, 'Furniture', 'furniture', NULL, '2011-07-10 02:10:22', '2011-07-10 02:10:22');
INSERT INTO `source_categories` VALUES(7, 'Kitchen', 'kitchen', NULL, '2011-07-10 02:10:45', '2011-07-10 02:10:45');
INSERT INTO `source_categories` VALUES(8, 'Bath', 'bath', NULL, '2011-07-10 02:10:48', '2011-07-10 02:10:48');
INSERT INTO `source_categories` VALUES(9, 'Lighting', 'lighting', NULL, '2011-07-10 02:11:05', '2011-07-10 02:11:05');
INSERT INTO `source_categories` VALUES(10, 'Tabletop', 'tabletop', NULL, '2011-07-10 02:12:56', '2011-07-10 02:12:56');
INSERT INTO `source_categories` VALUES(11, 'Paint', 'paint', NULL, '2011-07-10 02:13:04', '2011-07-10 02:13:04');
INSERT INTO `source_categories` VALUES(12, 'Textiles', 'textiles', NULL, '2011-07-10 02:13:31', '2011-07-10 02:13:31');
INSERT INTO `source_categories` VALUES(13, 'Wall Coverings', 'wall-coverings', NULL, '2011-07-10 02:13:36', '2011-07-10 02:13:36');
INSERT INTO `source_categories` VALUES(14, 'Tile/Surfaces', 'tile-surfaces', NULL, '2011-07-10 02:13:52', '2011-07-10 02:13:52');
INSERT INTO `source_categories` VALUES(15, 'Dealer', 'dealer', NULL, '2011-07-10 02:14:01', '2011-07-10 02:14:01');

-- --------------------------------------------------------

--
-- Table structure for table `tagged`
--

CREATE TABLE `tagged` (
  `id` varchar(36) NOT NULL,
  `foreign_key` varchar(36) NOT NULL,
  `tag_id` varchar(36) NOT NULL,
  `model` varchar(255) NOT NULL,
  `language` varchar(6) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQUE_TAGGING` (`model`,`foreign_key`,`tag_id`,`language`),
  KEY `INDEX_TAGGED` (`model`),
  KEY `INDEX_LANGUAGE` (`language`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tagged`
--

INSERT INTO `tagged` VALUES('4e1eb3bd-4184-4118-a0b3-7bf28bbe252e', '11', '4e1eb3bd-dfac-46f1-ad6b-7bf28bbe252e', 'Client', 'en-us', '2011-07-14 02:15:41', '2011-07-14 02:15:41');
INSERT INTO `tagged` VALUES('4e1ec065-07f0-424b-b1d3-84ca8bbe252e', '2', '4e1d1fe8-7114-4cb3-ba87-40448bbe252e', 'Collection', 'en-us', '2011-07-14 03:09:41', '2011-07-14 03:09:41');
INSERT INTO `tagged` VALUES('4e23771c-ffb4-49c5-8ec6-46368bbe252e', '5', '4e1934ec-2cac-4e1a-b07f-d4798bbe252e', 'Source', 'en-us', '2011-07-17 16:58:20', '2011-07-17 16:58:20');
INSERT INTO `tagged` VALUES('4e1eb3bd-5680-42bf-8aa3-7bf28bbe252e', '11', '4e1d1fe8-50bc-48e8-8957-4d3f8bbe252e', 'Client', 'en-us', '2011-07-14 02:15:41', '2011-07-14 02:15:41');
INSERT INTO `tagged` VALUES('4e1d4363-cbec-4569-bc54-4fe28bbe252e', '36', '4e1d428e-a914-420a-adf3-43118bbe252e', 'Source', 'en-us', '2011-07-13 00:04:03', '2011-07-13 00:04:03');
INSERT INTO `tagged` VALUES('4e155221-ede4-42fa-99e3-48d68bbe252e', '4', '4e15509a-1cd4-4994-87ec-41498bbe252e', 'Contractor', NULL, '2011-07-06 23:28:49', '2011-07-06 23:28:49');
INSERT INTO `tagged` VALUES('4e155221-1f38-4769-9f9a-4c698bbe252e', '4', '4e15509a-30dc-483a-a59a-446a8bbe252e', 'Contractor', NULL, '2011-07-06 23:28:49', '2011-07-06 23:28:49');
INSERT INTO `tagged` VALUES('4e155221-f3f8-4396-8898-49868bbe252e', '4', '4e15509a-a04c-436f-8c32-43508bbe252e', 'Contractor', NULL, '2011-07-06 23:28:49', '2011-07-06 23:28:49');
INSERT INTO `tagged` VALUES('4e354c5d-e11c-4fa2-90e4-79c88bbe252e', '2', '4e114e16-6d58-4a7d-a761-40428bbe252e', 'Source', 'en-us', '2011-07-31 05:36:45', '2011-07-31 05:36:45');
INSERT INTO `tagged` VALUES('4e354c5d-779c-4ed6-be89-79c88bbe252e', '2', '4e15509a-30dc-483a-a59a-446a8bbe252e', 'Source', 'en-us', '2011-07-31 05:36:45', '2011-07-31 05:36:45');
INSERT INTO `tagged` VALUES('4e1ba065-2814-40fb-9db0-91218bbe252e', '4', '4e1b9ac4-8ab0-49c0-8e2f-711b8bbe252e', 'Product', 'en-us', '2011-07-11 18:16:21', '2011-07-11 18:16:21');
INSERT INTO `tagged` VALUES('4e1ba886-7674-4ab1-baff-a45f8bbe252e', '12', '4e1ba886-b354-40b5-b10b-a45f8bbe252e', 'Product', 'en-us', '2011-07-11 18:51:02', '2011-07-11 18:51:02');
INSERT INTO `tagged` VALUES('4e1d4363-4ddc-4120-9397-48888bbe252e', '36', '4e1d428e-55fc-41c9-a7d1-48078bbe252e', 'Source', 'en-us', '2011-07-13 00:04:03', '2011-07-13 00:04:03');
INSERT INTO `tagged` VALUES('4e1d4363-8b0c-4e28-8a29-45c88bbe252e', '36', '4e1d428e-dc9c-4fa9-838b-41f38bbe252e', 'Source', 'en-us', '2011-07-13 00:04:03', '2011-07-13 00:04:03');
INSERT INTO `tagged` VALUES('4e233571-8390-4b4d-9212-404f8bbe252e', '45', '4e233561-f714-49e3-becd-ecc98bbe252e', 'Product', 'en-us', '2011-07-17 12:18:09', '2011-07-17 12:18:09');
INSERT INTO `tagged` VALUES('4e33e056-abb4-4864-822c-40f98bbe252e', '52', '4e33e056-7034-4226-98a8-42bf8bbe252e', 'Product', 'en-us', '2011-07-30 03:43:34', '2011-07-30 03:43:34');
INSERT INTO `tagged` VALUES('4e33e056-7ac4-46ae-bdb3-48358bbe252e', '52', '4e114e16-6d58-4a7d-a761-40428bbe252e', 'Product', 'en-us', '2011-07-30 03:43:34', '2011-07-30 03:43:34');

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` varchar(36) NOT NULL,
  `identifier` varchar(30) DEFAULT NULL,
  `name` varchar(30) NOT NULL,
  `keyname` varchar(30) NOT NULL,
  `weight` int(2) NOT NULL DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQUE_TAG` (`identifier`,`keyname`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` VALUES('4e114e16-6d58-4a7d-a761-40428bbe252e', NULL, 'modern', 'modern', 0, '2011-07-03 22:22:30', '2011-07-03 22:22:30');
INSERT INTO `tags` VALUES('4e114e16-9334-4b4c-ba49-4d628bbe252e', NULL, 'red', 'red', 0, '2011-07-03 22:22:30', '2011-07-03 22:22:30');
INSERT INTO `tags` VALUES('4e114e16-90d4-437b-a0a7-4e918bbe252e', NULL, 'appliance', 'appliance', 0, '2011-07-03 22:22:30', '2011-07-03 22:22:30');
INSERT INTO `tags` VALUES('4e114efd-9ab8-48f9-aaa4-49828bbe252e', NULL, 'another', 'another', 0, '2011-07-03 22:26:21', '2011-07-03 22:26:21');
INSERT INTO `tags` VALUES('4e115086-d2fc-4bbe-ac13-49c68bbe252e', NULL, 'fun', 'fun', 0, '2011-07-03 22:32:54', '2011-07-03 22:32:54');
INSERT INTO `tags` VALUES('4e1150ee-f4e8-47bb-a1c6-4bd38bbe252e', NULL, 'dependable', 'dependable', 0, '2011-07-03 22:34:38', '2011-07-03 22:34:38');
INSERT INTO `tags` VALUES('4e117802-604c-4dfe-8e28-44a78bbe252e', NULL, 'nice', 'nice', 0, '2011-07-04 01:21:22', '2011-07-04 01:21:22');
INSERT INTO `tags` VALUES('4e1371de-a38c-4ca2-9229-0a2c8bbe252e', NULL, 'test1', 'test1', 0, '2011-07-05 13:19:42', '2011-07-05 13:19:42');
INSERT INTO `tags` VALUES('4e1371de-50d8-40f5-ad1e-0a2c8bbe252e', NULL, 'test2', 'test2', 0, '2011-07-05 13:19:42', '2011-07-05 13:19:42');
INSERT INTO `tags` VALUES('4e137a25-c3b8-4966-b66a-0ecb8bbe252e', NULL, 'simple', 'simple', 0, '2011-07-05 13:55:01', '2011-07-05 13:55:01');
INSERT INTO `tags` VALUES('4e137a25-2e78-46cb-97c2-0ecb8bbe252e', NULL, 'usable', 'usable', 0, '2011-07-05 13:55:01', '2011-07-05 13:55:01');
INSERT INTO `tags` VALUES('4e138e66-2f8c-4239-b494-81058bbe252e', NULL, 'artist', 'artist', 0, '2011-07-05 15:21:26', '2011-07-05 15:21:26');
INSERT INTO `tags` VALUES('4e138e66-dfd4-4d9d-a4c0-81058bbe252e', NULL, 'painter', 'painter', 0, '2011-07-05 15:21:26', '2011-07-05 15:21:26');
INSERT INTO `tags` VALUES('4e13924f-2c9c-47ca-931b-81938bbe252e', NULL, 'illustrator', 'illustrator', 0, '2011-07-05 15:38:07', '2011-07-05 15:38:07');
INSERT INTO `tags` VALUES('4e13de41-4104-433d-a258-ae8b8bbe252e', NULL, 'fish', 'fish', 0, '2011-07-05 21:02:09', '2011-07-05 21:02:09');
INSERT INTO `tags` VALUES('4e13de41-fe94-4f9e-8078-ae8b8bbe252e', NULL, 'cat', 'cat', 0, '2011-07-05 21:02:09', '2011-07-05 21:02:09');
INSERT INTO `tags` VALUES('4e13de41-3ec0-45af-9ccd-ae8b8bbe252e', NULL, 'dog', 'dog', 0, '2011-07-05 21:02:09', '2011-07-05 21:02:09');
INSERT INTO `tags` VALUES('4e13e11f-99d8-4404-a214-adee8bbe252e', NULL, 'pretty', 'pretty', 0, '2011-07-05 21:14:23', '2011-07-05 21:14:23');
INSERT INTO `tags` VALUES('4e13e4ee-b768-458e-adb3-b47d8bbe252e', NULL, 'beach', 'beach', 0, '2011-07-05 21:30:38', '2011-07-05 21:30:38');
INSERT INTO `tags` VALUES('4e13e4ee-1738-4470-bb68-b47d8bbe252e', NULL, 'vacation', 'vacation', 0, '2011-07-05 21:30:38', '2011-07-05 21:30:38');
INSERT INTO `tags` VALUES('4e150102-6884-471b-9bcb-408f8bbe252e', NULL, 'contractor', 'contractor', 0, '2011-07-06 17:42:42', '2011-07-06 17:42:42');
INSERT INTO `tags` VALUES('4e15509a-1cd4-4994-87ec-41498bbe252e', NULL, 'great', 'great', 0, '2011-07-06 23:22:18', '2011-07-06 23:22:18');
INSERT INTO `tags` VALUES('4e15509a-30dc-483a-a59a-446a8bbe252e', NULL, 'awesome', 'awesome', 0, '2011-07-06 23:22:18', '2011-07-06 23:22:18');
INSERT INTO `tags` VALUES('4e15509a-a04c-436f-8c32-43508bbe252e', NULL, 'easy', 'easy', 0, '2011-07-06 23:22:18', '2011-07-06 23:22:18');
INSERT INTO `tags` VALUES('4e167145-76dc-48cb-829d-69318bbe252e', NULL, 'amazing', 'amazing', 0, '2011-07-07 19:53:57', '2011-07-07 19:53:57');
INSERT INTO `tags` VALUES('4e182eb4-9f14-4bec-a972-c3858bbe252e', NULL, 'tubular', 'tubular', 0, '2011-07-09 03:34:28', '2011-07-09 03:34:28');
INSERT INTO `tags` VALUES('4e1934ec-2cac-4e1a-b07f-d4798bbe252e', NULL, 'inspirational', 'inspirational', 0, '2011-07-09 22:13:16', '2011-07-09 22:13:16');
INSERT INTO `tags` VALUES('4e196e3b-cc40-4a32-bdb2-ffe98bbe252e', NULL, 'lighting', 'lighting', 0, '2011-07-10 02:17:47', '2011-07-10 02:17:47');
INSERT INTO `tags` VALUES('4e196e3b-a8ac-4bb4-a61a-ffe98bbe252e', NULL, 'pottery', 'pottery', 0, '2011-07-10 02:17:47', '2011-07-10 02:17:47');
INSERT INTO `tags` VALUES('4e196e3b-3db8-4dfe-951f-ffe98bbe252e', NULL, 'colorful', 'colorful', 0, '2011-07-10 02:17:47', '2011-07-10 02:17:47');
INSERT INTO `tags` VALUES('4e1b8482-8ea4-4805-95f0-4b148bbe252e', NULL, 'buckets', 'buckets', 0, '2011-07-11 16:17:22', '2011-07-11 16:17:22');
INSERT INTO `tags` VALUES('4e1b91d7-bda0-45c5-b24a-4b148bbe252e', NULL, 'floor', 'floor', 0, '2011-07-11 17:14:15', '2011-07-11 17:14:15');
INSERT INTO `tags` VALUES('4e1b91d7-8940-4bb0-bd28-4b148bbe252e', NULL, 'lamp', 'lamp', 0, '2011-07-11 17:14:15', '2011-07-11 17:14:15');
INSERT INTO `tags` VALUES('4e1b9ac4-8ab0-49c0-8e2f-711b8bbe252e', NULL, 'bucket', 'bucket', 0, '2011-07-11 17:52:20', '2011-07-11 17:52:20');
INSERT INTO `tags` VALUES('4e1b9ac4-b6f0-4ca4-971a-711b8bbe252e', NULL, 'rattan', 'rattan', 0, '2011-07-11 17:52:20', '2011-07-11 17:52:20');
INSERT INTO `tags` VALUES('4e1b9c87-1294-405d-bf9d-70ff8bbe252e', NULL, 'lucite', 'lucite', 0, '2011-07-11 17:59:51', '2011-07-11 17:59:51');
INSERT INTO `tags` VALUES('4e1ba886-b354-40b5-b10b-a45f8bbe252e', NULL, 'work', 'work', 0, '2011-07-11 18:51:02', '2011-07-11 18:51:02');
INSERT INTO `tags` VALUES('4e1ba980-5e38-412c-8834-711b8bbe252e', NULL, 'casamidy', 'casamidy', 0, '2011-07-11 18:55:12', '2011-07-11 18:55:12');
INSERT INTO `tags` VALUES('4e1ba980-24e8-44cd-852a-711b8bbe252e', NULL, 'steel', 'steel', 0, '2011-07-11 18:55:12', '2011-07-11 18:55:12');
INSERT INTO `tags` VALUES('4e1d1fe8-7114-4cb3-ba87-40448bbe252e', NULL, 'test', 'test', 0, '2011-07-12 21:32:40', '2011-07-12 21:32:40');
INSERT INTO `tags` VALUES('4e1d1fe8-50bc-48e8-8957-4d3f8bbe252e', NULL, 'testing', 'testing', 0, '2011-07-12 21:32:40', '2011-07-12 21:32:40');
INSERT INTO `tags` VALUES('4e1d428e-a914-420a-adf3-43118bbe252e', NULL, 'contemporary', 'contemporary', 0, '2011-07-13 00:00:30', '2011-07-13 00:00:30');
INSERT INTO `tags` VALUES('4e1d428e-55fc-41c9-a7d1-48078bbe252e', NULL, 'traditional', 'traditional', 0, '2011-07-13 00:00:30', '2011-07-13 00:00:30');
INSERT INTO `tags` VALUES('4e1d428e-dc9c-4fa9-838b-41f38bbe252e', NULL, 'accessories', 'accessories', 0, '2011-07-13 00:00:30', '2011-07-13 00:00:30');
INSERT INTO `tags` VALUES('4e1eb3bd-dfac-46f1-ad6b-7bf28bbe252e', NULL, 'another test', 'anothertest', 0, '2011-07-14 02:15:41', '2011-07-14 02:15:41');
INSERT INTO `tags` VALUES('4e22afdc-f530-4ff3-abc5-f1928bbe252e', NULL, 'cool', 'cool', 0, '2011-07-17 02:48:12', '2011-07-17 02:48:12');
INSERT INTO `tags` VALUES('4e233561-f714-49e3-becd-ecc98bbe252e', NULL, 'vase', 'vase', 0, '2011-07-17 12:17:53', '2011-07-17 12:17:53');
INSERT INTO `tags` VALUES('4e23c44d-95b4-4dce-b867-42618bbe252e', NULL, '70s', '70s', 0, '2011-07-17 22:27:41', '2011-07-17 22:27:41');
INSERT INTO `tags` VALUES('4e23c44d-5600-42e5-974a-4c118bbe252e', NULL, 'bubble chair', 'bubblechair', 0, '2011-07-17 22:27:41', '2011-07-17 22:27:41');
INSERT INTO `tags` VALUES('4e23c44d-3140-4b71-907f-44438bbe252e', NULL, 'black', 'black', 0, '2011-07-17 22:27:41', '2011-07-17 22:27:41');
INSERT INTO `tags` VALUES('4e23c44d-bcd0-46bb-b3f4-447f8bbe252e', NULL, 'wire', 'wire', 0, '2011-07-17 22:27:41', '2011-07-17 22:27:41');
INSERT INTO `tags` VALUES('4e33999a-8974-4e6f-99a7-4af78bbe252e', NULL, 'dwr', 'dwr', 0, '2011-07-29 22:41:46', '2011-07-29 22:41:46');
INSERT INTO `tags` VALUES('4e33999a-54d4-4f80-aa53-42b28bbe252e', NULL, 'wooden', 'wooden', 0, '2011-07-29 22:41:46', '2011-07-29 22:41:46');
INSERT INTO `tags` VALUES('4e33e056-7034-4226-98a8-42bf8bbe252e', NULL, 'chair', 'chair', 0, '2011-07-30 03:43:34', '2011-07-30 03:43:34');

-- --------------------------------------------------------

--
-- Table structure for table `ufos`
--

CREATE TABLE `ufos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `description` mediumtext,
  `attachment_id` int(10) NOT NULL,
  `user_id` int(10) DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `rating` decimal(3,1) unsigned DEFAULT '0.0',
  `votes` int(11) unsigned DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `ufos`
--


-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `remember_me` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `username` varchar(65) NOT NULL,
  `salutation` varchar(12) DEFAULT NULL,
  `fname` varchar(50) DEFAULT NULL,
  `initials` varchar(5) DEFAULT NULL,
  `lname` varchar(50) DEFAULT NULL,
  `suffix` varchar(12) NOT NULL,
  `birthday` date DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `about` mediumtext,
  `city` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `country_id` varchar(255) DEFAULT NULL,
  `postal_code` int(25) DEFAULT NULL,
  `active` tinyint(4) unsigned NOT NULL DEFAULT '1',
  `email` varchar(255) NOT NULL,
  `password` char(40) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `comments` int(10) DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '0',
  `signature` varchar(255) NOT NULL,
  `locale` varchar(3) NOT NULL DEFAULT 'eng',
  `timezone` varchar(4) NOT NULL DEFAULT '-8',
  `totalPosts` int(10) NOT NULL,
  `totalTopics` int(10) NOT NULL,
  `currentLogin` datetime DEFAULT NULL,
  `lastLogin` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` VALUES(1, 0, 'robksawyer', '', 'Rob', 'K.', 'Sawyer', '', '1984-02-08', 'http://blog.robksawyer.com', '', 'Portland', 'OR.', '237', NULL, 1, 'robksawyer@gmail.com', '5a742b6f7cb6c813976abc9faed4665f79da2c67', 'rob-k-sawyer', NULL, '2011-07-14 02:41:00', '2011-07-31 18:03:43', 0, '', 'eng', '-8', 1, 1, '2011-07-31 18:03:43', '2011-07-31 17:39:12');
INSERT INTO `users` VALUES(3, 0, 'kate', '', 'Kate', '', 'Tapia', '', '1984-02-08', '', 'Been that #1 diva in the game for a minute', '', '', '', NULL, 1, 'ketapia@gmail.com', '1fb23326651c38fd4fcce7dab0fd4fc43ef482d6', 'kate-tapia', NULL, '2011-07-14 20:26:54', '2011-07-18 16:33:24', 0, '', 'eng', '-8', 0, 0, NULL, NULL);
INSERT INTO `users` VALUES(4, 0, 'mslater', '', 'Mickey', '', 'Slater', '', '1984-02-08', '', '', 'Portland', 'OR.', '237', NULL, 1, 'mickeyslater@gmail.com', '9a868368bc17acd7ed5684fba37324690b6890b0', 'mickey-slater', NULL, '2011-07-26 09:49:32', '2011-07-26 12:12:43', 0, '', 'eng', '-8', 0, 0, NULL, NULL);
INSERT INTO `users` VALUES(5, 0, 'emazzucco', '', 'Ed', '', 'Mazzucco', '', '1984-02-08', 'http://www.shelflife.com', '', 'Portland', 'OR.', '237', NULL, 1, 'ed@shelflife.com', '3bbc66298631626d0f0e646ce6a9dace42c66b87', 'ed-mazzucco', NULL, '2011-07-26 11:21:19', '2011-07-26 11:21:20', 0, '', 'eng', '-8', 0, 0, NULL, NULL);
