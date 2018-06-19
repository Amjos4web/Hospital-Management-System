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
?>
<?php
if (isset($_POST['go'])){	
$amount = "500";				
$sur_name = $_SESSION['sur_name'];
$other_names = $_SESSION['other_names'];
$first_name = $_SESSION['first_name'];
$hospital_no = $_SESSION['hosp_no'];
$date_of_reg = $_SESSION['date_of_reg'];
$gender = $_SESSION['gender'];
$patient_name = $sur_name . " " . $first_name . " " . $other_names; 
$date_forwarded = date('Y-m-d');
$server_date = date('Y-m-d:H-m-i');


$sql8 = "INSERT INTO `nurse_panel` (`patient_name`, `patient_hosp_no`, `date_of_registration`, `server_date`, `date_forwarded`, `gender`, `logged_in_staff`) VALUES ('$patient_name', '$hospital_no', '$date_of_reg', '$server_date', '$date_forwarded', '$gender', '$name')";
$query8 = mysqli_query($dbconnect, $sql8) or die (mysqli_error($dbconnect));
$_SESSION['amount'] = $amount;

?><script type="text/javascript">
alert ('Are you sure you want to continue?');
</script><?php
?><!doctype html>
 <html>
 <head>
 <meta charset="utf-8">
 <title>Success Page</title>
 </head>
 <style>
	#continue_refresh label {
	color: #4F8A10;
	background-color: #DFF2BF;
	-moz-border-radius:5px;
	-webkit-border-radius:5px;
	border-radius:5px;
	border: 1px solid #D8D8D8;
	display:block;
	font:16px Arial, Helvetica, sans-serif; 
	padding: 5px 10px;
	font-weight:bold;
	width: 600px;
	text-transform: uppercase;
	margin-top: 200px;
	}
	#continue_refresh a {-moz-box-shadow:inset 0px 1px 3px 0px #91b8b3;
	-webkit-box-shadow:inset 0px 1px 3px 0px #91b8b3;
	box-shadow:inset 0px 1px 3px 0px #91b8b3;
	background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #768d87), color-stop(1, #6c7c7c));
	background:-moz-linear-gradient(top, #768d87 5%, #6c7c7c 100%);
	background:-webkit-linear-gradient(top, #768d87 5%, #6c7c7c 100%);
	background:-o-linear-gradient(top, #768d87 5%, #6c7c7c 100%);
	background:-ms-linear-gradient(top, #768d87 5%, #6c7c7c 100%);
	background:linear-gradient(to bottom, #768d87 5%, #6c7c7c 100%);
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#768d87', endColorstr='#6c7c7c',GradientType=0);
	background-color:#768d87;
	-moz-border-radius:8px;
	-webkit-border-radius:8px;
	border-radius:4px;
	display:inline-block;
	color:#ffffff;
	font-family:Arial;
	font-size:20px;
	font-weight:bold;
	cursor: pointer;
	padding:3px 10px;
	text-decoration:none;
	font-style: normal;
	}
	#continue_refresh a:hover{
	color: #880000;
	}
 </style>
 <body>
 <div id="continue_refresh">
 <center><label>Successfully Forwarded to Nurse Table</label></center><br><br>
 <center><?php echo "<a href='doctor_pay_slip.php?server_date=".$server_date."'>Click Here To Continue</a>"; ?></center>
 </div>
 </body>
 </html><?php
 exit();
 
} else 
// header ('location: cart.php');
?><script type="text/javascript">
  alert ('Error has occured... Please try again');
  window.location = "rec_returning_patient.php";
  </script><?php 

?>

