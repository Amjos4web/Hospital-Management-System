<?php
$msg = "";
if (isset($_POST['login'])){
	include "dbconnect2.php";
	$password = trim($_POST['password']);
	$email = trim($_POST['emaill']);
		if (empty($email && $password) == false){
			$sql = "SELECT * FROM `doctors` WHERE `emailAdd`='$email' && `passWord`='$password'";
			$check = mysqli_query($dbconnect, $sql) or die (mysqli_error($dbconnect));
			$result = mysqli_num_rows($check);
			if ($result > 0){
				session_start();
				$_SESSION['emaill'] = $email;
				header('location: doctors_dashboard.php');
				} else
				$msg = "<p style='color: #880000; padding-left: 0px'><span class='successbtn'><img src='../pharmacySection/images/error.png' alt='error' width='22px' height='22px'></span>Error: Invalid password or email address</p>";
				} else
				$msg = "<p style='color: #880000; padding-left: 0px'><span class='successbtn'><img src='../pharmacySection/images/error.png' alt='error' width='22px' height='22px'></span>Error: Please enter your email and password to login</p>";
	
}

?>
<!doctype html>
<html>
<link href="http://10.40.255.5/buth_net/pharmacySection/css/buth_net.css" rel="stylesheet" type="text/css">
<head>
<meta charset="utf-8">
<link rel="shortcut icon" href="/favicon.ico" >
<title>Doctors Login Page</title>
</head>
<body>
<?php
include_once "../pharmacySection/header.php";
?>
<div id="container">
  <div id="sidebar1"><br>
    <p class="subHeader">Menu</p>
    <ul id="navigation2">
	  <li class="page_title">Doctors Unit</li><br>
	  <li><a href="http://10.40.255.5/buth_net/index.php">Main Page</a></li><br>
	  <li><a href="doctors_login.php">Login Page</a></li><br>
    </ul>
	<?php include_once "../new_bar.php"; ?>
      <!-- end .sidebar1 --></div>
     <div class="margin" id="content">
	  <div class="login_form">
	   <fieldset>
		 <legend>Doctors Login Section</legend>
		  <form action="" method="post">
		  <?php
		   echo $msg;?>
		    <label class="labelEmail"><span class='successbtn'><img src="../pharmacySection/images/personal.png" alt="email" width="22px" height="22px"></span>Email</label>
		    <p><input type="text" id="email" name="emaill" autofocus></p>
			<label class="labelEmail"><span class='successbtn'><img src="../pharmacySection/images/pass.ico" alt="email" width="22px" height="22px"></span>Password</label>
		    <p><input type="password" id="passkey" name="password"></p>
			<input type="submit" value="Login" name="login" id="login22">
			<input type="submit" value="Forgot Password" name="forgotpass" id="forgotpass2">
			  </form>
			 </fieldset>
		    </div>
			   <!-- end .content --></div>
			  <!-- end .container --></div>
     <?php
      include_once "../pharmacySection/footer.php";
     ?>
</body>
</html>