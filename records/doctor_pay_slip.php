<?php 
session_start();
ob_start();
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

if (isset($_GET['server_date'])){
	$server_date = $_GET['server_date'];
}
// insert into doctor charge slip
$amount = $_SESSION['amount'];
$gender = $_SESSION['gender'];
$sur_name = $_SESSION['sur_name'];
$other_names = $_SESSION['other_names'];
$hospital_no = $_SESSION['hosp_no'];                    
$pname = $sur_name . ' ' . $other_names;
$paid_for = "Doctor Visit";
$payment_date = date('Y-d-m:h-m-i');
if ($_SESSION['amount'] == ""){
	$amount = "500";
}

$insert = "INSERT INTO transactions (`patient_name`, `hospital_no`, `total_amount`, `paid_for`, `server_time`, `payment_date`) VALUES ('$pname', '$hospital_no', '$amount', '$paid_for', '$server_date', '$payment_date')";
$checkinsert = mysqli_query($dbconnect, $insert) or die(mysqli_error($dbconnect));

// list for payer
$sql8="SELECT * FROM `transactions` WHERE `server_time`='".$server_date."' LIMIT 1";
$check8 = mysqli_query($dbconnect, $sql8);
$resultCount8=mysqli_num_rows($check8); //count the out amount 
if($resultCount8>0){
	while($row=mysqli_fetch_array($check8)){
		$p_name=$row["patient_name"];
		$hosp_no=$row["hospital_no"];
		$totalamount=$row["total_amount"];
	}
}
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link rel="shortcut icon" href="/favicon.ico" >
<title>Doctor Charge Receipt</title>
</head>
<body>
<div id="receipt_wrapper" style="width: 272px; height: 756px; margin-left: auto; margin-right: auto">
  <center><label style="font-family: arial black; font-size: 13px">Bowen University Teaching Hospital</label></center>
  <p style="text-align: center; font-family: Calibri (Body); font-weight: bold; font-size: 14px">Doctor Charge Pay Slip</p><hr>
  <label style="font-family: Calibri (Body); font-weight: bold; font-size: 13px"><?php echo "Client's Name:" . " " .$p_name; ?></label>
  <label style="float: right; font-family: Calibri (Body); font-weight: bold; font-size: 14px"><?php echo "Staff No:" . " " .$hosp_no; ?></label>
  <p style="font-family: Calibri (Body); font-weight: bold; font-size: 13px"><?php echo date("l jS \of F Y"). "," . " " . date('H:i:s'); ?></p>
  <label style="font-family: Calibri (Body); font-weight: bold; font-size: 13px"><?php echo "Gender:" . " " .$gender; ?></label>
  <label style="float: right; font-family: Calibri (Body); font-weight: bold; font-size: 14px"><?php echo "Amount to Pay:" . " " . "N".$totalamount; ?></label><hr>
  <center><label style="font-family: arial"><?php echo $name; ?></label></center>
  <center>
  <label style='font-family: Bradley Hand ITC; font-size: 24px'>Attendant</label><center><hr>
  <p style="text-align: center; font-family: Calibri (Body); font-weight: normal; font-size: 14px">Powered and Designed by BUTH ICT</p>
	  <div><a href="rec_returning_patient.php">back</a></div>
  </div>
 </body>
</html>