<?php 
session_start();
ob_start();
// error display configuration
if(!isset($_SESSION['emaill'])){
	header('location: pharmacy_store.php');
}
//This block grabs the whole list for viewing
$msg="";
$email= $_SESSION['emaill'];
include "dbconnect2.php";
$sql="SELECT * FROM `pharmacy_store` WHERE `emailAdd`='$email' LIMIT 1";
$check = mysqli_query($dbconnect, $sql);
$resultCount=mysqli_num_rows($check); //count the out amount 
if($resultCount>0){
	while($row=mysqli_fetch_array($check)){
	$id=$row["id"];
	$password=$row["passWord"];
	$name=$row["first_name"];
	}
}else{
$msg="<p style='color: red; text-align: center'>You have no Information yet in the Database</p>";
}


// display data from the invoice note table
$invoice_lists = "";
$sql2 = "SELECT * FROM `invoice_note` ORDER BY date DESC LIMIT 50";
$check2 = mysqli_query($dbconnect, $sql2) or die (mysqli_error($dbconnect));
$resultCount2=mysqli_num_rows($check2); //count the out amount 
if($resultCount2>0){
	while($row=mysqli_fetch_array($check2)){
	$id=$row["id"];
	$date=$row["date"];
	$identity_of_supplier=$row["identity_of_supplier"];
	$lpo_no=$row["lpo_no"];
	$grn_no=$row["grn_no"];
	$invoice=$row["invoice"];
	$amount=$row["amount"];
	
	$invoice_lists .= "<tr>";
	$invoice_lists .= "<td style='background-color:#CECECE; padding-left: 5px; font-family: Adobe Heiti Std R;'>" . $id . "</td>";
	$invoice_lists .= "<td style='background-color:#CECECE; padding-left: 5px; font-family: Adobe Heiti Std R;'>" . $date . "</td>";
	$invoice_lists .= "<td style='background-color:#CECECE; padding-left: 5px; font-family: Adobe Heiti Std R;'>" . $identity_of_supplier . "</td>";
	$invoice_lists .= "<td style='background-color:#CECECE; padding-left: 5px; font-family: Adobe Heiti Std R;'>" . $lpo_no . "</td>";
	$invoice_lists .= "<td style='background-color:#CECECE; padding-left: 5px; font-family: Adobe Heiti Std R;'>" . $grn_no . "</td>";
	$invoice_lists .= "<td style='background-color:#CECECE; padding-left: 5px; font-family: Adobe Heiti Std R;'>" . $invoice . "</td>";
	$invoice_lists .= "<td style='background-color:#CECECE; padding-left: 5px; font-family: Adobe Heiti Std R;'>" . $amount . "</td>";
	$invoice_lists .= "</tr>";
	}
}else{
$msg="<p style='color: red; text-align: center'>You have no product in the store yet</p>";
}

// parse the form data and add the inventory to the system
if (isset($_POST['add'])){
	 $date = htmlspecialchars($_POST['date']);
	 $identity_of_supplier = htmlspecialchars($_POST['identity_of_supplier']);
	 $lpo_no = htmlspecialchars($_POST['lpo_no']);
	 $grn_no = htmlspecialchars($_POST['grn_no']);
	 $invoice = htmlspecialchars($_POST['invoice']);
	 $amount = htmlspecialchars($_POST['amount']);
	 
	if (empty($date && $identity_of_supplier && $lpo_no && $grn_no && $invoice && $amount) == false){
		
		// add product to the database
		$sql4 = "INSERT INTO `invoice_note` (`date`, `identity_of_supplier`, `lpo_no`, `grn_no`, `invoice`,`amount`) VALUES ('$date', '$identity_of_supplier', '$lpo_no', '$grn_no', '$invoice', '$amount')";
		$check4 = mysqli_query($dbconnect, $sql4) or die (mysqli_error($dbconnect));
		$msg = "<p style = 'color: #4F8A10; margin-right: auto; margin-right: auto; text-align: center; background-color: #DFF2BF; border-radius:.5em; width: 400px; border: 1px solid #D8D8D8; margin-left: auto; margin-right: auto; padding: 5px; border-radius: 5px; font-family: Arial; font-size: 11px; text-transform: uppercase; text-transform: uppercase'>Operation Successful</p>";
	} else 
		$msg = "<p style='color: #D8000C; background-color: #FFBABA; border-radius:.5em; width: 300px; border: 1px solid #D8D8D8; padding: 5px; border-radius: 5px; margin-left: auto; margin-right: auto; font-family: Arial; font-size: 11px; text-transform: uppercase; text-align: center; text-transform: uppercase'>Please fill in the required fields (*)</p>";
}
	
?>
<!doctype html>
<html>
<link href="http://localhost/buth_net/pharmacySection/css/buth_net.css" rel="stylesheet" type="text/css">
<head>
<meta charset="utf-8">
<link rel="shortcut icon" href="/favicon.ico" >
<title>Invoice Note Form</title>
<script src="js/jquery-1.12.3.min.js" type="text/javascript"></script>
</head>
<body>
<?php
include_once "header.php";
?>
<div id="container">
  <div id="sidebar1"><br>
    <p class="subHeader">Menu</p>
    <ul id="navigation2">
	   <?php include_once "pharmacy_nav.php"; ?>
    </ul>
	 <img src="images/drugs.png" width="170px" height="250px" style="margin-left: 20px" alt="Welcome To School of Nursing"><br><br>
	 <?php include_once "../new_bar.php"; ?>
      <!-- end .sidebar1 --></div>
     <div class="margin" id="content">
	  <div class="product_lists">
		<div class="invoice_form">
		 <form action="" method="post" enctype="multipart/form-data">
		 <div class="form_data">
		 <h3 style='text-align: center; font-family: Calibri (Body); font-size: 22px; font-weight: bold; text-transform: uppercase; font-style: normal; color: #880000; text-shadow: 0 1px 0 #ccc,0 2px 0 #c9c9c9,0 3px 0 #bbb,0 4px 0 #b9b9b9,0 5px 0 #aaa,0 6px 1px rgba(0,0,0,.1),0 0 5px rgba(0,0,0,.1),0 1px 3px rgba(0,0,0,.3),0 3px 5px rgba(0,0,0,.2),0 5px 10px rgba(0,0,0,.25),0 10px 10px rgba(0,0,0,.2),0 20px 20px rgba(0,0,0,.15)'>Invoice Note Form </h3>
		 <?php echo $msg; ?>
		 <table width="450px" style="margin-left: auto; margin-right: auto;" cellpadding="5" cellspacing="0" border="1">
		  <tr>
		   <td width="30%"><label>Date</label></td>
		   <td width="70%"><input type="text" id="userareas" name="date" placeholder="YYYY-MM-DD"><label style="font-family: monospace; padding-left: 12px">YYYY-MM-DD format</label></td>
		  </tr>
		  <tr>
		   <td width="30%"><label>Identity Of Supplier</label></td>
		   <td width="70%"><input type="text" id="userarea" name="identity_of_supplier"></td>
		  </tr>
		  <tr>
		   <td width="30%"><label>LPO No</label></td>
		   <td width="70%"><input type="text" id="userarea" name="lpo_no"></td>
		  </tr>
	
		   <tr>
		   <td width="30%"><label>GRN No</label></td>
		   <td width="70%"><input type="text" id="userarea" name="grn_no"></td>
		  </tr>
		  <tr>
		   <td width="30%"><label>Invoice</label></td>
		   <td width="70%"><input type="text" id="userarea" name="invoice"></td>
		  </tr>
		  <tr>
		   <td width="30%"><label>Amount</label></td>
		   <td width="70%"><input type="text" id="userarea" name="amount"></td>
		  </tr>
         </table><br>		  
		 <center><input type="submit" value="&gt; &gt; Submit &lt; &lt;" name="add" id="invoice"></center>
		 </form>
		 </div>
		 </div><br><br><br>
		 <table width="600px" style="margin-left: auto; margin-right: auto" cellpadding="2" cellspacing="2" border="1">
		   <tr>
			<td width="5%" style='background-color:#C5DFFA; font-family: arial black; text-align: center; font-size: 14px'><b>ID</b></td>
			<td width="12%" style='background-color:#C5DFFA; font-family: arial black; text-align: center; font-size: 14px'><b>Date</b></td>
			<td width="20%" style='background-color:#C5DFFA; font-family: arial black; text-align: center; font-size: 14px'><b>Idnty Of Supplier</b></td>
			<td width="10%" style='background-color:#C5DFFA; font-family: arial black; text-align: center; font-size: 14px'><b>LPO No</b></td>
			<td width="10%" style='background-color:#C5DFFA; font-family: arial black; text-align: center; font-size: 14px'><b>GRN No</b></td>
			<td width="7%" style='background-color:#C5DFFA; font-family: arial black; text-align: center; font-size: 14px'><b>Invoice</b></td>
			<td width="10%" style='background-color:#C5DFFA; font-family: arial black; text-align: center; font-size: 14px'><b>Amount</b></td>
			</tr>
			<?php echo $invoice_lists; ?>
			<!--tr>
			 <td>&nbsp;</td>
			 <td>&nbsp;</td>
			 <td>&nbsp;</td>
			 <td>&nbsp;</td>
			 <td>&nbsp;</td>Prof
			</tr-->
			</table>
		</div>
		
	   <!-- end .content --></div>
	   
	  <!-- end .container --></div>
     <?php
      include_once "footer.php";
     ?>
</body>
</html>