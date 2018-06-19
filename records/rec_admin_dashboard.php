<?php 
session_start();
ob_start();
// error display configuration
//error_reporting(E_ALL);
ini_set('display_errors','1');

if(!isset($_SESSION['emaill'])){
	header('location: ../index.php');
}
//This block grabs the whole list for viewing
$msg="";
$email= $_SESSION['emaill'];
include "../dbconnect.php";
$sql="SELECT * FROM `users_login` WHERE `eMail`='$email' LIMIT 1";
$check = mysqli_query($dbconnect, $sql);
$resultCount=mysqli_num_rows($check); //count the out amount 
if($resultCount>0){
	while($row=mysqli_fetch_array($check)){
	$id=$row["id"];
	//$password=$row["passWord"];
	$fname=$row["surname"];
	$lname=$row["othername"];
	}
}else{
$msg="<p style='color: red; text-align: center'>You have no Information yet in the Database</p>";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Admin Dashboard</title>

  <!-- css -->
  <?php include_once "../cssImport.php" ?>
</head>

<body id="page-top" data-spy="scroll" data-target=".navbar-custom">


  <div id="wrapper">
  <?php include_once "../header.php"; ?>
  <section id="callaction" class="home-section paddingtop0">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="callaction bg-gray">
              <div class="row">
                <div class="col-md-8">
                  <div class="wow fadeInUp" data-wow-delay="0.1s">
                    <div class="cta-text">
                      <h2>Welcome <?php echo $fname . " " . $lname; ?></h2>
                      <p>What will you like to do today on the Admin Page?</p>
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="wow fadeInUp" data-wow-delay="0.1s">
                    <div class="cta-btn">
                      <a href="logout.php" class="btn btn-skin btn-lg">Log Out</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
	
	<!-- Section: boxes -->
    <section id="boxes" class="home-section paddingtop-80">

      <div class="container">
        <div class="row">
          <div class="col-sm-4">
            <div class="wow fadeInUp" data-wow-delay="0.2s">
              <div class="box text-center">

                <img src="../img/home.png" alt="Main Page" width="100" height="100"><br>
                <h4 class="h-bold"><a href="http://localhost/buth_net/index.php"><button type="button" class="btn btn-info active">Main Page</button></a></h4>
                <p>
                  This button will take you to the home page where you can re-login.
                </p>
              </div>
            </div>
          </div>
          <div class="col-sm-4">
            <div class="wow fadeInUp" data-wow-delay="0.2s">
              <div class="box text-center">

                <img src="../img/search.png" alt="Main Page" width="100" height="100"><br>
                <h4 class="h-bold"><a href="rec_returning_patient.php"><button type="button" class="btn btn-info active">Find Patient</button></a></h4>
                <p>
                 You can find patient by either surname or phone number or hospital number and edit the patient's profile details
                </p>
              </div>
            </div>
          </div>
          <div class="col-sm-4">
            <div class="wow fadeInUp" data-wow-delay="0.2s">
              <div class="box text-center">
                <img src="../img/explore.png" alt="Main Page" width="100" height="100"><br>
                <h4 class="h-bold"><a href=""><button type="button" class="btn btn-info disabled">Explore</button></a></h4>
                <p>
                  Template for future use... This is not active for now
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>

    </section>
    <!-- /Section: boxes -->

     </div>
    </div>
    <?php include_once "../footer.php"; ?>
   
 
    <!--/adminOfficeLogin box-->
       
    <a href="#" class="scrollup"><i class="fa fa-angle-up active"></i></a>

  <!-- Core JavaScript Files -->

  <?php include_once "../jsImport.php"; ?>
</body>

</html>
