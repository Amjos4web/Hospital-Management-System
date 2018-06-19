<?php 
session_start();
ob_start();
// error display configuration
error_reporting(E_ALL & ~E_NOTICE);

if(!isset($_SESSION['emaill'])){
	header('location: pension_login.php');
}
//This block grabs the whole list for viewing
$msg="";
$email= $_SESSION['emaill'];
include "../dbconnect2.php";
$sql="SELECT first_name, id FROM `pension_login` WHERE `emailAdd`='$email' LIMIT 1";
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
if (isset($_GET['choose_year'])){
	$choose_year = $_GET['choose_year'];
	// display the specified drugs information
	$sqlcommand2 = "SELECT `staff_id`, `basic`, `housing`, `transport`, `date`, `percentage`, `total`, `per_total`, `id` FROM `pension_form` WHERE `date` LIKE '%$choose_year%'";
	$query = mysqli_query($dbconnect, $sqlcommand2) or die (mysqli_error($dbconnect));
	$count = mysqli_num_rows($query);
	if ($count > 0){
		while($row2=mysqli_fetch_assoc($query)){
			$staff_id = $row2["staff_id"];
			$basic=$row2["basic"];
			$housing=$row2["housing"];
			$trans=$row2["transport"];
			$date=$row2["date"];
			$per=$row2["percentage"];
			$total=$row2["total"];
			$per_total=$row2["per_total"];
			
			$dynamic_list .= "<tr>";
			$dynamic_list .= "<td style='font-family: Adobe Heiti Std R; border: 1px dashed #000000'>".$staff_id . "</td>";
			$dynamic_list .= "<td style='font-family: Adobe Heiti Std R; border: 1px dashed #000000'>".$basic . "</td>";
			$dynamic_list .= "<td style='font-family: Adobe Heiti Std R; border: 1px dashed #000000'>" .$housing . "</td>";
			$dynamic_list .= "<td style='font-family: Adobe Heiti Std R; border: 1px dashed #000000'>".$trans . "</td>";
			$dynamic_list .= "<td style='font-family: Adobe Heiti Std R; border: 1px dashed #000000'>".$date . "</td>";
			$dynamic_list .= "<td style='font-family: Adobe Heiti Std R; border: 1px dashed #000000'>" .$per . "</td>";
			$dynamic_list .= "<td style='font-family: Adobe Heiti Std R; border: 1px dashed #000000'>".$per_total . "</td>";
			$dynamic_list .= "<td style='font-family: Adobe Heiti Std R; border: 1px dashed #000000'>".$total . "</td>";
			$dynamic_list .= "</tr>";

			
		} // close the while loop
	} else {
		?><script type="text/javascript">
		alert ('No result found for <?php echo $choose_year ; ?>');
		windows.locaton = 'all_pension.php';
		</script><?php
	}

	// total sum
	$sum = "SELECT  SUM(`total`) AS total_sum1 FROM `pension_form` WHERE `date` LIKE '%$choose_year%'";
	$sum2 = mysqli_query($dbconnect, $sum) or die (mysqli_error($dbconnect));
	$result1 = mysqli_fetch_array($sum2);
	$sum_total = $result1['total_sum1'];
	$_SESSION['sum_total'] = $sum_total;

	// percentage sum
	$sum = "SELECT  SUM(`per_total`) AS total_sum2 FROM `pension_form` WHERE  `date` LIKE '%$choose_year%'";
	$sum2 = mysqli_query($dbconnect, $sum) or die (mysqli_error($dbconnect));
	$result1 = mysqli_fetch_array($sum2);
	$sum_total2 = $result1['total_sum2'];
	$_SESSION['sum_tota2'] = $sum_total2;

}
   

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<link rel="shortcut icon" href="/favicon.ico" >
<title>All Pension for <?php echo $choose_year; ?></title>
</head>
<body>
<div id="requisition_receipt" style="width: 800px; min-height: 300px; margin-left: auto; margin-right: auto">
 <h1 style="text-align: center; font-size: 20px; font-family: monospace">Bowen University Teaching Hospital, Ogbomoso</h1>
 <p style="text-align: center; font-size: 16px; font-family: arial">All Pension List For <?php echo $choose_year; ?></p>
 <p style="font-family: Calibri (Body); font-weight: bold; font-size: 14px; margin-left: 33px; float: left"><?php echo date("l jS \of F Y"). "," . " " . date('H:i:s'); ?></p>
   <table width="730px" style="margin-left: auto; margin-right: auto" cellpadding="4" cellspacing="0" border="0">
	   <tr>
	    <td width="12%" style='font-family: arial black; text-align: center; font-size: 14px; border: 1px dashed #000000'><b>Staff ID</b></td>
		<td width="13%" style='font-family: arial black; text-align: center; font-size: 14px; border: 1px dashed #000000'><b>Basic N</td>
		<td width="13%" style='font-family: arial black; text-align: center; font-size: 14px; border: 1px dashed #000000'><b>Housing N</b></td>
		<td width="15%" style='font-family: arial black; text-align: center; font-size: 14px; border: 1px dashed #000000'><b>Transport N</b></td>
		<td width="14%" style='font-family: arial black; text-align: center; font-size: 14px; border: 1px dashed #000000'><b>Date</b></td>
		<td width="8%" style='font-family: arial black; text-align: center; font-size: 14px; border: 1px dashed #000000'><b>Percentage</b></td>
		<td width="12%" style='font-family: arial black; text-align: center; font-size: 14px; border: 1px dashed #000000'><b>Per. Total</b></td>
		<td width="13%" style='font-family: arial black; text-align: center; font-size: 14px; border: 1px dashed #000000'><b>Total N</b></td>
		</tr>
	<?php echo $dynamic_list; ?>
	<?php echo $msg; ?>
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
		<p style="text-align: center; font-family: monospace; font-weight: normal; font-size: 15px"><?php echo "Percentage Total" . " " ."=" ." ". "N" . $sum_total2; ?></p>
	 <p style="text-align: center; font-family: Calibri (Body); font-weight: normal; font-size: 14px">Powered By Buth ICT</p>
	</div>
  </body>
 </html>
