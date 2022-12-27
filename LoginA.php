<?php
include 'dbconfig.php';
session_start();
$_SESSION["username"]="";
$_SESSION["userid"]="";
$_SESSION["UserType"]="";
$_SESSION["lang"]="ENGLISH";
session_destroy();
$showError = false;
$message="";
if($_SERVER["REQUEST_METHOD"] == "POST") {
	// Database Connection.
	$message="";
	$username=$_POST["txtUsername"];
	$upassword=$_POST["txtPassword"];
	$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);
	if($conn->connect_error){die("Connection failed: ".$conn->connect_error);}
	$sql="SELECT * FROM users WHERE (Username='$username' OR Email='$username') AND Password='$upassword'";
	$sqlActive="SELECT * FROM users WHERE (Username='$username' OR Email='$username') AND Password='$upassword' AND Active=1";
	$result = mysqli_query($conn,$sql);
	$result2 = mysqli_query($conn,$sqlActive);
	$numrows = mysqli_num_rows($result);
	$numrowsActive = mysqli_num_rows($result2);
	if($numrows==0)
	{$message="Username & Password don't match!<br>";$showError=true;}
	else if($numrowsActive==0)
	{$message="Account is In-Active, Please contact the Administrator!<br>";$showError=true;}
	else
	{session_start();
	$_SESSION["username"] = $username;
	$UserType="";
	while($row = $result->fetch_assoc()){
			$UserType=$row['UserType'];
			$_SESSION["userid"] =$row['ID'];
			$_SESSION["UserType"] =$UserType;
	}
	if($UserType=="1")
	{
		header("Location: DoctorHome.php");
	}
	else if($UserType=="2"){
		header("Location: MonthlyTimeLineView.php");
	}
	else
	{
		header("Location: AdminHome.php");
	}
	}
}//end if
	
?>
<!DOCTYPE html>
<html lang="en">
<head>

     <title>Login</title>

     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=Edge">
     <meta name="description" content="">
     <meta name="keywords" content="">
     <meta name="author" content="Tooplate">
     <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

     <link rel="stylesheet" href="css/bootstrap.min.css">
     <link rel="stylesheet" href="css/font-awesome.min.css">
     <link rel="stylesheet" href="css/animate.css">
     <link rel="stylesheet" href="css/owl.carousel.css">
     <link rel="stylesheet" href="css/owl.theme.default.min.css">

     <!-- MAIN CSS -->
     <link rel="stylesheet" href="css/tooplate-style.css">

</head>
<body id="top" data-spy="scroll" data-target=".navbar-collapse" data-offset="50">

     <!-- PRE LOADER -->
     <section class="preloader">
          <div class="spinner">

               <span class="spinner-rotate"></span>
               
          </div>
     </section>


     <!-- HEADER -->
     <header>
          <div class="container">
               <div class="row">

                    <div class="col-md-4 col-sm-5">
					
                         <p>مرحبًا بكم في جدول Health MED </p>
                    </div>
                         
                   

               </div>
          </div>
     </header>


     <!-- MENU -->
     <section class="navbar navbar-default navbar-static-top" role="navigation">
          <div class="container">

               <div class="navbar-header">
                    <button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                         <span class="icon icon-bar"></span>
                         <span class="icon icon-bar"></span>
                         <span class="icon icon-bar"></span>
                    </button>

                    <!-- lOGO TEXT HERE -->
                    <a href="index.html" class="navbar-brand"><i class="fa fa-h-square"></i>ealth MED Scheduler</a>
               </div>

               <!-- MENU LINKS -->
               <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                         <li><a href="index.html" class="smoothScroll">Home</a></li>
                        
                         <li class="appointment-btn"><a href="Registration.php">Create an Account</a></li>
                    </ul>
               </div>

          </div>
     </section>



     <!-- MAKE AN APPOINTMENT -->
     <section id="appointment" data-stellar-background-ratio="3">
          <div class="container">
               <div class="row">

                    

                    <div class="col-md-6 col-sm-6">
                         <!-- CONTACT FORM HERE -->
                         <form id="appointment-form" role="form" method="post" action="">

                              <!-- SECTION TITLE -->
                              <div class="section-title wow fadeInUp" data-wow-delay="0.4s">
							<?php  echo $_SESSION["lang"];
								    if ($_SESSION["lang"]=="ENGLISH")
								   { ?>
							    <h2>Login to Your Account</h2>
							   <?php } else { ?>
                                   <h2>تسجيل الدخول إلى حسابك</h2>
								   <?php } ?>
                              </div>

                              <div class="wow fadeInUp" data-wow-delay="0.8s">
                                   <div class="col-md-12 col-sm-12">
                                        <label for="txtUsername">Username/Email:</label>
                                        <input type="text" class="form-control" id="txtUsername" name="txtUsername" placeholder="Your Username/Email" required>
                                   </div>
								   
								   <div class="col-md-12 col-sm-12">
                                        <label for="txtPassword">Password</label>
                                        <input type="password" class="form-control" id="txtPassword" name="txtPassword" placeholder="Password" required>
                                   </div>
								   <div class="col-md-12 col-sm-12">
								   		<?php
											if($showError) {echo '<h3 style="color: red;">'.$message."</h3>";}
										?>
								   </div>
								   <div class="col-md-6 col-sm-6">
                                        <button type="submit" class="form-control" id="cf-submit" name="submit">Login</button>
                                   </div>
                                        
										
									</div>
                                        
                                        
                                   </div>
                              </div>
                        </form>
                    <div class="col-md-6 col-sm-6">
                         <img src="images/appointment-image.jpg" class="img-responsive" alt="">
                    </div>
					</div>

               </div>
          </div>
     </section>
         


<?php
include 'footer.php';
?>
     <!-- SCRIPTS -->
     <script src="js/jquery.js"></script>
     <script src="js/bootstrap.min.js"></script>
     <script src="js/jquery.sticky.js"></script>
     <script src="js/jquery.stellar.min.js"></script>
     <script src="js/wow.min.js"></script>
     <script src="js/smoothscroll.js"></script>
     <script src="js/owl.carousel.min.js"></script>
     <script src="js/custom.js"></script>

</body>
</html>