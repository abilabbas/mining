<?php 
 
include("../config.php"); 

if(isset($_GET['code']) ){ 
 
    // ambil id dari query string     
    $code = $_GET['code']; 
 
    // buat query hapus     
    $sql = mysqli_query($conn,"DELETE FROM member WHERE id_member='$code'");     
 
    // apakah query hapus berhasil?     
    if( $sql ){         
    	header('Location: members.php');     
    } else {         
    	die("gagal menghapus...");     } 
 
} else {     
	die("akses dilarang..."); 
} 
 
?> 

