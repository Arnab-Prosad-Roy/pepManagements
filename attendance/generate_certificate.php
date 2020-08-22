<?php include 'inc/header.php'; ?>

<section id="content" style="height: 449px;">
 <div class="container">
    <div class="row">
        <form action="" method="POST">
        	<div class="col-md-6" ><a href="preview_loi.php?id=<?php echo $userId; ?>&amp;tid=<?php echo 1 ;?>">
        		<button type="button" class="btn btn-primary" name="submit" style="margin-left: 412px;">Create LOI</button></a>
            </div>
	        <div class="col-md-6"><a href="preview_noc.php?id=<?php echo $userId; ?>&amp;tid=<?php echo 1 ;?>">
	        	<button type="button" class="btn btn-primary" name="submit">Create NOC</button></a>
	        </div>
	       
        </form>
        
      </div>
  </div>
</section>  	
<?php include 'inc/footer.php'; ?>	
	
	
	
	
	
