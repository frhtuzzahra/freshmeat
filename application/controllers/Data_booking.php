<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Data_booking extends CI_Controller
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
		$this->load->view('data_booking');
	}

	public function read()
	{
		header('Content-type: application/json');
		if ($this->booking_model->read()->num_rows() > 0) {
			foreach ($this->booking_model->read()->result() as $booking) {
				$barcode = explode(',', $booking->barcode);
				$tanggal = new DateTime($booking->tanggal);
				$data[] = array(
					'tanggal' => $tanggal->format('Y-m-d H:i:s'),
					'nota' => $booking->nota,
					'nama_produk' => '<table>' . $this->booking_model->getProduk($barcode, $booking->qty) . '</table>',
					'total_bayar' => "Rp. " . number_format($booking->total_bayar, 0, ',', '.'),
					'status' => ($booking->status == 'diambil') ? '<button type="button" class="btn btn-sm btn-success">' . ucfirst($booking->status) . '</button>' : '
					<div class="btn-group">
					<button type="button" class="btn btn-sm btn-danger">' . ucfirst($booking->status) . '</button>
                    <button type="button" class="btn btn-sm btn-danger dropdown-toggle dropdown-hover dropdown-icon" data-toggle="dropdown">
                      <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <div class="dropdown-menu" role="menu">
					<button class="dropdown-item" onclick="update(' . $booking->id . ')">Diambil</button>
                    </div>
					</div>',
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

	public function update()
	{
		$id = $this->input->post('id');
		$data = array(
			'status' => "diambil",
		);
		if ($this->booking_model->update($id, $data)) {
			echo json_encode('sukses');
		}
	}
}

/* End of file Transaksi.php */
/* Location: ./application/controllers/Transaksi.php */