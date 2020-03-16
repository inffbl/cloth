<?php 
  $iv = new KONTROLER();
  $inven = $iv->selectsum("inventaris","jumlah");
  $jenis = $iv->selectcount("jenis","id_jenis");
  $ruang = $iv->selectcount("ruang","id_ruang");
  // $pinjam = $iv->selectcount("detail_pinjam","id_detail_pinjam");
  $petugas = $iv->selectcount("petugas","id_petugas");
  $pegawai = $iv->selectcount("pegawai","id_pegawai");

  if ($iv->sessionCheck() == "false") {
    header("location:../../index.php");
  }
 ?>
      <div class="app-title">
        <div>
          <h1><i class="fa fa-dashboard"></i> Dashboard</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-6 col-lg-4">
          <div class="widget-small primary coloured-icon"><i class="icon fa fa-user fa-3x"></i>
            <div class="info">
              <h4>Petugas</h4>
              <p><b><?= $petugas['count']; ?></b></p>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-4">
          <div class="widget-small info coloured-icon"><i class="icon fa fa-list fa-3x"></i>
            <div class="info">
              <h4>Jenis</h4>
              <p><b><?= $jenis['count']; ?></b></p>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-4">
          <div class="widget-small primary coloured-icon"><i class="icon fa fa-users fa-3x"></i>
            <div class="info">
              <h4>Pegawai</h4>
              <p><b><?= $pegawai['count']; ?></b></p>
            </div>
          </div>
        </div>
      </div>