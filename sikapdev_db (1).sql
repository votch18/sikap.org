-- phpMyAdmin SQL Dump
-- version 4.9.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 02, 2020 at 09:48 AM
-- Server version: 5.6.41-84.1
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sikapdev_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `t_access`
--

CREATE TABLE `t_access` (
  `id` int(11) NOT NULL,
  `category` varchar(50) NOT NULL,
  `action` varchar(100) NOT NULL,
  `sort` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_access`
--

INSERT INTO `t_access` (`id`, `category`, `action`, `sort`) VALUES
(2, 'Features & News', 'Create/Edit', 3),
(3, 'Features & News', 'Delete', 4),
(4, 'Features & News', 'Published', 5),
(5, 'Programs & Projects', 'Create/Edit', 7),
(6, 'Programs & Projects', 'Delete', 8),
(7, 'Programs & Projects', 'Published', 9),
(8, 'Slider', 'Create/Edit', 11),
(9, 'Slider', 'Delete', 12),
(10, 'Slider', 'Published', 13),
(12, 'Themes', 'Templates', 17),
(13, 'Maintenance', 'Site Settings', 18),
(18, 'Pages', 'Create/Edit', 15),
(19, 'Pages', 'Delete', 16),
(20, 'Filemanager', 'View', 14);

-- --------------------------------------------------------

--
-- Table structure for table `t_access_rights`
--

CREATE TABLE `t_access_rights` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `access` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_access_rights`
--

INSERT INTO `t_access_rights` (`id`, `userid`, `access`) VALUES
(9, 2, 5),
(10, 2, 6),
(11, 2, 7),
(12, 2, 8),
(14, 2, 10),
(19, 2, 13);

-- --------------------------------------------------------

--
-- Table structure for table `t_avatar`
--

CREATE TABLE `t_avatar` (
  `id` int(6) UNSIGNED NOT NULL,
  `userid` int(11) NOT NULL,
  `photo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `t_comments`
--

CREATE TABLE `t_comments` (
  `id` int(6) UNSIGNED NOT NULL,
  `postid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `filename` varchar(100) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `link` varchar(255) NOT NULL,
  `photo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `t_contactus`
--

CREATE TABLE `t_contactus` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `message` varchar(255) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `t_flash`
--

CREATE TABLE `t_flash` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `message` varchar(100) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `t_months`
--

CREATE TABLE `t_months` (
  `id` int(6) UNSIGNED NOT NULL,
  `month` varchar(20) NOT NULL,
  `abbr` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_months`
--

INSERT INTO `t_months` (`id`, `month`, `abbr`) VALUES
(1, 'January', 'Jan'),
(2, 'February', 'Feb'),
(3, 'March', 'Mar'),
(4, 'April', 'Apr'),
(5, 'May', 'May'),
(6, 'June', 'June'),
(7, 'July', 'Jul'),
(8, 'August', 'Aug'),
(9, 'September', 'Sep'),
(10, 'October', 'Oct'),
(11, 'November', 'Nov'),
(12, 'December', 'Dec');

-- --------------------------------------------------------

--
-- Table structure for table `t_pages`
--

CREATE TABLE `t_pages` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `url` varchar(50) NOT NULL,
  `template` varchar(100) NOT NULL,
  `isactive` int(11) NOT NULL DEFAULT '1',
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `userid` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `sequence` int(11) NOT NULL,
  `banner` varchar(100) NOT NULL,
  `isdefault` int(11) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_pages`
--

INSERT INTO `t_pages` (`id`, `name`, `url`, `template`, `isactive`, `date`, `userid`, `type`, `sequence`, `banner`, `isdefault`, `status`) VALUES
(1, 'home', '', 'home.php', 1, '2020-03-19 20:03:01', 1, 0, 1, '', 1, 1),
(2, 'news & updates', 'news', 'posts.php', 1, '2020-03-19 20:03:01', 1, 1, 3, 'https://sikap.org/filemanager/BANNER/banner_1598759035.jpg', 1, 1),
(3, 'announcements', 'announcements', 'posts.php', 0, '2020-03-19 20:03:01', 1, 2, 0, '', 1, 1),
(4, 'Accreditations & Membership', 'accreditations', 'accreditations.php', 1, '2020-03-19 20:03:01', 1, 3, 0, 'https://sikap.org/filemanager/BANNER/banner_1598759035.jpg', 1, 1),
(5, 'awards & recognition', 'awards', 'awards.php', 1, '2020-03-19 20:03:01', 1, 4, 0, 'https://sikap.org/filemanager/BANNER/banner_1598759035.jpg', 1, 1),
(6, 'programs & projects', 'programs', 'programs.php', 1, '2020-03-19 20:03:01', 1, 5, 4, 'https://sikap.org/filemanager/BANNER/banner_1598759035.jpg', 1, 1),
(9, 'contact us', 'contact-us', 'contact-us.php', 1, '2020-03-22 11:17:57', 1, 0, 6, 'https://sikap.org/filemanager/BANNER/banner_1598759035.jpg', 1, 1),
(12, 'History', 'history', 'history.php', 1, '2020-07-07 11:14:32', 1, 0, 0, 'https://sikap.org/filemanager/BANNER/banner_1598759035.jpg', 0, 0),
(13, 'Vision', 'vision', 'vision.php', 1, '2020-07-08 07:08:11', 1, 0, 0, 'https://sikap.org/filemanager/BANNER/banner_1598759035.jpg', 0, 1),
(14, 'Mission', 'mission', 'mission.php', 1, '2020-07-08 07:08:47', 1, 0, 0, 'https://sikap.org/filemanager/BANNER/banner_1598759035.jpg', 0, 1),
(15, 'Goals', 'goals', 'goals.php', 1, '2020-07-08 07:09:09', 1, 0, 0, 'https://sikap.org/filemanager/BANNER/banner_1598759035.jpg', 0, 1),
(16, 'Core Values', 'core-values', 'core-values.php', 1, '2020-07-08 07:10:07', 1, 0, 0, 'https://sikap.org/filemanager/BANNER/banner_1598759035.jpg', 0, 1),
(17, 'Approach', 'approach', 'approach.php', 1, '2020-07-08 07:10:30', 1, 0, 0, 'https://sikap.org/filemanager/BANNER/banner_1598759035.jpg', 0, 1),
(18, 'Strategic Direction', 'strategic-direction', 'strategic-direction.php', 1, '2020-07-08 07:10:59', 1, 0, 0, 'https://sikap.org/filemanager/BANNER/banner_1598759035.jpg', 0, 1),
(19, 'Members of the Board of Trustees', 'members-of-the-board-of-trustees', 'members-of-the-board-of-trustees.php', 1, '2020-07-08 07:11:48', 1, 0, 0, 'https://sikap.org/filemanager/BANNER/banner_1598759035.jpg', 0, 1),
(20, 'Management and Staff', 'management-and-staff', 'management-and-staff.php', 1, '2020-07-08 07:12:17', 1, 0, 0, 'https://sikap.org/filemanager/BANNER/banner_1598759035.jpg', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `t_posts`
--

CREATE TABLE `t_posts` (
  `id` int(6) UNSIGNED NOT NULL,
  `postid` varchar(100) NOT NULL,
  `photo` varchar(100) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `post` longtext NOT NULL,
  `slug` text NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `isactive` int(11) NOT NULL DEFAULT '1',
  `status` int(11) NOT NULL DEFAULT '0',
  `type` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `is_featured` int(11) NOT NULL,
  `program_category` int(11) NOT NULL,
  `fbposted` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_posts`
--

INSERT INTO `t_posts` (`id`, `postid`, `photo`, `title`, `description`, `post`, `slug`, `date`, `isactive`, `status`, `type`, `userid`, `is_featured`, `program_category`, `fbposted`) VALUES
(30, '5e78c49985496', 'https://sikap.org/filemanager/NEWS/cagwait.jpg', 'Proposed Land Use Planning Workshop', '', '<p style=\"margin-left: 0px;\">Proposed Land Use Planning Workshop of the Local Government Unit of Cagwait, Surigao del Sur on March 3-5, 2020 at the Mabe\'s Savory Place, San Francisco, Agusan del Sur.</p>\n<p style=\"margin-left: 0px;\">The activity is part of the updating of their Comprehensive Land Use Plan (CLUP) to comply with the latest guidelines.</p>\n<p style=\"margin-left: 0px;\">Guided with their vision, this dynamic planning team is on the go to advance further development of the D\'GREAT municipality.</p>', 'proposed-land-use-planning-workshop', '2020-03-23 22:15:58', 0, 1, 1, 1, 0, 0, 0),
(31, '5e78c641c879f', 'https://sikap.org/filemanager/SLIDER/slider_1598753429.jpg', 'Updating of the CLUP of the City of Tandag', '', '<p>&nbsp;</p>', 'updating-of-the-clup-of-the-city-of-tandag', '2020-03-23 22:23:01', 1, 1, 7, 1, 0, 0, 0),
(32, '5e78c65c0639e', 'https://sikap.org/filemanager/SLIDER/slider_1598753400.jpg', 'Revisiting and Updating the Ancestral Domain Sustainable Development and Protection (ADSDPP) of CADT 089', '', '<p>&nbsp;</p>', 'revisiting-and-updating-the-ancestral-domain-sustainable-development-and-protection-adsdpp-of-cadt-089', '2020-03-23 22:23:32', 1, 1, 7, 1, 0, 0, 0),
(33, '5e78c6777b0b1', 'https://sikap.org/filemanager/SLIDER/slider_1598753363.jpg', 'Sexual Health & Empowerment (SHE) Project', '', '<p>&nbsp;</p>', 'sexual-health-empowerment-she-project', '2020-03-23 22:23:56', 1, 1, 7, 1, 0, 0, 0),
(34, '5e78c8525f06c', 'https://sikap.org/filemanager/she.jpg', 'Sexual Health and Empowerment (SHE) Project', '', '<p>The Teen Trail participated by 73 students in different grade level. This initiative aims to develop a positive environment of young people with there co-peers, sharing there knowledge and ideas and encourage each other to be an advocate knowing there \"RIGHTS\" to a healthy reproductive and sexuality.</p>', 'sexual-health-and-empowerment-she-project', '2020-03-23 22:31:47', 0, 1, 5, 1, 0, 0, 0),
(35, '5e78c8cb2c8e4', 'https://sikap.org/filemanager/NEWS/news_1598758534.jpg', 'Training on Adolescent and Youth Reproductive Health Peer Education and Peer Helping', '', '<p style=\"margin-left: 0px;\">The batch 2 of the \"Training on Adolescent and Youth Reproductive Health Peer Education and Peer Helping was conducted in Santiago National High School, Santiago, Agusan del Norte.</p>\n<p style=\"margin-left: 0px;\">The activity aims to create core group of peer educators to strengthen the involvement of youth/young people in addressing the issues and concerns of adolescent about their reproductive health and sexuality as well as their rights and increase their awareness. 25 peer educators attended the activity and share their knowledge and ideas on topics discussed.</p>\n<p style=\"margin-left: 0px;\">The highlight of the activity was the U4U teen trail wherein the peer educators use their gain knowledge during the training. The teen trail was participated by 63 students. The teen trail composed of segments: Teen Chat, Teen Wait, Teen Exhibit, Teen Code &amp; Teen Tunes.</p>\n<p style=\"margin-left: 0px;\">The activity happened on February 26-28, 2020.</p>\n<p style=\"margin-left: 0px;\">Under SHE project, a total of 8 trainings on Peer Education were completed.</p>\n<p style=\"margin-left: 0px;\">Thank you so much partners! Together we fight against teenage pregnancy!</p>\n<p style=\"margin-left: 0px;\"><a href=\"https://www.facebook.com/hashtag/deped?source=feed_text&amp;epa=HASHTAG\"><span style=\"color: #365899;\">#</span>DepEd</a>&nbsp;</p>\n<p style=\"margin-left: 0px;\"><a href=\"https://www.facebook.com/hashtag/popcom?source=feed_text&amp;epa=HASHTAG\"><span style=\"color: #365899;\">#</span>PopCom</a>&nbsp;</p>\n<p style=\"margin-left: 0px;\"><a href=\"https://www.facebook.com/hashtag/pswdo?source=feed_text&amp;epa=HASHTAG\"><span style=\"color: #365899;\">#</span>PSWDO</a>-ADN&nbsp;</p>\n<p style=\"margin-left: 0px;\"><a href=\"https://www.facebook.com/hashtag/snhs?source=feed_text&amp;epa=HASHTAG\"><span style=\"color: #365899;\">#</span>SNHS</a> <a href=\"https://www.facebook.com/hashtag/facultystaff?source=feed_text&amp;epa=HASHTAG\"><span style=\"color: #365899;\">#</span>FacultyStaff</a></p>\n<p style=\"margin-left: 0px;\"><a href=\"https://www.facebook.com/hashtag/yesshecan?source=feed_text&amp;epa=HASHTAG\"><span style=\"color: #365899;\">#</span>yesSHEcan</a></p>', 'training-on-adolescent-and-youth-reproductive-health-peer-education-and-peer-helping', '2020-03-23 22:33:49', 0, 1, 1, 1, 0, 0, 0),
(36, '5e78c9778e6d2', 'https://sikap.org/filemanager/NEWS/news_1598758451.jpg', 'Orientation/Workshop on Regional Project Monitoring and Evaluation System (RPMES) Manual of Operation', '', '<p style=\"margin-left: 0px;\">Orientation/Workshop on Regional Project Monitoring and Evaluation System (RPMES) Manual of Operation participated by the members of the Provincial Project Monitoring Committee PPMC) of the Provincial Government of Agusan del Sur.</p>\n<p style=\"margin-left: 0px;\">The activity was facilitated by the office of the National Economic Development Authority (NEDA) Caraga Region.</p>\n<p style=\"margin-left: 0px;\">FDAI and SIKAP - Civil Society Organizations who are members of the PPMC participated the workshop.</p>\n<p style=\"margin-left: 0px;\">Happened on Febuary 26-28, 2020 at the Provincial Learning Center, Prosperidad, Agusan del Sur.</p>\n<p style=\"margin-left: 0px;\"><a href=\"https://www.facebook.com/hashtag/ppmc?source=feed_text&amp;epa=HASHTAG\"><span style=\"color: #365899;\">#</span>ppmc</a><br /><a href=\"https://www.facebook.com/hashtag/goodgovernance?source=feed_text&amp;epa=HASHTAG\"><span style=\"color: #365899;\">#</span>goodgovernance</a></p>', 'orientationworkshop-on-regional-project-monitoring-and-evaluation-system-rpmes-manual-of-operation', '2020-03-23 22:36:55', 0, 1, 1, 1, 0, 0, 0),
(37, '5e78cbc462d29', 'https://sikap.org/filemanager/gallery3.jpg', 'Regional Gawad KALASAG', 'SIKAP participated the One-Day Orientation on Guidelines for the 22nd (2020/ Regional Gawad KALASAG Search for Excellence in DRRM and Humanitarian Assistance held at Almont Inland Resort, Butuan City facilitated by the Office of Civil Defense Caraga Regio', '<p><br data-cke-filler=\"true\"></p>', 'regional-gawad-kalasag', '2020-03-23 22:46:42', 1, 1, 6, 1, 0, 0, 0),
(38, '5e78cbf537f7c', 'https://sikap.org/filemanager/gallery2.jpg', 'Regional Development Council - Development Administration Committee (RDC-DAC)', 'Regional Development Council - Development Administration Committee (RDC-DAC) 1st Quarterly Meeting held at the NEDA\'s Conference Hall, Butuan City', '<p><br data-cke-filler=\"true\"></p>', 'regional-development-council-development-administration-committee-rdc-dac', '2020-03-23 22:47:37', 1, 0, 6, 1, 0, 0, 0),
(39, '5e78d14878d8f', 'https://sikap.org/filemanager/gallery1.jpg', 'ZONING ORDINANCE WORKSHOP', 'The workshop was participated by the Local Government Unit of Tandag City headed by Hon. Mayor Roxanne C. Pimentel with the Sangguniang Panglunsod headed by Hon. Vice Mayor Eleanor D. Momo, department heads and national line agencies facilitated by SIKAP.', '<p><br data-cke-filler=\"true\"></p>', 'zoning-ordinance-workshop', '2020-03-23 23:10:54', 1, 1, 6, 1, 0, 0, 0),
(40, '5e78d234693d5', 'https://sikap.org/filemanager/cdra.jpg', 'Training Workshop on Data Gathering and Banking for the Sectoral Studies and Climate and Disaster Risk Assessment (CDRA)', '', '<p><br data-cke-filler=\"true\"></p>', 'training-workshop-on-data-gathering-and-banking-for-the-sectoral-studies-and-climate-and-disaster-risk-assessment-cdra', '2020-03-23 23:14:21', 1, 1, 3, 1, 0, 0, 0),
(41, '5e78d2c28a26f', 'https://sikap.org/filemanager/NEWS/news_1598755303.jpg', 'Meeting with SIKAP\'s Consultant Mr. Earl Enrico Alcala', '', '<p style=\"margin-left: 0px;\">A productive Saturday meeting with SIKAP\'s Consultant Mr. Earl Enrico Alcala with SHE Project Team.</p>\n<p style=\"margin-left: 0px;\">Excited for the WROs activity this March!</p>\n<p style=\"margin-left: 0px;\">Padayon inspite of the challenges brought by NCOV to our scheduled Peer Educators Training in partnership with DepEd to ensure safety of school children.</p>\n<p style=\"margin-left: 0px;\">Laban lang towards attainment of Y2-Q4 targets!</p>\n<p style=\"margin-left: 0px;\"><a href=\"https://www.facebook.com/hashtag/yesshecan?source=feed_text&amp;epa=HASHTAG\"><span style=\"color: #365899;\">#</span>yesSHEcan</a></p>', 'meeting-with-sikaps-consultant-mr-earl-enrico-alcala', '2020-03-23 23:16:21', 0, 1, 1, 1, 0, 0, 0),
(42, '5e78d37c7e694', 'https://sikap.org/filemanager/maginoo.jpg', 'Usapang Bagong Maginoo', '', '<p style=\"margin-left:0px;\">Usapang Bagong Maginoo sessions were conducted in Barangay Aras-asan, Tubo-tubo and Bitaugan East of Cagwait, Surigao del Sur on January 14,15,16 &amp; 17. A total of 67 maginoo attended.</p><p style=\"margin-left:0px;\">Thank you to PHN Melodina Jumawid, RM Carolina Andoy and RNs under HRH program. Cheers to more usapan for family planning and gender-based violence (RA 9262)!</p><p style=\"margin-left:0px;\"><a href=\"https://www.facebook.com/hashtag/yesshecan?source=feed_text&amp;epa=HASHTAG\"><span style=\"color:rgb(54,88,153);\">#</span>yesSHEcan</a></p>', 'usapang-bagong-maginoo', '2020-03-23 23:19:25', 0, 1, 5, 1, 0, 0, 0),
(43, '5e78d3e33e26c', 'https://sikap.org/filemanager/stratplan.jpg', '5-Year Strategic Plan (CY 2020-2025)', '', '<p style=\"margin-left:0px;\">Before 2019 ends, SIKAP formulated its 5-Year Strategic Plan (CY 2020-2025) on December 10-13, 2019 at the Grand Palace Hotel, Butuan City.</p><p style=\"margin-left:0px;\">This is one of the best and inspiring accomplishments for the year. We are grateful to Oxfam and the Global Affairs Canada for the \"Institutional Strengthening Grant\" for SIKAP.</p><p style=\"margin-left:0px;\">Guided with our new vision, mission and goals where the organization look within its organizational development and sustainability of its programs anchored to human rights and principle of accountability, we are committed to attain \"a self-sustaining human development institution in an empowered, just and accountable society\".</p><p style=\"margin-left:0px;\">God bless SIKAP!</p>', '5-year-strategic-plan-cy-2020-2025', '2020-03-23 23:22:17', 0, 1, 5, 1, 0, 0, 0),
(44, '5e78d4966bb39', 'https://sikap.org/filemanager/shebums.jpg', 'Sexual Reproductive Health and Rights (SRHR) Legal Framework', '', '<p style=\"margin-left:0px;\">Training on Sexual Reproductive Health and Rights (SRHR) Legal Framework held on November 21-23, 2019 at the Butuan Grand Palace Hotel, Butuan City.</p><p style=\"margin-left:0px;\">The training is the first activity under the cat4srhr to enhance SIKAP\'s capacity on SRHR under the Pillar 2 of the SHE Project.</p><p style=\"margin-left:0px;\">Topics discussed during the training were:<br>1. United Declaration on Human Right (UDHR)<br>2.R.A. 9710 - Magna Carta of Women<br>3.R.A. 9262 - Violence Against Women and their Children<br>4. R.A. 10354 - Responsible Parenthood and Reproductive Health Act of 2012 and Revised IRR<br>5. E.O. No. 12, series of 2012 - Attaining and sustaining \"Zero Unmet Need for Modern Family Planning\"<br>6. Other population-related National Issuances</p><p style=\"margin-left:0px;\">Thank you Commission on Human Rights (CHR Caraga) and the Population Commission and Development <a href=\"https://www.facebook.com/popcom.caraga?__tn__=%2CdK-R-R&amp;eid=ARADqlOGT6JCJJVMjGVozpXqQ0IkBbO-2qiQKTQN5pC8MhRpG50JrhoykErCHWW_uglePxf-g7WFDUjf&amp;fref=mentions\">PopCom Caraga</a> for the knowledge you shared to us that deepened our understanding on SRHR.</p><p style=\"margin-left:0px;\">Daghan kaayong salamat!</p><p style=\"margin-left:-12px;\"><br><br><br><br data-cke-filler=\"true\"></p>', 'sexual-reproductive-health-and-rights-srhr-legal-framework', '2020-03-23 23:24:08', 0, 1, 5, 1, 0, 0, 0),
(45, '5f04972014772', 'https://sikap.org/filemanager/SLIDER/slider_1598753116.jpg', 'Rural Livelihoods and Enterprise Development', '', '<p>&nbsp;</p>', 'rural-livelihoods-and-enterprise-development', '2020-07-07 10:39:27', 1, 1, 7, 1, 0, 0, 0),
(46, '5f04975386df2', 'https://sikap.org/filemanager/SLIDER/slider_1598752336.jpg', 'Flood Safety and Evacuation Drill', '', '<p>&nbsp;</p>', 'flood-safety-and-evacuation-drill', '2020-07-07 10:40:11', 1, 1, 7, 1, 0, 0, 0),
(47, '5f3622222ebea', '', '', '', '<p><br data-cke-filler=\"true\"></p>', '', '2020-08-14 00:33:33', 0, 0, 1, 1, 0, 0, 0),
(48, '5f3624be84cd4', 'https://sikap.org/filemanager/NEWS/news_1598755090.jpg', 'SIKAP Conducts Training-Workshops on Performance Accountability System', '', '<div style=\"text-align: justify;\">In order to build more the capacity of its staff, SIKAP conducted Training-Workshops on Performance Accountability System (PAS) on August 3-5, 2020 at Mabe&rsquo;s Savory Place, San Francisco, Agusan del Sur. Conducted under the organization&rsquo;s Sexual Health and Empowerment (SHE) project, the activity was instrumental in improving the knowledge and skills of SIKAP staff on the subject matter.&nbsp; &nbsp;<br /><br /></div>\n<div style=\"text-align: justify;\">PAS, which was developed by the World Health Organization (WHO, is a tested and proven tool in effecting strategic improvements in the health conditions of communities. It fosters a culture of performance and participation through mutual and collective accountability. It is a systems approach to decrease unmet needs or increase Contraceptive Prevalence Rate (CPR). It establishes a culture of care and respect for men, women and children; thus gradually eradicating gender-based violence. &nbsp; &nbsp;<br /><br /></div>\n<div style=\"text-align: justify;\">The facilitator, Mr. Earl Enrico A. Alcala, managed to impress the salient features of the PAS approach to the participants, as summarized below.<br /><br /></div>\n<div style=\"text-align: justify;\">One of the major activities in the PAS approach is the Breakthrough Planning. A breakthrough is defined as &lsquo;an important discovery that helps solve a problem&rsquo;. In the medical field, &lsquo;breakthroughs&rsquo; are usually associated with the discovery of a new drug or technology that treats or diagnoses diseases. However, used in the context of current projects of SIKAP on sexual reproductive health, a &lsquo;breakthrough&rsquo; refers to the transformative process of health planning that can enhance health governance, mobilize communities and improve performance of family planning program. &nbsp;<br /><br /></div>\n<div style=\"text-align: justify;\">Breakthrough Planning is a process that is evidence-based and involves barangay-level participation in identifying problems and solutions. It focuses on the inputs and processes through which the outputs or outcomes are to be achieved, and identifies who is responsible for them. Hence, it fosters greater accountability and better achievement of results. These features make breakthrough plans significantly different from the usual formulated health plans. The plan is usually formulated for a period of three to four months and is repeated over and over until a breakthrough result is achieved. It begins as a small step that can help communities break out of the cycle of low performance and poor health outcomes and gradually moves them towards bigger changes.<br /><br />SIKAP thanks OXFAM and Global Affairs Canada, the funder of SHE Project for the learning opportunity.</div>', 'sikap-conducts-training-workshops-on-performance-accountability-system', '2020-08-14 00:44:36', 0, 1, 1, 1, 0, 0, 0),
(49, '5f36252e344a0', '', '', '', '<p><br data-cke-filler=\"true\"></p>', '', '2020-08-14 00:47:22', 0, 0, 1, 1, 0, 0, 0),
(50, '5f3626bdb4a95', 'https://sikap.org/filemanager/stratplan.jpg', 'Strat Plan', '', '<p><br data-cke-filler=\"true\"></p>', 'strat-plan', '2020-08-14 00:53:18', 0, 1, 7, 1, 0, 0, 0),
(51, '5f3d250657628', '', 'adfasdf', 'asdfasdfsf', '<p><br data-cke-filler=\"true\"></p>', 'adfasdf', '2020-08-19 08:11:39', 0, 0, 1, 1, 0, 0, 0),
(52, '5f427b598bbb1', 'https://sikap.org/filemanager/news_1598192685.jpg', '', '', '<p><br data-cke-filler=\"true\"></p>', '', '2020-08-23 09:21:41', 0, 0, 1, 1, 0, 0, 0),
(53, '5f43d70f990b4', '', 'Building the Capacities of the Communities in Gibong Waterhsed to address their Health, Natural Resource and Livelihood Needs', '', '<p><br data-cke-filler=\"true\"></p>', 'building-the-capacities-of-the-communities-in-gibong-waterhsed-to-address-their-health-natural-resource-and-livelihood-needs', '2020-08-24 10:05:06', 1, 1, 5, 1, 0, 1, 0),
(54, '5f43d74368aa2', '', 'Enhancing Primary Services for the Protection and Reduction of Health Risks in the Children and Youth', '', '<p><br data-cke-filler=\"true\"></p>', 'enhancing-primary-services-for-the-protection-and-reduction-of-health-risks-in-the-children-and-youth', '2020-08-24 10:05:48', 1, 1, 5, 1, 0, 1, 0),
(55, '5f43d75dd3370', '', 'Integrating Children’s Rights in Civil Society and Governance in Agusan del Sur', '', '<p><br data-cke-filler=\"true\"></p>', 'integrating-childrens-rights-in-civil-society-and-governance-in-agusan-del-sur', '2020-08-24 10:06:08', 1, 1, 5, 1, 0, 1, 0),
(56, '5f43d76d95b64', '', 'Child’s Protection Rapid Appraisal', '', '<p><br data-cke-filler=\"true\"></p>', 'childs-protection-rapid-appraisal', '2020-08-24 10:06:30', 1, 1, 5, 1, 0, 1, 0),
(57, '5f43d7801736d', 'https://sikap.org/filemanager/IP/MCCT-FNSP_2.jpg', 'Modified Conditional Cash Transfer for Families in Need of Special Protection (MCCT-FNSP)', '', '<p>Families in need of special protection are emerging and growing concerns on the area of social protection. Usually, when a member of a family is affected by difficult circumstances, the whole family is also affected. These families include those who are displaced in their homes due to various circumstances such as those who were victims of man-made and natural calamities, IP migrant families, informal settlers pursuing for better economic opportunities, and families with children in need of special protection such as children with disabilities, street children, out-of-school children, child laborers, abandoned and abused including those who were victims of other forms exploitation. &nbsp;</p><p>Families abound with a variety of cases of children in difficult circumstances who need specialized mode of interventions. These families vary in types and composition such as family of two or more siblings living together, nuclear, a combination of extended and nuclear families and with mixed relationships. Regardless of the type of families, they are the ones not usually captured into the regular Conditional Cash Transfer Program. &nbsp;</p><p>The Pantawid Pamilyang Pilipino Program hopes to strengthen its coverage by targeting the families in need of special protection to provide and strengthen the safety, protection and development of children in difficult circumstances. It is a modified approach designed to maximize the reach of the Conditional Cash Transfer Program for the purpose of helping families and children in difficult circumstances overcome their situation and mainstream them into the regular CCT while generating appropriate resources and services in the community.</p><figure class=\"image ck-widget ck-widget_with-resizer\" contenteditable=\"false\"><img src=\"https://sikap.org/filemanager/IP/MCCT-FNSP.jpg\"><div class=\"ck ck-reset_all ck-widget__resizer\" style=\"height: 345px; left: 0px; top: 0px; width: 613px; display: none;\"><div class=\"ck-widget__resizer__handle ck-widget__resizer__handle-top-left\"></div><div class=\"ck-widget__resizer__handle ck-widget__resizer__handle-top-right\"></div><div class=\"ck-widget__resizer__handle ck-widget__resizer__handle-bottom-right\"></div><div class=\"ck-widget__resizer__handle ck-widget__resizer__handle-bottom-left\"></div><div class=\"ck ck-size-view\" style=\"display: none;\"></div></div><figcaption class=\"ck-placeholder ck-editor__editable ck-editor__nested-editable ck-hidden\" data-placeholder=\"Enter image caption\" contenteditable=\"true\"><br data-cke-filler=\"true\"></figcaption></figure><p>The objectives of MCCT-FNSP are the following: &nbsp;</p><p style=\"margin-left:40px;\">a) To bring back children to schools and facilitate their regular attendance including access to Alternative Delivery Mode and other special learning modes;</p><p style=\"margin-left:40px;\">b) Facilitate availment of health and nutrition services through regular visits to the health center;</p><p style=\"margin-left:40px;\">c) To enhance parenting roles through attendance to Family Development Sessions;</p><p style=\"margin-left:40px;\">d) To bring back children from the streets to more suitable, decent and permanent homes and reunite with their families;</p><p style=\"margin-left:40px;\">e) To mainstream families with children in need of special protection for normal psyco-social functioning through Pantawid Pamilya Program.</p><figure class=\"image ck-widget ck-widget_with-resizer\" contenteditable=\"false\"><img src=\"https://sikap.org/filemanager/IP/MCCT-FNSP_1.jpg\"><div class=\"ck ck-reset_all ck-widget__resizer\" style=\"height: 656px; left: 0px; top: 0px; width: 912px; display: none;\"><div class=\"ck-widget__resizer__handle ck-widget__resizer__handle-top-left\"></div><div class=\"ck-widget__resizer__handle ck-widget__resizer__handle-top-right\"></div><div class=\"ck-widget__resizer__handle ck-widget__resizer__handle-bottom-right\"></div><div class=\"ck-widget__resizer__handle ck-widget__resizer__handle-bottom-left\"></div><div class=\"ck ck-size-view\" style=\"display: none;\"></div></div><figcaption class=\"ck-placeholder ck-editor__editable ck-editor__nested-editable ck-hidden\" data-placeholder=\"Enter image caption\" contenteditable=\"true\"><br data-cke-filler=\"true\"></figcaption></figure><p>MCCT-FNSP was implemented in two schemes, DSWD-run and CSO-run. Under the CSO-run scheme, SIKAP was engaged in October 2012 for the implementation of the project in Sibagat and Veruela, Agusan del Sur covering 2,000 households with IPs, PWDs, Internally displaced and families with child laborers. &nbsp;</p><p>SIKAP’s task and responsibility was to undertake the whole process of identification of beneficiaries to enrollment and delivery of support interventions such as:</p><p>a)Assessment and validation of target beneficiaries and their families</p><p>b)Community/Group assembly and registration</p><p>c)Case management, monitoring, evaluation and documentation&nbsp;</p><p>d)Conduct of capacity building activities for the staff and beneficiaries such as Family Life Education and Counseling, parenting education, youth value formation and other family development/enrichment programs and activities</p><p>e)Referral and follow up of support services for special cases/concerns as part of case management plan</p><p>To run the program, SIKAP Field Offices were established in Sibagat and Veruela municipalities. There was also hiring of 22 Case Worker/Organizer and a Child Welfare Aid.</p><p>One of the major activities under MCCT-FNSP was the Family Development Sessions (FDS). &nbsp;Training modules and sub-modules used were translated to local language for easy understanding of the communities. These modules are the following:</p><p>Module 1. Family and Community-based Disaster Preparedness</p><p>Module 2. Maternal and child Care</p><p>Module 3. Building Children’s Positive Behavior</p><p>FDS under the Conditional Cash Transfer Program is the main tool in the development of human capital. In this sense, FDS in the field should observe functional standards and effective strategies so that translation of learning into practice can be within reach. FDS &nbsp;is also a venue of expressions among MCCT beneficiaries’ psychosocial status even as it is a collective and individual psycho-social facility in the helping process.</p><p>Other significant project activities are listed below:</p><ol><li>Facilitation of Kasalan ng Bayan of MCCT beneficiaries. A total of 114 couples became legally married and marriage certificate were acquired. This allows several families to access government services and children are legitimized.</li><li>On-site free registration of unregistered beneficiaries. A total of 59 unregistered births were facilitated for free. With the support of the LGU, fees and penalties for late registration were waived. This initiative gave rights to several individuals. &nbsp;</li><li>Aedow ni Tatay, a Father’s Day celebration, was participated by 130 fathers, opening an avenue for active participation of fathers in project activities and increase positive perspective on responsible parenthood. &nbsp;</li><li>Conduct of case management and facilitate referral and intervention of special cases.</li><li>Capacity building activities for Case Worker and Child Welfare Aid personnel of SIKAP and DSWD.</li></ol><figure class=\"image ck-widget ck-widget_with-resizer\" contenteditable=\"false\"><img src=\"https://sikap.org/filemanager/IP/MCCT-FNSP_2.jpg\"><div class=\"ck ck-reset_all ck-widget__resizer\" style=\"height: 324px; left: 0px; top: 0px; width: 912px; display: none;\"><div class=\"ck-widget__resizer__handle ck-widget__resizer__handle-top-left\"></div><div class=\"ck-widget__resizer__handle ck-widget__resizer__handle-top-right\"></div><div class=\"ck-widget__resizer__handle ck-widget__resizer__handle-bottom-right\"></div><div class=\"ck-widget__resizer__handle ck-widget__resizer__handle-bottom-left\"></div><div class=\"ck ck-size-view\" style=\"display: none;\"></div></div><figcaption class=\"ck-placeholder ck-editor__editable ck-editor__nested-editable ck-hidden\" data-placeholder=\"Enter image caption\" contenteditable=\"true\"><br data-cke-filler=\"true\"></figcaption></figure><p>In implementing the project, SIKAP learned several things, some of which are enumerated below: &nbsp;</p><ul><li>Compliance Verification – Accessing cash grant by way of complying program conditionality is not our main strategy in CCT program. In sustainable development perspective, the program exits to shift paradigms of the poor and disadvantaged communities by empowering them while the government provides for opportunities in the process of their mainstreaming in the course of development. This shift of paradigm can be attained in one way or another if advocacies in health, education and responsible parenthood are concretely institutionalized in FDS. With this, facilitation and innovations interplay in the process.</li><li>Maintaining good relationship in a multi-sectoral convergence setup is an advantage in accessing programs and projects. Counterparting and sharing of resources is a perfect strategy in providing other programs and services to partner communities and beneficiaries.</li><li>The primary goal of the mother program Pantawid Pamilya is to increase enrollment in poverty-stricken localities, where beneficiaries can avail cash assistance while accessing free education. Thus, the timing of the project implementation is crucial.</li><li>The program design and strategies should be processual. All activities regardless of value are interrelated and bear contribution in the achievement of intended results of the program. As said, “one activity begets another”. Irrelevant activity cannot contribute to the common goals. The outputs and process are equally important.</li><li>SIKAP believes that furthering the effectiveness of the program is to become context-specific in its implementation. One-size-fits-all approaches should be avoided, meaning implementation policies, designs, framework, strategies, tools and approaches should consider diverse cultures in all aspects of project implementation. &nbsp;</li></ul><figure class=\"image ck-widget ck-widget_with-resizer\" contenteditable=\"false\"><img src=\"https://sikap.org/filemanager/IP/MCCT-FNSP_3.jpg\"><div class=\"ck ck-reset_all ck-widget__resizer\" style=\"height: 294px; left: 0px; top: 0px; width: 869px; display: none;\"><div class=\"ck-widget__resizer__handle ck-widget__resizer__handle-top-left\"></div><div class=\"ck-widget__resizer__handle ck-widget__resizer__handle-top-right\"></div><div class=\"ck-widget__resizer__handle ck-widget__resizer__handle-bottom-right\"></div><div class=\"ck-widget__resizer__handle ck-widget__resizer__handle-bottom-left\"></div><div class=\"ck ck-size-view\" style=\"display: none;\"></div></div><figcaption class=\"ck-placeholder ck-editor__editable ck-editor__nested-editable ck-hidden\" data-placeholder=\"Enter image caption\" contenteditable=\"true\"><br data-cke-filler=\"true\"></figcaption></figure>', 'modified-conditional-cash-transfer-for-families-in-need-of-special-protection-mcct-fnsp', '2020-08-24 10:06:50', 1, 1, 5, 1, 0, 1, 0),
(58, '5f43d793dd138', 'https://sikap.org/filemanager/IP/MCCT-IP.jpg', 'Modified Conditional Cash Transfer for Indigenous Peoples (MCCT-IP)', '', '<p>The Department of Social Welfare and Development (DSWD), with its mission to provide social protection and promote the rights and welfare of poor households, implemented the Pantawid Pamilyang Pilipino Program focusing on human capital investment of children 0-18 years old and pregnant women.</p><p>To strengthen the coverage of the program and to make it more inclusive, Pantawid started to target homeless and street dwellers through the Modified Conditional Cash Transfer Program (MCCT) with the aim of providing them safety and protection along with other development opportunities. MCCT is designed to reach out homeless street families and the Indigenous Peoples (IP) who are definitely poor and disadvantaged but are left out in the implementation of the Pantawid because of their being excluded in the enumeration of the National Housing Targeting System for having no homes and residing in geographically-isolated and inaccessible areas. Purposely, the MCCT is designed to enable the homeless street families and indigenous peoples to overcome the barriers of enjoying the government’s social protection assistance.</p><figure class=\"image ck-widget ck-widget_with-resizer\" contenteditable=\"false\"><img src=\"https://sikap.org/filemanager/IP/MCCT-IP_1.jpg\"><div class=\"ck ck-reset_all ck-widget__resizer\" style=\"height: 432px; left: 0px; top: 0px; width: 642px; display: none;\"><div class=\"ck-widget__resizer__handle ck-widget__resizer__handle-top-left\"></div><div class=\"ck-widget__resizer__handle ck-widget__resizer__handle-top-right\"></div><div class=\"ck-widget__resizer__handle ck-widget__resizer__handle-bottom-right\"></div><div class=\"ck-widget__resizer__handle ck-widget__resizer__handle-bottom-left\"></div><div class=\"ck ck-size-view\" style=\"display: none;\"></div></div><figcaption class=\"ck-placeholder ck-editor__editable ck-editor__nested-editable ck-hidden\" data-placeholder=\"Enter image caption\" contenteditable=\"true\"><br data-cke-filler=\"true\"></figcaption></figure><p><br data-cke-filler=\"true\"></p><p>In implementing MCCT, coordination and collaboration with various stakeholders proved to be very helpful strategies in reaching out to the target clienteles. One of the critical partnerships that supported program implementation is the engagement with Civil Society Organizations (CSOs) who served as co-implementers on the ground and provided other needed support services to the MCCT beneficiaries. In this mode of partnership, CSOs provided needed expertise and shared resources in the implementation of various components of the program. &nbsp;</p><p>Broadening and sustaining such partnership therefore would hopefully pave the way for a dynamic and strengthened participation toward creating a just and humane environment for partner-beneficiaries who suffer from poverty. &nbsp;</p><p>On August 5, 2014, SIKAP signed a Memorandum of Agreement with DSWD Field Office Caraga. The engagement generally aims to achieve a sustainable public-private partnership while bringing quality protection services. More specifically, the engagement hopes to result to:</p><ol><li>Demonstrated increase in public-private partnership in the implementation of Modified Conditional Cash Transfer;</li><li>Strengthened promotion of individual well-being among homeless street families (HSF);</li><li>Ensured protection of Indigenous People (IP) and respect to their culture and beliefs;</li><li>Enhanced parenting roles through the parents’ attendance to Family Development Sessions; and</li><li>Mainstreamed homeless street children into the regular Pantawid Pamilyang Pilipino Program. &nbsp;</li></ol><p>SIKAP covered 76 barangays identified as geographically-isolated and disadvantaged areas (GIDA) in the municipalities of Sibagat, La Paz, Loreto, Veurela, Trento and Bunawan in the Province of Agusan del Sur. SIKAP also covered 2 municipalities in the Province of &nbsp;Surigao del Sur, namely Bayabas and Tagbina municipalities. &nbsp;</p><p>The engagement covered a total of 4,427 families/beneficiaries. To efficiently run the program, SIKAP hired 26 Community Facilitators (CFs) and Assistant CFs. &nbsp;</p><figure class=\"image ck-widget ck-widget_with-resizer\" contenteditable=\"false\"><img src=\"https://sikap.org/filemanager/IP/MCCT-IP_2.jpg\"><div class=\"ck ck-reset_all ck-widget__resizer\" style=\"height: 517px; left: 0px; top: 0px; width: 912px; display: none;\"><div class=\"ck-widget__resizer__handle ck-widget__resizer__handle-top-left\"></div><div class=\"ck-widget__resizer__handle ck-widget__resizer__handle-top-right\"></div><div class=\"ck-widget__resizer__handle ck-widget__resizer__handle-bottom-right\"></div><div class=\"ck-widget__resizer__handle ck-widget__resizer__handle-bottom-left\"></div><div class=\"ck ck-size-view\" style=\"display: none;\"></div></div><figcaption class=\"ck-placeholder ck-editor__editable ck-editor__nested-editable ck-hidden\" data-placeholder=\"Enter image caption\" contenteditable=\"true\"><br data-cke-filler=\"true\"></figcaption></figure><p>Innovativeness is one of SIKAP’s core values. It grabs every opportunity that is beneficial to its partner- communities and other multi-sectoral agencies. It continually learns new skills, introduces new models, and challenges new approaches with a clear view of looking at reality and cultural differences. &nbsp;</p><p>Guided by its core values, SIKAP introduced innovations that contributed to the success of the MCCT program. This was the CFDS on Air Program segment titled \"Ang Takna sa Pamilya\". Airing every Thursday at 9:00 in the morning, the segment served as a platform in increasing community awareness about the MCCT-IP program, its implementation updates and the unified efforts to address malnutrition and other health issues of the children across various sectors. This was implemented in partnership with the Radyo Kaagapay Station DXCN 99.1 of the Local Government of Sibagat, Agusan del Sur thru the NutrEskwela Program of the National Nutrition Council-Department of Health (DOH). &nbsp;</p><figure class=\"image ck-widget ck-widget_with-resizer\" contenteditable=\"false\"><img src=\"https://sikap.org/filemanager/IP/MCCT-IP_3.jpg\"><div class=\"ck ck-reset_all ck-widget__resizer\" style=\"height: 497px; left: 0px; top: 0px; width: 389px; display: none;\"><div class=\"ck-widget__resizer__handle ck-widget__resizer__handle-top-left\"></div><div class=\"ck-widget__resizer__handle ck-widget__resizer__handle-top-right\"></div><div class=\"ck-widget__resizer__handle ck-widget__resizer__handle-bottom-right\"></div><div class=\"ck-widget__resizer__handle ck-widget__resizer__handle-bottom-left\"></div><div class=\"ck ck-size-view\" style=\"display: none;\"></div></div><figcaption class=\"ck-placeholder ck-editor__editable ck-editor__nested-editable ck-hidden\" data-placeholder=\"Enter image caption\" contenteditable=\"true\"><br data-cke-filler=\"true\"></figcaption></figure><p>The radio segment turned out to be strategic in providing knowledge to on-air audiences particularly the IPs whose main source of information are their portable, transistor &nbsp;radios. Discussions covered relevant topics/themes such as the Indigenous Peoples Rights Act (RA 8371), the Fundamental Rights of the Children and Disaster Risk Reduction and Management (DRRM).</p><p>The segment sought to become interactive by providing an immediate exchange of ideas with the listeners where queries, comments and recommendations on particular topics discussed were given air-time and responded to instantly. The program segment also facilitated announcements and updating of MCCT-IP program implementation in the barangays. &nbsp;</p><p>The innovation exhibited massive consciousness-raising potentials and proved to be user-friendly to various sectors that have limited information sources, particularly the IPs in GIDAs. The same innovation reinforced the Community and Family Development Sessions (CFDS) for various stakeholders, more specifically partner-beneficiaries themselves.&nbsp;</p><figure class=\"image ck-widget ck-widget_with-resizer\" contenteditable=\"false\"><img src=\"https://sikap.org/filemanager/IP/MCCT-IP_4.jpg\"><div class=\"ck ck-reset_all ck-widget__resizer\" style=\"height: 667px; left: 0px; top: 0px; width: 912px; display: none;\"><div class=\"ck-widget__resizer__handle ck-widget__resizer__handle-top-left\"></div><div class=\"ck-widget__resizer__handle ck-widget__resizer__handle-top-right\"></div><div class=\"ck-widget__resizer__handle ck-widget__resizer__handle-bottom-right\"></div><div class=\"ck-widget__resizer__handle ck-widget__resizer__handle-bottom-left\"></div><div class=\"ck ck-size-view\" style=\"display: none;\"></div></div><figcaption class=\"ck-placeholder ck-editor__editable ck-editor__nested-editable ck-hidden\" data-placeholder=\"Enter image caption\" contenteditable=\"true\"><br data-cke-filler=\"true\"></figcaption></figure>', 'modified-conditional-cash-transfer-for-indigenous-peoples-mcct-ip', '2020-08-24 10:07:10', 1, 1, 5, 1, 0, 1, 0);
INSERT INTO `t_posts` (`id`, `postid`, `photo`, `title`, `description`, `post`, `slug`, `date`, `isactive`, `status`, `type`, `userid`, `is_featured`, `program_category`, `fbposted`) VALUES
(59, '5f43d7ab6177a', 'https://sikap.org/filemanager/PROGRAMS/programs_1598756200.jpg', 'Sexual Health and Empowerment (SHE)', '', '<h3 style=\"text-align: center;\"><strong><img style=\"float: left;\" src=\"data:image/jpeg;base64,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\" width=\"242\" height=\"87\" /></strong></h3>\n<h3 style=\"text-align: left;\"><strong><br />&nbsp; &nbsp; &nbsp; &nbsp;The Project&nbsp;<br /></strong></h3>\n<h3 style=\"text-align: center;\">&nbsp;</h3>\n<div style=\"text-align: justify;\">Sexual Health and Empowerment (SHE) Project aims to empower women and girls to secure their sexual and reproductive health and rights (SRHR) in six (6) disadvantaged and conflict-affected regions of the Philippines. With funds from the Global Affairs Canada through OXFAM worth CAD 17.5M, the 5-year (2018 &ndash; 2023) project aims to do the following:<br /><br /></div>\n<ul>\n<li style=\"text-align: justify;\">\n<div>Improve knowledge and awareness on SRHR particularly among women and girls, including the prevention of gender-based violence (GBV);</div>\n</li>\n<li style=\"text-align: justify;\">\n<div>Strengthen health systems and community structures to deliver rights-based comprehensive SRHR information and services; and&nbsp;</div>\n</li>\n<li>\n<div style=\"text-align: justify;\"><img style=\"float: right;\" src=\"../../../filemanager/gaf.png\" width=\"460\" height=\"75\" />Improve the effectiveness and capacity of women&rsquo;s rights organizations (WROs) and women&rsquo;s movements to advance SRHR and prevent GBV.</div>\n</li>\n</ul>\n<h3><strong><br />SHE Project has two main components:<br /><br /></strong></h3>\n<ol>\n<li>\n<div style=\"text-align: justify;\">\n<h3><strong><img style=\"float: right;\" src=\"../../../filemanager/SHE/she_image_compressed.jpg\" width=\"307\" height=\"277\" /></strong></h3>\nPromoting demand for SRHR information and services by transforming discriminatory social norms through awareness-raising and mobilization activities focusing on improved access to SRHR information and services, including GBV prevention and support services.</div>\n</li>\n<li style=\"text-align: justify;\">\n<div>Building the capacity of WROs and networks of people&rsquo;s organizations to advocate for women&rsquo;s rights and for improved SRHR and GBV services. The project provides capacity-building support and funding to 10 WROs/networks working on SRH and GBV, and establishes a responsive funding mechanism to provide timely funding to WROs/networks to carry out actions in support of SRHR, GBV and women&rsquo;s rights.</div>\n</li>\n</ol>\n<div style=\"text-align: justify;\">SHE directly benefits approximately 85,000 men and women in 6 regions (Bicol, Eastern Visayas, Autonomous Region of Muslim Mindanao (ARMM), Zamboanga Peninsula, Northern Mindanao, and Caraga). It indirectly benefits 270,000 people in 13 provinces including some geographically isolated and disadvantaged areas.</div>\n<p><img src=\"../../../filemanager/SHE/she_image2_compressed.jpg\" width=\"100%\" height=\"auto\" /></p>\n<h3><strong><br />The Context</strong></h3>\n<div style=\"text-align: justify;\">In the Philippines, the key barriers that prevent women from exercising their SRHR include 1) gender inequality and limited decision-making power; 2) sex trafficking; 3) low access to SRHR information and services; 4) sexual and gender-based violence; and 5) a range of discriminatory socio-cultural practices, including child and early forced marriage.</div>\n<div style=\"text-align: justify;\">SHE project aims to addresses these barriers by doing the following:</div>\n<ul>\n<li style=\"text-align: justify;\">\n<div>It improves knowledge and awareness of sexual reproductive health and rights, particularly among women and girls, including the prevention of gender-based violence (GBV);</div>\n</li>\n<li style=\"text-align: justify;\">\n<div>It strengthens health systems and community structures to deliver rights-based comprehensive SRHR information and services; and &nbsp;</div>\n</li>\n<li>\n<div style=\"text-align: justify;\">It improves the effectiveness and capacity of women&rsquo;s rights organizations (WROs) and women&rsquo;s movements to advance SRHR and prevent GBV.<br />\n<h3><strong><img src=\"../../../filemanager/SHE/she_image3_compressed.jpg\" width=\"100%\" height=\"auto\" /></strong></h3>\n</div>\n</li>\n</ul>\n<h3><strong><br /><br />The Partners</strong></h3>\n<p><img src=\"../../../filemanager/SHE/she_image4.png\" width=\"100%\" height=\"auto\" /><br /><br />As could be gleaned from the Project Map, SIKAP is the implementing organization covering the Provinces of Surigao del Sur and Surigao del Norte of Caraga Region. In Surigao del Sur, SHE covers the municipalities of Cagwait and Lianga while in Agusan del Norte, SHE Project covers the municipalities of Jabonga and Santiago. In total SIKAP covers 47 barangays.</p>\n<p>&nbsp;</p>', 'sexual-health-and-empowerment-she', '2020-08-24 10:07:29', 1, 1, 5, 1, 0, 1, 0),
(60, '5f43dd2d22475', '', 'Manobo Tribe in CADT 136 of the Municipality of Bunawan, Agusan del Sur', '', '<p><br data-cke-filler=\"true\"></p>', 'manobo-tribe-in-cadt-136-of-the-municipality-of-bunawan-agusan-del-sur', '2020-08-24 10:30:55', 1, 1, 5, 1, 0, 2, 0),
(61, '5f43dd3a860f2', '', 'Manobo Tribe in CADT 078 of the Municipality of Rosario, Agusan del Sur', '', '<p><br data-cke-filler=\"true\"></p>', 'manobo-tribe-in-cadt-078-of-the-municipality-of-rosario-agusan-del-sur', '2020-08-24 10:31:13', 1, 1, 5, 1, 0, 2, 0),
(62, '5f43dd49ac7ed', '', 'Manobo Tribe in CADT 089 of the Municipality of Loreto, Agusan del Sur', '', '<p><br data-cke-filler=\"true\"></p>', 'manobo-tribe-in-cadt-089-of-the-municipality-of-loreto-agusan-del-sur', '2020-08-24 10:31:34', 1, 1, 5, 1, 0, 2, 0),
(63, '5f43dd5ec120e', '', 'Manobo Tribe in CADT 089 of the Municipality of Veruela and portion of Sta. Josefa, Agusan del Sur', '', '<p><br data-cke-filler=\"true\"></p>', 'manobo-tribe-in-cadt-089-of-the-municipality-of-veruela-and-portion-of-sta-josefa-agusan-del-sur', '2020-08-24 10:32:01', 1, 1, 5, 1, 0, 2, 0),
(64, '5f43ddfce1562', '', 'Formulation of Ancestral Domain Sustainable Development and Protection Plan (ADSDPP)', '', '<p><br data-cke-filler=\"true\"></p>', 'formulation-of-ancestral-domain-sustainable-development-and-protection-plan-adsdpp', '2020-08-24 10:34:24', 1, 1, 5, 1, 0, 2, 0),
(65, '5f43deb681b07', 'https://sikap.org/filemanager/IP/ip2_compressed.jpg', 'Indigenous Peoples Development Programme  (IPDP Caraga)', '', '<div style=\"text-align: justify;\"><img style=\"display: block; margin-left: auto; margin-right: auto;\" src=\"../../../filemanager/IP/ip.png\" width=\"auto\" height=\"auto\" /><br />The Caraga Indigenous People Development Programme (IPDP) is a collaborative undertaking of the Government of Spain and the International Labour Organization (ILO) implemented in 2009 to 2012. &nbsp;</div>\n<div style=\"text-align: justify;\">The overall development objective of the project is to strengthen the capacity of Indigenous Peoples (IPs) in the context of self-reliance for them to be able to do the following:</div>\n<div style=\"text-align: justify;\">\n<ul>\n<li>Protection of their fundamental rights,</li>\n<li>Preservation of the environment; and</li>\n<li>Reduction of poverty in their midst.</li>\n</ul>\n</div>\n<div style=\"text-align: justify;\">The overall project objective is to be worked out within the framework of development and protection of ancestral domains in partnership with the government, non-government organizations and other service providers. &nbsp;Specifically, the project aims to enable the indigenous peoples to have: &nbsp;</div>\n<ol>\n<li style=\"text-align: justify;\">\n<div>Structurally stable community organizations that are equipped with organizational management skills and have sufficient capacity to serve as community development facilitator;</div>\n</li>\n<li>\n<div style=\"text-align: justify;\">An improved knowledge and understanding of their human and other fundamental rights and the capacity to assert and protect these rights;</div>\n</li>\n<li style=\"text-align: justify;\">Improved traditional livelihoods that could result in higher income and employment opportunities anchored on the sustainable development and protection of the available resources within their ancestral domain;</li>\n<li style=\"text-align: justify;\">Effective community-driven environmental protection and rehabilitation mechanisms in place; and</li>\n<li style=\"text-align: justify;\">Effective mechanisms for mainstreaming gender equality issues in the development process within their ancestral domain.</li>\n</ol>\n<p>The Project has five components, namely:</p>\n<ol>\n<li>Institution Building;</li>\n<li>Promotion of Human/IP Rights;</li>\n<li>Support to Income and Employment Generation;</li>\n<li>Protection of the Environment; and</li>\n<li>Promotion of Gender Equality.</li>\n</ol>\n<div style=\"text-align: justify;\"><img style=\"float: right;\" src=\"../../../filemanager/IP/ip_image_2.jpg\" width=\"331\" height=\"257\" />The project was executed by ILO Country Office in Manila in cooperation with the National Commission on Indigenous Peoples (NCIP), Local Government Units, and IP organizations (IPOs). SIKAP was the local NGO partner commissioned by ILO in the implementation of project activities in 8 Ancestral Domains in four (4) provinces in Caraga Ragion. &nbsp;</div>\n<div style=\"text-align: justify;\">With the adopted Community Action Plans (CAPs), the IPOs were mobilized to provide overall leadership in the protection, development and management of their respective Ancestral Domains including the implementation of IPDP-supported interventions. &nbsp;</div>\n<p>The following umbrella IPOs are central to the coordination and implementation of IPDP activities in the project sites:</p>\n<table class=\"table table-bordered\">\n<tbody>\n<tr>\n<td style=\"width: 200px;\"><span style=\"display: inline-block;\">Province</span></td>\n<td><span style=\"display: inline-block;\"><span style=\"background-color: #ffffff; color: #000000;\">Ancestral Domain/Project Site</span> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</span></td>\n<td><span style=\"display: inline-block;\"><span style=\"background-color: #ffffff; color: #000000;\">Indigenous Peoples Organizations (IPO)</span></span></td>\n</tr>\n<tr>\n<td rowspan=\"3\"><span style=\"display: inline-block;\"><span style=\"background-color: #ffffff; color: #000000;\">Agusan Del Norte</span></span></td>\n<td><span style=\"display: inline-block;\"><span style=\"background-color: #ffffff; color: #000000;\">CADT No. 134 &ndash; Santiago, Jabonga, Kitcharao</span></span></td>\n<td><span style=\"display: inline-block;\"><span style=\"background-color: #ffffff; color: #000000;\">Mamanwa-Manobo Ancestral Domain Management Council</span></span></td>\n</tr>\n<tr>\n<td><span style=\"display: inline-block;\"><span style=\"background-color: #ffffff; color: #000000;\">CADT No. 092 - Cabadabaran, Santiago, Tubay</span></span></td>\n<td><span style=\"display: inline-block;\"><span style=\"background-color: #ffffff; color: #000000;\">Mamanwa-Manobo Ancestral Domain Management Council</span></span></td>\n</tr>\n<tr>\n<td><span style=\"display: inline-block;\"><span style=\"background-color: #ffffff; color: #000000;\">CADT No. 135 &ndash; Anticala, Butuan City</span></span></td>\n<td><span style=\"display: inline-block;\"><span style=\"background-color: #ffffff; color: #000000;\">Anticala Pianing Tribal Organization (APTO)</span></span></td>\n</tr>\n<tr>\n<td rowspan=\"2\"><span style=\"display: inline-block;\"><span style=\"background-color: #ffffff; color: #000000;\">Agusan Del Sur</span></span></td>\n<td><span style=\"display: inline-block;\"><span style=\"background-color: #ffffff; color: #000000;\">CADT No. 089 &ndash; Veruela, Sta Josefa</span></span></td>\n<td><span style=\"display: inline-block;\"><span style=\"background-color: #ffffff; color: #000000;\">Veruela-Sta.Josefa Ancestral Domain Management Organization (VESTA-ADMO);</span></span></td>\n</tr>\n<tr>\n<td><span style=\"display: inline-block;\"><span style=\"background-color: #ffffff; color: #000000;\">CADT No 093 &ndash; Sibagat, Carmen</span></span></td>\n<td><span style=\"display: inline-block;\"><span style=\"background-color: #ffffff; color: #000000;\">Wawa Sectoral Tribal Council (WAWASTC)</span></span></td>\n</tr>\n<tr>\n<td rowspan=\"2\"><span style=\"display: inline-block;\"><span style=\"background-color: #ffffff; color: #000000;\">Surigao Del Sur</span></span></td>\n<td><span style=\"display: inline-block;\"><span style=\"background-color: #ffffff; color: #000000;\">CADT No 048 &ndash; San Jose, Bislig, Lindig</span></span></td>\n<td><span style=\"display: inline-block;\"><span style=\"background-color: #ffffff; color: #000000;\">Pamaypayan-San Jose Sikahoy Manobo/Mandaya Ancestral Domain Management Organization (PSS MAMADMO)</span></span></td>\n</tr>\n<tr>\n<td><span style=\"display: inline-block;\"><span style=\"background-color: #ffffff; color: #000000;\">CADT No. 116 &ndash; San Miguel</span></span></td>\n<td><span style=\"display: inline-block;\"><span style=\"background-color: #ffffff; color: #000000;\">San Miguel Manobo Indigenous Cultural Communities Organization (SAMMICO)</span></span></td>\n</tr>\n<tr>\n<td><span style=\"display: inline-block;\"><span style=\"background-color: #ffffff; color: #000000;\">Surigao Del Norte</span></span></td>\n<td><span style=\"display: inline-block;\"><span style=\"background-color: #ffffff; color: #000000;\">CADT No ___- Malimuno, Mainit, Sison, San Jose Franciso, Surigao City</span></span></td>\n<td><span style=\"display: inline-block;\"><span style=\"background-color: #ffffff; color: #000000;\">Malimono-Mainit-San Francisco-Sison-SUrigao City Tribal Organization (MAMASANSISU).</span></span></td>\n</tr>\n</tbody>\n</table>\n<div style=\"text-align: justify;\">In the middle of the implementation (2.5 years of the planned 4.5 years), the project already made significant impacts on the lives of IPs in the project sites as well as on the magnitude and quality of the delivery of services of development partners or service providers. Consider the explications that follow: &nbsp;</div>\n<ul>\n<li style=\"text-align: justify;\">\n<div><img style=\"float: right;\" src=\"../../../filemanager/IP/ip2_compressed.jpg\" width=\"225\" height=\"299\" />Positive change in the mindset. The IPO leaders indicated that with the IPDP interventions, their attitude towards development assistance was drastically changed: from dependency to self-reliance. The approach adopted by IPDP allowed the IPO leaders to formulate their own Community Actions Plans (CAPs) that served as their common development direction. The leadership and governance training courses that the IPO leaders underwent gave them opportunity to re-examine and redefine the traditional governance system of their respective tribes; which they now employed in the management of their ancestral domains.</div>\n</li>\n<li>\n<div>Organized, strong IP institutions. The eight (8) IPOs composed of all sectoral IP organizations were already organized and assumed overall leadership and management of their respective Ancestral Domains. The IPOs started to confidently and actively engage with development partners.</div>\n</li>\n<li style=\"text-align: justify;\">Clearer development direction and improved convergence of services to IPs/Ancestral Domains. The adoption of CAPs now served as collective directions of IPOs in the Ancestral Domains. The convergence of services was already felt on the ground in support of the CAPs, which&nbsp;</li>\n<li style=\"text-align: justify;\"><img style=\"float: right;\" src=\"../../../filemanager/IP/ip_image_3.jpg\" width=\"388\" height=\"256\" />included the following:\n<ul>\n<li style=\"text-align: justify;\">The LGUs professed firm commitment to incorporate the ADSDPPs in the Local Development Plan, Annual Investment Plan and Comprehensive Land Use Plan (CLUP) in the case of San Miguel, Veruela, Sibagat, CADT 135 and CADT 134;</li>\n<li style=\"text-align: justify;\">The Commission on Human Rights (CHR) helped in the conduct of Training of Trainers (TOT) on Human/IP rights. CHR also assisted in the roll- out of Human/IP rights awareness in some CADT areas;</li>\n<li style=\"text-align: justify;\">The DepEd engaged the IP Para-Teachers to handle the Alternative Learning System (ALS) in some areas and committed to continue engaging the Para- Teachers in the ALS for IPOs. DepEd also indicated that it would start constructing in 2012 the Tingkala Tribal National High School in CADT 134; &nbsp;</li>\n<li style=\"text-align: justify;\">In some CADT areas, the LGUs/DAs/DTI provided training on pest management, marketing, fruit/vegetable processing, and production;</li>\n<li style=\"text-align: justify;\">In Veruela, DENR provided and continued distributing seedlings (rubber, fruit trees and banana) under the Upland Development Project and National Greening Program, (NGP).</li>\n<li style=\"text-align: justify;\">Provision of free registration (marriage and birth) to IPOs in the Local Civil Registry for IPs</li>\n</ul>\n</li>\n</ul>\n<ul>\n<li>\n<div style=\"text-align: justify;\">Commodity or Occupation-based enterprises established and generating income and employment for IPs. The 23 commodity or occupation-based self-help groups developed strong potentials for increasing agricultural and food production as well as generating income and employment for IP women and men. &nbsp;</div>\n</li>\n</ul>\n<div style=\"margin-left: 40px; text-align: justify;\">The following enterprises were put in place: &nbsp;</div>\n<ul>\n<li style=\"margin-left: 40px; text-align: justify;\">\n<div>Buy and sell of banana by Anticala-Pianing Banana Growers Association with consignee in Cavite/Manila with a capacity of supplying an average of 2,500 kilos per week.</div>\n</li>\n<li style=\"margin-left: 40px; text-align: justify;\">\n<div>Buy and sell of abaca by San Miguel Abaca SHG with a capacity of supplying 2,500 kilos per week and potentially up to 10,000 kilos per week.</div>\n</li>\n<li style=\"margin-left: 40px; text-align: justify;\">\n<div>Production and marketing of sago palm flour by KASAMACOR, an IP corporation, suitable for various food products (ice cream cone and bread). There have been testing by various interest groups and there is indication of strong demands for this product. The flour is cheaper and the raw materials (around 1,000 hectares) is big enough to supply the production capacity.</div>\n</li>\n<li style=\"margin-left: 40px; text-align: justify;\">\n<div>The Veruela Banana SHG started the buying and selling of banana. Women from 14 barangays in Veruela committed to participate in this enterprise.</div>\n</li>\n<li style=\"margin-left: 40px;\">\n<div style=\"text-align: justify;\">The Bislig Fruits and Vegetable SHG began to produce fruits and vegetable juices for human consumption and as feed supplement to animals.</div>\n</li>\n</ul>\n<p style=\"margin-left: 40px;\"><img style=\"display: block; margin-left: auto; margin-right: auto;\" src=\"../../../filemanager/IP/ip_image_4.jpg\" width=\"auto\" height=\"auto\" /></p>', 'indigenous-peoples-development-programme-ipdp-caraga', '2020-08-24 10:37:29', 1, 1, 5, 1, 0, 2, 0),
(66, '5f47ab783db03', '', 'Technology Generation on Sago Palm Propagation in Support Natural Resource Conservation', '', '<p><br data-cke-filler=\"true\"></p>', 'technology-generation-on-sago-palm-propagation-in-support-natural-resource-conservation', '2020-08-27 07:48:03', 1, 0, 5, 1, 0, 0, 0),
(67, '5f47b1a638aee', '', 'Technology Generation on Sago Palm Propagation in Support Natural Resource Conservation', '', '<p><br data-cke-filler=\"true\"></p>', 'technology-generation-on-sago-palm-propagation-in-support-natural-resource-conservation', '2020-08-27 08:14:27', 1, 1, 5, 1, 0, 4, 0),
(68, '5f47b1c3ed2ef', '', 'Technology and Product Innovations for Agri-based Products', '', '<p><br data-cke-filler=\"true\"></p>', 'technology-and-product-innovations-for-agri-based-products', '2020-08-27 08:14:53', 1, 1, 5, 1, 0, 4, 0),
(69, '5f47b1d77ff1c', '', 'Developing Entrepreneurship for Agri-based Products', '', '<p><br data-cke-filler=\"true\"></p>', 'developing-entrepreneurship-for-agri-based-products', '2020-08-27 08:15:26', 1, 1, 5, 1, 0, 4, 0),
(70, '5f47b1f9315c6', '', 'Development of the Business Plan on  Micro-Financing for the 14 branches of PERA MPC in Visayas and Mindanao', '', '<p><br data-cke-filler=\"true\"></p>', 'development-of-the-business-plan-on-micro-financing-for-the-14-branches-of-pera-mpc-in-visayas-and-mindanao', '2020-08-27 08:15:41', 1, 1, 5, 1, 0, 4, 0),
(71, '5f47b20f1843f', '', 'Development of the Business Plan of the Water District of Bunawan, Agusan del Sur', '', '<p><br data-cke-filler=\"true\"></p>', 'development-of-the-business-plan-of-the-water-district-of-bunawan-agusan-del-sur', '2020-08-27 08:16:02', 1, 1, 5, 1, 0, 4, 0),
(72, '5f47b23075ea7', '', 'Formulation of the Barangay Development Plans', '', '<p><br data-cke-filler=\"true\"></p>', 'formulation-of-the-barangay-development-plans', '2020-08-27 08:16:35', 1, 1, 5, 1, 0, 3, 0),
(73, '5f47b23c0bec1', '', 'Accelerating the Natural Resource Management Initiatives in Prosperidad, Agusan del Sur', '', '<p><br data-cke-filler=\"true\"></p>', 'accelerating-the-natural-resource-management-initiatives-in-prosperidad-agusan-del-sur', '2020-08-27 08:16:52', 1, 1, 5, 1, 0, 3, 0),
(74, '5f47b258f03b6', '', 'Formulation of the Barangay Development Plans (BDPs)', '', '<p><br data-cke-filler=\"true\"></p>', 'formulation-of-the-barangay-development-plans-bdps', '2020-08-27 08:17:16', 1, 1, 5, 1, 0, 3, 0),
(75, '5f47b2632838d', '', 'Road Watch', '', '<p><br data-cke-filler=\"true\"></p>', 'road-watch', '2020-08-27 08:17:29', 1, 1, 5, 1, 0, 3, 0),
(76, '5f47b26f7c171', '', 'Social Development and Management Plan (SDMP) Impact Assessment', '', '<p><br data-cke-filler=\"true\"></p>', 'social-development-and-management-plan-sdmp-impact-assessment', '2020-08-27 08:17:40', 1, 1, 5, 1, 0, 3, 0),
(77, '5f47b27f8c645', '', 'PAMANA Third Party Monitor on Infrastructure Projects', '', '<p><br data-cke-filler=\"true\"></p>', 'pamana-third-party-monitor-on-infrastructure-projects', '2020-08-27 08:17:54', 1, 1, 5, 1, 0, 3, 0),
(78, '5f47b28ab4f4e', '', 'Citizen Participatory Audit (CPA)', '', '<p><br data-cke-filler=\"true\"></p>', 'citizen-participatory-audit-cpa', '2020-08-27 08:18:07', 1, 1, 5, 1, 0, 3, 0),
(79, '5f47b29789172', '', 'Community Mobilization and Capacity Building Intervention for the Communities in KOICA-KEB MPC Project in Mindanao', '', '<p><br data-cke-filler=\"true\"></p>', 'community-mobilization-and-capacity-building-intervention-for-the-communities-in-koica-keb-mpc-project-in-mindanao', '2020-08-27 08:18:20', 1, 1, 5, 1, 0, 3, 0),
(80, '5f47b2a8a0117', '', 'KC-NCDD Municipal Talakayan', '', '<p><br data-cke-filler=\"true\"></p>', 'kc-ncdd-municipal-talakayan', '2020-08-27 08:18:35', 1, 1, 5, 1, 0, 3, 0),
(81, '5f47b2bad48f7', '', 'Updating of the Comprehensive Land Use Plan of the following city and municipalities', '', '<p><br data-cke-filler=\"true\"></p>', 'updating-of-the-comprehensive-land-use-plan-of-the-following-city-and-municipalities', '2020-08-27 08:18:54', 1, 1, 5, 1, 0, 3, 0),
(82, '5f47b2c523fb8', '', 'Psychosocial Support Services to Typhoon Pablo affected communities of Veruela, Agusan del Sur', '', '<p><br data-cke-filler=\"true\"></p>', 'psychosocial-support-services-to-typhoon-pablo-affected-communities-of-veruela-agusan-del-sur', '2020-08-27 08:19:13', 1, 1, 5, 1, 0, 5, 0),
(83, '5f47b2dbe0d0e', '', 'Typhoon Pablo Disaster Response: Support to Indigenous Peoples Livelihood Recovery', '', '<p><br data-cke-filler=\"true\"></p>', 'typhoon-pablo-disaster-response-support-to-indigenous-peoples-livelihood-recovery', '2020-08-27 08:19:27', 1, 1, 5, 1, 0, 5, 0),
(84, '5f47b2ee6995a', '', 'Planning Workshop: Disaster Risk Reduction and Management Plan of the Caraga State University (CSU)', '', '<p><br data-cke-filler=\"true\"></p>', 'planning-workshop-disaster-risk-reduction-and-management-plan-of-the-caraga-state-university-csu', '2020-08-27 08:19:45', 1, 1, 5, 1, 0, 5, 0),
(85, '5f47b2f9956aa', '', 'Formulation of Child-Focused Community-based Disaster Risk Reduction and Management Plan of Twenty (2) USAD Barangays in the province of Agusan del Sur.', '', '<p><br data-cke-filler=\"true\"></p>', 'formulation-of-child-focused-community-based-disaster-risk-reduction-and-management-plan-of-twenty-2-usad-barangays-in-the-province-of-agusan-del-sur', '2020-08-27 08:19:58', 1, 1, 5, 1, 0, 5, 0),
(86, '5f47b30620740', '', 'Promote the LGU’s Good Inclusive Governance and Resilience in Natural Disasters in the Municipality of Sta. Josefa, Agusan del Sur', '', '<p><br data-cke-filler=\"true\"></p>', 'promote-the-lgus-good-inclusive-governance-and-resilience-in-natural-disasters-in-the-municipality-of-sta-josefa-agusan-del-sur', '2020-08-27 08:20:11', 1, 1, 5, 1, 0, 5, 0),
(87, '5f47b318c9141', '', 'Promote the LGU’s Good Governance and the Construction of Resilient Communities especially in DRRM in the municipalities of Bicol and Caraga Region', '', '<p><br data-cke-filler=\"true\"></p>', 'promote-the-lgus-good-governance-and-the-construction-of-resilient-communities-especially-in-drrm-in-the-municipalities-of-bicol-and-caraga-region', '2020-08-27 08:20:27', 1, 1, 5, 1, 0, 5, 0),
(88, '5f4c6698b9414', 'https://sikap.org/filemanager/NEWS/news_1598842668.jpg', 'SIKAP Updates Its Operations Manual', '', '<p style=\"text-align: justify;\">In its desire to be an efficient and effective organization, SIKAP devoted time and resources for the Review and Enhancement of its Manual of Operations. Facilitated by Dr. Rex T. Linao via Zoom from Davao City, the activity was conducted on June 17-20 &amp; 25, 2020 at Mabe&rsquo;s Savory Place, Barangay 1, San Francisco, Agusan del Sur. The activity was conducted under Pillar 2 - Organizational Strengthening of the Sexual Health and Empowerment (SHE) Project that is supported by OXFAM and funded by Global Affairs Canada.</p>\n<p>The activity was instrumental in the formulation of two (2) manuals, both necessary for SIKAP&rsquo;s existence, namely:</p>\n<ol>\n<li><img style=\"text-align: justify; float: right;\" src=\"../../../filemanager/NEWS/news_3.jpg\" width=\"448\" height=\"196\" />Financial Management Manual, and</li>\n<li>Operations Manual</li>\n</ol>\n<p style=\"text-align: justify;\">New inclusions in the updated Operations Manual of SIKAP are the programs on Disaster Risk Reduction and Climate Change Adaptation and Sexual Reproductive Health and Rights (SRHR).&nbsp; &nbsp;</p>\n<p>Also forming part of the Operations Manual are the following:</p>\n<ol>\n<li>a) Child Protection Policy;</li>\n<li>b) Data Privacy Policy; and</li>\n<li>c) Policy on Protection from Sexual Exploitation and Abuse (PSEA).</li>\n</ol>', 'sikap-updates-its-operations-manual', '2020-08-30 21:55:58', 1, 1, 1, 1, 0, 0, 0),
(89, '5f4db50691314', 'https://sikap.org/filemanager/NEWS/news_1598755090.jpg', 'SIKAP Conducts Training-Workshops on Performance Accountability System', '', '<div style=\"text-align: justify;\">In order to build more the capacity of its staff, SIKAP conducted Training-Workshops on Performance Accountability System (PAS) on August 3-5, 2020 at Mabe&rsquo;s Savory Place, San Francisco, Agusan del Sur. Conducted under the organization&rsquo;s Sexual Health and Empowerment (SHE) project, the activity was instrumental in improving the knowledge and skills of SIKAP staff on the subject matter.&nbsp; &nbsp;<br /><br /></div>\n<div style=\"text-align: justify;\">PAS, which was developed by the World Health Organization (WHO, is a tested and proven tool in effecting strategic improvements in the health conditions of communities. It fosters a culture of performance and participation through mutual and collective accountability. It is a systems approach to decrease unmet needs or increase Contraceptive Prevalence Rate (CPR). It establishes a culture of care and respect for men, women and children; thus gradually eradicating gender-based violence. &nbsp; &nbsp;<br /><br /></div>\n<div style=\"text-align: justify;\">The facilitator, Mr. Earl Enrico A. Alcala, managed to impress the salient features of the PAS approach to the participants, as summarized below.<br /><br /></div>\n<div style=\"text-align: justify;\">One of the major activities in the PAS approach is the Breakthrough Planning. A breakthrough is defined as &lsquo;an important discovery that helps solve a problem&rsquo;. In the medical field, &lsquo;breakthroughs&rsquo; are usually associated with the discovery of a new drug or technology that treats or diagnoses diseases. However, used in the context of current projects of SIKAP on sexual reproductive health, a &lsquo;breakthrough&rsquo; refers to the transformative process of health planning that can enhance health governance, mobilize communities and improve performance of family planning program. &nbsp;<br /><br /></div>\n<div style=\"text-align: justify;\">Breakthrough Planning is a process that is evidence-based and involves barangay-level participation in identifying problems and solutions. It focuses on the inputs and processes through which the outputs or outcomes are to be achieved, and identifies who is responsible for them. Hence, it fosters greater accountability and better achievement of results. These features make breakthrough plans significantly different from the usual formulated health plans. The plan is usually formulated for a period of three to four months and is repeated over and over until a breakthrough result is achieved. It begins as a small step that can help communities break out of the cycle of low performance and poor health outcomes and gradually moves them towards bigger changes.<br /><br />SIKAP thanks OXFAM and Global Affairs Canada, the funder of SHE Project for the learning opportunity.</div>', 'sikap-conducts-training-workshops-on-performance-accountability-system', '2020-08-31 21:42:29', 1, 1, 1, 1, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `t_posts_type`
--

CREATE TABLE `t_posts_type` (
  `lid` int(11) NOT NULL,
  `description` varchar(50) NOT NULL,
  `url` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_posts_type`
--

INSERT INTO `t_posts_type` (`lid`, `description`, `url`) VALUES
(1, 'News and Updates', 'news'),
(2, 'Announcements', 'announcements'),
(3, 'Accreditation and Membership', 'accreditations'),
(4, 'Awards', 'awards'),
(5, 'Programs', 'programs'),
(6, 'Gallery', 'gallery'),
(7, 'Slider', 'slider');

-- --------------------------------------------------------

--
-- Table structure for table `t_programs_category`
--

CREATE TABLE `t_programs_category` (
  `id` int(11) NOT NULL,
  `description` varchar(100) NOT NULL,
  `url` varchar(100) NOT NULL,
  `style` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_programs_category`
--

INSERT INTO `t_programs_category` (`id`, `description`, `url`, `style`) VALUES
(1, 'Women, Children & Family Development', 'women-children-and-family-development', '    border-bottom: 5px solid violet; padding: 5px 10px; margin-top: 20px;'),
(2, 'Indigenous Peoples Development', 'indigenous-peoples-development', '    border-bottom: 5px solid red; padding: 5px 10px; margin-top: 20px;'),
(3, 'Good Local Governance', 'good-local-governance', '    border-bottom: 5px solid blue; padding: 5px 10px; margin-top: 20px;'),
(4, 'Rural Livelihood & Enterprise Development', 'rural-livelihood-and-enterprise-development', '    border-bottom: 5px solid green; padding: 5px 10px; margin-top: 20px;'),
(5, 'Disaster Risk Reduction/Climate Change Adaptation', 'disaster-risk-reduction-climate-change-adaptation', '    border-bottom: 5px solid orange; padding: 5px 10px; margin-top: 20px;');

-- --------------------------------------------------------

--
-- Table structure for table `t_roles`
--

CREATE TABLE `t_roles` (
  `id` int(11) NOT NULL,
  `description` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_roles`
--

INSERT INTO `t_roles` (`id`, `description`) VALUES
(1, 'Administrator'),
(2, 'Editor'),
(3, 'Author');

-- --------------------------------------------------------

--
-- Table structure for table `t_settings`
--

CREATE TABLE `t_settings` (
  `id` int(11) NOT NULL,
  `description` varchar(50) NOT NULL,
  `key_word` varchar(20) NOT NULL,
  `value` text NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_settings`
--

INSERT INTO `t_settings` (`id`, `description`, `key_word`, `value`, `date`) VALUES
(1, 'Site Name', 'site_name', 'SIKAP, Inc.', '2020-03-22 00:00:00'),
(2, 'Description', 'site_desc', 'Sibog Katawhan Alang Sa Paglambo (SIKAP), Inc. was born in 2006 out of genuine aspiration of its founding partners for transformative and genuinely sustainable community development work. The professed aspiration was borne out of founding partners’ first-hand knowledge of and actual experiences working with vulnerable communities as the latter demonstrated their desire for respectable and improved quality of living.', '2020-03-22 00:00:00'),
(3, 'Tags', 'site_tags', '', '2020-03-22 00:00:00'),
(4, 'Logo', 'site_logo', 'logo.webp', '2020-03-22 00:00:00'),
(5, 'Favicon', 'site_favicon', 'logo.png', '2020-03-22 00:00:00'),
(6, 'About', 'site_about', 'The development of this website was made possible through the capacity-building support for SIKAP under the Pillar 2 of the Sexual Health and Empowerment (SHE) program that is funded by Oxfam and Global Affairs Canada.', '2020-03-22 00:00:00'),
(7, 'Address', 'address', 'Door 3, 4 & 5, Pulvera Apartment, Brgy. 5, San Francisco, Agusan del Sur.', '2020-03-22 00:00:00'),
(8, 'Contact No.', 'contactno', '09465255166', '2020-03-22 00:00:00'),
(9, 'Email', 'email', 'email@sikap.org', '2020-03-22 00:00:00'),
(10, 'Facebook', 'facebook', '', '2020-03-22 00:00:00'),
(11, 'Twitter', 'twitter', '', '2020-03-22 00:00:00'),
(12, 'LinkedIn', 'linkedin', '', '2020-03-22 00:00:00'),
(13, 'Instagram', 'instagram', '', '0000-00-00 00:00:00'),
(14, 'Youtube', 'youtube', '', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `t_templates`
--

CREATE TABLE `t_templates` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `html` text NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_templates`
--

INSERT INTO `t_templates` (`id`, `name`, `html`, `date`, `userid`) VALUES
(1, 'banner', '<div class=\"page-header\" style=\"background: url(\'<?=$banner?>\'); background-size: cover;\">\r\n    <div class=\"container\">\r\n        <div class=\"row\">\r\n            <div class=\"col-12\">\r\n                <h1><?=ucwords(str_replace(\'-\', \' \', $url))?></h1>\r\n            </div>\r\n        </div>\r\n    </div>\r\n</div>\r\n\r\n<div class=\"welcome-wrap\">\r\n    <div class=\"container\">\r\n        <div class=\"row mt-5 mb-5\">\r\n        <div class=\"col-md-12\">\r\n                <div class=\"section-heading\">\r\n                  \r\n                </div>\r\n            </div>\r\n        </div>\r\n    </div>\r\n</div>', '2020-08-29 18:49:20', 0);

-- --------------------------------------------------------

--
-- Table structure for table `t_themes`
--

CREATE TABLE `t_themes` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `path` varchar(255) NOT NULL,
  `folder` varchar(50) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `isactive` int(11) NOT NULL,
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_themes`
--

INSERT INTO `t_themes` (`id`, `name`, `path`, `folder`, `date`, `isactive`, `userid`) VALUES
(1, 'sikap.org', 'themes/sikap.org/', 'sikap.org', '2020-03-19 19:31:22', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `t_users`
--

CREATE TABLE `t_users` (
  `id` int(6) UNSIGNED NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(20) NOT NULL,
  `role` int(11) NOT NULL,
  `lname` text NOT NULL,
  `fname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `bio` text NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_active` int(11) NOT NULL DEFAULT '1',
  `photo` varchar(100) NOT NULL,
  `pages` varchar(100) NOT NULL,
  `contactno` varchar(20) NOT NULL,
  `FBID` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_users`
--

INSERT INTO `t_users` (`id`, `username`, `password`, `salt`, `role`, `lname`, `fname`, `email`, `bio`, `date`, `is_active`, `photo`, `pages`, `contactno`, `FBID`) VALUES
(1, 'admin', '49b2420912bbecfb975fa48b1205aff5', 'imTJdwu80rO9PFcbZMHY', 1, 'Admin', 'System', 'sample@gmail.com', 'about me', '2019-12-26 08:53:39', 1, '1.png', '', '123', ''),
(2, 'tests', '133b77213204ce69b915f302b9edeb48', 'yBLcodnJp890EjGFXI2K', 1, 'user', 'tests', 'tests@gmail.com', '', '2020-08-29 23:06:53', 1, '2.jpg', '', '1231231', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `t_access`
--
ALTER TABLE `t_access`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_access_rights`
--
ALTER TABLE `t_access_rights`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_avatar`
--
ALTER TABLE `t_avatar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_comments`
--
ALTER TABLE `t_comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_contactus`
--
ALTER TABLE `t_contactus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_flash`
--
ALTER TABLE `t_flash`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_months`
--
ALTER TABLE `t_months`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_pages`
--
ALTER TABLE `t_pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_posts`
--
ALTER TABLE `t_posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_posts_type`
--
ALTER TABLE `t_posts_type`
  ADD PRIMARY KEY (`lid`);

--
-- Indexes for table `t_programs_category`
--
ALTER TABLE `t_programs_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_roles`
--
ALTER TABLE `t_roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_settings`
--
ALTER TABLE `t_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_templates`
--
ALTER TABLE `t_templates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_themes`
--
ALTER TABLE `t_themes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_users`
--
ALTER TABLE `t_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `t_access`
--
ALTER TABLE `t_access`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `t_access_rights`
--
ALTER TABLE `t_access_rights`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `t_avatar`
--
ALTER TABLE `t_avatar`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t_comments`
--
ALTER TABLE `t_comments`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t_contactus`
--
ALTER TABLE `t_contactus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t_flash`
--
ALTER TABLE `t_flash`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t_months`
--
ALTER TABLE `t_months`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `t_pages`
--
ALTER TABLE `t_pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `t_posts`
--
ALTER TABLE `t_posts`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT for table `t_posts_type`
--
ALTER TABLE `t_posts_type`
  MODIFY `lid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `t_programs_category`
--
ALTER TABLE `t_programs_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `t_roles`
--
ALTER TABLE `t_roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `t_settings`
--
ALTER TABLE `t_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `t_templates`
--
ALTER TABLE `t_templates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `t_themes`
--
ALTER TABLE `t_themes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `t_users`
--
ALTER TABLE `t_users`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
