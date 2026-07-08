-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 08, 2026 at 02:42 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_selfphoto`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_booking`
--

CREATE TABLE `tbl_booking` (
  `id_booking` int(11) NOT NULL,
  `invoice_number` varchar(20) NOT NULL,
  `nama_customer` varchar(100) NOT NULL,
  `email_customer` varchar(100) NOT NULL,
  `whatsapp_customer` varchar(20) NOT NULL,
  `tipe_studio` varchar(50) NOT NULL,
  `tanggal_foto` date NOT NULL,
  `jam_foto` varchar(10) NOT NULL,
  `jumlah_orang` int(3) NOT NULL,
  `bawa_hewan` enum('Yes','No') DEFAULT 'No',
  `total_harga` int(11) NOT NULL,
  `bukti_transfer` varchar(255) DEFAULT NULL,
  `link_drive` varchar(255) DEFAULT NULL,
  `status_booking` enum('Pending','Confirmed','Processing','Selesai','Batal') DEFAULT 'Pending',
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_booking`
--

INSERT INTO `tbl_booking` (`id_booking`, `invoice_number`, `nama_customer`, `email_customer`, `whatsapp_customer`, `tipe_studio`, `tanggal_foto`, `jam_foto`, `jumlah_orang`, `bawa_hewan`, `total_harga`, `bukti_transfer`, `link_drive`, `status_booking`, `created_at`) VALUES
(1, 'INV-20260630-B260', 'ramdhani lutfi', 'customer@mail.com', '0895709055155', 'Regular Studio', '2026-07-01', '09.00', 1, 'No', 150000, '1783438400_25f8636b3dbd65e4a9bf.jpeg', 'https://drive.google.com/drive/folders/146O_kBEMsY56qUY_GpWZ7h5SoD0kgbWf', 'Confirmed', '2026-06-30 16:50:37'),
(2, 'INV-20260701-D163', 'ramdhani lutfi', 'customer@mail.com', '0895709055155', 'Regular Studio', '2026-07-01', '09:00', 5, 'No', 150000, NULL, NULL, 'Batal', '2026-07-01 15:33:09'),
(3, 'INV-20260701-6A35', 'ramdhani lutfi', 'customer@mail.com', '0895709055155', 'Regular Studio', '2026-07-01', '09:00', 5, 'No', 150000, NULL, NULL, 'Batal', '2026-07-01 15:39:29'),
(4, 'INV-20260701-D97B', 'ramdhani lutfi', 'customer@mail.com', '0895709055155', 'Regular Studio', '2026-07-01', '09:00', 5, 'No', 150000, NULL, NULL, 'Batal', '2026-07-01 15:41:01'),
(5, 'INV-20260701-5F38', 'nadiah', 'customer@mail.com', '0895410605267', 'Regular Studio', '2026-07-02', '15:00', 7, 'No', 200000, '1782920301_dbe3e64f5bffb3ef9eae.jpeg', 'https://drive.google.com/drive/folders/146O_kBEMsY56qUY_GpWZ7h5SoD0kgbWf', 'Confirmed', '2026-07-01 22:12:15'),
(6, 'INV-20260701-7746', 'nanad', 'customer@mail.com', '8979368078', 'Regular Studio', '2026-07-02', '13:00', 5, 'Yes', 170000, NULL, NULL, 'Batal', '2026-07-01 22:14:32'),
(8, 'INV-20260701-5917', 'nadiah jelek', 'customer@mail.com', '0895410605267', 'Regular Studio', '2026-07-03', '10:00', 5, 'Yes', 170000, NULL, NULL, 'Batal', '2026-07-01 22:37:44'),
(9, 'INV-20260703-C80B', 'sivia ariska', 'customer@mail.com', '083131339658', 'Largest Studio', '2026-07-04', '09:00', 10, 'No', 250000, NULL, NULL, 'Batal', '2026-07-03 11:45:54'),
(10, 'INV-20260703-3804', 'ikbal', 'customer@mail.com', '081256327958', 'VVIP Studio', '2026-07-04', '09:00', 2, 'No', 350000, NULL, NULL, 'Batal', '2026-07-03 11:47:13'),
(11, 'INV-20260705-3E0D', 'risna akmal', 'customer@mail.com', '082280884561', 'VVIP Studio', '2026-07-07', '09:00', 2, 'No', 350000, '1783259494_968cfca0664215d90579.jpeg', 'https://drive.google.com/drive/folders/146O_kBEMsY56qUY_GpWZ7h5SoD0kgbWf', 'Confirmed', '2026-07-05 20:48:45'),
(12, 'INV-20260705-58F9', 'muchlis angga', 'customer@mail.com', '085363698806', 'Regular Studio', '2026-07-06', '19:00', 1, 'Yes', 170000, '1783265763_57456abee8919ce8bfcc.jpeg', 'https://drive.google.com/drive/folders/146O_kBEMsY56qUY_GpWZ7h5SoD0kgbWf', 'Confirmed', '2026-07-05 22:18:55'),
(16, 'INV-20260706-32F2', 'ayu saharani', 'admin@mail.com', '081266881827', 'Regular Studio', '2026-07-06', '17:00', 5, 'Yes', 170000, NULL, 'https://drive.google.com/drive/folders/1Feiz7sZdStjozlU7skYKQLkxNE6n-aHz', 'Confirmed', '2026-07-06 19:01:05'),
(17, 'INV-20260706-FA37', 'musdalifah', 'ayu@mail.com', '081275668448', 'VVIP Studio', '2026-07-06', '15:00', 5, 'No', 350000, NULL, NULL, 'Pending', '2026-07-06 19:16:16'),
(18, 'INV-20260706-868E', 'sesi', 'ayu@mail.com', '085836676516', 'Regular Studio', '2026-07-06', '15:00', 5, 'Yes', 170000, NULL, NULL, 'Pending', '2026-07-06 19:21:37'),
(19, 'INV-20260706-D3C4', 'arif razaki', 'ayu@mail.com', '08385530885', 'Largest Studio', '2026-07-04', '15:00', 5, 'No', 250000, NULL, NULL, 'Pending', '2026-07-06 19:31:40'),
(20, 'INV-20260707-62DE', 'exel saputra', 'customer@mail.com', '087862762937', 'Regular Studio', '2026-07-07', '13:00', 2, 'No', 150000, '1783395877_cd233fa81da1057d6f36.jpeg', 'https://drive.google.com/drive/folders/1Feiz7sZdStjozlU7skYKQLkxNE6n-aHz', 'Confirmed', '2026-07-07 10:44:07'),
(21, 'INV-20260707-094C', 'ramdhani lutfi', 'customer@mail.com', '0895709055155', 'Regular Studio', '2026-07-08', '09:00', 6, 'Yes', 195000, NULL, 'https://drive.google.com/drive/folders/1LVIA9GcYUbPlzS_AouDvudbBL6tjjB9h', 'Confirmed', '2026-07-07 22:09:10'),
(22, 'INV-20260707-B278', 'nadiah', 'customer@mail.com', '0895410605267', 'Largest Studio', '2026-07-08', '09:00', 10, 'Yes', 270000, NULL, NULL, 'Pending', '2026-07-07 22:22:51');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `no_whatsapp` varchar(20) NOT NULL,
  `role` enum('Admin','Editor','Customer','Owner') NOT NULL DEFAULT 'Editor',
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `username`, `password`, `nama_lengkap`, `no_whatsapp`, `role`, `created_at`) VALUES
(2, 'editor_poto', '$2y$10$mR3M7MhkEclSjQ5CgWnK/.v7XnUj1mR6m8mD9KjRt9M3N8P7L8K6.', 'Staff Editor', '', 'Editor', '2026-07-01 19:02:00'),
(6, 'admin_poto', '$2y$10$mr9HIzgr/NRm2pAviEc9oO/SzrRAyQr/co/EFSeTPFoe9aUzH4Lpm', 'Ramdhani Admin', '', 'Admin', '2026-07-01 19:47:37'),
(7, 'admin', 'admin123', 'Utama Admin', '', 'Admin', '2026-07-01 19:47:37'),
(8, 'ramdhani', 'lutfi', 'ramdhani lutfi', '', '', '2026-07-03 13:05:12'),
(9, 'silvia', 'ariska', 'silvia ariska', '', '', '2026-07-03 13:14:08'),
(10, 'nadiah', 'nadiah', 'nadiah', '', '', '2026-07-03 13:30:36'),
(11, 'owner', 'owner123', 'owner kita', '085668902731', 'Owner', '2026-07-03 13:57:19'),
(12, 'editor', 'editor123', 'staff editor poto kita', '082170784904', 'Editor', '2026-07-03 15:58:50'),
(13, 'risna', 'akmal', 'risna akmal', '082280884561', 'Customer', '2026-07-05 20:52:33'),
(14, 'muchlis', 'angga', 'muchlis angga', '085363698806', 'Customer', '2026-07-05 22:19:39'),
(15, 'ayu', 'saharani', 'ayu saharani', '081266881827', 'Customer', '2026-07-06 19:02:17'),
(16, 'exel', 'saputra', 'exel saputra', '087862762937', 'Customer', '2026-07-07 10:45:21');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_booking`
--
ALTER TABLE `tbl_booking`
  ADD PRIMARY KEY (`id_booking`),
  ADD UNIQUE KEY `invoice_number` (`invoice_number`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_booking`
--
ALTER TABLE `tbl_booking`
  MODIFY `id_booking` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
