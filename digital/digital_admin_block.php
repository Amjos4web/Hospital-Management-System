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
include "../pharmacySection/dbconnect2.php";
$sql="SELECT fname, id FROM `digital_admin` WHERE `admin_email`='$email' LIMIT 1";
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
if (isset($_POST['submit']))
{
	$ticket = $_POST['ticket'];
	$qty = htmlspecialchars($_POST['qty']);
	$price = htmlspecialchars($_POST['price']);
	$date = date('Y-m-d H:i:s');

	if (empty($ticket && $qty && $price) === false){
		if ($ticket == "1hr" || $ticket == "2hrs" || $ticket == "7days"){
			$select = "SELECT * FROM tickets WHERE ticket='".$ticket."' LIMIT 1";
			$checkticket = mysqli_query($dbconnect, $select) or die (mysqli_error($dbconnect));
			$ticketresult = mysqli_num_rows($checkticket);
			if ($ticketresult > 0){
				while($row=mysqli_fetch_array($checkticket)){
					$qty2 = $row["quantity"];
					$updateqty = $qty + $qty2;
					
					$update = "UPDATE tickets SET `quantity`='$updateqty', `price`='$price', `date`='$date' WHERE `ticket`='$ticket' LIMIT 1";
					$check3 = mysqli_query($dbconnect, $update) or die (mysqli_error($dbconnect));
					$msg = '<p style = "color: #4F8A10; margin-right: auto; margin-right: auto; text-align: center; background-color: #DFF2BF; border-radius:.5em; width: 400px; border: 1px solid #D8D8D8; margin-left: auto; margin-right: auto; padding: 5px; border-radius: 5px; font-family: Arial; font-size: 11px; text-transform: uppercase; text-transform: uppercase">Operation Successful</p>';
					header ("refresh:3; url=digital_admin_block.php"); // wait for 3 secs before redirect
				}
				
			} else if ($ticketresult == 0){
				$ticket = htmlspecialchars($_POST['ticket']);
				$insert = "INSERT INTO tickets (ticket, quantity, price, date) VALUES ('$ticket', '$qty', '$price', '$date')";
				$check3 = mysqli_query($dbconnect, $insert) or die (mysqli_error($dbconnect));
				$msg = '<p style = "color: #4F8A10; margin-right: auto; margin-right: auto; text-align: center; background-color: #DFF2BF; border-radius:.5em; width: 400px; border: 1px solid #D8D8D8; margin-left: auto; margin-right: auto; padding: 5px; border-radius: 5px; font-family: Arial; font-size: 11px; text-transform: uppercase; text-transform: uppercase">Operation Successful</p>';
				header ("refresh:3; url=digital_admin_block.php"); // wait for 3 secs before redirect
			}
		} else {
			$msg = "<p style='color: #D8000C; background-color: #FFBABA; border-radius:.5em; width: 300px; border: 1px solid #D8D8D8; padding: 5px; border-radius: 5px; margin-left: auto; margin-right: auto; font-family: Arial; font-size: 11px; text-transform: uppercase; text-align: center;'>Ticket format should be 1hr or 2hrs</p>";
		}
	} else {
		$msg = "<p style='color: #D8000C; background-color: #FFBABA; border-radius:.5em; width: 300px; border: 1px solid #D8D8D8; padding: 5px; border-radius: 5px; margin-left: auto; margin-right: auto; font-family: Arial; font-size: 11px; text-transform: uppercase; text-align: center; text-transform: uppercase'>Please fill in the required fields</p>";
	}
}

?>
<!doctype html>
<html>
<link href="http://10.40.255.5/buth_net/pharmacySection/css/buth_net.css" rel="stylesheet" type="text/css">
<head>
<meta charset="utf-8">
<link rel="shortcut icon" href="/favicon.ico" >
<title>Buth Digital Center</title>
<script src="../pharmacySection/js/jquery-1.12.3.min.js" type="text/javascript"></script>
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
	  <li><a href="index.php">Homepage</a></li><br>
	  <li><a href="admin_report.php">Today's Report</a></li><br>
	  <li><a href="monthly_income.php">Monthly Income</a></li><br>
	  <li><a href="yearly_income.php">Yearly Income</a></li><br>
	  <li><a href="enquiryForms.php">Issues</a></li><br>
	  <li><a href="logout.php">Logout</a></li><br>
    </ul>
      <!-- end .sidebar1 --></div>
     <div class="margin" id="content">
	 <h1 style='text-align: center; font-family: tahoma; font-size: 16px; text-transform: uppercase; font-weight: bold; background-color: #000000; color: #CECECE'>Welcome <?php echo $name."!" . " "; ?>What would you like to do today?</h1>
		<div class="product_form2" style="min-height: 100px;">
		 <form action="" method="post" enctype="multipart/form-data">
		 <div class="form"><br>
		 <h3 style='color: brown; font-size: 22px; font-style: normal; text-align: center; font-family: monospace; text-transform: uppercase;'>ict/digital center<h3>
		  <label style="float: right; margin-right: 25px; margin-top: -15px;"><?php echo "Tickets Avail: " . " " . "1hour" . " " . "[" .$onehour. "]" . " " .  "2hours" . " " . "[" .$twohour. "]" . " " . "7days" . " " . "[" .$oneweek. "]"; ?></label><br>
		 <?php echo $msg; ?>
		  <table width="450px" style="margin-left: auto; margin-right: auto; min-height: 100px;" cellpadding="5" cellspacing="0" border="1">
			 <tr>
			   <td width="30%"><label>Ticket</label></td>
			   <td width="70%"><select id="userarea" name="ticket">
			   <option value="1hr">1hr</option>
			   <option value="2hrs">2hrs</option>
			   <option value="7days">7days</option>
			   </select></td>
			  </tr>
			  <tr>
			   <td width="30%"><label>Quantity</label></td>
			   <td width="70%"><input type="text" id="userarea" name="qty" value= "<?=@$qty?>"></td>
			  </tr>
			  <tr>
			   <td width="30%"><label>Price N</label></td>
			   <td width="70%"><input type="text" id="userarea"  name="price" value= "<?=@$price?>"></td>
			  </tr>
			</table><br>	
		   <center><input type="submit" value="Proceed" name="submit" class="submit4"></center>
		   </form>
		  </div>
	</div>
			   <!-- end .content --></div>
			  <!-- end .container --></div>
     <?php
      include_once "../pharmacySection/footer.php";
     ?>
</body>
</html>