<section id="content">
	
	
	<div class="container">
	    		 <div class="row">
		 <?php //echo date( 'Y-m-j' , strtotime('4 weekdays') );?>
		 	<div class="col-md-6 text-center">
		 		<?php
		 			$getTime = $att->getDefultTime($userId);
		 			if ($getTime) {
		 				while ($data = $getTime->fetch_assoc()) {?>
		 				<h3>
		 				Your Office Cheack In Time  :- <?php echo $data['defultInTime'];?><br/>
		 					Your Office Cheack Out Time :- <?php echo $data['defultOuttime'];?>
		 					</h3>
		 				<?php } } ?>
		 	</div>
		 </div>
			<div class="row">
		<div class="skill-home"> <div class="skill-home-solid clearfix"> 
		<div class="col-md-3 text-center"><a href="dailyAttendance">
		<span class="icons c1"><i class="fa fa-trophy"></i></span> <div class="box-area">
		<h3>Attendance</h3> <p>Give Your Attendance</p></div></a>
		</div>
		<div class="col-md-3 text-center"><a href="Leaverequest">
		<span class="icons c2"><i class="fa fa-picture-o"></i></span> <div class="box-area">
		<h3>Leave Request</h3> <p>Leave Request Here</p></div></a>
		</div>
		<div disabled="disabled" class="col-md-3 text-center"><a href="https://www.people.keal.com.bd/attendance/profile">
		<span class="icons c1"><i class="fa fa-trophy"></i></span> <div class="box-area">
		<h3>Edit Profile</h3> <p>Set Your Information</p></div></a>
		</div>
		<div class="col-md-3 text-center"> 
		<span class="icons c4"><i class="fa fa-globe"></i></span> <div class="box-area">
		<h3>Notice Board</h3> <p>Find Notice Here</p>
		</div></div>
		</div></div>
		</div> 
		
			<div class="row">
				<div class="skill-home"> 
					<div class="skill-home-solid clearfix"> 
						<div class="col-md-3 text-center"><a href="generate_certificate">
						<span class="icons c1"><i class="fa fa-certificate"></i></span> <div class="box-area">
						<h3>Certificate</h3> <p>Request for Certificate</p></div></a>
						</div>
						<!-- <div class="col-md-3 text-center"><a href="Leaverequest">
						<span class="icons c2"><i class="fa fa-picture-o"></i></span> <div class="box-area">
						<h3>Leave Request</h3> <p>Leave Request Here</p></div></a>
						</div> -->
						<!-- <div class="col-md-3 text-center"> 
						<a href="claimrequest">
						<span class="icons c3"><i class="fa fa-desktop"></i></span> <div class="box-area">
						<h3>Personal Claim</h3> <p>Find Personal Claim Here</p></div></a>
						</div> -->
						<!-- <div class="col-md-3 text-center"> 
						<span class="icons c4"><i class="fa fa-globe"></i></span> <div class="box-area">
						<h3>Notice Board</h3> <p>Find Notice Here</p>
						</div>
						</div> -->
					</div>
				</div>
		    </div> 
	 

	</div>
	</section>