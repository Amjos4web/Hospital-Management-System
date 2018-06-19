<?php 
session_start();
ob_start();
// error display configuration
error_reporting(E_ALL);
ini_set('display_errors','1');

if(!isset($_SESSION['emaill'])){
	header('location: rec_staff.php');
}
//This block grabs the whole list for viewing
$msg="";
$email= $_SESSION['emaill'];
include "dbconnect2.php";
$sql="SELECT * FROM `record_staff` WHERE `rec_staff_email`='$email' LIMIT 1";
$check = mysqli_query($dbconnect, $sql);
$resultCount=mysqli_num_rows($check); //count the out amount 
if($resultCount>0){
	while($row=mysqli_fetch_array($check)){
	$id=$row["id"];
	$password=$row["rec_staff_pass"];
	$name=$row["first_name"];
	}
}else{
$msg="<p style='color: red; text-align: center'>You have no Information yet in the Database</p>";
}

$hospital_data = "";
$nodata = "";
$comment = "";
// insert data into the system
if (isset($_GET['hospital_no'])){
	$hospital_no = $_GET['hospital_no'];
}
// view for diagnosis data
$selectview = "SELECT * FROM doctors_comment WHERE hosp_no='".$hospital_no."'";
$checkview = mysqli_query($dbconnect, $selectview) or die (mysqli_error($dbconnect));
$checkresult = mysqli_num_rows($checkview);
if ($checkresult > 0){
	while($row=mysqli_fetch_array($checkview)){
		$dateD=$row["date"];
		$Dcomment=$row["comment"];
		$added_by=$row["logged_in_staff"];
		
		$hospital_data .= "<tr>";
		$hospital_data .= "<td class='data_td'>" . $dateD . "</td>";
		$hospital_data .= "<td class='data_td'>" . $Dcomment . "</td>";
		$hospital_data .= "<td class='data_td'>" . $added_by . "</td>";
		$hospital_data .= "</tr>"; 
	}
} else
	$nodata = "<p style='color: #D8000C; background-color: #FFBABA; border-radius:.5em; width: 300px; border: 1px solid #D8D8D8; padding: 5px; border-radius: 5px; margin-left: auto; margin-right: auto; font-family: Arial; font-size: 11px; text-transform: uppercase; text-align: center; text-transform: uppercase'>No Comment</p>";
?>
<!doctype html>
<html>
<link href="http://10.40.255.5/buth_net/pharmacySection/css/buth_net.css" rel="stylesheet" type="text/css">
<head>
<meta charset="utf-8">
<link rel="shortcut icon" href="/favicon.ico" >
<title>Doctor's Comment</title>
</head>
<body>
<?php
include_once "../pharmacySection/header.php";
?>
<div id="container">
  <div id="sidebar1"><br>
    <p class="subHeader">Menu</p>
    <ul id="navigation2">
	  <li class="page_title">Records Unit</li><br>
	  <li><a href="http://10.40.255.5/buth_net/index.php">Main Page</a></li><br>
	  <li><a href="rec_new_client.php">New Patient</a></li><br>
	  <li><a href="rec_returning_patient.php">Find Patient</a></li><br>
	  <li><a href="logout.php">Logout</a></li><br>
    </ul>
	<?php include_once "../new_bar.php"; ?>
      <!-- end .sidebar1 --></div>
     <div class="margin" id="content">
	  <div id="personalty">
	    <ul>
		  <li id="gen"><a href="hospitalData.php?hospital_no=<?php echo $hospital_no; ?>">Hospital Data</a></li>
		  <li id="staff"><a href="diagnosis.php?hospital_no=<?php echo $hospital_no; ?>">Diagnosis</a></li>
		  <li id="sem"><a href="operations.php?hospital_no=<?php echo $hospital_no; ?>">Operation</a></li>
		  <li id="nhis"><a href="comments.php?hospital_no=<?php echo $hospital_no; ?>">Doctors' Comments</a></li>
		  <li id="vital"><a href="vitalsign.php?hospital_no=<?php echo $hospital_no; ?>">Vital Sign</a></li>
	    </ul>
	  </div><br><br>
			 <center><h3 class="heading_text">Vital Sign</h3></center>
	   <div class="dynamic_table">
	    <?php echo $nodata; ?>
	   <table cellpadding="2" cellspacing="2">
		   <tr>
			  <td style="width: 150px;">Date</td>
			  <td style="width: 550px; text-align: center;">Comments</td>
			  <td style="width: 80px; text-align: center;">Added By</td>
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