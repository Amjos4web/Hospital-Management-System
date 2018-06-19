<?php
session_start();
ob_start();
// error display configuration
error_reporting(E_ALL & ~E_NOTICE);

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

$msg2 = "";
$results = "";
$result = "";
// see if the posted search query field is set and has a value
if (isset($_GET['searchbtn'])){
	if (isset($_GET['search2']) && $_GET['search2'] != ""){
		// filter the inputs
		$search = $_GET['search2'];
		$sqlcommand2 = "SELECT * FROM `staff_record` WHERE `staff_id` LIKE '%$search%'";
		$query = mysqli_query($dbconnect, $sqlcommand2) or die (mysqli_error($dbconnect));
		$count = mysqli_num_rows($query);
		if ($count > 0){
			while($row2=mysqli_fetch_array($query)){
				$staff_id=$row2["staff_id"];
				$surname=$row2["surName"];
				$firstname=$row2["firstName"];
				$othername=$row2["otherName"];
				$sex=$row2["sex"];
				$religion=$row2["religion"];
				$phoneNo=$row2["phoneNo"];
				$job_title=$row2["job_title"];
				$depart=$row2["department"];
				$unit=$row2["unit"];
				$salary_level=$row2["salary_level"];
				
				
			
				
				$results .= "<tr>";
				$results .= "<td style='background-color:#CECECE; font-family: Adobe Heiti Std R;'>" .$staff_id . "</td>";
				$results .= "<td style='background-color:#CECECE; text-align: center; font-family: Adobe Heiti Std R;'>".$surname . "</td>";
				$results .= "<td style='background-color:#CECECE; text-align: center; font-family: Adobe Heiti Std R;'>".$firstname . "</td>";
				$results .= "<td style='background-color:#CECECE; text-align: center; font-family: Adobe Heiti Std R;'>" .$othername . "</td>";
				$results .= "<td style='background-color:#CECECE; text-align: center; font-family: Adobe Heiti Std R;'>" .$sex . "</td>";
				$results .= "<td style='background-color:#CECECE; text-align: center; font-family: Adobe Heiti Std R;'>".$phoneNo . "</td>";
				$results .= "<td style='background-color:#CECECE; text-align: center; font-family: Adobe Heiti Std R;'>" .$job_title . "</td>";
				$results .= "<td style='background-color:#CECECE; font-family: Adobe Heiti Std R; text-align: center;'><a href='editstaff_details.php?staff_id=".$staff_id."' style='font-style: normal; font-family: Adobe Heiti Std R; color: #880000'>Edit</a></td>";
				$results .= "<td style='background-color:#CECECE; font-family: Adobe Heiti Std R; text-align: center;'><a href='staff_details.php?staff_id=".$staff_id."' style='font-style: normal; font-family: Adobe Heiti Std R; color: #880000'>View Details</a></td>";
				$results .= "</tr>";
				$result = "<hr><h1 style='font-family: monospace; color: #880000'>"."Results found for". " " .$search."</h1><br>";
			
				
			} // close the while loop
		} else {
			?><script type="text/javascript">
			alert ('No result found for <?php echo $search; ?>');
			windows.locaton = 'view_staff.php';
			</script><?php
		}
	} else {
		?><script type="text/javascript">
		alert ('field should not be empty');
		windows.locaton = 'view_staff.php';
		</script><?php
	}
	
}
?>
<!doctype html>
<html>
<link href="http://localhost/buth_net/pharmacySection/css/buth_net.css" rel="stylesheet" type="text/css">
<head>
<meta charset="utf-8">
<link rel="shortcut icon" href="/favicon.ico" >
<title>View Staff</title>
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
	<?php include_once($_SERVER['DOCUMENT_ROOT'].'../buth_net/new_bar.php'); ?>
      <!-- end .sidebar1 --></div>
     <div class="margin" id="content">
	 <h1 style='text-align: center; font-family: tahoma; font-size: 16px; text-transform: uppercase; font-weight: bold; background-color: #000000; margin-top: -5px; color: #CECECE'>Welcome <?php echo $name; ?> What would you like to do today?</h1><br>
	  <div class="bio_data">
		<div class="search_angle">
		  <?php echo $msg; ?>
	     <center><h3 class="heading_text">Search for staff here</h3></center><br>
		<center><img src="../pharmacySection/images/2.jpg" alt="search_angle" width="500px" height="200px"></center><br>
		<div class="search">
		 <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET">
		 <center><input type="text" name="search2" id="search2" maxlength="88" placeholder="Enter Staff Id"><br><br></center>
		 <center><input type="submit" value="search" name="searchbtn" class="submit4"></center>
		 </form>
		 </div>
	   </div>
	</div><br>
	<div class="product_formlist">
	<?php echo $result; ?>
	  <table width="760px" style="margin-left: auto; margin-right: auto" cellpadding="5" cellspacing="3" border="1">
	   <tr>
	    <td width="9%" style='background-color:#C5DFFA; font-family: arial black;  font-size: 14px'><b>Staff Id</b></td>
		<td width="12%" style='background-color:#C5DFFA; font-family: arial black; text-align: center; font-size: 14px'><b>Surname</b></td>
		<td width="12%" style='background-color:#C5DFFA; font-family: arial black; text-align: center; font-size: 14px'><b>First Name</b></td>
		<td width="12%" style='background-color:#C5DFFA; font-family: arial black; text-align: center; font-size: 14px'><b>Other Names</b></td>
		<td width="10%" style='background-color:#C5DFFA; font-family: arial black; text-align: center; font-size: 14px'><b>Sex</b></td>
		<td width="9%" style='background-color:#C5DFFA; font-family: arial black; text-align: center; font-size: 14px'><b>Phone No</b></td>
		<td width="10%" style='background-color:#C5DFFA; font-family: arial black; text-align: center; font-size: 14px'><b>Job Title</b></td>
		<td width="10%" style='background-color:#C5DFFA; font-family: arial black; text-align: center; font-size: 14px'><b>Edit</b></td>
		<td width="26%" style='background-color:#C5DFFA; font-family: arial black; text-align: center; font-size: 14px'><b>View Details</b></td>
		</tr>
		<?php echo $results; ?>
		<!--tr>
		 <td>&nbsp;</td>
		 <td>&nbsp;</td>
		 <td>&nbsp;</td>
		 <td>&nbsp;</td>
		 <td>&nbsp;</td>
		</tr-->
		</table><br><br>
		</div>
   <!-- end .content --></div>
  <!-- end .container --></div>
     <?php
      include_once "../pharmacySection/footer.php";
     ?>
</body>
</html>