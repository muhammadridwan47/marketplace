-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 06 Jun 2020 pada 08.16
-- Versi server: 10.1.37-MariaDB
-- Versi PHP: 7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `marketplace`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `click_referal`
--

CREATE TABLE `click_referal` (
  `id_barang` varchar(30) NOT NULL,
  `referal` varchar(30) NOT NULL,
  `email` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `colection`
--

CREATE TABLE `colection` (
  `id` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `nama_barang` varchar(255) DEFAULT NULL,
  `jenis` varchar(200) NOT NULL,
  `harga_dekstop` int(11) DEFAULT NULL,
  `gambar1` varchar(255) DEFAULT NULL,
  `lokasi_gambar` varchar(255) DEFAULT NULL,
  `add` varchar(255) NOT NULL,
  `email` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `komentar`
--

CREATE TABLE `komentar` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `tipe` varchar(200) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `review` varchar(255) NOT NULL,
  `rating` varchar(200) NOT NULL,
  `id_barang` int(11) DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `komentar`
--

INSERT INTO `komentar` (`id`, `nama`, `tipe`, `email`, `review`, `rating`, `id_barang`, `gambar`) VALUES
(48, 'akifatypestudio', 'desainer', 'rolilaz47@gmail.com', 'dawdaw', '', 53, 'gambar profile/rolilaz/kucing.jpg'),
(49, 'Aqeela Studio', 'pengunjung', 'angga@gmail.com', 'bagus', '', 53, 'gambar profile/aqeela/profile1.png'),
(50, 'Aqeela Studio', 'pembeli', 'angga@gmail.com', 'bagus', '', 53, 'gambar profile/aqeela/profile1.png'),
(51, 'akifatypestudio', 'desainer', 'rolilaz47@gmail.com', 'bagus', '', 53, 'gambar profile/rolilaz/kucing.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `komentar_desainer`
--

CREATE TABLE `komentar_desainer` (
  `id` int(11) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `tipe` varchar(200) NOT NULL,
  `review` text NOT NULL,
  `email` varchar(200) NOT NULL,
  `desainer` varchar(200) NOT NULL,
  `gambar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `konfirmasi_transaksi`
--

CREATE TABLE `konfirmasi_transaksi` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `id_transaksi` varchar(255) NOT NULL,
  `harga` varchar(200) NOT NULL,
  `price` float NOT NULL,
  `nomor_item` int(11) NOT NULL,
  `status` varchar(200) NOT NULL,
  `email_paypal` varchar(200) NOT NULL,
  `time` int(11) NOT NULL,
  `waktu` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `konfirmasi_transaksi`
--

INSERT INTO `konfirmasi_transaksi` (`id`, `username`, `email`, `id_transaksi`, `harga`, `price`, `nomor_item`, `status`, `email_paypal`, `time`, `waktu`) VALUES
(67, 'rolilaz', 'rolilaz47@gmail.com', 'PTFMWAE1EE2VZRUAE5IKQ', 'Credit $100', 100, 3, 'sukses', 'yulismunandar17@gmail.com', 1589857058, '19-05-2020'),
(68, 'rolilaz', 'rolilaz47@gmail.com', 'ZNQUXQAG2WFUXFPHZ43T8A', 'Credit $50', 50, 2, 'sukses', 'yulismunandar17@gmail.com', 1589857115, '19-05-2020'),
(69, 'rolilaz', 'rolilaz47@gmail.com', '8IWTZ4LZMLNOX1PUXGS9FW', 'Credit $100', 100, 3, 'pending', '', 1589859539, '19-05-2020'),
(70, 'rolilaz', 'rolilaz47@gmail.com', '1DFVJRJXJV9J00KYAHXVYW', 'Credit $25', 25, 1, 'pending', '', 1589871947, '19-05-2020'),
(71, 'rolilaz', 'rolilaz47@gmail.com', 'D84UYCK2HMB0RIEJYVNDTW', 'Credit $50', 50, 2, 'pending', '', 1589871950, '19-05-2020'),
(72, 'rolilaz', 'rolilaz47@gmail.com', 'XSEBPSQXDAZDF8G04DLOUG', 'Credit $25', 25, 1, 'sukses', 'yulismunandar17@gmail.com', 1589872136, '19-05-2020'),
(73, 'rolilaz', 'rolilaz47@gmail.com', 'BLEXT5FA4HRGGAX0CHGQ', 'Credit $100', 100, 3, 'sukses', 'yulismunandar17@gmail.com', 1589872272, '19-05-2020'),
(74, 'rolilaz', 'rolilaz47@gmail.com', '98S1KA9XS6KXLKMKLDKGA', 'Credit $100', 100, 3, 'pending', '', 1589896083, '19-05-2020'),
(75, 'rolilaz', 'rolilaz47@gmail.com', 'SUKWHDBXQYZDLDKAQFZJLW', 'Credit $100', 100, 3, 'sukses', 'yulismunandar17@gmail.com', 1589896124, '19-05-2020'),
(76, 'aqeela', 'angga@gmail.com', '7QLCPQWRDCKUGZNNBOVFSG', 'Credit $100', 100, 3, 'sukses', 'yulismunandar17@gmail.com', 1589965144, '20-05-2020'),
(77, 'rolilaz', 'rolilaz47@gmail.com', 'PC7JXXTMTMDKE7P4CMZ6IW', 'Credit $100', 100, 3, 'pending', '', 1590038278, '21-05-2020'),
(78, 'rolilaz', 'rolilaz47@gmail.com', '1GM3BFBUHJEIYQKC93UYGQ', 'Credit $100', 100, 3, 'pending', '', 1590038346, '21-05-2020'),
(79, 'rolilaz', 'rolilaz47@gmail.com', 'DWOCK3YYDROMSOJGLXWQGA', 'Credit $25', 25, 1, 'pending', '', 1590038355, '21-05-2020'),
(80, 'rolilaz', 'rolilaz47@gmail.com', 'NM3JTYRJBZZIUZECB9AXEQ', 'Credit $50', 50, 2, 'pending', '', 1590038363, '21-05-2020'),
(81, 'rolilaz', 'rolilaz47@gmail.com', 'NBUCRRBJ1WPW0S26SNS0EW', 'Credit $50', 50, 2, 'pending', '', 1590038907, '21-05-2020'),
(82, 'rolilaz', 'rolilaz47@gmail.com', 'MATXOWY5DXYZL5SV1YSEG', 'Credit $100', 100, 3, 'pending', '', 1590038914, '21-05-2020'),
(83, 'rolilaz', 'rolilaz47@gmail.com', 'RTSFKF4VYQT17LGZ3SZDFQ', 'Credit $50', 50, 2, 'pending', '', 1590038922, '21-05-2020'),
(84, 'rolilaz', 'rolilaz47@gmail.com', 'TBNNIEM5DUSL07YRDKDEW', 'Credit $100', 100, 3, 'pending', '', 1590038931, '21-05-2020'),
(85, 'rolilaz', 'rolilaz47@gmail.com', 'KLK0YUCFDDUWUIVKTXOZFA', 'Credit $100', 100, 3, 'pending', '', 1590038933, '21-05-2020'),
(86, 'rolilaz', 'rolilaz47@gmail.com', 'MRAKU5NOWWWMWIA9JSZW', 'Credit $100', 100, 3, 'pending', '', 1590038935, '21-05-2020'),
(87, 'rolilaz', 'rolilaz47@gmail.com', 'ZPOYHJVVXKXFTEGBME4EW', 'Credit $100', 100, 3, 'pending', '', 1590038937, '21-05-2020'),
(88, 'rolilaz', 'rolilaz47@gmail.com', 'LHVYLYPL6ULYECOZNR60A', 'Credit $100', 100, 3, 'pending', '', 1590038939, '21-05-2020'),
(89, 'rolilaz', 'rolilaz47@gmail.com', 'K60OTXYWQPAZJ07Q1U0MW', 'Credit $100', 100, 3, 'pending', '', 1590043822, '21-05-2020'),
(90, 'rolilaz', 'rolilaz47@gmail.com', 'NLWBRRETIAKZ5THPE0KSYG', 'Credit $100', 100, 3, 'pending', '', 1590903984, '31-05-2020');

-- --------------------------------------------------------

--
-- Struktur dari tabel `payments`
--

CREATE TABLE `payments` (
  `payment_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `txn_id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `payment_gross` float(10,2) NOT NULL,
  `currency_code` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `payer_email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `payment_status` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengajuan`
--

CREATE TABLE `pengajuan` (
  `id` int(11) NOT NULL,
  `username` varchar(200) DEFAULT NULL,
  `namatoko` varchar(200) NOT NULL,
  `alasan` text NOT NULL,
  `email` varchar(200) DEFAULT NULL,
  `website` varchar(200) DEFAULT NULL,
  `status` varchar(200) DEFAULT NULL,
  `role_id` int(11) NOT NULL,
  `tanggal` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pengajuan`
--

INSERT INTO `pengajuan` (`id`, `username`, `namatoko`, `alasan`, `email`, `website`, `status`, `role_id`, `tanggal`) VALUES
(6, 'font droe', '', 'wdada', 'fontdroe@gmail.com', 'dwada', 'affiliasi', 2, 1591253090),
(7, 'font droe', '', '', 'fontdroe@gmail.com', NULL, 'designer', 3, 1591254133);

-- --------------------------------------------------------

--
-- Struktur dari tabel `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `point` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `waktu_rating` int(11) NOT NULL,
  `jenis` varchar(200) NOT NULL,
  `harga_dekstop` int(11) NOT NULL,
  `harga_web` int(11) NOT NULL,
  `harga_app` int(11) NOT NULL,
  `harga_premium` int(11) DEFAULT NULL,
  `deskripsi` text,
  `tagline` varchar(255) NOT NULL,
  `tag` varchar(255) DEFAULT NULL,
  `file_web` varchar(255) NOT NULL,
  `file_dekstop` varchar(255) NOT NULL,
  `file_app` varchar(255) NOT NULL,
  `file_gratis` varchar(255) NOT NULL,
  `file_premium` varchar(255) DEFAULT NULL,
  `lokasi_gratis` varchar(255) DEFAULT NULL,
  `lokasi_premium` varchar(255) DEFAULT NULL,
  `lokasi_dekstop` varchar(255) DEFAULT NULL,
  `lokasi_app` varchar(255) DEFAULT NULL,
  `lokasi_web` varchar(255) DEFAULT NULL,
  `format_file` varchar(255) NOT NULL,
  `kategori` varchar(255) NOT NULL,
  `tanggal` varchar(200) NOT NULL,
  `lokasi_gambar` varchar(200) NOT NULL,
  `gambar1` varchar(255) NOT NULL,
  `gambar2` varchar(255) NOT NULL,
  `gambar3` varchar(255) NOT NULL,
  `gambar4` varchar(255) NOT NULL,
  `gambar5` varchar(255) NOT NULL,
  `imagecard` varchar(255) NOT NULL,
  `image1thumbnail` varchar(255) NOT NULL,
  `image2thumbnail` varchar(255) NOT NULL,
  `image3thumbnail` varchar(255) NOT NULL,
  `image4thumbnail` varchar(255) NOT NULL,
  `image5thumbnail` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `id_barang` varchar(200) NOT NULL,
  `status` int(1) NOT NULL,
  `tanggal_upload` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `product`
--

INSERT INTO `product` (`id`, `nama_barang`, `point`, `rating`, `waktu_rating`, `jenis`, `harga_dekstop`, `harga_web`, `harga_app`, `harga_premium`, `deskripsi`, `tagline`, `tag`, `file_web`, `file_dekstop`, `file_app`, `file_gratis`, `file_premium`, `lokasi_gratis`, `lokasi_premium`, `lokasi_dekstop`, `lokasi_app`, `lokasi_web`, `format_file`, `kategori`, `tanggal`, `lokasi_gambar`, `gambar1`, `gambar2`, `gambar3`, `gambar4`, `gambar5`, `imagecard`, `image1thumbnail`, `image2thumbnail`, `image3thumbnail`, `image4thumbnail`, `image5thumbnail`, `email`, `id_barang`, `status`, `tanggal_upload`) VALUES
(1, 'barang', 2, 298980, 1591424112, 'Font', 9, 9, 9, NULL, 'a', 'a', NULL, 'Angies Luis.zip', 'Angies Luis.zip', 'Angies Luis.zip', 'Angies Luis.zip', NULL, 'produk/aqeela/Font/barang/Sans Serif/free/', NULL, 'produk/aqeela/Font/barang/Sans Serif/desktop/', 'produk/aqeela/Font/barang/Sans Serif/app/', 'produk/aqeela/Font/barang/Sans Serif/web/', 'ttf/otf/ttf/otfttf/otfttf/otf', 'Sans Serif', '1591264856', 'gambar/aqeela/barang/', 'barang1.jpg', 'barang2.jpg', 'barang3.jpg', 'barang4.jpg', 'barang5.jpg', 'barangcard1.jpg', 'barangthumbnail1.jpg', 'barangthumbnail2.jpg', 'barangthumbnail3.jpg', 'barangthumbnail4.jpg', 'barangthumbnail5.jpg', 'angga@gmail.com', 'II3ZHJSJ', 0, 1591264856),
(2, 'barang hai', 1, 1, 0, 'Graphic', 0, 0, 0, 9, 'a', 'a', NULL, '', '', '', 'Angies Luis.zip', 'Angies Luis.zip', 'produk/aqeela/Graphic/barang hai/Objects/free/', 'produk/aqeela/Graphic/barang hai/Objects/premium/', NULL, NULL, NULL, 'ttf/otf/ttf/otf', 'Objects', '1591264994', 'gambar/aqeela/barang hai/', 'barang_hai1.jpg', 'barang_hai2.jpg', 'barang_hai3.jpg', 'barang_hai4.jpg', 'barang_hai5.jpg', 'barang_haicard1.jpg', 'barang_haithumbnail1.jpg', 'barang_haithumbnail2.jpg', 'barang_haithumbnail3.jpg', 'barang_haithumbnail4.jpg', 'barang_haithumbnail5.jpg', 'angga@gmail.com', 'DHI6CS9B', 0, 1591264994);

-- --------------------------------------------------------

--
-- Struktur dari tabel `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `price` float(10,2) NOT NULL,
  `status` enum('1','0') COLLATE utf8_unicode_ci NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `products`
--

INSERT INTO `products` (`id`, `name`, `image`, `price`, `status`) VALUES
(1, 'Credit $25', '', 25.00, '1'),
(2, 'Credit $50', '', 50.00, '1'),
(3, 'Credit $100', '', 100.00, '1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sub_product`
--

CREATE TABLE `sub_product` (
  `id` int(11) NOT NULL,
  `id_barang` varchar(255) NOT NULL,
  `file` varchar(255) NOT NULL,
  `tipe` varchar(200) NOT NULL,
  `ektensi` varchar(200) NOT NULL,
  `lokasi` varchar(255) NOT NULL,
  `email` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `sub_product`
--

INSERT INTO `sub_product` (`id`, `id_barang`, `file`, `tipe`, `ektensi`, `lokasi`, `email`) VALUES
(230, 'VA6JBUBC', 'Angies Luis.ttf', 'dekstop', 'TTF/', 'produk/rolilaz/Font/barangmn/Sans Serif/desktop/', 'rolilaz47@gmail.com'),
(231, 'VA6JBUBC', 'Angies Luis.otf', 'dekstop', 'OTF/', 'produk/rolilaz/Font/barangmn/Sans Serif/desktop/', 'rolilaz47@gmail.com'),
(232, 'RKPOYGV', 'Angies Luis.ttf', 'dekstop', 'TTF/', 'produk/rolilaz/Font/barangccc/Serif/desktop/', 'rolilaz47@gmail.com'),
(233, 'RKPOYGV', 'Angies Luis.otf', 'dekstop', 'OTF/', 'produk/rolilaz/Font/barangccc/Serif/desktop/', 'rolilaz47@gmail.com'),
(234, 'MZJOHT', 'Angies Luis.ttf', 'dekstop', 'TTF/', 'produk/rolilaz/Font/barangnmmn/Sans Serif/desktop/', 'rolilaz47@gmail.com'),
(235, 'MZJOHT', 'Angies Luis.otf', 'dekstop', 'OTF/', 'produk/rolilaz/Font/barangnmmn/Sans Serif/desktop/', 'rolilaz47@gmail.com'),
(236, 'XLNDCTOJ', 'Angies Luis.ttf', 'dekstop', 'TTF/', 'produk/rolilaz/Font/barang4daw/Serif/desktop/', 'rolilaz47@gmail.com'),
(237, 'XLNDCTOJ', 'Angies Luis.otf', 'dekstop', 'OTF/', 'produk/rolilaz/Font/barang4daw/Serif/desktop/', 'rolilaz47@gmail.com'),
(238, 'IPXHW8Q7', 'Angies Luis.ttf', 'dekstop', 'TTF/', 'produk/rolilaz/Font/barangklll/Serif/desktop/', 'rolilaz47@gmail.com'),
(239, 'IPXHW8Q7', 'Angies Luis.otf', 'dekstop', 'OTF/', 'produk/rolilaz/Font/barangklll/Serif/desktop/', 'rolilaz47@gmail.com'),
(240, 'BKHIF1LW', 'Angies Luis.ttf', 'dekstop', 'TTF/', 'produk/rolilaz/Font/barangawdaw/Sans Serif/desktop/', 'rolilaz47@gmail.com'),
(241, 'BKHIF1LW', 'Angies Luis.otf', 'dekstop', 'OTF/', 'produk/rolilaz/Font/barangawdaw/Sans Serif/desktop/', 'rolilaz47@gmail.com'),
(242, 'W24PBHYX', 'Angies Luis.ttf', 'dekstop', 'TTF/', 'produk/rolilaz/Font/barangadawdaw/Sans Serif/desktop/', 'rolilaz47@gmail.com'),
(243, 'W24PBHYX', 'Angies Luis.otf', 'dekstop', 'OTF/', 'produk/rolilaz/Font/barangadawdaw/Sans Serif/desktop/', 'rolilaz47@gmail.com'),
(244, 'II3ZHJSJ', 'Angies Luis.ttf', 'dekstop', 'TTF/', 'produk/aqeela/Font/barang/Sans Serif/desktop/', 'angga@gmail.com'),
(245, 'II3ZHJSJ', 'Angies Luis.otf', 'dekstop', 'OTF/', 'produk/aqeela/Font/barang/Sans Serif/desktop/', 'angga@gmail.com');

-- --------------------------------------------------------

--
-- Struktur dari tabel `suka`
--

CREATE TABLE `suka` (
  `id` int(11) NOT NULL,
  `tanggal` int(11) NOT NULL,
  `id_barang` int(11) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `pemilik` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi_paypal`
--

CREATE TABLE `transaksi_paypal` (
  `id` int(11) NOT NULL,
  `nama_barang` varchar(255) DEFAULT NULL,
  `id_barang` int(11) NOT NULL,
  `jenis` varchar(200) NOT NULL,
  `tipe` varchar(255) DEFAULT NULL,
  `harga` int(11) NOT NULL,
  `jumlah` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pemilik` varchar(200) DEFAULT NULL,
  `tanggal` int(11) NOT NULL,
  `date` date NOT NULL,
  `no_tagihan` varchar(255) NOT NULL,
  `referal` varchar(110) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `transaksi_paypal`
--

INSERT INTO `transaksi_paypal` (`id`, `nama_barang`, `id_barang`, `jenis`, `tipe`, `harga`, `jumlah`, `email`, `pemilik`, `tanggal`, `date`, `no_tagihan`, `referal`) VALUES
(1, 'tes upload', 53, 'desktop', 'Serif', 10, '1', 'rolilaz47@gmail.com', 'rolilaz47@gmail.com', 1590642393, '2020-05-28', 'KBXOZCYU', NULL),
(2, 'tes upload', 53, 'desktop', 'Serif', 10, '1', 'angga@gmail.com', 'rolilaz47@gmail.com', 1590644471, '2020-05-28', 'UK1V4ZRA', NULL),
(3, 'tes upload', 53, 'app', 'Serif', 100, '1', 'rolilaz47@gmail.com', 'rolilaz47@gmail.com', 1590644555, '2020-05-28', 'KIOLZEZE', NULL),
(4, 'barang', 107, 'premium', 'serif', 9, '1', 'rolilaz47@gmail.com', 'rolilaz47@gmail.com', 1590859005, '2020-05-30', 'WNUYSBAH', NULL),
(5, 'barang hai', 2, 'premium', 'Objects', 9, '1', 'ridwan@gmail.com', 'angga@gmail.com', 1591265055, '2020-06-04', 'BPSNOGUN', '9ZSXLCB3'),
(6, 'barang', 1, 'desktop', 'Sans Serif', 9, '1', 'ridwan@gmail.com', 'angga@gmail.com', 1591265069, '2020-06-04', 'I1TDNV7', NULL),
(7, 'barang', 1, 'app', 'Sans Serif', 90, '1', 'ridwan@gmail.com', 'angga@gmail.com', 1591265077, '2020-06-04', 'NRCCGLR3', '9ZSXLCB3');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `username` varchar(255) NOT NULL,
  `job` varchar(200) DEFAULT NULL,
  `tentang` text,
  `alamat` varchar(255) DEFAULT NULL,
  `url` varchar(255) NOT NULL,
  `street` varchar(255) NOT NULL,
  `province` varchar(255) NOT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `city` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `zip_code` varchar(255) NOT NULL,
  `email` varchar(128) NOT NULL,
  `image` varchar(128) NOT NULL,
  `background` varchar(255) DEFAULT NULL,
  `lokasi` varchar(255) DEFAULT NULL,
  `password` varchar(256) NOT NULL,
  `role_id` int(11) NOT NULL,
  `referal` varchar(50) DEFAULT NULL,
  `is_active` int(1) NOT NULL,
  `date_created` int(11) NOT NULL,
  `saldo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `name`, `username`, `job`, `tentang`, `alamat`, `url`, `street`, `province`, `phone_number`, `city`, `country`, `zip_code`, `email`, `image`, `background`, `lokasi`, `password`, `role_id`, `referal`, `is_active`, `date_created`, `saldo`) VALUES
(7, 'Aqeela Studio', 'aqeela', 'Bedeng', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. Duis aute irure dol', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ', '', '', '', NULL, '', '', '', 'angga@gmail.com', 'profile1.png', 'abstract-spiral-wave-line-color-colorful-yellow-paper-still-life-circle-font-illustration-design-shape-unusual-warped-macro-photography-warp-computer-wallpaper-fractal-art-1130788.jpg', 'gambar profile/aqeela/', '$2y$10$zjuLbp0Fh/DXRq7EApPlOe8AANcVjNd2RNVKRKZgSL6e0ixO6Ejx.', 3, NULL, 1, 1555877895, 50),
(8, 'Balstudio', 'balstudio', 'Admin', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.', NULL, '', '', '', NULL, '', '', '', 'otongsurotong@gmail.ccom', 'default.png', NULL, 'gambar profile/kosong/', '$2y$10$qf512Ow9kQ4uMujc4nO9lu8O0jA8cH9zbSPmPR9L8Ma4txe6zemia', 3, NULL, 1, 1555907174, 92),
(9, 'akifatypestudio', 'rolilaz', 'Designer', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo', 'http://localhost/marketplace/product/detail/fantabulous', 'JL.Medan', 'sumatera utara', '0808080', 'medan', 'Indonesia', '3233', 'rolilaz47@gmail.com', 'kucing.jpg', '', 'gambar profile/rolilaz/', '$2y$10$v.xuQySWoDLhvYlNJSxMA.gNkIQ7KJiJ0el3pwbm6bUoZrIhs2lCK', 3, NULL, 1, 1556622517, 191),
(10, 'ayeela studio', 'ayeela', 'Designer', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodoconsequat. Duis aute irure dolor in reprehenderit in voluptate velit essecillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.', NULL, '', '', '', NULL, '', '', '', 'otongsurg@gmail.ccom', 'default.png', NULL, 'gambar profile/kosong/', '$2y$10$vMRNiBE0Op8msYwMX9lFZuqRChzS0cRSQC2HRqzoAN2unUsBZAaEa', 3, NULL, 1, 1557211302, 185),
(11, 'Erick Studio', 'erick', NULL, NULL, NULL, '', '', '', NULL, '', '', '', 'Erick@gmail.com', 'default.png', NULL, 'gambar profile/kosong/', '$2y$10$mwWO4OnMWBL4XEu2LODoleHRYmfkr1/T.GlFDjPiMO2LaO./boeBW', 3, NULL, 1, 1572856626, 0),
(12, 'Font Lucky', 'font', NULL, NULL, NULL, '', '', '', NULL, '', '', '', 'Lucky@gmail.com', 'default.png', NULL, 'gambar profile/kosong/', '$2y$10$bP2lxeVjmksKJV9UAV3TmuftZzbXkwi2KgaaBcNAo.w0uKXKahD8q', 3, NULL, 1, 1572857360, 0),
(13, 'Great Studio', 'great', NULL, NULL, NULL, '', '', '', NULL, '', '', '', 'GreatStudio@gmail.com', 'default.png', NULL, 'gambar profile/kosong/', '$2y$10$i3Rr4Nwz/DTQjySOw0THQetCJ7jwBZvAAF/y04YHdkZExsohpLt7G', 1, NULL, 1, 1572858430, 0),
(14, 'font droe', 'fontdroe', NULL, NULL, NULL, '', '', '', NULL, '', '', '', 'fontdroe@gmail.com', 'profile1.png', 'abstract-hd-wallpapers-desktop.jpg', 'gambar profile/fontdroe/', '$2y$10$eQTyjuDV66JfUTmdSXmT6.CcRD8ed3wxXCgTkWYaxAGPzfq/J2DAm', 3, '9ZSXLCB3', 1, 1572861143, 0),
(15, 'Josstype', 'josstype', NULL, NULL, NULL, '', '', '', NULL, '', '', '', 'Josstype@gmail.com', 'default.png', NULL, 'gambar profile/kosong/', '$2y$10$Z.X0KBaNu6slOBjvY151iOENBWHXmX3TEPd/L52j1VRLr2F7/y46S', 1, NULL, 1, 1572863004, 0),
(17, 'ridwan', 'ridwan', NULL, NULL, NULL, '', '', '', NULL, '', '', '', 'ridwan@gmail.com', 'profile1.png', 'dont.jpg', 'gambar profile/ridwan/', '$2y$10$EVMxoLp.z2YrgKoprWf5/eHCXE2VRSLpyU8KKx.lO1dWBcUh55jES', 5, 'aa', 1, 1573298169, 8787);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_menu`
--

CREATE TABLE `user_menu` (
  `id` int(11) NOT NULL,
  `menu` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user_menu`
--

INSERT INTO `user_menu` (`id`, `menu`) VALUES
(1, 'User'),
(2, 'Afiliasi'),
(3, 'Designer'),
(4, 'Designer + Afiliasi\r\n'),
(5, 'Admin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_token`
--

CREATE TABLE `user_token` (
  `id` int(11) NOT NULL,
  `email` varchar(128) NOT NULL,
  `token` varchar(200) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user_token`
--

INSERT INTO `user_token` (`id`, `email`, `token`, `date_created`) VALUES
(1, 'rolilaz47@gmail.com', 'PN67m89jzwShuNaGBihsmlEKW8pdMrDLXH7+XPFKWV8=', 1591160473);

-- --------------------------------------------------------

--
-- Struktur dari tabel `view`
--

CREATE TABLE `view` (
  `id` int(11) NOT NULL,
  `ip` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `tanggal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `view`
--

INSERT INTO `view` (`id`, `ip`, `id_barang`, `tanggal`) VALUES
(1, 0, 1, 1591349994),
(2, 0, 2, 1591409240),
(3, 0, 2, 1591409429),
(4, 0, 2, 1591417396),
(5, 0, 2, 1591417399),
(6, 0, 2, 1591423253);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `colection`
--
ALTER TABLE `colection`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `komentar`
--
ALTER TABLE `komentar`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `komentar_desainer`
--
ALTER TABLE `komentar_desainer`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `konfirmasi_transaksi`
--
ALTER TABLE `konfirmasi_transaksi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indeks untuk tabel `pengajuan`
--
ALTER TABLE `pengajuan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `sub_product`
--
ALTER TABLE `sub_product`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `suka`
--
ALTER TABLE `suka`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `transaksi_paypal`
--
ALTER TABLE `transaksi_paypal`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_menu`
--
ALTER TABLE `user_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_token`
--
ALTER TABLE `user_token`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `view`
--
ALTER TABLE `view`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `colection`
--
ALTER TABLE `colection`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `komentar`
--
ALTER TABLE `komentar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT untuk tabel `komentar_desainer`
--
ALTER TABLE `komentar_desainer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `konfirmasi_transaksi`
--
ALTER TABLE `konfirmasi_transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT untuk tabel `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `pengajuan`
--
ALTER TABLE `pengajuan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `sub_product`
--
ALTER TABLE `sub_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=246;

--
-- AUTO_INCREMENT untuk tabel `suka`
--
ALTER TABLE `suka`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `transaksi_paypal`
--
ALTER TABLE `transaksi_paypal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `user_menu`
--
ALTER TABLE `user_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `user_token`
--
ALTER TABLE `user_token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `view`
--
ALTER TABLE `view`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
