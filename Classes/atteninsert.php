<?php include_once "lib/Database.php"; ?>
<?php include_once "../helpers/Format.php"; ?>
<?php include_once "lib/Session.php"; ?>

<?php
	/**
	* 
	*/
	class attendenceInsert
	{
		private $db;
		private $fm;

		public function __construct()
	
		{
			$this->db = new Database();
			$this->fm = new Format();
		}	

		public function getallclientIp(){
		    $query = "SELECT * FROM tbl_approveip";
		    $result = $this->db->select($query);
		    return $result;
		}

		public function insertph($data){
			$years = $this->fm->validation($data['years']);
			$date = $this->fm->validation($data['date']);
			$reason = $this->fm->validation($data['reason']);
			$day = $this->fm->validation($data['day']);
			$type = $this->fm->validation($data['type']);

			$date = mysqli_real_escape_string($this->db->link, $date);
			$reason = mysqli_real_escape_string($this->db->link, $reason);
			$day = mysqli_real_escape_string($this->db->link, $day);
			$type = mysqli_real_escape_string($this->db->link, $type);

			if ($date== "" || $reason == "" || $day == "" || $type == "" ) {
					$msg = "<span style='color:red'>Field Is Empty!!</span>";
					return $msg;
			}else{
				$query = "INSERT INTO tbl_ph(datee, reason, day, type, years) VALUES('$date', '$reason', '$day', '$type', '$years')";
				$result = $this->db->insert($query);
				if ($result) {
					$msg = "<span style='color:green'>PH Created Successfully</span>";
					return $msg;
				}else{
					$msg = "<span style='color:red'>PH Not Created Successfully</span>";
					return $msg;
				}
			}
}
			public function insertip($data, $date, $time){

				$ip = $this->fm->validation($data['ip']);
				$ip = mysqli_real_escape_string($this->db->link, $ip);

			if ($ip == "") {
			$msg = "<span style='color:red'>Field Is Empty!!</span>";
			return $msg;

			}else{
				$query = "INSERT INTO tbl_approveip(datee, timee, ip) VALUES('$date', '$time', '$ip')";
				$result = $this->db->insert($query);
				if ($result) {
					$msg = "<span style='color:green'>IP inserted Successfully</span>";
					return $msg;
				}else{
					$msg = "<span style='color:red'>IP not Successfully</span>";
					return $msg;
				}

			}
		}

		public function getapproveip(){
			$query = "SELECT * FROM tbl_approveip ORDER BY id DESC";
			$res = $this->db->select($query);
			return $res;
		}

		public function getphdate(){
			$query = "SELECT * FROM tbl_ph ORDER BY datee DESC";
			$res = $this->db->select($query);
			return $res;
		}

		public function getgradesheet(){
			$query = "SELECT * FROM tbl_egrade";
			$res = $this->db->select($query);
			return $res;	
		}

		public function getgradelist(){
			$query = "SELECT * FROM tbl_egrade";
			$res = $this->db->select($query);
			return $res;
		}

		public function addgrade($grade, $uId){
			$grade = mysqli_real_escape_string($this->db->link, $grade);
			if ($grade == "") {
					$msg = "<span style='color:red'>grade Not Select</span>";
					return $msg;
			}else{

						$query = "UPDATE tbl_employee SET grade = '$grade' WHERE userId = '$uId'";
						$result = $this->db->update($query);
						if ($result) {
								$msg = "<span style='color:green'>Grade Assigned</span>";
								return $msg;
						}else{
						$msg = "<span style='color:red'>grade Not Select</span>";
						return $msg;
						}
			}
					}
		public function addgradetwo($grade, $uId){
			$grade = mysqli_real_escape_string($this->db->link, $grade);
			if ($grade == "") {
					$msg = "<span style='color:red'>grade Not Select</span>";
					return $msg;
			}else{

						$query = "UPDATE tbl_allstaffs SET grade = '$grade' WHERE userId = '$uId'";
						$result = $this->db->update($query);
						if ($result) {
								$msg = "<span style='color:green'>Grade Assigned</span>";
								return $msg;
						}else{
						$msg = "<span style='color:red'>grade Not Select</span>";
						return $msg;
						}
			}
					}
		public function updateemployeeinfo($joiningdate, $grade, $uId, $date){
			$joiningdate = mysqli_real_escape_string($this->db->link, $joiningdate);
			$grade = mysqli_real_escape_string($this->db->link, $grade);

			$Mquery = "SELECT * FROM employee WHERE userId = '$uId'";
			$result = $this->db->select($Mquery)->fetch_assoc();
			$officeemail = $result['officeemail'];
			$phone = $result['phone'];

			if ($joiningdate== "" || $grade == "") {
					$msg = "<span style='color:red'>Please Set Joining</span>";
					return $msg;
			}else{

					$query = "INSERT INTO tbl_employeeinformation(employeeId, email, phone, grade, joindate, assigndate) VALUES('$uId', '$officeemail', '$phone', '$grade', '$joiningdate', '$date')";
					$insertrow = $this->db->insert($query);
						if ($insertrow) {
								$msg = "<span style='color:green'>Employee Information Stored</span>";
								return $msg;
						}else{
						$msg = "<span style='color:red'>Employee Information Not Stored</span>";
						return $msg;
						}		
		}
	}

	public function getemployeeinfo($uId){
		$query = "SELECT p.*, g.designation, g.si FROM tbl_employeeinformation as p, tbl_egrade as g
		WHERE p.grade = g.si AND employeeId='$uId' ORDER BY p.id DESC LIMIT 1";
		$reso = $this->db->select($query);
		return $reso;		
	}
public function getempdesignation($uId){
    	$query = "SELECT * FROM tbl_employee WHERE userId = '$uId'";
		$res = $this->db->select($query);
		return $res;
}

public function getstartdate($uId){
    	$query = "SELECT * FROM employee WHERE userId = '$uId'";
		$res = $this->db->select($query);
		return $res;
}

	public function getestatus(){
		$query = "SELECT * FROM tbl_estatus";
		$res = $this->db->select($query);
		return $res;
	}
	public function getelocation(){
		$query = "SELECT * FROM tbl_location";
		$res = $this->db->select($query);
		return $res;
	}

	public function insertestat($data){
			$estat = $this->fm->validation($data['estat']);
			$estat = mysqli_real_escape_string($this->db->link, $estat);
			if ($estat == "") {
					$msg = "<span style='color:red'>Employee Status Not Selected</span>";
					return $msg;
			}else{

						$query = "INSERT INTO tbl_estatus(estat) VALUES('$estat')";
						$result = $this->db->insert($query);
						if ($result) {
								$msg = "<span style='color:green'>Status Created</span>";
								return $msg;
						}else{
						$msg = "<span style='color:red'>Status Created</span>";
						return $msg;
						}
			}
	}

	public function updatestatus($data, $uId){
			$estat = $this->fm->validation($data['estat']);
			$estat = mysqli_real_escape_string($this->db->link, $estat);
			if ($estat == "") {
					$msg = "<span style='color:red'>Employee Status Not Selected</span>";
					return $msg;
			}else{

						$query = "UPDATE tbl_employee SET employeestat = '$estat' WHERE userId = '$uId'";
						$result = $this->db->update($query);
						if ($result) {
								$msg = "<span style='color:green'>Status Updated</span>";
								return $msg;
						}else{
						$msg = "<span style='color:red'>Status not Updated</span>";
						return $msg;
						}
			}
			}
	public function updatestatustwo($data, $uId){
			$estat = $this->fm->validation($data['estat']);
			$estat = mysqli_real_escape_string($this->db->link, $estat);
			if ($estat == "") {
					$msg = "<span style='color:red'>Employee Status Not Selected</span>";
					return $msg;
			}else{

						$query = "UPDATE tbl_allstaffs SET employeestat = '$estat' WHERE userId = '$uId'";
						$result = $this->db->update($query);
						if ($result) {
								$msg = "<span style='color:green'>Status Updated</span>";
								return $msg;
						}else{
						$msg = "<span style='color:red'>Status not Updated</span>";
						return $msg;
						}
			}
		}	

	public function insertstatus($data, $uId, $date){
			$estat = $this->fm->validation($data['estat']);
			$estat = mysqli_real_escape_string($this->db->link, $estat);
			if ($estat == "") {
					$msg = "<span style='color:red'>Employee Status Not Selected</span>";
					return $msg;
			}else{

						$query = "INSERT INTO tbl_emrecord(userId, estat, adate) VALUES( '$uId','$estat', '$date')";
						$result = $this->db->insert($query);
						if ($result) {
								$msg = "<span style='color:green'>Status Created</span>";
								return $msg;
						}else{
						$msg = "<span style='color:red'>Status Created</span>";
						return $msg;
						}
			}
	}

	public function insertofficeSchedule($data, $uId, $date){
			$defultInTime = $this->fm->validation($data['defultInTime']);
			$defultOuttime = $this->fm->validation($data['defultOuttime']);
			$defultInTime = mysqli_real_escape_string($this->db->link, $defultInTime);
			$defultOuttime = mysqli_real_escape_string($this->db->link, $defultOuttime);

			if ($defultInTime == "" || $defultOuttime == "") {
					$msg = "<span style='color:red'>Employee Status Not Selected</span>";
					return $msg;
			}else{

						$query = "INSERT INTO tbl_timerecord(userId, defTimein, defTimeOut, adate) VALUES( '$uId',  '$defultInTime', '$defultOuttime', '$date')";
						$result = $this->db->insert($query);
						if ($result) {
								$msg = "<span style='color:green'>Status Created</span>";
								return $msg;
						}else{
						$msg = "<span style='color:red'>Status Created</span>";
						return $msg;
						}
			}

	}

	public function getemployeestat($uId){
		$query = "SELECT * FROM tbl_employee WHERE userId = '$uId'";
		$res = $this->db->select($query);
		return $res;
	}
	
	public function getemployeemark($date, $uId){
	    		$query = "SELECT * FROM tbl_attendence WHERE attendence_date = '$date' AND userId = '$uId'";
		$res = $this->db->select($query);
		return $res;
	}

	public function getemployeemarkby($dateform,$dateto, $uId){
	    $query = "SELECT * FROM tbl_attendence WHERE attendence_date BETWEEN '$dateform' AND '$dateto' AND userId = '$uId'";
		$res = $this->db->select($query);
		return $res;
	}
	
		public function getemployeeattendance($date, $uId){
		$query = "SELECT * FROM tbl_attendence WHERE attendence_date = '$date' AND userId = '$uId'";
		$res = $this->db->select($query);
		return $res;	
	}

		public function getemployeeattendanceby($dateform,$dateto, $uId){
		$query = "SELECT * FROM tbl_attendence WHERE attendence_date BETWEEN '$dateform' AND '$dateto' AND userId = '$uId'";
		$res = $this->db->select($query);
		return $res;	
	}


		public function getemployeeattendancebyse($dateform,$dateto,$byuser){
		$query = "SELECT * FROM tbl_attendence WHERE attendence_date BETWEEN '$dateform' AND '$dateto' AND userId = '$byuser'";
		$res = $this->db->select($query);
		return $res;	
	}
	// public function getemployeeleaverequest(){
	// 	$query = "SELECT * FROM tbl_employee ORDER BY id";
	// 	$res = $this->db->select($query);
	// 	return $res;
	// }

		public function getemployeeleaverequest(){
		 //$date = date('Y-m-d');
      	 $query = "SELECT p.*, r.userName, e.estat FROM tbl_employee as p, tbl_user_reg as r, tbl_estatus as e WHERE  p.userId = r.regId AND 
      	 p.employeestat = e.id ORDER BY p.id DESC";
      	  $result = $this->db->select($query);
           return $result;

           /*$query = "SELECT p.*, r.userName, j.jobtitle  FROM tbl_interview as p, tbl_user_reg as r, tbl_jobtitle as j, tbl_department as s WHERE p.userId = r.regId AND p.jId = j.jId  ORDER BY p.id DESC";
           $query = "SELECT * FROM tbl_interview  ORDER BY id DESC";
           $result = $this->db->select($query);
           return $result;*/
	}
	
		public function getAllemploye(){
		 $query = "SELECT p.*, r.userName FROM tbl_employee as p, tbl_user_reg as r WHERE  p.userId = r.regId AND active = '1' AND estat = '0' ORDER BY p.id ASC";
      	  $result = $this->db->select($query);
           return $result;
	}

		public function getAlltypeemploye(){
		 $query = "SELECT p.*, r.userName FROM tbl_employee as p, tbl_user_reg as r WHERE  p.userId = r.regId AND p.disable='0' ORDER BY p.id ASC";
            // $query = "SELECT * FROM tbl_employee ORDER BY id ASC";
      	  $result = $this->db->select($query);
           return $result;
	}
	
	public function getAllonlytypeemploye($byuser, $dateform, $dateto){
		 $query = "SELECT p.*, r.userName FROM tbl_attendence as p, tbl_user_reg as r WHERE  p.userId = r.regId AND p.userId = '$byuser' AND p.attendence_date BETWEEN '$dateform' AND '$dateto'";
      	  $result = $this->db->select($query);
           return $result;
	}
	
	public function getAllonlytypeemployename($byuser){
		 $query = "SELECT * FROM employee WHERE userId='$byuser'";
      	  $result = $this->db->select($query);
           return $result;
	}
	public function getemployelocation($locatId){
		 $query = "SELECT * FROM tbl_location WHERE id='$locatId'";
      	  $result = $this->db->select($query);
           return $result;
	}
	
	public function getshiftemployee(){
	    $query = "SELECT * FROM employee ORDER BY id DESC";
	    $select_row = $this->db->select($query);
	    return $select_row;
	}

	
		//19-02-18
	public function lateApprovalrequest($data, $userId, $serverIP, $date, $day, $time, $month){
		$late_reason = $this->fm->validation($data['late_reason']);
		$original_time = $this->fm->validation($data['original_time']);
		$description = $this->fm->validation($data['description']);
		$late_reason 	= mysqli_real_escape_string($this->db->link, $late_reason);
		$original_time  = mysqli_real_escape_string($this->db->link, $original_time);
		$description 	= mysqli_real_escape_string($this->db->link, $description);
        $time = $this->fm->formatTime($time);


		if($late_reason == ""){
			$msg = "Field empty";
			return $msg;
		}


		$Mquery = "SELECT * FROM tbl_user_reg WHERE regId = '$userId'";
		$getmail = $this->db->select($Mquery);
		if ($getmail) {
			while ($row = $getmail->fetch_assoc()) {
				$email = $row['email'];
				$name = $row['userName'];
			}
		} 

		$Iquery = "SELECT * FROM tbl_attendence WHERE userId = '$userId' AND attendence_date = '$date'";
		$getid = $this->db->select($Iquery);
		if ($getid) {
			while ($value = $getid->fetch_assoc()) {
				$id = $value['id'];
			}
		}

		$dataquery = "SELECT * FROM tbl_latecoming WHERE userId = '$userId' AND datee = '$date'";
		$getdata = $this->db->select($dataquery);
		if ($getdata) {
						?>
			<script>var my_time = new Date(); alert('You are already Requested For Late Approval...'+my_time);
                        window.location = 'dailyAttendance';
                        </script>
			<?php
		}else{
			$inserted = "INSERT INTO tbl_latecoming(userId, late_reason, description, original_time, attendence_time, datee) VALUES('$userId', '$late_reason', '$description', '$original_time', '$attendence_time', '$date')";
			$insert_row = $this->db->insert($inserted);
			if ($insert_row) {
							?>
			 					<script>var my_time = new Date(); alert('Late Approval Request Submit '+my_time);
                        		window.location = 'dailyAttendance';
                      			  </script>
                            <?php

							$headers = 'From: '.$email."\r\n".
							 
							'Reply-To: '.$email."\r\n" .
							 
							'X-Mailer: PHP/' . phpversion();

							$email_to = "hr@keal.com.bd";
							$email_subject= "$date Late Coming Approval Request";
							$email_message= "
Dear $name,
Employee Id = $userId
Date = $date
Day  = $day
Time = $time
Late_reason = $late_reason
Reason Details = $description
ServerIP = $serverIP
Checked In

Click this link for Approve Late Comming...

https://career.keal.com.bd/LoginRegistrationForm/admin/approvelate?id=$id

Click this link for Deny Late Comming...

https://career.keal.com.bd/LoginRegistrationForm/admin/denylate?id=$id";


							$headers1 = 'From: '.$email_to."\r\n".
							 
							'Reply-To: '.$email_to."\r\n" .
							 
							'X-Mailer: PHP/' . phpversion();

							$email_subject1= "$date Late Coming Approval Request";
							$email_message1= "
Dear $userName,
Employee Id = $eId $user $userId
Date = $date
Day  = $day
Time = $time
Late_reason = $late_reason
Reason Details = $description
ServerIP = $serverIP
Please wait untill HR approve your late";

							$email_message2= 'Date'.$date."\r\n";
							mail("<$email_to>","$email_subject","$email_message","$headers");

							mail("<$email>","$email_subject1","$email_message1","$headers1");					
			}else{
				$msg = "Attendence Not Marked";
				return $msg;				
			}
		}
	}
	
	public function errandAttend($data, $userId, $serverIP, $date, $day, $time, $month){
			$errand_place_in = $this->fm->validation($data['errand_place_in']);
			$errand_for_in   = $this->fm->validation($data['errand_for_in']);
			$errand_from_in  = $this->fm->validation($data['errand_from_in']);
			$errand_to_in    = $this->fm->validation($data['errand_to_in']);

			$errand_place_in = mysqli_real_escape_string($this->db->link, $errand_place_in);
			$errand_for_in   = mysqli_real_escape_string($this->db->link, $errand_for_in);
			$errand_from_in  = mysqli_real_escape_string($this->db->link, $errand_from_in);
			$errand_to_in    = mysqli_real_escape_string($this->db->link, $errand_to_in);


		$squery = "SELECT * FROM tbl_employee WHERE userId = '$userId'";
		$getData = $this->db->select($squery);
		if ($getData) {
			while ($res = $getData->fetch_assoc()) {
				$name = $res['user'];
				$id =$res['id'];
			}
		}

		// $query = "SELECT p.*, e.userName FROM tbl_attendence as p, tbl_user_reg as e WHERE  p.userId = e.regId AND attendence_date = '$date' ORDER BY p.id DESC";
  //     	  $result = $this->db->select($query);
  //     	  if ($result) {
  //     	  	while($sort = $result->fetch_assoc()){
  //     	  		$user = $sort['userName'];
  //     	  		$eId  = $sort['eId'];
  //     	  	}
  //     	  }

		$Mquery = "SELECT * FROM tbl_user_reg WHERE regId = '$userId'";
		$getData = $this->db->select($Mquery);
		if ($getData) {
			while ($res = $getData->fetch_assoc()) {
				$email = $res['email'];
				$userName =$res['userName'];
			}
		}

		$Iquery = "SELECT * FROM tbl_attendence WHERE userId = '$userId' AND attendence_date = '$date'";
		$getid = $this->db->select($Iquery);
		if ($getid) {
			while ($value = $getid->fetch_assoc()) {
				$id = $value['id'];
			}
		}

		$squery = "SELECT * FROM tbl_errand WHERE userId = '$userId' AND attendence_date = '$date'";
		$getData = $this->db->select($squery);
		if ($getData) {
			?>
			<script>var my_time = new Date(); alert('You are already Requested For Errand Approval...'+my_time);
                        window.location = 'dailyAttendance';
                        </script>
			<?php
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
					$query = "INSERT INTO tbl_errand(userId, errand_place_in, errand_for_in, errand_from_in, errand_to_in, attendence_time, day, attendence_date,  inip, status,value) VALUES('$userId', '$errand_place_in', '$errand_for_in', '$errand_from_in', '$errand_to_in', '$time', '$day', '$date', '$serverIP', '1', '1')";
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
							$email_subject= "Errand Approval Request $date";
							$email_message= "
Dear $userName,
Employee Id = $userId
Date = $date
Day  = $day
Errand = $errand_place_in
Errand From = $errand_from_in
Errand To =  $errand_to_in
Errand For = $errand_for_in
ServerIP = $serverIP
Checked In
Click this link for Approve This Errand...

https://career.keal.com.bd/LoginRegistrationForm/admin/approveerrand?id=$id

Click this link for Deny Approve This Errand...

https://career.keal.com.bd/LoginRegistrationForm/admin/denyerrand?id=$id";


							$headers1 = 'From: '.$email_to."\r\n".
							 
							'Reply-To: '.$email_to."\r\n" .
							 
							'X-Mailer: PHP/' . phpversion();

							$email_subject1= "Errand Approval Request $date";
							$email_message1= "
Dear $userName,
Employee Id = $userId
Date = $date
Day  = $day
Errand = $errand_place_in
Errand From = $errand_from_in
Errand To =  $errand_to_in
Errand For = $errand_for_in
ServerIP = $serverIP

Please wait until HR approve your Errand
";

							$email_message2= 'Date'.$date."\r\n";
							mail("<$email_to>","$email_subject","$email_message","$headers");

							mail("<$email>","$email_subject1","$email_message1","$headers1");					
			
			}else{
				$msg = "Attendence Not Marked";
				return $msg;
			}
		
		}
}

public function getDescripancis($date, $uId){
    $query = "SELECT * FROM tbl_attendence WHERE userId = '$uId' AND attendence_date = '$date'";
    $result = $this->db->select($query);
    return $result;
}

// public function leaveApproveform($data, $uId){
// 	$fdate = $this->fm->validation($data['fdate']);
// 	$tdate = $this->fm->validation($data['tdate']);
// 	$approve = $this->fm->validation($data['approve']);

// 	$fdate = mysqli_real_escape_string($this->db->link, $fdate);
// 	$tdate = mysqli_real_escape_string($this->db->link, $tdate);
// 	$approve = mysqli_real_escape_string($this->db->link, $approve);

//     $mquery = "SELECT * FROM tbl_leaverequest WHERE userId = '$uId'";
//     $result = $this->db->select($mquery);
//     if($result){
//         while($row = $result->fetch_assoc()){
//             $reliveremail = $row['email'];
//             $lfdate = $row['leave_fdate'];
//             $ltdate = $row['leave_tdate'];
//             $reason = $row['reason'];
//             $note = $row['Dabout'];
//             $approval = $row['leave_approval'];
//         }
//     }
//     $Mquery = "SELECT * FROM employee WHERE userId = '$uId'";
// 	$result = $this->db->select($Mquery)->fetch_assoc();
// 	$email = $result['officeemail'];
// 	$userName = $result['user'];

//     $Rquery = "SELECT * FROM employee WHERE officeemail = '$reliveremail'";
// 	$resultrow = $this->db->select($Rquery)->fetch_assoc();
// 	$reliverName = $resultrow['user'];	
	
// 	$query = "UPDATE tbl_leaverequest SET 
// 	approve_fdate = '$fdate',
// 	approve_tdate = '$tdate',
// 	leave_approval = '$approve',
// 	status = '0'
// 	WHERE userId = '$uId'
// 	";
// 	$result = $this->db->update($query);
// 	if($result){
// 	 					
// 			 					
//                            

// 							$headers = 'From: '.$email."\r\n".
							 
// 							'Reply-To: '.$email."\r\n" .
							 
// 							'X-Mailer: PHP/' . phpversion();

// 							$email_to = "arnab.r@keal.com.bd";
// 							$email_subject= "Leave Request Approval";
// 							$email_message= "
// Dear $userName,
// Employee Id = $uId

// Leave From = $lfdate
// Leave To = $ltdate
// Leave_reason = $reason
// Reliever Name = $reliverName
// Reliever Email = $reliveremail
// Approve Form = $fdate
// Approve To = $tdate
// Leave Note = $note
// Leave Request = $approve

// ";


// 							$headers1 = 'From: '.$email_to."\r\n".
							 
// 							'Reply-To: '.$email_to."\r\n" .
							 
// 							'X-Mailer: PHP/' . phpversion();

// 							$email_subject1= "Leave Request Approval";
// 							$email_message1= "
// Dear $userName,
// Employee Id = $uId

// Leave From = $lfdate
// Leave To = $ltdate
// Leave_reason = $reason
// Reliever Name = $reliverName
// Reliever Email = $reliveremail
// Approve Form = $fdate
// Approve To = $tdate
// Leave Note = $note
// Leave Request = $approve

// ";

// 							$email_message2= 'Date'.$date."\r\n";
// 							mail("<$email_to>","$email_subject","$email_message","$headers");

// 							mail("<$email>","$email_subject1","$email_message1","$headers1");			
// 	}else{
// 	  	$msg = "Leave Not Approved";
// 	    return $msg;  
// 	}

// }
public function leaveApproveform($data, $uId, $lf, $lt, $cyear){
	$fdate = $this->fm->validation($data['fdate']);
	$tdate = $this->fm->validation($data['tdate']);
	$approve = $this->fm->validation($data['approve']);

	$fdate = mysqli_real_escape_string($this->db->link, $fdate);
	$tdate = mysqli_real_escape_string($this->db->link, $tdate);
	$approve = mysqli_real_escape_string($this->db->link, $approve);

    $mquery = "SELECT * FROM tbl_leaverequest WHERE userId = '$uId'";
    $result = $this->db->select($mquery);
    if($result){
        while($row = $result->fetch_assoc()){
            $reliveremail = $row['email'];
            $lfdate = $row['leave_fdate'];
            $ltdate = $row['leave_tdate'];
            $reason = $row['reason'];
            $note = $row['Dabout'];
            $approval = $row['leave_approval'];
        }
    }
    $Mquery = "SELECT * FROM employee WHERE userId = '$uId'";
	$result = $this->db->select($Mquery)->fetch_assoc();
	$email = $result['officeemail'];
	$userName = $result['user'];

    $Rquery = "SELECT * FROM employee WHERE officeemail = '$reliveremail'";
	$resultrow = $this->db->select($Rquery)->fetch_assoc();
	$reliverName = $resultrow['user'];	
	
	$query = "UPDATE tbl_leaverequest SET 
	approve_fdate = '$fdate',
	approve_tdate = '$tdate',
	leave_approval = '$approve',
	status = '0'
	WHERE userId = '$uId'
	";
	$result = $this->db->update($query);
	if($result){
	 							?>
			 					<script>var my_time = new Date(); alert('Leave Approval Request Responsed at '+my_time);
                        		window.location = 'leaverequest';
                      			  </script>
                            <?php

							$headers = 'From: '.$email."\r\n".
							 
							'Reply-To: '.$email."\r\n" .
							 
							'X-Mailer: PHP/' . phpversion();

							$email_to = "hr@keal.com.bd";
							$email_subject= "Leave Request Approval";
							$email_message= "
Dear $userName,
Employee Id = $uId
Leave From = $lfdate
Leave To = $ltdate
Leave_reason = $reason
Reliever Name = $reliverName
Reliever Email = $reliveremail
Approve Form = $fdate
Approve To = $tdate
Leave Note = $note
Leave Request = $approve

";


							$headers1 = 'From: '.$email_to."\r\n".
							 
							'Reply-To: '.$email_to."\r\n" .
							 
							'X-Mailer: PHP/' . phpversion();

							$email_subject1= "Leave Request Approval";
							$email_message1= "
Dear $userName,
Employee Id = $uId
Leave From = $lfdate
Leave To = $ltdate
Leave_reason = $reason
Reliever Name = $reliverName
Reliever Email = $reliveremail
Approve Form = $fdate
Approve To = $tdate
Leave Note = $note
Leave Request = $approve

";

							$email_message2= 'Date'.$date."\r\n";
							mail("<$email_to>","$email_subject","$email_message","$headers");

							mail("<$email>","$email_subject1","$email_message1","$headers1");			
	}else{
	  	$msg = "Leave Not Approved";
	    return $msg;  
	}
}
	public function getUserrequestdate($uId){
		$query = "SELECT * FROM tbl_leaverequest WHERE userId = '$uId' AND status = '1'";
		$result = $this->db->select($query);
		return $result;
	}
    
    public function lmarkupdate($data, $userId){
        $date = $this->fm->validation($data['appdate']);
        $date = mysqli_real_escape_string($this->db->link, $date);
        
        $query = "UPDATE tbl_attendence SET
                    lmark='1'
                    WHERE userId = '$userId' AND attendence_date = '$date'";
        $result = $this->db->update($query);
    }
    
    public function blockuser($econdition, $uId){
         $econdition = mysqli_real_escape_string($this->db->link, $econdition);
         
         if($econdition=="1"){
             $stat="0";
         }else{
             $stat="1";
         }
        $querys = "UPDATE employee SET stat = '$stat' 
        WHERE userId ='$uId'";
        $results = $this->db->update($querys);
    }
    
    public function getEmpLocation($uId){
         $query = "SELECT p.*, l.location_name FROM employee as p, tbl_location as l WHERE  p.locationid = l.id AND p.userId='$uId'";
        $qres = $this->db->select($query);
        return $qres;
    }
    public function updatecondition($econdition, $uId){
        
        $econdition = mysqli_real_escape_string($this->db->link, $econdition);
        
        $query = "UPDATE tbl_employee SET
                    estat = '$econdition'
                    WHERE userId = '$uId'";
        $result = $this->db->update($query);     
        
        if($result){
            $msg = "<span style='color:green;'>Employee Status Updated</span>";
            return $msg;
        }else{
              $msg = "<span style='color:red;'>Employee Status Not Updated</span>";
            return $msg;          
        }
    }
     public function updateconditiontwo($econdition, $uId){
        
        $econdition = mysqli_real_escape_string($this->db->link, $econdition);
        
        $query = "UPDATE tbl_allstaffs SET
                    estat = '$econdition'
                    WHERE userId = '$uId'";
        $result = $this->db->update($query);     
        if($result){
            $msg = "<span style='color:green;'>Employee Status Updated</span>";
            return $msg;
        }else{
              $msg = "<span style='color:red;'>Employee Status Not Updated</span>";
            return $msg;          
        }
    }   
    public function getemployeegrade($uId){
        $query = "SELECT p.*, g.grade FROM tbl_employee as p, tbl_egrade as g WHERE p.grade = g.si AND p.userId = '$userId'";
        $result = $this->db->select($query);
        return $result;
    }
    
    public function getlatedetails($date, $uId){
        $query = "SELECT * FROM  tbl_latecoming WHERE userId = '$uId' AND datee = '$date' AND hmark = '1'";
        $result = $this->db->select($query);
        return $result;
    }
    
    public function getemployeestatus($uId){
        $query = "SELECT * FROM tbl_employee WHERE userId = '$uId'";
        $result = $this->db->select($query);
        return $result;    
    }
 public function getstatusby($uId){
        $query = "SELECT p.*, e.estat FROM tbl_employee as p, tbl_estatus as e WHERE p.employeestat = e.id AND p.userId = '$uId'";
        $result = $this->db->select($query);
        return $result;     
 } 
 
 public function getlocationstatusby($uId){
           $query = "SELECT p.*, l.location_name FROM employee as p, tbl_location as l WHERE p.locationId = l.id AND p.userId = '$uId'";
   $result = $this->db->select($query);
   return $result;    
 }
 
     public function getyearsdataby($yr){
        $query = "SELECT * FROM  tbl_ph WHERE years='$yr'";
        $result = $this->db->select($query);
        return $result; 
    }
    
//new

 //new

 public function getEmployestage(){
        $query = "SELECT * FROM tbl_employement_stage";
        $result = $this->db->select($query);
        return $result;   	
 }

 public function employeementstage($uId, $username, $defultInTime, $defultOuttime, $Ephase, $grade, $Sdate, $Edate,$serverIP){
 	$uId = mysqli_real_escape_string($this->db->link, $uId);
 	$username = mysqli_real_escape_string($this->db->link, $username);
 	$defultInTime = mysqli_real_escape_string($this->db->link, $defultInTime);
 	$defultOuttime = mysqli_real_escape_string($this->db->link, $defultOuttime);
 	$Ephase = mysqli_real_escape_string($this->db->link, $Ephase);
 	$grade = mysqli_real_escape_string($this->db->link, $grade);
 	$Sdate = mysqli_real_escape_string($this->db->link, $Sdate);
 	$Edate = mysqli_real_escape_string($this->db->link, $Edate);

 	$gquery = "SELECT * FROM tbl_egrade WHERE si ='$grade'";
 	$gresult = $this->db->select($gquery);
 	if ($gresult) {
 		while($dgs = $gresult->fetch_assoc()){
 			$grade = $dgs['grade'];
 			$designation = $dgs['designation'];
 		}
 	}
 	$Equery = "SELECT * FROM tbl_employement_stage WHERE id ='$Ephase'";
 	$eresult = $this->db->select($Equery);
 	if ($eresult) {
 		while($dgss = $eresult->fetch_assoc()){
 			$entitle = $dgss['entitlement'];
 		}
 	}
 	// $cquery = "SELECT * FROM tbl_stage WHERE ephase='$Ephase' AND startDate ='$Sdate' AND endDate ='$Edate' AND userId = '$uId'";
 	// $cresult = $this->db->select($cquery);
 	// if ($gresult) {
 	// 	$msg = "Sorry You have Already Upgade This Phase!!";
 	// 	return $msg;
 	// }else{
 	$query = "INSERT INTO tbl_stage(userId, uname, intime, outtime, ephase, designation, grade, startDate, endDate, ips, entitlement) VALUES('$uId', '$username', '$defultInTime', '$defultOuttime', '$Ephase', '$designation', '$grade', '$Sdate', '$Edate', '$serverIP', '$entitle')";
 	$result = $this->db->insert($query);
 	if ($result) {
 		$msg = "Employment Stage Updated Successfully!!";
 		return $msg;
 	}else{
 		$msg = "Employment Stage Not Updated Successfully!!";
 		return $msg; 		
 	} 		
 	// }
 }
public function updateemployeesgrade($uId, $grade, $Ephase){
	$uId = mysqli_real_escape_string($this->db->link, $uId);
	$grade = mysqli_real_escape_string($this->db->link, $grade);
	$uId = mysqli_real_escape_string($this->db->link, $uId);
 	

 	$Equery = "SELECT * FROM tbl_employement_stage WHERE id ='$Ephase'";
 	$eresult = $this->db->select($Equery);
 	if ($eresult) {
 		while($dgss = $eresult->fetch_assoc()){
 			$entitle = $dgss['entitlement'];
 		}
 	}

	$query = "UPDATE tbl_employee SET grade='$grade', entil='$entitle' WHERE userId = '$uId'";
	$uquery = $this->db->update($query);
	
}


 public function getemployephase($uId){
 	$gquery = "SELECT p.*, e.employement_stage, e.entitlement FROM tbl_stage as p, tbl_employement_stage as e WHERE p.ephase=e.id AND p.userId='$uId'";
 	$gresult = $this->db->select($gquery);
 	return $gresult;
 }


 public function getEmployeleavepettern($uId){
 	    $query = "SELECT * FROM tbl_stage WHERE userId = '$uId'";
        $result = $this->db->select($query);
        return $result;    
 }

 public function getEmployeleavephase($ephase, $uId){
 	 	$query = "SELECT * FROM tbl_employement_stage WHERE id = '$ephase'";
        $result = $this->db->select($query);
        return $result; 
 }

 public function getEmployeleaverq($uId){
  	 	$query = "SELECT * FROM tbl_leaverequest WHERE userId = '$uId'";
        $result = $this->db->select($query);
        return $result;	
 }

public function calEmployeleaveday($approve_fdate, $approve_tdate){
	$query ="SELECT '$approve_fdate' as Checkin  , '$approve_tdate' as Checkout,  (TO_DAYS( '$approve_tdate')-TO_DAYS( '$approve_tdate') )as No_of_Days";
	$result = $this->db->select($query);
	return $result;
}

// public function Createopenbalance($opening, $uId, $month, $year){
// 	$open = mysqli_real_escape_string($this->db->link, $opening);
// 	$uId = mysqli_real_escape_string($this->db->link, $uId);

//  	    $query = "SELECT * FROM tbl_stage WHERE userId = '$uId'";
//         $result = $this->db->select($query);
//         if ($result) {
//         	while ($deta = $result->fetch_assoc()) {
//         		$entitlement = $deta['entitlement'];
//         	}
//         }

//         $permonth = $entitlement/12;

// 	if ($open=="") {
// 		$msg = "Please Insert Open Balance!!";
// 		return $msg;
// 	}else{
// 		$query = "INSERT INTO tbl_leavesheet(userId, opening, lYear, leaveYear, leavemonthname, leaveMonth) VALUES('$uId', '$opening', '$year', '$entitlement', '$month', '$permonth')";
// 		$result = $this->db->insert($query);
// 		if ($result) {
// 			$msg = "Opening Balance Has been Set Successfully!!";
// 			return $msg;
// 		}else{
// 			$msg = "Opening Balance Not Set Successfully!!";
// 			return $msg;
// 		}
// 	}

// }


public function Createopenbalance($opening, $uId, $month, $year){
	$open = mysqli_real_escape_string($this->db->link, $opening);
	$uId = mysqli_real_escape_string($this->db->link, $uId);

 	    $query = "SELECT * FROM tbl_stage WHERE userId = '$uId'";
        $result = $this->db->select($query);
        if ($result) {
        	while ($deta = $result->fetch_assoc()) {
        		$entitlement = $deta['entitlement'];
        	}
        }

        $permonth = $entitlement/12;

	if ($open=="") {
		$msg = "Please Insert Open Balance!!";
		return $msg;
	}else{
		$query = "INSERT INTO tbl_openbalance(userId, opening, years, entile) VALUES('$uId', '$opening', '$year',  '$entitlement')";
		$result = $this->db->insert($query);
		if ($result) {
			$msg = "Opening Balance Has been Set Successfully!!";
			return $msg;
		}else{
			$msg = "Opening Balance Not Set Successfully!!";
			return $msg;
		}
	}

}


// public function leaveaccountApproveform($data, $uId, $year, $monthname){
// 	$fdate = $this->fm->validation($data['fdate']);
// 	$tdate = $this->fm->validation($data['tdate']);
// 	$approve = $this->fm->validation($data['approve']);

// 	$fdate = mysqli_real_escape_string($this->db->link, $fdate);
// 	$tdate = mysqli_real_escape_string($this->db->link, $tdate);
// 	$approve = mysqli_real_escape_string($this->db->link, $approve);
	
// 	//calculate days number
// 	 $earlier = new DateTime($fdate);
//  	 $later = new DateTime($tdate);

//  	 $diff = $later->diff($earlier)->format("%a");
//  	 $tot = $diff+1;

//  	    $query = "SELECT * FROM tbl_leavesheet WHERE userId = '$uId'";
//         $result = $this->db->select($query);
//         if ($result) {
//         	while ($deta = $result->fetch_assoc()) {
//         		$opening = $deta['opening'];
//         		$previous = $deta['previous'];
//         		$leaveMonth = $deta['leaveMonth'];
//         	}
//         }

//         $balance = $opening+$previous+$leaveMonth-$tot;
// 	$query = "UPDATE tbl_leavesheet SET 
// 	lYear = '$year',
// 	leaveMonthname = '$monthname',
// 	leaveTaken = '$tot',
// 	Balence = '$balance'
// 	WHERE userId = '$uId'";
// 	$result = $this->db->update($query);
// }

public function leaveaccountApproveform($data, $uId, $year, $monthname){
	$fdate = $this->fm->validation($data['fdate']);
	$tdate = $this->fm->validation($data['tdate']);
	$approve = $this->fm->validation($data['approve']);
	$fdatemonth = $this->fm->validation($data['fdatemonth']);
	$tdatemonth = $this->fm->validation($data['tdatemonth']);

	$fdate = mysqli_real_escape_string($this->db->link, $fdate);
	$tdate = mysqli_real_escape_string($this->db->link, $tdate);
	$approve = mysqli_real_escape_string($this->db->link, $approve);
	$fdatemonth = mysqli_real_escape_string($this->db->link, $fdatemonth); 
	$tdatemonth = mysqli_real_escape_string($this->db->link, $tdatemonth);
	
	//calculate days number
	 $earlier = new DateTime($fdate);
 	 $later = new DateTime($tdate);

 	 $diff = $later->diff($earlier)->format("%a");
 	 $totalleave = $diff+1;

	// leave balance
 	    // $query = "SELECT * FROM tbl_leavesheet WHERE userId = '$uId' AND ip='1'";
      //   $result = $this->db->select($query);
      //   if ($result) {
      //   	while ($deta = $result->fetch_assoc()) {
      //   		$opening = $deta['opening'];
        	
      //   		$leaveTaken = $deta['leaveTaken'];
      //   		$leaveMonth = "2";
      //   		$pBalance = $deta['Balence'];
      //   	}
      //   }else{
      //   	$opening = "0";
      //   	$leaveMonth = "2";
      //   	$leaveTaken = "0";
      //   	$pBalance = "0";
      //   }
      //   $blnctwo = $opening+$leaveMonth;
      //   $blncfinal = $blnctwo-$leaveTaken;

// Get open balance

 	    $query = "SELECT * FROM tbl_openbalance WHERE userId = '$uId' AND years='$year'";
        $result = $this->db->select($query);
        if ($result) {
        	while ($deta = $result->fetch_assoc()) {
        		$openings = $deta['opening'];
        		$years = $deta['years'];
        		$entile = $deta['entile'];
        	}
        }


 	$permonth = $entile/12;

$blnc = $openings+$permonth-$totalleave;
	$query = "INSERT INTO tbl_leavesheet(userId, opening, lYear, leaveYear, leaveMonthname, leaveMonth, currentMonthf, currentMontht, leaveTaken, Balence, approval, ip) VALUES('$uId', '$openings',  '$years', '$entile', '$monthname', '$permonth', '$fdatemonth', '$tdatemonth', '$totalleave', '$blnc', '$approve', '1')";
	$result = $this->db->insert($query);
	if ($result) {
		$msg = "Success";
		return $msg;
	}else{
		$msg = "Not Success";
		return $msg;		
	}
}

    // public function getyearsdataby(){
    //     $query = "SELECT * FROM  tbl_ph ORDER BY id DESC";
    //     $result = $this->db->select($query);
    //     return $result; 
    // }


   public function getleavebalancedata($uId){
   	 	    $query = "SELECT * FROM tbl_leavesheet WHERE userId = '$uId'  AND ip='1'";
        $result = $this->db->select($query);
  		return $result;
   }

   public function leaveaccountApproveformsetdata($user, $date){
 //   	$user = mysqli_real_escape_string($this->db->link, $user);
	// $open = mysqli_real_escape_string($this->db->link, $open);
	// $currentyear = mysqli_real_escape_string($this->db->link, $currentyear);
	// $peryear = mysqli_real_escape_string($this->db->link, $perYear);
	// $monthname = mysqli_real_escape_string($this->db->link, $monthname); 
	// $leaveTaken = mysqli_real_escape_string($this->db->link, $leaveTaken);	
	// $accrue = mysqli_real_escape_string($this->db->link, $accrue);	
	// $pbalance = mysqli_real_escape_string($this->db->link, $pbalance);	


	 $query = "INSERT INTO tbl_leavesheetdata(userId, ddate) VALUES('$user', '$date')";
	 $insert_data = $this->db->insert($query);

// update query
	 $squery = "SELECT * FROM tbl_leavesheetdata WHERE userId = '$user'";
	 $selectdata = $this->db->select($squery);
	 if ($selectdata) {
	 	$query = "UPDATE tbl_leavesheetdata SET status='0' WHERE userId='$user'";
	 	$update_row=$this->db->update($query);	
	 }

   }

  public function getleavebalancedataforpre($uId){
  	$query = "SELECT * FROM tbl_leavesheetdata WHERE userId ='$uId' ORDER BY id DESC";
  	$pquery = $this->db->select($query);
  	return $pquery;
  }

  public function leaveaccountApproveformshift($user, $openb, $lyear, $leaveYear, $leaveMonth, $leaveTaken, $blncfinal, $date){
  	$user = mysqli_real_escape_string($this->db->link, $user);
  	$openb = mysqli_real_escape_string($this->db->link, $openb);
  	$prev = mysqli_real_escape_string($this->db->link, $prev);
  	$lyear = mysqli_real_escape_string($this->db->link, $lyear);
  	$leaveYear = mysqli_real_escape_string($this->db->link, $leaveYear);
  	$leaveMonth = mysqli_real_escape_string($this->db->link, $leaveMonth);
  	$leaveTaken = mysqli_real_escape_string($this->db->link, $leaveTaken);
  	$blncfinal = mysqli_real_escape_string($this->db->link, $blncfinal);

  	$query = "INSERT into tbl_leavesheetdata(userId, opening, leaveYear, 	leaveMonth, leaveTaken, Balence, ddate, status) VALUES('$user', '$openb', '$leaveYear', '$leaveMonth', '$leaveTaken', '$blncfinal', '$date', '1')";
  	$result = $this->db->insert($query);
  	if ($result) {
  		$msg = "shifted datas";
  		return $msg;
  	}else{
   		$msg = "Not shifted datas";
  		return $msg; 		
  	}

  }

public function leaveaccountApproveformshifttest($user, $openb, $lyear, $leaveYear, $leaveMonth, $leaveTaken, $blncfinal, $sdate){

	$user = mysqli_real_escape_string($this->db->link, $user);
  	$openb = mysqli_real_escape_string($this->db->link, $openb);
  	$lyear = mysqli_real_escape_string($this->db->link, $lyear);
  	$leaveYear = mysqli_real_escape_string($this->db->link, $leaveYear);
  	$leaveMonth = mysqli_real_escape_string($this->db->link, $leaveMonth);
  	$leaveTaken = mysqli_real_escape_string($this->db->link, $leaveTaken);
  	$blncfinal = mysqli_real_escape_string($this->db->link, $blncfinal);
  	$sdate = mysqli_real_escape_string($this->db->link, $sdate);

  	$uquery = "UPDATE tbl_leavesheetdata SET
  				opening   ='$openb',
  				leaveYear ='$leaveYear',
  				leaveMonth='$leaveMonth',
  				leaveTaken='$leaveTaken',
  				Balence   ='$blncfinal',
  				status='1'
  				WHERE userId='$user' AND ddate='$sdate';
  				";
  	$uresult = $this->db->update($uquery);

}
  public function getleavebalancedate($uId){
  	$query = "SELECT * FROM tbl_leavesheetdata WHERE userId ='$uId' ORDER BY id DESC LIMIT 1";
  	$pquery = $this->db->select($query);
  	return $pquery;
  }

  public function getallentitled(){
  	$query = "SELECT * FROM tbl_stage ORDER BY id DESC";
  	$result = $this->db->select($query);
  	return $result;
  }

  public function getallmonths(){
  	$query = "SELECT * FROM tbl_month ORDER BY id ASC";
  	$result = $this->db->select($query);
  	return $result;
  }

  public function getleavesummuryby($uId, $mof, $mot, $year){
  	$query = "SELECT * FROM tbl_leavesheet WHERE (leaveMonthname BETWEEN '$mof' AND '$mot') AND lYear='$year'";
  	$result=$this->db->select($query);
  	return $result;
  }

  public function getallentitledby($uId){
    $query = "SELECT * FROM tbl_stage WHERE userId='$uId'";
  	$result = $this->db->select($query);
  	return $result;	
  }

  public function getopenbalancedata($uId,$year){
    $query = "SELECT * FROM tbl_openbalance WHERE userId='$uId' AND years='$year'";
  	$result = $this->db->select($query);
  	return $result;	  	
  }

  public function getempstagedata($uId,$year){
     $query = "SELECT * FROM tbl_stage WHERE userId='$uId'";
  	$result = $this->db->select($query);
  	return $result;	 	
  }


//   public function leaveaccountApproveformsetdatatwo($data, $user, $open, $currentyear, $entitlement, $monthname, $leaveTaken, $accrue, $pbalance, $approve){
//   	$fdate = $this->fm->validation($data['fdate']);
//   	$tdate = $this->fm->validation($data['tdate']);

//   	$user = mysqli_real_escape_string($this->db->link, $user);
//   	$open = mysqli_real_escape_string($this->db->link, $open);
//   	$currentyear = mysqli_real_escape_string($this->db->link, $currentyear);
//   	$entitlement = mysqli_real_escape_string($this->db->link, $entitlement);
//   	$monthname = mysqli_real_escape_string($this->db->link, $monthname);
//   	$leaveTaken = mysqli_real_escape_string($this->db->link, $leaveTaken);
//   	$accrue = mysqli_real_escape_string($this->db->link, $accrue);
//   	$pbalance = mysqli_real_escape_string($this->db->link, $pbalance);
//   	$approve_fdate = mysqli_real_escape_string($this->db->link, $fdate);
//   	$approve_tdate = mysqli_real_escape_string($this->db->link, $tdate);
//   	$approve = mysqli_real_escape_string($this->db->link, $approve);

//      $earlier = new DateTime($approve_fdate);
//  $later = new DateTime($approve_tdate);

//  $diff = $later->diff($earlier)->format("%a");
//  $tot = $diff+1;
//  // echo $tot .'&nbsp;'."Days";


// $query = "INSERT INTO tbl_leavesheet(userId, opening, lYear, leaveYear, leaveMonthname,
// fdate, tdate, leaveMonth, leaveTaken, Balence, approval) VALUES('$user', '$open', '$currentyear', '$entitlement', '$monthname', '$approve_fdate', '$approve_tdate', '$accrue', '$tot', '$pbalance', '$approve')";
// $result = $this->db->insert($query);
// if($result){
// 	$msg = "Successfully Inserted";
// 	return $msg;
// }else{
// 	$msg = "Not Successfully Inserted";
// 	return $msg;	
// }

//   }


  public function leaveaccountApproveformsetdatatwo($data, $uId, $year,  $monthfor, $monthname, $date, $day){
  	$approve_fdate = $this->fm->validation($data['fdate']);
  	$approve_tdate = $this->fm->validation($data['tdate']);
  	$approve = $this->fm->validation($data['approve']);

  	$user = mysqli_real_escape_string($this->db->link, $uId);
  	$year = mysqli_real_escape_string($this->db->link, $year);
  	$monthfor = mysqli_real_escape_string($this->db->link, $monthfor);
  	$approve = mysqli_real_escape_string($this->db->link, $approve);
  	$monthname = mysqli_real_escape_string($this->db->link, $monthname);
  	$date = mysqli_real_escape_string($this->db->link, $date);
  	$day = mysqli_real_escape_string($this->db->link, $day);


 $earlier = new DateTime($approve_fdate);
 $later = new DateTime($approve_tdate);

 $diff = $later->diff($earlier)->format("%a");
 $tot = $diff+1;

    $query = "SELECT * FROM tbl_openbalance WHERE userId = '$user' AND years='$year'";
    $result = $this->db->select($query);
    if ($result) {
    	while ($deta = $result->fetch_assoc()) {
    		$opening = $deta['opening'];
       	}
    }


    $query = "SELECT * FROM tbl_stage WHERE userId = '$user'";
    $result = $this->db->select($query);
    if ($result) {
    	while ($deta = $result->fetch_assoc()) {
    		$entitlement = $deta['entitlement'];
       	}
    }
    $accrue =  $entitlement/12;

$blnc = $opening+$accrue-$tot;

//ph calculation
  	$querysph = "SELECT * FROM tbl_ph WHERE (`datee` BETWEEN '$approve_fdate' AND '$approve_tdate') AND years='$year'";
  	$resultph = $this->db->select($querysph);
  	if ($resultph) {
  		$total_rows = mysqli_num_rows($resultph);
  	}else{
  		$total_rows = "0";
  	}
    


$query = "INSERT INTO tbl_leavesheet(userId, opening, lYear, leaveYear, leaveMonthname,
 fdate, tdate, currentMonthf, leaveMonth, leaveTaken, Balence, approval, phdays, day, ddate, stat) VALUES('$user', '$opening', '$year', '$entitlement', '$monthfor', '$approve_fdate', '$approve_tdate', '$monthname', '$accrue', '$tot', '$blnc', '$approve', '$total_rows', '$day', '$date', '1')";
$result = $this->db->insert($query);
 if ($result) {
 	$msg = "Success";
 	return $msg;
 }else{
 	$msg = "Not Success";
 	return $msg; 	
 }

  }

public function sethrragulation($data, $uId, $currentyear, $currentdate, $currenttime, $currentmonth){
	$open = $this->fm->validation($data['open']);
	$snotes = $this->fm->validation($data['snotes']);
	$open = mysqli_real_escape_string($this->db->link, $open);
	$snotes = mysqli_real_escape_string($this->db->link, $snotes);

	$equery = "SELECT * FROM tbl_stage WHERE userId='$uId'";
	$result = $this->db->select($equery);
	if ($result) {
		while($set = $result->fetch_assoc()){
			$entitlement = $set['entitlement'];
		}
	}

	if ($open==""||$snotes=="") {
		$msg = "Dont leave Blank Field!!";
		return $msg;
	}else{
		$query = "INSERT INTO tbl_openbalance(userId, opening, snotes, years, ddate, entile, cyear, cdate, ctime) VALUES('$uId', '$open', '$snotes', '$currentyear', '$currentdate', '$entitlement', '$currentyear', '$currentdate', '$currenttime')";
		$insert_row=$this->db->insert($query);
		if ($insert_row) {
			 							?>
			 					<script>var my_time = new Date(); alert('HR Note Recorded at '+my_time);
                        		window.location = 'leavegrid';
                      			  </script>
                            <?php
		}
	}
}
  // public function getphby($year, $approve_fdate, $approve_tdate){
  // 	$query = "SELECT * FROM tbl_ph WHERE (datee BETWEEN '$approve_fdate' AND '$approve_tdate') AND years='$year'";
  // 	$result = $this->db->select($query);
  //   $total_rows = mysqli_num_rows($result);
  //   return $total_rows;
  // }
 public function getleavecalculateby($uId, $approve_fdate, $approve_tdate){
 	$query = "SELECT * FROM tbl_leavesheet WHERE fdate='$approve_fdate' AND tdate='$approve_tdate' AND userId = '$uId' AND stat='1'";
 	$result = $this->db->select($query);
 	return $result;
 }

 public function sethrremarks($userId, $year, $month, $fdate, $tdate, $blnc, $ph, $ihr, $dhr){
 	$dhr = mysqli_real_escape_string($this->db->link, $dhr);
 	$ihr = mysqli_real_escape_string($this->db->link, $ihr);
 	$userId = mysqli_real_escape_string($this->db->link, $userId);
 	$lyear = mysqli_real_escape_string($this->db->link, $year);
 	$leaveMonthname = mysqli_real_escape_string($this->db->link, $month);
 	$approve_fdate = mysqli_real_escape_string($this->db->link, $fdate);
 	$approve_tdate = mysqli_real_escape_string($this->db->link, $tdate);
 	$balance = mysqli_real_escape_string($this->db->link, $blnc);
 	$phdays = mysqli_real_escape_string($this->db->link, $ph);

 	$uquery = "UPDATE tbl_leavesheet SET stat='0' WHERE userId='$userId' AND lyear='$lyear'
 	AND leaveMonthname ='$leaveMonthname' AND fdate='$approve_fdate' AND tdate='$approve_tdate'";
 	$update_row = $this->db->update($uquery);

 	$query = "INSERT INTO tbl_leavesummary(userId, years, monthname, leaveFrom, leaveTo, balance, phdays, InclusionByHR, DeductionbyHR) VALUES('$userId', '$lyear', '$leaveMonthname', '$approve_fdate', '$approve_tdate', '$balance', '$phdays', '$ihr', '$dhr')";
 	$insert_rows = $this->db->insert($query);
 	if ($insert_rows) {
 		$msg = "Inserted Successfully";
 		return $msg;
 	}else{
  		$msg = "Not Inserted Successfully";
 		return $msg;		
 	}
 }

 public function getleavefinalsummuryby($uId, $mof, $mot, $year){
  	$query = "SELECT * FROM  tbl_leavesummary WHERE (monthname BETWEEN '$mof' AND '$mot') AND years='$year'";
  	$result=$this->db->select($query);
  	return $result; 	
 }
 
  public function updateemployeegradeinfo($grade, $Sdate, $Edate, $uId, $date, $serverIP){
	$equery = "SELECT * FROM tbl_egrade WHERE grade='$grade'";
	$result = $this->db->select($equery);
	if ($result) {
		while($setd = $result->fetch_assoc()){
			$designation = $setd['designation'];
		}
	}

if (empty($grade)) {
		$msg = "Field must not be Empty!";
 		return $msg;
	}else{

	 	$gquery =  "INSERT INTO tbl_egradestatus(userId, grade, cdate, sdate, edate, designation, sip) VALUES('$uId', '$grade', '$date', '$Sdate', '$Edate', '$designation', '$serverIP')";
	 	$insert_rows = $this->db->insert($gquery);

	  	$uquery = "UPDATE tbl_allstaffs SET grade='$grade' WHERE userId='$uId'";
	 	$update_row = $this->db->update($uquery);
	 	
	 	$equery = "UPDATE tbl_employee SET grade='$grade' WHERE userId='$uId'";
	 	$update_erow = $this->db->update($equery);	

	 	if ($update_erow) {
	 		echo "<script>window.location='empprofset?userId=$uId'</script>";
	 	}else{
	  		$msg = "Grade Not updated Successfully";
	 		return $msg;		
	 	}
 	}
 }

 public function getemployegradestat($uId){
   	$query = "SELECT * FROM  tbl_egradestatus WHERE userId='$uId'";
  	$result=$this->db->select($query);
  	return $result; 	
 }

public function insertUcStatus($estat, $uId, $date){
	if (empty($estat)) {
		$msg = "Field must not be Empty!";
 		return $msg;
	}else{
		$gquery =  "INSERT INTO tbl_emrecord(userId, estat, adate) VALUES('$uId', '$estat', '$date')";
	 	$insert_rows = $this->db->insert($gquery);

	  	$uquery = "UPDATE tbl_allstaffs SET employeestat='$estat' WHERE userId='$uId'";
	 	$update_row = $this->db->update($uquery);
	 	
	 	$equery = "UPDATE tbl_employee SET employeestat='$estat' WHERE userId='$uId'";
	 	$update_erow = $this->db->update($equery);

	 	if ($update_erow) {
	 		echo "<script>window.location='empprofset?userId=$uId'</script>";
	 	}else{
	  		$msg = "Employee Condition Not updated Successfully";
	 		return $msg;		
	 	}
	}

	
}

public function updateeLStatus($elstat, $uId, $date){
	 	$equery = "UPDATE employee SET locationId='$elstat' WHERE userId='$uId'";
	 	$update_erow = $this->db->update($equery);

	 	if ($update_erow) {
	 		echo "<script>window.location='empprofset?userId=$uId'</script>";
	 	}else{
	  		$msg = "Employee Loation Not updated Successfully";
	 		return $msg;		
	 	}    
}

public function getEmpCondition($uId){
	$query = "SELECT a.*, b.estat FROM  tbl_emrecord AS a, tbl_estatus AS b WHERE a.estat = b.id AND userId='$uId'";
  	$result=$this->db->select($query);
  	return $result;
}

public function geteincomstatus(){
    $query = "SELECT * FROM  tbl_intern_complete";
  	$result=$this->db->select($query);
  	return $result;    
}
}//main class