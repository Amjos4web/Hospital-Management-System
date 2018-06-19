<?php 
session_start();
ob_start();
// error display configuration
error_reporting(E_ALL);
ini_set('display_errors','1');

if(!isset($_SESSION['emaill'])){
	header('location: ../index.php');
}
//This block grabs the whole list for viewing
$msg="";
$email= $_SESSION['emaill'];
include "dbconnect2.php";
$sql="SELECT * FROM `nurse_login` WHERE `emailAdd`='$email' LIMIT 1";
$check = mysqli_query($dbconnect, $sql);
$resultCount=mysqli_num_rows($check); //count the out amount 
if($resultCount>0){
	while($row=mysqli_fetch_array($check)){
	$id=$row["id"];
	$password=$row["passWord"];
	$name=$row["first_name"];
	}
}else{
$msg="<p style='color: red; text-align: center'>You have no Information yet in the Database</p>";
}


// delete patient from view 
if (isset($_POST['index_to_remove']) && $_POST['index_to_remove'] != ""){
	$idtoremove = $_POST['index_to_remove'];
	$delete = "DELETE FROM nurse_panel WHERE id='".$idtoremove."' LIMIT 1";
	$checkdelete = mysqli_query($dbconnect, $delete) or die (mysqli_error($dbconnect));
}

// view for patient
$hospital_data = "";
$nodata = "";
$today = date('Y-m-d');
$select = "SELECT * FROM nurse_panel WHERE date_forwarded='".$today."'";
$checkselect = mysqli_query($dbconnect, $select) or die (mysqli_error($dbconnect));
$selectResult = mysqli_num_rows($checkselect);
if ($selectResult > 0)
{
	while($row2=mysqli_fetch_array($checkselect))
	{
		$patient_name = $row2['patient_name'];
		$hos_no = $row2['patient_hosp_no'];
		$gender = $row2['gender'];
		$date_for = $row2['date_forwarded'];
		$added_by = $row2['logged_in_staff'];
		$date_of_reg = $row2['date_of_registration'];
		$patient_id = $row2['id'];
		
		$hospital_data .= "<tr>";
		$hospital_data .= "<td class='data_td'>" . $hos_no . "</td>";
		$hospital_data .= "<td class='data_td'>" . $patient_name . "</td>";
		$hospital_data .= "<td class='data_td'>" . $gender . "</td>";
		$hospital_data .= "<td class='data_td'>" . $added_by . "</td>";
		$hospital_data .= "<td class='data_td'><a href='vitalSign.php?hospital_no=".$hos_no."'>Vital Sign</a></td>";
		$hospital_data .= "<td class='data_td'><form action='nurse_dashboard.php' method='post'><input type='hidden' name='index_to_remove' value='".$patient_id."'><input type='submit' name='delete" . $patient_id . "'value='X' id='deleteBtn'></form></td>";
		$hospital_data .= "</tr>"; 
		
		
	}
} else
	$nodata = "<p style='color: #D8000C; background-color: #FFBABA; border-radius:.5em; width: 300px; border: 1px solid #D8D8D8; padding: 5px; border-radius: 5px; margin-left: auto; margin-right: auto; font-family: Arial; font-size: 11px; text-transform: uppercase; text-align: center; text-transform: uppercase'>No Patient</p>";
?>
<!doctype html>
<html>
<link href="http://10.40.255.5/buth_net/pharmacySection/css/buth_net.css" rel="stylesheet" type="text/css">
<head>
<meta charset="utf-8">
<link rel="shortcut icon" href="/favicon.ico" >
<title>Nurse Dashboard</title>
</head>
<body>
<?php
include_once "../pharmacySection/header.php";
?>
<div id="container">
  <div id="sidebar1"><br>
    <p class="subHeader">Menu</p>
    <ul id="navigation2">
	  <li class="page_title">Nurse Unit</li><br>
	  <li><a href="http://10.40.255.5/buth_net/index.php">Main Page</a></li><br>
	  <li><a href="#">ECG Form</a></li><br>
	  <li><a href="paymentVerification.php">Payment Verification</a></li><br>
	  <li><a href="logout.php">Logout</a></li><br>
    </ul>
      <!-- end .sidebar1 --></div>
     <div class="margin" id="content">
	 <h1 style='text-align: center; font-family: tahoma; font-size: 16px; text-transform: uppercase; font-weight: bold; background-color: #000000; margin-top: -5px; color: #CECECE'>Welcome Nurse <?php echo $name; ?> What would you like to do today?</h1><br>
	 <center><h3 class="heading_text">Patient Information For <?php echo date('Y-d-m'); ?></h3></center>
	   <div class="dynamic_table">
	    <?php echo $nodata; ?>
	   <table cellpadding="2" cellspacing="2">
		   <tr>
			  <td>Hospital Number</td>
			  <td>Name</td>
			  <td>Gender</td>
			  <td>Record Attendant</td>
			  <td>Other Information</td>
			  <td>Cancel</td>
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