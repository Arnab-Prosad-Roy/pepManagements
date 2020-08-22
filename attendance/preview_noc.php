 <?php include 'inc/header.php' ?>


 <style>
 @media print{
  .disbtn button{
    display:none;
  }
 }
 </style>
<?php
    $nocletter = new nocletter();
    $fm  = new Format();
    $db = new Database();
?>
<?php 
    if (isset($_GET['id']) && !empty($_GET['id']) AND isset($_GET['tid']) && !empty($_GET['tid']) ) {
      $uId = $_GET['id'];
      $salaryId = $_GET['tid'];

    }
 ?>
 

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1><center>
      
       </center>
   <?php
      /*if (isset($hrrefInsert)) {
        echo $hrrefInsert;
      }*/
   ?>
      </h1>
     
    <div class="container">

<?php
  /*$promotionData = $nocletter->getPromotionData();*/
?>
      <page size="A41">
      <div style="font-family: 'Roboto', sans-serif">

      


 


        <div style="padding-left: 70px;padding-top: 20px;padding-right: 80px;">
          <div class="row">
            <div style="width: 550px;float: left;">




               
            

             <h1 style="margin-top:-10px;font-size: 28px;">NO OBJECTION CERTIFICATE</h1><br>
             
            </div>
        </div> 
<?php
    $getPersonal = $nocletter->getPersonalData($uId);
    if ($getPersonal) {
      $rw_per = $getPersonal->fetch_assoc();

      $fName = $rw_per['fName'];
       $passport = $rw_per['passport'];
     
    }
?>
<?php
    $getPersonals = $nocletter->getPersonalData($uId);
    if ($getPersonals) {
      $rw_pers = $getPersonals->fetch_assoc();

      $mName = $rw_pers['mName'];
     
    }
?>

<?php
    $getP = $nocletter->getimageData($uId);
    if ($getP) {
      $rw_p = $getP->fetch_assoc();

      $image = $rw_p['image'];
     
    }
?>

<?php
    $getE = $nocletter->getemployee($uId);
    if ($getE) {
      $rw_E = $getE->fetch_assoc();

      $userName = $rw_E['user'];
     
    }
?>
<?php
    $dept = $nocletter->getDeptData($uId);
    if ($dept) {
      $rw_dept = $dept->fetch_assoc();

      $deptName = $rw_dept['deptName'];
      $designation = $rw_dept['designation'];
      $sigrade = $rw_dept['grade'];
    }
?>

<?php
    $si = $nocletter->getGratefromSI($sigrade);
    if ($si) {
      $rw_si = $si->fetch_assoc();

     
      $grade = $rw_si['grade'];
    }
?>
<?php
    $since = $nocletter->getSinceData($uId);
    if ($since) {
      $rw_since = $since->fetch_assoc();

      $datee = $rw_since['datee'];
    }
?>
<?php
    $getPersonals = $nocletter->getPersonalData($uId);
    if ($getPersonals) {
      $rw_pers = $getPersonals->fetch_assoc();

      $gen = $rw_pers['gender'];
     
    }
?>
        <div class="row">
          
            <div style="width: 650px;float: left;">
              <p style="margin-top: -20px;text-align: justify;">We are pleased to confirm that <span style="color: red;"><?php echo $userName; ?></span>, <?php if($gen == 'male'){echo "son";}else{echo "daughter";} ?> of <span style="color: red;"><?php echo $fName; ?> (father)</span> and <span style="color: red;"><?php echo $mName; ?> (mother)</span>, is an incumbent with good reputation in the <span style="font-weight:bold;"><?php echo $deptName; ?></span> department of ours since <b><?php echo $fm->formDate($datee); ?></b></p>
            
      
      <?php if ($noteone) { ?>

       <p style="text-align: justify;"><?php echo $noteone; ?></p>
       <?php } ?>



            <p>We also confirm the following details for quick reference according to our record:</p>
          </div>
        </div>
      <div class="row">
        <div style="width: 450px;float: left;margin-bottom:8px;">
        <table>
          <tr>
            <th style="font-weight: normal;font-size: 12px;border-right:1px solid black;">Name of Employee</th>
            <td style="color: red;font-weight: bold;padding: 6px;font-size: 12px;"><?php echo $userName; ?></td>
          </tr>
          <tr>
             <th style="font-weight: normal;font-size: 12px;border-right:1px solid black;">Father</th>
             <td style="color: red;font-weight: bold;padding: 6px;font-size: 12px;"><?php echo $fName; ?></td>
          </tr>
           <tr>
             <th style="font-weight: normal;font-size: 12px;border-right:1px solid black;">Mother</th>
             <td style="color: red;font-weight: bold;padding: 6px;font-size: 12px;"><?php echo $mName; ?></td>
          </tr>
          <tr>
             <th style="font-weight: normal;font-size: 12px;border-right:1px solid black;">Domicile on Record</th>
             <td style="color: red;font-weight: bold;padding: 6px;font-size: 12px;">
               <?php
              $getadd = $nocletter->getpermanentuseraddressBy($uId);
              if ($getadd) {
                while ($data = $getadd->fetch_assoc()) {
               
            ?>
            <?php
              $flat= $data['flat']; 
              $holding = $data['holding']; 
              $building =   $data['building']; 
               $road =   $data['road']; 
                $block =$data['block']; 
                $area =  $data['area']; 
               
                 $distName= $data['distName'];
                 $thName= $data['thName'];
                 $postName= $data['postName'];
                 $postCode= $data['postCode'];
                  ?>
             <?php if($building){echo $building.', ';}?><?php if($holding){echo 'Holding# '.$holding.', ';}?><?php if($flat){echo 'Flat-'.$flat.', ';}?><?php if($road){echo ' Road# '.$road.', ';}?><?php if($block){echo 'Block-'.$block.', ';}?><?php if($area){echo $area.', ';}?><?php if($thName){echo 'P/S- '.$thName.', ';}?><?php if($postName){echo 'P/O- '.$postName.', ';}?><?php if($distName){echo $distName.'-';}?><?php if($postCode){echo $postCode;}?>, Bangladesh
            <?php } } ?>
             </td>
          </tr>
          
          <tr>
             <th style="font-weight: normal;font-size: 12px;border-right:1px solid black;">Present Address</th>
             <td style="color: red;font-weight: bold;padding: 6px;font-size: 12px;">
                <?php
    $getPadd = $nocletter->getpresentaddData($uId,$id);
    if ($getPadd) {
      $rw_per = $getPadd->fetch_assoc();

      $pflat = $rw_per['flat'];
     $psuit = $rw_per['suit'];
     $plevel = $rw_per['level'];
     $pfloor = $rw_per['floor'];
     $pholding = $rw_per['holding'];
     $pbuilding = $rw_per['building'];
     $proadName = $rw_per['roadName'];
     $proad = $rw_per['road'];
     $pblock = $rw_per['block'];
     $psector = $rw_per['sector'];
     $pzone = $rw_per['zone'];
     $psection = $rw_per['section'];
     $parea = $rw_per['area'];
     $pvillage = $rw_per['village'];
     $pdivId = $rw_per['division'];
     $pdistId = $rw_per['district'];
     $pthId = $rw_per['thana'];
     $ppostId = $rw_per['postoffice'];
     $pdivName = $rw_per['divName'];
     $pdistName = $rw_per['distName'];
     $pthName = $rw_per['thName'];
     $ppostName = $rw_per['postName'];
     $ppostCode = $rw_per['postCode'];
     
     
    }
?>
  
  
              
              <?php if($pbuilding){echo $pbuilding.' ';}?><?php if($pholding){echo 'Holding# '.$pholding.' ';}?><?php if($pflat){echo 'Flat-'.$pflat.' ';}?><?php if($psuit){echo $psuit.' ';}?>
               <?php if($plevel){echo 'Level-'.$plevel.' ';}?><?php if($pfloor){echo $pfloor.' Fl';}?>
               
               <?php if($proadName){echo $proadName.' ';} ?><?php if($proad){echo ' Road# '.$proad.' ';}?><?php if($pblock){echo 'Block-'.$pblock.' ';}?><?php if($psector){echo 'Sector#'.$psector.' ';}?><?php if($pzone){echo 'Zone#'.$pzone.' ';}?><?php if($psection){echo 'Section#'.$psection;}?><?php if($parea){echo $parea.' ';}?>
               <?php if($pthName){echo 'P/S- '.$pthName.' ';}?><?php if($ppostId){echo 'P/O- '.$ppostName.' ';}?>
               <?php if($pdistName){echo $pdistName.'-';}?><?php if($ppostCode){echo $ppostCode;}?>, Bangladesh

             </td>
          </tr>
          
          
          <tr>
            <th style="font-weight: normal;font-size: 12px;border-right:1px solid black;"> Designation</th>
            <td style="color: red;font-weight: bold;padding: 6px;font-size: 12px;"><?php echo $designation; ?></td>
          </tr>
          <tr>
            <th style="font-weight: normal;font-size: 12px;border-right:1px solid black;">Employment Type</th>
            <td style="color: red;font-weight: bold;padding: 6px;font-size: 12px;">Full Time</td>
          </tr>
          <tr>
            <th style="font-weight: normal;font-size: 12px;border-right:1px solid black;">Grade</th>
            <td style="color: red;font-weight: bold;padding: 6px;font-size: 12px;"><?php echo $grade; ?></td>
          </tr>
          
           <?php  if($passport!=""){ ?>
          <tr>
            <th style="font-weight: normal;font-size: 12px;border-right:1px solid black;">Passport Number</th>
            <td style="color: red;font-weight: bold;padding: 6px;font-size: 12px;"><?php echo $passport; ?></td>
          </tr>
          <?php } ?>
        </table>
          
        </div>
        <div style="width: 200px;float: left;margin-top: 1px;padding-left: 52px;">
          <img src="../<?php echo $image; ?>" style="width: 95px;height: auto; border-radius: 55%;">
          <h6>Photo of <?php echo $userName ?> </h6>
        </div>
      </div>
<?php if($salaryId == '1'){ ?>
      <div class="row">
        <div class="col-md-12">
            <p style="text-align: center;font-size:16px;color: red;text-decoration: underline;text-underline-position: under">Monthly Take Home and Compensation Details</p>
             <table class="table" style="margin-top: -18px;margin-bottom: -8px;">
              <thead>
                <tr>
                  <th>Basic Amount</th>
                  <th>House Rent</th>
                  <th>Medical</th>
                  <th>Transport Allowance</th>
                  <th>Deduction Method</th>
        <th>Deduction Amount</th>
        <th>(A) Take Home </th>
                 
                </tr>
              </thead>
              <tbody>
<?php
    $comp = $nocletter->getCompensationData($grade);
    if ($comp) {
      while ($rw_comp = $comp->fetch_assoc()) {
        
?>
<?php $totalgross =  $rw_comp['total'];  ?>
                <tr>
                  <td><?php echo $rw_comp['basicAmmount']; ?></td>
                  <td><?php echo $rw_comp['houserentAmmount']; ?></td>
                  <td><?php echo $rw_comp['medical']; ?></td>
                  <td><?php echo $rw_comp['transportAllowance']; ?></td>
                                 <?php
        $deduct = $nocletter->userselect($uId);
        if($deduct){
          while($user= $deduct->fetch_assoc()){?>
          <?php  $deductType= $user['deductType'];
          if ($deductType =='1') { ?>
            
          
        <?php
        $deduct = $nocletter->userselect($uId);
        if($deduct){
          while($user= $deduct->fetch_assoc()){?>
          <?php  $valueType= $user['valueType'];?>
         <td><?php if($valueType=='1'){
          echo "By Percentage";
         } elseif($valueType=='2'){
            echo "By EMI";
         }
         ?></td>
         <?php if($valueType=='1'){?>
        <td><?php 
        $calAmount = $user['calAmount'];
        echo $user['calAmount'];?></td>
        <?php } else { ?>
        <td><?php 
        $fixedAmount = $user['fixedAmount'];
        echo $user['fixedAmount'];?></td>
        <?php } ?>
        <?php } } else {?>
         <td></td>
        <td></td>
        <?php } ?>
       <?php  //$totalgross =  $grossdata['total']; ?>
         <?php
        $deduct = $nocletter->userselect($uId);
        if($deduct){
          while($user= $deduct->fetch_assoc()){?>

        <td><?php 
        
           if($valueType=='1'){
           $totalgross=$totalgross - $calAmount;
           } elseif($valueType=='2'){ 
             $totalgross=$totalgross - $fixedAmount;
            } ?>

       <?php  echo  $totalgross?></td>
       <?php } } else {?>
       <td>
       
       <?php  echo  $totalgross;?></td>
       <?php } ?>
      </tr>
      <?php } elseif($deductType=='2'){ ?>
       <?php
        $deduct = $nocletter->userselect($uId);
        if($deduct){
          while($user= $deduct->fetch_assoc()){?>
          <?php  $valueType= $user['valueType'];?>
          <?php  $endDatee= $user['endDate'];?>
          <?php  //$ye= $fm->formyear($user['endDate']);?>
          <?php  //$mn= $fm->formMonthname($user['endDate']);?>
          <?php  $endDate= $fm->formDate($user['endDate']);?>
       

<?php if($date <= $endDate) {?>
         <td><?php if($valueType=='1'){
          echo "By Percentage";
         } elseif($valueType=='2'){
            echo "By EMI";
         }
         ?></td>
         <?php if($valueType=='1'){?>
        <td><?php 
        $calAmount = $user['calAmount'];
        echo $user['calAmount'];?></td>
        <?php } else { ?>
        <td><?php 
        $fixedAmount = $user['fixedAmount'];
        echo $user['fixedAmount'];?></td>
        <?php } ?>
        <?php } else{ ?>
        <td></td>
         <td></td>
       

         <?php  } } } else {?>
         <td></td>
        <td></td>
        <?php } ?>
        <?php  $totalgross =  $rw_comp['total']; ?>
         <?php
        $deduct = $nocletter->userselect($uId);
        if($deduct){
          while($user= $deduct->fetch_assoc()){?>
<?php  $endDatee= $user['endDate'];?>
<?php if($years <= $ye AND $mo <=$mn) {?>
        <td><?php 
        $calAmount = $user['calAmount'];
           if($valueType=='1'){
           $totalgross=$totalgross - $calAmount;
           } elseif($valueType=='2'){ 
             $totalgross=$totalgross - $fixedAmount;
            } ?>
        <?php  echo  $totalgross?></td>
        <?php } else { ?>
          <td> <?php  echo  $totalgross?></td>
         <?php  } ?>
        <?php } } ?>
    <?php   }  
      } ?>
      <?php } else { ?>
  <td>0</td>
        <td>0</td>
        <td><?php  echo  $totalgross?></td>
       <?php }  ?>
                </tr>
    <?php } } ?>
              </tbody>
            </table><br>

        </div>
      </div>
      <?php } ?>
     

   

        
 
          
          
                  
        </div>
        
          
        </div>
      </div>
      </page>

      
    </div>
    <a href="create_general_noc.php">
<button type="button" class="btn btn-primary" style="float:right;margin-right: 280px;margin-top: -16px;">Proceed</button>
    </a>

    <!-- Main content -->
   
    <!--/.content -->
  </div> 
  <!-- /.content-wrapper -->


  <!-- Control Sidebar -->

  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
 
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="bower_components/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->
<script src="bower_components/raphael/raphael.min.js"></script>
<script src="bower_components/morris.js/morris.min.js"></script>
<!-- Sparkline -->
<script src="bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="bower_components/moment/min/moment.min.js"></script>
<script src="bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
</body>
</html>


    

  
