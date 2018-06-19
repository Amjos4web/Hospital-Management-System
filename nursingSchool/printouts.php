<?php
session_start();
if (!isset($_SESSION['emaill']))
	{
		header('location: login.php');
	} else {
		$emaill = $_SESSION['emaill'];
	}
//error_reporting(E_ALL & ~E_NOTICE);
// This block grabs the whole list for viewing
$msg="";
include "dbconnect.php";
$sql="SELECT * FROM `sono` WHERE `eMail`='$emaill' LIMIT 1";
$check = mysqli_query($dbconnect, $sql) or die(mysqli_error($dbconnect));
$resultCount=mysqli_num_rows($check); //count the out amount 
if($resultCount>0){
	while($row=mysqli_fetch_array($check)){
	$email=$row["eMail"];
	$studentID=$row["studentid"];
	$surname=$row["surName"];
	$otherNames=$row["otherName"];
	$firstNames=$row["firstName"];
	$PhoneNo=$row["phoneNo"];
	$sex=$row["sex"];
	$DateOfbirth=$row["DateofBirth"];
	$state=$row["stateoforigin"];
	$Marital=$row["marital"];
	$country=$row["natioNality"];
	$Religion=$row["religion"];
	$HomeAddress=$row["homeAddress"];
	$HomeTown=$row["homeTown"];
	$Denomination=$row["denoMination"];
	$lGA=$row["LGA"];
	$Postal=$row["postaladdress"];
	}
}else{
$msg="<p style='color: red; padding-left: 8px'>You have no Information yet in the Database</p>";
}
$Sql="SELECT * FROM `sono_nextofkin` WHERE `eMail`='$email' LIMIT 1";
$Check = mysqli_query($dbconnect, $Sql) or die(mysqli_error($dbconnect));
$ResultCount=mysqli_num_rows($Check); //count the out amount 
if($ResultCount>0){
	while($row=mysqli_fetch_array($Check)){	
    $NameofKin=$row["Nameofkin"];
	$PhoneNo1=$row["phoneNo1"];
	$Relationship1=$row["relationship1"];
	$Address1=$row["address1"];
	$SponsorName=$row["sponsorName"];
	$PhoneNo2=$row["phoneNo2"];
	$Relationship2=$row["relationship2"];
	$Address2=$row["address2"];
	$School1=$row["school1"];
	$School2=$row["school2"];
	$School3=$row["school3"];
	$School4=$row["school4"];
	$date_added = $row["date_added"];
	$date_addedd = date("l jS \of F Y");
	}
}else{
$msg="<p style='color: red; padding-left: 8px'>You have no Information yet in the Database</p>";
}
$sql="SELECT * FROM `sono_0level_results` WHERE `eMail`='$emaill' LIMIT 1";
$check = mysqli_query($dbconnect, $sql) or die(mysqli_error($dbconnect));
$resultCount=mysqli_num_rows($check); //count the out amount 
if($resultCount>0){
	while($row=mysqli_fetch_array($check)){
		$email=$row["eMail"];
		$examtype1=$row["examType1"];
		$examtype2=$row["examType2"];
		$examyear1=$row["year1"];
		$examyear2=$row["year2"];
		$examno1=$row["examNo1"];
		$examno2=$row["examNo2"];
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
	}
	
	if ($subject11 == "null" || $grade11 == "AR"){
		?><style type="text/css">.sub11{
			display: none;
		}
		</style><?php
	}
	if ($subject22 == "null" || $grade22 == "AR"){
		?><style type="text/css">.sub22{
			display: none;
		}
		</style><?php
	}
	if ($subject33 == "null" || $grade33 == "AR"){
		?><style type="text/css">.sub33{
			display: none;
		}
		</style><?php
	}
	if ($subject44 == "null" || $grade44 == "AR"){
		?><style type="text/css">.sub44{
			display: none;
		}
		</style><?php
	}
	if ($subject55 == "null" || $grade55 == "AR"){
		?><style type="text/css">.sub55{
			display: none;
		}
		</style><?php
	}
	if ($subject66 == "null" || $grade66 == "AR"){
		?><style type="text/css">.sub66{
			display: none;
		}
		</style><?php
	}
	if ($subject77 == "null" || $grade77 == "AR"){
		?><style type="text/css">.sub77{
			display: none;
		}
		</style><?php
	}
	if ($subject88 == "null" || $grade88 == "AR"){
		?><style type="text/css">.sub88{
			display: none;
		}
		</style><?php
	}
	if ($subject1 == "null" || $grade1 == "AR"){
		?><style type="text/css">.sub1{
			display: none;
		}
		</style><?php
	}
	if ($subject2 == "null" || $grade2 == "AR"){
		?><style type="text/css">.sub2{
			display: none;
		}
		</style><?php
	}
	if ($subject3 == "null" || $grade3 == "AR"){
		?><style type="text/css">.sub3{
			display: none;
		}
		</style><?php
	}
	if ($subject4 == "null" || $grade4 == "AR"){
		?><style type="text/css">.sub4{
			display: none;
		}
		</style><?php
	}
	if ($subject5 == "null" || $grade5 == "AR"){
		?><style type="text/css">.sub5{
			display: none;
		}
		</style><?php
	}
	if ($subject6 == "null" || $grade6 == "AR"){
		?><style type="text/css">.sub6{
			display: none;
		}
		</style><?php
	}
	if ($subject7 == "null" || $grade7 == "AR"){
		?><style type="text/css">.sub7{
			display: none;
		}
		</style><?php
	}
	if ($subject8 == "null" || $grade8 == "AR"){
		?><style type="text/css">.sub8{
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
		?><style type="text/css">.type11{
			display: none;
		}
		</style><?php
	}
}else{
$msg="<p style='color: red; padding-left: 8px'>You have no Information yet in the Database</p>";
}
if (isset($_POST['back'])){
	header ('location: login.php');
}
?>
<!DOCTYPE html>
<html>
<link href="http://localhost/buth_net/nursingSchool/css/buth_net.css" rel="stylesheet" type="text/css">
<head>
<meta charset="utf-8">
<link rel="shortcut icon" href="/favicon.ico" >
<script type="text/javascript">
function printDiv(divName) {
    var printContents = document.getElementById(divName).innerHTML;
    var originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;
    window.print();
    document.body.innerHTML = originalContents;
}
</script>
<title>REGISTRATION FORM PRINTOUTS</title>
</head>
<body style="background-color: #fff">
 <form action="" method="post">
   <div id="containerr">
     <div id="print_profile">
      <h1>School of Nursing</h1>
	   <div class="add">
	    <p>Bowen University Teaching Hospital</p>
	    <p>P.O. Box 15, Ogbomoso<section style='float: right; font-family: Tahoma; font-size: 16px; margin-right: 15px'>Reg. No: <?php echo "BUTH/SON/" . $studentID; ?></section></p>
   </div>
       <h2 style='color: #000000; font-family: Tahoma; text-align: center; font-size: 20px; font-style: normal; text-transform: uppercase; text-decoration: underline'>NURSING SCHOOL PORTAL-REGISTRATION Form</h2>
     <div class="date">
	  <p style='margin-left: 5px;font-family: "Lucida Grande","Lucida Sans Unicode",Tahoma,Sans-Serif'><?php echo 'Date Submitted:' . " " . $date_added; ?><label style='float: right; font-family: "Lucida Grande","Lucida Sans Unicode",Tahoma,Sans-Serif'><?php echo 'Date Printed:'. " " . $date_addedd; ?></label></p>
	 </div>
	 <div class="print_profiledata">
	  <p>Bio-Data</p>
	     <img style="border: 3px groove #CECECE; float: right; background-color: #fff; margin-right: 0px;" src="../nursingSchool/passports/<?php echo $studentID; ?>.jpg" alt="<?php echo $surname; ?>" width="160px" height="160px">
	     <section><label style='margin-left: 15px; font-family: Calibri (Body); font-size: 16px; font-weight: bold'>Surname</label><p style='float: right; margin-right: 190px; font-family: "Lucida Grande","Lucida Sans Unicode",Tahoma,Sans-Serif; font-size: 13px'><?php echo $surname; ?></p></section><br>
		 <section><label style='margin-left: 15px; font-family: Calibri (Body); font-size: 16px; font-weight: bold'>Other Names</label><p style='float: right; margin-right: 190px;  font-family: "Lucida Grande","Lucida Sans Unicode",Tahoma,Sans-Serif; font-size: 13px'><?php echo $firstNames . " " . " " . $otherNames; ?></p></section><br>
		 <section><label style='margin-left: 15px; font-family: Calibri (Body); font-size: 16px; font-weight: bold'>Email Address</label><p style='float: right; margin-right: 190px;  font-family: "Lucida Grande","Lucida Sans Unicode",Tahoma,Sans-Serif; font-size: 13px'><?php echo $_SESSION['emaill']; ?></p></section><br>
		 <section><label style='margin-left: 15px; font-family: Calibri (Body); font-size: 16px; font-weight: bold'>Sex</label><p style='float: right; margin-right: 190px;  font-family: "Lucida Grande","Lucida Sans Unicode",Tahoma,Sans-Serif;  font-size: 13px'><?php echo $sex; ?></p></section><br>
		 <section><label style='margin-left: 15px; font-family: Calibri (Body); font-size: 16px; font-weight: bold'>Date Of Birth</label><p style='float: right; margin-right: 190px;  font-family: "Lucida Grande","Lucida Sans Unicode",Tahoma,Sans-Serif; font-size: 13px'><?php echo $DateOfbirth; ?></p></section><br>
	  <div class="print_profiledata2">
	   <table style='width: 750px; margin-left: 10px'>
	    <tr>
		 <td width="40%">
		 <section><label style='font-family: "Lucida Grande","Lucida Sans Unicode",Tahoma,Sans-Serif; font-size: 16px'>Home Town</label></section>
	     <td width="60%">
		 <section style='margin-left: 60px;  font-family: "Lucida Grande","Lucida Sans Unicode",Tahoma,Sans-Serif'><?php echo $HomeTown; ?></section>
		</tr>
	   </table>
	   <table style='width: 750px; margin-left: 10px'>
	    <tr>
		 <td width="40%">
		 <section><label style='font-family: Calibri (Body); font-size: 16px'>Local Gov. Area</label></section>
	     <td width="60%">
		 <section style='margin-left: 60px;  font-family: "Lucida Grande","Lucida Sans Unicode",Tahoma,Sans-Serif'><?php echo $lGA; ?></section>
		</tr>
	   </table>
	   <table style='width: 750px; margin-left: 10px'>
	    <tr>
		 <td width="40%">
		 <section><label style='font-family: Calibri (Body); font-size: 16px'>State of Origin</label></section>
	     <td width="60%">
		 <section style='margin-left: 60px;  font-family: "Lucida Grande","Lucida Sans Unicode",Tahoma,Sans-Serif'><?php echo $state; ?></section>
		</tr>
	   </table>
	   <table style='width: 750px; margin-left: 10px'>
	    <tr>
		 <td width="40%">
		 <section><label style='font-family: Calibri (Body); font-size: 16px'>Nationality</label></section>
	     <td width="60%">
		 <section style='margin-left: 60px;  font-family: "Lucida Grande","Lucida Sans Unicode",Tahoma,Sans-Serif'><?php echo $country; ?></section>
		</tr>
	   </table>
	   <table style='width: 750px; margin-left: 10px'>
	    <tr>
		 <td width="40%">
		 <section><label style='font-family: Calibri (Body); font-size: 16px'>Denomination</label></section>
	     <td width="60%">
		 <section style='margin-left: 60px;  font-family: "Lucida Grande","Lucida Sans Unicode",Tahoma,Sans-Serif'><?php echo $Denomination; ?></section>
		</tr>
	   </table>
	   <table style='width: 750px; margin-left: 10px'>
	    <tr>
		 <td width="40%">
		 <section><label style='font-family: Calibri (Body); font-size: 16px'>Religion</label></section>
	     <td width="60%">
		 <section style='margin-left: 60px;  font-family: "Lucida Grande","Lucida Sans Unicode",Tahoma,Sans-Serif'><?php echo $Religion; ?></section>
		</tr>
	   </table>
	   <table style='width: 750px; margin-left: 10px'>
	    <tr>
		 <td width="40%">
		 <section><label style='font-family: Calibri (Body); font-size: 16px'>Home Address</label></section>
	     <td width="60%">
		 <section style='margin-left: 60px;  font-family: "Lucida Grande","Lucida Sans Unicode",Tahoma,Sans-Serif'><?php echo $HomeAddress; ?></section>
		</tr>
	   </table>
	   <table style='width: 750px; margin-left: 10px'>
	    <tr>
		 <td width="40%">
		 <section><label style='font-family: Calibri (Body); font-size: 16px'>Postal Address</label></section>
	     <td width="60%">
		 <section style='margin-left: 60px;  font-family: "Lucida Grande","Lucida Sans Unicode",Tahoma,Sans-Serif'><?php echo $Postal; ?></section>
		</tr>
	   </table><br>
	    <p style='margin-left: 0px; font-family: Calibri (Body); text-transform: uppercase; font-size: 18px'>Next of Kin & Sponsor</p>
		<table style='width: 750px; margin-left: 10px'>
	    <tr>
		 <td width="40%">
		 <section><label style='font-family: Calibri (Body); font-size: 16px'>Name of Kin</label></section>
	     <td width="60%">
		 <section style='margin-left: 60px;  font-family: "Lucida Grande","Lucida Sans Unicode",Tahoma,Sans-Serif'><?php echo $NameofKin; ?></section>
		</tr>
	   </table>
	   <table style='width: 750px; margin-left: 10px'>
	    <tr>
		 <td width="40%">
		 <section><label style='font-family: Calibri (Body); font-size: 16px'>Phone No</label></section>
	     <td width="60%">
		 <section style='margin-left: 60px;  font-family: "Lucida Grande","Lucida Sans Unicode",Tahoma,Sans-Serif'><?php echo $PhoneNo1; ?></section>
		</tr>
	   </table>
	   <table style='width: 750px; margin-left: 10px'>
	    <tr>
		 <td width="40%">
		 <section><label style='font-family: Calibri (Body); font-size: 16px'>Relationship</label></section>
	     <td width="60%">
		 <section style='margin-left: 60px;  font-family: "Lucida Grande","Lucida Sans Unicode",Tahoma,Sans-Serif'><?php echo $Relationship1; ?></section>
		</tr>
	   </table>
	   <table style='width: 750px; margin-left: 10px'>
	    <tr>
		 <td width="40%">
		 <section><label style='font-family: Calibri (Body); font-size: 16px'>Address</label></section>
	     <td width="60%">
		 <section style='margin-left: 60px;  font-family: "Lucida Grande","Lucida Sans Unicode",Tahoma,Sans-Serif'><?php echo $Address1; ?></section>
		</tr>
	   </table>
	   <table style='width: 750px; margin-left: 10px'>
	    <tr>
		 <td width="40%">
		 <section><label style='font-family: Calibri (Body); font-size: 16px'>Name of Sponsor</label></section>
	     <td width="60%">
		 <section style='margin-left: 60px;  font-family: "Lucida Grande","Lucida Sans Unicode",Tahoma,Sans-Serif'><?php echo $SponsorName; ?></section>
		</tr>
	   </table>
	   <table style='width: 750px; margin-left: 10px'>
	    <tr>
		 <td width="40%">
		 <section><label style='font-family: Calibri (Body); font-size: 16px'>Phone No</label></section>
	     <td width="60%">
		 <section style='margin-left: 60px;  font-family: "Lucida Grande","Lucida Sans Unicode",Tahoma,Sans-Serif'><?php echo $PhoneNo2; ?></section>
		</tr>
	   </table>
	   <table style='width: 750px; margin-left: 10px'>
	    <tr>
		 <td width="40%">
		 <section><label style='font-family: Calibri (Body); font-size: 16px'>Relationship</label></section>
	     <td width="60%">
		 <section style='margin-left: 60px;  font-family: "Lucida Grande","Lucida Sans Unicode",Tahoma,Sans-Serif'><?php echo $Relationship2; ?></section>
		</tr>
	   </table>
	   <table style='width: 750px; margin-left: 10px'>
	    <tr>
		 <td width="40%">
		 <section><label style='font-family: Calibri (Body); font-size: 16px'>Address</label></section>
	     <td width="60%">
		 <section style='margin-left: 60px;  font-family: "Lucida Grande","Lucida Sans Unicode",Tahoma,Sans-Serif'><?php echo $Address2; ?></section>
		</tr>
	   </table><br>
	   <p style='margin-left: 0px; font-family: Calibri (Body); text-transform: uppercase; font-size: 18px'>Schools attended</p>
		<table style='width: 750px; margin-left: 10px'>
	    <tr>
		 <td width="40%">
		 <section><label style='font-family: Calibri (Body); font-size: 16px'>School 1</label></section>
	     <td width="60%">
		 <section style='margin-left: 60px;  font-family: "Lucida Grande","Lucida Sans Unicode",Tahoma,Sans-Serif'><?php echo $School1; ?></section>
		</tr>
	    <tr>
		 <td width="40%">
		 <section><label style='font-family: Calibri (Body); font-size: 16px'>School 2</label></section>
	     <td width="60%">
		 <section style='margin-left: 60px;  font-family: "Lucida Grande","Lucida Sans Unicode",Tahoma,Sans-Serif'><?php echo $School2; ?></section>
		</tr>
	    <tr>
		 <td width="40%">
		 <section><label style='font-family: Calibri (Body); font-size: 16px'>School 3</label></section>
	     <td width="60%">
		 <section style='margin-left: 30px;  font-family: "Lucida Grande","Lucida Sans Unicode",Tahoma,Sans-Serif'><?php echo $School3; ?></section>
		</tr>
	    <tr>
		 <td width="40%">
		 <section><label style='font-family: Calibri (Body); font-size: 16px'>School 4</label></section>
	     <td width="60%">
		 <section style='margin-left: 30px;  font-family: "Lucida Grande","Lucida Sans Unicode",Tahoma,Sans-Serif'><?php echo $School4; ?></section>
		</tr>
	   </table></br>
	   <p style='margin-left: 0px; font-family: Calibri (Body); text-transform: uppercase; font-size: 18px'>0'Level Results</p>
		<table style='width: 750px; margin-left: 10px'>
		 <tr class='type1'>
		 <td width="40%">
		 <section><label style='font-family: Calibri (Body); font-size: 16px'><?php echo 'Exam Type:' . ' ' . $examtype1; ?></label></section>
	     <td width="60%">
		 <section style='margin-left: 60px;  font-family: "Lucida Grande","Lucida Sans Unicode",Tahoma,Sans-Serif'><?php echo 'Exam Year:' . ' ' . $examyear1; ?></section>
		</tr>
	    <tr class='sub1'>
		 <td width="40%">
		 <section><label style='font-family: Calibri (Body); font-size: 16px'><?php echo $subject1; ?></label></section>
	     <td width="60%">
		 <section style='margin-left: 60px;  font-family: "Lucida Grande","Lucida Sans Unicode",Tahoma,Sans-Serif'><?php echo $grade1; ?></section>
		</tr>
	    <tr class='sub2'>
		 <td width="40%">
		 <section><label style='font-family: Calibri (Body); font-size: 16px'><?php echo $subject2; ?></label></section>
	     <td width="60%">
		 <section style='margin-left: 60px;  font-family: "Lucida Grande","Lucida Sans Unicode",Tahoma,Sans-Serif'><?php echo $grade2; ?></section>
		</tr>
	    <tr class='sub3'>
		 <td width="40%">
		 <section><label style='font-family: Calibri (Body); font-size: 16px'><?php echo $subject3; ?></label></section>
	     <td width="60%">
		 <section style='margin-left: 60px;  font-family: "Lucida Grande","Lucida Sans Unicode",Tahoma,Sans-Serif'><?php echo $grade3; ?></section>
		</tr>
	    <tr class='sub4'>
		 <td width="40%">
		 <section><label style='font-family: Calibri (Body); font-size: 16px'><?php echo $subject4; ?></label></section>
	     <td width="60%">
		 <section style='margin-left: 60px;  font-family: "Lucida Grande","Lucida Sans Unicode",Tahoma,Sans-Serif'><?php echo $grade4; ?></section>
		</tr>
		<tr class='sub5'>
		 <td width="40%">
		 <section><label style='font-family: Calibri (Body); font-size: 16px'><?php echo $subject5; ?></label></section>
	     <td width="60%">
		 <section style='margin-left: 60px;  font-family: "Lucida Grande","Lucida Sans Unicode",Tahoma,Sans-Serif'><?php echo $grade5; ?></section>
		</tr class='sub6'>
		<tr>
		 <td width="40%">
		 <section><label style='font-family: Calibri (Body); font-size: 16px'><?php echo $subject6; ?></label></section>
	     <td width="60%">
		 <section style='margin-left: 60px;  font-family: "Lucida Grande","Lucida Sans Unicode",Tahoma,Sans-Serif'><?php echo $grade6; ?></section>
		</tr>
		<tr class='sub7'>
		 <td width="40%">
		 <section><label style='font-family: Calibri (Body); font-size: 16px'><?php echo $subject7; ?></label></section>
	     <td width="60%">
		 <section style='margin-left: 60px;  font-family: "Lucida Grande","Lucida Sans Unicode",Tahoma,Sans-Serif'><?php echo $grade7; ?></section>
		</tr>
		<tr class='sub8'>
		 <td width="40%">
		 <section><label style='font-family: Calibri (Body); font-size: 16px'><?php echo $subject8; ?></label></section>
	     <td width="60%">
		 <section style='margin-left: 60px;  font-family: "Lucida Grande","Lucida Sans Unicode",Tahoma,Sans-Serif'><?php echo $grade8; ?></section>
		</tr>
		</table></br>
		<table style='width: 750px; margin-left: 10px'>
		<tr class='type11'>
		 <td width="40%">
		 <section><label style='font-family: Calibri (Body); font-size: 16px'><?php echo 'Exam Type:' . ' ' . $examtype2; ?></label></section>
	     <td width="60%">
		 <section style='margin-left: 60px;  font-family: "Lucida Grande","Lucida Sans Unicode",Tahoma,Sans-Serif'><?php echo 'Exam Year:' . ' ' . $examyear2; ?></section>
		</tr>
	    <tr class='sub11'>
		 <td width="40%">
		 <section><label style='font-family: Calibri (Body); font-size: 16px'><?php echo $subject11; ?></label></section>
	     <td width="60%">
		 <section style='margin-left: 60px;  font-family: "Lucida Grande","Lucida Sans Unicode",Tahoma,Sans-Serif'><?php echo $grade11; ?></section>
		</tr>
	    <tr class='sub22'>
		 <td width="40%">
		 <section><label style='font-family: Calibri (Body); font-size: 16px'><?php echo $subject22; ?></label></section>
	     <td width="60%">
		 <section style='margin-left: 60px;  font-family: "Lucida Grande","Lucida Sans Unicode",Tahoma,Sans-Serif'><?php echo $grade22; ?></section>
		</tr>
	    <tr class='sub33'>
		 <td width="40%">
		 <section><label style='font-family: Calibri (Body); font-size: 16px'><?php echo $subject33; ?></label></section>
	     <td width="60%">
		 <section style='margin-left: 60px;  font-family: "Lucida Grande","Lucida Sans Unicode",Tahoma,Sans-Serif'><?php echo $grade33; ?></section>
		</tr>
	    <tr class='sub44'>
		 <td width="40%">
		 <section><label style='font-family: Calibri (Body); font-size: 16px'><?php echo $subject44; ?></label></section>
	     <td width="60%">
		 <section style='margin-left: 60px;  font-family: "Lucida Grande","Lucida Sans Unicode",Tahoma,Sans-Serif'><?php echo $grade44; ?></section>
		</tr>
		<tr class='sub55'>
		 <td width="40%">
		 <section><label style='font-family: Calibri (Body); font-size: 16px'><?php echo $subject55; ?></label></section>
	     <td width="60%">
		 <section style='margin-left: 60px;  font-family: "Lucida Grande","Lucida Sans Unicode",Tahoma,Sans-Serif'><?php echo $grade55; ?></section>
		</tr>
		<tr class='sub66'>
		 <td width="40%">
		 <section><label style='font-family: Calibri (Body); font-size: 16px'><?php echo $subject66; ?></label></section>
	     <td width="60%">
		 <section style='margin-left: 60px;  font-family: "Lucida Grande","Lucida Sans Unicode",Tahoma,Sans-Serif'><?php echo $grade66; ?></section>
		</tr>
		<tr class='sub77'>
		 <td width="40%">
		 <section><label style='font-family: Calibri (Body); font-size: 16px'><?php echo $subject77; ?></label></section>
	     <td width="60%">
		 <section style='margin-left: 60px;  font-family: "Lucida Grande","Lucida Sans Unicode",Tahoma,Sans-Serif'><?php echo $grade77; ?></section>
		</tr>
		<tr class='sub88'>
		 <td width="40%">
		 <section><label style='font-family: Calibri (Body); font-size: 16px'><?php echo $subject88; ?></label></section>
	     <td width="60%">
		 <section style='margin-left: 60px;  font-family: "Lucida Grande","Lucida Sans Unicode",Tahoma,Sans-Serif'><?php echo $grade88; ?></section>
		</tr>
		</table></br>
	     </div>
		</div>
	   </div>
	  <p style='text-align: center; font-size: 12px; margin-top: 0px'><a href="www.buth.org.ng">www.buth.edu.ng</a><br>
	  <input type="submit" value="LOGIN" name="back" style="margin-top: 20px; width: 90px">
	  <input type="button" onclick="printDiv('containerr'); window.open('printouts.php')" value="PRINT" style="width: 90px">			
   </div>
 </body>
</html>

