<?php
include "dbconnect2.php";
$patient_search_results = "";
$patient_search_result = "";
$msg2 = "";
// see if the posted search query field is set and has a value
if (isset($_POST['searchbtn2'])){
	if (isset($_POST['search2']) && $_POST['search2'] != ""){
		// filter the inputs
		$search = $_POST['search2'];
		$search = preg_replace("#[^a-z 0-9?!.]#i", "", $_POST['search2']);
		
		$sqlcommand2 = "SELECT patient_name, total_amount, total_amount2, hospital_no, paid_for, payment_date, server_time AS patient FROM `transactions` WHERE hospital_no LIKE '%$search%' AND payment_status IS NULL OR payment_status='NULL' ORDER BY payment_date DESC";
		$query = mysqli_query($dbconnect, $sqlcommand2) or die (mysqli_error($dbconnect));
		$count = mysqli_num_rows($query);
		if ($count > 0){
			while($row2=mysqli_fetch_array($query)){
				$payment_id = ["id"];
				$patient_name=$row2["patient_name"];
				$hospital_no2=$row2["hospital_no"];
				$total_amount=$row2["total_amount"];
				$per=$row2["total_amount2"];
				$paid_for=$row2["paid_for"];
				$payment_date=$row2["payment_date"];
				
				$patient_search_results .= "<form action='' method='POST'>";
				$patient_search_results .= "<h2 style='margin-left: 0px; margin-top: 35px; font-family: Calibri (Body); font-size: 22px; font-weight: bold; text-transform: uppercase; font-style: normal; color: #880000; text-shadow: 0 1px 0 #ccc,0 2px 0 #c9c9c9,0 3px 0 #bbb,0 4px 0 #b9b9b9,0 5px 0 #aaa,0 6px 1px rgba(0,0,0,.1),0 0 5px rgba(0,0,0,.1),0 1px 3px rgba(0,0,0,.3),0 3px 5px rgba(0,0,0,.2),0 5px 10px rgba(0,0,0,.25),0 10px 10px rgba(0,0,0,.2),0 20px 20px rgba(0,0,0,.15)'>Patient Account Information</h2>";
				$patient_search_results .= "<p style='margin-left: 295px; -moz-box-shadow:inset 0px 39px 0px -24px #e67a73; -webkit-box-shadow:inset 0px 39px 0px -24px #e67a73; box-shadow:inset 0px 39px 0px -24px #e67a73; background-color:#e4685d; -moz-border-radius:4px; -webkit-border-radius:4px; border-radius:4px; border:1px solid #ffffff; display:inline-block; color:#000000; font-family:Arial; font-size:20px; padding:5px 9px; text-decoration:none; text-shadow:0px 1px 0px #b23e35; font-style: normal'>Patient Name:"." " .$patient_name."</p>";
				$patient_search_results .= '<table width="600px" style="margin-left: auto; margin-right: auto" cellpadding="10" cellspacing="0" border="0">';
				$patient_search_results .= "<tr>";
				$patient_search_results .= "<td style='background-color:#C5DFFA; width: 50%; font-family: Adobe Heiti Std R; padding-left: 20px; font-size: 18px'><b>Hospital Number</b></td>";
				$patient_search_results .= "<td style='background-color:#C5DFFA; width: 50%; font-family: Adobe Heiti Std R; padding-left: 20px; font-size: 18px'><b>".$hospital_no2."</b></td>";
				$patient_search_results .= "</tr>";
				$patient_search_results .= "<tr>";
				$patient_search_results .= "<td style='background-color:#C5DFFA; width: 50%; font-family: Adobe Heiti Std R; padding-left: 20px; font-size: 18px'><b>Payment Date</b></td>";
				$patient_search_results .= "<td style='background-color:#C5DFFA; width: 50%; font-family: Adobe Heiti Std R; padding-left: 20px; font-size: 18px'><b>".$payment_date."</b></td>";
				$patient_search_results .= "</tr>";
				$patient_search_results .= "<tr>";
				$patient_search_results .= "<td style='background-color:#C5DFFA; width: 50%; font-family: Adobe Heiti Std R; padding-left: 20px;  font-size: 18px'><b>Being pay for</b></td>";
				$patient_search_results .= "<td style='background-color:#C5DFFA; width: 50%; font-family: Adobe Heiti Std R; padding-left: 20px; font-size: 18px'><b>".$paid_for."</b></td>";
				$patient_search_results .= "</tr>";
				$patient_search_results .= "<tr>";
				$patient_search_results .= "<td style='background-color:#C5DFFA; width: 50%; font-family: Adobe Heiti Std R; padding-left: 20px;  font-size: 18px'><b>Total Amount To Pay</b></td>";
				$patient_search_results .= "<td style='background-color:#C5DFFA; width: 50%; font-family: Adobe Heiti Std R; padding-left: 20px; font-size: 18px'><b>N".$total_amount."</b></td>";
				$patient_search_results .= "</tr>";
				$patient_search_results .= "<tr>";
				$patient_search_results .= "<td style='background-color:#C5DFFA; width: 50%; font-family: Adobe Heiti Std R; padding-left: 20px;  font-size: 18px'><b>Percentage Off</b></td>";
				$patient_search_results .= "<td style='background-color:#C5DFFA; width: 50%; font-family: Adobe Heiti Std R; padding-left: 20px; font-size: 18px'><b>N".$per."</b></td>";
				$patient_search_results .= "</tr>";
				$patient_search_results .= "</table><br>";
				$patient_search_results .= '<input type="submit" value="X" name="cancel" style="background-color: #880000; color: #fff; width: 50px; margin-left: 100px;" onclick="return confirm("Are you sure you want to CANCEL this transaction record?")>';
	            $patient_search_results .= '<input type="button" class="submit" style="float: right; margin-right: 100px; background-color: green; color: #fff; width: 80px;" value="Pay" onclick="myFunction()">';
				$patient_search_results .= "</form>";
				
				$_SESSION['search2'] = $search;
				$_SESSION['hospital_no2'] = $hospital_no2;
	            
            }
			// close the while loop
		}
	}
}

// cancel the transactions record
if (isset($_POST['cancel'])){
	?><script type="text/javascript">
		confirm ('Are you sure you want to CANCEL this transaction record?');
	</script><?php
	
	$cancel = "Canceled";
	$hospital_no2 = $_SESSION['hospital_no2'];
	
	// select which to transaction to cancel
	$selectcancel = "SELECT hospital_no FROM transactions WHERE `hospital_no`='".$hospital_no2."' LIMIT 1";
	$checksc = mysqli_query($dbconnect, $selectcancel) or die (mysqli_error($dbconnect));
	$checkscr = mysqli_num_rows($checksc);
	if ($checkscr > 0){
		while ($row = mysqli_fetch_array($checksc)){
			$hosp_no = $row['hospital_no'];
		}
	}
	
	// update transaction
	$csql = "UPDATE transactions SET `payment_status`='".$cancel."' WHERE `hospital_no`='".$hosp_no."' LIMIT 1";
	$checksql = mysqli_query($dbconnect, $csql) or die (mysqli_error($dbconnect));
	if ($checksql == TRUE){
		$msg2 = "<p style='color: #880000; font-size: 20px; text-align: center;'>Transaction <b>canceled</b></p>";
		header ('refresh: 2; url=account.php');
	}
}
?>