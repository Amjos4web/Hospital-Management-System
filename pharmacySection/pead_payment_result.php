<?php 
session_start();
ob_start();
// error display configuration
error_reporting(E_ALL & ~E_NOTICE);

if(!isset($_SESSION['emaill'])){
	header('location: pead_pharm_login.php');
}
//This block grabs the whole list for viewing
$msg="";
$email= $_SESSION['emaill'];
include "dbconnect2.php";
$sql="SELECT * FROM `pead_pharm` WHERE `pead_email`='$email' LIMIT 1";
$check = mysqli_query($dbconnect, $sql);
$resultCount=mysqli_num_rows($check); //count the out amount 
if($resultCount>0){
	while($row=mysqli_fetch_array($check)){
	$id=$row["id"];
	$name=$row["pead_name"];
	}
}else{
$msg="<p style='color: red; text-align: center'>You have no Information yet in the Database</p>";
}
// check for payment verification

$patient_search_results = "";
$msg2 = "";
// see if the posted search query field is set and has a value
if (isset($_GET['searchbtn2'])){
	if (isset($_GET['search2']) && $_GET['search2'] != ""){
		// filter the inputs
		$search = $_GET['search2'];
		$search = preg_replace("#[^a-z 0-9?!.]#i", "", $_GET['search2']);
		
		$sqlcommand2 = "SELECT `hospital_no`, `patient_name`, `pay_date`,`total_amount`, `payment_status`, `total_amount2` AS patient FROM `transactions` WHERE `hospital_no` LIKE '%$search%' LIMIT 1";
		$query = mysqli_query($dbconnect, $sqlcommand2) or die (mysqli_error($dbconnect));
		$count = mysqli_num_rows($query);
		if ($count > 0){
			while($row2=mysqli_fetch_array($query)){
				$patient_name=$row2["patient_name"];
				$hospital_no=$row2["hospital_no"];
				$payment_date=$row2["pay_date"];
				$payment_status=$row2["payment_status"];
				
				
				
				$patient_search_results .= "<h2 style='margin-left: 0px; margin-top: 35px; font-family: Calibri (Body); font-size: 22px; font-weight: bold; text-transform: uppercase; font-style: normal; color: #880000; text-shadow: 0 1px 0 #ccc,0 2px 0 #c9c9c9,0 3px 0 #bbb,0 4px 0 #b9b9b9,0 5px 0 #aaa,0 6px 1px rgba(0,0,0,.1),0 0 5px rgba(0,0,0,.1),0 1px 3px rgba(0,0,0,.3),0 3px 5px rgba(0,0,0,.2),0 5px 10px rgba(0,0,0,.25),0 10px 10px rgba(0,0,0,.2),0 20px 20px rgba(0,0,0,.15)'>Payment Verification  Information</h2>";
				$patient_search_results .= '<table width="600px" style="margin-left: auto; margin-right: auto" cellpadding="10" cellspacing="0" border="0">';
				$patient_search_results .= "<tr>";
				$patient_search_results .= "<td style='background-color:#C5DFFA; width: 50%; font-family: Adobe Heiti Std R; padding-left: 20px; font-size: 18px'><b>Hospital Number</b></td>";
				$patient_search_results .= "<td style='background-color:#C5DFFA; width: 50%; font-family: Adobe Heiti Std R; padding-left: 20px; font-size: 18px'><b>".$hospital_no."</b></td>";
				$patient_search_results .= "</tr>";
				$patient_search_results .= "<tr>";
				$patient_search_results .= "<td style='background-color:#C5DFFA; width: 50%; font-family: Adobe Heiti Std R; padding-left: 20px;  font-size: 18px'><b>Name</b></td>";
				$patient_search_results .= "<td style='background-color:#C5DFFA; width: 50%; font-family: Adobe Heiti Std R; padding-left: 20px; font-size: 18px'><b>".$patient_name."</b></td>";
				$patient_search_results .= "</tr>";
				$patient_search_results .= "<tr>";
				$patient_search_results .= "<td style='background-color:#C5DFFA; width: 50%; font-family: Adobe Heiti Std R; padding-left: 20px;  font-size: 18px'><b>Payment Date</b></td>";
				$patient_search_results .= "<td style='background-color:#C5DFFA; width: 50%; font-family: Adobe Heiti Std R; padding-left: 20px; font-size: 18px'><b>".$payment_date."</b></td>";
				$patient_search_results .= "</tr>";
				$patient_search_results .= "<tr>";
				$patient_search_results .= "<td style='background-color:#C5DFFA; width: 50%; font-family: Adobe Heiti Std R; padding-left: 20px; font-size: 18px'><b>Payment Status</b></td>";
				$patient_search_results .= "<td style='background-color:#C5DFFA; width: 50%; font-family: Adobe Heiti Std R; padding-left: 20px; font-size: 18px'><b>".$payment_status."</b></td>";
				$patient_search_results .= "</tr>";
				$patient_search_results .= "</table>";
	
			} // close the while loop
		} else {
			$msg2 .= "<p style='color: #880000; font-size: 18px; margin-left: 5px'>No result found for <b>$search</b></p>";
			$msg2 .= '<center><label><a href="pead_payment_verification.php" style="font-size: 24px; font-family: impact; font-style: normal">Back</a></label></center>';
	}
} else {
	$msg2 .= "<p style='color: #880000; font-size: 18px; margin-left: 5px'>No result found for <b>empty search</b></p>";
	$msg2 .= '<center><label><a href="pead_payment_verification.php" style="font-size: 24px; font-family: impact; font-style: normal">Back</a></label></center>';
}
}

?>
<!doctype html>
<html>
<link href="http://localhost/buth_net/pharmacySection/css/buth_net.css" rel="stylesheet" type="text/css">
<head>
<meta charset="utf-8">
<link rel="shortcut icon" href="/favicon.ico" >
<title>Payment Verification Result</title>
<script src="js/jquery-1.12.3.min.js" type="text/javascript"></script>
</head>
<body>
<?php
include_once "header.php";
?>
<div id="container">
  <div id="sidebar1"><br>
	<p class="subHeader">Menu</p>
	<ul id="navigation2">
	  <li class="page_title">Pharmacy Unit</li><br>
	  <li><a href="index.php">Mainpage</a></li><br>
	  <li><a href="pead_pharm_dashboard.php">MCH</a></li><br>
	  <li><a href="pead_payment_verification.php">Payment Verification</a></li><br>
      <li><a href="pead_cart.php">Billing</a></li><br>
      <li><a href="logout.php">Logout</a></li><br>
	</ul>
	<?php include_once "../new_bar.php"; ?>
	  <!-- end .sidebar1 --></div>
	 <div class="margin" id="content">
	  <div id="patient_form">
	  <?php echo $patient_search_results; ?>
	  <p style="margin-top: 35px"><?php echo $msg2; ?></p>
    </div><br><br>
	   <!-- end .content --></div>
	  <!-- end .container --></div>
	 <?php
	  include_once "footer.php";
	 ?>
</body>
</html>