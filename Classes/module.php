<?php include_once "lib/Database.php"; ?>
<?php include_once "../helpers/Format.php"; ?>
<?php include_once "lib/Session.php"; ?>

<?php
	/**
	* 
	*/
	class Module
	{
		private $db;
		private $fm;

		public function __construct()
	
		{
			$this->db = new Database();
			$this->fm = new Format();
		}	

		public function degreeCreate($data){
			$degName = $this->fm->validation($data['degName']);
			$degName	= mysqli_real_escape_string($this->db->link, $degName);

			if ($degName == "") {
				$msg = "Field Must Not Be Empty!!";
				return $msg;

			}
				$dgquery = "SELECT * FROM tbl_degree WHERE degName = '$degName' LIMIT 1";
				$dgchk   = $this->db->select($dgquery);
				if ($dgchk != false) {
					$msg = "<span style='color:red'>Degree Already exist!!</span>";
					return $msg;
					//email unique has done

				} else {
					$query  = "INSERT INTO tbl_degree(degName) VALUES ('$degName')";
					$result = $this->db->insert($query);
					if ($result) {
						$msg = "Degree Name Inserted";
						return $msg;
					}else{
						$msg = "Degree Name Not Inserted";
						return $msg;
				}
			}
		}


		public function departmentCreate($data){
			$deptName 	 = $this->fm->validation($data['deptName']);
			$description = $this->fm->validation($data['description']);

			$deptName = mysqli_real_escape_string($this->db->link, $deptName);
			$description = mysqli_real_escape_string($this->db->link, $description);

			if ($deptName == "" || $description == "") {
				$msg = "<span style='color:green'>Department Name Is Empty!!</span>";
						return $msg;
			}
			$dpquery = "SELECT * FROM tbl_department WHERE deptName = '$deptName' LIMIT 1";
				$dpchk   = $this->db->select($dpquery);
				if ($dpchk != false) {
					$msg = "<span style='color:red'>Department Already exist!!</span>";
					return $msg;
					//email unique has done

				} else {
					$query  = "INSERT INTO tbl_department(deptName, description) VALUES ('$deptName', '$description')";
					$result = $this->db->insert($query);
					if ($result) {
						$msg = "Department Name Inserted";
						return $msg;
					}else{
						$msg = "Department Name Not Inserted";
						return $msg;
				}
			}
		}

        public function getRegisDate($uId){
            $query ="SELECT * FROM tbl_user_reg WHERE regId = '$uId'";
			$result = $this->db->select($query);
			return ($result);
        }
        
        public function getinterdate($uId, $jId){
            $query = "SELECT * FROM tbl_interview WHERE userId = '$uId' AND jId = '$jId'";
			$result = $this->db->select($query);
			return $result;
        }
        public function getapplydate($uId, $jId){
            $query = "SELECT * FROM tbl_apply WHERE userId = '$uId' AND jId = '$jId'";
			$result = $this->db->select($query);
			return $result;
        }
		public function getAlljobs(){
			$query ="SELECT * FROM tbl_jobtitle ORDER BY jid DESC";
			$result = $this->db->select($query);
			return ($result);
		}

		public function getAllDept(){
			$query ="SELECT * FROM tbl_department ORDER BY dId DESC";
			$result = $this->db->select($query);
			return ($result);
		}
		public function getMinimumedu(){
			$query ="SELECT * FROM tbl_degree ORDER BY degId DESC";
			$result = $this->db->select($query);
			return ($result);
		}

		public function getJoblevel(){
			$query = "SELECT * FROM tbl_job_level ORDER BY levelId DESC";
			$result = $this->db->select($query);
			return ($result);
		}
		/*public function createJob($input){
			$jobtitle = $this->fm->validation($input['jobtitle']);
			$description = $this->fm->validation($input['description']);

			$jobtitle = mysqli_real_escape_string($this->db->link, $jobtitle);
			$description = mysqli_real_escape_string($this->db->link, $description);

			if ($jobtitle == "" || $description == "") {
				$msg = "Field Must Not be Empty!!";
				return $msg;
			}else{
				$query = "INSERT INTO tbl_jobtitle(jobtitle, description) VALUES('$jobtitle', '$description')";
				$result = $this->db->insert($query);
				if ($result) {
					$msg = "Job Created Successfully";
					return $msg;
				}else{
					$msg = "Job Not Created Successfully";
					return $msg;
				}
			}
		}*/

	public function jobInput($data){
			$jId 		= 	$this->fm->validation($data['jId']);
			$dId 		= 	$this->fm->validation($data['dId']);
			$batch 		= 	$this->fm->validation($data['batch']);
			$levelId 		= 	$this->fm->validation($data['levelId']);
			$ldApplication = $this->fm->validation($data['ldApplication']);
			$degId 		= 	$this->fm->validation($data['degId']);
			//$joblocation 		= 	$this->fm->validation($data['joblocation']);
			$mimcomp 		= 	$this->fm->validation($data['mimcomp']);
			$mxmcomp 		= 	$this->fm->validation($data['mxmcomp']);
			
			$expDate 	= 	$this->fm->validation($data['expDate']);
			$prerequisite = $this->fm->validation($data['prerequisite']);
			$joblocation = $this->fm->validation($data['joblocation']);

			$jId = mysqli_real_escape_string($this->db->link, $jId);
			$dId = mysqli_real_escape_string($this->db->link, $dId);
			$batch = mysqli_real_escape_string($this->db->link, $batch);
			$levelId = mysqli_real_escape_string($this->db->link, $levelId);
			$ldApplication = mysqli_real_escape_string($this->db->link, $ldApplication);
			$degId = mysqli_real_escape_string($this->db->link, $degId);
			//$joblocation = mysqli_real_escape_string($this->db->link, $joblocation);
			$mimcomp = mysqli_real_escape_string($this->db->link, $mimcomp);
			$mxmcomp = mysqli_real_escape_string($this->db->link, $mxmcomp);
			$expDate = mysqli_real_escape_string($this->db->link, $expDate);
			$prerequisite = mysqli_real_escape_string($this->db->link, $prerequisite);
			$joblocation = mysqli_real_escape_string($this->db->link, $joblocation);
            $bquery = "SELECT batch FROM tbl_store_job WHERE jId = '$jId'";
            $res = $this->db->select($bquery);
            if($res){
                while($data = $res->fetch_assoc()){
                    $batchn = $data['batch'];
                }
            }if($batchn == $batch){
                 $msg = "<span style='color:green'>Batch Already Exists!!</span>";
                return $msg;
            }else{
				$query = "INSERT INTO tbl_store_job(jId,jobId, dId, deptId, batch, levelId, ldApplication, degId, mimcomp, mxmcomp, expDate, prerequisite, joblocation) VALUES('$jId', '$jId', '$dId', '$dId', '$batch', '$levelId', '$ldApplication', '$degId',
				'$mimcomp', '$mxmcomp', '$expDate', '$prerequisite','$joblocation')";
				$result = $this->db->insert($query);
				if ($result) {
					$msg = "Record Successfully";
					return $msg;
				}else{
					$msg = "Record Not Successfully";
					return $msg;
				}
            }
		}
    //job post update query
  	public function getAllData($jId){
			$query = "SELECT p.*, j.jobtitle, d.deptName, l.levelName,e.degName
			FROM tbl_store_job as p, tbl_jobtitle as j,  tbl_department as d, tbl_job_level as l,tbl_degree as e
			WHERE p.jId = j.jId AND p.dId = d.dId AND p.levelId = l.levelId AND p.degId=e.degId AND p.jId = '$jId' ";
			/*$query="SELECT * FROM tbl_store_job WHERE JId='$jId'";*/
			$result=$this->db->select($query);
			return $result;

		}
		public function jobUpdate($data, $jId){
			$jId 		= 	$this->fm->validation($data['jId']);
			$dId 		= 	$this->fm->validation($data['dId']);
			$levelId 		= 	$this->fm->validation($data['levelId']);
			$ldApplication = $this->fm->validation($data['ldApplication']);
			$degId 		= 	$this->fm->validation($data['degId']);
			//$joblocation 		= 	$this->fm->validation($data['joblocation']);
			$mimcomp 		= 	$this->fm->validation($data['mimcomp']);
			$mxmcomp 		= 	$this->fm->validation($data['mxmcomp']);
			
			$expDate 	= 	$this->fm->validation($data['expDate']);
			$prerequisite = $this->fm->validation($data['prerequisite']);

			$jId = mysqli_real_escape_string($this->db->link, $jId);
			$dId = mysqli_real_escape_string($this->db->link, $dId);
			$levelId = mysqli_real_escape_string($this->db->link, $levelId);
			$ldApplication = mysqli_real_escape_string($this->db->link, $ldApplication);
			$degId = mysqli_real_escape_string($this->db->link, $degId);
			//$joblocation = mysqli_real_escape_string($this->db->link, $joblocation);
			$mimcomp = mysqli_real_escape_string($this->db->link, $mimcomp);
			$mxmcomp = mysqli_real_escape_string($this->db->link, $mxmcomp);
			$expDate = mysqli_real_escape_string($this->db->link, $expDate);
			$prerequisite = mysqli_real_escape_string($this->db->link, $prerequisite);

							$query = "UPDATE tbl_store_job
				          SET 
				          jId='$jId',
				          dId='$dId',
				          levelId= '$levelId',
				          ldApplication='$ldApplication',
				          degId='$degId',
				          mimcomp='$mimcomp',
				          mxmcomp='$mxmcomp',
				          expDate='$expDate',
				          prerequisite='$prerequisite'

				          WHERE jId = '$jId'";


				
				$result = $this->db->update($query);
				if ($result) {
					$msg = "Record Updated Successfully";
					return $msg;
				}else{
					$msg = "Record Not Updated Successfully";
					return $msg;
				}
			
		}


	public function jobPosting($jId, $batch){
			
			$jId = mysqli_real_escape_string($this->db->link, $jId);
			$batch = mysqli_real_escape_string($this->db->link, $batch);

			$Squery = "SELECT * FROM tbl_store_job WHERE jId = '$jId' AND batch = '$batch'";
			$getJob = $this->db->select($Squery);
			if ($getJob) {
				while ($value = $getJob->fetch_assoc()) {
					
					$dId = $value['dId'];
					$batch = $value['batch'];
					$levelId = $value['levelId'];
					$ldApplication = $value['ldApplication'];
					$degId = $value['degId'];
					$mimcomp = $value['mimcomp'];
					$mxmcomp = $value['mxmcomp'];
					$expDate = $value['expDate'];
					$prerequisite = $value['prerequisite'];
					$joblocation = $value['joblocation'];
					$email='hr@keal.com.bd';

			$Squery = "SELECT p.*, j.jobtitle,  d.deptName
				FROM tbl_store_job as p,  tbl_jobtitle as j, tbl_department as d
				WHERE p.jobId = j.jId AND p.deptId = d.dId AND  jobId = '$jId' AND batch = '$batch'";
			$detail = $this->db->select($Squery);
			if ($detail) {
				while ($value = $detail->fetch_assoc()) {
					
					$deptName = $value['deptName'];
				
					$jobtitle = $value['jobtitle'];
				
			
		
		
					$query = "INSERT INTO tbl_user_job(jId, dId, batch, levelId, ldApplication, degId, mimcomp, mxmcomp, expDate, prerequisite, joblocation) VALUES('$jId', '$dId', '$batch', '$levelId', '$ldApplication', '$degId', '$mimcomp', '$mxmcomp', '$expDate', '$prerequisite','$joblocation')";
					$result = $this->db->insert($query);

					if ($result) {
					
												?>
                                <script>
                                alert('Your Job Has Been Posted Succesfully.');
                                window.location.href='';
                                </script>
                            <?php


							$headers = 'From: '.$email."\r\n".
							 
							'Reply-To: '.$email."\r\n" .
							 
							'X-Mailer: PHP/' . phpversion();

							$email_to = "recruitment@keal.com.bd";
							$email_subject= "New Job Posting";
							$email_message= "
Dear Recruitment Officer ,
A new job has been posted successfully.
Department: $deptName
Job Title: $jobtitle
Batch: 	$batch
";


							$headers1 = 'From: '.$email_to."\r\n".
							 
							'Reply-To: '.$email_to."\r\n" .
							 
							'X-Mailer: PHP/' . phpversion();

							$email_subject1= "New Job Posting";
							$email_message1= "

Dear Recruitment Officer ,
A new job has been posted successfully.
Department: $deptName
Job Title: $jobtitle
Batch: 	$batch
";

							$email_message2= 'Date'.$date."\r\n";
							mail("<$email_to>","$email_subject","$email_message","$headers");

							mail("<$email>","$email_subject1","$email_message1","$headers1");
		 
				

					}else{
						$msg = "Your Job Has Been Not Post Successfully.";
						return $msg;
					}
				}
	
			}
	}
			}
	}
			
	
	
				
			
			
		public function getDescriptionById($jobId){
			$query = "SELECT * FROM  jd_bank WHERE jId = '$jobId'";
			$result = $this->db->select($query);
			return ($result);
		}

		public function delDegByid($deldeg){
			$query = "DELETE FROM tbl_degree WHERE degId = '$deldeg'";
			$result = $this->db->delete($query);
			if ($result) {
					$msg = "Deleted Successfully";
					return $msg;
			}else{
					$msg = "Not Deleted Successfully";
					return $msg;
			}
		}

		public function delDepartmentByid($deldeg){
			$query = "DELETE FROM tbl_department WHERE dId = '$deldeg'";
			$result = $this->db->delete($query);
			if ($result) {
					$msg = "Deleted Successfully";
					return $msg;
			}else{
					$msg = "Not Deleted Successfully";
					return $msg;
			}
		}
		
		/*public function getjobList(){  
		    /*$query = "SELECT J.*, jt.jobtitle, dp.deptName, jl.levelName, dn.degName 
		        	FROM tbl_user_job as J, tbl_jobtitle as jt, tbl_department as dp, tbl_job_level as jl, tbl_degree as dn WHERE 
		        	J.jId = jt.jId AND J.dId = dp.dId AND J.levelId = jl.levelId AND J.degId = dn.degId ORDER BY
		        	J.jsId DESC";*/

		    /*$query = "SELECT a.*, b.jobtitle, c.deptName
				FROM tbl_user_job as a, tbl_jobtitle as b, tbl_department as c
				WHERE a.jId = b.jId AND a.dId = c.dId
				ORDER BY a.jsId DESC";*/
		    //$query = "SELECT * FROM tbl_user_job ORDER BY jsId DESC";

				/*$query = "SELECT tbl_user_job.*, tbl_jobtitle.jobtitle, tbl_department.deptName
				FROM tbl_user_job
				INNER JOIN tbl_jobtitle
				ON tbl_user_job.jId = tbl_jobtitle.jId
				INNER JOIN tbl_department
				ON tbl_user_job.dId = tbl_department.dId	

		 		ORDER BY tbl_user_job.jsId DESC";*/
		    /*$result = $this->db->select($query);
		    return $result;

		        	 }*/

		   public function getjobList(){
		   	$query = "SELECT p.*, c.levelName, j.jobtitle, r.degName, s.deptName
				FROM tbl_store_job as p, tbl_job_level as c, tbl_jobtitle as j, tbl_degree as r, tbl_department as s
				WHERE p.levelId = c.levelId AND p.jId = j.jId AND p.degId = r.degId AND p.dId = s.dId
				ORDER BY p.jsId DESC";

		/*$query = "SELECT tbl_product.*, tbl_category.catName, tbl_brand.brandName
				FROM tbl_product
				INNER JOIN tbl_category
				ON tbl_product.catId = tbl_category.catId
				INNER JOIN tbl_brand
				ON tbl_product.brandId = tbl_brand.brandId	

		 		ORDER BY tbl_product.productId DESC";*/
		$value = $this->db->select($query);
		return $value;
	}

	public function jobTileCreate($data){

		$jobtitle = 	$this->fm->validation($data['jobtitle']);
		$description = 	$this->fm->validation($data['description']);

		$jobtitle = mysqli_real_escape_string($this->db->link, $jobtitle);
		$description = mysqli_real_escape_string($this->db->link, $description);

		if ($jobtitle == "" || $description == "") {
			$msg = "Fillup all Field!";
			return $msg;
		}
		$dpquery = "SELECT * FROM tbl_jobtitle WHERE jobtitle = '$jobtitle' LIMIT 1";
				$dpchk   = $this->db->select($dpquery);
				if ($dpchk != false) {
					$msg = "<span style='color:red'>Jobtitle Already exist!!</span>";
					return $msg;
					//email unique has done

				} else {
					$query  = "INSERT INTO tbl_jobtitle(jobtitle, description) VALUES ('$jobtitle', '$description')";
					$result = $this->db->insert($query);
					if ($result) {
						$msg = "Jobtitle Inserted";
						return $msg;
					}else{
						$msg = "Jobtitle Not Inserted";
						return $msg;
				}
			}
	}

	public function specializationCreate($data){

		$specialization = 	$this->fm->validation($data['specialization']);
		$specialization = mysqli_real_escape_string($this->db->link, $specialization);
		if ($specialization == "") {
			$msg = "Fillup all Field!";
			return $msg;
		}$dpquery = "SELECT * FROM tbl_specialization WHERE specialization = '$specialization' LIMIT 1";
				$dpchk   = $this->db->select($dpquery);
				if ($dpchk != false) {
					$msg = "<span style='color:red'>Jobtitle Already exist!!</span>";
					return $msg;
					//email unique has done

			}else {
					$query  = "INSERT INTO tbl_specialization(specialization) VALUES ('$specialization')";
					$result = $this->db->insert($query);
					if ($result) {
						$msg = "specialization Inserted";
						return $msg;
					}else{
						$msg = "specialization Not Inserted";
						return $msg;
				}
			}
		}

		public function getAllspecializ(){
			$query = "SELECT * FROM tbl_specialization ORDER BY spId DESC";
			$result = $this->db->select($query);
			return $result;
		}
		
		public function getCadidateList(){
				$query = "SELECT p.*, c.levelName, j.jobtitle, r.degName, s.deptName, a.userName
				FROM tbl_apply as p, tbl_job_level as c, tbl_jobtitle as j, tbl_degree as r, tbl_department as s, tbl_user_reg as a
				WHERE p.levelId = c.levelId AND p.jId = j.jId AND p.degId = r.degId AND p.dId = s.dId AND p.userId = a.regId
				ORDER BY p.id DESC";

				$value = $this->db->select($query);
				return $value;
		}
		
		
			public function getAllpeople($start_form, $per_page){

				$query = "SELECT p.*, s.specialization
				FROM tbl_user_reg as p, tbl_specialization as s
				WHERE p.spId = s.spId  ORDER BY regId DESC limit $start_form , $per_page";
				$result= $this->db->select($query);
				return $result;
	}
	
	
	public function getallparticipant(){
		//$query = "SELECT * FROM tbl_interview WHERE status = '1'";
		$query = "SELECT p.*, u.userName, j.jobtitle
				FROM tbl_interview as p, tbl_user_reg as u, tbl_jobtitle as j
				WHERE p.userId = u.regId AND p.jId = j.jId AND p.statustow = '1'  AND p.activity ='0' ORDER BY p.userId DESC";
		$result = $this->db->select($query);
		return $result;
	}

	public function markattendence($status, $userId, $jId){
		
		$status =  mysqli_real_escape_string($this->db->link, $status);

		if ($status == "") {
			$msg = "please Select Option";
			return $msg;
		}else{
			$query = "UPDATE tbl_interview
						SET 
						status = '$status'

						WHERE userId = '$userId' AND jId = '$jId'";
			$update_row = $this->db->update($query);
			if ($update_row) {
				$msg = "Attendence Marked";
				return $msg;
			}else{
				$msg = "Attendence Not Marked";
				return $msg;
			}
		}
		
	}
	public function statmarkattendence($status, $userId, $jId){
	    $status =  mysqli_real_escape_string($this->db->link, $status);

		if ($status == "") {
			$msg = "please Select Option";
			return $msg;
		}else{
			$query = "UPDATE tbl_apply
						SET 
						status = '$status'

						WHERE userId = '$userId' AND jId = '$jId'";
			$update_row = $this->db->update($query);
			
		}
	}
public function getallreparticipant(){
	    $query = "SELECT p.*, u.userName,j.jobtitle
				FROM tbl_disappertime as p, tbl_user_reg as u,tbl_jobtitle as j
				WHERE p.userId = u.regId AND p.jId =j.jId AND status = '1' ORDER BY p.id DESC LIMIT 8";
		//$query = "SELECT * FROM tbl_disappertime WHERE status = '1'";
		$result = $this->db->select($query);
		return $result;
	}

	public function markdisappearattendence($status, $userId, $jId){
		
		$status =  mysqli_real_escape_string($this->db->link, $status);

		if ($status == "") {
			$msg = "please Select Option";
			return $msg;
		}else{
			$query = "UPDATE tbl_disappertime
						SET 
						attend = '$status'

						WHERE userId = '$userId' AND jId = '$jId'";
			$update_row = $this->db->update($query);
			if ($update_row) {
				$msg = "Attendence Marked";
				return $msg;
			}else{
				$msg = "Attendence Not Marked";
				return $msg;
			}
		}
		
	}

    public function getAbsent(){
		$query = "SELECT p.*, u.userName, j.jobtitle
				FROM tbl_interview as p, tbl_user_reg as u, tbl_jobtitle as j
				WHERE p.userId = u.regId AND p.jId = j.jId AND attend = '2'";
		$result = $this->db->select($query);
		return $result;
	}

	public function markabsent($userId, $jId){
		$userId =  mysqli_real_escape_string($this->db->link, $userId);
		$jId =  mysqli_real_escape_string($this->db->link, $jId);

			$Mquery = "SELECT * FROM tbl_user_reg WHERE regId = '$userId'";
			$result = $this->db->select($Mquery)->fetch_assoc();
			$email = $result['email'];
			$userName = $result['userName'];

		 $query =  "SELECT * FROM tbl_interview WHERE attend = '2'";
		 $result = $this->db->select($query)->fetch_assoc();
		 
		 $jId = $result['jId'];
		 $userId = $result['userId'];
		 $interviewdate = $result['interviewdate'];
		 $starttime = $result['starttime'];
		 $endtime = $result['endtime'];

		 $insert = "INSERT INTO tbl_absent(jId, userId, interviewdate, starttime, endtime) VALUES('$jId', '$userId', '$interviewdate', '$starttime', '$endtime')";
		 $insert_row = $this->db->insert($insert);
		 if ($insert_row) {
		 	
												?>
                                <script>
                                alert('Absentee Confirmation email Has been Sent To this Candidate !');
                                window.location.href='absent_attendance';
                                </script>
                            <?php


							$headers = 'From: '.$email."\r\n".
							 
							'Reply-To: '.$email."\r\n" .
							 
							'X-Mailer: PHP/' . phpversion();

							$email_to = "recruitment@keal.com.bd";
							$email_subject= "Absentee Confirmation email";
							$email_message= "
Dear $userName,
We regret to inform you that you missed the the following interview session:
In order to avail another session of interview please click below:
Please note that we reserve the right to blacklist/ greylist you for not being
logical enough to explain the reason for being absent.
Best Regards,
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

							$email_subject1= "Absentee Confirmation email";
							$email_message1= "
Dear $userName,

We regret to inform you that you missed the the following interview session: 
In order to avail another session of interview please click below:
Please note that we reserve the right to blacklist/ greylist you for not being
logical enough to explain the reason for being absent.
Best Regards,
								
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
		 }

	}
	
public function sendProcess($userId, $jId, $info){
		$userId = mysqli_real_escape_string($this->db->link, $userId);
		$info = mysqli_real_escape_string($this->db->link, $info);
		$jId = mysqli_real_escape_string($this->db->link, $jId);

		$Mquery = "SELECT * FROM tbl_user_reg WHERE regId = '$userId'";
			$result = $this->db->select($Mquery);
			if ($result) {
				while ($data = $result->fetch_assoc()) {
					$email = $data['email'];
					$userName = $data['userName'];
				}
			}
			

		$Aquery = "SELECT * FROM tbl_apply WHERE userId = '$userId'";
		$result = $this->db->select($Aquery);
		if ($result) {
			while($data = $result->fetch_assoc()){
				$jId = $data['jId'];
			}
		}
		


		$query = "INSERT INTO tbl_processnote(jId, userId, info) VALUES('$jId', '$userId', '$info')";
		$insert_row = $this->db->insert($query);
		if ($insert_row) {
			 						?>
			 					<script>
                                alert('How to Complete your Application & Process Note Has Sent');
                                window.location.href='step_2';
                                </script>
                            <?php


							$headers = 'From: '.$email."\r\n".
							 
							'Reply-To: '.$email."\r\n" .
							 
							'X-Mailer: PHP/' . phpversion();

							$email_to = "recruitment@keal.com.bd";
							$email_subject= "How to Complete your Application & Process Note";
							$email_message= "
Dear $userName,
Welcome Aboard!!
 
Thank you for signing up in our recruitment program.
							 
If you have received this email successfully we have verified your email address
properly. Please click the following link to confirm your acknowledgement of
receiving the email:
							 
https:\\www.career.keal.com.bd
							 
Please note that the recruitment process would ideally take the following cours:

Step 1: Apply for the job which is available for you and best suits your career
intent.

Step 2: You need to complete your resume/CV/biodata according to prescribed
format. You may also upload your resume in pdf format.The file size should be
between 100-300 kb.

Step 3: Now, the Recruitment Officer may select you for an interview.

Step 4: Come for the interview on the due date if you are selected for intervie.

Step 5: If you want to reschedule the date you may request for a Reschedule.

Step 6: HR may or may not approve your request for reschedule. If you are absent
for the interview you may all start over from Step 1.
							 
Please note that in every step you will be notified by email. Please do not
forget to check your Spam or Junk mailbox for the emails and react to them in
time.
 
We are excited to have you on board with us in the journey of career development
							 
Good Luck!!";


							$headers1 = 'From: '.$email_to."\r\n".
							 
							'Reply-To: '.$email_to."\r\n" .
							 
							'X-Mailer: PHP/' . phpversion();

							$email_subject1= "How to Complete your Application & Process Note";
							$email_message1= "
Dear $userName,

Welcome Aboard!!
 
Thank you for signing up in our recruitment program.
							 
If you have received this email successfully we have verified your email address
properly. Please click the following link to confirm your acknowledgement of
receiving the email:
							 
https:\\www.career.keal.com.bd
							 
Please note that the recruitment process would ideall take the following course:

Step 1: Apply for the job which is available for you and best suits your career
intent.

Step 2: You need to complete your resume/CV/biodata according to prescribed
format. You may also upload your resume in pdf format.The file size should be
between 100-300 kb.

Step 3: Now, the Recruitment Officer may select you for an interview.

Step 4: Come for the interview on the due date if you are selected for intervie.

Step 5: If you want to reschedule the date you may request for a Reschedule.

Step 6: HR may or may not approve your request for reschedule. If you are absent
for the interview you may all start over from Step 1.
							 
Please note that in every step you will be notified by email. Please do not
forget to check your Spam or Junk mailbox for the emails and react to them in
time.
 
We are excited to have you on board with us in the journey of career development
							 
Good Luck!!";

							$email_message2= 'Date'.$date."\r\n";
							mail("<$email_to>","$email_subject","$email_message","$headers");

							mail("<$email>","$email_subject1","$email_message1","$headers1");	
		}


	}

    public function getdocument($uId){
				$query = "SELECT * FROM tbl_upload WHERE userId = '$uId'";
				$result = $this->db->select($query);
				return $result;
			}

		
	public function getAlljoblist(){
		$query = "SELECT * FROM tbl_jobtitle ORDER BY jId DESC";
				$result = $this->db->select($query);
				return $result;
	}

	public function getAlljoblistbyId($jid){
		$query = "SELECT * FROM tbl_jobtitle WHERE jId = '$jid'";
				$result = $this->db->select($query);
				return $result;
	}

	public function jobTileEdit($data, $file, $jid){
		$jobtitle = 	$this->fm->validation($data['jobtitle']);
		$description = 	$this->fm->validation($data['description']);

		$jobtitle = mysqli_real_escape_string($this->db->link, $jobtitle);
		$description = mysqli_real_escape_string($this->db->link, $description);

		if ($jobtitle == "" || $description == "") {
			$msg = "Fillup all Field!";
			return $msg;
		}else{
			$Query = "UPDATE tbl_jobtitle 
			SET 
			jobtitle = '$jobtitle',
			description = '$description'
			WHERE jId = '$jid'";
			$update_row = $this->db->update($Query);
			if ($update_row) {
				$msg = "<span style='color:green'>Successfully Updated</span>";
				return $msg;
			}else{
				$msg = "<span style='color:red'>Not Updated</span>";
				return $msg;
			}
		}
		
	}
	public function uploadDescription($jid, $file){
		 $permited  = array('pdf');
			  $file_name = $file['jd']['name'];
			  $file_size = $file['jd']['size'];
			  $file_temp = $file['jd']['tmp_name'];

		      $div           = explode('.', $file_name);
		      $file_ext      = strtolower(end($div));
		      $unique_file   = substr(md5(time()), 0, 10).'.'.$file_ext;
		      $uploaded_file = "JdBank/".$unique_file;

		      if ($uploaded_file == "") {
		    	 
		    	 $errmsg = "Browse Your Resume First And Submit";
		    	 return $errmsg;

		    	}elseif ($file_size >500000) {
			     $msg = "<span style='color:red'>Pdf Size should be not more then 500KB!</span>";
			     return $msg;
   			 	} elseif (in_array($file_ext, $permited) === false) {

		     	$msg = "<span style='color:red'>You can upload only:-".implode(', ', $permited)."</span>";
		     	return $msg;
    			} else {
			    	 move_uploaded_file($file_temp, $uploaded_file);
			    	 $query = "UPDATE tbl_jobtitle
			    	 SET 
			    	 jd = '$uploaded_file'
			    	 WHERE jId = '$jid'";
			    	 $update_row = $this->db->update($query);
			    	 if ($update_row) {
			    	 	$msg = "<span style='color:green'>JD Upload complete</span>";
			    	 	return $msg;
			    	 }else{
			    	 	$msg = "<span style='color:red'>JD Upload Not complete</span>";
			    	 	return $msg;
			    	 }
			    	}

	}
	public function getGapAnalysis(){
	/*$query="SELECT p.*, r.userName
	FROM tbl_gap_analysis as p,tbl_user_reg as r
	WHERE p.userId= r.regId";*/
	$query="SELECT * FROM tbl_gap_analysis";
			$result=$this->db->select($query);
			return $result;
			
}

	public function getAllpeopleforGap(){
		$query = "SELECT * FROM tbl_user_reg ORDER BY regId DESC limit 100 ";
		$result = $this->db->select($query);
		return $result;
	} 
	public function gapCreate($data, $uId){

		$gap = 	$this->fm->validation($data['gap']);
		$gap = mysqli_real_escape_string($this->db->link, $gap);
		if ($gap == "") {
			$msg = "Fillup all Field!";
			return $msg;
		

			}else {
					$query  = "INSERT INTO tbl_gap_analysis(userId, gap) VALUES ('$uId', '$gap')";
					$result = $this->db->insert($query);
					if ($result) {
						$msg = "Gap Inserted";
						return $msg;
					}else{
						$msg = "Gap Not Inserted";
						return $msg;
				}
			}
		}
		
		public function gapAdmin($data){

		$email = 	$this->fm->validation($data['email']);
		$gap = 	$this->fm->validation($data['gap']);
		$email = mysqli_real_escape_string($this->db->link, $email);
		$gap = mysqli_real_escape_string($this->db->link, $gap);
		if ($gap == "" || $email == "") {
			$msg = "Fillup all Field!";
			return $msg;
		

			}else {
					$query  = "INSERT INTO tbl_gap_analysis(email,gap) VALUES ('$email','$gap')";
					$result = $this->db->insert($query);
					if ($result) {
						?>
			 					<script>
                                alert('Gap Analysis');
                               
                                </script>
                            <?php


							$headers = 'From: '.$email."\r\n".
							 
							'Reply-To: '.$email."\r\n" .
							 
							'X-Mailer: PHP/' . phpversion();

							$email_to = "recruitment@keal.com.bd";
							$email_subject= "Gap Analysis";
							$email_message= "
$gap";


							$headers1 = 'From: '.$email_to."\r\n".
							 
							'Reply-To: '.$email_to."\r\n" .
							 
							'X-Mailer: PHP/' . phpversion();

							$email_subject1= "Gap Analysis";
							$email_message1= "
$gap";

							$email_message2= 'Date'.$date."\r\n";
							mail("<$email_to>","$email_subject","$email_message","$headers");

							mail("<$email>","$email_subject1","$email_message1","$headers1");	
		


					}else{
						$msg = "Gap Not Inserted";
						return $msg;
				}
			}
		}
		public function createNewUser($data){
		$uname 		= 	$this->fm->validation($data['uname']);
		$activity   = 	$this->fm->validation($data['activity']);
		$datee 		= 	$this->fm->validation($data['datee']);
		$pass 		= 	$this->fm->validation($data['pass']);
		$email 		= 	$this->fm->validation($data['email']);
		$designation = 	$this->fm->validation($data['designation']);

		$uname 		= mysqli_real_escape_string($this->db->link, $uname);
		$activity 	= mysqli_real_escape_string($this->db->link, $activity);
		$pass 		= mysqli_real_escape_string($this->db->link, md5($pass));
		$datee 		= mysqli_real_escape_string($this->db->link, $datee);
		$email 		= mysqli_real_escape_string($this->db->link, $email);
		$designation 		= mysqli_real_escape_string($this->db->link, $designation);

		if ($uname == "" || $pass == ""|| $activity == ""|| $email == "" || $designation == "" ) {
			$msg ="<span style='color:red'>Field Is Empty!!</span>";
			return $msg;
		}else{
			$query = "INSERT INTO tbl_login(uname, pass, email, designation, activity) VALUES('$uname', '$pass',  '$email', '$designation', '$activity')";
			$result = $this->db->insert($query);
			if ($result) {
				$msg = "<span style='color:#fff'>New User Has Been Created Successfully</span>";
				return $msg;
			}else{
				$msg = "<span style='color:red'>New InterViewer not Created Successfully</span>";
				return $msg;
			}
		}
	}
	public function getInterviewer(){
		$query = "SELECT * FROM tbl_login WHERE activity = '3'";
		$result = $this->db->select($query);
		return $result;
	}
	
		public function uploadPropicture($adminId, $file){
		
			  $permited  = array('jpg', 'jpeg', 'png', 'gif');
			  $file_name = $file['image']['name'];
			  $file_size = $file['image']['size'];
			  $file_temp = $file['image']['tmp_name'];

		      $div            = explode('.', $file_name);
		      $file_ext       = strtolower(end($div));
		      $unique_image   = substr(md5(time()), 0, 10).'.'.$file_ext;
		      $uploaded_image = "uploads/".$unique_image;


		    if ($uploaded_image == "") {
		    	 
		    	 $errmsg = "<span style='color:red'>Browse Your Picture First And Submit</span>";
		    	 return $errmsg;

		    	}elseif ($file_size >1048567) {
			     echo "<span style='color:red'>Image Size should be less then 1MB!</span>";

   			 	} elseif (in_array($file_ext, $permited) === false) {

		     	echo "<span style='color:red'>You can upload only:-".implode(', ', $permited)."</span>";

    			} else {
			    	 move_uploaded_file($file_temp, $uploaded_image);
			    	 $query = "UPDATE tbl_login 
			    	 			SET 
			    	 			image = '$uploaded_image'

			    	 			WHERE id = '$adminId'";
			    	 $update_row = $this->db->update($query);
			    	 if ($update_row) {
			    	 	$msg = "<span style='color:green'>Image Upload complete</span>";
			    	 	return $msg;
			    	 }else{
			    	 	$msg = "<span>Image Upload Not complete</span>";
			    	 	return $msg;
			    	 }
			    	}
		}


		public function getdetails($adminId){
			$query = "SELECT * FROM tbl_login WHERE id = '$adminId'";
			$result = $this->db->select($query);
			return $result;
		}
		
		public function changeUserpass($data, $adminId){
			$oldpass 	   = 	$this->fm->validation($data['oldpass']);
			$newpass       = 	$this->fm->validation($data['newpass']);
			$confirmpass   = 	$this->fm->validation($data['confirmpass']);

			$oldpassword 	= mysqli_real_escape_string($this->db->link, md5($oldpass));
			$newpass 		= mysqli_real_escape_string($this->db->link, md5($newpass));
			$confirmpass 	= mysqli_real_escape_string($this->db->link, md5($confirmpass));

			$queryget = "SELECT pass FROM tbl_login WHERE id='$adminId'";
			$row = $this->db->select($queryget)->fetch_assoc();
		
			$oldpassworddb = $row['pass'];

			//check pass
			if ($oldpassword==$oldpassworddb){
				
				//check twonew pass
				if ($newpass==$confirmpass){
				//success
				//change pass in db
			
				
						$querychange = "UPDATE tbl_login SET
			 				pass ='$newpass'
			 				 WHERE id='$adminId'";
			 			$query_update = $this->db->update($querychange);
						if ($query_update) {
							$msg = "<span style='color:white'>Your Password Has Changed Successfully</span>";
							return $msg;
						}else{
							$msg = "Not Change";
							return $msg;
						}
					
				}
			}
		}
		
		public function createBoard($data, $uId){
			$date = date('Y-m-d');
			$id = $this->fm->validation($data['id']);
			
			$query = "SELECT * FROM tbl_login WHERE id = '$uId'";
			$result = $this->db->select($query)->fetch_assoc();
			$uname = $result['uname'];
			$email = $result['email'];
			$designation = $result['designation'];

			$Inserted = "INSERT INTO 
			tbl_iboard(bId, uname, email, designation, datee) 
			VALUES('$id', '$uname', '$email', '$designation', '$date')";
			$result = $this->db->insert($Inserted);
			if ($result) {
				$msg = "InterViewer Selected";
				return $msg;
			}else{
				$msg = "InterViewer Not Selected";
				return $msg;
			}
		}


		public function getBoard($tarikh){
			$query = "SELECT * FROM tbl_iboard WHERE datee = '$tarikh' ORDER BY uname ASC";
			$result = $this->db->select($query);
			return $result;
		}
		public function criteriaInput($data, $adminId, $uId){
			$criteria1		= 	$this->fm->validation($data['criteria1']);
			$criteria2 		= 	$this->fm->validation($data['criteria2']);
			$criteria3 		= 	$this->fm->validation($data['criteria3']);
			$criteria4      = $this->fm->validation($data['criteria4']);
			$criteria5 		= 	$this->fm->validation($data['criteria5']);
			//$joblocation 		= 	$this->fm->validation($data['joblocation']);
			$criteria6 		= 	$this->fm->validation($data['criteria6']);
			$criteria7		= 	$this->fm->validation($data['criteria7']);
			
			$criteria8 	= 	$this->fm->validation($data['criteria8']);
			$criteria9 = $this->fm->validation($data['criteria9']);
			$criteria10 = $this->fm->validation($data['criteria10']);

			$criteria1	 = mysqli_real_escape_string($this->db->link, $criteria1);
			$criteria2 = mysqli_real_escape_string($this->db->link, $criteria2);
			$criteria3  = mysqli_real_escape_string($this->db->link, $criteria3 );
			$criteria4 = mysqli_real_escape_string($this->db->link, $criteria4);
			$criteria5  = mysqli_real_escape_string($this->db->link, $criteria5 );
			//$joblocation = mysqli_real_escape_string($this->db->link, $joblocation);
			$criteria6  = mysqli_real_escape_string($this->db->link, $criteria6 );
			$criteria7= mysqli_real_escape_string($this->db->link, $criteria7);
			$criteria8 = mysqli_real_escape_string($this->db->link, $criteria8);
			$criteria9 = mysqli_real_escape_string($this->db->link, $criteria9);
				$criteria10= mysqli_real_escape_string($this->db->link, $criteria10);
				  $date = date('Y-m-d');

				$query = "INSERT INTO tbl_score(eId, userId, datee,criteria1, criteria2, criteria3 , criteria4, criteria5, criteria6, criteria7, criteria8,criteria9,criteria10) VALUES('$adminId', '$uId', '$date', '$criteria1', '$criteria2', '$criteria3', '$criteria4',
				'$criteria5', '$criteria6', '$criteria7', '$criteria8','$criteria9','$criteria10')";
				$result = $this->db->insert($query);
				if ($result) {
					$msg = "Record Successfully Inserted";
					return $msg;
				}else{
					$msg = "Record Not Successfully Inserted";
					return $msg;
				}
			
		}
		public function criteriaCreate($data){
			$criteriaName 	 = $this->fm->validation($data['criteriaName']);
			

			$criteriaName = mysqli_real_escape_string($this->db->link, $criteriaName);
			
			if ($criteriaName == "" ) {
				$msg = "Fill up the Field";
						return $msg;
			}else {
					$query  = "INSERT INTO tbl_criteria(criteriaName) VALUES ('$criteriaName')";
					$result = $this->db->insert($query);
					if ($result) {
						$msg = "Criteria Name Inserted";
						return $msg;
					}else{
						$msg = "Criteria Name Not Inserted";
						return $msg;
				}
			}
		}
		
		public function getAllapplystat($uId, $jId){
			$query = "SELECT * FROM tbl_apply WHERE userId = '$uId' AND jId = '$jId'";
			$result = $this->db->select($query);
			return $result;
		}
		public function markPresent($status, $userId, $jId){
		
		$Mquery = "SELECT * FROM tbl_user_reg WHERE regId = '$userId'";
			$result = $this->db->select($Mquery);
			if ($result) {
				while ($data = $result->fetch_assoc()) {
					$email = $data['email'];
					$userName = $data['userName'];
				}
			}
		
		
			$query = "UPDATE tbl_interview
						SET 
						status ='3',
						activity = '1'

						WHERE userId = '$userId' AND jId = '$jId'";
			$update_row = $this->db->update($query);
			if ($update_row) {
			    
												?>
                                <script>
                                alert('Interview presence Confirmation email Has been Sent To this Candidate !');
                                window.location.href='';
                                </script>
                            <?php
					$headers = 'From: '.$email."\r\n".
							 
							'Reply-To: '.$email."\r\n" .
							 
							'X-Mailer: PHP/' . phpversion();

							$email_to = "recruitment@keal.com.bd";
							$email_subject= "Thank You for attending the interview";
							$email_message= "

Dear $userName,

Thank You for attending the interview.
								
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

							$email_subject1= "Thank You for attending the interview";
							$email_message1= "
Dear $userName,

Thank You for attending the interview.
								
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
				$msg = "Not Marked";
				return $msg;
			}
		}
		
		public function markAbsentPeople($status, $userId, $jId){
		
		$Mquery = "SELECT * FROM tbl_user_reg WHERE regId = '$userId'";
			$result = $this->db->select($Mquery);
			if ($result) {
				while ($data = $result->fetch_assoc()) {
					$email = $data['email'];
					$userName = $data['userName'];
				}
			}
		
			$query = "UPDATE tbl_interview
						SET 
						status ='4',
						activity = '1'

						WHERE userId = '$userId' AND jId = '$jId'";
			$update_row = $this->db->update($query);
			if ($update_row) {
			    
												?>
                                <script>
                                alert('Absentee Confirmation email Has been Sent To this Candidate !');
                                window.location.href='';
                                </script>
                            <?php
						$headers = 'From: '.$email."\r\n".
							 
							'Reply-To: '.$email."\r\n" .
							 
							'X-Mailer: PHP/' . phpversion();

							$email_to = "recruitment@keal.com.bd";
							$email_subject= "you missed the interview";
							$email_message= "

Dear $userName,

You missed the interview.
								
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

							$email_subject1= "you missed the interview";
							$email_message1= "
Dear $userName,

You missed the interview.
								
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
				$msg = "Not Marked";
				return $msg;
			}
		}
	public function markdisappearPresent($status, $userId, $jId){
		
		$status =  mysqli_real_escape_string($this->db->link, $status);
		
            $Mquery = "SELECT * FROM tbl_user_reg WHERE regId = '$userId'";
			$result = $this->db->select($Mquery);
			if ($result) {
				while ($data = $result->fetch_assoc()) {
					$email = $data['email'];
					$userName = $data['userName'];
				}
			}
		
			$query = "UPDATE tbl_disappertime
						SET 
						attend = '3'

						WHERE userId = '$userId' AND jId = '$jId'";
			$update_row = $this->db->update($query);
			if ($update_row) {
			    				?>
                                <script>
                                alert('Present Confirmation email Has been Sent To this Candidate !');
                                window.location.href='';
                                </script>
                            <?php
				$headers = 'From: '.$email."\r\n".
							 
							'Reply-To: '.$email."\r\n" .
							 
							'X-Mailer: PHP/' . phpversion();

							$email_to = "recruitment@keal.com.bd";
							$email_subject= "Thank You for attending the interview";
							$email_message= "

Dear $userName,

Thank You for attending the interview.
								
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

							$email_subject1= "Thank You for attending the interview";
							$email_message1= "
Dear $userName,

Thank You for attending the interview.
								
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
				$msg = "Attendence Not Marked";
				return $msg;
			}
		}
		
	

	public function markdisappearAbsent($status, $userId, $jId){
		$Mquery = "SELECT * FROM tbl_user_reg WHERE regId = '$userId'";
			$result = $this->db->select($Mquery);
			if ($result) {
				while ($data = $result->fetch_assoc()) {
					$email = $data['email'];
					$userName = $data['userName'];
				}
			}
		$status =  mysqli_real_escape_string($this->db->link, $status);
			$query = "UPDATE tbl_disappertime
						SET 
						attend = '4'

						WHERE userId = '$userId' AND jId = '$jId'";
			$update_row = $this->db->update($query);
			if ($update_row) {
			    	?>
                                <script>
                                alert('Absentee Confirmation email Has been Sent To this Candidate !');
                                window.location.href='';
                                </script>
                            <?php
				$headers = 'From: '.$email."\r\n".
							 
							'Reply-To: '.$email."\r\n" .
							 
							'X-Mailer: PHP/' . phpversion();

							$email_to = "recruitment@keal.com.bd";
							$email_subject= "You missed the interview";
							$email_message= "

Dear $userName,

You missed the interview.
								
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

							$email_subject1= "you missed the interview";
							$email_message1= "
Dear $userName,

You missed the interview.
								
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
				$msg = "Attendence Not Marked";
				return $msg;
			}
		}
		
	

	

		
} ?>