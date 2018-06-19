<?php 
session_start();
ob_start();
// error display configuration
// error_reporting(E_ALL & ~E_NOTICE);

if(!isset($_SESSION['emaill'])){
	header('location: ../index.php');
}
//This block grabs the whole list for viewing
$msg="";
$email= $_SESSION['emaill'];
include "../dbconnect.php";
$sql="SELECT * FROM `revenue_login` WHERE `emailAdd`='$email' LIMIT 1";
$check = mysqli_query($dbconnect, $sql);
$resultCount=mysqli_num_rows($check); //count the out amount 
if($resultCount>0){
	while($row=mysqli_fetch_array($check)){
	$id=$row["id"];
	$name=$row["first_name"];
	$name2=$row["emailAdd"];
	}
}else{
$msg="<p style='color: red; text-align: center'>You have no Information yet in the Database</p>";
}

// sum the total earn by current user 
$sum = "";
$dynamic_list = "";
$dynamic_lists = "";
 if (isset($_POST['sum']))
 {
	$to_date = $_POST['to_date'] ." " . "23:59:59";
	$from_date = $_POST['from_date'] . " " . "00:00:00";
	if (isset($_POST['from_date']) && ($_POST['to_date']) && ($_POST['filter'] != "Null")){
		if ($_POST['filter'] == "Card"){
			require_once "../accountSection/includes/select_query.php";
	    } else if ($_POST['filter'] == "Admission deposit"){
			require_once "../accountSection/includes/select_query.php";
		} else if ($_POST['filter'] == "Drugs"){
			require_once "../accountSection/includes/select_query.php";
		} else if ($_POST['filter'] == "Observation"){
			require_once "../accountSection/includes/select_query.php";
		} else if ($_POST['filter'] == "Emergency"){
			require_once "../accountSection/includes/select_query.php";
		} else if ($_POST['filter'] == "Doctor visit"){
			require_once "../accountSection/includes/select_query.php";
		} else if ($_POST['filter'] == "Discharged Bill"){
			require_once "../accountSection/includes/select_query.php";
		} else if ($_POST['filter'] == "Physiotherapy"){
			require_once "../accountSection/includes/select_query.php";
		} else if ($_POST['filter'] == "Prothesis"){
			require_once "../accountSection/includes/select_query.php";
		} else if ($_POST['filter'] == "X-Ray"){
			require_once "../accountSection/includes/select_query.php";
		} else if ($_POST['filter'] == "Dental"){
			require_once "../accountSection/includes/select_query.php";
		} else if ($_POST['filter'] == "Surgery"){
			require_once "../accountSection/includes/select_query.php";
		} else if ($_POST['filter'] == "Dressing"){
			require_once "../accountSection/includes/select_query.php";
		} else if ($_POST['filter'] == "Family Planning"){
			require_once "../accountSection/includes/select_query.php";
		} else if ($_POST['filter'] == "Immunization"){
			require_once "../accountSection/includes/select_query.php";
		} else if ($_POST['filter'] == "Birth Certificate"){
			require_once "../accountSection/includes/select_query.php";
		} else if ($_POST['filter'] == "Death Certificate"){
			require_once "../accountSection/includes/select_query.php";
		} else if ($_POST['filter'] == "Special Clinic"){
			require_once "../accountSection/includes/select_query.php";
		} else if ($_POST['filter'] == "Laparoscopic"){
			require_once "../accountSection/includes/select_query.php";
		} else if ($_POST['filter'] == "Vip Clinic"){
			require_once "../accountSection/includes/select_query.php";
		} else if ($_POST['filter'] == "Eye Clinic"){
			require_once "../accountSection/includes/select_query.php";
		} else if ($_POST['filter'] == "Morgue"){
			require_once "../accountSection/includes/select_query.php";
		} else if ($_POST['filter'] == "Emberment"){
			require_once "../accountSection/includes/select_query.php";
		} else if ($_POST['filter'] == "Ambulance"){
			require_once "../accountSection/includes/select_query.php";
		} else if ($_POST['filter'] == "Medical Test"){
			require_once "../accountSection/includes/select_query.php";
		} else if ($_POST['filter'] == "Global Fund"){
			require_once "../accountSection/includes/select_query.php";
		} else if ($_POST['filter'] == "Employment Form"){
			require_once "../accountSection/includes/select_query.php";
		} else if ($_POST['filter'] == "Housemanship Form"){
			require_once "../accountSection/includes/select_query.php";
		} else if ($_POST['filter'] == "Lost and Found"){
			require_once "../accountSection/includes/select_query.php";
		} else if ($_POST['filter'] == "Ethical Review Comm"){
			require_once "../accountSection/includes/select_query.php";
		} else if ($_POST['filter'] == "Clinical Training Fee"){
			require_once "../accountSection/includes/select_query.php";
		} else if ($_POST['filter'] == "Training Fee(College of health)Moro"){
			require_once "../accountSection/includes/select_query.php";
		} else if ($_POST['filter'] == "Oxygen Fee"){
			require_once "../accountSection/includes/select_query.php";
		} else if ($_POST['filter'] == "Dietician Fee"){
			require_once "../accountSection/includes/select_query.php";
		} else if ($_POST['filter'] == "Staff Health Registration Fee"){
			require_once "../accountSection/includes/select_query.php";
		} else if ($_POST['filter'] == "AC Scrap Sales"){
			require_once "../accountSection/includes/select_query.php";
		} else if ($_POST['filter'] == "Keg Sales"){
			require_once "../accountSection/includes/select_query.php";
		} else if ($_POST['filter'] == "Broken Tile Sales"){
			require_once "../accountSection/includes/select_query.php";
		} else if ($_POST['filter'] == "Fire and Plank Wood Sales"){
			require_once "../accountSection/includes/select_query.php";
		} else if ($_POST['filter'] == "Cash Advance"){
			require_once "../accountSection/includes/select_query.php";
		} else if ($_POST['filter'] == "Surplus"){
			require_once "../accountSection/includes/select_query.php";
		} else if ($_POST['filter'] == "internet"){
			require_once "../accountSection/includes/select_query.php";
		} 
	} else {
		?><script type="text/javascript">
		alert ('Please enter date and where to sum');
		window.location = 'revenue.php';
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
<title>Revenue Section</title>
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
	  <li><a href="account_home.php">Home Page</a></li><br>
	  <li><a href="revenue.php">Income Summary</a></li><br>
	  <li><a href="revenue_all.php">Income Sum. (All)</a></li><br>
	  <li><a href="revenue_others.php">Income Sum. (Others)</a></li><br>
	  <li><a href="other_payments.php">View Other Payments</a></li><br>
      <li><a href="acc_logout.php">Logout</a></li><br>
    </ul>
	<img src="images/money.jpg" width="170px" height="250px" style="margin-left: 15px" alt="Account Session"><br><br>
      <!-- end .sidebar1 --></div>
     <div class="margin" id="content">
	 	   <h1 style='text-align: center; font-family: tahoma; font-size: 16px; text-transform: uppercase; font-weight: bold; background-color: #000000; color: #CECECE'>Welcome <?php echo $name."!" . " "; ?>What would you like to do today?</h1><br>
	   <?php echo $msg; ?>
	  <div class="search_angle">
		<div class="total_earn">
		 <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
			<h2 style='margin-top: auto; font-family: Calibri (Body); font-size: 18px; font-weight: bold; text-transform: uppercase; font-style: normal; color: #FFFFFF'>Total Earn For Each Payments</h2>
			<center><label style="font-family: monospace; font-size: 16px; font-weight: bold" >From</label>
			<input name="from_date" class="userarea0" type="text"  style="width: 150px" placeholder="YYYY-MM-DD" value="<?php if (isset($_POST['sum'])){echo $from_date;} ?>">
			<label style="font-family: monospace; font-size: 16px; font-weight: bold">To</label>
			<input name="to_date" class="userarea0" type="text"  style="width: 150px" placeholder="YYYY-MM-DD" value="<?php if (isset($_POST['sum'])){echo $to_date;} ?>"></center><br>
		<center><select name="filter" class="userarea0" style="width: 200px">
		   <option value="Null">Select Sum For</option>
		   <option value="Drugs">Drugs</option>
		   <option value="Doctor visit">Doctor's visit</option>
		   <option value="Emergency">Emergency</option>
		   <option value="Card">Card</option>
		   <option value="Admission deposit">Admission deposit</option>
		   <option value="Observation">Observation</option>
		   <option value="Discharged Bill">Discharged Bill</option>
		   <option value="Physiotherapy">Physiotherapy</option>
		   <option value="Prothesis">Prothesis</option>
		   <option value="X-Ray">X-Ray</option>
		   <option value="Dental">Dental</option>
		   <option value="Surgery">Surgery</option>
		   <option value="Dressing">Dressing</option>
		   <option value="Family Planning">Family Planning</option>
		   <option value="Immunization">Immunization</option>
		   <option value="Birth Certificate">Birth Certificate</option>
		   <option value="Death Certificate">Death Certificate</option>
		   <option value="Special Clinic">Special Clinic</option>
		   <option value="Laparoscopic">Laparoscopic</option>
		   <option value="Vip Clinic">Vip Clinic</option>
		   <option value="Eye Clinic">Eye Clinic</option>
		   <option value="Morgue">Morgue</option>
		   <option value="Emberment">Emberment</option>
		   <option value="Ambulance">Ambulance</option>
		   <option value="Medical Test">Medical Test</option>
		   <option value="Global Fund">Global Fund</option>
		   <option value="Employment Form">Employment Form</option>
		   <option value="Housemanship Form">Housemanship Form</option>
		   <option value="Lost and Found">Lost and Found</option>
		   <option value="Ethical Review Comm">Ethical Review Comm</option>
		   <option value="Clinical Training Fee">Clinical Training Fee</option>
		   <option value="Training Fee(College of health)Moro">Training Fee(College of health),Moro</option>
		   <option value="Oxygen Fee">Oxygen Fee</option>
		   <option value="Dietician Fee">Dietician Fee</option>
		   <option value="Staff Health Registration Fee">Staff Health Registration Fee</option>
		   <option value="AC Scrap Sales">AC Scrap Sales</option>
		   <option value="Keg Sales">Keg Sales</option>
		   <option value="Broken Tile Sales">Broken Tile Sales</option>
		   <option value="Fire and Plank Wood Sales">Fire and Plank Wood Sales</option>
		   <option value="Cash Advance">Cash Advance</option>
		   <option value="Surplus">Surplus</option>
		    <option value="internet">Ict/Digital Center</option>
		</select></center><br><br>
		<center><input type="submit" name="sum" class="submit4" value="Sum"></center><br>
		</div>
	   </div><br><br>
		<div class="product_formlist">
		<?php echo $dynamic_lists; ?>
	  <table width="650px" style="margin-left: auto; margin-right: auto" cellpadding="5" cellspacing="3" border="1">
	   <tr>
	    <td width="25%" style='background-color:#C5DFFA; font-family: arial black; text-align: center; font-size: 14px'><b>Date</b></td>
		<td width="20%" style='background-color:#C5DFFA; font-family: arial black; text-align: center; font-size: 14px'><b>Receipt No</b></td>
		<td width="15%" style='background-color:#C5DFFA; font-family: arial black; text-align: center; font-size: 14px'><b>Signed By</b></td>
		<td width="20%" style='background-color:#C5DFFA; font-family: arial black; text-align: center; font-size: 14px'><b>Receipt For</b></td>
		<td width="20%" style='background-color:#C5DFFA; font-family: arial black; text-align: center; font-size: 14px'><b>Total Income</b></td>
		</tr>
		<?php echo $dynamic_list; ?>
		<!--tr>
		 <td>&nbsp;</td>
		 <td>&nbsp;</td>
		 <td>&nbsp;</td>
		 <td>&nbsp;</td>
		 <td>&nbsp;</td>
		</tr-->
		</table><br><br>
			<center><h3 class="heading_text">Total Income</h3></center>
			<center><input type="text"  id="total_earn_area" disabled="disabled" value="<?php if (isset($_POST['sum'])){echo "N".$sum_total;} ?>"></center><br>
		</form>
		 <form action="revenue_receipt.php?from=$from_date&to=$to_date" method="GET" id="jsform" target="_blank">
		<input type="hidden" name="from_date" value="<?php echo $from_date; ?>">
		<input type="hidden" name="to_date" value="<?php echo $to_date; ?>">
		<select name="filter" class="userarea0" form="jsform" style="display: none">
		   <option value="<?php echo $_POST['filter']; ?>"><?php echo $_POST['filter']; ?></option>
		</select>
		<center><input type="button" onclick="document.getElementById('jsform').submit();" class="submit4" value="Print Receipt"></center>
	  </form><br>
	   <!-- end .content --></div>
	  <!-- end .container --></div>
	  </div>
     <?php include_once "footer.php"; ?>
	 
</body>
</html>