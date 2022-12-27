<?php
session_start();
if(isset($_SESSION["Lang"]))
{}
else
{
$_SESSION["Lang"]="ENGLISH";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>

     <title>Medical Scheduler</title>
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


     <!-- HEADER -->
     <header>
          <div class="container">
               <div class="row">

                    <div class="col-md-4 col-sm-5">
                         <p> <?php if($_SESSION["Lang"]=="ENGLISH") {  ?>  Welcome to Health MED Scheduler<?php } ?>
						 <?php if($_SESSION["Lang"]=="ARABIC") {  ?> مرحبا بكم في جدول الصحة الطبية <?php } ?></p>
                    </div>
					 <div class="col-md-8 col-sm-7 text-align-right">
							 <span class="email-icon"><i class="fa fa-language"></i>
							 <a class="appointment-btn" href="Language.php?lang=ENGLISH">English</a>
							 </span>|
							 <span class="email-icon"><i class="fa fa-language"></i><a class="appointment-btn" href="Language.php?lang=ARABIC">عربى</a></span>|
                       
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
                    <a href="index.php" class="navbar-brand"><i class="fa fa-h-square"></i><?php if($_SESSION["Lang"]=="ENGLISH") {  ?>ealth MED Scheduler
						 <?php } ?>
						 <?php if($_SESSION["Lang"]=="ARABIC") {  ?> جدول الصحة الطبية<?php } ?></a>
               </div>

               <!-- MENU LINKS -->
               <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                         <li><a href="#top" class="smoothScroll">
						 <?php if($_SESSION["Lang"]=="ENGLISH") {  ?>Home
						 <?php } ?>
						 <?php if($_SESSION["Lang"]=="ARABIC") {  ?> الرئيسية<?php } ?>
								   
						 </a></li>
                         <li><a href="#about" class="smoothScroll">
						  <?php if($_SESSION["Lang"]=="ENGLISH") {  ?>About Us
						 <?php } ?>
						 <?php if($_SESSION["Lang"]=="ARABIC") {  ?> معلومات عنا<?php } ?>
						 </a></li>

                         <li class="appointment-btn"><a href="Login.php">
						 <?php if($_SESSION["Lang"]=="ENGLISH") {  ?>Login
						 <?php } ?>
						 <?php if($_SESSION["Lang"]=="ARABIC") {  ?> تسجيل الدخول<?php } ?>
						 </a></li>
                    </ul>
               </div>

          </div>
     </section>


     <!-- HOME -->
     <section id="home" class="slider" data-stellar-background-ratio="0.5">
          <div class="container">
               <div class="row">

                         <div class="owl-carousel owl-theme">
                              <div class="item item-second">
                                   <div class="caption">
                                        <div class="col-md-offset-1 col-md-10">
                                             <h3><?php if($_SESSION["Lang"]=="ENGLISH") {  ?>Your Health Benefits
						 <?php } ?>
						 <?php if($_SESSION["Lang"]=="ARABIC") {  ?>الفوائد الصحية الخاصة بك<?php } ?></h3>
                                             <h1>
											 <?php if($_SESSION["Lang"]=="ENGLISH") {  ?>New Lifestyle
						 <?php } ?>
						 <?php if($_SESSION["Lang"]=="ARABIC") {  ?>أسلوب حياة جديد<?php } ?>
											 </h1>
                                             <a href="#about" class="section-btn btn btn-default btn-gray smoothScroll">
											 <?php if($_SESSION["Lang"]=="ENGLISH") {  ?>More About Us
						 <?php } ?>
						 <?php if($_SESSION["Lang"]=="ARABIC") {  ?> المزيد عنا<?php } ?>
											 </a>
                                        </div>
                                   </div>
                              </div>
                         </div>

               </div>
          </div>
     </section>


     <!-- ABOUT -->
     <section id="about">
          <div class="container">
               <div class="row">

                    <div class="col-md-6 col-sm-6">
                         <div class="about-info">
                              <h2 class="wow fadeInUp" data-wow-delay="0.6s"> 
							  
							  <?php if($_SESSION["Lang"]=="ENGLISH") {  ?>Welcome to Your
						 <?php } ?>
						 <?php if($_SESSION["Lang"]=="ARABIC") {  ?>مرحبًا بك<?php } ?>
							  <i class="fa fa-h-square"></i>
							  
							   <?php if($_SESSION["Lang"]=="ENGLISH") {  ?>ealth MED Scheduler
						 <?php } ?>
						 <?php if($_SESSION["Lang"]=="ARABIC") {  ?>جدول الصحة الطبية<?php } ?>
							  </h2>
                              <div class="wow fadeInUp" data-wow-delay="0.8s">
                                   <p>
								   <?php if($_SESSION["Lang"]=="ENGLISH") {  ?>MedScheduler is designed to be your everyday healthy partner, to help you always stay on track with your meds.
						 <?php } ?>
						 <?php if($_SESSION["Lang"]=="ARABIC") {  ?>تم تصميم جدول الصحة الطبية ليكون شريكك الصحي اليومي، لمساعدتك على البقاء دائمًا على المسار الصحيح مع أدويتك<?php } ?>
								   </p>
                                   <p>
								   <?php if($_SESSION["Lang"]=="ENGLISH") {  ?>MedScheduler is created by a group of students for the purpose of helping elderly keep on track with their medications by organizing them as prescribed by their doctor's, and have them on the go without the need of carrying every medication to their appointments.
						 <?php } ?>
						 <?php if($_SESSION["Lang"]=="ARABIC") {  ?>تم إنشاء جدول الصحة الطبية من قبل مجموعة من الطلاب بغرض مساعدة كبار السن على متابعة أدويتهم من خلال تنظيمها على مايوصفه الطبيب، وجعلهم الذهاب لمراجعة المواعيد دون الحاجة إلى حملها<?php } ?>
								   </p>
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