<?php 
session_start();
ob_start();
// error display configuration


if(!isset($_SESSION['emaill'])){
	header('location: mopd_login.php');
}
//This block grabs the whole list for viewing
$msg="";
$email= $_SESSION['emaill'];
include "dbconnect2.php";
$sql="SELECT * FROM `mopd_login` WHERE `emailAdd`='$email' LIMIT 1";
$check = mysqli_query($dbconnect, $sql);
$resultCount=mysqli_num_rows($check); //count the out amount 
if($resultCount>0){
	while($row=mysqli_fetch_array($check)){
	$id=$row["id"];
	$password=$row["passWord"];
	$name=$row["first_name"];
	}
}else{
$msg="<p style'color: #D8000C; background-color: #FFBABA; border-radius:.5em; width: 300px; border: 1px solid #D8D8D8; padding: 5px; border-radius: 5px; margin-left: auto; margin-right: auto; font-family: Arial; font-size: 11px; text-transform: uppercase; text-align: center; text-transform: uppercase'You have no Information yet in the Database</p>";
}
?>
<?php
include "dbconnect2.php";
$search_results = "";
$msg2 = "";
// see if the posted search query field is set and has a value
if (isset($_POST['searchbtn'])){
	if (isset($_POST['search']) && $_POST['search'] != ""){
		// filter the inputs
		$search = $_POST['search'];
		$search = preg_replace("#[^a-z 0-9?!]#i", "", $_POST['search']);
		
		$sqlcommand = "SELECT `id`, `product_name`, `category`, `unit_price`, `drug_type`, `date_added`, `quantity` AS name FROM `mopd_pharm_req` WHERE `product_name` LIKE '%$search%' OR `category` LIKE '%$search%'";
		$query = mysqli_query($dbconnect, $sqlcommand) or die (mysqli_error($dbconnect));
		$count = mysqli_num_rows($query);
		if ($count > 0){
			while($row2=mysqli_fetch_array($query)){
				$product_id=$row2["id"];
				$product_name=$row2["product_name"];
				$category=$row2["category"];
				$product_price=$row2["unit_price"];
				$date_added=$row2["date_added"];
				$drug_type=$row2["drug_type"];
	
				$search_results .= "<tr>";
				$search_results .= "<td style='background-color:#CECECE; font-family: Adobe Heiti Std R; padding-left: 5px; width: 5%'>" . $product_id . "</td>";
				$search_results .= "<td style='background-color:#CECECE; font-family: Adobe Heiti Std R;padding-left: 5px; width: 20%'>" . $product_name . "</td>";
				$search_results .= "<td style='background-color:#CECECE; font-family: Adobe Heiti Std R; padding-left: 5px; width: 40%'>" . $category . "</td>";
				$search_results .= "<td style='background-color:#CECECE; font-family: Adobe Heiti Std R; padding-left: 5px; width: 40%'>" . $drug_type . "</td>";
				$search_results .= "<td style='background-color:#CECECE; font-family: Adobe Heiti Std R;padding-left: 5px; width: 10%'>" . $product_price . "</td>";
				$search_results .= "<td style='background-color:#CECECE; font-family: Adobe Heiti Std R;padding-left: 5px; width: 10%'>" . $date_added . "</td>";
				$search_results .= "<td style='background-color:#CECECE; font-family: Adobe Heiti Std R;padding-left: 5px; width: 15%'>" . "<a href='mopd_products.php?product_id=$product_id' style='font-style: normal; font-family: Adobe Heiti Std R; color: #880000'>View Details</a></td>";
				$search_results .= "</tr>"; 
				$msg2 = "<p style='color: green; font-size: 18px; margin-left: 5px'>$count results found for <b>$search</b></p>";

			} // close the while loop
		} else {
			$msg2 = "<p style='color: #880000; font-size: 18px; margin-left: 5px'>No result found for <b>$search</b></p>";
	}
		if ($count === 1){
			$msg2 = "<p style='color: green; font-size: 18px; margin-left: 5px'>$count result found for <b>$search</b></p>";
		}
} else {
	$msg2 = "<p style='color: #880000; font-size: 18px; margin-left: 5px'>No result found for <b>empty search</b></p>";
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
	  <li class="page_title">Pharmacy Unit</li><br>
	  <li><a href="index.php">Main Page</a></li><br>
      <li><a href="mopd_dashboard.php">Drugs</a></li><br>
      <li><a href="mopd_cart.php">Billing</a></li><br>
      <li><a href="logout.php">Logout</a></li><br>
    </ul>
	 <img src="images/drugs.png" width="170px" height="250px" style="margin-left: 20px" alt="Welcome To School of Nursing"><br><br>
	 <?php include_once "../new_bar.php"; ?>
      <!-- end .sidebar1 --></div>
     <div class="margin" id="content">
	  <div class="welcome_message">
	   <h1 style='text-align: center; font-family: tahoma; font-size: 16px; text-transform: uppercase; font-weight: bold; background-color: #000000; color: #CECECE'>Welcome <?php echo $name."!"; ?> What would you like to do today?</h1>
	     <h2 style='margin-left: 0px; font-family: Calibri (Body); font-size: 22px; font-weight: bold; text-transform: uppercase; font-style: normal; color: #880000; text-shadow: 0 1px 0 #ccc,0 2px 0 #c9c9c9,0 3px 0 #bbb,0 4px 0 #b9b9b9,0 5px 0 #aaa,0 6px 1px rgba(0,0,0,.1),0 0 5px rgba(0,0,0,.1),0 1px 3px rgba(0,0,0,.3),0 3px 5px rgba(0,0,0,.2),0 5px 10px rgba(0,0,0,.25),0 10px 10px rgba(0,0,0,.2),0 20px 20px rgba(0,0,0,.15)'>Available Stocks</h2>
		 <div class="search" style="float: right; margin-right: 20px">
		 <form action="mopd_search.php" method="post">
		 <input type="text" name="search" id="search" maxlength="88" placeholder="Search by name or category...">
		 <input type="submit" value="Search" name="searchbtn" id="searchbtn">
		 </form>
		</div>
	   </div>
	 <div id="search_form">
	   <hr style='width: 800px;  height: 3px; background-color: #14BCEB'><br>
	  <table width="760px" style="margin-left: auto; margin-right: auto" cellpadding="0" cellspacing="0" border="1">
	   <tr>
	    <td width="5%" style='background-color:#C5DFFA; font-family: arial black; text-align: center; font-size: 14px'><b>ID</b></td>
		<td width="18%" style='background-color:#C5DFFA; font-family: arial black; text-align: center; font-size: 14px'><b>Name</b></td>
		<td width="20%" style='background-color:#C5DFFA; font-family: arial black; text-align: center; font-size: 14px'><b>Category</b></td>
		<td width="10%" style='background-color:#C5DFFA; font-family: arial black; text-align: center; font-size: 14px'><b>Type</b></td>
		<td width="10%" style='background-color:#C5DFFA; font-family: arial black; text-align: center; font-size: 14px'><b>Selling Price</b></td>
		<td width="20%" style='background-color:#C5DFFA; font-family: arial black; text-align: center; font-size: 14px'><b>Date Added</b></td>
		<td width="17%" style='background-color:#C5DFFA; font-family: arial black; text-align: center; font-size: 14px'><b>Drugs Detail</b></td>
		</tr>
		<?php echo $search_results; ?>
	    <?php echo $msg2; ?>
		<!--tr>
		 <td>&nbsp;</td>
		 <td>&nbsp;</td>
		 <td>&nbsp;</td>
		 <td>&nbsp;</td>
		 <td>&nbsp;</td>Prof
		</tr-->
		</table>
		 </div>
	   </div>
	   <!-- end .content --></div>
	  <!-- end .container --></div>
     <?php
      include_once "footer.php";
     ?>
</body>
</html>