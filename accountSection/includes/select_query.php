<?php
// display the specified information
$display = "SELECT * FROM `transactions` WHERE `payment_date` >= '$from_date' AND `payment_date` <= '$to_date' AND `paid_for`='" . $_POST['filter'] . "'";
$displayCheck = mysqli_query($dbconnect, $display) or die (mysqli_error($dbconnect));
$displayResult = mysqli_num_rows($displayCheck);
if ($displayResult > 0){
	while($row=mysqli_fetch_assoc($displayCheck)){
		$date = $row['payment_date'];
		$receipt_no = $row['receipt_no1'];
		$total_income = $row['total_amount'];
		$paid_for = $row['paid_for'];
		$signed = $row['received_by'];
		
		
		
		$dynamic_list .= "<tr>";
		$dynamic_list .= "<td style='background-color:#CECECE; text-align: center; font-family: Adobe Heiti Std R;'>" .$date . "</td>";
		$dynamic_list .= "<td style='background-color:#CECECE; text-align: center; font-family: Adobe Heiti Std R;'>".$receipt_no . "</td>";
		$dynamic_list .= "<td style='background-color:#CECECE; text-align: center; font-family: Adobe Heiti Std R;'>".$signed . "</td>";
		$dynamic_list .= "<td style='background-color:#CECECE; text-align: center; font-family: Adobe Heiti Std R;'>".$paid_for. "</td>";
		$dynamic_list .= "<td style='background-color:#CECECE; text-align: center; font-family: Adobe Heiti Std R;'>N" .$total_income . "</td>";
		$dynamic_list .= "</tr>";
		$dynamic_lists = "<h1 style='font-family: monospace; color: #880000'>"."Selected Results For". " " .$_POST['filter']."</h1>";
		

	}
} else {
	$msg="<center><p style = 'color: #D8000C; background-color: #FFBABA; border-radius:.5em; width: 400px; border: 1px solid #D8D8D8; padding: 5px; border-radius: 5px; font-family: Arial; font-size: 11px; text-transform: uppercase; text-align: center; text-transform: uppercase; padding-left: 12px'>No result found for ".$_POST['filter']."</p></center>";
}

$sum = "SELECT  SUM(`total_amount`) AS total_sum1 FROM `transactions` WHERE `payment_date` >= '$from_date' AND `payment_date` <= '$to_date' AND `paid_for`='" . $_POST['filter'] . "'";
$sum2 = mysqli_query($dbconnect, $sum) or die (mysqli_error($dbconnect));
$result1 = mysqli_fetch_array($sum2);
$sum_total = $result1['total_sum1'];
$_SESSION['sum_total'] = $sum_total;
?>