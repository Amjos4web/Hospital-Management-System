<?php
session_start();
ob_start();
// error display configuration
error_reporting(E_ALL & ~E_NOTICE);

if(!isset($_SESSION['emaill'])){
	header('location: adminlogin.php');
}
//This block grabs the whole list for viewing
$msg="";
$email= $_SESSION['emaill'];
include "dbconnect.php";
$sql="SELECT * FROM `nursing_admin` WHERE `admin_email`='$email' LIMIT 1";
$check = mysqli_query($dbconnect, $sql);
$resultCount=mysqli_num_rows($check); //count the out amount 
if($resultCount>0){
	while($row=mysqli_fetch_array($check)){
	$name=$row["name"];
	}
}else{
$msg="<p style='color: red; text-align: center'>You have no Information yet in the Database</p>";
}

?>
<!doctype html>
<html>
<link href="css/buth_net.css" rel="stylesheet" type="text/css">
<head>
<meta charset="utf-8">
<link rel="shortcut icon" href="/favicon.ico">
<title>View Students</title>
<script>
function showStudent(str) {
    if (str == "") {
        document.getElementById("txtHint").innerHTML = "";
        return;
    } else { 
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("txtHint").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","getstudents.php?q="+str,true);
        xmlhttp.send();
    } 
}
</script>
</head>
<body>
<?php
include_once "header.php";
?>
<div id="container">
  <div id="sidebar1"><br>
    <p class="subHeader">Menu</p>
    <ul id="navigation2">
		<li class="page_title">Admin Unit</li><br>
		<li><a href="http://sono.buth.edu.ng/index.php">Main Page</a></li><br>
		<li><a href="addnotes.php">Add Notes</a></li><br>
		<li><a href="logout.php">Logout</a></li><br>
    </ul>
      <!-- end .sidebar1 --></div>
     <div class="margin" id="content">
	 <h1 style='text-align: center; font-family: tahoma; font-size: 16px; text-transform: uppercase; font-weight: bold; background-color: #000000; margin-top: -5px; color: #CECECE'>Welcome <?php echo $name; ?> What would you like to do today?</h1><br>
	  <div class="bio_data">
		<div class="search_angle">
		  <?php echo $msg; ?>
	     <center><h3 class="heading_text" style="width: 480px">Search for student here</h3></center><br>
		<center><img src="http://sono.buth.edu.ng/images/2.jpg" alt="search_angle" width="500px" height="200px"></center><br>
		<div class="search">
		 <form>
		 <center><select name="year" class="userarea2" width="200px" onchange="showStudent(this.value)">
			  <option value="null" disabled="disabled" style="font-weight: bold;">Select Year</option>
			  <option value="2016">2016</option>
			  <option value="2017">2017</option>
			  <option value="2018">2018</option>
			  <option value="2019">2019</option>
			  <option value="2020">2020</option>
			  <option value="2021">2021</option>
			  <option value="2022">2022</option>
			  <option value="2023">2023</option>
			  <option value="2024">2024</option>
			  <option value="2025">2025</option>
			  <option value="2026">2026</option>
			  <option value="2027">2027</option>
			  <option value="2028">2028</option>
			  <option value="2029">2029</option>
			  <option value="2030">2030</option>
			</select></center><br>
		 </form>
		 </div>
	   </div><br>
	   <div id="txtHint"></div>
	</div>
   <!-- end .content --></div>
  <!-- end .container --></div>
     <?php
      include_once "footer.php";
     ?>
</body>
</html>