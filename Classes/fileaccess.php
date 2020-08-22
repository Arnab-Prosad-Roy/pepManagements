<?php include_once "../lib/Database.php"; ?>
<?php include_once "../helpers/Format.php"; ?>
<?php include_once "../lib/Session.php"; ?>


<?php

	/**
	* File Class
	*/
	class Files {
            
    private $db;
    private $fm;
    public function __construct(){
        $this->db = new Database();
        $this->fm = new Format();
    }


public function insertFilesbyuser($data, $userId, $date){
        $file_name = $this->fm->validation($data['file_name']);
        $who_create_it = $this->fm->validation($data['who_create_it']);
        $department = $this->fm->validation($data['department']);

        $file_name = mysqli_real_escape_string($this->db->link, $file_name);
        $who_create_it = mysqli_real_escape_string($this->db->link, $who_create_it);
        $department = mysqli_real_escape_string($this->db->link, $department);

        if (empty($file_name) || empty($who_create_it) || empty($department)) {
            $errmsg = "<span style='color:red;font-size:20px;'>Fields Must not be Empty !!</span>";
            return $errmsg;
        }else{
            $query = "INSERT INTO tbl_file(userId, filename, whoCreateIt, department, createDate) VALUES('$userId', '$file_name', '$who_create_it', '$department', '$date')";
            $result = $this->db->insert($query);
            if ($result) {
                $msg = "<span style='color:green;font-size:20px;'>Files Inserted Successfully !!</span>";
                return $msg;
            }else{
                $msg = "<span style='color:red;font-size:20px;'>Files Not Inserted !!</span>";
                return $msg;
            }
        }
}
public function updateFilesbyuser($data, $id){
        $file_name = $this->fm->validation($data['file_name']);
        $who_create_it = $this->fm->validation($data['who_create_it']);
        $department = $this->fm->validation($data['department']);

        $file_name = mysqli_real_escape_string($this->db->link, $file_name);
        $who_create_it = mysqli_real_escape_string($this->db->link, $who_create_it);
        $department = mysqli_real_escape_string($this->db->link, $department);

        if (empty($file_name) || empty($who_create_it) || empty($department)) {
            $errmsg = "<span style='color:red;font-size:20px;'>Fields Must not be Empty !!</span>";
            return $errmsg;
        }else{
            $query = "UPDATE tbl_file SET 
           
            filename= '$file_name',
            whoCreateIt = '$who_create_it',
            department = '$department'
            WHERE id='$id'" ; 
            
            
            $result = $this->db->update($query);
            if ($result) {
                $msg = "<span style='color:green;font-size:20px;'>Files Updated Successfully !!</span>";
                return $msg;
            }else{
                $msg = "<span style='color:red;font-size:20px;'>Files Not Updated !!</span>";
                return $msg;
            }
        }
}

public function getAllFilesEditby($userId, $id){
        $dquery = "SELECT * FROM tbl_file WHERE userId = '$userId' AND id='$id';";
        $result = $this->db->select($dquery);
        return $result;    
}
public function getAllFilesby($userId){
        $dquery = "SELECT * FROM tbl_file WHERE userId = '$userId'";
        $result = $this->db->select($dquery);
        return $result;    
}
public function getAllFiles(){
        $dquery = "SELECT * FROM tbl_file";
        $result = $this->db->select($dquery);
        return $result;    
}
public function getfilesname(){
    $query = "SELECT * FROM tbl_file ORDER BY id DESC";
    $deta = $this->db->select($query);
    return $deta;
}
    public function getDepartment(){
        $query = "SELECT * FROM tbl_department";
        $result = $this->db->select($query);
        return $result;
    }
 public function getFileNameByuserId($userId){
    $query = "SELECT p.*, r.deptName FROM tbl_file as p, tbl_department as r WHERE  p.department = r.dId AND p.userId = '$userId'";
    $deta = $this->db->select($query);
    return $deta;  
 }
    // file user access
        public function getpeopleby($userId){
        $query = "SELECT * FROM employee WHERE stat = '1' AND userId='$userId'";
        $result = $this->db->select($query);
        return $result;         
    }
    public function getpermanentuseraddressBy($userId){
     $query = "SELECT r.*, s.distName, t.thName, b.postName, b.postCode
    FROM tbl_paddress as r, tbl_district as s, tbl_thana as t, tbl_post as b
 WHERE r.distId = s.distId AND r.thId = t.thId AND r.postId = b.postId AND r.userId = '$userId'";
    //$query = "SELECT * FROM tbl_paddress WHERE userId = '$uId'";
    $result = $this->db->select($query);
return $result;
    }
    public function getpermanentuserdivBy($div){
            $query  = "SELECT * FROM  tbl_division WHERE divId='$div'";
            $result = $this->db->select($query);
            return $result;    
    }
public function getAllemployee(){
          $query = "SELECT p.*, r.userName FROM tbl_employee as p, tbl_user_reg as r WHERE  p.userId = r.regId ORDER BY p.id DESC";
          $result = $this->db->select($query);
           return $result;
    }   
        public function getemployeenames(){
        $query = "SELECT * FROM employee WHERE stat = '1'";
        $result = $this->db->select($query);
        return $result;        
    } 
public function getuserqr($userId){
        $query = "SELECT * FROM tbl_qrcode WHERE userId='$userId'";
        $result = $this->db->select($query);
        return $result;    
}
    public function getFileNameById($id){
    $query = "SELECT p.*, r.deptName FROM tbl_file as p, tbl_department as r WHERE  p.department = r.dId AND p.id = '$id'";
        $result = $this->db->select($query);
        return $result;
    }


public function insertoldreg($data){
    $userName = $this->fm->validation($data['userName']);
    $email    = $this->fm->validation($data['email']);
    $phone    = $this->fm->validation($data['phone']);
    $dob      = $this->fm->validation($data['dob']);
    $special  = $this->fm->validation($data['special']);


  $userName = mysqli_real_escape_string($this->db->link, $userName);
  $email = mysqli_real_escape_string($this->db->link, $email);
  $phone = mysqli_real_escape_string($this->db->link, $phone);
  $dob = mysqli_real_escape_string($this->db->link, $dob);
  $special = mysqli_real_escape_string($this->db->link, $special);

     if (empty($userName) || empty($email) || empty($phone) || empty($dob)) {
            $errmsg = "<span style='color:red;font-size:20px;'>Fields Must not be Empty !!</span>";
            return $errmsg;
        }else{
            $exquery = "INSERT INTO tbl_user_reg(userName, email, phone, dob, ex) VALUES('$userName','$email','$phone','$dob', '1')";
            $result = $this->db->insert($exquery);
            if ($result) {
                $msg = "<span style='color:green;font-size:20px;'>Data Inserted Successfully !!</span>";
                return $msg;
            }else{
                $msg = "<span style='color:red;font-size:20px;'>Data Not Inserted !!</span>";
                return $msg;
            }
        }
            
}
public function getExemployee(){
        $query = "SELECT * FROM tbl_user_reg WHERE ex= '1'";
        $result = $this->db->select($query);
        return $result;   
}
public function insertostepseven($data){
        $userId = $this->fm->validation($data['userId']);
        $interview = $this->fm->validation($data['interviewdate']);
    
        $userId = mysqli_real_escape_string($this->db->link, $userId);
        $interview = mysqli_real_escape_string($this->db->link, $interview);


        $query = "SELECT * FROM tbl_user_reg WHERE regId = '$userId'";
        $result = $this->db->select($query);
        if ($result) {
            while ($deta = $result->fetch_assoc()) {
                $email = $deta['email'];
                $phone = $deta['phone'];
            }
        }

        $insertdata = "INSERT INTO step_07(userId, email, phone, interviewDate, selected) VALUES('$userId', '$email', '$phone', '$interview', '1')";
        $values = $this->db->insert($insertdata);
        if ($values) {
            $msg = "Success";
            return $msg;
        }else{
             $msg = "Not Success";
            return $msg;           
        }
       
}
}
?>