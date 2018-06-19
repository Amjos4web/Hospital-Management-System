<?php
session_start();
if (isset($_SESSION['staffid'])){
	header('location: customer_enquiry.php');
}
$msg = "";
if (isset($_POST['login'])){
	include "../pharmacySection/dbconnect2.php";
	$staffid = trim($_POST['staffid']);
	$phone = trim($_POST['phone']);
	//$last_log_date = date('Y-m-d H:i:s');
	if (empty($phone && $staffid) == false){
		$sql = "SELECT * FROM `internet` WHERE `phoneNo`='$phone' && `staff_id`='$staffid'";
		$check = mysqli_query($dbconnect, $sql) or die (mysqli_error($dbconnect));
		$result = mysqli_num_rows($check);
		if ($result > 0){
			$_SESSION['staffid'] = $staffid;
			header('location: customer_enquiry.php');
		} else
		$msg = "<p style='color: #880000; padding-left: 0px'><span class='successbtn'><img src='../pharmacySection/images/error.png' alt='error' width='22px' height='22px'></span>Error: Invalid internet ID or phone number</p>";
	} else
	$msg = "<p style='color: #880000; padding-left: 0px'><span class='successbtn'><img src='images/error.png' alt='error' width='22px' height='22px'></span>Error: Please enter your phone no and internet ID to login</p>";

}
if (isset($_POST['register'])){
	header ('location: internetRegistration.php');
}
?>
<!doctype html>
<html>
<link href="http://10.40.255.5/buth_net/pharmacySection/css/buth_net.css" rel="stylesheet" type="text/css">
<head>
<meta charset="utf-8">
<link rel="shortcut icon" href="/favicon.ico" >
<title>ICT Complain Login Page</title>
</head>
<body>
<?php
include_once "../pharmacySection/header.php";
?>
<div id="container">
  <div id="sidebar1"><br>
    <p class="subHeader">Menu</p>
    <ul id="navigation2">
	  <li class="page_title">Digital Centre</li><br>
      <li><a href="internetLogin.php">Homepage</a></li><br>
	 <li><a href="http://connect.buth.edu/login">Browse the Internet</a></li><br>
	 <li><a href="internetRegistration.php">Register</a></li><br>
    </ul>
    <!-- end .sidebar1 --></div>
  <div class="margin" id="content">
   <div class="login_form">
	   <fieldset>
		 <legend>ICT Complain Login Page</legend>
		  <form action="" method="post">
		  <?php
		   echo $msg;
		  ?>
		    <p style='padding-left: 12px; font-family: impact; font-size: 14px; text-style: italic; color: #880000'>This page is restricted for only registered staff and students who have complain to make at ICT Centre.</p>
			<label class="labelEmail"><span class='successbtn'><img src="../pharmacySection/images/personal.png" alt="email" width="22px" height="22px"></span>Internet ID</label>
		    <p><input type="text" id="email" name="staffid" autofocus></p>
			<label class="labelEmail"><span class='successbtn'><img src="../pharmacySection/images/pass.ico" alt="email" width="22px" height="22px"></span>Phone No</label>
		    <p><input type="password" id="passkey" name="phone"></p>
			<input type="submit" value="Login" name="login" id="login22">
	     </form>
	  </fieldset>
        
		    </div>
            <div id="padding">
            <div class="pageName" > Fequently Asked Questions</div>
            <ul>
              <li>How to use this ICT Complain Form
                <ul>
                  <li>Do you have any issue related to ICT/Digital Centre and you want it to be solved without coming to ICT/Digital Centre kindly use this page </li>
                  <li>To make a complain always Login with your Internet ID and Phone Number (Internet ID is in this format: BUTHADPF0001 or BUI..., student format, IT and Corps members must come)</li>
                  <li>A duplicate comment/complain will be ignored</li>
                  <li>After Login, Choose related issue that you want to solve ( Internet, Repair, Software, Hospital Website, Official Email)</li>
                  <li>If you are New Here, Click Register</li>
                </ul>
              </li>
              <li>How to Register if you are new here
                <ul>
                  <li>Click Register, and properly fill the form</li>
                  <li>Your Staff ID must  start with BUI or BUTH in capital letters without special character like /-$%^&amp;*().</li>
                  <li>Nursing and midwifery students must start with SON or SOM and Medical student with their matric number without slash</li>
                  <li>Your phone Number and Email must be active to receive feedback</li>
                </ul>
              </li>
              <li>New Staff or Student that want to register for internet should come to ICT/Digital Centre with the Appointment Letter or Admission Letter</li>
              <li>How to connect to BUTH Login Page
                <ul>
                  <li>&quot;On&quot; your wireless </li>
                  <li>Connect to available BUTH wireless network except BUTH 1, BUTH 2, BUTH 3 that require passkey</li>
                  <li>Click on your Browser except Opera, and type &quot;connect.buth.edu&quot;</li>
                </ul>
              </li>
              <li>Transfer Limit Reach
                <ul>
                  <li>You have exhausted your data limit for the month, login to complain or call, and you will be activated if you are entitle to it.</li>
                </ul>
              </li>
              <li>Username not Found
                <ul>
                  <li>You have not registered for the internet, kindly come to ICT/Digital Centre with your Appointment Letter</li>
                  <li>You have been blocked, kindly visit ICT/Digital Centre or Call</li>
                  <li>username mis-typed i.e. no space before or within or after, no Slash, and must be typed in Capital Letter, if persist visit ICT/Digital Centre or Call</li>
                </ul>
              </li>
              <li>Wrong Password
                <ul>
                  <li>password forgotten</li>
                  <li>come to the ICT/Digital Centre or Call</li>
                </ul>
              </li>
              <li>No Valid Profile Found
                <ul>
                  <li>Submit your complain or Call</li>
                </ul>
              </li>
              <li>Simultanous Limit Reached
                <ul>
                  <li>You have logged in somewhere before</li>
                  <li>somebody is using your Internet ID</li>
                  <li>make a Complain or Call</li>
                </ul>
              </li>
              <li>No more Session is allowed
                <ul>
                  <li>You have logged in somewhere before</li>
                  <li>somebody is using your Internet ID</li>
                  <li>make a Complain or Call</li>
                </ul></li>
				<li>Radius Server not Responding
                <ul>
                  <li>Keep trying like 5-6 times before complain</li>
                </ul></li></ul></div>
    <!-- end .content --></div>
  <!-- end .container --></div>
 <?php
  include_once "../pharmacySection/footer.php";
  ?>
</body>
</html>
