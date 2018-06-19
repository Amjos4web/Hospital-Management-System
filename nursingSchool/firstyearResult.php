<?php
// error display configuration
//error_reporting(E_ALL & ~E_NOTICE);
$msg = "";
if (isset($_POST['login'])){
	include "dbconnect.php";
	$passWord = $_POST['passWord'];
	$emaill = $_POST['emaill'];
	if (empty($emaill && $passWord) == false){
		$sql = "SELECT * FROM `sono_firstyearresult1` WHERE `eMail`='$emaill' && `student_id`='$passWord'";
		$check = mysqli_query($dbconnect, $sql) or die (mysqli_error($dbconnect));
		$result = mysqli_num_rows($check);
		if ($result > 0){
			session_start();
			$_SESSION['emaill'] = $emaill;
			header ('location: profile.php');
		} else
		$msg = "<p style='color: #880000; padding-left: 0px'><span class='successbtn'><img src='images/error.png' alt='error' width='22px' height='22px'></span>Error: Invalid password or email address</p>";
	} else
	$msg = "<p style='color: #880000; padding-left: 0px'><span class='successbtn'><img src='images/error.png' alt='error' width='22px' height='22px'></span>Please enter your email and password to login</p>";
}
?>
<!doctype html>
<html>
<link href="css/buth_net.css" rel="stylesheet" type="text/css">
<head>
<meta charset="utf-8">
<link rel="shortcut icon" href="/favicon.ico" >
<title>Login Page</title>
</head>
<body>
<?php
include_once "header.php";
?>
<div id="container">
  <div id="sidebar1"><br>
    <p class="subHeader">Menu</p>
    <ul id="navigation2">
	  <li class="page_title">School Of Nursing</li><br>
	  <li><a href="index.php">Homepage</a></li><br>
	   <li><a href="firstyearresult.php">First Year Result</a></li><br>
      <li><a href="register.php">Register</a></li><br>
      <li><a href="login.php">Login</a></li><br>

    </ul>
	 <p class="subHeader">Lastest News</p>
	  <marquee behaviour="scroll" direction="up" scrollamount="2">
	   <ul class="news">
	     <li>2016/2017 Registration form is out...</li><br>
		 <li>School fees is to paid before June 2016...</li><br>
		 <li>Examination commences on 12th of March...</li><br>
		 <li>Registration will close very soon...</li><br>
		 <li>Applicatants should be ready for entrance exams...</li>
		</ul>
	   </marquee>
      <!-- end .sidebar1 --></div>
	 <div id="Content_Area"> 
     <div class="margin" id="content">
	 <div class="login_form">
	   <fieldset>
		 <legend>Student Login Section</legend>
		  <form action="" method="post">
		  <?php
		   echo $msg;
		  ?>
		   <label class="labelEmail"><span class='successbtn'><img src="images/personal.png" alt="email" width="22px" height="22px"></span>Email</label>
		    <p><input type="text" id="email" name="emaill" autofocus></p>
			<label class="labelEmail"><span class='successbtn'><img src="images/pass.ico" alt="email" width="22px" height="22px"></span>Password</label>
		    <p><input type="password" id="passkey" name="passWord"></p>
			<input type="submit" value="Login" name="login" id="login22">
			<input type="submit" value="Forgot Password" name="forgotpass" id="forgotpass2">
			  </form>
			 </fieldset>
		    </div>
		  </div>
			   <!-- end .content --></div>
			  <!-- end .container --></div>
     <?php
      include_once "footer.php";
     ?>
</body>
</html>