<?php
session_start();
ob_start();
// this will refer user to the last visited page
$last_url = basename($_SERVER['PHP_SELF']);
// error display configuration
error_reporting(E_ALL & ~E_NOTICE);

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


$payment_search_results = "";
$msg2 = "";
// see if the posted search query field is set and has a value
if (isset($_GET['searchbtn2'])){
	
	if (isset($_GET['search2']) && $_GET['search2'] != ""){
		// filter the inputs
		$search = $_GET['search2'];
		$sqlcommand2 = "SELECT `name`, `ipd_no`, `deposit`, `ward`, `unused_drugs`, `id` FROM `ipd_billings_form` WHERE `ipd_no`='$search' LIMIT 1";
		$query = mysqli_query($dbconnect, $sqlcommand2) or die (mysqli_error($dbconnect));
		$count = mysqli_num_rows($query);
		if ($count > 0){
			while($row2=mysqli_fetch_assoc($query)){
				$id = ["id"];
				$name_2=$row2["name"];
				$ipd_no=$row2["ipd_no"];
				$deposit=$row2["deposit"];
				$ward=$row2["ward"];
				$ud=$row2["unused_drugs"];
				$payment_search_results .= '<form action="" method="POST">';
				$payment_search_results .= '<table width="500px" style="margin-left: auto; margin-right: auto;" cellpadding="7" cellspacing="0" border="1">';
				$payment_search_results .= "<tr>";
				$payment_search_results .= "<td style='background-color:#C5DFFA; width: 30%; font-family: Adobe Heiti Std R; padding-left: 20px; font-size: 16px'><b>IPD Number</b></td>";
				$payment_search_results .= "<td style='background-color:#C5DFFA; width: 70%; font-family: Adobe Heiti Std R; padding-left: 20px; font-size: 16px'><b>".$ipd_no."</b></td>";
				$payment_search_results .= "</tr>";
				$payment_search_results .= "<tr>";
				$payment_search_results .= "<td style='background-color:#C5DFFA; width: 30%; font-family: Adobe Heiti Std R; padding-left: 20px; font-size: 16px'><b>Ward</b></td>";
				$payment_search_results .= "<td style='background-color:#C5DFFA; width: 70%; font-family: Adobe Heiti Std R; padding-left: 20px; font-size: 16px'><b>".$ward."</b></td>";
				$payment_search_results .= "</tr>";
				$payment_search_results .= "<tr>";
				$payment_search_results .= "<td style='background-color:#C5DFFA; width: 30%; font-family: Adobe Heiti Std R; padding-left: 20px;  font-size: 16px'><b>Name</b></td>";
				$payment_search_results .= "<td style='background-color:#C5DFFA; width: 70%; font-family: Adobe Heiti Std R; padding-left: 20px; font-size: 16px'><b>".$name_2."</b></td>";
				$payment_search_results .= "</tr>";
				$payment_search_results .= "<tr>";
				$payment_search_results .= "<td style='background-color:#C5DFFA; width: 30%; font-family: Adobe Heiti Std R; padding-left: 20px;  font-size: 16px'><b>Deposit</b></td>";
				$payment_search_results .= "<td style='background-color:#C5DFFA; width: 70%; font-family: Adobe Heiti Std R; padding-left: 20px; font-size: 16px'><b>N".$deposit."</b></td>";
				$payment_search_results .= "</tr>";
				$payment_search_results .= "<tr>";
				$payment_search_results .= "<td style='background-color:#C5DFFA; width: 30%; font-family: Adobe Heiti Std R; padding-left: 20px;  font-size: 16px'><b>Unused Drugs</b></td>";
				$payment_search_results .= "<td style='background-color:#C5DFFA; width: 70%; font-family: Adobe Heiti Std R; padding-left: 20px; font-size: 16px'><b>N".$ud."</b></td>"; 
				$payment_search_results .= "</tr>";
				$payment_search_results .= "<tr>";
				$payment_search_results .= "<td style='background-color:#C5DFFA; width: 30%; font-family: Adobe Heiti Std R; padding-left: 20px;  font-size: 16px'><b>New Deposit N</b></td>";
				$payment_search_results .= "<td style='background-color:#C5DFFA; width: 70%;'><input type='text' id='userarea' style='margin-left: 0px; width: 318px' name='deposit'></td>"; 
				$payment_search_results .= "</tr>";
				$payment_search_results .= "<tr>";
				$payment_search_results .= "<td style='background-color:#C5DFFA; width: 30%; font-family: Adobe Heiti Std R; padding-left: 20px;  font-size: 16px'><b>Unused Drugs N</b></td>";
				$payment_search_results .= "<td style='background-color:#C5DFFA; width: 70%;'><input type='text' id='userarea' style='margin-left: 0px; width: 318px' name='unused'></td>"; 
				$payment_search_results .= "</tr>";
				$payment_search_results .= "</table><br>";
	            $payment_search_results .= '<center><input type="submit" class="submit4" value="Update" name="update"></center>';
				$payment_search_results .= '</form>';
				
			} // close the while loop
		} else {
			$msg2 .= "<p style='color: #880000; font-size: 18px; margin-left: 20px'>No result found for <b>$search</b></p>";
			$msg2 .= '<center><label><a href="update_dep.php" style="font-size: 24px; font-family: impact; font-style: normal">Close</a></label></center>';
		}
	} else {
		$msg2 .= "<p style='color: #880000; font-size: 18px; margin-left: 20px'>No result found for <b>empty search</b></p>";
		$msg2 .= '<center><label><a href="update_dep.php" style="font-size: 24px; font-family: impact; font-style: normal">Close</a></label></center>';
	}
	
}
if (isset($_POST['update'])){
	$up = $_POST['deposit'];
	$unused = $_POST['unused'];
	$unused_drug = $ud + $unused;
	$up_dep = $deposit + $up;
	$sql = "UPDATE ipd_billings_form SET `deposit`='$up_dep', `unused_drugs`='$unused_drug' WHERE `ipd_no`='$search' LIMIT 1";
	$query = mysqli_query($dbconnect, $sql) or die (mysqli_error($dbconnect));
	$msg = '<p style = "color: #4F8A10; margin-right: auto; margin-right: auto; text-align: center; background-color: #DFF2BF; border-radius:.5em; width: 400px; border: 1px solid #D8D8D8; margin-left: auto; margin-right: auto; padding: 5px; border-radius: 5px; font-family: Arial; font-size: 11px; text-transform: uppercase; text-transform: uppercase">Operation Successful</p>';
}
?>
<!doctype html>
<html>
<link href="http://localhost/buth_net/pharmacySection/css/buth_net.css" rel="stylesheet" type="text/css">
<head>
<meta charset="utf-8">
<link rel="shortcut icon" href="/favicon.ico" >
<title>Update Deposit</title>
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
	 <h1 style='text-align: center; font-family: tahoma; font-size: 16px; text-transform: uppercase; font-weight: bold; background-color: #000000; margin-top: -5px; color: #CECECE'>Welcome <?php echo $name; ?> What would you like to do today?</h1><br>
	  <div class="bio_data">
	   <fieldset>
	     <div class="search_angle">
	     <center><h3 class="heading_text">Update Deposit</h3></center><br>
		<center><img src="../images/payment2.jpg" alt="search_angle" width="500px" height="200px"></center><br>
		<div class="search">
		 <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET">
		 <center><input type="text" name="search2" id="search2" maxlength="88" placeholder="Search by IPD No" value="<?php echo $search; ?>"><br><br></center>
		 <center><input type="submit" value="Search" name="searchbtn2" id="searchbtn2"></center>
		 </form>
		 </div>
	   </div>
	   </fieldset>
	</div><br><br><br><br>
	 <div id="patient_form">
	 <?php echo $msg; ?>
	  <?php echo $payment_search_results; ?>
	  <p style="margin-top: 35px"><?php echo $msg2; ?></p>
    </div><br><br>
   <!-- end .content --></div>
  <!-- end .container --></div>
     <?php
      include_once "../footer.php";
     ?>
</body>
</html>