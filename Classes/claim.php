<?php
 include_once "../lib/Session.php";
  Session::checkLogin();
  ?>

<?php include_once "../lib/Database.php"; ?>
<?php include_once "../helpers/Format.php"; ?>


<?php
	/**
	* 
	*/
	class claimlogin
	{
		private $db;
		private $fm;

		public function __construct()
	
		{
			$this->db = new Database();
			$this->fm = new Format();
		}	




		public function userLoginfor($email, $pass){
		    		$email = $this->fm->validation($email);
					$pass = $this->fm->validation($pass);

		$email = mysqli_real_escape_string($this->db->link, $email);
		$passw = mysqli_real_escape_string($this->db->link,  md5($pass));

		if (empty($email) || empty($passw)) {
			$logmsg = "Username Or Password Must Not be Empty!!";
			return $logmsg;
		}else{
			$query = "SELECT * FROM tbl_loginclaim WHERE email = '$email' AND password = '$passw' AND activity = '1'";
			$result = $this->db->select($query);
			if ($result !=false) {
				$value = $result->fetch_assoc();
				Session::set("login", true);
				Session::set("userId",   $value['userId']);
				Session::set("userName", $value['user']);
				
				header("Location:index");
			}else{
				$logmsg = "Username Or Password Not Match Again Again!!";
			    return $logmsg;
			}
		}
	}
	}?>