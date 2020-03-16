<?php 
  $trans = new KONTROLER();
  
  $Auth = $trans->AuthPetugas($_SESSION['username']);
    if (isset($_GET['logout'])) {
      $trans->logout();
    }

    if ($trans->sessionCheck() == "false") {
      header("location:../../index.php");
    }

  $id_petugas = $trans->selectWhereOptional("petugas","username",$_SESSION['username'],"id_petugas");
  $autokode   = $trans->autokode("peminjaman","kode_peminjaman","PN");
  $pegawai    = $trans->select('pegawai');

  if (isset($_POST['btnAdd'])) {
    // Input Peminjaman
    date_default_timezone_set("Asia/Jakarta");
    $kode_peminjaman  = $_POST['kode_peminjaman'];
    $tanggalp         = date("Y-m-d");
    $tanggalk         = "";
    $status_peminjaman= "Belum";
    $id_pegawai       = $_POST['id_pegawai'];
    $id_petugas2      = $id_petugas['id_petugas'];
    // Input Detail Pinjam

    if ($kode_peminjaman == "" || $id_pegawai == "" || $id_petugas == "") {
      $response = ['response'=>'negative','alert'=>'Lengkapi field'];
    }else{
      $value  = "'','$kode_peminjaman', '$tanggalp', '$tanggalk', '$status_peminjaman', '$id_pegawai', '$id_petugas2',''";
      $response = $trans->insert("peminjaman",$value,"?page=add_pinjam_barang&id=$kode_peminjaman");
    }
  }

  if (isset($_GET['balikin'])) {
    $id         = $_GET['id'];
    $tanggalkem = date("Y-m-d");
    $where      = "kode_peminjaman";

      $value      = "tanggal_kembali='$tanggalkem', status_peminjaman='Sudah'";
      $response   = $trans->update("peminjaman",$value,$where,$id,"?page=transaksi");
    
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
              <div class="form-group">
                <label for="">ID Peminjam</label>
                <select class="form-control" id="select" multiple="" name="id_pegawai">
                  <optgroup label="Pilih ID Peminjam">
                    <?php foreach($pegawai as $wai) { ?>
                    <option value="<?= $wai['id_pegawai'] ?>"><?= $wai['nama_pegawai'] ?></option>
                    <?php } ?>
                  </optgroup>
                </select>
              </div>
              <button class="btn btn-primary btn-block" name="btnAdd"><i class="fa fa-cart-plus"></i> Pinjam Barang</button>
              <a href="?page=add_pinjam" class="btn btn-danger btn-block"><i class="fa fa-repeat"></i> Reset</a>
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
                <th>Keterangan</th>
                <td>Action</td>
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
                <td><?= $row['keterang'] ?></td>
                <td class="text-center">
                  <div class="btn-group" role="group" aria-label="Jika rusak atau kehilangan, silahkan klik tanda panah di samping tombol!">
                    <a class="btn btn-danger" href="?page=transaksi&balikin&id=<?php echo $row['kode_peminjaman'] ?>">Balikin</a>
                    <div class="btn-group" role="group">
                      <button class="btn btn-danger dropdown-toggle" id="btnGroupDrop1" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
                      <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item" href="?page=pengembalian-rusak&id=<?php echo $row['kode_peminjaman'] ?>">Barang Rusak</a></div>
                    </div>
                  </div>
                </td>
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