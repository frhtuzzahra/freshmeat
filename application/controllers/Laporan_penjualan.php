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

	public function read()
	{
		$this->load->model('transaksi_model');
		header('Content-type: application/json');
		if ($this->transaksi_model->read()->num_rows() > 0) {
			foreach ($this->transaksi_model->read()->result() as $transaksi) {
				$barcode = explode(',', $transaksi->kode_barang);
				$tanggal = new DateTime($transaksi->tanggal);
				$data[] = array(
					'tanggal' => $tanggal->format('Y-m-d H:i:s'),
					'nama_produk' => '<table>' . $this->transaksi_model->getProduk($barcode, $transaksi->qty) . '</table>',
					'total_bayar' => "Rp. " . number_format($transaksi->total_bayar, 0, ',', '.'), // number_format($number, $decimals, $dec_point, $thousands_sep
					'jumlah_uang' => "Rp. " . number_format($transaksi->jumlah_uang, 0, ',', '.'),
					'diskon' => $transaksi->diskon . "%",
					'pelanggan' => $transaksi->pelanggan,
					'action' => '<a class="btn btn-sm btn-success" href="' . site_url('transaksi/cetak/') . $transaksi->id . '" target="_blank">Print</a> <button class="btn btn-sm btn-danger" onclick="remove(' . $transaksi->id . ')">Delete</button>'
				);
			}
		} else {
			$data = array();
		}
		$transaksi = array(
			'data' => $data
		);
		echo json_encode($transaksi);
	}

	public function cetak()
	{
		$tgl_awal = $this->input->post('tgl_awal');
		$tgl_akhir = $this->input->post('tgl_akhir');

		$this->load->model('transaksi_model', 'transaksi');
		if (empty($tgl_awal) || empty($tgl_akhir)) {
			$data['laporan_penjualan'] = $this->transaksi->readAll()->result();
			$data['label'] = "Data Semua Transaksi";
		} else {
			$data['laporan_penjualan'] = $this->transaksi->getTransaksiWithPeriode($tgl_awal, $tgl_akhir)->result();
			$tgl_awal = date('d-m-Y', strtotime($tgl_awal)); // Ubah format tanggal jadi dd-mm-yyyy
			$tgl_akhir = date('d-m-Y', strtotime($tgl_akhir)); // Ubah format tanggal jadi dd-mm-yyyy
			$label = 'Periode Tanggal ' . $tgl_awal . ' s/d ' . $tgl_akhir;
			$data['label'] = $label;
		}

		$this->load->view('cetak_laporan_penjualan_pdf', $data);
	}
}

/* End of file Laporan_penjualan.php */
/* Location: ./application/controllers/Laporan_penjualan.php */
