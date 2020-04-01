-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 01, 2020 at 10:03 AM
-- Server version: 5.7.15-log
-- PHP Version: 5.6.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `saleelogistic`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_car`
--

CREATE TABLE `tb_car` (
  `car_id` int(5) NOT NULL,
  `car_id_set` varchar(10) NOT NULL,
  `car_register` varchar(15) NOT NULL,
  `car_province` varchar(20) NOT NULL COMMENT 'จังหวัด',
  `car_date_end` date NOT NULL COMMENT 'วันหมดอายุภาษี'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_car`
--

INSERT INTO `tb_car` (`car_id`, `car_id_set`, `car_register`, `car_province`, `car_date_end`) VALUES
(13, 'C-013', 'ตค12132', 'ตรัง', '2020-02-28'),
(3, 'C-003', 'คค56584', 'ชุมพร', '2020-03-31'),
(4, 'C-004', 'ตค12132', 'อุตรดิตถ์', '2020-05-28'),
(5, 'C-005', 'ภถ86513', 'อ่างทอง', '2020-05-20'),
(6, 'C-006', 'ถภ36549', 'เชียงราย', '2020-06-11'),
(11, 'C-011', 'พษ19658', 'ขอนแก่น', '2020-02-19'),
(12, 'C-012', 'ดข9998', 'เชียงใหม่', '2020-04-23'),
(16, 'C-016', 'กฝ3694', 'หนองบัวลำภู', '2020-04-30'),
(15, 'C-015', 'จน88888', 'กาฬสินธุ์', '2020-02-29'),
(17, 'C-017', 'ดข99999', 'นครนายก', '2020-04-17'),
(18, 'C-018', 'ยน9697', 'เชียงใหม่', '2020-02-02');

-- --------------------------------------------------------

--
-- Table structure for table `tb_customer`
--

CREATE TABLE `tb_customer` (
  `cus_id` int(5) NOT NULL COMMENT 'รหัสลูกค้า',
  `customer_id` varchar(10) NOT NULL,
  `cus_compan` varchar(40) NOT NULL COMMENT 'ชื่อบริษัท',
  `cus_house` varchar(8) NOT NULL COMMENT 'บ้านเลขที่',
  `cus_vill` int(5) NOT NULL COMMENT 'หมู่ที่',
  `cus_sub` varchar(20) NOT NULL COMMENT 'ตำบล',
  `cus_area` varchar(20) NOT NULL COMMENT 'อำเภอ',
  `cus_pro` varchar(20) NOT NULL COMMENT 'จังหวัด',
  `cus_pos` varchar(5) NOT NULL COMMENT 'รหัสไปรษณีย์',
  `cus_tle` varchar(10) NOT NULL COMMENT 'เบอร์โทรศัพท์',
  `cus_tin` varchar(13) NOT NULL COMMENT 'เลขประจำตัวผู้เสียภาษี'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_customer`
--

INSERT INTO `tb_customer` (`cus_id`, `customer_id`, `cus_compan`, `cus_house`, `cus_vill`, `cus_sub`, `cus_area`, `cus_pro`, `cus_pos`, `cus_tle`, `cus_tin`) VALUES
(1, 'C-0001', 'เสาเอก', '12', 10, 'อรันยิก', 'เมือง', 'พิษณุโลก', '65000', '0923455675', '1324567896543'),
(2, 'C-0002', 'เสาโท', '89/1', 7, 'บ้านคลอง', 'บางระกำ', 'พิษณุโลก', '85000', '0953453214', '8765456345653'),
(3, 'C-0003', 'ซีเมน', '652/5', 5, 'วังทอง', 'วังทอง', 'พิษณุโลก', '85000', '0953453214', '2445334343443'),
(4, 'C-0004', 'ไพศานยานยนต์', '435/1', 11, 'บ้านคลอง', 'เมือง', 'พิษณุโลก', '85000', '0953459879', '9876567453476'),
(5, 'C-0005', 'อู่ช่างต้อม', '99/5', 5, 'บ้านกร่าง', 'เมือง', 'พิษณุโลก', '85000', '0836954354', '9875621465846'),
(13, 'C-0013', 'โฮมโปร', '69/12', 3, 'ในเมือง', 'เมือง', 'พิษณุโลก', '65000', '0968789545', '6565545646545'),
(11, 'C-0011', 'ไพรโรจ', '13', 15, 'ในเมือง', 'เมือง', 'พิษณุโลก', '65000', '0989764464', '4545464646464'),
(12, 'C-0012', 'มานะ', '56', 7, 'ในเมือง', 'บางระกำ', 'พิษณุโลก', '65000', '0987644456', '5656656546544'),
(10, 'C-0010', 'สามเสา', '652/5', 8, 'วังทอง', 'วังทอง', 'พิษณุโลก', '65000', '0923455675', '6545456465464'),
(15, 'C-0015', 'โกเบิ้ลเฮาท์', '66/9', 2, 'สมอแค', 'วังทอง', 'พิษณุโลก', '65000', '0968978974', '6987764545454'),
(14, 'C-0014', 'เสาเอกซีเมน', '362', 3, 'อรัญญิก', 'เมือง', 'พิษณุโลก', '65000', '0986798444', '0653557001657'),
(16, 'C-0016', 'เคเอ็มซีสติล', '16/8', 11, 'ในเมือง', 'เมือง', 'พิษณุโลก', '65000', '0967745454', '5656656546544'),
(17, 'C-0017', 'ปีนัง', '453', 3, 'นครไทย', 'นครไทย', 'พิษณุโลก', '65000', '0875543654', '3564457854541'),
(18, 'C-0018', 'เคเอ็มซีสติล', '69/4', 7, 'วังทอง', 'วังทอง', 'พิษณุโลก', '65000', '0986546677', '6844567877777');

-- --------------------------------------------------------

--
-- Table structure for table `tb_invoice`
--

CREATE TABLE `tb_invoice` (
  `inv_id` int(11) NOT NULL,
  `inv_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `inv_car_id` int(11) DEFAULT NULL,
  `inv_staff_id` int(11) DEFAULT NULL,
  `inv_detail` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_invoice`
--

INSERT INTO `tb_invoice` (`inv_id`, `inv_date`, `inv_car_id`, `inv_staff_id`, `inv_detail`) VALUES
(1, '2020-03-27 17:36:57', 4, 4, '26,27'),
(2, '2020-03-27 17:46:15', 4, 6, '30,31'),
(3, '2020-03-27 17:59:01', 4, 5, '28'),
(4, '2020-03-27 19:48:59', 5, 4, '49'),
(5, '2020-03-27 19:49:23', 5, 4, '49'),
(6, '2020-03-27 19:49:35', 4, 12, '32'),
(7, '2020-03-27 19:57:32', 5, 6, '36,37'),
(8, '2020-03-27 19:58:13', 4, 5, '35,38'),
(9, '2020-03-27 20:05:32', 4, 5, '39,40'),
(10, '2020-03-27 20:06:06', 4, 4, '47'),
(11, '2020-03-27 22:03:08', 4, 3, '34'),
(12, '2020-03-30 15:31:41', 3, 5, '29,41,42,43,48,51,52,55,56,57'),
(13, '2020-03-30 15:34:01', 4, 12, '26,27,28,29,30,31,32,34,35,36,37,38,39,40,41,42,43'),
(14, '2020-03-30 15:37:08', 11, 5, '26,27,28,29,30,31,32,34,35,36,37,38,39,40,41,42,43,47,48,49,51,52');

-- --------------------------------------------------------

--
-- Table structure for table `tb_inv_wb`
--

CREATE TABLE `tb_inv_wb` (
  `tiw_id` int(11) NOT NULL,
  `tiw_wb_id` int(11) NOT NULL,
  `tiw_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tiw_money` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_inv_wb`
--

INSERT INTO `tb_inv_wb` (`tiw_id`, `tiw_wb_id`, `tiw_date`, `tiw_money`) VALUES
(1, 26, '2020-03-30 16:13:22', 0),
(2, 27, '2020-03-30 16:13:22', 0),
(3, 30, '2020-03-30 16:13:22', 0),
(4, 31, '2020-03-30 16:13:22', 0),
(5, 28, '2020-03-30 16:13:22', 0),
(6, 49, '2020-03-30 16:13:22', 0),
(7, 49, '2020-03-30 16:13:22', 0),
(8, 32, '2020-03-30 16:13:22', 0),
(9, 36, '2020-03-30 16:13:22', 0),
(10, 37, '2020-03-30 16:13:22', 0),
(11, 35, '2020-03-30 16:13:22', 0),
(12, 38, '2020-03-30 16:13:22', 0),
(13, 39, '2020-03-30 16:13:22', 0),
(14, 40, '2020-03-30 16:13:22', 0),
(15, 47, '2020-03-30 16:13:22', 0),
(16, 34, '2020-03-30 16:13:22', 0),
(17, 29, '2020-03-30 16:13:22', 0),
(18, 41, '2020-03-30 16:13:22', 0),
(19, 42, '2020-03-30 16:13:22', 0),
(20, 43, '2020-03-30 16:13:22', 0),
(21, 48, '2020-03-30 16:13:22', 0),
(22, 51, '2020-03-30 16:13:22', 0),
(23, 52, '2020-03-30 16:13:22', 0),
(24, 55, '2020-03-30 16:13:22', 0),
(25, 56, '2020-03-30 16:13:22', 0),
(26, 57, '2020-03-30 16:13:22', 0),
(27, 26, '2020-03-30 16:13:22', 0),
(28, 27, '2020-03-30 16:13:22', 0),
(29, 28, '2020-03-30 16:13:22', 0),
(30, 29, '2020-03-30 16:13:22', 0),
(31, 30, '2020-03-30 16:13:22', 0),
(32, 31, '2020-03-30 16:13:22', 0),
(33, 32, '2020-03-30 16:13:22', 0),
(34, 34, '2020-03-30 16:13:22', 0),
(35, 35, '2020-03-30 16:13:22', 0),
(36, 36, '2020-03-30 16:13:22', 0),
(37, 37, '2020-03-30 16:13:22', 0),
(38, 38, '2020-03-30 16:13:22', 0),
(39, 39, '2020-03-30 16:13:22', 0),
(40, 40, '2020-03-30 16:13:22', 0),
(41, 41, '2020-03-30 16:13:22', 0),
(42, 42, '2020-03-30 16:13:22', 0),
(43, 43, '2020-03-30 16:13:22', 0),
(44, 26, '2020-03-30 16:13:22', 0),
(45, 27, '2020-03-30 16:13:22', 0),
(46, 28, '2020-03-30 16:13:22', 0),
(47, 29, '2020-03-30 16:13:22', 0),
(48, 30, '2020-03-30 16:13:22', 0),
(49, 31, '2020-03-30 16:13:22', 0),
(50, 32, '2020-03-30 16:13:22', 0),
(51, 34, '2020-03-30 16:13:22', 0),
(52, 35, '2020-03-30 16:13:22', 0),
(53, 36, '2020-03-30 16:13:22', 0),
(54, 37, '2020-03-30 16:13:22', 0),
(55, 38, '2020-03-30 16:13:22', 0),
(56, 39, '2020-03-30 16:13:22', 0),
(57, 40, '2020-03-30 16:13:22', 0),
(58, 41, '2020-03-30 16:13:22', 0),
(59, 42, '2020-03-30 16:13:22', 0),
(60, 43, '2020-03-30 16:13:22', 0),
(61, 47, '2020-03-30 16:13:22', 0),
(62, 48, '2020-03-30 16:13:22', 0),
(63, 49, '2020-03-30 16:13:22', 0),
(64, 51, '2020-03-30 16:13:22', 0),
(65, 52, '2020-03-30 16:13:22', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_login`
--

CREATE TABLE `tb_login` (
  `login_id` mediumint(15) NOT NULL,
  `login_use` varchar(20) NOT NULL,
  `login_pass` varchar(20) NOT NULL,
  `login_name` varchar(30) NOT NULL,
  `login_level` int(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_login`
--

INSERT INTO `tb_login` (`login_id`, `login_use`, `login_pass`, `login_name`, `login_level`) VALUES
(1, 'admin', '12345678', 'nongkik', 1),
(2, 'member', '1234', 'Member', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tb_staff`
--

CREATE TABLE `tb_staff` (
  `staff_id` int(10) NOT NULL,
  `staff_id_set` varchar(10) NOT NULL,
  `staff_name` varchar(55) NOT NULL,
  `staff_lastname` varchar(55) NOT NULL,
  `staff_card` varchar(13) NOT NULL,
  `staff_position` varchar(15) NOT NULL,
  `staff_tel` varchar(10) NOT NULL,
  `staff_title_name` varchar(45) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_staff`
--

INSERT INTO `tb_staff` (`staff_id`, `staff_id_set`, `staff_name`, `staff_lastname`, `staff_card`, `staff_position`, `staff_tel`, `staff_title_name`) VALUES
(3, 'S-003', 'ยุท', 'คนดี', '160125562302', 'Manager', '0624417481', 'นาย'),
(4, 'S-004', 'มานพ', 'ไปไม่กลับ', '123456732456', 'Manager', '0624417481', 'นาย'),
(5, 'S-005', 'บุญงาม', 'คาหินะ', '1234567891233', 'Manager', '0624417481', 'นาย'),
(6, 'S-006', 'วันใจ', 'มหาสงความ', '1234567891233', 'Manager', '0624417481', 'นาย'),
(12, 'S-012', 'จามีเอส', 'ศรีรักษา', '1234567891233', 'Manager', '0624417481', 'นาย'),
(17, 'S-017', 'เคมี', 'ไม่ตรงกัน', '1234567891233', 'Manager', '0624417481', 'นาย'),
(18, 'S-018', 'ภาวนา', 'ไปก่อนนะ', '1234567891233', 'Manager', '0624417481', 'นาง'),
(19, 'S-019', 'วาสนา', 'บุญไปมา', '1234567891233', 'Manager', '0624417481', 'นางสาว');

-- --------------------------------------------------------

--
-- Table structure for table `tb_waybill`
--

CREATE TABLE `tb_waybill` (
  `wb_id` int(10) NOT NULL COMMENT 'auto',
  `wb_nbook` varchar(8) NOT NULL COMMENT 'เล่มที่',
  `wb_date` varchar(50) NOT NULL COMMENT 'วันที่',
  `wb_money` float NOT NULL COMMENT 'จำนวนเงิน',
  `wb_payment` enum('ยังไม่ได้ชำระ','ชำระแล้ว') NOT NULL COMMENT 'สถานะ',
  `wb_img` varchar(100) NOT NULL COMMENT 'รูปภาพ',
  `wb_nber` varchar(10) NOT NULL COMMENT 'เลขที่',
  `customer_id` varchar(10) NOT NULL COMMENT 'เรียกใช้มาจากตารางลูกค้า',
  `car_id` int(5) NOT NULL COMMENT 'เรียกใช้มาจากตารางข้อมูลรถ',
  `wb_id_set` varchar(8) DEFAULT NULL,
  `tb_inv_status` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_waybill`
--

INSERT INTO `tb_waybill` (`wb_id`, `wb_nbook`, `wb_date`, `wb_money`, `wb_payment`, `wb_img`, `wb_nber`, `customer_id`, `car_id`, `wb_id_set`, `tb_inv_status`, `staff_id`) VALUES
(38, '2', '2020-01-14', 3000, 'ยังไม่ได้ชำระ', 'เธเธดเธฅเน€เธเธดเธเธชเธ”.jpg', '4556', '5', 11, 'B-0038', 0, 5),
(37, '99', '2020-01-18', 1800, 'ชำระแล้ว', 'เธเธดเธฅเน€เธเธดเธเธชเธ”.jpg', '99/99', '13', 11, 'B-0037', 0, 5),
(36, '23', '2020-01-14', 2345, 'ยังไม่ได้ชำระ', 'B-0036.', '554/2', '1', 11, 'B-0036', 0, 5),
(35, '2', '2020-01-14', 2000, 'ยังไม่ได้ชำระ', 'picture/B-0035.png', '554/2', '5', 11, 'B-0035', 0, 5),
(31, '999', '2020-01-13', 780, 'ยังไม่ได้ชำระ', 'B-0031.', '36546', '4', 11, 'B-0031', 0, 5),
(30, '366', '2020-01-13', 900, 'ยังไม่ได้ชำระ', 'B-0030.', '79987', '5', 11, 'B-0030', 0, 5),
(29, '80', '2020-01-13', 350, 'ยังไม่ได้ชำระ', 'เธเธดเธฅเน€เธเธดเธเธชเธ”.jpg', '888888', '10', 11, 'B-0029', 0, 5),
(32, '6666', '2020-01-13', 500, 'ยังไม่ได้ชำระ', 'B-0032.', '55654', '13', 11, 'B-0032', 0, 5),
(28, '65', '2020-01-31', 3500, 'ยังไม่ได้ชำระ', 'B-0028.', '6565', '1', 11, 'B-0028', 0, 5),
(64, '234', '2020-01-30', 880, 'ยังไม่ได้ชำระ', 'B-0064.jpg', '148819', '16', 0, 'B-0064', 0, 0),
(34, '2', '2020-01-14', 2000, 'ยังไม่ได้ชำระ', 'B-0034.jpg', '554/2', '1', 11, 'B-0034', 0, 5),
(39, '654', '2020-01-14', 6000, 'ชำระแล้ว', 'เธเธดเธฅเน€เธเธดเธเธชเธ”.jpg', '3987', '12', 11, 'B-0039', 0, 5),
(26, '4545', '2020-01-22', 50000, '', 'B-0026.jpg', '222', '5', 11, 'B-0026', 0, 5),
(27, '55', '2020-01-08', 6000, 'ยังไม่ได้ชำระ', 'B-0027.jpg', '555', '2', 11, 'B-0027', 0, 5),
(40, '3', '2020-01-15', 2002, 'ยังไม่ได้ชำระ', 'บิลเงินสด.jpg', '1142', '2', 11, 'B-0040', 0, 5),
(41, '3', '2020-01-15', 50000, 'ยังไม่ได้ชำระ', 'บิลเงินสด.jpg', '5656', '2', 11, 'B-0041', 0, 5),
(42, '345', '2020-01-16', 7000, 'ชำระแล้ว', '', '5656', '13', 11, 'B-0042', 0, 5),
(43, '444', '2020-01-16', 3000, 'ชำระแล้ว', 'C:\\fakepath\\1234.jpg', '115145', '13', 11, 'B-0043', 0, 5),
(47, '3174', '2020-01-16', 275, 'ชำระแล้ว', '', '158665', '14', 11, 'B-0047', 0, 5),
(48, '3', '2020-01-22', 3000, 'ชำระแล้ว', 'B-0048', '554/22', '13', 11, 'B-0048', 0, 5),
(49, '3', '2020-01-20', 3000, 'ยังไม่ได้ชำระ', 'B-0049.jpg', '115145', '2', 11, 'B-0049', 0, 5),
(51, '9876', '2020-01-29', 300, 'ยังไม่ได้ชำระ', 'B-0051.jpg', '6789', '11', 11, 'B-0051', 0, 5),
(52, '333', '2020-01-29', 500, 'ยังไม่ได้ชำระ', 'B-0052.jpg', '39393', '15', 11, 'B-0052', 0, 5),
(55, '4567', '2020-01-29', 600, 'ยังไม่ได้ชำระ', 'B-0055.jpg', '454545', '14', 3, 'B-0055', 0, 5),
(56, '75', '2020-01-29', 500, 'ยังไม่ได้ชำระ', 'B-0056.jpg', '45567', '12', 3, 'B-0056', 0, 5),
(57, '456', '2020-01-29', 4000, 'ยังไม่ได้ชำระ', 'B-0057.', '123456', '15', 3, 'B-0057', 0, 5),
(58, '55', '2020-01-29', 520, 'ชำระแล้ว', 'B-0058.jpg', '565655', '4', 0, 'B-0058', 0, 0),
(59, '55', '2020-01-29', 520, 'ชำระแล้ว', 'B-0059.jpg', '565655', '4', 0, 'B-0059', 0, 0),
(60, '123', '2020-01-29', 320, 'ยังไม่ได้ชำระ', 'B-0060.', '13456789', '3', 0, 'B-0060', 0, 0),
(66, '2365', '2020-01-30', 880, 'ยังไม่ได้ชำระ', 'B-0066.jpg', '148819', '18', 0, 'B-0066', 0, 0),
(67, '2', '2020-02-19', 2000, 'ยังไม่ได้ชำระ', 'B-0067.jpg', '115145', '5', 0, 'B-0067', 0, 0),
(63, '3', '2020-01-29', 3000, 'ชำระแล้ว', 'B-0063.jpg', '554/2', '5', 0, 'B-0063', 0, 0),
(65, '3', '2020-01-07', 800, 'ยังไม่ได้ชำระ', 'B-0065.jpg', '156254', '17', 0, 'B-0065', 0, 0),
(68, '3', '2020-03-20', 599, 'ยังไม่ได้ชำระ', 'B-0068.jpg', '5656', '3', 0, 'B-0068', 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_car`
--
ALTER TABLE `tb_car`
  ADD PRIMARY KEY (`car_id`);

--
-- Indexes for table `tb_customer`
--
ALTER TABLE `tb_customer`
  ADD PRIMARY KEY (`cus_id`);

--
-- Indexes for table `tb_invoice`
--
ALTER TABLE `tb_invoice`
  ADD PRIMARY KEY (`inv_id`);

--
-- Indexes for table `tb_inv_wb`
--
ALTER TABLE `tb_inv_wb`
  ADD PRIMARY KEY (`tiw_id`);

--
-- Indexes for table `tb_login`
--
ALTER TABLE `tb_login`
  ADD PRIMARY KEY (`login_id`);

--
-- Indexes for table `tb_staff`
--
ALTER TABLE `tb_staff`
  ADD PRIMARY KEY (`staff_id`);

--
-- Indexes for table `tb_waybill`
--
ALTER TABLE `tb_waybill`
  ADD PRIMARY KEY (`wb_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_car`
--
ALTER TABLE `tb_car`
  MODIFY `car_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `tb_customer`
--
ALTER TABLE `tb_customer`
  MODIFY `cus_id` int(5) NOT NULL AUTO_INCREMENT COMMENT 'รหัสลูกค้า', AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `tb_invoice`
--
ALTER TABLE `tb_invoice`
  MODIFY `inv_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `tb_inv_wb`
--
ALTER TABLE `tb_inv_wb`
  MODIFY `tiw_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;
--
-- AUTO_INCREMENT for table `tb_login`
--
ALTER TABLE `tb_login`
  MODIFY `login_id` mediumint(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tb_staff`
--
ALTER TABLE `tb_staff`
  MODIFY `staff_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `tb_waybill`
--
ALTER TABLE `tb_waybill`
  MODIFY `wb_id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'auto', AUTO_INCREMENT=69;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
