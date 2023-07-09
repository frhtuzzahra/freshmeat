<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan_stok_masuk extends CI_Controller
{

	public function index()
	{
		if ($this->session->userdata('status') !== 'login') {
			redirect('/');
		}
		$this->load->view('laporan_stok_masuk');
	}

	public function cetak()
	{
		$tgl_awal = $this->input->post('tgl_awal');
		$tgl_akhir = $this->input->post('tgl_akhir');

		$this->load->model('stok_masuk_model', 'stok_masuk');
		if (empty($tgl_awal) || empty($tgl_akhir)) {
			$data['stok_masuk'] = $this->stok_masuk->readAll()->result();
			$data['label'] = "Data Semua Stok Masuk";
		} else {
			$data['stok_masuk'] = $this->stok_masuk->getStokMasukWithPeriode($tgl_awal, $tgl_akhir)->result();
			$tgl_awal = date('d-m-Y', strtotime($tgl_awal)); // Ubah format tanggal jadi dd-mm-yyyy
			$tgl_akhir = date('d-m-Y', strtotime($tgl_akhir)); // Ubah format tanggal jadi dd-mm-yyyy
			$label = 'Periode Tanggal ' . $tgl_awal . ' s/d ' . $tgl_akhir;
			$data['label'] = $label;
		}

		$this->load->view('laporan_stok_masuk_pdf', $data);
	}
}

/* End of file Laporan_stok_masuk.php */
/* Location: ./application/controllers/Laporan_stok_masuk.php */