<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Stok_keluar extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('status') !== 'login') {
			redirect('/');
		}
		$this->load->model('stok_keluar_model');
		$this->load->model('satuan_produk_model');
	}

	public function index()
	{
		$this->load->view('stok_keluar');
	}

	public function cetak()
	{
		$data['stok_keluar'] = $this->stok_keluar_model->read()->result();
		$data['label'] = "Data Stok Keluar";
		$this->load->view('cetak_laporan_stok_keluar_pdf', $data);
	}

	public function read()
	{
		header('Content-type: application/json');
		if ($this->stok_keluar_model->read()->num_rows() > 0) {
			foreach ($this->stok_keluar_model->read()->result() as $stok_keluar) {
				$satuan = $this->satuan_produk_model->getKategori($stok_keluar->satuan)->result();
				$tanggal = new DateTime($stok_keluar->tanggal);
				$data[] = array(
					'tanggal' => $tanggal->format('Y-m-d H:i:s'),
					'kode_barang' => $stok_keluar->kode_barang,
					'nama_produk' => $stok_keluar->nama_produk,
					'jumlah' => $stok_keluar->jumlah,
					'keterangan' => $stok_keluar->keterangan,
					'satuan' => $satuan[0]->satuan,
				);
			}
		} else {
			$data = array();
		}
		$stok_keluar = array(
			'data' => $data
		);
		echo json_encode($stok_keluar);
	}

	public function add()
	{
		$id = $this->input->post('kode_barang');
		$jumlah = $this->input->post('jumlah');
		$stok = $this->stok_keluar_model->getStok($id)->stok;
		$rumus = max($stok - $jumlah, 0);
		$addStok = $this->stok_keluar_model->addStok($id, $rumus);
		if ($addStok) {
			$tanggal = new DateTime($this->input->post('tanggal'));
			$data = array(
				'tanggal' => $tanggal->format('Y-m-d H:i:s'),
				'kode_barang' => $id,
				'jumlah' => $jumlah,
				'keterangan' => $this->input->post('keterangan')
			);
			if ($this->stok_keluar_model->create($data)) {
				echo json_encode('sukses');
			}
		}
	}

	public function get_barcode()
	{
		$barcode = $this->input->post('barcode');
		$kategori = $this->stok_keluar_model->getKategori($barcode);
		if ($kategori->row()) {
			echo json_encode($kategori->row());
		}
	}
}

/* End of file Stok_keluar.php */
/* Location: ./application/controllers/Stok_keluar.php */