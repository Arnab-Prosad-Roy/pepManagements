<?php
 include_once "lib/Session.php";
  Session::checkLogin();
  ?>

<?php include_once "lib/Database.php"; ?>
<?php include_once "helpers/Format.php"; ?>
<?php
/**
* class for sign up & sign ion
*/
class Signup
{
	
	private $db;
	private $fm;
	public function __construct()
	{
		$this->db = new Database();
		$this->fm = new Format();
	}


	public function getspecilization(){
		$query = "SELECT * FROM tbl_specialization ORDER BY spId DESC";
		$result = $this->db->select($query);
		return $result;
	}

	public function getHeducation(){
		$query = "SELECT * FROM tbl_hedu ORDER BY HID DESC";
		$result = $this->db->select($query);
		return $result;
	}

	public function userRegistration($data, $u_ip){

		
		$userName     = mysqli_real_escape_string($this->db->link, $data['userName']);
		
		$email     = mysqli_real_escape_string($this->db->link, $data['email']);
		$phone     = mysqli_real_escape_string($this->db->link, $data['phone']);
		$dob       = mysqli_real_escape_string($this->db->link, $data['dob']);
		$spId       = mysqli_real_escape_string($this->db->link, $data['spId']);

		if ($userName == "" || $email == "" || $phone == "" || $phone == "" || $dob == "" || $spId == "" ) {
			
			$msg = "<span style='color:red'>Field Must Not Be Empty!!</span>";
			return $msg;
		}
		
		//email field must be uniqe so for doing uniqe need to do
		$mailquery = "SELECT * FROM tbl_user_reg WHERE email = '$email' OR phone= '$phone'  LIMIT 1";
		$mailchk   = $this->db->select($mailquery);
		if ($mailchk != false) {
			$msg = "<span style='color:red'>Email Or Phone Number Already exist!!</span>";
			return $msg;
			//email unique has done

		}else{
			
					
				
						$query = "INSERT INTO tbl_user_reg(userName, email, phone, dob, spId, IP) VALUES('$userName', '$email', '$phone', '$dob', '$spId', '$u_ip')";
	    	 			$inserted_row = $this->db->insert($query);

						if($inserted_row){

							?>
                                <script>
                                alert('Please check your email for account verification!');
                                window.location.href='login#tologin?success';
                                </script>
                            <?php


							$headers = 'From: '.$email."\r\n".
							 
							'Reply-To: '.$email."\r\n" .
							 
							'X-Mailer: PHP/' . phpversion();

							$email_to = "recruitment@keal.com.bd";
							$email_subject= "Account Verification";
							$email_message= "
This person has been registered and sent for email verification:
Name : $userName,
Email : $email";
							
							


							$headers1 = 'From: '.$email_to."\r\n".
							 
							'Reply-To: '.$email_to."\r\n" .
							 
							'X-Mailer: PHP/' . phpversion();

							$email_subject1= "Account Verification";
		  $email_message1= "
Dear $userName,

Welcome Aboard!!
 
Thank you for signing up in our recruitment program.
 
If you have received this email successfully we have verified your
email address properly. Please click the following link to confirm
your acknowledgement of receiving the email:
 
http://career.keal.com.bd/LoginRegistrationForm/verify_email?phone=$phone
 
Please note that the recruitment process would ideally take the
following course:

Step 1: Apply for the job which is available for you and best suits
your career intent
Step 2: You need to complete your resume/CV/biodata according to
prescribed format. You may also upload your resume in pdf format.The
file size should be between 100-300 kb.
Step 3: Now, the Recruitment Officer may select you for an interview
Step 4: Come for the interview on the due date if you are selected
for interview.
Step 5: If you want to reschedule the date you may request for a
Reschedule
Step 6: HR may or may not approve your request for reschedule. If
you are absent for the interview you may all start over from Step 1
 
Please note that in every step you will be notified by email. Please
do not forget to check your Spam or Junk mailbox for the emails and
react to them in time.
    
Note: Your email is your username and put your mobile number as your
password
        
We are excited to have you on board with us in the journey of career
development.
 
Good Luck!!";

	                    mail("<$email_to>","$email_subject","$email_message","$headers");

							mail("<$email>","$email_subject1","$email_message1","$headers1");

						}
					
				}
			}
	

		public function userLogin($email, $phone){
			//$email= mysqli_real_escape_string($this->db->link, $data['email']);
		    //$phone = mysqli_real_escape_string($this->db->link, $data['phone']);


		    //if (empty($email) || empty($phone)) {
		    	/*$msg = "Input User email or Pass";
				return $msg;
		    }

		    $query  = "SELECT * FROM tbl_user_reg WHERE email = '$email' AND phone = '$phone'";
		    	$result = $this->db->select($query);
		    	if ($result !=false) {
		    		$value = $result->fetch_assoc();

		    		Session::set("userLogin", true);
		    		Session::set("userId", $value['regId']);
		    		Session::set("userName",$value['userName']);
		    		echo "<script>window.location = 'index'</script>";

		    	} else{
		    		$msg = "<span style='color:red'>User email or Password Not Match</span>";
				    return $msg;
		    	}*/

		    		$email = $this->fm->validation($email);
					$phone = $this->fm->validation($phone);

		$email = mysqli_real_escape_string($this->db->link, $email);
		$phone = mysqli_real_escape_string($this->db->link, $phone);

		if (empty($email) || empty($phone)) {
			$logmsg = "Username Or Password Must Not be Empty!!";
			return $logmsg;
		}else{
			$query = "SELECT * FROM tbl_user_reg WHERE email = '$email' AND phone = '$phone' AND statuss = '1'";
			$result = $this->db->select($query);
			if ($result !=false) {
				$value = $result->fetch_assoc();
				Session::set("login", true);
				Session::set("userId",   $value['regId']);
				Session::set("userName", $value['userName']);
				
				header("Location:index");
			}else{
				$logmsg = "Username Or Password Not Match!!";
			    return $logmsg;
			}
		}
	}
	

}//main class
?>