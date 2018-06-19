<?php
$msg = "";
include "dbconnect.php";
if (isset($_POST['send']))
{
	
	$emaill = trim($_POST['emaill']);
	if (empty($emaill) == false)
	{
		$sql = "SELECT * FROM `sono` WHERE `eMail`='$emaill'";
		$check = mysqli_query($dbconnect, $sql);
		$result = mysqli_num_rows($check);
		if ($result == 0)
		{
			
			$sql = "INSERT INTO `sono_nextofkin` (`eMail`) VALUES ('$emaill')";
			mysqli_query($dbconnect, $sql);
			$querry = "INSERT INTO `sono_0level_results` (`eMail`) VALUES ('$emaill')";
			mysqli_query($dbconnect, $querry);
			$sql = "INSERT INTO `sono` (`eMail`) VALUES ('$emaill')";
			$query = mysqli_query($dbconnect, $sql) or die (mysqli_error($dbconnect));
			session_start();
			$_SESSION['emaill'] = $emaill;
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
					$from = "BUTH Webpage <admin@buth.edu.ng>";
					$to = $email;
					$subject = "Registration Pin";
					$body .=  "Hello $email \n";
					$body .= "You have requested for your pin, your pin is $Pin.\n"; 
					$body .= "Click <a href='registerform.php?emaill='".$emaill."'>here</a> to continue with your registration \n";
					$body .= "This is an automated email. Please DO NOT reply to it.<br>School of Nursing Bowen University Teaching Hospital, Ogbomoso.";
					$headers = 'From: '.$from."\r\n".
					'X-Mailer: PHP/' . phpversion();
					@mail($to, $subject, $body, $headers);  
					$msg = '<p style = "color: #4F8A10; margin-right: auto; margin-right: auto; text-align: center; background-color: #DFF2BF; border-radius:.5em; width: 400px; border: 1px solid #D8D8D8; margin-left: auto; margin-right: auto; padding: 5px; border-radius: 5px; font-family: Arial; font-size: 11px; text-transform: uppercase; text-transform: uppercase">Your pin has been sent to your mail Click <a href="register.php?emaill='.$email.'">here</a></p>';
					unset($_SESSION['emaill']);
					?><style type="text/css">
					.notice {
						display: none;
					}
					</style><?php
				} 
			} else
			// echo failed message when pin is not sent
			$msg = "<p style='color: #880000; padding-left: 0px'><span class='successbtn'><img src='images/error.png' alt='error' width='22px' height='22px'></span>Error has occured</p>";
		} else
	    $msg = "<p style='color: #880000; padding-left: 0px'><span class='successbtn'><img src='images/error.png' alt='error' width='22px' height='22px'></span>Email address already exit</p>";
	} else
	$msg = "<p style='color: #880000; padding-left: 0px'><span class='successbtn'><img src='images/error.png' alt='error' width='22px' height='22px'></span>Please enter your email</p>";
	
}
?>
<!doctype html>
<html>
<link href="css/buth_net.css" rel="stylesheet" type="text/css">
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
	  <li class="page_title">School Of Nursing</li><br>
	  <li><a href="index.php">Homepage</a></li><br>
	   <li><a href="adminlogin.php">Admin</a></li><br>
      <li><a href="register.php">Register</a></li><br>
      <li><a href="login.php">Login</a></li><br>
    </ul>
	<?php include_once "../new_bar.php"; ?>
    <!-- end .sidebar1 --></div>
     <div class="margin" id="content">
	  <div class="payment_form">
	   <fieldset>
		 <legend>Request Pin</legend>
		  <form action="" method="post">
		  <?php
		  echo $msg;
		  ?>
		    <p style='margin-left: 0px; font-family: Lucida Grande","Lucida Sans Unicode",Tahoma,Sans-Serif; font-weight: bold' class="notice">Please enter your email address. This is where your pin will be sent to</p>
		    <label class="labelEmail"><span class='successbtn'><img src="images/personal.png" alt="email" width="22px" height="22px"></span>Email</label>
		    <p><input type="text" id="email" name="emaill" autofocus></p>
			<input type="submit" value="Continue" name="send" id="send2">
			  </form>
			 </fieldset>
		    </div>
			   <!-- end .content --></div>
			  <!-- end .container --></div>
     <?php
      include_once "footer.php";
     ?>
</body>
</html>