<?php
    session_start();
		unset($_SESSION['emaill']);
		header('location: login.php');
		exit();
?>