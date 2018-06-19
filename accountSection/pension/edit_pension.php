<?php 
session_start();
ob_start();
// error display configuration
error_reporting(E_ALL & ~E_NOTICE);

if(!isset($_SESSION['emaill'])){
	header('location: pension_login.php');
}
//This block grabs the whole list for viewing
$msg="";
$email= $_SESSION['emaill'];
include "../dbconnect2.php";
$sql="SELECT first_name, id FROM `pension_login` WHERE `emailAdd`='$email' LIMIT 1";
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



// edit item for staff

// parse the form data and add the inventory to the system
$search_results = "";
$msg2 = "";
$staff_id = "";
$basic = "";
$housing = "";
$trans = "";
$date = "";
$per = "";
$total = "";
$per_total = "";
if (isset($_GET['searchbtn'])){
	if (isset($_GET['search2']) && $_GET['search2'] != ""){
		// filter the inputs
		$search = $_GET['search2'];
		$choose_year = $_GET['choose_year'];
		$sqlcommand2 = "SELECT `staff_id`, `basic`, `housing`, `transport`, `date`, `percentage`, `total`, `per_total`, `id` FROM `pension_form` WHERE `staff_id`='$search' AND `date` LIKE '%$choose_year%'";
		$query = mysqli_query($dbconnect, $sqlcommand2) or die (mysqli_error($dbconnect));
		$count = mysqli_num_rows($query);
		if ($count > 0){
			while($row2=mysqli_fetch_assoc($query)){
				$staff_id = $row2["staff_id"];
				$basic=$row2["basic"];
				$housing=$row2["housing"];
				$trans=$row2["transport"];
				$date=$row2["date"];
				$per=$row2["percentage"];
				$total=$row2["total"];
				$per_total=$row2["per_total"];
				
				$search_results .= "<hr><h3 style='color: brown; font-size: 22px; font-style: normal; text-align: center; font-family: monospace'>Edit Account For $staff_id In $date<h3>";
				$search_results .= '<form action="" method="POST">';
				$search_results .= '<table width="500px" style="margin-left: auto; margin-right: auto;" cellpadding="7" cellspacing="0" border="1">';
				$search_results .= "<tr>";
				$search_results .= "<td style='background-color:#C5DFFA; width: 30%; font-family: Adobe Heiti Std R; padding-left: 20px; font-size: 16px'><b>Staff ID</b></td>";
				$search_results .= '<td style="background-color:#C5DFFA; width: 70%"><input type="text" id="userarea" style="margin-left: 0px; width: 318px" disabled="disabled" name="staff_id" value="'.$staff_id.'"></td>';
				$search_results .= "</tr>";
				$search_results .= "<tr>";
				$search_results .= "<td style='background-color:#C5DFFA; width: 30%; font-family: Adobe Heiti Std R; padding-left: 20px; font-size: 16px'><b>Basic N</b></td>";
				$search_results .= '<td style="background-color:#C5DFFA; width: 70%"><input type="text" id="userarea" style="margin-left: 0px; width: 318px" name="basic" value="'.$basic.'"></td>';
				$search_results .= "</tr>";
				$search_results .= "<tr>";
				$search_results .= "<td style='background-color:#C5DFFA; width: 30%; font-family: Adobe Heiti Std R; padding-left: 20px;  font-size: 16px'><b>Housing N</b></td>";
				$search_results .= '<td style="background-color:#C5DFFA; width: 70%"><input type="text" id="userarea" style="margin-left: 0px; width: 318px" name="housing" value="'.$housing.'"></td>';
				$search_results .= "</tr>";
				$search_results .= "<tr>";
				$search_results .= "<td style='background-color:#C5DFFA; width: 30%; font-family: Adobe Heiti Std R; padding-left: 20px;  font-size: 16px'><b>Transport N</b></td>";
				$search_results .= '<td style="background-color:#C5DFFA; width: 70%"><input type="text" id="userarea" style="margin-left: 0px; width: 318px" name="trans" value="'.$trans.'"></td>';
				$search_results .= "</tr>";
				$search_results .= "<tr>";
				$search_results .= "<td style='background-color:#C5DFFA; width: 30%; font-family: Adobe Heiti Std R; padding-left: 20px;  font-size: 16px'><b>Date</b></td>";
				$search_results .= '<td style="background-color:#C5DFFA; width: 70%"><input type="text" id="userarea" style="margin-left: 0px; width: 318px" name="date" value="'.$date.'"></td>'; 
				$search_results .= "</tr>";
				$search_results .= "<tr>";
				$search_results .= "<td style='background-color:#C5DFFA; width: 30%; font-family: Adobe Heiti Std R; padding-left: 20px;  font-size: 16px'><b>Percentage</b></td>";
				$search_results .= '<td style="background-color:#C5DFFA; width: 70%"><input type="text" id="userarea" style="margin-left: 0px; width: 318px" name="per" value="'.$per.'"></td>';
				$search_results .= "</tr>";
				$search_results .= "<tr>";
				$search_results .= "<td style='background-color:#C5DFFA; width: 30%; font-family: Adobe Heiti Std R; padding-left: 20px;  font-size: 16px'><b>Percentage Total</b></td>";
				$search_results .= '<td style="background-color:#C5DFFA; width: 70%"><input type="text" id="userarea" style="margin-left: 0px; width: 318px" name="per_total" value="'.$per_total.'"></td>'; 
				$search_results .= "</tr>";
				$search_results .= "<tr>";
				$search_results .= "<td style='background-color:#C5DFFA; width: 30%; font-family: Adobe Heiti Std R; padding-left: 20px;  font-size: 16px'><b>Total N</b></td>";
				$search_results .= '<td style="background-color:#C5DFFA; width: 70%"><input type="text" id="userarea" style="margin-left: 0px; width: 318px" name="total" value="'.$total.'"></td>'; 
				$search_results .= "</tr>";
				$search_results .= "</table><br>";
	            $search_results .= '<center><input type="submit" class="submit4" value="Update" name="update"></center>';
				$search_results .= '</form>';
				?><style type="text/css">.search_angle{
					display: none
				}
				</style><?php
				
			} // close the while loop
		} else {
			?><script type="text/javascript">
			alert ('No result found for <?php echo $search . " " . "in" . " " . $choose_year ; ?>');
			windows.locaton = 'edit_pension.php';
			</script><?php
		}
	} else {
		?><script type="text/javascript">
		alert ('field should not be empty');
		windows.locaton = 'edit_pension.php';
		</script><?php
	}
	
}
if (isset($_POST['update']))
{
	$basic = htmlspecialchars(trim($_POST['basic']));
	$housing = htmlspecialchars(trim($_POST['housing']));
	$trans = htmlspecialchars(trim($_POST['trans']));
	$per = htmlspecialchars(trim($_POST['per']));
	$date = htmlspecialchars($_POST['date']);
	$total = $basic + $housing + $trans;
	$percentage = $total * $per / "100";

	$sql5 = "UPDATE pension_form SET `basic`='$basic', `housing`='$housing', `transport`='$trans', `date`='$date', `percentage`='$per', `total`='$total', `per_total`='$percentage' WHERE `date`='".$date."' AND staff_id = '".$staff_id."' LIMIT 1";
	$check5 = mysqli_query($dbconnect, $sql5) or die (mysqli_error($dbconnect));
	$msg = '<p style = "color: #4F8A10; margin-right: auto; margin-right: auto; text-align: center; background-color: #DFF2BF; border-radius:.5em; width: 400px; border: 1px solid #D8D8D8; margin-left: auto; margin-right: auto; padding: 5px; border-radius: 5px; font-family: Arial; font-size: 11px; text-transform: uppercase; text-transform: uppercase">Operation Successful</p>';
	//header ("refresh:4; url=edit_pension.php"); // wait for 3 secs before redirect
}

?>
<!doctype html>
<html>
<link href="http://localhost/buth_net/pharmacySection/css/buth_net.css" rel="stylesheet" type="text/css">
<head>
<meta charset="utf-8">
<link rel="shortcut icon" href="/favicon.ico" >
<title>Staff|<?php if (isset($_GET['searchbtn'])){ echo $staff_id;} ?></title>
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
	  <li><a href="pension_home.php">Pension List</a></li><br>
	  <li><a href="edit_pension.php">Edit Pension List</a></li><br>
	  <li><a href="individual_pension.php">Individual Pension List</a></li><br>
	  <li><a href="all_pension.php">All Pension List</a></li><br>
	  <li><a href="../acc_logout.php">Logout</a></li><br>
    </ul>
	<?php include_once($_SERVER['DOCUMENT_ROOT'].'../buth_net/new_bar.php'); ?>
      <!-- end .sidebar1 --></div>
     <div class="margin" id="content">
	  <div class="search_angle">
			<center><h3 class="heading_text">Edit pension list</h3></center><br>
			<center><img src="../images/payment2.jpg" alt="search_angle" width="500px" height="200px"></center><br>
			<div class="search">
			<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET">
			<center><input type="text" name="search2" id="search2"  maxlength="20" placeholder="Enter staff id"><br><br></center>
			<center><select name="choose_year" class="user" style="width: 200px">
				 <option value="null">Choose Year</option>
				 <option value="1990">1990</option>
				 <option value="1991">1991</option>
				 <option value="1992">1992</option>
				 <option value="1993">1993</option>
				 <option value="1994">1994</option>
				 <option value="1995">1995</option>
				 <option value="1996">1996</option>
				 <option value="1997">1997</option>
				 <option value="1998">1998</option>
				 <option value="1999">1999</option>
				 <option value="2000">2000</option>
				 <option value="2001">2001</option>
				 <option value="2002">2002</option>
				 <option value="2003">2003</option>
				 <option value="2004">2004</option>
				 <option value="2005">2005</option>
				 <option value="2006">2006</option>
				 <option value="2007">2007</option>
				 <option value="2008">2008</option>
				 <option value="2009">2009</option>
				 <option value="2010">2010</option>
				 <option value="2011">2011</option>
				 <option value="2012">2012</option>
				 <option value="2013">2013</option>
				 <option value="2014">2014</option>
				 <option value="2015">2015</option>
				 <option value="2016">2016</option>
				 <option value="2000">2017</option>
				 <option value="2001">2018</option>
				 <option value="2002">2019</option>
				 <option value="2003">2020</option>
				 <option value="2004">2021</option>
				 <option value="2005">2022</option>
				 <option value="2006">2023</option>
				 <option value="2007">2024</option>
				 <option value="2008">2025</option>
				 <option value="2009">2026</option>
				 <option value="2010">2027</option>
				 <option value="2011">2028</option>
				 <option value="2012">2029</option>
				 <option value="2013">2030</option>
			 </select></center><br>
			<center><input type="submit" value="search" name="searchbtn" class="submit4"></center>
		 </form><br>
		 </div>
	   </div>
		  <div id="patient_form">
		<?php echo $msg; ?>
		<?php echo $search_results; ?>
		</div><br><br>
			   <!-- end .content --></div>
			  <!-- end .container --></div>
     <?php
      include_once "../footer.php";
     ?>
</body>
</html>