<?php 
	$br = new KONTROLER();
	if ($_SESSION['level'] != "admin") {
    	header("location:../../index.php");
  	}

	$table    = "ruang";
	$data     = $br->selectWhere($table,"kode_ruang",$_GET['id']);
	if (isset($_POST['update'])) {
		$kode_ruang  = $br->validateHtml($_POST['kode_ruang']);
		$nama_ruang  = $br->validateHtml($_POST['nama_ruang']);
		$ket         = $br->validateHtml($_POST['ket']);
		if ($kode_ruang == "" || $nama_ruang == "" || $nama_ruang == " ") {
			$response = ['response'=>'negative','alert'=>'Lengkapi Field !'];
		}elseif ($ket == "") {
			$value = "nama_ruang='$nama_ruang',kode_ruang='$kode_ruang',keterangan='Tidak Ada'";
			$response = $br->update($table,$value,"kode_ruang",$_GET['id'],"?page=ruang");
		}else{
			$value = "nama_ruang='$nama_ruang',kode_ruang='$kode_ruang',keterangan='$ket'";
			$response = $br->update($table,$value,"kode_ruang",$_GET['id'],"?page=ruang");
		}
	}
 ?>
<div class="row">
	<div class="col-sm-12">
		<div class="tile">
			<h1>Edit ruang</h1>
			<hr>
			<form method="post" enctype="multipart/form-data">
			<div class="row">
				<div class="col-sm-12">
					<div class="form-group">
						<label for="">Kode Ruang</label>
						<input type="text" class="form-control" name="kode_ruang" value="<?php echo $data['kode_ruang']; ?>" readonly>
					</div>
					<div class="form-group">
						<label for="">Nama Ruang</label>
						<input type="text" class="form-control" name="nama_ruang" value="<?php echo @$data['nama_ruang'] ?>">
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
					<a href="?page=ruang" class="btn btn-secondary"><i class="fa fa-chevron-left"></i> Kembali</a>
					<button type="reset" class="btn btn-danger"><i class="fa fa-repeat"></i> Reset</button>
					<button name="update" class="btn btn-primary"><i class="fa fa-download"></i> Update</button>
				</div>
			</div>
		</div>
		</form>
	</div>
</div>
