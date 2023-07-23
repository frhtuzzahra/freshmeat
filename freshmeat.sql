-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 23 Jul 2023 pada 18.16
-- Versi server: 10.4.25-MariaDB
-- Versi PHP: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `freshmeat`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_stokmasuk`
--

CREATE TABLE `detail_stokmasuk` (
  `id` int(11) NOT NULL,
  `id_stokmasuk` int(11) DEFAULT NULL,
  `tanggal` datetime DEFAULT NULL,
  `kekurangan` double DEFAULT NULL,
  `dp` double DEFAULT NULL,
  `keterangan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `detail_stokmasuk`
--

INSERT INTO `detail_stokmasuk` (`id`, `id_stokmasuk`, `tanggal`, `kekurangan`, `dp`, `keterangan`) VALUES
(1, 9, '2023-07-09 08:12:53', NULL, 200000, 'DP'),
(2, 11, '2023-07-17 14:47:29', 420000, 60000, 'Pelunasan'),
(4, 13, '2023-07-11 00:30:01', NULL, 100000, 'do'),
(5, 15, '2023-07-18 10:50:41', NULL, 1000000, 'DP'),
(6, 12, '2023-07-19 23:22:04', 860000, 20000, 'DP'),
(8, 17, '2023-07-22 11:14:24', 400000, 500000, 'DP'),
(9, 10, '2023-07-23 22:54:17', NULL, 50000, 'DP'),
(10, 18, '2023-07-23 23:00:58', 400000, 425000, 'Pelunasan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori_produk`
--

CREATE TABLE `kategori_produk` (
  `id` int(11) NOT NULL,
  `kategori` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kategori_produk`
--

INSERT INTO `kategori_produk` (`id`, `kategori`) VALUES
(3, 'Daging Sapi'),
(4, 'Daging Ayam'),
(5, 'Sosis & Nugget'),
(6, 'Daging Lembu');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_kelamin` set('Pria','Wanita','Lainya') COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `telepon` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pelanggan`
--

INSERT INTO `pelanggan` (`id`, `nama`, `jenis_kelamin`, `alamat`, `telepon`) VALUES
(1, 'Adam', 'Pria', 'Banjarbaru Utara', '081237483291'),
(2, 'Rahma', 'Wanita', 'Banjarbaru Selatan', '085463728374'),
(3, 'Febi', 'Wanita', 'Solo', '08123123');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengguna`
--

CREATE TABLE `pengguna` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` char(1) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pengguna`
--

INSERT INTO `pengguna` (`id`, `username`, `password`, `nama`, `role`) VALUES
(1, 'admin', '$2y$10$/I7laWi1mlNFxYSv54EUPOH8MuZhmRWxhE.LaddTK9TSmVe.IHP2C', 'Admin', '1'),
(2, 'anita', '$2y$10$mIeEDf8B5z0vtERQu07bFOMdS88guMIUZUu9Xcr1jiGYIerfb/Vta', 'Anita Adrea', '2');

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE `produk` (
  `id` int(11) NOT NULL,
  `barcode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_produk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kategori` int(11) NOT NULL,
  `satuan` int(11) NOT NULL,
  `harga` double NOT NULL,
  `harga_jual` double NOT NULL,
  `stok` int(11) NOT NULL,
  `terjual` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`id`, `barcode`, `nama_produk`, `kategori`, `satuan`, `harga`, `harga_jual`, `stok`, `terjual`) VALUES
(3, 'DGBLLY', 'Daging Giling Belly', 3, 3, 55000, 60000, 90, '5'),
(4, 'DGSAPI', 'Daging Sapi', 3, 4, 75000, 80000, 33, '2'),
(5, 'DGLMB', 'Daging Lembu Baru', 6, 4, 80000, 90000, 5, '1'),
(6, 'DGWGY', 'Daging Wagyu', 3, 3, 40000, 45000, 3, '2');

-- --------------------------------------------------------

--
-- Struktur dari tabel `satuan_produk`
--

CREATE TABLE `satuan_produk` (
  `id` int(11) NOT NULL,
  `satuan` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `satuan_produk`
--

INSERT INTO `satuan_produk` (`id`, `satuan`) VALUES
(3, '250gr'),
(4, '500gr');

-- --------------------------------------------------------

--
-- Struktur dari tabel `stok_keluar`
--

CREATE TABLE `stok_keluar` (
  `id` int(11) NOT NULL,
  `tanggal` datetime NOT NULL,
  `barcode` int(11) NOT NULL,
  `jumlah` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Keterangan` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `stok_keluar`
--

INSERT INTO `stok_keluar` (`id`, `tanggal`, `barcode`, `jumlah`, `Keterangan`) VALUES
(2, '2023-07-08 13:44:02', 4, '2', 'kadaluarsa'),
(3, '2023-07-08 13:44:24', 5, '3', 'rusak');

-- --------------------------------------------------------

--
-- Struktur dari tabel `stok_masuk`
--

CREATE TABLE `stok_masuk` (
  `id` int(11) NOT NULL,
  `tanggal` datetime NOT NULL,
  `barcode` int(11) NOT NULL,
  `jumlah` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('Lunas','DP') COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `supplier` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `stok_masuk`
--

INSERT INTO `stok_masuk` (`id`, `tanggal`, `barcode`, `jumlah`, `status`, `keterangan`, `supplier`) VALUES
(4, '2023-06-26 09:58:35', 3, '15', 'Lunas', 'penambahan', 3),
(5, '2023-07-01 22:42:57', 3, '5', 'Lunas', 'penambahan', 4),
(6, '2023-07-03 21:26:02', 4, '9', 'Lunas', 'penambahan', 4),
(7, '2023-07-04 00:03:54', 5, '15', 'Lunas', 'penambahan', 5),
(8, '2023-07-08 14:33:33', 4, '5', 'Lunas', 'penambahan', 4),
(9, '2023-07-09 08:12:53', 6, '9', 'Lunas', 'penambahan', 4),
(10, '2023-07-17 14:47:13', 4, '2', 'DP', 'penambahan', 4),
(11, '2023-07-17 14:47:29', 5, '6', 'Lunas', 'penambahan', 4),
(12, '2023-07-17 16:25:58', 5, '11', 'Lunas', 'penambahan', 5),
(13, '2023-07-17 21:59:53', 3, '111', 'Lunas', 'penambahan', 5),
(14, '2023-07-18 00:21:05', 4, '4', 'Lunas', 'penambahan', 4),
(15, '2023-07-18 00:33:14', 6, '5', 'Lunas', 'penambahan', 5),
(16, '2023-07-21 15:13:50', 4, '10', 'Lunas', 'penambahan', 5),
(17, '2023-07-22 11:14:05', 4, '12', 'Lunas', 'penambahan', 4),
(18, '2023-07-23 23:00:38', 4, '11', 'Lunas', 'penambahan', 5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `supplier`
--

CREATE TABLE `supplier` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telepon` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `supplier`
--

INSERT INTO `supplier` (`id`, `nama`, `alamat`, `telepon`, `keterangan`) VALUES
(3, 'Rumah Potong Hewan H.Masdar', 'Bati-Bati', '083562478348', 'Aktif'),
(4, 'PT. SUKANDA DJAYA', 'Jl. Ahmad Yani Km. 14,9  70652', '0867566796', 'Aktif'),
(5, 'PT. Ngawur', 'Jl. Nggatau', '0123123123', 'Aktif');

-- --------------------------------------------------------

--
-- Struktur dari tabel `toko`
--

CREATE TABLE `toko` (
  `id` int(11) NOT NULL,
  `nama` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `toko`
--

INSERT INTO `toko` (`id`, `nama`, `alamat`) VALUES
(1, 'Elang Fresh Meat', 'Jln Karang Anyar, Banjarbaru');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int(11) NOT NULL,
  `tanggal` datetime NOT NULL,
  `barcode` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qty` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_bayar` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah_uang` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `diskon` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pelanggan` int(11) DEFAULT NULL,
  `nota` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kasir` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`id`, `tanggal`, `barcode`, `qty`, `total_bayar`, `jumlah_uang`, `diskon`, `pelanggan`, `nota`, `kasir`) VALUES
(1, '2023-07-19 11:11:49', '6', '4', '180000', '200000', '10', 3, 'KYQ5D7KMX447WYO', 1),
(2, '2023-07-19 14:15:35', '3', '8', '480000', '500000', '10', 1, 'HNNOM4P47GILMLK', 1),
(4, '2023-07-19 22:34:46', '3', '5', '300000', '300000', '5', 2, 'KHO8H0BZYJ3M341', 1),
(5, '2023-07-20 09:52:23', '6', '3', '135000', '140000', '0', 2, 'E4J9TML29ZFI5WX', 1),
(7, '2023-07-20 10:46:17', '3,5', '2,2', '300000', '300000', '10', 2, 'WQSOVVB1PSBC7OB', 1),
(8, '2023-07-20 10:54:09', '3,5', '1,1', '150000', '150000', '0', 3, 'NJXR83DH23OZT7V', 1),
(9, '2023-07-20 11:50:22', '3', '5', '300000', '300000', '0', 1, '39C01F04QS5YYRF', 1);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `detail_stokmasuk`
--
ALTER TABLE `detail_stokmasuk`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kategori_produk`
--
ALTER TABLE `kategori_produk`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `satuan_produk`
--
ALTER TABLE `satuan_produk`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `stok_keluar`
--
ALTER TABLE `stok_keluar`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `stok_masuk`
--
ALTER TABLE `stok_masuk`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `toko`
--
ALTER TABLE `toko`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `detail_stokmasuk`
--
ALTER TABLE `detail_stokmasuk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `kategori_produk`
--
ALTER TABLE `kategori_produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `produk`
--
ALTER TABLE `produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `satuan_produk`
--
ALTER TABLE `satuan_produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `stok_keluar`
--
ALTER TABLE `stok_keluar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `stok_masuk`
--
ALTER TABLE `stok_masuk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `toko`
--
ALTER TABLE `toko`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

TRUNCATE TABLE `detail_stokmasuk`;
TRUNCATE TABLE `stok_keluar`;
TRUNCATE TABLE `stok_masuk`;
TRUNCATE TABLE `transaksi`;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
