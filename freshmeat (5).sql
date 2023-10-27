-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 18 Agu 2023 pada 02.40
-- Versi server: 10.4.18-MariaDB
-- Versi PHP: 8.0.3

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
-- Struktur dari tabel `booking`
--

CREATE TABLE `booking` (
  `id` int(11) NOT NULL,
  `tanggal` datetime DEFAULT NULL,
  `barcode` varchar(255) DEFAULT NULL,
  `qty` varchar(10) DEFAULT NULL,
  `total_bayar` double DEFAULT NULL,
  `pelanggan` int(11) DEFAULT NULL,
  `nota` varchar(255) DEFAULT NULL,
  `status` enum('belum','diambil') DEFAULT 'belum'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `booking`
--

INSERT INTO `booking` (`id`, `tanggal`, `barcode`, `qty`, `total_bayar`, `pelanggan`, `nota`, `status`) VALUES
(1, '2023-08-09 17:18:32', '1', '2', 27000, 4, 'BKG20230809111834', 'diambil'),
(2, '2023-08-09 17:19:56', '2,3', '2,3', 81500, 4, 'BKG20230809111958', 'belum'),
(3, '2023-08-18 08:37:17', '1,6', '1,2', 112000, 4, 'BKG20230818023718', 'belum');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `detail_stokmasuk`
--

INSERT INTO `detail_stokmasuk` (`id`, `id_stokmasuk`, `tanggal`, `kekurangan`, `dp`, `keterangan`) VALUES
(1, 5, '2023-08-06 13:34:23', 356000, 300000, 'DP'),
(2, 8, '2023-08-06 13:35:29', NULL, 500000, 'DP'),
(3, 9, '2023-08-06 13:35:55', NULL, 600000, 'DP'),
(4, 6, '2023-08-07 14:59:29', 125000, 125000, 'DP'),
(5, 7, '2023-08-07 14:59:47', NULL, 120000, 'DP'),
(6, 12, '2023-08-07 15:54:30', NULL, 100000, 'DP'),
(7, 15, '2023-08-18 08:33:41', NULL, 100000, 'DP');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori_produk`
--

CREATE TABLE `kategori_produk` (
  `id` int(11) NOT NULL,
  `kategori` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `kategori_produk`
--

INSERT INTO `kategori_produk` (`id`, `kategori`) VALUES
(1, 'Daging Sapi'),
(2, 'Daging Ayam'),
(3, 'Frozen Food'),
(4, 'Bumbu');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengguna`
--

CREATE TABLE `pengguna` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` char(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_kelamin` enum('Pria','Wanita') COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `telepon` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `pengguna`
--

INSERT INTO `pengguna` (`id`, `username`, `password`, `nama`, `role`, `jenis_kelamin`, `alamat`, `telepon`) VALUES
(1, 'admin', '$2y$10$/I7laWi1mlNFxYSv54EUPOH8MuZhmRWxhE.LaddTK9TSmVe.IHP2C', 'Admin', '1', 'Pria', '', ''),
(2, 'anita', '$2y$10$ifBYsl6F1nUcnt45EclGHeZkZQeTH8IuRFK0b7uHWj.OV1p19Kh/S', 'Anita Adrea', '2', 'Wanita', 'Jl. Balitan Raya No 15', '08967329457'),
(3, 'zahra', '$2y$10$crfhuRwiO5HOVOTDi2hEBuDt38zyatc4mki8o9CW5m21fg09urWKm', 'Azahraa', '2', 'Wanita', 'Jl. Taruna Praja Blok A No.12', '08192739745'),
(4, 'azizi', '$2y$10$k.kAYkgDn4DtZKMlBdT3x.dQ2DVe2LKYcqx9q3P7IlKiP3HaAKH8G', 'Azizi Aidan', '3', 'Pria', 'Jl. Ahmad Yani Km. 34 No. 19', '08726439274'),
(5, 'rozi', '$2y$10$bRigIfdwJjhTBe/ZEs46Jetg5HIVk13mnS7uORZad2Alo/8QBYCqi', 'Fahrur Rozi', '2', 'Pria', 'Jl. Sekumpul Ujung No. 19', '082749270250'),
(6, 'andi', '$2y$10$Vr4/yNkDZPPYXIkpahP1cOotXe.WI/iTsSQ8e7YUPNUqCfvWYHjLi', 'Andi Erfian', '2', 'Pria', 'Banjarbaru Utara', '0872393284'),
(7, 'lolo', '$2y$10$3n2OAxi5y4ow5xFqQI8F9OdFPMzKZQvvJCIWVe99CjuslU51KXYv2', 'Lolo Kasfian', '2', 'Pria', 'Jl. Mahligai No. 15', '08163849640'),
(8, 'winda', '$2y$10$dgmwsMQjlVN6pm/Z1/vXCOHq6V.DowmeSP77oMfK5O8IJzPD6.L4K', 'Winda Saputri', '3', 'Wanita', 'Jl. Padat Karya No 19', '08510283706'),
(9, 'bella', '$2y$10$/9vZl8/JwfqvgGNTtmE9n..il57elZWxSCXI7kpQpkDhxpOK4cFOC', 'Sarbella', '3', 'Wanita', 'Jl. Batu Safir No 7', '08539274028'),
(10, 'nina', '$2y$10$zHlHri7Zm3LfeWCLti43w.NqpIfTaS.PpA7C7K1JcKNS17C6LQ67C', 'Agnina Nurfitria', '3', 'Wanita', 'Jl. Teratai No. 56', '08392472626'),
(11, 'danis', '$2y$10$XH9T6H2zXrDgUcDSXTC1ReINvjK3EMyVpvjB.ZkrC38tzZHfDwZoy', 'Daniswara', '3', 'Pria', 'Jl. Pondok Bambu No.10', '08512038260'),
(12, 'adam', '$2y$10$WhwFHKZdmNovoVkX504ahOQd4jQlahNMaDhNLiV7TKrUH61zKoOFi', 'Adam Syahban', '3', 'Pria', 'Jl. Kuripan No 33', '0829236034');

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE `produk` (
  `id` int(11) NOT NULL,
  `barcode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_produk` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kategori` int(11) DEFAULT NULL,
  `satuan` int(11) DEFAULT NULL,
  `harga` double DEFAULT NULL,
  `harga_jual` double DEFAULT NULL,
  `stok` int(11) DEFAULT NULL,
  `gambar` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `terjual` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`id`, `barcode`, `nama_produk`, `kategori`, `satuan`, `harga`, `harga_jual`, `stok`, `gambar`, `terjual`) VALUES
(1, 'SSBBBBQ', 'Saus Bumbu Barbeque', 4, 11, 10000, 13500, 11, '35ef3f8bdaa0fb55429cbdd0c33730bb.jpg', '2'),
(2, 'SSBBBGI', 'Saus Bumbu Bulgogi', 4, 11, 10000, 13000, 11, '5f8310af5a407e35e4381722398936ca.jpg', '1'),
(3, 'SSBBLH', 'Saus Bumbu Lada Hitam', 4, 11, 15000, 18500, 8, '1e29b231477b53d513fceb4c25e85be0.jpg', NULL),
(4, 'MGPM', 'Margarin Palmia', 4, 4, 6000, 7000, 8, '7011d3d071710020e0266778e9d9a1c2.jpg', '1'),
(5, 'DGSP', 'Daging Sapi Segar', 1, 10, 82000, 85000, 3, '69dceb17e3cdc3246b1d0e20d93f0094.jpg', '1'),
(6, 'SLCBLY', 'Slice Belly', 1, 8, 82000, 85000, 6, 'e463136136733182ab611ffbe9b14c36.jpg', '1'),
(7, 'SLCPM', 'Slice Premium', 1, 8, 88000, 90000, 10, '0410715d005c5a77530b41daae3d16ec.jpg', '1'),
(8, 'STBY', 'Steak Belly', 1, 10, 67000, 70000, 5, '58f3e8220a5265485730469fe1657e24.jpg', NULL),
(9, 'STPM', 'Steak Premium', 1, 10, 90000, 95000, 7, '2f63028dc5f4181cdded43bba9d2d73a.jpg', NULL),
(10, 'DGSPBY', 'Daging Sapi Giling Belly', 1, 6, 50000, 53000, 4, '58d4605acab2caca59a8c343eecf9866.jpg', '1'),
(11, 'DGSPPM', 'Daging Sapi Giling Premium', 1, 6, 52000, 55000, 4, '1d56941927f537f8a320ef35fe4a8856.jpg', '1'),
(12, 'RWSP', 'Rawon Sapi', 1, 8, 50000, 55000, 4, '036a75aa9090526125302d98fef7c4ed.jpg', NULL),
(13, 'TLSPI', 'Tetelan Sapi', 1, 8, 60000, 63000, 4, '7c8793416586f35b1e73a6bc11546c2c.jpg', NULL),
(14, 'BTTSP', 'Buntut Sapi', 1, 10, 52000, 55000, 3, 'd36c762ef92e5019fa2c1e7d1ef4cf43.jpg', NULL),
(15, 'DDAYMBS', 'Dada Ayam Boneless', 2, 10, 40000, 45000, 5, 'b878d8c963aa79f1892ed7e5a9fca681.jpg', NULL),
(16, 'AYMSLC', 'Daging Ayam Slice', 2, 10, 42000, 45000, 4, '08ba6d620a06cfe45834d6f62e3553b7.jpg', '1'),
(17, 'AYMGLG', 'Daging Ayam Giling', 2, 10, 40000, 45000, 5, '1ee429957b6f70d7b54cb849945dbd00.jpg', NULL),
(18, 'SSAYMBS', 'Sosis Ayam Belfoods', 3, 4, 12000, 15000, 3, '7c1e912a48d1b18b572918fd19fb93f2.jpg', '1'),
(19, 'CKNGBBS', 'Belfoods Chicken Nugget Ball', 3, 5, 20000, 25000, 2, '786b076e5deabcd03cfa62490f262399.jpg', '1'),
(20, 'SMKBEEF', 'Smoked Beef Delimax', 3, 4, 21000, 25000, 8, '8ccbd0605d6ef9229de88a8915fbd54c.jpg', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `satuan_produk`
--

CREATE TABLE `satuan_produk` (
  `id` int(11) NOT NULL,
  `satuan` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `satuan_produk`
--

INSERT INTO `satuan_produk` (`id`, `satuan`) VALUES
(1, '50gr'),
(2, '100gr'),
(3, '150gr'),
(4, '200gr'),
(5, '250gr'),
(6, '300gr'),
(7, '350gr'),
(8, '400gr'),
(9, '450gr'),
(10, '500gr'),
(11, '100ml'),
(12, '150ml'),
(13, '600gr');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `stok_keluar`
--

INSERT INTO `stok_keluar` (`id`, `tanggal`, `barcode`, `jumlah`, `Keterangan`) VALUES
(1, '2023-08-07 15:00:12', 4, '2', 'kadaluarsa'),
(2, '2023-08-07 15:42:07', 5, '1', 'rusak');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `stok_masuk`
--

INSERT INTO `stok_masuk` (`id`, `tanggal`, `barcode`, `jumlah`, `status`, `keterangan`, `supplier`) VALUES
(1, '2023-08-06 13:19:55', 1, '10', 'Lunas', 'penambahan', 5),
(2, '2023-08-06 13:20:49', 2, '10', 'Lunas', 'penambahan', 5),
(3, '2023-08-06 13:21:18', 3, '8', 'Lunas', 'penambahan', 5),
(4, '2023-08-06 13:21:48', 4, '15', 'Lunas', 'penambahan', 5),
(5, '2023-08-06 13:22:22', 5, '8', 'Lunas', 'penambahan', 2),
(6, '2023-08-06 13:23:01', 10, '5', 'Lunas', 'penambahan', 2),
(7, '2023-08-06 13:23:38', 11, '5', 'DP', 'penambahan', 2),
(8, '2023-08-06 13:26:49', 6, '15', 'DP', 'penambahan', 3),
(9, '2023-08-06 13:27:31', 7, '15', 'DP', 'penambahan', 3),
(10, '2023-08-07 15:02:31', 8, '5', 'Lunas', 'penambahan', 2),
(11, '2023-08-07 15:03:00', 9, '7', 'Lunas', 'penambahan', 3),
(12, '2023-08-07 15:03:42', 12, '4', 'DP', 'penambahan', 2),
(13, '2023-08-07 15:04:03', 13, '4', 'Lunas', 'penambahan', 2),
(14, '2023-08-07 15:04:29', 14, '3', 'Lunas', 'penambahan', 2),
(15, '2023-08-07 15:05:27', 15, '5', 'DP', 'penambahan', 3),
(16, '2023-08-07 15:05:59', 16, '5', 'DP', 'penambahan', 3),
(17, '2023-08-07 15:06:29', 17, '5', 'DP', 'penambahan', 3),
(18, '2023-08-07 15:40:43', 18, '6', 'Lunas', 'penambahan', 5),
(19, '2023-08-07 15:41:09', 19, '6', 'Lunas', 'penambahan', 4),
(20, '2023-08-09 18:14:43', 1, '5', 'Lunas', 'penambahan', 4),
(21, '2023-08-18 08:32:31', 1, '5', 'Lunas', 'penambahan', 4),
(22, '2023-08-18 08:32:45', 2, '5', 'Lunas', 'penambahan', 4),
(23, '2023-08-18 08:33:14', 20, '8', 'DP', 'penambahan', 3);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `supplier`
--

INSERT INTO `supplier` (`id`, `nama`, `alamat`, `telepon`, `keterangan`) VALUES
(1, 'Elang Farm', 'Pelaihari', '08218628364', 'Tidak Aktif'),
(2, 'Rumah Potong Hewan H.Masdar', 'Bati-Bati', '085294387942', 'Aktif'),
(3, 'PT. SUKANDA DJAYA', 'Gambut', '08193927362', 'Aktif'),
(4, 'PT. Agro Boga Utama', 'Banjarmasin', '083173286432', 'Aktif'),
(5, 'Khameru Supplier', 'Landasan Ulin', '08237264234', 'Aktiff');

-- --------------------------------------------------------

--
-- Struktur dari tabel `toko`
--

CREATE TABLE `toko` (
  `id` int(11) NOT NULL,
  `nama` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `toko`
--

INSERT INTO `toko` (`id`, `nama`, `alamat`) VALUES
(1, 'Elang Fresh Meat', 'Jl. Karang Anyar 1 No.2, RW.01, Loktabat Utara, Kec. Landasan Ulin, Kota Banjar Baru, Kalimantan Selatan 70714');

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
  `pelanggan` int(11) NOT NULL,
  `nota` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kasir` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`id`, `tanggal`, `barcode`, `qty`, `total_bayar`, `jumlah_uang`, `diskon`, `pelanggan`, `nota`, `kasir`) VALUES
(2, '2023-08-07 16:17:00', '18,19', '2,2', '80000', '100000', '0', 9, '6DSCDXRM8D3UVSV', 1),
(3, '2023-08-07 16:26:16', '2,5', '1,1', '98000', '100000', '0', 8, 'HFFXS7GRF9XM6UO', 1),
(4, '2023-08-07 16:27:07', '2', '1', '13000', '15000', '0', 4, '6CRI80RTKC931DM', 1),
(5, '2023-08-07 16:30:06', '6,18,19,11', '1,1,1,1', '180000', '200000', '0', 11, 'JGI7M7OZUR3RNRD', 1),
(6, '2023-08-09 17:00:02', '4,5', '1,1', '92000', '100000', '0', 9, 'CW1HCEILW9VF5A2', 1),
(7, '2023-08-18 08:34:31', '1,7', '1,2', '117000', '120000', '0', 11, 'RUKCOJ1S2VO1UPF', 1),
(8, '2023-08-18 08:36:02', '19,10', '1,1', '78000', '100000', '0', 9, 'XPA7M4XC59LQK9N', 3);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indeks untuk tabel `detail_stokmasuk`
--
ALTER TABLE `detail_stokmasuk`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indeks untuk tabel `kategori_produk`
--
ALTER TABLE `kategori_produk`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indeks untuk tabel `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indeks untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indeks untuk tabel `satuan_produk`
--
ALTER TABLE `satuan_produk`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indeks untuk tabel `stok_keluar`
--
ALTER TABLE `stok_keluar`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indeks untuk tabel `stok_masuk`
--
ALTER TABLE `stok_masuk`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indeks untuk tabel `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indeks untuk tabel `toko`
--
ALTER TABLE `toko`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `booking`
--
ALTER TABLE `booking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `detail_stokmasuk`
--
ALTER TABLE `detail_stokmasuk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `kategori_produk`
--
ALTER TABLE `kategori_produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `produk`
--
ALTER TABLE `produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `satuan_produk`
--
ALTER TABLE `satuan_produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `stok_keluar`
--
ALTER TABLE `stok_keluar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `stok_masuk`
--
ALTER TABLE `stok_masuk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT untuk tabel `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `toko`
--
ALTER TABLE `toko`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
