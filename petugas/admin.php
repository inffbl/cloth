<?php 
  // require '../assets/vendor/autoload.php';
  // $whoops = new \Whoops\Run;
  // $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
  // $whoops->register();

  include '../Controller.php';
  $iv = new KONTROLER();
  session_start();
  $Auth = $iv->AuthPetugas($_SESSION['username']);
  $ugh = $iv->selectWhere("petugas","username",$_SESSION['username']);
  if (isset($_GET['logout'])) {
    $iv->logout();
  }

  if ($iv->sessionCheck() == "false") {
    header("location:../index.php");
  }

  if ($_SESSION['level'] != "admin") {
    header("location:../index.php");
  }
 ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="../assets/favicon.ico">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="../assets/css/main.css">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="../assets/vendor/font-awesome/css/font-awesome.min.css">
    <title>Bukan Cloth | Admin</title>
    <style type="text/css">
      body{
        font-family: 'Nasalization';
      }
    </style>
  </head>
  <body class="app sidebar-mini rtl">
    <!-- Navbar-->
    <header class="app-header"><a class="app-header__logo" href="admin.php">Bukan Cloth</a>
      <!-- Sidebar toggle button--><a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>
      <!-- Navbar Right Menu-->
      <ul class="app-nav">
        <!-- User Menu-->
        <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Open Profile Menu"><i class="fa fa-user fa-lg"></i></a>
          <ul class="dropdown-menu settings-menu dropdown-menu-right">
            <li><a class="dropdown-item" href="?page=profile"><i class="fa fa-user fa-lg"></i> Profile</a></li>
            <li><a class="dropdown-item" href="#" id="logout"><i class="fa fa-sign-out fa-lg"></i> Logout</a></li>
          </ul>
        </li>
      </ul>
    </header>
    <!-- Sidebar menu-->
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar">
      <div class="app-sidebar__user">
        <div>
          <p class="app-sidebar__user-name"><?= $ugh['nama_petugas'] ?></p>
          <p class="app-sidebar__user-designation">Administrator</p>
        </div>
      </div>
      <ul class="app-menu">
        <li><a class="app-menu__item active" href="admin.php?page=dashboard"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Dashboard</span></a></li>
        <li><a class="app-menu__item" href="?page=barang"><i class="app-menu__icon fa fa-cubes"></i><span class="app-menu__label">Barang</span></a></li>
        <li><a class="app-menu__item" href="?page=jenis"><i class="app-menu__icon fa fa-list"></i><span class="app-menu__label">Jenis</span></a></li>
        <li><a class="app-menu__item" href="?page=ruang"><i class="app-menu__icon fa fa-home"></i><span class="app-menu__label">Ruang</span></a></li>
      </ul>
    </aside>
    <main class="app-content">
      <?php
          @$page = $_GET['page'];
          switch ($page) {
            // Dashboard
            case 'dashboard':
              include "pages/view_dashboard.php";
              break;
            // Peminjaman dan Pengembalian
            case 'transaksi':
              include "pages/view_peminjaman.php";
              break;
            case 'add_peminjam':
              include "pages/view_add_peminjam.php";
              break;
            case 'add_pinjam_barang':
              include "pages/view_detail_pinjam.php";
              break;
            case 'pengembalian-rusak':
              include "pages/view_pengembalian_rusak.php";
              break;
            // Barang
            case 'barang':
              include "pages/view_barang.php";
              break;
            case 'tambah-barang':
              include "pages/view_add_barang.php";
              break;
            case 'edit-barang':
              include "pages/view_edit_barang.php";
              break;
            case 'detail-barang':
              include "pages/view_detail_barang.php";
              break;
            // Jenis
            case 'jenis':
              include "pages/view_jenis.php";
              break;
            case 'tambah-jenis':
              include "pages/view_add_jenis.php";
              break;
            case 'edit-jenis':
              include "pages/view_edit_jenis.php";
              break;
            // Ruang
            case 'ruang':
              include "pages/view_ruang.php";
              break;
            case 'tambah-ruang':
              include "pages/view_add_ruang.php";
              break;
            case 'edit-ruang':
               include "pages/view_edit_ruang.php";
              break;
            // Laporan
            case 'laporan':
              include "pages/view_laporan.php";
              break;
            case 'detail-laporan':
              include "pages/view_laporan_detail.php";
              break;
            case 'laporan-barang-habis':
              include "pages/view_laporan_habis.php";
              break;
            case 'laporan-maintenance':
              include "pages/view_laporan_maintenance.php";
              break;
            // Daftar User
            case 'petugas':
              include "pages/view_user_petugas.php";
              break;
            case 'tambah-petugas':
              include "pages/view_add_petugas.php";
              break;
            case 'pegawai':
              include "pages/view_user_pegawai.php";
              break;
            // Profile
            case 'profile':
              include "pages/view_profile.php";
              break;
            default:
              include "pages/view_error.php";
              break;
          }
      ?>
    </main>
    <!-- Essential javascripts for application to work-->
    <script src="../assets/js/jquery-3.2.1.min.js"></script>
    <script src="../assets/js/popper.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="../assets/js/main.js"></script>
    <!-- The javascript plugin to display page loading on top-->
    <script src="../assets/js/plugins/pace.min.js"></script>
    <!-- DataTables -->
    <script type="text/javascript" src="../assets/js/plugins/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="../assets/js/plugins/dataTables.bootstrap.min.js"></script>
    <!-- Page specific javascripts-->
    <script type="text/javascript" src="../assets/js/plugins/chart.js"></script>
    <script type="text/javascript" src="../assets/js/plugins/select2.min.js"></script>
    <!-- Sweet Alert -->
    <script type="text/javascript" src="../assets/js/plugins/sweetalert.min.js"></script>
    <script type="text/javascript">
      var data = {
      	labels: ["January", "February", "March", "April", "May"],
      	datasets: [
      		{
      			label: "My First dataset",
      			fillColor: "rgba(220,220,220,0.2)",
      			strokeColor: "rgba(220,220,220,1)",
      			pointColor: "rgba(220,220,220,1)",
      			pointStrokeColor: "#fff",
      			pointHighlightFill: "#fff",
      			pointHighlightStroke: "rgba(220,220,220,1)",
      			data: [65, 59, 80, 81, 56]
      		},
      		{
      			label: "My Second dataset",
      			fillColor: "rgba(151,187,205,0.2)",
      			strokeColor: "rgba(151,187,205,1)",
      			pointColor: "rgba(151,187,205,1)",
      			pointStrokeColor: "#fff",
      			pointHighlightFill: "#fff",
      			pointHighlightStroke: "rgba(151,187,205,1)",
      			data: [28, 48, 40, 19, 86]
      		}
      	]
      };
      var pdata = [
      	{
      		value: 300,
      		color: "#46BFBD",
      		highlight: "#5AD3D1",
      		label: "Complete"
      	},
      	{
      		value: 50,
      		color:"#F7464A",
      		highlight: "#FF5A5E",
      		label: "In-Progress"
      	}
      ]
      
      var ctxl = $("#lineChartDemo").get(0).getContext("2d");
      var lineChart = new Chart(ctxl).Line(data);
      
      var ctxp = $("#pieChartDemo").get(0).getContext("2d");
      var pieChart = new Chart(ctxp).Pie(pdata);
    </script>
    <!-- Google analytics script-->
    <script type="text/javascript">
      if(document.location.hostname == 'pratikborsadiya.in') {
      	(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      	(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      	m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      	})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
      	ga('create', 'UA-72504830-1', 'auto');
      	ga('send', 'pageview');
      }
    </script>
    <?php include "../Alerts.php"; ?>
    <script>
      $(document).ready(function(){
        $('#logout').click(function(e){
          e.preventDefault();
            swal({
            title: "Logout",
            text: "Yakin Logout?",
            type: "info",
            showCancelButton: true,
            confirmButtonText: "Yes",
            cancelButtonText: "No",
            closeOnConfirm: false,
            closeOnCancel: true
          }, function(isConfirm) {
            if (isConfirm) {
              window.location.href="?logout";
            }
          });
        });
        $('#ihh').DataTable();

      });
      $('#select').select2();
    </script>
  </body>
</html>