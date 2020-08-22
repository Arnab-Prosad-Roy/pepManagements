	  <?php include 'inc/header.php' ?>
 <?php include_once "../Classes/fileaccess.php";?>

 <?php
    $file = new Files(); 
    
?>
	<section id="content" style="height: auto">
	<div class="container">
	
	


<div class="row">
			
		<div class="skill-home"> <div class="skill-home-solid clearfix"> 
		<div class="row">
			<div class="col-md-12">
  <div id="adminForm">
       

  <form method="post" action="">
    <table class="table table-striped">
      <thead>
        <tr>
          <th>Serial</th>
          <th>FileNumber</th>
          <th>File Name</th>
          <th>Created By</th>
          <th>Department</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
      <?php
          $viewfile = $file->getAllFiles();
          if ($viewfile) {
            $i = 0;
            while ($rowdata = $viewfile->fetch_assoc()) { 
                $i++;
             ?>
        <tr>
          <td><?php echo $i; ?></td>
          <td><?php 
          $static = '1800';
          $id = $rowdata['id'];
          $num = $static+$id;
          echo $num;
           ?></td>
          <td><?php echo $rowdata['filename']; ?><a href="filenameprint?fileid=<?php echo $rowdata['id']; ?>&amp;filenum=<?php echo urldecode($num); ?>">&nbsp;&nbsp; || Print<a></td>
          <td><?php echo $rowdata['whocreateIt']; ?></td>
          <td><?php echo $rowdata['department']; ?></td>
          <td>
            <a href="fileEdit?id=<?php echo $rowdata[id]; ?>" title="Edit">Edit</a>
          </td>
        </tr>
        <?php } } ?>
      </tbody>
    </table>
    
  </form>
  </div> 
			</div>

		</div> 

		
		
		</div>

	</div>
</div> 






	</div></section>
		  <?php include 'inc/footer.php' ?>