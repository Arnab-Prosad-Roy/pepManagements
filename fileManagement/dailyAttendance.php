	  <?php include 'inc/header.php' ?>

	<section id="content">
	<div class="container">
	<h1> GIVE YOUR ATTENDANCE</h1>
	

<?php
   $getInfo = $att->getactivation($userId);
   if ($getInfo) {
    while($data = $getInfo->fetch_assoc()){
      
  ?>

  				<div class="row">
			
		<div class="skill-home"> <div class="skill-home-solid clearfix"> 
					<div class="row">
			<div class="col-md-12 text-center">
				<a href="createfile?userId = <?php echo $userId;?>"><button type="button" class="btn btn-lg btn-primary">Create File Name</button></a>
			</div>

			</div> 
			<div class="row">
				<div class="col-md-12 text-center">
					<a href="viewfile?userId = <?php echo $userId;?>"><button type="button" class="btn btn-lg btn-primary">View File</button></a>
				</div>
			</div>
		
		
		</div> </div>
		</div> 




	 <?php } } ?>

	</div></section>
		  <?php include 'inc/footer.php' ?>