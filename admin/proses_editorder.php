<?php include "header.php";?>

<?php
  include "../config.php";
  if(isset($_POST['updateorder']))
  {
    $id_order = $_POST['id_order'];
    $status = $_POST['status'];

    $id_member = $_POST['id_member'];
    $id_layanan = $_POST['id_layanan'];
    $id_produk = $_POST['id_produk'];
    $alamatorder = $_POST['alamatorder'];
    $post_day = $_POST['opt_day'];
    $post_month = $_POST['opt_month'];
    $post_year = $_POST['opt_year'];
    $post_tglorder = date("$post_year-$post_month-$post_day");
    $time = $_POST['time'];
    $catatan = $_POST['note'];
    $id_payment = $_POST['id_payment'];

    $sql = "UPDATE transaksi SET status='$status' WHERE id_order='$id_order'";
    $query = mysqli_query($conn, $sql);
    
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


  
