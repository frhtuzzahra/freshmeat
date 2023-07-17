<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail Stok Masuk</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/vendor/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/vendor/adminlte/plugins/sweetalert2/sweetalert2.min.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/vendor/adminlte/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/vendor/adminlte/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/vendor/adminlte/plugins/select2/css/select2.min.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/vendor/adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') ?>">
    <?php $this->load->view('partials/head'); ?>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <?php $this->load->view('includes/nav'); ?>

        <?php $this->load->view('includes/aside'); ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-6">
                            <h1 class="m-0 text-dark">Detail Stok Masuk</h1>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="card">
                        <div class="card-header">
                            <button class="btn btn-success" data-toggle="modal" data-target="#modal" onclick="add()">Add</button>
                        </div>
                        <div class="card-body">
                            <table class="table w-100 table-bordered table-hover" id="detail_stokmasuk">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>ID Stok Masuk</th>
                                        <th>Nama Produk</th>
                                        <th>Tanggal</th>
                                        <th>Harga Jual</th>
                                        <th>Jumlah</th>
                                        <th>DP</th>
                                        <th>Kekurangan</th>
                                        <th>Keterangan</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
    </div>

    <div class="modal fade" id="modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Data</h5>
                    <button class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form">
                        <div class="form-group">
                            <label for="id">ID Stok Masuk</label>
                            <select name="id" id="id" class="form-control select2" required></select>
                        </div>
                        <div class="form-group">
                            <label>Tanggal</label>
                            <input id="tanggal" type="text" class="form-control" placeholder="Tanggal" name="tanggal" required>
                        </div>
                        <div class="form-group">
                            <label>DP</label>
                            <input id="dp" type="text" class="form-control" placeholder="DP" name="dp" required>
                        </div>
                        <div class="form-group">
                            <label>Keterangan</label>
                            <input id="keterangan" type="text" class="form-control" placeholder="Keterangan" name="keterangan" required>
                        </div>
                        <button class="btn btn-success" type="submit">Add</button>
                        <button class="btn btn-danger" data-dismiss="modal">Close</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- ./wrapper -->
    <?php $this->load->view('includes/footer'); ?>
    <?php $this->load->view('partials/footer'); ?>
    <script src="<?php echo base_url('assets/vendor/adminlte/plugins/datatables/jquery.dataTables.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/vendor/adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/vendor/adminlte/plugins/jquery-validation/jquery.validate.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/vendor/adminlte/plugins/sweetalert2/sweetalert2.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/vendor/adminlte/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/vendor/adminlte/plugins/moment/moment.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/vendor/adminlte/plugins/select2/js/select2.min.js') ?>"></script>
    <script>
        var readUrl = '<?php echo site_url('detail_stok_masuk/read') ?>';
        var addUrl = '<?php echo site_url('detail_stok_masuk/add') ?>';
        var getIdStokMasukUrl = '<?php echo site_url('stok_masuk/get_IdStokMasuk') ?>';
        var produkGetNamaUrl = '<?php echo site_url('produk/get_namaDetail') ?>';
    </script>
    <script src="<?php echo base_url('assets/js/unminify/detail_stokmasuk.js') ?>"></script>
</body>

</html>