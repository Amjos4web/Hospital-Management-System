<?php 
session_start();
ob_start();
// error display configuration
error_reporting(E_ALL);
ini_set('display_errors','1');

if(!isset($_SESSION['emaill'])){
	header('location: ../index.php');
}
//This block grabs the whole list for viewing
$msg="";
$email= $_SESSION['emaill'];
include "dbconnect2.php";
$sql="SELECT * FROM `users_login` WHERE `eMail`='$email' LIMIT 1";
$check = mysqli_query($dbconnect, $sql);
$resultCount=mysqli_num_rows($check); //count the out amount 
if($resultCount>0){
	while($row=mysqli_fetch_array($check)){
	$id=$row["id"];
	$password=$row["passWord"];
	$name=$row["surname"];
	}
}else{
$msg="<p style='color: red; text-align: center'>You have no Information yet in the Database</p>";
}

$query = "SELECT `id`,`states` FROM `states`";
$result1 = mysqli_query($dbconnect,$query);
$rows = mysqli_num_rows($result1);
if ($rows){
  while($row = mysqli_fetch_assoc($result1)){
    $states[] = array("id" => $row['id'], "val" => $row['states']);
  }
}

$query = "SELECT `id`, `state_id`, `local_government` FROM `local_governments`";
$result2 = mysqli_query($dbconnect,$query);
$rows2 = mysqli_num_rows($result1);
if ($rows2){
  while($row2 = mysqli_fetch_assoc($result2)){
	$local_government[$row2['state_id']][] = array("id" => $row2['id'], "val" => $row2['local_government']);
  }

  $jsonStates = json_encode($states);
  $jsonLocal_government = json_encode($local_government);
}
  
?>
<!doctype html>
<html>
<link href="http://localhost/buth_net/pharmacySection/css/buth_net.css" rel="stylesheet" type="text/css">
<head>
<meta charset="utf-8">
<link rel="shortcut icon" href="/favicon.ico" >
<script type="text/javascript">
<?php
echo "var states = $jsonStates; \n";
echo "var local_government = $jsonLocal_government; \n";
?>
function loadStates(){
var select = document.getElementById("statesSelect");
select.onchange = updateLocal_government;
for(var i = 0; i < states.length; i++){
  select.options[i] = new Option(states[i].val,states[i].id);
		  
	
}
}
function updateLocal_government(){
var statesSelect = this;
var state_id = this.value;
var local_governmentSelect = document.getElementById("local_governmentSelect");
local_governmentSelect.options.length = 0; //delete all options if any present
for(var i = 0; i < local_government[state_id].length; i++){
  local_governmentSelect.options[i] = new Option(local_government[state_id][i].val,local_government[state_id][i].val);
}
}

</script>
<title>Staff Dashboard</title>
</head>
<body onload='loadStates()'>
<?php
include_once "../pharmacySection/header.php";
?>
<div id="container">
  <div id="sidebar1"><br>
    <p class="subHeader">Menu</p>
    <ul id="navigation2">
	  <li class="page_title">Records Unit</li><br>
	  <li><a href="http://localhost/buth_net/index.php">Main Page</a></li><br>
	  <li><a href="rec_new_client.php">New Patient</a></li><br>
	  <li><a href="rec_returning_patient.php">Find Patient</a></li><br>
	  <li><a href="logout.php">Logout</a></li><br>
    </ul>
	<?php include_once "../new_bar.php"; ?>
      <!-- end .sidebar1 --></div>
     <div class="margin" id="content">
	 <h1 style='text-align: center; font-family: tahoma; font-size: 16px; text-transform: uppercase; font-weight: bold; background-color: #000000; margin-top: -5px; color: #CECECE'>Welcome Staff! <?php echo $name; ?> What would you like to do today?</h1><br>
	  <div class="bio_data">
	   <fieldset>
	     <div class="search_angle">
	     <center><h3 class="heading_text">Returning Patient</h3></center>
		<center><img src="../pharmacySection/images/record.jpg" alt="search_angle" width="500px" height="200px"></center><br>
		<div class="search">
		 <form action="rec_search.php" method="GET">
		 <center><input type="text" name="search2" id="search2" maxlength="88" placeholder="Search only by hospital no, surname or phone no"><br><br></center>
		 <center><select name='level' style='border-radius: 3px; background-color: #CECECE; width: 250px; border: 2px solid #CECECE'>
		 <option value='null'>Select Staff or Non Staff</option>
		 <option value='staff'>Staff</option>
		 <option value='nonstaff'>Non Staff</option>
		 </select></center><br><br>
		 <center><input type="submit" value="Search" name="searchbtn2" id="searchbtn2"></center>
		 </form>
		</div>
	   </div>
	    <?php
	    echo $msg;
	    ?>
	</div>
   <!-- end .content --></div>
  <!-- end .container --></div>
     <?php
      include_once "../pharmacySection/footer.php";
     ?>
</body>
</html>