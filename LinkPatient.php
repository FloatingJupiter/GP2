<?php
session_start();
if(!array_key_exists('username',$_SESSION) && !empty($_SESSION['username'])) {
    header("Location: Login.php");
}
if($_SESSION['UserType']!="1")
{header("Location: Login.php");}
include 'dbconfig.php';
$username=$_SESSION["username"];
$userid=$_SESSION["userid"];
$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);
if($conn->connect_error){die("Connection failed: ".$conn->connect_error);}
$showAlert=false;
$showError = false;
$message="";
if($_SERVER["REQUEST_METHOD"] == "POST") {
	// Database Connection.
	$message="";
	$PID=$_POST["cmbPatients"];
	if($PID==0)
	{$message="Please select patient.<br>";$showError=true;}
	else{
		$sql = "INSERT INTO patientsdoctors (DoctorID,PatientID) VALUES ($userid,$PID)";
				$result = mysqli_query($conn, $sql);
		
				if ($result) {				
						$showAlert = true;
						$message='<strong>Success!</strong> Patient Linked Successfully.';
					}
	}
}//end if
	
?>
<!DOCTYPE html>
<html lang="en">
<head>

     <title>Link Patients</title>

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
                         <p>Welcome to Health MED Scheduler</p>
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
                    <a href="DoctorHome.php" class="navbar-brand"><i class="fa fa-h-square"></i>ealth MED Scheduler</a>
               </div>

               <!-- MENU LINKS -->
               <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                         <li><a href="DoctorHome.php" class="smoothScroll">Home</a></li>
                         <li><a href="DoctorPatients.php" class="smoothScroll">Patients</a></li>
                         <li><a href="DPrescriptions.php" class="smoothScroll">Prescriptions</a></li>
                         <li class="appointment-btn"><a href="Logout.php">Logout</a></li>
                    </ul>
               </div>

          </div>
     </section>



     <!-- MAKE AN APPOINTMENT -->
     <section id="appointment" data-stellar-background-ratio="3">
          <div class="container">
               <div class="row">

                    <div class="col-md-6 col-sm-6">
                         <img src="images/appointment-image.jpg" class="img-responsive" alt="">
                    </div>

                    <div class="col-md-6 col-sm-6">
                         <!-- CONTACT FORM HERE -->
                         <form id="appointment-form" role="form" method="post" action="">

                              <!-- SECTION TITLE -->
                              <div class="section-title wow fadeInUp" data-wow-delay="0.4s">
                                   <h2>Link Patients</h2>
                              </div>
							<div class="col-md-12 col-sm-12">
								   		<?php
											if($showAlert) {echo '<h3 style="color: green;">'.$message."</h3>";}
											if($showError) {echo '<h3 style="color: red;">'.$message."</h3>";}
										?>
								   </div>
                              <div class="wow fadeInUp" data-wow-delay="0.8s">
                                   <div class="col-md-12 col-sm-12">
                                        <label for="cmbPatients">Patients:</label>
                                        <select class="form-control" name="cmbPatients" id="cmbPatients">
                                             <option value="0">Select Patient</option>
											 <?php
$sel_query="SELECT * FROM users WHERE ID NOT IN(SELECT PatientID FROM patientsdoctors WHERE DoctorID=$userid) AND UserType=2";
$result = mysqli_query($conn,$sel_query);
$numrows = mysqli_num_rows($result);
if($numrows==0)
{echo "No Record Found!<br>";}
while($row = mysqli_fetch_assoc($result)) { ?>
                                             <option value='<?php echo $row["ID"] ?>'><?php echo $row["FirstName"].' '.$row["LastName"];?></option>
<?php } ?>
                                        </select>
                                   </div>
								   
								   <div class="col-md-12 col-sm-12">
								   		<?php
											if($showError) {echo '<h3 style="color: red;">'.$message."</h3>";}
										?>
								   </div>
								   <div class="col-md-12 col-sm-12">
								   <div class="col-md-6 col-sm-6">
                                        <button type="submit" class="form-control" id="cf-submit" name="submit">Save</button>
                                   </div>                                        
										
									</div>
                                        
                                        
                                   </div>
                              </div>
                        </form>
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