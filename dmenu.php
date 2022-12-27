<?php
session_start();
if(isset($_SESSION["Lang"]))
{}
else
{
$_SESSION["Lang"]="ENGLISH";
}
?>
<!-- HEADER -->
     <header>
          <div class="container">
               <div class="row">

                    <div class="col-md-4 col-sm-5">
                         <p><?php echo $username;?>, <?php if($_SESSION["Lang"]=="ENGLISH") {  ?>  Welcome to Health MED Scheduler<?php } ?>
						 <?php if($_SESSION["Lang"]=="ARABIC") {  ?> مرحبا بكم في جدول الصحة الطبية <?php } ?></p>
                    </div>
                         <div class="col-md-8 col-sm-7 text-align-right">
							 <span class="email-icon"><i class="fa fa-language"></i>
							 <a class="appointment-btn" href="Language.php?lang=ENGLISH">English</a>
							 </span>|
							 <span class="email-icon"><i class="fa fa-language"></i><a class="appointment-btn" href="Language.php?lang=ARABIC">عربى</a></span>|
                       
                    </div>

               </div>
          </div>
     </header>


     <!-- MENU -->
     <section class="navbar navbar-default navbar-static-top" role="navigation">
          <div class="container">

               <div class="navbar-header">
                    <button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                         <span class="icon icon-bar"></span>
                         <span class="icon icon-bar"></span>
                         <span class="icon icon-bar"></span>
                    </button>

                    <!-- lOGO TEXT HERE -->
                    <a href="DoctorHome.php" class="navbar-brand"><i class="fa fa-h-square"></i><?php if($_SESSION["Lang"]=="ENGLISH") {  ?>ealth MED Scheduler<?php } ?>
						 <?php if($_SESSION["Lang"]=="ARABIC") {  ?> الجدول الزمني الطبي الصحي <?php } ?>
					</a>
               </div>

               <!-- MENU LINKS -->
               <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                         <li><a href="DoctorHome.php" class="smoothScroll">
						 <?php if($_SESSION["Lang"]=="ENGLISH") {  ?>Home
						 <?php } ?>
						 <?php if($_SESSION["Lang"]=="ARABIC") {  ?> الصفحة الأمامية<?php } ?>
						 </a></li>
                         <li><a href="DoctorPatients.php" class="smoothScroll">
						 <?php if($_SESSION["Lang"]=="ENGLISH") {  ?>Patients
						 <?php } ?>
						 <?php if($_SESSION["Lang"]=="ARABIC") {  ?> مرضى<?php } ?>
						 </a></li>
                         <li><a href="DPrescriptions.php" class="smoothScroll">
						  <?php if($_SESSION["Lang"]=="ENGLISH") {  ?>Prescriptions
						 <?php } ?>
						 <?php if($_SESSION["Lang"]=="ARABIC") {  ?> الوصفات الطبية<?php } ?>
						 </a></li>                         
                         <li class="appointment-btn"><a href="Logout.php">
						 <?php if($_SESSION["Lang"]=="ENGLISH") {  ?>Logout
						 <?php } ?>
						 <?php if($_SESSION["Lang"]=="ARABIC") {  ?> خروج<?php } ?>
						 </a></li>
                    </ul>
               </div>

          </div>
     </section>