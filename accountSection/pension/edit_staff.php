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



// edit item for staff

// parse the form data and add the inventory to the system
$staff_id = $_SESSION['staff_id'];
if (isset($_POST['submit']))
{
	$basic = htmlspecialchars(trim($_POST['basic']));
	$housing = htmlspecialchars(trim($_POST['housing']));
	$trans = htmlspecialchars(trim($_POST['trans']));
	$per = htmlspecialchars(trim($_POST['per'])). "%";
	$month = htmlspecialchars($_POST['month']);
	$year = htmlspecialchars($_POST['year']);
	$total = $basic + $housing + $trans * per;
	$added_value = $total;
	$date = $year . "-" . $month;
	$payable = $added_value * 2;

	if (empty($basic && $housing && $trans) === false){
		$sql_check = "SELECT staff_id, date FROM pension_form WHERE date = '".$date."' AND staff_id = '".$staff_id."' LIMIT 1";
		$check4 = mysqli_query($dbconnect, $sql_check);
		$resultCount4=mysqli_num_rows($check4); //count the out amount 
		if($resultCount4>0){
			while($row=mysqli_fetch_array($check4)){
				$date=$row["date"];
 
			
				$sql5 = "UPDATE pension_form SET `payable`='$payable', `added_value`='$added_value', `basic`='$basic', `housing`='$housing', `transport`='$trans', `date`='$date', `percentage`='$per', `total`='$total', `per_total`='$added_value' WHERE `date`='".$date."' AND `staff_id` = '".$staff_id."' LIMIT 1";
				$check5 = mysqli_query($dbconnect, $sql5) or die (mysqli_error($dbconnect));
				$msg = '<p style = "color: #4F8A10; margin-right: auto; margin-right: auto; text-align: center; background-color: #DFF2BF; border-radius:.5em; width: 400px; border: 1px solid #D8D8D8; margin-left: auto; margin-right: auto; padding: 5px; border-radius: 5px; font-family: Arial; font-size: 11px; text-transform: uppercase; text-transform: uppercase">Operation Successful</p>';
				header ("refresh:3; url=pension_home.php"); // wait  for 3 secs before redirect
			}
		} else if ($resultCount4==0){
			$sql3 = "INSERT INTO pension_form (staff_id, basic, housing, transport, date, percentage, total, per_total, added_value, payable) VALUES ('$staff_id', '$basic', '$housing', '$trans', '$date', '$per', '$total', '$percentage', '$added_value', '$payable')";
			$check3 = mysqli_query($dbconnect, $sql3) or die (mysqli_error($dbconnect));
			$msg = '<p style = "color: #4F8A10; margin-right: auto; margin-right: auto; text-align: center; background-color: #DFF2BF; border-radius:.5em; width: 400px; border: 1px solid #D8D8D8; margin-left: auto; margin-right: auto; padding: 5px; border-radius: 5px; font-family: Arial; font-size: 11px; text-transform: uppercase; text-transform: uppercase">Operation Successful</p>';
			header ("refresh:3; url=pension_home.php"); // wait for 3 secs before redirect
		}
	} else {
		$msg = "<p style='color: #D8000C; background-color: #FFBABA; border-radius:.5em; width: 300px; border: 1px solid #D8D8D8; padding: 5px; border-radius: 5px; margin-left: auto; margin-right: auto; font-family: Arial; font-size: 11px; text-transform: uppercase; text-align: center; text-transform: uppercase'>Please fill in the required fields</p>";
	}
	 
}

?>
<!doctype html>
<html>
<link href="http://localhost/buth_net/pharmacySection/css/buth_net.css" rel="stylesheet" type="text/css">
<head>
<meta charset="utf-8">
<link rel="shortcut icon" href="/favicon.ico" >
<title>Staff|<?php echo $staff_id; ?></title>
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
	  <li><a href="pension_home.php">Pension List</a></li><br>
	  <li><a href="edit_pension.php">Edit Pension List</a></li><br>
	  <li><a href="individual_pension.php">Individual Pension List</a></li><br>
	  <li><a href="all_pension.php">All Pension List</a></li><br>
	  <li><a href="../acc_logout.php">Logout</a></li><br>
    </ul>
	<?php include_once($_SERVER['DOCUMENT_ROOT'].'../buth_net/new_bar.php'); ?>
      <!-- end .sidebar1 --></div>
     <div class="margin" id="content">
	  <div class="product_lists">
	    </div><br>
		<div class="product_form2">
		 <form action="" method="post" enctype="multipart/form-data">
		 <div class="form"><br>
		 <h3 style='color: brown; font-size: 22px; font-style: normal; text-align: center; font-family: monospace'>Edit Information for|<?php echo $staff_id; ?><h3>
		 <?php
		 echo $msg;
		 ?>
		  <table width="450px" style="margin-left: auto; margin-right: auto; min-height: 100px;" cellpadding="5" cellspacing="0" border="1">
			 <tr>
			   <td width="30%"><label>Staff ID</label></td>
			   <td width="70%"><input type="text" id="userarea" name="staff_id" disabled="disabled" value= "<?php echo $staff_id; ?>"></td>
			  </tr>
			  <tr>
			   <td width="30%"><label>Basic</label><label style="color: #880000; float: right">*</label></td>
			   <td width="70%"><input type="text" id="userarea" name="basic" value= "<?=@$basic?>"></td>
			  </tr>
			  <tr>
			   <td width="30%"><label>Housing</label><label style="color: #880000; float: right">*</label></td>
			   <td width="70%"><input type="text" id="userarea" name="housing" value= "<?=@$housing?>"></td>
			  </tr>
			  <tr>
			   <td width="30%"><label>Transport</label><label style="color: #880000; float: right">*</label></td>
			   <td width="70%"><input type="text" id="userarea" name="trans" value= "<?=@$trans?>"></td>
			  </tr>
			   <tr>
				<td width="30%"><label>Month/Year</label><label style="color: #880000; float: right">*</label></td>
			   <td width="70%"><label style="font-family: monospace">Month</label><select name="month" id="userarea" class="being_pay_for" style="width: 106px; float: none; margin-left: 4px">
			   <option value="01">January</option>
			   <option value="02">February</option>
			   <option value="03">March</option>
			   <option value="04">April</option>
			   <option value="05">May</option>
			   <option value="06">June</option>
			   <option value="07">July</option>
			   <option value="08">August</option>
			   <option value="09">September</option>
				<option value="10">October</option>
			   <option value="11">November</option>
			   <option value="12">December</option>
			   </select><label style="float: none; font-family: monospace">Year</label><select name="year" id="userarea" class="being_pay_for" style="width: 106px; float: none; margin-left: 4px">
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
			     </select></td>
				 </tr>
				 <tr>
				<td width="30%"><label>Percentage</label><label style="color: #880000; float: right">*</label></td>
				 <td width="70%"><input name="per" type="number" id="userarea" max="100" value= "<?=@$per?>"></td>
				 </tr>
				</table><br>	
		   <center><input type="submit" value="Submit" name="submit" class="submit4"></center>
		   </form>
		  </div>
	</div>
			   <!-- end .content --></div>
			  <!-- end .container --></div>
     <?php
      include_once "../footer.php";
     ?>
</body>
</html>