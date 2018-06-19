<?php
$hostname = "localhost";
$username = "root";
$password = "";
$dbname = "buthintranet";

//Loadmore configuarion

// connection string to the database
$dbconnect = mysqli_connect($hostname, $username, $password, $dbname) or die ('error connecting to the database');
if ($dbconnect) {
	 // echo "<p style='color: green; padding-left: 0'>Connection to the database successful</p>";
}

	// $db = new mysqli($hostname, $username, $password, $dbname);
	// if($db->connect_errno){
		// die('Db error occur');
	// }
?>