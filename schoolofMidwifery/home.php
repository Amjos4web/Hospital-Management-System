<?php 
session_start();
ob_start();
if(!isset($_SESSION['emaill'])){
	header('location: login.php');
}
// error display configuration
//error_reporting(E_ALL & ~E_NOTICE);
//This block grabs the whole list for viewing
$msg="";
$emaill= $_SESSION['emaill'];
include "dbconnect.php";
$sql="SELECT * FROM `som` WHERE `eMail`='$emaill' LIMIT 1";
$check = mysqli_query($dbconnect, $sql);
$resultCount=mysqli_num_rows($check); //count the out amount 
if($resultCount>0){
	while($row=mysqli_fetch_array($check)){
		$email=$row["eMail"];
		$studentID=$row["studentid"];
		$surname=$row["surName"];
		$otherNames=$row["otherName"];
		$firstNames=$row["firstName"];
		$PhoneNo=$row["phoneNo"];
		$Year=$row["year"];
	}
}else{
$msg="<p style='color: red; padding-left: 8px'>You have no Information yet in the Database</p>";
}


// view notes
$displaynote = "";
$selectnote = "SELECT * FROM `addnotes`";
$checknote = mysqli_query($dbconnect, $selectnote);
$resultCount2=mysqli_num_rows($checknote); //count the out amount 
if($resultCount2>0){
	while($row=mysqli_fetch_array($checknote)){
		$title=$row["title"];
		$dateadded=$row["date"];
		$note=$row["notes"];
		$addedby=$row["added_by"];
		
		$notetitle = $title . " " . "By" . " " . $addedby;
		
		$displaynote .= '<label class="noteheading">'.$notetitle.'</label><br>';
	    $displaynote .= '<label class="dateadded">Published on: <i>'. " " .$dateadded.'</i></label><br>';
	    $displaynote .= '<p class="note">'.$note.'</p><br><br>';
	} 
}
?>
<!Doctype html>
<html>
<link href="http://localhost/buth_net/nursingSchool/css/buth_net.css" rel="stylesheet" type="text/css">
<head>
<meta charset="utf-8">
<link rel="shortcut icon" href="/favicon.ico" >
<title>My Account</title>
</head>
<body>
<?php
include_once "header.php";
?>
<div id="container" style="min-height: 300px;">
  <div id="sidebar1"><br>
    <p class="subHeader">Dashboard</p>
    <ul id="navigation2">
	  <?php
	  include_once "user_sidebar.php";
	  ?>
    </ul>
    <!-- end .sidebar1 --></div>
  <div class="margin" id="content">
   <center><h3 class="heading_text">My Account</h3></center><p style='float: right; padding: 1px 1px; margin-top: -40px; text-shadow:0px -1px 0px #2b665e; background-color:#082944; -moz-border-radius:2px; width: 167px; -webkit-border-radius:2px; border-radius:2px; border:0px solid #566963; text-align: center; color: #ffffff; font:14px Arial, Helvetica, sans-serif; margin-right: 15px'>Logged in as <?php echo "[" . $_SESSION['emaill'] . "]"; ?></p><br>
	 <img style="border: 2px solid #CECECE; border-radius: 50%; float: right; padding-left: 0px; margin-right: 15px;" src="../schoolofMidwifery/passports/<?php echo $studentID; ?>.jpg" alt="" width="160px" height="160px" class="image">
	  <section><h2 style='font-family: Calibri (Body); font-size: 22px; font-weight: bold; text-transform: uppercase; font-style: normal; color: #880000; text-shadow: 0 1px 0 #ccc,0 2px 0 #c9c9c9,0 3px 0 #bbb,0 4px 0 #b9b9b9,0 5px 0 #aaa,0 6px 1px rgba(0,0,0,.1),0 0 5px rgba(0,0,0,.1),0 1px 3px rgba(0,0,0,.3),0 3px 5px rgba(0,0,0,.2),0 5px 10px rgba(0,0,0,.25),0 10px 10px rgba(0,0,0,.2),0 20px 20px rgba(0,0,0,.15); float: left' id="name"><?php echo "<label style='color: #000000; font-family: Adobe Gothic Std B; font-size: 18px; text-shadow: none'>Welcome</label>" . " " .  $surname . " " . $firstNames . " " . $otherNames ; ?></h2></section><br><br><br>
      <section><label style='margin-left: 15px; font-family: tahoma; font-size: 16px; font-weight: bold'>Phone No</label><p style='float: right; margin-right: 190px;  font-family: helvetica'><?php echo $PhoneNo; ?></p></section><br>
      <section><label style='margin-left: 15px; font-family: tahoma; font-size: 16px; font-weight: bold'>Department</label><p style='float: right; margin-right: 190px;  font-family: helvetica'><?php echo $_SESSION['emaill']; ?></p></section><br>
      <section><label style='margin-left: 15px; font-family: tahoma; font-size: 16px; font-weight: bold'>Year</label><p style='float: right; margin-right: 190px;  font-family: helvetica'><?php echo $Year; ?></p></section><br><br>
	  <p style='float: right; background-color:#082944; -moz-border-radius:5px; -webkit-border-radius:5px; border-radius:5px; border:0px solid #566963; text-align: center; color:orange; font:14px Arial, Helvetica, sans-serif;  text-shadow:0px -1px 0px #2b665e; padding: 1px 1px; border: 0px groove #CECECE; width: 165px; margin-right: 15px'>Student ID:<br> <?php echo "BUTH/SOM/" . $studentID; ?></p><br><br>
	  <hr style='width: 770px; margin-left: 13px; margin-right: 10px; height: 6px; background-color: #14BCEB'><br>
	  <div class="notestodis"><?php echo $displaynote; ?></div>
	  </div>
  </div>
  
    <!-- end .content --></div>
  <?php
  include_once "footer.php";
  ?>
 </body>
</html>