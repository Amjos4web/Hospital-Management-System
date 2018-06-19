<?php 
session_start();
ob_start();
if (!isset($_SESSION['emaill']) || (!isset($_GET['email'])))
{
	header('location: login.php');
} else {
	$email = $_GET['emaill'];
	$emaill = $_SESSION['emaill'];
}
error_reporting(E_ALL & ~E_NOTICE);
// This block grabs the whole list for viewing
$msg="";
include "dbconnect.php";
$sql="SELECT * FROM `sono` WHERE `eMail`='$emaill' || `eMail`='$email' LIMIT 1";
$check = mysqli_query($dbconnect, $sql);
$resultCount=mysqli_num_rows($check); //count the out amount 
if($resultCount>0){
	while($row=mysqli_fetch_array($check)){
		$email=$row["eMail"];
		$studentID=$row["studentid"];
		$surname=$row["surName"];
		$otherNames=$row["otherName"];
		$firstNames=$row["firstName"];
		$PhoneNo=$row["phoneNo"];
	}
}else{
$msg="<p style='color: red; padding-left: 15px'>You have no Information yet in the Database</p>";
}

if (isset($_POST['change']))
{
	$msg = "";
	$old_pass= $_POST['old_pass'];
	$new_pass= md5(trim($_POST['new_pass']));
     
      if (empty($old_pass && $new_pass) == false)
	  {
		  $sql = "SELECT * FROM `sono` WHERE `passWord`='$old_pass' && `eMail`='$email'";
		  $check = mysqli_query($dbconnect, $sql) or die (mysqli_error($dbconnect));
		  $result = mysqli_num_rows($check);
		  if ($result > 0)
		  {
			  $sql = "UPDATE `sono` SET `passWord`='$new_pass' WHERE `eMail`='$email'";
			  $query = mysqli_query($dbconnect, $sql);
			  $msg = "<p style='color: green; padding-left: 15px'>Password changed successfully... <a href='home.php'>Go back to Homepage</a></p>";
			  } else
			  $msg = "<p style='color: red; padding-left: 15px'>Old password not found</p>";
			  } else
			  $msg = "<p style='color: red; padding-left: 15px'>All fields required</p>";
}
?>
<!doctype html>
<html>
<link href="css/buth_net.css" rel="stylesheet" type="text/css">
<head>
<meta charset="utf-8">
<link rel="shortcut icon" href="/favicon.ico" >
<title>Change Password</title>
</head>
<body>
<?php
include_once "header.php";
?>
<div id="container">
  <div id="sidebar1"><br>
    <p class="subHeader">Menu</p>
    <ul id="navigation2">
	  <?php
	  include_once "user_sidebar.php";
	  ?>
	 </ul>
      <!-- end .sidebar1 --></div>
     <div class="margin" id="content">
	  <div class="login_form">
	   <fieldset>
		 <legend>Change Password</legend>
		  <form action="" method="post">
		  <?php
		  if (isset($_POST['change'])){
			  echo $msg;
		  }
		  ?>
	
		    <label>Old Password</label>
		    <p><input type="password" id="email" name="old_pass" autofocus></p>
			<label>New Password</label>
		    <p><input type="password" id="email" name="new_pass"></p>
			<input type="submit" value="Change Password" name="change" id="send">
			  </form>
			 </fieldset>
		    </div>
			   <!-- end .content --></div>
			  <!-- end .container --></div>
     <?php
      include_once "footer.php";
     ?>
</body>
</html>