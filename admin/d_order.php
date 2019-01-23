<?php 
 
include("../config.php"); 

if(isset($_GET['code']) ){ 
 
    // ambil id dari query string     
    $code = $_GET['code']; 
 
    // buat query hapus     
    $sql = mysqli_query($conn,"DELETE FROM transaksi WHERE id_order='$code'");     
 
    // apakah query hapus berhasil?     
    if( $sql ){         
    	header('Location: orders.php');
        $berhasil = '<div class="alert alert-success" role="alert"> Data berhasil dihapus </div>';
        echo $berhasil;     
    } else {         
    	die("gagal menghapus...");     } 
 
} else {     
	die("akses dilarang..."); 
} 
 
?> 

