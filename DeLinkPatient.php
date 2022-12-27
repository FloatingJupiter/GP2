<?php
include 'dbconfig.php';
$pid=$_REQUEST['pid'];
$did=$_REQUEST['did'];
$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);
if($conn->connect_error){die("Connection failed: ".$conn->connect_error);}
$query = "DELETE FROM patientsdoctors WHERE PatientID=$pid AND DoctorID=$did"; 
$result = mysqli_query($conn,$query) or die ( mysqli_error());
header("Location: DoctorPatients.php"); 
?>