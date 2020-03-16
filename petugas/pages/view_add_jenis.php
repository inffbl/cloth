<?php 
	$br = new KONTROLER();
	if ($_SESSION['level'] != "admin") {
    header("location:../../index.php");
  	}
	$table = "jenis";
	$autokode = $br->autokode("jenis","kode_jenis","J");
	if (isset($_POST['save'])) {
		$kode_jenis  = $br->validateHtml($_POST['kode_jenis']);
		$nama_jenis  = $br->validateHtml($_POST['nama_jenis']);
		$ket   		 = $br->validateHtml($_POST['ket']);

		if ($kode_jenis == "" || $nama_jenis == "") {
			$response = ['response'=>'negative','alert'=>'Lengkapi Field !'];
		}elseif ($ket == "") {
			$value = "'','$nama_jenis','$kode_jenis','Tidak Ada'";
			$response = $br->insert($table,$value,"?page=jenis");
		}else{
			$value = "'','$nama_jenis','$kode_jenis','$ket'";
			$response = $br->insert($table,$value,"?page=jenis");
		}
	}
 ?>
<div class="app-title">
    <div>
        <h1><i class="fa fa-list"></i> Tambah Jenis</h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item"><a href="#">Jenis</a></li>
    </ul>
</div>
<div class="row">
	<div class="col-sm-12">
		<div class="tile">
			<form method="post" enctype="multipart/form-data">
			<div class="row">
				<div class="col-sm-12">
					<div class="form-group">
						<label for="kode_jenis">Kode Jenis</label>
						<input type="text" class="form-control" name="kode_jenis" value="<?php echo $autokode; ?>" readonly>
					</div>
					<div class="form-group">
						<label for="nama_jenis">Nama Jenis</label>
						<input type="text" class="form-control" name="nama_jenis">
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
					<a href="?page=jenis" class="btn btn-secondary"><i class="fa fa-chevron-left"></i> Kembali</a>
					<button type="reset" class="btn btn-danger"><i class="fa fa-repeat"></i> Reset</button>
					<button name="save" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
				</div>
			</div>
		</div>
		</form>
	</div>
</div>