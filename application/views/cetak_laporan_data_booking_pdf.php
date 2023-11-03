<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laporan Data Booking</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/vendor/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/vendor/adminlte/plugins/sweetalert2/sweetalert2.min.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/vendor/adminlte/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') ?>">
    <?php $this->load->view('partials/head'); ?>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Main content -->
        <section class="content">
            <div class="container">
                <div class="card mt-5">
                    <div class="card-header">
                        <h1 class="m-2 text-dark text-center">Laporan Data Booking</h1>
                        <h2 class="m-2 text-dark text-center"> <?= $label ?></h2>
                        <div class="my-3 text-center">
                            <h3 class="m-2 text-dark text-center">Elang Fresh Meat</h3>
                            <img src="<?php echo base_url('assets/images/logofreshmeatnavbar.png') ?>" alt="logo" width="80px">
                            <p>Jl. Karang Anyar 1 RT.43 RW.8 <br> Loktabat Utara Banjarbaru Utara <br>
                                (Seberang Pasar Tradisional Balitan) <br> IG : elangfarm_freshmeat | WA : 083142404000
                            </p>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table w-100 table-bordered table-hover" id="laporan_penjualan">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Tanggal</th>
                                    <th>Kode Booking</th>
                                    <th>Qty</th>
                                    <th>Total Bayar</th>
                                    <th>Pelanggan</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                foreach ($data_booking as $databooking) : ?>
                                    <?php
                                    $barcode = explode(',', $databooking->kode_barang);
                                    $qty = explode(',', $databooking->qty);
                                    
                                    ?>
                                    <tr>
                                        <td><?= $i++ ?></td>
                                        <td><?= $databooking->tanggal ?></td>
                                        <td><?= $databooking->nota ?></td>
                                        <td>
                                            <table>
                                                <tr>
                                                    <th>Product</th>
                                                    <th>Qty</th>
                                                    <th>Satuan</th>
                                                </tr>
                                                <?php $i=0; foreach ($barcode as $item) : ?>
                                                    <?php
                                                    $this->db->select('produk.id, produk.kode_barang, produk.nama_produk, produk.harga, produk.harga_jual, produk.stok, kategori_produk.id as kategori_id, kategori_produk.kategori, satuan_produk.id as satuan_id, satuan_produk.satuan');
                                                    $this->db->from('produk');
                                                    $this->db->join('kategori_produk', 'produk.kategori = kategori_produk.id');
                                                    $this->db->join('satuan_produk', 'produk.satuan = satuan_produk.id');
                                                    $this->db->where('produk.id', $item);
                                                    $produk = $this->db->get()->result();
                                                    ?>
                                                    

                                                    <tr>
                                                        <td><?= $produk[0]->nama_produk ?></td>
                                                        <td><?= $qty[$i] ?></td>
                                                        <td><?= $produk[0]->satuan ?></td>
                                                    </tr>

                                                    <?$i++?>
                                                <?php endforeach ?>
                                            </table>
                                        </td>
                                        <td class="text-right">Rp. <?= number_format($databooking->total_bayar, 0, ',', '.') ?></td>
                                        <td><?= $databooking->nama ?></td>
                                        <td><?= ($databooking->status == 'diambil') ? '<span class="badge badge-success">Diambil</span>' : '<span class="badge badge-warning">Belum</span>' ?></td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <script src="<?php echo base_url('assets/vendor/adminlte/plugins/datatables/jquery.dataTables.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/vendor/adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/vendor/adminlte/plugins/sweetalert2/sweetalert2.min.js') ?>"></script>
    <script>
        window.print();
    </script>
</body>

</html>