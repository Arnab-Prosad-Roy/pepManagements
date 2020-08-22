<?php include_once "lib/Database.php"; ?>
<?php include_once "../helpers/Format.php"; ?>
<?php include_once "lib/Session.php"; ?>

<?php
	/**
	* 
	*/
	class attendenceInserttwo
	{
		private $db;
		private $fm;

		public function __construct()
	
		{
			$this->db = new Database();
			$this->fm = new Format();
		}	

		public function getallactiveemployeefor(){
		    $query = "SELECT * FROM tbl_employee WHERE estat='0'";
		    $result = $this->db->select($query);
		    return $result;
		}

		public function getallleavesummuryby($uId, $years){
			 $query = "SELECT * FROM tbl_leaverequest WHERE userId = '$uId' AND cyear='$years' AND nstat='1'";
			// $query = "SELECT * FROM tbl_leaverequest WHERE ('approve_tdate' BETWEEN '2018-08-01' AND '2018-10-30') AND userId='$uId'";
			$result = $this->db->select($query);
			return $result;
		}

public function getallemployee(){
$query = "SELECT * FROM tbl_employee WHERE estat='0'";
$result = $this->db->select($query);
return $result;
}

public function getallemployeeleave($uId, $yeard){
$query = "SELECT * FROM tbl_leavesummarys WHERE userId='$uId' AND currentyear='$yeard'";
$result = $this->db->select($query);
return $result;	
}
public function getallemployeeleavetiildate($uId, $year){
$query = "SELECT * FROM tbl_leavesummarys WHERE userId='$uId' AND currentyear='$year'";
$result = $this->db->select($query);
return $result;	
}
		public function getallleaveempnameby($userId){
			$query = "SELECT * FROM tbl_employee WHERE userId = '$userId'";
			$result = $this->db->select($query);
			return $result;			
		}

		public function getallleaveempimageby($userId){
			$query = "SELECT * FROM tbl_user_reg WHERE regId = '$userId'";
			$result = $this->db->select($query);
			return $result;				
		}

		public function getallleavesummurybytwo($year){
			$query = "SELECT * FROM tbl_leaverequest WHERE cyear='$year'";
			$result = $this->db->select($query);
			return $result;			
		}

		public function getallleavequotaby($userId){
			$query = "SELECT * FROM tbl_stage WHERE userId='$userId'";
			$result = $this->db->select($query);
			return $result;				
		}

		public function shiftleavedataintosummary($uid, $user, $cuyear, $ltotal, $entitle, $totalaccrueone, $totalaccruetwo, $date, $day, $time, $lf, $lt){
			$uid = mysqli_real_escape_string($this->db->link, $uid);
			$user = mysqli_real_escape_string($this->db->link, $user);
			$cuyear = mysqli_real_escape_string($this->db->link, $cuyear);
			$ltotal = mysqli_real_escape_string($this->db->link, $ltotal);
			$entitle = mysqli_real_escape_string($this->db->link, $entitle);
			// $totalleave = mysqli_real_escape_string($this->db->link, $totalleave);
			$totalaccrueone = mysqli_real_escape_string($this->db->link, $totalaccrueone);
			$totalaccruetwo = mysqli_real_escape_string($this->db->link, $totalaccruetwo);
			$date = mysqli_real_escape_string($this->db->link, $date);
//email selection

    $mquery = "SELECT * FROM employee WHERE userId = '$uid'";
    $result = $this->db->select($mquery);
    if($result){
        while($row = $result->fetch_assoc()){
            $email = $row['officeemail'];
        }
    }	

	//get leave details 
	    $mquery = "SELECT * FROM tbl_leaverequest WHERE userId = '$uid' AND leave_fdate='$lf' AND leave_tdate='$lt'";
    $result = $this->db->select($mquery);
    if($result){
        while($row = $result->fetch_assoc()){
            $reliveremail = $row['email'];
            $lfdate = $row['leave_fdate'];
            $ltdate = $row['leave_tdate'];
            $reason = $row['reason'];
            $note = $row['Dabout'];
            $approval = $row['leave_approval'];
        }
    }		
//unauthorised leave calculation
  	$querysph = "SELECT * FROM tbl_leaverequest WHERE userId='$uid' AND cyear='$cuyear' AND leave_approval = 'Not Approved'";
  	$resultl = $this->db->select($querysph);
  	if ($resultl) {
  		$totalunauthorised = mysqli_num_rows($resultl);
  	}else{
  		$totalunauthorised = "0";
  	}
//late calculaton
  	// $querylate="SELECT * FROM tbl_attendence WHERE ('attendence_time' BETWEEN '$stime' AND '$etime') AND userId='$uid'";
  	// $resultlc = $this->db->select($querylate);
  	// if ($resultlc) {
  	// 	$totallate = mysqli_num_rows($resultlc);
  	// }else{
  	// 	$totallate="0";
  	// }
  	$totallate="0";
			$squery = "SELECT * FROM tbl_leavesummarys WHERE userId='$uid' AND currentyear='$cuyear'";
			$sresult = $this->db->select($squery);
			if($sresult){
				while ($sdeta=$sresult->fetch_assoc()) {
					$empId=$sdeta['userId'];
					$currentyear=$sdeta['currentyear'];
				}
			}
			$query = "INSERT INTO tbl_leaveresummarysupport(userId, user, currentyear, leavetaken, entitle, totalaccrueone, totalaccruetwo, unautho, latecome, cdate) VALUES('$uid', '$user', '$cuyear', '$ltotal', '$entitle', '$totalaccrueone', '$totalaccruetwo', '$totalunauthorised', '$totallate', '$date')";
			$result = $this->db->insert($query);


			if (!$sresult) {
			$query = "INSERT INTO tbl_leavesummarys(userId, user, currentyear, leavetaken, entitle, totalaccrueone, totalaccruetwo, unautho, latecome, cdate) VALUES('$uid', '$user', '$cuyear', '$ltotal', '$entitle', '$totalaccrueone', '$totalaccruetwo', '$totalunauthorised', '$totallate', '$date')";
			$result = $this->db->insert($query);
			if ($result) {
	 							?>
			 					<script>var my_time = new Date(); alert('Late Approval Request Responsed at '+my_time);
			 					<?php
                        		  //echo "window.location = 'aprovenewtwo?userId=$uid&years=$cyear'";
                        		   echo "window.location = 'leaverequestn";
                        		  ?>
                      			  </script>
                            <?php
	
			}else{
				$msg = "Data Not Save To Summary";
				return $msg;				
			}
			}else{
				
			$uquery = "UPDATE tbl_leavesummarys SET leavetaken='$ltotal', totalaccrueone='$totalaccrueone', totalaccruetwo='$totalaccruetwo', unautho='$totalunauthorised', latecome='$totallate', cdate='$date' WHERE userId='$uid' AND currentyear='$cuyear'";
			$uresult = $this->db->update($uquery);
			if ($uresult) {
	 							?>
			 					<script>var my_time = new Date(); alert('Late Approval Request Responsed at '+my_time);
			 					<?php
                        		  echo "window.location = 'leaverequestn'";
                        		  ?>
                      			  </script>
                            <?php

			}else{
				$msg = "Data Not update To Summary";
				return $msg;				
			}				
			}

		}

public function leaveApproveform($data, $uId, $lf, $lt, $cyear){
	$fdate = $this->fm->validation($data['fdate']);
	$tdate = $this->fm->validation($data['tdate']);
	$approve = $this->fm->validation($data['approve']);

	$fdate = mysqli_real_escape_string($this->db->link, $fdate);
	$tdate = mysqli_real_escape_string($this->db->link, $tdate);
	$approve = mysqli_real_escape_string($this->db->link, $approve);

    $mquery = "SELECT * FROM tbl_leaverequest WHERE userId = '$uId' AND leave_fdate='$lf' AND leave_tdate='$lt'";
    $result = $this->db->select($mquery);
    if($result){
        while($row = $result->fetch_assoc()){
            $reliveremail = $row['email'];
            $lfdate = $row['leave_fdate'];
            $ltdate = $row['leave_tdate'];
            $reason = $row['reason'];
            $note = $row['Dabout'];
            $approval = $row['leave_approval'];
        }
    }
    $Mquery = "SELECT * FROM employee WHERE userId = '$uId'";
	$result = $this->db->select($Mquery)->fetch_assoc();
	$email = $result['officeemail'];
	$userName = $result['user'];

    $Rquery = "SELECT * FROM employee WHERE officeemail = '$reliveremail'";
	$resultrow = $this->db->select($Rquery)->fetch_assoc();
	$reliverName = $resultrow['user'];	
	
	$query = "UPDATE tbl_leaverequest SET 
	approve_fdate = '$fdate',
	approve_tdate = '$tdate',
	leave_approval = '$approve',
	status = '0',
	cyear='$cyear',
	nstat='1'
	WHERE userId = '$uId' AND leave_fdate='$lf' AND leave_tdate='$lt' status='1'";
	$result = $this->db->update($query);
	if($result){
		echo "<script>window.location='aprovenewtwo?userId=$uId&years=$cyear&lf=$lfdate&lt=$ltdate'</script>";		
	}else{
	  	$msg = "Leave Not Approved";
	    return $msg;  
	}

}

public function getallemployeeleavedetails($uId,$yeard){
	$squery = "SELECT * FROM tbl_leaverequest WHERE userId='$uId' AND cyear='$yeard'";
	$sresult = $this->db->select($squery);
	return $sresult;
}

	public function getUserrequestdate($uId, $lf, $lt){
		$query = "SELECT * FROM tbl_leaverequest WHERE userId = '$uId' AND leave_fdate='$lf' AND leave_tdate = '$lt' AND status = '1'";
		$result = $this->db->select($query);
		return $result;
	}
public function getallemployeepic($uId){
	$squery = "SELECT * FROM tbl_user_reg WHERE regId='$uId'";
	$sresult = $this->db->select($squery);
	return $sresult;	
}

public function getallemployeeleavedetailsbymonth($uId, $lf, $lt){
		$query = "SELECT * FROM tbl_leaverequest WHERE userId = '$uId'";
		$result = $this->db->select($query);
		return $result;	
}
public function getallemployeefor(){
	$squery = "SELECT * FROM tbl_employee WHERE active='1' AND estat='0'";
	$sresult = $this->db->select($squery);
	return $sresult;		
}

public function hrcommentsset($uid, $cuyear, $hrin, $hrded, $opblnce, $cdate, $year){
	$hrin = mysqli_real_escape_string($this->db->link, $hrin);
	$hrded = mysqli_real_escape_string($this->db->link, $hrded);
	$opblnce = mysqli_real_escape_string($this->db->link, $opblnce);

	$query = "INSERT INTO tbl_openbalance(userId, opening, hrin, hrded, years, ddate, cyear) VALUES('$uid', '$opblnce', '$hrin', '$hrded', '$cuyear', '$cdate', '$year')";
	$result = $this->db->insert($query);
	if ($result) {
		$msg = "HR Comments Recorded Successfully";
		return $msg;
	}else{
		$msg = "HR Comments Not Recorded Successfully";
		return $msg;		
	}
}
}