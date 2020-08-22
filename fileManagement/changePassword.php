	  <?php include 'inc/header.php' ?>
<?php include_once "../Classes/Career.php";?>

   <?php
$userId = Session::get("userId");
$career = new Career();
  if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['create'])) {
    $changepass = $career->changeUserpass($_POST, $userId);
  }
?>

	<section id="content" style="height: 449px;">
	<div class="container">
	
	
<h3>Change Password</h3>
      <?php 
        if (isset($changepass)) {
          echo $changepass;
        }
      ?>


  				<div class="row">
				<div class="col-md-offset-3 col-md-6">
		 <form action="" method="post"> 
		 
	
        <div class="form-group">
          <label for="usr"></label>
          <input type="password" name="oldpass" class="form-control" id="usr" placeholder="Old Password...">
        </div>
        <div class="form-group">
          <label for="usr"></label>
          <input type="password" name="newpass" class="form-control" id="usr" placeholder="New Password...">
        </div>
        <div class="form-group">
          <label for="usr"></label>
          <input type="password" name="confirmpass" class="form-control" id="usr" placeholder="Confirm Password...">
        </div>
        
     <br><br>

      <p>
        <button type="submit" name="create" class="btn upbtn btn-primary">Change</button>
      </p>
</form>
</div>
		</div> 






	</div></section>
		  <?php include 'inc/footer.php' ?>