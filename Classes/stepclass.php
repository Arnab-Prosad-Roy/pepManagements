<?php include_once "../lib/Database.php"; ?>
<?php include_once "../helpers/Format.php"; ?>

<?php
/**
* 
*/
class Steps
{
		private $db;
		private $fm;

		public function __construct()
	
		{
			$this->db = new Database();
			$this->fm = new Format();
		}	

		/*public function getonlyregisterd(){
			$query = "SELECT p.*, s.specialization
				FROM tbl_user_reg as p, tbl_specialization as s
				WHERE p.spId = s.spId AND applyresult = '0'  ORDER BY regId DESC ";
				$result= $this->db->select($query);
				return $result;
		}*/
		public function getonlyregisterd($start_form, $per_page){

				$query = "SELECT p.*, s.specialization
				FROM tbl_user_reg as p, tbl_specialization as s
				WHERE p.spId = s.spId AND applyresult = '0' ORDER BY regId DESC limit $start_form , $per_page";
				$result= $this->db->select($query);
				return $result;
	}

public function sendProcess($userId, $jId, $info){
		$userId = mysqli_real_escape_string($this->db->link, $userId);
		$info = mysqli_real_escape_string($this->db->link, $info);
		$jId = mysqli_real_escape_string($this->db->link, $jId);

		$Mquery = "SELECT * FROM tbl_user_reg WHERE regId = '$userId'";
			$result = $this->db->select($Mquery)->fetch_assoc();
			$email = $result['email'];
			$userName = $result['userName'];

		$Aquery = "SELECT * FROM tbl_apply WHERE userId = '$userId'";
		$result = $this->db->select($Aquery)->fetch_assoc();
		$jId = $result['jId'];


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


	public function sendProces($userId, $info){
		$userId = mysqli_real_escape_string($this->db->link, $userId);
		$info = mysqli_real_escape_string($this->db->link, $info);
		

		$Mquery = "SELECT * FROM tbl_user_reg WHERE regId = '$userId'";
			$result = $this->db->select($Mquery)->fetch_assoc();
			$email = $result['email'];
			$userName = $result['userName'];

	

		$query = "INSERT INTO tbl_processnote(userId, info) VALUES('$userId', '$info')";
		$insert_row = $this->db->insert($query);
		if ($insert_row) {
			 						?>
			 					<script>
                                alert('How to Complete your Application & Process Note Has Sent');
                                window.location.href='step0';
                                </script>
                            <?php


							$headers = 'From: '.$email."\r\n".
							 
							'Reply-To: '.$email."\r\n" .
							 
							'X-Mailer: PHP/' . phpversion();

							$email_to = "arnab.r@keal.com.bd";
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
	public function getallData(){
		$query = "SELECT p.*, c.userName
				FROM tbl_apply as p, tbl_user_reg as c
				WHERE p.userId = c.regId ORDER BY userId DESC";
			//$query = "SELECT * FROM tbl_school WHERE userId = '$uId'";
			$result = $this->db->select($query);
			return $result;
	}

	public function getallInfo($userId){
		$query = "SELECT * FROM tbl_personalinfo WHERE userId = '$userId' LIMIT 1 ";
		$result = $this->db->select($query);
		return $result;

	}

	public function getalladdress($userId){
		$query = "SELECT * FROM tbl_address WHERE userId = '$userId' LIMIT 1";
		$result = $this->db->select($query);
		return $result;

	}

	public function getallssc($userId){
		$query = "SELECT * FROM tbl_school WHERE userId = '$userId'  LIMIT 1";
		$result = $this->db->select($query);
		return $result;

	}
	public function getallvocational($userId){
		$query = "SELECT * FROM tbl_vocational WHERE userId = '$userId'  LIMIT 1";
		$result = $this->db->select($query);
		return $result;

	}
	public function getallolevel($userId){
		$query = "SELECT * FROM tbl_olevel WHERE userId = '$userId'  LIMIT 1";
		$result = $this->db->select($query);
		return $result;

	}

	public function getgradOther($userId){
		$query = "SELECT * FROM tbl_others WHERE userId = '$userId'  LIMIT 1";
		$result = $this->db->select($query);
		return $result;
	}


public function getreferences($userId){
		$query = "SELECT stat FROM tbl_reference WHERE userId = '$userId' LIMIT 1";
		$result = $this->db->select($query);
		return $result;

	}

	public function getreference($userId){
		$query = "SELECT * FROM tbl_reference WHERE userId = '$userId' LIMIT 1";
		$result = $this->db->select($query);
		return $result;
	}
	
	public function getallhsc($userId){
		$query = "SELECT status FROM tbl_hsc WHERE userId = '$userId'";
		$result = $this->db->select($query);
		return $result;

	}
	
	public function getallugrad($userId){
	    $query = "SELECT status FROM tbl_grad WHERE userId = '$userId'";
		$result = $this->db->select($query);
		return $result;
	}
	
	public function getallpgrad($userId){
	    $query = "SELECT status FROM tbl_postgraduate WHERE userId = '$userId'";
		$result = $this->db->select($query);
		return $result;
	}
	public function getpgradOther($userId){
		$query = "SELECT status FROM tbl_postgraduate WHERE userId = '$userId'";
		$result = $this->db->select($query);
		return $result;
	}
	public function getalltraining($userId){
		$query = "SELECT status FROM tbl_training WHERE userId = '$userId' LIMIT 1";
		$result = $this->db->select($query);
		return $result;

	}
	public function getallexp($userId){
		$query = "SELECT status FROM tbl_workingexperience WHERE userId = '$userId' LIMIT 1";
		$result = $this->db->select($query);
		return $result;

	}
	public function getallportfolio($userId){
		$query = "SELECT status FROM tbl_portfolio WHERE userId = '$userId'";
		$result = $this->db->select($query);
		return $result;

	}
	public function getalldiploma($userId){
		$query = "SELECT status FROM tbl_diploma WHERE userId = '$userId'";
		$result = $this->db->select($query);
		return $result;

	}
	public function getallAlevel($userId){
		$query = "SELECT status FROM tbl_alevel WHERE userId = '$userId'";
		$result = $this->db->select($query);
		return $result;

	}

	public function getApplicant(){
		$query = "SELECT p.*, c.levelName, j.jobtitle, r.degName, s.deptName, a.userName
				FROM tbl_apply as p, tbl_job_level as c, tbl_jobtitle as j, tbl_degree as r, tbl_department as s, tbl_user_reg as a
				WHERE p.levelId = c.levelId AND p.jId = j.jId AND p.degId = r.degId AND p.dId = s.dId AND p.userId = a.regId AND
				status = '1'
				ORDER BY p.id DESC";

				$value = $this->db->select($query);
				return $value;
	}

	 public function getinterdate($uId, $jId){
            $query = "SELECT * FROM tbl_interview WHERE userId = '$uId' AND jId = '$jId'";
			$result = $this->db->select($query);
			return $result;
        }
      public function getApplicantforminterviewlist(){
     	$query = "SELECT p.*,  j.jobtitle,  a.userName
				FROM tbl_interview as p,  tbl_jobtitle as j,  tbl_user_reg as a
				WHERE  p.jId = j.jId AND p.userId = a.regId
				
				ORDER BY p.id DESC";

				$value = $this->db->select($query);
				return $value;
     }
     public function getallsuccess(){
     	/*$query = "SELECT p.*,  j.jobtitle, s.deptName, a.userName
				FROM tbl_interview as p,  tbl_jobtitle as j, tbl_department as s, tbl_user_reg as a
				WHERE  p.jId = j.jId AND p.userId = a.regId ORDER BY p.id DESC";*/
		$query = "SELECT p.*, j.jobtitle, a.userName FROM tbl_interview as p, tbl_jobtitle as j, tbl_user_reg as a
					 WHERE p.jId = j.jId AND p.userId = a.regId AND statustow = '1' ORDER BY p.id DESC";

				$value = $this->db->select($query);
				return $value;
     }

     public function getallpresent(){
     	/*$query = "SELECT p.*,  j.jobtitle, s.deptName, a.userName
				FROM tbl_interview as p,  tbl_jobtitle as j, tbl_department as s, tbl_user_reg as a
				WHERE  p.jId = j.jId AND p.userId = a.regId ORDER BY p.id DESC";*/
		$query = "SELECT p.*, j.jobtitle, a.userName FROM tbl_interview as p, tbl_jobtitle as j, tbl_user_reg as a
					 WHERE p.jId = j.jId AND p.userId = a.regId AND status = '3' ORDER BY p.id DESC";

				$value = $this->db->select($query);
				return $value;
     }
    public function preselectPerson($prestatus, $uId, $jId){
     	$prestatus = mysqli_real_escape_string($this->db->link, $prestatus);

     	$Mquery = "SELECT * FROM step_07 WHERE userId = '$uId' AND preselect = '1'";
     	$data = $this->db->select($Mquery);
     	if ($data) {
     		$msg = "<span style='color:red;'>You Already Pre-Selected This Person</span>";
     		return $msg;
     	}

     	$Cquery = "SELECT * FROM tbl_user_reg WHERE regId = '$uId'";
     	$reasult = $this->db->select($Cquery)->fetch_assoc();
     	$email = $reasult['email'];
     	$phone = $reasult['phone'];
     	$userName = $reasult['userName'];
        
        $Jquery = "SELECT p.*, j.jobtitle FROM tbl_interview as p, tbl_jobtitle as j WHERE p.jId = j.jId AND p.userId = '$uId' AND p.jId = '$jId' ";
        $result = $this->db->select($Jquery)->fetch_assoc();
        $job = $result['jobtitle'];
        
       $Iquery = "SELECT * FROM tbl_user_job WHERE jId = '$jId'";
     	$reasult = $this->db->select($Iquery)->fetch_assoc();
     	$expDate = $reasult['expDate']; 
        
     	$Iquery = "SELECT * FROM tbl_interview WHERE userId = '$uId' AND jId = '$jId'";
     	$reasult = $this->db->select($Iquery)->fetch_assoc();
     	$interviewdate = $reasult[' batch'];
     	$interviewdate = $reasult['interviewdate'];
     	
     	
     	$query = "INSERT INTO step_07(userId, jId, email, phone, batch, interviewDate, preselect) VALUES('$uId', '$jId',  '$email', '$phone', '$batch', '$interviewdate', '$prestatus')";
     	$ressult = $this->db->insert($query);
     	if($ressult){
     		//$msg = "<span style='color:green'>Pre-Selected</span>";
     		//return $msg;
     				?>
                                <script>
                                alert('Pre-Joining letter has been sent');
                                window.location.href='step_7';
                                </script>
                            <?php


							$headers = 'From: '.$email."\r\n".
							 
							'Reply-To: '.$email."\r\n" .
							 
							'X-Mailer: PHP/' . phpversion();

							$email_to = "recruitment@keal.com.bd";
							$email_subject= "Pre-selection Confirmation Letter";
							$email_message= "
Dear $userName,
 
Congratulations!!
 
We are happy to confirm that recruitment team has found your interview to be
satisfactory.
 
In order to complete the hr formalities you need to complete one more step.
Please click the following link if you agree to the general terms and conditions
of this appointment:
 
I Agree:
http://career.keal.com.bd/LoginRegistrationForm/admin/selection?phone=$phone 
 
If you think that you are not ready to undertake this appointment please click
the following link:
 
I Do Not Agree:
 
http://career.keal.com.bd/LoginRegistrationForm/admin/reject_selection?phone=$phone
 
Hurry up as much delay may cancel your application.
 
We felicitate you once again for coming so far to make yourself a worthy
candidate for the job. Success in career is in your hand.
 
 
Thank you
 
Recruitment Office
Kyoto Engineering & Automation Ltd
B2 House 64 Block B Road 3
Niketon Gulshan Dhaka 1212
 
Emergency Contact Numbers:
01844046645
01844046632
01844046666";
							$headers1 = 'From: '.$email_to."\r\n".
							 
							'Reply-To: '.$email_to."\r\n" .
							 
							'X-Mailer: PHP/' . phpversion();

							$email_subject1= "Pre-selection Confirmation Letter";
							$email_message1= "
Dear $userName,
 
Congratulations!!
 
We are happy to confirm that recruitment team has found your interview to be
satisfactory.
 
In order to complete the hr formalities you need to complete one more step.
Please click the following link if you agree to the general terms and conditions
of this appointment:
 
I Agree:
http://career.keal.com.bd/LoginRegistrationForm/admin/selection?phone=$phone 
 
 
If you think that you are not ready to undertake this appointment please click
the following link:
 
I Do Not Agree:
 
http://career.keal.com.bd/LoginRegistrationForm/admin/reject_selection?phone=$phone
 
Hurry up as much delay may cancel your application.
 
We felicitate you once again for coming so far to make yourself a worthy
candidate for the job. Success in career is in your hand.
 
 
Thank you
 
Recruitment Office
Kyoto Engineering & Automation Ltd
B2 House 64 Block B Road 3
Niketon Gulshan Dhaka 1212
 
Emergency Contact Numbers:
01844046645
01844046632
01844046666";
						$email_message2= 'Date'.$date."\r\n";
							mail("<$email_to>","$email_subject","$email_message","$headers");

							mail("<$email>","$email_subject1","$email_message1","$headers1");
				
						}else{
						    $msg = "Your Option Not Recorded";
						    return $msg;
						}
     		
     
     	}
     
     
     public function deselectPerson($deselect, $uId, $jId){
     	$deselect = mysqli_real_escape_string($this->db->link, $deselect);

     	$Mquery = "SELECT * FROM step_07 WHERE userId = '$uId'";
     	$data = $this->db->select($Mquery);
     	if ($data) {
     		$msg = "<span style='color:red;'>You Already DeSelected This Person</span>";
     		return $msg;
     	}

     	$Cquery = "SELECT * FROM tbl_user_reg WHERE regId = '$uId'";
     	$reasult = $this->db->select($Cquery)->fetch_assoc();
     	$email = $reasult['email'];
     	$phone = $reasult['phone'];
     	$userName = $reasult['userName'];
        
        $Jquery = "SELECT p.*, j.jobtitle FROM tbl_interview as p, tbl_jobtitle as j WHERE p.jId = j.jId AND p.userId = '$uId' AND p.jId = '$jId' ";
        $result = $this->db->select($Jquery)->fetch_assoc();
        $job = $result['jobtitle'];
        
        
     	$Iquery = "SELECT * FROM tbl_interview WHERE userId = '$uId' AND jId = '$jId'";
     	$reasult = $this->db->select($Iquery)->fetch_assoc();
     	$interviewdate = $reasult['interviewdate'];
     	
     	$query = "INSERT INTO step_07(userId, jId, email, phone, interviewDate, deselect) VALUES('$uId', '$jId', '$email',  '$phone', '$interviewdate', '$deselect')";
     	$ressult = $this->db->insert($query);
     	if($ressult){
     		//$msg = "<span style='color:green;'>DeSelected</span>";
     		//return $msg;
             		//$msg = "<span style='color:green'>Pre-Selected</span>";
     		//return $msg;
     				?>
                                <script>
                                alert('Regret letter has been sent');
                                window.location.href='step_7';
                                </script>
                            <?php


							$headers = 'From: '.$email."\r\n".
							 
							'Reply-To: '.$email."\r\n" .
							 
							'X-Mailer: PHP/' . phpversion();

							$email_to = "recruitment@keal.com.bd";
							$email_subject= "Regret Letter";
							$email_message= "
 
Dear $userName 

We are writing this letter with respect to your recent application for the
following position: 

Applied Position: $job

It was a pleasure to learn about your skills and accomplishments. We are
thankful to you for your efforts and your cooperation. We thank you also for
taking the time to express your mind regarding the position. It gave us the
opportunity to also explain to you what we expect from a candidate for this job.

After careful thoughts we have decided to drop you off from the candidacy for
the abovementioned position. Although your qualifications are impressive, at
this point of time, we have to do without you. Unfortunately, your application
process ends here.

Now that we’ve had the chance to know more about you, we will be keeping your
resume on file for future openings that better fit your profile. Do not get
disheartened. I would recommend you to stay connected to us so that you do not
miss the next opportunity.

I am happy to answer your questions if you would like any specific feedback
about your application or interviews.

Thanks again for your interest in us and best of luck with all your future
undertakings with positive intent. 

See you again!!

Best Regards,

Recruitment Officer 
Kyoto Engineering & Automation Ltd.";
							$headers1 = 'From: '.$email_to."\r\n".
							 
							'Reply-To: '.$email_to."\r\n" .
							 
							'X-Mailer: PHP/' . phpversion();

							$email_subject1= "Regret Letter";
							$email_message1= "

Dear $userName 

We are writing this letter with respect to your recent application for the
following position:

Applied Position: $job

It was a pleasure to learn about your skills and accomplishments. We are
thankful to you for your efforts and your cooperation. We thank you also for
taking the time to express your mind regarding the position. It gave us the
opportunity to also explain to you what we expect from a candidate for this job.

After careful thoughts we have decided to drop you off from the candidacy for
the abovementioned position. Although your qualifications are impressive, at
this point of time, we have to do without you. Unfortunately, your application
process ends here.

Now that we’ve had the chance to know more about you, we will be keeping your
resume on file for future openings that better fit your profile. Do not get
disheartened. I would recommend you to stay connected to us so that you do not
miss the next opportunity.

I am happy to answer your questions if you would like any specific feedback
about your application or interviews.

Thanks again for your interest in us and best of luck with all your future
undertakings with positive intent. 

See you again!!

Best Regards,

Recruitment Officer 
Kyoto Engineering & Automation Ltd.
";
						$email_message2= 'Date'.$date."\r\n";
							mail("<$email_to>","$email_subject","$email_message","$headers");

							mail("<$email>","$email_subject1","$email_message1","$headers1");
				
						}else{
						    $msg = "Your Option Not Recorded";
						    return $msg;
						}
     		
     	}
     public function getallpreselect(){
     	$query = "SELECT p.*, n.userName, j.jobtitle
     	FROM step_07 as p, tbl_user_reg as n, tbl_jobtitle as j WHERE p.userId = n.regId AND p.jId = j.jId AND preselect = '1' ORDER BY p.id DESC";
     	$result = $this->db->select($query);
     	return $result;
     }
      
     
    public function getonlypreselect(){
      	$query = "SELECT p.*, n.userName, j.jobtitle
     	FROM step_07 as p, tbl_user_reg as n, tbl_jobtitle as j WHERE p.userId = n.regId AND p.jId = j.jId AND preselect = '1' AND jobstatus = '1' ORDER BY p.id DESC";
     	$result = $this->db->select($query);
     	return $result;       
    }
    //   public function getattatchmentdate(){
    //   	$query = "SELECT * FROM tbl_attatchment";
    //  	$result = $this->db->select($query);
    //  	return $result;       
    // }   
        public function getallPselect(){
     	$query = "SELECT p.*, n.userName, j.jobtitle
     	FROM step_07 as p, tbl_user_reg as n, tbl_jobtitle as j WHERE p.userId = n.regId AND p.jId = j.jId AND jobstatus = '1' ORDER BY p.id DESC";
     	$result = $this->db->select($query);
     	return $result;
     }

     public function deletedeselect($uId, $jId){
     	$query = "DELETE FROM tbl_interview WHERE userId = '$uId' AND jId = '$jId'";
     	$result = $this->db->delete($query);
     	if ($result) {
     		$msg = 'Rejected & Thrown Into Step 0';
     		return $msg;
     	}else{
     		$msg = 'Rejected & Thrown Into Step 0';
     		return $msg;
     	}
     }

     public function deleteodeselect($uId, $jId){
     	$query = "DELETE FROM tbl_interview WHERE userId = '$uId' AND jId = '$jId'";
     	$result = $this->db->delete($query);
     	if ($result) {
     		$msg = 'Rejected & Thrown Into Step 0';
     		return $msg;
     	}else{
     		$msg = 'Rejected & Thrown Into Step 0';
     		return $msg;
     	}
     }

     public function applyHistory($uId, $jId){
     	$query = "SELECT * FROM tbl_apply WHERE userId = '$uId' AND jId = '$jId'";
     	$result = $this->db->select($query)->fetch_assoc();

     	$dId = $result['dId'];
     	$levelId = $result['LevelId'];
     	$lastdate = $result['lastdApplication'];
     	$degId = $result['degId'];
     	$mimcomp = $result['mimcomp'];
     	$mxmcomp = $result['mxmComp'];
     	$expdate = $result['expDate'];
     	$prerequisite = $result['preRequisite'];
     	
     	

     	$query = "INSERT INTO tbl_apply_record(userId, jId, dId, levelId, lastdApplication, degId, mimcomp, mxmcomp, expDate, prerequisite) VALUES('$uId', '$jId', '$dId', '$levelId', '$lastdate', '$degId', '$mimcomp', '$mxmcomp', '$expdate', '$prerequisite')";
     	$result = $this->db->insert($query);
     	if ($result) {
     		$msg = "apply Record";
     		return $msg;     	
     }else{
     	$msg = "apply Record";
     		return $msg;   
     }
}

 public function rejectHistory($uId, $jId){
     	$query = "SELECT * FROM tbl_apply WHERE userId = '$uId' AND jId = '$jId'";
     	$getdata = $this->db->select($query);
     	if ($getdata) {
     		while ($result = $getdata->fetch_assoc()) {
     	$dId = $result['dId'];
     	$levelId = $result['LevelId'];
     	$lastdate = $result['lastdApplication'];
     	$degId = $result['degId'];
     	$mimcomp = $result['mimcomp'];
     	$mxmcomp = $result['mxmComp'];
     	$expdate = $result['expDate'];
     	$prerequisite = $result['preRequisite'];
     		}
     	}

 $Jquery = "SELECT p.*, j.jobtitle FROM tbl_apply as p, tbl_jobtitle as j WHERE p.jId = j.jId AND p.userId = '$uId' AND p.jId = '$jId' ";
        $result = $this->db->select($Jquery)->fetch_assoc();
        $job = $result['jobtitle'];
        
     	$Cquery = "SELECT * FROM tbl_user_reg WHERE regId = '$uId'";
     	$reasult = $this->db->select($Cquery)->fetch_assoc();
     	$email = $reasult['email'];
     	$phone = $reasult['phone'];
     	$userName = $reasult['userName'];

     	$query = "INSERT INTO tbl_apply_record(userId, jId, dId, levelId, lastdApplication, degId, mimcomp, mxmcomp, expDate, prerequisite) VALUES('$uId', '$jId', '$dId', '$levelId', '$lastdate', '$degId', '$mimcomp', '$mxmcomp', '$expdate', '$prerequisite')";
     	$result = $this->db->insert($query);
     	if ($result) {
	     				?>
                                <script>
                                alert('Reject letter has been sent');
                                window.location.href='step_7';
                                </script>
                            <?php


							$headers = 'From: '.$email."\r\n".
							 
							'Reply-To: '.$email."\r\n" .
							 
							'X-Mailer: PHP/' . phpversion();

							$email_to = "recruitment@keal.com.bd";
							$email_subject= "Regret Letter";
							$email_message= "
Dear $userName,
 
We are writing this letter with respect to your recent application for the
following position:

Applied Position: $job

It was a pleasure to learn about your skills and accomplishments. We are
thankful to you for your efforts and your cooperation. We thank you also for
taking the time to express your mind regarding the position. It gave us the
opportunity to also explain to you what we expect from a candidate for this job.

After careful thoughts we have decided to drop you off from the candidacy for
the abovementioned position. Although your qualifications are impressive, at
this point of time, we have to do without you. Unfortunately, your application
process ends here.

Now that we’ve had the chance to know more about you, we will be keeping your
resume on file for future openings that better fit your profile. Do not get
disheartened. I would recommend you to stay connected to us so that you do not
miss the next opportunity.

I am happy to answer your questions if you would like any specific feedback
about your application or interviews.

Thanks again for your interest in us and best of luck with all your future
undertakings with positive intent. 

See you again!!

Best Regards,

Recruitment Officer 
Kyoto Engineering & Automation Ltd.";
							$headers1 = 'From: '.$email_to."\r\n".
							 
							'Reply-To: '.$email_to."\r\n" .
							 
							'X-Mailer: PHP/' . phpversion();

							$email_subject1= "Regret Letter";
							$email_message1= "
Dear $userName,
 
We are writing this letter with respect to your recent application for the
following position:

Applied Position: $job

It was a pleasure to learn about your skills and accomplishments. We are
thankful to you for your efforts and your cooperation. We thank you also for
taking the time to express your mind regarding the position. It gave us the
opportunity to also explain to you what we expect from a candidate for this job.

After careful thoughts we have decided to drop you off from the candidacy for
the abovementioned position. Although your qualifications are impressive, at
this point of time, we have to do without you. Unfortunately, your application
process ends here.

Now that we’ve had the chance to know more about you, we will be keeping your
resume on file for future openings that better fit your profile. Do not get
disheartened. I would recommend you to stay connected to us so that you do not
miss the next opportunity.

I am happy to answer your questions if you would like any specific feedback
about your application or interviews.

Thanks again for your interest in us and best of luck with all your future
undertakings with positive intent. 

See you again!!

Best Regards,

Recruitment Officer 
Kyoto Engineering & Automation Ltd.";
						$email_message2= 'Date'.$date."\r\n";
							mail("<$email_to>","$email_subject","$email_message","$headers");

							mail("<$email>","$email_subject1","$email_message1","$headers1");
				
     }else{
     	$msg = "apply Record";
     		return $msg;   
     }
}

public function rejectoHistory($uId, $jId){
     	$query = "SELECT * FROM tbl_apply WHERE userId = '$uId' AND jId = '$jId'";
     	$getdata = $this->db->select($query);
     	if ($getdata) {
     		while ($result = $getdata->fetch_assoc()) {
     	$dId = $result['dId'];
     	$levelId = $result['LevelId'];
     	$lastdate = $result['lastdApplication'];
     	$degId = $result['degId'];
     	$mimcomp = $result['mimcomp'];
     	$mxmcomp = $result['mxmComp'];
     	$expdate = $result['expDate'];
     	$prerequisite = $result['preRequisite'];
     		}
     	}

 $Jquery = "SELECT p.*, j.jobtitle FROM tbl_apply as p, tbl_jobtitle as j WHERE p.jId = j.jId AND p.userId = '$uId' AND p.jId = '$jId' ";
        $result = $this->db->select($Jquery)->fetch_assoc();
        $job = $result['jobtitle'];
        
     	$Cquery = "SELECT * FROM tbl_user_reg WHERE regId = '$uId'";
     	$reasult = $this->db->select($Cquery)->fetch_assoc();
     	$email = $reasult['email'];
     	$phone = $reasult['phone'];
     	$userName = $reasult['userName'];

     	$query = "INSERT INTO tbl_apply_record(userId, jId, dId, levelId, lastdApplication, degId, mimcomp, mxmcomp, expDate, prerequisite) VALUES('$uId', '$jId', '$dId', '$levelId', '$lastdate', '$degId', '$mimcomp', '$mxmcomp', '$expdate', '$prerequisite')";
     	$result = $this->db->insert($query);
     	if ($result) {
	     				?>
                                <script>
                                alert('Reject letter has been sent');
                                window.location.href='step_2';
                                </script>
                            <?php


							$headers = 'From: '.$email."\r\n".
							 
							'Reply-To: '.$email."\r\n" .
							 
							'X-Mailer: PHP/' . phpversion();

							$email_to = "recruitment@keal.com.bd";
							$email_subject= "Regret Letter";
							$email_message= "
Dear $userName,
 
We are writing this letter with respect to your recent application for the
following position:

Applied Position: $job

It was a pleasure to learn about your skills and accomplishments. We are
thankful to you for your efforts and your cooperation. We thank you also for
taking the time to express your mind regarding the position. It gave us the
opportunity to also explain to you what we expect from a candidate for this job.

After careful thoughts we have decided to drop you off from the candidacy for
the abovementioned position. Although your qualifications are impressive, at
this point of time, we have to do without you. Unfortunately, your application
process ends here.

Now that we’ve had the chance to know more about you, we will be keeping your
resume on file for future openings that better fit your profile. Do not get
disheartened. I would recommend you to stay connected to us so that you do not
miss the next opportunity.

I am happy to answer your questions if you would like any specific feedback
about your application or interviews.

Thanks again for your interest in us and best of luck with all your future
undertakings with positive intent. 

See you again!!

Best Regards,

Recruitment Officer 
Kyoto Engineering & Automation Ltd.";
							$headers1 = 'From: '.$email_to."\r\n".
							 
							'Reply-To: '.$email_to."\r\n" .
							 
							'X-Mailer: PHP/' . phpversion();

							$email_subject1= "Regret Letter";
							$email_message1= "
Dear $userName,
 
We are writing this letter with respect to your recent application for the
following position:

Applied Position: $job

It was a pleasure to learn about your skills and accomplishments. We are
thankful to you for your efforts and your cooperation. We thank you also for
taking the time to express your mind regarding the position. It gave us the
opportunity to also explain to you what we expect from a candidate for this job.

After careful thoughts we have decided to drop you off from the candidacy for
the abovementioned position. Although your qualifications are impressive, at
this point of time, we have to do without you. Unfortunately, your application
process ends here.

Now that we’ve had the chance to know more about you, we will be keeping your
resume on file for future openings that better fit your profile. Do not get
disheartened. I would recommend you to stay connected to us so that you do not
miss the next opportunity.

I am happy to answer your questions if you would like any specific feedback
about your application or interviews.

Thanks again for your interest in us and best of luck with all your future
undertakings with positive intent. 

See you again!!

Best Regards,

Recruitment Officer 
Kyoto Engineering & Automation Ltd.";
						$email_message2= 'Date'.$date."\r\n";
							mail("<$email_to>","$email_subject","$email_message","$headers");

							mail("<$email>","$email_subject1","$email_message1","$headers1");
				
     }else{
     	$msg = "apply Record";
     		return $msg;   
     }
}


 public function deleteapply($uId, $jId){
     	$query = "DELETE FROM tbl_apply WHERE userId = '$uId' AND jId = '$jId'";
     	$result = $this->db->delete($query);
     	if ($result) {
     		$msg = 'Rejected & Thrown Into Step 0';
     		return $msg;
     	}else{
     		$msg = 'Rejected & Thrown Into Step 0';
     		return $msg;
     	}
     }
     
  public function deleteoapply($uId, $jId){
     	$query = "DELETE FROM tbl_apply WHERE userId = '$uId' AND jId = '$jId'";
     	$result = $this->db->delete($query);
     	if ($result) {
     		$msg = 'Rejected & Thrown Into Step 0';
     		return $msg;
     	}else{
     		$msg = 'Rejected & Thrown Into Step 0';
     		return $msg;
     	}
     }
     
public function selectPerson($selected, $uId, $jId){
	$selected = mysqli_real_escape_string($this->db->link, $selected);
    
    $Mquery = "SELECT * FROM tbl_user_reg WHERE regId = '$uId'";
	$result = $this->db->select($Mquery)->fetch_assoc();
	$email = $result['email'];
	$userName = $result['userName'];
	
	 $Jquery = "SELECT p.*, j.jobtitle FROM tbl_interview as p, tbl_jobtitle as j WHERE p.jId = j.jId AND p.userId = '$uId' AND p.jId = '$jId' ";
        $result = $this->db->select($Jquery)->fetch_assoc();
        $job = $result['jobtitle'];
    
	$query = "UPDATE step_07 SET selected = '$selected' WHERE userId = '$uId' AND jId = '$jId'";
	$result = $this->db->update($query);
	if ($result) {
		     		//$msg = "<span style='color:green;'>DeSelected</span>";
     		//return $msg;
             		//$msg = "<span style='color:green'>Pre-Selected</span>";
     		//return $msg;
     				?>
                                <script>
                                alert('Selection letter has been sent');
                                window.location.href='step_8';
                                </script>
                            <?php


							$headers = 'From: '.$email."\r\n".
							 
							'Reply-To: '.$email."\r\n" .
							 
							'X-Mailer: PHP/' . phpversion();

							$email_to = "recruitment@keal.com.bd";
							$email_subject= " Congratulations";
							$email_message= "
 
Dear $userName,
Heartiest Congratulations to you!!
 
You have been selected by the Recruitment Team after a satisfactory interview
for the following position:

Job Title: $job


Soon, HR shall send you a checklist and formal offer letter for your ready
reference. Please complete the checklist and consult with the HR if you have any
shortcomings in terms of the checklist. Very soon you will also receive a
Joining Instruction from HR detailing the date and time of reporting & joining.
 
Please do not forget to complete your Referee Information and get the reference
formalities completed before joining which is integral and pre-requisite to the
recruitment process. If you have not completed yet, please go to the following
link:
 
Link: https://career.keal.com.bd/LoginRegistrationForm/reference
 
If you have not heard from HR with a formal letter contact us directly by a
physical visit by you within 7 days from issuance of this email/ letter.
 
Thank you
 
Recruitment Office
Kyoto Engineering & Automation Ltd
B2 House 64 Block B Road 3
Niketon Gulshan Dhaka 1212
 
Emergency Contact Numbers:
01844046645
01844046631
01844046666";
							$headers1 = 'From: '.$email_to."\r\n".
							 
							'Reply-To: '.$email_to."\r\n" .
							 
							'X-Mailer: PHP/' . phpversion();

							$email_subject1= " Congratulations";
							$email_message1= "

Dear $userName,
Heartiest Congratulations to you!!
 
You have been selected by the Recruitment Team after a satisfactory interview
for the following position:

Job Title: $job


Soon, HR shall send you a checklist and formal offer letter for your ready
reference. Please complete the checklist and consult with the HR if you have any
shortcomings in terms of the checklist. Very soon you will also receive a
Joining Instruction from HR detailing the date and time of reporting & joining.
 
Please do not forget to complete your Referee Information and get the reference
formalities completed before joining which is integral and pre-requisite to the
recruitment process. If you have not completed yet, please go to the following
link:
 
Link: https://career.keal.com.bd/LoginRegistrationForm/reference
 
If you have not heard from HR with a formal letter contact us directly by a
physical visit by you within 7 days from issuance of this email/ letter.
 
Thank you
 
Recruitment Office
Kyoto Engineering & Automation Ltd
B2 House 64 Block B Road 3
Niketon Gulshan Dhaka 1212
 
Emergency Contact Numbers:
01844046645
01844046631
01844046666
";
						$email_message2= 'Date'.$date."\r\n";
							mail("<$email_to>","$email_subject","$email_message","$headers");

							mail("<$email>","$email_subject1","$email_message1","$headers1");
				
						}else{
						    $msg = "Your Option Not Recorded";
						    return $msg;
						}
}

public function getjobstatus(){
     	$query = "SELECT p.*, n.userName, j.jobtitle
     	FROM tbl_attatchment as p, tbl_user_reg as n, tbl_jobtitle as j WHERE p.userId = n.regId AND p.jId = j.jId AND status = '1' ORDER BY p.id DESC";
     	$result = $this->db->select($query);
     	return $result;
     }



public function getPreselect($uId, $jId){
    $query = "SELECT * FROM step_07 WHERE userId = '$uId' AND jId = '$jId'";
    $result = $this->db->select($query);
    return $result;
}
public function getallJoined(){
    $query = "SELECT p.*, n.userName FROM tbl_joining_info as p, tbl_user_reg as n  WHERE p.userId = n.regId AND p.disable = '0' ORDER BY p.id DESC ";
    /*$query = "SELECT p.*, u.userName FROM tbl_joining_info as p, tbl_user_reg as u WHERE p.userId = u.regId ORDER BY p.id DESC";*/
    //$query = "SELECT * FROM tbl_joining_info ORDER BY id DESC";
    $result = $this->db->select($query);
    return $result;
}
public function getbatch(){
    $query = "SELECT p.*, n.batch, j.jobTitle FROM tbl_joining_info as p, tbl_apply as n, tbl_jobtitle as j  WHERE p.userId = n.userId AND j.jId=n.jId ORDER BY p.userId DESC ";
    $result = $this->db->select($query);
    return $result;
}

public function getUserBatch(){
    $query = "SELECT p.*, n.batch FROM step_07 as p, tbl_interview as n  WHERE p.userId = n.userId  ORDER BY p.userId DESC ";
    $result = $this->db->select($query);
   
    
}
 public function removepreselect($uId, $jId){
     $Uquery = "UPDATE step_07 SET preselect = '0' WHERE userId = '$uId' AND jId = '$jId'";
     $result = $this->db->update($Uquery);
     if($result){
         $msg = "updated";
     }else{
         $msg = "not updated";
     }
 }

public function getallshortlisted($userId, $jId){
	$query = "SELECT status FROM tbl_apply WHERE userId = '$userId' AND jId = '$jId' LIMIT 1";
	$res = $this->db->select($query);
	return $res;
}
 public function getsignupList(){
    $query = "SELECT * FROM tbl_user_reg ORDER BY regId DESC";
    $result = $this->db->select($query);
    return $result;
}
public function getsigninList(){
    $query = "SELECT p.*, n.userName,n.email,n.phone FROM tbl_urecord as p, tbl_user_reg as n  WHERE p.userId = n.regId  ORDER BY p.id DESC ";
    $result = $this->db->select($query);
    return $result;
}
public function selectAttendencePerson($uId, $jId, $dateTime){
	$query = "SELECT * FROM tbl_user_reg WHERE regId = '$uId'";
	$res = $this->db->select($query);
	if ($res) {
		while ($data = $res->fetch_assoc()) {
			$email = $data['email'];
			$phone = $data['phone'];
			$name  = $data['userName'];
		}
	}

	$insert_row = "INSERT INTO employee(userId, jId, user, email, phone, sdate) VALUES('$uId', '$jId', '$name', '$email', '$phone', '$dateTime')";
	$inserted = $this->db->insert($insert_row);
	if ($inserted) {
					?>
			<script>var my_time = new Date(); alert('Shift Into Employee Table...'+my_time);
                        window.location = '';
                        </script>
			<?php
	}else{
							?>
			<script>var my_time = new Date(); alert('Not Shift Into Employee Table...'+my_time);
                        window.location = '';
                        </script>
			<?php
	}
}

public function selectAttendencePersonlist($uId, $officeemail, $date){

$officeemail = mysqli_real_escape_string($this->db->link, $officeemail);

	 $query = "SELECT * FROM tbl_user_reg WHERE regId = '$uId'";
	 $res = $this->db->select($query);
	 if ($res) {
	 	while ($data = $res->fetch_assoc()) {
	 		$name  = $data['userName'];
	 	}
	}

	$query = "SELECT * FROM step_07 WHERE userId = '$uId'";
	$res = $this->db->select($query);
	if ($res) {
		while ($data = $res->fetch_assoc()) {
			$jId = $data['jId'];
			$phone = $data['phone'];
			
			$email = $data['email'];
		}
	}

	$insert_row = "INSERT INTO employee(userId, jId, user, email, officeemail, phone, sdate) VALUES('$uId', '$jId', '$name', '$email', '$officeemail', '$phone', '$date')";
	$inserted = $this->db->insert($insert_row);
	if ($inserted) {
								?>
			<script>var my_time = new Date(); alert('Shift Into Employee Table...'+my_time);
                        window.location = '';
                        </script>
			<?php	
	}else{
								?>
			<script>var my_time = new Date(); alert('Not Shift Into Employee Table...'+my_time);
                        window.location = '';
                        </script>
			<?php
	}
}


public function getenlistedpeople(){
	$query = "SELECT p.*, n.userName, j.jobtitle FROM employee as p, tbl_user_reg as n, tbl_jobtitle as j WHERE 
	p.userId = n.regId AND p.jId = j.jId ORDER BY p.id DESC";
	$result = $this->db->select($query);
	return $result;
}

public function getallsuccesses(){
	$query = "SELECT p.*, j.jobtitle, a.userName FROM tbl_disappertime as p, tbl_jobtitle as j, tbl_user_reg as a
					 WHERE p.jId = j.jId AND p.userId = a.regId AND status = '1' ORDER BY p.id DESC";

				$value = $this->db->select($query);
				return $value;
}
public function getallpresents(){
     	$query="SELECT p.*,j.jobtitle,a.userName FROM tbl_disappertime as p,tbl_jobtitle as j,tbl_user_reg as a WHERE p.jId =j.jId AND p.userId =a.regId AND status='1' ORDER BY p.id DESC";
     	$value= $this->db->select($query);
     	return $value;
     }

public function getPreselects($uId, $jId){
    $query = "SELECT * FROM step_07 WHERE userId = '$uId' AND jId = '$jId'";
    $result = $this->db->select($query);
    return $result;
}

public function getallone( $uId ){
    $query = "SELECT * FROM employee WHERE userId = '$uId'";
    $result = $this->db->select($query);
    return $result;    
}
}?>