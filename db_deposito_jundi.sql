-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 25, 2026 at 04:04 PM
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
(2, 'UPDATE USER', '2025-12-13 11:14:19', 'Sebelum: adrian80 | Sesudah: adrian80'),
(3, 'UPDATE USER', '2025-12-16 16:29:59', 'Sebelum: humi | Sesudah: humi'),
(4, 'UPDATE USER', '2025-12-16 16:31:43', 'Sebelum: humi | Sesudah: humi'),
(5, 'UPDATE USER', '2025-12-16 16:34:03', 'Sebelum: humi | Sesudah: humi');

-- --------------------------------------------------------

--
-- Table structure for table `banks`
--

CREATE TABLE `banks` (
  `bank_id` int(11) NOT NULL,
  `nama_bank` varchar(50) DEFAULT NULL,
  `suku_bunga_dasar` decimal(5,2) DEFAULT NULL,
  `bank_logos` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `banks`
--

INSERT INTO `banks` (`bank_id`, `nama_bank`, `suku_bunga_dasar`, `bank_logos`) VALUES
(1, 'Bank Mandiri', 3.50, 'mandiri.png'),
(2, 'Bank BRI', 4.25, 'bri.png'),
(3, 'Bank BCA', 3.00, 'bca.png');

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
(7, 27, 2, 100000000.00, 12, 4250000.00, 104250000.00, '2026-01-05 04:26:40'),
(8, 27, 3, 1212121212.00, 12, 36363636.36, 1248484848.36, '2026-01-05 05:02:42'),
(9, 27, 2, 11122121.00, 12, 472690.14, 11594811.14, '2026-05-05 01:57:56');

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
(1, 'anakbaik21', 'sehat2orang', 'Insanul ihsan', 'baikbijak@gmail.com'),
(2, 'katabijak01', 'quoteoftheday', 'Kalam al-hasan', 'quotekeren@gmail.com'),
(3, 'slalukonsis', 'struggleforce', 'Haikal al-faruqi', 'ikalll@gmail.com'),
(4, 'adrian80', 'adriandisini', 'Adrian zuhair', 'adrian.official@gmail.com'),
(5, 'mancingemosi', 'rodabulat', 'Guntur rizky', 'dikejarmasa@gmail.com'),
(6, 'demensawit', 'babathutan', 'Prahadi subagyo', 'massa.iq58@gmail.com'),
(7, 'hausetanol', 'tobatnasuha2025', 'Bahzil al kadzab', 'lil.bahzil@gmail.com'),
(27, 'humi', '271109', 'Humiuu', 'Humiuu27@gmail.com');

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
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `banks`
--
ALTER TABLE `banks`
  MODIFY `bank_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `simulations`
--
ALTER TABLE `simulations`
  MODIFY `simulasi_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

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
