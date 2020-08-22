<?php 
	$filePath = realpath(dirname(__FILE__));
	 include_once ($filePath.'/../lib/Database.php');
	 include_once ($filePath.'/../lib/Session.php');
	 include_once ($filePath.'/../helpers/Format.php');
     
?>

<?php
/**
* 
*/
class Authorization
{
	
	private $db;
	private $fm;
	public function __construct()
	{
		$this->db = new Database();
		$this->fm = new Format();
	}
		public function insertReference($data, $date, $ip, $ref){
			$ref_no = $this->fm->validation($data['ref_no']);
			$cert_no = $this->fm->validation($data['cert_no']);

			$ref_no = mysqli_real_escape_string($this->db->link, $ref_no);
			$cert_no = mysqli_real_escape_string($this->db->link, $cert_no);

			if (empty($ref_no)) {
				$msg = "<div class='alert alert-danger' role='alert'>Field Must Not be Empty.</div>";
				return $msg;
			}else{
				$query = "INSERT INTO tbl_authorization(ref, cert_no, ip, cdate) VALUES('$ref', '$cert_no', '$ip', '$date')";
				$result = $this->db->insert($query);
				if ($result) {
					echo "<script>window.location='information.php?ref_no=$ref&cert_no=$cert_no'</script>";
				}else{
					$msg = "<div class='alert alert-danger' role='alert'>Not Inserted</div>";
					return $msg;
				}
			}
		}

		public function insertReferenceData($data, $date, $ip){
			$ref_no = $this->fm->validation($data['ref_no']);
			$ref_no = mysqli_real_escape_string($this->db->link, $ref_no);
			if (empty($ref_no)) {
				$msg = "<div class='alert alert-danger' role='alert'>Field Must Not be Empty.</div>";
				return $msg;
			}else{
				$query = "INSERT INTO tbl_authorization(ref, ip, cdate) VALUES('$ref_no', '$ip', '$date')";
				$result = $this->db->insert($query);
				if ($result) {
					echo "<script>window.location='step_one.php?ref_no=$ref_no'</script>";
				}else{
					$msg = "<div class='alert alert-danger' role='alert'>Not Inserted</div>";
					return $msg;
				}
			}
		}

public function insertRefInformationDatas($data, $date, $ip, $ref_no){
	$email = $this->fm->validation($data['email']);
	$email = mysqli_real_escape_string($this->db->link, $email);
	$cert_no = "1";
	$equery ="SELECT * FROM tbl_authorization WHERE email='$email'";
	$eresult = $this->db->select($equery);
	if ($eresult) {
		echo "<script>alert('Successfully Created'); window.location='certificate_details.php?ref_no=$ref_no&cert_no=$cert_no'</script>";
	}else{
		echo "<script>window.location='information.php?ref_no=$ref_no'</script>";
	}
}	
		public function insertRefInformation($data, $date, $ip, $ref_no, $cert_no){
			$name = $this->fm->validation($data['name']);
			$cName = $this->fm->validation($data['cName']);
		
			$phone = $this->fm->validation($data['phone']);
			$desig = $this->fm->validation($data['desig']);

			$name = mysqli_real_escape_string($this->db->link, $name);
			$cName = mysqli_real_escape_string($this->db->link, $cName);
		
			$phone = mysqli_real_escape_string($this->db->link, $phone);
			$desig = mysqli_real_escape_string($this->db->link, $desig);
  

  if ($cert_no=="1") {
    $cert="Internship Certificate";
  }elseif ($cert_no=="2") {
    $cert="NOC Letter";
  }

			if (empty($name) || empty($phone)) {
				$msg = "<div class='alert alert-danger' role='alert'>Fields Must Not be Empty.</div>";
				return $msg;
			}else{
				$query = "UPDATE tbl_authorization SET name = '$name', cname = '$cName', phone = '$phone', designation = '$desig' WHERE ref = '$ref_no' AND cert_no = '$cert_no'";
				$result = $this->db->update($query);
				if ($result) {
					echo "<script>alert('Successfully Created'); window.location='certificate_details.php?ref_no=$ref_no&cert_no=$cert_no'</script>";

				$headers = 'From: '.$email."\r\n".
							 
							'Reply-To: '.$email."\r\n" .
							 
							'X-Mailer: PHP/' . phpversion();

							$email_to = "hr@keal.com.bd";
							$email_subject= "Verifying Certificate";
							$email_message= "
Name = $name
Company Name = $cName
Email = $email
Phone = $phone
Designation = $desig
Date = $date
ServerIP = $ip
This Person want to view $cert";

							


							$headers1 = 'From: '.$email_to."\r\n".
							 
							'Reply-To: '.$email_to."\r\n" .
							 
							'X-Mailer: PHP/' . phpversion();

							$email_subject1= "Verifying Certificate";
							$email_message1= "
Name = $name
Company Name = $cName
Email = $email
Phone = $phone
Designation = $desig
Date = $date
ServerIP = $ip
This Person want to view $cert";

							 
							$email_message2= 'Date'.$date."\r\n";
							mail("<$email_to>","$email_subject","$email_message","$headers");

							mail("<$email>","$email_subject1","$email_message1","$headers1");
						
				}else{
					$msg = "<span style='color:red;'>You are not successfully Done</span>";
					return $msg;
				}	

			}
		}


		public function insertRefInformationData($data, $email, $date, $ip, $ref_no){
			$name = $this->fm->validation($data['name']);
			$cName = $this->fm->validation($data['cName']);
			
			$phone = $this->fm->validation($data['phone']);
			$desig = $this->fm->validation($data['desig']);

			$name = mysqli_real_escape_string($this->db->link, $name);
			$cName = mysqli_real_escape_string($this->db->link, $cName);
			$email = mysqli_real_escape_string($this->db->link, $email);
			$phone = mysqli_real_escape_string($this->db->link, $phone);
			$desig = mysqli_real_escape_string($this->db->link, $desig);

			if (empty($name) || empty($email) || empty($phone)) {
				$msg = "<div class='alert alert-danger' role='alert'>Fields Must Not be Empty.</div>";
				return $msg;
			}else{
				$query = "UPDATE tbl_authorization SET name = '$name', cname = '$cName', email = '$email', phone = '$phone', designation = '$desig' WHERE ref = '$ref_no'";
				$result = $this->db->update($query);
				if ($result) {
					echo "<script>alert('Successfully Submitted'); window.location='certificate_details.php?ref_no=$ref_no'</script>";

				$headers = 'From: '.$email."\r\n".
							 
							'Reply-To: '.$email."\r\n" .
							 
							'X-Mailer: PHP/' . phpversion();

							$email_to = "arnab.r@keal.com.bd";
							$email_subject= "Verifying Letter";
							$email_message= "
Name = $name
Company Name = $cName
Email = $email
Phone = $phone
Designation = $desig
Date = $date
ServerIP = $ip
You're verifying letter with this details";

							


							$headers1 = 'From: '.$email_to."\r\n".
							 
							'Reply-To: '.$email_to."\r\n" .
							 
							'X-Mailer: PHP/' . phpversion();

							$email_subject1= "Verifying Letter";
							$email_message1= "
Name = $name
Company Name = $cName
Email = $email
Phone = $phone
Designation = $desig
Date = $date
ServerIP = $ip
$ref=$ref
This Person want to view the Letter";

							 
							$email_message2= 'Date'.$date."\r\n";
							mail("<$email_to>","$email_subject","$email_message","$headers");

							mail("<$email>","$email_subject1","$email_message1","$headers1");
						
				}else{
					$msg = "<span style='color:red;'>You are not successfully Done</span>";
					return $msg;
				}	

			}
		}
		public function getInternCertificateData($ref_no){
			
			$query = "SELECT * FROM tbl_certificate_register WHERE ref = '$ref_no'";
			$result = $this->db->select($query);
			if ($result) {
				$row = $result->fetch_assoc();
				$cId = $row['cId'];
			
			
			//Intern Data
			$iquery = "SELECT * FROM tbl_certificate WHERE id = '$cId'";
			$iresult = $this->db->select($iquery);
			return $iresult;
		}
}
		public function getLetterData($ref_no){
			$query = "SELECT * FROM tbl_letter_register WHERE completeref = '$ref_no'";
			$result = $this->db->select($query);
			if ($result) {
				$row = $result->fetch_assoc();
				$lId = $row['lId'];
			
			
			//Letter Data
				$iquery = "SELECT * FROM tbl_letter_content_support WHERE id = '$lId'";
				$iresult = $this->db->select($iquery);
				if ($iresult) {
					$rowd = $iresult->fetch_assoc();
					$pId = $rowd['addId'];
					$obo = $rowd['on_behalf_of'];

					$pquery = "SELECT * FROM tbl_person_details WHERE id = '$pId'";
					$presult = $this->db->select($pquery);
					return $presult;
				}
			
		}
			
		}
public function getLetterId($ref_no){
			$query = "SELECT * FROM tbl_certificate_register WHERE completeref = '$ref_no'";
			$result = $this->db->select($query);
			return $result;

}
public function getLetterdetails($cId){
			$query = "SELECT * FROM tbl_certificate WHERE id = '$cId'";
			$result = $this->db->select($query);
			return $result;

}
public function getLetterpersondetails($pId){
			$query = "SELECT * FROM tbl_person_details WHERE id = '$pId'";
			$result = $this->db->select($query);
			return $result;

}


		public function getNocData($ref_no){
			$query = "SELECT * FROM tbl_certificate_register WHERE ref = '$ref_no'";
			$result = $this->db->select($query);
			if ($result) {
				$row = $result->fetch_assoc();
				$cId = $row['cId'];
			
			
			//Noc Data
			$iquery = "SELECT a.*, b.user, c.jobtitle FROM tbl_letterof_noc AS a, tbl_employee AS b, tbl_jobtitle AS c WHERE a.employee_name = b.userId AND a.job_title = c.jId AND a.id = '$cId'";
			$iresult = $this->db->select($iquery);
			return $iresult;
			}
		}

	public function getReferenceData($ref){
		$query = "SELECT * FROM tbl_certificate_register WHERE ref = '$ref'";
		$result = $this->db->select($query);
		return $result;
	}





	public function insertnocReferenceData($data, $date, $ip){
			$ref_no = $this->fm->validation($data['ref_no']);
			$ref_no = mysqli_real_escape_string($this->db->link, $ref_no);
			if (empty($ref_no)) {
				$msg = "<div class='alert alert-danger' role='alert'>Field Must Not be Empty.</div>";
				return $msg;
			}else{
				$query = "INSERT INTO tbl_authorization(ref, ip, cdate) VALUES('$ref_no', '$ip', '$date')";
				$result = $this->db->insert($query);
				if ($result) {
					echo "<script>window.location='noc_step_one.php?ref_no=$ref_no'</script>";
				}else{
					$msg = "<div class='alert alert-danger' role='alert'>Not Inserted</div>";
					return $msg;
				}
			}
		}

		public function insertnocRefInformationDatas($data, $date, $ip, $ref_no){
	$email = $this->fm->validation($data['email']);
	$email = mysqli_real_escape_string($this->db->link, $email);
	$cert_no = "2";
	$equery ="SELECT * FROM tbl_authorization WHERE email='$email'";
	$eresult = $this->db->select($equery);
	if ($eresult) {
		echo "<script>alert('Successfully Submitted'); window.location='noc_certificate_details.php?ref_no=$ref_no&cert_no=$cert_no&email=$email'</script>";
	}else{
		echo "<script>window.location='noc_information.php?ref_no=$ref_no&email=$email'</script>";
	}
}

		public function insertnocRefInformationData($data, $email, $date, $ip, $ref_no){
			$name = $this->fm->validation($data['name']);
			$cName = $this->fm->validation($data['cName']);
			
			$phone = $this->fm->validation($data['phone']);
			$desig = $this->fm->validation($data['desig']);

			$name = mysqli_real_escape_string($this->db->link, $name);
			$cName = mysqli_real_escape_string($this->db->link, $cName);
			$email = mysqli_real_escape_string($this->db->link, $email);
			$phone = mysqli_real_escape_string($this->db->link, $phone);
			$desig = mysqli_real_escape_string($this->db->link, $desig);

			if (empty($name) || empty($email) || empty($phone)) {
				$msg = "<div class='alert alert-danger' role='alert'>Fields Must Not be Empty.</div>";
				return $msg;
			}else{
				$query = "UPDATE tbl_authorization SET name = '$name', cname = '$cName', email = '$email', phone = '$phone', designation = '$desig' WHERE ref = '$ref_no'";
				$result = $this->db->update($query);
				if ($result) {
					echo "<script>alert('Successfully Submitted'); window.location='noc_certificate_details.php?ref_no=$ref_no'</script>";

				$headers = 'From: '.$email."\r\n".
							 
							'Reply-To: '.$email."\r\n" .
							 
							'X-Mailer: PHP/' . phpversion();

							$email_to = "hr@@keal.com.bd";
							$email_subject= "Verifying Letter";
							$email_message= "
Name = $name
Company Name = $cName
Email = $email
Phone = $phone
Designation = $desig
Date = $date
ServerIP = $ip
You're verifying letter with this details";

							


							$headers1 = 'From: '.$email_to."\r\n".
							 
							'Reply-To: '.$email_to."\r\n" .
							 
							'X-Mailer: PHP/' . phpversion();

							$email_subject1= "Verifying Letter";
							$email_message1= "
Name = $name
Company Name = $cName
Email = $email
Phone = $phone
Designation = $desig
Date = $date
ServerIP = $ip
$ref=$ref
This Person want to view the Letter";

							 
							$email_message2= 'Date'.$date."\r\n";
							mail("<$email_to>","$email_subject","$email_message","$headers");

							mail("<$email>","$email_subject1","$email_message1","$headers1");
						
				}else{
					$msg = "<span style='color:red;'>You are not successfully Done</span>";
					return $msg;
				}	

			}
		}

		public function getnocLetterId($ref_no){
			$query = "SELECT * FROM tbl_certificate_register WHERE completeref = '$ref_no'";
			$result = $this->db->select($query);
			return $result;

}

public function getnocLetterdetails($cId){
	
			$query = "SELECT a.*, b.loi_types,  d.deptName, e.userName, e.image, f.*,cn.countryName FROM tbl_letterof_noc AS a, tbl_typesof_loi AS b,  tbl_department AS d, tbl_user_reg AS e, tbl_employee as f,tbl_country  as cn WHERE a.type_of_loi = b.id AND    f.department = d.dId AND  a.employee_name = e.regId AND a.country=cn.id AND a.employee_name = f.userId AND a.id = '$cId'";
    $result = $this->db->select($query);
			return $result;

}

public function getnocfirstCoun($ref_no){
			$query = "SELECT * FROM tbl_certificate_register WHERE completeref = '$ref_no'";
			$result = $this->db->select($query);
			return $result;

}
public function getnoccoun($coId){
	
			$query = "SELECT * FROM tbl_letterof_noc  WHERE  id = '$coId'";
    $result = $this->db->select($query);
			return $result;

}

public function getnocBangLetterdetails($cId){
	
			$query = "SELECT a.*, b.loi_types,  d.deptName, e.userName, e.image, f.*,cn.countryName,  g.divName, h.distName, i.thName, j.postName, j.postCode  FROM tbl_letterof_noc AS a, tbl_typesof_loi AS b,  tbl_department AS d, tbl_user_reg AS e, tbl_employee as f,tbl_country  as cn, tbl_division AS g, tbl_district AS h, tbl_thana AS i, tbl_post AS j WHERE a.type_of_loi = b.id AND    f.department = d.dId AND  a.employee_name = e.regId AND a.country=cn.id AND a.employee_name = f.userId AND a.id = '$cId' AND a.division=g.divId AND a.district=h.distId AND a.thana=i.thId AND a.postoffice=j.postId";
    $result = $this->db->select($query);
			return $result;

}

// public function getauthpaddData($id, $empId){
//     $query = "SELECT a.*, b.loi_types,  e.userName, e.image, g.divName, h.distName, i.thName, j.postName, j.postCode FROM tbl_letterof_noc AS a, tbl_typesof_loi AS b,  tbl_user_reg AS e,tbl_division AS g, tbl_district AS h, tbl_thana AS i, tbl_post AS j WHERE a.type_of_loi = b.id AND     a.employee_name = e.regId AND a.employee_name = '$empId' AND a.id='$id' AND a.pdivision=g.divId AND a.pdistrict=h.distId AND a.pthana=i.thId AND a.ppostoffice=j.postId";
//     $result = $this->db->select($query);
//         return $result;
// }
public function getauthpaddData($empId, $cId){
    $query = "SELECT a.*, b.loi_types,  e.userName, e.image, g.divName, h.distName, i.thName, j.postName, j.postCode FROM tbl_letterof_noc AS a, tbl_typesof_loi AS b,  tbl_user_reg AS e,tbl_division AS g, tbl_district AS h, tbl_thana AS i, tbl_post AS j WHERE a.type_of_loi = b.id AND     a.employee_name = e.regId AND a.employee_name = '$empId' AND a.id='$cId' AND a.pdivision=g.divId AND a.pdistrict=h.distId AND a.pthana=i.thId AND a.ppostoffice=j.postId";
    $result = $this->db->select($query);
        return $result;
}
public function getauthpermanentuseraddressBy($empId){
            $query = "SELECT r.*, s.distName, t.thName, b.postName,b.postCode
             FROM tbl_paddress as r, tbl_district as s, tbl_thana as t, tbl_post as b
              WHERE r.distId = s.distId AND r.thId = t.thId AND r.postId = b.postId AND r.userId = '$empId'";
            //$query = "SELECT * FROM tbl_paddress WHERE userId = '$uId'";
            $result = $this->db->select($query);
            return $result;
        }


 public function insertloiReferenceData($data, $date, $ip){
			$ref_no = $this->fm->validation($data['ref_no']);
			$ref_no = mysqli_real_escape_string($this->db->link, $ref_no);
			if (empty($ref_no)) {
				$msg = "<div class='alert alert-danger' role='alert'>Field Must Not be Empty.</div>";
				return $msg;
			}else{
				$query = "INSERT INTO tbl_authorization(ref, ip, cdate) VALUES('$ref_no', '$ip', '$date')";
				$result = $this->db->insert($query);
				if ($result) {
					echo "<script>window.location='loi_step_one.php?ref_no=$ref_no'</script>";
				}else{
					$msg = "<div class='alert alert-danger' role='alert'>Not Inserted</div>";
					return $msg;
				}
			}
		}

  public function insertloiRefInformationDatas($data, $date, $ip, $ref_no){
	$email = $this->fm->validation($data['email']);
	$email = mysqli_real_escape_string($this->db->link, $email);
	$cert_no = "2";
	$equery ="SELECT * FROM tbl_authorization WHERE email='$email'";
	$eresult = $this->db->select($equery);
	if ($eresult) {
		echo "<script>alert('Successfully Submitted'); window.location='loi_certificate_details.php?ref_no=$ref_no&cert_no=$cert_no&email=$email'</script>";
	}else{
		echo "<script>window.location='loi_information.php?ref_no=$ref_no&email=$email'</script>";
	}
}

public function insertloiRefInformationData($data, $email, $date, $ip, $ref_no){
			$name = $this->fm->validation($data['name']);
			$cName = $this->fm->validation($data['cName']);
			
			$phone = $this->fm->validation($data['phone']);
			$desig = $this->fm->validation($data['desig']);

			$name = mysqli_real_escape_string($this->db->link, $name);
			$cName = mysqli_real_escape_string($this->db->link, $cName);
			$email = mysqli_real_escape_string($this->db->link, $email);
			$phone = mysqli_real_escape_string($this->db->link, $phone);
			$desig = mysqli_real_escape_string($this->db->link, $desig);

			if (empty($name) || empty($email) || empty($phone)) {
				$msg = "<div class='alert alert-danger' role='alert'>Fields Must Not be Empty.</div>";
				return $msg;
			}else{
				$query = "UPDATE tbl_authorization SET name = '$name', cname = '$cName', email = '$email', phone = '$phone', designation = '$desig' WHERE ref = '$ref_no'";
				$result = $this->db->update($query);
				if ($result) {
					echo "<script>alert('Successfully Submitted'); window.location='loi_certificate_details.php?ref_no=$ref_no'</script>";

				$headers = 'From: '.$email."\r\n".
							 
							'Reply-To: '.$email."\r\n" .
							 
							'X-Mailer: PHP/' . phpversion();

							$email_to = "protyasha.s@keal.com.bd";
							$email_subject= "Verifying Letter";
							$email_message= "
Name = $name
Company Name = $cName
Email = $email
Phone = $phone
Designation = $desig
Date = $date
ServerIP = $ip
You're verifying letter with this details";

							


							$headers1 = 'From: '.$email_to."\r\n".
							 
							'Reply-To: '.$email_to."\r\n" .
							 
							'X-Mailer: PHP/' . phpversion();

							$email_subject1= "Verifying Letter";
							$email_message1= "
Name = $name
Company Name = $cName
Email = $email
Phone = $phone
Designation = $desig
Date = $date
ServerIP = $ip
$ref=$ref
This Person want to view the Letter";

							 
							$email_message2= 'Date'.$date."\r\n";
							mail("<$email_to>","$email_subject","$email_message","$headers");

							mail("<$email>","$email_subject1","$email_message1","$headers1");
						
				}else{
					$msg = "<span style='color:red;'>You are not successfully Done</span>";
					return $msg;
				}	

			}
		}

		public function getloicoun($coId){
	
			$query = "SELECT * FROM tbl_letterofintro  WHERE  id = '$coId'";
    $result = $this->db->select($query);
			return $result;

}
public function getloifirstCoun($ref_no){
			$query = "SELECT * FROM tbl_certificate_register WHERE completeref = '$ref_no'";
			$result = $this->db->select($query);
			return $result;

}

		public function getloiLetterId($ref_no){
			$query = "SELECT * FROM tbl_certificate_register WHERE completeref = '$ref_no'";
			$result = $this->db->select($query);
			return $result;

}

public function getloiLetterdetails($cId){
	
			$query = "SELECT a.*, b.loi_types,  d.deptName, e.userName, e.image, f.*,cn.countryName FROM tbl_letterofintro AS a, tbl_typesof_loi AS b,  tbl_department AS d, tbl_user_reg AS e, tbl_employee as f,tbl_country  as cn WHERE a.typeof_loi = b.id AND    f.department = d.dId AND  a.employee_name = e.regId AND a.country=cn.id AND a.employee_name = f.userId AND a.id = '$cId'";
    $result = $this->db->select($query);
			return $result;

}

public function getloiBangLetterdetails($cId){
	
			$query = "SELECT a.*, b.loi_types,  d.deptName, e.userName, e.image, f.*,cn.countryName,  g.divName, h.distName, i.thName, j.postName, j.postCode  FROM tbl_letterofintro AS a, tbl_typesof_loi AS b,  tbl_department AS d, tbl_user_reg AS e, tbl_employee as f,tbl_country  as cn, tbl_division AS g, tbl_district AS h, tbl_thana AS i, tbl_post AS j WHERE a.typeof_loi = b.id AND    f.department = d.dId AND  a.employee_name = e.regId AND a.country=cn.id AND a.employee_name = f.userId AND a.id = '$cId' AND a.division=g.divId AND a.district=h.distId AND a.thana=i.thId AND a.postoffice=j.postId";
    $result = $this->db->select($query);
			return $result;

}
public function getloiauthpaddData($empId, $cId){
    $query = "SELECT a.*, b.loi_types,  e.userName, e.image, g.divName, h.distName, i.thName, j.postName, j.postCode FROM tbl_letterofintro AS a, tbl_typesof_loi AS b,  tbl_user_reg AS e,tbl_division AS g, tbl_district AS h, tbl_thana AS i, tbl_post AS j WHERE a.typeof_loi = b.id AND     a.employee_name = e.regId AND a.employee_name = '$empId' AND a.id='$cId' AND a.pdivision=g.divId AND a.pdistrict=h.distId AND a.pthana=i.thId AND a.ppostoffice=j.postId";
    $result = $this->db->select($query);
        return $result;
}
public function getDeptData($empId){
    $query = "SELECT * FROM tbl_employee WHERE userId = '$empId'";
     $result = $this->db->select($query);
        return $result;
}
public function getGratefromSI($sigrade){
   
    $gquery = "SELECT * FROM tbl_egrade WHERE si='$sigrade'";
    $result = $this->db->select($gquery);
    return $result;
}
public function getgenloiLetterdetails($cId){
	
			$query = "SELECT a.*, b.loi_types,  d.deptName, e.userName, e.image, f.*FROM tbl_letterofintro AS a, tbl_typesof_loi AS b,  tbl_department AS d, tbl_user_reg AS e, tbl_employee as f WHERE a.typeof_loi = b.id AND    f.department = d.dId AND  a.employee_name = e.regId  AND a.employee_name = f.userId AND a.id = '$cId'";
    $result = $this->db->select($query);
			return $result;

}
}?>