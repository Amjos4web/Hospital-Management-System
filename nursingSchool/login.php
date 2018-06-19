<?php
// error display configuration
error_reporting(E_ALL & ~E_NOTICE);
$msg = "";
if (isset($_POST['login'])){
	include "dbconnect.php";
	$passWord = $_POST['passWord'];
	$emaill = $_POST['emaill'];
	if (empty($emaill && $passWord) == false){
		$sql = "SELECT * FROM `sono` WHERE `eMail`='$emaill' && `passWord`='$passWord'";
		$check = mysqli_query($dbconnect, $sql) or die (mysqli_error($dbconnect));
		$result = mysqli_num_rows($check);
		if ($result > 0){
			while($row=mysqli_fetch_array($check)){
				$year=$row["year"];
			}
			if ($year == "000L"){
				session_start();
				$_SESSION['emaill'] = $emaill;
				header ('location: home.php');
			} else if ($year == "100L"){
				session_start();
				$_SESSION['emaill'] = $emaill;
				header ('location: home001.php');
			} else if ($year == "200L"){
				session_start();
				$_SESSION['emaill'] = $emaill;
				header ('location: home002.php');
			} else if ($year == "300L"){
				session_start();
				$_SESSION['emaill'] = $emaill;
				header ('location: home003.php');
			} 
			
		} else
		$msg = "<h5 style='color:#fff; padding-left: 0px'><span class='successbtn'><img src='assets/img/features/error.png' alt='error' width='22px' height='22px'></span>Error: Invalid Password or Email Address</h5>";
	} else
	$msg = "<p style='color: #880000; padding-left: 0px'><span class='successbtn'><img src='images/error.png' alt='error' width='22px' height='22px'></span>Please enter your email and password to login</p>";
}
?>
   
   
    <!DOCTYPE html>
    <html lang="en">
      <head>
        <meta charset="utf-8">
        	<meta name="description" content="" >
    <meta name="keywords" content="BUTH, BUTHO, School Of Nursing Ogbomoso, Bowen University,Teaching Hospital, Health Care, Study Nursing, Nursing Profession, Nursing Career, Nursing Council and Midwifery, Nursing in Nigeria">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="/favicon.ico" >
              <title>SONOBUTH Login Portal</title>
         

        <!-- Bootstrap -->
        <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
        
        <!-- Main Style -->
        <link rel="stylesheet" type="text/css" href="assets/css/main.css">

        <!-- Responsive Style -->
        <link rel="stylesheet" type="text/css" href="assets/css/responsive.css">

        <!--Icon Font-->
        <link rel="stylesheet" media="screen" href="assets/fonts/font-awesome/font-awesome.min.css" />


        <!-- Extras -->
        <link rel="stylesheet" type="text/css" href="assets/extras/animate.css">


        <!-- jQuery Load -->
        <script src="assets/js/jquery-min.js"></script>
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

      </head>

    <body>
    <!-- Nav Menu Section -->
   <?php include_once ("header.php");?>
<!-- Nav Menu Section End -->

<!-- Hero Area Section -->

<section id="sign-in-area">

<div class="container">
    <div class="row">
<div class="col-md-12">
        <h1 class="title-big wow fadeIn"><i class="fa fa-sign-in"></i></h1>
        <h2 class="subtitle-big">Sign-in to access your information</h2>
</div>


<div class="col-md-12 text-center">

<form action="" method="post" role="form" class="sign-in-form">
<?php
		   echo $msg;
		  ?>
  <div class="form-group col-md-offset-4 col-md-4 col-md-offset-4 wow fadeInDown">
    <input type="email" class="form-control" id="email" name="emaill" autofocus placeholder="Enter email">
  </div>
  <div class="form-group col-md-offset-4 col-md-4 col-md-offset-4 wow fadeInDown" data-wow-delay=".7s">
    <input type="password" class="form-control" id="passkey" name="passWord"placeholder="Password">

    <input type="submit" value="Login" name="login" id="login22" class="sign-up-button btn btn-border btn-lg col-md-offset-3 col-md-6 col-md-offset-3 wow fadeInUp" data-wow-delay="1s"> 
      </div>
</form>
</div>
</div>
</div>
</div>
</section>

<!-- Hero Area Section End-->
<?php include_once ("footer.php");?>


        <!-- Bootstrap JS -->
        <script src="assets/js/bootstrap.js"></script>
        <!-- WOW JS plugin for animation -->
        <script src="assets/js/wow.js"></script>
        <!-- All JS plugin Triggers -->
        <script src="assets/js/main.js"></script>



    </body>
    </html>