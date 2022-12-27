<?php
session_start();
if(!array_key_exists('username',$_SESSION) && !empty($_SESSION['username'])) {
    header("Location: Login.php");
}
if($_SESSION['UserType']!="2")
{header("Location: Login.php");}
include 'dbconfig.php';
$username=$_SESSION["username"];
$UserID=$_SESSION["userid"];
$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);
if($conn->connect_error){die("Connection failed: ".$conn->connect_error);}
$DrugName="";
$DrugNotes="";
$DrugDescription="";
$DrugDoses="";
$DrugPhoto="";
$DrugRepetition="";
$countDrugs=0;
$Today=date('Y-m-d');
$sql2 = "SELECT COUNT(*) AS Nos FROM timeline WHERE UserID=$UserID AND Date='$Today'";
if($resultDrug = $conn->query($sql2))
{
	if ($resultDrug->num_rows > 0){
	$Notify=true;
	while($row = $resultDrug->fetch_assoc()){
		
		$countDrugs=$row['Nos'];
	}
	}
}
if($_REQUEST['DrugID']!="")
{
$DrugID=$_REQUEST['DrugID'];
$sel_query="SELECT * FROM drugs WHERE DrugID=$DrugID";
$result = mysqli_query($conn,$sel_query);
$cnt = $result->num_rows;
if($cnt!=0){
while($row = mysqli_fetch_assoc($result)) {
	$DrugName=$row["Drug_Name"];
	$DrugNotes=$row["Notes"];
	$DrugDescription=$row["Description"];
	$DrugDoses=$row["Doses"];
	$DrugRepetition=$row["Repitition"];
	$DrugPhoto=$row["Picture"];
}
}
}
else
{
header("Location: PatientHome.php");
}
	
?>
<!DOCTYPE html>
<html lang="en">
<head>
     <title>Drug Details</title>
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



<?php include 'pmenu.php';?>



     <!-- MAKE AN APPOINTMENT -->
     <section id="appointment" data-stellar-background-ratio="3">
          <div class="container">
               <div class="row">

                    <div class="col-md-12 col-sm-12">
					
             <div class="section-title wow fadeInUp" data-wow-delay="0.4s">
                                   <h2>Drug Detail</h2>
                              </div>
							
                              <div class="wow fadeInUp" data-wow-delay="0.8s">
									
									<div class="col-md-6 col-sm-6">
                                        <label for="cmbPatients">Drug Name:</label>
                                        <input type="text" class="form-control" id="txtDrugName" name="txtDrugName" value="<?php echo $DrugName; ?>" placeholder="Enter Drug Name" disabled>
                                   </div>
								   <div class="col-md-6 col-sm-2">
                                        <label for="cmbPatients">Repitition (In Hours):</label>
                                        <input type="number" class="form-control" id="txtRepeat" name="txtRepeat" value="<?php echo $DrugRepetition; ?>" name="txtDoses" min="2" disabled>
                                   </div>
								   <div class="col-md-6 col-sm-2">
                                        <label for="cmbPatients">Doses:</label>
                                        <input class="form-control" type="number" id="txtDoses" value="<?php echo $DrugDoses; ?>" name="txtDoses" disabled>
                                   </div>
								   <div class="col-md-6 col-sm-6">
                                        <img  src="<?php echo $DrugPhoto; ?>" alt="Drug Image" width="300" height="300">
                                   </div>
								   <div class="col-md-12 col-sm-12">
                                        <label for="txtPrescription">Drug Description:</label>
								   <textarea id="txtDescription" name="txtDescription" class="form-control"  placeholder="Enter Description Here" disabled><?php echo $DrugDescription; ?></textarea>
								</div>
								<div class="col-md-12 col-sm-12">
                                        <label for="txtPrescription">Drug Notes:</label>
								   <textarea id="txtNotes" name="txtNotes" class="form-control"  placeholder="Enter Notes" disabled><?php echo $DrugNotes; ?></textarea>
								</div>
								
								   
                                        
                                        
                                   </div>
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