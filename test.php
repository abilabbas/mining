<?php
	include"config.php";

	$result = mysqli_query($conn,"SELECT * FROM admin");
	$cek = mysqli_num_rows($result);
	$arr = mysqli_fetch_array($result);

	echo $cek;
	if ($cek > 0) {
		echo $arr['email'];
		echo $arr['password'];
	}


	
	
?>