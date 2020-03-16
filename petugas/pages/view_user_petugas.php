<?php 
	error_reporting(0);
	$pg = new KONTROLER();
	$table = "petugas";
	$petugas  = $pg->select("petugas");
	// $admin    = $pg->edit($table,"level","Admin");
	$level 	  = $pg->select("level");

 	if (isset($_GET['delete'])) {
 		$id = $_GET['id'];
 		$response = $pg->delete("petugas","id_petugas",$id,"?page=petugas");
 	}
 ?>

<div class="app-title">
    <div>
        <h1><i class="fa fa-cubes"></i> Petugas</h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item"><a href="#">User</a></li>
        <li class="breadcrumb-item"><a href="#">Petugas</a></li>
    </ul>
</div>
	<div class="row">	
		<div class="col-md-12">
		          <div class="tab-content">
		            <div class="tab-pane active" id="user-timeline">
		              <div class="tile">
		              	<a href="?page=tambah-petugas" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Petugas</a>
						<hr>
		              	<div class="table-responsive-sm">
		              	<table class="table table-hover table-bordered" id="ihh">
						<thead>
							<tr>
								<th>Kode Petugas</th>
								<th>Nama</th>
								<th>Username</th>
								<th>Level</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							$no = 1;
							foreach($petugas as $pgs){ ?>
							<tr>
								<td><?php echo $pgs['id_petugas'] ?></td>
								<td><?php echo $pgs['nama_petugas'] ?></td>
								<td><?php echo $pgs['username'] ?></td>
								<td><?php echo $pgs['level'] ?></td>
								<td>
									<a href="?page=petugas&delete&id=<?php echo $pgs['id_petugas'] ?>" class="btn btn-danger">Kick</a>
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
							            	window.location.href="?page=kelAdmin&delete&id=<?php echo $pgs['id_petugas'] ?>";
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
