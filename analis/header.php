<?php include"../config.php"; ?>
<?php include_once '../function.php'; ?>
<?php
session_start();
if(!isset($_SESSION['userSession']) === true)
{
  header('location:../signin.php');
}
?>
<?php
if(isset($_SESSION['userSession']) === true)
{ 
  $session_active = $_SESSION['userSession'];
  $sql = mysqli_query($conn, "SELECT * FROM admin WHERE email='$session_active'");
  $rows = mysqli_fetch_array($sql);
  if ($rows['status'] == "admin")
  {
  header("location:../admin/index.php");
  exit();
  }
}
?>

<!--show jumlah-->
<?php
$limit = 10;
$query = mysqli_query($conn, "SELECT * FROM member LIMIT  $limit");
$queryall = mysqli_query($conn, "SELECT * FROM member");
$jumlahmember = mysqli_num_rows($queryall);

?>

<?php
$limit = 10;
$queryorder = mysqli_query($conn, "SELECT * FROM transaksi LIMIT  $limit");
$queryorderall = mysqli_query($conn, "SELECT * FROM transaksi");
$jumlahorder = mysqli_num_rows($queryorderall);
?>

<?php
$querydoormotor2 = mysqli_query($conn, "SELECT * FROM transaksi WHERE id_layanan='2'");
$totaldoormotor = mysqli_num_rows($querydoormotor2);
$querydoormotor = mysqli_query($conn, "SELECT * FROM transaksi WHERE id_layanan='2' && status='3'");
$jumlahdoormotor = mysqli_num_rows($querydoormotor);
?>

<?php
$querydoormobil2 = mysqli_query($conn, "SELECT * FROM transaksi WHERE id_layanan='1'");
$totaldoormobil = mysqli_num_rows($querydoormobil2);
$querydoormobil = mysqli_query($conn, "SELECT * FROM transaksi WHERE id_layanan='1' && status='3'");
$jumlahdoormobil = mysqli_num_rows($querydoormobil);
?>
<!--showjumlahEnd-->

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../assets/img/favicon.png">

    <title>DoorjekAnalytic</title>

    <!-- Bootstrap core CSS -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <!--<link href="https://bootstrap-themes.github.io/dashboard/assets/css/toolkit-light.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../dashboard.css" rel="stylesheet">
  </head>

  <body>
    <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0">
      <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="index.php"><img src="../assets/img/logo.png"><small>Analytic</small></a>
      
      <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
        <!--<?php // menampilkan pesan selamat datang
            //echo "Hai, selamat datang ". $_SESSION['username'];
        ?>-->
          <a class="nav-link" href="logout.php">Logout <?php echo $_SESSION['userSession'];?></a>
          <!--<a class="nav-link" href="signin.php"> <?php //echo $_SESSION['userSession']; ?></a>-->
          
        </li>
      </ul>
    </nav>