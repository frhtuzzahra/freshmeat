<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="<?php echo site_url('') ?>" class="brand-link">
    <img src="<?= base_url('assets/images/logofreshmeatnavbar.png') ?>" class="brand-image img-circle elevation-2" style="opacity: .8" alt="Logo">
    <span class="brand-text font-weight-light"><?php echo $this->session->userdata('toko')->nama ?></span>
  </a>
  <?php $uri = $this->uri->segment(1) ?>
  <?php $role = $this->session->userdata('role'); ?>

  <!-- Sidebar -->
  <div class="sidebar">

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
        <li class="nav-item">
          <a href="<?php echo site_url('dashboard') ?>" class="nav-link <?php echo $uri == 'dashboard' || $uri == '' ? 'active' : 'no' ?>">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>
        <?php if ($role == 1 or $role == 2) : ?>
          <li class="nav-item">
            <a href="<?php echo site_url('supplier') ?>" class="nav-link <?php echo $uri == 'supplier' ? 'active' : 'no' ?>">
              <i class="nav-icon fas fa-truck"></i>
              <p>
                Supplier
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo site_url('pelanggan') ?>" class="nav-link <?php echo $uri == 'pelanggan' ? 'active' : 'no' ?>">
              <i class="nav-icon fas fa-address-book"></i>
              <p>
                Pelanggan
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview <?php echo $uri == 'produk' || $uri == 'kategori_produk' || $uri == 'satuan_produk' ? 'menu-open' : 'no' ?>">
            <a href="#" class="nav-link <?php echo $uri == 'produk' || $uri == 'kategori_produk' || $uri == 'satuan_produk' ? 'active' : 'no' ?>">
              <i class="nav-icon fas fa-box"></i>
              <p>
                Produk
              </p>
              <i class="right fas fa-angle-right"></i>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo site_url('kategori_produk') ?>" class="nav-link <?php echo $uri == 'kategori_produk' ? 'active' : 'no' ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>
                    Kategori Produk
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo site_url('satuan_produk') ?>" class="nav-link <?php echo $uri == 'satuan_produk' ? 'active' : 'no' ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>
                    Satuan Produk
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo site_url('produk') ?>" class="nav-link <?php echo $uri == 'produk' ? 'active' : 'no' ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>
                    Produk
                  </p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview <?php echo $uri == 'detail_stok_masuk' || $uri == 'stok_masuk' || $uri == 'stok_keluar' ? 'menu-open' : 'no' ?>">
            <a href="#" class="nav-link <?php echo $uri == 'detail_stok_masuk' || $uri == 'stok_masuk' || $uri == 'stok_keluar' ? 'active' : 'no' ?>">
              <i class="fas fa-archive nav-icon"></i>
              <p>Stok</p>
              <i class="right fas fa-angle-right"></i>
            </a>
            <ul class="nav-treeview">
              <li class="nav-item">
                <a href="<?php echo site_url('stok_masuk') ?>" class="nav-link <?php echo $uri == 'stok_masuk' ? 'active' : 'no' ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Stok Masuk</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo site_url('stok_keluar') ?>" class="nav-link <?php echo $uri == 'stok_keluar' ? 'active' : 'no' ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Stok Keluar</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo site_url('detail_stok_masuk') ?>" class="nav-link <?php echo $uri == 'detail_stok_masuk' ? 'active' : 'no' ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Detail Stok Masuk</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="<?php echo site_url('transaksi') ?>" class="nav-link <?php echo $uri == 'transaksi' ? 'active' : 'no' ?>">
              <i class="fas fa-money-bill nav-icon"></i>
              <p>Transaksi</p>
            </a>
          </li>
          <li class="nav-item has-treeview <?php echo $uri == 'laporan_penjualan' || $uri == 'laporan_stok_masuk' || $uri == 'laporan_stok_keluar' || $uri == 'laporan_kas' ? 'menu-open' : 'no' ?>">
            <a href="<?php echo site_url('laporan') ?>" class="nav-link <?php echo $uri == 'laporan_penjualan' || $uri == 'laporan_stok_masuk' || $uri == 'laporan_stok_keluar' || $uri == 'laporan_kas' ? 'active' : 'no' ?>">
              <i class="fas fa-book nav-icon"></i>
              <p>Laporan</p>
              <i class="right fas fa-angle-right"></i>
            </a>
            <ul class="nav-treeview">
              <li class="nav-item">
                <a href="<?php echo site_url('laporan_penjualan') ?>" class="nav-link <?php echo $uri == 'laporan_penjualan' ? 'active' : 'no' ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Laporan Penjualan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo site_url('laporan_stok_masuk') ?>" class="nav-link <?php echo $uri == 'laporan_stok_masuk' ? 'active' : 'no' ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Laporan Stok Masuk</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo site_url('laporan_stok_keluar') ?>" class="nav-link <?php echo $uri == 'laporan_stok_keluar' ? 'active' : 'no' ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Laporan Stok Keluar</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo site_url('laporan_kas') ?>" class="nav-link <?php echo $uri == 'laporan_kas' ? 'active' : 'no' ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Laporan Kas</p>
                </a>
              </li>
            </ul>
          </li>
        <?php endif ?>
        <?php if ($role == 1) : ?>
          <li class="nav-item">
            <a href="<?php echo site_url('pengaturan') ?>" class="nav-link <?php echo $uri == 'pengaturan' ? 'active' : 'no' ?>">
              <i class="fas fa-cog nav-icon"></i>
              <p>Toko</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo site_url('pengguna') ?>" class="nav-link <?php echo $uri == 'pengguna' ? 'active' : 'no' ?>">
              <i class="fas fa-user nav-icon"></i>
              <p>Pengguna</p>
            </a>
          </li>
        <?php endif ?>
        <?php if ($role == 3) : ?>
          <li class="nav-item">
            <a href="<?php echo site_url('products') ?>" class="nav-link <?php echo $uri == 'products' ? 'active' : 'no' ?>">
              <i class="nav-icon fas fa-box"></i>
              <p>
                Produk
              </p>
            </a>
          </li>
        <?php endif ?>
        <li class="nav-item has-treeview <?php echo $uri == 'booking' || $uri == 'data_booking' || $uri == 'booking_saya' ? 'menu-open' : 'no' ?>">
          <a href="<?php echo site_url('booking') ?>" class="nav-link <?php echo $uri == 'booking' || $uri == 'data_booking' || $uri == 'booking_saya' ? 'active' : 'no' ?>">
            <i class="fas fa-shopping-cart nav-icon"></i>
            <p>Booking</p>
            <i class="right fas fa-angle-right"></i>
          </a>
          <ul class="nav-treeview">
            <?php if ($role == 3) : ?>
              <li class="nav-item">
                <a href="<?php echo site_url('booking') ?>" class="nav-link <?php echo $uri == 'booking' ? 'active' : 'no' ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Tambah Booking</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo site_url('booking_saya') ?>" class="nav-link <?php echo $uri == 'booking_saya' ? 'active' : 'no' ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Booking Saya</p>
                </a>
              </li>
            <?php endif ?>
            <?php if ($role == 1 or $role == 2) : ?>
              <li class="nav-item">
                <a href="<?php echo site_url('data_booking') ?>" class="nav-link <?php echo $uri == 'data_booking' ? 'active' : 'no' ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Booking</p>
                </a>
              </li>
            <?php endif ?>
          </ul>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>
