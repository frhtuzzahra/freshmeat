<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Detail_masuk_model extends CI_Model
{

    private $table = 'detail_stokmasuk';

    public function create($data)
    {
        return $this->db->insert($this->table, $data);
    }

    public function update($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update($this->table, $data);
    }

    public function readJoin()
    {
        $this->db->select('
        detail_stokmasuk.id_stokmasuk,
        detail_stokmasuk.nama_produk,
        detail_stokmasuk.tanggal,
        detail_stokmasuk.dp,
        detail_stokmasuk.sisa,
        detail_stokmasuk.keterangan');
        $this->db->from($this->table);
        $this->db->join('stok_masuk', 'stok_masuk.id = detail_stokmasuk.id_stokmasuk');
        $this->db->join('produk', 'produk.id = stok_masuk.barcode');
        return $this->db->get();
    }

    public function read()
    {
        $this->db->select('
        detail_stokmasuk.id,
        detail_stokmasuk.id_stokmasuk,
	    produk.nama_produk,
	    produk.harga,
	    detail_stokmasuk.tanggal,
        stok_masuk.jumlah,
	    detail_stokmasuk.dp,
	    ((produk.harga * stok_masuk.jumlah) - detail_stokmasuk.dp) AS kekurangan,
	    detail_stokmasuk.keterangan 
        ');
        $this->db->from($this->table);
        $this->db->join('stok_masuk', 'stok_masuk.id = detail_stokmasuk.id_stokmasuk');
        $this->db->join('produk', 'produk.id = stok_masuk.barcode');
        $this->db->where('stok_masuk.status', 'DP');
        return $this->db->get();
    }

    public function readAll()
    {
        $query = "SELECT
		stok_masuk.tanggal,
		produk.barcode,
		produk.nama_produk,
		stok_masuk.jumlah,
		produk.harga_jual,
		(stok_masuk.jumlah * produk.harga) AS total,
		stok_masuk.status,
		stok_masuk.keterangan,
		supplier.nama as supplier,
		(
			SELECT SUM(stok_masuk.jumlah * produk.harga)
			FROM stok_masuk
			JOIN produk ON produk.id = stok_masuk.barcode
			WHERE stok_masuk.status = 'lunas'
		) AS total_semua
        FROM stok_masuk
        JOIN produk ON produk.id = stok_masuk.barcode
		JOIN supplier ON supplier.id = stok_masuk.supplier
		where stok_masuk.status = 'lunas'";

        return $this->db->query($query);
    }

    public function getStokMasukWithPeriode($tgl_awal, $tgl_akhir)
    {
        $query = "SELECT
		stok_masuk.tanggal,
		produk.barcode,
		produk.nama_produk,
		stok_masuk.jumlah,
		produk.harga_jual,
		(stok_masuk.jumlah * produk.harga) AS total,
		stok_masuk.status,
		supplier.nama as supplier,
		stok_masuk.keterangan,
		(
			SELECT SUM(stok_masuk.jumlah * produk.harga)
			FROM stok_masuk
			JOIN produk ON produk.id = stok_masuk.barcode
			WHERE stok_masuk.tanggal BETWEEN '$tgl_awal' AND '$tgl_akhir'
		) AS total_semua
        FROM stok_masuk
        JOIN produk ON produk.id = stok_masuk.barcode
		join supplier on supplier.id = stok_masuk.supplier
		WHERE
		stok_masuk.tanggal BETWEEN '$tgl_awal' AND '$tgl_akhir'
		ORDER BY
		stok_masuk.tanggal ASC
		";

        return $this->db->query($query);
    }

    public function laporan()
    {
        $this->db->select('stok_masuk.tanggal, stok_masuk.jumlah, stok_masuk.status, stok_masuk.keterangan, produk.barcode, produk.nama_produk, produk.harga_jual, supplier.nama as supplier');
        $this->db->from($this->table);
        $this->db->join('produk', 'produk.id = stok_masuk.barcode');
        $this->db->join('supplier', 'supplier.id = stok_masuk.supplier', 'left outer');
        $this->db->order_by('stok_masuk.tanggal', 'asc');
        return $this->db->get();
    }

    public function getIdDetailMasuk($id)
    {
        $this->db->select('
        detail_stokmasuk.id,
        detail_stokmasuk.id_stokmasuk,
	    produk.nama_produk,
        (stok_masuk.jumlah * produk.harga) AS total,
	    produk.harga,
	    detail_stokmasuk.tanggal,
        stok_masuk.jumlah,
	    detail_stokmasuk.dp,
	    ((produk.harga * stok_masuk.jumlah) - detail_stokmasuk.dp) AS kekurangan,
	    detail_stokmasuk.keterangan 
        ');
        $this->db->from($this->table);
        $this->db->join('stok_masuk', 'stok_masuk.id = detail_stokmasuk.id_stokmasuk');
        $this->db->join('produk', 'produk.id = stok_masuk.barcode');
        $this->db->where('detail_stokmasuk.id', $id);
        return $this->db->get();
    }

    public function getStok($id)
    {
        $this->db->select('stok');
        $this->db->where('id', $id);
        return $this->db->get('produk')->row();
    }

    public function getStokMasuk($id)
    {
        $this->db->select('id, status');
        $this->db->where('id', $id);
        return $this->db->get('stok_masuk')->row();
    }

    public function stokHari($hari)
    {
        return $this->db->query("SELECT SUM(jumlah) AS total FROM stok_masuk WHERE DATE_FORMAT(tanggal, '%d %m %Y') = '$hari'")->row();
    }
}

/* End of file Stok_masuk_model.php */
/* Location: ./application/models/Stok_masuk_model.php */
