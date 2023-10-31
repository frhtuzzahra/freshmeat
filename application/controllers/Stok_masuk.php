<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Stok_masuk extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('status') !== 'login') {
			redirect('/');
		}
		$this->load->model('stok_masuk_model');
		$this->load->model('satuan_produk_model');
	}

	public function index()
	{
		$this->load->view('stok_masuk');
	}

	public function lunas()
	{
		$id = $this->input->post('id');
		$data = array(
			'status' => 'Lunas'
		);
		if ($this->stok_masuk_model->update($id, $data)) {
			echo json_encode('sukses');
		}
	}

	public function read()
	{
		header('Content-type: application/json');
		if ($this->stok_masuk_model->read()->num_rows() > 0) {
			foreach ($this->stok_masuk_model->read()->result() as $stok_masuk) {
				$tanggal = new DateTime($stok_masuk->tanggal);
				$satuan = $this->satuan_produk_model->getKategori($stok_masuk->satuan)->result();
				$data[] = array(
					'tanggal' => $tanggal->format('Y-m-d H:i:s'),
					'kode_barang' => $stok_masuk->kode_barang,
					'nama_produk' => $stok_masuk->nama_produk,
					'harga' => "Rp. " . number_format($stok_masuk->harga, 0, ',', '.'),
					'total' => "Rp. " . number_format($stok_masuk->harga * $stok_masuk->jumlah, 0, ',', '.'),
					'jumlah' => $stok_masuk->jumlah,
					'status' => ($stok_masuk->status == 'Lunas') ? '<span class="badge badge-success">' . $stok_masuk->status . '</span>' : '<span class="badge badge-danger">' . $stok_masuk->status . '</span>',
					'keterangan' => $stok_masuk->keterangan,
					'tanggal_expired' => $stok_masuk->tanggal_expired,
					'tanggal_frezer' => $stok_masuk->tanggal_frezer,
					'satuan' => $stok_masuk->satuan,
				);
			}
		} else {
			$data = array();
		}
		$stok_masuk = array(
			'data' => $data
		);
		echo json_encode($stok_masuk);
	}

	public function get_nama_statusDP()
	{
		$dp = $this->stok_masuk_model->readDP();
		if ($dp->row()) {
			echo json_encode($dp->row());
		}
	}

	public function get_IdStokMasuk()
	{
		header('Content-type: application/json');
		$id_stokmasuk = $this->input->post('id_stokmasuk');
		$search = $this->stok_masuk_model->getIdStokMasuk($id_stokmasuk);
		$data = [];
		foreach ($search as $produk) {
			$data[] = array(
				'id' => $produk->id,
				'text' => $produk->id,
			);
		}
		echo json_encode($data);
	}

	public function add()
	{
		$id = $this->input->post('kode_barang');
		$jumlah = $this->input->post('jumlah');
		$stok = $this->stok_masuk_model->getStok($id)->stok;
		$rumus = max($stok + $jumlah, 0);
		$addStok = $this->stok_masuk_model->addStok($id, $rumus);
		if ($addStok) {
			$tanggal_frezer_input = $this->input->post('freezer');
			$tanggal_expired_input = $this->input->post('expired');
			
			// Mengonversi tanggal frezer ke format datetime MySQL
			$timestamp_frezer = strtotime($tanggal_frezer_input);
			$tanggal_frezer_mysql = date("Y-m-d H:i:s", $timestamp_frezer);
			
			// Mengonversi tanggal expired ke format datetime MySQL
			$timestamp_expired = strtotime($tanggal_expired_input);
			$tanggal_expired_mysql = date("Y-m-d H:i:s", $timestamp_expired);
			
			// Membuat array data yang akan disimpan ke dalam database
			$data = array(
				'kode_barang' => $id,
				'jumlah' => $jumlah,
				'status' => $this->input->post('status'),
				'keterangan' => $this->input->post('keterangan'),
				'supplier' => $this->input->post('supplier'),
				'tanggal_frezer' => $tanggal_frezer_mysql, // Format datetime MySQL
				'tanggal_expired' => $tanggal_expired_mysql, // Format datetime MySQL
			);
			
			if ($this->stok_masuk_model->create($data)) {
				echo json_encode('sukses');
			}
		}
	}

	public function update()
	{
		$id = $this->input->post('id');
		$data = array(
			'status' => "lunas",
		);
		if ($this->stok_masuk_model->update($id, $data)) {
			echo json_encode('sukses');
		}
	}

	public function get_stok_masuk()
	{
		$id = $this->input->post('id');
		$stok_masuk = $this->stok_masuk_model->getStokMasuk($id);
		if ($stok_masuk->row()) {
			echo json_encode($stok_masuk->row());
		}
	}

	public function laporan()
	{
		header('Content-type: application/json');
		if ($this->stok_masuk_model->laporan()->num_rows() > 0) {
			foreach ($this->stok_masuk_model->laporan()->result() as $stok_masuk) {
				$satuan = $this->satuan_produk_model->getKategori($stok_masuk->satuan)->result();
				$tanggal = new DateTime($stok_masuk->tanggal);
				$data[] = array(
					'tanggal' => $tanggal->format('Y-m-d H:i:s'),
					'kode_barang' => $stok_masuk->kode_barang,
					'nama_produk' => $stok_masuk->nama_produk,
					'jumlah' => $stok_masuk->jumlah,
					'harga_jual' => "Rp. " . number_format($stok_masuk->harga_jual, 0, ',', '.'),
					'total' => "Rp. " . number_format($stok_masuk->harga_jual * $stok_masuk->jumlah, 0, ',', '.'),
					'status' => $stok_masuk->status,
					'keterangan' => $stok_masuk->keterangan,
					'supplier' => $stok_masuk->supplier,
					'satuan' => $satuan[0]->satuan,
				);
			}
		} else {
			$data = array();
		}
		$stok_masuk = array(
			'data' => $data
		);
		echo json_encode($stok_masuk);
	}

	public function stok_hari()
	{
		header('Content-type: application/json');
		$now = date('d m Y');
		$total = $this->stok_masuk_model->stokHari($now);
		echo json_encode($total->total == null ? 0 : $total);
	}
}

/* End of file Stok_masuk.php */
/* Location: ./application/controllers/Stok_masuk.php */
