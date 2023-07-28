<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Booking_saya extends CI_Controller
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
		$this->load->view('booking_saya');
	}

	public function read()
	{
		header('Content-type: application/json');
		$id = $_SESSION['id'];
		if ($this->booking_model->readByIdPelanggan($id)->num_rows() > 0) {
			foreach ($this->booking_model->readByIdPelanggan($id)->result() as $booking) {
				$barcode = explode(',', $booking->barcode);
				$tanggal = new DateTime($booking->tanggal);
				$data[] = array(
					'tanggal' => $tanggal->format('Y-m-d H:i:s'),
					'nota' => $booking->nota,
					'nama_produk' => '<table>' . $this->booking_model->getProduk($barcode, $booking->qty) . '</table>',
					'total_bayar' => "Rp. " . number_format($booking->total_bayar, 0, ',', '.'),
					// 'pelanggan' => $booking->pelanggan,
					'status' => ($booking->status == 'belum') ? '<span class="badge badge-warning">Belum</span>' : '<span class="badge badge-success">Diambil</span>',
				);
			}
		} else {
			$data = array();
		}
		$booking = array(
			'data' => $data
		);
		echo json_encode($booking);
	}
}

/* End of file Transaksi.php */
/* Location: ./application/controllers/Transaksi.php */