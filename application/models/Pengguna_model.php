<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengguna_model extends CI_Model
{

	private $table = 'pengguna';

	public function create($data)
	{
		return $this->db->insert($this->table, $data);
	}

	public function read()
	{
		$this->db->where('role !=', 1);
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

	public function getPengguna($id)
	{
		$this->db->select('id, username, nama');
		$this->db->where('id', $id);
		return $this->db->get($this->table);
	}

	public function search($search = "")
	{
		$this->db->like('kategori', $search);
		return $this->db->get($this->table)->result();
	}
}

/* End of file Pengguna_model.php */
/* Location: ./application/models/Pengguna_model.php */