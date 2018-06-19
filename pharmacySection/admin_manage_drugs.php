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


// delete drug item question for admin 
if (isset($_GET['deleteid'])){
	echo  '<center><h2 style="border: 1px solid #D8D8D8; padding: 10px; border-radius: 5px; font-family: Arial; font-size: 14px; text-transform: uppercase; background-color: rgb(255, 249, 242); color: rgb(211, 0, 0); width: 500px; margin-top: 250px">Do you really want to delete the drug with ID of'." ".$_GET['deleteid'].'? <a href="admin_manage_drugs.php?yesdelete='.$_GET['deleteid'].'" style="text-decoration: none; color: #000000">Yes</a>|<a href="admin_manage_drugs.php" style="text-decoration: none; color: #000000">No</a></h2></center>';
	exit();
}

// delete drug item by admin
if (isset($_GET['yesdelete'])){
	$item_to_delete = $_GET['yesdelete'];
	$deletequery = "DELETE  FROM `products` WHERE `product_id`='$item_to_delete' LIMIT 1";
	$deletecheck = mysqli_query($dbconnect, $deletequery) or die (mysqli_error($dbconnect));
	header ('location: admin_manage_drugs.php');
	exit();
}


$dynamic_lists = "";
// $page = "";


// $page = $_GET['page'];
// if ($page == "" || $page == "1"){
	// $page1 = 0;
// } else {
	// $page1 = ($page*14)-14;
// }
$sql2 = "SELECT * FROM `products` ORDER BY date_added DESC LIMIT 100";
$check2 = mysqli_query($dbconnect, $sql2) or die (mysqli_error($dbconnect));
$resultCount2=mysqli_num_rows($check2); //count the out amount 
if($resultCount2>0){
	while($row=mysqli_fetch_array($check2)){
    $product_id=$row["product_id"];
	$product_id2=$row["product_id"];
	$product_name=$row["product_name"];
	$category=$row["category"];
	$quantity_available=$row["quantity_available"];
	$product_price=$row["price"];
	$date_added=$row["date_added"];
	$drug_type=$row["drug_type"];
	$dynamic_lists .= "<tr>";
	$dynamic_lists .= "<td style='background-color:#CECECE; font-family: Adobe Heiti Std R;'>" . $product_id . "</td>";
	$dynamic_lists .= "<td style='background-color:#CECECE; font-family: Adobe Heiti Std R;'>" . $product_name . "</td>";
	$dynamic_lists .= "<td style='background-color:#CECECE; font-family: Adobe Heiti Std R;'>" . $category . "</td>";
	$dynamic_lists .= "<td style='background-color:#CECECE; font-family: Adobe Heiti Std R;'>" . $drug_type . "</td>";
	$dynamic_lists .= "<td style='background-color:#CECECE; font-family: Adobe Heiti Std R;'>N" . $product_price . "</td>";
	$dynamic_lists .= "<td style='background-color:#CECECE; font-family: Adobe Heiti Std R;'>" . $quantity_available . "</td>";
	$dynamic_lists .= "<td style='background-color:#CECECE; font-family: Adobe Heiti Std R;'>" . $date_added . "</td>";
	$dynamic_lists .= "<td style='background-color:#CECECE; font-family: Adobe Heiti Std R;'>" . "<a href='admin_edit_drugs.php?pid=$product_id' style='font-style: normal; font-family: Adobe Heiti Std R; color: #880000'>Edit</a></td>";
	$dynamic_lists .= "<td style='background-color:#CECECE; font-family: Adobe Heiti Std R;'>" . "<a href='admin_manage_drugs.php?deleteid=$product_id' style='font-style: normal; font-family: Adobe Heiti Std R; color: #880000'>Delete</a></td>";
	$dynamic_lists .= "</tr>";
	}
}else{
$msg="<p style='color: #D8000C; background-color: #FFBABA; border-radius:.5em; width: 300px; border: 1px solid #D8D8D8; padding: 5px; border-radius: 5px; margin-left: auto; margin-right: auto; font-family: Arial; font-size: 11px; text-transform: uppercase; text-align: center; text-transform: uppercase'>You have no product in the store yet</p>";
}


?>
<!doctype html>
<html>
<link href="http://localhost/buth_net/pharmacySection/css/buth_net.css" rel="stylesheet" type="text/css">
<head>
<meta charset="utf-8">
<link rel="shortcut icon" href="/favicon.ico" >
<title>Welcome Admin</title>
</head>
<body>
<?php
include_once "header.php";
?>
<div id="container">
  <div id="sidebar1"><br>
    <p class="subHeader">Menu</p>
    <ul id="navigation2">
	 <?php include_once "admin_nav.php"; ?>
    </ul>
	 <img src="images/drugs.png" width="170px" height="250px" style="margin-left: 20px" alt="Welcome To School of Nursing"><br><br>
	 <?php include_once "../new_bar.php"; ?>
      <!-- end .sidebar1 --></div>
     <div class="margin" id="content">
	  <div class="welcome_message">
	   <h1 style='text-align: center; font-family: tahoma; font-size: 16px; text-transform: uppercase; font-weight: bold; background-color: #000000; color: #CECECE'>Welcome <?php echo $name."!" . " "; ?>What would you like to do today?</h1>
	     <h2 style='text-align: center; font-family: Calibri (Body); font-size: 22px; font-weight: bold; text-transform: uppercase; font-style: normal; color: #880000; text-shadow: 0 1px 0 #ccc,0 2px 0 #c9c9c9,0 3px 0 #bbb,0 4px 0 #b9b9b9,0 5px 0 #aaa,0 6px 1px rgba(0,0,0,.1),0 0 5px rgba(0,0,0,.1),0 1px 3px rgba(0,0,0,.3),0 3px 5px rgba(0,0,0,.2),0 5px 10px rgba(0,0,0,.25),0 10px 10px rgba(0,0,0,.2),0 20px 20px rgba(0,0,0,.15)'>Available Stocks</h2>
	    </div><br><br>
	  <div class="product_formlist">
		<table width="760px" style="margin-left: auto; margin-right: auto" cellpadding="1" cellspacing="0" border="1">
	   <tr>
	    <td width="5%" style='background-color:#C5DFFA; font-family: arial black; text-align: center; font-size: 14px'><b>ID</b></td>
		<td width="18%" style='background-color:#C5DFFA; font-family: arial black; text-align: center; font-size: 14px'><b>Name</b></td>
		<td width="18%" style='background-color:#C5DFFA; font-family: arial black; text-align: center; font-size: 14px'><b>Category</b></td>
		<td width="13%" style='background-color:#C5DFFA; font-family: arial black; text-align: center; font-size: 14px'><b>Type</b></td>
		<td width="10%" style='background-color:#C5DFFA; font-family: arial black; text-align: center; font-size: 14px'><b>Selling Price</b></td>
		<td width="10%" style='background-color:#C5DFFA; font-family: arial black; text-align: center; font-size: 14px'><b>Qty Avail.</b></td>
		<td width="10%" style='background-color:#C5DFFA; font-family: arial black; text-align: center; font-size: 14px'><b>Date Added</b></td>
		<td width="7%" style='background-color:#C5DFFA; font-family: arial black; text-align: center; font-size: 14px'><b>Edit Drugs</b></td>
		<td width="7%" style='background-color:#C5DFFA; font-family: arial black; text-align: center; font-size: 14px'><b>Delete Drugs</b></td>
		</tr>
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