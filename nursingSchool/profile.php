<?php 
session_start();
ob_start();
// error display configuration
//error_reporting(E_ALL & ~E_NOTICE);

if(!isset($_SESSION['emaill'])){
	header('location: firstyearResult.php');
}
//This block grabs the whole list for viewing
$msg="";
$email= $_SESSION['emaill'];
include "dbconnect.php";
$sql="SELECT * FROM `sono_firstyearresult1` WHERE `eMail`='$email' LIMIT 1";
$check = mysqli_query($dbconnect, $sql);
$resultCount=mysqli_num_rows($check); //count the out amount 
if($resultCount>0){
	while($row=mysqli_fetch_array($check)){
	$name=$row["fullName"];
	}
}else{
$msg="<p style='color: red; text-align: center'>You have no Information yet in the Database</p>";
}

// check the url is set and exit in the database

$result_data = "";
$sql6 = "SELECT * FROM sono_firstyearresult1 WHERE `eMail`='".$email."' LIMIT 1";
$check6 = mysqli_query($dbconnect, $sql6) or die (mysqli_error($dbconnect));
$resultCount6 = mysqli_num_rows($check6);
if ($resultCount6>0){
	while($row=mysqli_fetch_array($check6)){
		$student_id=$row["student_id"];
		$fullname=$row["fullName"];
		$gns110=$row["GNS110"];
		$gns110_uc=$row["GNS110_UC"];
		$gns110_g=$row["GNS110_G"];
		$gns111=$row["GNS111"];
		$gns111_uc=$row["GNS111_UC"];
		$gns111_g=$row["GNS111_G"];
		$gns112=$row["GNS112"];
		$gns112_uc=$row["GNS112_UC"];
		$gns112_g=$row["GNS112_G"];
		$gst110=$row["GST110"];
		$gst110_uc=$row["GST110_UC"];
		$gst110_g=$row["GST110_G"];
		$gst111=$row["GST111"];
		$gst111_uc=$row["GST111_UC"];
		$gst111_g=$row["GST111_G"];
		$gst112=$row["GST112"];
		$gst112_uc=$row["GST112_UC"];
		$gst112_g=$row["GST112_G"];
		$gst113=$row["GST113"];
		$gst113_uc=$row["GST113_UC"];
		$gst113_g=$row["GST113_G"];
		$gst114=$row["GST114"];
		$gst114_uc=$row["GST114_UC"];
		$gst114_g=$row["GST114_G"];
		$gst118=$row["GST118"];
		$gst118_uc=$row["GST118_UC"];
		$gst118_g=$row["GST118_G"];
		
		// sum for unit credit 
		$uc_total = $gns110_uc + $gns111_uc + $gns112_uc + $gst110_uc + $gst111_uc + $gst112_uc + $gst113_uc + $gst114_uc + $gst118_uc;
		
		// get grade 
		if ($gns110_g == "A"){
			$gns110_g_v = 4;
		} else if ($gns110_g == "B"){
			$gns110_g_v = 3;
		} else if ($gns110_g == "C"){
			$gns110_g_v = 2;
		} else if ($gns110_g == "D"){
			$gns110_g_v = 1;
		} else if ($gns110_g == "E"){
			$gns110_g_v = 0;
		}
		
		if ($gns111_g == "A"){
			$gns111_g_v = 4;
		} else if ($gns111_g == "B"){
			$gns111_g_v = 3;
		} else if ($gns111_g == "C"){
			$gns111_g_v = 2;
		} else if ($gns111_g == "D"){
			$gns111_g_v = 1;
		} else if ($gns111_g == "E"){
			$gns111_g_v = 0;
		}
		
		if ($gns112_g == "A"){
			$gns112_g_v = 4;
		} else if ($gns112_g == "B"){
			$gns112_g_v = 3;
		} else if ($gns112_g == "C"){
			$gns112_g_v = 2;
		} else if ($gns112_g == "D"){
			$gns112_g_v = 1;
		} else if ($gns112_g == "E"){
			$gns112_g_v = 0;
		}
		
		if ($gst110_g == "A"){
			$gst110_g_v = 4;
		} else if ($gst110_g == "B"){
			$gst110_g_v = 3;
		} else if ($gst110_g == "C"){
			$gst110_g_v = 2;
		} else if ($gst110_g == "D"){
			$gst110_g_v = 1;
		} else if ($gst110_g == "E"){
			$gst110_g_v = 0;
		}
		
		if ($gst111_g == "A"){
			$gst111_g_v = 4;
		} else if ($gst111_g == "B"){
			$gst111_g_v = 3;
		} else if ($gst111_g == "C"){
			$gst111_g_v = 2;
		} else if ($gst111_g == "D"){
			$gst111_g_v = 1;
		} else if ($gst111_g == "E"){
			$gst111_g_v = 0;
		}
		
		if ($gst112_g == "A"){
			$gst112_g_v = 4;
		} else if ($gst112_g == "B"){
			$gst112_g_v = 3;
		} else if ($gst112_g == "C"){
			$gst112_g_v = 2;
		} else if ($gst112_g == "D"){
			$gst112_g_v = 1;
		} else if ($gst112_g == "E"){
			$gst112_g_v = 0;
		}
		
		if ($gst113_g == "A"){
			$gst113_g_v = 4;
		} else if ($gst113_g == "B"){
			$gst113_g_v = 3;
		} else if ($gst113_g == "C"){
			$gst113_g_v = 2;
		} else if ($gst113_g == "D"){
			$gst113_g_v = 1;
		} else if ($gst113_g == "E"){
			$gst113_g_v = 0;
		}
		
		if ($gst114_g == "A"){
			$gst114_g_v = 4;
		} else if ($gst114_g == "B"){
			$gst114_g_v = 3;
		} else if ($gst114_g == "C"){
			$gst114_g_v = 2;
		} else if ($gst114_g == "D"){
			$gst114_g_v = 1;
		} else if ($gst114_g == "E"){
			$gst114_g_v = 0;
		}
		
		if ($gst118_g == "A"){
			$gst118_g_v = 4;
		} else if ($gst118_g == "B"){
			$gst118_g_v = 3;
		} else if ($gst118_g == "C"){
			$gst118_g_v = 2;
		} else if ($gst118_g == "D"){
			$gst118_g_v = 1;
		} else if ($gst118_g == "E"){
			$gst118_g_v = 0;
		}
		
		// get grade point
		$gns110_gp = $gns110_uc * $gns110_g_v;
		$gns111_gp = $gns111_uc * $gns111_g_v;
		$gns112_gp = $gns112_uc * $gns112_g_v;
		$gst110_gp = $gst110_uc * $gst110_g_v;
		$gst111_gp = $gst111_uc * $gst111_g_v;
		$gst112_gp = $gst112_uc * $gst112_g_v;
		$gst113_gp = $gst113_uc * $gst113_g_v;
		$gst114_gp = $gst114_uc * $gst114_g_v;
		$gst118_gp = $gst118_uc * $gst118_g_v;
		
		// sum for grade point
		$gp_total = $gns110_gp + $gns111_gp + $gns112_gp + $gst110_gp + $gst111_gp + $gst112_gp + $gst113_gp + $gst114_gp + $gst118_gp;
		
		$cumulative = $gp_total / $uc_total;
		
		$result_data .= "<tr>";
		$result_data .= "<td class='data_td'>GNS110</td>";
		$result_data .= "<td class='data_td'>" . $gns110 . "</td>";
		$result_data .= "<td class='data_td'>" . $gns110_uc . "</td>";
		$result_data .= "<td class='data_td'>" . $gns110_g . "</td>";
		$result_data .= "<td class='data_td'>" . $gns110_gp . "</td>";
		$result_data .= "</tr>"; 
		$result_data .= "<tr>";
		$result_data .= "<td class='data_td'>GNS111</td>";
		$result_data .= "<td class='data_td'>" . $gns111 . "</td>";
		$result_data .= "<td class='data_td'>" . $gns111_uc . "</td>";
		$result_data .= "<td class='data_td'>" . $gns111_g . "</td>";
		$result_data .= "<td class='data_td'>" . $gns111_gp . "</td>";
		$result_data .= "</tr>";
		$result_data .= "<tr>";
		$result_data .= "<td class='data_td'>GNS112</td>";
		$result_data .= "<td class='data_td'>" . $gns112 . "</td>";
		$result_data .= "<td class='data_td'>" . $gns112_uc . "</td>";
		$result_data .= "<td class='data_td'>" . $gns112_g . "</td>";
		$result_data .= "<td class='data_td'>" . $gns112_gp . "</td>";
		$result_data .= "</tr>"; 
		$result_data .= "<tr>";
		$result_data .= "<td class='data_td'>GST110</td>";
		$result_data .= "<td class='data_td'>" . $gst110 . "</td>";
		$result_data .= "<td class='data_td'>" . $gst110_uc . "</td>";
		$result_data .= "<td class='data_td'>" . $gst110_g . "</td>";
		$result_data .= "<td class='data_td'>" . $gst110_gp . "</td>";
		$result_data .= "</tr>"; 
		$result_data .= "<tr>";
		$result_data .= "<td class='data_td'>GST111</td>";
		$result_data .= "<td class='data_td'>" . $gst111 . "</td>";
		$result_data .= "<td class='data_td'>" . $gst111_uc . "</td>";
		$result_data .= "<td class='data_td'>" . $gst111_g . "</td>";
		$result_data .= "<td class='data_td'>" . $gst111_gp . "</td>";
		$result_data .= "</tr>";
		$result_data .= "<tr>";
		$result_data .= "<td class='data_td'>GST112</td>";
		$result_data .= "<td class='data_td'>" . $gst112 . "</td>";
		$result_data .= "<td class='data_td'>" . $gst112_uc . "</td>";
		$result_data .= "<td class='data_td'>" . $gst112_g . "</td>";
		$result_data .= "<td class='data_td'>" . $gst112_gp . "</td>";
		$result_data .= "</tr>"; 
		$result_data .= "<tr>";
		$result_data .= "<td class='data_td'>GST113</td>";
		$result_data .= "<td class='data_td'>" . $gst113 . "</td>";
		$result_data .= "<td class='data_td'>" . $gst113_uc . "</td>";
		$result_data .= "<td class='data_td'>" . $gst113_g . "</td>";
		$result_data .= "<td class='data_td'>" . $gst113_gp . "</td>";
		$result_data .= "</tr>"; 
		$result_data .= "<tr>";
		$result_data .= "<td class='data_td'>GST114</td>";
		$result_data .= "<td class='data_td'>" . $gst114 . "</td>";
		$result_data .= "<td class='data_td'>" . $gst114_uc . "</td>";
		$result_data .= "<td class='data_td'>" . $gst114_g . "</td>";
		$result_data .= "<td class='data_td'>" . $gst114_gp . "</td>";
		$result_data .= "</tr>"; 
		$result_data .= "<tr>";
		$result_data .= "<td class='data_td'>GST118</td>";
		$result_data .= "<td class='data_td'>" . $gst118 . "</td>";
		$result_data .= "<td class='data_td'>" . $gst118_uc . "</td>";
		$result_data .= "<td class='data_td'>" . $gst118_g . "</td>";
		$result_data .= "<td class='data_td'>" . $gst118_gp . "</td>";
		$result_data .= "</tr>"; 
		$result_data .= "<tr>";
		$result_data .= "<td class='data_td' colspan='2' style='text-align: center; font-weight: bold'>Total</td>";
		$result_data .= "<td class='data_td'>" . $uc_total . "</td>";
		$result_data .= "<td class='data_td'></td>";
		$result_data .= "<td class='data_td'>" . $gp_total . "</td>";
		$result_data .= "</tr>";
		

	}
	
	
} else {
	$msg="<p style='color: #D8000C; background-color: #FFBABA; border-radius:.5em; width: 300px; border: 1px solid #D8D8D8; padding: 5px; border-radius: 5px; margin-left: auto; margin-right: auto; font-family: Arial; font-size: 11px; text-transform: uppercase; text-align: center; text-transform: uppercase'>That staff does not exit. Please try again with another ID</p>";
}

?>
<!doctype html>
<html>
<link href="http://localhost/buth_net/nursingSchool/css/buth_net.css" rel="stylesheet" type="text/css">
<head>
<meta charset="utf-8">
<link rel="shortcut icon" href="/favicon.ico" >
<title><?php echo "BUTH/SON/" . $name; ?></title>
<script type="text/javascript" src="js/script.js"></script>
<script type="text/javascript" src="js/jquery-1.12.3.min.js"></script>
</head>
<body>
<?php
include_once "header.php";
?>
<div id="container" style="height: 700px;">
  <div id="sidebar1"><br>
    <p class="subHeader">Menu</p>
    <ul id="navigation2">
	<li class="page_title">School Of Nursing</li><br>
		<li><a href="http://localhost/buth_net/index.php">Main Page</a></li><br>
		<li><a href="profile.php">Homepage</a></li><br>
		<li><a href="logout.php">Logout</a></li><br>
    </ul>
    <!-- end .sidebar1 --></div>
  <div class="margin" id="content">
   <?php echo $msg; ?>
	<div class="product_details">
	<center><h3 class="heading_text" style="width: 400px">1st Year 1st Semester Results</h3></center>
	<label style="margin-left: 20px; font-family: cursive;">Student Name: <?php echo $fullname; ?></label><label style="float: right; margin-right: 20px;font-family: cursive;">Exam No: <?php echo $student_id; ?></label>
	<hr> <br>
	  <div class="dynamic_table">
	    <?php //echo $nodata; ?>
	    <table cellpadding="2" cellspacing="2">
		   <tr>
			  <td style="text-align: center;">Course Code</td>
			  <td style="width: 300px; text-align: center;">Course Title</td>
			  <td style="text-align: center;">Unit Credit</td>
			  <td style="text-align: center;">Grade</td>
			  <td style="text-align: center;">Grade Point</td>
			</tr>
			<?php echo $result_data; ?>
			<!--tr>
			 <td>&nbsp;</td>
			 <td>&nbsp;</td>
			 <td>&nbsp;</td>
			 <td>&nbsp;</td>
			 <td>&nbsp;</td>
			</tr-->
		</table>
		</div><br>
		<center><h3 class="heading_text" style="width: 400px">Cumulative Average = <?php echo $cumulative; ?></h3></center><br>
		<label style="margin-left: 20px; font-family: cursive;">Grading System</label>
		<hr> <br>
		<div class="dynamic_table2">
	    <?php //echo $nodata; ?>
	    <table cellpadding="2" cellspacing="2">
		   <tr>
			  <td style="text-align: center;">Grade</td>
			  <td style="text-align: center;">Score %</td>
			  <td style="text-align: center;">CPA</td>
			  <td style="text-align: center; width: 150px;">Class of Diploma</td>
			</tr>
			<tr>
				<td class='data_td'>A</td>
				<td class='data_td'>80-100</td>
				<td class='data_td'>4</td>
				<td class='data_td'>Distinction</td>
			</tr>
			<tr>
				<td class='data_td'>B</td>
				<td class='data_td'>70-79</td>
				<td class='data_td'>3</td>
				<td class='data_td'>Upper credit</td>
			</tr>
			<tr>
				<td class='data_td'>C</td>
				<td class='data_td'>60-69</td>
				<td class='data_td'>2</td>
				<td class='data_td'>Lower credit</td>
			</tr>
			<tr>
				<td class='data_td'>D</td>
				<td class='data_td'>50-59</td>
				<td class='data_td'>1</td>
				<td class='data_td'>Pass</td>
			</tr>
			<tr>
				<td class='data_td'>E</td>
				<td class='data_td'>Below 50</td>
				<td class='data_td'>0</td>
				<td class='data_td'>Fail</td>
			</tr>
		</table>
		</div><br>
		<form action="print_result.php?student_id=$student_id" method="GET" id="jsform" target="_blank">
		<input type="hidden" name="student_id" value="<?php echo $student_id; ?>">
		<center><input type="button" onclick="document.getElementById('jsform').submit();" class="submit4" value="Print"></center>
	  </form>
    </div>
	<!-- end .margin --></div>
  <!-- end .container --></div>
 <?php
  include_once "footer.php";
  ?>
</body>
</html>
