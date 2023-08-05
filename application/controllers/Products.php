<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Products extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('status') !== 'login') {
			redirect('/');
		}
		$this->load->model('produk_model');
	}

	public function index()
	{
		$this->load->view('products');
	}
	public function read()
	{
		header('Content-type: application/json');
		if ($this->produk_model->read()->num_rows() > 0) {
			foreach ($this->produk_model->read()->result() as $produk) {
				$data[] = array(
					'barcode' => $produk->barcode,
					'gambar' => '<img src="' . base_url('assets/images/' . $produk->gambar) . '" class="img-fluid" width="100">',
					'nama' => $produk->nama_produk,
					'kategori' => $produk->kategori,
					'satuan' => $produk->satuan,
					'harga_jual' => "Rp. " . number_format($produk->harga_jual, 0, ',', '.'),
					'stok' => $produk->stok
				);
			}
		} else {
			$data = array();
		}
		$produk = array(
			'data' => $data
		);
		echo json_encode($produk);
	}
}

/* End of file Produk.php */
/* Location: ./application/controllers/Produk.php */