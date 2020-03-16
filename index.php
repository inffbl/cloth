<?php
  // require 'assets/vendor/autoload.php';
  // $whoops = new \Whoops\Run;
  // $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
  // $whoops->register();

  include "Controller.php";
  session_start();
  $iv = new KONTROLER();
  if ($iv->sessionCheck() == "true") {
    if ($_SESSION['level'] == "pegawai") {
      header("location:pegawai/dashboard.php");
    }
    if ($_SESSION['level'] == "admin") {
      header("location:petugas/admin.php?page=dashboard");
    }
    if ($_SESSION['level'] == "operator") {
      header("location:petugas/operator.php?page=dashboard");
    }
  }
  
  if (isset($_POST['pegawai'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    if ($response = $iv->loginpegawai($username,$password)) {
      if ($response['response'] == "positive") {
        $_SESSION['username']  = $_POST['username'];
        $_SESSION['level']     = $response['level'];
        if ($response['level'] == "pegawai") {
          echo '<script>window.location.href="pegawai/dashboard.php"</script>';
        }
      }
    }
  }

  if (isset($_POST['petugas'])) {
    $usernames = $_POST['usernames'];
    $passwords = $_POST['passwords'];
    if ($response = $iv->loginpetugas($usernames,$passwords)) {
      if ($response['response'] == "positive") {
        $_SESSION['username'] = $_POST['usernames'];
        $_SESSION['level']    = $response['level'];
        if ($response['level'] == "admin") {
          echo '<script>window.location.href="petugas/admin.php?page=dashboard"</script>';
        }
        if ($response['level'] == "operator") {
          echo '<script>window.location.href="petugas/operator.php?page=dashboard"</script>';
        }
      }
    }
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="assets/favicon.png">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="assets/css/main.css">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="assets/vendor/font-awesome/css/font-awesome.min.css">
    <!-- Sweet Alert -->
    <script type="text/javascript" src="assets/js/plugins/sweetalert.min.js"></script>
    <title>Inventaris | Login</title>
    <style type="text/css">
      body{
        font-family: 'Nasalization';
      }
    </style>
  </head>
  <body>
    <section class="material-half-bg">
      <div class="cover"></div>
    </section>
    <section class="login-content">
      <div class="logo">
        <h1>Login</h1>
      </div>
      <div class="login-box">
        <form class="login-form" method="post">
          <h3 class="login-head"><i class="fa fa-lg fa-fw fa-users"></i>Pegawai</h3>
          <div class="form-group">
            <label class="control-label">USERNAME</label>
            <input class="form-control" type="text" placeholder="Username" autofocus name="username">
          </div>
          <div class="form-group">
            <label class="control-label">PASSWORD</label>
            <input class="form-control" type="password" placeholder="Password" name="password">
          </div>
          <div class="form-group btn-container">
            <button class="btn btn-primary btn-block" name="pegawai"><i class="fa fa-sign-in fa-lg fa-fw"></i>SIGN IN</button><hr>
          </div>
          <div class="form-group mt-3">
            <p class="semibold-text mb-2"><a href="#" data-toggle="flip">Masuk sebagai petugas <i class="fa fa-angle-right fa-fw"></i></a></p>
          </div>
        </form>
        <form class="forget-form" method="post">
          <h3 class="login-head"><i class="fa fa-lg fa-fw fa-user"></i>Petugas</h3>
          <div class="form-group">
            <label class="control-label">USERNAME</label>
            <input class="form-control" type="text" placeholder="Username" autofocus name="usernames">
          </div>
          <div class="form-group">
            <label class="control-label">PASSWORD</label>
            <input class="form-control" type="password" placeholder="Password" name="passwords">
          </div>
          <div class="form-group btn-container">
            <button class="btn btn-primary btn-block" name="petugas"><i class="fa fa-sign-in fa-lg fa-fw"></i>SIGN IN</button><hr>
          </div>
          <div class="form-group mt-3">
            <p class="semibold-text mb-0"><a href="#" data-toggle="flip"><i class="fa fa-angle-left fa-fw"></i> Kembali sebagai Pegawai</a></p>
          </div>
        </form>
      </div>
    </section>
    <!-- Essential javascripts for application to work-->
    <script src="assets/js/jquery-3.2.1.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/main.js"></script>
    <!-- The javascript plugin to display page loading on top-->
    <script src="assets/js/plugins/pace.min.js"></script>
    <script type="text/javascript">
      // Login Page Flipbox control
      $('.login-content [data-toggle="flip"]').click(function() {
        $('.login-box').toggleClass('flipped');
        return false;
      });
    </script>
    <?php include "Alerts.php"; ?>
  </body>
</html>