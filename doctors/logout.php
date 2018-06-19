<?php
    session_start();
	unset($_SESSION['emaill']);
	header('location: http://localhost/buth_net/doctors/index.php');
	exit();

?>