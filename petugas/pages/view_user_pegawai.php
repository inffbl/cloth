<?php 
	// error_reporting(0);
	$pg = new KONTROLER();
	$table = "pegawai";
	$pegawai  = $pg->select("pegawai");
	// $admin    = $pg->edit($table,"level","Admin");
	$level 	  = $pg->select("level");

 	if (isset($_GET['delete'])) {
 		$id = $_GET['id'];
 		$response = $pg->delete("pegawai","id_pegawai",$id,"?page=pegawai");
 	}
 ?>

<div class="app-title">
    <div>
        <h1><i class="fa fa-cubes"></i> pegawai</h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item"><a href="#">User</a></li>
        <li class="breadcrumb-item"><a href="#">pegawai</a></li>
    </ul>
</div>
	<div class="row">	
		<div class="col-md-12">
		          <div class="tab-content">
		            <div class="tab-pane active" id="user-timeline">
		              <div class="tile">
		              	<h4 class="line-head">Semua pegawai</h4>
		              	<div class="table-responsive-sm">
		              	<table class="table table-hover table-bordered" id="ihh">
						<thead>
							<tr>
								<th>Kode pegawai</th>
								<th>Nama</th>
								<th>Username</th>
								<th>Level</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							$no = 1;
							foreach($pegawai as $pgs){ ?>
							<tr>
								<td><?php echo $pgs['id_pegawai'] ?></td>
								<td><?php echo $pgs['nama_pegawai'] ?></td>
								<td><?php echo $pgs['username'] ?></td>
								<td><?php echo $pgs['level'] ?></td>
								<td>
									<a href="?page=pegawai&delete&id=<?php echo $pgs['id_pegawai'] ?>" class="btn btn-danger">Kick</a>
								</td>
							</tr>
							<script>
								$(document).ready(function(){
									$("#btdelete<?php echo $no; ?>").click(function(e){
										e.preventDefault();
										swal({
											title: "Hapus",
								            text: "Yakin Hapus?",
								            type: "warning",
								            showCancelButton: true,
								            confirmButtonText: "Yes",
								            cancelButtonText: "Cancel",
								      		closeOnConfirm: false,
								      		closeOnCancel: true
										}, function(isConfirm) {
							            if (isConfirm) {
							            	window.location.href="?page=kelAdmin&delete&id=<?php echo $pgs['id_pegawai'] ?>";
							            }
							          });
									});
								});
							</script>
							<?php $no++; } ?>
						</tbody>
					</table>
		              </div>
		            </div>
		          </div>
		        </div>
	</div>
