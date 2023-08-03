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
					<button class="dropdown-item" onclick="remove(' . $booking->id . ')">Hapus</button>
                    </div>
					</div>'
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

	public function delete()
	{
		$id = $this->input->post('id');
		if ($this->booking_model->delete($id)) {
			echo json_encode('sukses');
		}
	}

	public function cetak()
	{
		$tgl_awal = $this->input->post('tgl_awal');
		$tgl_akhir = $this->input->post('tgl_akhir');

		$this->load->model('booking_model', 'booking');
		if (empty($tgl_awal) || empty($tgl_akhir)) {
			$data['data_booking'] = $this->booking->readAll()->result();
			$data['label'] = "Data Semua Booking";
		} else {
			$data['data_booking'] = $this->booking->getBookingWithPeriode($tgl_awal, $tgl_akhir)->result();
			$tgl_awal = date('d-m-Y', strtotime($tgl_awal)); // Ubah format tanggal jadi dd-mm-yyyy
			$tgl_akhir = date('d-m-Y', strtotime($tgl_akhir)); // Ubah format tanggal jadi dd-mm-yyyy
			$label = 'Periode Tanggal ' . $tgl_awal . ' s/d ' . $tgl_akhir;
			$data['label'] = $label;
		}

		$this->load->view('cetak_laporan_data_booking_pdf', $data);
	}
}

/* End of file booking.php */
/* Location: ./application/controllers/booking.php */