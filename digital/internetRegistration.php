<?php 
session_start();
$msg="";
include "../pharmacySection/dbconnect2.php";

// error display configuration
error_reporting(E_ALL & ~E_NOTICE);

// parse the form data and add the inventory to the system
if (isset($_POST['submit']))
{
	$staffid = $_POST['sid'];
	$fn = htmlspecialchars($_POST['fn']);
	$ln = htmlspecialchars($_POST['ln']);
	$mn = htmlspecialchars($_POST['mn']);
	$depart = htmlspecialchars($_POST['depart']);
	$phone = htmlspecialchars($_POST['phone']);
	$email = htmlspecialchars($_POST['email']);
	$date = date('Y-m-d H:i:s');

	if (empty($staffid && $fn && $ln && $depart && $phone) === false)
	{
		if (preg_match('/^[a-zA-Z0-9]+$/', $staffid)){
			$select = "SELECT * FROM internet WHERE staff_id='".$staffid."' LIMIT 1";
			$checkticket = mysqli_query($dbconnect, $select) or die (mysqli_error($dbconnect));
			$ticketresult = mysqli_num_rows($checkticket);
			if ($ticketresult == 0)
			{
				$update = "INSERT INTO internet (`staff_id`, `firstName`, `lastName`, `middleName`, `department`, `phoneNo`, `emailAdd`, `date_of_sub`) VALUES ('$staffid', '$fn', '$ln', '$mn', '$depart', '$phone', '$email', '$date')";
				$check3 = mysqli_query($dbconnect, $update) or die (mysqli_error($dbconnect));
				//$msg = '<p style = "color: #4F8A10; margin-right: auto; margin-right: auto; text-align: center; background-color: #DFF2BF; border-radius:.5em; width: 400px; border: 1px solid #D8D8D8; margin-left: auto; margin-right: auto; padding: 5px; border-radius: 5px; font-family: Arial; font-size: 11px; text-transform: uppercase; text-transform: uppercase">You have successfully registered for our Internet service</p>';
				$_SESSION['staffid'] = $staffid;
				header ("location: customer_enquiry.php"); // wait for 3 secs before redirect
			} else {
				$msg = "<p style='color: #D8000C; background-color: #FFBABA; border-radius:.5em; width: 300px; border: 1px solid #D8D8D8; padding: 5px; border-radius: 5px; margin-left: auto; margin-right: auto; font-family: Arial; font-size: 11px; text-transform: uppercase; text-align: center;'>User Already Exists</p>";
			}
		} else {
			$msg = "<p style='color: #D8000C; background-color: #FFBABA; border-radius:.5em; width: 300px; border: 1px solid #D8D8D8; padding: 5px; border-radius: 5px; margin-left: auto; margin-right: auto; font-family: Arial; font-size: 11px; text-transform: uppercase; text-align: center; text-transform: uppercase'>Only alpha-numeric is allowed for staff id and matric no</p>";
		}
	} else {
		$msg = "<p style='color: #D8000C; background-color: #FFBABA; border-radius:.5em; width: 300px; border: 1px solid #D8D8D8; padding: 5px; border-radius: 5px; margin-left: auto; margin-right: auto; font-family: Arial; font-size: 11px; text-transform: uppercase; text-align: center; text-transform: uppercase'>Please fill the required (*) fields</p>";
	}

}

?>
<!doctype html>
<html>
<link href="http://10.40.255.5/buth_net/pharmacySection/css/buth_net.css" rel="stylesheet" type="text/css">
<head>
<meta charset="utf-8">
<link rel="shortcut icon" href="/favicon.ico" >
<title>Complain Registration Form</title>
<script src="../pharmacySection/js/jquery-1.12.3.min.js" type="text/javascript"></script>
<script src="js/tinymce/tinymce.min.js" type="text/javascript"></script>
<script>
tinymce.init({ selector:'textarea',
height: 200,
menubar: true,
plugins: [
    'advlist autolink lists link image charmap print preview anchor',
    'searchreplace visualblocks code fullscreen',
    'insertdatetime media table contextmenu paste code'
  ],
toolbar: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent',
content_css: 'http://10.40.255.5/buth_net/pharmacySection/css/content_css.css' });
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
	  <li class="page_title">Digital Center</li><br>
	  <li><a href="internetLogin.php">Homepage</a></li><br>
	  <li><a href="http://connect.buth.edu/login">Browse the Internet</a></li><br>
    </ul>
      <!-- end .sidebar1 --></div>
     <div class="margin" id="content">
		<div class="product_form2" style="min-height: 100px;">
		 <form action="" method="post" enctype="multipart/form-data">
		 <div class="form"><br>
		 <h3 style='color: brown; font-size: 22px; font-style: normal; text-align: center; font-family: monospace; text-transform: uppercase;'>ICT/Digital Centre Complain form<h3>
		 <?php echo $msg; ?>
		  <table width="450px" style="margin-left: auto; margin-right: auto; min-height: 100px;" cellpadding="5" cellspacing="0" border="1">
			   <tr>
			   <td width="30%"><label>INTERNET ID</label><label style="color: #880000; float: right">*</label></td>
			   <td width="70%"><input type="text" id="userarea" name="sid" value= "<?=@$sid?>"></td>
			  </tr>
			  <tr>
			   <td width="30%"><label>Surname</label><label style="color: #880000; float: right">*</label></td>
			   <td width="70%"><input type="text" id="userarea" name="fn" value= "<?=@$fn?>"></td>
			  </tr>
			   <tr>
			   <td width="30%"><label>First Name</label><label style="color: #880000; float: right">*</label></td>
			   <td width="70%"><input type="text" id="userarea" name="ln" value= "<?=@$on?>"></td>
			  </tr>
			  <tr>
			   <td width="30%"><label>Middle Name</label></td>
			   <td width="70%"><input type="text" id="userarea" name="mn" value= "<?=@$mn?>"></td>
			  </tr>
			  <tr>
			   <td width="30%"><label>Department/Unit</label><label style="color: #880000; float: right">*</label></td>
			   <td width="70%"><input type="text" id="userarea"  name="depart" value= "<?=@$depart?>"></td>
			  </tr>
			  <tr>
			   <td width="30%"><label>Phone No</label><label style="color: #880000; float: right">*</label></td>
			   <td width="70%"><input type="text" id="userarea" name="phone" value= "<?=@$phone?>"></td>
			  </tr>
			   <tr>
			   <td width="30%"><label>Email Address</label></td>
			   <td width="70%"><input type="email" id="userarea" name="email" value= "<?=@$email?>"></td>
			  </tr>
			</table><br>	
		   <center><input type="submit" value="Submit" name="submit" class="submit4"></center>
		   </form>
		  </div>
	</div>
			   <!-- end .content --></div>
			  <!-- end .container --></div>
     <?php
      include_once "../pharmacySection/footer.php";
     ?>
</body>
</html>