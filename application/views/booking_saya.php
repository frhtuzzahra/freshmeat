<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Booking Saya</title>
  <link rel="stylesheet" href="<?php echo base_url('assets/vendor/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') ?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/vendor/adminlte/plugins/sweetalert2/sweetalert2.min.css') ?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/vendor/adminlte/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') ?>">
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
            <div class="col">
              <h1 class="m-0 text-dark">Booking Saya</h1>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="card">
            <div class="card-body">
              <table class="table w-100 table-bordered table-hover" id="data_booking">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Kode Booking</th>
                    <th>Nama Produk</th>
                    <th>Satuan</th>
                    <th>Total</th>
                    <th>Status</th>
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
  <script src="<?php echo base_url('assets/vendor/adminlte/plugins/jquery-validation/jquery.validate.min.js') ?>"></script>
  <script src="<?php echo base_url('assets/vendor/adminlte/plugins/sweetalert2/sweetalert2.min.js') ?>"></script>
  <script src="<?php echo base_url('assets/vendor/adminlte/plugins/select2/js/select2.min.js') ?>"></script>
  <script>
    var readUrl = '<?php echo site_url('booking_saya/read') ?>';
  </script>
  <script src="<?php echo base_url('assets/js/unminify/booking_saya.js') ?>"></script>
</body>

</html>