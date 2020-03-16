<?php 
	$br = new KONTROLER();
	if ($_SESSION['level'] != "admin") {
    header("location:../../index.php");
  	}
	$table = "ruang";
	$autokode = $br->autokode("ruang","kode_ruang","R");
	if (isset($_POST['save'])) {
		$kode_ruang  = $br->validateHtml($_POST['kode_ruang']);
		$nama_ruang  = $br->validateHtml($_POST['nama_ruang']);
		$ket   		 = $br->validateHtml($_POST['ket']);

		if ($kode_ruang == "" || $nama_ruang == "") {
			$response = ['response'=>'negative','alert'=>'Lengkapi Field !'];
		}elseif ($ket == "") {
			$value = "'','$nama_ruang','$kode_ruang','Tidak Ada'";
			$response = $br->insert($table,$value,"?page=ruang");
		}else{
			$value = "'','$nama_ruang','$kode_ruang','$ket'";
			$response = $br->insert($table,$value,"?page=ruang");
		}
	}
 ?>
<div class="app-title">
    <div>
        <h1><i class="fa fa-home"></i> Tambah Ruang</h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item"><a href="#">Ruang</a></li>
    </ul>
</div>
<div class="row">
	<div class="col-sm-12">
		<div class="tile">
			<form method="post" enctype="multipart/form-data">
			<div class="row">
				<div class="col-sm-12">
					<div class="form-group">
						<label for="kode_ruang">Kode Ruang</label>
						<input type="text" class="form-control" name="kode_ruang" value="<?php echo $autokode; ?>" readonly>
					</div>
					<div class="form-group">
						<label for="nama_ruang">Nama Ruang</label>
						<input type="text" class="form-control" name="nama_ruang">
					</div>
					<div class="form-group">
						<label for="">Keterangan</label>
						<input type="text" class="form-control" name="ket">
					</div>
				</div>
			</div>
			<hr>
			<div class="row">
				<div class="col-sm-12">
					<a href="?page=ruang" class="btn btn-secondary"><i class="fa fa-chevron-left"></i> Kembali</a>
					<button type="reset" class="btn btn-danger"><i class="fa fa-repeat"></i> Reset</button>
					<button name="save" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
				</div>
			</div>
		</div>
		</form>
	</div>
</div>