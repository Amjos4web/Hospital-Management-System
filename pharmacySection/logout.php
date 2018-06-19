<?php
    session_start();
	unset($_SESSION['emaill']);
	header('location: http://localhost/buth_net/pharmacySection/index.php');
	exit();

?>