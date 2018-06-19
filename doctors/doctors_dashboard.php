<?php 
session_start();
ob_start();
// error display configuration


if(!isset($_SESSION['emaill'])){
	header('location: ../index.php');
}
//This block grabs the whole list for viewing
$msg="";
$email= $_SESSION['emaill'];
include "../dbconnect.php";
$sql="SELECT * FROM `doctors` WHERE `emailAdd`='$email' LIMIT 1";
$check = mysqli_query($dbconnect, $sql);
$resultCount=mysqli_num_rows($check); //count the out amount 
if($resultCount>0){
	while($row=mysqli_fetch_array($check)){
	$id=$row["id"];
	$doctor_password=$row["passWord"];
	$name=$row["first_name"];
	}
}else{
$msg="<p style'color: #D8000C; background-color: #FFBABA; border-radius:.5em; width: 300px; border: 1px solid #D8D8D8; padding: 5px; border-radius: 5px; margin-left: auto; margin-right: auto; font-family: Arial; font-size: 11px; text-transform: uppercase; text-align: center; text-transform: uppercase'You have no Information yet in the Database</p>";
}


$dynamic_lists = "";


// $sql2 = "SELECT * FROM `doctor_rec` ORDER BY date_forwarded DESC LIMIT 100";
// $check2 = mysqli_query($dbconnect, $sql2) or die (mysqli_error($dbconnect));
// $resultCount2=mysqli_num_rows($check2); //count the out amount 

// if($resultCount2>0){
	// while($row=mysqli_fetch_array($check2)){
	// $id=$row["id"];
	// $patient_surname=$row["patient_surname"];
	// $patient_firstname=$row["patient_firstname"];
	// $patient_lastname=$row["patient_lastname"];
	// $patient_id=$row["patient_hos_no"];
	// $date_forwarded=$row["date_forwarded"];
	// $doctor_to_attend=$row["doctor_to_visit"];

	// $dynamic_lists .= "<tr>";
	// $dynamic_lists .= "<td style='background-color:#CECECE; padding-left: 5px; font-family: Adobe Heiti Std R; font-size: 14px'>" . $patient_surname . "</td>";
	// $dynamic_lists .= "<td style='background-color:#CECECE; padding-left: 5px; font-family: Adobe Heiti Std R; font-size: 14px'>" . $patient_firstname . "</td>";
	// $dynamic_lists .= "<td style='background-color:#CECECE; padding-left: 5px; font-family: Adobe Heiti Std R; font-size: 14px'>" . $patient_lastname . "</td>";
	// $dynamic_lists .= "<td style='background-color:#CECECE; padding-left: 5px; font-family: Adobe Heiti Std R; font-size: 14px'>" . $patient_id . "</td>";
	// $dynamic_lists .= "<td style='background-color:#CECECE; padding-left: 5px; font-family: Adobe Heiti Std R; font-size: 14px'>" . $date_forwarded . "</td>";
	// $dynamic_lists .= "<td style='background-color:#CECECE; padding-left: 5px; font-family: Adobe Heiti Std R; font-size: 14px'>" .  $doctor_to_attend. "</td>";
	// $dynamic_lists .= "<td style='background-color:#CECECE; padding-left: 5px; font-family: Adobe Heiti Std R; font-size: 14px'>" . "<a href='patient_profile.php?patient_id=$patient_id' style='font-style: normal; font-family: Adobe Heiti Std R; color: #880000'>Visit Profile</a></td>";
	// $dynamic_lists .= "</tr>";
	
	// }
	
// }else{
// $msg="<p style='color: #D8000C; background-color: #FFBABA; border-radius:.5em; width: 300px; border: 1px solid #D8D8D8; padding: 5px; border-radius: 5px; margin-left: auto; margin-right: auto; font-family: Arial; font-size: 11px; text-transform: uppercase; text-align: center; text-transform: uppercase'>There is no product in the store yet</p>";
// }

?>
<!doctype html>
<html>
<link href="http://localhost/buth_net/pharmacySection/css/buth_net.css" rel="stylesheet" type="text/css">
<head>
<meta charset="utf-8">
<link rel="shortcut icon" href="/favicon.ico" >
<title>Welcome Doctor</title>
<script src="js/jquery-1.12.3.min.js" type="text/javascript"></script>
</head>
<body>
<?php
include_once "../pharmacySection/header.php";
?>
<div id="container">
  <div id="sidebar1"><br>
    <p class="subHeader">Menu</p>
    <ul id="navigation2">
	  <li class="page_title">Doctors Unit</li><br>
	  <li><a href="http://localhost/buth_net/index.php">Main Page</a></li><br>
	  <li><a href="logout.php">Logout</a></li><br>
    </ul>
      <!-- end .sidebar1 --></div>
     <div class="margin" id="content">
	  <div class="welcome_message">
	   <h1 style='text-align: center; font-family: tahoma; font-size: 16px; text-transform: uppercase; font-weight: bold; background-color: #000000; margin-top: -5px; color: #CECECE'>Welcome <?php echo "Doctor" . " " .$name."!"; ?> What would you like to do today?</h1>
	    <h2 style='margin-left: 0px; font-family: Calibri (Body); font-size: 22px; font-weight: bold; text-transform: uppercase; font-style: normal; color: #880000; text-shadow: 0 1px 0 #ccc,0 2px 0 #c9c9c9,0 3px 0 #bbb,0 4px 0 #b9b9b9,0 5px 0 #aaa,0 6px 1px rgba(0,0,0,.1),0 0 5px rgba(0,0,0,.1),0 1px 3px rgba(0,0,0,.3),0 3px 5px rgba(0,0,0,.2),0 5px 10px rgba(0,0,0,.25),0 10px 10px rgba(0,0,0,.2),0 20px 20px rgba(0,0,0,.15)'>Available Clinics</h2>
		<!--<div class="search" style="float: right; margin-right: 20px">
		 <form action="client_panell.php" method="post">
		 <input type="text" name="search" id="search" maxlength="88" placeholder="Search by name or hospital no...">
		 <input type="submit" value="Search" name="searchbtn" id="searchbtn">
		 </form>
		</div>-->
	   </div><br>
	   <div id="clinic_section">
	     <div class="clinicA">
		   <h1>Clinic A</h1>
		   <section><center><label>Gynaecology</label></center><br>
		   <center><a href='gynaecology.php' target="_blank">View</a></center></section>
		 </div>
		 <div class="clinicB">
		   <h1>Clinic B</h1>
		   <section><center><label>Medicine</label></center><br>
		   <center><a href='medicine.php' target="_blank">View</a></center></section>
		 </div>
		 <div class="clinicC">
		   <h1>Clinic C</h1>
		   <section><center><label>Ophthalmology</label></center><br>
		   <center><a href='ophthalmology.php' target="_blank">View</a></center></section>
		 </div>
		 <div class="clinicD">
		   <h1>Clinic D</h1>
		   <section><center><label>Urology</label></center><br>
		   <center><a href='urology.php' target="_blank">View</a></center></section>
		 </div>
		 <div class="clinicE">
		   <h1>Clinic E</h1>
		   <section><center><label>General Surgery</label></center><br>
		   <center><a href='generalSurgeryClinic.php' target="_blank">View</a></center></section>
		 </div>
		  <div class="clinicF">
		   <h1>Clinic F</h1>
		   <section><center><label>STI</label></center><br>
		   <center><a href='sti.php' target="_blank">View</a></center></section>
		 </div>
		  <div class="clinicG">
		   <h1>Clinic G</h1>
		   <section><center><label>Orthopaedic</label></center><br>
		   <center><a href='orthopaedic.php' target="_blank">View</a></center></section>
		 </div>
		  <div class="clinicH">
		   <h1>Clinic H</h1>
		   <section><center><label>Paediatric</label></center><br>
		   <center><a href='paediatric.php' target="_blank">View</a></center></section>
		 </div>
		 <div class="clinicI">
		   <h1>Clinic I</h1>
		   <section><center><label>Burns and Plastic</label></center><br>
		   <center><a href='burnsAndPlastic.php' target="_blank">View</a></center></section>
		 </div>
	   </div>
	   <!-- end .content --></div>
	  <!-- end .container --></div>
     <?php
      include_once "../pharmacySection/footer.php";
     ?>
</body>
</html>