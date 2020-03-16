<?php 
	$br = new KONTROLER();
	if ($_SESSION['level'] != "admin") {
    	header("location:../../index.php");
  	}
	$table    	= "inventaris";
	$data     	= $br->selectWhere($table,"kode_inventaris",$_GET['id']);
	$getJenis 	= $br->select("jenis");
	$getRuang 	= $br->select("ruang");
	$getPetugas	= $br->selectWhereOptional("petugas","level",$_SESSION['level'],"id_petugas");
	$waktu      = date("Y-m-d");
	if (isset($_POST['getSimpan'])) {
		$kode_inventaris  = $br->validateHtml($_POST['kode_inventaris']);
		$nama  		 	  = $br->validateHtml($_POST['nama']);
		$jenis 			  = $br->validateHtml($_POST['jenis']);
		$ruang  		  = $br->validateHtml($_POST['ruang']);
		$jumlah           = $br->validateHtml($_POST['jumlah']);
		$ket        	  = $br->validateHtml($_POST['ket']);
		$petugas          = $getPetugas['id_petugas'];

		if ($kode_inventaris == "" || $nama == "" || $nama == " " || $jenis == "" || $ruang == "" || $jumlah == "") {
			$response = ['response'=>'negative','alert'=>'Lengkapi Field !'];
		}else{
			if ($jumlah < 0 || $jumlah == 0) {
				$response = ['response'=>'negative','alert'=>'Jumlah tidak boleh kurang dari 1 !'];
			}elseif ($ket == "") {
				$value = "nama='$nama',keterangan='Tidak Ada',jumlah='$jumlah',id_jenis='$jenis',tanggal_register='$waktu',id_ruang='$ruang',kode_inventaris='$kode_inventaris',id_petugas='$petugas'";
				$response = $br->update($table,$value,"kode_inventaris",$_GET['id'],"?page=barang");
			}
			else{
				$value = "nama='$nama',keterangan='$ket',jumlah='$jumlah',id_jenis='$jenis',tanggal_register='$waktu',id_ruang='$ruang',kode_inventaris='$kode_inventaris',id_petugas='$petugas'";
				$response = $br->update($table,$value,"kode_inventaris",$_GET['id'],"?page=barang");
			} 
		}
	}
 ?>
<div class="app-title">
    <div>
        <h1><i class="fa fa-cubes"></i> Edit Barang</h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item"><a href="#">Barang</a></li>
    </ul>
</div>
<div class="row">
	<div class="col-sm-12">
		<div class="tile">
			<form method="post" enctype="multipart/form-data">
			<div class="row">
				<div class="col-sm-6">
					<div class="form-group">
						<label for="">Kode barang</label>
						<input type="text" class="form-control" name="kode_inventaris" value="<?php echo $data['kode_inventaris']; ?>" readonly>
					</div>
					<div class="form-group">
						<label for="">Nama barang</label>
						<input type="text" class="form-control" name="nama" value="<?php echo @$data['nama'] ?>">
					</div>
					<div class="form-group">
						<label for="">Jenis</label>
						<select name="jenis" class="form-control">
							<option value=" ">Pilih Jenis</option>
							<?php foreach($getJenis as $mr) { ?>
							<?php if ($mr['id_jenis'] == $data['id_jenis']){ ?>
								<option value="<?= $mr['id_jenis'] ?>" selected><?= $mr['nama_jenis'] ?></option>
							<?php }else{ ?>
							<option value="<?= $mr['id_jenis'] ?>"><?= $mr['nama_jenis'] ?></option>
							<?php } ?>
							<?php } ?>
						</select>
					</div>
					<div class="form-group">
						<label for="">Ruang</label>
						<select name="ruang" class="form-control">
							<option value=" ">Pilih ruang</option>
							<?php foreach($getRuang as $dr) { ?>
							<?php if ($dr['id_ruang'] == $data['id_ruang']){ ?>
							<option value="<?= $dr['id_ruang'] ?>" selected><?= $dr['nama_ruang'] ?></option>
							<?php }else{ ?>
							<option value="<?= $dr['id_ruang'] ?>"><?= $dr['nama_ruang'] ?></option>
							<?php } ?>
							<?php } ?>
						</select>
					</div>
				</div>

				<div class="col-sm-6">
					<div class="form-group">
						<label for="">Bumlah barang</label>
						<input type="number" class="form-control" name="jumlah" value="<?php echo $data['jumlah'] ?>">
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
					<button name="getSimpan" class="btn btn-primary"><i class="fa fa-download"></i> Update</button>
					<button type="reset" class="btn btn-danger"><i class="fa fa-repeat"></i>Reset</button>
					<a href="?page=barang" class="btn btn-secondary"><i class="fa fa-backward"></i>Back </a>
				</div>
			</div>
		</div>
		</form>
	</div>
</div>
