<?php include_once "../lib/Database.php"; ?>
<?php include_once "../helpers/Format.php"; ?>
<?php include_once "../lib/Session.php"; ?>



<?php

	/**
	* Letter Class
	*/
	class Letter {
            
    private $db;
    private $fm;
    public function __construct(){
        $this->db = new Database();
        $this->fm = new Format();
    }
    public function insertBodyPart($data){
        $part_one = $this->fm->validation($data['part_one']);
        $part_two = $this->fm->validation($data['part_two']);
        $part_three = $this->fm->validation($data['part_three']);
        $part_four = $this->fm->validation($data['part_four']);
        $part_five = $this->fm->validation($data['part_five']);
        $part_six = $this->fm->validation($data['part_six']);

        $part_one = mysqli_real_escape_string($this->db->link, $part_one);
        $part_two = mysqli_real_escape_string($this->db->link, $part_two);
        $part_three = mysqli_real_escape_string($this->db->link, $part_three);
        $part_four = mysqli_real_escape_string($this->db->link, $part_four);
        $part_five = mysqli_real_escape_string($this->db->link, $part_five);
        $part_six = mysqli_real_escape_string($this->db->link, $part_six);

        if (empty($part_one) || empty($part_two) || empty($part_three) || empty($part_four) || empty($part_five) || empty($part_six)) {
            $errmsg = "<div class='alert alert-danger' role='alert'>Fields Must Not be Empty !!</div>";
            return $errmsg;
        }else{
            $query = "INSERT INTO tbl_bodytext(part_one, part_two, part_three, part_four, part_five, part_six) VALUES('$part_one', '$part_two', '$part_three', '$part_four', '$part_five', '$part_six')";
            $result = $this->db->insert($query);
            if ($result) {
                $msg = "<div class='alert alert-success' role='alert'>Data Created Successfully !!</div>";
                return $msg;
            }else{
                $errmsg = "<div class='alert alert-danger' role='alert'>Data Not Created Successfully !!</div>";
                return $errmsg;
            }
        }
    }
    public function getEmpolyeeName(){
        $query = "SELECT * FROM tbl_employee WHERE employeestat='8'";
        $result = $this->db->select($query);
        return $result;
    }
    public function getJobTitle(){
        $query = "SELECT * FROM tbl_jobtitle";
        $result = $this->db->select($query);
        return $result;
    }
    public function promotionInsert($data){
        $empolyee_name = $this->fm->validation($data['empolyee_name']);
        $job_title = $this->fm->validation($data['job_title']);
        $start_date = $this->fm->validation($data['start_date']);
        $compensation = $this->fm->validation($data['compensation']);
        $grade = $this->fm->validation($data['grade']);

        $empolyee_name = mysqli_real_escape_string($this->db->link, $empolyee_name);
        $job_title = mysqli_real_escape_string($this->db->link, $job_title);
        $start_date = mysqli_real_escape_string($this->db->link, $start_date);
        $compensation = mysqli_real_escape_string($this->db->link, $compensation);
        $grade = mysqli_real_escape_string($this->db->link, $grade);

        if (empty($empolyee_name) || empty($job_title) || empty($start_date) || empty($compensation) || empty($grade)) {
            $errmsg = "<div class='alert alert-danger' role='alert'>Fields Must Not be Empty !!</div>";
            return $errmsg;
        }else{
            $query = "INSERT INTO tbl_pletter(userId, job_title, start_date, compensation, grade) VALUES('$empolyee_name', '$job_title', '$start_date', '$compensation', '$grade')";
            $result = $this->db->insert($query);
            if ($result) {
                ?>
                            <script>
                                var my_date = new Date();
                                alert('Information Inserted Successfully '+my_date);
                                window.location='promotion_letter';
                            </script>
                <?php
            }else{
                $errmsg = "<div class='alert alert-danger' role='alert'>Data Not Created Successfully !!</div>";
                return $errmsg;
            }
        }
    }
    public function employementStageInsert($data){
        $employement_stage = $this->fm->validation($data['employement_stage']);
        $employement_stage = mysqli_real_escape_string($this->db->link, $employement_stage);
        if (empty($employement_stage)) {
            $errmsg = "<div class='alert alert-danger' role='alert'>Field Must Not be Empty !!</div>";
            return $errmsg;
        }else{
            $query = "INSERT INTO tbl_employement_stage(employement_stage) VALUES('$employement_stage')";
            $result = $this->db->insert($query);
            if ($result) {
                $msg = "<div class='alert alert-success' role='alert'>Data Created Successfully !!</div>";
                return $msg;
            }else{
                $errmsg = "<div class='alert alert-danger' role='alert'>Data Not Created Successfully !!</div>";
                return $errmsg;
            }
        }
    }
    public function employeeTypeInsert($data){
        $employee_type = $this->fm->validation($data['employee_type']);
        $employee_type = mysqli_real_escape_string($this->db->link, $employee_type);
        if (empty($employee_type)) {
            $errmsg = "<div class='alert alert-danger' role='alert'>Field Must Not be Empty !!</div>";
            return $errmsg;
        }else{
            $query = "INSERT INTO tbl_employee_type(employee_type) VALUES('$employee_type')";
            $result = $this->db->insert($query);
            if ($result) {
                $msg = "<div class='alert alert-success' role='alert'>Data Created Successfully !!</div>";
                return $msg;
            }else{
                $errmsg = "<div class='alert alert-danger' role='alert'>Data Not Created Successfully !!</div>";
                return $errmsg;
            }
        }
    }
    public function getTypeOfLoi(){
        $query = "SELECT * FROM tbl_typesof_loi";
        $result = $this->db->select($query);
        return $result;
    }
     public function getRel(){
        $query = "SELECT * FROM tbl_religion";
        $result = $this->db->select($query);
        return $result;
    }
    public function getPurposeOfLoi(){
        $query = "SELECT * FROM tbl_purposeof_loi";
        $result = $this->db->select($query);
        return $result;
    }
    public function getDepartment(){
        $query = "SELECT * FROM tbl_department";
        $result = $this->db->select($query);
        return $result;
    }
    public function getSupervisorName(){
        $query = "SELECT * FROM tbl_employee";
        $result = $this->db->select($query);
        return $result;
    }
    public function getSpecialAttribute(){
        $query = "SELECT * FROM tbl_special_attribute";
        $result = $this->db->select($query);
        return $result;
    }
    public function getEmployeeStage(){
        $query = "SELECT * FROM tbl_employement_stage";
        $result = $this->db->select($query);
        return $result;
    }
    public function getDesignation(){
        $query = "SELECT * FROM tbl_jobtitle";
        $result = $this->db->select($query);
        return $result;
    }
    public function getEmployeeType(){
        $query = "SELECT * FROM tbl_employee_type";
        $result = $this->db->select($query);
        return $result;
    }
    public function getGrade(){
        $query = "SELECT * FROM tbl_egrade";
        $result = $this->db->select($query);
        return $result;
    }
    public function jobOfferInsert($data, $date){
        $empolyee_name = $this->fm->validation($data['empolyee_name']);
        $department = $this->fm->validation($data['department']);
        $employee_type = $this->fm->validation($data['employee_type']);
        $job_title = $this->fm->validation($data['job_title']);
        $emp_stage_one = $this->fm->validation($data['emp_stage_one']);
        $duration_one = $this->fm->validation($data['duration_one']);
        $grade_one = $this->fm->validation($data['grade_one']);
        $emp_stage_two = $this->fm->validation($data['emp_stage_two']);
        $duration_two = $this->fm->validation($data['duration_two']);
        $grade_two = $this->fm->validation($data['grade_two']);
        $emp_stage_three = $this->fm->validation($data['emp_stage_three']);
        $duration_three = $this->fm->validation($data['duration_three']);
        $grade_three = $this->fm->validation($data['grade_three']);
        $special_instruction = $this->fm->validation($data['special_instruction']);
        $joining_date = $this->fm->validation($data['joining_date']);
        
        $empolyee_name = mysqli_real_escape_string($this->db->link, $empolyee_name);
        $department = mysqli_real_escape_string($this->db->link, $department);
        $employee_type = mysqli_real_escape_string($this->db->link, $employee_type);
        $job_title = mysqli_real_escape_string($this->db->link, $job_title);
        $emp_stage_one = mysqli_real_escape_string($this->db->link, $emp_stage_one);
        $duration_one = mysqli_real_escape_string($this->db->link, $duration_one);
        $grade_one = mysqli_real_escape_string($this->db->link, $grade_one);
        $emp_stage_two = mysqli_real_escape_string($this->db->link, $emp_stage_two);
        $duration_two = mysqli_real_escape_string($this->db->link, $duration_two);
        $grade_two = mysqli_real_escape_string($this->db->link, $grade_two);
        $emp_stage_three = mysqli_real_escape_string($this->db->link, $emp_stage_three);
        $duration_three = mysqli_real_escape_string($this->db->link, $duration_three);
        $grade_three = mysqli_real_escape_string($this->db->link, $grade_three);
        $special_instruction = mysqli_real_escape_string($this->db->link, $special_instruction);
        $joining_date = mysqli_real_escape_string($this->db->link, $joining_date);

        if (empty($empolyee_name) || empty($emp_stage_one) || empty($duration_one) || empty($grade_one)) {
            $errmsg = "<div class='alert alert-danger' role='alert'>Fields Must Not be Empty !!</div>";
            return $errmsg;
        }else{
            $query = "INSERT INTO tbl_jol(userId, employee_type, duration_one, duration_two, duration_three, joining_date, emp_stage_one, emp_stage_two, emp_stage_three, job_title, grade_one, grade_two, grade_three, letter_created_date, special_instruction) VALUES('$empolyee_name', '$employee_type', '$duration_one', '$duration_two', '$duration_three', '$joining_date', '$emp_stage_one', '$emp_stage_two', '$emp_stage_three', '$job_title', '$grade_one', '$grade_two', '$grade_three', '$date', '$special_instruction')";
            $result = $this->db->insert($query);
            if ($result) {
                ?>
                    <script>
                        var my_date = new Date ();
                        alert('Letter Successfully Created..!! '+my_date);
                        window.location = 'job_offer_letter?id=<?php echo $empolyee_name; ?>';
                    </script>
                <?php
            }else{
                $errmsg = "<div class='alert alert-danger' role='alert'>Data Not Inserted !!</div>";
                return $errmsg;
            }
        }
    }

    public function getJobOfferDataById($usrId){
        $query = "SELECT a.*, b.user, d.jobtitle, e.employee_type FROM tbl_jol AS a, tbl_employee AS b, tbl_jobtitle AS d, tbl_employee_type AS e WHERE b.userId = a.userId AND d.jId = a.job_title AND e.id = a.employee_type AND a.userId = '$usrId'";
        $result = $this->db->select($query);
        return $result;
    }
    public function getFatherName($usrId){
        $query = "SELECT * FROM tbl_father WHERE userId = '$usrId'";
        $result = $this->db->select($query);
        return $result;
    }
    public function getAddress($usrId){
        $query = "SELECT a.*, b.divName, c.distName, d.thName, e.postName FROM tbl_paddress AS a, tbl_division AS b, tbl_district AS c, tbl_thana AS d, tbl_post AS e WHERE b.divId = a.divId AND c.distId = a.distId AND d.thId = a.thId AND e.postId = a.postId AND userId = '$usrId'";
        $result = $this->db->select($query);
        return $result;
    }
    public function getStageOne($usrId){
        $query = "SELECT a.*, b.employement_stage, c.designation, c.total FROM tbl_jol AS a, tbl_employement_stage AS b, tbl_egrade AS c WHERE b.id = a.emp_stage_one AND c.grade = a.grade_one AND userId = '$usrId'";
        $result = $this->db->select($query);
        return $result;
    }
    public function getStageTwo($usrId){
        $query = "SELECT a.*, b.employement_stage, c.designation, c.total FROM tbl_jol AS a, tbl_employement_stage AS b, tbl_egrade AS c WHERE b.id = a.emp_stage_two AND c.grade = a.grade_two AND userId = '$usrId'";
        $result = $this->db->select($query);
        return $result;
    }
    public function getStageThree($usrId){
        $query = "SELECT a.*, b.employement_stage, c.designation, c.total FROM tbl_jol AS a, tbl_employement_stage AS b, tbl_egrade AS c WHERE b.id = a.emp_stage_three AND c.grade = a.grade_three AND userId = '$usrId'";
        $result = $this->db->select($query);
        return $result;
    }
public function insertNoc($data, $date,$time,$serverIP,$userId){
        //$empolyee_name = $this->fm->validation($data['empolyee_name']);
       
        $typeof_loi = $this->fm->validation($data['typeof_loi']);
        $purposeof_loi = $this->fm->validation($data['purposeof_loi']);
        $others = $this->fm->validation($data['others']);
        $ins_Name = $this->fm->validation($data['ins_Name']);
        $ten_details = $this->fm->validation($data['ten_details']);
        $passport = $this->fm->validation($data['passport']);
        
         $noteone = $this->fm->validation($data['noteone']);
        $notetwo = $this->fm->validation($data['notetwo']);
        $addressing_person = $this->fm->validation($data['addressing_person']);
        $addressing_desig = $this->fm->validation($data['addressing_desig']);
         $gen = $this->fm->validation($data['gen']);
        
         $orgName = $this->fm->validation($data['orgName']);

          
        
         $flat = $this->fm->validation($data['flat']);
        $floor = $this->fm->validation($data['floor']);
        $holding = $this->fm->validation($data['holding']);
        $building = $this->fm->validation($data['building']);
        $road = $this->fm->validation($data['road']);
        $block = $this->fm->validation($data['block']);
        $area = $this->fm->validation($data['area']);
        $village = $this->fm->validation($data['village']);

        $suit = $this->fm->validation($data['suit']);
        $level = $this->fm->validation($data['level']);
        $roadName = $this->fm->validation($data['roadName']);
        $sector = $this->fm->validation($data['sector']);
        $zone = $this->fm->validation($data['zone']);
        $section = $this->fm->validation($data['section']);
         $division = $this->fm->validation($data['division']);
        $district = $this->fm->validation($data['district']);
        $thana = $this->fm->validation($data['thana']);
        $postoffice = $this->fm->validation($data['postoffice']);
        $prefix = $this->fm->validation($data['prefix']);
        $suffix = $this->fm->validation($data['suffix']);


       

       
        //$empolyee_name = mysqli_real_escape_string($this->db->link, $empolyee_name);
        $typeof_loi = mysqli_real_escape_string($this->db->link, $typeof_loi);
        $purposeof_loi = mysqli_real_escape_string($this->db->link, $purposeof_loi);
         $others = mysqli_real_escape_string($this->db->link, $others);
          $ins_Name = mysqli_real_escape_string($this->db->link, $ins_Name);
           $ten_details = mysqli_real_escape_string($this->db->link, $ten_details);
           $passport = mysqli_real_escape_string($this->db->link, $passport);
            
            $noteone = mysqli_real_escape_string($this->db->link, $noteone);
        $notetwo = mysqli_real_escape_string($this->db->link, $notetwo);
        $addressing_person = mysqli_real_escape_string($this->db->link, $addressing_person);
         $addressing_desig = mysqli_real_escape_string($this->db->link, $addressing_desig);
         $gen = mysqli_real_escape_string($this->db->link, $gen);
       
        $orgName = mysqli_real_escape_string($this->db->link, $orgName);

           
        
       $flat = mysqli_real_escape_string($this->db->link, $flat);
        $floor = mysqli_real_escape_string($this->db->link, $floor);
        $holding = mysqli_real_escape_string($this->db->link, $holding);
        $building = mysqli_real_escape_string($this->db->link, $building);
        $road = mysqli_real_escape_string($this->db->link, $road);
        $block = mysqli_real_escape_string($this->db->link, $block);
        $area = mysqli_real_escape_string($this->db->link, $area);
        $village = mysqli_real_escape_string($this->db->link, $village);

        $suit = mysqli_real_escape_string($this->db->link, $suit);
        $level = mysqli_real_escape_string($this->db->link, $level);
        $roadName = mysqli_real_escape_string($this->db->link, $roadName);
        $sector = mysqli_real_escape_string($this->db->link, $sector);
        $zone = mysqli_real_escape_string($this->db->link, $zone);
        $section = mysqli_real_escape_string($this->db->link, $section);
        $division = mysqli_real_escape_string($this->db->link, $division);
        $district = mysqli_real_escape_string($this->db->link, $district);
        $thana = mysqli_real_escape_string($this->db->link, $thana);  
        $postoffice = mysqli_real_escape_string($this->db->link, $postoffice);
        
        $prefix = mysqli_real_escape_string($this->db->link, $prefix);  
        $suffix = mysqli_real_escape_string($this->db->link, $suffix);



          $Cquery = "SELECT * FROM employee WHERE userId = '$userId'";
        $result = $this->db->select($Cquery);
        if ($result) {
            while ($data = $result->fetch_assoc()) {
                $email = $data['officeemail'];
                $userName = $data['user'];

            }
        }
        
        // $Cquery = "SELECT * FROM tbl_user_reg WHERE regId = '$empolyee_name'";
        // $result = $this->db->select($Cquery);
        // if ($result) {
        //     while ($data = $result->fetch_assoc()) {
        //         $email = $data['email'];
        //         $userName = $data['userName'];

        //     }
        // }

        if ($others!="") {
                $purposeof_loi=$others;
            }   
        

if($passport!=""){
    $passp='Passport: $passport';
    echo 'Passport: $passport';
    
}else{
    $passp='';
}

 $Cnquery = "SELECT * FROM tbl_typesof_loi WHERE id = '$typeof_loi'";
        $resultc = $this->db->select($Cnquery);
        if ($resultc) {
            while ($datac = $resultc->fetch_assoc()) {
                $loi_types = $datac['loi_types'];
               

            }
        }

         if (empty($typeof_loi) ||  empty($purposeof_loi)|| empty($addressing_desig) || empty($orgName) || empty($division) ||empty($district) ||empty($thana) ||empty($postoffice)  ) {
            $errmsg = "<div class='alert alert-danger' role='alert'>Fields Must Not be Empty !!</div>";
            return $errmsg;
        }else{
           $query = "INSERT INTO tbl_letterof_noc(employee_name,prefix,addressing_person,suffix,addressing_desig,orgName, type_of_loi , purpose_of_loi,ins_Name,ten_Details,passport,noteone,notetwo,gender,flat,suit,level,floor,holding,building,roadName,road,block,sector,zone,section,area,village,division,district,thana,postoffice,country,cBy,cDate,cTime,ip) 
VALUES
('$userId','$prefix','$addressing_person','$suffix','$addressing_desig', '$orgName', '$typeof_loi', '$purposeof_loi', '$ins_Name', '$ten_details','$passport', '$noteone','$notetwo','$gen',  '$flat','$suit','$level','$floor','$holding','$building','$roadName','$road','$block','$sector','$zone','$section','$area','$village','$division','$district','$thana','$postoffice','19','$userId','$date','$time','$serverIP')";
$result = $this->db->insert($query);

$hquery = "UPDATE tbl_personalinfo SET 
	 			passport = '$passport'
	 			 WHERE userId = '$userId'";
	    	 $resulth = $this->db->update($hquery);


            if ($result) {
               echo "<script>alert('An Email has been sent.Please wait for approval.'); </script>";

                $headers = 'From: '.$email."\r\n".
                             
                            'Reply-To: '.$email."\r\n" .
                             
                            'X-Mailer: PHP/' . phpversion();

                            $email_to = "hr@keal.com.bd";
                            $email_subject= "Request for NOC";
                            $email_message= "
Dear $userName,
You have requested for following No Objection Certificate:

Employee ID: $userId
Authority Type: $loi_types
Purpose of NOC: $purposeof_loi
Passport Number:$passport
Addressing Person Name:$prefix $addressing_person $suffix
Addressing Person Designation: $addressing_desig
Addressing Person Organization: $orgName
Note 1: $noteone
Note 2: $notetwo

Activation Link: https://www.people.keal.com.bd/admin/view_noc

Best Regards,
HRD
Kyoto Engineering & Automation Ltd.";


                            


                            $headers1 = 'From: '.$email_to."\r\n".
                             
                            'Reply-To: '.$email_to."\r\n" .
                             
                            'X-Mailer: PHP/' . phpversion();

                            $email_subject1= "Request for NOC";
                            $email_message1= "
Dear $userName,
You have requested for following No Objection Certificate:

Employee ID: $userId
Authority Type: $loi_types
Purpose of NOC: $purposeof_loi
Passport Number:$passport
Addressing Person Name:$prefix $addressing_person $suffix
Addressing Person Designation: $addressing_desig
Addressing Person Organization: $orgName
Note 1: $noteone
Note 2: $notetwo

Please wait for HR approval.

Best Regards,
HRD
Kyoto Engineering & Automation Ltd.";
                             
                            $email_message2= 'Date'.$date."\r\n";
                            mail("<$email_to>","$email_subject","$email_message","$headers");

                            mail("<$email>","$email_subject1","$email_message1","$headers1");
                        
              
            }else{
                $errmsg = "<div class='alert alert-danger' role='alert'>Data Not Inserted !!</div>";
                return $errmsg;
            }
        }
}

public function getcounData($uId, $id){
    $query = "SELECT * FROM tbl_letterof_noc WHERE employee_name = '$uId' AND id='$id' ";
    $result = $this->db->select($query);
        return $result;
}
public function getNocData($uId, $id){
    $query = "SELECT a.*, b.loi_types,  e.userName, e.image, g.divName, h.distName, i.thName, j.postName, j.postCode FROM tbl_letterof_noc AS a, tbl_typesof_loi AS b,  tbl_user_reg AS e,tbl_division AS g, tbl_district AS h, tbl_thana AS i, tbl_post AS j WHERE a.type_of_loi = b.id AND     a.employee_name = e.regId AND a.employee_name = '$uId' AND a.id='$id' AND a.division=g.divId AND a.district=h.distId AND a.thana=i.thId AND a.postoffice=j.postId";
    $result = $this->db->select($query);
        return $result;
}

public function getNocoverData($uId, $id){
    $query = "SELECT a.*, b.loi_types,  e.userName, e.image,g.countryName FROM tbl_letterof_noc AS a, tbl_typesof_loi AS b,  tbl_user_reg AS e,tbl_country as g WHERE a.type_of_loi = b.id AND     a.employee_name = e.regId AND a.country=g.id AND a.employee_name = '$uId' AND a.id='$id'";
    $result = $this->db->select($query);
        return $result;
}


public function viewNocData(){
    $query = "SELECT a.*, b.loi_types,   e.userName, e.image FROM tbl_letterof_noc AS a, tbl_typesof_loi AS b,  tbl_user_reg AS e WHERE a.type_of_loi = b.id AND  a.employee_name = e.regId ";
    $result = $this->db->select($query);
        return $result;
}
public function viewNoconlyData(){
    $query = "SELECT * FROM tbl_letterof_noc ";
    $result = $this->db->select($query);
        return $result;
}

public function getnameby($uId){
     $query = "SELECT * FROM tbl_user_reg WHERE regId = '$uId'";
     $result = $this->db->select($query);
     return $result;   
}

public function getPersonalData($uId){
    $query = "SELECT * FROM tbl_personalinfo WHERE userId = '$uId'";
     $result = $this->db->select($query);
        return $result;
}
public function getPersonalFatherData($uId){
    $query = "SELECT * FROM tbl_father WHERE userId = '$uId'";
     $result = $this->db->select($query);
        return $result;
}
public function getPersonalMotherData($uId){
    $query = "SELECT * FROM tbl_mother WHERE userId = '$uId'";
     $result = $this->db->select($query);
        return $result;
}
public function getDeptData($uId){
    $query = "SELECT a.*, b.deptName FROM tbl_employee AS a, tbl_department AS b WHERE  a.department = b.dId AND a.userId = '$uId'";
     $result = $this->db->select($query);
        return $result;
}
public function getSinceData($uId){
    $query = "SELECT * FROM tbl_joining_info WHERE userId = '$uId'";
     $result = $this->db->select($query);
        return $result;
}
public function getCompensationData($grade){
    // $query = "SELECT a.*, b.basicAmmount, b.houserentAmmount, b.medical, b.transportAllowance, b.total FROM tbl_employee AS a, tbl_egrade AS b WHERE a.grade = b.id AND a.userId = '$uId'";
    $gquery = "SELECT * FROM tbl_egrade WHERE grade='$grade'";
    $result = $this->db->select($gquery);
    return $result;
}
public function getQrCode($uId,$id){
    $query = "SELECT * FROM tbl_nocqr WHERE eId = '$uId' AND cId='$id' LIMIT 1";
    $result = $this->db->select($query);
    return $result;
}
public function getNocQrData($uId,$id){
    $query = "SELECT * FROM tbl_nocregqr WHERE eId = '$uId' AND cId='$id' LIMIT 1";
    $result = $this->db->select($query);
    return $result;
}

public function getlettertitle(){
    $query = "SELECT * FROM tbl_letter_tittle ORDER BY id DESC";
    $result = $this->db->select($query);
    return $result;
}

public function insertRegisterData($data,$addepartment, $date, $ip){
    $eId = $data['eId'];
    $name = $data['name'];
    $id = $data['id'];
  

    $ref = "KEAL/$addepartment/KPS-IC-$eId/NOC/$id";
    $query = "INSERT INTO tbl_certificate_register(cId, ref, name, userId, releaseDate, status, sip,lName) VALUES('$id', '$ref', '$name', '$eId','$date', '1', '$ip','NOC')";
    $result = $this->db->insert($query);
    if ($result) {
        echo "<script>alert('Successfully Created'); window.location='';</script>";
    }
}
public function getNocLetterNumberById($id, $ref){
    $query = "SELECT * FROM tbl_certificate_register WHERE cId = '$id' AND ref = '$ref'";
    $result = $this->db->select($query);
    return $result;
}

public function getGratefromSI($sigrade){
   
    $gquery = "SELECT * FROM tbl_egrade WHERE si='$sigrade'";
    $result = $this->db->select($gquery);
    return $result;
}

public function getCountryName(){
        $query = "SELECT * FROM tbl_country";
        $result = $this->db->select($query);
        return $result;
    }
public function insertoverNoc($data, $date,$time,$serverIP,$userId){
        //$empolyee_name = $this->fm->validation($data['empolyee_name']);
       
        $typeof_loi = $this->fm->validation($data['typeof_loi']);
        $purposeof_loi = $this->fm->validation($data['purposeof_loi']);
        $others = $this->fm->validation($data['others']);
        $ins_Name = $this->fm->validation($data['ins_Name']);
        $ten_details = $this->fm->validation($data['ten_details']);
        $passport = $this->fm->validation($data['passport']);
       
        $noteone = $this->fm->validation($data['noteone']);
        $notetwo = $this->fm->validation($data['notetwo']);
        $addressing_person = $this->fm->validation($data['addressing_person']);
        $addressing_desig = $this->fm->validation($data['addressing_desig']);
        $gen = $this->fm->validation($data['gen']); 
         $orgName = $this->fm->validation($data['orgName']);
        $countryName = $this->fm->validation($data['country']);
        $zipcode = $this->fm->validation($data['zipcode']);
        $address = $this->fm->validation($data['address']);

          
        $prefix = $this->fm->validation($data['prefix']);
        $suffix = $this->fm->validation($data['suffix']);
        
       

       

       
        //$empolyee_name = mysqli_real_escape_string($this->db->link, $empolyee_name);
        $typeof_loi = mysqli_real_escape_string($this->db->link, $typeof_loi);
        $purposeof_loi = mysqli_real_escape_string($this->db->link, $purposeof_loi);
         $others = mysqli_real_escape_string($this->db->link, $others);
          $ins_Name = mysqli_real_escape_string($this->db->link, $ins_Name);
           $ten_details = mysqli_real_escape_string($this->db->link, $ten_details);
           $passport = mysqli_real_escape_string($this->db->link, $passport);
           
            $noteone = mysqli_real_escape_string($this->db->link, $noteone);
        $notetwo = mysqli_real_escape_string($this->db->link, $notetwo);
        $addressing_person = mysqli_real_escape_string($this->db->link, $addressing_person);
         $addressing_desig = mysqli_real_escape_string($this->db->link, $addressing_desig);
         $gen = mysqli_real_escape_string($this->db->link, $gen);
        
        $orgName = mysqli_real_escape_string($this->db->link, $orgName);
        $countryName = mysqli_real_escape_string($this->db->link, $countryName);
        $zipcode = mysqli_real_escape_string($this->db->link, $zipcode);
        $address = mysqli_real_escape_string($this->db->link, $address);  

         
        $prefix = mysqli_real_escape_string($this->db->link, $prefix);  
        $suffix = mysqli_real_escape_string($this->db->link, $suffix);

         $Cquery = "SELECT * FROM tbl_user_reg WHERE regId = '$userId'";
        $result = $this->db->select($Cquery);
        if ($result) {
            while ($data = $result->fetch_assoc()) {
                $email = $data['email'];
                $userName = $data['userName'];

            }
        }
       
        if ($others!="") {
                $purposeof_loi=$others;
            }   
        

$Cnquery = "SELECT * FROM tbl_typesof_loi WHERE id = '$typeof_loi'";
        $resultc = $this->db->select($Cnquery);
        if ($resultc) {
            while ($datac = $resultc->fetch_assoc()) {
                $loi_types = $datac['loi_types'];
               

            }
        }

         if ( empty($typeof_loi) ||  empty($purposeof_loi)|| empty($addressing_desig) || empty($orgName) || empty($countryName)|| empty($zipcode)|| empty($address)) {
            $errmsg = "<div class='alert alert-danger' role='alert'>Fields Must Not be Empty !!</div>";
            return $errmsg;
        }else{
           $query = "INSERT INTO 	tbl_letterof_noc(employee_name,prefix,addressing_person,suffix,addressing_desig,orgName, type_of_loi , purpose_of_loi,ins_Name,ten_Details,passport,noteone,notetwo,gender,country,zipcode,address,cBy,cDate,cTime,ip) 
VALUES
('$userId','$prefix','$addressing_person','$suffix','$addressing_desig',  '$orgName', '$typeof_loi', '$purposeof_loi', '$ins_Name', '$ten_details','$passport','$noteone','$notetwo', '$gen',  '$countryName','$zipcode','$address','$userId','$date','$time','$serverIP')";
$result = $this->db->insert($query);

$hquery = "UPDATE tbl_personalinfo SET 
	 			passport = '$passport'
	 			 WHERE userId = '$userId'";
	    	 $resulth = $this->db->update($hquery);


            
             if ($result) {
               echo "<script>alert('An Email has been sent.please wait for approval'); </script>";

                $headers = 'From: '.$email."\r\n".
                             
                            'Reply-To: '.$email."\r\n" .
                             
                            'X-Mailer: PHP/' . phpversion();

                            $email_to = "hr@keal.com.bd";
                            $email_subject= "Request for NOC";
                            $email_message= "
Dear $userName,
You have requested for following No Objection Certificate:

Employee ID: $userId
Authority Type: $loi_types
Purpose of NOC: $purposeof_loi
Passport Number:$passport
Addressing Person Name:$prefix $addressing_person $suffix
Addressing Person Designation: $addressing_desig
Addressing Person Organization: $orgName
Note 1: $noteone
Note 2: $notetwo

Activation Link: https://www.people.keal.com.bd/admin/view_noc

Best Regards,
HRD
Kyoto Engineering & Automation Ltd.";

                            


                            $headers1 = 'From: '.$email_to."\r\n".
                             
                            'Reply-To: '.$email_to."\r\n" .
                             
                            'X-Mailer: PHP/' . phpversion();

                            $email_subject1= "Request for NOC";
                            $email_message1= "
Dear $userName,
You have requested for following Non Objection Certificate:

Employee ID: $userId
Authority Type: $loi_types
Purpose of Noc: $purposeof_loi
Passport Number:$passport
Addressing Person Name:$prefix $addressing_person $suffix
Addressing Person Designation: $addressing_desig
Addressing Person Organization: $orgName
Note 1: $noteone
Note 2: $notetwo

Please wait for HR approval.

Best Regards,
HRD
Kyoto Engineering & Automation Ltd.";
                             
                            $email_message2= 'Date'.$date."\r\n";
                            mail("<$email_to>","$email_subject","$email_message","$headers");

                            mail("<$email>","$email_subject1","$email_message1","$headers1");
                        
              
            }else{
                $errmsg = "<div class='alert alert-danger' role='alert'>Data Not Inserted !!</div>";
                return $errmsg;
            }
        }
}
public function getpermanentuseraddressBy($uId){
            $query = "SELECT r.*, s.distName, t.thName, b.postName,b.postCode
             FROM tbl_paddress as r, tbl_district as s, tbl_thana as t, tbl_post as b
              WHERE r.distId = s.distId AND r.thId = t.thId AND r.postId = b.postId AND r.userId = '$uId'";
            //$query = "SELECT * FROM tbl_paddress WHERE userId = '$uId'";
            $result = $this->db->select($query);
            return $result;
        }


public function getpaddData($uId, $id){
    $query = "SELECT a.*, b.loi_types,  e.userName, e.image, g.divName, h.distName, i.thName, j.postName, j.postCode FROM tbl_letterof_noc AS a, tbl_typesof_loi AS b,  tbl_user_reg AS e,tbl_division AS g, tbl_district AS h, tbl_thana AS i, tbl_post AS j WHERE a.type_of_loi = b.id AND     a.employee_name = e.regId AND a.employee_name = '$uId' AND a.id='$id' AND a.pdivision=g.divId AND a.pdistrict=h.distId AND a.pthana=i.thId AND a.ppostoffice=j.postId";
    $result = $this->db->select($query);
        return $result;
}

public function getSalutationPrefix(){
    $query = "SELECT * FROM tbl_prefix";
    $result = $this->db->select($query);
    return $result;
}
public function getSalutationSuffix(){
    $query = "SELECT * FROM tbl_suffix";
    $result = $this->db->select($query);
    return $result;
}

//prefix data
public function getSalPrefix($sal_prefix){

	$sPquery = "SELECT * FROM tbl_prefix WHERE id = '$sal_prefix'";
	$sPresult = $this->db->select($sPquery);
	return $sPresult;
}

//prefix data	
public function getSalSuffix($sal_suffix){

	$sSquery = "SELECT * FROM tbl_suffix WHERE id = '$sal_suffix'";
	$sSresult = $this->db->select($sSquery);
	return $sSresult;
			
}



}?>