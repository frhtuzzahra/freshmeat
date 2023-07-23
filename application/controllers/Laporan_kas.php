<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan_kas extends CI_Controller
{

    public function index()
    {
        if ($this->session->userdata('status') !== 'login') {
            redirect('/');
        }
        $this->load->view('laporan_kas');
    }

    public function read()
    {
        header('Content-type: application/json');
        $this->load->model('laporan_kas_model', 'laporan_kas');
        if ($this->laporan_kas->getAll()->num_rows() > 0) {
            foreach ($this->laporan_kas->getAll()->result() as $laporan_kas) {
                $data[] = array(
                    'tanggal' => date('Y-m-d H:i:s', strtotime($laporan_kas->tanggal)),
                    'total_masuk' => "Rp. " . number_format($laporan_kas->total_masuk, 0, ',', '.'),
                    'total_keluar' => "Rp. " . number_format($laporan_kas->total_keluar, 0, ',', '.')
                );
            }
        } else {
            $data = array();
        }
        $laporan_kas = array(
            'data' => $data
        );
        echo json_encode($laporan_kas);
    }

    public function cetak()
    {
        $tgl_awal = $this->input->post('tgl_awal');
        $tgl_akhir = $this->input->post('tgl_akhir');

        $this->load->model('laporan_kas_model', 'kas_model');
        if (empty($tgl_awal) || empty($tgl_akhir)) {
            $data['laporan_kas'] = $this->kas_model->getAll()->result();
            $data['label'] = "Data Semua Transaksi";
        } else {
            $data['laporan_kas'] = $this->kas_model->getTransaksiWithPeriode($tgl_awal, $tgl_akhir)->result();
            $tgl_awal = date('d-m-Y', strtotime($tgl_awal)); // Ubah format tanggal jadi dd-mm-yyyy
            $tgl_akhir = date('d-m-Y', strtotime($tgl_akhir)); // Ubah format tanggal jadi dd-mm-yyyy
            $label = 'Periode Tanggal ' . $tgl_awal . ' s/d ' . $tgl_akhir;
            $data['label'] = $label;
        }
        // var_dump($data);
        $this->load->view('cetak_laporan_kas_pdf', $data);
    }
}

/* End of file Laporan_kas.php */
/* Location: ./application/controllers/Laporan_kas.php */
