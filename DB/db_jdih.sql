-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.7.18-log - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL Version:             9.4.0.5174
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table db_jdih.auth_acl
DROP TABLE IF EXISTS `auth_acl`;
CREATE TABLE IF NOT EXISTS `auth_acl` (
  `ai` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `action_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`ai`),
  KEY `action_id` (`action_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `auth_acl_ibfk_1` FOREIGN KEY (`action_id`) REFERENCES `auth_acl_actions` (`action_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table db_jdih.auth_acl: ~0 rows (approximately)
/*!40000 ALTER TABLE `auth_acl` DISABLE KEYS */;
/*!40000 ALTER TABLE `auth_acl` ENABLE KEYS */;

-- Dumping structure for table db_jdih.auth_acl_actions
DROP TABLE IF EXISTS `auth_acl_actions`;
CREATE TABLE IF NOT EXISTS `auth_acl_actions` (
  `action_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `action_code` varchar(100) NOT NULL COMMENT 'No periods allowed!',
  `action_desc` varchar(100) NOT NULL COMMENT 'Human readable description',
  `category_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`action_id`),
  KEY `category_id` (`category_id`),
  CONSTRAINT `auth_acl_actions_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `auth_acl_categories` (`category_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table db_jdih.auth_acl_actions: ~0 rows (approximately)
/*!40000 ALTER TABLE `auth_acl_actions` DISABLE KEYS */;
/*!40000 ALTER TABLE `auth_acl_actions` ENABLE KEYS */;

-- Dumping structure for table db_jdih.auth_acl_categories
DROP TABLE IF EXISTS `auth_acl_categories`;
CREATE TABLE IF NOT EXISTS `auth_acl_categories` (
  `category_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category_code` varchar(100) NOT NULL COMMENT 'No periods allowed!',
  `category_desc` varchar(100) NOT NULL COMMENT 'Human readable description',
  PRIMARY KEY (`category_id`),
  UNIQUE KEY `category_code` (`category_code`),
  UNIQUE KEY `category_desc` (`category_desc`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table db_jdih.auth_acl_categories: ~0 rows (approximately)
/*!40000 ALTER TABLE `auth_acl_categories` DISABLE KEYS */;
/*!40000 ALTER TABLE `auth_acl_categories` ENABLE KEYS */;

-- Dumping structure for table db_jdih.auth_ci_sessions
DROP TABLE IF EXISTS `auth_ci_sessions`;
CREATE TABLE IF NOT EXISTS `auth_ci_sessions` (
  `id` varchar(128) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) unsigned NOT NULL DEFAULT '0',
  `data` blob NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ci_sessions_timestamp` (`timestamp`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- Dumping data for table db_jdih.auth_ci_sessions: 0 rows
/*!40000 ALTER TABLE `auth_ci_sessions` DISABLE KEYS */;
/*!40000 ALTER TABLE `auth_ci_sessions` ENABLE KEYS */;

-- Dumping structure for table db_jdih.auth_denied_access
DROP TABLE IF EXISTS `auth_denied_access`;
CREATE TABLE IF NOT EXISTS `auth_denied_access` (
  `ai` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(45) NOT NULL,
  `time` datetime NOT NULL,
  `reason_code` tinyint(1) unsigned DEFAULT '0',
  PRIMARY KEY (`ai`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Dumping data for table db_jdih.auth_denied_access: 0 rows
/*!40000 ALTER TABLE `auth_denied_access` DISABLE KEYS */;
/*!40000 ALTER TABLE `auth_denied_access` ENABLE KEYS */;

-- Dumping structure for table db_jdih.auth_ips_on_hold
DROP TABLE IF EXISTS `auth_ips_on_hold`;
CREATE TABLE IF NOT EXISTS `auth_ips_on_hold` (
  `ai` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(45) NOT NULL,
  `time` datetime NOT NULL,
  PRIMARY KEY (`ai`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

-- Dumping data for table db_jdih.auth_ips_on_hold: 0 rows
/*!40000 ALTER TABLE `auth_ips_on_hold` DISABLE KEYS */;
/*!40000 ALTER TABLE `auth_ips_on_hold` ENABLE KEYS */;

-- Dumping structure for table db_jdih.auth_login_errors
DROP TABLE IF EXISTS `auth_login_errors`;
CREATE TABLE IF NOT EXISTS `auth_login_errors` (
  `ai` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username_or_email` varchar(255) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `time` datetime NOT NULL,
  PRIMARY KEY (`ai`)
) ENGINE=MyISAM AUTO_INCREMENT=347 DEFAULT CHARSET=utf8;

-- Dumping data for table db_jdih.auth_login_errors: 1 rows
/*!40000 ALTER TABLE `auth_login_errors` DISABLE KEYS */;
INSERT INTO `auth_login_errors` (`ai`, `username_or_email`, `ip_address`, `time`) VALUES
	(346, 'admin', '::1', '2017-11-30 23:57:56');
/*!40000 ALTER TABLE `auth_login_errors` ENABLE KEYS */;

-- Dumping structure for table db_jdih.auth_sessions
DROP TABLE IF EXISTS `auth_sessions`;
CREATE TABLE IF NOT EXISTS `auth_sessions` (
  `id` varchar(128) NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `login_time` datetime DEFAULT NULL,
  `modified_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ip_address` varchar(45) NOT NULL,
  `user_agent` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Dumping data for table db_jdih.auth_sessions: 28 rows
/*!40000 ALTER TABLE `auth_sessions` DISABLE KEYS */;
INSERT INTO `auth_sessions` (`id`, `user_id`, `login_time`, `modified_at`, `ip_address`, `user_agent`) VALUES
	('03c10e69b3754f3a05c93cf1858672f973a85603', 1, '2017-10-31 12:41:01', '2017-10-31 22:26:53', '::1', 'Chrome 61.0.3163.100 on Windows 10'),
	('9313799c7fc7424bc7df9ce10d301a2adfd2b4e1', 1, '2017-11-01 05:35:55', '2017-11-01 13:14:55', '::1', 'Chrome 61.0.3163.100 on Windows 10'),
	('6a921d303af84c8752e50d252cf127b87827575e', 1, '2017-11-03 01:09:04', '2017-11-03 15:39:13', '::1', 'Chrome 61.0.3163.100 on Windows 10'),
	('189854d4504fb0681948dcdc0c24fd91876749f7', 1, '2017-11-03 13:01:25', '2017-11-03 20:44:48', '::1', 'Chrome 61.0.3163.100 on Windows 10'),
	('32ccb8404b9f8aa95e5892ece007886d82d3b1c9', 1, '2017-11-03 14:59:43', '2017-11-03 22:58:06', '::1', 'Chrome 61.0.3163.100 on Windows 10'),
	('cd28945cdfb6c74b998eb34818bf722b62dbb494', 1, '2017-11-04 00:38:19', '2017-11-04 10:59:09', '::1', 'Chrome 61.0.3163.100 on Windows 10'),
	('8666c083f26309882b1c8d0bf38fa8f134bb7884', 1, '2017-11-04 10:32:37', '2017-11-04 19:47:32', '::1', 'Chrome 61.0.3163.100 on Windows 10'),
	('cc51d82b13d6ee17005df323508aebed27687978', 1, '2017-11-12 13:24:45', '2017-11-12 21:34:36', '::1', 'Chrome 61.0.3163.100 on Windows 10'),
	('bba08bd480216836debd142b3917dfddd0117f75', 1, '2017-11-13 01:13:23', '2017-11-13 08:36:20', '::1', 'Chrome 61.0.3163.100 on Windows 10'),
	('3cd71740f304b05ddbe67633cddd839a13a80b19', 1, '2017-11-13 05:40:22', '2017-11-13 13:08:09', '::1', 'Chrome 61.0.3163.100 on Windows 10'),
	('161790dd9ccf948b56dbf4ddf8bd0a9c6ecb5778', 1, '2017-11-14 00:23:33', '2017-11-14 10:39:26', '::1', 'Chrome 61.0.3163.100 on Windows 10'),
	('97c74baa1bf2a475ce3387fcaaab63c6a701e6ce', 1, '2017-11-15 00:10:43', '2017-11-15 07:25:01', '::1', 'Chrome 62.0.3202.94 on Windows 10'),
	('04e49ebcceded4f2d06b3ac6a7687a609a1d7cec', 1, '2017-11-16 00:23:46', '2017-11-16 09:13:53', '::1', 'Chrome 62.0.3202.94 on Windows 10'),
	('8b9e2d407d0f440cc0e11e286a609145206f0ac5', 1, '2017-11-16 07:06:04', '2017-11-16 15:57:46', '::1', 'Chrome 62.0.3202.94 on Windows 10'),
	('9ef47bf36489e31be75ea633df527c8070d02f25', 1, '2017-11-17 01:33:03', '2017-11-17 14:39:19', '::1', 'Chrome 62.0.3202.94 on Windows 10'),
	('2104b87bf6e869b2eef42e10fcb615cc842a9c32', 1, '2017-11-18 10:13:48', '2017-11-18 20:10:06', '::1', 'Chrome 62.0.3202.94 on Windows 10'),
	('8c7872a6de6bc2e8fc3fea8490c0c41227079a0c', 1, '2017-11-18 15:53:25', '2017-11-18 23:03:54', '::1', 'Chrome 62.0.3202.94 on Windows 10'),
	('def00e2f1857aac4ae8c822b33cd5d3423c33535', 4, '2017-11-19 13:26:38', '2017-11-19 20:26:38', '::1', 'Chrome 62.0.3202.94 on Windows 10'),
	('3003ea28248e782b46c94db65785d5cc35b4a70c', 3, '2017-11-19 14:29:10', '2017-11-19 21:34:23', '::1', 'Chrome 62.0.3202.94 on Windows 10'),
	('703af815eac5cb1f6fb5611e45168b198c5696ed', 3, '2017-11-19 15:04:29', '2017-11-19 22:04:29', '::1', 'Chrome 62.0.3202.94 on Windows 10'),
	('617dfdd31c3e0d93c118f15df3c3eb4c4949e774', 1, '2017-11-20 11:59:42', '2017-11-20 18:59:42', '::1', 'Chrome 62.0.3202.94 on Windows 10'),
	('6be5523593f3a2de013355e8a9963873dcb47eca', 4, '2017-11-25 02:47:27', '2017-11-25 09:52:33', '::1', 'Chrome 62.0.3202.94 on Windows 10'),
	('032a57d857534052de84eeddc3f431d75eb4addb', 1, '2017-11-25 02:52:37', '2017-11-25 09:52:37', '::1', 'Chrome 62.0.3202.94 on Windows 10'),
	('607ed59a2d45a67c12608e3c84e55dfc7be88e54', 1, '2017-11-28 07:55:04', '2017-11-28 14:55:04', '::1', 'Chrome 62.0.3202.94 on Windows 10'),
	('909096004582508cb834354dbd059933698a05d1', 1, '2017-11-30 13:50:14', '2017-11-30 21:27:00', '::1', 'Chrome 62.0.3202.94 on Windows 10'),
	('4482bc9a500cf146638d629f0149198375a1eb64', 1, '2017-11-30 22:45:59', '2017-12-01 06:05:46', '::1', 'Chrome 62.0.3202.94 on Windows 10'),
	('36c15819ae66db1a8da4818a86cda7ed971efa6d', 1, '2017-11-30 23:29:29', '2017-12-01 06:41:08', '::1', 'Chrome 62.0.3202.94 on Windows 10'),
	('3588ea48e94dcd71c2befa89e0b9b0ed95e606f9', 1, '2017-12-03 09:02:03', '2017-12-03 17:24:54', '::1', 'Chrome 62.0.3202.94 on Windows 10');
/*!40000 ALTER TABLE `auth_sessions` ENABLE KEYS */;

-- Dumping structure for table db_jdih.auth_username_or_email_on_hold
DROP TABLE IF EXISTS `auth_username_or_email_on_hold`;
CREATE TABLE IF NOT EXISTS `auth_username_or_email_on_hold` (
  `ai` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username_or_email` varchar(255) NOT NULL,
  `time` datetime NOT NULL,
  PRIMARY KEY (`ai`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

-- Dumping data for table db_jdih.auth_username_or_email_on_hold: 0 rows
/*!40000 ALTER TABLE `auth_username_or_email_on_hold` DISABLE KEYS */;
/*!40000 ALTER TABLE `auth_username_or_email_on_hold` ENABLE KEYS */;

-- Dumping structure for table db_jdih.auth_users
DROP TABLE IF EXISTS `auth_users`;
CREATE TABLE IF NOT EXISTS `auth_users` (
  `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `nickname` varchar(255) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `biro` varchar(255) NOT NULL,
  `usertelpno` varchar(255) NOT NULL,
  `auth_level` tinyint(3) unsigned NOT NULL,
  `banned` enum('0','1') NOT NULL DEFAULT '0',
  `passwd` varchar(60) NOT NULL,
  `passwd_recovery_code` varchar(60) DEFAULT NULL,
  `passwd_recovery_date` datetime DEFAULT NULL,
  `passwd_modified_at` datetime DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- Dumping data for table db_jdih.auth_users: ~6 rows (approximately)
/*!40000 ALTER TABLE `auth_users` DISABLE KEYS */;
INSERT INTO `auth_users` (`user_id`, `username`, `email`, `nickname`, `fullname`, `biro`, `usertelpno`, `auth_level`, `banned`, `passwd`, `passwd_recovery_code`, `passwd_recovery_date`, `passwd_modified_at`, `last_login`, `created_at`, `modified_at`) VALUES
	(1, 'admin', 'admin@email.com', 'Admin', 'Administrator', 'Administrator', '123', 1, '0', '$2y$11$QWPPd1uMDbdVPlAMDlga5OZsP9oVeIr59NQJVR2Ki2rftFWgUCfJu', NULL, NULL, '2017-11-30 00:00:00', '2017-12-03 09:02:03', '2017-10-28 08:06:14', '2017-12-03 16:02:03'),
	(2, 'rekrutmen_hakim', 'rekrutmen_hakim@email.com', 'Biro Rekrutmen Hakim', 'Biro Rekrutmen Hakim', 'Biro Rekrutmen Hakim', '', 2, '0', '$2y$11$UhleYt18KPaf7yxSpL40Tu3zSRtof6KGjM.iRTvDjcDB.VbhXVTQK', NULL, NULL, NULL, NULL, '2017-11-19 00:00:00', '2017-11-19 20:05:32'),
	(3, 'pengawasan_hakim', 'pengawasan_hakim@gmail.com', 'Biro Pengawasan Hakim', 'Biro Pengawasan Hakim', 'Biro Pengawasan Hakim', '', 2, '0', '$2y$11$oR/kGsGU586ojY0yxcf9MOCe4CgtoT4vjAq1FUZ2V6BIv6k3DvjQe', NULL, NULL, NULL, '2017-11-19 15:04:29', '2017-11-19 00:00:00', '2017-11-19 22:04:29'),
	(4, 'umum', 'umum@gmail.com', 'Biro Umum', 'Biro Umum', 'Biro Umum', '', 2, '0', '$2y$11$C2i38HBlpQFuZzyVSc2OHegPxZHSjm5wJ3/7Io8DvoW9XgRrQNTUW', NULL, NULL, NULL, '2017-11-25 02:47:27', '2017-11-19 00:00:00', '2017-11-25 09:47:27'),
	(5, 'analis', 'analis@gmail.com', 'Pusat Analisis dan Layanan Informasi', 'Pusat Analisis dan Layanan Informasi', 'Pusat Analisis dan Layanan Informasi', '', 2, '0', '$2y$11$EOf8Yd.KBGUsTz/hiEe1X.fRvmH7RSJ89WczNEqhvlHmbsmyUEdNy', NULL, NULL, NULL, NULL, '2017-11-19 00:00:00', '2017-11-19 20:07:41'),
	(6, 'investigasi', 'investigasi@gmail.com', 'Biro Investigasi', 'Biro Investigasi', 'Biro Investigasi', '', 2, '0', '$2y$11$bbQYea1c/QIYHeR1z/tftecJ.4pshHR0M.eVVZqTXuET./VtuU4Ry', NULL, NULL, NULL, NULL, '2017-11-19 00:00:00', '2017-11-19 20:08:19'),
	(7, 'perencanaan', 'perencanaan@gmail.com', 'Biro Perencanaan dan Kepatuhan Internal', 'Biro Perencanaan dan Kepatuhan Internal', 'Biro Perencanaan dan Kepatuhan Internal', '', 2, '0', '$2y$11$1QUbc/DSq.4iQztTgRaS0ud6SXEWMn7VlSg6fxY0O7ZYFfrQhCjRe', NULL, NULL, NULL, NULL, '2017-11-19 00:00:00', '2017-11-19 20:09:00');
/*!40000 ALTER TABLE `auth_users` ENABLE KEYS */;

-- Dumping structure for table db_jdih.hubungi_kami
DROP TABLE IF EXISTS `hubungi_kami`;
CREATE TABLE IF NOT EXISTS `hubungi_kami` (
  `recid` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subjek` varchar(255) NOT NULL,
  `pesan` text NOT NULL,
  `dateinput` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`recid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Dumping data for table db_jdih.hubungi_kami: ~0 rows (approximately)
/*!40000 ALTER TABLE `hubungi_kami` DISABLE KEYS */;
INSERT INTO `hubungi_kami` (`recid`, `nama`, `email`, `subjek`, `pesan`, `dateinput`) VALUES
	(1, 'selametsubu', 'selametsubu@gmail.com', 'test', 'ttest', '2017-11-04 19:02:53');
/*!40000 ALTER TABLE `hubungi_kami` ENABLE KEYS */;

-- Dumping structure for table db_jdih.konten_statis
DROP TABLE IF EXISTS `konten_statis`;
CREATE TABLE IF NOT EXISTS `konten_statis` (
  `recid` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `isi` text NOT NULL,
  `id_gambar` int(11) DEFAULT NULL,
  `id_dokumen` int(11) DEFAULT NULL,
  `dateinput` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `dateupdate` date NOT NULL,
  `userinput` varchar(50) NOT NULL,
  `userupdate` varchar(50) NOT NULL,
  PRIMARY KEY (`recid`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- Dumping data for table db_jdih.konten_statis: ~5 rows (approximately)
/*!40000 ALTER TABLE `konten_statis` DISABLE KEYS */;
INSERT INTO `konten_statis` (`recid`, `nama`, `judul`, `isi`, `id_gambar`, `id_dokumen`, `dateinput`, `dateupdate`, `userinput`, `userupdate`) VALUES
	(2, 'sekilas_jdih', 'Sekilas JDIH', 'Jaringan Dokumentasi dan Informasi Hukum (JDIH) Nasional sebagaimana yang dimaksud dalam Pasal 1 Peraturan Presiden Nomor 33 tahun 2012 adalah:<div><div><br><b>"Wadah pendayagunaan bersama atas dokumen hukum secara tertib, terpadu, dan berkesinambungan, serta merupakan sarana pemberian pelayanan informasi hukum secara lengkap, akurat, mudah dan cepat"</b><br><br></div></div>Berkembangnya suatu zaman ditandai dengan kemudahan setiap individu (publik) dalam memperoleh sesuatu yang diinginkan atau dibutuhkannya, dan kebutuhan akan sebuah informasi menjadi suatu keharusan yang mesti dipenuhi. Terlebih lagi di era reformasi keberadaan Informasi di bidang hukum menjadi sesuatu yang dibutuhkan, mengingat nilai-nilai normatif dalam suatu aturan hukum dijadikan acuan dalam menjalankan aktivitasnya, selain itu proses penanganan hukum yang transparan terhadap kasus-kasus yang menjadi sorotan publik mendapat perhatian penuh dari masyarakat luas yang ingin mengetahuinya.Keberadaan sebuah wadah yang dapat menyajikan informasi mengenai kasus-kasus hukum dan data produk hukum yang berlaku yang selalu di up-date menjadi sesuatu yang dibutuhkan. Dokumentasi terhadap sebuah produk hukum dalam institusi pemerintah menjadi kewenangan Kementerian Hukum dan HAM, akan tetapi informasi mengenai pemberitaan informasi hukum dapat dilakukan oleh institusi yang lain, sehingga antar institusi pemerintah saling terintegrasi dalam memberikan informasi hukum yang realibility.<h3>Sejarah Singkat Jaringan Dokumentasi dan Informasi Hukum (JDIH) Nasional</h3>Keberadaan dokumentasi dan perpustakaan hukum yang baik merupakan syarat mutlak untuk membina hukum di Indonesia, inilah yang menjadi pemikiran mengenai pentingnya keberadaan JDIH untuk pertama kali yang dikemukakan dalam Seminar Hukum Nasional III di Surabaya pada Tahun 1974. Seminar ini merekomendasikan “perlu adanya suatu kebijakan nasional untuk mulai menyusun suatu Sistem Jaringan Dokumentasi dan Informasi (SJDI) Hukum, agar dapat secepatnya berfungsi”. Hal ini didorong oleh keberadaan dokumentasi dan perpustakaan hukum di Indonesia yang masih dalam keadaan lemah dan kurang mendapat perhatian pada saat itu.Hasil dari seminar tersebut oleh Badan Pembinaan Hukum Nasional direspon dengan memprakarsai beberapa lokakarya, diantaranya dilaksanakan di Jakarta pada Tahun 1975, di Malang pada Tahun 1977 dan Pontianak pada Tahun 1977 dengan agenda pokok membahas kearah terwujudnya SJDIH serta menentukan program-program kegiatan yang dapat mendukung terwujudnya dan terlaksananya pemikiran yang dicetuskan pada tahun 1974.Pada Tahun 1978 dalam sebuah lokakarya yang diselenggarakan di Jakarta, menyepakati bahwa Pusat JDIH berskala nasional adalah Badan Pembinaan Hukum Nasional. Sedangkan yang menjadi anggotanya adalah Biro-biro hukum Departemen, LPND, Lembaga Tertinggi/Tinggi Negara (saat ini tidak ada lagi sebutan Lembaga Tertinggi), Pemerintah Daerah Tingkat I (berdasarkan UU 22/1999 kemudian dinyatakan tidak berlaku lagi oleh UU 32/2004 menjadi Pemerintah Provinsi). Namun, pada pelaksanaannya hanya berdasar pada kesepakatan bersama, dan belum ada landasan hukum yang mengikat.Saat itu dimulailah perjuangan dari instansi yang merasa telah siap, dengan melakukan gerakan maju, membentuk koordinasi struktur organisasi, menyusun perencanaan program kegiatan, mewujudkan sarana fisik, mengumpulkan koleksi peraturan, melatih dan mendidik sumber daya manusia berkaitan dengan dokumentasi dan informasi, serta menyusun anggaran untuk semua kegiatan diatas.Setelah kegiatan jaringan dokumentasi dan informasi hukum berjalan lebih dari dua puluh tahun, Pemerintah menerbitkan Keputusan (baca Peraturan) Presiden Nomor 91 Tahun 1999 (LN RI tahun 1999 No.135) tentang Jaringan Dokumentasi dan Informasi Hukum Nasional. Keputusan Presiden inilah yang kemudian merupakan landasan hukum untuk lebih memacu dan mengembangkan JDIH ke arah yang lebih baik, lebih maju untuk kepentingan bangsa dan negara.Dengan dikeluarkannya Keppres tersebut keanggotaan JDIH ditambah meliputi seluruh Pemerintah daerah Kabupaten/Kota; Pengadilan Tingkat Banding dan Tingkat Pertama; Pusat Dokumentasi pada Perguruan Tinggi di Indonesia; Lembaga-lembaga lain yang bergerak di bidang pengembangan dokumentasi dan informasi hukum yang ditetapkan oleh Menteri Kehakiman (baca Hukum dan HAM).Kebutuhan dalam mendukung penyelenggaraan jaringan dokumentasi dan informasi hukum nasional yang terpadu dan terintegrasi menuntut adanya penyesuaian terhadap Keppres No 91 Tahun 1999. Oleh karena itu, Kementerian Hukum dan HAM telah menerbitkan Peraturan Presiden Nomor 33 Tahun 2012 sebagai pengganti Keppres No 91 Tahun 1999.<span>Kegiatan JDIH dikondisikan dapat memberikan akses layanan publik dalam rangka menyebarluaskan informasi hukum dan data produk hukum secara mudah, cepat dan akurat dan kepada kalangan internal Lemsaneg maupun masyarakat umum. Selain itu diharapkan kepada pegawai Lemsaneg khususnya dapat memanfaatkan layanan tersebut ssecara optimal guna tercipta insan yang taat dan sadar terhadap hukum dan aturan yang berlaku.</span>', NULL, NULL, '2017-11-04 09:51:11', '0000-00-00', '1', ''),
	(3, 'tupoksi_jdih', 'Tupoksi JDIH', 'Landasan kerja untuk pelaksanaan dan pengolahan JDIH yang telah disusun oleh para pakar dokumentasi dan informasi hukum meliputi beberapa aspek, antara lain:<ul><li><span>Organisasi dan Metoda<br></span>tersedianya unit organisasi atau unit kerja yang mewadahi secara khusus tugas dan fungsi dokumentasi dan informasi hukum dengan berpedoman pada modul-modul kerja yang sudah dibaku-seragamkan untuk setiap jenis kegiatan pengelolaan JDIH.</li></ul><ul><li><span>Personalia dan Diklat<br></span>tersedianya personil yang menangani secara khusus kegiatan JDIH dan mengikuti bimbingan teknis pengelolaan JDIH secara manual maupun otomasi.</li></ul><ul><li><span>Koleksi dan Teknis<br></span>memiliki koleksi bahan dokumentasi hukum berupa peraturan perundang-undangan dan non-peraturan yang telah diolah menggunakan sistem temu kembali guna menyajikan layanan informasi hukum. Semakin lengkap koleksi yang dimiliki, semakin besar peluang untuk memberikan layanan informasi hukum yang diperlukan oleh publik, aparatur negara, kalangan akademisi dan profesi hukum lainnya serta masyarakat luas pada umumnya.</li></ul><ul><li><span>Sarana dan Prasarana<br></span>tersedianya ruangan yang memadai untuk ruang baca, ruang kerja dan ruang penyimpanan yang dilengkapi dengan prasarana yang cukup berupa furniture, mesin foto kopi, telepon, faksimili, komputer dll.</li></ul><ul><li><span>Mekanisme dan Otomasi<br></span>terciptanya tata kerja dan alur kerja yang tertib dalam setiap jenis kegiatan dan melakukan otomasi dengan memanfaatkan Teknologi Informasi dan Komunikasi sehingga tercapai efisiensi dan efektifitas kerja yang tinggi.</li></ul><h3>Fungsi Jaringan Dokumentasi dan Informasi Hukum Nasional</h3>Fungsi JDIH sebagaimana yang diatur dalam pasal 2 Keppres Nomor 91 Tahun 1999 tentang JDIH Nasional adalah :<ul><li>sebagai salah satu upaya penyediaan sarana pembangunan bidang hukum;</li><li>untuk meningkatkan penyebarluasan dan pemahaman pengetahuan hukum;</li><li>untuk memudahkan pencarian dan penelusuran peraturan perundang-undangan dan bahan dokumentasi lainnya;</li><li>untuk meningkatkan pemberian pelayanan pelaksanaan penegakan hukum dan kepastian hukum.</li></ul><h3>Tugas dan Fungsi Pusat Jaringan</h3>BPHN sebagai Pusat Jaringan mempunyai tugas melakukan pembinaan, pengembangan, pemantauan, dan pelayanan Sistem JDIH Nasional. Dalam rangka melaksanakan tugasnya, Pusat Jaringan menyelenggarakan fungsi:<ul><li>perumusan kebijaksanaan pengembangan dan pelayanan sistem Jaringan Dokumentasi dan Informasi Hukum Nasional.;</li><li>bertindak sebagai pusat rujukan informasi dan dokumentasi hukum nasional;</li><li>pengumpulan dan penyebarluasan bahan dokumentasi dan informasi hukum kepada para Anggota Jaringan, baik dalam bentuk salinan, abstraksi, panduan penemuan kembali, maupun bentuk lainnya;</li><li>pembinaan tenaga pengelola dokumentasi dan informasi hukum;</li><li>pembinaan kerja sama diantara Anggota Jaringan;</li><li>evaluasi secara berkala terhadap pelaksanaan Jaringan Dokumentasi dan Informasi Hukum;</li><li>pelayanan informasi dan dokumentasi hukum nasional kepada masyarakat.</li></ul>Dalam rangka melaksanakan fungsi JDIH Nasional, Anggota Jaringan menyelenggarakan:<ul><li>penyimpanan dan pengolahan dokumentasi peraturan perundang-undangan dan dokumentasi hukum lainnya yang ditetapkan atau dimiliki instansi, atau diterima dari Pusat jairngan;</li><li>penyampaian salinan peraturan perundang-undangan yang ditetapkan dan atau disahkan oleh Presiden, Menteri, Gubernur, Bupati, Walikota atau Pimpinan Instansi/Lembaga Pemerintah lainnya kepada Pusat Jaringan, dalam bentuk dan jumlah yang disepakati bersama;</li><li>penyediaan dan penyebarluasan informasi segala peraturan perundang-undangan yang tersedia dan dokumentasi hukum lainnya di lingkungan instansinya, dan masyarakat yang memerlukannya;</li><li>pengembangan tenaga pengelola dan sarana dokumentasi dan informasi hukum di lingkungan instansinya;</li><li>evaluasi secara berkala terhadap pengelolaan Jaringan Dokumentasi dan Informasi Hukum di lingkungannya dan menyampaikan hasil-hasilnya kepada Pusat Jaringan.</li></ul>', NULL, NULL, '2017-11-04 09:51:20', '0000-00-00', '1', ''),
	(4, 'struktur_organisasi_jdih', 'Struktur Organisasi JDIH', '<p><strong>Profil Pejabat Struktural Eselon 1 dan 2</strong></p>\n\n<p><strong>Sekretaris Jenderal Komisi Yudisial</strong></p>\n\n<table border="0" cellpadding="0" cellspacing="3" style="width:791px">\n	<tbody>\n		<tr>\n			<td style="width:263px">\n			<p><strong>Nama:</strong></p>\n			</td>\n			<td style="width:519px">\n			<p><strong>Danang Wijayanto, Ak., M.Si.</strong></p>\n			</td>\n		</tr>\n		<tr>\n			<td style="width:263px">\n			<p>NIP:</p>\n			</td>\n			<td style="width:519px">\n			<p>196204021982031001</p>\n			</td>\n		</tr>\n		<tr>\n			<td style="width:263px">\n			<p>Jabatan:</p>\n			</td>\n			<td style="width:519px">\n			<p>Sekretaris Jenderal</p>\n			</td>\n		</tr>\n		<tr>\n			<td style="width:263px">\n			<p>Golongan:</p>\n			</td>\n			<td style="width:519px">\n			<p>IV-D</p>\n			</td>\n		</tr>\n		<tr>\n			<td style="width:263px">\n			<p>Latar Belakang Pendidikan :</p>\n			</td>\n			<td style="width:519px">\n			<p>S2 &ndash; Magister Ekonomi Pembangunan</p>\n			</td>\n		</tr>\n		<tr>\n			<td style="width:263px">\n			<p>Jenis Kelamin:</p>\n			</td>\n			<td style="width:519px">\n			<p>Laki-laki</p>\n			</td>\n		</tr>\n		<tr>\n			<td style="width:263px">\n			<p>Tempat tgl lahir:</p>\n			</td>\n			<td style="width:519px">\n			<p>Yogyakarta, 2 April 1962</p>\n			</td>\n		</tr>\n		<tr>\n			<td style="width:263px">\n			<p>Nomor Telepon:</p>\n			</td>\n			<td style="width:519px">\n			<p>021 3905876/3905877</p>\n			</td>\n		</tr>\n		<tr>\n			<td style="width:263px">\n			<p>ALamat:</p>\n			</td>\n			<td style="width:519px">\n			<p>Jl. Kramat Raya No 57 Jakarta Pusat</p>\n			</td>\n		</tr>\n		<tr>\n			<td style="width:263px">\n			<p>Penghargaan yang didapat:</p>\n			</td>\n			<td style="width:519px">\n			<p>-</p>\n			</td>\n		</tr>\n	</tbody>\n</table>\n\n<p>&nbsp;</p>\n\n<table border="0" cellpadding="0" cellspacing="3" style="width:768px">\n	<tbody>\n		<tr>\n			<td style="width:258px">\n			<p><strong>Nama:</strong></p>\n			</td>\n			<td style="width:501px">\n			<p><strong>Ari Sudihar, S.H., M.Hum.</strong></p>\n			</td>\n		</tr>\n		<tr>\n			<td style="width:258px">\n			<p>NIP:</p>\n			</td>\n			<td style="width:501px">\n			<p>19710123 199603 1 003</p>\n			</td>\n		</tr>\n		<tr>\n			<td style="width:258px">\n			<p>Jabatan :</p>\n			</td>\n			<td style="width:501px">\n			<p>Kepala Biro Rekrutmen, Advokasi dan Peningkatan Kapasitas Hakim</p>\n			</td>\n		</tr>\n		<tr>\n			<td style="width:258px">\n			<p>Golongan:</p>\n			</td>\n			<td style="width:501px">\n			<p>IV/b</p>\n			</td>\n		</tr>\n		<tr>\n			<td style="width:258px">\n			<p>Latar Belakang Pendidikan&nbsp; :</p>\n			</td>\n			<td style="width:501px">\n			<p>S2</p>\n			</td>\n		</tr>\n		<tr>\n			<td style="width:258px">\n			<p>Jenis Kelamin:</p>\n			</td>\n			<td style="width:501px">\n			<p>Laki-laki</p>\n			</td>\n		</tr>\n		<tr>\n			<td style="width:258px">\n			<p>Tempat tgl lahir:</p>\n			</td>\n			<td style="width:501px">\n			<p>Jakarta, 23 Januari 1971</p>\n			</td>\n		</tr>\n		<tr>\n			<td style="width:258px">\n			<p>Nomor Telepon:</p>\n			</td>\n			<td style="width:501px">\n			<p>021 3905876/3905877</p>\n			</td>\n		</tr>\n		<tr>\n			<td style="width:258px">\n			<p>ALamat :</p>\n			</td>\n			<td style="width:501px">\n			<p>Jl. Kramat Raya No 57 Jakarta Pusat</p>\n			</td>\n		</tr>\n		<tr>\n			<td style="width:258px">\n			<p>Penghargaan yang didapat:</p>\n			</td>\n			<td style="width:501px">\n			<p>-</p>\n			</td>\n		</tr>\n	</tbody>\n</table>\n\n<p>&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</p>\n\n<table border="0" cellpadding="0" cellspacing="3" style="width:768px">\n	<tbody>\n		<tr>\n			<td style="height:30px; width:214px">\n			<p><strong>Nama:</strong></p>\n			</td>\n			<td style="height:30px; width:403px">\n			<p><strong>KMS A. Roni, S.H., M.H.</strong></p>\n			</td>\n		</tr>\n		<tr>\n			<td style="height:15px; width:214px">\n			<p>NIP:</p>\n			</td>\n			<td style="height:15px; width:403px">\n			<p>19660612 199503 1 002</p>\n			</td>\n		</tr>\n		<tr>\n			<td style="height:12px; width:214px">\n			<p>Jabatan:</p>\n			</td>\n			<td style="height:12px; width:403px">\n			<p>Kepala Biro Pengawasan Perilaku Hakim</p>\n			</td>\n		</tr>\n		<tr>\n			<td style="height:19px; width:214px">\n			<p>Golongan:</p>\n			</td>\n			<td style="height:19px; width:403px">\n			<p>IV-C</p>\n			</td>\n		</tr>\n		<tr>\n			<td style="height:19px; width:214px">\n			<p>Latar Belakang Pendidikan :</p>\n			</td>\n			<td style="height:19px; width:403px">\n			<p>S2 &nbsp;&nbsp;</p>\n			</td>\n		</tr>\n		<tr>\n			<td style="height:18px; width:214px">\n			<p>Jenis Kelamin:</p>\n			</td>\n			<td style="height:18px; width:403px">\n			<p>Laki-laki</p>\n			</td>\n		</tr>\n		<tr>\n			<td style="height:18px; width:214px">\n			<p>Tempat tgl lahir:</p>\n			</td>\n			<td style="height:18px; width:403px">\n			<p>Tanjung Aur, 12 Juni 1966</p>\n			</td>\n		</tr>\n		<tr>\n			<td style="height:18px; width:214px">\n			<p>Nomor Telepon:</p>\n			</td>\n			<td style="height:18px; width:403px">\n			<p>021 3905876/3905877</p>\n			</td>\n		</tr>\n		<tr>\n			<td style="height:18px; width:214px">\n			<p>ALamat :</p>\n			</td>\n			<td style="height:18px; width:403px">\n			<p>Jl. Kramat Raya No 57 Jakarta Pusat</p>\n			</td>\n		</tr>\n		<tr>\n			<td style="height:18px; width:214px">\n			<p>Penghargaan yang didapat:</p>\n			</td>\n			<td style="height:18px; width:403px">\n			<p>-</p>\n			</td>\n		</tr>\n	</tbody>\n</table>\n\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</p>\n\n<table border="0" cellpadding="0" cellspacing="3" style="width:768px">\n	<tbody>\n	</tbody>\n</table>\n\n<table border="0" cellpadding="0" cellspacing="3" style="width:768px">\n	<tbody>\n		<tr>\n			<td style="width:258px">\n			<p><strong>Nama:</strong></p>\n			</td>\n			<td style="width:501px">\n			<p><strong>Brigjen Pol. Drs. Johanes Kwartanto Hariadi</strong></p>\n			</td>\n		</tr>\n		<tr>\n			<td style="width:258px">\n			<p>NIP:</p>\n			</td>\n			<td style="width:501px">\n			<p>59121311</p>\n			</td>\n		</tr>\n		<tr>\n			<td style="width:258px">\n			<p>Jabatan :</p>\n			</td>\n			<td style="width:501px">\n			<p>Kepala Biro Investigasi</p>\n			</td>\n		</tr>\n		<tr>\n			<td style="width:258px">\n			<p>Golongan:</p>\n			</td>\n			<td style="width:501px">\n			<p>-</p>\n			</td>\n		</tr>\n		<tr>\n			<td style="width:258px">\n			<p>Latar Belakang Pendidikan&nbsp; :</p>\n			</td>\n			<td style="width:501px">\n			<p>&nbsp;</p>\n			</td>\n		</tr>\n		<tr>\n			<td style="width:258px">\n			<p>Jenis Kelamin:</p>\n			</td>\n			<td style="width:501px">\n			<p>Laki-laki</p>\n			</td>\n		</tr>\n		<tr>\n			<td style="width:258px">\n			<p>Tempat tgl lahir:</p>\n			</td>\n			<td style="width:501px">\n			<p>Semarang, 23 Desember 1959</p>\n			</td>\n		</tr>\n		<tr>\n			<td style="width:258px">\n			<p>Nomor Telepon:</p>\n			</td>\n			<td style="width:501px">\n			<p>021 3905876/3905877</p>\n			</td>\n		</tr>\n		<tr>\n			<td style="width:258px">\n			<p>ALamat :</p>\n			</td>\n			<td style="width:501px">\n			<p>Jl. Kramat Raya No 57 Jakarta Pusat</p>\n			</td>\n		</tr>\n		<tr>\n			<td style="width:258px">\n			<p>Penghargaan yang didapat:</p>\n			</td>\n			<td style="width:501px">\n			<p>-</p>\n			</td>\n		</tr>\n	</tbody>\n</table>\n\n<p>&nbsp;</p>\n\n<table border="0" cellpadding="0" cellspacing="3" style="width:768px">\n	<tbody>\n		<tr>\n			<td style="width:262px">\n			<p><strong>Nama:</strong></p>\n			</td>\n			<td style="width:497px">\n			<p><strong>Ir. Ronny Dolfinus Tulak, MM</strong></p>\n			</td>\n		</tr>\n		<tr>\n			<td style="width:262px">\n			<p>NIP:</p>\n			</td>\n			<td style="width:497px">\n			<p>195907021987031001</p>\n			</td>\n		</tr>\n		<tr>\n			<td style="width:262px">\n			<p>Jabatan :</p>\n			</td>\n			<td style="width:497px">\n			<p>Kepala Biro Perencanaan dan Kepatuhan Internal</p>\n			</td>\n		</tr>\n		<tr>\n			<td style="width:262px">\n			<p>Golongan:</p>\n			</td>\n			<td style="width:497px">\n			<p>IV-B</p>\n			</td>\n		</tr>\n		<tr>\n			<td style="width:262px">\n			<p>Latar Belakang Pendidikan :</p>\n			</td>\n			<td style="width:497px">\n			<p>S2 -&nbsp;</p>\n			</td>\n		</tr>\n		<tr>\n			<td style="width:262px">\n			<p>Jenis Kelamin:</p>\n			</td>\n			<td style="width:497px">\n			<p>Laki-laki</p>\n			</td>\n		</tr>\n		<tr>\n			<td style="width:262px">\n			<p>Tempat tgl lahir:</p>\n			</td>\n			<td style="width:497px">\n			<p>Ujung Pandang, 2 Juli 1959</p>\n			</td>\n		</tr>\n		<tr>\n			<td style="width:262px">\n			<p>Nomor Telepon:</p>\n			</td>\n			<td style="width:497px">\n			<p>021 3905876/3905877</p>\n			</td>\n		</tr>\n		<tr>\n			<td style="width:262px">\n			<p>ALamat :</p>\n			</td>\n			<td style="width:497px">\n			<p>Jl. Kramat Raya No 57 Jakarta Pusat</p>\n			</td>\n		</tr>\n	</tbody>\n</table>\n\n<p>&nbsp;&nbsp;</p>\n\n<table border="0" cellpadding="0" cellspacing="3" style="width:768px">\n	<tbody>\n		<tr>\n			<td style="width:263px">\n			<p><strong>Nama:</strong></p>\n			</td>\n			<td style="width:496px">\n			<p><strong>Roejito, S.Sos., M.Si.</strong></p>\n			</td>\n		</tr>\n		<tr>\n			<td style="width:263px">\n			<p>NIP:</p>\n			</td>\n			<td style="width:496px">\n			<p>195909211982031004</p>\n			</td>\n		</tr>\n		<tr>\n			<td style="width:263px">\n			<p>Jabatan:</p>\n			</td>\n			<td style="width:496px">\n			<p>Plt. Kepala Biro Umum</p>\n			</td>\n		</tr>\n		<tr>\n			<td style="width:263px">\n			<p>Golongan:</p>\n			</td>\n			<td style="width:496px">\n			<p>IV-C</p>\n			</td>\n		</tr>\n		<tr>\n			<td style="width:263px">\n			<p>Latar Belakang Pendidikan:</p>\n			</td>\n			<td style="width:496px">\n			<p>S2 - Kebijakan Publik</p>\n			</td>\n		</tr>\n		<tr>\n			<td style="width:263px">\n			<p>Jenis Kelamin:</p>\n			</td>\n			<td style="width:496px">\n			<p>Laki-laki</p>\n			</td>\n		</tr>\n		<tr>\n			<td style="width:263px">\n			<p>Tempat tgl lahir:</p>\n			</td>\n			<td style="width:496px">\n			<p>Tegal, 21 September 1959&nbsp;</p>\n			</td>\n		</tr>\n		<tr>\n			<td style="width:263px">\n			<p>Nomor Telepon:</p>\n			</td>\n			<td style="width:496px">\n			<p>021 3905876/3905877</p>\n			</td>\n		</tr>\n		<tr>\n			<td style="width:263px">\n			<p>ALamat:</p>\n			</td>\n			<td style="width:496px">\n			<p>Jl. Kramat Raya No 57 Jakarta Pusat</p>\n			</td>\n		</tr>\n		<tr>\n			<td style="height:3px; width:263px">\n			<p>Penghargaan yang didapat:</p>\n			</td>\n			<td style="height:3px; width:496px">\n			<p>Satyalancana Karya Satya 10 Tahun, 20 Tahun, 30 Tahun</p>\n			</td>\n		</tr>\n	</tbody>\n</table>\n\n<p>&nbsp;</p>\n\n<table border="0" cellpadding="0" cellspacing="3" style="width:768px">\n	<tbody>\n		<tr>\n			<td style="width:263px">\n			<p><strong>Nama:</strong></p>\n			</td>\n			<td style="width:496px">\n			<p><strong>Roejito, S.Sos., M.Si.</strong></p>\n			</td>\n		</tr>\n		<tr>\n			<td style="width:263px">\n			<p>NIP:</p>\n			</td>\n			<td style="width:496px">\n			<p>195909211982031004</p>\n			</td>\n		</tr>\n		<tr>\n			<td style="width:263px">\n			<p>Jabatan:</p>\n			</td>\n			<td style="width:496px">\n			<p>Kepala Pusat Analisis dan Layanan Informasi</p>\n			</td>\n		</tr>\n		<tr>\n			<td style="width:263px">\n			<p>Golongan:</p>\n			</td>\n			<td style="width:496px">\n			<p>IV-C</p>\n			</td>\n		</tr>\n		<tr>\n			<td style="width:263px">\n			<p>Latar Belakang Pendidikan:</p>\n			</td>\n			<td style="width:496px">\n			<p>S2 - Kebijakan Publik</p>\n			</td>\n		</tr>\n		<tr>\n			<td style="width:263px">\n			<p>Jenis Kelamin:</p>\n			</td>\n			<td style="width:496px">\n			<p>Laki-laki</p>\n			</td>\n		</tr>\n		<tr>\n			<td style="width:263px">\n			<p>Tempat tgl lahir:</p>\n			</td>\n			<td style="width:496px">\n			<p>Tegal, 21 September 1959&nbsp;</p>\n			</td>\n		</tr>\n		<tr>\n			<td style="width:263px">\n			<p>Nomor Telepon:</p>\n			</td>\n			<td style="width:496px">\n			<p>021 3905876/3905877</p>\n			</td>\n		</tr>\n		<tr>\n			<td style="width:263px">\n			<p>ALamat:</p>\n			</td>\n			<td style="width:496px">\n			<p>Jl. Kramat Raya No 57 Jakarta Pusat</p>\n			</td>\n		</tr>\n		<tr>\n			<td style="height:3px; width:263px">\n			<p>Penghargaan yang didapat:</p>\n			</td>\n			<td style="height:3px; width:496px">\n			<p>Satyalancana Karya Satya 10 Tahun, 20 Tahun, 30 Tahun</p>\n			</td>\n		</tr>\n	</tbody>\n</table>\n', 13, NULL, '2017-12-03 16:18:01', '2017-12-03', '1', '1'),
	(5, 'visi_misi_jdih', 'Visi Misi JDIH', 'Jaringan Dokumentasi dan Informasi Hukum (JDIH) Lembaga Sandi Negara merupakan sistem yang dibangun untuk melaksanakan sebagian tugas dan fungsi Biro Perencanaan, Hukum, Kepegawaian dan Hubungan Masyarakat (PHKH) selaku anggota Jaringan Dokumentasi dan Informasi Hukum Nasional dan selaku Pusat Jaringan Hukum di lingkungan Lembaga Sandi Negara adalah suatu sistem pendayagunaan bersama peraturan perundang-undangan di bidang persandian dan bahan dokumentasi lainnya secara tertib, terpadu dan berkesinambungan serta merupakan sarana pemberian pelayanan informasi hukum secara mudah, cepat dan akurat.Dasar hukum penyediaan informasi dan pembentukan Jaringan Dokumentasi dan Informasi Hukum (JDIH) Lembaga Sandi Negara yaitu :<ol><li>UU No. 11 Tahun 2008, tentang infomasi dan transaksi elektronik.</li><li>UU No. 14 Tahun 2009 tentang keterbukaan Infomasi Publik.</li><li>Perpres No. 33 Tahun 2012 Tentang Jaringan Dokumentasi dan informasi Hukum.</li><li>Perpres No. 1 Tahun 2007 tentang Pengesahan, Pengundangan dan Penyebarluasan Peraturan perundang-undangan.</li><li>Perka Lemsaneg No. 8 Tahun 2009 tentang Pelayanan Hukum.</li></ol><h3>Visi :</h3><div><div>Menjadi penyedia informasi peraturan perundang-undangan di bidang persandian yang lengkap, mudah, cepat dan akurat untuk mewujudkan masyarakat cerdas hukum</div></div>&nbsp;<h3>Misi :</h3><ul><li>Mengefektifkan JDIH Lembaga Sandi Negara sebagai pusat informasi dan dokumentasi hukum di bidang persandian;</li><li>Meningkatkan pelayanan akses informasi yang mudah, cepat dan akurat melalui website jdih yang berusaha terus dikembangkan dan di-update;</li><li>Meningkatkan program penyuluhan hukum serta JDI Hukum bidang persandian dalam rangka pengembangan budaya hukum dan kesadaran hukum.</li></ul>Dengan Visi dan Misi di atas, JDIH Lembaga Sandi Negara mempunyai motto yaitu :<div><div>LeMuCA</div></div>&nbsp;<span>Lengkap Mudah Cepat dan Akurat</span>', NULL, NULL, '2017-11-04 09:51:25', '0000-00-00', '1', ''),
	(11, 'kontak_jdih', 'Kontak', 'Bagian Hukum dan Organisasi Biro Perencanaan dan Kepatuhan Internal<br><a href="https://maps.google.com/?q=Jl.+Kramat+Raya+No+57+Jakarta+Pusat+Jakarta+Pusat+10450&amp;entry=gmail&amp;source=g" target="" rel="" title="Link: https://maps.google.com/?q=Jl.+Kramat+Raya+No+57+Jakarta+Pusat+Jakarta+Pusat+10450&amp;entry=gmail&amp;source=g">Jl. Kramat Raya No 57 Jakarta Pusat</a>&nbsp;<a href="https://maps.google.com/?q=Jl.+Kramat+Raya+No+57+Jakarta+Pusat+Jakarta+Pusat+10450&amp;entry=gmail&amp;source=g" target="" rel="" title="Link: https://maps.google.com/?q=Jl.+Kramat+Raya+No+57+Jakarta+Pusat+Jakarta+Pusat+10450&amp;entry=gmail&amp;source=g">Jakarta Pusat 10450</a><br><span>Telp. (021) 3905876;&nbsp;</span>Fax. (021) 3906215; PO BOX 2685;<br>Email : humor[at]<a href="http://komisiyudisial.go.id/" target="_blank" rel="" title="Link: http://komisiyudisial.go.id/">komisiyudisial.go.id</a>', 0, NULL, '2017-11-04 17:50:54', '2017-11-04', '1', '1'),
	(12, 'proleg_ky', 'Proleg KY', '<h2><strong>PROGRAM PENYUSUNAN PERATURAN KOMISI YUDISIAL&nbsp;</strong><strong>TAHUN 2017</strong></h2>\n\n<table border="1" cellpadding="0" cellspacing="0" class="table table-bordered">\n	<tbody>\n		<tr>\n			<td>\n			<p><strong>No.</strong></p>\n			</td>\n			<td>\n			<p><strong>Nama Rancangan Peraturan</strong></p>\n			</td>\n			<td>\n			<p><strong>Keterangan</strong></p>\n			</td>\n		</tr>\n		<tr>\n			<td>\n			<p style="text-align:right">1.</p>\n			</td>\n			<td>\n			<p>Undang-Undang tentang Jabatan Hakim</p>\n\n			<p>&nbsp;</p>\n			</td>\n			<td>\n			<p>Proses pembahasan di DPR,</p>\n\n			<p>KY advokasi</p>\n			</td>\n		</tr>\n		<tr>\n			<td>\n			<p style="text-align:right">2.</p>\n			</td>\n			<td>\n			<p>Peraturan Pemerintah tentang Tunjangan Anggota Komisi Yudisial</p>\n			</td>\n			<td>\n			<p>Ditetapkan</p>\n			</td>\n		</tr>\n		<tr>\n			<td>\n			<p style="text-align:right">3.</p>\n			</td>\n			<td>\n			<p>Perubahan peraturan tentang Kode Etik dan Pedoman Tingkah Laku Anggota Komisi Yudisial</p>\n			</td>\n			<td>\n			<p>Proses menuju Pleno penetapan oleh Komisioner</p>\n			</td>\n		</tr>\n		<tr>\n			<td>\n			<p style="text-align:right">4.</p>\n			</td>\n			<td>\n			<p>Perubahan peraturan tentang Dewan Kehormatan Komisi Yudisial</p>\n			</td>\n			<td>\n			<p>Proses harmonisasi</p>\n			</td>\n		</tr>\n		<tr>\n			<td>\n			<p style="text-align:right">5.</p>\n			</td>\n			<td>\n			<p>Perubahan peraturan tentang Susunan Organisasi dan Pembidangan Kerja KY</p>\n			</td>\n			<td>\n			<p>Proses harmonisasi</p>\n			</td>\n		</tr>\n		<tr>\n			<td>\n			<p style="text-align:right">6.</p>\n			</td>\n			<td>\n			<p>Peraturan tentang Pemantauan</p>\n			</td>\n			<td>\n			<p>Proses harmonisasi</p>\n			</td>\n		</tr>\n		<tr>\n			<td>\n			<p style="text-align:right">7.</p>\n			</td>\n			<td>\n			<p>Peraturan tentang Penanganan Informasi Dugaan Pelanggaran KEPPH</p>\n			</td>\n			<td>\n			<p>Proses harmonisasi</p>\n			</td>\n		</tr>\n		<tr>\n			<td>\n			<p style="text-align:right">8.</p>\n			</td>\n			<td>\n			<p>Perubahan peraturan tentang Penghubung</p>\n			</td>\n			<td>\n			<p>Proses menuju Pleno penetapan oleh Komisioner</p>\n			</td>\n		</tr>\n		<tr>\n			<td>\n			<p style="text-align:right">9.</p>\n			</td>\n			<td>\n			<p>Peraturan tentang Tata Kelola Teknologi Informasi dan Komunikasi</p>\n			</td>\n			<td>\n			<p>Proses menuju Pleno penetapan oleh Komisioner</p>\n			</td>\n		</tr>\n		<tr>\n			<td>\n			<p style="text-align:right">10.</p>\n			</td>\n			<td>\n			<p>Perubahan peraturan tentang Susunan Organisasi dan Pembidangan Kerja KY</p>\n			</td>\n			<td>\n			<p>Proses harmonisasi</p>\n			</td>\n		</tr>\n	</tbody>\n</table>\n\n<p>&nbsp;</p>\n\n<p>&nbsp;</p>\n', 0, NULL, '2017-11-12 21:06:16', '2017-11-12', '1', '1'),
	(13, 'sekilas_jdih_home', 'Sekilas JDIH', '<p style="text-align:center"><strong>&quot;Wadah pendayagunaan bersama atas dokumen hukum secara tertib, terpadu, dan berkesinambungan, serta merupakan sarana pemberian pelayanan informasi hukum secara lengkap, akurat, mudah dan cepat&quot;</strong></p>\n', 14, NULL, '2017-11-13 08:32:42', '2017-11-13', '1', '1');
/*!40000 ALTER TABLE `konten_statis` ENABLE KEYS */;

-- Dumping structure for table db_jdih.permohonan
DROP TABLE IF EXISTS `permohonan`;
CREATE TABLE IF NOT EXISTS `permohonan` (
  `id_permohonan` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `id_permohonan_status` int(11) NOT NULL,
  `no_permohonan` varchar(50) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `pengusul` varchar(255) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `no_nota_dinas` varchar(50) NOT NULL,
  `tanggal_nota_dinas` date NOT NULL,
  `id_dok_notadinas` int(11) NOT NULL,
  `id_dok_position_paper` int(11) NOT NULL,
  `id_dok_draft_rancangan` int(11) NOT NULL,
  `id_dok_tahap_pembahasan` int(11) NOT NULL,
  `notes` text NOT NULL,
  `permohonan_status_notes` text NOT NULL,
  `dateupdate` date DEFAULT NULL,
  `userupdate` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_permohonan`),
  KEY `FK_permohonan_produk_hukum_kategori` (`id_kategori`),
  KEY `FK_permohonan_permohonan_status` (`id_permohonan_status`),
  KEY `FK_permohonan_auth_users` (`user_id`),
  CONSTRAINT `FK_permohonan_auth_users` FOREIGN KEY (`user_id`) REFERENCES `auth_users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_permohonan_permohonan_status` FOREIGN KEY (`id_permohonan_status`) REFERENCES `permohonan_status` (`id_permohonan_status`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_permohonan_produk_hukum_kategori` FOREIGN KEY (`id_kategori`) REFERENCES `produk_hukum_kategori` (`id_kategori`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- Dumping data for table db_jdih.permohonan: ~0 rows (approximately)
/*!40000 ALTER TABLE `permohonan` DISABLE KEYS */;
/*!40000 ALTER TABLE `permohonan` ENABLE KEYS */;

-- Dumping structure for table db_jdih.permohonan_status
DROP TABLE IF EXISTS `permohonan_status`;
CREATE TABLE IF NOT EXISTS `permohonan_status` (
  `id_permohonan_status` int(11) NOT NULL AUTO_INCREMENT,
  `status` varchar(50) NOT NULL,
  `no_urut` int(11) NOT NULL,
  PRIMARY KEY (`id_permohonan_status`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- Dumping data for table db_jdih.permohonan_status: ~5 rows (approximately)
/*!40000 ALTER TABLE `permohonan_status` DISABLE KEYS */;
INSERT INTO `permohonan_status` (`id_permohonan_status`, `status`, `no_urut`) VALUES
	(1, 'Pengajuan', 1),
	(2, 'Pembahasan', 5),
	(3, 'Persetujuan', 10),
	(4, 'Review', 3),
	(5, 'Publish', 15);
/*!40000 ALTER TABLE `permohonan_status` ENABLE KEYS */;

-- Dumping structure for table db_jdih.permohonan_status_h
DROP TABLE IF EXISTS `permohonan_status_h`;
CREATE TABLE IF NOT EXISTS `permohonan_status_h` (
  `recid` int(11) NOT NULL AUTO_INCREMENT,
  `id_permohonan` int(11) NOT NULL,
  `id_permohonan_status` int(11) NOT NULL,
  `id_berkas` bigint(20) DEFAULT NULL,
  `notes` text NOT NULL,
  `dateinput` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `userinput` varchar(50) NOT NULL,
  PRIMARY KEY (`recid`),
  KEY `FK_permohonan_status_h_permohonan` (`id_permohonan`),
  KEY `FK_permohonan_status_h_permohonan_status` (`id_permohonan_status`),
  KEY `FK_permohonan_status_h_sys_attach` (`id_berkas`),
  CONSTRAINT `FK_permohonan_status_h_permohonan` FOREIGN KEY (`id_permohonan`) REFERENCES `permohonan` (`id_permohonan`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_permohonan_status_h_permohonan_status` FOREIGN KEY (`id_permohonan_status`) REFERENCES `permohonan_status` (`id_permohonan_status`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_permohonan_status_h_sys_attach` FOREIGN KEY (`id_berkas`) REFERENCES `sys_attach` (`attachid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

-- Dumping data for table db_jdih.permohonan_status_h: ~0 rows (approximately)
/*!40000 ALTER TABLE `permohonan_status_h` DISABLE KEYS */;
/*!40000 ALTER TABLE `permohonan_status_h` ENABLE KEYS */;

-- Dumping structure for table db_jdih.produk_hukum
DROP TABLE IF EXISTS `produk_hukum`;
CREATE TABLE IF NOT EXISTS `produk_hukum` (
  `id_produk_hukum` int(11) NOT NULL AUTO_INCREMENT,
  `id_kategori` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `produk_hukum` varchar(255) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `subjudul` varchar(255) NOT NULL,
  `abstrak` text NOT NULL,
  `isi` text NOT NULL,
  `catatan` text NOT NULL,
  `id_dokumen` int(11) DEFAULT NULL,
  `dateinput` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `userinput` varchar(50) NOT NULL,
  `dateupdate` date NOT NULL,
  `userupdate` varchar(50) NOT NULL,
  PRIMARY KEY (`id_produk_hukum`),
  KEY `FK_produk_hukum_produk_hukum_kategori` (`id_kategori`),
  CONSTRAINT `FK_produk_hukum_produk_hukum_kategori` FOREIGN KEY (`id_kategori`) REFERENCES `produk_hukum_kategori` (`id_kategori`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

-- Dumping data for table db_jdih.produk_hukum: ~13 rows (approximately)
/*!40000 ALTER TABLE `produk_hukum` DISABLE KEYS */;
INSERT INTO `produk_hukum` (`id_produk_hukum`, `id_kategori`, `tanggal`, `produk_hukum`, `judul`, `subjudul`, `abstrak`, `isi`, `catatan`, `id_dokumen`, `dateinput`, `userinput`, `dateupdate`, `userupdate`) VALUES
	(4, 3, '2017-11-01', 'UUD 1945', 'UUD 1945', 'UUD 1945', '', '<div><h3>PEMBUKAAN<br>(Preambule)</h3></div>Bahwa sesungguhnya kemerdekaan itu ialah hak segala bangsa dan oleh sebab itu, maka penjajahan di atas dunia harus dihapuskan, karena tidak sesuai dengan perikemanusiaan dan perikeadilan.Dan perjuangan pergerakan kemerdekaan Indonesia telah sampailah kepada saat yang berbahagia dengan selamat sentausa mengantarkan rakyat Indonesia ke depan pintu gerbang kemerdekaan Negara Indonesia yang merdeka, bersatu, berdaulat, adil dan makmur.Atas berkat rakhmat Allah Yang Maha Kuasa dan dengan didorongkan oleh keinginan luhur, supaya berkehidupan kebangsaan yang bebas, maka rakyat Indonesia menyatakan dengan ini kemerdekaannya.Kemudian dari pada itu untuk membentuk suatu Pemerintah Negara Indonesia yang melindungi segenap bangsa Indonesia dan seluruh tumpah darah Indonesia dan untuk memajukan kesejahteraan umum, mencerdaskan kehidupan bangsa dan ikut melaksanakan ketertiban dunia yang berdasarkan kemerdekaan, perdamaian abadi dan keadilan sosial, maka disusunlah Kemerdekaan Kebagsaan Indonesia itu dalam suatu Undang-Undang Dasar Negara Indonesia, yang terbentuk dalam suatu susunan Negara Republik Indonesia, yang berkedaulatan rakyat dengan berdasar kepada : Ketuhanan Yang Maha Esa, Kemanusiaan yang adil dan beradab, Persatuan Indonesia dan Kerakyatan yang dipimpin oleh hikmat kebijaksanaan dalam permusyawaratan/perwakilan, serta dengan mewujudkan suatu Keadilan sosial bagi seluruh rakyat Indonesia.', '', 4, '2017-11-01 12:39:36', '1', '2017-11-01', '1'),
	(5, 4, '2017-11-01', 'UU Nomor 19 Tahun 2016 tentang Perubahan UU ITE', 'Perubahan UU ITE No. 11 Tahun 2008 UU No. 19 Tahun 2016 2016', 'PERUBAHAN ATAS UNDANG-UNDANG NOMOR I1 TAHUN 2OO8 TENTANG INFORMASI DAN TRANSAKSI ELEKTRONIK', 'bahwa untuk menjamin pengakuan serta penghormatan atas hak dan kebebasan orang lain dan untuk memenuhi tuntutan yang adil sesuai dengan pertimbangan keamanan dan ketertiban umum dalam suatu masyarakat yang demokratis perlu dilakukan perubahan terhadap Undang-Undang Nomor 11 Tahun 2008 tentang Informasi dan Transaksi Elektronik agar terwujud keadilan, ketertiban umum, dan kepastian hukum.', 'Dasar Hukum :<br><span>Pasal 5 ayat (1), Pasal 20, Pasal 25A, Pasal 28D ayat (1), Pasal 28E ayat (3), Pasal 28F, Pasal 28G ayat (1), Pasal 28J ayat (2), dan Pasal 33 ayat (2) UUD Negara RI Tahun 1945, dan UU No. 11 Tahun 2008.<br><br></span>UU ini mengatur tentang :<br>Beberapa ketentuan dalam Undang-Undang Nomor l1 Tahun 2008 tentang Informasi dan Transaksi Elektronik (Lembaran Negara Republik Indonesia Tahun 2008 Nomor 58, Tambahan Lembaran Negara Republik Indonesia Nomor 4843) diubah.', '– &nbsp;Mulai berlaku pada tanggal diundangkan;<br>– &nbsp;Ditetapkan pada tanggal 25 November 2016;<br>– &nbsp;Diundangkan pada tanggal 25 November 2016. dalam Lembaran negara Tahun 2016 No. 251.', 5, '2017-11-01 12:39:41', '1', '2017-11-01', '1'),
	(6, 5, '2017-11-01', 'PP Nomor 40 Tahun 1996 tentang HGU, HGB, dan Hak Pakai', 'HAK GUNA USAHA, HAK GUNA BANGUNAN DAN HAK PAKAI ATAS TANAH', '', '', 'bahwa tanah memiliki peran yang sangat penting artinya dalam kehidupan bangsa Indonesia ataupun dalam pelaksanaan pembangunan nasional yang diselenggara-kan sebagai upaya berkelanjutan untuk mewujudkan masyarakat yang adil dan makmur berdasarkan Pancasila dan Undang-Undang Dasar 1945;bahwa oleh karena itu pengaturan penguasaan, pemilikan dan penggunaan tanah perlu lebih diarahkan bagi semakin terjaminnya tertib di bidang hukum pertanahan, administrasi pertanahan, penggunaan tanah, ataupun pemiliharaan tanah dan lingkungan hidup, sehingga adanya kepastian hukum di bidang pertanahan pada umumnya dapat terwujud;bahwa berhubung dengan itu dipandang perlu untuk menetapkan ketentuan-ketentuan lebih lanjut mengenai Hak Guna Usaha, Hak Guna Bangunan dan Hak Pakai sebagaimana dimaksud dalam Bab II Undang-Undang Nomor 5 Tahun 1960 dengan Peraturan Pemerintah;', '', 6, '2017-11-01 12:39:30', '1', '2017-11-01', '1'),
	(7, 5, '2017-02-01', 'PP Nomor 38 Tahun 2015', 'Gaji ke-13 PP No. 38 Tahun 2015 2015', 'PEMBERIAN GAJI/PENSIUN/TUNJANGAN BULAN KETIGA BELAS DALAM TAHUN ANGGARAN 2015 KEPADA PEGAWAI NEGERI SIPIL, ANGGOTA TENTARA NASIONAL INDONESIA, ANGGOTA KEPOLISIAN NEGARA REPUBLIK INDONESIA, PEJABAT NEGARA, DAN PENERIMA PENSIUN/TUNJANGAN', 'Bahwa Pemerintah berkewajiban meningkatkan kesejahteraan Pegawai Negeri Sipil, Anggota Tentara Nasional Indonesia, Anggota Kepolisian Negara Republik Indonesia, Pejabat Negara, dan Penerima Pensiun/Tunjangan sebagai wujud apresiasi Pemerintah atas prestasi dan pengabdian mereka pada bangsa dan negara dan pemberian gaji/pensiun/tunjangan bulan ketiga belas merupakan salah satu upaya Pemerintah dalam meningkatkan kesejahteraan Pegawai Negeri Sipil, Anggota Tentara Nasional Indonesia, Anggota Kepolisian Negara Republik Indonesia, Pejabat Negara, dan Penerima Pensiun/tunjangan;', 'Dasar Hukum :<ol><li>Pasal 5 ayat (2) UUD Negara RI Tahun 1945;</li><li>UU No. 5 Prps Tahun 1964;</li><li>UU No. 6 Tahun 1966;</li><li>UU No. 11 Tahun 1969;</li><li>UU No. 7 Tahun 1978;</li><li>UU No. 12 Tahun 1980;</li><li>UU No. 2 Tahun 2002;</li><li>UU No. 14 Tahun 2002;</li><li>UU No. 30 Tahun 2002;</li><li>UU No. 24 Tahun 2003;</li><li>UU No. 22 Tahun 2004;</li><li>UU No. 34 Tahun 2004;</li><li>UU No. 5 Tahun 2014;</li><li>UU No. 27 Tahun 2014;</li><li>PP No. 4 Tahun 1966;</li><li>PP No. 36 Tahun 1968;</li><li>PP No. 7 Tahun 1977;</li><li>PP No. 9 Tahun 1980;</li><li>PP No. 10 Tahun 1980;</li><li>PP No. 50 Tahun 1980;</li><li>PP No. 12 Tahun 1981;</li><li>PP No. 14 Tahun 1985;</li><li>PP No. 5 Tahun 1996;</li><li>PP No. 75 Tahun 2000;</li><li>PP No. 76 Tahun 2000;</li><li>PP No. 78 Tahun 2000;</li><li>PP No. 28 Tahun 2001;</li><li>PP No. 29 Tahun 2001;</li><li>PP No. 38 Tahun 2006;</li><li>PP No. 15 Tahun 2008;</li><li>PP No. 58 Tahun 2008;</li><li>PP No. 39 Tahun 2010;</li><li>PP No. 42 Tahun 2010;</li><li>PP No. 94 Tahun 2012;</li><li>PP No. 67 Tahun 2014;</li><li>PP No. 33 Tahun 2015;</li><li>PP No. 34 Tahun 2015;</li><li>PP No. 35 Tahun 2015;</li></ol>PP ini mengatur tentang :<br>Pemberian Gaji Ke-13 dengan ketentuan mengenai teknis pelaksanaan PP ini diatur dengan Peraturan Menteri yang menyelenggarakan urusan pemerintahan di bidang keuangan.<br>', '– &nbsp;Mulai berlaku pada tanggal diundangkan;<br>– &nbsp;Ditetapkan pada tanggal 4 Juni 2015;<br>– &nbsp;Diundangkan pada tanggal 5 Juni 2015.<br>', 0, '2017-11-01 12:39:20', '1', '2017-11-01', '1'),
	(8, 4, '2017-11-01', 'UU Nomor 12 Tahun 2011 tentang Pembentukan Per-UU-an', 'Pembentukan Peraturan Perundang-Undangan UU Nomor 12 Tahun 2011 2011', 'PEMBENTUKAN PERATURAN PERUNDANG-UNDANGAN', 'Bahwa perlu dibentuk UU tentang Pembentukan Peraturan Perundang-Undangan dalam rangka mewujudkan Indonesia sebagai negara hukum, yang menjamin perlindungan hak dan kewajiban segenap rakyat Indonesia berdasarkan UUD Negara Republik Indonesia Tahun 1945. Selain itu, untuk memenuhi kebutuhan masyarakat atas peraturan perundang-undangan yang baik, yang dilaksanakan dengan cara dan metode yang pasti, baku, dan standar yang mengikat semua lembaga yang berwenang membentuk perundang-undangan, mengingat dalam UU Nomor 10 Tahun 2004 tentang Pembentukan Peraturan Perundang-Undangan masih terdapat kekurangan dan belum dapat menampung perkembangan kebutuhan masyarakat mengenai aturan pembentukan peraturan perundang-undangan yang baik.<div><span><br></span></div>', 'Dasar Hukum :<br><span>Pasal 20, Pasal 21, dan Pasal 22A UUD Negara Republik Indonesia Tahun 1945;<br><br></span>Perka Lemsaneg ini mengatur tentang :<ol><li>Ketentuan Umum;</li><li>Asas Pembentukan Peraturan Perundang-Undangan;</li><li>Jenis, Hierarki, dan Materi Muatan Peraturan Perundang-Undangan;</li><li>Perencanaan Peraturan Perundang-Undangan, terdiri dari:</li></ol>Bagian Kesatu&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : Perencanaan UUBagian Kedua&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : Perencanaan PPBagian Ketiga&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : Perencanaan PerpresBagian Keempat&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : Perencanaan Perda ProvinsiBagian Kelima&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : Perencanaan Perda Kabupaten/KotaBagian Keenam&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : Perencanaan Peraturan Perundang Undangan Lainnya<ol><li>Penyusunan Peraturan Perundang-Undangan, terdiri dari :</li></ol>Bagian Kesatu&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : Penyusunan UUBagian Kedua&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : Penyusunan PP Pengganti UUBagian Ketiga&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : Penyusunan PPBagian Keempat&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : Penyusunan PerpresBagian Kelima&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : Penyusunan Perda ProvinsiBagian Keenam&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : Penyusunan Perda Kabupaten/Kota<ol><li>Teknik Penyusunan Peraturan Perundang-Undangan;</li><li>Pembahasan dan Pengesahan RUU, terdiri dari:</li></ol>Bagian Kesatu&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : Pembahasan RUUBagian Kedua&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : Pengesahan RUU<ol><li>Pembahasan dan Penetapan Rancangan Perda Provinsi dan Perda Kabupaten/Kota, terdiri dari:</li></ol>Bagian Kesatu&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : Pembahasan Rancangan Perda ProvinsiBagian Kedua&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : Pembahasan Rancangan Perda Kabupaten/KotaBagian Ketiga&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : Penetapan Rancangan Perda ProvinsiBagian Keempat&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : Penetapan Rancangan Perda Kabupaten/Kota<ol><li>Pengundangan;</li><li>Penyebarluasan, terdiri dari:</li></ol>Bagian Kesatu&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : Penyebarluasan Prolegnas, RUU, dan UUBagian Kedua&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : Penyebarluasan Prolegda, Rancangan Perda Provinsi atau Perda Kabupaten/Kota, dan Perda Provinsi atau Perda Kabupaten/KotaBagian Ketiga&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : Naskah yang Disebarluaskan<ol><li>Partisipasi Masyarakat;</li><li>Ketentuan Lain-Lain;</li><li>Ketentuan Penutup.</li></ol>', '– Mulai berlaku pada tanggal diundangkan;<br>– Ditetapkan pada tanggal 12 Agustus 2011:<br><span>– Diundangkan pada tanggal 12 Agustus 2011.</span>', 7, '2017-11-03 20:03:31', '1', '0000-00-00', ''),
	(9, 4, '2017-11-01', 'UU Nomor 20 Tahun 2001 tentang Pemberantasan Tindak Pidana Korupsi', 'Pemberantasan Tindak Pidana Korupsi UU Nomor 20 Tahun 2001 2001', 'PERUBAHAN ATAS UNDANG-UNDANG NOMOR 31 TAHUN 1999 TENTANG PEMBERANTASAN TINDAK PIDANA KORUPSI', '<span>Bahwa tindak pidana korupsi yang selama ini terjadi, tidak hanya merugikan keuangan negara, tetapi juga merupakan pelanggaran terhadap hak-hak sosial dan ekonomi masyarakat secara luas, sehingga tindak pidana korupsi perlu digolongkan sebagai kejahatan yang pemberantasannya harus dilakukan secara luar biasa. Selain itu, untuk lebih menjamin kepastian hukum, menghindari keragaman penafsiran hukum dan memberikan perlindungan terhadap hak-hak sosial dan ekonomi masyarakat, serta perlakuan secara adil dalam memberantas tindak pidana korupsi, perlu diadakan perubahan atas Undang-undang Nomor 31 Tahun 1999 tentang Pemberantasan Tindak Pidana Korupsi.</span>', 'Dasar Hukum :<ol><li>Pasal 5 ayat (1) dan Pasal 20 ayat (2) dan ayat (4) Undang-Undang Dasar 1945;</li><li>Undang-Undang Nomor 8 Tahun 1981 tentang Hukum Acara Pidana;</li><li>Undang-Undang Nomor 28 Tahun 1999 tentang Penyelenggaraan Negara yang Bebas dari Korupsi, Kolusi, dan Nepotisme;</li><li>Undang-Undang Nomor 31 Tahun 1999 tentang Pemberantasan Tindak Pidana Korupsi.</li></ol>UU ini mengatur tentang :Beberapa ketentuan dan penjelasan pasal dalam Undang-undang Nomor 31 Tahun 1999 tentang Pemberantasan Tindak Pidana Korupsi diubah sebagai berikut:<ol><li>Pasal 2 ayat (2) substansi tetap, penjelasan pasal diubah sehingga rumusannya sebagaimana tercantum dalam penjelasan Pasal Demi Pasal angka 1 Undang-undang ini;</li><li>Ketentuan Pasal 5, Pasal 6, Pasal 7, Pasal 8, Pasal 9, Pasal 10, Pasal 11, dan Pasal 12, rumusannya diubah dengan tidak mengacu pasal-pasal dalam Kitab Undang-undang Hukum Pidana tetapi langsung menyebutkan unsur-unsur yang terdapat dalam masing-masing pasal Kitab Undang- undang Hukum Pidana yang diacu;</li><li>Di antara Pasal 12 dan Pasal 13 disisipkan 3 (tiga) pasal baru yakni Pasal 12 A, Pasal 12 B, dan Pasal 12 C;</li><li>Di antara Pasal 26 dan Pasal 27 disisipkan 1 (satu) pasal baru menjadi Pasal 26 A;</li><li>Pasal 37 dipecah menjadi 2 (dua) pasal yakni menjadi Pasal 37 dan Pasal 37 A;</li><li>Di antara Pasal 38 dan Pasal 39 ditambahkan 3 (tiga) pasal baru yakni Pasal 38 A, Pasal 38 B, dan Pasal 38 C;</li><li>Di antara Bab VI dan Bab VII ditambah bab baru yakni Bab VI A mengenai Ketentuan Peralihan yang berisi 1 (satu) pasal, yakni Pasal 43 A yang diletakkan di antara Pasal 43 dan Pasal 44;</li><li>Dalam BAB VII sebelum Pasal 44 ditambah 1 (satu) pasal baru yakni Pasal 43 B.</li></ol>', '– Mulai berlaku pada tanggal diundangkan;<br>– Mengubah UU Nomor 31 Tahun 1999;<br>– Diundangkan pada tanggal 21 November 2001;<br><span>– Diundangkan pada tanggal 21 November 2001.</span>', 8, '2017-11-03 20:05:28', '1', '0000-00-00', ''),
	(10, 4, '2015-11-01', 'UU Nomor 10 Tahun 2015', 'Komisi Pemberantasan Tindak Pidana Korupsi UU No. 10 Tahun 2015 2015', 'PENETAPAN PERATURAN PEMERINTAH PENGGANTI UNDANG-UNDANG NOMOR 1 TAHUN 2015 TENTANG PERUBAHAN ATAS UNDANG-UNDANG NOMOR 30 TAHUN 2002 TENTANG KOMISI PEMBERANTASAN TINDAK PIDANA KORUPSI MENJADI UNDANG-UNDANG', 'bahwa terjadinya kekosongan keanggotaan pimpinan komisi pemberantasan korupsi telah mengganggu kinerja komisi pemberantasan korupsi dan untuk menjaga kesinambungan upaya pencegahan dan pemberantasan tindak pidana korupsi perlu pengaturan mengenai pengisian keanggotaan sementara pimpinan komisi pemberantasan korupsi. Dan ketentuan mengenai pengisian keanggotaan sementara pimpinan komisi pemberantasan korupsi belum diatur dalam Undang-Undang No. 30 Tahun 2002 tentang Komisi Pemberantasan Tindak Pidana Korupsi.<div><span><br></span></div>', 'Dasar Hukum :<ol><li>Pasal 5 ayat (1), Pasal 20, Pasal 22 ayat (2) UUD Negara Republik Indonesia Tahun 1945;</li><li>UU No. 30 Tahun 2002.</li></ol>UU ini mengatur tentang :<br><span>PP Pengganti UU No. 1 Tahun 2015 tentang perubahan atas Undang-Undang No. 30 Tahun 2002 ditetapkan menjadi UU, dan melampirkannya sebagai bagian yang tidak terpisahkan dari UU ini.</span><br>', '– Mulai berlaku pada tanggal diundangkan;<br>– Ditetapkan pada tanggal 20 Mei 2015;<br><span>– Diundangkan pada tanggal 25 Mei 2015.</span>', 9, '2017-11-03 20:06:58', '1', '0000-00-00', ''),
	(11, 4, '2015-11-01', 'UU Nomor 9 Tahun 2015 tentang Pemerintahan Daerah', 'Pemerintahan Daerah UU No. 9 Tahun 2015 2015', 'PERUBAHAN KEDUA ATAS UNDANG-UNDANG NOMOR 23 TAHUN 2014 TENTANG PEMERINTAHAN DAERAH', '<span>Bahwa untuk kesinambungan kepemimpinan di provinsi, kabupaten/kota diperlukan mekanisme peralihan kepemimpinan daerah di masa jabatannya yang demokratis untuk dapat menjamin pembangunan dan pelayanan kepada masyarakat. Ketentuan tugas dan wewenang dewan perwakilan rakyat daerah provinsi, kabupaten/kota perlu dilakukan penyesuaian dengan undang-undang yang mengatur pemilihan gubernur, bupati, dan walikota.</span>', 'Dasar Hukum :<ol><li>Pasal 18, Pasal 20, Pasal 21, Pasal 22D Undang-Undang Dasar Negara Republik Indonesia Tahun 1945;</li><li>UU Nomor 23 Tahun 2014 tentang Pemerintahan Daerah sebagaimana telah diubah dengan Undang-Undang Nomor 2 Tahun 2015</li></ol>UU ini mengatur tentang:<br><span>Beberapa ketentuan dalam Undang-Undang Nomor 23 Tahun 2014 tentang Pemerintahan Daerah (Lembaran Negara Republik Indonesia Tahun 2014 Nomor 244, Tambahan Lembaran Negara Republik Indonesia Nomor 5587) sebagaimana telah diubah dengan Undang-Undang Nomor 2 Tahun 2015 tentang Penetapan Peraturan Pemerintah Pengganti Undang-Undang Nomor 2 Tahun 2014 tentang Perubahan atas Undang-Undang Nomor 23 Tahun 2014 tentang Pemerintahan Daerah Menjadi Undang-Undang (Lembaran Negara Republik Indonesia Tahun 2015 Nomor 24, Tambahan Lembaran Negara Republik Indonesia Nomor 5657), diubah.</span>', '– &nbsp;Mulai berlaku pada tanggal diundangkan;<br>– &nbsp;Ditetapkan pada tanggal 18 Maret 2015;<br><span>– &nbsp;Diundangkan pada tanggal 18 Maret 2015</span>', 0, '2017-11-03 20:08:28', '1', '0000-00-00', ''),
	(12, 4, '2014-11-01', 'UU Nomor 30 Tahun 2014 tentang Administrasi Pemerintahan', 'Administrasi Pemerintahan UU No. 30 Tahun 2014 2014', 'ADMINISTRASI PEMERINTAHAN', '<span>Bahwa perlu dibentuk UU tentang Pembentukan Peraturan Perundang-Undangan dalam rangka mewujudkan Indonesia sebagai negara hukum, yang menjamin perlindungan hak dan kewajiban segenap rakyat Indonesia berdasarkan UUD Negara Republik Indonesia Tahun 1945. Selain itu, untuk memenuhi kebutuhan masyarakat atas peraturan perundang-undangan yang baik, yang dilaksanakan dengan cara dan metode yang pasti, baku, dan standar yang mengikat semua lembaga yang berwenang membentuk perundang-undangan, mengingat dalam UU Nomor 10 Tahun 2004 tentang Pembentukan Peraturan Perundang-Undangan masih terdapat kekurangan dan belum dapat menampung perkembangan kebutuhan masyarakat mengenai aturan pembentukan peraturan perundang-undangan yang baik.</span>', 'Dasar Hukum :<br><span>Pasal 20, Pasal 21, dan Pasal 22A UUD Negara Republik Indonesia Tahun 1945;<br><br></span>UU ini mengatur tentang:<ol><li>Ketentuan Umum;</li><li>Maksud dan Tujuan, terdiri dari:</li></ol>Bagian Kesatu&nbsp; &nbsp; : MaksudBagian Kedua&nbsp;&nbsp; &nbsp; : Tujuan<ol><li>Ruang Lingkup dan Asas, terdiri dari:</li></ol>Bagian Kesatu&nbsp; &nbsp; : Ruang LingkupBagian Kedua&nbsp;&nbsp; &nbsp; : Asas<ol><li>Hak dan Kewajiban Pejabat Pemerintahan;</li><li>Kewenangan Pemerintahan, terdiri dari:</li></ol>Bagian Kesatu&nbsp; &nbsp; : UmumBagian Kedua&nbsp;&nbsp; &nbsp; : Peraturan Perundang-undanganBagian Ketiga&nbsp;&nbsp; &nbsp; : Asas-Asas Umum Pemerintahan yang BaikBagian Keempat : Atribusi, Delegasi, dan MandatParagraf 1 : UmumParagraf 2 : AtribusiParagraf 3 : DelegasiParagraf 4 : MandatBagian Kelima&nbsp; : Pembatasan KewenanganBagian Keenam : Sengketa KewenanganBagian Ketujuh&nbsp; : Larangan Penyalahgunaan Wewenang<ol><li>Diskresi, terdiri dari:</li></ol>Bagian Kesatu&nbsp; &nbsp; : UmumBagian Kedua&nbsp;&nbsp; &nbsp; : Lingkup DiskresiBagian Ketiga&nbsp;&nbsp; &nbsp; : Persyaratan DiskresiBagian Keempat : Prosedur Penggunaan DiskresiBagian Kelima&nbsp; &nbsp; : Akibat Hukum Diskresi<ol><li>Penyelenggaraan Administrasi Pemerintahan, terdiri dari:</li></ol>Bagian Kesatu&nbsp; &nbsp; : UmumBagian Kedua&nbsp;&nbsp; &nbsp; : Badan dan/atau Pejabat PemerintahanBagian Ketiga&nbsp;&nbsp; &nbsp; : Bantuan KedinasanBagian Keempat : Keputusan Berbentuk ElektronisBagian Kelima&nbsp; &nbsp; : Izin, Dispensasi, dan Konsesi<ol><li>Prosedur Administrasi Pemerintahan, terdiri dari:</li></ol>Bagian Kesatu&nbsp; &nbsp; : Para PihakBagian Kedua&nbsp;&nbsp; &nbsp; : Pemberian KuasaBagian Ketiga&nbsp;&nbsp; &nbsp; : Konflik KepentinganBagian Keempat : Sosialisasi bagi Pihak yang BerkepentinganBagian Kelima&nbsp; &nbsp; : Standar Operasional ProsedurBagian Keenam&nbsp; : Pemeriksaan Dokumen Administrasi PemerintahanBagian Ketujuh&nbsp;&nbsp; : Penyebarluasan Dokumen AdministrasiPemerintahan<ol><li>Keputusan Pemerintahan, terdiri dari:</li></ol>Bagian Kesatu&nbsp; &nbsp; : Syarat Sahnya KeputusanBagian Kedua&nbsp;&nbsp; &nbsp; : Berlaku dan Mengikatnya KeputusanParagraf 1 : Berlakunya KeputusanParagraf 2 : Mengikatnya KeputusanBagian Ketiga&nbsp;&nbsp; &nbsp; : Penyampaian KeputusanBagian Keempat : Perubahan, Pencabutan, Penundaan, danPembatalan KeputusanParagraf 1 : PerubahanParagraf 2 : PencabutanParagraf 3 : PenundaanParagraf 4 : PembatalanBagian Kelima&nbsp; &nbsp; : Akibat Hukum Keputusan dan/atau TindakanParagraf 1 : Akibat Hukum Keputusan dan/atauTindakan yang Tidak SahParagraf 2 : Akibat Hukum Keputusan dan/atauTindakan yang Dapat DibatalkanBagian Keenam&nbsp; : Legalisasi Dokumen<ol><li>Upaya Administrasi, terdiri dari:</li></ol>Bagian Kesatu&nbsp; &nbsp; : UmumBagian Kedua&nbsp;&nbsp; &nbsp; : KeberatanBagian Ketiga&nbsp;&nbsp; &nbsp; : Banding<ol><li>Pembinaan dan Pengembangan Administrasi Pemerintahan;</li><li>Sanksi Administratif;</li><li>Ketentuan Peralihan;</li><li>Ketentuan Penutup</li></ol>', '–&nbsp; Mulai berlaku pada tanggal diundangkan;<br>– &nbsp;Ditetapkan pada tanggal 17 Oktober 2014;<br><span>– &nbsp;Diundangkan pada tanggal 17 Oktober 2014.</span>', 0, '2017-11-03 20:09:27', '1', '0000-00-00', ''),
	(13, 8, '2016-01-01', 'Peraturan Komisi Yudisial No 3 Tahun 2016', 'Peraturan Komisi Yudisial No 3 Tahun 2016 tentang Seleksi Calon Hakim Ad Hoc Tipikor di MA', '', '', 'Peraturan Komisi Yudisial No 3 Tahun 2016 tentang Seleksi Calon Hakim Ad Hoc Tipikor di MA', '', 54, '2017-12-03 16:10:15', '1', '0000-00-00', ''),
	(14, 6, '2012-01-01', 'Peraturan Pemerintah Republik Indonesia Nomor 94 Tahun 2012', 'Peraturan Pemerintah Republik Indonesia Nomor 94 Tahun 2012 Tentang Hak Keuangan dan Fasilitas Hakim', '', '', 'Peraturan Pemerintah Republik Indonesia Nomor 94 Tahun 2012 Tentang Hak Keuangan dan Fasilitas Hakim', '', 55, '2017-12-03 16:14:34', '1', '0000-00-00', ''),
	(15, 7, '2017-01-01', ' Peraturan Bersama MA RI dan KY RI Tentang Majelis Kehormatan Hakim', ' Peraturan Bersama MA RI dan KY RI Tentang Majelis Kehormatan Hakim', '', '', '&nbsp;Peraturan Bersama MA RI dan KY RI Tentang Majelis Kehormatan Hakim', '', 56, '2017-12-03 16:16:11', '1', '0000-00-00', ''),
	(16, 9, '2017-01-01', 'Peraturan Sekjen Nomor 6 Tahun 2014', 'Peraturan Sekjen Nomor 6 Tahun 2014 tentang Penanganan Pengaduan Whistleblower Pengadaan Barang dan jasa', '', '', 'Peraturan Sekjen Nomor 6 Tahun 2014 tentang Penanganan Pengaduan Whistleblower Pengadaan Barang dan jasa', '', 57, '2017-12-03 16:57:21', '1', '0000-00-00', '');
/*!40000 ALTER TABLE `produk_hukum` ENABLE KEYS */;

-- Dumping structure for table db_jdih.produk_hukum_kategori
DROP TABLE IF EXISTS `produk_hukum_kategori`;
CREATE TABLE IF NOT EXISTS `produk_hukum_kategori` (
  `id_kategori` int(11) NOT NULL AUTO_INCREMENT,
  `id_group` int(11) DEFAULT NULL,
  `kategori` varchar(255) NOT NULL,
  `no_urut` int(11) NOT NULL,
  `deskripsi` text,
  `is_permohonan` enum('Y','N') NOT NULL DEFAULT 'N',
  `dateinput` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `userinput` varchar(50) NOT NULL,
  `dateupdate` date DEFAULT NULL,
  `userupdate` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_kategori`),
  KEY `FK_produk_hukum_kategori_produk_hukum_kategori_group` (`id_group`),
  CONSTRAINT `FK_produk_hukum_kategori_produk_hukum_kategori_group` FOREIGN KEY (`id_group`) REFERENCES `produk_hukum_kategori_group` (`id_group`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

-- Dumping data for table db_jdih.produk_hukum_kategori: ~13 rows (approximately)
/*!40000 ALTER TABLE `produk_hukum_kategori` DISABLE KEYS */;
INSERT INTO `produk_hukum_kategori` (`id_kategori`, `id_group`, `kategori`, `no_urut`, `deskripsi`, `is_permohonan`, `dateinput`, `userinput`, `dateupdate`, `userupdate`) VALUES
	(3, NULL, 'Undang-Undang Dasar Negara Republik Indonesia Tahun 1945', 1, 'Undang-Undang Dasar Negara Republik Indonesia Tahun 1945', 'N', '2017-11-03 07:32:51', '1', '0000-00-00', ''),
	(4, NULL, 'Undang-Undang/Peraturan Pemerintah Pengganti Undang-Undang (Perppu)', 2, 'Undang-Undang/Peraturan Pemerintah Pengganti Undang-Undang (Perppu)', 'N', '2017-11-03 07:32:54', '1', '0000-00-00', ''),
	(5, NULL, 'Peraturan Pemerintah', 3, 'Peraturan Pemerintah', 'N', '2017-11-03 07:32:56', '1', '0000-00-00', ''),
	(6, NULL, 'Peraturan Presiden', 0, '', 'N', '2017-12-03 16:52:18', '1', NULL, NULL),
	(7, NULL, 'Peraturan Bersama Antara Mahkamah Agung dengan Komisi Yudisial', 5, '', 'N', '2017-11-03 07:32:59', '1', '0000-00-00', ''),
	(8, NULL, 'Peraturan Komisi Yudisial', 6, '', 'N', '2017-11-03 07:33:01', '1', '0000-00-00', ''),
	(9, NULL, 'Peraturan Sekretaris Jenderal Komisi Yudisial', 7, '', 'N', '2017-11-03 07:33:02', '1', '0000-00-00', ''),
	(11, 2, 'Instruksi Ketua Komisi Yudisial', 9, NULL, 'Y', '2017-11-04 20:22:20', '1', NULL, NULL),
	(12, 3, 'Keputusan Ketua Komisi Yudisial', 10, NULL, 'Y', '2017-11-04 20:22:25', '1', NULL, NULL),
	(13, 4, 'Surat Edaran Ketua Komisi Yudisial', 11, NULL, 'Y', '2017-11-04 20:22:28', '1', NULL, NULL),
	(15, 2, 'Intstruksi Sekretaris Jenderal Komisi Yudisial', 13, NULL, 'Y', '2017-11-04 20:22:33', '1', NULL, NULL),
	(16, 3, 'Keptusan Sekretaris Jenderal Komisi Yudisial', 14, NULL, 'Y', '2017-11-04 20:22:36', '1', '2017-11-04', NULL),
	(17, 4, 'Surat Edaran Sekretaris Jenderal Komisi Yudisial', 15, NULL, 'Y', '2017-11-04 20:22:40', '1', NULL, NULL);
/*!40000 ALTER TABLE `produk_hukum_kategori` ENABLE KEYS */;

-- Dumping structure for table db_jdih.produk_hukum_kategori_group
DROP TABLE IF EXISTS `produk_hukum_kategori_group`;
CREATE TABLE IF NOT EXISTS `produk_hukum_kategori_group` (
  `id_group` int(11) NOT NULL AUTO_INCREMENT,
  `group` varchar(50) NOT NULL,
  `dateinput` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `userinput` varchar(50) NOT NULL,
  PRIMARY KEY (`id_group`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Dumping data for table db_jdih.produk_hukum_kategori_group: ~4 rows (approximately)
/*!40000 ALTER TABLE `produk_hukum_kategori_group` DISABLE KEYS */;
INSERT INTO `produk_hukum_kategori_group` (`id_group`, `group`, `dateinput`, `userinput`) VALUES
	(1, 'Peraturan', '2017-11-04 20:20:45', '1'),
	(2, 'Instruksi', '2017-11-04 20:20:54', '1'),
	(3, 'Keputusan', '2017-11-04 20:21:02', '1'),
	(4, 'Surat Edaran', '2017-11-04 20:21:12', '1');
/*!40000 ALTER TABLE `produk_hukum_kategori_group` ENABLE KEYS */;

-- Dumping structure for table db_jdih.produk_hukum_komentar
DROP TABLE IF EXISTS `produk_hukum_komentar`;
CREATE TABLE IF NOT EXISTS `produk_hukum_komentar` (
  `id_komentar` int(11) NOT NULL AUTO_INCREMENT,
  `id_produk_hukum` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `komentar` text NOT NULL,
  `dateinput` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `publish` enum('Y','N') NOT NULL DEFAULT 'N',
  PRIMARY KEY (`id_komentar`),
  KEY `FK_produk_hukum_komentar_produk_hukum` (`id_produk_hukum`),
  CONSTRAINT `FK_produk_hukum_komentar_produk_hukum` FOREIGN KEY (`id_produk_hukum`) REFERENCES `produk_hukum` (`id_produk_hukum`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- Dumping data for table db_jdih.produk_hukum_komentar: ~2 rows (approximately)
/*!40000 ALTER TABLE `produk_hukum_komentar` DISABLE KEYS */;
INSERT INTO `produk_hukum_komentar` (`id_komentar`, `id_produk_hukum`, `nama`, `email`, `komentar`, `dateinput`, `publish`) VALUES
	(7, 4, 'selametsubu', 'selametsubu@gmail.com', 'sudah berapa kali revisi UUD 45 ?', '2017-11-03 14:15:01', 'Y'),
	(8, 4, 'selametsubu', 'selametsubu@gmail.com', 'Apakah UUD yg sekarang sudah mengalami revisi ?', '2017-11-03 14:22:45', 'Y');
/*!40000 ALTER TABLE `produk_hukum_komentar` ENABLE KEYS */;

-- Dumping structure for table db_jdih.slideshow
DROP TABLE IF EXISTS `slideshow`;
CREATE TABLE IF NOT EXISTS `slideshow` (
  `id_slideshow` int(11) NOT NULL AUTO_INCREMENT,
  `judul` varchar(255) NOT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_slideshow`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- Dumping data for table db_jdih.slideshow: ~2 rows (approximately)
/*!40000 ALTER TABLE `slideshow` DISABLE KEYS */;
INSERT INTO `slideshow` (`id_slideshow`, `judul`, `gambar`) VALUES
	(6, 'Slider 1', 'slide3.jpg'),
	(7, 'Slider 2', 'slide2.jpg');
/*!40000 ALTER TABLE `slideshow` ENABLE KEYS */;

-- Dumping structure for table db_jdih.sys_attach
DROP TABLE IF EXISTS `sys_attach`;
CREATE TABLE IF NOT EXISTS `sys_attach` (
  `attachid` bigint(20) NOT NULL AUTO_INCREMENT,
  `dateinput` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `userinput` varchar(50) NOT NULL,
  PRIMARY KEY (`attachid`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8;

-- Dumping data for table db_jdih.sys_attach: ~34 rows (approximately)
/*!40000 ALTER TABLE `sys_attach` DISABLE KEYS */;
INSERT INTO `sys_attach` (`attachid`, `dateinput`, `userinput`) VALUES
	(4, '2017-10-31 22:09:08', '1'),
	(5, '2017-10-31 22:16:07', '1'),
	(6, '2017-10-31 22:25:16', '1'),
	(7, '2017-11-03 20:03:31', '1'),
	(8, '2017-11-03 20:05:28', '1'),
	(9, '2017-11-03 20:06:58', '1'),
	(10, '2017-11-04 09:46:46', '1'),
	(11, '2017-11-04 09:59:12', '1'),
	(12, '2017-11-04 10:12:20', '1'),
	(13, '2017-11-04 10:14:58', '2017-11-04'),
	(14, '2017-11-13 08:32:42', '2017-11-13'),
	(35, '2017-11-16 15:44:44', '1'),
	(36, '2017-11-16 15:44:44', '1'),
	(37, '2017-11-16 15:44:44', '1'),
	(38, '2017-11-16 15:44:44', '1'),
	(39, '2017-11-19 21:40:13', '3'),
	(40, '2017-11-19 21:40:13', '3'),
	(41, '2017-11-19 21:40:13', '3'),
	(42, '2017-11-19 21:40:13', '3'),
	(43, '2017-11-25 07:46:29', '1'),
	(44, '2017-11-25 07:46:29', '1'),
	(45, '2017-11-25 07:46:29', '1'),
	(46, '2017-11-25 07:46:29', '1'),
	(47, '2017-11-25 08:58:16', '1'),
	(48, '2017-11-25 09:05:20', '1'),
	(49, '2017-11-25 09:20:38', '1'),
	(50, '2017-11-25 09:50:35', '4'),
	(51, '2017-11-25 09:50:35', '4'),
	(52, '2017-11-25 09:50:35', '4'),
	(53, '2017-11-25 09:50:35', '4'),
	(54, '2017-12-03 16:10:15', '1'),
	(55, '2017-12-03 16:14:34', '1'),
	(56, '2017-12-03 16:16:11', '1'),
	(57, '2017-12-03 16:57:21', '1');
/*!40000 ALTER TABLE `sys_attach` ENABLE KEYS */;

-- Dumping structure for table db_jdih.sys_attach_dtl
DROP TABLE IF EXISTS `sys_attach_dtl`;
CREATE TABLE IF NOT EXISTS `sys_attach_dtl` (
  `recid` bigint(20) NOT NULL AUTO_INCREMENT,
  `attachid` bigint(20) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` varchar(500) DEFAULT NULL,
  `filename` varchar(500) NOT NULL,
  `filetype` varchar(500) NOT NULL,
  `filesize` float NOT NULL,
  `tumbnail` varchar(500) DEFAULT NULL,
  `remarks` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`recid`),
  KEY `sys_attach_dtl_2_sys_attach_FK` (`attachid`),
  CONSTRAINT `sys_attach_dtl_2_sys_attach_FK` FOREIGN KEY (`attachid`) REFERENCES `sys_attach` (`attachid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=utf8;

-- Dumping data for table db_jdih.sys_attach_dtl: ~39 rows (approximately)
/*!40000 ALTER TABLE `sys_attach_dtl` DISABLE KEYS */;
INSERT INTO `sys_attach_dtl` (`recid`, `attachid`, `title`, `description`, `filename`, `filetype`, `filesize`, `tumbnail`, `remarks`) VALUES
	(8, 4, 'UUD1945dlmsatunaskah.pdf', 'Berkas Upload', 'UUD1945dlmsatunaskah.pdf', 'application/pdf', 123.62, NULL, NULL),
	(9, 4, 'UUD1945PerubahanKedua.pdf', 'Berkas Upload', 'UUD1945PerubahanKedua.pdf', 'application/pdf', 26.89, NULL, NULL),
	(10, 4, 'UUD1945PerubahanKetiga.pdf', 'Berkas Upload', 'UUD1945PerubahanKetiga.pdf', 'application/pdf', 32.34, NULL, NULL),
	(11, 4, 'UUD1945PerubahanPertama.pdf', 'Berkas Upload', 'UUD1945PerubahanPertama.pdf', 'application/pdf', 14.61, NULL, NULL),
	(12, 6, 'PP-Nomor-40-Tahun-1996.pdf', 'Berkas Upload', 'PP-Nomor-40-Tahun-1996.pdf', 'application/pdf', 122.73, NULL, NULL),
	(13, 7, 'UU-12_2011-PPU.pdf', 'Berkas Upload', 'UU-12_2011-PPU.pdf', 'application/pdf', 607.92, NULL, NULL),
	(14, 8, 'UU202001.pdf', 'Berkas Upload', 'UU202001.pdf', 'application/pdf', 116.77, NULL, NULL),
	(15, 9, 'UU-Nomor-10-Tahun-2015.pdf', 'Berkas Upload', 'UU-Nomor-10-Tahun-2015.pdf', 'application/pdf', 147.3, NULL, NULL),
	(17, 11, 'Denah.jpg', 'Konten Statis', 'Denah.jpg', '', 0, NULL, NULL),
	(18, 12, 'Denah1.jpg', 'Konten Statis', 'Denah1.jpg', '', 0, NULL, NULL),
	(20, 10, '11_-_Staff_Room.jpg', 'Konten Statis', '11_-_Staff_Room.jpg', '', 0, NULL, NULL),
	(21, 14, 'Dirgahayu-RI_tv-lift-copy.jpg', 'Konten Statis', 'Dirgahayu-RI_tv-lift-copy.jpg', '', 0, NULL, NULL),
	(42, 35, 'Nota Dinas', NULL, 'IN_SO_184350_(rev)2.pdf', '', 0, NULL, NULL),
	(43, 36, 'Position Paper File', NULL, 'DOC-20170611-WA0000_pdf2.pdf', '', 0, NULL, NULL),
	(44, 37, 'Draft Rancangan File', NULL, 'PS_SO_184350_(rev)2.pdf', '', 0, NULL, NULL),
	(45, 38, 'Draft Rancangan File', NULL, '10_Hari_Terakhir_Bulan_Ramadhan_Bersama_Rasulullah_Shallallahu_Alaihi_Wa_Sallam.pdf', '', 0, NULL, NULL),
	(46, 39, 'Nota Dinas', NULL, '17051714308J979.pdf', '', 0, NULL, NULL),
	(47, 40, 'Position Paper File', NULL, '170402204589FN9.pdf', '', 0, NULL, NULL),
	(48, 41, 'Draft Rancangan File', NULL, '170508171683HK5.pdf', '', 0, NULL, NULL),
	(49, 42, 'Draft Rancangan File', NULL, '17041711258X32T.pdf', '', 0, NULL, NULL),
	(50, 43, 'Nota Dinas', NULL, '10_hari_akhir.pdf', '', 0, NULL, NULL),
	(51, 44, 'Position Paper File', NULL, '17041711258X32T1.pdf', '', 0, NULL, NULL),
	(52, 45, 'Draft Rancangan File', NULL, '17051714308J9791.pdf', '', 0, NULL, NULL),
	(53, 46, 'Draft Rancangan File', NULL, '170502202784NCA.pdf', '', 0, NULL, NULL),
	(54, 47, 'Berkas Pendukung', NULL, '17051714308J979.pdf', '', 0, NULL, NULL),
	(55, 48, 'Berkas Pendukung', NULL, '170502202784NCA3.pdf', '', 0, NULL, NULL),
	(56, 48, 'Berkas Pendukung', NULL, '170508171683HK5.pdf', '', 0, NULL, NULL),
	(57, 49, 'Berkas Pendukung', NULL, 'Expenses.pdf', '', 0, NULL, NULL),
	(58, 49, 'Berkas Pendukung', NULL, 'IN_SO_184350_(rev).pdf', '', 0, NULL, NULL),
	(59, 49, 'Berkas Pendukung', NULL, 'IN_SO_184350.pdf', '', 0, NULL, NULL),
	(60, 50, 'Nota Dinas', NULL, '170402204589FN91.pdf', '', 0, NULL, NULL),
	(61, 51, 'Position Paper File', NULL, '17051714308J9792.pdf', '', 0, NULL, NULL),
	(62, 52, 'Draft Rancangan File', NULL, '17041711258X32T2.pdf', '', 0, NULL, NULL),
	(63, 53, 'Draft Rancangan File', NULL, '17041711258X32T3.pdf', '', 0, NULL, NULL),
	(64, 13, 'stuktur-kesekjenan.jpg', 'Konten Statis', 'stuktur-kesekjenan.jpg', '', 0, NULL, NULL),
	(65, 54, 'Peraturan-KY-Nomor-3-Tahun-2016.pdf', 'Berkas Upload', 'Peraturan-KY-Nomor-3-Tahun-2016.pdf', 'application/pdf', 3339.75, NULL, NULL),
	(66, 55, 'PP-NO-94-TAHUN-2012.pdf', 'Berkas Upload', 'PP-NO-94-TAHUN-2012.pdf', 'application/pdf', 877.85, NULL, NULL),
	(67, 56, '04-Peraturan-Bersama-MA-KY-tentang-Majelsi-Kehormatan-Hakim.pdf', 'Berkas Upload', '04-Peraturan-Bersama-MA-KY-tentang-Majelsi-Kehormatan-Hakim.pdf', 'application/pdf', 4771.02, NULL, NULL),
	(68, 57, 'Persekjen-Nomor-6-Tahun-2014.pdf', 'Berkas Upload', 'Persekjen-Nomor-6-Tahun-2014.pdf', 'application/pdf', 844.47, NULL, NULL);
/*!40000 ALTER TABLE `sys_attach_dtl` ENABLE KEYS */;

-- Dumping structure for table db_jdih.sys_globalvar
DROP TABLE IF EXISTS `sys_globalvar`;
CREATE TABLE IF NOT EXISTS `sys_globalvar` (
  `varid` bigint(20) NOT NULL AUTO_INCREMENT,
  `varname` varchar(50) NOT NULL,
  `val_int` int(10) DEFAULT NULL,
  `val_float` decimal(30,2) DEFAULT NULL,
  `val_varchar` varchar(500) DEFAULT NULL,
  `val_date` date DEFAULT NULL,
  `val_datetime` datetime DEFAULT NULL,
  `val_text` longtext,
  `val_datefrom` date DEFAULT NULL,
  `val_dateto` date DEFAULT NULL,
  `developername` varchar(255) DEFAULT NULL,
  `guide` longtext,
  `dateinput` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `userinput` varchar(50) NOT NULL,
  `dateupdate` datetime DEFAULT NULL,
  `userupdate` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`varid`),
  UNIQUE KEY `varname` (`varname`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Dumping data for table db_jdih.sys_globalvar: ~4 rows (approximately)
/*!40000 ALTER TABLE `sys_globalvar` DISABLE KEYS */;
INSERT INTO `sys_globalvar` (`varid`, `varname`, `val_int`, `val_float`, `val_varchar`, `val_date`, `val_datetime`, `val_text`, `val_datefrom`, `val_dateto`, `developername`, `guide`, `dateinput`, `userinput`, `dateupdate`, `userupdate`) VALUES
	(1, 'pesan_sukses_permohonan', NULL, NULL, NULL, NULL, NULL, '<p>\r\n	<b>Informasi</b>\r\n</p>\r\n<p>\r\n	Terima Kasih telah mengajukan permohonan.\r\n	Permohonan anda akan kami tindak lanjuti.\r\n	Terima Kasih\r\n</p>', NULL, NULL, NULL, NULL, '2017-11-16 15:18:16', '1', NULL, NULL),
	(2, 'jdih_fb', NULL, NULL, 'https://www.facebook/jdih-ky', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-12-01 06:42:57', '1', NULL, NULL),
	(3, 'jdih_twitter', NULL, NULL, 'https://twitter.com/jdih-ky', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-12-01 06:48:32', '1', NULL, NULL),
	(4, 'ky_web', NULL, NULL, 'http://www.komisiyudisial.go.id', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-12-01 06:50:48', '1', NULL, NULL);
/*!40000 ALTER TABLE `sys_globalvar` ENABLE KEYS */;

-- Dumping structure for table db_jdih.sys_log_type
DROP TABLE IF EXISTS `sys_log_type`;
CREATE TABLE IF NOT EXISTS `sys_log_type` (
  `logtypeid` bigint(20) NOT NULL AUTO_INCREMENT,
  `code` varchar(50) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  `used_user_rating` tinyint(1) DEFAULT '0',
  `used_user_rating_weight` decimal(30,2) DEFAULT '0.00',
  PRIMARY KEY (`logtypeid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table db_jdih.sys_log_type: ~0 rows (approximately)
/*!40000 ALTER TABLE `sys_log_type` DISABLE KEYS */;
/*!40000 ALTER TABLE `sys_log_type` ENABLE KEYS */;

-- Dumping structure for table db_jdih.sys_privilege
DROP TABLE IF EXISTS `sys_privilege`;
CREATE TABLE IF NOT EXISTS `sys_privilege` (
  `privilegeid` bigint(20) NOT NULL AUTO_INCREMENT,
  `roleid` bigint(20) NOT NULL,
  `sitemapid` bigint(20) NOT NULL,
  `dateinput` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `userinput` varchar(50) NOT NULL,
  `dateupdate` datetime DEFAULT NULL,
  `userupdate` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`privilegeid`),
  KEY `sys_privilege_2_sys_sitemap_fk` (`sitemapid`),
  KEY `sys_privilege_2_sys_role_fk` (`roleid`),
  CONSTRAINT `sys_privilege_2_sys_role_fk` FOREIGN KEY (`roleid`) REFERENCES `sys_role` (`roleid`),
  CONSTRAINT `sys_privilege_2_sys_sitemap_fk` FOREIGN KEY (`sitemapid`) REFERENCES `sys_sitemap` (`sitemapid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

-- Dumping data for table db_jdih.sys_privilege: ~18 rows (approximately)
/*!40000 ALTER TABLE `sys_privilege` DISABLE KEYS */;
INSERT INTO `sys_privilege` (`privilegeid`, `roleid`, `sitemapid`, `dateinput`, `userinput`, `dateupdate`, `userupdate`) VALUES
	(1, 1, 1, '2017-10-29 21:27:37', '1', '2017-10-29 21:27:44', NULL),
	(2, 1, 2, '2017-10-29 21:54:04', '1', NULL, NULL),
	(3, 1, 3, '2017-10-29 21:59:05', '1', NULL, NULL),
	(4, 1, 4, '2017-10-29 22:57:57', '1', NULL, NULL),
	(5, 1, 5, '2017-10-29 23:28:57', '1', NULL, NULL),
	(6, 1, 6, '2017-10-29 23:29:06', '1', NULL, NULL),
	(7, 1, 7, '2017-10-29 23:29:25', '1', NULL, NULL),
	(8, 1, 122, '2017-11-04 07:40:05', '1', NULL, NULL),
	(9, 1, 128, '2017-11-13 12:42:38', '1', NULL, NULL),
	(10, 1, 129, '2017-11-14 09:54:23', '1', NULL, NULL),
	(11, 1, 130, '2017-11-14 09:54:39', '1', NULL, NULL),
	(12, 1, 131, '2017-11-17 10:02:43', '1', NULL, NULL),
	(13, 1, 132, '2017-11-18 23:03:35', '1', NULL, NULL),
	(14, 2, 1, '2017-11-19 20:17:59', '1', NULL, NULL),
	(15, 2, 5, '2017-11-19 20:18:56', '1', NULL, NULL),
	(16, 2, 128, '2017-11-19 20:19:18', '1', NULL, NULL),
	(17, 2, 7, '2017-11-19 20:19:35', '1', NULL, NULL),
	(18, 1, 134, '2017-11-30 20:54:58', '1', NULL, NULL);
/*!40000 ALTER TABLE `sys_privilege` ENABLE KEYS */;

-- Dumping structure for table db_jdih.sys_role
DROP TABLE IF EXISTS `sys_role`;
CREATE TABLE IF NOT EXISTS `sys_role` (
  `roleid` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `displayname` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`roleid`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Dumping data for table db_jdih.sys_role: ~1 rows (approximately)
/*!40000 ALTER TABLE `sys_role` DISABLE KEYS */;
INSERT INTO `sys_role` (`roleid`, `name`, `displayname`, `description`) VALUES
	(1, 'admin', 'Administrator', 'Administrator'),
	(2, 'biasa', 'User Biasa', 'User Biasa');
/*!40000 ALTER TABLE `sys_role` ENABLE KEYS */;

-- Dumping structure for table db_jdih.sys_sitemap
DROP TABLE IF EXISTS `sys_sitemap`;
CREATE TABLE IF NOT EXISTS `sys_sitemap` (
  `sitemapid` bigint(20) NOT NULL AUTO_INCREMENT,
  `sitemapid_parent` bigint(20) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `displayname` varchar(255) NOT NULL,
  `titlebar` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `sortno` bigint(20) NOT NULL DEFAULT '999',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `icon` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`sitemapid`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=135 DEFAULT CHARSET=utf8;

-- Dumping data for table db_jdih.sys_sitemap: ~31 rows (approximately)
/*!40000 ALTER TABLE `sys_sitemap` DISABLE KEYS */;
INSERT INTO `sys_sitemap` (`sitemapid`, `sitemapid_parent`, `name`, `displayname`, `titlebar`, `url`, `sortno`, `is_active`, `icon`) VALUES
	(1, 0, 'Home', 'Home', 'Home', 'dashboard', 1, 1, '<i class="fa fa-lg fa-home"></i>'),
	(2, 0, 'Produk Hukum', 'Produk Hukum', 'Produk Hukum', NULL, 2, 1, '<i class="fa fa-institution"></i> '),
	(3, 2, 'Jenis Produk Hukum', 'Jenis', 'Jenis', 'Produk_hukum_kategori', 1, 1, '<i class="fa fa-book"></i>'),
	(4, 2, 'Produk Hukum Data', 'Produk Hukum', 'Produk Hukum', 'Produk_hukum', 2, 1, '<i class="fa fa-tasks"></i>'),
	(5, 0, 'Permohonan', 'Permohonan', 'Permohonan', NULL, 3, 1, '<i class="fa fa-file-text-o"></i>'),
	(6, 5, 'Update Permohonan', 'Update Permohonan', 'Update Permohonan', 'update_permohonan', 1, 1, '<i class="fa fa-refresh"></i>'),
	(7, 5, 'Status Permohonan', 'Status Permohonan', 'Status Permohonan', 'permohonan', 2, 1, '<i class="fa fa-info"></i>'),
	(8, NULL, 'Admin', 'Admin', 'Admin', NULL, 0, 1, NULL),
	(11, 100, 'F Home', 'Home', 'Home', 'frontend', 1, 1, NULL),
	(13, 120, 'FPH UUD45', 'UUD 1945', 'UUD 1945', 'frontend/produk_hukum_per_kategori/3', 1, 1, NULL),
	(14, 120, 'FPH UU/Perpu', 'UU/Perpu', 'UU/Perpu', 'frontend/produk_hukum_per_kategori/4', 2, 1, NULL),
	(15, 120, 'FPH Peraturan Pemerintah', 'Peraturan Pemerintah', 'FPH Peraturan Pemerintah', 'frontend/produk_hukum_per_kategori/5', 3, 1, NULL),
	(16, 120, 'FPH Peraturan Presiden', 'Peraturan Presiden', 'Peraturan Presiden', 'frontend/produk_hukum_per_kategori/6', 4, 1, NULL),
	(17, 120, 'FPH Peraturan Bersama Antara Mahkamah Agung dengan Komisi Yudisial', 'Peraturan Bersama Antara Mahkamah Agung dengan Komisi Yudisial', 'Peraturan Bersama Antara Mahkamah Agung dengan Komisi Yudisial', 'frontend/produk_hukum_per_kategori/7', 5, 1, NULL),
	(18, 120, 'FPH Peraturan Komisi Yudisial', 'Peraturan Komisi Yudisial', 'Peraturan Komisi Yudisial', 'frontend/produk_hukum_per_kategori/8', 6, 1, NULL),
	(19, 120, 'FPH Peraturan Sekretaris Jenderal Komisi Yudisial', 'Peraturan Sekretaris Jenderal Komisi Yudisial', 'Peraturan Sekretaris Jenderal Komisi Yudisial', 'frontend/produk_hukum_per_kategori/9', 7, 1, NULL),
	(20, 100, 'F Profil', 'Profil', 'Profil', '#', 3, 1, NULL),
	(21, 100, 'F Kontak', 'Kontak', 'Kontak', 'frontend/kontak', 4, 1, NULL),
	(100, NULL, 'Frontend', 'Frontend', 'Frontend', NULL, 0, 1, NULL),
	(120, 100, 'F Produk Hukum', 'Produk Hukum', 'Produk Hukum', 'frontend/produk_hukum_per_kategori', 2, 1, NULL),
	(122, 0, 'Konten Statis', 'Konten Statis', 'Konten Statis', 'Konten_statis', 4, 1, '<i class="fa fa-desktop"></i>'),
	(123, 20, 'FP Sekilas JDIH', 'Sekilas JDIH', 'Sekilas JDIH', 'frontend/konten_statis/sekilas_jdih', 999, 1, NULL),
	(124, 20, 'FP Tupoksi', 'Tupoksi', 'Tupoksi', 'frontend/konten_statis/tupoksi_jdih', 999, 1, NULL),
	(125, 20, 'FP Struktur Organisasi', 'Struktur Organisasi', 'Struktur Organisasi', 'frontend/konten_statis/struktur_organisasi_jdih', 999, 1, NULL),
	(126, NULL, 'FP Visi dan Misi', 'Visi dan Misi', 'Visi dan Misi', 'frontend/konten_statis/visi_misi_jdih', 999, 1, NULL),
	(127, 100, 'F Proleg KY', 'Proleg KY', 'Proleg KY', 'frontend/konten_statis/proleg_ky', 3, 1, NULL),
	(128, 5, 'Form Pengajuan', 'Form Pengajuan', 'Form Pengajuan', 'permohonan/form_pengajuan', 4, 1, '<i class="fa fa-mail-forward"></i>'),
	(129, 0, 'Administrasi', 'Administrasi', 'Administrasi', NULL, 10, 1, '<i class="fa fa-cog"></i>'),
	(130, 129, 'Master User', 'Master User', 'Master User', 'sys_user', 1, 1, '<i class="fa fa-users"></i>'),
	(131, 129, 'Global Variabel', 'Global Variabel', 'Global Variabel', 'sys_globalvar', 2, 1, '<i class="fa fa-globe"></i>'),
	(132, 129, 'Permohonan Status', 'Permohonan Status', NULL, 'permohonan_status', 50, 1, '<i class="fa fa-info"></i>'),
	(133, 100, 'F Sunprokum', 'Sunprokum', 'Sunprokum', 'login', 5, 1, NULL),
	(134, 129, 'Admin Slide Show', 'Slide Show', 'Slide Show', 'slideshow', 60, 1, '<i class="fa fa-picture-o"></i>');
/*!40000 ALTER TABLE `sys_sitemap` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;


-- view
create or replace view sys_privilege_view as 
select		x.sitemapid, x.roleid, x.dateinput, x.dateupdate, x.userinput, x.userupdate,
			y.sitemapid_parent, y.name, y.url, y.sortno, y.is_active, y.icon, y.displayname,
            z.name as role_name
from		sys_privilege x
left join	sys_sitemap y on x.sitemapid = y.sitemapid
left join	sys_role z  on z.roleid = x.roleid
;
create or replace view produk_hukum_komentar_count_view as
select		x.id_produk_hukum, count(x.id_produk_hukum) as total
from			produk_hukum_komentar x
where			x.publish = 'Y'
group by		x.id_produk_hukum
;
create or replace view sys_attach_dtl_view as
select		x.recid, x.attachid, x.title,
				x.description, x.filename, x.filetype,
				x.filesize, x.tumbnail, x.remarks,
				round((x.filesize),0) as filesize_kb
from			sys_attach_dtl x
;
create or replace view konten_statis_view as
select		x.recid, x.nama, x.judul, x.isi,
				x.id_gambar, x.id_dokumen,  
				x.dateinput, x.dateupdate, x.userinput, x.userupdate,
				y.filename
from			konten_statis x
left join	sys_attach_dtl y on y.attachid = x.id_gambar
;
create or replace view permohonan_view as
select		x.id_permohonan, x.user_id, x.id_kategori, x.id_permohonan_status,
				x.no_permohonan, x.tanggal, x.pengusul, x.judul, x.no_nota_dinas, x.tanggal_nota_dinas,
				x.id_dok_notadinas, x.id_dok_position_paper, x.id_dok_draft_rancangan, 
				x.id_dok_tahap_pembahasan,
				x.notes, x.dateupdate, x.userupdate,
				y.`status`,
				z.kategori,
				dnd.filename as berkas_nota_dinas,
				dpp.filename as berkas_position_paper,
				ddr.filename as berkas_draft_rancangan,
				dtb.filename as berkas_tahap_pembahasan,
				concat(mid(x.tanggal,9,2), '-', 
				mid(x.tanggal,6,2), '-' ,
				left(x.tanggal,4), ' ', 
				right(x.tanggal,8)) as tanggal_char
from 			permohonan x
left join	permohonan_status y on y.id_permohonan_status = x.id_permohonan_status
left join	produk_hukum_kategori z on z.id_kategori = x.id_kategori
left join	sys_attach_dtl dnd on dnd.attachid = x.id_dok_notadinas
left join	sys_attach_dtl dpp on dpp.attachid = x.id_dok_position_paper
left join	sys_attach_dtl ddr on ddr.attachid = x.id_dok_draft_rancangan
left join	sys_attach_dtl dtb on dtb.attachid = x.id_dok_tahap_pembahasan
;
create or replace view permohonan_status_h_view as
select		x.recid, x.id_permohonan, x.id_permohonan_status,
				x.notes, x.dateinput, x.userinput,
				y.`status`,
				z.pengusul, z.judul,
				concat(mid(x.dateinput,9,2), '-', 
				mid(x.dateinput,6,2), '-' ,
				left(x.dateinput,4)) as dateinput_char,
				right(x.dateinput,8) as timeinput_char,
				x.id_berkas
from			permohonan_status_h x
left join	permohonan_status y on y.id_permohonan_status = x.id_permohonan_status
left join	permohonan z on z.id_permohonan = x.id_permohonan
;
create or replace  view produk_hukum_view as
select		x.tanggal,
				year(x.tanggal) as tahun,
				x.id_produk_hukum, x.id_kategori,  x.produk_hukum, x.judul,
				x.subjudul, x.abstrak, x.isi, x.catatan, x.id_dokumen,  x.dateinput, 
				x.userinput, x.dateupdate, x.userupdate,
				k.kategori,
				ui.fullname as userinput_name,
				uu.fullname as userupdate_name,
				ifnull(kk.total,0) as total_komentar
from			produk_hukum x
left join	produk_hukum_kategori k on k.id_kategori = x.id_kategori
left join	auth_users ui on ui.user_id = x.userinput
left join	auth_users uu on uu.user_id = x.userinput
left join	produk_hukum_komentar_count_view kk on kk.id_produk_hukum = x.id_produk_hukum
;