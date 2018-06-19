<?php 
session_start();
ob_start();
include_once "search_angle.php";
// error display configuration
error_reporting(E_ALL);
ini_set('display_errors','1');

if(!isset($_SESSION['emaill'])){
	header('location: cashier_login.php');
}
//This block grabs the whole list for viewing
$msg="";
$email= $_SESSION['emaill'];
include "dbconnect2.php";
$sql="SELECT * FROM `cashier` WHERE `username_id`='$email' LIMIT 1";
$check = mysqli_query($dbconnect, $sql);
$resultCount=mysqli_num_rows($check); //count the out amount 
if($resultCount>0){
	while($row=mysqli_fetch_array($check)){
	$id=$row["id"];
	$password=$row["password"];
	$name=$row["first_name"];
	}
}else{
$msg="<p style='color: red; text-align: center'>You have no Information yet in the Database</p>";
}
?>
<!doctype html>
<html>
<link href="http://localhost/buth_net/pharmacySection/css/buth_net.css" rel="stylesheet" type="text/css">
<head>
<meta charset="utf-8">
<link rel="shortcut icon" href="/favicon.ico" >
<title>Patient Result</title>
<script src="js/jquery-1.12.3.min.js" type="text/javascript"></script>
<script>
// $(document).ready(function(){
	// $('.submit').click(function(){
		// $('.payment_section').fadeIn(3000);
	// })
// })
function myFunction() {
    var submit = document.getElementById("myPopup");
    submit.classList.toggle("show");
}
</script>
<style>
/* Popup container - can be anything you want */
.submit {
    position: relative;
    display: inline-block;
    cursor: pointer;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
}

/* The actual popup */
.popup .popuptext {
    visibility: hidden;
    width: 160px;
    background-color: #555;
    color: #fff;
    text-align: center;
    border-radius: 6px;
    padding: 8px 0;
    position: absolute;
    z-index: 1;
    bottom: 125%;
    left: 50%;
    margin-left: -80px;
}

/* Popup arrow */
.popup .popuptext::after {
    content: "";
    position: absolute;
    top: 100%;
    left: 50%;
    margin-left: -5px;
    border-width: 5px;
    border-style: solid;
    border-color: #555 transparent transparent transparent;
}

/* Toggle this class - hide and show the popup */
.submit .show {
    visibility: visible;
    -webkit-animation: fadeIn 1s;
    animation: fadeIn 1s;
}

/* Add animation (fade in the popup) */
@-webkit-keyframes fadeIn {
    from {opacity: 0;} 
    to {opacity: 1;}
}

@keyframes fadeIn {
    from {opacity: 0;}
    to {opacity:1 ;}
}
</style>
</head>
<body>
<?php
include_once "header.php";
?>
<div id="container">
  <div id="sidebar1"><br>
	<p class="subHeader">Menu</p>
	<ul id="navigation2">
	  <li class="page_title">Account Unit</li><br>
	  <li><a href="http://localhost/buth_net/index.php">Main Page</a></li><br>
	  <li><a href="general_payment.php">General Payment</a></li><br>
	  <li><a href="total_earn.php">Total Earn</a></li><br>
      <li><a href="acc_logout.php">Logout</a></li><br>
	</ul>
	<img src="images/money.jpg" width="170px" height="250px" style="margin-left: 15px" alt="Account Session"><br><br>
	<?php include_once "../new_bar.php"; ?>
	  <!-- end .sidebar1 --></div>
	 <div class="margin" id="content">
	  <div id="patient_form">
	  <?php echo $patient_search_results; ?>
	  <p style="margin-top: 35px"><?php echo $msg2; ?></p>
    </div><br><br>
	 <div class="payment_section" id="myPopup">
	  <form action="payment_receipt.php" method="post" id="payform">
		<p><label style="font-family: arial black; font-size: 14px">Total Amount To Pay:</label><span style="float: right; margin-right: 70px; color:#ffffff; font-family: arial; font-size: 14px"><?php echo "N" . $total_amount; ?></span></p>
	    <p><label style="font-family: arial black; font-size: 14px">Amount Tendered:</label><input type="text" id="user_amount" name="amount_tendered" /></p>
	  </form>
	   <center><input type="button" onclick="document.getElementById('payform').submit();" class="submit4" value="Print receipt"></center>
	 </div>
	   <!-- end .content --></div>
	  <!-- end .container --></div>
	 <?php
	  include_once "footer.php";
	 ?>
</body>
</html>