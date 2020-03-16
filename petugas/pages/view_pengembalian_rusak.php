<?php 
  $trans = new KONTROLER();
  
  $Auth = $trans->AuthPetugas($_SESSION['username']);
    if (isset($_GET['logout'])) {
      $trans->logout();
    }

    if ($trans->sessionCheck() == "false") {
      header("location:../../index.php");
    }
  
  $id         = $_GET['id'];
  $ketaa      = $trans->validateHtml($_POST['keterangannya']);

  if (isset($_POST['balikin'])) {

    // echo $ketaa;

      $value      = "keterang='$ketaa'";
      $response   = $trans->update("peminjaman",$value,"kode_peminjaman",$id,"?page=transaksi");
  }

 ?>
 
<div class="app-title">
    <div>
        <h1><i class="fa fa-cube"></i> Pengembalian Barang Rusak</h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item"><a href="#">Pengembalian</a></li>
    </ul>
</div>
<form method="post">
<div class="container">
  <div class="row">
    <div class="col-sm-12">
      <div class="tile">
        <h4>Pengembalian <?= $id;?></h4>
        <hr>
              
        <textarea name="keterangannya" id="keterangannya" class="form-control"></textarea>
        <br>
        <button class="btn btn-danger btn-lg" name="balikin">Balikin</a>          
      </div>
    </div>
  </div>
</div>
    
</div>
</form>