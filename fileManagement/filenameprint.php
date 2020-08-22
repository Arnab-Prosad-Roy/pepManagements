	  <?php include 'inc/header.php' ?>
 <?php include_once "../Classes/fileaccess.php";?>

 <?php
    $file = new Files(); 
    
?>
<?php
  if(isset($_GET['fileid']) && !empty($_GET['fileid']) AND isset($_GET['filenum']) && !empty($_GET['filenum'])){
        $id = $_GET['fileid'];
        $filenum = $_GET['filenum'];
     }
     ?> 
      <A HREF="javascript:window.print()">
      <!-- <span class=""><img src="img/print.png" style="width: 42px;margin-left: 60px;"></span> -->
      <button class="btn btn-success btn-sm">Print</button>
    </A> 
<page size="A4">
<div class="row" style="margin-left: 14px; margin-right:14px;">
	<div class="col-md-12">
		<?php 
      $getfile = $file->getFileNameById($id);
      if ($getfile) {
        while($rowdata = $getfile->fetch_assoc()){?>
  <div class="panel-body" style="border-bottom: 1px dashed;margin-top:50px;">
    
  <div id="adminForm">
        <?php 
          $static = '1800';
          $id = $rowdata['id'];
          $num = $static+$id;
        ?>
 <p><?php echo $fm->formDate($rowdata['createDate']);?></p> 
        <h4 style="text-align: center; font-weight: normal;">File ID: -<?php echo $num;?>&nbsp;&nbsp; ||&nbsp;&nbsp;Department :- <?php echo $rowdata['deptName'];?> </h4>    
       <p style="text-align: center;font-size: 28px;margin-bottom: 32px;"><?php echo $rowdata['filename']; ?></p>

  </div>   
    </div>
   <?php  } }?>
	</div>












</div>
</page>


	

	
</div>
<a href="#" class="scrollup"><i class="fa fa-angle-up active"></i></a>
<!-- javascript
    ================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="js/jquery.js"></script>
<script src="js/jquery.easing.1.3.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.fancybox.pack.js"></script>
<script src="js/jquery.fancybox-media.js"></script> 
<script src="js/portfolio/jquery.quicksand.js"></script>
<script src="js/portfolio/setting.js"></script>
<script src="js/jquery.flexslider.js"></script>
<script src="js/animate.js"></script>
<script src="js/custom.js"></script>
<script src="js/owl-carousel/owl.carousel-2.html"></script>
</body>

<!-- Mirrored from webthemez.com/demo/first-educational-free-html5-bootstrap-web-template/ by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 25 Jan 2018 07:07:44 GMT -->
</html>