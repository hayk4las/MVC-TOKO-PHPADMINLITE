<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Data Transaksi</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="public/AdminLTE/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="public/AdminLTE/dist/css/adminlte.min.css">

  <style>
    /* CSS untuk memastikan sidebar penuh hingga bagian bawah layar */
    html, body {
        height: 100%;
    }
    .wrapper {
        min-height: 100vh;
        display: flex;
        flex-direction: column;
    }
    .content-wrapper {
        flex: 1;
    }
    .main-sidebar, .sidebar {
        height: 100vh;
        position: fixed;
    }
  </style>
</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="public/AdminLTE/index3.html" class="brand-link">
      <img src="public/AdminLTE/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">HAYKAL_STORE</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-header">FORM TOKO</li>
          <li class="nav-item">
            <a href="index.php?page=home" class="nav-link">
              <i class="nav-icon far fa-circle text-success"></i>
              <p class="text"<?php echo (isset($_GET['page']) && $_GET['page'] == 'home') || !isset($_GET['page']) ? 'active' : ''; ?>>Home</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="index.php?page=barang" class="nav-link">
              <i class="nav-icon far fa-circle text-danger"></i>
              <p class="text"<?php echo (isset($_GET['page']) && $_GET['page'] == 'barang') ? 'active' : ''; ?>>Barang</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="index.php?page=pelanggan" class="nav-link">
              <i class="nav-icon far fa-circle text-warning"></i>
              <p><?php echo (isset($_GET['page']) && $_GET['page'] == 'pelanggan') ? '' : ''; ?>Pelanggan</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="index.php?page=transaksi" class="nav-link">
              <i class="nav-icon far fa-circle text-info"></i>
              <p><?php echo (isset($_GET['page']) && $_GET['page'] == 'transaksi') ? '' : ''; ?>Transaksi</p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Sistem Penjualan Toko</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
    
      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title text-success font-weight-bold">Data Transaksi</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
              <i class="fas fa-times"></i>
            </button>
          </div>
        </div>

        <!-- Bagian yang telah dipindah ke atas, di bawah judul Data Barang -->
        <div class="card-body">
            <div class="container mt-3"> <!-- Mengurangi jarak agar lebih rapi -->
            <a href="index.php?page=tambah_transaksi" class="btn btn-info btn-sm bg-success font-weight-bold mb-3
            <?php echo (isset($_GET['page']) && $_GET['page'] == 'tambah_transaksi') ? 'active' : ''; ?>" >Tambahkan Transaksi</a>
            <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Id Transaksi</th>
                    <th>Id Pelanggan</th>
                    <th>Id Barang</th>
                    <th>Jumlah</th>
                    <th>Harga Total</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $nomor = 1; // Inisialisasi variabel nomor
                    if (!empty($transaksi) && is_array($transaksi)): 
                ?>
                    <?php foreach ($transaksi as $index => $item): ?>
                        <tr>
                            <th scope="row"><?php echo $nomor++; ?></th>
                            <td><?= htmlspecialchars($item['id_transaksi']); ?></td>
                            <td><?= htmlspecialchars($item['id_pelanggan']); ?></td>
                            <td><?= htmlspecialchars($item['kd_barang']); ?></td>
                            <td><?= htmlspecialchars($item['jumlah']); ?></td>
                            <td><?= htmlspecialchars($item['harga_total']); ?></td>
                            <td><?= htmlspecialchars($item['tanggal']); ?></td>
                            <td>
                                <a href="index.php?page=delete_transaksi&id_transaksi=<?= htmlspecialchars($item['id_transaksi']); ?>" 
                                class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus barang ini?');">Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="8" class="text-center font-weight-bold">Transaksi tidak tersedia.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
            </div>
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
        Pemrograman Berbasis Web II
        </div>
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
        <b>Beta Version</b> 1.0
    </div>
        <strong>Copyright &copy; 2024-2025 <a href="https://adminlte.io">Haykal Aditya Saputra 
        || 23.240.0023 || 3P41 </a>.
        </strong> All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>
</body>
</html>
