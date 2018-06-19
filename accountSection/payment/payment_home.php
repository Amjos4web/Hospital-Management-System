<?php 
session_start();
ob_start();
// error display configuration
error_reporting(E_ALL & ~E_NOTICE);

if(!isset($_SESSION['emaill'])){
	header('location: payment_login.php');
}
//This block grabs the whole list for viewing
$msg="";
$email= $_SESSION['emaill'];
include "../dbconnect2.php";
$sql="SELECT first_name, id FROM `payment_login` WHERE `emailAdd`='$email' LIMIT 1";
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


$payment_search_results = "";
$msg2 = "";
// see if the posted search query field is set and has a value
if (isset($_GET['searchbtn2'])){
	
	if (isset($_GET['search2']) && $_GET['search2'] != ""){
		// filter the inputs
		$search = $_GET['search2'];
		
		$sqlcommand2 = "SELECT `id`,`payee_name`, `date`,`pur`, `pur2`, `pur3`, `code`, `bank_name`, `acct_no`,`remark`,`received_by`,`date_received`, `comment`, `reference_no`, `amount`, `amount2`, `amount3`,`date_submitted` FROM `payment_form` WHERE `reference_no`='$search' LIMIT 1";
		$query = mysqli_query($dbconnect, $sqlcommand2) or die (mysqli_error($dbconnect));
		$count = mysqli_num_rows($query);
		if ($count > 0){
			while($row2=mysqli_fetch_assoc($query)){
				$payment_id = ["id"];
				$payee_name=$row2["payee_name"];
				$date=$row2["date"];
				$pur=$row2["pur"];
				$pur2=$row2["pur2"];
				$pur3=$row2["pur3"];
				$code=$row2["code"];
				$bank_name=$row2["bank_name"];
				$acct_no=$row2["acct_no"];
				$reference_no=$row2["reference_no"];
				$amount=$row2["amount"];
				$amount2=$row2["amount2"];
				$amount3=$row2["amount3"];
				$remark=$row2["remark"];
				$comment=$row2["comment"];
				$received_by=$row2["received_by"];
				$date_received=$row2["date_received"];
				
				
				
				$payment_search_results .= "<h2 style='margin-left: 0px; margin-top: 35px; font-family: Calibri (Body); font-size: 22px; font-weight: bold; text-transform: uppercase; font-style: normal; color: #880000; text-shadow: 0 1px 0 #ccc,0 2px 0 #c9c9c9,0 3px 0 #bbb,0 4px 0 #b9b9b9,0 5px 0 #aaa,0 6px 1px rgba(0,0,0,.1),0 0 5px rgba(0,0,0,.1),0 1px 3px rgba(0,0,0,.3),0 3px 5px rgba(0,0,0,.2),0 5px 10px rgba(0,0,0,.25),0 10px 10px rgba(0,0,0,.2),0 20px 20px rgba(0,0,0,.15)'>Payment Information for $reference_no</h2>";
				$payment_search_results .= '<table width="735px" style="margin-left: auto; margin-right: auto; min-height: 500px" cellpadding="6" cellspacing="0" border="0">';
				$payment_search_results .= "<tr>";
				$payment_search_results .= "<td style='background-color:#C5DFFA; width: 30%; font-family: Adobe Heiti Std R; padding-left: 20px; font-size: 18px'><b>Reference Number</b></td>";
				$payment_search_results .= "<td style='background-color:#C5DFFA; width: 70%; font-family: Adobe Heiti Std R; padding-left: 20px; font-size: 18px'><b>".$reference_no."</b></td>";
				$payment_search_results .= "</tr>";
				$payment_search_results .= "<tr>";
				$payment_search_results .= "<td style='background-color:#C5DFFA; width: 30%; font-family: Adobe Heiti Std R; padding-left: 20px;  font-size: 18px'><b>Payee Name</b></td>";
				$payment_search_results .= "<td style='background-color:#C5DFFA; width: 70%; font-family: Adobe Heiti Std R; padding-left: 20px; font-size: 18px'><b>".$payee_name."</b></td>";
				$payment_search_results .= "</tr>";
				$payment_search_results .= "<tr>";
				$payment_search_results .= "<td style='background-color:#C5DFFA; width: 30%; font-family: Adobe Heiti Std R; padding-left: 20px;  font-size: 18px'><b>Date</b></td>";
				$payment_search_results .= "<td style='background-color:#C5DFFA; width: 70%; font-family: Adobe Heiti Std R; padding-left: 20px; font-size: 18px'><b>".$date."</b></td>";
				$payment_search_results .= "</tr>";
				$payment_search_results .= "<tr>";
				$payment_search_results .= "<td style='background-color:#C5DFFA; width: 30%; font-family: Adobe Heiti Std R; padding-left: 20px; font-size: 18px'><b>Purpose 1</b></td>";
				$payment_search_results .= "<td style='background-color:#C5DFFA; width: 70%; font-family: Adobe Heiti Std R; padding-left: 20px; font-size: 18px'><b>".$pur."</b></td>";
				$payment_search_results .= "</tr>";
				$payment_search_results .= "<tr>";
				$payment_search_results .= "<td style='background-color:#C5DFFA; width: 30%; font-family: Adobe Heiti Std R; padding-left: 20px;  font-size: 18px'><b>Purpose 2</b></td>";
				$payment_search_results .= "<td style='background-color:#C5DFFA; width: 70%; font-family: Adobe Heiti Std R; padding-left: 20px; font-size: 18px'><b>".$pur2."</b></td>";
				$payment_search_results .= "</tr>";
				$payment_search_results .= "<tr>";
				$payment_search_results .= "<td style='background-color:#C5DFFA; width: 30%; font-family: Adobe Heiti Std R; padding-left: 20px;  font-size: 18px'><b>Purpose 3</b></td>";
				$payment_search_results .= "<td style='background-color:#C5DFFA; width: 70%; font-family: Adobe Heiti Std R; padding-left: 20px; font-size: 18px'><b>".$pur3."</b></td>";
				$payment_search_results .= "</tr>";
				$payment_search_results .= "<tr>";
				$payment_search_results .= "<td style='background-color:#C5DFFA; width: 30%; font-family: Adobe Heiti Std R; padding-left: 20px; font-size: 18px'><b>Code</b></td>";
				$payment_search_results .= "<td style='background-color:#C5DFFA; width: 70%; font-family: Adobe Heiti Std R; padding-left: 20px; font-size: 18px'><b>".$code."</b></td>";
				$payment_search_results .= "</tr>";
				$payment_search_results .= "<tr>";
				$payment_search_results .= "<td style='background-color:#C5DFFA; width: 30%; font-family: Adobe Heiti Std R; padding-left: 20px;  font-size: 18px'><b>Bank Name</b></td>";
				$payment_search_results .= "<td style='background-color:#C5DFFA; width: 70%; font-family: Adobe Heiti Std R; padding-left: 20px; font-size: 18px'><b>".$bank_name."</b></td>";
				$payment_search_results .= "</tr>";
				$payment_search_results .= "<tr>";
				$payment_search_results .= "<td style='background-color:#C5DFFA; width: 30%; font-family: Adobe Heiti Std R; padding-left: 20px;  font-size: 18px'><b>Account Number</b></td>";
				$payment_search_results .= "<td style='background-color:#C5DFFA; width: 70%; font-family: Adobe Heiti Std R; padding-left: 20px; font-size: 18px'><b>".$acct_no."</b></td>";
				$payment_search_results .= "</tr>";
				$payment_search_results .= "<tr>";
				$payment_search_results .= "<td style='background-color:#C5DFFA; width: 30%; font-family: Adobe Heiti Std R; padding-left: 20px; font-size: 18px'><b>Amount Issued 1</b></td>";
				$payment_search_results .= "<td style='background-color:#C5DFFA; width: 70%; font-family: Adobe Heiti Std R; padding-left: 20px; font-size: 18px'><b>".$amount."</b></td>";
				$payment_search_results .= "</tr>";
				$payment_search_results .= "<tr>";
				$payment_search_results .= "<td style='background-color:#C5DFFA; width: 30%; font-family: Adobe Heiti Std R; padding-left: 20px;  font-size: 18px'><b>Amount Issued 2</b></td>";
				$payment_search_results .= "<td style='background-color:#C5DFFA; width: 70%; font-family: Adobe Heiti Std R; padding-left: 20px; font-size: 18px'><b>".$amount2."</b></td>";
				$payment_search_results .= "</tr>";
				$payment_search_results .= "<tr>";
				$payment_search_results .= "<td style='background-color:#C5DFFA; width: 30%; font-family: Adobe Heiti Std R; padding-left: 20px;  font-size: 18px'><b>Amount Issued 3</b></td>";
				$payment_search_results .= "<td style='background-color:#C5DFFA; width: 70%; font-family: Adobe Heiti Std R; padding-left: 20px; font-size: 18px'><b>".$amount3."</b></td>";
				$payment_search_results .= "</tr>";
				$payment_search_results .= "<tr>";
				$payment_search_results .= "<tr>";
				$payment_search_results .= "<td style='background-color:#C5DFFA; width: 30%; font-family: Adobe Heiti Std R; padding-left: 20px;  font-size: 18px'><b>Received By</b></td>";
				$payment_search_results .= "<td style='background-color:#C5DFFA; width: 70%; font-family: Adobe Heiti Std R; padding-left: 20px; font-size: 18px'><b>".$received_by."</b></td>";
				$payment_search_results .= "</tr>";
				$payment_search_results .= "<tr>";
				$payment_search_results .= "<td style='background-color:#C5DFFA; width: 30%; font-family: Adobe Heiti Std R; padding-left: 20px;  font-size: 18px'><b>Date Received</b></td>";
				$payment_search_results .= "<td style='background-color:#C5DFFA; width: 70%; font-family: Adobe Heiti Std R; padding-left: 20px; font-size: 18px'><b>".$date_received."</b></td>";
				$payment_search_results .= "</tr>";
				$payment_search_results .= "<tr>";
				$payment_search_results .= "<td style='background-color:#C5DFFA; width: 30%; font-family: Adobe Heiti Std R; padding-left: 20px;  font-size: 18px'><b>Remarks</b></td>";
				$payment_search_results .= "<td style='background-color:#C5DFFA; width: 70%; font-family: Adobe Heiti Std R; padding-left: 20px; font-size: 18px'><b>".$remark."</b></td>";
				$payment_search_results .= "</tr>";
				$payment_search_results .= "<tr>";
				$payment_search_results .= "<td style='background-color:#C5DFFA; width: 30%; font-family: Adobe Heiti Std R; padding-left: 20px;  font-size: 18px'><b>Comments</b></td>";
				$payment_search_results .= "<td style='background-color:#C5DFFA; width: 70%; font-family: Adobe Heiti Std R; padding-left: 20px; font-size: 18px'><b>".$comment."</b></td>";
				$payment_search_results .= "</tr>";
				$payment_search_results .= "</table><br>";
	            $payment_search_results .= '<center><a href="edit_payment.php?reference_no='.$reference_no.'" class="submit4" id="ver" style="text-transform: uppercase; text-decoration: none;">Edit</a></center>';
				$payment_search_results .= "</div><br>";
				$verify = "Collected";
				if ($remark == $verify){
					?><style type="text/css">#ver{
						display: none;
					}
					</style><?php
				}
				
			} // close the while loop
		} else {
			$msg2 .= "<p style='color: #880000; font-size: 18px; margin-left: 20px'>No result found for <b>$search</b></p>";
			$msg2 .= '<center><label><a href="payment_home.php" style="font-size: 24px; font-family: impact; font-style: normal">Close</a></label></center>';
		}
	} else {
		$msg2 .= "<p style='color: #880000; font-size: 18px; margin-left: 20px'>No result found for <b>empty search</b></p>";
		$msg2 .= '<center><label><a href="payment_home.php" style="font-size: 24px; font-family: impact; font-style: normal">Close</a></label></center>';
	}
	
}
// function disable() 
	// {   
		// document.getElementById("ver").innerHTML='<a href="javascript: void(0)"><edit_payment.php?reference_no='.$reference_no.'" rel="external"">Edit</a>';    
	// }
?>
<!doctype html>
<html>
<link href="http://localhost/buth_net/pharmacySection/css/buth_net.css" rel="stylesheet" type="text/css">
<head>
<meta charset="utf-8">
<link rel="shortcut icon" href="/favicon.ico" >
<title>Payment Home</title>
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
	  <li><a href="register.php">Register</a></li><br>
	  <li><a href="payment_home.php">Payment Status</a></li><br>
	  <li><a href="http://localhost/buth_net/accountSection/logout.php">Logout</a></li><br>
    </ul>
	<?php include_once($_SERVER['DOCUMENT_ROOT'].'../buth_net/new_bar.php'); ?>
      <!-- end .sidebar1 --></div>
     <div class="margin" id="content">
	 <h1 style='text-align: center; font-family: tahoma; font-size: 16px; text-transform: uppercase; font-weight: bold; background-color: #000000; margin-top: -5px; color: #CECECE'>Welcome <?php echo $name; ?> What would you like to do today?</h1><br>
	  <div class="bio_data">
	   <fieldset>
	     <div class="search_angle">
	     <center><h3 class="heading_text">Check Payment Status</h3></center><br>
		<center><img src="../images/payment2.jpg" alt="search_angle" width="500px" height="200px"></center><br>
		<div class="search">
		 <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET">
		 <center><input type="text" name="search2" id="search2" maxlength="88" value="<?php echo $search; ?>"><br><br></center>
		 <center><input type="submit" value="Search" name="searchbtn2" id="searchbtn2"></center>
		 </form>
		 </div>
	   </div>
	   </fieldset>
	</div>
	 <div id="patient_form">
	  <?php echo $payment_search_results; ?>
	  <p style="margin-top: 35px"><?php echo $msg2; ?></p>
    </div><br><br>
   <!-- end .content --></div>
  <!-- end .container --></div>
     <?php
      include_once "../footer.php";
     ?>
</body>
</html>