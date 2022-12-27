<?php
session_start();
$lang=$_REQUEST['lang'];
$_SESSION["Lang"]=$lang;
$UserType=$_SESSION["UserType"];
	if($UserType=="1")
	{
		header("Location: DoctorHome.php");
	}
	else if($UserType=="2"){
		header("Location: MonthlyTimeLineView.php");
	}
	else if($UserType=="3"){
		header("Location: AdminHome.php");
	}
	else{header("Location: index.php");}
?>