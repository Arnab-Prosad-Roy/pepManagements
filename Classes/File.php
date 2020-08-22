<?php include_once "../lib/Database.php"; ?>
<?php include_once "lib/Format.php"; ?>
<?php include_once "lib/Session.php"; ?>


<?php

	/**
	* File Class
	*/
	class File {
            
    private $db;
    private $fm;
    public function __construct(){
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function insertFiles($data, $adminId, $date){
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
            $query = "INSERT INTO tbl_file(userId, filename, whoCreateIt, department, createDate) VALUES('$adminId', '$file_name', '$who_create_it', '$department', '$date')";
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

    public function getAllFiles(){
        $dquery = "SELECT * FROM tbl_file";
        $result = $this->db->select($query);
        return $result;
    }
public function getfilesname(){
    $query = "SELECT p.*, n.username, d.deptName FROM tbl_file as p, tbl_user_reg as n, tbl_department as d WHERE p.userId = n.regId AND p.department = d.dId";
    $deta = $this->db->select($query);
    return $deta;
}

    public function getFileAll(){
        $dquery = "SELECT p.*, r.deptName FROM tbl_file as p, tbl_department as r WHERE  p.department = r.dId ORDER BY id DESC";
        $result = $this->db->select($dquery);
        return $result;
    }
    
         public function getfileById($editid){
    $query = "SELECT p.*, r.deptName FROM tbl_file as p, tbl_department as r WHERE  p.department = r.dId AND p.id = '$editid'";
        $result = $this->db->select($query);
        return $result;
    }
    public function getDepartment(){
        $query = "SELECT * FROM tbl_department";
        $result = $this->db->select($query);
        return $result;
    }
     public function updateFiles($data, $adminId, $date, $editid){
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
            $query = "UPDATE  tbl_file
               SET 
                userId =  '$adminId',
                filename = '$file_name',
                whoCreateIt =  '$who_create_it',
                department =  '$department',
                createDate = '$date' WHERE id = '$editid'";
            $result = $this->db->insert($query);
            if ($result) {
                $msg = "<span style='color:green;font-size:20px;'>Files Updated Successfully !!</span>";
                return $msg;
            }else{
                $msg = "<span style='color:red;font-size:20px;'>Files Not Updated !!</span>";
                return $msg;
            }
        }
    }    
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
          $query = "SELECT p.*, r.userName FROM tbl_employee as p, tbl_user_reg as r WHERE  p.userId = r.regId AND p.disable='0' ORDER BY p.id DESC";
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
        $query = "SELECT * FROM tbl_file WHERE id = '$id'";
        $result = $this->db->select($query);
        return $result;
    }
    
     public function getFileNById($id){
    $query = "SELECT p.*, r.deptName FROM tbl_file as p, tbl_department as r WHERE  p.department = r.dId AND p.id = '$id'";
        $result = $this->db->select($query);
        return $result;
    }
    
        	public function delfileByid($Did){
			$query = "DELETE FROM tbl_file WHERE id = '$Did'";
			$delData = $this->db->delete($query);
			if ($delData) {
				echo "<script>window.location = 'viewFiles'</script>";
			}else{
				$msg = "Data Not Deleted";
				return $msg;
			}
		}
}

?>