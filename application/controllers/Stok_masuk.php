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
				$data[] = array(
					'tanggal' => $tanggal->format('d-m-Y H:i:s'),
					'barcode' => $stok_masuk->barcode,
					'nama_produk' => $stok_masuk->nama_produk,
					'harga' => $stok_masuk->harga,
					'total' => $stok_masuk->harga * $stok_masuk->jumlah,
					'jumlah' => $stok_masuk->jumlah,
					'status' => ($stok_masuk->status == 'Lunas') ? '<button type="button" class="btn btn-sm btn-success">' . $stok_masuk->status . '</button>' : '
					<div class="btn-group">
					<button type="button" class="btn btn-sm btn-danger">' . $stok_masuk->status . '</button>
                    <button type="button" class="btn btn-sm btn-danger dropdown-toggle dropdown-hover dropdown-icon" data-toggle="dropdown">
                      <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <div class="dropdown-menu" role="menu">
					<button class="dropdown-item" onclick="update(' . $stok_masuk->id . ')">Lunas</button>
                    </div>
					</div>',
					'keterangan' => $stok_masuk->keterangan,
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

	public function add()
	{
		$id = $this->input->post('barcode');
		$jumlah = $this->input->post('jumlah');
		$stok = $this->stok_masuk_model->getStok($id)->stok;
		$rumus = max($stok + $jumlah, 0);
		$addStok = $this->stok_masuk_model->addStok($id, $rumus);
		if ($addStok) {
			$tanggal = new DateTime($this->input->post('tanggal'));
			$data = array(
				'tanggal' => $tanggal->format('Y-m-d H:i:s'),
				'barcode' => $id,
				'jumlah' => $jumlah,
				'status' => $this->input->post('status'),
				'keterangan' => $this->input->post('keterangan'),
				'supplier' => $this->input->post('supplier')
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

	// public function get_barcode()
	// {
	// 	$barcode = $this->input->post('barcode');
	// 	$kategori = $this->stok_masuk_model->getKategori($barcode);
	// 	if ($kategori->row()) {
	// 		echo json_encode($kategori->row());
	// 	}
	// }

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
				$tanggal = new DateTime($stok_masuk->tanggal);
				$data[] = array(
					'tanggal' => $tanggal->format('d-m-Y H:i:s'),
					'barcode' => $stok_masuk->barcode,
					'nama_produk' => $stok_masuk->nama_produk,
					'jumlah' => $stok_masuk->jumlah,
					'harga_jual' => $stok_masuk->harga_jual,
					'total' => $stok_masuk->harga_jual * $stok_masuk->jumlah,
					'status' => $stok_masuk->status,
					'keterangan' => $stok_masuk->keterangan,
					'supplier' => $stok_masuk->supplier
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
