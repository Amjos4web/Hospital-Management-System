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
		$Surname=$row["surName"];
		$otherNames=$row["otherName"];
		$firstNames=$row["firstName"];
		$MaidenName=$row["maidenName"];
		$Gender=$row["sex"];
		$Marital=$row["marital"];
		$NatioNality=$row["natioNality"];
		$StateOforigin=$row["stateoforigin"];
		$lGA=$row["LGA"];
		$HomeTown=$row["homeTown"];
		$HomeAddress=$row["homeAddress"];
		$PhoneNo=$row["phoneNo"];
		$Religion=$row["religion"];
		$Postal=$row["postaladdress"];
		$DenoMination=$row["denoMination"];
		$Dateofbirth=$row["DateofBirth"];
	}
}else{
$msg="<p style='color: red; padding-left: 8px'>You have no Information yet in the Database</p>";
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
  $rows2 = mysqli_num_rows($result1);
  if ($rows2){
	  while($row2 = mysqli_fetch_assoc($result2)){
		$local_government[$row2['state_id']][] = array("id" => $row2['id'], "val" => $row2['local_government']);
	}

	  $jsonStates = json_encode($states);
	  $jsonLocal_government = json_encode($local_government);
  }
  
if (isset($_POST['submit'])){
	$genderr = htmlspecialchars($_POST['gender']);
	$maritall = htmlspecialchars($_POST['marital']);
	$maidenNamee = htmlspecialchars($_POST['maidenName']);
	$Dobb = htmlspecialchars($_POST['Dob']);
	$nationalityy = htmlspecialchars($_POST['nationality']);
	$stateOforiginn = htmlspecialchars($_POST['stateOforigin']);
	$homeTownn = htmlspecialchars($_POST['homeTown']);
	$LGAA = htmlspecialchars($_POST['LGA']);
	$religionn = htmlspecialchars($_POST['religion']);
	$phoneNoo = ($_POST['phoneNo']);
	$homeAddresss = htmlspecialchars($_POST['homeAddress']);
	$denoMinationn = htmlspecialchars($_POST['denoMination']);
	$postall = htmlspecialchars($_POST['postal']);
	$date_addedd = date('Y.m.d - H:i:s');
	
	if (strlen($_POST['homeAddress']) < 20)
	{
		if (preg_match("/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/", $Dobb))
		{
			if (preg_match("/^[0-9]{11}$/", $phoneNoo))
			{
				$sql = "UPDATE `sono` SET `sex`='$genderr', `marital`='$maritall', `maidenName`='$maidenNamee', `DateofBirth`='$Dobb', `natioNality`='$nationalityy', `stateOforigin`='$stateOforiginn', `homeTown`='$homeTownn', `LGA`='$LGAA', `religion`='$religionn', `phoneNo`='$phoneNoo', `homeAddress`='$homeAddresss', `denoMination`='$denoMinationn', `postaladdress`='$postall' `date_added`='$date_addedd' WHERE `eMail`='$email'";
				$check = mysqli_query($dbconnect, $sql);
				$msg = "<center><p style ='color: #4F8A10; background-color: #DFF2BF; border-radius:.5em; width: 350px; border: 1px solid #D8D8D8; padding: 10px; border-radius: 5px; font-family: Arial; font-size: 11px; text-transform: uppercase; text-align: center; text-transform: uppercase; padding-left: 12px'>Changes Saved Successfully</p></center>";
			} else
			$msg = "<p style='color: #D8000C; background-color: #FFBABA; border-radius:.5em; width: 300px; border: 1px solid #D8D8D8; padding: 5px; border-radius: 5px; margin-left: auto; margin-right: auto; font-family: Arial; font-size: 11px; text-transform: uppercase; text-align: center; text-transform: uppercase'>Phone Number should be 11 digits</p>";
		} else
		$msg = "<p style='color: #D8000C; background-color: #FFBABA; border-radius:.5em; width: 300px; border: 1px solid #D8D8D8; padding: 5px; border-radius: 5px; margin-left: auto; margin-right: auto; font-family: Arial; font-size: 11px; text-transform: uppercase; text-align: center; text-transform: uppercase'>Date of birth should be YYYY-MM-DD</p>";
	} else
	$msg = "<p style='color: #D8000C; background-color: #FFBABA; border-radius:.5em; width: 300px; border: 1px solid #D8D8D8; padding: 5px; border-radius: 5px; margin-left: auto; margin-right: auto; font-family: Arial; font-size: 11px; text-transform: uppercase; text-align: center; text-transform: uppercase'>Home Address should not be greater than 50 character</p>";
				    
}
?>

<!Doctype html>
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
<title>My Account/Edit</title>
</head>
<body onload='loadStates()'>
<?php
include_once "header.php";
?>
<div id="container">
  <div id="sidebar1"><br>
    <p class="subHeader">Dashboard</p>
    <ul id="navigation2">
	  <?php
	  include_once "user_sidebar.php";
	  ?>
    </ul>
    <!-- end .sidebar1 --></div>
  <div class="margin" id="content2">
  <div id="Content_Area">
   <center><h3 class="heading_text" style="margin-top: 20px">Edit Profile</h3></center>
		 <div class="bio_data">
			  <div class="form">
			   <form action="" method="post">
			   <?php
			   echo $msg;
			   ?>
			    <table width="450px" style="margin-left: auto; margin-right: auto; background-color: #C5DFFA" cellpadding="7" cellspacing="0" border="0">
				 <p style='text-align: center; font-size: 12px; font-family: monospace'>Please do not click save without making any change in your data</p> 
			     <tr>
				   <td width="30%"><label>Surname</label></td>
				   <td width="70%"><input type="text" class="userarea" name="surName" disabled="disabled" value="<?php echo $Surname; ?>"></td>
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
				 <td width="70%"><select name="gender" class="userarea">
				 <option value="<?php echo $Gender;?>"><?php echo $Gender;?></option>
				 <option value="Male">Male</option>
				 <option value="Female">Female</option>
				 </select></td>
				 </tr>
				 <tr>
				 <td width="30%"><label>Marital Status</label></td>
				 <td width="70%"><select name="marital" class="userarea">
				 <option value="<?php echo $Marital;?>"><?php echo $Marital;?></option>
				 <option value="Single">Single</option>
				 <option value="Married">Married</option>
				 </select></td>
				 </tr>
				 <tr>
				 <td width="30%"><label>Maiden Name (If Any)</label></td>
				 <td width="70%"><input type="text" class="userarea" name="maidenName" value="<?php echo $MaidenName; ?>" ></td>
				 </tr>
				 <tr>
				 <td width="30%"><label>Date of Birth</label></td>
				 <td width="70%"><input type="text" class="userarea" name="Dob" placeholder="YYYY-MM-DD" value="<?php echo $Dateofbirth; ?>"></td>
				 </tr>
				 <tr>
				 <td width="30%"><label>Nationality</label></td>
				 <td width="70%"><select name="nationality" class="userarea">
				 <option value="<?php echo $NatioNality;?>"><?php echo $NatioNality;?></option>
				 <option value="Nigeria">Nigeria</option>
				 </select></td>
				 </tr>
				 <tr>
				 <td width="30%"><label>State Of Origin</label></td>
				 <td width="70%"><select name="stateOforigin" class="userarea" id="statesSelect">
				 </select></td>
				 </tr>
				 <tr>
				 <td width="30%"><label>Local Govt. Area</label></td>
				 <td width="70%"><select name="LGA" class="userarea" id="local_governmentSelect">
				 <option value="<?php echo $lGA;?>"><?php echo $lGA;?></option>
				 <option value="Null">Loading...</option>
				 </select></td>
				 </tr>
				 <tr>
				 <td width="30%"><label>Home Town</label></td>
				 <td width="70%"><input type="text" class="userarea" name="homeTown" value="<?php echo $HomeTown; ?>"></td>
				 </tr>
				 <tr>
				 <td width="30%"><label>Religion</label></td>
				 <td width="70%"><select name="religion" class="userarea">
				 <option value="<?php echo $Religion;?>"><?php echo $Religion;?></option>
				 <option value="Christian">Christian</option>
				 <option value="Muslim">Muslim</option>
				 </select></td>
				 </tr>
				 <tr>
				 <td width="30%"><label>Phone No</label></td>
				 <td width="70%"><input type="text" class="userarea" name="phoneNo" placeholder="Should not be less than 11 digits" value="<?php echo $PhoneNo; ?>"></td>
				 </tr>
				 <tr>
				 <td width="30%"><label>Denomination</label></td>
				 <td width="70%"><input type="text" class="userarea" name="denoMination" value="<?php echo $DenoMination; ?>"></td>
				 </tr>
				 <tr>
				 <td width="30%"><label>Permanent Home Address</label></td>
				 <td width="70%"><textarea type="textarea" cols="30" rows="3" class="userarea" name="homeAddress"><?php echo $HomeAddress; ?></textarea></td>
				 </tr>
				 <tr>
			     <td width="30%"><label>Postal Address</label></td>
				 <td width="70%"><input type="text" class="userarea" name="postal" value="<?php echo $Postal; ?>"></td>
				 </tr>
				</table><br>
				<center><input type="submit" value="SAVE" name="submit" id="proceed"></center>
			  
		    </form><br><br>
		 </div>
        </div>
	 </div>
  
    <!-- end .content --></div>
	</div>
   <?php
    include_once "footer.php";
   ?>
 </body>
</html>