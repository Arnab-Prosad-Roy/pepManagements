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
<?php 
  if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $info = $auth->insertRefInformationData($_POST, $date, $ip, $ref_no);
  }
?>
<section id="content" style="height: auto;">
	<div class="container">
		<div class="row">
        <div class="col-md-6 col-md-offset-3 text-center"  style="box-shadow: 0px 0px 20px 2px #dad4d4;padding: 20px;">
          <?php if(isset($info)){echo $info;} ?>
          <h1>Please Fill-up your Details in Order to Get a Confirmation eMail</h1>
          <form method="post" action="">
            <div class="form-group">
               <label>Name</label><small style="color: red;">*</small>
               <input type="text" name="name" class="form-control" placeholder="Enter Your Name"> 
            </div>
            <div class="form-group">
               <label>Company Name</label>
               <input type="text" name="cName" class="form-control" placeholder="Enter Company Name"> 
            </div>
            <div class="form-group">
               <label>Email</label><small style="color: red;">*</small>
               <input type="text" name="email" class="form-control" placeholder="Enter Your Mail"> 
            </div>
            <div class="form-group">
               <label>Phone No</label><small style="color: red;">*</small>
               <input type="text" name="phone" class="form-control" placeholder="Enter Your Phone Number"> 
            </div>
            <div class="form-group">
               <label>Designation</label>
               <input type="text" name="desig" class="form-control" placeholder="Enter Your Designation"> 
            </div>
            <div class="form-group">
               <button class="btn btn-primary" type="submit" name="submit">Submit</button>
            </div>
          </form>
        </div>
    </div>
	</div>
</section>
<?php include 'inc/footer.php'; ?>