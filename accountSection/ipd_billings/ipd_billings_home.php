<?php 
session_start();
ob_start();
// error display configuration
// error_reporting(E_ALL & ~E_NOTICE);

if(!isset($_SESSION['emaill'])){
	header('location: ipd_billings_login.php');
}
//This block grabs the whole list for viewing
$msg="";
$email= $_SESSION['emaill'];
include "../dbconnect2.php";
$sql="SELECT first_name, id FROM `ipd_billings` WHERE `emailAdd`='$email' LIMIT 1";
$check = mysqli_query($dbconnect, $sql);
$resultCount=mysqli_num_rows($check); //count the out amount 
if($resultCount>0){
	while($row=mysqli_fetch_array($check)){
	$id=$row["id"];
	$name=$row["first_name"];
	}
}else{
$msg="<p style='color: red; text-align: center'>You have no Information yet in the Database</p>";
}

if (isset($_POST['searchbtn'])){
	$search = $_POST['search'];
	if (empty($_POST['search']) == false){
		$select = "SELECT * FROM ipd_billings_form WHERE ipd_no='$search' LIMIT 1";
		$check = mysqli_query($dbconnect, $select);
		$resultCount=mysqli_num_rows($check); //count the out amount 
		if($resultCount>0){
			while($row=mysqli_fetch_array($check)){
			$id=$row["id"];
			$last_url=$row["last_visited_page"];
			}
			$_SESSION['search'] = $search;
			header('location: '.$last_url.'');
		}else{
		$msg="<p style='color: #D8000C; background-color: #FFBABA; border-radius:.5em; width: 300px; border: 1px solid #D8D8D8; padding: 5px; border-radius: 5px; margin-left: auto; margin-right: auto; font-family: Arial; font-size: 11px; text-transform: uppercase; text-align: center; text-transform: uppercase'>No result found for $search</p>";
		}
	}else{
	$msg="<p style='color: #D8000C; background-color: #FFBABA; border-radius:.5em; width: 300px; border: 1px solid #D8D8D8; padding: 5px; border-radius: 5px; margin-left: auto; margin-right: auto; font-family: Arial; font-size: 11px; text-transform: uppercase; text-align: center; text-transform: uppercase'>Please enter the ipd no to search</p>";
	}
}
?>
<!doctype html>
<html>
<link href="http://localhost/buth_net/pharmacySection/css/buth_net.css" rel="stylesheet" type="text/css">
<head>
<meta charset="utf-8">
<link rel="shortcut icon" href="/favicon.ico" >
<title>IPD Billings Homepage</title>
<script src="js/jquery-1.12.3.min.js" type="text/javascript"></script>
</head>
<body>
<?php
include_once "../header.php";
?>
<div id="container">
  <div id="sidebar1"><br>
   <p class="subHeader">Menu</p>
	  <ul id="navigation2">
	  <li class="page_title">Account Unit</li><br>
	  <li><a href="http://localhost/buth_net/index.php">Main Page</a></li><br>
	  <li><a href="ipd_billings_home.php">Home Page</a></li><br>
	  <li><a href="discharge_form.php">Discharge Bill Form</a></li><br>
	   <li><a href="update_dep.php">Update Deposit</a></li><br>
	  <li><a href="../acc_logout.php">Logout</a></li><br>
    </ul>
	<?php include_once($_SERVER['DOCUMENT_ROOT'].'../buth_net/new_bar.php'); ?>
      <!-- end .sidebar1 --></div>
     <div class="margin" id="content">
	 <h1 style='text-align: center; font-family: tahoma; font-size: 16px; text-transform: uppercase; font-weight: bold; background-color: #000000; margin-top: -5px; color: #CECECE'>Welcome! <?php echo $name; ?> What would you like to do today?</h1><br>
	<img src="../images/payment1.jpg" width="770" height="300px" alt="IPD Unit"><br><br>
	<center><a href="billing_sheet.php" class="submit4">Add New Patient File</a><a href="billing_sheet.php" class="submit4">Add Existing Patient</a></center><br>
	 <form action="" method="POST">
	 <?php echo $msg; ?>
	  <label style="font-size: 16px; font-family: Adobe Gothic Std B; margin-left: 20px;">Search for existing Patient ..............................................................................................................................................</label><br><br>
		<center><input type="text" placeholder="Enter IPD No"  name="search" style="border-radius: 5px; width: 300px; background-color: #CECECE"><input type="submit" style="color: green" name="searchbtn" value="Search"></center> 
	 </form> 
	   <!-- end .content --></div>
	  <!-- end .container --></div>
     <?php
      include_once "../footer.php";
     ?>
</body>
</html>