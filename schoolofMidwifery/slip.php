<?php 
session_start();
ob_start();
if(!isset($_SESSION['emaill'])){
	header('location: login.php');
}
 
//This block grabs the whole list for viewing
$msg="";
$emaill= $_SESSION['emaill'];
include "dbconnect.php";
$sql="SELECT * FROM `som` WHERE `eMail`='$emaill' LIMIT 1";
$check = mysqli_query($dbconnect, $sql);
$resultCount=mysqli_num_rows($check); //count the out amount 
if($resultCount>0){
	while($row=mysqli_fetch_array($check)){
		$studentID=$row["studentid"];
		$surname=$row["surName"];
		$otherNames=$row["otherName"];
		$firstNames=$row["firstName"];
		$PhoneNo=$row["phoneNo"];
		$sex=$row["sex"];
		$DateOfbirth=$row["DateofBirth"];
		$HomeAddress=$row["homeAddress"];
		$Postal=$row["postaladdress"];
		$date_added = $row["date_added"];
		$date_addedd = date("l jS \of F Y");
	}
}else{
$msg="<p style='color: red; padding-left: 8px'>You have no Information yet in the Database</p>";
}

if (isset($_POST['back'])){
	header ('location: home.php');
}
?>
<!Doctype html>
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
<title>My Account/Exam Slip</title>
</head>
<body style="background-color: #fff">
  <div id="containerr">
     <div id="print_profilee">
      <h1>School of Midewifery</h1>
	   <div class="add">
	    <p>Bowen University Teaching Hospital</p>
	    <p>P.O. Box 15, Ogbomoso<section style='float: right; font-family: Tahoma; font-size: 16px; margin-right: 15px'>Reg. No: <?php echo $studentID; ?></section></p>
   </div><br><br>
   <div class="date">
	  <p style='margin-left: 5px;font-family: "Lucida Grande","Lucida Sans Unicode",Tahoma,Sans-Serif'><?php echo 'Date Submitted:' . " " . $date_added; ?><label style='float: right; font-family: "Lucida Grande","Lucida Sans Unicode",Tahoma,Sans-Serif'><?php echo 'Date Printed:'. " " . $date_addedd; ?></label></p>
	 </div>
     <div class="print_profiledata">
	 <form action="" method="post">
	  <p>Examination/Interview Admission Card</p>
	     <img style="border: 3px groove #CECECE; float: right; background-color: #fff; margin-right: 0px;" src="../nursingSchool/passports/<?php echo $studentID; ?>.jpg" alt="<?php echo $surname; ?>" width="160px" height="160px">
	     <section><label style='margin-left: 15px; font-family: Calibri (Body); font-size: 16px; font-weight: bold'>Surname</label><p style='float: right; margin-right: 190px; font-family: "Lucida Grande","Lucida Sans Unicode",Tahoma,Sans-Serif; font-size: 13px'><?php echo $surname; ?></p></section><br>
		 <section><label style='margin-left: 15px; font-family: Calibri (Body); font-size: 16px; font-weight: bold'>Other Names</label><p style='float: right; margin-right: 190px;  font-family: "Lucida Grande","Lucida Sans Unicode",Tahoma,Sans-Serif; font-size: 13px'><?php echo $firstNames . " " . " " . $otherNames; ?></p></section><br>
		 <section><label style='margin-left: 15px; font-family: Calibri (Body); font-size: 16px; font-weight: bold'>Contact Address</label><p style='float: right; margin-right: 190px;  font-family: "Lucida Grande","Lucida Sans Unicode",Tahoma,Sans-Serif; font-size: 13px'><?php echo $HomeAddress; ?></p></section><br>
		 <section><label style='margin-left: 15px; font-family: Calibri (Body); font-size: 16px; font-weight: bold'>Sex</label><p style='float: right; margin-right: 190px;  font-family: "Lucida Grande","Lucida Sans Unicode",Tahoma,Sans-Serif;  font-size: 13px'><?php echo $sex; ?></p></section><br>
		 <section><label style='margin-left: 15px; font-family: Calibri (Body); font-size: 16px; font-weight: bold'>Date Of Birth</label><p style='float: right; margin-right: 190px;  font-family: "Lucida Grande","Lucida Sans Unicode",Tahoma,Sans-Serif; font-size: 13px'><?php echo $DateOfbirth; ?></p></section><br>
		 <section><label style='margin-left: 15px; font-family: Calibri (Body); font-size: 16px; font-weight: bold'>Phone No</label><p style='float: right; margin-right: 355px;  font-family: "Lucida Grande","Lucida Sans Unicode",Tahoma,Sans-Serif; font-size: 13px'><?php echo $PhoneNo; ?></p></section><br><br>
	 
	  <section><label style='font-family: Tahoma; font-size: 16px; margin-left: 35px; text-transform: uppercase'>Examination Date: </label><label style='color: #fff; font-size: 16px; font-family: Tahoma; background-color: #000000'>13th June, 2016 </label><label style='font-family: Tahoma; font-size: 16px; margin-left: 15px; text-transform: uppercase'>Time: </label><label style='color: #fff; font-size: 16px; font-family: Tahoma; background-color: #000000'>8am</label><label style='font-family: Tahoma; font-size: 16px; margin-left: 15px; text-transform: uppercase'>Examination Center: </label><label style='color: #fff; font-size: 16px; font-family: Tahoma; background-color: #000000'>School Premises</label></section><br><br><br>
       <section>
	    <hr style='width: 300px; margin-left: auto; margin-right: auto; height: 2px; background-color: #000000'>
        <p style='text-align: center; font-family: Tahoma; font-size: 14px; color: #000000; text-transform: none'>Candidate's Signature & Date</p>
	   </section>
	   <section>
        <p style='text-align: center; font-family: Tahoma; font-size: 14px; color: #000000; text-transform: none'>Note: Please bring this slip to the examination and interview venues</p>
	   </section>
   </div>
  </div>
	  <input type="submit" value="BACK" name="back" style="margin-top: 20px; margin-left: 300px;  width: 90px">
	  <input type="button" onclick="printDiv('containerr'); window.open('printouts.php')" value="PRINT" style="width: 90px">		
    </form>
   </div>

 </body>
</html>