<?php include"../config.php"; ?>
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
  $namaOn = $rows['nama'];
  if ($rows['status'] == "analis")
  {
  header("location:../analis/index.php");
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

<?php
$querycancel = mysqli_query($conn, "SELECT * FROM transaksi WHERE status='4'");
$jumlahcancel = mysqli_num_rows($querycancel);
?>

<?php
$queryprogress = mysqli_query($conn, "SELECT * FROM transaksi WHERE status='1'");
$jumlahprogress = mysqli_num_rows($queryprogress);
?>

<?php
$querylayanan = mysqli_query($conn, "SELECT * FROM layanan");
$jumlahlayanan = mysqli_num_rows($querylayanan);
$rows = mysqli_fetch_array($querylayanan);
?>

<?php
$queryproduk = mysqli_query($conn, "SELECT * FROM produk");
$jumlahproduk = mysqli_num_rows($queryproduk);
?>

<?php
  $querytglakhir = mysqli_query($conn, "SELECT * from transaksi where id_order='$jumlahorder'");
  $qtglakhir = mysqli_fetch_array($querytglakhir);

  $querytglawal = mysqli_query($conn, "SELECT * from transaksi where id_order=1");
  $qtglawal = mysqli_fetch_array($querytglawal);
?>
<?php
    
    if ($result = $conn->query("select layanan_name from layanan", MYSQLI_USE_RESULT)) 
    {
      while ($i = $result->fetch_row()) 
      {
        $item[] = $i[0];
      }
        $result->close();
    }
  

    if ($result = $conn->query("select produk_name from produk", MYSQLI_USE_RESULT)) 
    {
      while ($i = $result->fetch_row()) 
      {
        $item[] = $i[0];
      }
        $result->close();
    }

    $item1 = count($item); 
    $item2 = count($item);

    
    
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
    <link rel="stylesheet" href="../assets/icofont/css/icofont.min.css">
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
          <a class="nav-link" href="logout.php">Logout <?php echo $namaOn;?></a>
          <!--<a class="nav-link" href="signin.php"> <?php //echo $_SESSION['userSession']; ?></a>-->
          
        </li>
      </ul>
    </nav>