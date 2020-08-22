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
	class Employeelogin
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
			$pass = $this->fm->validation($pass);
			// $query = "SELECT * FROM tbl_user_reg WHERE userName = '$userName' AND phone = '$pass'";
			// $result = $this->db->select($query);
			// if ($result !=false) {
			// 	$value = $result->fetch_assoc();
			// 	Session::set("login", true);
			// 	Session::set("userId",   $value['regId']);
			// 	Session::set("userName", $value['userName']);
				
			// 	header("Location:index.php");
			// }else{
			// 	$logmsg = "Username Or Password Not Match!!";
			//     return $logmsg;
			// }

		if (empty($email) || empty($pass)) {
			$logmsg = "Username Or Password Must Not be Empty!!";
			return $logmsg;
		}else{
			$query = "SELECT * FROM employee WHERE officeemail = '$email' AND phone = '$pass' AND stat='1'";
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