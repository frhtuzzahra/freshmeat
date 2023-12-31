<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Produk extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('status') !== 'login') {
			redirect('/');
		}
		$this->load->model('produk_model');
		$this->load->model('satuan_produk_model');
	}

	public function index()
	{
		$this->load->view('produk');
	}

	public function cetak()
	{
		$data['produk'] = $this->produk_model->read()->result();
		$data['label'] = "Data Produk";
		$this->load->view('cetak_produk_pdf', $data);
	}

	public function read()
	{
		header('Content-type: application/json');
		if ($this->produk_model->read()->num_rows() > 0) {
			foreach ($this->produk_model->read()->result() as $produk) {
				$data[] = array(
					'kode_barang' => $produk->kode_barang,
					'gambar' => '<img src="' . base_url('uploads/' . $produk->gambar) . '" class="img-thumbnail" width="100">',
					'nama' => $produk->nama_produk,
					'kategori' => $produk->kategori,
					'satuan' => $produk->satuan,
					'harga_jual' => "Rp. " . number_format($produk->harga_jual, 0, ',', '.'),
					'stok' => $produk->stok,
					'action' => '<button class="btn btn-sm btn-success" onclick="edit(' . $produk->id . ')">Edit</button> <button class="btn btn-sm btn-danger" onclick="remove(' . $produk->id . ')">Delete</button>'
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

	public function add()
	{
		$config['upload_path'] = './uploads/'; // Ganti dengan path folder penyimpanan gambar
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size'] = 2048; // Maksimal ukuran file dalam kilobyte (KB)
		$config['encrypt_name'] = TRUE; // Enkripsi nama yang terupload
		$this->load->library('upload', $config);

		if ($this->upload->do_upload('gambar')) {
			$data = array(
				'gambar' => $this->upload->data('file_name'),
				'kode_barang' => $this->input->post('kode_barang'),
				'nama_produk' => $this->input->post('nama_produk'),
				'satuan' => $this->input->post('satuan'),
				'kategori' => $this->input->post('kategori'),
				'harga' => $this->input->post('harga'),
				'harga_jual' => $this->input->post('harga_jual'),
				'stok' => $this->input->post('stok')
			);
			if ($this->produk_model->create($data)) {
				echo json_encode($data);
			}
		} else {
			echo json_encode('error');
		}
	}

	public function edit()
	{
		$config['upload_path'] = './uploads/'; // Ganti dengan path folder penyimpanan gambar
		$config['allowed_types'] = 'jpg|png';
		$config['max_size'] = 2048; // Maksimal ukuran file dalam kilobyte (KB)
		$config['encrypt_name'] = TRUE; // Enkripsi nama yang terupload
		$this->load->library('upload', $config);

		if ($this->upload->do_upload('gambar')) {
			$id = $this->input->post('id');
			$data = array(
				'gambar' => $this->upload->data('file_name'),
				'kode_barang' => $this->input->post('kode_barang'),
				'nama_produk' => $this->input->post('nama_produk'),
				'satuan' => $this->input->post('satuan'),
				'kategori' => $this->input->post('kategori'),
				'harga' => $this->input->post('harga'),
				'harga_jual' => $this->input->post('harga_jual'),
				'stok' => $this->input->post('stok')
			);
			if ($this->produk_model->update($id, $data)) {
				echo json_encode('sukses');
			}
		} else {
			echo json_encode('error');
		}
	}

	public function delete()
	{
		$id = $this->input->post('id');
		if ($this->produk_model->delete($id)) {
			echo json_encode('sukses');
		}
	}

	public function get_produk()
	{
		header('Content-type: application/json');
		$id = $this->input->post('id');
		$kategori = $this->produk_model->getProduk($id);
		if ($kategori->row()) {
			echo json_encode($kategori->row());
		}
	}

	public function get_barcode()
	{
		header('Content-type: application/json');
		$barcode = $this->input->post('kode_barang');
		$search = $this->produk_model->getBarcode($barcode);
		foreach ($search as $barcode) {
			$data[] = array(
				'id' => $barcode->id,
				'text' => $barcode->kode_barang,
				'nama_produk' => $barcode->nama_produk
			);
		}
		echo json_encode($data);
	}

	public function get_barcodeWithName()
	{
		header('Content-type: application/json');
		$barcode = $this->input->post('kode_barang');
		$search = $this->produk_model->getBarcodeWithName($barcode);
		foreach ($search as $barcode) {
			$data[] = array(
				'id' => $barcode->id,
				'text' => $barcode->kode_barang,
				'nama_produk' => $barcode->nama_produk
			);
		}
		echo json_encode($data);
	}

	public function get_nama()
	{
		header('Content-type: application/json');
		$id = $this->input->post('id');
		$produk = $this->produk_model->getStok($id)->result();

		foreach ($produk as $barcode) {
			$satuan = $this->satuan_produk_model->getKategori($barcode->satuan)->result();
			$data = array(
				'nama_produk' => $barcode->nama_produk,
				'satuan' => $satuan[0]->satuan,
				'kode_barang' => $barcode->kode_barang,
				'stok' => $barcode->stok,
				'harga_jual' => $barcode->harga_jual,
				"img" => $barcode->gambar
			);
		}
		echo json_encode($data);
	}

	public function get_namaDetail()
	{
		header('Content-type: application/json');
		$id = $this->input->post('id');
		echo json_encode($this->produk_model->getNamaDetail($id));
	}

	public function get_stok()
	{
		header('Content-type: application/json');
		$id = $this->input->post('id');
		$produk = $this->produk_model->getStok($id)->result();

		foreach ($produk as $barcode) {
			$satuan = $this->satuan_produk_model->getKategori($barcode->satuan)->result();
			$data = array(
				'nama_produk' => $barcode->nama_produk,
				'satuan' => $satuan[0]->satuan,
				'kode_barang' => $barcode->kode_barang,
				'stok' => $barcode->stok,
				'harga_jual' => $barcode->harga_jual
			);
		}
		echo json_encode($data);
	}

	public function produk_terlaris()
	{
		header('Content-type: application/json');
		$produk = $this->produk_model->produkTerlaris();
		foreach ($produk as $key) {
			$label[] = $key->nama_produk;
			$data[] = $key->terjual;
		}
		$result = array(
			'label' => $label,
			'data' => $data,
		);
		echo json_encode($result);
	}

	public function data_stok()
	{
		header('Content-type: application/json');
		$produk = $this->produk_model->dataStok();
		echo json_encode($produk);
	}
}

/* End of file Produk.php */
/* Location: ./application/controllers/Produk.php */