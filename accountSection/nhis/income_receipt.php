<?php 
session_start();
ob_start();
// error display configuration
error_reporting(E_ALL & ~E_NOTICE);

if(!isset($_SESSION['emaill'])){
	header('location: nhis_form.php');
}
//This block grabs the whole list for viewing
$msg="";
$email= $_SESSION['emaill'];
include "../dbconnect2.php";
$sql="SELECT first_name, id FROM `nhis_form` WHERE `emailAdd`='$email' LIMIT 1";
$check = mysqli_query($dbconnect, $sql);
$resultCount=mysqli_num_rows($check); //count the out amount 
if($resultCount>0){
	while($row=mysqli_fetch_array($check)){
		$id=$row["id"];
		$name=$row["first_name"];
	}
}else{
	$msg="<p style='color: red; text-align: center'>You have no Information yet in the Database</p>";
}
?>
<?php
$dynamic_list = "";
if (isset($_GET['from_date']) && ($_GET['to_date'])){
	$from_date = $_GET['from_date'];
	$to_date = $_GET['to_date'];
	$to_filter = $_GET['filter'];
	
	// display the specified drugs information
	$display = "SELECT * FROM `nhis_income` WHERE `date` >= '$from_date' AND `date` <= '$to_date' AND `pay_mode`='" . $to_filter . "'";
	$displayCheck = mysqli_query($dbconnect, $display) or die (mysqli_error($dbconnect));
	$displayResult = mysqli_num_rows($displayCheck);
	if ($displayResult > 0){
		while($row=mysqli_fetch_assoc($displayCheck)){
			$date = $row['date'];
			$hmo = $row['hmo'];
			$amt = $row['amount3'];
			$pay_mode = $row['pay_mode'];
			
			
			
			$dynamic_list .= "<tr>";
			$dynamic_list .= "<td style='text-align: center; font-family: Adobe Heiti Std R; border: 1px dashed #000000'>" .$date . "</td>";
			$dynamic_list .= "<td style='text-align: center; font-family: Adobe Heiti Std R; border: 1px dashed #000000'>".$hmo . "</td>";
			$dynamic_list .= "<td style='text-align: center; font-family: Adobe Heiti Std R; border: 1px dashed #000000'>".$pay_mode. "</td>";
			$dynamic_list .= "<td style='text-align: center; font-family: Adobe Heiti Std R; border: 1px dashed #000000'>".$amt . "</td>";
			$dynamic_list .= "</tr>";
			

		}
	} 
	// sum for total_amount
	 $sum_total = $_SESSION['sum_total'];
}
	 
if (isset($_GET['from_date']) && ($_GET['to_date']) && ($_GET['filter']) == "all"){	
	$from_date = $_GET['from_date'];
	$to_date = $_GET['to_date'];
	$to_filter = $_GET['filter']; 
	 // display the specified information
	$display = "SELECT * FROM `nhis_income` WHERE `date` >= '$from_date' AND `date` <= '$to_date'";
	$displayCheck = mysqli_query($dbconnect, $display) or die (mysqli_error($dbconnect));
	$displayResult = mysqli_num_rows($displayCheck);
	if ($displayResult > 0){
		while($row=mysqli_fetch_assoc($displayCheck)){
			$date = $row['date'];
			$hmo = $row['hmo'];
			$amt = $row['amount3'];
			$pay_mode = $row['pay_mode'];
			
			
			
			$dynamic_list .= "<tr>";
			$dynamic_list .= "<tr>";
			$dynamic_list .= "<td style='text-align: center; font-family: Adobe Heiti Std R; border: 1px dashed #000000'>" .$date . "</td>";
			$dynamic_list .= "<td style='text-align: center; font-family: Adobe Heiti Std R; border: 1px dashed #000000'>".$hmo . "</td>";
			$dynamic_list .= "<td style='text-align: center; font-family: Adobe Heiti Std R; border: 1px dashed #000000'>".$pay_mode. "</td>";
			$dynamic_list .= "<td style='text-align: center; font-family: Adobe Heiti Std R; border: 1px dashed #000000'>".$amt . "</td>";
			$dynamic_list .= "</tr>";
			

		}
	} else {
		$msg="<center><p style = 'color: #D8000C; background-color: #FFBABA; border-radius:.5em; width: 400px; border: 1px solid #D8D8D8; padding: 5px; border-radius: 5px; font-family: Arial; font-size: 11px; text-transform: uppercase; text-align: center; text-transform: uppercase; padding-left: 12px'>No result found for ".$to_filter."</p></center>";
	}

	$sum = "SELECT  SUM(`amount3`) AS total_sum1 FROM `nhis_income` WHERE `date` >= '$from_date' AND `date` <= '$to_date'";
	$sum2 = mysqli_query($dbconnect, $sum) or die (mysqli_error($dbconnect));
	$result1 = mysqli_fetch_array($sum2);
	$sum_total = $result1['total_sum1'];
}
   

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<link rel="shortcut icon" href="/favicon.ico" >
<title>Income Summary for <?php echo $to_filter; ?></title>
</head>
<body>
<div id="requisition_receipt" style="width: 800px; min-height: 300px; margin-left: auto; margin-right: auto">
 <h1 style="text-align: center; font-size: 24px; font-family: monospace">Bowen University Teaching Hospital, Ogbomoso</h1>
 <p style="text-align: center; font-size: 16px; font-family: arial">Income Summary For <?php echo $to_filter; ?> From: <?php echo $from_date. " "; ?>To:<?php echo " " . $to_date; ?></p>
 <p style="font-family: Calibri (Body); font-weight: bold; font-size: 14px; margin-left: 75px; float: left"><?php echo date("l jS \of F Y"). "," . " " . date('H:i:s'); ?></p>
   <table width="650px" style="margin-left: auto; margin-right: auto" cellpadding="5" cellspacing="3" border="0">
	   <tr>
	    <td width="21%" style='font-family: arial black; text-align: center; font-size: 14px; border: 1px dashed #000000'><b>Date</b></td>
	    <td width="27%" style='font-family: arial black; text-align: center; font-size: 14px; border: 1px dashed #000000'><b>HMO</b></td>
		<td width="27%" style='font-family: arial black; text-align: center; font-size: 14px; border: 1px dashed #000000'><b>Payment Mode</b></td>
		<td width="25%" style='font-family: arial black; text-align: center; font-size: 14px; border: 1px dashed #000000'><b>Amount N</b></td>
	</tr>
	<?php echo $msg; ?>
	<?php echo $dynamic_list; ?>
	<!--tr>
	 <td>&nbsp;</td>
	 <td>&nbsp;</td>
	 <td>&nbsp;</td>
	 <td>&nbsp;</td>
	 <td>&nbsp;</td>
	 <td>&nbsp;</td>
	</tr-->
	</table><br>
		<p style="text-align: center; font-family: monospace; font-weight: normal; font-size: 15px"><?php echo "Total" . " " ."=" ." ". "N" . $sum_total; ?></p>
	 <p style="text-align: center; font-family: Calibri (Body); font-weight: normal; font-size: 14px">Powered By Buth ICT</p>
	</div>
  </body>
 </html>
