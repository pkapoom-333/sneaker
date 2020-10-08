-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 08, 2020 at 05:33 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `datawebsite`
--

-- --------------------------------------------------------

--
-- Table structure for table `img_product`
--

CREATE TABLE `img_product` (
  `id_img_product` varchar(255) NOT NULL,
  `img_product_1` varchar(255) NOT NULL,
  `mrk_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `img_product`
--

INSERT INTO `img_product` (`id_img_product`, `img_product_1`, `mrk_id`) VALUES
('16000001', '5f63a9415a5d83.86249802.png', 20200012);

-- --------------------------------------------------------

--
-- Table structure for table `img_product_test`
--

CREATE TABLE `img_product_test` (
  `product_1` varchar(255) DEFAULT NULL,
  `file_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `img_product_test`
--

INSERT INTO `img_product_test` (`product_1`, `file_name`) VALUES
('32767', '5f637c9ede5c06.56810178.png'),
('32767', '5f637c9edf69a1.29007300.png'),
('32767', '5f637c9ee067f1.71012596.png');

-- --------------------------------------------------------

--
-- Table structure for table `market_info`
--

CREATE TABLE `market_info` (
  `mrk_id` int(11) NOT NULL,
  `mrk_name` varchar(255) DEFAULT NULL,
  `mrk_pic` varchar(255) DEFAULT NULL,
  `mrk_fb` varchar(255) DEFAULT NULL,
  `mrk_line` varchar(255) DEFAULT NULL,
  `mrk_ig` varchar(255) DEFAULT NULL,
  `mrk_rat_location` varchar(255) DEFAULT NULL,
  `mrk_address` varchar(255) DEFAULT NULL,
  `mrk_lt_location` varchar(255) DEFAULT NULL,
  `mrk_sub_district` varchar(255) DEFAULT NULL,
  `mrk_district` varchar(255) DEFAULT NULL,
  `mrk_city` varchar(255) DEFAULT NULL,
  `mrk_zipcode` varchar(255) DEFAULT NULL,
  `mrk_phone` varchar(255) DEFAULT NULL,
  `mrk_count_prd` double DEFAULT NULL,
  `mrk_personal_id` varchar(255) DEFAULT NULL,
  `mrk_open` time DEFAULT NULL,
  `mrk_close` time DEFAULT NULL,
  `mrk_regis_time` varchar(30) DEFAULT NULL,
  `prd_id` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `market_info`
--

INSERT INTO `market_info` (`mrk_id`, `mrk_name`, `mrk_pic`, `mrk_fb`, `mrk_line`, `mrk_ig`, `mrk_rat_location`, `mrk_address`, `mrk_lt_location`, `mrk_sub_district`, `mrk_district`, `mrk_city`, `mrk_zipcode`, `mrk_phone`, `mrk_count_prd`, `mrk_personal_id`, `mrk_open`, `mrk_close`, `mrk_regis_time`, `prd_id`) VALUES
(20200016, 'Snaekey', '20200016.png', 'pakpoom', 'pakpoom-tee', 'pakppnm', NULL, 'รังสิต', 'aaaaaaaaaaaaaaaaaaaaaaaaa', 'ฟฟฟ', 'ฟฟฟ', 'กรุงเทพ', '24000000', '0917152034', NULL, '1600700064000', '22:30:00', '22:30:00', '02-10-20', '20200016'),
(20200020, 'Snaekey 2020', '20200020.png', 'pakpoom', 'pakpoom-tee', 'pakppnm', NULL, 'รังสิต', 'aaaaaaaaaaaaaaaaaaaaaaaaa', 'pakpoom', 'pakpoom', 'กรุงเทพ', 'pakpoom', '0917152034', NULL, '1600700064000', '20:54:00', '20:55:00', '02-10-20', '20200020');

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `member_id` varchar(20) NOT NULL,
  `member_email` varchar(80) DEFAULT NULL,
  `member_pwd` varchar(20) DEFAULT NULL,
  `member_name` varchar(50) DEFAULT NULL,
  `member_lstname` varchar(50) DEFAULT NULL,
  `member_phone` varchar(10) DEFAULT NULL,
  `member_gender` varchar(1) DEFAULT NULL,
  `mrk_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`member_id`, `member_email`, `member_pwd`, `member_name`, `member_lstname`, `member_phone`, `member_gender`, `mrk_id`) VALUES
('', '', '', '', '', '', '', 0),
('20200001', 'pakpoomtee55@gmail.com', 'aaaaaaaaaaaaaaaaaa', 'pakpoomtee5599@gmail.com', 'jardkeaw', '0917823030', 'm', 20200001),
('20200002', 'pakpoomtee24@gmail.com', '0918890624', 'pakpoomtee5599@gmail.com', 'jardkeaw', '0917823030', 'm', 20200002),
('20200003', 'pakpoom3@pkapom.net', 'aaaaaaaaaaaaaaaaaa', 'pakpoomtee5599@gmail.com', 'jardkeaw', '0917823030', 'm', 20200003),
('20200004', 'pakpoomtee24@gmail.com', 'aaaaaaaaaaaaaaaaaa', 'pakpoomtee5599@gmail.com', 'jardkeaw', '0917823030', 'm', 20200004),
('20200005', 'pakpoomtee1@gmail.com', 'aaaaaaaaaaaaaaaaaa', 'pakpoomtee5599@gmail.com', 'jardkeaw', '0917823030', 'm', 20200005),
('20200006', 'pakpoom5@pkapom.net', 'aaaaaaaaaaaaaaaaaa', 'pakpoomtee5599@gmail.com', 'jardkeaaaaaaaaaaaaaaaw', '0917823030', 'm', 20200006),
('20200007', 'pakpoomtee4aa4@gmail.com', 'aaaaaaaaaaaaaaaaaa', 'pakpoomtee5599@gmail.com', 'jardkeaw', '0917823030', 'm', 20200007),
('20200008', 'pakpoomtee445@gmail.com', 'aaaaaaaaaaaaaaaaaa', 'pakpoomtee5599@gmail.com', 'jardkeaw', '0917823030', 'm', 20200008),
('20200009', 'pakpoomtee24@gmail.com', 'aaaaaaaaaaaaaaaaaa', 'pakpoomtee5599@gmail.com', 'jardkeaw', '444', 'm', 20200009),
('20200010', 'pakpoomtee454@gmail.com', 'aaaaaaaaaaaaaaaaaa', 'pakpoomtee5599@gmail.com', 'jardkeaw', '0917823030', 'm', 20200010),
('20200011', 'pakpoomtee4488@gmail.com', 'aaaaaaaaaaaaaaaaaa', 'pakpoomtee5599@gmail.com', 'jardkeaw', '0917823030', 'm', 20200011),
('20200012', 'pakpoom.jard@bumail.net', '0918890624', 'ภาคภูมิ ', 'จาดแก้ว', '0917152034', 'm', 20200012),
('20200013', 'pakpoomtest@gmail.com', '0918890624', 'ภาคภูมิ', 'jardkeaw', '0917823030', 'm', 20200013),
('20200014', 'NewTest@gmail.com', 'Za0918890624', 'Newtest', 'Newtest', 'Newtest', 'm', 20200014),
('20200015', 'pakpoom.jard24@bumail.net', 'Za0918890624', 'pakpoom', 'jardkeaw', '0917152034', 'm', 20200015),
('20200016', 'Testweb@gmail.com', 'Za0918890624', 'pakpoom', 'jardkeaw', '0917152034', 'm', 20200016),
('20200017', 'a@a.a', 'a', 'a', 'a', 'a', 'm', 20200017),
('20200018', 't@bu.test', 'Za0918890624', 'test', 'jardkeaw', '0917823030', 'm', 20200018),
('20200019', 'pakpoomtee77@gmail.com', 'Za0918890624', 'test', 'jardkeaw', '0917823030', 'm', 20200019);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `prd_id` varchar(255) NOT NULL,
  `prd_pic_id` varchar(100) NOT NULL,
  `prd_name` varchar(60) NOT NULL,
  `prd_brand` varchar(50) NOT NULL,
  `prd_type` varchar(50) NOT NULL,
  `prd_status` varchar(50) NOT NULL,
  `prd_price` varchar(20) NOT NULL,
  `prd_gender` varchar(12) NOT NULL,
  `prd_detail` varchar(255) NOT NULL,
  `prd_view` int(100) NOT NULL,
  `img1` varchar(255) NOT NULL,
  `img2` varchar(255) NOT NULL,
  `img3` varchar(255) NOT NULL,
  `img4` varchar(255) NOT NULL,
  `img5` varchar(255) NOT NULL,
  `img6` varchar(255) NOT NULL,
  `size_39` int(64) NOT NULL,
  `size_40` int(64) NOT NULL,
  `size_40_5` int(64) NOT NULL,
  `size_41` int(64) NOT NULL,
  `size_41_5` int(64) NOT NULL,
  `size_42` int(64) NOT NULL,
  `size_42_5` int(64) NOT NULL,
  `size_43` int(64) NOT NULL,
  `size_44` int(64) NOT NULL,
  `size_44_5` int(64) NOT NULL,
  `size_46` int(64) NOT NULL,
  `size_47` int(64) NOT NULL,
  `size_47_5` int(64) NOT NULL,
  `on_prd` varchar(20) NOT NULL,
  `update_prd` varchar(20) NOT NULL,
  `prd_count_review` varchar(10) NOT NULL,
  `review_id` varchar(20) NOT NULL,
  `id_market` varchar(20) NOT NULL,
  `prd_Name_Maket` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`prd_id`, `prd_pic_id`, `prd_name`, `prd_brand`, `prd_type`, `prd_status`, `prd_price`, `prd_gender`, `prd_detail`, `prd_view`, `img1`, `img2`, `img3`, `img4`, `img5`, `img6`, `size_39`, `size_40`, `size_40_5`, `size_41`, `size_41_5`, `size_42`, `size_42_5`, `size_43`, `size_44`, `size_44_5`, `size_46`, `size_47`, `size_47_5`, `on_prd`, `update_prd`, `prd_count_review`, `review_id`, `id_market`, `prd_Name_Maket`) VALUES
('16000001', '', 'Nike show', 'Nike', 'รองเท้าทั่วไป', 'มื่อหนึ่ง', '10000', 'ผู้ชาย', 'test', 0, '16091001.png', '16092002.png', '16093003.png', '16094004.png', '16095005.png', '16096006.jpg', 1, 1, 3, 0, 0, 0, 0, 1, 1, 0, 0, 0, 0, '2020-10-02 08:24:59', '2020-10-02 08:24:59', '0', '16000001', '20200016', 'Snaekey'),
('16000002', '', 'Nike show', 'Nike', 'รองเท้าทั่วไป', 'มือสอง', '10000', 'ผู้ชาย', 'test', 0, '16091004.png', '16092005.png', '16093006.png', '16094007.png', '16095008.png', '16096009.jpg', 1, 1, 3, 0, 0, 0, 0, 1, 1, 0, 0, 0, 0, '2020-10-02 08:25:22', '2020-10-02 08:25:22', '0', '16000002', '20200016', 'Snaekey'),
('16000003', '', 'adias show', 'Nike', 'รองเท้าทั่วไป', 'มื่อหนึ่ง', '10000', 'ผู้ชาย', 'test', 0, '16091006.png', '16092007.png', '16093008.png', '16094009.png', '16095010.png', '16096011.jpg', 1, 1, 3, 0, 0, 0, 0, 1, 1, 0, 0, 0, 0, '2020-10-02 08:27:02', '2020-10-02 08:27:02', '0', '16000003', '20200016', 'Snaekey'),
('16000004', '', 'adias show', 'Adidas', 'รองเท้าทั่วไป', 'มือสอง', '10000', 'ผู้ชาย', 'test', 0, '16091008.png', '16092009.png', '16093010.png', '16094011.png', '16095012.png', '16096013.jpg', 1, 1, 3, 0, 0, 0, 0, 1, 1, 0, 0, 0, 0, '2020-10-02 08:27:07', '2020-10-02 08:27:07', '0', '16000004', '20200016', 'Snaekey'),
('16000005', '', 'adias show', 'Adidas', 'รองเท้าทั่วไป', 'มือสอง', '10000', 'ผู้ชาย', 'test', 0, '16091010.png', '16092011.jpg', '16093012.jpg', '16094013.png', '16095014.png', '16096015.png', 1, 1, 3, 0, 0, 0, 0, 1, 1, 0, 0, 0, 0, '2020-10-02 08:28:31', '2020-10-02 08:28:31', '0', '16000005', '20200016', 'Snaekey'),
('16000006', '', 'nike show', 'Adidas', 'รองเท้าทั่วไป', 'มือสอง', '10000', 'ผู้ชาย', 'test', 0, '16091012.png', '16092013.png', '16093014.png', '16094015.png', '16095016.jpg', '16096017.jpg', 1, 1, 3, 0, 0, 0, 0, 1, 1, 0, 0, 0, 0, '2020-10-02 08:29:25', '2020-10-02 08:29:25', '0', '16000006', '20200016', 'Snaekey'),
('16000007', '', 'nike show', 'Adidas', 'รองเท้าทั่วไป', 'มื่อหนึ่ง', '10000', 'ผู้ชาย', 'test', 0, '16091014.png', '16092015.png', '16093016.png', '16094017.jpg', '16095018.jpg', '16096019.png', 1, 1, 3, 0, 0, 0, 0, 1, 1, 0, 0, 0, 0, '2020-10-02 08:30:41', '2020-10-02 08:30:41', '0', '16000007', '20200016', 'Snaekey'),
('16000008', '', 'pakpoom', 'Vans', 'รองเท้าทั่วไป', 'มื่อหนึ่ง', '10000', 'ผู้ชาย', 'test', 20, '16091016.jpg', '16092017.png', '16093018.png', '16094019.png', '16095020.png', '', 1, 0, 0, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, '2020-10-02 08:36:06', '2020-10-02 08:36:06', '0', '16000008', '20200016', 'Snaekey'),
('16000009', '', 'testView', 'Nike', 'รองเท้าทั่วไป', 'มื่อหนึ่ง', '10000', 'ผู้ชาย', 'test', 12, '16091018.png', '16092019.png', '16093020.jpg', '16094021.jpg', '16095022.png', '16096023.png', 1, 0, 1, 1, 1, 0, 0, 1, 1, 1, 0, 0, 0, '2020-10-02 09:50:10', '2020-10-02 09:50:10', '22', '16000009', '20200020', 'Snaekey 2020'),
('16000010', '', 'ผู้หญิง', 'Adidas', 'รองเท้าทั่วไป', 'มื่อหนึ่ง', '50000', 'ผู้หญิง', 'test', 0, '16091020.png', '16092021.png', '16093022.png', '16094023.png', '16095024.jpg', '16096025.jpg', 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2020-10-06 17:35:02', '2020-10-06 17:35:02', '0', '16000010', '20200016', 'Snaekey');

-- --------------------------------------------------------

--
-- Table structure for table `review_prd`
--

CREATE TABLE `review_prd` (
  `review_id` int(11) NOT NULL,
  `review_detail` varchar(255) DEFAULT NULL,
  `review_date` varchar(255) DEFAULT NULL,
  `review_like` double DEFAULT NULL,
  `review_count_point` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `stock_size`
--

CREATE TABLE `stock_size` (
  `stock_id` int(11) NOT NULL,
  `size_39` int(11) DEFAULT NULL,
  `size_40` int(11) DEFAULT NULL,
  `size_40_5` int(11) DEFAULT NULL,
  `size_41` int(11) DEFAULT NULL,
  `size_41_5` int(11) DEFAULT NULL,
  `size_42` int(11) DEFAULT NULL,
  `size_42_5` int(11) DEFAULT NULL,
  `size_43` int(11) DEFAULT NULL,
  `size_43_5` int(11) DEFAULT NULL,
  `size_44` int(11) DEFAULT NULL,
  `size_44_5` int(11) DEFAULT NULL,
  `size_45` int(11) DEFAULT NULL,
  `size_45_5` int(11) DEFAULT NULL,
  `size_46` int(11) DEFAULT NULL,
  `size_46_5` int(11) DEFAULT NULL,
  `size_47` int(11) DEFAULT NULL,
  `size_47_5` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `web_access_info`
--

CREATE TABLE `web_access_info` (
  `search_id` int(11) NOT NULL,
  `search_name` varchar(255) DEFAULT NULL,
  `count_search` int(11) DEFAULT NULL,
  `search_in_day` date DEFAULT NULL,
  `name_type` varchar(255) DEFAULT NULL,
  `count_type` int(11) DEFAULT NULL,
  `mrk_id` int(11) DEFAULT NULL,
  `prd_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `img_product`
--
ALTER TABLE `img_product`
  ADD PRIMARY KEY (`id_img_product`);

--
-- Indexes for table `img_product_test`
--
ALTER TABLE `img_product_test`
  ADD UNIQUE KEY `file_name` (`file_name`);

--
-- Indexes for table `market_info`
--
ALTER TABLE `market_info`
  ADD PRIMARY KEY (`mrk_id`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`member_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`prd_id`);

--
-- Indexes for table `review_prd`
--
ALTER TABLE `review_prd`
  ADD PRIMARY KEY (`review_id`);

--
-- Indexes for table `stock_size`
--
ALTER TABLE `stock_size`
  ADD PRIMARY KEY (`stock_id`);

--
-- Indexes for table `web_access_info`
--
ALTER TABLE `web_access_info`
  ADD PRIMARY KEY (`search_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
