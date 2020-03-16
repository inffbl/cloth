<?php 
  $trans = new KONTROLER();
    $Auth = $trans->AuthPetugas($_SESSION['username']);
    if (isset($_GET['logout'])) {
      $trans->logout();
    }

    if ($trans->sessionCheck() == "false") {
      header("location:../../index.php");
    }
  
  $barangs   = $trans->select("inventaris");
  $id = $_GET['id'];
  $id_peminjaman = $trans->selectWhere("peminjaman","kode_peminjaman",$id);
  if (isset($_GET['getItem'])) {
    $kd    = $_GET['kd'];  
    $dataR = $trans->selectWhere("inventaris","kode_inventaris",$kd);
  }
  if (isset($_POST['btnAdd'])) {
    // Input Detail Pinjam
    $barang           = $_POST['kode_inventaris'];
    $barang2          = $trans->selectWhere("inventaris","kode_inventaris",$kd);
    $jumlah           = $_POST['jumlah'];

    if ($barang == "") {
      $response = ['response'=>'negative','alert'=>'Lengkapi field'];
    }elseif ($jumlah < 1) {
      $response = ['response'=>'negative','alert'=>'Pinjam masa 0!'];
    }else{
      $sisa = $trans->selectWhere("inventaris","kode_inventaris",$barang);
        if ($sisa['jumlah'] < $jumlah) {
          $response = ['response'=>'negative','alert'=>'Stok tersisa '.$sisa['jumlah']];
        }else{
          $value  = "'','$barang2[id_inventaris]', '$barang', '$jumlah', '$id_peminjaman[id_peminjaman]', 'Belum'";
          $response = $trans->insert("detail_pinjam",$value,"?page=transaksi");
        }
      }
    }
?>
<div class="app-title">
    <div>
        <h1><i class="fa fa-cube"></i> Pilih Barang</h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item"><a href="#">Peminjaman</a></li>
    </ul>
</div>
<div class="container">
<div class="col-sm-12">
    <div class="tile">
      <h4>Menu Barang</h4>
    <hr>
    <form method="post">
      <div class="row">
        <div class="col-sm-4">
          <label for="">Kode Peminjaman</label>
          <input type="text" class="form-control" value="<?= $id; ?>" readonly name="kode_peminjaman">
        </div>
        <div class="col-sm-4">
            <label for="">Kode Barang</label>
            <input type="text" class="form-control" name="kode_inventaris" readonly placeholder="Kode barang" value="<?php echo @$dataR['kode_inventaris'] ?>">
        </div>
        <div class="col-sm-4">
            <br>
            <a class="btn btn-primary btn-lg" href="#barangmodal" data-toggle="modal"><i class="fa fa-cube"></i> Pilih Barang</a>
        </div>
      </div>
      <br>
      <div class="row">
        <div class="col-sm-12">
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label for="">Nama Barang</label>
                <input type="text" class="form-control" name="nama_barang" value="<?php echo @$dataR['nama']; ?>" readonly>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label for="">Jumlah</label>
                <input type="number" class="form-control" name="jumlah" value="" min="0" autocomplete="off">
              </div>
            </div>
          </div>
          <button class="btn btn-primary btn-block" name="btnAdd"><i class="fa fa-cart-plus"></i> Pinjam Barang</button>
          <a href="?page=add_pinjam" class="btn btn-danger btn-block"><i class="fa fa-repeat"></i> Reset</a>
        </div>
      </div>
    </form>
    </div>
  </div>
</div>

<div class="modal fade model-wide" id="barangmodal">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                <h3>Pilih Barang</h3>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
              <div class="modal-body">
                <table class="table table-hover table-bordered" role="grid" id="sampleTable">
                  <thead>
                    <tr>
                      <th>Kode Barang</th>
                      <th>Nama Barang</th>
                      <th>Stok</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach($barangs as $brs){ ?>
                    <tr>
                      <td><?php echo $brs['kode_inventaris'] ?></a></td>
                      <td><?php echo $brs['nama'] ?></td>
                      <td><?php echo $brs['jumlah'] ?></td>
                      <td><a class="btn btn-success" href="admin.php?page=add_pinjam_barang&getItem&id=<?=$id?>&kd=<?php echo $brs['kode_inventaris'] ?>">Pilih</a></td>
                    </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
          </div>
      </div>
  </div>