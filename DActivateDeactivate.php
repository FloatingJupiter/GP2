<?php
include 'dbconfig.php';
$id=$_REQUEST['id'];
$status=$_REQUEST['status'];
$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);
if($conn->connect_error){die("Connection failed: ".$conn->connect_error);}
$query = "UPDATE users SET Active=$status WHERE ID=$id"; 
$result = mysqli_query($conn,$query) or die ( mysqli_error());
header("Location: AdminDoctors.php"); 
?>