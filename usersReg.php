<?php 
// error display configuration
//error_reporting(E_ALL & ~E_NOTICE);
include_once "dbconnect.php";
$Msg = "";

if (isset($_POST['register'])){
	$email = strip_tags(substr($_POST['email'],0,30));
	$password = strip_tags(substr($_POST['password'],0,30));
	$conPassword = $_POST['conPassword'];
	$surname = $_POST['firstname'];
	$lastname = strip_tags(substr($_POST['lastname'],0,30));
	$department = strip_tags(substr($_POST['department'],0,30));
	$phoneNo = strip_tags(substr($_POST['phone'],0,11));
	$role = strip_tags(substr($_POST['role'],0,30));
	$pass1Harsh = password_hash($password, PASSWORD_DEFAULT);
	$pass2Harsh = password_hash($conPassword, PASSWORD_DEFAULT);
	
	$uppercase = preg_match('@[A-Z]@', $password);
	$lowercase = preg_match('@[a-z]@', $password);
	$number    = preg_match('@[0-9]@', $password);
	$characters = preg_match('@[\W]@', $password);
	$number = preg_match('@[\d]@', $password);
	
	if (empty($email & $password & $conPassword & $surname & $lastname & $department & $role) == false){
		if (filter_var($email, FILTER_VALIDATE_EMAIL)){
			if ($uppercase & $lowercase & $number & $characters & $number & strlen($password) >= 8){
				if ($password == $conPassword){
					$sqlInsert = "INSERT INTO `users_login` (`surname`, `othername`, `department`, `role`, `phoneNo`, `eMail`, `passWord`, `confirmed_passWord`)
					VALUES ('".$surname."', '".$lastname."', '".$department."', '".$role."', '".$phoneNo."', '".$email."', '".$pass1Harsh."', '".$pass2Harsh."')";
					$sqliInsertCheck = mysqli_query($dbconnect, $sqlInsert) or die (mysqli_error($dbconnect));
					$Msg = "<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Success!</strong> You have been registered successfully... <a href='#' class='alert-link'>Click here to Login to your Portal</a></div>";
				} else {
					$Msg = "<div class='alert alert-danger'> <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Password do not match</div>";
				}
			} else {
				$Msg = "<div class='alert alert-danger'> <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Password do not meet requirements</div>";
			}
		} else {
			$Msg = "<div class='alert alert-danger'> <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Invalid Email Address</div>";
		}
	} else {
		$Msg = "<div class='alert alert-danger'> <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>All fields is required</div>";
	}
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Users Registration</title>

  <!-- css -->
  <?php include_once "cssImport.php" ?>
  
  <!-- Core JavaScript Files -->

  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/jquery.easing.min.js"></script>
  <script src="js/wow.min.js"></script>
  <script src="js/jquery.scrollTo.js"></script>
  <script src="js/jquery.appear.js"></script>
  <script src="js/stellar.js"></script>
  <script src="plugins/cubeportfolio/js/jquery.cubeportfolio.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/nivo-lightbox.min.js"></script>
  <script src="js/custom.js"></script>
  
 <script>
  $(document).ready(function(){
	
	$('#pass').keyup(function() {
		var pswd = $(this).val();
		
		//validate the length
		if ( pswd.length < 8 ) {
			$('#length').removeClass('valid').addClass('invalid');
		} else {
			$('#length').removeClass('invalid').addClass('valid');
		}
		
		//validate letter
		if ( pswd.match(/[A-z]/) ) {
			$('#letter').removeClass('invalid').addClass('valid');
		} else {
			$('#letter').removeClass('valid').addClass('invalid');
		}

		//validate capital letter
		if ( pswd.match(/[A-Z]/) ) {
			$('#capital').removeClass('invalid').addClass('valid');
		} else {
			$('#capital').removeClass('valid').addClass('invalid');
		}

		//validate number
		if ( pswd.match(/\d/) ) {
			$('#number').removeClass('invalid').addClass('valid');
		} else {
			$('#number').removeClass('valid').addClass('invalid');
		}
		
		//validate space
		if ( pswd.match(/[^a-zA-Z0-9\-\/]/) ) {
			$('#space').removeClass('invalid').addClass('valid');
		} else {
			$('#space').removeClass('valid').addClass('invalid');
		}
		
	}).focus(function() {
		$('#pswd_info').show();
	}).blur(function() {
		$('#pswd_info').hide();
	});
	
});
</script>
</head>

<body id="page-top" data-spy="scroll" data-target=".navbar-custom">


<div id="wrapper">
<?php include_once "header.php"; ?>
  <section id="callaction" class="home-section paddingtop0">
      <div class="container">
        <div class="row">
          <div class="form-group">
		    <label class="form-check-label">
            </label>
		    <form action="" method="POST" id="usersReg" autocomplete="off">
			  <!--<fieldset>
			    <legend><i class="fa fa-user-plus"></i><b>Sign Up</b></legend>
			  </fieldset>-->
			  <div class='row'>
			    <div class='col-sm-12'>    
				  <?php echo $Msg; ?>
			    </div>
		      </div>
			  <fieldset>
				<legend>Login Information</legend>
				<div class='row'>
					<div class='col-sm-12'>    
						<div class='form-group'>
							<label for="user_title">Email Address</label>
							<input class="form-control" id="user_name" name="email" size="30" type="text" />
						</div>
					</div>
					<div class='col-sm-6'>
						<div class='form-group'>
							<label for="user_password">Password</label>
							<input class="form-control" id="pass" name="password" type="password" autocomplete="off" />
							<i class="fa fa-eye hide-show" onclick="if (pass.type == 'text') pass.type = 'password'; 
							else pass.type = 'text';"></i>
						</div>
					</div>
					<div class='col-sm-6'>
						<div class='form-group'>
							<label for="user_cpassword">Password Confirmation</label>
							<input class="form-control" id="cpassword" name="conPassword" type="password" autocomplete="off" />
							<i class="fa fa-eye hide-show" onclick="if (cpassword.type == 'text') cpassword.type = 'password'; 
							else cpassword.type = 'text';"></i>
						</div>
					</div>
					<div class="col-md-4 col-sm-4">
				      <!--<div class="aro-pswd_info">-->
						<div id="pswd_info">
						  <h4>Password must be requirements</h4>
							<ul>
							  <li id="letter" class="invalid">At least <strong>one letter</strong></li>
							  <li id="capital" class="invalid">At least <strong>one capital letter</strong></li>
							  <li id="number" class="invalid">At least <strong>one number</strong></li>
							  <li id="length" class="invalid">Be at least <strong>8 characters</strong></li>
							  <li id="space" class="invalid">be<strong> use [~,!,@,#,$,%,^,&,*,-,=,.,;,']</strong></li>
							</ul>
					    </div>
			          </div>
				    </div>
		        </div>
				</fieldset><br>
			  <fieldset>
				<legend>Personal Information</legend>
				<div class='row'>
					<div class='col-sm-6'>
						<div class='form-group'>
							<label for="user_firstname">First name</label>
							<input class="form-control" id="user_firstname" name="firstname" size="30" type="text" />
						</div>
					</div>
					<div class='col-sm-6'>
						<div class='form-group'>
							<label for="user_lastname">Last name</label>
							<input class="form-control" id="user_lastname" name="lastname" size="30" type="text" />
						</div>
					</div>
					<div class='col-sm-12'>    
						<div class='form-group'>
							<label for="user_phone">Phone Number</label>
							<input class="form-control" id="user_phone" name="phone" size="11" type="text" />
						</div>
					</div>
					<div class='col-sm-12'>    
						<div class='form-group'>
							<label for="user_title">Department</label>
							<select class="form-control" id="user_role" name="department" />
							  <option value="Null">Select Department</option>
							  <option value="Record">Record Department</option>
							  <option value="Nurse Department">Nurse Department</option>
							  <option value="Pharmacy Department">Pharmacy Department</option>
							  <option value="Account Department">Account Department</option>
							  <option value="Clinic">Clinic</option>
							  <option value="Digital Centre">Digital Centre</option>
							</select>
						</div>
					</div>
					<div class='col-sm-12'>    
						<div class='form-group'>
							<label for="user_title">Role</label>
							<select class="form-control" id="user_role" name="role" />
							<option value="Null">Select Role</option>
							  <option value="Record Admin">Record Admin</option>
							  <option value="Record Staff">Record Staff</option>
							  <option value="Nurse Staff">Nurse Staff</option>
							  <option value="Pharmacy Admin">Pharmacy Admin</option>
							  <option value="Pharmacy Store">Pharmacy Store</option>
							  <option value="Pharmacy COPD">Pharmacy COPD</option>
							  <option value="Account Cashier">Account Cashier</option>
							  <option value="Account Revenue">Account Revenue</option>
							  <option value="Clinic">Clinic</option>
							  <option value="Digital Admin">Digital Admin</option>
							  <option value="Digital Staff">Digital Staff</option>
							</select>
						</div>
					</div>
				</div>
				<input type="submit" class="btn btn-primary pull-right" name="register" value="Register">
				</fieldset>
			</form>
		  </div>
        </div>
	   </section>
      </div><br>
	<?php include_once "footer.php"; ?>
   
 <a href="#" class="scrollup"><i class="fa fa-angle-up active"></i></a>
  
</body>

</html>
