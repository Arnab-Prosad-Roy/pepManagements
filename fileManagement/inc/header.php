<?php 
    include '../lib/Session.php' ;
     Session::init();
     include '../lib/Database.php';
     include '../helpers/Format.php';
     ?>
     <?php
    $login =Session::get("login");
    if ($login == false) {
      echo "<script>window.location='login'</script>";
    }
  ?>


<?php
$fm = new Format();
$userId = Session::get('userId');
$user = Session::get('uname');


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

<!-- css -->
<link href="css/bootstrap.min.css" rel="stylesheet" />
<link href="css/A4.css" rel="stylesheet" />
<link href="css/fancybox/jquery.fancybox.css" rel="stylesheet">
<link href="css/jcarousel.html" rel="stylesheet" />
<link href="css/flexslider.css" rel="stylesheet" />
<link href="js/owl-carousel/owl.carousel.html" rel="stylesheet">
<link href="css/style.css" rel="stylesheet" />
 
<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

</head>
<body>
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
                        <li><a href="createfile">Create File</a></li>
                        <li><a href="viewfile">View Files</a></li>
                       <li><a href="allfiles">All Files</a></li>
                       <!-- <li><a href="">Events</a></li> -->
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