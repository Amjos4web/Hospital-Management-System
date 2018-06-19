<?php 
session_start();
ob_start();
// error display configuration


if(!isset($_SESSION['emaill'])){
	header('location: doctors_login.php');
}
//This block grabs the whole list for viewing
$msg="";
$email= $_SESSION['emaill'];
include "dbconnect2.php";
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

$nodata = "";
$hospital_data = "";
$clinic = "Orthopaedic clinic";

// view for hospital data
$selectview = "SELECT * FROM doctor_panel WHERE clinic='".$clinic."' ORDER BY date ASC";
$checkview = mysqli_query($dbconnect, $selectview) or die (mysqli_error($dbconnect));
$checkresult = mysqli_num_rows($checkview);
if ($checkresult > 0){
	while($row=mysqli_fetch_array($checkview)){
		$pname=$row["patient_name"];
		$hos_no=$row["hosp_no"];
		$dateF=$row["date"];
		$added_by=$row["logged_in_staff"];
		
		$hospital_data .= "<tr>";
		$hospital_data .= "<td class='data_td'>" . $hos_no . "</td>";
		$hospital_data .= "<td class='data_td'>" . $pname . "</td>";
		$hospital_data .= "<td class='data_td'>" . $dateF . "</td>";
		$hospital_data .= "<td class='data_td'>" . $added_by . "</td>";
		$hospital_data .= "<td class='data_td'><a href='hospitalData.php?hospital_no=".$hos_no."' style='color: #880000; padding: 0px 0px 0px 0px; background-color: #CECECE;'>View Profile</a></td>";
		$hospital_data .= "</tr>"; 
	}
} else
	$nodata = "<p style='color: #D8000C; background-color: #FFBABA; border-radius:.5em; width: 300px; border: 1px solid #D8D8D8; padding: 5px; border-radius: 5px; margin-left: auto; margin-right: auto; font-family: Arial; font-size: 11px; text-transform: uppercase; text-align: center; text-transform: uppercase'>Nothing to display</p>";

?>
<!doctype html>
<html>
<link href="http://localhost/buth_net/pharmacySection/css/buth_net.css" rel="stylesheet" type="text/css">
<head>
<meta charset="utf-8">
<link rel="shortcut icon" href="/favicon.ico" >
<title>Orthopaedic Clinic</title>
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
	  <li><a href="doctors_dashboard.php">Home</a></li><br>
	  <li><a href="logout.php">Logout</a></li><br>
    </ul>
      <!-- end .sidebar1 --></div>
     <div class="margin" id="content">
	  <div class="welcome_message">
	   <h1 style='text-align: center; font-family: tahoma; font-size: 16px; text-transform: uppercase; font-weight: bold; background-color: #000000; margin-top: -5px; color: #CECECE'>Welcome <?php echo "Doctor" . " " .$name."!"; ?> What would you like to do today?</h1>
	    <h2 style='margin-left: 0px; font-family: Calibri (Body); font-size: 22px; font-weight: bold; text-transform: uppercase; font-style: normal; color: #880000; text-shadow: 0 1px 0 #ccc,0 2px 0 #c9c9c9,0 3px 0 #bbb,0 4px 0 #b9b9b9,0 5px 0 #aaa,0 6px 1px rgba(0,0,0,.1),0 0 5px rgba(0,0,0,.1),0 1px 3px rgba(0,0,0,.3),0 3px 5px rgba(0,0,0,.2),0 5px 10px rgba(0,0,0,.25),0 10px 10px rgba(0,0,0,.2),0 20px 20px rgba(0,0,0,.15)'>Available Patients in Orthopaedic clinic</h2>
	   </div><br>
	  <div class="dynamic_table">
	   <?php echo $nodata; ?>
	   <table cellpadding="2" cellspacing="2">
		   <tr>
			  <td>Hospital Number</td>
			  <td>Name</td>
			  <td>Date Added</td>
			  <td>Nurse Attendant</td>
			  <td>Other Info</td>
			</tr>
			<?php echo $hospital_data; ?>
			<!--tr>
			 <td>&nbsp;</td>
			 <td>&nbsp;</td>
			 <td>&nbsp;</td>
			 <td>&nbsp;</td>
			 <td>&nbsp;</td>
			</tr-->
		</table>
		</div>
	   <!-- end .content --></div>
	  <!-- end .container --></div>
     <?php
      include_once "../pharmacySection/footer.php";
     ?>
</body>
</html>