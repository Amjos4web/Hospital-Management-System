<?php
session_start();
ob_start();
// error display configuration
error_reporting(E_ALL & ~E_NOTICE);

if(!isset($_SESSION['emaill'])){
	header('location: nhis_form.php');
}
//This block grabs the whole list for viewing
$msg="";
$email= $_SESSION['emaill'];
include "../dbconnect2.php";
$sql="SELECT first_name, id FROM `nhis_form` WHERE `emailAdd`='$email' LIMIT 1";
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

$msg2 = "";
$results = "";
// see if the posted search query field is set and has a value
if (isset($_GET['searchbtn'])){
	if (isset($_GET['search2']) && $_GET['search2'] != ""){
		// filter the inputs
		$search = $_GET['search2'];
		$sqlcommand2 = "SELECT `enrol_no`, `enrol_name`, `c_name`, `hmo`, `id` FROM `nhis_reg` WHERE `enrol_no`='$search' OR `enrol_name`='$search'";
		$query = mysqli_query($dbconnect, $sqlcommand2) or die (mysqli_error($dbconnect));
		$count = mysqli_num_rows($query);
		if ($count > 0){
			while($row2=mysqli_fetch_assoc($query)){
				$enrol_no=$row2["enrol_no"];
				$enrol_name=$row2["enrol_name"];
				$c_name=$row2["c_name"];
				$hmo=$row2["hmo"];
				
				$results .=	'<h3 style="color: brown; font-size: 22px; font-style: normal; text-align: center; font-family: monospace">Account information for '.$enrol_no.'<h3>';
				$results .= '<table width="500px" style="margin-left: auto; margin-right: auto;" cellpadding="7" cellspacing="0" border="1">';
				$results .= "<tr>";
				$results .= "<td style='background-color:#C5DFFA; width: 30%; font-family: Adobe Heiti Std R; padding-left: 20px; font-size: 16px'><b>HMO</b></td>";
				$results .= "<td style='background-color:#C5DFFA; width: 70%; font-family: Adobe Heiti Std R; padding-left: 20px; font-size: 16px'><b>".$hmo."</b></td>";
				$results .= "</tr>";
				$results .= "<tr>";
				$results .= "<td style='background-color:#C5DFFA; width: 30%; font-family: Adobe Heiti Std R; padding-left: 20px; font-size: 16px'><b>Enrollee No</b></td>";
				$results .= "<td style='background-color:#C5DFFA; width: 70%; font-family: Adobe Heiti Std R; padding-left: 20px; font-size: 16px'><b>".$enrol_no."</b></td>";
				$results .= "</tr>";
				$results .= "<tr>";
				$results .= "<td style='background-color:#C5DFFA; width: 30%; font-family: Adobe Heiti Std R; padding-left: 20px;  font-size: 16px'><b>Enrollee Name</b></td>";
				$results .= "<td style='background-color:#C5DFFA; width: 70%; font-family: Adobe Heiti Std R; padding-left: 20px; font-size: 16px'><b>".$enrol_name."</b></td>";
				$results .= "</tr>";
				$results .= "<tr>";
				$results .= "<td style='background-color:#C5DFFA; width: 30%; font-family: Adobe Heiti Std R; padding-left: 20px;  font-size: 16px'><b>Company Name</b></td>";
				$results .= "<td style='background-color:#C5DFFA; width: 70%; font-family: Adobe Heiti Std R; padding-left: 20px; font-size: 16px'><b>".$c_name."</b></td>";
				$results .= "</tr>";
				$results .= "</table><br>";
	            $results .= '<center><a href="edit_nhis.php?enrol_no='.$enrol_no.'" class="submit4" id="ver" style="text-transform: uppercase; text-decoration: none;">Edit</a></center>';
			
				
			} // close the while loop
		} else {
			$msg2 .= "<p style='color: #880000; font-size: 18px; margin-left: 20px'>No result found for <b>$search</b></p>";
			$msg2 .= '<center><label><a href="nhis_home.php" style="font-size: 24px; font-family: impact; font-style: normal">Close</a></label></center>';
		}
	} else {
		$msg2 .= "<p style='color: #880000; font-size: 18px; margin-left: 20px'>No result found for <b>empty search</b></p>";
		$msg2 .= '<center><label><a href="nhis_home.php" style="font-size: 24px; font-family: impact; font-style: normal">Close</a></label></center>';
	}
	
}
?>
<!doctype html>
<html>
<link href="http://localhost/buth_net/pharmacySection/css/buth_net.css" rel="stylesheet" type="text/css">
<head>
<meta charset="utf-8">
<link rel="shortcut icon" href="/favicon.ico" >
<title>Welcome To NHIS</title>
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
	  <li><a href="nhis_home.php">Home Page</a></li><br>
	  <li><a href="register.php">Register Enrollee List</a></li><br>
	  <li><a href="nhis_income.php">NHIS Income</a></li><br>
	  <li><a href="cost_of_treatment.php">Cost of Treatment</a></li><br>
	  <li><a href="../acc_logout.php">Logout</a></li><br>
    </ul>
	<?php include_once($_SERVER['DOCUMENT_ROOT'].'../buth_net/new_bar.php'); ?>
      <!-- end .sidebar1 --></div>
     <div class="margin" id="content">
	 <h1 style='text-align: center; font-family: tahoma; font-size: 16px; text-transform: uppercase; font-weight: bold; background-color: #000000; margin-top: -5px; color: #CECECE'>Welcome <?php echo $name; ?> What would you like to do today?</h1><br>
	  <div class="bio_data">
	   <fieldset>
	     <div class="search_angle">
		  <?php echo $msg; ?>
	     <center><h3 class="heading_text">Search for Enrollee List</h3></center><br>
		<center><img src="../images/payment2.jpg" alt="search_angle" width="500px" height="200px"></center><br>
		<div class="search">
		 <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET">
		 <center><input type="text" name="search2" id="search2" maxlength="88" placeholder="Enter HMO or Enrollee No"><br><br></center>
		 <center><input type="submit" value="search" name="searchbtn" class="submit4"></center>
		 </form>
		 </div>
	   </div>
	   </fieldset>
	</div><br>
	<div id="patient_form">
	 <?php echo $msg; ?>
	  <?php echo $results; ?>
	<?php echo $msg2; ?>
	</div>
   <!-- end .content --></div>
  <!-- end .container --></div>
     <?php
      include_once "../footer.php";
     ?>
</body>
</html>