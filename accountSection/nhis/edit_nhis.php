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



// edit item for payment
if (isset($_GET['enrol_no'])){
	$enrol_no = $_GET['enrol_no'];
	// get the block for payment listing
	$sql2 = "SELECT * FROM `nhis_reg` WHERE `enrol_no`='$enrol_no' LIMIT 1";
	$check2 = mysqli_query($dbconnect, $sql2) or die (mysqli_error($dbconnect));
	$resultCount2=mysqli_num_rows($check2); //count the out amount 
	if($resultCount2>0){
		while($row2=mysqli_fetch_array($check2)){
			$enrol_name=$row2["enrol_name"];
			$c_name=$row2["c_name"];
			$hmo=$row2["hmo"];
		}
	}else{
		$msg="<p style='color: red; text-align: center'>Sorry! Error has occurred. Please try again</p>";
	}
}

// parse the form data and add the inventory to the system
 if (isset($_POST['makeChange'])){
		$hmo2 = htmlspecialchars($_POST['hmo']);
		$enrol_no2 = htmlspecialchars($_POST['enrol_no']);
		$enrol_name2 = htmlspecialchars($_POST['enrol_name']);
		$c_name2 = htmlspecialchars($_POST['c_name']);
		
	 

		$sql3 = "UPDATE `nhis_reg` SET `hmo`='$hmo2', `enrol_name`='$enrol_name2', `enrol_no`='$enrol_no2', `c_name`='$c_name2' WHERE `enrol_no`='$enrol_no'";
		$check3 = mysqli_query($dbconnect, $sql3) or die (mysqli_error($dbconnect));
		$msg = '<p style = "color: #4F8A10; margin-right: auto; margin-right: auto; text-align: center; background-color: #DFF2BF; border-radius:.5em; width: 400px; border: 1px solid #D8D8D8; margin-left: auto; margin-right: auto; padding: 5px; border-radius: 5px; font-family: Arial; font-size: 11px; text-transform: uppercase; text-transform: uppercase">Operation Successful...</p>';
		header ("refresh:3; url=nhis_home.php"); // wait for 3 secs before redirect
}

?>
<!doctype html>
<html>
<link href="http://localhost/buth_net/pharmacySection/css/buth_net.css" rel="stylesheet" type="text/css">
<head>
<meta charset="utf-8">
<link rel="shortcut icon" href="/favicon.ico" >
 <title><?php echo $enrol_no; ?></title>
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
	  <li><a href="nhis_home.php">Home Page</a></li><br>
	  <li><a href="register.php">Register Enrollee List</a></li><br>
	  <li><a href="nhis_income.php">NHIS Income</a></li><br>
	  <li><a href="nhis_incomeSum.php">Cost of Treatment</a></li><br>
	  <li><a href="../acc_logout.php">Logout</a></li><br>
    </ul>
	<?php include_once($_SERVER['DOCUMENT_ROOT'].'../buth_net/new_bar.php'); ?>
      <!-- end .sidebar1 --></div>
     <div class="margin" id="content">
	  <div class="product_lists">
	    </div><br>
		<div class="product_form2" style="min-height: 250px">
		 <form action="" method="post" enctype="multipart/form-data">
		 <div class="form_data">
		 <h3 style='color: brown; font-size: 22px; font-style: normal; text-align: center; font-family: monospace'>Edit Account|<?php echo $enrol_no; ?><h3>
		 <?php
		 echo $msg;
		 ?>
		  <table width="450px" style="margin-left: auto; margin-right: auto;" cellpadding="5" cellspacing="0" border="1">
			 <tr>
			   <td width="30%"><label>HMO</label></td>
			   <td width="70%"><input type="text" id="userarea" name="hmo" value= "<?php echo $hmo; ?>"></td>
			  </tr>
			  <tr>
			   <td width="30%"><label>Enrollee No</label></td>
			   <td width="70%"><input type="text" id="userarea" name="enrol_no" value= "<?php echo $enrol_no; ?>"></td>
			  </tr>
			  <tr>
			   <td width="30%"><label>Enrollee Name</label></td>
			   <td width="70%"><input type="text" id="userarea" name="enrol_name" value= "<?php echo $enrol_name; ?>"></td>
			  </tr>
			  <tr>
			   <td width="30%"><label>Company Name</label></td>
			   <td width="70%"><input type="text" id="userarea" name="c_name" value= "<?php echo $c_name; ?>"></td>
			  </tr>
			 </table><br>	
		   <center><input type="submit" value="Make Changes" class="submit4" name="makeChange"></center>
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