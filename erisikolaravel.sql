-- --------------------------------------------------------
-- Host:                         localhost
-- Server version:               5.7.24 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table erisikolaravel.borangdaftarrisiko
CREATE TABLE IF NOT EXISTS `borangdaftarrisiko` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kod_keluaran` text NOT NULL,
  `bahagian` text NOT NULL,
  `proses` text NOT NULL,
  `disediakan_oleh` text NOT NULL,
  `disahkan_oleh` text NOT NULL,
  `tarikh_dikemaskini` date DEFAULT NULL,
  `terkini` tinyint(4) NOT NULL DEFAULT '0' COMMENT '//boolean',
  `sejarah` tinyint(4) NOT NULL DEFAULT '0' COMMENT '//boolean',
  `tarikh_disemak_bermula` date DEFAULT NULL,
  `tarikh_disemak_berakhir` date DEFAULT NULL,
  `status_hantar` int(11) DEFAULT NULL COMMENT '0) belum dihantar ke jk | 1) telah dihantar ke jk',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table erisikolaravel.borangdaftarrisiko: ~2 rows (approximately)
/*!40000 ALTER TABLE `borangdaftarrisiko` DISABLE KEYS */;
INSERT INTO `borangdaftarrisiko` (`id`, `kod_keluaran`, `bahagian`, `proses`, `disediakan_oleh`, `disahkan_oleh`, `tarikh_dikemaskini`, `terkini`, `sejarah`, `tarikh_disemak_bermula`, `tarikh_disemak_berakhir`, `status_hantar`) VALUES
	(1, '01', 'Pejabat Pendaftar', 'Pengurusan Sumber Manusia', 'Pemegang Prosedur, BPD', 'Pengerusi Jawatankuasa Risiko, BPD', '2019-11-27', 1, 0, '2020-09-19', '2020-09-22', NULL),
	(2, '02', 'Pejabat Pendaftar', 'Pengurusan Sumber Manusia', 'Pemegang Prosedur, BPD', 'Pengerusi Jawatankuasa Risiko, BPD', NULL, 0, 0, '2020-09-17', '2020-09-25', NULL);
/*!40000 ALTER TABLE `borangdaftarrisiko` ENABLE KEYS */;

-- Dumping structure for table erisikolaravel.daftarrisiko
CREATE TABLE IF NOT EXISTS `daftarrisiko` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `borangdaftarrisiko_id` int(11) NOT NULL,
  `no_rujukan` text,
  `isu_id` int(11) NOT NULL DEFAULT '0',
  `keterangan` text,
  `punca` text,
  `impak_kesan` text,
  `kawalan` text,
  `kebarangkalian` int(11) DEFAULT NULL,
  `impak` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `borangdaftarrisiko_FK` (`borangdaftarrisiko_id`),
  KEY `isu_FK` (`isu_id`),
  CONSTRAINT `borangdaftarrisiko_FK` FOREIGN KEY (`borangdaftarrisiko_id`) REFERENCES `borangdaftarrisiko` (`id`),
  CONSTRAINT `isu_FK` FOREIGN KEY (`isu_id`) REFERENCES `isu` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- Dumping data for table erisikolaravel.daftarrisiko: ~5 rows (approximately)
/*!40000 ALTER TABLE `daftarrisiko` DISABLE KEYS */;
INSERT INTO `daftarrisiko` (`id`, `borangdaftarrisiko_id`, `no_rujukan`, `isu_id`, `keterangan`, `punca`, `impak_kesan`, `kawalan`, `kebarangkalian`, `impak`) VALUES
	(1, 1, 'BPD01', 1, 'Perancangan sumber manusia tidak selari dengan keperluan universiti', 'Perubahan dasar dan peraturan secara drastik\r\n', '1. Pengoperasian PTJ terjejas <br>\r\n2. Penyampaian perkhidmatan terjejas <br>\r\n3. Aduan pelanggan meningkat', '1. Kelulusan pengisian semula jawatan dibuat secara manual yang melibatkan perbincangan dengan PTJ berkaitan. <br>\r\n2. Sesi runding cara pengoptimuman sumber manusia. <br>\r\n3. Semakan pengukuhan tadbir urus sumber manusia di seluruh sistem UiTM <br>\r\n4. Pembangunan formula keperluan pensyarah', 2, 4),
	(3, 2, 'BPD02', 3, 'Bayaran emolumen kepada staf terjejas dan berlaku peningkatan kos sumber manusia menggunakan peruntukan dalaman (hasil) UiTM', 'test1', 'teset2', 'tes2', 2, 4),
	(4, 1, 'BPD03', 8, 'Peningkatan attrition rate di kalangan generasi muda', NULL, NULL, NULL, 1, 3),
	(5, 1, 'BPD06', 7, 'Kerosakan harta hak milik pelanggan', NULL, NULL, NULL, 4, 3),
	(6, 1, 'BPD08', 10, 'Ketirisan maklumat dan data sumber manusia', NULL, NULL, NULL, 5, 3),
	(7, 1, 'BPD08', 10, 'Ketirisan maklumat dan data sumber manusia', NULL, NULL, NULL, 5, 3);
/*!40000 ALTER TABLE `daftarrisiko` ENABLE KEYS */;

-- Dumping structure for table erisikolaravel.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table erisikolaravel.failed_jobs: ~0 rows (approximately)
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;

-- Dumping structure for table erisikolaravel.isu
CREATE TABLE IF NOT EXISTS `isu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_konteks_organisasi` int(11) NOT NULL,
  `perkara` text,
  `isu` text,
  `kesan` text,
  `jenis` int(11) NOT NULL DEFAULT '0' COMMENT '0 = dalaman, 1 = luaran',
  PRIMARY KEY (`id`),
  KEY `konteks_organisasi` (`id_konteks_organisasi`),
  CONSTRAINT `konteks_organisasi` FOREIGN KEY (`id_konteks_organisasi`) REFERENCES `konteks_organisasi` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=187 DEFAULT CHARSET=latin1;

-- Dumping data for table erisikolaravel.isu: ~9 rows (approximately)
/*!40000 ALTER TABLE `isu` DISABLE KEYS */;
INSERT INTO `isu` (`id`, `id_konteks_organisasi`, `perkara`, `isu`, `kesan`, `jenis`) VALUES
	(1, 1, 'Politik', '- Perubahan pucuk kepimpinan negara <br>\r\n- Perubahan dasar dan peraturan secara drastik ', '- Proses pelantikan Pengerusi Lembaga Pengarah Universiti/ Pengurusan Universiti tertangguh <br>\r\n- Proses pembuatan keputusan tertangguh  <br>\r\n- Perancangan sumber manusia tidak selari dengan keperluan semasa universiti\r\n', 1),
	(2, 3, 'Politik', '- Kawalan Saiz Perkhidmatan Awam (KSPA)', '- Pengisian jawatan tidak dapat memenuhi keperluan perjawatan sebenar <br>\r\n- Pengurangan kelulusan waran dari Agensi Pusat', 1),
	(3, 1, 'Ekonomi', '- Dasar pemulihan ekonomi negara berikutan penularan penyakit berjangkit', '- Penurunan hasil pendapatan universiti <br>\r\n- Peningkatan kos operasi pengurusan sumber manusia ', 1),
	(4, 3, 'Ekonomi', '- Dasar kerajaan mengurangkan belanja mengurus ', '- Peruntukan dan perbelanjaan dikawal <br>\r\n- Pembayaran kerja lebih masa dikawal  <br>\r\n- Bayaran emolumen dan kemudahan kepada staf UiTM berkemungkinan terjejas\r\n', 1),
	(5, 3, 'Teknologi', '- Penyalahgunaan teknologi (hackers) <br>\r\n- Cyber Security\r\n', '- Penggodaman sistem maklumat sumber manusia dan pelajar UiTM <br>\r\n- Penularan maklumat yang tidak tepat <br>\r\n- Duplikasi skrol dan transkrip akademik palsu <br>\r\n- Manipulasi data / maklumat', 1),
	(7, 1, 'Infrastruktur', '- Kerosakan alat pendingin hawa dan bumbung serta paip bocor', '- Mengakibatkan kerosakan fail, dokumen dan harta pelanggan ', 0),
	(8, 3, 'Sosial', '- Komunikasi merentas budaya / bangsa', '- Penyampaian maklumat kurang berkesan terutamanya melibatkan bukan warganegara Malaysia', 1),
	(9, 1, 'Politik', '- Tuntutan kepada pematuhan dasar Agensi Pusat  ', '- Kelewatan sesuatu keputusan dikeluarkan dan imej jabatan tercalar ', 1),
	(10, 1, 'Sistem Kerja/Operasi', '- Pelaksanaan proses kerja secara manual dan kawalan / data kurang sistematik', '- Ketirisan maklumat dan data sumber manusia <br>\r\n- Kelewatan proses  <br>\r\n- Data yang kurang tepat <br>\r\n- Kelewatan dalam menyedia/menyemak/mengesah sesuatu proses \r\n', 0),
	(179, 54, 'Politik', '- Kawalan Saiz Perkhidmatan Awam (KSPA)', '- Pengisian jawatan tidak dapat memenuhi keperluan perjawatan sebenar <br>\r\n- Pengurangan kelulusan waran dari Agensi Pusat', 1),
	(180, 54, 'Ekonomi', '- Dasar kerajaan mengurangkan belanja mengurus ', '- Peruntukan dan perbelanjaan dikawal <br>\r\n- Pembayaran kerja lebih masa dikawal  <br>\r\n- Bayaran emolumen dan kemudahan kepada staf UiTM berkemungkinan terjejas\r\n', 1),
	(181, 54, 'Teknologi', '- Penyalahgunaan teknologi (hackers) <br>\r\n- Cyber Security\r\n', '- Penggodaman sistem maklumat sumber manusia dan pelajar UiTM <br>\r\n- Penularan maklumat yang tidak tepat <br>\r\n- Duplikasi skrol dan transkrip akademik palsu <br>\r\n- Manipulasi data / maklumat', 1),
	(182, 54, 'Sosial', '- Komunikasi merentas budaya / bangsa', '- Penyampaian maklumat kurang berkesan terutamanya melibatkan bukan warganegara Malaysia', 1),
	(183, 55, 'Politik', '- Kawalan Saiz Perkhidmatan Awam (KSPA)', '- Pengisian jawatan tidak dapat memenuhi keperluan perjawatan sebenar <br>\r\n- Pengurangan kelulusan waran dari Agensi Pusat', 1),
	(184, 55, 'Ekonomi', '- Dasar kerajaan mengurangkan belanja mengurus ', '- Peruntukan dan perbelanjaan dikawal <br>\r\n- Pembayaran kerja lebih masa dikawal  <br>\r\n- Bayaran emolumen dan kemudahan kepada staf UiTM berkemungkinan terjejas\r\n', 1),
	(185, 55, 'Teknologi', '- Penyalahgunaan teknologi (hackers) <br>\r\n- Cyber Security\r\n', '- Penggodaman sistem maklumat sumber manusia dan pelajar UiTM <br>\r\n- Penularan maklumat yang tidak tepat <br>\r\n- Duplikasi skrol dan transkrip akademik palsu <br>\r\n- Manipulasi data / maklumat', 1),
	(186, 55, 'Sosial', '- Komunikasi merentas budaya / bangsa', '- Penyampaian maklumat kurang berkesan terutamanya melibatkan bukan warganegara Malaysia', 1);
/*!40000 ALTER TABLE `isu` ENABLE KEYS */;

-- Dumping structure for table erisikolaravel.konteks_organisasi
CREATE TABLE IF NOT EXISTS `konteks_organisasi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dokumen` text COMMENT 'isu / pihak berkepentingan',
  `kod_keluaran` text,
  `tarikh_disahkan` date DEFAULT NULL,
  `tarikh_disemak_bermula` date DEFAULT NULL,
  `tarikh_disemak_berakhir` date DEFAULT NULL,
  `status_hantar` int(11) DEFAULT NULL COMMENT '0) belum dihantar ke jk | 1) telah dihantar ke jk',
  `sejarah` int(11) DEFAULT '0' COMMENT 'boolean',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=latin1;

-- Dumping data for table erisikolaravel.konteks_organisasi: ~9 rows (approximately)
/*!40000 ALTER TABLE `konteks_organisasi` DISABLE KEYS */;
INSERT INTO `konteks_organisasi` (`id`, `dokumen`, `kod_keluaran`, `tarikh_disahkan`, `tarikh_disemak_bermula`, `tarikh_disemak_berakhir`, `status_hantar`, `sejarah`) VALUES
	(1, 'isu', '2/2020', NULL, '2020-09-11', '2020-09-21', 1, 0),
	(2, 'pihakberkepentingan', '2/2020', NULL, '2020-08-21', '2021-01-06', 1, 0),
	(3, 'isu', '1/2020', '2020-08-28', '2020-08-27', '2020-08-26', 1, 0),
	(4, 'pihakberkepentingan', '1/2020', '2020-09-02', '2020-08-27', '2020-08-29', 1, 0),
	(5, 'isu', '6/2019', '2019-08-12', '2019-07-29', '2019-08-10', 1, 1),
	(6, 'isu', '10/2020', NULL, '2020-09-03', '2020-09-19', NULL, 1),
	(7, 'pihakberkepentingan', '10/2020', NULL, '2020-09-03', '2020-09-19', NULL, 0),
	(54, 'isu', '11/2020', NULL, '2020-09-28', '2020-09-30', NULL, 0),
	(55, 'isu', '12/2020', NULL, '2020-09-29', '2020-10-02', NULL, 0),
	(56, 'pihakberkepentingan', '31/2020', NULL, '2020-09-22', '2020-09-23', NULL, 0);
/*!40000 ALTER TABLE `konteks_organisasi` ENABLE KEYS */;

-- Dumping structure for table erisikolaravel.log_semakan_daftarrisiko
CREATE TABLE IF NOT EXISTS `log_semakan_daftarrisiko` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `borangdaftarrisiko_id` int(11) NOT NULL,
  `daftarrisiko_id` int(11) NOT NULL,
  `log_tarikh` date NOT NULL,
  `punca` text NOT NULL,
  `impak_kesan` text NOT NULL,
  `kawalan` text NOT NULL,
  `oleh` varchar(255) DEFAULT '',
  `terakhir` tinytext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Dumping data for table erisikolaravel.log_semakan_daftarrisiko: ~5 rows (approximately)
/*!40000 ALTER TABLE `log_semakan_daftarrisiko` DISABLE KEYS */;
INSERT INTO `log_semakan_daftarrisiko` (`id`, `borangdaftarrisiko_id`, `daftarrisiko_id`, `log_tarikh`, `punca`, `impak_kesan`, `kawalan`, `oleh`, `terakhir`) VALUES
	(1, 2, 3, '2020-09-21', 'aa', 'ss', 'aaa', 'orang', '0'),
	(2, 2, 3, '2020-09-21', 'test12', 'teset2', 'tes2', 'Aqil Khairy Bin Hamsani', '0'),
	(3, 2, 3, '2020-09-21', 'test12', 'teset211', 'tes2', 'Aqil Khairy Bin Hamsani', '0'),
	(4, 2, 3, '2020-09-21', 'test12', 'teset211', 'tes2', 'Aqil Khairy Bin Hamsani', '0'),
	(5, 2, 3, '2020-09-21', 'test12', 'teset211', 'tes2', 'Aqil Khairy Bin Hamsani', '0'),
	(6, 2, 3, '2020-09-21', 'test12', 'teset211', 'tes2aa', 'Aqil Khairy Bin Hamsani', '1');
/*!40000 ALTER TABLE `log_semakan_daftarrisiko` ENABLE KEYS */;

-- Dumping structure for table erisikolaravel.log_semakan_konteks
CREATE TABLE IF NOT EXISTS `log_semakan_konteks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `konteks_organisasi_id` int(11) NOT NULL,
  `dokumen_id` int(11) NOT NULL,
  `log_tarikh` date NOT NULL,
  `oleh` varchar(255) DEFAULT NULL,
  `log_col1` varchar(1000) DEFAULT NULL,
  `log_col2` varchar(1000) DEFAULT NULL,
  `terakhir` tinyint(4) NOT NULL COMMENT '//boolean',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

-- Dumping data for table erisikolaravel.log_semakan_konteks: ~9 rows (approximately)
/*!40000 ALTER TABLE `log_semakan_konteks` DISABLE KEYS */;
INSERT INTO `log_semakan_konteks` (`id`, `konteks_organisasi_id`, `dokumen_id`, `log_tarikh`, `oleh`, `log_col1`, `log_col2`, `terakhir`) VALUES
	(1, 2, 4, '2020-09-21', 'Aqil Khairy Bin Hamsani', '- Meluluskan bajet Universiti dan memastikan Kecukupan Bajet serta Penjanaan dan  Pendanaan Kewangan Universiti. <br>- Pematuhan kepada Syarat Kementerian dan mempertahankan Misi Universiti.<br>- Membangun dan menyemai bakat kepimpinan Universiti dengan memastikan kewujudan Pelan Penggantian Pengurusan Universiti. Maklumat berkaitan Pelan Penggantian Pengurusan Universiti hendaklah kekal sulit dan sebarang perkongsian dengan pihak luar perlulah mendapat kebenaran Lembaga. <br>- Menyelia dan mengasah bakat kepimpinan jawatan Pengurusan Universiti melalui latihan professional berterusan dan memastikan impak latihan memberi manfaat semula kepada universiti. <br>- Menyemak dan memantau prestasi universiti secara berkala terutama dalam mencapai sasaran KPI dan KIP yang telah didokumenkan dalam Perancangan Strategik RMKe-11 Universiti. Lembaga memberi maklumbalas mengenai pencapaian KPI dan KIP.&nbsp;', '- Menyediakan maklumat yang mencukupi bagi pembuatan keputusan yang tepat <br>- Pengantara kepada pengurusan Universiti dan Lembaga Pengarah <br>- Penambahbaikan terhadap sistem tadbir urus universiti <br>- Pematuhan	dalam	pelaksanaan	dasar	dan keputusan <br>- Membangunkan bakat yang kompeten/mahir mengikut garis panduan yang ditetapkan <br>- Tidak berlaku ketirisan', 0),
	(2, 2, 3, '2020-09-21', 'Aqil Khairy Bin Hamsani', '- Memastikan pencapaian prestasi perbelanjaan mengurus dan tanggungan serta pembangunan bertepatan dengan peruntukan tahunan yang diluluskan di bawah kawalan Perbendaharaan Malaysia. <br>- Mengemukakan Surat Kelulusan Perjawatan (SKP) kepada UA sebaik sahaja mendapat kelulusan Kementerian Kewangan Malaysia.', '- Pematuhan kepada dasar,  piawai ke atas penyediaan dan pelaksanaan belanjawan dan menyelaraskan permohonan waran perjawatan Universiti. <br>- Peruntukan kewangan / bayaran penggajian yang secukupnya. <br>- Peruntukan yang disalurkan dapat dibelanjakan secara berhemah. <br>- Pelaksanaan Undang-undang dan Peraturan Kewangan (Kuasa Kewangan, Akta Prosedur Kewangan, Arahan Perbendaharaan, Akta Kontrak, Surat Pekeliling Perbendaharaan, Pekeliling Kontrak Pusat)', 0),
	(3, 2, 4, '2020-09-21', 'Aqil Khairy Bin Hamsani', '- Meluluskan bajet Universiti dan memastikan Kecukupan Bajet serta Penjanaan dan  Pendanaan Kewangan Universiti. <br>- Pematuhan kepada Syarat Kementerian dan mempertahankan Misi Universiti.<br>- Membangun dan menyemai bakat kepimpinan Universiti dengan memastikan kewujudan Pelan Penggantian Pengurusan Universiti. Maklumat berkaitan Pelan Penggantian Pengurusan Universiti hendaklah kekal sulit dan sebarang perkongsian dengan pihak luar perlulah mendapat kebenaran Lembaga. <br>- Menyelia dan mengasah bakat kepimpinan jawatan Pengurusan Universiti melalui latihan professional berterusan dan memastikan impak latihan memberi manfaat semula kepada universiti. <br>- Menyemak dan memantau prestasi universiti secara berkala terutama dalam mencapai sasaran KPI dan KIP yang telah didokumenkan dalam Perancangan Strategik RMKe-11 Universiti. Lembaga memberi maklumbalas mengenai pencapaian KPI dan KIP.', '- Menyediakan maklumat yang mencukupi bagi pembuatan keputusan yang tepat <br>- Pengantara kepada pengurusan Universiti dan Lembaga Pengarah <br>- Penambahbaikan terhadap sistem tadbir urus universiti <br>- Pematuhan	dalam	pelaksanaan	dasar	dan keputusan <br>- Membangunkan bakat yang kompeten/mahir mengikut garis panduan yang ditetapkan <br>- Tidak berlaku ketirisan', 0),
	(4, 2, 4, '2020-09-21', 'Aqil Khairy Bin Hamsani', '- Meluluersiti. Lembaga memberi maklumbalas mengenai pencapaian KPI dan KIP.', '- Menyediakan maklumat yang mencukupi bagi pembuatan keputusan yang tepat <br>- Pengantara kepada pengurusan Universiti dan Lembaga Pengarah <br>- Penambahbaikan terhadap sistem tadbir urus universiti <br>- Pematuhan	dalam	pelaksanaan	dasar	dan keputusan <br>- Membangunkan bakat yang kompeten/mahir mengikut garis panduan yang ditetapkan <br>- Tidak berlaku ketirisan', 0),
	(5, 2, 4, '2020-09-21', 'Aqil Khairy Bin Hamsani', '- Meluluskan bajet Universiti dan memastikan Kecukupan Bajet serta Penjanaan dan  Pendanaan Kewangan Universiti. <br>- Pematuhan kepada Syarat Kementerian dan mempertahankan Misi Universiti.<br>- Membangun dan menyemai bakat kepimpinan Universiti dengan memastikan kewujudan Pelan Penggantian Pengurusan Universiti. Maklumat berkaitan Pelan Penggantian Pengurusan Universiti hendaklah kekal sulit dan sebarang perkongsian dengan pihak luar perlulah mendapat kebenaran Lembaga. <br>- Menyelia dan mengasah bakat kepimpinan jawatan Pengurusan Universiti melalui latihan professional berterusan dan memastikan impak latihan memberi manfaat semula kepada universiti. <br>- Menyemak dan memantau prestasi universiti secara berkala terutama dalam mencapai sasaran KPI dan KIP yang telah didokumenkan dalam Perancangan Strategik RMKe-11 Universiti. Lembaga memberi maklumbalas mengenai pencapaian KPI dan KIP.', '- Menyediakan maklumat yang mencukupi bagi pembuatan keputusan yang tepat <br>- Pengantara kepada pengurusan Universiti dan Lembaga Pengarah <br>- Penambahbaikan terhadap sistem tadbir urus universiti <br>- Pematuhan	dalam	pelaksanaan	dasar	dan keputusan <br>- Membangunkan bakat yang kompeten/mahir mengikut garis panduan yang ditetapkan <br>- Tidak berlaku ketirisan', 0),
	(6, 2, 3, '2020-09-21', 'Aqil Khairy Bin Hamsani', '- Memastikan pencapaian prestasi perbelanjaan mengurus dan tanggungan serta pembangunan bertepatan dengan peruntukan tahunan yang diluluskan di bawah kawalan Perbendaharaan Malaysia. <br>- Mengemukakan Surat Kelulusan Perjawatan (SKP) kepada UA sebaik sahaja mendapat kelulusan Kementerian Kewangan Malaysia.', '- Pematuhan kepada dasar,  piawai ke atas penyediaan dan pelaksanaan belanjawan dan menyelaraskan permohonan waran perjawatan Universiti. <br>- Peruntukan kewangan / bayaran penggajian yang secukupnya. <br>- Peruntukan yang disalurkan dapat dibelanjakan secara berhemah. <br>- Pelaksanaan Undang-undang dan Peraturan Kewangan (Kuasa Kewangan, Akta Prosedur Kewangan, Arahan Perbendaharaan, Akta Kontrak, Surat Pekeliling Perbendaharaan, Pekeliling Kontrak Pusat)', 0),
	(7, 2, 3, '2020-09-21', 'Aqil Khairy Bin Hamsani', '- Memastikan pencapaian prestasi perbelanjaan mengurus dan tanggungan serta pembangunan bertepatan dengan peruntukan tahunan yang diluluskan di bawah kawalan Perbendaharaan Malaysia. <br>- Mengemukakan Surat Kelulusan Perjawatan (SKP) kepada UA sebaik sahaja mendapat kelulusan Kementerian Kewangan Malaysia.', '- Pematuhan kepada dasar,  piawai ke atas penyediaan dan pelaksanaan belanjawan dan menyelaraskan permohonan waran perjawatan Universiti. <br>- Peruntukan kewangan / bayaran penggajian yang secukupnya. <br>- Peruntukan yang disalurkan dapat dibelanjakan secara berhemah. <br>- Pelaksanaan Undang-undang dan Peraturan Kewangan (Kuasa Kewangan, Akta Prosedur Kewangan, Arahan Perbendaharaan, Akta Kontrak, Surat Pekeliling Perbendaharaan, Pekeliling Kontrak Pusat)', 1),
	(8, 1, 7, '2020-09-21', 'Aqil Khairy Bin Hamsani', NULL, NULL, 0),
	(9, 1, 7, '2020-09-21', 'Aqil Khairy Bin Hamsani', NULL, NULL, 0),
	(10, 1, 7, '2020-09-21', 'Aqil Khairy Bin Hamsani', '- Kerosakan alat pendingin hawa dan bumbung serta paip bocor', '- Mengakibatkan kerosakan fail, dokumen dan harta pelanggan', 1),
	(11, 1, 3, '2020-09-21', 'Aqil Khairy Bin Hamsani', '- Dasar pemulihan ekonomi negara berikutan penularan penyakit berjangkit', '- Penurunan hasil pendapatan universiti <br>- Peningkatan kos operasi pengurusan sumber manusia', 1),
	(12, 2, 4, '2020-09-22', 'Aqil Khairy Bin Hamsani', '- Meluluskan bajet Universiti dan memastikan Kecukupan Bajet serta Penjanaan dan  Pendanaan Kewangan Universiti. <br>- Pematuhan kepada Syarat Kementerian dan mempertahankan Misi Universiti.<br>- Membangun dan menyemai bakat kepimpinan Universiti dengan memastikan kewujudan Pelan Penggantian Pengurusan Universiti. Maklumat berkaitan Pelan Penggantian Pengurusan Universiti hendaklah kekal sulit dan sebarang perkongsian dengan pihak luar perlulah mendapat kebenaran Lembaga. <br>- Menyelia dan mengasah bakat kepimpinan jawatan Pengurusan Universiti melalui latihan professional berterusan dan memastikan impak latihan memberi manfaat semula kepada universiti. <br>- Menyemak dan memantau prestasi universiti secara berkala terutama dalam mencapai sasaran KPI dan KIP yang telah didokumenkan dalam Perancangan Strategik RMKe-11 Universiti. Lembaga memberi maklumbalas mengenai pencapaian KPI dan KIP.s', '- Menyediakan maklumat yang mencukupi bagi pembuatan keputusan yang tepat <br>- Pengantara kepada pengurusan Universiti dan Lembaga Pengarah <br>- Penambahbaikan terhadap sistem tadbir urus universiti <br>- Pematuhan	dalam	pelaksanaan	dasar	dan keputusan <br>- Membangunkan bakat yang kompeten/mahir mengikut garis panduan yang ditetapkan <br>- Tidak berlaku ketirisan', 1);
/*!40000 ALTER TABLE `log_semakan_konteks` ENABLE KEYS */;

-- Dumping structure for table erisikolaravel.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table erisikolaravel.migrations: ~3 rows (approximately)
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(13, '2014_10_12_000000_create_users_table', 1),
	(14, '2014_10_12_100000_create_password_resets_table', 1),
	(15, '2019_08_19_000000_create_failed_jobs_table', 1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Dumping structure for table erisikolaravel.password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table erisikolaravel.password_resets: ~0 rows (approximately)
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;

-- Dumping structure for table erisikolaravel.pihak_berkepentingan
CREATE TABLE IF NOT EXISTS `pihak_berkepentingan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_konteks_organisasi` int(11) NOT NULL,
  `pihak_berkepentingan` text,
  `peranan` text,
  `keperluan` text,
  `jenis` int(11) NOT NULL DEFAULT '0' COMMENT '0 = dalaman, 1 = luaran',
  PRIMARY KEY (`id`),
  KEY `FK_konteks_organisasi` (`id_konteks_organisasi`),
  CONSTRAINT `FK_konteks_organisasi` FOREIGN KEY (`id_konteks_organisasi`) REFERENCES `konteks_organisasi` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Dumping data for table erisikolaravel.pihak_berkepentingan: ~4 rows (approximately)
/*!40000 ALTER TABLE `pihak_berkepentingan` DISABLE KEYS */;
INSERT INTO `pihak_berkepentingan` (`id`, `id_konteks_organisasi`, `pihak_berkepentingan`, `peranan`, `keperluan`, `jenis`) VALUES
	(1, 2, 'Kementerian Pengajian Tinggi (KPT)', '- Penetapan hala tuju pendidikan tinggi negara. <br>\r\n- Mewujudkan dasar, sistem kawal selia dan perkhidmatan yang membantu pembangunan pendidikan tinggi yang mantap dan berkualiti selaras dengan dasar pendidikan tinggi dan wawasan negara.\r\n', '- Pengurusan dan pembangunan sumber manusia di UiTM selaras dengan keperluan dan hala tuju Rancangan Malaysia Ke-11 (2016-2020)/ dasar kementerian/PPPM(PT) <br>\r\n- Tenaga kerja yang kompeten dan berkemahiran tinggi bagi memenuhi arus perubahan pendidikan tinggi. <br>\r\n- Setiap tindakan dilaksanakan mematuhi peraturan dan undang-undang berkaitan. <br>\r\n', 1),
	(3, 2, 'Kementerian Kewangan', '- Memastikan pencapaian prestasi perbelanjaan mengurus dan tanggungan serta pembangunan bertepatan dengan peruntukan tahunan yang diluluskan di bawah kawalan Perbendaharaan Malaysia. <br>\r\n- Mengemukakan Surat Kelulusan Perjawatan (SKP) kepada UA sebaik sahaja mendapat kelulusan Kementerian Kewangan Malaysia. \r\n', '- Pematuhan kepada dasar,  piawai ke atas penyediaan dan pelaksanaan belanjawan dan menyelaraskan permohonan waran perjawatan Universiti. <br>\r\n- Peruntukan kewangan / bayaran penggajian yang secukupnya. <br>\r\n- Peruntukan yang disalurkan dapat dibelanjakan secara berhemah. <br>\r\n- Pelaksanaan Undang-undang dan Peraturan Kewangan (Kuasa Kewangan, Akta Prosedur Kewangan, Arahan Perbendaharaan, Akta Kontrak, Surat Pekeliling Perbendaharaan, Pekeliling Kontrak Pusat)\r\n', 1),
	(4, 2, 'Lembaga Pengarah Universiti (LPU)', '- Meluluskan bajet Universiti dan memastikan Kecukupan Bajet serta Penjanaan dan  Pendanaan Kewangan Universiti. <br>\r\n- Pematuhan kepada Syarat Kementerian dan mempertahankan Misi Universiti.<br>\r\n- Membangun dan menyemai bakat kepimpinan Universiti dengan memastikan kewujudan Pelan Penggantian Pengurusan Universiti. Maklumat berkaitan Pelan Penggantian Pengurusan Universiti hendaklah kekal sulit dan sebarang perkongsian dengan pihak luar perlulah mendapat kebenaran Lembaga. <br>\r\n- Menyelia dan mengasah bakat kepimpinan jawatan Pengurusan Universiti melalui latihan professional berterusan dan memastikan impak latihan memberi manfaat semula kepada universiti. <br>\r\n- Menyemak dan memantau prestasi universiti secara berkala terutama dalam mencapai sasaran KPI dan KIP yang telah didokumenkan dalam Perancangan Strategik RMKe-11 Universiti. Lembaga memberi maklumbalas mengenai pencapaian KPI dan KIP.\r\n', '- Menyediakan maklumat yang mencukupi bagi pembuatan keputusan yang tepat <br>\r\n- Pengantara kepada pengurusan Universiti dan Lembaga Pengarah <br>\r\n- Penambahbaikan terhadap sistem tadbir urus universiti <br>\r\n- Pematuhan	dalam	pelaksanaan	dasar	dan keputusan <br>\r\n- Membangunkan bakat yang kompeten/mahir mengikut garis panduan yang ditetapkan <br>\r\n- Tidak berlaku ketirisan', 0),
	(5, 4, 'Pengurusan Eksekutif Universiti', '- Menetapkan polisi, prosedur, sistem pentadbiran serta meluluskan aktiviti utama Universiti termasuk hal ehwal pengurusan dan pembangunan sumber manusia UiTM.', '- Tadbir urus universiti dan sumber manusia dilaksanakan dengan telus dan teratur. <br>\r\n- Perancangan dan pembangunan sumber manusia dilakukan secara telus dan teratur. <br>\r\n- Keputusan yang dibuat tepat dan adil berdasarkan maklumat/data mengikut peraturan berkuatkuasa <br>\r\n- Rekabentuk pengurusan dan pembangunan sumber manusia yang baharu bagi menangani perubahan <br>\r\n- Penggunaan sumber tenaga yang optimum dan tidak berlaku pembaziran', 0),
	(6, 56, 'Pengurusan Eksekutif Universiti', '- Menetapkan polisi, prosedur, sistem pentadbiran serta meluluskan aktiviti utama Universiti termasuk hal ehwal pengurusan dan pembangunan sumber manusia UiTM.', '- Tadbir urus universiti dan sumber manusia dilaksanakan dengan telus dan teratur. <br>\r\n- Perancangan dan pembangunan sumber manusia dilakukan secara telus dan teratur. <br>\r\n- Keputusan yang dibuat tepat dan adil berdasarkan maklumat/data mengikut peraturan berkuatkuasa <br>\r\n- Rekabentuk pengurusan dan pembangunan sumber manusia yang baharu bagi menangani perubahan <br>\r\n- Penggunaan sumber tenaga yang optimum dan tidak berlaku pembaziran', 0);
/*!40000 ALTER TABLE `pihak_berkepentingan` ENABLE KEYS */;

-- Dumping structure for table erisikolaravel.tindakan_risiko
CREATE TABLE IF NOT EXISTS `tindakan_risiko` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `daftarrisiko_id` int(11) NOT NULL,
  `tindakan` text,
  `pelan` text,
  `tarikh_siap` date DEFAULT NULL,
  `peratus_siap` text,
  `pyb` text,
  PRIMARY KEY (`id`),
  KEY `daftarrisiko_FK` (`daftarrisiko_id`),
  CONSTRAINT `daftarrisiko_FK` FOREIGN KEY (`daftarrisiko_id`) REFERENCES `daftarrisiko` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table erisikolaravel.tindakan_risiko: ~2 rows (approximately)
/*!40000 ALTER TABLE `tindakan_risiko` DISABLE KEYS */;
INSERT INTO `tindakan_risiko` (`id`, `daftarrisiko_id`, `tindakan`, `pelan`, `tarikh_siap`, `peratus_siap`, `pyb`) VALUES
	(1, 1, '1. Pemberian akses sistem MyOP/HR2U kepada PTJ bagi membantu PTJ mendapatkan maklumat yang terkini berkaitan perjawatannya <br>\r\n2. Penyusunan semula perjawatan bagi menampung keperluan kritikal sesebuah PTJ berdasarkan norma perjawatan dan formula keperluan pensyarah.', NULL, '2020-04-30', '13', 'KTP JPSM'),
	(2, 1, '3. Tindakan tambahan', 'i. satu <br>\r\nii. dua', '2019-12-31', '56', 'Ketua BPO');
/*!40000 ALTER TABLE `tindakan_risiko` ENABLE KEYS */;

-- Dumping structure for table erisikolaravel.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `google_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'PENGGUNA',
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar_original` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table erisikolaravel.users: ~1 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `name`, `google_id`, `email`, `password`, `user_type`, `avatar`, `avatar_original`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'Aqil Khairy Bin Hamsani', '115407467324893430939', 'aqilkhairy@gmail.com', NULL, 'URUSETIA', 'https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcSfmJO1vZOid-nPBHG4aMhenFmy5zW4qPg_-g&usqp=CAU', 'https://lh3.googleusercontent.com/a-/AOh14GiID3HVrwEJbcMoWe4qmCieeKfXo0gpDww_cqKyJQ', '131QJh5frZA6dmhuI0upErdcu4eZHkyy2sqTbJ2H4Z0vozPxuOos3ietEi1W', '2020-09-07 07:53:42', '2020-09-07 07:53:42');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
