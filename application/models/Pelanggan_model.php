<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pelanggan_model extends CI_Model
{

	private $table = 'pelanggan';
	private $pengguna = 'pengguna';

	public function create($data)
	{
		return $this->db->insert($this->table, $data);
	}

	public function read()
	{
		return $this->db->get($this->table);
	}

	public function update($id, $data)
	{
		$this->db->where('id', $id);
		return $this->db->update($this->table, $data);
	}

	public function delete($id)
	{
		$this->db->where('id', $id);
		return $this->db->delete($this->table);
	}

	public function getPelanggan($id)
	{
		$this->db->where('id', $id);
		return $this->db->get($this->table);
	}

	public function search($search = "")
	{
		$this->db->like('nama', $search);
		$this->db->where('role', 3);
		return $this->db->get($this->pengguna)->result();
	}
}

/* End of file Pelanggan_model.php */
/* Location: ./application/models/Pelanggan_model.php */