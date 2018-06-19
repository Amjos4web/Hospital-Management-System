<?php
session_start();
ob_start();
//$emaill = $_SESSION['emaill'];

// This block grabs the whole list for viewing
// error display configuration
error_reporting(E_ALL & ~E_NOTICE);
$msg = "";
if (isset($_POST['submitbt'])) {
	$pin = htmlspecialchars(trim($_POST['pin']));
	$surName = htmlspecialchars(trim($_POST['surName']));
	$firstName = htmlspecialchars(trim($_POST['firstName']));
	$otherName = htmlspecialchars(trim($_POST['otherName']));
	$passWord = trim($_POST['passWord']);
	$confirmPass = trim($_POST['confirmPass']);
	$date_added = date('Y.m.d - H:i:s');
	$check = $_POST['check'];
	$year = "2017SET";
	$studentId = 2017001;
	

	if ((empty($pin && $surName && $firstName && $passWord && $confirmPass) == false) && ($passWord) == ($confirmPass))
	{
		include "dbconnect.php";     
		$sql = "SELECT * FROM `sono` WHERE `pin`='$pin'";	 
		$check = mysqli_query($dbconnect, $sql);
		$numrow = mysqli_num_rows($check);
		if ($numrow == 1)
		{
			$rows=mysqli_fetch_assoc($check);
			$Email = $rows['eMail'];
			$agreeterms = $rows['agree'];
			if (($Email == true) && ($agreeterms = "No"))
			{
			
				//echo $agreecolumn; die();
				
					
				$query = "UPDATE `sono` SET `agree`='$check', `surName`='$surName', `firstName`='$firstName', `otherName`='$otherName',  `passWord`='$passWord', `confirmPass`='$confirmPass', `date_added`='$date_added', `year`='$year', `studentid`='$studentId' WHERE `pin`='$pin'";
				$checkquery = mysqli_query($dbconnect, $query);
				$max = "SELECT  MAX(`studentid`) AS student_id FROM `sono`";
				$max2 = mysqli_query($dbconnect, $max);
				$result1 = mysqli_fetch_array($max2);
				$result2 = $result1['student_id'];
				$result3 = $result2+1;
				$sql = "UPDATE `sono` SET `studentid`='$result3' WHERE `pin`='$pin'";	
				$result4 = mysqli_query($dbconnect, $sql);					 
				$qery = "SELECT `id` as idmax FROM `sono`";
				$result = mysqli_query($dbconnect, $qery) or die (mysqli_error($dbconnect));
				$rowa = mysqli_fetch_array($result);
				$rw = $rowa['idmax'];
				$rwo = $rw+1;
				$rwo = str_pad($rwo,4,'0',STR_PAD_LEFT);
				$sql = "UPDATE `sono` SET `id`='$rwo' WHERE `pin`='$pin'";
				$result = mysqli_query($dbconnect, $sql);
				$_SESSION['surName'] = $surName;
				$_SESSION['firstName'] = $firstName;
				$_SESSION['otherName'] = $otherName;
				$_SESSION['passWord'] = $passWord;
				$msg= "<p style = 'color: #4F8A10; background-color: #DFF2BF; border-radius:.5em; width: 400px; border: 1px solid #D8D8D8; padding: 10px; border-radius: 5px; font-family: Arial; font-size: 11px; text-transform: uppercase; text-align: center; text-transform: uppercase; padding-left: 12px'>Registration successful,<a href='passport.php'> >>>Click here to proceed<<<</a></p>";
			} else
			$msg= "<p style = 'color: #D8000C; background-color: #FFBABA; border-radius:.5em; width: 400px; border: 1px solid #D8D8D8; padding: 10px; border-radius: 5px; font-family: Arial; font-size: 11px; text-transform: uppercase; text-align: center; text-transform: uppercase; padding-left: 12px'>The pin has been used</p>";
		} else
		$msg= "<p style = 'color: #D8000C; background-color: #FFBABA; border-radius:.5em; width: 400px; border: 1px solid #D8D8D8; padding: 10px; border-radius: 5px; font-family: Arial; font-size: 11px; text-transform: uppercase; text-align: center; text-transform: uppercase; padding-left: 12px'>The pin enter does not exist</p>";
	} else 
	$msg= "<p style = 'color: #D8000C; background-color: #FFBABA; border-radius:.5em; width: 400px; border: 1px solid #D8D8D8; padding: 10px; border-radius: 5px; font-family: Arial; font-size: 11px; text-transform: uppercase; text-align: center; text-transform: uppercase; padding-left: 12px'>Please enter your names, pin, email and password to start registration</p>";
}

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<link href="http://localhost/buth_net/nursingSchool/css/buth_net.css" rel="stylesheet" type="text/css">
<link rel="shortcut icon" href="/favicon.ico" >
<title>Registration Form</title>
<script src="js/jquery-1.12.3.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    var checker = document.getElementById('checkagree');
    var sendbtn = document.getElementById('submit');
    checker.onchange = function() {
    if (this.checked){
        sendbtn.disabled = false;
		alert ('You have successfully agree to our terms and services. Click OK and press submit button to continue');
    } else {
	    sendbtn.disabled = true;
		
}
}
});
</script>
</head>
<body>
<?php
include_once "header.php";
?>
<div id="container" style="height: 600px;">
  <div id="sidebar1"><br>
    <p class="subHeader">Menu</p>
    <ul id="navigation2">
	  <li class="page_title">School Of Nursing</li><br>
	  <li><a href="index.php">Homepage</a></li><br>
	   <li><a href="adminlogin.php">Admin</a></li><br>
      <li class="current"><a href="register.php">Register</a></li><br>
      <li><a href="login.php">Login</a></li><br>
    </ul>
		 <img src="http://localhost/buth_net/nursingSchool/images/bowen2.jpg" width="170px" height="250px" style="margin-left: 20px" alt="Welcome To School of Nursing"><br><br>
      <!-- end .sidebar1 --></div>
     <div class="margin" id="content">
	 <center><div class='pin_request'>If you do not have pin yet, contact Admin</div></center><br>
	  <div class="instruction">
	   <h2 class="reg">Procedures and Instructions</h2>
	     <p> If you do not have pin or you need assistance, contact the webmaster by  Sending the details of your payment to: webmaster@buth.edu.ng or call(WhatsApp) 08035551849 and you may be charged for late registration<br>
 
 <br>

You will upload a recent passport.<br>
You will need other documents like O'level result, birth certificate, local government identity in JPEG format.
<br>
Note that you cannot change your documents after submission unless you log in.</p>
		  <!--end .instruction --></div>
		<div class="reg_form">
		    <form action="" method="post"> 
			  <div class="form_data">
			 <?php
				 if (isset($_POST['login'])){
					 header ('location: login.php');
				 }
				 
				 if (isset($_POST['reset'])){
					 (empty($_POST) == true);
				 }
				 ?>
			  <table width="410px" style="float: right; margin-right: 10px; height: 330px; background: #CECECE; margin-top: 10px" cellpadding="5" cellspacing="0" border="1">
			  <h3 class="reg">Registration Form</h3>
			   <?php echo $msg; ?>
			  <tr>
			   <td width="30%"><label>Surname</label></td>
			   <td width="70%"><input type="text" class="userarea_reg" name="surName" autofocus></td>
			  </tr>
			  <tr>
			   <td width="30%"><label>First Name</label></td>
			   <td width="70%"><input type="text" class="userarea_reg" name="firstName"></td>
			  </tr>
			  <tr>
			   <td width="30%"><label>Other Names</label></td>
			   <td width="70%"><input type="text" class="userarea_reg" name="otherName"></td>
			  </tr>
			  <tr>
			   <td width="30%"><label>Pin</label></td>
			   <td width="70%"><input type="text" class="userarea_reg" name="pin"></td>
			  </tr>
			  <tr>
			   <td width="30%"><label>Password</label></td>
			   <td width="70%"><input type="password" class="userarea_reg" name="passWord"></td>
			  </tr>
			  <tr>
			   <td width="30%"><label>Confirm Password</label></label></td>
			   <td width="70%"><input type="password" class="userarea_reg" name="confirmPass"></td>
			  </tr>
			  </table>
			  <p style='color: #000000; text-align: center; text-shadow: 0px 0px 0px #000000; font-weight: bold; font-style: italic;'><input type="CheckBox" id="checkagree" name="check" value="yes" /> I agree to the terms and services</p>
			  <center><input type="submit" value="Register" name="submitbt" id="submit" disabled="disabled" style="margin-left: 0px;"></center>
			  </form>
      	    </div>
        </div>		
	   <!-- end .content --></div>
	  <!-- end .container --></div>
     <?php
     include_once "footer.php";
      ?>
 </body>
</html>