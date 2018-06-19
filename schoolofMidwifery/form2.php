<?php 
session_start();
ob_start();
if(!isset($_SESSION['emaill'])){
	header('location: login.php');
} 
//This block grabs the whole list for viewing
$msg="";
$emaill= $_SESSION['emaill'];
include "dbconnect.php";
$sql="SELECT * FROM `som` WHERE `eMail`='$emaill' LIMIT 1";
$check = mysqli_query($dbconnect, $sql);
$resultCount=mysqli_num_rows($check); //count the out amount 
if($resultCount>0){
	while($row=mysqli_fetch_array($check)){
	$email=$row["eMail"];
	$studentID=$row["studentid"];
	$surname=$row["surName"];
	$otherNames=$row["otherName"];
	}
}else{
$msg="<p style='color: #D8000C; background-color: #FFBABA; border-radius:.5em; width: 300px; border: 1px solid #D8D8D8; padding: 5px; border-radius: 5px; margin-left: auto; margin-right: auto; font-family: Arial; font-size: 11px; text-transform: uppercase; text-align: center; text-transform: uppercase'>You have no Information yet in the Database</p>";
}

if (isset($_POST['back'])){
	header ('location: form1.php');
}

if (isset($_POST['proceed'])){
	$nextofkinName = htmlspecialchars(trim($_POST['nextofkinName']));
	$phone1 = htmlspecialchars(trim($_POST['phone1']));
	$relationship1 = htmlspecialchars(trim($_POST['relationship1']));
	$address1 = htmlspecialchars(trim($_POST['address1']));
	$sponsorname = htmlspecialchars(trim($_POST['sponsorname']));
	$phone2 = htmlspecialchars(trim($_POST['phone2']));
	$relationship2 = htmlspecialchars(trim($_POST['relationship2']));
	$address2 = htmlspecialchars(trim($_POST['address2']));
	$date_added = date('Y.m.d - H:i:s');

	if (empty($nextofkinName && $phone1 && $relationship1 && $address1 && $sponsorname && $phone2 && $relationship2 && $address2) == false)
	{
		if ((strlen($_POST['address1']) < 50) || (strlen($_POST['address2']) < 50))
		{
			if ((preg_match("/^[0-9]{11}$/", $phone1)) || (preg_match("/^[0-9]{11}$/", $phone2)))
				{
					$sql = "UPDATE `som_nextofkin` SET `studentid`='$studentID', `Nameofkin`='$nextofkinName', `phoneNo1`='$phone1', `relationship1`='$relationship1', `address1`='$address1', `sponsorName`='$sponsorname', `phoneNo2`='$phone2', `address2`='$address2', `relationship2`='$relationship2', `date_added`='$date_added' WHERE `email`='$email'";
					$check = mysqli_query($dbconnect, $sql);
					header ('location: education.php');		
					} else
					$msg = "<p style'color: #D8000C; background-color: #FFBABA; border-radius:.5em; width: 300px; border: 1px solid #D8D8D8; padding: 5px; border-radius: 5px; margin-left: auto; margin-right: auto; font-family: Arial; font-size: 11px; text-transform: uppercase; text-align: center; text-transform: uppercase'>Phone Number should be 11 digits</p>";
					} else
					$msg = "<p style='color: #D8000C; background-color: #FFBABA; border-radius:.5em; width: 300px; border: 1px solid #D8D8D8; padding: 5px; border-radius: 5px; margin-left: auto; margin-right: auto; font-family: Arial; font-size: 11px; text-transform: uppercase; text-align: center; text-transform: uppercase'>Address should not be more than 50 chars</p>";					
					} else
					$msg = "<p style='color: #D8000C; background-color: #FFBABA; border-radius:.5em; width: 300px; border: 1px solid #D8D8D8; padding: 5px; border-radius: 5px; margin-left: auto; margin-right: auto; font-family: Arial; font-size: 11px; text-transform: uppercase; text-align: center; text-transform: uppercase'>All fields are required</p>";
}
?>
<!DOCTYPE html>
<html>
<link href="http://localhost/buth_net/nursingSchool/css/buth_net.css" rel="stylesheet" type="text/css">
<head>
<meta charset="utf-8">
<link rel="shortcut icon" href="/favicon.ico" >
<script src="js/jquery.js" type="text/javascript"></script>
<script src="js/jqueryy.js" type="text/javascript"></script>
<title>Next of Kin/School of Midwifery</title>
</head>
<body>
<?php
include_once "header.php";
?>
<div id="container">
  <div id="sidebar1"><br>
    <p class="subHeader">Menu</p>
   <ul id="navigation2">
	  <li class="page_title">School of Midwifery</li><br>
	  <li><a href="index.php">Homepage</a></li><br>
      <li><a href="register.php">Register</a></li><br>
      <li><a href="login.php">Login</a></li><br>
    </ul>
	<img src="images/bowen1.jpg" width="170px" height="250px" style="margin-left: 20px" alt="Welcome To School of Nursing"><br><br>
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
		    <legend>Next Of Kin</legend>
			  <div class="form">
			   <form action="" method="post">
			   <?php
			   echo $msg;
			   ?>
			   <table width="450px" style="margin-left: auto; margin-right: auto; background-color: #C5DFFA" cellpadding="7" cellspacing="0" border="1">
			   <tr>
			     <td width="30%"><label>Name of Next of Kin</label></td>
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
			  <tr>
				 <td width="30%"><label>Name of Sponsor</label></td>
				 <td width="70%"><input type="text" class="userarea" name="sponsorname" value= "<?=@$sponsorname?>"></td>
			  </tr>
			  <tr>
			     <td width="30%"><label>Phone No</label></td>
				 <td width="70%"><input type="text" class="userarea" name="phone2" value= "<?=@$phone2?>"></td>
			  </tr>
			  <tr>
				 <td width="30%"><label>Relationship</label></td>
				 <td width="70%"><input type="text" class="userarea" name="relationship2"  value= "<?=@$relationship2?>"></td>
			  </tr>
			  <tr>
				 <td width="30%"><label>Address</label></td>
				 <td width="70%"><textarea type="textarea" cols="30" rows="5" class="userarea" name="address2"></textarea></td>
			  </tr>
			 </fieldset>
			</table><br>
		        <input type="submit" value="<<< BACK" name="back" id="back2">
		        <input type="submit" value="PROCEED >>>" name="proceed" id="proceed2">
		 </form>
		 </div>
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