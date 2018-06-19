<?php
session_start();
if (!isset($_SESSION['staffid'])){
	header('location: internetLogin.php');
} else {
	$staffid = $_SESSION['staffid'];
}
$msg="";
include "../pharmacySection/dbconnect2.php";

// error display configuration
error_reporting(E_ALL & ~E_NOTICE);

$select = "SELECT * FROM internet WHERE staff_id='".$staffid."' LIMIT 1";
$checkticket = mysqli_query($dbconnect, $select) or die (mysqli_error($dbconnect));
$ticketresult = mysqli_num_rows($checkticket);
if ($ticketresult > 0)
{
	while ($row=mysqli_fetch_array($checkticket))
	{
		$fn2 = $row['firstName'];
		$ln2 = $row['lastName'];
		$mn2 = $row['middleName'];
		$depart2 = $row['department'];
		$phone2 = $row['phoneNo'];
		$email2 = $row['emailAdd'];
	}
}
// parse the form data and add the inventory to the system
if (isset($_POST['submit']))
{
	$comment = addslashes($_POST['comment']);
	$issue = $_POST['issue'];
	$date = date('Y-m-d H:i:s');
	$month = date("F");

	if (empty($comment) === false)
	{
		$update = "INSERT INTO internet_enquiry (`staff_id`, `firstName`, `lastName`, `middleName`, `department`, `phoneNo`, `emailAdd`, `comment`, `issue`, `date_of_sub`, `month`) VALUES ('$staffid', '$fn2', '$ln2', '$mn2', '$depart2', '$phone2', '$email2', '$comment', '$issue', '$date', '$month')";
		$check3 = mysqli_query($dbconnect, $update) or die (mysqli_error($dbconnect));
		//$msg = '<p style = "color: #4F8A10; margin-right: auto; margin-right: auto; text-align: center; background-color: #DFF2BF; border-radius:.5em; width: 400px; border: 1px solid #D8D8D8; margin-left: auto; margin-right: auto; padding: 5px; border-radius: 5px; font-family: Arial; font-size: 11px; text-transform: uppercase; text-transform: uppercase">Enquiry sent successfully</p>';
		header ("refresh:3; url=success.php"); // wait for 3 secs before redirect
		
	} else {
		$msg = "<p style='color: #D8000C; background-color: #FFBABA; border-radius:.5em; width: 300px; border: 1px solid #D8D8D8; padding: 5px; border-radius: 5px; margin-left: auto; margin-right: auto; font-family: Arial; font-size: 11px; text-transform: uppercase; text-align: center; text-transform: uppercase'>Please type in your comments</p>";
	}
}

?>
<!doctype html>
<html>
<link href="http://10.40.255.5/buth_net/pharmacySection/css/buth_net.css" rel="stylesheet" type="text/css">
<head>
<meta charset="utf-8">
<link rel="shortcut icon" href="/favicon.ico" >
<title>Internet Conplain Form</title>
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
	  <li><a href="internetRegistration.php">Homepage</a></li><br>
	  <li><a href="http://connect.buth.edu/login">Browse the Internet</a></li><br>
	  <li><a href="interlogout.php">Logout</a></li><br>
    </ul>
      <!-- end .sidebar1 --></div>
     <div class="margin" id="content">
		<div class="product_form2" style="min-height: 100px;">
		 <form action="" method="post" enctype="multipart/form-data">
		 <div class="form"><br>
		 <h3 style='color: brown; font-size: 22px; font-style: normal; text-align: center; font-family: monospace; text-transform: uppercase;'>ICT/Digital Centre Internet Complain form<h3>
		 <?php echo $msg; ?>
		  <table width="450px" style="margin-left: auto; margin-right: auto; min-height: 100px;" cellpadding="5" cellspacing="0" border="1">
			   <tr>
			   <td width="30%"><label>Staff ID</label></td>
			   <td width="70%"><input type="text" id="userarea" disabled="disabled" name="sid" value= "<?php echo $staffid; ?>"></td>
			  </tr>
			  <tr>
			   <td width="30%"><label>Surname</label></td>
			   <td width="70%"><input type="text" id="userarea" name="fn" disabled="disabled" value= "<?php echo $fn2; ?>"></td>
			  </tr>
			   <tr>
			   <td width="30%"><label>First Name</label></td>
			   <td width="70%"><input type="text" id="userarea" name="ln" disabled="disabled" value= "<?php echo $ln2; ?>"></td>
			  </tr>
			  <tr>
			   <td width="30%"><label>Middle Name</label></td>
			   <td width="70%"><input type="text" id="userarea" name="mn" disabled="disabled" value= "<?php echo $mn2; ?>"></td>
			  </tr>
			  <tr>
			   <td width="30%"><label>Department/Unit</label></td>
			   <td width="70%"><input type="text" id="userarea"  name="depart" disabled="disabled" value= "<?php echo $depart2; ?>"></td>
			  </tr>
			  <tr>
			   <td width="30%"><label>Phone No</label></td>
			   <td width="70%"><input type="text" id="userarea" name="phone" disabled="disabled" value= "<?php echo $phone2; ?>"></td>
			  </tr>
			   <tr>
			   <td width="30%"><label>Email Address</label></td>
			   <td width="70%"><input type="text" id="userarea" name="email" disabled="disabled" value= "<?php echo $email2; ?>"></td>
			  </tr>
			  <tr>
			   <td width="30%"><label>Issue(s) related with</label></td>
			   <td width="70%"><select id="userarea" name="issue">
			   <option value="internet">Internet</option>
			   <option value="pc check up">PC Check up</option>
			   <option value="pc hardware">PC Hardware</option>
			   <option value="printer">Printer</option>
			   <option value="projector">Projector</option>
			   <option value="buth.edu.ng">Hospital Website</option>
                  <option value="Email">Official Email</option>
			   <option value="pc software">PC Software</option>
			   <option value="others">Others</option>
			   </select></td>
			  </tr>
			  <tr>
			   <td width="30%"><label>Your Complain Details</label></td>
			   <td width="70%"><textarea type="textarea" id="userarea" rows="15" cols="10" name="comment"><?php //echo $comment; ?></textarea></td>
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