<?php 
session_start();
ob_start();
// error display configuration
error_reporting(E_ALL & ~E_NOTICE);

if(!isset($_SESSION['emaill'])){
	header('location: adminlogin.php');
}
//This block grabs the whole list for viewing
$msg="";
$email= $_SESSION['emaill'];
include "dbconnect.php";
$sql="SELECT * FROM `admin` WHERE `admin_email`='$email' LIMIT 1";
$check = mysqli_query($dbconnect, $sql);
$resultCount=mysqli_num_rows($check); //count the out amount 
if($resultCount>0){
	while($row=mysqli_fetch_array($check)){
	$name=$row["name"];
	}
}else{
$msg="<p style='color: red; text-align: center'>You have no Information yet in the Database</p>";
}

// check the url is set and exit in the database

if (isset($_GET['studentid'])){
	$studentid = $_GET['studentid'];
	
	$newname = "$studentid.pdf";
	$file = "../schoolofMidwifery/files/localGov/$newname";
	$filename = "$studentid.pdf";
	header ('Content-type: application/pdf');
	header ('Content-Disposition:inline; filename="'.$filename.'"');
	header ('Content-Transfer-Encoding: binary');
	header ('Accept-Ranges: bytes');
	@readfile($file);
}
?>