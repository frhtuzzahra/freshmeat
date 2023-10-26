<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laporan Stok Masuk</title>
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
					<h1 class="m-2 text-dark text-center">Laporan Stok Masuk</h1>
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
                                    <th>Barcode</th>
                                    <th>Nama Produk</th>
                                    <th>Qty</th>
                                    <th>Satuan</th>
                                    <th>Harga</th>
                                    <th>Suplier</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                foreach ($stok_masuk as $sm) : ?>
                                    <?php
                                       $this->load->model('satuan_produk_model');
                                       $satuan = $this->db->where('id', $sm->satuan)->get('satuan_produk')->result();
                                    ?>
                                    <tr>
                                        <td><?= $i++ ?></td>
                                        <td><?= $sm->tanggal ?></td>
                                        <td><?= $sm->barcode ?></td>
                                        <td><?= $sm->nama_produk ?></td>
                                        <td><?= $sm->jumlah ?></td>
                                        <td><?= $satuan[0]->satuan ?></td>
                                        <td>Rp. <?= number_format($sm->harga_jual, 0, ',', '.') ?></td>
                                        <td><?= $sm->supplier ?></td>
                                        <td class="text-right">Rp. <?= number_format($sm->total, 0, ',', '.') ?></td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td>
                                        <h4>Total</h4>
                                    </td>
                                    <td colspan="9">
                                        <h4 class="text-right"> Rp. <?= number_format($sm->total_semua, 0, ',', '.') ?></h4>
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
