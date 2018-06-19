<?php
session_start();
if(!isset($_SESSION['emaill'])){
	header('location: login.php');
} 
error_reporting(E_ALL & ~E_NOTICE);
//This block grabs the whole list for viewing
$msg="";
$emaill= $_SESSION['emaill'];
include "dbconnect.php";
$sql="SELECT * FROM `som` WHERE `eMail`='$emaill' LIMIT 1";
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
$Sql="SELECT * FROM `som_nextofkin` WHERE `eMail`='$email' LIMIT 1";
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
      <h1>School of Midwifery</h1>
	   <div class="add">
	    <p>Bowen University Teaching Hospital</p>
	    <p>P.O. Box 15, Ogbomoso<section style='float: right; font-family: Tahoma; font-size: 16px; margin-right: 15px'>Reg. No: <?php echo "BUTH/SOM/" . $studentID; ?></section></p>
   </div>
       <h2 style='color: #000000; font-family: Tahoma; text-align: center; font-size: 18px; font-style: normal; text-transform: uppercase;'>SCHOOL OF MIDWIFERY PORTAL-REGISTRATION Form</h2>
     <div class="date">
	  <p style='margin-left: 5px;font-family: "Lucida Grande","Lucida Sans Unicode",Tahoma,Sans-Serif'><?php echo 'Date Submitted:' . " " . $date_added; ?><label style='float: right; font-family: "Lucida Grande","Lucida Sans Unicode",Tahoma,Sans-Serif'><?php echo 'Date Printed:'. " " . $date_addedd; ?></label></p>
	 </div>
	 <div class="print_profiledata">
	  <p>Bio-Data</p>
	     <img style="border: 3px groove #CECECE; float: right; background-color: #fff; margin-right: 0px;" src="../schoolofMidwifery/passports/<?php echo $studentID; ?>.jpg" alt="<?php echo $surname; ?>" width="160px" height="160px">
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
	   </table>
	   <table style='width: 750px; margin-left: 10px'>
	    <tr>
		 <td width="40%">
		 <section><label style='font-family: Calibri (Body); font-size: 16px'>School 2</label></section>
	     <td width="60%">
		 <section style='margin-left: 60px;  font-family: "Lucida Grande","Lucida Sans Unicode",Tahoma,Sans-Serif'><?php echo $School2; ?></section>
		</tr>
	   </table>
	   <table style='width: 750px; margin-left: 10px'>
	    <tr>
		 <td width="40%">
		 <section><label style='font-family: Calibri (Body); font-size: 16px'>School 3</label></section>
	     <td width="60%">
		 <section style='margin-left: 30px;  font-family: "Lucida Grande","Lucida Sans Unicode",Tahoma,Sans-Serif'><?php echo $School3; ?></section>
		</tr>
	   </table>
	    <table style='width: 750px; margin-left: 10px'>
	    <tr>
		 <td width="40%">
		 <section><label style='font-family: Calibri (Body); font-size: 16px'>School 4</label></section>
	     <td width="60%">
		 <section style='margin-left: 30px;  font-family: "Lucida Grande","Lucida Sans Unicode",Tahoma,Sans-Serif'><?php echo $School4; ?></section>
		</tr>
	   </table>
	     </div>
		</div>
	   </div>
	  <p style='text-align: center; font-size: 12px; margin-top: 0px'><a href="www.buth.org.ng">www.buth.edu.ng</a><br>
	  <input type="submit" value="LOGIN" name="back" style="margin-top: 20px; width: 90px">
	  <input type="button" onclick="printDiv('containerr'); window.open('printouts.php')" value="PRINT" style="width: 90px">			
   </div>
 </body>
</html>

