<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pelanggan extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('status') !== 'login') {
			redirect('/');
		}
		$this->load->model('pelanggan_model');
	}

	public function index()
	{
		$this->load->view('pelanggan');
	}

	public function cetak()
	{
		$this->load->model('pengguna_model');
		$data['pelanggan'] = $this->pengguna_model->readPelanggan()->result();
		$data['label'] = "Data Pelanggan";
		$this->load->view('cetak_pelanggan_pdf', $data);
	}

	public function read()
	{
		$this->load->model('pengguna_model');
		header('Content-type: application/json');
		if ($this->pengguna_model->readPelanggan()->num_rows() > 0) {
			foreach ($this->pengguna_model->readPelanggan()->result() as $pelanggan) {
				$data[] = array(
					'nama' => $pelanggan->nama,
					'jenis_kelamin' => $pelanggan->jenis_kelamin,
					'alamat' => $pelanggan->alamat,
					'telepon' => $pelanggan->telepon
				);
			}
		} else {
			$data = array();
		}
		$pelanggan = array(
			'data' => $data
		);
		echo json_encode($pelanggan);
	}

	public function add()
	{
		$data = array(
			'nama' => $this->input->post('nama'),
			'alamat' => $this->input->post('alamat'),
			'telepon' => $this->input->post('telepon'),
			'jenis_kelamin' => $this->input->post('jenis_kelamin')
		);
		if ($this->pelanggan_model->create($data)) {
			echo json_encode('sukses');
		}
	}

	public function delete()
	{
		$id = $this->input->post('id');
		if ($this->pelanggan_model->delete($id)) {
			echo json_encode('sukses');
		}
	}

	public function edit()
	{
		$id = $this->input->post('id');
		$data = array(
			'nama' => $this->input->post('nama'),
			'alamat' => $this->input->post('alamat'),
			'telepon' => $this->input->post('telepon'),
			'jenis_kelamin' => $this->input->post('jenis_kelamin')
		);
		if ($this->pelanggan_model->update($id, $data)) {
			echo json_encode('sukses');
		}
	}

	public function get_pelanggan()
	{
		$id = $this->input->post('id');
		$pelanggan = $this->pelanggan_model->getPelanggan($id);
		if ($pelanggan->row()) {
			echo json_encode($pelanggan->row());
		}
	}

	public function search()
	{
		header('Content-type: application/json');
		$pelanggan = $this->input->post('pelanggan');
		$search = $this->pelanggan_model->search($pelanggan);
		foreach ($search as $pelanggan) {
			$data[] = array(
				'id' => $pelanggan->id,
				'text' => $pelanggan->nama
			);
		}
		echo json_encode($data);
	}
}

/* End of file Pelanggan.php */
/* Location: ./application/controllers/Pelanggan.php */