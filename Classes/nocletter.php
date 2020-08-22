<?php include_once "../lib/Database.php"; ?>
<?php include_once "../helpers/Format.php"; ?>
<?php include_once "../lib/Session.php"; ?>


<?php

	/**
	* nocletter Class
	*/
	class nocletter {
            
    private $db;
    private $fm;
    public function __construct(){
        $this->db = new Database();
        $this->fm = new Format();
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

public function getNocLetterNumberById($id){
    $query = "SELECT * FROM tbl_certificate_register WHERE cId = '$id' ";
    $result = $this->db->select($query);
    return $result;
}

public function getQrCode($uId,$id){
    $query = "SELECT * FROM tbl_nocqr WHERE eId = '$uId' AND cId='$id' LIMIT 1";
    $result = $this->db->select($query);
    return $result;
}

public function getPersonalData($uId){
    $query = "SELECT * FROM tbl_personalinfo WHERE userId = '$uId'";
     $result = $this->db->select($query);
        return $result;
}

public function getDeptData($uId){
    $query = "SELECT a.*, b.deptName FROM tbl_employee AS a, tbl_department AS b WHERE  a.department = b.dId AND a.userId = '$uId'";
     $result = $this->db->select($query);
        return $result;
}

public function getGratefromSI($sigrade){
   
    $gquery = "SELECT * FROM tbl_egrade WHERE si='$sigrade'";
    $result = $this->db->select($gquery);
    return $result;
}

public function getSinceData($uId){
    $query = "SELECT * FROM tbl_joining_info WHERE userId = '$uId'";
     $result = $this->db->select($query);
        return $result;
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

public function getCompensationData($grade){
    // $query = "SELECT a.*, b.basicAmmount, b.houserentAmmount, b.medical, b.transportAllowance, b.total FROM tbl_employee AS a, tbl_egrade AS b WHERE a.grade = b.id AND a.userId = '$uId'";
    $gquery = "SELECT * FROM tbl_egrade WHERE grade='$grade'";
    $result = $this->db->select($gquery);
    return $result;
}

public function getAdminDetails($id){
    $query = "SELECT a.*, e.* FROM tbl_letterof_noc AS a, tbl_login AS e WHERE   a.adminId = e.id AND a.id='$id' ";
    $result = $this->db->select($query);
        return $result;
}

public function getNocQrData($uId,$id){
    $query = "SELECT * FROM tbl_nocregqr WHERE eId = '$uId' AND cId='$id' LIMIT 1";
    $result = $this->db->select($query);
    return $result;
}

public function userselect($uId){
        $query = "SELECT * FROM tbl_userdeduct WHERE userId='$uId' ";
        $result = $this->db->select($query);
        return $result;   
}

public function getimageData($uId){
        $query = "SELECT * FROM tbl_user_reg WHERE regId='$uId' ";
        $result = $this->db->select($query);
        return $result;   
}

public function getemployee($uId){
        $query = "SELECT * FROM tbl_employee WHERE userId='$uId' ";
        $result = $this->db->select($query);
        return $result;   
}
public function getpresentaddData($uId){
            $query = "SELECT r.*, s.distName, t.thName, b.postName,b.postCode
             FROM tbl_address as r, tbl_district as s, tbl_thana as t, tbl_post as b
              WHERE r.distId = s.distId AND r.thId = t.thId AND r.postId = b.postId AND r.userId = '$uId'";
            //$query = "SELECT * FROM tbl_paddress WHERE userId = '$uId'";
            $result = $this->db->select($query);
            return $result;
        }


}?>