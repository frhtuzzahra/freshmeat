<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengguna extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('status') !== 'login') {
			redirect('/');
		}
		$this->load->model('pengguna_model');
	}

	public function index()
	{
		$this->load->view('pengguna');
	}

	public function read()
	{
		header('Content-type: application/json');
		if ($this->pengguna_model->read()->num_rows() > 0) {
			foreach ($this->pengguna_model->read()->result() as $pengguna) {
				$data[] = array(
					'username' => $pengguna->username,
					'nama' => $pengguna->nama,
					'jenis_kelamin' => $pengguna->jenis_kelamin,
					'alamat' => $pengguna->alamat,
					'telepon' => $pengguna->telepon,
					'role' => ($pengguna->role == 2) ? 'Kasir' : 'Pelanggan',
					'action' => '<button class="btn btn-sm btn-success" onclick="edit(' . $pengguna->id . ')">Edit</button> <button class="btn btn-sm btn-danger" onclick="remove(' . $pengguna->id . ')">Delete</button>'
				);
			}
		} else {
			$data = array();
		}
		$pengguna = array(
			'data' => $data
		);
		echo json_encode($pengguna);
	}

	public function add()
	{
		$data = array(
			'username' => $this->input->post('username'),
			'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
			'nama' => $this->input->post('nama'),
			'role' => $this->input->post('role'),
			'jenis_kelamin' => $this->input->post('jenis_kelamin'),
			'alamat' => $this->input->post('alamat'),
			'telepon' => $this->input->post('telepon')
		);
		if ($this->pengguna_model->create($data)) {
			echo json_encode('sukses');
		}
	}

	public function delete()
	{
		$id = $this->input->post('id');
		if ($this->pengguna_model->delete($id)) {
			echo json_encode('sukses');
		}
	}

	public function edit()
	{
		$id = $this->input->post('id');
		$data = array(
			'username' => $this->input->post('username'),
			'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
			'nama' => $this->input->post('nama'),
			'role' => $this->input->post('role'),
			'jenis_kelamin' => $this->input->post('jenis_kelamin'),
			'alamat' => $this->input->post('alamat'),
			'telepon' => $this->input->post('telepon')
		);
		if ($this->pengguna_model->update($id, $data)) {
			echo json_encode('sukses');
		}
	}

	public function get_pengguna()
	{
		$id = $this->input->post('id');
		$pengguna = $this->pengguna_model->getPengguna($id);
		if ($pengguna->row()) {
			echo json_encode($pengguna->row());
		}
	}
}

/* End of file Pengguna.php */
/* Location: ./application/controllers/Pengguna.php */