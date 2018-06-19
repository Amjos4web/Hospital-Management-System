<?php 
session_start();
ob_start();
// error display configuration
//error_reporting(E_ALL & ~E_NOTICE);

if(!isset($_SESSION['emaill'])){
	header('location: debtors_login.php');
}
//This block grabs the whole list for viewing
$msg="";
$email= $_SESSION['emaill'];
include "../dbconnect2.php";
$sql="SELECT first_name, id FROM `debtors_login` WHERE `emailAdd`='$email' LIMIT 1";
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



// edit item for staff

// parse the form data and add the inventory to the system
$search_results = "";
$debits_lists = "";
$debits_list = "";
$credittotal = "";
$debittotal = "";
$totalbalance = "";
$staff_id = "";
if (isset($_GET['searchbtn'])){
	if (isset($_GET['search2']) && $_GET['search2'] != ""){
		// filter the inputs
		$search = $_GET['search2'];
		$sqlcommand2 = "SELECT `staff_id`, `surName`, `firstName`, `otherName`, `homeAddress`, `department`, `unit` FROM `staff_record` WHERE `staff_id`='$search'";
		$query = mysqli_query($dbconnect, $sqlcommand2) or die (mysqli_error($dbconnect));
		$count = mysqli_num_rows($query);
		if ($count > 0){
			while($row2=mysqli_fetch_assoc($query)){
				$staff_id = $row2["staff_id"];
				$sname=$row2["surName"];
				$fname=$row2["firstName"];
				$oname=$row2["otherName"];
				$address=$row2["homeAddress"];
				$depart=$row2["department"];
				$_SESSION['staff_id'] = $staff_id;
	
				
			
				
			
				$search_results .= '<form action="" method="POST">';
				$search_results .= '<table width="500px" style="margin-left: auto; margin-right: auto;" cellpadding="7" cellspacing="0" border="1">';
				$search_results .= "<tr>";
				$search_results .= "<td style='background-color:#C5DFFA; width: 30%; font-family: Adobe Heiti Std R; padding-left: 20px; font-size: 16px'><b>Staff ID</b></td>";
				$search_results .= '<td style="background-color:#C5DFFA; width: 70%"><input type="text" id="userarea" style="margin-left: 0px; width: 318px" disabled="disabled" name="staff_id" value="'.$staff_id.'"></td>';
				$search_results .= "</tr>";
				$search_results .= "<tr>";
				$search_results .= "<td style='background-color:#C5DFFA; width: 30%; font-family: Adobe Heiti Std R; padding-left: 20px; font-size: 16px'><b>Name</b></td>";
				$search_results .= '<td style="background-color:#C5DFFA; width: 70%"><input type="text" id="userarea" style="margin-left: 0px; width: 318px" disabled="disabled" name="name" value="'.$sname . " " . $fname . " " . $oname.'"></td>';
				$search_results .= "</tr>";
				$search_results .= "<tr>";
				$search_results .= "<td style='background-color:#C5DFFA; width: 30%; font-family: Adobe Heiti Std R; padding-left: 20px;  font-size: 16px'><b>Department</b></td>";
				$search_results .= '<td style="background-color:#C5DFFA; width: 70%"><input type="text" id="userarea" style="margin-left: 0px; width: 318px" disabled="disabled" name="depart" value="'.$depart.'"></td>';
				$search_results .= "</tr>";
				$search_results .= "<tr>";
				$search_results .= "<td style='background-color:#C5DFFA; width: 30%; font-family: Adobe Heiti Std R; padding-left: 20px;  font-size: 16px'><b>Address</b></td>";
				$search_results .= '<td style="background-color:#C5DFFA; width: 70%"><input type="text" id="userarea" style="margin-left: 0px; width: 318px" disabled="disabled" name="address" value="'.$address.'"></td>';
				$search_results .= "</tr>";
				$search_results .= "<tr>";
				$search_results .= "<td style='background-color:#C5DFFA; width: 30%; font-family: Adobe Heiti Std R; padding-left: 20px;  font-size: 16px'><b>A/C/CODE NO</b></td>";
				$search_results .= '<td style="background-color:#C5DFFA; width: 70%"><input type="text" id="userarea" style="margin-left: 0px; width: 318px" name="accode"></td>'; 
				$search_results .= "</tr>";
				$search_results .= "<tr>";
				$search_results .= "<td style='background-color:#C5DFFA; width: 30%; font-family: Adobe Heiti Std R; padding-left: 20px;  font-size: 16px'><b>Date</b></td>";
				$search_results .= '<td style="background-color:#C5DFFA; width: 70%"><input type="text" id="userarea" style="margin-left: 0px; width: 318px" placeholder="YYYY-MM-DD" name="date"></td>';
				$search_results .= "</tr>";
				$search_results .= "<tr>";
				$search_results .= "<td style='background-color:#C5DFFA; width: 30%; font-family: Adobe Heiti Std R; padding-left: 20px;  font-size: 16px'><b>Particulars</b></td>";
				$search_results .= '<td style="background-color:#C5DFFA; width: 70%"><input type="text" id="userarea" style="margin-left: 0px; width: 318px" name="par"></td>'; 
				$search_results .= "</tr>";
				$search_results .= "<tr>";
				$search_results .= "<td style='background-color:#C5DFFA; width: 30%; font-family: Adobe Heiti Std R; padding-left: 20px;  font-size: 16px'><b>Debit N</b></td>";
				$search_results .= '<td style="background-color:#C5DFFA; width: 70%"><input type="text" id="userarea" style="margin-left: 0px; width: 318px" name="debit"></td>'; 
				$search_results .= "</tr>";
				$search_results .= "<tr>";
				$search_results .= "<td style='background-color:#C5DFFA; width: 30%; font-family: Adobe Heiti Std R; padding-left: 20px;  font-size: 16px'><b>Credit N</b></td>";
				$search_results .= '<td style="background-color:#C5DFFA; width: 70%"><input type="text" id="userarea" style="margin-left: 0px; width: 318px" name="credit"></td>'; 
				$search_results .= "</tr>";
				$search_results .= "<tr>";
				$search_results .= "<td style='background-color:#C5DFFA; width: 30%; font-family: Adobe Heiti Std R; padding-left: 20px;  font-size: 16px'><b>Approved By</b></td>";
				$search_results .= '<td style="background-color:#C5DFFA; width: 70%"><input type="text" id="userarea" style="margin-left: 0px; width: 318px" name="approve"></td>'; 
				$search_results .= "</tr>";
				$search_results .= "</table><br>";
	            $search_results .= '<center><input type="submit" class="submit4" value="Submit" name="update"></center>';
				$search_results .= '</form>';
				?><style type="text/css">.search_angle{
					display: none
				}
				</style><?php
				
			} // close the while loop
		} else {
			?><script type="text/javascript">
			alert ('No result found for <?php echo $search; ?>');
			windows.locaton = 'debtors_home.php';
			</script><?php
		}
	} else {
		?><script type="text/javascript">
		alert ('field should not be empty');
		windows.locaton = 'debtors_home.php';
		</script><?php
	}
	
	
	//display data from the debit table
	$sql2 = "SELECT * FROM `debit_ledger` WHERE `staff_id`='".$staff_id."' ORDER BY date DESC";
	$check2 = mysqli_query($dbconnect, $sql2) or die (mysqli_error($dbconnect));
	$resultCount2=mysqli_num_rows($check2); //count the out amount 
	if($resultCount2>0){
		while($row=mysqli_fetch_array($check2)){
			$date=$row["date"];
			$par=$row["particulars"];
			$credit=$row["credit"];
			$debit=$row["debit"];
			$balance=$row["balance"];
			// sum for credit
			$creditsum = "SELECT  SUM(`credit`) AS credit_total FROM `debit_ledger` WHERE `staff_id`='".$staff_id."'";
			$creditsum2 = mysqli_query($dbconnect, $creditsum) or die (mysqli_error($dbconnect));
			$creditresult = mysqli_fetch_array($creditsum2);
			$credittotal = $creditresult['credit_total'];
			
			// sum for debit
			$debitsum = "SELECT  SUM(`debit`) AS debit_total FROM `debit_ledger` WHERE `staff_id`='".$staff_id."'";
			$debitsum2 = mysqli_query($dbconnect, $debitsum) or die (mysqli_error($dbconnect));
			$debitresult = mysqli_fetch_array($debitsum2);
			$debittotal = $debitresult['debit_total'];
			
			// sum for balance
			$totalbalance = $credittotal - $debittotal;
			
			if ($debit > $credit){
				$balance = abs($row["balance"]) . "CR";
			} else {
				$balance = $row["balance"];
			} 
			
			if ($debittotal > $credittotal){
				$totalbalance = abs($totalbalance) . "CR";
			} else {
				$totalbalance = $totalbalance;
			} 
			
	
			$debits_lists .= "<tr>";
			$debits_lists .= "<td style='background-color:#CECECE; text-align: center; font-family: arial;'>" . $date . "</td>";
			$debits_lists .= "<td style='background-color:#CECECE; text-align: center; font-family: arial;'>" . $staff_id . "</td>";
			$debits_lists .= "<td style='background-color:#CECECE; text-align: center; font-family: arial;'>" . $par . "</td>";
			$debits_lists .= "<td style='background-color:#CECECE; text-align: center; font-family: arial;'>" . $debit . "</td>";
			$debits_lists .= "<td style='background-color:#CECECE; text-align: center; font-family: arial;'>" . $credit . "</td>";
			$debits_lists .= "<td style='background-color:#CECECE; text-align: center; font-family: arial;'>" . $balance . "</td>";
			$debits_lists .= "</tr>";
			
			
		}
	} else {
		$msg="<p style='color: red; text-align: center'>Nothing to display</p>";
	}
	
	$debits_list .= "<tr>";
	$debits_list .= "<td style='background-color:#CECECE; text-align: center; font-family: arial;'>" . $debittotal . "</td>";
	$debits_list .= "<td style='background-color:#CECECE; text-align: center; font-family: arial;'>" . $credittotal . "</td>";
	$debits_list .= "<td style='background-color:#CECECE; text-align: center; font-family: arial;'>" . $totalbalance . "</td>";
	$debits_list .= "</tr>";
}
if (isset($_POST['update']))
{
	$staff_id = $_SESSION['staff_id'];
	$accode = htmlspecialchars($_POST['accode']);
	$date = htmlspecialchars($_POST['date']);
	$par = htmlspecialchars($_POST['par']);
	$credit = htmlspecialchars($_POST['credit']);
	$debit = htmlspecialchars($_POST['debit']);
	$approve = htmlspecialchars($_POST['approve']);
	$balance = $credit - $debit;
	if (empty($accode && $date && $par && $credit && $debit && $approve) == false){
		$sql5 = "INSERT INTO debit_ledger (staff_id, ac_code, particulars, date, credit, debit, approved_by, balance) VALUES ('$staff_id', '$accode', '$par', '$date', '$credit', '$debit', '$approve', '$balance')";
		$check5 = mysqli_query($dbconnect, $sql5) or die (mysqli_error($dbconnect));
		$msg = '<p style = "color: #4F8A10; margin-right: auto; margin-right: auto; text-align: center; background-color: #DFF2BF; border-radius:.5em; width: 400px; border: 1px solid #D8D8D8; margin-left: auto; margin-right: auto; padding: 5px; border-radius: 5px; font-family: Arial; font-size: 11px; text-transform: uppercase; text-transform: uppercase">Operation Successful</p>';
		//header ("refresh:4; url=debtors_home.php"); // wait for 3 secs before redirect
	} else {
		?><script type="text/javascript">
		alert ('Please fill all fields');
		windows.location="debtors_home.php";
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
<title>Staff Debtors Ledger</title>
<script src="js/jqueryy.js" type="text/javascript"></script>
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
	  <li><a href="debtors_home.php">Staff Debtors</a></li><br>
	  <li><a href="retainership.php">Retainership Debtors</a></li><br>
	  <li><a href="patient_debit.php">Patient Debtors</a></li><br>
	  <li><a href="../acc_logout.php">Logout</a></li><br>
    </ul>
	<?php include_once($_SERVER['DOCUMENT_ROOT'].'../buth_net/new_bar.php'); ?>
      <!-- end .sidebar1 --></div>
     <div class="margin" id="content">
	  <div class="search_angle">
			<center><h3 class="heading_text">Staff Debtors Ledger</h3></center><br>
			<center><img src="../images/payment2.jpg" alt="search_angle" width="500px" height="200px"></center><br>
			<div class="search">
			<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET">
			<center><input type="text" name="search2" id="search2"  maxlength="20" placeholder="Enter staff id"><br><br></center>
			<center><input type="submit" value="search" name="searchbtn" class="submit4"></center>
		 </form><br>
		 </div>
	   </div>
	   <?php echo $msg; ?><br>
	   <table width="700px" style="margin-left: auto; margin-right: auto" cellpadding="2" cellspacing="2" border="1">
		<tr>
			<td width="10%" style="background-color:#C5DFFA; font-family: arial black; text-align: center; font-size: 14px"><b>Date</b></td>
			<td width="10%" style="background-color:#C5DFFA; font-family: arial black; text-align: center; font-size: 14px"><b>Staff Id</b></td>
			<td width="20%" style="background-color:#C5DFFA; font-family: arial black; text-align: center; font-size: 14px"><b>Particulars</b></td>
			<td width="20%" style="background-color:#C5DFFA; font-family: arial black; text-align: center; font-size: 14px"><b>Debit N</b></td>
			<td width="20%" style="background-color:#C5DFFA; font-family: arial black; text-align: center; font-size: 14px"><b>Credit N</b></td>
			<td width="20%" style="background-color:#C5DFFA; font-family: arial black; text-align: center; font-size: 14px"><b>Balance N</b></td>
		</tr>
		<?php echo $debits_lists; ?>
		<!--tr>
			<td>;nbs</td>
			<td>;nbs</td>
			<td>;nbs</td>
			<td>;nbs</td>
			<td>;nbs</td>
			<td>;nbs</td>
		<-->
		</table><br><br>
		<table width="700px" style="margin-left: auto; margin-right: auto" cellpadding="2" cellspacing="2" border="1">
		<tr>
			<td width="30%" style="background-color:#C5DFFA; font-family: arial black; text-align: center; font-size: 14px"><b>Debit Total N</b></td>
			<td width="40%" style="background-color:#C5DFFA; font-family: arial black; text-align: center; font-size: 14px"><b>Credit Total N</b></td>
			<td width="30%" style="background-color:#C5DFFA; font-family: arial black; text-align: center; font-size: 14px"><b>Balance Total N</b></td>
		</tr>
		<?php echo $debits_list; ?>
		<!--tr>
			<td>;nbs</td>
			<td>;nbs</td>
			<td>;nbs</td>
		<-->
		</table><br><br>
		  <div id="patient_form">
		<?php echo $search_results; ?>
		</div><br><br>
			   <!-- end .content --></div>
			  <!-- end .container --></div>
     <?php
      include_once "../footer.php";
     ?>
</body>
</html>