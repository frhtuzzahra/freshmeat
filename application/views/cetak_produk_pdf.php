<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laporan Produk</title>
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
                        <h1 class="m-2 text-dark text-center">Laporan Produk</h1>
                        <div class="my-3 text-center">
                            <h3><?= $label ?></h3>
                            <img src="<?php echo base_url('assets/images/logofreshmeatnavbar.png') ?>" alt="logo" width="80px">
                            <p>Elang Freshmeat <br> Jln. Karang Anyar, Banjarbaru</p>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table w-100 table-bordered table-hover" id="laporan_penjualan">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Barcode</th>
                                    <th>Nama Produk</th>
                                    <th>Satuan</th>
                                    <th>Kategori</th>
                                    <th>Harga Jual</th>
                                    <th>Stok</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                foreach ($produk as $p) : ?>
                                    <tr>
                                        <td><?= $i++ ?></td>
                                        <td><?= $p->barcode ?></td>
                                        <td><?= $p->nama_produk ?></td>
                                        <td><?= $p->satuan ?></td>
                                        <td><?= $p->kategori ?></td>
                                        <td>Rp. <?= number_format($p->harga_jual, 0, ',', '.') ?></td>
                                        <td><?= $p->stok ?></td>
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