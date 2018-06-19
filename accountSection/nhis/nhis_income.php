<?php
session_start();
ob_start();
// error display configuration
error_reporting(E_ALL & ~E_NOTICE);

if(!isset($_SESSION['emaill'])){
	header('location: nhis_form.php');
}
//This block grabs the whole list for viewing
$msg="";
$email= $_SESSION['emaill'];
include "../dbconnect2.php";
$sql="SELECT first_name, id FROM `nhis_form` WHERE `emailAdd`='$email' LIMIT 1";
$check = mysqli_query($dbconnect, $sql);
$resultCount=mysqli_num_rows($check); //count the out amount 
if($resultCount>0){
	while($row=mysqli_fetch_array($check)){
		$id=$row["id"];
		$name=$row["first_name"];
	}
}else{
	$msg="<p style='color: red; text-align: center'>You have no Information yet in the Database</p>";
}

// parse the information into the database
if (isset($_POST['submit'])){
	$hmo = htmlspecialchars($_POST['hmo']);
	$pay_mode = htmlspecialchars($_POST['pay_mode']);
	$amount = htmlspecialchars($_POST['amount']);
	$month = htmlspecialchars($_POST['month']);
	$year = htmlspecialchars($_POST['year']);
	if (empty($hmo && $pay_mode && $amount && $month && $year) == false){
		$date = $year . "-" . $month;
		$insert = "INSERT INTO nhis_income (`hmo`, `pay_mode`, `amount3`, `date`) VALUES ('$hmo', '$pay_mode', '$amount', '$date')";
		$checkStatus = mysqli_query($dbconnect, $insert) or die (mysqli_error($dbconnect));
		$msg = '<p style = "color: #4F8A10; margin-right: auto; margin-right: auto; text-align: center; background-color: #DFF2BF; border-radius:.5em; width: 400px; border: 1px solid #D8D8D8; margin-left: auto; margin-right: auto; padding: 5px; border-radius: 5px; font-family: Arial; font-size: 11px; text-transform: uppercase; text-transform: uppercase">Operation Successful</p>';
	} else
	$msg="<p style='color: #D8000C; background-color: #FFBABA; border-radius:.5em; width: 300px; border: 1px solid #D8D8D8; padding: 5px; border-radius: 5px; margin-left: auto; margin-right: auto; font-family: Arial; font-size: 11px; text-transform: uppercase; text-align: center; text-transform: uppercase'>All fields are required</p>";
}
?>
<!doctype html>
<html>
<link href="http://localhost/buth_net/pharmacySection/css/buth_net.css" rel="stylesheet" type="text/css">
<head>
<meta charset="utf-8">
<link rel="shortcut icon" href="/favicon.ico" >
<title>NHIS Income Page</title>
<script src="js/jquery-1.12.3.min.js" type="text/javascript"></script><script src="../js/jquery-1.12.3.min.js" type="text/javascript"></script>
<script>
$(document).ready(function(){
	$('#cost').mouseenter(function(){
		$('#cost2').slideDown("slow");
		$("#cost2").css("margin-left", "47px");
	});
});
</script>
</head>
<body>
<?php
include_once "../header.php";
?>
<div id="container">
  <div id="sidebar1"><br>
    <p class="subHeader">Menu</p>
    <ul id="navigation2">
	  <li class="page_title">Account Unit</li><br>
	  <li><a href="http://localhost/buth_net/index.php">Main Page</a></li><br>
	  <li><a href="nhis_home.php">Home Page</a></li><br>
	  <li><a href="register.php">Register Enrollee List</a></li><br>
	  <li><a href="nhis_income.php" id="cost">NHIS Income</a></li><br>
	  <li><a href="nhis_incomeSum.php" id="cost2" style="display: none">Inc. Summary</a></li><br>
	  <li><a href="cost_of_treatment.php">Cost of Treatment</a></li><br>
	  <li><a href="../acc_logout.php">Logout</a></li><br>
    </ul>
      <!-- end .sidebar1 --></div>
     <div class="margin" id="content">
		<div class="payment_form2" style="min-height: 250px">
		 <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
		 <div class="form_data">
		 <h3 style='text-align: center; font-family: Calibri (Body); font-size: 22px; font-weight: bold; text-transform: uppercase; font-style: normal; color: #880000; text-shadow: 0 1px 0 #ccc,0 2px 0 #c9c9c9,0 3px 0 #bbb,0 4px 0 #b9b9b9,0 5px 0 #aaa,0 6px 1px rgba(0,0,0,.1),0 0 5px rgba(0,0,0,.1),0 1px 3px rgba(0,0,0,.3),0 3px 5px rgba(0,0,0,.2),0 5px 10px rgba(0,0,0,.25),0 10px 10px rgba(0,0,0,.2),0 20px 20px rgba(0,0,0,.15)'>Enrollee List Form</h3>
		 <?php echo $msg; ?>
		 <table width="450px" style="margin-left: auto; margin-right: auto;" cellpadding="5" cellspacing="0" border="1">
		  <tr>
		   <td width="30%"><label>HMO</label></td>
		   <td width="70%"><input type="text" id="userarea" name="hmo" value="<?=@$hmo?>"></td>
		  </tr>
		   <tr>
		   <td width="30%"><label>Payment Mode</label></td>
		   <td width="70%"><select name="pay_mode" id="userarea" class="being_pay_for">
		   <option value="Null">Select payment mode</option>
		   <option value="transfer">Transfer</option>
		   <option value="cheque">Cheque</option>
		   <option value="free service">Free Service</option>
		   </select></td>
		  </tr>
		  <tr>
		   <td width="30%"><label>Amount N</label></td>
		   <td width="70%"><input type="text" id="userarea" name="amount" value="<?=@$amount?>"></td>
		  </tr>
		  <tr>
		   <td width="30%"><label>Date</label></td>
		   <td width="70%"><label style="font-family: monospace">Month</label><select name="month" id="userarea" class="being_pay_for" style="width: 106px; float: none; margin-left: 4px">
		   <option value="01">January</option>
		   <option value="02">February</option>
		   <option value="03">March</option>
		   <option value="04">April</option>
		   <option value="05">May</option>
		   <option value="06">June</option>
		   <option value="07">July</option>
		   <option value="08">August</option>
		   <option value="09">September</option>
		    <option value="10">October</option>
		   <option value="11">November</option>
		   <option value="12">December</option>
		   </select><label style="float: none; font-family: monospace">Year</label><select name="year" id="userarea" class="being_pay_for" style="width: 106px; float: none; margin-left: 4px">
		   <option value="2010">2010</option>
		   <option value="2011">2011</option>
		   <option value="2012">2012</option>
		   <option value="2013">2013</option>
		   <option value="2014">2014</option>
		   <option value="2015">2015</option>
		   <option value="2016">2016</option>
		   <option value="2017">2017</option>
		   <option value="2018">2018</option>
		   <option value="2019">2019</option>
		   <option value="2020">2020</option>
		   <option value="2021">2021</option>
		   <option value="2022">2022</option>
		   <option value="2023">2023</option>
		   <option value="2024">2024</option>
		   <option value="2025">2025</option>
		   <option value="2026">2026</option>
		   <option value="2027">2027</option>
		   <option value="2028">2028</option>
		   <option value="2029">2029</option>
		   <option value="2030">2030</option>
		   </select></td>
		  </tr>
         </table><br>		  
		    <center><input type="submit" class="submit4"  name="submit" value="Submit"></center>
		</form>
			</div>
		 </div>
		  
		
	   <!-- end .content --></div>
	   
	  <!-- end .container --></div>
     <?php
      include_once "../footer.php";
     ?>
</body>
</html>