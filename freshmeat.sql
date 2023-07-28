/*
 Navicat Premium Data Transfer

 Source Server         : Xampp
 Source Server Type    : MySQL
 Source Server Version : 100425 (10.4.25-MariaDB)
 Source Host           : localhost:3306
 Source Schema         : freshmeat

 Target Server Type    : MySQL
 Target Server Version : 100425 (10.4.25-MariaDB)
 File Encoding         : 65001

 Date: 28/07/2023 21:54:24
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for booking
-- ----------------------------
DROP TABLE IF EXISTS `booking`;
CREATE TABLE `booking`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `tanggal` datetime NULL DEFAULT NULL,
  `barcode` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `qty` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `total_bayar` double NULL DEFAULT NULL,
  `pelanggan` int NULL DEFAULT NULL,
  `nota` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `status` enum('belum','diambil') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT 'belum',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for detail_stokmasuk
-- ----------------------------
DROP TABLE IF EXISTS `detail_stokmasuk`;
CREATE TABLE `detail_stokmasuk`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_stokmasuk` int NULL DEFAULT NULL,
  `tanggal` datetime NULL DEFAULT NULL,
  `kekurangan` double NULL DEFAULT NULL,
  `dp` double NULL DEFAULT NULL,
  `keterangan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of detail_stokmasuk
-- ----------------------------
INSERT INTO `detail_stokmasuk` VALUES (1, 10, '2023-07-24 22:40:33', NULL, 100000, 'DP');

-- ----------------------------
-- Table structure for kategori_produk
-- ----------------------------
DROP TABLE IF EXISTS `kategori_produk`;
CREATE TABLE `kategori_produk`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `kategori` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of kategori_produk
-- ----------------------------
INSERT INTO `kategori_produk` VALUES (3, 'Daging Sapi');
INSERT INTO `kategori_produk` VALUES (4, 'Daging Ayam');
INSERT INTO `kategori_produk` VALUES (5, 'Sosis & Nugget');
INSERT INTO `kategori_produk` VALUES (6, 'Daging Lembu');

-- ----------------------------
-- Table structure for pelanggan
-- ----------------------------
DROP TABLE IF EXISTS `pelanggan`;
CREATE TABLE `pelanggan`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_kelamin` set('Pria','Wanita','Lainya') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `telepon` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of pelanggan
-- ----------------------------
INSERT INTO `pelanggan` VALUES (1, 'Adam', 'Pria', 'Banjarbaru Utara', '081237483291');
INSERT INTO `pelanggan` VALUES (2, 'Rahma', 'Wanita', 'Banjarbaru Selatan', '085463728374');
INSERT INTO `pelanggan` VALUES (3, 'Febi', 'Wanita', 'Solo', '08123123');

-- ----------------------------
-- Table structure for pengguna
-- ----------------------------
DROP TABLE IF EXISTS `pengguna`;
CREATE TABLE `pengguna`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of pengguna
-- ----------------------------
INSERT INTO `pengguna` VALUES (1, 'admin', '$2y$10$/I7laWi1mlNFxYSv54EUPOH8MuZhmRWxhE.LaddTK9TSmVe.IHP2C', 'Admin', '1');
INSERT INTO `pengguna` VALUES (2, 'anita', '$2y$10$mIeEDf8B5z0vtERQu07bFOMdS88guMIUZUu9Xcr1jiGYIerfb/Vta', 'Anita Adrea', '2');
INSERT INTO `pengguna` VALUES (3, 'zahra', '$2y$10$3BIjyOlYBbDXhoMGKrh1UunHOpcGuocgtXfUBLPhoAFO3aUHh6oCu', 'Zahra', '2');

-- ----------------------------
-- Table structure for produk
-- ----------------------------
DROP TABLE IF EXISTS `produk`;
CREATE TABLE `produk`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `barcode` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `nama_produk` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `kategori` int NULL DEFAULT NULL,
  `satuan` int NULL DEFAULT NULL,
  `harga` double NULL DEFAULT NULL,
  `harga_jual` double NULL DEFAULT NULL,
  `stok` int NULL DEFAULT NULL,
  `gambar` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `terjual` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of produk
-- ----------------------------
INSERT INTO `produk` VALUES (3, 'DGBLLY', 'Daging Giling Belly', 3, 3, 55000, 60000, 47, NULL, '2');
INSERT INTO `produk` VALUES (4, 'DGSAPI', 'Daging Sapi', 3, 4, 75000, 80000, 8, NULL, '1');
INSERT INTO `produk` VALUES (5, 'DGLMB', 'Daging Lembu Baru', 6, 4, 80000, 90000, 10, NULL, '2');
INSERT INTO `produk` VALUES (6, 'DGWGY', 'Daging Wagyu', 3, 3, 40000, 45000, 20, NULL, '3');

-- ----------------------------
-- Table structure for satuan_produk
-- ----------------------------
DROP TABLE IF EXISTS `satuan_produk`;
CREATE TABLE `satuan_produk`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `satuan` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of satuan_produk
-- ----------------------------
INSERT INTO `satuan_produk` VALUES (3, '250gr');
INSERT INTO `satuan_produk` VALUES (4, '500gr');

-- ----------------------------
-- Table structure for stok_keluar
-- ----------------------------
DROP TABLE IF EXISTS `stok_keluar`;
CREATE TABLE `stok_keluar`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `tanggal` datetime NOT NULL,
  `barcode` int NOT NULL,
  `jumlah` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Keterangan` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of stok_keluar
-- ----------------------------
INSERT INTO `stok_keluar` VALUES (2, '2023-07-08 13:44:02', 4, '2', 'kadaluarsa');
INSERT INTO `stok_keluar` VALUES (3, '2023-07-08 13:44:24', 5, '3', 'rusak');

-- ----------------------------
-- Table structure for stok_masuk
-- ----------------------------
DROP TABLE IF EXISTS `stok_masuk`;
CREATE TABLE `stok_masuk`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `tanggal` datetime NOT NULL,
  `barcode` int NOT NULL,
  `jumlah` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('Lunas','DP') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `supplier` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 19 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of stok_masuk
-- ----------------------------
INSERT INTO `stok_masuk` VALUES (4, '2023-06-26 09:58:35', 3, '15', 'Lunas', 'penambahan', 3);
INSERT INTO `stok_masuk` VALUES (5, '2023-07-01 22:42:57', 3, '5', 'Lunas', 'penambahan', 4);
INSERT INTO `stok_masuk` VALUES (6, '2023-07-03 21:26:02', 4, '9', 'Lunas', 'penambahan', 4);
INSERT INTO `stok_masuk` VALUES (7, '2023-07-04 00:03:54', 5, '15', 'Lunas', 'penambahan', 3);
INSERT INTO `stok_masuk` VALUES (8, '2023-07-08 14:33:33', 4, '5', 'Lunas', 'penambahan', 4);
INSERT INTO `stok_masuk` VALUES (9, '2023-07-09 08:12:53', 6, '9', 'Lunas', 'penambahan', 4);
INSERT INTO `stok_masuk` VALUES (10, '2023-07-17 14:47:13', 4, '2', 'DP', 'penambahan', 4);
INSERT INTO `stok_masuk` VALUES (11, '2023-07-17 14:47:29', 5, '6', 'Lunas', 'penambahan', 4);
INSERT INTO `stok_masuk` VALUES (12, '2023-07-17 16:25:58', 5, '11', 'Lunas', 'penambahan', 3);
INSERT INTO `stok_masuk` VALUES (13, '2023-07-17 21:59:53', 3, '111', 'Lunas', 'penambahan', 3);
INSERT INTO `stok_masuk` VALUES (14, '2023-07-18 00:21:05', 4, '4', 'Lunas', 'penambahan', 4);
INSERT INTO `stok_masuk` VALUES (15, '2023-07-18 00:33:14', 6, '5', 'Lunas', 'penambahan', 3);
INSERT INTO `stok_masuk` VALUES (16, '2023-07-21 15:13:50', 4, '10', 'Lunas', 'penambahan', 3);
INSERT INTO `stok_masuk` VALUES (17, '2023-07-22 11:14:05', 4, '12', 'Lunas', 'penambahan', 4);
INSERT INTO `stok_masuk` VALUES (18, '2023-07-23 23:00:38', 4, '11', 'Lunas', 'penambahan', 3);

-- ----------------------------
-- Table structure for supplier
-- ----------------------------
DROP TABLE IF EXISTS `supplier`;
CREATE TABLE `supplier`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `telepon` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of supplier
-- ----------------------------
INSERT INTO `supplier` VALUES (3, 'Rumah Potong Hewan H.Masdar', 'Bati-Bati', '083562478348', 'Aktif');
INSERT INTO `supplier` VALUES (4, 'PT. SUKANDA DJAYA', 'Jl. Ahmad Yani Km. 14,9  70652', '0867566796', 'Aktif');

-- ----------------------------
-- Table structure for toko
-- ----------------------------
DROP TABLE IF EXISTS `toko`;
CREATE TABLE `toko`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of toko
-- ----------------------------
INSERT INTO `toko` VALUES (1, 'Elang Fresh Meat', 'Jln Karang Anyar, Banjarbaru');

-- ----------------------------
-- Table structure for transaksi
-- ----------------------------
DROP TABLE IF EXISTS `transaksi`;
CREATE TABLE `transaksi`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `tanggal` datetime NOT NULL,
  `barcode` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `qty` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_bayar` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah_uang` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `diskon` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `pelanggan` int NOT NULL,
  `nota` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `kasir` int NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 14 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of transaksi
-- ----------------------------
INSERT INTO `transaksi` VALUES (1, '2023-07-19 11:11:49', '6', '4', '180000', '200000', '10', 3, 'KYQ5D7KMX447WYO', 1);
INSERT INTO `transaksi` VALUES (2, '2023-07-19 14:15:35', '3', '8', '480000', '500000', '10', 1, 'HNNOM4P47GILMLK', 1);
INSERT INTO `transaksi` VALUES (4, '2023-07-19 22:34:46', '3', '5', '300000', '300000', '5', 2, 'KHO8H0BZYJ3M341', 1);
INSERT INTO `transaksi` VALUES (5, '2023-07-20 09:52:23', '6', '3', '135000', '140000', '0', 2, 'E4J9TML29ZFI5WX', 1);
INSERT INTO `transaksi` VALUES (7, '2023-07-20 10:46:17', '3,5', '2,2', '300000', '300000', '10', 2, 'WQSOVVB1PSBC7OB', 1);
INSERT INTO `transaksi` VALUES (8, '2023-07-20 10:54:09', '3,5', '1,1', '150000', '150000', '0', 3, 'NJXR83DH23OZT7V', 1);
INSERT INTO `transaksi` VALUES (9, '2023-07-20 11:50:22', '3', '5', '300000', '300000', '0', 1, '39C01F04QS5YYRF', 1);
INSERT INTO `transaksi` VALUES (10, '2023-07-27 22:28:22', '5', '2', '180000', '180000', '0', 2, 'XB03R8ZXG7YWZMO', 1);
INSERT INTO `transaksi` VALUES (11, '2023-07-27 22:30:30', '4', '2', '160000', '160000', '0', 3, 'U813WRAFI9PJCTQ', 1);
INSERT INTO `transaksi` VALUES (12, '2023-07-27 22:59:07', '3', '2', '120000', '120000', '0', 2, '0VE4CA1O9D5EZPS', 1);
INSERT INTO `transaksi` VALUES (13, '2023-07-27 23:00:52', '3', '2', '120000', '120000', '0', 2, 'LWLDC5SQHYDJCM8', 1);

SET FOREIGN_KEY_CHECKS = 1;
