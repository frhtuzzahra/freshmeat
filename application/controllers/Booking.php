<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Booking extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('status') !== 'login') {
			redirect('/');
		}
		$this->load->model('booking_model');
	}

	public function index()
	{
		$this->load->view('booking');
	}

	public function add()
	{
		$produk = json_decode($this->input->post('produk'));
		$tanggal = new DateTime($this->input->post('tanggal'));
		$barcode = array();
		foreach ($produk as $produk) {
			array_push($barcode, $produk->id);
		}
		$pelanggan = $_SESSION['id'];
		$data = array(
			'tanggal' => $tanggal->format('Y-m-d H:i:s'),
			'barcode' => implode(',', $barcode),
			'qty' => implode(',', $this->input->post('qty')),
			'total_bayar' => $this->input->post('total_bayar'),
			'pelanggan' => $pelanggan,
			'nota' => 'BKG' . date('YmdHis'),
			'status' => 'belum'
		);
		if ($this->booking_model->create($data)) {
			echo json_encode($this->db->insert_id());
		}
		$data = $this->input->post('form');
	}
}

/* End of file Transaksi.php */
/* Location: ./application/controllers/Transaksi.php */