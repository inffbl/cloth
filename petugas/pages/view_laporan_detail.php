<?php
  $dt          = new KONTROLER();
  $table       = "view_detaillaporan";
  $where       = "kode_peminjaman";
  $id          = $_GET['id'];
  $hmm         = $dt->selectWhere("$table","$where",$_GET['id']);
    if ($_SESSION['level'] != "admin") {
        header("location:../../index.php");
    }
 ?>
<div class="app-title">
    <div>
        <h1><i class="fa fa-cubes"></i> Detail Laporan <?= $id ?></h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item"><a href="#">Laporan</a></li>
    </ul>
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="bs-componet">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-hover" cellpadding="10">
                          <tr>
                              <td>Kode Peminjaman</td>
                              <td>:</td>
                              <td><p><?php echo $hmm['kode_peminjaman']; ?></p></td>
                          </tr>
                          <tr>
                              <td>Pegawai</td>
                              <td>:</td>
                              <td><p><?= $hmm['nama_pegawai']; ?></p></td>
                          </tr><!-- 
                          <tr>
                              <td>Tanggal Pinjam</td>
                              <td>:</td>
                              <td><p><?= $hmm['tanggal_pinjam']; ?></p></td>
                          </tr>
                          <tr>
                              <td>Tanggal Kembali</td>
                              <td>:</td>
                              <td><p><?= $hmm['tanggal_kembali']; ?></p></td>
                          </tr> -->
                          <tr>
                              <td>Status Peminjaman</td>
                              <td>:</td>
                              <td><p><?= $hmm['status_peminjaman']; ?></p></td>
                          </tr>
                          <tr>
                              <td>Kode Barang</td>
                              <td>:</td>
                              <td><p><?= $hmm['kode_inventaris']; ?></p></td>
                          </tr>
                          <tr>
                              <td>Nama Barang</td>
                              <td>:</td>
                              <td><p><?= $hmm['nama']; ?></p></td>
                          </tr>
                          <tr>
                              <td>Kondisi</td>
                              <td>:</td>
                              <td><p><?= $hmm['kondisi']; ?></p></td>
                          </tr>
                          <tr>
                              <td>Jenis</td>
                              <td>:</td>
                              <td><p><?= $hmm['nama_jenis']; ?></p></td>
                          </tr>
                          <tr>
                              <td>Ruang</td>
                              <td>:</td>
                              <td><p><?= $hmm['nama_ruang']; ?></p></td>
                          </tr>
                          <tr>
                              <td>Jumlah</td>
                              <td>:</td>
                              <td><p><?= $hmm['jumlah']; ?></p></td>
                          </tr>
                          <tr>
                              <td>Keterangan</td>
                              <td>:</td>
                              <td><p><?= $hmm['keterang']; ?></p></td>
                          </tr>
                          <tr>
                              <td>Petugas</td>
                              <td>:</td>
                              <td><p><?= $hmm['id_petugas']; ?></p></td>
                          </tr>
                      </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
