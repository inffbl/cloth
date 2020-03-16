<?php 
  $iv = new KONTROLER();
    $Auth = $iv->AuthPetugas($_SESSION['username']);
    if (isset($_GET['logout'])) {
      $iv->logout();
    }

    if ($iv->sessionCheck() == "false") {
      header("location:../../index.php");
    }

    if ($_SESSION['level'] != "admin") {
      header("location:../../index.php");
    }

    $data = $iv->select('peminjaman');
 ?>
<div class="app-title">
    <div>
        <h1><i class="fa fa-book"></i> Laporan Peminjaman</h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item"><a href="#">Laporan</a></li>
    </ul>
</div>
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="tile">
        <a href="pages/print.php" class="btn btn-secondary"><i class="fa fa-print"></i> Print</a>
        <hr>
        <div class="table-responsive-sm">
        <table class="table table-hover table-striped tablesorter" id="ihh">
                  <thead class="text-primary">
                    <tr>
                      <th>Kode Peminjaman</th>
                      <th>Tanggal Pinjam</th>
                      <th>Tanggal Kembali</th>
                      <th>Status Pengembalian</th>
                      <th>ID Pegawai</th>
                      <th>ID Petugas</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php 

                  if (count($data) > 0) {
                  foreach($data as $in){ ?>
                    <tr>
                      <td><?= $in['kode_peminjaman'] ?></td>
                      <td><?= $in['tanggal_pinjam'] ?></td>
                      <td><?= $in['tanggal_kembali'] ?></td>
                      <td><?= $in['status_peminjaman'] ?></td>
                      <td><?= $in['id_pegawai'] ?></td>
                      <td><?= $in['id_petugas'] ?></td>
                      <td>
                          <a href="?page=detail-laporan&id=<?php echo $in['kode_peminjaman']; ?>" class="btn btn-warning"><i class="fa fa-search" style="margin: 5px auto;"></i></a>
                      </td>
                    </tr>
                    <?php }} ?>
                  </tbody>
                </table>
                </div>
      </div>
    </div>
  </div>
</div>