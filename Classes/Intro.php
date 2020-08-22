<?php include_once "../lib/Database.php"; ?>
<?php include_once "../helpers/Format.php"; ?>
<?php include_once "../lib/Session.php"; ?>


<?php

	/**
	* Letter Class
	*/
	class Intro {
            
    private $db;
    private $fm;
    public function __construct(){
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function getEmpolyeeName(){
        $query = "SELECT * FROM tbl_employee WHERE employeestat='8'";
        $result = $this->db->select($query);
        return $result;
    }

    public function insertgeneralloi($data, $checkseven, $date,$time,$serverIP,$userId){
        //$empolyee_name = $this->fm->validation($data['empolyee_name']);
    
        $typeof_loi = $this->fm->validation($data['typeof_loi']);
        $purposeof_loi = $this->fm->validation($data['purposeof_loi']);
        
        $passport = $this->fm->validation($data['passport']);
        
        $noteone = $this->fm->validation($data['noteone']);
        $notetwo = $this->fm->validation($data['notetwo']);
       

          
       

       

       
       // $empolyee_name = mysqli_real_escape_string($this->db->link, $empolyee_name);
        $typeof_loi = mysqli_real_escape_string($this->db->link, $typeof_loi);
        $purposeof_loi = mysqli_real_escape_string($this->db->link, $purposeof_loi);
        $checkseven = mysqli_real_escape_string($this->db->link, $checkseven);
           $passport = mysqli_real_escape_string($this->db->link, $passport);
           
            $noteone = mysqli_real_escape_string($this->db->link, $noteone);
        $notetwo = mysqli_real_escape_string($this->db->link, $notetwo);
    
        
       
        
          $Cquery = "SELECT * FROM employee WHERE userId = '$empolyee_name'";
        $result = $this->db->select($Cquery);
        if ($result) {
            while ($data = $result->fetch_assoc()) {
                $email = $data['officeemail'];
                $userName = $data['user'];

            }
        }
     
      $Cnquery = "SELECT * FROM tbl_typesof_loi WHERE id = '$typeof_loi'";
        $resultc = $this->db->select($Cnquery);
        if ($resultc) {
            while ($datac = $resultc->fetch_assoc()) {
                $loi_types = $datac['loi_types'];
               

            }
        }
     
       
        



         if ( empty($typeof_loi) || empty($purposeof_loi)) {
            $errmsg = "<div class='alert alert-danger' role='alert'>Fields Must Not be Empty !!</div>";
            return $errmsg;
        }else{
           $query = "INSERT INTO tbl_letterofintro(employee_name,typeof_loi,purposeof_loi,checkseven,passport,noteone,notetwo,cBy,cDate,cTime,ip,statn) 
VALUES
('$userId','$typeof_loi','$purposeof_loi','$checkseven','$passport','$noteone','$notetwo',  '$userId','$date','$time','$serverIP','1')";
$result = $this->db->insert($query);

$hquery = "UPDATE tbl_personalinfo SET 
	 			passport = '$passport'
	 			 WHERE userId = '$userId'";
	    	 $resulth = $this->db->update($hquery);


            
            if ($result) {
               echo "<script>alert('Successfully Submitted. Please wait for HR approval.'); </script>";

               $headers = 'From: '.$email."\r\n".
                             
                            'Reply-To: '.$email."\r\n" .
                             
                            'X-Mailer: PHP/' . phpversion();

                            $email_to = "hr@keal.com.bd";
                            $email_subject= "Request for LOI";
                            $email_message= "
Dear $userName,
You have requested for following Letter of Introduction:
Employee ID: $userId
Authority Type: $loi_types
Purpose of LOI: $purposeof_loi
Passport Number:$passport
Note 1: $noteone
Note 2: $notetwo

Activation Link: https://www.people.keal.com.bd/admin/view_loi";

                            


                            $headers1 = 'From: '.$email_to."\r\n".
                             
                            'Reply-To: '.$email_to."\r\n" .
                             
                            'X-Mailer: PHP/' . phpversion();

                            $email_subject1= "Request for LOI";
                            $email_message1= "
Dear $userName,
You have requested for following Letter of Introduction:
Employee ID: $userId
Authority Type: $loi_types
Purpose of LOI: $purposeof_loi
Passport Number:$passport
Note 1: $noteone
Note 2: $notetwo
Please wait for approval";
                             
                            $email_message2= 'Date'.$date."\r\n";
                            mail("<$email_to>","$email_subject","$email_message","$headers");

                            mail("<$email>","$email_subject1","$email_message1","$headers1");
                        
            }else{
                $errmsg = "<div class='alert alert-danger' role='alert'>Data Not Inserted !!</div>";
                return $errmsg;
            }
        }



        
}

public function viewLoiData(){
    $query = "SELECT a.*,  e.userName, e.image FROM tbl_letterofintro AS a, tbl_user_reg AS e WHERE   a.employee_name = e.regId ";
    $result = $this->db->select($query);
        return $result;
}

public function getnameby($uId){
     $query = "SELECT * FROM tbl_user_reg WHERE regId = '$uId'";
     $result = $this->db->select($query);
     return $result;   
}


public function getloiLetterNumberById($id, $ref){
    $query = "SELECT * FROM tbl_certificate_register WHERE cId = '$id' AND ref = '$ref'";
    $result = $this->db->select($query);
    return $result;
}

public function getloiData($uId, $id){
    $query = "SELECT a.*, e.userName, e.image FROM tbl_letterofintro AS a, tbl_user_reg AS e WHERE   a.employee_name = e.regId AND a.employee_name = '$uId' AND a.id='$id' ";
    $result = $this->db->select($query);
        return $result;
}
public function getloiBangData($uId, $id){
    $query = "SELECT a.*, b.loi_types,  e.userName, e.image, g.divName, h.distName, i.thName, j.postName, j.postCode FROM tbl_letterofintro AS a, tbl_typesof_loi AS b,  tbl_user_reg AS e,tbl_division AS g, tbl_district AS h, tbl_thana AS i, tbl_post AS j WHERE a.typeof_loi = b.id AND     a.employee_name = e.regId AND a.employee_name = '$uId' AND a.id='$id' AND a.division=g.divId AND a.district=h.distId AND a.thana=i.thId AND a.postoffice=j.postId";
    $result = $this->db->select($query);
        return $result;
}
public function getloioverData($uId, $id){
    $query = "SELECT a.*, e.userName, e.image , g.countryName FROM tbl_letterofintro AS a, tbl_user_reg AS e, tbl_country as g WHERE   a.employee_name = e.regId AND a.employee_name = '$uId' AND a.id='$id' AND a.country=g.id  ";
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

public function getGratefromSI($sigrade){
   
    $gquery = "SELECT * FROM tbl_egrade WHERE si='$sigrade'";
    $result = $this->db->select($gquery);
    return $result;
}
public function insertloiRegisterData($data,$addepartment, $date, $ip){
    $eId = $data['eId'];
    $name = $data['name'];
    $id = $data['id'];
  

    $ref = "KEAL/$addepartment/KPS-IC-$eId/LOI/$id";
    $query = "INSERT INTO tbl_certificate_register(cId, ref, name, userId, releaseDate, status, sip,lName) VALUES('$id', '$ref', '$name', '$eId','$date', '1', '$ip','LOI')";
    $result = $this->db->insert($query);
    if ($result) {
        echo "<script>alert('Successfully Created'); window.location='';</script>";
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
    $query = "SELECT a.*, e.userName, e.image, g.divName, h.distName, i.thName, j.postName, j.postCode FROM tbl_letterofintro AS a,   tbl_user_reg AS e,tbl_division AS g, tbl_district AS h, tbl_thana AS i, tbl_post AS j WHERE     a.employee_name = e.regId AND a.employee_name = '$uId' AND a.id='$id' AND a.pdivision=g.divId AND a.pdistrict=h.distId AND a.pthana=i.thId AND a.ppostoffice=j.postId";
    $result = $this->db->select($query);
        return $result;
}
public function getCompensationData($grade){
    // $query = "SELECT a.*, b.basicAmmount, b.houserentAmmount, b.medical, b.transportAllowance, b.total FROM tbl_employee AS a, tbl_egrade AS b WHERE a.grade = b.id AND a.userId = '$uId'";
    $gquery = "SELECT * FROM tbl_egrade WHERE grade='$grade'";
    $result = $this->db->select($gquery);
    return $result;
}

public function getloiQrData($uId,$id){
    $query = "SELECT * FROM tbl_loiregqr WHERE eId = '$uId' AND cId='$id' LIMIT 1";
    $result = $this->db->select($query);
    return $result;
}
public function getloiQrCode($uId,$id){
    $query = "SELECT * FROM tbl_loiqr WHERE eId = '$uId' AND cId='$id' LIMIT 1";
    $result = $this->db->select($query);
    return $result;
}

public function insertoverloi($data, $checkseven, $date,$time,$serverIP,$userId){
       // $empolyee_name = $this->fm->validation($data['empolyee_name']);
       
        $typeof_loi = $this->fm->validation($data['typeof_loi']);
        $purposeof_loi = $this->fm->validation($data['purposeof_loi']);
       
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
        
       

       

       
       // $empolyee_name = mysqli_real_escape_string($this->db->link, $empolyee_name);
        $typeof_loi = mysqli_real_escape_string($this->db->link, $typeof_loi);
        $purposeof_loi = mysqli_real_escape_string($this->db->link, $purposeof_loi);
         $checkseven = mysqli_real_escape_string($this->db->link, $checkseven);
         
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
       
       
 $Cquery = "SELECT * FROM employee WHERE userId = '$empolyee_name'";
        $result = $this->db->select($Cquery);
        if ($result) {
            while ($data = $result->fetch_assoc()) {
                $email = $data['officeemail'];
                $userName = $data['user'];

            }
        }
     
      $Cnquery = "SELECT * FROM tbl_typesof_loi WHERE id = '$typeof_loi'";
        $resultc = $this->db->select($Cnquery);
        if ($resultc) {
            while ($datac = $resultc->fetch_assoc()) {
                $loi_types = $datac['loi_types'];
               

            }
        }



         if ( empty($typeof_loi) ||  empty($purposeof_loi)|| empty($addressing_desig) || empty($orgName) || empty($countryName) || empty($zipcode) || empty($address)) {
            $errmsg = "<div class='alert alert-danger' role='alert'>Fields Must Not be Empty !!</div>";
            return $errmsg;
        }else{
           $query = "INSERT INTO tbl_letterofintro(employee_name,prefix,addressing_person,suffix,addressing_desig,orgName, typeof_loi , purposeof_loi,checkseven,passport,noteone,notetwo,gender,country,zipcode,address,cBy,cDate,cTime,ip,statn) 
VALUES
('$userId','$prefix','$addressing_person','$suffix','$addressing_desig',  '$orgName', '$typeof_loi', '$purposeof_loi', '$checkseven','$passport','$noteone','$notetwo', '$gen',  '$countryName','$zipcode','$address','$userId','$date','$time','$serverIP','2')";
$result = $this->db->insert($query);

$hquery = "UPDATE tbl_personalinfo SET 
	 			passport = '$passport'
	 			 WHERE userId = '$userId'";
	    	 $resulth = $this->db->update($hquery);


            
            if ($result) {
                 echo "<script>alert('Successfully Submitted. Please wait for HR approval.'); </script>";

                $headers = 'From: '.$email."\r\n".
                             
                            'Reply-To: '.$email."\r\n" .
                             
                            'X-Mailer: PHP/' . phpversion();

                            $email_to = "hr@keal.com.bd";
                            $email_subject= "Request for LOI";
                            $email_message= "
Dear $userName,
You have requested for following Letter of Introduction:
Employee ID: $userId
Authority Type: $loi_types
Purpose of LOI: $purposeof_loi
Passport Number:$passport
Addressing Person Name:$prefix $addressing_person $suffix
Addressing Person Designation: $addressing_desig
Addressing Person Organization: $orgName
Note 1: $noteone
Note 2: $notetwo

Activation Link: https://www.people.keal.com.bd/admin/view_loi";

                            


                            $headers1 = 'From: '.$email_to."\r\n".
                             
                            'Reply-To: '.$email_to."\r\n" .
                             
                            'X-Mailer: PHP/' . phpversion();

                            $email_subject1= "Request for LOI";
                            $email_message1= "
Dear $userName,
You have requested for following Letter of Introduction:
Employee ID: $userId
Authority Type: $loi_types
Purpose of LOI: $purposeof_loi
Passport Number:$passport
Addressing Person Name:$prefix $addressing_person $suffix
Addressing Person Designation: $addressing_desig
Addressing Person Organization: $orgName
Note 1: $noteone
Note 2: $notetwo
Please wait for approval";
                             
                            $email_message2= 'Date'.$date."\r\n";
                            mail("<$email_to>","$email_subject","$email_message","$headers");

                            mail("<$email>","$email_subject1","$email_message1","$headers1");
                        
            }else{
                $errmsg = "<div class='alert alert-danger' role='alert'>Data Not Inserted !!</div>";
                return $errmsg;
            }
        }



        
}
public function insertloi($data, $checkseven,$date,$time,$serverIP,$userId){
        //$empolyee_name = $this->fm->validation($data['empolyee_name']);
       
        $typeof_loi = $this->fm->validation($data['typeof_loi']);
        $purposeof_loi = $this->fm->validation($data['purposeof_loi']);
        
        $passport = $this->fm->validation($data['passport']);
       
         $noteone = $this->fm->validation($data['noteone']);
        $notetwo = $this->fm->validation($data['notetwo']);
        $addressing_person = $this->fm->validation($data['addressing_person']);
        $addressing_desig = $this->fm->validation($data['addressing_desig']);
         //$gen = $this->fm->validation($data['gen']); 
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
         $checkseven = mysqli_real_escape_string($this->db->link, $checkseven);
        
           $passport = mysqli_real_escape_string($this->db->link, $passport);
           
            $noteone = mysqli_real_escape_string($this->db->link, $noteone);
        $notetwo = mysqli_real_escape_string($this->db->link, $notetwo);
        $addressing_person = mysqli_real_escape_string($this->db->link, $addressing_person);
         $addressing_desig = mysqli_real_escape_string($this->db->link, $addressing_desig);
        // $gen = mysqli_real_escape_string($this->db->link, $gen);
        
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

       

        $Cquery = "SELECT * FROM employee WHERE userId = '$empolyee_name'";
        $result = $this->db->select($Cquery);
        if ($result) {
            while ($data = $result->fetch_assoc()) {
                $email = $data['officeemail'];
                $userName = $data['user'];

            }
        }
     
      $Cnquery = "SELECT * FROM tbl_typesof_loi WHERE id = '$typeof_loi'";
        $resultc = $this->db->select($Cnquery);
        if ($resultc) {
            while ($datac = $resultc->fetch_assoc()) {
                $loi_types = $datac['loi_types'];
               

            }
        }


         if ( empty($typeof_loi) ||  empty($purposeof_loi)|| empty($addressing_desig) || empty($orgName)|| empty($division)|| empty($district)|| empty($thana)|| empty($postoffice) ) {
            $errmsg = "<div class='alert alert-danger' role='alert'>Fields Must Not be Empty !!</div>";
            return $errmsg;
        }else{
           $query = "INSERT INTO tbl_letterofintro(employee_name,prefix,addressing_person,suffix,addressing_desig,orgName, typeof_loi , purposeof_loi,checkseven,passport,noteone,notetwo,flat,suit,level,floor,holding,building,roadName,road,block,sector,zone,section,area,village,division,district,thana,postoffice,country,cBy,cDate,cTime,ip,statn) 
VALUES
('$userId','$prefix','$addressing_person','$suffix','$addressing_desig', '$orgName', '$typeof_loi', '$purposeof_loi', '$checkseven','$passport','$noteone','$notetwo',  '$flat','$suit','$level','$floor','$holding','$building','$roadName','$road','$block','$sector','$zone','$section','$area','$village','$division','$district','$thana','$postoffice','19','$userId','$date','$time','$serverIP','2')";
$result = $this->db->insert($query);

$hquery = "UPDATE tbl_personalinfo SET 
	 			passport = '$passport'
	 			 WHERE userId = '$userId'";
	    	 $resulth = $this->db->update($hquery);



          
            if ($result) {
                echo "<script>alert('Successfully Submitted.Please wait for HR approval.'); </script>";

                $headers = 'From: '.$email."\r\n".
                             
                            'Reply-To: '.$email."\r\n" .
                             
                            'X-Mailer: PHP/' . phpversion();

                            $email_to = "hr@keal.com.bd";
                            $email_subject= "Request for LOI";
                            $email_message= "
Dear $userName,
You have requested for following Letter of Introduction:
Employee ID: $userId
Authority Type: $loi_types
Purpose of LOI: $purposeof_loi
Passport Number:$passport
Addressing Person Name:$prefix $addressing_person $suffix
Addressing Person Designation: $addressing_desig
Addressing Person Organization: $orgName
Note 1: $noteone
Note 2: $notetwo

Activation Link: https://www.people.keal.com.bd/admin/view_loi";

                            


                            $headers1 = 'From: '.$email_to."\r\n".
                             
                            'Reply-To: '.$email_to."\r\n" .
                             
                            'X-Mailer: PHP/' . phpversion();

                            $email_subject1= "Request for LOI";
                            $email_message1= "
Dear $userName,
You have requested for following Letter of Introduction:
Employee ID: $userId
Authority Type: $loi_types
Purpose of LOI: $purposeof_loi
Passport Number:$passport
Addressing Person Name:$prefix $addressing_person $suffix
Addressing Person Designation: $addressing_desig
Addressing Person Organization: $orgName
Note 1: $noteone
Note 2: $notetwo
Please wait for approval";
                             
                            $email_message2= 'Date'.$date."\r\n";
                            mail("<$email_to>","$email_subject","$email_message","$headers");

                            mail("<$email>","$email_subject1","$email_message1","$headers1");
                        
            }else{
                $errmsg = "<div class='alert alert-danger' role='alert'>Data Not Inserted !!</div>";
                return $errmsg;
            }
        }



        
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
public function userselect($uId){
        $query = "SELECT * FROM tbl_userdeduct WHERE userId='$uId' ";
        $result = $this->db->select($query);
        return $result;   
}

   
}?>