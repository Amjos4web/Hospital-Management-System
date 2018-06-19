<?php 
session_start();
ob_start();
// error display configuration
error_reporting(E_ALL);
ini_set('display_errors','1');

if(!isset($_SESSION['emaill'])){
	header('location: cashier_login.php');
}
//This block grabs the whole list for viewing
$msg="";
$email= $_SESSION['emaill'];
include "dbconnect2.php";
$sql="SELECT * FROM `cashier` WHERE `username_id`='$email' LIMIT 1";
$check = mysqli_query($dbconnect, $sql);
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

// block for receipt
include "search_angle.php";
$search = $_SESSION['search2'];
$receipt = "";
$sql8="SELECT * FROM `transactions` WHERE `hospital_no`='$search' LIMIT 1";
$check8 = mysqli_query($dbconnect, $sql8);
$resultCount8=mysqli_num_rows($check8); //count the out amount 
if($resultCount8>0){
	while($row=mysqli_fetch_array($check8)){
	$amount_tendered=$row["amount_tendered"];
	$amount_to_pay=$row["total_amount"];
	$paid_for=$row["paid_for"];
	$receivedBy=$row["received_by"];
	$patient_name=$row["patient_name"];
	$hospital_No=$row["hospital_no"];
	$receipt_id=$row["receipt_no1"];
	
	
	$change = $amount_tendered - $amount_to_pay;
	$converter = new NumberFormatter("en", NumberFormatter::SPELLOUT);
	$in_word = $converter->format($amount_to_pay);
	$receipt .= '<div class="receipt_stuffs" style="border: 1px dashed #000000; padding: 3px; min-height: 120px">';
	$receipt .= '<center><span style="font-family: arial black; float: right">Total:'." " . "N" . $amount_to_pay.'</span></center><br><br>';
	$receipt .= '<label style="font-family: arial black; font-size: 14px">Amount Collected: <span style="float: right; font-family: arial">'."N" .$amount_tendered.'</span></label><br>';
	$receipt .= '<label style="font-family: arial black; font-size: 14px">Change: <span style="float: right; font-family: arial">'."N" .$change.'</span></label><br>';
	$receipt .= '<label style="font-family: arial black; font-size: 13px">Amount in words: <span style="float: right; font-family: arial">' .ucwords($in_word). " " . "Naira".'</span></label><br>';
	$receipt .= '</div>';
	}
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link rel="shortcut icon" href="/favicon.ico" >
<title>Receipt</title>
</head>
<body>
<div id="receipt_wrapper" style="width: 272px; height: 756px; margin-left: auto; margin-right: auto">
  <center><label style="font-family: arial; font-size: 13px; text-transform: uppercase">Bowen University Teaching Hospital, ogbomoso</label></center>
  <p style="text-align: center; font-family: arial; font-size: 12px; text-transform: uppercase">Payment Receipt</p>
 <p style="font-family: Calibri (Body); font-weight: bold; font-size: 14px"><?php echo date("l jS \of F Y"). "," . " " . date('H:i:s'); ?></p>
  <label style="font-family: Calibri (Body); font-weight: bold; font-size: 14px"><?php echo "Payer ID:" . " " .$patient_name; ?></label>
  <label style="float: right; font-family: Calibri (Body); font-weight: bold; font-size: 14px"><?php echo "Hosp. No:" . " " .$hospital_No; ?></label><br>
  <label style="font-family: arial black; font-size: 11px;  text-transform: uppercase"><?php echo  "Being Payment For" . " ".$paid_for; ?></label><br>
  
	<?php echo $receipt; ?><br>
     <center><span style="font-family: arial"><?php echo "Received by" . " " . $receivedBy; ?></span></center>
	 <center><label style='font-family: Bradley Hand ITC; font-size: 24px'>signed</label></center>
	 <center><label style="font-family: arial black; text-align: center; font-size: 11px;  text-transform: uppercase"><?php echo  "Receipt No:" . " ".$receipt_id; ?></label></center>
	 <p style="text-align: center; font-family: Calibri (Body); font-weight: normal; font-size: 14px">Powered By Buth ICT</p>
	 </div>
	  
</body>
</html>