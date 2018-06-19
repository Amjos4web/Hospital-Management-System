<?php 
session_start();
ob_start();
// error display configuration
//error_reporting(E_ALL & ~E_NOTICE);

if(!isset($_SESSION['emaill'])){
	header('location: admin_login.php');
}
//This block grabs the whole list for viewing
$msg="";
$email= $_SESSION['emaill'];
include "../pharmacySection/dbconnect2.php";
$sql="SELECT * FROM `admin` WHERE `admin_email`='$email' LIMIT 1";
$check = mysqli_query($dbconnect, $sql);
$resultCount=mysqli_num_rows($check); //count the out amount 
if($resultCount>0){
	while($row=mysqli_fetch_array($check)){
	$name=$row["name"];
	}
}else{
$msg="<p style='color: red; text-align: center'>You have no Information yet in the Database</p>";
}

// $staff_id = $_SESSION['staff_id'];
if (isset($_GET['staff_id'])){
	$staff_id = $_GET['staff_id'];
	
	$sql6 = "SELECT * FROM staff_record2 WHERE staff_id='".$staff_id."' LIMIT 1";
	$check6 = mysqli_query($dbconnect, $sql6) or die (mysqli_error($dbconnect));
	$resultCount6 = mysqli_num_rows($check6);
	if ($resultCount6>0){
		while($row=mysqli_fetch_array($check6)){
			$schooll1 = $row["school1"];
			$fromm1 = $row["from1"];
			$too1 = $row["to1"];
			$schooll2 = $row["school2"];
			$fromm2 = $row["from2"];
			$too2 = $row["to2"];
			$schooll3 = $row["school3"];
			$fromm3 = $row["from3"];
			$too3 = $row["to3"];
			$schooll4 = $row["school4"];
			$fromm4 = $row["from4"];
			$too4 = $row["to4"];
			$schooll5 = $row["school5"];
			$fromm5 = $row["from5"];
			$too5 = $row["to5"];
			$certt1 = $row["cert1"];
			$certt2 = $row["cert2"];
			$certt3 = $row["cert3"];
			$certt4 = $row["cert4"];
			$certt5 = $row["cert5"];
			$other_schooll1 = $row["other_schools1"];
			$other_yearr1 = $row["other_year1"];
			$other_certt1 = $row["other_cert1"];
			$other_schooll2 = $row["other_schools2"];
			$other_yearr2 = $row["other_year2"];
			$other_certt2 = $row["other_cert2"];
			$other_schooll3 = $row["other_schools3"];
			$other_yearr3 = $row["other_year3"];
			$other_certt3 = $row["other_cert3"];
			$other_schooll4 = $row["other_schools4"];
			$other_yearr4 = $row["other_year4"];
			$other_certt4 = $row["other_cert4"];
			$other_schooll5 = $row["other_schools5"];
			$other_yearr5 = $row["other_year5"];
			$other_certt5 = $row["other_cert5"];
			$diss1 = $row["dis1"];
			$int1 = $row["inte1"];
			$diss2 = $row["dis2"];
			$int2 = $row["inte2"];
			$diss3 = $row["dis3"];
			$int3 = $row["inte3"];
			$diss4 = $row["dis4"];
			$int4 = $row["inte4"];
		}
	} else {
		$msg="<p style='color: #D8000C; background-color: #FFBABA; border-radius:.5em; width: 300px; border: 1px solid #D8D8D8; padding: 5px; border-radius: 5px; margin-left: auto; margin-right: auto; font-family: Arial; font-size: 11px; text-transform: uppercase; text-align: center; text-transform: uppercase'>That staff does not exit. Please try again with another ID</p>";
	}
}

if (isset($_POST['proceed'])){
	$school1 = htmlspecialchars(trim($_POST['school1']));
	$schoolStart1 = htmlspecialchars($_POST['schoolStart1']);
	$schoolStop1 = htmlspecialchars($_POST['schoolStop1']);
	$school2 = htmlspecialchars(trim($_POST['school2']));
	$schoolStart2 = htmlspecialchars($_POST['schoolStart2']);
	$schoolStop2 = htmlspecialchars($_POST['schoolStop2']);
	$school3 = htmlspecialchars(trim($_POST['school3']));
	$schoolStart3 = htmlspecialchars($_POST['schoolStart3']);
	$schoolStop3 = htmlspecialchars($_POST['schoolStop3']);
	$school4 = htmlspecialchars(trim($_POST['school4']));
	$schoolStart4 = htmlspecialchars($_POST['schoolStart4']);
	$schoolStop4 = htmlspecialchars($_POST['schoolStop4']);
	$school5 = htmlspecialchars(trim($_POST['school5']));
	$schoolStart5 = htmlspecialchars($_POST['schoolStart5']);
	$schoolStop5 = htmlspecialchars($_POST['schoolStop5']);
	$cert1 = htmlspecialchars($_POST['cert1']);
	$cert2 = htmlspecialchars($_POST['cert2']);
	$cert3 = htmlspecialchars($_POST['cert3']);
	$cert4 = htmlspecialchars($_POST['cert4']);
	$cert5 = htmlspecialchars($_POST['cert5']);
	$other_school1 = htmlspecialchars($_POST['other_school1']);
	$other_year1 = htmlspecialchars($_POST['other_year1']);
	$other_cert1 = htmlspecialchars($_POST['other_cert1']);
	$other_school2 = htmlspecialchars($_POST['other_school2']);
	$other_year2 = htmlspecialchars($_POST['other_year2']);
	$other_cert2 = htmlspecialchars($_POST['other_cert2']);
	$other_school3 = htmlspecialchars($_POST['other_school3']);
	$other_year3 = htmlspecialchars($_POST['other_year3']);
	$other_cert3 = htmlspecialchars($_POST['other_cert3']);
	$other_school4 = htmlspecialchars($_POST['other_school4']);
	$other_year4 = htmlspecialchars($_POST['other_year4']);
	$other_cert4 = htmlspecialchars($_POST['other_cert4']);
	$other_school5 = htmlspecialchars($_POST['other_school5']);
	$other_year5 = htmlspecialchars($_POST['other_year5']);
	$other_cert5 = htmlspecialchars($_POST['other_cert5']);
	$dis1 = htmlspecialchars($_POST['dis1']);
	$other_int1 = htmlspecialchars($_POST['other_int1']);
	$dis2 = htmlspecialchars($_POST['dis2']);
	$other_int2 = htmlspecialchars($_POST['other_int2']);
	$dis3 = htmlspecialchars($_POST['dis3']);
	$other_int3 = htmlspecialchars($_POST['other_int3']);
	$dis4 = htmlspecialchars($_POST['dis4']);
	$other_int4 = htmlspecialchars($_POST['other_int4']);
	
	
	if (empty($school1 && $schoolStart1 && $schoolStop1) == false)
	{
		if ((strlen($_POST['school1']) < 70) && (strlen($_POST['school2']) < 70) && (strlen($_POST['school3']) < 70) && (strlen($_POST['school4']) < 70))
		{
			$sql = "UPDATE `staff_record2` SET `school1`='$school1', `from1`='$schoolStart1', `to1`='$schoolStop1', `school2`='$school2', `from2`='$schoolStart2', `to2`='$schoolStop2', `school3`='$school3', `from3`='$schoolStart3', `to3`='$schoolStop3', `school4`='$school4', `from4`='$schoolStart4', `to4`='$schoolStop4', `school5`='$school5', `from5`='$schoolStart5', `to5`='$schoolStop5', `cert1`='$cert1', `cert2`='$cert2', `cert3`='$cert3', `cert4`='$cert4', `cert5`='$cert5', `other_schools1`='$other_school1', `other_year1`='$other_year1', `other_cert1`='$other_cert1', `other_schools2`='$other_school2', `other_year2`='$other_year2', `other_cert2`='$other_cert2', `other_schools3`='$other_school3', `other_year3`='$other_year3', `other_cert3`='$other_cert3', `other_schools4`='$other_school4', `other_year4`='$other_year4', `other_cert4`='$other_cert4', `other_schools5`='$other_school5', `other_year5`='$other_year5', `other_cert5`='$other_cert5', `dis1`='$dis1', `inte1`='$other_int1', `dis2`='$dis2', `inte2`='$other_int2', `dis3`='$dis3', `inte3`='$other_int3', `dis4`='$dis4', `inte4`='$other_int4' WHERE `staff_id`='".$staff_id."' LIMIT 1";
			$query = mysqli_query($dbconnect, $sql) or die(mysqli_error($dbconnect));
			$msg = '<p style = "color: #4F8A10; margin-right: auto; margin-right: auto; text-align: center; background-color: #DFF2BF; border-radius:.5em; width: 400px; border: 1px solid #D8D8D8; margin-left: auto; margin-right: auto; padding: 5px; border-radius: 5px; font-family: Arial; font-size: 11px; text-transform: uppercase; text-transform: uppercase">Operation Successful.. <a href="staff_form1.php">Continue here</a></p>';						
		} else 
		$msg = "<p style='color: #D8000C; background-color: #FFBABA; border-radius:.5em; width: 300px; border: 1px solid #D8D8D8; padding: 5px; border-radius: 5px; margin-left: auto; margin-right: auto; font-family: Arial; font-size: 11px; text-transform: uppercase; text-align: center; text-transform: uppercase'>School name should not be greater than 30 chars</p>";
	} else
	$msg = "<p style='color: #D8000C; background-color: #FFBABA; border-radius:.5em; width: 300px; border: 1px solid #D8D8D8; padding: 5px; border-radius: 5px; margin-left: auto; margin-right: auto; font-family: Arial; font-size: 11px; text-transform: uppercase; text-align: center; text-transform: uppercase'>Please fill in at least one field</p>";	
}

?>
<!DOCTYPE html>
<html>
<link href="http://localhost/buth_net/pharmacySection/css/buth_net.css" rel="stylesheet" type="text/css">
<head>
<meta charset="utf-8">
<link rel="shortcut icon" href="/favicon.ico" >
<script src="js/jquery.js" type="text/javascript"></script>
<script src="js/jqueryy.js" type="text/javascript"></script>
<title>Education/<?php echo $staff_id; ?></title>
</head>
<body>
<?php
include_once "../pharmacySection/header.php";
?>
<div id="container">
  <div id="sidebar1"><br>
    <p class="subHeader">Menu</p>
   <ul id="navigation2">
	  <li class="page_title">Admin Unit</li><br>
		<li><a href="http://localhost/buth_net/index.php">Main Page</a></li><br>
		<li><a href="admin_block.php">Home Page</a></li><br>
		<li><a href="staff_form1.php">New Registration</a></li><br>
		<li><a href="view_staff.php">View Staff</a></li><br>
		<li><a href="logout.php">Logout</a></li><br>
    </ul>
	 <?php include_once "../new_bar.php"; ?>
	 
    <!-- end .sidebar1 --></div>
  <div class="margin" id="content">
     <div id="personalty">
	    <ul>
		  <li id="gen"><a href="editstaff_details.php?staff_id=<?php echo $staff_id; ?>">Bio Data</a></li>
		  <li id="staff"><a href="editstaff_form2.php?staff_id=<?php echo $staff_id; ?>">Next Of Kin</a></li>
		  <li id="sem"><a href="editstaff_form3.php?staff_id=<?php echo $staff_id; ?>">Education Background</a></li>
	    </ul>
	  </div>
  <center><h3 class="heading_text" style="width: 400px">Staff Identification Data (Education)</h3></center><br>
		<div id="Content_Area">
		 <div class="bio_data">
		  <fieldset style="width: 680px">
		    <legend>EDUCATION BACKGROUND</legend>
			<?php echo $msg; ?>
			  <div class="form_btn">
			   <form action="" method="post">
			     <h1 style='text-align: center; font-family: arial black; color: #ffffff; text-transform: uppercase; font-size: 18px; text-shadow: -1px -1px 1px #aaa, 0px 4px 1px rgba(0,0,0,0.5), 4px 4px 5px rgba(0,0,0,0.7), 0px 0px 7px rgba(0,0,0,0.4); font-weight: bold'>School Attended with years and certificate</h1>
				 <p><input type="text" class="userarea_form" name="school1" placeholder="Name of School" value="<?=@$schooll1?>">From<select name="schoolStart1" class="user">
				 <option value="<?php echo $fromm1; ?>"><?php echo $fromm1; ?></option>
				 <option value="1967">1967</option>
				 <option value="1968">1968</option>
				 <option value="1969">1969</option>
				 <option value="1970">1970</option>
				 <option value="1971">1971</option>
				 <option value="1972">1972</option>
				 <option value="1973">1973</option>
				 <option value="1974">1974</option>
				 <option value="1975">1975</option>
				 <option value="1976">1976</option>
				 <option value="1977">1977</option>
				 <option value="1978">1978</option>
				 <option value="1979">1979</option>
				 <option value="1980">1980</option>
				 <option value="1981">1981</option>
				 <option value="1982">1982</option>
				 <option value="1983">1983</option>
				 <option value="1984">1984</option>
				 <option value="1985">1985</option>
				 <option value="1986">1986</option>
				 <option value="1987">1987</option>
				 <option value="1988">1988</option>
				 <option value="1989">1989</option>
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
				 </select>
				 To<select name="schoolStop1" class="user">
				 <option value="<?php echo $too1; ?>"><?php echo $too1; ?></option>
				 <option value="1967">1967</option>
				 <option value="1968">1968</option>
				 <option value="1969">1969</option>
				 <option value="1970">1970</option>
				 <option value="1971">1971</option>
				 <option value="1972">1972</option>
				 <option value="1973">1973</option>
				 <option value="1974">1974</option>
				 <option value="1975">1975</option>
				 <option value="1976">1976</option>
				 <option value="1977">1977</option>
				 <option value="1978">1978</option>
				 <option value="1979">1979</option>
				 <option value="1980">1980</option>
				 <option value="1981">1981</option>
				 <option value="1982">1982</option>
				 <option value="1983">1983</option>
				 <option value="1984">1984</option>
				 <option value="1985">1985</option>
				 <option value="1986">1986</option>
				 <option value="1987">1987</option>
				 <option value="1988">1988</option>
				 <option value="1989">1989</option>
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
				 </select>
				 Certificate<select name="cert1" class="user">
				 <option value="<?php echo $certt1; ?>"><?php echo $certt1; ?></option>
				 <option value="WAEC/SSCE">WAEC/SSCE</option>
				 <option value="OND">OND</option>
				 <option value="HND">HND</option>
				 <option value="Degree">Degree</option>
				 <option value="PGD">PGD</option>
				 <option value="Masters">Masters</option>
				 <option value="Phd">Phd</option>
				 <option value="NCE">NCE</option>
				 </select></p>
				 <p><input type="text" class="userarea_form" name="school2" placeholder="Name of School">From<select name="schoolStart2" class="user">
				 <option value="Null"></option>
				 <option value="1967">1967</option>
				 <option value="1968">1968</option>
				 <option value="1969">1969</option>
				 <option value="1970">1970</option>
				 <option value="1971">1971</option>
				 <option value="1972">1972</option>
				 <option value="1973">1973</option>
				 <option value="1974">1974</option>
				 <option value="1975">1975</option>
				 <option value="1976">1976</option>
				 <option value="1977">1977</option>
				 <option value="1978">1978</option>
				 <option value="1979">1979</option>
				 <option value="1980">1980</option>
				 <option value="1981">1981</option>
				 <option value="1982">1982</option>
				 <option value="1983">1983</option>
				 <option value="1984">1984</option>
				 <option value="1985">1985</option>
				 <option value="1986">1986</option>
				 <option value="1987">1987</option>
				 <option value="1988">1988</option>
				 <option value="1989">1989</option>
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
				 </select>
				 To<select name="schoolStop2" class="user">
				  <option value="Null"></option>
				 <option value="1967">1967</option>
				 <option value="1968">1968</option>
				 <option value="1969">1969</option>
				 <option value="1970">1970</option>
				 <option value="1971">1971</option>
				 <option value="1972">1972</option>
				 <option value="1973">1973</option>
				 <option value="1974">1974</option>
				 <option value="1975">1975</option>
				 <option value="1976">1976</option>
				 <option value="1977">1977</option>
				 <option value="1978">1978</option>
				 <option value="1979">1979</option>
				 <option value="1980">1980</option>
				 <option value="1981">1981</option>
				 <option value="1982">1982</option>
				 <option value="1983">1983</option>
				 <option value="1984">1984</option>
				 <option value="1985">1985</option>
				 <option value="1986">1986</option>
				 <option value="1987">1987</option>
				 <option value="1988">1988</option>
				 <option value="1989">1989</option>
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
				 </select>
				 Certificate<select name="cert2" class="user">
				 <option value="Null"></option>
				 <option value="WAEC/SSCE">WAEC/SSCE</option>
				 <option value="OND">OND</option>
				 <option value="HND">HND</option>
				 <option value="Degree">Degree</option>
				 <option value="PGD">PGD</option>
				 <option value="Masters">Masters</option>
				 <option value="Phd">Phd</option>
				 <option value="NCE">NCE</option>
				 </select></p>
				 <p><input type="text" class="userarea_form" name="school3" placeholder="Name of School">From<select name="schoolStart3" class="user">
				  <option value="Null"></option>
				 <option value="1967">1967</option>
				 <option value="1968">1968</option>
				 <option value="1969">1969</option>
				 <option value="1970">1970</option>
				 <option value="1971">1971</option>
				 <option value="1972">1972</option>
				 <option value="1973">1973</option>
				 <option value="1974">1974</option>
				 <option value="1975">1975</option>
				 <option value="1976">1976</option>
				 <option value="1977">1977</option>
				 <option value="1978">1978</option>
				 <option value="1979">1979</option>
				 <option value="1980">1980</option>
				 <option value="1981">1981</option>
				 <option value="1982">1982</option>
				 <option value="1983">1983</option>
				 <option value="1984">1984</option>
				 <option value="1985">1985</option>
				 <option value="1986">1986</option>
				 <option value="1987">1987</option>
				 <option value="1988">1988</option>
				 <option value="1989">1989</option>
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
				 </select>
				 To<select name="schoolStop3" class="user">
				  <option value="Null"></option>
				 <option value="1967">1967</option>
				 <option value="1968">1968</option>
				 <option value="1969">1969</option>
				 <option value="1970">1970</option>
				 <option value="1971">1971</option>
				 <option value="1972">1972</option>
				 <option value="1973">1973</option>
				 <option value="1974">1974</option>
				 <option value="1975">1975</option>
				 <option value="1976">1976</option>
				 <option value="1977">1977</option>
				 <option value="1978">1978</option>
				 <option value="1979">1979</option>
				 <option value="1980">1980</option>
				 <option value="1981">1981</option>
				 <option value="1982">1982</option>
				 <option value="1983">1983</option>
				 <option value="1984">1984</option>
				 <option value="1985">1985</option>
				 <option value="1986">1986</option>
				 <option value="1987">1987</option>
				 <option value="1988">1988</option>
				 <option value="1989">1989</option>
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
				 </select>
				 Certificate<select name="cert3" class="user">
				 <option value="Null"></option>
				 <option value="WAEC/SSCE">WAEC/SSCE</option>
				 <option value="OND">OND</option>
				 <option value="HND">HND</option>
				 <option value="Degree">Degree</option>
				 <option value="PGD">PGD</option>
				 <option value="Masters">Masters</option>
				 <option value="Phd">Phd</option>
				 <option value="NCE">NCE</option>
				 </select></p>
				 <p><input type="text" class="userarea_form" name="school4" placeholder="Name of School">From<select name="schoolStart4" class="user">
				  <option value="Null"></option>
				 <option value="1967">1967</option>
				 <option value="1968">1968</option>
				 <option value="1969">1969</option>
				 <option value="1970">1970</option>
				 <option value="1971">1971</option>
				 <option value="1972">1972</option>
				 <option value="1973">1973</option>
				 <option value="1974">1974</option>
				 <option value="1975">1975</option>
				 <option value="1976">1976</option>
				 <option value="1977">1977</option>
				 <option value="1978">1978</option>
				 <option value="1979">1979</option>
				 <option value="1980">1980</option>
				 <option value="1981">1981</option>
				 <option value="1982">1982</option>
				 <option value="1983">1983</option>
				 <option value="1984">1984</option>
				 <option value="1985">1985</option>
				 <option value="1986">1986</option>
				 <option value="1987">1987</option>
				 <option value="1988">1988</option>
				 <option value="1989">1989</option>
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
				 </select>
				 To<select name="schoolStop4" class="user">
				  <option value="Null"></option>
				 <option value="1967">1967</option>
				 <option value="1968">1968</option>
				 <option value="1969">1969</option>
				 <option value="1970">1970</option>
				 <option value="1971">1971</option>
				 <option value="1972">1972</option>
				 <option value="1973">1973</option>
				 <option value="1974">1974</option>
				 <option value="1975">1975</option>
				 <option value="1976">1976</option>
				 <option value="1977">1977</option>
				 <option value="1978">1978</option>
				 <option value="1979">1979</option>
				 <option value="1980">1980</option>
				 <option value="1981">1981</option>
				 <option value="1982">1982</option>
				 <option value="1983">1983</option>
				 <option value="1984">1984</option>
				 <option value="1985">1985</option>
				 <option value="1986">1986</option>
				 <option value="1987">1987</option>
				 <option value="1988">1988</option>
				 <option value="1989">1989</option>
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
				 </select>
				 Certificate<select name="cert4" class="user">
				 <option value="Null"></option>
				 <option value="WAEC/SSCE">WAEC/SSCE</option>
				 <option value="OND">OND</option>
				 <option value="HND">HND</option>
				 <option value="Degree">Degree</option>
				 <option value="PGD">PGD</option>
				 <option value="Masters">Masters</option>
				 <option value="Phd">Phd</option>
				 <option value="NCE">NCE</option>
				 </select></p>
				 <p><input type="text" class="userarea_form" name="school5" placeholder="Name of School">From<select name="schoolStart5" class="user">
				 <option value="Null"></option>
				 <option value="1967">1967</option>
				 <option value="1968">1968</option>
				 <option value="1969">1969</option>
				 <option value="1970">1970</option>
				 <option value="1971">1971</option>
				 <option value="1972">1972</option>
				 <option value="1973">1973</option>
				 <option value="1974">1974</option>
				 <option value="1975">1975</option>
				 <option value="1976">1976</option>
				 <option value="1977">1977</option>
				 <option value="1978">1978</option>
				 <option value="1979">1979</option>
				 <option value="1980">1980</option>
				 <option value="1981">1981</option>
				 <option value="1982">1982</option>
				 <option value="1983">1983</option>
				 <option value="1984">1984</option>
				 <option value="1985">1985</option>
				 <option value="1986">1986</option>
				 <option value="1987">1987</option>
				 <option value="1988">1988</option>
				 <option value="1989">1989</option>
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
				 </select>
				 To<select name="schoolStop5" class="user">
				  <option value="Null"></option>
				 <option value="1967">1967</option>
				 <option value="1968">1968</option>
				 <option value="1969">1969</option>
				 <option value="1970">1970</option>
				 <option value="1971">1971</option>
				 <option value="1972">1972</option>
				 <option value="1973">1973</option>
				 <option value="1974">1974</option>
				 <option value="1975">1975</option>
				 <option value="1976">1976</option>
				 <option value="1977">1977</option>
				 <option value="1978">1978</option>
				 <option value="1979">1979</option>
				 <option value="1980">1980</option>
				 <option value="1981">1981</option>
				 <option value="1982">1982</option>
				 <option value="1983">1983</option>
				 <option value="1984">1984</option>
				 <option value="1985">1985</option>
				 <option value="1986">1986</option>
				 <option value="1987">1987</option>
				 <option value="1988">1988</option>
				 <option value="1989">1989</option>
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
				 </select>
				  Certificate<select name="cert5" class="user">
				<option value="Null"></option>
				 <option value="WAEC/SSCE">WAEC/SSCE</option>
				 <option value="OND">OND</option>
				 <option value="HND">HND</option>
				 <option value="Degree">Degree</option>
				 <option value="PGD">PGD</option>
				 <option value="Masters">Masters</option>
				 <option value="Phd">Phd</option>
				 <option value="NCE">NCE</option>
				 </select></p><br>
				 <h1 style='text-align: center; font-family: arial black; color: #ffffff; text-transform: uppercase; font-size: 18px; text-shadow: -1px -1px 1px #aaa, 0px 4px 1px rgba(0,0,0,0.5), 4px 4px 5px rgba(0,0,0,0.7), 0px 0px 7px rgba(0,0,0,0.4); font-weight: bold'>other bodies and certificates</h1>
				 <p><input type="text" class="userarea_form" name="other_school1" style="width: 230px" placeholder="Name of Body">Year<select name="other_year1" class="user">
				  <option value="Null"></option>
				 <option value="1967">1967</option>
				 <option value="1968">1968</option>
				 <option value="1969">1969</option>
				 <option value="1970">1970</option>
				 <option value="1971">1971</option>
				 <option value="1972">1972</option>
				 <option value="1973">1973</option>
				 <option value="1974">1974</option>
				 <option value="1975">1975</option>
				 <option value="1976">1976</option>
				 <option value="1977">1977</option>
				 <option value="1978">1978</option>
				 <option value="1979">1979</option>
				 <option value="1980">1980</option>
				 <option value="1981">1981</option>
				 <option value="1982">1982</option>
				 <option value="1983">1983</option>
				 <option value="1984">1984</option>
				 <option value="1985">1985</option>
				 <option value="1986">1986</option>
				 <option value="1987">1987</option>
				 <option value="1988">1988</option>
				 <option value="1989">1989</option>
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
				 </select>
				 Certificate<input type="text" name="other_cert1" class="user" style="width: 200px"></p>
				 <p><input type="text" class="userarea_form" name="other_school2" style="width: 230px" placeholder="Name of Body">Year<select name="other_year2" class="user">
				  <option value="Null"></option>
				 <option value="1967">1967</option>
				 <option value="1968">1968</option>
				 <option value="1969">1969</option>
				 <option value="1970">1970</option>
				 <option value="1971">1971</option>
				 <option value="1972">1972</option>
				 <option value="1973">1973</option>
				 <option value="1974">1974</option>
				 <option value="1975">1975</option>
				 <option value="1976">1976</option>
				 <option value="1977">1977</option>
				 <option value="1978">1978</option>
				 <option value="1979">1979</option>
				 <option value="1980">1980</option>
				 <option value="1981">1981</option>
				 <option value="1982">1982</option>
				 <option value="1983">1983</option>
				 <option value="1984">1984</option>
				 <option value="1985">1985</option>
				 <option value="1986">1986</option>
				 <option value="1987">1987</option>
				 <option value="1988">1988</option>
				 <option value="1989">1989</option>
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
				 </select>
				 Certificate<input type="text" name="other_cert2" class="user" style="width: 200px"></p>
				 <p><input type="text" class="userarea_form" name="other_school3" style="width: 230px" placeholder="Name of Body">Year<select name="other_year3" class="user">
				 <option value="Null"></option>
				 <option value="1967">1967</option>
				 <option value="1968">1968</option>
				 <option value="1969">1969</option>
				 <option value="1970">1970</option>
				 <option value="1971">1971</option>
				 <option value="1972">1972</option>
				 <option value="1973">1973</option>
				 <option value="1974">1974</option>
				 <option value="1975">1975</option>
				 <option value="1976">1976</option>
				 <option value="1977">1977</option>
				 <option value="1978">1978</option>
				 <option value="1979">1979</option>
				 <option value="1980">1980</option>
				 <option value="1981">1981</option>
				 <option value="1982">1982</option>
				 <option value="1983">1983</option>
				 <option value="1984">1984</option>
				 <option value="1985">1985</option>
				 <option value="1986">1986</option>
				 <option value="1987">1987</option>
				 <option value="1988">1988</option>
				 <option value="1989">1989</option>
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
				 </select>
				 Certificate<input type="text" name="other_cert3" class="user" style="width: 200px"></p>
				 <p><input type="text" class="userarea_form" name="other_school4" style="width: 230px" placeholder="Name of Body">Year<select name="other_year4" class="user">
				  <option value="Null"></option>
				 <option value="1967">1967</option>
				 <option value="1968">1968</option>
				 <option value="1969">1969</option>
				 <option value="1970">1970</option>
				 <option value="1971">1971</option>
				 <option value="1972">1972</option>
				 <option value="1973">1973</option>
				 <option value="1974">1974</option>
				 <option value="1975">1975</option>
				 <option value="1976">1976</option>
				 <option value="1977">1977</option>
				 <option value="1978">1978</option>
				 <option value="1979">1979</option>
				 <option value="1980">1980</option>
				 <option value="1981">1981</option>
				 <option value="1982">1982</option>
				 <option value="1983">1983</option>
				 <option value="1984">1984</option>
				 <option value="1985">1985</option>
				 <option value="1986">1986</option>
				 <option value="1987">1987</option>
				 <option value="1988">1988</option>
				 <option value="1989">1989</option>
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
				 </select>
				 Certificate<input type="text" name="other_cert4" class="user" style="width: 200px"></p>
				 <p><input type="text" class="userarea_form" name="other_school5" style="width: 230px" placeholder="Name of Body">Year<select name="other_year5" class="user">
				  <option value="Null"></option>
				 <option value="1967">1967</option>
				 <option value="1968">1968</option>
				 <option value="1969">1969</option>
				 <option value="1970">1970</option>
				 <option value="1971">1971</option>
				 <option value="1972">1972</option>
				 <option value="1973">1973</option>
				 <option value="1974">1974</option>
				 <option value="1975">1975</option>
				 <option value="1976">1976</option>
				 <option value="1977">1977</option>
				 <option value="1978">1978</option>
				 <option value="1979">1979</option>
				 <option value="1980">1980</option>
				 <option value="1981">1981</option>
				 <option value="1982">1982</option>
				 <option value="1983">1983</option>
				 <option value="1984">1984</option>
				 <option value="1985">1985</option>
				 <option value="1986">1986</option>
				 <option value="1987">1987</option>
				 <option value="1988">1988</option>
				 <option value="1989">1989</option>
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
				 </select>
				 Certificate<input type="text" name="other_cert5" class="user" style="width: 200px"></p>
				 <h1 style='text-align: center; font-family: arial black; color: #ffffff; text-transform: uppercase; font-size: 18px; text-shadow: -1px -1px 1px #aaa, 0px 4px 1px rgba(0,0,0,0.5), 4px 4px 5px rgba(0,0,0,0.7), 0px 0px 7px rgba(0,0,0,0.4); font-weight: bold'>Discipline and other interests</h1>
				 <div class="dis" style="width: 650px; margin-left: auto; margin-right: auto;">
				 <p>Discipline <input type="text" class="userarea_form" name="dis1" style="width: 230px" placeholder="Discipline">
				 Other Interest<input type="text" name="other_int1" class="user" style="width: 200px"></p>
				 <p>Discipline <input type="text" class="userarea_form" name="dis2" style="width: 230px" placeholder="Discipline">
				 Other Interest<input type="text" name="other_int2" class="user" style="width: 200px"></p>
				 <p>Discipline <input type="text" class="userarea_form" name="dis3" style="width: 230px" placeholder="Discipline">
				 Other Interest<input type="text" name="other_int3" class="user" style="width: 200px"></p>
				 <p>Discipline <input type="text" class="userarea_form" name="dis4" style="width: 230px" placeholder="Discipline">
				 Other Interest<input type="text" name="other_int4" class="user" style="width: 200px"></p>
				 </div>
			     </fieldset><br>
		        <center><input type="submit" value="Change" name="proceed" id="proceed2"></center>
		 </form>
		 </div>
		</div>
		</div> <!– End of Content_Area Div –>
		</div> <!– End of Tabs Div –>
   <!-- end .content --></div>
 <?php
  include_once "../pharmacySection/footer.php";
  ?>
</body>
</html>