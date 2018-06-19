<?php 
session_start();
ob_start();
// error display configuration
error_reporting(E_ALL & ~E_NOTICE);

if(!isset($_SESSION['emaill'])){
	header('location: pension_login.php');
}
//This block grabs the whole list for viewing
$msg="";
$email= $_SESSION['emaill'];
include "../dbconnect2.php";
$sql="SELECT first_name, id FROM `pension_login` WHERE `emailAdd`='$email' LIMIT 1";
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

// sum the total earn by current user 
$sum = "";
$dynamic_list = "";
$dynamic_lists = "";
$choose_year = "";
if (isset($_POST['searchbtn'])){
	if (isset($_POST['choose_year']) && $_POST['choose_year'] != ""){
		// filter the inputs
		$choose_year = $_POST['choose_year'];
		$sqlcommand2 = "SELECT `staff_id`, `basic`, `housing`, `transport`, `date`, `percentage`, `total`, `per_total`, `id` FROM `pension_form` WHERE `date` LIKE '%$choose_year%'";
		$query = mysqli_query($dbconnect, $sqlcommand2) or die (mysqli_error($dbconnect));
		$count = mysqli_num_rows($query);
		if ($count > 0){
			while($row2=mysqli_fetch_assoc($query)){
				$staff_id = $row2["staff_id"];
				$basic=$row2["basic"];
				$housing=$row2["housing"];
				$trans=$row2["transport"];
				$date=$row2["date"];
				$per=$row2["percentage"];
				$total=$row2["total"];
				$per_total=$row2["per_total"];
				
				$dynamic_list .= "<tr>";
				$dynamic_list .= "<td style='background-color:#CECECE;  font-family: Adobe Heiti Std R;'>".$staff_id . "</td>";
				$dynamic_list .= "<td style='background-color:#CECECE;  font-family: Adobe Heiti Std R;'>".$basic . "</td>";
				$dynamic_list .= "<td style='background-color:#CECECE;  font-family: Adobe Heiti Std R;'>" .$housing . "</td>";
				$dynamic_list .= "<td style='background-color:#CECECE;  font-family: Adobe Heiti Std R;'>".$trans . "</td>";
				$dynamic_list .= "<td style='background-color:#CECECE;  font-family: Adobe Heiti Std R;'>".$date . "</td>";
				$dynamic_list .= "<td style='background-color:#CECECE;  font-family: Adobe Heiti Std R;'>" .$per . "</td>";
				$dynamic_list .= "<td style='background-color:#CECECE;  font-family: Adobe Heiti Std R;'>".$per_total . "</td>";
				$dynamic_list .= "<td style='background-color:#CECECE;  font-family: Adobe Heiti Std R;'>".$total . "</td>";
				$dynamic_list .= "</tr>";

				
			} // close the while loop
		} else {
			?><script type="text/javascript">
			alert ('No result found for <?php echo $choose_year ; ?>');
			windows.locaton = 'all_pension.php';
			</script><?php
		}
	} else {
		?><script type="text/javascript">
		alert ('field should not be empty');
		windows.locaton = 'all_pension.php';
		</script><?php
	}
	// total sum
	$sum = "SELECT  SUM(`total`) AS total_sum1 FROM `pension_form` WHERE `date` LIKE '%$choose_year%'";
	$sum2 = mysqli_query($dbconnect, $sum) or die (mysqli_error($dbconnect));
	$result1 = mysqli_fetch_array($sum2);
	$sum_total = $result1['total_sum1'];
	$_SESSION['sum_total'] = $sum_total;
	
	// percentage sum
	$sum = "SELECT  SUM(`per_total`) AS total_sum2 FROM `pension_form` WHERE  `date` LIKE '%$choose_year%'";
	$sum2 = mysqli_query($dbconnect, $sum) or die (mysqli_error($dbconnect));
	$result1 = mysqli_fetch_array($sum2);
	$sum_total2 = $result1['total_sum2'];
	$_SESSION['sum_tota2'] = $sum_total2;
	
}
?>
<!doctype html>
<html>
<link href="http://localhost/buth_net/pharmacySection/css/buth_net.css" rel="stylesheet" type="text/css">
<head>
<meta charset="utf-8">
<link rel="shortcut icon" href="/favicon.ico" >
<title>All Pension List</title>
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
	  <li><a href="pension_home.php">Pension List</a></li><br>
	  <li><a href="edit_pension.php">Edit Pension List</a></li><br>
	  <li><a href="individual_pension.php">Individual Pension List</a></li><br>
	  <li><a href="all_pension.php">All Pension List</a></li><br>
	  <li><a href="../acc_logout.php">Logout</a></li><br>
    </ul>
      <!-- end .sidebar1 --></div>
     <div class="margin" id="content">
	 	   <h1 style='text-align: center; font-family: tahoma; font-size: 16px; text-transform: uppercase; font-weight: bold; background-color: #000000; color: #CECECE'>Welcome <?php echo $name."!" . " "; ?>What would you like to do today?</h1><br>
	   <?php echo $msg; ?>
	   <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
		<div class="search_angle">
			<center><h3 class="heading_text">All pension list</h3></center><br>
			<center><img src="../images/payment2.jpg" alt="search_angle" width="500px" height="200px"></center><br>
			<div class="search">
			<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
			<h1 style='font-family: monospace; color: #880000; float: left; margin-left: 17px; font-size: 18px;'>Select year below...</h1><br><br><br>
			<center><select name="choose_year" class="user" style="width: 200px">
				 <option value="null">Select Year</option>
				 <option value="1990">1990</option>
				 <option value="1991">1991</option>
				 <option value="1992">1992</option>
				 <option value="1993">1993</option>
				 <option value="1994">1994</option>
				 <option value="1995">1995</option>
				 <option value="1996">1996</option>
				 <option value="1997">1997</option>
				 <option value="1998">1998</option>
				 <option value="1999">1999</option>
				 <option value="2000">2000</option>
				 <option value="2001">2001</option>
				 <option value="2002">2002</option>
				 <option value="2003">2003</option>
				 <option value="2004">2004</option>
				 <option value="2005">2005</option>
				 <option value="2006">2006</option>
				 <option value="2007">2007</option>
				 <option value="2008">2008</option>
				 <option value="2009">2009</option>
				 <option value="2010">2010</option>
				 <option value="2011">2011</option>
				 <option value="2012">2012</option>
				 <option value="2013">2013</option>
				 <option value="2014">2014</option>
				 <option value="2015">2015</option>
				 <option value="2016">2016</option>
				 <option value="2000">2017</option>
				 <option value="2001">2018</option>
				 <option value="2002">2019</option>
				 <option value="2003">2020</option>
				 <option value="2004">2021</option>
				 <option value="2005">2022</option>
				 <option value="2006">2023</option>
				 <option value="2007">2024</option>
				 <option value="2008">2025</option>
				 <option value="2009">2026</option>
				 <option value="2010">2027</option>
				 <option value="2011">2028</option>
				 <option value="2012">2029</option>
				 <option value="2013">2030</option>
			 </select></center><br>
			<center><input type="submit" value="Sum" name="searchbtn" class="submit4"></center>
		 </form><br>
		<div class="product_formlist">
		<?php echo $dynamic_lists; ?><hr><br>
	  <table width="730px" style="margin-left: auto; margin-right: auto" cellpadding="5" cellspacing="3" border="1">
	   <tr>
	    <td width="12%" style='background-color:#C5DFFA; font-family: arial black; text-align: center; font-size: 14px'><b>Staff ID</b></td>
		<td width="13%" style='background-color:#C5DFFA; font-family: arial black; text-align: center; font-size: 14px'><b>Basic N</td>
		<td width="13%" style='background-color:#C5DFFA; font-family: arial black; text-align: center; font-size: 14px'><b>Housing N</b></td>
		<td width="15%" style='background-color:#C5DFFA; font-family: arial black; text-align: center; font-size: 14px'><b>Transport N</b></td>
		<td width="14%" style='background-color:#C5DFFA; font-family: arial black; text-align: center; font-size: 14px'><b>Date</b></td>
		<td width="8%" style='background-color:#C5DFFA; font-family: arial black; text-align: center; font-size: 14px'><b>Percentage</b></td>
		<td width="12%" style='background-color:#C5DFFA; font-family: arial black; text-align: center; font-size: 14px'><b>Per. Total</b></td>
		<td width="13%" style='background-color:#C5DFFA; font-family: arial black; text-align: center; font-size: 14px'><b>Total N</b></td>
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
			<center><h3 class="heading_text">Total For <?php if (isset($_POST['searchbtn'])){ echo "all pension in" . " " . $choose_year;} ?></h3></center>
			<center><input type="text"  id="total_earn_area" disabled="disabled" value="<?php if (isset($_POST['searchbtn'])){echo "N".$sum_total;} ?>"></center><br>
			<center><h3 class="heading_text">Percentage Total For <?php if (isset($_POST['searchbtn'])){ echo "all pension" . " " . "in" . " " . $choose_year;} ?></h3></center>
			<center><input type="text"  id="total_earn_area" disabled="disabled" value="<?php if (isset($_POST['searchbtn'])){echo "N".$sum_total2;} ?>"></center><br>
		</form><br>
		<form action="allPension_receipt.php?year=$choose_year" method="GET" id="jsform" target="_blank">
		<select name="choose_year" class="user" style="display: none">
		<option value="<?php echo $choose_year; ?>"><?php echo $choose_year; ?></option>
		</select>
		<center><input type="button" onclick="document.getElementById('jsform').submit();" class="submit4" value="Print Receipt"></center>
	  </form><br>
	   <!-- end .content --></div>
	  <!-- end .container --></div>
	  </div>
	  </div>
	  </div>
     <?php include_once "../footer.php"; ?>
	 
</body>
</html>