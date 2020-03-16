<?php
	$dt				 = new KONTROLER();
	$table 			 = "view_detailBarang";
	$where 			 = "kode_inventaris";
	$whereValues     = $_GET['id'];
    $detail          = $dt->selectWhere("$table","$where","$whereValues");
 //    $ugh             = $dt->selectWhere("jenis","id_jenis","echo $detail['id_jenis'];");
	// $ahh 		     = $dt->selectWhere("ruang","id_ruang","echo $detail['id_jenis'];");
    if ($_SESSION['level'] != "admin") {
        header("location:../../index.php");
    }
 ?>
<div class="app-title">
    <div>
        <h1><i class="fa fa-cubes"></i> Detail Barang</h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item"><a href="#">Barang</a></li>
    </ul>
</div>
<div class="row">
    <div class="col-sm-8">
        <div class="bs-componet">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive-sm">
                    <table class="table table-hover" cellpadding="10">
                        <tr>
                            <td>Kode Barang</td>
                            <td>:</td>
                            <td><?php echo $detail['kode_inventaris']; ?></td>
                        </tr>
                        <tr>
                            <td>Nama Barang</td>
                            <td>:</td>
                            <td><?php echo $detail['nama']; ?></td>
                        </tr>
                        <tr>
                            <td>Kondisi</td>
                            <td>:</td>
                            <td><?php echo $detail['kondisi']; ?></td>
                        </tr>
                        <tr>
                            <td>Keterangan</td>
                            <td>:</td>
                            <td><?php echo $detail['keterangan']; ?></td>
                        </tr>
                        <tr>
                            <td>Jumlah</td>
                            <td>:</td>
                            <td><?php echo $detail['jumlah']; ?></td>
                        </tr>
                        <tr>
                            <td>Jenis</td>
                            <td>:</td>
                            <td><?php echo $detail['nama_jenis']; ?></td>
                        </tr>
                        <tr>
                            <td>Ruang</td>
                            <td>:</td>
                            <td><?php echo $detail['nama_ruang']; ?></td>
                        </tr>
                        <tr>
                            <td>Tanggal Masuk</td>
                            <td>:</td>
                            <td><?php echo $detail['tanggal_register']; ?></td>
                        </tr>
                        <tr>
                            <td>Penginput Barang</td>
                            <td>:</td>
                            <td><?php echo $detail['nama_petugas'] ?></td>
                        </tr>
                    </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
	<div class="col-sm-4">
        <div class="bs-component">
            <div class="card">
                <div class="card-body">
                  <h5 class="card-title"><?php echo $detail['nama']; ?></h5>
                </div><img style="min-height: 200px; width: 100%; display: block;" src="img/" alt="Card image">
            </div>
            <br>
            <a href="?page=barang" class="btn btn-danger"><i class="fa fa-chevron-left"></i> Kembali</a>
        </div>
    </div>
</div>
