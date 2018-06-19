<?php 
session_start();
ob_start();
// error display configuration
error_reporting(E_ALL & ~E_NOTICE);


if(!isset($_SESSION['emaill'])){
	header('location: admin_login.php');
}
//This block grabs the whole list for viewing
$msg="";
$email= $_SESSION['emaill'];
include "dbconnect2.php";
$sql="SELECT * FROM `admin` WHERE `admin_email`='$email' LIMIT 1";
$check = mysqli_query($dbconnect, $sql);
$resultCount=mysqli_num_rows($check); //count the out amount 
if($resultCount>0){
	while($row=mysqli_fetch_array($check)){
	$id=$row["id"];
	$admin_password=$row["admin_password"];
	$name=$row["name"];
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
	$to_date = $_POST['to_date'];
	$from_date = $_POST['from_date'];
	if ($from_date && $to_date != ""){
		if ((preg_match("/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/", $from_date)) || (preg_match("/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/", $to_date))){
			$total_unit_cost = array();
			$total_unit_price = array();
		
			// display the specified drugs information
			$display = "SELECT * FROM `products` WHERE `date_added` >= '$from_date' AND `date_added` <= '$to_date'";
			$displayCheck = mysqli_query($dbconnect, $display) or die (mysqli_error($dbconnect));
			$displayResult = mysqli_num_rows($displayCheck);
			if ($displayResult > 0){
				while($row=mysqli_fetch_assoc($displayCheck)){
					
					
					$date_added = $row['date_added'];
					$drug_name = $row['product_name'];
					$quantity = $row['quantity_available'];
					$selling_price2 = $row['price'];
					$cost_price2 = $row['cost_price'];
					$total_unit_cost[] = $quantity * $cost_price2;
					$total_unit_price[] = $quantity * $selling_price2;
					
					
				
					foreach ($total_unit_price as $total1){
						if (!empty($total1)){
							$price_total = $total1;
							$_SESSION['total1'] = $total1;
						}
						
					}
					foreach ($total_unit_cost as $total2){
						if (!empty($total2)){
							$cost_total = $total2;
							$_SESSION['total2'] = $total2;
						}
						
					}
					$dynamic_list .= "<tr>";
					$dynamic_list .= "<td style='background-color:#CECECE; text-align: center; font-family: Adobe Heiti Std R;'>" .$date_added . "</td>";
					$dynamic_list .= "<td style='background-color:#CECECE; text-align: center; font-family: Adobe Heiti Std R;'>".$drug_name . "</td>";
					$dynamic_list .= "<td style='background-color:#CECECE; text-align: center; font-family: Adobe Heiti Std R;'>" .$quantity . "</td>";
					$dynamic_list .= "<td style='background-color:#CECECE; text-align: center; font-family: Adobe Heiti Std R;'>".$selling_price2 . "</td>";
					$dynamic_list .= "<td style='background-color:#CECECE; text-align: center; font-family: Adobe Heiti Std R;'>" .$cost_price2 . "</td>";
					$dynamic_list .= "<td style='background-color:#CECECE; text-align: center; font-family: Adobe Heiti Std R;'>". $total2 . "</td>";
					$dynamic_list .= "<td style='background-color:#CECECE; text-align: center; font-family: Adobe Heiti Std R;'>" .$total1 . "</td>";
					$dynamic_list .= "</tr>";
					
					// print_r ($date . " " . $qty . " " . $selling); die();
				} // close while loop
			} else {
			$msg="<p style'color: #D8000C; background-color: #FFBABA; border-radius:.5em; width: 300px; border: 1px solid #D8D8D8; padding: 5px; border-radius: 5px; margin-left: auto; margin-right: auto; font-family: Arial; font-size: 11px; text-transform: uppercase; text-align: center; text-transform: uppercase'>Error has occurred Please try again</p>";
			}
		} else {
		?><script type="text/javascript">
		alert ('Date format should be YYYY-MM-DD');
		window.location = 'stockvaluation.php';
		</script><?php
		}
		 
		
		
		// sum for quantity_available
		$quantity2 = array();
		$sum = "SELECT  SUM(`quantity_available`) AS total_sum FROM `products` WHERE `date_added` >= '$from_date' AND `date_added` <= '$to_date'";
		$sum2 = mysqli_query($dbconnect, $sum) or die (mysqli_error($dbconnect));
		$result1 = mysqli_fetch_array($sum2);
		$quantity2[] = $result1['total_sum'];
		foreach ($quantity2 as $quant){
			if (!empty($quant)){
				$cost_total = $quant;
				$_SESSION['quant'] = $quant;
			}
			
		}
		
		// sum for grand_cost_price

	
		$grand_cost_price = array_sum($total_unit_cost);
		$_SESSION['grand_cost_price'] = $grand_cost_price;
		
		// sum for grand_selling price
		$grand_selling_price = array_sum($total_unit_price);
		$_SESSION['grand_selling_price'] = $grand_selling_price;
		
		$expt_profit = $grand_selling_price - $grand_cost_price;

		$dynamic_lists .= "<tr>";
		$dynamic_lists .= "<td style='background-color:#CECECE; text-align: center; font-family: Adobe Heiti Std R;'>" .$quant. "</td>";
		$dynamic_lists .= "<td style='background-color:#CECECE; text-align: center; font-family: Adobe Heiti Std R;'>" .$grand_cost_price. "</td>";
		$dynamic_lists .= "<td style='background-color:#CECECE; text-align: center; font-family: Adobe Heiti Std R;'>".$grand_selling_price. "</td>";
		$dynamic_lists .= "</tr>";
		
		
		
	} else {
		?><script type="text/javascript">
		alert ('Please enter date');
		window.location = 'stockvaluation.php';
		</script><?php
	}
	
	$_SESSION['expt_profit'] = $expt_profit;
			
	
	
	
}
?>
<!doctype html>
<html>
<link href="http://localhost/buth_net/pharmacySection/css/buth_net.css" rel="stylesheet" type="text/css">
<head>
<meta charset="utf-8">
<link rel="shortcut icon" href="/favicon.ico" >
<title>Welcome Admin</title>
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
	 <?php include_once "admin_nav.php"; ?>
    </ul>
	 <img src="images/drugs.png" width="170px" height="250px" style="margin-left: 20px" alt="Welcome To School of Nursing"><br><br>
	 <?php include_once "../new_bar.php"; ?>
      <!-- end .sidebar1 --></div>
     <div class="margin" id="content">
	  <div class="welcome_message">
	   <h1 style='text-align: center; font-family: tahoma; font-size: 16px; text-transform: uppercase; font-weight: bold; background-color: #000000; color: #CECECE'>Welcome <?php echo $name."!" . " "; ?>What would you like to do today?</h1>
	     <h2 style='text-align: center; font-family: Calibri (Body); font-size: 22px; font-weight: bold; text-transform: uppercase; font-style: normal; color: #880000; text-shadow: 0 1px 0 #ccc,0 2px 0 #c9c9c9,0 3px 0 #bbb,0 4px 0 #b9b9b9,0 5px 0 #aaa,0 6px 1px rgba(0,0,0,.1),0 0 5px rgba(0,0,0,.1),0 1px 3px rgba(0,0,0,.3),0 3px 5px rgba(0,0,0,.2),0 5px 10px rgba(0,0,0,.25),0 10px 10px rgba(0,0,0,.2),0 20px 20px rgba(0,0,0,.15)'>Pharmacy Available Stocks</h2><br>
		<div class="total_earn">
		 <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
			<h2 style='margin-top: 10px; font-family: Calibri (Body); font-size: 20px; font-weight: bold; text-transform: uppercase; font-style: normal; color: #FFFFFF'>Stock Valuation Summary</h2>
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
	    <td width="13%" style='background-color:#C5DFFA; font-family: arial black; text-align: center; font-size: 14px'><b>Date Added</b></td>
		<td width="22%" style='background-color:#C5DFFA; font-family: arial black; text-align: center; font-size: 14px'><b>Drug Name</b></td>
		<td width="15%" style='background-color:#C5DFFA; font-family: arial black; text-align: center; font-size: 14px'><b>Total Qty Avail.</b></td>
		<td width="10%" style='background-color:#C5DFFA; font-family: arial black; text-align: center; font-size: 14px'><b>Unit/Selling Price N</b></td>
		<td width="10%" style='background-color:#C5DFFA; font-family: arial black; text-align: center; font-size: 14px'><b>Cost Price N</b></td>
		<td width="15%" style='background-color:#C5DFFA; font-family: arial black; text-align: center; font-size: 14px'><b>Total Cost Price N</b></td>
		<td width="15%" style='background-color:#C5DFFA; font-family: arial black; text-align: center; font-size: 14px'><b>Expd. Selling Price N</b></td>
		</tr>
		<?php echo $dynamic_list; ?>
		<!--tr>
		 <td>&nbsp;</td>
		 <td>&nbsp;</td>
		 <td>&nbsp;</td>
		 <td>&nbsp;</td>
		 <td>&nbsp;</td>
		</tr-->
		</table><br><br><br>
		<table width="760px" style="margin-left: auto; margin-right: auto" cellpadding="5" cellspacing="3" border="1">
	   <tr>
	    <td width="34%" style='background-color:#C5DFFA; font-family: arial black; text-align: center; font-size: 14px'><b>Grand Quantity</b></td>
		<td width="33%" style='background-color:#C5DFFA; font-family: arial black; text-align: center; font-size: 14px'><b>Grand Cost Price N</b></td>
		<td width="33%" style='background-color:#C5DFFA; font-family: arial black; text-align: center; font-size: 14px'><b>Grand Selling Price N</b></td>
		</tr>
		<?php echo $dynamic_lists; ?>
	    <?php
	    echo $msg;
	    ?>
		<!--tr>
		 <td>&nbsp;</td>
		 <td>&nbsp;</td>
		 <td>&nbsp;</td>
		 <td>&nbsp;</td>
		 <td>&nbsp;</td>
		</tr-->
		</table><br>
		<center><h3 class="heading_text">Expected Profit/Loss</h3></center>
		<center><input name="expt_profit" class="userarea0" type="text" value="<?php if (isset($_POST['sum'])){echo "=N" . $expt_profit;} ?>"  style="width: 150px; text-align: center; background-color: #082944; color: #FFFFFF" disabled="disabled"></center><br>
	  <form action="stock_receipt.php?from=$from_date&to=$to_date" method="GET" id="jsform" target="_blank">
		<input type="hidden" name="from_date" value="<?php echo $from_date; ?>">
		<input type="hidden" name="to_date" value="<?php echo $to_date; ?>">
		<center><input type="button" onclick="document.getElementById('jsform').submit();" class="submit4" value="Print Receipt"></center>
	  </form>
	   </div><br>
	   </div>
   <!-- end .content --></div>
  <!-- end .container --></div>
     <?php
      include_once "footer.php";
     ?>
</body>
</html>