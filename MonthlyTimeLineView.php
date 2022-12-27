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
$showAlert=false;
$showError = false;
$message="";
$CDate=date('Y-m-1');
$CCDate=$CDate;
if($_SERVER["REQUEST_METHOD"] == "POST") {
if (isset($_POST['pre-submit'])) {
$CDate=$_POST["lblPrevious"]; 
}
if (isset($_POST['next-submit'])) {
$CDate=$_POST["lblNext"]; 
}
if (isset($_POST['c-submit'])) {
$CDate=$_POST["lblCDate"]; 
}
if (isset($_POST['pre-month-submit'])) {
$CDate=$_POST["lblMonth"]; 
}
if (isset($_POST['next-month-submit'])) {
$CDate=$_POST["lblMonth"]; 
echo $CDate;
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
     <title>Monthly Time Line View</title>
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
<script>
        function printDiv() {
            var divContents = document.getElementById("example").innerHTML;
            var a = window.open('', '', 'height=500, width=500');
            a.document.write('<html>');
            a.document.write('<body >');
            a.document.write(divContents);
            a.document.write('</body></html>');
            a.document.close();
            a.print();
        }
    </script>

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
			   <div class="section-title wow fadeInUp" data-wow-delay="0.4s">
			   <?php $time=strtotime($CDate);$year=date("Y",$time);$month=date("F",$time);$monthNo=date("m",$time);
						$maxDays= cal_days_in_month(CAL_GREGORIAN,$monthNo,$year);?>
					<div class="col-md-12 col-sm-12">
						<div class="col-md-2 col-sm-2"><h2>
						<?php 
						 if($_SESSION["Lang"]=="ENGLISH") {  ?>  Monthly<?php } ?>
						 <?php if($_SESSION["Lang"]=="ARABIC") {  ?> شهريا <?php } ?>
						</h2></div>
						<div class="col-md-1 col-sm-1">
						<form id="appointment-form" role="form" method="post" action="">
						<input type="hidden" name="lblMonth" value="<?php if($monthNo==1){echo ($year-1).'-12-01';}else{echo $year.'-'.($monthNo-1).'-01';} ?>">								 
						<button type="submit" class="form-control" id="cf-submit" name="pre-month-submit"><</button>
						</form>
					</div>
						<div class="col-md-4 col-sm-4"><h2> <?php echo $month.' '.$year; ?></h2> </div>	
					<div class="col-md-1 col-sm-1">
						<form id="appointment-form" role="form" method="post" action="">
						<input type="hidden" name="lblMonth" value="<?php if($monthNo==12){echo ($year+1).'-01-01';}else{echo $year.'-'.($monthNo+1).'-01';} ?>">								 
						<button type="submit" class="form-control" id="cf-submit" name="next-month-submit">></button>
						</form>
					</div>	
					<div class="col-md-2 col-sm-2">
					<button class="form-control" id="cf-submit"  onclick="printDiv()"><?php 
						 if($_SESSION["Lang"]=="ENGLISH") {  ?>  Print Time Line<?php } ?>
						 <?php if($_SESSION["Lang"]=="ARABIC") {  ?> طباعة الخط الزمني <?php } ?></button>
					</div>
				   </div>
					<div class="col-md-12 col-sm-12" id="example">
						<table style="width: 100%" style="border: solid 2px lightgrey;padding: 5px;" >
						<tr>
						<td align="center" style="padding: 5px;color:#1B48BB; background-color:white; height:50px;font-weight:bold;font-size:16px;">
						<?php 
						 if($_SESSION["Lang"]=="ENGLISH") {  ?>  Monday<?php } ?>
						 <?php if($_SESSION["Lang"]=="ARABIC") {  ?> الاثنين<?php } ?>
						</td>
						<td align="center" style="padding: 5px;color:#1B48BB; background-color:white; height:50px;font-weight:bold;font-size:16px;">
						<?php 
						 if($_SESSION["Lang"]=="ENGLISH") {  ?>  Tuesday<?php } ?>
						 <?php if($_SESSION["Lang"]=="ARABIC") {  ?> الثلاثاء<?php } ?>
						</td>
						<td align="center" style="padding: 5px;color:#1B48BB; background-color:white; height:50px;font-weight:bold;font-size:16px;">
						<?php 
						 if($_SESSION["Lang"]=="ENGLISH") {  ?>  Wednesday<?php } ?>
						 <?php if($_SESSION["Lang"]=="ARABIC") {  ?> الأربعاء<?php } ?>
						</td>
						<td align="center" style="padding: 5px;color:#1B48BB; background-color:white; height:50px;font-weight:bold;font-size:16px;">
						<?php 
						 if($_SESSION["Lang"]=="ENGLISH") {  ?>  Thursday<?php } ?>
						 <?php if($_SESSION["Lang"]=="ARABIC") {  ?> الخميس<?php } ?>
						</td>
						<td align="center" style="padding: 5px;color:#1B48BB; background-color:white; height:50px;font-weight:bold;font-size:16px;">
						<?php 
						 if($_SESSION["Lang"]=="ENGLISH") {  ?>  Friday<?php } ?>
						 <?php if($_SESSION["Lang"]=="ARABIC") {  ?> الجمعة<?php } ?>
						</td>
						<td align="center" style="padding: 5px;color:#1B48BB; background-color:white; height:50px;font-weight:bold;font-size:16px;">
						<?php 
						 if($_SESSION["Lang"]=="ENGLISH") {  ?>  Saturday<?php } ?>
						 <?php if($_SESSION["Lang"]=="ARABIC") {  ?>السبت<?php } ?>
						</td>
						<td align="center" style="padding: 5px;color:#1B48BB; background-color:white; height:50px;font-weight:bold;font-size:16px;">
						<?php 
						 if($_SESSION["Lang"]=="ENGLISH") {  ?>  Sunday<?php } ?>
						 <?php if($_SESSION["Lang"]=="ARABIC") {  ?>الأحد<?php } ?>
						</td>
						</tr>
						<tr>
						<tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
						</tr>
						<?php 
						$DayName= date("l",strtotime($CCDate));
						$blank = date('w', strtotime("{$year}-{$month}-01"));
						for($i = 1; $i < $blank; $i++){ ?> 
						<td></td>
						<?php }
						$counter=1;
						if($blank==0)
						{$blank=1;}
						for($i = $blank; $i <=7; $i++)
						{ ?>
							<td align="center" style="padding: 5px; height:150px; background:#D7D7D7;border: solid 2px lightgrey">
							<form id="appointment-form" role="form" method="post" action="">
									 <input type="hidden" name="lblCDate" value="<?php echo $year.'-'.$monthNo.'-'.$counter; ?>">
									 
									 <?php
									  $currentdate=$year.'-'.$monthNo.'-'.$counter;
									  
									 $sel_query="SELECT * FROM drugs inner join timeline on timeline.DrugID=drugs.DrugID WHERE timeline.UserID=$UserID AND timeline.Date='$currentdate'";
								 
								   $result = mysqli_query($conn,$sel_query);
								   $cnt = $result->num_rows;
								   if($cnt!=0){?><span style="color:#1B48BB;">
									<?php 
									}echo '<a href="DailyTimeLineView.php?TodayDate='.$year.'-'.$monthNo.'-'.$counter.'">'.$counter.'</a></br>';
									$y=1;
while($row = mysqli_fetch_assoc($result)) {
	echo '<a href="DrugDetails.php?DrugID='.$row["DrugID"].'">'.$y.'-> '.$row["Drug_Name"]."</br>";
	$y++;
}
	?>
									</span>
									
									 </form>
							</td>
						<?php
						$counter++;
						} 
						?>
						</tr>
						
						<?php
						for($x=1;$x<=4;$x++)
						{
							echo '<tr>';
							for($xx=1;$xx<=7;$xx++)
							{
								if($counter<=$maxDays)
								{echo '<td align="center" style="padding: 5px; background-color:#D7D7D7;height:150px; border: solid 2px lightgrey;">';?>
								
									 <input type="hidden" name="lblCDate" value="<?php echo $year.'-'.$monthNo.'-'.$counter; ?>">
									  
									 <?php
									  $currentdate=$year.'-'.$monthNo.'-'.$counter;
									 $sel_query="SELECT * FROM drugs inner join timeline on timeline.DrugID=drugs.DrugID WHERE timeline.UserID=$UserID AND timeline.Date='$currentdate'";
								   $result = mysqli_query($conn,$sel_query);
								   $cnt = $result->num_rows;
								   if($cnt!=0){?> <span style="color: #1B48BB;">
									<?php 
									}echo '<a href="DailyTimeLineView.php?TodayDate='.$year.'-'.$monthNo.'-'.$counter.'">'.$counter.'</a></br>';
									$y=1;
while($row = mysqli_fetch_assoc($result)) {
	echo '<a href="DrugDetails.php?DrugID='.$row["DrugID"].'">'.$y.'-> '.$row["Drug_Name"]."</br>";
	$y++;
}
	?>
									</span></a>

							<?php echo '</td>';}
								else{
								echo '<td></td>';
								}
								$counter++;
							}
							echo '</tr>';
						} 
						?>
						</tr>
								   
								   </table>
								   
								  
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