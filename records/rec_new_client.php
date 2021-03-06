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
$sql="SELECT * FROM `users_login` WHERE `eMail`='$email' LIMIT 1";
$check = mysqli_query($dbconnect, $sql);
$resultCount=mysqli_num_rows($check); //count the out amount 
if($resultCount>0){
	while($row=mysqli_fetch_array($check)){
	$id=$row["id"];
	$password=$row["passWord"];
	$name=$row["surname"];
	}
}else{
$msg="<p style='color: red; text-align: center'>You have no Information yet in the Database</p>";
}

// select and fetch countries 
$selectCountry = "SELECT `country_code`, `country`, `dailing_code` FROM `countrycode`";
$countryResult = mysqli_query($dbconnect,$selectCountry)or die(mysqli_error($dbconnect));
$countryRows = mysqli_num_rows($countryResult);
if ($countryRows){
	while($row = mysqli_fetch_assoc($countryResult)){
		$country = $row['country'];
		$countryCode = $row['country_code'];
		$country_code_arr = array("country" => $country, "code" => $countryCode);
	}
	 
}
	
// select and fetch states	
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

$dor = date('Y-m-d H:i:s');

if (isset($_POST['submit'])){
	$hosp_no =  0;
	$sur_name = htmlspecialchars(trim($_POST['sur_name']));
	$first_name = htmlspecialchars(trim($_POST['first_name']));
	$other_names = htmlspecialchars(trim($_POST['other_names']));
	$gender = htmlspecialchars(trim($_POST['gender']));
	$occu = htmlspecialchars(trim($_POST['occu']));
	$marital = htmlspecialchars(trim($_POST['marital']));
	$add_of_em = htmlspecialchars(trim($_POST['add_of_em']));
	$dob = htmlspecialchars(trim($_POST['dob']));
	$nationality = htmlspecialchars(trim($_POST['nationality']));
	$stateOforigin = htmlspecialchars(trim($_POST['stateOforigin']));
	$homeTown = htmlspecialchars(trim($_POST['homeTown']));
	$LGA = htmlspecialchars(trim($_POST['LGA']));
	$religion = htmlspecialchars(trim($_POST['religion']));
	$phoneNo = (trim($_POST['phoneNo']));
	$homeAddress = htmlspecialchars(trim($_POST['homeAddress']));
	$perAddress = htmlspecialchars(trim($_POST['perAddress']));
	$spon_name = htmlspecialchars(trim($_POST['spon_name']));
	$spon_rel = htmlspecialchars(trim($_POST['spon_rel']));
	$spon_add = htmlspecialchars(trim($_POST['spon_add']));
	$spon_phone = htmlspecialchars(trim($_POST['spon_phone']));
	$referred_by = htmlspecialchars(trim($_POST['referred']));
	$spon_name2 = htmlspecialchars(trim($_POST['spon_name2']));
	$spon_rel2 = htmlspecialchars(trim($_POST['spon_rel2']));
	$spon_add2 = htmlspecialchars(trim($_POST['spon_add2']));
	$spon_phone2 = htmlspecialchars(trim($_POST['spon_phone2']));
	$spon_name3 = htmlspecialchars(trim($_POST['spon_name3']));
	$spon_rel3 = htmlspecialchars(trim($_POST['spon_rel3']));
	$spon_add3 = htmlspecialchars(trim($_POST['spon_add3']));
	$spon_phone3 = htmlspecialchars(trim($_POST['spon_phone3']));
	$referred_by = htmlspecialchars(trim($_POST['referred']));
	$referred_by = htmlspecialchars(trim($_POST['referred']));
	$xray_no = htmlspecialchars(trim($_POST['xray']));
	$server_date = date('Y-m-d H:i:s');
	//explode the date to get month, day and year
	
	$age = date_diff(date_create($dob), date_create('now'))->y;
	// select country
	// $selectCountry = "SELECT `id`,`country` FROM `countrycode`";
	// $countryResult = mysqli_query($dbconnect,$selectCountry)or die(mysqli_error($dbconnect));
	// $countryRows = mysqli_num_rows($countryResult);
	// if ($countryRows){
	  // while($row = mysqli_fetch_assoc($countryResult)){
		// $country[] = array("id" => $row['id'], "val" => $row['country']);
	  // }
	  // $jsoncountry = json_encode($country);
	// }

	if (empty($sur_name && $gender && $phoneNo && $occu && $marital && $religion && $homeTown && $homeAddress && $spon_name && $spon_rel && $spon_add && $spon_phone) == false) 
	{
		
		// check if hospital number exit; 
		// $select="SELECT * FROM `patient_rec` WHERE `hosp_no`='$hosp_no' LIMIT 1";
		// $check3 = mysqli_query($dbconnect, $select) or die(mysqli_error($dbconnect));
		// $checkResult = mysqli_num_rows($-check3);
		// if($checkResult == 0)
		// {
		    if (strlen($_POST['homeAddress']) <= 200)
			{
			
				if ((preg_match("/^[0-9 +-]+$/i", $phoneNo)))
				{
					$sql = "INSERT INTO `patient_rec` (`server_date`, `hosp_no`, `sur_name`, `first_name`, `other_names`, `gender`, `age`, `date_of_birth`, `date_of_reg`, `marital`, `occupation`, `nameAddOfEmp`, `nationality`, `state_of_origin`, `local_gov`, `home_town`, `religion`, `phone_no`, `res_add`, `per_add`, `next_of_kinName`, `next_of_kinAdd`, `next_of_kinRel`, `next_of_kinPhn`, `next_of_kinName2`, `next_of_kinAdd2`, `next_of_kinRel2`, `next_of_kinPhn2`, `next_of_kinName3`, `next_of_kinAdd3`, `next_of_kinRel3`, `next_of_kinPhn3`, `referred_by`, `x-ray_no`) VALUES ('$server_date', '$hosp_no', '$sur_name', '$first_name', '$other_names', '$gender', '$age', '$dob', '$dor', '$marital', '$occu', '$add_of_em', '$nationality', '$stateOforigin', '$LGA', '$homeTown', '$religion', '$phoneNo', '$homeAddress', '$perAddress', '$spon_name', '$spon_add', '$spon_rel', '$spon_phone', '$spon_name2', '$spon_add2', '$spon_rel2', '$spon_phone2', '$spon_name3', '$spon_add3', '$spon_rel3', '$spon_phone3', '$referred_by', '$xray_no')";
					$check = mysqli_query($dbconnect, $sql) or die(mysqli_error($dbconnect));
					// select the max reg id 
					$selectmax =  "SELECT MAX(`hosp_no`) AS hos_id FROM `patient_rec`";
					$checkmax = mysqli_query($dbconnect, $selectmax) or die (mysqli_error($dbconnect));
					$resultrow = mysqli_fetch_array($checkmax);
					$regresult = $resultrow['hos_id'];
					$hos_id_result = $regresult+1;
					$updatehosid = "UPDATE `patient_rec` SET `hosp_no`='$hos_id_result' WHERE `server_date`='" . $server_date . "'";
					$checkupdate = mysqli_query($dbconnect, $updatehosid);
					
					$msg= "<p style = 'color: #4F8A10; margin-right: auto; margin-right: auto; text-align: center; background-color: #DFF2BF; border-radius:.5em; width: 400px; border: 1px solid #D8D8D8; margin-left: auto; margin-right: auto; padding: 5px; border-radius: 5px; font-family: Arial; font-size: 11px; text-transform: uppercase; text-transform: uppercase'>Congratulations! Your Registration is Successful</p>";
					header ("refresh: 2; url=rec_new_client.php");
				} else
				$msg = "<p style='color: #D8000C; background-color: #FFBABA; border-radius:.5em; width: 300px; border: 1px solid #D8D8D8; padding: 5px; border-radius: 5px; margin-left: auto; margin-right: auto; font-family: Arial; font-size: 11px; text-transform: uppercase; text-align: center; text-transform: uppercase'>Only type in your mobile number</p>";
			} else
			$msg = "<p style='color: #D8000C; background-color: #FFBABA; border-radius:.5em; width: 300px; border: 1px solid #D8D8D8; padding: 5px; border-radius: 5px; font-family: Arial; margin-left: auto; margin-right: auto; font-size: 11px; text-transform: uppercase; text-align: center; text-transform: uppercase'>Home Address should not be greater than 200 character</p>";
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
<title>New Patient Registration</title>
<script src="js/jquery-1.12.3.min.js" type="text/javascript"></script>
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
<script>
$(document).ready(function(){
	$('#headkin2').click(function(){
	$('#kin2').slideDown(1000);
	});
	$('#headkin3').click(function(){
	$('#kin3').slideDown(1000);
	});
});
</script>
<script>
	$(document).ready(function() {
		$("#selectCountry").on("change", function() {
			$(".phone").val($(this).find("option:selected").attr("value")); 
		})
		
	});
</script>
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
	  <li><a href="http://10.40.255.5/buth_net/index.php">Main Page</a></li><br>
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
			   <td width="30%"><label>Surname</label><label style="color: #880000; float: right">*</label></td>
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
			   <td width="30%"><label>Sex</label><label style="color: #880000; float: right">*</label></td>
			   <td width="70%"><select name="gender" id="userarea" value= "<?=@$gender?>">
			   <option value="Male">Male</option>
			   <option value="Female">Female</option></td>
			   </select>
			  </tr>
			  <tr>
			   <td width="30%"><label>Date Of Birth</label></td>
			   <td width="70%"><input type="date" id="userarea" name="dob" placeholder="" value= "<?=@$dob?>"></td>
			  </tr>
			  <tr>
			   <td width="30%"><label>Date Of Registration</label></td>
			   <td width="70%"><input type="text" id="userarea" name="dor" placeholder="YYYY-MM-DD" value= "<?php echo $dor; ?>" disabled ></td>
			  </tr>
			  <tr>
			   <td width="30%"><label>Marital Status</label><label style="color: #880000; float: right">*</label></td>
			   <td width="70%"><select name="marital" id="userarea" value= "<?=@$marital?>">
			   <option value="Null">Select Marital Status</option>
			   <option value="Single">Single</option>
			   <option value="Married">Married</option>
			   <option value="Widow">Widow</option>
			   <option value="Widower">Widower</option>
			   <option value="Others">Others</option></td>
			 </select>
			 </tr>
			  <tr>
			   <td width="30%"><label>Occupation</label><label style="color: #880000; float: right">*</label></td>
			   <td width="70%"><input type="text" id="userarea" name="occu" value= "<?=@$occu?>"></td>
			  </tr>
			  <tr>
			   <td width="30%"><label>Name and Address of employeer</label></td>
			   <td width="70%"><textarea type="textarea" cols="30" rows="3" id="userarea" name="add_of_em" value= "<?=@$add_of_em?>"></textarea></td>
			  </tr>
			  <tr>
			    <td width="30%"><label>Nationality</label></td>
			    <td width="70%"><select name="nationality" class="userarea_id" id="selectCountry" value= "">
			  <?php
			  // select and fetch countries 
				$selectCountry1 = "SELECT `country_code`, `country`, `dailing_code` FROM `countrycode`";
				$countryResult1 = mysqli_query($dbconnect,$selectCountry1)or die(mysqli_error($dbconnect));
				$countryArray = array();
				$codeArray = array();

				while($row1 = mysqli_fetch_assoc($countryResult1)){
					$countryArray[0] = $row1['country'];
					$codeArray[0] = $row1['dailing_code'];
			  ?>
					<option value="<?php echo $codeArray[0]; ?>"><?php echo $countryArray[0]; ?></option>
						
				<?php
				}
				?>
				</td>
			 </select>
			 <tr>
			   <td width="30%"><label>Phone No</label><label style="color: #880000; float: right">*</label></td>
			   <td width="70%"><input type="text" id="userarea" name="phoneNo" class='phone' value= "" maxlength="20"></td>
			 </tr>
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
			   <td width="30%"><label>Home Town</label><label style="color: #880000; float: right">*</label></td>
			   <td width="70%"><input type="text" id="userarea" name="homeTown" value= "<?=@$homeTown?>"></td>
			 </tr>
			 <tr>
			   <td width="30%"><label>Religion</label><label style="color: #880000; float: right">*</label></td>
			   <td width="70%"><select name="religion" id="userarea" value= "<?=@$religion?>">
			   <option value="Null">Select Religion</option>
			   <option value="Christianity">Christianity</option>
			   <option value="Muslim">Islam</option>
			   <option value="Traditional">Traditional</option></td>
			 </select>
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
			   <td width="30%"><label>Residential Address</label><label style="color: #880000; float: right">*</label></td>
			   <td width="70%"><textarea type="textarea" cols="30" rows="3" id="userarea" name="homeAddress" value= "<?=@$homeAddress?>"></textarea></td>
			  </tr>
			  <tr>
			   <td width="30%"><label>Permanent Address</label></td>
			   <td width="70%"><textarea type="textarea" cols="30" rows="3" id="userarea" name="perAddress" value= "<?=@$perAddress?>"></textarea></td>
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
		   <td width="30%"><label>Name</label><label style="color: #880000; float: right">*</label></td>
		   <td width="70%"><input type="text" id="userarea" name="spon_name" value= "<?=@$spon_name?>"></td>
		  </tr>
		  <tr>
		   <td width="30%"><label>Relationship</label><label style="color: #880000; float: right">*</label></td>
		   <td width="70%"><input type="text" id="userarea" name="spon_rel" value= "<?=@$spon_rel?>"></td>
		  </tr>
		  <tr>
		   <td width="30%"><label>Address</label><label style="color: #880000; float: right">*</label></td>
		   <td width="70%"><input type="text" id="userarea" name="spon_add" value= "<?=@$spon_add?>"></td>
		  </tr>
		  <tr>
		   <td width="30%"><label>Phone No</label><label style="color: #880000; float: right">*</label></td>
		   <td width="70%"><input type="text" id="userarea" name="spon_phone" value= "<?=@$spon_phone?>"></td>
		  </tr>
		  </table>
	  </div>
	  </div><br>
	  <center><h3 class="heading_text" id='headkin2'>Next of kin 2 (Optional)</h3></center>
	  <div class="rec_new_form" style="display: none;" id='kin2'>
		 <div class="form_data">
		 <table width="450px" style="margin-left: auto; margin-right: auto;" cellpadding="5" cellspacing="0" border="1">
		  <tr>
		   <td width="30%"><label>Name</label></td>
		   <td width="70%"><input type="text" id="userarea" name="spon_name2" value= "<?=@$spon_name2?>"></td>
		  </tr>
		  <tr>
		   <td width="30%"><label>Relationship</label></td>
		   <td width="70%"><input type="text" id="userarea" name="spon_rel2" value= "<?=@$spon_rel2?>"></td>
		  </tr>
		  <tr>
		   <td width="30%"><label>Address</label></td>
		   <td width="70%"><input type="text" id="userarea" name="spon_add2" value= "<?=@$spon_add2?>"></td>
		  </tr>
		  <tr>
		   <td width="30%"><label>Phone No</label></td>
		   <td width="70%"><input type="text" id="userarea" name="spon_phone2" value= "<?=@$spon_phone2?>"></td>
		  </tr>
		  </table>
	  </div>
	  </div><br>
	  <center><h3 class="heading_text" id='headkin3'>Next of kin 3 (Optional)</h3></center>
	  <div class="rec_new_form" style="display: none;" id='kin3'>
		 <div class="form_data">
		 <table width="450px" style="margin-left: auto; margin-right: auto;" cellpadding="5" cellspacing="0" border="1">
		  <tr>
		   <td width="30%"><label>Name</label></td>
		   <td width="70%"><input type="text" id="userarea" name="spon_name3" value= "<?=@$spon_name3?>"></td>
		  </tr>
		  <tr>
		   <td width="30%"><label>Relationship</label></td>
		   <td width="70%"><input type="text" id="userarea" name="spon_rel3" value= "<?=@$spon_rel3?>"></td>
		  </tr>
		  <tr>
		   <td width="30%"><label>Address</label></td>
		   <td width="70%"><input type="text" id="userarea" name="spon_add3" value= "<?=@$spon_add3?>"></td>
		  </tr>
		  <tr>
		   <td width="30%"><label>Phone No</label></td>
		   <td width="70%"><input type="text" id="userarea" name="spon_phone3" value= "<?=@$spon_phone3?>"></td>
		  </tr>
		  </table>
		</fieldset>
	  </div>
	   <center><input type="submit" value="Submit" name="submit" id="rec_submit"></center>
	   </form>
	  </div>
	  </div>
   <!-- end .content --></div>
  <!-- end .container --></div>
     <?php
      include_once "../pharmacySection/footer.php";
     ?>
</body>
</html>