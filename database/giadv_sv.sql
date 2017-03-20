-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 20, 2017 at 04:05 AM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 7.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `giadv_sv`
--

-- --------------------------------------------------------

--
-- Table structure for table `cbkkdvvtkhac`
--

CREATE TABLE `cbkkdvvtkhac` (
  `id` int(10) UNSIGNED NOT NULL,
  `masothue` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `masokk` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `socv` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ngaynhap` date DEFAULT NULL,
  `socvlk` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ngaynhaplk` date DEFAULT NULL,
  `ngayhieuluc` date DEFAULT NULL,
  `ttnguoinop` text COLLATE utf8_unicode_ci,
  `ngaynhan` date DEFAULT NULL,
  `sohsnhan` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ngaychuyen` datetime DEFAULT NULL,
  `lydo` text COLLATE utf8_unicode_ci,
  `trangthai` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `uudai` text COLLATE utf8_unicode_ci,
  `ghichu` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cbkkdvvtxb`
--

CREATE TABLE `cbkkdvvtxb` (
  `id` int(10) UNSIGNED NOT NULL,
  `masothue` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `masokk` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `socv` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ngaynhap` date DEFAULT NULL,
  `socvlk` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ngaynhaplk` date DEFAULT NULL,
  `ngayhieuluc` date DEFAULT NULL,
  `ttnguoinop` text COLLATE utf8_unicode_ci,
  `ngaynhan` date DEFAULT NULL,
  `sohsnhan` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ngaychuyen` datetime DEFAULT NULL,
  `lydo` text COLLATE utf8_unicode_ci,
  `trangthai` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `uudai` text COLLATE utf8_unicode_ci,
  `ghichu` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cbkkdvvtxk`
--

CREATE TABLE `cbkkdvvtxk` (
  `id` int(10) UNSIGNED NOT NULL,
  `masothue` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `masokk` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `socv` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ngaynhap` date DEFAULT NULL,
  `socvlk` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ngaynhaplk` date DEFAULT NULL,
  `ngayhieuluc` date DEFAULT NULL,
  `ttnguoinop` text COLLATE utf8_unicode_ci,
  `ngaynhan` date DEFAULT NULL,
  `sohsnhan` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ngaychuyen` datetime DEFAULT NULL,
  `lydo` text COLLATE utf8_unicode_ci,
  `trangthai` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `uudai` text COLLATE utf8_unicode_ci,
  `ghichu` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cbkkdvvtxtx`
--

CREATE TABLE `cbkkdvvtxtx` (
  `id` int(10) UNSIGNED NOT NULL,
  `masothue` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `masokk` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `socv` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ngaynhap` date DEFAULT NULL,
  `socvlk` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ngaynhaplk` date DEFAULT NULL,
  `ngayhieuluc` date DEFAULT NULL,
  `ttnguoinop` text COLLATE utf8_unicode_ci,
  `ngaynhan` date DEFAULT NULL,
  `sohsnhan` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ngaychuyen` datetime DEFAULT NULL,
  `lydo` text COLLATE utf8_unicode_ci,
  `trangthai` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `uudai` text COLLATE utf8_unicode_ci,
  `ghichu` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cbkkgdvlt`
--

CREATE TABLE `cbkkgdvlt` (
  `id` int(10) UNSIGNED NOT NULL,
  `mahs` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `macskd` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `masothue` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ngaynhap` date DEFAULT NULL,
  `socv` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `socvlk` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ngaycvlk` date DEFAULT NULL,
  `ngayhieuluc` date DEFAULT NULL,
  `ttnguoinop` text COLLATE utf8_unicode_ci,
  `ngaynhan` date DEFAULT NULL,
  `sohsnhan` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ghichu` text COLLATE utf8_unicode_ci,
  `ngaychuyen` datetime DEFAULT NULL,
  `lydo` text COLLATE utf8_unicode_ci,
  `trangthai` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `idkk` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `cbkkgdvlt`
--

INSERT INTO `cbkkgdvlt` (`id`, `mahs`, `macskd`, `masothue`, `ngaynhap`, `socv`, `socvlk`, `ngaycvlk`, `ngayhieuluc`, `ttnguoinop`, `ngaynhan`, `sohsnhan`, `ghichu`, `ngaychuyen`, `lydo`, `trangthai`, `idkk`, `created_at`, `updated_at`) VALUES
(4, '1489115268', '01020276_1489114737', '01020276', '2017-03-10', '001', '', NULL, '2017-03-20', 'Minh Trần', '2017-03-10', '5', '', '2017-03-10 10:07:57', NULL, 'Đang công bố', '7', '2017-03-10 03:08:16', '2017-03-10 03:08:16');

-- --------------------------------------------------------

--
-- Table structure for table `cskddvlt`
--

CREATE TABLE `cskddvlt` (
  `id` int(10) UNSIGNED NOT NULL,
  `macskd` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `masothue` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tencskd` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `loaihang` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `diachikd` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telkd` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `toado` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `link` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cqcq` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `cskddvlt`
--

INSERT INTO `cskddvlt` (`id`, `macskd`, `masothue`, `tencskd`, `loaihang`, `diachikd`, `telkd`, `toado`, `link`, `cqcq`, `created_at`, `updated_at`) VALUES
(7, '01020276_1489114737', '01020276', 'Khách sạn Cuộc sống', '3', '98765432', '098765432', '', '', '07654321', '2017-03-10 02:58:58', '2017-03-10 02:58:58'),
(8, '01020276_1489115112', '01020276', 'Khách sạn Cuộc Sống 2', '3', '097654', '07654', '', '', '07654321', '2017-03-10 03:05:13', '2017-03-10 03:05:13');

-- --------------------------------------------------------

--
-- Table structure for table `dmdvql`
--

CREATE TABLE `dmdvql` (
  `id` int(10) UNSIGNED NOT NULL,
  `maqhns` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tendv` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `plql` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `diachi` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `level` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sohsnhan` text COLLATE utf8_unicode_ci NOT NULL,
  `ttlh` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `dmdvql`
--

INSERT INTO `dmdvql` (`id`, `maqhns`, `tendv`, `plql`, `diachi`, `level`, `username`, `password`, `sohsnhan`, `ttlh`, `created_at`, `updated_at`) VALUES
(4, '07654321', 'Sở Tài Chính Khánh Hòa', 'TC', 'Thành Phố Nha Trang - Tỉnh Khánh Hòa', 'T', 'stckhanhhoa', 'e10adc3949ba59abbe56e057f20f883e', '5', 'Sở Tài Chính: 058.3822072 (Phòng Thanh Tra) - 058.3826741 (Phòng Vật giá)\r\nSở Văn Hóa, Thể thao và Du lịch: 058.3826741 (Phòng Thanh Tra)\r\nCục Thuế tỉnh Khánh Hòa: 0583824332', '2017-02-10 03:08:36', '2017-03-10 03:08:16'),
(5, '1234567890', 'Sở Giao Thông Vận Tải Khánh Hòa', 'VT', 'Thành Phố Nha Trang - Tỉnh Khánh Hòa', 'T', 'sgtvtkhanhhoa', 'e10adc3949ba59abbe56e057f20f883e', '5', 'Sở Tài Chính: 058.3822072 (Phòng Thanh Tra) - 058.3826741 (Phòng Vật giá)\r\nSở Văn Hóa, Thể thao và Du lịch: 058.3826741 (Phòng Thanh Tra)\r\nCục Thuế tỉnh Khánh Hòa: 0583824332', '2017-02-10 03:16:02', '2017-02-17 02:44:17'),
(7, '021721932943', 'Phòng Tài Chính Huyện Cam Ranh', 'TC', 'Huyện Cam Ranh Tỉnh Khánh Hòa', 'H', 'ptccamranh', 'e10adc3949ba59abbe56e057f20f883e', '0', '', '2017-02-20 02:52:54', '2017-02-20 02:52:54');

-- --------------------------------------------------------

--
-- Table structure for table `dmdvvtkhac`
--

CREATE TABLE `dmdvvtkhac` (
  `id` int(10) UNSIGNED NOT NULL,
  `masothue` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `madichvu` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `loaixe` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `diemdau` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `diemcuoi` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tendichvu` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `qccl` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dvt` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ghichu` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dmdvvtxb`
--

CREATE TABLE `dmdvvtxb` (
  `id` int(10) UNSIGNED NOT NULL,
  `masothue` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `madichvu` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `diemdau` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `diemcuoi` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tendichvu` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `qccl` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dvtluot` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dvtthang` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ghichu` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dmdvvtxk`
--

CREATE TABLE `dmdvvtxk` (
  `id` int(10) UNSIGNED NOT NULL,
  `masothue` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `madichvu` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `loaixe` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `diemdau` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `diemcuoi` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tendichvu` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `qccl` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dvt` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ghichu` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dmdvvtxtx`
--

CREATE TABLE `dmdvvtxtx` (
  `id` int(10) UNSIGNED NOT NULL,
  `masothue` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `madichvu` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `loaixe` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tendichvu` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `qccl` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dvt` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ghichu` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `dmdvvtxtx`
--

INSERT INTO `dmdvvtxtx` (`id`, `masothue`, `madichvu`, `loaixe`, `tendichvu`, `qccl`, `dvt`, `ghichu`, `created_at`, `updated_at`) VALUES
(2, '0987654321', 'DVXTX09876543211489047416', 'Xe 4 chỗ', 'Vận tải chạy hợp đồng', 'Xe 4 chỗ , Hyundai - I10 grand', 'đồng', '', '2017-03-09 08:16:56', '2017-03-09 08:18:00');

-- --------------------------------------------------------

--
-- Table structure for table `dndvlt`
--

CREATE TABLE `dndvlt` (
  `id` int(10) UNSIGNED NOT NULL,
  `tendn` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `masothue` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `diachidn` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `teldn` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `faxdn` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `noidknopthue` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `giayphepkd` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `chucdanhky` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nguoiky` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `diadanh` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `trangthai` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tailieu` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cqcq` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `dndvlt`
--

INSERT INTO `dndvlt` (`id`, `tendn`, `masothue`, `diachidn`, `teldn`, `faxdn`, `email`, `noidknopthue`, `giayphepkd`, `chucdanhky`, `nguoiky`, `diadanh`, `trangthai`, `tailieu`, `cqcq`, `created_at`, `updated_at`) VALUES
(8, 'Công ty phát triển phần mềm Cuộc Sống', '01020276', 'Hà Nội', '0987654321', '0987654321', 'pmcuocsong@gmail.com', 'Cục Thuế Huyện Thanh Trì', '0102212121', 'Giám đốc', 'Nguyễn Thị Minh Tuyết', 'Hà Nội', 'Kích hoạt', 'sdsadsad', '07654321', '2017-03-09 07:48:45', '2017-03-09 07:54:52');

-- --------------------------------------------------------

--
-- Table structure for table `donvidvvt`
--

CREATE TABLE `donvidvvt` (
  `id` int(10) UNSIGNED NOT NULL,
  `masothue` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tendonvi` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `diachi` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dienthoai` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `giayphepkd` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fax` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `diadanh` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `chucdanh` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nguoiky` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dknopthue` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `setting` text COLLATE utf8_unicode_ci NOT NULL,
  `dvxk` tinyint(1) NOT NULL,
  `dvxb` tinyint(1) NOT NULL,
  `dvxtx` tinyint(1) NOT NULL,
  `dvk` tinyint(1) NOT NULL,
  `toado` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ghichu` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `trangthai` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tailieu` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `link` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cqcq` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `donvidvvt`
--

INSERT INTO `donvidvvt` (`id`, `masothue`, `tendonvi`, `diachi`, `dienthoai`, `giayphepkd`, `fax`, `email`, `diadanh`, `chucdanh`, `nguoiky`, `dknopthue`, `setting`, `dvxk`, `dvxb`, `dvxtx`, `dvk`, `toado`, `ghichu`, `trangthai`, `tailieu`, `link`, `cqcq`, `created_at`, `updated_at`) VALUES
(12, '0987654321', 'Công ty Phúc Phúc Đạt', 'Hà Nội', '0987654321', '09765439', '98765432', '', 'Hà Nội', 'Giám đốc', 'Nguyễn Thị Mỹ Hường', 'Cục Thuế Huyện Thanh Trì', '{"dvvt":{"vtxk":"1","vtxb":"1","vtxtx":"1","vtch":"1"}}', 1, 1, 1, 1, '21.0277644,105.8341598', NULL, 'Kích hoạt', 'sdsađá', '', '1234567890', '2017-03-09 08:01:33', '2017-03-09 08:06:52');

-- --------------------------------------------------------

--
-- Table structure for table `general-configs`
--

CREATE TABLE `general-configs` (
  `id` int(10) UNSIGNED NOT NULL,
  `maqhns` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tendonvilt` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tendonvivt` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `diachi` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `teldv` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `thutruong` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ketoan` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nguoilapbieu` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `namhethong` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ttlhlt` text COLLATE utf8_unicode_ci,
  `ttlhvt` text COLLATE utf8_unicode_ci,
  `sodvlt` text COLLATE utf8_unicode_ci,
  `sodvvt` text COLLATE utf8_unicode_ci,
  `setting` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `general-configs`
--

INSERT INTO `general-configs` (`id`, `maqhns`, `tendonvilt`, `tendonvivt`, `diachi`, `teldv`, `thutruong`, `ketoan`, `nguoilapbieu`, `namhethong`, `ttlhlt`, `ttlhvt`, `sodvlt`, `sodvvt`, `setting`, `created_at`, `updated_at`) VALUES
(1, '0987654321', 'Sở Tài Chính Cuộc Sống', 'Sở Giao Thông Vận Tải Cuộc Sống', 'T14- Liên Ninh- Thanh Trì- Hà Nội', '0987654321', 'Nguyễn Thị Minh Tuyết', 'Nguyễn Thị Mỹ Hạnh', 'Nguyễn Thị Mỹ Hường', '2016', 'b', 'a', '1', '6', '{"dvlt":{"dvlt":"1"},"dvvt":{"vtxk":"1","vtxb":"1","vtxtx":"1","vtch":"1"}}', NULL, '2017-03-08 04:06:37');

-- --------------------------------------------------------

--
-- Table structure for table `kkdvvtkhac`
--

CREATE TABLE `kkdvvtkhac` (
  `id` int(10) UNSIGNED NOT NULL,
  `masothue` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `masokk` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `socv` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ngaynhap` date DEFAULT NULL,
  `socvlk` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ngaynhaplk` date DEFAULT NULL,
  `ngayhieuluc` date DEFAULT NULL,
  `ttnguoinop` text COLLATE utf8_unicode_ci,
  `ngaynhan` date DEFAULT NULL,
  `sohsnhan` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ngaychuyen` datetime DEFAULT NULL,
  `lydo` text COLLATE utf8_unicode_ci,
  `trangthai` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `uudai` text COLLATE utf8_unicode_ci,
  `ghichu` text COLLATE utf8_unicode_ci,
  `cqcq` varchar(255) CHARACTER SET utf8 NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kkdvvtkhacct`
--

CREATE TABLE `kkdvvtkhacct` (
  `id` int(10) UNSIGNED NOT NULL,
  `masokk` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `madichvu` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `loaixe` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `diemdau` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `diemcuoi` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tendichvu` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `qccl` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dvt` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `giakk` double DEFAULT NULL,
  `giakklk` double DEFAULT NULL,
  `giahl` double DEFAULT NULL,
  `ghichu` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `thuevat` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kkdvvtkhacctdf`
--

CREATE TABLE `kkdvvtkhacctdf` (
  `id` int(10) UNSIGNED NOT NULL,
  `masothue` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `masokk` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `madichvu` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `loaixe` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `diemdau` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `diemcuoi` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tendichvu` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `qccl` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dvt` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `giakk` double DEFAULT NULL,
  `giakklk` double DEFAULT NULL,
  `giahl` double DEFAULT NULL,
  `ghichu` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `thuevat` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kkdvvtxb`
--

CREATE TABLE `kkdvvtxb` (
  `id` int(10) UNSIGNED NOT NULL,
  `masothue` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `masokk` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `socv` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ngaynhap` date DEFAULT NULL,
  `socvlk` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ngaynhaplk` date DEFAULT NULL,
  `ngayhieuluc` date DEFAULT NULL,
  `ttnguoinop` text COLLATE utf8_unicode_ci,
  `ngaynhan` date DEFAULT NULL,
  `sohsnhan` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ngaychuyen` datetime DEFAULT NULL,
  `lydo` text COLLATE utf8_unicode_ci,
  `trangthai` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `uudai` text COLLATE utf8_unicode_ci,
  `ghichu` text COLLATE utf8_unicode_ci,
  `cqcq` varchar(255) CHARACTER SET utf8 NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kkdvvtxbct`
--

CREATE TABLE `kkdvvtxbct` (
  `id` int(10) UNSIGNED NOT NULL,
  `madichvu` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `masokk` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tendichvu` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `diemdau` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `diemcuoi` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `qccl` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dvtluot` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dvtthang` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `giakkluot` double DEFAULT NULL,
  `giakklkluot` double DEFAULT NULL,
  `giakkthang` double DEFAULT NULL,
  `giakklkthang` double DEFAULT NULL,
  `ghichu` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `thuevat` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kkdvvtxbctdf`
--

CREATE TABLE `kkdvvtxbctdf` (
  `id` int(10) UNSIGNED NOT NULL,
  `masothue` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `masokk` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `madichvu` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tendichvu` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `diemdau` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `diemcuoi` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `qccl` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dvtluot` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dvtthang` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `giakkluot` double DEFAULT NULL,
  `giakklkluot` double DEFAULT NULL,
  `giakkthang` double DEFAULT NULL,
  `giakklkthang` double DEFAULT NULL,
  `ghichu` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `thuevat` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kkdvvtxk`
--

CREATE TABLE `kkdvvtxk` (
  `id` int(10) UNSIGNED NOT NULL,
  `masothue` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `masokk` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `socv` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ngaynhap` date DEFAULT NULL,
  `socvlk` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ngaynhaplk` date DEFAULT NULL,
  `ngayhieuluc` date DEFAULT NULL,
  `ttnguoinop` text COLLATE utf8_unicode_ci,
  `ngaynhan` date DEFAULT NULL,
  `sohsnhan` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ngaychuyen` datetime DEFAULT NULL,
  `lydo` text COLLATE utf8_unicode_ci,
  `trangthai` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `uudai` text COLLATE utf8_unicode_ci,
  `ghichu` text COLLATE utf8_unicode_ci,
  `cqcq` varchar(255) CHARACTER SET utf8 NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kkdvvtxkct`
--

CREATE TABLE `kkdvvtxkct` (
  `id` int(10) UNSIGNED NOT NULL,
  `masokk` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `madichvu` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `loaixe` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `diemdau` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `diemcuoi` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tendichvu` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `qccl` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dvt` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `giakk` double DEFAULT NULL,
  `giakklk` double DEFAULT NULL,
  `giahl` double DEFAULT NULL,
  `ghichu` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `thuevat` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kkdvvtxkctdf`
--

CREATE TABLE `kkdvvtxkctdf` (
  `id` int(10) UNSIGNED NOT NULL,
  `masokk` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `masothue` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `madichvu` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `loaixe` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `diemdau` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `diemcuoi` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tendichvu` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `qccl` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dvt` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `giakk` double DEFAULT NULL,
  `giakklk` double DEFAULT NULL,
  `giahl` double DEFAULT NULL,
  `ghichu` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `thuevat` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kkdvvtxtx`
--

CREATE TABLE `kkdvvtxtx` (
  `id` int(10) UNSIGNED NOT NULL,
  `masothue` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `masokk` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `socv` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ngaynhap` date DEFAULT NULL,
  `socvlk` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ngaynhaplk` date DEFAULT NULL,
  `ngayhieuluc` date DEFAULT NULL,
  `ttnguoinop` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telnguoinop` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `faxnguoinop` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ngaynhan` date DEFAULT NULL,
  `sohsnhan` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ngaychuyen` datetime DEFAULT NULL,
  `lydo` text COLLATE utf8_unicode_ci,
  `trangthai` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `uudai` text COLLATE utf8_unicode_ci,
  `ghichu` text COLLATE utf8_unicode_ci,
  `cqcq` varchar(255) CHARACTER SET utf8 NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `kkdvvtxtx`
--

INSERT INTO `kkdvvtxtx` (`id`, `masothue`, `masokk`, `socv`, `ngaynhap`, `socvlk`, `ngaynhaplk`, `ngayhieuluc`, `ttnguoinop`, `telnguoinop`, `faxnguoinop`, `ngaynhan`, `sohsnhan`, `ngaychuyen`, `lydo`, `trangthai`, `uudai`, `ghichu`, `cqcq`, `created_at`, `updated_at`) VALUES
(6, '0987654321', '0987654321_1489479171', '001', '2017-03-14', '', NULL, '2017-11-30', 'aaa', '', '', NULL, NULL, '2017-03-14 16:34:25', NULL, 'Chờ nhận', 'v', 'b', '1234567890', '2017-03-14 08:12:51', '2017-03-14 09:34:25'),
(7, '0987654321', '0987654321_1489653159', '002', '2017-03-16', '', NULL, '2017-03-18', 'a', 'b', 'c', NULL, NULL, '2017-03-16 15:46:12', NULL, 'Chờ nhận', '', '', '1234567890', '2017-03-16 08:32:39', '2017-03-16 08:46:12');

-- --------------------------------------------------------

--
-- Table structure for table `kkdvvtxtxct`
--

CREATE TABLE `kkdvvtxtxct` (
  `id` int(10) UNSIGNED NOT NULL,
  `masokk` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `madichvu` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `loaixe` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tendichvu` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `qccl` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dvt` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `giakk` double DEFAULT NULL,
  `trenkm` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `giakkden` double NOT NULL,
  `giakktl` double NOT NULL,
  `giakklk` double DEFAULT NULL,
  `trenkmlk` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `giakklkden` double NOT NULL,
  `giakklktl` double NOT NULL,
  `ghichu` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `thuevat` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `kkdvvtxtxct`
--

INSERT INTO `kkdvvtxtxct` (`id`, `masokk`, `madichvu`, `loaixe`, `tendichvu`, `qccl`, `dvt`, `giakk`, `trenkm`, `giakkden`, `giakktl`, `giakklk`, `trenkmlk`, `giakklkden`, `giakklktl`, `ghichu`, `thuevat`, `created_at`, `updated_at`) VALUES
(2, '0987654321_1489479171', 'DVXTX09876543211489047416', 'Xe 4 chỗ', 'Vận tải chạy hợp đồng', 'Xe 4 chỗ , Hyundai - I10 grand', 'đồng', 4000, '1', 4000, 4000, 500000, '1', 6000, 7000, 'aâ', NULL, NULL, '2017-03-14 09:12:47'),
(3, '0987654321_1489653159', 'DVXTX09876543211489047416', 'Xe 4 chỗ', 'Vận tải chạy hợp đồng', 'Xe 4 chỗ , Hyundai - I10 grand', 'đồng', 0, '1', 0, 0, 0, '1', 0, 0, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `kkdvvtxtxctdf`
--

CREATE TABLE `kkdvvtxtxctdf` (
  `id` int(10) UNSIGNED NOT NULL,
  `masothue` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `masokk` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `madichvu` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `loaixe` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tendichvu` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `qccl` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dvt` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `giakk` double DEFAULT NULL,
  `trenkm` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `giakkden` double NOT NULL,
  `giakktl` double NOT NULL,
  `giakklk` double DEFAULT NULL,
  `trenkmlk` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `giakklkden` double NOT NULL,
  `giakklktl` double NOT NULL,
  `ghichu` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `thuevat` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `kkdvvtxtxctdf`
--

INSERT INTO `kkdvvtxtxctdf` (`id`, `masothue`, `masokk`, `madichvu`, `loaixe`, `tendichvu`, `qccl`, `dvt`, `giakk`, `trenkm`, `giakkden`, `giakktl`, `giakklk`, `trenkmlk`, `giakklkden`, `giakklktl`, `ghichu`, `thuevat`, `created_at`, `updated_at`) VALUES
(225, '0987654321', NULL, 'DVXTX09876543211489047416', 'Xe 4 chỗ', 'Vận tải chạy hợp đồng', 'Xe 4 chỗ , Hyundai - I10 grand', 'đồng', 0, '1', 0, 0, 0, '1', 0, 0, NULL, NULL, '2017-03-16 08:32:21', '2017-03-16 08:32:21');

-- --------------------------------------------------------

--
-- Table structure for table `kkgdvlt`
--

CREATE TABLE `kkgdvlt` (
  `id` int(10) UNSIGNED NOT NULL,
  `mahs` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `macskd` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `masothue` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ngaynhap` date DEFAULT NULL,
  `socv` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `socvlk` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ngaycvlk` date DEFAULT NULL,
  `ngayhieuluc` date DEFAULT NULL,
  `ttnguoinop` text COLLATE utf8_unicode_ci,
  `ngaynhan` date DEFAULT NULL,
  `sohsnhan` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ghichu` text COLLATE utf8_unicode_ci,
  `ngaychuyen` datetime DEFAULT NULL,
  `lydo` text COLLATE utf8_unicode_ci,
  `trangthai` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cqcq` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `dvt` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `kkgdvlt`
--

INSERT INTO `kkgdvlt` (`id`, `mahs`, `macskd`, `masothue`, `ngaynhap`, `socv`, `socvlk`, `ngaycvlk`, `ngayhieuluc`, `ttnguoinop`, `ngaynhan`, `sohsnhan`, `ghichu`, `ngaychuyen`, `lydo`, `trangthai`, `cqcq`, `dvt`, `created_at`, `updated_at`) VALUES
(7, '1489115268', '01020276_1489114737', '01020276', '2017-03-10', '001', '', NULL, '2017-03-20', 'Minh Trần', '2017-03-10', '5', '', '2017-03-10 10:07:57', NULL, 'Duyệt', '07654321', 'Đồng/phòng/ngày đêm', '2017-03-10 03:07:48', '2017-03-10 03:08:16');

-- --------------------------------------------------------

--
-- Table structure for table `kkgdvltct`
--

CREATE TABLE `kkgdvltct` (
  `id` int(10) UNSIGNED NOT NULL,
  `macskd` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mahs` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `maloaip` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `loaip` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `qccl` text COLLATE utf8_unicode_ci,
  `sohieu` text COLLATE utf8_unicode_ci,
  `ghichu` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mucgialk` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mucgiakk` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `kkgdvltct`
--

INSERT INTO `kkgdvltct` (`id`, `macskd`, `mahs`, `maloaip`, `loaip`, `qccl`, `sohieu`, `ghichu`, `mucgialk`, `mucgiakk`, `created_at`, `updated_at`) VALUES
(14, '01020276_1489114737', '1489115268', '1489115036', 'Loai 1', '', '', '', '0', '200000', '2017-03-10 03:07:48', '2017-03-10 03:07:48'),
(15, '01020276_1489114737', '1489115268', '1489115041', 'Loại 2', '', '', '', '0', '300000', '2017-03-10 03:07:49', '2017-03-10 03:07:49'),
(16, '01020276_1489114737', '1489115268', '1489115059', 'Loại 3', '', '', '', '0', '400000', '2017-03-10 03:07:49', '2017-03-10 03:07:49');

-- --------------------------------------------------------

--
-- Table structure for table `kkgdvltctdf`
--

CREATE TABLE `kkgdvltctdf` (
  `id` int(10) UNSIGNED NOT NULL,
  `macskd` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `maloaip` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `loaip` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `qccl` text COLLATE utf8_unicode_ci,
  `sohieu` text COLLATE utf8_unicode_ci,
  `ghichu` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mucgialk` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mucgiakk` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `kkgdvltctdf`
--

INSERT INTO `kkgdvltctdf` (`id`, `macskd`, `maloaip`, `loaip`, `qccl`, `sohieu`, `ghichu`, `mucgialk`, `mucgiakk`, `created_at`, `updated_at`) VALUES
(191, '01020276_1489114737', '1489115036', 'Loai 1', '', '', '', '200000', NULL, '2017-03-13 03:54:02', '2017-03-13 03:54:02'),
(192, '01020276_1489114737', '1489115041', 'Loại 2', '', '', '', '300000', NULL, '2017-03-13 03:54:02', '2017-03-13 03:54:02'),
(193, '01020276_1489114737', '1489115059', 'Loại 3', '', '', '', '400000', NULL, '2017-03-13 03:54:02', '2017-03-13 03:54:02'),
(194, '01020276_1489114737', '1489377247', 'v', '', '', '', NULL, NULL, '2017-03-13 03:54:07', '2017-03-13 03:54:13');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2016_05_12_084832_create_dmdvvtxk_table', 1),
(3, '2016_05_12_084851_create_kkdvvtxk_table', 1),
(4, '2016_05_12_084900_create_kkdvvtxkct_table', 1),
(5, '2016_05_12_101616_create_dmdvvtxb_table', 1),
(6, '2016_05_12_101629_create_kkdvvtxb_table', 1),
(7, '2016_05_12_101638_create_kkdvvtxbct_table', 1),
(8, '2016_05_12_102628_create_dmdvvtxtx_table', 1),
(9, '2016_05_12_102651_create_kkdvvtxtx_table', 1),
(10, '2016_05_12_102701_create_kkdvvtxtxct_table', 1),
(11, '2016_05_12_104427_create_dmdvvtkhac_table', 1),
(12, '2016_05_12_104445_create_kkdvvtkhac_table', 1),
(13, '2016_05_12_104453_create_kkdvvtkhacct_table', 1),
(14, '2016_05_19_155134_create_kkdvvtxkctdf_table', 1),
(15, '2016_05_19_155151_create_kkdvvtxbctdf_table', 1),
(16, '2016_05_19_155213_create_kkdvvtxtxctdf_table', 1),
(17, '2016_05_19_155230_create_kkdvvtkhacctdf_table', 1),
(18, '2016_05_20_081755_create_cbkkdvvtxk_table', 1),
(19, '2016_05_20_081807_create_cbkkdvvtxb_table', 1),
(20, '2016_05_20_081819_create_cbkkdvvtxtx_table', 1),
(21, '2016_05_20_081831_create_cbkkdvvtkhac_table', 1),
(22, '2016_07_02_100830_create_pagdvvtxk_table', 1),
(23, '2016_07_02_101030_create_pagdvvtxb_table', 1),
(24, '2016_07_02_101055_create_pagdvvtxtx_table', 1),
(25, '2016_07_02_101116_create_pagdvvtkhac_table', 1),
(26, '2016_07_02_101408_create_pagdvvtkhac_temp_table', 1),
(27, '2016_07_02_101433_create_pagdvvtxb_temp_table', 1),
(28, '2016_07_02_101445_create_pagdvvtxk_temp_table', 1),
(29, '2016_07_02_101514_create_pagdvvtxtx_temp_table', 1),
(30, '2016_10_14_013710_create_dndvlt_table', 1),
(31, '2016_10_14_022915_create_general-configs_table', 1),
(32, '2016_10_18_014826_create_donvidvvt_table', 1),
(33, '2016_10_20_074005_create_cskddvlt_table', 1),
(34, '2016_10_20_082824_create_ttphong_table', 1),
(35, '2016_10_21_023223_create_ttcskddvlt_table', 1),
(36, '2016_10_21_073706_create_kkgdvlt_table', 1),
(37, '2016_10_21_083946_create_kkgdvltct_table', 1),
(38, '2016_10_21_084015_create_kkgdvltctdf_table', 1),
(39, '2016_10_22_025029_create_cbkkgdvlt_table', 1),
(40, '2016_11_03_092746_create_register_table', 1),
(41, '2016_12_12_110413_create_ttdn_table', 1),
(42, '2017_01_18_143042_create_dmdvql_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `pagdvvtkhac`
--

CREATE TABLE `pagdvvtkhac` (
  `id` int(10) UNSIGNED NOT NULL,
  `masothue` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `masokk` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `madichvu` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sanluong` double NOT NULL DEFAULT '0',
  `cpnguyenlieutt` double NOT NULL DEFAULT '0',
  `cpcongnhantt` double NOT NULL DEFAULT '0',
  `cpkhauhaott` double NOT NULL DEFAULT '0',
  `cpsanxuatdt` double NOT NULL DEFAULT '0',
  `cpsanxuatc` double NOT NULL DEFAULT '0',
  `cptaichinh` double NOT NULL DEFAULT '0',
  `cpbanhang` double NOT NULL DEFAULT '0',
  `cpquanly` double NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pagdvvtkhac_temp`
--

CREATE TABLE `pagdvvtkhac_temp` (
  `id` int(10) UNSIGNED NOT NULL,
  `masothue` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `masokk` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `madichvu` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sanluong` double NOT NULL DEFAULT '0',
  `cpnguyenlieutt` double NOT NULL DEFAULT '0',
  `cpcongnhantt` double NOT NULL DEFAULT '0',
  `cpkhauhaott` double NOT NULL DEFAULT '0',
  `cpsanxuatdt` double NOT NULL DEFAULT '0',
  `cpsanxuatc` double NOT NULL DEFAULT '0',
  `cptaichinh` double NOT NULL DEFAULT '0',
  `cpbanhang` double NOT NULL DEFAULT '0',
  `cpquanly` double NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pagdvvtxb`
--

CREATE TABLE `pagdvvtxb` (
  `id` int(10) UNSIGNED NOT NULL,
  `masothue` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `masokk` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `madichvu` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sanluong` double NOT NULL DEFAULT '0',
  `cpnguyenlieutt` double NOT NULL DEFAULT '0',
  `cpcongnhantt` double NOT NULL DEFAULT '0',
  `cpkhauhaott` double NOT NULL DEFAULT '0',
  `cpsanxuatdt` double NOT NULL DEFAULT '0',
  `cpsanxuatc` double NOT NULL DEFAULT '0',
  `cptaichinh` double NOT NULL DEFAULT '0',
  `cpbanhang` double NOT NULL DEFAULT '0',
  `cpquanly` double NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pagdvvtxb_temp`
--

CREATE TABLE `pagdvvtxb_temp` (
  `id` int(10) UNSIGNED NOT NULL,
  `masothue` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `masokk` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `madichvu` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sanluong` double NOT NULL DEFAULT '0',
  `cpnguyenlieutt` double NOT NULL DEFAULT '0',
  `cpcongnhantt` double NOT NULL DEFAULT '0',
  `cpkhauhaott` double NOT NULL DEFAULT '0',
  `cpsanxuatdt` double NOT NULL DEFAULT '0',
  `cpsanxuatc` double NOT NULL DEFAULT '0',
  `cptaichinh` double NOT NULL DEFAULT '0',
  `cpbanhang` double NOT NULL DEFAULT '0',
  `cpquanly` double NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pagdvvtxk`
--

CREATE TABLE `pagdvvtxk` (
  `id` int(10) UNSIGNED NOT NULL,
  `masothue` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `masokk` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `madichvu` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sanluong` double NOT NULL DEFAULT '0',
  `cpnguyenlieutt` double NOT NULL DEFAULT '0',
  `cpcongnhantt` double NOT NULL DEFAULT '0',
  `cpkhauhaott` double NOT NULL DEFAULT '0',
  `cpsanxuatdt` double NOT NULL DEFAULT '0',
  `cpsanxuatc` double NOT NULL DEFAULT '0',
  `cptaichinh` double NOT NULL DEFAULT '0',
  `cpbanhang` double NOT NULL DEFAULT '0',
  `cpquanly` double NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pagdvvtxk_temp`
--

CREATE TABLE `pagdvvtxk_temp` (
  `id` int(10) UNSIGNED NOT NULL,
  `masothue` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `masokk` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `madichvu` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sanluong` double NOT NULL DEFAULT '0',
  `cpnguyenlieutt` double NOT NULL DEFAULT '0',
  `cpcongnhantt` double NOT NULL DEFAULT '0',
  `cpkhauhaott` double NOT NULL DEFAULT '0',
  `cpsanxuatdt` double NOT NULL DEFAULT '0',
  `cpsanxuatc` double NOT NULL DEFAULT '0',
  `cptaichinh` double NOT NULL DEFAULT '0',
  `cpbanhang` double NOT NULL DEFAULT '0',
  `cpquanly` double NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pagdvvtxtx`
--

CREATE TABLE `pagdvvtxtx` (
  `id` int(10) UNSIGNED NOT NULL,
  `masothue` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `masokk` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `madichvu` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sanluong` double NOT NULL DEFAULT '0',
  `cpnguyenlieutt` double NOT NULL DEFAULT '0',
  `cpcongnhantt` double NOT NULL DEFAULT '0',
  `cpkhauhaott` double NOT NULL DEFAULT '0',
  `cpsanxuatdt` double NOT NULL DEFAULT '0',
  `cpsanxuatc` double NOT NULL DEFAULT '0',
  `cptaichinh` double NOT NULL DEFAULT '0',
  `cpbanhang` double NOT NULL DEFAULT '0',
  `cpquanly` double NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pagdvvtxtx_temp`
--

CREATE TABLE `pagdvvtxtx_temp` (
  `id` int(10) UNSIGNED NOT NULL,
  `masothue` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `masokk` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `madichvu` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sanluong` double NOT NULL DEFAULT '0',
  `cpnguyenlieutt` double NOT NULL DEFAULT '0',
  `cpcongnhantt` double NOT NULL DEFAULT '0',
  `cpkhauhaott` double NOT NULL DEFAULT '0',
  `cpsanxuatdt` double NOT NULL DEFAULT '0',
  `cpsanxuatc` double NOT NULL DEFAULT '0',
  `cptaichinh` double NOT NULL DEFAULT '0',
  `cpbanhang` double NOT NULL DEFAULT '0',
  `cpquanly` double NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `pagdvvtxtx_temp`
--

INSERT INTO `pagdvvtxtx_temp` (`id`, `masothue`, `masokk`, `madichvu`, `sanluong`, `cpnguyenlieutt`, `cpcongnhantt`, `cpkhauhaott`, `cpsanxuatdt`, `cpsanxuatc`, `cptaichinh`, `cpbanhang`, `cpquanly`, `created_at`, `updated_at`) VALUES
(168, '0987654321', NULL, 'DVXTX09876543211489047416', 0, 0, 0, 0, 0, 0, 0, 0, 0, '2017-03-16 08:32:21', '2017-03-16 08:32:21');

-- --------------------------------------------------------

--
-- Table structure for table `register`
--

CREATE TABLE `register` (
  `id` int(10) UNSIGNED NOT NULL,
  `masothue` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tendn` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `diachi` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tel` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fax` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `diadanh` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `chucdanh` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nguoiky` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `noidknopthue` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `setting` text COLLATE utf8_unicode_ci,
  `dvxk` tinyint(1) NOT NULL,
  `dvxb` tinyint(1) NOT NULL,
  `dvxtx` tinyint(1) NOT NULL,
  `dvk` tinyint(1) NOT NULL,
  `toado` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ghichu` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `trangthai` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tailieu` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `giayphepkd` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lydo` text COLLATE utf8_unicode_ci NOT NULL,
  `pl` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cqcq` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `ma` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `register`
--

INSERT INTO `register` (`id`, `masothue`, `tendn`, `diachi`, `tel`, `fax`, `email`, `diadanh`, `chucdanh`, `nguoiky`, `noidknopthue`, `setting`, `dvxk`, `dvxb`, `dvxtx`, `dvk`, `toado`, `ghichu`, `trangthai`, `tailieu`, `giayphepkd`, `username`, `password`, `lydo`, `pl`, `cqcq`, `created_at`, `updated_at`, `ma`) VALUES
(1, 'a', 'a', 'a', 'a', 'a', 'a', NULL, NULL, NULL, 'a', '', 0, 0, 0, 0, NULL, NULL, 'Chờ duyệt', 'a', 'a', 'a', '0cc175b9c0f1b6a831c399e269772661', '', 'DVLT', '07654321', '2017-03-17 08:07:13', '2017-03-17 08:07:13', '1489738033');

-- --------------------------------------------------------

--
-- Table structure for table `ttcskddvlt`
--

CREATE TABLE `ttcskddvlt` (
  `id` int(10) UNSIGNED NOT NULL,
  `maloaip` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `loaip` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `qccl` text COLLATE utf8_unicode_ci,
  `sohieu` text COLLATE utf8_unicode_ci,
  `ghichu` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `macskd` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ttcskddvlt`
--

INSERT INTO `ttcskddvlt` (`id`, `maloaip`, `loaip`, `qccl`, `sohieu`, `ghichu`, `macskd`, `created_at`, `updated_at`) VALUES
(17, '1489115036', 'Loai 1', '', '', '', '01020276_1489114737', '2017-03-10 03:03:56', '2017-03-10 03:03:56'),
(18, '1489115041', 'Loại 2', '', '', '', '01020276_1489114737', '2017-03-10 03:04:01', '2017-03-10 03:04:01'),
(19, '1489115059', 'Loại 3', '', '', '', '01020276_1489114737', '2017-03-10 03:04:19', '2017-03-10 03:04:19'),
(20, '1489115094', 'amazon', '', '', '', '01020276_1489115112', '2017-03-10 03:05:13', '2017-03-10 03:05:13'),
(21, '1489115101', 'nhiet đới', '', '', '', '01020276_1489115112', '2017-03-10 03:05:13', '2017-03-10 03:05:13');

-- --------------------------------------------------------

--
-- Table structure for table `ttdn`
--

CREATE TABLE `ttdn` (
  `id` int(10) UNSIGNED NOT NULL,
  `masothue` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tendn` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `diachi` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tel` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fax` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `diadanh` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `chucdanhky` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nguoiky` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `noidknopthue` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `giayphepkd` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tailieu` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `setting` text COLLATE utf8_unicode_ci,
  `dvxk` tinyint(1) NOT NULL,
  `dvxb` tinyint(1) NOT NULL,
  `dvxtx` tinyint(1) NOT NULL,
  `dvk` tinyint(1) NOT NULL,
  `toado` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ghichu` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `trangthai` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pl` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `link` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `cqcq` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ttphong`
--

CREATE TABLE `ttphong` (
  `id` int(10) UNSIGNED NOT NULL,
  `maloaip` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `loaip` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `qccl` text COLLATE utf8_unicode_ci,
  `sohieu` text COLLATE utf8_unicode_ci,
  `ghichu` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `masothue` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ttphong`
--

INSERT INTO `ttphong` (`id`, `maloaip`, `loaip`, `qccl`, `sohieu`, `ghichu`, `masothue`, `created_at`, `updated_at`) VALUES
(18, '1489115094', 'amazon', '', '', '', '01020276', '2017-03-10 03:04:54', '2017-03-10 03:04:54'),
(19, '1489115101', 'nhiet đới', '', '', '', '01020276', '2017-03-10 03:05:01', '2017-03-10 03:05:01');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `maxa` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mahuyen` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cqcq` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `level` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sadmin` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `permission` text COLLATE utf8_unicode_ci,
  `pldv` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `emailxt` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `question` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `answer` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `phone`, `email`, `status`, `maxa`, `mahuyen`, `cqcq`, `level`, `sadmin`, `permission`, `pldv`, `emailxt`, `question`, `answer`, `created_at`, `updated_at`) VALUES
(1, 'Minh Trần', 'minhtran', '107e8cf7f2b4531f6b2ff06dbcf94e10', '01232150988', 'minhtranlife@gmail.com', 'Kích hoạt', NULL, NULL, NULL, 'T', 'ssa', '{"dvlt":{"index":"1","create":"1","edit":"1","delete":"1"},"kkdvlt":{"index":"1","create":"1","edit":"1","delete":"1","approve":"1"},"ttdndvlt":{"approve":"1"},"dvvtxk":{"index":"1","create":"1","edit":"1","delete":"1"},"kkdvvtxk":{"index":"1","create":"1","edit":"1","delete":"1","approve":"1"},"dvvtxb":{"index":"1","create":"1","edit":"1","delete":"1"},"kkdvvtxb":{"index":"1","create":"1","edit":"1","delete":"1"},"dvvtxtx":{"index":"1","create":"1","edit":"1","delete":"1"},"kkdvvtxtx":{"index":"1","create":"1","edit":"1","delete":"1","approve":"1"},"dvvtch":{"index":"1","create":"1","edit":"1","delete":"1"},"kkdvvtch":{"index":"1","create":"1","edit":"1","delete":"1","approve":"1"},"ttdndvvt":{"approve":"1"}}', NULL, 'minhtranlife@gmail.com', '1', 'cho', NULL, '2017-02-17 08:33:28'),
(9, 'Quản trị hệ thống Sở Tài Chính', 'qtsotaichinh', 'e10adc3949ba59abbe56e057f20f883e', '', '', 'Kích hoạt', NULL, NULL, '07654321', 'T', 'satc', '', NULL, NULL, NULL, NULL, NULL, '2017-03-09 07:34:41'),
(12, 'Quản trị hệ thống Sở Giao Thông Vận Tải', 'qtsogiaothongvantai', 'e10adc3949ba59abbe56e057f20f883e', NULL, NULL, 'Kích hoạt', NULL, NULL, '1234567890', 'T', 'savt', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(13, 'Sở Tài Chính Khánh Hòa', 'stckhanhhoa', 'e10adc3949ba59abbe56e057f20f883e', '', '', 'Kích hoạt', NULL, NULL, '07654321', 'T', NULL, '{"kkdvlt":{"index":"1","approve":"1"},"ttdndvlt":{"approve":"1"},"kkdvvtxk":{"index":"1"},"kkdvvtxb":{"index":"1"},"kkdvvtxtx":{"index":"1"},"kkdvvtch":{"index":"1"}}', NULL, NULL, NULL, NULL, '2017-02-10 03:08:36', '2017-03-09 07:34:49'),
(14, 'Sở Giao Thông Vận Tải Khánh Hòa', 'sgtvtkhanhhoa', 'e10adc3949ba59abbe56e057f20f883e', NULL, NULL, 'Kích hoạt', NULL, NULL, '1234567890', 'T', NULL, '{"kkdvvtxk":{"index":"1","approve":"1"},"kkdvvtxb":{"index":"1","approve":"1"},"kkdvvtxtx":{"index":"1","approve":"1"},"kkdvvtch":{"index":"1","approve":"1"},"ttdndvvt":{"approve":"1"}}', NULL, NULL, NULL, NULL, '2017-02-10 03:16:02', '2017-02-10 03:16:52'),
(17, 'Phòng Tài Chính Huyện Cam Ranh', 'ptccamranh', 'e10adc3949ba59abbe56e057f20f883e', NULL, NULL, 'Kích hoạt', NULL, NULL, '021721932943', 'H', NULL, NULL, NULL, NULL, NULL, NULL, '2017-02-20 02:52:54', '2017-02-20 02:52:54'),
(30, 'Công ty phát triển phần mềm Cuộc Sống', 'cuocsong', 'e10adc3949ba59abbe56e057f20f883e', NULL, 'pmcuocsong@gmail.com', 'Kích hoạt', NULL, '01020276', '07654321', 'DVLT', NULL, NULL, NULL, NULL, NULL, NULL, '2017-03-09 07:48:46', '2017-03-09 07:48:46'),
(31, 'Công ty Phúc Phúc Đạt', 'phucphucdat', 'e10adc3949ba59abbe56e057f20f883e', '076543', 'phucphucdat@gmail.com', 'Kích hoạt', NULL, '0987654321', '1234567890', 'DVVT', NULL, NULL, NULL, NULL, NULL, NULL, '2017-03-09 08:01:33', '2017-03-09 08:01:33');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cbkkdvvtkhac`
--
ALTER TABLE `cbkkdvvtkhac`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cbkkdvvtxb`
--
ALTER TABLE `cbkkdvvtxb`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cbkkdvvtxk`
--
ALTER TABLE `cbkkdvvtxk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cbkkdvvtxtx`
--
ALTER TABLE `cbkkdvvtxtx`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cbkkgdvlt`
--
ALTER TABLE `cbkkgdvlt`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cskddvlt`
--
ALTER TABLE `cskddvlt`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dmdvql`
--
ALTER TABLE `dmdvql`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dmdvvtkhac`
--
ALTER TABLE `dmdvvtkhac`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dmdvvtxb`
--
ALTER TABLE `dmdvvtxb`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dmdvvtxk`
--
ALTER TABLE `dmdvvtxk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dmdvvtxtx`
--
ALTER TABLE `dmdvvtxtx`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dndvlt`
--
ALTER TABLE `dndvlt`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `donvidvvt`
--
ALTER TABLE `donvidvvt`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `general-configs`
--
ALTER TABLE `general-configs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kkdvvtkhac`
--
ALTER TABLE `kkdvvtkhac`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kkdvvtkhacct`
--
ALTER TABLE `kkdvvtkhacct`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kkdvvtkhacctdf`
--
ALTER TABLE `kkdvvtkhacctdf`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kkdvvtxb`
--
ALTER TABLE `kkdvvtxb`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kkdvvtxbct`
--
ALTER TABLE `kkdvvtxbct`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kkdvvtxbctdf`
--
ALTER TABLE `kkdvvtxbctdf`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kkdvvtxk`
--
ALTER TABLE `kkdvvtxk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kkdvvtxkct`
--
ALTER TABLE `kkdvvtxkct`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kkdvvtxkctdf`
--
ALTER TABLE `kkdvvtxkctdf`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kkdvvtxtx`
--
ALTER TABLE `kkdvvtxtx`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kkdvvtxtxct`
--
ALTER TABLE `kkdvvtxtxct`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kkdvvtxtxctdf`
--
ALTER TABLE `kkdvvtxtxctdf`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kkgdvlt`
--
ALTER TABLE `kkgdvlt`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kkgdvltct`
--
ALTER TABLE `kkgdvltct`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kkgdvltctdf`
--
ALTER TABLE `kkgdvltctdf`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pagdvvtkhac`
--
ALTER TABLE `pagdvvtkhac`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pagdvvtkhac_temp`
--
ALTER TABLE `pagdvvtkhac_temp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pagdvvtxb`
--
ALTER TABLE `pagdvvtxb`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pagdvvtxb_temp`
--
ALTER TABLE `pagdvvtxb_temp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pagdvvtxk`
--
ALTER TABLE `pagdvvtxk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pagdvvtxk_temp`
--
ALTER TABLE `pagdvvtxk_temp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pagdvvtxtx`
--
ALTER TABLE `pagdvvtxtx`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pagdvvtxtx_temp`
--
ALTER TABLE `pagdvvtxtx_temp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `register`
--
ALTER TABLE `register`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ttcskddvlt`
--
ALTER TABLE `ttcskddvlt`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ttdn`
--
ALTER TABLE `ttdn`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ttphong`
--
ALTER TABLE `ttphong`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cbkkdvvtkhac`
--
ALTER TABLE `cbkkdvvtkhac`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `cbkkdvvtxb`
--
ALTER TABLE `cbkkdvvtxb`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `cbkkdvvtxk`
--
ALTER TABLE `cbkkdvvtxk`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `cbkkdvvtxtx`
--
ALTER TABLE `cbkkdvvtxtx`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `cbkkgdvlt`
--
ALTER TABLE `cbkkgdvlt`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `cskddvlt`
--
ALTER TABLE `cskddvlt`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `dmdvql`
--
ALTER TABLE `dmdvql`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `dmdvvtkhac`
--
ALTER TABLE `dmdvvtkhac`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `dmdvvtxb`
--
ALTER TABLE `dmdvvtxb`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `dmdvvtxk`
--
ALTER TABLE `dmdvvtxk`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `dmdvvtxtx`
--
ALTER TABLE `dmdvvtxtx`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `dndvlt`
--
ALTER TABLE `dndvlt`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `donvidvvt`
--
ALTER TABLE `donvidvvt`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `general-configs`
--
ALTER TABLE `general-configs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `kkdvvtkhac`
--
ALTER TABLE `kkdvvtkhac`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `kkdvvtkhacct`
--
ALTER TABLE `kkdvvtkhacct`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `kkdvvtkhacctdf`
--
ALTER TABLE `kkdvvtkhacctdf`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `kkdvvtxb`
--
ALTER TABLE `kkdvvtxb`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `kkdvvtxbct`
--
ALTER TABLE `kkdvvtxbct`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `kkdvvtxbctdf`
--
ALTER TABLE `kkdvvtxbctdf`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `kkdvvtxk`
--
ALTER TABLE `kkdvvtxk`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `kkdvvtxkct`
--
ALTER TABLE `kkdvvtxkct`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `kkdvvtxkctdf`
--
ALTER TABLE `kkdvvtxkctdf`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `kkdvvtxtx`
--
ALTER TABLE `kkdvvtxtx`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `kkdvvtxtxct`
--
ALTER TABLE `kkdvvtxtxct`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `kkdvvtxtxctdf`
--
ALTER TABLE `kkdvvtxtxctdf`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=226;
--
-- AUTO_INCREMENT for table `kkgdvlt`
--
ALTER TABLE `kkgdvlt`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `kkgdvltct`
--
ALTER TABLE `kkgdvltct`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `kkgdvltctdf`
--
ALTER TABLE `kkgdvltctdf`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=195;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
--
-- AUTO_INCREMENT for table `pagdvvtkhac`
--
ALTER TABLE `pagdvvtkhac`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pagdvvtkhac_temp`
--
ALTER TABLE `pagdvvtkhac_temp`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pagdvvtxb`
--
ALTER TABLE `pagdvvtxb`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pagdvvtxb_temp`
--
ALTER TABLE `pagdvvtxb_temp`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pagdvvtxk`
--
ALTER TABLE `pagdvvtxk`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pagdvvtxk_temp`
--
ALTER TABLE `pagdvvtxk_temp`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pagdvvtxtx`
--
ALTER TABLE `pagdvvtxtx`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pagdvvtxtx_temp`
--
ALTER TABLE `pagdvvtxtx_temp`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=169;
--
-- AUTO_INCREMENT for table `register`
--
ALTER TABLE `register`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `ttcskddvlt`
--
ALTER TABLE `ttcskddvlt`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `ttdn`
--
ALTER TABLE `ttdn`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ttphong`
--
ALTER TABLE `ttphong`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
