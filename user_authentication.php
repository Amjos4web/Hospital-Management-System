<?php
session_start();
// error display configuration
//error_reporting(E_ALL & ~E_NOTICE);
include_once "dbconnect.php";
if (isset($_POST['login'])){
  $passWord = $_POST['password'];
  $emaill = $_POST['email'];
  if (empty($emaill && $passWord) == false){
	$sql = "SELECT * FROM `users_login` WHERE `eMail`='$emaill'";
	$check = mysqli_query($dbconnect, $sql) or die (mysqli_error($dbconnect));
	$result = mysqli_num_rows($check);
    if ($result > 0){
		$row=mysqli_fetch_array($check);
        $role=$row["role"];
		
		// validate password
		if (password_verify($passWord, $row['passWord'])){
			if ($role == "Record Admin"){
				session_start();
				$_SESSION['emaill'] = $emaill;
				header ('location: ../buth_net/records/rec_admin_dashboard.php');
			} else if ($role == "Record Staff"){
				session_start();
				$_SESSION['emaill'] = $emaill;
				header ('location: ../buth_net/records/rec_staff_dashboard.php');
			} else if ($role == "Nurse Staff"){
				session_start();
				$_SESSION['emaill'] = $emaill;
				header ('location: ../buth_net/nurse/nurse_dashboard.php');
			} else if ($role == "Pharmacy Admin"){
				session_start();
				$_SESSION['emaill'] = $emaill;
				header ('location: ../pharmacySection/admin_dashboard.php');
			} else if ($role == "Pharmacy Store"){
				session_start();
				$_SESSION['emaill'] = $emaill;
				header ('location: ../buth_net/pharmacySection/pharmacy_store_dashboard.php');
			} else if ($role == "Pharmacy COPD"){
				session_start();
				$_SESSION['emaill'] = $emaill;
				header ('location: ../buth_net/pharmacySection/copd_dashboard.php');
			} else if ($role == "Account Cashier"){
				session_start();
				$_SESSION['emaill'] = $emaill;
				header ('location: ../buth_net/accountSection/account.php');
			} else if ($role == "Account Revenue"){
				session_start();
				$_SESSION['emaill'] = $emaill;
				header ('location: ../buth_net/accountSection/revenue.php');
			} else if ($role == "Clinic"){
				session_start();
				$_SESSION['emaill'] = $emaill;
				header ('location: ../buth_net/doctors/doctors_dashboard.php');
			} else if ($role == "Digital Admin"){
				session_start();
				$_SESSION['emaill'] = $emaill;
				header ('location: ../buth_net/digital/digital_admin_block.php');
			} else if ($role == "Digital Staff"){
				session_start();
				$_SESSION['emaill'] = $emaill;
				header ('location: ../buth_net/digital/digital_home.php');
			}
		} else 
			
			echo "Invalid Password";
    } else
		echo "Invalid Username or Password";
  } else
	echo "Please enter your email and password to login";
}
?>