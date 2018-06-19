<?php
// display the specified information
$display = "SELECT * FROM `nhis_income` WHERE `date` >= '$from_date' AND `date` <= '$to_date' AND `pay_mode`='" . $_POST['filter'] . "'";
$displayCheck = mysqli_query($dbconnect, $display) or die (mysqli_error($dbconnect));
$displayResult = mysqli_num_rows($displayCheck);
if ($displayResult > 0){
	while($row=mysqli_fetch_assoc($displayCheck)){
		$date = $row['date'];
		$hmo = $row['hmo'];
		$amt = $row['amount3'];
		$pay_mode = $row['pay_mode'];
		
		
		
		$dynamic_list .= "<tr>";
		$dynamic_list .= "<td style='background-color:#CECECE; text-align: center; font-family: Adobe Heiti Std R;'>" .$date . "</td>";
		$dynamic_list .= "<td style='background-color:#CECECE; text-align: center; font-family: Adobe Heiti Std R;'>".$hmo . "</td>";
		$dynamic_list .= "<td style='background-color:#CECECE; text-align: center; font-family: Adobe Heiti Std R;'>".$pay_mode. "</td>";
		$dynamic_list .= "<td style='background-color:#CECECE; text-align: center; font-family: Adobe Heiti Std R;'>".$amt . "</td>";
		$dynamic_list .= "</tr>";
		$dynamic_lists = "<h1 style='font-family: monospace; color: #880000'>"."Selected Results For". " " .$_POST['filter']."</h1>";
		

	}
} else {
	$msg="<center><p style = 'color: #D8000C; background-color: #FFBABA; border-radius:.5em; width: 400px; border: 1px solid #D8D8D8; padding: 5px; border-radius: 5px; font-family: Arial; font-size: 11px; text-transform: uppercase; text-align: center; text-transform: uppercase; padding-left: 12px'>No result found for ".$_POST['filter']."</p></center>";
}

$sum = "SELECT  SUM(`amount3`) AS total_sum1 FROM `nhis_income` WHERE `date` >= '$from_date' AND `date` <= '$to_date' AND `pay_mode`='" . $_POST['filter'] . "'";
$sum2 = mysqli_query($dbconnect, $sum) or die (mysqli_error($dbconnect));
$result1 = mysqli_fetch_array($sum2);
$sum_total = $result1['total_sum1'];
$_SESSION['sum_total'] = $sum_total;
?>