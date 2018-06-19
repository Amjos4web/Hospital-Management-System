<?php
$msg = "";
include "dbconnect.php";
if (isset($_POST['send']))
{
	
	$emaill = trim($_POST['emaill']);
	$tellerno = trim($_POST['tellerno']);
	$acctno = trim($_POST['acct']);
	$dop = trim($_POST['dop']);
	$ap = trim($_POST['ap']);
	$nop = trim($_POST['nop']);
	$bank = trim($_POST['bank']);
	$bacctno = '2016156261';
	$amtp = '7500';
	$bankpt = 'uba';
	if (empty($emaill && $tellerno && $acctno && $dop && $ap && $nop && $bank) == false)
	{
		$sqldetails = "SELECT `teller-no` FROM `sono-bank-details` WHERE `teller-no`='$tellerno' LIMIT 1";
		$checkdetails = mysqli_query($dbconnect, $sqldetails);
		$resultdetails = mysqli_num_rows($checkdetails);
		if ($resultdetails == 0)
		{
			
			if (($acctno == $bacctno) && ($ap == $amtp))
			{
				if ($bank == $bankpt)
				{
					$sqlins = "INSERT INTO `sono-bank-details` (`teller-no`, `name-of-payee`, `date-of-payment`) VALUES ('$tellerno', '$nop', '$dop')";
					$checkins = mysqli_query($dbconnect, $sqlins) or die (mysqli_error($dbconnect));
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
						header ('location: successpayment.php');
						exit();
					} else
					$msg = "<p style='color: #880000; padding-left: 0px'><span class='successbtn'><img src='images/error.png' alt='error' width='22px' height='22px'></span>Email address already exit</p>";
				} else
				?><script>
				alert ('You have paid to the wrong bank');
				</script><?php 
			} else
			$msg = "<p style='color: #880000; padding-left: 0px'><span class='successbtn'><img src='images/error.png' alt='error' width='22px' height='22px'></span>Please enter your correct bank details</p>";
		} else
		$msg = "<p style='color: #880000; padding-left: 0px'><span class='successbtn'><img src='images/error.png' alt='error' width='22px' height='22px'></span>Teller no already exit</p>";
	} else
	$msg = "<p style='color: #880000; padding-left: 0px'><span class='successbtn'><img src='images/error.png' alt='error' width='22px' height='22px'></span>Fields should not be empty</p>";
}
?>

<!DOCTYPE html>
<html lang="en-US">
<head>
  <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="/favicon.ico" >
        <title>SONOBUTH-Registration Page</title>

        

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
<?php include_once("header.php"); ?>
<!-- Nav Menu Section End -->

<!-- Hero Area Section -->

<section id="sign-up-area">

<div class="container">
    <div class="row">
<div class="col-md-12">
        <h1 class="title-big wow fadeIn">Registration Now Opens!</h1>
        <h2 class="subtitle-big">Contact 08035551849 for the PIN@N200</h2>
</div>


<div class="col-md-12 text-center">
<form method="post" role="form" class="sign-up-form" action="">
<div align="center"> <?php echo $msg; ?></div>
  <div class="form-group col-md-offset-4 col-md-4 col-md-offset-4 wow fadeInDown">
   <label class="label label-primary" style=" font-size:1.0em;" >Teller No</label> <input type="text" class="form-control" id="regName" name="surName" placeholder="Enter Your Surname Here" autofocus>
  </div>
  
  <div class="form-group col-md-offset-4 col-md-4 col-md-offset-4 wow fadeInDown" data-wow-delay=".4s">
   <label class="label label-primary"  style=" font-size:1.0em;" >Date of payment</label> <input type="text" class="form-control" id="firstName" name="dop" placeholder="Enter Your Date of payment" autofocus>
  </div>
  
   <div class="form-group col-md-offset-4 col-md-4 col-md-offset-4 wow fadeInDown" data-wow-delay=".7s">
    <label class="label label-primary" style=" font-size:1.0em;" >Name of payer</label> <input type="text" class="form-control" id="otherName" name="nop" placeholder="Enter Name of payer">
    </div>
    
    <div class="form-group col-md-offset-4 col-md-4 col-md-offset-4 wow fadeInDown" data-wow-delay=".7s">
    <label class="label label-primary" style=" font-size:1.0em;" >Amount pay</label> <input type="text" class="form-control" id="pin" name="ap" placeholder="7500" autofocus>
    </div>
    
      <div class="form-group col-md-offset-4 col-md-4 col-md-offset-4 wow fadeInDown" data-wow-delay=".7s">
    <label class="label label-primary" style=" font-size:1.0em;" >Bank</label> 
	<select name="bank" class="form-control">
		<option value=''>Select Bank</option>
		<option value='gtb'>GTB</option>
		<option value='fbn'>First Bank of Nigeria</option>
		<option value='uba'>United Bank of Africa</option>
	</select>
    </div>
    
    <div class="form-group col-md-offset-4 col-md-4 col-md-offset-4 wow fadeInDown" data-wow-delay=".7s"> <label class="label label-primary" style=" font-size:1.0em;" >Account No</label>
    <input type="text" name= "acct" class="form-control" placeholder="">
	</div>
	
	<div class="form-group col-md-offset-4 col-md-4 col-md-offset-4 wow fadeInDown" data-wow-delay=".7s">
    <label class="label label-primary" style=" font-size:1.0em;" >Email</label> <input type="email" class="form-control" name="emaill">
    </div>

    <button class="sign-up-button btn btn-border btn-lg col-md-offset-3 col-md-6 col-md-offset-3 wow fadeInUp" data-wow-delay="1s" name="send" id="submit">Get My Pin</button>
  </div>
</form>
</div>
</div>
</div>
</div>
</section>

<!-- Hero Area Section End-->
<?php include_once("footer.php"); ?>
        <!-- Bootstrap JS -->
        <script src="assets/js/bootstrap.js"></script>
        <!-- WOW JS plugin for animation -->
        <script src="assets/js/wow.js"></script>
        <!-- All JS plugin Triggers -->
        <script src="assets/js/main.js"></script>



    </body>
    </html>