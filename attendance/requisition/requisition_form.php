<?php include 'inc/header.php'; ?>
	<!-- end header -->
<div class="container">
	<div class="row" style="margin-left: 44px; margin-right: 49px; margin-top: 63px; border: 1px solid #dad1d1;
" id="requisition_row">

		<form>
		<div class="col-md-12">
			<div class="col-md-8"><h1 style="font-weight: normal;">Fund Requisition Form</h1></div>
			<div class="col-md-4"><img src="../images/kyoto.png" style="height:52px; width:61%"></div>
		</div>

<?php 
$getdata = $req->getAlldatafrom($sId);
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





			
			<br>
			<div class="col-md-12">
					<table class="table table-hover">
						<thead>
							<td>SL</td>
							<td>Purpose & Full Description</td>
							<td>Requested amount</td>
							<td>Approved Amount</td>
						</thead>
<?php 
$getdata = $req->getAlldatafromsteptwo($sId);
if ($getdata) {
	$i = "0";
	while($datarow = $getdata->fetch_assoc()){
		$i++;
		?>
						<tr>
							<td><?php echo $i;?></td>
							<td><?php echo $datarow['purposeDesc'];?></td>
							<td><?php echo $datarow['requestedAmmount'];?>/- tk</td>
							<td><?php echo $datarow['approvedAmmount'];?>/- tk</td>
						</tr>
				<?php }
}
?>
						<tr>
							<td colspan="3">Total in word:</td>
							<td>Total: </td>

						</tr>

					</table>	
			</div>
			<div class="col-md-12">
				<div class="col-md-3"><hr> Requested By </div>
				<div class="col-md-3"><hr> Recommended By </div>
				<div class="col-md-3"><hr> Approved By </div>
				<div class="col-md-3"><hr> Recieved By & Date </div>
			</div>
	</form>

			</div>
		</div>

<?php include 'inc/footer.php'; ?>