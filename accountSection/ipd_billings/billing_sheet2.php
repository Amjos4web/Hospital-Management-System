<?php 
session_start();
ob_start();
// this will refer user to the last visited page
$refering_url = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';
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


$ipd_no = $_SESSION['ipd_no'];
$search = $_SESSION['search'];
if (isset($_GET['ipd_no'])){
	$ipd_nu = $_GET['ipd_no'];
}
$select = "SELECT * FROM ipd_billings_form WHERE ipd_no='$search'";
$check = mysqli_query($dbconnect, $select);
$resultCount=mysqli_num_rows($check); //count the out amount 
if($resultCount>0){
	while($row=mysqli_fetch_array($check)){
		$date16=$row["date16"];
		$billings_for16=$row["billings_for16"];
		$amount16=$row["amount16"];
		$date17=$row["date17"];
		$billings_for17=$row["billings_for17"];
		$amount17=$row["amount17"];
		$date18=$row["date18"];
		$billings_for18=$row["billings_for18"];
		$amount18=$row["amount18"];
		$date19=$row["date19"];
		$billings_for19=$row["billings_for19"];
		$amount19=$row["amount19"];
		$date20=$row["date20"];
		$billings_for20=$row["billings_for20"];
		$amount20=$row["amount20"];
		$date21=$row["date21"];
		$billings_for21=$row["billings_for21"];
		$amount21=$row["amount21"];
		$date22=$row["date22"];
		$billings_for22=$row["billings_for22"];
		$amount22=$row["amount22"];
		$date23=$row["date23"];
		$billings_for23=$row["billings_for23"];
		$amount23=$row["amount23"];
		$date24=$row["date24"];
		$billings_for24=$row["billings_for24"];
		$amount24=$row["amount24"];
		$date25=$row["date25"];
		$billings_for25=$row["billings_for25"];
		$amount25=$row["amount25"];
		$date26=$row["date26"];
		$billings_for26=$row["billings_for26"];
		$amount26=$row["amount26"];
		$date27=$row["date27"];
		$billings_for27=$row["billings_for27"];
		$amount27=$row["amount27"];
		$date28=$row["date28"];
		$billings_for28=$row["billings_for28"];
		$amount28=$row["amount28"];
		$date29=$row["date29"];
		$billings_for29=$row["billings_for29"];
		$amount29=$row["amount29"];
		$date30=$row["date30"];
		$billings_for30=$row["billings_for30"];
		$amount30=$row["amount30"];
		
	}
}
if (isset($_POST['next'])){
	$date16 = htmlspecialchars($_POST['date16']);
	$billings_for16 = htmlspecialchars($_POST['billings_for16']);
	$amount16 = htmlspecialchars($_POST['amount16']);
	$date17 = htmlspecialchars($_POST['date17']);
	$billings_for17 = htmlspecialchars($_POST['billings_for17']);
	$amount17 = htmlspecialchars($_POST['amount17']);
	$date18 = htmlspecialchars($_POST['date18']);
	$billings_for18 = htmlspecialchars($_POST['billings_for18']);
	$amount18 = htmlspecialchars($_POST['amount18']);
	$date19 = htmlspecialchars($_POST['date19']);
	$billings_for19 = htmlspecialchars($_POST['billings_for19']);
	$amount19 = htmlspecialchars($_POST['amount19']);
	$date20 = htmlspecialchars($_POST['date20']);
	$billings_for20 = htmlspecialchars($_POST['billings_for20']);
	$amount20 = htmlspecialchars($_POST['amount20']);
	$date21 = htmlspecialchars($_POST['date21']);
	$billings_for21 = htmlspecialchars($_POST['billings_for21']);
	$amount21 = htmlspecialchars($_POST['amount21']);
	$date22 = htmlspecialchars($_POST['date22']);
	$billings_for22 = htmlspecialchars($_POST['billings_for22']);
	$amount22 = htmlspecialchars($_POST['amount22']);
	$date23 = htmlspecialchars($_POST['date23']);
	$billings_for23 = htmlspecialchars($_POST['billings_for23']);
	$amount23 = htmlspecialchars($_POST['amount23']);
	$date24 = htmlspecialchars($_POST['date24']);
	$billings_for24 = htmlspecialchars($_POST['billings_for24']);
	$amount24 = htmlspecialchars($_POST['amount24']);
	$date25 = htmlspecialchars($_POST['date25']);
	$billings_for25 = htmlspecialchars($_POST['billings_for25']);
	$amount25 = htmlspecialchars($_POST['amount25']);
	$date26 = htmlspecialchars($_POST['date26']);
	$billings_for26 = htmlspecialchars($_POST['billings_for26']);
	$amount26 = htmlspecialchars($_POST['amount26']);
	$date27 = htmlspecialchars($_POST['date27']);
	$billings_for27 = htmlspecialchars($_POST['billings_for27']);
	$amount27 = htmlspecialchars($_POST['amount27']);
	$date28 = htmlspecialchars($_POST['date28']);
	$billings_for28 = htmlspecialchars($_POST['billings_for28']);
	$amount28 = htmlspecialchars($_POST['amount28']);
	$date29 = htmlspecialchars($_POST['date29']);
	$billings_for29 = htmlspecialchars($_POST['billings_for29']);
	$amount29 = htmlspecialchars($_POST['amount29']);
	$date30 = htmlspecialchars($_POST['date30']);
	$billings_for30 = htmlspecialchars($_POST['billings_for30']);
	$amount30 = htmlspecialchars($_POST['amount30']);
	
	$sql3 = "UPDATE `ipd_billings_form` SET `last_visited_page`='$last_url', `date16`='$date16', `billings_for16`='$billings_for16', `amount16`='$amount16', `date17`='$date17', `billings_for17`='$billings_for17', `amount17`='$amount17', `date18`='$date18', `billings_for18`='$billings_for18', `amount18`='$amount18',`date19`='$date19', `billings_for19`='$billings_for19', `amount19`='$amount19', `date20`='$date20', `billings_for20`='$billings_for20', `amount20`='$amount20',`date21`='$date21', `billings_for21`='$billings_for21', `amount21`='$amount21', `date22`='$date22', `billings_for22`='$billings_for22', `amount22`='$amount22', `date23`='$date23', `billings_for23`='$billings_for23', `amount23`='$amount23', `date24`='$date24', `billings_for24`='$billings_for24', `amount24`='$amount24', `date25`='$date25', `billings_for25`='$billings_for25', `amount25`='$amount25', `date26`='$date26', `billings_for26`='$billings_for26', `amount26`='$amount26', `date27`='$date27', `billings_for27`='$billings_for27', `amount27`='$amount27', `date28`='$date28', `billings_for28`='$billings_for28', `amount28`='$amount28', `date29`='$date29', `billings_for29`='$billings_for29', `amount29`='$amount29', `date30`='$date30', `billings_for30`='$billings_for30', `amount30`='$amount30' WHERE `ipd_no`='$ipd_no' AND `ipd_no`='$ipd_nu'";
	$check3 = mysqli_query($dbconnect, $sql3) or die (mysqli_error($dbconnect));
	$msg = '<p style = "color: #4F8A10; margin-right: auto; margin-right: auto; text-align: center; background-color: #DFF2BF; border-radius:.5em; width: 400px; border: 1px solid #D8D8D8; margin-left: auto; margin-right: auto; padding: 5px; border-radius: 5px; font-family: Arial; font-size: 11px; text-transform: uppercase; text-transform: uppercase">Operation Successful...<a href="print.php?ipd_no='.$ipd_no.'">Click here to print</a>  or  <a href="billing_sheet3.php?ipd_no='.$ipd_no.'" style="color: blue">move to next page</a></p>';
}
if (isset($_POST['update'])){
	$date16 = htmlspecialchars($_POST['date16']);
	$billings_for16 = htmlspecialchars($_POST['billings_for16']);
	$amount16 = htmlspecialchars($_POST['amount16']);
	$date17 = htmlspecialchars($_POST['date17']);
	$billings_for17 = htmlspecialchars($_POST['billings_for17']);
	$amount17 = htmlspecialchars($_POST['amount17']);
	$date18 = htmlspecialchars($_POST['date18']);
	$billings_for18 = htmlspecialchars($_POST['billings_for18']);
	$amount18 = htmlspecialchars($_POST['amount18']);
	$date19 = htmlspecialchars($_POST['date19']);
	$billings_for19 = htmlspecialchars($_POST['billings_for19']);
	$amount19 = htmlspecialchars($_POST['amount19']);
	$date20 = htmlspecialchars($_POST['date20']);
	$billings_for20 = htmlspecialchars($_POST['billings_for20']);
	$amount20 = htmlspecialchars($_POST['amount20']);
	$date21 = htmlspecialchars($_POST['date21']);
	$billings_for21 = htmlspecialchars($_POST['billings_for21']);
	$amount21 = htmlspecialchars($_POST['amount21']);
	$date22 = htmlspecialchars($_POST['date22']);
	$billings_for22 = htmlspecialchars($_POST['billings_for22']);
	$amount22 = htmlspecialchars($_POST['amount22']);
	$date23 = htmlspecialchars($_POST['date23']);
	$billings_for23 = htmlspecialchars($_POST['billings_for23']);
	$amount23 = htmlspecialchars($_POST['amount23']);
	$date24 = htmlspecialchars($_POST['date24']);
	$billings_for24 = htmlspecialchars($_POST['billings_for24']);
	$amount24 = htmlspecialchars($_POST['amount24']);
	$date25 = htmlspecialchars($_POST['date25']);
	$billings_for25 = htmlspecialchars($_POST['billings_for25']);
	$amount25 = htmlspecialchars($_POST['amount25']);
	$date26 = htmlspecialchars($_POST['date26']);
	$billings_for26 = htmlspecialchars($_POST['billings_for26']);
	$amount26 = htmlspecialchars($_POST['amount26']);
	$date27 = htmlspecialchars($_POST['date27']);
	$billings_for27 = htmlspecialchars($_POST['billings_for27']);
	$amount27 = htmlspecialchars($_POST['amount27']);
	$date28 = htmlspecialchars($_POST['date28']);
	$billings_for28 = htmlspecialchars($_POST['billings_for28']);
	$amount28 = htmlspecialchars($_POST['amount28']);
	$date29 = htmlspecialchars($_POST['date29']);
	$billings_for29 = htmlspecialchars($_POST['billings_for29']);
	$amount29 = htmlspecialchars($_POST['amount29']);
	$date30 = htmlspecialchars($_POST['date30']);
	$billings_for30 = htmlspecialchars($_POST['billings_for30']);
	$amount30 = htmlspecialchars($_POST['amount30']);
	
	$sql3 = "UPDATE `ipd_billings_form` SET `last_visited_page`='$last_url', `date16`='$date16', `billings_for16`='$billings_for16', `amount16`='$amount16', `date17`='$date17', `billings_for17`='$billings_for17', `amount17`='$amount17', `date18`='$date18', `billings_for18`='$billings_for18', `amount18`='$amount18',`date19`='$date19', `billings_for19`='$billings_for19', `amount19`='$amount19', `date20`='$date20', `billings_for20`='$billings_for20', `amount20`='$amount20',`date21`='$date21', `billings_for21`='$billings_for21', `amount21`='$amount21', `date22`='$date22', `billings_for22`='$billings_for22', `amount22`='$amount22', `date23`='$date23', `billings_for23`='$billings_for23', `amount23`='$amount23', `date24`='$date24', `billings_for24`='$billings_for24', `amount24`='$amount24', `date25`='$date25', `billings_for25`='$billings_for25', `amount25`='$amount25', `date26`='$date26', `billings_for26`='$billings_for26', `amount26`='$amount26', `date27`='$date27', `billings_for27`='$billings_for27', `amount27`='$amount27', `date28`='$date28', `billings_for28`='$billings_for28', `amount28`='$amount28', `date29`='$date29', `billings_for29`='$billings_for29', `amount29`='$amount29', `date30`='$date30', `billings_for30`='$billings_for30', `amount30`='$amount30' WHERE `ipd_no`='$search'";
	$check3 = mysqli_query($dbconnect, $sql3) or die (mysqli_error($dbconnect));
	$msg = '<p style = "color: #4F8A10; margin-right: auto; margin-right: auto; text-align: center; background-color: #DFF2BF; border-radius:.5em; width: 400px; border: 1px solid #D8D8D8; margin-left: auto; margin-right: auto; padding: 5px; border-radius: 5px; font-family: Arial; font-size: 11px; text-transform: uppercase; text-transform: uppercase">Operation Successful...<a href="print.php?ipd_no='.$search.'">Click here to print</a>  or  <a href="billing_sheet3.php?ipd_no='.$search.'" style="color: blue">move to next page</a></p>';
}
if (isset($_POST['clear'])){
	unset($_SESSION['search']);
}
?>
<!doctype html>
<html>
<link href="http://localhost/buth_net/pharmacySection/css/buth_net.css" rel="stylesheet" type="text/css">
<head>
<meta charset="utf-8">
<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
<meta http-equiv="Pragma" content="no-cache" />
<meta http-equiv="Expires" content="0" />
<link rel="shortcut icon" href="/favicon.ico" >
<title>Billing Sheet2</title>
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
	  	<center><h3 class="heading_text">I.P.D. Billing Sheet</h3></center>
		<?php echo $msg; ?>
	  <div class="bio_data">
	  <form action="" method="post" enctype="multipart/form-data">
	   <div class="form_data1">
	   <input type="submit" value="Clear" name="clear" style="padding: 3px 15px; font-size: 18px; float: right; margin-right: 0px" id="rec_submit"><br><br>
			 <table width="755px" style="margin-left: auto; margin-right: auto; background-color: #C5DFFA;" cellpadding="2" cellspacing="0" border="1">
					<th width="25%"><label>Date</label><input type="text" id="userarea" style="width: 110px" name="date16" placeholder="YYYY-MM-DD" value="<?=@$date16?>"></th>
					<th width="45%"><label>Billings For</label><select name="billings_for16" id="userarea" style="width: 180px">
					<option value="<?php echo $billings_for16; ?>"><?php echo $billings_for16; ?></option>
					<option value="Null">Select Billings For</option>
					<option value="Card">Card</option>
					<option value="Lab">Lab</option>
					<option value="X-Ray">X-Ray</option>
					<option value="Pharm">Pharm</option>
					<option value="Ward Proc">Ward Proc</option>
					<option value="O/R">O/R</option>
					<option value="Delivery">Delivery</option>
					<option value="Physio">Physio</option>
					<option value="DRS Ward">DR'S Ward Round</option>
					<option value="Bed Fee">Bed Fee</option>
					<option value="Utility">Utility</option>
					<option value="Service Charge">Service Charge</option>
					<option value="Credit">Credit</option>
					<option value="Immunization">Immunization</option>
					</select></th>
					<th width="30%"><label>Amount N</label><input type="text" id="userarea" style="width: 100px" name="amount16" value="<?=@$amount16?>"></th>
				</table>
				 <table width="755px" style="margin-left: auto; margin-right: auto; background-color: #C5DFFA;" cellpadding="2" cellspacing="0" border="1">
					<th width="25%"><label>Date</label><input type="text" id="userarea" style="width: 110px" name="date17" placeholder="YYYY-MM-DD" value="<?=@$date17?>"></th>
					<th width="45%"><label>Billings For</label><select name="billings_for17" id="userarea" style="width: 180px">
					<option value="<?php echo $billings_for17; ?>"><?php echo $billings_for17; ?></option>
					<option value="Null">Select Billings For</option>
					<option value="Card">Card</option>
					<option value="Lab">Lab</option>
					<option value="X-Ray">X-Ray</option>
					<option value="Pharm">Pharm</option>
					<option value="Ward Proc">Ward Proc</option>
					<option value="O/R">O/R</option>
					<option value="Delivery">Delivery</option>
					<option value="Physio">Physio</option>
					<option value="DRS Ward">DR'S Ward Round</option>
					<option value="Bed Fee">Bed Fee</option>
					<option value="Utility">Utility</option>
					<option value="Service Charge">Service Charge</option>
					<option value="Credit">Credit</option>
					<option value="Immunization">Immunization</option>
					</select></th>
					<th width="30%"><label>Amount N</label><input type="text" id="userarea" style="width: 100px" name="amount17" value="<?=@$amount17?>"></th>
				</table>
				 <table width="755px" style="margin-left: auto; margin-right: auto; background-color: #C5DFFA;" cellpadding="2" cellspacing="0" border="1">
					<th width="25%"><label>Date</label><input type="text" id="userarea" style="width: 110px" name="date18" placeholder="YYYY-MM-DD" value="<?=@$date18?>"></th>
					<th width="45%"><label>Billings For</label><select name="billings_for18" id="userarea" style="width: 180px">
					<option value="<?php echo $billings_for18; ?>"><?php echo $billings_for18; ?></option>
					<option value="Null">Select Billings For</option>
					<option value="Card">Card</option>
					<option value="Lab">Lab</option>
					<option value="X-Ray">X-Ray</option>
					<option value="Pharm">Pharm</option>
					<option value="Ward Proc">Ward Proc</option>
					<option value="O/R">O/R</option>
					<option value="Delivery">Delivery</option>
					<option value="Physio">Physio</option>
					<option value="DRS Ward">DR'S Ward Round</option>
					<option value="Bed Fee">Bed Fee</option>
					<option value="Utility">Utility</option>
					<option value="Service Charge">Service Charge</option>
					<option value="Credit">Credit</option>
					<option value="Immunization">Immunization</option>
					</select></th>
					<th width="30%"><label>Amount N</label><input type="text" id="userarea" style="width: 100px" name="amount18" value="<?=@$amount18?>"></th>
				</table>
				 <table width="755px" style="margin-left: auto; margin-right: auto; background-color: #C5DFFA;" cellpadding="2" cellspacing="0" border="1">
					<th width="25%"><label>Date</label><input type="text" id="userarea" style="width: 110px" name="date19" placeholder="YYYY-MM-DD" value="<?=@$date19?>"></th>
					<th width="45%"><label>Billings For</label><select name="billings_for19" id="userarea" style="width: 180px">
					<option value="<?php echo $billings_for19; ?>"><?php echo $billings_for19; ?></option>
					<option value="Null">Select Billings For</option>
					<option value="Card">Card</option>
					<option value="Lab">Lab</option>
					<option value="X-Ray">X-Ray</option>
					<option value="Pharm">Pharm</option>
					<option value="Ward Proc">Ward Proc</option>
					<option value="O/R">O/R</option>
					<option value="Delivery">Delivery</option>
					<option value="Physio">Physio</option>
					<option value="DRS Ward">DR'S Ward Round</option>
					<option value="Bed Fee">Bed Fee</option>
					<option value="Utility">Utility</option>
					<option value="Service Charge">Service Charge</option>
					<option value="Credit">Credit</option>
					<option value="Immunization">Immunization</option>
					</select></th>
					<th width="30%"><label>Amount N</label><input type="text" id="userarea" style="width: 100px" name="amount19" value="<?=@$amount19?>"></th>
				</table>
				 <table width="755px" style="margin-left: auto; margin-right: auto; background-color: #C5DFFA;" cellpadding="2" cellspacing="0" border="1">
					<th width="25%"><label>Date</label><input type="text" id="userarea" style="width: 110px" name="date20" placeholder="YYYY-MM-DD" value="<?=@$date20?>"></th>
					<th width="45%"><label>Billings For</label><select name="billings_for20" id="userarea" style="width: 180px">
					<option value="<?php echo $billings_for20; ?>"><?php echo $billings_for20; ?></option>
					<option value="Null">Select Billings For</option>
					<option value="Card">Card</option>
					<option value="Lab">Lab</option>
					<option value="X-Ray">X-Ray</option>
					<option value="Pharm">Pharm</option>
					<option value="Ward Proc">Ward Proc</option>
					<option value="O/R">O/R</option>
					<option value="Delivery">Delivery</option>
					<option value="Physio">Physio</option>
					<option value="DRS Ward">DR'S Ward Round</option>
					<option value="Bed Fee">Bed Fee</option>
					<option value="Utility">Utility</option>
					<option value="Service Charge">Service Charge</option>
					<option value="Credit">Credit</option>
					<option value="Immunization">Immunization</option>
					</select></th>
					<th width="30%"><label>Amount N</label><input type="text" id="userarea" style="width: 100px" name="amount20" value="<?=@$amount20?>"></th>
				</table>
				 <table width="755px" style="margin-left: auto; margin-right: auto; background-color: #C5DFFA;" cellpadding="2" cellspacing="0" border="1">
					<th width="25%"><label>Date</label><input type="text" id="userarea" style="width: 110px" name="date21" placeholder="YYYY-MM-DD" value="<?=@$date21?>"></th>
					<th width="45%"><label>Billings For</label><select name="billings_for21" id="userarea" style="width: 180px">
					<option value="<?php echo $billings_for21; ?>"><?php echo $billings_for21; ?></option>
					<option value="Null">Select Billings For</option>
					<option value="Card">Card</option>
					<option value="Lab">Lab</option>
					<option value="X-Ray">X-Ray</option>
					<option value="Pharm">Pharm</option>
					<option value="Ward Proc">Ward Proc</option>
					<option value="O/R">O/R</option>
					<option value="Delivery">Delivery</option>
					<option value="Physio">Physio</option>
					<option value="DRS Ward">DR'S Ward Round</option>
					<option value="Bed Fee">Bed Fee</option>
					<option value="Utility">Utility</option>
					<option value="Service Charge">Service Charge</option>
					<option value="Credit">Credit</option>
					<option value="Immunization">Immunization</option>
					</select></th>
					<th width="30%"><label>Amount N</label><input type="text" id="userarea" style="width: 100px" name="amount21" value="<?=@$amount21?>"></th>
				</table>
				 <table width="755px" style="margin-left: auto; margin-right: auto; background-color: #C5DFFA;" cellpadding="2" cellspacing="0" border="1">
					<th width="25%"><label>Date</label><input type="text" id="userarea" style="width: 110px" name="date22" placeholder="YYYY-MM-DD" value="<?=@$date22?>"></th>
					<th width="45%"><label>Billings For</label><select name="billings_for22" id="userarea" style="width: 180px">
					<option value="<?php echo $billings_for22; ?>"><?php echo $billings_for22; ?></option>
					<option value="Null">Select Billings For</option>
					<option value="Card">Card</option>
					<option value="Lab">Lab</option>
					<option value="X-Ray">X-Ray</option>
					<option value="Pharm">Pharm</option>
					<option value="Ward Proc">Ward Proc</option>
					<option value="O/R">O/R</option>
					<option value="Delivery">Delivery</option>
					<option value="Physio">Physio</option>
					<option value="DRS Ward">DR'S Ward Round</option>
					<option value="Bed Fee">Bed Fee</option>
					<option value="Utility">Utility</option>
					<option value="Service Charge">Service Charge</option>
					<option value="Credit">Credit</option>
					<option value="Immunization">Immunization</option>
					</select></th>
					<th width="30%"><label>Amount N</label><input type="text" id="userarea" style="width: 100px" name="amount22" value="<?=@$amount22?>"></th>
				</table>
				 <table width="755px" style="margin-left: auto; margin-right: auto; background-color: #C5DFFA;" cellpadding="2" cellspacing="0" border="1">
					<th width="25%"><label>Date</label><input type="text" id="userarea" style="width: 110px" name="date23" placeholder="YYYY-MM-DD" value="<?=@$date23?>"></th>
					<th width="45%"><label>Billings For</label><select name="billings_for23" id="userarea" style="width: 180px">
					<option value="<?php echo $billings_for23; ?>"><?php echo $billings_for23; ?></option>
					<option value="Null">Select Billings For</option>
					<option value="Card">Card</option>
					<option value="Lab">Lab</option>
					<option value="X-Ray">X-Ray</option>
					<option value="Pharm">Pharm</option>
					<option value="Ward Proc">Ward Proc</option>
					<option value="O/R">O/R</option>
					<option value="Delivery">Delivery</option>
					<option value="Physio">Physio</option>
					<option value="DRS Ward">DR'S Ward Round</option>
					<option value="Bed Fee">Bed Fee</option>
					<option value="Utility">Utility</option>
					<option value="Service Charge">Service Charge</option>
					<option value="Credit">Credit</option>
					<option value="Immunization">Immunization</option>
					</select></th>
					<th width="30%"><label>Amount N</label><input type="text" id="userarea" style="width: 100px" name="amount23" value="<?=@$amount23?>"></th>
				</table>
				 <table width="755px" style="margin-left: auto; margin-right: auto; background-color: #C5DFFA;" cellpadding="2" cellspacing="0" border="1">
					<th width="25%"><label>Date</label><input type="text" id="userarea" style="width: 110px" name="date24" placeholder="YYYY-MM-DD" value="<?=@$date24?>"></th>
					<th width="45%"><label>Billings For</label><select name="billings_for24" id="userarea" style="width: 180px">
					<option value="<?php echo $billings_for24; ?>"><?php echo $billings_for24; ?></option>
					<option value="Null">Select Billings For</option>
					<option value="Card">Card</option>
					<option value="Lab">Lab</option>
					<option value="X-Ray">X-Ray</option>
					<option value="Pharm">Pharm</option>
					<option value="Ward Proc">Ward Proc</option>
					<option value="O/R">O/R</option>
					<option value="Delivery">Delivery</option>
					<option value="Physio">Physio</option>
					<option value="DRS Ward">DR'S Ward Round</option>
					<option value="Bed Fee">Bed Fee</option>
					<option value="Utility">Utility</option>
					<option value="Service Charge">Service Charge</option>
					<option value="Credit">Credit</option>
					<option value="Immunization">Immunization</option>
					</select></th>
					<th width="30%"><label>Amount N</label><input type="text" id="userarea" style="width: 100px" name="amount24" value="<?=@$amount24?>"></th>
				</table>
				 <table width="755px" style="margin-left: auto; margin-right: auto; background-color: #C5DFFA;" cellpadding="2" cellspacing="0" border="1">
					<th width="25%"><label>Date</label><input type="text" id="userarea" style="width: 110px" name="date25" placeholder="YYYY-MM-DD" value="<?=@$date25?>"></th>
					<th width="45%"><label>Billings For</label><select name="billings_for25" id="userarea" style="width: 180px">
					<option value="<?php echo $billings_for25; ?>"><?php echo $billings_for25; ?></option>
					<option value="Null">Select Billings For</option>
					<option value="Card">Card</option>
					<option value="Lab">Lab</option>
					<option value="X-Ray">X-Ray</option>
					<option value="Pharm">Pharm</option>
					<option value="Ward Proc">Ward Proc</option>
					<option value="O/R">O/R</option>
					<option value="Delivery">Delivery</option>
					<option value="Physio">Physio</option>
					<option value="DRS Ward">DR'S Ward Round</option>
					<option value="Bed Fee">Bed Fee</option>
					<option value="Utility">Utility</option>
					<option value="Service Charge">Service Charge</option>
					<option value="Credit">Credit</option>
					<option value="Immunization">Immunization</option>
					</select></th>
					<th width="30%"><label>Amount N</label><input type="text" id="userarea" style="width: 100px" name="amount25" value="<?=@$amount25?>"></th>
				</table>
				 <table width="755px" style="margin-left: auto; margin-right: auto; background-color: #C5DFFA;" cellpadding="2" cellspacing="0" border="1">
					<th width="25%"><label>Date</label><input type="text" id="userarea" style="width: 110px" name="date26" placeholder="YYYY-MM-DD" value="<?=@$date26?>"></th>
					<th width="45%"><label>Billings For</label><select name="billings_for26" id="userarea" style="width: 180px">
					<option value="<?php echo $billings_for26; ?>"><?php echo $billings_for26; ?></option>
					<option value="Null">Select Billings For</option>
					<option value="Card">Card</option>
					<option value="Lab">Lab</option>
					<option value="X-Ray">X-Ray</option>
					<option value="Pharm">Pharm</option>
					<option value="Ward Proc">Ward Proc</option>
					<option value="O/R">O/R</option>
					<option value="Delivery">Delivery</option>
					<option value="Physio">Physio</option>
					<option value="DRS Ward">DR'S Ward Round</option>
					<option value="Bed Fee">Bed Fee</option>
					<option value="Utility">Utility</option>
					<option value="Service Charge">Service Charge</option>
					<option value="Credit">Credit</option>
					<option value="Immunization">Immunization</option>
					</select></th>
					<th width="30%"><label>Amount N</label><input type="text" id="userarea" style="width: 100px" name="amount26" value="<?=@$amount26?>"></th>
				</table> <table width="755px" style="margin-left: auto; margin-right: auto; background-color: #C5DFFA;" cellpadding="2" cellspacing="0" border="1">
					<th width="25%"><label>Date</label><input type="text" id="userarea" style="width: 110px" name="date27" placeholder="YYYY-MM-DD" value="<?=@$date27?>"></th>
					<th width="45%"><label>Billings For</label><select name="billings_for27" id="userarea" style="width: 180px">
					<option value="<?php echo $billings_for27; ?>"><?php echo $billings_for27; ?></option>
					<option value="Null">Select Billings For</option>
					<option value="Card">Card</option>
					<option value="Lab">Lab</option>
					<option value="X-Ray">X-Ray</option>
					<option value="Pharm">Pharm</option>
					<option value="Ward Proc">Ward Proc</option>
					<option value="O/R">O/R</option>
					<option value="Delivery">Delivery</option>
					<option value="Physio">Physio</option>
					<option value="DRS Ward">DR'S Ward Round</option>
					<option value="Bed Fee">Bed Fee</option>
					<option value="Utility">Utility</option>
					<option value="Service Charge">Service Charge</option>
					<option value="Credit">Credit</option>
					<option value="Immunization">Immunization</option>
					</select></th>
					<th width="30%"><label>Amount N</label><input type="text" id="userarea" style="width: 100px" name="amount27" value="<?=@$amount27?>"></th>
				</table> <table width="755px" style="margin-left: auto; margin-right: auto; background-color: #C5DFFA;" cellpadding="2" cellspacing="0" border="1">
					<th width="25%"><label>Date</label><input type="text" id="userarea" style="width: 110px" name="date28" placeholder="YYYY-MM-DD" value="<?=@$date28?>"></th>
					<th width="45%"><label>Billings For</label><select name="billings_for28" id="userarea" style="width: 180px">
					<option value="<?php echo $billings_for28; ?>"><?php echo $billings_for28; ?></option>
					<option value="Null">Select Billings For</option>
					<option value="Card">Card</option>
					<option value="Lab">Lab</option>
					<option value="X-Ray">X-Ray</option>
					<option value="Pharm">Pharm</option>
					<option value="Ward Proc">Ward Proc</option>
					<option value="O/R">O/R</option>
					<option value="Delivery">Delivery</option>
					<option value="Physio">Physio</option>
					<option value="DRS Ward">DR'S Ward Round</option>
					<option value="Bed Fee">Bed Fee</option>
					<option value="Utility">Utility</option>
					<option value="Service Charge">Service Charge</option>
					<option value="Credit">Credit</option>
					<option value="Immunization">Immunization</option>
					</select></th>
					<th width="30%"><label>Amount N</label><input type="text" id="userarea" style="width: 100px" name="amount28" value="<?=@$amount28?>"></th>
				</table>
				 <table width="755px" style="margin-left: auto; margin-right: auto; background-color: #C5DFFA;" cellpadding="2" cellspacing="0" border="1">
					<th width="25%"><label>Date</label><input type="text" id="userarea" style="width: 110px" name="date29" placeholder="YYYY-MM-DD" value="<?=@$date29?>"></th>
					<th width="45%"><label>Billings For</label><select name="billings_for29" id="userarea" style="width: 180px">
					<option value="<?php echo $billings_for29; ?>"><?php echo $billings_for29; ?></option>
					<option value="Null">Select Billings For</option>
					<option value="Card">Card</option>
					<option value="Lab">Lab</option>
					<option value="X-Ray">X-Ray</option>
					<option value="Pharm">Pharm</option>
					<option value="Ward Proc">Ward Proc</option>
					<option value="O/R">O/R</option>
					<option value="Delivery">Delivery</option>
					<option value="Physio">Physio</option>
					<option value="DRS Ward">DR'S Ward Round</option>
					<option value="Bed Fee">Bed Fee</option>
					<option value="Utility">Utility</option>
					<option value="Service Charge">Service Charge</option>
					<option value="Credit">Credit</option>
					<option value="Immunization">Immunization</option>
					</select></th>
					<th width="30%"><label>Amount N</label><input type="text" id="userarea" style="width: 100px" name="amount29" value="<?=@$amount29?>"></th>
				</table>
				 <table width="755px" style="margin-left: auto; margin-right: auto; background-color: #C5DFFA;" cellpadding="2" cellspacing="0" border="1">
					<th width="25%"><label>Date</label><input type="text" id="userarea" style="width: 110px" name="date30" placeholder="YYYY-MM-DD" value="<?=@$date30?>"></th>
					<th width="45%"><label>Billings For</label><select name="billings_for30" id="userarea" style="width: 180px">
					<option value="<?php echo $billings_for30; ?>"><?php echo $billings_for30; ?></option>
					<option value="Null">Select Billings For</option>
					<option value="Card">Card</option>
					<option value="Lab">Lab</option>
					<option value="X-Ray">X-Ray</option>
					<option value="Pharm">Pharm</option>
					<option value="Ward Proc">Ward Proc</option>
					<option value="O/R">O/R</option>
					<option value="Delivery">Delivery</option>
					<option value="Physio">Physio</option>
					<option value="DRS Ward">DR'S Ward Round</option>
					<option value="Bed Fee">Bed Fee</option>
					<option value="Utility">Utility</option>
					<option value="Service Charge">Service Charge</option>
					<option value="Credit">Credit</option>
					<option value="Immunization">Immunization</option>
					</select></th>
					<th width="30%"><label>Amount N</label><input type="text" id="userarea" style="width: 100px" name="amount30" value="<?=@$amount30?>"></th>
				</table>
			 </div>
			 </div><br>
			 <input type="submit" value="Update" style="padding: 3px 15px; font-size: 18px; margin-left: 22px" name="update" id="rec_submit">
			 <input type="submit" value="Next Page" style="padding: 3px 15px; font-size: 18px; float: right; margin-right: 20px" name="next" id="rec_submit"><br>
	   </form><br>
	  </div>
   <!-- end .content --></div>
  <!-- end .container --></div>
     <?php
      include_once "../footer.php";
     ?>
</body>
</html>