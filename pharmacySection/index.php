<!doctype html>
<html>
<link href="http://localhost/buth_net/pharmacySection/css/buth_net.css" rel="stylesheet" type="text/css">
<head>
<meta charset="utf-8">
<link rel="shortcut icon" href="/favicon.ico" >
<title>BUTH Intranet Pharmacy</title>
</head>
<body>
<?php
include_once "header.php";
?>
<div id="container">
  <div id="sidebar1"><br>
    <p class="subHeader">Menu</p>
    <ul id="navigation2">
	  <li class="page_title">Pharmacy Unit</li><br>
	  <li><a href="http://localhost/buth_net/index.php">Mainpage</a></li><br>
      <li><a href="admin_login.php">Admin Login</a></li><br>
	  <li><a href="pharmacy_store.php">Pharmacy Store</a></li><br>
      <li><a href="copd_login.php">COPD Login</a></li><br>
	  <li><a href="mopd_login.php">MOPD Login</a></li><br>
	  <li><a href="ipd_login.php">IPD Login</a></li><br>
	  <li><a href="ae_pharm_login.php">A and E Login</a></li><br>
      <li><a href="pead_pharm_login.php">MCH login</a></li><br>
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
    <marquee behaviour="scroll" direction="left" scrollamount="3" scrolldelay="2"><h1>Today is <?php echo date("l jS \of F Y"); ?>. Welcome To Pharmacy Unit.</h1></marquee>
	<img src="images/drugs-206150_1280.jpg" width="770" height="300px" alt="Welcome To School of Nursing"><br><br>
    <p>Be aware that the CSS for these layouts is heavily commented. If you do most of your work in Design view, have a peek at the code to get tips on working with the CSS for the fixed layouts. You can remove these comments before you launch your site. To learn more about the techniques used in these CSS Layouts, read this article at Adobe's Developer Center - <a href="http://www.adobe.com/go/adc_css_layouts">http://www.adobe.com/go/adc_css_layouts</a>Be aware that the CSS for these layouts is heavily commented. If you do most of your work in Design view, have a peek at the code to get tips on working with the CSS for the fixed layouts. You can remove these comments before you launch your site. To learn more about the techniques used in these CSS Layouts, read this article at Adobe's Developer Center.</p>
  
    <!-- end .content --></div>
  <!-- end .container --></div>
 <?php
  include_once "footer.php";
  ?>
</body>
</html>
