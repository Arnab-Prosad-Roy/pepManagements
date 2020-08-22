<?php 
	

	 include_once 'lib/database.php';
	 include_once 'helpers/format.php';


?>

<?php
/**
* Adminlogin class
*/
class Requisition
{
	private $db;
	private $fm;
	public function __construct()
	{
		$this->db = new Database();
		$this->fm = new Format();
	}
 public function insertintostepone($data, $sId){
 		$reqs_date = $this->fm->validation($data['reqs_date']);
 		$reqr_date = $this->fm->validation($data['reqr_date']);
 		$staff = $this->fm->validation($data['staff']);

 		$query = "INSERT INTO tbl_stepone(sId, req_date, require_date,staff_name, statusone) VALUES('$sId', '$reqs_date', '$reqr_date', '$staff', '1')";

 		$result = $this->db->insert($query);
 		if ($result) {
 			echo "<script>window.location='requisition_purpose_form'</script>";
 		}else{
 			$msg = "Not Inserted";
 			return $msg;
 		}
 		 		 		 	
 }
public function getAlldata($sId){
	$query = "SELECT * FROM tbl_stepone WHERE sId ='$sId'";
 	$result = $this->db->select($query);
 	return $result;
}
 public function getAlldatafrom($sId){
 	$query = "SELECT * FROM tbl_stepone WHERE sId ='$sId' AND statusone='1'";
 	$result = $this->db->select($query);
 	return $result;
 }

 public function insertintosteptwo($data, $sId, $tot, $staff_name, $rdate, $redate){
  		$purpose = $this->fm->validation($data['purpose']);
 		$req_amount = $this->fm->validation($data['req_amount']);
 		
 		$query = "INSERT INTO tbl_steptwo(sId, requisitionNumber, rdate, redate, staffname,  	purposeDesc, requestedAmmount, statuslog) VALUES('$sId', '$tot', '$rdate', '$redate', '$staff_name', '$purpose', '$req_amount', '1')";

 		$result = $this->db->insert($query);
 		if ($result) {
 			echo "<script>window.location='requisition_purpose_form'</script>";
 		}else{
 			$msg = "Not Inserted";
 			return $msg;
 		}	
 }

 public function updatesteptwo($sId, $tot, $staff_name, $rdate, $redate){
 	$uptodate = "UPDATE tbl_steptwo SET statuslog = '2' WHERE sId = '$sId' AND requisitionNumber='$tot' AND staffname = '$staff_name' AND rdate = '$rdate' AND redate = '$redate'";
 	$update_row = $this->db->update($uptodate);
 	if ($update_row) {
 		echo "<script>window.location='index'</script>";
 	}
 }

 public function updatestepone($sId, $staff_name, $rdate, $redate){
  	$uptodate = "UPDATE tbl_stepone SET statusone = '2' WHERE sId = '$sId' AND staff_name = '$staff_name' AND req_date = '$rdate' AND require_date = '$redate'";
 	$update_row = $this->db->update($uptodate);
	
 }
 public function getAlldatafromsteptwo($sId){
  	$query = "SELECT * FROM tbl_steptwo WHERE sId ='$sId' AND statuslog='2'";
 	$result = $this->db->select($query);
 	return $result;	
 }
}
?>