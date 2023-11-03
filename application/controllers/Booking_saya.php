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
				$barcode = explode(',', $booking->kode_barang);
				$tanggal = new DateTime($booking->tanggal);
				$data[] = array(
					'tanggal' => $tanggal->format('Y-m-d H:i:s'),
					'nota' => $booking->nota,
					'nama_produk' => '<table>' . $this->booking_model->getProduk($barcode, $booking->qty) . '</table>',
					'nama_satuan' => '<table>' . $this->booking_model->getSatuan($barcode, $booking->qty) . '</table>',
					'total_bayar' => "Rp. " . number_format($booking->total_bayar, 0, ',', '.'),
					'status' => ($booking->status == 'belum') ? '<span class="badge badge-warning">Belum</span>' : '<span class="badge badge-success">Diambil</span>',
					'action' => '<a class="btn btn-sm btn-success" href="' . site_url('booking_saya/cetak/') . $booking->id . '" target="_blank">Print</a>'
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

	public function cetak($id)
	{
		$booking = $this->booking_model->getAll($id);

		$tanggal = new DateTime($booking->tanggal);
		$barcode = explode(',', $booking->kode_barang);
		$qty = explode(',', $booking->qty);

		$booking->tanggal = $tanggal->format('d-m-Y H:i:s');

		$dataBooking = $this->booking_model->getName($barcode);
		foreach ($dataBooking as $key => $value) {
			$value->total = $qty[$key];
			$value->harga_jual;
		}

		$data = array(
			'produk' => $dataBooking,
			'total' => $booking->total_bayar,
			'tanggal' => $booking->tanggal,
			'nota' => $booking->nota,
			'status' => ($booking->status == 'belum') ? '<span class="badge badge-warning">Belum</span>' : '<span class="badge badge-success">Diambil</span>'
		);

		$this->load->view('cetak_booking_saya_pdf', $data);
	}
}

/* End of file Transaksi.php */
/* Location: ./application/controllers/Transaksi.php */
