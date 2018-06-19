<?php 
session_start();
ob_start();
// error display configuration
error_reporting(E_ALL & ~E_NOTICE);

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
	$name2=$row["username_id"];
	}
}else{
$msg="<p style='color: red; text-align: center'>You have no Information yet in the Database</p>";
}

// get the current signed in cashier_login
$sql3 = "SELECT * FROM `transactions` WHERE `received_by`='$name' LIMIT 1";
$check3 = mysqli_query($dbconnect, $sql3) or die (mysqli_error($dbconnect));
$resultCount3 = mysqli_num_rows($check3);
if($resultCount3>0){
	while($row=mysqli_fetch_array($check3)){
	$receivedBy=$row["received_by"];
	$total_amount=$row["total_amount"];
	$payment_date=$row["payment_date"];
	}
}else{
$msg="<center><p style = 'color: #D8000C; background-color: #FFBABA; border-radius:.5em; width: 400px; border: 1px solid #D8D8D8; padding: 5px; border-radius: 5px; font-family: Arial; font-size: 11px; text-transform: uppercase; text-align: center; text-transform: uppercase; padding-left: 12px'>You have not earn any money yet</p></center>";
}

// sum the total earn by current user 
$sum = "";
$dynamic_list = "";
 if (isset($_POST['sum']))
 {
	 // $sql2 = "SELECT SUM(CASE WHEN `received_by` = '$receivedBy' THEN `total_amount` ELSE 0 END) AS total FROM `transactions` WHERE `payment_date`='$payment_date'";
	 // $query2 = mysqli_query($dbconnect, $sql2) or die (mysqli_error($dbconnect));
	 // $row = mysqli_fetch_assoc($query2);
	 // $sum = $row['total'];
	$to_date = $_POST['to_date'] ." " . "23:59:59";
	$from_date = $_POST['from_date'] . " " . "00:00:00";
	if (isset($_POST['from_date']) && ($_POST['to_date'])){
		
		// display the specified drugs information
		$display = "SELECT * FROM `transactions` WHERE `payment_date` >= '$from_date' AND `payment_date` <= '$to_date' AND `received_by`='$receivedBy'";
		$displayCheck = mysqli_query($dbconnect, $display) or die (mysqli_error($dbconnect));
		$displayResult = mysqli_num_rows($displayCheck);
		if ($displayResult > 0){
			while($row=mysqli_fetch_assoc($displayCheck)){
				$date = $row['payment_date'];
				$receipt_no = $row['receipt_no1'];
				$total_income = $row['total_amount'];
				$discount = $row['discountOff'];
				$paid_for = $row['paid_for'];
				
			
				
				$dynamic_list .= "<tr>";
				$dynamic_list .= "<td style='background-color:#CECECE; text-align: center; font-family: Adobe Heiti Std R;'>" .$date . "</td>";
				$dynamic_list .= "<td style='background-color:#CECECE; text-align: center; font-family: Adobe Heiti Std R;'>".$receipt_no . "</td>";
				$dynamic_list .= "<td style='background-color:#CECECE; text-align: center; font-family: Adobe Heiti Std R;'>".$paid_for . "</td>";
				$dynamic_list .= "<td style='background-color:#CECECE; text-align: center; font-family: Adobe Heiti Std R; text-align: left; padding-left: 50px;'>N".$discount . "</td>";
				$dynamic_list .= "<td style='background-color:#CECECE; text-align: center; font-family: Adobe Heiti Std R; text-align: left; padding-left: 50px;'>N" .$total_income . "</td>";
				$dynamic_list .= "</tr>";
				

			}
		} else {
			?><script type="text/javascript">
			alert ('No money');
			window.location = 'total_earn.php';
			</script><?php
		}

	} else {
		?><script type="text/javascript">
		alert ('Please enter date');
		window.location = 'total_earn.php';
		</script><?php
	}

	// sum for income total
	$sum = "SELECT  SUM(`total_amount`) AS total_sum1 FROM `transactions` WHERE `payment_date` >= '$from_date' AND `payment_date` <= '$to_date' && `received_by`='$receivedBy'";
	$sum2 = mysqli_query($dbconnect, $sum) or die (mysqli_error($dbconnect));
	$result1 = mysqli_fetch_array($sum2);
	$sum_total = $result1['total_sum1'];
	$_SESSION['sum_total'] = $sum_total;
	
	// sum for dicount total
	$sumdis = "SELECT  SUM(`discountOff`) AS discountoff FROM `transactions` WHERE `payment_date` >= '$from_date' AND `payment_date` <= '$to_date' && `received_by`='$receivedBy'";
	$sumdis2 = mysqli_query($dbconnect, $sumdis) or die (mysqli_error($dbconnect));
	$resultdis1 = mysqli_fetch_array($sumdis2);
	$sum_discount = $resultdis1['discountoff'];
	$_SESSION['sum_discount'] = $sum_discount;
}
?>
<!doctype html>
<html>
<link href="http://localhost/buth_net/pharmacySection/css/buth_net.css" rel="stylesheet" type="text/css">
<head>
<meta charset="utf-8">
<link rel="shortcut icon" href="/favicon.ico" >
<title>Account Section</title>
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
	  <li><a href="http://localhost/buth_net/index.php">Main Page</a></li><br>
	  <li><a href="general_payment.php">General Payment</a></li><br>
	  <li><a href="account.php">Pay By Order</a></li><br>
	  <li><a href="total_earn.php">Income Summary</a></li><br>
      <li><a href="acc_logout.php">Logout</a></li><br>
    </ul>
	<img src="images/money.jpg" width="170px" height="250px" style="margin-left: 15px" alt="Account Session"><br><br>
      <!-- end .sidebar1 --></div>
     <div class="margin" id="content">
	  <div class="search_angle">
		<div class="total_earn">
		 <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
			<h2 style='margin-top: auto; font-family: Calibri (Body); font-size: 18px; font-weight: bold; text-transform: uppercase; font-style: normal; color: #FFFFFF'><?php echo "Total Earn By" . " " . $name; ?></h2>
			<center><label style="font-family: monospace; font-size: 16px; font-weight: bold" >From</label>
			<input name="from_date" class="userarea0" type="date"  style="width: 110px" placeholder="YYYY-MM-DD" value="<?php if (isset($_POST['sum'])){echo $from_date;} ?>">
			<label style="font-family: monospace; font-size: 16px; font-weight: bold">To</label>
			<input name="to_date" class="userarea0" type="date"  style="width: 110px" placeholder="YYYY-MM-DD" value="<?php if (isset($_POST['sum'])){echo $to_date;} ?>"></center><br>
			<center><input type="submit" name="sum" class="submit4" value="Sum Total Earn"></center><br>
		</form>
		</div>
	   </div><br><br>
	    <?php echo $msg; ?>
		<div class="product_formlist">
	  <table width="650px" style="margin-left: auto; margin-right: auto" cellpadding="5" cellspacing="3" border="1">
	   <tr>
	    <td width="20%" style='background-color:#C5DFFA; font-family: arial black; text-align: center; font-size: 14px'><b>Date</b></td>
		<td width="15%" style='background-color:#C5DFFA; font-family: arial black; text-align: center; font-size: 14px'><b>Receipt No</b></td>
		<td width="20%" style='background-color:#C5DFFA; font-family: arial black; text-align: center; font-size: 14px'><b>Receipt For</b></td>
		<td width="20%" style='background-color:#C5DFFA; font-family: arial black; text-align: center; font-size: 14px'><b>Discount</b></td>
		<td width="25%" style='background-color:#C5DFFA; font-family: arial black; text-align: center; font-size: 14px'><b>Total Cash Received</b></td>
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
		<center><h3 class="heading_text">Discount Total</h3></center>
		<center><input type="text"  id="total_earn_area" disabled="disabled" value="<?php if (isset($_POST['sum'])){echo "N".$sum_discount;} ?>"></center><br>
		<center><h3 class="heading_text">Total Cash Received</h3></center>
		<center><input type="text"  id="total_earn_area" disabled="disabled" value="<?php if (isset($_POST['sum'])){echo "N".$sum_total;} ?>"></center><br><br>
	 <form action="staff_income_receipt.php?from=$from_date&to=$to_date" method="GET" id="jsform" target="_blank">
		<input type="hidden" name="from_date" value="<?php echo $from_date; ?>">
		<input type="hidden" name="to_date" value="<?php echo $to_date; ?>">
		<input type="hidden" name="receivedBy" value="<?php echo $receivedBy; ?>">
		<center><input type="button" onclick="document.getElementById('jsform').submit();" class="submit4" value="Print Receipt"></center>
	  </form>
	   <!-- end .content --></div>
	  <!-- end .container --></div>
	  </div>
     <?php include_once "footer.php"; ?>
	 
</body>
</html>