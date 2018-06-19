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
		
		$sqlcommand2 = "SELECT `phone_no`, `reg_id`, `hosp_no`, `sur_name`, `first_name`,`other_names`, `date_of_reg`, `gender`, `age` AS patient FROM `patient_rec` WHERE `hosp_no` LIKE '%$search%' OR `reg_id` LIKE '%$search%' OR `sur_name` LIKE '%$search%' OR `phone_no` LIKE '%$search%'  LIMIT 1";
		$query = mysqli_query($dbconnect, $sqlcommand2) or die (mysqli_error($dbconnect));
		$count = mysqli_num_rows($query);
		if ($count > 0){
			while($row2=mysqli_fetch_array($query)){
				$sur_name=$row2["sur_name"];
				$first_name=$row2["first_name"];
				$other_name=$row2["other_names"];
				$hospital_no=$row2["hosp_no"];
				$date_of_reg=$row2["date_of_reg"];
				$gender=$row2["gender"];
				$reg_id=$row2["reg_id"];
				
				$patient_search_results .= "<h2 style='margin-left: 0px; margin-top: 35px; font-family: Calibri (Body); font-size: 22px; font-weight: bold; text-transform: uppercase; font-style: normal; color: #880000; text-shadow: 0 1px 0 #ccc,0 2px 0 #c9c9c9,0 3px 0 #bbb,0 4px 0 #b9b9b9,0 5px 0 #aaa,0 6px 1px rgba(0,0,0,.1),0 0 5px rgba(0,0,0,.1),0 1px 3px rgba(0,0,0,.3),0 3px 5px rgba(0,0,0,.2),0 5px 10px rgba(0,0,0,.25),0 10px 10px rgba(0,0,0,.2),0 20px 20px rgba(0,0,0,.15)' class='info_head'>Patient Account Information</h2>";
				$patient_search_results .= "<form action='success.php' method='POST'>";
				$patient_search_results .= "<p style='margin-left: 295px; -moz-box-shadow:inset 0px 39px 0px -24px #e67a73; -webkit-box-shadow:inset 0px 39px 0px -24px #e67a73; box-shadow:inset 0px 39px 0px -24px #e67a73; background-color:#e4685d; -moz-border-radius:4px; -webkit-border-radius:4px; border-radius:4px; border:1px solid #ffffff; display:inline-block; color:#000000; font-family:Arial; font-size:20px; padding:5px 9px; text-decoration:none; text-shadow:0px 1px 0px #b23e35; font-style: normal'>Patient Name:"." " .$sur_name . " " . $first_name. " " ."</p>";
				$patient_search_results .= '<table width="600px" style="margin-left: auto; margin-right: auto" cellpadding="10" cellspacing="0" border="0">';
				$patient_search_results .= "<tr>";
				$patient_search_results .= "<td style='background-color:#C5DFFA; width: 50%; font-family: Adobe Heiti Std R; padding-left: 20px; font-size: 18px'><b>Patient Profile Image</b></td>";
				$patient_search_results .= "<td style='background-color:#C5DFFA; padding-left: 50px;'><img class='info_image' src='../records/passports/$reg_id.jpg' alt='".$reg_id."' width='160px' height='160px'></td>";
				$patient_search_results .= "</tr>";
				$patient_search_results .= "<tr>";
				$patient_search_results .= "<td style='background-color:#C5DFFA; width: 50%; font-family: Adobe Heiti Std R; padding-left: 20px; font-size: 18px'><b>Hospital Number</b></td>";
				$patient_search_results .= "<td style='background-color:#C5DFFA; width: 50%; font-family: Adobe Heiti Std R; padding-left: 20px; font-size: 18px'><b>".$hospital_no."</b></td>";
				$patient_search_results .= "</tr>";
				$patient_search_results .= "<tr>";
				$patient_search_results .= "<td style='background-color:#C5DFFA; width: 50%; font-family: Adobe Heiti Std R; padding-left: 20px;  font-size: 18px'><b>Gender</b></td>";
				$patient_search_results .= "<td style='background-color:#C5DFFA; width: 50%; font-family: Adobe Heiti Std R; padding-left: 20px; font-size: 18px'><b>".$gender."</b></td>";
				$patient_search_results .= "</tr>";
				$patient_search_results .= "<tr>";
				$patient_search_results .= "<td style='background-color:#C5DFFA; width: 50%; font-family: Adobe Heiti Std R; padding-left: 20px;  font-size: 18px'><b>Date Of Registration</b></td>";
				$patient_search_results .= "<td style='background-color:#C5DFFA; width: 50%; font-family: Adobe Heiti Std R; padding-left: 20px; font-size: 18px'><b>".$date_of_reg."</b></td>";
				$patient_search_results .= "</tr>";
				$patient_search_results .= "<tr>";
				$patient_search_results .= "<td style='background-color:#C5DFFA; width: 50%; font-family: Adobe Heiti Std R; text-align: center; font-size: 18px' colspan='2'><a href='patientdata.php?reg_id=".$reg_id."' style='color: #880000'>View Personal Data</a></td>";
				$patient_search_results .= "</tr>";
				$patient_search_results .= "</table><br>";
				$patient_search_results .= "<div class='forward'>";
				$patient_search_results .= "<center><h3 class='heading_text'>Forward To</h3></center>";
				$patient_search_results .= "<center><select name='doctor_to_visit' id='userarea_forward'>
										    <option value='Null'>Doctor to visit</option>
										    <option value='Doctor visit'>Doctor's visit</option>
										    <option value='Emergency'>Emergency</option>
										    <option value='Card'>Card</option>
										    <option value='Admission deposit'>Admission deposit</option>
										    <option value='Observation'>Observation</option>
										    <option value='Discharged Bill'>Discharged Bill</option>
										    <option value='Physiotherapy'>Physiotherapy</option>
										    <option value='Prothesis'>Prothesis</option>
										    <option value='X-Ray'>X-Ray</option>
										    <option value='Dental'>Dental</option>
										    <option value='Surgery'>Surgery</option>
										    <option value='Dressing'>Dressing</option>
										    <option value='Doctor visit'>Doctor's visit</option>
										    <option value='Emergency'>Emergency</option>
										    <option value='Card'>Card</option>
										    <option value='Admission deposit'>Admission deposit</option>
										    <option value='Observation'>Observation</option>
										    <option value='Discharged Bill'>Discharged Bill</option>
										    <option value='Physiotherapy'>Physiotherapy</option>
										    <option value='Prothesis'>Prothesis</option>
										    <option value='X-Ray'>X-Ray</option>
										    <option value='Dental'>Dental</option>
										    <option value='Surgery'>Surgery</option>
										    <option value='Dressing'>Dressing</option>
										    </select></center><br>";
	            $patient_search_results .= '<center><input type="submit" name="go" class="submit2" value="Go"></center>';
				$_SESSION['sur_name'] = $sur_name;
				$_SESSION['first_name'] = $first_name;
				$_SESSION['other_names'] = $other_name;
				$_SESSION['hosp_no'] = $hospital_no;
				$_SESSION['date_of_reg'] = $date_of_reg;
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