<?php
if (isset($_POST['register'])){
	header('location: register.php');
}
if (isset($_POST['login'])){
	header('location: login.php');
}
?>
<!doctype html>
<html>
<link href="http://localhost/buth_net/nursingSchool/css/buth_net.css" rel="stylesheet" type="text/css">
<head>
<meta charset="utf-8">
<link rel="shortcut icon" href="/favicon.ico" >
<title>BUTH Intranet School of Midwifery</title>
</head>
<body>
<?php
include_once "header.php";
?>
<div id="container">
  <div id="sidebar1"><br>
    <p class="subHeader">Menu</p>
    <ul id="navigation2">
	  <li class="page_title">School Of Midwifery</li><br>
	  <li><a href="http://localhost/buth_net/index.php">Mainpage</a></li><br>
      <li><a href="register.php">Register</a></li><br>
      <li><a href="login.php">Login</a></li><br>
    </ul>
	 <img src="images/bowen3.jpg" width="170px" height="250px" style="margin-left: 20px" alt="Welcome To School of Midwifery"><br><br>
	<?php include_once "../new_bar.php"; ?>
    <!-- end .sidebar1 --></div>
  <div class="margin" id="content">
    <marquee behaviour="scroll" direction="left" scrollamount="3" scrolldelay="2"><h1>Today is <?php echo date("l jS \of F Y"); ?>. Welcome To Bowen University Teaching Hospital School of Midwifery Students Portal.</h1></marquee>
	<img src="images/welcome.jpg" width="770px" height="300px" alt="Welcome To School of Nursing"><br><br>
    <p>Be aware that the CSS for these layouts is heavily commented. If you do most of your work in Design view, have a peek at the code to get tips on working with the CSS for the fixed layouts. You can remove these comments before you launch your site. To learn more about the techniques used in these CSS Layouts, read this article at Adobe's Developer Center - <a href="http://www.adobe.com/go/adc_css_layouts">http://www.adobe.com/go/adc_css_layouts</a>Be aware that the CSS for these layouts is heavily commented. If you do most of your work in Design view, have a peek at the code to get tips on working with the CSS for the fixed layouts. You can remove these comments before you launch your site. To learn more about the techniques used in these CSS Layouts, read this article at Adobe's Developer Center.
	Be aware that the CSS for these layouts is heavily commented. If you do most of your work in Design view, have a peek at the code to get tips on working with the CSS for the fixed layouts. You can remove these comments before you launch your site. To learn more about the techniques used in these CSS Layouts, read this article at Adobe's Developer Center - <a href="http://www.adobe.com/go/adc_css_layouts">http://www.adobe.com/go/adc_css_layouts</a>Be aware that the CSS for these layouts is heavily commented. If you do most of your work in Design view, have a peek at the code to get tips on working with the CSS for the fixed layouts. You can remove these comments before you launch your site. To learn more about the techniques used in these CSS Layouts, read this article at Adobe's Developer Center.</p>
    <a href="payment1.php"><h1 class="pin">Click here to get your pin for registration</a></h1>
	
      <form action="" method="post">
	  <center><input type="submit" value="Register" name="register" id="regg">
	  <input type="submit" value="Login" name="login" id="forgotpass2"></center>
	  </form>
    <!-- end .content --></div>
  <!-- end .container --></div>
 <?php
  include_once "footer.php";
  ?>
</body>
</html>
