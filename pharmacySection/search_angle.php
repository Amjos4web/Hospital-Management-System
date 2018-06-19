<?php
include "dbconnect2.php";
$patient_search_results = "";
$msg2 = "";
// see if the posted search query field is set and has a value
if (isset($_POST['searchbtn2'])){
	if (isset($_POST['search2']) && $_POST['search2'] != ""){
		// filter the inputs
		$search = $_POST['search2'];
		$search = preg_replace("#[^a-z 0-9?!.]#i", "", $_POST['search2']);
		
		$sqlcommand2 = "SELECT `patient_name`, `total_amount`, `hospital_no`, `paid_for`, `payment_date` AS patient FROM `transactions` WHERE `hospital_no` LIKE '%$search%'";
		$query = mysqli_query($dbconnect, $sqlcommand2) or die (mysqli_error($dbconnect));
		$count = mysqli_num_rows($query);
		if ($count > 0){
			while($row2=mysqli_fetch_array($query)){
				$payment_id = ["id"];
				$patient_name=$row2["patient_name"];
				$hospital_no=$row2["hospital_no"];
				$total_amount=$row2["total_amount"];
				$paid_for=$row2["paid_for"];
				
				
				$patient_search_results .= "<h2 style='margin-left: 0px; margin-top: 35px; font-family: Calibri (Body); font-size: 22px; font-weight: bold; text-transform: uppercase; font-style: normal; color: #880000; text-shadow: 0 1px 0 #ccc,0 2px 0 #c9c9c9,0 3px 0 #bbb,0 4px 0 #b9b9b9,0 5px 0 #aaa,0 6px 1px rgba(0,0,0,.1),0 0 5px rgba(0,0,0,.1),0 1px 3px rgba(0,0,0,.3),0 3px 5px rgba(0,0,0,.2),0 5px 10px rgba(0,0,0,.25),0 10px 10px rgba(0,0,0,.2),0 20px 20px rgba(0,0,0,.15)'>Patient Account Information</h2>";
				$patient_search_results .= "<p style='margin-left: 295px; -moz-box-shadow:inset 0px 39px 0px -24px #e67a73; -webkit-box-shadow:inset 0px 39px 0px -24px #e67a73; box-shadow:inset 0px 39px 0px -24px #e67a73; background-color:#e4685d; -moz-border-radius:4px; -webkit-border-radius:4px; border-radius:4px; border:1px solid #ffffff; display:inline-block; color:#000000; font-family:Arial; font-size:20px; padding:5px 9px; text-decoration:none; text-shadow:0px 1px 0px #b23e35; font-style: normal'>Patient Name:"." " .$patient_name."</p>";
				$patient_search_results .= '<table width="600px" style="margin-left: auto; margin-right: auto" cellpadding="10" cellspacing="0" border="0">';
				$patient_search_results .= "<tr>";
				$patient_search_results .= "<td style='background-color:#C5DFFA; width: 50%; font-family: Adobe Heiti Std R; padding-left: 20px; font-size: 18px'><b>Hospital Number</b></td>";
				$patient_search_results .= "<td style='background-color:#C5DFFA; width: 50%; font-family: Adobe Heiti Std R; padding-left: 20px; font-size: 18px'><b>".$hospital_no."</b></td>";
				$patient_search_results .= "</tr>";
				$patient_search_results .= "<tr>";
				$patient_search_results .= "<td style='background-color:#C5DFFA; width: 50%; font-family: Adobe Heiti Std R; padding-left: 20px;  font-size: 18px'><b>Being pay for</b></td>";
				$patient_search_results .= "<td style='background-color:#C5DFFA; width: 50%; font-family: Adobe Heiti Std R; padding-left: 20px; font-size: 18px'><b>".$paid_for."</b></td>";
				$patient_search_results .= "</tr>";
				$patient_search_results .= "<tr>";
				$patient_search_results .= "<td style='background-color:#C5DFFA; width: 50%; font-family: Adobe Heiti Std R; padding-left: 20px;  font-size: 18px'><b>Total Amount To Pay</b></td>";
				$patient_search_results .= "<td style='background-color:#C5DFFA; width: 50%; font-family: Adobe Heiti Std R; padding-left: 20px; font-size: 18px'><b>N".$total_amount."</b></td>";
				$patient_search_results .= "</tr>";
				$patient_search_results .= "</table><br>";
				$patient_search_results .= '<label class="back"><a href="account.php">Back</a></label>';
	            $patient_search_results .= '<input type="button" onclick="" class="submit2" value="Pay">';
				
				$_SESSION['search2'] = $search;
	            
            } // close the while loop
		} else {
			$msg2 .= "<p style='color: #880000; font-size: 18px; margin-left: 5px'>No result found for <b>$search</b></p>";
			$msg2 .= '<center><label><a href="account.php" style="font-size: 24px; font-family: impact; font-style: normal">Back</a></label></center>';
	}
} else {
	$msg2 .= "<p style='color: #880000; font-size: 18px; margin-left: 5px'>No result found for <b>empty search</b></p>";
	$msg2 .= '<center><label><a href="account.php" style="font-size: 24px; font-family: impact; font-style: normal">Back</a></label></center>';
}
}

?>