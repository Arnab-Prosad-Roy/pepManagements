<?php include 'inc/header.php'; ?>
	<!-- end header -->



<div class="container">
	<div class="row" style="margin-left: 44px; margin-right: 49px; margin-top: 63px; border: 1px solid #fefafa;
box-shadow: 0px 0px 5px;
" id="requisition_row">
<div class="row">
	<div class="col-md-8">
		<h2 style="text-decoration: underline; font-weight: normal;">View Fund Requisition </h2>
	</div>
	<div class="col-md-4">
		<img src="../images/kyoto.png" alt="logo"/ style="width:106px;height:44px;margin: 20px;">
	</div>
</div>
<?php 
$getdata = $req->getAlldata($sId);
if ($getdata) {
	while($data = $getdata->fetch_assoc()){?>
<div class="row">
	<div class="col-md-6">
		Staff Name : <?php echo $data['staff_name'];?><br/>
		Date Of Requisition : <?php echo $data['req_date'];?>
	</div>
	<div class="col-md-6">
		Requisition Number : <?php $ser = "1600";
									$id = $data['id'];
									$tot = $ser+$id;
									echo $tot;?><br/>
		Date Of Requirement : <?php echo $data['require_date'];?>
		<?php
		$staff_name=$data['staff_name']; 
		$rdate=$data['req_date'];
		$redate=$data['require_date'];
		
		
		?>
	</div>
</div>
	<?php }
}
?>
	<?php 
		if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['finish'])) {

			$updata = $req->updatesteptwo($sId, $tot, $staff_name, $rdate, $redate);
			$upone = $req->updatestepone($sId, $staff_name, $rdate, $redate);
		}
	?> 
	<?php 
		if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['submit'])) {
			$goto = $req->insertintosteptwo($_POST, $sId, $tot, $staff_name, $rdate, $redate);
		}
	?>
		<form action="" method="post">
			<div class="col-md-6">
				<p></p>
			</div>
			<div class="col-md-4">
				<label style="margin-bottom: 26px; font-size: 18px; font-weight: normal;" id="requirement_label">Requested Amount</label>
				<input type="text" name="req_amount" class="form-control">
			</div>
			
			
</form>
			</div>
		
	</div>

<?php include 'inc/footer.php'; ?>