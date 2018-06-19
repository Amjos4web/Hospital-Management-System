<?php 
session_start();
ob_start();
if(!isset($_SESSION['emaill'])){
	header('location: login.php');
}
//This block grabs the whole list for viewing
$msg="";
$emaill= $_SESSION['emaill'];
include "dbconnect.php";
$sql="SELECT * FROM `som` WHERE `eMail`='$emaill' LIMIT 1";
$check = mysqli_query($dbconnect, $sql);
$resultCount=mysqli_num_rows($check); //count the out amount 
if($resultCount>0){
	while($row=mysqli_fetch_array($check)){
	$email=$row["eMail"];
	$studentID=$row["studentid"];
	$surname=$row["surName"];
	$otherNames=$row["otherName"];
	}
}else{
$msg="<p style='color: #D8000C; background-color: #FFBABA; border-radius:.5em; width: 300px; border: 1px solid #D8D8D8; padding: 5px; border-radius: 5px; margin-left: auto; margin-right: auto; font-family: Arial; font-size: 11px; text-transform: uppercase; text-align: center; text-transform: uppercase'>You have no Information yet in the Database</p>";
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
	
	if (empty($school1 && $schoolStart1 && $schoolStop1) == false)
	{
		if ((strlen($_POST['school1']) < 70) && (strlen($_POST['school2']) < 70) && (strlen($_POST['school3']) < 70) && (strlen($_POST['school4']) < 70))
		{
		$sql = "UPDATE `som_nextofkin` SET `school1`='$school1', `from1`='$schoolStart1', `to1`='$schoolStop1', `school2`='$school2', `from2`='$schoolStart2', `to2`='$schoolStop2', `school3`='$school3', `from3`='$schoolStart3', `to3`='$schoolStop3', `school4`='$school4', `from4`='$schoolStart4', `to4`='$schoolStop4' WHERE `eMail`='$email'";
		$query = mysqli_query($dbconnect, $sql);
        header ('location: results.php');		
		} else 
		$msg = "<p style='color: #D8000C; background-color: #FFBABA; border-radius:.5em; width: 300px; border: 1px solid #D8D8D8; padding: 5px; border-radius: 5px; margin-left: auto; margin-right: auto; font-family: Arial; font-size: 11px; text-transform: uppercase; text-align: center; text-transform: uppercase'>School name should not be greater than 30 chars</p>";
	    } else
		$msg = "<p style='color: #D8000C; background-color: #FFBABA; border-radius:.5em; width: 300px; border: 1px solid #D8D8D8; padding: 5px; border-radius: 5px; margin-left: auto; margin-right: auto; font-family: Arial; font-size: 11px; text-transform: uppercase; text-align: center; text-transform: uppercase'>Please fill in at least one field</p>";	
}
if (isset($_POST['back'])){
	header ('location: form2.php');
}
?>
<!DOCTYPE html>
<html>
<link href="http://localhost/buth_net/nursingSchool/css/buth_net.css" rel="stylesheet" type="text/css">
<head>
<meta charset="utf-8">
<link rel="shortcut icon" href="/favicon.ico" >
<script src="js/jquery.js" type="text/javascript"></script>
<script src="js/jqueryy.js" type="text/javascript"></script>
<title>Education/School of Midwifery</title>
</head>
<body>
<?php
include_once "header.php";
?>
<div id="container">
  <div id="sidebar1"><br>
    <p class="subHeader">Menu</p>
   <ul id="navigation2">
	  <li class="page_title">School of Midwifery</li><br>
	  <li><a href="index.php">Homepage</a></li><br>
      <li><a href="register.php">Register</a></li><br>
      <li><a href="login.php">Login</a></li><br>
    </ul>
	<img src="images/bowen5.jpg" width="170px" height="250px" style="margin-left: 20px" alt="Welcome To School of Midwifery"><br><br>
	 <?php include_once "../new_bar.php"; ?>
	 
    <!-- end .sidebar1 --></div>
  <div class="margin" id="content">
    <div id="Tabs">
	 <ul>
		<li id="li_tab1" class="current_tab"><a href="form1.php">BIO-DATA</a></li>
		<li id="li_tab2"><a href="form2.php">NEXT OF KIN & SPONSOR</a></li>
		<li id="li_tab3"><a href="education.php">EDUCATION BACKGROUND</a></li>
		<li id="li_tab4"><a href="results.php">O'LEVEL RESULTS</a></li>
	  </ul><br><br><br>
		<div id="Content_Area">
		 <div class="bio_data">
		  <fieldset>
		    <legend>EDUCATION BACKGROUND</legend>
			<?php
			echo $msg;
			?>
			  <div class="form_btn">
			   <form action="" method="post">
			     <h1 style='text-align: center; font-family: arial black; color: #ffffff; text-transform: uppercase; font-size: 24px; text-shadow: -1px -1px 1px #aaa, 0px 4px 1px rgba(0,0,0,0.5), 4px 4px 5px rgba(0,0,0,0.7), 0px 0px 7px rgba(0,0,0,0.4); font-weight: bold'>School Attended with years</h1>
				 <p><input type="text" class="userarea_form" name="school1">From<select name="schoolStart1" class="user">
				 <option value="null"></option>
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
				 <option value="null"></option>
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
				 <p><input type="text" class="userarea_form" name="school2">From<select name="schoolStart2" class="user">
				 <option value="null"></option>
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
				 <option value="null"></option>
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
				 </select></p>
				 <p><input type="text" class="userarea_form" name="school3">From<select name="schoolStart3" class="user">
				 <option value="null"></option>
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
				 <option value="null"></option>
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
				 </select></p>
				 <p><input type="text" class="userarea_form" name="school4">From<select name="schoolStart4" class="user">
				 <option value="null"></option>
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
				 <option value="null"></option>
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
				 </select></p>
			 </fieldset><br>
			  <div class="btns">
		        <input type="submit" value="<<< BACK" name="back" id="back1">
		        <input type="submit" value="PROCEED >>>" name="proceed" id="proceed2">
			  </div>
		 </form>
		 </div>
		</div>
		</div> <!– End of Content_Area Div –>
		</div> <!– End of Tabs Div –>
	 </div>
   <!-- end .content --></div>
 <?php
  include_once "footer.php";
  ?>
</body>
</html>