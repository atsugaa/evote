-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 13, 2024 at 06:36 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `evote`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `ID_ADMIN` char(8) NOT NULL,
  `PASSWORD_ADMIN` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`ID_ADMIN`, `PASSWORD_ADMIN`) VALUES
('petarunx', '$2y$12$l/zu0FxA1Y5FjRCCgxLT2utgcPUJRDrT7roDQpCKXY6VGzRPGdir6');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `calon`
--

CREATE TABLE `calon` (
  `ID_CALON` char(6) NOT NULL,
  `KETUA_CALON` varchar(64) NOT NULL,
  `WAKIL_CALON` varchar(64) NOT NULL,
  `VISI_CALON` longtext NOT NULL,
  `MISI_CALON` longtext NOT NULL,
  `GAMBAR_CALON` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `calon`
--

INSERT INTO `calon` (`ID_CALON`, `KETUA_CALON`, `WAKIL_CALON`, `VISI_CALON`, `MISI_CALON`, `GAMBAR_CALON`) VALUES
('C0001', 'Febrianu', 'Alivian', 'mantap', 'sek bebas', 'C0001_1718296462.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `calon_voting`
--

CREATE TABLE `calon_voting` (
  `ID_CATING` char(6) NOT NULL,
  `ID_VOTING` char(6) DEFAULT NULL,
  `ID_CALON` char(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `calon_voting`
--

INSERT INTO `calon_voting` (`ID_CATING`, `ID_VOTING`, `ID_CALON`) VALUES
('P0001', 'V0001', 'C0001');

--
-- Triggers `calon_voting`
--
DELIMITER $$
CREATE TRIGGER `Cl_Stat2` AFTER UPDATE ON `calon_voting` FOR EACH ROW BEGIN
    UPDATE users 
    SET `STATUS` = 0 
    WHERE NISN = NISN;
    DELETE FROM vote;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2024_05_22_173910_create_siswas_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('EYxA3VYrXo8pcWfMx17PrmnTHlQAXE4UL2auwvjk', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWTVsenA3Y1JBdHlKQzYzdDJvbllNTnJ3VUdnVnEyRzVoVUlpenRjZSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHBzOi8vZXZvdGUudGVzdCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1717744954);

-- --------------------------------------------------------

--
-- Table structure for table `siswas`
--

CREATE TABLE `siswas` (
  `NISN` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `NAMA` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `STATUS` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `NISN` char(10) NOT NULL,
  `NAMA` varchar(64) NOT NULL,
  `STATUS` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`NISN`, `NAMA`, `STATUS`) VALUES
('0062524163', 'AHMAD YOGA FAMUJI', 0),
('0063771212', 'FEBRIANSYAH SETIAWAN', 0),
('0064092180', 'OLIFIYAN SANDI RAMADANI', 0),
('0067636160', 'SRI MUNARTI', 0),
('0071056135', 'WINDA AYU PUSPITA ANGGRAINI', 0),
('0071152460', 'HALIMATUS SA`DIYAH', 0),
('0071410946', 'CANDRA BAGUS SETIAWAN', 0),
('0071465930', 'RAHAYU KHARISMAWATI NINGRUM', 0),
('0071695812', 'MOHAMMAD FAQRI MAULANA', 0),
('0071759080', 'DAVIN YOGA PRATAMA', 0),
('0071801603', 'ARMA SYAHRUL RAMADHAN', 0),
('0071953046', 'RAKA NUR FIRMANSYAH', 0),
('0072076446', 'CHELSEA FALENSIA CITRA', 0),
('0072148224', 'SOFI ADELIA PUTRI', 0),
('0072164699', 'AMELYA PUTRI ALFIRUDDIN', 0),
('0072198194', 'MUHAMAD WAHYU ARIS SAPUTRA', 0),
('0072300914', 'TASYA ADELIA ANGGELA', 0),
('0072464733', 'NADILA AMELIA PUSPITA', 0),
('0072540248', 'MASDUKI JAKARIA', 0),
('0072652253', 'MIMIN INAYATUL MA\'ULFA', 0),
('0072787858', 'ANDIKA RUSMANA', 0),
('0072901885', 'NUR SAHID', 0),
('0072913155', 'DEA LUNA LURISIA', 0),
('0073063725', 'IRFAN SLAMET ADIRAGA', 0),
('0073620916', 'SRININGSIH', 0),
('0073728182', 'QOTHRUN NADA', 0),
('0073824145', 'FITRIA AZZAHRA NUR HIDAYATI', 0),
('0073895576', 'LUHUR PAMBUDI', 0),
('0074218149', 'RAVAEL PUTRA MARENDA', 0),
('0074357527', 'ABDI MOCH RASYA RAMADAN', 0),
('0074506959', 'SHIVA DINDA RIFANA', 0),
('0074648456', 'AISYAH EKA SALSABILA', 0),
('0074676133', 'AINUR RAHMADANI', 0),
('0075124448', 'HARDI YANTI', 0),
('0075570875', 'DELA NATASYA', 0),
('0075644885', 'ARUL DAVA LUKMANSYAH', 0),
('0075645885', 'MUHAMMAD BABAR RAMDHANI', 0),
('0075880447', 'ADINDA SCARFIA ANISA', 0),
('0076091124', 'MOHAMMAD SYAMSUL HUDA', 0),
('0076282550', 'FADIA MAHISA AULIA', 0),
('0076329359', 'MUKHAMAD ILHAM', 0),
('0076347223', 'MAULANA TRI BINTANG SAPUTRA', 0),
('0076430298', 'NOVAN BAGUS DWIANTORO', 0),
('0076452297', 'FANI RAHMAH SARI', 0),
('0076529433', 'RIFAL FAYAKUN', 0),
('0076610363', 'RENO ANTONIO', 0),
('0076709724', 'MUHAMMAD RENDY ARDIANSYAH', 0),
('0077043554', 'ARIL NUR ROKHMAN', 0),
('0077055642', 'DEWI INDARTI NINGRUM', 0),
('0077081919', 'FAJAR MAULANA', 0),
('0077372468', 'RYA RISKA CITRA DEWI', 0),
('0077685017', 'M. BAGAS SAPUTRA', 0),
('0077791369', 'WAULFATUL KHASANAH', 0),
('0077857984', 'MUHAMMAD ARIL', 0),
('0077867803', 'DESINTA AULIA PRATIWI', 0),
('0077988942', 'DEVIN ANDRIANO', 0),
('0078776175', 'ALFA TONI PRATAMA', 0),
('0078840600', 'GENTA ADITIA PRATAMA', 0),
('0078935762', 'ANDIKA EKA AFANDY', 0),
('0078949680', 'INDAH FITRIA AZIZAH', 0),
('0079297212', 'AHMAD LANA AGHISNA', 0),
('0079773133', 'HILDA NARTA RAMADHANI', 0),
('0079778974', 'DELA ARDILA', 0),
('0079819495', 'MUHAMMAD HAFIZ ZAKARUDIN', 0),
('0079882227', 'SEPTIA LAILY RAMADANI', 0),
('0081229969', 'ZAHRA EKA APRILIYANTI', 0),
('0081257905', 'AMEL LIA', 0),
('0081589101', 'AFHNA MAULA ANADIA', 0),
('0082739001', 'RERE ISMANIA', 0),
('0083384388', 'REVA DUWI FEBRIANTI', 0),
('0083626645', 'DWI APRILIA', 0),
('0083929383', 'CARISSA PUTRI CAHYANI', 0),
('0083948947', 'MUHAMMAD FAISAL ASSGAV', 0),
('0084196518', 'NIARA PUTRI PURWANDARY', 0),
('0084415956', 'ANDITA NUR RAHMANI', 0),
('0085037416', 'VITA YULIANTI', 0),
('0085064695', 'NADIN ALVI NAJWA', 0),
('0085123956', 'AKHMAD MUNIR ROZAQI', 0),
('0085537557', 'ELISA NUR RAHMAWATI', 0),
('0085646674', 'FERI RIZAL FAHRUDIN', 0),
('0086349590', 'ANNUR WIDYA FEBRIANTI', 0),
('0086386367', 'SELLY AYUNDA', 0),
('0086519678', 'LUTFIYAH LAILY NUR AZIZAH', 0),
('0086576289', 'ANGELLITHA ZALVA MARETTHALIA', 0),
('0086659633', 'AHMAD SIROJUL UMAM', 0),
('0086735677', 'DIAN APRILIA AZKYA', 0),
('0086798111', 'MOHAMMAD FARID ZULIANTO', 0),
('0087020258', 'FERNETA INDRIANI', 0),
('0087357846', 'NURUL AYU MUD MAIDA', 0),
('0087479515', 'RAMADHANI LAILATUL FITRIYAH', 0),
('0087604154', 'PRISMA PUTRI ANZHAMAHARANI', 0),
('0087609081', 'NERINA APRISTA RAHMATUZ ZAHRA', 0),
('0087648908', 'A. NAAFI\' NAYYIFAHRUL IFFAT', 0),
('0087670403', 'PETRICIA ISABELLA NOVIANTI', 0),
('0087802659', 'KHOLISHOTUL MAULANA', 0),
('0087895583', 'ALAN EKA ALFIANTO', 0),
('0088060983', 'KIRANA CINTA MENTARI', 0),
('0088170727', 'MELANI RENA RAHMAWATI', 0),
('0088259348', 'ZAKY SUBASTIAN ARIYANTA', 0),
('0088343352', 'MUHAMMAD YOSA ANGGI KURNIAWAN', 0),
('0088533806', 'AYANG GAYUH AJI PRASASTI', 0),
('0089208845', 'MUHAMMAD DANA SAPUTRA', 0),
('0089337200', 'AHMAD FAISAL NURAYATULLOH', 0),
('0089354401', 'MUHAMMAD FATHONY ZAIDAN', 0),
('0089458047', 'AHMAD RIFANTO ISLAMET', 0),
('0089511825', 'MUKHAMAD FERDY SETYAWAN', 0),
('0089861001', 'TITO AGUNG PERMANA', 0),
('0089865592', 'AYU MARTA NOFITASARI', 0),
('0093496410', 'DWI WAHYUNING TYAS', 0),
('3082093548', 'MOCHAMAT AGUS STIADI', 0),
('38272937', 'fhtyd', 0),
('382729379', 'FEBRIUNA', 0);

-- --------------------------------------------------------

--
-- Table structure for table `vote`
--

CREATE TABLE `vote` (
  `ID_VOTE` char(6) NOT NULL,
  `ID_CALON` char(6) DEFAULT NULL,
  `ID_VOTING` char(6) DEFAULT NULL,
  `NISN` char(10) DEFAULT NULL,
  `WAKTU_VOTE` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Triggers `vote`
--
DELIMITER $$
CREATE TRIGGER `Up_Stat` AFTER INSERT ON `vote` FOR EACH ROW UPDATE users SET `STATUS` = 1 WHERE NISN = new.NISN
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `voting`
--

CREATE TABLE `voting` (
  `ID_VOTING` char(6) NOT NULL,
  `NAMA_VOTING` varchar(256) NOT NULL,
  `DESKRIPSI_VOTING` text NOT NULL,
  `MULAI_VOTING` date NOT NULL,
  `SELESAI_VOTING` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `voting`
--

INSERT INTO `voting` (`ID_VOTING`, `NAMA_VOTING`, `DESKRIPSI_VOTING`, `MULAI_VOTING`, `SELESAI_VOTING`) VALUES
('V0001', 'OSIS', 'PUCUK UBI PUCUK KANGKUNG, BANYAK BUNYI PECAH MUNCUNG.', '2024-06-06', '2024-06-20');

--
-- Triggers `voting`
--
DELIMITER $$
CREATE TRIGGER `Cl_Stat` AFTER UPDATE ON `voting` FOR EACH ROW BEGIN
    UPDATE users 
    SET `STATUS` = 0 
    WHERE NISN = NISN;
    DELETE FROM vote;
END
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`ID_ADMIN`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `calon`
--
ALTER TABLE `calon`
  ADD PRIMARY KEY (`ID_CALON`);

--
-- Indexes for table `calon_voting`
--
ALTER TABLE `calon_voting`
  ADD PRIMARY KEY (`ID_CATING`),
  ADD KEY `FK_RELATIONSHIP_1` (`ID_CALON`),
  ADD KEY `FK_RELATIONSHIP_2` (`ID_VOTING`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `siswas`
--
ALTER TABLE `siswas`
  ADD UNIQUE KEY `siswas_nisn_unique` (`NISN`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD UNIQUE KEY `user_email_unique` (`email`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`NISN`);

--
-- Indexes for table `vote`
--
ALTER TABLE `vote`
  ADD PRIMARY KEY (`ID_VOTE`),
  ADD KEY `FK_RELATIONSHIP_3` (`ID_VOTING`),
  ADD KEY `FK_RELATIONSHIP_4` (`ID_CALON`),
  ADD KEY `FK_RELATIONSHIP_5` (`NISN`);

--
-- Indexes for table `voting`
--
ALTER TABLE `voting`
  ADD PRIMARY KEY (`ID_VOTING`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `calon_voting`
--
ALTER TABLE `calon_voting`
  ADD CONSTRAINT `FK_RELATIONSHIP_1` FOREIGN KEY (`ID_CALON`) REFERENCES `calon` (`ID_CALON`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_RELATIONSHIP_2` FOREIGN KEY (`ID_VOTING`) REFERENCES `voting` (`ID_VOTING`);

--
-- Constraints for table `vote`
--
ALTER TABLE `vote`
  ADD CONSTRAINT `FK_RELATIONSHIP_3` FOREIGN KEY (`ID_VOTING`) REFERENCES `voting` (`ID_VOTING`),
  ADD CONSTRAINT `FK_RELATIONSHIP_4` FOREIGN KEY (`ID_CALON`) REFERENCES `calon` (`ID_CALON`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_RELATIONSHIP_5` FOREIGN KEY (`NISN`) REFERENCES `users` (`NISN`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
