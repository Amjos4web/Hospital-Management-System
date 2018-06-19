<?php
session_start();
ob_start();
if(!isset($_SESSION['emaill'])){
	header('location: cashier_login.php');
}

// error configuration
// error_reporting(E_ALL & ~E_NOTICE);
//This block grabs the whole list for viewing
$msg="";
$email= $_SESSION['emaill'];
include "dbconnect2.php";
$sql = "SELECT * FROM `cashier` WHERE `username_id`='$email' LIMIT 1";
$check = mysqli_query($dbconnect, $sql) or die (mysqli_error($dbconnect));;
$resultCount=mysqli_num_rows($check); //count the out amount 
if($resultCount>0){
	while($row=mysqli_fetch_array($check)){
	$id=$row["id"];
	$password=$row["password"];
	$firstname=$row["first_name"];
	}
}else{
$msg="<p style='color: red; text-align: center'>You have no Information yet in the Database</p>";
}
?>
<!doctype html>
<html>
<link href="http://localhost/buth_net/pharmacySection/css/buth_net.css" rel="stylesheet" type="text/css">
<head>
<meta charset="utf-8">
<link rel="shortcut icon" href="/favicon.ico" >
<title>General Payment</title>
<script src="js/jquery-1.12.3.min.js" type="text/javascript"></script>
<script>
$(document).ready(function(){
    $('.being_pay_for').on('change', function() {
      if ( this.value == 'Others')
      //.....................^.......
      {
        $("#Other2").slideDown();
		$("#td").slideDown();
      }
      else
      {
        $("#Other2").hide();
		$("#td").hide();
      }
    });
});

$(".perOff").keyup(function() {
    $(".perOff").val(this.value.match(/[0-9]*/));
});
</script>
</head>
<body>
<?php
include_once "header.php";
?>
<div id="container">
  <div id="sidebar1"><br>
    <p class="subHeader">Menu</p>
    <ul id="navigation2">
	  <li class="page_title">Account Unit</li><br>
	  <li><a href="http://localhost/buth_net/index.php">Main Page</a></li><br>
	  <li><a href="account.php">Pay By Order</a></li><br>
	  <li><a href="total_earn.php">Income Summary</a></li><br>
      <li><a href="acc_logout.php">Logout</a></li><br>
    </ul>
	<img src="images/money.jpg" width="170px" height="250px" style="margin-left: 15px" alt="Account Session"><br><br>
      <!-- end .sidebar1 --></div>
     <div class="margin" id="content">
		<div class="payment_form2" style="min-height: 350px">
		 <form action="genPay.php" method="post" id="pay2form">
		 <div class="form_data">
		 <h3 style='text-align: center; font-family: Calibri (Body); font-size: 22px; font-weight: bold; text-transform: uppercase; font-style: normal; color: #880000; text-shadow: 0 1px 0 #ccc,0 2px 0 #c9c9c9,0 3px 0 #bbb,0 4px 0 #b9b9b9,0 5px 0 #aaa,0 6px 1px rgba(0,0,0,.1),0 0 5px rgba(0,0,0,.1),0 1px 3px rgba(0,0,0,.3),0 3px 5px rgba(0,0,0,.2),0 5px 10px rgba(0,0,0,.25),0 10px 10px rgba(0,0,0,.2),0 20px 20px rgba(0,0,0,.15)'>General Payment Section </h3>
		 <?php echo $msg; ?>
		 <table width="450px" style="margin-left: auto; margin-right: auto;" cellpadding="5" cellspacing="0" border="1">
		  <tr>
		   <td width="30%"><label>Payed By</label></td>
		   <td width="70%"><input type="text" id="userarea" name="received" style="width: 145px; float: none;">
		   <label style="float: none; font-family: monospace; margin-left: 3px;"></label><select name="discount" id="userarea" class="discount" style="width: 144px; float: none; margin-left: 4px">
		   <option value="Full Payment" select>Full Payment</option>
		   <option value="5% Payment">5% Payment</option>
		   <option value="10% Payment">10% Payment</option>
		   <option value="15% Payment">15% Payment</option>
		   <option value="20% Payment">20% Payment</option>
		   <option value="25% Payment">25% Payment</option>
		   <option value="30% Payment">30% Payment</option>
		   <option value="35% Payment">35% Payment</option>
		   <option value="40% Payment">40% Payment</option>
		   <option value="45% Payment">45% Payment</option>
		   <option value="50% Payment">50% Payment</option>
		   <option value="55% Payment">55% Payment</option>
		   <option value="60% Payment">60% Payment</option>
		   <option value="65% Payment">65% Payment</option>
		   <option value="70% Payment">70% Payment</option>
		   <option value="75% Payment">75% Payment</option>
		   <option value="80% Payment">80% Payment</option>
		   <option value="85% Payment">85% Payment</option>
		   <option value="90% Payment">90% Payment</option>
		   <option value="95% Payment">95% Payment</option>
		   </select></td>
		  </tr>
		  <tr>
		   <td width="30%"><label>Being paid for</label></td>
		   <td width="70%"><select name="being_pay_for" id="userarea" class="being_pay_for">
		   <option value="Others">Being pay for</option>
		   <option value="AC Scrap Sales">AC Scrap Sales</option>
		   <option value="Admission deposit">Admission deposit</option>
		   <option value="Ambulance">Ambulance</option>
		   <option value="Birth Certificate">Birth Certificate</option>
		   <option value="Broken Tile Sales">Broken Tile Sales</option>
		   <option value="Card">Card</option>
		   <option value="Cash Advance">Cash Advance</option>
		   <option value="Clinical Training Fee">Clinical Training Fee</option>
		   <option value="Death Certificate">Death Certificate</option>
		   <option value="Dental">Dental</option>
		   <option value="Dietician Fee">Dietician Fee</option>
		   <option value="Discharged Bill">Discharged Bill</option>
		   <option value="Doctor visit">Doctor's visit</option>
		   <option value="Dressing">Dressing</option>
		   <option value="Drugs DRF">Drugs DRF</option>
		   <option value="Drugs General">Drugs General</option>
		   <option value="Emberment">Emberment</option>
		   <option value="Emergency">Emergency</option>
		   <option value="Employment Form">Employment Form</option>
		   <option value="Ethical Review Comm">Ethical Review Comm</option>
		   <option value="Eye Clinic">Eye Clinic</option>
		   <option value="Family Planning">Family Planning</option>
		   <option value="Fire and Plank Wood Sales">Fire and Plank Wood Sales</option>
		   <option value="Global Fund">Global Fund</option>
		   <option value="Housemanship Form">Housemanship Form</option>
		   <option value="Immunization">Immunization</option>
		   <option value="Keg Sales">Keg Sales</option>
		   <option value="Laparoscopic">Laparoscopic</option>
		   <option value="Lost and Found">Lost and Found</option>
		   <option value="Medical Test">Medical Test</option>
		   <option value="Morgue">Morgue</option>
		   <option value="Observation">Observation</option>
		   <option value="Oxygen Fee">Oxygen Fee</option>
		   <option value="Physiotherapy">Physiotherapy</option>
		   <option value="Prothesis">Prothesis</option>
		   <option value="Special Clinic">Special Clinic</option>
		   <option value="Staff Health Registration Fee">Staff Health Registration Fee</option>
		   <option value="Surgery">Surgery</option>
		   <option value="Surplus">Surplus</option>
		   <option value="Training Fee(College of health)Moro">Training Fee(College of health),Moro</option>
		   <option value="Vip Clinic">Vip Clinic</option>
		   <option value="X-Ray">X-Ray</option>
		   <option value="Others">Others</option>
		   </select></td>
		  </tr>
		   <tr>
		   <td width="30%" style="display: none" id="Other2"><label>Others</label></td>
		   <td width="70%" id="td" style="display: none"><input type="text" id="userarea" name="others" placeholder="Type Others Here"></td>
		  </tr>
		  <tr>
		   <td width="30%"><label>Hospital No</label></td>
		   <td width="70%"><input type="text" id="userarea" name="hosp_no"></td>
		  </tr>
		  <tr>
		   <td width="30%"><label>Amount to pay</label></td>
		   <td width="70%"><input type="text" id="userarea" name="amount_to_pay"></td>
		  </tr>
		  <tr>
		   <td width="30%"><label>Amount collected</label></td>
		   <td width="70%"><input type="text" id="userarea" name="amount_collected"></td>
		  </tr>
         </table><br>		  
		    <center><input type="button" onclick="document.getElementById('pay2form').submit();" class="submit4"  value="Pay & Print receipt"></center>
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