<?php include_once "lib/Database.php"; ?>
<?php include_once "../helpers/Format.php"; ?>
<?php include_once "lib/Session.php"; ?>

<?php
	/**
	* 
	*/
	class Attendence
	{
		private $db;
		private $fm;

		public function __construct()
	
		{
			$this->db = new Database();
			$this->fm = new Format();
		}
		

		public function markAttendence($data,  $userId, $serverIP, $date, $day, $time, $month){


			
			$late_reason 	= $this->fm->validation($data['late_reason']);
			$original_time  = $this->fm->validation($data['original_time']);
			$errand_place_in = $this->fm->validation($data['errand_place_in']);
			$errand_for_in = $this->fm->validation($data['errand_for_in']);
			$errand_from_in = $this->fm->validation($data['errand_from_in']);
			$errand_to_in = $this->fm->validation($data['errand_to_in']);

			$late_reason = mysqli_real_escape_string($this->db->link, $late_reason);
			$original_time = mysqli_real_escape_string($this->db->link, $original_time);
			$errand_place_in = mysqli_real_escape_string($this->db->link, $errand_place_in);
			$errand_for_in = mysqli_real_escape_string($this->db->link, $errand_for_in);
			$errand_from_in = mysqli_real_escape_string($this->db->link, $errand_from_in);
			$errand_to_in = mysqli_real_escape_string($this->db->link, $errand_to_in);
			
			$intime = $this->fm->formatTime($time);
	//select mail address
	
		$squery = "SELECT * FROM tbl_user_reg WHERE regId = '$userId'";
		$getData = $this->db->select($squery);
		if ($getData) {
			while ($res = $getData->fetch_assoc()) {
				$email = $res['email'];
				$name = $res['userName'];
				
			}
		}
		$query = "SELECT * FROM tbl_employee WHERE userId = '$userId'";
		$getData = $this->db->select($query);
		if ($getData) {
			while ($reslt = $getData->fetch_assoc()) {
				$name = $reslt['user'];
				$id = $reslt['id'];
			}
		}


		$query = "SELECT p.*, e.userName FROM tbl_attendence as p, tbl_user_reg as e WHERE  p.userId = e.regId AND attendence_date = '$date' AND p.userId = '$userId'";
      	  $result = $this->db->select($query);
      	  if ($result) {
      	  	while($sort = $result->fetch_assoc()){
      	  		$user = $sort['userName'];
      	  		$eId  = $sort['eId'];
      	  	}
      	  }

		$queryl = "SELECT * FROM employee WHERE userId = '$userId'";
		$getDatal = $this->db->select($queryl);
		if ($getDatal) {
			while ($resltl = $getDatal->fetch_assoc()) {
				$locationid = $resltl['locationid'];
			}
		}

        $queryln = "SELECT * FROM tbl_location WHERE id = '$locationid'";
		$getDatal = $this->db->select($queryln);
		if ($getDataln) {
			while ($resltln = $getDataln->fetch_assoc()) {
				$location_name = $resltln['location_name'];
			}
		}
      	  
 		$Equery = "SELECT p.*, e.userName FROM tbl_employee as p, tbl_user_reg as e WHERE  p.userId = e.regId AND p.userId = '$userId'";
      	  $result = $this->db->select($query);
      	  if ($result) {
      	  	while($sort = $result->fetch_assoc()){
      	  		$userName = $sort['userName'];
      	  		$id  = $sort['id'];
      	  	}
      	  }     	  

      	  //check whether its checked in or not
		$squery = "SELECT * FROM tbl_attendence WHERE userId = '$userId' AND attendence_date = '$date'";
		$getData = $this->db->select($squery);
		if ($getData) {
			?>
			<script>var my_time = new Date(); alert('You are already checkd in...'+my_time);
                        window.location = 'dailyAttendance';
                        </script>
			<?php
		}else{
			$query = "INSERT INTO tbl_attendence(userId, eId, late_reason, original_time, errand_place_in, errand_for_in, errand_from_in, errand_to_in, attendence_time, day, attendence_date, month, inip, status, name, locat) VALUES('$userId', '$id','$late_reason', '$original_time', '$errand_place_in', '$errand_for_in', '$errand_from_in', '$errand_to_in', '$time', '$day', '$date', '$month', '$serverIP', '1', '$name', '$locationid')";
			$insert_row = $this->db->insert($query);
				if ($insert_row) {
        			?>
        			<script>var my_time = new Date(); alert('Attendance Taken at '+my_time);
                                window.location = 'dailyAttendance';
                                </script>
        			<?php


							$headers = 'From: '.$email."\r\n".
							 
							'Reply-To: '.$email."\r\n" .
							 
							'X-Mailer: PHP/' . phpversion();

							$email_to = "hr@keal.com.bd";
							$email_subject= "$date Dailly Attendence";
							$email_message= "
Employee Name = $name
Employee Id = $userId
Date = $date
Day  = $day
Attendance Time = $intime
Late_reason = $late_reason
Original_time = $original_time
Errand_place_in = $errand_place_in
Errand_for_in = $errand_for_in
Errand_from_in = $errand_from_in
Errand_to_in = $errand_to_in
Location = $location_name
ServerIP = $serverIP
Checked In";

							


							$headers1 = 'From: '.$email_to."\r\n".
							 
							'Reply-To: '.$email_to."\r\n" .
							 
							'X-Mailer: PHP/' . phpversion();

							$email_subject1= "$date Dailly Attendence";
							$email_message1= "
Employee Name = $name
Employee Id = $eId $user $userId
Date = $date
Day  = $day
Late_reason = $late_reason
Original_time = $original_time
Errand_place_in = $errand_place_in
Errand_for_in = $errand_for_in
Errand_from_in = $errand_from_in
Errand_to_in = $errand_to_in
Location = $location_name
ServerIP = $serverIP
Checked In";

							 
							$email_message2= 'Date'.$date."\r\n";
							mail("<$email_to>","$email_subject","$email_message","$headers");

							mail("<$email>","$email_subject1","$email_message1","$headers1");
						
				}else{
					$msg = "<span style='color:red;'>You are not successfully</span>";
					return $msg;
				}
		}

	}
//hr mark attendance
		public function hrmarkgiveAttendence($data,  $userId, $serverIP, $date, $day, $time, $month){


			
			$late_reason 	= $this->fm->validation($data['late_reason']);
			$original_time  = $this->fm->validation($data['original_time']);
			$errand_place_in = $this->fm->validation($data['errand_place_in']);
			$errand_for_in = $this->fm->validation($data['errand_for_in']);
			$errand_from_in = $this->fm->validation($data['errand_from_in']);
			$errand_to_in = $this->fm->validation($data['errand_to_in']);
			$attendancedate = $this->fm->validation($data['attendancedate']);

			$late_reason = mysqli_real_escape_string($this->db->link, $late_reason);
			$original_time = mysqli_real_escape_string($this->db->link, $original_time);
			$errand_place_in = mysqli_real_escape_string($this->db->link, $errand_place_in);
			$errand_for_in = mysqli_real_escape_string($this->db->link, $errand_for_in);
			$errand_from_in = mysqli_real_escape_string($this->db->link, $errand_from_in);
			$errand_to_in = mysqli_real_escape_string($this->db->link, $errand_to_in);
			$attendancedate = mysqli_real_escape_string($this->db->link, $attendancedate);

			$intime = $this->fm->formatTime($time);
	//select mail address
	
		$squery = "SELECT * FROM tbl_user_reg WHERE regId = '$userId'";
		$getData = $this->db->select($squery);
		if ($getData) {
			while ($res = $getData->fetch_assoc()) {
				$email = $res['email'];
				$name = $res['userName'];
				
			}
		}
		$query = "SELECT * FROM tbl_employee WHERE userId = '$userId'";
		$getData = $this->db->select($query);
		if ($getData) {
			while ($reslt = $getData->fetch_assoc()) {
				$name = $reslt['user'];
				$id = $reslt['id'];
			}
		}


		$query = "SELECT p.*, e.userName FROM tbl_attendence as p, tbl_user_reg as e WHERE  p.userId = e.regId AND attendence_date = '$attendancedate' AND p.userId = '$userId'";
      	  $result = $this->db->select($query);
      	  if ($result) {
      	  	while($sort = $result->fetch_assoc()){
      	  		$user = $sort['userName'];
      	  		$eId  = $sort['eId'];
      	  	}
      	  }
      	  
 		$Equery = "SELECT p.*, e.userName FROM tbl_employee as p, tbl_user_reg as e WHERE  p.userId = e.regId AND p.userId = '$userId'";
      	  $result = $this->db->select($query);
      	  if ($result) {
      	  	while($sort = $result->fetch_assoc()){
      	  		$userName = $sort['userName'];
      	  		$id  = $sort['id'];
      	  	}
      	  }     	  

      	  //check whether its checked in or not
		$squery = "SELECT * FROM tbl_attendence WHERE userId = '$userId' AND attendence_date = '$attendancedate'";
		$getData = $this->db->select($squery);
		if ($getData) {
			?>
			<script>var my_time = new Date(); alert('You are already checkd in...'+my_time);
                        window.location = 'attend_page';
                        </script>
			<?php
		}else{
			$query = "INSERT INTO tbl_attendence(userId, eId, late_reason, original_time, errand_place_in, errand_for_in, errand_from_in, errand_to_in, attendence_time, day, attendence_date, month, inip, status, name) VALUES('$userId', '$id','$late_reason', '$original_time', '$errand_place_in', '$errand_for_in', '$errand_from_in', '$errand_to_in', '$time', '$day', '$attendancedate', '$month', '$serverIP', '1', '$name')";
			$insert_row = $this->db->insert($query);
				if ($insert_row) {
        			?>
        			<script>var my_time = new Date(); alert('Attendance Taken at '+my_time);
                                window.location = 'give_attend';
                                </script>
        			<?php


							$headers = 'From: '.$email."\r\n".
							 
							'Reply-To: '.$email."\r\n" .
							 
							'X-Mailer: PHP/' . phpversion();

							$email_to = "hr@keal.com.bd";
							$email_subject= "$attendancedate Dailly Attendence";
							$email_message= "
Employee Name = $name
Employee Id = $userId
Date = $attendancedate
Day  = $day
Attendance Time = $intime
Late_reason = $late_reason
Original_time = $original_time
Errand_place_in = $errand_place_in
Errand_for_in = $errand_for_in
Errand_from_in = $errand_from_in
Errand_to_in = $errand_to_in
ServerIP = $serverIP
Checked In";

							


							$headers1 = 'From: '.$email_to."\r\n".
							 
							'Reply-To: '.$email_to."\r\n" .
							 
							'X-Mailer: PHP/' . phpversion();

							$email_subject1= "$attendancedate Dailly Attendence";
							$email_message1= "
Employee Name = $name
Employee Id = $eId $user $userId
Date = $attendancedate
Day  = $day
Late_reason = $late_reason
Original_time = $original_time
Errand_place_in = $errand_place_in
Errand_for_in = $errand_for_in
Errand_from_in = $errand_from_in
Errand_to_in = $errand_to_in
ServerIP = $serverIP
Checked In";

							 
							$email_message2= 'Date'.$date."\r\n";
							mail("<$email_to>","$email_subject","$email_message","$headers");

							mail("<$email>","$email_subject1","$email_message1","$headers1");
						
				}else{
					$msg = "<span style='color:red;'>You are not successfully</span>";
					return $msg;
				}
		}

	}
//hr mark attendance	
//admin give attendance starts
public function markinAttendence($data, $userId, $serverIP, $date, $day, $month){
	    
	    $time = mysqli_real_escape_string($this->db->link, $data['defultInTime']);
	 
	    $squery = "SELECT * FROM tbl_user_reg WHERE regId = '$userId'";
		$getData = $this->db->select($squery);
		if ($getData) {
			while ($res = $getData->fetch_assoc()) {
				$email = $res['email'];
				$name = $res['userName'];
				
			}
		}
		
		$query = "SELECT * FROM tbl_employee WHERE userId = '$userId'";
		$getData = $this->db->select($query);
		if ($getData) {
			while ($reslt = $getData->fetch_assoc()) {
				$name = $reslt['user'];
				$id = $reslt['id'];
			}
		}


		$query = "SELECT p.*, e.userName FROM tbl_attendence as p, tbl_user_reg as e WHERE  p.userId = e.regId AND attendence_date = '$date' AND p.userId = '$userId'";
      	  $result = $this->db->select($query);
      	  if ($result) {
      	  	while($sort = $result->fetch_assoc()){
      	  		$user = $sort['userName'];
      	  		$eId  = $sort['eId'];
      	  	}
      	  }
	 
	    
	    $insertdata = "INSERT INTO tbl_attendence(userId, eId, attendence_time, day, attendence_date, month, inip, status, name) VALUES('$userId', '$id', '$time', '$day', '$date', '$month', '$serverIP', '1', '$name')";
	    $resultrow = $this->db->insert($insertdata);
	    if($resultrow){
	        $msg = "Attendence Marked Successfully";
	        return $msg;
	    }else{
	        $msg = "Attendence Not Marked Successfully";
	        return $msg;	        
	    }
	}

	public function giveOutAttendence($data, $userId, $serverIP, $date, $day, $month){

			$query = "SELECT * FROM tbl_attendence WHERE userId = '$userId' AND attendence_date = '$date'";
			$res = $this->db->select($query);
			if (!$res) {
			?>
			<script>var my_time = new Date(); alert('You are not check In today... '+my_time);
                        window.location = 'dailyAttendance';
                        </script>
			<?php
			}

			$checkout 		= $this->fm->validation($data['checkouttime']);


			$checkout = mysqli_real_escape_string($this->db->link, $checkout);



			$restrict = "SELECT * FROM tbl_attendence WHERE outdate = '$date' AND userId = '$userId'";
			$result = $this->db->select($restrict);
			if ($result) {

			$query = "UPDATE tbl_attendence 
			SET

			outtime = '$checkout',
			outday = '$day',
			outmonth = '$month',
			outdate = '$date',
			ipout = '$serverIP'

			WHERE userId = '$userId' AND attendence_date = '$date'";
			$res = $this->db->update($query);
			if($res){
			    $msg = "You Have Successfully give Checkout Time";
			    return $msg;
			}else{
			    $msg = "Mark Checkout Time Is unsuccessfull";
			    return $msg;			    
			}
			
	}
}
//admin give attendance end


		public function getUseratten($userId){
			$query = "SELECT * FROM tbl_attendence WHERE userId = '$userId' ORDER BY id DESC LIMIT 7";
			$res = $this->db->select($query);
			return $res;
		}

//hr checked out method
		public function hrmarkcheckOutAttendence($data, $userId, $serverIPout, $date, $day, $time, $month){
			$checkoutdate 	= $this->fm->validation($data['checkoutdate']);

			$early_leave 	= $this->fm->validation($data['early_leave']);
			$ongoing_works  = $this->fm->validation($data['ongoing_works']);
			$incase_errand_place = $this->fm->validation($data['incase_errand_place']);

			$errand_from_out = $this->fm->validation($data['errand_from_out']);
			$errand_to_out   = $this->fm->validation($data['errand_to_out']);
			$checkoutTime   = $this->fm->validation($data['checkoutTime']);

			$early_leave   = mysqli_real_escape_string($this->db->link, $early_leave);
			$ongoing_works = mysqli_real_escape_string($this->db->link, $ongoing_works);
			$incase_errand_place = mysqli_real_escape_string($this->db->link, $incase_errand_place);
			
			$errand_from_out = mysqli_real_escape_string($this->db->link, $errand_from_out);
			$errand_to_out = mysqli_real_escape_string($this->db->link, $errand_to_out);
			$checkoutTime = mysqli_real_escape_string($this->db->link, $checkoutTime);

			
			$query = "SELECT * FROM tbl_attendence WHERE userId = '$userId' AND attendence_date = '$checkoutdate'";
			$res = $this->db->select($query);
			if (!$res) {
			?>
			<script>var my_time = new Date(); alert('You are not check In today... '+my_time);
                        window.location = 'give_attend';
                        </script>
			<?php
			}

			$restrict = "SELECT * FROM tbl_attendence WHERE outdate = '$date' AND userId = '$userId'";
			$result = $this->db->select($restrict);
			if ($result) {
				?>
			<script>var my_time = new Date(); alert('Checked Out at '+my_time);
                        window.location = 'give_attend';
                        </script>
			<?php
			}else{
			$query = "UPDATE tbl_attendence 
			SET
			early_leave = '$early_leave',
			ongoing_works = '$ongoing_works',
			incase_errand_place = '$incase_errand_place',
			
			errand_from_out = '$errand_from_out',
			errand_to_out = '$errand_to_out',
			outtime = '$checkoutTime',
			outday = '$day',
			outmonth = '$month',
			outdate = '$checkoutdate',
			ipout = '$serverIPout'

			WHERE userId = '$userId' AND attendence_date = '$checkoutdate'";
			$res = $this->db->update($query);
			if ($res) {
							?>
			<script>var my_time = new Date(); alert('Checked Out at '+my_time);
                        window.location = 'give_attend';
                        </script>
			<?php
			}else{
				$msg = "Attendence Not Marked";
				return $msg;
			}
		}
		
}
//hr checked out method end

		public function markOutAttendence($data, $userId, $serverIPout, $date, $day, $time, $month){
			$query = "SELECT * FROM tbl_attendence WHERE userId = '$userId' AND attendence_date = '$date'";
			$res = $this->db->select($query);
			if (!$res) {
			?>
			<script>var my_time = new Date(); alert('You are not check In today... '+my_time);
                        window.location = 'dailyAttendance';
                        </script>
			<?php
			}




			$early_leave 		= $this->fm->validation($data['early_leave']);
			$ongoing_works  = $this->fm->validation($data['ongoing_works']);
			$incase_errand_place = $this->fm->validation($data['incase_errand_place']);

			$errand_from_out = $this->fm->validation($data['errand_from_out']);
			$errand_to_out = $this->fm->validation($data['errand_to_out']);

			$early_leave = mysqli_real_escape_string($this->db->link, $early_leave);
			$ongoing_works = mysqli_real_escape_string($this->db->link, $ongoing_works);
			$incase_errand_place = mysqli_real_escape_string($this->db->link, $incase_errand_place);
			
			$errand_from_out = mysqli_real_escape_string($this->db->link, $errand_from_out);
			$errand_to_out = mysqli_real_escape_string($this->db->link, $errand_to_out);



			$restrict = "SELECT * FROM tbl_attendence WHERE outdate = '$date' AND userId = '$userId'";
			$result = $this->db->select($restrict);
			if ($result) {
				?>
			<script>var my_time = new Date(); alert('Checked Out at '+my_time);
                        window.location = 'dailyAttendance';
                        </script>
			<?php
			}else{
			$query = "UPDATE tbl_attendence 
			SET
			early_leave = '$early_leave',
			ongoing_works = '$ongoing_works',
			incase_errand_place = '$incase_errand_place',
			
			errand_from_out = '$errand_from_out',
			errand_to_out = '$errand_to_out',
			outtime = '$time',
			outday = '$day',
			outmonth = '$month',
			outdate = '$date',
			ipout = '$serverIPout'

			WHERE userId = '$userId' AND attendence_date = '$date'";
			$res = $this->db->update($query);
			if ($res) {
							?>
			<script>var my_time = new Date(); alert('Checked Out at '+my_time);
                        window.location = 'dailyAttendance';
                        </script>
			<?php
			}else{
				$msg = "Attendence Not Marked";
				return $msg;
			}
		}
		
}



// errand approval start
public function errandAttend($data, $userId, $serverIP, $date, $day, $time, $month){
		$late_reason 	= $this->fm->validation($data['late_reason']);
		$original_time  = $this->fm->validation($data['original_time']);
		$late_reason 	= mysqli_real_escape_string($this->db->link, $late_reason);
		$original_time  = mysqli_real_escape_string($this->db->link, $original_time);

		if ($late_reason == "") {
			$msg = "<span style='color:red;'>Please Select Your Reason For Being Late!!</span>";
			return $msg;
		}

		$squery = "SELECT * FROM tbl_employee WHERE userId = '$userId'";
		$getData = $this->db->select($squery);
		if ($getData) {
			while ($res = $getData->fetch_assoc()) {
				$name = $res['user'];
				$id =$res['id'];
			}
		}

		$query = "SELECT p.*, e.userName FROM tbl_attendence as p, tbl_user_reg as e WHERE  p.userId = e.regId AND attendence_date = '$date' ORDER BY p.id DESC";
      	  $result = $this->db->select($query);
      	  if ($result) {
      	  	while($sort = $result->fetch_assoc()){
      	  		$user = $sort['userName'];
      	  		$eId  = $sort['eId'];
      	  	}
      	  }

		$squery = "SELECT * FROM tbl_attendence WHERE userId = '$userId' AND attendence_date = '$date'";
		$getData = $this->db->select($squery);
		if ($getData) {
			?>
			<script>var my_time = new Date(); alert('You are already Requested For Late Approval...'+my_time);
                        window.location = 'dailyAttendance';
                        </script>
			<?php
		}else{
					$query = "INSERT INTO tbl_attendence(userId, eId, errand_place_in, errand_for_in, errand_from_in, errand_to_in, attendence_time, day, attendence_date, month, inip, status, name) VALUES('$userId', '$id', '$errand_place_in', '$errand_for_in', '$errand_from_in', '$errand_to_in', '$time', '$day', '$date', '$month', '$serverIP', '1', '$name')";
			$res = $this->db->insert($query);
			if ($res) {
				$msg = "Attendence Marked";
				return $msg;
			}else{
				$msg = "Attendence Not Marked";
				return $msg;
			}
		
		}
}



	public function errandAttendence($data, $userId, $serverIP, $date, $day, $time, $month){
			$errand_place_in = $this->fm->validation($data['errand_place_in']);
			$errand_for_in   = $this->fm->validation($data['errand_for_in']);
			$errand_from_in  = $this->fm->validation($data['errand_from_in']);
			$errand_to_in    = $this->fm->validation($data['errand_to_in']);

			$errand_place_in = mysqli_real_escape_string($this->db->link, $errand_place_in);
			$errand_for_in   = mysqli_real_escape_string($this->db->link, $errand_for_in);
			$errand_from_in  = mysqli_real_escape_string($this->db->link, $errand_from_in);
			$errand_to_in    = mysqli_real_escape_string($this->db->link, $errand_to_in);
			

			$squery = "SELECT * FROM tbl_errand WHERE userId = '$userId'";
			$getData = $this->db->select($squery);
			if ($getData) {
				while ($res = $getData->fetch_assoc()) {
					$name = $res['user'];
					$id =$res['id'];
				}
			}

			$squery = "SELECT * FROM tbl_errand";
			$getData = $this->db->select($squery);
			if ($getData) {
				while ($res = $getData->fetch_assoc()) {
					$name = $res['user'];
					$eid =$res['id'];
				}
			}

			$query = "SELECT p.*, e.userName FROM tbl_attendence as p, tbl_user_reg as e WHERE  p.userId = e.regId AND attendence_date = '$date' ORDER BY p.id DESC";
	      	  $result = $this->db->select($query);
	      	  if ($result) {
	      	  	while($sort = $result->fetch_assoc()){
	      	  		$user = $sort['userName'];
	      	  		$eId  = $sort['eId'];
	      	  	}
	      	  }


			if ($errand_place_in == "") {
				$msg = "<span style='color:red;'>Please Enter Your Errand Place!!</span>";
				return $msg;
			}elseif ($errand_for_in == "") {
				$msg = "<span style='color:red;'>Please Enter Errand For Whoom!!</span>";
				return $msg;			
			}elseif ($errand_from_in == "") {
				$msg = "<span style='color:red;'>Please Enter Errand Form...(Time)!!</span>";
				return $msg;	
			}elseif ($errand_to_in == "") {
				$msg = "<span style='color:red;'>Please Enter Errand To...(Time)!!</span>";
				return $msg;	
			}else{
							$query = "INSERT INTO tbl_errand(userId, errand_place_in, errand_for_in, errand_from_in, errand_to_in, attendence_time, day, attendence_date,  inip, status) VALUES('$userId', '$errand_place_in', '$errand_for_in', '$errand_from_in', '$errand_to_in', '$time', '$day', '$date', '$serverIP', '1')";
			$res = $this->db->insert($query);
			if ($res) {
							
			 						?>
			 					<script>var my_time = new Date(); alert('Late Approval Request Submit '+my_time);
                        		window.location = 'dailyAttendance';
                      			  </script>
                            <?php


							$headers = 'From: '.$email."\r\n".
							 
							'Reply-To: '.$email."\r\n" .
							 
							'X-Mailer: PHP/' . phpversion();

							$email_to = "hr@keal.com.bd";
							$email_subject= "Dailly Attendence $date";
							$email_message= "
Dear $userName,
Employee Id = $eId $user $userId
Date = $date
Day  = $day
Late_reason = $late_reason
ServerIP = $serverIP
Checked In

Click this link for Approve Late Comming...

https://career.keal.com.bd/LoginRegistrationForm/admin/approvelate?userId=$eid

Click this link for Deny Late Comming...

https://career.keal.com.bd/LoginRegistrationForm/admin/denylate?userId=$eid
";


							$headers1 = 'From: '.$email_to."\r\n".
							 
							'Reply-To: '.$email_to."\r\n" .
							 
							'X-Mailer: PHP/' . phpversion();

							$email_subject1= "How to Complete your Application & Process Note";
							$email_message1= "
Dear $userName,
Employee Id = $eId $user $userId
Date = $date
Day  = $day
Late_reason = $late_reason
ServerIP = $serverIP
Checked In

Click this link for Approve Late Comming...

https://career.keal.com.bd/LoginRegistrationForm/admin/approveerrand?userId=$eid

Click this link for Deny Late Comming...

https://career.keal.com.bd/LoginRegistrationForm/admin/denyerrand?userId=$eid";

							$email_message2= 'Date'.$date."\r\n";
							mail("<$email_to>","$email_subject","$email_message","$headers");

							mail("<$email>","$email_subject1","$email_message1","$headers1");	
  			

			}else{
				$msg = "Attendence Not Marked";
				return $msg;
			}
		}
	}
//errand end


		public function getUseroutatten($userId){
			$query = "SELECT outdate, outmonth, outday, outtime FROM tbl_attendence WHERE userId = '$userId' ORDER BY id DESC LIMIT 7";
			$res = $this->db->select($query);
			return $res;
		}

		public function getUserBy($userId){
			$query = "SELECT * FROM tbl_employee WHERE userId = '$userId'";
			$result = $this->db->select($query);
			return $result;
		}

		public function getregUserBy($userId){
			$query = "SELECT * FROM tbl_user_reg WHERE regId = '$userId'";
			$result = $this->db->select($query);
			return $result;
		}

    public function userProfile($data, $userId){
        $user = $this->fm->validation($data['user']);
        $job_title = $this->fm->validation($data['job_title']);
        $designation = $this->fm->validation($data['designation']);
        $office_contact = $this->fm->validation($data['office_contact']);
        $optional_email = $this->fm->validation($data['optional_email']);
        
        $user = mysqli_real_escape_string($this->db->link, $user);
		$job_title   = mysqli_real_escape_string($this->db->link, $job_title);
		$designation = mysqli_real_escape_string($this->db->link, $designation);
		$office_contact = mysqli_real_escape_string($this->db->link,$office_contact);
		$optional_email = mysqli_real_escape_string($this->db->link,$optional_email);
		
		$squery = "SELECT * FROM tbl_user_reg WHERE regId = '$userId'";
		$getData = $this->db->select($squery);
		if ($getData) {
			while ($res = $getData->fetch_assoc()) {
				$email = $res['email'];
				$userName = $res['userName'];
				}
			}
		if($user == "" || $job_title = "" || $optional_email ==""){
		    $msg = "Field Must Not Be Empty";
		    return $msg;
		}else{
		    $query = "INSERT INTO tbl_employee(userId, user, job_title,
		    designation, office_contact, optional_email, defultInTime, defultOuttime) VALUES('$userId', '$user', '$job_title', '$designation', '$office_contact', '$optional_email', '09:00 AM', '05:00 PM')";
		    $insert_row = $this->db->insert($query);
				if ($insert_row) {
        			?>
        			<script>var my_time = new Date(); alert('Please Wait until HR activate Your account '+my_time);
                                window.location = 'dailyAttendance';
                                </script>
        			<?php


							$headers = 'From: '.$email."\r\n".
							 
							'Reply-To: '.$email."\r\n" .
							 
							'X-Mailer: PHP/' . phpversion();

							$email_to = "hr@keal.com.bd";
							$email_subject= "Request For HR Approval";
							$email_message= "
Dear $userName,
https://career.keal.com.bd/LoginRegistrationForm/admin/activateuser?eId=$userId
								 
Recruitment Office
Kyoto Engineering & Automation Ltd
B2 House 64 Block B Road 3
Niketon Gulshan Dhaka 1212
								 
Emergency Contact Numbers:
01844046621
01844046666
01844046677";

							


							$headers1 = 'From: '.$email_to."\r\n".
							 
							'Reply-To: '.$email_to."\r\n" .
							 
							'X-Mailer: PHP/' . phpversion();

							$email_subject1= "Request For HR Approval";
							$email_message1= "
Dear $userName,
Your Profile has been created please wait for HR approval. After HR approval you
will get attendance panel.
								 
Recruitment Office
Kyoto Engineering & Automation Ltd
B2 House 64 Block B Road 3
Niketon Gulshan Dhaka 1212
								 
Emergency Contact Numbers:
01844046621
01844046666
01844046677";

							 
							$email_message2= 'Date'.$date."\r\n";
							mail("<$email_to>","$email_subject","$email_message","$headers");

							mail("<$email>","$email_subject1","$email_message1","$headers1");
						
				}else{
		        $msg = "Row Not Inserted";
		        return $msg; 		        
		    }
		}
    }
		

		
// 	public function getemployeeId($date){
// 		 //$date = date('Y-m-d');
//       	 $query = "SELECT p.*, r.userName FROM tbl_attendence as p, tbl_user_reg as r WHERE  p.userId = r.regId AND attendence_date = '$date' ORDER BY p.id DESC";
//       	  $result = $this->db->select($query);
//           return $result;

//           /*$query = "SELECT p.*, r.userName, j.jobtitle  FROM tbl_interview as p, tbl_user_reg as r, tbl_jobtitle as j, tbl_department as s WHERE p.userId = r.regId AND p.jId = j.jId  ORDER BY p.id DESC";
//           $query = "SELECT * FROM tbl_interview  ORDER BY id DESC";
//           $result = $this->db->select($query);
//           return $result;*/
// 	}
	public function getemployeeId($date, $uId){
		 //$date = date('Y-m-d');
      	 $query = "SELECT p.*, r.userName FROM tbl_attendence as p, tbl_user_reg as r WHERE  p.userId = r.regId AND attendence_date = '$date' AND userID = '$uId' ORDER BY p.id DESC";
      	  $result = $this->db->select($query);
           return $result;

           /*$query = "SELECT p.*, r.userName, j.jobtitle  FROM tbl_interview as p, tbl_user_reg as r, tbl_jobtitle as j, tbl_department as s WHERE p.userId = r.regId AND p.jId = j.jId  ORDER BY p.id DESC";
           $query = "SELECT * FROM tbl_interview  ORDER BY id DESC";
           $result = $this->db->select($query);
           return $result;*/
	}

	public function getemployeeIdbyse($dateform,$dateto,$uId){
		 //$date = date('Y-m-d');
      	   $query = "SELECT * FROM tbl_attendence WHERE attendence_date BETWEEN '$dateform' AND '$dateto' AND userID = '$uId' ORDER BY id DESC";
      	   $result = $this->db->select($query);
           return $result;

           /*$query = "SELECT p.*, r.userName, j.jobtitle  FROM tbl_interview as p, tbl_user_reg as r, tbl_jobtitle as j, tbl_department as s WHERE p.userId = r.regId AND p.jId = j.jId  ORDER BY p.id DESC";
           $query = "SELECT * FROM tbl_interview  ORDER BY id DESC";
           $result = $this->db->select($query);
           return $result;*/
	}	
    public function getemployeedata($date, $uId){
    	   	 $query = "SELECT p.*, r.userName FROM tbl_attendence as p, tbl_user_reg as r WHERE  p.userId = r.regId AND attendence_date = '$date' AND userID = '$uId' ORDER BY p.id DESC";
      	  $result = $this->db->select($query);
           return $result;
    }	

    public function getemployeedatabyse($dateform,$dateto,$uId){
    	   //$query = "SELECT p.*, r.userName FROM tbl_attendence as p, tbl_user_reg as r WHERE  p.userId = r.regId AND p.attendence_date BETWEEN '$dateform' AND '$dateto' AND p.userID = '$uId' ORDER BY p.id DESC";
           $query = "SELECT * FROM tbl_attendence WHERE attendence_date BETWEEN '$dateform' AND '$dateto' AND userId = '$uId'";
           $result = $this->db->select($query);
           return $result;
    }	
    
    
	public function getdateby($date){
		$query = "SELECT attendence_date, day FROM tbl_attendence WHERE attendence_date = '$date' LIMIT 1";
		$result = $this->db->select($query);
		return $result;
	}
	
	public function getsedateby($dateform, $dateto){
		$query = "SELECT attendence_date, day FROM tbl_attendence WHERE attendence_date BETWEEN '$dateform' AND '$dateto'";
		$result = $this->db->select($query);
		return $result;
	}
	public function getemployee($uId){
		$query = "SELECT * FROM tbl_employee WHERE userId = '$uId'";
		$res = $this->db->select($query);
		return $res;
	}

	public function getDefultTime($userId){
		$query = "SELECT * FROM tbl_employee WHERE userId = '$userId'";
		$res = $this->db->select($query);
		return $res;
	}

	public function getAllemployee(){
		  $query = "SELECT p.*, r.userName FROM tbl_employee as p, tbl_user_reg as r WHERE  p.userId = r.regId AND p.disable='0' ORDER BY p.id DESC";
      	  $result = $this->db->select($query);
           return $result;
	}
	
		public function getrecieveremail(){
		$query = "SELECT * FROM tbl_receiver ORDER BY id DESC";
		$res = $this->db->select($query);
		return $res;
	}

	public function getreliveremail(){
		$query = "SELECT * FROM employee WHERE stat='1' ORDER BY id ASC";
		$res = $this->db->select($query);
		return $res;
	}
	
		//06-02-18
	public function getEmployeDetails($uId){
		$query = "SELECT p.*, e.userName FROM tbl_employee as p, tbl_user_reg as e WHERE  p.userId = e.regId AND p.userId = '$uId'";
	      	  $result = $this->db->select($query);
		return $result;
	}
		public function getEmployetime($uId){
		$query = "SELECT * FROM tbl_employee WHERE userId ='$uId'";
		$res = $this->db->select($query);
		return $res;
	}
		public function CreateofficeSchedule($data, $uId){
		$inTime = $this->fm->validation($data['defultInTime']);
		$outTime = $this->fm->validation($data['defultOuttime']);

		if($inTime == "" || $outTime == ""){
			$msg = "<span style='color:red';>Please Give Both IN & OUT Time</span>";
			return $msg;
		}else{
			$query = "UPDATE tbl_employee SET
			defultInTime = '$inTime',
			defultOuttime = '$outTime'
			WHERE userId = '$uId'";
			$update_row = $this->db->update($query);
			if ($update_row) {
			$msg = "<span style='color:green';>In Time & Out Time has been Set</span>";
			return $msg;
			}else{
			$msg = "<span style='color:green';>In Time & Out Time has been not Set</span>";
			return $msg;
			}
		}
	}
	
		public function leaveRequest($data, $userId, $serverIP, $cyear, $date){
		$remail = $this->fm->validation($data['remail']);
		$reason = $this->fm->validation($data['reason']);
		$Dabout = $this->fm->validation($data['Dabout']);
		$fdatee = $this->fm->validation($data['fdate']);
		$tdatee = $this->fm->validation($data['tdate']);
		$email = $this->fm->validation($data['email']);
		$rnote = $this->fm->validation($data['rnote']);

		$remail = mysqli_real_escape_string($this->db->link, $remail);
		$reason = mysqli_real_escape_string($this->db->link, $reason);
		$Dabout = mysqli_real_escape_string($this->db->link, $Dabout);
		$fdate = mysqli_real_escape_string($this->db->link, $fdate);
		$tdate = mysqli_real_escape_string($this->db->link, $tdate);
		$email = mysqli_real_escape_string($this->db->link, $email);
		$rnote = mysqli_real_escape_string($this->db->link, $rnote);
		
		$fdate = $this->fm->formDate($fdatee);
		$tdate = $this->fm->formDate($tdatee);

		$Mquery = "SELECT * FROM tbl_user_reg WHERE regId = '$userId'";
		$getmail = $this->db->select($Mquery);
		if ($getmail) {
			while ($row = $getmail->fetch_assoc()) {
				
				$userName = $row['userName'];
			}
		}
		
		$Iquery = "SELECT * FROM tbl_leaverequest WHERE userId = '$userId' ORDER BY id DESC";
		$getid = $this->db->select($Iquery);
		if ($getid) {
			while ($value = $getid->fetch_assoc()) {
				$id = $value['id'];
			}
		}
		
		if ($remail == "" || $reason == "" || $Dabout =="" ||  $fdate == "" || $tdate == "" || $email == "" || $rnote == "" ) {
			$msg = "Field Must Not Be Empty!!";
			return $msg;
		}else{
			$query = "INSERT INTO tbl_leaverequest(userId, remail, reason, Dabout, email, rnote, leave_fdate, leave_tdate, status, cyear, cdate) VALUES('$userId', '$remail', '$reason', '$Dabout', '$email', '$rnote', '$fdatee', '$tdatee', '1', '$cyear', '$date')";
			$result = $this->db->insert($query);
			if ($result) {
												?>
                                <script>
                                alert('Please wait untill HR Approve Your leave');
                                window.location.href='index';
                                </script>
                            <?php


							$headers = 'From: '.$email."\r\n".
							 
							'Reply-To: '.$email."\r\n" .
							 
							'X-Mailer: PHP/' . phpversion();

							$email_to = $remail;
							
							$email_subject= "$date Leave Request";
							$email_message= "
Employee Name = $userName
Employee Id = $userId
Reliver email = $email
Reason = $reason
Leave Details = $Dabout
Leave From = $fdate
Leave To = $tdate
ServerIP = $serverIP

click this link below to Approve or Not Apprpve this request
https://career.keal.com.bd/LoginRegistrationForm/admin/approveform?userId=$userId";


							


							$headers1 = 'From: '.$email_to."\r\n".
							 
							'Reply-To: '.$email_to."\r\n" .
							 
							'X-Mailer: PHP/' . phpversion();

							$email_subject1= "$date Leave Request";
							$email_message1= "

Employee Name = $userName
Employee Id = $userId
Receiver email = $remail
Reason = $reason
Leave Details = $rnote
Leave From = $fdate
Leave To = $tdate
ServerIP = $serverIP
https://career.keal.com.bd/LoginRegistrationForm/admin/approveform?userId=$userId";

							 
							$email_message2= 'Date'.$date."\r\n";
							mail("<$email_to>","$email_subject","$email_message","$headers");

							mail("<$email>","$email_subject1","$email_message1","$headers1");
						
				}else{
					$msg = "<span style='color:red;'>You are not successfully</span>";
					return $msg;
				}
		}
	}
	
			public function getlateemployeeId($date){
		 //$date = date('Y-m-d');
      	 $query = "SELECT p.*, r.userName FROM tbl_latecoming as p, tbl_user_reg as r WHERE  p.userId = r.regId AND datee = '$date' ORDER BY p.id DESC";
      	  $result = $this->db->select($query);
           return $result;

           /*$query = "SELECT p.*, r.userName, j.jobtitle  FROM tbl_interview as p, tbl_user_reg as r, tbl_jobtitle as j, tbl_department as s WHERE p.userId = r.regId AND p.jId = j.jId  ORDER BY p.id DESC";
           $query = "SELECT * FROM tbl_interview  ORDER BY id DESC";
           $result = $this->db->select($query);
           return $result;*/
	}

	//15-02-18
	
		 public function usertimerecord($date, $userId){
	 	$userId = $this->fm->validation($userId);

	 	$userId = mysqli_real_escape_string($this->db->link, $userId);

	 	$query = "INSERT INTO tbl_timerecord(userId, defTimein, defTimeOut, adate) VALUES('$userId', '09:00 AM', '05:00 PM', '$date')";
	 	$insert_row = $this->db->insert($query);
	 	if ($insert_row) {
			
	 	}else{

	 	}

	 }
	 
	 	public function getactivation($userId){
		$query = "SELECT * FROM tbl_employee WHERE userId = '$userId'";
		$res = $this->db->select($query);
		return $res;
	}
	
		public function getAllleaveemployee(){
		 $query = "SELECT p.*, r.userName FROM tbl_leaverequest as p, tbl_user_reg as r WHERE  p.userId = r.regId AND p.status = '1' ORDER BY p.id DESC";
      	  $result = $this->db->select($query);
           return $result;	    
	}
	
	public function getleaveemployeeby($uId, $fDate, $tDate){
	     $query = "SELECT p.*, r.userName FROM tbl_leaverequest as p, tbl_user_reg as r WHERE  p.userId = r.regId AND p.userId = '$uId' AND p.leave_fdate='$fDate' AND p.leave_tdate='$tDate' AND p.status = '1'";
      	  $result = $this->db->select($query);
           return $result;
	}
	
	public function leaveApproveform($data, $userId){
	    $fdate = $this->fm->validation($data['fdate']);
	    $tdate = $this->fm->validation($data['tdate']);
	    $approve = $this->fm->validation($data['approve']);
	    if($fdate == "" || $tdate == ""){
	        $msg = "Field Must Not Be Empty!!";
	        return $msg;
	    }else{
	        $query = "UPDATE tbl_leaverecord SET
	        approve_fdate = '$fdate',
	        approve_tdate = '$fdate',
	        approve = '$approve'
	        WHERE userId = '$userId'";
	        $up_row = $this->db->update($query);
	        if($up_row){
	            
	        }else{
	            
	        }
	    }
	}
    
    public function getUserleavedate($userId){
        $query = "SELECT * FROM tbl_leaverequest WHERE userId = '$userId'";
      	  $result = $this->db->select($query);
           return $result;
    }
    
       public function getAllleaverequests(){
       $query = "SELECT p.*, r.userName FROM tbl_leaverequest as p, tbl_user_reg as r WHERE p.userId = r.regId ORDER BY p.id DESC";
      	  $result = $this->db->select($query);
           return $result;
    }

public function getEmployeimages($uId){
    	$query = "SELECT * FROM employee WHERE userId ='$uId'";
		$res = $this->db->select($query);
		return $res;
}

public function insertEmployeeStatus($data, $adminId, $date, $serverIP, $uId){
	$sDate = $this->fm->validation($data['sDate']);
	$eDate = $this->fm->validation($data['eDate']);
	$comStat = $this->fm->validation($data['comStat']);
	$sDate = mysqli_real_escape_string($this->db->link, $sDate);
	$eDate = mysqli_real_escape_string($this->db->link, $eDate);
	$comStat = mysqli_real_escape_string($this->db->link, $comStat);

	if (empty($sDate) || empty($eDate) || empty($comStat)) {
		$errmsg = "<div class='alert alert-danger' role='alert'>Fields Must Not be Empty !!</div>";
        return $errmsg;
	}else{
		$query = "INSERT INTO tbl_complete_status(userId, sDate, eDate, comStat, adminId, createDate, ip) VALUES('$uId', '$sDate', '$eDate', '$comStat', '$adminId', '$date', '$serverIP')";
		$result = $this->db->insert($query);
		if ($result) {
			 ?>
                    <script>
                        var my_date = new Date ();
                        alert('Successfully Created..!! '+my_date);
                        window.location = '';
                    </script>
        <?php
		}else{
                    $errmsg = "<div class='alert alert-danger' role='alert'>Data Not Insert</div>";
                    return $errmsg;     
                }
	}
}
}//main class