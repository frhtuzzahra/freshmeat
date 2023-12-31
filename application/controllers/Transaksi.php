<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transaksi extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('status') !== 'login') {
			redirect('/');
		}
		$this->load->model('transaksi_model');
	}

	public function index()
	{
		$this->load->view('transaksi');
	}

	public function read()
	{
		header('Content-type: application/json');
		if ($this->transaksi_model->read()->num_rows() > 0) {
			foreach ($this->transaksi_model->read()->result() as $transaksi) {
				$barcode = explode(',', $transaksi->kode_barang);
				$tanggal = new DateTime($transaksi->tanggal);

				$data[] = array(
					'tanggal' => $tanggal->format('Y-m-d H:i:s'),
					'nama_produk' => '<table>' . $this->transaksi_model->getProduk($barcode, $transaksi->qty) . '</table>',
					"satuan" => '<table>' . $this->transaksi_model->getSatuanProduk($barcode) . '</table>',
					'total_bayar' => "Rp. " . number_format($transaksi->total_bayar, 0, ',', '.'), // number_format($number, $decimals, $dec_point, $thousands_sep
					'jumlah_uang' => "Rp. " . number_format($transaksi->jumlah_uang, 0, ',', '.'),
					'diskon' => $transaksi->diskon . "%",
					'qty' => $transaksi->qty,
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

	public function add()
	{
		$produk = json_decode($this->input->post('produk'));
		$tanggal = new DateTime($this->input->post('tanggal'));
		$barcode = array();
		foreach ($produk as $produk) {
			$this->transaksi_model->removeStok($produk->id, $produk->stok);
			$this->transaksi_model->addTerjual($produk->id, $produk->terjual);
			array_push($barcode, $produk->id);
		}

		$pelanggan_baru = $this->input->post('pelanggan_baru');

		if ($pelanggan_baru === '1') {
			$pelanggan = null;
		} else {
			$pelanggan =$this->input->post('pelanggan');
		}
		$data = array(
			'tanggal' => $tanggal->format('Y-m-d H:i:s'),
			'kode_barang' => implode(',', $barcode),
			'qty' => implode(',', $this->input->post('qty')),
			'total_bayar' => $this->input->post('total_bayar'),
			'jumlah_uang' => $this->input->post('jumlah_uang'),
			'diskon' => $this->input->post('diskon'),
			'pelanggan' => $pelanggan,
			'nota' => $this->input->post('nota'),
			'kasir' => $this->session->userdata('id')
		);
		if ($this->transaksi_model->create($data)) {
			echo json_encode($this->db->insert_id());
		}
		$data = $this->input->post('form');
	}

	public function delete()
	{
		$id = $this->input->post('id');
		if ($this->transaksi_model->delete($id)) {
			echo json_encode('sukses');
		}
	}

	public function cetak($id)
	{
		$produk = $this->transaksi_model->getAll($id);

		$tanggal = new DateTime($produk->tanggal);
		$barcode = explode(',', $produk->kode_barang);
		$qty = explode(',', $produk->qty);

		$produk->tanggal = $tanggal->format('d-m-Y H:i:s');

		$dataProduk = $this->transaksi_model->getName($barcode);
		foreach ($dataProduk as $key => $value) {
			$value->total = $qty[$key];
			$value->harga_jual;
			$value->satuan;
		}

		
		

		$data = array(
			'nota' => $produk->nota,
			'tanggal' => $produk->tanggal,
			'produk' => $dataProduk,
			'total' => $produk->total_bayar,
			'diskon' => $produk->diskon,
			'bayar' => $produk->jumlah_uang,
			'kembalian' => $produk->jumlah_uang - $produk->total_bayar,
			'kasir' => $produk->kasir,
		);
		$this->load->view('cetak_transaksi_pdf', $data);
	}

	public function penjualan_bulan()
	{
		header('Content-type: application/json');
		$day = $this->input->post('day');
		foreach ($day as $key => $value) {
			$now = date($day[$value] . ' m Y');
			if ($qty = $this->transaksi_model->penjualanBulan($now) !== []) {
				$data[] = array_sum($this->transaksi_model->penjualanBulan($now));
			} else {
				$data[] = 0;
			}
		}
		echo json_encode($data);
	}

	public function transaksi_hari()
	{
		header('Content-type: application/json');
		$now = date('d m Y');
		$total = $this->transaksi_model->transaksiHari($now);
		echo json_encode($total);
	}

	public function transaksi_hari_pelanggan()
	{
		header('Content-type: application/json');
		$now = date('d m Y');
		$id = $_SESSION['id'];
		$total = $this->transaksi_model->transaksiHariPelanggan($now, $id);
		echo json_encode($total);
	}

	public function transaksi_terakhir($value = '')
	{
		header('Content-type: application/json');
		$now = date('d m Y');
		foreach ($this->transaksi_model->transaksiTerakhir($now) as $key) {
			$total = explode(',', $key);
			$total = array_sum($total);
		}
		echo json_encode($total);
	}

	public function booking_terakhir($value = '')
	{
		header('Content-type: application/json');
		$now = date('d m Y');
		$id = $_SESSION['id'];
		foreach ($this->transaksi_model->bookingTerakhir($now, $id) as $key) {
			$total = explode(',', $key);
			$total = array_sum($total);
		}
		echo json_encode($total);
	}
}

/* End of file Transaksi.php */
/* Location: ./application/controllers/Transaksi.php */
