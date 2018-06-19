<?php 
session_start();
ob_start();
// error display configuration
 error_reporting(E_ALL & ~E_NOTICE);

if(!isset($_SESSION['emaill'])){
	header('location: revenue_login.php');
}
//This block grabs the whole list for viewing
$msg="";
$email= $_SESSION['emaill'];
include "dbconnect2.php";
$sql="SELECT * FROM `revenue_login` WHERE `emailAdd`='$email' LIMIT 1";
$check = mysqli_query($dbconnect, $sql);
$resultCount=mysqli_num_rows($check); //count the out amount 
if($resultCount>0){
	while($row=mysqli_fetch_array($check)){
	$id=$row["id"];
	$name=$row["first_name"];
	$name2=$row["emailAdd"];
	}
}else{
$msg="<p style='color: red; text-align: center'>You have no Information yet in the Database</p>";
}

// sum the total earn by current user 

$dynamic_list = "";

$to_select = "Others"; 
$display = "SELECT others, payment_date, total_amount FROM `transactions` WHERE paid_for='$to_select' AND others IS NOT NULL";
$displayCheck = mysqli_query($dbconnect, $display) or die (mysqli_error($dbconnect));
$displayResult = mysqli_num_rows($displayCheck);
if ($displayResult > 0){
	while($row=mysqli_fetch_assoc($displayCheck)){
		$date = $row['payment_date'];
		$total = $row['total_amount'];
		$other = $row['others'];
		
		$dynamic_list .= "<tr>";
		$dynamic_list .= "<td style='background-color:#CECECE; text-align: center; font-family: Adobe Heiti Std R;'>" .$date . "</td>";
		$dynamic_list .= "<td style='background-color:#CECECE; text-align: center; font-family: Adobe Heiti Std R;'>".$other . "</td>";
		$dynamic_list .= "<td style='background-color:#CECECE; text-align: center; font-family: Adobe Heiti Std R;'>N" .$total . "</td>";
		$dynamic_list .= "</tr>";
	}
} else {
	$msg="<center><p style = 'color: #D8000C; background-color: #FFBABA; border-radius:.5em; width: 400px; border: 1px solid #D8D8D8; padding: 5px; border-radius: 5px; font-family: Arial; font-size: 11px; text-transform: uppercase; text-align: center; text-transform: uppercase; padding-left: 12px'>Nothing to display</p></center>";
}
?>
<!doctype html>
<html>
<link href="http://localhost/buth_net/pharmacySection/css/buth_net.css" rel="stylesheet" type="text/css">
<head>
<meta charset="utf-8">
<link rel="shortcut icon" href="/favicon.ico" >
<title>New Payments</title>
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
	  <li><a href="account_home.php">Home Page</a></li><br>
	  <li><a href="revenue.php">Income Summary</a></li><br>
	  <li><a href="revenue_all.php">Income Sum. (All)</a></li><br>
	  <li><a href="revenue_others.php">Income Sum. (Others)</a></li><br>
	  <li><a href="other_payments.php">View Other Payments</a></li><br>
      <li><a href="acc_logout.php">Logout</a></li><br>
    </ul>
	<img src="images/money.jpg" width="170px" height="250px" style="margin-left: 15px" alt="Account Session"><br><br>
      <!-- end .sidebar1 --></div>
     <div class="margin" id="content">
	 	   <h1 style='text-align: center; font-family: tahoma; font-size: 16px; text-transform: uppercase; font-weight: bold; background-color: #000000; color: #CECECE'>Welcome <?php echo $name."!" . " "; ?>What would you like to do today?</h1><br>
	   <?php echo $msg; ?>
		<div class="product_formlist">
	  <table width="650px" style="margin-left: auto; margin-right: auto" cellpadding="5" cellspacing="3" border="1">
	   <tr>
	    <td width="20%" style='background-color:#C5DFFA; font-family: arial black; text-align: center; font-size: 14px'><b>Date</b></td>
		<td width="40%" style='background-color:#C5DFFA; font-family: arial black; text-align: center; font-size: 14px'><b>Receipt For</b></td>
		<td width="40%" style='background-color:#C5DFFA; font-family: arial black; text-align: center; font-size: 14px'><b>Income</b></td>
		</tr>
		<?php echo $dynamic_list; ?>
		<!--tr>
		 <td>&nbsp;</td>
		 <td>&nbsp;</td>
		 <td>&nbsp;</td>
		 <td>&nbsp;</td>
		 <td>&nbsp;</td>
		</tr-->
		</table><br><br>
	   <!-- end .content --></div>
	  <!-- end .container --></div>
	  </div>
     <?php include_once "footer.php"; ?>
	 
</body>
</html>