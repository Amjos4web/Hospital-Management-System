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
	$PhoneNo=$row["phoneNo"];
	$Password=$row["passWord"];
	}
}else{
$msg="<p style='color: red; padding-left: 8px'>You have no Information yet in the Database</p>";
}
if (isset($_POST['send'])){
	$msg = "";
	$email= htmlspecialchars(trim($_POST['email']));
     
      if (empty($email) == false){
        
        $sql = "SELECT * FROM `sono` WHERE `eMail`='$email' && `passWord`='$Password'";
        $check = mysqli_query($dbconnect, $sql) or die (mysqli_error($dbconnect));
        $result = mysqli_num_rows($check);
        if ($result > 0){
			$to = $email;
			$subject = "Password Reset";
			$body =  "Hello, <br>You have requested for your password. If you are not responsible for this, you can ignore this message.<br>Your Password is $Password. <br> Or click the link to reset your password, <a href='changepass.php'>Click here</a><br>This is an automated email. Please DO NOT reply to it.<br>School of Nursing.<br>Bowen University Teaching Hospital, Ogbomoso.";
		    mail($to,$subject,$body, 'From: school_nursing@buth.edu.ng');
			$msg = "<p style='color: green; padding-left: 15px'>Check your email address to change your password</p>";
			} else
			$msg = "<p style='color: red; padding-left: 15px'>Invalid email address</p>";
			} else
			$msg = "<p style='color: red; padding-left: 15px'>Please enter your email address</p>";
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
		  if (isset($_POST['send'])){
			  echo $msg;
		  }
		  ?>
		    <p style='margin-left: 0px; font-family: Lucida Grande","Lucida Sans Unicode",Tahoma,Sans-Serif; font-weight: bold'>Please enter your email address to change your password</p>
		    <label>Email</label>
		    <p><input type="text" id="email" name="email" autofocus></p>
			<center><input type="submit" value="Send" name="send" id="send"></center>
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