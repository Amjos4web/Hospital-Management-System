<?php 
session_start();
ob_start();
// error display configuration
//error_reporting(E_ALL & ~E_NOTICE);

if(!isset($_SESSION['emaill'])){
	header('location: index.php');
}
//This block grabs the whole list for viewing
$msg="";
$email= $_SESSION['emaill'];
include "../pharmacySection/dbconnect2.php";
$sql="SELECT fname, id FROM `digital_admin` WHERE `admin_email`='$email' LIMIT 1";
$check = mysqli_query($dbconnect, $sql);
$resultCount=mysqli_num_rows($check); //count the out amount 
if($resultCount>0){
	while($row=mysqli_fetch_array($check)){
	$id=$row["id"];
	$name=$row["fname"];
	}
}else{
$msg="<p style='color: red; text-align: center'>You have not log in yet</p>";
}

// sum the total earn by current user 
$dynamic_list = "";
$dynamic_lists = "";
 if (isset($_POST['sum']))
 {
	$to_date = $_POST['to_date'] ." " . "23:59:59";
	$from_date = $_POST['from_date'];
	if (isset($_POST['from_date']) && ($_POST['to_date'])){

		// display the specified information
		$display = "SELECT * FROM `digital_income_sum` WHERE `date` >= '$from_date' AND `date` <= '$to_date'";
		$displayCheck = mysqli_query($dbconnect, $display) or die (mysqli_error($dbconnect));
		$displayResult = mysqli_num_rows($displayCheck);
		if ($displayResult > 0){
			while($row=mysqli_fetch_assoc($displayCheck)){
				$date = $row['date'];
				$internet = $row['internet'];
				$printing = $row['printing'];
				$scanning = $row['scanning'];
				$training = $row['training'];
				$total = $row['total'];
				
				
				$dynamic_list .= "<tr>";
				$dynamic_list .= "<td style='background-color:#CECECE;  text-align: center; font-family: arial;'>" .$date . "</td>";
				$dynamic_list .= "<td style='background-color:#CECECE; text-align: center; font-family: arial;'>".$internet . "</td>";
				$dynamic_list .= "<td style='background-color:#CECECE;  text-align: center; font-family: arial;'>".$printing . "</td>";
				$dynamic_list .= "<td style='background-color:#CECECE;  text-align: center; font-family: arial;'>" .$scanning . "</td>";
				$dynamic_list .= "<td style='background-color:#CECECE;  text-align: center; font-family: arial;'>".$training . "</td>";
				$dynamic_list .= "<td style='background-color:#CECECE;  text-align: center; font-family: arial;'>" .$total . "</td>";
				$dynamic_list .= "</tr>";

				

			}
		} else {
			$msg="<center><p style = 'color: #D8000C; background-color: #FFBABA; border-radius:.5em; width: 400px; border: 1px solid #D8D8D8; padding: 5px; border-radius: 5px; font-family: Arial; font-size: 11px; text-transform: uppercase; text-align: center; text-transform: uppercase; padding-left: 12px'>No result found</p></center>";
		}
	} else {
		?><script type="text/javascript">
		alert ('Please fill in the required fields');
		window.location = 'monthly_income.php';
		</script><?php
	}
	
	// sum total for internet
	$intersum = "SELECT  SUM(`internet`) AS intertotal FROM `digital_income_sum` WHERE `date` >= '$from_date' AND `date` <= '$to_date'";
	$intersum2 = mysqli_query($dbconnect, $intersum) or die (mysqli_error($dbconnect));
	$interresult = mysqli_fetch_array($intersum2);
	$intertotal = $interresult['intertotal'];
	
	
	// sum total for printing
	$printsum = "SELECT  SUM(`printing`) AS printtotal FROM `digital_income_sum` WHERE `date` >= '$from_date' AND `date` <= '$to_date'";
	$printsum2 = mysqli_query($dbconnect, $printsum) or die (mysqli_error($dbconnect));
	$printresult = mysqli_fetch_array($printsum2);
	$printtotal = $printresult['printtotal'];
	
	// sum total for scanning
	$scansum = "SELECT  SUM(`scanning`) AS scantotal FROM `digital_income_sum` WHERE `date` >= '$from_date' AND `date` <= '$to_date'";
	$scansum2 = mysqli_query($dbconnect, $scansum) or die (mysqli_error($dbconnect));
	$scanresult = mysqli_fetch_array($scansum2);
	$scantotal = $scanresult['scantotal'];
	
	// sum total for training
	$trainsum = "SELECT  SUM(`training`) AS traintotal FROM `digital_income_sum` WHERE `date` >= '$from_date' AND `date` <= '$to_date'";
	$trainsum2 = mysqli_query($dbconnect, $trainsum) or die (mysqli_error($dbconnect));
	$trainresult = mysqli_fetch_array($trainsum2);
	$traintotal = $trainresult['traintotal'];
	
	// sum total for scanning
	$totalsum = "SELECT  SUM(`total`) AS total FROM `digital_income_sum` WHERE `date` >= '$from_date' AND `date` <= '$to_date'";
	$totalsum2 = mysqli_query($dbconnect, $totalsum) or die (mysqli_error($dbconnect));
	$totalresult = mysqli_fetch_array($totalsum2);
	$totalall = $totalresult['total'];
	

	
	
	$dynamic_lists .= "<tr>";
	$dynamic_lists .= "<td style='background-color:#CECECE; text-align: center; font-family: arial;'>".$intertotal . "</td>";
	$dynamic_lists .= "<td style='background-color:#CECECE;  text-align: center; font-family: arial;'>".$printtotal . "</td>";
	$dynamic_lists .= "<td style='background-color:#CECECE;  text-align: center; font-family: arial;'>" .$scantotal . "</td>";
	$dynamic_lists .= "<td style='background-color:#CECECE;  text-align: center; font-family: arial;'>".$traintotal . "</td>";
	$dynamic_lists .= "<td style='background-color:#CECECE;  text-align: center; font-family: arial;'>" .$totalall . "</td>";
	$dynamic_lists .= "</tr>";
	
	$_SESSION['intertotal'] = $intertotal;
	$_SESSION['printtotal'] = $printtotal;
	$_SESSION['scantotal'] = $scantotal;
	$_SESSION['traintotal'] = $traintotal;
	$_SESSION['totalall'] = $totalall;
	
}
?>
<!doctype html>
<html>
<link href="http://10.40.255.5/buth_net/pharmacySection/css/buth_net.css" rel="stylesheet" type="text/css">
<head>
<meta charset="utf-8">
<link rel="shortcut icon" href="/favicon.ico" >
<title>Monthly Income</title>
<script src="js/jquery-1.12.3.min.js" type="text/javascript"></script>
</head>
<body>
<?php
include_once "../pharmacySection/header.php";
?>
<div id="container">
  <div id="sidebar1"><br>
    <p class="subHeader">Menu</p>
    <ul id="navigation2">
	  <li class="page_title">Digital Center</li><br>
	  <li><a href="index.php">Homepage</a></li><br>
	  <li><a href="admin_report.php">Today's Report</a></li><br>
	  <li><a href="monthly_income.php">Monthly Income</a></li><br>
	  <li><a href="yearly_income.php">Yearly Income</a></li><br>
	  <li><a href="enquiryForms.php">Issues</a></li><br>
	  <li><a href="logout.php">Logout</a></li><br>
    </ul>
      <!-- end .sidebar1 --></div>
     <div class="margin" id="content">
	 	   <h1 style='text-align: center; font-family: tahoma; font-size: 16px; text-transform: uppercase; font-weight: bold; background-color: #000000; color: #CECECE'>Welcome <?php echo $name."!" . " "; ?>What would you like to do today?</h1><br>
	   <?php echo $msg; ?>
	   <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
		<div class="search_angle">
		<div class="total_earn">
			<h2 style='margin-top: auto; font-family: Calibri (Body); font-size: 18px; font-weight: bold; text-transform: uppercase; font-style: normal; color: #FFFFFF'>Monthly Income</h2>
			<center><label style="font-family: monospace; font-size: 16px; font-weight: bold" >From</label>
			<input name="from_date" class="userarea0" type="text"  style="width: 150px" placeholder="YYYY-MM-DD" value="<?php if (isset($_POST['sum'])){echo $from_date;} ?>">
			<label style="font-family: monospace; font-size: 16px; font-weight: bold">To</label>
			<input name="to_date" class="userarea0" type="text"  style="width: 150px" placeholder="YYYY-MM-DD" value="<?php if (isset($_POST['sum'])){echo $to_date;} ?>"></center><br>
		<center><input type="submit" name="sum" class="submit4" value="Proceed"></center><br>
		</div>
	   </div><br><br>
		<div class="product_formlist">
	  <table width="760px" style="margin-left: auto; margin-right: auto" cellpadding="5" cellspacing="3" border="1">
	   <tr>
	    <td width="12%" style='background-color:#C5DFFA; font-family: arial black; text-align: center; font-size: 14px'><b>Date</b></td>
		<td width="20%" style='background-color:#C5DFFA; font-family: arial black; text-align: center; font-size: 14px'><b>Internet N</b></td>
		<td width="20%" style='background-color:#C5DFFA; font-family: arial black; text-align: center; font-size: 14px'><b>Printing N</b></td>
		<td width="17%" style='background-color:#C5DFFA; font-family: arial black; text-align: center; font-size: 14px'><b>Scanning N</b></td>
		<td width="20%" style='background-color:#C5DFFA; font-family: arial black; text-align: center; font-size: 14px'><b>Training N</b></td>
		<td width="11%" style='background-color:#C5DFFA; font-family: arial black; text-align: center; font-size: 14px'><b>Total N</b></td>
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
		<center><h3 class="heading_text">Grand Total</h3></center>
		 <table width="760px" style="margin-left: auto; margin-right: auto" cellpadding="5" cellspacing="3" border="1">
	   <tr>
		<td width="15%" style='background-color:#C5DFFA; font-family: arial black; text-align: center; font-size: 14px'><b>Internet N</b></td>
		<td width="15%" style='background-color:#C5DFFA; font-family: arial black; text-align: center; font-size: 14px'><b>Printing N</b></td>
		<td width="15%" style='background-color:#C5DFFA; font-family: arial black; text-align: center; font-size: 14px'><b>Scanning N</b></td>
		<td width="20%" style='background-color:#C5DFFA; font-family: arial black; text-align: center; font-size: 14px'><b>Training N</b></td>
		<td width="20%" style='background-color:#C5DFFA; font-family: arial black; text-align: center; font-size: 14px'><b>Total N</b></td>
		</tr>
		<?php echo $dynamic_lists; ?>
		<!--tr>
		 <td>&nbsp;</td>
		 <td>&nbsp;</td>
		 <td>&nbsp;</td>
		 <td>&nbsp;</td>
		 <td>&nbsp;</td>
		</tr-->
		</table><br><br>
		</form><br>
		<form action="monthly_income_receipt.php?from=$from_date&to=$to_date" method="GET" id="jsform" target="_blank">
		<input type="hidden" name="from_date" value="<?php echo $from_date; ?>">
		<input type="hidden" name="to_date" value="<?php echo $to_date; ?>">
		<center><input type="button" onclick="document.getElementById('jsform').submit();" class="submit4" value="Print Receipt"></center>
	  </form><br>
	   <!-- end .content --></div>
	  <!-- end .container --></div>
	  </div>
     <?php include_once "../pharmacySection/footer.php"; ?>
	 
</body>
</html>