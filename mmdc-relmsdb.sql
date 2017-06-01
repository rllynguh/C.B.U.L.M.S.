-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 29, 2017 at 09:25 AM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `relms`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbladdress`
--

CREATE TABLE `tbladdress` (
  `intAddrCode` int(11) NOT NULL,
  `strAddrNum` char(10) NOT NULL,
  `strAddrStreet` char(30) DEFAULT NULL,
  `strAddrDistrict` char(30) DEFAULT NULL,
  `intCityCode` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblbank`
--

CREATE TABLE `tblbank` (
  `intBankCode` int(11) NOT NULL,
  `strBankDesc` char(40) NOT NULL,
  `boolIsActive` tinyint(1) NOT NULL DEFAULT '1',
  `boolIsDeleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblbuilding`
--

CREATE TABLE `tblbuilding` (
  `intBuilCode` int(11) NOT NULL,
  `strBuilCode` char(20) NOT NULL,
  `strBuilDesc` char(30) NOT NULL,
  `intBuilTypeCode` int(11) NOT NULL,
  `intBuilNumOfFloor` int(11) NOT NULL,
  `intAddrCode` int(11) NOT NULL,
  `boolIsActive` tinyint(1) NOT NULL DEFAULT '1',
  `boolIsDeleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblbuildingtype`
--

CREATE TABLE `tblbuildingtype` (
  `intBuilTypeCode` int(11) NOT NULL,
  `strBuilTypeDesc` char(30) NOT NULL,
  `boolIsActive` tinyint(1) NOT NULL DEFAULT '1',
  `boolIsDeleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblbusinesstype`
--

CREATE TABLE `tblbusinesstype` (
  `intBusiTypeCode` int(11) NOT NULL,
  `strBusiTypeDesc` char(30) NOT NULL,
  `boolIsActive` tinyint(1) NOT NULL DEFAULT '1',
  `boolIsDeleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblcity`
--

CREATE TABLE `tblcity` (
  `intCityCode` int(11) NOT NULL,
  `strCityDesc` char(30) NOT NULL,
  `intProvinceCode` int(11) NOT NULL,
  `boolIsActive` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblcity`
--

INSERT INTO `tblcity` (`intCityCode`, `strCityDesc`, `intProvinceCode`, `boolIsActive`) VALUES
(3, 'Manila', 1, 1),
(4, 'Makati', 1, 1),
(5, 'Marikina', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblcontractcontent`
--

CREATE TABLE `tblcontractcontent` (
  `intContContCode` int(11) NOT NULL,
  `txtContContDesc` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblcontractdetail`
--

CREATE TABLE `tblcontractdetail` (
  `strContCode` char(20) NOT NULL,
  `intContContCode` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblcontractextend`
--

CREATE TABLE `tblcontractextend` (
  `strContractHeaderCode` char(20) NOT NULL,
  `datEndOfContract` date NOT NULL,
  `datDateExtended` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblcontractheader`
--

CREATE TABLE `tblcontractheader` (
  `strContCode` char(20) NOT NULL,
  `strOffeSheeCode` char(20) NOT NULL,
  `datEndOfContract` date NOT NULL,
  `datDateIssued` date NOT NULL,
  `datDateOfBiiling` date NOT NULL,
  `intStatus` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblcontracttermination`
--

CREATE TABLE `tblcontracttermination` (
  `strTermiHeader` char(20) NOT NULL,
  `strContCode` char(20) NOT NULL,
  `dateDateEnded` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblfloor`
--

CREATE TABLE `tblfloor` (
  `intFloorCode` int(11) NOT NULL,
  `intFloorNum` int(11) NOT NULL,
  `intBuilCode` int(11) NOT NULL,
  `intNumOfUnit` int(11) NOT NULL,
  `boolIsActive` tinyint(1) NOT NULL DEFAULT '1',
  `boolIsDeleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblmarketrate`
--

CREATE TABLE `tblmarketrate` (
  `intCityCode` int(11) NOT NULL,
  `dblRate` double NOT NULL,
  `dtmDateAsOf` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbloffersheetdetail`
--

CREATE TABLE `tbloffersheetdetail` (
  `strOffeSheeCode` char(20) NOT NULL,
  `intUnitCode` int(11) NOT NULL,
  `dblOSUnitPrice` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbloffersheetheader`
--

CREATE TABLE `tbloffersheetheader` (
  `strOffeSheeCode` char(20) NOT NULL,
  `intRegiCode` int(11) NOT NULL,
  `datOSDate` date NOT NULL,
  `intStatus` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblparkarea`
--

CREATE TABLE `tblparkarea` (
  `intParkAreaCode` int(11) NOT NULL,
  `strParkAreaDesc` char(10) NOT NULL,
  `intFloorCode` int(11) NOT NULL,
  `intNumOfSpace` int(11) NOT NULL,
  `dblParkAreaSize` double NOT NULL,
  `boolIsActive` tinyint(1) NOT NULL DEFAULT '1',
  `boolIsDeleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblparkrate`
--

CREATE TABLE `tblparkrate` (
  `intBuilCode` int(11) NOT NULL,
  `dblParkRate` double NOT NULL,
  `dtmParkRateDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblparkspace`
--

CREATE TABLE `tblparkspace` (
  `intParkSpaceCode` int(11) NOT NULL,
  `strParkSpaceDesc` char(10) NOT NULL,
  `intParkAreaCode` int(11) NOT NULL,
  `intParkSpaceNumber` int(11) NOT NULL,
  `dblParkSpaceSize` double NOT NULL,
  `boolIsDeleted` tinyint(1) NOT NULL DEFAULT '0',
  `boolIsActive` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblpaymentcollection`
--

CREATE TABLE `tblpaymentcollection` (
  `strCollectionHeader` char(20) NOT NULL,
  `strContCode` char(20) NOT NULL,
  `intPaymModeCode` int(11) NOT NULL DEFAULT '0' COMMENT '0-cash,1-post-datedcheque',
  `datDateAsOf` date NOT NULL,
  `intBankCode` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblprovince`
--

CREATE TABLE `tblprovince` (
  `intProvinceCode` int(11) NOT NULL,
  `strProvinceDesc` varchar(20) NOT NULL,
  `boolIsActive` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblprovince`
--

INSERT INTO `tblprovince` (`intProvinceCode`, `strProvinceDesc`, `boolIsActive`) VALUES
(1, 'Metro Manila', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblregistrationdetail`
--

CREATE TABLE `tblregistrationdetail` (
  `intRegiCode` int(11) NOT NULL,
  `intUnitCode` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblregistrationheader`
--

CREATE TABLE `tblregistrationheader` (
  `intRegiCode` int(11) NOT NULL,
  `intTenaCode` int(11) NOT NULL,
  `datRegiDate` date NOT NULL,
  `txtRemarks` text NOT NULL,
  `intStatus` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblrepresentative`
--

CREATE TABLE `tblrepresentative` (
  `intReprCode` int(11) NOT NULL,
  `strReprFirst` char(30) NOT NULL,
  `strReprMid` char(30) NOT NULL,
  `strReprLast` char(30) NOT NULL,
  `intPosiCode` int(11) NOT NULL,
  `strReprEmail` char(20) NOT NULL,
  `strReprTelephone` char(20) NOT NULL,
  `intAddrCode` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblrepresentativeposition`
--

CREATE TABLE `tblrepresentativeposition` (
  `intPosiCode` int(11) NOT NULL,
  `strPosiDesc` char(30) NOT NULL,
  `intIsActive` tinyint(4) NOT NULL DEFAULT '1',
  `intIsDeleted` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblrepresentativeposition`
--

INSERT INTO `tblrepresentativeposition` (`intPosiCode`, `strPosiDesc`, `intIsActive`, `intIsDeleted`) VALUES
(1, 'Manager', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbltenant`
--

CREATE TABLE `tbltenant` (
  `intTenaCode` int(11) NOT NULL,
  `strTenaDesc` char(50) NOT NULL,
  `intBusiTypeCode` int(11) NOT NULL,
  `intReprCode` int(11) NOT NULL,
  `intAddrCode` int(11) NOT NULL,
  `boolIsActive` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblunit`
--

CREATE TABLE `tblunit` (
  `intUnitCode` int(11) NOT NULL,
  `strUnitCode` char(20) NOT NULL,
  `intUnitType` tinyint(4) NOT NULL COMMENT '0-Raw\n1-Shell',
  `dblUnitArea` double NOT NULL,
  `intFloorCode` int(11) NOT NULL,
  `intUnitNumber` int(11) NOT NULL,
  `boolIsActive` tinyint(1) NOT NULL DEFAULT '1',
  `boolIsDeleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblunitprice`
--

CREATE TABLE `tblunitprice` (
  `intUnitCode` int(11) NOT NULL,
  `dtmUnitPriceDateAsOf` datetime NOT NULL,
  `dblUnitPrice` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblutilities`
--

CREATE TABLE `tblutilities` (
  `dblCusa` double UNSIGNED NOT NULL DEFAULT '80',
  `intSecurityDeposit` int(10) UNSIGNED NOT NULL DEFAULT '3' COMMENT 'number of months for security deposit',
  `dblVat` double UNSIGNED NOT NULL DEFAULT '12',
  `dblEwt` double UNSIGNED NOT NULL DEFAULT '1',
  `dblEscalation` double UNSIGNED NOT NULL DEFAULT '1',
  `dblVettingFee` double UNSIGNED NOT NULL DEFAULT '100',
  `dtmDateAsOf` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblutilities`
--

INSERT INTO `tblutilities` (`dblCusa`, `intSecurityDeposit`, `dblVat`, `dblEwt`, `dblEscalation`, `dblVettingFee`, `dtmDateAsOf`) VALUES
(80, 3, 12, 1, 1, 100, '2017-03-28 00:00:00'),
(80, 3, 12, 12, 1, 100, '2017-03-29 07:09:16'),
(80, 3, 12, 5, 1, 100, '2017-03-29 07:10:09'),
(80, 3, 12, 5, 1, 0, '2017-03-29 07:14:18'),
(80, 3, 12, 5, 1, 80, '2017-03-29 07:14:21');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbladdress`
--
ALTER TABLE `tbladdress`
  ADD PRIMARY KEY (`intAddrCode`),
  ADD UNIQUE KEY `strAddrCode_UNIQUE` (`intAddrCode`),
  ADD KEY `cityyadd_idx` (`intCityCode`);

--
-- Indexes for table `tblbank`
--
ALTER TABLE `tblbank`
  ADD PRIMARY KEY (`intBankCode`),
  ADD UNIQUE KEY `strBankCode_UNIQUE` (`intBankCode`),
  ADD UNIQUE KEY `strBankDesc_UNIQUE` (`strBankDesc`);

--
-- Indexes for table `tblbuilding`
--
ALTER TABLE `tblbuilding`
  ADD PRIMARY KEY (`intBuilCode`),
  ADD UNIQUE KEY `strBuilDesc_UNIQUE` (`strBuilDesc`),
  ADD KEY `fk__idx` (`intBuilTypeCode`),
  ADD KEY `fk_builaddcode_idx` (`intAddrCode`);

--
-- Indexes for table `tblbuildingtype`
--
ALTER TABLE `tblbuildingtype`
  ADD PRIMARY KEY (`intBuilTypeCode`),
  ADD UNIQUE KEY `strBuildTypeDesc_UNIQUE` (`strBuilTypeDesc`),
  ADD UNIQUE KEY `strBuildTypeCode_UNIQUE` (`intBuilTypeCode`);

--
-- Indexes for table `tblbusinesstype`
--
ALTER TABLE `tblbusinesstype`
  ADD PRIMARY KEY (`intBusiTypeCode`),
  ADD UNIQUE KEY `strBusiTypeCode_UNIQUE` (`intBusiTypeCode`),
  ADD UNIQUE KEY `strBusiTypeDesc_UNIQUE` (`strBusiTypeDesc`);

--
-- Indexes for table `tblcity`
--
ALTER TABLE `tblcity`
  ADD PRIMARY KEY (`intCityCode`),
  ADD UNIQUE KEY `intCityCode_UNIQUE` (`intCityCode`),
  ADD UNIQUE KEY `strCityName_UNIQUE` (`strCityDesc`),
  ADD KEY `provCity_idx` (`intProvinceCode`);

--
-- Indexes for table `tblcontractcontent`
--
ALTER TABLE `tblcontractcontent`
  ADD PRIMARY KEY (`intContContCode`);

--
-- Indexes for table `tblcontractdetail`
--
ALTER TABLE `tblcontractdetail`
  ADD KEY `fk_contcont_idx` (`intContContCode`),
  ADD KEY `fk_contheadcont` (`strContCode`);

--
-- Indexes for table `tblcontractextend`
--
ALTER TABLE `tblcontractextend`
  ADD KEY `fk_extendContr_idx` (`strContractHeaderCode`);

--
-- Indexes for table `tblcontractheader`
--
ALTER TABLE `tblcontractheader`
  ADD PRIMARY KEY (`strContCode`),
  ADD UNIQUE KEY `strContCode_UNIQUE` (`strContCode`),
  ADD KEY `fk_oscont_idx` (`strOffeSheeCode`);

--
-- Indexes for table `tblcontracttermination`
--
ALTER TABLE `tblcontracttermination`
  ADD PRIMARY KEY (`strTermiHeader`),
  ADD KEY `fk_termiContra_idx` (`strContCode`);

--
-- Indexes for table `tblfloor`
--
ALTER TABLE `tblfloor`
  ADD PRIMARY KEY (`intFloorCode`),
  ADD UNIQUE KEY `strFloorCode_UNIQUE` (`intFloorCode`),
  ADD KEY `fk_builfloor_idx` (`intBuilCode`);

--
-- Indexes for table `tblmarketrate`
--
ALTER TABLE `tblmarketrate`
  ADD KEY `cityRate_idx` (`intCityCode`);

--
-- Indexes for table `tbloffersheetdetail`
--
ALTER TABLE `tbloffersheetdetail`
  ADD KEY `fk_osoffer_idx` (`strOffeSheeCode`),
  ADD KEY `fk_unitoffersheet_idx` (`intUnitCode`);

--
-- Indexes for table `tbloffersheetheader`
--
ALTER TABLE `tbloffersheetheader`
  ADD PRIMARY KEY (`strOffeSheeCode`),
  ADD UNIQUE KEY `strOffeSheeCode_UNIQUE` (`strOffeSheeCode`),
  ADD KEY `fk_osregi_idx` (`intRegiCode`);

--
-- Indexes for table `tblparkarea`
--
ALTER TABLE `tblparkarea`
  ADD PRIMARY KEY (`intParkAreaCode`),
  ADD UNIQUE KEY `intParkAreaCode_UNIQUE` (`intParkAreaCode`),
  ADD KEY `fkFloorPark_idx` (`intFloorCode`);

--
-- Indexes for table `tblparkrate`
--
ALTER TABLE `tblparkrate`
  ADD KEY `builParkRate_idx` (`intBuilCode`);

--
-- Indexes for table `tblparkspace`
--
ALTER TABLE `tblparkspace`
  ADD PRIMARY KEY (`intParkSpaceCode`),
  ADD UNIQUE KEY `intParkSpaceCode_UNIQUE` (`intParkSpaceCode`),
  ADD KEY `parkAreaSpace_idx` (`intParkAreaCode`);

--
-- Indexes for table `tblpaymentcollection`
--
ALTER TABLE `tblpaymentcollection`
  ADD PRIMARY KEY (`strCollectionHeader`),
  ADD KEY `str_bank_idx` (`intBankCode`),
  ADD KEY `str_pay_contra` (`strContCode`);

--
-- Indexes for table `tblprovince`
--
ALTER TABLE `tblprovince`
  ADD PRIMARY KEY (`intProvinceCode`),
  ADD UNIQUE KEY `intProvinceCode_UNIQUE` (`intProvinceCode`);

--
-- Indexes for table `tblregistrationdetail`
--
ALTER TABLE `tblregistrationdetail`
  ADD KEY `fk_regihCOde_idx` (`intRegiCode`),
  ADD KEY `fk_unitregi_idx` (`intUnitCode`);

--
-- Indexes for table `tblregistrationheader`
--
ALTER TABLE `tblregistrationheader`
  ADD PRIMARY KEY (`intRegiCode`),
  ADD KEY `fk_cusomer_idx` (`intTenaCode`);

--
-- Indexes for table `tblrepresentative`
--
ALTER TABLE `tblrepresentative`
  ADD PRIMARY KEY (`intReprCode`),
  ADD UNIQUE KEY `strReprCode_UNIQUE` (`intReprCode`),
  ADD KEY `fk_representativepos_idx` (`intPosiCode`),
  ADD KEY `fk_addrep_idx` (`intAddrCode`);

--
-- Indexes for table `tblrepresentativeposition`
--
ALTER TABLE `tblrepresentativeposition`
  ADD PRIMARY KEY (`intPosiCode`),
  ADD UNIQUE KEY `strPosiCode_UNIQUE` (`intPosiCode`),
  ADD UNIQUE KEY `strPosiDesc_UNIQUE` (`strPosiDesc`);

--
-- Indexes for table `tbltenant`
--
ALTER TABLE `tbltenant`
  ADD PRIMARY KEY (`intTenaCode`),
  ADD UNIQUE KEY `strTenaCode_UNIQUE` (`intTenaCode`),
  ADD UNIQUE KEY `strTenaDesc_UNIQUE` (`strTenaDesc`),
  ADD KEY `qwede_idx` (`intAddrCode`),
  ADD KEY `busitype_idx` (`intBusiTypeCode`),
  ADD KEY `reprconn_idx` (`intReprCode`);

--
-- Indexes for table `tblunit`
--
ALTER TABLE `tblunit`
  ADD PRIMARY KEY (`intUnitCode`),
  ADD UNIQUE KEY `intUnitCode_UNIQUE` (`intUnitCode`),
  ADD KEY `fk_floor_unit_idx` (`intFloorCode`);

--
-- Indexes for table `tblunitprice`
--
ALTER TABLE `tblunitprice`
  ADD KEY `fk_unitpriceunit_idx` (`intUnitCode`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbladdress`
--
ALTER TABLE `tbladdress`
  MODIFY `intAddrCode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tblbank`
--
ALTER TABLE `tblbank`
  MODIFY `intBankCode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tblbuilding`
--
ALTER TABLE `tblbuilding`
  MODIFY `intBuilCode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tblbuildingtype`
--
ALTER TABLE `tblbuildingtype`
  MODIFY `intBuilTypeCode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tblbusinesstype`
--
ALTER TABLE `tblbusinesstype`
  MODIFY `intBusiTypeCode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tblcity`
--
ALTER TABLE `tblcity`
  MODIFY `intCityCode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tblcontractcontent`
--
ALTER TABLE `tblcontractcontent`
  MODIFY `intContContCode` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tblfloor`
--
ALTER TABLE `tblfloor`
  MODIFY `intFloorCode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tblparkarea`
--
ALTER TABLE `tblparkarea`
  MODIFY `intParkAreaCode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tblparkspace`
--
ALTER TABLE `tblparkspace`
  MODIFY `intParkSpaceCode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tblprovince`
--
ALTER TABLE `tblprovince`
  MODIFY `intProvinceCode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tblregistrationheader`
--
ALTER TABLE `tblregistrationheader`
  MODIFY `intRegiCode` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tblrepresentative`
--
ALTER TABLE `tblrepresentative`
  MODIFY `intReprCode` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tblrepresentativeposition`
--
ALTER TABLE `tblrepresentativeposition`
  MODIFY `intPosiCode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbltenant`
--
ALTER TABLE `tbltenant`
  MODIFY `intTenaCode` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tblunit`
--
ALTER TABLE `tblunit`
  MODIFY `intUnitCode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbladdress`
--
ALTER TABLE `tbladdress`
  ADD CONSTRAINT `cityyadd` FOREIGN KEY (`intCityCode`) REFERENCES `tblcity` (`intCityCode`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tblbuilding`
--
ALTER TABLE `tblbuilding`
  ADD CONSTRAINT `fk_BuildTypeCode` FOREIGN KEY (`intBuilTypeCode`) REFERENCES `tblbuildingtype` (`intBuilTypeCode`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_builaddcode` FOREIGN KEY (`intAddrCode`) REFERENCES `tbladdress` (`intAddrCode`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tblcity`
--
ALTER TABLE `tblcity`
  ADD CONSTRAINT `provCity` FOREIGN KEY (`intProvinceCode`) REFERENCES `tblprovince` (`intProvinceCode`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tblcontractdetail`
--
ALTER TABLE `tblcontractdetail`
  ADD CONSTRAINT `fk_contcont` FOREIGN KEY (`intContContCode`) REFERENCES `tblcontractcontent` (`intContContCode`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_contheadcont` FOREIGN KEY (`strContCode`) REFERENCES `tblcontractheader` (`strContCode`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tblcontractextend`
--
ALTER TABLE `tblcontractextend`
  ADD CONSTRAINT `fk_extendContr` FOREIGN KEY (`strContractHeaderCode`) REFERENCES `tblcontractheader` (`strContCode`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tblcontractheader`
--
ALTER TABLE `tblcontractheader`
  ADD CONSTRAINT `fk_oscont` FOREIGN KEY (`strOffeSheeCode`) REFERENCES `tbloffersheetheader` (`strOffeSheeCode`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tblcontracttermination`
--
ALTER TABLE `tblcontracttermination`
  ADD CONSTRAINT `fk_termiContra` FOREIGN KEY (`strContCode`) REFERENCES `tblcontractheader` (`strContCode`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tblfloor`
--
ALTER TABLE `tblfloor`
  ADD CONSTRAINT `fk_builfloor` FOREIGN KEY (`intBuilCode`) REFERENCES `tblbuilding` (`intBuilCode`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tblmarketrate`
--
ALTER TABLE `tblmarketrate`
  ADD CONSTRAINT `cityRate` FOREIGN KEY (`intCityCode`) REFERENCES `tblcity` (`intCityCode`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbloffersheetdetail`
--
ALTER TABLE `tbloffersheetdetail`
  ADD CONSTRAINT `fk_osoffer` FOREIGN KEY (`strOffeSheeCode`) REFERENCES `tbloffersheetheader` (`strOffeSheeCode`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_unitoffersheet` FOREIGN KEY (`intUnitCode`) REFERENCES `tblregistrationdetail` (`intUnitCode`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbloffersheetheader`
--
ALTER TABLE `tbloffersheetheader`
  ADD CONSTRAINT `fk_osregi` FOREIGN KEY (`intRegiCode`) REFERENCES `tblregistrationheader` (`intRegiCode`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tblparkarea`
--
ALTER TABLE `tblparkarea`
  ADD CONSTRAINT `fkFloorPark` FOREIGN KEY (`intFloorCode`) REFERENCES `tblfloor` (`intFloorCode`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tblparkrate`
--
ALTER TABLE `tblparkrate`
  ADD CONSTRAINT `builParkRate` FOREIGN KEY (`intBuilCode`) REFERENCES `tblbuilding` (`intBuilCode`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tblparkspace`
--
ALTER TABLE `tblparkspace`
  ADD CONSTRAINT `parkAreaSpace` FOREIGN KEY (`intParkAreaCode`) REFERENCES `tblparkarea` (`intParkAreaCode`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tblpaymentcollection`
--
ALTER TABLE `tblpaymentcollection`
  ADD CONSTRAINT `str_bank` FOREIGN KEY (`intBankCode`) REFERENCES `tblbank` (`intBankCode`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `str_pay_contra` FOREIGN KEY (`strContCode`) REFERENCES `tblcontractheader` (`strContCode`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tblregistrationdetail`
--
ALTER TABLE `tblregistrationdetail`
  ADD CONSTRAINT `fk_regihCOde` FOREIGN KEY (`intRegiCode`) REFERENCES `tblregistrationheader` (`intRegiCode`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_unitregi` FOREIGN KEY (`intUnitCode`) REFERENCES `tblunit` (`intUnitCode`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tblregistrationheader`
--
ALTER TABLE `tblregistrationheader`
  ADD CONSTRAINT `fk_cusomer` FOREIGN KEY (`intTenaCode`) REFERENCES `tbltenant` (`intTenaCode`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tblrepresentative`
--
ALTER TABLE `tblrepresentative`
  ADD CONSTRAINT `fk_addrep` FOREIGN KEY (`intAddrCode`) REFERENCES `tbladdress` (`intAddrCode`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_representativepos` FOREIGN KEY (`intPosiCode`) REFERENCES `tblrepresentativeposition` (`intPosiCode`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbltenant`
--
ALTER TABLE `tbltenant`
  ADD CONSTRAINT `busitype` FOREIGN KEY (`intBusiTypeCode`) REFERENCES `tblbusinesstype` (`intBusiTypeCode`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `qwede` FOREIGN KEY (`intAddrCode`) REFERENCES `tbladdress` (`intAddrCode`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `reprconn` FOREIGN KEY (`intReprCode`) REFERENCES `tblrepresentative` (`intReprCode`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tblunit`
--
ALTER TABLE `tblunit`
  ADD CONSTRAINT `fk_floor_unit` FOREIGN KEY (`intFloorCode`) REFERENCES `tblfloor` (`intFloorCode`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tblunitprice`
--
ALTER TABLE `tblunitprice`
  ADD CONSTRAINT `fk_unitpriceunit` FOREIGN KEY (`intUnitCode`) REFERENCES `tblunit` (`intUnitCode`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
