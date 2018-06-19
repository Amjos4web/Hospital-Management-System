<?php 
session_start();
ob_start();
// error display configuration
if(!isset($_SESSION['emaill'])){
	header('location: pharmacy_store.php');
}
// error display configuration
error_reporting(E_ALL & ~E_NOTICE);
//This block grabs the whole list for viewing
$msg="";
$email= $_SESSION['emaill'];
include "dbconnect2.php";
$sql="SELECT * FROM `pharmacy_store` WHERE `emailAdd`='$email' LIMIT 1";
$check = mysqli_query($dbconnect, $sql);
$resultCount=mysqli_num_rows($check); //count the out amount 
if($resultCount>0){
	while($row=mysqli_fetch_array($check)){
	$id=$row["id"];
	$password=$row["passWord"];
	$name=$row["first_name"];
	}
}else{
$msg="<p style='color: red; text-align: center'>You have no Information yet in the Database</p>";
}


$dynamic_lists = "";
$dynamic_list = "";
// $page = "";
// $page = $_GET['page'];
// if ($page == "" || $page == "1"){
	// $page1 = 0;
// } else {
	// $page1 = ($page*14)-14;
// }
if (isset($_POST['sum'])){
	$to_date = $_POST['to_date'] ." " . "23:59:59";
	$from_date = $_POST['from_date'] . " " . "00:00:00";
	$paid_for = "Drugs";
	if (isset($_POST['from_date']) && ($_POST['to_date'])){
		
	
		// display the specified drugs information
		$display = "SELECT * FROM `transactions` WHERE `payment_date` >= '$from_date' AND `payment_date` <= '$to_date' && `paid_for`='$paid_for'";
		$displayCheck = mysqli_query($dbconnect, $display) or die (mysqli_error($dbconnect));
		$displayResult = mysqli_num_rows($displayCheck);
		if ($displayResult > 0){
			while($row=mysqli_fetch_assoc($displayCheck)){
		
				$payment_date = $row['payment_date'];
				$hosp_no = $row['hospital_no'];
				$patient_name = $row['patient_name'];
				$total_income = $row['total_amount'];
				$payment_status = $row['payment_status'];
				$billed_by = $row['staff_id'];
				
				
				$dynamic_list .= "<tr>";
				$dynamic_list .= "<td style='background-color:#CECECE; text-align: center; font-family: Adobe Heiti Std R;'>" .$payment_date . "</td>";
				$dynamic_list .= "<td style='background-color:#CECECE; text-align: center; font-family: Adobe Heiti Std R;'>".$hosp_no . "</td>";
				$dynamic_list .= "<td style='background-color:#CECECE; text-align: center; font-family: Adobe Heiti Std R;'>" .$patient_name . "</td>";
				$dynamic_list .= "<td style='background-color:#CECECE; text-align: center; font-family: Adobe Heiti Std R;'>".$total_income . "</td>";
				$dynamic_list .= "<td style='background-color:#CECECE; text-align: center; font-family: Adobe Heiti Std R;'>" .$payment_status . "</td>";
				$dynamic_list .= "<td style='background-color:#CECECE; text-align: center; font-family: Adobe Heiti Std R;'>". $billed_by . "</td>";
				$dynamic_list .= "</tr>";
				
			}
		} else {
			$msg="<p style'color: #D8000C; background-color: #FFBABA; border-radius:.5em; width: 300px; border: 1px solid #D8D8D8; padding: 5px; border-radius: 5px; margin-left: auto; margin-right: auto; font-family: Arial; font-size: 11px; text-transform: uppercase; text-align: center; text-transform: uppercase'>Error has occurred Please try again</p>";
		}
		// sum for total amount
		$sum_total = array();
		$sum = "SELECT  SUM(`total_amount`) AS total_sum FROM `transactions` WHERE `payment_date` >= '$from_date' AND `payment_date` <= '$to_date' && `paid_for`='$paid_for'";
		$sum2 = mysqli_query($dbconnect, $sum) or die (mysqli_error($dbconnect));
		$result1 = mysqli_fetch_array($sum2);
		$sum_total[] = $result1['total_sum'];
		foreach ($sum_total as $total_amount){
			if (!empty($total_amount)){
				$income_sum = $total_amount;
				$_SESSION['total_amount'] = $total_amount;
			}
			
		}
		// $expt_profit = $grand_selling_price - $grand_cost_price
		
		// sum total amount for paid
		$status2 = "paid";
		$sum_total1 = array();
		$sum = "SELECT  SUM(`total_amount`) AS total_sum1 FROM `transactions` WHERE `payment_date` >= '$from_date' AND `payment_date` <= '$to_date' && `paid_for`='$paid_for' && `payment_status`='$status2'";
		$sum2 = mysqli_query($dbconnect, $sum) or die (mysqli_error($dbconnect));
		$result1 = mysqli_fetch_array($sum2);
		$sum_total1[] = $result1['total_sum1'];
		foreach ($sum_total1 as $total_amount1){
			if (!empty($total_amount1)){
				$income_sum = $total_amount1;
				$_SESSION['total_amount1'] = $total_amount1;
			}
			
		}
		
		// sum total amount for unpaid
		$sum_total2 = array();
		$sum = "SELECT  SUM(`total_amount`) AS total_sum2 FROM `transactions` WHERE `payment_date` >= '$from_date' AND `payment_date` <= '$to_date' && `paid_for`='$paid_for' && `payment_status`!='$status2' OR `payment_status` IS NULL";
		$sum2 = mysqli_query($dbconnect, $sum) or die (mysqli_error($dbconnect));
		$result1 = mysqli_fetch_array($sum2);
		$sum_total2[] = $result1['total_sum2'];
		foreach ($sum_total2 as $total_amount2){
			if (!empty($total_amount2)){
				$income_sum = $total_amount2;
				$_SESSION['total_amount2'] = $total_amount2;
			}
			
		}
		$dynamic_lists .= "<tr>";
		$dynamic_lists .= "<td style='background-color:#CECECE; text-align: center; font-family: Adobe Heiti Std R;'>" .$total_amount1. "</td>";
		$dynamic_lists .= "<td style='background-color:#CECECE; text-align: center; font-family: Adobe Heiti Std R;'>".$total_amount2. "</td>";
		$dynamic_lists .= "</tr>";
		
	} else {
		?><script type="text/javascript">
		alert ('Please enter date');
		window.location = 'income_summary.php';
		</script><?php
	}
	
	// $_SESSION['expt_profit'] = $expt_profit;
			
	
	
	
}
?>
<!doctype html>
<html>
<link href="http://localhost/buth_net/pharmacySection/css/buth_net.css" rel="stylesheet" type="text/css">
<head>
<meta charset="utf-8">
<link rel="shortcut icon" href="/favicon.ico" >
<title>Income Summary</title>
</head>
<body>
<?php
include_once "header.php";
?>
<div id="container">
  <div id="sidebar1"><br>
    <p class="subHeader">Menu</p>
    <ul id="navigation2">
	 <?php include_once "pharmacy_nav.php"; ?>
    </ul>
	 <img src="images/drugs.png" width="170px" height="250px" style="margin-left: 20px" alt="Welcome To School of Nursing"><br><br>
	 <?php include_once "../new_bar.php"; ?>
      <!-- end .sidebar1 --></div>
     <div class="margin" id="content">
	  <div class="welcome_message">
	   <h1 style='text-align: center; font-family: tahoma; font-size: 16px; text-transform: uppercase; font-weight: bold; background-color: #000000; color: #CECECE'>Welcome <?php echo $name."!" . " "; ?>What would you like to do today?</h1>
	     <h2 style='text-align: center; font-family: Calibri (Body); font-size: 22px; font-weight: bold; text-transform: uppercase; font-style: normal; color: #880000; text-shadow: 0 1px 0 #ccc,0 2px 0 #c9c9c9,0 3px 0 #bbb,0 4px 0 #b9b9b9,0 5px 0 #aaa,0 6px 1px rgba(0,0,0,.1),0 0 5px rgba(0,0,0,.1),0 1px 3px rgba(0,0,0,.3),0 3px 5px rgba(0,0,0,.2),0 5px 10px rgba(0,0,0,.25),0 10px 10px rgba(0,0,0,.2),0 20px 20px rgba(0,0,0,.15)'>Pharmacy Available Stocks</h2><br>
	  </div>
		<div class="total_earn">
		 <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
			<h2 style='margin-top: 10px; font-family: Calibri (Body); font-size: 20px; font-weight: bold; text-transform: uppercase; font-style: normal; color: #FFFFFF'>Income Summary</h2>
			<center><label style="font-family: monospace; font-size: 16px; font-weight: bold" >From</label>
			<input name="from_date" class="userarea0" type="text"  style="width: 110px" placeholder="YYYY-MM-DD" value="<?php if (isset($_POST['sum'])){echo $from_date;} ?>">
			<label style="font-family: monospace; font-size: 16px; font-weight: bold">To</label>
			<input name="to_date" class="userarea0" type="text"  style="width: 110px" placeholder="YYYY-MM-DD" value="<?php if (isset($_POST['sum'])){echo $to_date;} ?>"></center><br>
			<center><input type="submit" name="sum" class="submit4" value="Go"></center><br>
		 </form>
		</div><br>
	  <div class="product_formlist">
	  <table width="760px" style="margin-left: auto; margin-right: auto" cellpadding="5" cellspacing="3" border="1">
	   <tr>
	    <td width="17%" style='background-color:#C5DFFA; font-family: arial black; text-align: center; font-size: 14px'><b>Payment Date</b></td>
		<td width="15%" style='background-color:#C5DFFA; font-family: arial black; text-align: center; font-size: 14px'><b>Hosp. No</b></td>
		<td width="25%" style='background-color:#C5DFFA; font-family: arial black; text-align: center; font-size: 14px'><b>Patient Name</b></td>
		<td width="15%" style='background-color:#C5DFFA; font-family: arial black; text-align: center; font-size: 14px'><b>Expected Income N</b></td>
		<td width="12%" style='background-color:#C5DFFA; font-family: arial black; text-align: center; font-size: 14px'><b>Payment Status</b></td>
		<td width="15%" style='background-color:#C5DFFA; font-family: arial black; text-align: center; font-size: 14px'><b>Billed By</b></td>
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
		<table width="760px" style="margin-left: auto; margin-right: auto" cellpadding="5" cellspacing="3" border="1">
	   <tr>
	    <td width="50%" style='background-color:#C5DFFA; font-family: arial black; text-align: center; font-size: 14px'><b>Total Income For Paid N</b></td>
		<td width="50%" style='background-color:#C5DFFA; font-family: arial black; text-align: center; font-size: 14px'><b>Total Income For Unpaid N</b></td>
		</tr>
		<?php echo $dynamic_lists; ?>
		<!--tr>
		 <td>&nbsp;</td>
		 <td>&nbsp;</td>
		 <td>&nbsp;</td>
		 <td>&nbsp;</td>
		 <td>&nbsp;</td>
		</tr-->
		</table><br>
		<center><h3 class="heading_text">Expected Total Income</h3></center>
		<center><input name="expt_profit" class="userarea0" type="text" value="<?php if (isset($_POST['sum'])){echo "=N" . $total_amount;} ?>"  style="width: 150px; text-align: center; background-color: #082944; color: #FFFFFF" disabled="disabled"></center><br>
	    <form action="income_receipt.php?from=$from_date&to=$to_date" method="GET" id="jsform" target="_blank">
		<input type="hidden" name="from_date" value="<?php echo $from_date; ?>">
		<input type="hidden" name="to_date" value="<?php echo $to_date; ?>">
		<input type="hidden" name="paid_for" value="<?php echo $paid_for; ?>">
		<center><input type="button" onclick="document.getElementById('jsform').submit();" class="submit4" value="Print Receipt"></center>
	  </form>
	   </div>
   <!-- end .content --></div>
  <!-- end .container --></div>
     <?php
      include_once "footer.php";
     ?>
</body>
</html>