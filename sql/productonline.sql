-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 19, 2024 at 04:52 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `productonline`
--

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `CommentID` int(11) NOT NULL COMMENT 'รหัสแสดงความคิดเห็น',
  `ProductID` int(11) NOT NULL COMMENT 'รหัสสินค้า',
  `MemberID` int(11) NOT NULL COMMENT 'รหัสสมาชิก',
  `CommentText` text NOT NULL COMMENT 'ข้อความที่แสดงความคิดเห็น',
  `CommentDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT 'วันที่แสดงความคิดเห็น'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`CommentID`, `ProductID`, `MemberID`, `CommentText`, `CommentDate`) VALUES
(4, 4, 18, 'asd', '2024-02-28 06:11:10'),
(5, 4, 18, 'เทส1212312121', '2024-02-28 06:11:58'),
(6, 10, 19, 'ใส่แล้วเครื่องเปิดไม่ติดครับ แย่มากๆหลอกกันแบบนี้ได้ยังไง', '2024-02-28 07:27:19'),
(7, 4, 19, 'สินค้ายอดเยี่ยมแห่งปี หน้าใส ไร้สิว', '2024-03-04 06:47:55'),
(8, 12, 19, 'เมาส์มาโครสุดยอดดดดดดดดดดด', '2024-03-04 10:35:01'),
(9, 4, 18, '222', '2024-03-12 14:09:25');

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `MemberID` int(11) NOT NULL COMMENT 'รหัสสมาชิก',
  `Fname` varchar(30) NOT NULL COMMENT 'ชื่อ',
  `Lname` varchar(30) NOT NULL COMMENT 'นามสกุล',
  `Telephone` text NOT NULL COMMENT 'เบอร์โทรศัพท์',
  `Email` varchar(100) NOT NULL COMMENT 'อีเมลล์',
  `Username` varchar(30) NOT NULL COMMENT 'ชื่อผู้ใช้',
  `Password` varchar(100) NOT NULL COMMENT 'รหัสผ่าน',
  `Status` varchar(1) NOT NULL COMMENT '"0"=User,"1"=Admin'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`MemberID`, `Fname`, `Lname`, `Telephone`, `Email`, `Username`, `Password`, `Status`) VALUES
(1, 'ภูรีพัฒน์', 'บัวนวน', '0885786135', 'phureepat.bounoun@gmail.com', 'phuree', '$2y$10$0zMHecG.5uv4rb4D/tgJDOvZeKi.5CcPR/H60GkIO/FQIG0t75bzi', '1'),
(2, 'สุธาสินี', 'บัวนวน', '0885786135', 'suthasinee@gmail.com', 'sutha', '$2y$10$naC9aUhFHfxUJz4Bs8mo2.TWrZveCqMqygrHM4IZqE/37Bf.MnAzS', '0'),
(4, 'ปุรินทร์', 'บัวนวน', '0891341486', 'purin@gmail.com', 'purin', '$2y$10$DaiTQhdqFEx7TgJKoewJy.TmGzXhycRnjrdmp0uYqHo/OLgTaHFfa', '0'),
(5, 'แอดมิน', 'ใจบุญ', '0887894561', 'admin@gmail.com', 'admin', '$2y$10$o9N/SUKnReuQ/KkGM/9EMOdBpldS/Etf/VC1ThJ01bNXVLydICuA6', '1'),
(9, 'แอดมิน2', 'ใจดี', '0456789451', 'admin2@gmail.com', 'admin2', '$2y$10$xc89XefbfIVeq0g5sdhyp.uf2G/sNOGFWYNUNssJ3Egra/uFtdo3a', '1'),
(10, 'สุธาสินี', 'บัวนวน', '0636491885', 'suthasinee@gmail.com', 'sutha', '$2y$10$g8seaB2YfRRPIKT4lks3EuWUpYmARsj2t9YAczHU70u8083ZBaYGK', '1'),
(11, 'ปุรินทร์', 'บัวนวน', '0465478998', 'test@gmail.com', 'test1', '$2y$10$uftFb1e.HowWRZhdQ8PjM.smCKuaDgWmwdI.8K1svBvrup2x26/pG', '1'),
(12, 'เทส2', 'ทดสอบ2', '0356456487', 'polsamano@hotmail.com', 'test2', '$2y$10$GTPAWB1zISprunTX.RcAb.YP6oSKKRCewm7Ka4PvZdKFk0aGYq/gm', '1'),
(13, 'gmlasd', 'adasd', '036678797', 'test21121@gmail.com', 'ad', '$2y$10$xAuTX3gMiPuEgSAqzvJZ6ecE3LglpbxYBKG0QMOjV5K6Xinyz8cKK', '1'),
(14, 'ภูรีพัฒน์', 'ใจดี', '0456789458', 'polsamano@hotmail.com', '123121', '$2y$10$2tILVwJeOqMH6LJtFsxgd.U9uiHP3yn4oDtVz2y0gw3fR8nUrnF1m', '1'),
(15, 'ปาล์ม', 'ใจบุญ', '9999999999', 'moszamathai17@gmail.com', '1213', '$2y$10$KU9V44EUTza0sg00dVDK1eSmR/7lHWQaNWnKtKCyVHSADZh2Coa5K', '1'),
(16, 'ปาล์ม', 'ทดสอบ2', '2132454545', 'user2131@gmail.com', '12231', '$2y$10$/eH/EmbxyFnEuXbcgI02U.06FjDiXJSObX7DrGXYTup1ViCGY9k6W', '1'),
(19, 'ยูสเซอร์', 'ใหม่นะจ๊ะ', '0234546468', 'Phureepat@gmail.com', 'Palm22122548', '$2y$10$fk6B9XIz1qoyKu/DtPwSO.20PinpfpW0YiigvOQINU4FNafX.n6mu', '0');

-- --------------------------------------------------------

--
-- Table structure for table `orderdetails`
--

CREATE TABLE `orderdetails` (
  `OrderID` int(11) NOT NULL COMMENT 'รหัสการสั่งซื้อ',
  `ProductID` int(11) NOT NULL COMMENT 'รหัสสินค้า',
  `Quantity` int(10) UNSIGNED NOT NULL COMMENT 'จำนวนสินค้าที่สั่งซื้อ',
  `PriceSum` float(10,2) UNSIGNED NOT NULL COMMENT 'ราคารวม'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `orderdetails`
--

INSERT INTO `orderdetails` (`OrderID`, `ProductID`, `Quantity`, `PriceSum`) VALUES
(18, 4, 2, 350.00),
(18, 7, 1, 650.00),
(19, 4, 1, 175.00),
(19, 7, 1, 650.00),
(20, 4, 1, 175.00),
(20, 10, 1, 800.00),
(21, 8, 1, 600.00),
(22, 9, 1, 850.00),
(23, 4, 1, 175.00),
(24, 12, 1, 200.00),
(25, 12, 1, 200.00);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `OrderID` int(11) NOT NULL COMMENT 'รหัสการสั่งซื้อ',
  `MemberID` int(11) NOT NULL COMMENT 'รหัสสมาชิก',
  `OrderDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT 'วันที่สั่งซื้อ',
  `ShippingAddress` text NOT NULL COMMENT 'ที่อยู่จัดส่ง',
  `TotalPrice` float(10,2) NOT NULL COMMENT 'ราคารวม',
  `OrderStatus` varchar(100) NOT NULL COMMENT 'สถานะการสั่งซื้อ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`OrderID`, `MemberID`, `OrderDate`, `ShippingAddress`, `TotalPrice`, `OrderStatus`) VALUES
(18, 19, '2024-03-06 07:43:09', 'ภูรีพัฒน์ บัวนวน 63/3 เบอร์โทรติดต่อ :0885786135', 1000.00, 'ลูกค้ารับสินค้าแล้ว'),
(19, 18, '2024-03-06 07:43:28', 'สุธาสินี ใจดี 22/2 เบอร์โทรติดต่อ :0636491885', 825.00, 'ลูกค้ารับสินค้าแล้ว'),
(20, 18, '2024-03-06 07:43:32', 'ปาล์ม ใจดี 63/3 เบอร์โทรติดต่อ :0636491885', 975.00, 'ลูกค้ารับสินค้าแล้ว'),
(21, 19, '2024-03-04 08:06:41', 'แอดมิน2 จอกทอง sadsad เบอร์โทรติดต่อ :0456789451', 600.00, 'ยกเลิก'),
(22, 19, '2024-03-04 10:26:24', 'ภูรีพัฒน์ ควยโต 111213 เบอร์โทรติดต่อ :0885784456', 850.00, 'ยกเลิก'),
(23, 18, '2024-03-04 10:31:38', 'แอดมิน2 จอกทอง 1213 เบอร์โทรติดต่อ :0636491885', 175.00, 'ยกเลิก'),
(24, 19, '2024-03-04 15:49:43', 'สุธาสินี ควยโต 123113 เบอร์โทรติดต่อ :0885786135', 200.00, 'รอดำเนินการชำระเงิน'),
(25, 19, '2024-03-06 06:45:48', 'ภูรีพัฒน์ บัวนวน 63/3 เบอร์โทรติดต่อ :0636491885', 200.00, 'รอดำเนินการชำระเงิน');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `PaymentID` int(11) NOT NULL COMMENT 'รหัสการชำระเงิน',
  `OrderID` int(11) NOT NULL COMMENT 'รหัสการสั่งซื้อ',
  `PaymentDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT 'วันที่ชำระเงิน',
  `ProofofPayment` text NOT NULL COMMENT 'หลักฐานการชำระเงิน'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`PaymentID`, `OrderID`, `PaymentDate`, `ProofofPayment`) VALUES
(5, 18, '2024-03-04 06:23:09', 'pay_65e568cd47562.jpg'),
(6, 19, '2024-03-04 06:54:49', 'pay_65e570396674e.jpg'),
(7, 20, '2024-03-04 07:58:49', 'pay_65e57f396ba16.jpg'),
(8, 21, '2024-03-04 08:05:39', 'pay_65e580d3cf76f.jpg'),
(9, 22, '2024-03-04 10:23:31', 'pay_65e5a123a5263.png'),
(10, 23, '2024-03-04 10:31:10', 'pay_65e5a2ee40e1c.png');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `ProductID` int(11) NOT NULL COMMENT 'รหัสสินค้า',
  `ProductName` varchar(30) NOT NULL COMMENT 'ชื่อสินค้า',
  `TypeID` int(11) NOT NULL COMMENT 'รหัสประเภทสินค้า',
  `Description` text NOT NULL COMMENT 'คำอธิบายสินค้า',
  `Price` float(10,2) NOT NULL COMMENT 'ราคาสินค้า',
  `Stock` int(10) UNSIGNED NOT NULL COMMENT 'จำนวนสินค้า',
  `Image` text NOT NULL COMMENT 'รูปภาพสินค้า'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`ProductID`, `ProductName`, `TypeID`, `Description`, `Price`, `Stock`, `Image`) VALUES
(4, 'เซรั่ม Nivea', 3, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 175.00, 40, 'pro_65daf28cd278f.png'),
(7, 'จอยสติ๊ก', 3, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 650.00, 40, 'pro_65dc3185579b4.jpg'),
(8, 'นาฬิกาเลี่ยมทอง', 6, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 600.00, 40, 'pro_65dc319b0b565.png'),
(9, 'เคสคอมพิวเตอร์ msi', 9, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 850.00, 40, 'pro_65ddbeb4d2b70.png'),
(10, 'แรม ddr4 4gb', 8, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum', 800.00, 40, 'pro_65de0ff2ef46b.jpg'),
(12, 'mouse gaming', 9, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum', 200.00, 58, 'pro_65e5a3ab217db.png');

-- --------------------------------------------------------

--
-- Table structure for table `shoppingcart`
--

CREATE TABLE `shoppingcart` (
  `MemberID` int(11) NOT NULL COMMENT 'รหัสสมาชิก',
  `ProductID` int(11) NOT NULL COMMENT 'รหัสสินค้า',
  `Quantity` int(10) UNSIGNED NOT NULL COMMENT 'จำนวนสินค้าที่เก็บ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `type`
--

CREATE TABLE `type` (
  `TypeID` int(11) NOT NULL COMMENT 'รหัสประเภทสินค้า',
  `TypeName` varchar(50) NOT NULL COMMENT 'ชื่อประเภทสินค้า'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `type`
--

INSERT INTO `type` (`TypeID`, `TypeName`) VALUES
(3, 'ประเภทที่ 1'),
(6, 'ประเภทที่ 3'),
(8, 'ประเภทที่ 4'),
(9, 'ประเภทที่ 5'),
(10, 'ประเภทที่ 6');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`CommentID`),
  ADD KEY `ProductID` (`ProductID`),
  ADD KEY `MemberID` (`MemberID`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`MemberID`);

--
-- Indexes for table `orderdetails`
--
ALTER TABLE `orderdetails`
  ADD KEY `ProductID` (`ProductID`),
  ADD KEY `OrderID` (`OrderID`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`OrderID`),
  ADD KEY `MemberID` (`MemberID`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`PaymentID`),
  ADD KEY `OrderID` (`OrderID`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`ProductID`),
  ADD KEY `TypeID` (`TypeID`) USING BTREE;

--
-- Indexes for table `shoppingcart`
--
ALTER TABLE `shoppingcart`
  ADD KEY `MemberID` (`MemberID`),
  ADD KEY `fk_ProductID` (`ProductID`);

--
-- Indexes for table `type`
--
ALTER TABLE `type`
  ADD PRIMARY KEY (`TypeID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `CommentID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสแสดงความคิดเห็น', AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `MemberID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสสมาชิก', AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `OrderID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสการสั่งซื้อ', AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `PaymentID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสการชำระเงิน', AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `ProductID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสสินค้า', AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `type`
--
ALTER TABLE `type`
  MODIFY `TypeID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสประเภทสินค้า', AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`ProductID`) REFERENCES `products` (`ProductID`),
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`MemberID`) REFERENCES `member` (`MemberID`);

--
-- Constraints for table `orderdetails`
--
ALTER TABLE `orderdetails`
  ADD CONSTRAINT `orderdetails_ibfk_1` FOREIGN KEY (`OrderID`) REFERENCES `orders` (`OrderID`),
  ADD CONSTRAINT `orderdetails_ibfk_2` FOREIGN KEY (`ProductID`) REFERENCES `products` (`ProductID`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`MemberID`) REFERENCES `member` (`MemberID`);

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`OrderID`) REFERENCES `orders` (`OrderID`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`TypeID`) REFERENCES `type` (`TypeID`);

--
-- Constraints for table `shoppingcart`
--
ALTER TABLE `shoppingcart`
  ADD CONSTRAINT `fk_ProductID` FOREIGN KEY (`ProductID`) REFERENCES `products` (`ProductID`),
  ADD CONSTRAINT `shoppingcart_ibfk_1` FOREIGN KEY (`MemberID`) REFERENCES `member` (`MemberID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
