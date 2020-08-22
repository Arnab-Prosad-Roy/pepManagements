<?php include_once "lib/Database.php"; ?>
<?php include_once "helpers/Format.php"; ?>

<?php
    /**
    * Conveyance
    */
    class Conveyance
    {
        private $db;
        private $fm;

        public function __construct()
    
        {
            $this->db = new Database();
            $this->fm = new Format();
        }

    public function getAllConveyanceDetails() {
        $query = "SELECT a.*, b.user FROM tbl_conveyance AS a, tbl_employee AS b WHERE a.userId = b.userId AND a.status = '0'"; 
        $result = $this->db->select($query);
        return $result;
    }

    public function getAllClaimedData($id){
        $query = "SELECT a.*, b.user FROM tbl_conveyance AS a, tbl_employee AS b WHERE a.userId = b.userId AND a.id = '$id'";
        $result = $this->db->select($query);
        return $result;

    }

    public function updateConveyanceApprove($id){
        $query = "UPDATE tbl_conveyance SET approval = '1', status = '1' WHERE id = '$id'";
        $result = $this->db->update($query);
        if ($result) {
            ?>
                <script>var my_time = new Date(); alert('Claimed Approved Successfully '+my_time);
                    window.location = 'conveyance_details';
                </script>
            <?php
        }else{
            $errmsg = "<span style='color:red'>Claimed is not Approved !!</span>";
            return $errmsg;
        }
    }

    public function updateConveyanceDecline($id){
        $query = "UPDATE tbl_conveyance SET approval = '2', status = '1' WHERE id = '$id'";
        $result = $this->db->update($query);
        if ($result) {
            ?>
                <script>var my_time = new Date(); alert('Claimed Declined '+my_time);
                    window.location = 'conveyance_details';
                </script>
            <?php
        }else{
            $errmsg = "<span style='color:red'>Claimed is not Declined !!</span>";
            return $errmsg;
        }
    }

    public function claimRequest($conveyance, $fund_requisition, $requisition){

        if (empty($conveyance) || empty($fund_requisition) || empty($requisition)) {
            $msg = "<span style='color:red'>Please Select an Option. Fields Must Not be Empty !!</span>";
            return $msg;
        }else{
            if (isset($conveyance) == '1') {
               echo "<script>window.loaction='requisition/convence_bill'</script>";
            }elseif (isset($fund_requisition) == '2') {
                echo "<script>window.loaction='requisition/fund_requisition'</script>";
            }elseif (isset($requisition) == '3') {
                echo "<script>window.loaction='requisition/index'</script>";
            }
        }
    }
}


?>