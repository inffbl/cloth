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

    $ruang = $iv->select('ruang');

    if (isset($_GET['delete'])) {
      $response = $iv->delete("ruang","kode_ruang",$_GET['id'],"?page=ruang");
    }
 ?>
<div class="app-title">
    <div>
        <h1><i class="fa fa-home"></i> Ruang</h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item"><a href="#">Ruang</a></li>
    </ul>
</div>
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="tile">
        <a href="?page=tambah-ruang" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Ruangan</a>
        <hr>
        <div class="table-responsive-sm">
        <table class="table table-hover table-striped tablesorter" id="ihh">
                  <thead class="text-primary">
                    <tr>
                      <th>Kode Ruang</th>
                      <th>Nama Ruang</th>
                      <th>Keterangan</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 

                    if (count($ruang) > 0) {
                      $no = 1;
                    foreach($ruang as $j){ ?>
            <tr>
              <td><?= $j['kode_ruang'] ?></td>
              <td><?= $j['nama_ruang'] ?></td>
              <td><?= $j['keterangan'] ?></td>
              <td>
                <div class="btn-group">
                  <a href="?page=edit-ruang&id=<?= $j['kode_ruang'] ?>" class="btn btn-info"><i class="fa fa-pencil" style="margin: 5px auto;"></i></a>
                  <a href="?page=ruang&delete&id=<?= $j['kode_ruang'] ?>" class="btn btn-danger"><i class="fa fa-trash" style="margin: 5px auto;color: white"></i></a>
                </div>
              </td>
            </tr>
                    <?php $no++; } ?>
                    <?php } ?>
                  </tbody>
                </table>
                </div>
      </div>
    </div>
  </div>
</div>