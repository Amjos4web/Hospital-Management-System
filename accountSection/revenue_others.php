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
$sum = "";
$dynamic_list = "";
$dynamic_lists = "";
 if (isset($_POST['sum']))
 {
	$to_date = $_POST['to_date'] ." " . "23:59:59";
	$from_date = $_POST['from_date'] . " " . "00:00:00";
	$others = $_POST['others'];
	if (isset($_POST['from_date']) && ($_POST['to_date']) && ($_POST['others'])){

		// display the specified information
		$display = "SELECT * FROM `transactions` WHERE `payment_date` >= '$from_date' AND `payment_date` <= '$to_date' AND `others`='" . $_POST['others'] . "'";
		$displayCheck = mysqli_query($dbconnect, $display) or die (mysqli_error($dbconnect));
		$displayResult = mysqli_num_rows($displayCheck);
		if ($displayResult > 0){
			while($row=mysqli_fetch_assoc($displayCheck)){
				$date = $row['payment_date'];
				$receipt_no = $row['receipt_no1'];
				$total_income = $row['total_amount'];
				$signed = $row['received_by'];
				$otherss = $row['others'];
				
				
				$dynamic_list .= "<tr>";
				$dynamic_list .= "<td style='background-color:#CECECE;  text-align: center; font-family: Adobe Heiti Std R;'>" .$date . "</td>";
				$dynamic_list .= "<td style='background-color:#CECECE;  text-align: center; font-family: Adobe Heiti Std R;'>".$receipt_no . "</td>";
				$dynamic_list .= "<td style='background-color:#CECECE; text-align: center; font-family: Adobe Heiti Std R;'>".$signed . "</td>";
				$dynamic_list .= "<td style='background-color:#CECECE;  text-align: center; font-family: Adobe Heiti Std R;'>".$otherss . "</td>";
				$dynamic_list .= "<td style='background-color:#CECECE;  text-align: center; font-family: Adobe Heiti Std R;'>N" .$total_income . "</td>";
				$dynamic_list .= "</tr>";
				$dynamic_lists = "<h1 style='font-family: monospace; color: #880000'>"."Results For". " " .$_POST['others']."</h1>";
				

			}
		} else {
			$msg="<center><p style = 'color: #D8000C; background-color: #FFBABA; border-radius:.5em; width: 400px; border: 1px solid #D8D8D8; padding: 5px; border-radius: 5px; font-family: Arial; font-size: 11px; text-transform: uppercase; text-align: center; text-transform: uppercase; padding-left: 12px'>No result found for ".$_POST['others']."</p></center>";
		}

		$sum = "SELECT  SUM(`total_amount`) AS total_sum1 FROM `transactions` WHERE `payment_date` >= '$from_date' AND `payment_date` <= '$to_date' AND `others`='" . $_POST['others'] . "'";
		$sum2 = mysqli_query($dbconnect, $sum) or die (mysqli_error($dbconnect));
		$result1 = mysqli_fetch_array($sum2);
		$sum_total = $result1['total_sum1'];
		$_SESSION['sum_total'] = $sum_total;
		
	} else {
		?><script type="text/javascript">
		alert ('Please fill in the required fields');
		window.location = 'revenue_others.php';
		</script><?php
	}
	
	$to_select = "Others";
	$sum = "SELECT  SUM(total_amount) AS total_sum1 FROM transactions WHERE payment_date >= '$from_date' AND payment_date <= '$to_date' AND paid_for='$to_select' AND others IS NOT NULL";
	$sum2 = mysqli_query($dbconnect, $sum) or die (mysqli_error($dbconnect));
	while($result1 = mysqli_fetch_array($sum2)){
		$sum_others = $result1['total_sum1'];
		$_SESSION['sum_others'] = $sum_others;
		
	}
	

}
?>
<!doctype html>
<html>
<link href="http://localhost/buth_net/pharmacySection/css/buth_net.css" rel="stylesheet" type="text/css">
<head>
<meta charset="utf-8">
<link rel="shortcut icon" href="/favicon.ico" >
<title>Revenue Section|Others</title>
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
	   <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
		<div class="search_angle">
		<div class="total_earn">
			<h2 style='margin-top: auto; font-family: Calibri (Body); font-size: 18px; font-weight: bold; text-transform: uppercase; font-style: normal; color: #FFFFFF'>Sum For Other Payments</h2>
			<center><label style="font-family: monospace; font-size: 16px; font-weight: bold" >From</label>
			<input name="from_date" class="userarea0" type="text"  style="width: 150px" placeholder="YYYY-MM-DD" value="<?php if (isset($_POST['sum'])){echo $from_date;} ?>">
			<label style="font-family: monospace; font-size: 16px; font-weight: bold">To</label>
			<input name="to_date" class="userarea0" type="text"  style="width: 150px" placeholder="YYYY-MM-DD" value="<?php if (isset($_POST['sum'])){echo $to_date;} ?>"></center><br>
			<center><input name="others" class="userarea0" type="text"  style="width: 170px" value="<?php if (isset($_POST['sum'])){echo $other;} ?>"></center><br>
		<center><input type="submit" name="sum" class="submit4" value="Sum"></center><br>
		</div>
	   </div><br><br>
		<div class="product_formlist">
		<?php echo $dynamic_lists; ?>
	  <table width="650px" style="margin-left: auto; margin-right: auto" cellpadding="5" cellspacing="3" border="1">
	   <tr>
	    <td width="25%" style='background-color:#C5DFFA; font-family: arial black; text-align: center; font-size: 14px'><b>Date</b></td>
		<td width="20%" style='background-color:#C5DFFA; font-family: arial black; text-align: center; font-size: 14px'><b>Receipt No</b></td>
		<td width="15%" style='background-color:#C5DFFA; font-family: arial black; text-align: center; font-size: 14px'><b>Signed By</b></td>
		<td width="20%" style='background-color:#C5DFFA; font-family: arial black; text-align: center; font-size: 14px'><b>Receipt For</b></td>
		<td width="20%" style='background-color:#C5DFFA; font-family: arial black; text-align: center; font-size: 14px'><b>Total Income N</b></td>
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
			<center><h3 class="heading_text">Total Income For <?php echo $_POST['others']; ?></h3></center>
			<center><input type="text"  id="total_earn_area" disabled="disabled" value="<?php if (isset($_POST['sum'])){echo "N".$sum_total;} ?>"></center><br>
		</form><br>
		<form action="other_payment_receipt.php?from=$from_date&to=$to_date" method="GET" id="jsform" target="_blank">
		<input type="hidden" name="from_date" value="<?php echo $from_date; ?>">
		<input type="hidden" name="to_date" value="<?php echo $to_date; ?>">
		<input type="hidden" name="other" value="<?php echo $others; ?>">
		<center><input type="button" onclick="document.getElementById('jsform').submit();" class="submit4" value="Print Receipt"></center>
	  </form><br>
	   <!-- end .content --></div>
	  <!-- end .container --></div>
	  </div>
     <?php include_once "footer.php"; ?>
	 
</body>
</html>