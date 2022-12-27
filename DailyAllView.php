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
$FirstName="";
$LastName="";
$Email="";
$Phone="";
$Type="Patient";
$DateBirth="";
$Password="";
$Gender="";
$sql = "SELECT * FROM users WHERE Username='$username'";
$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);
if($conn->connect_error){die("Connection failed: ".$conn->connect_error);}
$FullName="";
if($resultuser = $conn->query($sql))
{
	if ($resultuser->num_rows > 0){
	while($row = $resultuser->fetch_assoc()){
		
		$FirstName=$row['FirstName'];
		$LastName=$row['LastName'];
		$Email=$row['Email'];
		$DateBirth=$row['DateBirth'];
		$Phone=$row['PhoneNumber'];
		$Password=$row['Password'];
		$Gender=$row['Gender'];
	}
	}
}
$FullName=$FirstName.' '.$LastName;
$showAlert = false;
$showError = false;
$exists=false;
$message="";
$Notify=false;
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
?>
<!DOCTYPE html>
<html lang="en">
<head>

     <title>Today's Drug Details</title>

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
					
                         <h2>Today's Drugs Detail</h2>
						 </div>
						 <div class="col-md-12 col-sm-12">
					
						 <?php
						 $todayDate=date('Y-m-d');
						$sel_query="select * from timeline inner join drugs on drugs.DrugID=timeline.DrugID where timeline.date='$todayDate' AND timeline.UserID=$UserID";
$result = mysqli_query($conn,$sel_query);


$cnt = $result->num_rows;
if($cnt!=0){
while($row = mysqli_fetch_assoc($result)) {
	echo 'Drug '.$row["Drug_Name"].' with '.$row["Doses"].' Doses to be taken today at '.$row["DrugTime"].'<br><br>';
}
}
else{echo "No notification for today!";}
						 
						 ?>
						 <br>
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