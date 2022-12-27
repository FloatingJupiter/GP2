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
?>
<!DOCTYPE html>
<html lang="en">
<head>

     <title>Doctor's Patient</title>

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
					
					<div class="section-title wow fadeInUp" data-wow-delay="0.4s">
					
					
					<div class="col-md-9 col-sm-9">
                                   <h2>
								   <?php if($_SESSION["Lang"]=="ENGLISH") {  ?>Details of My Patients
						 <?php } ?>
						 <?php if($_SESSION["Lang"]=="ARABIC") {  ?> تفاصيل مرضاي<?php } ?>
								   </h2></div>
								   <div class="col-md-3 col-sm-3">
							  <a href="LinkPatient.php" class="form-control" id="cf-submit" style="text-align:center;background-color: #1B48BB;color:white;" >
							   <?php if($_SESSION["Lang"]=="ENGLISH") {  ?>Link Patient
						 <?php } ?>
						 <?php if($_SESSION["Lang"]=="ARABIC") {  ?> ربط المريض<?php } ?>
							  </a>
							  </div>
                              </div>
                        <table width="100%" border="1" style="border-collapse:collapse;">
<thead>
<tr>
<th style="text-align:center"><strong>
<?php if($_SESSION["Lang"]=="ENGLISH") {  ?>D.No
						 <?php } ?>
						 <?php if($_SESSION["Lang"]=="ARABIC") {  ?> رقم سري<?php } ?>
</strong></th>
<th style="text-align:center"><strong>
<?php if($_SESSION["Lang"]=="ENGLISH") {  ?>Name
						 <?php } ?>
						 <?php if($_SESSION["Lang"]=="ARABIC") {  ?> اسم<?php } ?>
</strong></th>
<th style="text-align:center"><strong>
<?php if($_SESSION["Lang"]=="ENGLISH") {  ?>Username
						 <?php } ?>
						 <?php if($_SESSION["Lang"]=="ARABIC") {  ?> اسم المستخدم<?php } ?>
</strong></th>
<th style="text-align:center"><strong>
<?php if($_SESSION["Lang"]=="ENGLISH") {  ?>Email
						 <?php } ?>
						 <?php if($_SESSION["Lang"]=="ARABIC") {  ?> بريد إلكتروني<?php } ?>
</strong></th>
<th style="text-align:center"><strong>
<?php if($_SESSION["Lang"]=="ENGLISH") {  ?>Gender
						 <?php } ?>
						 <?php if($_SESSION["Lang"]=="ARABIC") {  ?> جنس<?php } ?>
</strong></th>
<th style="text-align:center"><strong>
<?php if($_SESSION["Lang"]=="ENGLISH") {  ?>Date of Birth
						 <?php } ?>
						 <?php if($_SESSION["Lang"]=="ARABIC") {  ?> تاريخ الولادة<?php } ?>
</strong></th>
<th style="text-align:center"><strong>
<?php if($_SESSION["Lang"]=="ENGLISH") {  ?>Phone Number
						 <?php } ?>
						 <?php if($_SESSION["Lang"]=="ARABIC") {  ?> رقم التليفون<?php } ?>
</strong></th>
<th style="text-align:center"><strong>
<?php if($_SESSION["Lang"]=="ENGLISH") {  ?>Action
						 <?php } ?>
						 <?php if($_SESSION["Lang"]=="ARABIC") {  ?> فعل<?php } ?>
</strong></th>
</tr>
</thead>
<tbody>
<?php
$sel_query="SELECT * FROM users WHERE ID IN(SELECT PatientID FROM patientsdoctors WHERE DoctorID=$userid) ORDER BY ID ASC";
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
<td align="center"><?php echo $row["ID"]; ?></td>
<td align="center"><?php echo $row["FirstName"].' '.$row["LastName"]; ?></td>
<td align="center"><?php echo $row["Username"]; ?></td>
<td align="center"><?php echo $row["Email"]; ?></td>
<td align="center"><?php if($row["Gender"]==1){echo "Male";} else if($row["Gender"]==2){echo "Female";} else {echo "Other";} ?></td>
<td align="center"><?php echo $row["DateBirth"]; ?></td>
<td align="center"><?php echo $row["PhoneNumber"]; ?></td>
<td align="center" >
<a class="appointment-btn" href="DeLinkPatient.php?pid=<?php echo $row["ID"].'&did='.$userid;?>">
<?php if($_SESSION["Lang"]=="ENGLISH") {  ?>De-Link
						 <?php } ?>
						 <?php if($_SESSION["Lang"]=="ARABIC") {  ?>فك الارتباط<?php } ?>
</a>
</td>

</tr>
<?php  
} ?>
</tbody>
</table>
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