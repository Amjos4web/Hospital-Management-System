<?php 
session_start();
ob_start();
// error display configuration


if(!isset($_SESSION['emaill'])){
	header('location: admin_login.php');
}
//This block grabs the whole list for viewing
$msg="";
$email= $_SESSION['emaill'];
include "dbconnect2.php";
$sql="SELECT * FROM `admin` WHERE `admin_email`='$email' LIMIT 1";
$check = mysqli_query($dbconnect, $sql);
$resultCount=mysqli_num_rows($check); //count the out amount 
if($resultCount>0){
	while($row=mysqli_fetch_array($check)){
	$id=$row["id"];
	$admin_password=$row["admin_password"];
	$name=$row["name"];
	}
}else{
$msg="<p style='color: red; text-align: center'>You have no Information yet in the Database</p>";
}


$dynamic_lists = "";
$dynamic_list = "";
// display stock from copd table
if (isset($_GET['copd'])){
	$table_name = $_GET['copd'];
	$sql2 = "SELECT * FROM `copd_pharm_req` ORDER BY date_added DESC LIMIT 100";
	$check2 = mysqli_query($dbconnect, $sql2) or die (mysqli_error($dbconnect));
	$resultCount2=mysqli_num_rows($check2); //count the out amount 
	if($resultCount2>0){
		while($row=mysqli_fetch_array($check2)){
		$product_id=$row["id"];
		$product_name=$row["product_name"];
		$category=$row["category"];
		$quantity=$row["quantity"];
		$product_price=$row["unit_price"];
		$date_added=$row["date_added"];
	
		$dynamic_lists .= "<tr>";
		$dynamic_lists .= "<td style='background-color:#CECECE; font-family: Adobe Heiti Std R;'>" . $product_id . "</td>";
		$dynamic_lists .= "<td style='background-color:#CECECE; font-family: Adobe Heiti Std R;'>" . $product_name . "</td>";
		$dynamic_lists .= "<td style='background-color:#CECECE; font-family: Adobe Heiti Std R;'>" . $category . "</td>";
		$dynamic_lists .= "<td style='background-color:#CECECE; font-family: Adobe Heiti Std R;'>N" . $product_price . "</td>";
		$dynamic_lists .= "<td style='background-color:#CECECE; font-family: Adobe Heiti Std R;'>" . $quantity . "</td>";
		$dynamic_lists .= "<td style='background-color:#CECECE; font-family: Adobe Heiti Std R;'>" . $date_added . "</td>";
		$dynamic_lists .= "</tr>";
		$dynamic_list = "<h1 style='font-family: Calibri (Body); font-size: 22px; font-weight: bold; text-transform: uppercase; font-style: normal; color: #880000; text-shadow: 0 1px 0 #ccc,0 2px 0 #c9c9c9,0 3px 0 #bbb,0 4px 0 #b9b9b9,0 5px 0 #aaa,0 6px 1px rgba(0,0,0,.1),0 0 5px rgba(0,0,0,.1),0 1px 3px rgba(0,0,0,.3),0 3px 5px rgba(0,0,0,.2),0 5px 10px rgba(0,0,0,.25),0 10px 10px rgba(0,0,0,.2),0 20px 20px rgba(0,0,0,.15)'>".$table_name."</h1>";
		}
	}else{
	$msg="<p style='color: #D8000C; background-color: #FFBABA; border-radius:.5em; width: 300px; border: 1px solid #D8D8D8; padding: 5px; border-radius: 5px; margin-left: auto; margin-right: auto; font-family: Arial; font-size: 11px; text-transform: uppercase; text-align: center; text-transform: uppercase'>No stock yet</p>";
	}
}
	
// display stocks from mopd table
if (isset($_GET['mopd'])){
	$table_name = $_GET['mopd'];
	$sql2 = "SELECT * FROM `mopd_pharm_req` ORDER BY date_added DESC LIMIT 100";
	$check2 = mysqli_query($dbconnect, $sql2) or die (mysqli_error($dbconnect));
	$resultCount2=mysqli_num_rows($check2); //count the out amount 
	if($resultCount2>0){
		while($row=mysqli_fetch_array($check2)){
		$product_id=$row["id"];
		$product_name=$row["product_name"];
		$category=$row["category"];
		$quantity=$row["quantity"];
		$product_price=$row["unit_price"];
		$date_added=$row["date_added"];

		$dynamic_lists .= "<tr>";
		$dynamic_lists .= "<td style='background-color:#CECECE; font-family: Adobe Heiti Std R;'>" . $product_id . "</td>";
		$dynamic_lists .= "<td style='background-color:#CECECE; font-family: Adobe Heiti Std R;'>" . $product_name . "</td>";
		$dynamic_lists .= "<td style='background-color:#CECECE; font-family: Adobe Heiti Std R;'>" . $category . "</td>";
		$dynamic_lists .= "<td style='background-color:#CECECE; font-family: Adobe Heiti Std R;'>N" . $product_price . "</td>";
		$dynamic_lists .= "<td style='background-color:#CECECE; font-family: Adobe Heiti Std R;'>" . $quantity . "</td>";
		$dynamic_lists .= "<td style='background-color:#CECECE; font-family: Adobe Heiti Std R;'>" . $date_added . "</td>";
		$dynamic_lists .= "</tr>";
		$dynamic_list = "<h1 style='font-family: Calibri (Body); font-size: 22px; font-weight: bold; text-transform: uppercase; font-style: normal; color: #880000; text-shadow: 0 1px 0 #ccc,0 2px 0 #c9c9c9,0 3px 0 #bbb,0 4px 0 #b9b9b9,0 5px 0 #aaa,0 6px 1px rgba(0,0,0,.1),0 0 5px rgba(0,0,0,.1),0 1px 3px rgba(0,0,0,.3),0 3px 5px rgba(0,0,0,.2),0 5px 10px rgba(0,0,0,.25),0 10px 10px rgba(0,0,0,.2),0 20px 20px rgba(0,0,0,.15)'>".$table_name."</h1>";
		}
	}else{
	$msg="<p style='color: #D8000C; background-color: #FFBABA; border-radius:.5em; width: 300px; border: 1px solid #D8D8D8; padding: 5px; border-radius: 5px; margin-left: auto; margin-right: auto; font-family: Arial; font-size: 11px; text-transform: uppercase; text-align: center; text-transform: uppercase'>No stock yet</p>";
	}
}

// display stocks from mch table
if (isset($_GET['mch'])){
	$table_name = $_GET['mch'];
	$sql2 = "SELECT * FROM `ae_pharm_req` ORDER BY payment_date DESC LIMIT 100";
	$check2 = mysqli_query($dbconnect, $sql2) or die (mysqli_error($dbconnect));
	$resultCount2=mysqli_num_rows($check2); //count the out amount 
	if($resultCount2>0){
		while($row=mysqli_fetch_array($check2)){
		$product_id=$row["id"];
		$product_name=$row["product_name"];
		$category=$row["category"];
		$quantity=$row["quantity"];
		$product_price=$row["unit_price"];
		$date_added=$row["payment_date"];

		$dynamic_lists .= "<tr>";
		$dynamic_lists .= "<td style='background-color:#CECECE; font-family: Adobe Heiti Std R;'>" . $product_id . "</td>";
		$dynamic_lists .= "<td style='background-color:#CECECE; font-family: Adobe Heiti Std R;'>" . $product_name . "</td>";
		$dynamic_lists .= "<td style='background-color:#CECECE; font-family: Adobe Heiti Std R;'>" . $category . "</td>";
		$dynamic_lists .= "<td style='background-color:#CECECE; font-family: Adobe Heiti Std R;'>N" . $product_price . "</td>";
		$dynamic_lists .= "<td style='background-color:#CECECE; font-family: Adobe Heiti Std R;'>" . $quantity . "</td>";
		$dynamic_lists .= "<td style='background-color:#CECECE; font-family: Adobe Heiti Std R;'>" . $date_added . "</td>";
		$dynamic_lists .= "</tr>";
		$dynamic_list = "<h1 style='font-family: Calibri (Body); font-size: 22px; font-weight: bold; text-transform: uppercase; font-style: normal; color: #880000; text-shadow: 0 1px 0 #ccc,0 2px 0 #c9c9c9,0 3px 0 #bbb,0 4px 0 #b9b9b9,0 5px 0 #aaa,0 6px 1px rgba(0,0,0,.1),0 0 5px rgba(0,0,0,.1),0 1px 3px rgba(0,0,0,.3),0 3px 5px rgba(0,0,0,.2),0 5px 10px rgba(0,0,0,.25),0 10px 10px rgba(0,0,0,.2),0 20px 20px rgba(0,0,0,.15)'>".$table_name."</h1>";
		}
	}else{
	$msg="<p style='color: #D8000C; background-color: #FFBABA; border-radius:.5em; width: 300px; border: 1px solid #D8D8D8; padding: 5px; border-radius: 5px; margin-left: auto; margin-right: auto; font-family: Arial; font-size: 11px; text-transform: uppercase; text-align: center; text-transform: uppercase'>No stock yet</p>";
	}
}

// display stocks from ipd table
if (isset($_GET['ipd'])){
	$table_name = $_GET['ipd'];
	$sql2 = "SELECT * FROM `ipd_pharm_req` ORDER BY date_added DESC LIMIT 100";
	$check2 = mysqli_query($dbconnect, $sql2) or die (mysqli_error($dbconnect));
	$resultCount2=mysqli_num_rows($check2); //count the out amount 
	if($resultCount2>0){
		while($row=mysqli_fetch_array($check2)){
		$product_id=$row["id"];
		$product_name=$row["product_name"];
		$category=$row["category"];
		$quantity=$row["quantity"];
		$product_price=$row["unit_price"];
		$date_added=$row["date_added"];

		$dynamic_lists .= "<tr>";
		$dynamic_lists .= "<td style='background-color:#CECECE; font-family: Adobe Heiti Std R;'>" . $product_id . "</td>";
		$dynamic_lists .= "<td style='background-color:#CECECE; font-family: Adobe Heiti Std R;'>" . $product_name . "</td>";
		$dynamic_lists .= "<td style='background-color:#CECECE; font-family: Adobe Heiti Std R;'>" . $category . "</td>";
		$dynamic_lists .= "<td style='background-color:#CECECE; font-family: Adobe Heiti Std R;'>N" . $product_price . "</td>";
		$dynamic_lists .= "<td style='background-color:#CECECE; font-family: Adobe Heiti Std R;'>" . $quantity . "</td>";
		$dynamic_lists .= "<td style='background-color:#CECECE; font-family: Adobe Heiti Std R;'>" . $date_added . "</td>";
		$dynamic_lists .= "</tr>";
		$dynamic_list = "<h1 style='font-family: Calibri (Body); font-size: 22px; font-weight: bold; text-transform: uppercase; font-style: normal; color: #880000; text-shadow: 0 1px 0 #ccc,0 2px 0 #c9c9c9,0 3px 0 #bbb,0 4px 0 #b9b9b9,0 5px 0 #aaa,0 6px 1px rgba(0,0,0,.1),0 0 5px rgba(0,0,0,.1),0 1px 3px rgba(0,0,0,.3),0 3px 5px rgba(0,0,0,.2),0 5px 10px rgba(0,0,0,.25),0 10px 10px rgba(0,0,0,.2),0 20px 20px rgba(0,0,0,.15)'>".$table_name."</h1>";
		}
	}else{
	$msg="<p style='color: #D8000C; background-color: #FFBABA; border-radius:.5em; width: 300px; border: 1px solid #D8D8D8; padding: 5px; border-radius: 5px; margin-left: auto; margin-right: auto; font-family: Arial; font-size: 11px; text-transform: uppercase; text-align: center; text-transform: uppercase'>No stock yet</p>";
	}
}
?>
<!doctype html>
<html>
<link href="http://localhost/buth_net/pharmacySection/css/buth_net.css" rel="stylesheet" type="text/css">
<head>
<meta charset="utf-8">
<link rel="shortcut icon" href="/favicon.ico" >
<title>Welcome Admin</title>
<script src="js/jquery-1.12.3.min.js" type="text/javascript"></script>
<script>
$(document).ready(function(){
	$('.submit9').click(function(){
		$('#view_other').fadeIn(2000);
		$('.submit9').fadeOut(600);
	})
})
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
	  <li class="page_title">Pharmacy Unit</li><br>
	  <li><a href="admin_dashboard.php">Homepage</a></li><br>
	  <li><a href="stockvaluation.php">Stock Val. Summary</a></li><br>
      <li><a href="admin_manage_drugs.php">Manage Drugs</a></li><br>
	  <li><a href="#">Add Staff</a></li><br>
      <li><a href="logout.php">Logout</a></li><br>
    </ul>
	 <img src="images/drugs.png" width="170px" height="250px" style="margin-left: 20px" alt="Welcome To School of Nursing"><br><br>
	 <?php include_once "../new_bar.php"; ?>
      <!-- end .sidebar1 --></div>
     <div class="margin" id="content">
	  <div class="welcome_message">
	   <h1 style='text-align: center; font-family: tahoma; font-size: 16px; text-transform: uppercase; font-weight: bold; background-color: #000000; color: #CECECE'>Welcome <?php echo $name."!" . " "; ?>What would you like to do today?</h1><br><br><br>
		 <div class="search" style="float: right; margin-right: 20px;">
		 <form action="admin_search.php" method="get">
		 <input type="text" name="search" id="search" maxlength="88" placeholder="Search by name">
		 <select name="search_table" class="userarea0" style="width: 130px">
		 <option value="Null">Select Unit</option>
		 <option value="Pharmacy_Store">Pharmacy Store</option>
		 <option value="COPD">COPD</option>
		 <option value="MOPD">MOPD</option>
		 <option value="MCH">MCH</option>
		 <option value="A_and_E">A and E</option>
		 <option value="IPD">IPD</option>
		 <input type="submit" value="Search" name="searchbtn" id="searchbtn">
		 </select>
		 </form>
		</div>
	    </div>
	  <div class="product_formlist">
	  <div id="view_other" style="display: none">
	  <form action="" method="GET">
	    <ul>
		  <li><input type="submit" name="copd" value="COPD Stocks" id="view"></li>
		  <li><input type="submit" name="mopd" value="MOPD Stocks" id="view"></li>
		  <li><input type="submit" name="mch" value="MCH Stocks" id="view"></li>
		  <li><input type="submit" name="ipd" value="IPD Stocks" id="view"></li>
	    </ul>
		</form>
	   </div><br>
	   <div class="view">
		<input type="submit"  class="submit9"  value="View Other Pharmacy Units' Stocks"><br><br>
	  </div>
		<table width="760px" style="margin-left: auto; margin-right: auto" cellpadding="1" cellspacing="0" border="1">
	   <tr>
	    <td width="5%" style='background-color:#C5DFFA; font-family: arial black; text-align: center; font-size: 14px'><b>ID</b></td>
		<td width="25%" style='background-color:#C5DFFA; font-family: arial black; text-align: center; font-size: 14px'><b>Name</b></td>
		<td width="25%" style='background-color:#C5DFFA; font-family: arial black; text-align: center; font-size: 14px'><b>Category</b></td>
		<td width="15%" style='background-color:#C5DFFA; font-family: arial black; text-align: center; font-size: 14px'><b>Selling Price</b></td>
		<td width="15%" style='background-color:#C5DFFA; font-family: arial black; text-align: center; font-size: 14px'><b>Quantity Available</b></td>
		<td width="15%" style='background-color:#C5DFFA; font-family: arial black; text-align: center; font-size: 14px'><b>Date Added</b></td>
		</tr>
		<?php echo $dynamic_list; ?>
		<?php echo $dynamic_lists; ?>
	    <?php
	    echo $msg;
	    ?>
		<!--tr>
		 <td>&nbsp;</td>
		 <td>&nbsp;</td>
		 <td>&nbsp;</td>
		 <td>&nbsp;</td>
		 <td>&nbsp;</td>
		</tr-->
		</table>
	   </div><br>
	   
	     <?php
		// // this is for counting page
		// $sql3 = "SELECT * FROM `products` ORDER BY date_added DESC";
		// $check3 = mysqli_query($dbconnect, $sql3) or die (mysqli_error($dbconnect));
		// $resultCount3=mysqli_num_rows($check3); //count the out amount 
        
		// $a = $resultCount3/14;
		// $a = ceil($a);
		   // for($b=1;$b<=$a;$b++)
		   // {
			   
		   // }
		 ?>
   <!-- end .content --></div>
  <!-- end .container --></div>
     <?php
      include_once "footer.php";
     ?>
</body>
</html>