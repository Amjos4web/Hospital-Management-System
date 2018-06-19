<?php 
session_start();
ob_start();
include "searchQuery.php";
// error display configuration
error_reporting(E_ALL);
ini_set('display_errors','1');

if(!isset($_SESSION['emaill'])){
	header('location: rec_staff.php');
}
//This block grabs the whole list for viewing
$msg="";
$email= $_SESSION['emaill'];
include "dbconnect2.php";
$sql="SELECT * FROM `record_staff` WHERE `rec_staff_email`='$email' LIMIT 1";
$check = mysqli_query($dbconnect, $sql);
$resultCount=mysqli_num_rows($check); //count the out amount 
if($resultCount>0){
	while($row=mysqli_fetch_array($check)){
	$id=$row["id"];
	$password=$row["rec_staff_pass"];
	$name=$row["first_name"];
	}
}else{
$msg="<p style='color: red; text-align: center'>You have no Information yet in the Database</p>";
}
?>
<!doctype html>
<html>
<link href="../pharmacySection/css/buth_net.css" rel="stylesheet" type="text/css">
<head>
<meta charset="utf-8">
<link rel="shortcut icon" href="/favicon.ico" >
<title>Patient Search Results</title>
</head>
<body>
<?php
include_once "../pharmacySection/header.php";
?>
<div id="container">
  <div id="sidebar1"><br>
	<p class="subHeader">Menu</p>
	<ul id="navigation2">
	  <li class="page_title">Records Unit</li><br>
	  <li><a href="http://localhost/buth_net/index.php">Main Page</a></li><br>
	  <li><a href="rec_new_client.php">New Patient</a></li><br>
	  <li><a href="rec_returning_patient.php">Find Patient</a></li><br>
	  <li><a href="logout.php">Logout</a></li><br>
    </ul>
	<?php include_once "../new_bar.php"; ?>
	  <!-- end .sidebar1 --></div>
	 <div class="margin" id="content">
	  <div id="personalty">
	    <ul>
		  <li id="gen"><a href="hospitalData.php?reg_id=<?php echo $reg_id; ?>">Hospital Data</a></li>
		  <li id="staff"><a href="diagnosis.php?reg_id=<?php echo $reg_id; ?>">Diagnosis</a></li>
		  <li id="sem"><a href="operation.php?reg_id=<?php echo $reg_id; ?>">Operation</a></li>
		  <li id="nhis"><a href="comments.php?reg_id=<?php echo $reg_id; ?>">Doctors' Comments</a></li>
	    </ul>
	  </div>
	  <div id="patient_form">
	  <?php echo $patient_search_results; ?>
	  <p style="margin-top: 35px"><?php echo $msg2; ?></p>
    </div><br><br>
	   <!-- end .content --></div>
	  <!-- end .container --></div>
	 <?php
	  include_once "../pharmacySection/footer.php";
	 ?>
</body>
</html>