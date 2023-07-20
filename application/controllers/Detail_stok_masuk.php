<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Detail_stok_masuk extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('status') !== 'login') {
            redirect('/');
        }
        $this->load->model('detail_masuk_model');
    }

    public function index()
    {
        $this->load->view('detail_stokmasuk');
    }

    public function lunas()
    {
        $id = $this->input->post('id');
        $data = array(
            'status' => 'Lunas'
        );
        if ($this->stok_masuk_model->update($id, $data)) {
            echo json_encode('sukses');
        }
    }

    public function read()
    {
        header('Content-type: application/json');
        if ($this->detail_masuk_model->read()->num_rows() > 0) {
            foreach ($this->detail_masuk_model->read()->result() as $detail_stokmasuk) {
                $data[] = array(
                    'id_stokmasuk' => $detail_stokmasuk->id_stokmasuk,
                    'nama_produk' => $detail_stokmasuk->nama_produk,
                    'harga_jual' => "Rp. " . number_format($detail_stokmasuk->harga_jual, 0, ',', '.'),
                    'tanggal' => $detail_stokmasuk->tanggal,
                    'jumlah' => $detail_stokmasuk->jumlah,
                    'dp' => "Rp. " . number_format($detail_stokmasuk->dp, 0, ',', '.'),
                    'kekurangan' => "Rp. " . number_format($detail_stokmasuk->kekurangan, 0, ',', '.'),
                    'keterangan' => $detail_stokmasuk->keterangan
                );
            }
        } else {
            $data = array();
        }
        $detail_stokmasuk = array(
            'data' => $data
        );
        echo json_encode($detail_stokmasuk);
    }

    public function add()
    {
        $tanggal = new DateTime($this->input->post('tanggal'));
        $data = array(
            'id_stokmasuk' => $this->input->post('id'),
            'tanggal' => $tanggal->format('Y-m-d H:i:s'),
            'dp' => $this->input->post('dp'),
            'keterangan' => $this->input->post('keterangan')
        );
        if ($this->detail_masuk_model->create($data)) {
            echo json_encode('sukses');
        }
    }

    public function update()
    {
        $id = $this->input->post('id');
        $data = array(
            'status' => "lunas",
        );
        if ($this->stok_masuk_model->update($id, $data)) {
            echo json_encode('sukses');
        }
    }

    // public function get_barcode()
    // {
    // 	$barcode = $this->input->post('barcode');
    // 	$kategori = $this->stok_masuk_model->getKategori($barcode);
    // 	if ($kategori->row()) {
    // 		echo json_encode($kategori->row());
    // 	}
    // }

    public function get_stok_masuk()
    {
        $id = $this->input->post('id');
        $stok_masuk = $this->stok_masuk_model->getStokMasuk($id);
        if ($stok_masuk->row()) {
            echo json_encode($stok_masuk->row());
        }
    }

    public function laporan()
    {
        header('Content-type: application/json');
        if ($this->stok_masuk_model->laporan()->num_rows() > 0) {
            foreach ($this->stok_masuk_model->laporan()->result() as $stok_masuk) {
                $tanggal = new DateTime($stok_masuk->tanggal);
                $data[] = array(
                    'tanggal' => $tanggal->format('d-m-Y H:i:s'),
                    'barcode' => $stok_masuk->barcode,
                    'nama_produk' => $stok_masuk->nama_produk,
                    'jumlah' => $stok_masuk->jumlah,
                    'harga_jual' => $stok_masuk->harga_jual,
                    'total' => $stok_masuk->harga_jual * $stok_masuk->jumlah,
                    'status' => $stok_masuk->status,
                    'keterangan' => $stok_masuk->keterangan,
                    'supplier' => $stok_masuk->supplier
                );
            }
        } else {
            $data = array();
        }
        $stok_masuk = array(
            'data' => $data
        );
        echo json_encode($stok_masuk);
    }
}

/* End of file Stok_masuk.php */
/* Location: ./application/controllers/Stok_masuk.php */
