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

$hospital_data = "";
$nodata = "";
// insert data into the system
if (isset($_GET['hospital_no'])){
	$hospital_no = $_GET['hospital_no'];
	if (isset($_POST['submit'])){
		$doa = htmlspecialchars(trim($_POST['doa']));
		$wa = htmlspecialchars(trim($_POST['wa']));
		$dod = htmlspecialchars(trim($_POST['dod']));
		$los = htmlspecialchars(trim($_POST['los']));
		$dis = htmlspecialchars(trim($_POST['dis']));
		$con = htmlspecialchars(trim($_POST['con']));
		$cdr = htmlspecialchars(trim($_POST['cdr']));
		$server_date = date('Y-m-d H:i:s');
		
		if (empty($doa && $wa && $dod && $los && $dis && $con && $cdr) == false) 
		{
			if ((preg_match("/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/", $doa) && (preg_match("/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/", $dod))))
			{
			  $sql = "INSERT INTO `hospital_data` (`logged_in_staff`, `server_date`, `date_of_admission`, `ward_admitted`, `date_of_discharge`, `lenght_of_stay`, `disposal`, `consultant`, `cured_died_referred`, `hosp_no`) VALUES ('$name', '$server_date', '$doa', '$wa', '$dod', '$los', '$dis', '$con', '$cdr', '$hospital_no')";
			  $check = mysqli_query($dbconnect, $sql) or die(mysqli_error($dbconnect));
			  $msg= "<p style = 'color: #4F8A10; margin-right: auto; margin-right: auto; text-align: center; background-color: #DFF2BF; border-radius:.5em; width: 400px; border: 1px solid #D8D8D8; margin-left: auto; margin-right: auto; padding: 5px; border-radius: 5px; font-family: Arial; font-size: 11px; text-transform: uppercase; text-transform: uppercase'>Operation Successful</p>";
			  header ("refresh: 3; url=hospitalData.php?hospital_no=".$hospital_no."");
			} else
				$msg = "<p style='color: #D8000C; background-color: #FFBABA; border-radius:.5em; width: 300px; border: 1px solid #D8D8D8; padding: 5px; border-radius: 5px; margin-left: auto; margin-right: auto; font-family: Arial; font-size: 11px; text-transform: uppercase; text-align: center; text-transform: uppercase'>Date format should be YYYY-MM-DD</p>";
		} else
			$msg = "<p style='color: #D8000C; background-color: #FFBABA; border-radius:.5em; width: 300px; border: 1px solid #D8D8D8; padding: 5px; border-radius: 5px; margin-left: auto; margin-right: auto; font-family: Arial; font-size: 11px; text-transform: uppercase; text-align: center; text-transform: uppercase'>Please fill all fields</p>";
	}
} else
$msg = "<p style='color: #D8000C; background-color: #FFBABA; border-radius:.5em; width: 300px; border: 1px solid #D8D8D8; padding: 5px; border-radius: 5px; font-family: Arial; margin-left: auto; margin-right: auto; font-size: 11px; text-transform: uppercase; text-align: center; text-transform: uppercase'>Error has occured... Please try again</p>";

// view for hospital data
$selectview = "SELECT * FROM hospital_data WHERE hosp_no='".$hospital_no."'";
$checkview = mysqli_query($dbconnect, $selectview) or die (mysqli_error($dbconnect));
$checkresult = mysqli_num_rows($checkview);
if ($checkresult > 0){
	while($row=mysqli_fetch_array($checkview)){
		$dateOfAd=$row["date_of_admission"];
		$ward=$row["ward_admitted"];
		$dateOfDis=$row["date_of_discharge"];
		$lenghtOfStay=$row["lenght_of_stay"];
		$disposal=$row["disposal"];
		$consultant=$row["consultant"];
		$curedRef=$row["cured_died_referred"];
		$added_by=$row["logged_in_staff"];
		
		$hospital_data .= "<tr>";
		$hospital_data .= "<td class='data_td'>" . $dateOfAd . "</td>";
		$hospital_data .= "<td class='data_td'>" . $ward . "</td>";
		$hospital_data .= "<td class='data_td'>" . $dateOfDis . "</td>";
		$hospital_data .= "<td class='data_td'>" . $lenghtOfStay . "</td>";
		$hospital_data .= "<td class='data_td'>" . $disposal . "</td>";
		$hospital_data .= "<td class='data_td'>" . $consultant . "</td>";
		$hospital_data .= "<td class='data_td'>" . $curedRef . "</td>";
		$hospital_data .= "<td class='data_td'>" . $added_by . "</td>";
		$hospital_data .= "</tr>"; 
	}
} else
	$nodata = "<p style='color: #D8000C; background-color: #FFBABA; border-radius:.5em; width: 300px; border: 1px solid #D8D8D8; padding: 5px; border-radius: 5px; margin-left: auto; margin-right: auto; font-family: Arial; font-size: 11px; text-transform: uppercase; text-align: center; text-transform: uppercase'>No Hospital Data</p>";
?>
<!doctype html>
<html>
<link href="http://localhost/buth_net/pharmacySection/css/buth_net.css" rel="stylesheet" type="text/css">
<head>
<meta charset="utf-8">
<link rel="shortcut icon" href="/favicon.ico" >
<title>Patient Hospital Data</title>
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
	  <div id="personalty">
	    <ul>
		  <li id="gen"><a href="hospitalData.php?hospital_no=<?php echo $hospital_no; ?>">Hospital Data</a></li>
		  <li id="staff"><a href="diagnosis.php?hospital_no=<?php echo $hospital_no; ?>">Diagnosis</a></li>
		  <li id="sem"><a href="operations.php?hospital_no=<?php echo $hospital_no; ?>">Operation</a></li>
		  <li id="nhis"><a href="comments.php?hospital_no=<?php echo $hospital_no; ?>">Doctors' Comments</a></li>
		  <!--<li id="vital"><a href="vitalsign.php?hospital_no=<?php echo $hospital_no; ?>">Vital Sign</a></li>-->
	    </ul>
	  </div><br><br>
	  <div class="bio_data">
		<div class="rec_new_form">
			 <form action="" method="post" enctype="multipart/form-data">
			 <div class="form_data">
			 <center><h3 class="heading_text">Patient Hospital Data</h3></center>
			 <?php echo $msg; ?>
			 <table width="450px" style="margin-left: auto; margin-right: auto;" cellpadding="5" cellspacing="0" border="1">
			 <tr>
			   <td width="30%"><label>Date Of Admission</label></td>
			   <td width="70%"><input type="text" id="userarea" name="doa" placeholder="YYYY-MM-DD" value= "<?=@$doa?>"></td>
			  </tr>
			  <tr>
			   <td width="30%"><label>Ward Admitted</label></td>
			   <td width="70%"><input type="text" id="userarea" name="wa" value= "<?=@$wa?>"></td>
			  </tr>
			  <tr>
			   <td width="30%"><label>Date Of Discharge</label></td>
			   <td width="70%"><input type="text" id="userarea" name="dod" placeholder="YYYY-MM-DD" value= "<?=@$dod?>"></td>
			  </tr>
			  <tr>
			   <td width="30%"><label>Lenght of stay</label></td>
			   <td width="70%"><input type="text" id="userarea" name="los" value= "<?=@$los?>"></td>
			  </tr>
			  <tr>
			   <td width="30%"><label>Disposal</label></td>
			   <td width="70%"><input type="text" id="userarea" name="dis" value= "<?=@$dis?>"></td>
			  </tr>
			  <tr>
			   <td width="30%"><label>Consultant</label></td>
			   <td width="70%"><input type="text" id="userarea" name="con" value= "<?=@$con?>"></td>
			  </tr>
			  <tr>
			   <td width="30%"><label>Cured/Died Referred</label></td>
			   <td width="70%"><input type="text" id="userarea" name="cdr" value= "<?=@$cdr?>"></td>
			  </tr>
			 </table><br>		  
			</div>
		</div>
	 </div><br>
	   <center><input type="submit" value="Add" name="submit" id="rec_submit"></center><br>
	   </form>
	   <div class="dynamic_table">
	   <?php echo $nodata; ?>
	   <table cellpadding="2" cellspacing="2">
		   <tr>
			  <td>Date Of Admission</td>
			  <td>Ward Admitted</td>
			  <td>Date of Discharge</td>
			  <td>Lenght of stay</td>
			  <td>Disposal</td>
			  <td>Consultant</td>
			  <td>Cured/Died Referred</td>
			  <td>Added By</td>
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