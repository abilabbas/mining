<?php
  include "../config.php";
  if(isset($_POST['pesan']))
  {
    $id_member = $_POST['id_member'];
    $id_layanan = $_POST['id_layanan'];
    $id_produk = $_POST['id_produk'];
    $id_vehicle = $_POST['id_vehicle'];
    $alamatorder = $_POST['alamatorder'];
    $post_day = $_POST['opt_day'];
    $post_month = $_POST['opt_month'];
    $post_year = $_POST['opt_year'];
    $post_tglorder = date("$post_year-$post_month-$post_day");
    $tglorder = date("$y-$m-$d");
    $time = $_POST['time'];
    $catatan = $_POST['note'];
    $id_payment = $_POST['id_payment'];
    $status = 1;
    
    $sqltransaksi = "INSERT INTO transaksi (id_member,id_produk,alamatorder,note,id_layanan,status,dateorder,time,id_vehicle,id_payment) 
                    VALUES ('$id_member','$id_produk','$alamatorder','$catatan','$id_layanan','$status','$post_tglorder','$time','$id_vehicle','$id_payment')";
    $query = mysqli_query($conn, $sqltransaksi);
    
    if( $query ) {
    header('Location: orders.php');
    } else {
      die("Gagal menyimpan");
    }
}
else
{
  echo "data tidak ada";
}

?>