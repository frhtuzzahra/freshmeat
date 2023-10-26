<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stok_keluar_model extends CI_Model {

	private $table = 'stok_keluar';

	public function create($data)
	{
		return $this->db->insert($this->table, $data);
	}

	
	public function MoveStockFromIntoOut()
	{
		$this->db->trans_begin(); // Memulai transaksi database

		$this->db->select('stok_masuk.id, stok_masuk.tanggal, stok_masuk.jumlah, stok_masuk.status, stok_masuk.keterangan, produk.kode_barang, produk.nama_produk, produk.harga, tanggal_expired, tanggal_frezer, satuan');
		$this->db->from('stok_masuk');
		$this->db->join('produk', 'produk.id = stok_masuk.kode_barang');
		$this->db->where('tanggal_expired <', date('Y-m-d'));
		$this->db->order_by('stok_masuk.tanggal', 'desc');
		$expired_products = $this->db->get()->result();

		// Memindahkan data ke tabel stock_keluar dengan mengubah keterangan menjadi "kadaluarsa"
		foreach ($expired_products as $product) {
			$data = array(
				'tanggal' => date('Y-m-d H:i:s'),
				'kode_barang' => $product->id,
				'jumlah' => $product->jumlah,
				'Keterangan' => 'kadaluarsa'
			);
			$this->db->insert('stok_keluar', $data);
		}

		// // Menghapus data dari tabel stok_masuk yang telah dipindahkan
		// $this->db->where('tanggal_expired <', date('Y-m-d'));
		// $this->db->delete('stok_masuk');

		// Memeriksa apakah transaksi berhasil atau gagal
		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback(); // Transaksi gagal, rollback
		} else {
			$this->db->trans_commit(); // Transaksi berhasil, commit
		}
	}

	public function read()
	{
		//pindah stock masuk ke stock keluar karena kadaluarsa
		$this->MoveStockFromIntoOut();

		$this->db->select('stok_keluar.tanggal, stok_keluar.jumlah, stok_keluar.keterangan, produk.kode_barang, produk.nama_produk , produk.satuan');
		$this->db->from($this->table);
		$this->db->join('produk', 'produk.id = stok_keluar.kode_barang');
		return $this->db->get();
	}

	public function getStok($id)
	{
		$this->db->select('stok');
		$this->db->where('id', $id);
		return $this->db->get('produk')->row();
	}

	public function addStok($id,$stok)
	{
		$this->db->where('id', $id);
		$this->db->set('stok', $stok);
		return $this->db->update('produk');
	}

}

/* End of file Stok_keluar_model.php */
/* Location: ./application/models/Stok_keluar_model.php */