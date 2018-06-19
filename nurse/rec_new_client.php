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

$query = "SELECT `id`,`states` FROM `states`";
$result1 = mysqli_query($dbconnect,$query)or die(mysqli_error($dbconnect));
$rows = mysqli_num_rows($result1);
if ($rows){
  while($row = mysqli_fetch_assoc($result1)){
    $states[] = array("id" => $row['id'], "val" => $row['states']);
  }
}

$query3 = "SELECT `id`, `state_id`, `local_government` FROM `local_governments`";
$result2 = mysqli_query($dbconnect,$query3) or die(mysqli_error($dbconnect));
$rows2 = mysqli_num_rows($result2);
if ($rows2){
  while($row2 = mysqli_fetch_assoc($result2)){
	$local_government[$row2['state_id']][] = array("id" => $row2['id'], "val" => $row2['local_government']);
  }

  $jsonStates = json_encode($states);
  $jsonLocal_government = json_encode($local_government);
}


if (isset($_POST['submit'])){
	$reg_id =  date('ym') . "000";
	$hosp_no = htmlspecialchars(trim($_POST['hosp_no']));
	$sur_name = htmlspecialchars(trim($_POST['sur_name']));
	$first_name = htmlspecialchars(trim($_POST['first_name']));
	$other_names = htmlspecialchars(trim($_POST['other_names']));
	$gender = htmlspecialchars(trim($_POST['gender']));
	$age = htmlspecialchars(trim($_POST['age']));
	$occu = htmlspecialchars(trim($_POST['occu']));
	$marital = htmlspecialchars(trim($_POST['marital']));
	$add_of_em = htmlspecialchars(trim($_POST['add_of_em']));
	$dob = htmlspecialchars(trim($_POST['dob']));
	$dor = htmlspecialchars(trim($_POST['dor']));
	$nationality = htmlspecialchars(trim($_POST['nationality']));
	$stateOforigin = htmlspecialchars(trim($_POST['stateOforigin']));
	$homeTown = htmlspecialchars(trim($_POST['homeTown']));
	$LGA = htmlspecialchars(trim($_POST['LGA']));
	$religion = htmlspecialchars(trim($_POST['religion']));
	$phoneNo = (trim($_POST['phoneNo']));
	$homeAddress = htmlspecialchars(trim($_POST['homeAddress']));
	$spon_name = htmlspecialchars(trim($_POST['spon_name']));
	$spon_rel = htmlspecialchars(trim($_POST['spon_rel']));
	$spon_add = htmlspecialchars(trim($_POST['spon_add']));
	$spon_phone = htmlspecialchars(trim($_POST['spon_phone']));
	$referred_by = htmlspecialchars(trim($_POST['referred']));
	$xray_no = htmlspecialchars(trim($_POST['xray']));
	$server_date = date('Y-m-d H:i:s');
	
	if (empty($sur_name && $first_name && $other_names && $gender && $age && $occu && $marital && $add_of_em && $dob && $nationality && $stateOforigin && $homeTown && $LGA && $religion && $phoneNo && $homeAddress && $spon_add && $spon_name && $spon_phone && $spon_phone && $xray_no) == false) 
	{
		
		// check if hospital number exit; 
		// $select="SELECT * FROM `patient_rec` WHERE `hosp_no`='$hosp_no' LIMIT 1";
		// $check3 = mysqli_query($dbconnect, $select) or die(mysqli_error($dbconnect));
		// $checkResult = mysqli_num_rows($check3);
		// if($checkResult == 0)
		// {
		    if (strlen($_POST['homeAddress']) < 50)
			{
				if ((preg_match("/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/", $dob) && (preg_match("/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/", $dor))))
				{
				  if (preg_match("/^[0-9]{11}$/", $phoneNo))
					{
						if (empty($_FILES['passport']['name']) == false) {
							$name = $_FILES['passport']['name']; 
							$tmp_name = $_FILES['passport']['tmp_name']; 
							$type = $_FILES['passport']['type']; 
							$size = $_FILES['passport']['size']; 
							list($width, $height, $typeb, $attr) = getimagesize($tmp_name); 

							if($width<=160 || $height<=160) 
							{ 
								if($type=='image/jpeg' || $type=='image/jpg' || $type=='image/png' )
								{ 
									if(!($size>'20000')) { 
										if(!get_magic_quotes_gpc()){ 
											$name = addslashes($name); 
										 
											$extract = fopen($tmp_name, 'r'); 
											$content = fread($extract, $size); 
											$content = addslashes($content); 
											fclose($extract);  
											$sql = "INSERT INTO `patient_rec` (`server_date`, `reg_id`, `hosp_no`, `sur_name`, `first_name`, `other_names`, `gender`, `date_of_birth`, `date_of_reg`, `age`, `marital`, `occupation`, `nameAddOfEmp`, `nationality`, `state_of_origin`, `local_gov`, `home_town`, `religion`, `phone_no`, `res_add`, `next_of_kinName`, `next_of_kinAdd`, `next_of_kinRel`, `next_of_kinPhn`, `referred_by`, `x-ray_no`) VALUES ('$server_date', '$reg_id', '$hosp_no', '$sur_name', '$first_name', '$other_names', '$gender', '$dob', '$dor', '$age', '$marital', '$occu', '$add_of_em', '$nationality', '$stateOforigin', '$LGA', '$homeTown', '$religion', '$phoneNo', '$homeAddress', '$spon_name', '$spon_add', '$spon_rel', '$spon_phone', '$referred_by', '$xray_no')";
											$check = mysqli_query($dbconnect, $sql) or die(mysqli_error($dbconnect));
											// select the max reg id 
											$selectmax =  "SELECT MAX(`reg_id`) AS regid FROM `patient_rec`";
											$checkmax = mysqli_query($dbconnect, $selectmax) or die (mysqli_error($dbconnect));
											$resultrow = mysqli_fetch_array($checkmax);
											$regresult = $resultrow['regid'];
											$reg_id_result = $regresult+1;
											$updateregid = "UPDATE `patient_rec` SET `reg_id`='$reg_id_result' WHERE `server_date`='" . $server_date . "'";
											$checkupdate = mysqli_query($dbconnect, $updateregid);
											// place image into the folder
											$newname="$reg_id_result.jpg";
											move_uploaded_file($_FILES['passport']['tmp_name'],"../records/passports/$newname");
											$msg= "<p style = 'color: #4F8A10; margin-right: auto; margin-right: auto; text-align: center; background-color: #DFF2BF; border-radius:.5em; width: 400px; border: 1px solid #D8D8D8; margin-left: auto; margin-right: auto; padding: 5px; border-radius: 5px; font-family: Arial; font-size: 11px; text-transform: uppercase; text-transform: uppercase'>Congratulations! Your Registration is Successful</p>";
										} else
										$msg = "<p style='color: #D8000C; background-color: #FFBABA; border-radius:.5em; width: 300px; border: 1px solid #D8D8D8; padding: 5px; border-radius: 5px; margin-left: auto; margin-right: auto; font-family: Arial; font-size: 11px; text-transform: uppercase; text-align: center; text-transform: uppercase'>Error uploading photo</p>";
									} else
									$msg = "<p style='color: #D8000C; background-color: #FFBABA; border-radius:.5em; width: 300px; border: 1px solid #D8D8D8; padding: 5px; border-radius: 5px; margin-left: auto; margin-right: auto; font-family: Arial; font-size: 11px; text-transform: uppercase; text-align: center; text-transform: uppercase'>Photo is greather than 20kb</p>";
								} else
								$msg = "<p style='color: #D8000C; background-color: #FFBABA; border-radius:.5em; width: 300px; border: 1px solid #D8D8D8; padding: 5px; border-radius: 5px; margin-left: auto; margin-right: auto; font-family: Arial; font-size: 11px; text-transform: uppercase; text-align: center; text-transform: uppercase'>File not supported</p>";
							} else
							$msg = "<p style='color: #D8000C; background-color: #FFBABA; border-radius:.5em; width: 300px; border: 1px solid #D8D8D8; padding: 5px; border-radius: 5px; margin-left: auto; margin-right: auto; font-family: Arial; font-size: 11px; text-transform: uppercase; text-align: center; text-transform: uppercase'>Photo should be 160px * 160px</p>";
						} else
						$msg = "<p style='color: #D8000C; background-color: #FFBABA; border-radius:.5em; width: 300px; border: 1px solid #D8D8D8; padding: 5px; border-radius: 5px; margin-left: auto; margin-right: auto; font-family: Arial; font-size: 11px; text-transform: uppercase; text-align: center; text-transform: uppercase'>Please upload a file</p>";
					} else
					$msg = "<p style='color: #D8000C; background-color: #FFBABA; border-radius:.5em; width: 300px; border: 1px solid #D8D8D8; padding: 5px; border-radius: 5px; margin-left: auto; margin-right: auto; font-family: Arial; font-size: 11px; text-transform: uppercase; text-align: center; text-transform: uppercase'>Phone Number should be 11 digits</p>";
				} else
				$msg = "<p style='color: #D8000C; background-color: #FFBABA; border-radius:.5em; width: 300px; border: 1px solid #D8D8D8; padding: 5px; border-radius: 5px; margin-left: auto; margin-right: auto; font-family: Arial; font-size: 11px; text-transform: uppercase; text-align: center; text-transform: uppercase'>Date of birth should be YYYY-MM-DD</p>";
			} else
			$msg = "<p style='color: #D8000C; background-color: #FFBABA; border-radius:.5em; width: 300px; border: 1px solid #D8D8D8; padding: 5px; border-radius: 5px; font-family: Arial; margin-left: auto; margin-right: auto; font-size: 11px; text-transform: uppercase; text-align: center; text-transform: uppercase'>Home Address should not be greater than 50 character</p>";
		// } else
		// $msg = "<p style='color: #D8000C; background-color: #FFBABA; border-radius:.5em; width: 300px; border: 1px solid #D8D8D8; padding: 5px; border-radius: 5px; font-family: Arial; margin-left: auto; margin-right: auto; font-size: 11px; text-transform: uppercase; text-align: center; text-transform: uppercase'>Hospital No already exit. Please try again with another one</p>";
	} else
	$msg = "<p style='color: #D8000C; background-color: #FFBABA; border-radius:.5em; width: 300px; border: 1px solid #D8D8D8; padding: 5px; border-radius: 5px; font-family: Arial; margin-left: auto; margin-right: auto; font-size: 11px; text-transform: uppercase; text-align: center; text-transform: uppercase'>Fill in the required fields</p>";
}
?>
<!doctype html>
<html>
<link href="http://localhost/buth_net/pharmacySection/css/buth_net.css" rel="stylesheet" type="text/css">
<head>
<meta charset="utf-8">
<link rel="shortcut icon" href="/favicon.ico" >
<script type="text/javascript">
<?php
echo "var states = $jsonStates; \n";
echo "var local_government = $jsonLocal_government; \n";
?>
function loadStates(){
	var select = document.getElementById("statesSelect");
	select.onchange = updateLocal_government;
	for(var i = 0; i < states.length; i++){
	  select.options[i] = new Option(states[i].val,states[i].id);
		  
	
    }
}
function updateLocal_government(){
	var statesSelect = this;
	var state_id = this.value;
	var local_governmentSelect = document.getElementById("local_governmentSelect");
	local_governmentSelect.options.length = 0; //delete all options if any present
	for(var i = 0; i < local_government[state_id].length; i++){
	  local_governmentSelect.options[i] = new Option(local_government[state_id][i].val,local_government[state_id][i].val);
	}
}

</script>
<title>New Patient Registration</title>
</head>
<body onload='loadStates()'>
<?php
include_once "../pharmacySection/header.php";
?>
<div id="container">
  <div id="sidebar1"><br>
    <p class="subHeader">Menu</p>
    <ul id="navigation2">
	  <li class="page_title">Records Unit</li><br>
	  <li><a href="http://localhost/buth_net/index.php">Main Page</a></li><br>
	  <li><a href="rec_new_client.php">New Patient</a></li><br>
	  <li><a href="rec_returning_patient.php">Find Patient</a></li><br>
	  <li><a href="logout.php">Logout</a></li><br>
    </ul>
	<?php include_once "../new_bar.php"; ?>
      <!-- end .sidebar1 --></div>
     <div class="margin" id="content">
	  <div class="bio_data">
	   <fieldset>
	    <legend>Bio-Data</legend>
	  
		  <div class="rec_new_form">
			 <form action="" method="post" enctype="multipart/form-data">
			 <div class="form_data">
			 <center><h3 class="heading_text">New Patient Identification Data (Bio-Data)</h3></center>
			 <?php echo $msg; ?>
			 <table width="450px" style="margin-left: auto; margin-right: auto;" cellpadding="5" cellspacing="0" border="1">
			 <tr>
			   <td width="30%"><label>Hospital No</label></td>
			   <td width="70%"><input type="text" id="userarea" name="hosp_no" value= "<?=@$hosp_no?>"></td>
			  </tr>
			  <tr>
			   <td width="30%"><label>Surname</label></td>
			   <td width="70%"><input type="text" id="userarea" name="sur_name" value= "<?=@$sur_name?>"></td>
			  </tr>
			  <tr>
			   <td width="30%"><label>First Name</label></td>
			   <td width="70%"><input type="text" id="userarea" name="first_name" value= "<?=@$first_name?>"></td>
			  </tr>
			  <tr>
			   <td width="30%"><label>Other Names</label></td>
			   <td width="70%"><input type="text" id="userarea" name="other_names" value= "<?=@$other_names?>"></td>
			  </tr>
			  <tr>
			   <td width="30%"><label>Sex</label></td>
			   <td width="70%"><select name="gender" id="userarea" value= "<?=@$gender?>">
			   <option value="Male">Male</option>
			   <option value="Female">Female</option></td>
			   </select>
			  </tr>
			  <tr>
			   <td width="30%"><label>Date Of Birth</label></td>
			   <td width="70%"><input type="text" id="userarea" name="dob" placeholder="YYYY-MM-DD" value= "<?=@$dob?>"></td>
			  </tr>
			  <tr>
			   <td width="30%"><label>Date Of Registration</label></td>
			   <td width="70%"><input type="text" id="userarea" name="dor" placeholder="YYYY-MM-DD" value= "<?=@$dor?>"></td>
			  </tr>
			  <tr>
			   <td width="30%"><label>Age</label></td>
			   <td width="70%"><input type="text" id="userarea" name="age" value= "<?=@$age?>"></td>
			  </tr>
			  <tr>
			   <td width="30%"><label>Marital Status</label></td>
			   <td width="70%"><select name="marital" id="userarea" value= "<?=@$marital?>">
			   <option value="Null">Select Marital Status</option>
			   <option value="Single">Single</option>
			   <option value="Married">Married</option></td>
			 </select>
			 </tr>
			  <tr>
			   <td width="30%"><label>Occupation</label></td>
			   <td width="70%"><input type="text" id="userarea" name="occu" value= "<?=@$occu?>"></td>
			  </tr>
			  <tr>
			   <td width="30%"><label>Name and Address of employee</label></td>
			   <td width="70%"><input type="text" id="userarea" name="add_of_em" value= "<?=@$add_of_em?>"></td>
			  </tr>
			 <tr>
			   <td width="30%"><label>Nationality</label></td>
			   <td width="70%"><select name="nationality" id="userarea" value= "<?=@$nationality?>">
			   <option value="Nigeria">Nigeria</option></td>
			 </select>
			 </tr>
			 <tr>
			   <td width="30%"><label>State Of Origin</label></td>
			   <td width="70%"><select name="stateOforigin" class="userarea_id" id="statesSelect" value= "<?=@$stateOforigin?>"></td></select>
			 </tr>
			 <tr>
			   <td width="30%"><label>Local Govt. Area</label></td>
			   <td width="70%"><select name="LGA" class="userarea_id" id="local_governmentSelect" value= "<?=@$LGA?>">
			   <option value="Null">Loading...</option></td>
			 </select>
			 </tr>
			 <tr>
			   <td width="30%"><label>Home Town</label></td>
			   <td width="70%"><input type="text" id="userarea" name="homeTown" value= "<?=@$homeTown?>"></td>
			 </tr>
			 <tr>
			   <td width="30%"><label>Religion</label></td>
			   <td width="70%"><select name="religion" id="userarea" value= "<?=@$religion?>">
			   <option value="Null">Select Religion</option>
			   <option value="Christian">Christian</option>
			   <option value="Muslim">Muslim</option></td>
			 </select>
			 </tr>
			 <tr>
			   <td width="30%"><label>Phone No</label></td>
			   <td width="70%"><input type="text" id="userarea" name="phoneNo" placeholder="Should not be less than 11 digits" value= "<?=@$phoneNo?>"></td>
			 </tr>
			 <tr>
			   <td width="30%"><label>Referred By (Name and Address)</label></td>
			   <td width="70%"><input type="text" id="userarea" name="referred" placeholder="Name or Address" value= "<?=@$referred?>"></td>
			 </tr>
			 <tr>
			   <td width="30%"><label>X-Ray Number</label></td>
			   <td width="70%"><input type="text" id="userarea" name="xray" placeholder="" value= "<?=@$xray?>"></td>
			 </tr>
			 <tr>
			  <tr>
			   <td width="30%"><label>Residential Address</label></td>
			   <td width="70%"><textarea type="textarea" cols="30" rows="3" id="userarea" name="homeAddress" value= "<?=@$homeAddress?>"></textarea></td>
			 </tr>
			  <tr>
			   <td width="30%"><label>Upload Passport</label></td>
			   <td width="70%"><input type="file" name="passport"></td>
			 </tr>
			 </table><br>		  
			</div>
		</div>
	  </fieldset>
	 </div><br>
	 <div class="bio_data">
	  <fieldset>
	    <legend>Next Of Kin</legend>
		<div class="rec_new_form">
		 <div class="form_data">
		 <center><h3 class="heading_text">Next of kin</h3></center>
		 <table width="450px" style="margin-left: auto; margin-right: auto;" cellpadding="5" cellspacing="0" border="1">
		  <tr>
		   <td width="30%"><label>Name</label></td>
		   <td width="70%"><input type="text" id="userarea" name="spon_name" value= "<?=@$spon_name?>"></td>
		  </tr>
		  <tr>
		   <td width="30%"><label>Relationship</label></td>
		   <td width="70%"><input type="text" id="userarea" name="spon_rel" value= "<?=@$spon_rel?>"></td>
		  </tr>
		  <tr>
		   <td width="30%"><label>Address</label></td>
		   <td width="70%"><input type="text" id="userarea" name="spon_add" value= "<?=@$spon_add?>"></td>
		  </tr>
		  <tr>
		   <td width="30%"><label>Phone No</label></td>
		   <td width="70%"><input type="text" id="userarea" name="spon_phone" value= "<?=@$spon_phone?>"></td>
		  </tr>
		  </table>
		</fieldset>
	  </div>
	   <center><input type="submit" value="Submit" name="submit" id="rec_submit"></center>
	   </form>
	  </div>
   <!-- end .content --></div>
  <!-- end .container --></div>
     <?php
      include_once "../pharmacySection/footer.php";
     ?>
</body>
</html>