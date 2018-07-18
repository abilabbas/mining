-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 11, 2018 at 02:22 AM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `doorjekanalytic`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(8) UNSIGNED NOT NULL,
  `email` varchar(50) NOT NULL,
  `nama` varchar(256) CHARACTER SET latin1 NOT NULL,
  `password` varchar(256) CHARACTER SET latin1 NOT NULL,
  `status` enum('admin','analis') NOT NULL,
  `createdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `email`, `nama`, `password`, `status`, `createdate`) VALUES
(1, 'admin@mail.com', 'admin', '0192023a7bbd73250516f069df18b500', 'admin', '2018-06-25 10:18:37'),
(3, 'analis1@mail.com', 'analis1', '50c7ac9abd28c21c1449e50379e16431', 'analis', '2018-07-10 23:28:35');

-- --------------------------------------------------------

--
-- Table structure for table `layanan`
--

CREATE TABLE `layanan` (
  `id_layanan` int(8) NOT NULL,
  `layanan_name` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `layanan`
--

INSERT INTO `layanan` (`id_layanan`, `layanan_name`) VALUES
(1, 'Doormobil'),
(2, 'Doormotor');

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `id_member` int(8) UNSIGNED NOT NULL,
  `email` varchar(50) NOT NULL,
  `nama` varchar(256) NOT NULL,
  `alamat` varchar(256) NOT NULL,
  `nohp` char(16) NOT NULL,
  `createdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `password` varchar(256) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`id_member`, `email`, `nama`, `alamat`, `nohp`, `createdate`, `password`) VALUES
(1, 'unyil123@gmail.com', 'Unyil', 'Jalan ujung pandang Gg belok no 15 Medan', '+62987654321', '2018-07-05 02:39:55', '827ccb0eea8a706c4c34a16891f84e7b'),
(3, 'budi@gmail.com', 'Budi', 'Jalan suka maju gg bakti bangsa ', '+62123456789', '2018-07-04 06:56:19', '827ccb0eea8a706c4c34a16891f84e7b'),
(4, 'iqballubis3105@gmail.com', 'Iqbal Lubis', 'Jalan binjai km 10 komplek stpp medan', '+6281232269495', '2018-07-05 03:14:15', '827ccb0eea8a706c4c34a16891f84e7b'),
(5, 'hudi@gmail.com', 'Hudi', 'Jalan berastagi komplek berastagi centre', '+623456781212', '2018-07-10 23:20:31', '827ccb0eea8a706c4c34a16891f84e7b');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `id_payment` int(8) NOT NULL,
  `payment_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`id_payment`, `payment_name`) VALUES
(1, 'Cash'),
(3, 'DoorMoney'),
(4, 'Debit Card / EDC');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(8) NOT NULL,
  `produk_name` varchar(50) NOT NULL,
  `produk_price` char(50) NOT NULL,
  `produk_time` int(50) NOT NULL,
  `id_layanan` int(208) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `produk_name`, `produk_price`, `produk_time`, `id_layanan`) VALUES
(1, '2 in 1', '100000', 100, 1),
(2, 'Regular', '66000', 60, 1),
(3, 'Pro', '132000', 90, 1),
(4, 'Elite', '75000', 60, 1),
(5, 'Platinum', '275000', 150, 1),
(6, 'Reguler', '25000', 30, 2),
(7, '2 in 1', '80000', 90, 2),
(8, 'Pro', '45000', 45, 2),
(9, 'Elite', '75000', 60, 2),
(10, 'Platinum', '100000', 75, 2);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_order` int(8) NOT NULL,
  `id_member` int(8) NOT NULL,
  `id_produk` int(8) NOT NULL,
  `alamatorder` text NOT NULL,
  `note` text NOT NULL,
  `id_layanan` int(8) NOT NULL,
  `status` enum('3','4') NOT NULL,
  `dateorder` date NOT NULL,
  `time` time NOT NULL,
  `total` int(50) NOT NULL,
  `id_vehicle` int(8) NOT NULL,
  `id_payment` int(8) NOT NULL,
  `createdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_order`, `id_member`, `id_produk`, `alamatorder`, `note`, `id_layanan`, `status`, `dateorder`, `time`, `total`, `id_vehicle`, `id_payment`, `createdate`) VALUES
(1, 4, 2, 'Jalan kampung lalang no 1', 'Dekat toko roti bahagia', 1, '3', '2018-07-09', '00:00:00', 66000, 180, 1, '2018-07-09 03:53:14'),
(2, 3, 1, 'jalan titi bobrok', 'dekat rumah makan mantap', 1, '4', '2018-07-09', '07:00:00', 0, 2, 3, '2018-07-10 04:38:21'),
(6, 3, 9, 'Jalan bahagia sekali no 14', 'Cat warna merah', 2, '3', '0000-00-00', '12:00:00', 0, 0, 1, '2018-07-10 03:42:13'),
(10, 1, 2, 'test', 'test', 2, '4', '2018-02-03', '10:00:00', 0, 0, 1, '2018-07-10 16:04:17'),
(11, 1, 1, 'aaa', 'test2', 1, '3', '1950-01-01', '12:00:00', 0, 0, 1, '2018-07-10 04:14:13'),
(12, 3, 1, 'test kesekian', 'test', 2, '3', '1996-05-05', '12:00:00', 0, 0, 1, '2018-07-10 04:17:18'),
(13, 1, 1, 'test', 'test', 2, '3', '1997-05-31', '12:00:00', 0, 0, 1, '2018-07-10 04:18:16'),
(14, 5, 3, 'Jalan berastagi komplek berastagi centre', 'Pagar biru no 15', 1, '3', '2017-01-02', '13:00:00', 0, 0, 1, '2018-07-10 23:23:10');

-- --------------------------------------------------------

--
-- Table structure for table `vehicle`
--

CREATE TABLE `vehicle` (
  `id_vehicle` int(8) NOT NULL,
  `vehicle_brand` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vehicle`
--

INSERT INTO `vehicle` (`id_vehicle`, `vehicle_brand`) VALUES
(110, 'Chevrolet'),
(150, 'Ford'),
(180, 'Jeep'),
(400, 'Mazda'),
(450, 'Mercedes Benz'),
(555, 'Mitsubishi'),
(600, 'Suzuki\r\n'),
(641, 'Honda'),
(666, 'Daihatsu'),
(777, 'Nissan'),
(888, 'BMW'),
(999, 'Toyota'),
(1000, 'Lainnya');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `layanan`
--
ALTER TABLE `layanan`
  ADD PRIMARY KEY (`id_layanan`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`id_member`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id_payment`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_order`);

--
-- Indexes for table `vehicle`
--
ALTER TABLE `vehicle`
  ADD PRIMARY KEY (`id_vehicle`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `id_member` int(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_order` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
