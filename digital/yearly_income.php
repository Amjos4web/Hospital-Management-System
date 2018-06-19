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
$internet = "";
$printing = "";
$scanning = "";
$training = "";
$grandtotal = "";
$year = "";
if (isset($_POST['sum']))
 {
	$year = $_POST['year'];
	if (isset($_POST['year'])){

		// display the specified information
		$display = "SELECT * FROM `digital_income_sum2` WHERE `from_date` LIKE '%$year%' OR `to_date` LIKE '%$year%'";
		$displayCheck = mysqli_query($dbconnect, $display) or die (mysqli_error($dbconnect));
		$displayResult = mysqli_num_rows($displayCheck);
		if ($displayResult > 0){
			while($row=mysqli_fetch_assoc($displayCheck)){
				$month = $row['month'];
				$internet = $row['internet'];
				$printing = $row['printing'];
				$scanning = $row['scanning'];
				$training = $row['training'];
				$total = $row['total'];
				
				$dynamic_list .= "<tr>";
				$dynamic_list .= "<td style='background-color:#CECECE;  text-align: center; font-family: arial;'>".$month . "</td>";
				$dynamic_list .= "<td style='background-color:#CECECE; text-align: center; font-family: arial;'>".$internet . "</td>";
				$dynamic_list .= "<td style='background-color:#CECECE;  text-align: center; font-family: arial;'>".$printing . "</td>";
				$dynamic_list .= "<td style='background-color:#CECECE;  text-align: center; font-family: arial;'>" .$scanning . "</td>";
				$dynamic_list .= "<td style='background-color:#CECECE;  text-align: center; font-family: arial;'>".$training . "</td>";
				$dynamic_list .= "<td style='background-color:#CECECE;  text-align: center; font-family: arial;'>" .$total . "</td>";
				$dynamic_list .= "</tr>";
			}
		} else {
			$msg="<center><p style = 'color: #D8000C; background-color: #FFBABA; border-radius:.5em; width: 400px; border: 1px solid #D8D8D8; padding: 5px; border-radius: 5px; font-family: Arial; font-size: 11px; text-transform: uppercase; text-align: center; text-transform: uppercase; padding-left: 12px'>No result found for $year</p></center>";
		}
		
		
		
	} else {
		?><script type="text/javascript">
		alert ('Please select year');
		window.location = 'yearly_income.php';
		</script><?php
	}
	$grandtotal = $internet + $printing + $scanning + $training;
}
?>
<!doctype html>
<html>
<link href="http://10.40.255.5/buth_net/pharmacySection/css/buth_net.css" rel="stylesheet" type="text/css">
<head>
<meta charset="utf-8">
<link rel="shortcut icon" href="/favicon.ico" >
<title>Yearly Income</title>
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
			<h2 style='margin-top: auto; font-family: Calibri (Body); font-size: 18px; font-weight: bold; text-transform: uppercase; font-style: normal; color: #FFFFFF'>Yearly Income</h2>
			<center><label style="font-family: monospace; font-size: 16px; font-weight: bold" >Select Year</label></center>
			<center><select name="year" class="userarea0" width="200px">
			  <option value="null">Select Year</option>
			  <option value="2016">2016</option>
			  <option value="2017">2017</option>
			  <option value="2018">2018</option>
			  <option value="2019">2019</option>
			  <option value="2020">2020</option>
			  <option value="2021">2021</option>
			  <option value="2022">2022</option>
			  <option value="2023">2023</option>
			  <option value="2024">2024</option>
			  <option value="2025">2025</option>
			  <option value="2026">2026</option>
			  <option value="2027">2027</option>
			  <option value="2028">2028</option>
			  <option value="2029">2029</option>
			  <option value="2030">2030</option>
			</select></center><br>
		<center><input type="submit" name="sum" class="submit4" value="Process"></center><br>
		</div>
	   </div><br><br>
		<div class="product_formlist">
	  <table width="760px" style="margin-left: auto; margin-right: auto" cellpadding="5" cellspacing="3" border="1">
	   <tr>
	    <td width="20%" style='background-color:#C5DFFA; font-family: arial black; text-align: center; font-size: 14px'><b>Month</b></td>
		<td width="15%" style='background-color:#C5DFFA; font-family: arial black; text-align: center; font-size: 14px'><b>Internet N</b></td>
		<td width="15%" style='background-color:#C5DFFA; font-family: arial black; text-align: center; font-size: 14px'><b>Printing N</b></td>
		<td width="15%" style='background-color:#C5DFFA; font-family: arial black; text-align: center; font-size: 14px'><b>Scanning N</b></td>
		<td width="20%" style='background-color:#C5DFFA; font-family: arial black; text-align: center; font-size: 14px'><b>Training N</b></td>
		<td width="15%" style='background-color:#C5DFFA; font-family: arial black; text-align: center; font-size: 14px'><b>Total N</b></td>
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
		<center><h3 class="heading_text">Grand Total for <?php echo $year; ?></h3></center>
		<center><input name="expt_profit" class="userarea0" type="text" value="<?php echo "=N".$grandtotal; ?>"  style="width: 150px; text-align: center; background-color: #082944; color: #FFFFFF" disabled="disabled"></center><br>
		</form><br>
		<form action="yearly_income_receipt.php?year=$year" method="GET" id="jsform" target="_blank">
		<input type="hidden" name="year" value="<?php echo $year; ?>">
		<center><input type="button" onclick="document.getElementById('jsform').submit();" class="submit4" value="Print Receipt"></center>
	  </form><br>
	   <!-- end .content --></div>
	  <!-- end .container --></div>
	  </div>
     <?php include_once "../pharmacySection/footer.php"; ?>
	 
</body>
</html>