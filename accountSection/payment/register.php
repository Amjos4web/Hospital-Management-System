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


if (isset($_POST['submit'])){
	$pv_no = htmlspecialchars($_POST['pv_no']);
	$sn_no = date('ym') . "000";
	$date = htmlspecialchars(trim($_POST['date']));
	$payee_name = htmlspecialchars(trim($_POST['payee_name']));
	$pur = htmlspecialchars(trim($_POST['pur']));
	$pur2 = htmlspecialchars(trim($_POST['pur2']));
	$pur3 = htmlspecialchars(trim($_POST['pur3']));
	$code = htmlspecialchars(trim($_POST['code']));
	$bank_name = htmlspecialchars(trim($_POST['bank_name']));
	$account_no = htmlspecialchars(trim($_POST['account_no']));
	$amount = htmlspecialchars(trim($_POST['amount']));
	$amount2 = htmlspecialchars(trim($_POST['amount2']));
	$amount3 = htmlspecialchars(trim($_POST['amount3']));
	$date_submitted = date('Y-m-d H:i:s');
	
	
	if (empty($pv_no && $date && $payee_name && $pur && $code && $bank_name && $account_no && $amount) == false) 
	{
		if (preg_match("/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/", $date))
		{
			$sql = "INSERT INTO payment_form (`pv_no`, `serial_no`, `date`, `payee_name`, `pur`,`pur2`,`pur3`, `code`, `bank_name`, `acct_no`, `amount`, `amount2`, `amount3`,`date_submitted`) VALUES ('$pv_no', '$sn_no', '$date', '$payee_name', '$pur', '$pur2', '$pur3', '$code', '$bank_name', '$account_no', '$amount', '$amount2', '$amount3','$date_submitted')";
			$check = mysqli_query($dbconnect, $sql) or die(mysqli_error($dbconnect));
			$max4 = "SELECT MAX(serial_no) AS MAX_SERIAL_NO FROM `payment_form`";
			$max2 = mysqli_query($dbconnect, $max4);
			$result1 = mysqli_fetch_assoc($max2);
			$result2 = $result1['MAX_SERIAL_NO']; 
			$result3 = $result2+1 ;
			$sql = "UPDATE `payment_form` SET `serial_no`='$result3' WHERE `date_submitted`='" . $date_submitted . "'";
			$result4 = mysqli_query($dbconnect, $sql);
			header ('location: payment_voucher.php');
			header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
			$_SESSION['result3'] = $result3;
		} else
		$msg = "<p style='color: #D8000C; background-color: #FFBABA; border-radius:.5em; width: 300px; border: 1px solid #D8D8D8; padding: 5px; border-radius: 5px; margin-left: auto; margin-right: auto; font-family: Arial; font-size: 11px; text-transform: uppercase; text-align: center; text-transform: uppercase'>Date of birth should be YYYY-MM-DD</p>";
	} else
	$msg = "<p style='color: #D8000C; background-color: #FFBABA; border-radius:.5em; width: 300px; border: 1px solid #D8D8D8; padding: 5px; border-radius: 5px; margin-left: auto; margin-right: auto; font-family: Arial; font-size: 11px; text-transform: uppercase; text-align: center; text-transform: uppercase'>please fill in the required fields (*)</p>";
}

?>
<!doctype html>
<html>
<link href="http://localhost/buth_net/pharmacySection/css/buth_net.css" rel="stylesheet" type="text/css">
<head>
<meta charset="utf-8">
<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
<meta http-equiv="Pragma" content="no-cache" />
<meta http-equiv="Expires" content="0" />
<link rel="shortcut icon" href="/favicon.ico" >
<title>Registration Page</title>
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
	  <li><a href="../acc_logout.php">Logout</a></li><br>
    </ul>
	<?php include_once($_SERVER['DOCUMENT_ROOT'].'../buth_net/new_bar.php'); ?>
      <!-- end .sidebar1 --></div>
     <div class="margin" id="content">
	 <h1 style='text-align: center; font-family: tahoma; font-size: 16px; text-transform: uppercase; font-weight: bold; background-color: #000000; margin-top: -5px; color: #CECECE'>Welcome <?php echo $name; ?> What would you like to do today?</h1><br>
	  <div class="bio_data">
	    <div class="rec_new_form">
			 <form action="" method="post" enctype="multipart/form-data">
			 <div class="form_data">
			 <center><h3 class="heading_text">New Payment Registration Form</h3></center>
			 <?php echo $msg; ?>
			 <table width="450px" style="margin-left: auto; margin-right: auto;" cellpadding="5" cellspacing="0" border="1">
			 <tr>
			   <td width="30%"><label>PV<label style="color: #880000; float: right">*</label></label></td>
			   <td width="70%"><input type="text" id="userarea" name="pv_no" value= "<?=@$pv_no?>"></td>
			  </tr>
			  <tr>
			   <td width="30%"><label>Date<label style="color: #880000; float: right">*</label></label></td>
			   <td width="70%"><input type="text" id="userarea" name="date" placeholder="YYYY-MM-DD" value= "<?=@$date?>"></td>
			  </tr>
			  <tr>
			   <td width="30%"><label>Name Of Payee<label style="color: #880000; float: right">*</label></label></td>
			   <td width="70%"><input type="text" id="userarea" name="payee_name" value= "<?=@$payee_name?>"></td>
			  </tr>
			  <tr>
			   <td width="30%"><label>Purpose 1<label style="color: #880000; float: right">*</label></label></td>
			   <td width="70%"><input type="text" id="userarea" name="pur" value= "<?=@$pur?>"></td>
			  </tr>
			   <tr>
			   <td width="30%"><label>Amount N<label style="color: #880000; float: right">*</label></label></td>
			   <td width="70%"><input type="text" id="userarea" name="amount" value= "<?=@$amount?>"></td>
			  </tr>
			   <tr>
			   <td width="30%"><label>Purpose 2</label></td>
			   <td width="70%"><input type="text" id="userarea" name="pur2" value= "<?=@$pur2?>"></td>
			  </tr>
			  <tr>
			   <td width="30%"><label>Amount N</label></td>
			   <td width="70%"><input type="text" id="userarea" name="amount2" value= "<?=@$amount2?>"></td>
			  </tr>
			   <tr>
			   <td width="30%"><label>Purpose 3</label></td>
			   <td width="70%"><input type="text" id="userarea" name="pur3" value= "<?=@$pur3?>"></td>
			  </tr>
			  <tr>
			   <td width="30%"><label>Amount N</label></td>
			   <td width="70%"><input type="text" id="userarea" name="amount3" value= "<?=@$amount3?>"></td>
			  </tr>
			  <tr>
			   <td width="30%"><label>Code<label style="color: #880000; float: right">*</label></label></td>
			   <td width="70%"><input type="text" id="userarea" name="code" value= "<?=@$code?>"></td>
			  </tr>
			  <tr>
			   <td width="30%"><label>Bank Name<label style="color: #880000; float: right">*</label></label></td>
			   <td width="70%"><input type="text" id="userarea" name="bank_name" value= "<?=@$bank_name?>"></td>
			  </tr>
			  <tr>
			   <td width="30%"><label>Account No<label style="color: #880000; float: right">*</label></label></td>
			   <td width="70%"><input type="text" id="userarea" name="account_no" value= "<?=@$account_no?>"></td>
			  </tr>
			  </table><br>		  
			</div>
		</div><br>
	   <center><input type="submit" value="Submit and Print" style="padding: 3px 15px; font-size: 18px" name="submit" id="rec_submit"></center>
	   </form>
	  </div>
   <!-- end .content --></div>
  <!-- end .container --></div>
     <?php
      include_once "../footer.php";
     ?>
</body>
</html>