<?php 
	$br = new KONTROLER();
	if ($_SESSION['level'] != "admin") {
    header("location:../../index.php");
  	}
	$table 		= "petugas";	
	$autokode 	= $br->autokode("petugas","kode_petugas","PET");
	if (isset($_POST['getSimpan'])) {
		$kode_petugas  	= $br->validateHtml($_POST['kode_petugas']);
		$nama_petugas  	= $br->validateHtml($_POST['nama_petugas']);
		$username         	= $br->validateHtml($_POST['username']);
		$password         	= $br->validateHtml($_POST['password']);

		if ($kode_petugas == "" || $nama_petugas == "" || $username == "") {
			$response = ['response'=>'negative','alert'=>'Lengkapi Field !'];
		}else{
			if ($username < 0 || $username == 0) {
				$response = ['response'=>'negative','alert'=>'username tidak boleh kurang dari 1 !'];
			}
			else{
				$value = "'','$username','$password','$nama_petugas','',''";
				$response = $br->insert($table,$value,"?page=petugas");
			} 
		}
	}
 ?>
<div class="app-title">
    <div>
        <h1><i class="fa fa-cubes"></i> Tambah petugas</h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item"><a href="#">petugas</a></li>
    </ul>
</div>
<div class="row">
	<div class="col-sm-12">
		<form method="post" enctype="multipart/form-data">
		<div class="tile">
			<div class="row">
				<div class="col-sm-6">
					<div class="form-group">
						<label for="kode_petugas">Kode petugas</label>
						<input type="text" class="form-control" name="kode_petugas" value="<?php echo $autokode; ?>" readonly>
					</div>
					<div class="form-group">
						<label for="nama_petugas">Nama petugas</label>
						<input type="text" class="form-control" name="nama_petugas">
					</div>
				</div>

				<div class="col-sm-6">
					<div class="form-group">
						<label for="username">username</label>
						<input type="number" class="form-control" name="username">
					</div>
				</div>
			</div>
			<hr>
			<div class="row">
				<div class="col-sm-12">
					<a href="?page=petugas" class="btn btn-danger"><i class="fa fa-chevron-left"></i><center> Batal</center></a>
					<button type="reset" class="btn btn-secondary"><i class="fa fa-repeat"></i><center>Reset</center></button>
					<button type="submit" name="getSimpan" class="btn btn-primary"><i class="fa fa-save"></i><center> Simpan</center></button>
				</div>
			</div>
		</div>
		</form>
	</div>
</div>