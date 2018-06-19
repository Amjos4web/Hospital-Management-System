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
$uploaderror = "";
$uploadsuccess = "";
include "dbconnect.php";
$sql="SELECT * FROM `sono` WHERE `eMail`='$emaill' LIMIT 1";
$check = mysqli_query($dbconnect, $sql);
$resultCount=mysqli_num_rows($check); //count the out amount 
if($resultCount>0){
	while($row=mysqli_fetch_array($check)){
	$email=$row["eMail"];
	$studentID=$row["studentid"];
	$surname=$row["surName"];
	$otherNames=$row["otherName"];
	}
}else{
$msg="<p style='color: #D8000C; background-color: #FFBABA; border-radius:.5em; width: 300px; border: 1px solid #D8D8D8; padding: 5px; border-radius: 5px; margin-left: auto; margin-right: auto; font-family: Arial; font-size: 11px; text-transform: uppercase; text-align: center; text-transform: uppercase'>You have no Information yet in the Database</p>";
}

// for upload
if (isset($_POST['add']) && ($_POST['filename'] == "waec"))
{
	$tmpFilePath = $_FILES['file']['tmp_name'];
	if ($tmpFilePath != "")
	{
		$file_name = $_FILES['file']['name'];
		$finfo = finfo_open(FILEINFO_MIME_TYPE);
		$mime = finfo_file($finfo, $_FILES['file']['tmp_name']); 
		$size = $_FILES['file']['size'];
		$filename = $_POST['filename'];
		if($mime=='application/pdf')
		{ 
			if(!($size>'200000')) 
			{ 
				if(!get_magic_quotes_gpc()){ 
					$file_name = addslashes($file_name); 
				 
					$extract = fopen($tmpFilePath, 'r'); 
					$content = fread($extract, $size); 
					$content = addslashes($content); 
					fclose($extract);  
					// //Place files in the folder
					$newname = "$studentID.pdf";
					move_uploaded_file($_FILES['file']['tmp_name'], "../files/waec/$newname");
					$uploadsuccess = '<p style = "color: #4F8A10; margin-right: auto; margin-right: auto; text-align: center; background-color: #DFF2BF; border-radius:.5em; width: 400px; border: 1px solid #D8D8D8; margin-left: auto; margin-right: auto; padding: 5px; border-radius: 5px; font-family: Arial; font-size: 11px; text-transform: uppercase; text-transform: uppercase">'.$file_name.' uploaded successfully</p>';
				} else {
					$uploaderror = "<p style='color: #D8000C; background-color: #FFBABA; border-radius:.5em; width: 300px; border: 1px solid #D8D8D8; padding: 5px; border-radius: 5px; margin-left: auto; margin-right: auto; font-family: Arial; font-size: 11px; text-transform: uppercase; text-align: center; text-transform: uppercase'>Error has occured</p>";
				}
			} else {
				$uploaderror = "<p style='color: #D8000C; background-color: #FFBABA; border-radius:.5em; width: 300px; border: 1px solid #D8D8D8; padding: 5px; border-radius: 5px; margin-left: auto; margin-right: auto; font-family: Arial; font-size: 11px; text-transform: uppercase; text-align: center; text-transform: uppercase'>File uploaded is more than 200kb</p>";
			}
		} else {
			$uploaderror = "<p style='color: #D8000C; background-color: #FFBABA; border-radius:.5em; width: 300px; border: 1px solid #D8D8D8; padding: 5px; border-radius: 5px; margin-left: auto; margin-right: auto; font-family: Arial; font-size: 11px; text-transform: uppercase; text-align: center; text-transform: uppercase'>File format should be PDF</p>";
		}
	} else {
		$uploaderror = "<p style='color: #D8000C; background-color: #FFBABA; border-radius:.5em; width: 300px; border: 1px solid #D8D8D8; padding: 5px; border-radius: 5px; margin-left: auto; margin-right: auto; font-family: Arial; font-size: 11px; text-transform: uppercase; text-align: center; text-transform: uppercase'>Please choose a file to upload</p>";
	}
} else if (isset($_POST['add']) && ($_POST['filename'] == "neco"))
{
	$tmpFilePath = $_FILES['file']['tmp_name'];
	if ($tmpFilePath != "")
	{
		$file_name = $_FILES['file']['name'];
		$finfo = finfo_open(FILEINFO_MIME_TYPE);
		$mime = finfo_file($finfo, $_FILES['file']['tmp_name']); 
		$size = $_FILES['file']['size'];
		$filename = $_POST['filename'];
		if($mime=='application/pdf')
		{ 
			if(!($size>'200000')) 
			{ 
				if(!get_magic_quotes_gpc()){ 
					$file_name = addslashes($file_name); 
				 
					$extract = fopen($tmpFilePath, 'r'); 
					$content = fread($extract, $size); 
					$content = addslashes($content); 
					fclose($extract);  
					// //Place files in the folder
					$newname = "$studentID.pdf";
					move_uploaded_file($_FILES['file']['tmp_name'], "../files/neco/$newname");
					$uploadsuccess = '<p style = "color: #4F8A10; margin-right: auto; margin-right: auto; text-align: center; background-color: #DFF2BF; border-radius:.5em; width: 400px; border: 1px solid #D8D8D8; margin-left: auto; margin-right: auto; padding: 5px; border-radius: 5px; font-family: Arial; font-size: 11px; text-transform: uppercase; text-transform: uppercase">'.$file_name.' uploaded successfully</p>';
				} else {
					$uploaderror = "<p style='color: #D8000C; background-color: #FFBABA; border-radius:.5em; width: 300px; border: 1px solid #D8D8D8; padding: 5px; border-radius: 5px; margin-left: auto; margin-right: auto; font-family: Arial; font-size: 11px; text-transform: uppercase; text-align: center; text-transform: uppercase'>Error has occured</p>";
				}
			} else {
				$uploaderror = "<p style='color: #D8000C; background-color: #FFBABA; border-radius:.5em; width: 300px; border: 1px solid #D8D8D8; padding: 5px; border-radius: 5px; margin-left: auto; margin-right: auto; font-family: Arial; font-size: 11px; text-transform: uppercase; text-align: center; text-transform: uppercase'>File uploaded is more than 200kb</p>";
			}
		} else {
			$uploaderror = "<p style='color: #D8000C; background-color: #FFBABA; border-radius:.5em; width: 300px; border: 1px solid #D8D8D8; padding: 5px; border-radius: 5px; margin-left: auto; margin-right: auto; font-family: Arial; font-size: 11px; text-transform: uppercase; text-align: center; text-transform: uppercase'>File format should be PDF</p>";
		}
	} else {
		$uploaderror = "<p style='color: #D8000C; background-color: #FFB
		ABA; border-radius:.5em; width: 300px; border: 1px solid #D8D8D8; padding: 5px; border-radius: 5px; margin-left: auto; margin-right: auto; font-family: Arial; font-size: 11px; text-transform: uppercase; text-align: center; text-transform: uppercase'>Please choose a file to upload</p>";
	}
} else if (isset($_POST['add']) && ($_POST['filename'] == "localgov"))
{
	$tmpFilePath = $_FILES['file']['tmp_name'];
	if ($tmpFilePath != "")
	{
		$file_name = $_FILES['file']['name'];
		$finfo = finfo_open(FILEINFO_MIME_TYPE);
		$mime = finfo_file($finfo, $_FILES['file']['tmp_name']); 
		$size = $_FILES['file']['size'];
		$filename = $_POST['filename'];
		if($mime=='application/pdf')
		{ 
			if(!($size>'200000')) 
			{ 
				if(!get_magic_quotes_gpc()){ 
					$file_name = addslashes($file_name); 
				 
					$extract = fopen($tmpFilePath, 'r'); 
					$content = fread($extract, $size); 
					$content = addslashes($content); 
					fclose($extract);  
					// //Place files in the folder
					$newname = "$studentID.pdf";
					move_uploaded_file($_FILES['file']['tmp_name'], "../files/localGov/$newname");
					$uploadsuccess = '<p style = "color: #4F8A10; margin-right: auto; margin-right: auto; text-align: center; background-color: #DFF2BF; border-radius:.5em; width: 400px; border: 1px solid #D8D8D8; margin-left: auto; margin-right: auto; padding: 5px; border-radius: 5px; font-family: Arial; font-size: 11px; text-transform: uppercase; text-transform: uppercase">'.$file_name.' uploaded successfully</p>';
				} else {
					$uploaderror = "<p style='color: #D8000C; background-color: #FFBABA; border-radius:.5em; width: 300px; border: 1px solid #D8D8D8; padding: 5px; border-radius: 5px; margin-left: auto; margin-right: auto; font-family: Arial; font-size: 11px; text-transform: uppercase; text-align: center; text-transform: uppercase'>Error has occured</p>";
				}
			} else {
				$uploaderror = "<p style='color: #D8000C; background-color: #FFBABA; border-radius:.5em; width: 300px; border: 1px solid #D8D8D8; padding: 5px; border-radius: 5px; margin-left: auto; margin-right: auto; font-family: Arial; font-size: 11px; text-transform: uppercase; text-align: center; text-transform: uppercase'>File uploaded is more than 200kb</p>";
			}
		} else {
			$uploaderror = "<p style='color: #D8000C; background-color: #FFBABA; border-radius:.5em; width: 300px; border: 1px solid #D8D8D8; padding: 5px; border-radius: 5px; margin-left: auto; margin-right: auto; font-family: Arial; font-size: 11px; text-transform: uppercase; text-align: center; text-transform: uppercase'>File format should be PDF</p>";
		}
	} else {
		$uploaderror = "<p style='color: #D8000C; background-color: #FFBABA; border-radius:.5em; width: 300px; border: 1px solid #D8D8D8; padding: 5px; border-radius: 5px; margin-left: auto; margin-right: auto; font-family: Arial; font-size: 11px; text-transform: uppercase; text-align: center; text-transform: uppercase'>Please choose a file to upload</p>";
	}
} else if (isset($_POST['add']) && ($_POST['filename'] == "birthcertificate"))
{
	$tmpFilePath = $_FILES['file']['tmp_name'];
	if ($tmpFilePath != "")
	{
		$file_name = $_FILES['file']['name'];
		$finfo = finfo_open(FILEINFO_MIME_TYPE);
		$mime = finfo_file($finfo, $_FILES['file']['tmp_name']); 
		$size = $_FILES['file']['size'];
		$filename = $_POST['filename'];
		if($mime=='application/pdf')
		{ 
			if(!($size>'200000')) 
			{ 
				if(!get_magic_quotes_gpc()){ 
					$file_name = addslashes($file_name); 
				 
					$extract = fopen($tmpFilePath, 'r'); 
					$content = fread($extract, $size); 
					$content = addslashes($content); 
					fclose($extract);  
					// //Place files in the folder
					$newname = "$studentID.pdf";
					move_uploaded_file($_FILES['file']['tmp_name'], "../files/birthCertificate/$newname");
					$uploadsuccess = '<p style = "color: #4F8A10; margin-right: auto; margin-right: auto; text-align: center; background-color: #DFF2BF; border-radius:.5em; width: 400px; border: 1px solid #D8D8D8; margin-left: auto; margin-right: auto; padding: 5px; border-radius: 5px; font-family: Arial; font-size: 11px; text-transform: uppercase; text-transform: uppercase">'.$file_name.' uploaded successfully</p>';
				} else {
					$uploaderror = "<p style='color: #D8000C; background-color: #FFBABA; border-radius:.5em; width: 300px; border: 1px solid #D8D8D8; padding: 5px; border-radius: 5px; margin-left: auto; margin-right: auto; font-family: Arial; font-size: 11px; text-transform: uppercase; text-align: center; text-transform: uppercase'>Error has occured</p>";
				}
			} else {
				$uploaderror = "<p style='color: #D8000C; background-color: #FFBABA; border-radius:.5em; width: 300px; border: 1px solid #D8D8D8; padding: 5px; border-radius: 5px; margin-left: auto; margin-right: auto; font-family: Arial; font-size: 11px; text-transform: uppercase; text-align: center; text-transform: uppercase'>File uploaded is more than 200kb</p>";
			}
		} else {
			$uploaderror = "<p style='color: #D8000C; background-color: #FFBABA; border-radius:.5em; width: 300px; border: 1px solid #D8D8D8; padding: 5px; border-radius: 5px; margin-left: auto; margin-right: auto; font-family: Arial; font-size: 11px; text-transform: uppercase; text-align: center; text-transform: uppercase'>File format should be PDF</p>";
		}
	} else {
		$uploaderror = "<p style='color: #D8000C; background-color: #FFBABA; border-radius:.5em; width: 300px; border: 1px solid #D8D8D8; padding: 5px; border-radius: 5px; margin-left: auto; margin-right: auto; font-family: Arial; font-size: 11px; text-transform: uppercase; text-align: center; text-transform: uppercase'>Please choose a file to upload</p>";
	}
} else if (isset($_POST['add']) && ($_POST['filename'] == "bankteller"))
{
	$tmpFilePath = $_FILES['file']['tmp_name'];
	if ($tmpFilePath != "")
	{
		$file_name = $_FILES['file']['name'];
		$size = $_FILES['file']['size'];
		$mime = $_FILES['file']['type'];
		$filename = $_POST['filename'];
		if($mime=='image/jpg' || $mime=='image/jpeg' || $mime=='image/png')
		{ 
			if(!($size>'200000')) 
			{ 
				if(!get_magic_quotes_gpc()){ 
					$file_name = addslashes($file_name); 
				 
					$extract = fopen($tmpFilePath, 'r'); 
					$content = fread($extract, $size); 
					$content = addslashes($content); 
					fclose($extract);  
					// //Place files in the folder
					$newnameteller = "$studentID.jpg";
					move_uploaded_file($_FILES['file']['tmp_name'], "../files/bankteller/$newnameteller");
					$uploadsuccess = '<p style = "color: #4F8A10; margin-right: auto; margin-right: auto; text-align: center; background-color: #DFF2BF; border-radius:.5em; width: 400px; border: 1px solid #D8D8D8; margin-left: auto; margin-right: auto; padding: 5px; border-radius: 5px; font-family: Arial; font-size: 11px; text-transform: uppercase; text-transform: uppercase">'.$file_name.' uploaded successfully</p>';
				} else {
					$uploaderror = "<p style='color: #D8000C; background-color: #FFBABA; border-radius:.5em; width: 300px; border: 1px solid #D8D8D8; padding: 5px; border-radius: 5px; margin-left: auto; margin-right: auto; font-family: Arial; font-size: 11px; text-transform: uppercase; text-align: center; text-transform: uppercase'>Error has occured</p>";
				}
			} else {
				$uploaderror = "<p style='color: #D8000C; background-color: #FFBABA; border-radius:.5em; width: 300px; border: 1px solid #D8D8D8; padding: 5px; border-radius: 5px; margin-left: auto; margin-right: auto; font-family: Arial; font-size: 11px; text-transform: uppercase; text-align: center; text-transform: uppercase'>File uploaded is more than 20kb</p>";
			}
		} else {
			$uploaderror = "<p style='color: #D8000C; background-color: #FFBABA; border-radius:.5em; width: 300px; border: 1px solid #D8D8D8; padding: 5px; border-radius: 5px; margin-left: auto; margin-right: auto; font-family: Arial; font-size: 11px; text-transform: uppercase; text-align: center; text-transform: uppercase'>$file_name should be in JGEP, JPG or PNG format</p>";
		}
	} else {
		$uploaderror = "<p style='color: #D8000C; background-color: #FFBABA; border-radius:.5em; width: 300px; border: 1px solid #D8D8D8; padding: 5px; border-radius: 5px; margin-left: auto; margin-right: auto; font-family: Arial; font-size: 11px; text-transform: uppercase; text-align: center; text-transform: uppercase'>Please choose a file to upload</p>";
	}
}

if (isset($_POST['proceed'])){
	$examNo1 = htmlspecialchars(trim($_POST['examNo1']));
	$examType1 = htmlspecialchars($_POST['examType1']);
	$year1 = htmlspecialchars($_POST['year1']);
	$examNo2 = htmlspecialchars(trim($_POST['examNo2']));
	$examType2 = htmlspecialchars($_POST['examType2']);
	$year2 = htmlspecialchars($_POST['year2']);
	$subject1 = htmlspecialchars($_POST['subject1']);
	$grade1 = htmlspecialchars($_POST['grade1']);
	$subject2 = htmlspecialchars($_POST['subject2']);
	$grade2 = htmlspecialchars($_POST['grade2']);
	$subject3 = htmlspecialchars($_POST['subject3']);
	$grade3 = htmlspecialchars($_POST['grade3']);
	$subject4 = htmlspecialchars($_POST['subject4']);
	$grade4 = htmlspecialchars($_POST['grade4']);
	$subject5 = htmlspecialchars($_POST['subject5']);
	$grade5 = htmlspecialchars($_POST['grade5']);
	$subject6 = htmlspecialchars($_POST['subject6']);
	$grade6 = htmlspecialchars($_POST['grade6']);
	$subject7 = htmlspecialchars($_POST['subject7']);
	$grade7 = htmlspecialchars($_POST['grade7']);
	$subject8 = htmlspecialchars($_POST['subject8']);
	$grade8 = htmlspecialchars($_POST['grade8']);
	$subject9 = htmlspecialchars($_POST['subject9']);
	$grade9 = htmlspecialchars($_POST['grade9']);
	$subject11 = htmlspecialchars($_POST['subject11']);
	$grade11 = htmlspecialchars($_POST['grade11']);
	$subject22 = htmlspecialchars($_POST['subject22']);
	$grade22 = htmlspecialchars($_POST['grade22']);
	$subject33 = htmlspecialchars($_POST['subject33']);
	$grade33 = htmlspecialchars($_POST['grade33']);
	$subject44 = htmlspecialchars($_POST['subject44']);
	$grade44 = htmlspecialchars($_POST['grade44']);
	$subject55 = htmlspecialchars($_POST['subject55']);
	$grade55 = htmlspecialchars($_POST['grade55']);
	$subject66 = htmlspecialchars($_POST['subject66']);
	$grade66 = htmlspecialchars($_POST['grade66']);
	$subject77 = htmlspecialchars($_POST['subject77']);
	$grade77 = htmlspecialchars($_POST['grade77']);
	$subject88 = htmlspecialchars($_POST['subject88']);
	$grade88 = htmlspecialchars($_POST['grade88']);
	$subject99 = htmlspecialchars($_POST['subject99']);
	$grade99 = htmlspecialchars($_POST['grade99']);
	$date_added = date('Y.m.d - H:i:s');
	
	if (empty($examNo1 && $examType1 && $year1 && $subject1 && $grade1 && $subject2 && $grade2 && $subject3 && $grade3 && $subject4 && $grade4 && $subject5 && $grade5 && $subject6 && $grade6 && $subject7 && $grade7 && $subject8 && $grade8 && $subject9 && $grade9) == false)
	{
		?><script language="Javascript" type="text/javascript">
			alert("Are you sure you want to continue?");
		</script><?php
		$sql = "UPDATE `sono_0level_results` SET `examNo1`='$examNo1', `examType1`='$examType1', `year1`='$year1', `examNo2`='$examNo2', `examType2`='$examType2', `year2`='$year2', `Subject1`='$subject1', `Grade1`='$grade1', `Subject2`='$subject2', `Grade2`='$grade2', `Subject3`='$subject3', `Grade3`='$grade3', `Subject4`='$subject4', `Grade4`='$grade4', `Subject5`='$subject5', `Grade5`='$grade5', `Subject6`='$subject6', `Grade6`='$grade6', `Subject7`='$subject7', `Grade7`='$grade7', `Subject8`='$subject8', `Grade8`='$grade8', `Subject9`='$subject9', `Grade9`='$grade9', `Subject11`='$subject11', `Grade11`='$grade11', `Subject22`='$subject22', `Grade22`='$grade22', `Subject33`='$subject33', `Grade33`='$grade33', `Subject44`='$subject44', `Grade44`='$grade44', `Subject55`='$subject55', `Grade55`='$grade55', `Subject66`='$subject66', `Grade66`='$grade66', `Subject77`='$subject77', `Grade77`='$grade77', `Subject88`='$subject88', `Grade88`='$grade88', `Subject99`='$subject99', `Grade99`='$grade99', `date_added`='$date_added' WHERE `eMail`='$email'";
		$query = mysqli_query($dbconnect, $sql);
		header ('location: printouts.php');
	} else {
		$msg="<p style='color: #D8000C; background-color: #FFBABA; border-radius:.5em; width: 300px; border: 1px solid #D8D8D8; padding: 5px; border-radius: 5px; margin-left: auto; margin-right: auto; font-family: Arial; font-size: 11px; text-transform: uppercase; text-align: center; text-transform: uppercase'>Please fill in the required fields</p>";
	} 
} 




if (isset($_POST['back'])){
	header ('location: education.php');
}
?>
<!DOCTYPE html>
<html>
<link href="http://localhost/buth_net/nursingSchool/css/buth_net.css" rel="stylesheet" type="text/css">
<head>
<meta charset="utf-8">
<link rel="shortcut icon" href="/favicon.ico" >
<script src="js/jquery-1.12.3.min.js" type="text/javascript"></script>
<script>
$(document).ready(function(){
	$('.heading_text2').click(function(){
	$('.exam_details2').slideDown(1000);
	$('#results2').slideDown(1000);
	$('.heading_text2').slideUp(2000);
	});
});
</script>
<title>O'Level Results/School of Nursing</title>
</head>
<body>
<?php
include_once "header.php";
?>
<div id="container">
  <div id="sidebar1"><br>
    <p class="subHeader">Menu</p>
    <ul id="navigation2">
	  <li class="page_title">School Of Nursing</li><br>
	  <li><a href="index.php">Homepage</a></li><br>
      <li><a href="register.php">Register</a></li><br>
      <li><a href="login.php">Login</a></li><br>
    </ul>
	 <?php include_once "../new_bar.php"; ?>
    <!-- end .sidebar1 --></div>
  <div class="margin" id="content">
    <div id="Tabs">
	 <ul>
		<li id="li_tab1" class="current_tab"><a href="form1.php">BIO-DATA</a></li>
		<li id="li_tab2"><a href="form2.php">NEXT OF KIN & SPONSOR</a></li>
		<li id="li_tab3"><a href="education.php">EDUCATION BACKGROUND</a></li>
		<li id="li_tab4"><a href="results.php">O'LEVEL RESULTS</a></li>
	  </ul><br><br><br>
		<div id="Content_Area">
		 <div class="bio_data">
		 <div class="form">
		  <fieldset class="result_data" style="width: 700px; min-height: 370px">
			<form action="" method="post" enctype="multipart/form-data">
			<div class="exam_details">
			<p style='text-align: center; font-style: italic; font-family: arial; font-size: 12px'>You have to upload three files (<b>Results, Birth Certificate and Local Gov. Identity</b>)<br>Click <b>Add</b> button to choose another file before you proceed</p>
			<?php echo $uploadsuccess; ?>
			<?php echo $uploaderror; ?>
			  <table style="width: 580px; margin-left: auto; margin-right: auto;">
			     <tr style="margin-right: 10px;">
				   <th width="50%"><label style="color: #880000; font: 12px verdana;">Upload Files</label>
				   <p><input type="file" style="margin-left: -10px; width: 180px"  name="file"></p></th>
				   <th width="50%"><label style="color: #880000; font: 12px verdana;">File Name</label>
				   <p><select name="filename" class="userr">
					   <option value="waec">WAEC</option>
					   <option value="neco">NECO</option>
					   <option value="birthcertificate">Birth Certificate</option>
					   <option value="localgov">Local Government Identity</option>
					   <option value="bankteller">Bank Teller</option>
					 </select></p></th>				   				 
				</tr>
			  </table><br>
			  <center><input type="submit" value="Add" name="add" id="proceed2"></center>
			  </div><br>
			  <p style='text-align: center; font-style: italic; font-family: arial; font-size: 12px'>Under the <b>GRADE</b> column, select "AR" if you are awaiting result</p>
				</select>
			<?php
			echo $msg;
			?>
			<div id="0level">
			<div class="exam_details">
			 <table style="width: 580px; margin-left: auto; margin-right: auto">
			     <tr style="margin-right: 10px; width: 50px">
				   <th width="35%"><label style="color: #880000; font: 12px verdana;">Examination No</label>
				   <p><input type="text" style="width: 100%" class="userrr" name="examNo1" placeholder="23432343FG"></p></th>
				   <th width="35%"><label style="color: #880000; font: 12px verdana;">Examination Type</label>
				   <p><select name="examType1" class="userr2">
                   <option value="SSCE/result">SSCE/WAEC</option>
				   <option value="SSCE/NECO">SSCE/NECO</option>
				   <option value="GCE/result">GCE/WAEC</option>
				   <option value="GEC/NECO">GEC/NECO</option></p>
                 </select></th>				   				 
				   <th width="30%"><label style="color: #880000; font: 12px verdana;">Year</label>
				   <p><select name="year1" class="userr2">
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
				   <option value="2016">2016</option><p>
				  </select></th>
				</tr>
			  </table>
			  </div><br>
			 <div id="results1">
			  <table width="420px" style="margin-left: auto; margin-right: auto">
			    <tr>
				   <th width="10%">S/N</th>
				   <th width="70%">SUBJECTS</th>
				   <th width="20%">GRADE</th>
				</tr>
                <tr>
                   <td width="10%">1</td>
                   <td width="70%"><select name="subject1" class="userr">
				   <option value="null">Select Subject</option>
				   <option value="Mathematics">Mathematics</option>
				   <option value="English Language">English Language</option>
				   <option value="Biology">Biology</option>
				   <option value="Physics">Physics</option>
				   <option value="Chemistry">Chemistry</option>
				   <option value="Economics">Economics</option>
				   <option value="Civic Education">Civic Education</option>
				   <option value="Yoruba">Yoruba</option></
				   <option value="Igbo">Igbo</option>
				   <option value="Hausa">Hausa</option>	
                 </select></td>	
                   <td width="20%"><select name="grade1" class="userrr">
                   <option value="AR">AR</option>
				   <option value="A1">A1</option>
				   <option value="B2">B2</option>
				   <option value="B3">B3</option>
				   <option value="C4">C4</option>
				   <option value="C5">C5</option>
				   <option value="C6">C6</option>
				   <option value="D7">D7</option>
				   <option value="E8">E8</option>
				   <option value="F9">F9</option>
                 </select></td>				   				 
                </tr>
				<tr>
                   <td width="10%">2</td>
                   <td width="70%"><select name="subject2" class="userr">
				   <option value="null">Select Subject</option>
				   <option value="Mathematics">Mathematics</option>
				   <option value="English Language">English Language</option>
				   <option value="Biology">Biology</option>
				   <option value="Physics">Physics</option>
				   <option value="Chemistry">Chemistry</option>
				   <option value="Economics">Economics</option>
				   <option value="Civic Education">Civic Education</option>
				   <option value="Yoruba">Yoruba</option></
				   <option value="Igbo">Igbo</option>
				   <option value="Hausa">Hausa</option>	
                 </select></td>		
                   <td width="20%"><select name="grade2" class="userrr">
                   <option value="AR">AR</option>
				   <option value="A1">A1</option>
				   <option value="B2">B2</option>
				   <option value="B3">B3</option>
				   <option value="C4">C4</option>
				   <option value="C5">C5</option>
				   <option value="C6">C6</option>
				   <option value="D7">D7</option>
				   <option value="E8">E8</option>
				   <option value="F9">F9</option>
                 </select></td>
                 </tr>
                <tr>
                   <td width="5%">3</td>
                   <td width="70%"><select name="subject3" class="userr">
				   <option value="null">Select Subject</option>
				   <option value="Mathematics">Mathematics</option>
				   <option value="English Language">English Language</option>
				   <option value="Biology">Biology</option>
				   <option value="Physics">Physics</option>
				   <option value="Chemistry">Chemistry</option>
				   <option value="Economics">Economics</option>
				   <option value="Civic Education">Civic Education</option>
				   <option value="Yoruba">Yoruba</option></
				   <option value="Igbo">Igbo</option>
				   <option value="Hausa">Hausa</option>	
                 </select></td>
                  <td width="20%"><select name="grade3" class="userrr">
                   <option value="AR">AR</option>
				   <option value="A1">A1</option>
				   <option value="B2">B2</option>
				   <option value="B3">B3</option>
				   <option value="C4">C4</option>
				   <option value="C5">C5</option>
				   <option value="C6">C6</option>
				   <option value="D7">D7</option>
				   <option value="E8">E8</option>
				   <option value="F9">F9</option>
                 </select></td>				   						 
                </tr>
                <tr>
                   <td width="5%">4</td>
                   <td width="70%"><select name="subject4" class="userr">
				   <option value="null">Select Subject</option>
				   <option value="Mathematics">Mathematics</option>
				   <option value="English Language">English Language</option>
				   <option value="Biology">Biology</option>
				   <option value="Physics">Physics</option>
				   <option value="Chemistry">Chemistry</option>
				   <option value="Economics">Economics</option>
				   <option value="Civic Education">Civic Education</option>
				   <option value="Yoruba">Yoruba</option></
				   <option value="Igbo">Igbo</option>
				   <option value="Hausa">Hausa</option>	
                 </select></td>
                   <td width="20%"><select name="grade4" class="userrr">
                   <option value="AR">AR</option>
				   <option value="A1">A1</option>
				   <option value="B2">B2</option>
				   <option value="B3">B3</option>
				   <option value="C4">C4</option>
				   <option value="C5">C5</option>
				   <option value="C6">C6</option>
				   <option value="D7">D7</option>
				   <option value="E8">E8</option>
				   <option value="F9">F9</option>
                 </select></td>				   						 
                </tr>
                <tr>
                   <td width="5%">5</td>
                   <td width="70%"><select name="subject5" class="userr">
				   <option value="null">Select Subject</option>
				   <option value="Mathematics">Mathematics</option>
				   <option value="English Language">English Language</option>
				   <option value="Biology">Biology</option>
				   <option value="Physics">Physics</option>
				   <option value="Chemistry">Chemistry</option>
				   <option value="Economics">Economics</option>
				   <option value="Civic Education">Civic Education</option>
				   <option value="Yoruba">Yoruba</option></
				   <option value="Igbo">Igbo</option>
				   <option value="Hausa">Hausa</option>	
                 </select></td>
                  <td width="20%"><select name="grade5" class="userrr">
                   <option value="AR">AR</option>
				   <option value="A1">A1</option>
				   <option value="B2">B2</option>
				   <option value="B3">B3</option>
				   <option value="C4">C4</option>
				   <option value="C5">C5</option>
				   <option value="C6">C6</option>
				   <option value="D7">D7</option>
				   <option value="E8">E8</option>
				   <option value="F9">F9</option>
				  </select></td>
                </tr>
                <tr>
                   <td width="5%">6</td>
                   <td width="70%"><select name="subject6" class="userr">
				   <option value="null">Select Subject</option>
				   <option value="Mathematics">Mathematics</option>
				   <option value="English Language">English Language</option>
				   <option value="Biology">Biology</option>
				   <option value="Physics">Physics</option>
				   <option value="Chemistry">Chemistry</option>
				   <option value="Economics">Economics</option>
				   <option value="Civic Education">Civic Education</option>
				   <option value="Yoruba">Yoruba</option></
				   <option value="Igbo">Igbo</option>
				   <option value="Hausa">Hausa</option>		
                 </select></td>
                   <td width="20%"><select name="grade6" class="userrr">
                   <option value="AR">AR</option>
				   <option value="A1">A1</option>
				   <option value="B2">B2</option>
				   <option value="B3">B3</option>
				   <option value="C4">C4</option>
				   <option value="C5">C5</option>
				   <option value="C6">C6</option>
				   <option value="D7">D7</option>
				   <option value="E8">E8</option>
				   <option value="F9">F9</option>
                 </select></td>				   						 
                </tr>
                <tr>
                   <td width="5%">7</td>
                   <td width="70%"><select name="subject7" class="userr">
				   <option value="null">Select Subject</option>
				   <option value="Mathematics">Mathematics</option>
				   <option value="English Language">English Language</option>
				   <option value="Biology">Biology</option>
				   <option value="Physics">Physics</option>
				   <option value="Chemistry">Chemistry</option>
				   <option value="Economics">Economics</option>
				   <option value="Civic Education">Civic Education</option>
				   <option value="Yoruba">Yoruba</option></
				   <option value="Igbo">Igbo</option>
				   <option value="Hausa">Hausa</option>	
                 </select></td>	
                   <td width="20%"><select name="grade7" class="userrr">
                   <option value="AR">AR</option>
				   <option value="A1">A1</option>
				   <option value="B2">B2</option>
				   <option value="B3">B3</option>
				   <option value="C4">C4</option>
				   <option value="C5">C5</option>
				   <option value="C6">C6</option>
				   <option value="D7">D7</option>
				   <option value="E8">E8</option>
				   <option value="F9">F9</option>
                 </select></td>				   						 
                </tr>
                <tr>
                   <td width="5%">8</td>
                   <td width="70%"><select name="subject8" class="userr">
				   <option value="null">Select Subject</option>
				   <option value="Mathematics">Mathematics</option>
				   <option value="English Language">English Language</option>
				   <option value="Biology">Biology</option>
				   <option value="Physics">Physics</option>
				   <option value="Chemistry">Chemistry</option>
				   <option value="Economics">Economics</option>
				   <option value="Civic Education">Civic Education</option>
				   <option value="Yoruba">Yoruba</option></
				   <option value="Igbo">Igbo</option>
				   <option value="Hausa">Hausa</option>	
                 </select></td>
                   <td width="20%"><select name="grade8" class="userrr">
                   <option value="AR">AR</option>
				   <option value="A1">A1</option>
				   <option value="B2">B2</option>
				   <option value="B3">B3</option>
				   <option value="C4">C4</option>
				   <option value="C5">C5</option>
				   <option value="C6">C6</option>
				   <option value="D7">D7</option>
				   <option value="E8">E8</option>
				   <option value="F9">F9</option>
                 </select></td>				   						 
                </tr>
                <tr>
                   <td width="5%">9</td>
                   <td width="70%"><select name="subject9" class="userr">
				   <option value="null">Select Subject</option>
				   <option value="Mathematics">Mathematics</option>
				   <option value="English Language">English Language</option>
				   <option value="Biology">Biology</option>
				   <option value="Physics">Physics</option>
				   <option value="Chemistry">Chemistry</option>
				   <option value="Economics">Economics</option>
				   <option value="Civic Education">Civic Education</option>
				   <option value="Yoruba">Yoruba</option></
				   <option value="Igbo">Igbo</option>
				   <option value="Hausa">Hausa</option>	
                 </select></td>
                   <td width="20%"><select name="grade9" class="userrr">
                   <option value="AR">AR</option>
				   <option value="A1">A1</option>
				   <option value="B2">B2</option>
				   <option value="B3">B3</option>
				   <option value="C4">C4</option>
				   <option value="C5">C5</option>
				   <option value="C6">C6</option>
				   <option value="D7">D7</option>
				   <option value="E8">E8</option>
				   <option value="F9">F9</option>
                 </select></td>				   						 
                </tr>
             </div>    				
			</table><br><br>
			<center><h3 class="heading_text2">Click here to add another result</h3></center><br>
			 <div class="exam_details2" style="display: none;">
			 <table style="width: 580px; margin-left: auto; margin-right: auto;">
			     <tr style="margin-right: 10px">
				   <th width="35%"><label style="color: #880000; font: 12px verdana;">Examination No</label>
				   <p><input type="text" style="width: 100%" class="userr" name="examNo2" placeholder="23432343FG"></p></th>
				   <th width="35%"><label style="color: #880000; font: 12px verdana;">Examination Type</label>
				   <p><select name="examType2" class="userr2">
                   <option value="SSCE/result">SSCE/WAEC</option>
				   <option value="SSCE/NECO">SSCE/NECO</option>
				   <option value="GCE/result">GCE/WAEC</option>
				   <option value="GEC/NECO">GEC/NECO</option></p>
                 </select></th>				   				 
				   <th width="30%"><label style="color: #880000; font: 12px verdana;">Year</label>
				   <p><select name="year2" class="userr2">
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
				   <option value="2016">2016</option><p>
				  </select></th>
				</tr>
			  </table>
			  </div><br>
			<div id="results2" style="display: none">
			 <table width="420px" style="margin-left: auto; margin-right: auto">
				<tr>
				   <th width="10%">S/N</th>
				   <th width="70%">SUBJECTS</th>
				   <th width="20%">GRADE</th>
				</tr>
                <tr>
                   <td width="10%">1</td>
                   <td width="70%"><select name="subject11" class="userr">
				   <option value="null">Select Subject</option>
				   <option value="Mathematics">Mathematics</option>
				   <option value="English Language">English Language</option>
				   <option value="Biology">Biology</option>
				   <option value="Physics">Physics</option>
				   <option value="Chemistry">Chemistry</option>
				   <option value="Economics">Economics</option>
				   <option value="Civic Education">Civic Education</option>
				   <option value="Yoruba">Yoruba</option></
				   <option value="Igbo">Igbo</option>
				   <option value="Hausa">Hausa</option>	
                 </select></td>	
                   <td width="20%"><select name="grade11" class="userrr">
                   <option value="AR">AR</option>
				   <option value="A1">A1</option>
				   <option value="B2">B2</option>
				   <option value="B3">B3</option>
				   <option value="C4">C4</option>
				   <option value="C5">C5</option>
				   <option value="C6">C6</option>
				   <option value="D7">D7</option>
				   <option value="E8">E8</option>
				   <option value="F9">F9</option>
                 </select></td>				   				 
                </tr>
				<tr>
                   <td width="10%">2</td>
                   <td width="70%"><select name="subject22" class="userr">
				   <option value="null">Select Subject</option>
				   <option value="Mathematics">Mathematics</option>
				   <option value="English Language">English Language</option>
				   <option value="Biology">Biology</option>
				   <option value="Physics">Physics</option>
				   <option value="Chemistry">Chemistry</option>
				   <option value="Economics">Economics</option>
				   <option value="Civic Education">Civic Education</option>
				   <option value="Yoruba">Yoruba</option></
				   <option value="Igbo">Igbo</option>
				   <option value="Hausa">Hausa</option>	
                 </select></td>		
                   <td width="20%"><select name="grade22" class="userrr">
                   <option value="AR">AR</option>
				   <option value="A1">A1</option>
				   <option value="B2">B2</option>
				   <option value="B3">B3</option>
				   <option value="C4">C4</option>
				   <option value="C5">C5</option>
				   <option value="C6">C6</option>
				   <option value="D7">D7</option>
				   <option value="E8">E8</option>
				   <option value="F9">F9</option>
                 </select></td>	
                 </tr>
                <tr>
                   <td width="5%">3</td>
                   <td width="70%"><select name="subject33" class="userr">
				   <option value="null">Select Subject</option>
				   <option value="Mathematics">Mathematics</option>
				   <option value="English Language">English Language</option>
				   <option value="Biology">Biology</option>
				   <option value="Physics">Physics</option>
				   <option value="Chemistry">Chemistry</option>
				   <option value="Economics">Economics</option>
				   <option value="Civic Education">Civic Education</option>
				   <option value="Yoruba">Yoruba</option></
				   <option value="Igbo">Igbo</option>
				   <option value="Hausa">Hausa</option>	
                 </select></td>
                  <td width="20%"><select name="grade33" class="userrr">
                   <option value="AR">AR</option>
				   <option value="A1">A1</option>
				   <option value="B2">B2</option>
				   <option value="B3">B3</option>
				   <option value="C4">C4</option>
				   <option value="C5">C5</option>
				   <option value="C6">C6</option>
				   <option value="D7">D7</option>
				   <option value="E8">E8</option>
				   <option value="F9">F9</option>
                 </select></td>				   						 
                </tr>
                <tr>
                   <td width="5%">4</td>
                   <td width="70%"><select name="subject44" class="userr">
				   <option value="null">Select Subject</option>
				   <option value="Mathematics">Mathematics</option>
				   <option value="English Language">English Language</option>
				   <option value="Biology">Biology</option>
				   <option value="Physics">Physics</option>
				   <option value="Chemistry">Chemistry</option>
				   <option value="Economics">Economics</option>
				   <option value="Civic Education">Civic Education</option>
				   <option value="Yoruba">Yoruba</option></
				   <option value="Igbo">Igbo</option>
				   <option value="Hausa">Hausa</option>	
                 </select></td>
                   <td width="20%"><select name="grade44" class="userrr">
                   <option value="AR">AR</option>
				   <option value="A1">A1</option>
				   <option value="B2">B2</option>
				   <option value="B3">B3</option>
				   <option value="C4">C4</option>
				   <option value="C5">C5</option>
				   <option value="C6">C6</option>
				   <option value="D7">D7</option>
				   <option value="E8">E8</option>
				   <option value="F9">F9</option>
                 </select></td>				   						 
                </tr>
                <tr>
                   <td width="5%">5</td>
                   <td width="70%"><select name="subject55" class="userr">
				   <option value="null">Select Subject</option>
				   <option value="Mathematics">Mathematics</option>
				   <option value="English Language">English Language</option>
				   <option value="Biology">Biology</option>
				   <option value="Physics">Physics</option>
				   <option value="Chemistry">Chemistry</option>
				   <option value="Economics">Economics</option>
				   <option value="Civic Education">Civic Education</option>
				   <option value="Yoruba">Yoruba</option></
				   <option value="Igbo">Igbo</option>
				   <option value="Hausa">Hausa</option>
                 </select></td>
                  <td width="20%"><select name="grade55" class="userrr">
                   <option value="AR">AR</option>
				   <option value="A1">A1</option>
				   <option value="B2">B2</option>
				   <option value="B3">B3</option>
				   <option value="C4">C4</option>
				   <option value="C5">C5</option>
				   <option value="C6">C6</option>
				   <option value="D7">D7</option>
				   <option value="E8">E8</option>
				   <option value="F9">F9</option>
                </tr></select></td>
                <tr>
                   <td width="5%">6</td>
                   <td width="70%"><select name="subject66" class="userr">
				   <option value="null">Select Subject</option>
				   <option value="Mathematics">Mathematics</option>
				   <option value="English Language">English Language</option>
				   <option value="Biology">Biology</option>
				   <option value="Physics">Physics</option>
				   <option value="Chemistry">Chemistry</option>
				   <option value="Economics">Economics</option>
				   <option value="Civic Education">Civic Education</option>
				   <option value="Yoruba">Yoruba</option></
				   <option value="Igbo">Igbo</option>
				   <option value="Hausa">Hausa</option>	
                 </select></td>
                   <td width="20%"><select name="grade66" class="userrr">
                   <option value="AR">AR</option>
				   <option value="A1">A1</option>
				   <option value="B2">B2</option>
				   <option value="B3">B3</option>
				   <option value="C4">C4</option>
				   <option value="C5">C5</option>
				   <option value="C6">C6</option>
				   <option value="D7">D7</option>
				   <option value="E8">E8</option>
				   <option value="F9">F9</option>
                 </select></td>				   						 
                </tr>
                <tr>
                   <td width="5%">7</td>
                   <td width="70%"><select name="subject77" class="userr">
				   <option value="null">Select Subject</option>
				   <option value="Mathematics">Mathematics</option>
				   <option value="English Language">English Language</option>
				   <option value="Biology">Biology</option>
				   <option value="Physics">Physics</option>
				   <option value="Chemistry">Chemistry</option>
				   <option value="Economics">Economics</option>
				   <option value="Civic Education">Civic Education</option>
				   <option value="Yoruba">Yoruba</option></
				   <option value="Igbo">Igbo</option>
				   <option value="Hausa">Hausa</option>
                 </select></td>	
                   <td width="20%"><select name="grade77" class="userrr">
                   <option value="AR">AR</option>
				   <option value="A1">A1</option>
				   <option value="B2">B2</option>
				   <option value="B3">B3</option>
				   <option value="C4">C4</option>
				   <option value="C5">C5</option>
				   <option value="C6">C6</option>
				   <option value="D7">D7</option>
				   <option value="E8">E8</option>
				   <option value="F9">F9</option>
                 </select></td>				   						 
                </tr>
                <tr>
                   <td width="5%">8</td>
                   <td width="70%"><select name="subject88" class="userr">
				   <option value="null">Select Subject</option>
				   <option value="Mathematics">Mathematics</option>
				   <option value="English Language">English Language</option>
				   <option value="Biology">Biology</option>
				   <option value="Physics">Physics</option>
				   <option value="Chemistry">Chemistry</option>
				   <option value="Economics">Economics</option>
				   <option value="Civic Education">Civic Education</option>
				   <option value="Yoruba">Yoruba</option></
				   <option value="Igbo">Igbo</option>
				   <option value="Hausa">Hausa</option>
                 </select></td>
                   <td width="20%"><select name="grade88" class="userrr">
                   <option value="AR">AR</option>
				   <option value="A1">A1</option>
				   <option value="B2">B2</option>
				   <option value="B3">B3</option>
				   <option value="C4">C4</option>
				   <option value="C5">C5</option>
				   <option value="C6">C6</option>
				   <option value="D7">D7</option>
				   <option value="E8">E8</option>
				   <option value="F9">F9</option>
                 </select></td>				   						 
                </tr>
                <tr>
                   <td width="5%">9</td>
                   <td width="70%"><select name="subject99" class="userr">
				   <option value="null">Select Subject</option>
				   <option value="Mathematics">Mathematics</option>
				   <option value="English Language">English Language</option>
				   <option value="Biology">Biology</option>
				   <option value="Physics">Physics</option>
				   <option value="Chemistry">Chemistry</option>
				   <option value="Economics">Economics</option>
				   <option value="Civic Education">Civic Education</option>
				   <option value="Yoruba">Yoruba</option></
				   <option value="Igbo">Igbo</option>
				   <option value="Hausa">Hausa</option>
                 </select></td>
                   <td width="20%"><select name="grade99" class="userrr">
                   <option value="AR">AR</option>
				   <option value="A1">A1</option>
				   <option value="B2">B2</option>
				   <option value="B3">B3</option>
				   <option value="C4">C4</option>
				   <option value="C5">C5</option>
				   <option value="C6">C6</option>
				   <option value="D7">D7</option>
				   <option value="E8">E8</option>
				   <option value="F9">F9</option>
                 </select></td>				   									 
                </tr>				   						 
               </table>
			</div>
			</div><br>
			 </fieldset><br>
			   <center><input type="submit" value="<<< BACK" name="back" id="back1">
		       <input type="submit" value="PROCEED >>>" name="proceed" id="proceed2"></center>
		 </form>
		 </div><br><br>
		</div>
		</div> <!– End of Content_Area Div –>
		</div> <!– End of Tabs Div –>
	 </div>
   <!-- end .content --></div>

  <?php include_once "footer.php"; ?>
</body>
</html>