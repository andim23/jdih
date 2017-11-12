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


-- Dumping database structure for db_jdih
DROP DATABASE IF EXISTS `db_jdih`;
CREATE DATABASE IF NOT EXISTS `db_jdih` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `db_jdih`;

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
) ENGINE=MyISAM AUTO_INCREMENT=342 DEFAULT CHARSET=utf8;

-- Dumping data for table db_jdih.auth_login_errors: 0 rows
/*!40000 ALTER TABLE `auth_login_errors` DISABLE KEYS */;
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

-- Dumping data for table db_jdih.auth_sessions: 0 rows
/*!40000 ALTER TABLE `auth_sessions` DISABLE KEYS */;
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
  `user_id` int(10) unsigned NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table db_jdih.auth_users: ~1 rows (approximately)
/*!40000 ALTER TABLE `auth_users` DISABLE KEYS */;
INSERT INTO `auth_users` (`user_id`, `username`, `email`, `auth_level`, `banned`, `passwd`, `passwd_recovery_code`, `passwd_recovery_date`, `passwd_modified_at`, `last_login`, `created_at`, `modified_at`) VALUES
	(1, 'admin', 'admin@email.com', 1, '0', '$2y$11$eAiQVPLDrbemhQrkb0qt1.Ac3Nhb1pmdgOBbPbgstYIngb1m9NACO', NULL, NULL, NULL, '2017-10-29 16:51:29', '2017-10-28 08:06:14', '2017-10-29 23:51:29');
/*!40000 ALTER TABLE `auth_users` ENABLE KEYS */;

-- Dumping structure for table db_jdih.produk_hukum
DROP TABLE IF EXISTS `produk_hukum`;
CREATE TABLE IF NOT EXISTS `produk_hukum` (
  `id_produk_hukum` int(11) NOT NULL AUTO_INCREMENT,
  `id_kategori` int(11) NOT NULL,
  `tahun` int(11) NOT NULL,
  `produk_hukum` varchar(255) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `subjudul` varchar(255) NOT NULL,
  `abstrak` text NOT NULL,
  `isi` text NOT NULL,
  `catatan` text NOT NULL,
  `id_dokumen` int(11) NOT NULL,
  `dateinput` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `userinput` varchar(50) NOT NULL,
  `dateupdate` date NOT NULL,
  `userupdate` varchar(50) NOT NULL,
  PRIMARY KEY (`id_produk_hukum`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Dumping data for table db_jdih.produk_hukum: ~1 rows (approximately)
/*!40000 ALTER TABLE `produk_hukum` DISABLE KEYS */;
INSERT INTO `produk_hukum` (`id_produk_hukum`, `id_kategori`, `tahun`, `produk_hukum`, `judul`, `subjudul`, `abstrak`, `isi`, `catatan`, `id_dokumen`, `dateinput`, `userinput`, `dateupdate`, `userupdate`) VALUES
	(1, 7, 1998, 'xx', 'xs', 'xs', 'xs', 'xs', 'xs', 0, '2017-10-29 23:23:46', '1', '2017-10-29', '1');
/*!40000 ALTER TABLE `produk_hukum` ENABLE KEYS */;

-- Dumping structure for table db_jdih.produk_hukum_kategori
DROP TABLE IF EXISTS `produk_hukum_kategori`;
CREATE TABLE IF NOT EXISTS `produk_hukum_kategori` (
  `id_kategori` int(11) NOT NULL AUTO_INCREMENT,
  `kategori` varchar(255) NOT NULL,
  `deskripsi` text,
  `dateinput` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `userinput` varchar(50) NOT NULL,
  `dateupdate` date NOT NULL,
  `userupdate` varchar(50) NOT NULL,
  PRIMARY KEY (`id_kategori`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- Dumping data for table db_jdih.produk_hukum_kategori: ~7 rows (approximately)
/*!40000 ALTER TABLE `produk_hukum_kategori` DISABLE KEYS */;
INSERT INTO `produk_hukum_kategori` (`id_kategori`, `kategori`, `deskripsi`, `dateinput`, `userinput`, `dateupdate`, `userupdate`) VALUES
	(3, 'Undang-Undang Dasar Negara Republik Indonesia Tahun 1945', 'Undang-Undang Dasar Negara Republik Indonesia Tahun 1945', '2017-10-29 23:07:08', '1', '0000-00-00', ''),
	(4, 'Undang-Undang/Peraturan Pemerintah Pengganti Undang-Undang (Perppu)', 'Undang-Undang/Peraturan Pemerintah Pengganti Undang-Undang (Perppu)', '2017-10-29 23:07:24', '1', '0000-00-00', ''),
	(5, 'Peraturan Pemerintah', 'Peraturan Pemerintah', '2017-10-29 23:07:32', '1', '0000-00-00', ''),
	(6, 'Peraturan Presiden', '', '2017-10-29 23:07:56', '1', '0000-00-00', ''),
	(7, 'Peraturan Bersama Antara Mahkamah Agung dengan Komisi Yudisial', '', '2017-10-29 23:08:04', '1', '0000-00-00', ''),
	(8, 'Peraturan Komisi Yudisial', '', '2017-10-29 23:08:11', '1', '0000-00-00', ''),
	(9, 'Peraturan Sekretaris Jenderal Komisi Yudisial', '', '2017-10-29 23:08:17', '1', '0000-00-00', '');
/*!40000 ALTER TABLE `produk_hukum_kategori` ENABLE KEYS */;

-- Dumping structure for table db_jdih.produk_hukum_komentar
DROP TABLE IF EXISTS `produk_hukum_komentar`;
CREATE TABLE IF NOT EXISTS `produk_hukum_komentar` (
  `id_komentar` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `komentar` text NOT NULL,
  `dateinput` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_komentar`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table db_jdih.produk_hukum_komentar: ~0 rows (approximately)
/*!40000 ALTER TABLE `produk_hukum_komentar` DISABLE KEYS */;
/*!40000 ALTER TABLE `produk_hukum_komentar` ENABLE KEYS */;

-- Dumping structure for table db_jdih.sys_attach
DROP TABLE IF EXISTS `sys_attach`;
CREATE TABLE IF NOT EXISTS `sys_attach` (
  `attachid` bigint(20) NOT NULL AUTO_INCREMENT,
  `dateinput` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `userinput` varchar(50) NOT NULL,
  PRIMARY KEY (`attachid`)
) ENGINE=InnoDB AUTO_INCREMENT=8596 DEFAULT CHARSET=utf8;

-- Dumping data for table db_jdih.sys_attach: ~0 rows (approximately)
/*!40000 ALTER TABLE `sys_attach` DISABLE KEYS */;
/*!40000 ALTER TABLE `sys_attach` ENABLE KEYS */;

-- Dumping structure for table db_jdih.sys_attach_dtl
DROP TABLE IF EXISTS `sys_attach_dtl`;
CREATE TABLE IF NOT EXISTS `sys_attach_dtl` (
  `recid` bigint(20) NOT NULL AUTO_INCREMENT,
  `attachid` bigint(20) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` varchar(500) DEFAULT NULL,
  `filename` varchar(500) NOT NULL,
  `tumbnail` varchar(500) DEFAULT NULL,
  `remarks` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`recid`),
  KEY `sys_attach_dtl_2_sys_attach_FK` (`attachid`),
  CONSTRAINT `sys_attach_dtl_2_sys_attach_FK` FOREIGN KEY (`attachid`) REFERENCES `sys_attach` (`attachid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8596 DEFAULT CHARSET=utf8;

-- Dumping data for table db_jdih.sys_attach_dtl: ~0 rows (approximately)
/*!40000 ALTER TABLE `sys_attach_dtl` DISABLE KEYS */;
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
  `dateinput` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `userinput` varchar(50) NOT NULL,
  `dateupdate` datetime DEFAULT NULL,
  `userupdate` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`varid`),
  UNIQUE KEY `varname` (`varname`)
) ENGINE=InnoDB AUTO_INCREMENT=79 DEFAULT CHARSET=utf8;

-- Dumping data for table db_jdih.sys_globalvar: ~0 rows (approximately)
/*!40000 ALTER TABLE `sys_globalvar` DISABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- Dumping data for table db_jdih.sys_log_type: ~0 rows (approximately)
/*!40000 ALTER TABLE `sys_log_type` DISABLE KEYS */;
/*!40000 ALTER TABLE `sys_log_type` ENABLE KEYS */;

-- Dumping structure for table db_jdih.sys_privilege
DROP TABLE IF EXISTS `sys_privilege`;
CREATE TABLE IF NOT EXISTS `sys_privilege` (
  `privilegeid` bigint(20) NOT NULL AUTO_INCREMENT,
  `roleid` bigint(20) NOT NULL,
  `sitemapid` bigint(20) NOT NULL,
  `dateinput` datetime DEFAULT CURRENT_TIMESTAMP,
  `userinput` varchar(50) NOT NULL,
  `dateupdate` datetime DEFAULT NULL,
  `userupdate` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`privilegeid`),
  KEY `sys_privilege_2_sys_sitemap_fk` (`sitemapid`),
  KEY `sys_privilege_2_sys_role_fk` (`roleid`),
  CONSTRAINT `sys_privilege_2_sys_role_fk` FOREIGN KEY (`roleid`) REFERENCES `sys_role` (`roleid`),
  CONSTRAINT `sys_privilege_2_sys_sitemap_fk` FOREIGN KEY (`sitemapid`) REFERENCES `sys_sitemap` (`sitemapid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=865 DEFAULT CHARSET=utf8;

-- Dumping data for table db_jdih.sys_privilege: ~7 rows (approximately)
/*!40000 ALTER TABLE `sys_privilege` DISABLE KEYS */;
INSERT INTO `sys_privilege` (`privilegeid`, `roleid`, `sitemapid`, `dateinput`, `userinput`, `dateupdate`, `userupdate`) VALUES
	(1, 1, 1, '2017-10-29 21:27:37', '1', '2017-10-29 21:27:44', NULL),
	(2, 1, 2, '2017-10-29 21:54:04', '1', NULL, NULL),
	(3, 1, 3, '2017-10-29 21:59:05', '1', NULL, NULL),
	(4, 1, 4, '2017-10-29 22:57:57', '1', NULL, NULL),
	(5, 1, 5, '2017-10-29 23:28:57', '1', NULL, NULL),
	(6, 1, 6, '2017-10-29 23:29:06', '1', NULL, NULL),
	(7, 1, 7, '2017-10-29 23:29:25', '1', NULL, NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- Dumping data for table db_jdih.sys_role: ~1 rows (approximately)
/*!40000 ALTER TABLE `sys_role` DISABLE KEYS */;
INSERT INTO `sys_role` (`roleid`, `name`, `displayname`, `description`) VALUES
	(1, 'admin', 'Administrator', 'Administrator');
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
) ENGINE=InnoDB AUTO_INCREMENT=144 DEFAULT CHARSET=utf8;

-- Dumping data for table db_jdih.sys_sitemap: ~7 rows (approximately)
/*!40000 ALTER TABLE `sys_sitemap` DISABLE KEYS */;
INSERT INTO `sys_sitemap` (`sitemapid`, `sitemapid_parent`, `name`, `displayname`, `titlebar`, `url`, `sortno`, `is_active`, `icon`) VALUES
	(1, 0, 'Home', 'Home', 'Home', 'page', 1, 1, NULL),
	(2, 0, 'Produk Hukum', 'Produk Hukum', 'Produk Hukum', '', 2, 1, NULL),
	(3, 2, 'Jenis Produk Hukum', 'Jenis', 'Jenis', 'Produk_hukum_kategori', 1, 1, NULL),
	(4, 2, 'Produk Hukum Data', 'Produk Hukum', 'Produk Hukum', 'Produk_hukum', 2, 1, NULL),
	(5, 0, 'Permohonan', 'Permohonan', 'tahun', NULL, 3, 1, NULL),
	(6, 5, 'Daftar Pemohon', 'Pemohon', 'Pemohon', NULL, 1, 1, NULL),
	(7, 5, 'Status Permohonan', 'Status Permohonan', 'Status Permohonan', NULL, 2, 1, NULL);
/*!40000 ALTER TABLE `sys_sitemap` ENABLE KEYS */;

-- Dumping structure for table db_jdih.sys_user
DROP TABLE IF EXISTS `sys_user`;
CREATE TABLE IF NOT EXISTS `sys_user` (
  `userid` bigint(20) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `userpass` varchar(255) NOT NULL,
  `useremail` varchar(255) NOT NULL,
  `nickname` varchar(50) NOT NULL,
  `fullname` varchar(500) NOT NULL,
  `usertelpno` varchar(50) DEFAULT NULL,
  `userphoto` varchar(255) DEFAULT NULL,
  `roleid` bigint(20) NOT NULL,
  `provid` bigint(20) DEFAULT NULL,
  `kabid` bigint(20) DEFAULT NULL,
  `dinasid` bigint(20) DEFAULT NULL,
  `idsatker` bigint(20) DEFAULT NULL,
  `dateinput` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `userinput` varchar(50) NOT NULL,
  `dateupdate` datetime DEFAULT NULL,
  `userupdate` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`userid`),
  UNIQUE KEY `sys_user_UQ2` (`useremail`),
  UNIQUE KEY `sys_user_UQ1` (`username`),
  KEY `sys_user_2_sys_role_fk` (`roleid`),
  KEY `sys_user_2_ms_dinas_FK` (`dinasid`),
  CONSTRAINT `sys_user_2_ms_dinas_FK` FOREIGN KEY (`dinasid`) REFERENCES `ms_dinas` (`dinasid`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `sys_user_2_sys_role_fk` FOREIGN KEY (`roleid`) REFERENCES `sys_role` (`roleid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1978 DEFAULT CHARSET=utf8;

-- Dumping data for table db_jdih.sys_user: ~0 rows (approximately)
/*!40000 ALTER TABLE `sys_user` DISABLE KEYS */;
/*!40000 ALTER TABLE `sys_user` ENABLE KEYS */;

-- Dumping structure for table db_jdih.sys_user_log
DROP TABLE IF EXISTS `sys_user_log`;
CREATE TABLE IF NOT EXISTS `sys_user_log` (
  `logid` bigint(20) NOT NULL AUTO_INCREMENT,
  `logtypeid` bigint(20) NOT NULL,
  `userid` bigint(20) NOT NULL,
  `sitemapid` bigint(20) NOT NULL,
  `logdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `action` varchar(255) DEFAULT NULL,
  `freetext` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`logid`),
  KEY `sys_user_log_2_sys_sitemap_fk` (`sitemapid`),
  KEY `sys_user_log_2_sys_user_fk` (`userid`),
  KEY `sys_user_log_2_sys_log_type_FK` (`logtypeid`),
  CONSTRAINT `sys_user_log_2_sys_log_type_FK` FOREIGN KEY (`logtypeid`) REFERENCES `sys_log_type` (`logtypeid`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `sys_user_log_2_sys_sitemap_fk` FOREIGN KEY (`sitemapid`) REFERENCES `sys_sitemap` (`sitemapid`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `sys_user_log_2_sys_user_fk` FOREIGN KEY (`userid`) REFERENCES `sys_user` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=162 DEFAULT CHARSET=utf8;

-- Dumping data for table db_jdih.sys_user_log: ~0 rows (approximately)
/*!40000 ALTER TABLE `sys_user_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `sys_user_log` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;




-- view view --
create or replace view sys_privilege_view as 
select		x.sitemapid, x.roleid, x.dateinput, x.dateupdate, x.userinput, x.userupdate,
			y.sitemapid_parent, y.name, y.url, y.sortno, y.is_active, y.icon, y.displayname,
            z.name as role_name
from		sys_privilege x
left join	sys_sitemap y on x.sitemapid = y.sitemapid
left join	sys_role z  on z.roleid = x.roleid
;

create or replace  view produk_hukum_view as
select		x.tahun,
				x.id_produk_hukum, x.id_kategori,  x.produk_hukum, x.judul,
				x.subjudul, x.abstrak, x.isi, x.catatan, x.id_dokumen,  x.dateinput, 
				x.userinput, x.dateupdate, x.userupdate,
				k.kategori
from			produk_hukum x
left join	produk_hukum_kategori k on k.id_kategori = x.id_kategori
;


