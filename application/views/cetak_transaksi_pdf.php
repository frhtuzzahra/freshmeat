<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laporan Transaksi</title>
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
                        <h1 class="m-2 text-dark text-center">Laporan Transaksi</h1>
                        <div class="my-3 text-center">
                            <img src="<?php echo base_url('assets/images/logofreshmeatnavbar.png') ?>" alt="logo" width="80px">
                            <p>Elang Freshmeat <br> Jln. Karang Anyar, Banjarbaru</p>
                            <h4>Nota : <Strong><?= $nota ?></Strong> | Kasir : <?= $kasir ?></h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table w-100 table-bordered table-hover" id="laporan_penjualan">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Produk</th>
                                    <th>Harga</th>
                                    <th>Qty</th>
                                    <th>Diskon</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($produk as $key) : ?>

                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $key->nama_produk ?></td>
                                        <td>Rp. <?= number_format($key->harga_jual, 0, ',', '.') ?></td>
                                        <td class="text-right"><?= $key->total ?></td>
                                        <td class="text-right"><?= $diskon ?>%</td>
                                        <td class="text-right">Rp. <?= number_format($key->harga_jual * $key->total, 0, ',', '.') ?></td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td>Diskon</td>
                                    <td class="text-right" colspan="5">
                                        <h4>Rp. <?= number_format($total_diskon = $total * $diskon / 100, 0, ',', '.') ?></h4>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Total</td>
                                    <td class="text-right" colspan="5">
                                        <h4>Rp. <?= number_format($total - $total_diskon, 0, ',', '.') ?></h4>
                                    </td>
                                </tr>
                            </tfoot>
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