  <?php include 'inc/header.php' ?>
  <?php 
      $atten = new Attendence();
  ?>
<?php 
  $dateTime = date_default_timezone_set('Asia/Dhaka');
  $serverIPout = $_SERVER["REMOTE_ADDR"];
  $timestamp = time();
  $date = date("Y-m-d");
  $day = date("(D)");
  $time = date("H:i:s",$timestamp);
  $month = date('M');
?>
   <div class="container">
<div class="row">
<div class="col-md-7">
<div class="">

  <div class="col-md-12"  style="border: 1px solid blue;
margin-top: 20px;
border-radius: 5px;">
  <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Date</th>
      <th scope="col">Month</th>
      <th scope="col">Day</th>
      <th scope="col">Time</th>
    </tr>
  </thead>
  <tbody>
  <?php
  $getInfo = $atten->getUseroutatten($userId);
   if ($getInfo) {
     $i = 0;
     while($data = $getInfo->fetch_assoc()){
       $i++;
  ?>
    <tr>
      <th scope="row"><?php echo $i;?></th>
      <td><?php echo $data['outdate'];?></td>
      <td><?php echo $data['outmonth'];?></td>
      <td><?php echo $data['outday'];?></td>
      <td><?php echo $data['outtime'];?></td>
    </tr>
   <?php } } ?>
  </tbody>
</table>
  </div>
</div>
</div>


<?php
    
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
      $attendence = $atten->markOutAttendence($_POST, $userId, $serverIPout, $date, $day, $time, $month);
    }
?>

<div class="col-md-5" style="margin-top:20px;">

<form action="" method="post" style="padding:2px">
                                   
<label for="sel1">Reason for Early leaving:</label>
    <select class="form-control" name="early_leave">
      <option>---</option>
                                           
        <option value="Traffic" >Traffic</option> 
        <option value="Sickness" >Sickness</option> 
        <option value="Errand">Errand</option>
        <option value="Emargency Personal Issue" >Emargency Personal Issue</option>
        <option value="Festival">Festival</option>
        <option value="Study">Study</option>                                     
      </select>
       <br/>

    <div class="form-group">
    <label for="exampleFormControlTextarea1">Ongoing Works</label>
    <textarea class="form-control" name="ongoing_works" id="exampleFormControlTextarea1" rows="3"></textarea>
  </div>

     <label for="sel1">In Case of Errand:</label><br/>
     <label for="sel1">Errand to:</label> 
     <input type="text" name="incase_errand_place" class="form-control">

      <label for="sel1">For</label> <br/>
       <label class="radio-inline"><input type="radio" name="errand_for_out"   value="">HR</label>
       <label class="radio-inline"><input type="radio" name="errand_for_out"    value="">CEO</label>
        <label class="radio-inline"><input type="radio" name="errand_for_out"   value="">R&D</label> 
        <label class="radio-inline"><input type="radio" name="errand_for_out"   value="">Account & Finance</label>          

     
       </select><br/>
    <label for="sel1">From</label>


     <input type="time" name="errand_from_out" class="form-control">
    </select>
    <label for="sel1">to</label>


     <input type="time" name="errand_to_out" class="form-control">
     <br/>

     <button type="submit" name="submit" class="btn btn-lg btn-primary">Done</button>
   
</form>
</div>
</div>
</div>
    <?php include 'inc/footer.php' ?>