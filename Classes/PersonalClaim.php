<?php
 //include_once "../lib/Session.php";
?>

<?php include_once "../lib/Database.php"; ?>
<?php include_once "../helpers/Format.php"; ?>


<?php
	
class PersonalClaim
	{
		private $db;
		private $fm;

		public function __construct()
	
		{
			$this->db = new Database();
			$this->fm = new Format();
		}
		public function preOfficeExpense($data, $userId){
			$staff_name = $this->fm->validation($data['staff_name']);
			$requisition_date = $this->fm->validation($data['requisition_date']);
			$requirement_date = $this->fm->validation($data['requirement_date']);

			$staff_name = mysqli_real_escape_string($this->db->link, $staff_name);
			$requisition_date = mysqli_real_escape_string($this->db->link, $requisition_date);
			$requirement_date = mysqli_real_escape_string($this->db->link, $requirement_date);
			if (empty($requisition_date) || empty($requirement_date)) {
				$errmsg = "<span style='color:red;font-size:20px;'>Fields Must not be Empty !!</span>";
            	return $errmsg;
			}else{
				$query = "INSERT INTO tbl_fund_requisition(userId, userName, requisition_date, requirement_date) VALUES('$userId', '$staff_name', '$requisition_date', '$requirement_date')";
				$result = $this->db->insert($query);
				if ($result) {
					
		           echo "<script>window.location = 'fund_requision?rd=$requisition_date & red=$requirement_date';</script>";
		          
				}else{
					$errmsg = "<span style='color:red;font-size:20px;'>Data Not Inserted !!</span>";
            		return $errmsg;
				}
			}
		}	

public function getalldataby($userId, $rd, $red){
	    $dquery = "SELECT * FROM tbl_fund_requisition WHERE userId = '$userId' AND requisition_date ='$rd' AND requirement_date = '$red'";
        $result = $this->db->select($dquery);
        return $result;  
}		
public function insertRequisitionData($data, $userId, $sfid, $rd, $red){
	$staff_name = $this->fm->validation($data['staff_name']);
	$purpose = $this->fm->validation($data['purpose']);
	$request_ammount = $this->fm->validation($data['request_ammount']);

	$staff_name = mysqli_real_escape_string($this->db->link, $staff_name);
	$sfid = mysqli_real_escape_string($this->db->link, $sfid);
	$purpose = mysqli_real_escape_string($this->db->link, $purpose);
	$request_ammount = mysqli_real_escape_string($this->db->link, $request_ammount);
	if (empty($purpose) || empty($request_ammount)) {
		$errmsg = "<span style='color:red;font-size:20px;'>Fields Must not be Empty !!</span>";
    	return $errmsg;
	}else{
		$query = "INSERT INTO tbl_fund_requisitiontwo(fid, userId, userName, requisition_date, requirement_date, purpose, ammount) VALUES('$sfid', '$userId', '$staff_name', '$rd', '$red', '$purpose', '$request_ammount')";
		$result = $this->db->insert($query);
		if ($result) {
			
           echo "<script>window.location = 'fund_requision?rd=$rd & red=$red';</script>";
          
		}else{
			$errmsg = "<span style='color:red;font-size:20px;'>Data Not Inserted !!</span>";
    		return $errmsg;
		}
	}
}
 public function getAlldatafromsteptwo($arid){
  	$query = "SELECT * FROM tbl_fund_requisitiontwo WHERE fid ='$arid'";
 	$result = $this->db->select($query);
 	return $result;	
 }
 public function getAlldatafromtwo($claimid, $pkid){
  	$query = "SELECT * FROM tbl_fund_requisitiontwo WHERE fid ='$claimid' AND id = '$pkid'";
 	$result = $this->db->select($query);
 	return $result;	
 }
 public function insertRequisitionEndData($data, $userId, $sfid, $rd, $red){
 	$staff_name = $this->fm->validation($data['staff_name']);
	$purpose = $this->fm->validation($data['purpose']);
	$request_ammount = $this->fm->validation($data['request_ammount']);

	$staff_name = mysqli_real_escape_string($this->db->link, $staff_name);
	$sfid = mysqli_real_escape_string($this->db->link, $sfid);
	$purpose = mysqli_real_escape_string($this->db->link, $purpose);
	$request_ammount = mysqli_real_escape_string($this->db->link, $request_ammount);
	if (empty($purpose) || empty($request_ammount)) {
		$errmsg = "<span style='color:red;font-size:20px;'>Fields Must not be Empty !!</span>";
    	return $errmsg;
	}else{
		$query = "INSERT INTO tbl_fund_requisitiontwo(fid, userId, userName, requisition_date, requirement_date, purpose, ammount) VALUES('$sfid', '$userId', '$staff_name', '$rd', '$red', '$purpose', '$request_ammount')";
		$result = $this->db->insert($query);
		if ($result) {
			
           echo "<script>window.location = 'personal_claim';</script>";
          
		}else{
			$errmsg = "<span style='color:red;font-size:20px;'>Data Not Inserted !!</span>";
    		return $errmsg;
		}
	}
 }
 public function getFundRequisitionDataByUserId($userId){
 	$query = "SELECT * FROM tbl_fund_requisition WHERE userId ='$userId'";
 	$result = $this->db->select($query);
 	return $result;
 }
 public function getUserDetailsDataById($rid){
 	$query = "SELECT * FROM tbl_fund_requisitiontwo WHERE fid ='$rid'";
 	$result = $this->db->select($query);
 	return $result;
 }
 public function getFundRequisitionData(){
 	$query = "SELECT * FROM tbl_fund_requisition";
 	$result = $this->db->select($query);
 	return $result;
 }
 public function updateApproveData($data, $claimid, $pkid, $user){
 	$approve_ammount = $this->fm->validation($data['approve_ammount']);
 	$approve_ammount = mysqli_real_escape_string($this->db->link, $approve_ammount);
 	if (empty($approve_ammount)) {
 		$errmsg = "<span style='color:red;font-size:20px;'>Field Must not be Empty !!</span>";
    	return $errmsg;
 	}else{
 		$query = "UPDATE tbl_fund_requisitiontwo SET approve_ammount = '$approve_ammount' WHERE fid = '$claimid' AND id = '$pkid'";
 		$result = $this->db->update($query);
 		if ($result) {
 			echo "<script>window.location = 'office_expense';</script>";
 		}else{
			$errmsg = "<span style='color:red;font-size:20px;'>Data Not Inserted !!</span>";
    		return $errmsg;
		}
 	}
 }

public function preConveyance($data, $empId, $date){
 	$conveyance_no = $this->fm->validation($data['conveyance_no']);
 	$emp_name = $this->fm->validation($data['emp_name']);
	$designation = $this->fm->validation($data['designation']);
	$department = $this->fm->validation($data['department']);
	$place_of_duty = $this->fm->validation($data['place_of_duty']);
	$supervisor_name = $this->fm->validation($data['supervisor_name']);
	$empId = $this->fm->validation($data['empId']);

	$conveyance_no = mysqli_real_escape_string($this->db->link, $conveyance_no);
	$emp_name = mysqli_real_escape_string($this->db->link, $emp_name);
	$designation = mysqli_real_escape_string($this->db->link, $designation);
	$department = mysqli_real_escape_string($this->db->link, $department);
	$place_of_duty = mysqli_real_escape_string($this->db->link, $place_of_duty);
	$supervisor_name = mysqli_real_escape_string($this->db->link, $supervisor_name);
	$usersId = mysqli_real_escape_string($this->db->link, $empId);
	if (empty($place_of_duty)) {
		$errmsg = "<span style='color:red;font-size:20px;'>Field Must not be Empty !!</span>";
    	return $errmsg;
	}else{
		$query = "INSERT INTO tbl_convenceone(userId, conveyance_no, username, placeOfDuty, designation, supervisorName, department, cDate) VALUES('$usersId', '$conveyance_no', '$emp_name', '$place_of_duty', '$designation', '$supervisor_name', '$department', '$date')";
		$result = $this->db->insert($query);
		if ($result) {
			
           echo "<script>window.location = 'conveyance?userId=$usersId & userName=$emp_name & conv_no=$conveyance_no';</script>";
          
		}else{
			$errmsg = "<span style='color:red;font-size:20px;'>Data Not Inserted !!</span>";
    		return $errmsg;
		}
	}
 }


 public function getConveyance($userId){
	$dquery = "SELECT * FROM tbl_convenceone WHERE userId = '$userId'";
    $result = $this->db->select($dquery);
    return $result; 
 }
 public function insertConveyanceData($data, $usrId, $scid, $userName, $conv_no){
	$con_date = $this->fm->validation($data['con_date']);
	$from = $this->fm->validation($data['from']);
	$to = $this->fm->validation($data['to']);
	$purpose_of_journey = $this->fm->validation($data['purpose_of_journey']);
	$transport_mode = $this->fm->validation($data['transport_mode']);
	$amount_claim = $this->fm->validation($data['amount_claim']);

	$con_date = mysqli_real_escape_string($this->db->link, $con_date);
	$from = mysqli_real_escape_string($this->db->link, $from);
	$to = mysqli_real_escape_string($this->db->link, $to);
	$transport_mode = mysqli_real_escape_string($this->db->link, $transport_mode);
	$purpose_of_journey = mysqli_real_escape_string($this->db->link, $purpose_of_journey);
	$amount_claim = mysqli_real_escape_string($this->db->link, $amount_claim);
	if (empty($con_date) || empty($from) || empty($to) || empty($purpose_of_journey) || empty($transport_mode) || empty($amount_claim)) {
		$errmsg = "<span style='color:red;font-size:20px;'>Fields Must not be Empty !!</span>";
    	return $errmsg;
	}else{
		$query = "INSERT INTO tbl_conveyance_bill(cid, serial_no, emp_name, emp_id, date_one, from_one, to_one, purpose_one, transport_mode_one, ammount_one) VALUES('$scid', '$conv_no', '$userName', '$usrId', '$con_date', '$from', '$to', '$purpose_of_journey', '$transport_mode', '$amount_claim')";
		$result = $this->db->insert($query);
		if ($result) {
			
           echo "<script>window.location = 'conveyance?userId=$usrId&userName=$userName&conv_no=$conv_no';</script>";
          
		}else{
			$errmsg = "<span style='color:red;font-size:20px;'>Data Not Inserted !!</span>";
    		return $errmsg;
		}
	}
 }
 public function getDepartment(){
 	$query = "SELECT * FROM tbl_department";
 	$result = $this->db->select($query);
 	return $result;
 }
 public function getSupervisor(){
 	$query = "SELECT * FROM tbl_employee";
 	$result = $this->db->select($query);
 	return $result;
 }
 public function getAllConeyanceData($usrId){
 	$query = "SELECT a.*, b.deptName, c.user FROM tbl_convenceone AS a, tbl_department AS b, tbl_employee AS c WHERE a.department = b.dId AND a.supervisorName = c.userId AND a.userId = '$usrId'";
 	$result = $this->db->select($query);
 	return $result;
 }
 public function insertConveyanceEndData($data, $usrId, $scid, $userName){
 	$con_date = $this->fm->validation($data['con_date']);
	$from = $this->fm->validation($data['from']);
	$to = $this->fm->validation($data['to']);
	$purpose_of_journey = $this->fm->validation($data['purpose_of_journey']);
	$transport_mode = $this->fm->validation($data['transport_mode']);
	$amount_claim = $this->fm->validation($data['amount_claim']);

	$con_date = mysqli_real_escape_string($this->db->link, $con_date);
	$from = mysqli_real_escape_string($this->db->link, $from);
	$to = mysqli_real_escape_string($this->db->link, $to);
	$transport_mode = mysqli_real_escape_string($this->db->link, $transport_mode);
	$purpose_of_journey = mysqli_real_escape_string($this->db->link, $purpose_of_journey);
	$amount_claim = mysqli_real_escape_string($this->db->link, $amount_claim);
	if (empty($con_date) || empty($from) || empty($to) || empty($purpose_of_journey) || empty($transport_mode) || empty($amount_claim)) {
		$errmsg = "<span style='color:red;font-size:20px;'>Fields Must not be Empty !!</span>";
    	return $errmsg;
	}else{
		$query = "INSERT INTO tbl_conveyance_bill(cid, emp_name, emp_id, date_one, from_one, to_one, purpose_one, transport_mode_one, ammount_one) VALUES('$scid', '$userName', '$usrId', '$con_date', '$from', '$to', '$purpose_of_journey', '$transport_mode', '$amount_claim')";
		$result = $this->db->insert($query);
		if ($result) {
			
           echo "<script>window.location = 'personal_claim';</script>";
          
		}else{
			$errmsg = "<span style='color:red;font-size:20px;'>Data Not Inserted !!</span>";
    		return $errmsg;
		}
	}
 }
 public function getConveyanceDataByUserId($userId){
 	$query = "SELECT * FROM tbl_convenceone WHERE userId ='$userId'";
 	$result = $this->db->select($query);
 	return $result;
 }
 public function getAlldatafromConveyanceBill($conid){
 	$query = "SELECT * FROM tbl_conveyance_bill WHERE cid ='$conid'";
 	$result = $this->db->select($query);
 	return $result;
 }
 public function getConveyanceDataforAdmin(){
 	$query = "SELECT * FROM tbl_convenceone ORDER BY id DESC";
 	$result = $this->db->select($query);
 	return $result;
 }
 public function getAllConveyanceDataForAdmin($acid){
 	$query = "SELECT * FROM tbl_conveyance_bill WHERE cid = '$acid'";
 	$result = $this->db->select($query);
 	return $result;
 }
 public function getAllConveyanceDataForApprove($id){
 	$query = "SELECT * FROM tbl_conveyance_bill WHERE id = '$id'";
 	$result = $this->db->select($query);
 	return $result;
 }
//  public function updateConveyanceData($data, $id, $pcid, $cld, $pld, $user, $adminName){
//  	$approve_ammount = $this->fm->validation($data['approve_ammount']);
//  	if (empty($approve_ammount)) {
//  		$msg = "<span style='color:red;font-size:20px;'>Field Must Not Be Empty !!</span>";
//     	return $msg;
//  	}else{
//  		$query = "UPDATE tbl_conveyance_bill SET approve_ammount = '$approve_ammount', approve_by = '$adminName', approve_status = '1' WHERE id = '$id'";
//  		$result = $this->db->insert($query);
//  		if ($result) {
//  			echo "<script>window.location = 'newview?acid=$pcid&cd=$cld&pld=$pld&user=$user';</script>";
//  		}
//  	}
 	

//  }
 public function updateConveyanceData($data, $uId, $id, $pcid, $cld, $pld, $user, $adminName){
 	$approve_ammount = $this->fm->validation($data['approve_ammount']);
 	if (empty($approve_ammount)) {
 		$msg = "<span style='color:red;font-size:20px;'>Field Must Not Be Empty !!</span>";
    	return $msg;
 	}else{
 		$query = "UPDATE tbl_conveyance_bill SET approve_ammount = '$approve_ammount', approve_by = '$adminName', approve_status = '1' WHERE id = '$id'";
 		$result = $this->db->insert($query);
 		if ($result) {
 			echo "<script>window.location = 'newview?uId=$uId&acid=$pcid&cd=$cld&pld=$pld&user=$user';</script>";
 		}
 	}
 }
 public function getApprovedBy($acid){
 	$query = "SELECT * FROM tbl_conveyance_bill WHERE cid = '$acid'";
 	$result = $this->db->select($query);
 	return $result;
 }


///new

 public function markreview($data, $uId, $adminId, $serverIP, $date, $time){
 	$acid = $this->fm->validation($data['acid']);
 	$cd = $this->fm->validation($data['cd']);
 	$pld = $this->fm->validation($data['pld']);
 	$user = $this->fm->validation($data['user']);
 	$sum = $this->fm->validation($data['sum']);
 	$sums = $this->fm->validation($data['sums']);
 	$userId = $this->fm->validation($data['userId']);
 	$rn = $this->fm->validation($data['rn']);

 	$acid = mysqli_real_escape_string($this->db->link, $acid);
 	$cd = mysqli_real_escape_string($this->db->link, $cd);
 	$pld = mysqli_real_escape_string($this->db->link, $pld);
 	$user = mysqli_real_escape_string($this->db->link, $user);
 	$sum = mysqli_real_escape_string($this->db->link, $sum);
 	$sums = mysqli_real_escape_string($this->db->link, $sums);
 	$userId = mysqli_real_escape_string($this->db->link, $userId);
 	$rn = mysqli_real_escape_string($this->db->link, $rn);
 	
 	$cquery = "UPDATE tbl_convenceone SET review='1' WHERE review='0' AND userId='$userId' AND id='$acid'";
 	$cresult = $this->db->update($cquery);

    if($sums =="0"){
        $msg ="<span style='color:red;'>Please approve amount first!!</span>";
        return $msg;
    }else{
//calculation for total sum
 	$squery = "SELECT * FROM tbl_conveyancesheet WHERE userId='$uId' AND batch='0'";
 	$sresult = $this->db->select($squery);
 	if ($sresult) {
 		while ($sdeta = $sresult->fetch_assoc()) {
 			$amm=$sdeta['ammount'];
 			$tamm = $sums+$amm;
 		}
 	$cquery = "UPDATE tbl_conveyancesheet SET ammount='$tamm' WHERE batch='0' AND userId='$uId'";
 	$cresult = $this->db->update($cquery);
 	}else{
 	$iquery = "INSERT INTO tbl_conveyancesheet(userId, userName, rquestdate,  	ammount, batch, status, ddate, adminId, ip) VALUES('$uId', '$user', '$cd', '$sums', '$bId', '1', '$date', '$adminId', '$serverIP')";
 	 $iresult = $this->db->insert($iquery);	
 	}
//calculation for total sum

    $iquery = "INSERT INTO tbl_claimsummary(userId, username, acid, formnumber, reqDate, totalammount, trqammount, approveby, adate, atime, ip, status) VALUES('$uId', '$user', '$acid', '$rn', '$cd', '$sums', '$sum', '$adminId', '$date', '$time', '$serverIP', '1')";
  $Iresult = $this->db->update($iquery);

 	$uquery = "UPDATE tbl_convenceone SET review='1', statusone='1' WHERE id='$acid' AND cDate='$cd' AND placeOfDuty ='$pld' AND username='$user' AND userId='$uId'";
 	$uresult = $this->db->update($uquery);
 	if ($uresult) {
 		echo "<script>window.location='newrequest'</script>";
 	}else{
 		$msg = "<span style='color:green;'>Review Not Marked</span>";
 		return $msg; 		
 	}
 }

}



 public function getConveyanceDataforAdminbyreview(){
 	$query = "SELECT * FROM tbl_convenceone WHERE review='1' AND statusone='0' ORDER BY id DESC";
 	$result = $this->db->select($query);
 	return $result;
 }

 public function addbatchby($data){
 	$acid = $this->fm->validation($data['acid']);
 	$cd = $this->fm->validation($data['cd']);
 	$pld = $this->fm->validation($data['pld']);
 	$user = $this->fm->validation($data['user']);
 	$userId = $this->fm->validation($data['userId']);
 	$batch = $this->fm->validation($data['batch']);

 	$acid = mysqli_real_escape_string($this->db->link, $acid);
 	$cd = mysqli_real_escape_string($this->db->link, $cd);
 	$pld = mysqli_real_escape_string($this->db->link, $pld);
 	$user = mysqli_real_escape_string($this->db->link, $user);
 	$userId = mysqli_real_escape_string($this->db->link, $userId);
 	$batch = mysqli_real_escape_string($this->db->link, $batch);

 	$ucquery = "UPDATE tbl_claimsummary SET batch='$batch' WHERE userId='$userId' AND reqDate='$cd' AND batch='0'";
 	$uresult = $this->db->update($ucquery);

 	$uquery = "UPDATE tbl_convenceone SET statusone='1' WHERE id='$acid' AND cDate='$cd' AND placeOfDuty ='$pld' AND username='$user'";
 	$uresult = $this->db->update($uquery);
 	if ($uresult) {
 		$msg = "<span style='color:green;'>Review Marked</span>";
 		return $msg;
 	}else{
 		$msg = "<span style='color:green;'>Review Not Marked</span>";
 		return $msg; 		
 	}
 }
 public function getConveyanceDataforAdminbyreviewwith(){
 	$query = "SELECT * FROM tbl_convenceone WHERE review='1' AND statusone='1' ORDER BY id DESC";
 	$result = $this->db->select($query);
 	return $result;
 }

 public function removedataby($pk, $cdda, $pldd, $users){
 	$uquery = "UPDATE tbl_convenceone SET statusone='0' WHERE id='$pk' AND cDate='$cdda' AND placeOfDuty ='$pldd' AND username='$users'";
 	$uresult = $this->db->update($uquery);
 	if ($uresult) {
 		$msg = "<span style='color:green;'>Review Marked</span>";
 		return $msg;
 	}else{
 		$msg = "<span style='color:green;'>Review Not Marked</span>";
 		return $msg; 		
 	}
 }

 public function getbatch(){
 	$query = "SELECT * FROM tbl_batch";
 	$result = $this->db->select($query);
 	return $result;
 }

 public function addbatchtogroupby($data, $date, $adminId, $time, $serverIP){
 	$acid = $this->fm->validation($data['acid']);
 	$cd = $this->fm->validation($data['cd']);
 	$pld = $this->fm->validation($data['pld']);
 	$user = $this->fm->validation($data['user']);
 	$batch = $this->fm->validation($data['batchn']);

 	$acid = mysqli_real_escape_string($this->db->link, $acid);
 	$cd = mysqli_real_escape_string($this->db->link, $cd);
 	$pld = mysqli_real_escape_string($this->db->link, $pld);
 	$user = mysqli_real_escape_string($this->db->link, $user);
 	$batch = mysqli_real_escape_string($this->db->link, $batch);

 	$iquery = "INSERT INTO tbl_batchlist(batchno, bdate, btime, adminId, ip) VALUES('$batch', '$date', '$time', '$adminId', '$serverIP')";
 	$iresult = $this->db->insert($iquery);

	
	$query = "UPDATE tbl_batch SET batch_number='$batch'";
	$result = $this->db->update($query);


 	$uquery = "UPDATE tbl_convenceone SET statusone='2', batch='$batch' WHERE statusone='1'";
 	$uresult = $this->db->update($uquery);
 	if ($uresult) {
 		$msg = "<span style='color:green;'>Group Created</span>";
 		return $msg;
 	}else{
 		$msg = "<span style='color:green;'>Review Not Marked</span>";
 		return $msg; 		
 	}
 }

 public function getbankinfo($userId){
  	$query = "SELECT * FROM tbl_bankaccount WHERE userId='$userId'";
 	$result = $this->db->select($query);
 	return $result;	
 }
 public function getAllbatch(){
   	$query = "SELECT * FROM tbl_batchlist ORDER BY batchno ASC";
 	$result = $this->db->select($query);
 	return $result;	
 }

 public function getConveyanceDataforAdminbybatch($bId){
  	$query = "SELECT * FROM tbl_convenceone WHERE batch='$bId' AND statusone='2'";
 	$result = $this->db->select($query);
 	return $result;	
 }

 public function getammount($userId, $bId){
    $query = "SELECT * FROM tbl_claimsummary WHERE userId='$userId' AND batch='$bId'";
 	$result = $this->db->select($query);
 	return $result;		
 }

 public function addbatchunique($uId, $id, $bId, $cd, $user, $sums, $serverIP, $time, $date, $adminId){
 	$bId = mysqli_real_escape_string($this->db->link, $bId);
 	$serverIP = mysqli_real_escape_string($this->db->link, $serverIP);
 	$time = mysqli_real_escape_string($this->db->link, $time);
 	$date = mysqli_real_escape_string($this->db->link, $date);
 	//$years = mysqli_real_escape_string($this->db->link, $years);

 	$cquery = "UPDATE tbl_claimsummary SET batch='$bId', disverse='1' WHERE disverse='0' AND batch='$bId' AND userId='$uId' AND acid='$id'";
 	$cresult = $this->db->update($cquery);

 	$squery = "SELECT * FROM tbl_conveyancesheet WHERE userId='$uId' AND batch='$bId'";
 	$sresult = $this->db->select($squery);
 	if ($sresult) {
 		while ($sdeta = $sresult->fetch_assoc()) {
 			$amm=$sdeta['ammount'];
 			$tamm = $sums+$amm;
 		}
 	$cquery = "UPDATE tbl_conveyancesheet SET ammount='$tamm' WHERE batch='$bId' AND userId='$uId'";
 	$cresult = $this->db->update($cquery);
 	}else{
 	$iquery = "INSERT INTO tbl_conveyancesheet(userId, userName, rquestdate,  	ammount, batch, status, ddate, adminId, ip) VALUES('$uId', '$user', '$cd', '$sums', '$bId', '1', '$date', '$adminId', '$serverIP')";
 	 $iresult = $this->db->insert($iquery);	
 	}


 	$iquery = "INSERT INTO tbl_disverserecord(batch, ddate, dtime, adminId, ip) VALUES('$bId', '$date', '$time', '$adminId', '$serverIP')";
 	$iresult = $this->db->insert($iquery);
 	if ($iresult) {
 		//echo "<script>window.location='paygate?bId=$bId'</script>";
 		$msg = "Successfully Disversed"."&nbsp;".$user;
 		return $msg;
 	}else{
 		$msg = "Not Successfully Disversed";
 		return $msg;
 	}
 }

 public function getuserdetais($userId){
    $query = "SELECT * FROM tbl_employee WHERE userId='$userId'";
 	$result = $this->db->select($query);
 	return $result;	
 }
 public function getusersgrade($ugrade){
    
$squery = "SELECT * FROM tbl_egrade WHERE si = '$ugrade'";
 
$result = $this->db->select($squery);
    return $result;   
}

public function getyearby($bId){
	$query = "SELECT * FROM tbl_disverserecord WHERE batch='$bId'";
	$bquery = $this->db->select($query);
	return $bquery;
}

public function getusers($bId){
	$query = "SELECT * FROM tbl_conveyancesheet WHERE batch='$bId'";
	$bquery = $this->db->select($query);
	return $bquery;	
}
public function getusersaccountnumber($user){
    $aquery = "SELECT * FROM tbl_bankaccount WHERE userId='$user'";
    $result = $this->db->select($aquery);
    return $result;    
}

public function getyearidby($ddate){
    $aquery = "SELECT * FROM tbl_year WHERE year='$ddate'";
    $result = $this->db->select($aquery);
    return $result; 	
}
public function getmonthidby($ddateM){
    $aquery = "SELECT * FROM tbl_month WHERE month='$ddateM'";
    $result = $this->db->select($aquery);
    return $result; 	
}

public function getactiveemployee(){
    $aquery = "SELECT * FROM tbl_employee WHERE estat='0'";
    $result = $this->db->select($aquery);
    return $result; 	
}

public function getgradeby($grade){
    $aquery = "SELECT * FROM tbl_egrade WHERE si='$grade'";
    $result = $this->db->select($aquery);
    return $result; 	
}

public function getuserswithoutbank(){
	$query = "SELECT * FROM tbl_allstaffs WHERE bank_info='0' AND estat='0'";
	$bquery = $this->db->select($query);
	return $bquery;	
}

public function getalluserswithoutbankfrom($userId, $bId){
	$query = "SELECT * FROM tbl_conveyancesheet WHERE userId='$userId' AND batch='$bId'";
	$bquery = $this->db->select($query);
	return $bquery;		
}

public function getuserswithoutaccountnumber($user){
	$query = "SELECT * FROM tbl_allstaffs WHERE bank_info='0' AND estat='0' AND userId='$user'";
	$bquery = $this->db->select($query);
	return $bquery;	
}

// public function getConveyanceoneData(){
// 	$query = "SELECT * FROM tbl_conveyancesheet WHERE userId='$userId' AND batch='$bId'";
// 	$bquery = $this->db->select($query);
// 	return $bquery;		
// }

public function getConveyanceDataforAdminfromsheet($uId){
 	$query = "SELECT * FROM tbl_conveyancesheet WHERE statusonee='0' AND userId='$uId' ORDER BY id DESC";
 	$result = $this->db->select($query);
 	return $result;
}

 public function addbatchfromsheetby($data, $gId){
 	$id = $this->fm->validation($data['id']);
 	$cd = $this->fm->validation($data['cd']);
 	// $pld = $this->fm->validation($data['pld']);
 	$user = $this->fm->validation($data['user']);
 	$userId = $this->fm->validation($data['userId']);
 	// $batch = $this->fm->validation($data['batch']);

 	$id = mysqli_real_escape_string($this->db->link, $id);
 	$cd = mysqli_real_escape_string($this->db->link, $cd);
 	// $pld = mysqli_real_escape_string($this->db->link, $pld);
 	$user = mysqli_real_escape_string($this->db->link, $user);
 	$userId = mysqli_real_escape_string($this->db->link, $userId);
 	// $batch = mysqli_real_escape_string($this->db->link, $batch);

 	// $ucquery = "UPDATE tbl_claimsummary SET batch='0' WHERE userId='$userId' AND reqDate='$cd' AND batch='0'";
 	// $uresult = $this->db->update($ucquery);
	 $uquery = "UPDATE tbl_convenceone SET statusone='1' WHERE statusone='0' AND review='1' AND userId='$userId'";
	 $uone = $this->db->update($uquery);

 	$uquery = "UPDATE tbl_conveyancesheet 
 	SET 
 	statusonee='1', 
 	groups='$gId' 
 	WHERE id='$id' AND statusonee='0' AND userId='$userId'";
 	$uresult = $this->db->update($uquery);
 	if ($uresult) {
 		$msg = "<span style='color:green;'>Review Marked</span>";
 		return $msg;
 	}else{
 		$msg = "<span style='color:green;'>Review Not Marked</span>";
 		return $msg; 		
 	}
 }

 public function getConveyanceDatafromsheet(){
  	$query = "SELECT * FROM tbl_conveyancesheet WHERE statusonee='1' ORDER BY id DESC";
 	$result = $this->db->select($query);
 	return $result;	
 }

  public function removedatabyfor($pk, $uid){
 	$uquerys = "UPDATE tbl_convenceone SET statusone='0' WHERE review='1' AND statusone='1' AND userId='$uid'";
 	$uresults = $this->db->update($uquerys);


 	$uquery = "UPDATE tbl_conveyancesheet SET statusonee='0', groups='0' WHERE id='$pk'";
 	$uresult = $this->db->update($uquery);
 	if ($uresult) {
 		 $msg = "<span style='color:green;'>Review Marked</span>";
 		 return $msg;
 		//echo "<script>window.location='batch'</script>";
 	}else{
 		$msg = "<span style='color:green;'>Review Not Marked</span>";
 		return $msg; 		
 	}
 }

  public function addbatchtogroupbysheet($data, $date, $time, $adminId, $serverIP){
 	// $id = $this->fm->validation($data['id']);
 	// $cd = $this->fm->validation($data['cd']);
 	// $user = $this->fm->validation($data['user']);
 	// $userId = $this->fm->validation($data['userId']);
 	 $batch = $this->fm->validation($data['batchn']);
 	 $group = $this->fm->validation($data['group']);

 	// $id = mysqli_real_escape_string($this->db->link, $id);
 	// $cd = mysqli_real_escape_string($this->db->link, $cd);
 	// $user = mysqli_real_escape_string($this->db->link, $user);
 	// $userId = mysqli_real_escape_string($this->db->link, $userId);
 	$batch = mysqli_real_escape_string($this->db->link, $batch);

 	$iquery = "INSERT INTO tbl_batchlist(batchno, bdate, btime, adminId, ip) VALUES('$batch', '$date', '$time', '$adminId', '$serverIP')";
 	$iresult = $this->db->insert($iquery);

	
	$query = "UPDATE tbl_batch SET batch_number='$batch'";
	$result = $this->db->update($query);


 	$uquery = "UPDATE tbl_convenceone SET statusone='2', batch='$batch' WHERE statusone='1'";
 	$uresult = $this->db->update($uquery);

 	$uqueryc = "UPDATE tbl_conveyancesheet SET statusonee='2', batch='$batch' WHERE statusonee='1' AND batch='0'";
 	$uresultc = $this->db->update($uqueryc);

 	if ($uresultc) {
 		// $msg = "<span style='color:green;'>Group Created</span>";
 		// return $msg;
 		echo "<script>window.location='batch?success=1'</script>";
 	}else{
 		$msg = "<span style='color:green;'>Review Not Marked</span>";
 		return $msg; 		
 	}
 }

 public function getdatafordisverseby($uId, $bId){
   	$query = "SELECT * FROM tbl_conveyancesheet WHERE statusonee='2' AND batch='$bId' AND userId='$uId'";
 	$result = $this->db->select($query);
 	return $result;		
 }

 public function getbankuserswith($gId){
 	if ($gId=="1") {
   	$query = "SELECT * FROM tbl_allstaffs WHERE bank_info='1'";
 	$result = $this->db->select($query);
 	return $result;
 	}elseif ($gId=="0") {
   	$query = "SELECT * FROM tbl_allstaffs WHERE bank_info='0'";
 	$result = $this->db->select($query);
 	return $result;
 	}	
 }

 public function addbatchdisverse($uId, $gId, $id, $bId, $time, $date, $adminId){
 $uqueryc = "UPDATE tbl_batchlist SET grps ='$gId' WHERE batchno ='$bId'";
 	$uresultc = $this->db->update($uqueryc);	

 	$uquerycs = "UPDATE tbl_convenceone SET disverse ='1' WHERE batch ='$bId'";
 	$uresultcs = $this->db->update($uquerycs);	


 	$dquery = "UPDATE tbl_conveyancesheet 
 	SET
 	disverse ='1',
 	ddate = '$date',
 	adminId = '$adminId'
 	WHERE groups='$gId' AND batch='$bId' AND disverse='0'";
 	$dresult = $this->db->update($dquery);
 	if ($dresult) {
 	$errmsg = "<div class='alert alert-success' role='alert'>Successfuly Disversed</div>";
    return $errmsg; 
 }else{
 	$errmsg = "<div class='alert alert-danger' role='alert'>Not Disversed</div>";
    return $errmsg;
 }
 }

 public function getdatafordisverseinfo($bId){
    $query = "SELECT * FROM tbl_conveyancesheet WHERE statusonee='2' AND batch='$bId'";
 	$result = $this->db->select($query);
 	return $result;		
 }
 public function getAllbatchfrom(){
    $query = "SELECT * FROM tbl_conveyancesheet WHERE disverse='1' ORDER BY batch ASC";
 	$result = $this->db->select($query);
 	return $result;		
 }

 public function getusersbybatch($bId){
    $query = "SELECT * FROM tbl_conveyancesheet WHERE batch='$bId'";
 	$result = $this->db->select($query);
 	return $result;		
 }

 public function getAllbatchby($gId){
 	$query = "SELECT * FROM tbl_batchlist WHERE grps='$gId'";
 	$result = $this->db->select($query);
 	return $result;	
 }

 public function getuserswithoutbankacc($bId){
    $query = "SELECT * FROM tbl_conveyancesheet WHERE batch='$bId'";
 	$result = $this->db->select($query);
 	return $result;		
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
public function getaccountno(){
    $query = "SELECT * FROM tbl_accountno ORDER BY id DESC";
    $squery = $this->db->select($query);
    return $squery;    
}
 
 public function setbankaccountforcon($data, $serverIP, $date, $time){
 	$bank_name = $this->fm->validation($data['bank_name']);
 	$branch_name = $this->fm->validation($data['branch_name']);
 	$accno = $this->fm->validation($data['accno']);
 	$chq = $this->fm->validation($data['chq']);
 	$batch = $this->fm->validation($data['batch']);

 	$bank_name = mysqli_real_escape_string($this->db->link, $bank_name);
 	$branch_name = mysqli_real_escape_string($this->db->link, $branch_name);
 	$accno = mysqli_real_escape_string($this->db->link, $accno);
 	$chq = mysqli_real_escape_string($this->db->link, $chq);
 	$batch = mysqli_real_escape_string($this->db->link, $batch);

 	$query = "SELECT * FROM tbl_conveyancebankletter WHERE batch='$batch'";
    $squery = $this->db->select($query);
    if ($squery) {
    	$msg = "<span style='color:red; font-weight:bold;'>You're trying with old Batch</span>";
    	return $msg;
    }else{
    $iquery = "INSERT INTO tbl_conveyancebankletter(batch, bankId, branchId,acc, chq, cdate) VALUES('$batch', '$bank_name', '$branch_name', '$accno', '$chq', '$date')";
 	$iresult = $this->db->insert($iquery);
	if ($iresult) {
		$msg = "Account Set Successfully";
    	return $msg;
	}else{
		$msg = "Account Not Set Successfully";
    	return $msg;	
	}
    }
 }

 public function getaccountby($bId){
    $query = "SELECT * FROM tbl_conveyancebankletter WHERE batch='$bId'";
    $squery = $this->db->select($query);
    return $squery;   	
 } 
  public function getbanknamehby($bankId){
    $query = "SELECT * FROM  tbl_bankname WHERE bankName_id='$bankId'";
    $squery = $this->db->select($query);
    return $squery;   	
 }
 public function getbankaccountbrachby($branchId){
    $query = "SELECT * FROM  tbl_branchaddress WHERE branchAddress_id='$branchId'";
    $squery = $this->db->select($query);
    return $squery;   	
 } 
 public function getbankdistrict($district){
    $query = "SELECT * FROM  tbl_district WHERE distId='$district'";
    $squery = $this->db->select($query);
    return $squery;   	
 }
 
 public function getallactivepeoplelistfor(){
    $query = "SELECT * FROM  tbl_allstaffs WHERE conveyance='0'";
    $squery = $this->db->select($query);
    return $squery;   
 } 
 
 public function getstafsemployeedetaby($id){
    $getquery = "SELECT * FROM tbl_allstaffs WHERE userId='$id'";
    $squery = $this->db->select($getquery);
    return $squery;   
 }
}?>