<?php 
session_start();
ob_start();
// error display configuration
error_reporting(E_ALL);
ini_set('display_errors','1');

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
?>
<!doctype html>
<html>
<link href="http://localhost/buth_net/nursingSchool/css/buth_net.css" rel="stylesheet" type="text/css">
<head>
<meta charset="utf-8">
<link rel="shortcut icon" href="/favicon.ico" >
<title>Admin Block</title>
<script src="js/jquery-1.12.3.min.js" type="text/javascript"></script>
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
	<?php include_once "../new_bar.php"; ?>
      <!-- end .sidebar1 --></div>
     <div class="margin" id="content">
	  <h1 style='text-align: center; font-family: tahoma; font-size: 16px; text-transform: uppercase; font-weight: bold; background-color: #000000; margin-top: -5px; color: #CECECE'>Welcome! <?php echo $name . " " . "What would like to do today?"; ?></h1>
		<img src="../pharmacySection/images/1.jpg" width="770" height="300px" alt="admin block"><br><br>
		<!--<div class="page_title" style="font-size:1.8em; text-align:center;">Welcome to Bowen University Teaching Hospital Intranet Page</div>-->
		<p>Love and calvary greetings in the name of our Lord Jesus Christ. Praises and thanks to our God for all His wonderful deeds in, for and through you to the glory of His name and for the blessing of humanity.</p>
		<p>This intranet web page is only available for School of Nursing, School of Midwifery, and departments whose link are appeared on the left side bar of the webpage.</p>
		<p>This Intranet page is a mature, secure web application for building and managing the hospital databases and it is using real-time processing.</p>
		<p><span class="payment_form2">STATUS: </span> <span class="subHeader">development</span></p>
		<p class="emphasis">PLEASE KNOW THAT THIS INTRANET PAGE IS STILL ON DEVELOPMENT, THE REAL DATA SHOULD NOT BE ENTERED INTO THE SYSTEM UNTIL IT IS MOVED TO PRODUCTION.</p>
		<p>If Internet is down does not mean that you cannot access the intranet web page</p>
		<p>Unless you are given a special Intranet username and password, you should not try to log in with your normal internet login details.    </p>
		<p>If the Intranet page is down or not responding or having trouble with logging in, you can contact the BUTH ICT.</p>
		<p>The real use of this database is guided by the hospital policy, all the users are adviced to read and strictly dere to it. Any misuse of the content will be dealt with.</p>
		<p>For further information about the hospital can be found in the hospital website: <span class="calendarText">www.buth.org.ng</span><!-- end .content --></p>
	 <!-- end .content --></div>
	  <!-- end .container --></div>
     <?php
      include_once "../pharmacySection/footer.php";
     ?>
</body>
</html>