<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laporan Kas</title>
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
                        <h1 class="m-2 text-dark text-center">Laporan Kas</h1>
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
                                    <th>ID</th>
                                    <th>Tanggal</th>
                                    <th>Pemasukan</th>
                                    <th>Pengeluaran</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                foreach ($laporan_kas as $kas) : ?>
                                    <tr>
                                        <td><?= $i++ ?></td>
                                        <td><?= $kas->tanggal ?></td>
                                        <td class="text-right">Rp. <?= number_format($kas->total_masuk, 0, ',', '.') ?></td>
                                        <td class="text-right">Rp. <?= number_format($kas->total_keluar, 0, ',', '.') ?></td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td>
                                        <h4>Total</h4>
                                    </td>
                                    <td colspan="2">
                                        <h4 class="text-right"> Rp. <?= number_format($kas->total_kas_masuk, 0, ',', '.') ?></h4>
                                    </td>
                                    <td>
                                        <h4 class="text-right"> Rp. <?= number_format($kas->total_kas_keluar, 0, ',', '.') ?></h4>
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
        // window.print();
    </script>
</body>

</html>