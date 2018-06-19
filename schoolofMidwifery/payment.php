<!doctype html>
<html>
<link href="http://localhost/buth_net/nursingSchool/css/buth_net.css" rel="stylesheet" type="text/css">
<head>
<meta charset="utf-8">
<link rel="shortcut icon" href="/favicon.ico" >
<title>BUTH Intranet School of Nursing</title>
</head>
<body>
<?php
include_once "header.php";
?>
<div id="container">
  <div id="sidebar1"><br>
    <p class="subHeader">Menu</p>
    <ul id="navigation">
	  <li><a href="index.php">Homepage</a></li>
      <li class="current"><a href="register.php">Register</a></li>
      <li><a href="login.php">Login</a></li>
      <li><a href="#">School News</a></li>
      <li><a href="#">About School</a></li>
    </ul>
	 <p class="subHeader">Lastest News</p>
	  <marquee behaviour="scroll" direction="up" scrollamount="2" scrolldelay="2">
	   <ul class="news">
	     <li>2016/2017 Registration form is out...</li><br>
		 <li>School fees is to paid before June 2016...</li><br>
		 <li>Examination commences on 12th of March...</li><br>
		 <li>Registration will close very soon...</li><br>
		 <li>Applicatants should be ready for entrance exams...</li>
		</ul>
	   </marquee>
    <!-- end .sidebar1 --></div>
  <div class="margin" id="content">
	   <h1 style='text-align: center; font-family: tahoma; text-transform: uppercase; color: green'>Registration Pin Request</h1>	
	<div class="product">

      <div class="image">
        <img src="http://www.phpgang.com/wp-content/uploads/gang.jpg" />
    </div>
    <div class="name">
      <p>Registration Pin Request Payment</p>
    </div>
    <div class="Pin_request_fee">
       <p style='font-weight: bold; font-size: 14px'>Payment Fee: N200</p>
    </div>
		<div class="btn">
		<form action="successpayment.php" method="POST">
		  <script
			src="https://checkout.stripe.com/checkout.js" class="stripe-button"
			data-key="pk_test_D6yCzgRfJXziQIM25fCrTrq0" // your publishable keys
			data-image="localhost/buth_net/nursingSchool/images/welcome.jpg" // your company Logo
			data-name="BUTH School Of Nursing"
			data-description="Get Registration Pin (N2.00)"
			data-amount="200">
		  </script>
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