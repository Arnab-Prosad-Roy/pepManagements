 <?php include 'inc/header.php' ?>


<?php 

	if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['submit'])) {
	 $request = $att->leaveRequest($_POST, $userId, $serverIP, $cyear, $date);
	}
?>
	<section id="content">
	<div class="container">
	<!-- <h1>user</h1> -->
			<div class="row">
				<div class="col-md-12">
					<div class="leave">
<h4>
<?php
if (isset($request)) {
	echo $request;
}
?>	
</h4>
    <?php
    $att = new Attendence();
      $success = $att->getUserBy($userId);
      if ($success) {
        while ($data = $success->fetch_assoc()) {
    ?>
                     <br/>
    Employee ID :-<?php echo $data['id'];
                    echo $data['user'];
                    echo $data['userId'];?>
	<?php } } ?>
	<br>


	<marquee behavior="alternate" style="color:green; font-size: 15px; font-weight: 700;">Please Request For Leave At Least 24 Hours Before</marquee>
					<form action="" method="POST">

						<h2>Leave Request Details </h2>



						<div class="form-group">
						  <label for="remail">Receiver Email:</label>
						  <select name="remail" class="form-control" id="remail">
 <?php 
    $getapply = $att->getrecieveremail();
    if ($getapply) {
    while ($data = $getapply->fetch_assoc()) {
 ?>
						    <option value="<?php echo $data['remail'] ?>"><?php echo $data['remail'];?></option>
<?php } } ?>  
						  </select>
						</div>

						 <div class="form-group">
						  <label for="reason">Reason:</label>
						  <input type="text" name="reason" class="form-control" id="reason">
						</div>
						<div class="form-group">
						  <label for="Dabout">Details About Leave:</label>
					<textarea id="Dabout" name="Dabout" placeholder="Enter your about Details....." class="form-control"></textarea>
						  
						</div> 
						 <div class="form-group">
						  <label for="reasonform">Form:</label>
						  <input type="date" name="fdate" class="form-control" id="fdate">
						</div>
						 <div class="form-group">
						  <label for="reasonto">To:</label>
						  <input type="date" name="tdate" class="form-control" id="tdate">
						 
						</div>
<!-- 						<div class="form-group">
						  <label for="Relname">Reliver Name:</label>
						  <select name="reliver_Name" class="form-control" id="Relname">
						    <option value="volvo">Volvo</option>
						    <option value="saab">Saab</option>
						    <option value="audi">Audi</option>
						  </select>
						</div> -->

						<div class="form-group">
						  <label for="relemail">Reliver Email:</label>
						   <select name="email" class="form-control" id="email">
	<?php 
    $getapply = $att->getreliveremail();
    if ($getapply) {
    while ($data = $getapply->fetch_assoc()) {
 ?>
						    <option value="<?php echo $data['email'] ?>"><?php echo $data['email'] ?></option>

<?php } } ?>  						  
						</select>
						</div> 

						<div class="form-group">
						  <label for="note">Reliver Note:</label>
						<textarea id="note" name="rnote" placeholder="Enter your Note....." class="form-control"></textarea>
						</div> 
						<button type="submit" name="submit" class="btn btn-success">Send Request</button>
						
					</form>
				</div>
			</div> 
	 </div>

	</div></section>
		  <?php include 'inc/footer.php' ?>