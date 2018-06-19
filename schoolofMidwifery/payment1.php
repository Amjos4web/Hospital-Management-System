<?php
$msg = "";
if (isset($_POST['send']))
{
	
	$emaill = trim($_POST['emaill']);
	if (empty($emaill) == false)
	{
		$sql = "SELECT * FROM `som` WHERE `eMail`='$emaill'";
		$check = mysqli_query($dbconnect, $sql);
		$result = mysqli_num_rows($check);
		if ($result == 0)
		{
			include_once "dbconnect.php";
			$sql = "INSERT INTO `som_nextofkin` (`eMail`) VALUES ('$emaill')";
			mysqli_query($dbconnect, $sql);
			$querry = "INSERT INTO `som_0level_results` (`eMail`) VALUES ('$emaill')";
			mysqli_query($dbconnect, $querry);
			$sql = "INSERT INTO `som` (`eMail`) VALUES ('$emaill')";
			$query = mysqli_query($dbconnect, $sql) or die (mysqli_error($dbconnect));
			session_start();
			$_SESSION['emaill'] = $emaill;
			header ('location: successpayment.php');
			exit();
		}
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
	  <li class="page_title">School of Midwifery</li><br>
	  <li><a href="index.php">Homepage</a></li><br>
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
		    <p style='margin-left: 0px; font-family: Lucida Grande","Lucida Sans Unicode",Tahoma,Sans-Serif; font-weight: bold'>Please enter your email address. This is where your pin will be sent to</p>
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