<?php include_once "lib/Database.php"; ?>
<?php include_once "lib/Format.php"; ?>
<?php include_once "lib/Session.php"; ?>

<?php
	/**
	* Career Class
	*/
	class Staffattendance {
            
    private $db;
    private $fm;
    public function __construct(){
        $this->db = new Database();
        $this->fm = new Format();
    }
public function getAllStaffs(){
$query = "SELECT * FROM tbl_staff";
    $result = $this->db->select($query);
    return $result;
}

public function checkInInsert($data, $time, $date, $id, $day, $serverIP,$adminName){
    $cItime = $this->fm->validation($data['cItime']);
    $cIdate = $this->fm->validation($data['cIdate']);
    $late_reason = $this->fm->validation($data['late_reason']);
    $original_time = $this->fm->validation($data['original_time']);

    $cItime = mysqli_real_escape_string($this->db->link, $cItime);
    $cIdate = mysqli_real_escape_string($this->db->link, $cIdate);
    $late_reason = mysqli_real_escape_string($this->db->link, $late_reason);
    $original_time = mysqli_real_escape_string($this->db->link, $original_time);

        $squery = "SELECT * FROM tbl_staff WHERE staff_id = '$id'";
        $getData = $this->db->select($squery);
        if ($getData) {
            while ($res = $getData->fetch_assoc()) {
                $name = $res['staff_name'];
                
            }
        }
$email="it@keal.com.bd";

        $squery = "SELECT * FROM tbl_staff_attendance WHERE userId = '$id' AND indate = '$date'";
        $getData = $this->db->select($squery);
        if ($getData) {
                    ?>
                    <script>alert('Already Marked Check In Today');
                                
                                </script>
                    <?php
        }else{


    $query = "INSERT INTO tbl_staff_attendance(userId, originalTime, indate, inTime, late_reason, inday, inIp, checkinBy, status) VALUES('$id', '$original_time', '$cIdate', '$cItime', '$late_reason', '$serverIP', '$day', '$adminName', '1')";
    $result = $this->db->insert($query);
if ($result) {
$msg = "Check In Marked Successfully";
return $msg;
}else{
$msg = "Check In Not Marked Successfully";
return $msg;    
}

        }
}

public function getCheckInById($id){
    $query = "SELECT * FROM tbl_staff_attendance WHERE userId = '$id'";
    $result = $this->db->select($query);
    return $result;
}

public function checkOutInsert($data, $time, $date, $id, $day, $serverIP, $adminName){


    $early_reason = $this->fm->validation($data['early_reason']);
    $incaseerrand = $this->fm->validation($data['incase_errand_place']);
    $errandfrom = $this->fm->validation($data['errand_from_out']);
    $errandto = $this->fm->validation($data['errand_to_out']);
    $cdate = $this->fm->validation($data['cdate']);
    $ctime = $this->fm->validation($data['ctime']);

    $early_reason = mysqli_real_escape_string($this->db->link, $early_reason);
    $incaseerrand = mysqli_real_escape_string($this->db->link, $incaseerrand);
    $errandfrom = mysqli_real_escape_string($this->db->link, $errandfrom);
    $errandto = mysqli_real_escape_string($this->db->link, $errandto);
    $cdate = mysqli_real_escape_string($this->db->link, $cdate);
    $ctime = mysqli_real_escape_string($this->db->link, $ctime);

$email="protyasha.s@keal.com.bd";

        $squery = "SELECT * FROM tbl_staff WHERE staff_id = '$id'";
        $getData = $this->db->select($squery);
        if ($getData) {
            while ($res = $getData->fetch_assoc()) {
                $name = $res['staff_name'];
                
            }
        }
            $restrict = "SELECT * FROM tbl_staff_attendance WHERE outdate = '$date' AND userId = '$id'";
            $result = $this->db->select($restrict);
            if ($result) {
                ?>
            <script>alert('Already Checked Out');
                        window.location = '';
                        </script>
            <?php
            }else{
            $query = "UPDATE tbl_staff_attendance 
            SET
            earlyReason = '$early_reason',

            incaseerrand = '$incaseerrand',
            
            errandfrom = '$errandfrom',
            errandto = '$errandto',
            outtime = '$ctime',
            outday = '$day',
            outDate = '$cdate',
            outIp = '$serverIP',
            checkoutBy = '$adminName'
            WHERE userId = '$id' AND indate = '$cdate'";
            $res = $this->db->update($query);
        if ($res) {
        $msg = "Check Out Marked Successfully!!";
        return $msg;
        }else{
        $msg = "Check Out Marked Successfully!!";
        return $msg;            
        }

}    

}
public function getCheckOutById($id){
    $query = "SELECT * FROM tbl_staff_attendance WHERE userId = '$id' ORDER BY id DESC";
    $result = $this->db->select($query);
    return $result;

}
    public function getdateby($date){
        $query = "SELECT indate, inday FROM tbl_staff_attendance WHERE indate = '$date' LIMIT 1";
        $result = $this->db->select($query);
        return $result;
    }
    public function getstaffId($date, $uId){
         //$date = date('Y-m-d');
         $query = "SELECT p.*, r.staff_name FROM tbl_staff_attendance as p, tbl_staff as r WHERE  p.userId = r.staff_id AND indate = '$date' AND userID = '$uId' ORDER BY p.id DESC";
          $result = $this->db->select($query);
           return $result;

           /*$query = "SELECT p.*, r.userName, j.jobtitle  FROM tbl_interview as p, tbl_user_reg as r, tbl_jobtitle as j, tbl_department as s WHERE p.userId = r.regId AND p.jId = j.jId  ORDER BY p.id DESC";
           $query = "SELECT * FROM tbl_interview  ORDER BY id DESC";
           $result = $this->db->select($query);
           return $result;*/
    }
        public function getAllstaff(){
        $query = "SELECT * FROM tbl_staff WHERE active = '1'";
        $result = $this->db->select($query);
        return $result;
    }
    public function getemployeemark($date, $uId){
                $query = "SELECT * FROM tbl_staff_attendance WHERE indate = '$date' AND userId = '$uId'";
        $res = $this->db->select($query);
        return $res;
    }
    public function getemployeeattendance($date, $uId){
        $query = "SELECT * FROM tbl_staff_attendance WHERE indate = '$date' AND userId = '$uId'";
        $res = $this->db->select($query);
        return $res;    
    }
    }?>