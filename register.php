<?php

require_once("config.php");

if(isset($_POST['register']))
{
	//filter data yang diinput
	$name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
	$username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
	$password = password_hash($_POST["password"], PASSWORD_DEFAULT);
	$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);

	//menyiapkan query
	$sql = "INSERT INTO users (name, username, email, password) VALUES(:name, :username, :email, :password)";
	$stmt = $db->prepare($sql);

	// bind parameter ke query

	$params = array
	(
		":name" => $name,
		":username" => $username,
		":password" => $password,
		":email" => $email
	);

	//eksekusi query untuk save ke database

	$saved = $stmt->execute($params);

	//alihkan halaman ke halaman tujuan
	if($saved) header("Location: login.php");
}

?>
<!doctype html>
<html>
<head>
<title>Pendaftaran</title>
</head>
<body>
	<form action="login.php" method="post">

		<div class="form-group">
			<label for="name">Nama Lengkap</label>
			<input class="form-control" type="text" name="username" placeholder="username" />
		</div>

		<div class="form-group">
			<label for="email">Email</label>
			<input class="form-control" type="email" name="email" placeholder="Alamat Email" />
		</div>	

		<div class="form-group">
			<label for="password">Password</label>
			<input class="form-control" type="password" name="password" placeholder="Password" />
		</div>	

		<input type="submit" class="btn btn-success btn-block" name="register" value="Daftar" />
	</form>
</body>
</html>