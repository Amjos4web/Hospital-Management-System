<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>BUTH MANAGEMENT SYSTEM</title>

  <!-- css -->
  <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" type="text/css" href="plugins/cubeportfolio/css/cubeportfolio.min.css">
  <link href="css/nivo-lightbox.css" rel="stylesheet" />
  <link href="css/nivo-lightbox-theme/default/default.css" rel="stylesheet" type="text/css" />
  <link href="css/owl.carousel.css" rel="stylesheet" media="screen" />
  <link href="css/owl.theme.css" rel="stylesheet" media="screen" />
  <link href="css/animate.css" rel="stylesheet" />
  <link href="css/style.css" rel="stylesheet">

  <!-- boxed bg -->
  <link id="bodybg" href="bodybg/bg1.css" rel="stylesheet" type="text/css" />
  <!-- template skin -->
  <link id="t-colors" href="color/default.css" rel="stylesheet">

</head>

<body id="page-top" data-spy="scroll" data-target=".navbar-custom">


  <div id="wrapper">
  <?php include_once "header.php"; ?>
  <!--<section id="callaction" class="home-section paddingtop0">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="callaction bg-gray">
              <div class="row">
                <div class="col-md-8">
                  <div class="wow fadeInUp" data-wow-delay="0.1s">
                    <div class="cta-text">
                      <h3>BUTH MANAGEMENT SYSTEM</h3>
                      <p>Welcome to BUTH Offline Services</p>
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="wow fadeInUp" data-wow-delay="0.1s">
                    <div class="cta-btn">
                      <a href="#" class="btn btn-skin btn-lg">Need Help?</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>-->

  <!-- Section: Login boxes -->
    <section id="boxes" class="home-section paddingtop0">
       <div class="container">
        <section class="cms-boxes">
           <div class="container-fluid">
           <div class="wow fadeInUp" data-wow-delay="0.1s">
              <div class="row">
                <a href="#" data-target="#recordsLogin" data-toggle="modal">
                   <!-- <a href="http://localhost/buth_net/records/index.php">-->
                   <div class="col-md-3 cms-boxes-outer">
                    <div class="cms-boxes-items cms-features">
                       <div class="boxes-align">
                          <div class="small-box">
                             <i class="fa fa-hospital-o" style="font-size:48px;">&nbsp;</i>
                             <h5>Record's Portal</h5>
                             <p></p>
                          </div>
                       </div>
                    </div></a>
                 </div>
                 <a href="#" data-target="#nursesLogin" data-toggle="modal">
              <!--   <a href="http://localhost/buth_net/nurse/nurse_login.php">-->
                   <div class="col-md-3 cms-boxes-outer">
                    <div class="cms-boxes-items cms-features">
                       <div class="boxes-align">
                          <div class="small-box">
                             <i class="fa fa-user-md" style="font-size:48px;">&nbsp;</i>
                             <h5>Nursing Unit</h5>
                             <p></p>
                          </div>
                       </div>
                    </div></a>
                 </div>
                 <a href="#" data-target="#pharmLogin" data-toggle="modal">
                <!-- <a href="http://localhost/buth_net/pharmacySection/index.php">-->
                   <div class="col-md-3 cms-boxes-outer">
                    <div class="cms-boxes-items cms-features">
                       <div class="boxes-align">
                          <div class="small-box">
                             <i class="fa fa-ambulance" style="font-size:48px;">&nbsp;</i>
                             <h5>Pharmacy Portal</h5>
                             <p></p>
                          </div>
                       </div>
                    </div></a>
                 </div>
                 <a href="#" data-target="#accountsLogin" data-toggle="modal">
                 <!--<a href="http://localhost/buth_net/accountSection/account_home.php">--><div class="col-md-3 cms-boxes-outer">
                    <div class="cms-boxes-items cms-features">
                       <div class="boxes-align">
                          <div class="small-box">
                             <i class="fa fa-dollar" style="font-size:48px;">&nbsp;</i>
                             <h5>Account Portal</h5>
                             <p></p>
                          </div>
                       </div>
					 </div></a>
                 </div>
                 <a href="#" data-target="#clinicsLogin" data-toggle="modal">
               <!--  <a href="http://localhost/buth_net/doctors/index.php">--><div class="col-md-3 cms-boxes-outer">
                    <div class="cms-boxes-items cms-features">
                       <div class="boxes-align">
                          <div class="small-box">
                             <i class="fa fa-wheelchair" style="font-size:48px;">&nbsp;</i>
                             <h5>Clinics</h5>
                             <p></p>
                          </div>
                       </div>
                    </div></a>
                 </div>
                    <a href="#"><div class="col-md-3 cms-boxes-outer">
                    <div class="cms-boxes-items cms-features">
                       <div class="boxes-align">
                          <div class="small-box">
                             <i class="fa fa-ambulance" style="font-size:48px;">&nbsp;</i>
                             <h5>Laboratory</h5>
                             <p></p>
                          </div>
                       </div>
                    </div></a>
                 </div>
               <a href="#" data-target="#ictLogin" data-toggle="modal">
                     <!--<a href="http://localhost/buth_net/digital/digital_admin_block.php">-->
                     <div class="col-md-3 cms-boxes-outer">
                    <div class="cms-boxes-items cms-features">
                       <div class="boxes-align">
                          <div class="small-box">
                             <i class="fa fa-code" style="font-size:48px;">&nbsp;</i>
                             <h5>ICT/Digital Centre</h5>
                             <p></p>
                          </div>
                       </div>
                    </div></a>
                 </div> <a href="#" data-target="#adminOfficeLogin" data-toggle="modal">
                <!-- <a href="http://localhost/buth_net/admin/admin_login.php">-->
                   <div class="col-md-3 cms-boxes-outer">
                    <div class="cms-boxes-items cms-features">
                       <div class="boxes-align">
                          <div class="small-box">
                             <i class="fa fa-user" style="font-size:48px;">&nbsp;</i>
                             <h5>Admin-Office Portal</h5>
                             <p></p>
                          </div>
                       </div>
                    </div>
                 </div></a>
              </div>
              </div>
              </div>
           </div>
        </section><br>
    <!-- /Section: boxes -->
     <!--RecordLogin box-->
  <div class="modal fade" id="recordsLogin" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content no 1-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title text-center form-title">Records Login</h4>
        </div>
        <div class="modal-body padtrbl">

          <div class="login-box-body">
            <p class="login-box-msg">Sign in to Records Portal</p>
            <div class="form-group">
              <form id="loginForm" method="POST" action="">
                <div class="form-group has-feedback">
                  <!----- username -------------->
                  <input class="form-control" placeholder="Email" id="loginid" name="email" type="text" autocomplete="off" autofocus 
                  />
                  <span style="display:none;font-weight:bold; position:absolute;color: red;position: absolute;padding:4px;font-size: 11px;background-color:rgba(128, 128, 128, 0.26);z-index: 17;  right: 27px; top: 5px;" id="span_loginid"></span>
                  <!---Alredy exists  ! -->
                  <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                  <!----- password -------------->
                  <input class="form-control" placeholder="Password" id="loginpsw" name="password" type="password" autocomplete="off"  />
                  <span style="display:none;font-weight:bold; position:absolute;color: grey;position: absolute;padding:4px;font-size: 11px;background-color:rgba(128, 128, 128, 0.26);z-index: 17;  right: 27px; top: 5px;" id="span_loginpsw"></span>
                  <!---Alredy exists  ! -->
                  <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="row">
                  <div class="col-xs-12">
                    <div class="checkbox icheck">
                      <label>
                     	 <input type="checkbox" id="loginrem" > Remember Me
                      </label>
                    </div>
                  </div>
                  <div class="col-xs-12">
                    <input type="submit" class="btn btn-primary btn-block btn-flat" name="login" id="loginBtn" value="Sign Me In">
                    <label class="form-check-label">
                      <span class="text-danger align-middle" id="errorMsg"></span>
                    </label>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
    <!--/RecordsLogin box-->
    
         <!--nursesLogin box-->
  <div class="modal fade" id="nursesLogin" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content no 1-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title text-center form-title">Nurses Login</h4>
        </div>
        <div class="modal-body padtrbl">

          <div class="login-box-body">
            <p class="login-box-msg">Sign in for Vital Sign</p>
            <div class="form-group">
              <form name="" id="loginForm" method="POST" action="">
                <div class="form-group has-feedback">
                  <!----- username -------------->
                  <input class="form-control" placeholder="Email" id="loginid" name="email" type="text" autocomplete="off" />
                  <span style="display:none;font-weight:bold; position:absolute;color: red;position: absolute;padding:4px;font-size: 11px;background-color:rgba(128, 128, 128, 0.26);z-index: 17;  right: 27px; top: 5px;" id="span_loginid"></span>
                  <!---Alredy exists  ! -->
                  <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                  <!----- password -------------->
                  <input class="form-control" placeholder="Password" id="loginpsw" name="password" type="password" autocomplete="off" />
                  <span style="display:none;font-weight:bold; position:absolute;color: grey;position: absolute;padding:4px;font-size: 11px;background-color:rgba(128, 128, 128, 0.26);z-index: 17;  right: 27px; top: 5px;" id="span_loginpsw"></span>
                  <!---Alredy exists  ! -->
                  <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="row">
                  <div class="col-xs-12">
                    <div class="checkbox icheck">
                      <label>
                     	 <input type="checkbox" name="login" id="loginrem" > Remember Me
                      </label>
                    </div>
                  </div>
                  <div class="col-xs-12">
                    <input type="submit" class="btn btn-primary btn-block btn-flat" name="login" value="Sign Me In">
                  </div>
				  <label class="form-check-label">
					<span class="text-danger align-middle" id="errorMsg"></span>
				  </label>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
    <!--/nursesLogin box-->
    
      
      <!--pharmLogin box-->
  <div class="modal fade" id="pharmLogin" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content no 1-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title text-center form-title">Pharmacy Login</h4>
        </div>
        <div class="modal-body padtrbl">

          <div class="login-box-body">
            <p class="login-box-msg">Sign in to Pharmacy Portal</p>
            <div class="form-group">
              <form name="" id="loginForm" method="POST" action="">
                <div class="form-group has-feedback">
                  <!----- username -------------->
                  <input class="form-control" placeholder="Email" id="loginid" name="email" type="text" autocomplete="off" />
                  <span style="display:none;font-weight:bold; position:absolute;color: red;position: absolute;padding:4px;font-size: 11px;background-color:rgba(128, 128, 128, 0.26);z-index: 17;  right: 27px; top: 5px;" id="span_loginid"></span>
                  <!---Alredy exists  ! -->
                  <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                  <!----- password -------------->
                  <input class="form-control" placeholder="Password" id="loginpsw" name="password" type="password" autocomplete="off" />
                  <span style="display:none;font-weight:bold; position:absolute;color: grey;position: absolute;padding:4px;font-size: 11px;background-color:rgba(128, 128, 128, 0.26);z-index: 17;  right: 27px; top: 5px;" id="span_loginpsw"></span>
                  <!---Alredy exists  ! -->
                  <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="row">
                  <div class="col-xs-12">
                    <div class="checkbox icheck">
                      <label>
                     	 <input type="checkbox" id="loginrem" name="login" > Remember Me
                      </label>
                    </div>
                  </div>
                  <div class="col-xs-12">
                    <input type="submit" class="btn btn-primary btn-block btn-flat" name="login" value="Sign Me In">
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
    <!--/pharmLogin box-->
    
      <!--accountsLogin box-->
  <div class="modal fade" id="accountsLogin" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content no 1-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title text-center form-title">Accounts Dept. Login</h4>
        </div>
        <div class="modal-body padtrbl">

          <div class="login-box-body">
            <p class="login-box-msg">Sign in to Accounts Dept.</p>
            <div class="form-group">
              <form name="" id="loginForm" method="POST" action="">
                <div class="form-group has-feedback">
                  <!----- username -------------->
                  <input class="form-control" placeholder="Email" id="loginid" name="email" type="text" autocomplete="off" />
                  <span style="display:none;font-weight:bold; position:absolute;color: red;position: absolute;padding:4px;font-size: 11px;background-color:rgba(128, 128, 128, 0.26);z-index: 17;  right: 27px; top: 5px;" id="span_loginid"></span>
                  <!---Alredy exists  ! -->
                  <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                  <!----- password -------------->
                  <input class="form-control" placeholder="Password" id="loginpsw" name="password" type="password" autocomplete="off" />
                  <span style="display:none;font-weight:bold; position:absolute;color: grey;position: absolute;padding:4px;font-size: 11px;background-color:rgba(128, 128, 128, 0.26);z-index: 17;  right: 27px; top: 5px;" id="span_loginpsw"></span>
                  <!---Alredy exists  ! -->
                  <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="row">
                  <div class="col-xs-12">
                    <div class="checkbox icheck">
                      <label>
                     	 <input type="checkbox" id="loginrem" name="login" > Remember Me
                      </label>
                    </div>
                  </div>
                  <div class="col-xs-12">
                    <input type="submit" class="btn btn-primary btn-block btn-flat" name="login" value="Sign Me In">
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
    <!--/accountsLogin box-->
    
     <!--clinicsLogin box-->
  <div class="modal fade" id="clinicsLogin" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content no 1-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title text-center form-title">E-Clinics Login</h4>
        </div>
        <div class="modal-body padtrbl">

          <div class="login-box-body">
            <p class="login-box-msg">Sign in to E-Clinics</p>
            <div class="form-group">
              <form name="" id="loginForm" method="POST" action="">
                <div class="form-group has-feedback">
                  <!----- username -------------->
                  <input class="form-control" placeholder="Email" id="loginid" name="email" type="text" autocomplete="off" />
                  <span style="display:none;font-weight:bold; position:absolute;color: red;position: absolute;padding:4px;font-size: 11px;background-color:rgba(128, 128, 128, 0.26);z-index: 17;  right: 27px; top: 5px;" id="span_loginid"></span>
                  <!---Alredy exists  ! -->
                  <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                  <!----- password -------------->
                  <input class="form-control" placeholder="Password" id="loginpsw" name="password" type="password" autocomplete="off" />
                  <span style="display:none;font-weight:bold; position:absolute;color: grey;position: absolute;padding:4px;font-size: 11px;background-color:rgba(128, 128, 128, 0.26);z-index: 17;  right: 27px; top: 5px;" id="span_loginpsw"></span>
                  <!---Alredy exists  ! -->
                  <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="row">
                  <div class="col-xs-12">
                    <div class="checkbox icheck">
                      <label>
                     	 <input type="checkbox" id="loginrem" name="login" > Remember Me
                      </label>
                    </div>
                  </div>
                  <div class="col-xs-12">
                    <input type="submit" class="btn btn-primary btn-block btn-flat" name="login" value="Sign Me In">
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
    <!--/clinicsLogin box-->
   
    
     <!--ictLogin box-->
  <div class="modal fade" id="ictLogin" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content no 1-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title text-center form-title">ICT/Digital Centre Login</h4>
        </div>
        <div class="modal-body padtrbl">

          <div class="login-box-body">
            <p class="login-box-msg">Sign in ICT/Digital Centre</p>
            <div class="form-group">
              <form name="" id="loginForm" method="POST" action="">
                <div class="form-group has-feedback">
                  <!----- username -------------->
                  <input class="form-control" placeholder="Email" id="loginid" name="email" type="text" autocomplete="off" />
                  <span style="display:none;font-weight:bold; position:absolute;color: red;position: absolute;padding:4px;font-size: 11px;background-color:rgba(128, 128, 128, 0.26);z-index: 17;  right: 27px; top: 5px;" id="span_loginid"></span>
                  <!---Alredy exists  ! -->
                  <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                  <!----- password -------------->
                  <input class="form-control" placeholder="Password" id="loginpsw" name="password" type="password" autocomplete="off" />
                  <span style="display:none;font-weight:bold; position:absolute;color: grey;position: absolute;padding:4px;font-size: 11px;background-color:rgba(128, 128, 128, 0.26);z-index: 17;  right: 27px; top: 5px;" id="span_loginpsw"></span>
                  <!---Alredy exists  ! -->
                  <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="row">
                  <div class="col-xs-12">
                    <div class="checkbox icheck">
                      <label>
                     	 <input type="checkbox" id="loginrem" name="login" > Remember Me
                      </label>
                    </div>
                  </div>
                  <div class="col-xs-12">
                    <input type="submit" class="btn btn-primary btn-block btn-flat" name="login" value="Sign Me In">
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
    <!--/ictLogin box-->
      
     <!--adminOfficeLogin box-->
  <div class="modal fade" id="adminOfficeLogin" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content no 1-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title text-center form-title">Admin Dept. Login</h4>
        </div>
        <div class="modal-body padtrbl">

          <div class="login-box-body">
            <p class="login-box-msg">Sign in to Administrative Office</p>
            <div class="form-group">
              <form name="" id="loginForm" method="POST" action="">
                <div class="form-group has-feedback">
                  <!----- username -------------->
                  <input class="form-control" placeholder="Email" id="loginid" name="email" type="text" autocomplete="off" />
                  <span style="display:none;font-weight:bold; position:absolute;color: red;position: absolute;padding:4px;font-size: 11px;background-color:rgba(128, 128, 128, 0.26);z-index: 17;  right: 27px; top: 5px;" id="span_loginid"></span>
                  <!---Alredy exists  ! -->
                  <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                  <!----- password -------------->
                  <input class="form-control" placeholder="Password" id="loginpsw" name="password" type="password" autocomplete="off" />
                  <span style="display:none;font-weight:bold; position:absolute;color: grey;position: absolute;padding:4px;font-size: 11px;background-color:rgba(128, 128, 128, 0.26);z-index: 17;  right: 27px; top: 5px;" id="span_loginpsw"></span>
                  <!---Alredy exists  ! -->
                  <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="row">
                  <div class="col-xs-12">
                    <div class="checkbox icheck">
                      <label>
                     	 <input type="checkbox" id="loginrem" name="login" > Remember Me
                      </label>
                    </div>
                  </div>
                  <div class="col-xs-12">
                    <input type="submit" class="btn btn-primary btn-block btn-flat" name="login" value="Sign Me In">
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
 </div>
   <?php include_once "footer.php"; ?>
    <!--/adminOfficeLogin box-->
       
    <a href="#" class="scrollup"><i class="fa fa-angle-up active"></i></a>

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
  <script src="js/validate.js"></script>
</body>

</html>
