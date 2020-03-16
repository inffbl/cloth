<?php 
	$my   = new KONTROLER();
	$auth = $my->selectWhere("table_user","username",$_SESSION['username']);

	if (isset($_POST['btnUpdate'])) {
		$nama = $my->validateHtml($_POST['nama']);
		if ($nama != "") {
			$value    = "nama_user='$nama'";
			$response = $my->update("table_user",$value,"username",$_SESSION['username'],"?page=profile");
		}
	}

	if (isset($_POST['ubahPassword'])) {
		$password     = $_POST['password'];
		$passwordbaru = $_POST['passwordbaru'];
		$confirm      = $_POST['confirm'];

		$sql = "SELECT username,password FROM table_user WHERE username = '$_SESSION[username]'";
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
						$response = $my->update("table_user",$value,"username",$_SESSION['username'],"?page=profile");
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
<a href="?" class="btn btn-danger"><i class="fa fa-repeat"></i> Kembali</a>
<hr>
<div class="row">
	<div class="col-sm-6 col-md-6">
		<div class="card">
			<div class="card-body">
				<h3>Profile</h3>
				<hr>
				<form method="post">
					<div class="form-group">
						<label for="">Kode User</label>
						<input type="text" class="form-control form-control-sm" value="<?php echo $auth['kd_user'] ?>" readonly>
					</div>
					<div class="form-group">
						<label for="">Username</label>
						<input type="text" class="form-control form-control-sm" value="<?php echo $auth['username'] ?>" readonly>
					</div>
					<div class="form-group">
						<label for="">Nama</label>
						<input type="text" class="form-control form-control-sm" value="<?php echo $auth['nama_user'] ?>" name="nama">
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