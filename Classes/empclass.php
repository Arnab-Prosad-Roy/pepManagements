<?php include_once "../lib/Database.php"; ?>
<?php include_once "lib/Format.php"; ?>


<?php
	/**
	* 
	*/
	class Employee
	{
		private $db;
		private $fm;

		public function __construct()
	
		{
			$this->db = new Database();
			$this->fm = new Format();
		}
	
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

public function getEmployeimages($uId){
    	$query = "SELECT * FROM employee WHERE userId ='$uId'";
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
	public function getemployeeinfo($uId){
		$query = "SELECT p.*, g.grade, g.grade FROM tbl_employeeinformation as p, tbl_egrade as g
		WHERE p.grade = g.si AND employeeId='$uId'";
		$reso = $this->db->select($query);
		return $reso;		
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
		public function updateemployeeinfo($joiningdate, $grade, $uId){
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

					$query = "INSERT INTO tbl_employeeinformation(employeeId, email, phone, grade, joindate) VALUES('$uId', '$officeemail', '$phone', '$grade', '$joiningdate')";
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
		public function getgradelist(){
			$query = "SELECT * FROM tbl_egrade";
			$res = $this->db->select($query);
			return $res;
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
								$msg = "<span style='color:green'>Status Update</span>";
								return $msg;
						}else{
						$msg = "<span style='color:red'>grade Not Select</span>";
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
	public function getestatus(){
		$query = "SELECT * FROM tbl_estatus";
		$res = $this->db->select($query);
		return $res;
	}
}