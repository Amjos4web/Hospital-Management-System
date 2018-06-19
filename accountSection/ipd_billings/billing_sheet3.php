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
		$date31=$row["date31"];
		$billings_for31=$row["billings_for31"];
		$amount31=$row["amount31"];
		$date32=$row["date32"];
		$billings_for32=$row["billings_for32"];
		$amount32=$row["amount32"];
		$date33=$row["date33"];
		$billings_for33=$row["billings_for33"];
		$amount33=$row["amount33"];
		$date34=$row["date34"];
		$billings_for34=$row["billings_for34"];
		$amount34=$row["amount34"];
		$date35=$row["date35"];
		$billings_for35=$row["billings_for35"];
		$amount35=$row["amount35"];
		$date36=$row["date36"];
		$billings_for36=$row["billings_for36"];
		$amount36=$row["amount36"];
		$date37=$row["date37"];
		$billings_for37=$row["billings_for37"];
		$amount37=$row["amount37"];
		$date38=$row["date38"];
		$billings_for38=$row["billings_for38"];
		$amount38=$row["amount38"];
		$date39=$row["date39"];
		$billings_for39=$row["billings_for39"];
		$amount39=$row["amount39"];
		$date40=$row["date40"];
		$billings_for40=$row["billings_for40"];
		$amount40=$row["amount40"];
		$date41=$row["date41"];
		$billings_for41=$row["billings_for41"];
		$amount41=$row["amount41"];
		$date42=$row["date42"];
		$billings_for42=$row["billings_for42"];
		$amount42=$row["amount42"];
		$date43=$row["date43"];
		$billings_for43=$row["billings_for43"];
		$amount43=$row["amount43"];
		$date44=$row["date44"];
		$billings_for44=$row["billings_for44"];
		$amount44=$row["amount44"];
		$date45=$row["date45"];
		$billings_for45=$row["billings_for45"];
		$amount45=$row["amount45"];
		
	}
}
if (isset($_POST['next'])){
	$date31 = htmlspecialchars($_POST['date31']);
	$billings_for31 = htmlspecialchars($_POST['billings_for31']);
	$amount31 = htmlspecialchars($_POST['amount31']);
	$date32 = htmlspecialchars($_POST['date32']);
	$billings_for32 = htmlspecialchars($_POST['billings_for32']);
	$amount32 = htmlspecialchars($_POST['amount32']);
	$date33 = htmlspecialchars($_POST['date33']);
	$billings_for33 = htmlspecialchars($_POST['billings_for33']);
	$amount33 = htmlspecialchars($_POST['amount33']);
	$date34 = htmlspecialchars($_POST['date34']);
	$billings_for34 = htmlspecialchars($_POST['billings_for34']);
	$amount34 = htmlspecialchars($_POST['amount34']);
	$date35 = htmlspecialchars($_POST['date35']);
	$billings_for35 = htmlspecialchars($_POST['billings_for35']);
	$amount35 = htmlspecialchars($_POST['amount35']);
	$date36 = htmlspecialchars($_POST['date36']);
	$billings_for36 = htmlspecialchars($_POST['billings_for36']);
	$amount36 = htmlspecialchars($_POST['amount36']);
	$date37 = htmlspecialchars($_POST['date37']);
	$billings_for37 = htmlspecialchars($_POST['billings_for37']);
	$amount37 = htmlspecialchars($_POST['amount37']);
	$date38 = htmlspecialchars($_POST['date38']);
	$billings_for38 = htmlspecialchars($_POST['billings_for38']);
	$amount38 = htmlspecialchars($_POST['amount38']);
	$date39 = htmlspecialchars($_POST['date39']);
	$billings_for39 = htmlspecialchars($_POST['billings_for39']);
	$amount39 = htmlspecialchars($_POST['amount39']);
	$date40 = htmlspecialchars($_POST['date40']);
	$billings_for40 = htmlspecialchars($_POST['billings_for40']);
	$amount40 = htmlspecialchars($_POST['amount40']);
	$date41 = htmlspecialchars($_POST['date41']);
	$billings_for41 = htmlspecialchars($_POST['billings_for41']);
	$amount41 = htmlspecialchars($_POST['amount41']);
	$date42 = htmlspecialchars($_POST['date42']);
	$billings_for42 = htmlspecialchars($_POST['billings_for42']);
	$amount42 = htmlspecialchars($_POST['amount42']);
	$date43 = htmlspecialchars($_POST['date43']);
	$billings_for43 = htmlspecialchars($_POST['billings_for43']);
	$amount43 = htmlspecialchars($_POST['amount43']);
	$date44 = htmlspecialchars($_POST['date44']);
	$billings_for44 = htmlspecialchars($_POST['billings_for44']);
	$amount44 = htmlspecialchars($_POST['amount44']);
	$date45 = htmlspecialchars($_POST['date45']);
	$billings_for45 = htmlspecialchars($_POST['billings_for45']);
	$amount45 = htmlspecialchars($_POST['amount45']);
	
	$sql3 = "UPDATE `ipd_billings_form` SET `last_visited_page`='$last_url', `date31`='$date31', `billings_for31`='$billings_for31', `amount31`='$amount31', `date32`='$date32', `billings_for32`='$billings_for32', `amount32`='$amount32', `date33`='$date33', `billings_for33`='$billings_for33', `amount33`='$amount33',`date34`='$date34', `billings_for34`='$billings_for34', `amount34`='$amount34', `date35`='$date35', `billings_for35`='$billings_for35', `amount35`='$amount35',`date36`='$date36', `billings_for36`='$billings_for36', `amount36`='$amount36', `date37`='$date37', `billings_for37`='$billings_for37', `amount37`='$amount37', `date38`='$date38', `billings_for38`='$billings_for38', `amount38`='$amount38', `date39`='$date39', `billings_for39`='$billings_for39', `amount39`='$amount39', `date40`='$date40', `billings_for40`='$billings_for40', `amount40`='$amount40', `date41`='$date41', `billings_for41`='$billings_for41', `amount41`='$amount41', `date42`='$date42', `billings_for42`='$billings_for42', `amount42`='$amount42', `date43`='$date43', `billings_for43`='$billings_for43', `amount43`='$amount43', `date44`='$date44', `billings_for44`='$billings_for44', `amount44`='$amount44', `date45`='$date45', `billings_for45`='$billings_for45', `amount45`='$amount45' WHERE `ipd_no`='$ipd_no' AND `ipd_no`='$ipd_nu'";
	$check3 = mysqli_query($dbconnect, $sql3) or die (mysqli_error($dbconnect));
	$msg = '<p style = "color: #4F8A10; margin-right: auto; margin-right: auto; text-align: center; background-color: #DFF2BF; border-radius:.5em; width: 400px; border: 1px solid #D8D8D8; margin-left: auto; margin-right: auto; padding: 5px; border-radius: 5px; font-family: Arial; font-size: 11px; text-transform: uppercase; text-transform: uppercase">Operation Successful...<a href="print.php?ipd_no='.$ipd_no.'">Click here to print</a>  or  <a href="billing_sheet4.php?ipd_no='.$ipd_no.'" style="color: blue">move to next page</a></p>';
}
if (isset($_POST['update'])){
	$date31 = htmlspecialchars($_POST['date31']);
	$billings_for31 = htmlspecialchars($_POST['billings_for31']);
	$amount31 = htmlspecialchars($_POST['amount31']);
	$date32 = htmlspecialchars($_POST['date32']);
	$billings_for32 = htmlspecialchars($_POST['billings_for32']);
	$amount32 = htmlspecialchars($_POST['amount32']);
	$date33 = htmlspecialchars($_POST['date33']);
	$billings_for33 = htmlspecialchars($_POST['billings_for33']);
	$amount33 = htmlspecialchars($_POST['amount33']);
	$date34 = htmlspecialchars($_POST['date34']);
	$billings_for34 = htmlspecialchars($_POST['billings_for34']);
	$amount34 = htmlspecialchars($_POST['amount34']);
	$date35 = htmlspecialchars($_POST['date35']);
	$billings_for35 = htmlspecialchars($_POST['billings_for35']);
	$amount35 = htmlspecialchars($_POST['amount35']);
	$date36 = htmlspecialchars($_POST['date36']);
	$billings_for36 = htmlspecialchars($_POST['billings_for36']);
	$amount36 = htmlspecialchars($_POST['amount36']);
	$date37 = htmlspecialchars($_POST['date37']);
	$billings_for37 = htmlspecialchars($_POST['billings_for37']);
	$amount37 = htmlspecialchars($_POST['amount37']);
	$date38 = htmlspecialchars($_POST['date38']);
	$billings_for38 = htmlspecialchars($_POST['billings_for38']);
	$amount38 = htmlspecialchars($_POST['amount38']);
	$date39 = htmlspecialchars($_POST['date39']);
	$billings_for39 = htmlspecialchars($_POST['billings_for39']);
	$amount39 = htmlspecialchars($_POST['amount39']);
	$date40 = htmlspecialchars($_POST['date40']);
	$billings_for40 = htmlspecialchars($_POST['billings_for40']);
	$amount40 = htmlspecialchars($_POST['amount40']);
	$date41 = htmlspecialchars($_POST['date41']);
	$billings_for41 = htmlspecialchars($_POST['billings_for41']);
	$amount41 = htmlspecialchars($_POST['amount41']);
	$date42 = htmlspecialchars($_POST['date42']);
	$billings_for42 = htmlspecialchars($_POST['billings_for42']);
	$amount42 = htmlspecialchars($_POST['amount42']);
	$date43 = htmlspecialchars($_POST['date43']);
	$billings_for43 = htmlspecialchars($_POST['billings_for43']);
	$amount43 = htmlspecialchars($_POST['amount43']);
	$date44 = htmlspecialchars($_POST['date44']);
	$billings_for44 = htmlspecialchars($_POST['billings_for44']);
	$amount44 = htmlspecialchars($_POST['amount44']);
	$date45 = htmlspecialchars($_POST['date45']);
	$billings_for45 = htmlspecialchars($_POST['billings_for45']);
	$amount45 = htmlspecialchars($_POST['amount45']);
	
	$sql3 = "UPDATE `ipd_billings_form` SET `last_visited_page`='$last_url', `date31`='$date31', `billings_for31`='$billings_for31', `amount31`='$amount31', `date32`='$date32', `billings_for32`='$billings_for32', `amount32`='$amount32', `date33`='$date33', `billings_for33`='$billings_for33', `amount33`='$amount33',`date34`='$date34', `billings_for34`='$billings_for34', `amount34`='$amount34', `date35`='$date35', `billings_for35`='$billings_for35', `amount35`='$amount35',`date36`='$date36', `billings_for36`='$billings_for36', `amount36`='$amount36', `date37`='$date37', `billings_for37`='$billings_for37', `amount37`='$amount37', `date38`='$date38', `billings_for38`='$billings_for38', `amount38`='$amount38', `date39`='$date39', `billings_for39`='$billings_for39', `amount39`='$amount39', `date40`='$date40', `billings_for40`='$billings_for40', `amount40`='$amount40', `date41`='$date41', `billings_for41`='$billings_for41', `amount41`='$amount41', `date42`='$date42', `billings_for42`='$billings_for42', `amount42`='$amount42', `date43`='$date43', `billings_for43`='$billings_for43', `amount43`='$amount43', `date44`='$date44', `billings_for44`='$billings_for44', `amount44`='$amount44', `date45`='$date45', `billings_for45`='$billings_for45', `amount45`='$amount45' WHERE `ipd_no`='$search'";
	$check3 = mysqli_query($dbconnect, $sql3) or die (mysqli_error($dbconnect));
	$msg = '<p style = "color: #4F8A10; margin-right: auto; margin-right: auto; text-align: center; background-color: #DFF2BF; border-radius:.5em; width: 400px; border: 1px solid #D8D8D8; margin-left: auto; margin-right: auto; padding: 5px; border-radius: 5px; font-family: Arial; font-size: 11px; text-transform: uppercase; text-transform: uppercase">Operation Successful...<a href="print.php?ipd_no='.$search.'">Click here to print</a>  or  <a href="billing_sheet4.php?ipd_no='.$search.'" style="color: blue">move to next page</a></p>';
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
<title>Billing Sheet3</title>
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
					<th width="25%"><label>Date</label><input type="text" id="userarea" style="width: 110px" name="date31" placeholder="YYYY-MM-DD" value="<?=@$date31?>"></th>
					<th width="45%"><label>Billings For</label><select name="billings_for31" id="userarea" style="width: 180px">
					<option value="<?php echo $billings_for31; ?>"><?php echo $billings_for31; ?></option>
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
					<th width="30%"><label>Amount N</label><input type="text" id="userarea" style="width: 100px" name="amount31" value="<?=@$amount31?>"></th>
				</table>
				 <table width="755px" style="margin-left: auto; margin-right: auto; background-color: #C5DFFA;" cellpadding="2" cellspacing="0" border="1">
					<th width="25%"><label>Date</label><input type="text" id="userarea" style="width: 110px" name="date32" placeholder="YYYY-MM-DD" value="<?=@$date32?>"></th>
					<th width="45%"><label>Billings For</label><select name="billings_for32" id="userarea" style="width: 180px">
					<option value="<?php echo $billings_for32; ?>"><?php echo $billings_for32; ?></option>
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
					<th width="30%"><label>Amount N</label><input type="text" id="userarea" style="width: 100px" name="amount32" value="<?=@$amount32?>"></th>
				</table>
				 <table width="755px" style="margin-left: auto; margin-right: auto; background-color: #C5DFFA;" cellpadding="2" cellspacing="0" border="1">
					<th width="25%"><label>Date</label><input type="text" id="userarea" style="width: 110px" name="date33" placeholder="YYYY-MM-DD" value="<?=@$date33?>"></th>
					<th width="45%"><label>Billings For</label><select name="billings_for33" id="userarea" style="width: 180px">
					<option value="<?php echo $billings_for33; ?>"><?php echo $billings_for33; ?></option>
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
					<th width="30%"><label>Amount N</label><input type="text" id="userarea" style="width: 100px" name="amount33" value="<?=@$amount33?>"></th>
				</table>
				 <table width="755px" style="margin-left: auto; margin-right: auto; background-color: #C5DFFA;" cellpadding="2" cellspacing="0" border="1">
					<th width="25%"><label>Date</label><input type="text" id="userarea" style="width: 110px" name="date34" placeholder="YYYY-MM-DD" value="<?=@$date34?>"></th>
					<th width="45%"><label>Billings For</label><select name="billings_for34" id="userarea" style="width: 180px">
					<option value="<?php echo $billings_for34; ?>"><?php echo $billings_for34; ?></option>
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
					<th width="30%"><label>Amount N</label><input type="text" id="userarea" style="width: 100px" name="amount34" value="<?=@$amount34?>"></th>
				</table>
				 <table width="755px" style="margin-left: auto; margin-right: auto; background-color: #C5DFFA;" cellpadding="2" cellspacing="0" border="1">
					<th width="25%"><label>Date</label><input type="text" id="userarea" style="width: 110px" name="date35" placeholder="YYYY-MM-DD" value="<?=@$date35?>"></th>
					<th width="45%"><label>Billings For</label><select name="billings_for35" id="userarea" style="width: 180px">
					<option value="<?php echo $billings_for35; ?>"><?php echo $billings_for35; ?></option>
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
					<th width="30%"><label>Amount N</label><input type="text" id="userarea" style="width: 100px" name="amount35" value="<?=@$amount35?>"></th>
				</table>
				 <table width="755px" style="margin-left: auto; margin-right: auto; background-color: #C5DFFA;" cellpadding="2" cellspacing="0" border="1">
					<th width="25%"><label>Date</label><input type="text" id="userarea" style="width: 110px" name="date36" placeholder="YYYY-MM-DD" value="<?=@$date36?>"></th>
					<th width="45%"><label>Billings For</label><select name="billings_for36" id="userarea" style="width: 180px">
					<option value="<?php echo $billings_for36; ?>"><?php echo $billings_for36; ?></option>
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
					<th width="30%"><label>Amount N</label><input type="text" id="userarea" style="width: 100px" name="amount36" value="<?=@$amount36?>"></th>
				</table>
				 <table width="755px" style="margin-left: auto; margin-right: auto; background-color: #C5DFFA;" cellpadding="2" cellspacing="0" border="1">
					<th width="25%"><label>Date</label><input type="text" id="userarea" style="width: 110px" name="date37" placeholder="YYYY-MM-DD" value="<?=@$date37?>"></th>
					<th width="45%"><label>Billings For</label><select name="billings_for37" id="userarea" style="width: 180px">
					<option value="<?php echo $billings_for37; ?>"><?php echo $billings_for37; ?></option>
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
					<th width="30%"><label>Amount N</label><input type="text" id="userarea" style="width: 100px" name="amount37" value="<?=@$amount37?>"></th>
				</table>
				 <table width="755px" style="margin-left: auto; margin-right: auto; background-color: #C5DFFA;" cellpadding="2" cellspacing="0" border="1">
					<th width="25%"><label>Date</label><input type="text" id="userarea" style="width: 110px" name="date38" placeholder="YYYY-MM-DD" value="<?=@$date38?>"></th>
					<th width="45%"><label>Billings For</label><select name="billings_for38" id="userarea" style="width: 180px">
					<option value="<?php echo $billings_for38; ?>"><?php echo $billings_for38; ?></option>
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
					<th width="30%"><label>Amount N</label><input type="text" id="userarea" style="width: 100px" name="amount38" value="<?=@$amount38?>"></th>
				</table>
				 <table width="755px" style="margin-left: auto; margin-right: auto; background-color: #C5DFFA;" cellpadding="2" cellspacing="0" border="1">
					<th width="25%"><label>Date</label><input type="text" id="userarea" style="width: 110px" name="date39" placeholder="YYYY-MM-DD" value="<?=@$date39?>"></th>
					<th width="45%"><label>Billings For</label><select name="billings_for39" id="userarea" style="width: 180px">
					<option value="<?php echo $billings_for39; ?>"><?php echo $billings_for39; ?></option>
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
					<th width="30%"><label>Amount N</label><input type="text" id="userarea" style="width: 100px" name="amount39" value="<?=@$amount39?>"></th>
				</table>
				 <table width="755px" style="margin-left: auto; margin-right: auto; background-color: #C5DFFA;" cellpadding="2" cellspacing="0" border="1">
					<th width="25%"><label>Date</label><input type="text" id="userarea" style="width: 110px" name="date40" placeholder="YYYY-MM-DD" value="<?=@$date40?>"></th>
					<th width="45%"><label>Billings For</label><select name="billings_for40" id="userarea" style="width: 180px">
					<option value="<?php echo $billings_for40; ?>"><?php echo $billings_for40; ?></option>
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
					<th width="30%"><label>Amount N</label><input type="text" id="userarea" style="width: 100px" name="amount40" value="<?=@$amount40?>"></th>
				</table>
				 <table width="755px" style="margin-left: auto; margin-right: auto; background-color: #C5DFFA;" cellpadding="2" cellspacing="0" border="1">
					<th width="25%"><label>Date</label><input type="text" id="userarea" style="width: 110px" name="date41" placeholder="YYYY-MM-DD" value="<?=@$date41?>"></th>
					<th width="45%"><label>Billings For</label><select name="billings_for41" id="userarea" style="width: 180px">
					<option value="<?php echo $billings_for41; ?>"><?php echo $billings_for41; ?></option>
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
					<th width="30%"><label>Amount N</label><input type="text" id="userarea" style="width: 100px" name="amount41" value="<?=@$amount41?>"></th>
				</table> <table width="755px" style="margin-left: auto; margin-right: auto; background-color: #C5DFFA;" cellpadding="2" cellspacing="0" border="1">
					<th width="25%"><label>Date</label><input type="text" id="userarea" style="width: 110px" name="date42" placeholder="YYYY-MM-DD" value="<?=@$date42?>"></th>
					<th width="45%"><label>Billings For</label><select name="billings_for42" id="userarea" style="width: 180px">
					<option value="<?php echo $billings_for42; ?>"><?php echo $billings_for42; ?></option>
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
					<th width="30%"><label>Amount N</label><input type="text" id="userarea" style="width: 100px" name="amount42" value="<?=@$amount42?>"></th>
				</table> <table width="755px" style="margin-left: auto; margin-right: auto; background-color: #C5DFFA;" cellpadding="2" cellspacing="0" border="1">
					<th width="25%"><label>Date</label><input type="text" id="userarea" style="width: 110px" name="date43" placeholder="YYYY-MM-DD" value="<?=@$date43?>"></th>
					<th width="45%"><label>Billings For</label><select name="billings_for43" id="userarea" style="width: 180px">
					<option value="<?php echo $billings_for43; ?>"><?php echo $billings_for43; ?></option>
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
					<th width="30%"><label>Amount N</label><input type="text" id="userarea" style="width: 100px" name="amount43" value="<?=@$amount43?>"></th>
				</table>
				 <table width="755px" style="margin-left: auto; margin-right: auto; background-color: #C5DFFA;" cellpadding="2" cellspacing="0" border="1">
					<th width="25%"><label>Date</label><input type="text" id="userarea" style="width: 110px" name="date44" placeholder="YYYY-MM-DD" value="<?=@$date44?>"></th>
					<th width="45%"><label>Billings For</label><select name="billings_for44" id="userarea" style="width: 180px">
					<option value="<?php echo $billings_for44; ?>"><?php echo $billings_for44; ?></option>
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
					<th width="30%"><label>Amount N</label><input type="text" id="userarea" style="width: 100px" name="amount44" value="<?=@$amount44?>"></th>
				</table>
				 <table width="755px" style="margin-left: auto; margin-right: auto; background-color: #C5DFFA;" cellpadding="2" cellspacing="0" border="1">
					<th width="25%"><label>Date</label><input type="text" id="userarea" style="width: 110px" name="date45" placeholder="YYYY-MM-DD" value="<?=@$date45?>"></th>
					<th width="45%"><label>Billings For</label><select name="billings_for45" id="userarea" style="width: 180px">
					<option value="<?php echo $billings_for45; ?>"><?php echo $billings_for45; ?></option>
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
					<th width="30%"><label>Amount N</label><input type="text" id="userarea" style="width: 100px" name="amount45" value="<?=@$amount45?>"></th>
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