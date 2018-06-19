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



// edit item for payment
if (isset($_GET['reference_no'])){
	$reference_no = $_GET['reference_no'];
	// get the block for payment listing
	$sql2 = "SELECT * FROM `payment_form` WHERE `reference_no`='$reference_no' LIMIT 1";
	$check2 = mysqli_query($dbconnect, $sql2) or die (mysqli_error($dbconnect));
	$resultCount2=mysqli_num_rows($check2); //count the out amount 
	if($resultCount2>0){
		while($row2=mysqli_fetch_array($check2)){
			$pv_no = $row2["pv_no"];
			$payment_id = $row2["id"];
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
		}
	}else{
	$msg="<p style='color: red; text-align: center'>Sorry! Error has occurred. Please try again</p>";
	}
}

// parse the form data and add the inventory to the system
 if (isset($_POST['makeChange'])){
		$comment = $_POST['comment'];
		$remark = htmlspecialchars(trim($_POST['remark']));
		$received_by = htmlspecialchars(trim($_POST['received_by']));
		$date_received = htmlspecialchars(trim($_POST['date_received']));
		
	 

		$sql3 = "UPDATE `payment_form` SET `remark`='$remark', `comment`='$comment', `received_by`='$received_by', `date_received`='$date_received' WHERE `reference_no`='$reference_no'";
		$check3 = mysqli_query($dbconnect, $sql3) or die (mysqli_error($dbconnect));
		$msg = '<p style = "color: #4F8A10; margin-right: auto; margin-right: auto; text-align: center; background-color: #DFF2BF; border-radius:.5em; width: 400px; border: 1px solid #D8D8D8; margin-left: auto; margin-right: auto; padding: 5px; border-radius: 5px; font-family: Arial; font-size: 11px; text-transform: uppercase; text-transform: uppercase">Operation Successful...</p>';
		header ("refresh:3; url=payment_home.php"); // wait for 3 secs before redirect
}

?>
<!doctype html>
<html>
<link href="http://localhost/buth_net/pharmacySection/css/buth_net.css" rel="stylesheet" type="text/css">
<head>
<meta charset="utf-8">
<link rel="shortcut icon" href="/favicon.ico" >
 <title>Payment Page|<?php echo $reference_no; ?></title>
<script src="js/jqueryy.js" type="text/javascript"></script>
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
	  <div class="product_lists">
	    </div><br>
		<div class="product_form2">
		 <form action="" method="post" enctype="multipart/form-data">
		 <div class="form_data">
		 <h3 style='color: brown; font-size: 22px; font-style: normal; text-align: center; font-family: monospace'>Edit Payment Account|<?php echo $reference_no; ?><h3>
		 <?php
		 echo $msg;
		 ?>
		  <table width="450px" style="margin-left: auto; margin-right: auto;" cellpadding="5" cellspacing="0" border="1">
			 <tr>
			   <td width="30%"><label>PV No</label></td>
			   <td width="70%"><input type="text" id="userarea" name="pv_no" disabled="disabled" value= "<?php echo $pv_no; ?>"></td>
			  </tr>
			  <tr>
			   <td width="30%"><label>Date</label></td>
			   <td width="70%"><input type="text" id="userarea" name="date" disabled="disabled" placeholder="YYYY-MM-DD" value= "<?php echo $date; ?>"></td>
			  </tr>
			  <tr>
			   <td width="30%"><label>Name Of Payee</label></td>
			   <td width="70%"><input type="text" id="userarea" name="payee_name" disabled="disabled" value= "<?php echo $payee_name; ?>"></td>
			  </tr>
			  <tr>
			   <td width="30%"><label>Purpose 1</label></td>
			   <td width="70%"><input type="text" id="userarea" name="pur" disabled="disabled" value= "<?php echo $pur; ?>"></td>
			  </tr>
			  <tr>
			   <td width="30%"><label>Amount N</label></td>
			   <td width="70%"><input type="text" id="userarea" name="amount" disabled="disabled" value= "<?php echo $amount; ?>"></td>
			  </tr>
			   <tr>
			   <td width="30%"><label>Purpose 2</label></td>
			   <td width="70%"><input type="text" id="userarea" disabled="disabled" name="pur2" value="<?php echo $pur2; ?>"></td>
			  </tr>
			  <tr>
			   <td width="30%"><label>Amount N</label></td>
			   <td width="70%"><input type="text" id="userarea" name="amount2" disabled="disabled" value= "<?php echo $amount2; ?>"></td>
			  </tr>
			   <tr>
			   <td width="30%"><label>Purpose 3</label></td>
			   <td width="70%"><input type="text" id="userarea" disabled="disabled" name="pur3" value= "<?php echo $pur3; ?>"></td>
			  </tr>
			   <tr>
			   <td width="30%"><label>Amount N</label></td>
			   <td width="70%"><input type="text" id="userarea" name="amount3" disabled="disabled" value= "<?php echo $amount3; ?>"></td>
			  </tr>
			  <tr>
			   <td width="30%"><label>Code</label></td>
			   <td width="70%"><input type="text" id="userarea" name="code" disabled="disabled" value= "<?php echo $code; ?>"></td>
			  </tr>
			  <tr>
			   <td width="30%"><label>Bank Name</label></td>
			   <td width="70%"><input type="text" id="userarea" name="bank_name" disabled="disabled" value= "<?php echo $bank_name; ?>"></td>
			  </tr>
			  <tr>
			   <td width="30%"><label>Account No</label></td>
			   <td width="70%"><input type="text" id="userarea" name="account_no" disabled="disabled" value= "<?php echo $acct_no; ?>"></td>
			  </tr>
			   <tr style="background-color: #14BCEB;">
			   <td width="30%"><label>Received by</label></td>
			   <td width="70%"><input type="text" id="userarea" name="received_by" value= "<?php echo $received_by; ?>"></td>
			  </tr>
			   <tr style="background-color: #14BCEB;">
			   <td width="30%"><label>Date Received</label></td>
			   <td width="70%"><input type="text" id="userarea" name="date_received" placeholder="YYYY-MM-DD" value= "<?php echo $date_received; ?>"></td>
			  </tr>
			  <tr style="background-color: #14BCEB;">
			   <td width="30%"><label>Remarks</label></td>
			   <td width="70%"><select name="remark" id="userarea">
			   <option value="<?php echo $remark; ?>"><?php echo $remark; ?></option>
			   <option value="Collected">Collected</option>
			   <option value="Not Collected">Not Collected</option>
			   </select></td>
			  </tr>
			   <tr style="background-color: #14BCEB;">
			   <td width="30%"><label>Comments</label></td>
			   <td width="70%"><textarea type="textarea" cols="44" rows="3" id="userarea5" name="comment"><?php echo $comment; ?></textarea></td>
			  </tr>
			 </table><br>	
		   <input type="submit" value="&gt; &gt; Make Changes &lt; &lt;" name="makeChange" id="login222">
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