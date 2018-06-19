<?php
    session_start();
	unset($_SESSION['emaill']);
	header('location: admin_login.php');
	exit();

?>