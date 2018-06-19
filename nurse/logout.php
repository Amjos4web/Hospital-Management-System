<?php
    session_start();
	unset($_SESSION['emaill']);
	header('location: http://10.40.255.5/buth_net/records/index.php');
	exit();

?>