<?php include_once "../lib/Database.php"; ?>
<?php include_once "lib/Format.php"; ?>
<?php include_once "lib/Session.php"; ?>

<?php
    /**
    * Career Class
    */
    class Career {
            
    private $db;
    private $fm;
    public function __construct(){
        $this->db = new Database();
        $this->fm = new Format();
    }
    public function insertHrReference($data){
        $ref_number = $this->fm->validation($data['ref_number']);
        $ref_number = mysqli_real_escape_string($this->db->link, $ref_number);
        if (empty($ref_number) || empty($hrdate)) {
            $errmsg = "<span style='color:red;font-size:20px;'>Fields Must not be Empty !!</span>";
            return $errmsg;
        }else{
            $query = "INSERT INTO tbl_hrref(reference) VALUES('$ref_number')";
            $result = $this->db->insert($query);
            if ($result) {
                $msg = "<span style='color:green;font-size:20px;'>Reference Inserted Successfully !!</span>";
                return $msg;
            }else{
                $msg = "<span style='color:red;font-size:20px;'>Reference Not Inserted !!</span>";
                return $msg;
            }
        }
    }

    public function getAllReference(){
        $query = "SELECT * FROM tbl_hrref ORDER BY hrref_id DESC";
        $result = $this->db->select($query);
        return $result;
    }

    public function insertSalarycreate($data){
        $month = $this->fm->validation($data['month']);
        $days = $this->fm->validation($data['days']);
        $date_from = $this->fm->validation($data['date_from']);
        $date_to = $this->fm->validation($data['date_to']);
        $month = mysqli_real_escape_string($this->db->link, $month);
        $days = mysqli_real_escape_string($this->db->link, $days);
        $date_from = mysqli_real_escape_string($this->db->link, $date_from);
        $date_to = mysqli_real_escape_string($this->db->link, $date_to);

        if (empty($month) || empty($days) || empty($date_from) || empty($date_to)) {
            $errmsg = "<span style='color:red;font-size:20px;'>Fields Must not be Empty !!</span>";
            return $errmsg;
        }else{
            $query = "INSERT INTO tbl_month(month, days, date_from, date_to) VALUES('$month', '$days', '$date_from', '$date_to')";
            $result = $this->db->insert($query);
            if ($result) {
                $msg = "<span style='color:green;font-size:20px;'>Data Inserted Successfully !!</span>";
                return $msg;
            }else{
                $msg = "<span style='color:red;font-size:20px;'>Data Not Inserted !!</span>";
                return $msg;
            }
        }
    }

    public function allSalaryCreate(){
        $query = "SELECT * FROM tbl_month ORDER BY id DESC";
        $result = $this->db->select($query);
        return $result;
    }

    public function getReference(){
        $query = "SELECT * FROM tbl_hrref";
        $result = $this->db->select($query);
        return $result;
    }
    public function getMonth(){
        $query = "SELECT * FROM tbl_month";
        $result = $this->db->select($query);
        return $result;
    }

    public function insertYear($data){
        $year = $this->fm->validation($data['year']);
        $year = mysqli_real_escape_string($this->db->link, $year);

        if (empty($year)) {
            $errmsg = "<span style='color:red;font-size:20px;'>Fields Must not be Empty !!</span>";
            return $errmsg;
        }else{
            $query = "INSERT INTO tbl_year(year) VALUES('$year')";
            $result = $this->db->insert($query);
            if ($result) {
                $msg = "<span style='color:green;font-size:20px;'>Data Inserted Successfully !!</span>";
                return $msg;
            }else{
                $msg = "<span style='color:red;font-size:20px;'>Data Not Inserted !!</span>";
                return $msg;
            }
        }
    }
    public function getAllYear(){
        $query = "SELECT * FROM tbl_year ORDER BY year_id DESC";
        $result = $this->db->select($query);
        return $result;
    }
    public function getYear(){
        $query = "SELECT * FROM tbl_year";
        $result = $this->db->select($query);
        return $result;
    }


    public function showSalary(){
        $query = "SELECT a.*, c.month, d.year FROM tbl_salarymonth as a, tbl_month as c, tbl_year as d WHERE  a.monthid = c.id and a.yearid = d.year_id";
        $result = $this->db->select($query);
        return $result;
    }

    public function allActiveEmployee(){
        // $query = "SELECT a.*, b.deptName FROM tbl_employee as a, tbl_department as b WHERE a.department = b.dId and a.active = '1'";
        $query = "SELECT * FROM tbl_allstaffs WHERE estat = '0' AND staff = '0'";
        $result = $this->db->select($query);
        return $result;
    }

    public function insertMonth($data){
        $month = $this->fm->validation($data['month']);
        $month = mysqli_real_escape_string($this->db->link, $month);
        if (empty($month)) {
            $errmsg = "<span style='color:red;font-size:20px;'>Fields Must not be Empty !!</span>";
            return $errmsg;
        }else{
            $query = "INSERT INTO tbl_month_create(month_name) VALUES('$month')";
            $result = $this->db->insert($query);
            if ($result) {
                $msg = "<span style='color:green;font-size:20px;'>Data Inserted Successfully !!</span>";
                return $msg;
            }else{
                $msg = "<span style='color:red;font-size:20px;'>Data Not Inserted !!</span>";
                return $msg;
            }
        }
    }

    public function getAllMonth(){
        $query = "SELECT * FROM tbl_month_create ORDER BY id DESC";
        $result = $this->db->select($query);
        return $result;
    }

    public function getUser(){
        $query = "SELECT * FROM tbl_employee";
        $result = $this->db->select($query);
        return $result;
    }

    public function insertStaff($data, $file){
        $staff_name = $this->fm->validation($data['staff_name']);
        
        $grade = $this->fm->validation($data['grade']);
        $phone = $this->fm->validation($data['phone']);
      

        $staff_name = mysqli_real_escape_string($this->db->link, $staff_name);
        
        $grade = mysqli_real_escape_string($this->db->link, $grade);
        $phone = mysqli_real_escape_string($this->db->link, $phone);
       
        $join_date =  $this->fm->validation($data['join_date']);

        if (empty($staff_name) || empty($join_date) || empty($grade) || empty($phone)) {
            $errmsg = "<span style='color:red;font-size:20px;'>Fields Must not be Empty !!</span>";
            return $errmsg;
        }

          $permited  = array('jpg', 'jpeg', 'png', 'gif');
          $file_name = $file['image']['name'];
          $file_size = $file['image']['size'];
          $file_temp = $file['image']['tmp_name'];

          $div            = explode('.', $file_name);
          $file_ext       = strtolower(end($div));
          $unique_image   = substr(md5(time()), 0, 10).'.'.$file_ext;
          $uploaded_image = "upload/".$unique_image;


            if ($uploaded_image == "") {
             
             $errmsg = "<span style='color:red'>Browse Your Picture First And Submit</span>";
             return $errmsg;

            }elseif ($file_size >1048567) {
             echo "<span style='color:red'>Image Size should be less then 1MB!</span>";

            } elseif (in_array($file_ext, $permited) === false) {

            echo "<span style='color:red'>You can upload only:-".implode(', ', $permited)."</span>";

            }else{
                move_uploaded_file($file_temp, $uploaded_image);
                $query = "INSERT INTO tbl_staff(staff_name, staff_joindate, phone,  staff_grade, staff_image) VALUES('$staff_name', '$join_date', '$phone', '$grade', '$uploaded_image')";
                $result = $this->db->insert($query);
                if ($result) {
                    echo "<script>window.location='staffAddress'</script>";
                }else{
                    $msg = "<span style='color:red;font-size:20px;'>Data Not Inserted !!</span>";
                    return $msg;
            }
        }
            
    }

public function getGradeDesignation(){
    $query = "SELECT * FROM tbl_egrade";
    $result = $this->db->select($query);
    return $result;
}

public function allStaffList(){
    $query = "SELECT * FROM tbl_staff";
    $result = $this->db->select($query);
    return $result;
}

public function insertImage($data, $file){
    $userid = $this->fm->validation($data['userid']);
    $name = $this->fm->validation($data['name']);

    $userid = mysqli_real_escape_string($this->db->link, $userid);
    $name = mysqli_real_escape_string($this->db->link, $name);

    if (empty($userid) || empty($name)) {
        $errmsg = "<span style='color:red;font-size:20px;'>Fields Must not be Empty !!</span>";
        return $errmsg;
    }

      $permited  = array('jpg', 'jpeg', 'png', 'gif');
      $file_name = $file['image']['name'];
      $file_size = $file['image']['size'];
      $file_temp = $file['image']['tmp_name'];

      $div            = explode('.', $file_name);
      $file_ext       = strtolower(end($div));
      $unique_image   = substr(md5(time()), 0, 10).'.'.$file_ext;
      $uploaded_image = "upload/".$unique_image;


        if ($uploaded_image == "") {
         
         $errmsg = "<span style='color:red'>Browse Your Picture First And Submit</span>";
         return $errmsg;

        }elseif ($file_size >1048567) {
         echo "<span style='color:red'>Image Size should be less then 1MB!</span>";

        } elseif (in_array($file_ext, $permited) === false) {

        echo "<span style='color:red'>You can upload only:-".implode(', ', $permited)."</span>";

        }else{
            move_uploaded_file($file_temp, $uploaded_image);
            $query = "INSERT INTO tbl_imgupload(userId, name, image) VALUES('$userid', '$name', '$uploaded_image')";
            $result = $this->db->insert($query);
            if ($result) {
                $msg = "<span style='color:green;font-size:20px;'>Data Inserted Successfully !!</span>";
                return $msg;
            }else{
                $msg = "<span style='color:red;font-size:20px;'>Data Not Inserted !!</span>";
                return $msg;
        }
    }
}

public function allImageList(){
    $query  = "SELECT * FROM tbl_imgupload ORDER BY id DESC";
    $result = $this->db->select($query);
    return $result;
}

public function getAllStaffById($id){
    $query  = "SELECT a.*, b.designation FROM tbl_staff as a, tbl_egrade as b WHERE a.staff_grade = b.si and staff_id = '$id'";
    $result = $this->db->select($query);
    return $result;
}

public function updateStaff($data, $file, $editid){
        $staff_name = $this->fm->validation($data['staff_name']);
        $staff_age = $this->fm->validation($data['staff_age']);
        $grade = $this->fm->validation($data['grade']);
        $phone = $this->fm->validation($data['phone']);

        $staff_name = mysqli_real_escape_string($this->db->link, $staff_name);
        $staff_age = mysqli_real_escape_string($this->db->link, $staff_age);
        $grade = mysqli_real_escape_string($this->db->link, $grade);
        $phone = mysqli_real_escape_string($this->db->link, $phone);

        $join_date =  $this->fm->validation($data['join_date']);

        if (empty($staff_name) || empty($staff_age) || empty($join_date) || empty($grade) || empty($phone)) {
            $errmsg = "<span style='color:red;font-size:20px;'>Fields Must not be Empty !!</span>";
            return $errmsg;
        }

          $permited  = array('jpg', 'jpeg', 'png', 'gif');
          $file_name = $file['image']['name'];
          $file_size = $file['image']['size'];
          $file_temp = $file['image']['tmp_name'];

          $div            = explode('.', $file_name);
          $file_ext       = strtolower(end($div));
          $unique_image   = substr(md5(time()), 0, 10).'.'.$file_ext;
          $uploaded_image = "upload/".$unique_image;


            if ($uploaded_image == "") {
             
             $errmsg = "<span style='color:red'>Browse Your Picture First And Submit</span>";
             return $errmsg;

            }elseif ($file_size >1048567) {
             echo "<span style='color:red'>Image Size should be less then 1MB!</span>";

            } elseif (in_array($file_ext, $permited) === false) {

            echo "<span style='color:red'>You can upload only:-".implode(', ', $permited)."</span>";

            }else{
                move_uploaded_file($file_temp, $uploaded_image);
                $query = "UPDATE tbl_staff SET staff_name = '$staff_name', staff_age = '$staff_age', staff_joindate = '$join_date', phone = '$phone', staff_grade = '$grade', staff_image = '$uploaded_image' WHERE staff_id = '$editid'";
                $result = $this->db->update($query);
                if ($result) {
                    $msg = "<span style='color:green;font-size:20px;'>Data Updated Successfully !!</span>";
                    return $msg;
                }else{
                    $msg = "<span style='color:red;font-size:20px;'>Data Not Updated !!</span>";
                    return $msg;
            }
        }
}

public function getAllStaffs(){
    $query = "SELECT a.*, b.designation FROM tbl_staff AS a, tbl_egrade AS b WHERE a.staff_grade = b.grade";
    $result = $this->db->select($query);
    return $result;
}

public function fetchStaffById($id){
    $query = "SELECT * FROM tbl_staff WHERE staff_id = '$id'";
    $result = $this->db->select($query);
    return $result;
}

public function checkInInsert($data, $time, $date, $id, $day, $serverIP){
    $late_reason = $this->fm->validation($data['late_reason']);
    $original_time = $this->fm->validation($data['original_time']);

    $late_reason = mysqli_real_escape_string($this->db->link, $late_reason);
    $original_time = mysqli_real_escape_string($this->db->link, $original_time);

    $query = "INSERT INTO tbl_staff_attendance(userId, originalTime, indate, inTime, late_reason, inday, inIp) VALUES('$id', '$original_time', '$date', '$time', '$late_reason', '$serverIP', '$day')";
    $result = $this->db->insert($query);
    return $result;
}

public function checkOutInsert($data, $time, $date, $id, $day, $serverIP){
    $early_reason = $this->fm->validation($data['early_reason']);
    $early_reason = mysqli_real_escape_string($this->db->link, $early_reason);

    $checkdate = $this->dateCheck($id, $date);
    if ($checkdate == false) {
        ?>
            <script type="text/javascript">
                alert('You are not Checked In Today');
                window.loaction='check_in?attendanceId=$id';
            </script>
        <?php
    }else{

        $query = "INSERT INTO tbl_staff_attendance(userId, outTime, earlyReason, outDate, outday, outIp) VALUES('$id', '$time', '$early_reason', '$date', '$day', '$serverIP')";
        $result = $this->db->insert($query);
        return $result;
    }
}

public function getCheckInById($id){
    $query = "SELECT * FROM tbl_staff_attendance WHERE userId = '$id'";
    $result = $this->db->select($query);
    return $result;
}

public function getCheckOutById($id){
    $query = "SELECT * FROM tbl_staff_attendance WHERE userId = '$id'";
    $result = $this->db->select($query);
    return $result;

}

private function dateCheck($id, $date){
    $query = "SELECT * FROM tbl_staff_attendance WHERE userId = '$id' AND indate = '$date'";
    $result = $this->db->select($query);
    return $result;
}


  public function insertStaffAdress($data){
      $sId = $this->fm->validation($data['sId']);
        $fname = $this->fm->validation($data['fname']);
        $pre_add = $this->fm->validation($data['pre_add']);
        $p_add = $this->fm->validation($data['p_add']);
        $dob = $this->fm->validation($data['dob']);
        $nlty = $this->fm->validation($data['nlty']);
        $nid = $this->fm->validation($data['nid']);
        $lng = $this->fm->validation($data['lng']);
        $religion = $this->fm->validation($data['religion']);

        $status = $this->fm->validation($data['status']);
        $sname = $this->fm->validation($data['sname']);
        $splace = $this->fm->validation($data['splace']);
 $swork = $this->fm->validation($data['swork']);

        $sId = mysqli_real_escape_string($this->db->link, $sId);
        $fname = mysqli_real_escape_string($this->db->link, $fname);
        $pre_add = mysqli_real_escape_string($this->db->link, $pre_add);
        $p_add = mysqli_real_escape_string($this->db->link, $p_add);
        $dob = mysqli_real_escape_string($this->db->link, $dob);
        $nlty = mysqli_real_escape_string($this->db->link, $nlty);
         $nid = mysqli_real_escape_string($this->db->link, $nid);
          $lng = mysqli_real_escape_string($this->db->link, $lng);
        $religion = mysqli_real_escape_string($this->db->link, $religion);
        $status = mysqli_real_escape_string($this->db->link, $status);
        $sname = mysqli_real_escape_string($this->db->link, $sname);
        $splace = mysqli_real_escape_string($this->db->link,  $splace);   
 $swork = mysqli_real_escape_string($this->db->link,  $swork); 
         if (empty($fname) || empty($pre_add) || empty($nlty) || empty($nid)|| empty($lng) || empty($religion) || empty($status) || empty($sname) || empty($splace)) {
            $errmsg = "<span style='color:red;font-size:20px;'>Fields Must not be Empty !!</span>";
            return $errmsg;
        }else{
                $query = "INSERT INTO tbl_staff_add(sId, father_name,  present_add, permanent_add, b_date, nation, nid_no, language, religion, mar_status, spouse_name, swork, spouse_workplace) VALUES( '$sId', '$fname', '$pre_add', '$p_add', '$dob', '$nlty', '$nid', '$lng', '$religion', '$status', '$sname', '$swork', '$splace')";
                $result = $this->db->insert($query);
                if ($result) {
                 echo "<script>window.location='staffExp'</script>";
                }else{
                    $msg = "<span style='color:red;font-size:20px;'>Data Not Inserted !!</span>";
                    return $msg;
            }
        }
        
}   
public function getAllStaff(){
      $query = "SELECT * FROM tbl_staff";
    $result = $this->db->select($query);
    return $result;  
}
public function insertStaffExp($deb){
      $sId = $this->fm->validation($deb['sId']);
        $wyear = $this->fm->validation($deb['wyear']);
        $wplace = $this->fm->validation($deb['wplace']);
        $wphone = $this->fm->validation($deb['wphone']);
 
        $sId = mysqli_real_escape_string($this->db->link, $sId);
        $wyear = mysqli_real_escape_string($this->db->link, $wyear);
        $wplace = mysqli_real_escape_string($this->db->link, $wplace);
        $wphone = mysqli_real_escape_string($this->db->link, $wphone);

         if (empty($sId)) {
            $errmsg = "<span style='color:red;font-size:20px;'>Fields Must not be Empty !!</span>";
            return $errmsg;
        }else{ $query = "INSERT INTO tbl_staff_exp(sid, year, working_place, phn_no) VALUES( '$sId', '$wyear', '$wplace', '$wphone')";
                $result = $this->db->insert($query);
                if ($result) {
                   echo "<script>window.location='staff_ref'</script>";
                }else{
                    $msg = "<span style='color:red;font-size:20px;'>Data Not Inserted !!</span>";
                    return $msg;
            }
        }        
}
public function insertStaffref($data){
        $sId = $this->fm->validation($data['sId']);
        $ref_name_add = $this->fm->validation($data['ref_name_add']);
        $ref_relation = $this->fm->validation($data['ref_relation']);
        $ref_contact = $this->fm->validation($data['ref_contact']);

        $sId = mysqli_real_escape_string($this->db->link, $sId);
        $ref_name_add = mysqli_real_escape_string($this->db->link, $ref_name_add);
        $ref_relation = mysqli_real_escape_string($this->db->link, $ref_relation);
        $ref_contact = mysqli_real_escape_string($this->db->link, $ref_contact);
       

         if (empty($sId)) {
            $errmsg = "<span style='color:red;font-size:20px;'>Fields Must not be Empty !!</span>";
            return $errmsg;
        }else{ $query = "INSERT INTO tbl_staff_ref(sId, name_add, relation, phn_no) VALUES( '$sId', '$ref_name_add', '$ref_relation', '$ref_contact')";
                $result = $this->db->insert($query);
                if ($result) {
                    echo "<script>window.location='staff_health'</script>";
                }else{
                    $msg = "<span style='color:red;font-size:20px;'>Data Not Inserted !!</span>";
                    return $msg;
            }
        }
}



public function insertStaffdis($data){
        $sId = $this->fm->validation($data['sId']);
        $dis_name = $this->fm->validation($data['dis_name']);
        $med_name = $this->fm->validation($data['med_name']);
       
        $sId = mysqli_real_escape_string($this->db->link, $sId);
        $dis_name = mysqli_real_escape_string($this->db->link, $dis_name);
        $med_name = mysqli_real_escape_string($this->db->link, $med_name);



          if (empty($sId)) {
            $errmsg = "<span style='color:red;font-size:20px;'>Fields Must not be Empty !!</span>";
            return $errmsg;
        }else{ $query = "INSERT INTO tbl_staff_health(sId, discease_name, med_name) VALUES( '$sId', '$dis_name', '$med_name')";
                $result = $this->db->insert($query);
                if ($result) {
                   echo "<script>window.location='staff_bio'</script>";
                }else{
                    $msg = "<span style='color:red;font-size:20px;'>Data Not Inserted !!</span>";
                    return $msg;
            }
        } 
     
}

public function staffviewhealth($id){
        $query = "SELECT * FROM tbl_staff_health WHERE sId= '$id'";
        $result = $this->db->select($query);
        return $result;
    }
    public function staffviewref($id){
        $query = "SELECT * FROM tbl_staff_ref WHERE sId= '$id'";
        $result = $this->db->select($query);
        return $result;
    }
    public function staffviewexp($id){
        $query = "SELECT * FROM tbl_staff_exp WHERE sId= '$id'";
        $result = $this->db->select($query);
        return $result;
    }
     public function staffviewedu($id){
        $query = "SELECT * FROM tbl_staff_edu WHERE sId= '$id'";
        $result = $this->db->select($query);
        return $result;
    }
     public function staffviewadd($id){
        $query = "SELECT * FROM tbl_staff_add WHERE sId= '$id'";
        $result = $this->db->select($query);
        return $result;
    }
    public function staffviewdetails($id){
        $query = "SELECT * FROM tbl_staff WHERE staff_id= '$id'";
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

     if (empty($userName) || empty($email) || empty($phone)) {
            $errmsg = "<span style='color:red;font-size:20px;'>Fields Must not be Empty !!</span>";
            return $errmsg;
        }else{
            $exquery = "INSERT INTO tbl_user_reg(userName, email, phone, dob, ex) VALUES('$userName','$email','$phone','$dob', '1')";
            $result = $this->db->insert($exquery);
            if ($result) {
                echo "<script>window.location = 'exemployee'</script>";
                 //$msg = "<span style='color:green;font-size:20px;'>Data Inserted Successfully !!</span>";
                 //return $msg;
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
        $interview = $this->fm->validation($data['interview']);
    
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
public function insertojoiningInfo($data){
        $userId = $this->fm->validation($data['userId']);
        $interview = $this->fm->validation($data['interview']);
    
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

        $insertdatas = "INSERT INTO tbl_joining_info(userId, interviewdate,ex) VALUES('$userId', '$interview', '1')";
        $values = $this->db->insert($insertdatas);
        if ($values) {
            $msg = "Success";
            return $msg;
        }else{
             $msg = "Not Success";
            return $msg;           
        }
       
}

 public function getallJoinedex(){
    $query = "SELECT p.*, n.userName FROM tbl_joining_info as p, tbl_user_reg as n  WHERE p.userId = n.regId AND p.ex='1' ORDER BY p.id DESC ";
    /*$query = "SELECT p.*, u.userName FROM tbl_joining_info as p, tbl_user_reg as u WHERE p.userId = u.regId ORDER BY p.id DESC";*/
    //$query = "SELECT * FROM tbl_joining_info ORDER BY id DESC";
    $result = $this->db->select($query);
    return $result;
}
public function insertojoin($data){
        $userId = $this->fm->validation($data['userId']);
        $rdate = $this->fm->validation($data['rdate']);
        $jdate = $this->fm->validation($data['jdate']);    
        $userId = mysqli_real_escape_string($this->db->link, $userId);
        $rdate = mysqli_real_escape_string($this->db->link, $rdate);
        $jdate = mysqli_real_escape_string($this->db->link, $jdate);

        // $query = "SELECT * FROM tbl_user_reg WHERE regId = '$userId'";
        // $result = $this->db->select($query);
        // if ($result) {
        //     while ($deta = $result->fetch_assoc()) {
        //         $email = $deta['email'];
        //         $phone = $deta['phone'];
        //     }
        // }

    $insertdatas = "INSERT INTO tbl_joining_info(userId, rdatee, datee) VALUES('$userId', '$rdate', '$jdate')";
        $valuess = $this->db->insert($insertdatas);
        if ($valuess) {
            $msg = "Success";
            return $msg;
        }else{
             $msg = "Not Success";
            return $msg;           
        }
}

public function getDept(){
            $query = "SELECT * FROM tbl_department";
            $result = $this->db->select($query);
            return $result;
        }

        public function insertblemployee($data){
       $userId = $this->fm->validation($data['userId']);
        $user = $this->fm->validation($data['user']);
        $job_title = $this->fm->validation($data['job_title']);
        $department = $this->fm->validation($data['department']);
        $designation = $this->fm->validation($data['designation']);
        $office_contact = $this->fm->validation($data['office_contact']);
        $optional_email = $this->fm->validation($data['optional_email']);
        
        $userId = mysqli_real_escape_string($this->db->link, $userId);
        $user = mysqli_real_escape_string($this->db->link, $user);
        $job_title   = mysqli_real_escape_string($this->db->link, $job_title);
        $department   = mysqli_real_escape_string($this->db->link, $department);
        $designation = mysqli_real_escape_string($this->db->link, $designation);
        $office_contact = mysqli_real_escape_string($this->db->link,$office_contact);
        $optional_email = mysqli_real_escape_string($this->db->link,$optional_email);
        
        
        if($userId == "" || $user == "" || $job_title = "" || $optional_email ==""){
            $msg = "Field Must Not Be Empty";
            return $msg;
        }else{
            $query = "INSERT INTO tbl_employee(userId, user, job_title  , department, designation, office_contact, optional_email, defultInTime, defultOuttime) VALUES('$userId', '$user',  '$job_title', '$department',  '$designation', '$office_contact', '$optional_email', '09:00 AM', '05:00 PM')";
            $insert_row = $this->db->insert($query);
                if ($insert_row) {
                 $msg = "Inserted";
                return $msg;                     
                        
                }else{
                $msg = "Row Not Inserted";
                return $msg;                
            }
        }
    }
    public function getAssignUser(){
        $query = "SELECT * FROM tbl_employee WHERE estat='0'";
        $result = $this->db->select($query);
        return $result;   
}
    public function insertFileLogin($data, $adminId, $date){
        $userId = $this->fm->validation($data["userId"]);
        $dId = $this->fm->validation($data["department"]);

        $userautopass = "Kyoto".rand();

        $Uquery = "SELECT * FROM tbl_user_reg WHERE regId = '$userId'";
        $uresults = $this->db->select($Uquery);
        if ($uresults) {
            while ($deta = $uresults->fetch_assoc()) {
                $userName = $deta['userName'];
            }
        }
        $userId = mysqli_real_escape_string($this->db->link, $userId);
        $dId = mysqli_real_escape_string($this->db->link, $dId);
        $password = mysqli_real_escape_string($this->db->link, md5($userautopass) );
        
        $Equery = "SELECT * FROM employee WHERE userId ='$userId'";
        $results = $this->db->select($Equery);
        if ($results) {
            while ($deta = $results->fetch_assoc()) {
                $email = $deta['officeemail'];
            }
        }

        if ($userId == "" || $dId == "") {
            $msg = "Please Fill All Data";
            return $msg;
        }else{
            $insertrow = "INSERT INTO tbl_filelogin(userId, user, email, password, department, datee, adminId) VALUES('$userId', '$userName', '$email', '$password', '$dId', '$date', '$adminId')";
            $result = $this->db->insert($insertrow);
            if ($result) {

                            ?>
                                <script>
                                alert('Successfully Assigned');
                                window.location.href='Assign?success';
                                </script>
                            <?php


                            $headers = 'From: '.$email."\r\n".
                             
                            'Reply-To: '.$email."\r\n" .
                             
                            'X-Mailer: PHP/' . phpversion();

                            $email_to = "protyasha.s@keal.com.bd";
                            $email_subject= "Default User ID & Password for File Management";
                            $email_message= "
This person has been Assigned for File Management Portal:
Name : $userName,
Email : $email
Password = $userautopass";
                          
                            


                            $headers1 = 'From: '.$email_to."\r\n".
                             
                            'Reply-To: '.$email_to."\r\n" .
                             
                            'X-Mailer: PHP/' . phpversion();

                            $email_subject1= "Default User ID & Password for File Management";
          $email_message1= "
Dear $userName,
You are assigned for File management Portal.
Your userEmail is - $email;
     Password = $userautopass
";

                        mail("<$email_to>","$email_subject","$email_message","$headers");

                            mail("<$email>","$email_subject1","$email_message1","$headers1");            
            }
        }
    }
    
    public function changeUserpass($data, $userId){
            $oldpass       =    $this->fm->validation($data['oldpass']);
            $newpass       =    $this->fm->validation($data['newpass']);
            $confirmpass   =    $this->fm->validation($data['confirmpass']);

            $oldpassword    = mysqli_real_escape_string($this->db->link, md5($oldpass));
            $newpass        = mysqli_real_escape_string($this->db->link, md5($newpass));
            $confirmpass    = mysqli_real_escape_string($this->db->link, md5($confirmpass));

            $queryget = "SELECT password FROM tbl_filelogin WHERE userId='$userId'";
            $row = $this->db->select($queryget)->fetch_assoc();
        
            $oldpassworddb = $row['password'];

            //check pass
            if ($oldpassword==$oldpassworddb){
                
                //check twonew pass
                if ($newpass==$confirmpass){
                //success
                //change pass in db
            
                
                        $querychange = "UPDATE tbl_filelogin SET
                            password ='$newpass'
                             WHERE userId='$userId'";
                        $query_update = $this->db->update($querychange);
                        if ($query_update) {
                            $msg = "<span style='color:blue'>Your Password Has Changed Successfully</span>";
                            return $msg;
                        }else{
                            $msg = "Not Change";
                            return $msg;
                        }
                    
                }
            }
        }
        
    public function getassignedpeopleby(){
        $query = "SELECT * FROM tbl_filelogin ORDER BY id DESC";
        $result = $this->db->select($query);
        return $result;
}

public function updateEnable($userId){
            
            
            

                            $query = "UPDATE tbl_filelogin
                          SET 
                          activity='0'
                          WHERE userId = '$userId'";


                
                $result = $this->db->update($query);
                if ($result) {
                    $msg = "Record Updated Successfully";
                    return $msg;
                }else{
                    $msg = "Record Not Updated Successfully";
                    return $msg;
                }
            
        }
        
        public function updateDisable($userId){
            
            
            

                            $query = "UPDATE tbl_filelogin
                          SET 
                          activity='1'
                          WHERE userId = '$userId'";


                
                $result = $this->db->update($query);
                if ($result) {
                    $msg = "Record Updated Successfully";
                    return $msg;
                }else{
                    $msg = "Record Not Updated Successfully";
                    return $msg;
                }
            
        }
        
        public function getdeptby($userId){
            $query = "SELECT p.*, n.deptName FROM tbl_filelogin as p, tbl_department as n  WHERE p.userId = '$userId' AND p.department=n.dId ";
            $result = $this->db->select($query);
            return $result;
        }

// methods for salary system starts here
   //get of new salary method
    public function getSalaryInsert($data,$date,$time){
        
        $select_month = $this->fm->validation($data['select_month']);
        $select_year = $this->fm->validation($data['select_year']);
        
        $select_month = mysqli_real_escape_string($this->db->link, $select_month);
        $select_year = mysqli_real_escape_string($this->db->link, $select_year);

        if (empty($select_month) || empty($select_year)) {
            $errmsg = "<span style='color:red;font-size:20px;'>Fields Must not be Empty !!</span>";
            return $errmsg;
        }

        // $Cquery  = "SELECT * FROM tbl_salarymonth WHERE hrreference = '$ref_num'";
        //         $check = $this->db->select($Cquery);
        //             if ($check) {
        //             $msg = "<span style='color:red;'>You Have Already Used This Reference Number !!</span>";
        //             return $msg;
        //     }

            else{
            $query = "INSERT INTO tbl_salarymonth(monthid, yearid,cdate,ctime) VALUES('$select_month', '$select_year', '$date', '$time')";
            $result = $this->db->insert($query);
            if ($result) {
                // echo "<script>window.location='active_emp_list?mo=$select_month&year = $select_year'</script>";
                echo "<script>window.location='active_emp_list?mo=$select_month&year=$select_year'</script>";
            }else{
                $msg = "<span style='color:red;font-size:20px;'>Data Not Inserted !!</span>";
                return $msg;
            }
        }
    }

public function getSalarymonthby($year,$mo){
     $query = "SELECT a.*, c.month, d.year FROM tbl_salarymonth as a, tbl_month as c, tbl_year as d WHERE  a.monthid = c.id and a.yearid = d.year_id AND a.yearid = '$year' AND a.monthid = '$mo'";
     $result = $this->db->select($query);
     return $result;  
}

public function getIndividual($emp_id){
    $query  = "SELECT p.*,d.deptName FROM tbl_allstaffs as p, tbl_department as d WHERE p.department=d.dId AND p.userId='$emp_id'";
    $result = $this->db->select($query);
    return $result;
}
public function getIndividualaccount($emp_id){
    $query = "SELECT * FROM tbl_bankaccount WHERE userId = '$emp_id'";
    $result = $this->db->select($query);
    return $result;
}
public function refmonthId($month){
     $query = "SELECT * FROM tbl_month WHERE month = '$month'";
     $result = $this->db->select($query);
     return $result;   
}

public function getgrossdata($grade){
      $query = "SELECT * FROM tbl_egrade WHERE si = '$grade'";
     $result = $this->db->select($query);
     return $result;      
}

public function getleave($emp_id){
     $query = "SELECT * FROM tbl_leaverequest WHERE userId = '$emp_id'";
     $result = $this->db->select($query);
     return $result;      
}
//add one
public function insertaddone($addoneamount, $addreasonone, $hrref, $mos, $year, $emp){
        $hrref = mysqli_real_escape_string($this->db->link, $hrref);
        $mos   = mysqli_real_escape_string($this->db->link, $mos);
        $year     = mysqli_real_escape_string($this->db->link, $year);
        $emp    = mysqli_real_escape_string($this->db->link, $emp);  
        $addoneamount    = mysqli_real_escape_string($this->db->link, $addoneamount);  
        $addreasonone    = mysqli_real_escape_string($this->db->link, $addreasonone);   
        
        //restrict
        $addquery = "SELECT * FROM tbl_addone WHERE userId = '$emp' AND href = '$hrref' AND mos = '$mos' AND years = '$year'";
        $addresult = $this->db->select($addquery);
        if ($addresult) {
            $errmsg = "You Have Already Complete Add One";
            return $errmsg;
        }      
        if (empty($addoneamount) && empty($addreasonone)) {
            $errmsg = "<span style='color:red;font-size:20px;'>Fields Must not be Empty !!</span>";
            return $errmsg;
        }else{
         $query = "INSERT INTO tbl_addone(userId, href, mos, years, addonereason, amount) VALUES('$emp', '$hrref', '$mos', '$year','$addreasonone','$addoneamount')";  
          $result = $this->db->insert($query);
                      if ($result) {
                  // $msg = "<span style='color:green;font-size:20px;'>Data Inserted Successfully !!</span>";
                  // return $msg;
                echo "<script>window.location='salarycreate?emp_id=$emp&mo=$mos&year=$year'</script>";
            }else{
                $msg = "<span style='color:red;font-size:20px;'>Data Not Inserted !!</span>";
                return $msg;
            }
        }        

}


//add two
public function insertaddtwo($addamounttwo, $addreasontwo, $hrref, $mos, $year, $emp){
        $hrref = mysqli_real_escape_string($this->db->link, $hrref);
        $mos   = mysqli_real_escape_string($this->db->link, $mos);
        $year     = mysqli_real_escape_string($this->db->link, $year);
        $emp    = mysqli_real_escape_string($this->db->link, $emp);  
        $addamounttwo    = mysqli_real_escape_string($this->db->link, $addamounttwo);  
        $addreasontwo    = mysqli_real_escape_string($this->db->link, $addreasontwo);   
        
        //restrict
        $addquery = "SELECT * FROM tbl_addtwo WHERE userId = '$emp' AND href = '$hrref' AND mos = '$mos' AND years = '$year'";
        $addresult = $this->db->select($addquery);
        if ($addresult) {
            $errmsg = "You Have Already Complete Add Two";
            return $errmsg;
        }      
        if (empty($addamounttwo) && empty($addreasontwo)) {
            $errmsg = "<span style='color:red;font-size:20px;'>Fields Must not be Empty !!</span>";
            return $errmsg;
        }else{
         $query = "INSERT INTO tbl_addtwo(userId, href, mos, years, addtworeason, valuesof) VALUES('$emp', '$hrref', '$mos', '$year','$addreasontwo','$addamounttwo')";  
          $result = $this->db->insert($query);
                      if ($result) {
                  // $msg = "<span style='color:green;font-size:20px;'>Data Inserted Successfully !!</span>";
                  // return $msg;
                echo "<script>window.location='salarycreate?emp_id=$emp&mo=$mos&year=$year'</script>";
            }else{
                $msg = "<span style='color:red;font-size:20px;'>Data Not Inserted !!</span>";
                return $msg;
            }
        }        

}


//add three
public function insertaddthree($addamountthree, $addreasonthree, $hrref, $mos, $year, $emp){
        $hrref = mysqli_real_escape_string($this->db->link, $hrref);
        $mos   = mysqli_real_escape_string($this->db->link, $mos);
        $year     = mysqli_real_escape_string($this->db->link, $year);
        $emp    = mysqli_real_escape_string($this->db->link, $emp);  
        $addamountthree    = mysqli_real_escape_string($this->db->link, $addamountthree);  
        $addreasonthree    = mysqli_real_escape_string($this->db->link, $addreasonthree);   
        
        //restrict
        $addquery = "SELECT * FROM tbl_addthree WHERE userId = '$emp' AND href = '$hrref' AND mos = '$mos' AND years = '$year'";
        $addresult = $this->db->select($addquery);
        if ($addresult) {
            $errmsg = "You Have Already Complete Add Two";
            return $errmsg;
        }      
        if (empty($addamountthree) && empty($addreasonthree)) {
            $errmsg = "<span style='color:red;font-size:20px;'>Fields Must not be Empty !!</span>";
            return $errmsg;
        }else{
         $query = "INSERT INTO tbl_addthree(userId, href, mos, years, addthreereason, valuesoft) VALUES('$emp', '$hrref', '$mos', '$year','$addreasonthree','$addamountthree')";  
          $result = $this->db->insert($query);
                      if ($result) {
                  // $msg = "<span style='color:green;font-size:20px;'>Data Inserted Successfully !!</span>";
                  // return $msg;
                echo "<script>window.location='salarycreate?emp_id=$emp&mo=$mos&year=$year'</script>";
            }else{
                $msg = "<span style='color:red;font-size:20px;'>Data Not Inserted !!</span>";
                return $msg;
            }
        }        

}


//add four
public function insertaddfour($addamountfour, $addreasonfour, $hrref, $mos, $year, $emp){
        $hrref = mysqli_real_escape_string($this->db->link, $hrref);
        $mos   = mysqli_real_escape_string($this->db->link, $mos);
        $year     = mysqli_real_escape_string($this->db->link, $year);
        $emp    = mysqli_real_escape_string($this->db->link, $emp);  
        $addamountfour    = mysqli_real_escape_string($this->db->link, $addamountfour);  
        $addreasonfour    = mysqli_real_escape_string($this->db->link, $addreasonfour);   
        
        //restrict
        $addquery = "SELECT * FROM tbl_addfour WHERE userId = '$emp' AND href = '$hrref' AND mos = '$mos' AND years = '$year'";
        $addresult = $this->db->select($addquery);
        if ($addresult) {
            $errmsg = "You Have Already Complete Add Two";
            return $errmsg;
        }      
        if (empty($addamountfour) && empty($addreasonfour)) {
            $errmsg = "<span style='color:red;font-size:20px;'>Fields Must not be Empty !!</span>";
            return $errmsg;
        }else{
         $query = "INSERT INTO tbl_addfour(userId, href, mos, years, addreasonfour, valuesoffour) VALUES('$emp', '$hrref', '$mos', '$year','$addreasonfour','$addamountfour')";  
          $result = $this->db->insert($query);
                      if ($result) {
                  // $msg = "<span style='color:green;font-size:20px;'>Data Inserted Successfully !!</span>";
                  // return $msg;
                echo "<script>window.location='salarycreate?emp_id=$emp&mo=$mos&year=$year'</script>";
            }else{
                $msg = "<span style='color:red;font-size:20px;'>Data Not Inserted !!</span>";
                return $msg;
            }
        }        

}
//add five 
public function insertaddfive($addamountfive, $addreasonfive, $hrref, $mos, $year, $emp){
        $hrref = mysqli_real_escape_string($this->db->link, $hrref);
        $mos   = mysqli_real_escape_string($this->db->link, $mos);
        $year     = mysqli_real_escape_string($this->db->link, $year);
        $emp    = mysqli_real_escape_string($this->db->link, $emp);  
        $addamountfive    = mysqli_real_escape_string($this->db->link, $addamountfive);  
        $addreasonfive    = mysqli_real_escape_string($this->db->link, $addreasonfive);   
        
        //restrict
        $addquery = "SELECT * FROM tbl_addfive WHERE userId = '$emp' AND href = '$hrref' AND mos = '$mos' AND years = '$year'";
        $addresult = $this->db->select($addquery);
        if ($addresult) {
            $errmsg = "You Have Already Complete Add Two";
            return $errmsg;
        }      
        if (empty($addamountfive) && empty($addreasonfive)) {
            $errmsg = "<span style='color:red;font-size:20px;'>Fields Must not be Empty !!</span>";
            return $errmsg;
        }else{
         $query = "INSERT INTO tbl_addfive(userId, href, mos, years, addreasonfive, valuesoffive) VALUES('$emp', '$hrref', '$mos', '$year','$addreasonfive','$addamountfive')";  
          $result = $this->db->insert($query);
                      if ($result) {
                  // $msg = "<span style='color:green;font-size:20px;'>Data Inserted Successfully !!</span>";
                  // return $msg;
                echo "<script>window.location='salarycreate?emp_id=$emp&mo=$mos&year=$year'</script>";
            }else{
                $msg = "<span style='color:red;font-size:20px;'>Data Not Inserted !!</span>";
                return $msg;
            }
        }        

}

public function insertadddaysone($adddaysone, $adddays, $hrref, $mos, $year, $emp){
        $hrref = mysqli_real_escape_string($this->db->link, $hrref);
        $mos   = mysqli_real_escape_string($this->db->link, $mos);
        $year     = mysqli_real_escape_string($this->db->link, $year);
        $emp    = mysqli_real_escape_string($this->db->link, $emp);  
        $adddaysone    = mysqli_real_escape_string($this->db->link, $adddaysone);  
        $adddays    = mysqli_real_escape_string($this->db->link, $adddays);   
        
        //restrict
        $addquery = "SELECT * FROM tbl_adddaysone WHERE userId = '$emp' AND href = '$hrref' AND mos = '$mos' AND years = '$year'";
        $addresult = $this->db->select($addquery);
        if ($addresult) {
            $errmsg = "You Have Already Complete Add One";
            return $errmsg;
        }      
        if (empty($adddaysone) && empty($adddays)) {
            $errmsg = "<span style='color:red;font-size:20px;'>Fields Must not be Empty !!</span>";
            return $errmsg;
        }else{
         $query = "INSERT INTO tbl_adddaysone(userId, href, mos, years, adddaysone, adddays) VALUES('$emp', '$hrref', '$mos', '$year','$adddaysone','$adddays')";  
          $result = $this->db->insert($query);
                      if ($result) {
                  // $msg = "<span style='color:green;font-size:20px;'>Data Inserted Successfully !!</span>";
                  // return $msg;
                echo "<script>window.location='salarycreate?emp_id=$emp&mo=$mos&year=$year'</script>";
            }else{
                $msg = "<span style='color:red;font-size:20px;'>Data Not Inserted !!</span>";
                return $msg;
            }
        }        

}

public function insertadddaytwo($adddaystwo, $adddays, $hrref, $mos, $year, $emp){
        $hrref = mysqli_real_escape_string($this->db->link, $hrref);
        $mos   = mysqli_real_escape_string($this->db->link, $mos);
        $year     = mysqli_real_escape_string($this->db->link, $year);
        $emp    = mysqli_real_escape_string($this->db->link, $emp);  
        $adddaystwo    = mysqli_real_escape_string($this->db->link, $adddaystwo);  
        $adddays    = mysqli_real_escape_string($this->db->link, $adddays);   
        
        //restrict
        $addquery = "SELECT * FROM tbl_adddaystwo WHERE userId = '$emp' AND href = '$hrref' AND mos = '$mos' AND years = '$year'";
        $addresult = $this->db->select($addquery);
        if ($addresult) {
            $errmsg = "You Have Already Complete Add One";
            return $errmsg;
        }      
        if (empty($adddaystwo) && empty($adddays)) {
            $errmsg = "<span style='color:red;font-size:20px;'>Fields Must not be Empty !!</span>";
            return $errmsg;
        }else{
         $query = "INSERT INTO tbl_adddaystwo(userId, href, mos, years, adddaystwo, adddays) VALUES('$emp', '$hrref', '$mos', '$year','$adddaystwo','$adddays')";  
          $result = $this->db->insert($query);
                      if ($result) {
                  // $msg = "<span style='color:green;font-size:20px;'>Data Inserted Successfully !!</span>";
                  // return $msg;
                echo "<script>window.location='salarycreate?emp_id=$emp&mo=$mos&year=$year'</script>";
            }else{
                $msg = "<span style='color:red;font-size:20px;'>Data Not Inserted !!</span>";
                return $msg;
            }
        }        
}

// addition by days method
public function adddaysthree($adddaysthree, $adddays, $hrref, $mos, $year, $emp){
        $hrref = mysqli_real_escape_string($this->db->link, $hrref);
        $mos   = mysqli_real_escape_string($this->db->link, $mos);
        $year     = mysqli_real_escape_string($this->db->link, $year);
        $emp    = mysqli_real_escape_string($this->db->link, $emp);  
        $adddaysthree    = mysqli_real_escape_string($this->db->link, $adddaysthree);  
        $adddays    = mysqli_real_escape_string($this->db->link, $adddays);   
        
        //restrict
        $addquery = "SELECT * FROM tbl_adddaysthree WHERE userId = '$emp' AND href = '$hrref' AND mos = '$mos' AND years = '$year'";
        $addresult = $this->db->select($addquery);
        if ($addresult) {
            $errmsg = "You Have Already Complete Add One";
            return $errmsg;
        }      
        if (empty($adddaysthree) && empty($adddays)) {
            $errmsg = "<span style='color:red;font-size:20px;'>Fields Must not be Empty !!</span>";
            return $errmsg;
        }else{
         $query = "INSERT INTO tbl_adddaysthree(userId, href, mos, years, adddaysthree, adddays) VALUES('$emp', '$hrref', '$mos', '$year','$adddaysthree','$adddays')";  
          $result = $this->db->insert($query);
                      if ($result) {
                  // $msg = "<span style='color:green;font-size:20px;'>Data Inserted Successfully !!</span>";
                  // return $msg;
                echo "<script>window.location='salarycreate?emp_id=$emp&mo=$mos&year=$year'</script>";
            }else{
                $msg = "<span style='color:red;font-size:20px;'>Data Not Inserted !!</span>";
                return $msg;
            }
        }        

}
public function adddaysfive($adddaysfive, $adddays, $hrref, $mos, $year, $emp){
        $hrref = mysqli_real_escape_string($this->db->link, $hrref);
        $mos   = mysqli_real_escape_string($this->db->link, $mos);
        $year     = mysqli_real_escape_string($this->db->link, $year);
        $emp    = mysqli_real_escape_string($this->db->link, $emp);  
        $adddaysfive    = mysqli_real_escape_string($this->db->link, $adddaysfive);  
        $adddays    = mysqli_real_escape_string($this->db->link, $adddays);   
        
        //restrict
        $addquery = "SELECT * FROM tbl_adddaysfive WHERE userId = '$emp' AND href = '$hrref' AND mos = '$mos' AND years = '$year'";
        $addresult = $this->db->select($addquery);
        if ($addresult) {
            $errmsg = "You Have Already Complete Add One";
            return $errmsg;
        }      
        if (empty($adddaysfive) && empty($adddays)) {
            $errmsg = "<span style='color:red;font-size:20px;'>Fields Must not be Empty !!</span>";
            return $errmsg;
        }else{
         $query = "INSERT INTO tbl_adddaysfive(userId, href, mos, years, adddaysfive, adddays) VALUES('$emp', '$hrref', '$mos', '$year','$adddaysfive','$adddays')";  
          $result = $this->db->insert($query);
                      if ($result) {
                  // $msg = "<span style='color:green;font-size:20px;'>Data Inserted Successfully !!</span>";
                  // return $msg;
                echo "<script>window.location='salarycreate?emp_id=$emp&mo=$mos&year=$year'</script>";
            }else{
                $msg = "<span style='color:red;font-size:20px;'>Data Not Inserted !!</span>";
                return $msg;
            }
        }        

}
public function adddaysfour($adddaysfour, $adddays, $hrref, $mos, $year, $emp){
        $hrref = mysqli_real_escape_string($this->db->link, $hrref);
        $mos   = mysqli_real_escape_string($this->db->link, $mos);
        $year     = mysqli_real_escape_string($this->db->link, $year);
        $emp    = mysqli_real_escape_string($this->db->link, $emp);  
        $adddaysfour    = mysqli_real_escape_string($this->db->link, $adddaysfour);  
        $adddays    = mysqli_real_escape_string($this->db->link, $adddays);   
        
        //restrict
        $addquery = "SELECT * FROM tbl_adddaysfour WHERE userId = '$emp' AND href = '$hrref' AND mos = '$mos' AND years = '$year'";
        $addresult = $this->db->select($addquery);
        if ($addresult) {
            $errmsg = "You Have Already Complete Add One";
            return $errmsg;
        }      
        if (empty($adddaysfour) && empty($adddays)) {
            $errmsg = "<span style='color:red;font-size:20px;'>Fields Must not be Empty !!</span>";
            return $errmsg;
        }else{
         $query = "INSERT INTO tbl_adddaysfour(userId, href, mos, years, adddaysfour, adddays) VALUES('$emp', '$hrref', '$mos', '$year','$adddaysfour','$adddays')";  
          $result = $this->db->insert($query);
                      if ($result) {
                  // $msg = "<span style='color:green;font-size:20px;'>Data Inserted Successfully !!</span>";
                  // return $msg;
                echo "<script>window.location='salarycreate?emp_id=$emp&mo=$mos&year=$year'</script>";
            }else{
                $msg = "<span style='color:red;font-size:20px;'>Data Not Inserted !!</span>";
                return $msg;
            }
        }        

}



//table print

public function getaddonedata($hr, $emp_id, $mo, $year){
    $query = "SELECT * FROM tbl_addone WHERE userId = '$emp_id' AND href = '$hr' AND mos = '$mo' AND years = '$year'";
    $result = $this->db->select($query);
    return $result;      
}

public function getaddonedatadays($hr, $emp_id, $mo, $year){
    $query = "SELECT * FROM tbl_adddaysone WHERE userId = '$emp_id' AND href = '$hr' AND mos = '$mo' AND years = '$year'";
    $result = $this->db->select($query);
    return $result;     
}

public function getaddtwodata($hr, $emp_id, $mo, $year){
    $query = "SELECT * FROM tbl_addtwo WHERE userId = '$emp_id' AND href = '$hr' AND mos = '$mo' AND years = '$year'";
    $result = $this->db->select($query);
    return $result;    
}

public function getaddtindata($hr, $emp_id, $mo, $year){
    $query = "SELECT * FROM tbl_addthree WHERE userId = '$emp_id' AND href = '$hr' AND mos = '$mo' AND years = '$year'";
    $result = $this->db->select($query);
    return $result;        
}

public function getaddfourdata($hr, $emp_id, $mo, $year){
    $query = "SELECT * FROM tbl_addfour WHERE userId = '$emp_id' AND href = '$hr' AND mos = '$mo' AND years = '$year'";
    $result = $this->db->select($query);
    return $result;    
}

public function getaddfivedata($hr, $emp_id, $mo, $year){
    $query = "SELECT * FROM tbl_addfive WHERE userId = '$emp_id' AND href = '$hr' AND mos = '$mo' AND years = '$year'";
    $result = $this->db->select($query);
    return $result;    
}

public function getaddonedatabydays($hr, $emp_id, $mo, $year){
    $query = "SELECT * FROM tbl_adddaysone WHERE userId = '$emp_id' AND href = '$hr' AND mos = '$mo' AND years = '$year'";
    $result = $this->db->select($query);
    return $result;    
}

public function getaddtwodatabydays($hr, $emp_id, $mo, $year){
    $query = "SELECT * FROM tbl_adddaystwo WHERE userId = '$emp_id' AND href = '$hr' AND mos = '$mo' AND years = '$year'";
    $result = $this->db->select($query);
    return $result;    
}

public function getaddtintwodatabydays($hr, $emp_id, $mo, $year){
    $query = "SELECT * FROM tbl_adddaysthree WHERE userId = '$emp_id' AND href = '$hr' AND mos = '$mo' AND years = '$year'";
    $result = $this->db->select($query);
    return $result;      
}

public function getaddtinfourdatabydays($hr, $emp_id, $mo, $year){
    $query = "SELECT * FROM tbl_adddaysfour WHERE userId = '$emp_id' AND href = '$hr' AND mos = '$mo' AND years = '$year'";
    $result = $this->db->select($query);
    return $result;    
}

public function getaddfivedaysdata($hr, $emp_id, $mo, $year){
    $query = "SELECT * FROM tbl_adddaysfive WHERE userId = '$emp_id' AND href = '$hr' AND mos = '$mo' AND years = '$year'";
    $result = $this->db->select($query);
    return $result;     
}







// duduct insert panel
// public function insertdeductone($deductone, $deductreason, $hrref, $mos, $year, $emp){
//         $hrref = mysqli_real_escape_string($this->db->link, $hrref);
//         $mos   = mysqli_real_escape_string($this->db->link, $mos);
//         $year     = mysqli_real_escape_string($this->db->link, $year);
//         $emp    = mysqli_real_escape_string($this->db->link, $emp);  
//         $deductone    = mysqli_real_escape_string($this->db->link, $deductone);  
//         $deductreason    = mysqli_real_escape_string($this->db->link, $deductreason);   
        
//         //restrict
//         $addquery = "SELECT * FROM tbl_deductone WHERE userId = '$emp' AND href = '$hrref' AND mos = '$mos' AND years = '$year'";
//         $addresult = $this->db->select($addquery);
//         if ($addresult) {
//             $errmsg = "You Have Already Complete Add One";
//             return $errmsg;
//         }      
//         if (empty($deductone) && empty($deductreason)) {
//             $errmsg = "<span style='color:red;font-size:20px;'>Fields Must not be Empty !!</span>";
//             return $errmsg;
//         }else{
//          $query = "INSERT INTO tbl_deductone(userId, href, mos, years, deductone, deductreason) VALUES('$emp', '$hrref', '$mos', '$year','$deductone','$deductreason')";  
//           $result = $this->db->insert($query);
//                       if ($result) {
//                   // $msg = "<span style='color:green;font-size:20px;'>Data Inserted Successfully !!</span>";
//                   // return $msg;
//                 echo "<script>window.location='salarycreate?emp_id=$emp&mo=$mos&year=$year'</script>";
//             }else{
//                 $msg = "<span style='color:red;font-size:20px;'>Data Not Inserted !!</span>";
//                 return $msg;
//             }
//         }        

// }
public function insertdeductone($deductone, $deductreason, $hrref, $mos, $year, $emp){
        $hrref = mysqli_real_escape_string($this->db->link, $hrref);
        $mos   = mysqli_real_escape_string($this->db->link, $mos);
        $year     = mysqli_real_escape_string($this->db->link, $year);
        $emp    = mysqli_real_escape_string($this->db->link, $emp);  
        $deductone    = mysqli_real_escape_string($this->db->link, $deductone);  
        $deductreason    = mysqli_real_escape_string($this->db->link, $deductreason);   
        
        //restrict
        $addquery = "SELECT * FROM tbl_deductone WHERE userId = '$emp' AND href = '$hrref' AND mos = '$mos' AND years = '$year'";
        $addresult = $this->db->select($addquery);
        if ($addresult) {
            $errmsg = "You Have Already Complete Add One";
            return $errmsg;
        }      
        if (empty($deductone) && empty($deductreason)) {
            $errmsg = "<span style='color:red;font-size:20px;'>Fields Must not be Empty !!</span>";
            return $errmsg;
        }else{
         $query = "INSERT INTO tbl_deductone(userId, href, mos, years, deductone, deductreason) VALUES('$emp', '$hrref', '$mos', '$year','$deductone','$deductreason')";  
          $result = $this->db->insert($query);
                      if ($result) {
                  // $msg = "<span style='color:green;font-size:20px;'>Data Inserted Successfully !!</span>";
                  // return $msg;
                echo "<script>window.location='salarycreate?emp_id=$emp&mo=$mos&year=$year'</script>";
            }else{
                $msg = "<span style='color:red;font-size:20px;'>Data Not Inserted !!</span>";
                return $msg;
            }
        }        

}

public function insertdeducttwo($deducttwo, $deductreason, $hrref, $mos, $year, $emp){
        $hrref = mysqli_real_escape_string($this->db->link, $hrref);
        $mos   = mysqli_real_escape_string($this->db->link, $mos);
        $year     = mysqli_real_escape_string($this->db->link, $year);
        $emp    = mysqli_real_escape_string($this->db->link, $emp);  
        $deducttwo    = mysqli_real_escape_string($this->db->link, $deducttwo);  
        $deductreason    = mysqli_real_escape_string($this->db->link, $deductreason);   
        
        //restrict
        $addquery = "SELECT * FROM tbl_deducttwo WHERE userId = '$emp' AND href = '$hrref' AND mos = '$mos' AND years = '$year'";
        $addresult = $this->db->select($addquery);
        if ($addresult) {
            $errmsg = "You Have Already Complete Add One";
            return $errmsg;
        }      
        if (empty($deducttwo) && empty($deductreason)) {
            $errmsg = "<span style='color:red;font-size:20px;'>Fields Must not be Empty !!</span>";
            return $errmsg;
        }else{
         $query = "INSERT INTO tbl_deducttwo(userId, href, mos, years, deducttwo, deductreason) VALUES('$emp', '$hrref', '$mos', '$year','$deducttwo','$deductreason')";  
          $result = $this->db->insert($query);
                      if ($result) {
                  // $msg = "<span style='color:green;font-size:20px;'>Data Inserted Successfully !!</span>";
                  // return $msg;
                echo "<script>window.location='salarycreate?emp_id=$emp&mo=$mos&year=$year'</script>";
            }else{
                $msg = "<span style='color:red;font-size:20px;'>Data Not Inserted !!</span>";
                return $msg;
            }
        }        

}


public function insertdeductthree($deductthree, $deductreason, $hrref, $mos, $year, $emp){
        $hrref = mysqli_real_escape_string($this->db->link, $hrref);
        $mos   = mysqli_real_escape_string($this->db->link, $mos);
        $year     = mysqli_real_escape_string($this->db->link, $year);
        $emp    = mysqli_real_escape_string($this->db->link, $emp);  
        $deductthree    = mysqli_real_escape_string($this->db->link, $deductthree);  
        $deductreason    = mysqli_real_escape_string($this->db->link, $deductreason);   
        
        //restrict
        $addquery = "SELECT * FROM tbl_deductthree WHERE userId = '$emp' AND href = '$hrref' AND mos = '$mos' AND years = '$year'";
        $addresult = $this->db->select($addquery);
        if ($addresult) {
            $errmsg = "You Have Already Complete Add One";
            return $errmsg;
        }      
        if (empty($deductthree) && empty($deductreason)) {
            $errmsg = "<span style='color:red;font-size:20px;'>Fields Must not be Empty !!</span>";
            return $errmsg;
        }else{
         $query = "INSERT INTO tbl_deductthree(userId, href, mos, years, deductthree, deductreason) VALUES('$emp', '$hrref', '$mos', '$year','$deductthree','$deductreason')";  
          $result = $this->db->insert($query);
                      if ($result) {
                  // $msg = "<span style='color:green;font-size:20px;'>Data Inserted Successfully !!</span>";
                  // return $msg;
                echo "<script>window.location='salarycreate?emp_id=$emp&mo=$mos&year=$year'</script>";
            }else{
                $msg = "<span style='color:red;font-size:20px;'>Data Not Inserted !!</span>";
                return $msg;
            }
        }        

}


public function insertdeductfour($deductfour, $deductreason, $hrref, $mos, $year, $emp){
        $hrref = mysqli_real_escape_string($this->db->link, $hrref);
        $mos   = mysqli_real_escape_string($this->db->link, $mos);
        $year     = mysqli_real_escape_string($this->db->link, $year);
        $emp    = mysqli_real_escape_string($this->db->link, $emp);  
        $deductfour    = mysqli_real_escape_string($this->db->link, $deductfour);  
        $deductreason    = mysqli_real_escape_string($this->db->link, $deductreason);   
        
        //restrict
        $addquery = "SELECT * FROM tbl_deductfour WHERE userId = '$emp' AND href = '$hrref' AND mos = '$mos' AND years = '$year'";
        $addresult = $this->db->select($addquery);
        if ($addresult) {
            $errmsg = "You Have Already Complete Add One";
            return $errmsg;
        }      
        if (empty($deductfour) && empty($deductreason)) {
            $errmsg = "<span style='color:red;font-size:20px;'>Fields Must not be Empty !!</span>";
            return $errmsg;
        }else{
         $query = "INSERT INTO tbl_deductfour(userId, href, mos, years, deductfour, deductreason) VALUES('$emp', '$hrref', '$mos', '$year','$deductfour','$deductreason')";  
          $result = $this->db->insert($query);
                      if ($result) {
                  // $msg = "<span style='color:green;font-size:20px;'>Data Inserted Successfully !!</span>";
                  // return $msg;
                echo "<script>window.location='salarycreate?emp_id=$emp&mo=$mos&year=$year'</script>";
            }else{
                $msg = "<span style='color:red;font-size:20px;'>Data Not Inserted !!</span>";
                return $msg;
            }
        }        

}

public function insertdeductfive($deductfive, $deductreason, $hrref, $mos, $year, $emp){
        $hrref = mysqli_real_escape_string($this->db->link, $hrref);
        $mos   = mysqli_real_escape_string($this->db->link, $mos);
        $year     = mysqli_real_escape_string($this->db->link, $year);
        $emp    = mysqli_real_escape_string($this->db->link, $emp);  
        $deductfive    = mysqli_real_escape_string($this->db->link, $deductfive);  
        $deductreason    = mysqli_real_escape_string($this->db->link, $deductreason);   
        
        //restrict
        $addquery = "SELECT * FROM tbl_deductfive WHERE userId = '$emp' AND href = '$hrref' AND mos = '$mos' AND years = '$year'";
        $addresult = $this->db->select($addquery);
        if ($addresult) {
            $errmsg = "You Have Already Complete Add One";
            return $errmsg;
        }      
        if (empty($deductfive) && empty($deductreason)) {
            $errmsg = "<span style='color:red;font-size:20px;'>Fields Must not be Empty !!</span>";
            return $errmsg;
        }else{
         $query = "INSERT INTO tbl_deductfive(userId, href, mos, years, deductfive, deductreason) VALUES('$emp', '$hrref', '$mos', '$year','$deductfive','$deductreason')";  
          $result = $this->db->insert($query);
                      if ($result) {
                  // $msg = "<span style='color:green;font-size:20px;'>Data Inserted Successfully !!</span>";
                  // return $msg;
                echo "<script>window.location='salarycreate?emp_id=$emp&mo=$mos&year=$year'</script>";
            }else{
                $msg = "<span style='color:red;font-size:20px;'>Data Not Inserted !!</span>";
                return $msg;
            }
        }        

}




public function insertdeductdaysone($deductdaysone, $deductdays, $hrref, $mos, $year, $emp){
        $hrref = mysqli_real_escape_string($this->db->link, $hrref);
        $mos   = mysqli_real_escape_string($this->db->link, $mos);
        $year     = mysqli_real_escape_string($this->db->link, $year);
        $emp    = mysqli_real_escape_string($this->db->link, $emp);  
        $deductdaysone    = mysqli_real_escape_string($this->db->link, $deductdaysone);  
        $deductdays    = mysqli_real_escape_string($this->db->link, $deductdays);   
        
        //restrict
        $addquery = "SELECT * FROM tbl_deductdaysone WHERE userId = '$emp' AND href = '$hrref' AND mos = '$mos' AND years = '$year'";
        $addresult = $this->db->select($addquery);
        if ($addresult) {
            $errmsg = "You Have Already Complete Add One";
            return $errmsg;
        }      
        if (empty($deductdaysone) && empty($deductdays)) {
            $errmsg = "<span style='color:red;font-size:20px;'>Fields Must not be Empty !!</span>";
            return $errmsg;
        }else{
         $query = "INSERT INTO tbl_deductdaysone(userId, href, mos, years, deductdaysone, deductdays) VALUES('$emp', '$hrref', '$mos', '$year','$deductdaysone','$deductdays')";  
          $result = $this->db->insert($query);
                      if ($result) {
                  // $msg = "<span style='color:green;font-size:20px;'>Data Inserted Successfully !!</span>";
                  // return $msg;
                echo "<script>window.location='salarycreate?emp_id=$emp&mo=$mos&year=$year'</script>";
            }else{
                $msg = "<span style='color:red;font-size:20px;'>Data Not Inserted !!</span>";
                return $msg;
            }
        }        

}


public function insertdeductdaystwo($deductdaystwo, $deductdays, $hrref, $mos, $year, $emp){
        $hrref = mysqli_real_escape_string($this->db->link, $hrref);
        $mos   = mysqli_real_escape_string($this->db->link, $mos);
        $year     = mysqli_real_escape_string($this->db->link, $year);
        $emp    = mysqli_real_escape_string($this->db->link, $emp);  
        $deductdaystwo    = mysqli_real_escape_string($this->db->link, $deductdaystwo);  
        $deductdays    = mysqli_real_escape_string($this->db->link, $deductdays);   
        
        //restrict
        $addquery = "SELECT * FROM tbl_deductdaystwo WHERE userId = '$emp' AND href = '$hrref' AND mos = '$mos' AND years = '$year'";
        $addresult = $this->db->select($addquery);
        if ($addresult) {
            $errmsg = "You Have Already Complete Add One";
            return $errmsg;
        }      
        if (empty($deductdaystwo) && empty($deductdays)) {
            $errmsg = "<span style='color:red;font-size:20px;'>Fields Must not be Empty !!</span>";
            return $errmsg;
        }else{
         $query = "INSERT INTO tbl_deductdaystwo(userId, href, mos, years, deductdaystwo, deductdays) VALUES('$emp', '$hrref', '$mos', '$year','$deductdaystwo','$deductdays')";  
          $result = $this->db->insert($query);
                      if ($result) {
                  // $msg = "<span style='color:green;font-size:20px;'>Data Inserted Successfully !!</span>";
                  // return $msg;
                echo "<script>window.location='salarycreate?emp_id=$emp&mo=$mos&year=$year'</script>";
            }else{
                $msg = "<span style='color:red;font-size:20px;'>Data Not Inserted !!</span>";
                return $msg;
            }
        }        

}


public function insertdeductdaysthree($deductdaysthree, $deductdays, $hrref, $mos, $year, $emp){
        $hrref = mysqli_real_escape_string($this->db->link, $hrref);
        $mos   = mysqli_real_escape_string($this->db->link, $mos);
        $year     = mysqli_real_escape_string($this->db->link, $year);
        $emp    = mysqli_real_escape_string($this->db->link, $emp);  
        $deductdaysthree    = mysqli_real_escape_string($this->db->link, $deductdaysthree);  
        $deductdays    = mysqli_real_escape_string($this->db->link, $deductdays);   
        
        //restrict
        $addquery = "SELECT * FROM tbl_deductdaysthree WHERE userId = '$emp' AND href = '$hrref' AND mos = '$mos' AND years = '$year'";
        $addresult = $this->db->select($addquery);
        if ($addresult) {
            $errmsg = "You Have Already Complete Add One";
            return $errmsg;
        }      
        if (empty($deductdaysthree) && empty($deductdays)) {
            $errmsg = "<span style='color:red;font-size:20px;'>Fields Must not be Empty !!</span>";
            return $errmsg;
        }else{
         $query = "INSERT INTO tbl_deductdaysthree(userId, href, mos, years, deductdaysthree, deductdays) VALUES('$emp', '$hrref', '$mos', '$year','$deductdaysthree','$deductdays')";  
          $result = $this->db->insert($query);
                      if ($result) {
                  // $msg = "<span style='color:green;font-size:20px;'>Data Inserted Successfully !!</span>";
                  // return $msg;
                echo "<script>window.location='salarycreate?emp_id=$emp&mo=$mos&year=$year'</script>";
            }else{
                $msg = "<span style='color:red;font-size:20px;'>Data Not Inserted !!</span>";
                return $msg;
            }
        }        

}
public function insertdeductdaysfour($deductdaysfour, $deductdays, $hrref, $mos, $year, $emp){
        $hrref = mysqli_real_escape_string($this->db->link, $hrref);
        $mos   = mysqli_real_escape_string($this->db->link, $mos);
        $year     = mysqli_real_escape_string($this->db->link, $year);
        $emp    = mysqli_real_escape_string($this->db->link, $emp);  
        $deductdaysfour    = mysqli_real_escape_string($this->db->link, $deductdaysfour);  
        $deductdays    = mysqli_real_escape_string($this->db->link, $deductdays);   
        
        //restrict
        $addquery = "SELECT * FROM tbl_deductdaysfour WHERE userId = '$emp' AND href = '$hrref' AND mos = '$mos' AND years = '$year'";
        $addresult = $this->db->select($addquery);
        if ($addresult) {
            $errmsg = "You Have Already Complete Add One";
            return $errmsg;
        }      
        if (empty($deductdaysfour) && empty($deductdays)) {
            $errmsg = "<span style='color:red;font-size:20px;'>Fields Must not be Empty !!</span>";
            return $errmsg;
        }else{
         $query = "INSERT INTO tbl_deductdaysfour(userId, href, mos, years, deductdaysfour, deductdays) VALUES('$emp', '$hrref', '$mos', '$year','$deductdaysfour','$deductdays')";  
          $result = $this->db->insert($query);
                      if ($result) {
                  // $msg = "<span style='color:green;font-size:20px;'>Data Inserted Successfully !!</span>";
                  // return $msg;
                echo "<script>window.location='salarycreate?emp_id=$emp&mo=$mos&year=$year'</script>";
            }else{
                $msg = "<span style='color:red;font-size:20px;'>Data Not Inserted !!</span>";
                return $msg;
            }
        }        

}
public function insertdeductdaysfive($deductdaysfive, $deductdays, $hrref, $mos, $year, $emp){
        $hrref = mysqli_real_escape_string($this->db->link, $hrref);
        $mos   = mysqli_real_escape_string($this->db->link, $mos);
        $year     = mysqli_real_escape_string($this->db->link, $year);
        $emp    = mysqli_real_escape_string($this->db->link, $emp);  
        $deductdaysfive    = mysqli_real_escape_string($this->db->link, $deductdaysfive);  
        $deductdays    = mysqli_real_escape_string($this->db->link, $deductdays);   
        
        //restrict
        $addquery = "SELECT * FROM tbl_deductdaysfive WHERE userId = '$emp' AND href = '$hrref' AND mos = '$mos' AND years = '$year'";
        $addresult = $this->db->select($addquery);
        if ($addresult) {
            $errmsg = "You Have Already Complete Add One";
            return $errmsg;
        }      
        if (empty($deductdaysfive) && empty($deductdays)) {
            $errmsg = "<span style='color:red;font-size:20px;'>Fields Must not be Empty !!</span>";
            return $errmsg;
        }else{
         $query = "INSERT INTO tbl_deductdaysfive(userId, href, mos, years, deductdaysfive, deductdays) VALUES('$emp', '$hrref', '$mos', '$year','$deductdaysfive','$deductdays')";  
          $result = $this->db->insert($query);
                      if ($result) {
                  // $msg = "<span style='color:green;font-size:20px;'>Data Inserted Successfully !!</span>";
                  // return $msg;
                echo "<script>window.location='salarycreate?emp_id=$emp&mo=$mos&year=$year'</script>";
            }else{
                $msg = "<span style='color:red;font-size:20px;'>Data Not Inserted !!</span>";
                return $msg;
            }
        }        

}

public function getinterimdata($emp_id, $hr, $mo, $year){
    $query = "SELECT * FROM tbl_interimallowence WHERE userId = '$emp_id' AND ref = '$hr' AND months = '$mo' AND years = '$year'";
    $result = $this->db->select($query);
    return $result;    
}

public function gettaxdata($emp_id, $hr, $mo, $year){
    $query = "SELECT * FROM tbl_taxex WHERE userId = '$emp_id' AND href = '$hr' AND mos = '$mo' AND years = '$year'";
    $result = $this->db->select($query);
    return $result;     
}

public function inserttaxvalue($taxes, $hrref, $mos, $years, $emp,$em){
        $hrref = mysqli_real_escape_string($this->db->link, $hrref);
        $mos   = mysqli_real_escape_string($this->db->link, $mos);
        $years     = mysqli_real_escape_string($this->db->link, $years);
        $emp    = mysqli_real_escape_string($this->db->link, $emp);  
        $taxes    = mysqli_real_escape_string($this->db->link, $taxes);  

        if (empty($taxes)) {
            $errmsg = "<span style='color:red;font-size:20px;'>Fields Must not be Empty !!</span>";
            return $errmsg;
        }else{
         $query = "INSERT INTO tbl_taxex(userId, href, mos, years, taxex ) VALUES('$emp', '$hrref', '$mos', '$years','$taxes')";  
          $result = $this->db->insert($query);
                      if ($result) {
                  // $msg = "<span style='color:green;font-size:20px;'>Data Inserted Successfully !!</span>";
                  // return $msg;
                echo "<script>window.location='salary_details?em=$em&emp_id=$emp&hr=$hrref&mo=$mos'</script>";
            }else{
                $msg = "<span style='color:red;font-size:20px;'>Data Not Inserted !!</span>";
                return $msg;
            }
        }  
}


public function insertdeductdays($deduction, $hrref, $mos, $years, $emp,$em){
       $hrref = mysqli_real_escape_string($this->db->link, $hrref);
        $mos   = mysqli_real_escape_string($this->db->link, $mos);
        $years     = mysqli_real_escape_string($this->db->link, $years);
        $emp    = mysqli_real_escape_string($this->db->link, $emp);  
        $deduction    = mysqli_real_escape_string($this->db->link, $deduction);  

        if (empty($deduction)) {
            $errmsg = "<span style='color:red;font-size:20px;'>Fields Must not be Empty !!</span>";
            return $errmsg;
        }else{
         $query = "INSERT INTO tbl_deduction(userId, href, mos, years, deduction ) VALUES('$emp', '$hrref', '$mos', '$years','$deduction')";  
          $result = $this->db->insert($query);
                      if ($result) {
                  // $msg = "<span style='color:green;font-size:20px;'>Data Inserted Successfully !!</span>";
                  // return $msg;
                echo "<script>window.location='salary_details?em=$em&emp_id=$emp&hr=$hrref&mo=$mos'</script>";
            }else{
                $msg = "<span style='color:red;font-size:20px;'>Data Not Inserted !!</span>";
                return $msg;
            }
        }      
}

public function insertadvancedpaid($advanced, $hrref, $mos, $years, $emp,$em){
       $hrref = mysqli_real_escape_string($this->db->link, $hrref);
        $mos   = mysqli_real_escape_string($this->db->link, $mos);
        $years     = mysqli_real_escape_string($this->db->link, $years);
        $emp    = mysqli_real_escape_string($this->db->link, $emp);  
        $advanced    = mysqli_real_escape_string($this->db->link, $advanced);  

        if (empty($advanced)) {
            $errmsg = "<span style='color:red;font-size:20px;'>Fields Must not be Empty !!</span>";
            return $errmsg;
        }else{
         $query = "INSERT INTO tbl_advancepaid(userId, href, mos, years, advance) VALUES('$emp', '$hrref', '$mos', '$years','$advanced')";  
          $result = $this->db->insert($query);
                      if ($result) {
                  // $msg = "<span style='color:green;font-size:20px;'>Data Inserted Successfully !!</span>";
                  // return $msg;
                echo "<script>window.location='salary_details?em=$em&emp_id=$emp&hr=$hrref&mo=$mos'</script>";
            }else{
                $msg = "<span style='color:red;font-size:20px;'>Data Not Inserted !!</span>";
                return $msg;
            }
        }      
}

public function insertadjustment($adjustment, $hrref, $mos, $years, $emp,$em){
       $hrref = mysqli_real_escape_string($this->db->link, $hrref);
        $mos   = mysqli_real_escape_string($this->db->link, $mos);
        $years     = mysqli_real_escape_string($this->db->link, $years);
        $emp    = mysqli_real_escape_string($this->db->link, $emp);  
        $adjustment    = mysqli_real_escape_string($this->db->link, $adjustment);  

        if (empty($adjustment)) {
            $errmsg = "<span style='color:red;font-size:20px;'>Fields Must not be Empty !!</span>";
            return $errmsg;
        }else{
         $query = "INSERT INTO tbl_adjustment(userId, href, mos, years, adjustment) VALUES('$emp', '$hrref', '$mos', '$years','$adjustment')";  
          $result = $this->db->insert($query);
                      if ($result) {
                  // $msg = "<span style='color:green;font-size:20px;'>Data Inserted Successfully !!</span>";
                  // return $msg;
                echo "<script>window.location='salary_details?em=$em&emp_id=$emp&hr=$hrref&mo=$mos'</script>";
            }else{
                $msg = "<span style='color:red;font-size:20px;'>Data Not Inserted !!</span>";
                return $msg;
            }
        }


}


public function getdeductdata($emp_id, $hr, $mo, $year){
    $query = "SELECT * FROM tbl_deduction WHERE userId = '$emp_id' AND href = '$hr' AND mos = '$mo' AND years = '$year'";
    $result = $this->db->select($query);
    return $result;   
}

public function getdeductonedata($emp_id, $hr, $mo, $year){
     $query = "SELECT * FROM tbl_deduction WHERE userId = '$emp_id' AND href = '$hr' AND mos = '$mo' AND years = '$year'";
    $result = $this->db->select($query);
    return $result;    
}
public function getadditiondata($emp_id, $hr, $mo, $year){
    $query = "SELECT * FROM tbl_additiondays WHERE userId = '$emp_id' AND href = '$hr' AND mos = '$mo' AND years = '$year'";
    $result = $this->db->select($query);
    return $result;   
}
public function getadjustmentdata($emp_id, $hr, $mo, $year){
    $query = "SELECT * FROM tbl_adjustment WHERE userId = '$emp_id' AND href = '$hr' AND mos = '$mo' AND years = '$year'";
    $result = $this->db->select($query);
    return $result;   
}

public function getadvanceddata($emp_id, $hr, $mo, $year){
    $query = "SELECT * FROM tbl_advancepaid WHERE userId = '$emp_id' AND href = '$hr' AND mos = '$mo' AND years = '$year'";
    $result = $this->db->select($query);
    return $result;   
}

public function getalldata(){
    $query = "SELECT * FROM tbl_dropdown";
    $result = $this->db->select($query);
    return $result;    
}

public function getalldeductdata(){
    $query = "SELECT * FROM tbl_deduct";
    $result = $this->db->select($query);
    return $result;    
}

public function getalldatatwo(){
    $query = "SELECT * FROM tbl_dropdowntwo";
    $result = $this->db->select($query);
    return $result;     
}

//deduct print
//deduc one
public function getdaonedata($hr, $emp_id, $mo, $year){
    $query = "SELECT * FROM tbl_deductone WHERE userId = '$emp_id' AND href = '$hr' AND mos = '$mo' AND years = '$year'";
    $result = $this->db->select($query);
    return $result; 
}

public function getddonedata($hr, $emp_id, $mo, $year){
    $query = "SELECT * FROM tbl_deductdaysone WHERE userId = '$emp_id' AND href = '$hr' AND mos = '$mo' AND years = '$year'";
    $result = $this->db->select($query);
    return $result;     
}

//deduct two
public function getdatwodata($hr, $emp_id, $mo, $year){
     $query = "SELECT * FROM tbl_deducttwo WHERE userId = '$emp_id' AND href = '$hr' AND mos = '$mo' AND years = '$year'";
    $result = $this->db->select($query);
    return $result;   
}
public function getddtwodata($hr, $emp_id, $mo, $year){
    $query = "SELECT * FROM  tbl_deductdaystwo WHERE userId = '$emp_id' AND href = '$hr' AND mos = '$mo' AND years = '$year'";
    $result = $this->db->select($query);
    return $result;     
}
//addthree
public function getdatindata($hr, $emp_id, $mo, $year){
    $query = "SELECT * FROM tbl_deductthree WHERE userId = '$emp_id' AND href = '$hr' AND mos = '$mo' AND years = '$year'";
    $result = $this->db->select($query);
    return $result;     
}
public function getddtindata($hr, $emp_id, $mo, $year){
    $query = "SELECT * FROM  tbl_deductdaysthree WHERE userId = '$emp_id' AND href = '$hr' AND mos = '$mo' AND years = '$year'";
    $result = $this->db->select($query);
    return $result;     
}

//addfour
public function getdafourdata($hr, $emp_id, $mo, $year){
    $query = "SELECT * FROM tbl_deductfour WHERE userId = '$emp_id' AND href = '$hr' AND mos = '$mo' AND years = '$year'";
    $result = $this->db->select($query);
    return $result;     
}
public function getddfourdata($hr, $emp_id, $mo, $year){
    $query = "SELECT * FROM  tbl_deductdaysfour WHERE userId = '$emp_id' AND href = '$hr' AND mos = '$mo' AND years = '$year'";
    $result = $this->db->select($query);
    return $result;     
}
//addfive
public function getdafivedata($hr, $emp_id, $mo, $year){
    $query = "SELECT * FROM tbl_deductfive WHERE userId = '$emp_id' AND href = '$hr' AND mos = '$mo' AND years = '$year'";
    $result = $this->db->select($query);
    return $result;     
}
public function getddfivedata($hr, $emp_id, $mo, $year){
    $query = "SELECT * FROM  tbl_deductdaysfive WHERE userId = '$emp_id' AND href = '$hr' AND mos = '$mo' AND years = '$year'";
    $result = $this->db->select($query);
    return $result;     
}


public function insertforsalarysummury($hr, $adminId, $emp_id, $mo, $year, $a, $b, $c, $d, $e, $f, $g, $h, $r, $s, $i, $j, $k, $l, $m, $n, $o, $p, $q, $ltot,$totalgross){

   
       $hrref = mysqli_real_escape_string($this->db->link, $hr);
        $mos   = mysqli_real_escape_string($this->db->link, $mo);
        $years = mysqli_real_escape_string($this->db->link, $year);
        $emp  = mysqli_real_escape_string($this->db->link, $emp_id);  
        $ltot  = mysqli_real_escape_string($this->db->link, $ltot);  
        $totalgross  = mysqli_real_escape_string($this->db->link, $totalgross);  
        $a    = mysqli_real_escape_string($this->db->link, $a);  
        $b    = mysqli_real_escape_string($this->db->link, $b);  
        $c    = mysqli_real_escape_string($this->db->link, $c);  
        $d    = mysqli_real_escape_string($this->db->link, $d);  
        $e    = mysqli_real_escape_string($this->db->link, $e);  
        $f    = mysqli_real_escape_string($this->db->link, $f);  
        $g    = mysqli_real_escape_string($this->db->link, $g);  
        $h    = mysqli_real_escape_string($this->db->link, $h);  
        $i    = mysqli_real_escape_string($this->db->link, $i);  
        $j    = mysqli_real_escape_string($this->db->link, $j);  
        $k    = mysqli_real_escape_string($this->db->link, $k);  
        $l    = mysqli_real_escape_string($this->db->link, $l);  
        $m    = mysqli_real_escape_string($this->db->link, $m);  
        $n    = mysqli_real_escape_string($this->db->link, $n);  
        $o    = mysqli_real_escape_string($this->db->link, $o);  
        $p    = mysqli_real_escape_string($this->db->link, $p);  
        $q    = mysqli_real_escape_string($this->db->link, $q);  
        $r    = mysqli_real_escape_string($this->db->link, $r);  
        $s    = mysqli_real_escape_string($this->db->link, $s);  
        //restrict
        $addquery = "SELECT * FROM tbl_salarysummury WHERE userId = '$emp' AND href = '$hrref' AND mos = '$mos' AND years = '$year'";
        $addresult = $this->db->select($addquery);
        if ($addresult) {
            $errmsg = "You Have Already Complete This Salary";
            return $errmsg;
        } 

        $query = "INSERT INTO tbl_salarysummury(adminid, userId, href, mos, years, a, b, c, d, e, f, g, h, r, s, i, j, k, l, m, n, o, p, q, netpay, totalgross) VALUES('$adminId', '$emp', '$hrref', '$mos', '$years', '$a', '$b', '$c', '$d', '$e', '$f', '$g', '$h', '$r', '$s', '$i', '$j', '$k', '$l', '$m', '$n', '$o', '$p', '$q', '$ltot', '$totalgross')";

        $result = $this->db->insert($query);
        if ($result) {
            $errmsg = "Salary Completed";
            return $errmsg;
        }else{
            $errmsg = "Salary Not Completed";
            return $errmsg;            
        }
}

public function getsalarymonth(){
    $query = "SELECT p.*, m.month, y.year FROM tbl_salarymonth as p, tbl_month as m,  tbl_year as y WHERE p.monthid = m.id AND p.yearid = y.year_id";
    $result = $this->db->select($query);
    return $result;  
}

public function getsalarysummuryby($pk, $mo, $year){
    $query = "SELECT p.*, m.month, y.year FROM  tbl_salarysummury as p, tbl_month as m,  tbl_year as y WHERE p.mos = m.id AND p.years = y.year_id and p.href='$pk' AND p.mos = '$mo' AND p.years = '$year'";
    $result = $this->db->select($query);
    return $result;    
}

public function getuserby($userId){
    $query = "SELECT * FROM tbl_allstaffs WHERE userId = '$userId'";
    $result = $this->db->select($query);
    return $result;     
}

public function getuseraccountby($userId){
    $query = "SELECT * FROM tbl_bankaccount WHERE userId = '$userId'";
    $result = $this->db->select($query);
    return $result;   
}

public function getusergross($grade){
    $query = "SELECT * FROM tbl_egrade WHERE si = '$grade'";
    $result = $this->db->select($query);
    return $result;    
}

public function getaddoneamm($pk, $mo, $year){
    $query = "SELECT * FROM tbl_addone WHERE  href = '$pk' AND mos = '$mo' AND years = '$year' LIMIT 1";
    $result = $this->db->select($query);
    return $result;  
}

public function getaddtwoamm($pk, $mo, $year){
    $query = "SELECT * FROM tbl_addtwo WHERE  href = '$pk' AND mos = '$mo' AND years = '$year' LIMIT 1";
    $result = $this->db->select($query);
    return $result;    
}

public function getaddthreeamm($pk, $mo, $year){
     $query = "SELECT * FROM tbl_addthree WHERE  href = '$pk' AND mos = '$mo' AND years = '$year' LIMIT 1";
    $result = $this->db->select($query);
    return $result;       
}
public function getaddfouramm($pk, $mo, $year){
     $query = "SELECT * FROM tbl_addfour WHERE  href = '$pk' AND mos = '$mo' AND years = '$year' LIMIT 1";
    $result = $this->db->select($query);
    return $result;       
}
public function getaddfiveamm($pk, $mo, $year){
     $query = "SELECT * FROM tbl_addfive WHERE  href = '$pk' AND mos = '$mo' AND years = '$year' LIMIT 1";
    $result = $this->db->select($query);
    return $result;       
}






public function getaddoneday($pk, $mo, $year){
    $query = "SELECT * FROM tbl_adddaysone WHERE  href = '$pk' AND mos = '$mo' AND years = '$year' LIMIT 1";
    $result = $this->db->select($query);
    return $result; 
}

public function getaddtwoday($pk, $mo, $year){
    $query = "SELECT * FROM tbl_adddaystwo WHERE  href = '$pk' AND mos = '$mo' AND years = '$year' LIMIT 1";
    $result = $this->db->select($query);
    return $result;    
}

public function getaddthreeday($pk, $mo, $year){
    $query = "SELECT * FROM tbl_adddaysthree WHERE  href = '$pk' AND mos = '$mo' AND years = '$year' LIMIT 1";
    $result = $this->db->select($query);
    return $result;       
}
public function getaddfourday($pk, $mo, $year){
    $query = "SELECT * FROM tbl_adddaysfour WHERE  href = '$pk' AND mos = '$mo' AND years = '$year' LIMIT 1";
    $result = $this->db->select($query);
    return $result;        
}
public function getaddfiveday($pk, $mo, $year){
    $query = "SELECT * FROM tbl_adddaysfive WHERE  href = '$pk' AND mos = '$mo' AND years = '$year' LIMIT 1";
    $result = $this->db->select($query);
    return $result;
}


// Deduct Panel
public function getdeductoneamm($pk, $mo, $year){
    $query = "SELECT * FROM tbl_deductone WHERE  href = '$pk' AND mos = '$mo' AND years = '$year' LIMIT 1";
    $result = $this->db->select($query);
    return $result; 
}
public function getdeducttwoamm($pk, $mo, $year){
    $query = "SELECT * FROM  tbl_deducttwo WHERE  href = '$pk' AND mos = '$mo' AND years = '$year' LIMIT 1";
    $result = $this->db->select($query);
    return $result; 
}
public function getdeductthreeamm($pk, $mo, $year){
    $query = "SELECT * FROM tbl_deductthree WHERE  href = '$pk' AND mos = '$mo' AND years = '$year' LIMIT 1";
    $result = $this->db->select($query);
    return $result; 
}
public function getdeductfouramm($pk, $mo, $year){
    $query = "SELECT * FROM tbl_deductfour WHERE  href = '$pk' AND mos = '$mo' AND years = '$year' LIMIT 1";
    $result = $this->db->select($query);
    return $result; 
}
public function getdeductfiveamm($pk, $mo, $year){
    $query = "SELECT * FROM tbl_deductfive WHERE  href = '$pk' AND mos = '$mo' AND years = '$year' LIMIT 1";
    $result = $this->db->select($query);
    return $result; 
}
// Deduct Panel
public function getdeductonedays($pk, $mo, $year){
    $query = "SELECT * FROM  tbl_deductdaysone WHERE href = '$pk' AND mos = '$mo' AND years = '$year' LIMIT 1";
    $result = $this->db->select($query);
    return $result;      
}
public function getdeducttwodays($pk, $mo, $year){
    $query = "SELECT * FROM  tbl_deductdaystwo WHERE  href = '$pk' AND mos = '$mo' AND years = '$year' LIMIT 1";
    $result = $this->db->select($query);
    return $result; 
}
public function getdeductthreedays($pk, $mo, $year){
    $query = "SELECT * FROM tbl_deductdaysthree WHERE  href = '$pk' AND mos = '$mo' AND years = '$year' LIMIT 1";
    $result = $this->db->select($query);
    return $result; 
}
public function getdeductfourdays($pk, $mo, $year){
    $query = "SELECT * FROM tbl_deductdaysfour WHERE  href = '$pk' AND mos = '$mo' AND years = '$year' LIMIT 1";
    $result = $this->db->select($query);
    return $result; 
}
public function getdeductfivedays($pk, $mo, $year){
    $query = "SELECT * FROM tbl_deductdaysfive WHERE  href = '$pk' AND mos = '$mo' AND years = '$year' LIMIT 1";
    $result = $this->db->select($query);
    return $result; 
}


public function getmonthby($mo){
    $query = "SELECT * FROM tbl_month WHERE id = '$mo'";
    $result = $this->db->select($query);
    return $result;    
}

public function getsalaryammount($pk, $mo, $year){
    $query = "SELECT * FROM tbl_salarysummury WHERE href = '$pk' AND mos='$mo' AND years = '$year'";
    $result = $this->db->select($query);
    return $result;    
}
public function getsalarydatetimeby($pk, $mo, $year){
    $query = "SELECT * FROM tbl_salarymonth WHERE id = '$pk' AND monthid ='$mo' AND yearid = '$year'";
    $result = $this->db->select($query);
    return $result;     
}

public function getusersfor($hr, $mo, $year){
     $query = "SELECT * FROM tbl_salarysummury WHERE  href = '$hr' AND mos = '$mo' AND years = '$year'";
    $result = $this->db->select($query);
    return $result;    
}

public function getonlyuser($user){
    $squery = "SELECT * FROM tbl_employee WHERE userId = '$user' AND bank_info = '1' AND estat='0'";
    $result = $this->db->select($squery);
    return $result; 
}

public function getnetpaybyuser($emp, $hr, $mo, $year){
    $squery = "SELECT * FROM tbl_salarysummury WHERE userId = '$emp' AND href = '$hr' AND mos = '$mo' AND years = '$year'";
    $result = $this->db->select($squery);
    return $result;    
}

public function getusersddfor($user, $hr, $mo, $year){
    $query = "SELECT p.*, u.userName FROM tbl_salarysummury as p, tbl_user_reg as u WHERE p.userId = u.regId AND p.userId = '$user' AND href = '$hr' AND mos = '$mo' AND years = '$year'";
    $result = $this->db->select($query);
    return $result;   
}


// one time
//  public function getusersddtestfor($user, $hr, $mo, $year){
//      $query = "SELECT p.*, u.userName FROM tbl_salarysummury as p, tbl_user_reg as u WHERE p.userId = u.regId AND p.userId = '$user' AND href = '$hr' AND mos = '$mo' AND years = '$year'";
//      $result = $this->db->select($query);
//      return $result;   
//  }


public function getusersddssfor($user, $hr, $mo, $year){

    $query = "SELECT p.*, u.user, u.designation, u.grade FROM tbl_salarysummury as p, tbl_allstaffs as u WHERE p.userId = u.userId AND p.userId = '$user' AND href = '$hr' AND mos = '$mo' AND years = '$year'";
    $result = $this->db->select($query);
    return $result;
}


public function getusersgrade($ugrade){
    
$squery = "SELECT * FROM tbl_egrade WHERE si = '$ugrade'";
 
$result = $this->db->select($squery);
    return $result;   

}


public function getusersaccount(){
     $squery = "SELECT * FROM tbl_bankaccount";
    $result = $this->db->select($squery);
    return $result;    
}
public function getusersaccountonly(){
     $squery = "SELECT * FROM tbl_salarysummury WHERE stat = '1'";
    $result = $this->db->select($squery);
    return $result;    
}
public function getuserswithoutaccount(){
     $squery = "SELECT * FROM tbl_allstaffs WHERE bank_info = '0'";
    $result = $this->db->select($squery);
    return $result;    
}
public function getusersaccountnumber($user){
    $aquery = "SELECT * FROM tbl_bankaccount WHERE userId = '$user'";
    $result = $this->db->select($aquery);
    return $result;    
}

public function allActiveStaff(){
    $query = "SELECT * FROM tbl_staff";
    $result = $this->db->select($query);
    return $result;
}
public function allinactiveEmployee(){
         // $query = "SELECT a.*, b.deptName FROM tbl_employee as a, tbl_department as b WHERE a.department = b.dId and a.active = '1'";
        $query = "SELECT * FROM tbl_allstaffs WHERE estat = '1' AND staff = '0'";
        $result = $this->db->select($query);
        return $result;   
}

public function getyearby($year){
    $aquery = "SELECT * FROM tbl_year WHERE year_id = '$year'";
    $result = $this->db->select($aquery);
    return $result;      
}

// Bonus Part
public function getBonusInsert($data,$date,$time){
        
        $select_month = $this->fm->validation($data['select_month']);
        $select_year = $this->fm->validation($data['select_year']);
        
        $select_month = mysqli_real_escape_string($this->db->link, $select_month);
        $select_year = mysqli_real_escape_string($this->db->link, $select_year);

        if (empty($select_month) || empty($select_year)) {
            $errmsg = "<span style='color:red;font-size:20px;'>Fields Must not be Empty !!</span>";
            return $errmsg;
        }

        // $Cquery  = "SELECT * FROM tbl_salarymonth WHERE hrreference = '$ref_num'";
        //         $check = $this->db->select($Cquery);
        //             if ($check) {
        //             $msg = "<span style='color:red;'>You Have Already Used This Reference Number !!</span>";
        //             return $msg;
        //     }

            else{
            $query = "INSERT INTO tbl_bonusmonth(monthid, yearid,cdate,ctime) VALUES('$select_month', '$select_year', '$date', '$time')";
            $result = $this->db->insert($query);
            if ($result) {
                // echo "<script>window.location='active_emp_list?mo=$select_month&year = $select_year'</script>";
                echo "<script>window.location='bonus_cat?mo=$select_month&year=$select_year'</script>";
            }else{
                $msg = "<span style='color:red;font-size:20px;'>Data Not Inserted !!</span>";
                return $msg;
            }
        }
    } 
    public function getBonusCat(){
     $squery = "SELECT * FROM tbl_bonus";
    $result = $this->db->select($squery);
    return $result;    
}
public function getBonusType($id){
     $squery = "SELECT * FROM tbl_bonustype WHERE bonusCat='$id'";
    $result = $this->db->select($squery);
    return $result;    
}

public function insertPercentBonus($per, $emp_id, $id, $tid, $year, $mo, $bonusper ){
    $per = mysqli_real_escape_string($this->db->link, $per);
    
    // $Iquery = "SELECT * FROM tbl_bonuspercent WHERE emp_id = '$emp_id' AND tid = '$tid' AND catid = '$id' AND year = '$year' AND mo = '$mo'";
    // if($Iquery){
    //             $msg = "<span style='color:red;font-size:20px;'>Bonus Already Assigned</span>";
    //             return $msg;    
    // }else{
    $query = "INSERT INTO  tbl_bonuspercent(emp_id, tid, catid, year, mo, per, bonusper) VALUES('$emp_id', '$tid', '$id', '$year','$mo', '$per', '$bonusper')";
    $result = $this->db->insert($query);
        
    //}

}
                
public function updatePercentBonus($emp_id, $id, $tid, $year, $mo){
    
 $query = "UPDATE  tbl_bonuspercent
              SET stat = '1'
              WHERE emp_id =  '$emp_id' AND
                    tid    =  '$tid' AND
                    catid = '$id' AND
                    year  = '$year'AND
                    mo = '$mo'";
                    

    
    $result = $this->db->update($query);
    if($result){
                $msg = "<span style='color:green;font-size:20px;'>Bonus Assigned</span>";
                return $msg;        
    }else{
                $msg = "<span style='color:red;font-size:20px;'>Bonus Not Assigned !!</span>";
                return $msg;        
    }
}

public function deletePercentBonus( $emp_id, $id, $tid, $year, $mo){
  
    $query = "DELETE FROM  tbl_bonuspercent
             
              WHERE emp_id =  '$emp_id' AND
                    tid    =  '$tid' AND
                    catid = '$id' AND
                    year  = '$year'AND
                    mo = '$mo'";
                    

    
    $result = $this->db->delete($query);
    if($result){
                $msg = "<span style='color:green;font-size:20px;'>Data Deleted !!</span>";
                return $msg;        
    }else{
                $msg = "<span style='color:red;font-size:20px;'>Data Not Deleted !!</span>";
                return $msg;        
    }
}

 public function showBonus(){
        $query = "SELECT a.*, c.month, d.year FROM tbl_bonusmonth as a, tbl_month as c, tbl_year as d WHERE  a.monthid = c.id and a.yearid = d.year_id";
        $result = $this->db->select($query);
        return $result;
    }

    public function getusersbon($user, $mo, $year){
    $query = "SELECT p.*, u.userName FROM tbl_bonuspercent as p, tbl_user_reg as u WHERE p.emp_id = u.regId AND p.emp_id = '$user'  AND mo = '$mo' AND year = '$year' AND p.stat = '1'";
    $result = $this->db->select($query);
    return $result;   
} 
// end bonus part

public function getbonustypeby($mo, $year){
    $query = "SELECT * FROM tbl_bonuspercent WHERE mo ='$mo' AND year = '$year'";
    $bquery = $this->db->select($query);
    return $bquery;
}

public function getsubcatpeby($tid){
    $query = "SELECT * FROM tbl_bonustype WHERE id ='$tid'";
    $squery = $this->db->select($query);
    return $squery;    
}

public function getbonuscatby($catid){
    $query = "SELECT * FROM tbl_bonus WHERE id ='$catid'";
    $squery = $this->db->select($query);
    return $squery;     
}

public function getaccountsnoby($mo, $year){
    $query = "SELECT * FROM tbl_salaryaccountno WHERE mos ='$mo' AND years = '$year' AND type='1'";
    $squery = $this->db->select($query);
    return $squery;    
}
public function getaccountnoby($mo, $year){
    $query = "SELECT * FROM tbl_salaryaccountno WHERE mos ='$mo' AND years = '$year'";
    $squery = $this->db->select($query);
    return $squery;    
}
public function getaccountnumby($accountId){
    $query = "SELECT * FROM tbl_accountno WHERE id ='$accountId'";
    $squery = $this->db->select($query);
    return $squery;      
}

public function getaccountnumfor($hr, $mo, $year){
     $query = "SELECT * FROM tbl_salaryaccountno WHERE mos ='$mo' AND years = '$year' AND hrref='$hr'";
    $squery = $this->db->select($query);
    return $squery;       
}

/*one time*/
public function getaccountnumforonly($hr, $mo, $year){
     $query = "SELECT * FROM tbl_salaryaccountno WHERE mos ='$mo' AND years = '$year' AND hrref='$hr' AND stat ='1'";
    $squery = $this->db->select($query);
    return $squery;       
}
/*one time*/
public function getaccountchqnoby($hr, $mo, $year){
     $query = "SELECT * FROM tbl_salaryaccountno WHERE mos ='$mo' AND years = '$year' AND hrref='$hr'";
    $squery = $this->db->select($query);
    return $squery;       
}

public function userselect($emp_id){
        $query = "SELECT * FROM tbl_userdeduct WHERE userId='$emp_id' AND status='1' ";
        $result = $this->db->select($query);
        return $result;   
}

}
?>