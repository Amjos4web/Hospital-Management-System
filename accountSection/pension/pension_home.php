<?php
session_start();
ob_start();
// error display configuration
error_reporting(E_ALL & ~E_NOTICE);

if(!isset($_SESSION['emaill'])){
	header('location: pension_login.php');
}
//This block grabs the whole list for viewing
$msg="";
$email= $_SESSION['emaill'];
include "../dbconnect2.php";
$sql="SELECT first_name, id FROM `pension_login` WHERE `emailAdd`='$email' LIMIT 1";
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
		$sqlcommand2 = "SELECT `staff_id`, `surName`, `firstName`, `otherName`, `sex` FROM `staff_record` WHERE `staff_id`='$search' LIMIT 1";
		$query = mysqli_query($dbconnect, $sqlcommand2) or die (mysqli_error($dbconnect));
		$count = mysqli_num_rows($query);
		if ($count > 0){
			while($row2=mysqli_fetch_assoc($query)){
				$staff_id=$row2["staff_id"];
				$surname=$row2["surName"];
				$firstname=$row2["firstName"];
				$othername=$row2["otherName"];
				$_SESSION['staff_id'] = $staff_id;
				$staff_id = $_SESSION['staff_id'];
				
				$results .=	'<h3 style="color: brown; font-size: 22px; font-style: normal; text-align: center; font-family: monospace">Information for '.$staff_id.'<h3>';
				$results .= '<table width="500px" style="margin-left: auto; margin-right: auto;" cellpadding="7" cellspacing="0" border="1">';
				$results .= "<tr>";
				$results .= "<td style='background-color:#C5DFFA; width: 30%; font-family: Adobe Heiti Std R; padding-left: 20px; font-size: 16px'><b>Staff ID</b></td>";
				$results .= "<td style='background-color:#C5DFFA; width: 70%; font-family: Adobe Heiti Std R; padding-left: 20px; font-size: 16px'><b>".$staff_id."</b></td>";
				$results .= "</tr>";
				$results .= "<tr>";
				$results .= "<td style='background-color:#C5DFFA; width: 30%; font-family: Adobe Heiti Std R; padding-left: 20px; font-size: 16px'><b>Surname</b></td>";
				$results .= "<td style='background-color:#C5DFFA; width: 70%; font-family: Adobe Heiti Std R; padding-left: 20px; font-size: 16px'><b>".$surname."</b></td>";
				$results .= "</tr>";
				$results .= "<tr>";
				$results .= "<td style='background-color:#C5DFFA; width: 30%; font-family: Adobe Heiti Std R; padding-left: 20px;  font-size: 16px'><b>First Name</b></td>";
				$results .= "<td style='background-color:#C5DFFA; width: 70%; font-family: Adobe Heiti Std R; padding-left: 20px; font-size: 16px'><b>".$firstname."</b></td>";
				$results .= "</tr>";
				$results .= "<tr>";
				$results .= "<td style='background-color:#C5DFFA; width: 30%; font-family: Adobe Heiti Std R; padding-left: 20px;  font-size: 16px'><b>Other Names</b></td>";
				$results .= "<td style='background-color:#C5DFFA; width: 70%; font-family: Adobe Heiti Std R; padding-left: 20px; font-size: 16px'><b>".$othername."</b></td>";
				$results .= "</tr>";
				$results .= "</table><br>";
	            $results .= '<center><a href="edit_staff.php?staffId='.$staff_id.'" class="submit4" style="text-transform: uppercase; text-decoration: none;">Edit</a></center>';
			    ?><style type="text/css">.bio_data{
					display: none
				}
				</style><?php
				
			} // close the while loop
		} else {
			$msg2 .= "<p style='color: #880000; font-size: 18px; margin-left: 20px'>No result found for <b>$search</b></p>";
			$msg2 .= '<center><label><a href="pension_home.php" style="font-size: 24px; font-family: impact; font-style: normal">Close</a></label></center>';
		}
	} else {
		$msg2 .= "<p style='color: #880000; font-size: 18px; margin-left: 20px'>No result found for <b>empty search</b></p>";
		$msg2 .= '<center><label><a href="pension_home.php" style="font-size: 24px; font-family: impact; font-style: normal">Close</a></label></center>';
	}
	
}
?>
<!doctype html>
<html>
<link href="http://localhost/buth_net/pharmacySection/css/buth_net.css" rel="stylesheet" type="text/css">
<head>
<meta charset="utf-8">
<link rel="shortcut icon" href="/favicon.ico" >
<title>Welcome To Pension</title>
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
	  <li><a href="pension_home.php">Pension List</a></li><br>
	  <li><a href="edit_pension.php">Edit Pension List</a></li><br>
	  <li><a href="individual_pension.php">Individual Pension List</a></li><br>
	  <li><a href="all_pension.php">All Pension List</a></li><br>
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
	     <center><h3 class="heading_text">Search for Pension List</h3></center><br>
		<center><img src="../images/payment2.jpg" alt="search_angle" width="500px" height="200px"></center><br>
		<div class="search">
		 <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET">
		 <center><input type="text" name="search2" id="search2" maxlength="88" placeholder="Enter Staff Id"><br><br></center>
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