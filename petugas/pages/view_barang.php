<?php 
  $iv = new KONTROLER();
  $inven = $iv->select("view_barang");


  if ($iv->sessionCheck() == "false") {
    header("location:../../index.php");
  }
  if ($_SESSION['level'] != "admin") {
    header("location:../../index.php");
  }

  if (isset($_GET['delete'])) {
    $response = $iv->delete("inventaris","kode_inventaris",$_GET['id'],"?page=barang");
  }
 ?>
<div class="app-title">
    <div>
        <h1><i class="fa fa-cubes"></i> Barang</h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item"><a href="#">Barang</a></li>
    </ul>
</div>
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="tile">
        <a href="?page=tambah-barang" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Barang</a>
        <hr>
        <div class="table-responsive-sm">
        <table class="table table-hover table-striped tablesorter" id="ihh">
                  <thead class="text-primary">
                    <tr>
                      <th>Kode Barang</th>
                      <th>Nama Barang</th>
                      <th>Jenis</th>
                      <th>Ruang</th>
                      <th>Jumlah</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php 

                  if (count($inven) > 0) {
                    $no = 1;
                  foreach($inven as $in){ ?>
                    <tr>
                      <td><?= $in['kode_inventaris'] ?></td>
                      <td><?= $in['nama'] ?></td>
                      <td><?= $in['nama_jenis'] ?></td>
                      <td><?= $in['nama_ruang'] ?></td>
                      <td><?= $in['jumlah'] ?></td>
                      <td class="text-center">
                        <div class="btn-group">
                          <a href="?page=detail-barang&id=<?php echo $in['kode_inventaris']; ?>" class="btn btn-warning"><i class="fa fa-search" style="margin: 5px auto;"></i></a>
                          <a href="?page=edit-barang&edit&id=<?= $in['kode_inventaris'] ?>" class="btn btn-info"><i class="fa fa-pencil" style="margin: 5px auto;"></i></a>
                          <a href="?page=barang&delete&id=<?= $in['kode_inventaris'] ?>" id="btndelete<?php echo $no; ?>" class="btn btn-danger"><i class="fa fa-trash" style="margin: 5px auto;color: white"></i></a>
                        </div>
                      </td>
                    </tr>
                    <?php $no++; } ?>
                    <?php } ?>
                  </tbody>
                </table>
                </div>
      </div>
    </div>
  </div>
</div>