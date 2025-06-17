-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 17, 2025 at 10:30 AM
-- Server version: 10.1.8-MariaDB
-- PHP Version: 5.6.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sales_order`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `name_customer` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `phone` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_by_name` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) NOT NULL,
  `updated_by_name` varchar(100) NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name_customer`, `address`, `phone`, `email`, `created_by`, `created_by_name`, `created_at`, `updated_by`, `updated_by_name`, `updated_at`) VALUES
(1, 'Indah', 'Jawa Barat', '0888888', 'mrayhannoerfikri@gmail.com', 0, '', '2025-06-13 02:10:43', 1, 'Admin', '2025-06-13 04:10:43'),
(2, 'Madroni', 'bakdat', '08963214567', 'madronigantengbanget2@gmail.com', 3, 'Admin', '2025-06-16 06:15:30', 0, '', '0000-00-00 00:00:00'),
(3, 'parjo', 'jogja', '4433156787', 'parjoaja@gmail.com', 3, 'Admin', '2025-06-16 06:16:00', 0, '', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `sales_id` int(11) NOT NULL,
  `cust_id` int(11) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` varchar(10) NOT NULL,
  `total_amount` int(11) NOT NULL,
  `address_receive` text NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_by_name` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_by` int(11) NOT NULL,
  `updated_by_name` varchar(100) NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `sales_id`, `cust_id`, `order_date`, `status`, `total_amount`, `address_receive`, `created_by`, `created_by_name`, `created_at`, `updated_by`, `updated_by_name`, `updated_at`) VALUES
(76, 3, 3, '2025-06-17 08:07:51', 'Draft', 600000, 'jogja', 3, 'Admin', '0000-00-00 00:00:00', 0, '', '0000-00-00 00:00:00'),
(77, 3, 2, '2025-06-17 08:08:12', 'Draft', 22500000, 'jawa barat', 3, 'Admin', '0000-00-00 00:00:00', 0, '', '0000-00-00 00:00:00'),
(78, 2, 2, '2025-06-17 08:09:03', 'Draft', 25000000, 'tangerang', 2, 'Sales', '0000-00-00 00:00:00', 0, '', '0000-00-00 00:00:00'),
(79, 2, 1, '2025-06-17 08:27:38', 'Draft', 2000000, 'jambi', 2, 'Sales', '0000-00-00 00:00:00', 0, '', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `orders_detail`
--

CREATE TABLE `orders_detail` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `unit_price` int(11) NOT NULL,
  `subtotal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders_detail`
--

INSERT INTO `orders_detail` (`id`, `order_id`, `product_id`, `qty`, `unit_price`, `subtotal`) VALUES
(3, 70, 3, 1, 3000, 3000),
(4, 72, 1, 3, 5000, 15000),
(5, 73, 1, 4, 5000, 20000),
(6, 73, 3, 6, 3000, 18000),
(7, 76, 6, 3, 200000, 600000),
(8, 77, 4, 5, 4500000, 22500000),
(9, 78, 5, 5, 5000000, 25000000),
(10, 79, 6, 10, 200000, 2000000);

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id` int(11) NOT NULL,
  `kode_produk` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `created_by_name` varchar(100) NOT NULL,
  `updated_at` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_by_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id`, `kode_produk`, `name`, `price`, `stock`, `created_at`, `created_by`, `created_by_name`, `updated_at`, `updated_by`, `updated_by_name`) VALUES
(4, '44264B20250616', 'AC Panasonic 1 PK', 4500000, 5, '2025-06-17 08:08:12', 3, 'Admin', '0000-00-00 00:00:00', 0, ''),
(5, '21F4F820250616', 'KULKAS Samsung 2 Pintu', 5000000, 35, '2025-06-17 08:09:03', 3, 'Admin', '0000-00-00 00:00:00', 0, ''),
(6, 'D9A62020250616', 'Kipas Angin Maspion', 200000, 37, '2025-06-17 08:27:38', 3, 'Admin', '0000-00-00 00:00:00', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `password` text NOT NULL,
  `role` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `name`, `password`, `role`, `created_at`) VALUES
(2, 'sales@gmail.com', 'Sales', '$2y$10$.Rs2Le1ySx60jtNwJsP0ieTM2PAoJqI3dm9ZXU0tnZkmpblCPeshK', 'Sales', '2025-06-13 14:51:06'),
(3, 'admin@gmail.com', 'Admin', '$2y$10$xK6bZzLCNfAyvoHsXeZifu76pfoEuU0SHzMaY/rUU9.oFxJ7m56e6', 'Admin', '2025-06-13 14:50:24'),
(4, 'manager@gmail.com', 'Manager', '$2y$10$mgnN0zdIS6NKetNPzugxJOCZTm/xJgURgDpyH7vwvLYsweuE6qcBu', 'Manager', '2025-06-13 15:08:37');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders_detail`
--
ALTER TABLE `orders_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;
--
-- AUTO_INCREMENT for table `orders_detail`
--
ALTER TABLE `orders_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
