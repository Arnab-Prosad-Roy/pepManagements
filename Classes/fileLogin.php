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
	class Filelogin
	{
		private $db;
		private $fm;

		public function __construct()
	
		{
			$this->db = new Database();
			$this->fm = new Format();
		}	

		public function employeelogin($email, $pass){
			$email = $this->fm->validation($email);
			$password = $this->fm->validation($pass);
			
			$pass = mysqli_real_escape_string($this->db->link, md5($password) );


		if (empty($email) || empty($pass)) {
			$logmsg = "Username Or Password Must Not be Empty!!";
			return $logmsg;
		}else{
			$query = "SELECT * FROM tbl_filelogin WHERE email = '$email' AND password = '$pass'";
			$result = $this->db->select($query);
			if ($result !=false) {
				$value = $result->fetch_assoc();
				Session::set("login", true);
				Session::set("userId",   $value['userId']);
				Session::set("uname", $value['user']);
				
				header("Location:index");
			}else{
				$logmsg = "Username Or Password Not Match!!";
			    return $logmsg;
			}
		}
	}

	}?>