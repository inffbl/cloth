<?php 
  $trans = new KONTROLER();
  
  $Auth = $trans->AuthPetugas($_SESSION['username']);
    if (isset($_GET['logout'])) {
      $trans->logout();
    }

    if ($trans->sessionCheck() == "false") {
      header("location:../../index.php");
    }

  $pegawai = $trans->selectWhereOptional("pegawai","username",$_SESSION['username'],"id_pegawai");
  $autokode   = $trans->autokode("peminjaman","kode_peminjaman","PN");


  if (isset($_POST['btnAdd'])) {
    // Input Peminjaman
    date_default_timezone_set("Asia/Jakarta");
    $kode_peminjaman  = $_POST['kode_peminjaman'];
    $tanggalp         = date("Y-m-d");
    $tanggalk         = "";
    $status_peminjaman= "Belum";
    $id_pegawai       = $pegawai['id_pegawai'];
    // Input Detail Pinjam

    if ($kode_peminjaman == "") {
      $response = ['response'=>'negative','alert'=>'Lengkapi field'];
    }else{
      $value  = "'','$kode_peminjaman', '$tanggalp', '$tanggalk', '$status_peminjaman', '$pegawai', '',''";
      $response = $trans->insert("peminjaman",$value,"?page=add_pinjam_barang&id=$kode_peminjaman");
    }
  }
 ?>
<div class="app-title">
    <div>
        <h1><i class="fa fa-cube"></i> Peminjaman dan Pengembalian Barang</h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item"><a href="#">Peminjaman</a></li>
    </ul>
</div>
<div class="container">
  <div class="row">
    <div class="col-sm-3">
      <div class="tile">
          <h5>Tambah Peminjam</h5>
        <hr>
        <form method="post">
          <div class="row">
            <div class="col-sm-12">
              <label for="">Kode Peminjaman</label>
              <input type="text" class="form-control" value="<?= $autokode; ?>" readonly name="kode_peminjaman">
            </div>
          </div>
          <br>
          <div class="row">
            <div class="col-sm-12">
              <button class="btn btn-primary btn-block" name="btnAdd"><i class="fa fa-cart-plus"></i> Pinjam Barang</button>
              <a href="?page=transaksi" class="btn btn-danger btn-block"><i class="fa fa-repeat"></i> Reset</a>
            </div>
          </div>
        </form>
      </div>
    </div>
    <div class="col-sm-9">
      <div class="tile">
        <h4>Daftar Peminjam</h4>
        <hr>
        <form method="post">
        <div class="table-responsive">
          <table class="table table-hover table-bordered" id="ihh">
            <thead>
              <tr>
                <th>Kode Peminjaman</th>
                <th>Tanggal Pinjam</th>
                <th>Status Pengembalian</th>
                <th>ID Peminjam</th>
                <th>ID Petugas</th>
              </tr>
            </thead>
            <tbody>
              <?php $oop=new KONTROLER();
              $data=$oop->selectWhereHabis("peminjaman","status_peminjaman","Belum");

              if (count($data) > 0) {
                    $no = 1;
              foreach ($data as $row) {?>
              <tr>
                <td><?= $row['kode_peminjaman'] ?></td>
                <td><?= $row['tanggal_pinjam'] ?></td>
                <td><?= $row['status_peminjaman'] ?></td>
                <td><?= $row['id_pegawai'] ?></td>
                <td><?= $row['id_petugas'] ?></td>
              </tr>
            </tbody>
                <?php $no++; } ?>
              <?php }else{ ?>
                <td colspan="8" class="text-center">Tidak ada peminjaman</td>
              <?php } ?>
            </table>
          </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row" id="input_peminjam">
    
</div>