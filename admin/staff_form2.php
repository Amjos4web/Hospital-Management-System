<?php 
session_start();
ob_start();
// error display configuration
//error_reporting(E_ALL & ~E_NOTICE);

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

if (isset($_POST['back'])){
	header ('location: staff_form1.php');
}
$staff_id = $_SESSION['staff_id'];
if(isset($_GET['staff_id'])){
	$staff_id = $_GET['staff_id'];
}
if (isset($_POST['proceed'])){
	$nextofkinName = htmlspecialchars(trim($_POST['nextofkinName']));
	$phone1 = htmlspecialchars(trim($_POST['phone1']));
	$relationship1 = htmlspecialchars(trim($_POST['relationship1']));
	$address1 = htmlspecialchars(trim($_POST['address1']));
	$date_added = date('Y.m.d - H:i:s');

	if (empty($nextofkinName && $phone1 && $relationship1 && $address1) == false)
	{
		if (strlen($_POST['address1']) < 50)
		{
			if (preg_match("/^[0-9]{11}$/", $phone1))
			{
				$sql = "UPDATE `staff_record2` SET `Nameofkin`='$nextofkinName', `phoneNo1`='$phone1', `relationship1`='$relationship1', `address1`='$address1', `date_added`='$date_added' WHERE `staff_id`='".$staff_id."' LIMIT 1";
				$check = mysqli_query($dbconnect, $sql);
				$msg = '<p style = "color: #4F8A10; margin-right: auto; margin-right: auto; text-align: center; background-color: #DFF2BF; border-radius:.5em; width: 400px; border: 1px solid #D8D8D8; margin-left: auto; margin-right: auto; padding: 5px; border-radius: 5px; font-family: Arial; font-size: 11px; text-transform: uppercase; text-transform: uppercase">Operation Successful.. <a href="staff_form3.php?staffId='.$staff_id.'">Continue here</a></p>';				
			} else
			$msg = "<p style'color: #D8000C; background-color: #FFBABA; border-radius:.5em; width: 300px; border: 1px solid #D8D8D8; padding: 5px; border-radius: 5px; margin-left: auto; margin-right: auto; font-family: Arial; font-size: 11px; text-transform: uppercase; text-align: center; text-transform: uppercase'>Phone Number should be 11 digits</p>";
		} else
		$msg = "<p style='color: #D8000C; background-color: #FFBABA; border-radius:.5em; width: 300px; border: 1px solid #D8D8D8; padding: 5px; border-radius: 5px; margin-left: auto; margin-right: auto; font-family: Arial; font-size: 11px; text-transform: uppercase; text-align: center; text-transform: uppercase'>Address should not be more than 50 chars</p>";					
	} else
	$msg = "<p style='color: #D8000C; background-color: #FFBABA; border-radius:.5em; width: 300px; border: 1px solid #D8D8D8; padding: 5px; border-radius: 5px; margin-left: auto; margin-right: auto; font-family: Arial; font-size: 11px; text-transform: uppercase; text-align: center; text-transform: uppercase'>Please fill in the required fields (*)</p>";
}
?>
<!DOCTYPE html>
<html>
<link href="http://localhost/buth_net/pharmacySection/css/buth_net.css" rel="stylesheet" type="text/css">
<head>
<meta charset="utf-8">
<link rel="shortcut icon" href="/favicon.ico" >
<script src="js/jquery.js" type="text/javascript"></script>
<script src="js/jqueryy.js" type="text/javascript"></script>
<title>Next of Kin/<?php echo $staff_id; ?></title>
</head>
<body>
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
	 <?php include_once "../new_bar.php"; ?>
    <!-- end .sidebar1 --></div>
  <div class="margin" id="content">
  <center><h3 class="heading_text" style="width: 400px">Staff Identification Data (Next of kin)</h3></center><br>
		<div id="Content_Area">
		 <div class="bio_data">
		  <fieldset>
		    <legend>Next Of Kin</legend>
			  <div class="form">
			   <form action="" method="post">
			   <?php echo $msg; ?>
			   <table width="470px" style="margin-left: auto; margin-right: auto; background-color: #C5DFFA" cellpadding="7" cellspacing="0" border="1">
			   <tr>
			     <td width="30%"><label>Next of Kin</label></td>
				 <td width="70%"><input type="text" class="userarea" name="nextofkinName"  autofocus value= "<?=@$nextofkinName?>"></td>
			  </tr>
			  <tr>
			     <td width="30%"><label>Phone No</label></td>
				 <td width="70%"><input type="text" class="userarea" name="phone1"  value= "<?=@$phone1?>"></td>
			  </tr>
			  <tr>
				<td width="30%"><label>Relationship</label></td>
				<td width="70%"><input type="text" class="userarea" name="relationship1"  value= "<?=@$relationship1?>"></td>
			  </tr>
			  <tr>
				 <td width="30%"><label>Address</label></td>
				 <td width="70%"><textarea type="textarea" cols="30" rows="5" class="userarea" name="address1"></textarea></td>
			  </tr>
			 </fieldset>
			</table><br>
		        <center><input type="submit" value="<<< BACK" name="back" id="back1">
		        <input type="submit" value="PROCEED >>>" name="proceed" id="proceed2"></center>
			
		 </form>
		</div>
		</div> <!– End of Content_Area Div –>
		</div> <!– End of Tabs Div –>
	 </div>
   <!-- end .content --></div>

 <?php include_once "../pharmacySection/footer.php"; ?>
</body>
</html>