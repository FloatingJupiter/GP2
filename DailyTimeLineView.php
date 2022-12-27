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
$showAlert=false;
$showError = false;
$message="";
$countDrugs=0;
$Today=date('Y-m-d');
$CDate=date('Y-m-d');
if(isset($_REQUEST['TodayDate']))
{
	$CDate=$_REQUEST['TodayDate'];
}

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
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
     <title>Daily Time Line View</title>
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


     <!-- MENU -->
     <?php include 'pmenu.php';?>



     <!-- MAKE AN APPOINTMENT -->
     <section id="appointment" data-stellar-background-ratio="3">
          <div class="container">
               <div class="row">
			   <div class="section-title wow fadeInUp" data-wow-delay="0.4s">
			   <?php $time=strtotime($CDate);$year=date("Y",$time);$month=date("F",$time);$monthNo=date("m",$time);
						$maxDays= cal_days_in_month(CAL_GREGORIAN,$monthNo,$year);?>
					<div class="col-md-12 col-sm-12">
					<?php 
						 if($_SESSION["Lang"]=="ENGLISH") {  ?>  <h2>Daily Time Line</h2><?php } ?>
						 <?php if($_SESSION["Lang"]=="ARABIC") {  ?> <h2>الجدول الزمني اليومي</h2> <?php } ?>
						
						</div>
						
						<div class="col-md-12 col-sm-12">
						<div class="col-md-1 col-sm-1">
						<form id="appointment-form" role="form" method="post" action="">
						<input type="hidden" name="lblMonth" value="<?php if($monthNo==1){echo ($year-1).'-12-01';}else{echo $year.'-'.($monthNo-1).'-01';} ?>">								 
						<button type="submit" class="form-control" id="cf-submit" name="pre-month-submit"><</button>
						</form>
					</div>
						<div class="col-md-3 col-sm-3"><h3> <?php echo $month.' '.$year; ?></h3> </div>	
					<div class="col-md-1 col-sm-1">
						<form id="appointment-form" role="form" method="post" action="">
						<input type="hidden" name="lblMonth" value="<?php if($monthNo==12){echo ($year+1).'-01-01';}else{echo $year.'-'.($monthNo+1).'-01';} ?>">								 
						<button type="submit" class="form-control" id="cf-submit" name="next-month-submit">></button>
						</form>
					</div>									   
				   <div class="col-md-1 col-sm-1">
						<form id="appointment-form" role="form" method="post" action="">
						<input type="hidden" name="lblPrevious" value="<?php echo date('Y-m-d', strtotime($CDate. ' - 1 days')); ?>">								 
						<button type="submit" class="form-control" id="cf-submit" name="pre-submit"><</button>
						</form>
					</div>
					<div class="col-md-2 col-sm-2"><h3><?php echo $CDate; ?></h3></div>
				  <div class="col-md-1 col-sm-1">
					   <form id="appointment-form" role="form" method="post" action="">
						<input type="hidden" name="lblNext" value="<?php echo date('Y-m-d', strtotime($CDate. ' + 1 days')); ?>">
						<button type="submit" class="form-control" id="cf-submit" name="next-submit">></button>
					   </form>
					</div>
					<div class="col-md-2 col-sm-2">
						<button class="form-control" id="cf-submit"  onclick="printDiv()">
						<?php 
						 if($_SESSION["Lang"]=="ENGLISH") {  ?>  Print Time Line<?php } ?>
						 <?php if($_SESSION["Lang"]=="ARABIC") {  ?> الخط الزمني للطباعة <?php } ?>
						</button>	
					</div>
				   </div>
					<div class="col-md-12 col-sm-12">
						<table style="width: 100%" style="padding: 5px;" >
								   <tr align="center" >
								   <?php 
								   for($x=1;$x<=16;$x++)
								   {?>
									<td align="center" style="padding: 5px;">
									 <form id="appointment-form" role="form" method="post" action="">
									 <input type="hidden" name="lblCDate" value="<?php echo $year.'-'.$monthNo.'-'.$x; ?>">
									 <button type="submit" class="form-control" id="cf-submit" name="c-submit">
									 <?php
									 $currentdate=$year.'-'.date('n').'-'.$x;
									 $sel_query="SELECT * FROM drugs inner join timeline on timeline.DrugID=drugs.DrugID WHERE timeline.Date='$currentdate' AND timeline.UserID=$UserID";
								   $result = mysqli_query($conn,$sel_query);
								   $cnt = $result->num_rows;
								   if($cnt!=0){?><span style="color:yellow;">
									<?php } 
									if($currentdate==$CDate){ ?><span style="color:red;">
									<?php }
									echo $x;?></br><?php    echo date('D', strtotime($currentdate)); ?>
									</span>
									</button>
									 </form>
									</td><?php } ?>
									</tr>
									<tr align="center">
								   <?php 
								   for($x=17;$x<=$maxDays;$x++)
								   {?>
									<td align="center" style="padding: 5px;">
									<form id="appointment-form" role="form" method="post" action="">
									 <input type="hidden" name="lblCDate" value="<?php echo $year.'-'.$monthNo.'-'.$x; ?>">
									 <button type="submit" class="form-control" id="cf-submit" name="c-submit">
									 <?php
									 $currentdate=$year.'-'.date('n').'-'.$x;
									 $sel_query="SELECT * FROM drugs inner join timeline on timeline.DrugID=drugs.DrugID WHERE timeline.Date='$currentdate' 
									 AND timeline.UserID=$UserID;";
								   $result = mysqli_query($conn,$sel_query);
								   $cnt = $result->num_rows;
								   if($cnt!=0){?><span style="color:yellow;">
									<?php } 
									if($currentdate==$CDate){ ?><span style="color:red;">
									<?php }
									echo $x;?></br><?php    echo date('D', strtotime($currentdate)); ?>
									</span>
									</button>
									 </form>
									</td><?php } ?>
									</tr>
								   </table>
				</div>
							<div class="col-md-12 col-sm-12" id="example">
								<table style="width: 100%" style="border:1px solid black;padding: 10px;" >
								<?php 
								   for($x=1;$x<=12;$x++)
								   {?>
								   <tr align="center" style="border: 1px solid black;">
								   <td align="right" style="border: 1px solid black;padding: 5px; width:100px;">
								   <button type="submit" class="form-control" id="cf-submit" disabled><?php  echo $x.' AM'; ?></button></td>
								   
								   <?php
								   $Time="00";
								   if($x<10){$Time="0".$x;}else{$Time=$x;}
								   $sel_query="SELECT * FROM drugs inner join timeline on timeline.DrugID=drugs.DrugID WHERE timeline.Date='$CDate' 
								   AND SUBSTRING(timeline.DrugTime,1,2)='$Time' AND timeline.UserID=$UserID;";
								   $result = mysqli_query($conn,$sel_query);
								   $cnt = $result->num_rows;
								   if($cnt==0)
								   {?>
								   <td align="center" style="border: 1px solid black;padding: 20px; background-color:#D7D7D7;"></td>
								   <?php
								   }
								   else
								   {
								   ?>
								   <td align="center" style="border: 1px solid black;padding: 20px; background-color:#90EE90;">
								   <?php
								   while($row = mysqli_fetch_assoc($result)) { ?>
								   <?php echo '<a href="DrugDetails.php?DrugID='.$row["DrugID"].'">'.$row["Drug_Name"].'</a><br>'; ?>
								   <?php }} ?>
								   </td>
								   </tr>
								   <?php } ?>
								   <?php
								   $counter=13;
								   for($x=1;$x<=12;$x++)
								   {?>
								   <tr align="center" style="border: 1px solid black;">
								   <td align="right" style="border: 1px solid black;padding: 5px;  width:100px;">
								   <button type="submit" class="form-control" id="cf-submit" disabled><?php  echo $x.' PM'; ?></button></td>
								   
								   <?php
								   $Time=$x+12;
								   $sel_query="SELECT * FROM drugs inner join timeline on timeline.DrugID=drugs.DrugID WHERE timeline.Date='$CDate' 
								   AND SUBSTRING(timeline.DrugTime,1,2)='$Time' AND timeline.UserID=$UserID;";
								   $result = mysqli_query($conn,$sel_query);
								   $cnt = $result->num_rows;
								   if($cnt==0)
								   {?>
								   <td align="center" style="border: 1px solid black;padding: 20px; background-color:#D7D7D7;"></td>
								   <?php
								   }
								   else
								   {
								   ?>
								   <td align="center" style="border: 1px solid black;padding: 20px; background-color:#90EE90;">
								   <?php
								   while($row = mysqli_fetch_assoc($result)) { ?>
								   <?php echo '<a href="DrugDetails.php?DrugID='.$row["DrugID"].'">'.$row["Drug_Name"].'</a><br>'; ?>
								   <?php } ?>
								  
								   
								   <?php $counter++; } }?>
								   </td>
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