<?php 
session_start();
ob_start();
// error display configuration
error_reporting(E_ALL & ~E_NOTICE);

if(!isset($_SESSION['emaill'])){
	header('location: admin_login.php');
}
//This block grabs the whole list for viewing
$msg="";
$email= $_SESSION['emaill'];
include "../pharmacySection/dbconnect2.php";
$sql="SELECT * FROM `admin` WHERE `admin_email`='$email' LIMIT 1";
$check = mysqli_query($dbconnect, $sql);
$resultCount=mysqli_num_rows($check); //count the out amount 
if($resultCount>0){
	while($row=mysqli_fetch_array($check)){
	$name=$row["name"];
	}
}else{
$msg="<p style='color: red; text-align: center'>You have no Information yet in the Database</p>";
}


$query = "SELECT `id`,`states` FROM `states`";
$result1 = mysqli_query($dbconnect,$query);
$rows = mysqli_num_rows($result1);
if ($rows){
  while($row = mysqli_fetch_assoc($result1)){
    $states[] = array("id" => $row['id'], "val" => $row['states']);
  }
}

  $query = "SELECT `id`, `state_id`, `local_government` FROM `local_governments`";
  $result2 = mysqli_query($dbconnect,$query);
  $rows2 = mysqli_num_rows($result2);
  if ($rows2){
	  while($row2 = mysqli_fetch_assoc($result2)){
		$local_government[$row2['state_id']][] = array("id" => $row2['id'], "val" => $row2['local_government']);
	  }

	  $jsonStates = json_encode($states);
	  $jsonLocal_government = json_encode($local_government);
  }
  
  
if (isset($_POST['submit'])){
	$surname = htmlspecialchars(trim($_POST['surname']));
	$firstName = htmlspecialchars(trim($_POST['firstName']));
	$otherName = htmlspecialchars(trim($_POST['otherName']));
	$gender = htmlspecialchars(trim($_POST['gender']));
	$marital = htmlspecialchars(trim($_POST['marital']));
	$maidenName = htmlspecialchars(trim($_POST['maidenName']));
	$nationality = htmlspecialchars(trim($_POST['nationality']));
	$stateOforigin = htmlspecialchars($_POST['stateOforigin']);
	$homeTown = htmlspecialchars($_POST['homeTown']);
	$LGA = htmlspecialchars($_POST['LGA']);
	$religion = htmlspecialchars(trim($_POST['religion']));
	$phoneNo = (trim($_POST['phoneNo']));
	$contactNo = (trim($_POST['contactNo']));
	$homeAddress = htmlspecialchars(trim($_POST['homeAddress']));
	$perAddress = htmlspecialchars($_POST['perAddress']);
	$denoMination = htmlspecialchars(trim($_POST['denoMination']));
	$postal = htmlspecialchars(trim($_POST['postal']));
	$staff_id = htmlspecialchars($_POST['staff_id']);
	$Dob = htmlspecialchars($_POST['Dob']);
	$job_title = htmlspecialchars($_POST['job_title']);
	$job_des = htmlspecialchars($_POST['job_des']);
	$depart = htmlspecialchars($_POST['depart']);
	$unit = htmlspecialchars($_POST['unit']);
	$salary = htmlspecialchars($_POST['salary']);
	$resume = htmlspecialchars($_POST['resume']);
	if (empty($surname && $firstName) == false) 
	{
		if ((strlen($_POST['homeAddress']) < 50) && (strlen($_POST['perAddress']) < 50))
		{
			if ((preg_match("/^[0-9]{11}$/", $phoneNo)) && (preg_match("/^[0-9]{11}$/", $contactNo))) 
			{
				
				$sql = "INSERT INTO staff_record (staff_id, surName, firstName, otherName, sex, phoneNo, contactNo, marital, maidenName, DateofBirth, natioNality, stateoforigin, homeTown, LGA, religion, homeAddress, perAddress, denoMination, postaladdress, job_title, job_des, department, unit, salary_level, resumption_date) VALUES ('$staff_id', '$surname', '$firstName', '$otherName', '$gender', '$phoneNo', '$contactNo', '$marital', '$maidenName', '$Dob', '$nationality', '$stateOforigin', '$homeTown', '$LGA', '$religion', '$homeAddress', '$perAddress', '$denoMination', '$postal', '$job_title', '$job_des', '$depart', '$unit', '$salary', '$resume')";
				$check = mysqli_query($dbconnect, $sql) or die (mysqli_error($dbconnect));
				$sql6 = "INSERT INTO staff_record2 (staff_id) VALUES ('$staff_id')";
				$check6 = mysqli_query($dbconnect, $sql6) or die (mysqli_error($dbconnect));
				$_SESSION['staff_id'] = $staff_id;
				$staff_id = $_SESSION['staff_id'];
				$msg = '<p style = "color: #4F8A10; margin-right: auto; margin-right: auto; text-align: center; background-color: #DFF2BF; border-radius:.5em; width: 400px; border: 1px solid #D8D8D8; margin-left: auto; margin-right: auto; padding: 5px; border-radius: 5px; font-family: Arial; font-size: 11px; text-transform: uppercase; text-transform: uppercase">Operation Successful.. <a href="staff_form2.php?staffId='.$staff_id.'">Continue here</a></p>';		
			} else
			$msg = "<p style='color: #D8000C; background-color: #FFBABA; border-radius:.5em; width: 300px; border: 1px solid #D8D8D8; padding: 5px; border-radius: 5px; margin-left: auto; margin-right: auto; font-family: Arial; font-size: 11px; text-transform: uppercase; text-align: center; text-transform: uppercase'>Phone Number should not be more than 11 characters</p>";
		} else
		$msg = "<p style='color: #D8000C; background-color: #FFBABA; border-radius:.5em; width: 300px; border: 1px solid #D8D8D8; padding: 5px; border-radius: 5px; font-family: Arial; margin-left: auto; margin-right: auto; font-size: 11px; text-transform: uppercase; text-align: center; text-transform: uppercase'>Home Address should not be greater than 50 characters</p>";
	} else
	$msg = "<p style='color: #D8000C; background-color: #FFBABA; border-radius:.5em; width: 300px; border: 1px solid #D8D8D8; padding: 5px; border-radius: 5px; font-family: Arial; margin-left: auto; margin-right: auto; font-size: 11px; text-transform: uppercase; text-align: center; text-transform: uppercase'>Fields should not be empty</p>";
}
?>
<!DOCTYPE html>
<html>
<head>
<link href="http://localhost/pharmacySection/css/buth_net.css" rel="stylesheet" type="text/css">
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
<title>Bio-Data/Staff</title>
</head>
<body onload='loadStates()'>
<?php
include_once "../pharmacySection/header.php";
?>
<div id="container">
  <div id="sidebar1"><br>
    <p class="subHeader">Menu</p>
    <ul id="navigation2">
	    <li class="page_title">Admin Unit</li><br>
		<li><a href="http://localhost/buth_net/index.php">Main Page</a></li><br>
		<li><a href="admin_block.php">Home Page</a></li><br>
		<li><a href="staff_form1.php">New Registration</a></li><br>
		<li><a href="view_staff.php">View Staff</a></li><br>
		<li><a href="logout.php">Logout</a></li><br>
    </ul>
	<img src="../pharmacySection/images/1.jpg" width="170px" height="250px" style="margin-left: 20px" alt="admin"><br><br>
    <!-- end .sidebar1 --></div>
  <div class="margin" id="content">
  <center><h3 class="heading_text" style="width: 400px">Staff Identification Data (Bio-Data)</h3></center><br>
		<div id="Content_Area">
		 <div class="bio_data">
		  <fieldset>
		    <legend>Bio-Data</legend>
			  <div class="form">
			   <form action="" method="post">
			   <?php echo $msg; ?>
			    <table width="470px" style="margin-left: auto; margin-right: auto; background-color: #C5DFFA" cellpadding="7" cellspacing="0" border="0">
			      <tr>
				   <td width="30%"><label>Staff Id</label></td>
				   <td width="70%"><input type="text" class="userarea" name="staff_id" value="<?=@$staff_id?>"></td>
				 </tr>
				 <tr>
				   <td width="30%"><label>Surname</label><label style="color: #880000; float: right">*</label></td>
				   <td width="70%"><input type="text" class="userarea" name="surname" value="<?=@$surname?>"></td>
				 </tr>
				 <tr>
				   <td width="30%"><label>First name</label><label style="color: #880000; float: right">*</label></td>
				   <td width="70%"><input type="text" class="userarea" name="firstName" value="<?=@$firstName?>"></td>
				 </tr>
				  <tr>
				   <td width="30%"><label>Other Names</label></td>
				   <td width="70%"><input type="text" class="userarea" name="otherName" value="<?=@$otherName?>"></td>
				 </tr>
				 <tr>
				 <td width="30%"><label>I am</label></td>
				 <td width="70%"><select name="gender" class="userarea" value= "<?=@$gender?>">
				 <option value="Male">Male</option>
				 <option value="Female">Female</option>
				 </select></td>
				 </tr>
				 <tr>
				 <td width="30%"><label>Marital Status</label></td>
				 <td width="70%"><select name="marital" class="userarea" value= "<?=@$marital?>">
				 <option value="Null">Select Marital Status</option>
				 <option value="Single">Single</option>
				 <option value="Married">Married</option>
			     <option value="Widow">Widow</option>
			     <option value="Widower">Widower</option>
			     <option value="Others">Others</option></td>
				 </select>
				 </tr>
				 <tr>
				 <td width="30%"><label>Maiden Name (If Any)</label></td>
				 <td width="70%"><input type="text" class="userarea" name="maidenName" value= "<?=@$maidenName?>" ></td>
				 </tr>
				 <tr>
				<td width="30%"><label>Date Of Birth</label></td>
			   <td width="70%"><input type="text" class="userarea" name="Dob" placeholder="YYYY-MM-DD" value= "<?=@$Dob?>" ></td>
				 </tr>
				 <tr>
				 <td width="30%"><label>Nationality</label></td>
				 <td width="70%"><select name="nationality" class="userarea" value= "<?=@$nationality?>">
				 <option value="Nigeria">Nigeria</option></td>
				 </select>
				 </tr>
				 <tr>
				 <td width="30%"><label>State Of Origin</label></td>
				 <td width="70%"><select name="stateOforigin" class="userarea" id="statesSelect" value= "<?=@$stateOforigin?>"></td></select>
				 </tr>
				 <tr>
				 <td width="30%"><label>Local Govt. Area</label></td>
				 <td width="70%"><select name="LGA" class="userarea" id="local_governmentSelect" value= "<?=@$LGA?>">
				 <option value="Null">Loading...</option></td>
				 </select>
				 </tr>
				 <tr>
				 <td width="30%"><label>Home Town</label></td>
				 <td width="70%"><input type="text" class="userarea" name="homeTown" value= "<?=@$homeTown?>"></td>
				 </tr>
				 <tr>
				 <td width="30%"><label>Religion</label></td>
				 <td width="70%"><select name="religion" class="userarea" value= "<?=@$religion?>">
				 <option value="Null">Select Religion</option>
				 <option value="Christian">Christianity</option>
				 <option value="Islam">Islam</option>
				 <option value="Traditional">Traditional</option></td>
				 </select>
				 </tr>
				 <tr>
				 <td width="30%"><label>Phone No</label></td>
				 <td width="70%"><input type="text" class="userarea" name="phoneNo" placeholder="Should not be less than 11 digits" value= "<?=@$phoneNo?>"></td>
				 </tr>
				  <tr>
				 <td width="30%"><label>Contact No</label></td>
				 <td width="70%"><input type="text" class="userarea" name="contactNo" placeholder="Should not be less than 11 digits" value= "<?=@$contactNo?>"></td>
				 </tr>
				 <tr>
				 <td width="30%"><label>Denomination</label></td>
				 <td width="70%"><input type="text" class="userarea" name="denoMination" value= "<?=@$denoMination?>"></td>
				 </tr>
				 <tr>
				 <td width="30%"><label>Permanent Home Address</label></td>
				 <td width="70%"><textarea type="textarea" cols="30" rows="3" class="userarea" name="homeAddress" value= "<?=@$homeAddress?>"></textarea></td>
				 </tr>
				  <tr>
				 <td width="30%"><label>Residential Address</label></td>
				 <td width="70%"><textarea type="textarea" cols="30" rows="3" class="userarea" name="resAddress" value= "<?=@$resAddress?>"></textarea></td>
				 </tr>
				 <tr>
			     <td width="30%"><label>Postal Address</label></td>
				 <td width="70%"><input type="text" class="userarea" name="postal" value= "<?=@$postal?>"  ></td>
				 </tr>
				</table><br>
				 <center><h3 class="heading_text" style="width: 400px">Office information</h3></center><br>
				 <table width="470px" style="margin-left: auto; margin-right: auto; background-color: #C5DFFA" cellpadding="7" cellspacing="0" border="0">
				  <tr>
				 <td width="30%"><label>Job Title</label><label style="color: #880000; float: right">*</label></td>
				 <td width="70%"><input type="text" class="userarea" name="job_title" value= "<?=@$job_title?>"></td></select>
				 </tr>
				 <tr>
				 <td width="30%"><label>Job Description</label><label style="color: #880000; float: right">*</label></td>
				 <td width="70%"><input type="text" class="userarea" name="job_des" value= "<?=@$job_des?>"></td>
				 </tr>
				 <tr>
				 <td width="30%"><label>Department</label><label style="color: #880000; float: right">*</label></td>
				 <td width="70%"><input type="text" class="userarea" name="depart" value= "<?=@$depart?>"></td>
				 </tr>
				 <tr>
				 <td width="30%"><label>Unit</label><label style="color: #880000; float: right">*</label></td>
				 <td width="70%"><input type="text" class="userarea" name="unit" value= "<?=@$unit?>"></td>
				 </tr>
				 <tr>
			     <td width="30%"><label>Resumption Date</label><label style="color: #880000; float: right">*</label></td>
				 <td width="70%"><input type="text" class="userarea" name="resume" placeholder="YYYY-MM-DD" value= "<?=@$resume?>"  ></td>
				 </tr>
				  <tr>
				 <td width="30%"><label>Salary Level</label><label style="color: #880000; float: right">*</label></td>
				 <td width="70%"><input type="textarea" class="userarea" name="salary" placeholder="Should be number only" value= "<?=@$salary?>"></td>
				 </tr>
				 </table><br>
				<center><input type="submit" value="PROCEED >>>" name="submit" id="proceed2"></center>
			</div>
		    </form>
		   </fieldset>
		 </div><br><br><br>
		</div> <!– End of Content_Area Div –>
		</div> <!– End of Tabs Div –>
   <!-- end .content --></div>
 <?php
  include_once "../pharmacySection/footer.php";
  ?>
</body>
</html>
