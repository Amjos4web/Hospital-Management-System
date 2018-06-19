<?php 
session_start();
ob_start();
// error display configuration
error_reporting(E_ALL);
ini_set('display_errors','1');

if(!isset($_SESSION['emaill'])){
	header('location: rec_admin.php');
}
//This block grabs the whole list for viewing
$msg="";
$email= $_SESSION['emaill'];
include "dbconnect2.php";
$sql="SELECT * FROM `record_admin` WHERE `rec_staff_email`='$email' LIMIT 1";
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

// get if hosp_no is set
if (isset($_GET['hospital_no'])){
    $hospital_no = $_GET['hospital_no'];

	// select to view data
	$query = "SELECT * FROM `patient_rec` WHERE `hosp_no`='$hospital_no' LIMIT 1";
	$result = mysqli_query($dbconnect,$query) or die(mysqli_error($dbconnect));
	$checkrows = mysqli_num_rows($result);
	if ($checkrows > 0){
	  while($row = mysqli_fetch_assoc($result)){
		$hospital_no = $row['hosp_no'];
		$referred_by = $row['referred_by'];
		$xray_no = $row['x-ray_no'];
		$surname = $row['sur_name'];
		$firstname = $row['first_name'];
		$othername = $row['other_names'];
		$gender = $row['gender'];
		$date_of_birth = $row['date_of_birth'];
		$date_of_reg = $row['date_of_reg'];
		$m = $row['marital'];
		$occupation = $row['occupation'];
		$nameAddOfEmp = $row['nameAddOfEmp'];
		$na = $row['nationality'];
		$state_of_origin = $row['state_of_origin'];
		$local_gov = $row['local_gov'];
		$home_town = $row['home_town'];
		$re = $row['religion'];
		$phone_no = $row['phone_no'];
		$res_add = $row['res_add'];
		$per_add = $row['per_add'];
		$next_of_kinName = $row['next_of_kinName'];
		$next_of_kinRel = $row['next_of_kinRel'];
		$next_of_kinAdd	= $row['next_of_kinAdd'];
		$next_of_kinPhn	= $row['next_of_kinPhn'];
		$next_of_kinName2 = $row['next_of_kinName2'];
		$next_of_kinRel2 = $row['next_of_kinRel2'];
		$next_of_kinAdd2 = $row['next_of_kinAdd2'];
		$next_of_kinPhn2 = $row['next_of_kinPhn2'];
		$next_of_kinName3 = $row['next_of_kinName3'];
		$next_of_kinRel3 = $row['next_of_kinRel3'];
		$next_of_kinAdd3 = $row['next_of_kinAdd3'];
		$next_of_kinPhn3 = $row['next_of_kinPhn3'];
	  }

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
	$hosp_no = htmlspecialchars(trim($_POST['hosp_no']));
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
	$contactNo = (trim($_POST['contactNo']));
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
	$referred = htmlspecialchars(trim($_POST['referred']));
	$xray_no = htmlspecialchars(trim($_POST['xray']));
	$server_date = date('Y-m-d H:i:s');
	//explode the date to get month, day and year
	
	//$age = date_diff(date_create($dob), date_create('now'))->y;
	
	if (empty($sur_name && $first_name && $other_names && $phoneNo) == false) 
	{
		if (strlen($_POST['homeAddress']) < 50)
		{
			if ((preg_match("/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/", $dob)))
			{
				if (preg_match("/^[0-9]{14}$/", $phoneNo))
				{
					$sql = "UPDATE  `patient_rec` SET `per_add`='$perAddress', `server_date`='$server_date', `hosp_no`='$hosp_no', `sur_name`='$sur_name', `first_name`='$first_name', `other_names`='$other_names', `gender`='$gender', `date_of_birth`='$dob', `date_of_reg`='$dor', `marital`='$marital', `occupation`='$occu', `nameAddOfEmp`='$add_of_em', `nationality`='$nationality', `state_of_origin`='$stateOforigin', `local_gov`='$LGA', `home_town`='$homeTown', `religion`='$religion', `phone_no`='$phoneNo', `contact_no`='$contactNo', `res_add`='$homeAddress', `next_of_kinName`='$spon_name', `next_of_kinAdd`='$spon_add', `next_of_kinRel`='$spon_rel', `next_of_kinPhn`='$spon_phone', `next_of_kinName2`='$spon_name2', `next_of_kinAdd2`='$spon_add2', `next_of_kinRel2`='$spon_rel2', `next_of_kinPhn2`='$spon_phone2', `next_of_kinName3`='$spon_name3', `next_of_kinAdd3`='$spon_add3', `next_of_kinRel3`='$spon_rel3', `next_of_kinPhn3`='$spon_phone3', `referred_by`='$referred', `x-ray_no`='$xray_no' WHERE `hosp_no`='$hospital_no' LIMIT 1";
					$check = mysqli_query($dbconnect, $sql) or die(mysqli_error($dbconnect));
					$msg= "<p style = 'color: #4F8A10; margin-right: auto; margin-right: auto; text-align: center; background-color: #DFF2BF; border-radius:.5em; width: 400px; border: 1px solid #D8D8D8; margin-left: auto; margin-right: auto; padding: 5px; border-radius: 5px; font-family: Arial; font-size: 11px; text-transform: uppercase; text-transform: uppercase'>Congratulations! Data Updated Successfully</p>";
				} else
				$msg = "<p style='color: #D8000C; background-color: #FFBABA; border-radius:.5em; width: 300px; border: 1px solid #D8D8D8; padding: 5px; border-radius: 5px; margin-left: auto; margin-right: auto; font-family: Arial; font-size: 11px; text-transform: uppercase; text-align: center; text-transform: uppercase'>Phone Number should be in correct format</p>";
			} else
			$msg = "<p style='color: =#D8000C; background-color: #FFBABA; border-radius:.5em; width: 300px; border: 1px solid #D8D8D8; padding: 5px; border-radius: 5px; margin-left: auto; margin-right: auto; font-family: Arial; font-size: 11px; text-transform: uppercase; text-align: center; text-transform: uppercase'>Date of birth should be YYYY-MM-DD</p>";
		} else
		$msg = "<p style='color: #D8000C; background-color: #FFBABA; border-radius:.5em; width: 300px; border: 1px solid #D8D8D8; padding: 5px; border-radius: 5px; margin-left: auto; margin-right: auto; font-family: Arial; font-size: 11px; text-transform: uppercase; text-align: center; text-transform: uppercase'>Home Address should not be greater than 50 character</p>";
	} else
	$msg = "<p style='color: #D8000C; background-color: #FFBABA; border-radius:.5em; width: 300px; border: 1px solid #D8D8D8; padding: 5px; border-radius: 5px; margin-left: auto; margin-right: auto; font-family: Arial; font-size: 11px; text-transform: uppercase; text-align: center; text-transform: uppercase'>Please fill in the required fields</p>";
}
?>
<!doctype html>
<html>
<link href="http://localhost/buth_net/pharmacySection/css/buth_net.css" rel="stylesheet" type="text/css">
<head>
<meta charset="utf-8">
<link rel="shortcut icon" href="/favicon.ico" >
<title>Edit Patient Data</title>
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
	  <li><a href="http://localhost/buth_net/index.php">Main Page</a></li><br>
	  <li><a href="adminrec_returning_patient.php">Find Patient</a></li><br>
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
			 <center><h3 class="heading_text">Edit Patient Identification Data (Bio-Data)</h3></center>
			 <?php echo $msg; ?>
			 <table width="450px" style="margin-left: auto; margin-right: auto;" cellpadding="5" cellspacing="0" border="1">
			 <tr>
			   <td width="30%"><label>Hospital No</label></td>
			   <td width="70%"><input type="text" id="userarea" name="hosp_no" value= "<?php echo $hospital_no; ?>"></td>
			  </tr>
			  <tr>
			   <td width="30%"><label>Surname</label></td>
			   <td width="70%"><input type="text" id="userarea" name="sur_name" value= "<?=@$surname?>"></"></td>
			  </tr>
			  <tr>
			   <td width="30%"><label>First Name</label></td>
			   <td width="70%"><input type="text" id="userarea" name="first_name" value= "<?=@$firstname?>"></td>
			  </tr>
			  <tr>
			   <td width="30%"><label>Other Names</label></td>
			   <td width="70%"><input type="text" id="userarea" name="other_names" value= "<?=@$othername?>"></td>
			  </tr>
			  <tr>
			   <td width="30%"><label>Sex</label></td>
			   <td width="70%"><select name="gender" id="userarea">
			   <option value="<?php echo $gender; ?>"><?php echo $gender; ?></option>
			   <option value="Male">Male</option>
			   <option value="Female">Female</option></td>
			   </select>
			  </tr>
			  <tr>
			   <td width="30%"><label>Date Of Birth</label></td>
			   <td width="70%"><input type="text" id="userarea" name="dob" placeholder="YYYY-MM-DD" value= "<?=@$date_of_birth?>"></td>
			  </tr>
			  <tr>
			   <td width="30%"><label>Marital Status</label></td>
			   <td width="70%"><select name="marital" id="userarea">
			   <option value="<?php echo $m; ?>"><?php echo $m; ?></option>
			   <option value="Single">Single</option>
			   <option value="Married">Married</option>
			   <option value="Widow">Widow</option>
			   <option value="Widower">Widower</option>
			   <option value="Others">Others</option></td>
			 </select>
			 </tr>
			  <tr>
			   <td width="30%"><label>Occupation</label></td>
			   <td width="70%"><input type="text" id="userarea" name="occu" value= "<?=@$occupation?>"></td>
			  </tr>
			  <tr>
			   <td width="30%"><label>Name and Address of employeer</label></td>
			   <td width="70%"><textarea type="textarea" cols="30" rows="3" id="userarea" name="add_of_em"><?php echo $nameAddOfEmp; ?></textarea></td>
			  </tr>
			 <tr>
			   <td width="30%"><label>Nationality</label></td>
			   <td width="70%"><select name="nationality" class="userarea_id" id="selectCountry">
			   <option value="<?php echo $na; ?>"><?php echo $na; ?></option></td>
			 </select>
			 </tr>
			 <tr>
			   <td width="30%"><label>Phone No</label></td>
			   <td width="70%"><input type="text" id="userarea" class="phone" name="phoneNo" placeholder="" value= "<?php echo $phone_no; ?>"></td>
			 </tr>
			 <tr>
			   <td width="30%"><label>State Of Origin</label></td>
			   <td width="70%"><select name="stateOforigin" class="userarea_id" id="statesSelect" value= "">
			   <option value="<?php echo $state_of_origin; ?>"><?php echo $state_of_origin; ?></option></td></select>
			 </tr>
			 <tr>
			   <td width="30%"><label>Local Govt. Area</label></td>
			   <td width="70%"><select name="LGA" class="userarea_id" id="local_governmentSelect">
			   <option value="<?php echo $local_gov; ?>"><?php echo $local_gov; ?></option>
			 </select>
			 </tr>
			 <tr>
			   <td width="30%"><label>Home Town</label></td>
			   <td width="70%"><input type="text" id="userarea" name="homeTown" value= "<?=@$home_town?>"></td>
			 </tr>
			 <tr>
			   <td width="30%"><label>Religion</label></td>
			   <td width="70%"><select name="religion" id="userarea">
			   <option value="<?php echo $re; ?>"><?php echo $re; ?></option>
			   <option value="Christianity">Christianity</option>
			   <option value="Muslim">Islam</option>
			   <option value="Traditional">Traditional</option></td>
			 </select>
			 </tr>
			 
			 <tr>
			   <td width="30%"><label>Referred By (Name and Address)</label></td>
			   <td width="70%"><input type="text" id="userarea" name="referred" placeholder="Name or Address" value= "<?=@$referred_by?>"></td>
			 </tr>
			 <tr>
			   <td width="30%"><label>X-Ray Number</label></td>
			   <td width="70%"><input type="text" id="userarea" name="xray" placeholder="" value= "<?=@$xray_no?>"></td>
			 </tr>
			 <tr>
			  <tr>
			   <td width="30%"><label>Residential Address</label></td>
			   <td width="70%"><textarea type="textarea" cols="30" rows="3" id="userarea" name="homeAddress"><?php echo $res_add; ?></textarea></td>
			 </tr>
			 <tr>
			   <td width="30%"><label>Permanent Address</label></td>
			   <td width="70%"><textarea type="textarea" cols="30" rows="3" id="userarea" name="perAddress"><?php echo $per_add; ?></textarea></td>
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
		   <td width="70%"><input type="text" id="userarea" name="spon_name" value= "<?=@$next_of_kinName?>"></td>
		  </tr>
		  <tr>
		   <td width="30%"><label>Relationship</label></td>
		   <td width="70%"><input type="text" id="userarea" name="spon_rel" value= "<?=@$next_of_kinRel?>"></td>
		  </tr>
		  <tr>
		   <td width="30%"><label>Address</label></td>
		   <td width="70%"><input type="text" id="userarea" name="spon_add" value= "<?=@$next_of_kinAdd?>"></td>
		  </tr>
		  <tr>
		   <td width="30%"><label>Phone No</label></td>
		   <td width="70%"><input type="text" id="userarea" name="spon_phone" value= "<?=@$next_of_kinPhn?>"></td>
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
		   <td width="70%"><input type="text" id="userarea" name="spon_name2" value= "<?=@$next_of_kinName2?>"></td>
		  </tr>
		  <tr>
		   <td width="30%"><label>Relationship</label></td>
		   <td width="70%"><input type="text" id="userarea" name="spon_rel2" value= "<?=@$next_of_kinRel2?>"></td>
		  </tr>
		  <tr>
		   <td width="30%"><label>Address</label></td>
		   <td width="70%"><input type="text" id="userarea" name="spon_add2" value= "<?=@$next_of_kinAdd2?>"></td>
		  </tr>
		  <tr>
		   <td width="30%"><label>Phone No</label></td>
		   <td width="70%"><input type="text" id="userarea" name="spon_phone2" value= "<?=@$next_of_kinPhn2?>"></td>
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
		   <td width="70%"><input type="text" id="userarea" name="spon_name3" value= "<?=@$next_of_kinName3?>"></td>
		  </tr>
		  <tr>
		   <td width="30%"><label>Relationship</label></td>
		   <td width="70%"><input type="text" id="userarea" name="spon_rel3" value= "<?=@$next_of_kinRel3?>"></td>
		  </tr>
		  <tr>
		   <td width="30%"><label>Address</label></td>
		   <td width="70%"><input type="text" id="userarea" name="spon_add3" value= "<?=@$next_of_kinAdd3?>"></td>
		  </tr>
		  <tr>
		   <td width="30%"><label>Phone No</label></td>
		   <td width="70%"><input type="text" id="userarea" name="spon_phone3" value= "<?=@$next_of_kinPhn3?>"></td>
		  </tr>
		  </table>
		</fieldset>
	  </div>
	   <center><input type="submit" value="Change" name="submit" id="rec_submit"></center>
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