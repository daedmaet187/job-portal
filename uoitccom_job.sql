-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 23, 2021 at 05:27 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `uoitccom_job`
--
CREATE DATABASE IF NOT EXISTS `uoitccom_job` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `uoitccom_job`;

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `blog_id` int(11) NOT NULL,
  `user_type` varchar(5) CHARACTER SET utf8 NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(150) CHARACTER SET utf8 NOT NULL,
  `content` longtext CHARACTER SET utf8 NOT NULL,
  `date_created` date NOT NULL DEFAULT current_timestamp(),
  `is_active` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`blog_id`, `user_type`, `user_id`, `title`, `content`, `date_created`, `is_active`) VALUES
(7, 'js', 9, 'كيفية كتابة السيرة الذاتية', 'كيفية كتابة السيرة الذاتية كيفية كتابة السيرة الذاتية كيفية كتابة السيرة الذاتية كيفية كتابة السيرة الذاتية كيفية كتابة السيرة الذاتية كيفية كتابة السيرة الذاتية ', '2021-08-02', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbladmin`
--

CREATE TABLE `tbladmin` (
  `ID` int(10) NOT NULL,
  `AdminName` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `UserName` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `MobileNumber` bigint(10) DEFAULT NULL,
  `Email` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `Password` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `AdminRegdate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbladmin`
--

INSERT INTO `tbladmin` (`ID`, `AdminName`, `UserName`, `MobileNumber`, `Email`, `Password`, `AdminRegdate`) VALUES
(1, 'Mohamed Nasser', 'admin', 7714750388, 'admin@gmail.com', '0cef1fb10f60529028a71f58e54ed07b', '2021-06-04 18:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `tblapplyjob`
--

CREATE TABLE `tblapplyjob` (
  `ID` int(10) NOT NULL,
  `UserId` int(5) DEFAULT NULL,
  `JobId` int(5) DEFAULT NULL,
  `Applydate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Status` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `ResponseDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblapplyjob`
--

INSERT INTO `tblapplyjob` (`ID`, `UserId`, `JobId`, `Applydate`, `Status`, `ResponseDate`) VALUES
(1, 1, 2, '2020-06-11 13:54:07', 'Sorted', '2020-06-11 13:54:07'),
(2, 2, 7, '2021-06-30 17:47:08', 'Sorted', '2021-06-30 17:47:08'),
(3, 3, 7, '2020-09-02 18:16:54', 'Sorted', '2020-09-02 18:16:54'),
(4, 4, 8, '2021-06-29 18:22:59', 'Rejected', '2021-06-29 18:22:59'),
(6, 5, 8, '2021-07-05 09:20:56', NULL, NULL),
(7, 9, 18, '2021-08-01 23:53:39', NULL, NULL),
(8, 9, 14, '2021-08-02 22:39:44', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblcategory`
--

CREATE TABLE `tblcategory` (
  `id` int(11) NOT NULL,
  `CategoryName` varchar(200) CHARACTER SET utf8 NOT NULL,
  `Description` mediumtext CHARACTER SET utf8 NOT NULL,
  `PostingDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL,
  `Is_Active` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblcategory`
--

INSERT INTO `tblcategory` (`id`, `CategoryName`, `Description`, `PostingDate`, `UpdationDate`, `Is_Active`) VALUES
(10, 'القطاع الخاص', 'وظائف القطاع الخاص', '2021-08-01 23:07:56', NULL, 1),
(11, 'القطاع الحكومي', 'وظائف القطاع الحكومي', '2021-08-01 23:19:35', NULL, 1),
(12, 'IT', 'IT', '2021-08-01 23:28:33', NULL, 1),
(13, 'السفر والسياحة', 'السفر والسياحة', '2021-08-01 23:30:21', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbleducation`
--

CREATE TABLE `tbleducation` (
  `ID` int(10) NOT NULL,
  `UserID` int(5) DEFAULT NULL,
  `Qualification` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `ClgorschName` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `PassingYear` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `Stream` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `CGPA` decimal(2,0) DEFAULT NULL,
  `Percentage` decimal(4,0) DEFAULT NULL,
  `CreationDate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbleducation`
--

INSERT INTO `tbleducation` (`ID`, `UserID`, `Qualification`, `ClgorschName`, `PassingYear`, `Stream`, `CGPA`, `Percentage`, `CreationDate`) VALUES
(1, 1, '10th std', 'Tulsi Vidya Niketan', '2010', 'Science', '7', '79', '2020-06-03 11:27:01'),
(2, 1, '12th std', 'Tulsi Vidya Niketan', '2012', 'PCM', '6', '67', '2020-06-03 11:29:10'),
(3, 1, 'Graduation', 'IIMT Merrut', '2016', 'B.Tech', '7', '79', '2020-06-03 11:33:09'),
(4, 3, '10th std', 'Sunrise Public School', '2005', '', '9', '75', '2020-09-02 18:12:33'),
(5, 3, '12th std', 'Nihar Meera Public School', '2007', 'PCM', '9', '78', '2020-09-02 18:13:42'),
(6, 3, 'Graduation', 'LPU', '2012', 'IT', '7', '65', '2020-09-02 18:14:14'),
(7, 9, '12th std', 'عدنان خير الله', '2014', NULL, NULL, '70', '2021-08-01 23:56:52');

-- --------------------------------------------------------

--
-- Table structure for table `tblemployers`
--

CREATE TABLE `tblemployers` (
  `id` int(11) NOT NULL,
  `ConcernPerson` varchar(150) CHARACTER SET utf8 DEFAULT NULL,
  `EmpEmail` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `EmpPassword` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `CompnayName` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `CompanyTagline` mediumtext CHARACTER SET utf8 DEFAULT NULL,
  `CompnayDescription` mediumtext CHARACTER SET utf8 DEFAULT NULL,
  `CompanyUrl` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `CompnayLogo` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `noOfEmployee` char(10) CHARACTER SET utf8 DEFAULT NULL,
  `industry` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `typeBusinessEntity` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `lcation` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `establishedIn` char(200) CHARACTER SET utf8 DEFAULT NULL,
  `RegDtae` timestamp NULL DEFAULT current_timestamp(),
  `LastUpdationDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Is_Active` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblemployers`
--

INSERT INTO `tblemployers` (`id`, `ConcernPerson`, `EmpEmail`, `EmpPassword`, `CompnayName`, `CompanyTagline`, `CompnayDescription`, `CompanyUrl`, `CompnayLogo`, `noOfEmployee`, `industry`, `typeBusinessEntity`, `lcation`, `establishedIn`, `RegDtae`, `LastUpdationDate`, `Is_Active`) VALUES
(7, 'احمد سعد علي', 'em.user@gmail.com', '$2y$12$UUX4xsfvLfN4yYPtchm7Uui..1BOUPKeJ65S2B4kwCeuHBm2SQuk2', 'EarthLine Co.', 'شركة اتصالات وانترنت', 'شركة اتصالات توفر انترنت فائق السرعة للمؤسسات والافراد', 'http://earthline.co', 'bd215b4c1f6c3d9e89c17dac3ee9a949.jpg', '', '', '', 'بغداد - المنصور - ١٤ رمضان', '', '2021-08-01 14:08:07', '2021-08-01 14:24:55', 1),
(8, 'محمد عدنان عبدالله', 'em2.user@gmail.com', '$2y$12$PAUmusiZt/CEmQ/TYCPZ1eLLi4G2rYXXMcx.E2n6xcugPihSJtqmS', 'وزارة الاتصالات', 'وزارة الاتصالات', 'وزارة الاتصالات العراقيةهي المسؤولة عن توفير افضل خدمة للمواطنين في ما يخص مجال الاتصالات واذ تسعى الوزارة دائما لتوفير افضل الخدمات', 'http://moc.gov.iq/', '3a09b899585af890619d7542bc8c5ab0.png', NULL, NULL, NULL, NULL, NULL, '2021-08-01 15:20:39', '2021-08-01 15:20:39', 1),
(9, 'محمد عبد الناصر', 'employer1@gmail.com', '$2y$12$dXCd7/u8s3FA.Q73B2KKFehBAUWep6J/r/2LDOwYg7/InpcmppNuC', 'السريع', 'شركة السريع العامة', 'شركة السريع العامة شركة السريع العامة شركة السريع العامة شركة السريع العامة شركة السريع العامة ', 'http://saree3.com', '4bd44b78efcdaa69d2e39ea05f883839.png', '130', 'البرمجيات', 'الويب', 'بغداد', '2021', '2021-08-01 23:14:59', '2021-08-01 23:18:59', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblexperience`
--

CREATE TABLE `tblexperience` (
  `ID` int(10) NOT NULL,
  `UserID` int(10) DEFAULT NULL,
  `EmployerName` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `EmployementType` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `Designation` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `Ctc` decimal(10,0) DEFAULT NULL,
  `FromDate` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `ToDate` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `Skills` varchar(200) CHARACTER SET utf8 NOT NULL,
  `CreationDate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblexperience`
--

INSERT INTO `tblexperience` (`ID`, `UserID`, `EmployerName`, `EmployementType`, `Designation`, `Ctc`, `FromDate`, `ToDate`, `Skills`, `CreationDate`) VALUES
(1, 1, 'ABC PVT LTD', 'Full Time', 'Software Developer', '50000', '2012-06-05', '2014-09-07', 'PHP,PDO', '2020-06-03 11:12:01'),
(2, 1, 'PAL pvt ltd', 'Full Time', 'Software Developer', '60000', '2014-09-08', '2018-06-09', 'PHP,PDO', '2020-06-03 11:14:41'),
(3, 1, 'FALT pvt ltd', 'Full Time', 'Software Developer', '75000', '2019-09-08', '', 'PHP, PDO', '2020-06-03 11:17:54'),
(4, 1, 'HMT Pvt ltd', 'fulltime', 'Software Developer', '75000', '2020-01-09', '', 'PHP, PDO, HTML, Excel', '2020-06-03 12:12:40'),
(5, 3, 'ABC', 'Fulltimw', 'Software Developer', '25000', '2019-07-02', '2020-02-29', '', '2020-09-02 18:15:05'),
(6, 3, 'XYZ', 'Fulltime', 'Software Developer', '40000', '2020-03-01', '2020-09-02', '', '2020-09-02 18:15:43'),
(7, 9, 'شركة الحياة', 'دوام كلي', 'مدير', '2000', '2021-08-02', '2021-08-27', '', '2021-08-01 23:57:41');

-- --------------------------------------------------------

--
-- Table structure for table `tbljobs`
--

CREATE TABLE `tbljobs` (
  `jobId` int(11) NOT NULL,
  `employerId` int(11) NOT NULL,
  `jobCategory` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `jobTitle` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `jobType` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `salaryPackage` char(200) CHARACTER SET utf8 DEFAULT NULL,
  `skillsRequired` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `experience` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `jobLocation` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `jobDescription` mediumtext CHARACTER SET utf8 DEFAULT NULL,
  `JobExpdate` date DEFAULT NULL,
  `postinDate` timestamp NULL DEFAULT current_timestamp(),
  `updationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `isActive` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbljobs`
--

INSERT INTO `tbljobs` (`jobId`, `employerId`, `jobCategory`, `jobTitle`, `jobType`, `salaryPackage`, `skillsRequired`, `experience`, `jobLocation`, `jobDescription`, `JobExpdate`, `postinDate`, `updationDate`, `isActive`) VALUES
(14, 9, 'القطاع الخاص', 'مبرمج', 'Full Time', '1000', 'HTML CSS JS PHP', '4', '1', 'مبرمج ويب مبرمج ويب مبرمج ويب مبرمج ويب مبرمج ويب مبرمج ويب مبرمج ويب مبرمج ويب مبرمج ويب مبرمج ويب ', '2021-08-11', '2021-08-01 23:16:15', '2021-08-01 23:26:11', 1),
(15, 9, 'القطاع الحكومي', 'مهندس شبكات', 'Contract', '1500', 'برمجة راوترات سيسكو برمجة راوترات سيسكو ', '6', '1', '• يجب أن تمتلك المعرفة من معدات الاتصالات عبر الأقمار الصناعية التكتيكية والتجارية.\r\n• المعرفة التكتيكية لأجهزة المودم الساتلية، ومفتاح التكرار، والكابلات المرتبطة بها، والموصلات البينية؛ محولات لأعلى، تبديل التكرار؛ محولات منخفضة ومكبرات صوت عالية الطاقة (HPAs) ومكبرات صوت منخفضة الضوضاء (LNAs) وكتلة منخفضة الضوضاء (LNB)؛ Waveguide (جامدة، المرن، والاهليلجي) المفاصل والاتصالات؛ كابل التردد المتوسط (IF) والاتصالات؛ الهوائي، ومحركات الهوائي، ومكبرات الصوت ذات الحالة الصلبة (SSPA)، ووحدة التحكم في الهوائيات (ACU)، والكابلات والوصلات المرتبطة بها؛ إمدادات الطاقة غير المنقطعة (UPS)؛ مولد (إن وجد).\r\n• مهارات التوثيق التقني.', '2021-08-27', '2021-08-01 23:23:50', '2021-08-01 23:26:09', 1),
(16, 9, 'القطاع الخاص', 'فني تبريد', 'Temporary', '300', 'تنصيب وتثبيت تكييف ', '2', '2', 'شركه السريع للتجاره العامه تعلن عن توفر فرصه بصفه مدير قسم الصيانه ...\r\nالشروط العامه :\r\n1] ان يكون المتقدم خريج قسم له علاقه بالوظيفه ويفضل مهندس تكييف وتبريد\r\n2 ] ان يكون ذو - خبرة بالمجال - بالعمل علي الاقل اربع او خمس اعوام .\r\n3] ان لا يكون ملتزم بعمل ثاني .', '2021-09-03', '2021-08-01 23:28:02', '2021-08-01 23:31:58', 1),
(17, 9, 'IT', 'سبورت', 'Full Time', '860', 'متابعة الشبكات والدعم', '3', '3', 'متابعة الشبكات والدعم متابعة الشبكات والدعم متابعة الشبكات والدعم متابعة الشبكات والدعم ', '2021-08-19', '2021-08-01 23:29:58', '2021-08-01 23:31:55', 1),
(18, 9, 'السفر والسياحة', 'مرشد سياحي', 'Full Time', '750', 'مرشد سياحي', '1', '1', 'مطلوب مرشد سياحي في داخل بغداد يجيد اللغة الانكليزي ولبق', '2021-08-25', '2021-08-01 23:31:18', '2021-08-01 23:31:53', 1),
(19, 9, 'IT', 'مبرمج موبايل', 'Full Time', '1200', 'مبرمج موبايل', '3', '15', 'مبرمج موبايل مبرمج موبايل مبرمج موبايل مبرمج موبايل مبرمج موبايل مبرمج موبايل ', '2021-08-05', '2021-08-02 22:20:20', '2021-08-02 22:20:44', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbljobseekers`
--

CREATE TABLE `tbljobseekers` (
  `id` int(11) NOT NULL,
  `FullName` varchar(150) DEFAULT NULL,
  `EmailId` varchar(150) DEFAULT NULL,
  `ContactNumber` bigint(15) DEFAULT NULL,
  `Password` varchar(150) DEFAULT NULL,
  `Resume` varchar(150) DEFAULT NULL,
  `AboutMe` longtext DEFAULT NULL,
  `ProfilePic` varchar(200) DEFAULT NULL,
  `Skills` varchar(200) DEFAULT NULL,
  `RegDate` timestamp NULL DEFAULT current_timestamp(),
  `LastUpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `IsActive` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbljobseekers`
--

INSERT INTO `tbljobseekers` (`id`, `FullName`, `EmailId`, `ContactNumber`, `Password`, `Resume`, `AboutMe`, `ProfilePic`, `Skills`, `RegDate`, `LastUpdationDate`, `IsActive`) VALUES
(8, 'مصطفى عمار محمد', 'js.user@gmail.com', 7702022445, '$2y$12$itnmhvaAGINBmDqdD0FuEOp9fV4Fh2Ai8O2ZIc6zH0hOuuthblV6O', '3a1d39516fe2991d216727366f5a1e441627830049.pdf', NULL, 'e89666feb714ab9c3946f28f00c5d8c4.jpg', NULL, '2021-08-01 15:00:49', '2021-08-01 23:07:22', 1),
(9, 'محمد عبد الناصر', 'js1@gmail.com', 7714750388, '$2y$12$1/7rdkQYmgHUeMnDJP4MeORgxv.CSt9iZD66UvbgF3QtHmFV/kHJ6', 'a64736b6b92c34311ea25601938d4d581627861494.pdf', 'عمري 29 سنة، مرشد سياحي في بغداد، خبرة 10 سنوات', '4a52563aba69bd12428de68f28a11ddf.jpg', '', '2021-08-01 23:44:54', '2021-08-01 23:58:48', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblmessage`
--

CREATE TABLE `tblmessage` (
  `ID` int(10) NOT NULL,
  `JobID` int(5) DEFAULT NULL,
  `UserID` int(5) DEFAULT NULL,
  `Message` mediumtext CHARACTER SET utf8 DEFAULT NULL,
  `Status` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `ResponseDate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblmessage`
--

INSERT INTO `tblmessage` (`ID`, `JobID`, `UserID`, `Message`, `Status`, `ResponseDate`) VALUES
(1, 3, 1, 'Your resume has been sort listed. Kindly comes with original documents at a time.', 'Sorted', '2020-06-11 13:54:25'),
(2, 2, 1, 'You are sort listed comes with your original document', 'Sorted', '2020-08-31 18:30:00'),
(3, 7, 3, 'Sort listed', 'Sorted', '2020-09-01 18:30:00'),
(4, 8, 4, 'not qula', 'Rejected', '2021-06-29 18:22:59');

-- --------------------------------------------------------

--
-- Table structure for table `tblpages`
--

CREATE TABLE `tblpages` (
  `ID` int(11) NOT NULL,
  `PageType` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `PageTitle` mediumtext CHARACTER SET utf8 DEFAULT NULL,
  `PageDescription` longtext CHARACTER SET utf8 DEFAULT NULL,
  `Email` varchar(200) CHARACTER SET utf8 NOT NULL,
  `MobileNumber` bigint(10) NOT NULL,
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblpages`
--

INSERT INTO `tblpages` (`ID`, `PageType`, `PageTitle`, `PageDescription`, `Email`, `MobileNumber`, `UpdationDate`) VALUES
(1, 'aboutus', 'About us', '<div class=\"iw-heading  style1 vc_custom_1511523196571 border-color-theme\" style=\"outline: none; box-sizing: border-box; margin-top: 0px; margin-right: auto; margin-left: auto; color: rgb(119, 119, 119); font-family: \" open=\"\" sans\";=\"\" font-size:=\"\" 13px;=\"\" width:=\"\" 670px;=\"\" margin-bottom:=\"\" 35px=\"\" !important;\"=\"\"><div class=\"iwh-description\" style=\"outline: none; box-sizing: border-box; color: rgb(51, 51, 51); font-size: 16px; line-height: 28px; font-weight: 600;\">Mohamed Nasser</div></div>', '2020-06-05 12:18:06', 0, '2021-06-29 18:35:12'),
(2, 'contactus', 'Contact Us', 'Baghdad - Iraq', 'm.nasser@starlinkisp.com', 7714750388, '2021-06-29 18:35:58');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`blog_id`);

--
-- Indexes for table `tbladmin`
--
ALTER TABLE `tbladmin`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblapplyjob`
--
ALTER TABLE `tblapplyjob`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblcategory`
--
ALTER TABLE `tblcategory`
  ADD PRIMARY KEY (`id`),
  ADD KEY `CategoryName` (`CategoryName`);

--
-- Indexes for table `tbleducation`
--
ALTER TABLE `tbleducation`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblemployers`
--
ALTER TABLE `tblemployers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblexperience`
--
ALTER TABLE `tblexperience`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `tbljobs`
--
ALTER TABLE `tbljobs`
  ADD PRIMARY KEY (`jobId`);

--
-- Indexes for table `tbljobseekers`
--
ALTER TABLE `tbljobseekers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `tblmessage`
--
ALTER TABLE `tblmessage`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblpages`
--
ALTER TABLE `tblpages`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `blog_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbladmin`
--
ALTER TABLE `tbladmin`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tblapplyjob`
--
ALTER TABLE `tblapplyjob`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tblcategory`
--
ALTER TABLE `tblcategory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tbleducation`
--
ALTER TABLE `tbleducation`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tblemployers`
--
ALTER TABLE `tblemployers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tblexperience`
--
ALTER TABLE `tblexperience`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbljobs`
--
ALTER TABLE `tbljobs`
  MODIFY `jobId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tbljobseekers`
--
ALTER TABLE `tbljobseekers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tblmessage`
--
ALTER TABLE `tblmessage`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tblpages`
--
ALTER TABLE `tblpages`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
