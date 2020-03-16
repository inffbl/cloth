<?php 
	$br = new KONTROLER();
	if ($_SESSION['level'] != "admin") {
    	header("location:../../index.php");
  	}

	$table    = "jenis";
	$data     = $br->selectWhere($table,"kode_jenis",$_GET['id']);
	if (isset($_POST['update'])) {
		$kode_jenis  = $br->validateHtml($_POST['kode_jenis']);
		$nama_jenis  = $br->validateHtml($_POST['nama_jenis']);
		$ket         = $br->validateHtml($_POST['ket']);
		if ($kode_jenis == "" || $nama_jenis == "" || $nama_jenis == " ") {
			$response = ['response'=>'negative','alert'=>'Lengkapi Field !'];
		}elseif ($ket == "") {
			$value = "nama_jenis='$nama_jenis',kode_jenis='$kode_jenis',keterangan='Tidak Ada'";
			$response = $br->update($table,$value,"kode_jenis",$_GET['id'],"?page=jenis");
		}else{
			$value = "nama_jenis='$nama_jenis',kode_jenis='$kode_jenis',keterangan='$ket'";
			$response = $br->update($table,$value,"kode_jenis",$_GET['id'],"?page=jenis");
		}
	}
 ?>
<div class="app-title">
    <div>
        <h1><i class="fa fa-list"></i> Edit Jenis</h1>
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
						<label for="">Kode Jenis</label>
						<input type="text" class="form-control" name="kode_jenis" value="<?php echo $data['kode_jenis']; ?>" readonly>
					</div>
					<div class="form-group">
						<label for="">Nama Jenis</label>
						<input type="text" class="form-control" name="nama_jenis" value="<?php echo @$data['nama_jenis'] ?>">
					</div>
					<div class="form-group">
						<label for="">Keterangan</label>
						<input type="text" class="form-control" name="ket" value="<?php echo $data['keterangan'] ?>">
					</div>
				</div>
			</div>
			<hr>
			<div class="row">
				<div class="col-sm-12">
					<a href="?page=jenis" class="btn btn-secondary"><i class="fa fa-chevron-left"></i> Kembali</a>
					<button type="reset" class="btn btn-danger"><i class="fa fa-repeat"></i> Reset</button>
					<button name="update" class="btn btn-primary"><i class="fa fa-download"></i> Update</button>
				</div>
			</div>
		</div>
		</form>
	</div>
</div>
