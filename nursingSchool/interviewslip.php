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

$score = '47';
$dateprinted = date('Y-m-d:h-m-i');

$sql="SELECT * FROM `sono` WHERE `eMail` = '".$emaill."' AND `result_score` >= '".$score."' LIMIT 1";
$check = mysqli_query($dbconnect, $sql);
$resultCount=mysqli_num_rows($check); //count the out amount 
if($resultCount>0){
	while($row=mysqli_fetch_array($check)){
		$studentID=$row["studentid"];
		$surname=$row["surName"];
		$otherNames=$row["otherName"];
		$firstName=$row["firstName"];
		$privateNews=$row["privateNews"];
	}
}else{
	echo "<p style='color: #880000; text-align: center; font-family: cursive; font-size: 20px;'>You are not qualified</p>";
	die();
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
<title>My Account/Interview Slip</title>
</head>
<body style="background-color: #fff">
  <div id="containerr">
     <div id="print_profilee">
      <h1>School of Nursing</h1>
	   <div class="add">
	    <p>Bowen University Teaching Hospital</p>
	    <p>P.O. Box 15, Ogbomoso</p>
		<img style="border: 3px groove #CECECE; float: right; background-color: #fff; margin-right: 0px;" src="http://sono.buth.edu.ng/passports/<?php echo $studentID; ?>.jpg" alt="<?php echo $surname; ?>" width="160px" height="160px">
   </div><br><br>
   <div class="date">
	  <p style='margin-left: 5px; font-family: "Lucida Grande","Lucida Sans Unicode",Tahoma,Sans-Serif'><label style='font-family: "Lucida Grande","Lucida Sans Unicode",Tahoma,Sans-Serif'><?php echo 'Date Printed:'. " " . $dateprinted; ?></label></p>
	 </div>
     <div class="print_profiledata">
	 <form action="" method="post">
	  <center><p>Interview</p></center>
	    <section>
			<p style='margin-left: 0px; font-size: 18px; font-family: monospace; color: #000000; text-transform: none; font-weight: normal;'><b>Names:</b> <?php echo $surname . " " . $firstName . " " . $otherNames;?></p>
			<p style='margin-left: 0px; font-size: 18px; font-family: monospace; color: #000000; text-transform: none; font-weight: normal;'><b>Email Address:</b> <?php echo $emaill ;?></p>
	    </section><br>
		<section>
			<p style='margin-left: 0px; font-size: 18px; font-family: monospace; color: #000000; text-transform: none; font-weight: normal; text-align: justify;'><?php echo $privateNews ;?></p><br><br>
			<label style='margin-left: 15px; font-size: 18px; color: #000000; font-family: monospace; text-transform: none; font-weight: bold;'>Mr. P.O. Olaoye</label><br>
			<label style='margin-left: 15px; font-size: 18px; color: #000000; text-transform: none; font-weight: normal; font-style: italic;'>Principal</label><br><br>
			<p style='margin-left: 15px; font-size: 18px; font-family: monospace; color: #000000; text-transform: none; font-weight: normal; text-align: justify;'>NOTE: The names on your credentials must tally with those on your birth certificate; otherwise you may not be interviewed. Presentation of sworn affidavit will not be accepted in this regard.</p>
	    </section>
	   <section>
        <p style='margin-left: 5px; font-size: 14px; color: #000000; text-transform: none'></p>
	   </section>
   </div>
  </div>
	  <input type="submit" value="BACK" name="back" style="margin-top: 20px; margin-left: 300px;  width: 90px">
	  <input type="button" onclick="printDiv('containerr'); window.open('examslip.php')" value="PRINT" style="width: 90px">		
    </form>
   </div>
</body>
</html>