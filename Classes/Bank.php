<?php include_once "lib/Database.php"; ?>
<?php include_once "lib/Format.php"; ?>
<?php include_once "lib/Session.php"; ?>


<?php

	/**
	* Bank Class
	*/
	class Bank {
            
    private $db;
    private $fm;
    public function __construct(){
        $this->db = new Database();
        $this->fm = new Format();
    }
    public function getBankName(){
        $query  = "SELECT * FROM tbl_bankname";
        $result = $this->db->select($query);
        return $result;
    }
    public function getBranchName(){
        $query  = "SELECT * FROM tbl_branchaddress";
        $result = $this->db->select($query);
        return $result;
    }
    
        public function getBranchNameby($bnkIs){
        $query  = "SELECT * FROM tbl_branchaddress WHERE bank_name='$bnkIs'";
        $result = $this->db->select($query);
        return $result;
    }
    public function getAllDivision(){
        $query  = "SELECT * FROM tbl_division ORDER BY divName ASC";
        $result = $this->db->select($query);
        return $result;
    }
    public function getAllDistrict(){
        $query  = "SELECT * FROM tbl_district ORDER BY distName ASC";
        $result = $this->db->select($query);
        return $result;
    }

    public function getBankAccount($data, $date){

        $userid = $this->fm->validation($data['userid']);
        $bank_name = $this->fm->validation($data['bank_name']);
        $branch_name = $this->fm->validation($data['branch_name']);
        $account = $this->fm->validation($data['account']);

        $userid = mysqli_real_escape_string($this->db->link, $userid);
        $bank_name = mysqli_real_escape_string($this->db->link, $bank_name);
        $branch_name = mysqli_real_escape_string($this->db->link, $branch_name);
        $account = mysqli_real_escape_string($this->db->link, $account);

        if (empty($userid) || empty($bank_name) || empty($branch_name) || empty($account)) {
            $errmsg = "<span style='color:red;font-size:20px;'>Fields Must not be Empty !!</span>";
            return $errmsg;

            } else {
                     
             $query = "INSERT INTO tbl_bankaccount(userId, bankid, branchId, account, currentDate) VALUES('$userid', '$bank_name', '$branch_name', '$account', '$date')";
             $result = $this->db->insert($query);
            
            $uresult="UPDATE tbl_allstaffs SET bank_info='1' WHERE userId='$userid'";
            $uresult = $this->db->update($uresult);
            
             if ($uresult) {
                $msg = "<span style='color:green;font-size:20px;'>Bank Account Inserted Successfully !!</span>";
                return $msg;
             }else{
                $msg = "<span style='color:red;font-size:20px;'>Bank Account Not Inserted</span>";
                return $msg;
             }
        }
    }
    public function getAllAccountData(){
      $query = "SELECT b.*, a.bankName, c.branch_name, u.userName FROM tbl_bankaccount as b, tbl_bankname as a,  tbl_branchaddress as c, tbl_user_reg as u WHERE b.bankid = a.bankName_id and b.userId = u.regId and b.branchId = c.branchAddress_id ORDER BY id DESC";
        
        $result = $this->db->select($query);
        return $result;
    }
    public function getBranchDataById($id){
        $query = "SELECT a.*, b.bankName, c.divName, d.distName, e.thName, f.postName FROM tbl_branchaddress as a, tbl_bankname as b, tbl_division as c, tbl_district as d, tbl_thana as e, tbl_post as f WHERE a.bank_name = b.bankName_id and a.division = c.divId and a.district = d.distId and a.thana = e.thId and a.post_office = f.postId and bank_name = '$id'";
        $result = $this->db->select($query);
        return $result;
    }
    public function getAllThana(){
        $query  = "SELECT * FROM tbl_thana ORDER BY thName ASC";
        $result = $this->db->select($query);
        return $result;
    }

    public function getAllPost(){
        $query  = "SELECT * FROM tbl_post ORDER BY postName ASC";
        $result = $this->db->select($query);
        return $result;
    }

public function branchCreate($data){

        $bank_name = $this->fm->validation($data['bank_name']);
        $branch_name = $this->fm->validation($data['branch_name']);
        $branch_email = $this->fm->validation($data['branch_email']);
        $flat = $this->fm->validation($data['flat']);
        $holding_no = $this->fm->validation($data['holding_no']);
        $building_name = $this->fm->validation($data['building_name']);
        $road_no = $this->fm->validation($data['road_no']);
        $area = $this->fm->validation($data['area']);
        $block_sector = $this->fm->validation($data['block_sector']);
        $division = $this->fm->validation($data['division']);
        $district = $this->fm->validation($data['district']);
        $thana = $this->fm->validation($data['thana']);
        $post_office = $this->fm->validation($data['post_office']);

        $bank_name = mysqli_real_escape_string($this->db->link, $bank_name);
        $branch_name = mysqli_real_escape_string($this->db->link, $branch_name);
        $branch_email = mysqli_real_escape_string($this->db->link, $branch_email);
        $flat = mysqli_real_escape_string($this->db->link, $flat);
        $holding_no = mysqli_real_escape_string($this->db->link, $holding_no);
        $building_name = mysqli_real_escape_string($this->db->link, $building_name);
        $road_no = mysqli_real_escape_string($this->db->link, $road_no);
        $area = mysqli_real_escape_string($this->db->link, $area);
        $block_sector = mysqli_real_escape_string($this->db->link, $block_sector);
        $division = mysqli_real_escape_string($this->db->link, $division);
        $district = mysqli_real_escape_string($this->db->link, $district);
        $thana = mysqli_real_escape_string($this->db->link, $thana);
        $post_office = mysqli_real_escape_string($this->db->link, $post_office);

        if (empty($bank_name) || empty($branch_name)) {
           $errmsg = "<span style='color:red;font-size:20px;'>Fields Must not be Empty !!</span>";
                 return $errmsg;

            } else {
                     
             $query = "INSERT INTO tbl_branchaddress(bank_name, branch_name, bankemail, flat, holding_no, building_no, road_no, area, block_sector, division, district, thana, post_office) VALUES('$bank_name', '$branch_name', '$branch_email', '$flat', '$holding_no', '$building_name', '$road_no', '$area', '$block_sector', '$division', '$district', '$thana', '$post_office')";
             $result = $this->db->insert($query);

             if ($result) {
                $msg = "<span style='color:green;font-size:20px;'>Branch Address Inserted Successfully !!</span>";
                return $msg;
             }else{
                $msg = "<span style='color:red;font-size:20px;'>Branch Address Not Inserted</span>";
                return $msg;
             }
        }
    }

    public function getAllBankData(){
        $query = "SELECT a.*, b.bankName, c.divName, d.distName, e.thName, f.postName FROM tbl_branchaddress as a, tbl_bankname as b, tbl_division as c, tbl_district as d, tbl_thana as e, tbl_post as f WHERE a.bank_name = b.bankName_id and a.division = c.divId and a.district = d.distId and a.thana = e.thId and a.post_office = f.postId ORDER BY branchAddress_id DESC";
        $result = $this->db->select($query);
        return $result;
    }
    public function deleteBranch($id){
        $query = "DELETE FROM tbl_branchaddress WHERE branchAddress_id = '$id'";
        $result = $this->db->delete($query);
        if ($result) {
            $msg = "<span style='color:green;font-size:20px;'>Branch Address Deleted Successfully !!</span>";
            return $msg;
        }else{
            $msg = "<span style='color:red;font-size:20px;'>Branch Address Not Deleted</span>";
            return $msg;
        }
    }

    public function getUserId(){
        $query  = "SELECT * FROM tbl_employee WHERE estat='0' AND active='1'";
        $result = $this->db->select($query);
        return $result;
    }


public function openBankAccount($data, $date, $time, $serverIP, $adminId){
        $userid = $this->fm->validation($data['userid']);
        $bank_name = $this->fm->validation($data['bank_name']);
        $branch_nameid = $this->fm->validation($data['branch_name']);
        $letterId = $this->fm->validation($data['letterId']);
        $stos = $this->fm->validation($data['stos']);
        
        $userid = mysqli_real_escape_string($this->db->link, $userid);
        $bank_name = mysqli_real_escape_string($this->db->link, $bank_name);
        $branch_name = mysqli_real_escape_string($this->db->link, $branch_nameid);
        $letterId = mysqli_real_escape_string($this->db->link, $letterId);
        $stos = mysqli_real_escape_string($this->db->link, $stos);

$Bquery = "SELECT * FROM tbl_branchaddress WHERE bank_name = '$bank_name' AND branchAddress_id = '$branch_nameid'";
$result = $this->db->select($Bquery);
if ($result) {
    while ($deta = $result->fetch_assoc()) {
        $bemail = $deta['bankemail'];
        $branch_name = $deta['branch_name'];
        $branchAddress_id = $deta['branchAddress_id'];
    }
}

$Cquery = "SELECT * FROM tbl_bankname WHERE bankName_id = '$bank_name'";
$results = $this->db->select($Cquery);
if ($results) {
    while ($detas = $results->fetch_assoc()) {
        $bankName = $detas['bankName'];
        $bankName_id = $detas['bankName_id'];
    }
}
$Equery = "SELECT * FROM employee WHERE userId = '$userid'";
$results = $this->db->select($Equery);
if ($results) {
    while ($detas = $results->fetch_assoc()) {
        $email = $detas['officeemail'];
        $user = $detas['user'];
    }
}

$Gquery = "SELECT * FROM tbl_employee WHERE userId = '$userid'";
$results = $this->db->select($Gquery);
if ($results) {
    while ($detas = $results->fetch_assoc()) {
        $designation = $detas['designation'];
    }
}

$datee = $this->fm->formDate($date);
        if (empty($userid) || empty($bank_name) || empty($branch_name)) {
            $errmsg = "<span style='color:red;font-size:20px;'>Fields Must not be Empty !!</span>";
            return $errmsg;

            } else {
                     
             $query = "INSERT INTO tbl_letter(userId, sto, bankId, branchId, currentDate, currentTime, letterId, adminId, serverIp) VALUES('$userid', '$stos', '$bank_name', '$branch_nameid', '$date', '$time', '$letterId', '$adminId', '$serverIP')";
             $result = $this->db->insert($query);

             if ($result) {
                $msg = "<span style='color:red;font-size:20px;'>Data Inserted</span>";
                return $msg;        
}else{
                $msg = "<span style='color:red;font-size:20px;'>Data Not Inserted</span>";
                return $msg;
             }
        }
    }

public function getbankref($uId, $lid, $date){
        $query  = "SELECT * FROM tbl_letter WHERE userId = '$uId' AND currentDate = '$date' AND letterId = '$lid'";
        $result = $this->db->select($query);
        return $result;
}

public function getaccinfo($uId){
        $query  = "SELECT * FROM employee WHERE userId = '$uId'";
        $result = $this->db->select($query);
        return $result;
}
public function getdesignation($uId){
        $query  = "SELECT * FROM tbl_employee WHERE userId = '$uId'";
        $result = $this->db->select($query);
        return $result;   
}

public function insertLetterTittle($data){
        $letter_tittle = $this->fm->validation($data['letter_tittle']);

        $letter_tittle = mysqli_real_escape_string($this->db->link, $letter_tittle);

        if (empty($letter_tittle)) {
            $errmsg = "<span class='alert alert-danger'>Field Must not be Empty !!</span>";
            return $errmsg;

            } else {
                     
             $query = "INSERT INTO tbl_letter_tittle(letterTittle) VALUES('$letter_tittle')";
             $result = $this->db->insert($query);

             if ($result) {
                $msg = "<span style='color:green;font-size:20px;'>Data Inserted Successfully..!!</span>";
                return $msg;
             }else{
                $msg = "<span style='color:red;font-size:20px;'>Data Not Inserted</span>";
                return $msg;
             }
        }
    }
    public function getLetterTittle(){
        $query  = "SELECT * FROM tbl_letter_tittle";
        $result = $this->db->select($query);
        return $result;
    }

    public function getLetterdetails(){
        $query  = "SELECT p.*, u.userName, b.bankName, d.branch_name, l.letterTittle FROM tbl_letter as p, tbl_bankname as b, tbl_branchaddress as d, tbl_user_reg as u, tbl_letter_tittle as l WHERE p.userId =u.regId AND p.bankId = b.bankName_id AND p.branchId = d.branchAddress_id AND p.letterId = l.id ORDER BY p.id DESC";
        $result = $this->db->select($query);
        return $result;        
    }
    
    public function insertBankName($data, $date){
        $bank_name = $this->fm->validation($data['bank_name']);
        $bank_url = $this->fm->validation($data['bank_url']);

        $bank_name = mysqli_real_escape_string($this->db->link, $bank_name);
        $bank_url = mysqli_real_escape_string($this->db->link, $bank_url);

        if (empty($bank_name)) {
            $errmsg = "<span class='alert alert-danger'>Field Must not be Empty !!</span>";
            return $errmsg;

            } else {
                     
             $query = "INSERT INTO tbl_bankname(bankName, bankUrl, createDate) VALUES('$bank_name', '$bank_url', '$date')";
             $result = $this->db->insert($query);

             if ($result) {
                $msg = "<span style='color:green;font-size:20px;'>Data Inserted Successfully..!!</span>";
                return $msg;
             }else{
                $msg = "<span style='color:red;font-size:20px;'>Data Not Inserted</span>";
                return $msg;
             }
        }
    }
public function getaccountno(){
    $query = "SELECT * FROM tbl_accountno ORDER BY id DESC";
    $squery = $this->db->select($query);
    return $squery;    
}
    
    public function setBankAccount($data, $date, $pk, $mo, $year, $serverIP){

      
        $bank_name = $this->fm->validation($data['bank_name']);
        $chq = $this->fm->validation($data['chq']);
        $branch_name = $this->fm->validation($data['branch_name']);
        $accno = $this->fm->validation($data['accno']);
        $type = $this->fm->validation($data['type']);

        
        $chq = mysqli_real_escape_string($this->db->link, $chq);
        $date = mysqli_real_escape_string($this->db->link, $date);
        $bank_name = mysqli_real_escape_string($this->db->link, $bank_name);
        $branch_name = mysqli_real_escape_string($this->db->link, $branch_name);
        $accno = mysqli_real_escape_string($this->db->link, $accno);
        $type = mysqli_real_escape_string($this->db->link, $type);
        

        if (empty($bank_name) || empty($branch_name) || empty($accno) || empty($type)) {
            $errmsg = "<span style='color:red;font-size:20px;'>Fields Must not be Empty !!</span>";
            return $errmsg;

            } else {
                     
             $query = "INSERT INTO tbl_salaryaccountno(hrref, mos, years, banknId, branchnId, accountId, chq, type, adate, ip) VALUES('$pk', '$mo', '$year', '$bank_name', '$branch_name', '$accno', '$chq', '$type', '$date', '$serverIP')";
             $result = $this->db->insert($query);

             if ($result) {
                $msg = "<span style='color:green;font-size:20px;'>Bank Account Inserted Successfully !!</span>";
                return $msg;
             }else{
                $msg = "<span style='color:red;font-size:20px;'>Bank Account Not Inserted</span>";
                return $msg;
             }
        }
    }     
    

 public function insertauthrform($data, $bankNamef, $bankId, $adminId, $date, $serverIP)
    {

        // $bnk_name = $this->fm->validation($data['bnk_name']);
        $bnk_brnch = $this->fm->validation($data['bnk_brnch']);
        $acc_name = $this->fm->validation($data['acc_name']);
        $acc_title = $this->fm->validation($data['acc_title']);
        $authr_name = $this->fm->validation($data['authr_name']);
        $leaves = $this->fm->validation($data['leaves']);


        $bankN = mysqli_real_escape_string($this->db->link, $bankNamef);
        $bnk_brnch = mysqli_real_escape_string($this->db->link, $bnk_brnch);
        $acc_name = mysqli_real_escape_string($this->db->link, $acc_name);
        $acc_title = mysqli_real_escape_string($this->db->link, $acc_title);
        $authr_name = mysqli_real_escape_string($this->db->link, $authr_name);
        $leaves = mysqli_real_escape_string($this->db->link, $leaves);

        $bquery = "SELECT * FROM tbl_branchaddress WHERE branchAddress_id='$bnk_brnch'";
        $results = $this->db->select($bquery);
        if($results){
            while($deta = $results->fetch_assoc()){
                $brncName = $deta['branch_name'];
                $divId = $deta['division'];
                $distId = $deta['district'];
                $postId = $deta['post_office'];
            }
        }
        $dquery = "SELECT * FROM tbl_district WHERE distId='$distId'";
        $resultsd = $this->db->select($dquery);
        if($resultsd){
            while($detad = $resultsd->fetch_assoc()){
                $divName = $detad['distName'];
            }
        }
        
        $pquery = "SELECT * FROM tbl_post WHERE postId='$postId'";
        $resultsp = $this->db->select($pquery);
        if($resultsp){
            while($detap = $resultsp->fetch_assoc()){
                $postCode = $detap['postCode'];
            }
        }


        if (empty($bnk_brnch) || empty($acc_name) || empty($acc_title) || empty($authr_name) || empty($leaves)) {
           $errmsg = "<span style='color:red;font-size:20px;'>Fields Must not be Empty !!</span>";
                 return $errmsg;

            } else {
                     
             $query = "INSERT INTO tbl_authr_chq(accno, acctitle, author, userId, cdate, bnk_name, bnk_branch, ip, cheq_leaves, bnkId, branchId, divname, postcode) VALUES('$acc_name', '$acc_title', '$authr_name', '$adminId', '$date', '$bankN', '$brncName', '$serverIP', '$leaves', '$bankId', '$bnk_brnch', '$divName', '$postCode')";
             $result = $this->db->insert($query);

             if ($result) {
                echo "<script> window.location='view_author'</script>";
             }else{
                $msg = "<span style='color:red;font-size:20px;'>Branch Address Not Inserted</span>";
                return $msg;
             }
        }

      
    }


    public function insertauthratmform($data, $banknamef, $bankId, $adminId, $date, $serverIP)
    {

        //$bnk_name = $this->fm->validation($data['bnk_name']);
        $bnk_brnch = $this->fm->validation($data['bnk_brnch']);
        $acc_name = $this->fm->validation($data['acc_name']);
        $acc_title = $this->fm->validation($data['acc_title']);
        $authr_name = $this->fm->validation($data['authr_name']);
       

        $bnkN = mysqli_real_escape_string($this->db->link, $banknamef);
        $bankId = mysqli_real_escape_string($this->db->link, $bankId);
        $bnk_brnch = mysqli_real_escape_string($this->db->link, $bnk_brnch);
        $acc_name = mysqli_real_escape_string($this->db->link, $acc_name);
        $acc_title = mysqli_real_escape_string($this->db->link, $acc_title);
        $authr_name = mysqli_real_escape_string($this->db->link, $authr_name);
        
        $bquery = "SELECT * FROM tbl_branchaddress WHERE branchAddress_id='$bnk_brnch'";
        $results = $this->db->select($bquery);
        if($results){
            while($deta = $results->fetch_assoc()){
                $brncName = $deta['branch_name'];
                $divId = $deta['division'];
                $distId = $deta['district'];
                $postId = $deta['post_office'];
            }
        }
        $dquery = "SELECT * FROM tbl_district WHERE distId='$distId'";
        $resultsd = $this->db->select($dquery);
        if($resultsd){
            while($detad = $resultsd->fetch_assoc()){
                $divName = $detad['distName'];
            }
        }
        
        $pquery = "SELECT * FROM tbl_post WHERE postId='$postId'";
        $resultsp = $this->db->select($pquery);
        if($resultsp){
            while($detap = $resultsp->fetch_assoc()){
                $postCode = $detap['postCode'];
            }
        }
        if (empty($bnk_brnch) || empty($acc_name) || empty($acc_title) || empty($authr_name)) {
           $errmsg = "<span style='color:red;font-size:20px;'>Fields Must not be Empty !!</span>";
                 return $errmsg;

            } else {
                     
             $query = "INSERT INTO tbl_authr_atm(accno, acctitle, author, userId, cdate, bank_name, bnk_branch, bankId, branchId, divname, postcode, ip) VALUES('$acc_name', '$acc_title', '$authr_name', '$adminId', '$date', '$bnkN', '$brncName', '$bankId', '$bnk_brnch', '$divName', '$postCode', '$serverIP')";
             $result = $this->db->insert($query);

             if ($result) {
              echo "<script> window.location='view_author?'</script>";
             }else{
                $msg = "<span style='color:red;font-size:20px;'>Branch Address Not Inserted</span>";
                return $msg;
             }
        }

      
    }

   
            public function getallauthorizedatm(){
            $query  = "SELECT * FROM tbl_authr_atm ORDER BY id DESC";
            $result = $this->db->select($query);
            return $result;
        }

   public function getatminfo($cid){
            $query  = "SELECT * FROM tbl_authr_atm WHERE id = '$cid'";
            $result = $this->db->select($query);
            return $result;
        }


          public function getallauthorizedchq(){
            $query  = "SELECT * FROM tbl_authr_chq ORDER BY id DESC";
            $result = $this->db->select($query);
            return $result;
        }



        public function getchqinfo($cid){
            $query  = "SELECT * FROM tbl_authr_chq WHERE id = '$cid'";
            $result = $this->db->select($query);
            return $result;
        }
    
    public function generateletter($data){
        $letterId = $this->fm->validation($data['letterId']);
        $userId = $this->fm->validation($data['userId']);
        $bankId = $this->fm->validation($data['bankId']);
        $branchId = $this->fm->validation($data['branchId']);
        $userName = $this->fm->validation($data['userName']);
        $bankName = $this->fm->validation($data['bankName']);
        $branchName = $this->fm->validation($data['branch_name']);
        $currentDate = $this->fm->validation($data['currentDate']);
        $id = $this->fm->validation($data['id']);

        $letterId = mysqli_real_escape_string($this->db->link, $letterId);
        $userId = mysqli_real_escape_string($this->db->link, $userId);
        $bankId = mysqli_real_escape_string($this->db->link, $bankId);
        $branchId = mysqli_real_escape_string($this->db->link, $branchId);
        $userName = mysqli_real_escape_string($this->db->link, $userName);
        $bankName = mysqli_real_escape_string($this->db->link, $bankName);
        $branchName = mysqli_real_escape_string($this->db->link, $branchName);
        $currentDate = mysqli_real_escape_string($this->db->link, $currentDate);
        $id = mysqli_real_escape_string($this->db->link, $id);

        $ref = "HRD/PeopleSoft/".$userId."/".$bankId."/".$branchId."/".$id;

        $updateletter = "UPDATE tbl_letter SET status='1' WHERE id='$id' AND userId='$userId' AND status='0'";
        $uresult = $this->db->update($updateletter);
       

        $insletter = "INSERT INTO tbl_letter_register(lId, ref, name, releaseDate, bankname, branchname) VALUES('$letterId', '$ref', '$userName', '$currentDate', '$bankName', '$branchName')";
        $insresult=$this->db->insert($insletter);
        if ($insresult) {
            echo "<script>window.location='createdLetter'</script>";
        }
    }


    public function registerletter($ref, $rId){
        $cref = $ref.$rId;
       $updateletter = "UPDATE tbl_letter_register SET completeref ='$cref' WHERE ref='$ref'";
        $uresult = $this->db->update($updateletter);  
    }
    public function getBankqrCode($bankId, $uId){
        $query  = "SELECT * FROM tbl_bankqr WHERE bankId = '$bankId' AND userId = '$uId'";
        $result = $this->db->select($query);
        return $result;
    }
    public function getBankOnlineQrCode($bankId, $uId){
        $query  = "SELECT * FROM tbl_bankqr_online WHERE bankId = '$bankId' AND userId = '$uId'";
        $result = $this->db->select($query);
        return $result;
    }
    public function getReferenece($ref, $lid){
        $query  = "SELECT * FROM tbl_letter_register WHERE ref = '$ref' AND lId = '$lid'";
        $result = $this->db->select($query);
        return $result;
    }
    
    public function sendalerts($user_id, $datef, $dateT){
        $user_id = $this->fm->validation($user_id);
        $user_id = mysqli_real_escape_string($this->db->link, $user_id);
        
        $query = "SELECT * FROM employee WHERE userId = '$user_id'";
        $qresult = $this->db->select($query);
        if($qresult){
           while($qdeta = $qresult->fetch_assoc()){
               $user = $qdeta['user'];
               $email = $qdeta['officeemail'];
               
           } 
        }
        
        $iquery = "INSERT INTO tbl_alertslog(userId, user, email) VALUES('$user_id', '$user', '$officeemail')";
        $ideta = $this->db->insert($iquery);
        if($ideta){
        			?>
        			<script>var my_time = new Date(); alert('Attendance Taken at '+my_time);
                                window.location = 'one';
                                </script>
        			<?php


							$headers = 'From: '.$email."\r\n".
							 
							'Reply-To: '.$email."\r\n" .
							 
							'X-Mailer: PHP/' . phpversion();

							$email_to = "hr@keal.com.bd";
							$email_subject= "Your Unauthorised Leave";
							$email_message= "
Dear $user
For last 3 days you have been on unauthorised leave for which you did not apply for any prior leave. Unfortunately, your supervisors cannot also give your whereabouts.
 
This is not unknown to you that unathorised leave is equal to 3 days of leave according to our leave policy.
 
By this letter, you are hereby advised to explain why punitive measure should not be taken against you for the unauthorised leave.
However, if the explanation is not satisfactory there may be disciplinary action against you.
";

							


							$headers1 = 'From: '.$email_to."\r\n".
							 
							'Reply-To: '.$email_to."\r\n" .
							 
							'X-Mailer: PHP/' . phpversion();

							$email_subject1= "$date Dailly Attendence";
							$email_message1= "
Dear $user
For last 3 days you have been on unauthorised leave for which you did not apply for any prior leave. Unfortunately, your supervisors cannot also give your whereabouts.
 
This is not unknown to you that unathorised leave is equal to 3 days of leave according to our leave policy.
 
By this letter, you are hereby advised to explain why punitive measure should not be taken against you for the unauthorised leave.
However, if the explanation is not satisfactory there may be disciplinary action against you.";

							 
							$email_message2= 'Date'.$date."\r\n";
							mail("<$email_to>","$email_subject","$email_message","$headers");

							mail("<$email>","$email_subject1","$email_message1","$headers1");            
        }
    }

}?>