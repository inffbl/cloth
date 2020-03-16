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

    $jenis = $iv->select('jenis');

    if (isset($_GET['delete'])) {
      $response = $iv->delete("jenis","kode_jenis",$_GET['id'],"?page=jenis");
    }
 ?>
<div class="app-title">
    <div>
        <h1><i class="fa fa-list"></i> Jenis</h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item"><a href="#">Jenis</a></li>
    </ul>
</div>
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="tile">
        <a href="?page=tambah-jenis" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Jenis</a>
        <hr>
        <div class="table-responsive-sm">
        <table class="table table-hover table-striped tablesorter" id="ihh">
                  <thead class="text-primary">
                    <tr>
                      <th>Kode Jenis</th>
                      <th>Nama Jenis</th>
                      <th>Keterangan</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 

                    if (count($jenis) > 0) {
                      $no = 1;
                    foreach($jenis as $j){ ?>
            <tr>
              <td><?= $j['kode_jenis'] ?></td>
              <td><?= $j['nama_jenis'] ?></td>
              <td><?= $j['keterangan'] ?></td>
              <td>
                <div class="btn-group">
                  <a href="?page=edit-jenis&id=<?= $j['kode_jenis'] ?>" class="btn btn-info"><i class="fa fa-pencil" style="margin: 5px auto;"></i></a>
                  <a href="?page=jenis&delete&id=<?= $j['kode_jenis'] ?>" class="btn btn-danger"><i class="fa fa-trash" style="margin: 5px auto;color: white"></i></a>
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