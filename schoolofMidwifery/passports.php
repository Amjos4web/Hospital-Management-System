<?php 
session_start();
ob_start();
if(!isset($_SESSION['emaill'])){
	header('location: login.php');
} 
ini_set("display_errors", 1);
// error display configuration
//error_reporting(E_ALL & ~E_NOTICE);
//This block grabs the whole list for viewing
$msg="";
$uploaderror = "";
$emaill= $_SESSION['emaill'];
include "dbconnect.php";
$sql="SELECT * FROM `som` WHERE `eMail`='$emaill' LIMIT 1";
$check = mysqli_query($dbconnect, $sql);
$resultCount=mysqli_num_rows($check); //count the out amount 
if($resultCount>0){
	while($row=mysqli_fetch_array($check)){
		$emAil=$row["eMail"];
		$studentID=$row["studentid"];
		$surname=$row["surName"];
		$otherNames=$row["otherName"];
	}
}else{
$msg="<p style='color: #D8000C; background-color: #FFBABA; border-radius:.5em; width: 300px; border: 1px solid #D8D8D8; padding: 5px; border-radius: 5px; margin-left: auto; margin-right: auto; font-family: Arial; font-size: 11px; text-transform: uppercase; text-align: center; text-transform: uppercase'>You have no Information yet in the Database</p>";
}
//image upload
if(isset($_POST['upload']))	
{ 
	$tmp_name = $_FILES['passport']['tmp_name']; 
	if (empty($tmp_name) == false){
		$name = $_FILES['passport']['name']; 
		$type = $_FILES['passport']['type']; 
		$size = $_FILES['passport']['size']; 
		list($width, $height, $typeb, $attr) = getimagesize($tmp_name); 
		// print_r($_FILES);
		

		if($width<=160 || $height<=160) 
		{ 
			if($type=='image/jpeg' || $type=='image/jpg' || $type=='image/png')
			{
				if($size<='20000') 
				{ 
					if(!get_magic_quotes_gpc())
					{ 
						$name = addslashes($name); 

						$extract = fopen($tmp_name, 'r'); 
						$content = fread($extract, $size); 
						$content = addslashes($content); 
						fclose($extract);  
						//Place image in the folder
						$newname="$studentID.jpg";
						$dir = "passports/";
						$file_name = $newname;
						$path = $dir . $file_name;
						move_uploaded_file($_FILES['passport']['tmp_name'], $path);
						$msg = "<center><p style ='color: #4F8A10; background-color: #DFF2BF; border-radius:.5em; width: 350px; border: 1px solid #D8D8D8; padding: 5px; border-radius: 5px; font-family: Arial; font-size: 11px; text-transform: uppercase; text-align: center; text-transform: uppercase; padding-left: 12px'>Passport uploaded successfully.. Click the link below to continue</p></center>";
					} else {
						$uploaderror = "<p style='color: #D8000C; background-color: #FFBABA; border-radius:.5em; width: 300px; border: 1px solid #D8D8D8; padding: 5px; border-radius: 5px; margin-left: auto; margin-right: auto; font-family: Arial; font-size: 11px; text-transform: uppercase; text-align: center; text-transform: uppercase'>Error has occured... Please try again</p>"; 
					}
				} else {
					$uploaderror = "<p style='color: #D8000C; background-color: #FFBABA; border-radius:.5em; width: 300px; border: 1px solid #D8D8D8; padding: 5px; border-radius: 5px; margin-left: auto; margin-right: auto; font-family: Arial; font-size: 11px; text-transform: uppercase; text-align: center; text-transform: uppercase'>$name is more than 20kb</p>"; 
				}
			} else {
				$uploaderror = "<p style='color: #D8000C; background-color: #FFBABA; border-radius:.5em; width: 300px; border: 1px solid #D8D8D8; padding: 5px; border-radius: 5px; margin-left: auto; margin-right: auto; font-family: Arial; font-size: 11px; text-transform: uppercase; text-align: center; text-transform: uppercase'>$type is not in acceptable format</p>"; 
			} 
		} else {
			$uploaderror = "<p style='color: #D8000C; background-color: #FFBABA; border-radius:.5em; width: 300px; border: 1px solid #D8D8D8; padding: 5px; border-radius: 5px; margin-left: auto; margin-right: auto; font-family: Arial; font-size: 11px; text-transform: uppercase; text-align: center; text-transform: uppercase'>$name should be 160px * 160px</p>"; 
		}
	} else {
		$uploaderror = "<p style='color: #D8000C; background-color: #FFBABA; border-radius:.5em; width: 300px; border: 1px solid #D8D8D8; padding: 5px; border-radius: 5px; margin-left: auto; margin-right: auto; font-family: Arial; font-size: 11px; text-transform: uppercase; text-align: center; text-transform: uppercase'>Please choose a file to upload</p>"; 
	}
}

if (empty($name) == true){
	?><style type="text/css">
	.next {
		display: none;
	}</style><?php
}
?>
<!DOCTYPE html>
<head>
	<html lang="ENG-US">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>BUTH School of Midwifery Upload Passport Page</title>
	<link href="http://www.sono.buth.edu.ng/css/buth_net.css" rel="stylesheet" type="text/css" />
	<script src="js/jquery.js" type="text/javascript"></script>
	<script src="js/main.js" type="text/javascript"></script>
	<script src="js/jqueryy.js" type="text/javascript"></script>

</head>
<body>
<?php
include_once "header.php";
?>
<div id="container" style="height: 600px;">
  <div id="sidebar1"><br>
    <p class="subHeader">Menu</p>
    <ul id="navigation2">
	  <li class="page_title">School of Midwifery</li><br>
	  <li><a href="index.php">Homepage</a></li><br>
      <li><a href="register.php">Register</a></li><br>
      <li><a href="login.php">Login</a></li><br>
    </ul>
    <!-- end .sidebar1 --></div>
     <div class="margin" id="content">
         <div id="pageContent">
             <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
			   <h1 style="color: #880000; font: 22px monospace; word-spacing: 10px;">Upload Passport</h1>
                <div align="center" class="calendarText"><span class="subHeader">Student ID:</span> <?php echo "BUTH/SOM/" . $studentID; ?><br />
                    <img style="border: 3px groove #CECECE; padding-left: 0px; margin-right: 15px;" src="../schoolofMidwifery/passports/<?php echo $studentID; ?>.jpg" alt="" width="160px" height="160px" class="image"><br>
                 </div><br>
			    <div class="buttons">
				    <input name="passport" type="file" id="passport"  tabindex="1" size="30" /><br>
					<input type="hidden" name="MAX_FILE_SIZE" value="20000">
					<input type="submit" name="upload" id="upload" value="Upload Passport" tabindex="2" />
              </form> 
			   <div id="loader-icon" style="display:none;"><img src="images/LoaderIcon.gif" /></div>
                </div><br>
				<?php echo $uploaderror; ?>
				<?php echo $msg; ?><br>		  
                  <p style='text-align: center' class="next"><b><a href="form1.php" class="pageName">&lt;&lt;&lt;&lt;NEXT PAGE&gt;&gt;&gt;&gt;</a></b></p>
				  </div>
                </div>
			  </div>
             
   <?php
  include_once "footer.php";
  ?>
</body>
</html>

