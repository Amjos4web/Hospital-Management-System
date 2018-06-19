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
?>
<?php
$search_results = "";
$search_result = "";
$msg2 = "";
// see if the posted search query field is set and has a value
if (isset($_GET['searchbtn'])){
	if (isset($_GET['search']) && $_GET['search'] != ""){
		// filter the inputs
		$search = $_GET['search'];
		$search = preg_replace("#[^a-z 0-9?!]#i", "", $_GET['search']);
		// run the code if it meet condition
		if(($_GET['search_table']) == "Null" && ($_GET['search'] = "")){
			$msg2 = "Please select where to search";
		}
		if($_GET['search_table'] == "A_and_E"){
			$sqlcommand = "SELECT `id`, `product_name`, `category`, `unit_price`,  `quantity`, `payment_date` AS name FROM `ae_pharm_req` WHERE `product_name` LIKE '%$search%'";
			$query = mysqli_query($dbconnect, $sqlcommand) or die (mysqli_error($dbconnect));
			$count = mysqli_num_rows($query);
			if ($count > 0){
				while($row2=mysqli_fetch_array($query)){
					$product_id=$row2["id"];
					$product_name=$row2["product_name"];
					$category=$row2["category"];
					$product_price=$row2["unit_price"];
					$quantity=$row2["quantity"];
		
					
					$search_results .= "<tr>";
					$search_results .= "<td style='background-color:#CECECE; font-family: Adobe Heiti Std R; padding-left: 5px; width: 5%'>" . $product_id . "</td>";
					$search_results .= "<td style='background-color:#CECECE; font-family: Adobe Heiti Std R; padding-left: 5px; width: 20%'>" . $product_name . "</td>";
					$search_results .= "<td style='background-color:#CECECE; font-family: Adobe Heiti Std R; padding-left: 5px; width: 40%'>" . $category . "</td>";
					$search_results .= "<td style='background-color:#CECECE; font-family: Adobe Heiti Std R; padding-left: 5px; width: 10%'>" . $product_price . "</td>";
					$search_results .= "<td style='background-color:#CECECE; font-family: Adobe Heiti Std R; padding-left: 5px; width: 10%'>" . $quantity . "</td>";
					$search_results .= "</tr>";
		            $search_result = "<h1>".$_GET['search_table']."</h1>";
					$msg2 = "<p style='color: green; font-size: 18px; margin-left: 5px'>$count results found for <b>".$search." ". "</b>in"." " .$_GET["search_table"]."</p>";

			    } // close the while loop
			} else {
				$msg2 = "<p style='color: #880000; font-size: 18px; margin-left: 5px'>No result found for <b>".$search." ". "</b>in"." " .$_GET["search_table"]."</p>";
			}
		} else if($_GET['search_table'] == "Pharmacy_Store"){
			$sqlcommand = "SELECT `product_id`, `product_name`, `category`, `price`, `quantity_available`, `date_added` AS name FROM `products` WHERE `product_name` LIKE '%$search%'";
			$query = mysqli_query($dbconnect, $sqlcommand) or die (mysqli_error($dbconnect));
			$count = mysqli_num_rows($query);
			if ($count > 0){
				while($row2=mysqli_fetch_array($query)){
					$product_id=$row2["product_id"];
					$product_name=$row2["product_name"];
					$category=$row2["category"];
					$product_price=$row2["price"];
					$quantity_available=$row2["quantity_available"];
					
					$search_results .= "<tr>";
					$search_results .= "<td style='background-color:#CECECE; font-family: Adobe Heiti Std R; padding-left: 5px; width: 5%'>" . $product_id . "</td>";
					$search_results .= "<td style='background-color:#CECECE; font-family: Adobe Heiti Std R; padding-left: 5px; width: 20%'>" . $product_name . "</td>";
					$search_results .= "<td style='background-color:#CECECE; font-family: Adobe Heiti Std R; padding-left: 5px; width: 40%'>" . $category . "</td>";
					$search_results .= "<td style='background-color:#CECECE; font-family: Adobe Heiti Std R; padding-left: 5px; width: 10%'>" . $product_price . "</td>";
					$search_results .= "<td style='background-color:#CECECE; font-family: Adobe Heiti Std R; padding-left: 5px; width: 10%'>" . $quantity_available . "</td>";
					$search_results .= "</tr>";
					$search_result = "<h1>".$_GET['search_table']."</h1>";
					$msg2 = "<p style='color: green; font-size: 18px; margin-left: 5px'>$count results found for <b>".$search." ". "</b>in"." " .$_GET["search_table"]."</p>";

			    } // close the while loop
			} else {
				$msg2 = "<p style='color: #880000; font-size: 18px; margin-left: 5px'>No result found for <b>".$search." ". "</b>in"." " .$_GET["search_table"]."</p>";
			}
		} else if ($_GET['search_table'] == "MOPD"){
			$sqlcommand = "SELECT `id`, `product_name`, `category`, `unit_price`, `quantity`, `date_added` AS name FROM `mopd_pharm_req` WHERE `product_name` LIKE '%$search%'";
			$query = mysqli_query($dbconnect, $sqlcommand) or die (mysqli_error($dbconnect));
			$count = mysqli_num_rows($query);
			if ($count > 0){
				while($row2=mysqli_fetch_array($query)){
					$product_id=$row2["id"];
					$product_name=$row2["product_name"];
					$category=$row2["category"];
					$product_price=$row2["unit_price"];
					$quantity=$row2["quantity"];
		
					$search_results .= "<tr>";
					$search_results .= "<td style='background-color:#CECECE; font-family: Adobe Heiti Std R; padding-left: 5px; width: 5%'>" . $product_id . "</td>";
					$search_results .= "<td style='background-color:#CECECE; font-family: Adobe Heiti Std R; padding-left: 5px; width: 20%'>" . $product_name . "</td>";
					$search_results .= "<td style='background-color:#CECECE; font-family: Adobe Heiti Std R; padding-left: 5px; width: 40%'>" . $category . "</td>";
					$search_results .= "<td style='background-color:#CECECE; font-family: Adobe Heiti Std R; padding-left: 5px; width: 10%'>" . $product_price . "</td>";
					$search_results .= "<td style='background-color:#CECECE; font-family: Adobe Heiti Std R; padding-left: 5px; width: 10%'>" . $quantity . "</td>";
					$search_results .= "</tr>";
		            $search_result = "<h1>".$_GET['search_table']."</h1>";
					$msg2 = "<p style='color: green; font-size: 18px; margin-left: 5px'>$count results found for <b>".$search." ". "</b>in"." " .$_GET["search_table"]."</p>";

			    } // close the while loop
			} else {
				$msg2 = "<p style='color: #880000; font-size: 18px; margin-left: 5px'>No result found for <b>".$search." ". "</b>in"." " .$_GET["search_table"]."</p>";
			}
		} else if ($_GET['search_table'] == "COPD"){
			$sqlcommand = "SELECT `id`, `product_name`, `category`, `unit_price`, `quantity`, `date_added` AS name FROM `copd_pharm_req` WHERE `product_name` LIKE '%$search%'";
			$query = mysqli_query($dbconnect, $sqlcommand) or die (mysqli_error($dbconnect));
			$count = mysqli_num_rows($query);
			if ($count > 0){
				while($row2=mysqli_fetch_array($query)){
					$product_id=$row2["id"];
					$product_name=$row2["product_name"];
					$category=$row2["category"];
					$product_price=$row2["unit_price"];
					$quantity=$row2["quantity"];
		
					$search_results .= "<tr>";
					$search_results .= "<td style='background-color:#CECECE; font-family: Adobe Heiti Std R; padding-left: 5px; width: 5%'>" . $product_id . "</td>";
					$search_results .= "<td style='background-color:#CECECE; font-family: Adobe Heiti Std R; padding-left: 5px; width: 20%'>" . $product_name . "</td>";
					$search_results .= "<td style='background-color:#CECECE; font-family: Adobe Heiti Std R; padding-left: 5px; width: 40%'>" . $category . "</td>";
					$search_results .= "<td style='background-color:#CECECE; font-family: Adobe Heiti Std R; padding-left: 5px; width: 10%'>" . $product_price . "</td>";
					$search_results .= "<td style='background-color:#CECECE; font-family: Adobe Heiti Std R; padding-left: 5px; width: 10%'>" . $quantity . "</td>";
					$search_results .= "</tr>";
		            $search_result = "<h1>".$_GET['search_table']."</h1>";
					$msg2 = "<p style='color: green; font-size: 18px; margin-left: 5px'>$count results found for <b>".$search." ". "</b>in"." " .$_GET["search_table"]."</p>";

			    } // close the while loop
			} else {
				$msg2 = "<p style='color: #880000; font-size: 18px; margin-left: 5px'>No result found for <b>".$search." ". "</b>in"." " .$_GET["search_table"]."</p>";
			}
		} else if ($_GET['search_table'] == "IPD"){
			$sqlcommand = "SELECT `id`, `product_name`, `category`, `unit_price`, `quantity`, `date_added` AS name FROM `ipd_pharm_req` WHERE `product_name` LIKE '%$search%'";
			$query = mysqli_query($dbconnect, $sqlcommand) or die (mysqli_error($dbconnect));
			$count = mysqli_num_rows($query);
			if ($count > 0){
				while($row2=mysqli_fetch_array($query)){
					$product_id=$row2["id"];
					$product_name=$row2["product_name"];
					$category=$row2["category"];
					$product_price=$row2["unit_price"];
					$quantity=$row2["quantity"];
		
					$search_results .= "<tr>";
					$search_results .= "<td style='background-color:#CECECE; font-family: Adobe Heiti Std R; padding-left: 5px; width: 5%'>" . $product_id . "</td>";
					$search_results .= "<td style='background-color:#CECECE; font-family: Adobe Heiti Std R; padding-left: 5px; width: 20%'>" . $product_name . "</td>";
					$search_results .= "<td style='background-color:#CECECE; font-family: Adobe Heiti Std R; padding-left: 5px; width: 40%'>" . $category . "</td>";
					$search_results .= "<td style='background-color:#CECECE; font-family: Adobe Heiti Std R; padding-left: 5px; width: 10%'>" . $product_price . "</td>";
					$search_results .= "<td style='background-color:#CECECE; font-family: Adobe Heiti Std R; padding-left: 5px; width: 10%'>" . $quantity . "</td>";
					$search_results .= "</tr>";
		            $search_result = "<h1>".$_GET['search_table']."</h1>";
					$msg2 = "<p style='color: green; font-size: 18px; margin-left: 5px'>$count results found for <b>".$search." ". "</b>in"." " .$_GET["search_table"]."</p>";

			    } // close the while loop
			} else {
				$msg2 = "<p style='color: #880000; font-size: 18px; margin-left: 5px'>No result found for <b>".$search." ". "</b>in"." " .$_GET["search_table"]."</p>";
			}
		} else if ($_GET['search_table'] == "MCH"){
			$sqlcommand = "SELECT `id`, `product_name`, `category`, `unit_price`, `quantity`, `date_added` AS name FROM `pead_pharm_req` WHERE `product_name` LIKE '%$search%'";
			$query = mysqli_query($dbconnect, $sqlcommand) or die (mysqli_error($dbconnect));
			$count = mysqli_num_rows($query);
			if ($count > 0){
				while($row2=mysqli_fetch_array($query)){
					$product_id=$row2["id"];
					$product_name=$row2["product_name"];
					$category=$row2["category"];
					$product_price=$row2["unit_price"];
					$quantity=$row2["quantity"];
		
					$search_results .= "<tr>";
					$search_results .= "<td style='background-color:#CECECE; font-family: Adobe Heiti Std R; padding-left: 5px; width: 5%'>" . $product_id . "</td>";
					$search_results .= "<td style='background-color:#CECECE; font-family: Adobe Heiti Std R; padding-left: 5px; width: 20%'>" . $product_name . "</td>";
					$search_results .= "<td style='background-color:#CECECE; font-family: Adobe Heiti Std R; padding-left: 5px; width: 40%'>" . $category . "</td>";
					$search_results .= "<td style='background-color:#CECECE; font-family: Adobe Heiti Std R; padding-left: 5px; width: 10%'>" . $product_price . "</td>";
					$search_results .= "<td style='background-color:#CECECE; font-family: Adobe Heiti Std R; padding-left: 5px; width: 10%'>" . $quantity . "</td>";
					$search_results .= "</tr>";
		            $search_result = "<h1>".$_GET['search_table']."</h1>";
					$msg2 = "<p style='color: green; font-size: 18px; margin-left: 5px'>$count results found for <b>".$search." ". "</b>in"." " .$_GET["search_table"]."</p>";

			    } // close the while loop
			} else {
				$msg2 = "<p style='color: #880000; font-size: 18px; margin-left: 5px'>No result found for <b>".$search." ". "</b>in"." " .$_GET["search_table"]."</p>";
			}
	} else {
		$msg2 = "<p style='color: #880000; font-size: 18px; margin-left: 5px'>No result found for <b>empty search</b></p>";
	}
	}
}

?>

<!doctype html>
<html>
<link href="http://localhost/buth_net/pharmacySection/css/buth_net.css" rel="stylesheet" type="text/css">
<head>
<meta charset="utf-8">
<link rel="shortcut icon" href="/favicon.ico" >
<title>Welcome Client</title>
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
	   <h1 style='text-align: center; font-family: tahoma; font-size: 16px; text-transform: uppercase; font-weight: bold; background-color: #000000; color: #CECECE'>Welcome! <?php echo $name."!"; ?> What would you like to do today?</h1>
	     <h2 style='margin-left: 0px; font-family: Calibri (Body); font-size: 22px; font-weight: bold; text-transform: uppercase; font-style: normal; color: #880000; text-shadow: 0 1px 0 #ccc,0 2px 0 #c9c9c9,0 3px 0 #bbb,0 4px 0 #b9b9b9,0 5px 0 #aaa,0 6px 1px rgba(0,0,0,.1),0 0 5px rgba(0,0,0,.1),0 1px 3px rgba(0,0,0,.3),0 3px 5px rgba(0,0,0,.2),0 5px 10px rgba(0,0,0,.25),0 10px 10px rgba(0,0,0,.2),0 20px 20px rgba(0,0,0,.15)'>Available Stocks</h2>
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
	 <div id="search_form">
	   <hr style='width: 800px;  height: 3px; background-color: #14BCEB'><br>
	  <table width="760px" style="margin-left: auto; margin-right: auto" cellpadding="0" cellspacing="0" border="1">
	   <tr>
	    <td width="5%" style='background-color:#C5DFFA; font-family: arial black; text-align: center; font-size: 14px'><b>ID</b></td>
		<td width="24%" style='background-color:#C5DFFA; font-family: arial black; text-align: center; font-size: 14px'><b>Name</b></td>
		<td width="37%" style='background-color:#C5DFFA; font-family: arial black; text-align: center; font-size: 14px'><b>Category</b></td>
		<td width="12%" style='background-color:#C5DFFA; font-family: arial black; text-align: center; font-size: 14px'><b>Selling Price</b></td>
		<td width="20%" style='background-color:#C5DFFA; font-family: arial black; text-align: center; font-size: 14px'><b>Qty Available</b></td>
		</tr>
		<?php echo $msg2; ?>
		<?php echo $search_result; ?>
		<?php echo $search_results; ?>
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