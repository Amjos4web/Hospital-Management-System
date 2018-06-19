<?php
session_start();
ob_start();
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
	}
}else{
$msg="<p style='color: red; padding-left: 8px'>You have no Information yet in the Database</p>";
}
if (isset($_POST['back'])){
	header ('location: home.php');
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
<title>LETTER OF ATTESTATION</title>
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
     <div class="print_profiledata">
	  <p>Attesttation</p>
	     <img style="border: 3px groove #CECECE; float: right; background-color: #fff; margin-right: 0px;" src="../nursingSchool/passports/<?php echo $studentID; ?>.jpg" alt="<?php echo $surname; ?>" width="160px" height="160px">
	     <section><label style='margin-left: 15px; font-family: Calibri (Body); font-size: 16px; font-weight: bold'>Full Name</label><label style='float: right; margin-right: 110px; font-family: Bradley Hand ITC; font-size: 13px; font-weight: bold'><hr style='width: 310px; background-color: #000000; height: 1px'></label></section><br>
		 <section><label style='margin-left: 15px; font-family: Calibri (Body); font-size: 16px; font-weight: bold'>Email Address</label><label style='float: right; margin-right: 110px;  font-family: Bradley Hand ITC; font-size: 13px; font-weight: bold'><hr style='width: 310px; background-color: #000000; height: 1px'></label></section><br>
		 <section><label style='margin-left: 15px; font-family: Calibri (Body); font-size: 16px; font-weight: bold'>Contact Address</label><label style='float: right; margin-right: 110px;  font-family: Bradley Hand ITC; font-size: 13px; font-weight: bold'><hr style='width: 310px; background-color: #000000; height: 1px'></label></section><br>
		 <section><label style='margin-left: 15px; font-family: Calibri (Body); font-size: 16px; font-weight: bold'>Phone No</label><label style='float: right; margin-right: 110px;  font-family: Bradley Hand ITC;  font-size: 13px; font-weight: bold'><hr style='width: 310px; background-color: #000000; height: 1px'></label></section><br>
		 <section><label style='margin-left: 15px; font-family: Calibri (Body); font-size: 16px; font-weight: bold'>Occupation</label><label style='float: right; margin-right: 110px;  font-family: Bradley Hand ITC; font-size: 13px; font-weight: bold'><hr style='width: 310px; background-color: #000000; height: 1px'></label></section><br>
	  <div class="attestation">
	     <p style='font-size: 16px; text-align: justify; font-family: Tahoma; text-transform: none'>I hereby confirm that applicant is known to me. The information supplied in his/her form is to the best of my knowledge. The attached photograph endorsed by me is a true resemblance of the applicant.</p>
	  </div><br><br>
		<div id="declaration">
		<section style='float: left; margin-left: 15px'>
		 <hr style='width: 250px; background-color: #000000; height: 3px'>
		 <p style='color: #000000; font-size: 12px; font-family: Tahoma; text-align: center; text-transform: none'>Signature with Official Stamp</p>
		</section>
		<section style='float: right'>
		 <hr style='width: 250px; background-color: #000000; height: 3px'>
		 <p style='color: #000000; font-size: 12px; text-align: center;  font-family: Tahoma; text-transform: none'>Date</p>
	    </section>
	   </div><br><br><br><br>
	    <div id="declaration">
		 <p>Declaration</p>
		  <li>I hereby declare that the particulars, which I have supplied above, are true to the best of my knowledge.</li>
		  <li>I further declare that any false or incomplete information given in this form will automatically disqualify me from being considered for admission to or continuing with my course of study.</li>
		  <li>I shall accept as final the decision of the school authority with regard to my examination center/course of study.</li><br><br><br>
		  <section style='float: left; margin-left: 15px'>
		  <hr style='width: 250px; background-color: #000000; height: 3px'>
		  <p style='color: #000000; font-size: 12px; font-family: Tahoma; text-align: center; text-transform: none'>Signature of Applicant</p>
		  </section>
		  <section style='float: right'>
		  <hr style='width: 250px; background-color: #000000; height: 3px'>
		  <p style='color: #000000; font-size: 12px; text-align: center;  font-family: Tahoma; text-transform: none'>Date</p>
	      </section> 
	 </div><br>
	  <input type="submit" value="BACK" name="back" style="margin-top: 20px; margin-left: 300px;  width: 90px">
	  <input type="button" onclick="printDiv('containerr'); window.open('printouts.php')" value="PRINT" style="width: 90px">			
   </div>
 </body>
</html>
