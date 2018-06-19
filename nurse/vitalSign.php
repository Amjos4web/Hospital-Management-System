<?php 
session_start();
ob_start();
// error display configuration
error_reporting(E_ALL);
ini_set('display_errors','1');

if(!isset($_SESSION['emaill'])){
	header('location: nurse_login.php');
}
//This block grabs the whole list for viewing
$msg="";
$email= $_SESSION['emaill'];
include "dbconnect2.php";
$sql="SELECT * FROM `nurse_login` WHERE `emailAdd`='$email' LIMIT 1";
$check = mysqli_query($dbconnect, $sql);
$resultCount=mysqli_num_rows($check); //count the out amount 
if($resultCount>0){
	while($row=mysqli_fetch_array($check)){
	$id=$row["id"];
	$password=$row["passWord"];
	$name=$row["first_name"];
	}
}else{
$msg="<p style='color: red; text-align: center'>You have no Information yet in the Database</p>";
}

$hospital_data = "";
$nodata = "";
$comment = "";
// insert data into the system
if (isset($_GET['hospital_no'])){
	$hos_no = $_GET['hospital_no'];
	
	$selectview = "SELECT * FROM nurse_panel WHERE patient_hosp_no='".$hos_no."' LIMIT 1";
	$checkview = mysqli_query($dbconnect, $selectview) or die (mysqli_error($dbconnect));
	$checkresult = mysqli_num_rows($checkview);
	if ($checkresult > 0){
		while($row=mysqli_fetch_array($checkview)){
			$pname=$row["patient_name"];
		}
	} else
		$nodata = "<p style='color: #D8000C; background-color: #FFBABA; border-radius:.5em; width: 300px; border: 1px solid #D8D8D8; padding: 5px; border-radius: 5px; margin-left: auto; margin-right: auto; font-family: Arial; font-size: 11px; text-transform: uppercase; text-align: center; text-transform: uppercase'>No Comment</p>";

	if (isset($_POST['move'])){
		$date = htmlspecialchars(trim($_POST['date']));
		$comment = $_POST['comment'];
		$server_date = date('Y-m-d H:i:s');
		$clinic = $_POST['clinic'];
		$sub_clinic1 = $_POST['sub_clinic1'];
		$sub_clinic2 = $_POST['sub_clinic2'];
		
		if (empty($date && $comment && $clinic) == false) 
		{
			if ((preg_match("/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/", $date)))
			{
			  $sql = "INSERT INTO doctor_panel (`logged_in_staff`, `server_date`, `date`, `comments`, `hosp_no`, `clinic`, `sub_clinic1`, `sub_clinic2`, `patient_name`) VALUES ('$name', '$server_date', '$date', '$comment', '$hos_no', '$clinic', '$sub_clinic1', '$sub_clinic2', '$pname')";
			  $check = mysqli_query($dbconnect, $sql) or die(mysqli_error($dbconnect));
			  $msg= "<p style = 'color: #4F8A10; margin-right: auto; margin-right: auto; text-align: center; background-color: #DFF2BF; border-radius:.5em; width: 400px; border: 1px solid #D8D8D8; margin-left: auto; margin-right: auto; padding: 5px; border-radius: 5px; font-family: Arial; font-size: 11px; text-transform: uppercase; text-transform: uppercase'>Operation Successful</p>";
			  header ("refresh: 3; url=nurse_dashboard.php");
			} else
				$msg = "<p style='color: #D8000C; background-color: #FFBABA; border-radius:.5em; width: 300px; border: 1px solid #D8D8D8; padding: 5px; border-radius: 5px; margin-left: auto; margin-right: auto; font-family: Arial; font-size: 11px; text-transform: uppercase; text-align: center; text-transform: uppercase'>Date format should be YYYY-MM-DD</p>";
		} else
			$msg = "<p style='color: #D8000C; background-color: #FFBABA; border-radius:.5em; width: 300px; border: 1px solid #D8D8D8; padding: 5px; border-radius: 5px; margin-left: auto; margin-right: auto; font-family: Arial; font-size: 11px; text-transform: uppercase; text-align: center; text-transform: uppercase'>Please fill all fields</p>";
	}
} else
$msg = "<p style='color: #D8000C; background-color: #FFBABA; border-radius:.5em; width: 300px; border: 1px solid #D8D8D8; padding: 5px; border-radius: 5px; font-family: Arial; margin-left: auto; margin-right: auto; font-size: 11px; text-transform: uppercase; text-align: center; text-transform: uppercase'>Error has occured... Please try again</p>";

// for back button
if (isset($_POST['notmove'])){
	header ('location: nurse_dashboard.php');
}
?>
<!doctype html>
<html>
<link href="http://localhost/buth_net/pharmacySection/css/buth_net.css" rel="stylesheet" type="text/css">
<head>
<meta charset="utf-8">
<link rel="shortcut icon" href="/favicon.ico" >
<title>Vital Sign</title>
<script src="../pharmacySection/js/jquery-1.12.3.min.js" type="text/javascript"></script>
<script src="js/tinymce/tinymce.min.js" type="text/javascript"></script>
<script>
$(document).ready(function(){
    $('.clinic').on('change', function() {
      if ( this.value == 'Gynaecology clinic')
      //.....................^.......
      {
        $(".sub_clinic1").slideDown();
		$("#td").slideDown();
      }
      else
      {
        $(".sub_clinic1").hide();
		$("#td").hide();
      }
	  
	  if ( this.value == 'Medicine clinic')
      //.....................^.......
      {
        $(".sub_clinic2").slideDown();
		$("#td1").slideDown();
      }
      else
      {
        $(".sub_clinic2").hide();
		$("#td1").hide();
      }
	  
    });
});
tinymce.init({ selector:'textarea',
height: 300,
menubar: false,
plugins: [
    'advlist autolink lists link image charmap print preview anchor',
    'searchreplace visualblocks code fullscreen',
    'insertdatetime media table contextmenu paste code'
  ],
toolbar: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent',
content_css: 'http://localhost/buth_net/pharmacySection/css/content_css.css' });
</script>
</head>
<body>
<?php
include_once "../pharmacySection/header.php";
?>
<div id="container">
  <div id="sidebar1"><br>
    <p class="subHeader">Menu</p>
    <ul id="navigation2">
	 <li class="page_title">Nurse Unit</li><br>
	  <li><a href="http://localhost/buth_net/index.php">Main Page</a></li><br>
	  <li><a href="nurse_dashboard.php">Home Page</a></li><br>
	  <li><a href="#">ECG Form</a></li><br>
	  <li><a href="logout.php">Logout</a></li><br>
    </ul>
      <!-- end .sidebar1 --></div>
     <div class="margin" id="content">
	  <div class="bio_data">
		<div class="rec_new_form">
			 <form action="" method="post" enctype="multipart/form-data">
			 <div class="form_data">
			 <center><h3 class="heading_text">Vital Sign Information For <?php echo $hos_no; ?></h3></center>
			 <?php echo $msg; ?>
			 <table width="450px" style="margin-left: auto; margin-right: auto;" cellpadding="5" cellspacing="0" border="1">
			 <tr>
			   <td width="30%"><label>Date</label></td>
			   <td width="70%"><input type="text" id="userarea" name="date" placeholder="YYYY-MM-DD" value= "<?=@$date?>"></td>
			  </tr>
			  <tr>
			   <td width="30%"><label>Clinic</label></td>
			   <td width="70%"><select name="clinic" id="userarea" class="clinic">
			   <option value="Null">Select Clinic</option>
			   <option value="Gynaecology clinic">Gynaecology Clinic</option>
			   <option value="Medicine clinic">Medicine Clinic</option>
			   <option value="Ophthalmology clinic">Ophthalmology Clinic</option>
			   <option value="Urology clinic">Urology Clinic</option>
			   <option value="General Surgery Clinic">General Surgery Clinic</option>
			   <option value="STI">STI Clinic</option>
			   <option value="Orthopaedic clinic">Orthopaedic Clinic</option>
			   <option value="Paediatric clinic">Paediatric Clinic</option>
			   <option value="Burns and plastic">Burns and Plastic Clinic</option>
			   <option value="Immunology clinic">Immunology Clinic</option>
			   <option value="Anesthesiology clinic">Anesthesiology Clinic</option>
			   <option value="Obstetric clinic">Obstetric Clinic</option>
			   <option value="Otolaryngology clinic">Otolaryngology Clinic</option>
			   <option value="Pathology clinic">Pathology Clinic</option>
			   <option value="Rheumatologist clinic">Rheumatologist Clinic</option>
			   <option value="Diagnosis Radiology clinic">Diagonosis Radiology Clinic</option>
			   </select></td>
			  </tr>
			  <tr>
			   <td width="30%" style="display: none" class="sub_clinic1"><label>Gynaecology</label></td>
		       <td width="70%" id="td" style="display: none"><select name="sub_clinic1" id="userarea" class="sub_clinic1">
			   <option value="Null">Select Clinic</option>
			   <option value="infertility">Infertility Clinic</option>
			   <option value="pregnancy clinic">Pregnancy Clinic</option>
			   <option value="Post-partum clinic">Post-partum Clinic</option>
			   <option value="general gynaecology issue">General Gynaecology Issue Clinic</option>
			   </select></td>
		     </tr>
			  <tr>
			   <td width="30%" style="display: none" class="sub_clinic2"><label>Medicine</label></td>
		       <td width="70%" id="td1" style="display: none"><select name="sub_clinic2" id="userarea" class="sub_clinic2">
			   <option value="Null">Select Clinic</option>
			   <option value="Nephrology clinic">Nephrology Clinic</option>
			   <option value="Psystricary clinic">Psystricary clinic</option>
			   <option value="Neurologoy clinic">Neurologoy Clinic</option>
			   <option value="General medicine">General Medicine</option>
			   </select></td>
		     </tr>
			  <tr>
			   <td width="30%"><label>Comments</label></td>
			   <td width="70%"><textarea type="textarea" id="userarea" rows="15" cols="40" name="comment"><?php echo $comment; ?></textarea></td>
			  </tr>
			 </table><br>		  
			</div>
		</div>
	 </div><br>
	   <center><input type="submit" value="Back" name="notmove" id="rec_submit">&nbsp; &nbsp;<input type="submit" value="Move To Clinic" name="move" id="rec_submit"></center><br>
	   </form>
	  <!-- <div class="dynamic_table">
	    <?php //echo $nodata; ?>
	   <table cellpadding="2" cellspacing="2">
		   <tr>
			  <td style="width: 150px;">Date</td>
			  <td style="width: 550px; text-align: center;">Comments</td>
			  <td style="width: 80px; text-align: center;">Added By</td>
			</tr>
			<?php echo $hospital_data; ?>
			<!--tr>
			 <td>&nbsp;</td>
			 <td>&nbsp;</td>
			 <td>&nbsp;</td>
			 <td>&nbsp;</td>
			 <td>&nbsp;</td>
			</tr-->
		</table>
		</div>
   <!-- end .content --></div>
  <!-- end .container --></div>
     <?php
      include_once "../pharmacySection/footer.php";
     ?>
</body>
</html>