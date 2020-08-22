	  <?php include 'inc/header.php' ?>

	<section id="content">
	<div class="container">
	<h1> GIVE YOUR ATTENDANCE</h1>
	

<?php
   $getInfo = $att->getactivation($userId);
   if ($getInfo) {
    while($data = $getInfo->fetch_assoc()){
      
  ?>
  <?php 
  if ($data['active'] == "1") {?>
  				<div class="row">
			
		<div class="skill-home"> <div class="skill-home-solid clearfix"> 
					<div class="row">
			<div class="col-md-12 text-center">
				<a href="I_am_in?userId = <?php echo $userId;?>"><button type="button" class="btn btn-lg btn-primary">I AM In</button></a>
			</div>

			</div> 
			<div class="row">
				<div class="col-md-12 text-center">
					<a href="I_am_out?userId = <?php echo $userId;?>"><button type="button" class="btn btn-lg btn-primary">I AM Out</button></a>
				</div>
			</div>
		
		
		</div> </div>
		</div> 
 <?php  }else{
 		echo "You Are Not Activated";
 	}?>




	 <?php } } ?>

	</div></section>
		  <?php include 'inc/footer.php' ?>