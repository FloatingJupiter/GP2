<?php
include 'dbconfig.php';
$DrugID=$_REQUEST['DrugID'];
$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);
if($conn->connect_error){die("Connection failed: ".$conn->connect_error);}
$query = "DELETE FROM timeline WHERE DrugID=$DrugID"; 
$result = mysqli_query($conn,$query) or die ( mysqli_error());
$query2 = "DELETE FROM timelinehistory WHERE DrugID=$DrugID"; 
$result2 = mysqli_query($conn,$query2) or die ( mysqli_error());
$query3 = "DELETE FROM drugs WHERE DrugID=$DrugID"; 
$result3 = mysqli_query($conn,$query3) or die ( mysqli_error());
header("Location: PDrugs.php"); 
?>