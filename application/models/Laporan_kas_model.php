<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan_kas_model extends CI_Model
{
    private $stok_masuk = 'stok_masuk';
    private $transaksi = 'transaksi';

    public function getAll()
    {
        $query = "SELECT
        tanggal,
        SUM(total_masuk) AS total_masuk,
        SUM(total_keluar) AS total_keluar,
        (
            SELECT SUM(total_masuk) 
            FROM (
                SELECT
                    stok_masuk.tanggal,
                    (stok_masuk.jumlah * produk.harga) AS total_masuk,
                    0 AS total_keluar
                FROM
                    stok_masuk
                JOIN produk ON stok_masuk.barcode = produk.id
            ) AS subquery_masuk
        ) AS total_kas_masuk,
        (
            SELECT SUM(total_keluar) 
            FROM (
                SELECT
                    transaksi.tanggal,
                    0 AS total_masuk,
                    transaksi.total_bayar AS total_keluar
                FROM
                    transaksi
            ) AS subquery_keluar
        ) AS total_kas_keluar
    FROM (
        SELECT
            stok_masuk.tanggal,
            (stok_masuk.jumlah * produk.harga) AS total_masuk,
            0 AS total_keluar
        FROM
            stok_masuk
        JOIN produk ON stok_masuk.barcode = produk.id
        UNION ALL
        SELECT
            transaksi.tanggal,
            0 AS total_masuk,
            transaksi.total_bayar AS total_keluar
        FROM
            transaksi
    ) AS data
    GROUP BY tanggal
    ORDER BY tanggal;
    ";
        return $this->db->query($query);
    }

    public function getTransaksiWithPeriode($tanggal_awal, $tanggal_akhir)
    {
        $query = "SELECT
        tanggal,
        SUM(total_masuk) AS total_masuk,
        SUM(total_keluar) AS total_keluar,
        (
            SELECT SUM(total_masuk) 
            FROM (
                SELECT
                    stok_masuk.tanggal,
                    (stok_masuk.jumlah * produk.harga) AS total_masuk,
                    0 AS total_keluar
                FROM
                    stok_masuk
                JOIN produk ON stok_masuk.barcode = produk.id
                WHERE
                    stok_masuk.tanggal BETWEEN '" . $tanggal_awal . "' AND '" . $tanggal_akhir . "'
            ) AS subquery_masuk
        ) AS total_kas_masuk,
        (
            SELECT SUM(total_keluar) 
            FROM (
                SELECT
                    transaksi.tanggal,
                    0 AS total_masuk,
                    transaksi.total_bayar AS total_keluar
                FROM
                    transaksi
                WHERE
                    transaksi.tanggal BETWEEN '" . $tanggal_awal . "' AND '" . $tanggal_akhir . "'
            ) AS subquery_keluar
        ) AS total_kas_keluar
    FROM (
        SELECT
            stok_masuk.tanggal,
            (stok_masuk.jumlah * produk.harga) AS total_masuk,
            0 AS total_keluar
        FROM
            stok_masuk
        JOIN produk ON stok_masuk.barcode = produk.id
        WHERE
            stok_masuk.tanggal BETWEEN '" . $tanggal_awal . "' AND '" . $tanggal_akhir . "'
        UNION ALL
        SELECT
            transaksi.tanggal,
            0 AS total_masuk,
            transaksi.total_bayar AS total_keluar
        FROM
            transaksi
        WHERE
            transaksi.tanggal BETWEEN '" . $tanggal_awal . "' AND '" . $tanggal_akhir . "'
    ) AS data
    GROUP BY tanggal
    ORDER BY tanggal;
    ";

        return $this->db->query($query);
    }
}
