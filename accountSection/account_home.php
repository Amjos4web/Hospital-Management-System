<!doctype html>
<html>
<link href="http://localhost/buth_net/pharmacySection/css/buth_net.css" rel="stylesheet" type="text/css">
<head>
<meta charset="utf-8">
<link rel="shortcut icon" href="/favicon.ico" >
<title>Account Homepage</title>
<script src="js/jquery-1.12.3.min.js" type="text/javascript"></script>
</head>
<body>
<?php
include_once "header.php";
?>
<div id="container">
  <div id="sidebar1"><br>
    <p class="subHeader">Menu</p>
    <?php include_once "../accountSection/includes/account_nav.php"; ?>
	<?php include_once "../new_bar.php"; ?>
      <!-- end .sidebar1 --></div>
     <div class="margin" id="content">
	  <marquee behaviour="scroll" direction="left" scrollamount="3" scrolldelay="2"><h1>Today is <?php echo date("l jS \of F Y"); ?>. Welcome To Bowen University Teaching Hospital School Of Nursing Students Portal.</h1></marquee>
	<img src="images/search-engines-all-category-ss-1920.jpg" width="770" height="300px" alt="Welcome To School of Nursing"><br><br>
    <p>Be aware that the CSS for these layouts is heavily commented. If you do most of your work in Design view, have a peek at the code to get tips on working with the CSS for the fixed layouts. You can remove these comments before you launch your site. To learn more about the techniques used in these CSS Layouts, read this article at Adobe's Developer Center - <a href="http://www.adobe.com/go/adc_css_layouts">http://www.adobe.com/go/adc_css_layouts</a>Be aware that the CSS for these layouts is heavily commented. If you do most of your work in Design view, have a peek at the code to get tips on working with the CSS for the fixed layouts. You can remove these comments before you launch your site. To learn more about the techniques used in these CSS Layouts, read this article at Adobe's Developer Center.</p>
  
	   <!-- end .content --></div>
	  <!-- end .container --></div>
     <?php
      include_once "footer.php";
     ?>
</body>
</html>