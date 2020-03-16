<?php 
  include '../../Controller.php';
  $iv = new KONTROLER();
  $data = $iv->select('peminjaman');
 ?>
 <script>window.print();</script>
    <link rel="stylesheet" type="text/css" href="../../assets/css/main.css">
<div class="container">
  <br><br>
  <h4 class="text-center">LAPORAN PEMINJAMAN</h4>
  <hr>
<table class="table table-hover table-striped tablesorter" id="ihh">
                  <thead class="text-primary">
                    <tr>
                      <th>Kode Peminjaman</th>
                      <th>Tanggal Pinjam</th>
                      <th>Tanggal Kembali</th>
                      <th>Status Pengembalian</th>
                      <th>ID Pegawai</th>
                      <th>ID Petugas</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php 

                  if (count($data) > 0) {
                  foreach($data as $in){ ?>
                    <tr>
                      <td><?= $in['kode_peminjaman'] ?></td>
                      <td><?= $in['tanggal_pinjam'] ?></td>
                      <td><?= $in['tanggal_kembali'] ?></td>
                      <td><?= $in['status_peminjaman'] ?></td>
                      <td><?= $in['id_pegawai'] ?></td>
                      <td><?= $in['id_petugas'] ?></td>
                    </tr>
                    <?php }} ?>
                  </tbody>
                </table>
</div>