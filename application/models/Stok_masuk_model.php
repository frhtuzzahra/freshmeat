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

	public function MoveStockFromIntoOut()
	{
		$this->db->trans_begin(); // Memulai transaksi database

		$this->db->select('stok_masuk.id, stok_masuk.tanggal, stok_masuk.jumlah, stok_masuk.status, stok_masuk.keterangan, produk.kode_barang, produk.nama_produk, produk.harga, tanggal_expired, tanggal_frezer, satuan_produk.satuan');
		$this->db->from($this->table);
		$this->db->join('produk', 'produk.id = stok_masuk.kode_barang');
		$this->db->join("satuan_produk", "satuan_produk.id = produk.satuan");
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
		// $this->db->delete($this->table);

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


		$this->db->select('stok_masuk.id, stok_masuk.tanggal, stok_masuk.jumlah, stok_masuk.status, stok_masuk.keterangan, produk.kode_barang, produk.nama_produk, produk.harga ,tanggal_expired ,tanggal_frezer ,satuan_produk.satuan');
		$this->db->from($this->table);
		$this->db->join('produk', 'produk.id = stok_masuk.kode_barang');
		$this->db->join('satuan_produk', 'satuan_produk.id = produk.satuan');
		$this->db->where('tanggal_expired >', date('Y-m-d'));
		$this->db->order_by('stok_masuk.tanggal', 'desc');
		return $this->db->get();
	}

	public function readDP()
	{
		$this->db->select('stok_masuk.id, stok_masuk.status, produk.kode_barang, produk.nama_produk');
		$this->db->from($this->table);
		$this->db->join('produk', 'produk.id = stok_masuk.kode_barang');
		$this->db->where('stok_masuk.status', 'DP');
		return $this->db->get();
	}

	public function readAll()
	{
		$query = "SELECT
		stok_masuk.tanggal,
		produk.kode_barang,
		produk.satuan,
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
	FROM
		stok_masuk
	JOIN
		produk ON produk.id = stok_masuk.kode_barang
		JOIN supplier ON supplier.id = stok_masuk.supplier
		where stok_masuk.status = 'lunas'";

		return $this->db->query($query);
	}

	public function getIdStokMasuk()
	{
		// $query = "SELECT stok_masuk.id 
		// FROM stok_masuk
		// JOIN produk ON stok_masuk.kode_barang = produk.id
		// WHERE stok_masuk.status = 'DP'
		// AND stok_masuk.id NOT IN (
		// 	SELECT id_stokmasuk 
		// 	FROM detail_stokmasuk
		// )";

		$query = "SELECT stok_masuk.id 
		FROM stok_masuk
		JOIN produk ON stok_masuk.kode_barang = produk.id
		WHERE stok_masuk.status = 'DP'";
		return $this->db->query($query)->result();
	}

	public function getStokMasukWithPeriode($tgl_awal, $tgl_akhir)
	{
		$query = "SELECT
		stok_masuk.tanggal,
		produk.kode_barang,
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
			JOIN produk ON produk.id = stok_masuk.kode_barang
			WHERE stok_masuk.tanggal BETWEEN '$tgl_awal' AND '$tgl_akhir'
		) AS total_semua
	FROM
		stok_masuk
	JOIN
		produk ON produk.id = stok_masuk.kode_barang
		join supplier on supplier.id = stok_masuk.supplier
		WHERE
		stok_masuk.tanggal BETWEEN '$tgl_awal' AND '$tgl_akhir'
		ORDER BY
		stok_masuk.tanggal ASC
		";

		return $this->db->query($query);
	}

	public function getNamaProduk($search = '')
	{
		$this->db->select('stok_masuk.id, stok_masuk.tanggal, stok_masuk.jumlah, stok_masuk.status, produk.nama_produk, produk.harga_jual, stok_masuk.jumlah, (stok_masuk.jumlah * produk.harga_jual) AS total_bayar');
		$this->db->from('stok_masuk');
		$this->db->join('produk', 'stok_masuk.kode_barang = produk.id');
		$this->db->where('stok_masuk.status', 'DP');
		$this->db->like('stok_masuk.id', $search);
		return $this->db->get()->result();
	}

	public function laporan()
	{
		$this->db->select('stok_masuk.tanggal, stok_masuk.jumlah, stok_masuk.status, stok_masuk.keterangan, produk.kode_barang, produk.nama_produk, produk.harga_jual, supplier.nama as supplier ,satuan');
		$this->db->from($this->table);
		$this->db->join('produk', 'produk.id = stok_masuk.kode_barang');
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
