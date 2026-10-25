-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 16, 2025 at 06:28 AM
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
-- Database: `db_deposito_jundi`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_hitung_deposito` (IN `p_user_id` INT, IN `p_bank_id` INT, IN `p_nominal` DECIMAL(15,2), IN `p_durasi` INT)   BEGIN
  DECLARE bunga DECIMAL(15,2);
  DECLARE total DECIMAL(15,2);
  DECLARE suku DECIMAL(5,2);

  SELECT suku_bunga_dasar INTO suku
  FROM banks WHERE bank_id = p_bank_id;

  SET bunga = p_nominal * (suku/100) * (p_durasi/12);
  SET total = p_nominal + bunga;

  INSERT INTO simulations
  VALUES (NULL, p_user_id, p_bank_id, p_nominal, p_durasi, bunga, total, NOW());
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `audit_logs`
--

CREATE TABLE `audit_logs` (
  `log_id` int(11) NOT NULL,
  `aksi` varchar(50) DEFAULT NULL,
  `waktu` datetime DEFAULT NULL,
  `keterangan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `audit_logs`
--

INSERT INTO `audit_logs` (`log_id`, `aksi`, `waktu`, `keterangan`) VALUES
(1, 'UPDATE USER', '2025-12-13 11:14:19', 'Sebelum: hausetanol | Sesudah: hausetanol'),
(2, 'UPDATE USER', '2025-12-13 11:14:19', 'Sebelum: adrian80 | Sesudah: adrian80');

-- --------------------------------------------------------

--
-- Table structure for table `banks`
--

CREATE TABLE `banks` (
  `bank_id` int(11) NOT NULL,
  `nama_bank` varchar(50) DEFAULT NULL,
  `suku_bunga_dasar` decimal(5,2) DEFAULT NULL,
  `logo_file` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `banks`
--

INSERT INTO `banks` (`bank_id`, `nama_bank`, `suku_bunga_dasar`, `logo_file`) VALUES
(1, 'Bank Mandiri', 3.50, NULL),
(2, 'Bank BRI', 4.25, NULL),
(3, 'Bank BCA', 3.00, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2025_12_16_043531_add_logo_file_to_banks_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `simulations`
--

CREATE TABLE `simulations` (
  `simulasi_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `bank_id` int(11) DEFAULT NULL,
  `nominal_deposito` decimal(15,2) DEFAULT NULL,
  `jangka_waktu_bulan` int(11) DEFAULT NULL,
  `bunga_diterima` decimal(15,2) DEFAULT NULL,
  `total_akhir` decimal(15,2) DEFAULT NULL,
  `waktu_simulasi` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `simulations`
--

INSERT INTO `simulations` (`simulasi_id`, `user_id`, `bank_id`, `nominal_deposito`, `jangka_waktu_bulan`, `bunga_diterima`, `total_akhir`, `waktu_simulasi`) VALUES
(1, 1, 1, 5000000.00, 12, 175000.00, 5175000.00, '2025-12-13 08:54:42'),
(2, 6, 2, 100000000.00, 24, 8500000.00, 108500000.00, '2025-12-13 08:54:42'),
(3, 5, 3, 10000000.00, 6, 150000.00, 10150000.00, '2025-12-13 08:54:42'),
(4, 1, 1, 5000000.00, 12, 175000.00, 5175000.00, '2025-12-13 09:50:26'),
(5, 6, 2, 100000000.00, 24, 8500000.00, 108500000.00, '2025-12-13 09:50:26'),
(6, 5, 3, 10000000.00, 6, 150000.00, 10150000.00, '2025-12-13 09:50:26'),
(13, 1, 1, 10000000.00, 11, 320833.33, 10320833.33, '2025-12-15 08:56:37'),
(14, 1, 2, 1000000.00, 12, 42500.00, 1042500.00, '2025-12-16 07:58:51'),
(16, 27, 2, 10000001.00, 12, 425000.04, 10425001.04, '2025-12-16 04:01:59'),
(17, 27, 3, 1100000.00, 6, 16500.00, 1116500.00, '2025-12-16 04:39:11'),
(18, 27, 1, 1000000.00, 12, 35000.00, 1035000.00, '2025-12-16 04:39:38'),
(19, 27, 2, 15000000.00, 12, 637500.00, 15637500.00, '2025-12-16 04:43:14');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `nama_lengkap` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `nama_lengkap`, `email`) VALUES
(1, 'anakbaik21', 'sehat2orang', 'Insanul ihsan', 'uji_trigger@gmail.com'),
(2, 'katabijak01', 'quoteoftheday', 'Kalam al-hasan', 'quotekeren@gmail.com'),
(3, 'slalukonsis', 'struggleforce', 'Haikal al-faruqi', 'ikalll@gmail.com'),
(4, 'adrian80', 'adriandisini', 'Adrian zuhair', 'adrian.official@gmail.com'),
(5, 'mancingemosi', 'rodabulat', 'Guntur rizky', 'dikejarmasa@gmail.com'),
(6, 'demensawit', 'babathutan', 'Prahadi subagyo', 'massa.iq58@gmail.com'),
(7, 'hausetanol', 'tobatnasuha2025', 'Bahzil al kadzab', 'lil.bahzil@gmail.com'),
(27, 'humi', '271109', 'Humiuu', 'Humi27@gmail.com');

--
-- Triggers `users`
--
DELIMITER $$
CREATE TRIGGER `trg_update_user` AFTER UPDATE ON `users` FOR EACH ROW BEGIN
  INSERT INTO audit_logs
  VALUES (NULL,'UPDATE USER',NOW(),
  CONCAT('Sebelum: ', OLD.username,' | Sesudah: ', NEW.username));
END
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `audit_logs`
--
ALTER TABLE `audit_logs`
  ADD PRIMARY KEY (`log_id`);

--
-- Indexes for table `banks`
--
ALTER TABLE `banks`
  ADD PRIMARY KEY (`bank_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `simulations`
--
ALTER TABLE `simulations`
  ADD PRIMARY KEY (`simulasi_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `bank_id` (`bank_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `audit_logs`
--
ALTER TABLE `audit_logs`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `banks`
--
ALTER TABLE `banks`
  MODIFY `bank_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `simulations`
--
ALTER TABLE `simulations`
  MODIFY `simulasi_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `simulations`
--
ALTER TABLE `simulations`
  ADD CONSTRAINT `simulations_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `simulations_ibfk_2` FOREIGN KEY (`bank_id`) REFERENCES `banks` (`bank_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
