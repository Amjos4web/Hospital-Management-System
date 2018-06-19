<?php 
session_start(); 
ob_start();
 if (!isset($_SESSION['emaill']))
	{
		header('location: login.php');
	} else {
		$emaill = $_SESSION['emaill'];
	}
//error_reporting(E_ALL & ~E_NOTICE);
// This block grabs the whole list for viewing
$msg="";
include "dbconnect.php";
$sql="SELECT * FROM `sono` WHERE `eMail`='$emaill' LIMIT 1";
$check = mysqli_query($dbconnect, $sql);
$resultCount=mysqli_num_rows($check); //count the out amount 
if($resultCount>0){
	while($row=mysqli_fetch_array($check)){
	$email=$row["eMail"];
	$studentID=$row["studentid"];
	$surname=$row["surName"];
	$otherNames=$row["otherName"];
	$firstNames=$row["firstName"];
	}
}else{
$msg="<p style='color: #D8000C; background-color: #FFBABA; border-radius:.5em; width: 300px; border: 1px solid #D8D8D8; padding: 5px; border-radius: 5px; margin-left: auto; margin-right: auto; font-family: Arial; font-size: 11px; text-transform: uppercase; text-align: center; text-transform: uppercase'>You have no Information yet in the Database</p>";
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
	$gender = htmlspecialchars(trim($_POST['gender']));
	$marital = htmlspecialchars(trim($_POST['marital']));
	$maidenName = htmlspecialchars(trim($_POST['maidenName']));
	$Dob = htmlspecialchars(trim($_POST['Dob']));
	$nationality = htmlspecialchars(trim($_POST['nationality']));
	$stateOforigin = htmlspecialchars(trim($_POST['stateOforigin']));
	$homeTown = htmlspecialchars(trim($_POST['homeTown']));
	$LGA = htmlspecialchars(trim($_POST['LGA']));
	$religion = htmlspecialchars(trim($_POST['religion']));
	$phoneNo = (trim($_POST['phoneNo']));
	$homeAddress = htmlspecialchars(trim($_POST['homeAddress']));
	$denoMination = htmlspecialchars(trim($_POST['denoMination']));
	$postal = htmlspecialchars(trim($_POST['postal']));
	
	if (empty($gender && $Dob && $nationality && $stateOforigin && $homeTown && $LGA && $religion && $phoneNo && $homeAddress && $denoMination && $postal) == false) 
	{
	  if (strlen($_POST['homeAddress']) < 50)
	  {
		  if (preg_match("/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/", $Dob))
		  {
			  if (preg_match("/^[0-9]{11}$/", $phoneNo))
				  {
					$sql = "UPDATE `sono` SET `sex`='$gender', `marital`='$marital', `maidenName`='$maidenName', `DateofBirth`='$Dob', `natioNality`='$nationality', `stateOforigin`='$stateOforigin', `homeTown`='$homeTown', `LGA`='$LGA', `religion`='$religion', `phoneNo`='$phoneNo', `homeAddress`='$homeAddress', `denoMination`='$denoMination', `postaladdress`='$postal' WHERE `eMail`='$email'";
					$check = mysqli_query($dbconnect, $sql);
					header ('location: form2.php');		
				    } else
				    $msg = "<p style='color: #D8000C; background-color: #FFBABA; border-radius:.5em; width: 300px; border: 1px solid #D8D8D8; padding: 5px; border-radius: 5px; margin-left: auto; margin-right: auto; font-family: Arial; font-size: 11px; text-transform: uppercase; text-align: center; text-transform: uppercase'>Phone Number should be 11 digits</p>";
		            } else
				    $msg = "<p style='color: #D8000C; background-color: #FFBABA; border-radius:.5em; width: 300px; border: 1px solid #D8D8D8; padding: 5px; border-radius: 5px; margin-left: auto; margin-right: auto; font-family: Arial; font-size: 11px; text-transform: uppercase; text-align: center; text-transform: uppercase'>Date of birth should be YYYY-MM-DD</p>";
				    } else
				    $msg = "<p style='color: #D8000C; background-color: #FFBABA; border-radius:.5em; width: 300px; border: 1px solid #D8D8D8; padding: 5px; border-radius: 5px; font-family: Arial; margin-left: auto; margin-right: auto; font-size: 11px; text-transform: uppercase; text-align: center; text-transform: uppercase'>Home Address should not be greater than 50 character</p>";
				    } else
				    $msg = "<p style='color: #D8000C; background-color: #FFBABA; border-radius:.5em; width: 300px; border: 1px solid #D8D8D8; padding: 5px; border-radius: 5px; font-family: Arial; margin-left: auto; margin-right: auto; font-size: 11px; text-transform: uppercase; text-align: center; text-transform: uppercase'>All fields are required</p>";
}
?>
<!DOCTYPE html>
<html>
<link href="http://localhost/buth_net/nursingSchool/css/buth_net.css" rel="stylesheet" type="text/css">
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
<title>Bio-Data/School of Nursing</title>
</head>
<body onload='loadStates()'>
<?php
include_once "header.php";
?>
<div id="container">
  <div id="sidebar1"><br>
    <p class="subHeader">Menu</p>
    <ul id="navigation2">
	  <li class="page_title">School Of Nursing</li><br>
	  <li><a href="index.php">Homepage</a></li><br>
      <li><a href="register.php">Register</a></li><br>
      <li><a href="login.php">Login</a></li><br>
    </ul>
	<img src="images/Bowen1.jpg" width="170px" height="250px" style="margin-left: 20px" alt="Welcome To School of Nursing"><br><br>
	 <?php include_once "../new_bar.php"; ?>
    <!-- end .sidebar1 --></div>
  <div class="margin" id="content">
    <div id="Tabs">
	 <ul>
		<li id="li_tab1" class="current_tab"><a href="form1.php">BIO-DATA</a></li>
		<li id="li_tab2"><a href="form2.php">NEXT OF KIN & SPONSOR</a></li>
		<li id="li_tab3"><a href="education.php">EDUCATION BACKGROUND</a></li>
		<li id="li_tab4"><a href="results.php">O'LEVEL RESULTS</a></li>
		</ul><br><br><br>
		<div id="Content_Area">
		 <div class="bio_data">
		  <fieldset>
		    <legend>Bio-Data</legend>
			  <div class="form">
			   <form action="" method="post">
			   <?php
			   echo $msg;
			   ?>
			    <table width="450px" style="margin-left: auto; margin-right: auto; background-color: #C5DFFA" cellpadding="7" cellspacing="0" border="0">
			     <tr>
				   <td width="30%"><label>Surname</label></td>
				   <td width="70%"><input type="text" class="userarea" name="surName" disabled="disabled" value="<?php echo $surname; ?>"></td>
				 </tr>
				 <tr>
				   <td width="30%"><label>First name</label></td>
				   <td width="70%"><input type="text" class="userarea" name="firstName" disabled="disabled" value="<?php echo $firstNames; ?>"></td>
				 </tr>
				  <tr>
				   <td width="30%"><label>Other Name</label></td>
				   <td width="70%"><input type="text" class="userarea" name="otherName" disabled="disabled" value="<?php echo $otherNames; ?>"></td>
				 </tr>
				 <tr>
				 <td width="30%"><label>I am</label></td>
				 <td width="70%"><select name="gender" class="userarea" value= "<?=@$gender?>">
				 <option value="Male">Male</option>
				 <option value="Female">Female</option></td>
				 </select>
				 </tr>
				 <tr>
				 <td width="30%"><label>Marital Status</label></td>
				 <td width="70%"><select name="marital" class="userarea" value= "<?=@$marital?>">
				 <option value="Null">Select Marital Status</option>
				 <option value="Single">Single</option>
				 <option value="Married">Married</option></td>
				 </select>
				 </tr>
				 <tr>
				 <td width="30%"><label>Maiden Name (If Any)</label></td>
				 <td width="70%"><input type="text" class="userarea" name="maidenName" value= "<?=@$maidenName?>" ></td>
				 </tr>
				 <tr>
				 <td width="30%"><label>Date of Birth</label></td>
				 <td width="70%"><input type="text" class="userarea" name="Dob" placeholder="YYYY-MM-DD" value= "<?=@$Dob?>"></td>
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
				 <option value="Christian">Christian</option>
				 <option value="Muslim">Muslim</option></td>
				 </select>
				 </tr>
				 <tr>
				 <td width="30%"><label>Phone No</label></td>
				 <td width="70%"><input type="text" class="userarea" name="phoneNo" placeholder="Should not be less than 11 digits" value= "<?=@$phoneNo?>"></td>
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
			     <td width="30%"><label>Postal Address</label></td>
				 <td width="70%"><input type="text" class="userarea" name="postal"value= "<?=@$postal?>"  ></td>
				 </tr>
				</table><br>
				<center><input type="submit" value="PROCEED >>>" name="submit" id="proceed"></center>
			</div>
		    </form>
		   </fieldset>
		 </div>
		</div> <!– End of Content_Area Div –>
		</div> <!– End of Tabs Div –>
	 </div>
   <!-- end .content --></div>
 <?php
  include_once "footer.php";
  ?>
</body>
</html>
