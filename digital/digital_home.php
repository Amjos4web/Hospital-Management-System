<?php 
session_start();
ob_start();
// error display configuration
//error_reporting(E_ALL & ~E_NOTICE);

if(!isset($_SESSION['emaill'])){
	header('location: ../index.php');
}
//This block grabs the whole list for viewing
$msg="";
$email= $_SESSION['emaill'];
include "../dbconnect.php";
$sql="SELECT fname, id FROM `digital_user` WHERE `user_email`='$email' LIMIT 1";
$check = mysqli_query($dbconnect, $sql);
$resultCount=mysqli_num_rows($check); //count the out amount 
if($resultCount>0){
	while($row=mysqli_fetch_array($check)){
	$id=$row["id"];
	$name=$row["fname"];
	}
}else{
$msg="<p style='color: red; text-align: center'>You have not logged in yet</p>";
}



// get available tickets 1 hour
$onehour = "1hr";
$selectticket1 = "SELECT * FROM tickets WHERE `ticket`='".$onehour."'";
$checkt = mysqli_query($dbconnect, $selectticket1) or die (mysqli_error($dbconnect));
$resultCountt=mysqli_num_rows($checkt); //count the out amount 
if($resultCountt >0 ){
	while($row=mysqli_fetch_array($checkt)){
		$onehour=$row["quantity"];
		$p1=$row["price"];
	}
} else {
	$onehour = "0";
}

// get available ticket for 2 hours
$twohour = "2hrs";
$selectticket2 = "SELECT * FROM tickets WHERE `ticket`='".$twohour."'";
$checkt2 = mysqli_query($dbconnect, $selectticket2) or die (mysqli_error($dbconnect));
$resultCountt2=mysqli_num_rows($checkt2); //count the out amount 
if($resultCountt2 >0 ){
	while($row=mysqli_fetch_array($checkt2)){
		$twohour=$row["quantity"];
		$p2=$row["price"];
	}
} else {
	$twohour = "0";
}

// get available ticket for 7 days
$oneweek = "7days";
$selectticket2 = "SELECT * FROM tickets WHERE `ticket`='".$oneweek."'";
$checkt2 = mysqli_query($dbconnect, $selectticket2) or die (mysqli_error($dbconnect));
$resultCountt2=mysqli_num_rows($checkt2); //count the out amount 
if($resultCountt2 >0 ){
	while($row=mysqli_fetch_array($checkt2)){
		$oneweek=$row["quantity"];
		$p3=$row["price"];
	}
} else {
	$oneweek = "0";
}
// parse the form data and add the inventory to the system
$date = date('Y-m-d H:i:s');
$month = date('F');
if (isset($_POST['submit']))
{
	$cname = htmlspecialchars($_POST['cname']);
	if ($cname == ""){
		$cname = "Customer";
	} else if ($cname !== "") {
		$cname = htmlspecialchars($_POST['cname']);
	}
	$service = htmlspecialchars(trim($_POST['service']));
	$hrn = htmlspecialchars(trim($_POST['hrn']));
	$price1 = $_POST['price1'];
	$price2 = $_POST['price2'];
	$price3 = $_POST['price3'];
	$charge = htmlspecialchars($_POST['charge']);
	$amount_c = htmlspecialchars($_POST['amount_c']);
	$pc1 = $p1 * $price1;
	$pc2 = $p2 * $price2;
	$pc3 = $p3 * $price3;
	$p1update = $onehour - $price1;
	$p2update = $twohour - $price2;
	$p3update = $oneweek - $price3;
	$change = $amount_c - $charge;
	$interchange1 = $amount_c - $pc1;
	$interchange2 = $amount_c - $pc2;
	

	if (empty($service && $amount_c) == false){
		if ($_POST['service'] == "printing"){
			$printing = "printing";
			$sql3 = "INSERT INTO ticket_report (cname, date, services, onehr, twohr, oneweek, amt_collected, charges, printing, staff_name, hospital_rec_no) VALUES ('$cname', '$date', '$service', '$pc1', '$pc2', '$pc3', '$amount_c', '$charge', '$printing', '$name', '$hrn')";
			$check3 = mysqli_query($dbconnect, $sql3) or die (mysqli_error($dbconnect));
			?><script type="text/javascript">
				swal("Success!", "Operation Successful!", "success");
			</script><?php
			//$msg = '<p style = "color: #4F8A10; margin-right: auto; margin-right: auto; text-align: center; background-color: #DFF2BF; border-radius:.5em; width: 400px; border: 1px solid #D8D8D8; margin-left: auto; margin-right: auto; padding: 5px; border-radius: 5px; font-family: Arial; font-size: 11px; text-transform: uppercase; text-transform: uppercase">Operation Successful.. Customers change is N'.$change.'</p>';
			//header ("refresh:4; url=digital_home.php"); // wait for 3 secs before redirect
		} else if ($_POST['service'] == "scanning"){
			$scanning = "scanning";
			$sql3 = "INSERT INTO ticket_report (cname, date, services, onehr, twohr, oneweek, amt_collected, charges, scanning, staff_name, hospital_rec_no) VALUES ('$cname', '$date', '$service', '$pc1', '$pc2', '$pc3', '$amount_c', '$charge', '$scanning', '$name', '$hrn')";
			$check3 = mysqli_query($dbconnect, $sql3) or die (mysqli_error($dbconnect));
			$msg = '<p style = "color: #4F8A10; margin-right: auto; margin-right: auto; text-align: center; background-color: #DFF2BF; border-radius:.5em; width: 400px; border: 1px solid #D8D8D8; margin-left: auto; margin-right: auto; padding: 5px; border-radius: 5px; font-family: Arial; font-size: 11px; text-transform: uppercase; text-transform: uppercase">Operation Successful.. Customers change is N'.$change.'</p>';
			header ("refresh:4; url=digital_home.php"); // wait for 3 secs before redirect
		} else if ($_POST['service'] == "training"){
			$training = "training";
			$sql3 = "INSERT INTO ticket_report (cname, date, services, onehr, twohr, oneweek, amt_collected, charges, training, staff_name, hospital_rec_no) VALUES ('$cname', '$date', '$service', '$pc1', '$pc2', '$pc3', '$amount_c', '$charge', '$training', '$name', '$hrn')";
			$check3 = mysqli_query($dbconnect, $sql3) or die (mysqli_error($dbconnect));
			$msg = '<p style = "color: #4F8A10; margin-right: auto; margin-right: auto; text-align: center; background-color: #DFF2BF; border-radius:.5em; width: 400px; border: 1px solid #D8D8D8; margin-left: auto; margin-right: auto; padding: 5px; border-radius: 5px; font-family: Arial; font-size: 11px; text-transform: uppercase; text-transform: uppercase">Operation Successful.. Customers change is N'.$change.'</p>';
			header ("refresh:4; url=digital_home.php"); // wait for 3 secs before redirect
		}else if ($_POST['price1'] == "Null" AND $_POST['price2'] == "Null" AND $_POST['price3'] == "Null"){
			$sql3 = "INSERT INTO ticket_report (cname, date, services, onehr, twohr, oneweek, amt_collected, charges, staff_name, hospital_rec_no) VALUES ('$cname', '$date', '$service', '$pc1', '$pc2', '$pc3', '$amount_c', '$charge', '$name', '$hrn')";
			$check3 = mysqli_query($dbconnect, $sql3) or die (mysqli_error($dbconnect));
			$msg = '<p style = "color: #4F8A10; margin-right: auto; margin-right: auto; text-align: center; background-color: #DFF2BF; border-radius:.5em; width: 400px; border: 1px solid #D8D8D8; margin-left: auto; margin-right: auto; padding: 5px; border-radius: 5px; font-family: Arial; font-size: 11px; text-transform: uppercase; text-transform: uppercase">Operation Successful.. Customers change is N'.$interchange1.'</p>';
			header ("refresh:4; url=digital_home.php"); // wait for 3 secs before redirect
		} else if ($_POST['price1'] != "Null" AND $_POST['price2'] == "Null" AND $_POST['price3'] == "Null"){
			$sql3 = "INSERT INTO ticket_report (cname, date, services, onehr, twohr, oneweek, amt_collected, charges, staff_name, hospital_rec_no) VALUES ('$cname', '$date', '$service', '$pc1', '$pc2', '$pc3', '$amount_c', '$charge', '$name', '$hrn')";
			$check3 = mysqli_query($dbconnect, $sql3) or die (mysqli_error($dbconnect));
			$update = "UPDATE tickets SET `quantity`='".$p1update."' WHERE `price`='".$p1."'";
			$check4 = mysqli_query($dbconnect, $update) or die (mysqli_error($dbconnect));
			$msg = '<p style = "color: #4F8A10; margin-right: auto; margin-right: auto; text-align: center; background-color: #DFF2BF; border-radius:.5em; width: 400px; border: 1px solid #D8D8D8; margin-left: auto; margin-right: auto; padding: 5px; border-radius: 5px; font-family: Arial; font-size: 11px; text-transform: uppercase; text-transform: uppercase">Operation Successful.. Customers change is N'.$interchange1.'</p>';
			header ("refresh:4; url=digital_home.php"); // wait for 3 secs before redirect
		} else if ($_POST['price1'] == "Null" AND $_POST['price2'] != "Null" AND $_POST['price3'] == "Null"){
			$sql3 = "INSERT INTO ticket_report (cname, date, services, onehr, twohr, oneweek, amt_collected, charges, staff_name, hospital_rec_no) VALUES ('$cname', '$date', '$service', '$pc1', '$pc2', '$pc3', '$amount_c', '$charge', '$name', '$hrn')";
			$check3 = mysqli_query($dbconnect, $sql3) or die (mysqli_error($dbconnect));
			$update = "UPDATE tickets SET `quantity`='".$p2update."' WHERE `price`='".$p2."'";
			$check4 = mysqli_query($dbconnect, $update) or die (mysqli_error($dbconnect));
			$msg = '<p style = "color: #4F8A10; margin-right: auto; margin-right: auto; text-align: center; background-color: #DFF2BF; border-radius:.5em; width: 400px; border: 1px solid #D8D8D8; margin-left: auto; margin-right: auto; padding: 5px; border-radius: 5px; font-family: Arial; font-size: 11px; text-transform: uppercase; text-transform: uppercase">Operation Successful.. Customers change is N'.$interchange2.'</p>';
			header ("refresh:4; url=digital_home.php"); // wait for 3 secs before redirect
		} else if ($_POST['price1'] == "Null" AND $_POST['price2'] == "Null" AND $_POST['price3'] != "Null"){
			$sql3 = "INSERT INTO ticket_report (cname, date, services, onehr, twohr, oneweek, amt_collected, charges, staff_name, hospital_rec_no) VALUES ('$cname', '$date', '$service', '$pc1', '$pc2', '$pc3', '$amount_c', '$charge', '$name', '$hrn')";
			$check3 = mysqli_query($dbconnect, $sql3) or die (mysqli_error($dbconnect));
			$update = "UPDATE tickets SET `quantity`='".$p3update."' WHERE `price`='".$p3."'";
			$check4 = mysqli_query($dbconnect, $update) or die (mysqli_error($dbconnect));
			$msg = '<p style = "color: #4F8A10; margin-right: auto; margin-right: auto; text-align: center; background-color: #DFF2BF; border-radius:.5em; width: 400px; border: 1px solid #D8D8D8; margin-left: auto; margin-right: auto; padding: 5px; border-radius: 5px; font-family: Arial; font-size: 11px; text-transform: uppercase; text-transform: uppercase">Operation Successful.. Customers change is N'.$interchange2.'</p>';
			header ("refresh:4; url=digital_home.php"); // wait for 3 secs before redirect
		} else if ($_POST['price1'] != "Null" AND $_POST['price2'] != "Null" AND $_POST['price3'] != "Null"){
			$sql3 = "INSERT INTO ticket_report (cname, date, services, onehr, twohr, oneweek, amt_collected, charges, staff_name, hospital_rec_no) VALUES ('$cname', '$date', '$service', '$pc1', '$pc2', '$pc3', '$amount_c', '$charge', '$name', '$hrn')";
			$check3 = mysqli_query($dbconnect, $sql3) or die (mysqli_error($dbconnect));
			$update = "UPDATE tickets SET `quantity`='".$p1update."' AND `quantity`='".$p2update."' AND `quantity`='".$p3update."'  WHERE `price`='".$p1."' AND `price`='".$p2."' AND `price`='".$p3."'";
			$check4 = mysqli_query($dbconnect, $update) or die (mysqli_error($dbconnect));
			$msg = '<p style = "color: #4F8A10; margin-right: auto; margin-right: auto; text-align: center; background-color: #DFF2BF; border-radius:.5em; width: 400px; border: 1px solid #D8D8D8; margin-left: auto; margin-right: auto; padding: 5px; border-radius: 5px; font-family: Arial; font-size: 11px; text-transform: uppercase; text-transform: uppercase">Operation Successful</p>';
			header ("refresh:4; url=digital_home.php"); // wait for 3 secs before redirect
		} else {
			$pc1 = "0";
			$pc2 = "0";
			$pc3 = "0";
			$sql3 = "INSERT INTO ticket_report (cname, date, services, onehr, twohr, oneweek, amt_collected, charges, staff_name, hospital_rec_no) VALUES ('$cname', '$date', '$service', '$pc1', '$pc2', '$pc3', '$amount_c', '$charge', '$name', '$hrn')";
			$check3 = mysqli_query($dbconnect, $sql3) or die (mysqli_error($dbconnect));
			$msg = '<p style = "color: #4F8A10; margin-right: auto; margin-right: auto; text-align: center; background-color: #DFF2BF; border-radius:.5em; width: 400px; border: 1px solid #D8D8D8; margin-left: auto; margin-right: auto; padding: 5px; border-radius: 5px; font-family: Arial; font-size: 11px; text-transform: uppercase; text-transform: uppercase">Operation Successful.. Your change is N'.$change.'</p>';
			header ("refresh:4; url=digital_home.php"); // wait for 3 secs before redirect
		}
	} else {
		$msg = "<p style='color: #D8000C; background-color: #FFBABA; border-radius:.5em; width: 300px; border: 1px solid #D8D8D8; padding: 5px; border-radius: 5px; margin-left: auto; margin-right: auto; font-family: Arial; font-size: 11px; text-transform: uppercase; text-align: center; text-transform: uppercase'>Please fill in the required fields</p>";
	}
}

?>
<!doctype html>
<html>
<link href="http://localhost/buth_net/pharmacySection/css/buth_net.css" rel="stylesheet" type="text/css">
<link href="http://localhost/buth_net/pharmacySection/css/sweet-alert.css" rel="stylesheet" type="text/css">
<head>
<meta charset="utf-8">
<link rel="shortcut icon" href="/favicon.ico" >
<title>Buth Digital Center</title>
<script src="../pharmacySection/js/jquery-1.12.3.min.js" type="text/javascript"></script>

<script>
$(document).ready(function(){
    $('.service').on('change', function() {
      if ( this.value == 'internet')
      //.....................^.......
      {
        $("#internet").slideDown();
		$("#internet2").slideDown();
		$("#internett").slideDown();
		$("#internett2").slideDown();
		$("#internettt").slideDown();
		$("#internettt2").slideDown();
		$(".charge").hide();
		$(".charge2").hide();
      }
      else
      {
        $("#internet").hide();
		$("#internet2").hide();
		$("#internett").hide();
		$("#internett2").hide();
		$("#internettt").hide();
		$("#internettt2").hide();
		$(".charge").show();
		$(".charge2").show();
      }
    });
});
</script>
</head>
<body>
<?php
include_once "../pharmacySection/header.php";
?>
<div id="container">
  <div id="sidebar1"><br>
    <p class="subHeader">Menu</p>
    <ul id="navigation2">
	  <li class="page_title">Digital Center</li><br>
	  <li><a href="digital_home.php">Homepage</a></li><br>
	  <li><a href="reports.php">Today's Report</a></li><br>
	  <li><a href="logout.php">Logout</a></li><br>
    </ul>
	<?php include_once($_SERVER['DOCUMENT_ROOT'].'../buth_net/new_bar.php'); ?>
      <!-- end .sidebar1 --></div>
     <div class="margin" id="content">
	 <h1 style='text-align: center; font-family: tahoma; font-size: 16px; text-transform: uppercase; font-weight: bold; background-color: #000000; color: #CECECE'>Welcome <?php echo $name."!" . " "; ?>What would you like to do today?</h1>
		<div class="product_form2" style="min-height: 100px;">
		 <form action="" method="post" enctype="multipart/form-data">
		 <div class="form"><br>
		 <h3 style='color: brown; font-size: 22px; font-style: normal; text-align: center; font-family: monospace'>Customer Report Form For Digital Center<h3>
		 <label style="float: right; margin-right: 25px; margin-top: -15px;"><?php echo "Tickets Avail: " . " " . "1hour" . " " . "[" .$onehour. "]" . " " .  "2hours" . " " . "[" .$twohour. "]" . " " . "7days" . " " . "[" .$oneweek. "]"; ?></label><br>
		  <?php echo $msg; ?>
		  <table width="450px" style="margin-left: auto; margin-right: auto; min-height: 100px;" cellpadding="5" cellspacing="0" border="1">
			 <tr>
			   <td width="30%"><label>Date</label></td>
			   <td width="70%"><input type="text" id="userarea" name="date" disabled="disabled" value= "<?php echo $date; ?>"></td>
			  </tr>
			  <tr>
			   <td width="30%"><label>Name</label></td>
			   <td width="70%"><input type="text" id="userarea" name="cname" value= "<?=@$cname?>"></td>
			  </tr>
			  <tr>
			   <td width="30%"><label>Service Rendered</label></td>
			   <td width="70%"><select name="service" id="userarea" class="service">
				   <option value="printing">Printing</option>
				   <option value="scanning">Scanning</option>
				   <option value="internet">Internet</option>
				   <option value="training">Training</option>
			   </select></td>
			  </tr>
			  <tr>
			   <td width="30%" style="display: none;" id="internet"><label>Tickets</label></td>
			   <td width="70%" style="display: none;" id="internet2"><label style="font-family: monospace">1Hour</label><input name="onehour" id="userarea" class="being_pay_for" disabled="" value="<?=@"N".$p1?>" style="width: 90px; float: none; margin-left: 11px">
			   <label style="float: none; font-family: monospace; margin-left: 3px;">Qty</label><select name="price1" id="userarea" class="being_pay_for"  style="width: 90px; float: none; margin-left: 4px">
			   <option value="Null">Select Qty</option>
			   <option value="1">1</option>
			   <option value="2">2</option>
			   <option value="3">3</option>
			   <option value="4">4</option>
			   <option value="5">5</option>
			   </select></td>
		  </tr>
		  <tr>
			   <td width="30%" style="display: none;" id="internett"><label>Tickets</label></td>
			   <td width="70%" style="display: none;" id="internett2"><label style="font-family: monospace">2Hours</label><input name="twohour" id="userarea" class="being_pay_for" disabled="" value="<?=@"N".$p2?>" style="width: 90px; float: none; margin-left: 4px">
			   <label style="float: none; font-family: monospace; margin-left: 3px;">Qty</label><select name="price2" id="userarea" class="being_pay_for"  style="width: 90px; float: none; margin-left: 4px">
			   <option value="Null">Select Qty</option>
			   <option value="1">1</option>
			   <option value="2">2</option>
			   <option value="3">3</option>
			   <option value="4">4</option>
			   <option value="5">5</option>
			   </select></td>
		  </tr>
		  <tr>
			   <td width="30%" style="display: none;" id="internettt"><label>Tickets</label></td>
			   <td width="70%" style="display: none;" id="internettt2"><label style="font-family: monospace">7days</label><input name="oneweek" id="userarea" class="being_pay_for" disabled="" value="<?=@"N".$p3?>" style="width: 90px; float: none; margin-left: 11px">
			   <label style="float: none; font-family: monospace; margin-left: 3px;">Qty</label><select name="price3" id="userarea" class="being_pay_for"  style="width: 90px; float: none; margin-left: 4px">
			   <option value="Null">Select Qty</option>
			   <option value="1">1</option>
			   <option value="2">2</option>
			   <option value="3">3</option>
			   <option value="4">4</option>
			   <option value="5">5</option>
			   </select></td>
		  </tr>
			  <tr>
			   <td width="30%" class="charge2"><label>Charges N</label></td>
			   <td width="70%" class="charge"><input type="text" id="userarea"  name="charge" value= "<?=@$charge?>"></td>
			  </tr>
			   <tr>
			   <td width="30%"><label>Amount Collected</label></td>
			   <td width="70%"><input type="text" id="userarea" name="amount_c" value= "<?=@$amount_c?>"></td>
			  </tr>
			  <tr>
			   <td width="30%"><label>Hos. Receipt No</label></td>
			   <td width="70%"><input type="text" id="userarea" name="hrn" value= "<?=@$hrn?>"></td>
			  </tr>
			</table><br>	
		   <center><input type="submit" value="Process" name="submit" class="submit4"></center>
		   </form>
		  </div>
	</div>
			   <!-- end .content --></div>
			  <!-- end .container --></div>
     <?php
      include_once "../pharmacySection/footer.php";
     ?>
	 <script src="../js/sweet-alert.js" type="text/javascript"></script>
</body>
</html>