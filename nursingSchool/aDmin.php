<?php
if (isset($_POST['submit']))
{
	$name = htmlspecialchars($_POST['name']);
	$email = htmlspecialchars($_POST['email']);
	$password = $_POST['password'];
	$passHarsh = password_hash($password, PASSWORD_DEFAULT);
	$last_log_date = date('Y-m-d:H-m-i');
	
	if(empty($name && $email && $password) == false)
	{
		// parse data into the database
		include "dbconnect.php";
		$insert = "INSERT INTO nursing_admin (`admin_name`, `admin_email`, `admin_pass`, `last_log_date`) VALUES ('$name', '$email', '$passHarsh', '$last_log_date')";
		$checkInsert = mysqli_query($dbconnect, $insert) or die (mysqli_error($dbconnect));
		if ($checkInsert == True){
			echo "Inserted Successfully";
		} else {
			echo "Error parsing data";
		}
	} else {
		echo "Can't parse null value";
	}
}
?>
<!doctype html>
<html>
<head>
<title>Admin</title>
</head>
<body>
  <form action="" method="post">
  <p><label>Name</label>
  <input type="text" name="name"></p>
  <p><label>Email</label>
  <input type="text" name="email"></p>
  <p><label>Password</label>
  <input type="password" name="password"></p>
  <input type="submit" name="submit" value="Submit">
  </form>
</html>
<body>