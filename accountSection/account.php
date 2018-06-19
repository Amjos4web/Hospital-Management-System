<?php 
session_start();
ob_start();
// error display configuration
error_reporting(E_ALL);
ini_set('display_errors','1');

if(!isset($_SESSION['emaill'])){
	header('location: ../index.php');
}
//This block grabs the whole list for viewing
$msg="";
$email= $_SESSION['emaill'];
include "dbconnect2.php";
$sql="SELECT * FROM `cashier` WHERE `username_id`='$email' LIMIT 1";
$check = mysqli_query($dbconnect, $sql);
$resultCount=mysqli_num_rows($check); //count the out amount 
if($resultCount>0){
	while($row=mysqli_fetch_array($check)){
	$id=$row["id"];
	$password=$row["password"];
	$name=$row["first_name"];
	}
}else{
$msg="<p style='color: red; text-align: center'>You have no Information yet in the Database</p>";
}
?>
<!doctype html>
<html>
<link href="http://localhost/buth_net/pharmacySection/css/buth_net.css" rel="stylesheet" type="text/css">
<head>
<meta charset="utf-8">
<link rel="shortcut icon" href="/favicon.ico" >
<title>Account Section</title>
<script src="js/jquery-1.12.3.min.js" type="text/javascript"></script>
</head>
<body>
<?php
include_once "header.php";
?>
<div id="container">
  <div id="sidebar1"><br>
    <p class="subHeader">Menu</p>
    <ul id="navigation2">
	  <li class="page_title">Account Unit</li><br>
	  <li><a href="http://localhost/buth_net/index.php">Main Page</a></li><br>
	  <li><a href="general_payment.php">General Payment</a></li><br>
	  <li><a href="total_earn.php">Income Summary</a></li><br>
      <li><a href="acc_logout.php">Logout</a></li><br>
    </ul>
	<img src="images/money.jpg" width="170px" height="250px" style="margin-left: 15px" alt="Account Session"><br><br>
      <!-- end .sidebar1 --></div>
     <div class="margin" id="content">
	 <h1 style='text-align: center; font-family: tahoma; font-size: 16px; text-transform: uppercase; font-weight: bold; background-color: #000000; margin-top: -5px; color: #CECECE'>Welcome! <?php echo $name; ?> What would you like to do today?</h1>
	  <div class="search_angle">
	   <h2 style='margin-left: 0px; margin-top: 35px; font-family: Calibri (Body); font-size: 22px; font-weight: bold; text-transform: uppercase; font-style: normal; color: #880000; text-shadow: 0 1px 0 #ccc,0 2px 0 #c9c9c9,0 3px 0 #bbb,0 4px 0 #b9b9b9,0 5px 0 #aaa,0 6px 1px rgba(0,0,0,.1),0 0 5px rgba(0,0,0,.1),0 1px 3px rgba(0,0,0,.3),0 3px 5px rgba(0,0,0,.2),0 5px 10px rgba(0,0,0,.25),0 10px 10px rgba(0,0,0,.2),0 20px 20px rgba(0,0,0,.15)'>Pay by charge slip</h2>
		<center><img src="images/ssssss.jpg" alt="search_angle" width="500px" height="200px"></center><br>
		<div class="search">
		 <form action="patient_result.php" method="post">
		 <center><input type="text" name="search2" id="search2" maxlength="88" placeholder="Search only by hospital number"><br><br></center>
		 <center><input type="submit" value="Search" name="searchbtn2" id="searchbtn2"></center>
		 </form>
		</div>
	   </div>
	    <?php
	    echo $msg;
	    ?>
	   <!-- end .content --></div>
	  <!-- end .container --></div>
     <?php
      include_once "footer.php";
     ?>
</body>
</html>