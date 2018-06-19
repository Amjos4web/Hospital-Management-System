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

$search = $_SESSION['search'];
$select = "SELECT * FROM ipd_billings_form WHERE ipd_no='$search' LIMIT 1";
$check = mysqli_query($dbconnect, $select);
$resultCount=mysqli_num_rows($check); //count the out amount 
if($resultCount>0){
	while($row=mysqli_fetch_array($check)){
		$id=$row["id"];
		$ward=$row["ward"];
		$name_2=$row["name"];
		$ipd_no2=$row["ipd_no"];
		$deposit=$row["deposit"];
		$date1=$row["date1"];
		$billings_for1=$row["billings_for1"];
		$amount1=$row["amount1"];
		$date2=$row["date2"];
		$billings_for2=$row["billings_for2"];
		$amount2=$row["amount2"];
		$date3=$row["date3"];
		$billings_for3=$row["billings_for3"];
		$amount3=$row["amount3"];
		$date4=$row["date4"];
		$billings_for4=$row["billings_for4"];
		$amount4=$row["amount4"];
		$date5=$row["date5"];
		$billings_for5=$row["billings_for5"];
		$amount5=$row["amount5"];
		$date6=$row["date6"];
		$billings_for6=$row["billings_for6"];
		$amount6=$row["amount6"];
		$date7=$row["date7"];
		$billings_for7=$row["billings_for7"];
		$amount7=$row["amount7"];
		$date8=$row["date8"];
		$billings_for8=$row["billings_for8"];
		$amount8=$row["amount8"];
		$date9=$row["date9"];
		$billings_for9=$row["billings_for9"];
		$amount9=$row["amount9"];
		$date10=$row["date10"];
		$billings_for10=$row["billings_for10"];
		$amount10=$row["amount10"];
		$date11=$row["date11"];
		$billings_for11=$row["billings_for11"];
		$amount11=$row["amount11"];
		$date12=$row["date12"];
		$billings_for12=$row["billings_for12"];
		$amount12=$row["amount12"];
		$date13=$row["date13"];
		$billings_for13=$row["billings_for13"];
		$amount13=$row["amount13"];
		$date14=$row["date14"];
		$billings_for14=$row["billings_for14"];
		$amount14=$row["amount14"];
		$date15=$row["date15"];
		$billings_for15=$row["billings_for15"];
		$amount15=$row["amount15"];
		
	}
}
if (isset($_POST['next'])){
	$ward = htmlspecialchars($_POST['ward']);
	$name_2 = htmlspecialchars($_POST['name_2']);
	$ipd_no = htmlspecialchars($_POST['ipd_no']);
	$deposit = htmlspecialchars($_POST['deposit']);
	$date1 = htmlspecialchars($_POST['date1']);
	$billings_for1 = htmlspecialchars($_POST['billings_for1']);
	$amount1 = htmlspecialchars($_POST['amount1']);
	$date2 = htmlspecialchars($_POST['date2']);
	$billings_for2 = htmlspecialchars($_POST['billings_for2']);
	$amount2 = htmlspecialchars($_POST['amount2']);
	$date3 = htmlspecialchars($_POST['date3']);
	$billings_for3 = htmlspecialchars($_POST['billings_for3']);
	$amount3 = htmlspecialchars($_POST['amount3']);
	$date4 = htmlspecialchars($_POST['date4']);
	$billings_for4 = htmlspecialchars($_POST['billings_for4']);
	$amount4 = htmlspecialchars($_POST['amount4']);
	$date5 = htmlspecialchars($_POST['date5']);
	$billings_for5 = htmlspecialchars($_POST['billings_for5']);
	$amount5 = htmlspecialchars($_POST['amount5']);
	$date6 = htmlspecialchars($_POST['date6']);
	$billings_for6 = htmlspecialchars($_POST['billings_for6']);
	$amount6 = htmlspecialchars($_POST['amount6']);
	$date7 = htmlspecialchars($_POST['date7']);
	$billings_for7 = htmlspecialchars($_POST['billings_for7']);
	$amount7 = htmlspecialchars($_POST['amount7']);
	$date8 = htmlspecialchars($_POST['date8']);
	$billings_for8 = htmlspecialchars($_POST['billings_for8']);
	$amount8 = htmlspecialchars($_POST['amount8']);
	$date9 = htmlspecialchars($_POST['date9']);
	$billings_for9 = htmlspecialchars($_POST['billings_for9']);
	$amount9 = htmlspecialchars($_POST['amount9']);
	$date10 = htmlspecialchars($_POST['date10']);
	$billings_for10 = htmlspecialchars($_POST['billings_for10']);
	$amount10 = htmlspecialchars($_POST['amount10']);
	$date11 = htmlspecialchars($_POST['date11']);
	$billings_for11 = htmlspecialchars($_POST['billings_for11']);
	$amount11 = htmlspecialchars($_POST['amount11']);
	$date12 = htmlspecialchars($_POST['date12']);
	$billings_for12 = htmlspecialchars($_POST['billings_for12']);
	$amount12 = htmlspecialchars($_POST['amount12']);
	$date13 = htmlspecialchars($_POST['date13']);
	$billings_for13 = htmlspecialchars($_POST['billings_for13']);
	$amount13 = htmlspecialchars($_POST['amount13']);
	$date14 = htmlspecialchars($_POST['date14']);
	$billings_for14 = htmlspecialchars($_POST['billings_for14']);
	$amount14 = htmlspecialchars($_POST['amount14']);
	$date15 = htmlspecialchars($_POST['date15']);
	$billings_for15 = htmlspecialchars($_POST['billings_for15']);
	$amount15 = htmlspecialchars($_POST['amount15']);
	$server_time = date('Y-m-d H:i:s');
	if (empty($ward && $name_2 && $ipd_no) == false){
		if (preg_match("/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/", $date1))
		{
			$sql1 = "SELECT * FROM ipd_billings_form WHERE ipd_no = '".$ipd_no."'";
			$check1 = mysqli_query($dbconnect, $sql1) or die(mysqli_error($dbconnect));
			$checkResult = mysqli_num_rows($check1);
			if ($checkResult > 0){
				$select2 = "SELECT MAX(no_of_visits) AS max_no FROM ipd_billings_form WHERE ipd_no = '".$ipd_no."'";
				$check3 = mysqli_query($dbconnect, $select2) or die(mysqli_error($dbconnect));
				$row = mysqli_fetch_array($check3);
				$resultCount2 = $row["max_no"];
				$no_Of_visit = $resultCount2+1;
				$sql = "INSERT INTO ipd_billings_form (`ward`, `ipd_no`, `name`, `deposit`, `server_time`, `date1`, `billings_for1`, `amount1`, `date2`, `billings_for2`, `amount2`, `date3`, `billings_for3`, `amount3`,`date4`, `billings_for4`, `amount4`, `date5`, `billings_for5`, `amount5`, `date6`, `billings_for6`, `amount6`, `date7`, `billings_for7`, `amount7`, `date8`, `billings_for8`, `amount8`, `date9`, `billings_for9`, `amount9`, `date10`, `billings_for10`, `amount10`, `date11`, `billings_for11`, `amount11`, `date12`, `billings_for12`, `amount12`, `date13`, `billings_for13`,`amount13`, `date14`, `billings_for14`, `amount14`, `date15`, `billings_for15`, `amount15`,`last_visited_page`) VALUES ('$ward', '$ipd_no', '$name_2', '$deposit','$server_time','$date1', '$billings_for1', '$amount1', '$date2', '$billings_for2', '$amount2','$date3', '$billings_for3', '$amount3','$date4', '$billings_for4', '$amount4','$date5', '$billings_for5', '$amount5','$date6', '$billings_for6', '$amount6','$date7', '$billings_for7', '$amount7','$date8', '$billings_for8', '$amount8','$date9', '$billings_for9', '$amount9','$date10', '$billings_for10', '$amount10','$date11', '$billings_for11', '$amount11','$date12', '$billings_for12', '$amount12','$date13', '$billings_for13', '$amount13','$date14', '$billings_for14', '$amount14','$date15', '$billings_for15', '$amount15','$last_url')";
				$check = mysqli_query($dbconnect, $sql) or die(mysqli_error($dbconnect));
				$_SESSION['ipd_no'] = $ipd_no;
				$ipd_no = $_SESSION['ipd_no'];
				$update = "UPDATE ipd_billings_form SET no_of_visits = '".$no_Of_visit."' WHERE ipd_no = '".$ipd_no."'";
				$check4 = mysqli_query($dbconnect, $update) or die(mysqli_error($dbconnect));
				$_SESSION['server_time'] = $server_time;
				$server_time = $_SESSION['server_time'];
				$ipd_no = $ipd_no . $no_Of_visit;
				$update2 = "UPDATE ipd_billings_form SET ipd_no = '".$ipd_no."' WHERE server_time = '".$server_time."'";
				$check5 = mysqli_query($dbconnect, $update2) or die(mysqli_error($dbconnect));
				$msg = '<p style = "color: #4F8A10; margin-right: auto; margin-right: auto; text-align: center; background-color: #DFF2BF; border-radius:.5em; width: 400px; border: 1px solid #D8D8D8; margin-left: auto; margin-right: auto; padding: 5px; border-radius: 5px; font-family: Arial; font-size: 11px; text-transform: uppercase; text-transform: uppercase">Operation Successful...<a href="print.php?ipd_no='.$ipd_no.'">Click here to print</a>  or  <a href="billing_sheet2.php?ipd_no='.$ipd_no.'" style="color: blue">move to next page</a></p>';
			} else if ($checkResult == 0){
				$no_Of_visit = "1";
				$ipd_no = $ipd_no . "/" . $no_Of_visit;
				$sql = "INSERT INTO ipd_billings_form (`ward`, `ipd_no`, `name`, `deposit`, `server_time`, `no_of_visits`, `date1`, `billings_for1`, `amount1`, `date2`, `billings_for2`, `amount2`, `date3`, `billings_for3`, `amount3`,`date4`, `billings_for4`, `amount4`, `date5`, `billings_for5`, `amount5`, `date6`, `billings_for6`, `amount6`, `date7`, `billings_for7`, `amount7`, `date8`, `billings_for8`, `amount8`, `date9`, `billings_for9`, `amount9`, `date10`, `billings_for10`, `amount10`, `date11`, `billings_for11`, `amount11`, `date12`, `billings_for12`, `amount12`, `date13`, `billings_for13`,`amount13`, `date14`, `billings_for14`, `amount14`, `date15`, `billings_for15`, `amount15`,`last_visited_page`) VALUES ('$ward', '$ipd_no', '$name_2', '$deposit', '$server_time', '$no_Of_visit', '$date1', '$billings_for1', '$amount1', '$date2', '$billings_for2', '$amount2','$date3', '$billings_for3', '$amount3','$date4', '$billings_for4', '$amount4','$date5', '$billings_for5', '$amount5','$date6', '$billings_for6', '$amount6','$date7', '$billings_for7', '$amount7','$date8', '$billings_for8', '$amount8','$date9', '$billings_for9', '$amount9','$date10', '$billings_for10', '$amount10','$date11', '$billings_for11', '$amount11','$date12', '$billings_for12', '$amount12','$date13', '$billings_for13', '$amount13','$date14', '$billings_for14', '$amount14','$date15', '$billings_for15', '$amount15','$last_url')";
				$check = mysqli_query($dbconnect, $sql) or die(mysqli_error($dbconnect));
				$_SESSION['ipd_no'] = $ipd_no;
				$ipd_no = $_SESSION['ipd_no'];
				$msg = '<p style = "color: #4F8A10; margin-right: auto; margin-right: auto; text-align: center; background-color: #DFF2BF; border-radius:.5em; width: 400px; border: 1px solid #D8D8D8; margin-left: auto; margin-right: auto; padding: 5px; border-radius: 5px; font-family: Arial; font-size: 11px; text-transform: uppercase; text-transform: uppercase">Operation Successful...<a href="print.php?ipd_no='.$ipd_no.'">Click here to print</a>  or  <a href="billing_sheet2.php?ipd_no='.$ipd_no.'" style="color: blue">move to next page</a></p>';
			}
		} else
		$msg = "<p style='color: #D8000C; background-color: #FFBABA; border-radius:.5em; width: 300px; border: 1px solid #D8D8D8; padding: 5px; border-radius: 5px; margin-left: auto; margin-right: auto; font-family: Arial; font-size: 11px; text-transform: uppercase; text-align: center; text-transform: uppercase'>Date of birth should be YYYY-MM-DD</p>";
	} else
	$msg = "<p style='color: #D8000C; background-color: #FFBABA; border-radius:.5em; width: 300px; border: 1px solid #D8D8D8; padding: 5px; border-radius: 5px; margin-left: auto; margin-right: auto; font-family: Arial; font-size: 11px; text-transform: uppercase; text-align: center; text-transform: uppercase'>Please enter name, ipd no and ward</p>";
}
if (isset($_POST['update'])){
	$deposit = htmlspecialchars($_POST['deposit']);
	$date1 = htmlspecialchars($_POST['date1']);
	$billings_for1 = htmlspecialchars($_POST['billings_for1']);
	$amount1 = htmlspecialchars($_POST['amount1']);
	$date2 = htmlspecialchars($_POST['date2']);
	$billings_for2 = htmlspecialchars($_POST['billings_for2']);
	$amount2 = htmlspecialchars($_POST['amount2']);
	$date3 = htmlspecialchars($_POST['date3']);
	$billings_for3 = htmlspecialchars($_POST['billings_for3']);
	$amount3 = htmlspecialchars($_POST['amount3']);
	$date4 = htmlspecialchars($_POST['date4']);
	$billings_for4 = htmlspecialchars($_POST['billings_for4']);
	$amount4 = htmlspecialchars($_POST['amount4']);
	$date5 = htmlspecialchars($_POST['date5']);
	$billings_for5 = htmlspecialchars($_POST['billings_for5']);
	$amount5 = htmlspecialchars($_POST['amount5']);
	$date6 = htmlspecialchars($_POST['date6']);
	$billings_for6 = htmlspecialchars($_POST['billings_for6']);
	$amount6 = htmlspecialchars($_POST['amount6']);
	$date7 = htmlspecialchars($_POST['date7']);
	$billings_for7 = htmlspecialchars($_POST['billings_for7']);
	$amount7 = htmlspecialchars($_POST['amount7']);
	$date8 = htmlspecialchars($_POST['date8']);
	$billings_for8 = htmlspecialchars($_POST['billings_for8']);
	$amount8 = htmlspecialchars($_POST['amount8']);
	$date9 = htmlspecialchars($_POST['date9']);
	$billings_for9 = htmlspecialchars($_POST['billings_for9']);
	$amount9 = htmlspecialchars($_POST['amount9']);
	$date10 = htmlspecialchars($_POST['date10']);
	$billings_for10 = htmlspecialchars($_POST['billings_for10']);
	$amount10 = htmlspecialchars($_POST['amount10']);
	$date11 = htmlspecialchars($_POST['date11']);
	$billings_for11 = htmlspecialchars($_POST['billings_for11']);
	$amount11 = htmlspecialchars($_POST['amount11']);
	$date12 = htmlspecialchars($_POST['date12']);
	$billings_for12 = htmlspecialchars($_POST['billings_for12']);
	$amount12 = htmlspecialchars($_POST['amount12']);
	$date13 = htmlspecialchars($_POST['date13']);
	$billings_for13 = htmlspecialchars($_POST['billings_for13']);
	$amount13 = htmlspecialchars($_POST['amount13']);
	$date14 = htmlspecialchars($_POST['date14']);
	$billings_for14 = htmlspecialchars($_POST['billings_for14']);
	$amount14 = htmlspecialchars($_POST['amount14']);
	$date15 = htmlspecialchars($_POST['date15']);
	$billings_for15 = htmlspecialchars($_POST['billings_for15']);
	$amount15 = htmlspecialchars($_POST['amount15']);

	
	$sql3 = "UPDATE `ipd_billings_form` SET `deposit`='$deposit', `last_visited_page`='$last_url', `date1`='$date1', `billings_for1`='$billings_for1', `amount1`='$amount1', `date2`='$date2', `billings_for2`='$billings_for2', `amount2`='$amount2', `date3`='$date3', `billings_for3`='$billings_for3', `amount3`='$amount3',`date4`='$date4', `billings_for4`='$billings_for4', `amount4`='$amount4', `date5`='$date5', `billings_for5`='$billings_for5', `amount5`='$amount5',`date6`='$date6', `billings_for6`='$billings_for6', `amount6`='$amount6', `date7`='$date7', `billings_for7`='$billings_for7', `amount7`='$amount7', `date8`='$date8', `billings_for8`='$billings_for8', `amount8`='$amount8', `date9`='$date9', `billings_for9`='$billings_for9', `amount9`='$amount9', `date10`='$date10', `billings_for10`='$billings_for10', `amount10`='$amount10', `date11`='$date11', `billings_for11`='$billings_for11', `amount11`='$amount11', `date12`='$date12', `billings_for12`='$billings_for12', `amount12`='$amount12', `date13`='$date13', `billings_for13`='$billings_for13', `amount13`='$amount13', `date14`='$date14', `billings_for14`='$billings_for14', `amount14`='$amount14', `date15`='$date15', `billings_for15`='$billings_for15', `amount15`='$amount15' WHERE `ipd_no`='$search'";
	$check3 = mysqli_query($dbconnect, $sql3) or die (mysqli_error($dbconnect));
	$msg = '<p style = "color: #4F8A10; margin-right: auto; margin-right: auto; text-align: center; background-color: #DFF2BF; border-radius:.5em; width: 400px; border: 1px solid #D8D8D8; margin-left: auto; margin-right: auto; padding: 5px; border-radius: 5px; font-family: Arial; font-size: 11px; text-transform: uppercase; text-transform: uppercase">Operation Successful...<a href="print.php?ipd_no='.$search.'" style="color: blue">Click here to print</a>  or  <a href="billing_sheet3.php?ipd_no='.$search.'" style="color: blue">move to next page</a></p>';
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
	  <form action="" method="post" enctype="multipart/form-data" id="form3">
	   <div class="form_data1">
	   <input type="submit" value="Clear" name="clear" style="padding: 3px 15px; font-size: 18px; float: right; margin-right: 0px" id="rec_submit"><br><br>
	   <?php echo $msg; ?>
				 <table width="750px" style="margin-left: auto; margin-right: auto; background-color: #C5DFFA;" cellpadding="2" cellspacing="0" border="1">
					<th width="25%"><label>Ward</label><input type="text" id="userarea" style="width: 180px" name="ward" placeholder="Enter Ward" value="<?php echo $ward; ?>"></th>
					<th width="25%"><label>Name</label><input type="text" id="userarea" style="width: 180px" name="name_2" placeholder="Enter Name" value="<?php echo $name_2; ?>"></th>
					<th width="25%"><label>I.P.D.No</label><input type="text" id="userarea" style="width: 180px" name="ipd_no" placeholder="Enter IPD No" value="<?php echo $ipd_no2; ?>"></th>
					<th width="25%"><label>Deposit N</label><input type="text" id="userarea" style="width: 180px" name="deposit" placeholder="Enter Deposit" value="<?php echo $deposit; ?>"></th>
				</table><br>
			 <table width="755px" style="margin-left: auto; margin-right: auto; background-color: #C5DFFA;" cellpadding="2" cellspacing="0" border="1">
					<th width="25%"><label>Date</label><input type="text" id="userarea" style="width: 110px" name="date1" placeholder="YYYY-MM-DD" value="<?=@$date1?>"></th>
					<th width="45%"><label>Billings For</label><select name="billings_for1" id="userarea" style="width: 180px">
					<option value="<?php echo $billings_for1; ?>"><?php echo $billings_for1; ?></option>
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
					<th width="30%"><label>Amount N</label><input type="text" id="userarea" style="width: 100px" name="amount1" value="<?=@$amount1?>"></th>
				</table>
				 <table width="755px" style="margin-left: auto; margin-right: auto; background-color: #C5DFFA;" cellpadding="2" cellspacing="0" border="1">
					<th width="25%"><label>Date</label><input type="text" id="userarea" style="width: 110px" name="date2" placeholder="YYYY-MM-DD" value="<?=@$date2?>"></th>
					<th width="45%"><label>Billings For</label><select name="billings_for2" id="userarea" style="width: 180px">
					<option value="<?php echo $billings_for2; ?>"><?php echo $billings_for2; ?></option>
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
					<th width="30%"><label>Amount N</label><input type="text" id="userarea" style="width: 100px" name="amount2" value="<?=@$amount2?>"></th>
				</table>
				 <table width="755px" style="margin-left: auto; margin-right: auto; background-color: #C5DFFA;" cellpadding="2" cellspacing="0" border="1">
					<th width="25%"><label>Date</label><input type="text" id="userarea" style="width: 110px" name="date3" placeholder="YYYY-MM-DD" value="<?=@$date3?>"></th>
					<th width="45%"><label>Billings For</label><select name="billings_for3" id="userarea" style="width: 180px">
					<option value="<?php echo $billings_for3; ?>"><?php echo $billings_for3; ?></option>
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
					<th width="30%"><label>Amount N</label><input type="text" id="userarea" style="width: 100px" name="amount3" value="<?=@$amount3?>"></th>
				</table>
				 <table width="755px" style="margin-left: auto; margin-right: auto; background-color: #C5DFFA;" cellpadding="2" cellspacing="0" border="1">
					<th width="25%"><label>Date</label><input type="text" id="userarea" style="width: 110px" name="date4" placeholder="YYYY-MM-DD" value="<?=@$date4?>"></th>
					<th width="45%"><label>Billings For</label><select name="billings_for4" id="userarea" style="width: 180px">
					<option value="<?php echo $billings_for4; ?>"><?php echo $billings_for4; ?></option>
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
					<th width="30%"><label>Amount N</label><input type="text" id="userarea" style="width: 100px" name="amount4" value="<?=@$amount4?>"></th>
				</table>
				 <table width="755px" style="margin-left: auto; margin-right: auto; background-color: #C5DFFA;" cellpadding="2" cellspacing="0" border="1">
					<th width="25%"><label>Date</label><input type="text" id="userarea" style="width: 110px" name="date5" placeholder="YYYY-MM-DD" value="<?=@$date5?>"></th>
					<th width="45%"><label>Billings For</label><select name="billings_for5" id="userarea" style="width: 180px">
					<option value="<?php echo $billings_for5; ?>"><?php echo $billings_for5; ?></option>
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
					<th width="30%"><label>Amount N</label><input type="text" id="userarea" style="width: 100px" name="amount5" value="<?=@$amount5?>"></th>
				</table>
				 <table width="755px" style="margin-left: auto; margin-right: auto; background-color: #C5DFFA;" cellpadding="2" cellspacing="0" border="1">
					<th width="25%"><label>Date</label><input type="text" id="userarea" style="width: 110px" name="date6" placeholder="YYYY-MM-DD" value="<?=@$date6?>"></th>
					<th width="45%"><label>Billings For</label><select name="billings_for6" id="userarea" style="width: 180px">
					<option value="<?php echo $billings_for6; ?>"><?php echo $billings_for6; ?></option>
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
					<th width="30%"><label>Amount N</label><input type="text" id="userarea" style="width: 100px" name="amount6" value="<?=@$amount6?>"></th>
				</table>
				 <table width="755px" style="margin-left: auto; margin-right: auto; background-color: #C5DFFA;" cellpadding="2" cellspacing="0" border="1">
					<th width="25%"><label>Date</label><input type="text" id="userarea" style="width: 110px" name="date7" placeholder="YYYY-MM-DD" value="<?=@$date7?>"></th>
					<th width="45%"><label>Billings For</label><select name="billings_for7" id="userarea" style="width: 180px">
					<option value="<?php echo $billings_for7; ?>"><?php echo $billings_for7; ?></option>
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
					<th width="30%"><label>Amount N</label><input type="text" id="userarea" style="width: 100px" name="amount7" value="<?=@$amount7?>"></th>
				</table>
				 <table width="755px" style="margin-left: auto; margin-right: auto; background-color: #C5DFFA;" cellpadding="2" cellspacing="0" border="1">
					<th width="25%"><label>Date</label><input type="text" id="userarea" style="width: 110px" name="date8" placeholder="YYYY-MM-DD" value="<?=@$date8?>"></th>
					<th width="45%"><label>Billings For</label><select name="billings_for8" id="userarea" style="width: 180px">
					<option value="<?php echo $billings_for8; ?>"><?php echo $billings_for8; ?></option>
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
					<th width="30%"><label>Amount N</label><input type="text" id="userarea" style="width: 100px" name="amount8" value="<?=@$amount8?>"></th>
				</table>
				 <table width="755px" style="margin-left: auto; margin-right: auto; background-color: #C5DFFA;" cellpadding="2" cellspacing="0" border="1">
					<th width="25%"><label>Date</label><input type="text" id="userarea" style="width: 110px" name="date9" placeholder="YYYY-MM-DD" value="<?=@$date9?>"></th>
					<th width="45%"><label>Billings For</label><select name="billings_for9" id="userarea" style="width: 180px">
					<option value="<?php echo $billings_for9; ?>"><?php echo $billings_for9; ?></option>
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
					<th width="30%"><label>Amount N</label><input type="text" id="userarea" style="width: 100px" name="amount9" value="<?=@$amount9?>"></th>
				</table>
				 <table width="755px" style="margin-left: auto; margin-right: auto; background-color: #C5DFFA;" cellpadding="2" cellspacing="0" border="1">
					<th width="25%"><label>Date</label><input type="text" id="userarea" style="width: 110px" name="date10" placeholder="YYYY-MM-DD" value="<?=@$date10?>"></th>
					<th width="45%"><label>Billings For</label><select name="billings_for10" id="userarea" style="width: 180px">
					<option value="<?php echo $billings_for10; ?>"><?php echo $billings_for10; ?></option>
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
					<th width="30%"><label>Amount N</label><input type="text" id="userarea" style="width: 100px" name="amount10" value="<?=@$amount10?>"></th>
				</table>
				 <table width="755px" style="margin-left: auto; margin-right: auto; background-color: #C5DFFA;" cellpadding="2" cellspacing="0" border="1">
					<th width="25%"><label>Date</label><input type="text" id="userarea" style="width: 110px" name="date11" placeholder="YYYY-MM-DD" value="<?=@$date11?>"></th>
					<th width="45%"><label>Billings For</label><select name="billings_for11" id="userarea" style="width: 180px">
					<option value="<?php echo $billings_for11; ?>"><?php echo $billings_for11; ?></option>
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
					<th width="30%"><label>Amount N</label><input type="text" id="userarea" style="width: 100px" name="amount11" value="<?=@$amount11?>"></th>
				</table> <table width="755px" style="margin-left: auto; margin-right: auto; background-color: #C5DFFA;" cellpadding="2" cellspacing="0" border="1">
					<th width="25%"><label>Date</label><input type="text" id="userarea" style="width: 110px" name="date12" placeholder="YYYY-MM-DD" value="<?=@$date12?>"></th>
					<th width="45%"><label>Billings For</label><select name="billings_for12" id="userarea" style="width: 180px">
					<option value="<?php echo $billings_for12; ?>"><?php echo $billings_for12; ?></option>
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
					<th width="30%"><label>Amount N</label><input type="text" id="userarea" style="width: 100px" name="amount12" value="<?=@$amount12?>"></th>
				</table> <table width="755px" style="margin-left: auto; margin-right: auto; background-color: #C5DFFA;" cellpadding="2" cellspacing="0" border="1">
					<th width="25%"><label>Date</label><input type="text" id="userarea" style="width: 110px" name="date13" placeholder="YYYY-MM-DD" value="<?=@$date13?>"></th>
					<th width="45%"><label>Billings For</label><select name="billings_for13" id="userarea" style="width: 180px">
					<option value="<?php echo $billings_for13; ?>"><?php echo $billings_for13; ?></option>
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
					<th width="30%"><label>Amount N</label><input type="text" id="userarea" style="width: 100px" name="amount13" value="<?=@$amount13?>"></th>
				</table>
				 <table width="755px" style="margin-left: auto; margin-right: auto; background-color: #C5DFFA;" cellpadding="2" cellspacing="0" border="1">
					<th width="25%"><label>Date</label><input type="text" id="userarea" style="width: 110px" name="date14" placeholder="YYYY-MM-DD" value="<?=@$date14?>"></th>
					<th width="45%"><label>Billings For</label><select name="billings_for14" id="userarea" style="width: 180px">
					<option value="<?php echo $billings_for14; ?>"><?php echo $billings_for14; ?></option>
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
					<th width="30%"><label>Amount N</label><input type="text" id="userarea" style="width: 100px" name="amount14" value="<?=@$amount14?>"></th>
				</table>
				 <table width="755px" style="margin-left: auto; margin-right: auto; background-color: #C5DFFA;" cellpadding="2" cellspacing="0" border="1">
					<th width="25%"><label>Date</label><input type="text" id="userarea" style="width: 110px" name="date15" placeholder="YYYY-MM-DD" value="<?=@$date15?>"></th>
					<th width="45%"><label>Billings For</label><select name="billings_for15" id="userarea" style="width: 180px">
					<option value="<?php echo $billings_for15; ?>"><?php echo $billings_for15; ?></option>
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
					<th width="30%"><label>Amount N</label><input type="text" id="userarea" style="width: 100px" name="amount15" value="<?=@$amount15?>"></th>
				</table>
			 </div>
			 </div><br>
			 <input type="submit" value="Update" style="padding: 3px 15px; font-size: 18px; margin-left: 22px" name="update" id="rec_submit">
			 <input type="submit" value="Save As New" style="padding: 3px 15px; font-size: 18px; float: right; margin-right: 20px" name="next" id="rec_submit"><br>
	   </form><br>
	  </div>
   <!-- end .content --></div>
  <!-- end .container --></div>
     <?php
      include_once "../footer.php";
     ?>
</body>
</html>