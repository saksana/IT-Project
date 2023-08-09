-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 05, 2023 at 05:13 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `it_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbadmin`
--

CREATE TABLE `tbadmin` (
  `adminid` int(11) NOT NULL,
  `adminname` varchar(100) NOT NULL,
  `tel` varchar(50) NOT NULL,
  `department` varchar(100) NOT NULL,
  `office` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbadmin`
--

INSERT INTO `tbadmin` (`adminid`, `adminname`, `tel`, `department`, `office`, `username`, `password`) VALUES
(1, 'ທ. ສັກສະນະ ສຸທຳມະວົງ', '02098586689', 'ໄອທີ', 'ສຳນັກງານໃຫຍ່', 'saksana', '1234'),
(2, 'ທ. ລັດຕິກອນ ທົງໄຊ', '02054258905', 'ໄອທີ', 'ສຳນັກງານໃຫຍ່', 'latikone', '1234'),
(5, 'ທ. ອານຸສອນ ຈັນດາລາ', '02093199436', 'ໄອທີ', 'ສຳນັກງານໃຫຍ່', 'anousone', '1234'),
(15, 'ທ. ເຂັມພອນ ຈັນສຸວັນ', '02059932922', 'ໄອທີ', 'ສຳນັກງານໃຫຍ່', 'khemphone', '1234');

-- --------------------------------------------------------

--
-- Table structure for table `tbbrand`
--

CREATE TABLE `tbbrand` (
  `bdid` int(11) NOT NULL,
  `bdname` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbbrand`
--

INSERT INTO `tbbrand` (`bdid`, `bdname`) VALUES
(1, 'Lenovo'),
(2, 'Dell'),
(3, 'HP'),
(4, 'Acer'),
(5, 'Compaq'),
(6, 'No Brand');

-- --------------------------------------------------------

--
-- Table structure for table `tbdataan`
--

CREATE TABLE `tbdataan` (
  `antid` varchar(20) NOT NULL,
  `antdate` datetime NOT NULL,
  `adminid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `device` varchar(50) NOT NULL,
  `brand` varchar(50) NOT NULL,
  `sn` varchar(50) NOT NULL,
  `os` varchar(50) NOT NULL,
  `uninstall` varchar(20) NOT NULL,
  `install` varchar(20) NOT NULL,
  `scan` varchar(20) NOT NULL,
  `detail` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbdataan`
--

INSERT INTO `tbdataan` (`antid`, `antdate`, `adminid`, `userid`, `device`, `brand`, `sn`, `os`, `uninstall`, `install`, `scan`, `detail`) VALUES
('AN230804024043', '2023-08-04 09:41:12', 1, 15, 'Computer Laptop', 'Dell', '', 'Windows 10', 'ສຳເລັດ', 'ສຳເລັດ', 'ສຳເລັດ', ''),
('AN230804024325', '2023-08-04 14:43:40', 1, 12, 'Computer Desktop', 'Acer', '', 'Windows 11', 'ສຳເລັດ', 'ສຳເລັດ', 'ສຳເລັດ', ''),
('AN230804085014', '2023-08-04 03:50:47', 1, 14, 'Computer Desktop', 'Dell', '', 'Windows 10', 'ສຳເລັດ', 'ສຳເລັດ', 'ສຳເລັດ', '555');

-- --------------------------------------------------------

--
-- Table structure for table `tbdepartment`
--

CREATE TABLE `tbdepartment` (
  `deid` varchar(5) NOT NULL,
  `dename` varchar(100) NOT NULL,
  `partid` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbdepartment`
--

INSERT INTO `tbdepartment` (`deid`, `dename`, `partid`) VALUES
('D01', 'ດຳເນີນງານ', 'P01'),
('D02', 'BD', 'P01'),
('D03', 'ບຸກຄະລາກອນ', 'P01'),
('D04', 'ບໍລິຫານ', 'P01'),
('D05', 'ໄອທີ', 'P01'),
('D06', 'ບັນຊີ', 'P02'),
('D07', 'ການເງິນ', 'P02'),
('D08', 'ກວດສອບ (Stock Control)', 'P02'),
('D09', 'ຂາຍ', 'P03'),
('D10', 'MT', 'P03'),
('D11', 'ການຕະຫຼາດ', 'P03'),
('D12', 'ບໍລິຫານການຄ້າ (Sale Admin)', 'P03'),
('D13', 'CRM', 'P03'),
('D14', 'ຈັດຊື້', 'P04'),
('D15', 'ສາງ', 'P04'),
('D16', 'ຂົນສົ່ງ', 'P04');

-- --------------------------------------------------------

--
-- Table structure for table `tboffice`
--

CREATE TABLE `tboffice` (
  `officeid` varchar(10) NOT NULL,
  `officename` varchar(50) NOT NULL,
  `province` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tboffice`
--

INSERT INTO `tboffice` (`officeid`, `officename`, `province`) VALUES
('CPS-01', 'ຫ້ອງການສາຂາຈຳປາສັກ', 'ຈຳປາສັກ'),
('CPS-02', 'ສາງຫຼັກ13ຈຳປາສັກ', 'ຈຳປາສັກ'),
('LPB-01', 'ສາຂາແລະສາງຫຼວງພະບາງ', 'ຫຼວງພະບາງ'),
('ODX-01', 'ສາຂາແລະສາງອຸດົມໄຊ', 'ອຸດົມໄຊ'),
('SVK-01', 'ຫ້ອງການສາຂາແລະສາງສະຫັວນນະເຂດ', 'ສະຫັວນນະເຂດ'),
('SVK-02', 'ສາງຫຼັກ4ສະຫັວນນະເຂດ', 'ສະຫັວນນະເຂດ'),
('VTE-01', 'ສຳນັກງານໃຫຍ່ນະຄອນຫຼວງ', 'ນະຄອນຫຼວງວຽງຈັນ'),
('VTE-02', 'ສາງເກດລາວ', 'ນະຄອນຫຼວງວຽງຈັນ'),
('VTE-03', 'ສາງດົງປາແຫຼບ', 'ນະຄອນຫຼວງວຽງຈັນ'),
('VTE-04', 'ສາງໂພນຕ້ອງ1', 'ນະຄອນຫຼວງວຽງຈັນ'),
('VTE-05', 'ສາງໂພນຕ້ອງ2', 'ນະຄອນຫຼວງວຽງຈັນ'),
('XKH-01', 'ສາຂາແລະສາງຊຽງຂວາງ', 'ຊຽງຂວາງ');

-- --------------------------------------------------------

--
-- Table structure for table `tbos`
--

CREATE TABLE `tbos` (
  `osid` int(11) NOT NULL,
  `osname` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbos`
--

INSERT INTO `tbos` (`osid`, `osname`) VALUES
(1, 'Windows 7'),
(2, 'Windows 8'),
(3, 'Windows 10'),
(4, 'Windows 11');

-- --------------------------------------------------------

--
-- Table structure for table `tbpart`
--

CREATE TABLE `tbpart` (
  `partid` varchar(5) NOT NULL,
  `partname` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbpart`
--

INSERT INTO `tbpart` (`partid`, `partname`) VALUES
('P01', 'ດຳເນີນງານ'),
('P02', 'ບັນຊີ-ການເງິນ'),
('P03', 'ການຄ້າ'),
('P04', 'ສະໜອງ');

-- --------------------------------------------------------

--
-- Table structure for table `tbstatus`
--

CREATE TABLE `tbstatus` (
  `sttid` varchar(5) NOT NULL,
  `sttname` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbstatus`
--

INSERT INTO `tbstatus` (`sttid`, `sttname`) VALUES
('S01', 'ລໍຖ້າດຳເນີນງານ'),
('S02', 'ກຳລັງດຳເນີນງານ'),
('S03', 'ດຳເນີນງານສຳເລັດ'),
('S04', 'ຍົກເລີກລາຍການ');

-- --------------------------------------------------------

--
-- Table structure for table `tbticket`
--

CREATE TABLE `tbticket` (
  `ticketid` varchar(20) NOT NULL,
  `ticketdate` datetime NOT NULL,
  `userid` int(11) NOT NULL,
  `ticketinfo` varchar(50) NOT NULL,
  `tickettype` varchar(50) NOT NULL,
  `detail` text NOT NULL,
  `img` text NOT NULL,
  `sttid` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbticket`
--

INSERT INTO `tbticket` (`ticketid`, `ticketdate`, `userid`, `ticketinfo`, `tickettype`, `detail`, `img`, `sttid`) VALUES
('T230803160929', '2023-08-03 16:09:29', 15, 'Hardware', 'ຄອມພິວເຕີ້', 'RAM ຕາຍ', '', 'S04'),
('T230803161000', '2023-08-03 16:10:00', 15, 'Software', 'ໂປແກຮມຕິດຕັ້ງ', 'antivirus ບໍ່ໄດ້', '', 'S03'),
('T230803161205', '2023-08-03 16:12:05', 14, 'Hardware', 'ປິ້ນເຕີ້', 'ປິ້ນບໍ່ໄດ້', '', 'S03');

-- --------------------------------------------------------

--
-- Table structure for table `tbtickettype`
--

CREATE TABLE `tbtickettype` (
  `tickettypeid` varchar(5) NOT NULL,
  `tickettypename` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbtickettype`
--

INSERT INTO `tbtickettype` (`tickettypeid`, `tickettypename`) VALUES
('C01', 'ຄອມພິວເຕີ້'),
('C02', 'ປິ້ນເຕີ້'),
('C03', 'ແທັບເລັດ'),
('C04', 'ປິ້ນເຕີ້ຂອງແທັບເລັດ'),
('C05', 'Network & Internet'),
('C06', 'ບັດເຂົ້າອອກຫ້ອງການ ຫຼື ບັດພະນັກງານ'),
('C07', 'ອີເມວ & Office365'),
('C08', 'ໂປແກຮມຕິດຕັ້ງ'),
('C09', 'ກ້ອງວົງຈອນປິດ CCTV');

-- --------------------------------------------------------

--
-- Table structure for table `tbupdateticket`
--

CREATE TABLE `tbupdateticket` (
  `upticketid` int(11) NOT NULL,
  `upticketdate` datetime NOT NULL,
  `sttid` varchar(5) NOT NULL,
  `upticketdetail` text NOT NULL,
  `ticketid` varchar(20) NOT NULL,
  `admin` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbupdateticket`
--

INSERT INTO `tbupdateticket` (`upticketid`, `upticketdate`, `sttid`, `upticketdetail`, `ticketid`, `admin`) VALUES
(26, '2023-08-03 16:09:29', 'S01', 'ສ້າງລາຍການໃໝ່', 'T230803160929', 'ຜູ້ໃຊ້ງານ'),
(27, '2023-08-03 16:10:00', 'S01', 'ສ້າງລາຍການໃໝ່', 'T230803161000', 'ຜູ້ໃຊ້ງານ'),
(28, '2023-08-03 16:12:05', 'S01', 'ສ້າງລາຍການໃໝ່', 'T230803161205', 'ຜູ້ໃຊ້ງານ'),
(29, '2023-08-03 16:31:08', 'S03', 'ປ່ຽນ Ram ໃຫມ່', 'T230803160929', 'ທ. ສັກສະນະ ສຸທຳມະວົງ'),
(30, '2023-08-03 16:54:17', 'S02', 'ກຳລັງກວດສອບ', 'T230803161205', 'ທ. ສັກສະນະ ສຸທຳມະວົງ'),
(31, '2023-08-03 19:56:29', 'S02', 'ກຳລັງກວດສອບ', 'T230803161000', 'ທ. ລັດຕິກອນ ທົງໄຊ'),
(32, '2023-08-04 08:49:33', 'S03', 'ok', 'T230803161000', 'ທ. ສັກສະນະ ສຸທຳມະວົງ'),
(33, '2023-08-04 14:35:32', 'S03', 'ແປງໃຫ້ແລ້ວ', 'T230803161205', 'ທ. ສັກສະນະ ສຸທຳມະວົງ'),
(34, '2023-08-04 15:50:36', 'S04', 'ແຈ້ງຜິດ', 'T230803160929', 'ທ. ສັກສະນະ ສຸທຳມະວົງ');

-- --------------------------------------------------------

--
-- Table structure for table `tbuser`
--

CREATE TABLE `tbuser` (
  `userid` int(11) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `tel` varchar(15) NOT NULL,
  `position` varchar(80) NOT NULL,
  `partid` varchar(5) NOT NULL,
  `deid` varchar(5) NOT NULL,
  `officeid` varchar(10) NOT NULL,
  `status` varchar(10) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbuser`
--

INSERT INTO `tbuser` (`userid`, `fullname`, `tel`, `position`, `partid`, `deid`, `officeid`, `status`, `username`, `password`) VALUES
(12, 'ນ ເພັດຖະໜອມ', '02054569465', 'ຜູ້ຈັດການອາວຸໂສ', 'P01', 'D01', 'VTE-01', 'Active', 'test1', '1234'),
(13, 'ທ ສຸກສາຄອນ ປັນຍາສິລິ', '02055552477', 'ຜູຈັດການ', 'P01', 'D04', 'VTE-01', 'Active', 'test', '1234'),
(14, 'ທ ຈັດຕຸລະໄຊ ບົວຕຸມ', '02055531417', 'ຜູ້ຈັດການ', 'P03', 'D12', 'VTE-01', 'Active', 'test2', '1234'),
(15, 'ນ ນັດທະພອນ ກອງມະນີຈັນ', '02055566371', 'ພະນັກງານທົ່ວໄປ', 'P04', 'D14', 'VTE-01', 'Active', 'test3', '1234');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbadmin`
--
ALTER TABLE `tbadmin`
  ADD PRIMARY KEY (`adminid`);

--
-- Indexes for table `tbbrand`
--
ALTER TABLE `tbbrand`
  ADD PRIMARY KEY (`bdid`);

--
-- Indexes for table `tbdataan`
--
ALTER TABLE `tbdataan`
  ADD PRIMARY KEY (`antid`);

--
-- Indexes for table `tbdepartment`
--
ALTER TABLE `tbdepartment`
  ADD PRIMARY KEY (`deid`);

--
-- Indexes for table `tboffice`
--
ALTER TABLE `tboffice`
  ADD PRIMARY KEY (`officeid`);

--
-- Indexes for table `tbos`
--
ALTER TABLE `tbos`
  ADD PRIMARY KEY (`osid`);

--
-- Indexes for table `tbpart`
--
ALTER TABLE `tbpart`
  ADD PRIMARY KEY (`partid`);

--
-- Indexes for table `tbstatus`
--
ALTER TABLE `tbstatus`
  ADD PRIMARY KEY (`sttid`);

--
-- Indexes for table `tbticket`
--
ALTER TABLE `tbticket`
  ADD PRIMARY KEY (`ticketid`);

--
-- Indexes for table `tbtickettype`
--
ALTER TABLE `tbtickettype`
  ADD PRIMARY KEY (`tickettypeid`);

--
-- Indexes for table `tbupdateticket`
--
ALTER TABLE `tbupdateticket`
  ADD PRIMARY KEY (`upticketid`);

--
-- Indexes for table `tbuser`
--
ALTER TABLE `tbuser`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbadmin`
--
ALTER TABLE `tbadmin`
  MODIFY `adminid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `tbbrand`
--
ALTER TABLE `tbbrand`
  MODIFY `bdid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbos`
--
ALTER TABLE `tbos`
  MODIFY `osid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbupdateticket`
--
ALTER TABLE `tbupdateticket`
  MODIFY `upticketid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `tbuser`
--
ALTER TABLE `tbuser`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
