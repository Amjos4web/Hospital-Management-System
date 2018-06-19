<?php
session_start();
ob_start();
// error display configuration
error_reporting(E_ALL & ~E_NOTICE);

if(!isset($_SESSION['emaill'])){
	header('location: nhis_form.php');
}
//This block grabs the whole list for viewing
$msg="";
$email= $_SESSION['emaill'];
include "../dbconnect2.php";
$sql="SELECT first_name, id FROM `nhis_form` WHERE `emailAdd`='$email' LIMIT 1";
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

// parse the information into the database
if (isset($_POST['submit'])){
	$hmo = htmlspecialchars($_POST['hmo']);
	$enrol_no = htmlspecialchars($_POST['enrol_no']);
	$enrol_name = htmlspecialchars($_POST['enrol_name']);
	$c_name = htmlspecialchars($_POST['c_name']);
	if (empty($hmo && $enrol_name && $enrol_no && $c_name) == false){
		$sql = "SELECT enrol_no FROM nhis_reg WHERE enrol_no='$enrol_no' LIMIT 1;";
		$check = mysqli_query($dbconnect, $sql) or die (mysqli_error($dbconnect));
		$checkCount = mysqli_num_rows($check);
		if ($checkCount == 0){
			$insert = "INSERT INTO nhis_reg (`hmo`, `enrol_no`, `enrol_name`, `c_name`) VALUES ('$hmo', '$enrol_no', '$enrol_name', '$c_name')";
			$checkStatus = mysqli_query($dbconnect, $insert) or die (mysqli_error($dbconnect));
			$msg = '<p style = "color: #4F8A10; margin-right: auto; margin-right: auto; text-align: center; background-color: #DFF2BF; border-radius:.5em; width: 400px; border: 1px solid #D8D8D8; margin-left: auto; margin-right: auto; padding: 5px; border-radius: 5px; font-family: Arial; font-size: 11px; text-transform: uppercase; text-transform: uppercase">Operation Successful</p>';
		} else 
		$msg="<p style='color: #D8000C; background-color: #FFBABA; border-radius:.5em; width: 300px; border: 1px solid #D8D8D8; padding: 5px; border-radius: 5px; margin-left: auto; margin-right: auto; font-family: Arial; font-size: 11px; text-transform: uppercase; text-align: center; text-transform: uppercase'>Enrollee No $enrol_no already exit</p>";
	} else
	$msg="<p style='color: #D8000C; background-color: #FFBABA; border-radius:.5em; width: 300px; border: 1px solid #D8D8D8; padding: 5px; border-radius: 5px; margin-left: auto; margin-right: auto; font-family: Arial; font-size: 11px; text-transform: uppercase; text-align: center; text-transform: uppercase'>All fields are required</p>";
}
?>
<!doctype html>
<html>
<link href="http://localhost/buth_net/pharmacySection/css/buth_net.css" rel="stylesheet" type="text/css">
<head>
<meta charset="utf-8">
<link rel="shortcut icon" href="/favicon.ico" >
<title>Enrollee List</title>
<script src="js/jquery-1.12.3.min.js" type="text/javascript"></script>
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
	  <li><a href="nhis_home.php">Home Page</a></li><br>
	  <li><a href="register.php">Register Enrollee List</a></li><br>
	  <li><a href="nhis_income.php">NHIS Income</a></li><br>
	  <li><a href="cost_of_treatment.php">Cost of Treatment</a></li><br>
	  <li><a href="../acc_logout.php">Logout</a></li><br>
    </ul>
      <!-- end .sidebar1 --></div>
     <div class="margin" id="content">
		<div class="payment_form2" style="min-height: 250px">
		 <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
		 <div class="form_data">
		 <h3 style='text-align: center; font-family: Calibri (Body); font-size: 22px; font-weight: bold; text-transform: uppercase; font-style: normal; color: #880000; text-shadow: 0 1px 0 #ccc,0 2px 0 #c9c9c9,0 3px 0 #bbb,0 4px 0 #b9b9b9,0 5px 0 #aaa,0 6px 1px rgba(0,0,0,.1),0 0 5px rgba(0,0,0,.1),0 1px 3px rgba(0,0,0,.3),0 3px 5px rgba(0,0,0,.2),0 5px 10px rgba(0,0,0,.25),0 10px 10px rgba(0,0,0,.2),0 20px 20px rgba(0,0,0,.15)'>Enrollee List Form</h3>
		 <?php echo $msg; ?>
		 <table width="450px" style="margin-left: auto; margin-right: auto;" cellpadding="5" cellspacing="0" border="1">
		  <tr>
		   <td width="30%"><label>HMO</label></td>
		   <td width="70%"><input type="text" id="userarea" name="hmo" value="<?=@$hmo?>"></td>
		  </tr>
		   <tr>
		   <td width="30%"><label>Enrollee No</label></td>
		   <td width="70%"><input type="text" id="userarea" name="enrol_no" value="<?=@$enrol_no?>"></td>
		  </tr>
		  <tr>
		   <td width="30%"><label>Enrollee Name</label></td>
		   <td width="70%"><input type="text" id="userarea" name="enrol_name" value="<?=@$enrol_name?>"></td>
		  </tr>
		  <tr>
		   <td width="30%"><label>Company Name</label></td>
		   <td width="70%"><input type="text" id="userarea" name="c_name" value="<?=@$c_name?>"></td>
		  </tr>
         </table><br>		  
		    <center><input type="submit" class="submit4"  name="submit" value="Submit"></center>
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