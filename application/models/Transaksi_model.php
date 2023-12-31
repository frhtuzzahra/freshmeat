<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transaksi_model extends CI_Model
{

	private $table = 'transaksi';

	public function readAll()
	{
		$this->db->select('transaksi.tanggal, transaksi.nota, produk.nama_produk, pengguna.nama, transaksi.total_bayar');
		$this->db->select('(SELECT SUM(total_bayar) FROM transaksi) as bayar', FALSE);
		$this->db->from('transaksi');
		$this->db->join('produk', 'transaksi.kode_barang = produk.id');
		$this->db->join('pengguna', 'transaksi.pelanggan = pengguna.id', 'left outer');
		$this->db->order_by('transaksi.tanggal', 'ASC');

		return $this->db->get();
	}

	public function getTransaksiWithPeriode($tanggal_awal, $tanggal_akhir)
	{
		$query = "SELECT transaksi.tanggal, transaksi.nota, produk.nama_produk, pengguna.nama, transaksi.total_bayar,
          (SELECT SUM(total_bayar) FROM transaksi WHERE tanggal >= '" . $tanggal_awal . "' AND tanggal <= '" . $tanggal_akhir . "') AS bayar
          FROM transaksi JOIN produk ON transaksi.kode_barang = produk.id
          LEFT OUTER JOIN pengguna ON transaksi.pelanggan = pengguna.id
          WHERE transaksi.tanggal >= '" . $tanggal_awal . "' AND transaksi.tanggal <= '" . $tanggal_akhir . "'
          ORDER BY transaksi.tanggal ASC";

		return $this->db->query($query);
	}


	public function removeStok($id, $stok)
	{
		$this->db->where('id', $id);
		$this->db->set('stok', $stok);
		return $this->db->update('produk');
	}

	public function addTerjual($id, $jumlah)
	{
		$this->db->where('id', $id);
		$this->db->set('terjual', $jumlah);
		return $this->db->update('produk');;
	}

	public function create($data)
	{
		return $this->db->insert($this->table, $data);
	}

	public function read()
	{
		$this->db->select('transaksi.id, transaksi.tanggal, transaksi.kode_barang, transaksi.qty, transaksi.total_bayar, transaksi.jumlah_uang, transaksi.diskon, pengguna.nama as pelanggan , qty');
		$this->db->from($this->table);
		$this->db->join('pengguna', 'transaksi.pelanggan = pengguna.id', 'left outer');
		return $this->db->get();
	}

	public function delete($id)
	{
		$this->db->where('id', $id);
		return $this->db->delete($this->table);
	}

	public function getProduk($barcode, $qty)
	{
		$total = explode(',', $qty);
		foreach ($barcode as $key => $value) {
			$this->db->select('nama_produk');
			$this->db->where('id', $value);
			$data[] = '<tr><td>' . $this->db->get('produk')->row()->nama_produk . ' ( Qty : ' . $total[$key] . ')</td></tr>';
		}
		return join($data);
	}

	public function getSatuanProduk($barcode)
	{
		$data = array();

		foreach ($barcode as $key => $value) {
			$this->db->select('produk.nama_produk, satuan_produk.satuan');
			$this->db->from('produk');
			$this->db->join('satuan_produk', 'satuan_produk.id = produk.satuan');
			$this->db->where('produk.id', $value);

			$result = $this->db->get()->row();
			if ($result) {
				$data[] = '<tr><td>' . $result->satuan .'</td></tr>';
			}
		}
		return join($data);
	}

	public function penjualanBulan($date)
	{
		$qty = $this->db->query("SELECT qty FROM transaksi WHERE DATE_FORMAT(tanggal, '%d %m %Y') = '$date'")->result();
		$d = [];
		$data = [];
		foreach ($qty as $key) {
			$d[] = explode(',', $key->qty);
		}
		foreach ($d as $key) {
			$data[] = array_sum($key);
		}
		return $data;
	}

	public function transaksiHari($hari)
	{
		return $this->db->query("SELECT COUNT(*) AS total FROM transaksi WHERE DATE_FORMAT(tanggal, '%d %m %Y') = '$hari'")->row();
	}

	public function transaksiHariPelanggan($hari, $id)
	{
		return $this->db->query("SELECT COUNT(*) AS total FROM booking WHERE DATE_FORMAT(tanggal, '%d %m %Y') = '$hari' AND pelanggan = " . $id)->row();
	}

	public function transaksiTerakhir($hari)
	{
		return $this->db->query("SELECT transaksi.qty FROM transaksi WHERE DATE_FORMAT(tanggal, '%d %m %Y') = '$hari' LIMIT 1")->row();
	}

	public function bookingTerakhir($hari, $id)
	{
		return $this->db->query("SELECT booking.qty FROM booking WHERE DATE_FORMAT(tanggal, '%d %m %Y') = '$hari' AND pelanggan = " . $id . " order by id desc LIMIT 1")->row();
	}

	public function getAll($id)
	{
		$this->db->select('transaksi.nota, transaksi.tanggal, transaksi.diskon, transaksi.kode_barang, transaksi.qty, transaksi.total_bayar, transaksi.jumlah_uang, pengguna.nama as kasir');
		$this->db->from('transaksi');
		$this->db->join('pengguna', 'transaksi.kasir = pengguna.id');
		$this->db->where('transaksi.id', $id);
		return $this->db->get()->row();
	}

	public function getName($barcode)
	{
		foreach ($barcode as $b) {
			$this->db->select('nama_produk, harga_jual, satuan');
			$this->db->where('id', $b);
			$data[] = $this->db->get('produk')->row();
		}
		return $data;
	}
}

/* End of file Transaksi_model.php */
/* Location: ./application/models/Transaksi_model.php */
