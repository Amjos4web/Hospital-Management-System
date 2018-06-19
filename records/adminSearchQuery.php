<?php
include "dbconnect2.php";
$patient_search_results = "";
$msg2 = "";
// see if the posted search query field is set and has a value
if (isset($_GET['searchbtn2'])){
	if (isset($_GET['search2']) && $_GET['search2'] != ""){
		// filter the inputs
		$search = $_GET['search2'];
		$search = preg_replace("#[^a-z 0-9?!.]#i", "", $_GET['search2']);
		
		$sqlcommand2 = "SELECT `phone_no`, `hosp_no`, `age`, `sur_name`, `first_name`,`other_names`, `date_of_reg`, `gender`, `marital` AS patient FROM `patient_rec` WHERE `hosp_no` LIKE '%$search%' OR `sur_name` LIKE '%$search%' OR `phone_no` LIKE '%$search%'  LIMIT 1";
		$query = mysqli_query($dbconnect, $sqlcommand2) or die (mysqli_error($dbconnect));
		$count = mysqli_num_rows($query);
		if ($count > 0){
			while($row2=mysqli_fetch_array($query)){
				$sur_name=$row2["sur_name"];
				$first_name=$row2["first_name"];
				$other_name=$row2["other_names"];
				$hospital_no=$row2["hosp_no"];
				$date_of_reg=$row2["date_of_reg"];
				$phone_no=$row2["phone_no"];
				$gender=$row2["gender"];
				$age=$row2["age"];
				
				$patient_search_results .= "<h2 style='margin-left: 0px; margin-top: 35px; font-family: Calibri (Body); font-size: 22px; font-weight: bold; text-transform: uppercase; font-style: normal; color: #880000; text-shadow: 0 1px 0 #ccc,0 2px 0 #c9c9c9,0 3px 0 #bbb,0 4px 0 #b9b9b9,0 5px 0 #aaa,0 6px 1px rgba(0,0,0,.1),0 0 5px rgba(0,0,0,.1),0 1px 3px rgba(0,0,0,.3),0 3px 5px rgba(0,0,0,.2),0 5px 10px rgba(0,0,0,.25),0 10px 10px rgba(0,0,0,.2),0 20px 20px rgba(0,0,0,.15)' class='info_head'>Client Account Information</h2>";
				$patient_search_results .= "<form action='success.php' method='POST'>";
				$patient_search_results .= "<tr>";
				$patient_search_results .= "<td style='background-color:#CECECE; font-family: Adobe Heiti Std R; text-align: center; font-size: 16px'>" . $sur_name . " " .$first_name . " " .$other_name . "</td>";
				$patient_search_results .= "<td style='background-color:#CECECE; font-family: Adobe Heiti Std R; text-align: center; font-size: 16px'>" . $hospital_no . "</td>"; 
				$patient_search_results .= "<td style='background-color:#CECECE; font-family: Adobe Heiti Std R; text-align: center; font-size: 16px'>" . $phone_no . "</td>";
				$patient_search_results .= "<td style='background-color:#CECECE; font-family: Adobe Heiti Std R; text-align: center; font-size: 16px'>" . $gender . "</td>";
				$patient_search_results .= "<td style='background-color:#CECECE; font-family: Adobe Heiti Std R; text-align: center; font-size: 16px'>" . "<a href='patientdata.php?hospital_no=$hospital_no' style='font-style: normal; font-family: Adobe Heiti Std R; color: #880000'>Details</a></td>";
				$patient_search_results .= "<td style='background-color:#CECECE; font-family: Adobe Heiti Std R; text-align: center; font-size: 16px'>" . "<a href='editpatientdata.php?hospital_no=".$hospital_no."' style='font-style: normal; font-family: Adobe Heiti Std R; color: #880000'>Edit</a>";
				$patient_search_results .= "</tr>";
				$_SESSION['sur_name'] = $sur_name;
				$_SESSION['first_name'] = $first_name;
				$_SESSION['other_names'] = $other_name;
				$_SESSION['hosp_no'] = $hospital_no;
				$_SESSION['date_of_reg'] = $date_of_reg;
				$_SESSION['gender'] = $gender;
				$patient_search_results .= "</form>";
				$patient_search_results .= "</div><br>";
				
	            
            } // close the while loop
		} else {
			$msg2 .= "<p style='color: #880000; font-size: 18px; margin-left: 5px'>No result found for <b>$search</b></p>";
			$msg2 .= '<center><label><a href="rec_returning_patient.php" style="font-size: 24px; font-family: impact; font-style: normal">Back</a></label></center>';
	}
} else {
	$msg2 .= "<p style='color: #880000; font-size: 18px; margin-left: 5px'>No result found for <b>empty search</b></p>";
	$msg2 .= '<center><label><a href="rec_returning_patient.php" style="font-size: 24px; font-family: impact; font-style: normal">Back</a></label></center>';
}
}

?>