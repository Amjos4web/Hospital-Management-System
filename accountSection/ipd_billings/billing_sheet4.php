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

// pass the information into the database
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
		$date46=$row["date46"];
		$billings_for46=$row["billings_for46"];
		$amount46=$row["amount46"];
		$date47=$row["date47"];
		$billings_for47=$row["billings_for47"];
		$amount47=$row["amount47"];
		$date48=$row["date48"];
		$billings_for48=$row["billings_for48"];
		$amount48=$row["amount48"];
		$date49=$row["date49"];
		$billings_for49=$row["billings_for49"];
		$amount49=$row["amount49"];
		$date50=$row["date50"];
		$billings_for50=$row["billings_for50"];
		$amount50=$row["amount50"];
		$date51=$row["date51"];
		$billings_for51=$row["billings_for51"];
		$amount51=$row["amount51"];
		$date52=$row["date52"];
		$billings_for52=$row["billings_for52"];
		$amount52=$row["amount52"];
		$date53=$row["date53"];
		$billings_for53=$row["billings_for53"];
		$amount53=$row["amount53"];
		$date54=$row["date54"];
		$billings_for54=$row["billings_for54"];
		$amount54=$row["amount54"];
		$date55=$row["date55"];
		$billings_for55=$row["billings_for55"];
		$amount55=$row["amount55"];
		$date56=$row["date56"];
		$billings_for56=$row["billings_for56"];
		$amount56=$row["amount56"];
		$date57=$row["date57"];
		$billings_for57=$row["billings_for57"];
		$amount57=$row["amount57"];
		$date58=$row["date58"];
		$billings_for58=$row["billings_for58"];
		$amount58=$row["amount58"];
		$date59=$row["date59"];
		$billings_for59=$row["billings_for59"];
		$amount59=$row["amount59"];
		$date60=$row["date60"];
		$billings_for60=$row["billings_for60"];
		$amount60=$row["amount60"];
		
	}
}
if (isset($_POST['next'])){
	$date46 = htmlspecialchars($_POST['date46']);
	$billings_for46 = htmlspecialchars($_POST['billings_for46']);
	$amount46 = htmlspecialchars($_POST['amount46']);
	$date47 = htmlspecialchars($_POST['date47']);
	$billings_for47 = htmlspecialchars($_POST['billings_for47']);
	$amount47 = htmlspecialchars($_POST['amount47']);
	$date48 = htmlspecialchars($_POST['date48']);
	$billings_for48 = htmlspecialchars($_POST['billings_for48']);
	$amount48 = htmlspecialchars($_POST['amount48']);
	$date49 = htmlspecialchars($_POST['date49']);
	$billings_for49 = htmlspecialchars($_POST['billings_for49']);
	$amount49 = htmlspecialchars($_POST['amount49']);
	$date50 = htmlspecialchars($_POST['date50']);
	$billings_for50 = htmlspecialchars($_POST['billings_for50']);
	$amount50 = htmlspecialchars($_POST['amount50']);
	$date51 = htmlspecialchars($_POST['date51']);
	$billings_for51 = htmlspecialchars($_POST['billings_for51']);
	$amount51 = htmlspecialchars($_POST['amount51']);
	$date52 = htmlspecialchars($_POST['date52']);
	$billings_for52 = htmlspecialchars($_POST['billings_for52']);
	$amount52 = htmlspecialchars($_POST['amount52']);
	$date53 = htmlspecialchars($_POST['date53']);
	$billings_for53 = htmlspecialchars($_POST['billings_for53']);
	$amount53 = htmlspecialchars($_POST['amount53']);
	$date54 = htmlspecialchars($_POST['date54']);
	$billings_for54 = htmlspecialchars($_POST['billings_for54']);
	$amount54 = htmlspecialchars($_POST['amount54']);
	$date55 = htmlspecialchars($_POST['date55']);
	$billings_for55 = htmlspecialchars($_POST['billings_for55']);
	$amount55 = htmlspecialchars($_POST['amount55']);
	$date56 = htmlspecialchars($_POST['date56']);
	$billings_for56 = htmlspecialchars($_POST['billings_for56']);
	$amount56 = htmlspecialchars($_POST['amount56']);
	$date57 = htmlspecialchars($_POST['date57']);
	$billings_for57 = htmlspecialchars($_POST['billings_for57']);
	$amount57 = htmlspecialchars($_POST['amount57']);
	$date58 = htmlspecialchars($_POST['date58']);
	$billings_for58 = htmlspecialchars($_POST['billings_for58']);
	$amount58 = htmlspecialchars($_POST['amount58']);
	$date59 = htmlspecialchars($_POST['date59']);
	$billings_for59 = htmlspecialchars($_POST['billings_for59']);
	$amount59 = htmlspecialchars($_POST['amount59']);
	$date60 = htmlspecialchars($_POST['date60']);
	$billings_for60 = htmlspecialchars($_POST['billings_for60']);
	$amount60 = htmlspecialchars($_POST['amount60']);
	
	$sql3 = "UPDATE `ipd_billings_form` SET `last_visited_page`='$last_url', `date46`='$date46', `billings_for46`='$billings_for46', `amount46`='$amount46', `date47`='$date47', `billings_for47`='$billings_for47', `amount47`='$amount47', `date48`='$date48', `billings_for48`='$billings_for48', `amount48`='$amount48',`date49`='$date49', `billings_for49`='$billings_for49', `amount49`='$amount49', `date50`='$date50', `billings_for50`='$billings_for50', `amount50`='$amount50',`date51`='$date51', `billings_for51`='$billings_for51', `amount51`='$amount51', `date52`='$date52', `billings_for52`='$billings_for52', `amount52`='$amount52', `date53`='$date53', `billings_for53`='$billings_for53', `amount53`='$amount53', `date54`='$date54', `billings_for54`='$billings_for54', `amount54`='$amount54', `date55`='$date55', `billings_for55`='$billings_for55', `amount55`='$amount55', `date56`='$date56', `billings_for56`='$billings_for56', `amount56`='$amount56', `date57`='$date57', `billings_for57`='$billings_for57', `amount57`='$amount57', `date58`='$date58', `billings_for58`='$billings_for58', `amount58`='$amount58', `date59`='$date59', `billings_for59`='$billings_for59', `amount59`='$amount59', `date60`='$date60', `billings_for60`='$billings_for60', `amount60`='$amount60' WHERE `ipd_no`='$ipd_no' AND `ipd_no`='$ipd_nu'";
	$check3 = mysqli_query($dbconnect, $sql3) or die (mysqli_error($dbconnect));
	$msg = '<p style = "color: #4F8A10; margin-right: auto; margin-right: auto; text-align: center; background-color: #DFF2BF; border-radius:.5em; width: 400px; border: 1px solid #D8D8D8; margin-left: auto; margin-right: auto; padding: 5px; border-radius: 5px; font-family: Arial; font-size: 11px; text-transform: uppercase; text-transform: uppercase">Operation Successful...<a href="print.php?ipd_no='.$ipd_no.'">Click here to print</a></p>';
}
if (isset($_POST['update'])){
	$date46 = htmlspecialchars($_POST['date46']);
	$billings_for46 = htmlspecialchars($_POST['billings_for46']);
	$amount46 = htmlspecialchars($_POST['amount46']);
	$date47 = htmlspecialchars($_POST['date47']);
	$billings_for47 = htmlspecialchars($_POST['billings_for47']);
	$amount47 = htmlspecialchars($_POST['amount47']);
	$date48 = htmlspecialchars($_POST['date48']);
	$billings_for48 = htmlspecialchars($_POST['billings_for48']);
	$amount48 = htmlspecialchars($_POST['amount48']);
	$date49 = htmlspecialchars($_POST['date49']);
	$billings_for49 = htmlspecialchars($_POST['billings_for49']);
	$amount49 = htmlspecialchars($_POST['amount49']);
	$date50 = htmlspecialchars($_POST['date50']);
	$billings_for50 = htmlspecialchars($_POST['billings_for50']);
	$amount50 = htmlspecialchars($_POST['amount50']);
	$date51 = htmlspecialchars($_POST['date51']);
	$billings_for51 = htmlspecialchars($_POST['billings_for51']);
	$amount51 = htmlspecialchars($_POST['amount51']);
	$date52 = htmlspecialchars($_POST['date52']);
	$billings_for52 = htmlspecialchars($_POST['billings_for52']);
	$amount52 = htmlspecialchars($_POST['amount52']);
	$date53 = htmlspecialchars($_POST['date53']);
	$billings_for53 = htmlspecialchars($_POST['billings_for53']);
	$amount53 = htmlspecialchars($_POST['amount53']);
	$date54 = htmlspecialchars($_POST['date54']);
	$billings_for54 = htmlspecialchars($_POST['billings_for54']);
	$amount54 = htmlspecialchars($_POST['amount54']);
	$date55 = htmlspecialchars($_POST['date55']);
	$billings_for55 = htmlspecialchars($_POST['billings_for55']);
	$amount55 = htmlspecialchars($_POST['amount55']);
	$date56 = htmlspecialchars($_POST['date56']);
	$billings_for56 = htmlspecialchars($_POST['billings_for56']);
	$amount56 = htmlspecialchars($_POST['amount56']);
	$date57 = htmlspecialchars($_POST['date57']);
	$billings_for57 = htmlspecialchars($_POST['billings_for57']);
	$amount57 = htmlspecialchars($_POST['amount57']);
	$date58 = htmlspecialchars($_POST['date58']);
	$billings_for58 = htmlspecialchars($_POST['billings_for58']);
	$amount58 = htmlspecialchars($_POST['amount58']);
	$date59 = htmlspecialchars($_POST['date59']);
	$billings_for59 = htmlspecialchars($_POST['billings_for59']);
	$amount59 = htmlspecialchars($_POST['amount59']);
	$date60 = htmlspecialchars($_POST['date60']);
	$billings_for60 = htmlspecialchars($_POST['billings_for60']);
	$amount60 = htmlspecialchars($_POST['amount60']);
	
	$sql3 = "UPDATE `ipd_billings_form` SET `last_visited_page`='$last_url', `date46`='$date46', `billings_for46`='$billings_for46', `amount46`='$amount46', `date47`='$date47', `billings_for47`='$billings_for47', `amount47`='$amount47', `date48`='$date48', `billings_for48`='$billings_for48', `amount48`='$amount48',`date49`='$date49', `billings_for49`='$billings_for49', `amount49`='$amount49', `date50`='$date50', `billings_for50`='$billings_for50', `amount50`='$amount50',`date51`='$date51', `billings_for51`='$billings_for51', `amount51`='$amount51', `date52`='$date52', `billings_for52`='$billings_for52', `amount52`='$amount52', `date53`='$date53', `billings_for53`='$billings_for53', `amount53`='$amount53', `date54`='$date54', `billings_for54`='$billings_for54', `amount54`='$amount54', `date55`='$date55', `billings_for55`='$billings_for55', `amount55`='$amount55', `date56`='$date56', `billings_for56`='$billings_for56', `amount56`='$amount56', `date57`='$date57', `billings_for57`='$billings_for57', `amount57`='$amount57', `date58`='$date58', `billings_for58`='$billings_for58', `amount58`='$amount58', `date59`='$date59', `billings_for59`='$billings_for59', `amount59`='$amount59', `date60`='$date60', `billings_for60`='$billings_for60', `amount60`='$amount60' WHERE `ipd_no`='$search'";
	$check3 = mysqli_query($dbconnect, $sql3) or die (mysqli_error($dbconnect));
	$msg = '<p style = "color: #4F8A10; margin-right: auto; margin-right: auto; text-align: center; background-color: #DFF2BF; border-radius:.5em; width: 400px; border: 1px solid #D8D8D8; margin-left: auto; margin-right: auto; padding: 5px; border-radius: 5px; font-family: Arial; font-size: 11px; text-transform: uppercase; text-transform: uppercase">Operation Successful...<a href="print.php?ipd_no='.$search.'">Click here to print</a></p>';
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
<title>Billing Sheet</title>
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
	  <div class="bio_data">
	  <?php echo $msg; ?>
	  <form action="" method="post" enctype="multipart/form-data">
	   <div class="form_data1">
	   <input type="submit" value="Clear" name="clear" style="padding: 3px 15px; font-size: 18px; float: right; margin-right: 0px" id="rec_submit"><br><br>
			 <table width="755px" style="margin-left: auto; margin-right: auto; background-color: #C5DFFA;" cellpadding="2" cellspacing="0" border="1">
					<th width="25%"><label>Date</label><input type="text" id="userarea" style="width: 110px" name="date46" placeholder="YYYY-MM-DD" value="<?=@$date46?>"></th>
					<th width="45%"><label>Billings For</label><select name="billings_for46" id="userarea" style="width: 180px">
					<option value="<?php echo $billings_for46; ?>"><?php echo $billings_for46; ?></option>
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
					<th width="30%"><label>Amount N</label><input type="text" id="userarea" style="width: 100px" name="amount46" value="<?=@$amount46?>"></th>
				</table>
				 <table width="755px" style="margin-left: auto; margin-right: auto; background-color: #C5DFFA;" cellpadding="2" cellspacing="0" border="1">
					<th width="25%"><label>Date</label><input type="text" id="userarea" style="width: 110px" name="date47" placeholder="YYYY-MM-DD" value="<?=@$date47?>"></th>
					<th width="45%"><label>Billings For</label><select name="billings_for47" id="userarea" style="width: 180px">
					<option value="<?php echo $billings_for47; ?>"><?php echo $billings_for47; ?></option>
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
					<th width="30%"><label>Amount N</label><input type="text" id="userarea" style="width: 100px" name="amount47" value="<?=@$amount47?>"></th>
				</table>
				 <table width="755px" style="margin-left: auto; margin-right: auto; background-color: #C5DFFA;" cellpadding="2" cellspacing="0" border="1">
					<th width="25%"><label>Date</label><input type="text" id="userarea" style="width: 110px" name="date48" placeholder="YYYY-MM-DD" value="<?=@$date48?>"></th>
					<th width="45%"><label>Billings For</label><select name="billings_for48" id="userarea" style="width: 180px">
					<option value="<?php echo $billings_for48; ?>"><?php echo $billings_for48; ?></option>
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
					<th width="30%"><label>Amount N</label><input type="text" id="userarea" style="width: 100px" name="amount48" value="<?=@$amount48?>"></th>
				</table>
				 <table width="755px" style="margin-left: auto; margin-right: auto; background-color: #C5DFFA;" cellpadding="2" cellspacing="0" border="1">
					<th width="25%"><label>Date</label><input type="text" id="userarea" style="width: 110px" name="date49" placeholder="YYYY-MM-DD" value="<?=@$date49?>"></th>
					<th width="45%"><label>Billings For</label><select name="billings_for49" id="userarea" style="width: 180px">
					<option value="<?php echo $billings_for49; ?>"><?php echo $billings_for49; ?></option>
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
					<th width="30%"><label>Amount N</label><input type="text" id="userarea" style="width: 100px" name="amount49" value="<?=@$amount49?>"></th>
				</table>
				 <table width="755px" style="margin-left: auto; margin-right: auto; background-color: #C5DFFA;" cellpadding="2" cellspacing="0" border="1">
					<th width="25%"><label>Date</label><input type="text" id="userarea" style="width: 110px" name="date50" placeholder="YYYY-MM-DD" value="<?=@$date50?>"></th>
					<th width="45%"><label>Billings For</label><select name="billings_for50" id="userarea" style="width: 180px">
					<option value="<?php echo $billings_for50; ?>"><?php echo $billings_for50; ?></option>
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
					<th width="30%"><label>Amount N</label><input type="text" id="userarea" style="width: 100px" name="amount50" value="<?=@$amount50?>"></th>
				</table>
				 <table width="755px" style="margin-left: auto; margin-right: auto; background-color: #C5DFFA;" cellpadding="2" cellspacing="0" border="1">
					<th width="25%"><label>Date</label><input type="text" id="userarea" style="width: 110px" name="date51" placeholder="YYYY-MM-DD" value="<?=@$date51?>"></th>
					<th width="45%"><label>Billings For</label><select name="billings_for51" id="userarea" style="width: 180px">
					<option value="<?php echo $billings_for51; ?>"><?php echo $billings_for51; ?></option>
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
					<th width="30%"><label>Amount N</label><input type="text" id="userarea" style="width: 100px" name="amount51" value="<?=@$amount51?>"></th>
				</table>
				 <table width="755px" style="margin-left: auto; margin-right: auto; background-color: #C5DFFA;" cellpadding="2" cellspacing="0" border="1">
					<th width="25%"><label>Date</label><input type="text" id="userarea" style="width: 110px" name="date52" placeholder="YYYY-MM-DD" value="<?=@$date52?>"></th>
					<th width="45%"><label>Billings For</label><select name="billings_for52" id="userarea" style="width: 180px">
					<option value="<?php echo $billings_for52; ?>"><?php echo $billings_for52; ?></option>
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
					<th width="30%"><label>Amount N</label><input type="text" id="userarea" style="width: 100px" name="amount52" value="<?=@$amount52?>"></th>
				</table>
				 <table width="755px" style="margin-left: auto; margin-right: auto; background-color: #C5DFFA;" cellpadding="2" cellspacing="0" border="1">
					<th width="25%"><label>Date</label><input type="text" id="userarea" style="width: 110px" name="date53" placeholder="YYYY-MM-DD" value="<?=@$date53?>"></th>
					<th width="45%"><label>Billings For</label><select name="billings_for53" id="userarea" style="width: 180px">
					<option value="<?php echo $billings_for53; ?>"><?php echo $billings_for53; ?></option>
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
					<th width="30%"><label>Amount N</label><input type="text" id="userarea" style="width: 100px" name="amount53" value="<?=@$amount53?>"></th>
				</table>
				 <table width="755px" style="margin-left: auto; margin-right: auto; background-color: #C5DFFA;" cellpadding="2" cellspacing="0" border="1">
					<th width="25%"><label>Date</label><input type="text" id="userarea" style="width: 110px" name="date54" placeholder="YYYY-MM-DD" value="<?=@$date54?>"></th>
					<th width="45%"><label>Billings For</label><select name="billings_for54" id="userarea" style="width: 180px">
					<option value="<?php echo $billings_for54; ?>"><?php echo $billings_for54; ?></option>
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
					<th width="30%"><label>Amount N</label><input type="text" id="userarea" style="width: 100px" name="amount54" value="<?=@$amount54?>"></th>
				</table>
				 <table width="755px" style="margin-left: auto; margin-right: auto; background-color: #C5DFFA;" cellpadding="2" cellspacing="0" border="1">
					<th width="25%"><label>Date</label><input type="text" id="userarea" style="width: 110px" name="date55" placeholder="YYYY-MM-DD" value="<?=@$date55?>"></th>
					<th width="45%"><label>Billings For</label><select name="billings_for55" id="userarea" style="width: 180px">
					<option value="<?php echo $billings_for55; ?>"><?php echo $billings_for55; ?></option>
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
					<th width="30%"><label>Amount N</label><input type="text" id="userarea" style="width: 100px" name="amount55" value="<?=@$amount55?>"></th>
				</table>
				 <table width="755px" style="margin-left: auto; margin-right: auto; background-color: #C5DFFA;" cellpadding="2" cellspacing="0" border="1">
					<th width="25%"><label>Date</label><input type="text" id="userarea" style="width: 110px" name="date56" placeholder="YYYY-MM-DD" value="<?=@$date56?>"></th>
					<th width="45%"><label>Billings For</label><select name="billings_for56" id="userarea" style="width: 180px">
					<option value="<?php echo $billings_for56; ?>"><?php echo $billings_for56; ?></option>
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
					<th width="30%"><label>Amount N</label><input type="text" id="userarea" style="width: 100px" name="amount56" value="<?=@$amount56?>"></th>
				</table> <table width="755px" style="margin-left: auto; margin-right: auto; background-color: #C5DFFA;" cellpadding="2" cellspacing="0" border="1">
					<th width="25%"><label>Date</label><input type="text" id="userarea" style="width: 110px" name="date57" placeholder="YYYY-MM-DD" value="<?=@$date57?>"></th>
					<th width="45%"><label>Billings For</label><select name="billings_for57" id="userarea" style="width: 180px">
					<option value="<?php echo $billings_for57; ?>"><?php echo $billings_for57; ?></option>
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
					<th width="30%"><label>Amount N</label><input type="text" id="userarea" style="width: 100px" name="amount57" value="<?=@$amount57?>"></th>
				</table> <table width="755px" style="margin-left: auto; margin-right: auto; background-color: #C5DFFA;" cellpadding="2" cellspacing="0" border="1">
					<th width="25%"><label>Date</label><input type="text" id="userarea" style="width: 110px" name="date58" placeholder="YYYY-MM-DD" value="<?=@$date58?>"></th>
					<th width="45%"><label>Billings For</label><select name="billings_for58" id="userarea" style="width: 180px">
					<option value="<?php echo $billings_for58; ?>"><?php echo $billings_for58; ?></option>
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
					<th width="30%"><label>Amount N</label><input type="text" id="userarea" style="width: 100px" name="amount58" value="<?=@$amount58?>"></th>
				</table>
				 <table width="755px" style="margin-left: auto; margin-right: auto; background-color: #C5DFFA;" cellpadding="2" cellspacing="0" border="1">
					<th width="25%"><label>Date</label><input type="text" id="userarea" style="width: 110px" name="date59" placeholder="YYYY-MM-DD" value="<?=@$date59?>"></th>
					<th width="45%"><label>Billings For</label><select name="billings_for59" id="userarea" style="width: 180px">
					<option value="<?php echo $billings_for59; ?>"><?php echo $billings_for59; ?></option>
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
					<th width="30%"><label>Amount N</label><input type="text" id="userarea" style="width: 100px" name="amount59" value="<?=@$amount59?>"></th>
				</table>
				 <table width="755px" style="margin-left: auto; margin-right: auto; background-color: #C5DFFA;" cellpadding="2" cellspacing="0" border="1">
					<th width="25%"><label>Date</label><input type="text" id="userarea" style="width: 110px" name="date60" placeholder="YYYY-MM-DD" value="<?=@$date60?>"></th>
					<th width="45%"><label>Billings For</label><select name="billings_for60" id="userarea" style="width: 180px">
					<option value="<?php echo $billings_for60; ?>"><?php echo $billings_for60; ?></option>
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
					<th width="30%"><label>Amount N</label><input type="text" id="userarea" style="width: 100px" name="amount60" value="<?=@$amount60?>"></th>
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