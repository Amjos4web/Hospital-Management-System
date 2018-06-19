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

// check the url is set and exit in the database

if (isset($_GET['student_id'])){
	$student_id = $_GET['student_id'];
	// use this var to check if the ID exist in the database, if yes, show the staff details, if no
	// give message
	$sql6 = "SELECT * FROM sono LEFT JOIN sono_nextofkin ON sono.studentid=sono_nextofkin.studentid WHERE sono.studentid='".$student_id."' LIMIT 1";
	$check6 = mysqli_query($dbconnect, $sql6) or die (mysqli_error($dbconnect));
	$resultCount6 = mysqli_num_rows($check6);
	if ($resultCount6>0){
		while($row=mysqli_fetch_array($check6)){
			$studentid=$row["studentid"];
			$surname=$row["surName"];
			$firstname=$row["firstName"];
			$othername=$row["otherName"];
			$sex=$row["sex"];
			$religion=$row["religion"];
			$phoneNo=$row["phoneNo"];
			$marital=$row["marital"];
			$dateofbirth=$row["DateofBirth"];
			$nationality=$row["natioNality"];
			$state=$row["stateoforigin"];
			$hometown=$row["homeTown"];
			$lga=$row["LGA"];
			$postaladdress=$row["postaladdress"];
			$mn=$row["maidenName"];
			$ha=$row["homeAddress"];
			$deno=$row["denoMination"];
			$postal=$row["postaladdress"];
			$kinname=$row["Nameofkin"];
			$kinphone=$row["phoneNo1"];
			$rela=$row["relationship1"];
			$add=$row["address1"];
			$school1 = $row["school1"];
			$from1 = $row["from1"];
			$to1 = $row["to1"];
			$school2 = $row["school2"];
			$from2 = $row["from2"];
			$to2 = $row["to2"];
			$school3 = $row["school3"];
			$from3 = $row["from3"];
			$to3 = $row["to3"];
			$school4 = $row["school4"];
			$from4 = $row["from4"];
			$to4 = $row["to4"];

	
			
			if ($mn == "Null" || $mn == ""){
				?><style type="text/css">.maiden{
					display: none;
				}
				</style><?php
			}
			if ($religion == "Null" || $religion == ""){
				?><style type="text/css">.reli{
					display: none;
				}
				</style><?php
			}
			if ($deno == "Null" || $deno == ""){
				?><style type="text/css">.deno{
					display: none;
				}
				</style><?php
			}
			if ($postal == "Null" || $postal == ""){
				?><style type="text/css">.postal{
					display: none;
				}
				</style><?php
			}
			if ($marital == "Null" || $marital == ""){
				?><style type="text/css">.marital{
					display: none;
				}
				</style><?php
			}
			if ($ha == "Null" || $ha == ""){
				?><style type="text/css">.hom{
					display: none;
				}
				</style><?php
			}
			if ($school1 == "" || $from1 == "Null" || $to1 == "Null" || $cert1 == "Null"){
				?><style type="text/css">.school1{
					display: none;
				}
				.year1{
					display: none;
				}
				.cert1{
					display: none;
				}
				</style><?php
			}
			if ($school2 == "" || $from2 == "Null" || $to2 == "Null" || $cert2 == "Null"){
				?><style type="text/css">.school2{
					display: none;
				}
				.year2{
					display: none;
				}
				.cert2{
					display: none;
				}
				</style><?php
			}
			if ($school3 == "" || $from3 == "Null" || $to3 == "Null" || $cert3 == "Null"){
				?><style type="text/css">.school3{
					display: none;
				}
				.year3{
					display: none;
				}
				.cert3{
					display: none;
				}
				</style><?php
			}
			if ($school4 == "" || $from4 == "Null" || $to4 == "Null" || $cert4 == "Null"){
				?><style type="text/css">.school4{
					display: none;
				}
				.year4{
					display: none;
				}
				.cert4{
					display: none;
				}
				</style><?php
			}
			
			
		}
	} else {
		$msg="<p style='color: #D8000C; background-color: #FFBABA; border-radius:.5em; width: 300px; border: 1px solid #D8D8D8; padding: 5px; border-radius: 5px; margin-left: auto; margin-right: auto; font-family: Arial; font-size: 11px; text-transform: uppercase; text-align: center; text-transform: uppercase'>That staff does not exit. Please try again with another ID</p>";
	}

	
	$sql="SELECT * FROM `sono_0level_results` WHERE `studentid`='$student_id' LIMIT 1";
	$check = mysqli_query($dbconnect, $sql) or die(mysqli_error($dbconnect));
	$resultCount=mysqli_num_rows($check); //count the out amount 
	if($resultCount>0){
		while($row=mysqli_fetch_array($check)){
			$examtype1=$row["examType1"];
			$examtype2=$row["examType2"];
			$examyear1=$row["year1"];
			$examyear2=$row["year2"];
			$studentID=$row["studentid"];
			$subject1=$row["Subject1"];
			$subject2=$row["Subject2"];
			$subject3=$row["Subject3"];
			$subject4=$row["Subject4"];
			$subject5=$row["Subject5"];
			$subject6=$row["Subject6"];
			$subject7=$row["Subject7"];
			$subject8=$row["Subject8"];
			$subject9=$row["Subject9"];
			$subject11=$row["Subject11"];
			$subject22=$row["Subject22"];
			$subject33=$row["Subject33"];
			$subject44=$row["Subject44"];
			$subject55=$row["Subject55"];
			$subject66=$row["Subject66"];
			$subject77=$row["Subject77"];
			$subject88=$row["Subject88"];
			$subject99=$row["Subject99"];
			$grade1=$row["Grade1"];
			$grade2=$row["Grade2"];
			$grade3=$row["Grade3"];
			$grade4=$row["Grade4"];
			$grade5=$row["Grade5"];
			$grade6=$row["Grade6"];
			$grade7=$row["Grade7"];
			$grade8=$row["Grade8"];
			$grade9=$row["Grade9"];
			$grade11=$row["Grade11"];
			$grade22=$row["Grade22"];
			$grade33=$row["Grade33"];
			$grade44=$row["Grade44"];
			$grade55=$row["Grade55"];
			$grade66=$row["Grade66"];
			$grade77=$row["Grade77"];
			$grade88=$row["Grade88"];
			$grade99=$row["Grade99"];
			
			if ($subject11 == "null"){
			?><style type="text/css">.sub11{
				display: none;
			}
			</style><?php
			}
			if ($subject22 == "null"){
				?><style type="text/css">.sub22{
					display: none;
				}
				</style><?php
			}
			if ($subject33 == "null"){
				?><style type="text/css">.sub33{
					display: none;
				}
				</style><?php
			}
			if ($subject44 == "null"){
				?><style type="text/css">.sub44{
					display: none;
				}
				</style><?php
			}
			if ($subject55 == "null"){
				?><style type="text/css">.sub55{
					display: none;
				}
				</style><?php
			}
			if ($subject66 == "null"){
				?><style type="text/css">.sub66{
					display: none;
				}
				</style><?php
			}
			if ($subject77 == "null"){
				?><style type="text/css">.sub77{
					display: none;
				}
				</style><?php
			}
			if ($subject88 == "null"){
				?><style type="text/css">.sub88{
					display: none;
				}
				</style><?php
			}
			if ($subject99 == "null"){
				?><style type="text/css">.sub99{
					display: none;
				}
				</style><?php
			}
			if ($subject1 == "null"){
				?><style type="text/css">.sub1{
					display: none;
				}
				</style><?php
			}
			if ($subject2 == "null"){
				?><style type="text/css">.sub2{
					display: none;
				}
				</style><?php
			}
			if ($subject3 == "null"){
				?><style type="text/css">.sub3{
					display: none;
				}
				</style><?php
			}
			if ($subject4 == "null"){
				?><style type="text/css">.sub4{
					display: none;
				}
				</style><?php
			}
			if ($subject5 == "null"){
				?><style type="text/css">.sub5{
					display: none;
				}
				</style><?php
			}
			if ($subject6 == "null"){
				?><style type="text/css">.sub6{
					display: none;
				}
				</style><?php
			}
			if ($subject7 == "null"){
				?><style type="text/css">.sub7{
					display: none;
				}
				</style><?php
			}
			if ($subject8 == "null"){
				?><style type="text/css">.sub8{
					display: none;
				}
				</style><?php
			}
			if ($subject9 == "null"){
				?><style type="text/css">.sub9{
					display: none;
				}
				</style><?php
			}
			if ($examtype1 == "null" || $examyear1 == "null" || $examyear1 == "0"){
				?><style type="text/css">.type1{
					display: none;
				}
				</style><?php
			}
			if ($examtype2 == "null" || $examyear2 == "null" || $examyear2 == "0"){
				?><style type="text/css">.type2{
					display: none;
				}
				</style><?php
	}
		}
	}else {
		$msg="<p style='color: #D8000C; background-color: #FFBABA; border-radius:.5em; width: 300px; border: 1px solid #D8D8D8; padding: 5px; border-radius: 5px; margin-left: auto; margin-right: auto; font-family: Arial; font-size: 11px; text-transform: uppercase; text-align: center; text-transform: uppercase'>That staff does not exit. Please try again with another ID</p>";
	}
} else {
	$msg= "<p style='color: #D8000C; background-color: #FFBABA; border-radius:.5em; width: 300px; border: 1px solid #D8D8D8; padding: 5px; border-radius: 5px; margin-left: auto; margin-right: auto; font-family: Arial; font-size: 11px; text-transform: uppercase; text-align: center; text-transform: uppercase'>No staff in the system with that ID</p>";
}
?>
<!doctype html>
<html>
<link href="http://localhost/buth_net/nursingSchool/css/buth_net.css" rel="stylesheet" type="text/css">
<head>
<meta charset="utf-8">
<link rel="shortcut icon" href="/favicon.ico" >
<title><?php echo "BUTH/SON/" . $student_id; ?></title>
<script type="text/javascript" src="js/script.js"></script>
<script type="text/javascript" src="js/jquery-1.12.3.min.js"></script>
<script>
$(document).ready(function(){
	$('.result').click(function(){
		$('.res').slideDown(500);
	});
	// $('.result').click(function(){
		// $('.res').slideUp(500);
	// });
});
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
	<li class="page_title">Admin Unit</li><br>
		<li><a href="http://localhost/buth_net/index.php">Main Page</a></li><br>
		<li><a href="viewstudents.php">Homepage</a></li><br>
		<li class="result"><a href="#">View 0'level Results</a></li>
		<li class="res"><a href='necoResult.php?studentid=<?php echo $student_id; ?>' target='_blank'>NECO</a></li>
		<li class="res"><a href='waecResult.php?studentid=<?php echo $student_id; ?>' target='_blank'>WAEC</a></li><br>
		<li><a href='birthCertificate.php?studentid=<?php echo $student_id; ?>' target='_blank'>View Birth Certificate</a></li><br>
		<li><a href='localGov.php?studentid=<?php echo $student_id; ?>' target='_blank'>View Local Gov. Identity</a></li><br>
		<li><a href="logout.php">Logout</a></li><br>
    </ul>
    <!-- end .sidebar1 --></div>
  <div class="margin" id="content">
   <?php echo $msg; ?>
	<div class="product_details">
	<center><h3 class="heading_text" style="width: 400px">Bio Data</h3></center><br>
	 <table width="430px" style="margin-left: auto; margin-right: auto" cellpadding="10"  cellspacing="0" border="1">
		<tr>
	    <td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px; font-size: 14px'><b>Profile Image</b></td>
		<td width="50%" style='background-color:#C5DFFA;'><img src="../nursingSchool/passports/<?php echo $student_id; ?>.jpg" alt="<?php echo $student_id; ?>" width="160px" height="160px" style="border: 1px groove #CECECE; border-radius: 50%; padding-left: 0px; margin-left: 10px;" class="image"></td>
		</tr>
		<tr>
	    <td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px; font-size: 14px'><b>Registration No</b></td>
		<td width="50%" style='background-color:#C5DFFA; font-family: monospace; padding-left: 20px; font-size: 14px'><b><?php echo "BUTH/SON/" . $student_id; ?></b></td>
		</tr>
		<tr>
	    <td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px; font-size: 14px'><b>Surname</b></td>
		<td width="50%" style='background-color:#C5DFFA; font-family: monospace; padding-left: 20px; font-size: 14px'><b><?php echo $surname; ?></b></td>
		</tr>
		<tr>
		<td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px;  font-size: 14px'><b>First Name</b></td>
		<td width="50%" style='background-color:#C5DFFA; font-family: monospace; padding-left: 20px; font-size: 14px'><b><?php echo $firstname; ?></b></td>
		</tr>
		<tr>
		<td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px;  font-size: 14px'><b>Other Names</b></td>
		<td width="50%" style='background-color:#C5DFFA; font-family: monospace; padding-left: 20px; font-size: 14px'><b><?php echo $othername; ?></b></td>
		</tr>
		<tr>
		<tr>
	    <td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px; font-size: 14px'><b>Sex</b></td>
		<td width="50%" style='background-color:#C5DFFA; font-family: monospace; padding-left: 20px; font-size: 14px'><b><?php echo $sex; ?></b></td>
		</tr>
		<tr>
		<td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px;  font-size: 14px'><b>Date Of Birth</b></td>
		<td width="50%" style='background-color:#C5DFFA; font-family: monospace; padding-left: 20px; font-size: 14px'><b><?php echo $dateofbirth; ?></b></td>
		</tr>
		<tr>
	    <td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px; font-size: 14px'><b>Phone No</b></td>
		<td width="50%" style='background-color:#C5DFFA; font-family: monospace; padding-left: 20px; font-size: 14px'><b><?php echo $phoneNo; ?></b></td>
		</tr>
		<tr class="reli">
	    <td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px; font-size: 14px'><b>Religion</b></td>
		<td width="50%" style='background-color:#C5DFFA; font-family: monospace; padding-left: 20px; font-size: 14px'><b><?php echo $religion; ?></b></td>
		</tr>
		<tr class="marital">
	    <td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px; font-size: 14px'><b>Marital Status</b></td>
		<td width="50%" style='background-color:#C5DFFA; font-family: monospace; padding-left: 20px; font-size: 14px'><b><?php echo $marital; ?></b></td>
		</tr>
		<tr class="maiden">
	    <td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px; font-size: 14px'><b>Maiden Name</b></td>
		<td width="50%" style='background-color:#C5DFFA; font-family: monospace; padding-left: 20px; font-size: 14px'><b><?php echo $mn; ?></b></td>
		</tr>
		<tr>
		<td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px;  font-size: 14px'><b>Nationality</b></td>
		<td width="50%" style='background-color:#C5DFFA; font-family: monospace; padding-left: 20px; font-size: 14px'><b><?php echo $nationality; ?></b></td>
		</tr>
		<tr>
	    <td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px; font-size: 14px'><b>State Of Orign</b></td>
		<td width="50%" style='background-color:#C5DFFA; font-family: monospace; padding-left: 20px; font-size: 14px'><b><?php echo $state; ?></b></td>
		</tr>
		<tr>
		<td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px;  font-size: 14px'><b>Home Town</b></td>
		<td width="50%" style='background-color:#C5DFFA; font-family: monospace; padding-left: 20px; font-size: 14px'><b><?php echo $hometown; ?></b></td>
		</tr>
		<tr>
	    <td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px; font-size: 14px'><b>Local Gov. Area</b></td>
		<td width="50%" style='background-color:#C5DFFA; font-family: monospace; padding-left: 20px; font-size: 14px'><b><?php echo $lga; ?></b></td>
		</tr>
		<tr class="home">
	    <td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px; font-size: 14px'><b>Home Address</b></td>
		<td width="50%" style='background-color:#C5DFFA; font-family: monospace; padding-left: 20px; font-size: 14px'><b><?php echo $ha; ?></b></td>
		</tr>
		<tr class="deno">
	    <td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px; font-size: 14px'><b>Denomination</b></td>
		<td width="50%" style='background-color:#C5DFFA; font-family: monospace; padding-left: 20px; font-size: 14px'><b><?php echo $deno; ?></b></td>
		</tr>
		<tr class="postal">
	    <td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px; font-size: 14px'><b>Postal Address</b></td>
		<td width="50%" style='background-color:#C5DFFA; font-family: monospace; padding-left: 20px; font-size: 14px'><b><?php echo $postal; ?></b></td>
		</tr>
		</table><br>
	 <center><h3 class="heading_text" style="width: 400px">Next of kin</h3></center><br>
			 <table width="430px" style="margin-left: auto; margin-right: auto" cellpadding="10"  cellspacing="0" border="1">
		<tr>
		<td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px;  font-size: 14px'><b>Next Of Kin</b></td>
		<td width="50%" style='background-color:#C5DFFA; font-family: monospace; padding-left: 20px; font-size: 14px'><b><?php echo $kinname; ?></b></td>
		</tr>
		<tr>
	    <td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px; font-size: 14px'><b>Phone No</b></td>
		<td width="50%" style='background-color:#C5DFFA; font-family: monospace; padding-left: 20px; font-size: 14px'><b><?php echo $kinphone; ?></b></td>
		</tr>
		<tr>
		<td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px;  font-size: 14px'><b>Relationship</b></td>
		<td width="50%" style='background-color:#C5DFFA; font-family: monospace; padding-left: 20px; font-size: 14px'><b><?php echo $rela; ?></b></td>
		</tr>
		<tr>
	    <td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px; font-size: 14px'><b>Address</b></td>
		<td width="50%" style='background-color:#C5DFFA; font-family: monospace; padding-left: 20px; font-size: 14px'><b><?php echo $add; ?></b></td>
		</tr>
	 </table><br>
	  <center><h3 class="heading_text" style="width: 400px">Education background</h3></center><br>
			 <table width="430px" style="margin-left: auto; margin-right: auto" cellpadding="10"  cellspacing="0" border="1">
		<tr class="school1">
		<td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px;  font-size: 14px'><b>School Attended 1</b></td>
		<td width="50%" style='background-color:#C5DFFA; font-family: monospace; padding-left: 20px; font-size: 14px'><b><?php echo $school1; ?></b></td>
		</tr>
		<tr class="year1">
	    <td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px; font-size: 14px'><b>Year</b></td>
		<td width="50%" style='background-color:#C5DFFA; font-family: monospace; padding-left: 20px; font-size: 14px'><b><?php echo "From" . " " . $from1 . " " . "To" . " " . $to1; ?></b></td>
		</tr>
		<tr class="school2">
		<td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px;  font-size: 14px'><b>School Attended 2</b></td>
		<td width="50%" style='background-color:#C5DFFA; font-family: monospace; padding-left: 20px; font-size: 14px'><b><?php echo $school2; ?></b></td>
		</tr>
		<tr class="year2">
	    <td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px; font-size: 14px'><b>Year</b></td>
		<td width="50%" style='background-color:#C5DFFA; font-family: monospace;  padding-left: 20px; font-size: 14px'><b><?php echo "From" . " " . $from2 . " " . "To" . " " . $to2; ?></b></td>
		</tr>
		<tr class="school3">
		<td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px;  font-size: 14px'><b>School Attended 3</b></td>
		<td width="50%" style='background-color:#C5DFFA; font-family: monospace; padding-left: 20px; font-size: 14px'><b><?php echo $school3; ?></b></td>
		</tr>
		<tr class="year3">
	    <td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px; font-size: 14px'><b>Year</b></td>
		<td width="50%" style='background-color:#C5DFFA; font-family: monospace; padding-left: 20px; font-size: 14px'><b><?php echo "From" . " " . $from3 . " " . "To" . " " . $to3; ?></b></td>
		</tr>
		<tr class="school4">
		<td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px;  font-size: 14px'><b>School Attended 4</b></td>
		<td width="50%" style='background-color:#C5DFFA; font-family: monospace; padding-left: 20px; font-size: 14px'><b><?php echo $school4; ?></b></td>
		</tr>
		<tr class="year4">
	    <td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px; font-size: 14px'><b>Year</b></td>
		<td width="50%" style='background-color:#C5DFFA; font-family: monospace; padding-left: 20px; font-size: 14px'><b><?php echo "From" . " " . $from4. " " . "To" . " " . $to4; ?></b></td>
	 </table><br>
	<center><h3 class="heading_text" style="width: 400px" id='levelr'>0'level Results</h3></center><br>
		<table width="430px" style="margin-left: auto; margin-right: auto" cellpadding="10"  cellspacing="0" border="1">
		<tr class="type1">
		<td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px;  font-size: 14px'><b><?php echo 'Exam Type:' . ' ' .$examtype1; ?></b></td>
		<td width="50%" style='background-color:#C5DFFA; font-family: monospace; padding-left: 20px; font-size: 14px'><b><?php echo 'Exam Year:' . ' ' .$examyear1; ?></b></td>
		</tr>
		<tr class="sub1">
		<td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px;  font-size: 14px'><b><?php echo $subject1; ?></b></td>
		<td width="50%" style='background-color:#C5DFFA; font-family: monospace; padding-left: 20px; font-size: 14px'><b><?php echo $grade1; ?></b></td>
		</tr>
		<tr class="sub2">
		<td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px;  font-size: 14px'><b><?php echo $subject2; ?></b></td>
		<td width="50%" style='background-color:#C5DFFA; font-family: monospace; padding-left: 20px; font-size: 14px'><b><?php echo $grade2; ?></b></td>
		</tr>
		<tr class="sub3">
		<td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px;  font-size: 14px'><b><?php echo $subject3; ?></b></td>
		<td width="50%" style='background-color:#C5DFFA; font-family: monospace; padding-left: 20px; font-size: 14px'><b><?php echo $grade3; ?></b></td>
		</tr>
		<tr class="sub4">
		<td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px;  font-size: 14px'><b><?php echo $subject4; ?></b></td>
		<td width="50%" style='background-color:#C5DFFA; font-family: monospace; padding-left: 20px; font-size: 14px'><b><?php echo $grade4; ?></b></td>
		</tr>
		<tr class="sub5">
		<td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px;  font-size: 14px'><b><?php echo $subject5; ?></b></td>
		<td width="50%" style='background-color:#C5DFFA; font-family: monospace; padding-left: 20px; font-size: 14px'><b><?php echo $grade5; ?></b></td>
		</tr>
		<tr class="sub6">
		<td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px;  font-size: 14px'><b><?php echo $subject6; ?></b></td>
		<td width="50%" style='background-color:#C5DFFA; font-family: monospace; padding-left: 20px; font-size: 14px'><b><?php echo $grade6; ?></b></td>
		</tr>
		<tr class="sub7">
		<td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px;  font-size: 14px'><b><?php echo $subject7; ?></b></td>
		<td width="50%" style='background-color:#C5DFFA; font-family: monospace; padding-left: 20px; font-size: 14px'><b><?php echo $grade7; ?></b></td>
		</tr>
		<tr class="sub8">
		<td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px;  font-size: 14px'><b><?php echo $subject8; ?></b></td>
		<td width="50%" style='background-color:#C5DFFA; font-family: monospace; padding-left: 20px; font-size: 14px'><b><?php echo $grade8; ?></b></td>
		</tr>
		<tr class="sub9">
		<td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px;  font-size: 14px'><b><?php echo $subject9; ?></b></td>
		<td width="50%" style='background-color:#C5DFFA; font-family: monospace; padding-left: 20px; font-size: 14px'><b><?php echo $grade9; ?></b></td>
		</tr>
	 </table><br>
	 <table width="430px" style="margin-left: auto; margin-right: auto" cellpadding="10"  cellspacing="0" border="1">
		<tr class="type2">
		<td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px;  font-size: 14px'><b><?php echo 'Exam Type:' . ' ' .$examtype2; ?></b></td>
		<td width="50%" style='background-color:#C5DFFA; font-family: monospace; padding-left: 20px; font-size: 14px'><b><?php echo 'Exam Year:' . ' ' .$examyear2; ?></b></td>
		</tr>
		<tr class="sub11">
		<td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px;  font-size: 14px'><b><?php echo $subject11; ?></b></td>
		<td width="50%" style='background-color:#C5DFFA; font-family: monospace; padding-left: 20px; font-size: 14px'><b><?php echo $grade11; ?></b></td>
		</tr>
		<tr class="sub22">
		<td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px;  font-size: 14px'><b><?php echo $subject22; ?></b></td>
		<td width="50%" style='background-color:#C5DFFA; font-family: monospace; padding-left: 20px; font-size: 14px'><b><?php echo $grade22; ?></b></td>
		</tr>
		<tr class="sub33">
		<td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px;  font-size: 14px'><b><?php echo $subject33; ?></b></td>
		<td width="50%" style='background-color:#C5DFFA; font-family: monospace; padding-left: 20px; font-size: 14px'><b><?php echo $grade33; ?></b></td>
		</tr>
		<tr class="sub44">
		<td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px;  font-size: 14px'><b><?php echo $subject44; ?></b></td>
		<td width="50%" style='background-color:#C5DFFA; font-family: monospace; padding-left: 20px; font-size: 14px'><b><?php echo $grade44; ?></b></td>
		</tr>
		<tr class="sub55">
		<td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px;  font-size: 14px'><b><?php echo $subject55; ?></b></td>
		<td width="50%" style='background-color:#C5DFFA; font-family: monospace; padding-left: 20px; font-size: 14px'><b><?php echo $grade55; ?></b></td>
		</tr>
		<tr class="sub66">
		<td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px;  font-size: 14px'><b><?php echo $subject66; ?></b></td>
		<td width="50%" style='background-color:#C5DFFA; font-family: monospace; padding-left: 20px; font-size: 14px'><b><?php echo $grade66; ?></b></td>
		</tr>
		<tr class="sub77">
		<td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px;  font-size: 14px'><b><?php echo $subject77; ?></b></td>
		<td width="50%" style='background-color:#C5DFFA; font-family: monospace; padding-left: 20px; font-size: 14px'><b><?php echo $grade77; ?></b></td>
		</tr>
		<tr class="sub88">
		<td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px;  font-size: 14px'><b><?php echo $subject88; ?></b></td>
		<td width="50%" style='background-color:#C5DFFA; font-family: monospace; padding-left: 20px; font-size: 14px'><b><?php echo $grade88; ?></b></td>
		</tr>
		<tr class="sub99">
		<td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px;  font-size: 14px'><b><?php echo $subject99; ?></b></td>
		<td width="50%" style='background-color:#C5DFFA; font-family: monospace; padding-left: 20px; font-size: 14px'><b><?php echo $grade99; ?></b></td>
		</tr>
	 </table><br>
    </div>
	<!-- end .margin --></div>
  <!-- end .container --></div>
 <?php
  include_once "footer.php";
  ?>
</body>
</html>
