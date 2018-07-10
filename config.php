<?php
<<<<<<< HEAD
/**
*Nama File : Config.php
*File ini berisi beberapa data penting seperti
*Data Koneksi ke Database
*Secret Kode
*Dll yang akan digunakan secara terus-menerus
*/

$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "mining";

try
{
	//buat koneksi PDO
	$db = new PDO("mysql:host=$db_host;db_name=$db_name", $db_user, $db_pass);
} catch(PDOException $e)
{
	//tampilan eror
	die("Terjadi masalah: " . $e->getMessage());
}
=======
$servername = "localhost";
$username = "root";
$password = "";
$dbname = 'doorjekanalytic';

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);


// Check connection
if ($conn === false) {
    die("Connection failed: " . mysqli_connect_error());
} 

?>


>>>>>>> master
