<?php include 'inc/header.php' ?>
 <?php include_once "../Classes/fileaccess.php";?>
	<section id="content">
	<div class="container">
	
	



<?php
    $file = new Files(); 
    
?>
<?php 
  $dateTime = date_default_timezone_set('Asia/Dhaka');
  $serverIP = $_SERVER["REMOTE_ADDR"];
  $timestamp = time();
  $date = date("Y-m-d");
  $day = date("(D)");
  $time = date("H:i:s",$timestamp);
  $month = date('M');
?>
<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
        $insertfiles = $file->insertFilesbyuser($_POST, $userId,$date);
    }
?>

  	<div class="row">
			
		<div class="skill-home"> <div class="skill-home-solid clearfix"> 
		<div class="row">
      <div class="col-md-6" style="background-color:#e4e5e6;margin-left:250px;padding: 25px 60px;border-radius: 8px;" >
<?php
    if (isset($insertfiles)) {
      echo $insertfiles;
    }
?>
 <h3 style="margin-bottom:40px;">

        Create Files
 </h3>
  <div id="adminForm">

  <form method="post" action="">
    
    <div class="form-group">
      <label for="file_name">File Name</label>
      <input type="text" name="file_name" placeholder="Enter File Name" class="form-control">
    </div>   
    <div class="form-group">
      <label for="who_create_it">Who Create It</label>
      <input type="disable" name="who_create_it" class="form-control" value="<?php echo $user;?>" readonly>
    </div>
    <div class="form-group">
      <label for="department">Department</label>
      <select class="form-control" id="exampleSelect1"  name="department">
        <option selected>Department Name</option>
        <?php
            $department = $file->getDepartment();
            if ($department) {
              while ($departmentdata = $department->fetch_assoc()) { ?>
        <option value="<?php echo $departmentdata['dId']; ?>"><?php echo $departmentdata['deptName']; ?></option>
        <?php } } ?>
      </select>
    </div> 


      <button type="submit" name="submit" class="btn btn-primary">Submit</button>
  </form>
  </div>       
      </div>

			</div> 

		
		
		</div> 

		</div>
		</div> 






	</div></section>
		  <?php include 'inc/footer.php' ?>