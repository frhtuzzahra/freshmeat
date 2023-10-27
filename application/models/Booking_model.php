<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Booking_model extends CI_Model
{

    private $table = 'booking';

    public function readAll()
    {
        $this->db->select("booking.tanggal, booking.nota, pengguna.nama, booking.total_bayar, booking.`status` , booking.barcode ,booking.qty");
        $this->db->from($this->table);
        $this->db->join("pengguna", "booking.pelanggan = pengguna.id");
        return $this->db->get();
    }

    public function getBookingWithPeriode($tgl_awal, $tgl_akhir)
    {
        $this->db->select("booking.tanggal, booking.nota, pengguna.nama, booking.total_bayar, booking.`status`");
        $this->db->from($this->table);
        $this->db->join("pengguna", "booking.pelanggan = pengguna.id");
        $this->db->where("booking.tanggal BETWEEN '" . $tgl_awal . "' AND '" . $tgl_akhir . "'");
        return $this->db->get();
    }

    public function removeStok($id, $stok)
    {
        $this->db->where('id', $id);
        $this->db->set('stok', $stok);
        return $this->db->update('produk');
    }

    public function addTerjual($id, $jumlah)
    {
        $this->db->where('id', $id);
        $this->db->set('terjual', $jumlah);
        return $this->db->update('produk');;
    }

    public function create($data)
    {
        return $this->db->insert($this->table, $data);
    }

    public function read()
    {
        $this->db->select('booking.id, booking.nota, booking.tanggal, booking.barcode, booking.qty, booking.total_bayar, booking.status, pengguna.nama as pelanggan,qty');
        $this->db->from($this->table);
        $this->db->join('pengguna', 'booking.pelanggan = pengguna.id', 'left outer');
        $this->db->where('booking.status', 'belum');
        return $this->db->get();
    }

    public function readByIdPelanggan($id)
    {
        $this->db->select('booking.id, booking.nota, booking.tanggal, booking.barcode, booking.qty, booking.total_bayar, booking.status, pengguna.nama as pelanggan');
        $this->db->from($this->table);
        $this->db->join('pengguna', 'booking.pelanggan = pengguna.id', 'left outer');
        $this->db->where('booking.pelanggan', $id);

        return $this->db->get();
    }

    public function delete($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete($this->table);
    }

    public function getProduk($barcode, $qty)
    {
        $total = explode(',', $qty);
        foreach ($barcode as $key => $value) {
            $this->db->select('nama_produk,barcode,id');
            $this->db->where('id', $value);
            $produk = $this->db->get('produk')->row();

            $this->db->where('id', $produk->id);
		    $satuan = $this->db->get('satuan_produk')->result();

           
            $data[] = '<tr><td>' . $produk->nama_produk . ' (Qty : ' . $total[$key] . ')</td></tr>';
        }
        return join($data);
    }

    public function getSatuan($barcode, $qty)
    {
        $total = explode(',', $qty);
        foreach ($barcode as $key => $value) {
            $this->db->select('nama_produk,barcode,id,satuan');
            $this->db->where('id', $value);
            $produk = $this->db->get('produk')->row();

            $this->db->where('id', $produk->satuan);
		    $satuan = $this->db->get('satuan_produk')->result();

           
            $data[] = '<tr><td>' . $satuan[0]->satuan . '</td></tr>';
        }
        return join($data);
    }

    public function update($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update($this->table, $data);
    }

    public function readById($id)
    {
        $this->db->select('booking.id, booking.nota, booking.tanggal, booking.barcode, booking.qty, booking.total_bayar, booking.status, pelanggan.nama as pelanggan');
        $this->db->from($this->table);
        $this->db->join('pelanggan', 'booking.pelanggan = pelanggan.id', 'left outer');
        $this->db->where('booking.id', $id);

        return $this->db->get();
    }

    public function getAll($id)
    {
        $this->db->select('booking.nota, booking.tanggal, booking.barcode, booking.qty, booking.total_bayar, booking.status');
        $this->db->from('booking');
        $this->db->where('booking.id', $id);
        return $this->db->get()->row();
    }

    public function getName($barcode)
    {
        foreach ($barcode as $b) {
            $this->db->select('nama_produk, harga_jual');
            $this->db->where('id', $b);
            $data[] = $this->db->get('produk')->row();
        }
        return $data;
    }
}

/* End of file booking_model.php */
/* Location: ./application/models/booking_model.php */
