<?php include 'inc/header.php'; ?>
<?php include_once "../classes/Auth.php"; ?>
<?php 
  if (isset($_GET['ref_no']) && !empty($_GET['ref_no'])) {
    $ref_no = $_GET['ref_no'];
  }
?>
<?php 
  $auth = new Authorization();
  $date = date('Y-m-d');
  $ip = $_SERVER['REMOTE_ADDR'];
?>



<section id="content" style="height: auto;">
  <div class="container">
    <div class="row">
          <div class="col-md-2"></div>
          <div class="col-md-12">
            <div class="panel panel-default">
              <div class="panel-heading">
                <h3 class="panel-title">Details Of Letter</h3>
              </div>
              <div class="panel-body">
                <table class="table table-striped">

                  <thead>
                    <tr><th colspan="9"><span style="color:green;">With Reference Number : <?php echo $ref_no;?></span><br/>
                    <h2 style="color:green;">The Reference Number is Valid</h2>
                    </th></tr>
                    <tr>
                       
                   <!-- <th>Serial</th> -->
                    <th>Letter ID</th>
                    <th>Person Name</th>

                    <th>Designation</th>
                    <th>Company Name</th>
                    <th>Subject</th>
                  </tr>
                  </thead>
    <?php 
      $data = $auth->getLetterId($ref_no);
      if ($data) {
        $i = '0';
        while ($rowdata = $data->fetch_assoc()) {
          
    ?>
                  <tr>
                    <!-- <td><?php //echo $i; ?></td> -->
                    <td><?php 
                    $lId = $rowdata['lId']; 
                    echo $rowdata['lId']; ?></td>
                    <td><?php echo $rowdata['name']; ?></td>
    <?php 
      $datal = $auth->getLetterdetails($lId);
      if ($datal) {
        while ($rowdatal = $datal->fetch_assoc()) { 
          $pId = $rowdatal['addId'];
    ?>   

     <?php 
      $datap = $auth->getLetterpersondetails($pId);
      if ($datap) {
        while ($rowdatap = $datap->fetch_assoc()) { 
    ?>          
       
                    <td><?php echo $rowdatap['jId']; ?></td>
                    <td><?php echo $rowdatap['cname']; ?></td>
                    
                 
      <?php } }?> 
      <td><?php echo $rowdatal['subName']; ?></td>           
      <?php } }?> 
       </tr>           
    <?php } }else{echo "<span style='color:red;'>No Data Found</span>";} ?>
                </table>
              </div>
            </div>  
          </div>  
        </div>
  </div>
</section>



<?php include 'inc/footer.php'; ?>