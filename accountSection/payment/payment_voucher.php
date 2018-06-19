<?php 
session_start();
ob_start();
// error display configuration
// error_reporting(E_ALL & ~E_NOTICE);

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
// get the entered information
$result3 = $_SESSION['result3'];
$sql="SELECT * FROM `payment_form` WHERE `serial_no`='$result3' LIMIT 1";
$check = mysqli_query($dbconnect, $sql);
$resultCount=mysqli_num_rows($check); //count the out amount 
if($resultCount>0){
	while($row=mysqli_fetch_array($check)){
		$pv_no=$row["pv_no"];
		$serial_no=$row["serial_no"];
		$reference_no = $pv_no . $serial_no;
		$cost_center=$row["pur"];
		$cost_center2=$row["pur2"];
		$cost_center3=$row["pur3"];
		$cost_code=$row["code"];
		$payee_name=$row["payee_name"];
		$unit_price=$row["amount"];
		$unit_price2=$row["amount2"];
		$unit_price3=$row["amount3"];
		$today = date("l jS \of F Y");
	}
}else{
$msg="<p style='color: red; padding-left: 8px'>You have no Information yet in the Database</p>";
}
	$total = $unit_price + $unit_price2 + $unit_price3;
	$sql = "UPDATE `payment_form` SET `reference_no`='$reference_no' WHERE `serial_no`='" . $result3 . "'";
	$result4 = mysqli_query($dbconnect, $sql);
?>
<!Doctype html>
<html>

<head>
<meta charset="utf-8">
<link rel="shortcut icon" href="/favicon.ico" >
<script type="text/javascript">
function printDiv(divName) {
    var printContents = document.getElementById(divName).innerHTML;
    var originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;
    window.print();
    document.body.innerHTML = originalContents;
}
</script>
<title>Payment Voucher Slip</title>
</head>
<body style="background-color: #fff">
  <div id="containerr">
     <div id="voucher" style="width: 700px; min-height: 400px; margin-left: auto; margin-right: auto">
      <h1 style="font-size: 26px; font-family: new times roman; color: #000000; text-align: center">Bowen University Teaching Hospital</h1>
   <div class="date">
	  <p style='text-align: center; font-family: "Lucida Grande","Lucida Sans Unicode",Tahoma,Sans-Serif'><?php echo 'Date processed is' . " " . $today; ?></p>
	 </div>
     <div class="print_profiledata">
	     <section><label style='margin-left: 50px; font-family: Calibri (Body); font-size: 20px; font-weight: bold; text-transform: uppercase'>Reference:</label><label style='float: right; margin-right: 50px; font-family: "Lucida Grande","Lucida Sans Unicode",Tahoma,Sans-Serif; font-size: 13px'><?php echo $reference_no; ?></label></section><br>
		 <section><label style='margin-left: 50px; Calibri (Body); font-size: 20px; font-weight: bold; text-transform: uppercase'>Cost Center:</label><label style='float: right; margin-right: 50px;  font-family: "Lucida Grande","Lucida Sans Unicode",Tahoma,Sans-Serif; font-size: 13px'><?php echo $cost_center; ?></label></section><br>
		 <section><label style='margin-left: 50px; Calibri (Body); font-size: 20px; font-weight: bold; text-transform: uppercase'>Cost Code:</label><label style='float: right; margin-right: 50px;  font-family: "Lucida Grande","Lucida Sans Unicode",Tahoma,Sans-Serif; font-size: 13px'><?php echo $cost_code; ?></label></section><br>
   </div><br>
    <label style="font-weight: bold; font-family: monospace; font-size: 14px; margin-left: 50px">Name Of Payee</label><label style='float: right; margin-right: 50px; font-family: monospace; font-size: 14px;'><?php echo $payee_name; ?></label><br><br>
	 <table width="600px" style="margin-left: auto; margin-right: auto;" cellpadding="5" cellspacing="0" border="1">
		<th width="50%" style="font-size: 20px; text-transform: uppercase">Particular</th>
		<th width="25%" style="font-size: 20px; text-transform: uppercase">Unit Price N</th>
		<th width="25%" style="font-size: 20px; text-transform: uppercase">Total N</th>
			<tr>
				<td width="50%" style="font-size: 14px; font-family: monospace">Being payment for <label style="font-weight: bold"><?php echo $cost_center; ?></label></td>
				<td width="25%" style="font-size: 14px; font-family: monospace; text-align: center"><?php echo "N".$unit_price; ?></td>
				<td width="25%" style="text-align: center"></td>
			</tr>
			<tr>
				<td width="50%" style="font-size: 14px; font-family: monospace">Being payment for <label style="font-weight: bold"><?php echo $cost_center2; ?></label></td>
				<td width="25%" style="font-size: 14px; font-family: monospace; text-align: center"><?php echo "N".$unit_price2; ?></td>
				<td width="25%" style="text-align: center"></td>
			</tr>
			<tr>
				<td width="50%" style="font-size: 14px; font-family: monospace">Being payment for <label style="font-weight: bold"><?php echo $cost_center3; ?></label></td>
				<td width="25%" style="font-size: 14px; font-family: monospace; text-align: center"><?php echo "N".$unit_price3; ?></td>
				<td width="25%" style="text-align: center"></td>
			</tr>
			<tr>
				<td width="50%" style="font-size: 14px; font-family: monospace">As per the attached request approved<p> by ................................</p></td>
				<td width="25%"></td>
				<td width="25%"style="text-align: center"><?php echo "N".$total; ?></td>
			</tr>
	 </table><br>
		<label style="font-weight: bold; font-family: monospace; font-size: 14px; margin-left: 50px">Amount in words .............................................................</label><br><br>
		<label style="font-weight: bold; font-family: monospace; font-size: 14px; margin-left: 50px">Approved by the Chief Medical Director/Rep:.................<label style="font-weight: bold; font-family: monospace; font-size: 14px;">Date............</label></label><br><br>
		<label style="font-weight: bold; font-family: monospace; font-size: 14px; margin-left: 50px">Head of Administration/Accountant/Rep:.................<label style="font-weight: bold; font-family: monospace; font-size: 14px;">Date..................</label></label><br><br>
		<label style="font-weight: bold; font-family: monospace; font-size: 14px; margin-left: 50px">Paid by:...................................................<label style="font-weight: bold; font-family: monospace; font-size: 14px;">Date..............</label></label><br><br>
		<label style="font-weight: bold; font-family: monospace; font-size: 14px; margin-left: 50px">Cheque.......................................................................</label><br><br>
		<label style="font-weight: bold; font-family: monospace; font-size: 14px; margin-left: 50px">Received by................<label style="font-weight: bold; font-family: monospace; font-size: 14px;">Signature..........</label><label style="font-weight: bold; font-family: monospace; font-size: 14px;">Date...........</label><label style="font-weight: bold; font-family: monospace; font-size: 14px;">Amount..........</label></label><br><br>
		<center><p style="text-align: center; font-family: Calibri (Body); font-weight: normal; font-size: 14px">Powered By Buth ICT</p></center>
   </div><br><br>
	  <center><input type="button" onclick="printDiv('containerr'); window.open('printouts.php')" value="PRINT" style="width: 90px"></center>		
   </div>
</body>
</html>