<?php
    session_start();
	unset($_SESSION['staffid']);
	header('location: internetLogin.php');
	exit();

?>