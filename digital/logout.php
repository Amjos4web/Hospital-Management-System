<?php
    session_start();
	unset($_SESSION['emaill']);
	header('location: index.php');
	exit();

?>