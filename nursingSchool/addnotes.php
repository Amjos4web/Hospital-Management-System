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
$deleteerror = "";
$deletemsg = "";
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

// parse the form data and add the inventory to the system
$date = date('Y-m-d');
if (isset($_POST['submit']))
{
	$title = htmlspecialchars($_POST['title']);
	$notes = htmlspecialchars($_POST['notes']);
	
	
	// parse data into the database
	if (empty($title && $notes) == false){
		if (strlen($title) <= 30){
			$insert = "INSERT INTO addnotes (title, date, notes, added_by) VALUES ('$title', '$date', '$notes', '$name')";
			$check3 = mysqli_query($dbconnect, $insert) or die (mysqli_error($dbconnect));
			$msg = '<p style = "color: #4F8A10; margin-right: auto; margin-right: auto; text-align: center; background-color: #DFF2BF; border-radius:.5em; width: 400px; border: 1px solid #D8D8D8; margin-left: auto; margin-right: auto; padding: 5px; border-radius: 5px; font-family: Arial; font-size: 11px; text-transform: uppercase; text-transform: uppercase">Operation Successful</p>';
			header ("refresh:3; url=addnotes.php"); // wait for 3 secs before redirect
		} else {
			$msg = "<p style='color: #D8000C; background-color: #FFBABA; border-radius:.5em; width: 300px; border: 1px solid #D8D8D8; padding: 5px; border-radius: 5px; margin-left: auto; margin-right: auto; font-family: Arial; font-size: 11px; text-transform: uppercase; text-align: center; text-transform: uppercase'>Title should not be more than 30 characters</p>";
		}
	} else {
		$msg = "<p style='color: #D8000C; background-color: #FFBABA; border-radius:.5em; width: 300px; border: 1px solid #D8D8D8; padding: 5px; border-radius: 5px; margin-left: auto; margin-right: auto; font-family: Arial; font-size: 11px; text-transform: uppercase; text-align: center; text-transform: uppercase'>Please fill in the required fields</p>";
	}
	
}

// view notes
$displaynote = "";
$selectnote = "SELECT * FROM `addnotes` ORDER by `date` DESC";
$checknote = mysqli_query($dbconnect, $selectnote);
$resultCount2=mysqli_num_rows($checknote); //count the out amount 
if($resultCount2>0){
	while($row=mysqli_fetch_array($checknote)){
		$titled=$row["title"];
		$dateadded=$row["date"];
		$note=$row["notes"];
		$addedby=$row["added_by"];
		$id=$row["id"];
		
		$notetitle = $titled . " " . "By" . " " . $addedby;
		
		$displaynote .= '<label class="noteheading">'.$notetitle.'</label><br>';
	    $displaynote .= '<label class="dateadded">Published on: <i>'. " " .$dateadded.'</i></label><br>';
	    $displaynote .= '<p class="note">'.$note.'</p>';
		$displaynote .= '<form action="" method="POST">';
		$displaynote .= '<input type="submit" name="deletenote" value="Delete This Note" id="deletenote">';
		$displaynote .= '</form><br><br>';
		$_SESSION['id'] = $id;
	} 
}

// delete note 
if (isset($_POST['deletenote'])){
	$id = $_SESSION['id'];
	$delete = "DELETE FROM addnotes WHERE id=".$id." LIMIT 1";
	$check = mysqli_query($dbconnect, $delete) or die (mysqli_error($dbconnect));
	if ($check){
		$deletemsg = '<p style = "color: #4F8A10; margin-right: auto; margin-right: auto; text-align: center; background-color: #DFF2BF; border-radius:.5em; width: 400px; border: 1px solid #D8D8D8; margin-left: auto; margin-right: auto; padding: 5px; border-radius: 5px; font-family: Arial; font-size: 11px; text-transform: uppercase; text-transform: uppercase">Operation Successful</p>';
	} else {
		$deleteerror ="<p>Error has occurred... Please try again</p>";
	}
} 
?>
<!doctype html>
<html>
<link href="http://localhost/buth_net/nursingSchool/css/buth_net.css" rel="stylesheet" type="text/css">
<head>
<meta charset="utf-8">
<link rel="shortcut icon" href="/favicon.ico" >
<title>Add Notes</title>
</head>
<body>
<?php
include_once "header.php";
?>
<div id="container" style="min-height: 300px;">
  <div id="sidebar1"><br>
    <p class="subHeader">Menu</p>
    <ul id="navigation2">
	  <li class="page_title">Admin Unit</li><br>
		<li><a href="http://localhost/buth_net/index.php">Main Page</a></li><br>
		<li><a href="viewstudents.php">Home Page</a></li><br>
		<li><a href="addnotes.php">Add Notes</a></li><br>
		<li><a href="logout.php">Logout</a></li><br>
    </ul>
      <!-- end .sidebar1 --></div>
     <div class="margin" id="content">
	 <h1 style='text-align: center; font-family: tahoma; font-size: 16px; text-transform: uppercase; font-weight: bold; background-color: #000000; color: #CECECE'>Welcome <?php echo $name."!" . " "; ?>What would you like to do today?</h1>
		<div class="product_form2">
		 <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
		 <div class="form"><br>
		 <h3 style='color: brown; font-size: 22px; font-style: normal; text-align: center; font-family: monospace; text-transform: uppercase;'>Admin Section/Add Notes<h3>
		 <?php echo $msg; ?>
		  <table width="450px" style="margin-left: auto; margin-right: auto; min-height: 100px;" cellpadding="5" cellspacing="0" border="1">
			 <tr>
			   <td width="30%"><label>Title</label></td>
			   <td width="70%"><input type="text" id="userarea" name="title" value= "<?=@$title?>"></td>
			  </tr>
			  <tr>
			   <td width="30%"><label>Date</label></td>
			   <td width="70%"><input type="text" id="userarea" name="date" disabled="disabled" value="<?php echo $date; ?>"></td>
			  </tr>
			  <tr>
			   <td width="30%"><label>Notes</label></td>
			   <td width="70%"><textarea type="textarea" cols="30" rows="10" id="userarea"  name="notes"><?=@$notes?></textarea></td>
			  </tr>
			</table><br>	
		   <center><input type="submit" value="Add Notes" name="submit" class="submit4"></center>
		   </form>
		  </div>
	</div><br>
	<?php echo $deletemsg; ?>
	<?php echo $deleteerror; ?>
	<div class="notestodis"><?php echo $displaynote; ?></div>
			   <!-- end .content --></div>
			  <!-- end .container --></div>
     <?php
      include_once "footer.php";
     ?>
</body>
</html>