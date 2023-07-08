<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan_penjualan extends CI_Controller
{

	public function index()
	{
		if ($this->session->userdata('status') !== 'login') {
			redirect('/');
		}
		$this->load->view('laporan_penjualan');
	}

	public function cetak()
	{
		$tgl_awal = $this->input->post('tgl_awal');
		$tgl_akhir = $this->input->post('tgl_akhir');

		$this->load->model('transaksi_model', 'transaksi');
		if (empty($tgl_awal) && empty($tgl_akhir)) {
			$data['laporan_penjualan'] = $this->transaksi->readAll();
		} else {
			$data['laporan_penjualan'] = $this->transaksi->getTransaksiWithPeriode($tgl_awal, $tgl_akhir);
		}
		$tgl_awal = date('d-m-Y', strtotime($tgl_awal)); // Ubah format tanggal jadi dd-mm-yyyy
		$tgl_akhir = date('d-m-Y', strtotime($tgl_akhir)); // Ubah format tanggal jadi dd-mm-yyyy
		$label = 'Periode Tanggal ' . $tgl_awal . ' s/d ' . $tgl_akhir;
		$data['label'] = $label;
		$this->load->view('laporan_penjualan_pdf', $data);
	}
}

/* End of file Laporan_penjualan.php */
/* Location: ./application/controllers/Laporan_penjualan.php */
