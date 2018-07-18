<?php
session_start();
if(isset($_SESSION['userSession']) === true)
{
	unset($_SESSION['userSession']);
	header('location:../signin.php');
}
?>
