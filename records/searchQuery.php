<?php
include "dbconnect2.php";
$patient_search_results = "";
$msg2 = "";
// see if the posted search query field is set and has a value
if (isset($_GET['searchbtn2'])){
	if (isset($_GET['search2']) && $_GET['search2'] != ""){
		// filter the inputs
		$search = $_GET['search2'];
		//$search = preg_replace("#[^a-z 0-9?!.]#i", "", $_GET['search2']);
		$level = $_GET['level'];
		if ((empty($search) === TRUE) && ($_GET['level'] === "null")){
			?><script type='text/javascript'>
			alert ('Please fill in Hospital No and choose from the options below');
			window.location="rec_returning_patient.php";
			</script><?php
		} else if ($_GET['level'] === "nonstaff"){
			$sqlcommand2 = "SELECT `phone_no`, `hosp_no`, `sur_name`, `first_name`,`other_names`, `date_of_reg`, `age`, `gender`, `marital` AS patient FROM `patient_rec` WHERE `hosp_no` LIKE '%$search%' OR `sur_name` LIKE '%$search%' OR `phone_no` LIKE '%$search%'";
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
					$patient_search_results .= "<td style='background-color:#CECECE; font-family: Adobe Heiti Std R; text-align: center; font-size: 16px'>" . "<input type='submit' name='go' value='Forward'></td>";
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
				?><script type='text/javascript'>
				alert ('Please choose from the options below');
				window.location="rec_returning_patient.php";
				</script><?php
			}
		} else if ($_GET['level'] === "staff"){
				$sqlcommand2 = "SELECT `phoneNo`, `staff_id`, `surName`, `firstName`,`otherName`, `date_added`, `sex`, `marital` AS staff FROM `staff_record` WHERE `staff_id` LIKE '%$search%' OR `surName` LIKE '%$search%' OR `phoneNo` LIKE '%$search%'";
				$query = mysqli_query($dbconnect, $sqlcommand2) or die (mysqli_error($dbconnect));
				$count = mysqli_num_rows($query);
				if ($count > 0){
					while($row2=mysqli_fetch_array($query)){
						$sur_name=$row2["surName"];
						$first_name=$row2["firstName"];
						$other_name=$row2["otherName"];
						$hospital_no=$row2["staff_id"];
						$date_of_reg=$row2["date_added"];
						$phone_no=$row2["phone_no"];
						$gender=$row2["sex"];
						//$age=$row2["age"];
						
						$patient_search_results .= "<h2 style='margin-left: 0px; margin-top: 35px; font-family: Calibri (Body); font-size: 22px; font-weight: bold; text-transform: uppercase; font-style: normal; color: #880000; text-shadow: 0 1px 0 #ccc,0 2px 0 #c9c9c9,0 3px 0 #bbb,0 4px 0 #b9b9b9,0 5px 0 #aaa,0 6px 1px rgba(0,0,0,.1),0 0 5px rgba(0,0,0,.1),0 1px 3px rgba(0,0,0,.3),0 3px 5px rgba(0,0,0,.2),0 5px 10px rgba(0,0,0,.25),0 10px 10px rgba(0,0,0,.2),0 20px 20px rgba(0,0,0,.15)' class='info_head'>Client Account Information</h2>";
						$patient_search_results .= "<form action='success.php' method='POST'>";
						$patient_search_results .= "<tr>";
						$patient_search_results .= "<td style='background-color:#CECECE; font-family: Adobe Heiti Std R;'>" . $sur_name . " " .$first_name . " " .$other_name . "</td>";
						$patient_search_results .= "<td style='background-color:#CECECE; font-family: Adobe Heiti Std R;'>" . $hospital_no . "</td>"; 
						$patient_search_results .= "<td style='background-color:#CECECE; font-family: Adobe Heiti Std R;'>" . $phone_no . "</td>";
						$patient_search_results .= "<td style='background-color:#CECECE; font-family: Adobe Heiti Std R;'>" . $gender . "</td>";
						$patient_search_results .= "<td style='background-color:#CECECE; font-family: Adobe Heiti Std R;'>" . "<a href='patientdata.php?hospital_no=$hospital_no' style='font-style: normal; font-family: Adobe Heiti Std R; color: #880000'>Details</a></td>";
						$patient_search_results .= "<td style='background-color:#CECECE; font-family: Adobe Heiti Std R;'>" . "<input type='submit' name='go' value='Forward'></td>";
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
					?><script type='text/javascript'>
					alert ('No result found');
					window.location="rec_returning_patient.php";
					</script><?php
				}
		} else if ($_GET['level'] === "null"){
			?><script type='text/javascript'>
			alert ('Please choose from the options below');
			window.location="rec_returning_patient.php";
			</script><?php
		}
	} else {
		?><script type='text/javascript'>
		alert ('Please fill in Hospital No and choose from the options below');
		window.location="rec_returning_patient.php";
		</script><?php
	}
		
}

?>