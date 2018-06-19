<?php
session_start();
ob_start();
// error display configuration
error_reporting(E_ALL & ~E_NOTICE);

if(!isset($_SESSION['emaill'])){
	header('location: adminlogin.php');
}
//This block grabs the whole list for viewing
$msg="";
$email= $_SESSION['emaill'];
include "dbconnect.php";
$sql="SELECT * FROM `nursing_admin` WHERE `admin_email`='$email' LIMIT 1";
$check = mysqli_query($dbconnect, $sql);
$resultCount=mysqli_num_rows($check); //count the out amount 
if($resultCount>0){
	while($row=mysqli_fetch_array($check)){
	$name=$row["name"];
	}
}else{
$msg="<p style='color: red; text-align: center'>You have no Information yet in the Database</p>";
}

$msg2 = "";
$results = "";
// see if the posted search query field is set and has a value
if (isset($_GET['query'])){
		// filter the inputs
		$students = $_GET['query'];
		$sqlcommand2 = "SELECT * FROM `sono` WHERE `studentid` LIKE '%$students%'";
		$query = mysqli_query($dbconnect, $sqlcommand2) or die (mysqli_error($dbconnect));
		$count = mysqli_num_rows($query);
		if ($count > 0){
			while($row2=mysqli_fetch_array($query)){
				$student_id=$row2["studentid"];
				$surname=$row2["surName"];
				$firstname=$row2["firstName"];
				$othername=$row2["otherName"];
				$sex=$row2["sex"];
				$phoneNo=$row2["phoneNo"];
				$dob=$row2["DateofBirth"];
				
			
				
				$results .= "<tr>";
				$results .= "<td style='font-family: Adobe Heiti Std R; font-size: 9px; border: 1px dashed #000000'>BUTH/SON/" .$student_id . "</td>";
				$results .= "<td style='text-align: center; font-family: Adobe Heiti Std R; font-size: 9px; border: 1px dashed #000000'>".$surname . "</td>";
				$results .= "<td style='text-align: center; font-family: Adobe Heiti Std R; font-size: 9px; border: 1px dashed #000000'>".$firstname . "</td>";
				$results .= "<td style='text-align: center; font-family: Adobe Heiti Std R; font-size: 9px; border: 1px dashed #000000'>" .$othername . "</td>";
				$results .= "<td style='text-align: center; font-family: Adobe Heiti Std R; font-size: 9px; border: 1px dashed #000000'>" .$sex . "</td>";
				$results .= "<td style='text-align: center; font-family: Adobe Heiti Std R; font-size: 9px; border: 1px dashed #000000'>" .$dob . "</td>";
				$results .= "<td style='text-align: center; font-family: Adobe Heiti Std R; font-size: 9px; border: 1px dashed #000000'>".$phoneNo . "</td>";
				$results .= "</tr>";
			
			
				
			} // close the while loop
		} else {
			?><script type="text/javascript">
			alert ('No result found for <?php echo $search; ?>');
			windows.locaton = 'viewstudents.php';
			</script><?php
		}
	} else {
		?><script type="text/javascript">
		alert ('field should not be empty');
		windows.locaton = 'viewstudents.php';
		</script><?php
	}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link rel="shortcut icon" href="/favicon.ico" >
<title>Students data for <?php echo $students; ?></title>
</head>
<body>
<div id="requisition_receipt" style="width: 800px; min-height: 300px; margin-left: auto; margin-right: auto">
 <h1 style="text-align: center; font-size: 20px; font-family: arial;">School of Nursing<br>Bowen University Teaching Hospital , Ogbomoso</h1>
 <p style="text-align: center; font-size: 16px; font-family: monospace">Student data for <?php echo $students; ?></p>
 <p style="font-family: Calibri (Body); font-weight: bold; font-size: 11px; margin-left: 20px; float: left"><?php echo date("l jS \of F Y"). "," . " " . date('H:i:s'); ?></p>
	  <table width="760px" style="margin-left: auto; margin-right: auto" cellpadding="0" cellspacing="0" border="0">
	   <tr>
	    <td width="20%" style='font-family: arial black;  font-size: 9px; border: 1px dashed #000000'><b>Student Reg No</b></td>
		<td width="15%" style='font-family: arial black; text-align: center; font-size: 9px; border: 1px dashed #000000'><b>Surname</b></td>
		<td width="15%" style='font-family: arial black; text-align: center; font-size: 9px; border: 1px dashed #000000'><b>First Name</b></td>
		<td width="15%" style='font-family: arial black; text-align: center; font-size: 9px; border: 1px dashed #000000'><b>Other Names</b></td>
		<td width="10%" style='font-family: arial black; text-align: center; font-size: 9px; border: 1px dashed #000000'><b>Sex</b></td>
		<td width="10%" style='font-family: arial black; text-align: center; font-size: 9px; border: 1px dashed #000000'><b>Date of Birth</b></td>
		<td width="15%" style='font-family: arial black; text-align: center; font-size: 9px; border: 1px dashed #000000'><b>Phone No</b></td>
		</tr>
		<?php echo $results; ?>
		<!--tr>
		 <td>&nbsp;</td>
		 <td>&nbsp;</td>
		 <td>&nbsp;</td>
		 <td>&nbsp;</td>
		 <td>&nbsp;</td>
		</tr-->
		</table><br><br>
		</div>
</body>
</html>