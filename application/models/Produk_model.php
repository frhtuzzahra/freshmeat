<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Produk_model extends CI_Model
{

	private $table = 'produk';

	public function create($data)
	{
		return $this->db->insert($this->table, $data);
	}

	public function read()
	{
		$this->db->select('produk.id, produk.kode_barang, produk.nama_produk, produk.harga_jual, produk.stok,produk.gambar, kategori_produk.kategori, satuan_produk.satuan');
		$this->db->from($this->table);
		$this->db->join('kategori_produk', 'produk.kategori = kategori_produk.id');
		$this->db->join('satuan_produk', 'produk.satuan = satuan_produk.id');
		return $this->db->get();
	}

	public function update($id, $data)
	{
		$this->db->where('id', $id);
		return $this->db->update($this->table, $data);
	}

	public function delete($id)
	{
		$this->db->where('id', $id);
		return $this->db->delete($this->table);
	}

	public function getProduk($id)
	{
		$this->db->select('produk.id, produk.kode_barang, produk.nama_produk, produk.harga, produk.harga_jual, produk.stok, kategori_produk.id as kategori_id, kategori_produk.kategori, satuan_produk.id as satuan_id, satuan_produk.satuan');
		$this->db->from($this->table);
		$this->db->join('kategori_produk', 'produk.kategori = kategori_produk.id');
		$this->db->join('satuan_produk', 'produk.satuan = satuan_produk.id');
		$this->db->where('produk.id', $id);
		return $this->db->get();
	}

	public function getBarcodeWithName($search = '')
	{
		$this->db->select('produk.id, produk.kode_barang, produk.nama_produk, kategori_produk.kategori, satuan_produk.satuan');
		$this->db->from($this->table);
		$this->db->join('kategori_produk', 'produk.kategori = kategori_produk.id');
		$this->db->join('satuan_produk', 'produk.satuan = satuan_produk.id');
		$this->db->like('kode_barang', $search);

		return $this->db->get()->result();
	}


	public function getBarcode($search = '')
	{
		$this->db->select('produk.id, produk.kode_barang , produk.nama_produk');
		$this->db->like('kode_barang', $search);
		return $this->db->get($this->table)->result();
	}

	public function getNama($id)
	{
		$this->db->select('nama_produk, stok , kode_barang , satuan');
		$this->db->where('id', $id);
		return $this->db->get($this->table)->row();
	}

	public function getSatuanProduk($id)
	{
		$this->db->select('satuan_produk.*');
		$this->db->where('produk.id', $id);
		$this->db->join('satuan_produk', 'produk.satuan = satuan_produk.id', 'left');
		return $this->db->get($this->table)->row();
	}

	public function getNamaDetail($id)
	{
		$this->db->select('produk.nama_produk, (stok_masuk.jumlah * produk.harga) AS total');
		$this->db->from('stok_masuk');
		$this->db->join('produk', 'stok_masuk.kode_barang = produk.id');
		$this->db->where('stok_masuk.id', $id);
		return $this->db->get()->row();
	}

	public function getStok($id)
	{
		$this->db->select('stok, nama_produk, harga_jual, kode_barang ,satuan, gambar');
		$this->db->where('id', $id);
		return $this->db->get($this->table);
	}

	public function produkTerlaris()
	{
		return $this->db->query('SELECT produk.nama_produk, produk.terjual FROM `produk` 
		ORDER BY CONVERT(terjual,decimal)  DESC LIMIT 5')->result();
	}

	public function dataStok()
	{
		return $this->db->query('SELECT produk.nama_produk, produk.stok FROM `produk` ORDER BY CONVERT(stok, decimal) DESC LIMIT 50')->result();
	}
}

/* End of file Produk_model.php */
/* Location: ./application/models/Produk_model.php */