<?php
if (isset($_POST['register'])){
	header('location: register.php');
}
if (isset($_POST['login'])){
	header('location: login.php');
}
?>
<!doctype html>
<html>
<link href="http://localhost/buth_net/nursingSchool/css/buth_net.css" rel="stylesheet" type="text/css">
<head>
<meta charset="utf-8">
<link rel="shortcut icon" href="/favicon.ico" >
<title>BUTH Intranet School of Nursing</title>
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
	  <li><a href="http://localhost/buth_net/index.php">Mainpage</a></li><br>
	  <li><a href="firstyearResult.php">First Year Result</a></li><br>
      <li><a href="register.php">Register</a></li><br>
      <li><a href="login.php">Login</a></li><br>
    </ul>
	 <img src="http://localhost/buth_net/nursingSchool/images/bowen3.jpg" width="170px" height="250px" style="margin-left: 20px" alt="Welcome To School of Nursing"><br><br>
	<?php include_once "../new_bar.php"; ?>
    <!-- end .sidebar1 --></div>
  <div class="margin" id="content">
    <marquee behaviour="scroll" direction="left" scrollamount="3" scrolldelay="2"><h1>Today is <?php echo date("l jS \of F Y"); ?>. Welcome To Bowen University Teaching Hospital School Of Nursing Students Portal.</h1></marquee>
	<img src="images/welcome.jpg" width="770px" height="300px" alt="Welcome To School of Nursing"><br><br>
    <p>This page is still on development status, student filling this form or doing the registration on this portal should know that the data filled here are not secured until the portal is being approved by the institution and and all the errors are being corrected.</p>
    <p>YOU ARE ADVICED NOT TO PUT THE REAL DATA INTO THE SYSTEM UNTIL THE PAGE IS MOVED TO PRODUCTION</p>
    <a href="payment1.php"><h1 class="pin">Click here to get your pin for registration</h1></a>
	
      <form action="" method="post">
	  <center><input type="submit" value="Register" name="register" id="regg">
	  <input type="submit" value="Login" name="login" id="forgotpass2"></center>
	  </form>
    <!-- end .content --></div>
  <!-- end .container --></div>
 <?php
  include_once "footer.php";
  ?>
</body>
</html>
