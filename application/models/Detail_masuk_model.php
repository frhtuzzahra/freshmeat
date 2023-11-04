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
        $this->db->join('produk', 'produk.id = stok_masuk.kode_barang');
        return $this->db->get();
    }

    public function read()
    {
        $this->db->select('
        detail_stokmasuk.id,
        detail_stokmasuk.id_stokmasuk,
	    produk.nama_produk,
        satuan_produk.satuan,
	    produk.harga,
	    detail_stokmasuk.tanggal,
        stok_masuk.jumlah,
	    detail_stokmasuk.dp,
	    ((produk.harga * stok_masuk.jumlah) - detail_stokmasuk.dp) AS kekurangan,
	    detail_stokmasuk.keterangan 
        ');
        $this->db->from($this->table);
        $this->db->join('stok_masuk', 'stok_masuk.id = detail_stokmasuk.id_stokmasuk');
        $this->db->join('produk', 'produk.id = stok_masuk.kode_barang');
        $this->db->join('satuan_produk', 'satuan_produk.id = produk.satuan');
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
			JOIN produk ON produk.id = stok_masuk.kode_barang
			WHERE stok_masuk.status = 'lunas'
		) AS total_semua
        FROM stok_masuk
        JOIN produk ON produk.id = stok_masuk.kode_barang
		JOIN supplier ON supplier.id = stok_masuk.supplier
		where stok_masuk.status = 'lunas'";

        return $this->db->query($query);
    }

    public function getDetailMasukWithPeriode($tgl_awal, $tgl_akhir)
    {
        $this->db->select('id_stokmasuk,
        nama_produk,
        detail_stokmasuk.tanggal,
        produk.harga,
        satuan_produk.satuan,
        ( produk.harga * stok_masuk.jumlah ) AS total,
        dp,
        ( produk.harga * stok_masuk.jumlah - dp ) AS kekurangan ');
        $this->db->from($this->table);
        $this->db->join('stok_masuk', 'detail_stokmasuk.id_stokmasuk = stok_masuk.id');
        $this->db->join('produk', 'stok_masuk.kode_barang = produk.id');
        $this->db->join('satuan_produk', 'satuan_produk.id = produk.satuan');
        $this->db->where('stok_masuk.status', 'DP');
        $this->db->where('detail_stokmasuk.tanggal >=', $tgl_awal);
        $this->db->where('detail_stokmasuk.tanggal <=', $tgl_akhir);
        $this->db->order_by('detail_stokmasuk.tanggal', 'ASC');
        return $this->db->get();
    }

    public function laporan()
    {
        $this->db->select('id_stokmasuk,
        nama_produk,
        satuan_produk.satuan,
        detail_stokmasuk.tanggal,
        produk.harga,
        ( produk.harga * stok_masuk.jumlah ) AS total,
        dp,
        ( produk.harga * stok_masuk.jumlah - dp ) AS kekurangan ');
        $this->db->from($this->table);
        $this->db->join('stok_masuk', 'detail_stokmasuk.id_stokmasuk = stok_masuk.id');
        $this->db->join('produk', 'stok_masuk.kode_barang = produk.id');
        $this->db->join('satuan_produk', 'satuan_produk.id = produk.satuan');
        $this->db->where('stok_masuk.status', 'DP');
        $this->db->order_by('detail_stokmasuk.tanggal', 'ASC');
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
        $this->db->join('produk', 'produk.id = stok_masuk.kode_barang');
        $this->db->where('detail_stokmasuk.id', $id);
        return $this->db->get();
    }
}

/* End of file Stok_masuk_model.php */
/* Location: ./application/models/Stok_masuk_model.php */
