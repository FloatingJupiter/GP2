<?php
session_start();
if(!array_key_exists('username',$_SESSION) && !empty($_SESSION['username'])) {
    header("Location: Login.php");
}
if($_SESSION['UserType']!="1")
{header("Location: Login.php");}
include 'dbconfig.php';
$username=$_SESSION["username"];
$DoctorID=$_SESSION["userid"];
$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);
if($conn->connect_error){die("Connection failed: ".$conn->connect_error);}
$showAlert=false;
$showError = false;
$message="";
$Prescription="";
if($_SERVER["REQUEST_METHOD"] == "POST") {
	// Database Connection.
	$message="";
	$PatientID=$_POST["cmbPatients"];
	$Prescription=$_POST["txtPrescription"];
	if($PatientID==0)
	{$message="Please select patient.<br>";$showError=true;}
	else if($Prescription=="")
	{$message="Please enter Prescription.<br>";$showError=true;}
	else{
		$sql = "INSERT INTO prescriptions (DoctorID,Notes,PatientID) VALUES($DoctorID,'$Prescription',$PatientID)";
		
				$result = mysqli_query($conn, $sql);
		
				if ($result) {				
						$showAlert = true;
						$message='<strong>Success!</strong> Prescription Saved.';
					}
	}
}//end if
	
?>
<!DOCTYPE html>
<html lang="en">
<head>

     <title>Add Prescription</title>
	
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

<?php include 'dmenu.php';?>




     <!-- MAKE AN APPOINTMENT -->
     <section id="appointment" data-stellar-background-ratio="3">
          <div class="container">
               <div class="row">

                    <div class="col-md-12 col-sm-12">
					
                         <!-- CONTACT FORM HERE -->
                         <form id="appointment-form" role="form" method="post" action="">

                              <!-- SECTION TITLE -->
                              <div class="section-title wow fadeInUp" data-wow-delay="0.4s">
                                   <h2>
								   <?php if($_SESSION["Lang"]=="ENGLISH") {  ?>Add Prescription
						 <?php } ?>
						 <?php if($_SESSION["Lang"]=="ARABIC") {  ?> إضافة وصفة طبية<?php } ?>
								   </h2>
                              </div>
							<div class="col-md-12 col-sm-12">
								   		<?php
											if($showAlert) {echo '<h3 style="color: green;">'.$message."</h3>";}
											if($showError) {echo '<h3 style="color: red;">'.$message."</h3>";}
										?>
								   </div>
                              <div class="wow fadeInUp" data-wow-delay="0.8s">
                                   <div class="col-md-6 col-sm-6">
                                        <label for="cmbPatients">
										<?php if($_SESSION["Lang"]=="ENGLISH") {  ?>Patients:
						 <?php } ?>
						 <?php if($_SESSION["Lang"]=="ARABIC") {  ?> مرضى:<?php } ?>
										</label>
                                        <select class="form-control" name="cmbPatients" id="cmbPatients">
                                             <option value="0">
											 <?php if($_SESSION["Lang"]=="ENGLISH") {  ?>Select Patient
						 <?php } ?>
						 <?php if($_SESSION["Lang"]=="ARABIC") {  ?> حدد المريض<?php } ?>
											 </option>
											 <?php
$sel_query="SELECT * FROM users WHERE UserType=2 AND ID IN(SELECT PatientID FROM patientsdoctors WHERE DoctorID=$DoctorID)";
$result = mysqli_query($conn,$sel_query);
$numrows = mysqli_num_rows($result);
if($numrows==0)
{
	?>
	<?php if($_SESSION["Lang"]=="ENGLISH") {  ?>No Record Found<br>
						 <?php } ?>
						 <?php if($_SESSION["Lang"]=="ARABIC") {  ?> لا يوجد سجلات<br><?php } ?>
<?php
	
}
while($row = mysqli_fetch_assoc($result)) { ?>
                                             <option value='<?php echo $row["ID"] ?>'><?php echo $row["FirstName"].' '.$row["LastName"];?></option>
<?php } ?>
                                        </select>
                                   </div>
								   <div class="col-md-6 col-sm-6"></div>
								   <div class="col-md-12 col-sm-12">
                                        <label for="txtPrescription">
										<?php if($_SESSION["Lang"]=="ENGLISH") {  ?>Prescription Notes:
						 <?php } ?>
						 <?php if($_SESSION["Lang"]=="ARABIC") {  ?> ملاحظات الوصفة الطبية:<?php } ?>
										</label>
										 <div class="page-wrapper box-content">
										<textarea class="form-control1" id="txtPrescription" name="txtPrescription"  required></textarea>
										 </div>
										 <script src="//cdn.ckeditor.com/4.19.1/standard/ckeditor.js"></script>
    <script>
    CKEDITOR.replace( 'txtPrescription' );
    </script>
								</div>
								   <div class="col-md-12 col-sm-12">
								   		<?php
											if($showError) {echo '<h3 style="color: red;">'.$message."</h3>";}
										?>
								   </div>
								   <div class="col-md-12 col-sm-12">
								   <div class="col-md-6 col-sm-6">
                                        <button type="submit" class="form-control" id="cf-submit" name="submit">
										<?php if($_SESSION["Lang"]=="ENGLISH") {  ?>SUBMIT
						 <?php } ?>
						 <?php if($_SESSION["Lang"]=="ARABIC") {  ?> إرسال<?php } ?>
										</button>
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