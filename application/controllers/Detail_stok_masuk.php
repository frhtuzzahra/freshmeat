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

    public function cetak()
    {
        $tgl_awal = $this->input->post('tgl_awal');
        $tgl_akhir = $this->input->post('tgl_akhir');

        // header('Content-type: application/json');
        $this->load->model('detail_masuk_model', 'detail_masuk');
        if (empty($tgl_awal) || empty($tgl_akhir)) {
            $data['detail_masuk'] = $this->detail_masuk->laporan()->result();
            $data['label'] = "Data Semua Detail Stok Masuk";
        } else {
            $data['detail_masuk'] = $this->detail_masuk->getDetailMasukWithPeriode($tgl_awal, $tgl_akhir)->result();
            $tgl_awal = date('d-m-Y', strtotime($tgl_awal)); // Ubah format tanggal jadi dd-mm-yyyy
            $tgl_akhir = date('d-m-Y', strtotime($tgl_akhir)); // Ubah format tanggal jadi dd-mm-yyyy
            $label = 'Periode Tanggal ' . $tgl_awal . ' s/d ' . $tgl_akhir;
            $data['label'] = $label;
        }

        // echo json_encode($data);
        $this->load->view('cetak_detail_stok_masuk_pdf', $data);
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
                    'satuan' => $detail_stokmasuk->satuan,
                    'harga' => "Rp. " . number_format($detail_stokmasuk->harga, 0, ',', '.'),
                    'tanggal' => $detail_stokmasuk->tanggal,
                    'jumlah' => $detail_stokmasuk->jumlah,
                    'dp' => "Rp. " . number_format($detail_stokmasuk->dp, 0, ',', '.'),
                    'kekurangan' => "Rp. " . number_format($detail_stokmasuk->kekurangan, 0, ',', '.'),
                    'keterangan' => $detail_stokmasuk->keterangan,
                    'action' => '<button class="btn btn-danger btn-sm" onclick="edit(' . $detail_stokmasuk->id . ')">Lunas</button>'
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

    public function getIdDetailMasuk()
    {
        header('Content-type: application/json');
        $id = $this->input->post('id');
        $detail_masuk = $this->detail_masuk_model->getIdDetailMasuk($id);
        if ($detail_masuk->row()) {
            echo json_encode($detail_masuk->row());
        }
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

    public function edit()
    {
        $this->load->model('stok_masuk_model');
        $id = $this->input->post('id_detailmasuk');
        $id_stokmasuk = $this->input->post('id_stokmasuk');
        $data2 = array(
            'status' => "Lunas",
        );
        $data = array(
            'kekurangan' => $this->input->post('kekurangan'),
            'keterangan' => $this->input->post('keterangan')
        );
        if ($this->stok_masuk_model->update($id_stokmasuk, $data2)) {
            if ($this->detail_masuk_model->update($id, $data)) {
                echo json_encode('sukses');
            }
        }
    }

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
