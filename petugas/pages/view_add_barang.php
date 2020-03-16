<?php 
	$br = new KONTROLER();
	if ($_SESSION['level'] != "admin") {
    header("location:../../index.php");
  	}
	$table 		= "inventaris";	
	$getJenis 	= $br->select("jenis");
	$getRuang 	= $br->select("ruang");
	$getPetugas	= $br->selectWhereOptional("petugas","level",$_SESSION['level'],"id_petugas");
	$autokode 	= $br->autokode("inventaris","kode_inventaris","BR");
	$waktu    	= date("Y-m-d");
	if (isset($_POST['getSimpan'])) {
		$kode_inventaris  	= $br->validateHtml($_POST['kode_inventaris']);
		$nama_inventaris  	= $br->validateHtml($_POST['nama_inventaris']);
		$jenis 				= $br->validateHtml($_POST['jenis']);
		$ruang 	  			= $br->validateHtml($_POST['ruang']);
		$jumlah         	= $br->validateHtml($_POST['jumlah']);
		$petugas         	= $getPetugas['id_petugas'];
		$ket   		  		= $br->validateHtml($_POST['ket']);

		if ($kode_inventaris == "" || $nama_inventaris == "" || $jenis == "" || $ruang == "" || $jumlah == "") {
			$response = ['response'=>'negative','alert'=>'Lengkapi Field !'];
		}else{
			if ($jumlah < 0 || $jumlah == 0) {
				$response = ['response'=>'negative','alert'=>'Jumlah tidak boleh kurang dari 1 !'];
			}elseif ($ket == "") {
				$value = "'','$nama_inventaris','Baik','Tidak Ada','$jumlah','$jenis','$waktu','$ruang','$kode_inventaris','$petugas'";
				$response = $br->insert($table,$value,"?page=barang");
			}
			else{
				$value = "'','$nama_inventaris','Baik','$ket','$jumlah','$jenis','$waktu','$ruang','$kode_inventaris','$petugas'";
				$response = $br->insert($table,$value,"?page=barang");
			} 
		}
	}
 ?>
<div class="app-title">
    <div>
        <h1><i class="fa fa-cubes"></i> Tambah Barang</h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item"><a href="#">Barang</a></li>
    </ul>
</div>
<div class="row">
	<div class="col-sm-12">
		<form method="post" enctype="multipart/form-data">
		<div class="tile">
			<div class="row">
				<div class="col-sm-6">
					<div class="form-group">
						<label for="kode_inventaris">Kode inventaris</label>
						<input type="text" class="form-control" name="kode_inventaris" value="<?php echo $autokode; ?>" readonly>
					</div>
					<div class="form-group">
						<label for="nama_inventaris">Nama Barang</label>
						<input type="text" class="form-control" name="nama_inventaris">
					</div>
					<div class="form-group">
						<label for="jenis">Jenis</label>
						<select name="jenis" class="form-control">
							<option>Pilih jenis</option>
							<?php foreach($getJenis as $mr) { ?>
							<option value="<?= $mr['id_jenis'] ?>"><?= $mr['nama_jenis'] ?></option>
							<?php } ?>
						</select>
					</div>
				</div>

				<div class="col-sm-6">
					<div class="form-group">
						<label for="ruang">Ruangan</label>
						<select name="ruang" class="form-control" id="select" multiple="false">
							<option>Pilih ruangan</option>
							<?php foreach($getRuang as $dr) { ?>
							<option value="<?= $dr['id_ruang'] ?>"><?= $dr['nama_ruang'] ?></option>
							<?php } ?>
						</select>
					</div>
					<div class="form-group">
						<label for="jumlah">Jumlah</label>
						<input type="number" class="form-control" name="jumlah">
					</div>
					<div class="form-group">
						<label for="ket">Keterangan</label>
						<input type="text" class="form-control" name="ket">
					</div>
				</div>
			</div>
			<hr>
			<div class="row">
				<div class="col-sm-12">
					<a href="?page=barang" class="btn btn-danger"><i class="fa fa-chevron-left"></i><center> Batal</center></a>
					<button type="reset" class="btn btn-secondary"><i class="fa fa-repeat"></i><center>Reset</center></button>
					<button type="submit" name="getSimpan" class="btn btn-primary"><i class="fa fa-save"></i><center> Simpan</center></button>
				</div>
			</div>
		</div>
		</form>
	</div>
</div>