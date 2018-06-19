<?php
$msg = "";
if (isset($_POST['login'])){
	include "../dbconnect2.php";
	$password = trim($_POST['password']);
	$email = trim($_POST['emaill']);
	$last_log_date = date('Y-m-d H:i:s');
		if (empty($email && $password) == false){
			$sql = "SELECT * FROM `payment_login` WHERE `emailAdd`='$email' && `passWord`='$password'";
			$check = mysqli_query($dbconnect, $sql) or die (mysqli_error($dbconnect));
			$result = mysqli_num_rows($check);
			if ($result > 0){
				session_start();
				$_SESSION['emaill'] = $email;
				header('location: payment_home.php');
				$sql = "UPDATE `payment_login_login` SET `last_log_date`='$last_log_date' WHERE `emailAdd`='$email'";
				$check2 = mysqli_query($dbconnect, $sql) or die (mysqli_error($dbconnect));
			    }
				$msg = "<p style='color: #880000; padding-left: 0px'><span class='successbtn'><img src='../images/error.png' alt='error' width='22px' height='22px'></span>Error: Invalid password or email address</p>";
				} else
				$msg = "<p style='color: #880000; padding-left: 0px'><span class='successbtn'><img src='../images/error.png' alt='error' width='22px' height='22px'></span>Error: Please enter your email and password to login</p>";
}

?>
<!doctype html>
<html>
<link href="http://localhost/buth_net/pharmacySection/css/buth_net.css" rel="stylesheet" type="text/css">
<head>
<meta charset="utf-8">
<link rel="shortcut icon" href="/favicon.ico" >
<title>Payment Login Page</title>
</head>
<body>
<?php
include_once "../header.php";
?>
<div id="container">
  <div id="sidebar1"><br>
    <p class="subHeader">Menu</p>
     <?php include_once "../includes/account_nav.php"; ?>
	 <?php //include_once "../buth_net/new_bar.php"; ?>
      <!-- end .sidebar1 --></div>
     <div class="margin" id="content">
	  <div class="login_form">
	   <fieldset>
		 <legend>Payment Login Section</legend>
		  <form action="" method="post">
		  <?php
		   echo $msg;?>
		    <label class="labelEmail"><span class='successbtn'><img src="../images/personal.png" alt="email" width="22px" height="22px"></span>Email</label>
		    <p><input type="text" id="email" name="emaill" autofocus></p>
			<label class="labelEmail"><span class='successbtn'><img src="../images/pass.ico" alt="email" width="22px" height="22px"></span>Password</label>
		    <p><input type="password" id="passkey" name="password"></p>
			<input type="submit" value="Login" name="login" id="login22">
			<input type="submit" value="Forgot Password" name="forgotpass" id="forgotpass2">
			  </form>
			 </fieldset>
		    </div>
			   <!-- end .content --></div>
			  <!-- end .container --></div>
     <?php
      include_once "../footer.php";
     ?>
</body>
</html>