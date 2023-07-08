<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Laporan Penjualan</title>
  <link rel="stylesheet" href="<?php echo base_url('assets/vendor/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') ?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/vendor/adminlte/plugins/sweetalert2/sweetalert2.min.css') ?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/vendor/adminlte/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') ?>">
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
            <div class="col">
              <h1 class="m-0 text-dark">Laporan Penjualan</h1>
            </div><!-- /.col -->
            <div class="col">
              <!-- form filter laporan -->
              <form method="post" action="<?= base_url('laporan_penjualan/cetak') ?>">
                <div class="row">
                  <div class="col-md-3">
                    <div class="input-group">
                      <input type="date" class="form-control" name="tgl_awal">
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="input-group">
                      <input type="date" class="form-control" name="tgl_akhir">
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="input-group">
                      <button type="submit" class="btn btn-primary">Cetak</button>
                    </div>
                  </div>
                </div>
              </form>

            </div>
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="card">
            <div class="card-body">
              <table class="table w-100 table-bordered table-hover" id="laporan_penjualan">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Nama Produk</th>
                    <th>Total Bayar</th>
                    <th>Jumlah Uang</th>
                    <th>Diskon</th>
                    <th>Pelanggan</th>
                    <th>Action</th>
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
  <!-- ./wrapper -->
  <?php $this->load->view('includes/footer'); ?>
  <?php $this->load->view('partials/footer'); ?>
  <script src="<?php echo base_url('assets/vendor/adminlte/plugins/datatables/jquery.dataTables.min.js') ?>"></script>
  <script src="<?php echo base_url('assets/vendor/adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') ?>"></script>
  <script src="<?php echo base_url('assets/vendor/adminlte/plugins/sweetalert2/sweetalert2.min.js') ?>"></script>
  <script>
    var readUrl = '<?php echo site_url('transaksi/read') ?>';
    var deleteUrl = '<?php echo site_url('transaksi/delete') ?>';
  </script>
  <script src="<?php echo base_url('assets/js/laporan_penjualan.min.js') ?>"></script>
</body>

</html>