<?php 
	$my   = new KONTROLER();
	$auth = $my->selectWhere("petugas","username",$_SESSION['username']);

	if (isset($_POST['btnUpdate'])) {
		$username = $my->validateHtml($_POST['username']);
		$nama = $my->validateHtml($_POST['nama']);
		if ($nama == "" || $username == "") {
			$response = ['response'=>'negative','alert'=>'Lengkapi Field !'];
		}
		if ($nama != "" || $username != "") {
			$value    = "username='$username',nama_petugas='$nama'";
			$response = $my->update("petugas",$value,"username",$_SESSION['username'],"?page=profile");
		}
	}

	if (isset($_POST['ubahPassword'])) {
		$password     = $_POST['password'];
		$passwordbaru = $_POST['passwordbaru'];
		$confirm      = $_POST['confirm'];

		$sql = "SELECT username,password FROM petugas WHERE username = '$_SESSION[username]'";
		$exec = mysqli_query($con,$sql);
		$asso = mysqli_fetch_assoc($exec);
		if (mysqli_num_rows($exec) > 0) {
			if (base64_decode($asso['password']) == $password) {
				if (strlen($passwordbaru) < 6) {
				$response = ['response'=>'negative','alert'=>'Password minimal 6 digit'];
				}else{
					if ($passwordbaru == $confirm) {
						$passwordbaru = base64_encode($passwordbaru);
						$value    = "password='$passwordbaru'";
						$response = $my->update("petugas",$value,"username",$_SESSION['username'],"?page=profile");
					}else{
						$response = ['response'=>'negative','alert'=>'Password Berbeda'];
					}
				}
			}else{
				$response = ['response'=>'negative','alert'=>'Password lama tidak benar'];
			}
		}
	}
 ?>
<div class="app-title">
    <div>
        <h1><i class="fa fa-user"></i> Profile</h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item"><a href="#">Profile</a></li>
    </ul>
</div>
<div class="row">
	<div class="col-sm-6 col-md-6">
		<div class="card">
			<div class="card-body">
				<h3>Profile</h3>
				<hr>
				<form method="post">
					<div class="form-group">
						<label for="">Kode User</label>
						<input type="text" class="form-control form-control-sm" value="<?php echo $auth['id_petugas'] ?>" readonly>
					</div>
					<div class="form-group">
						<label for="">Username</label>
						<input type="text" class="form-control form-control-sm" value="<?php echo $auth['username'] ?>" name="username" readonly>
					</div>
					<div class="form-group">
						<label for="">Nama</label>
						<input type="text" class="form-control form-control-sm" value="<?php echo $auth['nama_petugas'] ?>" name="nama">
					</div>
					<hr>
					<button name="btnUpdate" class="btn btn-warning"><i class="fa fa-check"></i> Update Profile</button>
				</form>
			</div>
		</div>
	</div>
	<div class="col-sm-6 col-md-6">
		<div class="card">
			<div class="card-body">
				<form method="post">
				<h3>Ubah Password</h3>
				<hr>
				<div class="form-group">
					<label for="">Password Lama</label>
					<input type="password" class="form-control form-control-sm" name="password">
				</div>
				<div class="form-group">
					<label for="">Password Baru</label>
					<input type="password" class="form-control form-control-sm" name="passwordbaru">
				</div>
				<div class="form-group">
					<label for="">Confirm Password Baru</label>
					<input type="password" class="form-control form-control-sm" name="confirm">
				</div>
				<hr>
				<button name="ubahPassword" class="btn btn-warning"><i class="fa fa-check"></i> Update Password</button>
				</form>
			</div>
		</div>
	</div>
</div>
<hr>
<a href="?" class="btn btn-danger"><i class="fa fa-chevron-left"></i> Kembali</a>
