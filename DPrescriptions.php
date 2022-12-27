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
if($_SERVER["REQUEST_METHOD"] == "POST") {
	if (isset($_POST['submitadd'])) {
    
	header("Location: DAddPrescription.php");
	}
}
	
?>
<!DOCTYPE html>
<html lang="en">
<head>

     <title>Prescriptions</title>

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
					<form id="appointment-form" role="form" method="post" action="">
					<div class="col-md-6 col-sm-6">
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
								   <div class="col-md-3 col-sm-3">
                                        <button type="submit" class="form-control" id="cf-submit" name="submit">
										<?php if($_SESSION["Lang"]=="ENGLISH") {  ?>Search
						 <?php } ?>
						 <?php if($_SESSION["Lang"]=="ARABIC") {  ?> بحث<?php } ?>
										</button>
                                   </div>
								   </form>
								   <div class="col-md-3 col-sm-3">
								   <form id="appointment-form" role="form" method="post" action="">

								   <button type="submit" class="form-control" id="cf-submit" name="submitadd">
								   <?php if($_SESSION["Lang"]=="ENGLISH") {  ?>Add Prescription
						 <?php } ?>
						 <?php if($_SESSION["Lang"]=="ARABIC") {  ?> إضافة وصفة طبية<?php } ?>
								   </button>
								     </form>
                                   </div>
					</div>
					
					
                    <div class="col-md-12 col-sm-12">
					 <table width="100%" border="1" style="border-collapse:collapse;">
<thead>
<tr>
<th style="text-align:center"><strong>
<?php if($_SESSION["Lang"]=="ENGLISH") {  ?>P.No
						 <?php } ?>
						 <?php if($_SESSION["Lang"]=="ARABIC") {  ?> رقم المريض<?php } ?>
</strong></th>
<th style="text-align:center"><strong>
  <?php if($_SESSION["Lang"]=="ENGLISH") {  ?>Date & Time
						 <?php } ?>
						 <?php if($_SESSION["Lang"]=="ARABIC") {  ?> التاريخ والوقت<?php } ?>
</strong></th>
<th style="text-align:center"><strong>
<?php if($_SESSION["Lang"]=="ENGLISH") {  ?>Notes
						 <?php } ?>
						 <?php if($_SESSION["Lang"]=="ARABIC") {  ?> ملاحظات<?php } ?>
</strong></th>
</tr>
</thead>
<tbody>
<?php
if($_SERVER["REQUEST_METHOD"] == "POST") {
	// Database Connection.
	$message="";
	$PatientID=$_POST["cmbPatients"];
	
	if($PatientID==0)
	{$message="Please select patient.<br>";$showError=true;}	
	else{
$sel_query="SELECT * FROM prescriptions WHERE DoctorID=$DoctorID AND PatientID=$PatientID ORDER BY PrescriptionID DESC";
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
<tr>
<td align="center"><?php echo $row["PrescriptionID"]; ?></td>
<td align="center"><?php echo $row["PDateTime"]; ?></td>
<td align="center"><?php echo $row["Notes"]; ?></td>
</tr>
<?php  
}
	}
}	?>
</tbody>
</table>
                        
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