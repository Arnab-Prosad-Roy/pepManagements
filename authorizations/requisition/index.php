<?php include 'inc/header.php'; ?>
	<!-- end header -->
<?php
 //if(!isset($_GET['user']) && $_GET['user'] == NULL){
   // echo "<script>window.location = '../index.php'</script>";
 // }else{
 //   $userId = $_GET['user'];
 // }
?>
	<?php 
		if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['submit'])) {
			$goto = $req->insertintostepone($_POST, $sId);
		}
	?>
<div class="container">
	<div class="row" style="margin-left: 44px; margin-right: 49px; margin-top: 63px; border: 1px solid #dad1d1;
" id="requisition_row">
		<form action="" method="post">

			<div class="col-md-6">
				<label style="margin-bottom: 26px;font-size: 18px;font-weight: normal;">Date of Requisition</label>
				<input type="date" name="reqs_date" class="form-control">
			</div>
			<div class="col-md-6">
				<label style="margin-bottom: 26px; font-size: 18px; font-weight: normal;" id="requirement_label">Date of Requirment</label>
				<input type="date" name="reqr_date" class="form-control">
			</div>
			<div class="col-md-12" style="margin-top: 33px;">
				<label style="margin-bottom: 26px;font-size: 18px;font-weight: normal;" placeholder="Staff Name">Staff Name</label>
				<input type="text" name="staff" class="form-control">
			</div>
			<br>
			<div class="col-md-12">
			
			<button type="submit" name="submit" class="btn btn-primary" style="float:right; font-size: 20px;margin-left: 71px;margin-top: 36px;">Submit</button>				
			</div>

			</div>
		</form>
	</div>
</div>
<?php include 'inc/footer.php'; ?>	