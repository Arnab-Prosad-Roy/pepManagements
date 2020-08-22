<?php 
    include '../lib/Session.php' ;
  Session::init();
  $sessionTime = 365 * 24 * 60 * 60;
$sessionName = "my_session";
session_set_cookie_params($sessionTime);
session_name($sessionName);
// session_start();
   

if (isset($_COOKIE[$sessionName])) {
    setcookie($sessionName, $_COOKIE[$sessionName], time() + $sessionTime, "/");
}
?>
<?php
     include '../lib/Database.php';
     include '../helpers/Format.php';
     include '../Classes/attendence.php';
      include '../Classes/Intro.php';
      include '../Classes/Letter.php';
      include '../Classes/nocletter.php';
     ?>
     <?php
    $login =Session::get("login");
    if ($login == false) {
      echo "<script>window.location='login'</script>";
    }
  ?>
  <?php 
  $att = new Attendence();
   $intro = new Intro();
      $letter = new Letter();
       $nocletter = new nocletter();
  ?>



<?php 
  $dateTime = date_default_timezone_set('Asia/Dhaka');
  $serverIP = $_SERVER["REMOTE_ADDR"];
  $timestamp = time();
  $date = date("Y-m-d");
  $day = date("(D)");
  $time = date("H:i:s",$timestamp);
  $month = date('M');
  $cyear = date('Y');
?>


<?php
$userId = Session::get('userId');

// if(!isset($_GET['user']) && $_GET['user'] == NULL){
//   echo "<script>window.location = '../index'</script>";
// }else{
//   $userId = $_GET['user'];
// }
?>
<?php
  // $getInfo = $att->getapproveip();
  // if ($getInfo) {
  //   while($data = $getInfo->fetch_assoc()){
      
  ?>
    <?php 
      // if ($serverIP !== $data['ip']) {
      //   echo "<script>window.location = '404'</script>";
      //}?>
  <?php //} } ?>
<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from webthemez.com/demo/first-educational-free-html5-bootstrap-web-template/ by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 25 Jan 2018 07:07:27 GMT -->
<head>
<meta charset="utf-8">
<title>Kyoto Engineering & Automation Ltd.</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta name="description" content="" />
<link rel="shortcut icon" href="limages/favicon.png" />
<!-- css -->

<link href="css/bootstrap.min.css" rel="stylesheet" />
<link href="css/fancybox/jquery.fancybox.css" rel="stylesheet">
<link href="css/jcarousel.html" rel="stylesheet" />
<link href="css/flexslider.css" rel="stylesheet" />
<link href="js/owl-carousel/owl.carousel.html" rel="stylesheet">
<link href="css/style.css" rel="stylesheet" />
<link rel="stylesheet" href="css/A4.css"> 
      <link rel="stylesheet" href="css/A42.css">
        <link rel="stylesheet" href="css/A41.css">

<!-- script for loding page -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.js"></script>
<!-- script for loding page -->


<!---newsletter--->
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="//cdn.ckeditor.com/4.5.5/standard/ckeditor.js"></script> 
<script src="js/skill.bars.jquery.js"></script>
<script type="text/javascript">
tday=new Array("Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday");
tmonth=new Array("January","February","March","April","May","June","July","August","September","October","November","December");

function GetClock(){
var d=new Date();
var nday=d.getDay(),nmonth=d.getMonth(),ndate=d.getDate(),nyear=d.getFullYear();
var nhour=d.getHours(),nmin=d.getMinutes(),nsec=d.getSeconds(),ap;

if(nhour==0){ap=" AM";nhour=12;}
else if(nhour<12){ap=" AM";}
else if(nhour==12){ap=" PM";}
else if(nhour>12){ap=" PM";nhour-=12;}

if(nmin<=9) nmin="0"+nmin;
if(nsec<=9) nsec="0"+nsec;

document.getElementById('clockbox').innerHTML=""+tday[nday]+", "+tmonth[nmonth]+" "+ndate+", "+nyear+" || "+nhour+":"+nmin+":"+nsec+ap+"";
}

window.onload=function(){
GetClock();
setInterval(GetClock,1000);
}
</script>
<!---newsletter--->
 
<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
<style type="text/css">

</style>
<!-- style for loding page -->
<style type="text/css">
  .leave{
    background-color: #eee;
    width: 40%;
    margin-left: 29%;
    margin-right: 30%;
    padding: 15px 20px;
    border-radius: 7px;
    border: 1px solid #ddd3d3;
  }

@media (max-width: 336px) {
  .leave{
    background-color: #eee;
    border-radius: 7px;
    border: 1px solid #ddd3d3;
    width: 100%;
    margin: 0 auto;
  }
  .leave h2{
    font-size: 23px;
  }
}
  /* Paste this css to your style sheet file or under head tag */
/* This only works with JavaScript, 
if it's not present, don't show loader */
.no-js #loader { display: none;  }
.js #loader { display: block; position: absolute; left: 100px; top: 0; }
.se-pre-con {
  position: fixed;
  left: 0px;
  top: 0px;
  width: 100%;
  height: 100%;
  z-index: 9999;
  background: url(img/25.gif) center no-repeat #fff;
}
</style>
<!-- style for loding page -->
</head>
<!-- script for loding page -->
<script type="text/javascript">
  // Wait for window load
  $(window).load(function() {
    // Animate loader off screen
    $(".se-pre-con").fadeOut("slow");;
  });
</script>


<!-- script for loding page -->
</head>
<body>
<!-- script for loding page -->
<div class="se-pre-con"></div>
<!-- script for loding page -->

<div id="wrapper" class="home-page">
    <!-- start header -->
    <header>
        <div class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index"><img src="images/kyoto.png" alt="logo"/ style="width:145px;height:57px"></a>
                </div>
                <div class="navbar-collapse collapse ">

                    <ul class="nav navbar-nav">
                        <li class="active"><a href="index">Home</a></li> 
                        <li><a href="profile">Edit Profile</a></li>
                       <!-- <li><a href="">Events</a></li> -->
                             <li class="nav-item dropdown">
                              <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown">
                                Request For
                              </a>
                              <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" style="padding: 5px 15px;" href="lateApproval">Late Comming Approval</a>
                                <a class="dropdown-item" style="padding: 5px 15px;" href="errandApproval">Errand Approval</a>
                                <a class="dropdown-item" style="padding: 5px 15px;" href="#">Leave Approval</a>
                              </div>
                            </li>
                         <?php
                                if (isset($_GET['action']) && $_GET['action'] == "logout") {
                                    Session::destroy();                               
                                     }
                            ?>
                        <li><a href="?action=logout">Sign Out</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </header>