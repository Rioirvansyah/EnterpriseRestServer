-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 15, 2018 at 01:07 PM
-- Server version: 10.1.22-MariaDB
-- PHP Version: 7.1.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `enterprise_bandara`
--

-- --------------------------------------------------------

--
-- Table structure for table `kontak`
--

CREATE TABLE `kontak` (
  `id_kontak` int(11) NOT NULL,
  `nama_kontak` varchar(20) NOT NULL,
  `email_kontak` varchar(20) NOT NULL,
  `subyek_kontak` varchar(30) NOT NULL,
  `pesan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kontak`
--

INSERT INTO `kontak` (`id_kontak`, `nama_kontak`, `email_kontak`, `subyek_kontak`, `pesan`) VALUES
(1, 'Irvan', 'rioirvansyah6@gmail.', 'Kinerja', 'Luar Biasa');

-- --------------------------------------------------------

--
-- Table structure for table `maskapai`
--

CREATE TABLE `maskapai` (
  `kode_maskapai` int(11) NOT NULL,
  `nama_maskapai` varchar(50) NOT NULL,
  `alamat_maskapai` text NOT NULL,
  `telepon_maskapai` varchar(15) NOT NULL,
  `website_maskapai` varchar(40) NOT NULL,
  `gambar_maskapai` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `maskapai`
--

INSERT INTO `maskapai` (`kode_maskapai`, `nama_maskapai`, `alamat_maskapai`, `telepon_maskapai`, `website_maskapai`, `gambar_maskapai`) VALUES
(1, 'Lion air', 'Jl. Sulawesi No. 75\r\nSurabaya', '503 6111', 'www.lionair.co.id', 'lion2.jpg'),
(2, 'Garuda Indonesia', 'Graha Bumi Surabaya, 1st Floor\r\nJl. Basuki Rachmat No. 106-128\r\nSurabaya 60271', '5457273', 'www.garuda-indonesia.com', 'garuda2.jpg'),
(3, 'AirAsia', 'Plaza East UG Floor Unit 48 Tunjungan Plaza 1 Surabaya', '2927 0999', 'www.Airasia.com', 'airasia2.png');

-- --------------------------------------------------------

--
-- Table structure for table `penerbangan`
--

CREATE TABLE `penerbangan` (
  `no_penerbangan` varchar(10) NOT NULL,
  `kode_maskapai` int(11) NOT NULL,
  `tanggal_berangkat` date NOT NULL,
  `tujuan` varchar(40) NOT NULL,
  `waktu_berangkat` time NOT NULL,
  `waktu_sampai` time NOT NULL,
  `keterangan` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penerbangan`
--

INSERT INTO `penerbangan` (`no_penerbangan`, `kode_maskapai`, `tanggal_berangkat`, `tujuan`, `waktu_berangkat`, `waktu_sampai`, `keterangan`) VALUES
('1', 2, '2018-12-08', 'Surabaya', '17:23:00', '03:21:17', 'On Schedule'),
('2', 1, '2018-12-09', 'Manado', '08:17:00', '10:04:00', 'On Schedule');

-- --------------------------------------------------------

--
-- Table structure for table `penumpang`
--

CREATE TABLE `penumpang` (
  `no_ktp` int(11) NOT NULL,
  `nama_penumpang` varchar(30) NOT NULL,
  `telepon_penumpang` varchar(15) NOT NULL,
  `email_penumpang` varchar(30) NOT NULL,
  `jenis_penumpang` varchar(20) NOT NULL,
  `username` varchar(40) NOT NULL,
  `password` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penumpang`
--

INSERT INTO `penumpang` (`no_ktp`, `nama_penumpang`, `telepon_penumpang`, `email_penumpang`, `jenis_penumpang`, `username`, `password`) VALUES
(1, 'Rio Irvansyah', '085645896741', 'rioirvansyah6@gmail.com', 'ekonomi', 'rio', 'rio'),
(2, 'Indri Mukti', '085213415612', 'indrimuktiw@gmail.com', 'Bisnis', 'indri', 'indri'),
(33, 'apa', '123123', 'apa@gmail.com', 'ekonomi', 'apa', 'apa');

-- --------------------------------------------------------

--
-- Table structure for table `tiket`
--

CREATE TABLE `tiket` (
  `id_tiket` int(11) NOT NULL,
  `no_ktp` int(11) NOT NULL,
  `no_penerbangan` varchar(10) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `harga_total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tiket`
--

INSERT INTO `tiket` (`id_tiket`, `no_ktp`, `no_penerbangan`, `jumlah`, `harga_total`) VALUES
(1, 1, '1', 2, 300000),
(2, 2, '2', 3, 600000),
(3, 33, '1', 2, 100000);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kontak`
--
ALTER TABLE `kontak`
  ADD PRIMARY KEY (`id_kontak`);

--
-- Indexes for table `maskapai`
--
ALTER TABLE `maskapai`
  ADD PRIMARY KEY (`kode_maskapai`);

--
-- Indexes for table `penerbangan`
--
ALTER TABLE `penerbangan`
  ADD PRIMARY KEY (`no_penerbangan`),
  ADD KEY `kode_maskapai` (`kode_maskapai`);

--
-- Indexes for table `penumpang`
--
ALTER TABLE `penumpang`
  ADD PRIMARY KEY (`no_ktp`);

--
-- Indexes for table `tiket`
--
ALTER TABLE `tiket`
  ADD PRIMARY KEY (`id_tiket`),
  ADD KEY `no_ktp` (`no_ktp`),
  ADD KEY `no_penerbangan` (`no_penerbangan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kontak`
--
ALTER TABLE `kontak`
  MODIFY `id_kontak` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `maskapai`
--
ALTER TABLE `maskapai`
  MODIFY `kode_maskapai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `penumpang`
--
ALTER TABLE `penumpang`
  MODIFY `no_ktp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT for table `tiket`
--
ALTER TABLE `tiket`
  MODIFY `id_tiket` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `penerbangan`
--
ALTER TABLE `penerbangan`
  ADD CONSTRAINT `penerbangan_ibfk_1` FOREIGN KEY (`kode_maskapai`) REFERENCES `maskapai` (`kode_maskapai`);

--
-- Constraints for table `tiket`
--
ALTER TABLE `tiket`
  ADD CONSTRAINT `tiket_ibfk_1` FOREIGN KEY (`no_ktp`) REFERENCES `penumpang` (`no_ktp`),
  ADD CONSTRAINT `tiket_ibfk_2` FOREIGN KEY (`no_penerbangan`) REFERENCES `penerbangan` (`no_penerbangan`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
