<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Stok_masuk_model extends CI_Model
{

	private $table = 'stok_masuk';

	public function create($data)
	{
		return $this->db->insert($this->table, $data);
	}

	public function update($id, $data)
	{
		$this->db->where('id', $id);
		return $this->db->update($this->table, $data);
	}

	public function read()
	{
		$this->db->select('stok_masuk.id, stok_masuk.tanggal, stok_masuk.jumlah, stok_masuk.status, stok_masuk.keterangan, produk.barcode, produk.nama_produk, produk.harga');
		$this->db->from($this->table);
		$this->db->join('produk', 'produk.id = stok_masuk.barcode');
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
	FROM
		stok_masuk
	JOIN
		produk ON produk.id = stok_masuk.barcode
		JOIN supplier ON supplier.id = stok_masuk.supplier
		where stok_masuk.status = 'lunas'";

		return $this->db->query($query);
		// $this->db->select('stok_masuk.tanggal, stok_masuk.jumlah, stok_masuk.status, stok_masuk.keterangan,(stok_masuk.jumlah * produk.harga) AS total, produk.barcode, produk.nama_produk, produk.harga_jual, supplier.nama as supplier');
		// $this->db->from($this->table);
		// $this->db->join('produk', 'produk.id = stok_masuk.barcode');
		// $this->db->join('supplier', 'supplier.id = stok_masuk.supplier', 'left outer');
		// $this->db->order_by('stok_masuk.tanggal', 'asc');
		// return $this->db->get();
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
	FROM
		stok_masuk
	JOIN
		produk ON produk.id = stok_masuk.barcode
		join supplier on supplier.id = stok_masuk.supplier
		WHERE
		stok_masuk.tanggal BETWEEN '$tgl_awal' AND '$tgl_akhir'
		ORDER BY
		stok_masuk.tanggal ASC
		";


		// $this->db->select('stok_masuk.tanggal, stok_masuk.jumlah, stok_masuk.status, stok_masuk.keterangan, (stok_masuk.jumlah * produk.harga) AS total, produk.barcode, produk.nama_produk, produk.harga_jual, supplier.nama as supplier');
		// $this->db->from($this->table);
		// $this->db->join('produk', 'produk.id = stok_masuk.barcode');
		// $this->db->join('supplier', 'supplier.id = stok_masuk.supplier', 'left outer');
		// $this->db->where('stok_masuk.tanggal >=', $tgl_awal);
		// $this->db->where('stok_masuk.tanggal <=', $tgl_akhir);
		// $this->db->order_by('stok_masuk.tanggal', 'asc');
		// return $this->db->get();

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

	public function addStok($id, $stok)
	{
		$this->db->where('id', $id);
		$this->db->set('stok', $stok);
		return $this->db->update('produk');
	}

	public function stokHari($hari)
	{
		return $this->db->query("SELECT SUM(jumlah) AS total FROM stok_masuk WHERE DATE_FORMAT(tanggal, '%d %m %Y') = '$hari'")->row();
	}
}

/* End of file Stok_masuk_model.php */
/* Location: ./application/models/Stok_masuk_model.php */
