<?php
session_start();
ob_start();
include "dbconnect.php";
$successmsg4 = "";
$successmsg2 = "";
$successmsg3 = "";
$successmsg1 = "";
$successmsg5 = "";
$failedmsg = "";
$emaill = $_SESSION['emaill'];
// generate pin for this email
for ($index = 0; $index < 1; $index++){
	 $rand = mt_rand(1000000000, (int)9999999999);
	 $pin = $rand;
	 // check whether pin already exits
	 // if already exits
	 $sql = "SELECT pin FROM sono WHERE pin='$pin'";
	 $check = mysqli_query($dbconnect, $sql);
	 $result = mysqli_num_rows($check);
	 if ($result > 0){
		 $index -= 1;
	// if pin does not not exits	
	} elseif (mysqli_num_rows($check) == 0) {
		// insert the generated pin into the database
		$sql = "UPDATE sono SET pin = '$pin' WHERE eMail='$emaill'";
		$query = mysqli_query($dbconnect, $sql) or die (mysqli_error($dbconnect)); 
	}
}
// get the information of this email
$sql2="SELECT * FROM sono WHERE pin='$pin' && eMail='$emaill'";
$check2 = mysqli_query($dbconnect, $sql2);
$resultCount=mysqli_num_rows($check2); //count the out amount 
if($resultCount>0){
	while($row=mysqli_fetch_array($check2))
	{
		$Pin=$row["pin"];
		$email=$row["eMail"];
		// send mail when through
		$to = $emaill;
		$subject = "Registration Pin";
		$body =  "Hello $email, <br>You have requested for your pin, your pin is $Pin. <br>This is an automated email. Please DO NOT reply to it.<br>School of Nursing.<br>Bowen University Teaching Hospital, Ogbomoso.";
		mail($to,$subject,$body, 'From: schoolofNursing@buth.org.ng');
		// assuming the payment has been made successfully
	
		// echo success message when payment is successfull
		$successmsg1 .= "<p style='text-align: center; font-family: arial black; color: #ffffff; font-size: 24px; text-shadow: -1px -1px 1px #aaa, 0px 4px 1px rgba(0,0,0,0.5), 4px 4px 5px rgba(0,0,0,0.7), 0px 0px 7px rgba(0,0,0,0.4); font-weight: bold; padding-top: 15px'>CONGRATULATIONS</p>"; 
		$successmsg2 .= $email; 
		$successmsg4 .= "<p style='text-align: center; font-family: Tahoma; color: #880000; font-weight: bold; font-size: 14px; padding-top: 10px'>You have successfully paid for your pin Your pin for registration is</p>"; 
		$successmsg3 .= $Pin; 
		$successmsg5 .= "<p style='text-align: center; font-family: arial; font-size: 12px; font-weight: bold'>Click <a href='register.php'>here</a> to continue with your registration</p>";
	} 
	} else { 
		// echo failed message when payment is not successfull
		$failedmsg = "<p>Registration Pin Payment Request failed....</p>";
	}
?>
<!doctype html>
<html>
<link href="http://localhost/buth_net/nursingSchool/css/buth_net.css" rel="stylesheet" type="text/css">
<head>
<meta charset="utf-8">
<link rel="shortcut icon" href="/favicon.ico" >
<title>Registration Pin Request</title>
</head>
<body>
<?php
include_once "header.php";
?>
<div id="container">
  <div id="sidebar1"><br>
    <p class="subHeader">Menu</p>
    <ul id="navigation2">
	  <li class="page_title">School of Nursing</li><br>
	  <li><a href="index.php">Homepage</a></li><br>
	   <li><a href="adminlogin.php">Admin</a></li><br>
      <li><a href="register.php">Register</a></li><br>
      <li><a href="login.php">Login</a></li><br>

    </ul>
	<?php include_once "../new_bar.php"; ?>
    <!-- end .sidebar1 --></div>
  <div class="margin" id="content">
   <div class = "successpage">
     <center><span class="successmsg1"><?php echo $successmsg1; ?></span></center>
	 <center><span class="successmsg2"><?php echo $successmsg2; ?></span></center>
	 <center><span class="successmsg4"><?php echo $successmsg4; ?></span></center>
	 <center><span class="successmsg3"><?php echo $successmsg3; ?></span></center>
	 <center><span class="successmsg5"><?php echo $successmsg5; ?></span></center>
	 <center><span class="failedmsg"><?php echo $failedmsg; ?></span></center>
   </div>
   <!-- end .content --></div>
   <!-- end .container --></div>
  <?php
  include_once "footer.php";
  ?>
 </body>
</html>
  